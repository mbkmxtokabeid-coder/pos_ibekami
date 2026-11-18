@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<link rel="stylesheet" href="{{ asset('libs/apexcharts/apexcharts.css') }}" />
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
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

    --ibk-th-bg: #F3EFE6;
    --ibk-th-text: #64748B;
    --ibk-td-border: #EAE4DC;

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


  #column_chart,
  .apex-charts,
  .apexcharts-canvas,
  .apexcharts-canvas svg,
  .apexcharts-svg {
    background: transparent !important;
  }

  /* Table Styles */
  .tokabe-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
    background: transparent !important;
  }
  body.theme-light .tokabe-table thead th,
  html.theme-light .tokabe-table thead th,
  html[data-layout-mode="light"] .tokabe-table thead th {
    background: var(--ibk-th-bg) !important;
    color: var(--ibk-th-text) !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--ibk-td-border) !important;
    padding: 10px 14px !important;
    vertical-align: middle !important;
    white-space: nowrap;
    height: 44px !important;
  }
  .table-responsive {
    width: 100% !important;
    display: block !important;
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch !important;
    border-top: 1px solid var(--ibk-border) !important;
    border-bottom: 1px solid var(--ibk-border) !important;
    scrollbar-width: thin;
    scrollbar-color: var(--ibk-text-dim, #78716C) transparent;
  }
  .table-responsive::-webkit-scrollbar {
    height: 8px;
  }
  .table-responsive::-webkit-scrollbar-track {
    background: var(--ibk-surface);
  }
  .table-responsive::-webkit-scrollbar-thumb {
    background: rgba(120, 113, 108, 0.45);
    border-radius: 9999px;
  }
  .table-responsive::-webkit-scrollbar-thumb:hover {
    background: var(--ibk-brand, #EA580C);
  }
  #table-spk {
    min-width: 1420px !important;
  }
  .tokabe-table tbody tr {
    content-visibility: auto;
    contain-intrinsic-size: 0 64px;
    height: 64px !important;
  }
  .tokabe-table tbody tr,
  .tokabe-table tbody td {
    transition: none !important;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid var(--ibk-td-border) !important;
    padding: 8px 14px !important;
    font-size: 12.5px !important;
    vertical-align: middle !important;
    color: var(--ibk-text) !important;
    background-color: transparent !important;
    height: 64px !important;
  }
  .tokabe-table tbody tr:hover td {
    background-color: var(--ibk-surface-hover) !important;
  }
  .spk-pekerjaan-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.35;
    max-height: 36px;
    font-size: 12.5px;
    font-weight: 500;
    color: var(--ibk-text);
    word-break: break-word;
  }
  .tokabe-table tbody tr {
    content-visibility: auto;
    contain-intrinsic-size: 0 64px;
  }
  .tokabe-table tbody tr,
  .tokabe-table tbody td {
    transition: none !important;
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
    padding: 0 !important;
    width: 100% !important;
  }
  .dataTables_wrapper > .row {
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter,
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_paginate {
    color: var(--ibk-text-muted) !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper::after {
    content: "";
    display: table;
    clear: both;
  }
  .dataTables_wrapper .dataTables_length {
    margin-bottom: 0 !important;
  }
  .dataTables_wrapper .dataTables_length label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px;
  }
  .dataTables_wrapper .dataTables_filter {
    margin-bottom: 0 !important;
  }
  .dataTables_wrapper .dataTables_filter label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
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
    margin-left: 0 !important;
    outline: none !important;
    height: 36px !important;
  }
  .dataTables_wrapper .dataTables_filter input:focus,
  .dataTables_wrapper .dataTables_length select:focus {
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
  }
  /* Table Footer & Pagination (Standard Invoice Layout) */
  .ibk-table-footer {
    padding: 16px 24px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    border-top: 1px solid var(--ibk-border) !important;
    position: relative !important;
    z-index: 5 !important;
    min-height: 64px !important;
    box-sizing: border-box !important;
    background: transparent !important;
  }
  body.theme-light .ibk-table-footer,
  html.theme-light .ibk-table-footer,
  html[data-layout-mode="light"] .ibk-table-footer {
    border-top: 1px solid #EAE4DC !important;
    background: transparent !important;
  }
  #tokabeCustomInfo {
    display: flex !important;
    align-items: center !important;
    min-height: 38px !important;
  }
  #tokabeCustomPaginate {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    margin-left: auto !important;
  }
  .dataTables_info {
    color: var(--ibk-text-muted) !important;
    border-radius: 6px !important;
    font-size: 13px !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
  }
  .dataTables_paginate {
    display: inline-flex !important;
    align-items: center !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  .dataTables_paginate ul.pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 4px 6px !important;
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 14px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 4px 14px rgba(0, 0, 0, 0.25) !important;
  }
  .dataTables_paginate li.page-item {
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    display: inline-flex !important;
  }
  .dataTables_paginate .page-link,
  .dataTables_paginate .paginate_button {
    min-width: 36px !important;
    height: 36px !important;
    padding: 0 10px !important;
    margin: 0 !important;
    border-radius: 10px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    text-decoration: none !important;
    cursor: pointer !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    padding: 4px 10px !important;
    color: #B5AC9F !important;
    box-shadow: none !important;
    outline: none !important;
    transition: all 0.2s cubic-bezier(.2,.8,.2,1) !important;
    user-select: none !important;
  }
  .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
  .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
    background: rgba(249, 115, 22, 0.14) !important;
    border-color: rgba(249, 115, 22, 0.35) !important;
    color: #FB923C !important;
    transform: translateY(-2px) scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2) !important;
  }
  .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:active,
  .dataTables_paginate .paginate_button:not(.current):not(.disabled):active {
    transform: scale(0.94) !important;
  }
  .dataTables_paginate li.page-item.active .page-link,
  .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
    color: #1A0F05 !important;
    font-weight: 700 !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0 4px 16px rgba(249, 115, 22, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.35) !important;
    transform: translateY(-1px) scale(1.06) !important;
    animation: ibkPageActivePop 260ms cubic-bezier(.2,.8,.2,1) !important;
    z-index: 2 !important;
  }
  @keyframes ibkPageActivePop {
    0% { transform: scale(0.88); opacity: 0.7; }
    60% { transform: scale(1.1); }
    100% { transform: translateY(-1px) scale(1.06); opacity: 1; }
  }
  .dataTables_paginate li.page-item.previous .page-link,
  .dataTables_paginate li.page-item.next .page-link,
  .dataTables_paginate .paginate_button.previous,
  .dataTables_paginate .paginate_button.next {
    font-size: 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    background: rgba(255, 255, 255, 0.04) !important;
  }
  .dataTables_paginate li.page-item.disabled .page-link,
  .dataTables_paginate .paginate_button.disabled {
    opacity: 0.3 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #71717A !important;
    box-shadow: none !important;
    transform: none !important;
  }

  /* Light Mode Overrides for Table Footer & Pagination */
  body.theme-light .dataTables_info,
  html.theme-light .dataTables_info,
  html[data-layout-mode="light"] .dataTables_info {
    color: #64748B !important;
  }
  body.theme-light .dataTables_paginate ul.pagination,
  html.theme-light .dataTables_paginate ul.pagination,
  html[data-layout-mode="light"] .dataTables_paginate ul.pagination {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04) !important;
  }
  body.theme-light .dataTables_paginate .page-link,
  body.theme-light .dataTables_paginate .paginate_button,
  html.theme-light .dataTables_paginate .page-link,
  html.theme-light .dataTables_paginate .paginate_button,
  html[data-layout-mode="light"] .dataTables_paginate .page-link,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button {
    color: #475569 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
  }
  body.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
  body.theme-light .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
  html.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
  html.theme-light .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
  html[data-layout-mode="light"] .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
    background: #FFF7ED !important;
    border-color: #FDBA74 !important;
    color: #C2410C !important;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.12) !important;
  }
  body.theme-light .dataTables_paginate li.page-item.active .page-link,
  body.theme-light .dataTables_paginate .paginate_button.current,
  html.theme-light .dataTables_paginate li.page-item.active .page-link,
  html.theme-light .dataTables_paginate .paginate_button.current,
  html[data-layout-mode="light"] .dataTables_paginate li.page-item.active .page-link,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35) !important;
  }
  body.theme-light .dataTables_paginate li.page-item.previous .page-link,
  body.theme-light .dataTables_paginate li.page-item.next .page-link,
  body.theme-light .dataTables_paginate .paginate_button.previous,
  body.theme-light .dataTables_paginate .paginate_button.next,
  html.theme-light .dataTables_paginate li.page-item.previous .page-link,
  html.theme-light .dataTables_paginate li.page-item.next .page-link,
  html.theme-light .dataTables_paginate .paginate_button.previous,
  html.theme-light .dataTables_paginate .paginate_button.next,
  html[data-layout-mode="light"] .dataTables_paginate li.page-item.previous .page-link,
  html[data-layout-mode="light"] .dataTables_paginate li.page-item.next .page-link,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button.previous,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button.next {
    border: 1px solid #E2E8F0 !important;
    background: #FFFFFF !important;
    color: #475569 !important;
  }
  body.theme-light .dataTables_paginate li.page-item.disabled .page-link,
  body.theme-light .dataTables_paginate .paginate_button.disabled,
  html.theme-light .dataTables_paginate li.page-item.disabled .page-link,
  html.theme-light .dataTables_paginate .paginate_button.disabled,
  html[data-layout-mode="light"] .dataTables_paginate li.page-item.disabled .page-link,
  html[data-layout-mode="light"] .dataTables_paginate .paginate_button.disabled {
    opacity: 0.35 !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #94A3B8 !important;
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
              <i class="ri-time-line"></i>
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

      <!-- Render SPK Chart IMMEDIATELY before browser parses the large table below -->
      <script>
        const nomorInvWeek = {!! json_encode($noInvWeek) !!};
        const tlDesignsWeek = {!! json_encode($tlDesgnWeek) !!};
        const tlProductionsWeek = {!! json_encode($tlProdWeek) !!};
        const tlKeseluruhanWeek = {!! json_encode($tlWeek) !!};
        const nomorInvMonth = {!! json_encode($noInvMonth) !!};
        const tlDesignsMonth = {!! json_encode($tlDesgnMonth) !!};
        const tlKeseluruhanMonth = {!! json_encode($tlMonth) !!};
        const tlProductionsMonth = {!! json_encode($tlProdMonth) !!};
      </script>
      <script src="{{ asset('js/halaman/spk.js') }}?v={{ time() }}"></script>

      <!-- 4. Table Section -->
      <div class="ibk-card">
        <div class="ibk-card-header">
          <div class="ibk-card-title">
            <i class="ri-history-line"></i>
            <span>Daftar Riwayat SPK</span>
          </div>
          <span class="badge-count-pill">{{ count($spk) }} Berkas</span>
        </div>

        <div class="card-body p-0">
          <table class="table align-middle mb-0 tokabe-table" id="table-spk" aria-label="Tabel Riwayat SPK">
            <thead>
              <tr>
                <th scope="col" class="text-center text-nowrap" style="width: 45px;">NO.</th>
                <th scope="col" class="text-center text-nowrap" style="width: 125px;">STATUS</th>
                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik')
                  <th scope="col" class="text-nowrap" style="width: 140px;">NOMOR INVOICE</th>
                  <th scope="col" class="text-center text-nowrap" style="width: 125px;">TANGGAL SPK</th>
                @endif
                <th scope="col" style="min-width: 260px;">PEKERJAAN</th>
                <th scope="col" class="text-center text-nowrap" style="width: 130px;">PELANGGAN</th>
                <th scope="col" class="text-nowrap" style="width: 130px;">JENIS</th>
                <th scope="col" class="text-center text-nowrap" style="width: 125px;">TARGET SELESAI</th>
                <th scope="col" class="text-center" style="width: 180px;">TIMELINE</th>
                <th scope="col" class="text-center text-nowrap" style="width: 130px;">RESPON</th>
                <th scope="col" class="text-center text-nowrap" style="width: 50px;">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($spk as $surat)
                @php
                  $isLate = ($surat->color == 'red');
                  $isExpress = ($surat->express == 'Y' && $surat->status_kerja != 'Selesai');
                  $tglMulai = $surat->tgl_mulai ? \Carbon\Carbon::parse($surat->tgl_mulai) : null;
                  $tglTarget = $surat->target_selesai ? \Carbon\Carbon::parse($surat->target_selesai) : null;
                @endphp
                <tr class="{{ $isLate ? 'row-accent-danger' : ($isExpress ? 'row-accent-warning' : '') }}">
                  {{-- No --}}
                  <td class="text-center num text-muted fw-semibold" style="font-size: 12.5px;">{{ $loop->iteration }}</td>

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
                        <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm text-white fw-semibold px-2 py-1" style="background: #059669; border-radius: 6px; font-size: 11.5px;" aria-label="Kirim Permohonan Approve via WhatsApp">
                          <i class="ri-whatsapp-line fs-14 align-middle me-1"></i> Approve
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

                  {{-- Nomor Invoice --}}
                  @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik')
                    <td class="text-nowrap">
                      <div class="d-inline-flex align-items-center gap-1">
                        <span class="badge-invoice-no">
                          <i class="ri-file-text-line text-muted" aria-hidden="true"></i>
                          <span>{{ $surat->nomor_invoice }}</span>
                        </span>
                        @if($surat->express == 'Y')
                          <span class="badge py-0.5 px-1.5 fs-10 fw-bold" style="background: rgba(234, 88, 12, 0.16); color: #EA580C; border: 1px solid rgba(234, 88, 12, 0.3); border-radius: 4px;">KILAT</span>
                        @endif
                      </div>
                    </td>
                    {{-- Tanggal SPK --}}
                    <td class="text-nowrap text-center num">
                      @if($tglMulai)
                        <div class="fw-semibold" style="font-size: 12px; color: var(--ibk-text); line-height: 1.2;">{{ $tglMulai->format('d/m/Y') }}</div>
                        <small class="text-muted" style="font-size: 11px;">{{ $tglMulai->format('H:i') }} WIB</small>
                      @else
                        <span class="text-muted">-</span>
                      @endif
                    </td>
                  @endif

                  {{-- Pekerjaan --}}
                  <td>
                    <div class="spk-pekerjaan-clamp" title="{{ $surat->pekerjaan }}">
                      {{ $surat->pekerjaan }}
                    </div>
                  </td>

                  {{-- Pelanggan --}}
                  <td class="text-center text-nowrap">
                    <div class="fw-bold text-truncate" style="max-width: 125px; margin: 0 auto; color: var(--ibk-text); font-size: 12.5px;" title="{{ $surat->customer }}">
                      <i class="ri-user-3-line text-muted fs-12 me-1" aria-hidden="true"></i>{{ $surat->customer }}
                    </div>
                  </td>

                  {{-- Jenis Bahan --}}
                  <td class="text-nowrap">
                    <div class="text-muted text-truncate" style="max-width: 120px; font-size: 12.5px;" title="{{ $surat->jenis_bahan ?: '-' }}">
                      {{ $surat->jenis_bahan ?: '-' }}
                    </div>
                  </td>

                  {{-- Target Penyelesaian --}}
                  <td class="text-center text-nowrap num">
                    @if($tglTarget)
                      <div class="fw-semibold" style="font-size: 12px; color: var(--ibk-text); line-height: 1.2;">{{ $tglTarget->format('d/m/Y') }}</div>
                      <small class="text-muted" style="font-size: 11px;">{{ $tglTarget->format('H:i') }} WIB</small>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>

                  {{-- Timeline --}}
                  <td class="text-center text-nowrap">
                    @php
                      $tooltipTimeline = ($surat->timeline_design ? 'Design: ' . $surat->timeline_design : '') . 
                                         ($surat->timeline_produksi ? ($surat->timeline_design ? ' | ' : '') . 'Produksi: ' . $surat->timeline_produksi : '');
                    @endphp
                    <div class="d-flex align-items-center justify-content-center" style="height: 36px;" title="{{ $tooltipTimeline ?: ($isLate ? 'Melewati batas target penyelesaian' : 'Tepat waktu') }}">
                      @if($isLate)
                        <span class="badge-timeline-overdue">
                          <i class="ri-alarm-warning-fill" aria-hidden="true"></i>{{ $surat->timeline }}
                        </span>
                      @else
                        <span class="badge-timeline-ontime">
                          <i class="ri-check-line" aria-hidden="true"></i>{{ $surat->timeline ?: 'Tepat waktu' }}
                        </span>
                      @endif
                    </div>
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
                                <i class="ri-time-line fs-13" aria-hidden="true"></i>
                                <span>{{ $surat->status_kerja }}</span>
                                <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                              </span>
                            @endif
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="{{ url('/ubah-proses-spk/' . $surat->id) }}">
                                <i class="ri-arrow-right-circle-line fs-15 text-warning" aria-hidden="true"></i>
                                <span>Lanjutkan Tahap Berikutnya</span>
                              </a>
                            </li>
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
                          <i class="ri-time-line fs-13" aria-hidden="true"></i>
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

        <!-- Table Footer matching Invoice standard -->
        <div class="ibk-table-footer">
          <div id="tokabeCustomInfo"></div>
          <div id="tokabeCustomPaginate"></div>
        </div>
      </div>

    </div>
  </div>
</div>

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
  });
</script>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    function syncCustomFooter(tableId) {
      var wrapper = $(tableId + '_wrapper');
      if (!wrapper.length) return;
      var infoEl = wrapper.find('.dataTables_info');
      var paginateEl = wrapper.find('.dataTables_paginate');

      if (infoEl.length && $('#tokabeCustomInfo').length) {
        if ($('#tokabeCustomInfo').children().first()[0] !== infoEl[0]) {
          $('#tokabeCustomInfo').empty().append(infoEl);
        }
      }
      if (paginateEl.length && $('#tokabeCustomPaginate').length) {
        if ($('#tokabeCustomPaginate').children().first()[0] !== paginateEl[0]) {
          $('#tokabeCustomPaginate').empty().append(paginateEl);
        }
      }
      wrapper.children('.row:last-child').each(function() {
        if ($(this).find('.dataTables_info, .dataTables_paginate').length === 0) {
          $(this).hide();
        }
      });
    }

    if ($.fn.DataTable.isDataTable('#table-spk')) {
      $('#table-spk').DataTable().destroy();
    }
    var spkTable = $('#table-spk').DataTable({
      paging: true,
      pageLength: 10,
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      ordering: false,
      autoWidth: false,
      scrollX: false,
      deferRender: true,
      orderClasses: false,
      dom: "<'row p-3 pb-2 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-md-end'f>>" +
           "<'table-responsive'tr>" +
           "<'row d-none'<'col-sm-6'i><'col-sm-6'p>>",
      drawCallback: function() {
        syncCustomFooter('#table-spk');
      },
      language: {
        search: "",
        searchPlaceholder: "Cari nomor invoice / pekerjaan...",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ berkas",
        infoEmpty: "Tidak ada data berkas",
        infoFiltered: "(disaring dari _MAX_ total berkas)",
        paginate: {
          first: '<i class="ri-skip-back-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>',
          next: '<i class="ri-arrow-right-s-line"></i>',
          last: '<i class="ri-skip-forward-line"></i>'
        }
      }
    });

    setTimeout(function() { syncCustomFooter('#table-spk'); }, 50);
    setTimeout(function() { syncCustomFooter('#table-spk'); }, 200);
    setTimeout(function() { syncCustomFooter('#table-spk'); }, 500);
  });
</script>
@endsection
