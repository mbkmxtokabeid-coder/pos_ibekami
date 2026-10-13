@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Daftar Kategori Invoice
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

    /* High Contrast Status Badges (§14.1) */
    .badge-dengan-harga {
      background: rgba(16, 185, 129, 0.16) !important;
      color: #6EE7B7 !important;
      border: 1px solid rgba(52, 211, 153, 0.45) !important;
      font-weight: 600 !important;
      font-size: 12px !important;
      padding: 5px 12px !important;
      border-radius: 9999px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
    }
    .badge-tanpa-harga {
      background: rgba(245, 158, 11, 0.16) !important;
      color: #FCD34D !important;
      border: 1px solid rgba(245, 158, 11, 0.45) !important;
      font-weight: 600 !important;
      font-size: 12px !important;
      padding: 5px 12px !important;
      border-radius: 9999px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
    }

    /* Action Buttons (§9.3) */
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
      border-color: #D97706 !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.35);
    }

    .btn-action-delete {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(239, 68, 68, 0.16) !important;
      border: 1.5px solid rgba(239, 68, 68, 0.4) !important;
      color: #FCA5A5 !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.15s ease;
      cursor: pointer;
      text-decoration: none;
    }
    .btn-action-delete:hover {
      background: #EF4444 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.35);
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
    .dataTables_wrapper .dt-buttons .dt-button {
      background: #1A2436 !important;
      border: 1px solid #334155 !important;
      color: #CBD5E1 !important;
      border-radius: 6px !important;
      padding: 6px 14px !important;
      font-size: 12.5px !important;
      font-weight: 500 !important;
      margin-right: 6px !important;
      transition: all 0.15s ease;
    }
    .dataTables_wrapper .dt-buttons .dt-button:hover {
      background: #334155 !important;
      color: #FFFFFF !important;
      border-color: #475569 !important;
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

    /* Dark Scrollbar */
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

    /* Modal Dark Theme Styles */
    .modal-content.tokabe-modal-dark {
      background-color: #161B22 !important;
      border: 1.5px solid #28354A !important;
      border-radius: 14px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
      overflow: hidden;
    }
    .tokabe-modal-header {
      border-bottom: 1px solid #28354A !important;
      padding: 18px 24px !important;
      background-color: #1A2436 !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-body {
      padding: 22px 24px !important;
      background-color: #151D2A !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid #28354A !important;
      padding: 16px 24px !important;
      background-color: #1A2436 !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 12px;
    }
    .tokabe-label {
      font-size: 13.5px !important;
      font-weight: 600 !important;
      color: #CBD5E1 !important;
      margin-bottom: 8px !important;
      display: block;
    }
    .tokabe-label .required-star {
      color: #F87171;
    }
    .form-control-tokabe, .form-select-tokabe {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      padding: 9px 14px !important;
      font-size: 13.5px !important;
      height: 42px !important;
      width: 100%;
      transition: all 0.15s ease;
    }
    .form-control-tokabe:focus, .form-select-tokabe:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
      color: #FFFFFF !important;
      background-color: #0B1120 !important;
      outline: none;
    }
    .form-control-tokabe::placeholder {
      color: #64748B !important;
    }
    .btn-tokabe-modal-cancel {
      background-color: #1E293B !important;
      border: 1.5px solid #334155 !important;
      color: #94A3B8 !important;
      font-weight: 500 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 18px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer;
      transition: all 0.15s ease !important;
    }
    .btn-tokabe-modal-cancel:hover {
      background-color: #334155 !important;
      color: #F8FAFC !important;
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
            <h4 class="mb-sm-0 text-white fw-bold">Kategori Invoice</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Kelola daftar klasifikasi template invoice dan aturan penetapan harga</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Kategori</a></li>
              <li class="breadcrumb-item active">Daftar Kategori</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Feedback Alerts -->
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #6EE7B7;">
        <i class="fas fa-check-circle fs-18"></i>
        <div class="flex-grow-1">{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('update'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #6EE7B7;">
        <i class="fas fa-check-circle fs-18"></i>
        <div class="flex-grow-1">{{ session('update') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('delete'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #6EE7B7;">
        <i class="fas fa-check-circle fs-18"></i>
        <div class="flex-grow-1">{{ session('delete') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Main Section Card (§12.1) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">

          <!-- Card Header with Title and Add Button -->
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <div class="tokabe-header-icon">
                <i class="las la-tags"></i>
              </div>
              <div>
                <span>Daftar Kategori</span>
                <span class="tokabe-card-subtitle">Total {{ count($invoices) }} kategori invoice terdaftar</span>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <button type="button" class="btn-tokabe-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                <i class="las la-plus fs-16"></i>
                <span>Tambah Kategori</span>
              </button>
            </div>
          </div>

          <!-- Table Container -->
          <div class="card-body p-0">
            <div class="table-responsive p-3">
              <table id="scroll-horizontal" class="table nowrap align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Nama Invoice</th>
                    <th>Kode Invoice</th>
                    <th>Perusahaan</th>
                    <th style="width: 100px; text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $invoice)
                    <tr>
                      <td class="text-center fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="fw-semibold text-white">{{ $invoice->nama_invoice }}</span>
                      </td>
                      <td>
                        <code class="px-2 py-1 rounded" style="background: #0F172A; color: #93C5FD; border: 1px solid #28354A; font-size: 12px;">{{ $invoice->kode_invoice }}</code>
                      </td>
                      <td>
                        <span class="fw-medium" style="color: #CBD5E1;">{{ $invoice->nama_perusahaan }}</span>
                      </td>
                      <td class="text-center">
                        <div class="d-inline-flex align-items-center justify-content-center gap-2">
                          <button type="button" onclick="openEditKategoriModal({{ $invoice->id }}, '{{ addslashes($invoice->nama_invoice) }}', '{{ addslashes($invoice->kode_invoice) }}', {{ $invoice->perusahaan_id }}, '{{ $invoice->tipe_harga ?? 'dengan_harga' }}')" class="btn-action-edit" title="Edit Kategori {{ $invoice->nama_invoice }}">
                            <i class="ri-pencil-line"></i>
                          </button>

                          <form action="{{ route('destroy.kategori',['id'=>$invoice->id]) }}" method="POST" id="deleteForm{{ $invoice->id }}" class="m-0 p-0 d-inline">
                            @csrf
                            @method('delete')
                            <button type="button" onclick="showConfirmation('{{ $invoice->nama_invoice }}', {{ $invoice->id }})" class="btn-action-delete" title="Hapus Kategori {{ $invoice->nama_invoice }}">
                              <i class="ri-delete-bin-6-line"></i>
                            </button>
                          </form>
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

    <!-- MODAL POPUP: TAMBAH KATEGORI INVOICE -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content tokabe-modal-dark">
          <div class="tokabe-modal-header">
            <div class="d-flex align-items-center gap-3">
              <div class="tokabe-header-icon">
                <i class="las la-plus-circle"></i>
              </div>
              <div>
                <h5 class="modal-title text-white fw-bold mb-0" id="modalTambahKategoriLabel">Tambah Kategori Invoice</h5>
                <span class="text-muted fs-12">Lengkapi form kategori baru untuk format penomoran </span>
              </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <form action="{{ route('store.kategori') }}" method="POST">
            @csrf
            <div class="tokabe-modal-body">
              <!-- Input Nama Invoice -->
              <div class="mb-3">
                <label class="tokabe-label" for="tambah_nama_invoice">
                  Nama Invoice <span class="required-star">*</span>
                </label>
                <input type="text" name="nama_invoice" id="tambah_nama_invoice" class="form-control form-control-tokabe" placeholder="Contoh: Ibekami Plakat, Tokabe Merchandise" value="{{ old('nama_invoice') }}" required>
                @error('nama_invoice')
                  <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                @enderror
              </div>

              <!-- Input Kode Invoice -->
              <div class="mb-3">
                <label class="tokabe-label" for="tambah_kode_invoice">
                  Kode Invoice (Prefix) <span class="required-star">*</span>
                </label>
                <input type="text" name="kode_invoice" id="tambah_kode_invoice" class="form-control form-control-tokabe" placeholder="Contoh: IBPL, TKB, IB" value="{{ old('kode_invoice') }}" required>
                @error('kode_invoice')
                  <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                @enderror
                <span class="text-muted fs-12 mt-1 d-block">Kode ini digunakan sebagai format penomoran invoice (contoh: INV/IBPL/2026/001).</span>
              </div>

              <!-- Input Perusahaan -->
              <div class="mb-3">
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
                <i class="las la-times fs-16"></i>
                <span>Batal</span>
              </button>
              <button type="submit" class="btn-tokabe-primary">
                <i class="ri-save-3-line fs-16"></i>
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
        <div class="modal-content tokabe-modal-dark">
          <div class="tokabe-modal-header">
            <div class="d-flex align-items-center gap-3">
              <div class="tokabe-header-icon" style="background: rgba(245, 158, 11, 0.15); border-color: rgba(245, 158, 11, 0.35); color: #FCD34D;">
                <i class="las la-pen"></i>
              </div>
              <div>
                <h5 class="modal-title text-white fw-bold mb-0" id="modalEditKategoriLabel">Edit Kategori Invoice</h5>
                <span class="text-muted fs-12" id="editKategoriSubtitle">Perbarui informasi nama invoice dan kode prefix</span>
              </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <form id="formEditKategori" action="" method="POST">
            @csrf
            @method('put')
            <div class="tokabe-modal-body">
              <!-- Input Nama Invoice -->
              <div class="mb-3">
                <label class="tokabe-label" for="edit_nama_invoice">
                  Nama Invoice <span class="required-star">*</span>
                </label>
                <input type="text" name="nama_invoice" id="edit_nama_invoice" class="form-control form-control-tokabe" placeholder="Nama Invoice" required>
              </div>

              <!-- Input Kode Invoice -->
              <div class="mb-3">
                <label class="tokabe-label" for="edit_kode_invoice">
                  Kode Invoice (Prefix) <span class="required-star">*</span>
                </label>
                <input type="text" name="kode_invoice" id="edit_kode_invoice" class="form-control form-control-tokabe" placeholder="Kode Invoice" required>
              </div>

              <!-- Input Perusahaan -->
              <div class="mb-3">
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
                <i class="las la-times fs-16"></i>
                <span>Batal</span>
              </button>
              <button type="submit" class="btn-tokabe-primary">
                <i class="ri-save-3-line fs-16"></i>
                <span>Simpan Perubahan</span>
              </button>
            </div>
          </form>
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
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('js/halaman/form-masks.js') }}"></script>
<script src="{{ asset('js/halaman/barang.js') }}"></script>

<script>
function openEditKategoriModal(id, nama, kode, perusahaanId, tipeHarga) {
  $('#formEditKategori').attr('action', '/invoice/edit-kategori/' + id);
  $('#edit_nama_invoice').val(nama);
  $('#edit_kode_invoice').val(kode);
  $('#edit_perusahaan_id').val(perusahaanId);
  $('#editKategoriSubtitle').text('ID Kategori #' + id + ' — ' + nama);
  $('#modalEditKategori').modal('show');
}

function showConfirmation(NamaInvoice, InvoiceID) {
  Swal.fire({
      title: 'Hapus Kategori?',
      text: 'Kategori "' + NamaInvoice + '" akan dihapus permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#EF4444',
      cancelButtonColor: '#334155',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
      background: '#151D2A',
      color: '#F8FAFC'
  }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('deleteForm' + InvoiceID).submit();
      }
  });
}
</script>
@endsection