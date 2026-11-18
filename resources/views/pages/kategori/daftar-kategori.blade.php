@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

  <style>
    /* ==========================================================================
       TOKABE KATEGORI INVOICE — WARM STONE DUAL-THEME SYSTEM
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
      --ibk-brand-text: #FDBA74;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.14);
      --ibk-success-border: rgba(16, 185, 129, 0.28);

      --ibk-warning: #F59E0B;
      --ibk-warning-soft: rgba(245, 158, 11, 0.14);
      --ibk-warning-border: rgba(245, 158, 11, 0.3);
      --ibk-warning-text: #FCD34D;

      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.14);
      --ibk-danger-border: rgba(239, 68, 68, 0.3);
      --ibk-danger-text: #FCA5A5;

      --ibk-input-bg: #1C1917;
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #F5F5F4;
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23A8A29E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #181412;
      --ibk-th-text: #A8A29E;
      --ibk-td-border: rgba(255, 255, 255, 0.06);

      --ibk-modal-bg: #181412;
      --ibk-modal-header-bg: #14110F;
      --ibk-modal-border: rgba(255, 255, 255, 0.08);
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
      --ibk-brand-text: #C2410C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;

      --ibk-warning: #D97706;
      --ibk-warning-soft: #FFFBEB;
      --ibk-warning-border: #FDE68A;
      --ibk-warning-text: #B45309;

      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;
      --ibk-danger-text: #B91C1C;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #D6D0C4;
      --ibk-input-text: #1C1917;
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2357534E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #57534E;
      --ibk-td-border: #EAE4DC;

      --ibk-modal-bg: #FFFFFF;
      --ibk-modal-header-bg: #FAF8F5;
      --ibk-modal-border: #E6E1D8;
    }

    .kategori-page-wrapper {
      position: relative;
      width: 100%;
      padding-bottom: 48px;
      font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
      color: var(--ibk-text);
    }

    /* Header Section */
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

    .ibk-btn-primary {
      background: var(--ibk-brand-btn-bg) !important;
      border: 1px solid var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      padding: 0 16px !important;
      height: 38px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer !important;
      transition: background-color 150ms ease, box-shadow 150ms ease !important;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
      text-decoration: none !important;
      white-space: nowrap;
    }
    .ibk-btn-primary:hover {
      background: var(--ibk-brand-hover) !important;
      border-color: var(--ibk-brand-hover) !important;
      color: #FFFFFF !important;
    }
    .ibk-btn-primary:focus-visible,
    .ref-theme-toggle:focus-visible,
    .btn-action-edit:focus-visible,
    .btn-action-delete:focus-visible,
    .btn-tokabe-modal-cancel:focus-visible {
      outline: 2px solid var(--ibk-brand) !important;
      outline-offset: 2px !important;
    }

    /* Main Card */
    .ibk-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      overflow: hidden;
    }
    .ibk-card-header {
      padding: 16px 20px;
      border-bottom: 1px solid var(--ibk-border);
      background: var(--ibk-surface);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .ibk-card-heading {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .ibk-card-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .ibk-card-title i {
      color: var(--ibk-brand);
      font-size: 18px;
    }
    .badge-count-pill {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      padding: 2px 10px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
      font-variant-numeric: tabular-nums;
    }

    /* Table Styling */
    .table-responsive {
      width: 100% !important;
      display: block !important;
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
      border-top: 1px solid var(--ibk-border) !important;
      border-bottom: 1px solid var(--ibk-border) !important;
      scrollbar-width: thin;
      scrollbar-color: var(--ibk-text-dim) transparent;
    }
    .table-responsive::-webkit-scrollbar {
      height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
      background: var(--ibk-surface);
    }
    .table-responsive::-webkit-scrollbar-thumb {
      background: rgba(120, 113, 108, 0.45);
      border-radius: 9999px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
      background: var(--ibk-brand);
    }

    #table-kategori {
      min-width: 720px !important;
      width: 100% !important;
      margin: 0 !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      background: transparent !important;
    }
    .tokabe-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text) !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      border-top: none !important;
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 11px 16px !important;
      vertical-align: middle !important;
      white-space: nowrap;
      height: 44px !important;
    }
    .tokabe-table tbody tr {
      height: 58px !important;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 10px 16px !important;
      font-size: 13px !important;
      vertical-align: middle !important;
      color: var(--ibk-text) !important;
      background-color: transparent !important;
    }
    .tokabe-table tbody tr:hover td {
      background-color: var(--ibk-surface-hover) !important;
    }

    /* Kode Invoice Pill */
    .badge-kode-inv {
      display: inline-flex;
      align-items: center;
      padding: 4px 10px;
      border-radius: 6px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand-text);
      font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.02em;
    }

    /* Action Buttons */
    .btn-action-edit {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: var(--ibk-warning-soft) !important;
      border: 1px solid var(--ibk-warning-border) !important;
      color: var(--ibk-warning-text) !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
      cursor: pointer;
    }
    .btn-action-edit:hover {
      background: #D97706 !important;
      color: #FFFFFF !important;
      border-color: #D97706 !important;
    }

    .btn-action-delete {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: var(--ibk-danger-soft) !important;
      border: 1px solid var(--ibk-danger-border) !important;
      color: var(--ibk-danger-text) !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
      cursor: pointer;
    }
    .btn-action-delete:hover {
      background: #DC2626 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
    }

    /* DataTables Controls & Invoice-Standard Footer Pagination */
    .dataTables_wrapper {
      color: var(--ibk-text-muted) !important;
      padding: 0 !important;
      width: 100% !important;
    }
    .dataTables_wrapper > .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
    }
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      margin: 0 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 4px 28px 4px 10px !important;
      font-size: 13px !important;
      height: 36px !important;
      cursor: pointer;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 8px center !important;
      background-size: 12px 9px !important;
      -webkit-appearance: none !important;
      appearance: none !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 14px !important;
      margin-left: 0 !important;
      font-size: 13px !important;
      height: 36px !important;
      width: 240px !important;
      max-width: 100% !important;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      outline: none !important;
    }

    .ibk-table-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      padding: 16px 24px;
      background: var(--ibk-surface);
    }
    #tokabeCustomInfo,
    #tokabeCustomInfo .dataTables_info {
      font-size: 13px !important;
      font-weight: 500 !important;
      color: var(--ibk-text-muted) !important;
      padding: 0 !important;
      margin: 0 !important;
    }
    #tokabeCustomPaginate,
    #tokabeCustomPaginate .dataTables_paginate {
      display: flex !important;
      align-items: center !important;
      justify-content: flex-end !important;
      margin: 0 !important;
      padding: 0 !important;
    }
    #tokabeCustomPaginate ul.pagination,
    .dataTables_paginate ul.pagination {
      display: inline-flex !important;
      align-items: center !important;
      gap: 4px !important;
      margin: 0 !important;
      padding: 4px !important;
      background: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      border-radius: 12px !important;
      box-shadow: var(--ibk-card-shadow) !important;
    }
    .dataTables_paginate ul.pagination li.page-item .page-link {
      min-width: 34px !important;
      height: 34px !important;
      padding: 0 10px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      border-radius: 8px !important;
      border: 1px solid transparent !important;
      background: transparent !important;
      color: var(--ibk-text-muted) !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      font-variant-numeric: tabular-nums;
      box-shadow: none !important;
      transition: all 0.15s ease !important;
    }
    .dataTables_paginate ul.pagination li.page-item:not(.active):not(.disabled) .page-link:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-border) !important;
    }
    .dataTables_paginate ul.pagination li.page-item.active .page-link {
      background: var(--ibk-brand-btn-bg, #EA580C) !important;
      border-color: var(--ibk-brand-btn-bg, #EA580C) !important;
      color: var(--ibk-brand-btn-text, #FFFFFF) !important;
      font-weight: 600 !important;
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.28) !important;
    }
    .dataTables_paginate ul.pagination li.page-item.disabled .page-link {
      opacity: 0.4 !important;
      background: transparent !important;
      border-color: transparent !important;
      color: var(--ibk-text-dim) !important;
      cursor: not-allowed !important;
    }

    /* Dual-Theme Modal Styles */
    .modal-content.tokabe-modal {
      background-color: var(--ibk-modal-bg) !important;
      border: 1px solid var(--ibk-modal-border) !important;
      border-radius: 14px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45) !important;
      overflow: hidden;
      color: var(--ibk-text);
    }
    .tokabe-modal-header {
      border-bottom: 1px solid var(--ibk-modal-border) !important;
      padding: 16px 22px !important;
      background-color: var(--ibk-modal-header-bg) !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-icon {
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
    .tokabe-modal-title {
      font-size: 15.5px;
      font-weight: 700;
      color: var(--ibk-text);
      margin: 0;
    }
    .tokabe-modal-subtitle {
      font-size: 12px;
      color: var(--ibk-text-muted);
    }
    html:not(.theme-light) .tokabe-modal .btn-close {
      filter: invert(1) grayscale(100%) brightness(200%);
    }
    .tokabe-modal-body {
      padding: 20px 22px !important;
      background-color: var(--ibk-modal-bg) !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid var(--ibk-modal-border) !important;
      padding: 14px 22px !important;
      background-color: var(--ibk-modal-header-bg) !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }
    .tokabe-label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: var(--ibk-text) !important;
      margin-bottom: 6px !important;
      display: block;
    }
    .tokabe-label .required-star {
      color: var(--ibk-danger);
    }
    .form-control-tokabe,
    .form-select-tokabe {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 8px 12px !important;
      font-size: 13.5px !important;
      height: 40px !important;
      width: 100%;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .form-select-tokabe {
      padding-right: 32px !important;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 10px center !important;
      background-size: 14px 10px !important;
    }
    .form-control-tokabe:focus,
    .form-select-tokabe:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      color: var(--ibk-text) !important;
      outline: none !important;
    }
    .form-control-tokabe::placeholder {
      color: var(--ibk-text-dim) !important;
    }
    .tokabe-helper-text {
      font-size: 12px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
      display: block;
    }
    .btn-tokabe-modal-cancel {
      background-color: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 38px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer;
      transition: background-color 150ms ease, color 150ms ease !important;
    }
    .btn-tokabe-modal-cancel:hover {
      background-color: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
    }
  </style>
@endsection

@extends('layout.template')

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="kategori-page-wrapper">

      <!-- 1. Header & Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-grid-line" aria-hidden="true"></i>
            <span>Kategori Invoice</span>
          </h1>
          <div class="ibk-page-subtitle">Kelola daftar klasifikasi template invoice dan aturan prefix penomoran</div>
        </div>
        <div class="ibk-header-actions">
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon" aria-hidden="true"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          <button type="button" class="ibk-btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
            <i class="ri-add-line fs-16" aria-hidden="true"></i>
            <span>Tambah Kategori</span>
          </button>
        </div>
      </div>

      <!-- Feedback Alerts -->
      @foreach (['success', 'update', 'delete'] as $flashKey)
        @if(session()->has($flashKey))
          <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: var(--ibk-success-soft); border: 1px solid var(--ibk-success-border); color: var(--ibk-success); border-radius: 10px;">
            <i class="ri-checkbox-circle-fill fs-18" aria-hidden="true"></i>
            <div class="flex-grow-1 fs-13 fw-medium">{{ session($flashKey) }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        @endif
      @endforeach

      <!-- 2. Main Section Card -->
      <div class="ibk-card">
        <div class="ibk-card-header">
          <div class="ibk-card-heading">
            <h2 class="ibk-card-title">
              <i class="ri-price-tag-3-line" aria-hidden="true"></i>
              <span>Daftar Kategori</span>
            </h2>
            <span class="badge-count-pill">{{ count($invoices) }} Kategori</span>
          </div>
        </div>

        <div class="card-body p-0">
          <table id="table-kategori" class="table align-middle tokabe-table w-100">
            <thead>
              <tr>
                <th class="text-center" style="width: 60px;">No.</th>
                <th>Nama Invoice</th>
                <th>Kode Invoice</th>
                <th>Perusahaan</th>
                <th class="text-center" style="width: 110px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoices as $invoice)
                <tr>
                  <td class="text-center" style="color: var(--ibk-text-muted); font-variant-numeric: tabular-nums; font-weight: 500;">{{ $loop->iteration }}</td>
                  <td>
                    <span class="fw-semibold" style="color: var(--ibk-text);">{{ $invoice->nama_invoice }}</span>
                  </td>
                  <td>
                    <span class="badge-kode-inv">{{ $invoice->kode_invoice }}</span>
                  </td>
                  <td>
                    <span class="fw-medium" style="color: var(--ibk-text-muted);">{{ $invoice->nama_perusahaan }}</span>
                  </td>
                  <td class="text-center">
                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                      <button type="button" onclick="openEditKategoriModal({{ $invoice->id }}, '{{ addslashes($invoice->nama_invoice) }}', '{{ addslashes($invoice->kode_invoice) }}', {{ $invoice->perusahaan_id }}, '{{ $invoice->tipe_harga ?? 'dengan_harga' }}')" class="btn-action-edit" title="Edit Kategori {{ $invoice->nama_invoice }}" aria-label="Edit Kategori {{ $invoice->nama_invoice }}">
                        <i class="ri-pencil-line" aria-hidden="true"></i>
                      </button>

                      <form action="{{ route('destroy.kategori', ['id' => $invoice->id]) }}" method="POST" id="deleteForm{{ $invoice->id }}" class="m-0 p-0 d-inline">
                        @csrf
                        @method('delete')
                        <button type="button" onclick="showConfirmation('{{ addslashes($invoice->nama_invoice) }}', {{ $invoice->id }})" class="btn-action-delete" title="Hapus Kategori {{ $invoice->nama_invoice }}" aria-label="Hapus Kategori {{ $invoice->nama_invoice }}">
                          <i class="ri-delete-bin-6-line" aria-hidden="true"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Table Footer matching Invoice standard -->
          <div class="ibk-table-footer">
            <div id="tokabeCustomInfo"></div>
            <div id="tokabeCustomPaginate"></div>
          </div>
        </div>
      </div>

      <!-- MODAL POPUP: TAMBAH KATEGORI INVOICE -->
      <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content tokabe-modal">
            <div class="tokabe-modal-header">
              <div class="d-flex align-items-center gap-3">
                <div class="tokabe-modal-icon" aria-hidden="true">
                  <i class="ri-add-circle-line"></i>
                </div>
                <div>
                  <h5 class="tokabe-modal-title" id="modalTambahKategoriLabel">Tambah Kategori Invoice</h5>
                  <span class="tokabe-modal-subtitle">Lengkapi form kategori baru untuk format penomoran</span>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <form action="{{ route('store.kategori') }}" method="POST">
              @csrf
              <div class="tokabe-modal-body">
                <div class="mb-3">
                  <label class="tokabe-label" for="tambah_nama_invoice">
                    Nama Invoice <span class="required-star">*</span>
                  </label>
                  <input type="text" name="nama_invoice" id="tambah_nama_invoice" class="form-control form-control-tokabe" placeholder="Contoh: Ibekami Plakat, Tokabe Merchandise" value="{{ old('nama_invoice') }}" required>
                  @error('nama_invoice')
                    <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="tokabe-label" for="tambah_kode_invoice">
                    Kode Invoice (Prefix) <span class="required-star">*</span>
                  </label>
                  <input type="text" name="kode_invoice" id="tambah_kode_invoice" class="form-control form-control-tokabe" placeholder="Contoh: IBPL, TKB, IB" value="{{ old('kode_invoice') }}" required>
                  @error('kode_invoice')
                    <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                  @enderror
                  <span class="tokabe-helper-text">Kode ini digunakan sebagai format penomoran invoice (contoh: INV/IBPL/2026/001).</span>
                </div>

                <div class="mb-1">
                  <label class="tokabe-label" for="tambah_perusahaan_id">
                    Perusahaan <span class="required-star">*</span>
                  </label>
                  <select name="perusahaan_id" id="tambah_perusahaan_id" class="form-select form-select-tokabe" required>
                    @foreach ($perusahaans as $perusahaan)
                      <option value="{{ $perusahaan->id }}" {{ (old('perusahaan_id', $perusahaan->id) == $perusahaan->id) ? 'selected' : '' }}>
                        {{ $perusahaan->nama_perusahaan }}
                      </option>
                    @endforeach
                  </select>
                  @error('perusahaan_id')
                    <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="tokabe-modal-footer">
                <button type="button" class="btn-tokabe-modal-cancel" data-bs-dismiss="modal">
                  <i class="ri-close-line fs-16" aria-hidden="true"></i>
                  <span>Batal</span>
                </button>
                <button type="submit" class="ibk-btn-primary">
                  <i class="ri-save-3-line fs-16" aria-hidden="true"></i>
                  <span>Simpan Kategori</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- MODAL POPUP: EDIT KATEGORI INVOICE -->
      <div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content tokabe-modal">
            <div class="tokabe-modal-header">
              <div class="d-flex align-items-center gap-3">
                <div class="tokabe-modal-icon" aria-hidden="true">
                  <i class="ri-pencil-line"></i>
                </div>
                <div>
                  <h5 class="tokabe-modal-title" id="modalEditKategoriLabel">Edit Kategori Invoice</h5>
                  <span class="tokabe-modal-subtitle" id="editKategoriSubtitle">Perbarui informasi nama invoice dan kode prefix</span>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <form id="formEditKategori" action="" method="POST">
              @csrf
              @method('put')
              <div class="tokabe-modal-body">
                <div class="mb-3">
                  <label class="tokabe-label" for="edit_nama_invoice">
                    Nama Invoice <span class="required-star">*</span>
                  </label>
                  <input type="text" name="nama_invoice" id="edit_nama_invoice" class="form-control form-control-tokabe" placeholder="Nama Invoice" required>
                </div>

                <div class="mb-3">
                  <label class="tokabe-label" for="edit_kode_invoice">
                    Kode Invoice (Prefix) <span class="required-star">*</span>
                  </label>
                  <input type="text" name="kode_invoice" id="edit_kode_invoice" class="form-control form-control-tokabe" placeholder="Kode Invoice" required>
                </div>

                <div class="mb-1">
                  <label class="tokabe-label" for="edit_perusahaan_id">
                    Perusahaan <span class="required-star">*</span>
                  </label>
                  <select name="perusahaan_id" id="edit_perusahaan_id" class="form-select form-select-tokabe" required>
                    @foreach ($perusahaans as $perusahaan)
                      <option value="{{ $perusahaan->id }}">
                        {{ $perusahaan->nama_perusahaan }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="tokabe-modal-footer">
                <button type="button" class="btn-tokabe-modal-cancel" data-bs-dismiss="modal">
                  <i class="ri-close-line fs-16" aria-hidden="true"></i>
                  <span>Batal</span>
                </button>
                <button type="submit" class="ibk-btn-primary">
                  <i class="ri-save-3-line fs-16" aria-hidden="true"></i>
                  <span>Simpan Perubahan</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

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

  function openEditKategoriModal(id, nama, kode, perusahaanId, tipeHarga) {
    $('#formEditKategori').attr('action', '/invoice/edit-kategori/' + id);
    $('#edit_nama_invoice').val(nama);
    $('#edit_kode_invoice').val(kode);
    $('#edit_perusahaan_id').val(perusahaanId);
    $('#editKategoriSubtitle').text('ID Kategori #' + id + ' - ' + nama);
    $('#modalEditKategori').modal('show');
  }

  function showConfirmation(NamaInvoice, InvoiceID) {
    var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
    Swal.fire({
      title: 'Hapus Kategori?',
      text: 'Kategori "' + NamaInvoice + '" akan dihapus permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DC2626',
      cancelButtonColor: isLight ? '#64748B' : '#334155',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
      background: isLight ? '#FFFFFF' : '#181412',
      color: isLight ? '#1C1917' : '#F5F5F4'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deleteForm' + InvoiceID).submit();
      }
    });
  }

  $(document).ready(function () {
    initPageTheme();

    function syncCustomFooter(tableId) {
      var wrapper = $(tableId + '_wrapper');
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
      wrapper.children('.row:last-child').each(function () {
        if ($(this).find('.dataTables_info, .dataTables_paginate').length === 0) {
          $(this).hide();
        }
      });
    }

    if ($.fn.DataTable.isDataTable('#table-kategori')) {
      $('#table-kategori').DataTable().destroy();
    }
    $('#table-kategori').DataTable({
      paging: true,
      pageLength: 10,
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      ordering: true,
      order: [],
      autoWidth: false,
      scrollX: false,
      deferRender: true,
      orderClasses: false,
      dom: "<'row p-3 pb-2 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-md-end'f>>" +
           "<'table-responsive'tr>" +
           "<'row d-none'<'col-sm-6'i><'col-sm-6'p>>",
      drawCallback: function () {
        syncCustomFooter('#table-kategori');
      },
      language: {
        search: "",
        searchPlaceholder: "Cari nama / kode kategori...",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ kategori",
        infoEmpty: "Tidak ada data kategori",
        infoFiltered: "(disaring dari _MAX_ total kategori)",
        emptyTable: "Belum ada kategori invoice terdaftar.",
        zeroRecords: "Tidak ada kategori yang cocok dengan pencarian.",
        paginate: {
          first: '<i class="ri-skip-back-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>',
          next: '<i class="ri-arrow-right-s-line"></i>',
          last: '<i class="ri-skip-forward-line"></i>'
        }
      }
    });

    setTimeout(function () { syncCustomFooter('#table-kategori'); }, 50);
    setTimeout(function () { syncCustomFooter('#table-kategori'); }, 200);
  });
</script>
@endsection
