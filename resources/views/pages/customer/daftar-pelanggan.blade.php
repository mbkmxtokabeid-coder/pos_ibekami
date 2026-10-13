@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Laporan Daftar Pelanggan
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
      background: rgba(99, 102, 241, 0.15);
      border: 1px solid rgba(99, 102, 241, 0.35);
      color: #818CF8;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    /* Filter Toolbar Strip */
    .tokabe-filter-toolbar {
      background: #111827;
      border-bottom: 1.5px solid #28354A;
      padding: 14px 20px;
    }

    .tokabe-filter-label {
      font-size: 13px;
      font-weight: 600;
      color: #CBD5E1;
      display: flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }

    /* Form Controls & Select */
    .form-control, .form-select {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      padding: 8px 12px !important;
      font-size: 13.5px !important;
      height: 40px !important;
      transition: all 0.15s ease;
    }
    .form-control::placeholder {
      color: #64748B !important;
    }
    .form-control:focus, .form-select:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
      color: #FFFFFF !important;
      background-color: #0B1120 !important;
    }

    /* Primary Action Buttons */
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
      transition: all 0.15s ease !important;
    }
    .btn-tokabe-primary:hover {
      background-color: #4338CA !important;
      border-color: #3730A3 !important;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.4) !important;
      transform: translateY(-1px);
    }

    .btn-tokabe-reset {
      background-color: #1E293B !important;
      border: 1.5px solid #334155 !important;
      color: #94A3B8 !important;
      font-weight: 500 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 14px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      text-decoration: none;
      transition: all 0.15s ease !important;
    }
    .btn-tokabe-reset:hover {
      background-color: #334155 !important;
      border-color: #475569 !important;
      color: #F8FAFC !important;
    }

    /* Explicit Action Export Buttons */
    .btn-report-pdf {
      background-color: rgba(239, 68, 68, 0.16) !important;
      color: #FCA5A5 !important;
      border: 1.5px solid rgba(239, 68, 68, 0.45) !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: all 0.15s ease !important;
      cursor: pointer;
      text-decoration: none;
      white-space: nowrap;
    }
    .btn-report-pdf:hover {
      background-color: #EF4444 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4) !important;
      transform: translateY(-1px);
    }

    .btn-report-excel {
      background-color: rgba(16, 185, 129, 0.16) !important;
      color: #6EE7B7 !important;
      border: 1.5px solid rgba(52, 211, 153, 0.45) !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: all 0.15s ease !important;
      cursor: pointer;
      text-decoration: none;
      white-space: nowrap;
    }
    .btn-report-excel:hover {
      background-color: #10B981 !important;
      color: #FFFFFF !important;
      border-color: #059669 !important;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4) !important;
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

    /* Customer Initial Avatar */
    .customer-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: rgba(99, 102, 241, 0.18);
      border: 1px solid rgba(99, 102, 241, 0.35);
      color: #A5B4FC;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 600;
      flex-shrink: 0;
    }

    /* Invoice Category Badge */
    .badge-invoice-cat {
      background: rgba(59, 130, 246, 0.15) !important;
      color: #93C5FD !important;
      border: 1px solid rgba(59, 130, 246, 0.35) !important;
      font-weight: 500 !important;
      font-size: 12px !important;
      padding: 4px 10px !important;
      border-radius: 9999px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
    }

    /* DataTables Dark Styling */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
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
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
      background: #111827 !important;
      border-color: #1F2937 !important;
      color: #64748B !important;
      cursor: not-allowed;
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
            <h4 class="mb-sm-0 text-white fw-bold">Laporan Daftar Pelanggan</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Rekapitulasi kontak pelanggan dan perusahaan berdasarkan kategori invoice</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan Daftar Pelanggan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Section Card (§12.1) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">

          <!-- Card Header with Title and Primary Export Actions -->
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <div class="tokabe-header-icon">
                <i class="las la-users"></i>
              </div>
              <div>
                <span>Daftar Pelanggan</span>
                <span class="tokabe-card-subtitle">
                  Total {{ $customers->count() }} pelanggan terdaftar
                  @if($selectedInvoice)
                    &bull; Kategori: <strong class="text-indigo-400" style="color: #A5B4FC;">{{ optional($invoices->where('id', $selectedInvoice)->first())->nama_invoice ?? 'Terpilih' }}</strong>
                  @endif
                </span>
              </div>
            </div>

            <!-- Export Buttons (WCAG AA Compliant 40px Touch Target) -->
            <form action="{{ route('export.pelanggan') }}" method="POST" target="_blank" id="exportCustomerForm" class="d-flex align-items-center gap-2 m-0">
              @csrf
              <input type="hidden" name="invoice" id="exportInvoiceInput" value="{{ $selectedInvoice }}">

              <button class="btn-report-pdf" type="submit" name="export_type" value="pdf" title="Lihat / Cetak Laporan PDF">
                <i class="las la-file-pdf fs-18"></i>
                <span>Lihat PDF</span>
              </button>
              <button class="btn-report-excel" type="submit" name="export_type" value="excel" title="Unduh Spreadsheet Excel">
                <i class="las la-file-excel fs-18"></i>
                <span>Unduh Excel</span>
              </button>
            </form>
          </div>

          <!-- Filter Toolbar Strip -->
          <div class="tokabe-filter-toolbar">
            <form action="{{ route('daftar.pelanggan') }}" method="GET" class="row g-2 align-items-center">
              <div class="col-12 col-md-auto">
                <span class="tokabe-filter-label">
                  <i class="las la-filter fs-16 text-indigo-400" style="color: #818CF8;"></i>
                  Filter Kategori Invoice:
                </span>
              </div>

              <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <select name="invoice" class="form-select" id="invoiceDropdown" aria-label="Pilih Kategori Invoice">
                  <option value="">Semua Kategori Invoice</option>
                  @foreach ($invoices as $invoice)
                    <option value="{{ $invoice->id }}" {{ $invoice->id == $selectedInvoice ? 'selected' : '' }}>
                      {{ $invoice->nama_invoice }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-12 col-sm-auto d-flex align-items-center gap-2">
                <button type="submit" class="btn-tokabe-primary" title="Terapkan Filter Kategori">
                  <i class="las la-search fs-16"></i>
                  <span>Filter</span>
                </button>

                @if($selectedInvoice)
                  <a href="{{ route('daftar.pelanggan') }}" class="btn-tokabe-reset" title="Tampilkan Semua Kategori">
                    <i class="las la-times fs-16"></i>
                    <span>Reset</span>
                  </a>
                @endif
              </div>

              @if($selectedInvoice)
                <div class="col-12 col-md-auto ms-md-auto d-none d-md-block">
                  <span class="badge" style="background: rgba(99, 102, 241, 0.15); color: #A5B4FC; border: 1px solid rgba(99, 102, 241, 0.35); font-size: 12px; padding: 6px 12px; border-radius: 9999px;">
                    <i class="las la-check-circle me-1"></i>Filter Aktif: {{ optional($invoices->where('id', $selectedInvoice)->first())->nama_invoice ?? 'Kategori' }}
                  </span>
                </div>
              @endif
            </form>
          </div>

          <!-- Table Container -->
          <div class="card-body p-0">
            <div class="table-responsive p-3">
              <table id="alternative-pagination" class="table nowrap align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Customer</th>
                    <th>Kategori Invoice</th>
                    <th>Perusahaan</th>
                    <th>No. Kontak</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($customers as $cust)
                    <tr>
                      <td class="text-center fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <div class="customer-avatar">
                            <i class="las la-user"></i>
                          </div>
                          <div>
                            <span class="fw-semibold text-white">{{ $cust->customer ?? '-' }}</span>
                          </div>
                        </div>
                      </td>
                      <td>
                        @php
                          $catName = optional($invoices->where('id', $cust->invoice)->first())->nama_invoice;
                        @endphp
                        @if($catName)
                          <span class="badge-invoice-cat">
                            <i class="las la-file-invoice"></i>
                            {{ $catName }}
                          </span>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                      <td>
                        @if(!empty($cust->perusahaan) && $cust->perusahaan != '--')
                          <span class="fw-medium" style="color: #CBD5E1;">{{ $cust->perusahaan }}</span>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                      <td>
                        @if(!empty($cust->no_telepon) && $cust->no_telepon != '--')
                          <a href="tel:{{ $cust->no_telepon }}" class="d-inline-flex align-items-center gap-1 text-decoration-none" style="color: #34D399; font-variant-numeric: tabular-nums; font-weight: 500;" title="Hubungi {{ $cust->customer }}">
                            <i class="las la-phone fs-16"></i>
                            <span>{{ $cust->no_telepon }}</span>
                          </a>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center py-5" style="color: #94A3B8;">
                        <i class="las la-folder-open fs-36 d-block mb-2" style="color: #64748B;"></i>
                        Belum ada data pelanggan untuk kategori ini.
                      </td>
                    </tr>
                  @endforelse
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ asset('js/pages/datatables.init.js') }}"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var invoiceDropdown = document.getElementById("invoiceDropdown");
    var exportInvoiceInput = document.getElementById("exportInvoiceInput");

    if (invoiceDropdown && exportInvoiceInput) {
      invoiceDropdown.addEventListener("change", function() {
        exportInvoiceInput.value = this.value;
      });
    }
  });
</script>
@endsection