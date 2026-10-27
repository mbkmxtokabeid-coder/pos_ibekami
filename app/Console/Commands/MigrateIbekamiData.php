<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateIbekamiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ibekami:migrate-data {--staging-db=kasir_staging_old : The staging database name} {--force : Force execution without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate, clean, and map legacy Ibekami data from staging database to target database while completely filtering Tokabe data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stagingDb = $this->option('staging-db');
        $targetDb = config('database.connections.mysql.database');

        $this->info("======================================================================");
        $this->info("      IBEKAMI ETL DATA MIGRATION ENGINE (SENIOR DATA ENGINEER)        ");
        $this->info("======================================================================");
        $this->line("Staging Source DB : <fg=yellow>{$stagingDb}</>");
        $this->line("Target DB         : <fg=green>{$targetDb}</>");

        if (!$this->option('force')) {
            if (!$this->confirm("WARNING: This will truncate current tables in '{$targetDb}' and reload clean Ibekami data from '{$stagingDb}'. Continue?")) {
                $this->warn("Migration cancelled by user.");
                return 0;
            }
        }

        $startTime = microtime(true);

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');

            // 1. Truncate target tables
            $this->info("\n[1/13] Mengosongkan tabel target...");
            $tables = [
                'users', 'perusahaan', 'invoice', 'kategori_barang', 'barang', 'material', 'inventaris',
                'budget', 'vendor', 'pembelian', 'pembelian_barang', 'order', 'spb', 'barang_spb',
                'spk', 'spj', 'penjualan', 'penjualan_barang', 'invoice_update_logs',
                'notifications', 'owner_access_links', 'password_resets', 'password_reset_tokens', 'personal_access_tokens'
            ];
            foreach ($tables as $t) {
                if (Schema::hasTable($t)) {
                    DB::table($t)->truncate();
                }
            }

            // 2. Users
            $this->info("[2/13] Migrasi Master Users (Membuang role AdminTKB & @tokabe.id)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`users` (id, nama, email, password, status, nomor_telepon, role, remember_token, device_token, created_at, updated_at)
                SELECT id, nama, email, password, status, nomor_telepon, role, remember_token, device_token, created_at, updated_at
                FROM `{$stagingDb}`.`users`
                WHERE role != 'AdminTKB' AND email NOT LIKE '%@tokabe.id'
            ");

            // 3. Perusahaan
            $this->info("[3/13] Migrasi Master Perusahaan (Hanya id=1: Ibekami)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`perusahaan` (id, nama_perusahaan, no_hp, alamat_perusahaan, logo, created_at, updated_at, deleted_at)
                SELECT id, nama_perusahaan, no_hp, alamat_perusahaan, logo, created_at, updated_at, deleted_at
                FROM `{$stagingDb}`.`perusahaan`
                WHERE id = 1
            ");

            // 4. Invoice Types
            $this->info("[4/13] Migrasi Master Invoice (Hanya id IN (1,2,3,4): IBPL, IB, IBTR, IBS)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`invoice` (id, nama_invoice, kode_invoice, perusahaan_id, tipe_harga, created_at, updated_at)
                SELECT id, nama_invoice, kode_invoice, perusahaan_id, 'Retail', created_at, updated_at
                FROM `{$stagingDb}`.`invoice`
                WHERE id IN (1, 2, 3, 4)
            ");

            // 5. Kategori Barang
            $this->info("[5/13] Migrasi Kategori Barang...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`kategori_barang` (id, nama_kategori, created_at, updated_at)
                SELECT id, nama_kategori, created_at, updated_at
                FROM `{$stagingDb}`.`kategori_barang`
            ");

            // 6. Barang
            $this->info("[6/13] Migrasi Master Barang (Menyaring item Tokabe)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`barang` (id, jenis_barang, kode_barang, kategori_id, stok, tgl_masuk, harga_modal, harga_jual, created_at, updated_at, is_active, is_material_required)
                SELECT id, jenis_barang, kode_barang, kategori_id, stok, tgl_masuk, harga_modal, harga_jual, created_at, updated_at, is_active, is_material_required
                FROM `{$stagingDb}`.`barang`
                WHERE id != 644 AND jenis_barang NOT LIKE '%Tokabe%'
            ");

            // 7. Material & Inventaris
            $this->info("[7/13] Migrasi Material & Inventaris...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`material` (id, kode_material, jenis_material, stok, satuan, harga_modal, harga_jual, created_at, updated_at)
                SELECT id, kode_material, jenis_material, stok, satuan, harga_modal, harga_jual, created_at, updated_at
                FROM `{$stagingDb}`.`material`
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`inventaris` (id, kode_inventaris, jenis_inventaris, stok, tgl_beli, created_at, updated_at)
                SELECT id, kode_inventaris, jenis_inventaris, stok, tgl_beli, created_at, updated_at
                FROM `{$stagingDb}`.`inventaris`
            ");

            // 8. Purchasing
            $this->info("[8/13] Migrasi Purchasing (Budget, Vendor, Pembelian & Pembelian Barang)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`budget` (id, nama_budget, kategori_id, anggaran, tanggal, created_at, updated_at, deleted_at)
                SELECT id, nama_budget, kategori_id, anggaran, tanggal, created_at, updated_at, deleted_at
                FROM `{$stagingDb}`.`budget`
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`vendor` (id, nama_vendor, total_pembelian, pembelian_sisa, pembelian_terbayar, created_at, updated_at)
                SELECT id, nama_vendor, total_pembelian, pembelian_sisa, pembelian_terbayar, created_at, updated_at
                FROM `{$stagingDb}`.`vendor`
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`pembelian` (
                    id, anggaran, id_vendor, nomor_inv, tanggal, tgl_jto, tgl_lunas, 
                    status, terbayar, sisa, jumlah_harga, created_at, updated_at, token, 
                    jenis_invoice, ppn_persen, ppn_nominal, pph_persen, pph_nominal, tanggal_jto, approval, approved_at
                )
                SELECT 
                    id, anggaran, id_vendor, nomor_inv, tanggal, tgl_jto, tgl_lunas, 
                    status, terbayar, sisa, jumlah_harga, created_at, updated_at, token, 
                    'Non Pajak', 0, 0, 0, 0, tgl_jto, 'Unlock', NULL
                FROM `{$stagingDb}`.`pembelian`
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`pembelian_barang` (id, pembelian_id, deskripsi, qty, satuan, harga_barang, total, created_at, updated_at)
                SELECT pb.id, pb.pembelian_id, pb.deskripsi, pb.qty, pb.satuan, pb.harga_barang, pb.total, pb.created_at, pb.updated_at
                FROM `{$stagingDb}`.`pembelian_barang` pb
                INNER JOIN `{$targetDb}`.`pembelian` p ON pb.pembelian_id = p.id
            ");

            // 9. Orders, SPB, Barang SPB, SPK, SPJ
            $this->info("[9/13] Migrasi Order, SPB, SPK, SPJ (Filter Tokabe & Lindungi FK)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`order` (id, order_by, created_at, updated_at)
                SELECT id, order_by, created_at, updated_at
                FROM `{$stagingDb}`.`order`
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`spb` (id, nama_spb, customer, perusahaan, nomor_telepon, nama_penandatangan, jumlah_item, status, created_at, updated_at)
                SELECT id, nama_spb, customer, perusahaan, nomor_telepon, nama_penandatangan, jumlah_item, status, created_at, updated_at
                FROM `{$stagingDb}`.`spb`
                WHERE nama_spb = 1
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`barang_spb` (id, spb, barang_id, deskripsi, satuan, qty, keterangan, created_at, updated_at)
                SELECT b.id, b.spb, b.barang_id, b.deskripsi, b.satuan, b.qty, b.keterangan, b.created_at, b.updated_at
                FROM `{$stagingDb}`.`barang_spb` b
                INNER JOIN `{$targetDb}`.`spb` s ON b.spb = s.id
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`spk` (
                    id, nomor_invoice, customer, jumlah, satuan, jenis_bahan, ketebalan, ukuran, 
                    lain, express, tgl_mulai, target_selesai, timeline, timeline_design, timeline_produksi, 
                    status_spk, status_kerja, created_at, updated_at, pekerjaan, gambar
                )
                SELECT 
                    id, nomor_invoice, customer, jumlah, satuan, jenis_bahan, ketebalan, ukuran, 
                    lain, express, tgl_mulai, target_selesai, timeline, timeline_design, timeline_produksi, 
                    status_spk, status_kerja, created_at, updated_at, pekerjaan, gambar
                FROM `{$stagingDb}`.`spk`
                WHERE nomor_invoice NOT LIKE 'TKB%' AND nomor_invoice NOT LIKE '%/TKB/%'
            ");
            DB::statement("
                INSERT INTO `{$targetDb}`.`spj` (
                    id, nomor_spj, perusahaan, nama_pemberi_tugas, nama_kurir, tanggal_tugas, waktu_berangkat, 
                    tujuan, biaya_bahan_bakar, jarak_tempuh, deskripsi_barang, keterangan_tambahan, deskripsi_tugas, 
                    jam_kembali, status, created_at, updated_at
                )
                SELECT 
                    id, nomor_spj, perusahaan, nama_pemberi_tugas, nama_kurir, tanggal_tugas, waktu_berangkat, 
                    tujuan, biaya_bahan_bakar, jarak_tempuh, deskripsi_barang, keterangan_tambahan, deskripsi_tugas, 
                    jam_kembali, status, created_at, updated_at
                FROM `{$stagingDb}`.`spj`
                WHERE perusahaan != 'Tokabe' AND nomor_spj NOT LIKE '%TKB%'
            ");

            // 10. Penjualan
            $this->info("[10/13] Migrasi Invoices Utama / Penjualan (Normalisasi NULL & Timestamp)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`penjualan` (
                    id, invoice, nomor_invoice, tgl_penjualan, customer, perusahaan, no_telepon, 
                    admin, order_by, nama_sales, tgl_selesai, express, jumlah_item, dp, 
                    jenis_pembayaran, no_rek, total_harga, status, alasan_batal, approval, 
                    approved_at, potongan, diskon, ppn, total_pembayaran, sisa_pembayaran, 
                    created_at, updated_at, deleted_at, alasan_hapus
                )
                SELECT 
                    id, invoice, nomor_invoice,
                    CASE 
                        WHEN tgl_penjualan IS NULL OR tgl_penjualan = '0000-00-00 00:00:00' 
                        THEN COALESCE(created_at, NOW()) 
                        ELSE tgl_penjualan 
                    END,
                    customer, perusahaan, no_telepon, admin, order_by, nama_sales,
                    CASE 
                        WHEN tgl_selesai IS NULL OR tgl_selesai = '0000-00-00' 
                        THEN DATE(COALESCE(tgl_penjualan, created_at, NOW())) 
                        ELSE tgl_selesai 
                    END,
                    express, jumlah_item,
                    COALESCE(dp, 0),
                    jenis_pembayaran, no_rek,
                    COALESCE(total_harga, 0),
                    status, alasan_batal, approval, approved_at,
                    COALESCE(potongan, 0),
                    COALESCE(diskon, 0),
                    COALESCE(ppn, 0),
                    COALESCE(total_pembayaran, 0),
                    COALESCE(sisa_pembayaran, 0),
                    created_at, updated_at, deleted_at,
                    NULL
                FROM `{$stagingDb}`.`penjualan`
                WHERE NOT (
                    invoice = 5 
                    OR nomor_invoice LIKE 'TKB%' 
                    OR nomor_invoice LIKE '%/TKB/%' 
                    OR COALESCE(no_rek, '') = 'TKB'
                )
            ");

            // 11. Penjualan Barang
            $this->info("[11/13] Migrasi Penjualan Barang (Invoice Items)...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`penjualan_barang` (
                    id, barang_id, material_id, material_qty, penjualan_id, deskripsi_item, 
                    qty, satuan, hargaBarang, jumlah_harga, created_at, updated_at, 
                    deleted_at, material_panjang, material_lebar
                )
                SELECT 
                    pb.id, pb.barang_id, pb.material_id, pb.material_qty, pb.penjualan_id, pb.deskripsi_item,
                    COALESCE(pb.qty, 0), pb.satuan,
                    COALESCE(pb.hargaBarang, 0),
                    COALESCE(pb.jumlah_harga, 0),
                    pb.created_at, pb.updated_at, pb.deleted_at, pb.material_panjang, pb.material_lebar
                FROM `{$stagingDb}`.`penjualan_barang` pb
                INNER JOIN `{$targetDb}`.`penjualan` p ON pb.penjualan_id = p.id
            ");

            // 12. Invoice Update Logs
            $this->info("[12/13] Migrasi Invoice Update Logs...");
            DB::statement("
                INSERT INTO `{$targetDb}`.`invoice_update_logs` (id, invoice_id, created_at)
                SELECT l.id, l.invoice_id, l.created_at
                FROM `{$stagingDb}`.`invoice_update_logs` l
                INNER JOIN `{$targetDb}`.`penjualan` p ON l.invoice_id = p.id
            ");

            // 13. Auto Increment Alignment
            $this->info("[13/13] Menyelaraskan sequence AUTO_INCREMENT...");
            $autoIncTables = [
                'users', 'perusahaan', 'invoice', 'kategori_barang', 'barang', 'material', 'inventaris',
                'budget', 'vendor', 'pembelian', 'pembelian_barang', 'order', 'spb', 'barang_spb',
                'spk', 'spj', 'penjualan', 'penjualan_barang', 'invoice_update_logs'
            ];
            foreach ($autoIncTables as $t) {
                if (Schema::hasTable($t)) {
                    $maxId = (int) DB::table($t)->max('id');
                    $nextId = $maxId + 1;
                    DB::statement("ALTER TABLE `{$targetDb}`.`{$t}` AUTO_INCREMENT = {$nextId}");
                }
            }

            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

            $duration = round(microtime(true) - $startTime, 2);
            $this->info("\n======================================================================");
            $this->info("   MIGRASI ETL BERHASIL DALAM {$duration} DETIK! MEMULAI VALIDASI...  ");
            $this->info("======================================================================");

            // Audit Summary
            $countPenjualan = DB::table('penjualan')->count();
            $nominalPenjualan = DB::table('penjualan')->sum('total_pembayaran');
            $countItems = DB::table('penjualan_barang')->count();
            $nominalItems = DB::table('penjualan_barang')->sum('jumlah_harga');

            $this->table(
                ['Entity', 'Actual Record Count', 'Actual Total Nominal (Rp)', 'Status'],
                [
                    ['Penjualan (Invoices)', number_format($countPenjualan), 'Rp ' . number_format($nominalPenjualan, 0, ',', '.'), $countPenjualan === 1054 ? 'MATCH' : 'MISMATCH'],
                    ['Penjualan Items', number_format($countItems), 'Rp ' . number_format($nominalItems, 0, ',', '.'), $countItems === 1848 ? 'MATCH' : 'MISMATCH'],
                ]
            );

            // Check leak
            $leakCount = DB::table('penjualan')
                ->where('invoice', 5)
                ->orWhere('nomor_invoice', 'LIKE', '%TKB%')
                ->orWhere('no_rek', 'TKB')
                ->count();

            if ($leakCount === 0) {
                $this->info("TOKABE LEAK AUDIT: 0 Tokabe record found. 100% CLEAN!");
            } else {
                $this->error("CRITICAL: {$leakCount} Tokabe records leaked into target!");
            }

            return 0;

        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
            $this->error("ETL Migration Error: " . $e->getMessage());
            return 1;
        }
    }
}
