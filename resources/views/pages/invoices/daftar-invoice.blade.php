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
       TABLE & DATATABLES (§13)
       ========================================================================== */
    .invoice-main-card {
        background: #161B22 !important;
        border: 1px solid #1E293B !important;
        border-radius: 12px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
        overflow: hidden;
    }
    .invoice-card-header {
        background: transparent !important;
        border-bottom: 1px solid #1E293B !important;
        padding: 16px 20px !important;
    }
    .filter-select-dark {
        background-color: #0F172A !important;
        border: 1px solid #334155 !important;
        color: #F1F5F9 !important;
        border-radius: 8px !important;
        font-size: 13px !important;
    }
    .filter-select-dark:focus {
        border-color: #4F46E5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    }

    /* Table Reset & Styling */
    .invoice-table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        width: 100% !important;
        margin-bottom: 0 !important;
        border: none !important;
    }
    .invoice-table thead th {
        background: #1E293B !important;
        color: #94A3B8 !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        padding: 12px 14px !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid #334155 !important;
        white-space: nowrap;
    }
    .invoice-table tbody tr {
        background-color: transparent !important;
        transition: background-color 0.15s ease;
    }
    .invoice-table tbody tr:hover {
        background-color: rgba(30, 41, 59, 0.65) !important;
    }
    .invoice-table tbody td {
        padding: 12px 14px !important;
        color: #CBD5E1 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid #1E293B !important;
        font-size: 13px !important;
        vertical-align: middle !important;
    }

    /* Action Ghost Button */
    .btn-action-ghost {
        background: #1E293B !important;
        border: 1px solid #334155 !important;
        color: #94A3B8 !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
        transition: all 0.15s ease;
    }
    .btn-action-ghost:hover {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    /* Dropdown Menu (§11) */
    .dropdown-menu {
        background: #161B22 !important;
        border: 1px solid #1E293B !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5) !important;
        padding: 6px !important;
        z-index: 1050 !important;
    }
    .dropdown-item {
        color: #CBD5E1 !important;
        border-radius: 6px !important;
        padding: 8px 12px !important;
        font-size: 13px !important;
        transition: all 0.15s ease;
    }
    .dropdown-item:hover {
        background: #1E293B !important;
        color: #F1F5F9 !important;
    }
    .dropdown-divider {
        border-color: #1E293B !important;
        margin: 4px 0 !important;
    }

    /* ==========================================================================
       DATATABLES CONTROLS: SEJAJAR & RAPI (§13.2)
       ========================================================================== */
    .dataTables_wrapper {
        position: relative;
        clear: both;
    }
    .dataTables_wrapper::after {
        content: "";
        display: table;
        clear: both;
    }

    /* Top Controls: Length (Left) & Filter/Search (Right) Sejajar */
    .dataTables_wrapper .dataTables_length {
        float: left !important;
        display: inline-flex !important;
        align-items: center !important;
        height: 52px !important;
        padding: 8px 16px !important;
        margin: 0 !important;
        color: #94A3B8 !important;
        font-size: 13px !important;
    }

    .dataTables_wrapper .dt-buttons {
        float: left !important;
        display: inline-flex !important;
        align-items: center !important;
        height: 52px !important;
        padding: 8px 8px !important;
        margin: 0 !important;
    }

    .dataTables_wrapper .dt-buttons .dt-button {
        background-color: #1E293B !important;
        border: 1px solid #334155 !important;
        color: #CBD5E1 !important;
        border-radius: 6px !important;
        padding: 4px 10px !important;
        font-size: 12px !important;
        margin-right: 4px !important;
        transition: all 0.15s ease;
    }
    .dataTables_wrapper .dt-buttons .dt-button:hover {
        background-color: #334155 !important;
        color: #FFFFFF !important;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        height: 52px !important;
        padding: 8px 16px !important;
        margin: 0 !important;
        text-align: right !important;
        color: #94A3B8 !important;
        font-size: 13px !important;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        margin: 0 !important;
        line-height: 1 !important;
        font-size: 13px !important;
        color: #94A3B8 !important;
        font-weight: 500 !important;
    }

    .dataTables_wrapper .dataTables_length select {
        background-color: #0F172A !important;
        border: 1px solid #334155 !important;
        color: #F1F5F9 !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
        height: 32px !important;
        line-height: 1 !important;
        margin: 0 4px !important;
        width: auto !important;
        display: inline-block !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        background-color: #0F172A !important;
        border: 1px solid #334155 !important;
        color: #F1F5F9 !important;
        border-radius: 6px !important;
        padding: 4px 10px !important;
        height: 32px !important;
        line-height: 1 !important;
        margin: 0 0 0 6px !important;
        width: 200px !important;
        display: inline-block !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #4F46E5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
        outline: none;
    }

    /* Hilangkan panah sort / filter pada semua header kolom tabel */
    table#scroll-horizontal thead th,
    table.invoice-table thead th {
        cursor: default !important;
    }
    table#scroll-horizontal thead th:before,
    table#scroll-horizontal thead th:after,
    table#scroll-horizontal thead th.sorting:before,
    table#scroll-horizontal thead th.sorting:after,
    table#scroll-horizontal thead th.sorting_asc:before,
    table#scroll-horizontal thead th.sorting_asc:after,
    table#scroll-horizontal thead th.sorting_desc:before,
    table#scroll-horizontal thead th.sorting_desc:after,
    table.invoice-table thead th:before,
    table.invoice-table thead th:after {
        display: none !important;
        content: "" !important;
    }

    /* Table Clearfix */
    .dataTables_wrapper .dataTables_scroll,
    .dataTables_wrapper .dataTables_scrollBody,
    .dataTables_wrapper table.dataTable {
        clear: both !important;
        width: 100% !important;
    }

    /* Bottom Controls: Info (Left) & Paginate (Right) Sejajar */
    .dataTables_wrapper .dataTables_info {
        float: left !important;
        display: inline-flex !important;
        align-items: center !important;
        height: 52px !important;
        padding: 8px 16px !important;
        margin: 0 !important;
        color: #94A3B8 !important;
        font-size: 13px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        height: 52px !important;
        padding: 8px 16px !important;
        margin: 0 !important;
    }

    .dataTables_wrapper .dataTables_paginate .page-link {
        background-color: #161B22 !important;
        border-color: #1E293B !important;
        color: #94A3B8 !important;
        border-radius: 6px !important;
        margin: 0 2px;
    }
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: #4F46E5 !important;
        border-color: #4F46E5 !important;
        color: #FFFFFF !important;
    }
    .dataTables_wrapper .dataTables_paginate .page-link:hover {
        background-color: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #334155 !important;
    }

    /* Minimum height for dropdown overflow */
    .table-responsive, .dataTables_scrollBody, .invoice-table-body {
        min-height: 380px;
    }

    /* Modal Styling */
    .modal-content {
        background-color: #161B22 !important;
        border: 1px solid #1E293B !important;
        color: #F1F5F9 !important;
        border-radius: 12px !important;
    }
    .modal-header, .modal-footer {
        border-color: #1E293B !important;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* SweetAlert Dark */
    .swal2-popup {
        width: 500px;
        background-color: #161B22 !important;
        border: 1px solid #1E293B !important;
        color: #F1F5F9 !important;
        border-radius: 12px !important;
    }

    /* ==========================================================================
       ROW DENSITY & HEIGHT CONTROLS (LEBARKAN & KECILKAN BARIS)
       ========================================================================== */
    .btn-toggle-row-detail {
        background: rgba(99, 102, 241, 0.12) !important;
        border: 1px dashed rgba(99, 102, 241, 0.45) !important;
        color: #A5B4FC !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 3px 8px !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        transition: all 0.15s ease !important;
        margin-top: 5px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
        line-height: 1.3 !important;
    }
    .btn-toggle-row-detail:hover {
        background: rgba(99, 102, 241, 0.28) !important;
        color: #FFFFFF !important;
        border-color: #818CF8 !important;
    }

    /* 1. Mode Compact / Ringkas (Kecilkan Baris) */
    .table-compact-mode.invoice-table tbody td {
        padding: 8px 12px !important;
        font-size: 12.5px !important;
    }
    .table-compact-mode.invoice-table tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-compact-mode .collapsible-extra-items {
        display: none;
    }
    .table-compact-mode .btn-toggle-row-detail .btn-text-collapsed {
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    .table-compact-mode .btn-toggle-row-detail .btn-text-expanded {
        display: none;
    }

    /* Baris individual yang dilebarkan manual di mode compact */
    .table-compact-mode tr.row-manually-expanded .collapsible-extra-items {
        display: block !important;
        animation: fadeInDetail 0.2s ease-in-out;
    }
    .table-compact-mode tr.row-manually-expanded .btn-toggle-row-detail .btn-text-collapsed {
        display: none !important;
    }
    .table-compact-mode tr.row-manually-expanded .btn-toggle-row-detail .btn-text-expanded {
        display: inline-flex !important;
        align-items: center;
        gap: 3px;
    }

    /* 2. Mode Expanded / Penuh (Lebarkan Baris) */
    .table-expanded-mode.invoice-table tbody td {
        padding: 14px 14px !important;
        font-size: 13px !important;
    }
    .table-expanded-mode .collapsible-extra-items {
        display: block !important;
    }
    .table-expanded-mode .btn-toggle-row-detail .btn-text-collapsed {
        display: none !important;
    }
    .table-expanded-mode .btn-toggle-row-detail .btn-text-expanded {
        display: inline-flex !important;
        align-items: center;
        gap: 3px;
    }

    /* Baris individual yang dikecilkan manual di mode expanded */
    .table-expanded-mode tr.row-manually-collapsed .collapsible-extra-items {
        display: none !important;
    }
    .table-expanded-mode tr.row-manually-collapsed .btn-toggle-row-detail .btn-text-collapsed {
        display: inline-flex !important;
        align-items: center;
        gap: 3px;
    }
    .table-expanded-mode tr.row-manually-collapsed .btn-toggle-row-detail .btn-text-expanded {
        display: none !important;
    }

    
    /* ==========================================================================
       LEBAR & KESELARASAN KOLOM TABEL (COLUMN SIZING & ALIGNMENT LOCK)
       Mengunci ukuran & posisi setiap kolom agar thead dan tbody selalu 100% presisi
       ========================================================================== */
    table#scroll-horizontal th.col-no,
    table#scroll-horizontal td.col-no,
    table.invoice-table th.col-no,
    table.invoice-table td.col-no {
        width: 48px !important;
        min-width: 48px !important;
        max-width: 48px !important;
        text-align: center !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-invoice,
    table#scroll-horizontal td.col-invoice,
    table.invoice-table th.col-invoice,
    table.invoice-table td.col-invoice {
        width: 140px !important;
        min-width: 140px !important;
        text-align: left !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-pelanggan,
    table#scroll-horizontal td.col-pelanggan,
    table.invoice-table th.col-pelanggan,
    table.invoice-table td.col-pelanggan {
        width: 220px !important;
        min-width: 220px !important;
        text-align: left !important;
        white-space: normal !important;
        word-break: break-word !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-telepon,
    table#scroll-horizontal td.col-telepon,
    table.invoice-table th.col-telepon,
    table.invoice-table td.col-telepon {
        width: 130px !important;
        min-width: 130px !important;
        text-align: left !important;
        white-space: nowrap !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-tgl,
    table#scroll-horizontal td.col-tgl,
    table.invoice-table th.col-tgl,
    table.invoice-table td.col-tgl {
        width: 155px !important;
        min-width: 155px !important;
        text-align: left !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-status,
    table#scroll-horizontal td.col-status,
    table.invoice-table th.col-status,
    table.invoice-table td.col-status {
        width: 115px !important;
        min-width: 115px !important;
        text-align: center !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-deskripsi,
    table#scroll-horizontal td.col-deskripsi,
    table.invoice-table th.col-deskripsi,
    table.invoice-table td.col-deskripsi {
        width: 260px !important;
        min-width: 260px !important;
        max-width: 260px !important;
        text-align: left !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        vertical-align: top !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-material,
    table#scroll-horizontal td.col-material,
    table.invoice-table th.col-material,
    table.invoice-table td.col-material {
        width: 240px !important;
        min-width: 240px !important;
        max-width: 240px !important;
        text-align: left !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        vertical-align: top !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-alasan,
    table#scroll-horizontal td.col-alasan,
    table.invoice-table th.col-alasan,
    table.invoice-table td.col-alasan {
        width: 140px !important;
        min-width: 140px !important;
        text-align: left !important;
        white-space: normal !important;
        word-break: break-word !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-approval,
    table#scroll-horizontal td.col-approval,
    table.invoice-table th.col-approval,
    table.invoice-table td.col-approval {
        width: 105px !important;
        min-width: 105px !important;
        text-align: center !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-panjar,
    table#scroll-horizontal td.col-panjar,
    table.invoice-table th.col-panjar,
    table.invoice-table td.col-panjar {
        width: 120px !important;
        min-width: 120px !important;
        text-align: right !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-total,
    table#scroll-horizontal td.col-total,
    table.invoice-table th.col-total,
    table.invoice-table td.col-total {
        width: 135px !important;
        min-width: 135px !important;
        text-align: right !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-pembayaran,
    table#scroll-horizontal td.col-pembayaran,
    table.invoice-table th.col-pembayaran,
    table.invoice-table td.col-pembayaran {
        width: 140px !important;
        min-width: 140px !important;
        text-align: center !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-orderby,
    table#scroll-horizontal td.col-orderby,
    table.invoice-table th.col-orderby,
    table.invoice-table td.col-orderby {
        width: 120px !important;
        min-width: 120px !important;
        text-align: left !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-admin,
    table#scroll-horizontal td.col-admin,
    table.invoice-table th.col-admin,
    table.invoice-table td.col-admin {
        width: 135px !important;
        min-width: 135px !important;
        text-align: left !important;
        white-space: normal !important;
        box-sizing: border-box !important;
    }
    table#scroll-horizontal th.col-aksi,
    table#scroll-horizontal td.col-aksi,
    table.invoice-table th.col-aksi,
    table.invoice-table td.col-aksi {
        width: 65px !important;
        min-width: 65px !important;
        max-width: 65px !important;
        text-align: center !important;
        box-sizing: border-box !important;
    }

    /* Sinkronisasi Header dan Body DataTables Scroll Horizontal */
    .dataTables_scrollHead,
    .dataTables_scrollBody {
        width: 100% !important;
    }
    .dataTables_scrollHeadInner {
        width: 100% !important;
        padding-right: 0px !important;
        box-sizing: content-box !important;
    }
    .dataTables_scrollHeadInner table.invoice-table,
    .dataTables_scrollBody table.invoice-table {
        margin-bottom: 0 !important;
        margin-top: 0 !important;
        width: 100% !important;
    }

    /* Wrap teks list di dalam kolom deskripsi & material agar memanjang vertikal tanpa melebar horizontal */
    .col-deskripsi ul,
    .col-deskripsi li,
    .col-material ul,
    .col-material li {
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
    }

    /* Kursor pointer dan hover baris tabel yang interaktif */
    table#scroll-horizontal tbody tr,
    table.invoice-table tbody tr {
        cursor: pointer;
    }
    table#scroll-horizontal tbody tr:hover,
    table.invoice-table tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.05) !important;
    }

    @keyframes fadeInDetail {
        from { opacity: 0; transform: translateY(-3px); }
        to { opacity: 1; transform: translateY(0); }
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
              <div class="card invoice-main-card">
                  <div class="card-header invoice-card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <h5 class="card-title mb-0 text-white font-weight-semibold">Daftar Invoice</h5>
                        
                        {{-- Tombol Pengatur Lebarkan / Kecilkan Baris Tabel --}}
                        <div class="timeframe-pill-container" role="group" aria-label="Tampilan Baris Tabel">
                            <button type="button" class="btn btn-card-timeframe" id="btn-density-compact" onclick="applyRowDensity('compact')" title="Kecilkan baris (Tampilan ringkas)">
                                <i class="las la-compress-arrows-alt me-1"></i> Kecilkan Baris
                            </button>
                            <button type="button" class="btn btn-card-timeframe active" id="btn-density-expanded" onclick="applyRowDensity('expanded')" title="Lebarkan baris (Tampilan penuh)">
                                <i class="las la-expand-arrows-alt me-1"></i> Lebarkan Baris
                            </button>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <label for="filterJenisInvoice" class="form-label mb-0 fs-13 text-muted text-nowrap fw-semibold">
                            <i class="las la-filter me-1 fs-15 text-primary"></i>Jenis Invoice:
                        </label>
                        <select id="filterJenisInvoice" class="form-select form-select-sm filter-select-dark" style="min-width: 210px;">
                            <option value="">Semua Jenis Invoice</option>
                            @foreach ($jenisInvoiceList as $jInv)
                                <option value="{{ $jInv->id }}">{{ $jInv->nama_invoice }} ({{ $jInv->kode_invoice }})</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btnResetFilterJenis" title="Reset filter" style="display: none;">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                  </div>
                      <!-- KELAS invoice-table-body DITAMBAHKAN DI SINI -->
                      <div class="card-body invoice-table-body p-0">
                          <table id="scroll-horizontal" class="table nowrap dt-responsive align-middle invoice-table" style="width:100%">
                              <thead>
                                  <tr>
                                      <th scope="col" class="text-center col-no">No</th>
                                      <th scope="col" class="col-invoice">Invoice ID</th>
                                      <th scope="col" class="col-pelanggan">Nama Pelanggan & Perusahaan</th>
                                      <th scope="col" class="col-telepon">No. Telepon</th>
                                      <th scope="col" class="col-tgl">Tanggal Penjualan</th>
                                      <th scope="col" class="text-center col-status">Status</th>
                                      <th scope="col" class="col-deskripsi">Deskripsi</th>
                                      <th scope="col" class="col-material">Bahan Material</th>
                                      <th scope="col" class="col-alasan">Alasan Batal</th>
                                      <th scope="col" class="text-center col-approval">Approval</th>
                                      <th scope="col" class="numeric text-end col-panjar">Panjar</th>
                                      <th scope="col" class="numeric text-end col-total">Total</th>
                                      <th scope="col" class="text-center col-pembayaran">Tipe Pembayaran</th>
                                      <th scope="col" class="col-orderby">Order By</th>
                                      <th scope="col" class="col-admin">Admin</th>
                                      <th scope="col" class="text-center col-aksi">Aksi</th>
                                  </tr>
                              </thead>

                              <tbody>
                                @php
                                    $role = Auth::user()->role ?? '';
                                    $isOwner = $role === 'Pemilik';
                                    $isAdmin = $role === 'Admin';
                                    $waNumber = '628116029999';
                                    $waNumber2 = '628116179999';
                                    $waNumberLunas1 = '628116179999';
                                    $waNumberLunas2 = '628116029999';
                                @endphp
                                @foreach ($penjualan as $inv)

                                  <tr data-jenis-id="{{ $inv->invoice }}" data-jenis-nama="{{ $inv->jenis_invoice_nama }}">
                                    <td class="text-center col-no">{{$loop->iteration}}</td>
                                      <td class="col-invoice">
                                          <p class="fw-semibold text-white mb-1 font-monospace" style="font-size: 13px;">{{$inv->nomor_invoice}}</p>
                                          @if(!empty($inv->jenis_invoice_nama) && $inv->jenis_invoice_nama != '-')
                                              <span class="badge-jenis-inv">{{ $inv->jenis_invoice_nama }}</span>
                                          @endif
                                      </td>
                                      <td class="col-pelanggan">{{$inv->customer. ' / '. $inv->perusahaan}}</td>
                                      <td class="col-telepon">{{$inv->no_telepon}}</td>
                                      <td class="col-tgl">{{$inv->formatted_tgl_penjualan}}
                                        @if ($inv->updated_at != $inv->created_at)
                                            <br><span class="text-muted" style="font-size: 0.75rem;">Last Update: {{ $inv->formatted_tgl_update }}</span>
                                        @endif</td>
                                      <td class="text-center col-status">
                                          @if ($inv->status == 'Lunas')
                                              <span class="badge-status badge-status-lunas">{{$inv->status}}</span>
                                          @elseif($inv->status == 'Belum Lunas')
                                              <span class="badge-status badge-status-belum">{{$inv->status}}</span>
                                          @else
                                              <span class="badge-status badge-status-batal">{{$inv->status}}</span>
                                          @endif
                                      </td>
                                        <td class="col-deskripsi">
                                          @php 
                                              $totalDeskripsi = count($inv->penjualanBarang ?? []); 
                                          @endphp
                                          <ul class="list-unstyled mb-0">
                                              @foreach($inv->penjualanBarang as $idx => $pb)
                                                  @if($idx < 2)
                                                      <li class="mb-1 text-wrap">- {{ $pb->deskripsi_item }}</li>
                                                  @else
                                                      @if($idx === 2)
                                                          <div class="collapsible-extra-items">
                                                      @endif
                                                      <li class="mb-1 text-wrap">- {{ $pb->deskripsi_item }}</li>
                                                      @if($loop->last)
                                                          </div>
                                                      @endif
                                                  @endif
                                              @endforeach
                                          </ul>
                                          @if($totalDeskripsi > 2)
                                              <button type="button" class="btn-toggle-row-detail" onclick="toggleSingleRowDetail(this, event)" title="Lebarkan atau kecilkan rincian item baris ini">
                                                  <span class="btn-text-collapsed"><i class="las la-angle-down"></i> +{{ $totalDeskripsi - 2 }} lainnya (Lebarkan)</span>
                                                  <span class="btn-text-expanded"><i class="las la-angle-up"></i> Kecilkan</span>
                                              </button>
                                          @endif
                                      </td>
                                        <td class="col-material">
                                           @php 
                                               $hasMaterial = false; 
                                               $materialItems = [];
                                               if($inv->penjualanBarang) {
                                                   foreach($inv->penjualanBarang as $pb) {
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

                                                       foreach($matIds as $mIdx => $mId) {
                                                           $mat = isset($materialsMap) ? $materialsMap->get($mId) : \App\Models\Material::find($mId);
                                                           if($mat) {
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
                                           @endphp

                                           @if($hasMaterial)
                                               <ul class="list-unstyled mb-0">
                                                   @foreach($materialItems as $mIdx => $mItem)
                                                       @if($mIdx < 2)
                                                           <li class="mb-2" style="border-bottom: 1px dashed #334155; padding-bottom: 4px;">
                                                               <span class="fw-semibold text-primary">{{ $mItem['jenis'] }}</span><br>
                                                               <span class="text-muted" style="font-size: 0.8rem;">Dipakai: <b>{{ $mItem['qty'] }} {{ $mItem['satuan'] }}</b></span>
                                                               @if($mItem['panjang'] && $mItem['lebar'])
                                                                   <br><span class="text-muted" style="font-size: 0.75rem;">(Ukuran: {{ $mItem['panjang'] }} &times; {{ $mItem['lebar'] }})</span>
                                                               @endif
                                                           </li>
                                                       @else
                                                           @if($mIdx === 2)
                                                               <div class="collapsible-extra-items">
                                                           @endif
                                                           <li class="mb-2" style="border-bottom: 1px dashed #334155; padding-bottom: 4px;">
                                                               <span class="fw-semibold text-primary">{{ $mItem['jenis'] }}</span><br>
                                                               <span class="text-muted" style="font-size: 0.8rem;">Dipakai: <b>{{ $mItem['qty'] }} {{ $mItem['satuan'] }}</b></span>
                                                               @if($mItem['panjang'] && $mItem['lebar'])
                                                                   <br><span class="text-muted" style="font-size: 0.75rem;">(Ukuran: {{ $mItem['panjang'] }} &times; {{ $mItem['lebar'] }})</span>
                                                               @endif
                                                           </li>
                                                           @if($loop->last)
                                                               </div>
                                                           @endif
                                                       @endif
                                                   @endforeach
                                               </ul>
                                               @if($totalMaterials > 2)
                                                   <button type="button" class="btn-toggle-row-detail" onclick="toggleSingleRowDetail(this, event)" title="Lebarkan atau kecilkan rincian material baris ini">
                                                       <span class="btn-text-collapsed"><i class="las la-angle-down"></i> +{{ $totalMaterials - 2 }} lainnya (Lebarkan)</span>
                                                       <span class="btn-text-expanded"><i class="las la-angle-up"></i> Kecilkan</span>
                                                   </button>
                                               @endif
                                           @else
                                               <span class="text-muted" style="font-size: 0.8rem;"><i>Tidak ada material yang dipakai</i></span>
                                           @endif
                                       </td>
                                      <td class="col-alasan">{{ $inv->alasan_batal ?: '-' }}</td>
                                      <td class="text-center col-approval">
                                          @if ($inv->approval == 'Unlock')
                                              <span class="badge-status badge-status-lunas">{{$inv->approval}}</span>
                                          @elseif($inv->approval == 'Lock')
                                              <span class="badge-status badge-status-belum">{{$inv->approval}}</span>
                                          @else
                                              <span class="badge-status badge-status-info">{{$inv->approval}}</span>
                                          @endif
                                      </td>
                                      <td class="numeric text-end col-panjar">Rp {{ $inv->formatted_dp }}</td>
                                      <td class="numeric text-end fw-semibold text-white col-total">Rp {{ $inv->formatted_total_pembayaran }}</td>
                                    <td class="text-center col-pembayaran">
                                        @if ($inv->jenis_pembayaran == 'Cash Lunas' || $inv->jenis_pembayaran == 'Transfer Lunas')
                                            <span class="badge-status badge-status-lunas">{{$inv->jenis_pembayaran}}</span>
                                        @else
                                            <span class="badge-status badge-status-belum">{{ $inv->jenis_pembayaran == 'Cash Belum Lunas' ? 'Cash Belum Lunas' : $inv->jenis_pembayaran }}</span>
                                        @endif
                                    </td>
                                    <td class="col-orderby">{{ $inv->order_by ?: '-' }}</td>
                                     <td class="col-admin">{{ $inv->user ? $inv->user->nama : 'Tidak Diketahui' }}</td>
                                      <td class="text-center col-aksi">
                                      
                                          <div class="dropdown d-inline-block">
                                              <!-- PENAMBAHAN data-bs-boundary="window" DAN data-bs-popper-config AGAR DROPDOWN MUNCUL MELAYANG DI LUAR TABEL -->
                                              <button class="btn btn-action-ghost btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="window" data-bs-popper-config='{"strategy":"fixed"}'>
                                                  <i class="las la-ellipsis-h align-middle fs-16"></i>
                                              </button>
                                              <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                                   <li>
                                                       <a class="dropdown-item" href="{{ url('cetak/'.$inv->id.'?type=asli') }}" target="_blank">
                                                           <i class="las la-print fs-18 align-middle me-2 text-primary"></i>Cetak Invoice (ASLI)
                                                       </a>
                                                   </li>
                                                   <li>
                                                       <a class="dropdown-item" href="{{ url('cetak/'.$inv->id.'?type=copy') }}" target="_blank">
                                                           <i class="las la-print fs-18 align-middle me-2 text-danger"></i>Cetak Invoice (COPY)
                                                       </a>
                                                   </li>
                                                  <li>
                                                      <a class="dropdown-item" href="{{ url('view/download/'.$inv->id) }}" target="_blank">
                                                          <i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>Download
                                                      </a>
                                                  </li>
    
    {{-- === BUTTON KIRIM WA CUSTOMER === --}}
    @php
        // 1. Format Nomor HP
        $no_hp_cust = $inv->no_telepon ?? ''; 
        $no_hp_cust = preg_replace('/[^0-9]/', '', $no_hp_cust);
        if(substr($no_hp_cust, 0, 1) == '0'){
            $no_hp_cust = '62' . substr($no_hp_cust, 1);
        }

        // 2. Generate Signed URL (Expired 7 Hari)
        $link_khusus_customer = URL::temporarySignedRoute(
            'invoice.public_download', 
            now()->addDays(7),
            ['id' => $inv->id]   
        );

        // 3. Susun Pesan Lengkap sesuai format baru
        $pesan_cust = "Invoice : " . $inv->nomor_invoice . "\n";
        $pesan_cust .= "Link Download Invoice (Berlaku 7 Hari):\n";
        $pesan_cust .= $link_khusus_customer . "\n\n";
        $pesan_cust .= "Total Rp " . number_format($inv->total_harga, 0, ',', '.') . "\n\n";

        // Cek Sisa Pembayaran (Jika > 0 berarti Belum Lunas)
        if($inv->status !== 'Lunas' && $inv->sisa_pembayaran > 0) {
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
    @endphp
    <li>
         <a class="dropdown-item" href="https://wa.me/{{ $no_hp_cust }}?text={{ urlencode($pesan_cust) }}" target="_blank">
            <i class="lab la-whatsapp fs-18 align-middle me-2 text-success"></i>Kirim Invoice (WA)
        </a>
    </li>

    {{-- === LOGIKA USER === --}}
    @if($isAdmin)
        @php
            $msg = urlencode("Halo, saya ingin meminta approval untuk membuka akses invoice *#{$inv->nomor_invoice}* atas nama *{$inv->customer}*. Mohon untuk segera ditinjau 🙏 \n\nKlik link berikut untuk membuka halaman approval:\n" . url("/invoice-approval/{$inv->id}"));
            $msgLunas = urlencode("Halo, saya ingin Request perubahan status pelunasan untuk invoice *#{$inv->nomor_invoice}* atas nama *{$inv->customer}*. Mohon untuk segera ditinjau 🙏 \n\nKlik link berikut untuk membuka halaman ubah status pelunasan:\n" . url("/invoice-pelunasan/{$inv->id}"));
            $waLink = "https://wa.me/{$waNumber}?text={$msg}";
            $waLink2 = "https://wa.me/{$waNumber2}?text={$msg}";
            $waLinkLunas1 = "https://wa.me/{$waNumberLunas1}?text={$msgLunas}";
            $waLinkLunas2 = "https://wa.me/{$waNumberLunas2}?text={$msgLunas}";
        @endphp
    @endif

    {{-- === APPROVAL (KHUSUS OWNER) === --}}
    @if($isOwner)
        @if($inv->approval === 'Unlock')
            <li>
                <a class="dropdown-item" href="{{ url('ubah-status-lock/'.$inv->id) }}">
                    <i class="las la-check-square fs-18 align-middle me-2 text-muted"></i>Lock
                </a>
            </li>
        @endif
    @endif

    {{-- === REQUEST APPROVAL (KHUSUS ADMIN) === --}}
    @if($isAdmin && $inv->approval !== 'Unlock')
        <li>
            <a class="dropdown-item text-warning fw-semibold" href="{{ $waLink }}" target="_blank">
                <i class="lab la-whatsapp fs-18 align-middle me-2 text-success"></i>Request Unlock (Owner 1)
            </a>
        </li>
        <li>
            <a class="dropdown-item text-warning fw-semibold" href="{{ $waLink2 }}" target="_blank">
                <i class="lab la-whatsapp fs-18 align-middle me-2 text-success"></i>Request Unlock (Owner 2)
            </a>
        </li>
    @endif
    
    {{-- === BUTTON BUAT SPK === --}}
        <li>
            <a class="dropdown-item btn-buat-spk" href="#" data-id="{{ $inv->id }}" data-bs-toggle="modal" data-bs-target="#buatSpkModal">
                <i class="las la-clipboard-list fs-18 align-middle me-2 text-primary"></i>Buat SPK
            </a>
        </li>
    
    {{-- === REQUEST LUNAS (KHUSUS ADMIN) === --}}
    @if($isAdmin && $inv->status !== 'Lunas')
        <li>
            <a class="dropdown-item text-warning fw-semibold" href="{{ $waLinkLunas1 }}" target="_blank">
                <i class="lab la-whatsapp fs-18 align-middle me-2 text-success"></i>Request Pelunasan (Owner 1)
            </a>
        </li>
        <li>
            <a class="dropdown-item text-warning fw-semibold" href="{{ $waLinkLunas2 }}" target="_blank">
                <i class="lab la-whatsapp fs-18 align-middle me-2 text-success"></i>Request Pelunasan (Owner 2)
            </a>
        </li>
    @endif

    {{-- === Tombol lain: Pemilik selalu bisa, Admin hanya jika sudah approved === --}}
    @php($canManage = !$isAdmin || $inv->approval === 'Unlock')

    @if($canManage)
        <li>
            <a class="dropdown-item" href="{{ url('editInvoice/'.$inv->id.'/edit') }}">
                <i class="las la-pen fs-18 align-middle me-2 text-muted"></i>Edit
            </a>
        </li>

        <li>
            <a class="dropdown-item btn-update-log"
               href="#" data-id="{{ $inv->id }}"
               data-bs-toggle="modal" data-bs-target="#updateLogModal">
                <i class="las la-paste fs-18 align-middle me-2 text-muted"></i>Update Log
            </a>
        </li>

        @if($inv->status !== 'Batal')
            <li>
                <button type="button" class="dropdown-item" 
                        onclick="confirmBatal('{{ $inv->id }}', '{{ $inv->nomor_invoice }}')">
                    <i class="las la-folder-minus fs-18 align-middle me-2 text-muted"></i>Invoice Batal
                </button>
            </li>
        @endif
    @endif

    {{-- === DELETE – tampil untuk semua === --}}
    <li class="dropdown-divider"></li>
    <li>
        <button class="dropdown-item" type="button"
                onclick="showConfirmation('{{ $inv->nomor_invoice }}','{{ $inv->id }}')">
            <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>Delete
        </button>
    </li>
</ul>

                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach

                              </tbody><!-- end tbody -->
                          </table><!-- end table -->
                          <form id="globalBatalForm" method="POST" style="display: none;">
                              @csrf
                              <input type="hidden" name="alasan_batal" id="globalInputAlasanBatal">
                          </form>
                          <form id="globalDeleteForm" method="POST" style="display: none;">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="alasan_hapus" id="globalInputAlasanHapus">
                          </form>
                      </div><!-- end table responsive -->
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

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
{{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}

<script>
    const loggedInUser = "{{ auth()->user()->nama }}";
</script>

<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.init.js')}}"></script>
<script src="{{asset('js/halaman/daftar-invoice.js')}}"></script>
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
    // Filter DataTables Berdasarkan Jenis Invoice
    $(document).ready(function() {
        if ($.fn.dataTable) {
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    if (settings.nTable.id !== 'scroll-horizontal') {
                        return true;
                    }
                    var selectedJenis = $('#filterJenisInvoice').val();
                    if (!selectedJenis || selectedJenis === '') {
                        return true;
                    }
                    var rowNode = settings.aoData[dataIndex].nTr;
                    var rowJenisId = $(rowNode).attr('data-jenis-id');
                    return rowJenisId == selectedJenis;
                }
            );
        }

        $('#filterJenisInvoice').on('change', function() {
            var val = $(this).val();
            if (val) {
                $('#btnResetFilterJenis').show();
            } else {
                $('#btnResetFilterJenis').hide();
            }

            // Sync URL parameter tanpa reload
            var url = new URL(window.location);
            if (val) {
                url.searchParams.set('jenis', val);
            } else {
                url.searchParams.delete('jenis');
            }
            window.history.replaceState({}, '', url);

            if ($.fn.dataTable.isDataTable('#scroll-horizontal')) {
                $('#scroll-horizontal').DataTable().draw();
            }
        });

        $('#btnResetFilterJenis').on('click', function() {
            $('#filterJenisInvoice').val('').trigger('change');
        });

        // Terapkan filter otomatis jika terdapat parameter ?jenis= di URL saat pertama kali dimuat
        var urlParams = new URLSearchParams(window.location.search);
        var jenisParam = urlParams.get('jenis');
        if (jenisParam) {
            $('#filterJenisInvoice').val(jenisParam).trigger('change');
        }
    });
</script>

<script>
    // =========================================================================
    // FITUR LEBARKAN & KECILKAN BARIS TABEL (Row Density & Row Expand/Collapse)
    // =========================================================================
    function applyRowDensity(mode) {
        var table = $('#scroll-horizontal');
        var btnCompact = $('#btn-density-compact');
        var btnExpanded = $('#btn-density-expanded');

        if (mode === 'compact') {
            table.removeClass('table-expanded-mode').addClass('table-compact-mode');
            table.find('tr').removeClass('row-manually-expanded').removeClass('row-manually-collapsed');
            btnCompact.addClass('active');
            btnExpanded.removeClass('active');
            localStorage.setItem('invoice_table_row_density', 'compact');
        } else {
            table.removeClass('table-compact-mode').addClass('table-expanded-mode');
            table.find('tr').removeClass('row-manually-expanded').removeClass('row-manually-collapsed');
            btnExpanded.addClass('active');
            btnCompact.removeClass('active');
            localStorage.setItem('invoice_table_row_density', 'expanded');
        }

        if ($.fn.dataTable.isDataTable('#scroll-horizontal')) {
            $('#scroll-horizontal').DataTable().columns.adjust();
        }
    }

    function toggleSingleRowDetail(elem, e) {
        if (e && e.stopPropagation) {
            e.stopPropagation();
        }
        var row = $(elem).is('tr') ? $(elem) : $(elem).closest('tr');
        var table = $('#scroll-horizontal');
        var isCurrentlyCompact = table.hasClass('table-compact-mode');

        if (isCurrentlyCompact) {
            row.toggleClass('row-manually-expanded');
        } else {
            row.toggleClass('row-manually-collapsed');
        }
    }

    // Trigger adjust column DataTables saat resize dan density berganti
    $(window).on('resize', function() {
        if ($.fn.dataTable.isDataTable('#scroll-horizontal')) {
            $('#scroll-horizontal').DataTable().columns.adjust();
        }
    });

    $(document).ready(function() {
        var savedDensity = localStorage.getItem('invoice_table_row_density') || 'compact';
        applyRowDensity(savedDensity);

        // Pastikan header & body sinkron sempurna setelah inisialisasi awal
        setTimeout(function() {
            if ($.fn.dataTable.isDataTable('#scroll-horizontal')) {
                $('#scroll-horizontal').DataTable().columns.adjust();
            }
        }, 200);

        // Klik baris tabel manjang kebawah (expand/collapse rincian baris)
        $(document).on('click', '#scroll-horizontal tbody tr', function(e) {
            // Hindari toggle jika klik pada link, button, select, input, textarea, dropdown aksi
            if ($(e.target).closest('a, button, select, input, textarea, .dropdown, .dropdown-menu, .btn-action-ghost').length) {
                return;
            }

            // Jalankan toggle jika baris memiliki rincian tambahan (collapsible-extra-items)
            if ($(this).find('.collapsible-extra-items').length > 0) {
                toggleSingleRowDetail(this, e);
            }
        });
    });
</script>
@endsection
