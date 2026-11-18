@extends('layout.template')

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

      /* Table Variables */
      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.08);
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
      --ibk-info: #0284C7;
      --ibk-info-soft: #F0F9FF;
      --ibk-info-border: #BAE6FD;

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #DDD6CE;
      --ibk-input-text: #0F172A;
      --ibk-popover-bg: #FFFFFF;

      /* Table Variables */
      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #64748B;
      --ibk-td-border: #EAE4DC;
    }

    body.theme-light .tokabe-table thead th,
    html.theme-light .tokabe-table thead th,
    html[data-layout-mode="light"] .tokabe-table thead th {
      background: #F3EFE6 !important;
      background-color: #F3EFE6 !important;
      color: #64748B !important;
      border-bottom: 1px solid #EAE4DC !important;
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
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text, var(--ibk-text-dim)) !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      padding: 10px 14px !important;
      border-bottom: 1px solid var(--ibk-td-border, var(--ibk-border)) !important;
      border-top: none !important;
      white-space: nowrap !important;
      height: 44px !important;
      vertical-align: middle !important;
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
    #table-spj {
      min-width: 1050px !important;
    }
    .tokabe-table tbody tr {
      content-visibility: auto;
      contain-intrinsic-size: 0 64px;
      height: 64px !important;
      transition: none !important;
    }
    .tokabe-table tbody td {
      background: transparent !important;
      color: var(--ibk-text) !important;
      font-size: 12.5px !important;
      padding: 8px 14px !important;
      border-bottom: 1px solid var(--ibk-td-border, var(--ibk-border-subtle)) !important;
      vertical-align: middle !important;
      height: 64px !important;
      transition: none !important;
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

    /* DataTables Custom Controls (Clean & Aligned) */
    .dataTables_wrapper {
      padding: 16px 20px;
      padding: 0 !important;
      width: 100% !important;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper > .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
    }
    .dataTables_wrapper .dataTables_length {
      float: left !important;
      margin-bottom: 14px !important;
    }
    .dataTables_wrapper .dataTables_filter {
      float: right !important;
      margin-bottom: 14px !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 4px 24px 4px 10px !important;
      font-size: 13px !important;
      height: 36px !important;
      outline: none !important;
      cursor: pointer;
    }
    .dataTables_wrapper .dataTables_filter input {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 14px !important;
      margin-left: 0 !important;
      font-size: 13px !important;
      height: 36px !important;
      outline: none !important;
      width: 220px !important;
      transition: all 0.15s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
    }
    .dataTables_wrapper::after {
      content: "";
      display: table;
      clear: both;
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
            <table class="table align-middle mb-0 tokabe-table" id="table-spj">
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

        <!-- Table Footer matching Invoice standard -->
        <div class="ibk-table-footer">
          <div id="tokabeCustomInfo"></div>
          <div id="tokabeCustomPaginate"></div>
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

      if ($.fn.DataTable.isDataTable('#table-spj')) {
        $('#table-spj').DataTable().destroy();
      }
      $('#table-spj').DataTable({
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
          syncCustomFooter('#table-spj');
        },
        language: {
          search: "",
          searchPlaceholder: "Cari nomor SPJ / tujuan / kurir...",
          lengthMenu: "Tampilkan _MENU_ entri",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ tugas SPJ",
          infoEmpty: "Tidak ada data SPJ",
          infoFiltered: "(disaring dari _MAX_ total data)",
          paginate: {
            first: '<i class="ri-skip-back-line"></i>',
            previous: '<i class="ri-arrow-left-s-line"></i>',
            next: '<i class="ri-arrow-right-s-line"></i>',
            last: '<i class="ri-skip-forward-line"></i>'
          }
        }
      });

      setTimeout(function() { syncCustomFooter('#table-spj'); }, 50);
      setTimeout(function() { syncCustomFooter('#table-spj'); }, 200);
      setTimeout(function() { syncCustomFooter('#table-spj'); }, 500);
    });
  </script>

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
