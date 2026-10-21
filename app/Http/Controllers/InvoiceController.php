<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Material;
use Carbon\Carbon;
// use DateTimeZone;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// use App\Models\KategoriBarang;
// use App\Models\Perusahaan;
use App\Models\Order;
use App\Models\Penjualan;
use App\Models\InvoiceUpdateLog;
use App\Models\PenjualanBarang;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function loadListInvoice()
    {
        Carbon::setLocale('id');
        
         DB::table('penjualan')
        ->where('approval', 'Unlock')
        ->whereNotNull('approved_at')
        ->where('approved_at', '<', now()->subHours(6))
        ->update([
            'approval' => 'Lock', // status lock
            'approved_at' => null
        ]);
        
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;

        // =========================================================================
        // 1. KONSOLIDASI CARD STATUS PEMBAYARAN (semua jenis transaksi)
        // =========================================================================
        $stats = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->selectRaw("
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? THEN 1 END) as jlh_invoice,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as total_per_tahun,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN total_pembayaran ELSE 0 END), 0) as total_lunas,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN 1 END) as lunas,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN dp ELSE 0 END), 0) as tot_dp_tahun,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_tahun,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as belum_lunas,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_bulan,
                COUNT(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as belum_lunas_month,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND status <> 'Batal' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND status <> 'Batal' THEN 1 END) as count_all_inv_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po_lunas,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Lunas' THEN 1 END) as count_all_settled_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN total_pembayaran ELSE 0 END), 0) as jumlah_po_blm_lunas,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as count_all_outstanding_po,
                COALESCE(SUM(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN sisa_pembayaran ELSE 0 END), 0) as jumlah_bb_per_bulan_po,
                COUNT(CASE WHEN jenis_pembayaran = 'PO' AND YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? AND status = 'Belum Lunas' THEN 1 END) as blm_lunas_po,
                COUNT(CASE WHEN status = 'Batal' AND YEAR(tgl_penjualan) = ? THEN 1 END) as batal,
                COALESCE(SUM(CASE WHEN status = 'Batal' AND YEAR(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as jumlah_batal,
                COALESCE(SUM(CASE WHEN YEAR(tgl_penjualan) = ? AND MONTH(tgl_penjualan) = ? THEN total_pembayaran ELSE 0 END), 0) as total_per_bulan,
                COALESCE(SUM(total_pembayaran), 0) as jumlah_invoice
            ", [
                $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $yearNow,
                $yearNow, $monthNow, $yearNow, $monthNow,
                $yearNow, $yearNow, $yearNow, $yearNow, $yearNow, $monthNow, $yearNow, $monthNow,
                $yearNow, $yearNow, $yearNow, $monthNow
            ])
            ->first();

        $jlhInvoice = $stats->jlh_invoice ?? 0;
        $totalPerTahun = $stats->total_per_tahun ?? 0;
        $jumlahPerTahun = number_format($totalPerTahun, 0, ',', '.');
        $lunas = $stats->lunas ?? 0;
        $totalLunasThn = number_format(($stats->total_lunas ?? 0) + ($stats->tot_dp_tahun ?? 0), 0, ',', '.');
        $belumLunas = $stats->belum_lunas ?? 0;
        $jumlahBBPerTahun = number_format($stats->jumlah_bb_per_tahun ?? 0, 0, ',', '.');
        $belumLunasMonth = $stats->belum_lunas_month ?? 0;
        $jumlahBBPerBulan = number_format($stats->jumlah_bb_per_bulan ?? 0, 0, ',', '.');

        $jumlahPO = number_format($stats->jumlah_po ?? 0, 0, ',', '.');
        $countAllInvPO = $stats->count_all_inv_po ?? 0;
        $jumlahPOLunas = number_format($stats->jumlah_po_lunas ?? 0, 0, ',', '.');
        $countAllSettledPO = $stats->count_all_settled_po ?? 0;
        $jumlahPOBlmLunas = number_format($stats->jumlah_po_blm_lunas ?? 0, 0, ',', '.');
        $countAllOutstandingPO = $stats->count_all_outstanding_po ?? 0;
        $jumlahBBPerBulanPO = number_format($stats->jumlah_bb_per_bulan_po ?? 0, 0, ',', '.');
        $blmLunasPO = $stats->blm_lunas_po ?? 0;

        $batal = $stats->batal ?? 0;
        $jumlahBatal = number_format($stats->jumlah_batal ?? 0, 0, ',', '.');
        $totalPerBulan = $stats->total_per_bulan ?? 0;
        $jumlahPerBulan = number_format($totalPerBulan, 0, ',', '.');
        $jumlahInvoice = number_format($stats->jumlah_invoice ?? 0, 0, ',', '.');

        // =========================================================================
        // 4. DATA INVOICE (Eager load user & penjualanBarang)
        // =========================================================================
        $jenisInvoiceList = Invoice::orderBy('nama_invoice')->get();
        $invoiceMap = $jenisInvoiceList->keyBy('id');
        $materialsMap = Material::all()->keyBy('id');

        // Server-Side DataTables: data baris dimuat via AJAX agar render delay < 1s
        $penjualan = collect();

        // =========================================================================
        // 5. PERHITUNGAN PPN & PPH TAHUN INI
        // =========================================================================
        $dataPajak = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->whereYear('tgl_penjualan', $yearNow)
            ->where('status', '!=', 'Batal')
            ->select('ppn', 'diskon', 'potongan', 'total_pembayaran', 'total_harga')
            ->get();

        $ppnTotal = 0;
        $ppnTotalCount = 0;
        $ppn01 = 0;
        $ppn01Count = 0;
        $ppn02 = 0;
        $ppn02Count = 0;
        $ppn03 = 0;
        $ppn03Count = 0;
        $ppn04 = 0;
        $ppn04Count = 0;
        $pphTotal = 0;
        $pphTotalCount = 0;

        foreach ($dataPajak as $inv) {
            $hasPpn = !empty($inv->ppn) && (float)$inv->ppn > 0;
            $hasDiskon = !empty($inv->diskon) && (float)$inv->diskon > 0;
            $hasPotongan = !empty($inv->potongan) && (float)$inv->potongan > 0;
            $nominalPpn = 0;

            if ($hasPpn) {
                $nominalPpn = ($inv->ppn / 100) * ($inv->total_harga ?? 0);
            } elseif (!$hasDiskon && !$hasPotongan && $inv->total_pembayaran > $inv->total_harga && $inv->total_harga > 0) {
                $nominalPpn = $inv->total_pembayaran - $inv->total_harga;
                $hasPpn = true;
            }

            if ($hasPpn && $nominalPpn > 0) {
                $ppnTotal += $nominalPpn;
                $ppnTotalCount++;

                $kode = $inv->kode_ppn ?? '01';
                if ($kode == '01') {
                    $ppn01 += $nominalPpn;
                    $ppn01Count++;
                } elseif ($kode == '02') {
                    $ppn02 += $nominalPpn;
                    $ppn02Count++;
                } elseif ($kode == '03') {
                    $ppn03 += $nominalPpn;
                    $ppn03Count++;
                } elseif ($kode == '04') {
                    $ppn04 += $nominalPpn;
                    $ppn04Count++;
                }
            }
        }

        $availableYears = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->selectRaw('DISTINCT YEAR(tgl_penjualan) as year')
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();
        if (empty($availableYears)) {
            $availableYears = [$yearNow, $yearNow - 1];
        } else {
            if (!in_array($yearNow, $availableYears)) {
                array_unshift($availableYears, $yearNow);
            }
            rsort($availableYears);
        }

        return view('pages.invoices.daftar-invoice', compact(
            'penjualan', 'jlhInvoice', 'lunas', 'belumLunas', 'batal', 'totalLunasThn',
            'jumlahBatal', 'jumlahInvoice', 'jumlahBBPerTahun', 'jumlahBBPerBulan',
            'jumlahPerBulan', 'jumlahPerTahun', 'belumLunasMonth', 'jumlahPO', 'jumlahPOLunas',
            'jumlahPOBlmLunas', 'countAllInvPO', 'blmLunasPO', 'countAllOutstandingPO',
            'countAllSettledPO', 'jumlahBBPerBulanPO',
            'ppnTotal', 'ppnTotalCount', 'ppn01', 'ppn01Count', 'ppn02', 'ppn02Count',
            'ppn03', 'ppn03Count', 'ppn04', 'ppn04Count', 'pphTotal', 'pphTotalCount', 'availableYears',
            'jenisInvoiceList', 'materialsMap'
        ));
    }

    public function getDatatableInvoices(Request $request)
    {
        Carbon::setLocale('id');

        $currentUser = Auth::user();
        $role = $currentUser->role ?? '';
        $isOwner = $role === 'Pemilik';
        $isAdmin = $role === 'Admin';
        $waNumber = '628116029999';
        $waNumber2 = '628116179999';
        $waNumberLunas1 = '628116179999';
        $waNumberLunas2 = '628116029999';

        $jenisInvoiceList = Invoice::orderBy('nama_invoice')->get();
        $invoiceMap = $jenisInvoiceList->keyBy('id');
        $materialsMap = Material::all()->keyBy('id');

        $baseQuery = Penjualan::whereNull('deleted_at');
        $recordsTotal = (clone $baseQuery)->count();

        $query = (clone $baseQuery)
            ->select([
                'id',
                'invoice',
                'nomor_invoice',
                'customer',
                'perusahaan',
                'no_telepon',
                'tgl_penjualan',
                'status',
                'approval',
                'dp',
                'total_pembayaran',
                'total_harga',
                'sisa_pembayaran',
                'jenis_pembayaran',
                'order_by',
                'admin',
                'alasan_batal',
                'no_rek',
                'created_at',
                'updated_at'
            ])
            ->with([
                'user:id,nama',
                'penjualanBarang:id,penjualan_id,deskripsi_item,material_id,material_qty,material_panjang,material_lebar'
            ]);

        // Filter Jenis Invoice
        if ($request->filled('jenis')) {
            $query->where('invoice', $request->input('jenis'));
        }

        // Search global
        $searchValue = trim($request->input('search.value', ''));
        if ($searchValue !== '') {
            $query->where(function ($q) use ($searchValue) {
                $q->where('nomor_invoice', 'like', "%{$searchValue}%")
                    ->orWhere('customer', 'like', "%{$searchValue}%")
                    ->orWhere('perusahaan', 'like', "%{$searchValue}%")
                    ->orWhere('no_telepon', 'like', "%{$searchValue}%")
                    ->orWhere('order_by', 'like', "%{$searchValue}%")
                    ->orWhere('status', 'like', "%{$searchValue}%")
                    ->orWhere('approval', 'like', "%{$searchValue}%")
                    ->orWhere('jenis_pembayaran', 'like', "%{$searchValue}%")
                    ->orWhere('alasan_batal', 'like', "%{$searchValue}%");
            });
        }

        $recordsFiltered = (clone $query)->count();

        // Ordering
        $columnsMap = [
            1 => 'nomor_invoice',
            2 => 'customer',
            3 => 'no_telepon',
            4 => 'tgl_penjualan',
            5 => 'status',
            6 => 'approval',
            9 => 'alasan_batal',
            10 => 'dp',
            11 => 'total_pembayaran',
            12 => 'jenis_pembayaran',
            13 => 'order_by',
            14 => 'admin',
        ];

        $orderColIndex = $request->input('order.0.column');
        $orderDir = strtolower($request->input('order.0.dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        if ($orderColIndex !== null && isset($columnsMap[$orderColIndex])) {
            $query->orderBy($columnsMap[$orderColIndex], $orderDir);
        } else {
            $query->orderByDesc('tgl_penjualan')->orderByDesc('id');
        }

        // Paging
        $start = max(0, (int)$request->input('start', 0));
        $length = (int)$request->input('length', 25);
        if ($length > 0) {
            $query->skip($start)->take($length);
        }

        $penjualan = $query->get();
        $data = [];

        foreach ($penjualan as $idx => $inv) {
            $invType = $invoiceMap->get($inv->invoice);
            $jenisInvoiceNama = $invType ? $invType->nama_invoice : '-';

            // 1. Col Invoice ID (with chevron expand button)
            $htmlInvoice = '<div class="tokabe-col-inv">'
                . '<button type="button" class="tokabe-row-toggle" aria-label="Buka Rincian" title="Lihat rincian lengkap">'
                . '<i class="las la-angle-right"></i>'
                . '</button>'
                . '<span class="tokabe-inv-code">' . e($inv->nomor_invoice) . '</span>'
                . '</div>';

            // 2. Col Pelanggan (Bold uppercase)
            $namaUtama = (!empty($inv->perusahaan) && $inv->perusahaan !== '----') ? $inv->perusahaan : $inv->customer;
            $subNama = (!empty($inv->perusahaan) && $inv->perusahaan !== '----' && strcasecmp($inv->perusahaan, $inv->customer) !== 0) ? $inv->customer : '';
            $htmlPelanggan = '<div class="tokabe-customer-wrap" title="' . e($inv->customer . ($inv->perusahaan ? ' - ' . $inv->perusahaan : '')) . '">'
                . '<span class="tokabe-customer-name">' . e($namaUtama) . '</span>';
            if (!empty($subNama)) {
                $htmlPelanggan .= '<div class="tokabe-customer-sub">' . e($subNama) . '</div>';
            }
            $htmlPelanggan .= '</div>';

            // 3. Col Telepon (Spaced 4-4-4 or dashes)
            $phoneClean = preg_replace('/[^0-9]/', '', $inv->no_telepon ?? '');
            if (empty($phoneClean) || $phoneClean === '0') {
                $htmlTelepon = '<span class="tokabe-phone-empty">---- --</span>';
            } else {
                if (substr($phoneClean, 0, 2) === '62') {
                    $phoneClean = '0' . substr($phoneClean, 2);
                }
                $phoneFormatted = trim(preg_replace('/(\d{4})(?=\d)/', '$1 ', $phoneClean));
                $htmlTelepon = '<span class="tokabe-phone">' . e($phoneFormatted) . '</span>';
            }

            // 4. Col Tanggal (Date + Indonesian "Diperbarui: ...")
            $formattedTgl = Carbon::parse($inv->tgl_penjualan)->format('d M Y');
            $htmlTgl = '<div class="tokabe-date-main">' . e($formattedTgl) . '</div>';
            if ($inv->updated_at && $inv->created_at && $inv->updated_at != $inv->created_at) {
                $formattedUpdate = Carbon::parse($inv->updated_at)->addHour(7)->format('d M Y H:i');
                $htmlTgl .= '<div class="tokabe-date-sub">Diperbarui: ' . e($formattedUpdate) . '</div>';
            }

            // 5. Col Status (Pill with dot indicator)
            if ($inv->status === 'Lunas') {
                $htmlStatus = '<span class="tokabe-pill tokabe-pill-lunas"><span class="tokabe-pill-dot">●</span> Lunas</span>';
            } elseif ($inv->status === 'Belum Lunas') {
                $htmlStatus = '<span class="tokabe-pill tokabe-pill-belum"><span class="tokabe-pill-dot">●</span> Belum Lunas</span>';
            } else {
                $htmlStatus = '<span class="tokabe-pill tokabe-pill-batal"><span class="tokabe-pill-dot">●</span> ' . e($inv->status) . '</span>';
            }

            // 6. Col Approval (Pill with lock icon)
            if ($inv->approval === 'Lock') {
                $htmlApproval = '<span class="tokabe-pill tokabe-pill-lock"><i class="las la-lock"></i> Lock</span>';
            } elseif ($inv->approval === 'Unlock') {
                $htmlApproval = '<span class="tokabe-pill tokabe-pill-unlock"><i class="las la-lock-open"></i> Unlock</span>';
            } else {
                $htmlApproval = '<span class="tokabe-pill tokabe-pill-belum"><i class="las la-lock"></i> ' . e($inv->approval) . '</span>';
            }

            // 7. Col Deskripsi (Collapsed max 2 items, expanded all items)
            $items = $inv->penjualanBarang ?? collect();
            $totalItems = count($items);
            $htmlDeskripsi = '<div class="tokabe-desc-wrap">';
            if ($totalItems === 0) {
                $htmlDeskripsi .= '<span class="text-muted fs-12">-</span>';
            } else {
                $htmlDeskripsi .= '<div class="tokabe-desc-collapsed">';
                foreach ($items as $pIdx => $pb) {
                    if ($pIdx < 2) {
                        $htmlDeskripsi .= '<div class="tokabe-desc-item" title="' . e($pb->deskripsi_item) . '">- ' . e($pb->deskripsi_item) . '</div>';
                    }
                }
                if ($totalItems > 2) {
                    $htmlDeskripsi .= '<div class="tokabe-desc-more" role="button" title="Klik untuk melebarkan rincian">+ ' . ($totalItems - 2) . ' item lagi</div>';
                }
                $htmlDeskripsi .= '</div>';

                if ($totalItems > 2) {
                    $htmlDeskripsi .= '<div class="tokabe-desc-expanded" style="display: none;">';
                    foreach ($items as $pb) {
                        $htmlDeskripsi .= '<div class="tokabe-desc-item" title="' . e($pb->deskripsi_item) . '">- ' . e($pb->deskripsi_item) . '</div>';
                    }
                    $htmlDeskripsi .= '<div class="tokabe-desc-less" role="button" title="Klik untuk mengecilkan"><i class="las la-angle-up"></i> Sembunyikan</div>';
                    $htmlDeskripsi .= '</div>';
                }
            }
            $htmlDeskripsi .= '</div>';

            // 8. Col Bahan Material (Bahan Material)
            $hasMaterial = false;
            $materialItems = [];
            if ($inv->penjualanBarang) {
                foreach ($inv->penjualanBarang as $pb) {
                    $rawMatId = $pb->material_id;
                    $matIds = (!empty($rawMatId) && ($rawMatId[0] === '[' || $rawMatId[0] === '{')) ? json_decode($rawMatId, true) : ($rawMatId ? [$rawMatId] : []);
                    if (!is_array($matIds)) { $matIds = [$rawMatId]; }

                    $rawMatQty = $pb->material_qty;
                    $matQtys = (!empty($rawMatQty) && ($rawMatQty[0] === '[' || $rawMatQty[0] === '{')) ? json_decode($rawMatQty, true) : ($rawMatQty ? [$rawMatQty] : []);
                    if (!is_array($matQtys)) { $matQtys = [$rawMatQty]; }

                    $rawMatPanjang = $pb->material_panjang;
                    $matPanjangs = (!empty($rawMatPanjang) && ($rawMatPanjang[0] === '[' || $rawMatPanjang[0] === '{')) ? json_decode($rawMatPanjang, true) : ($rawMatPanjang ? [$rawMatPanjang] : []);
                    if (!is_array($matPanjangs)) { $matPanjangs = [$rawMatPanjang]; }

                    $rawMatLebar = $pb->material_lebar;
                    $matLebars = (!empty($rawMatLebar) && ($rawMatLebar[0] === '[' || $rawMatLebar[0] === '{')) ? json_decode($rawMatLebar, true) : ($rawMatLebar ? [$rawMatLebar] : []);
                    if (!is_array($matLebars)) { $matLebars = [$rawMatLebar]; }

                    foreach ($matIds as $mIdx => $mId) {
                        $mat = $materialsMap->get($mId);
                        if ($mat) {
                            $hasMaterial = true;
                            $materialItems[] = [
                                'jenis' => $mat->jenis_material,
                                'qty' => $matQtys[$mIdx] ?? 0,
                                'satuan' => $mat->satuan,
                                'panjang' => $matPanjangs[$mIdx] ?? null,
                                'lebar' => $matLebars[$mIdx] ?? null
                            ];
                        }
                    }
                }
            }

            $totalMaterials = count($materialItems);
            $htmlMaterial = '<div class="tokabe-desc-wrap tokabe-mat-wrap">';
            if (!$hasMaterial) {
                $htmlMaterial .= '<span class="text-muted" style="color: #64748b !important; font-size: 12px;">-</span>';
            } else {
                $htmlMaterial .= '<div class="tokabe-desc-collapsed">';
                foreach ($materialItems as $mIdx => $mItem) {
                    if ($mIdx < 2) {
                        $dimText = (!empty($mItem['panjang']) && !empty($mItem['lebar'])) ? ' <span class="text-muted" style="font-size: 11px;">(' . e($mItem['panjang']) . '&times;' . e($mItem['lebar']) . ')</span>' : '';
                        $htmlMaterial .= '<div class="tokabe-desc-item" title="' . e($mItem['jenis']) . '"><span class="tokabe-mat-name">- ' . e($mItem['jenis']) . '</span>: <b class="text-info" style="font-weight: 500;">' . e($mItem['qty']) . ' ' . e($mItem['satuan']) . '</b>' . $dimText . '</div>';
                    }
                }
                if ($totalMaterials > 2) {
                    $htmlMaterial .= '<div class="tokabe-desc-more" role="button" title="Klik untuk melebarkan rincian material">+ ' . ($totalMaterials - 2) . ' material lagi</div>';
                }
                $htmlMaterial .= '</div>';

                if ($totalMaterials > 2) {
                    $htmlMaterial .= '<div class="tokabe-desc-expanded" style="display: none;">';
                    foreach ($materialItems as $mItem) {
                        $dimText = (!empty($mItem['panjang']) && !empty($mItem['lebar'])) ? ' <span class="text-muted" style="font-size: 11px;">(' . e($mItem['panjang']) . '&times;' . e($mItem['lebar']) . ')</span>' : '';
                        $htmlMaterial .= '<div class="tokabe-desc-item" title="' . e($mItem['jenis']) . '"><span class="tokabe-mat-name">- ' . e($mItem['jenis']) . '</span>: <b class="text-info" style="font-weight: 500;">' . e($mItem['qty']) . ' ' . e($mItem['satuan']) . '</b>' . $dimText . '</div>';
                    }
                    $htmlMaterial .= '<div class="tokabe-desc-less" role="button" title="Klik untuk mengecilkan"><i class="las la-angle-up"></i> Sembunyikan</div>';
                    $htmlMaterial .= '</div>';
                }
            }
            $htmlMaterial .= '</div>';

            // 9. Col Alasan Batal
            if (!empty($inv->alasan_batal) && trim($inv->alasan_batal) !== '-') {
                $htmlAlasan = '<div class="tokabe-alasan-wrap" title="' . e($inv->alasan_batal) . '"><span class="tokabe-pill-alasan"><i class="las la-exclamation-circle me-1"></i>' . e(Str::limit($inv->alasan_batal, 35)) . '</span></div>';
            } else {
                $htmlAlasan = '<span class="text-muted" style="color: #64748b !important;">-</span>';
            }

            // 10. Col Panjar
            $htmlPanjar = '<span class="tokabe-num">Rp ' . number_format($inv->dp ?? 0, 0, ',', '.') . '</span>';

            // 11. Col Total (Bold white)
            $htmlTotal = '<span class="tokabe-num-bold">Rp ' . number_format($inv->total_pembayaran ?? 0, 0, ',', '.') . '</span>';

            // 12. Col Tipe Pembayaran (Pill with dot indicator)
            $jenisBayar = $inv->jenis_pembayaran ?: '-';
            if (stripos($jenisBayar, 'DP') !== false || stripos($jenisBayar, 'Belum') !== false) {
                $htmlTipePembayaran = '<span class="tokabe-pill tokabe-pill-dp"><span class="tokabe-pill-dot">●</span> ' . e($jenisBayar) . '</span>';
            } elseif (stripos($jenisBayar, 'Transfer') !== false) {
                $htmlTipePembayaran = '<span class="tokabe-pill tokabe-pill-transfer"><span class="tokabe-pill-dot">●</span> ' . e($jenisBayar) . '</span>';
            } elseif (stripos($jenisBayar, 'Cash') !== false || stripos($jenisBayar, 'Lunas') !== false) {
                $htmlTipePembayaran = '<span class="tokabe-pill tokabe-pill-lunas"><span class="tokabe-pill-dot">●</span> ' . e($jenisBayar) . '</span>';
            } else {
                $htmlTipePembayaran = '<span class="tokabe-pill tokabe-pill-batal"><span class="tokabe-pill-dot">●</span> ' . e($jenisBayar) . '</span>';
            }

            // 13. Col Order By
            $orderByVal = trim($inv->order_by ?? '');
            if (!empty($orderByVal) && $orderByVal !== '-') {
                $htmlOrderBy = '<span class="tokabe-pill-orderby"><i class="las la-shopping-cart me-1 text-primary"></i>' . e($orderByVal) . '</span>';
            } else {
                $htmlOrderBy = '<span class="text-muted" style="color: #64748b !important;">-</span>';
            }

            // 14. Col Admin
            $htmlAdmin = '<span class="tokabe-admin-text">' . e($inv->user ? $inv->user->nama : 'Tidak Diketahui') . '</span>';

            // WhatsApp link for customer
            $no_hp_cust = $inv->no_telepon ?? '';
            $no_hp_cust = preg_replace('/[^0-9]/', '', $no_hp_cust);
            if (substr($no_hp_cust, 0, 1) === '0') {
                $no_hp_cust = '62' . substr($no_hp_cust, 1);
            }

            $link_khusus_customer = URL::temporarySignedRoute(
                'invoice.public_download',
                now()->addDays(7),
                ['id' => $inv->id]
            );

            $pesan_cust = "Invoice : " . $inv->nomor_invoice . "\n";
            $pesan_cust .= "Link Download Invoice (Berlaku 7 Hari):\n";
            $pesan_cust .= $link_khusus_customer . "\n\n";
            $pesan_cust .= "Total Rp " . number_format($inv->total_harga ?? 0, 0, ',', '.') . "\n\n";

            if ($inv->status !== 'Lunas' && $inv->sisa_pembayaran > 0) {
                $pesan_cust .= "Mohon transfer ke:\n";
                $pesan_cust .= $inv->norek_text . "\n";
                $pesan_cust .= "**\n\n";
                $pesan_cust .= "Apabila sudah melakukan transaksi pembayaran mohon dikirim bukti transfernya";
            } else {
                $pesan_cust .= "Status : Lunas\n";
                $pesan_cust .= "**\n\n";
                $pesan_cust .= "Terima kasih,\n";
                $pesan_cust .= "ibekami.id";
            }

            $waLink = '#';
            $waLink2 = '#';
            $waLinkLunas1 = '#';
            $waLinkLunas2 = '#';
            $waLinkBatal1 = '#';
            $waLinkBatal2 = '#';
            if ($isAdmin) {
                $msg = urlencode("Halo, saya ingin meminta approval untuk membuka akses invoice *#{$inv->nomor_invoice}* atas nama *{$inv->customer}*. Mohon untuk segera ditinjau 🙏 \n\nKlik link berikut untuk membuka halaman approval:\n" . url("/invoice-approval/{$inv->id}"));
                $msgLunas = urlencode("Halo, saya ingin Request perubahan status pelunasan untuk invoice *#{$inv->nomor_invoice}* atas nama *{$inv->customer}*. Mohon untuk segera ditinjau 🙏 \n\nKlik link berikut untuk membuka halaman ubah status pelunasan:\n" . url("/invoice-pelunasan/{$inv->id}"));
                $msgBatal = urlencode("Halo Owner, saya meminta persetujuan untuk membatalkan invoice *#{$inv->nomor_invoice}* atas nama *{$inv->customer}*. Mohon ditinjau dan diproses 🙏\n\nBuka invoice: " . url("/invoice-approval/{$inv->id}"));
                $waLink = "https://wa.me/{$waNumber}?text={$msg}";
                $waLink2 = "https://wa.me/{$waNumber2}?text={$msg}";
                $waLinkLunas1 = "https://wa.me/{$waNumberLunas1}?text={$msgLunas}";
                $waLinkLunas2 = "https://wa.me/{$waNumberLunas2}?text={$msgLunas}";
                $waLinkBatal1 = "https://wa.me/{$waNumber}?text={$msgBatal}";
                $waLinkBatal2 = "https://wa.me/{$waNumber2}?text={$msgBatal}";
            }

            // 12. Col Aksi (Sleek 3-dots button ⋮)
            $htmlAksi = '<div class="dropdown text-center tokabe-action-dropdown">';
            $htmlAksi .= '<button class="btn btn-tokabe-action-dots" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="window" data-bs-popper-config=\'{"strategy":"fixed"}\' title="Menu Aksi">';
            $htmlAksi .= '<i class="las la-ellipsis-v"></i>';
            $htmlAksi .= '</button>';
            $htmlAksi .= '<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg">';
            $htmlAksi .= '<li><a class="dropdown-item" href="' . url('cetak/' . $inv->id . '?type=asli') . '" target="_blank"><i class="las la-print me-2 text-primary"></i>Cetak Nota (ASLI)</a></li>';
            $htmlAksi .= '<li><a class="dropdown-item" href="' . url('cetak/' . $inv->id . '?type=copy') . '" target="_blank"><i class="las la-print me-2 text-danger"></i>Cetak Nota (COPY)</a></li>';
            $htmlAksi .= '<li><a class="dropdown-item" href="' . url('view/download/' . $inv->id) . '" target="_blank"><i class="las la-file-download me-2 text-info"></i>Download Invoice</a></li>';

            if (!empty($no_hp_cust)) {
                $htmlAksi .= '<li><a class="dropdown-item text-success" href="https://wa.me/' . $no_hp_cust . '?text=' . urlencode($pesan_cust) . '" target="_blank"><i class="lab la-whatsapp me-2"></i>Kirim Invoice (WA)</a></li>';
            }

            if ($isOwner && $inv->approval === 'Unlock') {
                $htmlAksi .= '<li><a class="dropdown-item" href="' . url('ubah-status-lock/' . $inv->id) . '"><i class="las la-lock me-2 text-warning"></i>Lock Invoice</a></li>';
            }

            if ($isAdmin && $inv->approval !== 'Unlock') {
                $htmlAksi .= '<li><a class="dropdown-item text-warning fw-semibold" href="' . $waLink . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Unlock (Owner 1)</a></li>';
                $htmlAksi .= '<li><a class="dropdown-item text-warning fw-semibold" href="' . $waLink2 . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Unlock (Owner 2)</a></li>';
            }

            $htmlAksi .= '<li><a class="dropdown-item btn-buat-spk" href="#" data-id="' . $inv->id . '" data-bs-toggle="modal" data-bs-target="#buatSpkModal"><i class="las la-clipboard-list me-2 text-primary"></i>Buat SPK Baru</a></li>';

            if ($isAdmin && $inv->status !== 'Lunas') {
                $htmlAksi .= '<li><a class="dropdown-item text-warning fw-semibold" href="' . $waLinkLunas1 . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Pelunasan (Owner 1)</a></li>';
                $htmlAksi .= '<li><a class="dropdown-item text-warning fw-semibold" href="' . $waLinkLunas2 . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Pelunasan (Owner 2)</a></li>';
            }

            if ($isAdmin) {
                if ($inv->status !== 'Batal') {
                    $htmlAksi .= '<li><a class="dropdown-item text-danger fw-semibold" href="' . $waLinkBatal1 . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Batal (Owner 1)</a></li>';
                    $htmlAksi .= '<li><a class="dropdown-item text-danger fw-semibold" href="' . $waLinkBatal2 . '" target="_blank"><i class="lab la-whatsapp me-2 text-success"></i>Request Batal (Owner 2)</a></li>';
                }
            }

            $canManage = !$isAdmin || $inv->approval === 'Unlock';
            if ($canManage) {
                $htmlAksi .= '<li><a class="dropdown-item" href="' . url('editInvoice/' . $inv->id . '/edit') . '"><i class="las la-pen me-2 text-info"></i>Edit Invoice</a></li>';
                $htmlAksi .= '<li><a class="dropdown-item btn-update-log" href="#" data-id="' . $inv->id . '" data-bs-toggle="modal" data-bs-target="#updateLogModal"><i class="las la-history me-2 text-secondary"></i>Riwayat Log</a></li>';
                if ($inv->status !== 'Batal') {
                    $htmlAksi .= '<li><button type="button" class="dropdown-item text-danger" onclick="confirmBatal(\'' . $inv->id . '\', \'' . addslashes(e($inv->nomor_invoice)) . '\')"><i class="las la-times-circle me-2"></i>Invoice Batal</button></li>';
                }
            }
            $htmlAksi .= '</ul></div>';

            $data[] = [
                'DT_RowId' => 'row_' . $inv->id,
                'DT_RowAttr' => [
                    'data-jenis-id' => $inv->invoice ?? '',
                    'data-jenis-nama' => $jenisInvoiceNama
                ],
                0 => $start + $idx + 1,
                1 => $htmlInvoice,
                2 => $htmlPelanggan,
                3 => $htmlTelepon,
                4 => $htmlTgl,
                5 => $htmlStatus,
                6 => $htmlApproval,
                7 => $htmlDeskripsi,
                8 => $htmlMaterial,
                9 => $htmlAlasan,
                10 => $htmlPanjar,
                11 => $htmlTotal,
                12 => $htmlTipePembayaran,
                13 => $htmlOrderBy,
                14 => $htmlAdmin,
                15 => $htmlAksi,
            ];
        }

        return response()->json([
            'draw' => (int)$request->input('draw', 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function getCardsData(Request $request)
    {
        $timeframe = $request->query('timeframe', 'year');
        $mode = $request->query('mode');
        $date = $request->query('date');
        $month = $request->query('month');
        $year = $request->query('year');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        Carbon::setLocale('id');
        $now = Carbon::now(new \DateTimeZone('Asia/Jakarta'));
        $yearNow = $now->year;
        $monthNow = $now->month;

        $query = Penjualan::query();
        $card4Query = Penjualan::query();

        $periodLabel = '';
        $card4MonthName = '';

        if ($timeframe === 'today') {
            $today = $now->toDateString();
            $query->whereDate('tgl_penjualan', $today);
            $periodLabel = 'HARI INI';
            
            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'week') {
            $startOfWeek = $now->copy()->startOfWeek()->format('Y-m-d 00:00:00');
            $endOfWeek = $now->copy()->endOfWeek()->format('Y-m-d 23:59:59');
            $query->whereBetween('tgl_penjualan', [$startOfWeek, $endOfWeek]);
            $periodLabel = 'MINGGU INI';

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'month') {
            $query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $periodLabel = 'BULAN ' . strtoupper($now->translatedFormat('F Y'));

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F Y'));
        } elseif ($timeframe === 'year') {
            $query->whereYear('tgl_penjualan', $yearNow);
            $periodLabel = 'TAHUN ' . $yearNow;

            $card4Query->whereYear('tgl_penjualan', $yearNow)->whereMonth('tgl_penjualan', $monthNow);
            $card4MonthName = strtoupper($now->translatedFormat('F'));
        } elseif ($timeframe === 'last_year') {
            $lastYear = $yearNow - 1;
            $query->whereYear('tgl_penjualan', $lastYear);
            $periodLabel = 'TAHUN ' . $lastYear;

            $card4Query->whereYear('tgl_penjualan', $lastYear)->whereMonth('tgl_penjualan', 12);
            $card4MonthName = 'DESEMBER ' . $lastYear;
        } elseif ($timeframe === 'custom') {
            if ($mode === 'date' && $date) {
                $parsedDate = Carbon::parse($date);
                $query->whereDate('tgl_penjualan', $parsedDate->toDateString());
                $periodLabel = 'TANGGAL ' . $parsedDate->format('d/m/Y');

                $card4Query->whereYear('tgl_penjualan', $parsedDate->year)->whereMonth('tgl_penjualan', $parsedDate->month);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F Y'));
            } elseif ($mode === 'month' && $month && $year) {
                $query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $month);
                $parsedDate = Carbon::createFromDate($year, $month, 1);
                $periodLabel = 'BULAN ' . strtoupper($parsedDate->translatedFormat('F Y'));

                $card4Query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $month);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F Y'));
            } elseif ($mode === 'year' && $year) {
                $query->whereYear('tgl_penjualan', $year);
                $periodLabel = 'TAHUN ' . $year;

                $card4Month = ($year == $yearNow) ? $monthNow : 12;
                $card4Query->whereYear('tgl_penjualan', $year)->whereMonth('tgl_penjualan', $card4Month);
                $parsedDate = Carbon::createFromDate($year, $card4Month, 1);
                $card4MonthName = strtoupper($parsedDate->translatedFormat('F') . ($year != $yearNow ? ' ' . $year : ''));
            } elseif ($mode === 'range' && $startDate && $endDate) {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                $query->whereBetween('tgl_penjualan', [$start->format('Y-m-d 00:00:00'), $end->format('Y-m-d 23:59:59')]);
                $periodLabel = $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');

                $card4Query->whereYear('tgl_penjualan', $end->year)->whereMonth('tgl_penjualan', $end->month);
                $card4MonthName = strtoupper($end->translatedFormat('F Y'));
            }
        }

        // =========================================================================
        // KARTU STATUS PEMBAYARAN SEMUA INVOICE
        // =========================================================================
        // Semua transaksi mengikuti status pembayaran yang sama, termasuk histori PO.
        $queryNonPo = clone $query;
        $card4QueryNonPo = clone $card4Query;

        // Kartu 1: Total invoice
        $totalNominalNonPo = (clone $queryNonPo)->sum('total_pembayaran');
        $jlhInvoiceNonPo = (clone $queryNonPo)->count();
        $valCard1 = number_format($totalNominalNonPo, 0, ',', '.');

        // Kartu 2: Invoice terbayar
        $dataLunasNonPo = (clone $queryNonPo)->where('status', 'Lunas');
        $dataBlmLunasNonPo = (clone $queryNonPo)->where('status', 'Belum Lunas');
        $totLunasNonPo = (clone $dataLunasNonPo)->sum('total_pembayaran');
        $totDpNonPo = (clone $dataBlmLunasNonPo)->sum('dp');
        $lunasNonPo = (clone $dataLunasNonPo)->count();
        $totalLunasThnVal = $totLunasNonPo + $totDpNonPo;
        $valCard2 = number_format($totalLunasThnVal, 0, ',', '.');

        // Non-PO Card 3: Belum Terbayar Non-PO Periode
        $belumLunasNonPo = (clone $dataBlmLunasNonPo)->count();
        $totalBBNonPo = (clone $dataBlmLunasNonPo)->sum('sisa_pembayaran');
        $valCard3 = number_format($totalBBNonPo, 0, ',', '.');

        // Non-PO Card 4: Belum Terbayar Non-PO Bulan
        $dataBlmLunasMonthNonPo = (clone $card4QueryNonPo)->where('status', 'Belum Lunas');
        $belumLunasMonthNonPo = (clone $dataBlmLunasMonthNonPo)->count();
        $totalBBMonthNonPo = (clone $dataBlmLunasMonthNonPo)->sum('sisa_pembayaran');
        $valCard4 = number_format($totalBBMonthNonPo, 0, ',', '.');

        // =========================================================================
        // CARD PO (Purchase Order - jenis_pembayaran == 'PO')
        // =========================================================================
        $queryPo = (clone $query)->where('jenis_pembayaran', 'PO');
        $card4QueryPo = (clone $card4Query)->where('jenis_pembayaran', 'PO');

        // PO Card 1: Jumlah Seluruh PO
        if ($timeframe === 'year' || empty($timeframe)) {
            $totalNominalPo = Penjualan::where('jenis_pembayaran', 'PO')->where('status', '<>', 'Batal')->sum('total_pembayaran');
            $countInvPo = Penjualan::where('jenis_pembayaran', 'PO')->where('status', '<>', 'Batal')->count();
        } else {
            $totalNominalPo = (clone $queryPo)->where('status', '<>', 'Batal')->sum('total_pembayaran');
            $countInvPo = (clone $queryPo)->where('status', '<>', 'Batal')->count();
        }
        $valPo1 = number_format($totalNominalPo, 0, ',', '.');

        // PO Card 2: PO Lunas Periode
        $dataLunasPo = (clone $queryPo)->where('status', 'Lunas');
        $valPo2 = number_format((clone $dataLunasPo)->sum('total_pembayaran'), 0, ',', '.');
        $countPo2 = (clone $dataLunasPo)->count();

        // PO Card 3: PO Belum Lunas Periode
        $dataBlmLunasPo = (clone $queryPo)->where('status', 'Belum Lunas');
        $valPo3 = number_format((clone $dataBlmLunasPo)->sum('total_pembayaran'), 0, ',', '.');
        $countPo3 = (clone $dataBlmLunasPo)->count();

        // PO Card 4: PO Belum Lunas Bulan
        $dataBlmLunasMonthPo = (clone $card4QueryPo)->where('status', 'Belum Lunas');
        $valPo4 = number_format((clone $dataBlmLunasMonthPo)->sum('sisa_pembayaran'), 0, ',', '.');
        $countPo4 = (clone $dataBlmLunasMonthPo)->count();

        // Card 5: Batal
        $dataBatal = (clone $query)->where('status', 'Batal');
        $batal = (clone $dataBatal)->count();
        $totalBatal = (clone $dataBatal)->sum('total_pembayaran');
        $valCard5 = number_format($totalBatal, 0, ',', '.');

        // Pajak PPN & PPh
        $dataPajak = (clone $query)->where('status', '!=', 'Batal')
            ->select('ppn', 'diskon', 'potongan', 'total_pembayaran', 'total_harga')
            ->get();
        $ppnTotal = 0;
        $ppnTotalCount = 0;
        $ppn01 = 0;
        $ppn01Count = 0;
        $ppn02 = 0;
        $ppn02Count = 0;
        $ppn03 = 0;
        $ppn03Count = 0;
        $ppn04 = 0;
        $ppn04Count = 0;
        $pphTotal = 0;
        $pphTotalCount = 0;

        foreach ($dataPajak as $inv) {
            $hasPpn = !empty($inv->ppn) && (float)$inv->ppn > 0;
            $hasDiskon = !empty($inv->diskon) && (float)$inv->diskon > 0;
            $hasPotongan = !empty($inv->potongan) && (float)$inv->potongan > 0;
            $nominalPpn = 0;

            if ($hasPpn) {
                $nominalPpn = ($inv->ppn / 100) * ($inv->total_harga ?? 0);
            } elseif (!$hasDiskon && !$hasPotongan && $inv->total_pembayaran > $inv->total_harga && $inv->total_harga > 0) {
                $nominalPpn = $inv->total_pembayaran - $inv->total_harga;
                $hasPpn = true;
            }

            if ($hasPpn && $nominalPpn > 0) {
                $ppnTotal += $nominalPpn;
                $ppnTotalCount++;

                $kode = $inv->kode_ppn ?? '01';
                if ($kode == '01') {
                    $ppn01 += $nominalPpn;
                    $ppn01Count++;
                } elseif ($kode == '02') {
                    $ppn02 += $nominalPpn;
                    $ppn02Count++;
                } elseif ($kode == '03') {
                    $ppn03 += $nominalPpn;
                    $ppn03Count++;
                } elseif ($kode == '04') {
                    $ppn04 += $nominalPpn;
                    $ppn04Count++;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'periodLabel' => $periodLabel,
            'card4MonthName' => $card4MonthName,
            'card1' => ['nominal' => $valCard1, 'count' => $jlhInvoiceNonPo],
            'card2' => ['nominal' => $valCard2, 'count' => $lunasNonPo],
            'card3' => ['nominal' => $valCard3, 'count' => $belumLunasNonPo],
            'card4' => ['nominal' => $valCard4, 'count' => $belumLunasMonthNonPo],
            'cardPo1' => ['nominal' => $valPo1, 'count' => $countInvPo],
            'cardPo2' => ['nominal' => $valPo2, 'count' => $countPo2],
            'cardPo3' => ['nominal' => $valPo3, 'count' => $countPo3],
            'cardPo4' => ['nominal' => $valPo4, 'count' => $countPo4],
            'card5' => ['nominal' => $valCard5, 'count' => $batal],
            'card6' => ['nominal' => number_format($ppnTotal, 0, ',', '.'), 'count' => $ppnTotalCount],
            'card7' => ['nominal' => number_format($pphTotal, 0, ',', '.'), 'count' => $pphTotalCount],
            'card8' => ['nominal' => number_format($ppn01, 0, ',', '.'), 'count' => $ppn01Count],
            'card9' => ['nominal' => number_format($ppn02, 0, ',', '.'), 'count' => $ppn02Count],
            'card10' => ['nominal' => number_format($ppn03, 0, ',', '.'), 'count' => $ppn03Count],
            'card11' => ['nominal' => number_format($ppn04, 0, ',', '.'), 'count' => $ppn04Count],
        ]);
    }

    // Selected Invoice Code
    public function getInvoiceByOption($selectedOption)
    {
        // Retrieve the invoice based on the selected option
        $invoice = Invoice::where('nama_invoice', $selectedOption)->first();

        // Return the invoice or appropriate response
        if ($invoice) {
            return response()->json([
                'kode_invoice' => $invoice->kode_invoice,
                'tipe_harga' => $invoice->tipe_harga ?? 'dengan_harga'
            ]);
        } else {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
    }

    public function editInvoice($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Invoice tidak ditemukan');
            return redirect()->route('daftar_invoice');
        }
        $invoice = Invoice::find($inv->invoice);
        $admin_now = User::find($inv->admin);
        $admin = User::where('role', 'Admin')->get();
        $order = Order::all();
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $jenisBarang = Barang::with('kategori_item')->where('is_active', 1)->get();
        $materials = Material::all();

        $jam = substr($inv->tgl_penjualan ?? '', 11, 5);
        $nomor_unik = preg_replace("/[^0-9]/", '', $inv->nomor_invoice ?? '');
        $kode = preg_replace("/[^A-Z]/", '', $inv->nomor_invoice ?? '');
        $perusahaan = $inv->perusahaan;
        $nama_adm = $admin_now ? $admin_now->nama : 'Admin';
        $sales = $inv->nama_sales;
        if (!$perusahaan) {
            $perusahaan  = '-';
        }
        if (!$sales) {
            $sales = '-';
        }

        $barangIds = $penjualan_barang->pluck('barang_id')->unique();
        $barangMap = Barang::whereIn('id', $barangIds)->get()->keyBy('id');
        $barang = [];
        foreach ($penjualan_barang as $item) {
            $b = $barangMap->get($item->barang_id);
            $barang[] = $b ? collect([$b]) : collect([]);
        }

        return view('pages.invoices.edit-invoices', compact('inv', 'jam', 'nomor_unik', 'perusahaan', 'admin', 'order', 'sales', 'materials', 'jenisBarang', 'nama_adm', 'barang', 'invoice', 'kode', 'penjualan_barang'));
    }

    private function restoreInvoiceStock(Penjualan $invoice): void
    {
        foreach ($invoice->penjualanBarang as $items) {
            // Restore Stok Barang
            $barang = Barang::find($items->barang_id);
            if ($barang) {
                $barang->increment('stok', $items->qty);
            }

            // Restore Stok Material (Support Multi-Material / JSON)
            if (!empty($items->material_id) && !empty($items->material_qty)) {
                $matIds = json_decode($items->material_id, true);
                $matQtys = json_decode($items->material_qty, true);

                if (is_array($matIds)) {
                    foreach ($matIds as $index => $matId) {
                        $materialObj = Material::find($matId);
                        if ($materialObj) {
                            $materialObj->increment('stok', (float) ($matQtys[$index] ?? 0));
                        }
                    }
                } else {
                    $materialObj = Material::find($items->material_id);
                    if ($materialObj) {
                        $materialObj->increment('stok', (float) $items->material_qty);
                    }
                }
            }
        }
    }

    public function updateInvoice(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);
        if (!$penjualan) {
            Alert::error('Invoice tidak ditemukan');
            return redirect()->route('daftar_invoice');
        }

        if (!$request->has('barang_id') || !is_array($request->barang_id) || count($request->barang_id) === 0) {
            Alert::error('Error', 'Harap masukkan minimal 1 item barang.');
            return redirect()->back()->withInput();
        }

        foreach ($request->barang_id as $key => $value) {
            if (empty($value) || empty($request->deskripsi_item[$key]) || empty($request->qty[$key]) || empty($request->satuan[$key])) {
                Alert::error('Error', 'Harap lengkapi semua kolom item.');
                return redirect()->back()->withInput();
            }
        }

        $nmr_inv = $request->kode . $request->kodeUnik;
        $status = ($request->jns_pem == 'Cash Lunas' || $request->jns_pem == 'Transfer Lunas') ? 'Lunas' : 'Belum Lunas';
        $tanggalPenjualan = $request->tgl_jual . ":" . $request->jam;
        $item = (!empty($request->barang_id)) ? count($request->barang_id) : 0;

        $cleanNominal = function($val) {
            if ($val === null || $val === '') return 0;
            $digits = preg_replace('/[^0-9]/', '', (string)$val);
            return !empty($digits) ? intval($digits) : 0;
        };

        $tot_harga = $cleanNominal($request->tot_harga);
        $tot_pem = $cleanNominal($request->tot_pem);
        $dp = $cleanNominal($request->dp);
        
        if ($request->jns_pem == 'Cash Lunas' || $request->jns_pem == 'Transfer Lunas') {
            $sisa_pemb = 0;
        } else {
            $sisa_pemb = $cleanNominal($request->sisa_pem);
        }
       
        $norek = $request->norek ?: 'BNI';

        DB::transaction(function () use ($penjualan, $request, $nmr_inv, $status, $tanggalPenjualan, $item, $dp, $norek, $tot_harga, $tot_pem, $sisa_pemb, $cleanNominal, $id) {
            // 1. KEMBALIKAN (RESTORE) STOK BARANG & MATERIAL SEBELUMNYA
            $this->restoreInvoiceStock($penjualan);
       
        $penjualan->invoice = $request->inv;
        $penjualan->nomor_invoice = $nmr_inv;
        $penjualan->tgl_penjualan = $tanggalPenjualan;
        $penjualan->customer = $request->pelanggan;
        $penjualan->perusahaan = $request->perusahaan;
        $penjualan->no_telepon = $request->tlp;
        $penjualan->admin = $request->adm;
        $penjualan->order_by = $request->order;
        $penjualan->nama_sales = $request->sales;
        $penjualan->tgl_selesai = $request->tgl_selesai;
        $penjualan->jumlah_item = $item;
        $penjualan->dp = $dp;
        $penjualan->jenis_pembayaran = $request->jns_pem;
        $penjualan->no_rek = $norek;
        $penjualan->total_harga = $tot_harga;
        $penjualan->status = $status;
        
        $jenisPotongan = $request->select_potongan ?? $request->input('select-potongan');
        $rawPotongan = $request->biaya_lain ?? ($request->ptg ?? $request->input('biaya_lain'));
        $nilai_potongan = intval(preg_replace('/[^0-9]/', '', $rawPotongan ?? '0'));

        if ($jenisPotongan == 'PPN') {
            $penjualan->ppn = $nilai_potongan;
            $penjualan->diskon = null;
            $penjualan->potongan = null;
        } else if ($jenisPotongan == 'Diskon') {
            $penjualan->ppn = null;
            $penjualan->diskon = $nilai_potongan;
            $penjualan->potongan = null;
        } else if ($jenisPotongan == 'Potongan') {
            $penjualan->ppn = null;
            $penjualan->diskon = null;
            $penjualan->potongan = $nilai_potongan;
        } else {
            $penjualan->ppn = null;
            $penjualan->diskon = null;
            $penjualan->potongan = null;
        }

        // Server-side recalculation guard
        if ($jenisPotongan == 'PPN' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga + round($tot_harga * ($nilai_potongan / 100));
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = $expectedPem;
            }
        } elseif ($jenisPotongan == 'Diskon' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga - round($tot_harga * ($nilai_potongan / 100));
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = max(0, $expectedPem);
            }
        } elseif ($jenisPotongan == 'Potongan' && $nilai_potongan > 0) {
            $expectedPem = $tot_harga - $nilai_potongan;
            if ($tot_pem <= 0 || abs($tot_pem - $expectedPem) > 5) {
                $tot_pem = max(0, $expectedPem);
            }
        } elseif ($tot_pem <= 0) {
            $tot_pem = $tot_harga;
        }

        if ($status == 'Lunas') {
            $sisa_pemb = 0;
        } else {
            $sisa_pemb = max(0, $tot_pem - $dp);
        }

        $penjualan->total_pembayaran = $tot_pem;
        $penjualan->sisa_pembayaran = $sisa_pemb;
        $penjualan->save();
        
        InvoiceUpdateLog::create([
        'invoice_id' => $penjualan->id,
        
        ]);

        PenjualanBarang::where('penjualan_id', $id)->delete();

        // 2. SIMPAN ITEM BARU DAN POTONG STOK (BARANG & MATERIAL)
        foreach ($request->barang_id as $key => $value) {
            $barangObj = Barang::find($value);
            if ($barangObj && $barangObj->is_material_required == 1) {
                $matIds = [];
                $matQtys = [];
                $matPanjangs = [];
                $matLebars = [];
            } else {
                // Bersihkan array material dari elemen kosong untuk Mencegah Array to String Conversion
                $matIds = isset($request->material_id[$key]) && is_array($request->material_id[$key]) ? array_filter($request->material_id[$key]) : [];
                $matQtys = isset($request->material_qty[$key]) && is_array($request->material_qty[$key]) ? array_filter($request->material_qty[$key], 'strlen') : [];
                $matPanjangs = isset($request->material_panjang[$key]) && is_array($request->material_panjang[$key]) ? array_filter($request->material_panjang[$key], 'strlen') : [];
                $matLebars = isset($request->material_lebar[$key]) && is_array($request->material_lebar[$key]) ? array_filter($request->material_lebar[$key], 'strlen') : [];
            }

            $item = new PenjualanBarang();
            $item->barang_id = $value;
            $item->penjualan_id = $penjualan->id;
            $item->deskripsi_item = $request->deskripsi_item[$key];
            $item->qty = $request->qty[$key];
            $item->satuan = $request->satuan[$key];
            $item->hargaBarang = $cleanNominal($request->hrg[$key] ?? 0);
            $item->jumlah_harga = $cleanNominal($request->jlh_hrg[$key] ?? 0);
            
            // Simpan Material, Qty, P x L sebagai JSON String
            $item->material_id = !empty($matIds) ? json_encode(array_values($matIds)) : null;
            $item->material_qty = !empty($matQtys) ? json_encode(array_values($matQtys)) : null;
            $item->material_panjang = !empty($matPanjangs) ? json_encode(array_values($matPanjangs)) : null;
            $item->material_lebar = !empty($matLebars) ? json_encode(array_values($matLebars)) : null;

            $item->save();

            // Kurangi Stok Barang
            if ($barangObj) {
                $barangObj->decrement('stok', $item->qty);
            }

            // Kurangi Stok Material
            if (!empty($matIds)) {
                foreach (array_values($matIds) as $mIndex => $mId) {
                    $material = Material::find($mId);
                    $mQty = array_values($matQtys)[$mIndex] ?? 0;
                    if ($material) {
                        $material->decrement('stok', $mQty);
                    }
                }
            }
        }
        });

        Alert::success('Data Invoice Berhasil diUpdate');
        return redirect('list-invoice');
    }


    public function cetakInvoice(Request $request, $id)
    {
        $type = strtolower($request->query('type', 'asli'));
        if (!in_array($type, ['asli', 'copy'])) {
            $type = 'asli';
        }
        $penjualan = Penjualan::where('id', $id)->first();
        if (!$penjualan) {
            Alert::error('Invoice tidak ditemukan');
            return redirect()->back();
        }
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga ?? 0, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran ?? 0, 0, ',', '.');
        $admin = $admin_now ? $admin_now->nama : 'Admin';
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');


        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');


        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                // $biayaLain = number_format($penjualan->diskon ? $penjualan->diskon : $penjualan->ppn, 0, ',', '.') . '%';
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
                
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }
        
        $toko = "Ibekami.id";
        

        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }

        return view('pages.invoices.cetak', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin','toko', 'type'));
    }



    public function viewDownloadInvoice($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        if (!$penjualan) {
            abort(404, 'Data Invoice tidak ditemukan');
        }
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now ? $admin_now->nama : 'Admin';
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');

        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        $toko = "Ibekami.id";
        return view('pages.invoices.download', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko'));
    }
    
     public function publicDownload(Request $request, $id)
    {
        // 1. CEK KEAMANAN LINK (Signature)
        // Ini memastikan link valid dan belum expired (30 hari)
        if (! $request->hasValidSignature()) {
            abort(403, 'Maaf, Link download ini sudah kadaluarsa atau tidak valid.');
        }

        // 2. LOGIKA DATA (Sama persis dengan viewDownloadInvoice Anda)
        $penjualan = Penjualan::where('id', $id)->first();

        // Cek jika data tidak ditemukan agar tidak error
        if (!$penjualan) {
            abort(404);
        }

        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_harga, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now ? $admin_now->nama : 'Admin'; // Antisipasi jika user admin terhapus
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');

        $norek = $penjualan->norek_text;

        if ($penjualan->dp == null) {
            $dp = 0;
        } else {
            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon) {
                $biayaLain = number_format($penjualan->diskon, 0, ',', '.') . '%';
            }else if( $penjualan->ppn){
                $biayaLain = number_format($penjualan->ppn / 100 * $penjualan->total_harga);
            }else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        
        $toko = "Ibekami.id";
        return view('pages.invoices.public-download-view', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko'));
    }
    
    
    public function cetakInvoiceBaru(Request $request, $id)
    {
        $type = strtolower($request->query('type', 'asli'));
        if (!in_array($type, ['asli', 'copy'])) {
            $type = 'asli';
        }
        $penjualan = Penjualan::where('id', $id)->first();
        $invoice = Invoice::where('id', $penjualan->invoice)->first();
        $namaInv = $penjualan->nomor_invoice;
        $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
        $admin_now = User::where('id', $penjualan->admin)->first();
        // $jenisBarang = Barang::all();
        $barang = [];
        $hargaMod = [];
        $jumlahHarga = [];
        $totHargaMod = number_format($penjualan->total_pembayaran, 0, ',', '.');
        $totalHarga = number_format($penjualan->total_harga, 0, ',', '.');
        $sisaBayarMod = $penjualan->status === 'Lunas' ? '0' : number_format($penjualan->sisa_pembayaran, 0, ',', '.');
        
        $admin = $admin_now->nama;
        $tanggal =  $penjualan->tgl_penjualan;
        Carbon::setLocale('id');
        $persen = '';
        $dp = null;

        // Ubah format tanggal menjadi tanggal string
        $tanggalString = Carbon::parse($tanggal)->toDateString();

        // Format tanggal yang diinginkan dengan bulan dalam bahasa Indonesia
        $formatTanggal = Carbon::parse($tanggalString)->isoFormat('DD MMMM YYYY');


        $norek = $penjualan->norek_text;

        if ($penjualan->dp != null) {

            $dp = number_format($penjualan->dp, 0, ',', '.');
        }

        if ($penjualan->diskon != null || $penjualan->potongan != null || $penjualan->ppn != null) {
            if ($penjualan->diskon || $penjualan->ppn) {
                $potongan = ($penjualan->diskon ? $penjualan->diskon : $penjualan->ppn) / 100 * $penjualan->total_harga;
                $biayaLain = 'Rp.' . number_format($potongan, 0, ',', '.');
            } else {
                $biayaLain = 'Rp.' . number_format($penjualan->potongan, 0, ',', '.');
            }
        } else {
            $biayaLain = 0;
        }

        if ($penjualan->diskon) {
            $persen = number_format($penjualan->diskon, 0, ',', '.') . '%';
        } else if ($penjualan->ppn) {
            $persen = number_format($penjualan->ppn, 0, ',', '.') . '%';
        }
        foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }
        $toko = "Ikhtiar Berkah";
        return view('pages.invoices.cetakTerbaru', compact('invoice', 'penjualan', 'barang', 'penjualan_barang', 'hargaMod', 'jumlahHarga', 'norek', 'totHargaMod','totalHarga', 'dp', 'biayaLain', 'sisaBayarMod', 'formatTanggal', 'admin', 'persen','namaInv','toko', 'type'));
    }

    public function downloadInvoice()
    {
        $pdf = PDF::loadview('pages.invoices.pdf');
        return $pdf->download('invoice-test.pdf');
        // return view('pages.invoices.pdf');
    }

    function statusBatal($id)
    {
        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->route('daftar_invoice');
        }

        DB::transaction(function () use ($inv) {
            if ($inv->status !== 'Batal') {
                $this->restoreInvoiceStock($inv);
            }
            $inv->status = 'Batal';
            $inv->save();

            InvoiceUpdateLog::create([
                'invoice_id' => $inv->id,
            ]);
        });

        Alert::warning('Invoice Dibatalkan', 'Invoice #' . $inv->nomor_invoice . ' berhasil dibatalkan dan stok dikembalikan.');
        return redirect()->route('daftar_invoice')->with('success', 'Invoice berhasil dibatalkan dan stok dikembalikan.');
    }
    function statusLunas($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->status = 'Lunas';
        $inv->sisa_pembayaran = 0;
        $inv->save();
        InvoiceUpdateLog::create([
            'invoice_id' => $inv->id,
        ]);
        Alert::success('Invoice Sudah Lunas');
        return redirect()->back();
    }
    
    function unlock($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->approval = 'Unlock';
        $inv->approved_at = now();
        $inv->save();
        
        Alert::success('Invoice Sudah di-Unlock');
        return redirect()->route('daftar_invoice');
    }
    
    function lock($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $inv = Penjualan::find($id);
        if (!$inv) {
            Alert::error('Data tidak ditemukan');
            return redirect()->back();
        }
        $inv->approval = 'Lock';
        $inv->save();
        
        Alert::success('Invoice Sudah di-Lock');
        return redirect()->back();
    }
 
    public function approvalPage($id)
{
    $invoice = Penjualan::where('id', $id)->firstOrFail();
    $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
    
    $invoice->formatted_total_pembayaran = number_format($invoice->total_pembayaran, 0, ',', ',');
    $barang = [];
    $hargaMod = [];
    $jumlahHarga = [];
     foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }



    return view('pages.invoices.approval', compact('invoice','penjualan_barang','barang','hargaMod','jumlahHarga'));
}
    public function pelunasanPage($id)
{
    $invoice = Penjualan::where('id', $id)->firstOrFail();
    $penjualan_barang = PenjualanBarang::where('penjualan_id', $id)->get();
   $invoice->formatted_total_pembayaran = number_format($invoice->total_pembayaran, 0, ',', ',');
    $barang = [];
    $hargaMod = [];
    $jumlahHarga = [];
     foreach ($penjualan_barang as $item) {
            $barangItem = Barang::where('id', $item->barang_id)->get();
            $barang[] = $barangItem;
            $hargaMod[] = number_format($item->hargaBarang, 0, ',', '.');
            $jumlahHarga[] = number_format($item->jumlah_harga, 0, ',', '.');
        }


    return view('pages.invoices.pelunasan', compact('invoice','penjualan_barang','barang','hargaMod','jumlahHarga'));
}

        public function storeStatusBatal (Request $request, $id)
        {
            $invoice = Penjualan::find($id);
            if (!$invoice) {
                Alert::error('Data tidak ditemukan');
                return redirect()->route('daftar_invoice');
            }

            DB::transaction(function () use ($invoice, $request) {
                if ($invoice->status !== 'Batal') {
                    $this->restoreInvoiceStock($invoice);
                }
                $invoice->status = 'Batal';
                if ($request->has('alasan_batal') && !empty($request->alasan_batal)) {
                    $invoice->alasan_batal = $request->alasan_batal; // Simpan alasan dari SweetAlert
                }
                $invoice->save();
                
                InvoiceUpdateLog::create([
                    'invoice_id' => $invoice->id,
                ]);
            });

            Alert::warning('Invoice Dibatalkan', 'Invoice #' . $invoice->nomor_invoice . ' berhasil dibatalkan dan stok dikembalikan.');
            return redirect()->route('daftar_invoice')->with('success', 'Invoice berhasil dibatalkan dan stok dikembalikan.');
        }
    
     public function getUpdateLog($id)
{
    $penjualan = Penjualan::with('InvoiceUpdateLog')->findOrFail($id);

    return response()->json([
        'created_at' => $penjualan->created_at->format('d-m-Y H:i'), 
        'logs' => $penjualan->InvoiceUpdateLog->map(function($log) {
            return [
                'tanggal' => $log->created_at->format('d-m-Y H:i'),
                'keterangan' => $log->keterangan,
            ];
        })
    ]);
}
}