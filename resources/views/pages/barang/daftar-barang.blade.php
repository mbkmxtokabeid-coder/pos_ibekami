@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
  /* ==========================================================================
     DESIGN SYSTEM TOKENS & OVERRIDES (DESIGN.md)
     Dark Slate Palette (#020617, #0F172A, #161B22, #1E293B, #334155)
     ========================================================================== */

  /* Tabular Nums & Typography (§5.1 & §23) */
  .num, .price, .numeric, td.numeric, th.numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  /* Page Header Title & Breadcrumb */
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

  /* Primary Action Button (§9) */
  .btn-add-barang {
    background-color: #4F46E5 !important;
    border-color: #4F46E5 !important;
    color: #FFFFFF !important;
    font-weight: 500;
    font-size: 13.5px;
    border-radius: 8px;
    padding: 8px 18px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    cursor: pointer;
  }
  .btn-add-barang:hover {
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
    color: #FFFFFF !important;
  }
  .btn-add-barang:active {
    transform: scale(0.98);
  }

  /* Section Container Card (§12.1) */
  .tokabe-section-card {
    background: #161B22 !important;
    border: 1px solid #1E293B !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    margin-bottom: 20px;
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

  /* Segmented Category Filter Pills (§9.6 & §16.3) */
  .category-filter-nav {
    display: inline-flex;
    align-items: center;
    background: #0F172A;
    border: 1px solid #1E293B;
    border-radius: 10px;
    padding: 4px;
    gap: 4px;
    flex-wrap: wrap;
  }
  .category-filter-nav .tombol {
    background: transparent !important;
    border: 1px solid transparent !important;
    color: #94A3B8 !important;
    padding: 6px 14px !important;
    border-radius: 7px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
    outline: none !important;
  }
  .category-filter-nav .tombol:hover {
    color: #F1F5F9 !important;
    background: #1E293B !important;
  }
  .category-filter-nav .tombol.btn-info {
    background: #1E293B !important;
    color: #38BDF8 !important;
    border: 1px solid #334155 !important;
    font-weight: 600 !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4) !important;
  }
  .category-filter-nav .tombol.btn-soft-info {
    background: transparent !important;
    color: #94A3B8 !important;
    border: 1px solid transparent !important;
  }

  /* KPI / Metric Cards (§12.4 & §4.3) */
  .tokabe-kpi-card {
    background: #0F172A !important;
    border: 1px solid #1E293B !important;
    border-radius: 12px !important;
    position: relative;
    overflow: hidden;
    padding: 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 140px;
  }
  .tokabe-kpi-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    opacity: 0.95;
  }
  .tokabe-kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.4);
    border-color: #334155 !important;
  }
  .kpi-accent-penjualan::before {
    background: linear-gradient(90deg, #6366F1, #38BDF8);
  }
  .kpi-accent-profit::before {
    background: linear-gradient(90deg, #10B981, #059669);
  }

  .kpi-label {
    font-size: 11.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #94A3B8;
    margin-bottom: 6px;
    line-height: 1.3;
  }
  .kpi-value-container {
    display: flex;
    align-items: baseline;
    gap: 4px;
    margin-bottom: 12px;
  }
  .kpi-value {
    font-size: 26px;
    font-weight: 700;
    color: #F1F5F9;
    line-height: 1.2;
    letter-spacing: -0.02em;
    font-variant-numeric: tabular-nums;
  }
  .kpi-value.text-emerald {
    color: #34D399 !important;
  }
  .kpi-unit {
    font-size: 16px;
    font-weight: 600;
    color: #64748B;
  }

  /* Tonal Icon Containers (42px) */
  .kpi-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 22px;
  }
  .icon-box-indigo {
    background-color: rgba(99, 102, 241, 0.12);
    color: #818CF8;
    border: 1px solid rgba(99, 102, 241, 0.25);
  }
  .icon-box-emerald {
    background-color: rgba(16, 185, 129, 0.12);
    color: #34D399;
    border: 1px solid rgba(16, 185, 129, 0.25);
  }

  /* Count Pill Badge (§14.1) */
  .tokabe-count-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
    font-variant-numeric: tabular-nums;
  }
  .pill-indigo {
    background-color: rgba(99, 102, 241, 0.12);
    color: #818CF8;
    border: 1px solid rgba(99, 102, 241, 0.25);
  }
  .pill-emerald {
    background-color: rgba(16, 185, 129, 0.12);
    color: #34D399;
    border: 1px solid rgba(16, 185, 129, 0.25);
  }

  /* Table Reset & Styling (§13) */
  .tokabe-table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
    margin-bottom: 0 !important;
    border: none !important;
  }
  .tokabe-table thead th {
    background: #1E293B !important;
    color: #94A3B8 !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    letter-spacing: 0.08em !important;
    text-transform: uppercase !important;
    padding: 12px 16px !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    border-bottom: 1px solid #334155 !important;
    white-space: nowrap;
  }
  .tokabe-table tbody tr {
    background-color: transparent !important;
    transition: background-color 0.15s ease;
  }
  .tokabe-table tbody tr:hover {
    background-color: rgba(30, 41, 59, 0.65) !important;
  }
  .tokabe-table tbody td {
    padding: 13px 16px !important;
    color: #CBD5E1 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    border-bottom: 1px solid #1E293B !important;
    font-size: 13px !important;
    vertical-align: middle !important;
  }

  /* Kode Barang Badge (Mono) */
  .badge-kode-barang {
    font-family: var(--font-mono, monospace);
    font-size: 12px;
    font-weight: 600;
    color: #38BDF8;
    background: rgba(56, 189, 248, 0.1);
    border: 1px solid rgba(56, 189, 248, 0.25);
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
    letter-spacing: 0.03em;
  }

  /* Kategori Item Pill */
  .badge-kategori-pill {
    background-color: rgba(148, 163, 184, 0.12);
    color: #CBD5E1;
    border: 1px solid rgba(148, 163, 184, 0.25);
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 500;
    display: inline-block;
  }

  /* Stok Badges (§14.1) */
  .badge-stock-zero {
    color: #F87171;
    background-color: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.25);
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 600;
  }
  .badge-stock-low {
    color: #FCD34D;
    background-color: rgba(245, 158, 11, 0.12);
    border: 1px solid rgba(245, 158, 11, 0.25);
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 600;
  }

  /* Material Switch Toggle */
  .toggle-material-switch {
    background-color: #334155 !important;
    border-color: #475569 !important;
    cursor: pointer !important;
    width: 38px !important;
    height: 20px !important;
    transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease !important;
  }
  .toggle-material-switch:checked {
    background-color: #10B981 !important;
    border-color: #10B981 !important;
    box-shadow: 0 0 10px rgba(16, 185, 129, 0.35) !important;
  }
  .toggle-material-switch:focus {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25) !important;
  }

  /* Action Ghost Button & Dropdown (§9.2 & §11) */
  .btn-action-ghost {
    background: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #94A3B8 !important;
    border-radius: 6px !important;
    padding: 4px 9px !important;
    transition: all 0.15s ease;
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

  /* DataTables Elements Styling */
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter {
    color: #94A3B8 !important;
    font-size: 13px !important;
    padding: 14px 16px !important;
  }
  .dataTables_wrapper .dataTables_length select {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 6px !important;
    padding: 4px 10px !important;
    outline: none !important;
  }
  .dataTables_wrapper .dataTables_filter input {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    margin-left: 8px !important;
    outline: none !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .dataTables_wrapper .dataTables_filter input:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
  }
  .dataTables_wrapper .dataTables_info {
    color: #64748B !important;
    font-size: 12.5px !important;
    padding: 14px 16px !important;
  }
  .dataTables_wrapper .dataTables_paginate {
    padding: 12px 16px !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #94A3B8 !important;
    border-radius: 6px !important;
    margin: 0 3px !important;
    padding: 4px 10px !important;
    font-size: 12px !important;
    transition: all 0.15s ease;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #334155 !important;
    color: #F1F5F9 !important;
    border-color: #475569 !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background-color: #4F46E5 !important;
    border-color: #4F46E5 !important;
    color: #FFFFFF !important;
    box-shadow: 0 1px 3px rgba(79, 70, 229, 0.4);
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    opacity: 0.4 !important;
    cursor: not-allowed !important;
    background-color: #0F172A !important;
  }

  /* Ensure Modals are strictly in front of any backdrop and clickable */
  .modal {
    z-index: 1065 !important;
  }
  .modal-backdrop {
    z-index: 1055 !important;
  }
  .modal-dialog {
    z-index: 1070 !important;
    position: relative;
  }
  .modal-content {
    pointer-events: auto !important;
  }

  /* Modals Common Dark Styling (§15.3) */
  .modal-content.tokabe-modal-dark {
    background-color: #161B22 !important;
    border: 1px solid #1E293B !important;
    border-radius: 16px !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
    overflow: hidden;
  }
  .tokabe-modal-header {
    border-bottom: 1px solid #1E293B !important;
    padding: 18px 24px !important;
    background-color: transparent !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .tokabe-modal-body {
    padding: 22px 24px !important;
  }
  .tokabe-modal-footer {
    border-top: 1px solid #1E293B !important;
    padding: 16px 24px !important;
    background-color: rgba(15, 23, 42, 0.5) !important;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
  }

  /* Modal Form Controls (§10.1 & §10.2) */
  .modal-section-title {
    font-size: 11.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #818CF8;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .modal-section-title::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #1E293B;
  }
  .form-label-modern {
    font-size: 12.5px;
    font-weight: 500;
    color: #CBD5E1;
    margin-bottom: 6px;
    display: block;
  }
  .form-label-modern .required-star {
    color: #EF4444;
    margin-left: 2px;
  }
  .form-control-modern,
  .form-select-modern {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 8px !important;
    height: 40px !important;
    font-size: 13.5px !important;
    padding: 8px 12px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .form-control-modern::placeholder {
    color: #64748B !important;
  }
  .form-control-modern:hover:not(:disabled),
  .form-select-modern:hover:not(:disabled) {
    border-color: #475569 !important;
  }
  .form-control-modern:focus,
  .form-select-modern:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    outline: none !important;
  }
  .form-control-modern:disabled,
  .form-control-modern[readonly] {
    background-color: rgba(30, 41, 59, 0.45) !important;
    color: #94A3B8 !important;
    border-color: #1E293B !important;
    cursor: default;
  }

  /* Input Group Addons */
  .input-group-addon-modern {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #94A3B8 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 0 12px !important;
    display: flex;
    align-items: center;
  }
  .input-group .form-control-modern {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
  }
  .input-group .input-group-addon-modern:first-child {
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
    border-right: none !important;
  }
  .input-group .input-group-addon-modern:last-child {
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    border-left: none !important;
  }
  .form-help-text {
    font-size: 11.5px;
    color: #64748B;
    margin-top: 4px;
    margin-bottom: 0;
  }

  /* Modal Action Buttons (§9) */
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

  /* Modal Delete Specific */
  .modal-danger-icon-box {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background-color: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.25);
    color: #EF4444;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 16px;
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

{{-- MODAL POPUP: TAMBAH BARANG (§15.3 & §10) --}}
<div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="tambahBarangModalLabel">
            <i class="las la-box-open fs-20 text-info"></i>
            <span>Tambah Barang Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Isi data barang baru untuk katalog penjualan kasir dan inventori stok.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" id="formTambahBarangModal">
        @csrf
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Dasar -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Informasi Dasar Produk</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kategori / Item -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-kategori">
                Kategori Item <span class="required-star">*</span>
              </label>
              <select name="kategori_id" id="modal-kategori" class="form-select form-select-modern" required>
                <option value="">Pilih Kategori</option>
                @foreach (($allKategori ?? $kategoriBrg) as $category)
                  <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                @endforeach
              </select>
              <p class="form-help-text">Kategori produk utama</p>
            </div>

            <!-- Kode Barang -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-kode-barang">
                Kode Barang <span class="required-star">*</span>
              </label>
              <input type="text" name="kode_barang" id="modal-kode-barang" class="form-control form-control-modern" placeholder="Misal: BRG-STM-01" required>
              <p class="form-help-text">Kode unik SKU produk</p>
            </div>

            <!-- Jenis / Nama Barang -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-jenis-barang">
                Jenis / Nama Barang <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis_barang" id="modal-jenis-barang" class="form-control form-control-modern" placeholder="Misal: Stempel Flash 43x55" required>
              <p class="form-help-text">Nama barang di invoice</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Skema Harga -->
          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Stok & Skema Harga</span>
          </div>

          <div class="row g-3">
            <!-- Stok Awal -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-stok">
                Stok Awal <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-stok" required>
                <span class="input-group-addon-modern">Pcs</span>
              </div>
              <p class="form-help-text">Jumlah fisik awal di gudang</p>
            </div>

            <!-- Harga Modal -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-harga-modal">
                Harga Modal (HPP) <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-harga-modal" required>
              </div>
              <p class="form-help-text">Harga pokok dari vendor</p>
            </div>

            <!-- Harga Jual -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-harga-jual">
                Harga Jual <span class="required-star">*</span>
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
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit">
            <i class="las la-plus-circle fs-16"></i>
            <span>Simpan Barang</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT / UPDATE BARANG (§15.3 & §10) --}}
<div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="editBarangModalLabel">
            <i class="las la-pen-nib fs-20 text-warning"></i>
            <span>Update Stok Barang</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Perbarui kuantitas stok barang, varian jenis, atau penyesuaian harga jual dan modal.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data" id="formEditBarangModal">
        @csrf
        @method('put')
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Dasar -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Identitas Produk</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kategori Item (Readonly) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-kategori">
                Kategori Item
              </label>
              <input type="text" id="edit-barang-kategori" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kategori produk telah ditetapkan</p>
            </div>

            <!-- Kode Barang (Readonly) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-kode">
                Kode Barang (SKU)
              </label>
              <input type="text" id="edit-barang-kode" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kode unik SKU barang di inventori</p>
            </div>

            <!-- Jenis Barang -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-jenis">
                Jenis / Nama Barang <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis" id="edit-barang-jenis" class="form-control form-control-modern" placeholder="Jenis Barang" required>
              <p class="form-help-text">Nama atau varian barang yang tertera pada nota</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Skema Harga -->
          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Kuantitas Stok & Harga</span>
          </div>

          <div class="row g-3">
            <!-- Stok Barang -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-stok">
                Stok Tersedia <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-barang-stok" required>
                <span class="input-group-addon-modern">Pcs</span>
              </div>
              <p class="form-help-text">Jumlah fisik stok terkini di toko/gudang</p>
            </div>

            <!-- Harga Modal (HPP) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-modal">
                Harga Modal (HPP) <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-barang-modal" required>
              </div>
              <p class="form-help-text">Harga pokok pembelian dari vendor</p>
            </div>

            <!-- Harga Jual -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-barang-jual">
                Harga Jual <span class="required-star">*</span>
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
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit" style="background-color: #D97706 !important; border-color: #D97706 !important;">
            <i class="las la-save fs-16"></i>
            <span>Update Barang</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Konfirmasi Hapus Data (§15.3) --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="barang_delete_id" id="barang_id">
        <div class="modal-danger-icon-box">
          <i class="las la-trash-alt"></i>
        </div>
        <h4 class="mb-2 text-white fw-bold" id="deleteModalLabel">Hapus Data Barang?</h4>
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

<div class="page-content">
  <div class="container-fluid">

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Barang</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Barang</a></li>
              <li class="breadcrumb-item active">Daftar Barang</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row (§9.1): POPUP TRIGGER BUTTON -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <button type="button" class="btn btn-add-barang" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
            <i class="las la-plus fs-16"></i>
            <span>Tambah Barang</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Potensi Penjualan & Profit Section (§12.4) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="las la-chart-line fs-18 text-info"></i>
              <span>Potensi Penjualan dan Profit</span>
            </div>
            <!-- Segmented Category Filters (§9.6) -->
            <div class="category-filter-nav">
              @foreach ($kategoriBrg as $kat)
                <button type="button" class="tombol" onclick="brg({{ $kat->id }})" id="btn_{{ $kat->id }}">
                  {{ $kat->nama_kategori }}
                </button>
              @endforeach
            </div>
          </div>

          <!-- KPI Metric Cards Grid -->
          <div class="p-3">
            <div class="row g-3">
              <!-- KPI 1: Potensi Penjualan -->
              <div class="col-md-6">
                <div class="tokabe-kpi-card kpi-accent-penjualan">
                  <div class="d-flex align-items-start justify-content-between">
                    <div>
                      <div class="kpi-label" id="potensi_penjualan">
                        Jumlah Potensi Penjualan
                      </div>
                      <div class="kpi-value-container">
                        <span class="kpi-value">Rp <span class="counter-value penjualan num" data-target="0">0</span></span>
                        <span class="kpi-unit">M</span>
                      </div>
                    </div>
                    <div class="kpi-icon-box icon-box-indigo">
                      <i class="las la-donate"></i>
                    </div>
                  </div>
                  <div class="mt-2">
                    <span class="tokabe-count-pill pill-indigo">
                      <i class="las la-boxes fs-14"></i>
                      <span><span class="stok num">0</span> Barang</span>
                    </span>
                  </div>
                </div>
              </div>

              <!-- KPI 2: Potensi Profit -->
              <div class="col-md-6">
                <div class="tokabe-kpi-card kpi-accent-profit">
                  <div class="d-flex align-items-start justify-content-between">
                    <div>
                      <div class="kpi-label" id="potensi_profit">
                        Jumlah Potensi Profit
                      </div>
                      <div class="kpi-value-container">
                        <span class="kpi-value text-emerald">Rp <span class="counter-value profit num" data-target="0">0</span></span>
                        <span class="kpi-unit">M</span>
                      </div>
                    </div>
                    <div class="kpi-icon-box icon-box-emerald">
                      <i class="las la-funnel-dollar"></i>
                    </div>
                  </div>
                  <div class="mt-2">
                    <span class="tokabe-count-pill pill-emerald">
                      <i class="las la-boxes fs-14"></i>
                      <span><span class="stok num">0</span> Barang</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section: Daftar Stok Barang (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="las la-warehouse fs-18 text-warning"></i>
              <span>Daftar Stok Barang</span>
            </div>
            <div class="text-muted fs-12">
              Total: <span class="fw-semibold text-white num">{{ count($barang) }}</span> item terdaftar
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table id="alternative-pagination" class="table nowrap dt-responsive align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">No.</th>
                    <th>Item</th>
                    <th>Kode Barang</th>
                    <th>Jenis Barang</th>
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
                        <span class="fw-semibold text-white" style="font-size: 13.5px;">{{ $brg->jenis_barang }}</span>
                      </td>
                      <td class="text-muted" style="font-size: 12px;">
                        {{ date('d M Y, H:i', strtotime($brg->updated_at)) }}
                      </td>
                      <td class="text-end num">
                        @if($brg->stok <= 0)
                          <span class="badge-stock-zero">0</span>
                        @elseif($brg->stok < 5)
                          <span class="badge-stock-low">{{ $brg->stok }}</span>
                        @else
                          <span class="fw-bold text-white">{{ $brg->stok }}</span>
                        @endif
                      </td>
                      <td class="text-end num price text-muted">
                        Rp {{ $brg->formattedModal }}
                      </td>
                      <td class="text-end num price fw-bold text-white">
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
                          <ul class="dropdown-menu dropdown-menu-end">
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
                                <i class="las la-pen fs-16 text-warning"></i>
                                <span>Update Stock</span>
                              </button>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <button type="button" class="dropdown-item dropdown-item--danger hapus-btn remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $brg->id }}">
                                <i class="las la-trash-alt fs-16 text-danger"></i>
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
          </div>
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
  // Pindahkan modal langsung ke elemen <body> agar tidak terperangkap dalam stacking context .main-content
  $(document).ready(function() {
      $('#tambahBarangModal').appendTo('body');
      $('#editBarangModal').appendTo('body');
      $('#deleteModal').appendTo('body');
  });

  // Inisialisasi Cleave.js mask pada input modal tambah
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

  // Reset form saat modal tambah ditutup
  $('#tambahBarangModal').on('hidden.bs.modal', function () {
      $('#formTambahBarangModal')[0].reset();
      if (modalCleaveStok) modalCleaveStok.setRawValue('0');
      if (modalCleaveModal) modalCleaveModal.setRawValue('0');
      if (modalCleaveJual) modalCleaveJual.setRawValue('0');
  });

  // Inisialisasi Cleave.js mask pada input modal update
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

  // Event handler untuk tombol Edit/Update Barang (delegated untuk DataTables pagination)
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
          error: function(xhr, status, error) {
              var errorMsg = 'Gagal memperbarui status material';
              if (xhr.responseJSON && xhr.responseJSON.message) {
                  errorMsg += ': ' + xhr.responseJSON.message;
              } else if (xhr.status === 404) {
                  errorMsg += ' (URL route tidak ditemukan - 404)';
              } else if (xhr.status === 419) {
                  errorMsg += ' (Sesi telah kedaluwarsa, silakan refresh halaman - 419)';
              } else if (xhr.status === 500) {
                  errorMsg += ' (Terjadi kesalahan server - 500)';
              }
              alert(errorMsg);
              $switch.prop('checked', !isRequired);
          }
      });
  });
</script>
@endsection