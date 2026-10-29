@section('head')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
       Module: Daftar Karyawan
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
      border-radius: 12px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
      margin-bottom: 24px;
      overflow: hidden;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-section-card:hover {
      border-color: #3B4B66 !important;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35) !important;
    }

    .tokabe-card-header {
      background: #1A2436 !important;
      border-bottom: 1.5px solid #28354A !important;
      padding: 16px 20px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .tokabe-card-title {
      font-size: 16px;
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

    /* Icon Accent Badge */
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

    /* Primary Action Button (§9) */
    .btn-tokabe-primary {
      background-color: #4F46E5 !important;
      border-color: #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      text-decoration: none !important;
      transition: all 0.15s ease !important;
      box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25) !important;
    }
    .btn-tokabe-primary:hover {
      background-color: #4338CA !important;
      border-color: #3730A3 !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
      transform: translateY(-1px);
    }

    /* Table Design Tokens (§13.1) */
    .tokabe-table {
      margin-bottom: 0 !important;
      border-color: #28354A !important;
      width: 100% !important;
    }
    .tokabe-table thead th {
      background-color: #101726 !important;
      color: #94A3B8 !important;
      font-size: 11.5px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 12px 16px !important;
      border-bottom: 2px solid #28354A !important;
      border-top: none !important;
      white-space: nowrap;
    }
    .tokabe-table tbody tr {
      background-color: #151D2A !important;
      transition: background-color 0.15s ease;
    }
    .tokabe-table tbody tr:hover {
      background-color: #1E293B !important;
    }
    .tokabe-table tbody td {
      padding: 12px 16px !important;
      border-bottom: 1px solid #243044 !important;
      color: #E2E8F0 !important;
      font-size: 13.5px !important;
      vertical-align: middle !important;
    }

    /* User Avatar */
    .user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(99, 102, 241, 0.18);
      border: 1px solid rgba(99, 102, 241, 0.35);
      color: #A5B4FC;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 600;
      flex-shrink: 0;
    }

    /* Role Badges (§14) */
    .badge-role-pemilik {
      background: rgba(168, 85, 247, 0.16) !important;
      color: #D8B4FE !important;
      border: 1px solid rgba(168, 85, 247, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 4px;
    }
    .badge-role-admin {
      background: rgba(14, 165, 233, 0.16) !important;
      color: #7DD3FC !important;
      border: 1px solid rgba(14, 165, 233, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 4px;
    }
    .badge-role-magang {
      background: rgba(245, 158, 11, 0.16) !important;
      color: #FCD34D !important;
      border: 1px solid rgba(245, 158, 11, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 4px;
    }
    .badge-role-default {
      background: rgba(99, 102, 241, 0.16) !important;
      color: #A5B4FC !important;
      border: 1px solid rgba(99, 102, 241, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 4px;
    }

    /* Status Badges with Dot (§14.1) */
    .badge-status-aktif {
      background: rgba(16, 185, 129, 0.16) !important;
      color: #6EE7B7 !important;
      border: 1px solid rgba(52, 211, 153, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 6px;
    }
    .badge-status-aktif .status-dot {
      width: 6px; height: 6px; border-radius: 50%; background-color: #10B981;
    }

    .badge-status-nonaktif {
      background: rgba(239, 68, 68, 0.16) !important;
      color: #FCA5A5 !important;
      border: 1px solid rgba(239, 68, 68, 0.4) !important;
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 6px;
    }
    .badge-status-nonaktif .status-dot {
      width: 6px; height: 6px; border-radius: 50%; background-color: #EF4444;
    }

    /* Action Buttons */
    .btn-action-edit {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(245, 158, 11, 0.16) !important;
      border: 1.5px solid rgba(245, 158, 11, 0.4) !important;
      color: #FCD34D !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.15s ease;
      cursor: pointer;
      text-decoration: none;
    }
    .btn-action-edit:hover {
      background: #F59E0B !important;
      color: #111827 !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.35);
    }

    .btn-action-toggle {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.15s ease;
      cursor: pointer;
      text-decoration: none;
    }
    .btn-action-deactivate {
      background: rgba(239, 68, 68, 0.16) !important;
      border: 1.5px solid rgba(239, 68, 68, 0.4) !important;
      color: #FCA5A5 !important;
    }
    .btn-action-deactivate:hover {
      background: #EF4444 !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.35);
    }
    .btn-action-activate {
      background: rgba(16, 185, 129, 0.16) !important;
      border: 1.5px solid rgba(52, 211, 153, 0.4) !important;
      color: #6EE7B7 !important;
    }
    .btn-action-activate:hover {
      background: #10B981 !important;
      color: #FFFFFF !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.35);
    }

    /* DataTables Dark Theme Overrides */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
      color: #94A3B8 !important;
      font-size: 13px !important;
      padding: 12px 16px !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 6px !important;
      padding: 4px 10px !important;
      margin: 0 6px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 6px !important;
      padding: 6px 12px !important;
      margin-left: 8px !important;
      outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background: #1A2436 !important;
      border: 1px solid #28354A !important;
      color: #CBD5E1 !important;
      border-radius: 6px !important;
      margin: 0 3px !important;
      padding: 5px 11px !important;
      font-size: 12.5px !important;
      transition: all 0.15s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: #334155 !important;
      border-color: #475569 !important;
      color: #FFFFFF !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: #4F46E5 !important;
      border-color: #4338CA !important;
      color: #FFFFFF !important;
      font-weight: 600 !important;
    }

    /* Custom dark scrollbar */
    .table-responsive::-webkit-scrollbar {
      height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
      background: #0F172A;
    }
    .table-responsive::-webkit-scrollbar-thumb {
      background: #334155;
      border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
      background: #475569;
    }

    /* Modal Dark Theme Styles */
    .modal-content.tokabe-modal-dark {
      background-color: #161B22 !important;
      border: 1px solid #1E293B !important;
      border-radius: 16px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
      overflow: hidden;
    }
    .tokabe-modal-header {
      border-bottom: 1px solid #1E293B !important;
      padding: 18px 24px !important;
      background-color: transparent !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-body {
      padding: 22px 24px !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid #1E293B !important;
      padding: 16px 24px !important;
      background-color: rgba(15, 23, 42, 0.5) !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 12px;
    }
    .form-label-modern {
      font-size: 13px;
      font-weight: 600;
      color: #CBD5E1;
      margin-bottom: 6px;
      display: block;
    }
    .form-label-modern .required-star {
      color: #EF4444;
      margin-left: 2px;
    }
    .form-control-modern,
    .form-select-modern {
      background-color: #0F172A !important;
      border: 1.5px solid #334155 !important;
      color: #F8FAFC !important;
      border-radius: 8px !important;
      height: 42px !important;
      font-size: 13.5px !important;
      padding: 8px 14px !important;
      transition: all 0.15s ease;
    }
    .form-control-modern::placeholder {
      color: #64748B !important;
    }
    .form-control-modern:focus,
    .form-select-modern:focus {
      border-color: #6366F1 !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
      color: #FFFFFF !important;
      background-color: #0B1120 !important;
    }
    .form-control-modern:-webkit-autofill,
    .form-control-modern:-webkit-autofill:hover, 
    .form-control-modern:-webkit-autofill:focus, 
    .form-control-modern:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 1000px #0F172A inset !important;
      -webkit-text-fill-color: #F8FAFC !important;
      caret-color: #F8FAFC !important;
      transition: background-color 5000s ease-in-out 0s;
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
    .btn-tokabe-reset {
      background-color: #1E293B !important;
      border: 1.5px solid #334155 !important;
      color: #94A3B8 !important;
      font-weight: 500 !important;
      font-size: 13.5px !important;
      border-radius: 8px !important;
      height: 40px !important;
      padding: 0 16px !important;
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
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Karyawan</h4>
            <span class="text-muted fs-13 d-none d-sm-inline">Kelola akun pengguna, hak akses role, dan status aktif staf</span>
          </div>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Karyawan</a></li>
              <li class="breadcrumb-item active">Daftar Karyawan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Feedback Alerts -->
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #6EE7B7;">
        <i class="fas fa-check-circle fs-18"></i>
        <div class="flex-grow-1">{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.35); color: #FCA5A5;">
        <i class="fas fa-exclamation-circle fs-18"></i>
        <div class="flex-grow-1">{{ session('error') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Main Section Card (§12.1) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">

          <!-- Card Header with Title and Add Button -->
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <div class="tokabe-header-icon">
                <i class="las la-address-book"></i>
              </div>
              <div>
                <span>Data Karyawan & Hak Akses</span>
                <span class="tokabe-card-subtitle">Total {{ count($users) }} personil terdaftar dalam sistem</span>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <button type="button" class="btn-tokabe-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKaryawan">
                <i class="las la-plus fs-16"></i>
                <span>Tambah Karyawan</span>
              </button>
            </div>
          </div>

          <!-- Table Container -->
          <div class="card-body p-0">
            <div class="table-responsive p-3">
              <table id="alternative-pagination" class="table nowrap align-middle tokabe-table" style="width:100%">
                <thead>
                  <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th class="text-center">Role</th>
                    <th>Nomor Telepon</th>
                    <th class="text-center">Tanda Tangan</th>
                    <th class="text-center">Status</th>
                    <th style="width: 100px; text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td class="text-center fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <div class="user-avatar">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                          </div>
                          <div>
                            <span class="fw-semibold text-white">{{ $user->nama }}</span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <a href="mailto:{{ $user->email }}" class="text-slate-300 text-decoration-none" style="color: #CBD5E1;">
                          <i class="las la-envelope me-1 text-slate-500"></i>{{ $user->email }}
                        </a>
                      </td>
                      <td class="text-center">
                        @if ($user->role == "Pemilik")
                          <span class="badge-role-pemilik">
                            <i class="las la-crown"></i>
                            {{ $user->role }}
                          </span>
                        @elseif($user->role == "Admin")
                          <span class="badge-role-admin">
                            <i class="las la-shield-alt"></i>
                            {{ $user->role }}
                          </span>
                        @elseif($user->role == "Magang")
                          <span class="badge-role-magang">
                            <i class="las la-user-graduate"></i>
                            {{ $user->role }}
                          </span>
                        @else
                          <span class="badge-role-default">
                            <i class="las la-user"></i>
                            {{ $user->role }}
                          </span>
                        @endif
                      </td>
                      <td>
                        @if(!empty($user->nomor_telepon) && $user->nomor_telepon != '--')
                          <a href="tel:{{ $user->nomor_telepon }}" class="d-inline-flex align-items-center gap-1 text-decoration-none" style="color: #34D399; font-variant-numeric: tabular-nums; font-weight: 500;" title="Hubungi {{ $user->nama }}">
                            <i class="las la-phone fs-16"></i>
                            <span>{{ $user->nomor_telepon }}</span>
                          </a>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                      <td class="text-center">
                        @if ($user->tanda_tangan_url)
                          <a href="{{ $user->tanda_tangan_url }}" target="_blank" class="d-inline-flex align-items-center gap-1 text-decoration-none px-2 py-1 rounded-2" style="background: rgba(16, 185, 129, 0.12); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11.5px; font-weight: 500;" title="Lihat Tanda Tangan {{ $user->nama }}">
                            <i class="las la-signature fs-14"></i>
                            <span>Ada TTD</span>
                          </a>
                        @else
                          @if ($user->role == 'Admin')
                            <span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-2" style="background: rgba(245, 158, 11, 0.12); color: #FBBF24; border: 1px solid rgba(245, 158, 11, 0.3); font-size: 11.5px; font-weight: 500;" title="Admin belum mengunggah tanda tangan digital">
                              <i class="las la-exclamation-triangle fs-14"></i>
                              <span>Belum Ada</span>
                            </span>
                          @else
                            <span class="text-muted fs-12">-</span>
                          @endif
                        @endif
                      </td>
                      <td class="text-center">
                        @if ($user->status == 'Aktif')
                          <span class="badge-status-aktif">
                            <span class="status-dot"></span>
                            Aktif
                          </span>
                        @else
                          <span class="badge-status-nonaktif">
                            <span class="status-dot"></span>
                            Non Aktif
                          </span>
                        @endif
                      </td>
                      <td class="text-center">
                        <div class="d-inline-flex align-items-center justify-content-center gap-2">
                          <!-- Edit Button -->
                          <a href="{{ route('user.edit', $user->id) }}" class="btn-action-edit" title="Edit Karyawan {{ $user->nama }}">
                            <i class="las la-pen"></i>
                          </a>

                          <!-- Status Toggle Button -->
                          @if ($user->status == 'Aktif')
                            <a href="{{ route('user.status', $user->id) }}" class="btn-action-toggle btn-action-deactivate" title="Nonaktifkan akun {{ $user->nama }}">
                              <i class="las la-user-times"></i>
                            </a>
                          @else
                            <a href="{{ route('user.status', $user->id) }}" class="btn-action-toggle btn-action-activate" title="Aktifkan kembali akun {{ $user->nama }}">
                              <i class="las la-user-check"></i>
                            </a>
                          @endif
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

{{-- MODAL POPUP: TAMBAH KARYAWAN --}}
<div class="modal fade" id="modalTambahKaryawan" tabindex="-1" aria-labelledby="modalTambahKaryawanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal-dark">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2 mb-1" id="modalTambahKaryawanLabel">
            <i class="las la-user-plus fs-20 text-primary"></i>
            <span>Tambah Karyawan Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Registrasi akun baru untuk karyawan atau staf internal sistem</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form method="POST" action="{{ route('user.store') }}" id="formTambahKaryawan" class="needs-validation" enctype="multipart/form-data">
        @csrf
        <div class="tokabe-modal-body">
          <!-- Input Nama Karyawan -->
          <div class="mb-3">
            <label class="form-label-modern" for="inputNamaKaryawan">
              Nama Lengkap <span class="required-star">*</span>
            </label>
            <input type="text" class="form-control form-control-modern" id="inputNamaKaryawan" placeholder="Nama Lengkap Karyawan" name="namaKaryawan" value="{{ old('namaKaryawan') }}" required autocomplete="off">
            @error('namaKaryawan')
              <span class="error-help-block">{{ $message }}</span>
            @enderror
          </div>

          <!-- Input Email -->
          <div class="mb-3">
            <label class="form-label-modern" for="inputEmailKaryawan">
              Email Karyawan <span class="required-star">*</span>
            </label>
            <input type="email" class="form-control form-control-modern" id="inputEmailKaryawan" name="email" placeholder="contoh: nama@tokabe.com" value="{{ old('email') }}" required autocomplete="off">
            @error('email')
              <span class="error-help-block">{{ $message }}</span>
            @enderror
          </div>

          <!-- Input Password & Ulangi Password -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-modern" for="password-input">
                Password <span class="required-star">*</span>
              </label>
              <div class="auth-pass-inputgroup position-relative">
                <input type="password" class="form-control form-control-modern password-input" id="password-input" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                <button class="password-addon" type="button" aria-label="Lihat Password">
                  <i class="las la-eye"></i>
                </button>
              </div>
              @error('password')
                <span class="error-help-block">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-6">
              <label class="form-label-modern" for="re-password-input">
                Ulangi Password <span class="required-star">*</span>
              </label>
              <div class="auth-pass-inputgroup position-relative">
                <input type="password" class="form-control form-control-modern password-input" id="re-password-input" name="re_password" placeholder="Ketik ulang password" required autocomplete="new-password">
                <button class="password-addon" type="button" aria-label="Lihat Password">
                  <i class="las la-eye"></i>
                </button>
              </div>
              @error('re_password')
                <span class="error-help-block">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Input Nomor Telepon & Role -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label for="phone-number" class="form-label-modern">
                Nomor Telepon
              </label>
              <input type="text" value="{{ old('no_telp') }}" name="no_telp" class="form-control form-control-modern" placeholder="Contoh: 0812 3456 7890" id="phone-number" autocomplete="off">
              @error('no_telp')
                <span class="error-help-block">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="role" class="form-label-modern">
                Role / Hak Akses <span class="required-star">*</span>
              </label>
              <select name="role" class="form-select form-select-modern" id="role" required>
                <option value="" selected disabled>Pilih Role</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Produksi" {{ old('role') == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                <option value="Stockist" {{ old('role') == 'Stockist' ? 'selected' : '' }}>Stockist</option>
                <option value="Magang" {{ old('role') == 'Magang' ? 'selected' : '' }}>Magang</option>
              </select>
              @error('role')
                <span class="error-help-block">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Tanda Tangan Digital (Khusus Admin / Karyawan) -->
          <div class="p-3 rounded-3 mb-2" style="background: rgba(15, 23, 42, 0.6); border: 1.5px dashed #334155;">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <label class="form-label-modern mb-0" for="input-tanda-tangan-modal">
                <i class="las la-signature text-primary me-1"></i>Tanda Tangan Digital (Khusus Admin)
              </label>
              <span class="badge" style="background: rgba(99, 102, 241, 0.15); color: #A5B4FC; font-size: 10.5px;">Otomatis pada Invoice Lunas</span>
            </div>
            <p class="text-muted fs-11 mb-2">Unggah file PNG transparan (maks. 2MB). Opsional, dapat diunggah nanti.</p>
            <div class="row align-items-center g-2">
              <div class="col-sm-4 text-center">
                <div class="p-2 rounded-2 d-inline-flex align-items-center justify-content-center" style="background: #0B1120; border: 1px solid #1E293B; width: 100%; min-height: 55px;">
                  <img src="" id="preview-ttd-modal" alt="Preview TTD" style="max-height: 45px; max-width: 120px; object-fit: contain; display: none;">
                  <span id="no-ttd-placeholder-modal" class="text-muted fs-11"><i class="las la-file-image"></i> Belum ada file</span>
                </div>
              </div>
              <div class="col-sm-8">
                <input type="file" class="form-control form-control-modern" name="tanda_tangan" id="input-tanda-tangan-modal" accept="image/png,image/jpeg,image/jpg,image/webp" onchange="previewTandaTanganModal(this)">
                @error('tanda_tangan')
                  <span class="error-help-block">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-tokabe-reset" data-bs-dismiss="modal">
            <i class="las la-times fs-16"></i>
            <span>Batal</span>
          </button>
          <button type="submit" id="simpan" class="btn-tokabe-primary">
            <i class="ri-save-3-line fs-16"></i>
            <span>Simpan Karyawan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/spb.js') }}"></script>
<script src="{{ asset('js/pages/password-addon.init.js') }}"></script>
<script>
  // Re-open modal if validation errors exist
  @if($errors->any())
    $(document).ready(function() {
      var addModal = new bootstrap.Modal(document.getElementById('modalTambahKaryawan'));
      addModal.show();
    });
  @endif

  // Client-side password confirmation check
  $(document).ready(function() {
    $('#formTambahKaryawan').on('submit', function(e) {
      var pass = $('#password-input').val();
      var rePass = $('#re-password-input').val();
      if (pass !== rePass) {
        e.preventDefault();
        alert('Password dan konfirmasi password tidak sama!');
        $('#re-password-input').focus();
        return false;
      }
    });
  });

  function previewTandaTanganModal(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview-ttd-modal').attr('src', e.target.result).show();
        $('#no-ttd-placeholder-modal').hide();
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection