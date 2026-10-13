@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Profil Pengguna
       Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
       ========================================================================== */

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

    /* Section Card Container (§12.1) */
    .tokabe-section-card {
      background: #151D2A !important;
      border: 1.5px solid #28354A !important;
      border-radius: 14px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 24px;
      overflow: hidden;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-section-card:hover {
      border-color: #3B4B66 !important;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35) !important;
    }

    /* Profile Hero Header Card */
    .profile-hero-card {
      background: linear-gradient(135deg, #1A2436 0%, #111827 100%) !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 24px 28px !important;
    }
    .profile-avatar-circle {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, #06B6D4 0%, #0D9488 100%);
      border: 3px solid #1E293B;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.35);
      color: #FFFFFF;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      font-weight: 700;
      flex-shrink: 0;
      position: relative;
    }
    .profile-avatar-circle .avatar-status-dot {
      position: absolute;
      bottom: 2px;
      right: 2px;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background-color: #10B981;
      border: 2.5px solid #151D2A;
    }

    /* Role Badges (§14.1) */
    .badge-role-pemilik {
      background: rgba(168, 85, 247, 0.16) !important;
      color: #D8B4FE !important;
      border: 1px solid rgba(168, 85, 247, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 12px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-admin {
      background: rgba(14, 165, 233, 0.16) !important;
      color: #7DD3FC !important;
      border: 1px solid rgba(14, 165, 233, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 12px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-magang {
      background: rgba(245, 158, 11, 0.16) !important;
      color: #FCD34D !important;
      border: 1px solid rgba(245, 158, 11, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 12px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }
    .badge-role-default {
      background: rgba(99, 102, 241, 0.16) !important;
      color: #A5B4FC !important;
      border: 1px solid rgba(99, 102, 241, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 12px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }

    .badge-status-pill {
      background: rgba(16, 185, 129, 0.15) !important;
      color: #6EE7B7 !important;
      border: 1px solid rgba(16, 185, 129, 0.35) !important;
      font-weight: 500; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px;
    }

    /* Card Header */
    .tokabe-card-header {
      background: #1A2436 !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 16px 24px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .tokabe-card-title {
      font-size: 15.5px;
      font-weight: 700;
      color: #F8FAFC !important;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
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
      background: rgba(99, 102, 241, 0.15);
      border: 1px solid rgba(99, 102, 241, 0.35);
      color: #818CF8;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    /* Form Labels & Controls (§10) */
    .tokabe-label {
      font-size: 13px !important;
      font-weight: 600 !important;
      color: #CBD5E1 !important;
      margin-bottom: 7px !important;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .form-control {
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
    .form-control:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
      color: #FFFFFF !important;
      background-color: #0B1120 !important;
    }

    /* Read-Only State Styling */
    .form-control.is-readonly {
      background-color: #111827 !important;
      border-color: #243044 !important;
      color: #E2E8F0 !important;
      cursor: default;
    }
    .form-control.is-readonly:focus {
      box-shadow: none !important;
      border-color: #243044 !important;
    }

    /* Autofill Visibility Fix */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 1000px #0F172A inset !important;
      -webkit-text-fill-color: #F8FAFC !important;
      caret-color: #F8FAFC !important;
      transition: background-color 5000s ease-in-out 0s;
    }

    /* Password Input Group */
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
      color: #94A3B8;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      z-index: 5;
    }
    .auth-pass-inputgroup .password-addon:hover {
      color: #F8FAFC;
    }

    /* Action Buttons (§9) */
    .btn-tokabe-primary {
      background-color: #4F46E5 !important;
      border: 1.5px solid #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 42px !important;
      padding: 0 22px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      transition: all 0.15s ease !important;
      box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25) !important;
      cursor: pointer;
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
      cursor: pointer;
    }
    .btn-tokabe-reset:hover {
      background-color: #334155 !important;
      color: #F8FAFC !important;
    }

    .error-help-block {
      color: #F87171 !important;
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

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">Profil Pengguna</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Kelola informasi data pribadi dan keamanan akun Anda</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Akun</a></li>
              <li class="breadcrumb-item active">{{ Auth::user()->nama }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Container -->
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xl-7">

        <div class="tokabe-section-card">

          <!-- 1. Profile Hero Banner -->
          <div class="profile-hero-card">
            <div class="d-flex align-items-center gap-3 flex-wrap">
              <div class="profile-avatar-circle">
                <span>{{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}</span>
                <span class="avatar-status-dot" title="Status: Aktif"></span>
              </div>

              <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                  <h4 class="text-white fw-bold mb-0 fs-18">{{ Auth::user()->nama }}</h4>
                  @if (Auth::user()->role == 'Pemilik')
                    <span class="badge-role-pemilik">
                      <i class="las la-crown"></i>
                      {{ Auth::user()->role }}
                    </span>
                  @elseif (Auth::user()->role == 'Admin')
                    <span class="badge-role-admin">
                      <i class="las la-shield-alt"></i>
                      {{ Auth::user()->role }}
                    </span>
                  @elseif (Auth::user()->role == 'Magang')
                    <span class="badge-role-magang">
                      <i class="las la-user-graduate"></i>
                      {{ Auth::user()->role }}
                    </span>
                  @else
                    <span class="badge-role-default">
                      <i class="las la-user"></i>
                      {{ Auth::user()->role }}
                    </span>
                  @endif
                </div>

                <div class="d-flex align-items-center gap-3 text-muted fs-13 flex-wrap">
                  <span class="d-inline-flex align-items-center gap-1">
                    <i class="las la-envelope fs-15 text-indigo-400" style="color: #818CF8;"></i>
                    {{ Auth::user()->email }}
                  </span>
                  @if(!empty(Auth::user()->nomor_telepon) && Auth::user()->nomor_telepon != '--')
                    <span class="d-inline-flex align-items-center gap-1">
                      <i class="las la-phone fs-15 text-emerald-400" style="color: #34D399;"></i>
                      {{ Auth::user()->nomor_telepon }}
                    </span>
                  @endif
                  <span class="badge-status-pill">
                    <span style="width: 5px; height: 5px; border-radius: 50%; background: #10B981;"></span>
                    Akun Aktif
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- 2. Card Header with Mode Status -->
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <div class="tokabe-header-icon">
                <i class="las la-id-card"></i>
              </div>
              <div>
                <span>Informasi Akun & Kredensial</span>
                <span class="tokabe-card-subtitle">Data akun terdaftar di sistem Invoice Ibekami</span>
              </div>
            </div>

            <div id="mode-badge-container">
              <span id="mode-badge-readonly" class="badge" style="background: rgba(148, 163, 184, 0.15); color: #94A3B8; border: 1px solid rgba(148, 163, 184, 0.3); font-size: 12px; padding: 5px 11px; border-radius: 9999px;">
                <i class="las la-lock me-1"></i>Mode Lihat (Read-Only)
              </span>
              <span id="mode-badge-editing" class="badge" style="background: rgba(99, 102, 241, 0.2); color: #A5B4FC; border: 1px solid rgba(99, 102, 241, 0.4); font-size: 12px; padding: 5px 11px; border-radius: 9999px; display: none;">
                <i class="las la-edit me-1"></i>Mode Edit Aktif
              </span>
            </div>
          </div>

          <!-- 3. Form Body -->
          <div class="card-body p-4">
            <form method="POST" action="/invoice/profile/update/{{ Auth::user()->id }}" id="profileForm" class="needs-validation">
              @csrf
              @method('put')

              <!-- Nama Karyawan -->
              <div class="mb-3">
                <label class="tokabe-label">
                  <i class="las la-user fs-15 text-slate-400"></i>
                  Nama Lengkap
                </label>
                <input class="form-control is-readonly" placeholder="Nama Karyawan" name="namaKaryawan" id="namaKaryawan" value="{{ old('namaKaryawan', Auth::user()->nama) }}" required readonly>
                @error('namaKaryawan')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Email Karyawan -->
              <div class="mb-3">
                <label class="tokabe-label">
                  <i class="las la-envelope fs-15 text-slate-400"></i>
                  Email Karyawan
                </label>
                <input class="form-control is-readonly" type="email" name="email" id="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}" required readonly autocomplete="off">
                @error('email')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Password & Password Toggle -->
              <div class="mb-3">
                <label class="tokabe-label">
                  <i class="las la-key fs-15 text-slate-400"></i>
                  Kata Sandi / Password
                </label>
                <div class="auth-pass-inputgroup">
                  <input class="form-control password-input is-readonly" type="password" id="password-input" name="password" placeholder="Masukkan password (minimal 5 karakter)" required readonly autocomplete="new-password">
                  <button class="password-addon" type="button" aria-label="Lihat Password">
                    <i class="las la-eye"></i>
                  </button>
                </div>
                <span class="text-muted fs-12 mt-1 d-block" id="password-hint">
                  <i class="las la-info-circle me-1"></i>Ketikkan password Anda untuk verifikasi atau masukkan password baru jika ingin mengubah.
                </span>
                @error('password')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Nomor Telepon -->
              <div class="mb-4">
                <label for="phone-number" class="tokabe-label">
                  <i class="las la-phone fs-15 text-slate-400"></i>
                  Nomor Telepon
                </label>
                <input type="text" value="{{ old('no_telp', Auth::user()->nomor_telepon) }}" name="no_telp" class="form-control is-readonly" placeholder="Contoh: 0812 3456 7890" id="phone-number" readonly>
                @error('no_telp')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>

              <!-- Action Buttons Strip -->
              <div class="pt-3 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-end gap-2">
                <!-- Tombol Masuk Mode Edit (Tampil Awal) -->
                <button type="button" id="edit-button" class="btn-tokabe-primary">
                  <i class="las la-pen fs-16"></i>
                  <span>Edit Profil</span>
                </button>

                <!-- Tombol Batal Edit (Hidden Awal) -->
                <button type="button" id="batal-button" class="btn-tokabe-reset" style="display: none;">
                  <i class="las la-times fs-16"></i>
                  <span>Batal</span>
                </button>

                <!-- Tombol Simpan Perubahan (Hidden Awal) -->
                <button type="submit" id="simpan" class="btn-tokabe-primary" style="display: none;">
                  <i class="ri-save-3-line fs-16"></i>
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
{!! JsValidator::formRequest('App\Http\Requests\ProfileRequest') !!}
@endsection

@section('plugins')
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('js/pages/password-addon.init.js') }}"></script>

<script>
  $(document).ready(function() {
    // Simpan nilai awal form untuk fungsi Batal
    var initialValues = {
      namaKaryawan: $('#namaKaryawan').val(),
      email: $('#email').val(),
      password: '',
      no_telp: $('#phone-number').val()
    };

    // Tombol Edit diklik: Buka kunci readonly
    $('#edit-button').on('click', function() {
      var editableInputs = $('#profileForm input:not([name="_token"]):not([name="_method"])');
      
      editableInputs.removeAttr('readonly').removeClass('is-readonly');
      
      $('#edit-button').hide();
      $('#batal-button').show();
      $('#simpan').show();
      
      $('#mode-badge-readonly').hide();
      $('#mode-badge-editing').show();
      
      $('#namaKaryawan').focus();
    });

    // Tombol Batal diklik: Kembalikan ke mode readonly dan reset nilai
    $('#batal-button').on('click', function() {
      var editableInputs = $('#profileForm input:not([name="_token"]):not([name="_method"])');
      
      editableInputs.attr('readonly', true).addClass('is-readonly');
      
      // Reset input ke nilai awal
      $('#namaKaryawan').val(initialValues.namaKaryawan);
      $('#email').val(initialValues.email);
      $('#password-input').val('');
      $('#phone-number').val(initialValues.no_telp);
      
      $('#edit-button').show();
      $('#batal-button').hide();
      $('#simpan').hide();
      
      $('#mode-badge-readonly').show();
      $('#mode-badge-editing').hide();
    });
  });
</script>
@endsection