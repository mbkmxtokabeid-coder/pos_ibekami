@extends('layout.template')

@section('head')
<link rel="stylesheet" href="{{ asset('libs/dropzone/dropzone.css') }}" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  /* ==========================================================================
     TOKABE TAMBAH SPK — DUAL THEME WARM STONE SYSTEM
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
  .ibk-page-subtitle {
    font-size: 13px;
    color: var(--ibk-text-muted);
    margin-top: 4px;
  }

  /* Buttons */
  .ibk-btn-primary {
    background: #EA580C !important;
    border: 1px solid #EA580C !important;
    color: #FFFFFF !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    padding: 8px 20px !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    cursor: pointer !important;
    transition: background-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
    box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
    text-decoration: none !important;
  }
  .ibk-btn-primary:hover {
    background: #C2410C !important;
    border-color: #C2410C !important;
    color: #FFFFFF !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35) !important;
  }

  .ibk-btn-back {
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    padding: 0 14px !important;
    height: 38px !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    transition: all 150ms ease !important;
  }
  .ibk-btn-back:hover {
    background: var(--ibk-surface-hover) !important;
    border-color: var(--ibk-brand-border) !important;
    color: var(--ibk-text) !important;
  }

  .ibk-btn-cancel {
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    padding: 8px 18px !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none !important;
    transition: all 150ms ease;
  }
  .ibk-btn-cancel:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
    border-color: var(--ibk-brand-border) !important;
  }

  .ref-theme-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0 16px;
    height: 38px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    background: var(--ibk-input-bg);
    border: 1px solid var(--ibk-border);
    color: var(--ibk-text);
    transition: all 180ms ease;
    white-space: nowrap;
  }
  .ref-theme-toggle:hover {
    background: var(--ibk-surface-hover);
    border-color: var(--ibk-brand-border);
    transform: translateY(-1px);
    color: var(--ibk-brand);
  }

  /* Cards */
  .ibk-form-card {
    background: var(--ibk-card-bg);
    border: 1px solid var(--ibk-border);
    border-radius: 12px;
    box-shadow: var(--ibk-card-shadow);
    margin-bottom: 24px;
    overflow: hidden;
  }
  .ibk-form-header {
    background: transparent;
    border-bottom: 1px solid var(--ibk-border);
    padding: 16px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .ibk-form-title {
    font-size: 15px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 9px;
  }
  .ibk-form-title i {
    font-size: 18px;
    color: var(--ibk-brand);
  }

  /* Controls */
  .tokabe-label {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: var(--ibk-text) !important;
    margin-bottom: 6px !important;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .required-star {
    color: var(--ibk-danger) !important;
    font-weight: bold;
    margin-left: 2px;
  }
  .form-control,
  .form-select,
  .tokabe-input,
  .tokabe-select {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    color: var(--ibk-input-text) !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    padding: 8px 14px !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .form-control,
  .form-select {
    height: 40px !important;
  }
  textarea.form-control {
    height: auto !important;
    min-height: 70px;
  }
  .form-control::placeholder,
  textarea.form-control::placeholder {
    color: var(--ibk-input-placeholder) !important;
  }
  .form-control:focus,
  .form-select:focus {
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
    outline: none !important;
  }
  .error-help-block {
    color: var(--ibk-danger) !important;
    font-size: 12px;
    margin-top: 4px;
    display: block;
  }

  .upload-box-wrapper {
    background: var(--ibk-surface-hover);
    border: 1px dashed var(--ibk-border);
    border-radius: 10px;
    padding: 16px;
    text-align: center;
  }
</style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="form-page-wrapper">

      <!-- Header Section -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-mail-settings-line"></i>
            <span>Buat SPK (Surat Perintah Kerja)</span>
          </h1>
          <div class="ibk-page-subtitle">Form instruksi kerja untuk divisi desain grafis dan tim produksi percetakan</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <a href="{{ url('/daftar-spk') }}" class="ibk-btn-back" title="Kembali ke Daftar SPK">
            <i class="ri-arrow-left-line"></i>
            <span>Daftar SPK</span>
          </a>
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
        </div>
      </div>

      <form action="{{ url('/store-spk') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Card 1: Informasi Utama SPK --}}
        <div class="ibk-form-card">
          <div class="ibk-form-header">
            <h5 class="ibk-form-title">
              <i class="ri-file-text-line"></i>
              <span>Informasi Utama SPK</span>
            </h5>
          </div>
          <div class="p-4">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="tokabe-label">Unit SPK <span class="required-star">*</span></label>
                <select class="form-select" name="unit_spk" required>
                  <option value="Ikhtiar Berkah" selected>Ikhtiar Berkah</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Jenis Pekerjaan <span class="required-star">*</span></label>
                <select class="form-select" name="pekerjaan" required>
                  <option value="">-- Pilih Pekerjaan --</option>
                  <option value="Plakat">Plakat</option>
                  <option value="Stempel">Stempel</option>
                  <option value="Tumbler">Tumbler</option>
                  <option value="Cutting/Grafir">Cutting/Grafir</option>
                  <option value="Print UV">Print UV</option>
                  <option value="Reklame">Reklame</option>
                  <option value="Cetakan Umum">Cetakan Umum</option>
                  <option value="Souvenir">Souvenir</option>
                  <option value="Customized">Customized</option>
                  <option value="Material">Material</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Tanggal SPK <span class="required-star">*</span></label>
                <input type="text" class="form-control" name="tgl_buat" id="date-field" value="{{ $today }}" placeholder="d/m/Y" required>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Nomor Invoice <span class="required-star">*</span></label>
                <input type="text" class="form-control" name="invoice" list="invoice" id="inv" value="{{ old('invoice') }}" placeholder="Contoh: INV-2026-001" required>
                <datalist id="invoice">
                  @foreach ($invoice as $inv)
                    <option value="{{ $inv }}"></option>
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Nama Pelanggan <span class="required-star">*</span></label>
                <input type="text" class="form-control" id="pelanggan" name="customer" list="customer" value="{{ old('customer') }}" placeholder="Nama Customer / Pemesan" required>
                <datalist id="customer">
                  @foreach ($customer as $cust)
                    <option value="{{ $cust }}"></option>
                  @endforeach
                </datalist>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Status Prioritas / Express <span class="required-star">*</span></label>
                <select class="form-select" name="express" required>
                  <option value="N" selected>Normal (Standar)</option>
                  <option value="Y">Kilat (Express)</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        {{-- Card 2: Rincian Spesifikasi & Bahan --}}
        <div class="ibk-form-card">
          <div class="ibk-form-header">
            <h5 class="ibk-form-title">
              <i class="ri-tools-line"></i>
              <span>Spesifikasi Teknis & Bahan</span>
            </h5>
          </div>
          <div class="p-4">
            <div class="row g-3">
              <div class="col-md-3">
                <label class="tokabe-label">Jumlah (Qty) <span class="required-star">*</span></label>
                <input type="text" class="form-control text-end num" id="cleave-numeral" name="jumlah" placeholder="0" required>
              </div>

              <div class="col-md-3">
                <label class="tokabe-label">Satuan <span class="required-star">*</span></label>
                <select class="form-select" name="satuan" required>
                  <option value="">Pilih Satuan</option>
                  <option value="Pcs" selected>Pcs</option>
                  <option value="Set">Set</option>
                  <option value="Und">Und</option>
                  <option value="Blok">Blok</option>
                  <option value="Rim">Rim</option>
                  <option value="Lbr">Lbr</option>
                  <option value="Kotak">Kotak</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="tokabe-label">Jenis Bahan</label>
                <textarea class="form-control" rows="1" placeholder="Contoh: Akrilik Bening 3mm, Ivory 260gr" name="jenis_bahan"></textarea>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Ketebalan</label>
                <textarea class="form-control" rows="1" placeholder="Contoh: 2mm / 3mm / 5mm" name="ketebalan"></textarea>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Ukuran Dimensi</label>
                <textarea class="form-control" rows="1" placeholder="Contoh: 15 x 20 cm, A4" name="ukuran"></textarea>
              </div>

              <div class="col-md-4">
                <label class="tokabe-label">Catatan Tambahan</label>
                <textarea class="form-control" rows="1" placeholder="Finishing, laminasi, atau catatan khusus" name="lain"></textarea>
              </div>
            </div>
          </div>
        </div>

        {{-- Card 3: Target Penyelesaian & Lampiran Desain --}}
        <div class="ibk-form-card">
          <div class="ibk-form-header">
            <h5 class="ibk-form-title">
              <i class="ri-calendar-event-line"></i>
              <span>Target Waktu & Lampiran Desain</span>
            </h5>
          </div>
          <div class="p-4">
            <div class="row g-4 align-items-center">
              <div class="col-lg-6">
                <label class="tokabe-label">Target Penyelesaian (Tanggal & Jam) <span class="required-star">*</span></label>
                <div class="position-relative">
                  <input type="text" class="form-control" id="targetDateInput" placeholder="Pilih target penyelesaian (d/m/Y H:i)" name="tgl_selesai" required style="cursor: pointer;">
                  <i class="ri-calendar-2-line position-absolute text-muted" style="right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 16px;"></i>
                </div>
                <small class="text-muted fs-12 mt-1 d-block">Penting untuk perhitungan timeline otomatis sistem.</small>
              </div>

              <div class="col-lg-6">
                <label class="tokabe-label">Contoh Desain / File Gambar</label>
                <div class="upload-box-wrapper">
                  <input type="file" name="contoh_design" class="form-control mb-2" id="upload" accept="image/*,.pdf">
                  <small class="text-muted fs-12 d-block">Maksimal ukuran file: 2 MB (Format: JPG, PNG, WEBP, PDF)</small>
                </div>
              </div>
            </div>

            <div class="d-flex align-items-center gap-3 mt-4 pt-3" style="border-top: 1px solid var(--ibk-border) !important;">
              <button type="submit" class="ibk-btn-primary">
                <i class="ri-save-line fs-16" aria-hidden="true"></i>
                <span>Simpan SPK</span>
              </button>
              <a href="{{ url('/daftar-spk') }}" class="ibk-btn-cancel">
                <i class="ri-close-line fs-16" aria-hidden="true"></i>
                <span>Batal</span>
              </a>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\SPKRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('libs/cleave.js/cleave.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('js/halaman/form-masks.js') }}"></script>
<script>
  function initPageTheme() {
    var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
    var icon = document.getElementById('theme-toggle-icon');
    var text = document.getElementById('theme-toggle-text');
    if (icon) {
      icon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
    }
    if (text) {
      text.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
    }
  }

  $(document).ready(function() {
    initPageTheme();

    if (typeof flatpickr !== 'undefined') {
      flatpickr("#targetDateInput", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        time_24hr: true,
        allowInput: true
      });
      flatpickr("#date-field", {
        dateFormat: "d/m/Y",
        allowInput: true
      });
    }
  });
</script>
@endsection
