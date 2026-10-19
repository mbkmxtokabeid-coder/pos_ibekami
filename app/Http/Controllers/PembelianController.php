<?php

namespace App\Http\Controllers;

use App\Models\Budget;
// use App\Models\KategoriBarang;
use App\Models\Pembelian;
use App\Models\PembelianBarang;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class PembelianController extends Controller
{
    private function adjustBudget($id, $amount): void
    {
        if ($id && $amount != 0) {
            $budget = Budget::lockForUpdate()->find($id);
            if ($budget) {
                $budget->anggaran += $amount;
                $budget->save();
            }
        }
    }

    private function adjustVendor($id, $total, $terbayar, $sisa): void
    {
        if ($id) {
            $vendor = Vendor::lockForUpdate()->find($id);
            if ($vendor) {
                $vendor->total_pembelian += $total;
                $vendor->pembelian_terbayar += $terbayar;
                $vendor->pembelian_sisa += $sisa;
                $vendor->save();
            }
        }
    }

    function index($id)
    {
        // Auto lock riwayat pembelian yang di-unlock lebih dari 6 jam (konsisten dengan sistem invoice)
        Pembelian::where('id_vendor', $id)
            ->where('approval', 'Unlock')
            ->whereNotNull('approved_at')
            ->where('approved_at', '<', now()->subHours(6))
            ->update(['approval' => 'Lock', 'approved_at' => null]);

        $vendor = Vendor::findOrFail($id);

        $pembelian = Pembelian::with('vendor')
            ->where('id_vendor', $id)
            ->latest('tanggal')
            ->get();

        $pembelians = $pembelian;

        $totalTagihan  = (float) $pembelian->sum('jumlah_harga');
        $totalTerbayar = (float) $pembelian->sum('terbayar');
        $totalSisa     = (float) $pembelian->sum('sisa');
        $sisaKas       = (float) Budget::sum('anggaran');

        return view('pages.pembelian.daftar-pembelian', compact(
            'vendor', 'pembelian', 'pembelians', 'totalTagihan', 'totalTerbayar', 'totalSisa', 'sisaKas'
        ));
    }

    function addPembelian($id)
    {
        $uniqueToken = (string) Str::uuid();
        $budgets = Budget::select('id', 'nama_budget', 'anggaran', 'tanggal')->orderBy('nama_budget')->get();
        $anggaran = $budgets;
        $vendor = Vendor::findOrFail($id);
        $vendors = $vendor;
        return view('pages.pembelian.tambah-pembelian', compact('budgets', 'anggaran', 'vendor', 'vendors', 'uniqueToken'));
    }

    function store(Request $request)
    {
        // 1. Sanitasi format angka ribuan
        if ($request->has('terbayar')) {
            $cleanTerbayar = preg_replace('/[^0-9]/', '', (string)$request->terbayar);
            $request->merge(['terbayar' => $cleanTerbayar !== '' ? (int)$cleanTerbayar : 0]);
        }
        if ($request->has('items') && is_array($request->items)) {
            $items = $request->items;
            foreach ($items as $k => $item) {
                if (isset($item['harga_barang'])) {
                    $cleanHarga = preg_replace('/[^0-9]/', '', (string)$item['harga_barang']);
                    $items[$k]['harga_barang'] = $cleanHarga !== '' ? (int)$cleanHarga : 0;
                }
            }
            $request->merge(['items' => $items]);
        }

        $idVendor = $request->id_vendor ?: $request->vendor;
        $request->merge(['id_vendor' => $idVendor]);

        $token = $request->token;
        if ($token) {
            $existToken = Pembelian::where('token', $token)->first();
            if ($existToken) {
                Alert::error('Data Sudah diSubmit');
                return redirect(route('pembelian.list', ['uid' => $idVendor]));
            }
        }

        $request->validate([
            'id_vendor'     => ['required', 'exists:vendor,id'],
            'nomor_inv'     => ['required', 'string', 'max:100'],
            'tanggal'       => ['required', 'date'],
            'tanggal_jto'   => ['nullable', 'date'],
            'anggaran'      => ['required', 'exists:budget,id'],
            'terbayar'      => ['nullable', 'numeric', 'min:0'],
            'status'        => ['required', 'in:Lunas,Belum Lunas'],
            'items'         => ['required', 'array', 'min:1'],
            'items.*.deskripsi'    => ['required', 'string'],
            'items.*.harga_barang' => ['required', 'numeric', 'min:0'],
            'items.*.qty'          => ['required', 'integer', 'min:1'],
            'items.*.satuan'       => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($request, $idVendor, $token) {
            $subtotal = (int) round(collect($request->items)->sum(function ($item) {
                return (float) ($item['harga_barang'] ?? 0) * (int) ($item['qty'] ?? 0);
            }));

            $ppnPersen = 0;
            $pphPersen = 0;
            $ppnNominal = 0;
            $pphNominal = 0;
            $jumlahHarga = $subtotal;

            $terbayar = $request->status === 'Lunas'
                ? $jumlahHarga
                : min((int) round((float) ($request->terbayar ?? 0)), $jumlahHarga);
            $sisa = $jumlahHarga - $terbayar;

            $tglJto = $request->tanggal_jto ?: $request->tanggal;

            $pembelian = Pembelian::create([
                'id_vendor'     => $idVendor,
                'nomor_inv'     => $request->nomor_inv,
                'jenis_invoice' => 'Tanpa Pajak',
                'ppn_persen'    => $ppnPersen,
                'ppn_nominal'   => $ppnNominal,
                'pph_persen'    => $pphPersen,
                'pph_nominal'   => $pphNominal,
                'tanggal'       => $request->tanggal,
                'tanggal_jto'   => $tglJto,
                'tgl_jto'       => $tglJto,
                'tgl_lunas'     => $request->status === 'Lunas' ? $request->tanggal : null,
                'anggaran'      => $request->anggaran,
                'status'        => $request->status,
                'jumlah_harga'  => $jumlahHarga,
                'terbayar'      => $terbayar,
                'sisa'          => $sisa,
                'token'         => $token ?: (string) Str::uuid(),
                'approval'      => 'Lock',
                'approved_at'   => null,
            ]);

            $this->adjustBudget($request->anggaran, -$terbayar);
            $this->adjustVendor($idVendor, $jumlahHarga, $terbayar, $sisa);

            foreach ($request->items as $item) {
                PembelianBarang::create([
                    'pembelian_id' => $pembelian->id,
                    'deskripsi'    => $item['deskripsi'],
                    'qty'          => (int) $item['qty'],
                    'satuan'       => $item['satuan'] ?? null,
                    'harga_barang' => (int) $item['harga_barang'],
                    'total'        => (int) round((float) $item['harga_barang'] * (int) $item['qty']),
                ]);
            }
        });

        Alert::success('Berhasil', 'Pembelian Berhasil ditambahkan');
        return redirect(route('pembelian.list', ['uid' => $idVendor]));
    }
    
    function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $role = Auth::user()->role ?? null;
        if ($role === 'Admin' && $pembelian->approval !== 'Unlock') {
            Alert::error('Gagal', 'Akses edit riwayat pembelian terkunci. Silakan minta persetujuan ke Pemilik terlebih dahulu.');
            return redirect()->back();
        }

        $vendor = Vendor::where('id', $pembelian->id_vendor)->select('nama_vendor')->first();
        $anggaran = Budget::all();
        $anggaranNow = $anggaran->where('id', $pembelian->anggaran)->first();
        $pembelianBrg = PembelianBarang::where('pembelian_id', $id)->get();

        return view('pages.pembelian.edit-pembelian', compact('pembelian', 'anggaran', 'pembelianBrg', 'anggaranNow', 'vendor'));
    }

    function update(Request $request, $id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $role = Auth::user()->role ?? null;
        if ($role === 'Admin' && $pembelian->approval !== 'Unlock') {
            Alert::error('Gagal', 'Akses edit riwayat pembelian terkunci. Silakan minta persetujuan ke Pemilik terlebih dahulu.');
            return redirect()->back();
        }

        if (!$request->has('deskripsi') || !is_array($request->deskripsi) || count($request->deskripsi) === 0) {
            Alert::error('Error', 'Barang pembelian harus diisi minimal 1 item.');
            return redirect()->back()->withInput();
        }

        foreach ($request->deskripsi as $key => $deskripsi) {
            if (empty($deskripsi) || empty($request->qty[$key]) || empty($request->satuan[$key]) || (!isset($request->harga[$key]) && $request->harga[$key] !== '0')) {
                Alert::error('Error', 'Harap lengkapi semua rincian barang pembelian.');
                return redirect()->back()->withInput();
            }
        }

        $terbayar = intval(str_replace(['.', ','], '', $request->terbayar ?? '0'));
        $sisa = intval(str_replace(['.', ','], '', $request->sisa ?? '0'));
        $jumlahTot = intval(str_replace(['.', ','], '', $request->jumlahTotal ?? '0'));
        if ($request->status === 'Lunas') {
            $terbayar = $jumlahTot;
            $sisa = 0;
        }

        DB::transaction(function () use ($pembelian, $request, $terbayar, $sisa, $jumlahTot, $id) {
            $oldAnggaranId = $pembelian->anggaran;
            $newAnggaranId = $request->anggaran;
            $oldTerbayar = (float) $pembelian->terbayar;
            $newTerbayar = (float) $terbayar;

            if ($oldAnggaranId !== $newAnggaranId) {
                // Kembalikan dana ke anggaran lama
                $this->adjustBudget($oldAnggaranId, $oldTerbayar);
                // Potong dana dari anggaran baru
                $this->adjustBudget($newAnggaranId, -$newTerbayar);
            } else {
                // Anggaran sama: potong selisih pembayarannya saja
                $selisihAnggaran = $newTerbayar - $oldTerbayar;
                $this->adjustBudget($newAnggaranId, -$selisihAnggaran);
            }

            $selisih_bayar = $terbayar - $pembelian->terbayar;
            $selisih_sisa = $sisa - $pembelian->sisa;
            $selisih_total = $jumlahTot - $pembelian->jumlah_harga;

            $this->adjustVendor($pembelian->id_vendor, $selisih_total, $selisih_bayar, $selisih_sisa);

            $pembelian->update([
                'anggaran' => $request->anggaran,
                'id_vendor' => $pembelian->id_vendor,
                'nomor_inv' => $request->no_inv,
                'tanggal' => $request->tgl,
                'tgl_jto' => $request->tgl_jto,
                'status' => $request->status,
                'terbayar' => $terbayar,
                'sisa' => $sisa,
                'jumlah_harga' => $jumlahTot,
            ]);

            PembelianBarang::where('pembelian_id', $id)->delete();

            foreach ($request->deskripsi as $key => $deskripsi) {
                $harga_barang = intval(str_replace(['.', ','], '', $request->harga[$key] ?? '0'));
                $qty = intval($request->qty[$key] ?? 1);
                $satuan = $request->satuan[$key] ?? 'Pcs';
                $total = $harga_barang * $qty;

                PembelianBarang::create([
                    'id' => Uuid::uuid4()->toString(),
                    'pembelian_id' => $pembelian->id,
                    'deskripsi' => $deskripsi,
                    'satuan' => $satuan,
                    'harga_barang' => $harga_barang,
                    'qty' => $qty,
                    'total' => $total,
                ]);
            }
        });

        Alert::success('Berhasil', 'Data Pembelian Berhasil diupdate');
        return redirect(route('pembelian.list', ['uid' => $pembelian->id_vendor]));
    }

    function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $role = Auth::user()->role ?? null;
        if ($role === 'Admin' && $pembelian->approval !== 'Unlock') {
            Alert::error('Gagal', 'Akses hapus riwayat pembelian terkunci. Silakan minta persetujuan ke Pemilik terlebih dahulu.');
            return redirect()->back();
        }

        DB::transaction(function () use ($pembelian) {
            $this->adjustBudget($pembelian->anggaran, $pembelian->terbayar);
            $this->adjustVendor($pembelian->id_vendor, -$pembelian->jumlah_harga, -$pembelian->terbayar, -$pembelian->sisa);
            $pembelian->barang()->delete();
            $pembelian->delete();
        });

        Alert::success('Berhasil', 'Pembelian Berhasil dihapus');
        return redirect(route('pembelian.list', ['uid' => $pembelian->id_vendor]));
    }

    function lunas($uid)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        DB::transaction(function () use ($uid) {
            $pembelian = Pembelian::lockForUpdate()->findOrFail($uid);
            $sisa = $pembelian->sisa;

            if ($sisa > 0) {
                $this->adjustBudget($pembelian->anggaran, -$sisa);
                $this->adjustVendor($pembelian->id_vendor, 0, $sisa, -$sisa);
            }

            $pembelian->update([
                'status'    => 'Lunas',
                'terbayar'  => $pembelian->jumlah_harga,
                'sisa'      => 0,
                'tgl_lunas' => now()->toDateString(),
            ]);
        });

        Alert::success('Berhasil', 'Pembelian berhasil dilunasi.');
        return redirect()->back();
    }

    public function unlock($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $pembelian = Pembelian::find($id);
        if (!$pembelian) {
            Alert::error('Gagal', 'Data pembelian tidak ditemukan.');
            return redirect()->back();
        }

        $pembelian->approval = 'Unlock';
        $pembelian->approved_at = now();
        $pembelian->save();

        Alert::success('Berhasil', 'Akses edit riwayat pembelian #' . $pembelian->nomor_inv . ' berhasil di-Unlock. Admin sekarang dapat mengedit transaksi ini.');
        return redirect()->route('pembelian.list', ['uid' => $pembelian->id_vendor]);
    }

    public function lock($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $pembelian = Pembelian::find($id);
        if (!$pembelian) {
            Alert::error('Gagal', 'Data pembelian tidak ditemukan.');
            return redirect()->back();
        }

        $pembelian->approval = 'Lock';
        $pembelian->approved_at = null;
        $pembelian->save();

        Alert::success('Berhasil', 'Riwayat pembelian #' . $pembelian->nomor_inv . ' berhasil di-Lock kembali.');
        return redirect()->back();
    }

    public function approvalPage($id)
    {
        if (strtolower(auth()->user()->role) !== 'pemilik') {
            Alert::error('Akses Ditolak', 'Hanya Pemilik yang memiliki hak akses ini.');
            return redirect('/profile');
        }

        $pembelian = Pembelian::with(['vendor', 'barang'])->findOrFail($id);
        return view('pages.pembelian.approval', compact('pembelian'));
    }
}
