@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
  /* ==========================================================================
     DESIGN SYSTEM TOKENS & OVERRIDES (DESIGN.md)
     Dark Slate Palette (#020617, #0F172A, #161B22, #1E293B, #334155)
     ========================================================================== */

  .num, .price, .numeric, input.numeric {
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
  .form-control-modern,
  .form-select-modern {
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
  .form-control-modern:hover:not(:disabled),
  .form-select-modern:hover:not(:disabled) {
    border-color: #475569 !important;
  }
  .form-control-modern:focus,
  .form-select-modern:focus {
    border-color: #4F46E5 !important;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25) !important;
    outline: none !important;
    background-color: #0F172A !important;
  }
  .form-control-modern:disabled,
  .form-control-modern[readonly] {
    background-color: rgba(30, 41, 59, 0.35) !important;
    color: #94A3B8 !important;
    border-color: #1E293B !important;
    cursor: default;
  }

  /* Input Group Addons (Rp, Pcs) (§10.2) */
  .input-group-addon-modern {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #94A3B8 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 0 14px !important;
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

  /* Form Helper Text */
  .form-help-text {
    font-size: 12px;
    color: #64748B;
    margin-top: 5px;
    margin-bottom: 0;
  }
  .error-help-block {
    color: #EF4444 !important;
    font-size: 12px !important;
    margin-top: 5px !important;
  }

  /* Form Footer Action Buttons (§9) */
  .form-actions-footer {
    border-top: 1px solid #1E293B;
    background: rgba(15, 23, 42, 0.5);
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
  }
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
    background-color: #4F46E5 !important;
    border: 1px solid #4F46E5 !important;
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
    background-color: #4338CA !important;
    border-color: #4338CA !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
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
            <h4 class="mb-sm-0 text-white fw-bold">Update Stok Barang</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('listBarang') }}">Barang</a></li>
              <li class="breadcrumb-item active">Update Stok Barang</li>
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
                <span>Edit Informasi & Stok Barang</span>
              </h5>
              <p class="tokabe-form-subtitle">
                Perbarui kuantitas stok barang, varian jenis, atau penyesuaian harga jual dan modal.
              </p>
            </div>
            <a href="{{ url('listBarang') }}" class="btn-form-cancel">
              <i class="las la-arrow-left"></i>
              <span>Kembali</span>
            </a>
          </div>

          <!-- Form Body -->
          <form action="/invoice/update-stok/{{ $barang->id }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('put')
            <div class="p-4">

              <!-- Seksi 1: Identitas Produk -->
              <div class="form-section-title">
                <i class="las la-info-circle fs-16"></i>
                <span>1. Identitas Produk</span>
              </div>

              <div class="row g-3 mb-4">
                <!-- Item / Kategori (Readonly) -->
                <div class="col-md-4">
                  <label class="form-label-modern">Kategori Item</label>
                  <input type="text" class="form-control form-control-modern" value="{{ $kategori }}" readonly>
                  <p class="form-help-text">Kategori produk telah ditetapkan</p>
                </div>

                <!-- Kode Barang (Readonly) -->
                <div class="col-md-4">
                  <label class="form-label-modern">Kode Barang (SKU)</label>
                  <input type="text" class="form-control form-control-modern" value="{{ $barang->kode_barang }}" readonly>
                  <p class="form-help-text">Kode unik SKU barang di inventori</p>
                </div>

                <!-- Jenis Barang (Editable) -->
                <div class="col-md-4">
                  <label class="form-label-modern">
                    Jenis / Nama Barang <span class="required-star">*</span>
                  </label>
                  <input type="text" class="form-control form-control-modern" value="{{ $barang->jenis_barang }}" name="jenis" placeholder="Jenis Barang" required>
                  <p class="form-help-text">Nama atau varian barang yang tertera pada nota</p>
                </div>
              </div>

              <!-- Seksi 2: Stok & Skema Harga -->
              <div class="form-section-title">
                <i class="las la-tags fs-16"></i>
                <span>2. Kuantitas Stok & Harga</span>
              </div>

              <div class="row g-3 mb-2">
                <!-- Stok Barang -->
                <div class="col-md-4">
                  <label class="form-label-modern">
                    Stok Tersedia <span class="required-star">*</span>
                  </label>
                  <div class="input-group">
                    <input type="text" name="stok" class="form-control form-control-modern numeric text-end" placeholder="0" value="{{ $barang->stok }}" id="cleave-numeral" required>
                    <span class="input-group-addon-modern">Pcs</span>
                  </div>
                  <p class="form-help-text">Jumlah fisik stok terkini di toko/gudang</p>
                </div>

                <!-- Harga Modal (HPP) -->
                <div class="col-md-4">
                  <label class="form-label-modern">
                    Harga Modal (HPP) <span class="required-star">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon-modern">Rp</span>
                    <input type="text" name="harga_modal" class="form-control form-control-modern numeric text-end" placeholder="0" value="{{ $barang->harga_modal }}" id="harga-modal" required>
                  </div>
                  <p class="form-help-text">Harga pokok pembelian dari vendor</p>
                </div>

                <!-- Harga Jual -->
                <div class="col-md-4">
                  <label class="form-label-modern">
                    Harga Jual <span class="required-star">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-addon-modern">Rp</span>
                    <input type="text" name="harga_jual" class="form-control form-control-modern numeric text-end" placeholder="0" value="{{ $barang->harga_jual }}" id="harga-jual" required>
                  </div>
                  <p class="form-help-text">Harga tarif jual standar untuk kasir</p>
                </div>
              </div>

            </div>

            <!-- Form Actions Footer (§9) -->
            <div class="form-actions-footer">
              <a href="{{ url('listBarang') }}" class="btn-form-cancel">
                <i class="las la-times"></i>
                <span>Batal</span>
              </a>
              <button type="submit" class="btn-form-submit">
                <i class="las la-save fs-16"></i>
                <span>Simpan Perubahan</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\BarangRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('js/halaman/form-masks.js') }}"></script>
@endsection