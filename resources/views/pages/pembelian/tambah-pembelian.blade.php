@extends('layout.template')

@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <style>
    /* ==========================================================================
       TOKABE TAMBAH PEMBELIAN — DUAL THEME DESIGN SYSTEM (DASHBOARD MATCHED)
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

      /* Semantics */
      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.14);
      --ibk-success-border: rgba(16, 185, 129, 0.28);
      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.14);
      --ibk-danger-border: rgba(239, 68, 68, 0.28);

      /* Inputs & Dropdowns */
      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #FAFAFA;
      --ibk-input-placeholder: #71717A;
      --ibk-popover-bg: #181412;

      /* Table */
      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.06);
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      /* Mode Terang — Dashboard Neutral Slate (#F8FAFC / #FFFFFF) */
      --ibk-bg: #F8FAFC;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #F8FAFC;
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
    .form-page-wrapper {
      position: relative;
      width: 100%;
      min-height: calc(100vh - 120px);
      padding-bottom: 85px !important;
      margin-bottom: 24px !important;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      color: var(--ibk-text);
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
      font-weight: 700;
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

    /* Buttons */
    .ibk-btn-primary {
      background-color: var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      border: 1px solid var(--ibk-brand-deep) !important;
      font-weight: 600;
      font-size: 13.5px;
      padding: 8px 18px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none !important;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25);
      cursor: pointer;
    }
    .ibk-btn-primary:hover {
      background-color: var(--ibk-brand-deep) !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
    }
    .ibk-btn-back {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      font-weight: 500;
      padding: 8px 14px !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      text-decoration: none !important;
      transition: all 0.15s ease;
    }
    .ibk-btn-back:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }
    .ibk-btn-cancel {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      font-weight: 500;
      padding: 9px 20px !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      text-decoration: none !important;
      transition: all 0.15s ease;
    }
    .ibk-btn-cancel:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }

    /* Theme Toggle Button */
    .ref-theme-toggle {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      font-size: 13px;
      font-weight: 500;
      border-radius: 8px;
      background: var(--ibk-input-bg);
      border: 1px solid var(--ibk-input-border);
      color: var(--ibk-text-muted);
      cursor: pointer;
      transition: all 150ms ease;
    }
    .ref-theme-toggle:hover {
      background: var(--ibk-surface-hover);
      color: var(--ibk-text);
      border-color: var(--ibk-brand-border);
    }

    /* Cards */
    .ibk-form-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      margin-bottom: 24px;
      overflow: hidden;
    }
    .ibk-form-header {
      padding: 16px 22px;
      border-bottom: 1px solid var(--ibk-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }
    .ibk-form-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 9px;
    }
    .ibk-form-title i {
      font-size: 18px;
      color: var(--ibk-brand);
    }

    /* Form Labels & Controls */
    .form-label-custom {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--ibk-text);
      margin-bottom: 0;
      display: flex;
      align-items: center;
    }
    .form-label-custom .required-star {
      color: var(--ibk-danger) !important;
      font-weight: bold;
      margin-left: 4px;
    }
    .tokabe-input,
    .tokabe-select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      height: 40px !important;
      font-size: 13.5px !important;
      padding: 8px 14px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-input::placeholder {
      color: var(--ibk-input-placeholder) !important;
    }
    .tokabe-input:focus,
    .tokabe-select:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }
    .tokabe-input:disabled,
    .tokabe-input[readonly] {
      background-color: var(--ibk-surface-hover) !important;
      color: var(--ibk-text-muted) !important;
      border-color: var(--ibk-border) !important;
      cursor: default;
    }

    /* Items Table */
    .tokabe-items-table {
      width: 100% !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      margin: 0 !important;
      background: transparent !important;
    }
    .tokabe-items-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text) !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      border-top: none !important;
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 12px 14px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .tokabe-items-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 10px 14px !important;
      vertical-align: middle;
      color: var(--ibk-text) !important;
      background-color: transparent !important;
    }
    .tokabe-items-table tbody tr:hover td {
      background-color: var(--ibk-surface-hover) !important;
    }

    /* Delete Row Button */
    .btn-row-delete {
      background: transparent !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-danger) !important;
      border-radius: 6px !important;
      width: 34px !important;
      height: 34px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 0 !important;
      transition: all 0.15s ease;
      cursor: pointer;
    }
    .btn-row-delete:hover:not(:disabled) {
      background: var(--ibk-danger-soft) !important;
      border-color: var(--ibk-danger-border) !important;
      color: var(--ibk-danger) !important;
    }
    .btn-row-delete:disabled {
      opacity: 0.35 !important;
      cursor: not-allowed !important;
    }

    /* Summary Card (Dashboard Aligned) */
    .summary-card {
      background: var(--ibk-surface-hover);
      border: 1px solid var(--ibk-border);
      border-radius: 10px;
      padding: 16px 20px;
    }
    .summary-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 8px 0;
      border-bottom: 1px solid var(--ibk-border);
    }
    .summary-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }
    .summary-row:first-child {
      padding-top: 0;
    }
    .input-group-addon-custom {
      background: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-input-border) !important;
      border-right: none !important;
      color: var(--ibk-text-muted) !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      padding: 0 12px !important;
      border-radius: 8px 0 0 8px !important;
      display: flex;
      align-items: center;
    }
    .input-addon-right {
      border-radius: 0 8px 8px 0 !important;
      border-left: none !important;
    }

    /* Flatpickr Custom Styling */
    .flatpickr-calendar {
      background: var(--ibk-popover-bg) !important;
      border: 1px solid var(--ibk-border) !important;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4) !important;
      border-radius: 10px !important;
      font-family: inherit !important;
    }
    .flatpickr-months {
      background: var(--ibk-surface-hover) !important;
      border-bottom: 1px solid var(--ibk-border) !important;
      border-radius: 10px 10px 0 0 !important;
    }
    .flatpickr-current-month,
    .flatpickr-current-month .cur-month,
    .flatpickr-current-month input.cur-year {
      color: var(--ibk-text) !important;
      font-weight: 700 !important;
    }
    .flatpickr-months .flatpickr-prev-month,
    .flatpickr-months .flatpickr-next-month {
      color: var(--ibk-text-muted) !important;
      fill: var(--ibk-text-muted) !important;
    }
    .flatpickr-months .flatpickr-prev-month:hover,
    .flatpickr-months .flatpickr-next-month:hover {
      color: var(--ibk-brand) !important;
      fill: var(--ibk-brand) !important;
    }
    span.flatpickr-weekday {
      color: var(--ibk-text-muted) !important;
      font-weight: 600 !important;
    }
    .flatpickr-day {
      color: var(--ibk-text) !important;
      border-radius: 6px !important;
    }
    .flatpickr-day:hover {
      background: var(--ibk-surface-hover) !important;
    }
    .flatpickr-day.selected {
      background: #EA580C !important;
      border-color: #EA580C !important;
      color: #FFFFFF !important;
      font-weight: 700 !important;
    }
    .flatpickr-day.today {
      border-color: var(--ibk-brand) !important;
      color: var(--ibk-brand-text) !important;
    }
  </style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="form-page-wrapper">

      <!-- 1. Header & Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <span>Tambah Pembelian &mdash; {{ $vendor->nama_vendor }}</span>
          </h1>
          <div class="ibk-page-subtitle">Form input nota tagihan dan rincian item barang dari vendor</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="ibk-btn-back" title="Kembali ke Daftar Transaksi">
            <i class="ri-arrow-left-line"></i>
            <span>Daftar Transaksi</span>
          </a>
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
        </div>
      </div>

      {{-- Error Alerts --}}
      @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border); color: var(--ibk-danger); border-radius: 8px;">
          <i class="ri-error-warning-fill fs-20 me-2"></i>
          <div class="flex-grow-1">
            <strong class="fs-13">Perhatian:</strong>
            <ul class="mb-0 mt-1 ps-3 fs-13">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      <form action="{{ route('pembelian.store') }}" method="POST" id="form-pembelian">
        @csrf
        <input type="hidden" name="token" value="{{ $uniqueToken }}">
        <input type="hidden" name="id_vendor" value="{{ $vendor->id }}">
        <input type="hidden" name="vendor" value="{{ $vendor->id }}">

        {{-- Card 1: Informasi Pembelian --}}
        <div class="ibk-form-card">
          <div class="ibk-form-header">
            <h5 class="ibk-form-title">
              <i class="ri-file-text-line"></i>
              <span>Informasi Pembelian</span>
            </h5>
          </div>
          <div class="p-4">
            <div class="row g-4">
              {{-- Kolom Kiri --}}
              <div class="col-lg-6">
                <div class="mb-3 row align-items-center">
                  <label for="anggaran_select" class="col-lg-4 form-label-custom">Pakai Anggaran <span class="required-star">*</span></label>
                  <div class="col-lg-8">
                    <select name="anggaran" id="anggaran_select" class="form-select tokabe-select @error('anggaran') is-invalid @enderror" required aria-required="true">
                      <option value="">-- Pilih Anggaran --</option>
                      @foreach ($budgets as $b)
                        <option value="{{ $b->id }}" {{ old('anggaran') == $b->id ? 'selected' : '' }}>
                          {{ $b->nama_budget }} &mdash; Rp {{ number_format($b->anggaran, 0, ',', '.') }}
                        </option>
                      @endforeach
                    </select>
                    @error('anggaran')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <label for="nama_vendor_input" class="col-lg-4 form-label-custom">Nama Vendor</label>
                  <div class="col-lg-8">
                    <input type="text" id="nama_vendor_input" class="form-control tokabe-input" value="{{ $vendor->nama_vendor }}" readonly>
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <label for="nomor_inv_input" class="col-lg-4 form-label-custom">Nomor Invoice <span class="required-star">*</span></label>
                  <div class="col-lg-8">
                    <input type="text" name="nomor_inv" id="nomor_inv_input"
                           class="form-control tokabe-input @error('nomor_inv') is-invalid @enderror"
                           placeholder="Contoh: INV-2026-001" value="{{ old('nomor_inv') }}" required aria-required="true">
                    @error('nomor_inv')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                  </div>
                </div>
              </div>

              {{-- Kolom Kanan --}}
              <div class="col-lg-6">
                <div class="mb-3 row align-items-center">
                  <label for="tanggal_input" class="col-lg-4 form-label-custom">Tanggal Pembelian <span class="required-star">*</span></label>
                  <div class="col-lg-8">
                    <div class="position-relative">
                      <input type="text" name="tanggal" id="tanggal_input"
                             class="form-control tokabe-input @error('tanggal') is-invalid @enderror"
                             value="{{ old('tanggal', date('Y-m-d')) }}" placeholder="Pilih Tanggal Pembelian" required aria-required="true" style="cursor: pointer; padding-right: 38px;">
                      <i class="ri-calendar-2-line position-absolute text-muted" style="right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 16px;"></i>
                    </div>
                    @error('tanggal')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <label for="tanggal_jto_input" class="col-lg-4 form-label-custom">Tanggal Jatuh Tempo</label>
                  <div class="col-lg-8">
                    <div class="position-relative">
                      <input type="text" name="tanggal_jto" id="tanggal_jto_input"
                             class="form-control tokabe-input @error('tanggal_jto') is-invalid @enderror"
                             value="{{ old('tanggal_jto') }}" placeholder="Pilih Tanggal Jatuh Tempo" style="cursor: pointer; padding-right: 38px;">
                      <i class="ri-calendar-2-line position-absolute text-muted" style="right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 16px;"></i>
                    </div>
                    @error('tanggal_jto')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <label for="status_pembelian" class="col-lg-4 form-label-custom">Status Pembelian <span class="required-star">*</span></label>
                  <div class="col-lg-8">
                    <select name="status" id="status_pembelian" class="form-select tokabe-select @error('status') is-invalid @enderror" required onchange="handleStatusChange()" aria-required="true">
                      <option value="Belum Lunas" {{ old('status', 'Belum Lunas') === 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                      <option value="Lunas" {{ old('status') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status')<span class="text-danger fs-12 mt-1 d-block">{{ $message }}</span>@enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Card 2: Rincian Barang / Jasa --}}
        <div class="ibk-form-card">
          <div class="ibk-form-header">
            <h5 class="ibk-form-title">
              <i class="ri-shopping-cart-2-line"></i>
              <span>Rincian Barang / Jasa</span>
            </h5>
            <button type="button" class="ibk-btn-primary" onclick="tambahItem()" aria-label="Tambah Baris Barang">
              <i class="ri-add-line fs-16" aria-hidden="true"></i>
              <span>Tambah Barang</span>
            </button>
          </div>
          <div class="p-4">
            <div class="table-responsive">
              <table class="table tokabe-items-table" id="item-table" aria-label="Tabel Rincian Item Barang">
                <thead>
                  <tr>
                    <th scope="col" style="min-width: 260px;">KETERANGAN / DESKRIPSI BARANG <span class="text-danger">*</span></th>
                    <th scope="col" style="width: 180px;" class="text-end">HARGA SATUAN (RP) <span class="text-danger">*</span></th>
                    <th scope="col" style="width: 100px;" class="text-center">QTY <span class="text-danger">*</span></th>
                    <th scope="col" style="width: 130px;">SATUAN</th>
                    <th scope="col" style="width: 180px;" class="text-end">JUMLAH HARGA (RP)</th>
                    <th scope="col" style="width: 70px;" class="text-center">AKSI</th>
                  </tr>
                </thead>
                <tbody id="item-body">
                  <tr class="item-row">
                    <td>
                      <input type="text" name="items[0][deskripsi]" class="form-control tokabe-input" placeholder="Deskripsi item barang" required aria-label="Deskripsi item barang">
                    </td>
                    <td>
                      <input type="text" inputmode="numeric" name="items[0][harga_barang]" class="form-control tokabe-input harga text-end num" placeholder="0" value="0" oninput="formatInputRibuan(this); hitungBaris(this)" required aria-label="Harga satuan barang">
                    </td>
                    <td>
                      <input type="number" name="items[0][qty]" class="form-control tokabe-input qty text-center num" placeholder="1" min="1" step="1" value="1" oninput="hitungBaris(this)" required aria-label="Kuantitas barang">
                    </td>
                    <td>
                      <select name="items[0][satuan]" class="form-select tokabe-select" aria-label="Pilih satuan">
                        <option value="Pcs">Pcs</option>
                        <option value="Set">Set</option>
                        <option value="Und">Und</option>
                        <option value="Blok">Blok</option>
                        <option value="Rim">Rim</option>
                        <option value="Lbr">Lbr</option>
                        <option value="Ktk">Ktk</option>
                        <option value="Unit">Unit</option>
                        <option value="Kg">Kg</option>
                        <option value="Lainnya">Lainnya</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" class="form-control tokabe-input jumlah-harga text-end num" placeholder="0" readonly value="0" aria-label="Jumlah harga subtotal">
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn-row-delete btn-hapus-item" onclick="hapusItem(this)" disabled aria-label="Hapus baris barang" title="Hapus baris">
                        <i class="ri-delete-bin-line fs-16" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            {{-- Ringkasan Pembayaran di Bawah Kanan --}}
            <div class="row justify-content-end mt-4">
              <div class="col-lg-5 col-md-7">
                <div class="summary-card">
                  <div class="summary-row">
                    <span class="fw-medium text-muted">Subtotal</span>
                    <span class="fw-bold num fs-14" id="summary-subtotal" style="color: var(--ibk-text);">Rp 0</span>
                  </div>
                  <div class="summary-row">
                    <span class="fw-bold" style="color: var(--ibk-text);">Jumlah Total</span>
                    <span class="fw-bold fs-16 num" style="color: var(--ibk-brand-text);" id="summary-total">Rp 0</span>
                  </div>
                  <div class="summary-row">
                    <span class="fw-medium text-muted">Terbayar</span>
                    <div class="input-group input-group-sm" style="max-width: 220px;">
                      <span class="input-group-addon-custom">Rp</span>
                      <input type="text" inputmode="numeric" name="terbayar" id="terbayar"
                             class="form-control tokabe-input input-addon-right text-end fw-bold num fs-14"
                             style="color: var(--ibk-success) !important;"
                             value="{{ number_format(old('terbayar', 0), 0, ',', '.') }}"
                             placeholder="0"
                             aria-label="Jumlah nominal terbayar"
                             oninput="formatInputRibuan(this); handleTerbayarChange()">
                    </div>
                  </div>
                  <div class="summary-row" id="summary-sisa-row">
                    <span class="fw-bold" style="color: var(--ibk-danger);">Sisa Pembayaran</span>
                    <span class="fw-bold fs-16 num" style="color: var(--ibk-danger);" id="summary-sisa">Rp 0</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2 mt-4 pt-3" style="border-top: 1px solid var(--ibk-border) !important;">
              <button type="submit" class="ibk-btn-primary">
                <i class="ri-save-line fs-16" aria-hidden="true"></i>
                <span>Simpan Pembelian</span>
              </button>
              <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="ibk-btn-cancel">
                <i class="ri-close-line fs-16" aria-hidden="true"></i>
                <span>Batal</span>
              </a>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection

@section('plugins')
<script>
  // Inisialisasi Tema (Dark / Light Mode)
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

  let itemIndex = 1;
  const satuanOptions = ["Pcs", "Set", "Und", "Blok", "Rim", "Lbr", "Ktk", "Unit", "Kg", "Lainnya"];

  function parseRibuan(val) {
    if (typeof val === 'number') return val;
    if (!val) return 0;
    let clean = val.toString().replace(/\D/g, '');
    return parseFloat(clean) || 0;
  }

  function formatRp(val) {
    let num = Math.round(Number(val) || 0);
    return num.toLocaleString('id-ID');
  }

  function formatInputRibuan(input) {
    let raw = parseRibuan(input.value);
    input.value = raw > 0 ? formatRp(raw) : '0';
  }

  function satuanSelect(name) {
    let opts = satuanOptions.map(s => `<option value="${s}">${s}</option>`).join('');
    return `<select name="${name}" class="form-select tokabe-select" aria-label="Pilih satuan">${opts}</select>`;
  }

  function tambahItem() {
    const tbody = document.getElementById('item-body');
    const i = itemIndex++;
    const tr = document.createElement('tr');
    tr.className = 'item-row';
    tr.innerHTML = [
      '<td><input type="text" name="items[' + i + '][deskripsi]" class="form-control tokabe-input" placeholder="Deskripsi item barang" required aria-label="Deskripsi item barang"></td>',
      '<td><input type="text" inputmode="numeric" name="items[' + i + '][harga_barang]" class="form-control tokabe-input harga text-end num" placeholder="0" value="0" oninput="formatInputRibuan(this); hitungBaris(this)" required aria-label="Harga satuan barang"></td>',
      '<td><input type="number" name="items[' + i + '][qty]" class="form-control tokabe-input qty text-center num" placeholder="1" min="1" step="1" value="1" oninput="hitungBaris(this)" required aria-label="Kuantitas barang"></td>',
      '<td>' + satuanSelect('items[' + i + '][satuan]') + '</td>',
      '<td><input type="text" class="form-control tokabe-input jumlah-harga text-end num" placeholder="0" readonly value="0" aria-label="Jumlah harga subtotal"></td>',
      '<td class="text-center"><button type="button" class="btn-row-delete btn-hapus-item" onclick="hapusItem(this)" aria-label="Hapus baris barang" title="Hapus baris"><i class="ri-delete-bin-line fs-16" aria-hidden="true"></i></button></td>'
    ].join('');

    tbody.appendChild(tr);
    updateHapusBtn();
    hitungRingkasan();
  }

  function hapusItem(btn) {
    btn.closest('tr').remove();
    updateHapusBtn();
    hitungRingkasan();
  }

  function updateHapusBtn() {
    const rows = document.querySelectorAll('#item-body .item-row');
    rows.forEach(function(row) {
      const button = row.querySelector('.btn-hapus-item');
      if (button) {
        button.disabled = rows.length <= 1;
      }
    });
  }

  function hitungBaris(input) {
    const row = input.closest('tr');
    const harga = parseRibuan(row.querySelector('.harga').value);
    const qty = parseFloat(row.querySelector('.qty').value) || 0;
    const subtotal = Math.round(harga * qty);
    row.querySelector('.jumlah-harga').value = formatRp(subtotal);
    hitungRingkasan();
  }

  function getSubtotalHarga() {
    let subtotal = 0;
    document.querySelectorAll('#item-body .item-row').forEach(function(row) {
      const harga = parseRibuan(row.querySelector('.harga').value);
      const qty = parseFloat(row.querySelector('.qty').value) || 0;
      subtotal += harga * qty;
    });
    return Math.round(subtotal);
  }

  function hitungRingkasan() {
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    // Update status & terbayar
    const statusEl = document.getElementById('status_pembelian');
    const status = statusEl ? statusEl.value : 'Belum Lunas';
    const terbayarInput = document.getElementById('terbayar');

    if (status === 'Lunas') {
      if (terbayarInput) {
        terbayarInput.value = formatRp(total);
        terbayarInput.readOnly = true;
      }
    } else {
      if (terbayarInput) {
        terbayarInput.readOnly = false;
        let curVal = parseRibuan(terbayarInput.value);
        if (curVal > total) {
          terbayarInput.value = formatRp(total);
        }
      }
    }

    const terbayar = terbayarInput ? parseRibuan(terbayarInput.value) : 0;
    const sisa = Math.max(0, total - terbayar);

    // Update ringkasan tabel bawah
    document.getElementById('summary-subtotal').textContent = 'Rp ' + formatRp(subtotal);
    document.getElementById('summary-total').textContent = 'Rp ' + formatRp(total);
    document.getElementById('summary-sisa').textContent = 'Rp ' + formatRp(sisa);
  }

  function handleStatusChange() {
    const statusEl = document.getElementById('status_pembelian');
    const status = statusEl ? statusEl.value : 'Belum Lunas';
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    const terbayarInput = document.getElementById('terbayar');

    if (status === 'Lunas') {
      if (terbayarInput) {
        terbayarInput.value = formatRp(total);
        terbayarInput.readOnly = true;
      }
    } else {
      if (terbayarInput) {
        terbayarInput.readOnly = false;
        terbayarInput.value = '0';
      }
    }
    hitungRingkasan();
  }

  function handleTerbayarChange() {
    const subtotal = getSubtotalHarga();
    let total = subtotal;

    const terbayarInput = document.getElementById('terbayar');
    let terbayar = terbayarInput ? parseRibuan(terbayarInput.value) : 0;

    if (terbayar > total) {
      terbayar = total;
      if (terbayarInput) terbayarInput.value = formatRp(total);
    }

    const sisa = Math.max(0, total - terbayar);
    document.getElementById('summary-sisa').textContent = 'Rp ' + formatRp(sisa);

    const statusEl = document.getElementById('status_pembelian');
    if (statusEl) {
      if (total > 0 && terbayar >= total) {
        statusEl.value = 'Lunas';
      } else {
        statusEl.value = 'Belum Lunas';
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    initPageTheme();
    updateHapusBtn();
    document.querySelectorAll('.harga').forEach(function(input) {
      formatInputRibuan(input);
    });
    const terbayarInput = document.getElementById('terbayar');
    if (terbayarInput) {
      formatInputRibuan(terbayarInput);
    }
    hitungRingkasan();

    // Sebelum form submit, pastikan angka dikirim tanpa titik pemisah
    document.querySelectorAll('form').forEach(function(form) {
      form.addEventListener('submit', function() {
        document.querySelectorAll('.harga').forEach(function(el) {
          el.value = el.value.replace(/\./g, '');
        });
        const tb = document.getElementById('terbayar');
        if (tb) {
          tb.value = tb.value.replace(/\./g, '');
        }
      });
    });

    // Inisialisasi Flatpickr
    if (typeof flatpickr !== 'undefined') {
      flatpickr("#tanggal_input", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        allowInput: true
      });
      flatpickr("#tanggal_jto_input", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        allowInput: true
      });
    }
  });
</script>
@endsection
