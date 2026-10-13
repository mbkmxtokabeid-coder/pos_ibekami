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
  .btn-add-material {
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
  .btn-add-material:hover {
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
    color: #FFFFFF !important;
  }
  .btn-add-material:active {
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

  /* Kode Material Badge (Mono) */
  .badge-kode-material {
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

  /* Satuan Pill */
  .badge-satuan-pill {
    background-color: rgba(148, 163, 184, 0.12);
    color: #94A3B8;
    border: 1px solid rgba(148, 163, 184, 0.2);
    padding: 2px 7px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 4px;
    display: inline-block;
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

  /* Modals Z-Index and Styling (§15.3 & §10) */
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

  /* Modal Delete Danger Specific */
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

{{-- MODAL POPUP: TAMBAH MATERIAL (§15.3 & §10) --}}
<div class="modal fade" id="tambahMaterialModal" tabindex="-1" aria-labelledby="tambahMaterialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="tambahMaterialModalLabel">
            <i class="las la-boxes fs-20 text-info"></i>
            <span>Tambah Material Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Isi data bahan/material baru untuk kebutuhan kalkulasi dan inventori produksi.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data" id="formTambahMaterialModal">
        @csrf
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Material -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Informasi Material</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kode Material -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-kode-material">
                Kode Material <span class="required-star">*</span>
              </label>
              <input type="text" name="kode_material" id="modal-kode-material" class="form-control form-control-modern" placeholder="Misal: CML-01" required>
              <p class="form-help-text">Kode unik SKU material</p>
            </div>

            <!-- Jenis Material -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-jenis-material">
                Jenis / Nama Material <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis_material" id="modal-jenis-material" class="form-control form-control-modern" placeholder="Misal: Stiker Camel High Gloss" required>
              <p class="form-help-text">Deskripsi spesifik jenis material</p>
            </div>

            <!-- Satuan -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-satuan">
                Satuan Ukuran <span class="required-star">*</span>
              </label>
              <select name="satuan" id="modal-satuan" class="form-select form-select-modern" required>
                <option value="" selected disabled>Pilih Satuan</option>
                <option value="mtr">mtr (Meter)</option>
                <option value="pcs">pcs (Pieces)</option>
                <option value="mm">mm (Milimeter)</option>
                <option value="lembar">lembar (Lembar)</option>
                <option value="cm">cm (Centimeter)</option>
                <option value="cm²">cm² (Centimeter Persegi)</option>
              </select>
              <p class="form-help-text">Satuan takaran kalkulasi</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Skema Harga -->
          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Kuantitas Stok & Harga</span>
          </div>

          <div class="row g-3">
            <!-- Stok Material -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-stok-material">
                Stok Awal <span class="required-star">*</span>
              </label>
              <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-stok-material" required>
              <p class="form-help-text">Kuantitas stok fisik di gudang</p>
            </div>

            <!-- Harga Modal (HPP) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="modal-harga-modal">
                Harga Modal (HPP) <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="0" id="modal-harga-modal" required>
              </div>
              <p class="form-help-text">Biaya perolehan dari vendor</p>
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
              <p class="form-help-text">Harga tarif jual dasar</p>
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
            <span>Simpan Material</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT / UPDATE MATERIAL (§15.3 & §10) --}}
<div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="editMaterialModalLabel">
            <i class="las la-pen-nib fs-20 text-warning"></i>
            <span>Update Stok Material</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Perbarui kuantitas stok material, satuan ukuran, atau penyesuaian harga jual dan modal.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data" id="formEditMaterialModal">
        @csrf
        @method('put')
        <div class="tokabe-modal-body">

          <!-- Seksi 1: Informasi Material -->
          <div class="modal-section-title">
            <i class="las la-info-circle fs-16"></i>
            <span>1. Informasi Material</span>
          </div>

          <div class="row g-3 mb-4">
            <!-- Kode Material (Readonly) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-kode-material">
                Kode Material (SKU)
              </label>
              <input type="text" id="edit-kode-material" class="form-control form-control-modern" readonly>
              <p class="form-help-text">Kode unik SKU material tetap</p>
            </div>

            <!-- Jenis Material -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-jenis-material">
                Jenis / Nama Material <span class="required-star">*</span>
              </label>
              <input type="text" name="jenis" id="edit-jenis-material" class="form-control form-control-modern" placeholder="Jenis Material" required>
              <p class="form-help-text">Deskripsi spesifik jenis material</p>
            </div>

            <!-- Satuan -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-satuan">
                Satuan Ukuran <span class="required-star">*</span>
              </label>
              <select name="satuan" id="edit-satuan" class="form-select form-select-modern" required>
                <option value="" disabled>Pilih Satuan</option>
                <option value="mtr">mtr (Meter)</option>
                <option value="pcs">pcs (Pieces)</option>
                <option value="mm">mm (Milimeter)</option>
                <option value="lembar">lembar (Lembar)</option>
                <option value="cm">cm (Centimeter)</option>
                <option value="cm²">cm² (Centimeter Persegi)</option>
              </select>
              <p class="form-help-text">Satuan takaran inventori</p>
            </div>
          </div>

          <!-- Seksi 2: Stok & Skema Harga -->
          <div class="modal-section-title">
            <i class="las la-tags fs-16"></i>
            <span>2. Kuantitas Stok & Harga</span>
          </div>

          <div class="row g-3">
            <!-- Stok Material -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-stok-material">
                Stok Tersedia <span class="required-star">*</span>
              </label>
              <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-stok-material" required>
              <p class="form-help-text">Jumlah fisik stok terkini di gudang</p>
            </div>

            <!-- Harga Modal (HPP) -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-harga-modal">
                Harga Modal (HPP) <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_modal" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-harga-modal" required>
              </div>
              <p class="form-help-text">Biaya perolehan dari vendor</p>
            </div>

            <!-- Harga Jual -->
            <div class="col-md-4">
              <label class="form-label-modern" for="edit-harga-jual">
                Harga Jual <span class="required-star">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-addon-modern">Rp</span>
                <input name="harga_jual" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" id="edit-harga-jual" required>
              </div>
              <p class="form-help-text">Harga tarif jual dasar</p>
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
            <span>Update Material</span>
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
        <input type="hidden" name="material_delete_id" id="material_id">
        <div class="modal-danger-icon-box">
          <i class="las la-trash-alt"></i>
        </div>
        <h4 class="mb-2 text-white fw-bold" id="deleteModalLabel">Hapus Data Material?</h4>
        <p class="text-muted fs-13 mb-4">
          Data material ini akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="hstack gap-2 justify-content-center">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
          <form id="deleteForm" action="{{ url('/deleteMaterial') }}" method="POST">
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
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Material</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Material</a></li>
              <li class="breadcrumb-item active">Daftar Material</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Action Row (§9.1): POPUP TRIGGER BUTTON -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <button type="button" class="btn btn-add-material" data-bs-toggle="modal" data-bs-target="#tambahMaterialModal">
            <i class="las la-plus fs-16"></i>
            <span>Tambah Material</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Table Section: Daftar Stok Material (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="las la-boxes fs-18 text-warning"></i>
              <span>Daftar Stok Material</span>
            </div>
            <div class="text-muted fs-12">
              Total: <span class="fw-semibold text-white num">{{ count($material) }}</span> material terdaftar
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table id="alternative-pagination" class="table nowrap dt-responsive align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">No.</th>
                    <th>Kode Material</th>
                    <th>Jenis Material</th>
                    <th>Terakhir Update</th>
                    <th class="text-end">Stok</th>
                    <th class="text-end">Harga Modal</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center" style="width: 70px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($material as $mtr)
                    <tr>
                      <td class="text-center text-muted num" style="font-size: 12.5px;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="badge-kode-material">{{ $mtr->kode_material }}</span>
                      </td>
                      <td>
                        <span class="fw-semibold text-white" style="font-size: 13.5px;">{{ $mtr->jenis_material }}</span>
                      </td>
                      <td class="text-muted" style="font-size: 12px;">
                        {{ date('d M Y, H:i', strtotime($mtr->updated_at)) }}
                      </td>
                      <td class="text-end num">
                        @if($mtr->stok <= 0)
                          <span class="badge-stock-zero">0</span>
                        @else
                          <span class="fw-bold text-white">{{ $mtr->stok }}</span>
                        @endif
                        @if($mtr->satuan)
                          <span class="badge-satuan-pill">{{ $mtr->satuan }}</span>
                        @endif
                      </td>
                      <td class="text-end num price text-muted">
                        Rp {{ $mtr->formattedModal }}
                      </td>
                      <td class="text-end num price fw-bold text-white">
                        Rp {{ $mtr->formattedJual }}
                      </td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                            <i class="las la-ellipsis-h fs-16"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button type="button" class="dropdown-item btn-edit-material"
                                data-id="{{ $mtr->id }}"
                                data-kode="{{ $mtr->kode_material }}"
                                data-jenis="{{ $mtr->jenis_material }}"
                                data-satuan="{{ $mtr->satuan }}"
                                data-stok="{{ $mtr->stok }}"
                                data-modal="{{ $mtr->harga_modal }}"
                                data-jual="{{ $mtr->harga_jual }}"
                                data-action="{{ url('/update-stokMaterial/'.$mtr->id) }}">
                                <i class="las la-pen fs-16 text-warning"></i>
                                <span>Update Stock</span>
                              </button>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                              <button type="button" class="dropdown-item dropdown-item--danger hapus-btn remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $mtr->id }}">
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
<script src="{{ asset('js/halaman/material.js') }}"></script>

<script>
  // Pindahkan modal langsung ke elemen <body> agar terbebas dari stacking context
  $(document).ready(function() {
      $('#tambahMaterialModal').appendTo('body');
      $('#editMaterialModal').appendTo('body');
      $('#deleteModal').appendTo('body');
  });

  // Inisialisasi Cleave.js mask pada input modal tambah
  let modalCleaveMtrStok, modalCleaveMtrModal, modalCleaveMtrJual;
  $('#tambahMaterialModal').on('shown.bs.modal', function () {
      if (typeof Cleave !== 'undefined') {
          if (!modalCleaveMtrStok && document.querySelector('#modal-stok-material')) {
              modalCleaveMtrStok = new Cleave('#modal-stok-material', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!modalCleaveMtrModal && document.querySelector('#modal-harga-modal')) {
              modalCleaveMtrModal = new Cleave('#modal-harga-modal', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!modalCleaveMtrJual && document.querySelector('#modal-harga-jual')) {
              modalCleaveMtrJual = new Cleave('#modal-harga-jual', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
      setTimeout(function() {
          $('#modal-kode-material').focus();
      }, 50);
  });

  // Reset form saat modal tambah ditutup
  $('#tambahMaterialModal').on('hidden.bs.modal', function () {
      $('#formTambahMaterialModal')[0].reset();
      if (modalCleaveMtrStok) modalCleaveMtrStok.setRawValue('0');
      if (modalCleaveMtrModal) modalCleaveMtrModal.setRawValue('0');
      if (modalCleaveMtrJual) modalCleaveMtrJual.setRawValue('0');
  });

  // Inisialisasi Cleave.js mask pada input modal update
  let editCleaveMtrStok, editCleaveMtrModal, editCleaveMtrJual;
  function initEditMaterialCleave() {
      if (typeof Cleave !== 'undefined') {
          if (!editCleaveMtrStok && document.querySelector('#edit-stok-material')) {
              editCleaveMtrStok = new Cleave('#edit-stok-material', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!editCleaveMtrModal && document.querySelector('#edit-harga-modal')) {
              editCleaveMtrModal = new Cleave('#edit-harga-modal', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
          if (!editCleaveMtrJual && document.querySelector('#edit-harga-jual')) {
              editCleaveMtrJual = new Cleave('#edit-harga-jual', { numeral: true, numeralThousandsGroupStyle: 'thousand' });
          }
      }
  }

  // Event handler untuk tombol Edit/Update Material (delegated untuk DataTables pagination)
  $(document).on('click', '.btn-edit-material', function() {
      initEditMaterialCleave();

      const id = $(this).data('id');
      const kode = $(this).data('kode');
      const jenis = $(this).data('jenis');
      const satuan = $(this).data('satuan');
      const stok = $(this).data('stok');
      const modal = $(this).data('modal');
      const jual = $(this).data('jual');
      const action = $(this).data('action') || ("{{ url('/update-stokMaterial') }}/" + id);

      $('#formEditMaterialModal').attr('action', action);
      $('#edit-kode-material').val(kode || '');
      $('#edit-jenis-material').val(jenis || '');
      $('#edit-satuan').val(satuan || '');

      if (editCleaveMtrStok) {
          editCleaveMtrStok.setRawValue(String(stok !== undefined ? stok : 0));
      } else {
          $('#edit-stok-material').val(stok || 0);
      }

      if (editCleaveMtrModal) {
          editCleaveMtrModal.setRawValue(String(modal !== undefined ? modal : 0));
      } else {
          $('#edit-harga-modal').val(modal || 0);
      }

      if (editCleaveMtrJual) {
          editCleaveMtrJual.setRawValue(String(jual !== undefined ? jual : 0));
      } else {
          $('#edit-harga-jual').val(jual || 0);
      }

      $('#editMaterialModal').modal('show');
  });

  $('#editMaterialModal').on('shown.bs.modal', function () {
      setTimeout(function() {
          $('#edit-jenis-material').focus();
      }, 50);
  });
</script>
@endsection