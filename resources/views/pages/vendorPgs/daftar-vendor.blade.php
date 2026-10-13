@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       DESIGN SYSTEM TOKENS & OVERRIDES (DESIGN.md)
       Dark Slate Palette (#020617, #0F172A, #161B22, #1E293B, #334155)
       ========================================================================== */

    .num, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    /* Page Header Title & Breadcrumb (§16.2) */
    .page-title-box h4 {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: -0.01em;
      color: #F1F5F9;
    }
    .breadcrumb .breadcrumb-item a {
      color: #94A3B8;
      text-decoration: none;
      transition: color 0.15s ease;
    }
    .breadcrumb .breadcrumb-item a:hover {
      color: #F1F5F9;
    }
    .breadcrumb .breadcrumb-item.active {
      color: #64748B;
    }

    /* Primary Action Button (§9.1) */
    .btn-add-vendor {
      background-color: #4F46E5 !important;
      border: 1px solid #4F46E5 !important;
      color: #FFFFFF !important;
      font-weight: 500;
      font-size: 13.5px;
      padding: 8px 18px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }
    .btn-add-vendor:hover {
      background-color: #4338CA !important;
      border-color: #4338CA !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
    }
    .btn-add-vendor:active {
      transform: scale(0.98);
    }

    /* KPI Summary Cards (§12.4) */
    .tokabe-kpi-card {
      background: #161B22 !important;
      border: 1px solid #1E293B !important;
      border-radius: 12px !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
      padding: 18px 20px;
      transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
      height: 100%;
    }
    .tokabe-kpi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.4) !important;
      border-color: #334155 !important;
    }
    .kpi-title {
      font-size: 11.5px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #94A3B8;
      margin-bottom: 4px;
    }
    .kpi-amount {
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1.25;
      margin-bottom: 0;
    }
    .kpi-icon-box {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }
    .icon-box-sky {
      background-color: rgba(56, 189, 248, 0.12);
      color: #38BDF8;
      border: 1px solid rgba(56, 189, 248, 0.25);
    }
    .icon-box-emerald {
      background-color: rgba(16, 185, 129, 0.12);
      color: #34D399;
      border: 1px solid rgba(16, 185, 129, 0.25);
    }
    .icon-box-rose {
      background-color: rgba(244, 63, 94, 0.12);
      color: #FB7185;
      border: 1px solid rgba(244, 63, 94, 0.25);
    }

    /* Section Card Container (§12.1) */
    .tokabe-section-card {
      background: #161B22 !important;
      border: 1px solid #1E293B !important;
      border-radius: 12px !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
      margin-bottom: 24px;
      overflow: hidden;
    }
    .tokabe-card-header {
      background: transparent !important;
      border-bottom: 1px solid #1E293B !important;
      padding: 16px 20px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .tokabe-card-title {
      font-size: 15px;
      font-weight: 600;
      color: #F1F5F9;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .badge-count-pill {
      background: rgba(16, 185, 129, 0.12);
      color: #34D399;
      border: 1px solid rgba(16, 185, 129, 0.25);
      padding: 2px 8px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
    }

    /* Filters Bar Controls */
    .form-control-dark,
    .form-select-dark {
      background-color: #0F172A !important;
      border: 1px solid #334155 !important;
      color: #F1F5F9 !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      padding: 6px 12px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-dark::placeholder {
      color: #64748B !important;
    }
    .form-control-dark:focus,
    .form-select-dark:focus {
      border-color: #4F46E5 !important;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
      outline: none !important;
    }

    /* Dark Table Styles (§13) */
    .tokabe-table {
      background-color: #161B22 !important;
      color: #CBD5E1 !important;
      margin-bottom: 0 !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      width: 100% !important;
    }
    .tokabe-table thead th {
      background-color: #0F172A !important;
      color: #94A3B8 !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      border-top: none !important;
      border-bottom: 1px solid #1E293B !important;
      padding: 12px 16px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid #1E293B !important;
      padding: 13px 16px !important;
      font-size: 13.5px !important;
      vertical-align: middle;
      background-color: transparent !important;
    }
    .tokabe-table tbody tr:hover td {
      background-color: rgba(30, 41, 59, 0.45) !important;
    }

    /* Action Ghost Button & Dropdown (§9.2 & §11) */
    .btn-action-ghost {
      background: #1E293B !important;
      border: 1px solid #334155 !important;
      color: #94A3B8 !important;
      border-radius: 6px !important;
      padding: 4px 9px !important;
      transition: all 0.15s ease;
      cursor: pointer;
    }
    .btn-action-ghost:hover {
      background: #334155 !important;
      color: #F1F5F9 !important;
      border-color: #475569 !important;
    }
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
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s ease;
      background: transparent;
      border: none;
      width: 100%;
      text-align: left;
    }
    .dropdown-item:hover {
      background: #1E293B !important;
      color: #F1F5F9 !important;
    }
    .dropdown-item--danger {
      color: #F87171 !important;
    }
    .dropdown-item--danger:hover {
      background: rgba(239, 68, 68, 0.15) !important;
      color: #FCA5A5 !important;
    }
    .dropdown-divider {
      border-color: #1E293B !important;
      margin: 4px 0 !important;
    }

    /* Modals Modern Dark Tokens (§15.3 & §10) */
    .modal {
      z-index: 1065 !important;
    }
    .modal-backdrop {
      z-index: 1055 !important;
      background-color: #020617 !important;
    }
    .modal-backdrop.show {
      opacity: 0.75 !important;
    }
    .tokabe-modal-dark {
      background-color: #161B22 !important;
      border: 1px solid #1E293B !important;
      border-radius: 12px !important;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important;
      overflow: hidden;
    }
    .tokabe-modal-header {
      border-bottom: 1px solid #1E293B !important;
      background: transparent !important;
      padding: 18px 24px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-body {
      padding: 24px !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid #1E293B !important;
      background: rgba(15, 23, 42, 0.5) !important;
      padding: 14px 24px !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }

    /* Modal Form Controls */
    .form-label-modern {
      font-size: 13px;
      font-weight: 500;
      color: #CBD5E1;
      margin-bottom: 6px;
      display: block;
    }
    .form-label-modern .required-star {
      color: #EF4444;
      margin-left: 2px;
    }
    .form-control-modern {
      background-color: #0F172A !important;
      border: 1px solid #334155 !important;
      color: #F1F5F9 !important;
      border-radius: 8px !important;
      height: 42px !important;
      font-size: 13.5px !important;
      padding: 8px 14px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-modern::placeholder {
      color: #64748B !important;
    }
    .form-control-modern:hover:not(:disabled) {
      border-color: #475569 !important;
    }
    .form-control-modern:focus {
      border-color: #4F46E5 !important;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
      outline: none !important;
      background-color: #0F172A !important;
    }
    .form-help-text {
      font-size: 11.5px;
      color: #64748B;
      margin-top: 4px;
      margin-bottom: 0;
    }

    /* Buttons Modal Actions */
    .btn-modal-cancel {
      background-color: #1E293B !important;
      border: 1px solid #334155 !important;
      color: #CBD5E1 !important;
      border-radius: 8px !important;
      font-weight: 500;
      font-size: 13.5px;
      padding: 8px 18px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
    }
    .btn-modal-cancel:hover {
      background-color: #334155 !important;
      color: #F1F5F9 !important;
    }
    .btn-modal-submit {
      background-color: #4F46E5 !important;
      border: 1px solid #4F46E5 !important;
      color: #FFFFFF !important;
      border-radius: 8px !important;
      font-weight: 500;
      font-size: 13.5px;
      padding: 8px 22px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    .btn-modal-submit:hover {
      background-color: #4338CA !important;
      border-color: #4338CA !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
    }
    .btn-modal-submit:active {
      transform: scale(0.98);
    }

    /* Danger Modal Delete */
    .del-modal-radio {
      appearance: none !important;
      -webkit-appearance: none !important;
      width: 18px !important;
      height: 18px !important;
      border-radius: 50% !important;
      border: 2px solid #64748B !important;
      background-color: #0F172A !important;
      cursor: pointer !important;
      display: inline-grid !important;
      place-content: center !important;
      margin-top: 3px !important;
      flex-shrink: 0 !important;
      transition: all 0.15s ease !important;
    }
    .del-modal-radio::before {
      content: "" !important;
      width: 8px !important;
      height: 8px !important;
      border-radius: 50% !important;
      transform: scale(0) !important;
      transition: 120ms transform ease-in-out !important;
      box-shadow: inset 1em 1em #6366F1 !important;
    }
    .del-modal-radio:checked {
      border-color: #6366F1 !important;
      background-color: rgba(99, 102, 241, 0.15) !important;
    }
    .del-modal-radio:checked::before {
      transform: scale(1) !important;
    }
    #action_delete_all:checked {
      border-color: #EF4444 !important;
      background-color: rgba(239, 68, 68, 0.15) !important;
    }
    #action_delete_all:checked::before {
      box-shadow: inset 1em 1em #EF4444 !important;
    }
    .action-choice-card {
      border-radius: 10px !important;
      transition: all 0.15s ease !important;
      cursor: pointer !important;
      background: #0F172A !important;
    }
    .action-choice-card:hover {
      border-color: #475569 !important;
    }
    .btn-modal-delete {
      background-color: #DC2626 !important;
      border-color: #DC2626 !important;
      color: #FFFFFF !important;
      border-radius: 8px !important;
      font-weight: 500;
      padding: 8px 18px;
      transition: all 0.15s ease;
    }
    .btn-modal-delete:hover {
      background-color: #B91C1C !important;
      border-color: #B91C1C !important;
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35);
    }
  </style>
@endsection

@extends('layout.template')

@section('content')
<div class="page-content">
  <div class="container-fluid">

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Pembelian Pada Vendor</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Vendor</a></li>
              <li class="breadcrumb-item active">Daftar Vendor</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row (§9.1) -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <button type="button" class="btn btn-add-vendor" data-bs-toggle="modal" data-bs-target="#modalTambahVendor" id="btnOpenModalVendor">
            <i class="las la-plus fs-16"></i>
            <span>Tambah Vendor</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Summary KPI Cards (§12.4) -->
    @if (in_array(Auth::user()->role, ['Pemilik', 'Admin']))
      <div class="row g-3 mb-4">
        <!-- KPI 1: Total Pembelian -->
        <div class="col-xl-3 col-md-6">
          <div class="tokabe-kpi-card">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="kpi-title">TOTAL PEMBELIAN</div>
                <h4 class="kpi-amount text-white num">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h4>
              </div>
              <div class="kpi-icon-box icon-box-sky">
                <i class="ri-file-list-3-line"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- KPI 2: Total Terbayar -->
        <div class="col-xl-3 col-md-6">
          <div class="tokabe-kpi-card">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="kpi-title">TOTAL TERBAYAR</div>
                <h4 class="kpi-amount num" style="color: #34D399;">Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</h4>
              </div>
              <div class="kpi-icon-box icon-box-emerald">
                <i class="ri-checkbox-circle-line"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- KPI 3: Sisa Belum Dibayar -->
        <div class="col-xl-3 col-md-6">
          <div class="tokabe-kpi-card">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="kpi-title">SISA BELUM DIBAYAR</div>
                <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? '#FB7185' : '#94A3B8' }};">
                  Rp {{ number_format($totalSisa, 0, ',', '.') }}
                </h4>
              </div>
              <div class="kpi-icon-box icon-box-rose">
                <i class="ri-error-warning-line"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- KPI 4: Sisa Duit Kas -->
        <div class="col-xl-3 col-md-6">
          <div class="tokabe-kpi-card">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                  <div class="kpi-title mb-0">SISA DUIT KAS</div>
                  @if(($sisaKas ?? 0) < 0)
                    <span class="badge py-0 px-1.5 fs-10 fw-semibold" style="background: rgba(244, 63, 94, 0.15); color: #FB7185; border: 1px solid rgba(244, 63, 94, 0.3);">Minus</span>
                  @else
                    <span class="badge py-0 px-1.5 fs-10 fw-semibold" style="background: rgba(56, 189, 248, 0.15); color: #38BDF8; border: 1px solid rgba(56, 189, 248, 0.3);">Tersedia</span>
                  @endif
                </div>
                <h4 class="kpi-amount num" style="color: {{ ($sisaKas ?? 0) >= 0 ? '#38BDF8' : '#FB7185' }};">
                  @if(($sisaKas ?? 0) < 0)
                    -Rp {{ number_format(abs($sisaKas ?? 0), 0, ',', '.') }}
                  @else
                    Rp {{ number_format($sisaKas ?? 0, 0, ',', '.') }}
                  @endif
                </h4>
              </div>
              <div class="kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-sky' : 'icon-box-rose' }}">
                <i class="ri-wallet-3-line"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="tokabe-kpi-card">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="kpi-title">SISA BELUM DIBAYAR</div>
                <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? '#FB7185' : '#94A3B8' }};">
                  Rp {{ number_format($totalSisa, 0, ',', '.') }}
                </h4>
              </div>
              <div class="kpi-icon-box icon-box-rose">
                <i class="ri-error-warning-line"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Table Section: Daftar Vendor (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card" id="cardDaftarVendor">
          <div class="tokabe-card-header">
            <div class="d-flex align-items-center gap-2">
              <div class="tokabe-card-title">
                <i class="ri-store-2-line text-info fs-18"></i>
                <span>Daftar Vendor</span>
              </div>
              <span class="badge-count-pill" id="vendorCountBadge">{{ count($vendors) }} Vendor</span>
            </div>

            <!-- Filters Bar Controls -->
            <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
              <!-- Cari Nama Vendor -->
              <div class="position-relative" style="min-width: 220px;">
                <input type="text" id="searchVendorInput" class="form-control form-control-dark ps-4 pe-4" placeholder="Cari nama vendor...">
                <i class="ri-search-line position-absolute top-50 start-0 translate-middle-y ms-2.5 text-muted fs-13"></i>
                <button type="button" id="clearVendorSearch" class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-muted p-0 me-2 d-none" style="text-decoration: none;" title="Hapus pencarian">
                  <i class="ri-close-line fs-14"></i>
                </button>
              </div>

              <!-- Filter Status Pembayaran -->
              <select id="filterStatusVendor" class="form-select form-select-dark" style="width: 170px;" title="Filter status tagihan vendor">
                <option value="all">Semua Status</option>
                <option value="belum_lunas">Hanya Belum Lunas</option>
                <option value="lunas">Hanya Sudah Lunas</option>
              </select>

              <!-- Urutan / Sort Filter -->
              <select id="sortVendorSelect" class="form-select form-select-dark" style="width: 230px;" title="Urutkan data vendor">
                <option value="sisa_desc" selected>Sisa Belum Dibayar (Tertinggi)</option>
                <option value="sisa_asc">Sisa Belum Dibayar (Terendah)</option>
                <option value="total_desc">Total Pembelian (Tertinggi)</option>
              </select>

              <button type="button" class="btn btn-action-ghost py-1 px-2.5" id="btnResetVendorFilter" title="Reset filter" onclick="resetVendorFilters()">
                <i class="ri-refresh-line fs-14"></i>
              </button>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0 tokabe-table" id="vendorTable">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">NO.</th>
                    <th>NAMA VENDOR</th>
                    <th class="text-end">TOTAL TRANSAKSI (RP)</th>
                    <th class="text-end">TOTAL TERBAYAR (RP)</th>
                    <th class="text-end">TOTAL SISA (RP)</th>
                    <th class="text-center" style="width: 80px;">AKSI</th>
                  </tr>
                </thead>
                <tbody id="vendorTableBody">
                  @forelse ($vendors as $vendor)
                    <tr class="vendor-row"
                        data-vendor-name="{{ strtolower($vendor->nama_vendor) }}"
                        data-total-pembelian="{{ (float) $vendor->total_pembelian }}"
                        data-terbayar="{{ (float) $vendor->pembelian_terbayar }}"
                        data-sisa="{{ (float) $vendor->pembelian_sisa }}">
                      <td class="text-center row-number text-muted num" style="font-size: 12.5px;">{{ $loop->iteration }}</td>
                      <td>
                        <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="fw-semibold text-white text-decoration-none" style="font-size: 13.5px; transition: color 0.15s ease;" onmouseover="this.style.color='#38BDF8'" onmouseout="this.style.color='#FFFFFF'">
                          {{ $vendor->nama_vendor }}
                        </a>
                      </td>
                      <td class="text-end fw-bold text-white num">
                        {{ number_format($vendor->total_pembelian, 0, ',', '.') }}
                      </td>
                      <td class="text-end fw-bold num" style="color: #34D399;">
                        {{ number_format($vendor->pembelian_terbayar, 0, ',', '.') }}
                      </td>
                      <td class="text-end fw-bold num" style="color: {{ $vendor->pembelian_sisa > 0 ? '#FB7185' : '#94A3B8' }};">
                        {{ number_format($vendor->pembelian_sisa, 0, ',', '.') }}
                      </td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                            <i class="las la-ellipsis-h fs-16"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}">
                                <i class="ri-list-check fs-16 text-info"></i>
                                <span>Lihat Transaksi</span>
                              </a>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item edit-vendor-button"
                                      data-vendor-id="{{ $vendor->id }}" 
                                      data-vendor-name="{{ $vendor->nama_vendor }}"
                                      data-bs-toggle="modal" 
                                      data-bs-target="#editVendorModal">
                                <i class="ri-edit-line fs-16 text-warning"></i>
                                <span>Edit Vendor</span>
                              </button>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <button type="button" class="dropdown-item dropdown-item--danger delete-vendor-button"
                                      data-vendor-id="{{ $vendor->id }}"
                                      data-vendor-name="{{ $vendor->nama_vendor }}"
                                      data-pembelian-count="{{ $vendor->pembelian_count ?? 0 }}"
                                      data-total-pembelian="{{ number_format($vendor->total_pembelian, 0, ',', '.') }}"
                                      data-pembelian-terbayar="{{ number_format($vendor->pembelian_terbayar, 0, ',', '.') }}"
                                      data-pembelian-sisa="{{ number_format($vendor->pembelian_sisa, 0, ',', '.') }}">
                                <i class="ri-delete-bin-line fs-16 text-danger"></i>
                                <span>Hapus Vendor</span>
                              </button>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada vendor terdaftar.</td></tr>
                  @endforelse
                  <tr id="noVendorFoundRow" class="d-none">
                    <td colspan="6" class="text-center py-5 text-muted">
                      <i class="ri-search-eye-line fs-28 d-block mb-2 text-secondary"></i>
                      <span class="fs-13">Tidak ada vendor yang cocok dengan kriteria pencarian atau filter ini.</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- MODAL POPUP: TAMBAH VENDOR (§15.3 & §10) --}}
<div class="modal fade" id="modalTambahVendor" tabindex="-1" aria-labelledby="modalTambahVendorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="modalTambahVendorLabel">
            <i class="ri-store-2-line fs-18 text-info"></i>
            <span>Tambah Vendor Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Daftarkan supplier / vendor baru untuk riwayat tagihan pembelian.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form action="{{ route('vendor.store') }}" method="POST" id="formTambahVendor">
        @csrf
        <div class="tokabe-modal-body">
          <label for="inputNamaVendor" class="form-label-modern">
            Nama Vendor / Supplier <span class="required-star">*</span>
          </label>
          <input type="text" 
                 id="inputNamaVendor" 
                 name="nama_vendor" 
                 class="form-control form-control-modern" 
                 placeholder="Misal: PT. Pixentra, Gading Murni UV" 
                 required 
                 autocomplete="off">
          <p class="form-help-text">Nama resmi vendor yang tertera pada invoice pembelian</p>
        </div>
        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit" id="btnSubmitVendor">
            <i class="las la-plus-circle fs-16"></i>
            <span>Simpan Vendor</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT VENDOR (§15.3 & §10) --}}
<div class="modal fade" id="editVendorModal" tabindex="-1" aria-labelledby="editVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <form id="editVendorForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="vendor_id" id="edit_vendor_id">
        <div class="tokabe-modal-header">
          <div>
            <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="editVendorModalLabel">
              <i class="ri-edit-line fs-18 text-warning"></i>
              <span>Edit Nama Vendor</span>
            </h5>
            <p class="text-muted fs-12 mb-0">Perbarui identitas atau nama resmi supplier / vendor.</p>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="tokabe-modal-body">
          <label for="edit_nama_vendor" class="form-label-modern">
            Nama Vendor <span class="required-star">*</span>
          </label>
          <input id="edit_nama_vendor" name="vendor" type="text" class="form-control form-control-modern" placeholder="Nama Vendor" required>
          <p class="form-help-text">Perubahan nama akan otomatis tersinkron ke semua nota pembelian terkait</p>
        </div>
        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit" style="background-color: #D97706 !important; border-color: #D97706 !important;">
            <i class="las la-save fs-16"></i>
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: KONFIRMASI HAPUS VENDOR (§15.3) --}}
<div class="modal fade" id="deleteVendorModal" tabindex="-1" aria-labelledby="deleteVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
    <div class="modal-content tokabe-modal-dark shadow-lg">
      <form id="deleteVendorForm" method="POST">
        @csrf
        @method('DELETE')
        
        <div class="tokabe-modal-header">
          <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="background: rgba(239, 68, 68, 0.15); color: #F87171; width: 36px; height: 36px; border: 1px solid rgba(239, 68, 68, 0.25);">
              <i class="ri-delete-bin-line fs-18"></i>
            </div>
            <div>
              <h5 class="modal-title fs-16 fw-bold text-white mb-0" id="deleteVendorModalLabel">
                Konfirmasi Hapus Vendor
              </h5>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="tokabe-modal-body">
          <div class="text-center mb-3">
            <p class="text-muted fs-13 mb-1">Apakah Anda yakin ingin menghapus vendor berikut?</p>
            <div class="d-inline-flex align-items-center gap-2 py-1 px-3 rounded-pill mt-1" style="background: #0F172A; border: 1px solid rgba(99, 102, 241, 0.4);">
              <i class="ri-store-2-fill fs-15" style="color: #818CF8;"></i>
              <span class="fw-bold fs-14 text-white" id="del_vendor_name_badge">-</span>
            </div>
          </div>

          {{-- Blok Jika Memiliki Riwayat Pembelian --}}
          <div id="del_section_has_trx" class="d-none">
            <div class="p-3 mb-3 rounded" style="background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35);">
              <div class="d-flex align-items-start gap-2.5">
                <i class="ri-alert-fill text-warning fs-18 flex-shrink-0 mt-0.5"></i>
                <div class="fs-13 text-white" style="line-height: 1.5;">
                  Vendor ini memiliki <span class="badge px-2 py-0.5 fs-12 fw-bold" style="background: rgba(245, 158, 11, 0.25); color: #FBBF24; border: 1px solid rgba(245, 158, 11, 0.4);" id="del_trx_count_text">0 Transaksi</span> dengan total nilai <strong class="text-white fw-bold num" id="del_trx_nominal_text">Rp 0</strong>.
                </div>
              </div>
            </div>

            <label class="form-label fw-semibold fs-11 text-uppercase mb-2" style="letter-spacing: 0.6px; color: #94A3B8;">
              PILIH PENANGANAN RIWAYAT PEMBELIAN:
            </label>

            {{-- Opsi 1: Pindahkan Transaksi (Default) --}}
            <div class="card mb-3 action-choice-card border" id="card_action_transfer" style="border-color: #6366F1 !important; border: 1px solid;">
              <div class="card-body p-3">
                <div class="d-flex align-items-start gap-2.5">
                  <input class="del-modal-radio" type="radio" name="action" id="action_transfer" value="transfer" checked>
                  <div class="flex-grow-1">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                      <label class="form-check-label fw-semibold text-white fs-13 mb-0" for="action_transfer" style="cursor: pointer;">
                        Pindahkan riwayat pembelian ke vendor lain
                      </label>
                      <span class="badge px-2 py-0.5 rounded-pill fs-11 fw-semibold" style="background: rgba(16, 185, 129, 0.18); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.35);">
                        Direkomendasikan
                      </span>
                    </div>
                    <p class="fs-12 mb-2 text-muted" style="line-height: 1.45;">
                      Semua transaksi pembelian dan tagihan akan dialihkan ke vendor baru yang Anda pilih di bawah.
                    </p>

                    <div id="target_vendor_wrapper" class="pt-2 border-top border-dark">
                      <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <label for="target_vendor_search_input" class="form-label fs-12 fw-medium text-white mb-0">
                          Pilih Vendor Tujuan:
                        </label>
                        <span id="target_vendor_count_info" class="fs-11 fw-medium" style="color: #818CF8;">
                          0 vendor tersedia
                        </span>
                      </div>

                      <div class="input-group input-group-sm mb-2 shadow-sm">
                        <span class="input-group-text border-0" style="background: #1E293B; color: #94A3B8;">
                          <i class="ri-search-line fs-14"></i>
                        </span>
                        <input type="text" id="target_vendor_search_input" class="form-control form-control-sm border-0" 
                               placeholder="Ketik untuk mencari nama vendor..." 
                               style="background: #1E293B; color: #F8FAFC; font-size: 13px;">
                        <button class="btn btn-sm border-0" type="button" id="btn_clear_vendor_search" style="display: none; background: #1E293B; color: #94A3B8;" title="Hapus Pencarian">
                          <i class="ri-close-line"></i>
                        </button>
                      </div>

                      <select name="target_vendor_id" id="target_vendor_select" class="form-select form-select-sm shadow-sm" size="5" 
                              style="background: #0F172A; color: #F8FAFC; border: 1px solid #334155; border-radius: 8px; font-size: 13px; line-height: 1.5; padding: 4px;">
                      </select>
                      
                      <div class="d-flex justify-content-between align-items-center mt-1.5">
                        <small class="fs-11 text-muted" id="target_vendor_selection_hint">
                          Klik salah satu vendor untuk memilih.
                        </small>
                        <small class="fs-11 fw-bold text-success d-none" id="selected_vendor_preview">
                          <i class="ri-checkbox-circle-fill me-1"></i>Terpilih: <span id="selected_vendor_name_text" class="text-white"></span>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Opsi 2: Hapus Sekaligus --}}
            <div class="card mb-0 action-choice-card border" id="card_action_delete_all" style="border-color: #334155 !important; border: 1px solid;">
              <div class="card-body p-3">
                <div class="d-flex align-items-start gap-2.5">
                  <input class="del-modal-radio" type="radio" name="action" id="action_delete_all" value="delete_all">
                  <div class="flex-grow-1">
                    <label class="form-check-label fw-semibold fs-13 mb-1" for="action_delete_all" style="color: #F87171 !important; cursor: pointer;">
                      Hapus sekaligus vendor beserta seluruh riwayat pembeliannya
                    </label>
                    <p class="fs-12 mb-0 text-muted" style="line-height: 1.45;">
                      <strong class="text-danger">Peringatan:</strong> Seluruh transaksi pembelian dan detail barang vendor ini akan dihapus permanen. Anggaran kas yang telah terpakai akan dikembalikan ke saldo anggaran.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Blok Jika Belum Ada Transaksi --}}
          <div id="del_section_no_trx" class="d-none">
            <div class="p-3 rounded text-center" style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.3);">
              <i class="ri-checkbox-circle-line text-success fs-26 d-block mb-1"></i>
              <span class="fs-13 fw-medium text-white">Vendor ini belum memiliki riwayat pembelian, sehingga aman untuk langsung dihapus.</span>
            </div>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-delete" id="btn_confirm_delete_vendor">
            <i class="ri-delete-bin-line me-1.5"></i>Ya, Hapus Vendor
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
  // Pindahkan semua modal langsung ke elemen <body> agar terbebas dari stacking context
  $(document).ready(function() {
      $('#modalTambahVendor').appendTo('body');
      $('#editVendorModal').appendTo('body');
      $('#deleteVendorModal').appendTo('body');
  });

  // ==========================================
  // Filter dan Pencarian Tabel Vendor
  // ==========================================
  const searchVendorInput = document.getElementById('searchVendorInput');
  const filterStatusVendor = document.getElementById('filterStatusVendor');
  const sortVendorSelect = document.getElementById('sortVendorSelect');
  const clearVendorSearch = document.getElementById('clearVendorSearch');

  function applyVendorFilterAndSort() {
    const searchInput = document.getElementById('searchVendorInput');
    const statusSelect = document.getElementById('filterStatusVendor');
    const sortSelect = document.getElementById('sortVendorSelect');
    const tableBody = document.getElementById('vendorTableBody');
    const noFoundRow = document.getElementById('noVendorFoundRow');
    const badgeCount = document.getElementById('vendorCountBadge');
    const clearBtn = document.getElementById('clearVendorSearch');

    if (!tableBody) return;

    const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
    const statusFilter = statusSelect ? statusSelect.value : 'all';
    const sortBy = sortSelect ? sortSelect.value : 'sisa_desc';

    if (clearBtn) {
      clearBtn.classList.toggle('d-none', searchTerm === '');
    }

    const rows = Array.from(tableBody.querySelectorAll('tr.vendor-row'));

    let visibleCount = 0;
    rows.forEach(row => {
      const name = (row.dataset.vendorName || '').toLowerCase();
      const sisa = parseFloat(row.dataset.sisa || '0');

      const matchSearch = searchTerm === '' || name.includes(searchTerm);
      let matchStatus = true;
      if (statusFilter === 'belum_lunas') {
        matchStatus = sisa > 0;
      } else if (statusFilter === 'lunas') {
        matchStatus = sisa <= 0;
      }

      const isVisible = matchSearch && matchStatus;
      row.style.display = isVisible ? '' : 'none';
      if (isVisible) visibleCount++;
    });

    // Pengurutan baris tabel
    rows.sort((a, b) => {
      const nameA = a.dataset.vendorName || '';
      const nameB = b.dataset.vendorName || '';
      const sisaA = parseFloat(a.dataset.sisa || '0');
      const sisaB = parseFloat(b.dataset.sisa || '0');
      const totalA = parseFloat(a.dataset.totalPembelian || '0');
      const totalB = parseFloat(b.dataset.totalPembelian || '0');

      if (sortBy === 'sisa_desc') {
        return sisaB - sisaA || nameA.localeCompare(nameB);
      } else if (sortBy === 'sisa_asc') {
        return sisaA - sisaB || nameA.localeCompare(nameB);
      } else if (sortBy === 'total_desc') {
        return totalB - totalA || nameA.localeCompare(nameB);
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
      badgeCount.textContent = `${visibleCount} Vendor`;
    }
  }

  function resetVendorFilters() {
    const searchInput = document.getElementById('searchVendorInput');
    const statusSelect = document.getElementById('filterStatusVendor');
    const sortSelect = document.getElementById('sortVendorSelect');
    if (searchInput) searchInput.value = '';
    if (statusSelect) statusSelect.value = 'all';
    if (sortSelect) sortSelect.value = 'sisa_desc';
    applyVendorFilterAndSort();
  }

  if (searchVendorInput) {
    searchVendorInput.addEventListener('input', applyVendorFilterAndSort);
  }
  if (clearVendorSearch) {
    clearVendorSearch.addEventListener('click', () => {
      if (searchVendorInput) {
        searchVendorInput.value = '';
        applyVendorFilterAndSort();
        searchVendorInput.focus();
      }
    });
  }
  if (filterStatusVendor) {
    filterStatusVendor.addEventListener('change', applyVendorFilterAndSort);
  }
  if (sortVendorSelect) {
    sortVendorSelect.addEventListener('change', applyVendorFilterAndSort);
  }

  // Delegated event listener untuk Edit Vendor Modal Action
  const editVendorBaseUrl = "{{ url('/update-vendor') }}";
  $(document).on('click', '.edit-vendor-button', function() {
    const vendorId = $(this).data('vendorId');
    const vendorName = $(this).data('vendorName');
    $('#editVendorForm').attr('action', editVendorBaseUrl + '/' + vendorId);
    $('#edit_vendor_id').val(vendorId);
    $('#edit_nama_vendor').val(vendorName);
  });

  // ==========================================
  // Modal Konfirmasi Hapus Vendor Interaktif
  // ==========================================
  const deleteVendorBaseUrl = "{{ url('/delete-vendor') }}";
  const allVendorsList = @json($vendors->map(fn($v) => ['id' => $v->id, 'nama_vendor' => $v->nama_vendor]));
  let currentDeletingVendorId = null;

  const targetVendorSelect = document.getElementById('target_vendor_select');
  const targetVendorSearchInput = document.getElementById('target_vendor_search_input');
  const btnClearVendorSearch = document.getElementById('btn_clear_vendor_search');
  const targetVendorCountInfo = document.getElementById('target_vendor_count_info');
  const cardActionTransfer = document.getElementById('card_action_transfer');
  const cardActionDeleteAll = document.getElementById('card_action_delete_all');
  const radioTransfer = document.getElementById('action_transfer');
  const radioDeleteAll = document.getElementById('action_delete_all');
  const targetVendorWrapper = document.getElementById('target_vendor_wrapper');
  const selectedVendorPreview = document.getElementById('selected_vendor_preview');
  const selectedVendorNameText = document.getElementById('selected_vendor_name_text');

  function updateDeleteActionUI(action) {
    if (action === 'transfer') {
      if (radioTransfer) radioTransfer.checked = true;
      if (cardActionTransfer) {
        cardActionTransfer.style.borderColor = '#6366F1';
      }
      if (cardActionDeleteAll) {
        cardActionDeleteAll.style.borderColor = '#334155';
      }
      if (targetVendorWrapper) {
        targetVendorWrapper.style.opacity = '1';
        targetVendorWrapper.style.pointerEvents = 'auto';
      }
      if (targetVendorSelect) {
        targetVendorSelect.required = true;
      }
    } else {
      if (radioDeleteAll) radioDeleteAll.checked = true;
      if (cardActionDeleteAll) {
        cardActionDeleteAll.style.borderColor = '#EF4444';
      }
      if (cardActionTransfer) {
        cardActionTransfer.style.borderColor = '#334155';
      }
      if (targetVendorWrapper) {
        targetVendorWrapper.style.opacity = '0.35';
        targetVendorWrapper.style.pointerEvents = 'none';
      }
      if (targetVendorSelect) {
        targetVendorSelect.required = false;
      }
    }
  }

  function renderTargetVendorSelect(query = '') {
    if (!targetVendorSelect) return;

    const available = allVendorsList.filter(v => String(v.id) !== String(currentDeletingVendorId));
    const normalizedQuery = query.toLowerCase().trim();
    const filtered = normalizedQuery 
      ? available.filter(v => v.nama_vendor.toLowerCase().includes(normalizedQuery))
      : available;

    if (targetVendorCountInfo) {
      targetVendorCountInfo.textContent = `${filtered.length} vendor tersedia`;
    }

    targetVendorSelect.innerHTML = '';

    if (filtered.length === 0) {
      const opt = document.createElement('option');
      opt.disabled = true;
      opt.textContent = normalizedQuery ? 'Tidak ada vendor yang cocok...' : 'Tidak ada vendor tujuan lain.';
      opt.style.color = '#94A3B8';
      opt.style.padding = '8px 12px';
      targetVendorSelect.appendChild(opt);
      if (selectedVendorPreview) selectedVendorPreview.classList.add('d-none');
      return;
    }

    filtered.forEach((vendor, index) => {
      const opt = document.createElement('option');
      opt.value = vendor.id;
      opt.textContent = vendor.nama_vendor;
      if (index === 0) {
        opt.selected = true;
      }
      targetVendorSelect.appendChild(opt);
    });

    updateSelectedVendorPreview();
  }

  function updateSelectedVendorPreview() {
    if (!targetVendorSelect || !selectedVendorPreview || !selectedVendorNameText) return;
    const selectedOpt = targetVendorSelect.options[targetVendorSelect.selectedIndex];
    if (selectedOpt && !selectedOpt.disabled) {
      selectedVendorNameText.textContent = selectedOpt.textContent;
      selectedVendorPreview.classList.remove('d-none');
    } else {
      selectedVendorPreview.classList.add('d-none');
    }
  }

  // Delegated event listener untuk tombol hapus vendor pada tabel
  $(document).on('click', '.delete-vendor-button', function() {
    const vendorId = $(this).data('vendorId');
    const vendorName = $(this).data('vendorName');
    const trxCount = parseInt($(this).data('pembelianCount') || '0');
    const totalPembelian = $(this).data('totalPembelian') || '0';

    currentDeletingVendorId = vendorId;

    $('#deleteVendorForm').attr('action', deleteVendorBaseUrl + '/' + vendorId);
    $('#del_vendor_name_badge').text(vendorName);

    const secHasTrx = document.getElementById('del_section_has_trx');
    const secNoTrx = document.getElementById('del_section_no_trx');
    const trxCountText = document.getElementById('del_trx_count_text');
    const trxNominalText = document.getElementById('del_trx_nominal_text');

    if (trxCount > 0) {
      if (secHasTrx) secHasTrx.classList.remove('d-none');
      if (secNoTrx) secNoTrx.classList.add('d-none');
      if (trxCountText) trxCountText.textContent = `${trxCount} Transaksi Pembelian`;
      if (trxNominalText) trxNominalText.textContent = `Rp ${totalPembelian}`;

      updateDeleteActionUI('transfer');

      if (targetVendorSearchInput) targetVendorSearchInput.value = '';
      if (btnClearVendorSearch) btnClearVendorSearch.style.display = 'none';
      renderTargetVendorSelect('');
    } else {
      if (secHasTrx) secHasTrx.classList.add('d-none');
      if (secNoTrx) secNoTrx.classList.remove('d-none');
      if (targetVendorSelect) targetVendorSelect.required = false;
    }

    $('#deleteVendorModal').modal('show');
  });

  // Interaksi klik kartu / radio transfer
  if (cardActionTransfer) {
    cardActionTransfer.addEventListener('click', (e) => {
      if (e.target.closest('#target_vendor_wrapper')) return;
      updateDeleteActionUI('transfer');
    });
  }
  if (radioTransfer) {
    radioTransfer.addEventListener('change', () => updateDeleteActionUI('transfer'));
  }

  // Interaksi klik kartu / radio hapus semua
  if (cardActionDeleteAll) {
    cardActionDeleteAll.addEventListener('click', () => updateDeleteActionUI('delete_all'));
  }
  if (radioDeleteAll) {
    radioDeleteAll.addEventListener('change', () => updateDeleteActionUI('delete_all'));
  }

  // Pencarian live vendor tujuan
  if (targetVendorSearchInput) {
    targetVendorSearchInput.addEventListener('input', function() {
      const val = this.value;
      if (btnClearVendorSearch) {
        btnClearVendorSearch.style.display = val.length > 0 ? 'inline-block' : 'none';
      }
      renderTargetVendorSelect(val);
    });
  }

  if (btnClearVendorSearch) {
    btnClearVendorSearch.addEventListener('click', function() {
      if (targetVendorSearchInput) {
        targetVendorSearchInput.value = '';
        this.style.display = 'none';
        renderTargetVendorSelect('');
        targetVendorSearchInput.focus();
      }
    });
  }

  if (targetVendorSelect) {
    targetVendorSelect.addEventListener('change', updateSelectedVendorPreview);
  }

  // Validasi sebelum submit form hapus
  const deleteVendorForm = document.getElementById('deleteVendorForm');
  if (deleteVendorForm) {
    deleteVendorForm.addEventListener('submit', function (e) {
      const secHasTrx = document.getElementById('del_section_has_trx');
      if (secHasTrx && !secHasTrx.classList.contains('d-none')) {
        if (radioTransfer && radioTransfer.checked) {
          if (!targetVendorSelect || !targetVendorSelect.value) {
            e.preventDefault();
            alert('Silakan pilih salah satu vendor tujuan terlebih dahulu.');
            if (targetVendorSelect) targetVendorSelect.focus();
            return false;
          }
        }
      }
    });
  }

  // Focus input saat modal tambah dibuka
  $('#modalTambahVendor').on('shown.bs.modal', function() {
    setTimeout(function() {
      $('#inputNamaVendor').focus();
    }, 50);
  });

  $('#modalTambahVendor').on('hidden.bs.modal', function() {
    $('#formTambahVendor')[0].reset();
  });

  // Focus input saat modal edit dibuka
  $('#editVendorModal').on('shown.bs.modal', function() {
    setTimeout(function() {
      $('#edit_nama_vendor').focus();
    }, 50);
  });

  document.addEventListener('DOMContentLoaded', function () {
    applyVendorFilterAndSort();
  });
</script>
@endsection