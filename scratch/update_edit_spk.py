# update_edit_spk.py
import os

content = r'''@extends('layout.template')

@section('head')
<link rel="stylesheet" href="{{ asset('libs/dropzone/dropzone.css') }}" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  /* ==========================================================================
     TOKABE EDIT SPK — DUAL THEME WARM STONE SYSTEM
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

    --ibk-input-bg: rgba(255, 255, 255, 0.04);
    --ibk-input-border: rgba(255, 255, 255, 0.12);
    --ibk-input-text: #FAFAFA;
    --ibk-input-placeholder: #71717A;
    --ibk-popover-bg: #181412;
  }

  body.theme-light,
  html.theme-light,
  html[data-layout-mode="light"] {
    --ibk-bg: #F8FAFC;
    --ibk-surface: #FFFFFF;
    --ibk-surface-hover: #FFF7ED;
    --ibk-card-bg: #FFFFFF;
    --ibk-card-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
    --ibk-border: #E2E8F0;
    --ibk-border-subtle: #F1F5F9;
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

    --ibk-input-bg: #FFFFFF;
    --ibk-input-border: #CBD5E1;
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
    opacity: 0.75;
    cursor: not-allowed;
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
    min-height: 42px;
    resize: vertical;
  }

  .field-hint {
    font-size: 11.5px;
    color: var(--ibk-text-dim);
    margin-top: 4px;
  }

  /* Image Preview Box */
  .existing-image-box {
    padding: 10px;
    border-radius: 8px;
    background: var(--ibk-surface-hover);
    border: 1px solid var(--ibk-border);
    margin-bottom: 10px;
    display: inline-flex;
    align-items: center;
    gap: 12px;
  }
  .existing-image-box img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid var(--ibk-border);
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

  .btn-submit-spk {
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
  .btn-submit-spk:hover {
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
            <i class="ri-edit-line"></i>
            Edit SPK #{{ $spk->nomor_invoice ?? $spk->id }}
          </h1>
          <p>Perbarui informasi surat perintah kerja dan spesifikasi produksi barang.</p>
        </div>
        <div class="header-actions">
          <a href="{{ url('/daftar-spk') }}" class="btn-ref-back">
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
            <i class="ri-file-settings-line"></i>
            Formulir Pembaruan SPK
          </h2>
          <span class="badge" style="background: var(--ibk-brand-soft); color: var(--ibk-brand-text); border: 1px solid var(--ibk-brand-border); padding: 5px 10px; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
            <i class="ri-building-line me-1"></i>Ikhtiar Berkah
          </span>
        </div>

        <div class="ibk-card-body">
          <form action="{{ url('/update-spk/' . $spk->id) }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data" id="formEditSPK">
            @csrf
            @method('put')

            {{-- Hidden fields --}}
            <input type="hidden" name="jam_buat" value="{{ $waktu }}">

            <div class="row g-3">
              {{-- SPK Company & Pekerjaan --}}
              <div class="col-md-6">
                <label class="form-label-custom">
                  Penerbit SPK
                </label>
                <select class="input-custom" disabled>
                  <option value="Ikhtiar Berkah" selected>Ikhtiar Berkah</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-custom">
                  Jenis Pekerjaan <span class="required-star">*</span>
                </label>
                <select class="input-custom" name="pekerjaan" required>
                  <option disabled value="">Pilih Pekerjaan</option>
                  @php
                    $defaultPekerjaan = ['Plakat', 'Stempel', 'Tumbler', 'Cutting/Grafir', 'Print UV', 'Reklame', 'Cetakan Umum', 'Souvenir', 'Customized', 'Material'];
                  @endphp
                  @if(!in_array($spk->pekerjaan, $defaultPekerjaan) && !empty($spk->pekerjaan))
                    <option value="{{ $spk->pekerjaan }}" selected>{{ $spk->pekerjaan }}</option>
                  @endif
                  @foreach($defaultPekerjaan as $pek)
                    <option value="{{ $pek }}" {{ $spk->pekerjaan == $pek ? 'selected' : '' }}>{{ $pek }}</option>
                  @endforeach
                </select>
              </div>

              {{-- Section Divider 1 --}}
              <div class="col-12">
                <div class="section-divider">
                  <i class="ri-file-list-3-line" style="color: var(--ibk-brand);"></i>
                  <span>Data Dokumen & Pelanggan</span>
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Tanggal SPK
                </label>
                <input type="text" class="input-custom num" name="tgl_buat" value="{{ $today }}" readonly>
                <div class="field-hint">Diambil dari tanggal pembuatan sistem</div>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Nomor Invoice <span class="required-star">*</span>
                </label>
                <input type="text" class="input-custom" name="invoice" list="invoice" id="inv" value="{{ $spk->nomor_invoice }}" placeholder="Ketik atau pilih nomor invoice..." required>
                <datalist id="invoice">
                  @foreach ($invoice as $inv)
                    <option value="{{ $inv }}"></option>
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Pelanggan / Customer <span class="required-star">*</span>
                </label>
                <input type="text" class="input-custom" id="pelanggan" name="customer" list="customer" value="{{ $spk->customer }}" placeholder="Nama Customer" required>
                <datalist id="customer">
                  @foreach ($customer as $cust)
                    <option value="{{ $cust }}"></option>
                  @endforeach
                </datalist>
              </div>

              {{-- Section Divider 2 --}}
              <div class="col-12">
                <div class="section-divider">
                  <i class="ri-tools-line" style="color: var(--ibk-brand);"></i>
                  <span>Spesifikasi Produksi & Bahan</span>
                </div>
              </div>

              <div class="col-md-3">
                <label class="form-label-custom">
                  Jumlah <span class="required-star">*</span>
                </label>
                <input type="text" class="input-custom num" id="cleave-numeral" name="jumlah" value="{{ $spk->jumlah }}" placeholder="Contoh: 100" required>
              </div>

              <div class="col-md-3">
                <label class="form-label-custom">
                  Satuan <span class="required-star">*</span>
                </label>
                <select class="input-custom" id="choices-orderBy" name="satuan" required>
                  <option value="{{ $spk->satuan }}">{{ $spk->satuan }}</option>
                  @foreach(['Pcs', 'Set', 'Und', 'Blok', 'Rim', 'Lbr', 'Kotak'] as $option)
                    @if($option !== $spk->satuan)
                      <option value="{{ $option }}">{{ $option }}</option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-custom">
                  Jenis Bahan
                </label>
                <textarea class="input-custom" rows="1" placeholder="Contoh: Akrilik Bening 3mm, Kayu Jati, Kuningan..." name="jenis_bahan">{{ $spk->jenis_bahan }}</textarea>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Ketebalan
                </label>
                <textarea class="input-custom" rows="1" placeholder="Contoh: 2mm / 3mm / 5mm..." name="ketebalan">{{ $spk->ketebalan }}</textarea>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Ukuran
                </label>
                <textarea class="input-custom" rows="1" placeholder="Contoh: 15 x 20 cm..." name="ukuran">{{ $spk->ukuran }}</textarea>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Lain-Lain
                </label>
                <textarea class="input-custom" rows="1" placeholder="Catatan tambahan pengerjaan..." name="lain">{{ $spk->lain }}</textarea>
              </div>

              {{-- Section Divider 3 --}}
              <div class="col-12">
                <div class="section-divider">
                  <i class="ri-time-line" style="color: var(--ibk-brand);"></i>
                  <span>Target Waktu & Desain</span>
                </div>
              </div>

              <div class="col-md-3">
                <label class="form-label-custom">
                  Prioritas Express <span class="required-star">*</span>
                </label>
                <select class="input-custom" name="express" required>
                  <option disabled value="">Pilih Prioritas</option>
                  <option value="N" {{ $spk->express == 'N' ? 'selected' : '' }}>Biasa (Normal)</option>
                  <option value="Y" {{ $spk->express == 'Y' ? 'selected' : '' }}>Express (Prioritas Cepat)</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label-custom">
                  Target Penyelesaian <span class="required-star">*</span>
                </label>
                <input type="text" class="input-custom num" data-provider="flatpickr" data-date-format="d/m/Y" data-enable-time id="dateInput" placeholder="Pilih tanggal & jam selesai..." name="tgl_selesai" value="{{ $tgl_selesai }}" required>
                <div class="field-hint">Format: dd/mm/yyyy hh:mm</div>
              </div>

              <div class="col-md-5">
                <label class="form-label-custom">
                  File Contoh Desain
                </label>

                @if(!empty($spk->gambar))
                  <div class="existing-image-box">
                    <img src="{{ asset('images/spk/' . $spk->gambar) }}" alt="Preview Desain" onerror="this.style.display='none'">
                    <div>
                      <div style="font-size: 12.5px; font-weight: 600; color: var(--ibk-text);">Desain Tersimpan</div>
                      <a href="{{ asset('images/spk/' . $spk->gambar) }}" target="_blank" style="font-size: 11.5px; color: var(--ibk-brand-text); text-decoration: none;">
                        <i class="ri-external-link-line me-1"></i>Buka File Asli
                      </a>
                    </div>
                  </div>
                @endif

                <input type="file" name="contoh_design" class="input-custom" id="upload" accept="image/*,.pdf">
                <div class="field-hint">Maksimal ukuran file: 1.5 MB (Biarkan kosong jika tidak ingin mengganti)</div>
              </div>
            </div>

            {{-- Action Buttons --}}
            <div class="form-actions-bar">
              <a href="{{ url('/daftar-spk') }}" class="btn-cancel">
                <i class="ri-close-line"></i>
                <span>Batal</span>
              </a>
              <button type="submit" class="btn-submit-spk">
                <i class="ri-save-3-line"></i>
                <span>Simpan Perubahan SPK</span>
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

{!! JsValidator::formRequest('App\\Http\\Requests\\SPKRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('js/halaman/form-masks.js') }}"></script>

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

    // Initialize flatpickr on date input if flatpickr exists
    if (typeof flatpickr !== 'undefined') {
      flatpickr("#dateInput", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        time_24hr: true
      });
    }
  })();
</script>
@endsection
'''

with open('resources/views/pages/SPK/edit-spk.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated resources/views/pages/SPK/edit-spk.blade.php")

