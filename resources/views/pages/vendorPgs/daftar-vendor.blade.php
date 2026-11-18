@extends('layout.template')

@section('head')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

  <style>
    /* ==========================================================================
       TOKABE VENDOR PURCHASING — UNSLOPPED DESIGN SYSTEM (LIGHT & DARK)
       Consistent with Daftar Barang, Invoice, and Dashboard standards
       ========================================================================== */

    :root {
      /* Mode Gelap (Default) — Dashboard Identical Warm Stone (#14110F / #0C0A09) */
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

      /* Brand Accent — Golden Amber / Tokabe Orange */
      --ibk-brand: #F59E0B;
      --ibk-brand-deep: #EA580C;
      --ibk-brand-soft: rgba(245, 158, 11, 0.12);
      --ibk-brand-border: rgba(245, 158, 11, 0.24);
      --ibk-brand-text: #FBBF24;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      /* Semantics */
      --ibk-success: #10B981;
      --ibk-success-soft: rgba(16, 185, 129, 0.12);
      --ibk-success-border: rgba(16, 185, 129, 0.25);
      --ibk-danger: #EF4444;
      --ibk-danger-soft: rgba(239, 68, 68, 0.12);
      --ibk-danger-border: rgba(239, 68, 68, 0.25);

      /* Inputs & Dropdowns */
      --ibk-input-bg: rgba(255, 255, 255, 0.04);
      --ibk-input-border: rgba(255, 255, 255, 0.12);
      --ibk-input-text: #F1F5F9;
      --ibk-input-placeholder: #64748B;
      --ibk-popover-bg: #16161A;

      /* Table */
      --ibk-th-bg: #14110F;
      --ibk-th-text: #A1A1AA;
      --ibk-td-border: rgba(255, 255, 255, 0.08);

      /* Modals */
      --ibk-modal-bg: #16161A;
      --ibk-modal-border: #27272A;
      --ibk-modal-footer-bg: rgba(24, 24, 27, 0.5);
    }

    body.theme-light,
    html.theme-light,
    html[data-layout-mode="light"] {
      /* Mode Terang — Neutral Slate & Crisp Craft Surface */
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

      /* Brand Accent (Light) */
      --ibk-brand: #EA580C;
      --ibk-brand-deep: #C2410C;
      --ibk-brand-soft: #FFF7ED;
      --ibk-brand-border: #FED7AA;
      --ibk-brand-text: #EA580C;
      --ibk-brand-btn-bg: #EA580C;
      --ibk-brand-btn-text: #FFFFFF;

      /* Semantics (Light) */
      --ibk-success: #059669;
      --ibk-success-soft: #ECFDF5;
      --ibk-success-border: #A7F3D0;
      --ibk-danger: #DC2626;
      --ibk-danger-soft: #FEF2F2;
      --ibk-danger-border: #FECACA;

      /* Inputs & Dropdowns (Light) */
      --ibk-input-bg: #FFFFFF;
      --ibk-input-border: #CBD5E1;
      --ibk-input-text: #0F172A;
      --ibk-input-placeholder: #94A3B8;
      --ibk-popover-bg: #FFFFFF;

      /* Table (Light) */
      --ibk-th-bg: #F8FAFC;
      --ibk-th-text: #64748B;
      --ibk-td-border: #E2E8F0;

      /* Modals (Light) */
      --ibk-modal-bg: #FFFFFF;
      --ibk-modal-border: #E2E8F0;
      --ibk-modal-footer-bg: #F8FAFC;
    }

    /* Tabular Numerics without monospace jagged slop */
    .num, .numeric, input.numeric {
      font-variant-numeric: tabular-nums !important;
      font-feature-settings: "tnum" 1, "cv11" 1 !important;
    }

    /* Page Wrapper with safe bottom clearance */
    .vendor-page-wrapper {
      position: relative;
      width: 100%;
      min-height: calc(100vh - 120px);
      padding-bottom: 85px !important;
      margin-bottom: 24px !important;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      color: var(--ibk-text);
    }

    /* Header Section (Identik Daftar Barang & Invoices) */
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
    }
    .ibk-page-subtitle {
      font-size: 13px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
    }

    /* Primary Craft Action Button */
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
      transition: background-color 150ms ease, border-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
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
    .ibk-btn-primary:active {
      transform: scale(0.98) !important;
    }

    /* Theme Toggle Button (Identik Dashboard) */
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
    .ref-theme-toggle:active {
      transform: scale(0.97);
    }
    .ref-theme-toggle #theme-toggle-icon {
      display: inline-block;
      font-size: 15px;
      line-height: 1;
      transition: transform 380ms cubic-bezier(0.34, 1.56, 0.64, 1), opacity 200ms ease;
    }
    .ref-theme-toggle.theme-switching #theme-toggle-icon {
      transform: rotate(180deg) scale(0.65);
      opacity: 0.2;
    }

    /* KPI Summary Cards (Unslopped: Editorial Numbers & Tactile Hierarchy) */
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
    }
    .kpi-amount {
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -0.015em;
      line-height: 1.2;
      margin-bottom: 0;
      color: var(--ibk-text);
    }
    .kpi-icon-box {
      width: 40px;
      height: 40px;
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
    .icon-box-emerald {
      background-color: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
    }
    .icon-box-rose {
      background-color: var(--ibk-danger-soft);
      color: var(--ibk-danger);
      border: 1px solid var(--ibk-danger-border);
    }

    /* Table Section Card */
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
    .ibk-card-toolbar {
      padding: 14px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      border-bottom: 1px solid var(--ibk-border);
      background: transparent;
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
      background: var(--ibk-success-soft);
      color: var(--ibk-success);
      border: 1px solid var(--ibk-success-border);
      padding: 2px 8px;
      border-radius: 9999px;
      font-size: 11.5px;
      font-weight: 600;
    }

    /* Filters Bar Controls */
    .tokabe-search-wrapper {
      position: relative;
      width: 280px;
      max-width: 100%;
    }
    .tokabe-search-input {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      padding-left: 36px !important;
      padding-right: 32px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .tokabe-search-input::placeholder {
      color: var(--ibk-input-placeholder) !important;
    }
    .tokabe-search-input:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }
    .tokabe-search-icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: var(--ibk-text-muted);
      font-size: 14px;
      pointer-events: none;
    }
    .form-select-tokabe {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      height: 36px !important;
      padding: 6px 12px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-select-tokabe:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      outline: none !important;
    }
    .btn-reset-filter {
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-text-muted) !important;
      border-radius: 8px !important;
      width: 36px !important;
      height: 36px !important;
      padding: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 0.15s ease;
      cursor: pointer;
    }
    .btn-reset-filter:hover {
      background: var(--ibk-surface-hover) !important;
      color: var(--ibk-text) !important;
      border-color: var(--ibk-brand-border) !important;
    }

    /* Table Styles (Clean, Standard Tokabe Table) */
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
      padding: 12px 18px !important;
      vertical-align: middle;
      white-space: nowrap;
    }
    .tokabe-table tbody td {
      border-bottom: 1px solid var(--ibk-td-border) !important;
      padding: 13px 18px !important;
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

    /* Vendor Link & Sleek Progress Bar */
    .tokabe-vendor-link {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--ibk-text) !important;
      transition: color 150ms ease;
      text-decoration: none;
    }
    .tokabe-vendor-link:hover {
      color: #EA580C !important;
    }
    .vendor-progress-wrapper {
      max-width: 130px;
    }
    .vendor-progress-track {
      width: 100%;
      height: 4px;
      background-color: var(--ibk-border);
      border-radius: 9999px;
      overflow: hidden;
    }
    .vendor-progress-fill {
      height: 100%;
      background: #EA580C;
      border-radius: 9999px;
      transition: width 300ms ease;
    }
    .vendor-progress-text {
      font-size: 11px;
      color: var(--ibk-text-muted);
      line-height: 1;
      margin-top: 3px;
    }

    /* Tabular Numerics */
    .tokabe-cell-nominal {
      color: var(--ibk-text) !important;
      font-weight: 600;
    }
    .tokabe-amount-terbayar {
      color: var(--ibk-success) !important;
      font-weight: 600;
    }
    .tokabe-amount-sisa-unpaid {
      color: var(--ibk-danger) !important;
      font-weight: 600;
    }
    .tokabe-amount-sisa-zero {
      color: var(--ibk-text-muted) !important;
      font-weight: 600;
    }

    /* Action Ghost Button & Dropdown */
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

    /* Modals Responsive Dual Theme */
    .modal {
      z-index: 1065 !important;
    }
    .modal-backdrop {
      z-index: 1055 !important;
      background-color: #020617 !important;
    }
    .modal-backdrop.show {
      opacity: 0.75 !important;
    }
    body.theme-light .modal-backdrop.show {
      opacity: 0.45 !important;
    }
    .tokabe-modal {
      background-color: var(--ibk-modal-bg) !important;
      border: 1px solid var(--ibk-modal-border) !important;
      border-radius: 12px !important;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3) !important;
      overflow: hidden;
    }
    .tokabe-modal-header {
      border-bottom: 1px solid var(--ibk-modal-border) !important;
      background: transparent !important;
      padding: 18px 24px !important;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .tokabe-modal-body {
      padding: 24px !important;
    }
    .tokabe-modal-footer {
      border-top: 1px solid var(--ibk-modal-border) !important;
      background: var(--ibk-modal-footer-bg) !important;
      padding: 14px 24px !important;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }
    .tokabe-modal-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--ibk-text);
      margin: 0;
    }
    .tokabe-btn-close {
      filter: invert(1) grayscale(100%);
      opacity: 0.7;
      transition: opacity 0.15s ease;
    }
    .tokabe-btn-close:hover {
      opacity: 1;
    }
    body.theme-light .tokabe-btn-close {
      filter: none !important;
      opacity: 0.65;
    }
    body.theme-light .tokabe-btn-close:hover {
      opacity: 1;
    }

    /* Modal Form Controls */
    .form-label-modern {
      font-size: 13px;
      font-weight: 500;
      color: var(--ibk-text);
      margin-bottom: 6px;
      display: block;
    }
    .form-label-modern .required-star {
      color: var(--ibk-danger);
      margin-left: 2px;
    }
    .form-control-modern {
      background-color: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-input-border) !important;
      color: var(--ibk-input-text) !important;
      border-radius: 8px !important;
      height: 40px !important;
      font-size: 13.5px !important;
      padding: 8px 14px !important;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .form-control-modern::placeholder {
      color: var(--ibk-input-placeholder) !important;
    }
    .form-control-modern:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.25) !important;
      outline: none !important;
    }
    .form-help-text {
      font-size: 11.5px;
      color: var(--ibk-text-muted);
      margin-top: 4px;
      margin-bottom: 0;
    }
    .btn-modal-cancel {
      background-color: var(--ibk-surface) !important;
      border: 1px solid var(--ibk-border) !important;
      color: var(--ibk-text) !important;
      border-radius: 8px !important;
      font-weight: 500;
      font-size: 13px;
      padding: 8px 18px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
    }
    .btn-modal-cancel:hover {
      background-color: var(--ibk-surface-hover) !important;
      border-color: var(--ibk-brand-border) !important;
    }
    .btn-modal-submit {
      background: #EA580C !important;
      border: 1px solid #EA580C !important;
      color: #FFFFFF !important;
      border-radius: 8px !important;
      font-weight: 600;
      font-size: 13px;
      padding: 8px 22px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s ease;
      box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25);
    }
    .btn-modal-submit:hover {
      background: #C2410C !important;
      border-color: #C2410C !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35);
    }

    /* Modal Delete Custom Classes */
    .del-modal-radio {
      appearance: none !important;
      -webkit-appearance: none !important;
      width: 18px !important;
      height: 18px !important;
      border-radius: 50% !important;
      border: 2px solid var(--ibk-input-border) !important;
      background-color: var(--ibk-input-bg) !important;
      cursor: pointer !important;
      display: inline-grid !important;
      place-content: center !important;
      margin-top: 3px !important;
      flex-shrink: 0 !important;
      transition: all 0.15s ease !important;
    }
    .del-modal-radio::before {
      content: "" !important;
      width: 8px !important;
      height: 8px !important;
      border-radius: 50% !important;
      transform: scale(0) !important;
      transition: 120ms transform ease-in-out !important;
      box-shadow: inset 1em 1em #EA580C !important;
    }
    .del-modal-radio:checked {
      border-color: #EA580C !important;
      background-color: rgba(234, 88, 12, 0.15) !important;
    }
    .del-modal-radio:checked::before {
      transform: scale(1) !important;
    }
    #action_delete_all:checked {
      border-color: var(--ibk-danger) !important;
      background-color: var(--ibk-danger-soft) !important;
    }
    #action_delete_all:checked::before {
      box-shadow: inset 1em 1em var(--ibk-danger) !important;
    }
    .action-choice-card {
      border-radius: 10px !important;
      transition: all 0.15s ease !important;
      cursor: pointer !important;
      background: var(--ibk-input-bg) !important;
      border: 1px solid var(--ibk-border) !important;
    }
    .action-choice-card:hover {
      border-color: var(--ibk-brand-border) !important;
    }
    .del-vendor-badge-box {
      background: var(--ibk-surface-hover);
      border: 1px solid var(--ibk-brand-border);
    }
    .tokabe-del-badge-name {
      color: var(--ibk-brand);
    }
    .tokabe-alert-text {
      color: var(--ibk-text);
    }
    .tokabe-alert-strong {
      color: var(--ibk-text);
    }
    .tokabe-choice-label {
      color: var(--ibk-text);
    }
    .tokabe-input-label {
      color: var(--ibk-text-muted);
    }
    .tokabe-selected-target-text {
      color: var(--ibk-text);
    }
    .tokabe-success-text {
      color: var(--ibk-success);
    }
    .target-search-addon {
      background: var(--ibk-surface) !important;
      color: var(--ibk-text-muted) !important;
      border: 1px solid var(--ibk-input-border) !important;
      border-right: none !important;
    }
    .target-search-input {
      background: var(--ibk-surface) !important;
      color: var(--ibk-text) !important;
      border: 1px solid var(--ibk-input-border) !important;
      border-left: none !important;
    }
    .target-select-box {
      background: var(--ibk-surface) !important;
      color: var(--ibk-text) !important;
      border: 1px solid var(--ibk-input-border) !important;
      border-radius: 8px !important;
      font-size: 13px !important;
      line-height: 1.5 !important;
      padding: 4px !important;
    }
    .btn-modal-delete {
      background-color: var(--ibk-danger) !important;
      border-color: var(--ibk-danger) !important;
      color: #FFFFFF !important;
      border-radius: 8px !important;
      font-weight: 600;
      padding: 8px 18px;
      transition: all 0.15s ease;
    }
    .btn-modal-delete:hover {
      background-color: #B91C1C !important;
      border-color: #B91C1C !important;
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35);
    }
  </style>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="vendor-page-wrapper">

      <!-- 1. Header & Actions (Harmonized with Daftar Barang & Invoice) -->
      <div class="ibk-page-header">
        <div class="ibk-page-title">
          <h1>Pembelian Pada Vendor</h1>
          <div class="ibk-page-subtitle">Kelola master vendor, monitoring status pembayaran, dan riwayat tagihan pembelian</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
            <span id="theme-toggle-text">Mode Terang</span>
          </button>
          <button type="button" class="ibk-btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahVendor" id="btnOpenModalVendor">
            <i class="ri-add-line fs-16" aria-hidden="true"></i>
            <span>Tambah Vendor</span>
          </button>
        </div>
      </div>

      <!-- 2. Summary KPI Cards (§12.4) -->
      @if (in_array(Auth::user()->role, ['Pemilik', 'Admin']))
        <div class="row g-3 mb-4">
          <!-- KPI 1: Total Pembelian -->
          <div class="col-xl-3 col-md-6">
            <div class="ibk-kpi-card">
              <div>
                <div class="kpi-title">Total Pembelian</div>
                <h4 class="kpi-amount num">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h4>
              </div>
              <div class="kpi-icon-box icon-box-amber">
                <i class="ri-file-list-3-line"></i>
              </div>
            </div>
          </div>

          <!-- KPI 2: Total Terbayar -->
          <div class="col-xl-3 col-md-6">
            <div class="ibk-kpi-card">
              <div>
                <div class="kpi-title">Total Terbayar</div>
                <h4 class="kpi-amount num" style="color: var(--ibk-success);">Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</h4>
              </div>
              <div class="kpi-icon-box icon-box-emerald">
                <i class="ri-checkbox-circle-line"></i>
              </div>
            </div>
          </div>

          <!-- KPI 3: Sisa Belum Dibayar -->
          <div class="col-xl-3 col-md-6">
            <div class="ibk-kpi-card">
              <div>
                <div class="kpi-title">Sisa Belum Dibayar</div>
                <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? 'var(--ibk-danger)' : 'var(--ibk-text-muted)' }};">
                  Rp {{ number_format($totalSisa, 0, ',', '.') }}
                </h4>
              </div>
              <div class="kpi-icon-box icon-box-rose">
                <i class="ri-error-warning-line"></i>
              </div>
            </div>
          </div>

          <!-- KPI 4: Sisa Duit Kas -->
          <div class="col-xl-3 col-md-6">
            <div class="ibk-kpi-card">
              <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                  <div class="kpi-title mb-0">Sisa Duit Kas</div>
                  @if(($sisaKas ?? 0) < 0)
                    <span class="badge py-0 px-1.5 fs-10 fw-semibold" style="background: var(--ibk-danger-soft); color: var(--ibk-danger); border: 1px solid var(--ibk-danger-border);">Minus</span>
                  @else
                    <span class="badge py-0.5 px-2 fs-10 fw-semibold" style="background: var(--ibk-success-soft); color: var(--ibk-success); border: 1px solid var(--ibk-success-border);">Tersedia</span>
                  @endif
                </div>
                <h4 class="kpi-amount num" style="color: {{ ($sisaKas ?? 0) >= 0 ? 'var(--ibk-success)' : 'var(--ibk-danger)' }};">
                  @if(($sisaKas ?? 0) < 0)
                    -Rp {{ number_format(abs($sisaKas ?? 0), 0, ',', '.') }}
                  @else
                    Rp {{ number_format($sisaKas ?? 0, 0, ',', '.') }}
                  @endif
                </h4>
              </div>
              <div class="kpi-icon-box {{ ($sisaKas ?? 0) >= 0 ? 'icon-box-emerald' : 'icon-box-rose' }}">
                <i class="ri-wallet-3-line"></i>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="row g-3 mb-4">
          <div class="col-12">
            <div class="ibk-kpi-card">
              <div>
                <div class="kpi-title">Sisa Belum Dibayar</div>
                <h4 class="kpi-amount num" style="color: {{ $totalSisa > 0 ? 'var(--ibk-danger)' : 'var(--ibk-text-muted)' }};">
                  Rp {{ number_format($totalSisa, 0, ',', '.') }}
                </h4>
              </div>
              <div class="kpi-icon-box icon-box-rose">
                <i class="ri-error-warning-line"></i>
              </div>
            </div>
          </div>
        </div>
      @endif

      <!-- 3. Table Section: Daftar Vendor -->
      <div class="ibk-card" id="cardDaftarVendor">
        <!-- Card Header: Title on Top -->
        <div class="ibk-card-header">
          <div class="d-flex align-items-center gap-2">
            <div class="ibk-card-title">
              <i class="ri-store-2-line"></i>
              <span>Daftar Vendor</span>
            </div>
            <span class="badge-count-pill" id="vendorCountBadge">{{ count($vendors) }} Vendor</span>
          </div>
        </div>

        <!-- Card Toolbar: Search Bar on LEFT, Filters on RIGHT -->
        <div class="ibk-card-toolbar">
          <!-- Left: Search Box -->
          <div class="tokabe-search-wrapper">
            <i class="ri-search-line tokabe-search-icon"></i>
            <input type="text" id="searchVendorInput" class="form-control tokabe-search-input" placeholder="Cari nama vendor...">
            <button type="button" id="clearVendorSearch" class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-muted p-0 me-2 d-none" style="text-decoration: none;" title="Hapus pencarian">
              <i class="ri-close-line fs-14"></i>
            </button>
          </div>

          <!-- Right: Filters & Actions -->
          <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
            <!-- Filter Status Pembayaran -->
            <select id="filterStatusVendor" class="form-select form-select-tokabe" style="width: 170px;" title="Filter status tagihan vendor">
              <option value="all">Semua Status</option>
              <option value="belum_lunas">Hanya Belum Lunas</option>
              <option value="lunas">Hanya Sudah Lunas</option>
            </select>

            <!-- Urutan / Sort Filter -->
            <select id="sortVendorSelect" class="form-select form-select-tokabe" style="width: 230px;" title="Urutkan data vendor">
              <option value="sisa_desc" selected>Sisa Belum Dibayar (Tertinggi)</option>
              <option value="sisa_asc">Sisa Belum Dibayar (Terendah)</option>
              <option value="total_desc">Total Pembelian (Tertinggi)</option>
            </select>

            <button type="button" class="btn btn-reset-filter" id="btnResetVendorFilter" title="Reset filter" onclick="resetVendorFilters()">
              <i class="ri-refresh-line fs-15"></i>
            </button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table align-middle mb-0 tokabe-table" id="vendorTable">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">NO.</th>
                <th>NAMA VENDOR</th>
                <th class="text-end">TOTAL TRANSAKSI (RP)</th>
                <th class="text-end">TOTAL TERBAYAR (RP)</th>
                <th class="text-end">TOTAL SISA (RP)</th>
                <th class="text-center" style="width: 80px;">AKSI</th>
              </tr>
            </thead>
            <tbody id="vendorTableBody">
              @forelse ($vendors as $vendor)
                @php
                  $totalPembelian = (float) $vendor->total_pembelian;
                  $terbayar = (float) $vendor->pembelian_terbayar;
                  $sisa = (float) $vendor->pembelian_sisa;
                  $percent = $totalPembelian > 0 ? min(100, max(0, round(($terbayar / $totalPembelian) * 100))) : 0;
                @endphp
                <tr class="vendor-row"
                    data-vendor-name="{{ strtolower($vendor->nama_vendor) }}"
                    data-total-pembelian="{{ $totalPembelian }}"
                    data-terbayar="{{ $terbayar }}"
                    data-sisa="{{ $sisa }}">
                  <td class="text-center row-number num text-muted" style="font-size: 13px;">{{ $loop->iteration }}</td>
                  <td>
                    <a href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}" class="tokabe-vendor-link d-block">
                      {{ $vendor->nama_vendor }}
                    </a>
                    <div class="vendor-progress-wrapper mt-1">
                      <div class="vendor-progress-track">
                        <div class="vendor-progress-fill" style="width: {{ $percent }}%;"></div>
                      </div>
                      <div class="vendor-progress-text">{{ $percent }}% terbayar</div>
                    </div>
                  </td>
                  <td class="text-end tokabe-cell-nominal num">
                    {{ number_format($vendor->total_pembelian, 0, ',', '.') }}
                  </td>
                  <td class="text-end num tokabe-amount-terbayar">
                    {{ number_format($vendor->pembelian_terbayar, 0, ',', '.') }}
                  </td>
                  <td class="text-end num {{ $vendor->pembelian_sisa > 0 ? 'tokabe-amount-sisa-unpaid' : 'tokabe-amount-sisa-zero' }}">
                    {{ number_format($vendor->pembelian_sisa, 0, ',', '.') }}
                  </td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-action-ghost" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Menu Aksi">
                        <i class="ri-more-fill fs-16" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="{{ route('pembelian.list', ['uid' => $vendor->id]) }}">
                            <i class="ri-list-check fs-16 text-warning"></i>
                            <span>Lihat Transaksi</span>
                          </a>
                        </li>
                        <li>
                          <button type="button" class="dropdown-item edit-vendor-button"
                                  data-vendor-id="{{ $vendor->id }}" 
                                  data-vendor-name="{{ $vendor->nama_vendor }}"
                                  data-bs-toggle="modal" 
                                  data-bs-target="#editVendorModal">
                            <i class="ri-edit-line fs-16 text-warning"></i>
                            <span>Edit Vendor</span>
                          </button>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                          <button type="button" class="dropdown-item dropdown-item--danger delete-vendor-button"
                                  data-vendor-id="{{ $vendor->id }}"
                                  data-vendor-name="{{ $vendor->nama_vendor }}"
                                  data-pembelian-count="{{ $vendor->pembelian_count ?? 0 }}"
                                  data-total-pembelian="{{ number_format($vendor->total_pembelian, 0, ',', '.') }}"
                                  data-pembelian-terbayar="{{ number_format($vendor->pembelian_terbayar, 0, ',', '.') }}"
                                  data-pembelian-sisa="{{ number_format($vendor->pembelian_sisa, 0, ',', '.') }}">
                            <i class="ri-delete-bin-line fs-16 text-danger"></i>
                            <span>Hapus Vendor</span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada vendor terdaftar.</td></tr>
              @endforelse
              <tr id="noVendorFoundRow" class="d-none">
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="ri-search-eye-line fs-28 d-block mb-2 text-secondary"></i>
                  <span class="fs-13">Tidak ada vendor yang cocok dengan kriteria pencarian atau filter ini.</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- MODAL POPUP: TAMBAH VENDOR --}}
<div class="modal fade" id="modalTambahVendor" tabindex="-1" aria-labelledby="modalTambahVendorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal">
      <div class="tokabe-modal-header">
        <div>
          <h5 class="tokabe-modal-title d-flex align-items-center gap-2 mb-1" id="modalTambahVendorLabel">
            <i class="ri-store-2-line fs-18 text-warning"></i>
            <span>Tambah Vendor Baru</span>
          </h5>
          <p class="text-muted fs-12 mb-0">Daftarkan supplier / vendor baru untuk riwayat tagihan pembelian.</p>
        </div>
        <button type="button" class="btn-close tokabe-btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form action="{{ route('vendor.store') }}" method="POST" id="formTambahVendor">
        @csrf
        <div class="tokabe-modal-body">
          <label for="inputNamaVendor" class="form-label-modern">
            Nama Vendor / Supplier <span class="required-star">*</span>
          </label>
          <input type="text" 
                 id="inputNamaVendor" 
                 name="nama_vendor" 
                 class="form-control form-control-modern" 
                 placeholder="Misal: PT. Pixentra, Gading Murni UV" 
                 required 
                 autocomplete="off">
          <p class="form-help-text">Nama resmi vendor yang tertera pada invoice pembelian</p>
        </div>
        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16" aria-hidden="true"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit" id="btnSubmitVendor">
            <i class="ri-add-circle-line fs-16" aria-hidden="true"></i>
            <span>Simpan Vendor</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: EDIT VENDOR --}}
<div class="modal fade" id="editVendorModal" tabindex="-1" aria-labelledby="editVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content tokabe-modal">
      <form id="editVendorForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="vendor_id" id="edit_vendor_id">
        <div class="tokabe-modal-header">
          <div>
            <h5 class="tokabe-modal-title d-flex align-items-center gap-2 mb-1" id="editVendorModalLabel">
              <i class="ri-edit-line fs-18 text-warning"></i>
              <span>Edit Nama Vendor</span>
            </h5>
            <p class="text-muted fs-12 mb-0">Perbarui identitas atau nama resmi supplier / vendor.</p>
          </div>
          <button type="button" class="btn-close tokabe-btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="tokabe-modal-body">
          <label for="edit_nama_vendor" class="form-label-modern">
            Nama Vendor <span class="required-star">*</span>
          </label>
          <input id="edit_nama_vendor" name="vendor" type="text" class="form-control form-control-modern" placeholder="Nama Vendor" required>
          <p class="form-help-text">Perubahan nama akan otomatis tersinkron ke semua nota pembelian terkait</p>
        </div>
        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16" aria-hidden="true"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-submit" style="background-color: #D97706 !important; border-color: #D97706 !important;">
            <i class="ri-save-line fs-16" aria-hidden="true"></i>
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL POPUP: KONFIRMASI HAPUS VENDOR --}}
<div class="modal fade" id="deleteVendorModal" tabindex="-1" aria-labelledby="deleteVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
    <div class="modal-content tokabe-modal shadow-lg">
      <form id="deleteVendorForm" method="POST">
        @csrf
        @method('DELETE')
        
        <div class="tokabe-modal-header">
          <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="background: var(--ibk-danger-soft); color: var(--ibk-danger); width: 36px; height: 36px; border: 1px solid var(--ibk-danger-border);">
              <i class="ri-delete-bin-line fs-18"></i>
            </div>
            <div>
              <h5 class="tokabe-modal-title mb-0" id="deleteVendorModalLabel">
                Konfirmasi Hapus Vendor
              </h5>
            </div>
          </div>
          <button type="button" class="btn-close tokabe-btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="tokabe-modal-body">
          <div class="text-center mb-3">
            <p class="text-muted fs-13 mb-1">Apakah Anda yakin ingin menghapus vendor berikut?</p>
            <div class="d-inline-flex align-items-center gap-2 py-1 px-3 rounded-pill mt-1 del-vendor-badge-box">
              <i class="ri-store-2-fill fs-15 text-warning"></i>
              <span class="fw-bold fs-14 tokabe-del-badge-name" id="del_vendor_name_badge">-</span>
            </div>
          </div>

          {{-- Blok Jika Memiliki Riwayat Pembelian --}}
          <div id="del_section_has_trx" class="d-none">
            <div class="p-3 mb-3 rounded" style="background: var(--ibk-brand-soft); border: 1px solid var(--ibk-brand-border);">
              <div class="d-flex align-items-start gap-2.5">
                <i class="ri-alert-fill text-warning fs-18 flex-shrink-0 mt-0.5"></i>
                <div class="fs-13 tokabe-alert-text" style="line-height: 1.5;">
                  Vendor ini memiliki <span class="badge px-2 py-0.5 fs-12 fw-bold" style="background: var(--ibk-brand-border); color: var(--ibk-brand-text); border: 1px solid var(--ibk-brand);" id="del_trx_count_text">0 Transaksi</span> dengan total nilai <strong class="tokabe-alert-strong fw-bold num" id="del_trx_nominal_text">Rp 0</strong>.
                </div>
              </div>
            </div>

            <label class="form-label fw-semibold fs-11 text-uppercase mb-2 text-muted" style="letter-spacing: 0.6px;">
              PILIH PENANGANAN RIWAYAT PEMBELIAN:
            </label>

            {{-- Opsi 1: Pindahkan Transaksi (Default) --}}
            <div class="card mb-3 action-choice-card border" id="card_action_transfer" style="border-color: #EA580C !important; border: 1px solid;">
              <div class="card-body p-3">
                <div class="d-flex align-items-start gap-2.5">
                  <input class="del-modal-radio" type="radio" name="action" id="action_transfer" value="transfer" checked>
                  <div class="flex-grow-1">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                      <label class="form-check-label fw-semibold tokabe-choice-label fs-13 mb-0" for="action_transfer" style="cursor: pointer;">
                        Pindahkan riwayat pembelian ke vendor lain
                      </label>
                      <span class="badge px-2 py-0.5 rounded-pill fs-11 fw-semibold" style="background: var(--ibk-success-soft); color: var(--ibk-success); border: 1px solid var(--ibk-success-border);">
                        Direkomendasikan
                      </span>
                    </div>
                    <p class="fs-12 mb-2 text-muted" style="line-height: 1.45;">
                      Semua transaksi pembelian dan tagihan akan dialihkan ke vendor baru yang Anda pilih di bawah.
                    </p>

                    <div id="target_vendor_wrapper" class="pt-2 border-top border-dark">
                      <div class="d-flex justify-content-between align-items-center mb-1.5">
                        <label for="target_vendor_search_input" class="form-label fs-12 fw-medium tokabe-input-label mb-0">
                          Pilih Vendor Tujuan:
                        </label>
                        <span id="target_vendor_count_info" class="fs-11 fw-medium text-warning">
                          0 vendor tersedia
                        </span>
                      </div>

                      <div class="input-group input-group-sm mb-2 shadow-sm">
                        <span class="input-group-text target-search-addon">
                          <i class="ri-search-line fs-14"></i>
                        </span>
                        <input type="text" id="target_vendor_search_input" class="form-control form-control-sm target-search-input" 
                               placeholder="Ketik untuk mencari nama vendor...">
                        <button class="btn btn-sm btn-action-ghost" type="button" id="btn_clear_vendor_search" style="display: none;" title="Hapus Pencarian">
                          <i class="ri-close-line"></i>
                        </button>
                      </div>

                      <select name="target_vendor_id" id="target_vendor_select" class="form-select form-select-sm shadow-sm target-select-box" size="5">
                      </select>
                      
                      <div class="d-flex justify-content-between align-items-center mt-1.5">
                        <small class="fs-11 text-muted" id="target_vendor_selection_hint">
                          Klik salah satu vendor untuk memilih.
                        </small>
                        <small class="fs-11 fw-bold text-success d-none" id="selected_vendor_preview">
                          <i class="ri-checkbox-circle-fill me-1"></i>Terpilih: <span id="selected_vendor_name_text" class="tokabe-selected-target-text fw-bold"></span>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Opsi 2: Hapus Sekaligus --}}
            <div class="card mb-0 action-choice-card border" id="card_action_delete_all" style="border: 1px solid var(--ibk-border);">
              <div class="card-body p-3">
                <div class="d-flex align-items-start gap-2.5">
                  <input class="del-modal-radio" type="radio" name="action" id="action_delete_all" value="delete_all">
                  <div class="flex-grow-1">
                    <label class="form-check-label fw-semibold fs-13 mb-1" for="action_delete_all" style="color: var(--ibk-danger) !important; cursor: pointer;">
                      Hapus sekaligus vendor beserta seluruh riwayat pembeliannya
                    </label>
                    <p class="fs-12 mb-0 text-muted" style="line-height: 1.45;">
                      <strong class="text-danger">Peringatan:</strong> Seluruh transaksi pembelian dan detail barang vendor ini akan dihapus permanen. Anggaran kas yang telah terpakai akan dikembalikan ke saldo anggaran.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Blok Jika Belum Ada Transaksi --}}
          <div id="del_section_no_trx" class="d-none">
            <div class="p-3 rounded text-center" style="background: var(--ibk-success-soft); border: 1px solid var(--ibk-success-border);">
              <i class="ri-checkbox-circle-line text-success fs-26 d-block mb-1"></i>
              <span class="fs-13 fw-medium tokabe-success-text">Vendor ini belum memiliki riwayat pembelian, sehingga aman untuk langsung dihapus.</span>
            </div>
          </div>
        </div>

        <div class="tokabe-modal-footer">
          <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
            <i class="ri-close-line fs-16" aria-hidden="true"></i>
            <span>Batal</span>
          </button>
          <button type="submit" class="btn btn-modal-delete" id="btn_confirm_delete_vendor">
            <i class="ri-delete-bin-line me-1.5"></i>Ya, Hapus Vendor
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

<script>
  // ==========================================
  // Inisialisasi Tema (Dark / Light Mode)
  // ==========================================
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

  // Pindahkan semua modal langsung ke elemen <body> agar terbebas dari stacking context
  $(document).ready(function() {
      initPageTheme();
      $('#modalTambahVendor').appendTo('body');
      $('#editVendorModal').appendTo('body');
      $('#deleteVendorModal').appendTo('body');
  });

  // ==========================================
  // Filter dan Pencarian Tabel Vendor
  // ==========================================
  const searchVendorInput = document.getElementById('searchVendorInput');
  const filterStatusVendor = document.getElementById('filterStatusVendor');
  const sortVendorSelect = document.getElementById('sortVendorSelect');
  const clearVendorSearch = document.getElementById('clearVendorSearch');

  function applyVendorFilterAndSort() {
    const searchInput = document.getElementById('searchVendorInput');
    const statusSelect = document.getElementById('filterStatusVendor');
    const sortSelect = document.getElementById('sortVendorSelect');
    const tableBody = document.getElementById('vendorTableBody');
    const noFoundRow = document.getElementById('noVendorFoundRow');
    const badgeCount = document.getElementById('vendorCountBadge');
    const clearBtn = document.getElementById('clearVendorSearch');

    if (!tableBody) return;

    const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
    const statusFilter = statusSelect ? statusSelect.value : 'all';
    const sortBy = sortSelect ? sortSelect.value : 'sisa_desc';

    if (clearBtn) {
      clearBtn.classList.toggle('d-none', searchTerm === '');
    }

    const rows = Array.from(tableBody.querySelectorAll('tr.vendor-row'));

    let visibleCount = 0;
    rows.forEach(row => {
      const name = (row.dataset.vendorName || '').toLowerCase();
      const sisa = parseFloat(row.dataset.sisa || '0');

      const matchSearch = searchTerm === '' || name.includes(searchTerm);
      let matchStatus = true;
      if (statusFilter === 'belum_lunas') {
        matchStatus = sisa > 0;
      } else if (statusFilter === 'lunas') {
        matchStatus = sisa <= 0;
      }

      const isVisible = matchSearch && matchStatus;
      row.style.display = isVisible ? '' : 'none';
      if (isVisible) visibleCount++;
    });

    // Pengurutan baris tabel
    rows.sort((a, b) => {
      const nameA = a.dataset.vendorName || '';
      const nameB = b.dataset.vendorName || '';
      const sisaA = parseFloat(a.dataset.sisa || '0');
      const sisaB = parseFloat(b.dataset.sisa || '0');
      const totalA = parseFloat(a.dataset.totalPembelian || '0');
      const totalB = parseFloat(b.dataset.totalPembelian || '0');

      if (sortBy === 'sisa_desc') {
        return sisaB - sisaA || nameA.localeCompare(nameB);
      } else if (sortBy === 'sisa_asc') {
        return sisaA - sisaB || nameA.localeCompare(nameB);
      } else if (sortBy === 'total_desc') {
        return totalB - totalA || nameA.localeCompare(nameB);
      }
      return 0;
    });

    let rowNum = 1;
    rows.forEach(row => {
      tableBody.appendChild(row);
      if (row.style.display !== 'none') {
        const numCell = row.querySelector('.row-number');
        if (numCell) numCell.textContent = rowNum++;
      }
    });

    if (noFoundRow) {
      noFoundRow.classList.toggle('d-none', visibleCount > 0);
      tableBody.appendChild(noFoundRow);
    }

    if (badgeCount) {
      badgeCount.textContent = `${visibleCount} Vendor`;
    }
    const totalNum = document.getElementById('vendorTotalCountNum');
    if (totalNum) {
      totalNum.textContent = visibleCount;
    }
  }

  function resetVendorFilters() {
    const searchInput = document.getElementById('searchVendorInput');
    const statusSelect = document.getElementById('filterStatusVendor');
    const sortSelect = document.getElementById('sortVendorSelect');
    if (searchInput) searchInput.value = '';
    if (statusSelect) statusSelect.value = 'all';
    if (sortSelect) sortSelect.value = 'sisa_desc';
    applyVendorFilterAndSort();
  }

  if (searchVendorInput) {
    searchVendorInput.addEventListener('input', applyVendorFilterAndSort);
  }
  if (clearVendorSearch) {
    clearVendorSearch.addEventListener('click', () => {
      if (searchVendorInput) {
        searchVendorInput.value = '';
        applyVendorFilterAndSort();
        searchVendorInput.focus();
      }
    });
  }
  if (filterStatusVendor) {
    filterStatusVendor.addEventListener('change', applyVendorFilterAndSort);
  }
  if (sortVendorSelect) {
    sortVendorSelect.addEventListener('change', applyVendorFilterAndSort);
  }

  // Delegated event listener untuk Edit Vendor Modal Action
  const editVendorBaseUrl = "{{ url('/update-vendor') }}";
  $(document).on('click', '.edit-vendor-button', function() {
    const vendorId = $(this).data('vendorId');
    const vendorName = $(this).data('vendorName');
    $('#editVendorForm').attr('action', editVendorBaseUrl + '/' + vendorId);
    $('#edit_vendor_id').val(vendorId);
    $('#edit_nama_vendor').val(vendorName);
  });

  // ==========================================
  // Modal Konfirmasi Hapus Vendor Interaktif
  // ==========================================
  const deleteVendorBaseUrl = "{{ url('/delete-vendor') }}";
  const allVendorsList = @json($vendors->map(fn($v) => ['id' => $v->id, 'nama_vendor' => $v->nama_vendor]));
  let currentDeletingVendorId = null;

  const targetVendorSelect = document.getElementById('target_vendor_select');
  const targetVendorSearchInput = document.getElementById('target_vendor_search_input');
  const btnClearVendorSearch = document.getElementById('btn_clear_vendor_search');
  const targetVendorCountInfo = document.getElementById('target_vendor_count_info');
  const cardActionTransfer = document.getElementById('card_action_transfer');
  const cardActionDeleteAll = document.getElementById('card_action_delete_all');
  const radioTransfer = document.getElementById('action_transfer');
  const radioDeleteAll = document.getElementById('action_delete_all');
  const targetVendorWrapper = document.getElementById('target_vendor_wrapper');
  const selectedVendorPreview = document.getElementById('selected_vendor_preview');
  const selectedVendorNameText = document.getElementById('selected_vendor_name_text');

  function updateDeleteActionUI(action) {
    var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
    var defaultBorder = isLight ? '#E2E8F0' : '#27272A';
    if (action === 'transfer') {
      if (radioTransfer) radioTransfer.checked = true;
      if (cardActionTransfer) {
        cardActionTransfer.style.borderColor = '#EA580C';
      }
      if (cardActionDeleteAll) {
        cardActionDeleteAll.style.borderColor = defaultBorder;
      }
      if (targetVendorWrapper) {
        targetVendorWrapper.style.opacity = '1';
        targetVendorWrapper.style.pointerEvents = 'auto';
      }
      if (targetVendorSelect) {
        targetVendorSelect.required = true;
      }
    } else {
      if (radioDeleteAll) radioDeleteAll.checked = true;
      if (cardActionDeleteAll) {
        cardActionDeleteAll.style.borderColor = '#EF4444';
      }
      if (cardActionTransfer) {
        cardActionTransfer.style.borderColor = defaultBorder;
      }
      if (targetVendorWrapper) {
        targetVendorWrapper.style.opacity = '0.35';
        targetVendorWrapper.style.pointerEvents = 'none';
      }
      if (targetVendorSelect) {
        targetVendorSelect.required = false;
      }
    }
  }

  function renderTargetVendorSelect(query = '') {
    if (!targetVendorSelect) return;

    const available = allVendorsList.filter(v => String(v.id) !== String(currentDeletingVendorId));
    const normalizedQuery = query.toLowerCase().trim();
    const filtered = normalizedQuery 
      ? available.filter(v => v.nama_vendor.toLowerCase().includes(normalizedQuery))
      : available;

    if (targetVendorCountInfo) {
      targetVendorCountInfo.textContent = `${filtered.length} vendor tersedia`;
    }

    targetVendorSelect.innerHTML = '';

    if (filtered.length === 0) {
      const opt = document.createElement('option');
      opt.disabled = true;
      opt.textContent = normalizedQuery ? 'Tidak ada vendor yang cocok...' : 'Tidak ada vendor tujuan lain.';
      opt.style.color = '#94A3B8';
      opt.style.padding = '8px 12px';
      targetVendorSelect.appendChild(opt);
      if (selectedVendorPreview) selectedVendorPreview.classList.add('d-none');
      return;
    }

    filtered.forEach((vendor, index) => {
      const opt = document.createElement('option');
      opt.value = vendor.id;
      opt.textContent = vendor.nama_vendor;
      if (index === 0) {
        opt.selected = true;
      }
      targetVendorSelect.appendChild(opt);
    });

    updateSelectedVendorPreview();
  }

  function updateSelectedVendorPreview() {
    if (!targetVendorSelect || !selectedVendorPreview || !selectedVendorNameText) return;
    const selectedOpt = targetVendorSelect.options[targetVendorSelect.selectedIndex];
    if (selectedOpt && !selectedOpt.disabled) {
      selectedVendorNameText.textContent = selectedOpt.textContent;
      selectedVendorPreview.classList.remove('d-none');
    } else {
      selectedVendorPreview.classList.add('d-none');
    }
  }

  // Delegated event listener untuk tombol hapus vendor pada tabel
  $(document).on('click', '.delete-vendor-button', function() {
    const vendorId = $(this).data('vendorId');
    const vendorName = $(this).data('vendorName');
    const trxCount = parseInt($(this).data('pembelianCount') || '0');
    const totalPembelian = $(this).data('totalPembelian') || '0';

    currentDeletingVendorId = vendorId;

    $('#deleteVendorForm').attr('action', deleteVendorBaseUrl + '/' + vendorId);
    $('#del_vendor_name_badge').text(vendorName);

    const secHasTrx = document.getElementById('del_section_has_trx');
    const secNoTrx = document.getElementById('del_section_no_trx');
    const trxCountText = document.getElementById('del_trx_count_text');
    const trxNominalText = document.getElementById('del_trx_nominal_text');

    if (trxCount > 0) {
      if (secHasTrx) secHasTrx.classList.remove('d-none');
      if (secNoTrx) secNoTrx.classList.add('d-none');
      if (trxCountText) trxCountText.textContent = `${trxCount} Transaksi Pembelian`;
      if (trxNominalText) trxNominalText.textContent = `Rp ${totalPembelian}`;

      updateDeleteActionUI('transfer');

      if (targetVendorSearchInput) targetVendorSearchInput.value = '';
      if (btnClearVendorSearch) btnClearVendorSearch.style.display = 'none';
      renderTargetVendorSelect('');
    } else {
      if (secHasTrx) secHasTrx.classList.add('d-none');
      if (secNoTrx) secNoTrx.classList.remove('d-none');
      if (targetVendorSelect) targetVendorSelect.required = false;
    }

    $('#deleteVendorModal').modal('show');
  });

  // Interaksi klik kartu / radio transfer
  if (cardActionTransfer) {
    cardActionTransfer.addEventListener('click', (e) => {
      if (e.target.closest('#target_vendor_wrapper')) return;
      updateDeleteActionUI('transfer');
    });
  }
  if (radioTransfer) {
    radioTransfer.addEventListener('change', () => updateDeleteActionUI('transfer'));
  }

  // Interaksi klik kartu / radio hapus semua
  if (cardActionDeleteAll) {
    cardActionDeleteAll.addEventListener('click', () => updateDeleteActionUI('delete_all'));
  }
  if (radioDeleteAll) {
    radioDeleteAll.addEventListener('change', () => updateDeleteActionUI('delete_all'));
  }

  // Pencarian live vendor tujuan
  if (targetVendorSearchInput) {
    targetVendorSearchInput.addEventListener('input', function() {
      const val = this.value;
      if (btnClearVendorSearch) {
        btnClearVendorSearch.style.display = val.length > 0 ? 'inline-block' : 'none';
      }
      renderTargetVendorSelect(val);
    });
  }

  if (btnClearVendorSearch) {
    btnClearVendorSearch.addEventListener('click', function() {
      if (targetVendorSearchInput) {
        targetVendorSearchInput.value = '';
        this.style.display = 'none';
        renderTargetVendorSelect('');
        targetVendorSearchInput.focus();
      }
    });
  }

  if (targetVendorSelect) {
    targetVendorSelect.addEventListener('change', updateSelectedVendorPreview);
  }

  // Validasi sebelum submit form hapus
  const deleteVendorForm = document.getElementById('deleteVendorForm');
  if (deleteVendorForm) {
    deleteVendorForm.addEventListener('submit', function (e) {
      const secHasTrx = document.getElementById('del_section_has_trx');
      if (secHasTrx && !secHasTrx.classList.contains('d-none')) {
        if (radioTransfer && radioTransfer.checked) {
          if (!targetVendorSelect || !targetVendorSelect.value) {
            e.preventDefault();
            alert('Silakan pilih salah satu vendor tujuan terlebih dahulu.');
            if (targetVendorSelect) targetVendorSelect.focus();
            return false;
          }
        }
      }
    });
  }

  // Focus input saat modal tambah dibuka
  $('#modalTambahVendor').on('shown.bs.modal', function() {
    setTimeout(function() {
      $('#inputNamaVendor').focus();
    }, 50);
  });

  $('#modalTambahVendor').on('hidden.bs.modal', function() {
    $('#formTambahVendor')[0].reset();
  });

  // Focus input saat modal edit dibuka
  $('#editVendorModal').on('shown.bs.modal', function() {
    setTimeout(function() {
      $('#edit_nama_vendor').focus();
    }, 50);
  });

  document.addEventListener('DOMContentLoaded', function () {
    initPageTheme();
    applyVendorFilterAndSort();
  });
</script>
@endsection
