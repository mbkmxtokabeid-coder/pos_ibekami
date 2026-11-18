# update_daftar_spj.py
import os

content = r'''@extends('layout.template')

@section('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ==========================================================================
       TOKABE DAFTAR SPJ — DUAL THEME WARM STONE SYSTEM
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
      --ibk-info: #0284C7;
      --ibk-info-soft: #F0F9FF;
      --ibk-info-border: #BAE6FD;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-popover-bg: #FFFFFF;
    }

    .num, .price, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    .spj-page-wrapper {
      position: relative;
      width: 100%;
      min-height: calc(100vh - 120px);
      padding-bottom: 85px !important;
      margin-bottom: 24px !important;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      color: var(--ibk-text);
    }

    /* Page Header */
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

    .btn-create-spj {
      display: inline-flex;
      align-items: center;
      gap: 8px;
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
    .btn-create-spj:hover {
      filter: brightness(1.08);
      transform: translateY(-1px);
      color: #FFFFFF;
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
    }

    /* KPI Summary Cards */
    .kpi-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }
    @media (max-width: 991px) {
      .kpi-row { grid-template-columns: 1fr; }
    }

    .kpi-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      padding: 18px 20px;
      transition: transform 0.15s ease, border-color 0.15s ease;
    }
    .kpi-card:hover {
      transform: translateY(-2px);
      border-color: var(--ibk-brand-border);
    }
    .kpi-label {
      font-size: 11.5px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--ibk-text-dim);
      margin-bottom: 6px;
    }
    .kpi-value {
      font-size: 22px;
      font-weight: 700;
      color: var(--ibk-text);
      margin-bottom: 4px;
      line-height: 1.2;
    }
    .kpi-subtext {
      font-size: 12px;
      color: var(--ibk-text-muted);
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .kpi-icon-pill {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }
    .kpi-icon-pill.emerald {
      background: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
    }
    .kpi-icon-pill.amber {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand);
      border: 1px solid var(--ibk-brand-border);
    }
    .kpi-icon-pill.info {
      background: var(--ibk-info-soft);
      color: var(--ibk-info);
      border: 1px solid var(--ibk-info-border);
    }

    /* Table Container Card */
    .ibk-table-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      overflow: hidden;
    }

    .ibk-table-header {
      padding: 16px 20px;
      border-bottom: 1px solid var(--ibk-border);
      background: var(--ibk-surface);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .ibk-table-title {
      font-size: 14.5px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .ibk-table-title i {
      color: var(--ibk-brand);
      font-size: 18px;
    }

    /* Table Styling */
    .tokabe-table {
      width: 100% !important;
      margin-bottom: 0 !important;
      border-collapse: collapse !important;
      color: var(--ibk-text) !important;
    }
    .tokabe-table thead th {
      background: var(--ibk-surface) !important;
      color: var(--ibk-text-dim) !important;
      font-size: 11.5px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 12px 14px !important;
      border-bottom: 1px solid var(--ibk-border) !important;
      border-top: none !important;
      white-space: nowrap !important;
    }
    .tokabe-table tbody td {
      background: transparent !important;
      color: var(--ibk-text) !important;
      font-size: 13.5px !important;
      padding: 12px 14px !important;
      border-bottom: 1px solid var(--ibk-border-subtle) !important;
      vertical-align: middle !important;
    }
    .tokabe-table tbody tr:hover td {
      background: var(--ibk-surface-hover) !important;
    }

    /* Badges */
    .badge-doc-no {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 9px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      color: var(--ibk-brand-text);
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
    }

    .badge-status-lunas {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
      background: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
    }

    .badge-status-belum {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
      background: var(--ibk-danger-soft);
      color: var(--ibk-danger);
      border: 1px solid var(--ibk-danger-border);
    }

    /* Action Buttons */
    .btn-action-ghost {
      width: 32px;
      height: 32px;
      border-radius: 6px;
      border: 1px solid var(--ibk-border);
      background: var(--ibk-surface);
      color: var(--ibk-text-muted);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.15s ease;
      padding: 0;
    }
    .btn-action-ghost:hover {
      background: var(--ibk-surface-hover);
      color: var(--ibk-text);
      border-color: var(--ibk-brand-border);
    }

    .dropdown-menu {
      background: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      border-radius: 8px !important;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4) !important;
      padding: 6px !important;
      min-width: 170px !important;
    }
    .dropdown-item {
      color: var(--ibk-text) !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      padding: 7px 10px !important;
      border-radius: 6px !important;
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
      transition: all 0.15s ease !important;
      background: transparent !important;
      border: none !important;
      width: 100% !important;
    }
    .dropdown-item:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-brand) !important;
    }
    .dropdown-item--danger {
      color: var(--ibk-danger) !important;
    }
    .dropdown-item--danger:hover {
      background: var(--ibk-danger-soft) !important;
      color: var(--ibk-danger) !important;
    }
    .dropdown-divider {
      border-color: var(--ibk-border) !important;
      margin: 4px 0 !important;
    }

    /* DataTables Custom Controls */
    .dataTables_wrapper {
      padding: 14px 16px;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      margin-bottom: 12px;
    }
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 6px !important;
      padding: 4px 8px !important;
      font-size: 13px !important;
      outline: none !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: var(--ibk-brand) !important;
    }
    .dataTables_wrapper .dataTables_info {
      font-size: 12.5px !important;
      color: var(--ibk-text-dim) !important;
      padding-top: 10px !important;
    }
    .dataTables_wrapper .dataTables_paginate {
      padding-top: 8px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 4px 10px !important;
      border-radius: 6px !important;
      font-size: 12.5px !important;
      color: var(--ibk-text-muted) !important;
      border: 1px solid transparent !important;
      background: transparent !important;
      cursor: pointer !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--ibk-surface-hover) !important;
      border-color: var(--ibk-border) !important;
      color: var(--ibk-text) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      border-color: var(--ibk-brand-btn-bg) !important;
      font-weight: 600 !important;
    }
  </style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="spj-page-wrapper">

      {{-- Page Header --}}
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-route-line"></i>
            SPJ (Surat Perintah Jalan)
          </h1>
          <p>Kelola surat tugas operasional, perjalanan kurir, dan monitoring biaya operasional transportasi.</p>
        </div>
        <div class="header-actions">
          <button type="button" class="ref-theme-toggle" id="themeToggleBtn" title="Ganti Mode Tampilan">
            <i class="ri-moon-line" id="themeIcon"></i>
            <span id="themeLabel">Mode Terang</span>
          </button>
          <a href="{{ url('/tambah-spj') }}" class="btn-create-spj">
            <i class="ri-add-line"></i>
            <span>Tambah SPJ Baru</span>
          </a>
        </div>
      </div>

      {{-- KPI Summary Cards --}}
      <div class="kpi-row">
        <!-- KPI 1: Terbayar Bulan Ini -->
        <div class="kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Biaya BBM Bulan Ini</div>
              <div class="kpi-value num">
                Rp <span style="color: var(--ibk-success);">{{ number_format($totalBulanIni, 0, ',', '.') }}</span>
              </div>
              <div class="kpi-subtext">
                <i class="ri-calendar-line"></i>
                <span>Total: <strong class="num" style="color: var(--ibk-text);">{{ $jumlahSpjBulanIni }}</strong> tugas SPJ</span>
              </div>
            </div>
            <div class="kpi-icon-pill emerald">
              <i class="ri-calendar-check-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 2: Terbayar Tahun Ini -->
        <div class="kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Biaya BBM Tahun {{ date('Y') }}</div>
              <div class="kpi-value num">
                Rp <span style="color: var(--ibk-brand-text);">{{ number_format($totalTahunIni, 0, ',', '.') }}</span>
              </div>
              <div class="kpi-subtext">
                <i class="ri-money-dollar-circle-line"></i>
                <span>Akumulasi: <strong class="num" style="color: var(--ibk-text);">{{ $jumlahSpjTahunIni }}</strong> tugas tahun ini</span>
              </div>
            </div>
            <div class="kpi-icon-pill amber">
              <i class="ri-gas-station-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 3: Total Berkas SPJ -->
        <div class="kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-label">Total Riwayat SPJ</div>
              <div class="kpi-value num">
                {{ count($spj) }} <span style="font-size: 14px; font-weight: 500; color: var(--ibk-text-muted);">Berkas</span>
              </div>
              <div class="kpi-subtext">
                <i class="ri-history-line"></i>
                <span>Seluruh arsip tugas perjalanan kurir</span>
              </div>
            </div>
            <div class="kpi-icon-pill info">
              <i class="ri-road-map-line"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Table Card --}}
      <div class="ibk-table-card">
        <div class="ibk-table-header">
          <h2 class="ibk-table-title">
            <i class="ri-truck-line"></i>
            Daftar Surat Perintah Jalan
          </h2>
          <div class="fs-13" style="color: var(--ibk-text-muted);">
            Total Data: <span class="fw-bold num" style="color: var(--ibk-text);">{{ count($spj) }}</span> berkas
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-middle mb-0 tokabe-table" id="scroll-horizontal">
              <thead>
                <tr>
                  <th scope="col" class="text-center" style="width: 50px;">No.</th>
                  <th scope="col" style="min-width: 140px;">No. SPJ</th>
                  <th scope="col" style="min-width: 160px;">Nama Kurir / Petugas</th>
                  <th scope="col" style="min-width: 120px;">Tanggal Tugas</th>
                  <th scope="col" style="min-width: 200px;">Tujuan</th>
                  <th scope="col" class="text-end" style="min-width: 130px;">Biaya BBM</th>
                  <th scope="col" class="text-center" style="width: 120px;">Status</th>
                  <th scope="col" class="text-center" style="width: 80px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($spj as $item)
                  <tr>
                    <td class="text-center num fw-medium" style="color: var(--ibk-text-dim);">
                      {{ $loop->iteration }}
                    </td>

                    <td class="text-nowrap">
                      <span class="badge-doc-no">
                        <i class="ri-file-list-line"></i>
                        {{ $item->nomor_spj }}
                      </span>
                    </td>

                    <td>
                      <span class="fw-semibold d-inline-flex align-items-center gap-1" style="color: var(--ibk-text);">
                        <i class="ri-user-follow-line fs-14" style="color: var(--ibk-brand);"></i>
                        {{ $item->nama_kurir }}
                      </span>
                    </td>

                    <td class="text-nowrap num fw-medium" style="color: var(--ibk-text-muted);">
                      <i class="ri-calendar-line me-1" style="color: var(--ibk-text-dim);"></i>
                      {{ \Carbon\Carbon::parse($item->tanggal_tugas)->format('d-m-Y') }}
                    </td>

                    <td>
                      <div class="fw-medium d-inline-flex align-items-center gap-1" style="color: var(--ibk-text);">
                        <i class="ri-map-pin-line fs-14" style="color: var(--ibk-danger);"></i>
                        <span>{{ $item->tujuan }}</span>
                      </div>
                    </td>

                    <td class="text-end num fw-bold" style="color: var(--ibk-text);">
                      Rp {{ number_format($item->biaya_bahan_bakar, 0, ',', '.') }}
                    </td>

                    <td class="text-center text-nowrap">
                      @if ($item->status == 'Terbayar')
                        <span class="badge-status-lunas">
                          <i class="ri-checkbox-circle-line"></i>
                          <span>Terbayar</span>
                        </span>
                      @else
                        <span class="badge-status-belum">
                          <i class="ri-time-line"></i>
                          <span>Belum Bayar</span>
                        </span>
                      @endif
                    </td>

                    <td class="text-center text-nowrap">
                      <div class="dropdown">
                        <button class="btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                          <i class="ri-more-2-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="{{ url('/lihat-spj/' . $item->id) }}">
                              <i class="ri-eye-line" style="color: var(--ibk-info);"></i>
                              <span>Lihat Detail SPJ</span>
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" target="_blank" href="{{ url('/cetak-spj/' . $item->id) }}">
                              <i class="ri-printer-line" style="color: var(--ibk-brand);"></i>
                              <span>Cetak SPJ</span>
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ url('/edit-spj/' . $item->id) }}">
                              <i class="ri-edit-line" style="color: var(--ibk-brand-deep);"></i>
                              <span>Edit SPJ</span>
                            </a>
                          </li>
                          <li class="dropdown-divider"></li>
                          <li>
                            <form action="{{ url('/delete-spj/' . $item->id) }}" method="POST" id="deletespj{{ $item->id }}">
                              @csrf
                              @method('DELETE')
                              <button class="dropdown-item dropdown-item--danger" type="button" onclick="showConfirmation('{{ $item->nomor_spj }}', '{{ $item->id }}')">
                                <i class="ri-delete-bin-line"></i>
                                <span>Hapus SPJ</span>
                              </button>
                            </form>
                          </li>
                        </ul>
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

{{-- SweetAlert Konfirmasi Hapus --}}
<script>
  function showConfirmation(nospj, id) {
    var isLight = document.body.classList.contains('theme-light');
    Swal.fire({
      title: 'Hapus Data SPJ?',
      text: 'Apakah Anda yakin ingin menghapus SPJ No. ' + nospj + '? Tindakan ini tidak dapat dibatalkan.',
      icon: 'warning',
      background: isLight ? '#FFFFFF' : '#14110F',
      color: isLight ? '#0F172A' : '#FAFAFA',
      showCancelButton: true,
      confirmButtonColor: '#EF4444',
      cancelButtonColor: isLight ? '#94A3B8' : '#27272A',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deletespj' + id).submit();
      }
    });
  }
</script>
@endsection

@section('plugins')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

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
'''

with open('resources/views/pages/SPJ/daftar-spj.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated resources/views/pages/SPJ/daftar-spj.blade.php")

