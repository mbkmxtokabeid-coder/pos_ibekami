# Script to update daftar-spb.blade.php to Tokabe Warm Stone Design System

content = '''@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<style>
  /* ==========================================================================
     TOKABE SPB (SURAT PENGANTAR BARANG) — DUAL THEME WARM STONE SYSTEM
     ========================================================================== */

  :root {
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

    --ibk-brand: #F59E0B;
    --ibk-brand-deep: #EA580C;
    --ibk-brand-soft: rgba(245, 158, 11, 0.12);
    --ibk-brand-border: rgba(245, 158, 11, 0.24);
    --ibk-brand-text: #FBBF24;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;

    --ibk-success: #10B981;
    --ibk-success-soft: rgba(16, 185, 129, 0.14);
    --ibk-success-border: rgba(16, 185, 129, 0.28);
    --ibk-danger: #EF4444;
    --ibk-danger-soft: rgba(239, 68, 68, 0.14);
    --ibk-danger-border: rgba(239, 68, 68, 0.28);

    --ibk-input-bg: rgba(255, 255, 255, 0.04);
    --ibk-input-border: rgba(255, 255, 255, 0.12);
    --ibk-input-text: #FAFAFA;
    --ibk-input-placeholder: #71717A;
    --ibk-popover-bg: #181412;

    --ibk-th-bg: #14110F;
    --ibk-th-text: #A1A1AA;
    --ibk-td-border: rgba(255, 255, 255, 0.06);

    --ibk-modal-bg: #181412;
    --ibk-modal-border: rgba(255, 255, 255, 0.08);
  }

  body.theme-light,
  html.theme-light,
  html[data-layout-mode="light"] {
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

    --ibk-brand: #EA580C;
    --ibk-brand-deep: #C2410C;
    --ibk-brand-soft: #FFF7ED;
    --ibk-brand-border: #FED7AA;
    --ibk-brand-text: #EA580C;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;

    --ibk-success: #059669;
    --ibk-success-soft: #ECFDF5;
    --ibk-success-border: #A7F3D0;
    --ibk-danger: #DC2626;
    --ibk-danger-soft: #FEF2F2;
    --ibk-danger-border: #FECACA;

    --ibk-input-bg: #FFFFFF;
    --ibk-input-border: #CBD5E1;
    --ibk-input-text: #0F172A;
    --ibk-input-placeholder: #94A3B8;
    --ibk-popover-bg: #FFFFFF;

    --ibk-th-bg: #F8FAFC;
    --ibk-th-text: #64748B;
    --ibk-td-border: #E2E8F0;

    --ibk-modal-bg: #FFFFFF;
    --ibk-modal-border: #E2E8F0;
  }

  .num, .price, .numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  /* Page Wrapper */
  .surat-page-wrapper {
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
    font-weight: 600;
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

  /* Action Buttons */
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
    transition: background-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
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

  /* KPI Summary Cards */
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
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .kpi-amount {
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -0.015em;
    line-height: 1.2;
    margin-bottom: 0;
    color: var(--ibk-text);
  }
  .kpi-icon-box {
    width: 42px;
    height: 42px;
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

  /* Card & Table */
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
    background: var(--ibk-brand-soft);
    color: var(--ibk-brand-text);
    border: 1px solid var(--ibk-brand-border);
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 600;
  }

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

  /* Status Badges */
  .badge-status-delivered {
    background: var(--ibk-success-soft) !important;
    border: 1px solid var(--ibk-success-border) !important;
    color: var(--ibk-success) !important;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-status-undelivered {
    background: var(--ibk-danger-soft) !important;
    border: 1px solid var(--ibk-danger-border) !important;
    color: var(--ibk-danger) !important;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-perusahaan-spb {
    font-size: 12px;
    font-weight: 600;
    color: var(--ibk-brand-text) !important;
    background: var(--ibk-brand-soft);
    border: 1px solid var(--ibk-brand-border);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Action Ghost & Dropdown */
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

  /* DataTables Styling */
  .dataTables_wrapper {
    color: var(--ibk-text-muted) !important;
    padding: 16px 20px;
  }
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter,
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_paginate {
    color: var(--ibk-text-muted) !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper .dataTables_length select {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    color: var(--ibk-input-text) !important;
    border-radius: 6px !important;
    height: 34px !important;
    padding: 3px 24px 3px 10px !important;
    outline: none !important;
  }
  .dataTables_wrapper .dataTables_filter input {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    color: var(--ibk-input-text) !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    margin-left: 8px !important;
    outline: none !important;
    height: 36px !important;
  }
  .dataTables_wrapper .dataTables_filter input:focus,
  .dataTables_wrapper .dataTables_length select:focus {
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    border: 1px solid transparent !important;
    padding: 4px 10px !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #EA580C !important;
    border-color: #EA580C !important;
    color: #FFFFFF !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
    border-color: var(--ibk-border) !important;
  }

  /* Modal */
  .modal-content {
    background-color: var(--ibk-modal-bg) !important;
    border: 1px solid var(--ibk-modal-border) !important;
    color: var(--ibk-text) !important;
    border-radius: 12px !important;
  }
  .btn-form-cancel {
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 8px 18px !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 150ms ease;
  }
  .btn-form-cancel:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
  }
</style>
@endsection

@extends('layout.template')

@section('content')
<!-- Delete Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="spb_delete_id" id="spb_id">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; border-radius: 50%; background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border);">
          <i class="ri-delete-bin-line fs-24 text-danger"></i>
        </div>
        <h5 class="fw-bold mb-2" style="color: var(--ibk-text);">Hapus Surat Pengantar Barang (SPB)?</h5>
        <p class="fs-13 mb-4" style="color: var(--ibk-text-muted);">
          Apakah Anda yakin ingin menghapus data SPB ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn-form-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16"></i>
            <span>Batal</span>
          </button>
          <form id="deleteForm" action="{{ url('delete-spb') }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="border-radius: 8px;">
              <i class="ri-delete-bin-line fs-16"></i>
              <span>Ya, Hapus</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-content">
  <div class="container-fluid">
    <div class="surat-page-wrapper">

      <!-- 1. Header & Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-truck-line"></i>
            <span>Daftar SPB (Surat Pengantar Barang)</span>
          </h1>
          <div class="ibk-page-subtitle">Kelola pengiriman barang fisik, status antar, dan cetak surat pengantar resmi</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          <a href="{{ url('tambah-spb') }}" class="ibk-btn-primary" aria-label="Tambah SPB Baru">
            <i class="ri-add-line fs-16" aria-hidden="true"></i>
            <span>Tambah SPB</span>
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

      <!-- 2. Summary KPI Cards -->
      <div class="row g-3 mb-4">
        <!-- KPI 1: Total SPB Dibuat -->
        <div class="col-xl-4 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">Total SPB Dibuat</div>
              <h4 class="kpi-amount num" aria-label="Total SPB: {{ $jumlahspb }}">
                <span class="counter-value" data-target="{{ $jumlahspb }}">{{ $jumlahspb }}</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-amber" aria-hidden="true">
              <i class="ri-file-list-3-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 2: SPB Telah Diantar -->
        <div class="col-xl-4 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">SPB Telah Diantar</div>
              <h4 class="kpi-amount num" style="color: var(--ibk-success);" aria-label="SPB Telah Diantar: {{ $jumlahSelesai }}">
                <span class="counter-value" data-target="{{ $jumlahSelesai }}">{{ $jumlahSelesai }}</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="ri-checkbox-circle-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 3: SPB Belum Diantar -->
        <div class="col-xl-4 col-md-6">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">SPB Belum Diantar</div>
              <h4 class="kpi-amount num" style="color: {{ $jumlahBelumSelesai > 0 ? 'var(--ibk-danger)' : 'var(--ibk-text-muted)' }};" aria-label="SPB Belum Diantar: {{ $jumlahBelumSelesai }}">
                <span class="counter-value" data-target="{{ $jumlahBelumSelesai }}">{{ $jumlahBelumSelesai }}</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="ri-time-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Table Section -->
      <div class="ibk-card">
        <div class="ibk-card-header">
          <div class="ibk-card-title">
            <i class="ri-history-line"></i>
            <span>Riwayat Surat Pengantar Barang (SPB)</span>
          </div>
          <span class="badge-count-pill">{{ count($spb) }} Transaksi</span>
        </div>

        <div class="table-responsive">
          <table class="table align-middle mb-0 tokabe-table" id="alternative-pagination" aria-label="Tabel Riwayat SPB">
            <thead>
              <tr>
                <th scope="col" class="text-center" style="width: 50px;">NO.</th>
                <th scope="col">PENGANTAR BARANG</th>
                <th scope="col" class="text-center">TANGGAL ANTAR</th>
                <th scope="col" style="min-width: 170px;">CUSTOMER</th>
                <th scope="col" style="min-width: 190px;">PERUSAHAAN</th>
                <th scope="col">NO. TELEPON</th>
                <th scope="col" class="text-center">STATUS</th>
                <th scope="col" class="text-center" style="width: 70px;">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($spb as $value)
                <tr>
                  <td class="text-center num text-muted" style="font-size: 13px;">{{ $loop->iteration }}</td>
                  <td>
                    <span class="badge-perusahaan-spb">
                      @if($value->nama_spb == 1)
                        Ikhtiar Berkah
                      @else
                        Total Karya Berkah
                      @endif
                    </span>
                  </td>
                  <td class="text-center text-muted num" style="font-size: 12.5px;">
                    {{ $value->created_at->isoFormat('DD MMMM YYYY') }}
                  </td>
                  <td>
                    <span class="fw-bold" style="color: var(--ibk-text);">{{ $value->customer }}</span>
                  </td>
                  <td>
                    <span class="text-muted" style="font-size: 13px;">{{ $value->perusahaan }}</span>
                  </td>
                  <td>
                    <span class="num text-muted" style="font-size: 12.5px;">{{ $value->nomor_telepon ?: '-' }}</span>
                  </td>
                  <td class="text-center">
                    @if ($value->status == "Belum diantar")
                      <span class="badge-status-undelivered">
                        <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                        <span>Belum Diantar</span>
                      </span>
                    @else
                      <span class="badge-status-delivered">
                        <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                        <span>Sudah Diantar</span>
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi SPB ID {{ $value->id }}">
                        <i class="ri-more-fill fs-16" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        @if($value->status == "Belum diantar")
                          <li>
                            <a class="dropdown-item text-success" href="{{ route('spb.ubah-status', $value->id) }}">
                              <i class="ri-checkbox-circle-line fs-15 text-success" aria-hidden="true"></i>
                              <span>Tandai Sudah Diantar</span>
                            </a>
                          </li>
                        @endif
                        <li>
                          <a class="dropdown-item" target="_blank" href="{{ url('cetak-spb/'.$value->id) }}">
                            <i class="ri-printer-line fs-15 text-warning" aria-hidden="true"></i>
                            <span>Cetak SPB</span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ url('edit-spb/'.$value->id) }}">
                            <i class="ri-edit-line fs-15 text-warning" aria-hidden="true"></i>
                            <span>Edit SPB</span>
                          </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" value="{{ $value->id }}" data-url="{{ url('delete-spb/'.$value->id) }}" class="dropdown-item dropdown-item--danger hapus-btn">
                            <i class="ri-delete-bin-line fs-15 text-danger" aria-hidden="true"></i>
                            <span>Hapus SPB</span>
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
      </div>

    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/spb.js') }}"></script>
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

  $(document).ready(function() {
    initPageTheme();
  });
</script>
@endsection
'''

with open('resources/views/pages/SPB/daftar-spb.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated resources/views/pages/SPB/daftar-spb.blade.php")

