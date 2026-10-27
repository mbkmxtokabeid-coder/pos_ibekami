-- ==============================================================================
-- ETL MIGRATION SCRIPT: LEGACY DATABASE TO CLEAN IBEKAMI SCHEMA
-- Source Database (Staging): `kasir_staging_old` (Loaded from data_yang lama.sql)
-- Target Database (New)    : `kasir_ibekami`
-- Author                   : Senior Backend & Data Migration Engineer
-- Date                     : 27 Oktober 2026
-- ==============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- ------------------------------------------------------------------------------
-- STEP 1: TRUNCATE TARGET TABLES (Bersihkan data target sebelum load)
-- ------------------------------------------------------------------------------
TRUNCATE TABLE `kasir_ibekami`.`users`;
TRUNCATE TABLE `kasir_ibekami`.`perusahaan`;
TRUNCATE TABLE `kasir_ibekami`.`invoice`;
TRUNCATE TABLE `kasir_ibekami`.`kategori_barang`;
TRUNCATE TABLE `kasir_ibekami`.`barang`;
TRUNCATE TABLE `kasir_ibekami`.`material`;
TRUNCATE TABLE `kasir_ibekami`.`inventaris`;
TRUNCATE TABLE `kasir_ibekami`.`budget`;
TRUNCATE TABLE `kasir_ibekami`.`vendor`;
TRUNCATE TABLE `kasir_ibekami`.`pembelian`;
TRUNCATE TABLE `kasir_ibekami`.`pembelian_barang`;
TRUNCATE TABLE `kasir_ibekami`.`order`;
TRUNCATE TABLE `kasir_ibekami`.`spb`;
TRUNCATE TABLE `kasir_ibekami`.`barang_spb`;
TRUNCATE TABLE `kasir_ibekami`.`spk`;
TRUNCATE TABLE `kasir_ibekami`.`spj`;
TRUNCATE TABLE `kasir_ibekami`.`penjualan`;
TRUNCATE TABLE `kasir_ibekami`.`penjualan_barang`;
TRUNCATE TABLE `kasir_ibekami`.`invoice_update_logs`;
TRUNCATE TABLE `kasir_ibekami`.`notifications`;
TRUNCATE TABLE `kasir_ibekami`.`owner_access_links`;
TRUNCATE TABLE `kasir_ibekami`.`password_resets`;
TRUNCATE TABLE `kasir_ibekami`.`password_reset_tokens`;
TRUNCATE TABLE `kasir_ibekami`.`personal_access_tokens`;

-- ------------------------------------------------------------------------------
-- STEP 2: MIGRATE USERS (Filter out Tokabe roles & emails)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`users` (
    `id`, `nama`, `email`, `password`, `status`, `nomor_telepon`, 
    `role`, `remember_token`, `device_token`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nama`, `email`, `password`, `status`, `nomor_telepon`, 
    `role`, `remember_token`, `device_token`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`users`
WHERE `role` != 'AdminTKB' 
  AND `email` NOT LIKE '%@tokabe.id';

-- ------------------------------------------------------------------------------
-- STEP 3: MIGRATE PERUSAHAAN (Hanya id = 1: Ibekami)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`perusahaan` (
    `id`, `nama_perusahaan`, `no_hp`, `alamat_perusahaan`, `logo`, 
    `created_at`, `updated_at`, `deleted_at`
)
SELECT 
    `id`, `nama_perusahaan`, `no_hp`, `alamat_perusahaan`, `logo`, 
    `created_at`, `updated_at`, `deleted_at`
FROM `kasir_staging_old`.`perusahaan`
WHERE `id` = 1;

-- ------------------------------------------------------------------------------
-- STEP 4: MIGRATE MASTER INVOICE (Hanya id IN (1,2,3,4): IBPL, IB, IBTR, IBS)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`invoice` (
    `id`, `nama_invoice`, `kode_invoice`, `perusahaan_id`, `tipe_harga`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nama_invoice`, `kode_invoice`, `perusahaan_id`, 'Retail', `created_at`, `updated_at`
FROM `kasir_staging_old`.`invoice`
WHERE `id` IN (1, 2, 3, 4);

-- ------------------------------------------------------------------------------
-- STEP 5: MIGRATE KATEGORI BARANG
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`kategori_barang` (
    `id`, `nama_kategori`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nama_kategori`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`kategori_barang`;

-- ------------------------------------------------------------------------------
-- STEP 6: MIGRATE BARANG (Filter item Tokabe seperti id 644)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`barang` (
    `id`, `jenis_barang`, `kode_barang`, `kategori_id`, `stok`, 
    `tgl_masuk`, `harga_modal`, `harga_jual`, `created_at`, `updated_at`, 
    `is_active`, `is_material_required`
)
SELECT 
    `id`, `jenis_barang`, `kode_barang`, `kategori_id`, `stok`, 
    `tgl_masuk`, `harga_modal`, `harga_jual`, `created_at`, `updated_at`, 
    `is_active`, `is_material_required`
FROM `kasir_staging_old`.`barang`
WHERE `id` != 644 
  AND `jenis_barang` NOT LIKE '%Tokabe%';

-- ------------------------------------------------------------------------------
-- STEP 7: MIGRATE MATERIAL & INVENTARIS
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`material` (
    `id`, `kode_material`, `jenis_material`, `stok`, `satuan`, 
    `harga_modal`, `harga_jual`, `created_at`, `updated_at`
)
SELECT 
    `id`, `kode_material`, `jenis_material`, `stok`, `satuan`, 
    `harga_modal`, `harga_jual`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`material`;

INSERT INTO `kasir_ibekami`.`inventaris` (
    `id`, `kode_inventaris`, `jenis_inventaris`, `stok`, `tgl_beli`, `created_at`, `updated_at`
)
SELECT 
    `id`, `kode_inventaris`, `jenis_inventaris`, `stok`, `tgl_beli`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`inventaris`;

-- ------------------------------------------------------------------------------
-- STEP 8: MIGRATE PURCHASING (Budget, Vendor, Pembelian, Pembelian Barang)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`budget` (
    `id`, `nama_budget`, `kategori_id`, `anggaran`, `tanggal`, `created_at`, `updated_at`, `deleted_at`
)
SELECT 
    `id`, `nama_budget`, `kategori_id`, `anggaran`, `tanggal`, `created_at`, `updated_at`, `deleted_at`
FROM `kasir_staging_old`.`budget`;

INSERT INTO `kasir_ibekami`.`vendor` (
    `id`, `nama_vendor`, `total_pembelian`, `pembelian_sisa`, `pembelian_terbayar`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nama_vendor`, `total_pembelian`, `pembelian_sisa`, `pembelian_terbayar`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`vendor`;

INSERT INTO `kasir_ibekami`.`pembelian` (
    `id`, `anggaran`, `id_vendor`, `nomor_inv`, `tanggal`, `tgl_jto`, `tgl_lunas`, 
    `status`, `terbayar`, `sisa`, `jumlah_harga`, `created_at`, `updated_at`, `token`, 
    `jenis_invoice`, `ppn_persen`, `ppn_nominal`, `pph_persen`, `pph_nominal`, `tanggal_jto`, `approval`, `approved_at`
)
SELECT 
    `id`, `anggaran`, `id_vendor`, `nomor_inv`, `tanggal`, `tgl_jto`, `tgl_lunas`, 
    `status`, `terbayar`, `sisa`, `jumlah_harga`, `created_at`, `updated_at`, `token`, 
    'Non Pajak', 0, 0, 0, 0, `tgl_jto`, 'Unlock', NULL
FROM `kasir_staging_old`.`pembelian`;

INSERT INTO `kasir_ibekami`.`pembelian_barang` (
    `id`, `pembelian_id`, `deskripsi`, `qty`, `satuan`, `harga_barang`, `total`, `created_at`, `updated_at`
)
SELECT 
    pb.`id`, pb.`pembelian_id`, pb.`deskripsi`, pb.`qty`, pb.`satuan`, pb.`harga_barang`, pb.`total`, pb.`created_at`, pb.`updated_at`
FROM `kasir_staging_old`.`pembelian_barang` pb
INNER JOIN `kasir_ibekami`.`pembelian` p ON pb.`pembelian_id` = p.`id`;

-- ------------------------------------------------------------------------------
-- STEP 9: MIGRATE ORDERS, SPB, BARANG SPB, SPK, SPJ
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`order` (`id`, `order_by`, `created_at`, `updated_at`)
SELECT `id`, `order_by`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`order`;

-- SPB: Hanya nama_spb = 1 (Ibekami)
INSERT INTO `kasir_ibekami`.`spb` (
    `id`, `nama_spb`, `customer`, `perusahaan`, `nomor_telepon`, `nama_penandatangan`, `jumlah_item`, `status`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nama_spb`, `customer`, `perusahaan`, `nomor_telepon`, `nama_penandatangan`, `jumlah_item`, `status`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`spb`
WHERE `nama_spb` = 1;

-- BARANG SPB: Hanya relasi ke SPB Ibekami
INSERT INTO `kasir_ibekami`.`barang_spb` (
    `id`, `spb`, `barang_id`, `deskripsi`, `satuan`, `qty`, `keterangan`, `created_at`, `updated_at`
)
SELECT 
    b.`id`, b.`spb`, b.`barang_id`, b.`deskripsi`, b.`satuan`, b.`qty`, b.`keterangan`, b.`created_at`, b.`updated_at`
FROM `kasir_staging_old`.`barang_spb` b
INNER JOIN `kasir_ibekami`.`spb` s ON b.`spb` = s.`id`;

-- SPK: Exclude Tokabe (nomor_invoice TKB)
INSERT INTO `kasir_ibekami`.`spk` (
    `id`, `nomor_invoice`, `customer`, `jumlah`, `satuan`, `jenis_bahan`, `ketebalan`, `ukuran`, 
    `lain`, `express`, `tgl_mulai`, `target_selesai`, `timeline`, `timeline_design`, `timeline_produksi`, 
    `status_spk`, `status_kerja`, `created_at`, `updated_at`, `pekerjaan`, `gambar`
)
SELECT 
    `id`, `nomor_invoice`, `customer`, `jumlah`, `satuan`, `jenis_bahan`, `ketebalan`, `ukuran`, 
    `lain`, `express`, `tgl_mulai`, `target_selesai`, `timeline`, `timeline_design`, `timeline_produksi`, 
    `status_spk`, `status_kerja`, `created_at`, `updated_at`, `pekerjaan`, `gambar`
FROM `kasir_staging_old`.`spk`
WHERE `nomor_invoice` NOT LIKE 'TKB%' 
  AND `nomor_invoice` NOT LIKE '%/TKB/%';

-- SPJ: Exclude Tokabe
INSERT INTO `kasir_ibekami`.`spj` (
    `id`, `nomor_spj`, `perusahaan`, `nama_pemberi_tugas`, `nama_kurir`, `tanggal_tugas`, `waktu_berangkat`, 
    `tujuan`, `biaya_bahan_bakar`, `jarak_tempuh`, `deskripsi_barang`, `keterangan_tambahan`, `deskripsi_tugas`, 
    `jam_kembali`, `status`, `created_at`, `updated_at`
)
SELECT 
    `id`, `nomor_spj`, `perusahaan`, `nama_pemberi_tugas`, `nama_kurir`, `tanggal_tugas`, `waktu_berangkat`, 
    `tujuan`, `biaya_bahan_bakar`, `jarak_tempuh`, `deskripsi_barang`, `keterangan_tambahan`, `deskripsi_tugas`, 
    `jam_kembali`, `status`, `created_at`, `updated_at`
FROM `kasir_staging_old`.`spj`
WHERE `perusahaan` != 'Tokabe' 
  AND `nomor_spj` NOT LIKE '%TKB%';

-- ------------------------------------------------------------------------------
-- STEP 10: MIGRATE PENJUALAN (CORE INVOICES)
-- Handle: NULL sanitization, zero-date corrections, and strict Tokabe filtering
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`penjualan` (
    `id`, `invoice`, `nomor_invoice`, `tgl_penjualan`, `customer`, `perusahaan`, `no_telepon`, 
    `admin`, `order_by`, `nama_sales`, `tgl_selesai`, `express`, `jumlah_item`, `dp`, 
    `jenis_pembayaran`, `no_rek`, `total_harga`, `status`, `alasan_batal`, `approval`, 
    `approved_at`, `potongan`, `diskon`, `ppn`, `total_pembayaran`, `sisa_pembayaran`, 
    `created_at`, `updated_at`, `deleted_at`, `alasan_hapus`
)
SELECT 
    `id`, `invoice`, `nomor_invoice`,
    CASE 
        WHEN `tgl_penjualan` IS NULL OR `tgl_penjualan` = '0000-00-00 00:00:00' 
        THEN COALESCE(`created_at`, NOW()) 
        ELSE `tgl_penjualan` 
    END AS `tgl_penjualan`,
    `customer`, `perusahaan`, `no_telepon`, `admin`, `order_by`, `nama_sales`,
    CASE 
        WHEN `tgl_selesai` IS NULL OR `tgl_selesai` = '0000-00-00' 
        THEN DATE(COALESCE(`tgl_penjualan`, `created_at`, NOW())) 
        ELSE `tgl_selesai` 
    END AS `tgl_selesai`,
    `express`, `jumlah_item`,
    COALESCE(`dp`, 0) AS `dp`,
    `jenis_pembayaran`, `no_rek`,
    COALESCE(`total_harga`, 0) AS `total_harga`,
    `status`, `alasan_batal`, `approval`, `approved_at`,
    COALESCE(`potongan`, 0) AS `potongan`,
    COALESCE(`diskon`, 0) AS `diskon`,
    COALESCE(`ppn`, 0) AS `ppn`,
    COALESCE(`total_pembayaran`, 0) AS `total_pembayaran`,
    COALESCE(`sisa_pembayaran`, 0) AS `sisa_pembayaran`,
    `created_at`, `updated_at`, `deleted_at`,
    NULL AS `alasan_hapus`
FROM `kasir_staging_old`.`penjualan`
WHERE NOT (
    `invoice` = 5 
    OR `nomor_invoice` LIKE 'TKB%' 
    OR `nomor_invoice` LIKE '%/TKB/%' 
    OR COALESCE(`no_rek`, '') = 'TKB'
);

-- ------------------------------------------------------------------------------
-- STEP 11: MIGRATE PENJUALAN_BARANG (INVOICE ITEMS)
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`penjualan_barang` (
    `id`, `barang_id`, `material_id`, `material_qty`, `penjualan_id`, `deskripsi_item`, 
    `qty`, `satuan`, `hargaBarang`, `jumlah_harga`, `created_at`, `updated_at`, 
    `deleted_at`, `material_panjang`, `material_lebar`
)
SELECT 
    pb.`id`, pb.`barang_id`, pb.`material_id`, pb.`material_qty`, pb.`penjualan_id`, pb.`deskripsi_item`,
    COALESCE(pb.`qty`, 0), pb.`satuan`,
    COALESCE(pb.`hargaBarang`, 0),
    COALESCE(pb.`jumlah_harga`, 0),
    pb.`created_at`, pb.`updated_at`, pb.`deleted_at`, pb.`material_panjang`, pb.`material_lebar`
FROM `kasir_staging_old`.`penjualan_barang` pb
INNER JOIN `kasir_ibekami`.`penjualan` p ON pb.`penjualan_id` = p.`id`;

-- ------------------------------------------------------------------------------
-- STEP 12: MIGRATE INVOICE UPDATE LOGS
-- ------------------------------------------------------------------------------
INSERT INTO `kasir_ibekami`.`invoice_update_logs` (`id`, `invoice_id`, `created_at`)
SELECT l.`id`, l.`invoice_id`, l.`created_at`
FROM `kasir_staging_old`.`invoice_update_logs` l
INNER JOIN `kasir_ibekami`.`penjualan` p ON l.`invoice_id` = p.`id`;

-- ------------------------------------------------------------------------------
-- STEP 13: ALIGN AUTO_INCREMENT COUNTERS (Prevent primary key collision on future inserts)
-- ------------------------------------------------------------------------------
SET @max_user = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`users`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`users` AUTO_INCREMENT = ', @max_user);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_perusahaan = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`perusahaan`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`perusahaan` AUTO_INCREMENT = ', @max_perusahaan);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_invoice = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`invoice`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`invoice` AUTO_INCREMENT = ', @max_invoice);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_kategori = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`kategori_barang`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`kategori_barang` AUTO_INCREMENT = ', @max_kategori);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_barang = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`barang`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`barang` AUTO_INCREMENT = ', @max_barang);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_material = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`material`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`material` AUTO_INCREMENT = ', @max_material);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_inventaris = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`inventaris`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`inventaris` AUTO_INCREMENT = ', @max_inventaris);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_budget = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`budget`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`budget` AUTO_INCREMENT = ', @max_budget);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_vendor = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`vendor`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`vendor` AUTO_INCREMENT = ', @max_vendor);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_pembelian = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`pembelian`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`pembelian` AUTO_INCREMENT = ', @max_pembelian);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_pb = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`pembelian_barang`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`pembelian_barang` AUTO_INCREMENT = ', @max_pb);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_order = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`order`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`order` AUTO_INCREMENT = ', @max_order);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_spb = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`spb`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`spb` AUTO_INCREMENT = ', @max_spb);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_bspb = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`barang_spb`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`barang_spb` AUTO_INCREMENT = ', @max_bspb);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_spk = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`spk`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`spk` AUTO_INCREMENT = ', @max_spk);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_spj = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`spj`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`spj` AUTO_INCREMENT = ', @max_spj);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_penjualan = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`penjualan`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`penjualan` AUTO_INCREMENT = ', @max_penjualan);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_pj_barang = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`penjualan_barang`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`penjualan_barang` AUTO_INCREMENT = ', @max_pj_barang);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @max_logs = (SELECT COALESCE(MAX(id), 0) + 1 FROM `kasir_ibekami`.`invoice_update_logs`);
SET @sql = CONCAT('ALTER TABLE `kasir_ibekami`.`invoice_update_logs` AUTO_INCREMENT = ', @max_logs);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- ETL MIGRATION COMPLETED SUCCESSFULLY!
-- ==============================================================================
