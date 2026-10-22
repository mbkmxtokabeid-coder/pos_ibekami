<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membersihkan seluruh data transaksi, master, dan modul terkait Tokabe
     * agar database kasir hanya berfokus secara eksklusif pada Ibekami.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        // 1. Identifikasi dan isolasi semua record transaksi Tokabe yang ada di tabel penjualan
        if (Schema::hasTable('penjualan')) {
            $tokabePenjualanIds = DB::table('penjualan')
                ->where('invoice', 5)
                ->orWhere('nomor_invoice', 'LIKE', 'TKB%')
                ->orWhere('nomor_invoice', 'LIKE', '%/TKB/%')
                ->orWhere('no_rek', 'TKB')
                ->pluck('id')
                ->toArray();

            if (!empty($tokabePenjualanIds)) {
                // Hapus child items di penjualan_barang
                if (Schema::hasTable('penjualan_barang')) {
                    DB::table('penjualan_barang')->whereIn('penjualan_id', $tokabePenjualanIds)->delete();
                }

                // Hapus invoice update logs terkait
                if (Schema::hasTable('invoice_update_logs')) {
                    DB::table('invoice_update_logs')->whereIn('invoice_id', $tokabePenjualanIds)->delete();
                }

                // Hapus parent transaksi di penjualan
                DB::table('penjualan')->whereIn('id', $tokabePenjualanIds)->delete();
            }
        }

        // 2. Bersihkan Surat Perintah Kerja (SPK) Tokabe
        if (Schema::hasTable('spk')) {
            DB::table('spk')
                ->where('nomor_invoice', 'LIKE', 'TKB%')
                ->orWhere('nomor_invoice', 'LIKE', '%/TKB/%')
                ->delete();
        }

        // 3. Bersihkan Surat Perintah Jalan (SPJ) Tokabe
        if (Schema::hasTable('spj')) {
            DB::table('spj')
                ->where('perusahaan', 'Tokabe')
                ->orWhere('nomor_spj', 'LIKE', '%/TKB/%')
                ->delete();
        }

        // 4. Drop tabel modul eksklusif Tokabe
        Schema::dropIfExists('penjualan_jasa_tokabe');
        Schema::dropIfExists('penjualan_tokabe');

        // 5. Bersihkan master invoice & perusahaan Tokabe
        if (Schema::hasTable('invoice')) {
            DB::table('invoice')
                ->where('id', 5)
                ->orWhere('kode_invoice', 'TKBP')
                ->orWhere('perusahaan_id', 2)
                ->delete();
        }

        if (Schema::hasTable('perusahaan')) {
            DB::table('perusahaan')
                ->whereIn('id', [2, 7])
                ->orWhere('nama_perusahaan', 'LIKE', '%Karya Berkah%')
                ->delete();
        }

        // 6. Bersihkan user khusus Tokabe (role AdminTKB atau email domain tokabe.id)
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('role', 'AdminTKB')
                ->orWhere('email', 'LIKE', '%@tokabe.id')
                ->delete();
        }

        // 7. Normalisasi Data Ibekami & Penanganan Edge-cases (NULL Values)
        if (Schema::hasTable('penjualan')) {
            DB::table('penjualan')->update([
                'dp'               => DB::raw('COALESCE(dp, 0)'),
                'potongan'         => DB::raw('COALESCE(potongan, 0)'),
                'diskon'           => DB::raw('COALESCE(diskon, 0)'),
                'ppn'              => DB::raw('COALESCE(ppn, 0)'),
                'total_harga'      => DB::raw('COALESCE(total_harga, 0)'),
                'total_pembayaran' => DB::raw('COALESCE(total_pembayaran, 0)'),
                'sisa_pembayaran'  => DB::raw('COALESCE(sisa_pembayaran, 0)'),
            ]);

            // Koreksi anomali timestamp jika ada record invalid
            DB::table('penjualan')
                ->whereNull('tgl_penjualan')
                ->orWhere('tgl_penjualan', '0000-00-00 00:00:00')
                ->update(['tgl_penjualan' => DB::raw('COALESCE(created_at, NOW())')]);

            DB::table('penjualan')
                ->whereNull('tgl_selesai')
                ->orWhere('tgl_selesai', '0000-00-00')
                ->update(['tgl_selesai' => DB::raw('DATE(COALESCE(tgl_penjualan, created_at, NOW()))')]);
        }

        if (Schema::hasTable('penjualan_barang')) {
            DB::table('penjualan_barang')->update([
                'qty'          => DB::raw('COALESCE(qty, 0)'),
                'hargaBarang'  => DB::raw('COALESCE(hargaBarang, 0)'),
                'jumlah_harga' => DB::raw('COALESCE(jumlah_harga, 0)'),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Migrasi ini bersifat data cleansing permanen (one-way).
    }
};
