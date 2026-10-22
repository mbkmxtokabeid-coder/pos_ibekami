-- ==============================================================================
-- ETL & DATA MIGRATION SCRIPT: PEMBERSIHAN TOTAL DATA & MODUL TOKABE
-- Target: Database Ibekami (kasir_ibekami)
-- Tanggal: 22 Oktober 2026
-- ==============================================================================

START TRANSACTION;

SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- ------------------------------------------------------------------------------
-- 1. IDENTIFIKASI SEMUA RECORD TOKABE PADA TABEL TRANSAKSI PENJUALAN
-- ------------------------------------------------------------------------------
DROP TEMPORARY TABLE IF EXISTS temp_tokabe_penjualan_ids;
CREATE TEMPORARY TABLE temp_tokabe_penjualan_ids AS
SELECT id FROM penjualan 
WHERE invoice = 5 
   OR nomor_invoice LIKE 'TKB%' 
   OR nomor_invoice LIKE '%/TKB/%'
   OR no_rek = 'TKB';

-- ------------------------------------------------------------------------------
-- 2. HAPUS CHILD RECORDS TOKABE DARI TABEL IBEKAMI
-- ------------------------------------------------------------------------------
-- A. Hapus child items dari penjualan_barang yang berelasi dengan Tokabe
DELETE pb FROM penjualan_barang pb
INNER JOIN temp_tokabe_penjualan_ids t ON pb.penjualan_id = t.id;

-- B. Hapus log update invoice terkait
DELETE l FROM invoice_update_logs l
INNER JOIN temp_tokabe_penjualan_ids t ON l.invoice_id = t.id;

-- C. Hapus data transaksi Tokabe dari tabel penjualan
DELETE p FROM penjualan p
INNER JOIN temp_tokabe_penjualan_ids t ON p.id = t.id;

-- D. Hapus SPK (Surat Perintah Kerja) yang merujuk pada nomor invoice Tokabe
DELETE FROM spk 
WHERE nomor_invoice LIKE 'TKB%' 
   OR nomor_invoice LIKE '%/TKB/%';

-- E. Hapus SPJ (Surat Perintah Jalan) Tokabe
DELETE FROM spj 
WHERE perusahaan = 'Tokabe' 
   OR nomor_spj LIKE '%/TKB/%';

-- ------------------------------------------------------------------------------
-- 3. DROP TABEL MODUL EKSKLUSIF TOKABE
-- ------------------------------------------------------------------------------
DROP TABLE IF EXISTS penjualan_jasa_tokabe;
DROP TABLE IF EXISTS penjualan_tokabe;

-- ------------------------------------------------------------------------------
-- 4. BERSIHKAN MASTER DATA & USER TOKABE
-- ------------------------------------------------------------------------------
-- Hapus jenis invoice Tokabe (ID 5 / TKBP)
DELETE FROM invoice 
WHERE id = 5 
   OR kode_invoice = 'TKBP' 
   OR perusahaan_id = 2;

-- Hapus entitas perusahaan Tokabe & test dummy
DELETE FROM perusahaan 
WHERE id IN (2, 7) 
   OR LOWER(nama_perusahaan) LIKE '%karya berkah%';

-- Hapus akun user Tokabe (role AdminTKB atau email domain @tokabe.id)
DELETE FROM users 
WHERE role = 'AdminTKB' 
   OR email LIKE '%@tokabe.id';

-- ------------------------------------------------------------------------------
-- 5. NORMALISASI DATA IBEKAMI & PENANGANAN EDGE-CASES (NULL & TIMESTAMPS)
-- ------------------------------------------------------------------------------
UPDATE penjualan SET
    dp = COALESCE(dp, 0),
    potongan = COALESCE(potongan, 0),
    diskon = COALESCE(diskon, 0),
    ppn = COALESCE(ppn, 0),
    total_harga = COALESCE(total_harga, 0),
    total_pembayaran = COALESCE(total_pembayaran, 0),
    sisa_pembayaran = COALESCE(sisa_pembayaran, 0);

UPDATE penjualan_barang SET
    qty = COALESCE(qty, 0),
    hargaBarang = COALESCE(hargaBarang, 0),
    jumlah_harga = COALESCE(jumlah_harga, 0);

UPDATE penjualan 
SET tgl_penjualan = COALESCE(created_at, NOW()) 
WHERE tgl_penjualan IS NULL OR tgl_penjualan = '0000-00-00 00:00:00';

UPDATE penjualan 
SET tgl_selesai = DATE(COALESCE(tgl_penjualan, created_at, NOW())) 
WHERE tgl_selesai IS NULL OR tgl_selesai = '0000-00-00';

-- ------------------------------------------------------------------------------
-- 6. STANDARISASI AUTO-INCREMENT ALIGNMENT
-- ------------------------------------------------------------------------------
SET @max_penjualan_id = (SELECT IFNULL(MAX(id), 0) + 1 FROM penjualan);
SET @sql_penjualan = CONCAT('ALTER TABLE penjualan AUTO_INCREMENT = ', @max_penjualan_id);
PREPARE stmt1 FROM @sql_penjualan;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;

SET @max_pb_id = (SELECT IFNULL(MAX(id), 0) + 1 FROM penjualan_barang);
SET @sql_pb = CONCAT('ALTER TABLE penjualan_barang AUTO_INCREMENT = ', @max_pb_id);
PREPARE stmt2 FROM @sql_pb;
EXECUTE stmt2;
DEALLOCATE PREPARE stmt2;

SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;

COMMIT;
