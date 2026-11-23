<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = strtolower(trim((string) ($user->role ?? '')));
        $isOwner = $role === 'pemilik';
        $isAdmin = in_array($role, ['admin', 'admintkb'], true);

        $todayStart = Carbon::now('Asia/Jakarta')->startOfDay();

        $baseQuery = ActivityLog::visibleTo($user);

        $totalToday = (clone $baseQuery)->where('created_at', '>=', $todayStart)->count();
        $criticalCount = (clone $baseQuery)->where('severity', 'critical')->count();
        $activeUsersToday = (clone $baseQuery)
            ->where('created_at', '>=', $todayStart)
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        $failedLoginsToday = (clone $baseQuery)
            ->where('action', 'login_failed')
            ->where('created_at', '>=', $todayStart)
            ->count();

        $availableRoles = $isOwner
            ? ['Pemilik', 'Admin', 'Admintkb', 'Stockist', 'Produksi', 'Magang']
            : ($isAdmin ? ['Admin', 'Admintkb', 'Stockist', 'Produksi', 'Magang'] : []);

        $availableModules = [
            'auth' => 'Autentikasi',
            'invoice' => 'Invoice',
            'pembelian' => 'Pembelian',
            'spk' => 'SPK',
            'spb' => 'SPB',
            'spj' => 'SPJ',
            'barang' => 'Barang',
            'material' => 'Material',
            'inventaris' => 'Inventaris',
            'user' => 'Karyawan / User',
            'budget' => 'Anggaran',
            'vendor' => 'Vendor',
            'kategori' => 'Kategori',
            'laporan' => 'Laporan',
        ];

        $scopeLabel = $isOwner
            ? 'Akses Penuh (Semua Role & Modul)'
            : ($isAdmin
                ? 'Aktivitas Pribadi & Tim Non-Pemilik'
                : 'Hanya Aktivitas Pribadi Anda');

        return view('pages.activity-logs.index', compact(
            'isOwner',
            'isAdmin',
            'totalToday',
            'criticalCount',
            'activeUsersToday',
            'failedLoginsToday',
            'availableRoles',
            'availableModules',
            'scopeLabel'
        ));
    }

    public function data(Request $request)
    {
        $user = Auth::user();
        $roleLower = strtolower(trim((string) ($user->role ?? '')));
        $isOwner = $roleLower === 'pemilik';

        $query = ActivityLog::visibleTo($user);
        $recordsTotal = (clone $query)->count();

        // Filter Role (server-side guard: non-Owner cannot query Pemilik)
        if ($request->filled('role')) {
            $filterRole = strtolower(trim((string) $request->input('role')));
            if ($isOwner || $filterRole !== 'pemilik') {
                $query->whereRaw('LOWER(user_role) = ?', [$filterRole]);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        // Filter Module
        if ($request->filled('module')) {
            $query->where('module', strtolower(trim((string) $request->input('module'))));
        }

        // Filter Severity
        if ($request->filled('severity') && in_array($request->input('severity'), ['info', 'warning', 'critical'], true)) {
            $query->where('severity', $request->input('severity'));
        }

        // Filter Action
        if ($request->filled('action_type')) {
            $query->where('action', strtolower(trim((string) $request->input('action_type'))));
        }

        // Filter Date Range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        // Global Search
        $search = trim((string) ($request->input('search.value') ?? $request->input('q', '')));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                  ->orWhere('user_role', 'like', "%{$search}%")
                  ->orWhere('module', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('subject_label', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $recordsFiltered = (clone $query)->count();

        $start = max(0, (int) $request->input('start', 0));
        $length = (int) $request->input('length', 25);
        if ($length <= 0 || $length > 100) {
            $length = 25;
        }

        $rows = $query->orderByDesc('created_at')
            ->orderByDesc('id')
            ->skip($start)
            ->take($length)
            ->get();

        $data = $rows->map(function (ActivityLog $log) use ($isOwner) {
            $hasDiff = !empty($log->old_values) || !empty($log->new_values);
            return [
                'id' => $log->id,
                'created_at' => $log->created_at ? $log->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i:s') : '-',
                'user_name' => $log->user_name,
                'user_role' => $log->user_role,
                'module' => $log->module,
                'action' => $log->action,
                'severity' => $log->severity,
                'subject_label' => $log->subject_label ?: '-',
                'description' => $log->description,
                'has_diff' => $hasDiff,
                'ip_address' => $isOwner ? ($log->ip_address ?: '-') : null,
            ];
        });

        return response()->json([
            'draw' => (int) $request->input('draw', 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $log = ActivityLog::findOrFail($id);

        if (!$log->isVisibleTo($user)) {
            return response()->json(['message' => 'Akses ditolak untuk melihat detail log ini.'], 403);
        }

        $isOwner = strtolower(trim((string) ($user->role ?? ''))) === 'pemilik';

        return response()->json([
            'id' => $log->id,
            'created_at' => $log->created_at ? $log->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i:s') . ' WIB' : '-',
            'user_name' => $log->user_name,
            'user_role' => $log->user_role,
            'module' => $log->module,
            'action' => $log->action,
            'severity' => $log->severity,
            'subject_label' => $log->subject_label ?: '-',
            'description' => $log->description,
            'old_values' => $log->old_values,
            'new_values' => $log->new_values,
            'ip_address' => $isOwner ? $log->ip_address : null,
            'user_agent' => $isOwner ? $log->user_agent : null,
            'url' => $isOwner ? $log->url : null,
            'can_see_technical' => $isOwner,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $user = Auth::user();
        if (strtolower(trim((string) ($user->role ?? ''))) !== 'pemilik') {
            abort(403, 'Hanya Pemilik yang dapat mengekspor Log Activity.');
        }

        $query = ActivityLog::visibleTo($user);
        if ($request->filled('role')) {
            $query->whereRaw('LOWER(user_role) = ?', [strtolower(trim((string) $request->input('role')))]);
        }
        if ($request->filled('module')) {
            $query->where('module', strtolower(trim((string) $request->input('module'))));
        }
        if ($request->filled('severity')) {
            $query->where('severity', $request->input('severity'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $logs = $query->orderByDesc('created_at')->limit(5000)->get();

        ActivityLogger::log(
            'laporan',
            'export',
            'Mengekspor Log Activity ke CSV (' . $logs->count() . ' baris)',
            null,
            null,
            ['rows' => $logs->count()],
            'info',
            'Export CSV Log Activity'
        );

        $filename = 'log-activity-' . date('Ymd-His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($logs) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM for Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, ['Waktu', 'Pengguna', 'Role', 'Modul', 'Aksi', 'Severity', 'Target', 'Deskripsi', 'IP Address']);
            foreach ($logs as $row) {
                fputcsv($handle, [
                    $row->created_at ? $row->created_at->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : '-',
                    $row->user_name,
                    $row->user_role,
                    $row->module,
                    $row->action,
                    $row->severity,
                    $row->subject_label ?: '-',
                    $row->description,
                    $row->ip_address ?: '-',
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
