@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Daftar Anggaran
       Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
       ========================================================================== */

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

    /* Section Card Container (§12.1) */
    .tokabe-section-card {
      background: #151D2A !important;
      border: 1.5px solid #28354A !important;
      border-radius: 12px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 24px;
      overflow: hidden;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-section-card:hover {
      border-color: #3B4B66 !important;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35) !important;
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
      font-size: 16px;
      font-weight: 700;
      color: #F8FAFC !important;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .tokabe-card-subtitle {
      font-size: 12.5px;
      color: #94A3B8;
      margin-top: 2px;
      display: block;
    }

    /* Icon Accent Badge */
    .tokabe-header-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.35);
      color: #6EE7B7;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    /* Primary Action Button (§9) */
    .btn-tokabe-primary {
      background-color: #4F46E5 !important;
      border-color: #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      text-decoration: none !important;
      transition: all 0.15s ease !important;
      box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25) !important;
    }
    .btn-tokabe-primary:hover {
      background-color: #4338CA !important;
      border-color: #3730A3 !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
      transform: translateY(-1px);
    }

    /* Table Design Tokens (§13.1) */
    .tokabe-table {
      margin-bottom: 0 !important;
      border-color: #28354A !important;
      width: 100% !important;
    }
    .tokabe-table thead th {
      background-color: #101726 !important;
      color: #94A3B8 !important;
      font-size: 11.5px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 12px 16px !important;
      border-bottom: 2px solid #28354A !important;
      border-top: none !important;
      white-space: nowrap;
    }
    .tokabe-table tbody tr {
      background-color: #151D2A !important;
      transition: background-color 0.15s ease;
    }
    .tokabe-table tbody tr:hover {
      background-color: #1E293B !important;
    }
    .tokabe-table tbody td {
      padding: 12px 16px !important;
      border-bottom: 1px solid #243044 !important;
      color: #E2E8F0 !important;
      font-size: 13.5px !important;
      vertical-align: middle !important;
    }

    /* Category Badge */
    .badge-budget-cat {
      background: rgba(59, 130, 246, 0.16) !important;
      color: #93C5FD !important;
      border: 1px solid rgba(59, 130, 246, 0.4) !important;
      font-weight: 500; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 4px;
    }

    /* Action Buttons */
    .btn-action-edit {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(245, 158, 11, 0.16) !important;
      border: 1.5px solid rgba(245, 158, 11, 0.4) !important;
      color: #FCD34D !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.15s ease;
      cursor: pointer;
      text-decoration: none;
    }
    .btn-action-edit:hover {
      background: #F59E0B !important;
      color: #111827 !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.35);
    }

    /* DataTables Dark Theme Overrides */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
      color: #94A3B8 !important;
      font-size: 13px !important;
      padding: 12px 16px !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 6px !important;
      padding: 4px 10px !important;
      margin: 0 6px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 6px !important;
      padding: 6px 12px !important;
      margin-left: 8px !important;
      outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background: #1A2436 !important;
      border: 1px solid #28354A !important;
      color: #CBD5E1 !important;
      border-radius: 6px !important;
      margin: 0 3px !important;
      padding: 5px 11px !important;
      font-size: 12.5px !important;
      transition: all 0.15s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: #334155 !important;
      border-color: #475569 !important;
      color: #FFFFFF !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: #4F46E5 !important;
      border-color: #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
    }

    /* Custom dark scrollbar */
    .table-responsive::-webkit-scrollbar {
      height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
      background: #0F172A;
    }
    .table-responsive::-webkit-scrollbar-thumb {
      background: #334155;
      border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
      background: #475569;
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
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Anggaran</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Monitoring alokasi pagu belanja dan biaya per kategori barang</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Anggaran</a></li>
              <li class="breadcrumb-item active">Daftar Anggaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Section Card (§12.1) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">

          <!-- Card Header with Title and Add Button -->
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <div class="tokabe-header-icon">
                <i class="las la-wallet"></i>
              </div>
              <div>
                <span>Daftar Alokasi Anggaran</span>
                <span class="tokabe-card-subtitle">Total {{ count($budgets) }} pos anggaran tercatat</span>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <a href="{{ route('budget.add') }}" class="btn-tokabe-primary">
                <i class="las la-plus fs-16"></i>
                <span>Tambah Anggaran</span>
              </a>
            </div>
          </div>

          <!-- Table Container -->
          <div class="card-body p-0">
            <div class="table-responsive p-3">
              <table id="alternative-pagination" class="table nowrap align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Nama Anggaran</th>
                    <th>Kategori</th>
                    <th class="text-end">Nominal Anggaran</th>
                    <th>Tanggal Berlaku</th>
                    <th style="width: 80px; text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($budgets as $budget)
                    <tr>
                      <td class="text-center fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="fw-semibold text-white">{{ $budget->nama_budget }}</span>
                      </td>
                      <td>
                        <span class="badge-budget-cat">
                          <i class="las la-tag"></i>
                          {{ $budget->kategori_barang->nama_kategori ?? '-' }}
                        </span>
                      </td>
                      <td class="text-end fw-bold" style="color: #34D399; font-variant-numeric: tabular-nums;">
                        Rp {{ $budget->formattedAnggaran }}
                      </td>
                      <td>
                        <span class="text-slate-300" style="color: #CBD5E1;">
                          <i class="las la-calendar me-1 text-slate-500"></i>{{ $budget->tanggal }}
                        </span>
                      </td>
                      <td class="text-center">
                        <a href="{{ route('budget.edit', ['id' => $budget->id]) }}" class="btn-action-edit" title="Edit Anggaran {{ $budget->nama_budget }}">
                          <i class="las la-pen"></i>
                        </a>
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
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
@endsection