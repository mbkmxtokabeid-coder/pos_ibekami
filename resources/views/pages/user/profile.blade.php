@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ==========================================================================
       TOKABE PROFIL PENGGUNA — WARM STONE DUAL-THEME SYSTEM
       ========================================================================== */

    :root {
      --ibk-bg: #0C0A09;
      --ibk-surface: #14110F;
      --ibk-surface-hover: #1C1917;
      --ibk-card-bg: #14110F;
      --ibk-card-shadow: 0 1px 3px rgba(0, 0, 0, 0.28);
      --ibk-border: rgba(255, 255, 255, 0.08);
      --ibk-border-subtle: rgba(255, 255, 255, 0.05);
      --ibk-text: #F5F5F4;
      --ibk-text-muted: #A8A29E;
      --ibk-text-dim: #78716C;

      --ibk-brand: #EA580C;
      --ibk-brand-hover: #C2410C;
      --ibk-brand-soft: rgba(234, 88, 12, 0.12);
      --ibk-brand-border: rgba(234, 88, 12, 0.28);
      --ibk-brand-text: #FDBA74;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.14);
      --ibk-success-border: rgba(16, 185, 129, 0.28);
      --ibk-success-text: #6EE7B7;

      --ibk-warning-soft: rgba(245, 158, 11, 0.14);
      --ibk-warning-border: rgba(245, 158, 11, 0.3);
      --ibk-warning-text: #FCD34D;

      --ibk-danger-text: #FCA5A5;

      --ibk-info-soft: rgba(14, 165, 233, 0.14);
      --ibk-info-border: rgba(14, 165, 233, 0.3);
      --ibk-info-text: #7DD3FC;

      --ibk-purple-soft: rgba(168, 85, 247, 0.14);
      --ibk-purple-border: rgba(168, 85, 247, 0.3);
      --ibk-purple-text: #D8B4FE;

      --ibk-input-bg: #1C1917;
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #F5F5F4;
      --ibk-readonly-bg: #181412;
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      --ibk-bg: #F7F6F2;
      --ibk-surface: #FFFFFF;
      --ibk-surface-hover: #FAF8F5;
      --ibk-card-bg: #FFFFFF;
      --ibk-card-shadow: 0 1px 3px rgba(28, 25, 23, 0.05);
      --ibk-border: #E6E1D8;
      --ibk-border-subtle: #F0ECE3;
      --ibk-text: #1C1917;
      --ibk-text-muted: #57534E;
      --ibk-text-dim: #78716C;

      --ibk-brand: #EA580C;
      --ibk-brand-hover: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #C2410C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-success-text: #047857;

      --ibk-warning-soft: #FFFBEB;
      --ibk-warning-border: #FDE68A;
      --ibk-warning-text: #B45309;

      --ibk-danger-text: #B91C1C;

      --ibk-info-soft: #F0F9FF;
      --ibk-info-border: #BAE6FD;
      --ibk-info-text: #0369A1;

      --ibk-purple-soft: #FAF5FF;
      --ibk-purple-border: #E9D5FF;
      --ibk-purple-text: #7E22CE;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #D6D0C4;
      --ibk-input-text: #1C1917;
      --ibk-readonly-bg: #FAF8F5;
    }

    .profile-page-wrapper {
      position: relative;
      width: 100%;
      padding-bottom: 48px;
      font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
      color: var(--ibk-text);
    }

    /* Page Header */
    .ibk-page-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 20px;
    }
    .ibk-page-title h1 {
      font-size: 20px;
      font-weight: 700;
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

    /* Main Card */
    .ibk-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 14px;
      box-shadow: var(--ibk-card-shadow);
      overflow: hidden;
    }

    /* Profile Hero Header */
    .profile-hero-card {
      background: var(--ibk-surface-hover);
      border-bottom: 1px solid var(--ibk-border);
      padding: 22px 24px;
    }
    .profile-avatar-circle {
      width: 68px;
      height: 68px;
      border-radius: 50%;
      background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%);
      border: 3px solid var(--ibk-surface);
      box-shadow: 0 4px 14px rgba(234, 88, 12, 0.28);
      color: #FFFFFF;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 26px;
      font-weight: 700;
      flex-shrink: 0;
      position: relative;
    }
    .profile-avatar-circle .avatar-status-dot {
      position: absolute;
      bottom: 1px;
      right: 1px;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background-color: var(--ibk-success);
      border: 2.5px solid var(--ibk-surface);
    }
    .profile-hero-name {
      font-size: 18px;
      font-weight: 700;
      color: var(--ibk-text);
      margin: 0;
    }
    .profile-hero-meta {
      display: flex;
      align-items: center;
      gap: 14px;
      flex-wrap: wrap;
      font-size: 13px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
    }
    .profile-hero-meta-item {
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .profile-hero-meta-item i {
      color: var(--ibk-brand);
      font-size: 15px;
    }

    /* Role & Status Badges */
    .badge-role-pemilik {
      background: var(--ibk-purple-soft);
      color: var(--ibk-purple-text);
      border: 1px solid var(--ibk-purple-border);
      font-weight: 600; font-size: 12px; padding: 3px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-admin {
      background: var(--ibk-info-soft);
      color: var(--ibk-info-text);
      border: 1px solid var(--ibk-info-border);
      font-weight: 600; font-size: 12px; padding: 3px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-magang {
      background: var(--ibk-warning-soft);
      color: var(--ibk-warning-text);
      border: 1px solid var(--ibk-warning-border);
      font-weight: 600; font-size: 12px; padding: 3px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-default {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      font-weight: 600; font-size: 12px; padding: 3px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-status-pill {
      background: var(--ibk-success-soft);
      color: var(--ibk-success-text);
      border: 1px solid var(--ibk-success-border);
      font-weight: 600; font-size: 12px; padding: 3px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 6px;
    }
    .badge-status-pill .status-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--ibk-success);
    }

    /* Section Header */
    .ibk-card-header {
      padding: 14px 24px;
      border-bottom: 1px solid var(--ibk-border);
      background: var(--ibk-surface);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .ibk-card-heading {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .ibk-header-icon {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      flex-shrink: 0;
    }
    .ibk-card-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
    }
    .ibk-card-subtitle {
      font-size: 12px;
      color: var(--ibk-text-muted);
      display: block;
    }

    .badge-mode-readonly {
      background: var(--ibk-surface-hover);
      color: var(--ibk-text-muted);
      border: 1px solid var(--ibk-border);
      font-size: 12px;
      font-weight: 600;
      padding: 4px 11px;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .badge-mode-editing {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      font-size: 12px;
      font-weight: 600;
      padding: 4px 11px;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    /* Form Controls */
    .tokabe-label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: var(--ibk-text) !important;
      margin-bottom: 6px !important;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .tokabe-label i {
      color: var(--ibk-text-muted);
      font-size: 15px;
    }
    .profile-page-wrapper .form-control {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 8px 14px !important;
      font-size: 13.5px !important;
      height: 40px !important;
      transition: border-color 150ms ease, box-shadow 150ms ease, background-color 150ms ease;
    }
    .profile-page-wrapper .form-control::placeholder {
      color: var(--ibk-text-dim) !important;
    }
    .profile-page-wrapper .form-control:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      color: var(--ibk-text) !important;
      outline: none !important;
    }
    .profile-page-wrapper .form-control.is-readonly {
      background-color: var(--ibk-readonly-bg) !important;
      border-color: var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      cursor: default;
    }
    .profile-page-wrapper .form-control.is-readonly:focus {
      box-shadow: none !important;
      border-color: var(--ibk-border) !important;
    }

    .auth-pass-inputgroup {
      position: relative;
    }
    .auth-pass-inputgroup .password-addon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--ibk-text-muted);
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      z-index: 5;
    }
    .auth-pass-inputgroup .password-addon:hover {
      color: var(--ibk-text);
    }

    /* Digital Signature Box */
    .ttd-upload-box {
      padding: 16px;
      border-radius: 10px;
      background: var(--ibk-surface-hover);
      border: 1px dashed var(--ibk-border);
    }
    .ttd-preview-box {
      padding: 10px;
      border-radius: 8px;
      background: var(--ibk-surface);
      border: 1px solid var(--ibk-border);
      min-width: 170px;
      min-height: 90px;
      display: inline-flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .badge-ttd-info {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      font-size: 11px;
      font-weight: 600;
      padding: 3px 9px;
      border-radius: 9999px;
    }

    /* Action Buttons */
    .ibk-btn-primary {
      background: var(--ibk-brand-btn-bg) !important;
      border: 1px solid var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      padding: 0 20px !important;
      height: 40px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 7px !important;
      cursor: pointer !important;
      transition: background-color 150ms ease, box-shadow 150ms ease !important;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
    }
    .ibk-btn-primary:hover {
      background: var(--ibk-brand-hover) !important;
      border-color: var(--ibk-brand-hover) !important;
    }
    .btn-tokabe-cancel {
      background: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      font-weight: 600 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 18px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer;
      transition: background-color 150ms ease, color 150ms ease;
    }
    .btn-tokabe-cancel:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
    }
    .ibk-btn-primary:focus-visible,
    .btn-tokabe-cancel:focus-visible,
    .ref-theme-toggle:focus-visible {
      outline: 2px solid var(--ibk-brand) !important;
      outline-offset: 2px !important;
    }
    .error-help-block {
      color: var(--ibk-danger-text) !important;
      font-size: 12px;
      margin-top: 4px;
      display: block;
    }
  </style>
@endsection

@extends('layout.template')

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="profile-page-wrapper">

      <!-- 1. Header & Theme Toggle -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-user-settings-line" aria-hidden="true"></i>
            <span>Profil Pengguna</span>
          </h1>
          <div class="ibk-page-subtitle">Kelola informasi data pribadi dan keamanan akun Anda</div>
        </div>
        <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
          <i class="ri-sun-line fs-14" id="theme-toggle-icon" aria-hidden="true"></i>
          <span id="theme-toggle-text">Mode Terang</span>
        </button>
      </div>

      <!-- 2. Main Profile Card -->
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
          <div class="ibk-card">

            <!-- Profile Hero Banner -->
            <div class="profile-hero-card">
              <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="profile-avatar-circle">
                  <span>{{ mb_strtoupper(mb_substr(trim((string) (Auth::user()->nama ?? 'U')), 0, 1)) }}</span>
                  <span class="avatar-status-dot" title="Status: Aktif"></span>
                </div>

                <div class="flex-grow-1">
                  <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h2 class="profile-hero-name">{{ Auth::user()->nama }}</h2>
                    @if (Auth::user()->role == 'Pemilik')
                      <span class="badge-role-pemilik">
                        <i class="ri-vip-crown-line" aria-hidden="true"></i>
                        <span>{{ Auth::user()->role }}</span>
                      </span>
                    @elseif (Auth::user()->role == 'Admin')
                      <span class="badge-role-admin">
                        <i class="ri-shield-user-line" aria-hidden="true"></i>
                        <span>{{ Auth::user()->role }}</span>
                      </span>
                    @elseif (Auth::user()->role == 'Magang')
                      <span class="badge-role-magang">
                        <i class="ri-graduation-cap-line" aria-hidden="true"></i>
                        <span>{{ Auth::user()->role }}</span>
                      </span>
                    @else
                      <span class="badge-role-default">
                        <i class="ri-user-line" aria-hidden="true"></i>
                        <span>{{ Auth::user()->role }}</span>
                      </span>
                    @endif
                  </div>

                  <div class="profile-hero-meta">
                    <span class="profile-hero-meta-item">
                      <i class="ri-mail-line" aria-hidden="true"></i>
                      <span>{{ Auth::user()->email }}</span>
                    </span>
                    @if(!empty(Auth::user()->nomor_telepon) && Auth::user()->nomor_telepon != '--')
                      <span class="profile-hero-meta-item" style="font-variant-numeric: tabular-nums;">
                        <i class="ri-phone-line" aria-hidden="true"></i>
                        <span>{{ Auth::user()->nomor_telepon }}</span>
                      </span>
                    @endif
                    <span class="badge-status-pill">
                      <span class="status-dot" aria-hidden="true"></span>
                      <span>Akun Aktif</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card Header with Mode Status -->
            <div class="ibk-card-header">
              <div class="ibk-card-heading">
                <span class="ibk-header-icon" aria-hidden="true">
                  <i class="ri-id-card-line"></i>
                </span>
                <div>
                  <h3 class="ibk-card-title">Informasi Akun &amp; Kredensial</h3>
                  <span class="ibk-card-subtitle">Data akun terdaftar di sistem Invoice Ibekami</span>
                </div>
              </div>

              <div id="mode-badge-container">
                <span id="mode-badge-readonly" class="badge-mode-readonly">
                  <i class="ri-lock-line" aria-hidden="true"></i>
                  <span>Mode Lihat (Read-Only)</span>
                </span>
                <span id="mode-badge-editing" class="badge-mode-editing" style="display: none;">
                  <i class="ri-edit-line" aria-hidden="true"></i>
                  <span>Mode Edit Aktif</span>
                </span>
              </div>
            </div>

            <!-- Form Body -->
            <div class="card-body p-4">
              <form method="POST" action="/invoice/profile/update/{{ Auth::user()->id }}" id="profileForm" class="needs-validation" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3">
                  <label class="tokabe-label" for="namaKaryawan">
                    <i class="ri-user-line" aria-hidden="true"></i>
                    <span>Nama Lengkap</span>
                  </label>
                  <input class="form-control is-readonly" placeholder="Nama Karyawan" name="namaKaryawan" id="namaKaryawan" value="{{ old('namaKaryawan', Auth::user()->nama) }}" required readonly>
                  @error('namaKaryawan')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="tokabe-label" for="email">
                    <i class="ri-mail-line" aria-hidden="true"></i>
                    <span>Email Karyawan</span>
                  </label>
                  <input class="form-control is-readonly" type="email" name="email" id="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}" required readonly autocomplete="off">
                  @error('email')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="tokabe-label" for="password-input">
                    <i class="ri-key-2-line" aria-hidden="true"></i>
                    <span>Kata Sandi / Password</span>
                  </label>
                  <div class="auth-pass-inputgroup">
                    <input class="form-control password-input is-readonly" type="password" id="password-input" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" readonly autocomplete="new-password">
                    <button class="password-addon" type="button" aria-label="Lihat Password">
                      <i class="ri-eye-line" aria-hidden="true"></i>
                    </button>
                  </div>
                  <span class="fs-12 mt-1 d-block" id="password-hint" style="color: var(--ibk-text-muted);">
                    <i class="ri-information-line me-1" aria-hidden="true"></i>Kosongkan jika tidak ingin mengubah password. Masukkan password baru (minimal 5 karakter) untuk mengganti.
                  </span>
                  @error('password')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="phone-number" class="tokabe-label">
                    <i class="ri-phone-line" aria-hidden="true"></i>
                    <span>Nomor Telepon</span>
                  </label>
                  <input type="text" value="{{ old('no_telp', Auth::user()->nomor_telepon) }}" name="no_telp" class="form-control is-readonly" placeholder="Contoh: 0812 3456 7890" id="phone-number" readonly>
                  @error('no_telp')
                    <span class="error-help-block">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Tanda Tangan Digital Admin -->
                <div class="ttd-upload-box mb-4">
                  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                    <label class="tokabe-label mb-0" for="profile-input-tanda-tangan">
                      <i class="ri-quill-pen-line" style="color: var(--ibk-brand);" aria-hidden="true"></i>
                      <span>Tanda Tangan Digital Admin</span>
                    </label>
                    <span class="badge-ttd-info">Otomatis tampil saat Invoice Lunas</span>
                  </div>
                  <p class="fs-12 mb-3" style="color: var(--ibk-text-muted);">
                    Tanda tangan digital ini akan otomatis disematkan pada setiap lembar invoice yang Anda terbitkan ketika invoice berstatus <strong>Lunas</strong>. Format yang didukung: PNG (transparan disarankan), JPG, JPEG, WEBP (maks. 2MB).
                  </p>

                  <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                      <div class="ttd-preview-box">
                        @if(Auth::user()->tanda_tangan_url)
                          <img src="{{ Auth::user()->tanda_tangan_url }}" id="profile-preview-ttd" alt="Tanda Tangan {{ Auth::user()->nama }}" style="max-height: 75px; max-width: 160px; object-fit: contain;">
                          <span class="fs-11 mt-1 d-block fw-medium" id="profile-status-ttd" style="color: var(--ibk-success-text);">
                            <i class="ri-checkbox-circle-line" aria-hidden="true"></i> Tanda Tangan Aktif
                          </span>
                        @else
                          <img src="" id="profile-preview-ttd" alt="Preview TTD" style="max-height: 75px; max-width: 160px; object-fit: contain; display: none;">
                          <div id="profile-no-ttd-placeholder" class="fs-12 py-2" style="color: var(--ibk-text-dim);">
                            <i class="ri-image-line fs-24 d-block mb-1" aria-hidden="true"></i>
                            <span>Belum ada tanda tangan</span>
                          </div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-7" id="profile-ttd-actions" style="display: none;">
                      <label class="form-label fs-12 fw-semibold mb-1" style="color: var(--ibk-text);" for="profile-input-tanda-tangan">Unggah Tanda Tangan Baru</label>
                      <input type="file" class="form-control" name="tanda_tangan" id="profile-input-tanda-tangan" accept="image/png,image/jpeg,image/jpg,image/webp" onchange="previewProfileTandaTangan(this)">
                      <span class="fs-11 mt-1 d-block" style="color: var(--ibk-text-muted);">
                        Pilih file baru untuk mengganti tanda tangan saat ini.
                      </span>
                      @if(Auth::user()->tanda_tangan)
                        <div class="form-check mt-2">
                          <input class="form-check-input" type="checkbox" name="hapus_tanda_tangan" value="1" id="profile_hapus_ttd">
                          <label class="form-check-label fs-12" style="color: var(--ibk-danger-text);" for="profile_hapus_ttd">
                            Hapus tanda tangan digital saat ini
                          </label>
                        </div>
                      @endif
                      @error('tanda_tangan')
                        <span class="error-help-block">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-sm-7 fs-12" id="profile-ttd-readonly-note" style="color: var(--ibk-text-muted);">
                      <i class="ri-information-line me-1" style="color: var(--ibk-brand);" aria-hidden="true"></i>
                      Klik <strong>Edit Profil</strong> di bawah untuk mengunggah atau memperbarui tanda tangan digital Anda.
                    </div>
                  </div>
                </div>

                <!-- Action Buttons Strip -->
                <div class="pt-3 d-flex align-items-center justify-content-end gap-2" style="border-top: 1px solid var(--ibk-border);">
                  <button type="button" id="edit-button" class="ibk-btn-primary">
                    <i class="ri-pencil-line fs-16" aria-hidden="true"></i>
                    <span>Edit Profil</span>
                  </button>

                  <button type="button" id="batal-button" class="btn-tokabe-cancel" style="display: none;">
                    <i class="ri-close-line fs-16" aria-hidden="true"></i>
                    <span>Batal</span>
                  </button>

                  <button type="submit" id="simpan" class="ibk-btn-primary" style="display: none;">
                    <i class="ri-save-3-line fs-16" aria-hidden="true"></i>
                    <span>Simpan Perubahan</span>
                  </button>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\ProfileRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('js/pages/password-addon.init.js') }}"></script>

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

  $(document).ready(function () {
    initPageTheme();

    var initialValues = {
      namaKaryawan: $('#namaKaryawan').val(),
      email: $('#email').val(),
      password: '',
      no_telp: $('#phone-number').val()
    };

    $('#edit-button').on('click', function () {
      var editableInputs = $('#profileForm input:not([name="_token"]):not([name="_method"]):not([type="file"]):not([type="checkbox"])');
      editableInputs.removeAttr('readonly').removeClass('is-readonly');

      $('#edit-button').hide();
      $('#batal-button').show();
      $('#simpan').show();

      $('#mode-badge-readonly').hide();
      $('#mode-badge-editing').show();

      $('#profile-ttd-actions').show();
      $('#profile-ttd-readonly-note').hide();

      $('#namaKaryawan').focus();
    });

    $('#batal-button').on('click', function () {
      var editableInputs = $('#profileForm input:not([name="_token"]):not([name="_method"]):not([type="file"]):not([type="checkbox"])');
      editableInputs.attr('readonly', true).addClass('is-readonly');

      $('#namaKaryawan').val(initialValues.namaKaryawan);
      $('#email').val(initialValues.email);
      $('#password-input').val('');
      $('#phone-number').val(initialValues.no_telp);
      $('#profile-input-tanda-tangan').val('');
      if ($('#profile_hapus_ttd').length) {
        $('#profile_hapus_ttd').prop('checked', false);
      }

      $('#edit-button').show();
      $('#batal-button').hide();
      $('#simpan').hide();

      $('#mode-badge-readonly').show();
      $('#mode-badge-editing').hide();

      $('#profile-ttd-actions').hide();
      $('#profile-ttd-readonly-note').show();
    });
  });

  function previewProfileTandaTangan(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#profile-preview-ttd').attr('src', e.target.result).show();
        $('#profile-no-ttd-placeholder').hide();
        if ($('#profile-status-ttd').length) {
          $('#profile-status-ttd').html('<i class="ri-upload-2-line"></i> File Baru Dipilih').css('color', 'var(--ibk-brand-text)');
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
