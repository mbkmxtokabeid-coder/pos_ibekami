@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.js" integrity="sha512-vv0F8Er+ByFK3l86WDjP5Zc0h8uxNWPzF+l4wGK0/BlHWxDiFHbYr/91dn8G0OO8tTnN40L4s2Whom+X2NxPog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.css" integrity="sha512-nnNXPeQKvNOEUd+TrFbofWwHT0ezcZiFU5E/Lv2+JlZCQwQ/ACM33FxPoQ6ZEFNnERrTho8lF0MCEH9DBZ/wWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
     DESIGN SYSTEM & UI/UX PRO MAX (ACCESSIBILITY & VISIBILITY REFINED)
     Theme: Dark Slate Pro (WCAG 2.2 AA Compliant)
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

  /* KPI Summary Cards (§12.4) */
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
    font-size: 26px;
    font-weight: 800;
    letter-spacing: -0.01em;
    line-height: 1.2;
    margin-bottom: 0;
  }
  .kpi-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }
  .icon-box-amber {
    background-color: rgba(245, 158, 11, 0.16);
    color: #FBBF24;
    border: 1.5px solid rgba(245, 158, 11, 0.4);
  }
  .icon-box-rose {
    background-color: rgba(244, 63, 94, 0.16);
    color: #FB7185;
    border: 1.5px solid rgba(244, 63, 94, 0.4);
  }
  .icon-box-sky {
    background-color: rgba(56, 189, 248, 0.16);
    color: #38BDF8;
    border: 1.5px solid rgba(56, 189, 248, 0.4);
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

  /* Timeframe Filter Buttons */
  .btn-time-filter {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #CBD5E1 !important;
    font-weight: 600;
    font-size: 12.5px;
    padding: 5px 14px;
    border-radius: 6px;
    transition: all 0.15s ease;
  }
  .btn-time-filter:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
  }
  .btn-time-filter.btn-info,
  .btn-time-filter.active {
    background-color: #4F46E5 !important;
    border-color: #6366F1 !important;
    color: #FFFFFF !important;
    box-shadow: 0 0 10px rgba(99, 102, 241, 0.4) !important;
  }

  /* Table Styles (§13) */
  .tokabe-table {
    background-color: #151D2A !important;
    color: #F1F5F9 !important;
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
  }
  .tokabe-table thead th {
    background-color: #101726 !important;
    color: #E2E8F0 !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-top: none !important;
    border-bottom: 2px solid #28354A !important;
    padding: 14px 16px !important;
    vertical-align: middle;
    white-space: nowrap;
  }
  .tokabe-table tbody td {
    border-bottom: 1px solid #222D3F !important;
    padding: 13px 15px !important;
    font-size: 13.5px !important;
    vertical-align: middle;
    background-color: transparent !important;
    color: #F1F5F9 !important;
  }
  .tokabe-table tbody tr:hover td {
    background-color: #1E293B !important;
  }
  .tokabe-table tbody tr:last-child td {
    border-bottom: none !important;
  }

  /* Overdue and Warning Row Styling with Non-Invasive Contrast */
  .tokabe-table tbody tr.row-accent-danger > td {
    background-color: rgba(239, 68, 68, 0.06) !important;
  }
  .tokabe-table tbody tr.row-accent-danger:hover > td {
    background-color: rgba(239, 68, 68, 0.12) !important;
  }
  .tokabe-table tbody tr.row-accent-danger > td:first-child {
    border-left: 4px solid #EF4444 !important;
  }

  .tokabe-table tbody tr.row-accent-warning > td {
    background-color: rgba(245, 158, 11, 0.06) !important;
  }
  .tokabe-table tbody tr.row-accent-warning:hover > td {
    background-color: rgba(245, 158, 11, 0.12) !important;
  }
  .tokabe-table tbody tr.row-accent-warning > td:first-child {
    border-left: 4px solid #F59E0B !important;
  }

  /* Badges & Column Highlights */
  .badge-invoice-no {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 12.5px;
    font-weight: 700;
    color: #38BDF8 !important;
    background: rgba(56, 189, 248, 0.12);
    border: 1.5px solid rgba(56, 189, 248, 0.35);
    padding: 4px 9px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .badge-status-selesai {
    background: rgba(16, 185, 129, 0.2);
    color: #6EE7B7 !important;
    border: 1.5px solid rgba(52, 211, 153, 0.45);
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-status-belum {
    background: rgba(245, 158, 11, 0.2);
    color: #FDE047 !important;
    border: 1.5px solid rgba(251, 191, 36, 0.45);
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .badge-stage-design {
    background: rgba(56, 189, 248, 0.18);
    color: #7DD3FC !important;
    border: 1.5px solid rgba(56, 189, 248, 0.45);
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-stage-production {
    background: rgba(245, 158, 11, 0.18);
    color: #FDE047 !important;
    border: 1.5px solid rgba(251, 191, 36, 0.45);
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-stage-pending {
    background: rgba(244, 63, 94, 0.18);
    color: #FDA4AF !important;
    border: 1.5px solid rgba(244, 63, 94, 0.45);
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .badge-timeline-overdue {
    background: rgba(239, 68, 68, 0.2);
    color: #FCA5A5 !important;
    border: 1.5px solid rgba(239, 68, 68, 0.5);
    font-weight: 600;
    padding: 4px 9px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .badge-timeline-ontime {
    background: rgba(16, 185, 129, 0.15);
    color: #6EE7B7 !important;
    border: 1.5px solid rgba(52, 211, 153, 0.4);
    font-weight: 600;
    padding: 4px 9px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  /* Interactive Badge Button (Dropdown Trigger) */
  .btn-badge-action {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
    cursor: pointer;
    transition: transform 0.15s ease, opacity 0.15s ease;
  }
  .btn-badge-action:hover {
    transform: scale(1.03);
    opacity: 0.95;
  }
  .btn-badge-action:focus-visible {
    outline: 2px solid #818CF8 !important;
    outline-offset: 3px;
    border-radius: 9999px;
  }
  .btn-badge-action::after {
    display: none !important;
  }

  /* Accessible Action Ghost Button */
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

  /* ==========================================================================
     DARK SLATE CUSTOM SCROLLBAR (ELIMINATES WHITE NATIVE SCROLLBAR)
     ========================================================================== */
  .table-responsive,
  .dataTables_scroll,
  .dataTables_scrollBody,
  div.dataTables_scrollBody,
  .dataTables_wrapper {
    scrollbar-width: thin !important;
    scrollbar-color: #2D3B52 #0F172A !important;
  }
  .table-responsive::-webkit-scrollbar,
  .dataTables_scroll::-webkit-scrollbar,
  .dataTables_scrollBody::-webkit-scrollbar,
  div.dataTables_scrollBody::-webkit-scrollbar,
  .dataTables_wrapper::-webkit-scrollbar {
    height: 8px !important;
    width: 8px !important;
  }
  .table-responsive::-webkit-scrollbar-track,
  .dataTables_scroll::-webkit-scrollbar-track,
  .dataTables_scrollBody::-webkit-scrollbar-track,
  div.dataTables_scrollBody::-webkit-scrollbar-track,
  .dataTables_wrapper::-webkit-scrollbar-track {
    background: #0F172A !important;
    border-radius: 4px !important;
  }
  .table-responsive::-webkit-scrollbar-thumb,
  .dataTables_scroll::-webkit-scrollbar-thumb,
  .dataTables_scrollBody::-webkit-scrollbar-thumb,
  div.dataTables_scrollBody::-webkit-scrollbar-thumb,
  .dataTables_wrapper::-webkit-scrollbar-thumb {
    background: #2D3B52 !important;
    border-radius: 4px !important;
    border: 1px solid #0F172A !important;
  }
  .table-responsive::-webkit-scrollbar-thumb:hover,
  .dataTables_scroll::-webkit-scrollbar-thumb:hover,
  .dataTables_scrollBody::-webkit-scrollbar-thumb:hover,
  div.dataTables_scrollBody::-webkit-scrollbar-thumb:hover,
  .dataTables_wrapper::-webkit-scrollbar-thumb:hover {
    background: #475569 !important;
  }

  /* ==========================================================================
     DATATABLES CONTROLS & PAGINATION (§13.2)
     Consistent with DESIGN.md & Tokabe Dark Slate System
     ========================================================================== */
  .dataTables_wrapper {
    color: #CBD5E1 !important;
    padding: 14px 16px;
    position: relative;
    clear: both;
  }
  .dataTables_wrapper::after {
    content: "";
    display: table;
    clear: both;
  }

  /* Top Controls: Length & Search Filter */
  .dataTables_wrapper .dataTables_length {
    float: left !important;
    display: inline-flex !important;
    align-items: center !important;
    height: 52px !important;
    padding: 8px 12px !important;
    margin: 0 !important;
    color: #94A3B8 !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper .dataTables_filter {
    float: right !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    height: 52px !important;
    padding: 8px 12px !important;
    margin: 0 !important;
    color: #94A3B8 !important;
    font-size: 13px !important;
  }
  .dataTables_wrapper .dataTables_length label,
  .dataTables_wrapper .dataTables_filter label {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    margin: 0 !important;
    font-size: 13px !important;
    color: #94A3B8 !important;
    font-weight: 500 !important;
  }
  .dataTables_wrapper .dataTables_length select {
    background-color: #0F172A !important;
    border: 1.5px solid #334155 !important;
    color: #F8FAFC !important;
    border-radius: 8px !important;
    padding: 5px 10px !important;
    margin: 0 4px !important;
    height: 34px !important;
  }
  .dataTables_wrapper .dataTables_filter input {
    background-color: #0F172A !important;
    border: 1.5px solid #334155 !important;
    color: #F8FAFC !important;
    border-radius: 8px !important;
    padding: 5px 12px !important;
    margin: 0 0 0 6px !important;
    height: 34px !important;
    width: 220px !important;
    outline: none !important;
  }
  .dataTables_wrapper .dataTables_filter input:focus,
  .dataTables_wrapper .dataTables_length select:focus {
    border-color: #6366F1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
  }

  /* Bottom Controls: Info (Left) & Pagination (Right) */
  .dataTables_wrapper .dataTables_info {
    float: left !important;
    display: inline-flex !important;
    align-items: center !important;
    height: 52px !important;
    padding: 8px 12px !important;
    margin: 0 !important;
    color: #94A3B8 !important;
    font-size: 13px !important;
    font-weight: 500 !important;
  }
  .dataTables_wrapper .dataTables_paginate {
    float: right !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    height: 52px !important;
    padding: 8px 12px !important;
    margin: 0 !important;
    gap: 4px !important;
  }
  .dataTables_wrapper .pagination {
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
  }

  /* High Specificity Pagination Buttons Override (Default & Bootstrap 5) */
  .dataTables_wrapper .dataTables_paginate .paginate_button,
  .dataTables_wrapper .dataTables_paginate .page-item .page-link,
  div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link {
    background-color: #1E293B !important;
    border: 1px solid #334155 !important;
    color: #CBD5E1 !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    min-width: 36px !important;
    height: 36px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 2px !important;
    cursor: pointer !important;
    transition: all 0.15s ease !important;
    box-shadow: none !important;
    line-height: 1 !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
  .dataTables_wrapper .dataTables_paginate .page-item .page-link:hover,
  div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item .page-link:hover {
    background-color: #334155 !important;
    border-color: #475569 !important;
    color: #FFFFFF !important;
  }

  /* Active Page: Brand Indigo (#4F46E5) with subtle glow */
  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
  .dataTables_wrapper .dataTables_paginate .page-item.active .page-link,
  .dataTables_wrapper .dataTables_paginate .page-item.active .page-link:hover,
  div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link,
  div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link:hover {
    background: #4F46E5 !important;
    background-color: #4F46E5 !important;
    border-color: #6366F1 !important;
    color: #FFFFFF !important;
    font-weight: 700 !important;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.45) !important;
  }

  /* Disabled Pagination State */
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
  .dataTables_wrapper .dataTables_paginate .page-item.disabled .page-link,
  div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.disabled .page-link {
    background-color: rgba(30, 41, 59, 0.5) !important;
    border-color: #28354A !important;
    color: #64748B !important;
    cursor: not-allowed !important;
    opacity: 0.55 !important;
    box-shadow: none !important;
  }

  /* Modal Dark Theme */
  .tokabe-modal-content {
    background: #151D2A !important;
    border: 1.5px solid #28354A !important;
    border-radius: 12px !important;
    color: #F8FAFC !important;
  }
  .btn-form-cancel {
    background-color: #1E293B !important;
    border: 1.5px solid #334155 !important;
    color: #E2E8F0 !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    padding: 8px 18px !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .btn-form-cancel:hover {
    background-color: #334155 !important;
    color: #FFFFFF !important;
  }
</style>
@endsection

@extends('layout.template')

@section('content')
<!-- Delete Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal-content p-3">
      <div class="modal-body text-center p-4">
        <input type="hidden" name="spk_delete_id" id="spk_id">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(239, 68, 68, 0.2); border: 1.5px solid rgba(239, 68, 68, 0.45);">
          <i class="las la-trash-alt fs-32 text-danger"></i>
        </div>
        <h5 class="text-white fw-bold mb-2">Hapus Data SPK?</h5>
        <p class="fs-13 mb-4" style="color: #CBD5E1;">
          Apakah Anda yakin ingin menghapus data Surat Perintah Kerja ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-form-cancel" data-bs-dismiss="modal">
            <i class="las la-times"></i>
            <span>Batal</span>
          </button>
          <form id="deleteForm" action="{{ url('/delete-spk') }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="border-radius: 8px;">
              <i class="las la-trash-alt fs-16"></i>
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

    <!-- Page Header & Title (§16.2) -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between py-2">
          <div>
            <h4 class="mb-sm-0 text-white fw-bold">SPK (Surat Perintah Kerja)</h4>
          </div>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript:void(0);">SPK</a></li>
              <li class="breadcrumb-item active">Daftar SPK</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Summary KPI Cards (§12.4) -->
    <div class="row g-3 mb-4">
      <!-- KPI 1: Belum Selesai -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">SPK BELUM SELESAI</div>
              <h4 class="kpi-amount num" style="color: #FBBF24;" aria-label="SPK Belum Selesai: {{ $belum_selesai }}">
                {{ $belum_selesai }}
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">Pesanan dalam tahapan pengerjaan</span>
            </div>
            <div class="kpi-icon-box icon-box-amber" aria-hidden="true">
              <i class="ri-tools-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 2: Belum Diproses -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">SPK BELUM DIPROSES</div>
              <h4 class="kpi-amount num" style="color: #FB7185;" aria-label="SPK Belum Diproses: {{ $belum_proses }}">
                {{ $belum_proses }}
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">Menunggu respon desain & produksi</span>
            </div>
            <div class="kpi-icon-box icon-box-rose" aria-hidden="true">
              <i class="las la-hourglass-half fs-24"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI 3: Total Berkas SPK -->
      <div class="col-md-4">
        <div class="tokabe-kpi-card">
          <div class="d-flex align-items-start justify-content-between">
            <div>
              <div class="kpi-title">TOTAL BERKAS SPK</div>
              <h4 class="kpi-amount num" style="color: #38BDF8;" aria-label="Total Berkas SPK: {{ count($spk) }}">
                {{ count($spk) }}
              </h4>
              <span class="fs-12 mt-1 d-block" style="color: #CBD5E1;">Seluruh data riwayat surat SPK</span>
            </div>
            <div class="kpi-icon-box icon-box-sky" aria-hidden="true">
              <i class="ri-file-list-3-line"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SPK Timeline Charts Card (§17) -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div>
              <div class="tokabe-card-title">
                <i class="ri-bar-chart-grouped-line fs-20 text-info" aria-hidden="true"></i>
                <span>SPK Timeline Charts</span>
              </div>
              <small class="fs-12 d-block mt-1" style="color: #94A3B8;">Analisis durasi pengerjaan per invoice (Desain, Produksi, dan Total)</small>
            </div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-time-filter tombol btn-sm active" onclick="timeFrame('week')" id="btn-week" aria-label="Tampilkan timeframe 1 minggu">
                1W
              </button>
              <button type="button" class="btn btn-time-filter tombol btn-sm" onclick="timeFrame('month')" id="btn-month" aria-label="Tampilkan timeframe 1 bulan">
                1M
              </button>
            </div>
          </div>
          <div class="card-body p-3">
            <div id="column_chart" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section (§13) -->
    <div class="row">
      <div class="col-12">
        <div class="tokabe-section-card">
          <div class="tokabe-card-header">
            <div class="tokabe-card-title">
              <i class="ri-file-list-3-line fs-20 text-warning" aria-hidden="true"></i>
              <span>Daftar SPK</span>
            </div>
            <div class="d-flex align-items-center gap-3">
              <div class="fs-13 d-none d-sm-block" style="color: #CBD5E1;">
                Total: <span class="fw-bold text-white num">{{ count($spk) }}</span> berkas
              </div>
              @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
                <a href="{{ url('/tambah-spk') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2" style="background: #4F46E5; border-color: #6366F1; border-radius: 8px;">
                  <i class="ri-add-line fs-16" aria-hidden="true"></i>
                  <span>Buat SPK Baru</span>
                </a>
              @endif
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0 tokabe-table" id="scroll-horizontal" aria-label="Tabel Riwayat SPK">
                <thead>
                  <tr>
                    <th scope="col" class="text-center text-nowrap" style="width: 50px;">No.</th>
                    <th scope="col" class="text-center text-nowrap" style="width: 130px;">Status</th>
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik')
                      <th scope="col" class="text-nowrap" style="min-width: 140px;">Nomor Invoice</th>
                      <th scope="col" class="text-nowrap" style="min-width: 140px;">Tanggal SPK</th>
                    @endif
                    <th scope="col" style="min-width: 250px;">Pekerjaan</th>
                    <th scope="col" class="text-center" style="min-width: 130px;">Pelanggan</th>
                    <th scope="col" style="min-width: 130px;">Jenis</th>
                    <th scope="col" class="text-center text-nowrap">Target Selesai</th>
                    <th scope="col" class="text-center" style="min-width: 160px;">Timeline</th>
                    <th scope="col" class="text-center text-nowrap" style="width: 130px;">Respon</th>
                    <th scope="col" class="text-center text-nowrap" style="width: 70px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($spk as $surat)
                    @php
                      $isLate = ($surat->color == 'red');
                      $isExpress = ($surat->express == 'Y' && $surat->status_kerja != 'Selesai');
                    @endphp
                    <tr class="{{ $isLate ? 'row-accent-danger' : ($isExpress ? 'row-accent-warning' : '') }}">
                      <td class="text-center num fw-medium" style="color: #94A3B8;">{{ $loop->iteration }}</td>

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
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                  <li>
                                    <a class="dropdown-item text-success" href="{{ url('/ubah-status-spk/' . $surat->id) }}">
                                      <i class="las la-clipboard-check fs-16 text-success" aria-hidden="true"></i>
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
                              <i class="lab la-whatsapp fs-16 align-middle me-1"></i> Approve
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
                            <i class="ri-file-text-line" aria-hidden="true"></i>
                            {{ $surat->nomor_invoice }}
                          </span>
                          @if($surat->express == 'Y')
                            <span class="badge bg-warning text-dark fw-bold ms-1" style="font-size: 10.5px; border-radius: 4px;">KILAT</span>
                          @endif
                        </td>
                        <td class="text-nowrap num fw-medium" style="color: #CBD5E1;">
                          {{ $surat->tgl_mulai }}
                        </td>
                      @endif

                      {{-- Pekerjaan --}}
                      <td>
                        <div class="fw-semibold mb-0" style="color: #F8FAFC; line-height: 1.45;">
                          @if(strpos($surat->pekerjaan, '), ') !== false)
                            @php
                              $items = explode('), ', $surat->pekerjaan);
                            @endphp
                            @foreach($items as $itemText)
                              <div class="py-1" style="{{ !$loop->last ? 'border-bottom: 1px dashed rgba(255,255,255,0.12);' : '' }}">
                                <i class="ri-checkbox-blank-circle-fill me-1" style="font-size: 6px; vertical-align: middle; color: #38BDF8;"></i>
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
                        <span class="fw-bold text-white d-inline-flex align-items-center gap-1">
                          <i class="ri-user-3-line text-info fs-13" aria-hidden="true"></i>
                          {{ $surat->customer }}
                        </span>
                      </td>

                      {{-- Jenis Bahan --}}
                      <td>
                        <span class="fw-medium" style="color: #CBD5E1;">{{ $surat->jenis_bahan }}</span>
                      </td>

                      {{-- Target Penyelesaian --}}
                      <td class="text-center text-nowrap num">
                        @php
                          $tglTarget = $surat->target_selesai ? \Carbon\Carbon::parse($surat->target_selesai) : null;
                        @endphp
                        @if($tglTarget)
                          <div class="fw-bold text-white">{{ $tglTarget->format('d/m/Y') }}</div>
                          <small style="color: #94A3B8; font-size: 12px;">{{ $tglTarget->format('H:i') }} WIB</small>
                        @else
                          <span style="color: #94A3B8;">-</span>
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
                          <div class="mt-1" style="color: #CBD5E1; font-size: 12px;">
                            <span class="badge bg-dark border border-secondary text-info px-1 py-0 me-1" style="font-size: 11px;">Design</span>{{ $surat->timeline_design }}
                          </div>
                        @endif
                        @if($surat->timeline_produksi)
                          <div class="mt-1" style="color: #CBD5E1; font-size: 12px;">
                            <span class="badge bg-dark border border-secondary text-warning px-1 py-0 me-1" style="font-size: 11px;">Produksi</span>{{ $surat->timeline_produksi }}
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
                                    <i class="las la-pencil-ruler fs-14" aria-hidden="true"></i>
                                    <span>Proses Design</span>
                                    <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                                  </span>
                                @elseif($surat->status_kerja === 'Proses Produksi')
                                  <span class="badge-stage-production">
                                    <i class="las la-tools fs-14" aria-hidden="true"></i>
                                    <span>Proses Produksi</span>
                                    <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                                  </span>
                                @else
                                  <span class="badge-stage-pending">
                                    <i class="ri-hourglass-2-line fs-13" aria-hidden="true"></i>
                                    <span>{{ $surat->status_kerja }}</span>
                                    <i class="ri-arrow-down-s-line fs-14 ms-1" aria-hidden="true"></i>
                                  </span>
                                @endif
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                @if ($surat->status_kerja == 'Belum Diproses')
                                  <li>
                                    <a class="dropdown-item text-info" href="/ubah-proses-spk/{{ $surat->id }}">
                                      <i class="las la-pencil-ruler fs-16 text-info me-2"></i> Lanjut: Proses Design
                                    </a>
                                  </li>
                                @elseif ($surat->status_kerja == 'Proses Design')
                                  <li>
                                    <a class="dropdown-item text-warning" href="/ubah-proses-spk/{{ $surat->id }}">
                                      <i class="las la-tools fs-16 text-warning me-2"></i> Lanjut: Proses Produksi
                                    </a>
                                  </li>
                                @elseif ($surat->status_kerja == 'Proses Produksi')
                                  <li>
                                    <a class="dropdown-item text-success" href="/ubah-proses-spk/{{ $surat->id }}">
                                      <i class="las la-check-circle fs-16 text-success me-2"></i> Selesaikan SPK
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
                              <i class="las la-pencil-ruler fs-14" aria-hidden="true"></i>
                              <span>Proses Design</span>
                            </span>
                          @elseif($surat->status_kerja === 'Proses Produksi')
                            <span class="badge-stage-production">
                              <i class="las la-tools fs-14" aria-hidden="true"></i>
                              <span>Proses Produksi</span>
                            </span>
                          @else
                            <span class="badge-stage-pending">
                              <i class="ri-hourglass-2-line fs-13" aria-hidden="true"></i>
                              <span>{{ $surat->status_kerja }}</span>
                            </span>
                          @endif
                        @endif
                      </td>

                      {{-- Aksi --}}
                      <td class="text-center text-nowrap">
                        <div class="dropdown">
                          <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu Aksi SPK {{ $surat->nomor_invoice }}">
                            <i class="ri-more-fill fs-18" aria-hidden="true"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li>
                              <a class="dropdown-item" href="{{ url('/lihat-spk/' . $surat->id) }}">
                                <i class="las la-eye fs-16 text-info" aria-hidden="true"></i>
                                <span>Lihat SPK</span>
                              </a>
                            </li>
                            @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
                              <li>
                                <a class="dropdown-item" target="_blank" href="{{ url('/cetak-spk/' . $surat->id) }}">
                                  <i class="las la-print fs-16 text-primary" aria-hidden="true"></i>
                                  <span>Cetak SPK</span>
                                </a>
                              </li>
                              <li class="dropdown-divider"></li>
                              <li>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="dropdown-item dropdown-item--danger hapus-btn" value="{{ $surat->id }}" data-url="{{ url('/delete-spk/' . $surat->id) }}">
                                  <i class="las la-trash-alt fs-16 text-danger" aria-hidden="true"></i>
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
</script>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('js/halaman/spk.js') }}?v={{ time() }}"></script>
@endsection