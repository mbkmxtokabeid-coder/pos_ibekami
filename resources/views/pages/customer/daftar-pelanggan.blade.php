@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

  <style>
    /* ==========================================================================
       TOKABE DAFTAR PELANGGAN — WARM STONE DUAL-THEME SYSTEM
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

      --ibk-input-bg: #1C1917;
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #F5F5F4;
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23A8A29E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #181412;
      --ibk-th-text: #A8A29E;
      --ibk-td-border: rgba(255, 255, 255, 0.06);

      --ibk-pdf-bg: rgba(239, 68, 68, 0.14);
      --ibk-pdf-text: #FCA5A5;
      --ibk-pdf-border: rgba(239, 68, 68, 0.35);

      --ibk-excel-bg: rgba(16, 185, 129, 0.14);
      --ibk-excel-text: #6EE7B7;
      --ibk-excel-border: rgba(16, 185, 129, 0.35);

      --ibk-contact-bg: rgba(16, 185, 129, 0.12);
      --ibk-contact-border: rgba(16, 185, 129, 0.28);
      --ibk-contact-text: #6EE7B7;
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

      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #D6D0C4;
      --ibk-input-text: #1C1917;
      --ibk-select-arrow: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2357534E' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");

      --ibk-th-bg: #F3EFE6;
      --ibk-th-text: #57534E;
      --ibk-td-border: #EAE4DC;

      --ibk-pdf-bg: #FEF2F2;
      --ibk-pdf-text: #B91C1C;
      --ibk-pdf-border: #FECACA;

      --ibk-excel-bg: #ECFDF5;
      --ibk-excel-text: #047857;
      --ibk-excel-border: #A7F3D0;

      --ibk-contact-bg: #ECFDF5;
      --ibk-contact-border: #A7F3D0;
      --ibk-contact-text: #047857;
    }

    .customer-page-wrapper {
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

    /* 3-Tab Report Switcher */
    .ibk-tab-switch {
      position: relative;
      display: inline-flex;
      align-items: center;
      padding: 3px;
      border-radius: 10px;
      background: var(--ibk-surface);
      border: 1px solid var(--ibk-border);
      gap: 2px;
    }
    .ibk-tab-glider {
      position: absolute;
      top: 3px;
      bottom: 3px;
      left: 0;
      border-radius: 7px;
      background: var(--ibk-brand);
      box-shadow: 0 2px 8px rgba(234, 88, 12, 0.28);
      pointer-events: none;
      z-index: 0;
      opacity: 0;
      will-change: transform, width;
    }
    .ibk-tab-glider.is-animated {
      transition: transform 320ms cubic-bezier(0.22, 1, 0.36, 1), width 320ms cubic-bezier(0.22, 1, 0.36, 1), opacity 160ms ease;
    }
    .ibk-tab-link {
      position: relative;
      z-index: 1;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 7px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--ibk-text-muted);
      text-decoration: none !important;
      transition: color 220ms ease, background-color 180ms ease;
      white-space: nowrap;
    }
    .ibk-tab-link:hover {
      background: var(--ibk-surface-hover);
      color: var(--ibk-text);
    }
    .ibk-tab-link.is-active {
      background: var(--ibk-brand);
      color: #FFFFFF;
    }
    .ibk-tab-switch.has-glider .ibk-tab-link.is-active,
    .ibk-tab-switch.has-glider .ibk-tab-link.is-active:hover {
      background: transparent;
      color: #FFFFFF;
    }
    .ibk-tab-stage {
      transition: opacity 220ms cubic-bezier(0.22, 1, 0.36, 1), transform 220ms cubic-bezier(0.22, 1, 0.36, 1);
      will-change: opacity, transform;
    }
    .ibk-tab-stage.is-entering {
      opacity: 0;
      transform: translateY(8px);
    }
    .ibk-tab-stage.is-leaving {
      opacity: 0;
      transform: translateY(-6px);
    }
    @media (prefers-reduced-motion: reduce) {
      .ibk-tab-glider.is-animated,
      .ibk-tab-stage {
        transition: none !important;
      }
    }
    .ibk-tab-link:focus-visible,
    .ref-theme-toggle:focus-visible,
    .btn-ibk-filter:focus-visible,
    .btn-ibk-reset:focus-visible,
    .btn-report-pdf:focus-visible,
    .btn-report-excel:focus-visible,
    .contact-link:focus-visible {
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
      word-break: break-word;
    }
    .ibk-kpi-value--sm {
      font-size: 16px;
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

    /* Filter Toolbar Strip (Single-Row Unified Toolbar) */
    .ibk-filter-bar {
      padding: 14px 24px;
      background: var(--ibk-surface-hover);
      border-bottom: 1px solid var(--ibk-border);
    }
    .ibk-toolbar-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .ibk-toolbar-left {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      flex: 1;
      min-width: 0;
    }
    .ibk-toolbar-right {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: auto;
      flex-shrink: 0;
    }
    .ibk-toolbar-divider {
      width: 1px;
      height: 24px;
      background: var(--ibk-border);
      flex-shrink: 0;
    }
    .ibk-search-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }
    .ibk-search-wrap i {
      position: absolute;
      left: 11px;
      color: var(--ibk-text-dim);
      font-size: 15px;
      pointer-events: none;
    }
    .customer-page-wrapper .ibk-search-input {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 12px 6px 34px !important;
      font-size: 13px !important;
      height: 36px !important;
      width: 260px !important;
      min-width: 240px;
      max-width: 100%;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .customer-page-wrapper .ibk-search-input::placeholder {
      color: var(--ibk-text-dim) !important;
    }
    .customer-page-wrapper .ibk-search-input:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      outline: none !important;
    }
    .ibk-filter-label {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--ibk-text-muted);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }
    .ibk-filter-label i {
      color: var(--ibk-brand);
      font-size: 15px;
    }
    .customer-page-wrapper .form-select {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      padding: 6px 32px 6px 12px !important;
      font-size: 13px !important;
      height: 36px !important;
      background-image: var(--ibk-select-arrow) !important;
      background-repeat: no-repeat !important;
      background-position: right 10px center !important;
      background-size: 14px 10px !important;
      transition: border-color 150ms ease, box-shadow 150ms ease;
    }
    .customer-page-wrapper .ibk-category-select {
      width: auto !important;
      min-width: 200px;
      max-width: 260px;
    }
    .ibk-length-label {
      font-size: 12.5px;
      font-weight: 500;
      color: var(--ibk-text-muted);
      white-space: nowrap;
    }
    .customer-page-wrapper .ibk-length-select {
      width: auto !important;
      min-width: 72px;
      padding-right: 28px !important;
      background-position: right 8px center !important;
    }
    @media (max-width: 991.98px) {
      .ibk-toolbar-divider {
        display: none;
      }
    }
    @media (max-width: 575.98px) {
      .ibk-search-wrap,
      .customer-page-wrapper .ibk-search-input,
      .customer-page-wrapper .ibk-category-select {
        width: 100% !important;
        min-width: 0;
        max-width: 100%;
      }
    }
    .customer-page-wrapper .form-select:focus {
      border-color: var(--ibk-brand) !important;
      box-shadow: 0 0 0 3px var(--ibk-brand-soft) !important;
      outline: none !important;
    }

    .btn-ibk-filter {
      background-color: var(--ibk-brand-btn-bg) !important;
      border: 1px solid var(--ibk-brand-btn-bg) !important;
      color: var(--ibk-brand-btn-text) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 14px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      cursor: pointer;
      transition: background-color 150ms ease;
      white-space: nowrap;
    }
    .btn-ibk-filter:hover {
      background-color: var(--ibk-brand-hover) !important;
      border-color: var(--ibk-brand-hover) !important;
    }
    .btn-ibk-reset {
      background-color: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text-muted) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 12px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 5px !important;
      text-decoration: none !important;
      transition: background-color 150ms ease, color 150ms ease;
      white-space: nowrap;
    }
    .btn-ibk-reset:hover {
      background-color: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
    }

    .ibk-active-filter-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 9999px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand-text);
      font-size: 12px;
      font-weight: 600;
    }

    /* Export Buttons */
    .btn-report-pdf {
      background-color: var(--ibk-pdf-bg) !important;
      color: var(--ibk-pdf-text) !important;
      border: 1px solid var(--ibk-pdf-border) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 14px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease !important;
      cursor: pointer;
      white-space: nowrap;
    }
    .btn-report-pdf:hover {
      background-color: #DC2626 !important;
      color: #FFFFFF !important;
      border-color: #DC2626 !important;
    }
    .btn-report-excel {
      background-color: var(--ibk-excel-bg) !important;
      color: var(--ibk-excel-text) !important;
      border: 1px solid var(--ibk-excel-border) !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      border-radius: 8px !important;
      height: 36px !important;
      padding: 0 14px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease !important;
      cursor: pointer;
      white-space: nowrap;
    }
    .btn-report-excel:hover {
      background-color: #059669 !important;
      color: #FFFFFF !important;
      border-color: #059669 !important;
    }

    /* Responsive Table & Scrollbar */
    .table-responsive {
      width: 100% !important;
      display: block !important;
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
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

    #table-pelanggan {
      min-width: 920px !important;
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
      height: 58px !important;
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

    /* Customer Avatar, Category Badge & Contact Link */
    .customer-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .customer-avatar {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: var(--ibk-brand-soft);
      border: 1px solid var(--ibk-brand-border);
      color: var(--ibk-brand-text);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 12.5px;
      font-weight: 700;
      flex-shrink: 0;
    }
    .customer-name {
      font-weight: 600;
      color: var(--ibk-text);
    }

    .badge-invoice-cat {
      background: var(--ibk-brand-soft);
      color: var(--ibk-brand-text);
      border: 1px solid var(--ibk-brand-border);
      font-weight: 600;
      font-size: 12px;
      padding: 3px 10px;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      white-space: nowrap;
    }

    .contact-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 6px;
      background: var(--ibk-contact-bg);
      border: 1px solid var(--ibk-contact-border);
      color: var(--ibk-contact-text) !important;
      font-size: 12.5px;
      font-weight: 600;
      font-variant-numeric: tabular-nums;
      text-decoration: none !important;
      transition: opacity 150ms ease;
    }
    .contact-link:hover {
      opacity: 0.85;
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
  </style>
@endsection

@extends('layout.template')

@section('content')
@php
  $invoiceMap = $invoices->keyBy('id');
  $activeCategoryName = $selectedInvoice ? optional($invoiceMap->get($selectedInvoice))->nama_invoice : null;
  $instansiCount = $customers->filter(function ($c) {
      $val = trim((string) ($c->perusahaan ?? ''));
      return $val !== '' && !preg_match('/^[\-\s]+$/', $val);
  })->count();
@endphp

<div class="page-content">
  <div class="container-fluid">
    <div class="customer-page-wrapper">

      <!-- 1. Header & Controls -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>
            <i class="ri-user-shared-line" aria-hidden="true"></i>
            <span>Laporan Daftar Pelanggan</span>
          </h1>
          <div class="ibk-page-subtitle">Rekapitulasi kontak pelanggan dan perusahaan berdasarkan kategori invoice</div>
        </div>
        <div class="ibk-header-actions">
          <div class="ibk-tab-switch" role="navigation" aria-label="Jenis Laporan">
            <span class="ibk-tab-glider" aria-hidden="true"></span>
            <a href="{{ url('/daftar-laporan') }}" class="ibk-tab-link">
              <i class="ri-file-chart-line" aria-hidden="true"></i>
              <span>Penjualan</span>
            </a>
            <a href="{{ url('/daftar-laporanPembelian') }}" class="ibk-tab-link">
              <i class="ri-shopping-cart-2-line" aria-hidden="true"></i>
              <span>Pembelian</span>
            </a>
            <a href="{{ route('daftar.pelanggan') }}" class="ibk-tab-link is-active" aria-current="page">
              <i class="ri-user-shared-line" aria-hidden="true"></i>
              <span>Pelanggan</span>
            </a>
          </div>
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon" aria-hidden="true"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
        </div>
      </div>

      <div class="ibk-tab-stage" id="ibkTabStage">
        <script>try{if(sessionStorage.getItem('ibk_laporan_tab_leaving')==='1'){document.getElementById('ibkTabStage').classList.add('is-entering');}}catch(e){}</script>
        <!-- 2. 3 Compact KPI Summary Cards -->
      <div class="ibk-kpi-grid">
        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Total Pelanggan</div>
            <div class="ibk-kpi-value">{{ number_format($customers->count(), 0, ',', '.') }}</div>
          </div>
          <span class="ibk-kpi-icon" aria-hidden="true">
            <i class="ri-group-line"></i>
          </span>
        </div>

        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Instansi / Perusahaan</div>
            <div class="ibk-kpi-value">{{ number_format($instansiCount, 0, ',', '.') }}</div>
          </div>
          <span class="ibk-kpi-icon" aria-hidden="true">
            <i class="ri-building-2-line"></i>
          </span>
        </div>

        <div class="ibk-kpi-card">
          <div>
            <div class="ibk-kpi-label">Filter Kategori</div>
            <div class="ibk-kpi-value ibk-kpi-value--sm">{{ $activeCategoryName ?? 'Semua Kategori' }}</div>
          </div>
          <span class="ibk-kpi-icon" aria-hidden="true">
            <i class="ri-price-tag-3-line"></i>
          </span>
        </div>
      </div>

      <!-- 3. Main Customer Table Card -->
      <div class="ibk-card">

        <!-- Card Header & Export Actions -->
        <div class="ibk-card-header">
          <div class="ibk-card-heading">
            <h2 class="ibk-card-title">
              <i class="ri-contacts-book-2-line" aria-hidden="true"></i>
              <span>Daftar Pelanggan</span>
            </h2>
            <span class="badge-count-pill">{{ number_format($customers->count(), 0, ',', '.') }} Terdaftar</span>
          </div>

          <form action="{{ route('export.pelanggan') }}" method="POST" target="_blank" id="exportCustomerForm" class="d-flex flex-wrap align-items-center gap-2 m-0">
            @csrf
            <input type="hidden" name="invoice" id="exportInvoiceInput" value="{{ $selectedInvoice }}">
            <button class="btn-report-pdf" type="submit" name="export_type" value="pdf" title="Lihat / Cetak Laporan PDF">
              <i class="ri-file-pdf-line fs-16" aria-hidden="true"></i>
              <span>Lihat PDF</span>
            </button>
            <button class="btn-report-excel" type="submit" name="export_type" value="excel" title="Unduh Spreadsheet Excel">
              <i class="ri-file-excel-2-line fs-16" aria-hidden="true"></i>
              <span>Unduh Excel</span>
            </button>
          </form>
        </div>

        <!-- Unified Single-Row Toolbar: Search + Category Filter + Entries -->
        <div class="ibk-filter-bar">
          <div class="ibk-toolbar-row">
            <div class="ibk-toolbar-left">
              <div class="ibk-search-wrap">
                <i class="ri-search-line" aria-hidden="true"></i>
                <input type="search" id="customSearchPelanggan" class="form-control ibk-search-input" placeholder="Cari pelanggan, perusahaan, kontak..." aria-label="Cari pelanggan">
              </div>

              <span class="ibk-toolbar-divider" aria-hidden="true"></span>

              <form action="{{ route('daftar.pelanggan') }}" method="GET" class="d-flex align-items-center flex-wrap gap-2 m-0">
                <label class="ibk-filter-label m-0" for="invoiceDropdown">
                  <i class="ri-filter-3-line" aria-hidden="true"></i>
                  <span>Kategori:</span>
                </label>
                <select name="invoice" class="form-select ibk-category-select" id="invoiceDropdown" aria-label="Pilih Kategori Invoice">
                  <option value="">Semua Kategori Invoice</option>
                  @foreach ($invoices as $invoice)
                    <option value="{{ $invoice->id }}" {{ $invoice->id == $selectedInvoice ? 'selected' : '' }}>
                      {{ $invoice->nama_invoice }}
                    </option>
                  @endforeach
                </select>
                <button type="submit" class="btn-ibk-filter" title="Terapkan Filter Kategori">
                  <i class="ri-filter-line fs-14" aria-hidden="true"></i>
                  <span>Filter</span>
                </button>
                @if($selectedInvoice)
                  <a href="{{ route('daftar.pelanggan') }}" class="btn-ibk-reset" title="Tampilkan Semua Kategori">
                    <i class="ri-close-line fs-15" aria-hidden="true"></i>
                    <span>Reset</span>
                  </a>
                @endif
              </form>
            </div>

            <div class="ibk-toolbar-right">
              <label class="ibk-length-label m-0" for="customLengthPelanggan">Tampilkan</label>
              <select id="customLengthPelanggan" class="form-select ibk-length-select" aria-label="Jumlah entri per halaman">
                <option value="10">10</option>
                <option value="25" selected>25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
              <span class="ibk-length-label">entri</span>
            </div>
          </div>
        </div>

        <!-- Table & Custom Footer -->
        <div class="card-body p-0">
          <table id="table-pelanggan" class="table align-middle tokabe-table w-100">
            <thead>
              <tr>
                <th class="text-center" style="width: 60px;">No.</th>
                <th>Customer</th>
                <th>Kategori Invoice</th>
                <th>Perusahaan</th>
                <th>No. Kontak</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customers as $cust)
                @php
                  $custName = trim((string) ($cust->customer ?? ''));
                  $initial = $custName !== '' ? mb_strtoupper(mb_substr($custName, 0, 1)) : 'P';
                  $catName = optional($invoiceMap->get($cust->invoice))->nama_invoice;
                  $rawPerusahaan = trim((string) ($cust->perusahaan ?? ''));
                  $hasPerusahaan = $rawPerusahaan !== '' && !preg_match('/^[\-\s]+$/', $rawPerusahaan);
                  $rawTel = trim((string) ($cust->no_telepon ?? ''));
                  $hasTel = $rawTel !== '' && !preg_match('/^[\-\s]+$/', $rawTel);
                @endphp
                <tr>
                  <td class="text-center" style="color: var(--ibk-text-muted); font-variant-numeric: tabular-nums; font-weight: 500;">{{ $loop->iteration }}</td>
                  <td>
                    <div class="customer-cell">
                      <span class="customer-avatar" aria-hidden="true">{{ $initial }}</span>
                      <span class="customer-name">{{ $custName !== '' ? $custName : '-' }}</span>
                    </div>
                  </td>
                  <td>
                    @if($catName)
                      <span class="badge-invoice-cat">
                        <i class="ri-file-list-3-line" aria-hidden="true"></i>
                        <span>{{ $catName }}</span>
                      </span>
                    @else
                      <span style="color: var(--ibk-text-dim);">-</span>
                    @endif
                  </td>
                  <td>
                    @if($hasPerusahaan)
                      <span style="color: var(--ibk-text); font-weight: 500;">{{ $rawPerusahaan }}</span>
                    @else
                      <span style="color: var(--ibk-text-dim);">-</span>
                    @endif
                  </td>
                  <td>
                    @if($hasTel)
                      <a href="tel:{{ $rawTel }}" class="contact-link" title="Hubungi {{ $custName !== '' ? $custName : 'Pelanggan' }}">
                        <i class="ri-phone-line" aria-hidden="true"></i>
                        <span>{{ $rawTel }}</span>
                      </a>
                    @else
                      <span style="color: var(--ibk-text-dim);">-</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Table Footer matching Invoice/Surat standard -->
          <div class="ibk-table-footer">
            <div id="tokabeCustomInfo"></div>
            <div id="tokabeCustomPaginate"></div>
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('plugins')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('js/halaman/laporan-tabs.js') }}"></script>
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

    var invoiceDropdown = document.getElementById('invoiceDropdown');
    var exportInvoiceInput = document.getElementById('exportInvoiceInput');
    if (invoiceDropdown && exportInvoiceInput) {
      invoiceDropdown.addEventListener('change', function() {
        exportInvoiceInput.value = this.value;
      });
    }

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

    if ($.fn.DataTable.isDataTable('#table-pelanggan')) {
      $('#table-pelanggan').DataTable().destroy();
    }
    var pelangganTable = $('#table-pelanggan').DataTable({
      paging: true,
      pageLength: 25,
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      ordering: true,
      order: [],
      autoWidth: false,
      scrollX: false,
      deferRender: true,
      orderClasses: false,
      dom: "<'table-responsive'tr>" +
           "<'row d-none'<'col-sm-6'i><'col-sm-6'p>>",
      drawCallback: function() {
        syncCustomFooter('#table-pelanggan');
      },
      language: {
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pelanggan",
        infoEmpty: "Tidak ada data pelanggan",
        infoFiltered: "(disaring dari _MAX_ total pelanggan)",
        emptyTable: "Belum ada data pelanggan untuk kategori ini.",
        zeroRecords: "Tidak ada pelanggan yang cocok dengan pencarian.",
        paginate: {
          first: '<i class="ri-skip-back-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>',
          next: '<i class="ri-arrow-right-s-line"></i>',
          last: '<i class="ri-skip-forward-line"></i>'
        }
      }
    });

    $('#customSearchPelanggan').on('input keyup search', function() {
      pelangganTable.search(this.value).draw();
    });

    $('#customLengthPelanggan').on('change', function() {
      pelangganTable.page.len(parseInt(this.value, 10)).draw();
    });

    setTimeout(function() { syncCustomFooter('#table-pelanggan'); }, 50);
    setTimeout(function() { syncCustomFooter('#table-pelanggan'); }, 200);
  });
</script>
@endsection
