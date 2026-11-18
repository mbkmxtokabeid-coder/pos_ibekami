@extends('layout.template')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  /* ==========================================================================
     TOKABE TAMBAH SPJ — DUAL THEME WARM STONE SYSTEM
     ========================================================================== */

  :root {
    --ibk-bg: #0C0A09;
    --ibk-surface: #14110F;
    --ibk-surface-hover: #1A1613;
    --ibk-card-bg: #14110F;
    --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    --ibk-border: rgba(255, 255, 255, 0.08);
    --ibk-border-subtle: rgba(255, 255, 255, 0.04);
    --ibk-text: #FAFAFA;
    --ibk-text-muted: #A1A1AA;
    --ibk-text-dim: #71717A;

    --ibk-brand: #F59E0B;
    --ibk-brand-deep: #EA580C;
    --ibk-brand-soft: rgba(245, 158, 11, 0.12);
    --ibk-brand-border: rgba(245, 158, 11, 0.24);
    --ibk-brand-text: #FBBF24;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;

    --ibk-success: #10B981;
    --ibk-success-soft: rgba(16, 185, 129, 0.14);
    --ibk-success-border: rgba(16, 185, 129, 0.28);
    --ibk-danger: #EF4444;
    --ibk-danger-soft: rgba(239, 68, 68, 0.14);
    --ibk-danger-border: rgba(239, 68, 68, 0.28);
    --ibk-info: #38BDF8;
    --ibk-info-soft: rgba(56, 189, 248, 0.14);
    --ibk-info-border: rgba(56, 189, 248, 0.28);

    --ibk-input-bg: rgba(255, 255, 255, 0.04);
    --ibk-input-border: rgba(255, 255, 255, 0.12);
    --ibk-input-text: #FAFAFA;
    --ibk-input-placeholder: #71717A;
    --ibk-popover-bg: #181412;
  }

  body.theme-light,
  html.theme-light,
  html[data-layout-mode="light"] {
    --ibk-bg: #F7F6F2;
    --ibk-surface: #FFFFFF;
    --ibk-surface-hover: #FAF7F2;
    --ibk-card-bg: #FFFFFF;
    --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
    --ibk-border: #EAE4DC;
    --ibk-border-subtle: #F5EFEB;
    --ibk-text: #0F172A;
    --ibk-text-muted: #64748B;
    --ibk-text-dim: #94A3B8;

    --ibk-brand: #EA580C;
    --ibk-brand-deep: #C2410C;
    --ibk-brand-soft: #FFF7ED;
    --ibk-brand-border: #FED7AA;
    --ibk-brand-text: #EA580C;
    --ibk-brand-btn-bg: #EA580C;
    --ibk-brand-btn-text: #FFFFFF;

    --ibk-success: #059669;
    --ibk-success-soft: #ECFDF5;
    --ibk-success-border: #A7F3D0;
    --ibk-danger: #DC2626;
    --ibk-danger-soft: #FEF2F2;
    --ibk-danger-border: #FECACA;
    --ibk-info: #0284C7;
    --ibk-info-soft: #F0F9FF;
    --ibk-info-border: #BAE6FD;

    --ibk-input-bg: #FFFFFF;
    --ibk-input-border: #DDD6CE;
    --ibk-input-text: #0F172A;
    --ibk-input-placeholder: #94A3B8;
    --ibk-popover-bg: #FFFFFF;
  }

  .num, .price, .numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  .form-page-wrapper {
    position: relative;
    width: 100%;
    min-height: calc(100vh - 120px);
    padding-bottom: 85px !important;
    margin-bottom: 24px !important;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
    color: var(--ibk-text);
  }

  /* Header Section */
  .ibk-page-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
  }
  .ibk-page-title h1 {
    font-size: 20px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    letter-spacing: -0.015em;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .ibk-page-title h1 i {
    color: var(--ibk-brand);
    font-size: 22px;
  }
  .ibk-page-title p {
    font-size: 13px;
    color: var(--ibk-text-muted);
    margin: 4px 0 0 0;
  }

  .header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .btn-ref-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 8px;
    border: 1px solid var(--ibk-border);
    background: var(--ibk-surface);
    color: var(--ibk-text);
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-ref-back:hover {
    background: var(--ibk-surface-hover);
    color: var(--ibk-brand);
    border-color: var(--ibk-brand-border);
  }

  .ref-theme-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 13px;
    font-size: 12.5px;
    font-weight: 500;
    color: var(--ibk-text-muted);
    background: var(--ibk-surface);
    border: 1px solid var(--ibk-border);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .ref-theme-toggle:hover {
    color: var(--ibk-text);
    border-color: var(--ibk-brand-border);
    background: var(--ibk-surface-hover);
  }

  /* Form Card Container */
  .ibk-form-card {
    background: var(--ibk-card-bg);
    border: 1px solid var(--ibk-border);
    border-radius: 12px;
    box-shadow: var(--ibk-card-shadow);
    overflow: hidden;
    margin-bottom: 24px;
  }

  .ibk-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--ibk-border);
    background: var(--ibk-surface);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .ibk-card-header-title {
    font-size: 14.5px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .ibk-card-header-title i {
    color: var(--ibk-brand);
    font-size: 18px;
  }

  .ibk-card-body {
    padding: 24px 20px;
  }

  /* Form Controls */
  .form-label-custom {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--ibk-text-dim);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .form-label-custom .required-star {
    color: var(--ibk-danger);
  }

  .input-custom {
    width: 100%;
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    border-radius: 8px !important;
    color: var(--ibk-input-text) !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 9px 13px !important;
    outline: none !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .input-custom:focus {
    border-color: var(--ibk-brand) !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
  }
  .input-custom::placeholder {
    color: var(--ibk-input-placeholder) !important;
    font-weight: 400 !important;
  }
  .input-custom[readonly] {
    opacity: 0.85;
    background: rgba(255, 255, 255, 0.02) !important;
  }

  select.input-custom {
    cursor: pointer;
  }
  select.input-custom option {
    background: var(--ibk-surface);
    color: var(--ibk-text);
  }

  textarea.input-custom {
    min-height: 44px;
    resize: vertical;
  }

  .field-hint {
    font-size: 11.5px;
    color: var(--ibk-text-dim);
    margin-top: 4px;
  }

  /* Section Title Divider */
  .section-divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 20px 0 16px 0;
    padding-bottom: 8px;
    border-bottom: 1px dashed var(--ibk-border);
  }
  .section-divider span {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--ibk-brand);
  }

  /* Action Footer */
  .form-actions-bar {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 20px;
    margin-top: 10px;
    border-top: 1px solid var(--ibk-border);
  }

  .btn-submit-spj {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--ibk-brand-btn-bg);
    color: var(--ibk-brand-btn-text);
    border: none;
    border-radius: 8px;
    padding: 10px 22px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    transition: all 0.15s ease;
  }
  .btn-submit-spj:hover {
    filter: brightness(1.08);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
  }

  .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 500;
    color: var(--ibk-text-muted);
    background: transparent;
    border: 1px solid var(--ibk-border);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-cancel:hover {
    color: var(--ibk-text);
    border-color: var(--ibk-border);
    background: var(--ibk-surface-hover);
  }

  .error-help-block {
    color: var(--ibk-danger) !important;
    font-size: 11.5px !important;
    margin-top: 4px !important;
  }
</style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="form-page-wrapper">

      {{-- Page Header --}}
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-route-line"></i>
            Tambah SPJ (Surat Perintah Jalan)
          </h1>
          <p>Terbitkan surat tugas operasional jalan untuk kurir atau teknisi lapangan.</p>
        </div>
        <div class="header-actions">
          <a href="{{ url('/daftar-spj') }}" class="btn-ref-back">
            <i class="ri-arrow-left-line"></i>
            <span>Kembali ke Daftar</span>
          </a>
          <button type="button" class="ref-theme-toggle" id="themeToggleBtn" title="Ganti Mode Tampilan">
            <i class="ri-moon-line" id="themeIcon"></i>
            <span id="themeLabel">Mode Terang</span>
          </button>
        </div>
      </div>

      {{-- Form Card --}}
      <div class="ibk-form-card">
        <div class="ibk-card-header">
          <h2 class="ibk-card-header-title">
            <i class="ri-file-add-line"></i>
            Formulir Surat Perintah Jalan Baru
          </h2>
          <span class="badge" style="background: var(--ibk-brand-soft); color: var(--ibk-brand-text); border: 1px solid var(--ibk-brand-border); padding: 5px 10px; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
            <i class="ri-calendar-line me-1"></i>{{ $today }}
          </span>
        </div>

        <div class="ibk-card-body">
          <form action="{{ url('/store-spj') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="formTambahSPJ">
            @csrf

            <div class="row g-4">
              {{-- KOLOM KIRI: Data Penugasan & Kendaraan --}}
              <div class="col-lg-6">
                <div class="section-divider mt-0">
                  <i class="ri-compass-3-line" style="color: var(--ibk-brand);"></i>
                  <span>Data Penugasan & Kendaraan</span>
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="spj-select">
                    SPJ Perusahaan <span class="required-star">*</span>
                  </label>
                  <select class="input-custom @error('spj') is-invalid @enderror" name="spj" id="spj-select" required>
                    <option value="">-- Pilih SPJ Perusahaan --</option>
                    <option value="Ibekami" {{ old('spj') == 'Ibekami' || old('spj') == 'Ibeka' ? 'selected' : '' }}>Ibekami</option>
                    <option value="Personal" {{ old('spj') == 'Personal' ? 'selected' : '' }}>Personal</option>
                  </select>
                  @error('spj')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="nomor-spj">
                    Nomor SPJ <span class="field-hint ms-1">(Dihasilkan Otomatis)</span>
                  </label>
                  <input type="text" class="input-custom @error('nomor_spj') is-invalid @enderror" name="nomor_spj" id="nomor-spj" placeholder="Pilih SPJ Perusahaan untuk nomor otomatis..." readonly value="{{ old('nomor_spj') }}">
                  @error('nomor_spj')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label-custom" for="tanggal_tugas">
                      Tanggal Tugas <span class="required-star">*</span>
                    </label>
                    <input type="text" class="input-custom num @error('tanggal_tugas') is-invalid @enderror" name="tanggal_tugas" id="tanggal_tugas" data-provider="flatpickr" data-date-format="d/m/Y" placeholder="dd/mm/yyyy" value="{{ $today }}" required>
                    @error('tanggal_tugas')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="waktu_berangkat">
                      Waktu Berangkat
                    </label>
                    <input type="text" class="input-custom num @error('waktu_berangkat') is-invalid @enderror" id="waktu_berangkat" name="waktu_berangkat" placeholder="HH:MM" value="{{ old('waktu_berangkat') }}">
                    @error('waktu_berangkat')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label-custom" for="jam_kembali">
                      Jam Pulang / Kembali
                    </label>
                    <input type="text" class="input-custom num @error('jam_kembali') is-invalid @enderror" id="jam_kembali" name="jam_kembali" placeholder="HH:MM" value="{{ old('jam_kembali') }}">
                    @error('jam_kembali')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="jarak_tempuh">
                      Jarak Tempuh (KM)
                    </label>
                    <input type="number" step="0.01" class="input-custom num @error('jarak_tempuh') is-invalid @enderror" name="jarak_tempuh" id="jarak_tempuh" placeholder="0" value="{{ old('jarak_tempuh') }}">
                    @error('jarak_tempuh')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="biaya_bahan_bakar">
                    Biaya Bahan Bakar (BBM)
                  </label>
                  <input type="number" step="0.01" class="input-custom num @error('biaya_bahan_bakar') is-invalid @enderror" name="biaya_bahan_bakar" id="biaya_bahan_bakar" placeholder="Rp 0" value="{{ old('biaya_bahan_bakar') }}">
                  @error('biaya_bahan_bakar')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="status_pembayaran">
                    Status Pembayaran <span class="required-star">*</span>
                  </label>
                  <select class="input-custom @error('status') is-invalid @enderror" name="status" id="status_pembayaran" required>
                    <option value="Belum Bayar" {{ old('status', 'Belum Bayar') == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="Terbayar" {{ old('status') == 'Terbayar' ? 'selected' : '' }}>Terbayar</option>
                  </select>
                  @error('status')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- KOLOM KANAN: Personil & Rincian Tugas --}}
              <div class="col-lg-6">
                <div class="section-divider mt-0">
                  <i class="ri-user-star-line" style="color: var(--ibk-brand);"></i>
                  <span>Personil & Rincian Tugas</span>
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="tujuan">
                    Tujuan Perjalanan <span class="required-star">*</span>
                  </label>
                  <input type="text" class="input-custom @error('tujuan') is-invalid @enderror" name="tujuan" id="tujuan" placeholder="Contoh: RS Bunda Thamrin / Vendor Gading Murni Medan" value="{{ old('tujuan') }}" required>
                  @error('tujuan')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label-custom" for="nama_pemberi_tugas">
                      Nama Pemberi Tugas
                    </label>
                    <input type="text" class="input-custom @error('nama_pemberi_tugas') is-invalid @enderror" name="nama_pemberi_tugas" id="nama_pemberi_tugas" placeholder="Pemberi instruksi..." value="{{ old('nama_pemberi_tugas') }}">
                    @error('nama_pemberi_tugas')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6">
                    <label class="form-label-custom" for="nama_kurir">
                      Nama Kurir / Petugas <span class="required-star">*</span>
                    </label>
                    <input type="text" class="input-custom @error('nama_kurir') is-invalid @enderror" name="nama_kurir" id="nama_kurir" placeholder="Nama kurir yang bertugas..." value="{{ old('nama_kurir') }}" required>
                    @error('nama_kurir')
                      <div class="error-help-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="deskripsi_barang">
                    Deskripsi Barang / Peralatan
                  </label>
                  <textarea class="input-custom" name="deskripsi_barang" id="deskripsi_barang" rows="2" placeholder="Barang atau perlengkapan yang dibawa...">{{ old('deskripsi_barang') }}</textarea>
                  @error('deskripsi_barang')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="deskripsi_tugas">
                    Deskripsi Tugas
                  </label>
                  <textarea class="input-custom" name="deskripsi_tugas" id="deskripsi_tugas" rows="2" placeholder="Rincian penugasan yang harus dijalankan...">{{ old('deskripsi_tugas') }}</textarea>
                  @error('deskripsi_tugas')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label-custom" for="keterangan_tambahan">
                    Keterangan Tambahan
                  </label>
                  <textarea class="input-custom" name="keterangan_tambahan" id="keterangan_tambahan" rows="2" placeholder="Catatan tambahan selama perjalanan...">{{ old('keterangan_tambahan') }}</textarea>
                  @error('keterangan_tambahan')
                    <div class="error-help-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            {{-- Action Buttons --}}
            <div class="form-actions-bar">
              <a href="{{ url('/daftar-spj') }}" class="btn-cancel">
                <i class="ri-close-line"></i>
                <span>Batal</span>
              </a>
              <button type="submit" class="btn-submit-spj">
                <i class="ri-save-3-line"></i>
                <span>Simpan Surat Perintah Jalan</span>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('js/halaman/spj.js') }}"></script>
<script>
  (function () {
    'use strict';

    // Theme Toggle Functionality
    var themeToggleBtn = document.getElementById('themeToggleBtn');
    var themeIcon = document.getElementById('themeIcon');
    var themeLabel = document.getElementById('themeLabel');

    function applyTheme(isLight) {
      if (isLight) {
        document.body.classList.add('theme-light');
        document.documentElement.classList.add('theme-light');
        if (themeIcon) {
          themeIcon.className = 'ri-sun-line';
          themeIcon.style.color = '#EA580C';
        }
        if (themeLabel) themeLabel.textContent = 'Mode Gelap';
      } else {
        document.body.classList.remove('theme-light');
        document.documentElement.classList.remove('theme-light');
        if (themeIcon) {
          themeIcon.className = 'ri-moon-line';
          themeIcon.style.color = '';
        }
        if (themeLabel) themeLabel.textContent = 'Mode Terang';
      }
    }

    var savedTheme = localStorage.getItem('tokabe_theme');
    applyTheme(savedTheme === 'light');

    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', function () {
        var isCurrentlyLight = document.body.classList.contains('theme-light');
        var nextIsLight = !isCurrentlyLight;
        applyTheme(nextIsLight);
        localStorage.setItem('tokabe_theme', nextIsLight ? 'light' : 'dark');
      });
    }

    // Initialize flatpickr time pickers
    if (typeof flatpickr !== 'undefined') {
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
    }
  })();
</script>
@endsection
