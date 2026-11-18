@extends('layout.template')

@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       TOKABE VENDOR PURCHASES — UNSLOPPED DUAL THEME DESIGN SYSTEM
       Matching Daftar Vendor, Daftar Barang, and Invoice standards
       ========================================================================== */

    :root {
      /* Mode Gelap (Default) — Dashboard Identical Warm Stone & Charcoal */
      --ibk-bg: #0C0A09;
      --ibk-surface: #14110F;
      --ibk-surface-hover: #1A1613;
      --ibk-card-bg: #14110F;
      --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
      --ibk-border: rgba(255, 255, 255, 0.08);
      --ibk-border-subtle: rgba(255, 255, 255, 0.04);
      --ibk-text: #FAFAFA;
      --ibk-text-muted: #A1A1AA;
      --ibk-text-dim: #71717A;

      /* Brand Accent — Golden Amber / Tokabe Orange */
      --ibk-brand: #F59E0B;
      --ibk-brand-deep: #EA580C;
      --ibk-brand-soft: rgba(245, 158, 11, 0.12);
      --ibk-brand-border: rgba(245, 158, 11, 0.24);
      --ibk-brand-text: #FBBF24;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      /* Semantics — Identik Dashboard */
      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.14);
      --ibk-success-border: rgba(16, 185, 129, 0.28);
      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.14);
      --ibk-danger-border: rgba(239, 68, 68, 0.28);

      /* Inputs & Dropdowns (No Blue Tint) */
      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #FAFAFA;
      --ibk-input-placeholder: #71717A;
      --ibk-popover-bg: #181412;

      /* Table — Identik Dashboard ref-clean-table */
      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.06);
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      /* Mode Terang — Neutral Slate & Crisp Craft Surface */
      --ibk-bg: #F8FAFC;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FFF7ED;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
      --ibk-border: #E2E8F0;
      --ibk-border-subtle: #F1F5F9;
      --ibk-text: #0F172A;
      --ibk-text-muted: #64748B;
      --ibk-text-dim: #94A3B8;

      /* Brand Accent (Light) */
      --ibk-brand: #EA580C;
      --ibk-brand-deep: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #EA580C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      /* Semantics (Light) */
      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;

      /* Inputs & Dropdowns (Light) */
      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-input-placeholder: #94A3B8;
      --ibk-popover-bg: #FFFFFF;

      /* Table (Light) */
      --ibk-th-bg: #F8FAFC;
      --ibk-th-text: #64748B;
      --ibk-td-border: #E2E8F0;
    }

    /* Tabular Numerics */
    .num, .price, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    /* Page Wrapper with safe bottom clearance */
    .vendor-page-wrapper {
      position: relative;
      width: 100%;
      min-height: calc(100vh - 120px);
      padding-bottom: 85px !important;
      margin-bottom: 24px !important;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      color: var(--ibk-text);
    }

    /* Header Section (Unified Pattern) */
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
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .ibk-page-subtitle {
      font-size: 13px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
    }

    /* Secondary Back Button */
    .ibk-btn-back {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text) !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      padding: 0 14px !important;
      height: 38px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      text-decoration: none !important;
      transition: all 150ms ease !important;
    }
    .ibk-btn-back:hover {
      background: var(--ibk-surface-hover) !important;
      border-color: var(--ibk-brand-border) !important;
      color: var(--ibk-brand) !important;
    }

    /* Primary Craft Action Button */
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

    /* Theme Toggle Button (Identik Dashboard) */
    .ref-theme-toggle {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 0 16px;
      height: 38px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      background: var(--ibk-input-bg);
      border: 1px solid var(--ibk-border);
      color: var(--ibk-text);
      transition: all 180ms ease;
      white-space: nowrap;
    }
    .ref-theme-toggle:hover {
      background: var(--ibk-surface-hover);
      border-color: var(--ibk-brand-border);
      transform: translateY(-1px);
      color: var(--ibk-brand);
    }
    .ref-theme-toggle:active {
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

    /* KPI Summary Cards (Unslopped: Editorial Numbers & Tactile Hierarchy) */
    .ibk-kpi-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      padding: 16px 20px;
      box-shadow: var(--ibk-card-shadow);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: transform 150ms ease, border-color 150ms ease;
      height: 100%;
    }
    .ibk-kpi-card:hover {
      transform: translateY(-1px);
      border-color: var(--ibk-brand-border);
    }
    .kpi-title {
      font-size: 12px;
      font-weight: 500;
      color: var(--ibk-text-muted);
      margin-bottom: 4px;
    }
    .kpi-amount {
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -0.015em;
      line-height: 1.2;
      margin-bottom: 0;
      color: var(--ibk-text);
    }
    .kpi-icon-box {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }
    .icon-box-amber {
      background-color: var(--ibk-brand-soft);
      color: var(--ibk-brand);
      border: 1px solid var(--ibk-brand-border);
    }
    .icon-box-emerald {
      background-color: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
    }
    .icon-box-rose {
      background-color: var(--ibk-danger-soft);
      color: var(--ibk-danger);
      border: 1px solid var(--ibk-danger-border);
    }

    /* Table Section Card */
    .ibk-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      margin-bottom: 24px;
      overflow: hidden;
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
    .ibk-card-toolbar {
      padding: 14px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      border-bottom: 1px solid var(--ibk-border);
      background: transparent;
    }
    .ibk-card-title {
      font-size: 14.5px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .ibk-card-title i {
      font-size: 18px;
      color: var(--ibk-brand);
    }
    .badge-count-pill {
      background: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
      padding: 2px 8px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
    }

    /* Filters Bar Controls */
    .tokabe-search-wrapper {
      position: relative;
      width: 280px;
      max-width: 100%;
    }
    .tokabe-search-input {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      padding-left: 36px !important;
      padding-right: 32px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-search-input::placeholder {
      color: var(--ibk-input-placeholder) !important;
    }
    .tokabe-search-input:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }
    .tokabe-search-icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: var(--ibk-text-muted);
      font-size: 14px;
      pointer-events: none;
    }
    .form-select-tokabe {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      padding: 6px 12px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-select-tokabe:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }
    .btn-reset-filter {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 8px !important;
      width: 36px !important;
      height: 36px !important;
      padding: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 0.15s ease;
      cursor: pointer;
    }
    .btn-reset-filter:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }

    /* Table Styles (Clean, Standard Tokabe Table) */
    .tokabe-table {
      width: 100% !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      margin: 0 !important;
      background: transparent !important;
    }
    .tokabe-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text) !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      border-top: none !important;
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 12px 18px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 13px 18px !important;
      font-size: 13px !important;
      vertical-align: middle;
      color: var(--ibk-text) !important;
      background-color: transparent !important;
    }
    .tokabe-table tbody tr {
      transition: background-color 150ms ease;
    }
    .tokabe-table tbody tr:hover td {
      background-color: var(--ibk-surface-hover) !important;
    }

    /* Invoice Text (Dashboard-Matched Clean Typography) */
    .tokabe-inv-text {
      color: var(--ibk-text) !important;
      font-size: 13.5px !important;
      font-weight: 700 !important;
      font-variant-numeric: tabular-nums !important;
      letter-spacing: -0.01em;
      background: transparent !important;
      border: none !important;
      padding: 0 !important;
      display: inline-block;
    }
    body.theme-light .tokabe-inv-text {
      color: #0F172A !important;
    }

    /* Badges — Identik Dashboard ref-paid-pill & ref-debt-pill */
    .badge-status-lunas {
      background: rgba(16, 185, 129, 0.14) !important;
      border: 1px solid rgba(16, 185, 129, 0.28) !important;
      color: #6EE7B7 !important;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 6px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    body.theme-light .badge-status-lunas {
      background: #ECFDF5 !important;
      border-color: #A7F3D0 !important;
      color: #059669 !important;
    }
    .badge-status-pending {
      background: rgba(239, 68, 68, 0.14) !important;
      border: 1px solid rgba(239, 68, 68, 0.28) !important;
      color: #FCA5A5 !important;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 6px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    body.theme-light .badge-status-pending {
      background: #FEF2F2 !important;
      border-color: #FECACA !important;
      color: #DC2626 !important;
    }
    .badge-access-locked {
      background-color: rgba(245, 158, 11, 0.14) !important;
      border: 1px solid rgba(245, 158, 11, 0.28) !important;
      color: #FBBF24 !important;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 6px;
      font-size: 11.5px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }
    body.theme-light .badge-access-locked {
      background: #FFFBEB !important;
      border-color: #FDE68A !important;
      color: #D97706 !important;
    }
    .badge-access-unlocked {
      background-color: rgba(16, 185, 129, 0.14) !important;
      border: 1px solid rgba(16, 185, 129, 0.28) !important;
      color: #6EE7B7 !important;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 6px;
      font-size: 11.5px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }
    body.theme-light .badge-access-unlocked {
      background: #ECFDF5 !important;
      border-color: #A7F3D0 !important;
      color: #059669 !important;
    }

    /* Tabular Numerics */
    .tokabe-cell-nominal {
      color: var(--ibk-text) !important;
      font-weight: 600;
    }
    .tokabe-amount-terbayar {
      color: var(--ibk-success) !important;
      font-weight: 600;
    }
    .tokabe-amount-sisa-unpaid {
      color: var(--ibk-danger) !important;
      font-weight: 600;
    }
    .tokabe-amount-sisa-zero {
      color: var(--ibk-text-muted) !important;
      font-weight: 600;
    }

    /* Action Ghost Button & Dropdown */
    .btn-action-ghost {
      background: transparent !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 6px !important;
      width: 32px !important;
      height: 32px !important;
      padding: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 150ms ease;
      cursor: pointer;
    }
    .btn-action-ghost:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }
    .dropdown-menu {
      background: var(--ibk-popover-bg) !important;
      border: 1px solid var(--ibk-border) !important;
      border-radius: 8px !important;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25) !important;
      padding: 6px !important;
      z-index: 1050 !important;
    }
    .dropdown-item {
      color: var(--ibk-text) !important;
      border-radius: 6px !important;
      padding: 8px 12px !important;
      font-size: 13px !important;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 150ms ease;
      background: transparent;
      border: none;
      width: 100%;
      text-align: left;
    }
    .dropdown-item:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
    }
    .dropdown-item--danger {
      color: var(--ibk-danger) !important;
    }
    .dropdown-item--danger:hover {
      background: var(--ibk-danger-soft) !important;
      color: var(--ibk-danger) !important;
    }
    .dropdown-divider {
      border-color: var(--ibk-border) !important;
      margin: 4px 0 !important;
    }
  </style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="vendor-page-wrapper">

      <!-- 1. Header & Quick Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <span>Daftar Pembelian &mdash; {{ $vendor->nama_vendor }}</span>
          </h1>
          <div class="ibk-page-subtitle">Riwayat nota transaksi, status jatuh tempo, dan pelunasan tagihan supplier</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('vendor.list') }}" class="ibk-btn-back" title="Kembali ke Daftar Vendor">
            <i class="ri-arrow-left-line"></i>
            <span>Daftar Vendor</span>
          </a>
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          <a href="{{ route('pembelian.add', ['uid' => $vendor->id]) }}" class="ibk-btn-primary" aria-label="Tambah Pembelian Baru">
            <i class="ri-add-line fs-16" aria-hidden="true"></i>
            <span>Tambah Pembelian</span>
          </a>
        </div>
      </div>

      {{-- Flash Messages --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" role="alert" style="background: var(--ibk-success-soft); border: 1px solid var(--ibk-success-border); color: var(--ibk-success); border-radius: 8px;">
          <i class="ri-checkbox-circle-fill fs-18 me-2"></i>
          <div class="flex-grow-1 fs-13 fw-medium">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert" style="background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border); color: var(--ibk-danger); border-radius: 8px;">
          <i class="ri-error-warning-fill fs-18 me-2"></i>
          <div class="flex-grow-1 fs-13 fw-medium">{{ session('error') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      <!-- 2. Summary KPI Cards (§12.4) -->
      <div class="row g-3 mb-4">
        <!-- KPI 1: Total Pembelian -->
        <div class="col-xl-3 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">Total Pembelian</div>
              <h4 class="kpi-amount num" aria-label="Total Pembelian: Rp {{ number_format($totalTagihan, 0, ',', '.') }}">
                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-amber" aria-hidden="true">
              <i class="ri-file-list-3-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 2: Total Terbayar -->
        <div class="col-xl-3 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">Total Terbayar</div>
              <h4 class="kpi-amount num" style="color: var(--ibk-success);" aria-label="Total Terbayar: Rp {{ number_format($totalTerbayar, 0, ',', '.') }}">
                Rp {{ number_format($totalTerbayar, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="ri-checkbox-circle-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 3: Sisa Belum Dibayar -->
        <div class="col-xl-3 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">Sisa Belum Dibayar</div>
              <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? 'var(--ibk-danger)' : 'var(--ibk-text-muted)' }};" aria-label="Sisa Belum Dibayar: Rp {{ number_format($totalSisa, 0, ',', '.') }}">
                Rp {{ number_format($totalSisa, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="ri-error-warning-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 4: Sisa Duit Kas -->
        <div class="col-xl-3 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="d-flex align-items-center gap-2 mb-1">
                <div class="kpi-title mb-0">Sisa Duit Kas</div>
                @if(($sisaKas ?? 0) < 0)
                  <span class="badge py-0.5 px-2 fs-10 fw-semibold" style="background: var(--ibk-danger-soft); color: var(--ibk-danger); border: 1px solid var(--ibk-danger-border);">Minus</span>
                @else
                  <span class="badge py-0.5 px-2 fs-10 fw-semibold" style="background: var(--ibk-success-soft); color: var(--ibk-success); border: 1px solid var(--ibk-success-border);">Tersedia</span>
                @endif
              </div>
              <h4 class="kpi-amount num" style="color: {{ ($sisaKas ?? 0) >= 0 ? 'var(--ibk-success)' : 'var(--ibk-danger)' }};">
                @if(($sisaKas ?? 0) < 0)
                  -Rp {{ number_format(abs($sisaKas ?? 0), 0, ',', '.') }}
                @else
                  Rp {{ number_format($sisaKas ?? 0, 0, ',', '.') }}
                @endif
              </h4>
            </div>
            <div class="kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-emerald' : 'icon-box-rose' }}" aria-hidden="true">
              <i class="ri-wallet-3-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Table Section: Riwayat Transaksi Pembelian -->
      <div class="ibk-card" id="cardDaftarPembelian">
        <!-- Card Header: Title on Top -->
        <div class="ibk-card-header">
          <div class="d-flex align-items-center gap-2">
            <div class="ibk-card-title">
              <i class="ri-history-line"></i>
              <span>Riwayat Transaksi &mdash; {{ $vendor->nama_vendor }}</span>
            </div>
            <span class="badge-count-pill" id="pembelianCountBadge">{{ count($pembelian) }} Nota</span>
          </div>
        </div>

        <!-- Card Toolbar: Search Bar on LEFT, Filters on RIGHT -->
        <div class="ibk-card-toolbar">
          <!-- Left: Search Box -->
          <div class="tokabe-search-wrapper">
            <i class="ri-search-line tokabe-search-icon"></i>
            <input type="text" id="searchPembelianInput" class="form-control tokabe-search-input" placeholder="Cari nomor invoice / tanggal...">
            <button type="button" id="clearPembelianSearch" class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-muted p-0 me-2 d-none" style="text-decoration: none;" title="Hapus pencarian">
              <i class="ri-close-line fs-14"></i>
            </button>
          </div>

          <!-- Right: Filters & Actions -->
          <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
            <!-- Filter Status Pembayaran -->
            <select id="filterStatusPembelian" class="form-select form-select-tokabe" style="width: 170px;" title="Filter status tagihan">
              <option value="all">Semua Status</option>
              <option value="Lunas">Hanya Lunas</option>
              <option value="Belum Lunas">Hanya Belum Lunas</option>
            </select>

            <!-- Filter Status Akses Edit -->
            <select id="filterAksesPembelian" class="form-select form-select-tokabe" style="width: 170px;" title="Filter status akses edit">
              <option value="all">Semua Akses</option>
              <option value="Unlock">Akses Terbuka</option>
              <option value="Lock">Akses Terkunci</option>
            </select>

            <!-- Urutan / Sort Filter -->
            <select id="sortPembelianSelect" class="form-select form-select-tokabe" style="width: 210px;" title="Urutkan data nota">
              <option value="terbaru" selected>Terbaru (Default)</option>
              <option value="sisa_desc">Sisa Belum Dibayar (Tertinggi)</option>
              <option value="total_desc">Total Pembelian (Tertinggi)</option>
            </select>

            <button type="button" class="btn btn-reset-filter" id="btnResetPembelianFilter" title="Reset filter" onclick="resetPembelianFilters()">
              <i class="ri-refresh-line fs-15"></i>
            </button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table align-middle mb-0 tokabe-table" id="pembelianTable" aria-label="Tabel Riwayat Pembelian">
            <thead>
              <tr>
                <th scope="col" class="text-center" style="width: 50px;">NO.</th>
                <th scope="col">NO. INVOICE</th>
                <th scope="col" class="text-center">TGL PEMBELIAN</th>
                <th scope="col" class="text-center">TGL JTO</th>
                <th scope="col" class="text-center">STATUS BAYAR</th>
                <th scope="col" class="text-center" style="width: 120px;">AKSES EDIT</th>
                <th scope="col" class="text-end">TOTAL (RP)</th>
                <th scope="col" class="text-end">TERBAYAR (RP)</th>
                <th scope="col" class="text-end">SISA (RP)</th>
                <th scope="col" class="text-center" style="width: 70px;">AKSI</th>
              </tr>
            </thead>
            <tbody id="pembelianTableBody">
              @forelse ($pembelian as $item)
                @php
                  $roleUser   = Auth::user()->role ?? '';
                  $isOwner    = $roleUser === 'Pemilik';
                  $isAdmin    = $roleUser === 'Admin';
                  $isUnlocked = $item->approval === 'Unlock';
                  $canManage  = !$isAdmin || $isUnlocked;

                  // Kontak Owner
                  $waOwner1 = '628116029999';
                  $waOwner2 = '628116179999';

                  // Pesan Request Unlock ke Owner via WhatsApp
                  $pesanUnlock = urlencode("Halo, saya ingin meminta approval untuk membuka akses riwayat pembelian *#{$item->nomor_inv}* dari vendor *{$vendor->nama_vendor}*. Mohon untuk segera ditinjau.

Klik tautan berikut untuk membuka halaman persetujuan:
" . url("/pembelian-approval/{$item->id}"));
                @endphp
                <tr class="pembelian-row"
                    data-inv="{{ strtolower($item->nomor_inv) }}"
                    data-status="{{ $item->status }}"
                    data-akses="{{ $item->approval ?? 'Lock' }}"
                    data-total="{{ (float) $item->jumlah_harga }}"
                    data-sisa="{{ (float) $item->sisa }}"
                    data-tanggal="{{ $item->tanggal ? strtotime($item->tanggal) : 0 }}">
                  <td class="text-center row-number num text-muted" style="font-size: 13px;">{{ $loop->iteration }}</td>
                  <td>
                    <span class="tokabe-inv-text fw-bold text-white">{{ $item->nomor_inv }}</span>
                  </td>
                  <td class="text-center text-muted" style="font-size: 12.5px;">
                    {{ optional($item->tanggal)->translatedFormat('d M Y') }}
                  </td>
                  <td class="text-center text-muted" style="font-size: 12.5px;">
                    {{ optional($item->effective_tanggal_jto)->translatedFormat('d M Y') ?: '-' }}
                  </td>
                  <td class="text-center">
                    @if($item->status === 'Lunas')
                      <span class="badge-status-lunas">
                        <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                        <span>Lunas</span>
                      </span>
                    @else
                      <span class="badge-status-pending">
                        <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                        <span>Belum Lunas</span>
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($isUnlocked)
                      <span class="badge-access-unlocked" title="Akses edit terbuka">
                        <i class="ri-lock-unlock-fill fs-13" aria-hidden="true"></i>
                        <span>Terbuka</span>
                      </span>
                    @else
                      <span class="badge-access-locked" title="Akses edit terkunci">
                        <i class="ri-lock-2-fill fs-13 text-danger" aria-hidden="true"></i>
                        <span>Terkunci</span>
                      </span>
                    @endif
                  </td>
                  <td class="text-end tokabe-cell-nominal num">
                    {{ number_format($item->jumlah_harga, 0, ',', '.') }}
                  </td>
                  <td class="text-end num tokabe-amount-terbayar">
                    {{ number_format($item->terbayar, 0, ',', '.') }}
                  </td>
                  <td class="text-end num {{ $item->sisa > 0 ? 'tokabe-amount-sisa-unpaid' : 'tokabe-amount-sisa-zero' }}">
                    {{ number_format($item->sisa, 0, ',', '.') }}
                  </td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi Invoice {{ $item->nomor_inv }}">
                        <i class="ri-more-fill fs-16" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        {{-- Menu Edit --}}
                        @if($canManage)
                          <li>
                            <a class="dropdown-item" href="{{ route('pembelian.edit', ['uid' => $item->id]) }}">
                              <i class="ri-edit-line fs-15 text-warning" aria-hidden="true"></i>
                              <span>Edit Pembelian</span>
                            </a>
                          </li>
                        @else
                          <li>
                            <span class="dropdown-item text-muted" style="cursor: not-allowed; opacity: 0.6;">
                              <i class="ri-lock-line fs-15 text-warning" aria-hidden="true"></i>
                              <span>Edit Terkunci</span>
                            </span>
                          </li>
                        @endif

                        {{-- ADMIN: Request Unlock via WA jika status masih Terkunci --}}
                        @if($isAdmin && !$isUnlocked)
                          <li>
                            <a class="dropdown-item" href="https://wa.me/{{ $waOwner1 }}?text={{ $pesanUnlock }}" target="_blank" rel="noopener">
                              <i class="ri-whatsapp-line fs-15 text-success" aria-hidden="true"></i>
                              <span>Request Unlock (Owner 1)</span>
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="https://wa.me/{{ $waOwner2 }}?text={{ $pesanUnlock }}" target="_blank" rel="noopener">
                              <i class="ri-whatsapp-line fs-15 text-success" aria-hidden="true"></i>
                              <span>Request Unlock (Owner 2)</span>
                            </a>
                          </li>
                        @endif

                        {{-- OWNER: Lock & Unlock langsung --}}
                        @if($isOwner)
                          @if($isUnlocked)
                            <li>
                              <a class="dropdown-item" href="{{ route('pembelian.lock', $item->id) }}">
                                <i class="ri-lock-line fs-15 text-warning" aria-hidden="true"></i>
                                <span>Kunci Kembali (Lock)</span>
                              </a>
                            </li>
                          @else
                            <li>
                              <form action="{{ route('pembelian.unlock', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-success">
                                  <i class="ri-lock-unlock-line fs-15 text-success" aria-hidden="true"></i>
                                  <span>Buka Kunci (Unlock)</span>
                                </button>
                              </form>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('pembelian.approval.page', $item->id) }}">
                                <i class="ri-shield-check-line fs-15 text-warning" aria-hidden="true"></i>
                                <span>Halaman Approval</span>
                              </a>
                            </li>
                          @endif
                        @endif

                        {{-- Lunasi (jika belum lunas) --}}
                        @if($item->status !== 'Lunas')
                          <li>
                            <a class="dropdown-item" href="{{ route('pembelian.lunas', ['uid' => $item->id]) }}" onclick="return confirm('Apakah Anda yakin ingin melunasi pembelian ini?')">
                              <i class="ri-check-line fs-15 text-success" aria-hidden="true"></i>
                              <span>Lunasi Nota</span>
                            </a>
                          </li>
                        @endif

                        {{-- Hapus (hanya jika memiliki hak kelola) --}}
                        @if($canManage)
                          <li class="dropdown-divider"></li>
                          <li>
                            <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembelian ini?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item dropdown-item--danger">
                                <i class="ri-delete-bin-line fs-15 text-danger" aria-hidden="true"></i>
                                <span>Hapus Nota</span>
                              </button>
                            </form>
                          </li>
                        @endif
                      </ul>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="10" class="text-center py-5 text-muted">
                    <i class="ri-inbox-line fs-32 d-block mb-2 text-secondary" aria-hidden="true"></i>
                    <span class="fs-14">Belum ada transaksi pembelian untuk vendor ini.</span>
                  </td>
                </tr>
              @endforelse
              <tr id="noPembelianFoundRow" class="d-none">
                <td colspan="10" class="text-center py-5 text-muted">
                  <i class="ri-search-eye-line fs-28 d-block mb-2 text-secondary"></i>
                  <span class="fs-13">Tidak ada nota pembelian yang cocok dengan filter ini.</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
  // ==========================================
  // Inisialisasi Tema (Dark / Light Mode)
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

  // ==========================================
  // Filter & Pencarian Live Tabel Pembelian
  // ==========================================
  const searchInput = document.getElementById('searchPembelianInput');
  const statusSelect = document.getElementById('filterStatusPembelian');
  const aksesSelect = document.getElementById('filterAksesPembelian');
  const sortSelect = document.getElementById('sortPembelianSelect');
  const clearBtn = document.getElementById('clearPembelianSearch');

  function applyPembelianFilterAndSort() {
    const tableBody = document.getElementById('pembelianTableBody');
    const noFoundRow = document.getElementById('noPembelianFoundRow');
    const badgeCount = document.getElementById('pembelianCountBadge');
    const totalNum = document.getElementById('pembelianTotalCountNum');

    if (!tableBody) return;

    const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
    const statusFilter = statusSelect ? statusSelect.value : 'all';
    const aksesFilter = aksesSelect ? aksesSelect.value : 'all';
    const sortBy = sortSelect ? sortSelect.value : 'terbaru';

    if (clearBtn) {
      clearBtn.classList.toggle('d-none', searchTerm === '');
    }

    const rows = Array.from(tableBody.querySelectorAll('tr.pembelian-row'));

    let visibleCount = 0;
    rows.forEach(row => {
      const inv = (row.dataset.inv || '').toLowerCase();
      const status = row.dataset.status || '';
      const akses = row.dataset.akses || '';

      const matchSearch = searchTerm === '' || inv.includes(searchTerm);
      const matchStatus = statusFilter === 'all' || status === statusFilter;
      const matchAkses = aksesFilter === 'all' || akses === aksesFilter;

      const isVisible = matchSearch && matchStatus && matchAkses;
      row.style.display = isVisible ? '' : 'none';
      if (isVisible) visibleCount++;
    });

    // Pengurutan baris tabel
    rows.sort((a, b) => {
      const totalA = parseFloat(a.dataset.total || '0');
      const totalB = parseFloat(b.dataset.total || '0');
      const sisaA = parseFloat(a.dataset.sisa || '0');
      const sisaB = parseFloat(b.dataset.sisa || '0');
      const tglA = parseInt(a.dataset.tanggal || '0');
      const tglB = parseInt(b.dataset.tanggal || '0');

      if (sortBy === 'terbaru') {
        return tglB - tglA;
      } else if (sortBy === 'sisa_desc') {
        return sisaB - sisaA;
      } else if (sortBy === 'total_desc') {
        return totalB - totalA;
      }
      return 0;
    });

    let rowNum = 1;
    rows.forEach(row => {
      tableBody.appendChild(row);
      if (row.style.display !== 'none') {
        const numCell = row.querySelector('.row-number');
        if (numCell) numCell.textContent = rowNum++;
      }
    });

    if (noFoundRow) {
      noFoundRow.classList.toggle('d-none', visibleCount > 0);
      tableBody.appendChild(noFoundRow);
    }

    if (badgeCount) {
      badgeCount.textContent = `${visibleCount} Nota`;
    }
    if (totalNum) {
      totalNum.textContent = visibleCount;
    }
  }

  function resetPembelianFilters() {
    if (searchInput) searchInput.value = '';
    if (statusSelect) statusSelect.value = 'all';
    if (aksesSelect) aksesSelect.value = 'all';
    if (sortSelect) sortSelect.value = 'terbaru';
    applyPembelianFilterAndSort();
  }

  if (searchInput) {
    searchInput.addEventListener('input', applyPembelianFilterAndSort);
  }
  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      if (searchInput) {
        searchInput.value = '';
        applyPembelianFilterAndSort();
        searchInput.focus();
      }
    });
  }
  if (statusSelect) {
    statusSelect.addEventListener('change', applyPembelianFilterAndSort);
  }
  if (aksesSelect) {
    aksesSelect.addEventListener('change', applyPembelianFilterAndSort);
  }
  if (sortSelect) {
    sortSelect.addEventListener('change', applyPembelianFilterAndSort);
  }

  $(document).ready(function() {
    initPageTheme();
    applyPembelianFilterAndSort();
  });
</script>
@endsection
