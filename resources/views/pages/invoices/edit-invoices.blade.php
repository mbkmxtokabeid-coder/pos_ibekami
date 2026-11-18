@section('head')
<!-- dropzone css -->

<link rel="stylesheet" href="{{asset('libs/dropzone/dropzone.css')}}" type="text/css" />

<!-- Sweet Alert css-->
<link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  .error-help-block{
    color: #ca131e;
  }

  /* View Transition API Circular Reveal */
  ::view-transition-old(root),
  ::view-transition-new(root) {
      animation: none;
      mix-blend-mode: normal;
  }
  ::view-transition-old(root) {
      z-index: 1;
  }
  ::view-transition-new(root) {
      z-index: 999999;
  }

  /* Theme Toggle Button (Identik Dashboard) */
  .ref-theme-toggle {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 6px 14px;
      border-radius: 999px;
      font-size: 12.5px;
      font-weight: 600;
      font-family: inherit;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.14);
      color: #F5EFE6;
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
      outline: none !important;
      text-decoration: none !important;
  }
  .ref-theme-toggle:hover {
      background: rgba(255, 255, 255, 0.12);
      transform: translateY(-1px);
      color: #FBBF24;
  }
  .ref-theme-toggle:active {
      transform: scale(0.96);
  }
  .ref-theme-toggle #theme-toggle-icon {
      display: inline-block;
      transition: transform 380ms cubic-bezier(0.34, 1.56, 0.64, 1), opacity 200ms ease;
  }
  .ref-theme-toggle.theme-switching #theme-toggle-icon {
      transform: rotate(180deg) scale(0.65);
      opacity: 0.2;
  }

  /* Theme Toggle (Light) */
  body.theme-light .ref-theme-toggle {
      background: #FFFFFF !important;
      border: 1px solid #CBD5E1 !important;
      color: #334155 !important;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
  }
  body.theme-light .ref-theme-toggle:hover {
      background: #FFF7ED !important;
      border-color: #FDBA74 !important;
      color: #C2410C !important;
  }

  /* Solid Dark & Light Canvas */
  html:not(.theme-light) body,
  html.theme-dark body {
      background-color: #0C0A09 !important;
      background-image: none !important;
      color: #FAFAFA !important;
  }
  html.theme-light body,
  body.theme-light {
      background-color: #F8FAFC !important;
      background-image: none !important;
      color: #0F172A !important;
  }

  #layout-wrapper, .main-content, .page-content {
      background-color: transparent !important;
  }

  /* Sembunyikan semua scrollbar bawaan (tetap bisa di-scroll dengan mousewheel / touch gesture) */
  *,
  *::before,
  *::after,
  html,
  body,
  #layout-wrapper,
  .main-content,
  .page-content,
  .card,
  .table-responsive,
  .choices__list {
      scrollbar-width: none !important;
      -ms-overflow-style: none !important;
  }
  *::-webkit-scrollbar,
  html::-webkit-scrollbar,
  body::-webkit-scrollbar,
  #layout-wrapper::-webkit-scrollbar,
  .main-content::-webkit-scrollbar,
  .page-content::-webkit-scrollbar,
  .card::-webkit-scrollbar,
  .table-responsive::-webkit-scrollbar,
  .choices__list::-webkit-scrollbar {
      width: 0 !important;
      height: 0 !important;
      display: none !important;
      background: transparent !important;
  }

  /* Choices.js Dropdown Styling (Warm Obsidian & Amber Highlight) */
  .choices {
      margin-bottom: 0 !important;
  }
  .choices__inner {
      background-color: rgba(18, 14, 10, 0.85) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      color: #FAFAFA !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      min-height: 40px !important;
      padding: 4px 10px !important;
  }
  .is-focused .choices__inner,
  .is-open .choices__inner {
      border-color: rgba(245, 158, 11, 0.6) !important;
      box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.18) !important;
  }
  .choices__list--single {
      padding: 4px 16px 4px 4px !important;
      color: #FAFAFA !important;
  }
  .choices__list--single .choices__item {
      color: #FAFAFA !important;
  }
  .choices__list--dropdown,
  .choices__list[aria-expanded] {
      background: #181411 !important;
      border: 1px solid rgba(245, 158, 11, 0.35) !important;
      border-radius: 10px !important;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.9), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
      padding: 6px !important;
      z-index: 99999 !important;
  }
  .choices__list--dropdown .choices__input {
      background: #14100D !important;
      border: 1px solid rgba(255, 255, 255, 0.14) !important;
      border-radius: 6px !important;
      color: #FAFAFA !important;
      padding: 8px 12px !important;
      margin-bottom: 6px !important;
      font-size: 13px !important;
  }
  .choices__list--dropdown .choices__input:focus {
      border-color: #F59E0B !important;
      box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.25) !important;
  }
  .choices__list--dropdown .choices__item--selectable {
      color: #F5EFE6 !important;
      border-radius: 6px !important;
      padding: 8px 12px !important;
      font-size: 13px !important;
      transition: all 0.15s ease !important;
  }
  .choices__list--dropdown .choices__item--selectable:hover,
  .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background: linear-gradient(90deg, rgba(245, 158, 11, 0.22), rgba(234, 88, 12, 0.28)) !important;
      color: #F59E0B !important;
      font-weight: 600 !important;
  }
  .choices__placeholder {
      color: #78716C !important;
      opacity: 1 !important;
  }

  /* Choices.js Light Mode */
  body.theme-light .choices__inner {
      background-color: #FFFFFF !important;
      border: 1px solid #CBD5E1 !important;
      color: #0F172A !important;
  }
  body.theme-light .is-focused .choices__inner,
  body.theme-light .is-open .choices__inner {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
  }
  body.theme-light .choices__list--single,
  body.theme-light .choices__list--single .choices__item {
      color: #0F172A !important;
  }
  body.theme-light .choices__list--dropdown,
  body.theme-light .choices__list[aria-expanded] {
      background: #FFFFFF !important;
      border: 1px solid #E2E8F0 !important;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12) !important;
  }
  body.theme-light .choices__list--dropdown .choices__input {
      background: #F8FAFC !important;
      border: 1px solid #CBD5E1 !important;
      color: #0F172A !important;
  }
  body.theme-light .choices__list--dropdown .choices__input:focus {
      border-color: #EA580C !important;
      box-shadow: 0 0 0 2px rgba(234, 88, 12, 0.15) !important;
  }
  body.theme-light .choices__list--dropdown .choices__item--selectable {
      color: #334155 !important;
  }
  body.theme-light .choices__list--dropdown .choices__item--selectable:hover,
  body.theme-light .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background: #FFF7ED !important;
      color: #C2410C !important;
  }
  body.theme-light .choices__placeholder {
      color: #94A3B8 !important;
  }

  /* Page Title */
  .inv-page-title {
      color: #FAFAFA !important;
      font-weight: 700;
      letter-spacing: 0.5px;
      font-size: 18px;
      margin: 0;
  }
  body.theme-light .inv-page-title {
      color: #1E293B !important;
  }

  /* Main Card & Containers (Solid Dark & Light Surface) */
  .card {
      background: #14110F !important;
      border: 1px solid rgba(255, 255, 255, 0.08) !important;
      border-radius: 14px !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35) !important;
  }
  body.theme-light .card {
      background-color: #FFFFFF !important;
      border: 1px solid #E2E8F0 !important;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
  }

  /* Form Labels */
  label, .col-form-label {
      color: #FAFAFA !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      letter-spacing: 0.2px;
  }
  body.theme-light label, body.theme-light .col-form-label {
      color: #1E293B !important;
  }

  /* Inputs & Form Controls (Warm Obsidian) */
  .form-control, .form-select, select.form-control {
      background-color: rgba(18, 14, 10, 0.85) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      color: #FAFAFA !important;
      border-radius: 8px !important;
      font-size: 13.5px !important;
      height: 40px !important;
      transition: all 0.15s ease-in-out !important;
  }
  .form-control:hover, .form-select:hover {
      border-color: rgba(245, 158, 11, 0.4) !important;
  }
  .form-control:focus, .form-select:focus {
      background-color: rgba(24, 18, 14, 0.96) !important;
      border-color: #F59E0B !important;
      box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.28) !important;
      color: #FFFFFF !important;
      outline: none !important;
  }
  .form-control::placeholder {
      color: #71717A !important;
  }
  textarea.form-control {
      height: auto !important;
      min-height: 56px !important;
  }

  /* Inputs (Light Mode) */
  body.theme-light .form-control,
  body.theme-light .form-select,
  body.theme-light select.form-control {
      background-color: #FFFFFF !important;
      border: 1px solid #CBD5E1 !important;
      color: #0F172A !important;
  }
  body.theme-light .form-control:hover,
  body.theme-light .form-select:hover {
      border-color: #94A3B8 !important;
  }
  body.theme-light .form-control:focus,
  body.theme-light .form-select:focus {
      background-color: #FFFFFF !important;
      border-color: #EA580C !important;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
      color: #0F172A !important;
  }
  body.theme-light .form-control::placeholder {
      color: #94A3B8 !important;
  }

  /* Select Options */
  select.form-control option, select.form-select option {
      background-color: #181411 !important;
      color: #FAFAFA !important;
  }
  select.form-control option:checked, select.form-select option:checked {
      background-color: #F59E0B !important;
      color: #1A0F05 !important;
  }

  /* Readonly Inputs - Warm Obsidian Glass */
  .form-control[readonly], .form-control:disabled {
      background-color: rgba(12, 10, 8, 0.88) !important;
      border: 1px solid rgba(255, 255, 255, 0.08) !important;
      color: #D4D4D8 !important;
  }
  body.theme-light .form-control[readonly],
  body.theme-light .form-control:disabled {
      background-color: #F8FAFC !important;
      border: 1px solid #E2E8F0 !important;
      color: #475569 !important;
  }

  /* Readonly Highlights */
  #noInvoice, #invoicenoInput {
      font-family: "JetBrains Mono", ui-monospace, monospace !important;
      font-weight: 700 !important;
      color: #FBBF24 !important;
      border-color: rgba(245, 158, 11, 0.45) !important;
      background-color: rgba(245, 158, 11, 0.08) !important;
  }
  body.theme-light #noInvoice, body.theme-light #invoicenoInput {
      color: #C2410C !important;
      border-color: #FDBA74 !important;
      background-color: #FFF7ED !important;
  }

  /* Table Items */
  .invoice-table thead th {
      background-color: transparent !important;
      color: #A1A1AA !important;
      font-size: 12px !important;
      font-weight: 500 !important;
      text-transform: none !important;
      letter-spacing: normal !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.085) !important;
      padding: 12px 10px !important;
  }
  .invoice-table tbody tr {
      border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
  }
  .invoice-table tbody td {
      vertical-align: top !important;
      padding: 12px 10px !important;
      color: #FAFAFA !important;
  }
  body.theme-light .invoice-table thead th {
      background-color: #F8FAFC !important;
      color: #64748B !important;
      border-bottom: 1px solid #E2E8F0 !important;
  }
  body.theme-light .invoice-table tbody tr {
      border-bottom: 1px solid #F1F5F9 !important;
  }
  body.theme-light .invoice-table tbody td {
      color: #1E293B !important;
  }

  /* Action Buttons */
  #update, .btn-update-invoice {
      background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
      border: 1px solid transparent !important;
      color: #1A0F05 !important;
      font-weight: 700 !important;
      border-radius: 8px !important;
      padding: 9px 26px !important;
      box-shadow: 0 4px 16px rgba(249, 115, 22, 0.4) !important;
      transition: all 0.15s ease !important;
      cursor: pointer;
  }
  #update:hover, .btn-update-invoice:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(249, 115, 22, 0.55) !important;
      color: #1A0F05 !important;
  }
  body.theme-light #update, body.theme-light .btn-update-invoice {
      background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
      color: #FFFFFF !important;
      box-shadow: 0 4px 16px rgba(234, 88, 12, 0.35) !important;
  }
  body.theme-light #update:hover, body.theme-light .btn-update-invoice:hover {
      color: #FFFFFF !important;
  }

  #add-item {
      background-color: rgba(245, 158, 11, 0.08) !important;
      border: 1px solid #F59E0B !important;
      color: #F59E0B !important;
      border-radius: 8px !important;
      padding: 7px 18px !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      transition: all 0.15s ease !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
  }
  #add-item:hover {
      background-color: #F59E0B !important;
      color: #1A0F05 !important;
  }
  body.theme-light #add-item {
      background-color: #FFF7ED !important;
      border-color: #EA580C !important;
      color: #EA580C !important;
  }
  body.theme-light #add-item:hover {
      background-color: #EA580C !important;
      color: #FFFFFF !important;
  }

  .btn-cancel-ibekami {
      background-color: rgba(255, 255, 255, 0.08) !important;
      border: 1px solid rgba(255, 255, 255, 0.16) !important;
      color: #cbd5e1 !important;
      border-radius: 8px !important;
      padding: 8px 18px !important;
      font-size: 13.5px !important;
      font-weight: 500 !important;
      text-decoration: none !important;
      display: inline-flex !important;
      align-items: center !important;
      transition: all 0.15s ease !important;
  }
  .btn-cancel-ibekami:hover {
      background-color: rgba(255, 255, 255, 0.14) !important;
      color: #ffffff !important;
  }
  body.theme-light .btn-cancel-ibekami {
      background-color: #FFFFFF !important;
      border: 1px solid #CBD5E1 !important;
      color: #475569 !important;
  }
  body.theme-light .btn-cancel-ibekami:hover {
      background-color: #F1F5F9 !important;
      color: #0F172A !important;
  }

  /* Flatpickr Styling - Solid Opaque Warm Obsidian Theme */
  .flatpickr-calendar {
      background: #181411 !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      border-radius: 12px !important;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
      z-index: 999999 !important;
  }
  .flatpickr-months {
      background: #14100D !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  }
  .flatpickr-current-month {
      color: #FAFAFA !important;
  }
  .flatpickr-days, .dayContainer {
      background: #181411 !important;
  }
  .flatpickr-day {
      color: #FAFAFA !important;
  }
  .flatpickr-day.selected {
      background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
      border-color: #F59E0B !important;
      color: #1A0F05 !important;
  }
  body.theme-light .flatpickr-calendar {
      background: #FFFFFF !important;
      border: 1px solid #E2E8F0 !important;
      box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12) !important;
  }
  body.theme-light .flatpickr-months {
      background: #F8FAFC !important;
  }
  body.theme-light .flatpickr-current-month {
      color: #0F172A !important;
  }
  body.theme-light .flatpickr-days, body.theme-light .dayContainer {
      background: #FFFFFF !important;
  }
  body.theme-light .flatpickr-day {
      color: #1E293B !important;
  }
  body.theme-light .flatpickr-day.selected {
      background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
      border-color: #EA580C !important;
      color: #FFFFFF !important;
  }

  /* Bank Account Card Badge */
  .bank-account-badge {
      background: rgba(16, 185, 129, 0.12) !important;
      border: 1px solid rgba(16, 185, 129, 0.3) !important;
      border-radius: 8px;
      padding: 10px 15px;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s ease;
  }
  .bank-account-badge .bank-account-text {
      color: #34D399;
      font-size: 12.5px;
      font-weight: 600;
      letter-spacing: 0.2px;
  }
  .badge-dot-green {
      width: 8px;
      height: 8px;
      background-color: #10b981;
      border-radius: 50%;
      display: inline-block;
      flex-shrink: 0;
      box-shadow: 0 0 6px rgba(16, 185, 129, 0.5);
  }
  body.theme-light .bank-account-badge {
      background: #ECFDF5 !important;
      border: 1px solid #A7F3D0 !important;
      box-shadow: 0 1px 3px rgba(16, 185, 129, 0.08) !important;
  }
  body.theme-light .bank-account-badge .bank-account-text,
  body.theme-light .bank-account-badge span,
  body.theme-light .bank-account-badge .text-white {
      color: #065F46 !important;
  }
  body.theme-light .badge-dot-green {
      background-color: #059669 !important;
      box-shadow: 0 0 5px rgba(5, 150, 105, 0.4) !important;
  }
</style>
@endsection
@extends('layout.template')
@section('content')

<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                                <h4 class="mb-sm-0 inv-page-title">Edit Invoice #{{ $kode }}{{ $nomor_unik }}</h4>

                                <div class="page-title-right d-flex align-items-center gap-2">
                                    <ol class="breadcrumb m-0 me-2 d-none d-md-flex">
                                        <li class="breadcrumb-item"><a href="{{ route('daftar_invoice') }}" class="text-muted">Invoice</a></li>
                                        <li class="breadcrumb-item active text-muted">Edit Invoice</li>
                                    </ol>
                                    <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
                                        <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
                                        <span id="theme-toggle-text">Mode Terang</span>
                                    </button>
                                    <a href="{{ route('daftar_invoice') }}" class="btn-cancel-ibekami px-3 py-1 text-decoration-none" style="font-size: 13px; font-weight: 500;">
                                        <i class="ri-arrow-left-line me-1"></i> Kembali
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                       <div class="col-xxl-12">
                         <div class="card">
                           <form action="{{ url('/updateInvoice/' . $inv->id) }}" id="invoice_form" data-invoice-id="{{ $inv->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                             <div class="card-body border-bottom border-bottom-dashed p-4">
                               <div class="row">
                                 <div class="col-lg-6">
                                   <div class="row g-3 mb-2">
                                       <!--end col-->

                                      <div class="col-lg-8 col-sm-6">
                                         <label for="choices-invoice">Invoice</label>
                                            <div class="input-light">
                                               <select  data-choices data-choices-search-false
                                               class="form-control bg-light border-0 @error('inv') is-invalid @enderror"id="choices-invoice" name="inv" required>
                                                {{-- Start Pilihan Jenis Invoice --}}
                                                <option value="{{$invoice->id}}">{{$invoice->nama_invoice}}</option>

                                                {{-- End Pilihan Jenis Invoice --}}
                                                </select>

                                                {{-- @error('inv')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror --}}
                                            </div>
                                      </div>

                                         {{-- End coloumn --}}
                                   </div>
                                      <div class="row mb-2 col-lg-8 col-sm-6">
                                         <label for="invoicenoInput">Invoice No</label>
                                          <div class="col-lg-4">
                                            <input type="text" class="form-control bg-light border-0 @error('kode') is-invalid @enderror" id="invoicenoInput" placeholder="kode" name="kode" value="{{$kode}}" readonly >
                                                @error('kode')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                          </div>
                                          <div class="col-lg-7">
                                            <input type="text" class="form-control bg-light border-0" id="noInvoice" placeholder="kode Unik" name="kodeUnik" value="{{$nomor_unik}}" >
                                          </div>
                                      </div>
                                        <!--end col-->
                                      <div class="row mb-2 col-lg-9">

                                          <label for="date-field">Tanggal Penjualan</label>
                                          <div class="col-lg-4">
                                            <input type="text" class="form-control bg-light border-0 flatpickr-input" id="date-field" name="tgl_jual" data-provider="flatpickr" data-date-format="Y-m-d" value="{{ $inv->tgl_penjualan ? substr($inv->tgl_penjualan, 0, 10) : '' }}" style="cursor: pointer;">
                                          </div>
                                          <div class="col-lg-6">
                                            <input type="text" class="form-control bg-light border-0 flatpickr-input" id="time-field" placeholder="H:i" name="jam" value="{{ $jam }}" style="cursor: pointer;" autocomplete="off">
                                          </div>

                                        </div>
                                        <!--end col-->


                                        <!--end col-->
                                    {{-- </div> --}}

                                 </div>
                                  <!--end col-->
                                 <div class="col-lg-4 ms-auto">
                                  <div class="profile-user mx-auto  mb-3">
                                   <input id="profile-img-file-input" type="file" class="profile-img-file-input"/>
                                   <label for="profile-img-file-input" class="d-block" tabindex="0">
                                    <span class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded" style="height: 60px; width: 256px;">
                                      <img src="{{ asset('storage/images/perusahaan/698c05828c9a6.png') }}" onerror="this.onerror=null;this.src='{{ asset('images/perusahaan/698c05828c9a6.png') }}';" class="card-logo user-profile-image img-fluid" alt="Logo Ibekami" style="max-height: 50px; object-fit: contain;">

                                    </span>
                                   </label>
                                  </div>
                                 </div>
                                {{-- Customer Form --}}
                                 <div class="row mt-2">
                                  <div class="col-xxl-5">
                                  </div>
                                  <div class="col-xxl-7">
                                   {{-- <div class="card no-border border-0"> --}}
                                    <div class="row mb-3">
                                     <label for="customer" class="col-lg-5 col-form-label col-form-label-md">Nama Customer</label>
                                       <div class="col-lg-7">
                                        <input type="text" class="form-control form-control-md @error('pelanggan') is-invalid @enderror" name="pelanggan" id="customer" placeholder="Nama Customer"value="{{ $inv->customer }}">
                                        @error('pelanggan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>
                                      </div>
                                      <div class="row mb-4">
                                       <label for="usaha" class="col-lg-5 col-form-label col-form-label-md">Nama Perusahaan / Instansi</label>
                                       <div class="col-lg-7">
                                        <input type="text" class="form-control form-control-md  @error('perusahaan') is-invalid @enderror " id="usaha" name="perusahaan" placeholder="Nama Perusahaan / instansi" value="{{ $perusahaan }}">
                                        @error('perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>
                                      </div>
                                         {{-- Start No.Telepon --}}
                                      <div class="row mb-3" style="margin-top: -10px;">
                                       <div class="col-lg-5">
                                        <label for="contactNumber" class="form-label col-form-label col-form-label-md">Nomor Telepon</label>
                                       </div>
                                       <div class="col-lg-7">
                                        <input type="text" class="form-control @error('tlp') is-invalid @enderror" id="phone-number" name="tlp" placeholder="08xxxxxxxx" value="{{ $inv->no_telepon }}">
                                        @error('tlp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>
                                      </div>
                                      {{-- End No.Telepon --}}
                                      {{-- Start Admin --}}
                                      <div class="row mb-3">
                                       <div class="col-lg-5">
                                        <label for="choices-admin" class="form-label col-form-label col-form-label-md">Nama Admin</label>
                                       </div>
                                       {{-- test --}}

                                       <div class="col-lg-7">
                                        <select class="form-select bg-light border-0 @error('adm') is-invalid @enderror" name="adm" id="choices-admin" required>
                                          <option value="">Pilih Admin</option>
                                          @foreach ($admin as $adm)
                                              @php
                                                  $hasSig = !empty($adm->tanda_tangan_url);
                                                  $selectedAdminId = old('adm', $inv->admin);
                                              @endphp
                                              <option value="{{ $adm->id }}"
                                                  data-has-signature="{{ $hasSig ? '1' : '0' }}"
                                                  data-admin-name="{{ $adm->nama }}"
                                                  {{ ($selectedAdminId == $adm->id || $selectedAdminId == $adm->nama) ? 'selected' : '' }}>
                                                  {{ $adm->nama }} {{ $hasSig ? '✓ (Ada TTD)' : '⚠️ (Belum ada TTD)' }}
                                              </option>
                                          @endforeach
                                        </select>
                                        <div id="admin-signature-alert" class="mt-2" style="display: none;"></div>
                                        @error('adm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>

                                      </div>
                                      {{-- End Admin --}}
                                      {{-- Start Order By --}}
                                      <div class="row mb-3">
                                       <div class="col-lg-5">
                                          <label for="choices-orderBy" class="form-label col-form-label col-form-label-md">Order Dari</label>
                                       </div>
                                       <div class="col-lg-7">
                                        <select class="form-control bg-light border-0 @error('order') is-invalid @enderror" data-choices data-choices-search-false  id="choices-orderBy" name="order" required>
                                        <option value="{{ $inv->order_by }}" selected>{{ $inv->order_by }}</option>
                                        @foreach ($order as $ord)

                                        @if ($inv->order_by != $ord->order_by)
                                        <option value="{{ $ord->order_by }}">{{ $ord->order_by }}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                        @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>
                                      </div>
                                      {{-- End Order By--}}
                                      {{-- start Hide div --}}
                                        <div id="divSales"style="display: none; margin-bottom: -5px;">
                                          <div class="row mb-3">
                                            <div class="col-lg-5">
                                              <label for="colFormLabelNamaSales" class="col-form-label col-form-label-md">Nama Sales</label>
                                            </div>
                                            <div class="col-lg-7" style="margin-top: -10px;">
                                                <input type="text" class="form-control form-control-md mt-2 @error('sales') is-invalid @enderror" id="colFormLabelNamaSales" placeholder="Nama Sales" name="sales" value="{{ $sales }}">
                                                @error('sales')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                          </div>
                                        </div>
                                      {{-- end Hide div --}}
                                      {{-- Start Date --}}
                                      <div class="row mb-3">
                                       <div class="col-lg-5">
                                        <label for="dateInput" class="form-label col-form-label col-form-label-md">Target Penyelesaian  </label>
                                       </div>
                                       <div class="col-lg-7">
                                        <input type="date" class="form-control @error ('tgl_selesai') is-invalid @enderror" data-provider="flatpickr"  name="tgl_selesai" id="dateInput" placeholder=" YYYY/MM/DD" value="{{ $inv->tgl_selesai }}">
                                        @error('tgl_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                       </div>
                                      </div>
                                     {{-- End Date --}}
                                   {{-- </div> --}}
                                  </div>
                                 </div>
                                        {{-- End Customer Form --}}
                                   <!--end row-->
                             <div class="card-body p-4">
                               <table class="invoice-table  dt-responsive table table-borderless table-nowrap mb-0">
                              <div class="table-responsive">
                                <thead class="align-middle">
                                 <tr class="table-active">
                                  <th scope="col" style="width: 50px;">#</th>
                                  <th scope="col">Item</th>
                                  <th scope="col" style="min-width: 110px; width: 110px;">Satuan</th>
                                  <th scope="col" style="width: 120px;">
                                   <div class="d-flex currency-select input-light align-items-center">Harga
                                    <select class="form-selectborder-0 bg-light" data-choices data-choices-search-false id="choices-payment-currency" onchange="otherPayment()">
                                    <option value="Rp">(Rp)</option>
                                    </select>
                                   </div></th>
                                  <th scope="col" style="width: 120px;">Quantity</th>
                                  <th scope="col" class="text-center" style="width: 150px;">Jumlah Harga</th>
                                  <th scope="col" class="text-end" style="width: 105px;"></th>
                                 </tr>
                                </thead>
                                <tbody id="newlink">
                                  @foreach ($penjualan_barang as $index => $jual)
                                  @foreach ($barang[$index] as $item)
                                 <tr id="{{$index + 1}}" class="product">
                                  <th scope="row" class="product-id">{{$index + 1}}</th>
                                   <td class="text-start">
                                    <div class="mb-2">
                                      <label class="visually-hidden" for="productName">Item</label>

                                      {{-- PENAMBAHAN INDEX PADA NAME AGAR ARRAY TIDAK TERTUKAR SAAT DISUBMIT --}}
                                      <select class="form-select" data-choices data-choices-sorting="true" id="productName-{{$index+1}}" name="barang_id[{{$index}}]" >
                                          <option value="{{ $item->id }}" data-kategori-id="{{$item->kategori_id}}">{{ $item->jenis_barang }}</option>
                                          @foreach ($jenisBarang as $jns)
                                            @if ($item->id != $jns->id)
                                            <option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}">{{$jns->jenis_barang}}</option>
                                            @endif
                                          @endforeach
                                      </select>
                                  </div>
                                     <textarea class="form-control bg-light border-0" id="productDetails-{{$index+1}}" name="deskripsi_item[{{$index}}]" rows="2" placeholder="Deskripsi Item" >{{$jual->deskripsi_item}}</textarea>

                                     <!-- START KOLOM MULTI-MATERIAL (EDIT) -->
                                     <div class="material-container-{{$index}} mt-2">
                                         @php
                                             // CEK APAKAH DATA SUDAH ARRAY (Casting Model) ATAU MASIH STRING JSON
                                             $rawMatId = $jual->material_id;
                                             $matIds = is_string($rawMatId) ? json_decode($rawMatId, true) : $rawMatId;
                                             
                                             $rawMatQty = $jual->material_qty;
                                             $matQtys = is_string($rawMatQty) ? json_decode($rawMatQty, true) : $rawMatQty;
                                             
                                             $rawMatPanjang = $jual->material_panjang;
                                             $matPanjangs = is_string($rawMatPanjang) ? json_decode($rawMatPanjang, true) : $rawMatPanjang;
                                             
                                             $rawMatLebar = $jual->material_lebar;
                                             $matLebars = is_string($rawMatLebar) ? json_decode($rawMatLebar, true) : $rawMatLebar;

                                             // Fallback Jika Data Lama (bukan JSON/Array, melainkan ID string tunggal)
                                             if (!is_array($matIds) && !empty($rawMatId)) {
                                                 $matIds = [$rawMatId];
                                                 $matQtys = [$rawMatQty];
                                                 $matPanjangs = [$rawMatPanjang];
                                                 $matLebars = [$rawMatLebar];
                                             } elseif (!is_array($matIds)) {
                                                 $matIds = []; 
                                             }

                                             // Siapkan setidaknya 1 form kosong jika tidak ada material
                                             if (empty($matIds)) {
                                                 $matIds = [null];
                                             }
                                         @endphp

                                         @foreach($matIds as $matIndex => $matId)
                                             @php
                                                 $matQty = is_array($matQtys) ? ($matQtys[$matIndex] ?? '') : '';
                                                 $matPanjang = is_array($matPanjangs) ? ($matPanjangs[$matIndex] ?? '') : '';
                                                 $matLebar = is_array($matLebars) ? ($matLebars[$matIndex] ?? '') : '';
                                                 $currentMax = '';
                                                 $currentSatuan = '';
                                                 $sisaStok = '';

                                                 if ($matId && isset($materials)) {
                                                     foreach($materials as $m) {
                                                         if($m->id == $matId) {
                                                             $currentMax = $m->stok + (float)$matQty;
                                                             $currentSatuan = $m->satuan;
                                                             $sisaStok = $currentMax - (float)$matQty;
                                                             
                                                             if (floor($sisaStok) == $sisaStok) {
                                                                 $sisaStok = number_format($sisaStok, 0, '', '');
                                                             }
                                                             break;
                                                         }
                                                     }
                                                 }
                                             @endphp
                                             <div class="row mt-2 material-row border-top pt-2 position-relative">
                                                 <div class="col-md-3">
                                                     <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Pilih Material</label>
                                                     <select class="form-select form-select-sm material-select" name="material_id[{{$index}}][]">
                                                         <option value="">-- Pilih Material --</option>
                                                         @if(isset($materials))
                                                             @foreach ($materials as $mat)
                                                                 @php
                                                                     $maxStok = $mat->stok;
                                                                     $isSelected = '';
                                                                     if($matId == $mat->id) {
                                                                         $maxStok = $mat->stok + (float)$matQty;
                                                                         $isSelected = 'selected';
                                                                     }
                                                                 @endphp
                                                                 <option value="{{ $mat->id }}"
                                                                         data-stok="{{ $maxStok }}"
                                                                         data-satuan="{{ $mat->satuan }}"
                                                                         {{ $isSelected }}>
                                                                     {{ $mat->kode_material }} - {{ $mat->jenis_material }} (Max: {{ floor($maxStok) == $maxStok ? number_format($maxStok, 0, '', '') : $maxStok }})
                                                                 </option>
                                                             @endforeach
                                                         @endif
                                                     </select>
                                                 </div>
                                                 <div class="col-md-2">
                                                     <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Panjang</label>
                                                     <input type="number" step="any" class="form-control form-control-sm material-panjang" name="material_panjang[{{$index}}][]" placeholder="0" value="{{ $matPanjang }}">
                                                 </div>
                                                 <div class="col-md-2">
                                                     <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Lebar</label>
                                                     <input type="number" step="any" class="form-control form-control-sm material-lebar" name="material_lebar[{{$index}}][]" placeholder="0" value="{{ $matLebar }}">
                                                 </div>
                                                 <div class="col-md-2">
                                                     <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Hasil</label>
                                                     <input type="number" step="any" class="form-control form-control-sm material-qty" name="material_qty[{{$index}}][]" placeholder="0" min="0" max="{{ $currentMax }}" value="{{ $matQty }}">
                                                     <span class="text-danger fw-medium sisa-stok-info" style="font-size: 0.75rem; {{ $matId ? '' : 'display: none;' }}">Sisa: <span class="sisa-stok-angka">{{ $sisaStok }}</span></span>
                                                 </div>
                                                 <div class="col-md-2">
                                                     <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Satuan</label>
                                                     <input type="text" class="form-control form-control-sm material-satuan bg-light" name="material_satuan[{{$index}}][]" value="{{ $currentSatuan }}" readonly>
                                                 </div>
                                                 <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-sm btn-soft-danger btn-hapus-material"><i class="las la-times"></i></button>
                                                 </div>
                                             </div>
                                         @endforeach
                                     </div>
                                     <div class="mt-2 text-end">
                                         <button type="button" class="btn btn-sm btn-soft-info btn-tambah-material" data-index="{{$index}}"><i class="las la-plus"></i> Tambah Material</button>
                                     </div>
                                     <!-- END KOLOM MULTI-MATERIAL (EDIT) -->

                                   </td>
                                   <td>
                                    <select class="form-select bg-light border-0" style="min-width: 95px;" id="satuan-{{$index+1}}" name="satuan[{{$index}}]" required>
                                    
                                    <option value="{{$jual->satuan}}"selected>{{$jual->satuan}}</option>
                                    @foreach(['Pcs', 'Set', 'Und', 'Blok', 'Rim', 'Lbr', 'Ktk', 'Unit', 'Kg', 'Lainnya', 'Pax'] as $option)
                                        @if($option !== $jual->satuan)
                                            <option value="{{$option}}">{{$option}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                   </td>
                                   <td>
                                    <input type="text" class="form-control product-price bg-light border-0" id="productRate-{{$index+1}}" name="hrg[{{$index}}]" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' placeholder="0" onchange="autoCalc(this)" value="{{ number_format($jual->hargaBarang, 0, ',', '.') }}" required/>
                                    </td>
                                    <td>
                                     <div class="input-step">
                                      <input type="number" class="text-center" id="product-qty-{{$index+1}}" value="{{$jual->qty}}" name="qty[{{$index}}]" onchange="autoCalc(this)">
                                     </div>
                                    </td>
                                    <td class="text-end">
                                     <div>
                                      <input type="text" class="form-control bg-light border-0 product-line-price" id="productPrice-{{$index+1}}" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' name="jlh_hrg[{{$index}}]" placeholder="0" value="{{ number_format($jual->jumlah_harga, 0, ',', '.') }}" onchange="autoCalc(this)" readonly/>
                                     </div>
                                    </td>
                                    <td class="product-removal"><a href="javascript:void(0)" class="btn btn-success">Delete</a>
                                    </td>
                                   </tr>
                                   @endforeach
                                   @endforeach
                                  </tbody>

                                  <tbody>
                                   <tr id="newForm" style="display: none;">
                                    <td class="d-none" colspan="5"><p>Add New Form</p>
                                    </td>
                                   </tr>
                                   <tr>
                                    <td colspan="2"><a href="javascript:new_link()" id="add-item" class="btn btn-soft-secondary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                    </td>
                                   </tr>
                                  </tbody>
                                 </table>
                                 <!--end table-->
                                 {{-- Start detail Payment --}}
                                <div class="col-lg-4">
                                  <div class="col-lg-12"></div>
                                </div>
                                <div class="col-lg-8">
                                  <div class="row mb-1">
                                    <div class="col-lg-4">
                                    <label for="jenisPembayaran" class="form-label col-form-label col-form-label-md">Jenis Pembayaran</label>
                                    </div>
                                      <div class="col-lg-6">
                                        <select class="form-control bg-light border-0 @error('jns_pem') is-invalid @enderror" data-choices data-choices-search-false data-choices-removeItem id="choices-payment-type" name="jns_pem">
                                          <option selected value="{{ $inv->jenis_pembayaran }}">{{ $inv->jenis_pembayaran }}</option>
                                          @foreach (['Cash Lunas', 'Cash Belum Lunas', 'Transfer DP', 'Transfer Lunas', 'PO'] as $option)
                                            @if ($option !== $inv->jenis_pembayaran)
                                              <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                          @endforeach
                                        </select>

                                        @error('jns_pem')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                    </div>
                                    <div class="row mb-2 col-lg-12">
                                      <div class="col lg-12" style="{{ ($inv->no_rek !== null) ? 'display: block' : 'display: none' }};">
                                        <div class="bank-account-badge mb-2" id="alamatPembayaran">
                                          <span class="badge-dot-green"></span>
                                          <input class="d-none" type="radio" name="norek" id="flexRadioDefault1" value="BNI" {{ ($inv->no_rek ==='BNI') ? 'checked' : '' }}>
                                          <span class="bank-account-text fs-12 fw-semibold">
                                            {{ $inv->norek_text }}
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                  <div class="row mb-1">
                                    <div class="col-lg-4">
                                    <label for="total-harga" class="form-label col-form-label col-form-label-md">Jumlah Harga</label>
                                    </div>
                                      <div class="col-lg-6">
                                        <input type="text" class="form-control bg-light border-0" rows="1" naplaceholder="" id="total-harga" name ="tot_harga" value="{{ number_format($inv->total_harga, 0, ',', '.') }}" readonly>
                                      </div>
                                    </div>
                                    {{-- Input untuk Dp --}}
                                    <div class="row mb-1" id="div-dp-row" style="{{ ($inv->jenis_pembayaran === 'Transfer DP' || $inv->jenis_pembayaran === 'Cash Belum Lunas' || !empty($inv->dp)) ? 'display: flex' : 'display: none' }};">
                                      <div class="col-lg-4" id="div-label" style="display: block" >
                                        <label for="dp" class="form-label col-form-label col-form-label-md mb-0" id="label-dp">DP (70%)</label>
                                        <small class="text-muted d-block" style="font-size: 11px;">(Default 70%, opsional / dapat dikosongkan)</small>
                                      </div>
                                      <div class="col-lg-6" id="dp" style="display: block;">
                                        @if (!empty($inv->dp))
                                          <input id="input-dp" name="dp" type="text" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }'  class="form-control bg-light border-0" rows="1" placeholder="0 (Boleh kosong)" value="{{ number_format($inv->dp, 0, ',', '.') }}">
                                        @else
                                          <input id="input-dp" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' name="dp" type="text" class="form-control bg-light border-0" rows="1" placeholder="0 (Boleh kosong)" value="0">
                                        @endif
                                      </div>

                                      </div>
                                      {{-- End Input --}}
                                  <div class="row mb-1">
                                     <div class="col-lg-4">
                                     <label for="potongan" class="form-label col-form-label col-form-label-md">Diskon/Potongan/PPN</label>
                                     </div>
                                       <div class="col-lg-6">
                                         <select class="form-control bg-light border-0" name="select_potongan" data-choices data-choices-search-false data-choices-removeItem id="choices-potongan">
                                           <option value="-" {{ $inv->diskon || $inv->potongan != 0|| $inv->ppn ? '' : 'selected' }}>-</option>
                                           <option value="Diskon" {{ $inv->diskon ? 'selected' : '' }}>Diskon (%)</option>
                                           <option value="Potongan" {{ $inv->potongan ? 'selected' : '' }}>Spesial Diskon (Rp)</option>
                                           <option value="PPN" {{ $inv->ppn ? 'selected' : '' }}>PPN (%)</option>
                                         </select>
                                       </div>
                                     </div>
                                  <div class="row mb-1"  >
                                    <div class="col-lg-4" >
                                    </div>
                                    <div class="col-lg-6" id="harga-potongan" style="display: block;">
                                      <input id="input-potongan" type="text" class="form-control bg-light border-0" rows="1" name="biaya_lain" value="{{ $inv->diskon ? $inv->diskon : ($inv->potongan != 0 ? $inv->potongan : $inv->ppn) }}" placeholder="Rp. 0,000" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' >
                                    </div>
                                    </div>
                                    <div class="row mb-1">
                                    <div class="col-lg-4">
                                    <label for="totalPembayaran" class="form-label col-form-label col-form-label-md">Total Pembayaran</label>
                                    </div>
                                      <div class="col-lg-6">
                                        <input type="text" class="form-control bg-light border-0" rows="1" placeholder="Total Pembayaran" id="total-pembelian" name="tot_pem" value="{{ old('tot_pem', number_format($inv->total_pembayaran, 0, ',', '.')) }}" readonly>
                                      </div>
                                    </div>
                                    <div class="row mb-1">
                                    <div class="col-lg-4">
                                    <label for="sisaPembayaran" class="form-label col-form-label col-form-label-md">Sisa Pembayaran</label>
                                    </div>
                                      <div class="col-lg-6">
                                        <input type="text" class="form-control bg-light border-0" rows="1" placeholder="Sisa Pembayaran" id="sisa-pembayaran" name="sisa_pem" value="{{ ($inv->status == 'Lunas' || $inv->jenis_pembayaran == 'Cash Lunas' || $inv->jenis_pembayaran == 'Transfer Lunas') ? '0' : number_format($inv->sisa_pembayaran, 0, ',', '.') }}" readonly>
                                      </div>
                                    </div>
                                </div>
                               </div>
                               <!--end row-->
                               <div class="hstack gap-2 justify-content-start d-print-none mt-4">
                                <button type="submit" id="update" class="btn btn-info"><i class="ri-printer-line align-bottom me-1"></i>Update</button>
                                <button type="button" id="btn-save-draft" class="btn btn-warning"><i class="ri-draft-line align-bottom me-1"></i>Simpan Draf</button>
                                <button type="button" id="btn-reset-draft" class="btn btn-outline-danger"><i class="ri-delete-bin-line align-bottom me-1"></i>Reset Draf</button>
                                <a href="{{ route('daftar_invoice') }}" class="btn btn-secondary btn-cancel-ibekami"><i class="ri-close-line align-bottom me-1"></i>Batal</a>
                               </div>
                             </div>
                            </form>
                           </div>
                          </div>
                         </div>
                        </div>
                        <!--end col-->
                      </div>
                    <!--end row-->
                <!-- container-fluid -->

              {{-- @extends('layout.vendor-script') --}}
<script>
  // var jenisBarang = @json($jenisBarang);
</script>

{!! JsValidator::formRequest('App\Http\Requests\InvoiceRequest') !!}
@endsection

@section('plugins')
<!-- dropzone min -->
<script src="{{asset('libs/dropzone/dropzone-min.js')}}"></script>

<!-- cleave.js -->
<script src="{{asset('libs/cleave.js/cleave.min.js')}}"></script>


<!-- Sweet Alerts js -->
<script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>

{{-- choices.js & flatpickr --}}
<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{asset('js/halaman/update-invoice.js')}}"></script>
<script src="{{asset('js/halaman/invoice.js')}}"></script>
<script src="{{asset('js/halaman/draft-invoice-ibekami.js')}}"></script>

<script>
    // Logic untuk Material Dropdown (Auto-fill Satuan, Validasi Stok & Tampilkan Sisa Awal)
    $(document).on('change', '.material-select', function() {
        var selectedOption = $(this).find(':selected');
        var satuan = selectedOption.data('satuan');
        var stok = selectedOption.data('stok'); // Stok riil maksimum yg bisa diambil
        
        // Cari input terkait dalam row yang sama
        var row = $(this).closest('.material-row'); 
        row.find('.material-satuan').val(satuan);
        row.find('.material-qty').attr('max', stok);
        row.find('.material-qty').val(''); // Reset qty saat ganti material
        
        // Tampilkan label sisa stok tanpa nol tidak penting
        if(stok !== undefined && stok !== "") {
            row.find('.sisa-stok-info').show();
            row.find('.sisa-stok-angka').text(parseFloat(stok));
        } else {
            row.find('.sisa-stok-info').hide();
        }
    });

    function calcEditMaterialQty(row) {
        var panjang = parseFloat(row.find('.material-panjang').val());
        var lebar = parseFloat(row.find('.material-lebar').val());
        var productRow = row.closest('tr.product');
        if (!productRow.length) {
            productRow = row.closest('tr');
        }
        var itemQty = parseFloat(productRow.find('input[name="qty[]"], [id^="product-qty-"]').val()) || 1;

        if (!isNaN(panjang) && !isNaN(lebar)) {
            var hasil = (panjang * lebar) * itemQty;
            row.find('.material-qty').val(parseFloat(hasil.toFixed(4))).trigger('input');
        } else if (!isNaN(panjang)) {
            var hasil = panjang * itemQty;
            row.find('.material-qty').val(parseFloat(hasil.toFixed(4))).trigger('input');
        }
    }

    // Auto Hitung "Hasil" berdasarkan input Panjang, Lebar, dan Quantity
    $(document).on('input', '.material-panjang, .material-lebar', function() {
        calcEditMaterialQty($(this).closest('.material-row'));
    });

    $(document).on('input change', 'input[name="qty[]"], [id^="product-qty-"]', function() {
        var productRow = $(this).closest('tr.product');
        if (!productRow.length) {
            productRow = $(this).closest('tr');
        }
        productRow.find('.material-row').each(function() {
            calcEditMaterialQty($(this));
        });
    });

    // Validasi Qty/Hasil Input tidak boleh melebihi stok & Update Angka Sisa Secara Realtime
    $(document).on('input', '.material-qty', function() {
        var max = parseFloat($(this).attr('max'));
        var val = parseFloat($(this).val()) || 0; // Jika kosong anggap 0
        var row = $(this).closest('.material-row');
        
        if (!isNaN(max)) {
            if (val > max) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Kurang',
                    text: 'Jumlah material (Hasil) melebihi stok (Maksimal: ' + parseFloat(max) + ')',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $(this).val(parseFloat(max));
                val = max; // Set val ke max agar sisa tidak minus
            }
            
            // Hitung dan update tampilan sisa. ParseFloat membunuh angka nol di belakang koma (misal: 10.00 -> 10)
            var sisa = max - val;
            row.find('.sisa-stok-angka').text(parseFloat(sisa.toFixed(4))); 
        }
    });

    // 1. BUAT MAPPING MATERIAL REQUIRED DI JAVASCRIPT
    const isMaterialRequiredMap = {};
    @if(isset($jenisBarang))
        @foreach ($jenisBarang as $jns)
            isMaterialRequiredMap["{{$jns->id}}"] = "{{$jns->is_material_required ?? 0}}";
        @endforeach
    @endif

    function updateMaterialVisibility($select) {
        var selectedBarangId = $select.val();
        var td = $select.closest('td');
        var materialContainers = td.find('.materials-container, [class*="material-container-"], .material-row');
        var tambahBtn = td.find('.add-material, .btn-tambah-material');
        var isNonMaterial = (isMaterialRequiredMap[selectedBarangId] == "1"); // ON = Non-Material

        if (isNonMaterial) {
            materialContainers.hide();
            tambahBtn.hide();
            materialContainers.find('select.material-select').val('');
            materialContainers.find('input.material-panjang, input.material-lebar, input.material-qty').val('');
        } else {
            materialContainers.show();
            tambahBtn.show();
        }
    }

    $(document).on('change', 'select[name^="barang_id"]', function() {
        updateMaterialVisibility($(this));
    });

    setTimeout(function() {
        $('select[name^="barang_id"]').each(function() {
            updateMaterialVisibility($(this));
        });
    }, 200);

    // Script Tambah Form Row Material Secara Dinamis dalam 1 Barang
    $(document).on('click', '.btn-tambah-material', function() {
        var index = $(this).data('index');
        var container = $(this).closest('td').find('.material-container-' + index);
        
        var materialOptions = '<option value="">-- Pilih Material --</option>';
        @if(isset($materials))
            @foreach($materials as $mat)
                materialOptions += `<option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">{{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok Max: {{ floor($mat->stok) == $mat->stok ? number_format($mat->stok, 0, '', '') : $mat->stok }})</option>`;
            @endforeach
        @endif

        var newRow = `
            <div class="row mt-2 material-row border-top pt-2 position-relative">
                <div class="col-md-3">
                    <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Pilih Material</label>
                    <select class="form-select form-select-sm material-select" name="material_id[${index}][]">
                        ${materialOptions}
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Panjang</label>
                    <input type="number" step="any" class="form-control form-control-sm material-panjang" name="material_panjang[${index}][]" placeholder="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Lebar</label>
                    <input type="number" step="any" class="form-control form-control-sm material-lebar" name="material_lebar[${index}][]" placeholder="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Hasil</label>
                    <input type="number" step="any" class="form-control form-control-sm material-qty" name="material_qty[${index}][]" placeholder="0" min="0">
                    <span class="text-danger fw-medium sisa-stok-info" style="font-size: 0.75rem; display: none;">Sisa: <span class="sisa-stok-angka">0</span></span>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Satuan</label>
                    <input type="text" class="form-control form-control-sm material-satuan bg-light" name="material_satuan[${index}][]" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-soft-danger btn-hapus-material"><i class="las la-times"></i></button>
                </div>
            </div>
        `;
        container.append(newRow);
    });

    // Menghapus baris form material
    $(document).on('click', '.btn-hapus-material', function() {
        $(this).closest('.material-row').remove();
    });


    // OVERRIDE FUNGSI new_link DARI update-invoice.js / tabel-item.js
    var count = document.querySelectorAll('#newlink tr.product').length;
    
    window.new_link = function() {
        count++; // count digunakan sebagai KEY index Array
        var tr = document.createElement("tr");
        tr.id = count;
        tr.className = "product";
        
        // 1. Siapkan Opsi Material (dari PHP ke JS)
        var materialOptions = '<option value="">-- Pilih Material --</option>';
        @if(isset($materials))
            @foreach($materials as $mat)
                materialOptions += `<option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">{{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok Max: {{ floor($mat->stok) == $mat->stok ? number_format($mat->stok, 0, '', '') : $mat->stok }})</option>`;
            @endforeach
        @endif

        // 2. Siapkan Opsi Item Barang (dari PHP ke JS)
        var itemOptions = '<option selected disabled>Pilih Item</option>';
        @foreach($jenisBarang as $jns)
             itemOptions += `<option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}">{{$jns->jenis_barang}}</option>`;
        @endforeach

        // 3. Template HTML Baris Baru dengan format Indexing [count] yang benar
        var template = `
            <th scope="row" class="product-id">${count}</th>
            <td class="text-start">
                <div class="mb-2">
                    <select class="form-select" name="barang_id[${count}]" id="productName-${count}">
                        ${itemOptions}
                    </select>
                </div>
                <textarea class="form-control bg-light border-0" id="productDetails-${count}" name="deskripsi_item[${count}]" rows="2" placeholder="Deskripsi Item"></textarea>
                
                <!-- KOLOM MULTI MATERIAL DI ITEM BARU -->
                <div class="material-container-${count} mt-2">
                    <div class="row mt-2 material-row border-top pt-2 position-relative">
                         <div class="col-md-3">
                            <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Pilih Material</label>
                            <select class="form-select form-select-sm material-select" name="material_id[${count}][]">
                                ${materialOptions}
                            </select>
                         </div>
                         <div class="col-md-2">
                            <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Panjang</label>
                            <input type="number" step="any" class="form-control form-control-sm material-panjang" name="material_panjang[${count}][]" placeholder="0">
                         </div>
                         <div class="col-md-2">
                            <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Lebar</label>
                            <input type="number" step="any" class="form-control form-control-sm material-lebar" name="material_lebar[${count}][]" placeholder="0">
                         </div>
                         <div class="col-md-2">
                            <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Hasil</label>
                            <input type="number" step="any" class="form-control form-control-sm material-qty" name="material_qty[${count}][]" placeholder="0" min="0">
                            <span class="text-danger fw-medium sisa-stok-info" style="font-size: 0.75rem; display: none;">Sisa: <span class="sisa-stok-angka">0</span></span>
                         </div>
                         <div class="col-md-2">
                            <label class="form-label text-muted mb-1" style="font-size: 0.8rem;">Satuan</label>
                            <input type="text" class="form-control form-control-sm material-satuan bg-light" name="material_satuan[${count}][]" readonly>
                         </div>
                         <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-soft-danger btn-hapus-material"><i class="las la-times"></i></button>
                         </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button type="button" class="btn btn-sm btn-soft-info btn-tambah-material" data-index="${count}"><i class="las la-plus"></i> Tambah Material</button>
                </div>
            </td>
            <td>
                <select class="form-select bg-light border-0" style="min-width: 95px;" name="satuan[${count}]" id="satuan-${count}" required>
                    <option value="">Pilih</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Set">Set</option>
                    <option value="Und">Und</option>
                    <option value="Blok">Blok</option>
                    <option value="Rim">Rim</option>
                    <option value="Lbr">Lbr</option>
                    <option value="Ktk">Ktk</option>
                    <option value="Unit">Unit</option>
                    <option value="Kg">Kg</option>
                    <option value="Lainnya">Lainnya</option>
                    <option value="Pax">Pax</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control product-price bg-light border-0" id="productRate-${count}" name="hrg[${count}]" placeholder="Rp. 0.000" onchange="autoCalc(this)" required />
            </td>
            <td>
                <div class="input-step">
                    <input type="number" class="text-center" id="product-qty-${count}" value="1" name="qty[${count}]" onchange="autoCalc(this)">
                </div>
            </td>
            <td class="text-end">
                <div>
                    <input type="text" class="form-control bg-light border-0 product-line-price" id="productPrice-${count}" name="jlh_hrg[${count}]" placeholder="Rp.0.000" readonly />
                </div>
            </td>
            <td class="product-removal">
                <a href="javascript:void(0)" class="btn btn-success">Delete</a>
            </td>
        `;

        tr.innerHTML = template;
        document.getElementById("newlink").appendChild(tr);

        // Init Cleave.js untuk input harga yang baru
        if (typeof Cleave !== 'undefined') {
             new Cleave(`#productRate-${count}`, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        let dateField = document.getElementById("date-field");
        let timeField = document.getElementById("time-field");
        if (typeof flatpickr !== 'undefined') {
            if (dateField) {
                flatpickr(dateField, {
                    dateFormat: "Y-m-d",
                    allowInput: true
                });
            }
            if (timeField) {
                flatpickr(timeField, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true,
                    allowInput: true,
                    defaultDate: timeField.value || "{{ $jam }}"
                });
            }
        function checkAdminSignature() {
            var adminSelect = document.getElementById('choices-admin');
            var alertContainer = document.getElementById('admin-signature-alert');
            if (!adminSelect || !alertContainer) return;
            
            var selectedOption = adminSelect.options[adminSelect.selectedIndex];
            if (!selectedOption || !selectedOption.value) {
                alertContainer.style.display = 'none';
                alertContainer.innerHTML = '';
                return;
            }
            
            var hasSig = selectedOption.getAttribute('data-has-signature') === '1';
            var adminName = selectedOption.getAttribute('data-admin-name') || selectedOption.text;
            
            if (hasSig) {
                alertContainer.style.display = 'block';
                alertContainer.innerHTML = `
                    <div class="d-flex align-items-center text-success py-1 px-2 rounded mt-1" style="background-color: rgba(25, 135, 84, 0.1); border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.82rem;">
                        <i class="ri-checkbox-circle-fill me-2 fs-6 text-success"></i>
                        <span>Tanda tangan digital <strong>${adminName}</strong> tersedia & akan otomatis tampil saat invoice Lunas.</span>
                    </div>
                `;
            } else {
                alertContainer.style.display = 'block';
                alertContainer.innerHTML = `
                    <div class="d-flex align-items-center text-warning py-1 px-2 rounded mt-1" style="background-color: rgba(255, 193, 7, 0.1); border: 1px solid rgba(255, 193, 7, 0.3); font-size: 0.82rem;">
                        <i class="ri-alert-fill me-2 fs-6 text-warning"></i>
                        <span><strong>Perhatian:</strong> Admin <strong>${adminName}</strong> belum memiliki tanda tangan digital. Invoice tidak akan menampilkan tanda tangan digital sebelum diunggah di menu Karyawan.</span>
                    </div>
                `;
            }
        }

        var adminSelectEl = document.getElementById('choices-admin');
        if (adminSelectEl) {
            adminSelectEl.addEventListener('change', checkAdminSignature);
            checkAdminSignature();
        }

        // Initialize Theme Synchronization
        initInvoiceTheme();
    });

    // Theme Management (Synchronized with Dashboard & Daftar Invoice)
    function initInvoiceTheme() {
        var savedTheme = 'dark';
        try {
            savedTheme = localStorage.getItem('ibekami_dash_theme') || (document.body.classList.contains('theme-light') ? 'light' : 'dark');
        } catch(e) {
            savedTheme = 'dark';
        }
        applyThemeDOM(savedTheme);
    }

    function applyThemeDOM(theme) {
        var isLight = theme === 'light';
        if (document.body) {
            document.body.classList.toggle('theme-light', isLight);
            document.body.classList.toggle('theme-dark', !isLight);
        }
        document.documentElement.classList.toggle('theme-light', isLight);
        document.documentElement.classList.toggle('theme-dark', !isLight);
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.setAttribute('data-layout-mode', theme);
        document.documentElement.setAttribute('data-sidebar', isLight ? 'light' : 'dark');
        try {
            localStorage.setItem('ibekami_dash_theme', theme);
            sessionStorage.setItem('data-layout-mode', theme);
            sessionStorage.setItem('data-sidebar', isLight ? 'light' : 'dark');
        } catch(e) {}

        var btnText = document.getElementById('theme-toggle-text');
        var btnIcon = document.getElementById('theme-toggle-icon');
        if (btnText) btnText.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
        if (btnIcon) {
            btnIcon.className = isLight ? 'ri-moon-line fs-14' : 'ri-sun-line fs-14';
        }
    }

    var isThemeTransitioning = false;
    function toggleDashboardTheme(event) {
        if (isThemeTransitioning) return;
        isThemeTransitioning = true;

        var current = 'dark';
        try {
            current = localStorage.getItem('ibekami_dash_theme') || (document.body.classList.contains('theme-light') ? 'light' : 'dark');
        } catch (e) {
            current = document.body.classList.contains('theme-light') ? 'light' : 'dark';
        }
        var targetTheme = current === 'light' ? 'dark' : 'light';

        var supportsViewTransition = typeof document.startViewTransition === 'function';
        var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!supportsViewTransition || prefersReducedMotion) {
            applyThemeDOM(targetTheme);
            try {
                localStorage.setItem('ibekami_dash_theme', targetTheme);
            } catch(e) {}
            isThemeTransitioning = false;
            return;
        }

        var btn = document.getElementById('btn-theme-toggle');
        if (btn) btn.classList.add('theme-switching');

        var x = window.innerWidth / 2;
        var y = window.innerHeight / 2;
        if (event && event.clientX && event.clientY) {
            x = event.clientX;
            y = event.clientY;
        } else if (btn) {
            var rect = btn.getBoundingClientRect();
            x = rect.left + rect.width / 2;
            y = rect.top + rect.height / 2;
        }

        var endRadius = Math.hypot(
            Math.max(x, window.innerWidth - x),
            Math.max(y, window.innerHeight - y)
        );

        try {
            var transition = document.startViewTransition(function() {
                applyThemeDOM(targetTheme);
                try {
                    localStorage.setItem('ibekami_dash_theme', targetTheme);
                } catch(e) {}
            });

            if (transition && typeof transition.ready !== 'undefined') {
                Promise.resolve(transition.ready).then(function() {
                    document.documentElement.animate(
                        {
                            clipPath: [
                                'circle(0px at ' + x + 'px ' + y + 'px)',
                                'circle(' + endRadius + 'px at ' + x + 'px ' + y + 'px)'
                            ]
                        },
                        {
                            duration: 500,
                            easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
                            pseudoElement: '::view-transition-new(root)'
                        }
                    ).finished.finally(function() {
                        if (btn) btn.classList.remove('theme-switching');
                        isThemeTransitioning = false;
                    });
                }).catch(function() {
                    if (btn) btn.classList.remove('theme-switching');
                    isThemeTransitioning = false;
                });
            } else {
                if (btn) btn.classList.remove('theme-switching');
                isThemeTransitioning = false;
            }
        } catch (err) {
            applyThemeDOM(targetTheme);
            try {
                localStorage.setItem('ibekami_dash_theme', targetTheme);
            } catch(e) {}
            if (btn) btn.classList.remove('theme-switching');
            isThemeTransitioning = false;
        }
    }
</script>
@endsection