@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

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
  .btn-add-inventaris {
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
  }
  .btn-add-inventaris:hover {
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    color: #FFFFFF !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
  }
  .btn-add-inventaris:active {
    transform: scale(0.98);
  }

  /* Card Section Container (§12.1) */
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

  /* Dark Table Styling (§13) */
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
    font-size: 12px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-top: none !important;
    border-bottom: 1px solid #1E293B !important;
    padding: 12px 16px !important;
    vertical-align: middle;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid #1E293B !important;
    padding: 12px 16px !important;
    font-size: 13px !important;
    vertical-align: middle;
    background-color: transparent !important;
  }
  .tokabe-table tbody tr:hover td {
    background-color: rgba(30, 41, 59, 0.45) !important;
  }

  /* SKU / Kode Badge (§8.2) */
  .badge-kode-inventaris {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
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

  /* Stok Badges */
  .badge-stock-zero {
    color: #F87171;
    background-color: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.25);
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 600;
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

  /* DataTables Styling */
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
    color: #94A3B8 !important;
    font-size: 12.5px !important;
    padding: 14px 16px !important;
  }
  .dataTables_wrapper .dataTables_paginate {
    padding: 14px 16px !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: #1E293B !important;
    color: #CBD5E1 !important;
    border: 1px solid #334155 !important;
    border-radius: 6px !important;
    margin: 0 2px !important;
    padding: 4px 10px !important;
    font-size: 12.5px !important;
    transition: all 0.15s ease;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
    border-color: #475569 !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background-color: #4F46E5 !important;
    color: #FFFFFF !important;
    border-color: #4F46E5 !important;
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

  /* Form Labels & Controls (§10.1) */
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
  .form-help-text {
    font-size: 11.5px;
    color: #64748B;
    margin-top: 4px;
    margin-bottom: 0;
  }

  /* Modal Section Dividers */
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

{{-- MODAL POPUP: TAMBAH INVENTARIS (§15.3 & §10) --}}
<div class="modal fade" id="tambahInventarisModal" tabindex="-1" aria-labelledby="tambahInventarisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="tambahInventarisModalLabel">
            <i class="las la-warehouse fs-20 text-info"></i>
            <span>Tambah Inventaris Kantor</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Isi informasi barang/peralatan operasional kantor dan catat kuantitas stoknya.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data" id="formTambahInventarisModal">
        @csrf
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Inventaris -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Identitas Inventaris</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kode Inventaris -->
            <div class="col-md-6">
              <label class="form-label-modern" for="modal-kode-inventaris">
                Kode Inventaris (SKU) <span class="required-star">*</span>
              </label>
              <input type="text" name="kode_inventaris" id="modal-kode-inventaris" class="form-control form-control-modern" placeholder="Misal: PWB, DDKHP" required>
              <p class="form-help-text">Kode penomoran unik aset/inventaris</p>
            </div>

            <!-- Jenis Inventaris -->
            <div class="col-md-6">
              <label class="form-label-modern" for="modal-jenis-inventaris">
                Jenis / Nama Inventaris <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis_inventaris" id="modal-jenis-inventaris" class="form-control form-control-modern" placeholder="Misal: Power Bank Led 2000 mAh Putih" required>
              <p class="form-help-text">Deskripsi lengkap barang inventaris</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Tanggal Pembelian -->
          <div class="modal-section-title">
            <i class="las la-calendar-check fs-16"></i>
            <span>2. Kuantitas Stok & Pembelian</span>
          </div>

          <div class="row g-3">
            <!-- Stok Inventaris -->
            <div class="col-md-6">
              <label class="form-label-modern" for="modal-stok-inventaris">
                Stok Awal <span class="required-star">*</span>
              </label>
              <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="1" id="modal-stok-inventaris" required>
              <p class="form-help-text">Jumlah unit fisik inventaris saat ini</p>
            </div>

            <!-- Tanggal Pembelian -->
            <div class="col-md-6">
              <label class="form-label-modern" for="modal-tgl-beli">
                Tanggal Pembelian <span class="required-star">*</span>
              </label>
              <input type="date" name="tgl_beli" id="modal-tgl-beli" class="form-control form-control-modern" value="{{ date('Y-m-d') }}" required>
              <p class="form-help-text">Tanggal pengadaan atau perolehan barang</p>
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
            <span>Simpan Inventaris</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT / UPDATE INVENTARIS (§15.3 & §10) --}}
<div class="modal fade" id="editInventarisModal" tabindex="-1" aria-labelledby="editInventarisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="editInventarisModalLabel">
            <i class="las la-pen-nib fs-20 text-warning"></i>
            <span>Update Stok Inventaris</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Perbarui kuantitas stok inventaris, nama deskripsi barang, atau tanggal pembelian.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data" id="formEditInventarisModal">
        @csrf
        @method('put')
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Inventaris -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Identitas Inventaris</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kode Inventaris (Readonly) -->
            <div class="col-md-6">
              <label class="form-label-modern" for="edit-kode-inventaris">
                Kode Inventaris (SKU)
              </label>
              <input type="text" id="edit-kode-inventaris" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kode penomoran unik aset tetap</p>
            </div>

            <!-- Jenis Inventaris -->
            <div class="col-md-6">
              <label class="form-label-modern" for="edit-jenis-inventaris">
                Jenis / Nama Inventaris <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis" id="edit-jenis-inventaris" class="form-control form-control-modern" placeholder="Jenis Inventaris" required>
              <p class="form-help-text">Deskripsi lengkap barang inventaris</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Tanggal Pembelian -->
          <div class="modal-section-title">
            <i class="las la-calendar-check fs-16"></i>
            <span>2. Kuantitas Stok & Pembelian</span>
          </div>

          <div class="row g-3">
            <!-- Stok Inventaris -->
            <div class="col-md-6">
              <label class="form-label-modern" for="edit-stok-inventaris">
                Stok Tersedia <span class="required-star">*</span>
              </label>
              <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-stok-inventaris" required>
              <p class="form-help-text">Jumlah unit fisik inventaris saat ini</p>
            </div>

            <!-- Tanggal Pembelian -->
            <div class="col-md-6">
              <label class="form-label-modern" for="edit-tgl-beli">
                Tanggal Pembelian <span class="required-star">*</span>
              </label>
              <input type="date" name="tgl_beli" id="edit-tgl-beli" class="form-control form-control-modern" required>
              <p class="form-help-text">Tanggal pengadaan atau perolehan barang</p>
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
            <span>Update Inventaris</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: KONFIRMASI HAPUS INVENTARIS (§15.3) --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-dark">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="inventaris_delete_id" id="inventaris_id">
        <div class="modal-danger-icon-box">
          <i class="las la-trash-alt"></i>
        </div>
        <h4 class="mb-2 text-white fw-bold" id="deleteModalLabel">Hapus Data Inventaris?</h4>
        <p class="text-muted fs-13 mb-4">
          Data inventaris ini akan dihapus secara permanen dari sistem operasional kantor. Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="hstack gap-2 justify-content-center">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
          <form id="deleteForm" action="" method="POST">
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
            <h4 class="mb-sm-0 text-white fw-bold">Inventaris Kantor</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Barang</a></li>
              <li class="breadcrumb-item active">Daftar Inventaris</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row: POPUP TRIGGER BUTTON (§9.1) -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <button type="button" class="btn btn-add-inventaris" data-bs-toggle="modal" data-bs-target="#tambahInventarisModal">
            <i class="las la-plus fs-16"></i>
            <span>Tambah Inventaris</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Table Section: Daftar Stok Inventaris (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="las la-warehouse fs-18 text-warning"></i>
              <span>Daftar Stok Inventaris</span>
            </div>
            <div class="text-muted fs-12">
              Total: <span class="fw-semibold text-white num">{{ count($inventaris) }}</span> inventaris terdaftar
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table id="alternative-pagination" class="table nowrap dt-responsive align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">No.</th>
                    <th>Kode Inventaris</th>
                    <th>Jenis Inventaris</th>
                    <th>Terakhir Update</th>
                    <th class="text-end">Stok</th>
                    <th>Tanggal Beli</th>
                    <th class="text-center" style="width: 70px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($inventaris as $inv)
                    <tr>
                      <td class="text-center text-muted num" style="font-size: 12.5px;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="badge-kode-inventaris">{{ $inv->kode_inventaris }}</span>
                      </td>
                      <td>
                        <span class="fw-semibold text-white" style="font-size: 13.5px;">{{ $inv->jenis_inventaris }}</span>
                      </td>
                      <td class="text-muted" style="font-size: 12px;">
                        {{ date('d M Y, H:i', strtotime($inv->updated_at)) }}
                      </td>
                      <td class="text-end num">
                        @if($inv->stok <= 0)
                          <span class="badge-stock-zero">0</span>
                        @else
                          <span class="fw-bold text-white">{{ $inv->stok }}</span>
                        @endif
                      </td>
                      <td class="text-muted" style="font-size: 12.5px;">
                        {{ $inv->tgl_beli ? date('d M Y', strtotime($inv->tgl_beli)) : '-' }}
                      </td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                            <i class="las la-ellipsis-h fs-16"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button type="button" class="dropdown-item btn-edit-inventaris"
                                data-id="{{ $inv->id }}"
                                data-kode="{{ $inv->kode_inventaris }}"
                                data-jenis="{{ $inv->jenis_inventaris }}"
                                data-stok="{{ $inv->stok }}"
                                data-tgl="{{ $inv->tgl_beli ? date('Y-m-d', strtotime($inv->tgl_beli)) : '' }}"
                                data-action="{{ url('/update-stokInventaris/'.$inv->id) }}">
                                <i class="las la-pen fs-16 text-warning"></i>
                                <span>Update Stock</span>
                              </button>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <button type="button" class="dropdown-item dropdown-item--danger btn-delete-inventaris"
                                data-id="{{ $inv->id }}"
                                data-action="{{ url('/deleteInventaris/'.$inv->id) }}">
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>

<script>
  // Pindahkan modal langsung ke elemen <body> agar terbebas dari stacking context .main-content
  $(document).ready(function() {
      $('#tambahInventarisModal').appendTo('body');
      $('#editInventarisModal').appendTo('body');
      $('#deleteModal').appendTo('body');
  });

  // Inisialisasi Cleave.js mask pada input modal tambah
  let modalCleaveInvStok;
  $('#tambahInventarisModal').on('shown.bs.modal', function () {
      if (typeof Cleave !== 'undefined') {
          if (!modalCleaveInvStok && document.querySelector('#modal-stok-inventaris')) {
              modalCleaveInvStok = new Cleave('#modal-stok-inventaris', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
      setTimeout(function() {
          $('#modal-kode-inventaris').focus();
      }, 50);
  });

  // Reset form saat modal tambah ditutup
  $('#tambahInventarisModal').on('hidden.bs.modal', function () {
      $('#formTambahInventarisModal')[0].reset();
      if (modalCleaveInvStok) modalCleaveInvStok.setRawValue('1');
  });

  // Inisialisasi Cleave.js mask pada input modal update
  let editCleaveInvStok;
  function initEditInventarisCleave() {
      if (typeof Cleave !== 'undefined') {
          if (!editCleaveInvStok && document.querySelector('#edit-stok-inventaris')) {
              editCleaveInvStok = new Cleave('#edit-stok-inventaris', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
  }

  // Event handler untuk tombol Edit/Update Inventaris (delegated untuk DataTables pagination)
  $(document).on('click', '.btn-edit-inventaris', function() {
      initEditInventarisCleave();

      const id = $(this).data('id');
      const kode = $(this).data('kode');
      const jenis = $(this).data('jenis');
      const stok = $(this).data('stok');
      const tgl = $(this).data('tgl');

      let action = $(this).data('action') || ("{{ url('/update-stokInventaris') }}/" + id);
      if (window.location.pathname.startsWith('/invoice') && !action.includes('/invoice')) {
          action = window.location.origin + '/invoice/update-stokInventaris/' + id;
      }

      $('#formEditInventarisModal').attr('action', action);
      $('#edit-kode-inventaris').val(kode || '');
      $('#edit-jenis-inventaris').val(jenis || '');
      $('#edit-tgl-beli').val(tgl || '');

      if (editCleaveInvStok) {
          editCleaveInvStok.setRawValue(String(stok !== undefined ? stok : 0));
      } else {
          $('#edit-stok-inventaris').val(stok || 0);
      }

      $('#editInventarisModal').modal('show');
  });

  $('#editInventarisModal').on('shown.bs.modal', function () {
      setTimeout(function() {
          $('#edit-jenis-inventaris').focus();
      }, 50);
  });

  // Event handler untuk tombol Hapus Inventaris (delegated untuk DataTables pagination)
  $(document).on('click', '.btn-delete-inventaris', function() {
      const id = $(this).data('id');
      let action = $(this).data('action') || ("{{ url('/deleteInventaris') }}/" + id);
      if (window.location.pathname.startsWith('/invoice') && !action.includes('/invoice')) {
          action = window.location.origin + '/invoice/deleteInventaris/' + id;
      }

      $('#deleteForm').attr('action', action);
      $('#inventaris_id').val(id);
      $('#deleteModal').modal('show');
  });
</script>
@endsection