-- =====================================================================
-- SKRIP UPDATE DATABASE: FITUR TANDA TANGAN DIGITAL ADMIN
-- Proyek: Tokabe / Ibekami Invoice
-- Tanggal: 29 Oktober 2026
-- =====================================================================
-- Skrip ini HANYA menambahkan kolom baru dan data yang dibutuhkan,
-- TIDAK AKAN menghapus atau merusak data yang sudah ada di database.
-- =====================================================================

-- 1. Tambah kolom `tanda_tangan` di tabel `users` (jika belum ada)
SET @dbname = DATABASE();
SET @tablename = "users";
SET @columnname = "tanda_tangan";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      TABLE_SCHEMA = @dbname
      AND TABLE_NAME = @tablename
      AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 'Kolom tanda_tangan sudah ada di users' AS info;",
  "ALTER TABLE `users` ADD COLUMN `tanda_tangan` VARCHAR(255) NULL AFTER `role`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;


-- 2. Tambah kolom `tanda_tangan` di tabel `penjualan` (jika belum ada)
SET @tablename = "penjualan";
SET @columnname = "tanda_tangan";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      TABLE_SCHEMA = @dbname
      AND TABLE_NAME = @tablename
      AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 'Kolom tanda_tangan sudah ada di penjualan' AS info;",
  "ALTER TABLE `penjualan` ADD COLUMN `tanda_tangan` VARCHAR(255) NULL AFTER `admin`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;


-- 3. Set tanda tangan default untuk Admin Namira (ID 8)
UPDATE `users`
SET `tanda_tangan` = 'ttd_namira.png'
WHERE `id` = 8 AND (`tanda_tangan` IS NULL OR `tanda_tangan` = '');


-- 4. Set snapshot tanda tangan untuk invoice lama milik Namira
UPDATE `penjualan`
SET `tanda_tangan` = 'ttd_namira.png'
WHERE (`admin` = 8 OR `admin` = '8' OR `admin` LIKE '%Namira%')
  AND (`tanda_tangan` IS NULL OR `tanda_tangan` = '');


-- 5. Catat riwayat migrasi Laravel agar tidak error saat 'php artisan migrate' dijalankan nanti
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_10_28_000001_add_tanda_tangan_to_users_and_penjualan_table', (SELECT IFNULL(MAX(`batch`), 0) + 1 FROM `migrations` AS m)
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1 FROM `migrations` WHERE `migration` = '2026_10_28_000001_add_tanda_tangan_to_users_and_penjualan_table'
);

-- Selesai!

