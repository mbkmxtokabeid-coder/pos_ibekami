@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<style>
    /* ==========================================================================
       DESIGN SYSTEM TOKENS & OVERRIDES (DESIGN.md)
       Dark Theme: Slate Palette (#0F172A, #161B22, #1E293B, #334155)
       ========================================================================== */

    /* Typography & Tabular Nums (§5.1 & §23) */
    .num, .price, .numeric, td.numeric, th.numeric {
        font-variant-numeric: tabular-nums !important;
        font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    /* Page Header & Action Button (§9) */
    .btn-create-invoice {
        background-color: #4F46E5 !important;
        border-color: #4F46E5 !important;
        color: #FFFFFF !important;
        font-weight: 500;
        font-size: 13.5px;
        border-radius: 8px;
        padding: 7px 16px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    .btn-create-invoice:hover {
        background-color: #4338CA !important;
        border-color: #4338CA !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
    }

    /* Segmented Control (§9.1 & Dashboard Style) */
    .segmented-control {
        display: inline-flex;
        align-items: center;
        background: #0F172A;
        border: 1px solid #1E293B;
        border-radius: 8px;
        padding: 3px;
        gap: 2px;
    }
    .segmented-item {
        background: transparent;
        border: none;
        color: #94A3B8;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.15s ease;
    }
    .segmented-item:hover {
        color: #F1F5F9;
        background: #1E293B;
    }
    .segmented-item.active {
        background: #1E293B !important;
        color: #38BDF8 !important;
        border: 1px solid #334155 !important;
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
    }

    /* Timeframe Segmented Control (§9.1 & §10) */
    .timeframe-pill-container {
        display: inline-flex;
        align-items: center;
        background: #0F172A;
        border: 1px solid #1E293B;
        border-radius: 8px;
        padding: 3px;
        gap: 2px;
    }
    .btn-card-timeframe {
        border: none !important;
        border-radius: 6px !important;
        color: #94A3B8 !important;
        background: transparent !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        padding: 5px 12px !important;
        transition: all 0.15s ease !important;
        box-shadow: none !important;
    }
    .btn-card-timeframe:hover {
        color: #F1F5F9 !important;
        background: #1E293B !important;
    }
    .btn-card-timeframe.active, 
    .btn-card-timeframe.btn-primary {
        background: #1E293B !important;
        color: #38BDF8 !important;
        font-weight: 600 !important;
        border: 1px solid #334155 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4) !important;
    }
    .badge-period-display {
        background: #0F172A !important;
        color: #CBD5E1 !important;
        border: 1px solid #1E293B !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        border-radius: 6px !important;
        padding: 6px 12px !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Filter Collapse Card */
    .filter-collapse-card {
        background: #161B22 !important;
        border: 1px solid #1E293B !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
    }
    .filter-input-dark {
        background-color: #0F172A !important;
        border: 1px solid #334155 !important;
        color: #F1F5F9 !important;
        border-radius: 8px !important;
        font-size: 13px !important;
    }
    .filter-input-dark:focus {
        border-color: #4F46E5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
        outline: none;
    }

    /* Section Badges */
    .section-badge-nonpo {
        background-color: rgba(16, 185, 129, 0.12) !important;
        color: #34D399 !important;
        border: 1px solid rgba(16, 185, 129, 0.25) !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        padding: 5px 10px;
    }
    .section-badge-batal {
        background-color: rgba(168, 85, 247, 0.12) !important;
        color: #C084FC !important;
        border: 1px solid rgba(168, 85, 247, 0.25) !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        padding: 5px 10px;
    }
    .section-header-text {
        font-size: 11.5px;
        font-weight: 600;
        letter-spacing: 0.05em;
        color: #64748B;
        text-transform: uppercase;
    }

    /* ==========================================================================
       KPI / STAT CARDS (§12.4 & §4.3)
       Dark surface #161B22, 12px radius, subtle border, tonal icon box
       ========================================================================== */
    .tokabe-card {
        background: #161B22 !important;
        border: 1px solid #1E293B !important;
        border-radius: 12px !important;
        margin-bottom: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .tokabe-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        opacity: 0.9;
    }
    .tokabe-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.4);
        border-color: #334155 !important;
    }
    .tokabe-card .card-body {
        padding: 1.25rem 1.25rem 1.1rem 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 148px;
    }

    /* KPI Top Accent Borders */
    .card-kpi-total::before,
    .card-kpi-lunas::before {
        background: linear-gradient(90deg, #10B981, #059669);
    }
    .card-kpi-belum::before {
        background: linear-gradient(90deg, #EF4444, #DC2626);
    }
    .card-kpi-warning::before {
        background: linear-gradient(90deg, #F59E0B, #D97706);
    }
    .card-kpi-batal::before {
        background: linear-gradient(90deg, #A855F7, #7C3AED);
    }
    .card-kpi-hapus::before {
        background: linear-gradient(90deg, #F43F5E, #E11D48);
    }

    .tokabe-card-title {
        font-size: 11.5px;
        font-weight: 600;
        text-transform: uppercase;
        color: #94A3B8;
        letter-spacing: 0.06em;
        margin-bottom: 6px;
        line-height: 1.3;
    }
    .tokabe-card-number {
        font-size: 24px;
        font-weight: 700;
        color: #F1F5F9;
        margin-bottom: 0;
        line-height: 1.2;
        letter-spacing: -0.02em;
        font-variant-numeric: tabular-nums;
    }

    /* Tonal Icon Boxes (40-42px) */
    .tokabe-card-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
    }
    .icon-emerald {
        background-color: rgba(16, 185, 129, 0.12);
        color: #10B981;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }
    .icon-danger {
        background-color: rgba(239, 68, 68, 0.12);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }
    .icon-warning {
        background-color: rgba(245, 158, 11, 0.12);
        color: #F59E0B;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    .icon-purple {
        background-color: rgba(168, 85, 247, 0.12);
        color: #A855F7;
        border: 1px solid rgba(168, 85, 247, 0.25);
    }

    /* Count Pill Badge in Card Footer */
    .tokabe-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 2px 8px;
        border-radius: 9999px;
        font-size: 11.5px;
        font-weight: 600;
        font-variant-numeric: tabular-nums;
    }
    .pill-indigo {
        background-color: rgba(99, 102, 241, 0.12);
        color: #818CF8;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    .pill-danger {
        background-color: rgba(239, 68, 68, 0.12);
        color: #F87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }
    .pill-warning {
        background-color: rgba(245, 158, 11, 0.12);
        color: #FCD34D;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    .pill-purple {
        background-color: rgba(168, 85, 247, 0.12);
        color: #C084FC;
        border: 1px solid rgba(168, 85, 247, 0.25);
    }
    .tokabe-card-footer-text {
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
    }

    /* ==========================================================================
       STATUS BADGES (§14.1)
       Pill form with dot indicator ●
       ========================================================================== */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 24px;
        padding: 0 10px;
        font-size: 12px;
        font-weight: 500;
        border-radius: 9999px;
        white-space: nowrap;
    }
    .badge-status::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: currentColor;
    }
    .badge-status-lunas {
        color: #34D399;
        background-color: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.25);
    }
    .badge-status-belum {
        color: #F87171;
        background-color: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(239, 68, 68, 0.25);
    }
    .badge-status-batal {
        color: #94A3B8;
        background-color: rgba(148, 163, 184, 0.12);
        border: 1px solid rgba(148, 163, 184, 0.25);
    }
    .badge-status-info {
        color: #60A5FA;
        background-color: rgba(59, 130, 246, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.25);
    }

    .badge-jenis-inv {
        background-color: rgba(56, 189, 248, 0.1);
        color: #38BDF8;
        border: 1px solid rgba(56, 189, 248, 0.25);
        border-radius: 4px;
        padding: 2px 7px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.02em;
        display: inline-block;
    }

    /* ==========================================================================
       TOKABE INVOICE TABLE STYLING - PERSIS SESUAI DESAIN GAMBAR
       Palette: Deep Slate/Navy #0B111E, Header #111827 / #131C2E, 
       Active Sort Highlight #172A4E (#3B82F6),
       Amber (#F59E0B / #FBBF24), Emerald (#10B981 / #34D399)
       ========================================================================== */

    /* Card Utama Tokabe */
    .tokabe-invoice-card {
        background-color: #0b111e !important;
        border: 1px solid #1e293b !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.45) !important;
        margin-bottom: 24px;
    }

    /* Header Atas: Judul, Info Pill, Tombol Urutkan & Buka Semua Rincian */
    .tokabe-card-header {
        background-color: #0b111e;
        padding: 18px 24px 14px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        border-bottom: none;
    }

    .tokabe-card-title {
        color: #ffffff;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.01em;
        margin: 0;
        line-height: 1.2;
    }

    .tokabe-info-pill {
        background-color: rgba(37, 99, 235, 0.16);
        border: 1px solid rgba(59, 130, 246, 0.28);
        color: #60a5fa;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 14px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-tokabe-sort {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #cbd5e1 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border-radius: 8px !important;
        padding: 7px 14px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: all 0.15s ease !important;
        line-height: 1.4 !important;
    }

    .btn-tokabe-sort:hover,
    .btn-tokabe-sort:focus {
        background-color: #1a253a !important;
        border-color: #3b82f6 !important;
        color: #ffffff !important;
    }

    .btn-tokabe-sort.dropdown-toggle::after {
        display: none !important;
    }

    .btn-tokabe-expand-all {
        background-color: #2563eb !important;
        border: 1px solid #2563eb !important;
        color: #ffffff !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border-radius: 8px !important;
        padding: 7px 18px !important;
        transition: all 0.15s ease !important;
        line-height: 1.4 !important;
    }

    .btn-tokabe-expand-all:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    /* Toolbar Subheader (Tampilkan X data, Filter Jenis, Cari) */
    .tokabe-table-toolbar {
        padding: 10px 24px 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        background-color: #0b111e;
    }

    .tokabe-filter-label {
        color: #94a3b8;
        font-size: 13px;
        font-weight: 500;
    }

    .tokabe-select-dark {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 5px 12px !important;
        font-size: 13px !important;
        height: 36px !important;
        outline: none !important;
        cursor: pointer;
        transition: border-color 0.15s ease;
    }

    .tokabe-select-dark:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
    }

    /* Penataan Kontrol DataTables (Tampilkan data & Cari) */
    .dataTables_wrapper .dataTables_length {
        float: left !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        height: auto !important;
    }

    .dataTables_wrapper .dataTables_length label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
    }

    .dataTables_wrapper .dataTables_length select {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 4px 10px !important;
        font-size: 13px !important;
        height: 36px !important;
        min-width: 65px !important;
        margin: 0 2px !important;
        outline: none;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        height: auto !important;
    }

    .dataTables_wrapper .dataTables_filter label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #f1f5f9 !important;
        border-radius: 8px !important;
        padding: 6px 14px !important;
        font-size: 13px !important;
        height: 36px !important;
        width: 250px !important;
        margin: 0 0 0 6px !important;
        outline: none !important;
    }

    .dataTables_wrapper .dataTables_filter input::placeholder {
        color: #475569 !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
    }

    .dataTables_wrapper .dt-buttons {
        display: none !important;
    }

    /* Tabel Tokabe - Horizontal Scrolling (Bisa Digeser Ke Samping) */
    .tokabe-table-responsive {
        width: 100%;
        overflow-x: auto !important;
        overflow-y: visible !important;
        background-color: #0b111e;
        position: relative;
        -webkit-overflow-scrolling: touch;
    }

    /* Custom Sleek Horizontal Scrollbar */
    .tokabe-table-responsive::-webkit-scrollbar {
        height: 10px;
    }
    .tokabe-table-responsive::-webkit-scrollbar-track {
        background: #0b111e;
        border-radius: 6px;
    }
    .tokabe-table-responsive::-webkit-scrollbar-thumb {
        background: #1e293b;
        border-radius: 6px;
        border: 2px solid #0b111e;
    }
    .tokabe-table-responsive::-webkit-scrollbar-thumb:hover {
        background: #3b82f6;
    }

    table.tokabe-invoice-table {
        width: 100% !important;
        min-width: 2150px !important; /* Memastikan semua 16 kolom lega dan dapat digeser ke samping dengan mulus */
        margin: 0 !important;
        border-collapse: collapse !important;
        background-color: transparent !important;
    }

    /* THEAD Header Kolom */
    table.tokabe-invoice-table thead th {
        background-color: #111827 !important;
        color: #8ba1bc !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
        padding: 13px 14px !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid #1e293b !important;
        white-space: nowrap !important;
        vertical-align: middle !important;
        cursor: pointer !important;
        position: relative !important;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    /* Hilangkan panah bawaan bootstrap datatables */
    table.tokabe-invoice-table thead th:before,
    table.tokabe-invoice-table thead th:after,
    table.tokabe-invoice-table thead th.sorting:before,
    table.tokabe-invoice-table thead th.sorting:after,
    table.tokabe-invoice-table thead th.sorting_asc:before,
    table.tokabe-invoice-table thead th.sorting_asc:after,
    table.tokabe-invoice-table thead th.sorting_desc:before,
    table.tokabe-invoice-table thead th.sorting_desc:after {
        display: none !important;
        content: "" !important;
    }

    /* Highlight Kolom Aktif Sort (Seperti TANGGAL PENJUALAN pada Gambar) */
    table.tokabe-invoice-table thead th.sorting_desc,
    table.tokabe-invoice-table thead th.sorting_asc,
    table.tokabe-invoice-table thead th.active-sort {
        background-color: #172a4e !important;
        color: #ffffff !important;
    }

    .tokabe-sort-icon {
        display: inline-flex;
        align-items: center;
        margin-left: 6px;
        vertical-align: middle;
        color: #475569;
    }

    table.tokabe-invoice-table thead th.sorting_desc .tokabe-sort-icon,
    table.tokabe-invoice-table thead th.sorting_asc .tokabe-sort-icon,
    table.tokabe-invoice-table thead th.active-sort .tokabe-sort-icon {
        color: #3b82f6 !important;
    }

    /* TBODY Baris & Kolom */
    table.tokabe-invoice-table tbody tr {
        background-color: transparent !important;
        border-bottom: 1px solid #162032 !important;
        transition: background-color 0.15s ease;
    }

    table.tokabe-invoice-table tbody tr:hover {
        background-color: rgba(22, 33, 52, 0.7) !important;
    }

    /* Highlight baris yang sedang dilebarkan (expanded) seperti pada Gambar 3 & 4 */
    table.tokabe-invoice-table tbody tr.shown,
    table.tokabe-invoice-table tbody tr.expanded {
        background-color: rgba(23, 42, 78, 0.45) !important;
    }

    table.tokabe-invoice-table tbody td {
        padding: 13px 14px !important;
        color: #cbd5e1 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid #162032 !important;
        font-size: 13px !important;
        vertical-align: middle !important;
    }

    /* Ukuran & Tata Letak Kolom Sesuai Desain 13 Kolom */
    .tokabe-col-no, .tokabe-th-no {
        width: 44px !important;
        min-width: 44px !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
    }

    .tokabe-col-invoice, .tokabe-th-inv {
        min-width: 160px !important;
    }

    .tokabe-col-pelanggan, .tokabe-th-pelanggan {
        min-width: 220px !important;
    }

    .tokabe-col-telepon, .tokabe-th-telepon {
        min-width: 130px !important;
    }

    .tokabe-col-tgl, .tokabe-th-tgl {
        min-width: 155px !important;
    }

    .tokabe-col-status, .tokabe-th-status {
        min-width: 120px !important;
    }

    .tokabe-col-approval, .tokabe-th-approval {
        min-width: 105px !important;
    }

    .tokabe-col-deskripsi, .tokabe-th-deskripsi {
        min-width: 250px !important;
    }

    .tokabe-col-material, .tokabe-th-material {
        min-width: 220px !important;
    }

    .tokabe-col-alasan, .tokabe-th-alasan {
        min-width: 160px !important;
    }

    .tokabe-col-panjar, .tokabe-th-panjar {
        min-width: 110px !important;
    }

    .tokabe-col-total, .tokabe-th-total {
        min-width: 135px !important;
    }

    .tokabe-col-pembayaran, .tokabe-th-pembayaran {
        min-width: 145px !important;
    }

    .tokabe-col-orderby, .tokabe-th-orderby {
        min-width: 130px !important;
    }

    .tokabe-col-admin, .tokabe-th-admin {
        min-width: 130px !important;
    }

    .tokabe-col-aksi, .tokabe-th-aksi {
        width: 60px !important;
        min-width: 60px !important;
    }

    .tokabe-col-inv {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    /* Tombol Chevron [ > ] di samping Invoice ID */
    .tokabe-row-toggle {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        background-color: #121a2a;
        border: 1px solid #233148;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0;
        flex-shrink: 0;
    }

    .tokabe-row-toggle:hover {
        background-color: #1a253a;
        border-color: #3b82f6;
        color: #ffffff;
    }

    .tokabe-row-toggle.active,
    tr.shown .tokabe-row-toggle,
    tr.expanded .tokabe-row-toggle {
        transform: rotate(90deg);
        background-color: rgba(59, 130, 246, 0.25);
        border-color: #3b82f6;
        color: #60a5fa;
    }

    .tokabe-inv-code {
        color: #f1f5f9;
        font-size: 13px;
        font-weight: 500;
        font-family: 'JetBrains Mono', Consolas, monospace;
    }

    /* Kolom Pelanggan */
    .tokabe-customer-wrap {
        max-width: 260px;
        line-height: 1.3;
    }

    .tokabe-customer-name {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tokabe-customer-sub {
        color: #64748b;
        font-size: 11.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 1px;
    }

    /* Kolom Telepon */
    .tokabe-phone {
        color: #94a3b8;
        font-size: 13px;
        font-variant-numeric: tabular-nums;
        font-family: 'JetBrains Mono', Consolas, monospace;
        letter-spacing: 0.02em;
    }

    .tokabe-phone-empty {
        color: #475569;
        font-family: 'JetBrains Mono', Consolas, monospace;
    }

    /* Kolom Tanggal */
    .tokabe-date-main {
        color: #ffffff;
        font-weight: 500;
        font-size: 13px;
        white-space: nowrap;
    }

    .tokabe-date-sub {
        color: #64748b;
        font-size: 11px;
        white-space: nowrap;
        margin-top: 2px;
    }

    /* Status & Approval Pills (Bentuk Pill Sesuai Gambar) */
    .tokabe-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .tokabe-pill-dot {
        font-size: 9px;
        line-height: 1;
    }

    /* Amber (Belum Lunas, Lock, Transfer DP) */
    .tokabe-pill-belum,
    .tokabe-pill-lock,
    .tokabe-pill-dp {
        background-color: rgba(217, 119, 6, 0.12) !important;
        border: 1px solid rgba(245, 158, 11, 0.35) !important;
        color: #fbbf24 !important;
    }
    .tokabe-pill-belum .tokabe-pill-dot,
    .tokabe-pill-dp .tokabe-pill-dot,
    .tokabe-pill-lock i {
        color: #f59e0b !important;
    }

    /* Emerald (Lunas & Unlock) */
    .tokabe-pill-lunas,
    .tokabe-pill-unlock {
        background-color: rgba(16, 185, 129, 0.12) !important;
        border: 1px solid rgba(16, 185, 129, 0.35) !important;
        color: #34d399 !important;
    }
    .tokabe-pill-lunas .tokabe-pill-dot,
    .tokabe-pill-unlock i {
        color: #10b981 !important;
    }

    /* Blue / Cyan (Transfer Lunas) */
    .tokabe-pill-transfer {
        background-color: rgba(56, 189, 248, 0.12) !important;
        border: 1px solid rgba(56, 189, 248, 0.35) !important;
        color: #38bdf8 !important;
    }
    .tokabe-pill-transfer .tokabe-pill-dot {
        color: #38bdf8 !important;
    }

    /* Slate (Batal) */
    .tokabe-pill-batal {
        background-color: rgba(148, 163, 184, 0.12) !important;
        border: 1px solid rgba(148, 163, 184, 0.3) !important;
        color: #94a3b8 !important;
    }

    /* Kolom Deskripsi (Expandable in-place seperti Gambar 3 & 4) */
    .tokabe-desc-wrap {
        max-width: 280px;
        line-height: 1.4;
    }

    .tokabe-desc-collapsed,
    .tokabe-desc-expanded {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .tokabe-desc-item {
        color: #cbd5e1;
        font-size: 12.5px;
        white-space: normal;
        word-break: break-word;
    }

    .tokabe-desc-more {
        color: #3b82f6;
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 3px;
        cursor: pointer;
        display: inline-block;
    }
    .tokabe-desc-more:hover {
        color: #60a5fa;
        text-decoration: underline;
    }

    .tokabe-desc-less {
        color: #64748b;
        font-size: 11px;
        cursor: pointer;
        margin-top: 4px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 2px;
    }
    .tokabe-desc-less:hover {
        color: #94a3b8;
    }

    /* Angka Panjar & Total */
    .tokabe-num {
        color: #cbd5e1;
        font-variant-numeric: tabular-nums;
        font-size: 13px;
        font-family: 'JetBrains Mono', Consolas, monospace;
        white-space: nowrap;
    }

    .tokabe-num-bold {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-variant-numeric: tabular-nums;
        font-size: 13.5px;
        font-family: 'JetBrains Mono', Consolas, monospace;
        white-space: nowrap;
    }

    .tokabe-admin-text {
        color: #cbd5e1;
        font-size: 13px;
        white-space: nowrap;
    }

    .tokabe-pill-alasan {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11.5px;
        line-height: 1.35;
        color: #f87171 !important;
        background-color: rgba(239, 68, 68, 0.12) !important;
        border: 1px solid rgba(239, 68, 68, 0.28) !important;
        white-space: normal;
        word-break: break-word;
        max-width: 180px;
    }

    .tokabe-pill-orderby {
        display: inline-flex;
        align-items: center;
        padding: 3px 9px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        color: #93c5fd !important;
        background-color: rgba(59, 130, 246, 0.12) !important;
        border: 1px solid rgba(59, 130, 246, 0.28) !important;
        white-space: nowrap;
    }

    .tokabe-mat-name {
        color: #e2e8f0;
        font-weight: 500;
    }

    /* Tombol 3 Titik Vertikal (⋮) di Kolom Aksi */
    .btn-tokabe-action-dots {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #94a3b8 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.15s ease;
        padding: 0;
    }

    .btn-tokabe-action-dots:hover,
    .btn-tokabe-action-dots:focus,
    .show > .btn-tokabe-action-dots {
        background-color: #1e293b !important;
        border-color: #3b82f6 !important;
        color: #ffffff !important;
    }

    .btn-tokabe-action-dots::after {
        display: none !important;
    }

    .tokabe-expanded-content {
        background: linear-gradient(180deg, rgba(17, 24, 39, 0.85) 0%, rgba(11, 17, 30, 0.95) 100%);
        border-left: 3px solid #3b82f6;
        margin: 8px 14px 14px 14px;
        border-radius: 10px;
        border-right: 1px solid #1e293b;
        border-top: 1px solid #1e293b;
        border-bottom: 1px solid #1e293b;
        animation: tokabeFadeIn 0.2s ease-in-out;
    }

    @keyframes tokabeFadeIn {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .tokabe-stat-box {
        background-color: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(51, 65, 85, 0.6);
    }

    .tokabe-stat-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: #94a3b8;
        margin-bottom: 3px;
    }

    .tokabe-stat-val {
        font-size: 15px;
        font-weight: 700;
        font-family: 'JetBrains Mono', Consolas, monospace;
    }

    .tokabe-section-box {
        background-color: rgba(15, 23, 42, 0.45);
        border: 1px solid rgba(51, 65, 85, 0.45);
    }

    .tokabe-section-title {
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: #60a5fa;
        text-transform: uppercase;
        margin-bottom: 8px;
        padding-bottom: 6px;
        border-bottom: 1px solid rgba(51, 65, 85, 0.5);
    }

    /* Footer: Info & Pagination */
    .tokabe-table-footer {
        padding: 14px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        background-color: #0b111e;
        border-top: 1px solid #1e293b;
    }

    .dataTables_wrapper .dataTables_info {
        color: #94a3b8 !important;
        font-size: 13px !important;
        padding: 0 !important;
        margin: 0 !important;
        float: left !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding: 0 !important;
        margin: 0 !important;
        float: right !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .dataTables_wrapper .dataTables_paginate .page-link {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #94a3b8 !important;
        border-radius: 6px !important;
        padding: 5px 11px !important;
        font-size: 12.5px !important;
        transition: all 0.15s ease;
    }

    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    .dataTables_wrapper .dataTables_paginate .page-link:hover {
        background-color: #1a253a !important;
        color: #ffffff !important;
        border-color: #3b82f6 !important;
    }

    /* Modal & SweetAlert Dark */
    .modal-content {
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #f1f5f9 !important;
        border-radius: 12px !important;
    }
    .modal-header, .modal-footer {
        border-color: #233148 !important;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .swal2-popup {
        width: 500px;
        background-color: #121a2a !important;
        border: 1px solid #233148 !important;
        color: #f1f5f9 !important;
        border-radius: 12px !important;
    }
</style>
@endsection
@extends('layout.template')
@section('content')
<div class="page-content">
  <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0">Invoice</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                          <li class="breadcrumb-item active">Daftar Invoice</li>
                      </ol>
                  </div>

              </div>
          </div>
      </div>
      <!-- end page title -->

       <div class="row align-items-center mb-3">
          <div class="col-md-auto me-auto">
              <a href="{{ url('addInvoice') }}" class="btn btn-create-invoice addMembers-modal"><i class="las la-plus me-1 fs-15"></i>Tambah Invoices</a>
          </div>
          @if(in_array(Auth::user()->role, ['Pemilik', 'Admin']))
          <div class="col-md-auto mt-2 mt-md-0 d-flex flex-wrap align-items-center gap-2">
              <span class="badge-period-display" id="badge-active-period"><i class="las la-calendar-alt text-muted"></i> Periode: TAHUN {{ date('Y') }}</span>
              <div class="timeframe-pill-container" role="group">
                  <button type="button" class="btn btn-card-timeframe" data-timeframe="today" onclick="switchTokabeCardTimeframe('today', this)">Hari Ini</button>
                  <button type="button" class="btn btn-card-timeframe" data-timeframe="week" onclick="switchTokabeCardTimeframe('week', this)">Minggu Ini</button>
                  <button type="button" class="btn btn-card-timeframe" data-timeframe="month" onclick="switchTokabeCardTimeframe('month', this)">Bulan Ini</button>
                  <button type="button" class="btn btn-card-timeframe active" data-timeframe="year" onclick="switchTokabeCardTimeframe('year', this)">Tahun Ini</button>
                  <button type="button" class="btn btn-card-timeframe" data-timeframe="last_year" onclick="switchTokabeCardTimeframe('last_year', this)">Tahun Lalu</button>
                  <button type="button" class="btn btn-card-timeframe" id="btn-custom-toggle" onclick="toggleCustomFilterCard()">Filter Khusus <i class="las la-angle-down ms-1"></i></button>
              </div>
          </div>
          @endif
      </div>

      @if(in_array(Auth::user()->role, ['Pemilik', 'Admin']))
      {{-- Custom Filter Collapse Card (Single-Line Toolbar matching Dashboard / UI-UX-Pro-Max) --}}
      <div class="collapse mb-3" id="collapseCardCustomFilter">
          <div class="custom-filter-panel d-flex flex-wrap align-items-center" style="background: #12161D; border: 1px solid #232A35; border-radius: 10px; padding: 8px 16px; gap: 12px;">
              <div class="d-flex align-items-center me-1" style="color: #94A3B8;">
                  <i class="las la-filter me-1" style="color: #6366F1; font-size: 16px;"></i>
                  <span class="text-uppercase fs-12 fw-bold" style="letter-spacing: 0.06em; color: #94A3B8;">PILIH SPESIFIK:</span>
              </div>

              <!-- Submode segmented buttons (Tanggal, Bulan, Tahun, Rentang) -->
              <div class="segmented-control" id="card-submode-group" role="group">
                  <button type="button" class="segmented-item card-submode active" id="btn-card-mode-date" data-mode="date" onclick="setCardCustomSubmode('date')">
                      <i class="las la-calendar-day"></i> Tanggal
                  </button>
                  <button type="button" class="segmented-item card-submode" id="btn-card-mode-month" data-mode="month" onclick="setCardCustomSubmode('month')">
                      <i class="las la-calendar-alt"></i> Bulan
                  </button>
                  <button type="button" class="segmented-item card-submode" id="btn-card-mode-year" data-mode="year" onclick="setCardCustomSubmode('year')">
                      <i class="las la-calendar"></i> Tahun
                  </button>
                  <button type="button" class="segmented-item card-submode" id="btn-card-mode-range" data-mode="range" onclick="setCardCustomSubmode('range')">
                      <i class="las la-calendar-week"></i> Rentang
                  </button>
              </div>

              <!-- Inline Inputs Container -->
              <div class="d-inline-flex align-items-center gap-2" id="card-inputs-container">
                  <!-- Date mode -->
                  <input type="date" id="card-input-date" class="form-control form-control-sm" style="width: 145px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">

                  <!-- Month mode -->
                  <div id="card-ctrl-month" class="card-ctrl" style="display: none; align-items: center; gap: 6px;">
                      <select id="card-input-bulan" class="form-select form-select-sm" style="width: 130px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                          @for ($m = 1; $m <= 12; $m++)
                              <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                  {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                              </option>
                          @endfor
                      </select>
                      <select id="card-input-tahun-month" class="form-select form-select-sm" style="width: 95px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                          @foreach ($availableYears as $yr)
                              <option value="{{ $yr }}" {{ $yr == date('Y') ? 'selected' : '' }}>{{ $yr }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Year mode -->
                  <div id="card-ctrl-year" class="card-ctrl" style="display: none;">
                      <select id="card-input-year" class="form-select form-select-sm" style="width: 105px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                          @foreach ($availableYears as $yr)
                              <option value="{{ $yr }}" {{ $yr == date('Y') ? 'selected' : '' }}>{{ $yr }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Range mode -->
                  <div id="card-ctrl-range" class="card-ctrl" style="display: none; align-items: center; gap: 6px;">
                      <input type="date" id="card-range-start" class="form-control form-control-sm" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-01') }}">
                      <span class="text-muted fs-12">s/d</span>
                      <input type="date" id="card-range-end" class="form-control form-control-sm" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">
                  </div>
              </div>

              <!-- Terapkan button -->
              <button type="button" class="btn btn-primary d-inline-flex align-items-center" id="btn-apply-card-custom" onclick="applyCustomFilterCard()" style="background: #6366F1 !important; border: 1px solid #7175F3 !important; color: #FFFFFF !important; height: 34px; padding: 0 16px; border-radius: 8px; font-size: 13px; font-weight: 600; box-shadow: 0 2px 6px rgba(99, 102, 241, 0.25);">
                  <i class="las la-search me-1 fs-14"></i> Terapkan
              </button>

              <!-- Close button -->
              <button type="button" class="btn btn-link p-0 ms-auto text-decoration-none d-inline-flex align-items-center" onclick="toggleCustomFilterCard()" title="Tutup Filter Khusus" style="color: #6366F1; line-height: 1;">
                  <i class="las la-times fs-20" style="color: #6366F1;"></i>
              </button>
          </div>
      </div>

      {{-- ========================================================================= --}}
      {{-- GROUP 1: STATUS PEMBAYARAN --}}
      {{-- ========================================================================= --}}
      <div class="d-flex align-items-center mb-3 mt-2">
          <span class="section-badge-nonpo d-inline-flex align-items-center">
              <i class="las la-wallet me-1 fs-14"></i> STATUS PEMBAYARAN
          </span>
          <span class="section-header-text ms-2">RINGKASAN SEMUA INVOICE BERDASARKAN STATUS PEMBAYARAN</span>
      </div>

      <div class="row">
          {{-- Card 1: Jumlah Seluruh Invoice --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-total">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title" id="card-label-nonpo-total">JUMLAH SELURUH INVOICE TAHUN {{ date('Y') }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-nonpo-total">{{ $jumlahPerTahun }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-emerald">
                              <i class="las la-file-alt"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-indigo me-2" id="card-nonpo-total-count">{{ $jlhInvoice }}</span>
                          <span class="tokabe-card-footer-text" id="card-label-nonpo-total-count">Invoice Dibuat Tahun {{ date('Y') }}</span>
                      </div>
                  </div>
              </div>
          </div>

          {{-- Card 2: Invoice Terbayar --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-lunas">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title" id="card-label-nonpo-lunas">INVOICE TERBAYAR TAHUN {{ date('Y') }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-nonpo-lunas">{{ $totalLunasThn }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-emerald">
                              <i class="las la-check-circle"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-indigo me-2" id="card-nonpo-lunas-count">{{ $lunas }}</span>
                          <span class="tokabe-card-footer-text" id="card-label-nonpo-lunas-count">Invoice Lunas Tahun {{ date('Y') }}</span>
                      </div>
                  </div>
              </div>
          </div>

          {{-- Card 3: Invoice Belum Terbayar Tahun --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-belum">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title" id="card-label-nonpo-blm-thn">INVOICE BELUM TERBAYAR TAHUN {{ date('Y') }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-nonpo-blm-thn">{{ $jumlahBBPerTahun }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-danger">
                              <i class="las la-clock"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-danger me-2" id="card-nonpo-blm-thn-count">{{ $belumLunas }}</span>
                          <span class="tokabe-card-footer-text">Invoice Belum Dibayar</span>
                      </div>
                  </div>
              </div>
          </div>

          {{-- Card 4: Invoice Belum Terbayar Bulan --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-warning">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title" id="card-label-nonpo-blm-bln">INVOICE BELUM TERBAYAR BULAN {{ strtoupper(\Carbon\Carbon::now()->translatedFormat('F')) }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-nonpo-blm-bln">{{ $jumlahBBPerBulan }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-warning">
                              <i class="las la-calendar-times"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-warning me-2" id="card-nonpo-blm-bln-count">{{ $belumLunasMonth }}</span>
                          <span class="tokabe-card-footer-text">Invoice Belum Dibayar</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      {{-- ========================================================================= --}}
      {{-- GROUP 3: PEMBATALAN                                                       --}}
      {{-- ========================================================================= --}}
      <div class="d-flex align-items-center mb-3 mt-2">
          <span class="section-badge-batal d-inline-flex align-items-center">
              <i class="las la-times-circle me-1 fs-14"></i> PEMBATALAN
          </span>
          <span class="section-header-text ms-2">STATUS INVOICE DIBATALKAN</span>
      </div>

      <div class="row">
          {{-- Card: Invoice Dibatalkan --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-batal">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title">INVOICE DIBATALKAN</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-batal-total">{{ $jumlahBatal }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-purple">
                              <i class="las la-times-circle"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-purple me-2" id="card-batal-count">{{ $batal }}</span>
                          <span class="tokabe-card-footer-text">Invoice Dibatalkan</span>
                      </div>
                  </div>
              </div>
          </div>

          {{-- Card: Invoice Dihapus --}}
          <div class="col-xl-3 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-hapus">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title">INVOICE DIHAPUS</p>
                              <h4 class="tokabe-card-number mb-1">Rp <span id="card-hapus-total">{{ $jumlahHapus }}</span></h4>
                          </div>
                          <div class="tokabe-card-icon icon-danger">
                              <i class="las la-trash-alt"></i>
                          </div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-danger me-2" id="card-hapus-count">{{ $hapusCount }}</span>
                          <span class="tokabe-card-footer-text">Invoice Dihapus</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @else
      {{-- Non Pemilik View: Invoice Belum Terbayar Saja --}}
      <div class="row">
          <div class="col-xl-6 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-belum">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title">INVOICE BELUM TERBAYAR TAHUN {{ date('Y') }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp {{ $jumlahBBPerTahun }}</h4>
                          </div>
                          <div class="tokabe-card-icon icon-danger"><i class="las la-clock"></i></div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-danger me-2">{{ $belumLunas }}</span>
                          <span class="tokabe-card-footer-text">Invoice Belum Lunas</span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6 mb-3">
              <div class="card tokabe-card card-kpi-warning">
                  <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                          <div>
                              <p class="tokabe-card-title">INVOICE BELUM TERBAYAR BULAN {{ strtoupper(\Carbon\Carbon::now()->translatedFormat('F')) }}</p>
                              <h4 class="tokabe-card-number mb-1">Rp {{ $jumlahBBPerBulan }}</h4>
                          </div>
                          <div class="tokabe-card-icon icon-warning"><i class="las la-calendar-times"></i></div>
                      </div>
                      <div class="d-flex align-items-center mt-3 pt-2 border-top border-dark-subtle">
                          <span class="tokabe-count-pill pill-warning me-2">{{ $belumLunasMonth }}</span>
                          <span class="tokabe-card-footer-text">Invoice Belum Lunas</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endif

      <div class="row">
          <div class="col-12">
              <div class="card tokabe-invoice-card">
                  <!-- Header: Judul, Info Pill, Tombol Urutkan & Buka Semua Rincian -->
                  <div class="tokabe-card-header">
                      <div class="d-flex flex-wrap align-items-center gap-2">
                          <h5 class="tokabe-card-title mb-0">Daftar Invoice Tokabe</h5>
                          <span class="tokabe-info-pill">
                              <i class="las la-info-circle"></i> Klik baris untuk melihat rincian lengkap
                          </span>
                      </div>
                      
                      <div class="d-flex flex-wrap align-items-center gap-2">
                          <!-- Sort dropdown button -->
                          <div class="dropdown">
                              <button class="btn btn-tokabe-sort dropdown-toggle" type="button" id="sortDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                      <line x1="3" y1="6" x2="15" y2="6"></line>
                                      <line x1="3" y1="12" x2="10" y2="12"></line>
                                      <line x1="3" y1="18" x2="6" y2="18"></line>
                                      <polyline points="17 14 20 17 23 14"></polyline>
                                      <line x1="20" y1="7" x2="20" y2="17"></line>
                                  </svg>
                                  Urutkan: <span id="currentSortLabel" class="ms-1">Tanggal Terbaru</span>
                                  <i class="las la-angle-down ms-1"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-lg" aria-labelledby="sortDropdownBtn">
                                  <li><a class="dropdown-item active" href="javascript:void(0)" onclick="applyTableSort(4, 'desc', 'Tanggal Terbaru')"><i class="las la-calendar-check me-2 text-primary"></i>Tanggal Terbaru</a></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(4, 'asc', 'Tanggal Terlama')"><i class="las la-calendar me-2 text-muted"></i>Tanggal Terlama</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(1, 'asc', 'Invoice ID (A-Z)')"><i class="las la-sort-numeric-down me-2 text-info"></i>Invoice ID (A-Z)</a></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(1, 'desc', 'Invoice ID (Z-A)')"><i class="las la-sort-numeric-up-alt me-2 text-info"></i>Invoice ID (Z-A)</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(2, 'asc', 'Nama Pelanggan (A-Z)')"><i class="las la-user me-2 text-success"></i>Nama Pelanggan (A-Z)</a></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(5, 'asc', 'Status Pembayaran')"><i class="las la-check-circle me-2 text-warning"></i>Status Pembayaran</a></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(13, 'asc', 'Order By')"><i class="las la-shopping-cart me-2 text-primary"></i>Order By</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(11, 'desc', 'Total Terbesar')"><i class="las la-wallet me-2 text-success"></i>Total Terbesar</a></li>
                                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(11, 'asc', 'Total Terkecil')"><i class="las la-wallet me-2 text-muted"></i>Total Terkecil</a></li>
                              </ul>
                          </div>

                          <!-- Buka Semua Rincian button -->
                          <button type="button" class="btn btn-tokabe-expand-all" id="btnToggleAllRows" onclick="toggleAllRowDetails()">
                              Buka Semua Rincian
                          </button>
                      </div>
                  </div>

                  <!-- Toolbar Filter & Search Container -->
                  <div class="tokabe-table-toolbar">
                      <div class="d-flex flex-wrap align-items-center gap-3">
                          <div id="tokabeCustomLength" class="d-inline-flex align-items-center"></div>

                          <div class="d-inline-flex align-items-center gap-2">
                              <span class="tokabe-filter-label">Jenis:</span>
                              <select id="filterJenisInvoice" class="tokabe-select-dark">
                                  <option value="">Semua Jenis</option>
                                  @foreach ($jenisInvoiceList as $jInv)
                                      <option value="{{ $jInv->id }}">{{ $jInv->nama_invoice }}</option>
                                  @endforeach
                              </select>
                              <button type="button" class="btn btn-sm btn-link text-danger p-0" id="btnResetFilterJenis" title="Reset filter" style="display: none; text-decoration: none;">
                                  <i class="las la-times-circle fs-16"></i>
                              </button>
                          </div>
                      </div>

                      <div id="tokabeCustomSearch" class="d-inline-flex align-items-center"></div>
                  </div>

                  <!-- Table Body (Scrollable horizontally) -->
                  <div class="tokabe-table-responsive p-0">
                      <table id="scroll-horizontal" class="table align-middle tokabe-invoice-table" style="width:100%">
                          <thead>
                              <tr>
                                  <th scope="col" class="tokabe-col-no text-center">NO</th>
                                  <th scope="col" class="tokabe-th-inv">
                                      INVOICE ID <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-pelanggan">
                                      NAMA PELANGGAN <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-telepon">NO. TELEPON</th>
                                  <th scope="col" class="tokabe-th-tgl active-sort">
                                      TANGGAL PENJUALAN <span class="tokabe-sort-icon"><i class="las la-arrow-down text-primary"></i></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-status text-center">
                                      STATUS <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-approval text-center">
                                      APPROVAL <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-deskripsi">DESKRIPSI</th>
                                  <th scope="col" class="tokabe-th-material">BAHAN MATERIAL</th>
                                  <th scope="col" class="tokabe-th-alasan">
                                      ALASAN BATAL <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-panjar">
                                      PANJAR <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-total">
                                      TOTAL <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-pembayaran text-center">
                                      TIPE PEMBAYARAN <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-orderby">
                                      ORDER BY <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-admin">
                                      ADMIN <span class="tokabe-sort-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg></span>
                                  </th>
                                  <th scope="col" class="tokabe-th-aksi text-center">AKSI</th>
                              </tr>
                          </thead>

                          <tbody>
                              {{-- Data dimuat secara Server-Side melalui AJAX route invoice.datatable_data --}}
                          </tbody>
                      </table>
                      <form id="globalBatalForm" method="POST" style="display: none;">
                          @csrf
                          <input type="hidden" name="alasan_batal" id="globalInputAlasanBatal">
                      </form>
                      <form id="globalDeleteForm" method="POST" style="display: none;">
                          @csrf
                          @method('delete')
                          <input type="hidden" name="alasan_hapus" id="globalInputAlasanHapus">
                      </form>
                  </div>

                  <!-- Footer Info & Pagination Container -->
                  <div class="tokabe-table-footer">
                      <div id="tokabeCustomInfo"></div>
                      <div id="tokabeCustomPaginate"></div>
                  </div>
              </div>
          </div>
      </div>
    
    <!-- Scrollable Modal Update Log -->
<div class="modal fade" id="updateLogModal" tabindex="-1" aria-labelledby="updateLogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateLogModalLabel">Riwayat Update Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul id="updateLogList" class="list-group" >
          <!-- Data akan diisi oleh AJAX -->
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Buat SPK -->
<div class="modal fade" id="buatSpkModal" tabindex="-1" aria-labelledby="buatSpkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buatSpkModalLabel">Buat SPK Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <form action="{{ route('spk.store_dari_invoice') }}" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="invoice_id" id="spk_invoice_id">
          
          <div class="mb-3">
            <label for="lainnya" class="form-label">Keterangan / Lainnya</label>
            <textarea class="form-control" id="lainnya" name="lainnya" rows="3" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
          </div>
          
          <div class="mb-3">
            <label for="express" class="form-label">Express</label>
            <select class="form-select" id="express" name="express" required>
              <option value="">-- Pilih Status Pengerjaan --</option>
              <option value="Y">Ya</option>
              <option value="N">Tidak</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Buat SPK Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>

  </div>
  <!-- container-fluid -->
</div>

@endsection

@section('plugins')
{{-- Datatable --}}

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" defer></script>
{{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}

<script>
    const loggedInUser = "{{ auth()->user()->nama }}";
</script>

<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}" defer></script>
<script src="{{asset('js/halaman/daftar-invoice.js')}}" defer></script>
<script>
    function showConfirmation(invoice, invId) {
        Swal.fire({
            title: 'Hapus Invoice',
            text: "Masukkan alasan penghapusan untuk invoice " + invoice,
            input: 'textarea',
            inputPlaceholder: 'Tulis alasan hapus invoice di sini...',
            inputAttributes: {
                'aria-label': 'Tulis alasan hapus invoice di sini'
            },
            showCancelButton: true,
            confirmButtonText: 'Hapus Invoice',
            cancelButtonText: 'Kembali',
            confirmButtonColor: '#c71f16',
            cancelButtonColor: '#6c757d',
            inputValidator: (value) => {
                if (!value || value.trim() === '') {
                    return 'Alasan penghapusan harus diisi!'
                }
            },
            customClass: {
                popup: 'swal2-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('globalDeleteForm');
                form.action = "{{ url('invoice/deleteInvoice') }}/" + invId;
                var inputHapus = document.getElementById('globalInputAlasanHapus');
                if (inputHapus) {
                    inputHapus.value = result.value;
                }
                form.submit();
            }
        });
    }
    function confirmBatal(id, nomorInvoice) {
    Swal.fire({
        title: 'Pembatalan Invoice',
        text: "Masukkan alasan pembatalan untuk invoice " + nomorInvoice,
        input: 'textarea',
        inputPlaceholder: 'Tulis alasan batal di sini...',
        inputAttributes: {
            'aria-label': 'Tulis alasan batal di sini'
        },
        showCancelButton: true,
        confirmButtonText: 'Proses Batal',
        cancelButtonText: 'Kembali',
        confirmButtonColor: '#d33',
        inputValidator: (value) => {
            if (!value) {
                return 'Alasan batal harus diisi!'
            }
        },
        customClass: {
            popup: 'swal2-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById('globalBatalForm');
            form.action = "{{ url('ubah-status-batal') }}/" + id;
            var inputBatal = document.getElementById('globalInputAlasanBatal');
            if (inputBatal) {
                inputBatal.value = result.value;
            }
            form.submit();
        }
    });
}
</script>
<script>
    $(document).on('click', '.btn-update-log', function () {
        var invoiceId = $(this).data('id');
        $('#updateLogList').html('<li class="list-group-item">Loading...</li>');

        $.ajax({
            url: '/invoice/invoice/update-log/' + invoiceId,
            method: 'GET',
            success: function (data) {
                let html = '';

                // Tampilkan first created selalu di awal
                html += `<li class="list-group-item ps-3">${data.created_at} - <strong>First Created</strong></li>`;

                // Tambahkan update log jika ada
                if (data.logs.length > 0) {
                    data.logs.forEach(function (log) {
                        html += `<li class="list-group-item ps-3">${log.tanggal} - Invoice diperbarui oleh ${loggedInUser}</li>`;
                    });
                }

                $('#updateLogList').html(html);
            },
            error: function () {
                $('#updateLogList').html('<li class="list-group-item">Gagal memuat data log.</li>');
            }
        });
    });

    // Skrip untuk menangkap ID invoice ke dalam modal SPK
    $(document).on('click', '.btn-buat-spk', function () {
        var invoiceId = $(this).data('id');
        $('#spk_invoice_id').val(invoiceId);
    });
</script>
<script>
    function switchTokabeCardTimeframe(timeframe, btn) {
        $('.btn-card-timeframe').removeClass('active');
        $(btn).addClass('active');
        $('#collapseCardCustomFilter').slideUp();

        fetchTokabeCardsData({ timeframe: timeframe });
    }

    function toggleCustomFilterCard() {
        $('#collapseCardCustomFilter').slideToggle();
    }

    let currentCardSubmode = 'date';

    function setCardCustomSubmode(mode) {
        currentCardSubmode = mode;
        $('.card-submode').removeClass('active');
        $('#btn-card-mode-' + mode).addClass('active');

        // Hide all ctrls
        $('#card-input-date').hide();
        $('#card-ctrl-month').css('display', 'none');
        $('#card-ctrl-year').css('display', 'none');
        $('#card-ctrl-range').css('display', 'none');

        // Show active ctrl
        if (mode === 'date') {
            $('#card-input-date').show();
        } else if (mode === 'month') {
            $('#card-ctrl-month').css('display', 'inline-flex');
        } else if (mode === 'year') {
            $('#card-ctrl-year').css('display', 'inline-flex');
        } else if (mode === 'range') {
            $('#card-ctrl-range').css('display', 'inline-flex');
        }
    }

    function applyCustomFilterCard() {
        var mode = currentCardSubmode || 'date';
        var params = {
            timeframe: 'custom',
            mode: mode
        };

        if (mode === 'date') {
            params.date = $('#card-input-date').val();
            if (!params.date) return;
        } else if (mode === 'month') {
            params.month = $('#card-input-bulan').val();
            params.year = $('#card-input-tahun-month').val();
        } else if (mode === 'year') {
            params.year = $('#card-input-year').val();
        } else if (mode === 'range') {
            params.start_date = $('#card-range-start').val();
            params.end_date = $('#card-range-end').val();
            if (!params.start_date || !params.end_date) return;
        }

        $('.btn-card-timeframe').removeClass('active');
        $('#btn-custom-toggle').addClass('active');

        fetchTokabeCardsData(params);
    }

    function fetchTokabeCardsData(params) {
        $('.tokabe-card').css('opacity', '0.6');

        $.ajax({
            url: "{{ route('invoice.cards_data') }}",
            type: "GET",
            data: params,
            dataType: "json",
            success: function(res) {
                $('.tokabe-card').css('opacity', '1');
                if (res.status === 'success') {
                    if (res.periodLabel) {
                        $('#badge-active-period').text('Periode: ' + res.periodLabel);
                        $('#card-label-nonpo-total').text('JUMLAH SELURUH NON PO ' + res.periodLabel);
                        $('#card-label-nonpo-total-count').text('Invoice Non PO Dibuat ' + res.periodLabel);
                        $('#card-label-nonpo-lunas').text('NON PO TERBAYAR ' + res.periodLabel);
                        $('#card-label-nonpo-lunas-count').text('Invoice Non PO Lunas ' + res.periodLabel);
                        $('#card-label-nonpo-blm-thn').text('NON PO BELUM TERBAYAR ' + res.periodLabel);
                        $('#card-label-po-lunas').text('JUMLAH PO LUNAS ' + res.periodLabel);
                        $('#card-label-po-lunas-count').text('Invoice PO Lunas ' + res.periodLabel);
                        $('#card-label-po-blm-thn').text('PO BELUM LUNAS ' + res.periodLabel);
                    }
                    if (res.card4MonthName) {
                        $('#card-label-nonpo-blm-bln').text('NON PO BELUM TERBAYAR BULAN ' + res.card4MonthName);
                        $('#card-label-po-blm-bln').text('PO BELUM LUNAS BULAN ' + res.card4MonthName);
                    }

                    // Non PO cards
                    if (res.card1) {
                        $('#card-nonpo-total').text(res.card1.nominal);
                        $('#card-nonpo-total-count').text(res.card1.count);
                    }
                    if (res.card2) {
                        $('#card-nonpo-lunas').text(res.card2.nominal);
                        $('#card-nonpo-lunas-count').text(res.card2.count);
                    }
                    if (res.card3) {
                        $('#card-nonpo-blm-thn').text(res.card3.nominal);
                        $('#card-nonpo-blm-thn-count').text(res.card3.count);
                    }
                    if (res.card4) {
                        $('#card-nonpo-blm-bln').text(res.card4.nominal);
                        $('#card-nonpo-blm-bln-count').text(res.card4.count);
                    }

                    // PO cards
                    if (res.cardPo1) {
                        $('#card-po-total').text(res.cardPo1.nominal);
                        $('#card-po-total-count').text(res.cardPo1.count);
                    }
                    if (res.cardPo2) {
                        $('#card-po-lunas').text(res.cardPo2.nominal);
                        $('#card-po-lunas-count').text(res.cardPo2.count);
                    }
                    if (res.cardPo3) {
                        $('#card-po-blm-thn').text(res.cardPo3.nominal);
                        $('#card-po-blm-thn-count').text(res.cardPo3.count);
                    }
                    if (res.cardPo4) {
                        $('#card-po-blm-bln').text(res.cardPo4.nominal);
                        $('#card-po-blm-bln-count').text(res.cardPo4.count);
                    }

                    // Pembatalan & Penghapusan
                    if (res.card5) {
                        $('#card-batal-total').text(res.card5.nominal);
                        $('#card-batal-count').text(res.card5.count);
                    }
                    if (res.cardHapus) {
                        $('#card-hapus-total').text(res.cardHapus.nominal);
                        $('#card-hapus-count').text(res.cardHapus.count);
                    }
                }
            },
            error: function(err) {
                $('.tokabe-card').css('opacity', '1');
                console.error('Gagal mengambil data kartu summary:', err);
            }
        });
    }
</script>
<script>
    // Inisialisasi Server-Side DataTables Tokabe Style
    var invoiceTable = null;

    function applyTableSort(columnIndex, direction, label) {
        if (!invoiceTable) return;
        $('#currentSortLabel').text(label);
        invoiceTable.order([columnIndex, direction]).draw();
    }

    function toggleRowDesc(element) {
        var tr = $(element).closest('tr');
        var collapsed = tr.find('.tokabe-desc-collapsed');
        var expanded = tr.find('.tokabe-desc-expanded');
        var toggleBtn = tr.find('.tokabe-row-toggle');

        if (expanded.length === 0) return;

        if (expanded.is(':visible')) {
            expanded.hide();
            collapsed.show();
            tr.removeClass('expanded shown');
            toggleBtn.removeClass('active');
        } else {
            collapsed.hide();
            expanded.show();
            tr.addClass('expanded shown');
            toggleBtn.addClass('active');
        }
    }

    function toggleAllRowDetails() {
        var anyOpen = $('#scroll-horizontal tbody tr.expanded').length > 0;
        if (anyOpen) {
            $('#scroll-horizontal tbody tr').removeClass('expanded shown');
            $('#scroll-horizontal tbody .tokabe-desc-collapsed').show();
            $('#scroll-horizontal tbody .tokabe-desc-expanded').hide();
            $('#scroll-horizontal tbody .tokabe-row-toggle').removeClass('active');
            $('#btnToggleAllRows').text('Buka Semua Rincian');
        } else {
            $('#scroll-horizontal tbody tr').addClass('expanded shown');
            $('#scroll-horizontal tbody .tokabe-desc-collapsed').hide();
            $('#scroll-horizontal tbody .tokabe-desc-expanded').show();
            $('#scroll-horizontal tbody .tokabe-row-toggle').addClass('active');
            $('#btnToggleAllRows').text('Tutup Semua Rincian');
        }
    }

    $(document).ready(function() {
        invoiceTable = $('#scroll-horizontal').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: false,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            order: [[4, 'desc']], // Default: Tanggal Penjualan descending
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
            ajax: {
                url: "{{ route('invoice.datatable_data') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.jenis = $('#filterJenisInvoice').val();
                }
            },
            columns: [
                { data: 0, className: "text-center tokabe-col-no", orderable: false },
                { data: 1, className: "tokabe-col-invoice", orderable: true },
                { data: 2, className: "tokabe-col-pelanggan", orderable: true },
                { data: 3, className: "tokabe-col-telepon", orderable: true },
                { data: 4, className: "tokabe-col-tgl", orderable: true },
                { data: 5, className: "text-center tokabe-col-status", orderable: true },
                { data: 6, className: "text-center tokabe-col-approval", orderable: true },
                { data: 7, className: "tokabe-col-deskripsi", orderable: false },
                { data: 8, className: "tokabe-col-material", orderable: false },
                { data: 9, className: "tokabe-col-alasan", orderable: true },
                { data: 10, className: "tokabe-col-panjar", orderable: true },
                { data: 11, className: "tokabe-col-total", orderable: true },
                { data: 12, className: "text-center tokabe-col-pembayaran", orderable: true },
                { data: 13, className: "tokabe-col-orderby", orderable: true },
                { data: 14, className: "tokabe-col-admin", orderable: true },
                { data: 15, className: "text-center tokabe-col-aksi", orderable: false }
            ],
            language: {
                search: "Cari:",
                searchPlaceholder: "Nomor invoice, pelanggan...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                zeroRecords: "Tidak ada invoice yang sesuai",
                paginate: {
                    first: '<i class="las la-angle-double-left"></i>',
                    previous: '<i class="las la-angle-left"></i>',
                    next: '<i class="las la-angle-right"></i>',
                    last: '<i class="las la-angle-double-right"></i>'
                },
                processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Memuat data...</span></div> Memuat invoice...'
            },
            initComplete: function() {
                // Relokasi length, search, info, paginate ke custom toolbar & footer container
                var wrapper = $('#scroll-horizontal_wrapper');
                var lengthEl = wrapper.find('.dataTables_length');
                var filterEl = wrapper.find('.dataTables_filter');
                var infoEl = wrapper.find('.dataTables_info');
                var paginateEl = wrapper.find('.dataTables_paginate');

                if (lengthEl.length && $('#tokabeCustomLength').length) {
                    $('#tokabeCustomLength').empty().append(lengthEl);
                }
                if (filterEl.length && $('#tokabeCustomSearch').length) {
                    $('#tokabeCustomSearch').empty().append(filterEl);
                }
                if (infoEl.length && $('#tokabeCustomInfo').length) {
                    $('#tokabeCustomInfo').empty().append(infoEl);
                }
                if (paginateEl.length && $('#tokabeCustomPaginate').length) {
                    $('#tokabeCustomPaginate').empty().append(paginateEl);
                }
            },
            drawCallback: function() {
                $('#btnToggleAllRows').text('Buka Semua Rincian');
            }
        });

        // Event listener saat sort header kolom DataTables berubah
        invoiceTable.on('order.dt', function() {
            var order = invoiceTable.order();
            var ths = $('#scroll-horizontal thead th');
            ths.removeClass('active-sort');
            ths.find('.tokabe-sort-icon').html('<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"></path><path d="M4 20L21 3"></path><path d="M21 16v5h-5"></path><path d="M15 15l6 6"></path><path d="M4 4l5 5"></path></svg>');

            if (order.length > 0) {
                var colIdx = order[0][0];
                var dir = order[0][1];
                var activeTh = $(ths[colIdx]);
                activeTh.addClass('active-sort');
                var arrowIcon = dir === 'desc' 
                    ? '<i class="las la-arrow-down text-primary"></i>' 
                    : '<i class="las la-arrow-up text-primary"></i>';
                activeTh.find('.tokabe-sort-icon').html(arrowIcon);

                var label = 'Tanggal Terbaru';
                if (colIdx === 4 && dir === 'desc') label = 'Tanggal Terbaru';
                else if (colIdx === 4 && dir === 'asc') label = 'Tanggal Terlama';
                else if (colIdx === 1 && dir === 'asc') label = 'Invoice ID (A-Z)';
                else if (colIdx === 1 && dir === 'desc') label = 'Invoice ID (Z-A)';
                else if (colIdx === 2 && dir === 'asc') label = 'Pelanggan (A-Z)';
                else if (colIdx === 2 && dir === 'desc') label = 'Pelanggan (Z-A)';
                else if (colIdx === 5) label = 'Status Pembayaran';
                else if (colIdx === 6) label = 'Approval';
                else if (colIdx === 9) label = 'Alasan Batal';
                else if (colIdx === 10 && dir === 'desc') label = 'Panjar Terbesar';
                else if (colIdx === 11 && dir === 'desc') label = 'Total Terbesar';
                else if (colIdx === 11 && dir === 'asc') label = 'Total Terkecil';
                else if (colIdx === 13) label = 'Order By';
                else if (colIdx === 14) label = 'Admin';
                $('#currentSortLabel').text(label);
            }
        });

        // Klik tombol chevron [ > ], '+ X item lagi', atau 'Sembunyikan'
        $(document).on('click', '.tokabe-row-toggle, .tokabe-desc-more, .tokabe-desc-less', function(e) {
            e.stopPropagation();
            toggleRowDesc(this);
        });

        // Klik baris tabel
        $(document).on('click', '#scroll-horizontal tbody tr', function(e) {
            if ($(e.target).closest('a, button, select, input, textarea, .dropdown-menu, .tokabe-action-dropdown').length) {
                return;
            }
            toggleRowDesc(this);
        });

        // Filter Jenis Invoice
        var urlParams = new URLSearchParams(window.location.search);
        var jenisParam = urlParams.get('jenis');
        if (jenisParam) {
            $('#filterJenisInvoice').val(jenisParam);
            $('#btnResetFilterJenis').show();
        }

        $('#filterJenisInvoice').on('change', function() {
            var val = $(this).val();
            if (val) {
                $('#btnResetFilterJenis').show();
            } else {
                $('#btnResetFilterJenis').hide();
            }

            var url = new URL(window.location);
            if (val) {
                url.searchParams.set('jenis', val);
            } else {
                url.searchParams.delete('jenis');
            }
            window.history.replaceState({}, '', url);

            if (invoiceTable) {
                invoiceTable.ajax.reload();
            }
        });

        $('#btnResetFilterJenis').on('click', function() {
            $('#filterJenisInvoice').val('').trigger('change');
        });
    });
</script>
@endsection
