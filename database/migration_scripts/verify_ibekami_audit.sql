-- ==============================================================================
-- POST-MIGRATION AUDIT & FINANCIAL RECONCILIATION QUERY
-- Target Database: `kasir_ibekami`
-- Baseline: data_yang lama.sql (Production Dump 27 Okt 2026)
-- ==============================================================================

USE `kasir_ibekami`;

-- ------------------------------------------------------------------------------
-- 1. AUDIT KEBOCORAN DATA TOKABE (Seluruh nilai WAJIB = 0)
-- ------------------------------------------------------------------------------
SELECT 
    '1. Tokabe Penjualan Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `penjualan`
WHERE `invoice` = 5 
   OR `nomor_invoice` LIKE '%TKB%' 
   OR `no_rek` = 'TKB' 
   OR `perusahaan` LIKE '%Total Karya Berkah%'

UNION ALL

SELECT 
    '2. Tokabe Perusahaan Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `perusahaan`
WHERE `id` IN (2, 7) 
   OR `nama_perusahaan` LIKE '%Total Karya%' 
   OR `nama_perusahaan` LIKE '%Tokabe%'

UNION ALL

SELECT 
    '3. Tokabe Master Invoice Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `invoice`
WHERE `id` = 5 
   OR `kode_invoice` = 'TKBP' 
   OR `nama_invoice` LIKE '%TKB%'

UNION ALL

SELECT 
    '4. Tokabe Users Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `users`
WHERE `role` = 'AdminTKB' 
   OR `email` LIKE '%@tokabe.id'

UNION ALL

SELECT 
    '5. Tokabe SPB Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `spb`
WHERE `nama_spb` = 2 
   OR `perusahaan` LIKE '%Total Karya%'

UNION ALL

SELECT 
    '6. Tokabe SPK Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `spk`
WHERE `nomor_invoice` LIKE '%TKB%'

UNION ALL

SELECT 
    '7. Tokabe SPJ Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `spj`
WHERE `perusahaan` LIKE '%Tokabe%' 
   OR `nomor_spj` LIKE '%TKB%'

UNION ALL

SELECT 
    '8. Tokabe Master Barang Leak' AS Audit_Metric,
    COUNT(*) AS Violation_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED (Clean)' ELSE 'FAILED (Leak Detected)' END AS Status
FROM `barang`
WHERE `id` = 644 
   OR `jenis_barang` LIKE '%Tokabe%';

-- ------------------------------------------------------------------------------
-- 2. FINANCIAL & RECORD RECONCILIATION (Pencocokan Nominal Pembayaran & Qty)
-- Target Expected:
-- - Penjualan: 1.054 records | Total Pembayaran: Rp 1.610.606.537 | Total Harga: Rp 1.611.636.787
-- - Penjualan Barang: 1.848 items | Total Item: Rp 2.088.719.621
-- ------------------------------------------------------------------------------
SELECT 
    'Penjualan (Invoices)' AS Entity,
    COUNT(*) AS Actual_Count,
    1054 AS Expected_Count,
    COUNT(*) - 1054 AS Count_Diff,
    SUM(total_pembayaran) AS Actual_Nominal_Pembayaran,
    1610606537 AS Expected_Nominal_Pembayaran,
    SUM(total_pembayaran) - 1610606537 AS Nominal_Diff,
    SUM(total_harga) AS Actual_Total_Harga,
    1611636787 AS Expected_Total_Harga,
    SUM(total_harga) - 1611636787 AS Total_Harga_Diff
FROM `penjualan`;

SELECT 
    'Penjualan Barang (Invoice Items)' AS Entity,
    COUNT(*) AS Actual_Items_Count,
    1848 AS Expected_Items_Count,
    COUNT(*) - 1848 AS Items_Count_Diff,
    SUM(jumlah_harga) AS Actual_Items_Amount,
    2088719621 AS Expected_Items_Amount,
    SUM(jumlah_harga) - 2088719621 AS Amount_Diff
FROM `penjualan_barang`;

-- ------------------------------------------------------------------------------
-- 3. INTEGRITAS RELASIONAL & ORPHAN RECORD AUDIT (Wajib 0 Orphan)
-- ------------------------------------------------------------------------------
SELECT 
    'Orphan Items (penjualan_barang without penjualan)' AS Relational_Check,
    COUNT(*) AS Orphan_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED' ELSE 'FAILED' END AS Integrity_Status
FROM `penjualan_barang` pb
LEFT JOIN `penjualan` p ON pb.`penjualan_id` = p.`id`
WHERE p.`id` IS NULL

UNION ALL

SELECT 
    'Orphan Update Logs (invoice_update_logs without penjualan)' AS Relational_Check,
    COUNT(*) AS Orphan_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED' ELSE 'FAILED' END AS Integrity_Status
FROM `invoice_update_logs` l
LEFT JOIN `penjualan` p ON l.`invoice_id` = p.`id`
WHERE p.`id` IS NULL

UNION ALL

SELECT 
    'Orphan Items SPB (barang_spb without spb)' AS Relational_Check,
    COUNT(*) AS Orphan_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED' ELSE 'FAILED' END AS Integrity_Status
FROM `barang_spb` b
LEFT JOIN `spb` s ON b.`spb` = s.`id`
WHERE s.`id` IS NULL

UNION ALL

SELECT 
    'Orphan Items Pembelian (pembelian_barang without pembelian)' AS Relational_Check,
    COUNT(*) AS Orphan_Count,
    CASE WHEN COUNT(*) = 0 THEN 'PASSED' ELSE 'FAILED' END AS Integrity_Status
FROM `pembelian_barang` pb
LEFT JOIN `pembelian` p ON pb.`pembelian_id` = p.`id`
WHERE p.`id` IS NULL;

-- ------------------------------------------------------------------------------
-- 4. NULL / EDGE-CASE VALUES SANITIZATION CHECK
-- ------------------------------------------------------------------------------
SELECT 
    SUM(CASE WHEN `dp` IS NULL THEN 1 ELSE 0 END) AS Null_DP,
    SUM(CASE WHEN `potongan` IS NULL THEN 1 ELSE 0 END) AS Null_Potongan,
    SUM(CASE WHEN `diskon` IS NULL THEN 1 ELSE 0 END) AS Null_Diskon,
    SUM(CASE WHEN `ppn` IS NULL THEN 1 ELSE 0 END) AS Null_PPN,
    SUM(CASE WHEN `total_harga` IS NULL THEN 1 ELSE 0 END) AS Null_Total_Harga,
    SUM(CASE WHEN `total_pembayaran` IS NULL THEN 1 ELSE 0 END) AS Null_Total_Pembayaran,
    SUM(CASE WHEN `sisa_pembayaran` IS NULL THEN 1 ELSE 0 END) AS Null_Sisa_Pembayaran,
    SUM(CASE WHEN `tgl_penjualan` IS NULL OR `tgl_penjualan` = '0000-00-00 00:00:00' THEN 1 ELSE 0 END) AS Invalid_Tgl_Penjualan,
    SUM(CASE WHEN `tgl_selesai` IS NULL OR `tgl_selesai` = '0000-00-00' THEN 1 ELSE 0 END) AS Invalid_Tgl_Selesai
FROM `penjualan`;
