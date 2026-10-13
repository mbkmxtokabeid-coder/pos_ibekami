@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Laporan Penjualan
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
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 22px;
      overflow: hidden;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-section-card:hover {
      border-color: #3B4B66 !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35) !important;
    }
    .tokabe-card-header {
      background: #1A2436 !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 14px 20px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
    }
    .tokabe-card-title {
      font-size: 15px;
      font-weight: 700;
      color: #F8FAFC !important;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Form Controls & Labels */
    .tokabe-label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: #CBD5E1 !important;
      margin-bottom: 6px !important;
      display: block;
    }
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
    .form-control:disabled, .form-select:disabled {
      background-color: #1A2436 !important;
      border-color: #28354A !important;
      color: #64748B !important;
      cursor: not-allowed;
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
            <h4 class="mb-sm-0 text-white fw-bold">Laporan Penjualan</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Laporan</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- 1. LAPORAN PENJUALAN UTAMA (Perusahaan & Kategori) -->
    <div class="tokabe-section-card">
      <div class="tokabe-card-header">
        <div class="tokabe-card-title">
          <i class="las la-file-invoice-dollar fs-20 text-info" aria-hidden="true"></i>
          <span id="changePerusahaan">Laporan Penjualan (Perusahaan & Kategori)</span>
        </div>
        <small class="fs-12" style="color: #94A3B8;">Filter menurut Perusahaan, Kategori Invoice, dan Status Pelunasan</small>
      </div>
      <div class="card-body p-4">
        <form action="{{ url('/invoice/laporan-export') }}" method="POST" target="_blank">
          @csrf
          <div class="row g-3 align-items-end">
            <div class="col-lg-3 col-md-6">
              <label class="tokabe-label" for="perusahaanTerpilih">Perusahaan</label>
              <select class="form-select" name="perusahaan" id="perusahaanTerpilih" required>
                <option value="" disabled selected>Pilih Perusahaan</option>
                @foreach ($perusahaan as $id => $namaperusahaan)
                  <option value="{{ $id }}">{{ $namaperusahaan }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-3 col-md-6">
              <label class="tokabe-label" for="invoiceTerpilih">Kategori Invoice</label>
              <select name="invoice" id="invoiceTerpilih" disabled class="form-select invoice">
                <option value="semua" selected>Semua Kategori Invoice</option>
              </select>
            </div>

            <div class="col-lg-3 col-md-6">
              <label class="tokabe-label" for="statusSelect">Status Pembayaran</label>
              <select name="status" class="form-select" id="statusSelect">
                <option value="semua">Semua Status</option>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Batal">Batal</option>
                <option value="Dihapus">Dihapus</option>
              </select>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="d-flex gap-2">
                <button class="btn btn-report-pdf flex-fill" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Penjualan Format PDF">
                  <i class="las la-file-pdf fs-18" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel flex-fill" name="export_type" value="excel" type="submit" aria-label="Export Laporan Penjualan Format Excel">
                  <i class="las la-file-excel fs-18" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- 2. LAPORAN PENJUALAN CUSTOM (Rentang Tanggal) -->
    <div class="tokabe-section-card">
      <div class="tokabe-card-header">
        <div class="tokabe-card-title">
          <i class="las la-calendar-alt fs-20 text-warning" aria-hidden="true"></i>
          <span>Laporan Penjualan Custom (Rentang Tanggal)</span>
        </div>
        <small class="fs-12" style="color: #94A3B8;">Filter menurut Periode Tanggal Tertentu</small>
      </div>
      <div class="card-body p-4">
        <form action="{{ url('/invoice/laporan-export-date') }}" method="POST" target="_blank">
          @csrf
          <input type="hidden" name="perusahaan" class="perusahaanHidden" value="">
          <div class="row g-3 align-items-end">
            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="tgl_custom">Pilih Rentang Tanggal</label>
              <input type="text" class="form-control flatpickr-input" id="tgl_custom" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Pilih Rentang Tanggal" name="tgl_custom" required>
            </div>

            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="invoiceTerpilihCstm">Kategori Invoice</label>
              <select class="form-select invoice" id="invoiceTerpilihCstm" name="invoice" required>
                <option value="semua">Semua Invoice</option>
                @foreach ($katInv as $id => $namaInvoice)
                  <option value="{{ $id }}">{{ $namaInvoice }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4 col-md-12">
              <div class="d-flex gap-2">
                <button class="btn btn-report-pdf flex-fill" type="submit" name="export_type" value="pdf" aria-label="Lihat Laporan Custom PDF">
                  <i class="las la-file-pdf fs-18" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel flex-fill" type="submit" name="export_type" value="excel" aria-label="Export Laporan Custom Excel">
                  <i class="las la-file-excel fs-18" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- 3. LAPORAN PENJUALAN BULANAN -->
    <div class="tokabe-section-card">
      <div class="tokabe-card-header">
        <div class="tokabe-card-title">
          <i class="las la-calendar-check fs-20 text-primary" aria-hidden="true"></i>
          <span>Laporan Penjualan Bulanan (Tahun {{ date('Y') }})</span>
        </div>
        <small class="fs-12" style="color: #94A3B8;">Filter Berdasarkan Bulan Tertentu</small>
      </div>
      <div class="card-body p-4">
        <form action="{{ url('/invoice/laporan-export-month') }}" method="POST" target="_blank">
          @csrf
          <input type="hidden" name="perusahaan" class="perusahaanHidden" value="">
          <div class="row g-3 align-items-end">
            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="selectBulan">Pilih Bulan</label>
              <select class="form-select" name="bulan" id="selectBulan" required>
                @foreach ($namaBulan as $bulan)
                  <option value="{{ $bulan }}" {{ (date('F') == $bulan || date('m') == $loop->iteration) ? 'selected' : '' }}>{{ $bulan }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="invoiceTerpilihBulan">Kategori Invoice</label>
              <select class="form-select invoice" id="invoiceTerpilihBulan" name="invoice" required>
                <option value="semua">Semua Invoice</option>
                @foreach ($katInv as $id => $namaInvoice)
                  <option value="{{ $id }}">{{ $namaInvoice }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4 col-md-12">
              <div class="d-flex gap-2">
                <button class="btn btn-report-pdf flex-fill" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Bulanan PDF">
                  <i class="las la-file-pdf fs-18" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel flex-fill" name="export_type" value="excel" type="submit" aria-label="Export Laporan Bulanan Excel">
                  <i class="las la-file-excel fs-18" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- 4. LAPORAN PENJUALAN TAHUNAN -->
    <div class="tokabe-section-card">
      <div class="tokabe-card-header">
        <div class="tokabe-card-title">
          <i class="las la-chart-bar fs-20 text-success" aria-hidden="true"></i>
          <span>Laporan Penjualan Tahunan</span>
        </div>
        <small class="fs-12" style="color: #94A3B8;">Filter Rekapitulasi Berdasarkan Tahun</small>
      </div>
      <div class="card-body p-4">
        <form action="{{ url('/invoice/laporan-export-year') }}" method="POST" target="_blank">
          @csrf
          <input type="hidden" name="perusahaan" class="perusahaanHidden" value="">
          <div class="row g-3 align-items-end">
            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="selectTahun">Pilih Tahun</label>
              <select class="form-select" name="tahun" id="selectTahun" required>
                @foreach ($daftarTahun as $tahun)
                  <option value="{{ $tahun }}" {{ ($tahun == date('Y')) ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4 col-md-6">
              <label class="tokabe-label" for="invoiceTerpilihTahun">Kategori Invoice</label>
              <select class="form-select invoice" id="invoiceTerpilihTahun" name="invoice" required>
                <option value="semua">Semua Invoice</option>
                @foreach ($katInv as $id => $namaInvoice)
                  <option value="{{ $id }}">{{ $namaInvoice }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4 col-md-12">
              <div class="d-flex gap-2">
                <button class="btn btn-report-pdf flex-fill" name="export_type" value="pdf" type="submit" aria-label="Lihat Laporan Tahunan PDF">
                  <i class="las la-file-pdf fs-18" aria-hidden="true"></i>
                  <span>Lihat PDF</span>
                </button>
                <button class="btn btn-report-excel flex-fill" name="export_type" value="excel" type="submit" aria-label="Export Laporan Tahunan Excel">
                  <i class="las la-file-excel fs-18" aria-hidden="true"></i>
                  <span>Unduh Excel</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection

@section('plugins')
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/halaman/laporan.js') }}"></script>
@endsection