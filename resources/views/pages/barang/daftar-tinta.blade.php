@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
  /* ==========================================================================
     TOKABE DESIGN SYSTEM - DAFTAR TINTA
     Palette: Dark Slate (#020617, #0F172A, #161B22, #1E293B, #334155)
     Primary Accent: Indigo (#4F46E5)
     ========================================================================== */

  .num {
    font-variant-numeric: tabular-nums !important;
  }

  /* Page Header Title & Breadcrumb */
  .page-title-box h4 {
    font-size: 19px;
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

  /* Primary Action Button (Indigo) */
  .btn-add-tinta-primary {
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
  .btn-add-tinta-primary:hover {
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
    color: #FFFFFF !important;
  }

  /* Section Container Card */
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

  /* Count Pill Badges */
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
  .pill-rose {
    background-color: rgba(239, 68, 68, 0.12);
    color: #F87171;
    border: 1px solid rgba(239, 68, 68, 0.25);
  }

  /* Compact KPI Metric Cards */
  .tokabe-kpi-card {
    background: #0F172A !important;
    border: 1px solid #1E293B !important;
    border-radius: 12px !important;
    position: relative;
    overflow: hidden;
    padding: 18px 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
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
  .kpi-accent-sky::before { background: linear-gradient(90deg, #38BDF8, #0284C7); }
  .kpi-accent-emerald::before { background: linear-gradient(90deg, #10B981, #059669); }
  .kpi-accent-rose::before { background: linear-gradient(90deg, #EF4444, #DC2626); }

  .kpi-label {
    font-size: 11.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #94A3B8;
    margin-bottom: 4px;
    line-height: 1.3;
  }
  .kpi-value-container {
    display: flex;
    align-items: baseline;
    gap: 6px;
  }
  .kpi-value {
    font-size: 26px;
    font-weight: 700;
    color: #F1F5F9;
    line-height: 1.2;
    letter-spacing: -0.02em;
    font-variant-numeric: tabular-nums;
  }
  .kpi-unit {
    font-size: 14px;
    font-weight: 500;
    color: #64748B;
  }
  .kpi-icon-box {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
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
    background-color: rgba(239, 68, 68, 0.12);
    color: #F87171;
    border: 1px solid rgba(239, 68, 68, 0.25);
  }

  /* Table Reset & Styling (Tokabe Table) */
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
    padding: 14px 16px !important;
    color: #CBD5E1 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    border-bottom: 1px solid #1E293B !important;
    font-size: 13.5px !important;
    vertical-align: middle !important;
  }

  /* Badges */
  .badge-kode-barang {
    font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
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

  .badge-stock-zero {
    color: #F87171;
    background-color: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.25);
    padding: 3px 9px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
  }
  .badge-stock-low {
    color: #FCD34D;
    background-color: rgba(245, 158, 11, 0.12);
    border: 1px solid rgba(245, 158, 11, 0.25);
    padding: 3px 9px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
  }
  .badge-stock-safe {
    color: #34D399;
    background-color: rgba(16, 185, 129, 0.12);
    border: 1px solid rgba(16, 185, 129, 0.25);
    padding: 3px 9px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
  }

  /* Action Buttons */
  .btn-action-edit-sm {
    background: rgba(99, 102, 241, 0.1);
    color: #818CF8;
    border: 1px solid rgba(99, 102, 241, 0.25);
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 12.5px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.15s ease;
    cursor: pointer;
    text-decoration: none;
  }
  .btn-action-edit-sm:hover {
    background: #4F46E5;
    color: #FFFFFF;
    border-color: #4F46E5;
  }

  .btn-action-delete-sm {
    background: rgba(239, 68, 68, 0.1);
    color: #F87171;
    border: 1px solid rgba(239, 68, 68, 0.25);
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 12.5px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.15s ease;
    cursor: pointer;
  }
  .btn-action-delete-sm:hover {
    background: #DC2626;
    color: #FFFFFF;
    border-color: #DC2626;
  }

  /* DataTables Modern Styling */
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

  /* Modals Styling */
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
    justify-content: space-between;
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
  .form-control-modern {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 8px !important;
    height: 40px !important;
    font-size: 13.5px !important;
    padding: 8px 12px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .form-control-modern:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    outline: none !important;
  }
  .form-control-modern::placeholder {
    color: #64748B !important;
  }

  /* Seamless Input with Unit Addon (No blinding white) */
  .input-addon-dark {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #94A3B8 !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 0 12px !important;
    display: flex;
    align-items: center;
  }
  .input-group .form-control-modern {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
  }
  .input-group .input-addon-dark:last-child {
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

  .btn-modal-cancel {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    font-weight: 500;
    font-size: 13px;
    padding: 8px 18px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s ease;
    cursor: pointer;
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
    font-size: 13px;
    padding: 8px 20px;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: all 0.15s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    cursor: pointer;
  }
  .btn-modal-submit:hover {
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
  }
  .btn-modal-delete {
    background-color: rgba(239, 68, 68, 0.1) !important;
    border: 1px solid rgba(239, 68, 68, 0.25) !important;
    color: #F87171 !important;
    border-radius: 8px !important;
    font-weight: 500;
    font-size: 13px;
    padding: 8px 16px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-modal-delete:hover {
    background-color: #DC2626 !important;
    color: #FFFFFF !important;
    border-color: #DC2626 !important;
  }
</style>
@endsection

@extends('layout.template')
@section('content')

@php
    $totalVarian = $tinta->count();
    $totalStok = $tinta->sum('stok');
    $stokAman = $tinta->where('stok', '>', 5)->count();
    $stokKritis = $tinta->where('stok', '<=', 5)->count();
@endphp

<div class="page-content">
  <div class="container-fluid">

    <!-- Page Header & Breadcrumb (Standard Velzon) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Tinta</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Barang</a></li>
              <li class="breadcrumb-item active">Daftar Tinta</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <button type="button" class="btn btn-add-tinta-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTinta">
            <i class="las la-plus fs-16"></i>
            <span>Tambah Tinta</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Ringkasan Inventori (Compact 3-Card Grid) -->
    <div class="row g-3 mb-4">
      <!-- Total Varian -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card kpi-accent-sky">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Total Varian Tinta</div>
              <div class="kpi-value-container">
                <span class="kpi-value">{{ $totalVarian }}</span>
                <span class="kpi-unit">Jenis Varian</span>
              </div>
            </div>
            <div class="kpi-icon-box icon-box-sky">
              <i class="las la-tint"></i>
            </div>
          </div>
          <div class="mt-2">
            <span class="tokabe-count-pill pill-indigo">
              <i class="las la-check-circle fs-13"></i>
              <span>Katalog Produksi</span>
            </span>
          </div>
        </div>
      </div>

      <!-- Total Volume Stok -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card kpi-accent-emerald">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Total Volume Fisik</div>
              <div class="kpi-value-container">
                <span class="kpi-value">{{ number_format($totalStok, 0, ',', '.') }}</span>
                <span class="kpi-unit">Unit / Botol</span>
              </div>
            </div>
            <div class="kpi-icon-box icon-box-emerald">
              <i class="las la-boxes"></i>
            </div>
          </div>
          <div class="mt-2">
            <span class="tokabe-count-pill pill-emerald">
              <i class="las la-warehouse fs-13"></i>
              <span>Stok Gudang</span>
            </span>
          </div>
        </div>
      </div>

      <!-- Status Restock -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card {{ $stokKritis > 0 ? 'kpi-accent-rose' : 'kpi-accent-emerald' }}">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Perlu Pengadaan / Habis</div>
              <div class="kpi-value-container">
                <span class="kpi-value {{ $stokKritis > 0 ? 'text-danger' : 'text-success' }}">{{ $stokKritis }}</span>
                <span class="kpi-unit">Varian</span>
              </div>
            </div>
            <div class="kpi-icon-box {{ $stokKritis > 0 ? 'icon-box-rose' : 'icon-box-emerald' }}">
              <i class="{{ $stokKritis > 0 ? 'las la-exclamation-triangle' : 'las la-shield-alt' }}"></i>
            </div>
          </div>
          <div class="mt-2">
            @if ($stokKritis > 0)
              <span class="tokabe-count-pill pill-rose">
                <i class="las la-bell fs-13"></i>
                <span>Stok Menipis / Kosong</span>
              </span>
            @else
              <span class="tokabe-count-pill pill-emerald">
                <i class="las la-check-circle fs-13"></i>
                <span>Semua Stok Aman</span>
              </span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section Card -->
    <div class="tokabe-section-card">
      <div class="tokabe-card-header">
        <div class="tokabe-card-title">
          <i class="las la-list-ul fs-18 text-primary"></i>
          <span>Daftar Stok Tinta Produksi</span>
          <span class="tokabe-count-pill pill-indigo">{{ $totalVarian }} Data</span>
        </div>
      </div>

      <div class="table-responsive">
        <table id="tintaTable" class="table tokabe-table align-middle dt-responsive nowrap w-100">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">No.</th>
              <th style="width: 140px;">Kode Tinta</th>
              <th>Nama / Jenis Tinta</th>
              <th class="text-center" style="width: 130px;">Jumlah Stok</th>
              <th class="text-center" style="width: 130px;">Status</th>
              <th style="width: 180px;">Terakhir Diperbarui</th>
              <th class="text-center" style="width: 130px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($tinta as $ink)
              @php
                  $stockVal = (float)$ink->stok;
                  $tglFormatted = $ink->tgl_masuk ? date('d/m/Y', strtotime($ink->tgl_masuk)) : date('d/m/Y', strtotime($ink->updated_at));
              @endphp
              <tr>
                <td class="text-center text-muted num">{{ $loop->iteration }}</td>

                <td>
                  <span class="badge-kode-barang">{{ $ink->kode_barang }}</span>
                </td>

                <td>
                  <span class="fw-semibold text-white">{{ $ink->jenis_barang }}</span>
                </td>

                <td class="text-center num">
                  @if ($stockVal <= 0)
                    <span class="badge-stock-zero">0 Unit</span>
                  @elseif ($stockVal <= 5)
                    <span class="badge-stock-low">{{ number_format($stockVal, 0, ',', '.') }} Unit</span>
                  @else
                    <span class="badge-stock-safe">{{ number_format($stockVal, 0, ',', '.') }} Unit</span>
                  @endif
                </td>

                <td class="text-center">
                  @if ($stockVal == 0)
                    <span class="badge-stock-zero">Habis</span>
                  @elseif ($stockVal <= 5)
                    <span class="badge-stock-low">Menipis</span>
                  @else
                    <span class="badge-stock-safe">Aman</span>
                  @endif
                </td>

                <td class="text-muted" style="font-size: 12.5px;">
                  {{ date('d M Y, H:i', strtotime($ink->updated_at)) }}
                </td>

                <td class="text-center">
                  <div class="d-inline-flex gap-1 justify-content-center">
                    <button type="button" class="btn-action-edit-sm btn-edit-tinta" 
                      data-id="{{ $ink->id }}"
                      data-nama="{{ $ink->jenis_barang }}"
                      data-kode="{{ $ink->kode_barang }}"
                      data-stok="{{ $stockVal }}"
                      data-tgl="{{ $tglFormatted }}"
                      title="Edit Data Tinta">
                      <i class="las la-pen"></i> Edit
                    </button>
                    <button type="button" class="btn-action-delete-sm" title="Hapus Tinta" onclick="confirmDeleteTinta('{{ $ink->id }}', '{{ addslashes($ink->jenis_barang) }}')">
                      <i class="las la-trash"></i> Hapus
                    </button>
                    <form id="delete-form-{{ $ink->id }}" action="{{ route('delete.tinta', ['id' => $ink->id]) }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-5">
                  <div class="py-4">
                    <div class="avatar-md mx-auto mb-3" style="width: 52px; height: 52px; background: rgba(99, 102, 241, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                      <i class="las la-tint text-primary fs-24"></i>
                    </div>
                    <h5 class="text-white fw-semibold mb-1">Belum Ada Data Tinta</h5>
                    <p class="text-muted fs-13 mb-3">Stok tinta produksi belum terdata di inventori.</p>
                    <button type="button" class="btn btn-add-tinta-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTinta">
                      <i class="las la-plus me-1"></i> Tambah Tinta Sekarang
                    </button>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- ========================================================
     MODAL POPUP 1: TAMBAH TINTA BARU
     ======================================================== -->
<div class="modal fade" id="modalTambahTinta" tabindex="-1" aria-labelledby="modalTambahTintaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="modalTambahTintaLabel">
            <i class="las la-plus-circle fs-20 text-primary"></i>
            <span>Tambah Tinta Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Daftarkan varian tinta baru ke inventori produksi</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form action="{{ route('store.tinta') }}" method="POST" id="formTambahTinta">
        @csrf
        <input name="harga_modal" type="hidden" value="0">
        <input name="harga_jual" type="hidden" value="0">
        <input name="kategori" type="hidden" value="7">

        <div class="tokabe-modal-body">
          <!-- Nama Tinta -->
          <div class="mb-3">
            <label class="form-label-modern" for="tambah_nama_tinta">
              Nama / Jenis Tinta <span class="required-star">*</span>
            </label>
            <input type="text" name="nama_tinta" id="tambah_nama_tinta" class="form-control form-control-modern" placeholder="Contoh: Tinta Warna Eco-Solvent, Tinta Putih DTF" required>
            <p class="form-help-text">Nama varian atau warna tinta yang digunakan.</p>
          </div>

          <!-- Kode Tinta & Stok -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-modern" for="tambah_kode_tinta">
                Kode Tinta <span class="required-star">*</span>
              </label>
              <input type="text" name="kode_tinta" id="tambah_kode_tinta" class="form-control form-control-modern font-mono" placeholder="Contoh: TTW, TTB" required style="text-transform: uppercase;">
              <p class="form-help-text">Kode unik inventori barang.</p>
            </div>

            <div class="col-md-6">
              <label class="form-label-modern" for="tambah_stok">
                Stok Awal <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <input type="number" name="stok" id="tambah_stok" class="form-control form-control-modern num" placeholder="0" value="0" min="0" required>
                <span class="input-addon-dark">Unit</span>
              </div>
              <p class="form-help-text">Jumlah fisik botol/kaleng tersedia.</p>
            </div>
          </div>

          <!-- Tanggal Masuk -->
          <div class="mb-2">
            <label class="form-label-modern" for="tambah_tgl_masuk">
              Tanggal Masuk / Penerimaan
            </label>
            <input type="text" name="tgl_masuk" id="tambah_tgl_masuk" class="form-control form-control-modern tinta-datepicker" placeholder="DD/MM/YYYY" value="{{ date('d/m/Y') }}" required>
            <p class="form-help-text">Tanggal pencatatan barang masuk ke gudang.</p>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit">
            <i class="las la-save fs-16"></i>
            <span>Simpan Tinta</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL POPUP 2: EDIT DATA TINTA
     ======================================================== -->
<div class="modal fade" id="modalEditTinta" tabindex="-1" aria-labelledby="modalEditTintaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="modalEditTintaLabel">
            <i class="las la-pen fs-20 text-warning"></i>
            <span>Edit Data Tinta</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Perbarui spesifikasi atau volume fisik tinta produksi</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form action="" method="POST" id="formEditTinta">
        @csrf
        @method('PUT')
        <input name="harga_modal" type="hidden" value="0">
        <input name="harga_jual" type="hidden" value="0">
        <input name="kategori" type="hidden" value="7">
        <input type="hidden" id="edit_tinta_id" value="">

        <div class="tokabe-modal-body">
          <!-- Nama Tinta -->
          <div class="mb-3">
            <label class="form-label-modern" for="edit_nama_tinta">
              Nama / Jenis Tinta <span class="required-star">*</span>
            </label>
            <input type="text" name="nama_tinta" id="edit_nama_tinta" class="form-control form-control-modern" placeholder="Contoh: Tinta Warna Eco-Solvent" required>
            <p class="form-help-text">Nama lengkap varian atau warna tinta.</p>
          </div>

          <!-- Kode Tinta & Stok -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-modern" for="edit_kode_tinta">
                Kode Tinta <span class="required-star">*</span>
              </label>
              <input type="text" name="kode_tinta" id="edit_kode_tinta" class="form-control form-control-modern font-mono" placeholder="Contoh: TTW" required style="text-transform: uppercase;">
              <p class="form-help-text">Kode unik inventori barang.</p>
            </div>

            <div class="col-md-6">
              <label class="form-label-modern" for="edit_stok">
                Jumlah Stok <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <input type="number" name="stok" id="edit_stok" class="form-control form-control-modern num" placeholder="0" min="0" required>
                <span class="input-addon-dark">Unit</span>
              </div>
              <p class="form-help-text">Volume fisik stok terkini di gudang.</p>
            </div>
          </div>

          <!-- Tanggal Masuk -->
          <div class="mb-2">
            <label class="form-label-modern" for="edit_tgl_masuk">
              Tanggal Masuk / Update Terakhir
            </label>
            <input type="text" name="tgl_masuk" id="edit_tgl_masuk" class="form-control form-control-modern tinta-datepicker" placeholder="DD/MM/YYYY" required>
            <p class="form-help-text">Tanggal pembaruan inventori stok.</p>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <div>
            <button type="button" class="btn-modal-delete" id="btnDeleteFromEditModal">
              <i class="las la-trash"></i>
              <span>Hapus Tinta</span>
            </button>
          </div>
          <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
              Batal
            </button>
            <button type="submit" class="btn btn-modal-submit">
              <i class="las la-save fs-16"></i>
              <span>Simpan Perubahan</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>

<script>
  $(document).ready(function() {
    // Pindahkan modal langsung ke <body> agar terhindar dari stacking context issue
    $('#modalTambahTinta').appendTo('body');
    $('#modalEditTinta').appendTo('body');

    // Inisialisasi DataTables Tokabe
    if ($.fn.DataTable.isDataTable('#tintaTable')) {
      $('#tintaTable').DataTable().destroy();
    }

    $('#tintaTable').DataTable({
      responsive: true,
      pageLength: 25,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Cari tinta...",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 data",
        infoFiltered: "(disaring dari _MAX_ total data)",
        zeroRecords: "Tidak ada data tinta yang cocok",
        paginate: {
          first: '<i class="las la-angle-double-left"></i>',
          previous: '<i class="las la-angle-left"></i>',
          next: '<i class="las la-angle-right"></i>',
          last: '<i class="las la-angle-double-right"></i>'
        }
      },
      order: [[0, 'asc']],
      columnDefs: [
        { orderable: false, targets: [6] }
      ]
    });

    // Inisialisasi Flatpickr
    if (typeof flatpickr !== 'undefined') {
      flatpickr(".tinta-datepicker", {
        dateFormat: "d/m/Y",
        allowInput: true
      });
    }

    // Event Handler saat tombol Edit Tinta diklik
    $(document).on('click', '.btn-edit-tinta', function() {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      var stok = $(this).data('stok');
      var tgl = $(this).data('tgl');

      $('#edit_tinta_id').val(id);
      $('#edit_nama_tinta').val(nama);
      $('#edit_kode_tinta').val(kode);
      $('#edit_stok').val(stok);
      $('#edit_tgl_masuk').val(tgl);

      // Set URL action formulir update
      var updateUrl = "{{ url('tinta/update') }}/" + id;
      $('#formEditTinta').attr('action', updateUrl);

      // Hubungkan tombol hapus di dalam modal edit
      $('#btnDeleteFromEditModal').off('click').on('click', function() {
        var editModalEl = document.getElementById('modalEditTinta');
        var modalInstance = bootstrap.Modal.getInstance(editModalEl);
        if (modalInstance) {
          modalInstance.hide();
        }
        confirmDeleteTinta(id, nama);
      });

      // Tampilkan modal edit
      var editModal = new bootstrap.Modal(document.getElementById('modalEditTinta'));
      editModal.show();
    });
  });

  // Konfirmasi Hapus Tinta dengan SweetAlert
  function confirmDeleteTinta(id, name) {
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        title: 'Hapus Tinta?',
        html: `Apakah Anda yakin ingin menghapus <b>${name}</b>?<br><small class="text-muted">Data stok yang dihapus tidak dapat dipulihkan kembali.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DC2626',
        cancelButtonColor: '#334155',
        confirmButtonText: '<i class="las la-trash me-1"></i> Ya, Hapus',
        cancelButtonText: 'Batal',
        background: '#161B22',
        color: '#F8FAFC',
        customClass: {
          popup: 'border border-dark'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-' + id).submit();
        }
      });
    } else {
      if (confirm('Apakah Anda yakin ingin menghapus ' + name + '?')) {
        document.getElementById('delete-form-' + id).submit();
      }
    }
  }
</script>
@endsection