@extends('layout.template')

@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
/* ==========================================================================
   TOKABE INVENTORY — WARM OBSIDIAN & GRAPHITE DESIGN SYSTEM (UNSLOPPED)
   High-Craft Workshop Catalog: Quiet Chrome, Strict 4px Grid, Tabular Numerics
   Full Dual-Theme Architecture: Mode Gelap & Mode Terang
   ========================================================================== */

:root {
    /* Mode Gelap (Default) — Warm Obsidian & Graphite */
    --ibk-bg: #09090B;
    --ibk-surface: #121215;
    --ibk-surface-hover: #18181C;
    --ibk-card-bg: #121215;
    --ibk-border: rgba(255, 255, 255, 0.08);
    --ibk-border-subtle: rgba(255, 255, 255, 0.04);
    --ibk-text: #F4F4F5;
    --ibk-text-muted: #A1A1AA;
    --ibk-text-dim: #71717A;
    
    /* Brand Accent — Golden Amber */
    --ibk-brand: #F59E0B;
    --ibk-brand-deep: #D97706;
    --ibk-brand-soft: rgba(245, 158, 11, 0.12);
    --ibk-brand-border: rgba(245, 158, 11, 0.24);
    --ibk-brand-text: #FBBF24;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;
    
    /* Semantics */
    --ibk-success: #10B981;
    --ibk-success-soft: rgba(16, 185, 129, 0.10);
    --ibk-success-border: rgba(16, 185, 129, 0.25);
    --ibk-danger: #EF4444;
    --ibk-danger-soft: rgba(239, 68, 68, 0.10);
    --ibk-danger-border: rgba(239, 68, 68, 0.25);
    
    /* Inputs & Popovers */
    --ibk-input-bg: rgba(255, 255, 255, 0.03);
    --ibk-popover-bg: #16161A;
    --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

body.theme-light {
    /* Mode Terang — Neutral Slate & Quiet Ivory */
    --ibk-bg: #F8FAFC;
    --ibk-surface: #FFFFFF;
    --ibk-surface-hover: #F8FAFC;
    --ibk-card-bg: #FFFFFF;
    --ibk-border: #E2E8F0;
    --ibk-border-subtle: #F1F5F9;
    --ibk-text: #0F172A;
    --ibk-text-muted: #64748B;
    --ibk-text-dim: #94A3B8;
    
    /* Brand Accent (Light) */
    --ibk-brand: #D97706;
    --ibk-brand-deep: #B45309;
    --ibk-brand-soft: #FFFBEB;
    --ibk-brand-border: #FDE68A;
    --ibk-brand-text: #D97706;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;
    
    /* Semantics (Light) */
    --ibk-success: #059669;
    --ibk-success-soft: #ECFDF5;
    --ibk-success-border: #A7F3D0;
    --ibk-danger: #DC2626;
    --ibk-danger-soft: #FEF2F2;
    --ibk-danger-border: #FECACA;
    
    /* Inputs & Popovers (Light) */
    --ibk-input-bg: #FFFFFF;
    --ibk-popover-bg: #FFFFFF;
    --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
}

/* Base Wrapper */
.ibk-catalog-wrapper {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--ibk-text);
    min-height: calc(100vh - 120px);
}

.num, .price, .numeric, td.numeric, th.numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: 'tnum' 1, 'cv11' 1 !important;
}

/* Header Section */
.ibk-page-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
}
.ibk-page-title h1 {
    font-size: 20px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    letter-spacing: -0.015em;
}
.ibk-page-subtitle {
    font-size: 13px;
    color: var(--ibk-text-muted);
    margin-top: 4px;
}

/* Primary Button (Quiet Craft, Solid, No Rainbow Glow) */
.ibk-btn-primary {
    background: #EA580C !important;
    border: 1px solid #EA580C !important;
    color: #FFFFFF !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 0 16px !important;
    height: 38px !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    cursor: pointer !important;
    transition: background-color 150ms ease, border-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
    box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
    text-decoration: none !important;
}
.ibk-btn-primary:hover {
    background: #C2410C !important;
    border-color: #C2410C !important;
    color: #FFFFFF !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 6px rgba(234, 88, 12, 0.35) !important;
}
.ibk-btn-primary:active {
    transform: scale(0.98) !important;
}

/* Cards & Surfaces */
.ibk-card {
    background: var(--ibk-card-bg);
    border: 1px solid var(--ibk-border);
    border-radius: 12px;
    box-shadow: var(--ibk-card-shadow);
    margin-bottom: 24px;
    overflow: hidden;
    position: relative;
    transition: border-color 150ms ease;
}
.ibk-card-header {
    background: transparent;
    border-bottom: 1px solid var(--ibk-border);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.ibk-card-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ibk-card-title i {
    font-size: 16px;
    color: var(--ibk-brand);
}

/* Segmented Category Filter Bar */
/* =========================================================
   SEGMENTED CATEGORY NAV & ANIMATED GLIDER
   ========================================================= */
.ibk-segmented-nav {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    border-radius: 8px !important;
    padding: 3px !important;
    gap: 2px !important;
    flex-wrap: wrap !important;
    isolation: isolate !important;
}

.ibk-nav-glider {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 0 !important;
    height: 0 !important;
    background: var(--ibk-brand-soft, rgba(234, 88, 12, 0.12)) !important;
    border: 1px solid var(--ibk-brand-border, rgba(234, 88, 12, 0.3)) !important;
    border-radius: 6px !important;
    pointer-events: none !important;
    z-index: 1 !important;
    opacity: 0;
    box-sizing: border-box !important;
    transition: transform 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                width 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                height 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                opacity 150ms ease !important;
}

body.theme-light .ibk-nav-glider,
html.theme-light .ibk-nav-glider {
    background: #FFF7ED !important;
    border: 1px solid #FED7AA !important;
    box-shadow: 0 1px 3px rgba(234, 88, 12, 0.12) !important;
}

.ibk-segmented-nav .tombol {
    position: relative !important;
    z-index: 2 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    color: var(--ibk-text-muted) !important;
    padding: 5px 12px !important;
    border-radius: 6px !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: color 150ms ease !important;
    white-space: nowrap !important;
    outline: none !important;
    box-shadow: none !important;
}

.ibk-segmented-nav .tombol:hover {
    color: var(--ibk-text) !important;
}

.ibk-segmented-nav .tombol.btn-info {
    color: #EA580C !important;
    font-weight: 600 !important;
    background: transparent !important;
    border-color: transparent !important;
}

body.theme-light .ibk-segmented-nav .tombol.btn-info,
html.theme-light .ibk-segmented-nav .tombol.btn-info {
    color: #EA580C !important;
}

/* KPI Stat Cards (Unslopped: Editorial Numbers & Context) */
.ibk-kpi-card {
    background: var(--ibk-surface);
    border: 1px solid var(--ibk-border);
    border-radius: 10px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 98px;
    position: relative;
    transition: border-color 150ms ease;
}
.ibk-kpi-card:hover {
    border-color: var(--ibk-brand-border);
}
.ibk-kpi-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--ibk-text-muted);
    margin-bottom: 4px;
    letter-spacing: -0.01em;
}
.ibk-kpi-value {
    font-size: 24px;
    font-weight: 600;
    color: var(--ibk-text);
    font-family: 'JetBrains Mono', monospace;
    letter-spacing: -0.02em;
    line-height: 1.2;
}
.ibk-kpi-profit .ibk-kpi-value {
    color: var(--ibk-success) !important;
}
.ibk-kpi-meta {
    font-size: 12px;
    color: var(--ibk-text-muted);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-family: 'JetBrains Mono', monospace;
}

/* DataTables Styling */
.tokabe-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
    background: transparent !important;
}
.tokabe-table thead th {
    background: transparent !important;
    color: var(--ibk-text-muted) !important;
    font-size: 11.5px !important;
    font-weight: 500 !important;
    padding: 12px 16px !important;
    border-bottom: 1px solid var(--ibk-border) !important;
    white-space: nowrap !important;
    letter-spacing: 0.03em !important;
    text-transform: uppercase !important;
}
body.theme-light .tokabe-table thead th {
    background: #F8FAFC !important;
}
.tokabe-table tbody tr {
    background: transparent !important;
    transition: background-color 150ms ease;
}
.tokabe-table tbody tr:hover {
    background: var(--ibk-surface-hover) !important;
}
.tokabe-table tbody td {
    padding: 12px 16px !important;
    color: var(--ibk-text) !important;
    border-bottom: 1px solid var(--ibk-border) !important;
    font-size: 13px !important;
    vertical-align: middle !important;
}

/* Badges */
.badge-kode-barang,
.badge-kode-material,
.badge-kode-inventaris {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11.5px;
    font-weight: 500;
    color: var(--ibk-text-muted);
    background: var(--ibk-input-bg);
    border: 1px solid var(--ibk-border);
    padding: 2px 7px;
    border-radius: 6px;
    display: inline-block;
    letter-spacing: -0.01em;
}
body.theme-light .badge-kode-barang,
body.theme-light .badge-kode-material,
body.theme-light .badge-kode-inventaris {
    color: #475569;
    background: #F1F5F9;
    border-color: #E2E8F0;
}
.badge-satuan-pill,
.badge-kategori-pill {
    background: transparent;
    border: 1px solid var(--ibk-border);
    color: var(--ibk-text-muted);
    font-size: 11.5px;
    font-weight: 500;
    padding: 2px 8px;
    border-radius: 6px;
}
.badge-stock-zero {
    color: var(--ibk-danger);
    background: var(--ibk-danger-soft);
    border: 1px solid var(--ibk-danger-border);
    padding: 2px 7px;
    border-radius: 6px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11.5px;
    font-weight: 600;
}
.badge-stock-low {
    color: var(--ibk-brand);
    background: var(--ibk-brand-soft);
    border: 1px solid var(--ibk-brand-border);
    padding: 2px 7px;
    border-radius: 6px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11.5px;
    font-weight: 600;
}

/* Switch & Action Dropdown */
.form-check-input:checked {
    background-color: var(--ibk-brand) !important;
    border-color: var(--ibk-brand) !important;
}
.btn-action-ghost {
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    padding: 4px 8px !important;
    cursor: pointer;
    transition: color 150ms ease, border-color 150ms ease;
}
.btn-action-ghost:hover {
    color: var(--ibk-text) !important;
    border-color: var(--ibk-brand) !important;
}

/* Action Dropdown Menu */
.tokabe-action-menu {
    background: var(--ibk-popover-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    border-radius: 10px !important;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.35) !important;
    padding: 4px !important;
    min-width: 160px !important;
    z-index: 99999 !important;
}
.tokabe-action-menu .dropdown-item {
    color: var(--ibk-text) !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 7px 10px !important;
    border-radius: 6px !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    transition: background-color 150ms ease !important;
}
.tokabe-action-menu .dropdown-item:hover {
    background: var(--ibk-brand-soft) !important;
    color: var(--ibk-brand-text) !important;
}
body.theme-light .tokabe-action-menu .dropdown-item:hover {
    background: #FFFBEB !important;
    color: #D97706 !important;
}
.tokabe-action-menu .dropdown-item--danger {
    color: #EF4444 !important;
}
.tokabe-action-menu .dropdown-item--danger:hover {
    background: rgba(239, 68, 68, 0.10) !important;
    color: #DC2626 !important;
}
.tokabe-action-menu .dropdown-divider {
    border-color: var(--ibk-border) !important;
    margin: 4px 0 !important;
}

/* DataTables Controls Integration */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    padding: 12px 18px !important;
    color: var(--ibk-text-muted) !important;
    font-size: 12.5px !important;
}
.dataTables_wrapper .dataTables_length select {
    background-color: var(--ibk-input-bg, #0F172A) !important;
    border: 1px solid var(--ibk-border, #334155) !important;
    color: var(--ibk-text, #F8FAFC) !important;
    border-radius: 6px !important;
    min-width: 68px !important;
    height: 32px !important;
    padding: 3px 28px 3px 10px !important;
    outline: none !important;
    cursor: pointer !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 8px center !important;
    background-size: 11px 9px !important;
}
body.theme-light .dataTables_wrapper .dataTables_length select {
    background-color: #FFFFFF !important;
    border-color: #CBD5E1 !important;
    color: #0F172A !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23475569' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
}
.dataTables_wrapper .dataTables_filter input {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text) !important;
    border-radius: 6px !important;
    padding: 6px 12px !important;
    outline: none !important;
    margin-left: 0 !important;
}
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: var(--ibk-brand) !important;
}
.dataTables_wrapper .dataTables_info {
    padding: 12px 18px !important;
    color: var(--ibk-text-muted) !important;
    font-size: 12px !important;
}
/* =========================================================
   TOKABE SIGNATURE PAGINATION (IDENTICAL TO DAFTAR INVOICE)
   ========================================================= */
.ibk-table-footer {
    padding: 14px 20px 18px 20px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    border-top: 1px solid var(--ibk-border, #334155) !important;
    background: var(--ibk-surface, transparent) !important;
    border-bottom-left-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
}

body.theme-light .ibk-table-footer {
    border-top-color: #E2E8F0 !important;
    background: #FFFFFF !important;
}

/* Fallback for DataTables wrapper default bottom row */
.dataTables_wrapper > .row:last-child,
div.dataTables_wrapper div.row:last-child {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 14px 20px 18px 20px !important;
    margin: 0 !important;
    border-top: 1px solid var(--ibk-border, #334155) !important;
    gap: 12px !important;
    background: var(--ibk-surface, transparent) !important;
}

body.theme-light .dataTables_wrapper > .row:last-child,
body.theme-light div.dataTables_wrapper div.row:last-child {
    border-top-color: #E2E8F0 !important;
    background: #FFFFFF !important;
}

.dataTables_wrapper .dataTables_info,
div.dataTables_wrapper div.dataTables_info,
#tokabeCustomInfo .dataTables_info {
    color: var(--ibk-text-muted, #94A3B8) !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
}

body.theme-light .dataTables_wrapper .dataTables_info,
body.theme-light div.dataTables_wrapper div.dataTables_info,
body.theme-light #tokabeCustomInfo .dataTables_info {
    color: #64748B !important;
}

.dataTables_wrapper .dataTables_paginate,
div.dataTables_wrapper div.dataTables_paginate,
#tokabeCustomPaginate .dataTables_paginate,
.dataTables_paginate {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    padding: 0 !important;
    margin: 0 !important;
}

.dataTables_paginate ul.pagination,
div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 4px 6px !important;
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px !important;
    height: 42px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 2px 8px rgba(0, 0, 0, 0.2) !important;
    box-sizing: border-box !important;
}

body.theme-light .dataTables_paginate ul.pagination,
html.theme-light .dataTables_paginate ul.pagination,
body.theme-light div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 4px rgba(15, 23, 42, 0.06) !important;
}

.dataTables_paginate li.page-item,
div.dataTables_wrapper div.dataTables_paginate li.page-item {
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    display: inline-flex !important;
}

.dataTables_paginate .page-link,
.dataTables_paginate .paginate_button,
div.dataTables_wrapper div.dataTables_paginate .page-link,
div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    min-width: 34px !important;
    height: 34px !important;
    padding: 0 10px !important;
    margin: 0 !important;
    border-radius: 8px !important;
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
    font-size: 12.5px !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    text-decoration: none !important;
    cursor: pointer !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    color: #B5AC9F !important;
    box-shadow: none !important;
    outline: none !important;
    transition: all 0.15s ease !important;
    user-select: none !important;
    box-sizing: border-box !important;
}

body.theme-light .dataTables_paginate .page-link,
body.theme-light .dataTables_paginate .paginate_button,
html.theme-light .dataTables_paginate .page-link,
html.theme-light .dataTables_paginate .paginate_button,
body.theme-light div.dataTables_wrapper div.dataTables_paginate .page-link {
    color: #475569 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
}

.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
.dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
div.dataTables_wrapper div.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover {
    background: rgba(249, 115, 22, 0.14) !important;
    border-color: rgba(249, 115, 22, 0.35) !important;
    color: #FB923C !important;
}

body.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
body.theme-light .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover {
    background: #FFF7ED !important;
    border-color: #FDBA74 !important;
    color: #C2410C !important;
}

.dataTables_paginate li.page-item.active .page-link,
.dataTables_paginate .paginate_button.current,
div.dataTables_wrapper div.dataTables_paginate li.page-item.active .page-link {
    background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
    color: #1A0F05 !important;
    font-weight: 700 !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 2px 8px rgba(249, 115, 22, 0.35) !important;
    transform: none !important;
    z-index: 2 !important;
}

body.theme-light .dataTables_paginate li.page-item.active .page-link,
body.theme-light .dataTables_paginate .paginate_button.current,
html.theme-light .dataTables_paginate li.page-item.active .page-link,
html.theme-light .dataTables_paginate .paginate_button.current,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item.active .page-link {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 2px 8px rgba(234, 88, 12, 0.3) !important;
    transform: none !important;
}

.dataTables_paginate li.page-item.previous .page-link,
.dataTables_paginate li.page-item.next .page-link,
.dataTables_paginate li.page-item.first .page-link,
.dataTables_paginate li.page-item.last .page-link,
.dataTables_paginate .paginate_button.previous,
.dataTables_paginate .paginate_button.next {
    font-size: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    background: rgba(255, 255, 255, 0.04) !important;
}

body.theme-light .dataTables_paginate li.page-item.previous .page-link,
body.theme-light .dataTables_paginate li.page-item.next .page-link,
body.theme-light .dataTables_paginate li.page-item.first .page-link,
body.theme-light .dataTables_paginate li.page-item.last .page-link,
body.theme-light .dataTables_paginate .paginate_button.previous,
body.theme-light .dataTables_paginate .paginate_button.next,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item.previous .page-link {
    border: 1px solid #E2E8F0 !important;
    background: #FFFFFF !important;
    color: #475569 !important;
}

.dataTables_paginate li.page-item.disabled .page-link,
.dataTables_paginate .paginate_button.disabled,
div.dataTables_wrapper div.dataTables_paginate li.page-item.disabled .page-link {
    opacity: 0.35 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #94A3B8 !important;
    box-shadow: none !important;
    transform: none !important;
}

/* Modals Modern Styling (Quiet & Precise) */
.tokabe-modal-theme {
    background-color: var(--ibk-surface) !important;
    border: 1px solid var(--ibk-border) !important;
    border-radius: 12px !important;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4) !important;
    overflow: hidden;
}
.tokabe-modal-header {
    border-bottom: 1px solid var(--ibk-border) !important;
    padding: 16px 20px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.tokabe-modal-body {
    padding: 20px !important;
}
.tokabe-modal-footer {
    border-top: 1px solid var(--ibk-border) !important;
    padding: 14px 20px !important;
    background-color: var(--ibk-input-bg) !important;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}
.modal-section-title {
    font-size: 11.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--ibk-brand-text);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
body.theme-light .modal-section-title {
    color: #D97706;
}
.form-label-modern {
    font-size: 12px;
    font-weight: 500;
    color: var(--ibk-text);
    margin-bottom: 6px;
    display: block;
}
.form-control-modern, .form-select-modern {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text) !important;
    border-radius: 6px !important;
    height: 38px !important;
    font-size: 13px !important;
    padding: 6px 12px !important;
    transition: border-color 150ms ease;
}
.form-control-modern:focus, .form-select-modern:focus {
    border-color: var(--ibk-brand) !important;
    outline: none !important;
    box-shadow: 0 0 0 2px var(--ibk-brand-soft) !important;
}
.input-group-addon-modern {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    padding: 0 12px !important;
    display: flex;
    align-items: center;
}
.form-help-text {
    font-size: 11px;
    color: var(--ibk-text-muted);
    margin-top: 4px;
    margin-bottom: 0;
}
.btn-modal-cancel {
    background: transparent !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 7px 14px !important;
    transition: color 150ms ease;
}
.btn-modal-cancel:hover {
    color: var(--ibk-text) !important;
}
.modal-danger-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background-color: rgba(239, 68, 68, 0.10);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #EF4444;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 12px;
}
.btn-modal-delete {
    background-color: #DC2626 !important;
    border-color: #DC2626 !important;
    color: #FFFFFF !important;
    border-radius: 6px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 7px 16px !important;
    transition: opacity 150ms ease;
}

body.theme-light .ibk-btn-primary {
    background: #EA580C !important;
    border-color: #EA580C !important;
    color: #FFFFFF !important;
    box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
}
body.theme-light .ibk-btn-primary:hover {
    background: #C2410C !important;
    border-color: #C2410C !important;
    color: #FFFFFF !important;
}
</style>
@endsection

@section('content')
<div class="ibk-catalog-wrapper py-3">
  <div class="container-fluid">

    <!-- 1. Header & Quick Actions -->
    <div class="ibk-page-header">
      <div class="ibk-page-title">
        <h1>Daftar Barang</h1>
        <div class="ibk-page-subtitle">Katalog produk, kuantitas stok kasir, dan kalkulasi potensi profit</div>
      </div>
      <div class="d-flex align-items-center gap-2">
        <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
          <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
          <span id="theme-toggle-text">Mode Terang</span>
        </button>
        <button type="button" class="ibk-btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
          <i class="las la-plus fs-16"></i>
          <span>Tambah Barang</span>
        </button>
      </div>
    </div>

    <!-- 2. Potensi Penjualan & Profit Section -->
    <div class="ibk-card">
      <div class="ibk-card-header">
        <div class="ibk-card-title">
          <i class="las la-chart-pie"></i>
          <span>Potensi Penjualan dan Profit</span>
        </div>
        <!-- Segmented Category Filters -->
        <div class="ibk-segmented-nav" id="kategoriSegmentedNav">
          <span class="ibk-nav-glider" id="kategoriNavGlider"></span>
          @foreach ($kategoriBrg as $kat)
            <button type="button" class="tombol" onclick="brg({{ $kat->id }})" id="btn_{{ $kat->id }}">
              {{ $kat->nama_kategori }}
            </button>
          @endforeach
        </div>
      </div>

      <div class="p-3">
        <div class="row g-3">
          <!-- KPI 1: Potensi Penjualan -->
          <div class="col-md-6">
            <div class="ibk-kpi-card" id="kpiCardPenjualan">
              <div class="ibk-kpi-label ibk-fade-switch" id="potensi_penjualan">Jumlah Potensi Penjualan</div>
              <div class="d-flex align-items-baseline justify-content-between mt-1">
                <div class="ibk-kpi-value ibk-fade-switch">
                  Rp <span class="counter-value penjualan num" data-target="0">0</span>
                </div>
                <div class="ibk-kpi-meta ibk-fade-switch">
                  <i class="las la-boxes fs-14"></i>
                  <span><span class="stok num">0</span> item</span>
                </div>
              </div>
            </div>
          </div>

          <!-- KPI 2: Potensi Profit -->
          <div class="col-md-6">
            <div class="ibk-kpi-card ibk-kpi-profit" id="kpiCardProfit">
              <div class="ibk-kpi-label ibk-fade-switch" id="potensi_profit">Jumlah Potensi Profit</div>
              <div class="d-flex align-items-baseline justify-content-between mt-1">
                <div class="ibk-kpi-value ibk-fade-switch">
                  Rp <span class="counter-value profit num" data-target="0">0</span>
                </div>
                <div class="ibk-kpi-meta ibk-fade-switch">
                  <i class="las la-coins fs-14"></i>
                  <span><span class="stok num">0</span> item</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 3. Table Section: Daftar Stok Barang -->
    <div class="ibk-card">
      <div class="ibk-card-header">
        <div class="ibk-card-title">
          <i class="las la-boxes"></i>
          <span>Daftar Stok Barang Tokabe</span>
        </div>
        <div class="text-muted fs-12">
          Total: <span class="fw-bold num" style="color: var(--ibk-text);">{{ count($barang) }}</span> item terdaftar
        </div>
      </div>

      <div class="table-responsive">
        <table id="alternative-pagination" class="table nowrap dt-responsive align-middle tokabe-table" style="width:100%">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">No.</th>
              <th>Kategori</th>
              <th>Kode Barang</th>
              <th>Jenis / Nama Barang</th>
              <th>Terakhir Update</th>
              <th class="text-end">Stok</th>
              <th class="text-end">Harga Modal</th>
              <th class="text-end">Harga Jual</th>
              <th class="text-center" style="width: 90px;">Material</th>
              <th class="text-center" style="width: 70px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($barang as $brg)
              <tr>
                <td class="text-center text-muted num" style="font-size: 12.5px;">{{ $loop->iteration }}</td>
                <td>
                  <span class="badge-kategori-pill">{{ $kategori[$brg->kategori_id] ?? '-' }}</span>
                </td>
                <td>
                  <span class="badge-kode-barang">{{ $brg->kode_barang }}</span>
                </td>
                <td>
                  <span class="fw-semibold" style="color: var(--ibk-text); font-size: 13.5px;">{{ $brg->jenis_barang }}</span>
                </td>
                <td class="text-muted" style="font-size: 12px;">
                  {{ date('d M Y, H:i', strtotime($brg->updated_at)) }}
                </td>
                <td class="text-end num">
                  @if($brg->stok <= 0)
                    <span class="badge-stock-zero">0 Pcs</span>
                  @elseif($brg->stok < 5)
                    <span class="badge-stock-low">{{ $brg->stok }} Pcs</span>
                  @else
                    <span class="fw-bold">{{ $brg->stok }} Pcs</span>
                  @endif
                </td>
                <td class="text-end num price text-muted">
                  Rp {{ $brg->formattedModal }}
                </td>
                <td class="text-end num price fw-bold" style="color: var(--ibk-brand-text);">
                  Rp {{ $brg->formattedJual }}
                </td>
                <td class="text-center">
                  <div class="form-check form-switch d-inline-flex justify-content-center m-0">
                    <input class="form-check-input toggle-material-switch" type="checkbox" role="switch" data-id="{{ $brg->id }}" {{ $brg->is_material_required ? 'checked' : '' }} title="Toggle kebutuhan material">
                  </div>
                </td>
                <td class="text-center">
                  <div class="dropdown">
                    <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                      <i class="las la-ellipsis-h fs-16"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end tokabe-action-menu">
                      <li>
                        <button type="button" class="dropdown-item btn-edit-barang"
                          data-id="{{ $brg->id }}"
                          data-kode="{{ $brg->kode_barang }}"
                          data-kategori="{{ $kategori[$brg->kategori_id] ?? '-' }}"
                          data-jenis="{{ $brg->jenis_barang }}"
                          data-stok="{{ $brg->stok }}"
                          data-modal="{{ $brg->harga_modal }}"
                          data-jual="{{ $brg->harga_jual }}"
                          data-action="{{ url('/update-stok/'.$brg->id) }}">
                          <i class="las la-pen fs-16" style="color: var(--ibk-brand);"></i>
                          <span>Update Stock</span>
                        </button>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li>
                        <button type="button" class="dropdown-item dropdown-item--danger hapus-btn remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $brg->id }}">
                          <i class="las la-trash-alt fs-16"></i>
                          <span>Delete</span>
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Table Footer -->
      <div class="ibk-table-footer">
        <div id="tokabeCustomInfo"></div>
        <div id="tokabeCustomPaginate"></div>
      </div>
    </div>

  </div>
</div>

{{-- MODAL POPUP: TAMBAH BARANG --}}
<div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-theme">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title fw-bold d-flex align-items-center gap-2 mb-1" id="tambahBarangModalLabel" style="color: var(--ibk-text);">
            <i class="las la-box-open fs-20" style="color: var(--ibk-brand);"></i>
            <span>Tambah Barang Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Isi data barang baru untuk katalog penjualan kasir dan inventori stok.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" id="formTambahBarangModal">
        @csrf
        <div class="tokabe-modal-body">
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Informasi Dasar Produk</span>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-kategori">
                Kategori Item <span class="text-danger">*</span>
              </label>
              <select name="kategori_id" id="modal-kategori" class="form-select form-select-modern" required>
                <option value="">Pilih Kategori</option>
                @foreach (($allKategori ?? $kategoriBrg) as $category)
                  <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                @endforeach
              </select>
              <p class="form-help-text">Kategori produk utama</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="modal-kode-barang">
                Kode Barang <span class="text-danger">*</span>
              </label>
              <input type="text" name="kode_barang" id="modal-kode-barang" class="form-control form-control-modern" placeholder="Misal: BRG-STM-01" required>
              <p class="form-help-text">Kode unik SKU produk</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="modal-jenis-barang">
                Jenis / Nama Barang <span class="text-danger">*</span>
              </label>
              <input type="text" name="jenis_barang" id="modal-jenis-barang" class="form-control form-control-modern" placeholder="Misal: Stempel Flash 43x55" required>
              <p class="form-help-text">Nama barang di invoice</p>
            </div>
          </div>

          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Stok & Skema Harga</span>
          </div>

          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-stok">
                Stok Awal <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-stok" required>
                <span class="input-group-addon-modern">Pcs</span>
              </div>
              <p class="form-help-text">Jumlah fisik awal di gudang</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="modal-harga-modal">
                Harga Modal (HPP) <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-harga-modal" required>
              </div>
              <p class="form-help-text">Harga pokok dari vendor</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="modal-harga-jual">
                Harga Jual <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_jual" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-harga-jual" required>
              </div>
              <p class="form-help-text">Tarif jual untuk kasir</p>
            </div>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="ibk-btn-primary">
            <i class="las la-plus-circle fs-16"></i>
            <span>Simpan Barang</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT / UPDATE BARANG --}}
<div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-theme">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title fw-bold d-flex align-items-center gap-2 mb-1" id="editBarangModalLabel" style="color: var(--ibk-text);">
            <i class="las la-pen-nib fs-20" style="color: var(--ibk-brand);"></i>
            <span>Update Stok Barang</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Perbarui kuantitas stok barang, varian jenis, atau penyesuaian harga jual dan modal.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data" id="formEditBarangModal">
        @csrf
        @method('put')
        <div class="tokabe-modal-body">
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Identitas Produk</span>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-kategori">Kategori Item</label>
              <input type="text" id="edit-barang-kategori" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kategori produk telah ditetapkan</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-kode">Kode Barang (SKU)</label>
              <input type="text" id="edit-barang-kode" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kode unik SKU barang di inventori</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-jenis">
                Jenis / Nama Barang <span class="text-danger">*</span>
              </label>
              <input type="text" name="jenis" id="edit-barang-jenis" class="form-control form-control-modern" placeholder="Jenis Barang" required>
              <p class="form-help-text">Nama barang pada nota kasir</p>
            </div>
          </div>

          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Kuantitas Stok & Harga</span>
          </div>

          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-stok">
                Stok Tersedia <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-barang-stok" required>
                <span class="input-group-addon-modern">Pcs</span>
              </div>
              <p class="form-help-text">Jumlah fisik stok terkini di toko/gudang</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-modal">
                Harga Modal (HPP) <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-barang-modal" required>
              </div>
              <p class="form-help-text">Harga pokok pembelian dari vendor</p>
            </div>

            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-jual">
                Harga Jual <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_jual" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-barang-jual" required>
              </div>
              <p class="form-help-text">Harga tarif jual standar kasir</p>
            </div>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="ibk-btn-primary">
            <i class="las la-save fs-16"></i>
            <span>Update Barang</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: KONFIRMASI HAPUS BARANG --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-theme">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="barang_delete_id" id="barang_id">
        <div class="modal-danger-icon-box">
          <i class="las la-trash-alt"></i>
        </div>
        <h4 class="mb-2 fw-bold" id="deleteModalLabel" style="color: var(--ibk-text);">Hapus Data Barang?</h4>
        <p class="text-muted fs-13 mb-4">
          Data barang ini akan dihapus secara permanen dari sistem inventori kasir. Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="hstack gap-2 justify-content-center">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
          <form id="deleteForm" action="/invoice/deleteBarang/" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-modal-delete">
              <i class="las la-trash-alt me-1"></i> Ya, Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/barang.js') }}"></script>

<script>
  // ==========================================
  // THEME SWITCHER (Light / Dark Mode Sync)
  // ==========================================
  function initPageTheme() {
      var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
      var icon = document.getElementById('theme-toggle-icon');
      var text = document.getElementById('theme-toggle-text');
      if (icon) {
          icon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
      }
      if (text) {
          text.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
      }
  }

  $(document).ready(function() {
      initPageTheme();
      $('#tambahBarangModal').appendTo('body');
      $('#editBarangModal').appendTo('body');
      $('#deleteModal').appendTo('body');
  });

  // Cleave.js mask untuk Modal Tambah Barang
  let modalCleaveStok, modalCleaveModal, modalCleaveJual;
  $('#tambahBarangModal').on('shown.bs.modal', function () {
      if (typeof Cleave !== 'undefined') {
          if (!modalCleaveStok && document.querySelector('#modal-stok')) {
              modalCleaveStok = new Cleave('#modal-stok', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!modalCleaveModal && document.querySelector('#modal-harga-modal')) {
              modalCleaveModal = new Cleave('#modal-harga-modal', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!modalCleaveJual && document.querySelector('#modal-harga-jual')) {
              modalCleaveJual = new Cleave('#modal-harga-jual', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
      setTimeout(function() {
          $('#modal-kategori').focus();
      }, 50);
  });

  $('#tambahBarangModal').on('hidden.bs.modal', function () {
      $('#formTambahBarangModal')[0].reset();
      if (modalCleaveStok) modalCleaveStok.setRawValue('0');
      if (modalCleaveModal) modalCleaveModal.setRawValue('0');
      if (modalCleaveJual) modalCleaveJual.setRawValue('0');
  });

  // Cleave.js mask untuk Modal Edit Barang
  let editCleaveBrgStok, editCleaveBrgModal, editCleaveBrgJual;
  function initEditBarangCleave() {
      if (typeof Cleave !== 'undefined') {
          if (!editCleaveBrgStok && document.querySelector('#edit-barang-stok')) {
              editCleaveBrgStok = new Cleave('#edit-barang-stok', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!editCleaveBrgModal && document.querySelector('#edit-barang-modal')) {
              editCleaveBrgModal = new Cleave('#edit-barang-modal', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!editCleaveBrgJual && document.querySelector('#edit-barang-jual')) {
              editCleaveBrgJual = new Cleave('#edit-barang-jual', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
  }

  $(document).on('click', '.btn-edit-barang', function() {
      initEditBarangCleave();

      const id = $(this).data('id');
      const kode = $(this).data('kode');
      const kategori = $(this).data('kategori');
      const jenis = $(this).data('jenis');
      const stok = $(this).data('stok');
      const modal = $(this).data('modal');
      const jual = $(this).data('jual');
      
      let action = $(this).data('action') || ("{{ url('/update-stok') }}/" + id);
      if (window.location.pathname.startsWith('/invoice') && !action.includes('/invoice')) {
          action = window.location.origin + '/invoice/update-stok/' + id;
      }

      $('#formEditBarangModal').attr('action', action);
      $('#edit-barang-kategori').val(kategori || '-');
      $('#edit-barang-kode').val(kode || '');
      $('#edit-barang-jenis').val(jenis || '');

      if (editCleaveBrgStok) {
          editCleaveBrgStok.setRawValue(String(stok !== undefined ? stok : 0));
      } else {
          $('#edit-barang-stok').val(stok || 0);
      }

      if (editCleaveBrgModal) {
          editCleaveBrgModal.setRawValue(String(modal !== undefined ? modal : 0));
      } else {
          $('#edit-barang-modal').val(modal || 0);
      }

      if (editCleaveBrgJual) {
          editCleaveBrgJual.setRawValue(String(jual !== undefined ? jual : 0));
      } else {
          $('#edit-barang-jual').val(jual || 0);
      }

      $('#editBarangModal').modal('show');
  });

  $('#editBarangModal').on('shown.bs.modal', function () {
      setTimeout(function() {
          $('#edit-barang-jenis').focus();
      }, 50);
  });

  // Toggle switch status material
  $(document).on('change', '.toggle-material-switch', function() {
      var barangId = $(this).data('id');
      var isRequired = $(this).is(':checked') ? 1 : 0;
      var $switch = $(this);

      var toggleUrl = "{{ route('barang.toggle_material', ':id') }}".replace(':id', barangId);
      if (window.location.pathname.startsWith('/invoice') && !toggleUrl.includes('/invoice')) {
          toggleUrl = window.location.origin + '/invoice/barang/toggle-material/' + barangId;
      }

      $.ajax({
          url: toggleUrl,
          type: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              is_material_required: isRequired
          },
          success: function(response) {
              if (response.status === 'success') {
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 2000,
                      timerProgressBar: true
                  });
                  Toast.fire({
                      icon: 'success',
                      title: response.message
                  });
              } else {
                  alert(response.message || 'Gagal memperbarui status material');
                  $switch.prop('checked', !isRequired);
              }
          },
          error: function(xhr) {
              var errorMsg = 'Gagal memperbarui status material';
              if (xhr.responseJSON && xhr.responseJSON.message) {
                  errorMsg += ': ' + xhr.responseJSON.message;
              }
              alert(errorMsg);
              $switch.prop('checked', !isRequired);
          }
      });
  });
</script>

<script>
// Helper to replace raw text with sleek LineAwesome icons identically to Invoice
function replaceCatalogPaginationIcons(wrapper) {
    var pag = wrapper.find('.dataTables_paginate');
    pag.find('.page-item.first .page-link, .paginate_button.first').each(function() {
        if (!$(this).find('i').length) $(this).html('<i class="las la-angle-double-left fs-15"></i>');
    });
    pag.find('.page-item.previous .page-link, .paginate_button.previous').each(function() {
        if (!$(this).find('i').length) $(this).html('<i class="las la-angle-left fs-15"></i>');
    });
    pag.find('.page-item.next .page-link, .paginate_button.next').each(function() {
        if (!$(this).find('i').length) $(this).html('<i class="las la-angle-right fs-15"></i>');
    });
    pag.find('.page-item.last .page-link, .paginate_button.last').each(function() {
        if (!$(this).find('i').length) $(this).html('<i class="las la-angle-double-right fs-15"></i>');
    });
}

// Sync DataTables pagination and info into dedicated .ibk-table-footer container
function syncCatalogPagination() {
    var wrapper = $('#alternative-pagination_wrapper');
    if (!wrapper.length) return;
    
    replaceCatalogPaginationIcons(wrapper);
    wrapper.find('.dataTables_filter input').attr('placeholder', 'Cari jenis atau kode barang...');

    var infoEl = wrapper.find('.dataTables_info');
    var paginateEl = wrapper.find('.dataTables_paginate');
    
    if (infoEl.length && $('#tokabeCustomInfo').length) {
        if ($('#tokabeCustomInfo').children().first()[0] !== infoEl[0]) {
            $('#tokabeCustomInfo').empty().append(infoEl);
        }
    }
    if (paginateEl.length && $('#tokabeCustomPaginate').length) {
        if ($('#tokabeCustomPaginate').children().first()[0] !== paginateEl[0]) {
            $('#tokabeCustomPaginate').empty().append(paginateEl);
        }
    }
    // Cleanly hide any empty bottom row in DataTables wrapper
    wrapper.children('.row:last-child').each(function() {
        if ($(this).find('.dataTables_info, .dataTables_paginate').length === 0) {
            $(this).hide();
        }
    });
}

$(document).ready(function() {
    syncCatalogPagination();
    setTimeout(syncCatalogPagination, 50);
    setTimeout(syncCatalogPagination, 150);
    setTimeout(syncCatalogPagination, 300);
    setTimeout(syncCatalogPagination, 600);
});

// Smooth page transition when changing pages (Identical to Invoice)
$(document).on('click', '.dataTables_paginate .page-link, .dataTables_paginate .paginate_button', function() {
    var $parent = $(this).closest('li.page-item');
    if ($parent.hasClass('disabled') || $parent.hasClass('active') || $(this).hasClass('disabled') || $(this).hasClass('current')) {
        return;
    }
    $('#alternative-pagination').addClass('dataTable-reloading');
});

$(document).on('draw.dt', '#alternative-pagination', function() {
    $('#alternative-pagination').removeClass('dataTable-reloading');
    syncCatalogPagination();
});
</script>

@endsection
