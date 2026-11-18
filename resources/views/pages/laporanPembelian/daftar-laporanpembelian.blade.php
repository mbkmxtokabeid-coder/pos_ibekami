@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" />

  <style>
    /* ==========================================================================
       TOKABE LAPORAN PEMBELIAN — COMPACT 2x2 WARM STONE DUAL-THEME SYSTEM
       ========================================================================== */

    :root {
      --ibk-bg: #0C0A09;
      --ibk-surface: #14110F;
      --ibk-surface-hover: #1C1917;
      --ibk-card-bg: #14110F;
      --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.28);
      --ibk-border: rgba(255, 255, 255, 0.08);
      --ibk-border-subtle: rgba(255, 255, 255, 0.05);
      --ibk-text: #F5F5F4;
      --ibk-text-muted: #A8A29E;
      --ibk-text-dim: #78716C;

      --ibk-brand: #EA580C;
      --ibk-brand-hover: #C2410C;
      --ibk-brand-soft: rgba(234, 88, 12, 0.12);
      --ibk-brand-border: rgba(234, 88, 12, 0.28);

      --ibk-input-bg: #1C1917;
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #F5F5F4;
      --ibk-input-disabled-bg: rgba(255, 255, 255, 0.03);
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23A8A29E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-pdf-bg: rgba(239, 68, 68, 0.14);
      --ibk-pdf-text: #FCA5A5;
      --ibk-pdf-border: rgba(239, 68, 68, 0.35);

      --ibk-excel-bg: rgba(16, 185, 129, 0.14);
      --ibk-excel-text: #6EE7B7;
      --ibk-excel-border: rgba(16, 185, 129, 0.35);
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      --ibk-bg: #F7F6F2;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FAF8F5;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(28, 25, 23, 0.05);
      --ibk-border: #E6E1D8;
      --ibk-border-subtle: #F0ECE3;
      --ibk-text: #1C1917;
      --ibk-text-muted: #57534E;
      --ibk-text-dim: #78716C;

      --ibk-brand: #EA580C;
      --ibk-brand-hover: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #D6D0C4;
      --ibk-input-text: #1C1917;
      --ibk-input-disabled-bg: #F5F2EB;
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2357534E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-pdf-bg: #FEF2F2;
      --ibk-pdf-text: #B91C1C;
      --ibk-pdf-border: #FECACA;

      --ibk-excel-bg: #ECFDF5;
      --ibk-excel-text: #047857;
      --ibk-excel-border: #A7F3D0;
    }

    .laporan-page-wrapper {
      position: relative;
      width: 100%;
      padding-bottom: 40px;
      font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
      color: var(--ibk-text);
    }

    /* Page Header */
    .ibk-page-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 20px;
    }
    .ibk-page-title h1 {
      font-size: 20px;
      font-weight: 700;
      color: var(--ibk-text);
      margin: 0;
      letter-spacing: -0.015em;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .ibk-page-title h1 i {
      color: var(--ibk-brand);
      font-size: 22px;
    }
    .ibk-page-subtitle {
      font-size: 13px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
    }

    .ibk-header-actions {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
    }

    /* Quick Tab Switcher between Penjualan, Pembelian & Pelanggan */
    .ibk-tab-switch {
      position: relative;
      display: inline-flex;
      align-items: center;
      padding: 3px;
      border-radius: 10px;
      background: var(--ibk-surface);
      border: 1px solid var(--ibk-border);
      gap: 2px;
    }
    .ibk-tab-glider {
      position: absolute;
      top: 3px;
      bottom: 3px;
      left: 0;
      border-radius: 7px;
      background: var(--ibk-brand);
      box-shadow: 0 2px 8px rgba(234, 88, 12, 0.28);
      pointer-events: none;
      z-index: 0;
      opacity: 0;
      will-change: transform, width;
    }
    .ibk-tab-glider.is-animated {
      transition: transform 320ms cubic-bezier(0.22, 1, 0.36, 1), width 320ms cubic-bezier(0.22, 1, 0.36, 1), opacity 160ms ease;
    }
    .ibk-tab-link {
      position: relative;
      z-index: 1;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 7px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--ibk-text-muted);
      text-decoration: none !important;
      transition: color 220ms ease, background-color 180ms ease;
      white-space: nowrap;
    }
    .ibk-tab-link:hover {
      background: var(--ibk-surface-hover);
      color: var(--ibk-text);
    }
    .ibk-tab-link.is-active {
      background: var(--ibk-brand);
      color: #FFFFFF;
    }
    .ibk-tab-switch.has-glider .ibk-tab-link.is-active,
    .ibk-tab-switch.has-glider .ibk-tab-link.is-active:hover {
      background: transparent;
      color: #FFFFFF;
    }
    .ibk-tab-stage {
      transition: opacity 220ms cubic-bezier(0.22, 1, 0.36, 1), transform 220ms cubic-bezier(0.22, 1, 0.36, 1);
      will-change: opacity, transform;
    }
    .ibk-tab-stage.is-entering {
      opacity: 0;
      transform: translateY(8px);
    }
    .ibk-tab-stage.is-leaving {
      opacity: 0;
      transform: translateY(-6px);
    }
    @media (prefers-reduced-motion: reduce) {
      .ibk-tab-glider.is-animated,
      .ibk-tab-stage {
        transition: none !important;
      }
    }
    .ibk-tab-link:focus-visible,
    .ref-theme-toggle:focus-visible,
    .btn-report-pdf:focus-visible,
    .btn-report-excel:focus-visible {
      outline: 2px solid var(--ibk-brand) !important;
      outline-offset: 2px !important;
    }

    /* Compact 2x2 Box Grid */
    .ibk-report-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px;
      align-items: stretch;
    }
    @media (max-width: 991.98px) {
      .ibk-report-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Compact Square-Box Report Card */
    .ibk-report-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
      overflow: hidden;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .ibk-report-card:hover {
      border-color: var(--ibk-brand-border);
    }

    .ibk-report-card-header {
      padding: 14px 18px;
      border-bottom: 1px solid var(--ibk-border-subtle);
      background: var(--ibk-surface-hover);
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
    }
    .ibk-report-heading {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      min-width: 0;
    }
    .ibk-report-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
    .ibk-report-title {
      font-size: 14.5px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      line-height: 1.3;
    }
    .ibk-report-desc {
      font-size: 12px;
      color: var(--ibk-text-muted);
      margin-top: 2px;
      line-height: 1.35;
    }
    .ibk-report-badge {
      font-size: 11px;
      font-weight: 600;
      font-variant-numeric: tabular-nums;
      padding: 3px 8px;
      border-radius: 6px;
      background: var(--ibk-surface);
      border: 1px solid var(--ibk-border);
      color: var(--ibk-text-muted);
      white-space: nowrap;
      flex-shrink: 0;
    }

    .ibk-report-card-body {
      padding: 16px 18px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .ibk-report-form {
      display: flex;
      flex-direction: column;
      flex: 1;
      justify-content: space-between;
      gap: 14px;
    }

    .ibk-field-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px 12px;
    }
    @media (max-width: 575.98px) {
      .ibk-field-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Compact Form Controls */
    .tokabe-label {
      font-size: 12px !important;
      font-weight: 600 !important;
      color: var(--ibk-text-muted) !important;
      margin-bottom: 4px !important;
      display: block;
    }
    .laporan-page-wrapper .form-control,
    .laporan-page-wrapper .form-select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 12px !important;
      font-size: 13px !important;
      height: 36px !important;
      font-variant-numeric: tabular-nums;
      transition: border-color 150ms ease, box-shadow 150ms ease, background-color 150ms ease;
    }
    .laporan-page-wrapper .form-select {
      padding-right: 32px !important;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 10px center !important;
      background-size: 14px 10px !important;
    }
    .laporan-page-wrapper .form-control::placeholder {
      color: var(--ibk-text-dim) !important;
    }
    .laporan-page-wrapper .form-control:focus,
    .laporan-page-wrapper .form-select:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      color: var(--ibk-text) !important;
      outline: none !important;
    }
    .laporan-page-wrapper .form-control:disabled,
    .laporan-page-wrapper .form-select:disabled {
      background-color: var(--ibk-input-disabled-bg) !important;
      border-color: var(--ibk-border) !important;
      color: var(--ibk-text-dim) !important;
      cursor: not-allowed;
    }

    /* Card Action Footer */
    .ibk-report-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      padding-top: 12px;
      border-top: 1px solid var(--ibk-border-subtle);
      margin-top: auto;
    }
    .btn-report-pdf {
      background-color: var(--ibk-pdf-bg) !important;
      color: var(--ibk-pdf-text) !important;
      border: 1px solid var(--ibk-pdf-border) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 12px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease !important;
      cursor: pointer;
      white-space: nowrap;
    }
    .btn-report-pdf:hover {
      background-color: #DC2626 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
    }

    .btn-report-excel {
      background-color: var(--ibk-excel-bg) !important;
      color: var(--ibk-excel-text) !important;
      border: 1px solid var(--ibk-excel-border) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 12px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease !important;
      cursor: pointer;
      white-space: nowrap;
    }
    .btn-report-excel:hover {
      background-color: #059669 !important;
      color: #FFFFFF !important;
      border-color: #059669 !important;
    }
  </style>
@endsection

@extends('layout.template')

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="laporan-page-wrapper">

      <!-- Header & Controls -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-calculator-line" aria-hidden="true"></i>
            <span>Laporan Pembelian</span>
          </h1>
          <div class="ibk-page-subtitle">Filter transaksi pembelian vendor berdasarkan status, rentang tanggal, bulan, atau tahun, lalu ekspor ke PDF atau Excel</div>
        </div>
        <div class="ibk-header-actions">
          <div class="ibk-tab-switch" role="navigation" aria-label="Jenis Laporan">
            <span class="ibk-tab-glider" aria-hidden="true"></span>
            <a href="{{ url('/daftar-laporan') }}" class="ibk-tab-link">
              <i class="ri-file-chart-line" aria-hidden="true"></i>
              <span>Penjualan</span>
            </a>
            <a href="{{ url('/daftar-laporanPembelian') }}" class="ibk-tab-link is-active" aria-current="page">
              <i class="ri-shopping-cart-2-line" aria-hidden="true"></i>
              <span>Pembelian</span>
            </a>
            <a href="{{ route('daftar.pelanggan') }}" class="ibk-tab-link">
              <i class="ri-user-shared-line" aria-hidden="true"></i>
              <span>Pelanggan</span>
            </a>
          </div>
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon" aria-hidden="true"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
        </div>
      </div>

      <div class="ibk-tab-stage" id="ibkTabStage">
        <script>try{if(sessionStorage.getItem('ibk_laporan_tab_leaving')==='1'){document.getElementById('ibkTabStage').classList.add('is-entering');}}catch(e){}</script>
        <!-- Compact 2x2 Report Cards Grid -->
      <div class="ibk-report-grid">

        <!-- 1. LAPORAN PEMBELIAN UTAMA (Vendor & Status) -->
        <section class="ibk-report-card" aria-labelledby="title-pembelian-vendor">
          <div class="ibk-report-card-header">
            <div class="ibk-report-heading">
              <span class="ibk-report-icon" aria-hidden="true">
                <i class="ri-store-2-line"></i>
              </span>
              <div>
                <h2 class="ibk-report-title" id="title-pembelian-vendor">Laporan Pembelian (Vendor &amp; Status)</h2>
                <div class="ibk-report-desc">Filter transaksi pembelian menurut vendor dan status pelunasan</div>
              </div>
            </div>
            <span class="ibk-report-badge">01 &middot; Vendor</span>
          </div>
          <div class="ibk-report-card-body">
            <form class="ibk-report-form" action="{{ url('/invoice/laporan-exportPembelian') }}" method="POST" target="_blank">
              @csrf
              <div class="ibk-field-grid">
                <div>
                  <label class="tokabe-label" for="vendorSelect">Semua Pembelian (Vendor)</label>
                  <select name="vendor" class="form-select" id="vendorSelect">
                    <option value="semua" selected>Semua Vendor</option>
                    @foreach ($katVen as $id => $namaVendor)
                      <option value="{{ $id }}">{{ $namaVendor }}</option>
                    @endforeach
                  </select>
                </div>

                <div>
                  <label class="tokabe-label" for="statusPembelianSelect">Status Pembayaran</label>
                  <select name="status" class="form-select" id="statusPembelianSelect">
                    <option value="semua">Semua Status</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                  </select>
                </div>
              </div>

              <div class="ibk-report-actions">
                <button class="btn btn-report-pdf" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Pembelian Format PDF">
                  <i class="ri-file-pdf-line fs-16" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel" name="export_type" value="excel" type="submit" aria-label="Export Laporan Pembelian Format Excel">
                  <i class="ri-file-excel-2-line fs-16" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </form>
          </div>
        </section>

        <!-- 2. LAPORAN PEMBELIAN CUSTOM (Rentang Tanggal) -->
        <section class="ibk-report-card" aria-labelledby="title-pembelian-custom">
          <div class="ibk-report-card-header">
            <div class="ibk-report-heading">
              <span class="ibk-report-icon" aria-hidden="true">
                <i class="ri-calendar-event-line"></i>
              </span>
              <div>
                <h2 class="ibk-report-title" id="title-pembelian-custom">Laporan Pembelian Custom (Rentang Tanggal)</h2>
                <div class="ibk-report-desc">Filter transaksi pembelian berdasarkan rentang tanggal tertentu</div>
              </div>
            </div>
            <span class="ibk-report-badge">02 &middot; Periode</span>
          </div>
          <div class="ibk-report-card-body">
            <form class="ibk-report-form" action="{{ url('/invoice/laporanPembelian-export-date') }}" method="POST" target="_blank">
              @csrf
              <div class="ibk-field-grid">
                <div>
                  <label class="tokabe-label" for="tgl_custom_pembelian">Pilih Rentang Tanggal</label>
                  <input type="text" class="form-control flatpickr-input" id="tgl_custom_pembelian" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Pilih Rentang Tanggal" name="tgl_custom" required>
                </div>

                <div>
                  <label class="tokabe-label" for="vendorCstmSelect">Vendor</label>
                  <select class="form-select" name="vendor" id="vendorCstmSelect" required>
                    <option value="semua">Semua Vendor</option>
                    @foreach ($katVen as $id => $namaVendor)
                      <option value="{{ $id }}">{{ $namaVendor }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="ibk-report-actions">
                <button class="btn btn-report-pdf" type="submit" name="export_type" value="pdf" aria-label="Lihat Laporan Pembelian Custom PDF">
                  <i class="ri-file-pdf-line fs-16" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel" type="submit" name="export_type" value="excel" aria-label="Export Laporan Pembelian Custom Excel">
                  <i class="ri-file-excel-2-line fs-16" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </form>
          </div>
        </section>

        <!-- 3. LAPORAN PEMBELIAN BULANAN -->
        <section class="ibk-report-card" aria-labelledby="title-pembelian-bulanan">
          <div class="ibk-report-card-header">
            <div class="ibk-report-heading">
              <span class="ibk-report-icon" aria-hidden="true">
                <i class="ri-calendar-check-line"></i>
              </span>
              <div>
                <h2 class="ibk-report-title" id="title-pembelian-bulanan">Laporan Pembelian Bulanan ({{ date('Y') }})</h2>
                <div class="ibk-report-desc">Rekapitulasi transaksi pembelian per bulan berjalan</div>
              </div>
            </div>
            <span class="ibk-report-badge">03 &middot; Bulanan</span>
          </div>
          <div class="ibk-report-card-body">
            <form class="ibk-report-form" action="{{ url('/invoice/laporanPembelian-export-month') }}" method="POST" target="_blank">
              @csrf
              <div class="ibk-field-grid">
                <div>
                  <label class="tokabe-label" for="selectBulanPembelian">Pilih Bulan</label>
                  <select class="form-select" name="bulan" id="selectBulanPembelian" required>
                    @foreach ($namaBulan as $bulan)
                      <option value="{{ $bulan }}" {{ (date('F') == $bulan || date('m') == $loop->iteration) ? 'selected' : '' }}>{{ $bulan }}</option>
                    @endforeach
                  </select>
                </div>

                <div>
                  <label class="tokabe-label" for="vendorBulanSelect">Vendor</label>
                  <select class="form-select" name="vendor" id="vendorBulanSelect" required>
                    <option value="semua">Semua Vendor</option>
                    @foreach ($katVen as $id => $namaVendor)
                      <option value="{{ $id }}">{{ $namaVendor }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="ibk-report-actions">
                <button class="btn btn-report-pdf" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Pembelian Bulanan PDF">
                  <i class="ri-file-pdf-line fs-16" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel" name="export_type" value="excel" type="submit" aria-label="Export Laporan Pembelian Bulanan Excel">
                  <i class="ri-file-excel-2-line fs-16" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </form>
          </div>
        </section>

        <!-- 4. LAPORAN PEMBELIAN TAHUNAN -->
        <section class="ibk-report-card" aria-labelledby="title-pembelian-tahunan">
          <div class="ibk-report-card-header">
            <div class="ibk-report-heading">
              <span class="ibk-report-icon" aria-hidden="true">
                <i class="ri-bar-chart-2-line"></i>
              </span>
              <div>
                <h2 class="ibk-report-title" id="title-pembelian-tahunan">Laporan Pembelian Tahunan</h2>
                <div class="ibk-report-desc">Rekapitulasi transaksi pembelian berdasarkan tahun</div>
              </div>
            </div>
            <span class="ibk-report-badge">04 &middot; Tahunan</span>
          </div>
          <div class="ibk-report-card-body">
            <form class="ibk-report-form" action="{{ url('/invoice/laporanPembelian-export-year') }}" method="POST" target="_blank">
              @csrf
              <div class="ibk-field-grid">
                <div>
                  <label class="tokabe-label" for="selectTahunPembelian">Pilih Tahun</label>
                  <select class="form-select" name="tahun" id="selectTahunPembelian" required>
                    @foreach ($daftarTahun as $tahun)
                      <option value="{{ $tahun }}" {{ ($tahun == date('Y')) ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                  </select>
                </div>

                <div>
                  <label class="tokabe-label" for="vendorTahunSelect">Vendor</label>
                  <select class="form-select" name="vendor" id="vendorTahunSelect" required>
                    <option value="semua">Semua Vendor</option>
                    @foreach ($katVen as $id => $namaVendor)
                      <option value="{{ $id }}">{{ $namaVendor }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="ibk-report-actions">
                <button class="btn btn-report-pdf" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Pembelian Tahunan PDF">
                  <i class="ri-file-pdf-line fs-16" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel" name="export_type" value="excel" type="submit" aria-label="Export Laporan Pembelian Tahunan Excel">
                  <i class="ri-file-excel-2-line fs-16" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </form>
          </div>
        </section>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/halaman/laporan-tabs.js') }}"></script>
<script>
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

  document.addEventListener('DOMContentLoaded', function () {
    initPageTheme();
  });
</script>
@endsection
