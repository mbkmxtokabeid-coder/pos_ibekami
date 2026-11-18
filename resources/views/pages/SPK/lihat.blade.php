@extends('layout.template')

@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  /* ==========================================================================
     TOKABE LIHAT DETAIL SPK — DUAL THEME WARM STONE SYSTEM
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
    --ibk-th-bg: #181412;
    --ibk-th-text: #A1A1AA;
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
    --ibk-th-bg: #F3EFE6;
    --ibk-th-text: #64748B;
  }

  .num, .price, .numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  .detail-page-wrapper {
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
    flex-wrap: wrap;
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

  .btn-print-cta {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--ibk-brand-btn-bg);
    color: var(--ibk-brand-btn-text);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    transition: all 0.15s ease;
  }
  .btn-print-cta:hover {
    filter: brightness(1.08);
    transform: translateY(-1px);
    color: #FFFFFF;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
  }

  .btn-edit-cta {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 8px;
    border: 1px solid var(--ibk-brand-border);
    background: var(--ibk-brand-soft);
    color: var(--ibk-brand-text);
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-edit-cta:hover {
    background: var(--ibk-brand-border);
    color: var(--ibk-brand);
  }

  /* Detail Card Containers */
  .ibk-detail-card {
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
    padding: 20px;
  }

  /* Specifications Table */
  .spec-table {
    width: 100%;
    border-collapse: collapse;
  }
  .spec-table tr {
    border-bottom: 1px solid var(--ibk-border-subtle);
  }
  .spec-table tr:last-child {
    border-bottom: none;
  }
  .spec-table th,
  .spec-table td {
    padding: 12px 14px;
    font-size: 13.5px;
    vertical-align: top;
  }
  .spec-table th {
    width: 32%;
    color: var(--ibk-text-dim);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 11.5px;
    letter-spacing: 0.04em;
    background: var(--ibk-th-bg) !important;
    color: var(--ibk-th-text) !important;
  }
  .spec-table td {
    color: var(--ibk-text);
    font-weight: 500;
  }

  /* Status Badges */
  .badge-express-yes {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--ibk-danger-soft);
    color: var(--ibk-danger);
    border: 1px solid var(--ibk-danger-border);
    border-radius: 6px;
    padding: 3px 8px;
    font-size: 11.5px;
    font-weight: 700;
  }
  .badge-express-no {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(255, 255, 255, 0.06);
    color: var(--ibk-text-muted);
    border: 1px solid var(--ibk-border);
    border-radius: 6px;
    padding: 3px 8px;
    font-size: 11.5px;
    font-weight: 500;
  }

  /* Design Preview Card */
  .design-preview-box {
    text-align: center;
    padding: 16px;
    border-radius: 8px;
    background: var(--ibk-surface);
    border: 1px solid var(--ibk-border);
  }
  .design-preview-box img {
    max-width: 100%;
    max-height: 380px;
    border-radius: 8px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
    border: 1px solid var(--ibk-border);
    object-fit: contain;
  }

  .design-empty-state {
    padding: 40px 20px;
    text-align: center;
    color: var(--ibk-text-dim);
  }
  .design-empty-state i {
    font-size: 48px;
    display: block;
    margin-bottom: 12px;
    opacity: 0.4;
  }

  @media print {
    .ibk-page-header, .ref-theme-toggle, .btn-print-cta, .btn-ref-back, .btn-edit-cta {
      display: none !important;
    }
    body, .detail-page-wrapper {
      background: #FFFFFF !important;
      color: #000000 !important;
      padding: 0 !important;
      margin: 0 !important;
    }
    .ibk-detail-card {
      border: 1px solid #000000 !important;
      box-shadow: none !important;
    }
  }
</style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="detail-page-wrapper">

      {{-- Page Header --}}
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-file-text-line"></i>
            Detail SPK #{{ $spk->nomor_invoice ?? $spk->id }}
          </h1>
          <p>Surat Perintah Kerja (SPK) untuk order produksi dan teknis pengerjaan.</p>
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
          <a href="{{ url('/edit-spk/' . $spk->id) }}" class="btn-edit-cta">
            <i class="ri-edit-line"></i>
            <span>Edit SPK</span>
          </a>
          <a href="{{ url('/cetak-spk/' . $spk->id) }}" target="_blank" class="btn-print-cta">
            <i class="ri-printer-line"></i>
            <span>Cetak Dokumen SPK</span>
          </a>
        </div>
      </div>

      <div class="row g-4">
        {{-- Left: Specifications Table --}}
        <div class="col-lg-7">
          <div class="ibk-detail-card">
            <div class="ibk-card-header">
              <h2 class="ibk-card-header-title">
                <i class="ri-information-line"></i>
                Informasi & Spesifikasi Pengerjaan
              </h2>
              @if($spk->express === 'Y')
                <span class="badge-express-yes">
                  <i class="ri-flashlight-line"></i> EXPRES (PRIORITAS)
                </span>
              @else
                <span class="badge-express-no">
                  <i class="ri-time-line"></i> Normal
                </span>
              @endif
            </div>
            <div class="ibk-card-body p-0">
              <table class="spec-table">
                <tbody>
                  <tr>
                    <th>Tanggal Terbit</th>
                    <td class="num">{{ $tanggal }}</td>
                  </tr>
                  <tr>
                    <th>Nomor Invoice</th>
                    <td class="fw-bold" style="color: var(--ibk-brand-text);">{{ $spk->nomor_invoice }}</td>
                  </tr>
                  <tr>
                    <th>Pelanggan</th>
                    <td class="fw-semibold">{{ $spk->customer }}</td>
                  </tr>
                  <tr>
                    <th>Jenis Pekerjaan</th>
                    <td>
                      <span class="badge" style="background: var(--ibk-brand-soft); color: var(--ibk-brand-text); border: 1px solid var(--ibk-brand-border); padding: 4px 8px; border-radius: 6px;">
                        {{ $spk->pekerjaan }}
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th>Jumlah Pesanan</th>
                    <td class="num fw-bold">
                      {{ $spk->jumlah }} {{ $spk->satuan }}
                    </td>
                  </tr>
                  <tr>
                    <th>Jenis Bahan</th>
                    <td>{{ $spk->jenis_bahan ?: '-' }}</td>
                  </tr>
                  <tr>
                    <th>Ketebalan Bahan</th>
                    <td>{{ $spk->ketebalan ?: '-' }}</td>
                  </tr>
                  <tr>
                    <th>Ukuran</th>
                    <td>{{ $spk->ukuran ?: '-' }}</td>
                  </tr>
                  <tr>
                    <th>Catatan Lainnya</th>
                    <td style="white-space: pre-line;">{{ $spk->lain ?: '-' }}</td>
                  </tr>
                  <tr>
                    <th>Target Penyelesaian</th>
                    <td class="num fw-semibold" style="color: var(--ibk-brand-text);">
                      <i class="ri-calendar-check-line me-1"></i>{{ $target }}
                    </td>
                  </tr>
                  <tr>
                    <th>Status Produksi</th>
                    <td>
                      @if($spk->status == 1)
                        <span class="badge" style="background: var(--ibk-success-soft); color: var(--ibk-success); border: 1px solid var(--ibk-success-border); padding: 4px 8px; border-radius: 6px;">
                          <i class="ri-checkbox-circle-line me-1"></i>Selesai
                        </span>
                      @elseif($spk->status == 2)
                        <span class="badge" style="background: rgba(56, 189, 248, 0.14); color: #38BDF8; border: 1px solid rgba(56, 189, 248, 0.28); padding: 4px 8px; border-radius: 6px;">
                          <i class="ri-tools-line me-1"></i>Sedang Dikerjakan
                        </span>
                      @elseif($spk->status == 3)
                        <span class="badge" style="background: var(--ibk-danger-soft); color: var(--ibk-danger); border: 1px solid var(--ibk-danger-border); padding: 4px 8px; border-radius: 6px;">
                          <i class="ri-close-circle-line me-1"></i>Batal
                        </span>
                      @else
                        <span class="badge" style="background: var(--ibk-brand-soft); color: var(--ibk-brand-text); border: 1px solid var(--ibk-brand-border); padding: 4px 8px; border-radius: 6px;">
                          <i class="ri-time-line me-1"></i>Pending
                        </span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        {{-- Right: Design File Preview --}}
        <div class="col-lg-5">
          <div class="ibk-detail-card">
            <div class="ibk-card-header">
              <h2 class="ibk-card-header-title">
                <i class="ri-image-line"></i>
                Lampiran Desain Pengerjaan
              </h2>
              @if(!empty($spk->gambar))
                <a href="{{ asset('images/spk/' . $spk->gambar) }}" target="_blank" class="btn-ref-back" style="padding: 4px 10px; font-size: 11.5px;">
                  <i class="ri-external-link-line"></i> Buka Asli
                </a>
              @endif
            </div>
            <div class="ibk-card-body">
              @if(!empty($spk->gambar))
                <div class="design-preview-box">
                  <a href="{{ asset('images/spk/' . $spk->gambar) }}" target="_blank">
                    <img src="{{ asset('images/spk/' . $spk->gambar) }}" alt="Desain SPK #{{ $spk->nomor_invoice }}">
                  </a>
                  <div class="mt-3">
                    <a href="{{ asset('images/spk/' . $spk->gambar) }}" download class="btn-print-cta" style="font-size: 12px; padding: 6px 14px;">
                      <i class="ri-download-2-line"></i> Unduh File Desain
                    </a>
                  </div>
                </div>
              @else
                <div class="design-empty-state">
                  <i class="ri-image-line"></i>
                  <div class="fw-semibold">Tidak Ada File Desain</div>
                  <div class="small mt-1">Order ini tidak menyertakan file visual desain tambahan saat dibuat.</div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('plugins')
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
  })();
</script>
@endsection
