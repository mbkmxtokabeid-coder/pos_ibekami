@extends('layout.template')

@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<style>
/* ==========================================================================
   IBEKAMI DASHBOARD — WARM OBSIDIAN & GOLDEN AMBER GLASSMORPHISM
   (Matched to Ibekami Brand Logo Colors)
   Supports Light Mode (.theme-light on body)
   ========================================================================== */

:root {
    --bg-canvas: #0C0A09;
    --bg-card: #14110F;
    --bg-card-hover: #1A1613;
    --bg-subbox: #181412;
    --bg-track: #26201B;

    --border-glass: rgba(255, 255, 255, 0.08);
    --border-glass-strong: rgba(245, 158, 11, 0.36);
    --border-subtle: rgba(255, 255, 255, 0.06);

    --text-white: #FFFFFF;
    --text-primary: #FAFAFA;
    --text-secondary: #A1A1AA;
    --text-muted-custom: #71717A;

    --accent-brand: #F59E0B;
    --accent-brand-light: #FBBF24;
    --accent-brand-deep: #EA580C;
    --accent-emerald: #10B981;
    --accent-emerald-light: #34D399;
    --accent-amber: #F59E0B;
    --accent-amber-light: #FBBF24;
    --accent-danger: #EF4444;
    --accent-coral: #FCA5A5;

    --radius-card: 14px;
    --radius-kpi: 12px;
    --radius-box: 10px;
    --radius-pill: 8px;
}

/* ==========================================================================
   THEME LIGHT OVERRIDES (Sesuai Desain Referensi PDF Claude)
   ========================================================================== */
body.theme-light {
    color: #1E293B !important;
}

body.theme-light .ref-page-title {
    color: #0F172A !important;
}

body.theme-light .ref-page-subtitle {
    color: #64748B !important;
}

body.theme-light .ref-meta-timestamp {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    color: #64748B !important;
    box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
}

/* Theme Toggle Button */
.ref-theme-toggle {
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
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
.ref-theme-toggle:hover {
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.22);
    transform: translateY(-1px);
    color: #FDE047;
}
body.theme-light .ref-theme-toggle {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    color: #1E293B !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06) !important;
}
body.theme-light .ref-theme-toggle:hover {
    background: #F8FAFC !important;
    color: #0F172A !important;
    border-color: #CBD5E1 !important;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08) !important;
}
body.theme-light .ref-theme-toggle #theme-toggle-icon {
    color: #1E293B !important;
}

/* Top Exec Cards in Light Mode */
body.theme-light .top-exec-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.03) !important;
}
body.theme-light .top-exec-card:hover {
    border-color: #CBD5E1 !important;
}
body.theme-light .top-exec-card--highlight {
    background: #FFFFFF !important;
    border-color: #FCD34D !important;
}
    border-color: #FDE68A !important;
}
body.theme-light .top-exec-label {
    color: #64748B !important;
}
body.theme-light .top-exec-val {
    color: #0F172A !important;
}
body.theme-light .top-exec-val--emerald {
    color: #059669 !important;
}
body.theme-light .top-exec-val--danger {
    color: #DC2626 !important;
}
body.theme-light .top-exec-sub {
    color: #94A3B8 !important;
}

/* Solid Structured Cards in Light Mode */
body.theme-light .ref-glass-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.03) !important;
}
body.theme-light .ref-glass-card:hover {
    border-color: #CBD5E1 !important;
}
body.theme-light .ref-card-title {
    color: #0F172A !important;
}
body.theme-light .ref-card-subtitle {
    color: #64748B !important;
}

/* Segmented Buttons in Light Mode */
body.theme-light .segmented-control,
body.theme-light .dash-segmented-group {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .segmented-item,
body.theme-light .dash-btn-filter {
    color: #64748B !important;
}
body.theme-light .segmented-item:hover,
body.theme-light .dash-btn-filter:hover {
    color: #0F172A !important;
    background: #E2E8F0 !important;
}
body.theme-light .segmented-item.active,
body.theme-light .dash-btn-filter.active {
    background: #FFFFFF !important;
    color: #D97706 !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08) !important;
}
body.theme-light #btn-filter-belum-lunas.active {
    background: #FEF2F2 !important;
    color: #DC2626 !important;
    border: 1px solid #FECACA !important;
    box-shadow: 0 1px 2px rgba(239, 68, 68, 0.08) !important;
}

body.theme-light .btn-custom-filter {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    color: #64748B !important;
}
body.theme-light .btn-custom-filter:hover,
body.theme-light .btn-custom-filter.active,
body.theme-light .btn-custom-filter.open {
    background: #FFFBEB !important;
    border-color: #FCD34D !important;
    color: #D97706 !important;
}

/* Hero Section in Light Mode */
body.theme-light .ref-hero-overline {
    color: #64748B !important;
}
body.theme-light .ref-hero-amount {
    color: #0F172A !important;
}
body.theme-light .ref-summary-box {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .ref-summary-box--net {
    background: #FFFBEB !important;
    border-color: #FDE68A !important;
}
body.theme-light .ref-summary-label {
    color: #64748B !important;
}
body.theme-light .ref-summary-val {
    color: #0F172A !important;
}
body.theme-light .ref-summary-val--expense {
    color: #DC2626 !important;
}

body.theme-light .ref-chart-title {
    color: #0F172A !important;
}
body.theme-light .ref-chart-unit,
body.theme-light .ref-legend-item {
    color: #64748B !important;
}

/* Right Donut Card in Light Mode */
body.theme-light .ref-period-pill {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
}
body.theme-light .ref-status-row {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
}
body.theme-light .ref-status-left {
    color: #334155 !important;
}
body.theme-light .ref-status-amount {
    color: #0F172A !important;
}

/* Standalone KPI Cards in Light Mode */
body.theme-light .ref-kpi-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.03) !important;
}
body.theme-light .ref-kpi-card:hover {
    border-color: #CBD5E1 !important;
}
body.theme-light .ref-kpi-overline {
    color: #64748B !important;
}
body.theme-light .ref-kpi-value,
body.theme-light .ref-kpi-main-title {
    color: #0F172A !important;
}
body.theme-light .ref-kpi-sub-count {
    color: #64748B !important;
}
body.theme-light .ref-kpi-icon--stone {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
}
body.theme-light .ref-kpi-icon--emerald {
    background: #ECFDF5 !important;
    border: 1px solid #A7F3D0 !important;
    color: #059669 !important;
}
body.theme-light .ref-kpi-icon--amber {
    background: #FEF3C7 !important;
    border: 1px solid #FCD34D !important;
    color: #B45309 !important;
}
body.theme-light .ref-kpi-icon--brand {
    background: #FFFBEB !important;
    border: 1px solid #FDE68A !important;
    color: #D97706 !important;
}

/* Jenis & Kategori in Light Mode */
body.theme-light .ref-jenis-name {
    color: #334155 !important;
}
body.theme-light .ref-jenis-track,
body.theme-light .ref-vendor-track {
    background: #E2E8F0 !important;
}
body.theme-light .ref-jenis-val {
    color: #0F172A !important;
}

body.theme-light .ref-teal-badge {
    background: #ECFDF5 !important;
    border: 1px solid #A7F3D0 !important;
    color: #059669 !important;
}

body.theme-light .ref-clean-table thead th {
    background: #F8FAFC !important;
    color: #64748B !important;
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .ref-clean-table tbody tr:hover {
    background: #F8FAFC !important;
}
body.theme-light .ref-clean-table tbody td {
    border-bottom: 1px solid #F1F5F9 !important;
    color: #334155 !important;
}
body.theme-light .ref-clean-table tbody td .text-white {
    color: #0F172A !important;
}

/* Custom Filter Panels & Inputs in Light Mode */
body.theme-light .custom-filter-panel {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.08) !important;
}
body.theme-light .dash-input,
body.theme-light .dash-select {
    background: #F8FAFC !important;
    color: #0F172A !important;
    border: 1px solid #CBD5E1 !important;
    color-scheme: light !important;
    outline: none !important;
}
body.theme-light .dash-input:focus,
body.theme-light .dash-select:focus {
    outline: none !important;
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
}
body.theme-light .btn-dash-primary {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25) !important;
}

body.theme-light .ref-chart-scroll-wrapper {
    scrollbar-color: rgba(245, 158, 11, 0.45) #F1F5F9 !important;
}
body.theme-light .ref-chart-scroll-wrapper::-webkit-scrollbar-track {
    background: #F1F5F9 !important;
}
/* ApexCharts Tooltip, Center Text & Data Labels in Light Mode */
body.theme-light .apexcharts-text tspan {
    fill: #334155 !important;
}
body.theme-light .apexcharts-datalabel,
body.theme-light .apexcharts-datalabel-label,
body.theme-light .apexcharts-datalabel-value {
    fill: #0F172A !important;
}
body.theme-light .apexcharts-pie-label {
    fill: #0F172A !important;
}
body.theme-light .apexcharts-tooltip {
    background: #FFFFFF !important;
    color: #0F172A !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 10px 25px -4px rgba(0, 0, 0, 0.1) !important;
}
body.theme-light .apexcharts-tooltip-title {
    background: #F8FAFC !important;
    border-bottom: 1px solid #E2E8F0 !important;
    color: #0F172A !important;
}
body.theme-light .apexcharts-tooltip-text,
body.theme-light .apexcharts-tooltip-text-label,
body.theme-light .apexcharts-tooltip-text-value {
    color: #0F172A !important;
}
body.theme-light .apexcharts-legend-text {
    color: #334155 !important;
}
body.theme-light .apexcharts-yaxis-label,
body.theme-light .apexcharts-xaxis-label {
    fill: #475569 !important;
    font-weight: 600 !important;
}
body.theme-light .apexcharts-gridline {
    stroke: #E2E8F0 !important;
}

/* Data Labels on top of bar charts in Light Mode */
body.theme-light .apexcharts-bar-area + text,
body.theme-light .apexcharts-data-labels text {
    fill: #1E293B !important;
    font-weight: 700 !important;
}

/* Ensure all table cells have high contrast in Light Mode */
body.theme-light .ref-clean-table tbody td {
    color: #1E293B !important;
}
body.theme-light .ref-clean-table tbody td span {
    color: #1E293B !important;
}
body.theme-light .ref-clean-table tbody td span.fw-bold,
body.theme-light .ref-clean-table tbody td span.fw-semibold {
    color: #0F172A !important;
}

/* Pills contrast in Light Mode */
body.theme-light .ref-status-pill--emerald {
    background: #ECFDF5 !important;
    color: #047857 !important;
    border: 1px solid #A7F3D0 !important;
}
body.theme-light .ref-status-pill--danger {
    background: #FEF2F2 !important;
    color: #B91C1C !important;
    border: 1px solid #FECACA !important;
}
body.theme-light .ref-status-pill--slate {
    background: #F1F5F9 !important;
    color: #475569 !important;
    border: 1px solid #CBD5E1 !important;
}
body.theme-light .ref-pct-pill {
    background: #FFFBEB !important;
    border: 1px solid #FDE68A !important;
    color: #B45309 !important;
}

/* Top Exec Pills in Light Mode */
body.theme-light .top-exec-pill--neutral {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
}
body.theme-light .top-exec-pill--amber {
    background: #FFFBEB !important;
    border: 1px solid #FDE68A !important;
    color: #B45309 !important;
}
body.theme-light .top-exec-pill--emerald {
    background: #ECFDF5 !important;
    border: 1px solid #A7F3D0 !important;
    color: #047857 !important;
}
body.theme-light .top-exec-pill--danger {
    background: #FEF2F2 !important;
    border: 1px solid #FECACA !important;
    color: #B91C1C !important;
}
body.theme-light .top-exec-pill--sky {
    background: #F0F9FF !important;
    border: 1px solid #BAE6FD !important;
    color: #0369A1 !important;
}

/* Custom Tooltip in Donut Kategori in Light Mode */
body.theme-light .dash-custom-tooltip {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    color: #0F172A !important;
    box-shadow: 0 10px 25px -4px rgba(0, 0, 0, 0.1) !important;
}

body.theme-light .ref-paid-pill {
    background: #ECFDF5 !important;
    border: 1px solid #A7F3D0 !important;
    color: #059669 !important;
}
body.theme-light .ref-debt-pill {
    background: #FEF2F2 !important;
    border: 1px solid #FECACA !important;
    color: #DC2626 !important;
}

/* Dropdown Menu & Popovers in Light Mode */
body.theme-light .shadcn-dropdown-menu,
body.theme-light .dropdown-menu {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner,
body.theme-light .dropdown-menu:not(.shadcn-dropdown-menu) {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 16px 38px rgba(15, 23, 42, 0.12), 0 2px 6px rgba(15, 23, 42, 0.04) !important;
    border-radius: 12px !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner,
body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner span,
body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner div {
    color: #1E293B !important;
}
body.theme-light .user-dropdown-header,
body.theme-light .shadcn-dropdown-menu .border-bottom {
    border-bottom: 1px solid #F1F5F9 !important;
    border-color: #F1F5F9 !important;
}
body.theme-light .user-dropdown-header-name {
    color: #0F172A !important;
    font-weight: 700 !important;
}
body.theme-light .user-dropdown-header-role,
body.theme-light .shadcn-dropdown-menu .text-muted {
    color: #64748B !important;
}
body.theme-light .shadcn-dropdown-menu .dropdown-divider {
    border-top: 1px solid #F1F5F9 !important;
    border-color: #F1F5F9 !important;
    opacity: 1 !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-item,
body.theme-light .dropdown-menu .dropdown-item {
    color: #334155 !important;
    border-radius: 8px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    padding: 8px 12px !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-item:hover,
body.theme-light .dropdown-menu .dropdown-item:hover {
    background: #F1F5F9 !important;
    color: #0F172A !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger,
body.theme-light .dropdown-menu .dropdown-item.text-danger {
    color: #EF4444 !important;
}
body.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger:hover,
body.theme-light .dropdown-menu .dropdown-item.text-danger:hover {
    background: #FEF2F2 !important;
    color: #DC2626 !important;
}
body.theme-light .footer {
    color: #94A3B8 !important;
    border-top: 1px solid #E2E8F0 !important;
}



/* 1. Deep Warm Obsidian Canvas (Solid & Focused, No AI Radial Orbs) */
body {
    font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
    position: relative;
    min-height: 100vh;
}
html:not(.theme-light) body,
html.theme-dark body {
    background-color: var(--bg-canvas) !important;
    background-image: none !important;
    color: var(--text-primary) !important;
}

/* ==========================================================================
   VIEW TRANSITION API — CIRCULAR REVEAL THEME TRANSITION
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

@media (prefers-reduced-motion: reduce) {
    ::view-transition-group(*),
    ::view-transition-old(*),
    ::view-transition-new(*) {
        animation: none !important;
    }
}

/* Light Theme Canvas Overrides (Clean Slate Ground Plane) */
body.theme-light,
html[data-theme="light"] body,
body.theme-light #layout-wrapper,
html[data-theme="light"] #layout-wrapper,
body.theme-light .main-content,
html[data-theme="light"] .main-content,
body.theme-light .page-content,
html[data-theme="light"] .page-content {
    background-color: #F8FAFC !important;
    background-image: none !important;
    color: #1E293B !important;
}

/* Theme Toggle Button & Micro-animation */
.ref-theme-toggle {
    cursor: pointer;
    user-select: none;
    transition: transform 160ms ease, background-color 160ms ease, border-color 160ms ease;
}
.ref-theme-toggle:active {
    transform: scale(0.96);
}
.ref-theme-toggle #theme-toggle-icon {
    display: inline-block;
    transition: transform 380ms cubic-bezier(0.34, 1.56, 0.64, 1), opacity 200ms ease;
}
.ref-theme-toggle.theme-switching #theme-toggle-icon {
    transform: rotate(180deg) scale(0.65);
    opacity: 0.2;
}

.footer {
    background-color: transparent !important;
    color: var(--text-muted-custom) !important;
    border-top: 1px solid var(--border-subtle) !important;
    box-shadow: none !important;
}

/* Tabular Numbers for Financial & Metric Alignment */
.tabular-nums {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1 !important;
}

/* 2. Top Page Header ("Dashboard IBEKAMI") */
.ref-header-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 22px;
}
.ref-page-title {
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--text-white);
    margin: 0 0 4px 0;
    line-height: 1.25;
}
.ref-page-subtitle {
    font-size: 13px;
    font-weight: 400;
    color: var(--text-secondary);
    margin: 0;
}
.ref-meta-timestamp {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.09);
    color: #CBD5E1;
    font-size: 12px;
    font-weight: 500;
}

/* 2b. Top 4 Executive Summary Cards (Clean Structural Solid Cards) */
.top-exec-card {
    background: #14110F;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 16px 18px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    transition: border-color 160ms ease;
}
.top-exec-card:hover {
    border-color: rgba(245, 158, 11, 0.35);
}
.top-exec-card--highlight {
    background: #191410;
    border-color: rgba(245, 158, 11, 0.32);
}
.top-exec-card--highlight:hover {
    border-color: rgba(251, 191, 36, 0.50);
}
.top-exec-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 10px;
}
.top-exec-label {
    font-size: 12px;
    font-weight: 500;
    text-transform: none;
    letter-spacing: normal;
    color: #94A3B8;
}
.top-exec-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 2px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.25;
    white-space: nowrap;
}
.top-exec-pill--neutral {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #CBD5E1;
}
.top-exec-pill--amber {
    background: rgba(245, 158, 11, 0.14);
    border: 1px solid rgba(245, 158, 11, 0.34);
    color: #FBBF24;
}
.top-exec-pill--emerald {
    background: rgba(16, 185, 129, 0.14);
    border: 1px solid rgba(16, 185, 129, 0.34);
    color: #34D399;
}
.top-exec-pill--danger {
    background: rgba(239, 68, 68, 0.16);
    border: 1px solid rgba(239, 68, 68, 0.36);
    color: #F87171;
}
.top-exec-pill--sky {
    background: rgba(56, 189, 248, 0.14);
    border: 1px solid rgba(56, 189, 248, 0.34);
    color: #38BDF8;
}
.top-exec-val {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin: 0 0 8px 0;
    color: #FFFFFF;
}
.top-exec-val--emerald {
    color: #10B981;
}
.top-exec-val--amber {
    color: #FBBF24;
}
.top-exec-val--danger {
    color: #EF4444;
}
.top-exec-sub {
    font-size: 12px;
    font-weight: 500;
    color: #64748B;
    margin: 0;
}

/* 3. Solid Structured Card Surface (Matte Obsidian) */
.ref-glass-card {
    background: #14110F !important;
    border: 1px solid var(--border-glass) !important;
    border-radius: var(--radius-card) !important;
    padding: 22px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
    transition: border-color 160ms ease;
}
.ref-glass-card:hover {
    border-color: rgba(255, 255, 255, 0.12) !important;
}

.ref-card-title {
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.015em;
    color: var(--text-white) !important;
    margin: 0;
}
.ref-card-subtitle {
    font-size: 12.5px;
    color: var(--text-secondary) !important;
    margin: 3px 0 0 0;
}

/* 4. Segmented Control with Crisp Solid Active State (No Glowing Halos) */
.segmented-control,
.dash-segmented-group {
    display: inline-flex;
    align-items: center;
    background: #100D0B;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 8px;
    padding: 3px;
    gap: 3px;
    max-width: 100%;
    overflow-x: auto;
    scrollbar-width: none;
}
.segmented-control::-webkit-scrollbar,
.dash-segmented-group::-webkit-scrollbar {
    display: none;
}
.segmented-item,
.dash-btn-filter {
    background: transparent;
    border: 1px solid transparent;
    color: var(--text-secondary);
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.4;
    cursor: pointer;
    white-space: nowrap;
    transition: all 140ms ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.segmented-item:hover,
.dash-btn-filter:hover {
    color: var(--text-white);
    background: rgba(255, 255, 255, 0.05);
}
.segmented-item.active,
.dash-btn-filter.active {
    background: #EA580C !important;
    color: #FFFFFF !important;
    border: 1px solid #EA580C !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}
#btn-filter-belum-lunas.active {
    background: #DC2626 !important;
    color: #FFFFFF !important;
    border: 1px solid #DC2626 !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}

/* Custom Filter Toggle Button */
.btn-custom-filter {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.04);
    color: var(--text-secondary);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: all 150ms ease;
}
.btn-custom-filter:hover,
.btn-custom-filter.open,
.btn-custom-filter.active {
    color: #FBBF24;
    border-color: rgba(245, 158, 11, 0.45);
    background: rgba(245, 158, 11, 0.14);
}

/* 5. Row 1 Left: Hero Pendapatan Akumulasi & 3 Summary Sub-Boxes */
.ref-hero-overline {
    font-size: 12px;
    font-weight: 500;
    text-transform: none;
    letter-spacing: normal;
    color: var(--text-secondary);
    margin-bottom: 4px;
}
.ref-hero-amount {
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.02em;
    line-height: 1.15;
    color: var(--text-white);
    margin: 0 0 16px 0;
}

.ref-summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 22px;
}
@media (max-width: 767.98px) {
    .ref-summary-grid {
        grid-template-columns: 1fr;
    }
    .ref-hero-amount {
        font-size: 28px;
    }
}
.ref-summary-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 12px;
    padding: 13px 16px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.ref-summary-box--net {
    background: linear-gradient(145deg, rgba(245, 158, 11, 0.16) 0%, rgba(234, 88, 12, 0.07) 100%);
    border-color: rgba(245, 158, 11, 0.32);
}
.ref-summary-label {
    font-size: 11.5px;
    font-weight: 500;
    color: var(--text-secondary);
}
.ref-summary-val {
    font-size: 15.5px;
    font-weight: 700;
    color: var(--text-white);
    letter-spacing: -0.01em;
}
.ref-summary-val--expense {
    color: var(--accent-coral) !important;
}

.ref-chart-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 8px;
}
.ref-chart-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text-white);
}
.ref-chart-unit {
    font-size: 11.5px;
    font-weight: 400;
    color: var(--text-secondary);
}
.ref-legend-group {
    display: inline-flex;
    align-items: center;
    gap: 16px;
}
.ref-legend-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    color: var(--text-secondary);
}
.ref-legend-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}
.ref-chart-scroll-wrapper {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    padding-bottom: 6px;
    scrollbar-width: thin;
    scrollbar-color: rgba(245, 158, 11, 0.42) rgba(255, 255, 255, 0.03);
    cursor: grab;
    -webkit-overflow-scrolling: touch;
}
.ref-chart-scroll-wrapper:active {
    cursor: grabbing;
}
.ref-chart-scroll-wrapper::-webkit-scrollbar {
    height: 7px;
}
.ref-chart-scroll-wrapper::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 999px;
}
.ref-chart-scroll-wrapper::-webkit-scrollbar-thumb {
    background: rgba(245, 158, 11, 0.40);
    border-radius: 999px;
}
.ref-chart-scroll-wrapper::-webkit-scrollbar-thumb:hover {
    background: rgba(245, 158, 11, 0.68);
}

/* 6. Row 1 Right: Struktur Status Pembayaran */
.ref-period-pill {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.09);
    font-size: 11.5px;
    font-weight: 600;
    color: #CBD5E1;
}
.ref-status-list {
    display: flex;
    flex-direction: column;
    gap: 9px;
    margin-top: 12px;
}
.ref-status-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 15px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.032);
    border: 1px solid rgba(255, 255, 255, 0.06);
}
.ref-status-left {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 500;
    color: #E2E8F0;
}
.ref-status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}
.ref-status-right {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}
.ref-status-amount {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text-white);
}
.ref-status-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 2px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    min-width: 44px;
}
.ref-status-pill--emerald {
    background: rgba(16, 185, 129, 0.16);
    color: #34D399;
    border: 1px solid rgba(52, 211, 153, 0.28);
}
.ref-status-pill--amber {
    background: rgba(245, 158, 11, 0.16);
    color: #FBBF24;
    border: 1px solid rgba(251, 191, 36, 0.28);
}
.ref-status-pill--danger {
    background: rgba(239, 68, 68, 0.16);
    color: #F87171;
    border: 1px solid rgba(248, 113, 113, 0.32);
}
.ref-status-pill--slate {
    background: rgba(148, 163, 184, 0.14);
    color: #94A3B8;
    border: 1px solid rgba(148, 163, 184, 0.22);
}

/* 7. Row 2: 4 Standalone Solid KPI Cards */
.ref-kpi-card {
    background: #14110F;
    border: 1px solid var(--border-glass);
    border-radius: var(--radius-kpi);
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    height: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    transition: border-color 160ms ease;
}
.ref-kpi-card:hover {
    border-color: rgba(255, 255, 255, 0.12);
}
.ref-kpi-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}
.ref-kpi-icon--stone {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.09);
    color: #CBD5E1;
}
.ref-kpi-icon--emerald {
    background: rgba(16, 185, 129, 0.12);
    border: 1px solid rgba(16, 185, 129, 0.25);
    color: #34D399;
}
.ref-kpi-icon--amber {
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid rgba(245, 158, 11, 0.25);
    color: #FBBF24;
}
.ref-kpi-icon--brand {
    background: rgba(234, 88, 12, 0.12);
    border: 1px solid rgba(234, 88, 12, 0.25);
    color: #FB923C;
}
.ref-kpi-overline {
    font-size: 12px;
    font-weight: 500;
    text-transform: none;
    letter-spacing: normal;
    color: var(--text-secondary);
    margin-bottom: 3px;
    display: block;
}
.ref-kpi-value {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-white);
    margin: 0;
    line-height: 1.25;
    letter-spacing: -0.01em;
}
.ref-kpi-main-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-white);
}
.ref-kpi-sub-count {
    font-size: 12px;
    font-weight: 500;
    color: var(--text-secondary);
    margin-left: 4px;
}

/* 8. Row 3 Left: Custom Progress-Track Bars for Jenis Barang */
.ref-jenis-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding-top: 8px;
}
.ref-jenis-row {
    display: grid;
    grid-template-columns: 115px 1fr 52px;
    align-items: center;
    gap: 14px;
}
.ref-jenis-row.ref-jenis-row--nominal {
    grid-template-columns: 115px 1fr 115px;
}
.ref-jenis-name {
    font-size: 12.5px;
    font-weight: 500;
    color: #CBD5E1;
}
.ref-jenis-track {
    width: 100%;
    height: 9px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.055);
    overflow: hidden;
    position: relative;
}
.ref-jenis-fill {
    height: 100%;
    border-radius: 999px;
    transition: width 950ms cubic-bezier(0.16, 1, 0.3, 1);
}
.ref-jenis-val {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-white);
    text-align: right;
    white-space: nowrap;
}

/* 9. Row 3 Right: Kategori Barang Donut & Table */
.ref-teal-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 11px;
    border-radius: 999px;
    background: rgba(16, 185, 129, 0.14);
    border: 1px solid rgba(52, 211, 153, 0.28);
    color: #34D399;
    font-size: 11px;
    font-weight: 700;
}
#table-kategori-container {
    position: relative;
    max-height: 210px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(148, 163, 184, 0.25) transparent;
}
#table-kategori-container::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
#table-kategori-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 999px;
}
#table-kategori-container::-webkit-scrollbar-thumb {
    background: rgba(148, 163, 184, 0.25);
    border-radius: 999px;
}
#table-kategori-container::-webkit-scrollbar-thumb:hover {
    background: rgba(148, 163, 184, 0.45);
}
.ref-clean-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}
.ref-clean-table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    font-size: 12px;
    font-weight: 500;
    text-transform: none;
    letter-spacing: normal;
    color: var(--text-secondary);
    padding: 10px 8px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    background: #14110F !important;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.06);
    white-space: nowrap;
}
.ref-clean-table tbody tr {
    transition: background-color 140ms ease;
}
.ref-clean-table tbody tr:hover {
    background: rgba(255, 255, 255, 0.03);
}
.ref-clean-table tbody td {
    padding: 10px 8px;
    font-size: 12.5px;
    vertical-align: middle;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    white-space: nowrap;
}
.ref-clean-table tbody tr:last-child td {
    border-bottom: none;
}
.ref-pct-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 2px 8px;
    border-radius: 6px;
    background: rgba(245, 158, 11, 0.14);
    border: 1px solid rgba(245, 158, 11, 0.28);
    color: #FBBF24;
    font-size: 11px;
    font-weight: 600;
}

/* 10. Row 4: Pembelian Belum Dibayar per Vendor (Inline Progress Table) */
.ref-vendor-track {
    width: 100%;
    height: 8px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.06);
    overflow: hidden;
}
.ref-vendor-fill {
    height: 100%;
    border-radius: 999px;
    background: #EA580C;
    box-shadow: none;
    transition: width 950ms cubic-bezier(0.16, 1, 0.3, 1);
}
.ref-debt-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 3px 10px;
    border-radius: 6px;
    background: rgba(239, 68, 68, 0.14);
    border: 1px solid rgba(239, 68, 68, 0.28);
    color: #FCA5A5;
    font-size: 12px;
    font-weight: 600;
}
.ref-paid-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 3px 10px;
    border-radius: 6px;
    background: rgba(16, 185, 129, 0.14);
    border: 1px solid rgba(16, 185, 129, 0.28);
    color: #6EE7B7;
    font-size: 12px;
    font-weight: 600;
}

/* Custom Filter Panel Controls */
.custom-filter-panel {
    background: #14110F !important;
    border: 1px solid var(--border-glass) !important;
    border-radius: 10px !important;
}
.dash-input, .dash-select {
    background: #181512 !important;
    color: var(--text-white) !important;
    border: 1px solid var(--border-glass) !important;
    border-radius: 8px !important;
    font-size: 12px !important;
    padding: 5px 10px !important;
}
.btn-dash-primary {
    background: #EA580C !important;
    color: #FFFFFF !important;
    border: 1px solid #EA580C !important;
    border-radius: 8px !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    padding: 5px 14px !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}
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

/* ==========================================================================
   11. PURPOSEFUL UI MICRO-INTERACTIONS (Antislop: Restrained & Fast)
   ========================================================================== */
.ref-header-bar,
.top-exec-card,
.ref-glass-card,
.ref-kpi-card {
    transition: border-color 160ms ease, box-shadow 160ms ease;
}

@keyframes dashFilterSwap {
    0% {
        opacity: 0.55;
    }
    100% {
        opacity: 1;
    }
}

@keyframes dashRowSlide {
    from {
        opacity: 0;
        transform: translateY(6px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes dashPanelExpand {
    from {
        opacity: 0;
        transform: translateY(-4px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Filter Transition Utility Classes */
.dash-filter-swap {
    animation: dashFilterSwap 720ms cubic-bezier(0.16, 1, 0.3, 1) both;
}
.dash-row-anim {
    animation: dashRowSlide 680ms cubic-bezier(0.16, 1, 0.3, 1) both;
}
.custom-filter-panel {
    animation: dashPanelExpand 520ms cubic-bezier(0.16, 1, 0.3, 1) both;
}
.dash-loading-dim {
    opacity: 0.45;
    transition: opacity 280ms ease;
}

/* Active Filter Button Micro-Press */
.segmented-item:active,
.dash-btn-filter:active,
.btn-custom-filter:active {
    transform: scale(0.96);
}

@media (prefers-reduced-motion: reduce) {
    .ref-header-bar,
    .top-exec-card,
    #card-aktivitas-pembayaran,
    .col-xl-5 > .ref-glass-card,
    .ref-kpi-card,
    #card-statistik-barang > div > .ref-glass-card,
    #card-hutang-vendor,
    .dash-filter-swap,
    .dash-row-anim,
    .custom-filter-panel {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- TOP HEADER: Dashboard IBEKAMI -->
        <div class="ref-header-bar">
            <div>
                <h1 class="ref-page-title">Dashboard IBEKAMI</h1>
                <p class="ref-page-subtitle">Ringkasan keuangan, penjualan, dan hutang vendor</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme()" title="Beralih Mode Tampilan">
                    <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
                    <span id="theme-toggle-text">Mode Terang</span>
                </button>
                <span class="ref-meta-timestamp" title="Tanggal pembaruan data sistem">
                    <i class="ri-calendar-line fs-14"></i>
                    <span>Data per {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d M Y') }}</span>
                </span>
            </div>
        </div>

        @php
            $totalAkumulasiTahunTop = ($datasInYear[0] ?? 0) + ($datasInYear[1] ?? 0) + ($datasInYear[2] ?? 0);
            $totalAkumulasiLastYearTop = ($datasInLastYear[0] ?? 0) + ($datasInLastYear[1] ?? 0) + ($datasInLastYear[2] ?? 0);
            $pctTerbayarTop = $totalAkumulasiTahunTop > 0 ? number_format((($datasInYear[0] ?? 0) / $totalAkumulasiTahunTop) * 100, 1, ',', '.') : '0';
            $pctPiutangTop = $totalAkumulasiTahunTop > 0 ? number_format((($datasInYear[1] ?? 0) / $totalAkumulasiTahunTop) * 100, 1, ',', '.') : '0';

            // Real YoY comparison if previous year exists, otherwise honest period badge
            $hasLastYearData = $totalAkumulasiLastYearTop > 0;
            $realYoY = $hasLastYearData ? round((($totalAkumulasiTahunTop - $totalAkumulasiLastYearTop) / $totalAkumulasiLastYearTop) * 100, 1) : null;
        @endphp

        <!-- TOP 4 EXECUTIVE SUMMARY CARDS -->
        <div class="row g-3 mb-4">
            <!-- Card 1: Pendapatan Akumulasi -->
            <div class="col-xl-3 col-sm-6">
                <div class="top-exec-card top-exec-card--highlight">
                    <div class="top-exec-head">
                        <span class="top-exec-label">Pendapatan akumulasi</span>
                        @if($hasLastYearData)
                            <span class="top-exec-pill {{ $realYoY >= 0 ? 'top-exec-pill--emerald' : 'top-exec-pill--danger' }} tabular-nums" id="top-kpi-yoy-badge">
                                {{ ($realYoY >= 0 ? '+' : '') . $realYoY }}% vs Thn Lalu
                            </span>
                        @else
                            <span class="top-exec-pill top-exec-pill--neutral tabular-nums" id="top-kpi-yoy-badge">
                                Tahun {{ date('Y') }}
                            </span>
                        @endif
                    </div>
                    <h3 class="top-exec-val tabular-nums" id="top-kpi-akumulasi">
                        Rp {{ number_format($totalAkumulasiTahunTop, 0, ',', '.') }}
                    </h3>
                    <p class="top-exec-sub" id="top-kpi-akumulasi-sub">
                        Periode berjalan s/d {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d M Y') }}
                    </p>
                </div>
            </div>

            <!-- Card 2: Invoice Terbayar (Lunas) -->
            <div class="col-xl-3 col-sm-6">
                <div class="top-exec-card">
                    <div class="top-exec-head">
                        <span class="top-exec-label">Invoice terbayar (lunas)</span>
                        <span class="top-exec-pill top-exec-pill--emerald tabular-nums" id="top-kpi-terbayar-pct">
                            {{ $pctTerbayarTop }}%
                        </span>
                    </div>
                    <h3 class="top-exec-val top-exec-val--emerald tabular-nums" id="top-kpi-terbayar">
                        Rp {{ number_format($datasInYear[0] ?? 0, 0, ',', '.') }}
                    </h3>
                    <p class="top-exec-sub" id="top-kpi-terbayar-sub">
                        {{ number_format($countLunasYear ?? 0, 0, ',', '.') }} transaksi selesai
                    </p>
                </div>
            </div>

            <!-- Card 3: Piutang Belum Lunas -->
            <div class="col-xl-3 col-sm-6">
                <div class="top-exec-card">
                    <div class="top-exec-head">
                        <span class="top-exec-label">Piutang belum lunas</span>
                        <span class="top-exec-pill top-exec-pill--danger tabular-nums" id="top-kpi-piutang-pct">
                            {{ $pctPiutangTop }}%
                        </span>
                    </div>
                    <h3 class="top-exec-val top-exec-val--danger tabular-nums" id="top-kpi-piutang">
                        Rp {{ number_format($datasInYear[1] ?? 0, 0, ',', '.') }}
                    </h3>
                    <p class="top-exec-sub" id="top-kpi-piutang-sub">
                        {{ number_format($countBlmLunasYear ?? 0, 0, ',', '.') }} invoice menunggu pelunasan
                    </p>
                </div>
            </div>

            <!-- Card 4: Total Produk Terjual -->
            <div class="col-xl-3 col-sm-6">
                <div class="top-exec-card">
                    <div class="top-exec-head">
                        <span class="top-exec-label">Total produk terjual</span>
                        <span class="top-exec-pill top-exec-pill--neutral text-truncate" id="top-kpi-produk-badge" style="max-width: 140px;">
                            Volume Penjualan
                        </span>
                    </div>
                    <h3 class="top-exec-val tabular-nums" id="top-kpi-produk-qty">
                        0 Pcs
                    </h3>
                    <p class="top-exec-sub" id="top-kpi-produk-sub">
                        Memuat data...
                    </p>
                </div>
            </div>
        </div>

        <!-- ROW 1: AKTIVITAS PEMBAYARAN (LEFT) & STRUKTUR STATUS PEMBAYARAN (RIGHT) -->
        <div class="row g-4 mb-4">
            <!-- Left Card: Aktivitas Pembayaran -->
            <div class="col-xl-7">
                <div class="ref-glass-card h-100 d-flex flex-column justify-content-between" id="card-aktivitas-pembayaran">
                    <div>
                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-3">
                            <div>
                                <h4 class="ref-card-title">Arus Kas Masuk & Realisasi Pembayaran</h4>
                                <p class="ref-card-subtitle">Bagaimana tren pendapatan bersih dibandingkan beban operasional pada periode ini?</p>
                            </div>
                        </div>

                        <!-- Filter Segmented Bar -->
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                            <div class="segmented-control" role="group">
                                <button type="button" class="segmented-item tombol" onclick="timeFrame('day')" id="btn-day">Hari Ini</button>
                                <button type="button" class="segmented-item tombol" onclick="timeFrame('week')" id="btn-week">Minggu Ini</button>
                                <button type="button" class="segmented-item tombol" onclick="timeFrame('month')" id="btn-month">Bulan Ini</button>
                                <button type="button" class="segmented-item tombol active" onclick="timeFrame('year')" id="btn-year">Tahun Ini</button>
                                <button type="button" class="segmented-item tombol" onclick="timeFrame('lastYear')" id="btn-lastYear">Tahun Lalu</button>
                            </div>
                            <button type="button" class="btn-custom-filter" onclick="togglePaymentCustomFilter()" id="btn-payment-custom-toggle" title="Filter Kustom">
                                <i class="ri-equalizer-line"></i> Filter Kustom <i class="ri-arrow-down-s-line chevron-rotate" id="icon-toggle-payment-custom"></i>
                            </button>
                        </div>

                        <!-- Collapsible Custom Filter Panel -->
                        <div id="panel-custom-filter-payment" class="mb-3 custom-filter-panel d-flex flex-wrap align-items-center" style="display: none !important; padding: 10px 14px; gap: 10px;">
                            <div class="segmented-control payment-segmented-control" id="payment-submode-group" role="group">
                                <button type="button" class="segmented-item payment-submode active" data-mode="date" onclick="setPaymentSubmode('date')">Tanggal</button>
                                <button type="button" class="segmented-item payment-submode" data-mode="month" onclick="setPaymentSubmode('month')">Bulan</button>
                                <button type="button" class="segmented-item payment-submode" data-mode="year" onclick="setPaymentSubmode('year')">Tahun</button>
                                <button type="button" class="segmented-item payment-submode" data-mode="range" onclick="setPaymentSubmode('range')">Rentang</button>
                            </div>
                            <div class="d-inline-flex align-items-center gap-2" id="payment-inputs-container">
                                <input type="text" id="payment-input-date" class="form-control form-control-sm dash-input payment-ctrl active dash-flatpickr" style="width: 140px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Pilih Tanggal">
                                <div id="payment-ctrl-month" class="payment-ctrl">
                                    <select id="payment-input-bulan" class="form-select form-select-sm dash-select" style="width: 120px; height: 32px;">
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select id="payment-input-tahun-month" class="form-select form-select-sm dash-select" style="width: 86px; height: 32px;">
                                        @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div id="payment-ctrl-year" class="payment-ctrl">
                                    <select id="payment-input-year" class="form-select form-select-sm dash-select" style="width: 95px; height: 32px;">
                                        @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div id="payment-ctrl-range" class="payment-ctrl">
                                    <input type="text" id="payment-range-start" class="form-control form-control-sm dash-input dash-flatpickr" style="width: 130px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-01') }}" readonly placeholder="Dari Tanggal">
                                    <span class="text-secondary fs-12">s/d</span>
                                    <input type="text" id="payment-range-end" class="form-control form-control-sm dash-input dash-flatpickr" style="width: 130px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Sampai Tanggal">
                                </div>
                            </div>
                            <button type="button" class="btn btn-dash-primary" onclick="submitPaymentCustomFilter()">Tampilkan</button>
                        </div>

                        <!-- Hero Metric: Pendapatan Akumulasi -->
                        @php
                            $totalAkumulasiTahun = ($datasInYear[0] ?? 0) + ($datasInYear[1] ?? 0) + ($datasInYear[2] ?? 0);
                        @endphp
                        <div class="ref-hero-overline">Pendapatan akumulasi</div>
                        <h2 class="ref-hero-amount tabular-nums" id="hero-pendapatan-akumulasi">Rp {{ number_format($totalAkumulasiTahun, 0, ',', '.') }}</h2>

                        <!-- 3 Horizontal Sub-Cards (#harga) -->
                        <div id="harga">
                            <div class="ref-summary-grid">
                                <div class="ref-summary-box">
                                    <span class="ref-summary-label">Total Pendapatan</span>
                                    <span class="ref-summary-val tabular-nums">Rp {{ $jumlahPerTahun }}</span>
                                </div>
                                <div class="ref-summary-box">
                                    <span class="ref-summary-label">Total Beban</span>
                                    <span class="ref-summary-val ref-summary-val--expense tabular-nums">Rp 0</span>
                                </div>
                                <div class="ref-summary-box ref-summary-box--net">
                                    <span class="ref-summary-label">Pendapatan Bersih</span>
                                    <span class="ref-summary-val tabular-nums">Rp {{ $jumlahPerTahun }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bar Chart Section -->
                    <div class="mt-1">
                        <div class="ref-chart-header">
                            <span class="ref-chart-title" id="tren-arus-kas-title">
                                Tren Arus Kas {{ date('Y') }} <span class="ref-chart-unit">(Juta Rp)</span>
                            </span>
                            <span class="d-none" id="badge-payment-period-text">Tahun Ini</span>
                            <span class="d-none" id="tag-periode-kas">Tahun Ini</span>
                            <div class="ref-legend-group" id="payment-chart-legend">
                                <span class="ref-legend-item">
                                    <span class="ref-legend-dot" style="background: #F59E0B;"></span>
                                    Pendapatan Bersih
                                </span>
                                <span class="ref-legend-item">
                                    <span class="ref-legend-dot" style="background: #34D399;"></span>
                                    Pendapatan Asli
                                </span>
                            </div>
                        </div>
                        <div class="ref-chart-scroll-wrapper" id="payment_chart_scroll_wrapper">
                            <div id="stacked_column_chart" class="apex-charts" data-colors='["#F59E0B", "#34D399"]' dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Card: Struktur Status Pembayaran -->
            <div class="col-xl-5">
                <div class="ref-glass-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h4 class="ref-card-title">Proporsi Pelunasan Tagihan</h4>
                            <span class="ref-period-pill" id="periode">Tahun Ini</span>
                        </div>
                        <p class="ref-card-subtitle mb-2">Berapa rasio invoice lunas dibandingkan piutang berjalan?</p>
                    </div>

                    <div class="my-auto py-2">
                        <div id="structure_widget" data-colors='["#34D399", "#EF4444", "#64748B"]' class="apex-charts" dir="ltr"></div>
                        <div id="structure_widget_empty" class="text-center py-5 text-secondary" style="display: none;">
                            <i class="ri-pie-chart-line fs-32 d-block mb-2 opacity-50"></i>
                            <span class="fs-13 fw-medium">Belum ada data pembayaran pada periode ini.</span>
                            <p class="fs-12 text-muted mb-0 mt-1">Ubah filter periode di atas untuk memuat catatan transaksi.</p>
                        </div>
                    </div>

                    <!-- 3 Individual Rounded Status Boxes -->
                    <div class="ref-status-list">
                        <div class="ref-status-row">
                            <div class="ref-status-left">
                                <span class="ref-status-dot" style="background: #34D399;"></span>
                                <span>Terbayar</span>
                            </div>
                            <div class="ref-status-right">
                                <span class="ref-status-amount tabular-nums" id="terbayar">Rp {{ number_format($datasInYear[0] ?? 0, 0, ',', '.') }}</span>
                                <span class="ref-status-pill ref-status-pill--emerald tabular-nums" id="persenTerbayar">94,7%</span>
                            </div>
                        </div>

                        <div class="ref-status-row">
                            <div class="ref-status-left">
                                <span class="ref-status-dot" style="background: #EF4444;"></span>
                                <span>Belum Bayar</span>
                            </div>
                            <div class="ref-status-right">
                                <span class="ref-status-amount tabular-nums" style="color: #F87171;" id="belumTerbayar">Rp {{ number_format($datasInYear[1] ?? 0, 0, ',', '.') }}</span>
                                <span class="ref-status-pill ref-status-pill--danger tabular-nums" id="persenBlmTerbayar">5,3%</span>
                            </div>
                        </div>

                        <div class="ref-status-row">
                            <div class="ref-status-left">
                                <span class="ref-status-dot" style="background: #64748B;"></span>
                                <span>Batal</span>
                            </div>
                            <div class="ref-status-right">
                                <span class="ref-status-amount tabular-nums" id="batal">Rp {{ number_format($datasInYear[2] ?? 0, 0, ',', '.') }}</span>
                                <span class="ref-status-pill ref-status-pill--slate tabular-nums" id="persenBatal">0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2: 4 STANDALONE KPI CARDS (Brand Harmonious Palette) -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-sm-6">
                <div class="ref-kpi-card">
                    <div class="ref-kpi-icon ref-kpi-icon--stone">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="ref-kpi-overline">Total kuantitas terjual</span>
                        <h3 class="ref-kpi-value tabular-nums text-truncate" id="summary-total-qty">0 Pcs</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="ref-kpi-card">
                    <div class="ref-kpi-icon ref-kpi-icon--emerald">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="ref-kpi-overline">Nilai penjualan</span>
                        <h3 class="ref-kpi-value tabular-nums text-truncate" id="summary-total-nominal">Rp 0</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="ref-kpi-card">
                    <div class="ref-kpi-icon ref-kpi-icon--brand">
                        <i class="ri-trophy-line"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="ref-kpi-overline">Jenis terpopuler</span>
                        <div class="text-truncate" id="summary-top-jenis">-</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="ref-kpi-card">
                    <div class="ref-kpi-icon ref-kpi-icon--amber">
                        <i class="ri-stack-line"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="ref-kpi-overline">Kategori terlaris</span>
                        <div class="text-truncate" id="summary-top-kategori">-</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 3: JENIS BARANG YANG DIBELI (LEFT) & KATEGORI BARANG (RIGHT) -->
        <div class="row g-4 mb-4" id="card-statistik-barang">
            <!-- Left Card: Jenis Barang yang Dibeli -->
            <div class="col-xl-6">
                <div class="ref-glass-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-3">
                            <div>
                                <h4 class="ref-card-title">Volume & Nilai Penjualan per Jenis</h4>
                                <p class="ref-card-subtitle" id="jenis-barang-subtitle">
                                    Barang apa yang mendominasi penjualan? · {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="segmented-control" role="group">
                                    <button type="button" class="segmented-item active" id="btn-metric-qty" onclick="switchJenisMetric('qty')">Qty (Pcs)</button>
                                    <button type="button" class="segmented-item" id="btn-metric-nominal" onclick="switchJenisMetric('nominal')">Nilai (Rp)</button>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Period Filter Strip for Barang -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <div class="segmented-control" role="group">
                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('today', this)" id="btn-barang-today">Hari Ini</button>
                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('week', this)" id="btn-barang-week">Minggu Ini</button>
                                <button type="button" class="segmented-item btn-filter-barang active" onclick="filterBarang('month', this)" id="btn-barang-month">Bulan Ini</button>
                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('year', this)" id="btn-barang-year">Tahun Ini</button>
                                <button type="button" class="segmented-item btn-filter-barang" onclick="filterBarang('last_year', this)" id="btn-barang-lastyear">Tahun Lalu</button>
                            </div>
                            <button type="button" class="btn-custom-filter" onclick="toggleCustomFilter()" id="btn-barang-custom">
                                <i class="ri-equalizer-line"></i> Filter Kustom
                            </button>
                        </div>

                        <!-- Collapsible Custom Filter Panel for Barang -->
                        <div id="panel-custom-filter" class="mb-3 custom-filter-panel d-flex flex-wrap align-items-center" style="display: none !important; padding: 10px 14px; gap: 10px;">
                            <div class="segmented-control payment-segmented-control" id="barang-submode-group" role="group">
                                <button type="button" class="segmented-item barang-submode active" data-mode="date" onclick="setBarangSubmode('date')">Tanggal</button>
                                <button type="button" class="segmented-item barang-submode" data-mode="month" onclick="setBarangSubmode('month')">Bulan</button>
                                <button type="button" class="segmented-item barang-submode" data-mode="year" onclick="setBarangSubmode('year')">Tahun</button>
                                <button type="button" class="segmented-item barang-submode" data-mode="range" onclick="setBarangSubmode('range')">Rentang</button>
                            </div>
                            <div class="d-inline-flex align-items-center gap-2" id="barang-inputs-container">
                                <input type="text" id="barang-input-date" class="form-control form-control-sm dash-input barang-ctrl active dash-flatpickr" style="width: 140px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Pilih Tanggal">
                                <div id="barang-ctrl-month" class="barang-ctrl">
                                    <select id="barang-input-bulan" class="form-select form-select-sm dash-select" style="width: 115px; height: 32px;">
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select id="barang-input-tahun-month" class="form-select form-select-sm dash-select" style="width: 84px; height: 32px;">
                                        @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div id="barang-ctrl-year" class="barang-ctrl">
                                    <select id="barang-input-year" class="form-select form-select-sm dash-select" style="width: 90px; height: 32px;">
                                        @for ($y = (int)date('Y'); $y >= 2022; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div id="barang-ctrl-range" class="barang-ctrl">
                                    <input type="text" id="barang-range-start" class="form-control form-control-sm dash-input dash-flatpickr" style="width: 130px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-01') }}" readonly placeholder="Dari Tanggal">
                                    <span class="text-secondary fs-12">s/d</span>
                                    <input type="text" id="barang-range-end" class="form-control form-control-sm dash-input dash-flatpickr" style="width: 130px; height: 32px; text-align: center; font-weight: 600; cursor: pointer;" value="{{ date('Y-m-d') }}" readonly placeholder="Sampai Tanggal">
                                </div>
                            </div>
                            <button type="button" class="btn btn-dash-primary" onclick="applyCustomFilter()">Tampilkan</button>
                        </div>
                        <span class="d-none" id="label-periode-barang"></span>

                        <!-- Custom Progress-Track Horizontal List -->
                        <div id="chart_jenis_empty" class="text-center py-5 text-secondary" style="display: none;">
                            <i class="ri-inbox-line fs-32 d-block mb-2 opacity-50"></i>
                            <span class="fs-13 fw-medium">Tidak ada transaksi penjualan barang pada rentang tanggal ini.</span>
                            <p class="fs-12 text-muted mb-0 mt-1">Ubah pilihan tanggal atau klik tombol filter periode untuk memuat data.</p>
                        </div>
                        <div id="chart_jenis_barang" class="pt-1"></div>
                    </div>
                </div>
            </div>

            <!-- Right Card: Kategori Barang -->
            <div class="col-xl-6">
                <div class="ref-glass-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h4 class="ref-card-title">Kontribusi Kategori Barang</h4>
                            <span class="ref-teal-badge" id="badge-total-kategori">0 Kategori</span>
                        </div>
                        <p class="ref-card-subtitle mb-2">Bagaimana distribusi penjualan antar kelompok kategori produk?</p>
                    </div>

                    <div id="chart_kategori_empty" class="text-center py-5 text-secondary" style="display: none;">
                        <i class="ri-pie-chart-line fs-32 d-block mb-2 opacity-50"></i>
                        <span class="fs-13 fw-medium">Belum ada transaksi kategori pada periode terpilih.</span>
                        <p class="fs-12 text-muted mb-0 mt-1">Pilih filter periode lain untuk melihat distribusi kategori.</p>
                    </div>
                    <div id="chart_kategori_barang" class="apex-charts my-1" style="min-height: 205px;"></div>

                    <!-- Table Rincian Kategori -->
                    <div class="table-responsive mt-2" id="table-kategori-container" style="max-height: 210px; overflow-y: auto;">
                        <table class="ref-clean-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-center">Kuantitas</th>
                                    <th class="text-end">Nilai (Rp)</th>
                                    <th class="text-end">Pangsa</th>
                                </tr>
                            </thead>
                            <tbody id="table-kategori-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 4: PEMBELIAN BELUM DIBAYAR PER VENDOR (FULL-WIDTH INLINE PROGRESS TABLE) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="ref-glass-card" id="card-hutang-vendor">
                    <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
                        <div>
                            <h4 class="ref-card-title" id="pembelian-chart-title">Kewajiban Tagihan per Vendor</h4>
                            <p class="ref-card-subtitle" id="pembelian-chart-subtitle">
                                Vendor mana yang memiliki sisa tagihan berjalan terbesar untuk segera dilunasi?
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="dash-segmented-group" aria-label="Filter status vendor">
                                <button type="button" class="dash-btn-filter active" id="btn-filter-belum-lunas" onclick="setVendorStatusFilter('belum_lunas')">Belum Lunas</button>
                                <button type="button" class="dash-btn-filter" id="btn-filter-lunas" onclick="setVendorStatusFilter('lunas')">Lunas</button>
                                <button type="button" class="dash-btn-filter" id="btn-filter-semua-status" onclick="setVendorStatusFilter('all')">Semua</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="ref-clean-table align-middle mb-0" id="tableDaftarVendor">
                            <thead>
                                <tr>
                                    <th style="width: 24%;">Vendor</th>
                                    <th style="width: 44%;">Proporsi sisa hutang</th>
                                    <th class="text-end" style="width: 16%;">Total beli</th>
                                    <th class="text-end" style="width: 16%;">Sisa tagihan</th>
                                </tr>
                            </thead>
                            <tbody id="vendor-tagihan-tbody">
                                <!-- Dynamic rows injected by renderVendorTable() -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('plugins')
    <!-- apexcharts -->
    <script src="{{asset('libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Dashboard Data Injection (Isolated to prevent any script breakage) -->
    <script id="dashboard-data-init">
        window.hourArrayJS = {!! json_encode($hourArray ?? []) !!};
        window.dateArrayJS = {!! json_encode($dateArray ?? []) !!};
        window.dateArrayLastYearJS = {!! json_encode($dateArrayLastYear ?? []) !!};
        window.weekArrayJS = {!! json_encode($weekArray ?? []) !!};
        window.monthArrayJS = {!! json_encode($monthArray ?? []) !!};
        window.monthArrayLastYearJS = {!! json_encode($monthArrayLastYear ?? []) !!};
        window.totalJamArrayJS = {!! json_encode($totalJamArray ?? []) !!};
        window.totalHarianArrayJS = {!! json_encode($totalHarianArray ?? []) !!};
        window.totalHarianLastYearArrayJS = {!! json_encode($totalHarianArrayLastYear ?? []) !!};
        window.totalMingguanArrayJS = {!! json_encode($totalMingguanArray ?? []) !!};
        window.totalBulananArrayJS = {!! json_encode($totalBulananArray ?? []) !!};
        window.totalBulananArrayLastYearJS = {!! json_encode($totalBulananArrayLastYear ?? []) !!};
        window.totalPerHari = {!! json_encode($jumlahPerHari ?? []) !!};
        window.totalPerMinggu = {!! json_encode($jumlahPerMinggu ?? []) !!};
        window.totalPerBulan = {!! json_encode($jumlahPerBulan ?? []) !!};
        window.totalPerTahun = {!! json_encode($jumlahPerTahun ?? []) !!};

        // Week
        window.datasWeekJS = {!! json_encode($datasInWeek ?? []) !!};
        window.percentInWeekJS = {!! json_encode($percentageInWeek ?? []) !!};
        window.percentNotPaidWeekJS = {!! json_encode($percentageNotPaidWeek ?? []) !!};
        window.percentCanceledWeekJS = {!! json_encode($percentageCanceledWeek ?? []) !!};

        // Month
        window.datasMonthJS = {!! json_encode($datasInMonth ?? []) !!};
        window.percentInMonthJS = {!! json_encode($percentageInMonth ?? []) !!};
        window.percentNotPaidMonthJS = {!! json_encode($percentageNotPaidMonth ?? []) !!};
        window.percentCanceledMonthJS = {!! json_encode($percentageCanceledMonth ?? []) !!};

        // Year
        window.datasYearJS = {!! json_encode($datasInYear ?? []) !!};
        window.percentInYearJS = {!! json_encode($percentageInYear ?? []) !!};
        window.percentNotPaidYearJS = {!! json_encode($percentageNotPaidYear ?? []) !!};
        window.percentCanceledYearJS = {!! json_encode($percentageCanceledYear ?? []) !!};

        // Last Year
        window.datasLastYearJS = {!! json_encode($datasInLastYear ?? []) !!};
        window.percentInLastYearJS = {!! json_encode($percentageInLastYear ?? []) !!};
        window.percentNotPaidLastYearJS = {!! json_encode($percentageNotPaidLastYear ?? []) !!};
        window.percentCanceledLastYearJS = {!! json_encode($percentageCanceledLastYear ?? []) !!};

        // PO
        window.hourArrayJSPO = {!! json_encode($hourArrayPO ?? []) !!};
        window.dateArrayJSPO = {!! json_encode($dateArrayPO ?? []) !!};
        window.weekArrayJSPO = {!! json_encode($weekArrayPO ?? []) !!};
        window.monthArrayJSPO = {!! json_encode($monthArrayPO ?? []) !!};
        window.totalJamArrayJSPO = {!! json_encode($totalJamArrayPO ?? []) !!};
        window.totalHarianArrayJSPO = {!! json_encode($totalHarianArrayPO ?? []) !!};
        window.totalMingguanArrayJSPO = {!! json_encode($totalMingguanArrayPO ?? []) !!};
        window.totalBulananArrayJSPO = {!! json_encode($totalBulananArrayPO ?? []) !!};
        window.totalPerHariPO = {!! json_encode($jumlahPerHariPO ?? []) !!};
        window.totalPerMingguPO = {!! json_encode($jumlahPerMingguPO ?? []) !!};
        window.totalPerBulanPO = {!! json_encode($jumlahPerBulanPO ?? []) !!};
        window.totalPerTahunPO = {!! json_encode($jumlahPerTahunPO ?? []) !!};

        window.lunasTodayPO = {!! json_encode($jumlahPOLunasToday ?? 0) !!};
        window.blmLunasTodayPO = {!! json_encode($jumlahPOBlmLunasToday ?? 0) !!};
        window.lunasWeekPO = {!! json_encode($jumlahPOLunasWeek ?? 0) !!};
        window.blmLunasWeekPO = {!! json_encode($jumlahPOBlmLunasWeek ?? 0) !!};
        window.lunasMonthPO = {!! json_encode($jumlahPOLunasMonth ?? 0) !!};
        window.blmLunasMonthPO = {!! json_encode($jumlahPOBlmLunasMonth ?? 0) !!};
        window.lunasYearPO = {!! json_encode($jumlahPOLunasYear ?? 0) !!};
        window.blmLunasYearPO = {!! json_encode($jumlahPOBlmLunasYear ?? 0) !!};

        window.countLunasYearJS = {!! json_encode($countLunasYear ?? 0) !!};
        window.countBlmLunasYearJS = {!! json_encode($countBlmLunasYear ?? 0) !!};
        window.countLunasMonthJS = {!! json_encode($countLunasMonth ?? 0) !!};
        window.countBlmLunasMonthJS = {!! json_encode($countBlmLunasMonth ?? 0) !!};
        window.countLunasWeekJS = {!! json_encode($countLunasWeek ?? 0) !!};
        window.countBlmLunasWeekJS = {!! json_encode($countBlmLunasWeek ?? 0) !!};
        window.countLunasLastYearJS = {!! json_encode($countLunasLastYear ?? 0) !!};
        window.countBlmLunasLastYearJS = {!! json_encode($countBlmLunasLastYear ?? 0) !!};
        window.countLunasTodayJS = {!! json_encode($countLunasToday ?? 0) !!};
        window.countBlmLunasTodayJS = {!! json_encode($countBlmLunasToday ?? 0) !!};

        window.namaVendor = {!! json_encode($datavendor ?? []) !!};
        window.totalSisa = {!! json_encode($datasisa ?? []) !!};
        window.allVendorData = {!! json_encode($vendorList ?? []) !!};
        window.dataPembelianInvoiceJS = {!! json_encode($dataPembelianInvoice ?? []) !!};
        window.daftarTagihanVendorJS = {!! json_encode($daftarTagihanVendor ?? []) !!};

        // Aliases for global scope
        var hourArrayJS = window.hourArrayJS;
        var dateArrayJS = window.dateArrayJS;
        var dateArrayLastYearJS = window.dateArrayLastYearJS;
        var weekArrayJS = window.weekArrayJS;
        var monthArrayJS = window.monthArrayJS;
        var monthArrayLastYearJS = window.monthArrayLastYearJS;
        var totalJamArrayJS = window.totalJamArrayJS;
        var totalHarianArrayJS = window.totalHarianArrayJS;
        var totalHarianLastYearArrayJS = window.totalHarianLastYearArrayJS;
        var totalMingguanArrayJS = window.totalMingguanArrayJS;
        var totalBulananArrayJS = window.totalBulananArrayJS;
        var totalBulananArrayLastYearJS = window.totalBulananArrayLastYearJS;
        var totalPerHari = window.totalPerHari;
        var totalPerMinggu = window.totalPerMinggu;
        var totalPerBulan = window.totalPerBulan;
        var totalPerTahun = window.totalPerTahun;
        var datasWeekJS = window.datasWeekJS;
        var percentInWeekJS = window.percentInWeekJS;
        var percentNotPaidWeekJS = window.percentNotPaidWeekJS;
        var percentCanceledWeekJS = window.percentCanceledWeekJS;
        var datasMonthJS = window.datasMonthJS;
        var percentInMonthJS = window.percentInMonthJS;
        var percentNotPaidMonthJS = window.percentNotPaidMonthJS;
        var percentCanceledMonthJS = window.percentCanceledMonthJS;
        var datasYearJS = window.datasYearJS;
        var percentInYearJS = window.percentInYearJS;
        var percentNotPaidYearJS = window.percentNotPaidYearJS;
        var percentCanceledYearJS = window.percentCanceledYearJS;
        var datasLastYearJS = window.datasLastYearJS;
        var percentInLastYearJS = window.percentInLastYearJS;
        var percentNotPaidLastYearJS = window.percentNotPaidLastYearJS;
        var percentCanceledLastYearJS = window.percentCanceledLastYearJS;
        var hourArrayJSPO = window.hourArrayJSPO;
        var dateArrayJSPO = window.dateArrayJSPO;
        var weekArrayJSPO = window.weekArrayJSPO;
        var monthArrayJSPO = window.monthArrayJSPO;
        var totalJamArrayJSPO = window.totalJamArrayJSPO;
        var totalHarianArrayJSPO = window.totalHarianArrayJSPO;
        var totalMingguanArrayJSPO = window.totalMingguanArrayJSPO;
        var totalBulananArrayJSPO = window.totalBulananArrayJSPO;
        var totalPerHariPO = window.totalPerHariPO;
        var totalPerMingguPO = window.totalPerMingguPO;
        var totalPerBulanPO = window.totalPerBulanPO;
        var totalPerTahunPO = window.totalPerTahunPO;
        var lunasTodayPO = window.lunasTodayPO;
        var blmLunasTodayPO = window.blmLunasTodayPO;
        var lunasWeekPO = window.lunasWeekPO;
        var blmLunasWeekPO = window.blmLunasWeekPO;
        var lunasMonthPO = window.lunasMonthPO;
        var blmLunasMonthPO = window.blmLunasMonthPO;
        var lunasYearPO = window.lunasYearPO;
        var blmLunasYearPO = window.blmLunasYearPO;
        var countLunasYearJS = window.countLunasYearJS;
        var countBlmLunasYearJS = window.countBlmLunasYearJS;
        var countLunasMonthJS = window.countLunasMonthJS;
        var countBlmLunasMonthJS = window.countBlmLunasMonthJS;
        var countLunasWeekJS = window.countLunasWeekJS;
        var countBlmLunasWeekJS = window.countBlmLunasWeekJS;
        var countLunasLastYearJS = window.countLunasLastYearJS;
        var countBlmLunasLastYearJS = window.countBlmLunasLastYearJS;
        var countLunasTodayJS = window.countLunasTodayJS;
        var countBlmLunasTodayJS = window.countBlmLunasTodayJS;
        var namaVendor = window.namaVendor;
        var totalSisa = window.totalSisa;
        var allVendorData = window.allVendorData;
        var dataPembelianInvoiceJS = window.dataPembelianInvoiceJS;
        var daftarTagihanVendorJS = window.daftarTagihanVendorJS;
    </script>

    <!-- Dashboard UI & Theme Logic -->
    <script>
        var vendorStatusFilter = 'belum_lunas';

        function setVendorStatusFilter(status) {
            vendorStatusFilter = status;
            ['belum-lunas', 'lunas', 'semua-status'].forEach(function(name) {
                var button = document.getElementById('btn-filter-' + name);
                if (!button) return;
                var isActive = (name === 'belum-lunas' && status === 'belum_lunas') ||
                               (name === 'lunas' && status === 'lunas') ||
                               (name === 'semua-status' && status === 'all');
                button.classList.toggle('active', isActive);
            });
            renderVendorTable();
        }

        function renderVendorTable() {
            var tbody = document.getElementById('vendor-tagihan-tbody');
            if (!tbody) return;

            var list = window.daftarTagihanVendorJS || [];
            var filteredVendors = list.filter(function(row) {
                var isLunas = Number(row.sisa_tagihan) <= 0;
                return vendorStatusFilter === 'all' || (vendorStatusFilter === 'lunas' ? isLunas : !isLunas);
            });

            // Urutkan dari sisa tagihan terbesar ke terkecil
            var sortedVendors = filteredVendors.slice().sort(function(a, b) {
                var diffSisa = Number(b.sisa_tagihan || 0) - Number(a.sisa_tagihan || 0);
                if (diffSisa !== 0) return diffSisa;
                return Number(b.total_pembelian || 0) - Number(a.total_pembelian || 0);
            });

            if (sortedVendors.length === 0) {
                var emptyMsg = vendorStatusFilter === 'belum_lunas'
                    ? 'Semua tagihan vendor telah lunas atau tidak ada pembelian berjalan pada periode ini.'
                    : 'Tidak ada data pembelian vendor yang sesuai dengan filter yang dipilih.';
                tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-secondary">' +
                    '<i class="ri-file-list-3-line fs-24 d-block mb-1 opacity-50"></i>' +
                    '<span class="fs-13 fw-medium">' + emptyMsg + '</span>' +
                    '<p class="fs-12 text-muted mb-0 mt-1">Pilih filter status "Semua" di atas untuk melihat riwayat lengkap.</p>' +
                    '</td></tr>';
                return;
            }

            var maxSisa = Math.max.apply(Math, sortedVendors.map(function(r) { return Number(r.sisa_tagihan) || 0; })) || 1;

            var html = '';
            sortedVendors.forEach(function(row) {
                var sisaVal = Number(row.sisa_tagihan) || 0;
                var totalVal = Number(row.total_pembelian) || 0;
                var formattedTotal = totalVal.toLocaleString('id-ID');
                var formattedSisa = sisaVal.toLocaleString('id-ID');
                var isLunas = sisaVal <= 0;
                var pct = isLunas ? 0 : Math.max(1.8, Math.min(100, (sisaVal / maxSisa) * 100));

                html += '<tr class="dash-row-anim">' +
                    '<td><span class="fw-bold text-white">' + (row.nama_vendor || '-') + '</span></td>' +
                    '<td><div class="ref-vendor-track"><div class="ref-vendor-fill" data-target-width="' + pct.toFixed(1) + '%" style="width: ' + pct.toFixed(1) + '%;"></div></div></td>' +
                    '<td class="text-end tabular-nums" style="color: #94A3B8;">Rp ' + formattedTotal + '</td>' +
                    '<td class="text-end">' +
                    (isLunas
                        ? '<span class="ref-paid-pill">Lunas</span>'
                        : '<span class="ref-debt-pill tabular-nums">Rp ' + formattedSisa + '</span>') +
                    '</td>' +
                '</tr>';
            });

            tbody.innerHTML = html;
        }

        // ==========================================================================
        // CIRCULAR REVEAL THEME TRANSITION (View Transitions API)
        // ==========================================================================
        var isThemeTransitioning = false;

        function setThemeDOM(theme) {
            var isLight = theme === 'light';
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-layout-mode', theme);
            document.documentElement.setAttribute('data-sidebar', isLight ? 'light' : 'dark');
            document.documentElement.classList.toggle('theme-light', isLight);
            document.documentElement.classList.toggle('theme-dark', !isLight);
            if (document.body) {
                document.body.classList.toggle('theme-light', isLight);
                document.body.classList.toggle('theme-dark', !isLight);
            }
            try {
                localStorage.setItem('ibekami_dash_theme', theme);
                sessionStorage.setItem('data-layout-mode', theme);
                sessionStorage.setItem('data-sidebar', isLight ? 'light' : 'dark');
            } catch (e) {
                console.warn('Storage is not available:', e);
            }
        }

        function updateButtonUI(theme) {
            var isLight = theme === 'light';
            var btnText = document.getElementById('theme-toggle-text');
            var btnIcon = document.getElementById('theme-toggle-icon');
            if (btnText) btnText.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
            if (btnIcon) btnIcon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
        }

        function updateAllChartsTheme(theme) {
            var isLight = theme === 'light';
            var labelColor = isLight ? '#64748B' : '#94A3B8';
            var gridColor = isLight ? '#E2E8F0' : 'rgba(255, 255, 255, 0.05)';
            var promises = [];

            if (window.chart) {
                try {
                    var p1 = window.chart.updateOptions({
                        xaxis: { labels: { style: { colors: labelColor } } },
                        yaxis: { labels: { style: { colors: labelColor } } },
                        grid: { borderColor: gridColor },
                        tooltip: { theme: isLight ? 'light' : 'dark' }
                    }, false, false);
                    if (p1 && typeof p1.then === 'function') promises.push(p1);
                } catch (e) {}
            }

            if (window.chartKategori) {
                try {
                    var p2 = window.chartKategori.updateOptions({
                        legend: { labels: { colors: isLight ? '#334155' : '#CBD5E1' } },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        value: { color: isLight ? '#0F172A' : '#FFFFFF' },
                                        name: { color: isLight ? '#64748B' : '#94A3B8' },
                                        total: { color: isLight ? '#64748B' : '#94A3B8' }
                                    }
                                }
                            }
                        }
                    }, false, false);
                    if (p2 && typeof p2.then === 'function') promises.push(p2);
                } catch (e) {}
            }

            if (window.charts) {
                try {
                    var p3 = window.charts.updateOptions({
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        value: { color: isLight ? '#0F172A' : '#FFFFFF' },
                                        name: { color: isLight ? '#64748B' : '#94A3B8' },
                                        total: { color: isLight ? '#64748B' : '#94A3B8' }
                                    }
                                }
                            }
                        }
                    }, false, false);
                    if (p3 && typeof p3.then === 'function') promises.push(p3);
                } catch (e) {}
            }

            if (typeof syncStickyPaymentYAxis === 'function') {
                syncStickyPaymentYAxis();
            }

            if (promises.length > 0) {
                return Promise.all(promises);
            }
            return Promise.resolve();
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
                setThemeDOM(targetTheme);
                updateAllChartsTheme(targetTheme);
                updateButtonUI(targetTheme);
                isThemeTransitioning = false;
                return;
            }

            var btn = document.getElementById('btn-theme-toggle');
            if (btn) btn.classList.add('theme-switching');

            var x = window.innerWidth / 2;
            var y = window.innerHeight / 2;
            if (btn) {
                var rect = btn.getBoundingClientRect();
                x = rect.left + rect.width / 2;
                y = rect.top + rect.height / 2;
            }
            var endRadius = Math.hypot(
                Math.max(x, window.innerWidth - x),
                Math.max(y, window.innerHeight - y)
            );

            try {
                var transition = document.startViewTransition(function() {
                    setThemeDOM(targetTheme);
                    updateAllChartsTheme(targetTheme);
                    updateButtonUI(targetTheme);
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
                setThemeDOM(targetTheme);
                updateAllChartsTheme(targetTheme);
                updateButtonUI(targetTheme);
                if (btn) btn.classList.remove('theme-switching');
                isThemeTransitioning = false;
            }
        }

        // Restore saved theme on page load (Default to light)
        document.addEventListener('DOMContentLoaded', function() {
            var saved = 'light';
            try {
                saved = localStorage.getItem('ibekami_dash_theme') || 'light';
            } catch (e) {
                saved = 'light';
            }
            setThemeDOM(saved);
            updateButtonUI(saved);
            updateAllChartsTheme(saved);
            renderVendorTable();

            // Initialize Modern Flatpickr on Dashboard Date Inputs
            if (typeof flatpickr !== 'undefined') {
                flatpickr('.dash-flatpickr', {
                    dateFormat: "Y-m-d",
                    disableMobile: true,
                    animate: true
                });
            }
        });
    </script>
    <script src="{{asset('js/halaman/dashboard.js')}}"></script>
    <script src="{{asset('js/halaman/dashboard-barang.js')}}"></script>
@endsection
