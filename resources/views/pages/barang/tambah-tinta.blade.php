@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">

<style>
  .tinta-form-card {
    background: #161B22;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    overflow: hidden;
  }
  .tinta-form-header {
    padding: 16px 22px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    background: #161B22;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .tinta-form-title {
    font-size: 15px;
    font-weight: 600;
    color: #F8FAFC;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .form-label-custom {
    color: #94A3B8;
    font-weight: 500;
    font-size: 13.5px;
    margin-bottom: 6px;
  }
  .tinta-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }
  .tinta-input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748B;
    font-size: 16px;
    pointer-events: none;
    transition: color 0.15s ease;
    z-index: 5;
  }
  .tinta-input-wrap:focus-within .tinta-input-icon {
    color: #38BDF8;
  }
  .form-control-custom {
    background: #0D1117 !important;
    border: 1.5px solid #334155 !important;
    color: #F8FAFC !important;
    border-radius: 8px !important;
    padding: 9px 14px 9px 40px !important;
    font-size: 13.5px !important;
    height: 42px !important;
    width: 100% !important;
    transition: all 0.2s ease;
  }
  .form-control-custom:focus {
    border-color: #38BDF8 !important;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25) !important;
    background: #0D1117 !important;
    color: #FFFFFF !important;
    outline: none !important;
  }
  .form-control-custom::placeholder {
    color: #475569 !important;
  }
  .tinta-unit-tag {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 12px;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid #334155;
    padding: 2px 8px;
    border-radius: 5px;
    pointer-events: none;
    z-index: 5;
  }
  .btn-save-tinta {
    background: linear-gradient(135deg, #0284C7 0%, #0369A1 100%) !important;
    border: 1px solid rgba(56, 189, 248, 0.3) !important;
    color: #FFFFFF !important;
    font-weight: 600;
    font-size: 13.5px;
    border-radius: 8px;
    padding: 10px 24px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(2, 132, 199, 0.25);
  }
  .btn-save-tinta:hover {
    background: linear-gradient(135deg, #0369A1 0%, #075985 100%) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(2, 132, 199, 0.4);
    color: #FFFFFF !important;
  }
  .btn-cancel-tinta {
    background: #1E293B;
    border: 1px solid #334155;
    color: #CBD5E1;
    font-weight: 500;
    font-size: 13.5px;
    border-radius: 8px;
    padding: 10px 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-cancel-tinta:hover {
    background: #334155;
    color: #FFFFFF;
  }
  .input-helper {
    font-size: 12px;
    color: #64748B;
    margin-top: 4px;
  }
</style>
@endsection

@extends('layout.template')
@section('content')

<div class="page-content">
  <div class="container-fluid">

    <!-- PAGE TITLE -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <div>
            <h4 class="mb-1 text-light fw-bold">Tambah Tinta Baru</h4>
            <p class="text-muted fs-13 mb-0">Daftarkan jenis tinta baru ke dalam inventaris produksi.</p>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-muted">Barang</a></li>
              <li class="breadcrumb-item"><a href="{{ route('stokTinta') }}" class="text-muted">Daftar Tinta</a></li>
              <li class="breadcrumb-item active text-primary">Tambah Tinta</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- FORM CARD -->
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xl-7">
        <div class="tinta-form-card">
          <div class="tinta-form-header">
            <h5 class="tinta-form-title">
              <i class="ri-drop-fill text-info fs-18"></i>
              <span>Form Data Tinta Produksi</span>
            </h5>
            <a href="{{ route('stokTinta') }}" class="text-muted fs-13 text-decoration-none">
              <i class="ri-arrow-left-line me-1"></i> Kembali
            </a>
          </div>

          <form action="{{ route('store.tinta') }}" method="POST">
            @csrf
            <input name="harga_modal" type="hidden" value="0">
            <input name="harga_jual" type="hidden" value="0">
            <input name="kategori" type="hidden" value="7">

            <div class="p-4">
              <div class="mb-3">
                <label class="form-label form-label-custom">
                  Nama / Jenis Tinta <span class="text-danger">*</span>
                </label>
                <div class="tinta-input-wrap">
                  <i class="ri-contrast-drop-line tinta-input-icon"></i>
                  <input type="text" name="nama_tinta" class="form-control form-control-custom @error('nama_tinta') is-invalid @enderror" placeholder="Contoh: Tinta Warna Eco-Solvent, Tinta Putih DTF" value="{{ old('nama_tinta') }}" required autofocus>
                </div>
                <div class="input-helper">Nama lengkap spesifikasi atau warna tinta yang akan digunakan.</div>
                @error('nama_tinta')
                  <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label form-label-custom">
                    Kode Tinta <span class="text-danger">*</span>
                  </label>
                  <div class="tinta-input-wrap">
                    <i class="ri-barcode-line tinta-input-icon"></i>
                    <input type="text" name="kode_tinta" class="form-control form-control-custom font-mono @error('kode_tinta') is-invalid @enderror" placeholder="Contoh: TTW, TTB, TTC" value="{{ old('kode_tinta') }}" required style="text-transform: uppercase;">
                  </div>
                  <div class="input-helper">Kode singkat unik barang.</div>
                  @error('kode_tinta')
                    <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label form-label-custom">
                    Stok Awal <span class="text-danger">*</span>
                  </label>
                  <div class="tinta-input-wrap">
                    <i class="ri-stack-line tinta-input-icon"></i>
                    <input type="text" name="stok" id="cleave-numeral" class="form-control form-control-custom @error('stok') is-invalid @enderror" placeholder="0" value="{{ old('stok', 0) }}" required style="padding-right: 50px !important;">
                    <span class="tinta-unit-tag">Unit</span>
                  </div>
                  <div class="input-helper">Jumlah botol/unit fisik yang tersedia.</div>
                  @error('stok')
                    <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label form-label-custom">Tanggal Masuk / Penerimaan</label>
                <div class="tinta-input-wrap">
                  <i class="ri-calendar-line tinta-input-icon"></i>
                  <input type="text" class="form-control form-control-custom" id="dateInput" placeholder="Pilih tanggal" name="tgl_masuk" value="{{ date('d/m/Y') }}">
                </div>
                <div class="input-helper">Tanggal pencatatan barang masuk ke gudang produksi.</div>
              </div>

              <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top border-secondary border-opacity-25">
                <a href="{{ route('stokTinta') }}" class="btn-cancel-tinta">
                  Batal
                </a>
                <button type="submit" class="btn-save-tinta">
                  <i class="ri-save-3-line"></i> Simpan Tinta
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

{!! JsValidator::formRequest('App\Http\Requests\TintaRequest') !!}
@endsection

@section('plugins')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>

<script>
  $(document).ready(function() {
    if (typeof flatpickr !== 'undefined') {
      flatpickr("#dateInput", {
        dateFormat: "d/m/Y",
        defaultDate: new Date(),
        allowInput: true
      });
    }

    if (typeof Cleave !== 'undefined' && document.getElementById('cleave-numeral')) {
      new Cleave('#cleave-numeral', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
      });
    }
  });
</script>
@endsection
