@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: SPJ (Surat Perintah Jalan)
       Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
       ========================================================================== */

    .num, .price, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    /* Page Header Title & Breadcrumb (§16.2) */
    .page-title-box h4 {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: -0.01em;
      color: #F8FAFC !important;
    }
    .breadcrumb .breadcrumb-item a {
      color: #94A3B8 !important;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.15s ease;
    }
    .breadcrumb .breadcrumb-item a:hover {
      color: #60A5FA !important;
    }
    .breadcrumb .breadcrumb-item.active {
      color: #E2E8F0 !important;
      font-weight: 600;
    }

    /* KPI Summary Cards (§12.4) */
    .tokabe-kpi-card {
      background: #151D2A !important;
      border: 1.5px solid #28354A !important;
      border-radius: 12px !important;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important;
      padding: 18px 20px;
      transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
      height: 100%;
    }
    .tokabe-kpi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.45) !important;
      border-color: #3B4B66 !important;
    }
    .kpi-title {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #CBD5E1 !important;
      margin-bottom: 6px;
    }
    .kpi-amount {
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.01em;
      line-height: 1.2;
      margin-bottom: 0;
    }
    .kpi-icon-box {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
    }
    .icon-box-emerald {
      background-color: rgba(16, 185, 129, 0.16);
      color: #34D399;
      border: 1.5px solid rgba(16, 185, 129, 0.4);
    }
    .icon-box-amber {
      background-color: rgba(245, 158, 11, 0.16);
      color: #FBBF24;
      border: 1.5px solid rgba(245, 158, 11, 0.4);
    }
    .icon-box-sky {
      background-color: rgba(56, 189, 248, 0.16);
      color: #38BDF8;
      border: 1.5px solid rgba(56, 189, 248, 0.4);
    }

    /* Section Card Container (§12.1) */
    .tokabe-section-card {
      background: #151D2A !important;
      border: 1.5px solid #28354A !important;
      border-radius: 12px !important;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 24px;
      overflow: hidden;
    }
    .tokabe-card-header {
      background: #1A2436 !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 16px 20px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .tokabe-card-title {
      font-size: 15.5px;
      font-weight: 700;
      color: #F8FAFC !important;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Primary Action Button (§11) */
    .btn-tokabe-primary {
      background-color: #4F46E5 !important;
      border-color: #6366F1 !important;
      color: #FFFFFF !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      padding: 8px 16px !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.35) !important;
      text-decoration: none;
    }
    .btn-tokabe-primary:hover {
      background-color: #4338CA !important;
      border-color: #4F46E5 !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
    }

    /* Table Styles (§13) */
    .tokabe-table {
      background-color: #151D2A !important;
      color: #F1F5F9 !important;
      margin-bottom: 0 !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      width: 100% !important;
    }
    .tokabe-table thead th {
      background-color: #101726 !important;
      color: #E2E8F0 !important;
      font-size: 12.5px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      border-top: none !important;
      border-bottom: 2px solid #28354A !important;
      padding: 14px 16px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid #222D3F !important;
      padding: 13px 15px !important;
      font-size: 13.5px !important;
      vertical-align: middle;
      background-color: transparent !important;
      color: #F1F5F9 !important;
    }
    .tokabe-table tbody tr:hover td {
      background-color: #1E293B !important;
    }
    .tokabe-table tbody tr:last-child td {
      border-bottom: none !important;
    }

    /* Badges */
    .badge-invoice-no {
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
      font-size: 12.5px;
      font-weight: 700;
      color: #38BDF8 !important;
      background: rgba(56, 189, 248, 0.12);
      border: 1.5px solid rgba(56, 189, 248, 0.35);
      padding: 4px 9px;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }
    .badge-status-lunas {
      background: rgba(16, 185, 129, 0.2);
      color: #6EE7B7 !important;
      border: 1.5px solid rgba(52, 211, 153, 0.45);
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 9999px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .badge-status-belum {
      background: rgba(239, 68, 68, 0.2);
      color: #FCA5A5 !important;
      border: 1.5px solid rgba(239, 68, 68, 0.45);
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 9999px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    /* Accessible Action Ghost Button */
    .btn-action-ghost {
      background: #1E293B !important;
      border: 1.5px solid #334155 !important;
      color: #CBD5E1 !important;
      border-radius: 8px !important;
      width: 38px !important;
      height: 38px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 0 !important;
      transition: all 0.15s ease;
    }
    .btn-action-ghost:hover {
      background: #334155 !important;
      color: #FFFFFF !important;
      border-color: #6366F1 !important;
    }
    .btn-action-ghost:focus-visible {
      outline: 2px solid #818CF8 !important;
      outline-offset: 2px;
    }
    .dropdown-menu {
      background: #1A2436 !important;
      border: 1.5px solid #2D3B4F !important;
      border-radius: 10px !important;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6) !important;
      padding: 6px !important;
      z-index: 1050 !important;
    }
    .dropdown-item {
      color: #F1F5F9 !important;
      border-radius: 6px !important;
      padding: 8px 12px !important;
      font-size: 13.5px !important;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.15s ease;
      background: transparent;
      border: none;
      width: 100%;
      text-align: left;
    }
    .dropdown-item:hover, .dropdown-item:focus {
      background: #28354A !important;
      color: #FFFFFF !important;
    }
    .dropdown-item--danger {
      color: #F87171 !important;
    }
    .dropdown-item--danger:hover, .dropdown-item--danger:focus {
      background: rgba(239, 68, 68, 0.2) !important;
      color: #FCA5A5 !important;
    }
    .dropdown-divider {
      border-color: #28354A !important;
      margin: 6px 0 !important;
    }

    /* Dark Slate Custom Scrollbar */
    .table-responsive,
    .dataTables_scroll,
    .dataTables_scrollBody,
    div.dataTables_scrollBody,
    .dataTables_wrapper {
      scrollbar-width: thin !important;
      scrollbar-color: #2D3B52 #0F172A !important;
    }
    .table-responsive::-webkit-scrollbar,
    .dataTables_scroll::-webkit-scrollbar,
    .dataTables_scrollBody::-webkit-scrollbar,
    div.dataTables_scrollBody::-webkit-scrollbar,
    .dataTables_wrapper::-webkit-scrollbar {
      height: 8px !important;
      width: 8px !important;
    }
    .table-responsive::-webkit-scrollbar-track,
    .dataTables_scroll::-webkit-scrollbar-track,
    .dataTables_scrollBody::-webkit-scrollbar-track,
    div.dataTables_scrollBody::-webkit-scrollbar-track,
    .dataTables_wrapper::-webkit-scrollbar-track {
      background: #0F172A !important;
      border-radius: 4px !important;
    }
    .table-responsive::-webkit-scrollbar-thumb,
    .dataTables_scroll::-webkit-scrollbar-thumb,
    .dataTables_scrollBody::-webkit-scrollbar-thumb,
    div.dataTables_scrollBody::-webkit-scrollbar-thumb,
    .dataTables_wrapper::-webkit-scrollbar-thumb {
      background: #2D3B52 !important;
      border-radius: 4px !important;
      border: 1px solid #0F172A !important;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover,
    .dataTables_scrollBody::-webkit-scrollbar-thumb:hover,
    div.dataTables_scrollBody::-webkit-scrollbar-thumb:hover,
    .dataTables_wrapper::-webkit-scrollbar-thumb:hover {
      background: #475569 !important;
    }

    /* DataTables Controls & Pagination (§13.2) */
    .dataTables_wrapper {
      color: #CBD5E1 !important;
      padding: 14px 16px;
      position: relative;
      clear: both;
    }
    .dataTables_wrapper::after {
      content: "";
      display: table;
      clear: both;
    }
    .dataTables_wrapper .dataTables_length {
      float: left !important;
      display: inline-flex !important;
      align-items: center !important;
      height: 52px !important;
      padding: 8px 12px !important;
      margin: 0 !important;
      color: #94A3B8 !important;
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_filter {
      float: right !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: flex-end !important;
      height: 52px !important;
      padding: 8px 12px !important;
      margin: 0 !important;
      color: #94A3B8 !important;
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      margin: 0 !important;
      font-size: 13px !important;
      color: #94A3B8 !important;
      font-weight: 500 !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      padding: 5px 10px !important;
      margin: 0 4px !important;
      height: 34px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      padding: 5px 12px !important;
      margin: 0 0 0 6px !important;
      height: 34px !important;
      width: 220px !important;
      outline: none !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
    }
    .dataTables_wrapper .dataTables_info {
      float: left !important;
      display: inline-flex !important;
      align-items: center !important;
      height: 52px !important;
      padding: 8px 12px !important;
      margin: 0 !important;
      color: #94A3B8 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
    }
    .dataTables_wrapper .dataTables_paginate {
      float: right !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: flex-end !important;
      height: 52px !important;
      padding: 8px 12px !important;
      margin: 0 !important;
      gap: 4px !important;
    }
    .dataTables_wrapper .pagination {
      margin: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 4px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button,
    .dataTables_wrapper .dataTables_paginate .page-item .page-link,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link {
      background-color: #1E293B !important;
      border: 1px solid #334155 !important;
      color: #CBD5E1 !important;
      border-radius: 8px !important;
      padding: 6px 12px !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      min-width: 36px !important;
      height: 36px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      margin: 0 2px !important;
      cursor: pointer !important;
      transition: all 0.15s ease !important;
      box-shadow: none !important;
      line-height: 1 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
    .dataTables_wrapper .dataTables_paginate .page-item .page-link:hover,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link:hover {
      background-color: #334155 !important;
      border-color: #475569 !important;
      color: #FFFFFF !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link,
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link:hover,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link:hover {
      background: #4F46E5 !important;
      background-color: #4F46E5 !important;
      border-color: #6366F1 !important;
      color: #FFFFFF !important;
      font-weight: 700 !important;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.45) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .page-item.disabled .page-link,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.disabled .page-link {
      background-color: rgba(30, 41, 59, 0.5) !important;
      border-color: #28354A !important;
      color: #64748B !important;
      cursor: not-allowed !important;
      opacity: 0.55 !important;
      box-shadow: none !important;
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
            <h4 class="mb-sm-0 text-white fw-bold">SPJ (Surat Perintah Jalan)</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">SPJ</a></li>
              <li class="breadcrumb-item active">Daftar SPJ</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Summary KPI Cards (§12.4) -->
    <div class="row g-3 mb-4">
      <!-- KPI 1: Terbayar Bulan Ini -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TERBAYAR BULAN INI</div>
              <h4 class="kpi-amount num text-white" aria-label="Jumlah SPJ Terbayar Bulan Ini: Rp {{ number_format($totalBulanIni, 0, ',', '.') }}">
                Rp <span style="color: #34D399;">{{ number_format($totalBulanIni, 0, ',', '.') }}</span>
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">
                Total: <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 num px-2 py-0 ms-1">{{ $jumlahSpjBulanIni }} SPJ</span>
              </span>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="las la-calendar-check"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 2: Terbayar Tahun Ini -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TERBAYAR TAHUN {{ date('Y') }}</div>
              <h4 class="kpi-amount num text-white" aria-label="Jumlah SPJ Terbayar Tahun Ini: Rp {{ number_format($totalTahunIni, 0, ',', '.') }}">
                Rp <span style="color: #FBBF24;">{{ number_format($totalTahunIni, 0, ',', '.') }}</span>
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">
                Total: <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-25 num px-2 py-0 ms-1">{{ $jumlahSpjTahunIni }} SPJ</span>
              </span>
            </div>
            <div class="kpi-icon-box icon-box-amber" aria-hidden="true">
              <i class="las la-money-bill-wave"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 3: Total Riwayat SPJ -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TOTAL BERKAS SPJ</div>
              <h4 class="kpi-amount num" style="color: #38BDF8;" aria-label="Total Berkas SPJ: {{ count($spj) }}">
                {{ count($spj) }} <span class="fs-16 fw-medium text-white-50">Berkas</span>
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">Seluruh data riwayat surat jalan</span>
            </div>
            <div class="kpi-icon-box icon-box-sky" aria-hidden="true">
              <i class="las la-route"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="las la-truck fs-22 text-warning" aria-hidden="true"></i>
              <span>Daftar SPJ</span>
            </div>
            <div class="d-flex align-items-center gap-3">
              <div class="fs-13 d-none d-sm-block" style="color: #CBD5E1;">
                Total: <span class="fw-bold text-white num">{{ count($spj) }}</span> berkas
              </div>
              <a href="{{ url('/tambah-spj') }}" class="btn btn-tokabe-primary" aria-label="Tambah SPJ Baru">
                <i class="las la-plus fs-16" aria-hidden="true"></i>
                <span>Tambah SPJ</span>
              </a>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0 tokabe-table" id="scroll-horizontal" aria-label="Tabel Riwayat SPJ">
                <thead>
                  <tr>
                    <th scope="col" class="text-center text-nowrap" style="width: 50px;">No.</th>
                    <th scope="col" class="text-nowrap" style="min-width: 140px;">No. SPJ</th>
                    <th scope="col" style="min-width: 160px;">Nama Kurir/Petugas</th>
                    <th scope="col" class="text-nowrap" style="min-width: 120px;">Tanggal Tugas</th>
                    <th scope="col" style="min-width: 200px;">Tujuan</th>
                    <th scope="col" class="text-end text-nowrap" style="min-width: 130px;">Biaya BBM</th>
                    <th scope="col" class="text-center text-nowrap" style="width: 120px;">Status</th>
                    <th scope="col" class="text-center text-nowrap" style="width: 80px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($spj as $item)
                    <tr>
                      <td class="text-center num fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>

                      <td class="text-nowrap">
                        <span class="badge-invoice-no">
                          <i class="las la-file-alt" aria-hidden="true"></i>
                          {{ $item->nomor_spj }}
                        </span>
                      </td>

                      <td>
                        <span class="fw-bold text-white d-inline-flex align-items-center gap-1">
                          <i class="las la-user-tag text-info fs-15" aria-hidden="true"></i>
                          {{ $item->nama_kurir }}
                        </span>
                      </td>

                      <td class="text-nowrap num fw-medium" style="color: #CBD5E1;">
                        <i class="las la-calendar me-1" style="color: #94A3B8;" aria-hidden="true"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal_tugas)->format('d-m-Y') }}
                      </td>

                      <td>
                        <div class="fw-medium text-white d-inline-flex align-items-center gap-1">
                          <i class="las la-map-marker-alt text-danger fs-15" aria-hidden="true"></i>
                          <span>{{ $item->tujuan }}</span>
                        </div>
                      </td>

                      <td class="text-end num fw-bold text-white">
                        Rp {{ number_format($item->biaya_bahan_bakar, 0, ',', '.') }}
                      </td>

                      <td class="text-center text-nowrap">
                        @if ($item->status == 'Terbayar')
                          <span class="badge-status-lunas">
                            <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                            <span>Terbayar</span>
                          </span>
                        @else
                          <span class="badge-status-belum">
                            <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                            <span>Belum Bayar</span>
                          </span>
                        @endif
                      </td>

                      <td class="text-center text-nowrap">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi SPJ {{ $item->nomor_spj }}">
                            <i class="ri-more-fill fs-18" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li>
                              <a class="dropdown-item" href="{{ url('/lihat-spj/' . $item->id) }}">
                                <i class="las la-eye fs-16 text-info" aria-hidden="true"></i>
                                <span>Lihat SPJ</span>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" target="_blank" href="{{ url('/cetak-spj/' . $item->id) }}">
                                <i class="las la-print fs-16 text-primary" aria-hidden="true"></i>
                                <span>Cetak SPJ</span>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ url('/edit-spj/' . $item->id) }}">
                                <i class="las la-pen fs-16 text-warning" aria-hidden="true"></i>
                                <span>Edit SPJ</span>
                              </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <form action="{{ url('/delete-spj/' . $item->id) }}" method="POST" id="deletespj{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item dropdown-item--danger" type="button" onclick="showConfirmation('{{ $item->nomor_spj }}', '{{ $item->id }}')">
                                  <i class="las la-trash-alt fs-16 text-danger" aria-hidden="true"></i>
                                  <span>Hapus SPJ</span>
                                </button>
                              </form>
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

<!-- SweetAlert Konfirmasi Hapus Dark Theme -->
<script>
  function showConfirmation(nospj, id) {
    Swal.fire({
      title: 'Hapus Data SPJ?',
      text: 'Apakah Anda yakin ingin menghapus SPJ No. ' + nospj + '? Tindakan ini tidak dapat dibatalkan.',
      icon: 'warning',
      background: '#151D2A',
      color: '#F8FAFC',
      showCancelButton: true,
      confirmButtonColor: '#EF4444',
      cancelButtonColor: '#334155',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deletespj' + id).submit();
      }
    });
  }
</script>
@endsection

@section('plugins')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('js/pages/datatables.init.js') }}"></script>
@endsection
