@section('head')
<style>
  /* ==========================================================================
     DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
     Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
     Contrast Ratio: Normal Text > 6:1, Large Text > 8:1
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

  /* Primary Action Button (§9.1) */
  .btn-add-pembelian {
    background-color: #4F46E5 !important;
    border: 1.5px solid #6366F1 !important;
    color: #FFFFFF !important;
    font-weight: 600;
    font-size: 13.5px;
    padding: 9px 20px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s ease;
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.35);
    text-decoration: none;
  }
  .btn-add-pembelian:hover {
    background-color: #4338CA !important;
    border-color: #818CF8 !important;
    color: #FFFFFF !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.45);
  }
  .btn-add-pembelian:focus-visible {
    outline: 2px solid #A5B4FC !important;
    outline-offset: 2px;
  }
  .btn-add-pembelian:active {
    transform: scale(0.98);
  }

  /* KPI Summary Cards (§12.4) - High Contrast & Clear Depth */
  .tokabe-kpi-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important;
    padding: 18px 20px;
    transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
    height: 100%;
  }
  .tokabe-kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.45) !important;
    border-color: #3B4B66 !important;
  }
  .kpi-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #CBD5E1 !important;
    margin-bottom: 6px;
  }
  .kpi-amount {
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.01em;
    line-height: 1.25;
    margin-bottom: 0;
  }
  .kpi-icon-box {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }
  .icon-box-sky {
    background-color: rgba(56, 189, 248, 0.16);
    color: #38BDF8;
    border: 1.5px solid rgba(56, 189, 248, 0.4);
  }
  .icon-box-emerald {
    background-color: rgba(16, 185, 129, 0.16);
    color: #34D399;
    border: 1.5px solid rgba(16, 185, 129, 0.4);
  }
  .icon-box-rose {
    background-color: rgba(244, 63, 94, 0.16);
    color: #FB7185;
    border: 1.5px solid rgba(244, 63, 94, 0.4);
  }

  /* Section Card Container (§12.1) */
  .tokabe-section-card {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25) !important;
    margin-bottom: 24px;
    overflow: hidden;
  }
  .tokabe-card-header {
    background: #1A2436 !important;
    border-bottom: 1.5px solid #28354A !important;
    padding: 16px 20px !important;
    display: flex;
    align-items: center;
    justify-content: space-between;
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

  /* High-Visibility Table Styles (§13) */
  .tokabe-table {
    background-color: #151D2A !important;
    color: #E2E8F0 !important;
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
  }
  .tokabe-table thead th {
    background-color: #101726 !important;
    color: #CBD5E1 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-top: none !important;
    border-bottom: 2px solid #28354A !important;
    padding: 13px 16px !important;
    vertical-align: middle;
    white-space: nowrap;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid #222D3F !important;
    padding: 14px 16px !important;
    font-size: 13.5px !important;
    vertical-align: middle;
    background-color: transparent !important;
    color: #E2E8F0 !important;
  }
  .tokabe-table tbody tr:hover td {
    background-color: #1E293B !important;
  }
  .tokabe-table tbody tr:last-child td {
    border-bottom: none !important;
  }

  /* High-Visibility Badges (§14.1) */
  .badge-status-lunas {
    background: rgba(16, 185, 129, 0.2);
    color: #6EE7B7 !important;
    border: 1.5px solid rgba(52, 211, 153, 0.45);
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-status-pending {
    background: rgba(245, 158, 11, 0.2);
    color: #FDE047 !important;
    border: 1.5px solid rgba(251, 191, 36, 0.45);
    font-weight: 700;
    padding: 4px 11px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-access-locked {
    background-color: rgba(239, 68, 68, 0.15);
    color: #FCA5A5 !important;
    border: 1.5px solid rgba(239, 68, 68, 0.4);
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-access-unlocked {
    background-color: rgba(16, 185, 129, 0.15);
    color: #6EE7B7 !important;
    border: 1.5px solid rgba(16, 185, 129, 0.4);
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-invoice-no {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 12.5px;
    font-weight: 700;
    color: #38BDF8 !important;
    background: rgba(56, 189, 248, 0.12);
    border: 1.5px solid rgba(56, 189, 248, 0.35);
    padding: 4px 9px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Accessible Action Button & Menu */
  .btn-action-ghost {
    background: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    width: 38px !important;
    height: 38px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    transition: all 0.15s ease;
  }
  .btn-action-ghost:hover {
    background: #334155 !important;
    color: #FFFFFF !important;
    border-color: #6366F1 !important;
  }
  .btn-action-ghost:focus-visible {
    outline: 2px solid #818CF8 !important;
    outline-offset: 2px;
  }
  .dropdown-menu {
    background: #1A2436 !important;
    border: 1.5px solid #2D3B4F !important;
    border-radius: 10px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6) !important;
    padding: 6px !important;
    z-index: 1050 !important;
  }
  .dropdown-item {
    color: #F1F5F9 !important;
    border-radius: 6px !important;
    padding: 8px 12px !important;
    font-size: 13.5px !important;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.15s ease;
    background: transparent;
    border: none;
    width: 100%;
    text-align: left;
  }
  .dropdown-item:hover, .dropdown-item:focus {
    background: #28354A !important;
    color: #FFFFFF !important;
  }
  .dropdown-item--danger {
    color: #F87171 !important;
  }
  .dropdown-item--danger:hover, .dropdown-item--danger:focus {
    background: rgba(239, 68, 68, 0.2) !important;
    color: #FCA5A5 !important;
  }
  .dropdown-divider {
    border-color: #28354A !important;
    margin: 6px 0 !important;
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
            <h4 class="mb-sm-0 text-white fw-bold">Daftar Pembelian &mdash; {{ $vendor->nama_vendor }}</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="{{ route('vendor.list') }}">Vendor</a></li>
              <li class="breadcrumb-item active">{{ $vendor->nama_vendor }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" role="alert" style="background: rgba(16, 185, 129, 0.2); border: 1.5px solid rgba(16, 185, 129, 0.45); color: #6EE7B7; border-radius: 8px;">
        <i class="ri-checkbox-circle-fill fs-20 me-2 text-success"></i>
        <div class="flex-grow-1 fw-medium">{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45); color: #FCA5A5; border-radius: 8px;">
        <i class="ri-error-warning-fill fs-20 me-2 text-danger"></i>
        <div class="flex-grow-1 fw-medium">{{ session('error') }}</div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    @endif

    <!-- Top Action Row (§9.1) -->
    <div class="row mb-4">
      <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <a href="{{ route('pembelian.add', ['uid' => $vendor->id]) }}" class="btn-add-pembelian" aria-label="Tambah Pembelian Baru">
            <i class="las la-plus fs-18"></i>
            <span>Tambah Pembelian</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Summary KPI Cards (§12.4) -->
    <div class="row g-3 mb-4">
      <!-- KPI 1: Total Pembelian -->
      <div class="col-xl-3 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TOTAL PEMBELIAN</div>
              <h4 class="kpi-amount text-white num" aria-label="Total Pembelian: Rp {{ number_format($totalTagihan, 0, ',', '.') }}">
                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-sky" aria-hidden="true">
              <i class="ri-file-list-3-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 2: Total Terbayar -->
      <div class="col-xl-3 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TOTAL TERBAYAR</div>
              <h4 class="kpi-amount num" style="color: #34D399;" aria-label="Total Terbayar: Rp {{ number_format($totalTerbayar, 0, ',', '.') }}">
                Rp {{ number_format($totalTerbayar, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="ri-checkbox-circle-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 3: Sisa Belum Dibayar -->
      <div class="col-xl-3 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">SISA BELUM DIBAYAR</div>
              <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? '#FB7185' : '#CBD5E1' }};" aria-label="Sisa Belum Dibayar: Rp {{ number_format($totalSisa, 0, ',', '.') }}">
                Rp {{ number_format($totalSisa, 0, ',', '.') }}
              </h4>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="ri-error-warning-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 4: Sisa Duit Kas -->
      <div class="col-xl-3 col-md-6">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="d-flex align-items-center gap-2 mb-1">
                <div class="kpi-title mb-0">SISA DUIT KAS</div>
                @if(($sisaKas ?? 0) < 0)
                  <span class="badge py-0.5 px-2 fs-11 fw-bold" style="background: #EF4444; color: #FFFFFF;">Minus</span>
                @else
                  <span class="badge py-0.5 px-2 fs-11 fw-bold" style="background: rgba(56, 189, 248, 0.2); color: #38BDF8; border: 1px solid rgba(56, 189, 248, 0.4);">Tersedia</span>
                @endif
              </div>
              <h4 class="kpi-amount num" style="color: {{ ($sisaKas ?? 0) >= 0 ? '#38BDF8' : '#FB7185' }};">
                @if(($sisaKas ?? 0) < 0)
                  -Rp {{ number_format(abs($sisaKas ?? 0), 0, ',', '.') }}
                @else
                  Rp {{ number_format($sisaKas ?? 0, 0, ',', '.') }}
                @endif
              </h4>
            </div>
            <div class="kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-sky' : 'icon-box-rose' }}" aria-hidden="true">
              <i class="ri-wallet-3-line"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section: Riwayat Pembelian (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="ri-history-line fs-20" style="color: #F59E0B;" aria-hidden="true"></i>
              <span>Riwayat Pembelian &mdash; {{ $vendor->nama_vendor }}</span>
            </div>
            <div class="fs-13" style="color: #CBD5E1;">
              Total: <span class="fw-bold text-white num">{{ count($pembelian) }}</span> nota transaksi
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0 tokabe-table" aria-label="Tabel Riwayat Pembelian">
                <thead>
                  <tr>
                    <th scope="col" class="text-center" style="width: 55px;">NO.</th>
                    <th scope="col">NO. INVOICE</th>
                    <th scope="col" class="text-center">TANGGAL PEMBELIAN</th>
                    <th scope="col" class="text-center">TANGGAL JTO</th>
                    <th scope="col" class="text-center">STATUS BAYAR</th>
                    <th scope="col" class="text-center" style="width: 130px;">AKSES EDIT</th>
                    <th scope="col" class="text-end">TOTAL (RP)</th>
                    <th scope="col" class="text-end">TERBAYAR (RP)</th>
                    <th scope="col" class="text-end">SISA (RP)</th>
                    <th scope="col" class="text-center" style="width: 80px;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($pembelian as $item)
                    @php
                      $roleUser   = Auth::user()->role ?? '';
                      $isOwner    = $roleUser === 'Pemilik';
                      $isAdmin    = $roleUser === 'Admin';
                      $isUnlocked = $item->approval === 'Unlock';
                      $canManage  = !$isAdmin || $isUnlocked;

                      // Kontak Owner
                      $waOwner1 = '628116029999';
                      $waOwner2 = '628116179999';

                      // Pesan Request Unlock ke Owner via WhatsApp
                      $pesanUnlock = urlencode("Halo, saya ingin meminta approval untuk membuka akses riwayat pembelian *#{$item->nomor_inv}* dari vendor *{$vendor->nama_vendor}*. Mohon untuk segera ditinjau.\n\nKlik tautan berikut untuk membuka halaman persetujuan:\n" . url("/pembelian-approval/{$item->id}"));
                    @endphp
                    <tr>
                      <td class="text-center num fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>
                      <td>
                        <span class="badge-invoice-no">{{ $item->nomor_inv }}</span>
                      </td>
                      <td class="text-center fw-medium" style="color: #CBD5E1;">
                        {{ optional($item->tanggal)->translatedFormat('d M Y') }}
                      </td>
                      <td class="text-center fw-medium" style="color: #CBD5E1;">
                        {{ optional($item->effective_tanggal_jto)->translatedFormat('d M Y') ?: '-' }}
                      </td>
                      <td class="text-center">
                        @if($item->status === 'Lunas')
                          <span class="badge-status-lunas">
                            <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                            <span>Lunas</span>
                          </span>
                        @else
                          <span class="badge-status-pending">
                            <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                            <span>Belum Lunas</span>
                          </span>
                        @endif
                      </td>
                      <td class="text-center">
                        @if($isUnlocked)
                          <span class="badge-access-unlocked" title="Akses edit terbuka">
                            <i class="ri-lock-unlock-fill fs-13" aria-hidden="true"></i>
                            <span>Terbuka</span>
                          </span>
                        @else
                          <span class="badge-access-locked" title="Akses edit terkunci">
                            <i class="ri-lock-2-fill fs-13 text-danger" aria-hidden="true"></i>
                            <span>Terkunci</span>
                          </span>
                        @endif
                      </td>
                      <td class="text-end fw-bold text-white num">
                        {{ number_format($item->jumlah_harga, 0, ',', '.') }}
                      </td>
                      <td class="text-end fw-bold num" style="color: {{ $item->terbayar > 0 ? '#34D399' : '#94A3B8' }};">
                        {{ number_format($item->terbayar, 0, ',', '.') }}
                      </td>
                      <td class="text-end fw-bold num" style="color: {{ $item->sisa > 0 ? '#FB7185' : '#64748B' }};">
                        {{ number_format($item->sisa, 0, ',', '.') }}
                      </td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi Invoice {{ $item->nomor_inv }}">
                            <i class="ri-more-fill fs-18" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            {{-- Menu Edit --}}
                            @if($canManage)
                              <li>
                                <a class="dropdown-item" href="{{ route('pembelian.edit', ['uid' => $item->id]) }}">
                                  <i class="ri-edit-line fs-16 text-primary" aria-hidden="true"></i>
                                  <span>Edit Pembelian</span>
                                </a>
                              </li>
                            @else
                              <li>
                                <span class="dropdown-item text-muted" style="cursor: not-allowed; opacity: 0.6;">
                                  <i class="ri-lock-line fs-16 text-warning" aria-hidden="true"></i>
                                  <span>Edit Terkunci</span>
                                </span>
                              </li>
                            @endif

                            {{-- ADMIN: Request Unlock via WA jika status masih Terkunci --}}
                            @if($isAdmin && !$isUnlocked)
                              <li>
                                <a class="dropdown-item" href="https://wa.me/{{ $waOwner1 }}?text={{ $pesanUnlock }}" target="_blank" rel="noopener">
                                  <i class="ri-whatsapp-line fs-16 text-success" aria-hidden="true"></i>
                                  <span>Request Unlock (Owner 1)</span>
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="https://wa.me/{{ $waOwner2 }}?text={{ $pesanUnlock }}" target="_blank" rel="noopener">
                                  <i class="ri-whatsapp-line fs-16 text-success" aria-hidden="true"></i>
                                  <span>Request Unlock (Owner 2)</span>
                                </a>
                              </li>
                            @endif

                            {{-- OWNER: Lock & Unlock langsung --}}
                            @if($isOwner)
                              @if($isUnlocked)
                                <li>
                                  <a class="dropdown-item" href="{{ route('pembelian.lock', $item->id) }}">
                                    <i class="ri-lock-line fs-16 text-warning" aria-hidden="true"></i>
                                    <span>Kunci Kembali (Lock)</span>
                                  </a>
                                </li>
                              @else
                                <li>
                                  <form action="{{ route('pembelian.unlock', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-success">
                                      <i class="ri-lock-unlock-line fs-16 text-success" aria-hidden="true"></i>
                                      <span>Buka Kunci (Unlock)</span>
                                    </button>
                                  </form>
                                </li>
                                <li>
                                  <a class="dropdown-item" href="{{ route('pembelian.approval.page', $item->id) }}">
                                    <i class="ri-shield-check-line fs-16 text-info" aria-hidden="true"></i>
                                    <span>Halaman Approval</span>
                                  </a>
                                </li>
                              @endif
                            @endif

                            {{-- Lunasi (jika belum lunas) --}}
                            @if($item->status !== 'Lunas')
                              <li>
                                <a class="dropdown-item" href="{{ route('pembelian.lunas', ['uid' => $item->id]) }}" onclick="return confirm('Apakah Anda yakin ingin melunasi pembelian ini?')">
                                  <i class="ri-check-line fs-16 text-success" aria-hidden="true"></i>
                                  <span>Lunasi Nota</span>
                                </a>
                              </li>
                            @endif

                            {{-- Hapus (hanya jika memiliki hak kelola) --}}
                            @if($canManage)
                              <li class="dropdown-divider"></li>
                              <li>
                                <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembelian ini?')">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="dropdown-item dropdown-item--danger">
                                    <i class="ri-delete-bin-line fs-16 text-danger" aria-hidden="true"></i>
                                    <span>Hapus Nota</span>
                                  </button>
                                </form>
                              </li>
                            @endif
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="10" class="text-center py-5" style="color: #94A3B8;">
                        <i class="ri-inbox-line fs-32 d-block mb-2" style="color: #64748B;" aria-hidden="true"></i>
                        <span class="fs-14">Belum ada transaksi pembelian untuk vendor ini.</span>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection