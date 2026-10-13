@section('head')
<style>
/* ==========================================================================
   IBEKAMI DASHBOARD — DESIGN SYSTEM & TOKENS (Match Tokabe Modern Dark UI)
   ========================================================================== */

:root {
    /* 1. Surfaces & Backgrounds (Flat Dark Slate Palette) */
    --bg-app: #0C0F14;
    --bg-surface: #12161D;
    --bg-surface-2: #181D26;
    --bg-hover: rgba(255, 255, 255, 0.04);
    --bg-active: #242C38;

    /* 2. Borders (1px Precision, No Glow) */
    --border-subtle: #232A35;
    --border-default: #232A35;
    --border-strong: #2F3744;
    --border-focus: #6B73F0;

    /* 3. Typography Colors */
    --text-primary: #E8EBF0;
    --text-secondary: #9AA4B2;
    --text-tertiary: #6B7686;
    --text-disabled: #4A5361;

    /* 4. Single Accent Color (Indigo #6B73F0) */
    --brand: #6B73F0;
    --brand-hover: #7E85F4;
    --brand-pressed: #5A62DB;
    --brand-subtle: rgba(107, 115, 240, 0.12);
    --brand-border: rgba(107, 115, 240, 0.28);

    /* 5. Chart Second Series & Semantic Status (10-14% Alpha Tints) */
    --chart-series-2: #34C28B;

    --success: #34C28B;
    --success-subtle: rgba(52, 194, 139, 0.12);
    --success-border: rgba(52, 194, 139, 0.28);
    --success-text: #34C28B;

    --warning: #E3A33B;
    --warning-subtle: rgba(227, 163, 59, 0.12);
    --warning-border: rgba(227, 163, 59, 0.28);
    --warning-text: #E3A33B;

    --danger: #E5586B;
    --danger-subtle: rgba(229, 88, 107, 0.12);
    --danger-border: rgba(229, 88, 107, 0.28);
    --danger-text: #E5586B;

    --info: #5B9DF0;
    --info-subtle: rgba(91, 157, 240, 0.12);
    --info-border: rgba(91, 157, 240, 0.28);
    --info-text: #5B9DF0;

    /* 6. Radii & Shadows (Flat, Minimalist) */
    --radius-control: 8px;
    --radius-card: 12px;
    --radius-sm: 6px;
    --radius-full: 9999px;

    --shadow-dropdown: 0 8px 24px rgba(0, 0, 0, 0.45);
    --focus-ring: 0 0 0 2px rgba(107, 115, 240, 0.35);

    /* 7. Motion & Easing Tokens */
    --ease-out-expo: cubic-bezier(0.22, 1, 0.36, 1);
    --ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
    --dur-enter: 360ms;
    --dur-fast: 140ms;
}

/* Layout Background & Footer Consistency */
body,
#layout-wrapper,
.main-content,
.page-content {
    background-color: var(--bg-app) !important;
}

.footer {
    background-color: var(--bg-app) !important;
    color: var(--text-tertiary) !important;
    border-top: 1px solid var(--border-subtle) !important;
    box-shadow: none !important;
}

/* Base Dashboard Card */
#card-aktivitas-pembayaran,
#card-statistik-barang,
#card-hutang-vendor {
    background-color: var(--bg-surface) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-card) !important;
    color: #F1F5F9 !important;
    margin-bottom: 24px;
    box-shadow: none !important;
    transition: border-color var(--dur-fast) ease;
}
#card-aktivitas-pembayaran:hover,
#card-statistik-barang:hover,
#card-hutang-vendor:hover {
    border-color: var(--border-strong) !important;
}

#card-aktivitas-pembayaran .card-header,
#card-statistik-barang .card-header,
#card-hutang-vendor .card-header {
    background: transparent !important;
    padding: 20px 24px 16px 24px !important;
    border-bottom: 1px solid var(--border-subtle) !important;
}

/* High-Contrast Typography */
#card-aktivitas-pembayaran h4,
#card-aktivitas-pembayaran h5,
#card-statistik-barang h4,
#card-statistik-barang h5,
#card-hutang-vendor h4,
#card-hutang-vendor h5,
.card-title,
.section-title {
    color: #F8FAFC !important;
    font-weight: 600 !important;
}

#card-aktivitas-pembayaran .text-light,
#card-statistik-barang .text-light,
#card-hutang-vendor .text-light {
    color: #E2E8F0 !important;
}

#card-aktivitas-pembayaran .text-muted,
#card-statistik-barang .text-muted,
#card-hutang-vendor .text-muted {
    color: #94A3B8 !important;
}

/* Section Sub-panels */
.sub-panel {
    background: var(--bg-surface-2) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-card) !important;
}

/* Tabular Numerals */
.tabular-nums, .price, .num, td.numeric, th.numeric, .stat-value,
#hero-pendapatan-akumulasi, #pendapatan-akumulasi-val, #terbayar, #belumTerbayar, #batal,
#stat-item-qty, #stat-item-nominal, #stat-item-top, #stat-item-dominant-tax,
#tfoot-total-transaksi, #tfoot-total-qty, #tfoot-total-nominal {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
}

/* ==========================================================================
   SEGMENTED CONTROL (Tokabe Standard)
   ========================================================================== */
.segmented-control {
    display: inline-flex;
    align-items: center;
    background: var(--bg-surface-2);
    border: 1px solid var(--border-default);
    border-radius: var(--radius-control);
    padding: 3px;
    gap: 2px;
}
.segmented-item {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    padding: 5px 12px;
    border-radius: var(--radius-sm);
    font-size: 13px;
    font-weight: 500;
    line-height: 1.4;
    transition: color var(--dur-fast) ease, background var(--dur-fast) ease, transform 80ms ease;
    cursor: pointer;
    white-space: nowrap;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.segmented-item:hover {
    color: var(--text-primary);
    background: rgba(255, 255, 255, 0.04);
}
.segmented-item:active {
    transform: scale(0.98);
}
.segmented-item.active,
.segmented-item.btn-active {
    background: #4F46E5 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    border: 1px solid #6366F1 !important;
    box-shadow: 0 1px 4px rgba(79, 70, 229, 0.35) !important;
}

/* Legacy & Utility button support */
.dash-btn-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 32px;
    padding: 0 12px;
    font-size: 12px;
    font-weight: 500;
    border-radius: 8px;
    color: #94A3B8;
    background: #181D26;
    border: 1px solid #232A35;
    cursor: pointer;
    transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease, transform 80ms ease;
    user-select: none;
    white-space: nowrap;
}
.dash-btn-filter:hover {
    background: #232A35;
    color: #F1F5F9;
    border-color: #2F3744;
}
.dash-btn-filter:active {
    transform: scale(0.98);
}
.dash-btn-filter.active,
.dash-btn-filter.btn-active {
    background: #4F46E5 !important;
    color: #FFFFFF !important;
    border-color: #6366F1 !important;
    font-weight: 600 !important;
    box-shadow: 0 1px 4px rgba(79, 70, 229, 0.35) !important;
}

/* Custom Filter Submode Segmented Control (Match Tokabe / UI-UX-Pro-Max) */
.payment-segmented-control {
    display: inline-flex;
    align-items: center;
    background: #0E1218 !important;
    border: 1px solid #232A35 !important;
    border-radius: 8px !important;
    padding: 3px !important;
    gap: 2px !important;
}
.payment-segmented-control .payment-submode,
.payment-segmented-control .barang-submode {
    background: transparent !important;
    border: 1px solid transparent !important;
    color: #94A3B8 !important;
    padding: 4px 12px !important;
    height: 28px !important;
    border-radius: 6px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    line-height: 1.4 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    cursor: pointer !important;
    white-space: nowrap !important;
    text-decoration: none !important;
    transition: color var(--dur-fast) ease, background var(--dur-fast) ease, transform 80ms ease !important;
    box-shadow: none !important;
}
.payment-segmented-control .payment-submode:hover,
.payment-segmented-control .barang-submode:hover {
    color: #F1F5F9 !important;
    background: rgba(255, 255, 255, 0.05) !important;
}
.payment-segmented-control .payment-submode:active,
.payment-segmented-control .barang-submode:active {
    transform: scale(0.98);
}
.payment-segmented-control .payment-submode.active,
.payment-segmented-control .barang-submode.active {
    background: #1E2532 !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    color: #FFFFFF !important;
    font-weight: 600 !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

/* Payment & Barang Control Active Toggle */
.payment-ctrl, .barang-ctrl {
    display: none !important;
}
.payment-ctrl.active, .barang-ctrl.active {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}
input.payment-ctrl.active, input.barang-ctrl.active {
    display: inline-block !important;
}

/* Sticky Category Table Header */
#table-kategori-container {
    position: relative;
    max-height: 180px;
    overflow-y: auto;
}
#table-kategori-container table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}
#table-kategori-container thead th {
    position: sticky !important;
    top: 0 !important;
    z-index: 10 !important;
    background-color: #181D26 !important;
    color: var(--text-secondary, #94A3B8) !important;
    border-top: none !important;
    border-bottom: 1px solid var(--border-default, #232A35) !important;
    box-shadow: 0 1px 0 var(--border-default, #232A35) !important;
}

/* Custom Filter Button (Standalone with Chevron) */
.btn-custom-filter {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--bg-surface-2);
    color: var(--text-secondary);
    border: 1px solid var(--border-default);
    border-radius: var(--radius-control);
    padding: 5px 12px;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.4;
    transition: all var(--dur-fast) ease;
    cursor: pointer;
}
.btn-custom-filter:hover {
    color: var(--text-primary);
    border-color: var(--border-strong);
    background: rgba(255, 255, 255, 0.04);
}
.btn-custom-filter.active,
.btn-custom-filter.open {
    background: var(--brand-subtle);
    border-color: var(--brand-border);
    color: #ffffff;
}
.chevron-rotate {
    transition: transform 200ms var(--ease-out-expo);
}
.btn-custom-filter.open .chevron-rotate {
    transform: rotate(180deg);
}

/* Collapsible Filter Panel */
.custom-filter-panel, .dash-filter-panel {
    background: var(--bg-surface-2) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-control) !important;
    animation: filterSlideDown 220ms var(--ease-out-expo);
}
@keyframes filterSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Custom Form Controls */
.dash-input, .dash-select {
    background: var(--bg-surface) !important;
    color: var(--text-primary) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-control) !important;
    font-size: 13px !important;
    padding: 5px 10px !important;
    transition: border-color var(--dur-fast) ease, box-shadow var(--dur-fast) ease;
}
.dash-input:focus, .dash-select:focus {
    border-color: var(--brand) !important;
    outline: none !important;
    box-shadow: var(--focus-ring) !important;
}
.dash-select option {
    background: var(--bg-surface-2);
    color: var(--text-primary);
}

/* Single Accent Primary Button */
.btn-dash-primary {
    background: var(--brand) !important;
    color: #ffffff !important;
    border: 1px solid var(--brand-hover) !important;
    border-radius: var(--radius-control) !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    padding: 5px 14px !important;
    transition: background var(--dur-fast) ease, transform 80ms ease !important;
}
.btn-dash-primary:hover {
    background: var(--brand-hover) !important;
}
.btn-dash-primary:active {
    background: var(--brand-pressed) !important;
    transform: scale(0.98);
}

/* Stat Typography Tokens */
.stat-box {
    background: var(--bg-surface-2) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-card) !important;
    padding: 18px 20px !important;
    transition: border-color var(--dur-fast) ease, transform var(--dur-fast) var(--ease-out-expo);
}
.stat-box:hover {
    border-color: var(--border-strong) !important;
    transform: translateY(-2px);
}
.stat-overline {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-tertiary);
    margin-bottom: 6px;
}
.stat-value-big {
    font-size: 26px;
    font-weight: 700;
    line-height: 1.2;
    color: #ffffff;
    margin-bottom: 4px;
}

/* Table Design (Dark Slate) */
.dash-table-wrapper {
    background: var(--bg-surface-2);
    border: 1px solid var(--border-default);
    border-radius: var(--radius-card);
    overflow: hidden;
}
.dash-table {
    color: #F1F5F9;
    margin-bottom: 0;
    width: 100%;
}
.dash-table thead th {
    background: #12161D !important;
    color: #CBD5E1 !important;
    border-bottom: 1px solid var(--border-default) !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    letter-spacing: 0.06em !important;
    text-transform: uppercase !important;
    padding: 12px 14px !important;
}
.dash-table tbody tr {
    height: 48px;
    background: #181D26 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: background-color var(--dur-fast) ease;
}
.dash-table tbody tr:hover {
    background-color: #232A35 !important;
}
.dash-table tbody td {
    color: #F1F5F9 !important;
    padding: 10px 14px;
    font-size: 13px;
    vertical-align: middle;
}
.dash-table tbody tr:hover td {
    color: #FFFFFF !important;
}
.dash-table tfoot td {
    color: #FFFFFF !important;
    background: #12161D !important;
    border-top: 2px solid var(--border-strong) !important;
    padding: 12px 14px;
    font-size: 13px;
    font-weight: 600;
}

/* Subtle Status Pills & Badges (10-14% Alpha) */
.badge-tint, .dash-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 500;
    border-radius: var(--radius-sm);
    line-height: 1.3;
}
.badge-tint-success, .dash-badge--success {
    background: var(--success-subtle) !important;
    color: var(--success-text) !important;
    border: 1px solid var(--success-border) !important;
}
.badge-tint-warning, .dash-badge--warning {
    background: var(--warning-subtle) !important;
    color: var(--warning-text) !important;
    border: 1px solid var(--warning-border) !important;
}
.badge-tint-neutral, .dash-badge--neutral {
    background: rgba(107, 118, 134, 0.12) !important;
    color: var(--text-secondary) !important;
    border: 1px solid rgba(107, 118, 134, 0.25) !important;
}
.badge-tint-danger, .dash-badge--danger {
    background: var(--danger-subtle) !important;
    color: var(--danger-text) !important;
    border: 1px solid var(--danger-border) !important;
}
.badge-tint-brand, .dash-badge--brand {
    background: var(--brand-subtle) !important;
    color: #A5B4FC !important;
    border: 1px solid var(--brand-border) !important;
}

/* Apexcharts Theme Override */
.apexcharts-legend-text,
.apexcharts-text {
    fill: var(--text-tertiary) !important;
    color: var(--text-tertiary) !important;
    font-family: inherit !important;
}
.apexcharts-tooltip.apexcharts-theme-dark {
    background: var(--bg-surface-2) !important;
    border: 1px solid var(--border-default) !important;
    border-radius: var(--radius-control) !important;
    box-shadow: var(--shadow-dropdown) !important;
    color: var(--text-primary) !important;
    padding: 4px 6px;
}
.apexcharts-grid line {
    stroke: var(--border-subtle) !important;
}

/* Animations */
@keyframes motionEnter {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.motion-card-1 {
    animation: motionEnter var(--dur-enter) var(--ease-out-expo) 0ms both;
}
.motion-card-2 {
    animation: motionEnter var(--dur-enter) var(--ease-out-expo) 70ms both;
}
.motion-card-3 {
    animation: motionEnter var(--dur-enter) var(--ease-out-expo) 140ms both;
}

@media (prefers-reduced-motion: reduce) {
    *, ::before, ::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

/* ==========================================================================
   STATISTIK BARANG - SUMMARY KPI CARDS (4 BAGIAN JADI CARD)
   ========================================================================== */
.dash-summary-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    padding: 16px 18px !important;
    transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1) !important;
    position: relative;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
}

.dash-summary-card:hover {
    background: #1A2436 !important;
    border-color: #3B4B66 !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35) !important;
}

.dash-kpi-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    padding: 18px 20px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
    transition: all 0.2s ease !important;
}

.dash-kpi-card:hover {
    border-color: #3B4B66 !important;
}

.dash-kpi-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

.dash-summary-card:hover .dash-kpi-icon {
    transform: scale(1.08);
}

.dash-kpi-label {
    font-size: 11.5px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    color: #94A3B8 !important;
    margin-bottom: 4px !important;
    line-height: 1.2 !important;
    display: block;
}

.dash-kpi-val {
    font-size: 19px !important;
    font-weight: 700 !important;
    line-height: 1.25 !important;
    margin-bottom: 0 !important;
    letter-spacing: -0.01em !important;
}
</style>
@endsection

@extends('layout.template')
@section('content')

{{--
    @extends('layout.menu')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    @section('content')
    <div class="main-content">


        {{-- @extends('layout.pagetitle') --}}

        <div class="page-content">
         <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard Ibekami</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
              </div>
                    <!-- end row -->

                    <!-- KARTU GABUNGAN: AKTIVITAS PEMBAYARAN & STRUKTUR STATUS PEMBAYARAN -->
                    <div class="row motion-card-1">
                        <div class="col-12">
                            <div class="card" id="card-aktivitas-pembayaran">
                                <div class="card-header border-0 pb-0">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div>
                                            <h4 class="card-title mb-1 d-flex align-items-center">
                                                <i class="ri-line-chart-line me-2 fs-20" style="color: var(--brand);"></i>
                                                Aktivitas Pembayaran & Struktur Status
                                            </h4>
                                            <p class="text-muted mb-0 fs-13">
                                                Visualisasi arus penerimaan kas masuk serta perbandingan status pelunasan invoice
                                            </p>
                                        </div>

                                        <!-- Filter Toolbar with Segmented Control & Custom Filter -->
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <div class="segmented-control" role="group">
                                                <button type="button" class="segmented-item tombol" onclick="timeFrame('day')" id="btn-day" title="Filter Hari Ini">
                                                    Hari Ini
                                                </button>
                                                <button type="button" class="segmented-item tombol" onclick="timeFrame('week')" id="btn-week" title="Filter Minggu Ini">
                                                    Minggu Ini
                                                </button>
                                                <button type="button" class="segmented-item tombol" onclick="timeFrame('month')" id="btn-month" title="Filter Bulan Ini">
                                                    Bulan Ini
                                                </button>
                                                <button type="button" class="segmented-item tombol active" onclick="timeFrame('year')" id="btn-year" title="Filter Tahun Ini">
                                                    Tahun Ini
                                                </button>
                                                <button type="button" class="segmented-item tombol" onclick="timeFrame('lastYear')" id="btn-lastYear" title="Filter Tahun Lalu">
                                                    Tahun Lalu
                                                </button>
                                            </div>

                                            <button type="button" class="btn-custom-filter" onclick="togglePaymentCustomFilter()" id="btn-payment-custom-toggle" title="Filter Khusus Tanggal, Bulan, atau Rentang">
                                                <i class="ri-filter-3-line"></i> Filter Kustom <i class="ri-arrow-down-s-line chevron-rotate" id="icon-toggle-payment-custom"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Panel Filter Kustom Payment Activity & Structure (Horizontal Single-Line Toolbar matching UI-UX-Pro-Max) -->
                                    <div id="panel-custom-filter-payment" class="mt-3 custom-filter-panel d-flex flex-wrap align-items-center" style="display: none !important; background: #12161D; border: 1px solid #232A35; border-radius: 10px; padding: 8px 16px; gap: 12px;">
                                        <div class="d-flex align-items-center me-1" style="color: #94A3B8;">
                                            <i class="ri-filter-3-fill me-1" style="color: #6366F1; font-size: 15px;"></i>
                                            <span class="text-uppercase fs-12 fw-bold" style="letter-spacing: 0.06em; color: #94A3B8;">PILIH SPESIFIK:</span>
                                        </div>

                                        <!-- Submode segmented buttons (Unified container matching Tokabe) -->
                                        <div class="segmented-control payment-segmented-control" id="payment-submode-group" role="group">
                                            <button type="button" class="segmented-item payment-submode active" id="btn-payment-mode-date" data-mode="date" onclick="setPaymentSubmode('date')">
                                                <i class="ri-calendar-line"></i> Tanggal
                                            </button>
                                            <button type="button" class="segmented-item payment-submode" id="btn-payment-mode-month" data-mode="month" onclick="setPaymentSubmode('month')">
                                                <i class="ri-calendar-line"></i> Bulan
                                            </button>
                                            <button type="button" class="segmented-item payment-submode" id="btn-payment-mode-year" data-mode="year" onclick="setPaymentSubmode('year')">
                                                <i class="ri-calendar-line"></i> Tahun
                                            </button>
                                            <button type="button" class="segmented-item payment-submode" id="btn-payment-mode-range" data-mode="range" onclick="setPaymentSubmode('range')">
                                                Rentang
                                            </button>
                                        </div>

                                        <!-- Inline Inputs -->
                                        <div class="d-inline-flex align-items-center gap-2" id="payment-inputs-container">
                                            <!-- Date mode -->
                                            <input type="date" id="payment-input-date" class="form-control form-control-sm dash-input payment-ctrl active" style="width: 145px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">

                                            <!-- Month mode -->
                                            <div id="payment-ctrl-month" class="payment-ctrl">
                                                <select id="payment-input-bulan" class="form-select form-select-sm dash-select" style="width: 125px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <select id="payment-input-tahun-month" class="form-select form-select-sm dash-select" style="width: 90px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Year mode -->
                                            <div id="payment-ctrl-year" class="payment-ctrl">
                                                <select id="payment-input-year" class="form-select form-select-sm dash-select" style="width: 100px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Range mode -->
                                            <div id="payment-ctrl-range" class="payment-ctrl">
                                                <input type="date" id="payment-range-start" class="form-control form-control-sm dash-input" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-01') }}">
                                                <span class="text-muted fs-12">s/d</span>
                                                <input type="date" id="payment-range-end" class="form-control form-control-sm dash-input" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <!-- Tampilkan button -->
                                        <button type="button" class="btn btn-dash-primary d-inline-flex align-items-center" id="btn-apply-payment-custom-filter" onclick="submitPaymentCustomFilter()" style="background: #6366F1 !important; border: 1px solid #7175F3 !important; color: #FFFFFF !important; height: 34px; padding: 0 16px; border-radius: 8px; font-size: 13px; font-weight: 600; box-shadow: 0 2px 6px rgba(99, 102, 241, 0.25);">
                                            <i class="ri-search-line me-1 fs-14"></i> Tampilkan
                                        </button>

                                        <!-- Close button -->
                                        <button type="button" class="btn btn-link p-0 ms-auto text-decoration-none d-inline-flex align-items-center" onclick="togglePaymentCustomFilter()" title="Tutup Filter Khusus" style="color: #6366F1; line-height: 1;">
                                            <i class="ri-close-line fs-20" style="color: #6366F1;"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body pt-3 pb-3">
                                    <div class="row g-4">
                                        <!-- Kolom Kiri: Bar Chart Tren Pendapatan (8 Kolom) -->
                                        <div class="col-xl-8 col-lg-7 border-end-xl" style="border-color: var(--border-subtle) !important;">
                                            <div class="row gy-3 align-items-center mb-3">
                                                @if (auth()->user()->role === 'Pemilik')
                                                    <div class="col-md-5">
                                                        <p class="stat-overline mb-1">
                                                            PENDAPATAN AKUMULASI (S/D {{ strtoupper(\Carbon\Carbon::now()->locale('id')->isoFormat('DD MMM YYYY')) }})
                                                        </p>
                                                        <h3 class="fw-bold mb-0 tabular-nums text-white" style="font-size: 30px;" id="hero-pendapatan-akumulasi">Rp {{$jumlahPerTahun}}</h3>
                                                        <span id="pendapatan-akumulasi-val" class="d-none">Rp {{$jumlahPerTahun}}</span>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="p-3 rounded-3 border tabular-nums sub-panel" id="harga">
                                                            Memuat rincian transaksi...
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        <p class="stat-overline mb-1">Hutang Belum Lunas (Tahun Ini)</p>
                                                        <h4 class="fs-22 fw-bold mb-0 tabular-nums" style="color: var(--warning);">Rp {{$jumlahBBPerTahun}}</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="stat-overline mb-1">Hutang Belum Lunas (Bulan Ini)</p>
                                                        <h4 class="fs-22 fw-bold mb-0 tabular-nums" style="color: var(--danger);">Rp {{$jumlahBBPerBulan}}</h4>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <i class="ri-bar-chart-2-line me-1 fs-16" style="color: var(--chart-series-2);"></i>
                                                    <span class="fw-semibold text-light fs-13">Tren Arus Penerimaan Kas</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="fs-12 text-muted" id="badge-payment-period-text">Tahun Ini</span>
                                                    <span class="d-none" id="tag-periode-kas">Tahun Ini</span>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <span class="d-inline-flex align-items-center fs-12 text-muted">
                                                            <span class="d-inline-block rounded-circle me-1" style="width: 8px; height: 8px; background-color: var(--brand);"></span> Pendapatan Bersih
                                                        </span>
                                                        <span class="d-inline-flex align-items-center fs-12 text-muted">
                                                            <span class="d-inline-block rounded-circle me-1" style="width: 8px; height: 8px; background-color: var(--chart-series-2);"></span> Pendapatan Asli
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="stacked_column_chart" class="apex-charts" data-colors='["#6B73F0", "#34C28B"]' dir="ltr"></div>
                                        </div>

                                        <!-- Kolom Kanan: Donut Chart Struktur Status Pembayaran (4 Kolom) -->
                                        <div class="col-xl-4 col-lg-5 ps-xl-3 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom" style="border-color: var(--border-subtle) !important;">
                                                    <h5 class="fs-15 mb-0 fw-semibold" style="color: #F8FAFC !important;">
                                                        <i class="ri-time-line me-1" style="color: var(--brand);"></i> Struktur Status Pembayaran
                                                    </h5>
                                                    <span class="badge-tint badge-tint-neutral" id="periode">
                                                        Tahun Ini
                                                    </span>
                                                </div>

                                                <div id="structure_widget" data-colors='["#34C28B", "#E3A33B", "#6B7686"]' class="apex-charts" dir="ltr"></div>
                                                <div id="structure_widget_empty" class="text-center py-4 my-3 text-muted" style="display: none;">
                                                    <i class="ri-pie-chart-line fs-36 d-block mb-2" style="opacity: 0.4; color: #94A3B8;"></i>
                                                    <span class="fs-12 d-block text-secondary">Belum ada transaksi pembayaran pada periode ini.</span>
                                                </div>
                                            </div>

                                            <div class="px-1 pt-2 mt-auto">
                                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                                                    <div class="d-flex align-items-center">
                                                        <span class="d-inline-block rounded-circle me-2" style="width: 8px; height: 8px; background: var(--success);"></span>
                                                        <span class="fs-13 fw-medium" style="color: #E2E8F0 !important;">Terbayar</span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-bold fs-13 tabular-nums" style="color: #FFFFFF !important;" id="terbayar">Rp 0</span>
                                                        <span class="badge-tint badge-tint-success" id="persenTerbayar">0.00%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                                                    <div class="d-flex align-items-center">
                                                        <span class="d-inline-block rounded-circle me-2" style="width: 8px; height: 8px; background: var(--warning);"></span>
                                                        <span class="fs-13 fw-medium" style="color: #E2E8F0 !important;">Belum Bayar</span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-bold fs-13 tabular-nums" style="color: #FFFFFF !important;" id="belumTerbayar">Rp 0</span>
                                                        <span class="badge-tint badge-tint-warning" id="persenBlmTerbayar">0.00%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-2">
                                                    <div class="d-flex align-items-center">
                                                        <span class="d-inline-block rounded-circle me-2" style="width: 8px; height: 8px; background: #6B7686;"></span>
                                                        <span class="fs-13 fw-medium" style="color: #E2E8F0 !important;">Batal</span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-bold fs-13 tabular-nums" style="color: #CBD5E1 !important;" id="batal">Rp 0</span>
                                                        <span class="badge-tint badge-tint-neutral" id="persenBatal">0.00%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- SECTION: GRAFIK JENIS & KATEGORI BARANG YANG DIBELI DENGAN FILTER -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card" id="card-statistik-barang">
                                <div class="card-header border-0 pb-1">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <div>
                                            <h4 class="card-title mb-1 d-flex align-items-center">
                                                <i class="ri-bar-chart-grouped-line text-primary me-2 fs-20"></i>
                                                Statistik Jenis & Kategori Barang yang Dibeli
                                            </h4>
                                            <p class="text-muted mb-0 fs-13">
                                                Analisis produk terlaris dan proporsi kategori barang berdasarkan transaksi invoice penjualan
                                            </p>
                                        </div>

                                        <!-- Filter Preset Buttons (Matching Card 1) -->
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="segmented-control" role="group">
                                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('today', this)" id="btn-barang-today" title="Filter Hari Ini">
                                                    Hari Ini
                                                </button>
                                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('week', this)" id="btn-barang-week" title="Filter Minggu Ini">
                                                    Minggu Ini
                                                </button>
                                                <button type="button" class="segmented-item btn-filter-barang active" onclick="filterBarang('month', this)" id="btn-barang-month" title="Filter Bulan Ini">
                                                    Bulan Ini
                                                </button>
                                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('year', this)" id="btn-barang-year" title="Filter Tahun Ini">
                                                    Tahun Ini
                                                </button>
                                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('last_year', this)" id="btn-barang-lastyear" title="Filter Tahun Lalu">
                                                    Tahun Lalu
                                                </button>
                                            </div>

                                            <button type="button" class="btn-custom-filter" onclick="toggleCustomFilter()" id="btn-barang-custom" title="Filter Khusus Tanggal, Bulan, atau Rentang">
                                                <i class="ri-filter-3-line"></i> Filter Kustom <i class="ri-arrow-down-s-line chevron-rotate" id="icon-toggle-custom"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Panel Filter Kustom Statistik Barang (Horizontal Single-Line Toolbar matching UI-UX-Pro-Max) -->
                                    <div id="panel-custom-filter" class="mt-3 custom-filter-panel d-flex flex-wrap align-items-center" style="display: none !important; background: #12161D; border: 1px solid #232A35; border-radius: 10px; padding: 8px 16px; gap: 12px;">
                                        <div class="d-flex align-items-center me-1" style="color: #94A3B8;">
                                            <i class="ri-filter-3-fill me-1" style="color: #6366F1; font-size: 15px;"></i>
                                            <span class="text-uppercase fs-12 fw-bold" style="letter-spacing: 0.06em; color: #94A3B8;">PILIH SPESIFIK:</span>
                                        </div>

                                        <!-- Submode segmented buttons -->
                                        <div class="segmented-control payment-segmented-control" id="barang-submode-group" role="group">
                                            <button type="button" class="segmented-item barang-submode active" id="btn-barang-mode-date" data-mode="date" onclick="setBarangSubmode('date')">
                                                <i class="ri-calendar-line"></i> Tanggal
                                            </button>
                                            <button type="button" class="segmented-item barang-submode" id="btn-barang-mode-month" data-mode="month" onclick="setBarangSubmode('month')">
                                                <i class="ri-calendar-line"></i> Bulan
                                            </button>
                                            <button type="button" class="segmented-item barang-submode" id="btn-barang-mode-year" data-mode="year" onclick="setBarangSubmode('year')">
                                                <i class="ri-calendar-line"></i> Tahun
                                            </button>
                                            <button type="button" class="segmented-item barang-submode" id="btn-barang-mode-range" data-mode="range" onclick="setBarangSubmode('range')">
                                                Rentang
                                            </button>
                                        </div>

                                        <!-- Inline Inputs -->
                                        <div class="d-inline-flex align-items-center gap-2" id="barang-inputs-container">
                                            <!-- Date mode -->
                                            <input type="date" id="barang-input-date" class="form-control form-control-sm dash-input barang-ctrl active" style="width: 145px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">

                                            <!-- Month mode -->
                                            <div id="barang-ctrl-month" class="barang-ctrl">
                                                <select id="barang-input-bulan" class="form-select form-select-sm dash-select" style="width: 125px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <select id="barang-input-tahun-month" class="form-select form-select-sm dash-select" style="width: 90px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Year mode -->
                                            <div id="barang-ctrl-year" class="barang-ctrl">
                                                <select id="barang-input-year" class="form-select form-select-sm dash-select" style="width: 100px; height: 34px; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px;">
                                                    @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Range mode -->
                                            <div id="barang-ctrl-range" class="barang-ctrl">
                                                <input type="date" id="barang-range-start" class="form-control form-control-sm dash-input" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-01') }}">
                                                <span class="text-muted fs-12">s/d</span>
                                                <input type="date" id="barang-range-end" class="form-control form-control-sm dash-input" style="width: 140px; height: 34px; color-scheme: dark; background: #0E1218; border: 1px solid #28313E; border-radius: 8px; color: #F1F5F9; font-size: 13px; padding: 4px 10px;" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <!-- Tampilkan button -->
                                        <button type="button" class="btn btn-dash-primary d-inline-flex align-items-center" id="btn-apply-barang-custom" onclick="applyCustomFilter()" style="background: #6366F1 !important; border: 1px solid #7175F3 !important; color: #FFFFFF !important; height: 34px; padding: 0 16px; border-radius: 8px; font-size: 13px; font-weight: 600; box-shadow: 0 2px 6px rgba(99, 102, 241, 0.25);">
                                            <i class="ri-search-line me-1 fs-14"></i> Tampilkan
                                        </button>

                                        <!-- Close button -->
                                        <button type="button" class="btn btn-link p-0 ms-auto text-decoration-none d-inline-flex align-items-center" onclick="toggleCustomFilter()" title="Tutup Filter Khusus" style="color: #6366F1; line-height: 1;">
                                            <i class="ri-close-line fs-20" style="color: #6366F1;"></i>
                                        </button>
                                    </div>

                                    <!-- Active Filter Banner & Status -->
                                    <div class="d-flex align-items-center justify-content-between mt-3 pt-2" style="border-top: 1px solid var(--dash-border-subtle);">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted fs-13 me-2">Periode Aktif:</span>
                                            <span class="dash-badge dash-badge--brand fs-12" id="badge-periode-barang">
                                                <i class="ri-calendar-event-line align-middle me-1"></i> <span id="label-periode-barang">Memuat data...</span>
                                            </span>
                                        </div>
                                        <div id="spinner-barang" class="spinner-border spinner-border-sm text-primary" role="status" style="display: none;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Cards Section (KPI) -->
                                <div class="card-body pt-2 pb-3">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="dash-summary-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="dash-kpi-icon" style="background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.35); color: #818CF8;">
                                                        <i class="ri-shopping-bag-3-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <span class="dash-kpi-label">Total Qty Terjual</span>
                                                        <h4 class="dash-kpi-val text-white tabular-nums text-truncate" id="summary-total-qty">0 Pcs</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="dash-summary-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="dash-kpi-icon" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #34D399;">
                                                        <i class="ri-money-dollar-circle-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <span class="dash-kpi-label">Nilai Penjualan</span>
                                                        <h4 class="dash-kpi-val text-success tabular-nums text-truncate" id="summary-total-nominal">Rp 0</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="dash-summary-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="dash-kpi-icon" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.35); color: #FBBF24;">
                                                        <i class="ri-trophy-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <span class="dash-kpi-label">Jenis Terpopuler</span>
                                                        <h4 class="dash-kpi-val text-white text-truncate fs-15" id="summary-top-jenis" title="-">-</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-3">
                                            <div class="dash-summary-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="dash-kpi-icon" style="background: rgba(14, 165, 233, 0.15); border: 1px solid rgba(14, 165, 233, 0.35); color: #38BDF8;">
                                                        <i class="ri-folders-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <span class="dash-kpi-label">Kategori Terlaris</span>
                                                        <h4 class="dash-kpi-val text-white text-truncate fs-15" id="summary-top-kategori" title="-">-</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Charts Row: Jenis Barang & Kategori Barang -->
                                    <div class="row g-3">
                                        <!-- Chart 1: Jenis Barang (Top 10) -->
                                        <div class="col-xl-7">
                                            <div class="dash-kpi-card h-100">
                                                <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--dash-border-subtle);">
                                                    <h5 class="fs-15 mb-0 fw-semibold text-truncate text-light">
                                                        <i class="ri-bar-chart-fill text-primary me-1"></i> Grafik Jenis Barang yang Dibeli (Top 10)
                                                    </h5>
                                                    <div class="segmented-control" role="group">
                                                        <button type="button" class="segmented-item active" id="btn-metric-qty" onclick="switchJenisMetric('qty')">Qty (Pcs)</button>
                                                        <button type="button" class="segmented-item" id="btn-metric-nominal" onclick="switchJenisMetric('nominal')">Nilai (Rp)</button>
                                                    </div>
                                                </div>
                                                <div id="chart_jenis_empty" class="text-center py-5 text-muted" style="display: none;">
                                                    <i class="ri-inbox-line fs-36 text-secondary d-block mb-2"></i>
                                                    <span class="fs-14">Tidak ada data transaksi jenis barang pada periode ini.</span>
                                                </div>
                                                <div id="chart_jenis_barang" class="apex-charts" style="min-height: 380px;"></div>
                                            </div>
                                        </div>

                                        <!-- Chart 2: Kategori Barang (Donut & Table) -->
                                        <div class="col-xl-5">
                                            <div class="dash-kpi-card h-100 d-flex flex-column">
                                                <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--dash-border-subtle);">
                                                    <h5 class="fs-15 mb-0 fw-semibold text-truncate text-light">
                                                        <i class="ri-pie-chart-2-fill text-info me-1"></i> Grafik Kategori Barang
                                                    </h5>
                                                    <span class="dash-badge dash-badge--neutral" id="badge-total-kategori">0 Kategori</span>
                                                </div>
                                                <div id="chart_kategori_empty" class="text-center py-5 text-muted" style="display: none;">
                                                    <i class="ri-inbox-line fs-36 text-secondary d-block mb-2"></i>
                                                    <span class="fs-14">Tidak ada data transaksi kategori pada periode ini.</span>
                                                </div>
                                                <div id="chart_kategori_barang" class="apex-charts" style="min-height: 290px;"></div>

                                                <!-- Table Rincian Kategori -->
                                                <div class="table-responsive dash-scroll mt-auto pt-2" id="table-kategori-container" style="max-height: 180px; overflow-y: auto;">
                                                    <table class="table dash-table table-nowrap align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Kategori</th>
                                                                <th class="text-end">Qty</th>
                                                                <th class="text-end">Nilai (Rp)</th>
                                                                <th class="text-end">%</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table-kategori-body" class="fs-12">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SECTION GRAFIK JENIS & KATEGORI -->
                    <!-- END SECTION GRAFIK JENIS & KATEGORI -->

                    <div class="row">
                        <!-- SECTION HUTANG PEMBELIAN VENDOR & DAFTAR TAGIHAN (1 FRAME) -->
                        <div class="col-12">
                            <div class="card" id="card-hutang-vendor">
                                <div class="card-header border-0 align-items-center d-flex flex-wrap gap-2 justify-content-between pb-2 pt-3">
                                    <div>
                                        <h4 class="card-title mb-1 d-flex align-items-center">
                                            <span class="avatar-title bg-info-subtle text-info rounded p-1 me-2 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="ri-shopping-bag-3-fill fs-16"></i>
                                            </span>
                                            <span id="pembelian-chart-title">Grafik Pembelian belum Dibayar per Vendor</span>
                                        </h4>
                                        <p class="text-muted mb-0 fs-13" id="pembelian-chart-subtitle">
                                            Ringkasan sisa tagihan pembelian belum dibayar per nama vendor.
                                        </p>
                                    </div>
                                </div>

                                <div class="card-body pt-1">
                                    <div class="row g-3">
                                        <!-- Kolom Kiri: Grafik Sisa Hutang Vendor -->
                                        <div class="col-xl-7 pe-xl-3 border-end" style="border-color: var(--dash-border-subtle) !important;">

                                            <!-- Grafik Utama (Semua Vendor atau Global Jenis Invoice) -->
                                            <div id="chart-pembelian-invoice" class="apex-charts" dir="ltr" style="min-height: 400px;"></div>

                                            <!-- Wadah Dua Grafik Ketika Single Vendor Dipilih -->
                                            <div id="vendor-single-charts-container" class="d-none">
                                                <div class="row g-2">
                                                    <!-- Grafik 1: Status Pembayaran (3 Batang) -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="dash-kpi-card h-100 p-2.5">
                                                            <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid var(--dash-border-subtle);">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <i class="ri-bar-chart-2-line text-info fs-14"></i>
                                                                    <span class="fs-12 fw-semibold text-light ms-1">Status Pembayaran</span>
                                                                </div>
                                                                <span class="dash-badge dash-badge--neutral">Ringkasan</span>
                                                            </div>
                                                            <div id="chart-pembelian-single-status" class="apex-charts" dir="ltr"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Grafik 2: Detail vendor -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="dash-kpi-card h-100 p-2.5">
                                                            <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid var(--dash-border-subtle);">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <i class="ri-file-list-3-line text-primary fs-14"></i>
                                                                    <span class="fs-12 fw-semibold text-light ms-1">Jenis Invoice Digunakan</span>
                                                                </div>
                                                                <span class="dash-badge dash-badge--brand" id="badge-vendor-jenis-count">0 Jenis</span>
                                                            </div>
                                                            <div id="chart-pembelian-single-jenis" class="apex-charts" dir="ltr"></div>
                                                            <div id="chart-pembelian-single-jenis-empty" class="text-center text-muted py-5 fs-12 d-none">
                                                                Belum ada data jenis invoice untuk vendor ini.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="chart-pembelian-invoice-empty" class="text-center text-muted py-5 d-none">
                                                Belum ada data pembelian yang belum dibayar untuk filter ini.
                                            </div>
                                        </div>

                                        <!-- Kolom Kanan: Daftar Tagihan Vendor -->
                                        <div class="col-xl-5 ps-xl-3 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--dash-border-subtle);">
                                                    <h5 class="fs-14 mb-0 fw-semibold text-truncate text-light">
                                                        <i class="ri-file-list-3-line text-primary me-1"></i> Daftar Vendor
                                                    </h5>
                                                    <div class="d-flex align-items-center gap-1.5">
                                                        <div class="dash-segmented-group" aria-label="Filter status vendor">
                                                            <button type="button" class="dash-btn-filter active" id="btn-filter-belum-lunas" onclick="setVendorStatusFilter('belum_lunas')">Belum Lunas</button>
                                                            <button type="button" class="dash-btn-filter" id="btn-filter-lunas" onclick="setVendorStatusFilter('lunas')">Lunas</button>
                                                            <button type="button" class="dash-btn-filter" id="btn-filter-semua-status" onclick="setVendorStatusFilter('all')">Semua</button>
                                                        </div>
                                                        <button type="button" class="dash-btn-filter active" id="btnSemuaVendor" onclick="resetToAllVendors()" title="Tampilkan grafik semua vendor">
                                                            <i class="ri-bar-chart-fill me-1"></i> Semua Vendor
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="table-responsive dash-scroll" style="max-height: 400px; overflow-y: auto;">
                                                    <table class="table dash-table align-middle mb-0" id="tableDaftarVendor">
                                                        <thead class="text-uppercase" style="position: sticky; top: 0; z-index: 2;">
                                                            <tr>
                                                                <th scope="col" style="width: 45%;">Nama Vendor</th>
                                                                <th scope="col" class="text-end" style="width: 28%;">Total Beli</th>
                                                                <th scope="col" class="text-end" style="width: 27%;">Sisa Hutang</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="vendor-tagihan-tbody" class="fs-12">
                                                            <!-- Dynamic rows injected by renderVendorTable() -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                                    


                                    
{{--
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @extends('layout.footer')
        {{-- </div> --}}
        <!-- end main content-->
        @endsection


@section('plugins')
    <!-- apexcharts -->
    <script src="{{asset('libs/apexcharts/apexcharts.min.js')}}"></script>


    <!-- Dashboard init -->
    <script>
        const hourArrayJS = {!! json_encode($hourArray) !!};
        const dateArrayJS = {!! json_encode($dateArray) !!};
        const dateArrayLastYearJS = {!! json_encode($dateArrayLastYear) !!};
        const weekArrayJS = {!! json_encode($weekArray) !!};
        const monthArrayJS = {!! json_encode($monthArray) !!};
        const monthArrayLastYearJS = {!! json_encode($monthArrayLastYear) !!};
        const totalJamArrayJS = {!! json_encode($totalJamArray) !!};
        const totalHarianArrayJS = {!! json_encode($totalHarianArray) !!};
        const totalHarianLastYearArrayJS = {!! json_encode($totalHarianArrayLastYear) !!};
        const totalMingguanArrayJS = {!! json_encode($totalMingguanArray) !!};
        const totalBulananArrayJS = {!! json_encode($totalBulananArray) !!};
        const totalBulananArrayLastYearJS = {!! json_encode($totalBulananArrayLastYear) !!};
        const totalPerHari = {!! json_encode($jumlahPerHari) !!};
        const totalPerMinggu = {!! json_encode($jumlahPerMinggu) !!};
        const totalPerBulan = {!! json_encode($jumlahPerBulan) !!};
        const totalPerTahun = {!! json_encode($jumlahPerTahun) !!};
        // Week
        const datasWeekJS = {!! json_encode($datasInWeek) !!};
        const percentInWeekJS = {!! json_encode($percentageInWeek) !!};
        const percentNotPaidWeekJS = {!! json_encode($percentageNotPaidWeek) !!};
        const percentCanceledWeekJS = {!! json_encode($percentageCanceledWeek) !!};
        // Month
        const datasMonthJS = {!! json_encode($datasInMonth) !!};
        const percentInMonthJS = {!! json_encode($percentageInMonth) !!};
        const percentNotPaidMonthJS = {!! json_encode($percentageNotPaidMonth) !!};
        const percentCanceledMonthJS = {!! json_encode($percentageCanceledMonth) !!};
        // Year
        const datasYearJS = {!! json_encode($datasInYear) !!};
        const percentInYearJS = {!! json_encode($percentageInYear) !!};
        const percentNotPaidYearJS = {!! json_encode($percentageNotPaidYear) !!};
        const percentCanceledYearJS = {!! json_encode($percentageCanceledYear) !!};

// ✅ TAMBAHKAN BAGIAN INI (Last Year)
        const datasLastYearJS = {!! json_encode($datasInLastYear) !!};
        const percentInLastYearJS = {!! json_encode($percentageInLastYear) !!};
        const percentNotPaidLastYearJS = {!! json_encode($percentageNotPaidLastYear) !!};
        const percentCanceledLastYearJS = {!! json_encode($percentageCanceledLastYear) !!};
        //PO

        const hourArrayJSPO = {!! json_encode($hourArrayPO) !!};
        const dateArrayJSPO = {!! json_encode($dateArrayPO) !!};
        const weekArrayJSPO = {!! json_encode($weekArrayPO) !!};
        const monthArrayJSPO = {!! json_encode($monthArrayPO) !!};
        const totalJamArrayJSPO = {!! json_encode($totalJamArrayPO) !!};
        const totalHarianArrayJSPO = {!! json_encode($totalHarianArrayPO) !!};
        const totalMingguanArrayJSPO = {!! json_encode($totalMingguanArrayPO) !!};
        const totalBulananArrayJSPO = {!! json_encode($totalBulananArrayPO) !!};
        const totalPerHariPO = {!! json_encode($jumlahPerHariPO) !!};
        const totalPerMingguPO = {!! json_encode($jumlahPerMingguPO) !!};
        const totalPerBulanPO = {!! json_encode($jumlahPerBulanPO) !!};
        const totalPerTahunPO = {!! json_encode($jumlahPerTahunPO) !!};
       
        const lunasTodayPO = {!! json_encode($jumlahPOLunasToday) !!};
        const blmLunasTodayPO = {!! json_encode($jumlahPOBlmLunasToday) !!};

        const lunasWeekPO = {!! json_encode($jumlahPOLunasWeek) !!};
        const blmLunasWeekPO = {!! json_encode($jumlahPOBlmLunasWeek) !!};

        const lunasMonthPO = {!! json_encode($jumlahPOLunasMonth) !!};
        const blmLunasMonthPO = {!! json_encode($jumlahPOBlmLunasMonth) !!};

        const lunasYearPO = {!! json_encode($jumlahPOLunasYear) !!};
        const blmLunasYearPO = {!! json_encode($jumlahPOBlmLunasYear) !!};
        
        const namaVendor = {!! json_encode($datavendor) !!};
        const totalSisa = {!! json_encode($datasisa) !!};
        const allVendorData = {!! json_encode($vendorList) !!};
        const dataPembelianInvoiceJS = {!! json_encode($dataPembelianInvoice ?? []) !!};
        const daftarTagihanVendorJS = {!! json_encode($daftarTagihanVendor ?? []) !!};

        let pembelianInvoiceChart = null;
        let singleStatusChart = null;
        let singleJenisChart = null;
        let selectedVendorFilter = 'all';
        let vendorStatusFilter = 'belum_lunas';
        let pembelianGroupBy = 'vendor';

        function destroyAllPembelianCharts() {
            if (pembelianInvoiceChart) {
                pembelianInvoiceChart.destroy();
                pembelianInvoiceChart = null;
            }
            if (singleStatusChart) {
                singleStatusChart.destroy();
                singleStatusChart = null;
            }
            if (singleJenisChart) {
                singleJenisChart.destroy();
                singleJenisChart = null;
            }
        }

        function setPembelianGroupBy(mode) {
            pembelianGroupBy = mode;
            const titleEl = document.getElementById('pembelian-chart-title');
            const subEl = document.getElementById('pembelian-chart-subtitle');
            if (titleEl) {
                titleEl.textContent = mode === 'vendor' 
                    ? 'Grafik Pembelian belum Dibayar per Vendor'
                    : 'Grafik Pembelian berdasarkan Jenis Invoice';
            }
            if (subEl) {
                subEl.textContent = mode === 'vendor'
                    ? 'Ringkasan sisa tagihan pembelian belum dibayar per nama vendor.'
                    : 'Ringkasan transaksi pembelian belum dibayar ke vendor.';
            }
            renderPembelianInvoiceChart();
        }

        function resetToAllVendors() {
            if (pembelianGroupBy !== 'vendor') {
                pembelianGroupBy = 'vendor';
            }
            selectedVendorFilter = 'all';
            const titleEl = document.getElementById('pembelian-chart-title');
            const subEl = document.getElementById('pembelian-chart-subtitle');
            if (titleEl) {
                titleEl.textContent = 'Grafik Pembelian belum Dibayar per Vendor';
            }
            if (subEl) {
                subEl.textContent = 'Ringkasan sisa tagihan pembelian belum dibayar per nama vendor.';
            }
            renderPembelianInvoiceChart();
            renderVendorTable();
        }

        function toggleVendorFilter(vendorName) {
            if (pembelianGroupBy !== 'vendor') {
                setPembelianGroupBy('vendor');
            }
            if (selectedVendorFilter === vendorName) {
                selectedVendorFilter = 'all';
            } else {
                selectedVendorFilter = vendorName;
            }
            renderPembelianInvoiceChart();
            renderVendorTable();
        }

        function setVendorStatusFilter(status) {
            vendorStatusFilter = status;
            ['belum-lunas', 'lunas', 'semua-status'].forEach((name) => {
                const button = document.getElementById(`btn-filter-${name}`);
                if (!button) return;
                const isActive = (name === 'belum-lunas' && status === 'belum_lunas') ||
                                 (name === 'lunas' && status === 'lunas') ||
                                 (name === 'semua-status' && status === 'all');
                button.classList.toggle('active', isActive);
            });
            renderVendorTable();
        }

        function renderVendorTable() {
            const tbody = document.getElementById('vendor-tagihan-tbody');
            if (!tbody) return;

            const visibleVendors = (daftarTagihanVendorJS || []).filter((row) => {
                const isLunas = Number(row.sisa_tagihan) <= 0;
                return vendorStatusFilter === 'all' || (vendorStatusFilter === 'lunas' ? isLunas : !isLunas);
            });

            if (visibleVendors.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-muted">Tidak ada data tagihan vendor.</td></tr>`;
                return;
            }

            const currentSelected = selectedVendorFilter;
            const btnSemua = document.getElementById('btnSemuaVendor');
            if (btnSemua) {
                btnSemua.classList.toggle('active', currentSelected === 'all');
                if (currentSelected === 'all') {
                    btnSemua.innerHTML = '<i class="ri-bar-chart-fill me-1"></i> Semua Vendor';
                } else {
                    btnSemua.innerHTML = '<i class="ri-refresh-line me-1"></i> Semua Vendor';
                }
            }

            let html = '';
            visibleVendors.forEach((row) => {
                const isSelected = (currentSelected === row.nama_vendor);
                const formattedTotal = Number(row.total_pembelian).toLocaleString('id-ID');
                const formattedSisa = Number(row.sisa_tagihan).toLocaleString('id-ID');
                const escapedVendor = row.nama_vendor.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
                const isLunas = Number(row.sisa_tagihan) <= 0;

                html += `
                    <tr class="${isSelected ? 'table-active' : ''}" onclick="toggleVendorFilter('${escapedVendor}')" title="Klik untuk filter ${row.nama_vendor}" style="cursor: pointer;">
                        <td>
                            <p class="text-body fw-semibold align-middle mb-0 text-truncate" style="max-width: 170px;">${row.nama_vendor}</p>
                        </td>
                        <td class="text-end text-muted tabular-nums">
                            Rp ${formattedTotal}
                        </td>
                        <td class="text-end">
                            ${isLunas ? '<span class="dash-badge dash-badge--success">Lunas</span>' : '<span class="dash-badge dash-badge--danger tabular-nums">Rp ' + formattedSisa + '</span>'}
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
        }

        function renderPembelianInvoiceChart() {
            renderVendorTable();
            const filter = 'all';
            const jenisFilter = 'all';
            const vendorFilter = selectedVendorFilter;

            const singleContainer = document.getElementById('vendor-single-charts-container');
            const mainChartEl = document.getElementById('chart-pembelian-invoice');
            const emptyEl = document.getElementById('chart-pembelian-invoice-empty');
            // MODE 1: Single Vendor (Ketika vendor tertentu dipilih / diklik)
            if (pembelianGroupBy === 'vendor' && vendorFilter !== 'all') {
                const selectedVendor = daftarTagihanVendorJS.find(r => r.nama_vendor === vendorFilter);
                const totalPembelian = selectedVendor ? Number(selectedVendor.total_pembelian) || 0 : 0;
                const terbayar = selectedVendor ? Number(selectedVendor.terbayar) || 0 : 0;
                const sisa = selectedVendor ? Number(selectedVendor.sisa_tagihan) || 0 : 0;

                const singleValues = [totalPembelian, terbayar, sisa];
                const hasData = singleValues.some(v => v > 0);

                destroyAllPembelianCharts();

                if (emptyEl) emptyEl.classList.toggle('d-none', hasData);
                if (mainChartEl) mainChartEl.classList.add('d-none');

                if (!hasData) {
                    if (singleContainer) singleContainer.classList.add('d-none');
                    return;
                }

                if (singleContainer) singleContainer.classList.remove('d-none');

                // 1. Render Grafik 3 Batang: Status Pembayaran (Total Pembelian, Sudah Dibayar, Sisa Hutang)
                singleStatusChart = new ApexCharts(document.querySelector('#chart-pembelian-single-status'), {
                    chart: {
                        type: 'bar',
                        height: 285,
                        toolbar: { show: false },
                        animations: { enabled: true, speed: 300 }
                    },
                    plotOptions: {
                        bar: {
                            distributed: true,
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                            columnWidth: '45%',
                            dataLabels: { position: 'top' }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -20,
                        formatter: function (val) {
                            if (!val || val === 0) return 'Rp 0';
                            if (val >= 1000000000) return 'Rp ' + (val / 1000000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + ' M';
                            if (val >= 1000000) return 'Rp ' + (val / 1000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + ' Jt';
                            if (val >= 1000) return 'Rp ' + (val / 1000).toLocaleString('id-ID', { maximumFractionDigits: 0 }) + ' Rb';
                            return 'Rp ' + Number(val).toLocaleString('id-ID');
                        },
                        style: {
                            fontSize: '11px',
                            fontWeight: '600',
                            colors: ['#F1F5F9']
                        }
                    },
                    series: [{
                        name: 'Nominal',
                        data: singleValues
                    }],
                    xaxis: {
                        categories: ['Total Pembelian', 'Sudah Dibayar', 'Sisa Hutang'],
                        labels: {
                            rotate: -15,
                            rotateAlways: false,
                            style: { colors: '#94A3B8', fontSize: '11px', fontWeight: 500 }
                        },
                        axisBorder: { show: false },
                        axisTicks: { show: false }
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(0) + ' M';
                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(0) + ' Jt';
                                if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
                                return 'Rp ' + Number(value).toLocaleString('id-ID');
                            },
                            style: { colors: '#94A3B8', fontSize: '10px' }
                        }
                    },
                    grid: {
                        borderColor: '#1E293B',
                        strokeDashArray: 3
                    },
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function (value) {
                                return 'Rp ' + Number(value).toLocaleString('id-ID');
                            }
                        }
                    },
                    colors: ['#818CF8', '#34D399', '#F87171'],
                    legend: { show: false }
                });
                singleStatusChart.render();

                // 2. Render Grafik Berdasarkan Jenis Invoice Vendor yang Dipilih
                const vendorRows = dataPembelianInvoiceJS.filter(row => {
                    if (row.vendor !== vendorFilter) return false;
                    if (jenisFilter !== 'all' && row.label !== jenisFilter) return false;
                    if (filter === 'tanpa_pajak') return row.total_ppn === 0 && row.total_pph === 0;
                    if (filter === 'ppn_pph') return row.total_ppn > 0 && row.total_pph > 0;
                    if (filter === 'ppn') return row.total_ppn > 0 && row.total_pph === 0;
                    return true;
                });

                const jenisMap = {};
                vendorRows.forEach(row => {
                    const lbl = row.label || 'Tanpa Jenis';
                    if (!jenisMap[lbl]) {
                        jenisMap[lbl] = {
                            label: lbl,
                            total_nominal: 0,
                            total_pembelian: 0,
                            terbayar: 0,
                            total_transaksi: 0
                        };
                    }
                    jenisMap[lbl].total_nominal += (Number(row.total_nominal) || 0);
                    jenisMap[lbl].total_pembelian += (Number(row.total_pembelian) || 0);
                    jenisMap[lbl].terbayar += (Number(row.terbayar) || 0);
                    jenisMap[lbl].total_transaksi += (Number(row.total_transaksi) || 0);
                });

                const sortedJenis = Object.values(jenisMap)
                    .filter(j => j.total_nominal > 0 || j.total_pembelian > 0)
                    .sort((a, b) => b.total_nominal - a.total_nominal);

                const badgeJenisCount = document.getElementById('badge-vendor-jenis-count');
                if (badgeJenisCount) {
                    badgeJenisCount.textContent = `${sortedJenis.length} Jenis`;
                }

                const singleJenisEl = document.getElementById('chart-pembelian-single-jenis');
                const singleJenisEmptyEl = document.getElementById('chart-pembelian-single-jenis-empty');

                if (sortedJenis.length === 0) {
                    if (singleJenisEl) singleJenisEl.classList.add('d-none');
                    if (singleJenisEmptyEl) singleJenisEmptyEl.classList.remove('d-none');
                } else {
                    if (singleJenisEl) singleJenisEl.classList.remove('d-none');
                    if (singleJenisEmptyEl) singleJenisEmptyEl.classList.add('d-none');

                    const jenisLabels = sortedJenis.map(j => j.label);
                    const jenisValues = sortedJenis.map(j => j.total_nominal);
                    const jenisColors = ['#818CF8', '#38BDF8', '#34D399', '#FBBF24', '#F472B6', '#A78BFA'];

                    singleJenisChart = new ApexCharts(document.querySelector('#chart-pembelian-single-jenis'), {
                        chart: {
                            type: 'bar',
                            height: 285,
                            toolbar: { show: false },
                            animations: { enabled: true, speed: 300 }
                        },
                        plotOptions: {
                            bar: {
                                distributed: true,
                                borderRadius: 4,
                                borderRadiusApplication: 'end',
                                columnWidth: jenisLabels.length <= 2 ? '35%' : '45%',
                                dataLabels: { position: 'top' }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -20,
                            formatter: function (val) {
                                if (!val || val === 0) return 'Rp 0';
                                if (val >= 1000000000) return 'Rp ' + (val / 1000000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + ' M';
                                if (val >= 1000000) return 'Rp ' + (val / 1000000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 }) + ' Jt';
                                if (val >= 1000) return 'Rp ' + (val / 1000).toLocaleString('id-ID', { maximumFractionDigits: 0 }) + ' Rb';
                                return 'Rp ' + Number(val).toLocaleString('id-ID');
                            },
                            style: { fontSize: '11px', fontWeight: '600', colors: ['#F1F5F9'] }
                        },
                        series: [{
                            name: 'Sisa Belum Dibayar',
                            data: jenisValues
                        }],
                        xaxis: {
                            categories: jenisLabels,
                            labels: {
                                rotate: -15,
                                rotateAlways: false,
                                style: { colors: '#94A3B8', fontSize: '11px', fontWeight: 500 }
                            },
                            axisBorder: { show: false },
                            axisTicks: { show: false }
                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(0) + ' M';
                                    if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(0) + ' Jt';
                                    if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
                                    return 'Rp ' + Number(value).toLocaleString('id-ID');
                                },
                                style: { colors: '#94A3B8', fontSize: '10px' }
                            }
                        },
                        grid: {
                            borderColor: '#1E293B',
                            strokeDashArray: 3
                        },
                        tooltip: {
                            theme: 'dark',
                            y: {
                                formatter: function (value) {
                                    return 'Rp ' + Number(value).toLocaleString('id-ID');
                                }
                            }
                        },
                        colors: jenisColors,
                        legend: { show: false }
                    });
                    singleJenisChart.render();
                }
                return;
            }

            // MODE 2: Normal (Semua Vendor atau Berdasarkan Jenis Invoice Global)
            if (singleContainer) {
                singleContainer.classList.add('d-none');
            }

            destroyAllPembelianCharts();

            const rows = dataPembelianInvoiceJS.filter(row => {
                if (jenisFilter !== 'all' && row.label !== jenisFilter) return false;
                if (vendorFilter !== 'all' && row.vendor !== vendorFilter) return false;
                if (filter === 'tanpa_pajak') return row.total_ppn === 0 && row.total_pph === 0;
                if (filter === 'ppn_pph') return row.total_ppn > 0 && row.total_pph > 0;
                if (filter === 'ppn') return row.total_ppn > 0 && row.total_pph === 0;
                return true;
            });

            let visibleLabels = [];
            let values = [];

            if (pembelianGroupBy === 'vendor') {
                const vendorTotals = {};
                rows.forEach(item => {
                    const v = item.vendor || 'Tanpa Vendor';
                    vendorTotals[v] = (vendorTotals[v] || 0) + item.total_nominal;
                });
                visibleLabels = Object.keys(vendorTotals).sort((a, b) => vendorTotals[b] - vendorTotals[a]);
                values = visibleLabels.map(v => {
                    return rows.filter(item => item.vendor === v).reduce((total, item) => total + item.total_nominal, 0);
                });
            } else {
                const labels = ['Barang', 'Jasa', 'Barang dan Jasa', 'Jasa Iklan', 'Tanpa Pajak'];
                visibleLabels = jenisFilter === 'all' ? labels : [jenisFilter];
                values = visibleLabels.map(label => {
                    return rows.filter(item => item.label === label).reduce((total, item) => total + item.total_nominal, 0);
                });
            }

            const hasData = rows.length > 0 && values.some(v => v > 0);
            if (emptyEl) emptyEl.classList.toggle('d-none', hasData);
            if (mainChartEl) mainChartEl.classList.toggle('d-none', !hasData);

            if (!hasData) return;

            pembelianInvoiceChart = new ApexCharts(document.querySelector('#chart-pembelian-invoice'), {
                chart: {
                    type: 'bar',
                    height: 380,
                    toolbar: { show: false },
                    animations: { enabled: true, speed: 350 }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: visibleLabels.length > 5 ? '48%' : (visibleLabels.length <= 2 ? '28%' : '38%'),
                        dataLabels: { position: 'top' }
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -22,
                    formatter: function (val) {
                        if (!val || val === 0) return 'Rp 0';
                        if (val >= 1000000000) return 'Rp ' + (val / 1000000000).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' M';
                        if (val >= 1000000) return 'Rp ' + (val / 1000000).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' Jt';
                        if (val >= 1000) return 'Rp ' + (val / 1000).toLocaleString('id-ID', { maximumFractionDigits: 0 }) + ' Rb';
                        return 'Rp ' + Number(val).toLocaleString('id-ID');
                    },
                    style: {
                        fontSize: '11px',
                        fontWeight: '600',
                        colors: ['#F1F5F9']
                    }
                },
                series: [{ name: 'Sisa Belum Dibayar', data: values }],
                xaxis: {
                    categories: visibleLabels,
                    labels: {
                        rotate: pembelianGroupBy === 'vendor' ? -35 : 0,
                        rotateAlways: pembelianGroupBy === 'vendor',
                        trim: false,
                        maxHeight: 110,
                        style: { colors: '#94A3B8', fontSize: '11px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(1) + ' M';
                            if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(0) + ' Jt';
                            return 'Rp ' + Number(value).toLocaleString('id-ID');
                        },
                        style: { colors: '#94A3B8', fontSize: '11px' }
                    }
                },
                grid: {
                    borderColor: '#1E293B',
                    strokeDashArray: 3
                },
                colors: pembelianGroupBy === 'vendor' ? ['#818CF8'] : ['#818CF8', '#38BDF8', '#34D399', '#FBBF24', '#F472B6'],
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function (value) {
                            return 'Rp ' + Number(value).toLocaleString('id-ID');
                        }
                    }
                }
            });
            pembelianInvoiceChart.render();
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderPembelianInvoiceChart();
            renderVendorTable();
        });
    </script>
    <script src="{{asset('js/halaman/dashboard.js')}}"></script>
    <script src="{{asset('js/halaman/dashboard-barang.js')}}"></script>


@endsection


{{-- </body> --}}

{{-- </html> --}}
