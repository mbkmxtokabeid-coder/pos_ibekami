@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
  /* ==========================================================================
     DESIGN SYSTEM TOKENS & OVERRIDES (DESIGN.md)
     Dark Slate Palette (#020617, #0F172A, #161B22, #1E293B, #334155)
     ========================================================================== */

  .num, .numeric, input.numeric {
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

  /* Section Card Container (§12.1) */
  .tokabe-form-card {
    background: #161B22 !important;
    border: 1px solid #1E293B !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    margin-bottom: 24px;
    overflow: hidden;
  }
  .tokabe-form-header {
    background: transparent !important;
    border-bottom: 1px solid #1E293B !important;
    padding: 20px 24px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .tokabe-form-title {
    font-size: 16px;
    font-weight: 600;
    color: #F1F5F9;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .tokabe-form-subtitle {
    font-size: 13px;
    color: #94A3B8;
    margin-top: 4px;
    margin-bottom: 0;
  }

  /* Section Dividers within Form (§10.5) */
  .form-section-title {
    font-size: 11.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #818CF8;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .form-section-title::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #1E293B;
  }

  /* Form Labels (§10.1) */
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

  /* Modern Dark Inputs (§10.1) */
  .form-control-modern {
    background-color: #0F172A !important;
    border: 1px solid #334155 !important;
    color: #F1F5F9 !important;
    border-radius: 8px !important;
    height: 42px !important;
    font-size: 13.5px !important;
    padding: 8px 14px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .form-control-modern::placeholder {
    color: #64748B !important;
  }
  .form-control-modern:hover:not(:disabled) {
    border-color: #475569 !important;
  }
  .form-control-modern:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    outline: none !important;
    background-color: #0F172A !important;
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

  /* Form Action Buttons (§9) */
  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 9px 20px !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s ease;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #F1F5F9 !important;
    border-color: #475569 !important;
  }
  .btn-form-submit {
    background-color: #D97706 !important;
    border: 1px solid #D97706 !important;
    color: #FFFFFF !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 9px 24px !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  }
  .btn-form-submit:hover {
    background-color: #B45309 !important;
    border-color: #B45309 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(217, 119, 6, 0.35);
  }
  .btn-form-submit:active {
    transform: scale(0.98);
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
            <h4 class="mb-sm-0 text-white fw-bold">Update Stok Inventaris</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('listInventaris') }}">Inventaris</a></li>
              <li class="breadcrumb-item active">Update Stok Inventaris</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Container Card (§12.1 & §10) -->
    <div class="row justify-content-center">
      <div class="col-xxl-10 col-xl-11">
        <div class="tokabe-form-card">
          <div class="tokabe-form-header">
            <div>
              <h5 class="tokabe-form-title">
                <i class="las la-pen-nib fs-20 text-warning"></i>
                <span>Edit Informasi & Stok Inventaris</span>
              </h5>
              <p class="tokabe-form-subtitle">
                Perbarui kuantitas stok inventaris, nama deskripsi barang, atau tanggal pembelian.
              </p>
            </div>
            <a href="{{ url('listInventaris') }}" class="btn-form-cancel">
              <i class="las la-arrow-left"></i>
              <span>Kembali</span>
            </a>
          </div>

          <!-- Form Body -->
          <form action="{{ url('/update-stokInventaris/'.$inventaris->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="p-4">

              <!-- Seksi 1: Identitas Inventaris -->
              <div class="form-section-title">
                <i class="las la-info-circle fs-16"></i>
                <span>1. Identitas Inventaris</span>
              </div>

              <div class="row g-3 mb-4">
                <!-- Kode Inventaris (Readonly) -->
                <div class="col-md-6">
                  <label class="form-label-modern">Kode Inventaris (SKU)</label>
                  <input type="text" class="form-control form-control-modern" value="{{ $inventaris->kode_inventaris }}" readonly>
                  <p class="form-help-text">Kode penomoran unik aset tetap</p>
                </div>

                <!-- Jenis Inventaris -->
                <div class="col-md-6">
                  <label class="form-label-modern" for="jenis">
                    Jenis / Nama Inventaris <span class="required-star">*</span>
                  </label>
                  <input type="text" name="jenis" id="jenis" class="form-control form-control-modern" value="{{ $inventaris->jenis_inventaris }}" placeholder="Jenis Inventaris" required>
                  <p class="form-help-text">Deskripsi lengkap barang inventaris</p>
                </div>
              </div>

              <!-- Seksi 2: Kuantitas Stok & Pembelian -->
              <div class="form-section-title">
                <i class="las la-calendar-check fs-16"></i>
                <span>2. Kuantitas Stok & Pembelian</span>
              </div>

              <div class="row g-3 mb-2">
                <!-- Stok Inventaris -->
                <div class="col-md-6">
                  <label class="form-label-modern" for="cleave-numeral">
                    Stok Tersedia <span class="required-star">*</span>
                  </label>
                  <input name="stok" type="text" class="form-control form-control-modern numeric text-end" placeholder="0" value="{{ $inventaris->stok }}" id="cleave-numeral" required>
                  <p class="form-help-text">Jumlah unit fisik inventaris saat ini</p>
                </div>

                <!-- Tanggal Pembelian -->
                <div class="col-md-6">
                  <label class="form-label-modern" for="dateInput">
                    Tanggal Pembelian <span class="required-star">*</span>
                  </label>
                  <input type="date" name="tgl_beli" id="dateInput" class="form-control form-control-modern" value="{{ $inventaris->tgl_beli }}" required>
                  <p class="form-help-text">Tanggal pengadaan atau perolehan barang</p>
                </div>
              </div>

            </div>

            <!-- Form Footer -->
            <div class="px-4 py-3 border-top border-dark d-flex justify-content-between align-items-center" style="background-color: rgba(15, 23, 42, 0.4); border-color: #1E293B !important;">
              <a href="{{ url('listInventaris') }}" class="btn-form-cancel">
                <i class="las la-times"></i>
                <span>Batal</span>
              </a>
              <button type="submit" class="btn btn-form-submit">
                <i class="las la-save fs-16"></i>
                <span>Update Inventaris</span>
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
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script>
  if (typeof Cleave !== 'undefined' && document.querySelector('#cleave-numeral')) {
    new Cleave('#cleave-numeral', {
      numeral: true,
      numeralThousandsGroupStyle: 'thousand'
    });
  }
</script>
@endsection