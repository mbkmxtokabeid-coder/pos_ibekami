@section('head')
<!-- dropzone css -->
<link rel="stylesheet" href="{{asset('libs/dropzone/dropzone.css')}}" type="text/css" />
<!-- Sweet Alert css-->
<link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<!-- flatpickr css -->
<link rel="stylesheet" href="{{asset('libs/flatpickr/flatpickr.min.css')}}" type="text/css" />

<style>
/* ==========================================================================
   UI/UX PRO MAX - TOKABE/IBEKAMI INVOICE FORM (High Visibility & Accessibility)
   WCAG AA/AAA compliant contrast ratios (7:1+), pristine alignment, zero clutter
   ========================================================================== */

/* View Transition API Circular Reveal Styles */
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
.inv-main-card,
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
.inv-main-card::-webkit-scrollbar,
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
.choices.is-open {
    position: relative !important;
    z-index: 9999 !important;
}
.choices.is-flipped .choices__list--dropdown,
.choices.is-flipped .choices__list[aria-expanded] {
    top: 100% !important;
    bottom: auto !important;
    margin-top: 4px !important;
    margin-bottom: 0 !important;
}
.choices__list--dropdown .choices__list,
.choices__list[aria-expanded] .choices__list {
    max-height: 260px !important;
    overflow-y: auto !important;
}
.table-responsive:has(.choices.is-open),
.inv-main-card:has(.choices.is-open),
.card:has(.choices.is-open),
.card-body:has(.choices.is-open) {
    overflow: visible !important;
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

/* Page Title Heading */
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

/* Flatpickr Calendar - Solid Opaque Warm Obsidian Theme */
.flatpickr-calendar {
    background: #181411 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 12px !important;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
    z-index: 999999 !important;
    font-family: inherit !important;
    overflow: hidden !important;
}
.flatpickr-calendar::before,
.flatpickr-calendar::after {
    border-bottom-color: #14100D !important;
}
.flatpickr-months {
    background: #14100D !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding: 6px 0 !important;
}
.flatpickr-months .flatpickr-month {
    color: #FAFAFA !important;
    fill: #FAFAFA !important;
    height: 38px !important;
}
.flatpickr-current-month {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #FAFAFA !important;
    padding-top: 4px !important;
}
.flatpickr-current-month .cur-month {
    color: #FAFAFA !important;
    font-weight: 700 !important;
}
.flatpickr-current-month input.cur-year {
    color: #FAFAFA !important;
    font-weight: 700 !important;
}
.flatpickr-months .flatpickr-prev-month,
.flatpickr-months .flatpickr-next-month {
    color: #FAFAFA !important;
    fill: #FAFAFA !important;
    padding: 6px 10px !important;
}
.flatpickr-months .flatpickr-prev-month:hover svg,
.flatpickr-months .flatpickr-next-month:hover svg {
    fill: #F59E0B !important;
}
span.flatpickr-weekday {
    background: #14100D !important;
    color: #A1A1AA !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    text-transform: none !important;
    letter-spacing: normal !important;
}
.flatpickr-weekdays {
    background: #14100D !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    height: 32px !important;
}
.flatpickr-days {
    background: #181411 !important;
    width: 100% !important;
}
.dayContainer {
    background: #181411 !important;
    padding: 6px 4px !important;
    min-width: 100% !important;
    max-width: 100% !important;
}
.flatpickr-day {
    color: #FAFAFA !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    font-size: 13.5px !important;
    border: 1px solid transparent !important;
    transition: all 0.15s ease !important;
    margin: 1px 0 !important;
}
.flatpickr-day:hover {
    background: rgba(245, 158, 11, 0.22) !important;
    border-color: rgba(245, 158, 11, 0.45) !important;
    color: #FFFFFF !important;
}
.flatpickr-day.selected,
.flatpickr-day.selected:hover {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    border-color: #F59E0B !important;
    color: #1A0F05 !important;
    font-weight: 700 !important;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4) !important;
}
.flatpickr-day.today {
    border-color: #F59E0B !important;
    color: #F59E0B !important;
    font-weight: 700 !important;
}
.flatpickr-day.today:hover {
    background: rgba(245, 158, 11, 0.25) !important;
    color: #FFFFFF !important;
}
.flatpickr-day.prevMonthDay,
.flatpickr-day.nextMonthDay {
    color: #71717A !important;
}
.flatpickr-day.prevMonthDay:hover,
.flatpickr-day.nextMonthDay:hover {
    background: rgba(255, 255, 255, 0.05) !important;
    color: #A1A1AA !important;
}
.flatpickr-day.flatpickr-disabled,
.flatpickr-day.flatpickr-disabled:hover {
    color: #52525B !important;
}
.flatpickr-calendar .numInputWrapper span.arrowUp:after {
    border-bottom-color: #FAFAFA !important;
}
.flatpickr-calendar .numInputWrapper span.arrowDown:after {
    border-top-color: #FAFAFA !important;
}
.flatpickr-calendar .numInputWrapper:hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

/* Flatpickr Calendar (Light Mode) */
body.theme-light .flatpickr-calendar {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12) !important;
}
body.theme-light .flatpickr-months {
    background: #F8FAFC !important;
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .flatpickr-months .flatpickr-month {
    color: #0F172A !important;
    fill: #0F172A !important;
}
body.theme-light .flatpickr-current-month,
body.theme-light .flatpickr-current-month .cur-month,
body.theme-light .flatpickr-current-month input.cur-year {
    color: #0F172A !important;
}
body.theme-light .flatpickr-months .flatpickr-prev-month,
body.theme-light .flatpickr-months .flatpickr-next-month {
    color: #64748B !important;
    fill: #64748B !important;
}
body.theme-light .flatpickr-months .flatpickr-prev-month:hover svg,
body.theme-light .flatpickr-months .flatpickr-next-month:hover svg {
    fill: #EA580C !important;
}
body.theme-light span.flatpickr-weekday {
    background: #F8FAFC !important;
    color: #64748B !important;
}
body.theme-light .flatpickr-weekdays {
    background: #F8FAFC !important;
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .flatpickr-days,
body.theme-light .dayContainer {
    background: #FFFFFF !important;
}
body.theme-light .flatpickr-day {
    color: #1E293B !important;
}
body.theme-light .flatpickr-day:hover {
    background: #FFF7ED !important;
    border-color: #FDBA74 !important;
    color: #C2410C !important;
}
body.theme-light .flatpickr-day.selected,
body.theme-light .flatpickr-day.selected:hover {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    border-color: #EA580C !important;
    color: #FFFFFF !important;
}
body.theme-light .flatpickr-day.today {
    border-color: #EA580C !important;
    color: #EA580C !important;
}
body.theme-light .flatpickr-day.prevMonthDay,
body.theme-light .flatpickr-day.nextMonthDay {
    color: #94A3B8 !important;
}

/* Main Card Container (Solid Dark & Light Surface) */
.inv-main-card {
    background: #14110F !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 14px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35) !important;
    overflow: hidden;
}
body.theme-light .inv-main-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
}

/* Form Labels - High Contrast & Visibility */
.inv-form-label {
    color: #FAFAFA !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    margin-bottom: 6px;
    letter-spacing: 0.2px;
}
.col-form-label.inv-form-label {
    margin-bottom: 0;
    padding-top: 8px;
    padding-bottom: 8px;
}
.inv-required-mark {
    color: #f87171 !important;
    font-weight: 700 !important;
    margin-left: 2px;
}
body.theme-light .inv-form-label {
    color: #1E293B !important;
}

/* Interactive Controls (Editable Inputs, Selects, Textareas) - Warm Obsidian */
.inv-dark-control {
    background-color: rgba(18, 14, 10, 0.85) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #FAFAFA !important;
    border-radius: 8px !important;
    font-size: 13.5px !important;
    height: 40px !important;
    transition: all 0.15s ease-in-out !important;
}
.inv-dark-control:hover {
    border-color: rgba(245, 158, 11, 0.4) !important;
}
.inv-dark-control:focus {
    background-color: rgba(24, 18, 14, 0.96) !important;
    border-color: #F59E0B !important;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.28) !important;
    color: #FFFFFF !important;
    outline: none !important;
}
.inv-dark-control.is-invalid {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25) !important;
}
.inv-dark-control::placeholder {
    color: #71717A !important;
    opacity: 1 !important;
}
textarea.inv-dark-control {
    height: auto !important;
    min-height: 56px !important;
}

/* Controls (Light Mode) */
body.theme-light .inv-dark-control {
    background-color: #FFFFFF !important;
    border: 1px solid #CBD5E1 !important;
    color: #0F172A !important;
}
body.theme-light .inv-dark-control:hover {
    border-color: #94A3B8 !important;
}
body.theme-light .inv-dark-control:focus {
    background-color: #FFFFFF !important;
    border-color: #EA580C !important;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.2) !important;
    color: #0F172A !important;
}
body.theme-light .inv-dark-control::placeholder {
    color: #94A3B8 !important;
}

/* Select Dropdown & Options Accessibility */
select.inv-dark-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23FAFAFA' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 0.75rem center !important;
    background-size: 14px 10px !important;
    padding-right: 2rem !important;
    cursor: pointer;
}
select.inv-dark-control option {
    background-color: #181411 !important;
    color: #FAFAFA !important;
    padding: 10px 14px !important;
    font-size: 13.5px !important;
}
select.inv-dark-control option:hover,
select.inv-dark-control option:focus,
select.inv-dark-control option:checked {
    background-color: #F59E0B !important;
    color: #1A0F05 !important;
}
body.theme-light select.inv-dark-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23475569' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
}
body.theme-light select.inv-dark-control option {
    background-color: #FFFFFF !important;
    color: #0F172A !important;
}
body.theme-light select.inv-dark-control option:checked {
    background-color: #FFF7ED !important;
    color: #C2410C !important;
}

/* Readonly Inputs - Warm Obsidian Glass */
.inv-dark-control:disabled,
.inv-dark-control[readonly],
.inv-readonly {
    background-color: rgba(12, 10, 8, 0.88) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    color: #D4D4D8 !important;
    font-weight: 500 !important;
    cursor: default !important;
    user-select: all;
}
.inv-readonly.font-mono {
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace !important;
}
.inv-readonly-highlight {
    background-color: rgba(245, 158, 11, 0.08) !important;
    border: 1px solid rgba(245, 158, 11, 0.4) !important;
    color: #FBBF24 !important;
    font-family: "JetBrains Mono", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace !important;
    font-weight: 700 !important;
}
body.theme-light .inv-dark-control:disabled,
body.theme-light .inv-dark-control[readonly],
body.theme-light .inv-readonly {
    background-color: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
}
body.theme-light .inv-readonly-highlight {
    background-color: #FFF7ED !important;
    border: 1px solid #FDBA74 !important;
    color: #C2410C !important;
}

/* Addon % for PPN & PPh */
.inv-dark-addon {
    background-color: rgba(24, 20, 16, 0.9) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-left: none !important;
    color: #D4D4D8 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    padding: 0 14px !important;
}
body.theme-light .inv-dark-addon {
    background-color: #F1F5F9 !important;
    border: 1px solid #CBD5E1 !important;
    border-left: none !important;
    color: #475569 !important;
}

/* Logo Box */
.inv-logo-card {
    width: 220px;
    height: 110px;
    border: 1px solid rgba(255, 255, 255, 0.085);
    background: rgba(24, 20, 17, 0.6);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}
.inv-logo-card img {
    max-height: 85px;
    max-width: 180px;
    object-fit: contain;
}
body.theme-light .inv-logo-card {
    background: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
}

/* Table Styling */
.inv-dark-table {
    border-color: rgba(255, 255, 255, 0.06) !important;
}
.inv-dark-table thead th {
    background-color: transparent !important;
    color: #A1A1AA !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    text-transform: none !important;
    letter-spacing: normal !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.085) !important;
    padding: 12px 10px !important;
}
.inv-dark-table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
}
.inv-dark-table tbody > tr > td,
.inv-dark-table tbody > tr > th {
    vertical-align: top !important;
    padding: 12px 10px !important;
    color: #FAFAFA;
    border: none !important;
}
.inv-dark-table th.product-id,
.inv-dark-table td.product-id,
.product-id {
    vertical-align: top !important;
    padding-top: 17px !important;
    text-align: center !important;
    width: 48px !important;
    color: #ffffff !important;
}
.product-id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.22);
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}
body.theme-light .inv-dark-table thead th {
    background-color: #F8FAFC !important;
    color: #64748B !important;
    border-bottom: 1px solid #E2E8F0 !important;
}
body.theme-light .inv-dark-table tbody tr {
    border-bottom: 1px solid #F1F5F9 !important;
}
body.theme-light .inv-dark-table tbody > tr > td,
body.theme-light .inv-dark-table tbody > tr > th {
    color: #1E293B !important;
}
body.theme-light .product-id-badge {
    background: #F1F5F9 !important;
    border: 1px solid #CBD5E1 !important;
    color: #334155 !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
}

/* Material Sub-Card Box (Warm Obsidian) */
.material-box-wrapper {
    background-color: rgba(18, 14, 10, 0.9) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-left: 3px solid #F59E0B !important;
    border-radius: 8px;
    padding: 10px 12px;
    margin-top: 8px;
}
.material-box-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    padding-bottom: 4px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.material-box-title {
    font-size: 11.5px;
    font-weight: 600;
    color: #F59E0B;
    text-transform: none;
    letter-spacing: normal;
}
.btn-tambah-material {
    color: #F59E0B !important;
    transition: all 0.15s ease !important;
}
.btn-tambah-material:hover {
    color: #FBBF24 !important;
}
body.theme-light .material-box-wrapper {
    background-color: #FFFBEB !important;
    border: 1px solid #FDE68A !important;
    border-left: 3px solid #EA580C !important;
}
body.theme-light .material-box-title {
    color: #B45309 !important;
}
body.theme-light .btn-tambah-material {
    color: #EA580C !important;
}
body.theme-light .btn-tambah-material:hover {
    color: #C2410C !important;
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

/* Action Buttons */
.btn-hapus-item {
    background-color: rgba(239, 68, 68, 0.12) !important;
    border: 1px solid rgba(239, 68, 68, 0.35) !important;
    color: #f87171 !important;
    border-radius: 6px !important;
    padding: 6px 14px !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-hapus-item:hover {
    background-color: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3) !important;
}
body.theme-light .btn-hapus-item {
    background-color: #FEE2E2 !important;
    border-color: #FCA5A5 !important;
    color: #DC2626 !important;
}

.btn-add-item-custom {
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
    cursor: pointer;
}
.btn-add-item-custom:hover {
    background-color: #F59E0B !important;
    color: #1A0F05 !important;
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3) !important;
}
body.theme-light .btn-add-item-custom {
    background-color: #FFF7ED !important;
    border-color: #EA580C !important;
    color: #EA580C !important;
}
body.theme-light .btn-add-item-custom:hover {
    background-color: #EA580C !important;
    color: #FFFFFF !important;
}

.btn-save-custom {
    background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
    border: 1px solid transparent !important;
    color: #1A0F05 !important;
    border-radius: 8px !important;
    padding: 9px 26px !important;
    font-size: 13.5px !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 16px rgba(249, 115, 22, 0.4) !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-save-custom:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(249, 115, 22, 0.55) !important;
    color: #1A0F05 !important;
}
body.theme-light .btn-save-custom {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    box-shadow: 0 4px 16px rgba(234, 88, 12, 0.35) !important;
}
body.theme-light .btn-save-custom:hover {
    color: #FFFFFF !important;
}

.btn-save-draft-custom {
    background-color: rgba(245, 158, 11, 0.12) !important;
    border: 1px solid rgba(245, 158, 11, 0.35) !important;
    color: #FBBF24 !important;
    border-radius: 8px !important;
    padding: 8px 18px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-save-draft-custom:hover {
    background-color: rgba(245, 158, 11, 0.22) !important;
    border-color: #F59E0B !important;
    color: #FDE68A !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25) !important;
}
body.theme-light .btn-save-draft-custom {
    background-color: #FFFBEB !important;
    border: 1px solid #FCD34D !important;
    color: #D97706 !important;
    box-shadow: 0 1px 3px rgba(245, 158, 11, 0.08) !important;
}
body.theme-light .btn-save-draft-custom:hover {
    background-color: #FEF3C7 !important;
    border-color: #F59E0B !important;
    color: #B45309 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2) !important;
}

.btn-reset-draft-custom {
    background-color: rgba(239, 68, 68, 0.1) !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    color: #f87171 !important;
    border-radius: 8px !important;
    padding: 8px 18px !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-reset-draft-custom:hover {
    background-color: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
}
body.theme-light .btn-save-draft-custom {
    background-color: rgba(245, 158, 11, 0.12) !important;
    border: 1px solid rgba(245, 158, 11, 0.35) !important;
    color: #FBBF24 !important;
    border-radius: 8px !important;
    padding: 8px 18px !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}
.btn-save-draft-custom:hover {
    background-color: rgba(245, 158, 11, 0.22) !important;
    border-color: #F59E0B !important;
    color: #FDE68A !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25) !important;
}
body.theme-light .btn-save-draft-custom {
    background-color: #FFFBEB !important;
    border: 1px solid #FCD34D !important;
    color: #D97706 !important;
    box-shadow: 0 1px 3px rgba(245, 158, 11, 0.08) !important;
}
body.theme-light .btn-save-draft-custom:hover {
    background-color: #FEF3C7 !important;
    border-color: #F59E0B !important;
    color: #B45309 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2) !important;
}

.btn-reset-draft-custom {
    background-color: #FEE2E2 !important;
    border-color: #FCA5A5 !important;
    color: #DC2626 !important;
}

.btn-batal-custom {
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
    cursor: pointer;
}
.btn-batal-custom:hover {
    background-color: rgba(255, 255, 255, 0.14) !important;
    color: #ffffff !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
}
body.theme-light .btn-batal-custom {
    background-color: #FFFFFF !important;
    border: 1px solid #CBD5E1 !important;
    color: #475569 !important;
}
body.theme-light .btn-batal-custom:hover {
    background-color: #F1F5F9 !important;
    color: #0F172A !important;
}

/* Tanpa Harga State Class */
.table-tanpa-harga .col-header-harga,
.table-tanpa-harga .col-header-jumlah-harga,
.table-tanpa-harga .col-item-harga,
.table-tanpa-harga .col-item-jumlah-harga {
    display: none !important;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function toggleTipeHarga(tipeHarga) {
      var isTanpaHarga = (tipeHarga === 'tanpa_harga');
      var $invoiceTable = $('.invoice-table');
      var $paymentSection = $('#section-detail-pembayaran');
      var $alertTanpaHarga = $('#alert-tanpa-harga');
      var $jnsPem = $('#choices-payment-type');

      if (isTanpaHarga) {
          $invoiceTable.addClass('table-tanpa-harga');
          $paymentSection.hide();
          $alertTanpaHarga.show();

          $('input[name^="hrg"]').removeAttr('required').each(function() {
              if (!$(this).val() || $(this).val() === '') $(this).val('0');
          });
          $('input[name^="jlh_hrg"]').each(function() {
              if (!$(this).val() || $(this).val() === '') $(this).val('0');
          });
          $jnsPem.removeAttr('required');
          if (!$jnsPem.val()) {
              $jnsPem.val('Cash Lunas');
          }
          $('#total-harga').val('0');
          $('#total-pembelian').val('0');
          $('#sisa-pembayaran').val('0');

          if (window.jQuery && $.validator) {
              $('input[name^="hrg"]').each(function() {
                  try { $(this).rules('remove', 'required'); } catch(e){}
              });
              try { $jnsPem.rules('remove', 'required'); } catch(e){}
          }
      } else {
          $invoiceTable.removeClass('table-tanpa-harga');
          $paymentSection.show();
          $alertTanpaHarga.hide();

          $('input[name^="hrg"]').attr('required', 'required');
          $jnsPem.attr('required', 'required');

          if (window.jQuery && $.validator) {
              $('input[name^="hrg"]').each(function() {
                  try { $(this).rules('add', { required: true }); } catch(e){}
              });
              try { $jnsPem.rules('add', { required: true }); } catch(e){}
          }
      }
  }

  // Mapping is_material_required untuk mendeteksi barang Non-Material vs Material
    const isMaterialRequiredMap = {};
    @if(isset($jenisBarang))
        @foreach ($jenisBarang as $jns)
            isMaterialRequiredMap["{{$jns->id}}"] = "{{$jns->is_material_required ?? 0}}";
        @endforeach
    @endif

    function updateMaterialVisibility($select) {
        var selectedBarangId = $select.val();
        var td = $select.closest('td');
        var materialContainers = td.find('.materials-container');
        var tambahBtn = td.find('.btn-tambah-material, .add-material');
        var isNonMaterial = (isMaterialRequiredMap[selectedBarangId] == "1");

        if (isNonMaterial) {
            materialContainers.slideUp(150);
            tambahBtn.slideUp(150);
            materialContainers.find('select.material-select').val('').removeClass('is-invalid');
            materialContainers.find('input.material-panjang, input.material-lebar, input.material-qty').val('').removeClass('is-invalid');
        } else {
            materialContainers.slideDown(150);
            tambahBtn.slideDown(150);
        }
    }

    $(document).on('change', 'select[name^="barang_id"]', function() {
        updateMaterialVisibility($(this));
    });

    $(document).ready(function () {
    $('#loading-overlay').hide();
    $("#loading-spinner").hide();

    // Material Dropdown Change
    $(document).on('change', '.material-select', function() {
        var selectedOption = $(this).find(':selected');
        var satuan = selectedOption.data('satuan');
        var stok = selectedOption.data('stok'); 
        
        var row = $(this).closest('.material-row'); 
        row.find('.material-satuan').val(satuan);
        row.find('.material-qty').attr('max', stok);
        row.find('.material-panjang').val('');
        row.find('.material-lebar').val('');
        row.find('.material-qty').val('');

        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
    });

    $(document).on('input change', '.material-panjang, .material-lebar', function() {
        if (parseFloat($(this).val()) > 0) {
            $(this).removeClass('is-invalid');
        }
    });

    function calcMaterialQty(row) {
        var p = parseFloat(row.find('.material-panjang').val()) || 0;
        var l = parseFloat(row.find('.material-lebar').val()) || 0;

        var productRow = row.closest('tr.product');
        if (!productRow.length) {
            productRow = row.closest('tr');
        }
        var itemQty = parseFloat(productRow.find('input[name="qty[]"], [id^="product-qty-"]').val()) || 1;

        var hasil = 0;
        if (p > 0 && l > 0) {
            hasil = (p * l) * itemQty;
        } else if (p > 0 && l === 0) {
            hasil = p * itemQty;
        } else if (p === 0 && l > 0) {
            hasil = l * itemQty;
        } else {
            hasil = 1 * itemQty;
        }

        var selectedOption = row.find('.material-select option:selected');
        var stok = parseFloat(selectedOption.data('stok')) || 0;

        if (hasil > stok && selectedOption.val() !== "") {
            row.find('.material-qty').addClass('is-invalid');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Mencukupi!',
                    text: 'Kebutuhan material (' + hasil + ') melebihi stok yang tersedia (' + stok + ').',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        } else {
            row.find('.material-qty').removeClass('is-invalid');
        }

        row.find('.material-qty').val(parseFloat(hasil.toFixed(4)));
    }

    $(document).on('input change', '.material-panjang, .material-lebar', function() {
        var row = $(this).closest('.material-row');
        calcMaterialQty(row);
    });

    $(document).on('input change', 'input[name="qty[]"], [id^="product-qty-"]', function() {
        var productRow = $(this).closest('tr.product');
        productRow.find('.material-row').each(function() {
            calcMaterialQty($(this));
        });
        if (typeof autoCalc === 'function') autoCalc(this);
    });

    $(document).on('click', '.add-material, .btn-tambah-material', function() {
        var container = $(this).closest('td').find('.materials-container');
        var rowIndex = container.data('row-index') || 0;
        
        var materialOptionsDOM = document.getElementById('template-options-material');
        var materialOptions = materialOptionsDOM ? materialOptionsDOM.innerHTML : '<option value="">-- Pilih Material --</option>';

        var newMaterialRow = `
            <div class="row g-2 align-items-center material-row mt-2 pt-2 border-top border-secondary border-opacity-25">
                <div class="col-xl-4 col-lg-12">
                    <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[${rowIndex}][]" style="height: 32px !important; font-size: 12px !important;">
                        ${materialOptions}
                    </select>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="d-flex align-items-center gap-1">
                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[${rowIndex}][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                        <span class="text-muted fw-bold px-1">×</span>
                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[${rowIndex}][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-5">
                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[${rowIndex}][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                </div>
                <div class="col-xl-2 col-lg-2 col-4">
                    <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[${rowIndex}][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                </div>
                <div class="col-xl-1 col-lg-1 col-3 text-end">
                    <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            </div>
        `;
        container.append(newMaterialRow);
    });

    $(document).on('click', '.remove-material', function() {
        var container = $(this).closest('.materials-container');
        if (container.find('.material-row').length > 1) {
            $(this).closest('.material-row').remove();
        } else {
            var row = $(this).closest('.material-row');
            row.find('select').val('');
            row.find('input').val('');
        }
    });

    // Invoice selection change
    $('#choices-invoice').on('change', function () {
        var selectedOption = $(this).find('option:selected');
        var tipeHarga = selectedOption.data('tipe-harga') || 'dengan_harga';
        var namaInvoice = selectedOption.val();

        toggleTipeHarga(tipeHarga);

        if (namaInvoice) {
            $.ajax({
                url: '/invoices/' + encodeURIComponent(namaInvoice),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data && data.kode_invoice) {
                        $('#invoicenoInput').val(data.kode_invoice);
                    }
                }
            });
        }
    });

    // Trigger on page load
    var initialOpt = $('#choices-invoice').find('option:selected');
    if (initialOpt.length && initialOpt.val()) {
        var initTipeHarga = initialOpt.data('tipe-harga') || 'dengan_harga';
        toggleTipeHarga(initTipeHarga);
    }

    // Toggle Order By Sales Input
    $('#choices-orderBy').on('change', function () {
        var selected = $(this).val();
        if (selected === 'Sales') {
            $('#divSales').show();
        } else {
            $('#divSales').hide();
        }
    });

    window.userEditedDp = false;

    // Track ketika user mengedit nominal DP secara manual (misal customer nego atau mengosongkan DP)
    $(document).on('input', '#input-dp', function () {
        window.userEditedDp = true;
        calcTotals();
    });

    // Toggle Bank Rekening display & DP Input
    $('#choices-payment-type').on('change', function () {
        var val = $(this).val();
        if (val && val.indexOf('Transfer') !== -1) {
            $('#alamatPembayaran').show();
        } else {
            $('#alamatPembayaran').hide();
        }

        if (val === 'Transfer DP') {
            $('#div-dp-row').show();
            $('#div-label').show();
            $('#dp').show();
        } else if (val === 'Cash Belum Lunas') {
            $('#div-dp-row').show();
            $('#div-label').show();
            $('#dp').show();
        } else {
            $('#div-dp-row').hide();
            $('#div-label').hide();
            $('#dp').hide();
            $('#input-dp').val('0');
            window.userEditedDp = false;
        }

        if (typeof dP === 'function') dP();
        calcTotals();
    });

    // Form Submit AJAX dengan Validasi Lengkap (Semua Input Wajib Diisi)
    $('#invoice_form').on('submit', function (e) {
        e.preventDefault();

        // 1. Validasi Jenis Invoice
        var invType = $('#choices-invoice').val();
        if (!invType) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Silakan pilih Jenis Invoice!',
                confirmButtonColor: '#EA580C'
            });
            $('#choices-invoice').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-invoice').removeClass('is-invalid');
        }

        // 2. Validasi Nama Customer
        var customerVal = $.trim($('#customer').val());
        if (!customerVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nama Customer wajib diisi!',
                confirmButtonColor: '#EA580C'
            });
            $('#customer').addClass('is-invalid').focus();
            return false;
        } else {
            $('#customer').removeClass('is-invalid');
        }

        // 3. Validasi Nomor Telepon
        var phoneVal = $.trim($('#phone-number').val());
        if (!phoneVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nomor Telepon wajib diisi!',
                confirmButtonColor: '#EA580C'
            });
            $('#phone-number').addClass('is-invalid').focus();
            return false;
        } else {
            $('#phone-number').removeClass('is-invalid');
        }

        // 4. Validasi Nama Admin
        var adminVal = $('#choices-admin').val();
        if (!adminVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Nama Admin wajib dipilih!',
                confirmButtonColor: '#EA580C'
            });
            $('#choices-admin').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-admin').removeClass('is-invalid');
        }

        // 5. Validasi Order Dari
        var orderVal = $('#choices-orderBy').val();
        if (!orderVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Order Dari wajib dipilih!',
                confirmButtonColor: '#EA580C'
            });
            $('#choices-orderBy').addClass('is-invalid').focus();
            return false;
        } else {
            $('#choices-orderBy').removeClass('is-invalid');
        }

        // 6. Validasi Sales jika Order Dari == Sales
        if (orderVal === 'Sales') {
            var salesVal = $.trim($('#colFormLabelNamaSales').val());
            if (!salesVal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Nama Sales wajib diisi ketika Order Dari adalah Sales!',
                    confirmButtonColor: '#EA580C'
                });
                $('#colFormLabelNamaSales').addClass('is-invalid').focus();
                return false;
            } else {
                $('#colFormLabelNamaSales').removeClass('is-invalid');
            }
        }

        // 7. Validasi Target Penyelesaian
        var tglSelesaiVal = $.trim($('#dateInput').val());
        if (!tglSelesaiVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Target Penyelesaian wajib diisi!',
                confirmButtonColor: '#EA580C'
            });
            $('#dateInput').addClass('is-invalid').focus();
            return false;
        } else {
            $('#dateInput').removeClass('is-invalid');
        }

        // 8. Validasi Baris Barang / Item
        var productRows = $('tr.product');
        if (productRows.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Item Kosong',
                text: 'Minimal harus ada 1 item barang dalam invoice!',
                confirmButtonColor: '#EA580C'
            });
            return false;
        }

        var selectedInvoiceOpt = $('#choices-invoice').find('option:selected');
        var isTanpaHarga = (selectedInvoiceOpt.data('tipe-harga') === 'tanpa_harga');

        var itemValid = true;
        var itemErrorMsg = '';
        var firstInvalidEl = null;

        productRows.each(function(idx) {
            var row = $(this);
            var itemNum = idx + 1;
            var barangSelect = row.find('select[name^="barang_id"]');
            var barangId = barangSelect.val();
            var descTextarea = row.find('textarea[name^="deskripsi_item"]');
            var descVal = $.trim(descTextarea.val());
            var hrgInput = row.find('input[name^="hrg"]');
            var hrgVal = parseFloat(hrgInput.val() ? hrgInput.val().toString().replace(/[.,]/g, '') : 0) || 0;
            var qtyInput = row.find('input[name^="qty"]');
            var qtyVal = parseFloat(qtyInput.val()) || 0;

            if (!barangId || barangId === "" || barangId === "Pilih Item") {
                itemValid = false;
                itemErrorMsg = 'Silakan pilih Item barang pada baris #' + itemNum + '!';
                barangSelect.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = barangSelect;
                return false;
            } else {
                barangSelect.removeClass('is-invalid');
            }

            if (!descVal) {
                itemValid = false;
                itemErrorMsg = 'Deskripsi item pada baris #' + itemNum + ' wajib diisi!';
                descTextarea.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = descTextarea;
                return false;
            } else {
                descTextarea.removeClass('is-invalid');
            }

            if (!isTanpaHarga && hrgVal <= 0) {
                itemValid = false;
                itemErrorMsg = 'Harga pada baris #' + itemNum + ' wajib diisi lebih dari Rp 0!';
                hrgInput.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = hrgInput;
                return false;
            } else {
                hrgInput.removeClass('is-invalid');
            }

            if (qtyVal <= 0) {
                itemValid = false;
                itemErrorMsg = 'Quantity pada baris #' + itemNum + ' wajib lebih dari 0!';
                qtyInput.addClass('is-invalid');
                if (!firstInvalidEl) firstInvalidEl = qtyInput;
                return false;
            } else {
                qtyInput.removeClass('is-invalid');
            }

            // Validasi Spesifikasi Material jika barang memerlukan material
            var isNonMat = (typeof isMaterialRequiredMap !== 'undefined' && isMaterialRequiredMap[barangId] == "1");
            if (!isNonMat) {
                var matContainer = row.find('.materials-container');
                var matRows = matContainer.find('.material-row');

                if (matRows.length === 0) {
                    itemValid = false;
                    itemErrorMsg = 'Spesifikasi Material untuk item #' + itemNum + ' wajib diisi!';
                    firstInvalidEl = row.find('.btn-tambah-material');
                    return false;
                }

                matRows.each(function() {
                    var mRow = $(this);
                    var mSelect = mRow.find('.material-select');
                    var mP = mRow.find('.material-panjang');
                    var mL = mRow.find('.material-lebar');

                    var valMat = mSelect.val();
                    var valP = parseFloat(mP.val()) || 0;
                    var valL = parseFloat(mL.val()) || 0;

                    if (!valMat || valMat === "") {
                        itemValid = false;
                        itemErrorMsg = 'Silakan pilih material pada Spesifikasi Material item #' + itemNum + '!';
                        mSelect.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mSelect;
                        return false;
                    } else {
                        mSelect.removeClass('is-invalid');
                    }

                    if (valP <= 0) {
                        itemValid = false;
                        itemErrorMsg = 'Panjang (P) pada Spesifikasi Material item #' + itemNum + ' wajib diisi lebih dari 0!';
                        mP.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mP;
                        return false;
                    } else {
                        mP.removeClass('is-invalid');
                    }

                    if (valL <= 0) {
                        itemValid = false;
                        itemErrorMsg = 'Lebar (L) pada Spesifikasi Material item #' + itemNum + ' wajib diisi lebih dari 0!';
                        mL.addClass('is-invalid');
                        if (!firstInvalidEl) firstInvalidEl = mL;
                        return false;
                    } else {
                        mL.removeClass('is-invalid');
                    }
                });

                if (!itemValid) return false;
            }
        });

        if (!itemValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Item Belum Lengkap',
                text: itemErrorMsg,
                confirmButtonColor: '#EA580C'
            });
            if (firstInvalidEl && firstInvalidEl.length) {
                firstInvalidEl.focus();
                $('html, body').animate({
                    scrollTop: firstInvalidEl.offset().top - 120
                }, 300);
            }
            return false;
        }

        // 9. Validasi Jenis Pembayaran & DP
        if (!isTanpaHarga) {
            var jnsPem = $('#choices-payment-type').val();
            if (!jnsPem) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Silakan pilih Jenis Pembayaran (Payment Method)!',
                    confirmButtonColor: '#EA580C'
                });
                $('#choices-payment-type').addClass('is-invalid').focus();
                return false;
            } else {
                $('#choices-payment-type').removeClass('is-invalid');
            }

            // DP bersifat opsional (dapat bernilai 0 atau dikosongkan)
            if ($('#input-dp').length) {
                $('#input-dp').removeClass('is-invalid');
            }
        }

        var formData = new FormData(this);

        $("#loading-spinner").show();
        $('#loading-overlay').show();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#loading-spinner").hide();
                $('#loading-overlay').hide();

                if (typeof clearInvoiceDraft === 'function') {
                    clearInvoiceDraft();
                }

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Invoice baru berhasil disimpan.",
                    timer: 1500,
                    showConfirmButton: false
                }).then(function () {
                    window.location.href = "{{ route('daftar_invoice') }}";
                });
            },
            error: function (xhr) {
                $("#loading-spinner").hide();
                $('#loading-overlay').hide();

                var msg = "Terjadi kesalahan! Data belum lengkap atau stok tidak mencukupi.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: "error",
                    title: "Gagal Menyimpan",
                    text: msg
                });
            }
        });
    });

    // Row deletion
    $(document).on('click', '.btn-hapus-item, .product-removal button, .product-removal a', function() {
        var $tr = $(this).closest('tr.product');
        if ($('#newlink tr.product').length > 1) {
            $tr.remove();
            if (typeof window.resetRowNumbers === 'function') {
                window.resetRowNumbers();
            }
            if (typeof getTotal === 'function') getTotal();
            calcTotals();
        } else {
            $tr.find('input').val('');
            $tr.find('select').prop('selectedIndex', 0);
            $tr.find('textarea').val('');
            $tr.find('.product-line-price').val('0');
            if (typeof window.resetRowNumbers === 'function') {
                window.resetRowNumbers();
            }
            if (typeof getTotal === 'function') getTotal();
            calcTotals();
        }
    });

    // Tax & Totals Calculation
    window.calcTotals = function() {
        var totalHarga = parseFloat($('#total-harga').val() ? $('#total-harga').val().toString().replace(/[.,]/g, '') : 0) || 0;
        var ppnVal = parseFloat($('#input-ppn').val()) || 0;
        var pphVal = parseFloat($('#input-pph').val()) || 0;

        var ppnNominal = (ppnVal * totalHarga) / 100;
        var pphNominal = (pphVal * totalHarga) / 100;

        var totalAkhir = Math.round(totalHarga + ppnNominal - pphNominal);
        $('#total-pembelian').val(totalAkhir.toLocaleString('id-ID'));

        var jnsPem = $('#choices-payment-type').val();

        if (jnsPem === 'Transfer DP') {
            $('#div-dp-row').show();
            $('#div-label').show();
            $('#dp').show();

            // Hitung otomatis 70% secara default hanya jika kolom DP masih kosong dan belum diedit manual oleh user
            if (!window.userEditedDp && totalAkhir > 0 && (!$('#input-dp').val() || $('#input-dp').val().trim() === '')) {
                var defaultDp = Math.round(totalAkhir * 0.7);
                $('#input-dp').val(defaultDp.toLocaleString('id-ID'));
            }
        } else if (jnsPem === 'Cash Belum Lunas') {
            $('#div-dp-row').show();
            $('#div-label').show();
            $('#dp').show();
        } else {
            $('#div-dp-row').hide();
            $('#div-label').hide();
            $('#dp').hide();
            if (jnsPem === 'Cash Lunas' || jnsPem === 'Transfer Lunas') {
                $('#input-dp').val('0');
                window.userEditedDp = false;
            }
        }

        var dpVal = parseFloat($('#input-dp').val() ? $('#input-dp').val().toString().replace(/[.,]/g, '') : 0) || 0;

        if (jnsPem === 'Cash Lunas' || jnsPem === 'Transfer Lunas') {
            $('#sisa-pembayaran').val('0');
        } else {
            var sisaVal = Math.max(0, Math.round(totalAkhir - dpVal));
            $('#sisa-pembayaran').val(sisaVal.toLocaleString('id-ID'));
        }
    };

    $(document).on('input change', '#input-ppn, #input-pph, #total-harga', function() {
        calcTotals();
    });

    // Inisialisasi awal saat halaman dibuka
    var rawDp = $('#input-dp').val();
    if (rawDp && parseFloat(rawDp.toString().replace(/[.,]/g, '')) > 0) {
        window.userEditedDp = true;
    }
    var initPayment = $('#choices-payment-type').val();
    if (initPayment && initPayment.indexOf('Transfer') !== -1) {
        $('#alamatPembayaran').show();
    }
    if (initPayment === 'Transfer DP' || initPayment === 'Cash Belum Lunas') {
        $('#div-dp-row').show();
        $('#div-label').show();
        $('#dp').show();
    }
    calcTotals();
  });
</script>
@endsection

@extends('layout.template')
@section('content')
@include('layout.loading-overlay')

<div class="page-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                    <h4 class="mb-sm-0 inv-page-title">Tambah Invoice Ibekami</h4>
                    <div class="page-title-right d-flex align-items-center gap-2">
                        <ol class="breadcrumb m-0 me-2 d-none d-md-flex">
                            <li class="breadcrumb-item"><a href="{{ route('daftar_invoice') }}" class="text-muted">Invoice</a></li>
                            <li class="breadcrumb-item active text-muted">Tambah Invoice</li>
                        </ol>
                        <button type="button" class="ref-theme-toggle" id="btn-theme-toggle" onclick="toggleDashboardTheme(event)" title="Beralih Mode Tampilan" aria-label="Ganti Tema Tampilan">
                            <i class="ri-sun-line fs-14" id="theme-toggle-icon"></i>
                            <span id="theme-toggle-text">Mode Terang</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card Container (Matching Tokabe Layout) -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card inv-main-card p-3 p-md-4">
                    <form method="POST" action="{{ route('store.invoice') }}" validate id="invoice_form" enctype="multipart/form-data">
                        @csrf

                        <!-- Top Section: 2 Columns Grid -->
                        <div class="row g-4 mb-4">
                            <!-- Left Column: Invoice Metadata -->
                            <div class="col-lg-5 col-md-6 col-12">
                                <!-- Invoice Name / Type -->
                                <div class="mb-3">
                                    <label for="choices-invoice" class="form-label inv-form-label">
                                        Invoice <span class="inv-required-mark">*</span>
                                    </label>
                                    <select class="form-select inv-dark-control @error('inv') is-invalid @enderror" id="choices-invoice" name="inv" required>
                                        <option value="">-- Pilih Jenis Invoice --</option>
                                        @foreach ($invoice as $inv)
                                            <option value="{{$inv->nama_invoice}}" data-tipe-harga="{{$inv->tipe_harga ?? 'dengan_harga'}}" {{ (old('inv') == $inv->nama_invoice || $loop->first) ? 'selected' : '' }}>
                                                {{$inv->nama_invoice}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('inv')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Invoice No -->
                                <div class="mb-3">
                                    <label class="form-label inv-form-label">Invoice No</label>
                                    <div class="d-flex gap-2">
                                        <div style="width: 100px;">
                                            <input type="text" class="form-control inv-dark-control inv-readonly text-center fw-bold" id="invoicenoInput" placeholder="Kode" name="kode" value="{{ old('kode', 'IBK') }}" readonly>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control inv-dark-control inv-readonly fw-semibold font-mono" id="noInvoice" placeholder="Nomor Invoice" name="kodeUnik" value="{{$no_invoice}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Penjualan -->
                                <div class="mb-3">
                                    <label class="form-label inv-form-label">Tanggal Penjualan</label>
                                    <div class="d-flex gap-2">
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control inv-dark-control flatpickr-input" id="date-field" name="tgl_jual" data-provider="flatpickr" data-date-format="Y-m-d" value="{{$hariIni}}" placeholder="YYYY-MM-DD" style="cursor: pointer;">
                                        </div>
                                        <div style="width: 120px;">
                                            <input type="text" class="form-control inv-dark-control text-center flatpickr-input" id="time-field" placeholder="H:i" name="jam" value="{{$formatJam}}" style="cursor: pointer;" title="Klik untuk mengatur jam" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Brand Logo & Customer Details -->
                            <div class="col-lg-7 col-md-6 col-12">
                                <!-- Top Right Logo Box -->
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="inv-logo-card">
                                        <img src="{{ asset('storage/images/perusahaan/698c05828c9a6.png') }}" 
                                             alt="Ibekami Logo" 
                                             onerror="this.onerror=null;this.src='{{ asset('images/perusahaan/698c05828c9a6.png') }}';">
                                    </div>
                                </div>

                                <!-- Customer Form Fields -->
                                <div class="customer-fields-container">
                                    <!-- Nama Customer -->
                                    <div class="row align-items-center mb-3">
                                        <label for="customer" class="col-sm-4 col-form-label inv-form-label">
                                            Nama Customer <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control @error('pelanggan') is-invalid @enderror" name="pelanggan" id="customer" placeholder="Nama Customer" value="{{ old('pelanggan') }}" list="customerList" autocomplete="off" required>
                                            <datalist id="customerList">
                                                @foreach ($kontak as $data)
                                                    <option value="{{ $data->customer }}" data-company="{{ $data->perusahaan }}" data-phone="{{ $data->no_telepon }}">{{ $data->customer }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pelanggan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nama Perusahaan -->
                                    <div class="row align-items-center mb-3">
                                        <label for="usaha" class="col-sm-4 col-form-label inv-form-label">
                                            Nama Perusahaan
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control @error('perusahaan') is-invalid @enderror" id="usaha" name="perusahaan" placeholder="Nama Perusahaan / Instansi" value="{{ old('perusahaan') }}" list="companyList" autocomplete="off">
                                            <datalist id="companyList">
                                                @foreach ($kontak->pluck('perusahaan')->filter()->unique() as $comp)
                                                    <option value="{{ $comp }}">{{ $comp }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('perusahaan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nomor Telepon -->
                                    <div class="row align-items-center mb-3">
                                        <label for="phone-number" class="col-sm-4 col-form-label inv-form-label">
                                            Nomor Telepon <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control @error('tlp') is-invalid @enderror" id="phone-number" name="tlp" placeholder="08xxxxxxxxx" value="{{ old('tlp') }}" required>
                                            @error('tlp')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nama Admin -->
                                    <div class="row align-items-center mb-3">
                                        <label for="choices-admin" class="col-sm-4 col-form-label inv-form-label">
                                            Nama Admin <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('adm') is-invalid @enderror" id="choices-admin" name="adm" required>
                                                <option value="">Pilih Admin</option>
                                                @foreach ($admin as $adm)
                                                    @php
                                                        $hasSig = !empty($adm->tanda_tangan_url);
                                                        $selectedAdminId = old('adm', (auth()->check() && auth()->user()->role === 'Admin') ? auth()->id() : '');
                                                    @endphp
                                                    <option value="{{ $adm->id }}" 
                                                        data-has-signature="{{ $hasSig ? '1' : '0' }}"
                                                        data-admin-name="{{ $adm->nama }}"
                                                        {{ ($selectedAdminId == $adm->id || old('adm') == $adm->nama) ? 'selected' : '' }}>
                                                        {{ $adm->nama }} {{ $hasSig ? '✓ (Ada TTD)' : '⚠️ (Belum ada TTD)' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div id="admin-signature-alert" class="mt-2" style="display: none;"></div>
                                            @error('adm')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Order Dari -->
                                    <div class="row align-items-center mb-3">
                                        <label for="choices-orderBy" class="col-sm-4 col-form-label inv-form-label">
                                            Order Dari <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('order') is-invalid @enderror" id="choices-orderBy" name="order" required>
                                                <option value="">Order By</option>
                                                @foreach ($order as $ord)
                                                    <option value="{{$ord->order_by}}" {{old('order') == $ord->order_by ? 'selected' : ''}}>{{$ord->order_by}}</option>
                                                @endforeach
                                            </select>
                                            @error('order')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sales Row (Conditional via JS) -->
                                    <div id="divSales" style="display: none;">
                                        <div class="row align-items-center mb-3">
                                            <label for="colFormLabelNamaSales" class="col-sm-4 col-form-label inv-form-label">
                                                Nama Sales <span class="inv-required-mark">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inv-dark-control @error('sales') is-invalid @enderror" id="colFormLabelNamaSales" placeholder="Nama Sales" name="sales" value="{{ old('sales') }}">
                                                @error('sales')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Target Penyelesaian -->
                                    <div class="row align-items-center mb-3">
                                        <label for="dateInput" class="col-sm-4 col-form-label inv-form-label">
                                            Target Penyelesaian <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="position-relative">
                                                <input type="text" class="form-control inv-dark-control flatpickr-input @error('tgl_selesai') is-invalid @enderror" data-provider="flatpickr" data-date-format="Y-m-d" name="tgl_selesai" id="dateInput" placeholder="YYYY-MM-DD" value="{{ old('tgl_selesai') }}" readonly="readonly" style="cursor: pointer; padding-right: 38px;" required>
                                                <i class="ri-calendar-2-line position-absolute text-muted" style="right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 16px;"></i>
                                            </div>
                                            @error('tgl_selesai')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Options Templates for JS Cloner -->
                        <div id="template-options-material" style="display: none;">
                            <option value="">-- Pilih Material --</option>
                            @if(isset($materials))
                                @foreach ($materials as $mat)
                                    <option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">
                                        {{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok: {{ $mat->stok }})
                                    </option>
                                @endforeach
                            @endif
                        </div>
                        <div id="template-options-barang" style="display: none;">
                            <option selected disabled>Pilih Item</option>
                            @foreach ($jenisBarang as $jns)
                                <option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}">{{$jns->jenis_barang}}</option>
                            @endforeach
                        </div>

                        <!-- Table Section (Image 2) -->
                        <div class="table-responsive mt-4">
                            <table class="table invoice-table align-middle inv-dark-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="text-center">#</th>
                                        <th style="min-width: 280px;">ITEM <span class="inv-required-mark">*</span></th>
                                        <th style="width: 100px;">SATUAN <span class="inv-required-mark">*</span></th>
                                        <th style="width: 130px;" class="col-header-harga">HARGA (Rp) <span class="inv-required-mark">*</span></th>
                                        <th style="width: 88px;" class="text-center">QUANTITY <span class="inv-required-mark">*</span></th>
                                        <th style="width: 135px;" class="col-header-jumlah-harga text-end">JUMLAH HARGA</th>
                                        <th style="width: 82px;" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="newlink">
                                    <tr id="1" class="product">
                                        <th scope="row" class="product-id text-center fw-bold"><span class="product-id-badge">1</span></th>
                                        <td class="text-start">
                                            <!-- Product Item Select -->
                                            <div class="mb-2">
                                                <select class="form-select inv-dark-control @error('barang_id.0') is-invalid @enderror" data-choices data-choices-sorting="true" id="productName-1" name="barang_id[0]" required>
                                                    <option value="" selected disabled>Pilih Item</option>
                                                    @foreach ($jenisBarang as $jns)
                                                        <option value="{{$jns->id}}" data-kategori-id="{{$jns->kategori_id}}" {{old('barang_id.0') == $jns->id ? 'selected' : ''}}>{{$jns->jenis_barang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('barang_id.0')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Description Textarea -->
                                            <textarea class="form-control inv-dark-control mb-2 @error('deskripsi_item.0') is-invalid @enderror" id="productDetails-1" name="deskripsi_item[0]" rows="2" placeholder="Deskripsi Item (Wajib Diisi)" required></textarea>
                                            @error('deskripsi_item.0')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <!-- Multi-Material Sub-Component Box -->
                                            <div class="materials-container material-container-0" data-row-index="0">
                                                <div class="material-box-wrapper">
                                                    <div class="material-box-header">
                                                        <span class="material-box-title">Spesifikasi Material <span class="text-danger fw-bold" title="Wajib Diisi">*</span></span>
                                                        <span class="text-muted fs-11">P × L × Qty</span>
                                                    </div>

                                                    <div class="material-row pt-1">
                                                        <div class="row g-2 align-items-center">
                                                            <div class="col-xl-4 col-lg-12">
                                                                <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[0][]" style="height: 32px !important; font-size: 12px !important;">
                                                                    <option value="">-- Pilih Material --</option>
                                                                    @if(isset($materials))
                                                                        @foreach ($materials as $mat)
                                                                            <option value="{{ $mat->id }}" data-stok="{{ $mat->stok }}" data-satuan="{{ $mat->satuan }}">
                                                                                {{ $mat->kode_material }} - {{ $mat->jenis_material }} (Stok: {{ $mat->stok }})
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-3 col-lg-6 col-12">
                                                                <div class="d-flex align-items-center gap-1">
                                                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[0][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                                                                    <span class="text-muted fw-bold px-1">×</span>
                                                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[0][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-5">
                                                                <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[0][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                                                            </div>
                                                            <div class="col-xl-2 col-lg-2 col-4">
                                                                <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[0][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                                                            </div>
                                                            <div class="col-xl-1 col-lg-1 col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-link text-decoration-none p-0 mt-2 add-material btn-tambah-material fs-12 fw-semibold">
                                                <i class="ri-add-circle-line me-1"></i> Tambah Material Lainnya
                                            </button>
                                        </td>

                                        <td>
                                            <select class="form-select inv-dark-control @error('satuan.0') is-invalid @enderror" style="min-width: 95px;" id="satuan-1" name="satuan[0]" required>
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
                                            </select>
                                        </td>

                                        <td class="col-item-harga">
                                            <input type="text" class="form-control inv-dark-control product-price numeric" id="productRate-1" name="hrg[0]" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' placeholder="Rp. 0.000" onchange="autoCalc(this)" required />
                                        </td>

                                        <td>
                                            <input type="number" class="form-control inv-dark-control text-center fw-bold" id="product-qty-1" value="1" min="1" step="any" name="qty[0]" onchange="autoCalc(this)" required>
                                        </td>

                                        <td class="col-item-jumlah-harga text-end">
                                            <input type="text" class="form-control inv-dark-control inv-readonly product-line-price numeric text-end font-mono" id="productPrice-1" name="jlh_hrg[0]" placeholder="Rp.0.000" onchange="autoCalc(this)" readonly />
                                        </td>

                                        <td class="product-removal text-center">
                                            <button type="button" class="btn btn-hapus-item" title="Hapus Baris Item">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add Item Button -->
                        <div class="mt-3">
                            <button type="button" class="btn btn-add-item-custom" id="add-item" onclick="new_link()">
                                <i class="ri-add-line fs-14"></i> Add Item
                            </button>
                        </div>

                        <!-- Payment & Financial Summary (Image 2 Bottom) -->
                        <div id="section-detail-pembayaran" class="mt-4 pt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-9 col-12">
                                    <!-- Jenis Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label for="choices-payment-type" class="col-sm-4 col-form-label inv-form-label">
                                            Jenis Pembayaran <span class="inv-required-mark">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-select inv-dark-control @error('jns_pem') is-invalid @enderror" id="choices-payment-type" name="jns_pem" required>
                                                <option disabled selected value="">Payment Method</option>
                                                <option value="Cash Lunas">Cash Lunas</option>
                                                <option value="Cash Belum Lunas">Cash Belum Lunas</option>
                                                <option value="Transfer DP">Transfer DP</option>
                                                <option value="Transfer Lunas">Transfer Lunas</option>
                                                <option value="PO">PO</option>
                                            </select>
                                            @error('jns_pem')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rekening Info Card -->
                                    <div id="alamatPembayaran" class="row mb-3" style="display: none;">
                                        <div class="col-sm-8 offset-sm-4">
                                            <div class="bank-account-badge">
                                                <span class="badge-dot-green"></span>
                                                <input class="d-none" type="radio" name="norek" id="flexRadioDefault1" value="BNI" checked>
                                                <span class="bank-account-text fs-12 fw-semibold">
                                                    BSI &nbsp;|&nbsp; A/N : Yusni Kurniasih &nbsp;|&nbsp; No. Rek : 2845999999
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DP Input (Conditional) -->
                                    <div class="row align-items-center mb-2" id="div-dp-row" style="display: none;">
                                        <div class="col-sm-4" id="div-label">
                                            <label for="input-dp" class="col-form-label text-warning fs-13 fw-semibold mb-0">
                                                DP (70%)
                                            </label>
                                            <small class="text-muted d-block" style="font-size: 11px;">(Default 70%, opsional / dapat dikosongkan)</small>
                                        </div>
                                        <div class="col-sm-8" id="dp">
                                            <input id="input-dp" name="dp" type="text" data-cleave='{ "numeral": true, "numeralThousandsGroupStyle": "thousand" }' class="form-control inv-dark-control numeric text-warning fw-bold" placeholder="0 (Boleh kosong)" value="{{ old('dp') }}">
                                        </div>
                                    </div>

                                    <!-- Jumlah Harga -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Jumlah Harga</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly numeric fw-semibold" id="total-harga" name="tot_harga" value="{{ old('tot_harga', '0') }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Hidden PPN & PPh -->
                                    <input type="hidden" id="input-ppn" name="ppn" value="0">
                                    <input type="hidden" id="input-pph" name="pph" value="0">

                                    <!-- Hidden Compatibility Elements -->
                                    <select class="d-none" name="select-potongan" id="choices-potongan">
                                        <option value="-">-</option>
                                        <option value="Diskon">Diskon</option>
                                        <option value="Potongan">Potongan</option>
                                        <option value="PPN">PPN</option>
                                        <option value="PPH">PPH</option>
                                    </select>
                                    <input type="hidden" id="input-potongan" name="ptg" value="0">

                                    <!-- Total Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Total Pembayaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly-highlight numeric" id="total-pembelian" name="tot_pem" value="{{ old('tot_pem', '0') }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Sisa Pembayaran -->
                                    <div class="row align-items-center mb-2">
                                        <label class="col-sm-4 col-form-label inv-form-label">Sisa Pembayaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inv-dark-control inv-readonly numeric fw-semibold text-warning" id="sisa-pembayaran" name="sisa_pem" value="{{ old('sisa_pem', '0') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Tanpa Harga -->
                        <div id="alert-tanpa-harga" class="alert alert-warning border-0 shadow-sm mt-3" style="display: none; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3);">
                            <div class="d-flex align-items-center">
                                <i class="ri-information-line fs-20 me-2 text-warning"></i>
                                <div>
                                    <h6 class="alert-heading mb-1 text-warning fw-bold">Jenis Invoice Tanpa Harga</h6>
                                    <p class="mb-0 text-muted fs-13">Kolom harga dan detail pembayaran dinonaktifkan. Anda dapat langsung menyimpan invoice ini tanpa nominal.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons (Bottom Left, Image 2) -->
                        <div class="d-flex align-items-center gap-2 mt-4 pt-3 border-top border-secondary border-opacity-25 d-print-none">
                            <button type="submit" id="simpan" class="btn btn-save-custom btn-load">
                                <span class="d-flex align-items-center">
                                    <span id="loading-spinner" class="spinner-border spinner-border-sm flex-shrink-0 me-2" role="status" style="display: none;"></span>
                                    <i class="ri-file-add-line me-1 fs-15"></i> Buat Invoice
                                </span>
                            </button>
                            <button type="button" id="btn-save-draft" class="btn btn-save-draft-custom">
                                <i class="ri-draft-line me-1 fs-15"></i> Simpan Draf
                            </button>
                            <button type="button" id="btn-reset-draft" class="btn btn-reset-draft-custom">
                                <i class="ri-delete-bin-line me-1"></i> Reset Draf
                            </button>
                            <a href="{{ route('daftar_invoice') }}" class="btn btn-batal-custom">
                                <i class="ri-close-line me-1"></i> Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function syncCustomerDetails() {
        var customerInput = document.getElementById('customer');
        if (!customerInput) return;
        var selectedOption = customerInput.value;
        var dataListEl = document.getElementById('customerList');
        if (!dataListEl) return;
        var dataList = dataListEl.getElementsByTagName('option');
        for (var i = 0; i < dataList.length; i++) {
            var option = dataList[i];
            if (option.value === selectedOption) {
                var usahaEl = document.getElementById('usaha');
                var company = option.getAttribute('data-company');
                if (usahaEl && company && company !== 'null') {
                    usahaEl.value = company;
                }
                var phoneEl = document.getElementById('phone-number');
                var phone = option.getAttribute('data-phone');
                if (phoneEl && phone && phone !== 'null') {
                    phoneEl.value = phone;
                }
                break;
            }
        }
    }

    var customerInput = document.getElementById('customer');
    if (customerInput) {
        customerInput.addEventListener('change', syncCustomerDetails);
        customerInput.addEventListener('input', syncCustomerDetails);
    }

    document.addEventListener("DOMContentLoaded", function () {
        let dateField = document.getElementById("date-field");
        let timeField = document.getElementById("time-field");
        let dateInput = document.getElementById("dateInput");
        let invoiceInput = document.getElementById("noInvoice");

        if (typeof flatpickr !== 'undefined') {
            if (dateField) {
                flatpickr(dateField, {
                    dateFormat: "Y-m-d",
                    defaultDate: "{{ $hariIni }}",
                    onChange: function (selectedDates, dateStr) {
                        fetch(`/invoice/get-invoice-number?tanggal=${dateStr}`)
                            .then(response => response.json())
                            .then(data => {
                                if (invoiceInput && data.no_invoice) {
                                    invoiceInput.value = data.no_invoice;
                                }
                            })
                            .catch(error => console.error('Error fetching invoice number:', error));
                    }
                });
            }

            if (timeField) {
                flatpickr(timeField, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true,
                    allowInput: true,
                    defaultDate: timeField.value || "{{ $formatJam }}"
                });
            }

            if (dateInput) {
                flatpickr(dateInput, {
                    dateFormat: "Y-m-d",
                    @if(old('tgl_selesai'))
                    defaultDate: "{{ old('tgl_selesai') }}",
                    @endif
                });
            }
        }
    });
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
<!-- choices.js & flatpickr -->
<script src="{{asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('libs/flatpickr/flatpickr.min.js')}}"></script>

<script src="{{asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{asset('js/halaman/tabel-item.js')}}?v={{ filemtime(public_path('js/halaman/tabel-item.js')) }}"></script>
<script src="{{asset('js/halaman/tabel-item.js')}}?v={{ file_exists(public_path('js/halaman/tabel-item.js')) ? filemtime(public_path('js/halaman/tabel-item.js')) : '20261119' }}"></script>
<script src="{{asset('js/halaman/invoice.js')}}"></script>
<script src="{{asset('js/halaman/draft-invoice-ibekami.js')}}"></script>

<script>
    window.resetRowNumbers = function() {
        $('#newlink tr.product').each(function(idx) {
            var num = idx + 1;
            $(this).attr('id', num);
            $(this).find('.product-id').html(`<span class="product-id-badge">${num}</span>`);

            // Re-index all child IDs for accurate autoCalc & Cleave targeting
            $(this).find('[id^="productName-"]').attr('id', 'productName-' + num);
            $(this).find('[id^="productDetails-"]').attr('id', 'productDetails-' + num);
            $(this).find('[id^="satuan-"]').attr('id', 'satuan-' + num);
            $(this).find('[id^="productRate-"]').attr('id', 'productRate-' + num);
            $(this).find('[id^="product-qty-"]').attr('id', 'product-qty-' + num);
            $(this).find('[id^="productPrice-"]').attr('id', 'productPrice-' + num);

            // Re-index form field names for clean sequential backend arrays
            $(this).find('select[name^="barang_id"]').attr('name', `barang_id[${idx}]`);
            $(this).find('textarea[name^="deskripsi_item"]').attr('name', `deskripsi_item[${idx}]`);
            $(this).find('select[name^="satuan"]').attr('name', `satuan[${idx}]`);
            $(this).find('input[name^="hrg"]').attr('name', `hrg[${idx}]`);
            $(this).find('input[name^="qty"]').attr('name', `qty[${idx}]`);
            $(this).find('input[name^="jlh_hrg"]').attr('name', `jlh_hrg[${idx}]`);

            var $matContainer = $(this).find('.materials-container');
            if ($matContainer.length) {
                $matContainer.attr('data-row-index', idx);
                $matContainer.find('.material-select').attr('name', `material_id[${idx}][]`);
                $matContainer.find('.material-panjang').attr('name', `material_panjang[${idx}][]`);
                $matContainer.find('.material-lebar').attr('name', `material_lebar[${idx}][]`);
                $matContainer.find('.material-qty').attr('name', `material_qty[${idx}][]`);
                $matContainer.find('.material-satuan').attr('name', `material_satuan[${idx}][]`);
            }
        });
    };

    window.new_link = function() {
        var currentRows = document.querySelectorAll('#newlink tr.product');
        var currentIdx = currentRows.length;
        var nextNum = currentIdx + 1;

        var materialOptionsDOM = document.getElementById('template-options-material');
        var materialOptions = materialOptionsDOM ? materialOptionsDOM.innerHTML : '<option value="">-- Pilih Material --</option>';

        var itemOptionsDOM = document.getElementById('template-options-barang');
        var itemOptions = itemOptionsDOM ? itemOptionsDOM.innerHTML : '<option selected disabled>Pilih Item</option>';

        var template = `
            <th scope="row" class="product-id text-center fw-bold">
                <span class="product-id-badge">${nextNum}</span>
            </th>
            <td class="text-start">
                <div class="mb-2">
                    <select class="form-select inv-dark-control" name="barang_id[${currentIdx}]" id="productName-${nextNum}" required>
                        ${itemOptions}
                    </select>
                </div>
                <textarea class="form-control inv-dark-control mb-2" id="productDetails-${nextNum}" name="deskripsi_item[${currentIdx}]" rows="2" placeholder="Deskripsi Item (Wajib Diisi)" required></textarea>
                
                <!-- CONTAINER MATERIAL UNTUK ITEM BARU -->
                <div class="materials-container material-container-${currentIdx}" data-row-index="${currentIdx}">
                    <div class="material-box-wrapper">
                        <div class="material-box-header">
                            <span class="material-box-title">Spesifikasi Material <span class="text-danger fw-bold" title="Wajib Diisi">*</span></span>
                            <span class="text-muted fs-11">P × L × Qty</span>
                        </div>
                        <div class="material-row pt-1">
                            <div class="row g-2 align-items-center">
                                 <div class="col-xl-4 col-lg-12">
                                    <select class="form-select form-select-sm inv-dark-control material-select" name="material_id[${currentIdx}][]" style="height: 32px !important; font-size: 12px !important;">
                                        ${materialOptions}
                                    </select>
                                 </div>
                                 <div class="col-xl-3 col-lg-6 col-12">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-panjang" name="material_panjang[${currentIdx}][]" placeholder="P" min="0" style="height: 32px !important; font-size: 12px !important;">
                                        <span class="text-muted fw-bold px-1">×</span>
                                        <input type="number" step="any" class="form-control form-control-sm inv-dark-control material-lebar" name="material_lebar[${currentIdx}][]" placeholder="L" min="0" style="height: 32px !important; font-size: 12px !important;">
                                    </div>
                                 </div>
                                 <div class="col-xl-2 col-lg-3 col-5">
                                    <input type="number" step="any" class="form-control form-control-sm inv-dark-control inv-readonly material-qty" name="material_qty[${currentIdx}][]" placeholder="Hasil" readonly style="height: 32px !important; font-size: 12px !important;">
                                 </div>
                                 <div class="col-xl-2 col-lg-2 col-4">
                                    <input type="text" class="form-control form-control-sm inv-dark-control inv-readonly material-satuan" name="material_satuan[${currentIdx}][]" placeholder="Satuan" readonly style="height: 32px !important; font-size: 12px !important;">
                                 </div>
                                 <div class="col-xl-1 col-lg-1 col-3 text-end">
                                    <button type="button" class="btn btn-sm btn-soft-danger remove-material w-100" style="padding: 4px 6px;">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-link text-decoration-none p-0 mt-2 add-material btn-tambah-material fs-12 fw-semibold">
                    <i class="ri-add-circle-line me-1"></i> Tambah Material Lainnya
                </button>
            </td>
            <td>
                <select class="form-select inv-dark-control" style="min-width: 95px;" name="satuan[${currentIdx}]" id="satuan-${nextNum}" required>
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
                </select>
            </td>
            <td class="col-item-harga">
                <input type="text" class="form-control inv-dark-control product-price numeric" id="productRate-${nextNum}" name="hrg[${currentIdx}]" placeholder="Rp. 0.000" onchange="autoCalc(this)" required />
            </td>
            <td>
                <input type="number" class="form-control inv-dark-control text-center fw-bold" id="product-qty-${nextNum}" value="1" min="1" step="any" name="qty[${currentIdx}]" onchange="autoCalc(this)" required>
            </td>
            <td class="col-item-jumlah-harga text-end">
                <input type="text" class="form-control inv-dark-control inv-readonly product-line-price numeric text-end font-mono" id="productPrice-${nextNum}" name="jlh_hrg[${currentIdx}]" placeholder="Rp.0.000" readonly />
            </td>
            <td class="product-removal text-center">
                <button type="button" class="btn btn-hapus-item" title="Hapus Baris Item">
                    <i class="ri-delete-bin-line"></i> Hapus
                </button>
            </td>
        `;

        var tr = document.createElement("tr");
        tr.id = nextNum;
        tr.className = "product";
        tr.innerHTML = template;
        document.getElementById("newlink").appendChild(tr);

        var selectInvoice = document.getElementById('choices-invoice');
        var selectedOpt = selectInvoice ? selectInvoice.options[selectInvoice.selectedIndex] : null;
        var tipeHarga = selectedOpt ? selectedOpt.getAttribute('data-tipe-harga') : 'dengan_harga';
        if (tipeHarga === 'tanpa_harga') {
            var rateEl = tr.querySelector(`[name="hrg[${currentIdx}]"]`);
            if (rateEl) {
                rateEl.removeAttribute('required');
                rateEl.value = '0';
            }
            var jlhEl = tr.querySelector(`[name="jlh_hrg[${currentIdx}]"]`);
            if (jlhEl) {
                jlhEl.value = '0';
            }
        }

        if (typeof Choices !== 'undefined') {
            var newProductSelect = document.getElementById(`productName-${nextNum}`);
            if (newProductSelect) {
                new Choices(newProductSelect, {
                    searchEnabled: true,
                    shouldSort: true,
                    searchResultLimit: 50,
                    position: 'bottom',
                    fuseOptions: { threshold: 0.35, ignoreLocation: true }
                });
            }
        }

        if (typeof Cleave !== 'undefined') {
            new Cleave(`#productRate-${nextNum}`, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        }

        window.resetRowNumbers();
    };

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

    $(document).ready(function() {
        initInvoiceTheme();

        if (typeof window.resetRowNumbers === 'function') {
            window.resetRowNumbers();
        }
        
        $('#choices-admin').on('change', checkAdminSignature);
        checkAdminSignature();
    });
</script>
@endsection
