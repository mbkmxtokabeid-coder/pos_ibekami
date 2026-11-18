# Script to update daftar-spk.blade.php to Tokabe Warm Stone Design System

content = '''@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.js" integrity="sha512-vv0F8Er+ByFK3l86WDjP5Zc0h8uxNWPzF+l4wGK0/BlHWxDiFHbYr/91dn8G0OO8tTnN40L4s2Whom+X2NxPog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.css" integrity="sha512-nnNXPeQKvNOEUd+TrFbofWwHT0ezcZiFU5E/Lv2+JlZCQwQ/ACM33FxPoQ6ZEFNnERrTho8lF0MCEH9DBZ/wWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<script>
  setTimeout(function () {
    location.reload();
  }, 600000);

  Pusher.logToConsole = false;
  var pusher = new Pusher('55bca2ab4a2ee71bf08f', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('spk-channel');
  channel.bind('spk-created', function(data) {
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "6000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
    toastr.info('SPK baru telah dibuat', {
      onclick: function() {
        var spkId = data.spk.id;
        redirectToSPK(spkId);
      }
    });
  });

  function redirectToSPK(id) {
    var url = '/invoice/lihat-spk/' + id;
    window.location.href = url;
  }
</script>

@if(session('reload'))
  <script>
    setTimeout(function () {
      location.reload();
    }, 1000);
  </script>
@endif

<style>
  /* ==========================================================================
     TOKABE SPK (SURAT PERINTAH KERJA) — DUAL THEME WARM STONE SYSTEM
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

    --ibk-th-bg: #14110F;
    --ibk-th-text: #A1A1AA;
    --ibk-td-border: rgba(255, 255, 255, 0.06);

    --ibk-modal-bg: #181412;
    --ibk-modal-border: rgba(255, 255, 255, 0.08);
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

    --ibk-th-bg: #F8FAFC;
    --ibk-th-text: #64748B;
    --ibk-td-border: #E2E8F0;

    --ibk-modal-bg: #FFFFFF;
    --ibk-modal-border: #E2E8F0;
  }

  .num, .price, .numeric, input.numeric {
    font-variant-numeric: tabular-nums !important;
    font-feature-settings: "tnum" 1, "cv11" 1 !important;
  }

  .surat-page-wrapper {
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

  /* Action Buttons */
  .ibk-btn-primary {
    background: #EA580C !important;
    border: 1px solid #EA580C !important;
    color: #FFFFFF !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 0 16px !important;
    height: 38px !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
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
    box-shadow: 0 2px 6px rgba(234, 88, 12, 0.35) !important;
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

  /* KPI Summary Cards */
  .ibk-kpi-card {
    background: var(--ibk-card-bg);
    border: 1px solid var(--ibk-border);
    border-radius: 12px;
    padding: 16px 20px;
    box-shadow: var(--ibk-card-shadow);
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 150ms ease, border-color 150ms ease;
    height: 100%;
  }
  .ibk-kpi-card:hover {
    transform: translateY(-1px);
    border-color: var(--ibk-brand-border);
  }
  .kpi-title {
    font-size: 12px;
    font-weight: 500;
    color: var(--ibk-text-muted);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .kpi-amount {
    font-size: 24px;
    font-weight: 700;
    letter-spacing: -0.015em;
    line-height: 1.2;
    margin-bottom: 0;
    color: var(--ibk-text);
  }
  .kpi-icon-box {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .icon-box-amber {
    background-color: var(--ibk-brand-soft);
    color: var(--ibk-brand);
    border: 1px solid var(--ibk-brand-border);
  }
  .icon-box-rose {
    background-color: var(--ibk-danger-soft);
    color: var(--ibk-danger);
    border: 1px solid var(--ibk-danger-border);
  }
  .icon-box-emerald {
    background-color: var(--ibk-success-soft);
    color: var(--ibk-success);
    border: 1px solid var(--ibk-success-border);
  }

  /* Section Card & Header */
  .ibk-card {
    background: var(--ibk-card-bg);
    border: 1px solid var(--ibk-border);
    border-radius: 12px;
    box-shadow: var(--ibk-card-shadow);
    margin-bottom: 24px;
    overflow: hidden;
  }
  .ibk-card-header {
    background: transparent;
    border-bottom: 1px solid var(--ibk-border);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
  }
  .ibk-card-title {
    font-size: 14.5px;
    font-weight: 600;
    color: var(--ibk-text);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .ibk-card-title i {
    font-size: 18px;
    color: var(--ibk-brand);
  }
  .badge-count-pill {
    background: var(--ibk-brand-soft);
    color: var(--ibk-brand-text);
    border: 1px solid var(--ibk-brand-border);
    padding: 2px 8px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 600;
  }

  /* Timeframe Filter Buttons */
  .btn-time-filter {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    font-weight: 600;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 6px;
    transition: all 150ms ease;
  }
  .btn-time-filter:hover {
    background-color: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
  }
  .btn-time-filter.active {
    background-color: #EA580C !important;
    border-color: #EA580C !important;
    color: #FFFFFF !important;
  }

  /* Table Styles */
  .tokabe-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
    background: transparent !important;
  }
  .tokabe-table thead th {
    background: var(--ibk-th-bg) !important;
    color: var(--ibk-th-text) !important;
    font-size: 11.5px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
    border-top: none !important;
    border-bottom: 1px solid var(--ibk-td-border) !important;
    padding: 12px 16px !important;
    vertical-align: middle;
    white-space: nowrap;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid var(--ibk-td-border) !important;
    padding: 12px 16px !important;
    font-size: 13px !important;
    vertical-align: middle;
    color: var(--ibk-text) !important;
    background-color: transparent !important;
  }
  .tokabe-table tbody tr {
    transition: background-color 150ms ease;
  }
  .tokabe-table tbody tr:hover td {
    background-color: var(--ibk-surface-hover) !important;
  }

  /* Row Highlights */
  .row-accent-danger td {
    background-color: rgba(239, 68, 68, 0.04) !important;
  }
  .row-accent-warning td {
    background-color: rgba(245, 158, 11, 0.04) !important;
  }

  /* Status Badges */
  .badge-status-selesai {
    background: var(--ibk-success-soft) !important;
    border: 1px solid var(--ibk-success-border) !important;
    color: var(--ibk-success) !important;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-status-belum {
    background: var(--ibk-danger-soft) !important;
    border: 1px solid var(--ibk-danger-border) !important;
    color: var(--ibk-danger) !important;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .btn-badge-action {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
    box-shadow: none !important;
  }
  .badge-invoice-no {
    color: var(--ibk-text) !important;
    font-weight: 700;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-timeline-overdue {
    background: var(--ibk-danger-soft);
    border: 1px solid var(--ibk-danger-border);
    color: var(--ibk-danger);
    font-weight: 600;
    font-size: 11.5px;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-timeline-ontime {
    background: var(--ibk-success-soft);
    border: 1px solid var(--ibk-success-border);
    color: var(--ibk-success);
    font-weight: 600;
    font-size: 11.5px;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-stage-design {
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid rgba(245, 158, 11, 0.24);
    color: #FBBF24;
    font-weight: 600;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-stage-production {
    background: rgba(234, 88, 12, 0.14);
    border: 1px solid rgba(234, 88, 12, 0.28);
    color: #FB923C;
    font-weight: 600;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-stage-pending {
    background: var(--ibk-input-bg);
    border: 1px solid var(--ibk-border);
    color: var(--ibk-text-muted);
    font-weight: 600;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  /* Action Ghost & Dropdown */
  .btn-action-ghost {
    background: transparent !important;
    border: 1px solid var(--ibk-border) !important;
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    width: 32px !important;
    height: 32px !important;
    padding: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 150ms ease;
    cursor: pointer;
  }
  .btn-action-ghost:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
    border-color: var(--ibk-brand-border) !important;
  }
  .dropdown-menu {
    background: var(--ibk-popover-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    border-radius: 8px !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25) !important;
    padding: 6px !important;
    z-index: 1050 !important;
  }
  .dropdown-item {
    color: var(--ibk-text) !important;
    border-radius: 6px !important;
    padding: 8px 12px !important;
    font-size: 13px !important;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 150ms ease;
    background: transparent;
    border: none;
    width: 100%;
    text-align: left;
  }
  .dropdown-item:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
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

  /* DataTables Styling */
  .dataTables_wrapper {
    color: var(--ibk-text-muted) !important;
    padding: 16px 20px;
  }
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter,
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_paginate {
    color: var(--ibk-text-muted) !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper .dataTables_length select {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    color: var(--ibk-input-text) !important;
    border-radius: 6px !important;
    height: 34px !important;
    padding: 3px 24px 3px 10px !important;
    outline: none !important;
  }
  .dataTables_wrapper .dataTables_filter input {
    background-color: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-input-border) !important;
    color: var(--ibk-input-text) !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    margin-left: 8px !important;
    outline: none !important;
    height: 36px !important;
  }
  .dataTables_wrapper .dataTables_filter input:focus,
  .dataTables_wrapper .dataTables_length select:focus {
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    border: 1px solid transparent !important;
    padding: 4px 10px !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #EA580C !important;
    border-color: #EA580C !important;
    color: #FFFFFF !important;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
    border-color: var(--ibk-border) !important;
  }

  /* Modal */
  .modal-content {
    background-color: var(--ibk-modal-bg) !important;
    border: 1px solid var(--ibk-modal-border) !important;
    color: var(--ibk-text) !important;
    border-radius: 12px !important;
  }
  .btn-form-cancel {
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
    transition: all 150ms ease;
  }
  .btn-form-cancel:hover {
    background: var(--ibk-surface-hover) !important;
    color: var(--ibk-text) !important;
  }
</style>
@endsection

@extends('layout.template')

@section('content')
<!-- Delete Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="spk_delete_id" id="spk_id">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; border-radius: 50%; background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border);">
          <i class="ri-delete-bin-line fs-24 text-danger"></i>
        </div>
        <h5 class="fw-bold mb-2" style="color: var(--ibk-text);">Hapus Data SPK?</h5>
        <p class="fs-13 mb-4" style="color: var(--ibk-text-muted);">
          Apakah Anda yakin ingin menghapus data Surat Perintah Kerja ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn-form-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16"></i>
            <span>Batal</span>
          </button>
          <form id="deleteForm" action="{{ url('/delete-spk') }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="border-radius: 8px;">
              <i class="ri-delete-bin-line fs-16"></i>
              <span>Ya, Hapus</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-content">
  <div class="container-fluid">
    <div class="surat-page-wrapper">

      <!-- 1. Header & Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-mail-settings-line"></i>
            <span>Daftar SPK (Surat Perintah Kerja)</span>
          </h1>
          <div class="ibk-page-subtitle">Monitoring tahapan pengerjaan, respon desain & produksi, serta timeline target penyelesaian</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
            <a href="{{ url('/tambah-spk') }}" class="ibk-btn-primary" aria-label="Tambah SPK Baru">
              <i class="ri-add-line fs-16" aria-hidden="true"></i>
              <span>Buat SPK Baru</span>
            </a>
          @endif
        </div>
      </div>

      <!-- 2. Summary KPI Cards -->
      <div class="row g-3 mb-4">
        <!-- KPI 1: SPK Belum Selesai -->
        <div class="col-md-4">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">SPK Belum Selesai</div>
              <h4 class="kpi-amount num" style="color: var(--ibk-brand-text);" aria-label="SPK Belum Selesai: {{ $belum_selesai }}">
                {{ $belum_selesai }}
              </h4>
              <span class="fs-12 mt-1 d-block text-muted">Pesanan dalam tahapan pengerjaan</span>
            </div>
            <div class="kpi-icon-box icon-box-amber" aria-hidden="true">
              <i class="ri-tools-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 2: SPK Belum Diproses -->
        <div class="col-md-4">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">SPK Belum Diproses</div>
              <h4 class="kpi-amount num" style="color: var(--ibk-danger);" aria-label="SPK Belum Diproses: {{ $belum_proses }}">
                {{ $belum_proses }}
              </h4>
              <span class="fs-12 mt-1 d-block text-muted">Menunggu respon tim kerja</span>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="ri-hourglass-line"></i>
            </div>
          </div>
        </div>

        <!-- KPI 3: Total Berkas SPK -->
        <div class="col-md-4">
          <div class="ibk-kpi-card">
            <div>
              <div class="kpi-title">Total Berkas SPK</div>
              <h4 class="kpi-amount num" aria-label="Total Berkas SPK: {{ count($spk) }}">
                {{ count($spk) }}
              </h4>
              <span class="fs-12 mt-1 d-block text-muted">Seluruh data riwayat berkas SPK</span>
            </div>
            <div class="kpi-icon-box icon-box-emerald" aria-hidden="true">
              <i class="ri-file-list-3-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Timeline Chart Card -->
      <div class="ibk-card mb-4">
        <div class="ibk-card-header">
          <div>
            <div class="ibk-card-title">
              <i class="ri-bar-chart-grouped-line"></i>
              <span>Analisis Timeline Pengerjaan SPK</span>
            </div>
            <div class="fs-12 text-muted mt-1">Durasi pengerjaan per invoice (Waktu Desain, Waktu Produksi, dan Total)</div>
          </div>
          <div class="d-flex gap-2">
            <button type="button" class="btn btn-time-filter tombol active" onclick="timeFrame('week')" id="btn-week" aria-label="Tampilkan timeframe 1 minggu">
              1W
            </button>
            <button type="button" class="btn btn-time-filter tombol" onclick="timeFrame('month')" id="btn-month" aria-label="Tampilkan timeframe 1 bulan">
              1M
            </button>
          </div>
        </div>
        <div class="p-3">
          <div id="column_chart" class="apex-charts" dir="ltr"></div>
        </div>
      </div>

      <!-- 4. Table Section -->
      <div class="ibk-card">
        <div class="ibk-card-header">
          <div class="ibk-card-title">
            <i class="ri-history-line"></i>
            <span>Daftar Riwayat SPK</span>
          </div>
          <span class="badge-count-pill">{{ count($spk) }} Berkas</span>
        </div>

        <div class="table-responsive">
          <table class="table align-middle mb-0 tokabe-table" id="scroll-horizontal" aria-label="Tabel Riwayat SPK">
            <thead>
              <tr>
                <th scope="col" class="text-center text-nowrap" style="width: 50px;">NO.</th>
                <th scope="col" class="text-center text-nowrap" style="width: 130px;">STATUS</th>
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik')
                  <th scope="col" class="text-nowrap" style="min-width: 140px;">NOMOR INVOICE</th>
                  <th scope="col" class="text-nowrap" style="min-width: 140px;">TANGGAL SPK</th>
                @endif
                <th scope="col" style="min-width: 250px;">PEKERJAAN</th>
                <th scope="col" class="text-center" style="min-width: 130px;">PELANGGAN</th>
                <th scope="col" style="min-width: 130px;">JENIS</th>
                <th scope="col" class="text-center text-nowrap">TARGET SELESAI</th>
                <th scope="col" class="text-center" style="min-width: 160px;">TIMELINE</th>
                <th scope="col" class="text-center text-nowrap" style="width: 130px;">RESPON</th>
                <th scope="col" class="text-center text-nowrap" style="width: 70px;">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($spk as $surat)
                @php
                  $isLate = ($surat->color == 'red');
                  $isExpress = ($surat->express == 'Y' && $surat->status_kerja != 'Selesai');
                @endphp
                <tr class="{{ $isLate ? 'row-accent-danger' : ($isExpress ? 'row-accent-warning' : '') }}">
                  <td class="text-center num text-muted" style="font-size: 13px;">{{ $loop->iteration }}</td>

                  {{-- Status SPK --}}
                  <td class="text-center text-nowrap">
                    @if (Auth::check())
                      @if (Auth::user()->role === 'Admin' && $surat->timeline_produksi)
                        @if ($surat->status_spk === 'Selesai')
                          <span class="badge-status-selesai">
                            <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                            <span>Selesai</span>
                          </span>
                        @else
                          <div class="dropdown d-inline-block">
                            <button class="btn btn-badge-action dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ubah Status SPK {{ $surat->nomor_invoice }}">
                              <span class="badge-status-belum">
                                <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                                <span>{{ $surat->status_spk }}</span>
                                <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                              </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                <a class="dropdown-item text-success" href="{{ url('/ubah-status-spk/' . $surat->id) }}">
                                  <i class="ri-checkbox-circle-line fs-15 text-success" aria-hidden="true"></i>
                                  <span>Tandai Selesai</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        @endif
                      @elseif (Auth::user()->role === 'Produksi' && $surat->status_spk === 'Belum Selesai' && $surat->status_kerja === 'Selesai')
                        @php
                          $adminWa = '628115239999';
                          $linkApprove = url('/ubah-status-spk/' . $surat->id);
                          $pesan = urlencode("Halo Admin, mohon approve status SPK untuk surat Nomor Invoice: {$surat->nomor_invoice}. Link approve: {$linkApprove}");
                          $waUrl = "https://wa.me/{$adminWa}?text={$pesan}";
                        @endphp
                        <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm text-white fw-semibold px-2 py-1" style="background: #059669; border-radius: 6px;" aria-label="Kirim Permohonan Approve via WhatsApp">
                          <i class="ri-whatsapp-line fs-15 align-middle me-1"></i> Approve
                        </a>
                      @else
                        @if ($surat->status_spk === 'Selesai')
                          <span class="badge-status-selesai">
                            <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                            <span>Selesai</span>
                          </span>
                        @else
                          <span class="badge-status-belum">
                            <i class="ri-time-fill fs-13" aria-hidden="true"></i>
                            <span>{{ $surat->status_spk }}</span>
                          </span>
                        @endif
                      @endif
                    @endif
                  </td>

                  @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik')
                    <td class="text-nowrap">
                      <span class="badge-invoice-no">
                        <i class="ri-file-text-line text-muted" aria-hidden="true"></i>
                        <span>{{ $surat->nomor_invoice }}</span>
                      </span>
                      @if($surat->express == 'Y')
                        <span class="badge py-0.5 px-1.5 fs-10 fw-bold ms-1" style="background: rgba(234, 88, 12, 0.16); color: #EA580C; border: 1px solid rgba(234, 88, 12, 0.3);">KILAT</span>
                      @endif
                    </td>
                    <td class="text-nowrap num text-muted" style="font-size: 12.5px;">
                      {{ $surat->tgl_mulai }}
                    </td>
                  @endif

                  {{-- Pekerjaan --}}
                  <td>
                    <div class="fw-semibold mb-0" style="line-height: 1.45; color: var(--ibk-text);">
                      @if(strpos($surat->pekerjaan, '), ') !== false)
                        @php
                          $items = explode('), ', $surat->pekerjaan);
                        @endphp
                        @foreach($items as $itemText)
                          <div class="py-0.5" style="{{ !$loop->last ? 'border-bottom: 1px dashed var(--ibk-border);' : '' }}">
                            <i class="ri-checkbox-blank-circle-fill me-1" style="font-size: 6px; vertical-align: middle; color: var(--ibk-brand);"></i>
                            {{ $itemText }}{{ !$loop->last ? ')' : '' }}
                          </div>
                        @endforeach
                      @else
                        <p class="mb-0">{{ $surat->pekerjaan }}</p>
                      @endif
                    </div>
                  </td>

                  {{-- Pelanggan --}}
                  <td class="text-center">
                    <span class="fw-bold d-inline-flex align-items-center gap-1" style="color: var(--ibk-text);">
                      <i class="ri-user-3-line text-muted fs-13" aria-hidden="true"></i>
                      {{ $surat->customer }}
                    </span>
                  </td>

                  {{-- Jenis Bahan --}}
                  <td>
                    <span class="text-muted" style="font-size: 13px;">{{ $surat->jenis_bahan }}</span>
                  </td>

                  {{-- Target Penyelesaian --}}
                  <td class="text-center text-nowrap num">
                    @php
                      $tglTarget = $surat->target_selesai ? \Carbon\Carbon::parse($surat->target_selesai) : null;
                    @endphp
                    @if($tglTarget)
                      <div class="fw-bold" style="color: var(--ibk-text);">{{ $tglTarget->format('d/m/Y') }}</div>
                      <small class="text-muted" style="font-size: 11.5px;">{{ $tglTarget->format('H:i') }} WIB</small>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>

                  {{-- Timeline --}}
                  <td class="text-center">
                    @if($isLate)
                      <span class="badge-timeline-overdue" title="Melewati batas target penyelesaian">
                        <i class="ri-alarm-warning-fill" aria-hidden="true"></i>{{ $surat->timeline }}
                      </span>
                    @else
                      <span class="badge-timeline-ontime">
                        <i class="ri-check-line" aria-hidden="true"></i>{{ $surat->timeline ?: 'Tepat waktu' }}
                      </span>
                    @endif

                    @if($surat->timeline_design)
                      <div class="mt-1" style="font-size: 11.5px; color: var(--ibk-text-muted);">
                        <span class="badge py-0 px-1 me-1" style="background: rgba(245, 158, 11, 0.14); color: #FBBF24; font-size: 10.5px;">Design</span>{{ $surat->timeline_design }}
                      </div>
                    @endif
                    @if($surat->timeline_produksi)
                      <div class="mt-1" style="font-size: 11.5px; color: var(--ibk-text-muted);">
                        <span class="badge py-0 px-1 me-1" style="background: rgba(234, 88, 12, 0.14); color: #FB923C; font-size: 10.5px;">Produksi</span>{{ $surat->timeline_produksi }}
                      </div>
                    @endif
                  </td>

                  {{-- Respon Status Kerja --}}
                  <td class="text-center text-nowrap">
                    @if (Auth::check() && Auth::user()->role == 'Produksi')
                      @if ($surat->status_kerja === 'Selesai')
                        <span class="badge-status-selesai">
                          <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                          <span>Selesai</span>
                        </span>
                      @else
                        <div class="dropdown d-inline-block">
                          <button class="btn btn-badge-action dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ubah Tahapan Kerja SPK {{ $surat->nomor_invoice }}">
                            @if($surat->status_kerja === 'Proses Design')
                              <span class="badge-stage-design">
                                <i class="ri-pencil-ruler-line fs-13" aria-hidden="true"></i>
                                <span>Proses Design</span>
                                <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                              </span>
                            @elseif($surat->status_kerja === 'Proses Produksi')
                              <span class="badge-stage-production">
                                <i class="ri-tools-line fs-13" aria-hidden="true"></i>
                                <span>Proses Produksi</span>
                                <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                              </span>
                            @else
                              <span class="badge-stage-pending">
                                <i class="ri-hourglass-line fs-13" aria-hidden="true"></i>
                                <span>{{ $surat->status_kerja }}</span>
                                <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                              </span>
                            @endif
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            @if ($surat->status_kerja == 'Belum Diproses')
                              <li>
                                <a class="dropdown-item text-warning" href="/ubah-proses-spk/{{ $surat->id }}">
                                  <i class="ri-pencil-ruler-line fs-15 me-2"></i> Lanjut: Proses Design
                                </a>
                              </li>
                            @elseif ($surat->status_kerja == 'Proses Design')
                              <li>
                                <a class="dropdown-item text-warning" href="/ubah-proses-spk/{{ $surat->id }}">
                                  <i class="ri-tools-line fs-15 me-2"></i> Lanjut: Proses Produksi
                                </a>
                              </li>
                            @elseif ($surat->status_kerja == 'Proses Produksi')
                              <li>
                                <a class="dropdown-item text-success" href="/ubah-proses-spk/{{ $surat->id }}">
                                  <i class="ri-checkbox-circle-line fs-15 me-2"></i> Selesaikan SPK
                                </a>
                              </li>
                            @endif
                          </ul>
                        </div>
                      @endif
                    @elseif(Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
                      @if ($surat->status_kerja === 'Selesai')
                        <span class="badge-status-selesai">
                          <i class="ri-checkbox-circle-fill fs-13" aria-hidden="true"></i>
                          <span>Selesai</span>
                        </span>
                      @elseif($surat->status_kerja === 'Proses Design')
                        <span class="badge-stage-design">
                          <i class="ri-pencil-ruler-line fs-13" aria-hidden="true"></i>
                          <span>Proses Design</span>
                        </span>
                      @elseif($surat->status_kerja === 'Proses Produksi')
                        <span class="badge-stage-production">
                          <i class="ri-tools-line fs-13" aria-hidden="true"></i>
                          <span>Proses Produksi</span>
                        </span>
                      @else
                        <span class="badge-stage-pending">
                          <i class="ri-hourglass-line fs-13" aria-hidden="true"></i>
                          <span>{{ $surat->status_kerja }}</span>
                        </span>
                      @endif
                    @endif
                  </td>

                  {{-- Aksi --}}
                  <td class="text-center text-nowrap">
                    <div class="dropdown">
                      <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi SPK {{ $surat->nomor_invoice }}">
                        <i class="ri-more-fill fs-16" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="{{ url('/lihat-spk/' . $surat->id) }}">
                            <i class="ri-eye-line fs-15 text-warning" aria-hidden="true"></i>
                            <span>Lihat SPK</span>
                          </a>
                        </li>
                        @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
                          <li>
                            <a class="dropdown-item" target="_blank" href="{{ url('/cetak-spk/' . $surat->id) }}">
                              <i class="ri-printer-line fs-15 text-warning" aria-hidden="true"></i>
                              <span>Cetak SPK</span>
                            </a>
                          </li>
                          <li class="dropdown-divider"></li>
                          <li>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="dropdown-item dropdown-item--danger hapus-btn" value="{{ $surat->id }}" data-url="{{ url('/delete-spk/' . $surat->id) }}">
                              <i class="ri-delete-bin-line fs-15 text-danger" aria-hidden="true"></i>
                              <span>Hapus SPK</span>
                            </button>
                          </li>
                        @endif
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

<script>
  const nomorInvWeek = {!! json_encode($noInvWeek) !!};
  const tlDesignsWeek = {!! json_encode($tlDesgnWeek) !!};
  const tlProductionsWeek = {!! json_encode($tlProdWeek) !!};
  const tlKeseluruhanWeek = {!! json_encode($tlWeek) !!};
  const nomorInvMonth = {!! json_encode($noInvMonth) !!};
  const tlDesignsMonth = {!! json_encode($tlDesgnMonth) !!};
  const tlKeseluruhanMonth = {!! json_encode($tlMonth) !!};
  const tlProductionsMonth = {!! json_encode($tlProdMonth) !!};

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
  });
</script>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/spk.js') }}?v={{ time() }}"></script>
@endsection
'''

with open('resources/views/pages/SPK/daftar-spk.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated resources/views/pages/SPK/daftar-spk.blade.php")

