@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<style>
  /* ==========================================================================
     DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
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

  /* Top Action Buttons & Search Box */
  .btn-add-spb {
    background-color: #4F46E5 !important;
    border: 1.5px solid #6366F1 !important;
    color: #FFFFFF !important;
    font-weight: 600;
    font-size: 13.5px;
    padding: 9px 20px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.35);
    text-decoration: none;
  }
  .btn-add-spb:hover {
    background-color: #4338CA !important;
    border-color: #818CF8 !important;
    color: #FFFFFF !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.45);
  }
  .btn-add-spb:focus-visible {
    outline: 2px solid #A5B4FC !important;
    outline-offset: 2px;
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
  .icon-box-sky {
    background-color: rgba(56, 189, 248, 0.16);
    color: #38BDF8;
    border: 1.5px solid rgba(56, 189, 248, 0.4);
  }
  .icon-box-emerald {
    background-color: rgba(16, 185, 129, 0.16);
    color: #34D399;
    border: 1.5px solid rgba(16, 185, 129, 0.4);
  }
  .icon-box-rose {
    background-color: rgba(244, 63, 94, 0.16);
    color: #FB7185;
    border: 1.5px solid rgba(244, 63, 94, 0.4);
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

  /* High-Visibility Table Styles (§13) */
  .tokabe-table {
    background-color: #151D2A !important;
    color: #E2E8F0 !important;
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
  }
  .tokabe-table thead th {
    background-color: #101726 !important;
    color: #CBD5E1 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-top: none !important;
    border-bottom: 2px solid #28354A !important;
    padding: 13px 16px !important;
    vertical-align: middle;
    white-space: nowrap;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid #222D3F !important;
    padding: 14px 16px !important;
    font-size: 13.5px !important;
    vertical-align: middle;
    background-color: transparent !important;
    color: #E2E8F0 !important;
  }
  .tokabe-table tbody tr:hover td {
    background-color: #1E293B !important;
  }
  .tokabe-table tbody tr:last-child td {
    border-bottom: none !important;
  }

  /* Status Badges */
  .badge-status-delivered {
    background: rgba(16, 185, 129, 0.2);
    color: #6EE7B7 !important;
    border: 1.5px solid rgba(52, 211, 153, 0.45);
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-status-undelivered {
    background: rgba(245, 158, 11, 0.2);
    color: #FDE047 !important;
    border: 1.5px solid rgba(251, 191, 36, 0.45);
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-perusahaan-spb {
    font-size: 12.5px;
    font-weight: 700;
    color: #38BDF8 !important;
    background: rgba(56, 189, 248, 0.12);
    border: 1.5px solid rgba(56, 189, 248, 0.35);
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Action Ghost Button & Dropdown */
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

  /* DataTables Dark Theme Overrides */
  .dataTables_wrapper {
    color: #CBD5E1 !important;
    padding: 16px 20px;
  }
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter,
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_paginate {
    color: #CBD5E1 !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper .dataTables_length select {
    background-color: #0B1120 !important;
    border: 1.5px solid #3B4B66 !important;
    color: #F8FAFC !important;
    border-radius: 6px !important;
    padding: 4px 10px !important;
    margin: 0 6px !important;
  }
  .dataTables_wrapper .dataTables_filter input {
    background-color: #0B1120 !important;
    border: 1.5px solid #3B4B66 !important;
    color: #F8FAFC !important;
    border-radius: 6px !important;
    padding: 6px 12px !important;
    margin-left: 8px !important;
    outline: none !important;
  }
  .dataTables_wrapper .dataTables_filter input:focus {
    border-color: #6366F1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #CBD5E1 !important;
    border-radius: 6px !important;
    border: 1px solid transparent !important;
    padding: 5px 10px !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #4F46E5 !important;
    border-color: #6366F1 !important;
    color: #FFFFFF !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #1E293B !important;
    color: #FFFFFF !important;
    border-color: #334155 !important;
  }

  /* Modal Dark Theme */
  .tokabe-modal-content {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    color: #F8FAFC !important;
  }
  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #E2E8F0 !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    padding: 8px 18px !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
  }
</style>
@endsection

@extends('layout.template')

@section('content')
<!-- Delete Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-content p-3">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="spb_delete_id" id="spb_id">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45);">
          <i class="las la-trash-alt fs-32 text-danger"></i>
        </div>
        <h5 class="text-white fw-bold mb-2">Hapus Surat Pengantar Barang (SPB)?</h5>
        <p class="fs-13 mb-4" style="color: #CBD5E1;">
          Apakah Anda yakin ingin menghapus data SPB ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-form-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <form id="deleteForm" action="{{ url('delete-spb') }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="border-radius: 8px;">
              <i class="las la-trash-alt fs-16"></i>
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

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Daftar SPB (Surat Pengantar Barang)</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">SPB</a></li>
              <li class="breadcrumb-item active">Daftar SPB</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <a href="{{ url('tambah-spb') }}" class="btn-add-spb" aria-label="Tambah SPB Baru">
            <i class="las la-plus fs-18"></i>
            <span>Tambah SPB</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Summary KPI Cards (§12.4) -->
    <div class="row g-3 mb-4">
      <!-- KPI 1: SPB Dibuat -->
      <div class="col-xl-4 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TOTAL SPB DIBUAT</div>
              <h4 class="kpi-amount text-white num" aria-label="Total SPB: {{ $jumlahspb }}">
                <span class="counter-value" data-target="{{ $jumlahspb }}">0</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-sky" aria-hidden="true">
              <i class="las la-file-alt"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 2: SPB Telah Diantar -->
      <div class="col-xl-4 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">SPB TELAH DIANTAR</div>
              <h4 class="kpi-amount num" style="color: #34D399;" aria-label="SPB Telah Diantar: {{ $jumlahSelesai }}">
                <span class="counter-value" data-target="{{ $jumlahSelesai }}">0</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="las la-check-square"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 3: SPB Belum Diantar -->
      <div class="col-xl-4 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">SPB BELUM DIANTAR</div>
              <h4 class="kpi-amount num" style="color: #FB7185;" aria-label="SPB Belum Diantar: {{ $jumlahBelumSelesai }}">
                <span class="counter-value" data-target="{{ $jumlahBelumSelesai }}">0</span>
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="las la-clock"></i>
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
              <i class="ri-file-list-3-line fs-20" style="color: #38BDF8;" aria-hidden="true"></i>
              <span>Riwayat Surat Pengantar Barang (SPB)</span>
            </div>
            <div class="fs-13" style="color: #CBD5E1;">
              Total: <span class="fw-bold text-white num">{{ count($spb) }}</span> data transaksi
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0 tokabe-table" id="alternative-pagination" aria-label="Tabel Riwayat SPB">
                <thead>
                  <tr>
                    <th scope="col" class="text-center" style="width: 55px;">NO.</th>
                    <th scope="col">PENGANTAR BARANG</th>
                    <th scope="col" class="text-center">TANGGAL ANTAR</th>
                    <th scope="col" style="min-width: 170px;">CUSTOMER</th>
                    <th scope="col" style="min-width: 190px;">PERUSAHAAN</th>
                    <th scope="col">NO. TELEPON</th>
                    <th scope="col" class="text-center">STATUS</th>
                    <th scope="col" class="text-center" style="width: 80px;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($spb as $value)
                    <tr>
                      <td class="text-center num fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="badge-perusahaan-spb">
                          @if($value->nama_spb == 1)
                            Ikhtiar Berkah
                          @else
                            Total Karya Berkah
                          @endif
                        </span>
                      </td>
                      <td class="text-center fw-medium num" style="color: #CBD5E1;">
                        {{ $value->created_at->isoFormat('DD MMMM YYYY') }}
                      </td>
                      <td>
                        <span class="fw-bold text-white">{{ $value->customer }}</span>
                      </td>
                      <td>
                        <span class="fw-medium" style="color: #E2E8F0;">{{ $value->perusahaan }}</span>
                      </td>
                      <td>
                        <span class="num fw-medium" style="color: #CBD5E1;">{{ $value->nomor_telepon ?: '-' }}</span>
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
                            <i class="ri-more-fill fs-18" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            @if($value->status == "Belum diantar")
                              <li>
                                <a class="dropdown-item text-success" href="{{ route('spb.ubah-status', $value->id) }}">
                                  <i class="las la-check-square fs-16 text-success" aria-hidden="true"></i>
                                  <span>Tandai Sudah Diantar</span>
                                </a>
                              </li>
                            @endif
                            <li>
                              <a class="dropdown-item" target="_blank" href="{{ url('cetak-spb/'.$value->id) }}">
                                <i class="las la-print fs-16 text-info" aria-hidden="true"></i>
                                <span>Cetak SPB</span>
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ url('edit-spb/'.$value->id) }}">
                                <i class="las la-pen fs-16 text-primary" aria-hidden="true"></i>
                                <span>Edit SPB</span>
                              </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" value="{{ $value->id }}" data-url="{{ url('delete-spb/'.$value->id) }}" class="dropdown-item dropdown-item--danger hapus-btn">
                                <i class="las la-trash-alt fs-16 text-danger" aria-hidden="true"></i>
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

  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/spb.js') }}"></script>
@endsection