@extends('layout.template')

@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

<style>
/* ==========================================================================
   IBEKAMI INVOICE MANAGEMENT — WARM OBSIDIAN & GOLDEN AMBER GLASSMORPHISM
   Mode Gelap & Mode Terang via Design Tokens (CSS Variables)
   ========================================================================== */

:root {
    /* 1. Mode Gelap (Default) — Warm Obsidian & Golden Amber (Dashboard Matched) */
    --ibk-bg: #090807;
    --ibk-text: #FAFAFA;
    --ibk-text-muted: #A1A1AA;
    --ibk-text-dim: #71717A;
    --ibk-brand: #F59E0B;
    --ibk-brand-deep: #EA580C;
    --ibk-brand-gradient: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%);
    --ibk-brand-text: #FBBF24;
    --ibk-brand-btn-text: #FFFFFF;
    --ibk-brand-soft: rgba(245, 158, 11, 0.18);
    --ibk-brand-border: rgba(245, 158, 11, 0.45);
    --ibk-brand-glow: rgba(245, 158, 11, 0.35);
    --ibk-border-divider: rgba(255, 255, 255, 0.085);

    /* Status Tokens (Dark) */
    --ibk-status-lunas: #10B981;
    --ibk-status-lunas-bg: rgba(16, 185, 129, 0.15);
    --ibk-status-belum: #EF4444;
    --ibk-status-belum-bg: rgba(239, 68, 68, 0.15);
    --ibk-status-dp: #F59E0B;
    --ibk-status-dp-bg: rgba(245, 158, 11, 0.15);
    --ibk-status-batal: #71717A;
    --ibk-status-batal-bg: rgba(113, 113, 122, 0.15);

    /* Glass Surfaces (Dark) - Solid & Tactile */
    --ibk-glass-bg: #14110F;
    --ibk-glass-fallback: #14110F;
    --ibk-glass-border: 1px solid rgba(255, 255, 255, 0.08);
    --ibk-glass-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    --ibk-popover-bg: #181512;
    --ibk-input-bg: #120E0A;
}

body.theme-light, html[data-layout-mode="light"] {
    /* 2. Mode Terang — Sesuai Dashboard */
    --ibk-bg: #F8FAFC;
    --ibk-text: #0F172A;
    --ibk-text-muted: #64748B;
    --ibk-text-dim: #94A3B8;
    --ibk-brand: #EA580C;
    --ibk-brand-deep: #C2410C;
    --ibk-brand-gradient: #EA580C;
    --ibk-brand-text: #D97706;
    --ibk-brand-btn-text: #FFFFFF;
    --ibk-brand-soft: #FFFBEB;
    --ibk-brand-border: #FCD34D;
    --ibk-brand-glow: rgba(245, 158, 11, 0.25);
    --ibk-border-divider: #E2E8F0;

    /* Status Tokens (Light) */
    --ibk-status-lunas: #059669;
    --ibk-status-lunas-bg: #ECFDF5;
    --ibk-status-belum: #DC2626;
    --ibk-status-belum-bg: #FEF2F2;
    --ibk-status-dp: #D97706;
    --ibk-status-dp-bg: #FFFBEB;
    --ibk-status-batal: #64748B;
    --ibk-status-batal-bg: #F1F5F9;

    /* Surfaces (Light) */
    --ibk-glass-bg: #FFFFFF;
    --ibk-glass-fallback: #FFFFFF;
    --ibk-glass-border: 1px solid #E2E8F0;
    --ibk-glass-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    --ibk-popover-bg: #FFFFFF;
    --ibk-input-bg: #F8FAFC;
}

/* Base Layout & Typography */
body {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
}

html:not(.theme-light) body,
html.theme-dark body {
    background-color: var(--ibk-bg, #090807) !important;
    color: var(--ibk-text, #FAFAFA) !important;
}

html.theme-light body,
html[data-layout-mode="light"] body,
body.theme-light {
    background-color: #F8FAFC !important;
    color: #0F172A !important;
}

#layout-wrapper, .main-content, .page-content {
    background-color: transparent !important;
}

.num, .price, .numeric, .tokabe-num, .tokabe-num-bold {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
    font-family: 'JetBrains Mono', monospace;
}

/* Clean Container Layout */
.ibk-invoice-wrapper {
    position: relative;
    width: 100%;
    min-height: calc(100vh - 120px);
    padding-bottom: 85px !important;
    margin-bottom: 24px !important;
}

.ibk-content-layer {
    position: relative;
}

/* Surface Tokens - Solid and Tactile */
.ibk-glass {
    background: var(--ibk-glass-bg);
    border: var(--ibk-glass-border);
    box-shadow: var(--ibk-glass-shadow);
    border-radius: 14px;
    position: relative;
}

/* Page Header */
.ibk-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
}
.ibk-page-title-box h1 {
    font-size: 24px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    letter-spacing: -0.01em;
}
.ibk-page-subtitle {
    font-size: 13px;
    color: var(--ibk-text-muted);
    margin-top: 4px;
}

/* Timeframe Segmented Tabs */
.ibk-timeframe-group {
    display: inline-flex;
    align-items: center;
    background: #14110F;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 999px;
    padding: 3px;
    gap: 2px;
}
body.theme-light .ibk-timeframe-group {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
}
.ibk-timeframe-btn {
    border: 1px solid transparent !important;
    background: transparent !important;
    color: #A1A1AA !important;
    padding: 5px 13px !important;
    border-radius: 999px !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
}
.ibk-timeframe-btn:hover {
    color: #FFFFFF !important;
}
body.theme-light .ibk-timeframe-btn:hover {
    color: #0F172A !important;
}
.ibk-timeframe-btn.active {
    background: #EA580C !important;
    color: #FFFFFF !important;
    font-weight: 600 !important;
    border-color: #EA580C !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}

/* Main Action Buttons */
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
    transform: scale(0.98);
}

/* Theme Toggle Button (Identik Dashboard) */
.ref-theme-toggle, .ibk-theme-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    height: 38px;
    border-radius: 9999px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #FBBF24;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: transform 160ms ease, background-color 160ms ease, border-color 160ms ease, color 160ms ease, box-shadow 160ms ease;
    outline: none;
    user-select: none;
    text-decoration: none !important;
    white-space: nowrap;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
.ref-theme-toggle:hover, .ibk-theme-toggle:hover {
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.22);
    transform: translateY(-1px);
    color: #FDE047;
}
.ref-theme-toggle:active, .ibk-theme-toggle:active {
    transform: scale(0.97);
}
.ref-theme-toggle #theme-toggle-icon {
    display: inline-block;
    font-size: 15px;
    line-height: 1;
    transition: transform 380ms cubic-bezier(0.34, 1.56, 0.64, 1), opacity 200ms ease;
}
.ref-theme-toggle.theme-switching #theme-toggle-icon {
    transform: rotate(180deg) scale(0.65);
    opacity: 0.2;
}

/* ==========================================================================
   VIEW TRANSITION API — CIRCULAR REVEAL THEME TRANSITION (Identik Dashboard)
   ========================================================================== */
::view-transition-old(root),
::view-transition-new(root) {
    animation: none !important;
    mix-blend-mode: normal !important;
}

::view-transition-old(root) {
    z-index: 1 !important;
}
::view-transition-new(root) {
    z-index: 9999 !important;
}

/* Custom Filter Panel */
.ibk-custom-filter-card {
    margin-bottom: 24px;
    padding: 12px 18px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
}
.ibk-filter-submode {
    display: inline-flex;
    background: var(--ibk-input-bg);
    border: var(--ibk-glass-border);
    border-radius: 8px;
    padding: 2px;
}
.ibk-filter-submode-btn {
    border: none;
    background: transparent;
    color: var(--ibk-text-muted);
    font-size: 12px;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
}
.ibk-filter-submode-btn.active {
    background: var(--ibk-brand-soft);
    color: var(--ibk-brand-text);
    font-weight: 700;
}

/* ==========================================================================
   2. FIVE SUMMARY CARDS (GRID AUTO-FIT MINMAX 210PX)
   Top 3px Colored Border Lines & Lift Animation on Filter Selection
   ========================================================================== */
.ibk-summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}
.ibk-kpi-card {
    padding: 18px 20px;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 126px;
    transition: transform 300ms cubic-bezier(.2,.8,.2,1), box-shadow 300ms cubic-bezier(.2,.8,.2,1), border-color 300ms ease;
    cursor: pointer;
}
.ibk-kpi-card:hover {
    transform: translateY(-3px);
}
.ibk-kpi-card.is-active-filter {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.45), 0 0 0 2px var(--kpi-border-accent) !important;
}

/* 5 Semantic Top Border Colors */
.ibk-kpi-total {
    --kpi-border-accent: var(--ibk-brand);
    border-top: 3px solid var(--ibk-brand) !important;
}
.ibk-kpi-terbayar {
    --kpi-border-accent: var(--ibk-status-lunas);
    border-top: 3px solid var(--ibk-status-lunas) !important;
}
.ibk-kpi-belum-thn {
    --kpi-border-accent: var(--ibk-status-belum);
    border-top: 3px solid var(--ibk-status-belum) !important;
}
.ibk-kpi-belum-bln {
    --kpi-border-accent: var(--ibk-status-dp);
    border-top: 3px solid var(--ibk-status-dp) !important;
}
.ibk-kpi-batal {
    --kpi-border-accent: var(--ibk-status-batal);
    border-top: 3px solid var(--ibk-status-batal) !important;
}

.ibk-kpi-title {
    font-size: 12px;
    font-weight: 600;
    color: var(--ibk-text-muted);
    text-transform: capitalize;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.ibk-kpi-number {
    font-size: 22px;
    font-weight: 700;
    color: var(--ibk-text);
    margin: 8px 0 4px 0;
    letter-spacing: -0.01em;
}
.ibk-kpi-footer {
    font-size: 11.5px;
    color: var(--ibk-text-dim);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ==========================================================================
   3. TABLE CONTAINER & SINGLE-LINE TOOLBAR
   ========================================================================== */
.ibk-table-card {
    padding: 0;
    overflow: visible;
    margin-bottom: 30px !important;
}
.ibk-table-header {
    padding: 20px 24px 16px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    border-bottom: 1px solid var(--ibk-border-divider);
}
.ibk-table-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--ibk-text);
    margin: 0;
}
.ibk-table-subtitle {
    font-size: 12.5px;
    color: var(--ibk-text-muted);
    margin-top: 2px;
}

/* Single-Line Filter Toolbar */
.ibk-toolbar {
    padding: 14px 24px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    border-bottom: 1px solid var(--ibk-border-divider);
}

/* Left: Search Input with Icon */
.ibk-search-box {
    position: relative;
    min-width: 260px;
    max-width: 340px;
    flex: 1;
}
.ibk-search-box svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ibk-text-muted);
    pointer-events: none;
    transition: color 0.15s ease;
}
.ibk-search-input {
    width: 100%;
    background: var(--ibk-input-bg) !important;
    border: var(--ibk-glass-border) !important;
    color: var(--ibk-text) !important;
    font-size: 13px !important;
    padding: 9px 14px 9px 40px !important;
    border-radius: 10px !important;
    transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease;
    outline: none !important;
}
.ibk-search-input:focus {
    border-color: var(--ibk-brand) !important;
    box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
}
.ibk-search-box:focus-within svg {
    color: var(--ibk-brand);
}

/* Center: Segmented Status Tabs */
.ibk-status-segmented {
    display: inline-flex;
    align-items: center;
    background: var(--ibk-input-bg);
    border: var(--ibk-glass-border);
    border-radius: 10px;
    padding: 3px;
    gap: 3px;
}
.ibk-status-tab {
    border: 1px solid transparent;
    background: transparent;
    color: var(--ibk-text-muted);
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 12.5px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease;
    white-space: nowrap;
}
.ibk-status-tab .ibk-tab-count {
    font-size: 11px;
    color: var(--ibk-text-dim);
    font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
}
.ibk-status-tab:hover {
    color: var(--ibk-text);
}
.ibk-status-tab.active {
    background: var(--ibk-brand-soft);
    border-color: var(--ibk-brand-border);
    color: var(--ibk-brand-text);
    font-weight: 700;
}
.ibk-status-tab.active .ibk-tab-count {
    color: var(--ibk-brand-text);
}

/* Right: Tools & Popover */
.ibk-toolbar-tools {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ibk-tool-btn {
    background: var(--ibk-input-bg);
    border: var(--ibk-glass-border);
    color: var(--ibk-text-muted);
    border-radius: 10px;
    padding: 8px 14px;
    font-size: 12.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
}
.ibk-tool-btn:hover {
    color: var(--ibk-text);
    background: var(--ibk-brand-soft);
}
.ibk-tool-btn:active {
    transform: scale(0.95);
}
.ibk-tool-badge {
    background: var(--ibk-brand);
    color: var(--ibk-brand-btn-text);
    font-size: 10px;
    font-weight: 800;
    padding: 1px 6px;
    border-radius: 999px;
}

/* Advanced Filter Popover */
.ibk-filter-popover {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 360px;
    max-width: 90vw;
    background: var(--ibk-popover-bg);
    border: var(--ibk-glass-border);
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.45);
    z-index: 9999 !important;
    display: none;
    transform-origin: top right;
    animation: ibkPopIn 190ms cubic-bezier(.2,.8,.2,1);
    pointer-events: auto !important;
}
.ibk-filter-popover.show {
    display: block;
}

.ibk-chip-group {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 6px;
    margin-bottom: 14px;
}
.ibk-chip {
    background: var(--ibk-input-bg);
    border: var(--ibk-glass-border);
    color: var(--ibk-text-muted);
    font-size: 11.5px;
    padding: 5px 12px;
    border-radius: 999px;
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
    display: inline-flex;
    align-items: center;
}
.ibk-chip:hover {
    color: var(--ibk-text);
    border-color: var(--ibk-brand);
}
.ibk-chip.active {
    background: rgba(245, 158, 11, 0.2) !important;
    border-color: #F59E0B !important;
    color: #FBBF24 !important;
    font-weight: 700 !important;
}
body.theme-light .ibk-chip {
    background: #F1F5F9;
    border: 1px solid #CBD5E1;
    color: #475569;
}
body.theme-light .ibk-chip:hover {
    background: #E2E8F0;
    color: #1E293B;
}
body.theme-light .ibk-chip.active {
    background: #FFF7ED !important;
    border-color: #EA580C !important;
    color: #EA580C !important;
    font-weight: 700 !important;
}

.ibk-popover-select {
    width: 100%;
    background: var(--ibk-input-bg) !important;
    border: var(--ibk-glass-border) !important;
    color: var(--ibk-text) !important;
    font-size: 12px !important;
    padding: 7px 12px !important;
    border-radius: 8px !important;
    outline: none !important;
    cursor: pointer;
    margin-bottom: 12px;
    transition: border-color 0.15s ease;
}
.ibk-popover-select:focus {
    border-color: var(--ibk-brand) !important;
}
body.theme-light .ibk-popover-select {
    background: #FFFFFF !important;
    border: 1px solid #CBD5E1 !important;
    color: #1E293B !important;
}

/* ==========================================================================
   4. DATA TABLE STYLING
   Monospace Invoice ID, Status Pill, Smooth Row Details Expand
   ========================================================================== */
.ibk-table-wrap {
    overflow-x: auto;
    width: 100%;
    -webkit-overflow-scrolling: touch;
    min-height: auto;
}
table.tokabe-invoice-table {
    width: 100% !important;
    min-width: 1750px !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
    background: transparent !important;
}
table.tokabe-invoice-table thead th {
    background: transparent !important;
    color: var(--ibk-text-muted) !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    letter-spacing: normal !important;
    text-transform: none !important;
    padding: 12px 16px !important;
    border-bottom: 1px solid var(--ibk-border-divider) !important;
    white-space: nowrap;
}

/* Explicit Column Widths (Pelanggan, Telepon, Tanggal, Total, Admin dilebarkan) */
.tokabe-col-no, .tokabe-th-no {
    width: 50px !important;
    min-width: 50px !important;
    text-align: center !important;
}
.tokabe-th-inv, .tokabe-col-invoice {
    width: 130px !important;
    min-width: 130px !important;
    white-space: nowrap !important;
}
.tokabe-th-pelanggan, .tokabe-col-pelanggan {
    width: 260px !important;
    min-width: 260px !important;
}
.tokabe-customer-wrap {
    min-width: 240px;
}
.tokabe-th-telepon, .tokabe-col-telepon {
    width: 170px !important;
    min-width: 170px !important;
    white-space: nowrap !important;
}
.tokabe-th-tgl, .tokabe-col-tgl {
    width: 160px !important;
    min-width: 160px !important;
    white-space: nowrap !important;
}
.tokabe-th-status, .tokabe-col-status {
    width: 130px !important;
    min-width: 130px !important;
    text-align: center !important;
    white-space: nowrap !important;
}
.tokabe-th-approval, .tokabe-col-approval {
    width: 110px !important;
    min-width: 110px !important;
    text-align: center !important;
    white-space: nowrap !important;
}
.tokabe-th-deskripsi, .tokabe-col-deskripsi {
    width: 220px !important;
    min-width: 220px !important;
}
.tokabe-th-material, .tokabe-col-material {
    width: 180px !important;
    min-width: 180px !important;
}
.tokabe-th-alasan, .tokabe-col-alasan {
    width: 150px !important;
    min-width: 150px !important;
}
.tokabe-th-panjar, .tokabe-col-panjar {
    width: 140px !important;
    min-width: 140px !important;
    text-align: right !important;
    white-space: nowrap !important;
}
.tokabe-th-total, .tokabe-col-total {
    width: 180px !important;
    min-width: 180px !important;
    text-align: right !important;
    white-space: nowrap !important;
}
.tokabe-th-pembayaran, .tokabe-col-pembayaran {
    width: 145px !important;
    min-width: 145px !important;
    text-align: center !important;
    white-space: nowrap !important;
}
.tokabe-th-orderby, .tokabe-col-orderby {
    width: 140px !important;
    min-width: 140px !important;
    white-space: nowrap !important;
}
.tokabe-th-admin, .tokabe-col-admin {
    width: 160px !important;
    min-width: 160px !important;
    white-space: nowrap !important;
}
.tokabe-th-aksi, .tokabe-col-aksi {
    width: 60px !important;
    min-width: 60px !important;
    text-align: center !important;
}
table.tokabe-invoice-table thead th.active-sort {
    color: var(--ibk-brand) !important;
}

table.tokabe-invoice-table tbody tr {
    background: transparent !important;
    transition: background-color 0.15s ease;
    border-bottom: 1px solid var(--ibk-border-divider) !important;
    cursor: pointer;
}
table.tokabe-invoice-table tbody tr:hover {
    background: rgba(249, 115, 22, 0.035) !important;
}
table.tokabe-invoice-table tbody tr.expanded {
    border-left: 3px solid var(--ibk-brand) !important;
    background: rgba(249, 115, 22, 0.045) !important;
}

table.tokabe-invoice-table tbody td {
    padding: 13px 16px !important;
    border-bottom: 1px solid var(--ibk-border-divider) !important;
    color: var(--ibk-text) !important;
    font-size: 13px !important;
    vertical-align: middle !important;
    background: transparent !important;
}

/* Stagger Row Entry Animation (No persistent transform to avoid stacking context traps) */
.tokabe-invoice-table tbody tr {
    position: relative;
    animation: ibkRowEntry 350ms cubic-bezier(.2,.8,.2,1);
}
@keyframes ibkRowEntry {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: none;
    }
}

/* Elevate the active row and cell above all subsequent rows so dropdown is NEVER overlapped / tertimpa */
table.tokabe-invoice-table tbody tr.tokabe-dropdown-open,
table.tokabe-invoice-table tbody tr:has(.show),
table.tokabe-invoice-table tbody tr:has([aria-expanded="true"]) {
    position: relative !important;
    z-index: 99999 !important;
}
table.tokabe-invoice-table tbody td.tokabe-dropdown-open,
table.tokabe-invoice-table tbody td:has(.show),
table.tokabe-invoice-table tbody td:has([aria-expanded="true"]) {
    position: relative !important;
    z-index: 99999 !important;
}

/* Smooth, Non-blinking Table Transitions */
.ibk-table-wrap {
    position: relative;
}
#scroll-horizontal tbody {
    transition: opacity 0.18s cubic-bezier(0.16, 1, 0.3, 1);
}
#scroll-horizontal.dataTable-reloading tbody {
    opacity: 0.35 !important;
    pointer-events: none;
}

/* Hide default intrusive DataTables processing popup (Handled smoothly via CSS opacity) */
div.dataTables_processing {
    display: none !important;
}

/* Col 1: Invoice ID & Chevron */
.tokabe-col-inv {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.tokabe-row-toggle {
    background: transparent;
    border: none;
    color: var(--ibk-text-muted);
    width: 22px;
    height: 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    cursor: pointer;
    transition: transform 250ms cubic-bezier(.2,.8,.2,1), color 0.15s ease;
}
.tokabe-row-toggle:hover {
    color: var(--ibk-brand);
}
.tokabe-row-toggle.active {
    transform: rotate(90deg);
    color: var(--ibk-brand);
}
.tokabe-inv-code {
    font-family: 'JetBrains Mono', monospace;
    font-weight: 700;
    color: var(--ibk-text);
    letter-spacing: -0.01em;
}

/* Col 2: Pelanggan */
.tokabe-customer-name {
    font-weight: 700;
    color: var(--ibk-text);
    display: block;
    line-height: 1.25;
}
.tokabe-customer-sub {
    font-size: 11.5px;
    color: var(--ibk-text-muted);
    margin-top: 2px;
}

/* Col 3: Telepon */
.tokabe-phone {
    font-family: 'JetBrains Mono', monospace;
    font-size: 12px;
    color: var(--ibk-text-muted);
}
.tokabe-phone-empty {
    color: var(--ibk-text-dim);
}

/* Col 4: Tanggal */
.tokabe-date-main {
    font-weight: 600;
    color: var(--ibk-text);
    font-size: 12.5px;
}
.tokabe-date-sub {
    font-size: 10.5px;
    color: var(--ibk-text-dim);
}

/* Status Pills (With dot) */
.tokabe-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.02em;
    white-space: nowrap;
}
.tokabe-pill-dot {
    font-size: 8px;
    line-height: 1;
}

.tokabe-pill-lunas {
    background: var(--ibk-status-lunas-bg) !important;
    color: var(--ibk-status-lunas) !important;
    border: 1px solid rgba(52, 211, 153, 0.25);
}
.tokabe-pill-belum {
    background: var(--ibk-status-belum-bg) !important;
    color: var(--ibk-status-belum) !important;
    border: 1px solid rgba(248, 113, 113, 0.25);
}
.tokabe-pill-dp {
    background: var(--ibk-status-dp-bg) !important;
    color: var(--ibk-status-dp) !important;
    border: 1px solid rgba(251, 191, 36, 0.25);
}
.tokabe-pill-batal {
    background: var(--ibk-status-batal-bg) !important;
    color: var(--ibk-status-batal) !important;
    border: 1px solid rgba(181, 172, 159, 0.25);
}

.tokabe-pill-lock, .tokabe-pill-unlock, .tokabe-pill-orderby {
    background: var(--ibk-input-bg) !important;
    color: var(--ibk-text-muted) !important;
    border: var(--ibk-glass-border) !important;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 500;
}

/* Col 7: Deskripsi Single-line Ellipsis */
.tokabe-desc-wrap {
    max-width: 240px;
}
.tokabe-desc-item {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 12px;
    color: var(--ibk-text-muted);
}
.tokabe-desc-more, .tokabe-desc-less {
    font-size: 11px;
    color: var(--ibk-brand-text);
    font-weight: 600;
    cursor: pointer;
    margin-top: 3px;
    display: inline-block;
}

/* Action 3-dots Menu Button */
.btn-tokabe-action-dots {
    width: 32px !important;
    height: 32px !important;
    min-width: 32px !important;
    min-height: 32px !important;
    padding: 0 !important;
    margin: 0 auto !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 8px !important;
    line-height: 1 !important;
    text-align: center !important;
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    color: #F5EFE6 !important; /* Terang & jelas terlihat di dark mode */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
    transition: all 0.15s cubic-bezier(.2,.8,.2,1) !important;
    cursor: pointer !important;
}
.btn-tokabe-action-dots i {
    font-size: 18px !important;
    line-height: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 18px !important;
    height: 18px !important;
    color: inherit !important;
    pointer-events: none !important;
}
.btn-tokabe-action-dots:hover,
.btn-tokabe-action-dots:focus,
.btn-tokabe-action-dots[aria-expanded="true"] {
    background: rgba(245, 158, 11, 0.22) !important;
    border-color: rgba(245, 158, 11, 0.5) !important;
    color: #F59E0B !important;
    box-shadow: 0 0 12px rgba(245, 158, 11, 0.3) !important;
    transform: scale(1.05);
}

.tokabe-action-dropdown {
    position: relative;
    display: inline-flex;
    justify-content: center;
}
.tokabe-action-dropdown.show {
    z-index: 99999 !important;
}

/* Action Dropdown Menu Popover */
.tokabe-action-menu {
    background: #181411 !important; /* Solid opaque obsidian - prevents underlying table text bleed */
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    border-radius: 12px !important;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.06) !important;
    padding: 8px 6px !important;
    min-width: 220px !important;
    z-index: 99999 !important;
    animation: ibkPopIn 180ms cubic-bezier(.2,.8,.2,1);
}
.tokabe-action-menu .dropdown-item {
    color: #F5EFE6 !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    padding: 8px 14px !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    transition: all 0.15s ease !important;
    line-height: 1.4 !important;
    text-align: left !important;
    white-space: nowrap !important;
}
.tokabe-action-menu .dropdown-item i {
    font-size: 16px !important;
    width: 20px !important;
    text-align: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #A1A1AA !important;
    transition: color 0.15s ease !important;
    flex-shrink: 0 !important;
    margin: 0 !important;
}
.tokabe-action-menu .dropdown-item:hover {
    background: rgba(245, 158, 11, 0.16) !important;
    color: #F59E0B !important;
}
.tokabe-action-menu .dropdown-item:hover i {
    color: #F59E0B !important;
}
.tokabe-action-menu .dropdown-item.active {
    background: rgba(245, 158, 11, 0.22) !important;
    color: #FBBF24 !important;
    font-weight: 700 !important;
}
.tokabe-action-menu .dropdown-item.active i {
    color: #FBBF24 !important;
}
.tokabe-action-menu .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.08) !important;
    margin: 6px 4px !important;
    opacity: 1 !important;
}
.tokabe-action-menu .dropdown-item-cetak-asli,
.tokabe-action-menu .dropdown-item-cetak-asli i {
    color: #FB923C !important;
}
.tokabe-action-menu .dropdown-item-cetak-asli:hover,
.tokabe-action-menu .dropdown-item-cetak-asli:hover i {
    background: rgba(251, 146, 60, 0.14) !important;
    color: #FDBA74 !important;
}
.tokabe-action-menu .dropdown-item-cetak-copy,
.tokabe-action-menu .dropdown-item-cetak-copy i {
    color: #A8A29E !important;
}
.tokabe-action-menu .dropdown-item-cetak-copy:hover,
.tokabe-action-menu .dropdown-item-cetak-copy:hover i {
    background: rgba(168, 162, 158, 0.14) !important;
    color: #E7E5E4 !important;
}
.tokabe-action-menu .dropdown-item-download,
.tokabe-action-menu .dropdown-item-download i {
    color: #60A5FA !important;
}
.tokabe-action-menu .dropdown-item-download:hover,
.tokabe-action-menu .dropdown-item-download:hover i {
    background: rgba(96, 165, 250, 0.14) !important;
    color: #93C5FD !important;
}
.tokabe-action-menu .dropdown-item-wa,
.tokabe-action-menu .dropdown-item-wa i {
    color: #4ADE80 !important;
}
.tokabe-action-menu .dropdown-item-wa:hover,
.tokabe-action-menu .dropdown-item-wa:hover i {
    background: rgba(74, 222, 128, 0.14) !important;
    color: #86EFAC !important;
}
.tokabe-action-menu .dropdown-item-unlock,
.tokabe-action-menu .dropdown-item-unlock i {
    color: #A78BFA !important;
}
.tokabe-action-menu .dropdown-item-unlock:hover,
.tokabe-action-menu .dropdown-item-unlock:hover i {
    background: rgba(167, 139, 250, 0.14) !important;
    color: #C4B5FD !important;
}
.tokabe-action-menu .dropdown-item-spk,
.tokabe-action-menu .dropdown-item-spk i {
    color: #2DD4BF !important;
}
.tokabe-action-menu .dropdown-item-spk:hover,
.tokabe-action-menu .dropdown-item-spk:hover i {
    background: rgba(45, 212, 191, 0.14) !important;
    color: #5EEAD4 !important;
}
.tokabe-action-menu .dropdown-item-lunas,
.tokabe-action-menu .dropdown-item-lunas i {
    color: #34D399 !important;
}
.tokabe-action-menu .dropdown-item-lunas:hover,
.tokabe-action-menu .dropdown-item-lunas:hover i {
    background: rgba(52, 211, 153, 0.14) !important;
    color: #6EE7B7 !important;
}
.tokabe-action-menu .dropdown-item-batal {
    color: #FBBF24 !important;
}
.tokabe-action-menu .dropdown-item-batal i {
    color: #FBBF24 !important;
}
.tokabe-action-menu .dropdown-item-batal:hover {
    background: rgba(251, 191, 36, 0.15) !important;
    color: #FCD34D !important;
}
.tokabe-action-menu .dropdown-item-batal:hover i {
    color: #FCD34D !important;
}
.tokabe-action-menu .dropdown-item-hapus {
    color: #F87171 !important;
}
.tokabe-action-menu .dropdown-item-hapus i {
    color: #F87171 !important;
}
.tokabe-action-menu .dropdown-item-hapus:hover {
    background: rgba(239, 68, 68, 0.15) !important;
    color: #EF4444 !important;
}
.tokabe-action-menu .dropdown-item-hapus:hover i {
    color: #EF4444 !important;
}

/* Table Footer & Pagination */
.ibk-table-footer {
    padding: 16px 24px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    border-top: 1px solid var(--ibk-border-divider) !important;
    position: relative !important;
    z-index: 5 !important;
    min-height: 64px !important;
    box-sizing: border-box !important;
}
#tokabeCustomInfo {
    display: flex !important;
    align-items: center !important;
    min-height: 38px !important;
}
#tokabeCustomPaginate {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    margin-left: auto !important;
}
.dataTables_info {
    color: var(--ibk-text-muted) !important;
    font-size: 13px !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
}
.dataTables_paginate {
    display: inline-flex !important;
    align-items: center !important;
    padding: 0 !important;
    margin: 0 !important;
}
.dataTables_paginate ul.pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 4px 6px !important;
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 14px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 4px 14px rgba(0, 0, 0, 0.25) !important;
}
.dataTables_paginate li.page-item {
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    display: inline-flex !important;
}
.dataTables_paginate .page-link,
.dataTables_paginate .paginate_button {
    min-width: 36px !important;
    height: 36px !important;
    padding: 0 10px !important;
    margin: 0 !important;
    border-radius: 10px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 13px !important;
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
    transition: all 0.2s cubic-bezier(.2,.8,.2,1) !important;
    user-select: none !important;
}
.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
.dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
    background: rgba(249, 115, 22, 0.14) !important;
    border-color: rgba(249, 115, 22, 0.35) !important;
    color: #FB923C !important;
    transform: translateY(-2px) scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2) !important;
}
.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:active,
.dataTables_paginate .paginate_button:not(.current):not(.disabled):active {
    transform: scale(0.94) !important;
}
.dataTables_paginate li.page-item.active .page-link,
.dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
    color: #1A0F05 !important;
    font-weight: 700 !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0 4px 16px rgba(249, 115, 22, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.35) !important;
    transform: translateY(-1px) scale(1.06) !important;
    animation: ibkPageActivePop 260ms cubic-bezier(.2,.8,.2,1) !important;
    z-index: 2 !important;
}
@keyframes ibkPageActivePop {
    0% { transform: scale(0.88); opacity: 0.7; }
    60% { transform: scale(1.1); }
    100% { transform: translateY(-1px) scale(1.06); opacity: 1; }
}
.dataTables_paginate li.page-item.previous .page-link,
.dataTables_paginate li.page-item.next .page-link,
.dataTables_paginate .paginate_button.previous,
.dataTables_paginate .paginate_button.next {
    font-size: 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    background: rgba(255, 255, 255, 0.04) !important;
}
.dataTables_paginate li.page-item.disabled .page-link,
.dataTables_paginate .paginate_button.disabled {
    opacity: 0.3 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #71717A !important;
    box-shadow: none !important;
    transform: none !important;
}

/* Glass Toast Notification */
.ibk-toast-container {
    position: fixed;
    top: 24px;
    right: 24px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    pointer-events: none;
}
.ibk-toast {
    pointer-events: auto;
    min-width: 280px;
    max-width: 380px;
    background: var(--ibk-popover-bg);
    border: var(--ibk-glass-border);
    border-left: 4px solid var(--ibk-brand);
    color: var(--ibk-text);
    padding: 12px 16px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    font-size: 13px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: ibkToastIn 300ms cubic-bezier(.2,.8,.2,1);
}
@keyframes ibkToastIn {
    from {
        opacity: 0;
        transform: translateY(-14px) scale(0.96);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
@keyframes ibkPopIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-6px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Empty State */
.ibk-empty-state {
    padding: 48px 24px;
    text-align: center;
}
.ibk-empty-icon {
    font-size: 42px;
    color: var(--ibk-text-dim);
    margin-bottom: 8px;
}
.ibk-empty-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--ibk-text);
    margin: 0;
}
.ibk-empty-sub {
    font-size: 13px;
    color: var(--ibk-text-muted);
    margin-top: 4px;
}



/* ==========================================================================
   THEME LIGHT EXPLICIT OVERRIDES (Matched to Dashboard welcome.blade.php)
   ========================================================================== */
body.theme-light {
    color: #1E293B !important;
}

body.theme-light .ibk-header h1 {
    color: #0F172A !important;
}
body.theme-light .ibk-page-subtitle {
    color: #64748B !important;
}

/* Timeframe Group (Light) */
body.theme-light .ibk-timeframe-group {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .ibk-timeframe-btn {
    color: #64748B !important;
}
body.theme-light .ibk-timeframe-btn:hover {
    color: #0F172A !important;
    background: rgba(255, 255, 255, 0.6) !important;
}
body.theme-light .ibk-timeframe-btn.active {
    background: #FFFFFF !important;
    color: #D97706 !important;
    border: 1px solid #FCD34D !important;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.16) !important;
}

/* Primary Button (Light) */
body.theme-light .ibk-btn-primary { background: #EA580C !important; border-color: #EA580C !important; color: #FFFFFF !important; box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important; }

/* Theme Toggle (Light) */
body.theme-light .ref-theme-toggle,
body.theme-light .ibk-theme-toggle {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    color: #1E293B !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06) !important;
}
body.theme-light .ref-theme-toggle:hover,
body.theme-light .ibk-theme-toggle:hover {
    background: #F8FAFC !important;
    color: #0F172A !important;
    border-color: #CBD5E1 !important;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08) !important;
}
body.theme-light .ref-theme-toggle #theme-toggle-icon,
body.theme-light .ibk-theme-toggle #theme-toggle-icon {
    color: #1E293B !important;
}

/* Custom Filter Card (Light) */
body.theme-light .ibk-custom-filter-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 4px 18px -4px rgba(15, 23, 42, 0.06) !important;
}
body.theme-light .ibk-filter-submode {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .ibk-filter-submode-btn {
    color: #64748B !important;
}
body.theme-light .ibk-filter-submode-btn:hover {
    color: #0F172A !important;
}
body.theme-light .ibk-filter-submode-btn.active {
    background: #FFFFFF !important;
    color: #D97706 !important;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06) !important;
}

/* Summary Cards (Light) */
body.theme-light .ibk-kpi-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.03) !important;
}
body.theme-light .ibk-kpi-card:hover {
    border-color: #CBD5E1 !important;
    box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.09) !important;
}
body.theme-light .ibk-kpi-card.is-active-filter {
    box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.12), 0 0 0 2px var(--kpi-border-accent) !important;
}
body.theme-light .ibk-kpi-title {
    color: #64748B !important;
}
body.theme-light .ibk-kpi-number {
    color: #0F172A !important;
}
body.theme-light .ibk-kpi-footer {
    color: #94A3B8 !important;
}

/* Main Table Glass Card (Light) */
body.theme-light .ibk-table-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 4px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 8px -2px rgba(15, 23, 42, 0.04) !important;
}
body.theme-light .ibk-table-header {
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .ibk-table-title {
    color: #0F172A !important;
}
body.theme-light .ibk-table-subtitle {
    color: #64748B !important;
}
body.theme-light .ibk-toolbar {
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .ibk-table-footer {
    border-top: 1px solid #E2E8F0 !important;
}

/* Search Box & Inputs (Light) */
body.theme-light .ibk-search-input {
    background: #F8FAFC !important;
    border: 1px solid #CBD5E1 !important;
    color: #0F172A !important;
}
body.theme-light .ibk-search-input:focus {
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
}
body.theme-light .ibk-search-box svg {
    color: #64748B !important;
}
body.theme-light .ibk-search-box:focus-within svg {
    color: #EA580C !important;
}

/* Status Segmented Tabs (Light) */
body.theme-light .ibk-status-segmented {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .ibk-status-tab {
    color: #64748B !important;
}
body.theme-light .ibk-status-tab:hover {
    color: #0F172A !important;
    background: rgba(255, 255, 255, 0.6) !important;
}
body.theme-light .ibk-status-tab.active {
    background: #FFFFFF !important;
    color: #D97706 !important;
    border: 1px solid #FCD34D !important;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.16) !important;
}
body.theme-light .ibk-status-tab.active .ibk-tab-count {
    color: #D97706 !important;
}

/* Tool Buttons (Light) */
body.theme-light .ibk-tool-btn {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
}
body.theme-light .ibk-tool-btn:hover {
    background: #F1F5F9 !important;
    color: #0F172A !important;
    border-color: #CBD5E1 !important;
}

/* Advanced Filter Popover (Light) */
body.theme-light .ibk-filter-popover {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12) !important;
    color: #0F172A !important;
}
body.theme-light .ibk-chip {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
    color: #64748B !important;
}
body.theme-light .ibk-chip:hover {
    color: #0F172A !important;
    background: #E2E8F0 !important;
}
body.theme-light .ibk-chip.active {
    background: #FFFBEB !important;
    border-color: #FCD34D !important;
    color: #D97706 !important;
}

/* Action Dropdown Menu (Light) */
body.theme-light .tokabe-action-menu {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 16px 45px rgba(15, 23, 42, 0.18), 0 0 0 1px rgba(0, 0, 0, 0.04) !important;
}
body.theme-light .tokabe-action-menu .dropdown-item {
    color: #334155 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item i {
    color: #64748B !important;
}
body.theme-light .tokabe-action-menu .dropdown-item:hover {
    background: #FFF7ED !important;
    color: #EA580C !important;
}
body.theme-light .tokabe-action-menu .dropdown-item:hover i {
    color: #EA580C !important;
}
body.theme-light .tokabe-action-menu .dropdown-item.active {
    background: #FFF7ED !important;
    color: #EA580C !important;
    font-weight: 700 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item.active i {
    color: #EA580C !important;
}
body.theme-light .tokabe-action-menu .dropdown-divider {
    border-color: #E2E8F0 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-cetak-asli,
body.theme-light .tokabe-action-menu .dropdown-item-cetak-asli i {
    color: #EA580C !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-cetak-asli:hover,
body.theme-light .tokabe-action-menu .dropdown-item-cetak-asli:hover i {
    background: #FFF7ED !important;
    color: #C2410C !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-cetak-copy,
body.theme-light .tokabe-action-menu .dropdown-item-cetak-copy i {
    color: #475569 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-cetak-copy:hover,
body.theme-light .tokabe-action-menu .dropdown-item-cetak-copy:hover i {
    background: #F1F5F9 !important;
    color: #1E293B !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-download,
body.theme-light .tokabe-action-menu .dropdown-item-download i {
    color: #2563EB !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-download:hover,
body.theme-light .tokabe-action-menu .dropdown-item-download:hover i {
    background: #EFF6FF !important;
    color: #1D4ED8 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-wa,
body.theme-light .tokabe-action-menu .dropdown-item-wa i {
    color: #16A34A !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-wa:hover,
body.theme-light .tokabe-action-menu .dropdown-item-wa:hover i {
    background: #F0FDF4 !important;
    color: #15803D !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-unlock,
body.theme-light .tokabe-action-menu .dropdown-item-unlock i {
    color: #7C3AED !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-unlock:hover,
body.theme-light .tokabe-action-menu .dropdown-item-unlock:hover i {
    background: #F5F3FF !important;
    color: #6D28D9 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-spk,
body.theme-light .tokabe-action-menu .dropdown-item-spk i {
    color: #0D9488 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-spk:hover,
body.theme-light .tokabe-action-menu .dropdown-item-spk:hover i {
    background: #F0FDFA !important;
    color: #0F766E !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-lunas,
body.theme-light .tokabe-action-menu .dropdown-item-lunas i {
    color: #059669 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-lunas:hover,
body.theme-light .tokabe-action-menu .dropdown-item-lunas:hover i {
    background: #ECFDF5 !important;
    color: #047857 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-batal {
    color: #D97706 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-batal i {
    color: #D97706 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-batal:hover {
    background: #FEF3C7 !important;
    color: #B45309 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-batal:hover i {
    color: #B45309 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-hapus {
    color: #DC2626 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-hapus i {
    color: #DC2626 !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-hapus:hover {
    background: #FEE2E2 !important;
    color: #B91C1C !important;
}
body.theme-light .tokabe-action-menu .dropdown-item-hapus:hover i {
    color: #B91C1C !important;
}

/* Table Rows & Cells (Light) */
body.theme-light table.tokabe-invoice-table thead th {
    background: #F8FAFC !important;
    color: #64748B !important;
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light table.tokabe-invoice-table tbody tr {
    border-bottom: 1px solid #F1F5F9 !important;
}
body.theme-light table.tokabe-invoice-table tbody tr:hover {
    background: #F8FAFC !important;
}
body.theme-light table.tokabe-invoice-table tbody tr.expanded {
    background: #FFFBEB !important;
    border-left: 3px solid #EA580C !important;
}
body.theme-light table.tokabe-invoice-table tbody td {
    border-bottom: 1px solid #F1F5F9 !important;
    color: #334155 !important;
}
body.theme-light .tokabe-customer-name,
body.theme-light .tokabe-inv-code,
body.theme-light .tokabe-date-main {
    color: #0F172A !important;
}
body.theme-light .tokabe-customer-sub,
body.theme-light .tokabe-phone,
body.theme-light .tokabe-date-sub,
body.theme-light .tokabe-desc-item {
    color: #64748B !important;
}
body.theme-light .tokabe-row-toggle {
    color: #94A3B8 !important;
}
body.theme-light .tokabe-row-toggle:hover,
body.theme-light .tokabe-row-toggle.active {
    color: #EA580C !important;
}
body.theme-light .tokabe-pill-lock,
body.theme-light .tokabe-pill-unlock,
body.theme-light .tokabe-pill-orderby {
    background: #F1F5F9 !important;
    color: #475569 !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .tokabe-pill-lunas {
    background: #ECFDF5 !important;
    color: #059669 !important;
    border: 1px solid #A7F3D0 !important;
}
body.theme-light .tokabe-pill-belum {
    background: #FEF2F2 !important;
    color: #DC2626 !important;
    border: 1px solid #FCA5A5 !important;
}
body.theme-light .tokabe-pill-dp {
    background: #FFFBEB !important;
    color: #D97706 !important;
    border: 1px solid #FDE68A !important;
}
body.theme-light .tokabe-pill-batal {
    background: #F1F5F9 !important;
    color: #64748B !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .btn-tokabe-action-dots {
    background: #FFFFFF !important;
    border: 1px solid #CBD5E1 !important;
    color: #334155 !important; /* Tegas & sangat jelas terlihat di mode terang */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06) !important;
}
body.theme-light .btn-tokabe-action-dots:hover,
body.theme-light .btn-tokabe-action-dots:focus,
body.theme-light .btn-tokabe-action-dots[aria-expanded="true"] {
    background: #FEF3C7 !important;
    border-color: #F59E0B !important;
    color: #D97706 !important;
    box-shadow: 0 2px 8px rgba(217, 119, 6, 0.18) !important;
}
body.theme-light .tokabe-details-card {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    color: #334155 !important;
}
body.theme-light .tokabe-btn-print {
    background: #FFFFFF !important;
    border: 1px solid #CBD5E1 !important;
    color: #334155 !important;
}
body.theme-light .tokabe-btn-print:hover {
    background: #F1F5F9 !important;
    color: #0F172A !important;
}
body.theme-light .tokabe-btn-wa {
    background: #ECFDF5 !important;
    border: 1px solid #10B981 !important;
    color: #059669 !important;
}
body.theme-light .tokabe-btn-wa:hover {
    background: #D1FAE5 !important;
    color: #047857 !important;
}

/* Pagination (Light) */
body.theme-light .dataTables_info {
    color: #64748B !important;
}
body.theme-light .dataTables_paginate ul.pagination {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04) !important;
}
body.theme-light .dataTables_paginate .page-link,
body.theme-light .dataTables_paginate .paginate_button {
    color: #475569 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
}
body.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
body.theme-light .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
    background: #FFF7ED !important;
    border-color: #FDBA74 !important;
    color: #C2410C !important;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.12) !important;
}
body.theme-light .dataTables_paginate li.page-item.active .page-link,
body.theme-light .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35) !important;
}
body.theme-light .dataTables_paginate li.page-item.previous .page-link,
body.theme-light .dataTables_paginate li.page-item.next .page-link,
body.theme-light .dataTables_paginate .paginate_button.previous,
body.theme-light .dataTables_paginate .paginate_button.next {
    border: 1px solid #E2E8F0 !important;
    background: #FFFFFF !important;
    color: #475569 !important;
}
body.theme-light .dataTables_paginate li.page-item.disabled .page-link,
body.theme-light .dataTables_paginate .paginate_button.disabled {
    opacity: 0.35 !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #94A3B8 !important;
}

/* ==========================================================================
   5. RESPONSIVE BREAKPOINTS (§7)
   ========================================================================== */
@media (max-width: 640px) {
    .ibk-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .ibk-timeframe-group {
        overflow-x: auto;
        max-width: 100%;
        padding-bottom: 6px;
    }
    .ibk-summary-grid {
        grid-template-columns: 1fr 1fr;
    }
    .ibk-kpi-card:first-child {
        grid-column: span 2;
    }
    .ibk-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .ibk-search-box {
        max-width: 100%;
    }
    .ibk-status-segmented {
        overflow-x: auto;
        width: 100%;
    }
    .ibk-toolbar-tools {
        justify-content: space-between;
    }
}

/* Accessibility: Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    *, ::before, ::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}
</style>
@endsection

@section('content')
<div class="ibk-invoice-wrapper">
    <!-- Toast Notification Container -->
    <div class="ibk-toast-container" id="ibkToastContainer" role="status" aria-live="polite"></div>

    <div class="container-fluid ibk-content-layer py-3">

        <!-- 1. Header Section -->
        <div class="ibk-header">
            <div class="ibk-page-title-box">
                <h1>Invoice</h1>
                <div class="ibk-page-subtitle">Invoice / Daftar Invoice</div>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-2">
                @if(in_array(Auth::user()->role, ['Pemilik', 'Admin']))
                <!-- Timeframe Segmented Group -->
                <div class="ibk-timeframe-group" role="group" aria-label="Filter Periode Invoice">
                    <button type="button" class="ibk-timeframe-btn" data-timeframe="today" onclick="switchTokabeCardTimeframe('today', this)">Hari Ini</button>
                    <button type="button" class="ibk-timeframe-btn" data-timeframe="week" onclick="switchTokabeCardTimeframe('week', this)">Minggu Ini</button>
                    <button type="button" class="ibk-timeframe-btn" data-timeframe="month" onclick="switchTokabeCardTimeframe('month', this)">Bulan Ini</button>
                    <button type="button" class="ibk-timeframe-btn active" data-timeframe="year" onclick="switchTokabeCardTimeframe('year', this)">Tahun Ini</button>
                    <button type="button" class="ibk-timeframe-btn" data-timeframe="last_year" onclick="switchTokabeCardTimeframe('last_year', this)">Tahun Lalu</button>
                    <button type="button" class="ibk-timeframe-btn" id="btn-custom-toggle" onclick="toggleCustomFilterCard()">
                        Filter Khusus <i class="ri-arrow-down-s-line ms-1"></i>
                    </button>
                </div>
                @endif

                <!-- Theme Toggle Button (Identik Dashboard) -->
                <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
                    <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
                    <span id="theme-toggle-text">Mode Terang</span>
                </button>

                <!-- Primary Action Button -->
                <a href="{{ url('addInvoice') }}" class="ibk-btn-primary" aria-label="Tambah Invoice Baru">
                    <i class="ri-add-line fs-16"></i> <span>Tambah Invoice</span>
                </a>
            </div>
        </div>

        @if(in_array(Auth::user()->role, ['Pemilik', 'Admin']))
        <!-- Custom Filter Collapse Panel -->
        <div class="collapse mb-4" id="collapseCardCustomFilter">
            <div class="ibk-glass ibk-custom-filter-card">
                <span class="fs-12 fw-medium" style="color: var(--ibk-brand-text);">
                    <i class="las la-filter me-1"></i> Rentang spesifik:
                </span>

                <div class="ibk-filter-submode" role="group">
                    <button type="button" class="ibk-filter-submode-btn active" id="btn-card-mode-date" onclick="setCardCustomSubmode('date')">Tanggal</button>
                    <button type="button" class="ibk-filter-submode-btn" id="btn-card-mode-month" onclick="setCardCustomSubmode('month')">Bulan</button>
                    <button type="button" class="ibk-filter-submode-btn" id="btn-card-mode-year" onclick="setCardCustomSubmode('year')">Tahun</button>
                    <button type="button" class="ibk-filter-submode-btn" id="btn-card-mode-range" onclick="setCardCustomSubmode('range')">Rentang</button>
                </div>

                <div class="d-inline-flex align-items-center gap-2" id="card-inputs-container">
                    <input type="text" id="card-input-date" class="ibk-search-input py-1 ibk-flatpickr" style="width: 140px; height: 34px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Pilih Tanggal">

                    <div id="card-ctrl-month" style="display: none; align-items: center; gap: 6px;">
                        <select id="card-input-bulan" class="ibk-search-input py-1" style="width: 125px; height: 34px; padding-left: 10px !important;">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                        <select id="card-input-tahun-month" class="ibk-search-input py-1" style="width: 90px; height: 34px; padding-left: 10px !important;">
                            @foreach ($availableYears as $yr)
                                <option value="{{ $yr }}" {{ $yr == date('Y') ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="card-ctrl-year" style="display: none;">
                        <select id="card-input-year" class="ibk-search-input py-1" style="width: 100px; height: 34px; padding-left: 10px !important;">
                            @foreach ($availableYears as $yr)
                                <option value="{{ $yr }}" {{ $yr == date('Y') ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="card-ctrl-range" style="display: none; align-items: center; gap: 6px;">
                        <input type="text" id="card-range-start" class="ibk-search-input py-1 ibk-flatpickr" style="width: 130px; height: 34px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-01') }}" readonly placeholder="Dari Tanggal">
                        <span class="fs-12" style="color: var(--ibk-text-muted);">s/d</span>
                        <input type="text" id="card-range-end" class="ibk-search-input py-1 ibk-flatpickr" style="width: 130px; height: 34px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Sampai Tanggal">
                    </div>
                </div>

                <button type="button" class="ibk-btn-primary py-1 px-3" onclick="applyCustomFilterCard()">
                    <i class="las la-search fs-13"></i> Terapkan
                </button>

                <button type="button" class="btn btn-link p-0 ms-auto text-decoration-none" onclick="toggleCustomFilterCard()" title="Tutup" style="color: var(--ibk-text-muted);">
                    <i class="las la-times fs-18"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- 2. Five Summary Cards (Single Row Grid Auto-fit) -->
        <div class="ibk-summary-grid">
            <!-- Card 1: Total Invoice (Oranye) -->
            <div class="ibk-glass ibk-kpi-card ibk-kpi-total" onclick="setStatusFilter('Semua', this)" title="Klik untuk menampilkan semua invoice">
                <div>
                    <p class="ibk-kpi-title" id="card-label-nonpo-total">Total invoice · Tahun Ini</p>
                    <div class="ibk-kpi-number">Rp <span id="card-nonpo-total" data-val="{{ (int)str_replace(['.', ','], '', $jumlahPerTahun ?? '0') }}">{{ $jumlahPerTahun }}</span></div>
                </div>
                <p class="ibk-kpi-footer"><span id="card-nonpo-total-count">{{ $jlhInvoice }}</span> invoice dibuat</p>
            </div>

            <!-- Card 2: Terbayar / Lunas (Hijau) -->
            <div class="ibk-glass ibk-kpi-card ibk-kpi-terbayar" onclick="setStatusFilter('Lunas', this)" title="Klik untuk menyaring invoice lunas">
                <div>
                    <p class="ibk-kpi-title" id="card-label-nonpo-lunas">Terbayar</p>
                    <div class="ibk-kpi-number" style="color: var(--ibk-status-lunas);">Rp <span id="card-nonpo-lunas" data-val="{{ (int)str_replace(['.', ','], '', $totalLunasThn ?? '0') }}">{{ $totalLunasThn }}</span></div>
                </div>
                <p class="ibk-kpi-footer"><span id="card-nonpo-lunas-count">{{ $lunas }}</span> invoice lunas</p>
            </div>

            <!-- Card 3: Belum Terbayar Tahun (Merah) -->
            <div class="ibk-glass ibk-kpi-card ibk-kpi-belum-thn" onclick="setStatusFilter('Belum Lunas', this)" title="Klik untuk menyaring invoice belum lunas">
                <div>
                    <p class="ibk-kpi-title" id="card-label-nonpo-blm-thn">Belum terbayar</p>
                    <div class="ibk-kpi-number" style="color: var(--ibk-status-belum);">Rp <span id="card-nonpo-blm-thn" data-val="{{ (int)str_replace(['.', ','], '', $jumlahBBPerTahun ?? '0') }}">{{ $jumlahBBPerTahun }}</span></div>
                </div>
                <p class="ibk-kpi-footer"><span id="card-nonpo-blm-thn-count">{{ $belumLunas }}</span> invoice belum dibayar</p>
            </div>

            <!-- Card 4: Belum Terbayar Bulan Ini (Amber) -->
            <div class="ibk-glass ibk-kpi-card ibk-kpi-belum-bln" onclick="setStatusFilter('Belum Lunas', this)" title="Klik untuk menyaring invoice belum lunas">
                <div>
                    <p class="ibk-kpi-title" id="card-label-nonpo-blm-bln">Belum terbayar {{ \Carbon\Carbon::now()->translatedFormat('F') }}</p>
                    <div class="ibk-kpi-number" style="color: var(--ibk-status-dp);">Rp <span id="card-nonpo-blm-bln" data-val="{{ (int)str_replace(['.', ','], '', $jumlahBBPerBulan ?? '0') }}">{{ $jumlahBBPerBulan }}</span></div>
                </div>
                <p class="ibk-kpi-footer"><span id="card-nonpo-blm-bln-count">{{ $belumLunasMonth }}</span> invoice belum dibayar</p>
            </div>

            <!-- Card 5: Dibatalkan (Abu) -->
            <div class="ibk-glass ibk-kpi-card ibk-kpi-batal" onclick="setStatusFilter('Batal', this)" title="Klik untuk menyaring invoice dibatalkan">
                <div>
                    <p class="ibk-kpi-title">Dibatalkan</p>
                    <div class="ibk-kpi-number" style="color: var(--ibk-status-batal);">Rp <span id="card-batal-total" data-val="{{ (int)str_replace(['.', ','], '', $jumlahBatal ?? '0') }}">{{ $jumlahBatal }}</span></div>
                </div>
                <p class="ibk-kpi-footer"><span id="card-batal-count">{{ $batal }}</span> invoice dibatalkan</p>
            </div>
        </div>

        <!-- 3. Main Glass Table Container -->
        <div class="ibk-glass ibk-table-card">
            
            <!-- Table Header -->
            <div class="ibk-table-header">
                <div>
                    <h5 class="ibk-table-title">Daftar invoice Tokabe</h5>
                    <div class="ibk-table-subtitle">Klik panah di kiri ID untuk melihat rincian</div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="ibk-tool-btn" id="btnToggleAllRows" onclick="toggleAllRowDetails()" aria-label="Buka Semua Rincian">
                        Buka Semua Rincian
                    </button>
                </div>
            </div>

            <!-- Single-Line Toolbar -->
            <div class="ibk-toolbar">
                <!-- Left: Search Box -->
                <div class="ibk-search-box">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="ibkCustomSearchInput" class="ibk-search-input" placeholder="Cari invoice atau pelanggan..." aria-label="Cari invoice atau pelanggan">
                </div>

                <!-- Center: Segmented Status Tabs -->
                <div class="ibk-status-segmented" role="tablist" aria-label="Filter Status Invoice">
                    <button type="button" class="ibk-status-tab active" data-status="Semua" onclick="setStatusFilter('Semua', this)">
                        Semua <span class="ibk-tab-count" id="count-tab-semua">{{ $jlhInvoice }}</span>
                    </button>
                    <button type="button" class="ibk-status-tab" data-status="Lunas" onclick="setStatusFilter('Lunas', this)">
                        Lunas <span class="ibk-tab-count" id="count-tab-lunas">{{ $lunas }}</span>
                    </button>
                    <button type="button" class="ibk-status-tab" data-status="Belum Lunas" onclick="setStatusFilter('Belum Lunas', this)">
                        Belum Lunas <span class="ibk-tab-count" id="count-tab-belum">{{ $belumLunas }}</span>
                    </button>
                    <button type="button" class="ibk-status-tab" data-status="Batal" onclick="setStatusFilter('Batal', this)">
                        Batal <span class="ibk-tab-count" id="count-tab-batal">{{ $batal }}</span>
                    </button>
                </div>

                <!-- Right: Advanced Filter & Sort -->
                <div class="ibk-toolbar-tools">
                    <div style="position: relative;">
                        <button type="button" class="ibk-tool-btn" id="btnFilterPopoverToggle" onclick="toggleFilterPopover(event)" aria-label="Buka Filter Lanjutan">
                            <i class="las la-sliders-h"></i> Filter
                            <span class="ibk-tool-badge" id="filterActiveBadge" style="display: none;">0</span>
                        </button>

                        <!-- Advanced Filter Popover -->
                        <div class="ibk-filter-popover" id="ibkFilterPopover" onclick="event.stopPropagation()">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-13 fw-bold" style="color: var(--ibk-text);">Filter Lanjutan</span>
                                <button type="button" class="btn btn-link p-0 text-decoration-none fs-12" style="color: var(--ibk-brand-text);" onclick="resetFilters()">Reset</button>
                            </div>

                            <!-- Channel / Order By -->
                            <label class="fs-11 fw-medium mt-2" style="color: var(--ibk-text-muted);">Order by</label>
                            <div class="ibk-chip-group" id="chip-group-orderby">
                                <span class="ibk-chip active" data-val="" onclick="setFilterChip(this, 'order_by')">Semua</span>
                                <span class="ibk-chip" data-val="WhatsApp/Online" onclick="setFilterChip(this, 'order_by')">WhatsApp</span>
                                <span class="ibk-chip" data-val="Walk in" onclick="setFilterChip(this, 'order_by')">Walk In / Toko</span>
                                <span class="ibk-chip" data-val="Shopee" onclick="setFilterChip(this, 'order_by')">Shopee</span>
                                <span class="ibk-chip" data-val="Sales" onclick="setFilterChip(this, 'order_by')">Sales</span>
                            </div>

                            <!-- Tipe Pembayaran -->
                            <label class="fs-11 fw-medium" style="color: var(--ibk-text-muted);">Pembayaran</label>
                            <div class="ibk-chip-group" id="chip-group-pembayaran">
                                <span class="ibk-chip active" data-val="" onclick="setFilterChip(this, 'pembayaran')">Semua</span>
                                <span class="ibk-chip" data-val="Cash" onclick="setFilterChip(this, 'pembayaran')">Cash</span>
                                <span class="ibk-chip" data-val="Transfer" onclick="setFilterChip(this, 'pembayaran')">Transfer</span>
                                <span class="ibk-chip" data-val="DP" onclick="setFilterChip(this, 'pembayaran')">DP</span>
                                <span class="ibk-chip" data-val="PO" onclick="setFilterChip(this, 'pembayaran')">PO</span>
                            </div>

                            <!-- Jenis Invoice -->
                            <label class="fs-11 fw-medium" style="color: var(--ibk-text-muted);">Jenis invoice</label>
                            <select id="filterJenisInvoice" class="ibk-popover-select" onchange="onAdvancedFilterParamChange()">
                                <option value="">Semua Jenis Invoice</option>
                                @foreach ($jenisInvoiceList as $jInv)
                                    <option value="{{ $jInv->id }}">{{ $jInv->nama_invoice }}</option>
                                @endforeach
                            </select>

                            @if(isset($adminList) && count($adminList) > 0)
                            <!-- Admin -->
                            <label class="fs-11 fw-medium" style="color: var(--ibk-text-muted);">Admin pembuat</label>
                            <select id="filterAdminInvoice" class="ibk-popover-select" onchange="onAdvancedFilterParamChange()">
                                <option value="">Semua Admin</option>
                                @foreach ($adminList as $adm)
                                    <option value="{{ $adm->id }}">{{ $adm->nama }}</option>
                                @endforeach
                            </select>
                            @endif

                            <div class="d-flex justify-content-between align-items-center gap-2 mt-2 pt-2" style="border-top: 1px solid var(--ibk-border-divider);">
                                <button type="button" class="btn btn-sm text-muted p-0 text-decoration-none fs-12" onclick="resetFilters()">
                                    <i class="las la-undo me-1"></i>Reset
                                </button>
                                <button type="button" class="ibk-btn-primary py-1 px-3 fs-12" onclick="applyAdvancedFilters()">
                                    <i class="las la-check me-1"></i>Selesai
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="dropdown">
                        <button class="ibk-tool-btn dropdown-toggle" type="button" id="sortDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="las la-sort-amount-down"></i> <span id="currentSortLabel">Terbaru</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end tokabe-action-menu" aria-labelledby="sortDropdownBtn">
                            <li><a class="dropdown-item active" href="javascript:void(0)" onclick="applyTableSort(4, 'desc', 'Terbaru', this)"><i class="las la-calendar-check me-2"></i>Tanggal Terbaru</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(4, 'asc', 'Terlama', this)"><i class="las la-calendar me-2"></i>Tanggal Terlama</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(1, 'asc', 'ID (A-Z)', this)"><i class="las la-sort-alpha-down me-2"></i>Invoice ID (A-Z)</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(1, 'desc', 'ID (Z-A)', this)"><i class="las la-sort-alpha-up me-2"></i>Invoice ID (Z-A)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(2, 'asc', 'Pelanggan', this)"><i class="las la-user me-2"></i>Pelanggan (A-Z)</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(11, 'desc', 'Total Terbesar', this)"><i class="las la-wallet me-2"></i>Total Terbesar</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="applyTableSort(11, 'asc', 'Total Terkecil', this)"><i class="las la-wallet me-2"></i>Total Terkecil</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Table Body -->
            <div class="ibk-table-wrap">
                <table id="scroll-horizontal" class="table tokabe-invoice-table" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="tokabe-col-no text-center">No</th>
                            <th scope="col" class="tokabe-th-inv">Invoice ID</th>
                            <th scope="col" class="tokabe-th-pelanggan">Pelanggan</th>
                            <th scope="col" class="tokabe-th-telepon">Telepon</th>
                            <th scope="col" class="tokabe-th-tgl active-sort">Tanggal</th>
                            <th scope="col" class="tokabe-th-status text-center">Status</th>
                            <th scope="col" class="tokabe-th-approval text-center">Approval</th>
                            <th scope="col" class="tokabe-th-deskripsi">Deskripsi</th>
                            <th scope="col" class="tokabe-th-material">Bahan Material</th>
                            <th scope="col" class="tokabe-th-alasan">Alasan Batal</th>
                            <th scope="col" class="tokabe-th-panjar">Panjar</th>
                            <th scope="col" class="tokabe-th-total">Total</th>
                            <th scope="col" class="tokabe-th-pembayaran text-center">Pembayaran</th>
                            <th scope="col" class="tokabe-th-orderby">Order by</th>
                            <th scope="col" class="tokabe-th-admin">Admin</th>
                            <th scope="col" class="tokabe-th-aksi text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dimuat server-side via DataTables AJAX -->
                    </tbody>
                </table>
            </div>

            <!-- Hidden Forms for Actions -->
            <form id="globalBatalForm" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="alasan_batal" id="globalInputAlasanBatal">
            </form>
            <form id="globalHapusForm" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="alasan_hapus" id="globalInputAlasanHapus">
            </form>

            <!-- Table Footer -->
            <div class="ibk-table-footer">
                <div id="tokabeCustomInfo"></div>
                <div id="tokabeCustomPaginate"></div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Riwayat Update Log -->
<div class="modal fade" id="updateLogModal" tabindex="-1" aria-labelledby="updateLogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content ibk-glass" style="background: var(--ibk-popover-bg); border: var(--ibk-glass-border); color: var(--ibk-text);">
      <div class="modal-header" style="border-bottom: 1px solid var(--ibk-border-divider);">
        <h5 class="modal-title fs-15 fw-bold" id="updateLogModalLabel">Riwayat Update Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul id="updateLogList" class="list-group list-group-flush" style="background: transparent;">
          <!-- AJAX load -->
        </ul>
      </div>
      <div class="modal-footer" style="border-top: 1px solid var(--ibk-border-divider);">
        <button type="button" class="ibk-tool-btn" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Buat SPK -->
<div class="modal fade" id="buatSpkModal" tabindex="-1" aria-labelledby="buatSpkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ibk-glass" style="background: var(--ibk-popover-bg); border: var(--ibk-glass-border); color: var(--ibk-text);">
      <div class="modal-header" style="border-bottom: 1px solid var(--ibk-border-divider);">
        <h5 class="modal-title fs-15 fw-bold" id="buatSpkModalLabel">Buat SPK Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <form action="{{ route('spk.store_dari_invoice') }}" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="invoice_id" id="spk_invoice_id">
          
          <div class="mb-3">
            <label for="lainnya" class="form-label fs-12 fw-medium" style="color: var(--ibk-text-muted);">Keterangan tambahan</label>
            <textarea class="ibk-search-input w-100" id="lainnya" name="lainnya" rows="3" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
          </div>
          
          <div class="mb-3">
            <label for="express" class="form-label fs-12 fw-medium" style="color: var(--ibk-text-muted);">Status pengerjaan</label>
            <select class="ibk-search-input w-100" id="express" name="express" required>
              <option value="">-- Pilih Status Pengerjaan --</option>
              <option value="Y">Ya (Express)</option>
              <option value="N">Tidak (Normal)</option>
            </select>
          </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid var(--ibk-border-divider);">
          <button type="button" class="ibk-tool-btn" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="ibk-btn-primary">Buat SPK Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" defer></script>

<script>
    const loggedInUser = "{{ auth()->user()->nama }}";
    var invoiceTable = null;
    var currentSelectedStatus = "Semua";
    var filterOrderBy = "";
    var filterPembayaran = "";
    var searchDebounceTimer = null;

    /* ==========================================================================
       1. THEME RESTORE & TOGGLE (DARK / LIGHT) — CIRCULAR REVEAL ANIMATION
       ========================================================================== */
    var isThemeTransitioning = false;

    function initInvoiceTheme() {
        var savedTheme = 'dark';
        try {
            savedTheme = localStorage.getItem('ibekami_dash_theme') || (document.body.classList.contains('theme-light') ? 'light' : 'dark');
        } catch(e) {
            savedTheme = 'dark';
        }
        applyThemeDOM(savedTheme);
    }

    function applyThemeDOM(theme) {
        var isLight = theme === 'light';
        if (document.body) {
            document.body.classList.toggle('theme-light', isLight);
            document.body.classList.toggle('theme-dark', !isLight);
        }
        document.documentElement.classList.toggle('theme-light', isLight);
        document.documentElement.classList.toggle('theme-dark', !isLight);
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.setAttribute('data-layout-mode', theme);
        document.documentElement.setAttribute('data-sidebar', isLight ? 'light' : 'dark');
        try {
            localStorage.setItem('ibekami_dash_theme', theme);
            localStorage.setItem('tokabe_theme', theme);
            sessionStorage.setItem('data-layout-mode', theme);
            sessionStorage.setItem('data-sidebar', isLight ? 'light' : 'dark');
        } catch(e) {}

        var btnText = document.getElementById('theme-toggle-text') || document.getElementById('themeLabel');
        var btnIcon = document.getElementById('theme-toggle-icon') || document.getElementById('themeIcon');
        if (btnText) btnText.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
        if (btnIcon) {
            btnIcon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
        }
    }

    function toggleDashboardTheme(event) {
        if (isThemeTransitioning) return;
        isThemeTransitioning = true;

        var current = 'dark';
        try {
            current = localStorage.getItem('ibekami_dash_theme') || (document.body.classList.contains('theme-light') ? 'light' : 'dark');
        } catch (e) {
            current = document.body.classList.contains('theme-light') ? 'light' : 'dark';
        }
        var targetTheme = current === 'light' ? 'dark' : 'light';

        var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var supportsViewTransition = typeof document.startViewTransition === 'function';

        if (!supportsViewTransition || prefersReducedMotion) {
            applyThemeDOM(targetTheme);
            try {
                localStorage.setItem('ibekami_dash_theme', targetTheme);
            } catch(e) {}
            isThemeTransitioning = false;
            return;
        }

        var btn = document.getElementById('btn-theme-toggle') || document.getElementById('btnThemeToggle');
        if (btn) btn.classList.add('theme-switching');

        var x = window.innerWidth / 2;
        var y = window.innerHeight / 2;
        if (btn) {
            var rect = btn.getBoundingClientRect();
            x = rect.left + rect.width / 2;
            y = rect.top + rect.height / 2;
        } else if (event && typeof event.clientX === 'number') {
            x = event.clientX;
            y = event.clientY;
        }

        var endRadius = Math.hypot(
            Math.max(x, window.innerWidth - x),
            Math.max(y, window.innerHeight - y)
        );

        try {
            var transition = document.startViewTransition(function() {
                applyThemeDOM(targetTheme);
                try {
                    localStorage.setItem('ibekami_dash_theme', targetTheme);
                } catch(e) {}
            });

            if (transition && typeof transition.ready !== 'undefined') {
                Promise.resolve(transition.ready).then(function() {
                    var anim = document.documentElement.animate(
                        {
                            clipPath: [
                                'circle(0px at ' + x + 'px ' + y + 'px)',
                                'circle(' + endRadius + 'px at ' + x + 'px ' + y + 'px)'
                            ]
                        },
                        {
                            duration: 850,
                            easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
                            pseudoElement: '::view-transition-new(root)'
                        }
                    );

                    if (anim && typeof anim.finished !== 'undefined') {
                        Promise.resolve(anim.finished).then(function() {
                            if (btn) setTimeout(function() { btn.classList.remove('theme-switching'); }, 80);
                            isThemeTransitioning = false;
                        }).catch(function() {
                            if (btn) btn.classList.remove('theme-switching');
                            isThemeTransitioning = false;
                        });
                    } else {
                        setTimeout(function() {
                            if (btn) btn.classList.remove('theme-switching');
                            isThemeTransitioning = false;
                        }, 850);
                    }
                }).catch(function() {
                    if (btn) btn.classList.remove('theme-switching');
                    isThemeTransitioning = false;
                });
            } else {
                if (btn) btn.classList.remove('theme-switching');
                isThemeTransitioning = false;
            }
        } catch (err) {
            console.warn('View transition fallback:', err);
            applyThemeDOM(targetTheme);
            try {
                localStorage.setItem('ibekami_dash_theme', targetTheme);
            } catch(e) {}
            if (btn) btn.classList.remove('theme-switching');
            isThemeTransitioning = false;
        }
    }

    function toggleInvoiceTheme(event) {
        toggleDashboardTheme(event);
    }

    /* ==========================================================================
       2. COUNT-UP ANIMATION (§5)
       ========================================================================== */
    function animateCountUp(element, endVal, duration = 900) {
        if (!element) return;
        var startVal = parseInt(element.getAttribute('data-val') || '0', 10);
        var startTime = null;

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            element.textContent = Number(endVal).toLocaleString('id-ID');
            element.setAttribute('data-val', endVal);
            return;
        }

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            // Ease out cubic
            var ease = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(startVal + (endVal - startVal) * ease);
            element.textContent = Number(current).toLocaleString('id-ID');

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                element.textContent = Number(endVal).toLocaleString('id-ID');
                element.setAttribute('data-val', endVal);
            }
        }
        window.requestAnimationFrame(step);
    }

    /* ==========================================================================
       3. TOAST NOTIFICATIONS (§4.8)
       ========================================================================== */
    function showIbkToast(message, type = 'info') {
        var container = document.getElementById('ibkToastContainer');
        if (!container) return;

        var toast = document.createElement('div');
        toast.className = 'ibk-toast';
        var icon = type === 'success' ? 'la-check-circle text-success' : (type === 'error' ? 'la-exclamation-circle text-danger' : 'la-info-circle text-warning');
        toast.innerHTML = `<i class="las ${icon} fs-18"></i> <span>${message}</span>`;
        container.appendChild(toast);

        setTimeout(function() {
            toast.style.transition = 'opacity 300ms ease, transform 300ms ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-10px) scale(0.96)';
            setTimeout(function() { toast.remove(); }, 320);
        }, 2200);
    }

    /* ==========================================================================
       4. STATUS SEGMENTED TABS & KPI CARDS SYNC (§4.2 & §4.3)
       ========================================================================== */
    function setStatusFilter(status, triggerEl) {
        if (currentSelectedStatus === status) {
            return;
        }
        currentSelectedStatus = status;

        // Sync Segmented Tab active state
        $('.ibk-status-tab').removeClass('active');
        $(`.ibk-status-tab[data-status="${status}"]`).addClass('active');

        // Sync KPI Card lift & ring highlight
        $('.ibk-kpi-card').removeClass('is-active-filter');
        if (status === 'Lunas') {
            $('.ibk-kpi-terbayar').addClass('is-active-filter');
        } else if (status === 'Belum Lunas') {
            $('.ibk-kpi-belum-thn').addClass('is-active-filter');
        } else if (status === 'Batal') {
            $('.ibk-kpi-batal').addClass('is-active-filter');
        } else {
            $('.ibk-kpi-total').addClass('is-active-filter');
        }

        // Close details & redraw table with smooth transition
        closeAllRowDetails();
        reloadTableSmooth();
    }

    /* ==========================================================================
       5. ADVANCED FILTER POPOVER (§4.3)
       ========================================================================== */
    function toggleFilterPopover(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        $('#ibkFilterPopover').toggleClass('show');
    }

    function closeAllPopovers() {
        $('#ibkFilterPopover').removeClass('show');
    }

    // Dismiss popover when clicking anywhere outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#ibkFilterPopover, #btnFilterPopoverToggle').length) {
            closeAllPopovers();
        }
    });

    function setFilterChip(el, group) {
        var $el = $(el);
        $el.siblings().removeClass('active');
        $el.addClass('active');
        var val = String($el.attr('data-val') || '').trim();
        if (group === 'order_by') {
            filterOrderBy = val;
        } else if (group === 'pembayaran') {
            filterPembayaran = val;
        }
        updateFilterBadgeCount();
        reloadTableSmooth();
    }

    function onAdvancedFilterParamChange() {
        updateFilterBadgeCount();
        reloadTableSmooth();
    }

    function reloadTableSmooth() {
        if (invoiceTable) {
            $('#scroll-horizontal').addClass('dataTable-reloading');
            invoiceTable.ajax.reload(function() {
                $('#scroll-horizontal').removeClass('dataTable-reloading');
            }, true);
        }
    }

    function updateFilterBadgeCount() {
        var count = 0;
        if (filterOrderBy) count++;
        if (filterPembayaran) count++;
        if ($('#filterJenisInvoice').val()) count++;
        if ($('#filterAdminInvoice').val()) count++;

        var badge = $('#filterActiveBadge');
        if (count > 0) {
            badge.text(count).show();
        } else {
            badge.hide();
        }
    }

    function resetFilters() {
        filterOrderBy = '';
        filterPembayaran = '';
        $('#chip-group-orderby .ibk-chip').removeClass('active').filter('[data-val=""]').addClass('active');
        $('#chip-group-pembayaran .ibk-chip').removeClass('active').filter('[data-val=""]').addClass('active');
        $('#filterJenisInvoice').val('');
        $('#filterAdminInvoice').val('');
        updateFilterBadgeCount();
        closeAllPopovers();
        reloadTableSmooth();
        showIbkToast('Filter lanjutan telah di-reset');
    }

    function applyAdvancedFilters() {
        var activeOrder = String($('#chip-group-orderby .ibk-chip.active').attr('data-val') || '').trim();
        var activePem = String($('#chip-group-pembayaran .ibk-chip.active').attr('data-val') || '').trim();
        filterOrderBy = activeOrder;
        filterPembayaran = activePem;
        updateFilterBadgeCount();
        closeAllPopovers();
        reloadTableSmooth();
        showIbkToast('Filter diterapkan');
    }

    /* ==========================================================================
       6. TIMEFRAME SUMMARY CARDS DATA (AJAX)
       ========================================================================== */
    function switchTokabeCardTimeframe(timeframe, btn) {
        $('.ibk-timeframe-btn').removeClass('active');
        $(btn).addClass('active');
        $('#collapseCardCustomFilter').collapse('hide');
        fetchTokabeCardsData({ timeframe: timeframe });
    }

    function toggleCustomFilterCard() {
        $('#collapseCardCustomFilter').collapse('toggle');
    }

    function setCardCustomSubmode(mode) {
        $('.ibk-filter-submode-btn').removeClass('active');
        $('#btn-card-mode-' + mode).addClass('active');

        $('#card-input-date, #card-ctrl-month, #card-ctrl-year, #card-ctrl-range').hide();
        if (mode === 'date') $('#card-input-date').show();
        else if (mode === 'month') $('#card-ctrl-month').css('display', 'inline-flex');
        else if (mode === 'year') $('#card-ctrl-year').show();
        else if (mode === 'range') $('#card-ctrl-range').css('display', 'inline-flex');
    }

    function applyCustomFilterCard() {
        var activeSubmode = $('.ibk-filter-submode-btn.active').attr('id').replace('btn-card-mode-', '');
        var params = { timeframe: 'custom', mode: activeSubmode };

        if (activeSubmode === 'date') {
            params.date = $('#card-input-date').val();
            if (!params.date) return;
        } else if (activeSubmode === 'month') {
            params.month = $('#card-input-bulan').val();
            params.year = $('#card-input-tahun-month').val();
        } else if (activeSubmode === 'year') {
            params.year = $('#card-input-year').val();
        } else if (activeSubmode === 'range') {
            params.start_date = $('#card-range-start').val();
            params.end_date = $('#card-range-end').val();
            if (!params.start_date || !params.end_date) return;
        }

        $('.ibk-timeframe-btn').removeClass('active');
        $('#btn-custom-toggle').addClass('active');
        fetchTokabeCardsData(params);
    }

    function fetchTokabeCardsData(params) {
        $('.ibk-kpi-card').css('opacity', '0.6');

        $.ajax({
            url: "{{ route('invoice.cards_data') }}",
            type: "GET",
            data: params,
            dataType: "json",
            success: function(res) {
                $('.ibk-kpi-card').css('opacity', '1');
                if (res.status === 'success') {
                    if (res.periodLabel) {
                        $('#card-label-nonpo-total').text('Total invoice · ' + res.periodLabel);
                        $('#card-label-nonpo-lunas').text('Terbayar · ' + res.periodLabel);
                        $('#card-label-nonpo-blm-thn').text('Belum terbayar · ' + res.periodLabel);
                    }
                    if (res.card4MonthName) {
                        $('#card-label-nonpo-blm-bln').text('Belum terbayar ' + res.card4MonthName);
                    }

                    // Card 1
                    if (res.card1) {
                        animateCountUp(document.getElementById('card-nonpo-total'), parseInt(String(res.card1.nominal).replace(/[^\d]/g, '') || 0, 10));
                        $('#card-nonpo-total-count').text(res.card1.count);
                        $('#count-tab-semua').text(res.card1.count);
                    }
                    // Card 2
                    if (res.card2) {
                        animateCountUp(document.getElementById('card-nonpo-lunas'), parseInt(String(res.card2.nominal).replace(/[^\d]/g, '') || 0, 10));
                        $('#card-nonpo-lunas-count').text(res.card2.count);
                        $('#count-tab-lunas').text(res.card2.count);
                    }
                    // Card 3
                    if (res.card3) {
                        animateCountUp(document.getElementById('card-nonpo-blm-thn'), parseInt(String(res.card3.nominal).replace(/[^\d]/g, '') || 0, 10));
                        $('#card-nonpo-blm-thn-count').text(res.card3.count);
                        $('#count-tab-belum').text(res.card3.count);
                    }
                    // Card 4
                    if (res.card4) {
                        animateCountUp(document.getElementById('card-nonpo-blm-bln'), parseInt(String(res.card4.nominal).replace(/[^\d]/g, '') || 0, 10));
                        $('#card-nonpo-blm-bln-count').text(res.card4.count);
                    }
                    // Card 5
                    if (res.card5) {
                        animateCountUp(document.getElementById('card-batal-total'), parseInt(String(res.card5.nominal).replace(/[^\d]/g, '') || 0, 10));
                        $('#card-batal-count').text(res.card5.count);
                        $('#count-tab-batal').text(res.card5.count);
                    }
                }
            },
            error: function(err) {
                $('.ibk-kpi-card').css('opacity', '1');
                console.error('Gagal memuat kartu invoice:', err);
            }
        });
    }

    /* ==========================================================================
       7. TABLE SORT & ROW DETAILS EXPANSION (§4.4)
       ========================================================================== */
    function applyTableSort(colIndex, direction, label, el) {
        if (!invoiceTable) return;
        $('#currentSortLabel').text(label);
        if (el) {
            $(el).closest('.dropdown-menu').find('.dropdown-item').removeClass('active');
            $(el).addClass('active');
        }
        invoiceTable.order([colIndex, direction]).draw();
    }

    function toggleRowDesc(element) {
        var tr = $(element).closest('tr');
        if (!tr.length) return;

        var isExpanded = tr.hasClass('expanded');
        var toggleBtn = tr.find('.tokabe-row-toggle');
        var extraSections = tr.find('.tokabe-desc-extra');
        var moreBtns = tr.find('.tokabe-desc-more');
        var lessBtns = tr.find('.tokabe-desc-less');

        if (isExpanded) {
            tr.removeClass('expanded shown');
            toggleBtn.removeClass('active');
            extraSections.stop(true, false).slideUp(180);
            lessBtns.hide();
            moreBtns.show();
        } else {
            tr.addClass('expanded shown');
            toggleBtn.addClass('active');
            extraSections.stop(true, false).slideDown(200);
            moreBtns.hide();
            lessBtns.show();
        }
    }

    function closeAllRowDetails() {
        var allTrs = $('#scroll-horizontal tbody tr');
        allTrs.removeClass('expanded shown');
        allTrs.find('.tokabe-row-toggle').removeClass('active');
        allTrs.find('.tokabe-desc-extra').hide();
        allTrs.find('.tokabe-desc-less').hide();
        allTrs.find('.tokabe-desc-more').show();
        $('#btnToggleAllRows').text('Buka Semua Rincian');
    }

    function toggleAllRowDetails() {
        var anyOpen = $('#scroll-horizontal tbody tr.expanded').length > 0;
        var allTrs = $('#scroll-horizontal tbody tr');

        if (anyOpen) {
            closeAllRowDetails();
        } else {
            allTrs.addClass('expanded shown');
            allTrs.find('.tokabe-row-toggle').addClass('active');
            allTrs.find('.tokabe-desc-extra').stop(true, false).slideDown(200);
            allTrs.find('.tokabe-desc-more').hide();
            allTrs.find('.tokabe-desc-less').show();
            $('#btnToggleAllRows').text('Tutup Semua Rincian');
        }
    }

    /* ==========================================================================
       8. SWEETALERT CONFIRMATION FOR BATAL & HAPUS
       ========================================================================== */
    function confirmBatal(id, nomorInvoice) {
        Swal.fire({
            title: 'Pembatalan Invoice',
            text: "Masukkan alasan pembatalan untuk invoice " + nomorInvoice,
            input: 'textarea',
            inputPlaceholder: 'Tulis alasan batal di sini...',
            showCancelButton: true,
            confirmButtonText: 'Proses Batal',
            cancelButtonText: 'Kembali',
            confirmButtonColor: '#F59E0B',
            cancelButtonColor: '#78716C',
            inputValidator: (value) => {
                if (!value) return 'Alasan batal harus diisi!';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('globalBatalForm');
                form.action = "{{ url('ubah-status-batal') }}/" + id;
                var inputBatal = document.getElementById('globalInputAlasanBatal');
                if (inputBatal) inputBatal.value = result.value;
                form.submit();
            }
        });
    }

    function confirmHapus(id, nomorInvoice) {
        Swal.fire({
            title: 'Hapus Invoice',
            html: `Apakah Anda yakin ingin menghapus invoice <strong>#${nomorInvoice}</strong>?<br><span class="text-danger small">Tindakan ini akan mengembalikan stok barang/material dan menghapus SPK terkait.</span>`,
            input: 'textarea',
            inputPlaceholder: 'Tulis alasan penghapusan invoice di sini...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Invoice',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#78716C',
            inputValidator: (value) => {
                if (!value || !value.trim()) return 'Alasan penghapusan invoice wajib diisi!';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('globalHapusForm');
                form.action = "{{ url('delete-invoice') }}/" + id;
                var inputHapus = document.getElementById('globalInputAlasanHapus');
                if (inputHapus) inputHapus.value = result.value.trim();
                form.submit();
            }
        });
    }

    /* ==========================================================================
       9. UPDATE LOG & BUAT SPK MODAL HANDLERS
       ========================================================================== */
    $(document).on('click', '.btn-update-log', function(e) {
        e.preventDefault();
        var invoiceId = $(this).data('id');
        $('#updateLogList').html('<li class="list-group-item bg-transparent text-muted">Memuat data log...</li>');

        $.ajax({
            url: '{{ url('/invoice/update-log') }}/' + invoiceId,
            method: 'GET',
            success: function (data) {
                let html = `<li class="list-group-item bg-transparent" style="color: var(--ibk-text); border-color: var(--ibk-border-divider);"><span class="text-muted small">${data.created_at}</span> — <strong style="color: var(--ibk-brand-text);">Invoice Dibuat</strong></li>`;
                if (data.logs && data.logs.length > 0) {
                    data.logs.forEach(function (log) {
                        var badgeColor = log.severity === 'critical' ? '#EF4444' : (log.severity === 'warning' ? '#D97706' : '#0EA5E9');
                        var diffHtml = '';
                        if (log.old_values || log.new_values) {
                            var keys = Array.from(new Set([
                                ...Object.keys(log.old_values || {}),
                                ...Object.keys(log.new_values || {})
                            ]));
                            if (keys.length > 0) {
                                diffHtml += '<div class="mt-2 p-2 rounded small" style="background: rgba(148,163,184,0.08); border: 1px solid var(--ibk-border-divider);">';
                                keys.slice(0, 6).forEach(function(k) {
                                    var ov = log.old_values && log.old_values[k] !== undefined && log.old_values[k] !== null ? log.old_values[k] : '—';
                                    var nv = log.new_values && log.new_values[k] !== undefined && log.new_values[k] !== null ? log.new_values[k] : '—';
                                    diffHtml += `<div class="d-flex justify-content-between gap-2"><strong>${k}:</strong> <span><span class="text-muted text-decoration-line-through">${ov}</span> &rarr; <span style="color: var(--ibk-brand-text); font-weight:600;">${nv}</span></span></div>`;
                                });
                                diffHtml += '</div>';
                            }
                        }
                        html += `<li class="list-group-item bg-transparent" style="color: var(--ibk-text); border-color: var(--ibk-border-divider);">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-semibold">${log.user_name || '-'} <span class="badge ms-1" style="background: ${badgeColor}22; color: ${badgeColor}; font-size:10px;">${log.user_role || '-'}</span></span>
                                <span class="text-muted" style="font-size:11px;">${log.tanggal}</span>
                            </div>
                            <div class="small">${log.keterangan || 'Invoice diperbarui'}</div>
                            ${diffHtml}
                        </li>`;
                    });
                }
                $('#updateLogList').html(html);
            },
            error: function () {
                $('#updateLogList').html('<li class="list-group-item bg-transparent text-danger">Gagal memuat data log.</li>');
            }
        });
    });

    $(document).on('click', '.btn-buat-spk', function(e) {
        e.preventDefault();
        var invoiceId = $(this).data('id');
        $('#spk_invoice_id').val(invoiceId);
    });

    /* ==========================================================================
       10. DATATABLES INITIALIZATION
       ========================================================================== */
    $(document).ready(function() {
        initInvoiceTheme();

        // Initialize Modern Flatpickr on Date Filter Inputs
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.ibk-flatpickr', {
                dateFormat: "Y-m-d",
                disableMobile: true,
                animate: true
            });
        }

        invoiceTable = $('#scroll-horizontal').DataTable({
            processing: false,
            serverSide: true,
            scrollX: false,
            autoWidth: false,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            order: [[4, 'desc']],
            dom: "rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
            ajax: {
                url: "{{ route('invoice.datatable_data') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.status = currentSelectedStatus;
                    d.jenis = $('#filterJenisInvoice').val();
                    d.order_by = filterOrderBy;
                    d.pembayaran = filterPembayaran;
                    d.admin_id = $('#filterAdminInvoice').val() || '';
                }
            },
            columns: [
                { data: 0, className: "text-center tokabe-col-no", orderable: false, width: "50px" },
                { data: 1, className: "tokabe-col-invoice", orderable: true, width: "130px" },
                { data: 2, className: "tokabe-col-pelanggan", orderable: true, width: "260px" },
                { data: 3, className: "tokabe-col-telepon", orderable: true, width: "170px" },
                { data: 4, className: "tokabe-col-tgl", orderable: true, width: "160px" },
                { data: 5, className: "text-center tokabe-col-status", orderable: true, width: "130px" },
                { data: 6, className: "text-center tokabe-col-approval", orderable: true, width: "110px" },
                { data: 7, className: "tokabe-col-deskripsi", orderable: false, width: "220px" },
                { data: 8, className: "tokabe-col-material", orderable: false, width: "180px" },
                { data: 9, className: "tokabe-col-alasan", orderable: true, width: "150px" },
                { data: 10, className: "tokabe-col-panjar", orderable: true, width: "140px" },
                { data: 11, className: "tokabe-col-total", orderable: true, width: "180px" },
                { data: 12, className: "text-center tokabe-col-pembayaran", orderable: true, width: "145px" },
                { data: 13, className: "tokabe-col-orderby", orderable: true, width: "140px" },
                { data: 14, className: "tokabe-col-admin", orderable: true, width: "160px" },
                { data: 15, className: "text-center tokabe-col-aksi", orderable: false, width: "60px" }
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari invoice...",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(disaring dari _MAX_ data)",
                zeroRecords: `<div class="ibk-empty-state"><i class="las la-inbox ibk-empty-icon"></i><div class="ibk-empty-title">Tidak ada invoice ditemukan</div><div class="ibk-empty-sub">Coba ubah kata kunci pencarian atau reset filter.</div><button type="button" class="ibk-tool-btn mt-3" onclick="resetFilters()">Reset Filter</button></div>`,
                paginate: {
                    first: '<i class="las la-angle-double-left"></i>',
                    previous: '<i class="las la-angle-left"></i>',
                    next: '<i class="las la-angle-right"></i>',
                    last: '<i class="las la-angle-double-right"></i>'
                },
                processing: '<div class="spinner-border spinner-border-sm text-warning" role="status"></div> Memuat data invoice...'
            },
            initComplete: function() {
                syncInvoiceFooter();
            },
            drawCallback: function() {
                $('#btnToggleAllRows').text('Buka Semua Rincian');
                syncInvoiceFooter();

                // Fade-in completed: remove reloading overlay
                $('#scroll-horizontal').removeClass('dataTable-reloading');

                // Adjust dropup direction for bottom 3 rows
                var totalRows = $('#scroll-horizontal tbody tr').length;
                $('#scroll-horizontal tbody tr').each(function(index) {
                    var dropdown = $(this).find('.tokabe-action-dropdown');
                    if (index >= totalRows - 3 && totalRows > 4) {
                        dropdown.addClass('dropup');
                    } else {
                        dropdown.removeClass('dropup');
                    }
                });
            }
        });

        // Smooth Page Exit on Pagination Click
        $(document).on('click', '.dataTables_paginate .page-link, .dataTables_paginate .paginate_button', function() {
            var $parent = $(this).closest('li.page-item');
            if ($parent.hasClass('disabled') || $parent.hasClass('active') || $(this).hasClass('disabled') || $(this).hasClass('current')) {
                return;
            }
            $('#scroll-horizontal').addClass('dataTable-reloading');
        });

        // Search Input with Debounce (§6)
        $('#ibkCustomSearchInput').on('input', function() {
            var val = $(this).val();
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(function() {
                if (invoiceTable) {
                    invoiceTable.search(val).draw();
                }
            }, 300);
        });

        // Row Click or Chevron Click
        $(document).on('click', '.tokabe-row-toggle, .tokabe-desc-more, .tokabe-desc-less', function(e) {
            e.stopPropagation();
            toggleRowDesc(this);
        });

        $(document).on('click', '#scroll-horizontal tbody tr', function(e) {
            if ($(e.target).closest('a, button, select, input, textarea, .dropdown-menu, .tokabe-action-dropdown').length) {
                return;
            }
            if (window.getSelection && window.getSelection().toString().length > 0) {
                return;
            }
            toggleRowDesc(this);
        });

        // Sort Header Change Listener
        invoiceTable.on('order.dt', function() {
            var order = invoiceTable.order();
            var ths = $('#scroll-horizontal thead th');
            ths.removeClass('active-sort');
            if (order.length > 0) {
                var colIdx = order[0][0];
                var dir = order[0][1];
                var activeTh = $(ths[colIdx]);
                activeTh.addClass('active-sort');

                var label = 'Terbaru';
                if (colIdx === 4 && dir === 'desc') label = 'Terbaru';
                else if (colIdx === 4 && dir === 'asc') label = 'Terlama';
                else if (colIdx === 1 && dir === 'asc') label = 'ID (A-Z)';
                else if (colIdx === 1 && dir === 'desc') label = 'ID (Z-A)';
                else if (colIdx === 2 && dir === 'asc') label = 'Pelanggan (A-Z)';
                else if (colIdx === 11 && dir === 'desc') label = 'Total Terbesar';
                else if (colIdx === 11 && dir === 'asc') label = 'Total Terkecil';
                $('#currentSortLabel').text(label);
            }
        });

        // Ensure dropdown row is elevated above all subsequent rows so it is NEVER overlapped / tertimpa
        $(document).on('show.bs.dropdown', '.tokabe-action-dropdown', function () {
            $('.tokabe-invoice-table tbody tr, .tokabe-invoice-table tbody td').removeClass('tokabe-dropdown-open').css('z-index', '');
            
            var $tr = $(this).closest('tr');
            var $td = $(this).closest('td');
            $tr.addClass('tokabe-dropdown-open').css({'position': 'relative', 'z-index': '99999'});
            $td.addClass('tokabe-dropdown-open').css({'position': 'relative', 'z-index': '99999'});
        });

        $(document).on('hidden.bs.dropdown', '.tokabe-action-dropdown', function () {
            var $tr = $(this).closest('tr');
            var $td = $(this).closest('td');
            $tr.removeClass('tokabe-dropdown-open').css({'position': '', 'z-index': ''});
            $td.removeClass('tokabe-dropdown-open').css({'position': '', 'z-index': ''});
        });

        // Initial sync of pagination into dedicated custom footer
        setTimeout(syncInvoiceFooter, 50);
        setTimeout(syncInvoiceFooter, 200);
        setTimeout(syncInvoiceFooter, 500);
    });

    // Dedicated sync function to move pagination and info into .ibk-table-footer and eliminate ghost rows
    function syncInvoiceFooter() {
        var wrapper = $('#scroll-horizontal_wrapper');
        if (!wrapper.length) return;
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
        // Cleanly hide any empty bottom row leftover in DataTables wrapper
        wrapper.children('.row:last-child').each(function() {
            if ($(this).find('.dataTables_info, .dataTables_paginate').length === 0) {
                $(this).hide();
            }
        });
    }
</script>
@endsection
