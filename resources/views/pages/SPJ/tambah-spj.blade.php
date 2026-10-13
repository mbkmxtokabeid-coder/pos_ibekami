@extends('layout.template')

@section('head')
<link rel="stylesheet" href="{{ asset('libs/dropzone/dropzone.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
  /* ==========================================================================
     DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
     Module: Tambah SPJ (Surat Perintah Jalan)
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

  /* Form Card Container (§12.1) */
  .tokabe-form-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
    overflow: hidden;
    margin-bottom: 30px;
  }
  .tokabe-form-header {
    background: #1A2436 !important;
    border-bottom: 1.5px solid #28354A !important;
    padding: 18px 24px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
  }
  .tokabe-form-title {
    font-size: 16px;
    font-weight: 700;
    color: #F8FAFC !important;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Fieldsets & Grouping (§10.2) */
  .form-section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    margin-bottom: 18px;
    border-bottom: 1px dashed #28354A;
  }
  .form-section-title {
    font-size: 13.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #38BDF8 !important;
    margin: 0;
  }

  /* Form Controls & Labels (§10, §11) */
  .tokabe-label {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #CBD5E1 !important;
    margin-bottom: 6px !important;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .tokabe-label .req {
    color: #F87171;
  }

  .form-control, .form-select {
    background-color: #0F172A !important;
    border: 1.5px solid #334155 !important;
    color: #F8FAFC !important;
    border-radius: 8px !important;
    padding: 9px 13px !important;
    font-size: 13.5px !important;
    transition: all 0.15s ease;
  }
  .form-control::placeholder {
    color: #64748B !important;
    opacity: 0.9;
  }
  .form-control:focus, .form-select:focus {
    border-color: #6366F1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
    color: #FFFFFF !important;
    background-color: #0B1120 !important;
  }
  .form-control:disabled, .form-control[readonly] {
    background-color: #1A2436 !important;
    border-color: #28354A !important;
    color: #94A3B8 !important;
    cursor: not-allowed;
  }

  .input-group-text {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #CBD5E1 !important;
    font-size: 13px !important;
    font-weight: 600;
    border-radius: 8px;
  }

  /* Buttons */
  .btn-tokabe-primary {
    background-color: #4F46E5 !important;
    border-color: #6366F1 !important;
    color: #FFFFFF !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    padding: 9px 20px !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 2px 10px rgba(79, 70, 229, 0.4) !important;
    text-decoration: none;
    cursor: pointer;
  }
  .btn-tokabe-primary:hover {
    background-color: #4338CA !important;
    border-color: #4F46E5 !important;
    color: #FFFFFF !important;
    transform: translateY(-1px);
  }

  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    padding: 9px 18px !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
  }

  .error-help-block {
    color: #F87171;
    font-size: 12px;
    font-weight: 500;
    margin-top: 4px;
    display: block;
  }
</style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Tambah SPJ</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ url('/daftar-spj') }}">SPJ</a></li>
              <li class="breadcrumb-item active">Tambah SPJ</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Section -->
    <div class="row justify-content-center">
      <div class="col-xxl-12">
        <div class="tokabe-form-card">
          <div class="tokabe-form-header">
            <div class="tokabe-form-title">
              <i class="las la-file-signature fs-22 text-primary" aria-hidden="true"></i>
              <span>Formulir Surat Perintah Jalan (SPJ) Baru</span>
            </div>
            <a href="{{ url('/daftar-spj') }}" class="btn-form-cancel">
              <i class="las la-arrow-left"></i>
              <span>Kembali ke Daftar</span>
            </a>
          </div>

          <form action="{{ url('/store-spj') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="card-body p-4">
              <div class="row g-4">

                <!-- KOLOM KIRI: Data Penugasan & Kendaraan -->
                <div class="col-lg-6">
                  <div class="form-section-header">
                    <i class="las la-route fs-18 text-info" aria-hidden="true"></i>
                    <h5 class="form-section-title">Data Penugasan & Kendaraan</h5>
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="spj-select">
                      <span>SPJ Perusahaan</span>
                      <span class="req">*</span>
                    </label>
                    <select class="form-select @error('spj') is-invalid @enderror" name="spj" id="spj-select" required>
                      <option value="">-- Pilih SPJ --</option>
                      <option value="Ibekami" {{ old('spj') == 'Ibekami' || old('spj') == 'Ibeka' ? 'selected' : '' }}>Ibekami</option>
                      <option value="Personal" {{ old('spj') == 'Personal' ? 'selected' : '' }}>Personal</option>
                    </select>
                    @error('spj')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="nomor-spj">
                      <span>Nomor SPJ</span>
                      <small class="text-white-50 ms-1">(Otomatis)</small>
                    </label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="las la-hashtag"></i></span>
                      <input type="text" class="form-control @error('nomor_spj') is-invalid @enderror" name="nomor_spj" id="nomor-spj" placeholder="Pilih SPJ untuk membuat nomor otomatis" readonly value="{{ old('nomor_spj') }}">
                    </div>
                    @error('nomor_spj')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="tokabe-label" for="tanggal_tugas">
                        <span>Tanggal Tugas</span>
                        <span class="req">*</span>
                      </label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="las la-calendar"></i></span>
                        <input type="text" class="form-control flatpickr-input @error('tanggal_tugas') is-invalid @enderror" name="tanggal_tugas" id="tanggal_tugas" data-provider="flatpickr" data-date-format="d/m/Y" placeholder="dd/mm/yyyy" value="{{ $today }}" required>
                      </div>
                      @error('tanggal_tugas')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label class="tokabe-label" for="waktu_berangkat">
                        <span>Waktu Berangkat</span>
                      </label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="las la-clock"></i></span>
                        <input type="text" class="form-control @error('waktu_berangkat') is-invalid @enderror" id="waktu_berangkat" name="waktu_berangkat" placeholder="HH:MM" value="{{ old('waktu_berangkat') }}">
                      </div>
                      @error('waktu_berangkat')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="tokabe-label" for="jam_kembali">
                        <span>Jam Pulang / Kembali</span>
                      </label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="las la-history"></i></span>
                        <input type="text" class="form-control @error('jam_kembali') is-invalid @enderror" id="jam_kembali" name="jam_kembali" placeholder="HH:MM" value="{{ old('jam_kembali') }}">
                      </div>
                      @error('jam_kembali')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label class="tokabe-label" for="jarak_tempuh">
                        <span>Jarak Tempuh</span>
                      </label>
                      <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('jarak_tempuh') is-invalid @enderror num" name="jarak_tempuh" id="jarak_tempuh" placeholder="0" value="{{ old('jarak_tempuh') }}">
                        <span class="input-group-text">km</span>
                      </div>
                      @error('jarak_tempuh')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="biaya_bahan_bakar">
                      <span>Biaya Bahan Bakar (BBM)</span>
                    </label>
                    <div class="input-group">
                      <span class="input-group-text">Rp</span>
                      <input type="number" step="0.01" class="form-control @error('biaya_bahan_bakar') is-invalid @enderror num" name="biaya_bahan_bakar" id="biaya_bahan_bakar" placeholder="0" value="{{ old('biaya_bahan_bakar') }}">
                    </div>
                    @error('biaya_bahan_bakar')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="status_pembayaran">
                      <span>Status Pembayaran</span>
                      <span class="req">*</span>
                    </label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status_pembayaran" required>
                      <option value="Belum Bayar" {{ old('status', 'Belum Bayar') == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                      <option value="Terbayar" {{ old('status') == 'Terbayar' ? 'selected' : '' }}>Terbayar</option>
                    </select>
                    @error('status')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <!-- KOLOM KANAN: Personil & Rincian Tugas -->
                <div class="col-lg-6">
                  <div class="form-section-header">
                    <i class="las la-user-shield fs-18 text-warning" aria-hidden="true"></i>
                    <h5 class="form-section-title">Personil & Rincian Tugas</h5>
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="tujuan">
                      <span>Tujuan Perjalanan</span>
                      <span class="req">*</span>
                    </label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="las la-map-marker-alt"></i></span>
                      <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" id="tujuan" placeholder="Contoh: RS Bunda Thamrin / Vendor Medan" value="{{ old('tujuan') }}" required>
                    </div>
                    @error('tujuan')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="tokabe-label" for="nama_pemberi_tugas">
                        <span>Nama Pemberi Tugas</span>
                      </label>
                      <input type="text" class="form-control @error('nama_pemberi_tugas') is-invalid @enderror" name="nama_pemberi_tugas" id="nama_pemberi_tugas" placeholder="Pemberi instruksi" value="{{ old('nama_pemberi_tugas') }}">
                      @error('nama_pemberi_tugas')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label class="tokabe-label" for="nama_kurir">
                        <span>Nama Kurir / Petugas</span>
                        <span class="req">*</span>
                      </label>
                      <input type="text" class="form-control @error('nama_kurir') is-invalid @enderror" name="nama_kurir" id="nama_kurir" placeholder="Nama petugas jalan" value="{{ old('nama_kurir') }}" required>
                      @error('nama_kurir')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="deskripsi_barang">
                      <span>Deskripsi Barang / Peralatan</span>
                    </label>
                    <textarea class="form-control @error('deskripsi_barang') is-invalid @enderror" name="deskripsi_barang" id="deskripsi_barang" rows="2" placeholder="Barang atau peralatan yang dibawa">{{ old('deskripsi_barang') }}</textarea>
                    @error('deskripsi_barang')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="deskripsi_tugas">
                      <span>Deskripsi Tugas</span>
                    </label>
                    <textarea class="form-control @error('deskripsi_tugas') is-invalid @enderror" name="deskripsi_tugas" id="deskripsi_tugas" rows="2" placeholder="Rincian penugasan yang dijalankan">{{ old('deskripsi_tugas') }}</textarea>
                    @error('deskripsi_tugas')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label class="tokabe-label" for="keterangan_tambahan">
                      <span>Keterangan Tambahan</span>
                    </label>
                    <textarea class="form-control @error('keterangan_tambahan') is-invalid @enderror" name="keterangan_tambahan" id="keterangan_tambahan" rows="2" placeholder="Catatan tambahan selama perjalanan">{{ old('keterangan_tambahan') }}</textarea>
                    @error('keterangan_tambahan')
                      <span class="error-help-block">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

              </div>

              <!-- Action Footer -->
              <div class="d-flex align-items-center justify-content-end gap-3 pt-3 mt-4" style="border-top: 1px solid #28354A;">
                <a href="{{ url('/daftar-spj') }}" class="btn-form-cancel">
                  <i class="las la-times"></i>
                  <span>Batal</span>
                </a>
                <button type="submit" class="btn-tokabe-primary">
                  <i class="las la-save fs-18"></i>
                  <span>Simpan SPJ</span>
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('plugins')
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/halaman/spj.js') }}"></script>
<script>
  flatpickr("#waktu_berangkat", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });

  flatpickr("#jam_kembali", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });
</script>
@endsection
