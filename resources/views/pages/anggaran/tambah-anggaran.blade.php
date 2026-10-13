@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* Dark Slate Pro Tokens (§2 & §10) */
    .page-title-box h4 {
      font-size: 20px;
      font-weight: 700;
      color: #F8FAFC !important;
    }
    .breadcrumb .breadcrumb-item a {
      color: #94A3B8 !important;
      text-decoration: none;
    }
    .breadcrumb .breadcrumb-item.active {
      color: #E2E8F0 !important;
      font-weight: 600;
    }

    .tokabe-section-card {
      background: #151D2A !important;
      border: 1.5px solid #28354A !important;
      border-radius: 12px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 24px;
      overflow: hidden;
    }
    .tokabe-card-header {
      background: #1A2436 !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 16px 20px !important;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .tokabe-card-title {
      font-size: 16px;
      font-weight: 700;
      color: #F8FAFC !important;
      margin: 0;
    }
    .tokabe-card-subtitle {
      font-size: 12.5px;
      color: #94A3B8;
      margin-top: 2px;
      display: block;
    }
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

    /* Form Labels & Controls */
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
    .form-control, .form-select {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      padding: 9px 14px !important;
      font-size: 13.5px !important;
      height: 42px !important;
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

    /* Autofill Fix */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 1000px #0F172A inset !important;
      -webkit-text-fill-color: #F8FAFC !important;
      caret-color: #F8FAFC !important;
      transition: background-color 5000s ease-in-out 0s;
    }

    /* Action Buttons */
    .btn-tokabe-primary {
      background-color: #4F46E5 !important;
      border: 1.5px solid #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 42px !important;
      padding: 0 20px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      transition: all 0.15s ease !important;
      box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25) !important;
    }
    .btn-tokabe-primary:hover {
      background-color: #4338CA !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
      transform: translateY(-1px);
    }
    .btn-tokabe-reset {
      background-color: #1E293B !important;
      border: 1.5px solid #334155 !important;
      color: #94A3B8 !important;
      font-weight: 500 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 42px !important;
      padding: 0 18px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      text-decoration: none !important;
      transition: all 0.15s ease !important;
    }
    .btn-tokabe-reset:hover {
      background-color: #334155 !important;
      color: #F8FAFC !important;
    }

    .error-help-block {
      color: #F87171 !important;
      font-size: 12.5px;
      margin-top: 4px;
      display: block;
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
            <h4 class="mb-sm-0 text-white fw-bold">Tambah Anggaran</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Alokasikan anggaran operasional dan belanja material per kategori</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ route('budget.list') }}">Daftar Anggaran</a></li>
              <li class="breadcrumb-item active">Tambah Anggaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Form Card (§12.1) -->
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xl-7">
        <div class="tokabe-section-card">

          <!-- Card Header -->
          <div class="tokabe-card-header">
            <div class="tokabe-header-icon">
              <i class="las la-wallet"></i>
            </div>
            <div>
              <h5 class="tokabe-card-title">Form Alokasi Anggaran</h5>
              <span class="tokabe-card-subtitle">Masukkan nominal alokasi dana dan tanggal berlaku periode</span>
            </div>
          </div>

          <!-- Form Body -->
          <div class="card-body p-4">
            <form action="{{ route('budget.store') }}" class="needs-validation" novalidate method="POST">
              @csrf

              <!-- Input Nama Anggaran -->
              <div class="mb-3">
                <label class="tokabe-label">
                  Nama Anggaran <span class="required-star">*</span>
                </label>
                <input type="text" name="nama_anggaran" class="form-control" placeholder="Contoh: Anggaran Kertas & Tinta Q1" value="{{ old('nama_anggaran') }}" required>
                @error('nama_anggaran')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Input Kategori Barang -->
              <div class="mb-3">
                <label class="tokabe-label">
                  Kategori Barang <span class="required-star">*</span>
                </label>
                <select class="form-select" name="kategori" required>
                  <option value="" selected disabled>Pilih Kategori Barang</option>
                  @foreach ($kategori as $id => $nama_kategori)
                    <option value="{{ $id }}" {{ old('kategori') == $id ? 'selected' : '' }}>
                      {{ $nama_kategori }}
                    </option>
                  @endforeach
                </select>
                @error('kategori')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Input Nominal Anggaran & Tanggal -->
              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="tokabe-label">
                    Nominal Anggaran (Rp) <span class="required-star">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-text" style="background-color: #1A2436; border: 1.5px solid #334155; border-right: none; color: #94A3B8; font-weight: 600;">Rp</span>
                    <input id="cleave-numeral" name="anggaran" type="text" class="form-control" placeholder="0" value="{{ old('anggaran') }}" required style="border-left: none;">
                  </div>
                  @error('anggaran')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="dateInput" class="tokabe-label">
                    Tanggal Berlaku <span class="required-star">*</span>
                  </label>
                  <input type="date" name="tanggal" class="form-control" data-provider="flatpickr" id="dateInput" placeholder="YYYY-MM-DD" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                  @error('tanggal')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="pt-3 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-end gap-2">
                <a href="{{ route('budget.list') }}" class="btn-tokabe-reset">
                  <i class="las la-arrow-left fs-16"></i>
                  <span>Batal</span>
                </a>
                <button type="submit" id="simpan" class="btn-tokabe-primary">
                  <i class="ri-save-3-line fs-16"></i>
                  <span>Simpan Anggaran</span>
                </button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\BudgetRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('js/halaman/form-masks.js') }}"></script>
@endsection