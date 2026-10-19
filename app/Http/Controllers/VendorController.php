<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Pembelian;
use App\Models\PembelianBarang;
use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
    function index()
    {
        $vendors = Vendor::withCount('pembelian')->orderByDesc('nama_vendor')->get();
        $nama_vendor = [];
        $total_sisa = [];
        $OutstndLunas = number_format((Pembelian::sum('terbayar') / 1000000), 2);
        $OutstndBlmLunas = number_format((Pembelian::sum('sisa') / 1000000), 2);
        $totalOutstnd = number_format((Pembelian::sum('jumlah_harga') / 1000000), 2);

        $totalTagihan  = (float) Pembelian::sum('jumlah_harga');
        $totalTerbayar = (float) Pembelian::sum('terbayar');
        $totalSisa     = (float) Pembelian::sum('sisa');
        $sisaKas       = (float) Budget::sum('anggaran');
        
        foreach ($vendors as $vendor) {
            $vendor->formattedTotal = number_format($vendor->total_pembelian, 0, ',', ',');
            $vendor->formattedTerbayar = number_format($vendor->pembelian_terbayar, 0, ',', ',');
            $vendor->formattedSisa = number_format($vendor->pembelian_sisa, 0, ',', ',');
            $nama_vendor[] = $vendor->nama_vendor;
            $total_sisa[] = number_format($vendor->pembelian_sisa, 0, ',',',');
        }

        return view('pages.vendorPgs.daftar-vendor', compact(
            'vendors', 'nama_vendor', 'total_sisa', 'OutstndLunas', 'OutstndBlmLunas', 'totalOutstnd',
            'totalTagihan', 'totalTerbayar', 'totalSisa', 'sisaKas'
        ));
    }

    function add()
    {
        return view('pages.vendorPgs.tambah-vendor');
    }

    function store(Request $request)
    {

        Vendor::create([
            'nama_vendor' => $request->nama_vendor,
        ]);
        Alert::success('Berhasil', 'Vendor Ditambahkan');
        return redirect(route('vendor.list'));
    }

    function edit($id)
    {
        $vendor = Vendor::find($id);
        if (!$vendor) {
            Alert::error('Gagal', 'Data vendor tidak ditemukan');
            return redirect(route('vendor.list'));
        }
        return view('pages.vendorPgs.edit-vendor', compact('vendor'));
    }

    function update(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        if (!$vendor) {
            Alert::error('Gagal', 'Data vendor tidak ditemukan');
            return redirect(route('vendor.list'));
        }
        $vendor->update([
            'nama_vendor' => $request->vendor,
            'total_pembelian' => $vendor->total_pembelian,
            'pembelian_sisa' => $vendor->pembelian_sisa,
            'pembelian_terbayar' => $vendor->pembelian_terbayar,
        ]);
        Alert::success('Berhasil', 'Nama Vendor Berhasil Diubah');
        return redirect(route('vendor.list'));
    }

    function destroy(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $pembelianCount = Pembelian::where('id_vendor', $id)->count();

        if ($pembelianCount > 0 && $request->has('action')) {
            $request->validate([
                'action' => ['required', 'in:transfer,delete_all'],
                'target_vendor_id' => [
                    'required_if:action,transfer',
                    'nullable',
                    'exists:vendor,id',
                    \Illuminate\Validation\Rule::notIn([$id]),
                ],
            ], [
                'action.required' => 'Silakan pilih tindakan untuk riwayat pembelian vendor ini.',
                'action.in' => 'Pilihan tindakan tidak valid.',
                'target_vendor_id.required_if' => 'Silakan pilih vendor tujuan pemindahan transaksi.',
                'target_vendor_id.exists' => 'Vendor tujuan yang dipilih tidak ditemukan.',
                'target_vendor_id.not_in' => 'Vendor tujuan tidak boleh sama dengan vendor yang ingin dihapus.',
            ]);
        }

        $deletedVendorName = $vendor->nama_vendor;
        $targetVendorName = null;

        \Illuminate\Support\Facades\DB::transaction(function () use ($request, $vendor, $pembelianCount, &$targetVendorName) {
            if ($pembelianCount > 0) {
                if ($request->action === 'transfer') {
                    $targetVendor = Vendor::lockForUpdate()->findOrFail($request->target_vendor_id);
                    $sourceVendor = Vendor::lockForUpdate()->findOrFail($vendor->id);
                    $targetVendorName = $targetVendor->nama_vendor;

                    // Alihkan semua riwayat transaksi pembelian ke vendor tujuan
                    Pembelian::where('id_vendor', $sourceVendor->id)->update([
                        'id_vendor' => $targetVendor->id,
                    ]);

                    // Akumulasikan total keuangan ke vendor tujuan
                    $targetVendor->total_pembelian += (float) $sourceVendor->total_pembelian;
                    $targetVendor->pembelian_terbayar += (float) $sourceVendor->pembelian_terbayar;
                    $targetVendor->pembelian_sisa += (float) $sourceVendor->pembelian_sisa;
                    $targetVendor->save();

                    // Hapus vendor asal
                    $sourceVendor->delete();
                } else {
                    // Default / delete_all: hapus semua pembelian dan sesuaikan anggaran kas
                    $sourceVendor = Vendor::lockForUpdate()->findOrFail($vendor->id);
                    $pembelians = Pembelian::where('id_vendor', $sourceVendor->id)->get();

                    foreach ($pembelians as $pembelian) {
                        if ($pembelian->anggaran) {
                            $budget = Budget::find($pembelian->anggaran);
                            if ($budget) {
                                $budget->anggaran += (float) $pembelian->terbayar;
                                $budget->save();
                            }
                        }
                        $pembelian->barang()->delete();
                        $pembelian->delete();
                    }

                    $sourceVendor->delete();
                }
            } else {
                $vendor->delete();
            }
        });

        if ($pembelianCount > 0 && $request->action === 'transfer') {
            Alert::success('Berhasil', "Vendor {$deletedVendorName} berhasil dihapus. Sebanyak {$pembelianCount} transaksi pembelian telah dipindahkan ke {$targetVendorName}.");
        } elseif ($pembelianCount > 0 && $request->action === 'delete_all') {
            Alert::success('Berhasil', "Vendor {$deletedVendorName} beserta {$pembelianCount} transaksi pembelian berhasil dihapus.");
        } else {
            Alert::success('Berhasil', "Vendor {$deletedVendorName} berhasil dihapus.");
        }

        return redirect(route('vendor.list'));
    }
}
