@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

  <style>
    /* ==========================================================================
       TOKABE DAFTAR KARYAWAN — WARM STONE DUAL-THEME SYSTEM
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

      --ibk-warning: #F59E0B;
      --ibk-warning-soft: rgba(245, 158, 11, 0.14);
      --ibk-warning-border: rgba(245, 158, 11, 0.3);
      --ibk-warning-text: #FCD34D;

      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.14);
      --ibk-danger-border: rgba(239, 68, 68, 0.3);
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
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23A8A29E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #181412;
      --ibk-th-text: #A8A29E;
      --ibk-td-border: rgba(255, 255, 255, 0.06);

      --ibk-modal-bg: #181412;
      --ibk-modal-header-bg: #14110F;
      --ibk-modal-border: rgba(255, 255, 255, 0.08);
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

      --ibk-warning: #D97706;
      --ibk-warning-soft: #FFFBEB;
      --ibk-warning-border: #FDE68A;
      --ibk-warning-text: #B45309;

      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;
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
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2357534E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #57534E;
      --ibk-td-border: #EAE4DC;

      --ibk-modal-bg: #FFFFFF;
      --ibk-modal-header-bg: #FAF8F5;
      --ibk-modal-border: #E6E1D8;
    }

    .user-page-wrapper {
      position: relative;
      width: 100%;
      padding-bottom: 48px;
      font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
      color: var(--ibk-text);
    }

    /* Header Section */
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
    .ibk-header-actions {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
    }

    .ibk-btn-primary {
      background: var(--ibk-brand-btn-bg) !important;
      border: 1px solid var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      padding: 0 16px !important;
      height: 38px !important;
      border-radius: 8px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer !important;
      transition: background-color 150ms ease, box-shadow 150ms ease !important;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
      text-decoration: none !important;
      white-space: nowrap;
    }
    .ibk-btn-primary:hover {
      background: var(--ibk-brand-hover) !important;
      border-color: var(--ibk-brand-hover) !important;
      color: #FFFFFF !important;
    }
    .ibk-btn-primary:focus-visible,
    .ref-theme-toggle:focus-visible,
    .btn-action-edit:focus-visible,
    .btn-action-toggle:focus-visible,
    .btn-tokabe-modal-cancel:focus-visible {
      outline: 2px solid var(--ibk-brand) !important;
      outline-offset: 2px !important;
    }

    /* 3 Compact KPI Summary Cards */
    .ibk-kpi-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
      margin-bottom: 20px;
    }
    @media (max-width: 767.98px) {
      .ibk-kpi-grid {
        grid-template-columns: 1fr;
      }
    }
    .ibk-kpi-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      padding: 16px 20px;
      box-shadow: var(--ibk-card-shadow);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      transition: border-color 150ms ease;
    }
    .ibk-kpi-card:hover {
      border-color: var(--ibk-brand-border);
    }
    .ibk-kpi-label {
      font-size: 12px;
      font-weight: 600;
      color: var(--ibk-text-muted);
      margin-bottom: 4px;
    }
    .ibk-kpi-value {
      font-size: 20px;
      font-weight: 700;
      color: var(--ibk-text);
      font-variant-numeric: tabular-nums;
      line-height: 1.2;
    }
    .ibk-kpi-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 19px;
      flex-shrink: 0;
    }
    .ibk-kpi-icon--success {
      background: var(--ibk-success-soft);
      border-color: var(--ibk-success-border);
      color: var(--ibk-success-text);
    }
    .ibk-kpi-icon--danger {
      background: var(--ibk-danger-soft);
      border-color: var(--ibk-danger-border);
      color: var(--ibk-danger-text);
    }

    /* Main Card */
    .ibk-card {
      background: var(--ibk-card-bg);
      border: 1px solid var(--ibk-border);
      border-radius: 12px;
      box-shadow: var(--ibk-card-shadow);
      overflow: hidden;
    }
    .ibk-card-header {
      padding: 16px 20px;
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
      flex-wrap: wrap;
    }
    .ibk-card-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .ibk-card-title i {
      color: var(--ibk-brand);
      font-size: 18px;
    }
    .badge-count-pill {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      padding: 2px 10px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
      font-variant-numeric: tabular-nums;
    }

    /* Table Styling */
    .table-responsive {
      width: 100% !important;
      display: block !important;
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
      border-top: 1px solid var(--ibk-border) !important;
      border-bottom: 1px solid var(--ibk-border) !important;
      scrollbar-width: thin;
      scrollbar-color: var(--ibk-text-dim) transparent;
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
      background: var(--ibk-brand);
    }

    #table-user {
      min-width: 1020px !important;
      width: 100% !important;
      margin: 0 !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      background: transparent !important;
    }
    .tokabe-table thead th {
      background: var(--ibk-th-bg) !important;
      color: var(--ibk-th-text) !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.04em !important;
      border-top: none !important;
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 11px 16px !important;
      vertical-align: middle !important;
      white-space: nowrap;
      height: 44px !important;
    }
    .tokabe-table tbody tr {
      height: 60px !important;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 10px 16px !important;
      font-size: 13px !important;
      vertical-align: middle !important;
      color: var(--ibk-text) !important;
      background-color: transparent !important;
    }
    .tokabe-table tbody tr:hover td {
      background-color: var(--ibk-surface-hover) !important;
    }

    /* User Avatar & Email */
    .user-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand-text);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 700;
      flex-shrink: 0;
    }
    .user-email-link {
      color: var(--ibk-text-muted) !important;
      text-decoration: none !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: color 150ms ease;
    }
    .user-email-link:hover {
      color: var(--ibk-brand-text) !important;
    }

    /* Role Badges */
    .badge-role-pemilik {
      background: var(--ibk-purple-soft);
      color: var(--ibk-purple-text);
      border: 1px solid var(--ibk-purple-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
    }
    .badge-role-admin {
      background: var(--ibk-info-soft);
      color: var(--ibk-info-text);
      border: 1px solid var(--ibk-info-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
    }
    .badge-role-magang {
      background: var(--ibk-warning-soft);
      color: var(--ibk-warning-text);
      border: 1px solid var(--ibk-warning-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
    }
    .badge-role-default {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;
    }

    /* Contact & Signature Badges */
    .contact-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 6px;
      background: var(--ibk-success-soft);
      border: 1px solid var(--ibk-success-border);
      color: var(--ibk-success-text) !important;
      font-size: 12.5px;
      font-weight: 600;
      font-variant-numeric: tabular-nums;
      text-decoration: none !important;
      transition: opacity 150ms ease;
    }
    .contact-link:hover {
      opacity: 0.85;
    }
    .badge-ttd-ready {
      background: var(--ibk-success-soft);
      color: var(--ibk-success-text);
      border: 1px solid var(--ibk-success-border);
      font-size: 11.5px;
      font-weight: 600;
      padding: 3px 9px;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      text-decoration: none !important;
      white-space: nowrap;
    }
    .badge-ttd-missing {
      background: var(--ibk-warning-soft);
      color: var(--ibk-warning-text);
      border: 1px solid var(--ibk-warning-border);
      font-size: 11.5px;
      font-weight: 600;
      padding: 3px 9px;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      white-space: nowrap;
    }

    /* Status Badges */
    .badge-status-aktif {
      background: var(--ibk-success-soft);
      color: var(--ibk-success-text);
      border: 1px solid var(--ibk-success-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;
    }
    .badge-status-aktif .status-dot {
      width: 6px; height: 6px; border-radius: 50%; background-color: var(--ibk-success);
    }
    .badge-status-nonaktif {
      background: var(--ibk-danger-soft);
      color: var(--ibk-danger-text);
      border: 1px solid var(--ibk-danger-border);
      font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 9999px;
      display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;
    }
    .badge-status-nonaktif .status-dot {
      width: 6px; height: 6px; border-radius: 50%; background-color: var(--ibk-danger);
    }

    /* Action Buttons */
    .btn-action-edit {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: var(--ibk-warning-soft) !important;
      border: 1px solid var(--ibk-warning-border) !important;
      color: var(--ibk-warning-text) !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
      cursor: pointer;
      text-decoration: none !important;
    }
    .btn-action-edit:hover {
      background: #D97706 !important;
      color: #FFFFFF !important;
      border-color: #D97706 !important;
    }
    .btn-action-toggle {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
      cursor: pointer;
      text-decoration: none !important;
    }
    .btn-action-deactivate {
      background: var(--ibk-danger-soft) !important;
      border: 1px solid var(--ibk-danger-border) !important;
      color: var(--ibk-danger-text) !important;
    }
    .btn-action-deactivate:hover {
      background: #DC2626 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
    }
    .btn-action-activate {
      background: var(--ibk-success-soft) !important;
      border: 1px solid var(--ibk-success-border) !important;
      color: var(--ibk-success-text) !important;
    }
    .btn-action-activate:hover {
      background: #059669 !important;
      color: #FFFFFF !important;
      border-color: #059669 !important;
    }

    /* DataTables Controls & Invoice-Standard Footer Pagination */
    .dataTables_wrapper {
      color: var(--ibk-text-muted) !important;
      padding: 0 !important;
      width: 100% !important;
    }
    .dataTables_wrapper > .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
    }
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      margin: 0 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      color: var(--ibk-text-muted) !important;
    }
    .dataTables_wrapper .dataTables_length select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 4px 28px 4px 10px !important;
      font-size: 13px !important;
      height: 36px !important;
      cursor: pointer;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 8px center !important;
      background-size: 12px 9px !important;
      -webkit-appearance: none !important;
      appearance: none !important;
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
      width: 240px !important;
      max-width: 100% !important;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      outline: none !important;
    }

    .ibk-table-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      padding: 16px 24px;
      background: var(--ibk-surface);
    }
    #tokabeCustomInfo,
    #tokabeCustomInfo .dataTables_info {
      font-size: 13px !important;
      font-weight: 500 !important;
      color: var(--ibk-text-muted) !important;
      padding: 0 !important;
      margin: 0 !important;
    }
    #tokabeCustomPaginate,
    #tokabeCustomPaginate .dataTables_paginate {
      display: flex !important;
      align-items: center !important;
      justify-content: flex-end !important;
      margin: 0 !important;
      padding: 0 !important;
    }
    #tokabeCustomPaginate ul.pagination,
    .dataTables_paginate ul.pagination {
      display: inline-flex !important;
      align-items: center !important;
      gap: 4px !important;
      margin: 0 !important;
      padding: 4px !important;
      background: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      border-radius: 12px !important;
      box-shadow: var(--ibk-card-shadow) !important;
    }
    .dataTables_paginate ul.pagination li.page-item .page-link {
      min-width: 34px !important;
      height: 34px !important;
      padding: 0 10px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      border-radius: 8px !important;
      border: 1px solid transparent !important;
      background: transparent !important;
      color: var(--ibk-text-muted) !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      font-variant-numeric: tabular-nums;
      box-shadow: none !important;
      transition: all 0.15s ease !important;
    }
    .dataTables_paginate ul.pagination li.page-item:not(.active):not(.disabled) .page-link:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-border) !important;
    }
    .dataTables_paginate ul.pagination li.page-item.active .page-link {
      background: var(--ibk-brand-btn-bg, #EA580C) !important;
      border-color: var(--ibk-brand-btn-bg, #EA580C) !important;
      color: var(--ibk-brand-btn-text, #FFFFFF) !important;
      font-weight: 600 !important;
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.28) !important;
    }
    .dataTables_paginate ul.pagination li.page-item.disabled .page-link {
      opacity: 0.4 !important;
      background: transparent !important;
      border-color: transparent !important;
      color: var(--ibk-text-dim) !important;
      cursor: not-allowed !important;
    }

    /* Dual-Theme Modal Styles */
    .modal-content.tokabe-modal {
      background-color: var(--ibk-modal-bg) !important;
      border: 1px solid var(--ibk-modal-border) !important;
      border-radius: 14px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45) !important;
      overflow: hidden;
      color: var(--ibk-text);
    }
    .tokabe-modal-header {
      border-bottom: 1px solid var(--ibk-modal-border) !important;
      padding: 16px 22px !important;
      background-color: var(--ibk-modal-header-bg) !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
    .tokabe-modal-title {
      font-size: 15.5px;
      font-weight: 700;
      color: var(--ibk-text);
      margin: 0;
    }
    .tokabe-modal-subtitle {
      font-size: 12px;
      color: var(--ibk-text-muted);
    }
    html:not(.theme-light) .tokabe-modal .btn-close {
      filter: invert(1) grayscale(100%) brightness(200%);
    }
    .tokabe-modal-body {
      padding: 20px 22px !important;
      background-color: var(--ibk-modal-bg) !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid var(--ibk-modal-border) !important;
      padding: 14px 22px !important;
      background-color: var(--ibk-modal-header-bg) !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }
    .form-label-modern {
      font-size: 13px;
      font-weight: 600;
      color: var(--ibk-text);
      margin-bottom: 6px;
      display: block;
    }
    .form-label-modern .required-star {
      color: var(--ibk-danger);
      margin-left: 2px;
    }
    .form-control-modern,
    .form-select-modern {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      height: 40px !important;
      font-size: 13.5px !important;
      padding: 8px 12px !important;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .form-select-modern {
      padding-right: 32px !important;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 10px center !important;
      background-size: 14px 10px !important;
    }
    .form-control-modern::placeholder {
      color: var(--ibk-text-dim) !important;
    }
    .form-control-modern:focus,
    .form-select-modern:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      color: var(--ibk-text) !important;
      outline: none !important;
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
    .ttd-upload-box {
      padding: 14px;
      border-radius: 10px;
      background: var(--ibk-surface-hover);
      border: 1px dashed var(--ibk-border);
    }
    .ttd-preview-box {
      padding: 8px;
      border-radius: 8px;
      background: var(--ibk-surface);
      border: 1px solid var(--ibk-border);
      width: 100%;
      min-height: 52px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .btn-tokabe-modal-cancel {
      background-color: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      font-weight: 600 !important;
      font-size: 13px !important;
      border-radius: 8px !important;
      height: 38px !important;
      padding: 0 16px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer;
      transition: background-color 150ms ease, color 150ms ease !important;
    }
    .btn-tokabe-modal-cancel:hover {
      background-color: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
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
@php
  $aktifCount = $users->where('status', 'Aktif')->count();
  $nonAktifCount = $users->where('status', '!=', 'Aktif')->count();
@endphp

<div class="page-content">
  <div class="container-fluid">
    <div class="user-page-wrapper">

      <!-- 1. Header & Actions -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-team-line" aria-hidden="true"></i>
            <span>Daftar Karyawan</span>
          </h1>
          <div class="ibk-page-subtitle">Kelola akun pengguna, hak akses role, tanda tangan digital, dan status aktif staf</div>
        </div>
        <div class="ibk-header-actions">
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon" aria-hidden="true"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          <button type="button" class="ibk-btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKaryawan">
            <i class="ri-user-add-line fs-16" aria-hidden="true"></i>
            <span>Tambah Karyawan</span>
          </button>
        </div>
      </div>

      <!-- Feedback Alerts -->
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: var(--ibk-success-soft); border: 1px solid var(--ibk-success-border); color: var(--ibk-success-text); border-radius: 10px;">
          <i class="ri-checkbox-circle-fill fs-18" aria-hidden="true"></i>
          <div class="flex-grow-1 fs-13 fw-medium">{{ session('success') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif
      @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="background: var(--ibk-danger-soft); border: 1px solid var(--ibk-danger-border); color: var(--ibk-danger-text); border-radius: 10px;">
          <i class="ri-error-warning-fill fs-18" aria-hidden="true"></i>
          <div class="flex-grow-1 fs-13 fw-medium">{{ session('error') }}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
      @endif

      <!-- 2. 3 Compact KPI Summary Cards -->
      <div class="ibk-kpi-grid">
        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Total Karyawan</div>
            <div class="ibk-kpi-value">{{ count($users) }}</div>
          </div>
          <span class="ibk-kpi-icon" aria-hidden="true">
            <i class="ri-group-line"></i>
          </span>
        </div>

        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Staf Aktif</div>
            <div class="ibk-kpi-value">{{ $aktifCount }}</div>
          </div>
          <span class="ibk-kpi-icon ibk-kpi-icon--success" aria-hidden="true">
            <i class="ri-user-follow-line"></i>
          </span>
        </div>

        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Non Aktif</div>
            <div class="ibk-kpi-value">{{ $nonAktifCount }}</div>
          </div>
          <span class="ibk-kpi-icon ibk-kpi-icon--danger" aria-hidden="true">
            <i class="ri-user-unfollow-line"></i>
          </span>
        </div>
      </div>

      <!-- 3. Main Section Card -->
      <div class="ibk-card">
        <div class="ibk-card-header">
          <div class="ibk-card-heading">
            <h2 class="ibk-card-title">
              <i class="ri-contacts-book-line" aria-hidden="true"></i>
              <span>Data Karyawan &amp; Hak Akses</span>
            </h2>
            <span class="badge-count-pill">{{ count($users) }} Personil</span>
          </div>
        </div>

        <div class="card-body p-0">
          <table id="table-user" class="table align-middle tokabe-table w-100">
            <thead>
              <tr>
                <th class="text-center" style="width: 60px;">No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th class="text-center">Role</th>
                <th>Nomor Telepon</th>
                <th class="text-center">Tanda Tangan</th>
                <th class="text-center">Status</th>
                <th class="text-center" style="width: 110px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                @php
                  $rawTel = trim((string) ($user->nomor_telepon ?? ''));
                  $hasTel = $rawTel !== '' && !preg_match('/^[\-\s]+$/', $rawTel);
                @endphp
                <tr>
                  <td class="text-center" style="color: var(--ibk-text-muted); font-variant-numeric: tabular-nums; font-weight: 500;">{{ $loop->iteration }}</td>
                  <td>
                    <div class="user-cell">
                      <span class="user-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(trim((string) $user->nama), 0, 1)) }}</span>
                      <span class="fw-semibold" style="color: var(--ibk-text);">{{ $user->nama }}</span>
                    </div>
                  </td>
                  <td>
                    <a href="mailto:{{ $user->email }}" class="user-email-link">
                      <i class="ri-mail-line" aria-hidden="true"></i>
                      <span>{{ $user->email }}</span>
                    </a>
                  </td>
                  <td class="text-center">
                    @if ($user->role == "Pemilik")
                      <span class="badge-role-pemilik">
                        <i class="ri-vip-crown-line" aria-hidden="true"></i>
                        <span>{{ $user->role }}</span>
                      </span>
                    @elseif($user->role == "Admin")
                      <span class="badge-role-admin">
                        <i class="ri-shield-user-line" aria-hidden="true"></i>
                        <span>{{ $user->role }}</span>
                      </span>
                    @elseif($user->role == "Magang")
                      <span class="badge-role-magang">
                        <i class="ri-graduation-cap-line" aria-hidden="true"></i>
                        <span>{{ $user->role }}</span>
                      </span>
                    @else
                      <span class="badge-role-default">
                        <i class="ri-user-line" aria-hidden="true"></i>
                        <span>{{ $user->role }}</span>
                      </span>
                    @endif
                  </td>
                  <td>
                    @if($hasTel)
                      <a href="tel:{{ $rawTel }}" class="contact-link" title="Hubungi {{ $user->nama }}">
                        <i class="ri-phone-line" aria-hidden="true"></i>
                        <span>{{ $rawTel }}</span>
                      </a>
                    @else
                      <span style="color: var(--ibk-text-dim);">-</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($user->tanda_tangan_url)
                      <a href="{{ $user->tanda_tangan_url }}" target="_blank" class="badge-ttd-ready" title="Lihat Tanda Tangan {{ $user->nama }}">
                        <i class="ri-quill-pen-line" aria-hidden="true"></i>
                        <span>Ada TTD</span>
                      </a>
                    @else
                      @if ($user->role == 'Admin')
                        <span class="badge-ttd-missing" title="Admin belum mengunggah tanda tangan digital">
                          <i class="ri-alert-line" aria-hidden="true"></i>
                          <span>Belum Ada</span>
                        </span>
                      @else
                        <span style="color: var(--ibk-text-dim);">-</span>
                      @endif
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($user->status == 'Aktif')
                      <span class="badge-status-aktif">
                        <span class="status-dot" aria-hidden="true"></span>
                        <span>Aktif</span>
                      </span>
                    @else
                      <span class="badge-status-nonaktif">
                        <span class="status-dot" aria-hidden="true"></span>
                        <span>Non Aktif</span>
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                      <a href="{{ route('user.edit', $user->id) }}" class="btn-action-edit" title="Edit Karyawan {{ $user->nama }}" aria-label="Edit Karyawan {{ $user->nama }}">
                        <i class="ri-pencil-line" aria-hidden="true"></i>
                      </a>

                      @if ($user->status == 'Aktif')
                        <a href="{{ route('user.status', $user->id) }}" class="btn-action-toggle btn-action-deactivate" title="Nonaktifkan akun {{ $user->nama }}" aria-label="Nonaktifkan akun {{ $user->nama }}">
                          <i class="ri-user-unfollow-line" aria-hidden="true"></i>
                        </a>
                      @else
                        <a href="{{ route('user.status', $user->id) }}" class="btn-action-toggle btn-action-activate" title="Aktifkan kembali akun {{ $user->nama }}" aria-label="Aktifkan kembali akun {{ $user->nama }}">
                          <i class="ri-user-follow-line" aria-hidden="true"></i>
                        </a>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Table Footer matching Invoice standard -->
          <div class="ibk-table-footer">
            <div id="tokabeCustomInfo"></div>
            <div id="tokabeCustomPaginate"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- MODAL POPUP: TAMBAH KARYAWAN --}}
<div class="modal fade" id="modalTambahKaryawan" tabindex="-1" aria-labelledby="modalTambahKaryawanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content tokabe-modal">
      <div class="tokabe-modal-header">
        <div class="d-flex align-items-center gap-3">
          <div class="tokabe-modal-icon" aria-hidden="true">
            <i class="ri-user-add-line"></i>
          </div>
          <div>
            <h5 class="tokabe-modal-title" id="modalTambahKaryawanLabel">Tambah Karyawan Baru</h5>
            <span class="tokabe-modal-subtitle">Registrasi akun baru untuk karyawan atau staf internal sistem</span>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form method="POST" action="{{ route('user.store') }}" id="formTambahKaryawan" class="needs-validation" enctype="multipart/form-data">
        @csrf
        <div class="tokabe-modal-body">
          <div class="mb-3">
            <label class="form-label-modern" for="inputNamaKaryawan">
              Nama Lengkap <span class="required-star">*</span>
            </label>
            <input type="text" class="form-control form-control-modern" id="inputNamaKaryawan" placeholder="Nama Lengkap Karyawan" name="namaKaryawan" value="{{ old('namaKaryawan') }}" required autocomplete="off">
            @error('namaKaryawan')
              <span class="error-help-block">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label-modern" for="inputEmailKaryawan">
              Email Karyawan <span class="required-star">*</span>
            </label>
            <input type="email" class="form-control form-control-modern" id="inputEmailKaryawan" name="email" placeholder="contoh: nama@tokabe.com" value="{{ old('email') }}" required autocomplete="off">
            @error('email')
              <span class="error-help-block">{{ $message }}</span>
            @enderror
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-modern" for="password-input">
                Password <span class="required-star">*</span>
              </label>
              <div class="auth-pass-inputgroup position-relative">
                <input type="password" class="form-control form-control-modern password-input" id="password-input" name="password" placeholder="Minimal 5 karakter" required autocomplete="new-password">
                <button class="password-addon" type="button" aria-label="Lihat Password">
                  <i class="ri-eye-line" aria-hidden="true"></i>
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
                  <i class="ri-eye-line" aria-hidden="true"></i>
                </button>
              </div>
              @error('re_password')
                <span class="error-help-block">{{ $message }}</span>
              @enderror
            </div>
          </div>

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

          <div class="ttd-upload-box mb-1">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <label class="form-label-modern mb-0" for="input-tanda-tangan-modal">
                <i class="ri-quill-pen-line me-1" style="color: var(--ibk-brand);" aria-hidden="true"></i>Tanda Tangan Digital (Khusus Admin)
              </label>
              <span class="badge-count-pill">Otomatis pada Invoice Lunas</span>
            </div>
            <p class="fs-11 mb-2" style="color: var(--ibk-text-muted);">Unggah file PNG transparan (maks. 2MB). Opsional, dapat diunggah nanti.</p>
            <div class="row align-items-center g-2">
              <div class="col-sm-4 text-center">
                <div class="ttd-preview-box">
                  <img src="" id="preview-ttd-modal" alt="Preview TTD" style="max-height: 45px; max-width: 120px; object-fit: contain; display: none;">
                  <span id="no-ttd-placeholder-modal" class="fs-11" style="color: var(--ibk-text-dim);">
                    <i class="ri-image-line me-1" aria-hidden="true"></i>Belum ada file
                  </span>
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
          <button type="button" class="btn-tokabe-modal-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16" aria-hidden="true"></i>
            <span>Batal</span>
          </button>
          <button type="submit" id="simpan" class="ibk-btn-primary">
            <i class="ri-save-3-line fs-16" aria-hidden="true"></i>
            <span>Simpan Karyawan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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

  function previewTandaTanganModal(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview-ttd-modal').attr('src', e.target.result).show();
        $('#no-ttd-placeholder-modal').hide();
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  @if($errors->any())
    $(document).ready(function () {
      var addModal = new bootstrap.Modal(document.getElementById('modalTambahKaryawan'));
      addModal.show();
    });
  @endif

  $(document).ready(function () {
    initPageTheme();

    $('#formTambahKaryawan').on('submit', function (e) {
      var pass = $('#password-input').val();
      var rePass = $('#re-password-input').val();
      if (pass !== rePass) {
        e.preventDefault();
        var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'error',
            title: 'Password Tidak Cocok',
            text: 'Password dan konfirmasi password tidak sama.',
            confirmButtonColor: '#EA580C',
            background: isLight ? '#FFFFFF' : '#181412',
            color: isLight ? '#1C1917' : '#F5F5F4'
          });
        } else {
          alert('Password dan konfirmasi password tidak sama!');
        }
        $('#re-password-input').focus();
        return false;
      }
    });

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
      wrapper.children('.row:last-child').each(function () {
        if ($(this).find('.dataTables_info, .dataTables_paginate').length === 0) {
          $(this).hide();
        }
      });
    }

    if ($.fn.DataTable.isDataTable('#table-user')) {
      $('#table-user').DataTable().destroy();
    }
    $('#table-user').DataTable({
      paging: true,
      pageLength: 25,
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      ordering: true,
      order: [],
      autoWidth: false,
      scrollX: false,
      deferRender: true,
      orderClasses: false,
      dom: "<'row p-3 pb-2 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-md-end'f>>" +
           "<'table-responsive'tr>" +
           "<'row d-none'<'col-sm-6'i><'col-sm-6'p>>",
      drawCallback: function () {
        syncCustomFooter('#table-user');
      },
      language: {
        search: "",
        searchPlaceholder: "Cari nama / email / role...",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ personil",
        infoEmpty: "Tidak ada data karyawan",
        infoFiltered: "(disaring dari _MAX_ total personil)",
        emptyTable: "Belum ada karyawan terdaftar.",
        zeroRecords: "Tidak ada karyawan yang cocok dengan pencarian.",
        paginate: {
          first: '<i class="ri-skip-back-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>',
          next: '<i class="ri-arrow-right-s-line"></i>',
          last: '<i class="ri-skip-forward-line"></i>'
        }
      }
    });

    setTimeout(function () { syncCustomFooter('#table-user'); }, 50);
    setTimeout(function () { syncCustomFooter('#table-user'); }, 200);
  });
</script>
@endsection
