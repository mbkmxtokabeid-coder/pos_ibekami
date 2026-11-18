<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">

<head>

<meta charset="utf-8" />
<script>
    // 0. ZERO-LATENCY SYNCHRONOUS THEME RESTORATION (ELIMINATES THEME FLICKER / FOUC)
    (function() {
        var theme = 'dark';
        try {
            theme = localStorage.getItem('tokabe_theme') || localStorage.getItem('ibekami_dash_theme') || 'dark';
        } catch(e) {}
        
        var isLight = (theme === 'light');
        var root = document.documentElement;
        
        // Prevent sidebar/layout CSS transitions from firing during initial page paint
        root.classList.add('ibk-preload');

        // Apply instantly to <html> before any external stylesheet or script parses
        root.setAttribute('data-theme', theme);
        root.setAttribute('data-layout-mode', theme);
        root.setAttribute('data-sidebar', isLight ? 'light' : 'dark');
        if (isLight) {
            root.classList.add('theme-light');
            root.classList.remove('theme-dark');
        } else {
            root.classList.add('theme-dark');
            root.classList.remove('theme-light');
        }
        
        // Keep sessionStorage synchronized so layout.js respects the active theme & sidebar rail
        try {
            sessionStorage.setItem('data-layout', 'vertical');
            if (!sessionStorage.getItem('data-sidebar-size') || sessionStorage.getItem('data-sidebar-size') === 'lg') {
                sessionStorage.setItem('data-sidebar-size', 'sm-hover');
            }
            sessionStorage.setItem('data-layout-mode', theme);
            sessionStorage.setItem('data-sidebar', isLight ? 'light' : 'dark');
        } catch(e) {}
        
        // Instantly stamp <body> as soon as it exists (zero DOMContentLoaded wait)
        if (isLight) {
            if (document.body) {
                document.body.classList.add('theme-light');
            } else {
                var obs = new MutationObserver(function() {
                    if (document.body) {
                        document.body.classList.add('theme-light');
                        obs.disconnect();
                    }
                });
                obs.observe(root, { childList: true });
            }
        }
    })();
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="Kasir Ibekami" content="Ibekami">
<title>Ibekami Kasir</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Kasir Ibekami" name="description" />

<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('images/Ibekami.png')}}">

<!-- DNS Prefetch & Preconnect for external resources -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://code.jquery.com">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

<!-- Preload & Load Google Fonts Inter & JetBrains Mono + DM Sans with display=swap -->
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=DM+Sans:wght@400;500;700&display=swap">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

{{-- HEAD CSS  --}}
@yield('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Layout config Js -->
<script src="{{asset('js/layout.js')}}"></script>
<!-- Bootstrap Css -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />

<script>
    // Pastikan default sidebar adalah sm-hover untuk micro-expand rail
    if (!sessionStorage.getItem("data-sidebar-size") || sessionStorage.getItem("data-sidebar-size") === "lg") {
        sessionStorage.setItem("data-sidebar-size", "sm-hover");
    }
</script>

<style>
    .error-help-block {
        color: #ca131e;
    }
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .spinner-border {
        width: 7rem;
        height: 7rem;
    }

    /* ==========================================================================
       IBEKAMI GLOBAL THEME CANVAS (WARM OBSIDIAN & AMBER GLOW)
       ========================================================================== */
    html.theme-dark body,
    html:not(.theme-light) body {
        background-color: #090807 !important;
        background-image:
            radial-gradient(circle 580px at 18% 16%, rgba(245, 158, 11, 0.18), transparent 70%),
            radial-gradient(circle 520px at 88% 36%, rgba(234, 88, 12, 0.13), transparent 70%),
            radial-gradient(circle 620px at 32% 80%, rgba(251, 191, 36, 0.14), transparent 72%) !important;
        background-attachment: fixed !important;
        color: #FAFAFA !important;
    }
    html.theme-light body,
    html[data-layout-mode="light"] body,
    body.theme-light {
        background-color: #F8FAFC !important;
        background-image:
            radial-gradient(circle 580px at 18% 16%, rgba(245, 158, 11, 0.05), transparent 70%),
            radial-gradient(circle 520px at 88% 36%, rgba(234, 88, 12, 0.035), transparent 70%),
            radial-gradient(circle 620px at 32% 80%, rgba(251, 191, 36, 0.04), transparent 72%) !important;
        background-attachment: fixed !important;
        color: #0F172A !important;
    }
    html:not(.theme-light) #layout-wrapper,
    html:not(.theme-light) .main-content,
    html:not(.theme-light) .page-content,
    html.theme-light #layout-wrapper,
    html.theme-light .main-content,
    html.theme-light .page-content {
        background-color: transparent !important;
    }

    /* ==========================================================================
       VIEW TRANSITION API — CIRCULAR REVEAL THEME TRANSITION
       ========================================================================== */
    ::view-transition-old(root),
    ::view-transition-new(root) {
        animation: none !important;
        mix-blend-mode: normal !important;
    }
    ::view-transition-old(root) {
        z-index: 1 !important;
    }
    ::view-transition-new(root) {
        z-index: 9999 !important;
    }
    @media (prefers-reduced-motion: reduce) {
        ::view-transition-group(*),
        ::view-transition-old(*),
        ::view-transition-new(*) {
            animation: none !important;
        }
    }

    /* =========================================================
       GLOBAL THEME TOGGLE PILL BUTTON (Identik Dashboard / Welcome)
       ========================================================= */
    .ref-theme-toggle {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 6px 16px !important;
        height: 38px !important;
        border-radius: 9999px !important;
        background: rgba(255, 255, 255, 0.06) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #FBBF24 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        transition: transform 160ms ease, background-color 160ms ease, border-color 160ms ease, color 160ms ease, box-shadow 160ms ease !important;
        outline: none !important;
        user-select: none !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    }
    .ref-theme-toggle:hover {
        background: rgba(255, 255, 255, 0.12) !important;
        border-color: rgba(255, 255, 255, 0.22) !important;
        transform: translateY(-1px) !important;
        color: #FDE047 !important;
    }
    .ref-theme-toggle:active {
        transform: scale(0.97) !important;
    }
    .ref-theme-toggle #theme-toggle-icon,
    .ref-theme-toggle .theme-toggle-icon {
        display: inline-block !important;
        font-size: 15px !important;
        line-height: 1 !important;
        transition: transform 380ms cubic-bezier(0.34, 1.56, 0.64, 1), opacity 200ms ease !important;
    }
    .ref-theme-toggle.theme-switching #theme-toggle-icon,
    .ref-theme-toggle.theme-switching .theme-toggle-icon {
        transform: rotate(180deg) scale(0.65) !important;
        opacity: 0.2 !important;
    }
    .ref-theme-toggle #theme-toggle-text,
    .ref-theme-toggle .theme-toggle-text {
        letter-spacing: -0.01em !important;
    }
    html.theme-light .ref-theme-toggle,
    body.theme-light .ref-theme-toggle {
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        color: #1E293B !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06) !important;
    }
    html.theme-light .ref-theme-toggle:hover,
    body.theme-light .ref-theme-toggle:hover {
        background: #F8FAFC !important;
        color: #0F172A !important;
        border-color: #CBD5E1 !important;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08) !important;
    }
    html.theme-light .ref-theme-toggle #theme-toggle-icon,
    body.theme-light .ref-theme-toggle #theme-toggle-icon {
        color: #1E293B !important;
    }

    /* =========================================================
       DATATABLES TOP TOOLBAR (SEARCH DI KIRI, SHOW ENTRIES DI KANAN)
       ========================================================= */
    .dataTables_wrapper > .row:first-child,
    div.dataTables_wrapper div.row:first-child {
        display: flex !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 14px 24px 14px 24px !important;
        margin: 0 !important;
        border-bottom: 1px solid var(--ibk-border, #334155) !important;
        gap: 12px !important;
        background: transparent !important;
    }

    body.theme-light .dataTables_wrapper > .row:first-child,
    body.theme-light div.dataTables_wrapper div.row:first-child,
    html.theme-light .dataTables_wrapper > .row:first-child,
    html[data-layout-mode="light"] .dataTables_wrapper > .row:first-child {
        border-bottom-color: #E2E8F0 !important;
    }

    /* Column wrappers in row:first-child */
    .dataTables_wrapper > .row:first-child > div:has(.dataTables_filter),
    div.dataTables_wrapper div.row:first-child > div:has(.dataTables_filter) {
        order: 1 !important;
        width: auto !important;
        flex: 1 1 auto !important;
        max-width: 360px !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
    }

    .dataTables_wrapper > .row:first-child > div:has(.dataTables_length),
    div.dataTables_wrapper div.row:first-child > div:has(.dataTables_length) {
        order: 2 !important;
        width: auto !important;
        margin-left: auto !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
    }

    /* Fallback if browser doesn't support :has */
    .dataTables_wrapper .dataTables_filter,
    div.dataTables_wrapper div.dataTables_filter {
        order: 1 !important;
        float: none !important;
        display: inline-flex !important;
        align-items: center !important;
        margin: 0 !important;
        text-align: left !important;
    }

    .dataTables_wrapper .dataTables_length,
    div.dataTables_wrapper div.dataTables_length {
        order: 2 !important;
        display: inline-flex !important;
        align-items: center !important;
        margin-left: auto !important;
        margin-bottom: 0 !important;
        text-align: right !important;
        gap: 4px !important;
        font-size: 13px !important;
        color: var(--vz-body-color, #64748B) !important;
    }

    /* SEARCH BOX IDENTICAL TO INVOICE (With magnifying glass icon) */
    .dataTables_wrapper .dataTables_filter label,
    div.dataTables_wrapper div.dataTables_filter label {
        display: inline-flex !important;
        align-items: center !important;
        position: relative !important;
        margin-bottom: 0 !important;
        width: 100% !important;
        max-width: 340px !important;
        font-size: 0 !important; /* Hides raw 'Search:' text */
        color: transparent !important;
    }

    .dataTables_wrapper .dataTables_filter label::before,
    div.dataTables_wrapper div.dataTables_filter label::before {
        content: '' !important;
        position: absolute !important;
        left: 14px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 15px !important;
        height: 15px !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: contain !important;
        pointer-events: none !important;
        z-index: 2 !important;
        transition: opacity 0.15s ease !important;
    }

    .dataTables_wrapper .dataTables_filter input,
    div.dataTables_wrapper div.dataTables_filter input {
        display: inline-block !important;
        width: 100% !important;
        min-width: 260px !important;
        max-width: 340px !important;
        height: 38px !important;
        margin-left: 0 !important;
        padding: 8px 14px 8px 38px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border-radius: 10px !important;
        border: 1px solid var(--ibk-border, #334155) !important;
        background-color: var(--ibk-input-bg, rgba(255, 255, 255, 0.04)) !important;
        color: var(--ibk-text, #F8FAFC) !important;
        outline: none !important;
        box-shadow: none !important;
        transition: all 0.15s ease !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    div.dataTables_wrapper div.dataTables_filter input:focus {
        border-color: #EA580C !important;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.18) !important;
        background-color: var(--ibk-input-focus-bg, rgba(255, 255, 255, 0.07)) !important;
    }

    /* Light Mode Filter Search Box */
    body.theme-light .dataTables_wrapper .dataTables_filter input,
    html.theme-light .dataTables_wrapper .dataTables_filter input,
    html[data-layout-mode="light"] .dataTables_wrapper .dataTables_filter input {
        background-color: #F8FAFC !important;
        border: 1px solid #CBD5E1 !important;
        color: #0F172A !important;
    }

    body.theme-light .dataTables_wrapper .dataTables_filter label::before,
    html.theme-light .dataTables_wrapper .dataTables_filter label::before,
    html[data-layout-mode="light"] .dataTables_wrapper .dataTables_filter label::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E") !important;
    }

    .dataTables_wrapper .dataTables_length label,
    div.dataTables_wrapper div.dataTables_length label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        margin-bottom: 0 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: inherit !important;
    }

    .dataTables_wrapper .dataTables_length select,
    div.dataTables_wrapper div.dataTables_length select,
    .dataTables_length select.form-select,
    .dataTables_length select {
        display: inline-block !important;
        width: auto !important;
        min-width: 68px !important;
        height: 32px !important;
        line-height: 1.5 !important;
        padding: 3px 28px 3px 10px !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        text-align: left !important;
        vertical-align: middle !important;
        margin: 0 4px !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        background-color: var(--ibk-input-bg, #0F172A) !important;
        border: 1px solid var(--ibk-border, #334155) !important;
        color: var(--ibk-text, #F8FAFC) !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 8px center !important;
        background-size: 11px 9px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        transition: border-color 150ms ease, box-shadow 150ms ease !important;
    }

    .dataTables_wrapper .dataTables_length select:focus,
    div.dataTables_wrapper div.dataTables_length select:focus,
    .dataTables_length select:focus {
        border-color: #EA580C !important;
        box-shadow: 0 0 0 2px rgba(234, 88, 12, 0.2) !important;
        outline: none !important;
    }

    /* Light Theme Support */
    body.theme-light .dataTables_wrapper .dataTables_length select,
    html.theme-light .dataTables_wrapper .dataTables_length select,
    body.theme-light div.dataTables_wrapper div.dataTables_length select,
    html.theme-light div.dataTables_wrapper div.dataTables_length select,
    body.theme-light .dataTables_length select,
    html.theme-light .dataTables_length select {
        background-color: #FFFFFF !important;
        border: 1px solid #CBD5E1 !important;
        color: #0F172A !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23475569' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
    }

    /* =========================================================
       GLOBAL PRIMARY ACTION BUTTON (TOKABE SIGNATURE ORANGE)
       ========================================================= */
    .ibk-btn-primary {
        background: #EA580C !important;
        color: #FFFFFF !important;
        border: 1px solid #EA580C !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        padding: 0 16px !important;
        height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: background-color 150ms ease, border-color 150ms ease, transform 100ms ease, box-shadow 150ms ease !important;
        box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
        white-space: nowrap !important;
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
    body.theme-light .ibk-btn-primary,
    html.theme-light .ibk-btn-primary {
        background: #EA580C !important;
        border-color: #EA580C !important;
        color: #FFFFFF !important;
        box-shadow: 0 1px 3px rgba(234, 88, 12, 0.25) !important;
    }
    body.theme-light .ibk-btn-primary:hover,
    html.theme-light .ibk-btn-primary:hover {
        background: #C2410C !important;
        border-color: #C2410C !important;
        color: #FFFFFF !important;
    }


    /* =========================================================
       HIDE DEFAULT NATIVE SCROLLBARS (CLEAN MODERN CANVAS)
       ========================================================= */
    html,
    body,
    #layout-wrapper,
    .main-content,
    .page-content {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    html::-webkit-scrollbar,
    body::-webkit-scrollbar,
    #layout-wrapper::-webkit-scrollbar,
    .main-content::-webkit-scrollbar,
    .page-content::-webkit-scrollbar {
        width: 0 !important;
        height: 0 !important;
        display: none !important;
        background: transparent !important;
    }

    /* =========================================================
       LINEAR CARBON × GOLDEN AMBER SIDEBAR STYLING (IBEKAMI)
       ========================================================= */
    :root {
        --shadcn-sidebar-bg: #09090B;
        --shadcn-sidebar-surface: #111115;
        --shadcn-sidebar-border: rgba(255, 255, 255, 0.08);
        --shadcn-sidebar-muted: #A1A1AA;
        --shadcn-sidebar-text: #FAFAFA;
        --shadcn-sidebar-active-bg: rgba(245, 158, 11, 0.14);
        --shadcn-sidebar-active-text: #FBBF24;
        --shadcn-sidebar-hover-bg: rgba(255, 255, 255, 0.05);
    }

    /* ==========================================================================
       SIDEBAR LIGHT MODE (Tersinkronisasi Otomatis dengan Mode Terang)
       ========================================================================== */
    body.theme-light, html.theme-light, html[data-layout-mode="light"] body {
        --shadcn-sidebar-bg: #FFFFFF;
        --shadcn-sidebar-surface: #F8FAFC;
        --shadcn-sidebar-border: #E2E8F0;
        --shadcn-sidebar-muted: #64748B;
        --shadcn-sidebar-text: #0F172A;
        --shadcn-sidebar-active-bg: #FFFBEB;
        --shadcn-sidebar-active-text: #D97706;
        --shadcn-sidebar-hover-bg: #F1F5F9;
    }

    html.theme-light .app-menu.navbar-menu,
    body.theme-light .app-menu.navbar-menu {
        background: #FFFFFF !important;
        border-right: 1px solid #E2E8F0 !important;
        box-shadow: 2px 0 16px rgba(15, 23, 42, 0.04) !important;
    }
    html.theme-light .sidebar-org-box,
    body.theme-light .sidebar-org-box {
        border-bottom: 1px solid #F1F5F9 !important;
        background: #FFFFFF !important;
    }
    body.theme-light .org-trigger-btn {
        color: #0F172A !important;
    }
    body.theme-light .org-trigger-btn:hover {
        background: #F8FAFC !important;
    }
    body.theme-light .org-name {
        color: #0F172A !important;
    }
    body.theme-light .org-badge-pro {
        background: #FFFBEB !important;
        color: #D97706 !important;
        border: 1px solid #FDE68A !important;
    }
    body.theme-light .org-chevron,
    body.theme-light .user-chevron {
        color: #94A3B8 !important;
    }
    body.theme-light .navbar-nav .menu-title {
        color: #94A3B8 !important;
    }
    body.theme-light .navbar-nav .nav-link {
        color: #475569 !important;
    }
    body.theme-light .navbar-nav .nav-link:hover {
        color: #0F172A !important;
        background: #F1F5F9 !important;
    }
    body.theme-light .navbar-nav .nav-link .icon-box {
        background: transparent !important;
        color: #64748B !important;
    }
    body.theme-light .navbar-nav .nav-link:hover .icon-box,
    body.theme-light .navbar-nav .nav-link:hover i.menu-icon {
        color: #D97706 !important;
    }
    body.theme-light .navbar-nav .nav-link.active,
    body.theme-light .navbar-nav .nav-link[aria-expanded="true"],
    body.theme-light .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link,
    body.theme-light .navbar-nav .nav-item.has-active-child > .nav-link {
        background: #FFFBEB !important;
        color: #D97706 !important;
        font-weight: 700 !important;
    }
    body.theme-light .navbar-nav .nav-link.active .icon-box,
    body.theme-light .navbar-nav .nav-link.active i.menu-icon,
    body.theme-light .navbar-nav .nav-link[aria-expanded="true"] .icon-box,
    body.theme-light .navbar-nav .nav-link[aria-expanded="true"] i.menu-icon,
    body.theme-light .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link .icon-box,
    body.theme-light .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link i.menu-icon,
    body.theme-light .navbar-nav .nav-item.has-active-child > .nav-link .icon-box,
    body.theme-light .navbar-nav .nav-item.has-active-child > .nav-link i.menu-icon {
        color: #F59E0B !important;
    }
    body.theme-light .navbar-menu .navbar-nav .sub-menu-list:before {
        background: #E2E8F0 !important;
    }
    body.theme-light .navbar-menu .navbar-nav .sub-menu-list .nav-link {
        color: #475569 !important;
        background: transparent !important;
    }
    body.theme-light .navbar-menu .navbar-nav .sub-menu-list .nav-link:hover {
        color: #0F172A !important;
        background: #F1F5F9 !important;
    }
    body.theme-light .navbar-menu .navbar-nav .sub-menu-list .nav-link.active {
        color: #D97706 !important;
        background: #FFFBEB !important;
        font-weight: 600 !important;
    }
    body.theme-light .navbar-menu .navbar-nav .nav-link[data-bs-toggle="collapse"]:after {
        color: #94A3B8 !important;
        background: transparent !important;
    }
    body.theme-light .navbar-menu .navbar-nav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]:after,
    body.theme-light .navbar-menu .navbar-nav .nav-item.has-active-child > .nav-link[data-bs-toggle="collapse"]:after {
        color: #D97706 !important;
        background: transparent !important;
    }
    body.theme-light .navbar-menu .navbar-nav .nav-link:not([data-bs-toggle="collapse"]).active::after {
        background: #F59E0B !important;
    }
    body.theme-light .sidebar-user-footer {
        border-top: 1px solid #F1F5F9 !important;
        background: #FFFFFF !important;
    }
    body.theme-light .user-trigger-btn {
        color: #0F172A !important;
    }
    body.theme-light .user-trigger-btn:hover {
        background: #F8FAFC !important;
    }
    body.theme-light .user-name {
        color: #0F172A !important;
    }
    body.theme-light .user-role-label {
        color: #64748B !important;
    }

    /* Suppress initial-paint sidebar/layout transitions until first frame settles */
    html.ibk-preload .app-menu.navbar-menu,
    html.ibk-preload .app-menu.navbar-menu *,
    html.ibk-preload #page-topbar,
    html.ibk-preload .main-content,
    html.ibk-preload .footer {
        transition: none !important;
        animation: none !important;
    }

    /* Layout Synchronized Transitions */
    .app-menu.navbar-menu,
    #page-topbar,
    .main-content,
    .footer {
        transition: width 0.28s cubic-bezier(0.25, 1, 0.5, 1),
                    left 0.28s cubic-bezier(0.25, 1, 0.5, 1),
                    margin-left 0.28s cubic-bezier(0.25, 1, 0.5, 1),
                    box-shadow 0.28s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .app-menu.navbar-menu {
        will-change: width;
    }

    /* Sidebar Base Container */
    .app-menu.navbar-menu {
        background-color: var(--shadcn-sidebar-bg) !important;
        border-right: 1px solid var(--shadcn-sidebar-border) !important;
        box-shadow: 4px 0 24px rgba(0, 0, 0, 0.35) !important;
        display: flex !important;
        flex-direction: column !important;
        padding: 0 !important;
        overflow: hidden !important;
        z-index: 1002 !important;
        contain: paint;
    }

    /* Top: Organization / Brand Header */
    .sidebar-org-box {
        height: 60px;
        min-height: 60px;
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid var(--shadcn-sidebar-border);
        box-sizing: border-box;
        overflow: hidden;
    }
    .org-trigger-btn {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 8px !important;
        height: 44px !important;
        border-radius: 8px !important;
        color: var(--shadcn-sidebar-text) !important;
        display: flex !important;
        align-items: center !important;
        transition: background 0.18s ease !important;
        width: calc(100% - 16px) !important;
        overflow: hidden !important;
    }
    .org-trigger-btn:hover {
        background: var(--shadcn-sidebar-hover-bg) !important;
    }
    .org-avatar-badge {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        background: rgba(245, 158, 11, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid rgba(245, 158, 11, 0.32);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18), 0 4px 12px rgba(0, 0, 0, 0.4);
        margin-left: 8px;
        flex-shrink: 0;
    }
    .org-avatar-img {
        width: 26px;
        height: 26px;
        object-fit: contain;
    }
    .org-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-grow: 1;
        margin-left: 10px;
        margin-right: 8px;
        white-space: nowrap;
        overflow: hidden;
        opacity: 1;
        transform: translateX(0);
        max-width: 170px;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    max-width 0.26s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .org-name {
        font-size: 13.5px;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #FAFAFA;
        line-height: 1.2;
    }
    .org-badge-pro {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #FBBF24;
        background: rgba(245, 158, 11, 0.14);
        border: 1px solid rgba(245, 158, 11, 0.28);
        padding: 1px 5px;
        border-radius: 4px;
        display: inline-block;
        margin-top: 2px;
    }
    .org-chevron, .user-chevron {
        font-size: 15px;
        opacity: 0.6;
    }

    /* Middle Scroll Area */
    .sidebar-scroll-area {
        flex: 1 1 auto;
        min-height: 0 !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        padding: 8px 0;
    }
    .sidebar-scroll-area::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-scroll-area::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 4px;
    }

    /* Navigation Links */
    .navbar-menu .navbar-nav {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    .navbar-menu .navbar-nav .nav-item {
        width: 100% !important;
        margin-bottom: 2px !important;
    }
    .navbar-menu .navbar-nav .nav-link {
        display: flex !important;
        align-items: center !important;
        padding: 0 !important;
        margin: 2px 8px !important;
        height: 40px !important;
        border-radius: 8px !important;
        color: var(--shadcn-sidebar-muted) !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        line-height: 1.4 !important;
        transition: background-color 0.18s ease, color 0.18s ease !important;
        text-decoration: none !important;
        overflow: hidden !important;
        position: relative !important;
    }
    .navbar-menu .navbar-nav .nav-link:hover {
        background-color: var(--shadcn-sidebar-hover-bg) !important;
        color: #ffffff !important;
    }
    .navbar-menu .navbar-nav .nav-link:hover i.menu-icon {
        color: #ffffff !important;
    }
    .navbar-menu .navbar-nav .nav-link.active,
    .navbar-menu .navbar-nav .nav-link[aria-expanded="true"],
    .navbar-menu .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link,
    .navbar-menu .navbar-nav .nav-item.has-active-child > .nav-link {
        background-color: var(--shadcn-sidebar-active-bg) !important;
        color: var(--shadcn-sidebar-active-text) !important;
        font-weight: 600 !important;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.10), 0 0 0 1px rgba(245, 158, 11, 0.24) !important;
    }
    .navbar-menu .navbar-nav .nav-link:not([data-bs-toggle="collapse"]).active::after {
        content: "";
        position: absolute;
        left: 0;
        top: 8px;
        bottom: 8px;
        width: 3px;
        border-radius: 0 3px 3px 0;
        background: #FBBF24;
    }
    .navbar-menu .navbar-nav .nav-link.active i.menu-icon,
    .navbar-menu .navbar-nav .nav-link[aria-expanded="true"] i.menu-icon,
    .navbar-menu .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link i.menu-icon,
    .navbar-menu .navbar-nav .nav-item.has-active-child > .nav-link i.menu-icon {
        color: var(--shadcn-sidebar-active-text) !important;
    }
    .navbar-menu .navbar-nav .nav-link[aria-expanded="true"]:after,
    .navbar-menu .navbar-nav .nav-item:has(.sub-menu-list .nav-link.active) > .nav-link:after,
    .navbar-menu .navbar-nav .nav-item.has-active-child > .nav-link:after {
        color: var(--shadcn-sidebar-active-text) !important;
        background: transparent !important;
    }
    .navbar-menu .navbar-nav .nav-link.active:before {
        display: none !important;
    }
    .navbar-menu .navbar-nav .nav-link .icon-box {
        width: 52px !important;
        min-width: 52px !important;
        height: 40px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .navbar-menu .navbar-nav .nav-link i.menu-icon {
        font-size: 20px !important;
        color: inherit !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: transform 0.18s ease;
    }
    .navbar-menu .navbar-nav .nav-link:hover i.menu-icon {
        transform: scale(1.08);
    }
    .navbar-menu .navbar-nav .nav-link .menu-text {
        font-size: 13px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        opacity: 1;
        transform: translateX(0);
        max-width: 170px;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    max-width 0.26s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Divider & Section Headers */
    .sidebar-divider {
        height: 1px;
        background-color: var(--shadcn-sidebar-border);
        margin: 8px 12px;
        transition: opacity 0.2s ease;
    }
    .navbar-menu .menu-title {
        padding: 10px 16px 4px 16px !important;
        font-size: 10.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: #71717A !important;
        white-space: nowrap;
        overflow: hidden;
    }
    .sidebar-badge-beta {
        font-size: 9px !important;
        font-weight: 700 !important;
        padding: 2px 6px !important;
        border-radius: 4px !important;
        background: rgba(245, 158, 11, 0.15) !important;
        color: #FBBF24 !important;
        letter-spacing: 0.04em !important;
        margin-left: auto !important;
        margin-right: 12px !important;
        white-space: nowrap !important;
        max-width: 45px;
        overflow: hidden;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s;
    }

    /* =========================================================
       SUBMENU ACCORDION SMOOTH COLLAPSE & EXPANSION
       ========================================================= */
    .navbar-menu .navbar-nav .nav-sm .nav-link:before,
    .navbar-menu .navbar-nav .sub-menu-list .nav-link:before {
        display: none !important;
        content: none !important;
    }

    /* Chevron arrow with fluid 3D easing */
    .navbar-menu .navbar-nav .nav-link[data-bs-toggle="collapse"]:after {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        content: "\f107" !important;
        font-family: "Line Awesome Free" !important;
        font-weight: 900 !important;
        font-size: 13px !important;
        position: absolute !important;
        right: 14px !important;
        left: auto !important;
        top: 50% !important;
        bottom: auto !important;
        width: auto !important;
        height: auto !important;
        background: transparent !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        color: var(--shadcn-sidebar-muted) !important;
        transform: translateY(-50%) rotate(-90deg) !important;
        transform-origin: center center !important;
        transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), color 0.18s ease !important;
        will-change: transform;
    }
    .navbar-menu .navbar-nav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]:after {
        transform: translateY(-50%) rotate(0deg) !important;
        color: var(--shadcn-sidebar-active-text) !important;
        background: transparent !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:not(:hover) .nav-link[data-bs-toggle="collapse"]:after {
        opacity: 0 !important;
        pointer-events: none !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .nav-link[data-bs-toggle="collapse"]:after {
        opacity: 1 !important;
        pointer-events: auto !important;
        transition: opacity 0.22s ease 0.08s, transform 0.28s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    /* Fluid Collapsing Animation (No jumping or sudden height jumps) */
    .navbar-menu .menu-dropdown {
        background: transparent !important;
        border: none !important;
    }
    .navbar-menu .menu-dropdown.collapsing {
        display: block !important;
        overflow: hidden !important;
        transition: height 0.28s cubic-bezier(0.16, 1, 0.3, 1) !important;
        will-change: height;
    }
    .navbar-menu .menu-dropdown.collapse.show {
        display: block !important;
        height: auto !important;
        overflow: visible !important;
    }

    /* Submenu List Container */
    .navbar-menu .navbar-nav .sub-menu-list {
        padding: 2px 0 6px 0 !important;
        margin: 0 !important;
        list-style: none !important;
        position: relative !important;
        transition: opacity 0.18s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.18s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }
    .navbar-menu .navbar-nav .sub-menu-list:before {
        content: "";
        position: absolute;
        left: 33px;
        top: 4px;
        bottom: 8px;
        width: 1px;
        background: rgba(255, 255, 255, 0.08);
        transition: opacity 0.16s ease;
    }
    .navbar-menu .navbar-nav .sub-menu-list .nav-link {
        padding: 0 12px 0 46px !important;
        height: 36px !important;
        margin: 1px 8px !important;
        border-radius: 6px !important;
        font-size: 13px !important;
        color: #8b949e !important;
        display: flex !important;
        align-items: center !important;
        background: transparent !important;
        transition: background-color 0.16s ease, color 0.16s ease, transform 0.16s ease !important;
    }
    .navbar-menu .navbar-nav .sub-menu-list .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.05) !important;
        transform: translateX(2px);
    }
    .navbar-menu .navbar-nav .sub-menu-list .nav-link.active {
        color: #FBBF24 !important;
        background: rgba(245, 158, 11, 0.14) !important;
        font-weight: 600 !important;
    }
    .navbar-menu .navbar-nav .sub-menu-list .nav-link.active .sub-menu-icon {
        color: #FBBF24 !important;
    }

    /* EXIT / CLOSING STATE: Fluid fade-out & subtle slide-up without clipping */
    .navbar-menu .menu-dropdown.is-closing .sub-menu-list,
    .navbar-menu .menu-dropdown.collapsing.is-closing .sub-menu-list {
        opacity: 0 !important;
        transform: translateY(-6px) !important;
        transition: opacity 0.16s ease, transform 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .navbar-menu .menu-dropdown.is-closing .sub-menu-list:before,
    .navbar-menu .menu-dropdown.collapsing.is-closing .sub-menu-list:before {
        opacity: 0 !important;
    }

    /* ENTER / EXPANDING STATE: Staggered micro-entrance */
    .navbar-menu .menu-dropdown.is-opening .sub-menu-list .nav-item,
    .navbar-menu .menu-dropdown.show:not(.is-closing) .sub-menu-list .nav-item {
        animation: subItemSlide 0.24s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .navbar-menu .menu-dropdown.is-opening .sub-menu-list .nav-item:nth-child(1) { animation-delay: 0.02s; }
    .navbar-menu .menu-dropdown.is-opening .sub-menu-list .nav-item:nth-child(2) { animation-delay: 0.05s; }
    .navbar-menu .menu-dropdown.is-opening .sub-menu-list .nav-item:nth-child(3) { animation-delay: 0.08s; }
    .navbar-menu .menu-dropdown.is-opening .sub-menu-list .nav-item:nth-child(4) { animation-delay: 0.11s; }

    @keyframes subItemSlide {
        0% { opacity: 0; transform: translateY(-6px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* =========================================================
       USER FOOTER & ORG POPUP DROPDOWN (BUTTER-SMOOTH MOTION)
       ========================================================= */
    .sidebar-user-footer {
        margin-top: auto;
        border-top: 1px solid var(--shadcn-sidebar-border);
        padding: 8px 0;
        background: var(--shadcn-sidebar-bg);
        box-sizing: border-box;
        overflow: visible !important;
        position: relative;
        z-index: 1005;
    }
    .user-trigger-btn {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 8px !important;
        height: 44px !important;
        border-radius: 8px !important;
        color: var(--shadcn-sidebar-text) !important;
        display: flex !important;
        align-items: center !important;
        transition: background 0.18s ease !important;
        width: calc(100% - 16px) !important;
        overflow: hidden !important;
        cursor: pointer;
    }
    .user-trigger-btn:hover,
    .user-trigger-btn[aria-expanded="true"] {
        background: var(--shadcn-sidebar-hover-bg) !important;
    }
    .user-trigger-btn[aria-expanded="true"] .user-chevron {
        color: #ffffff !important;
        transform: rotate(180deg);
    }
    .user-chevron {
        transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), color 0.18s ease;
    }
    .user-avatar-badge {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: #09090B;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        margin-left: 9px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.28);
    }
    .user-avatar-badge.size-sm {
        width: 28px;
        height: 28px;
        min-width: 28px;
        font-size: 11px;
        margin-left: 0;
    }
    .user-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-grow: 1;
        margin-left: 10px;
        margin-right: 8px;
        white-space: nowrap;
        overflow: hidden;
        opacity: 1;
        transform: translateX(0);
        max-width: 170px;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    max-width 0.26s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .user-name {
        font-size: 13px;
        font-weight: 600;
        color: #f0f6fc;
    }
    .user-role-label {
        font-size: 11px;
        color: var(--shadcn-sidebar-muted);
    }

    /* Popover Menu Styling (Native smooth hardware-accelerated transitions) */
    .shadcn-dropdown-menu {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        min-width: 230px !important;
        z-index: 1050 !important;
        display: block !important;
        visibility: hidden;
        pointer-events: none;
        transition: visibility 0.2s ease;
    }
    .shadcn-dropdown-menu.show {
        visibility: visible !important;
        pointer-events: auto !important;
        transition: none;
    }
    .shadcn-dropdown-menu .shadcn-menu-inner {
        background: rgba(24, 20, 18, 0.96) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 12px !important;
        box-shadow: 0 18px 42px rgba(0, 0, 0, 0.72), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
        backdrop-filter: blur(20px) saturate(160%) !important;
        -webkit-backdrop-filter: blur(20px) saturate(160%) !important;
        overflow: hidden;
        opacity: 0;
        transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        will-change: transform, opacity;
    }
    .dropup .shadcn-dropdown-menu .shadcn-menu-inner {
        transform: translateY(8px) scale(0.96);
        transform-origin: bottom left;
    }
    .dropdown .shadcn-dropdown-menu .shadcn-menu-inner {
        transform: translateY(-8px) scale(0.96);
        transform-origin: top left;
    }
    .shadcn-dropdown-menu.show .shadcn-menu-inner {
        opacity: 1 !important;
        transform: translateY(0) scale(1) !important;
    }
    .shadcn-dropdown-menu .shadcn-menu-inner,
    .shadcn-dropdown-menu .shadcn-menu-inner span,
    .shadcn-dropdown-menu .shadcn-menu-inner div {
        color: #F5F5F4;
    }
    .shadcn-dropdown-menu .shadcn-item {
        padding: 8px 12px !important;
        border-radius: 7px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #E7E5E4 !important;
        transition: background 0.14s ease, color 0.14s ease, transform 0.14s ease !important;
    }
    .shadcn-dropdown-menu .shadcn-item:hover {
        background: var(--shadcn-sidebar-hover-bg) !important;
        color: #ffffff !important;
        transform: translateX(3px) !important;
    }
    .shadcn-dropdown-menu .shadcn-item.text-danger {
        color: #FCA5A5 !important;
    }
    .shadcn-dropdown-menu .shadcn-item.text-danger:hover {
        background: rgba(239, 68, 68, 0.14) !important;
        color: #EF4444 !important;
        transform: translateX(3px) !important;
    }

    /* Warm Stone Light Mode Overrides for Sidebar Popovers */
    html.theme-light .shadcn-dropdown-menu .shadcn-menu-inner,
    body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner {
        background: #FFFFFF !important;
        border: 1px solid #E6E1D8 !important;
        box-shadow: 0 14px 32px rgba(28, 25, 23, 0.12), 0 2px 6px rgba(28, 25, 23, 0.04) !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }
    html.theme-light .shadcn-dropdown-menu .shadcn-menu-inner,
    html.theme-light .shadcn-dropdown-menu .shadcn-menu-inner span,
    html.theme-light .shadcn-dropdown-menu .shadcn-menu-inner div,
    body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner,
    body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner span,
    body.theme-light .shadcn-dropdown-menu .shadcn-menu-inner div {
        color: #1C1917;
    }
    html.theme-light .shadcn-dropdown-menu .user-dropdown-header,
    html.theme-light .shadcn-dropdown-menu .dropdown-divider,
    html.theme-light .shadcn-dropdown-menu .border-bottom,
    body.theme-light .shadcn-dropdown-menu .user-dropdown-header,
    body.theme-light .shadcn-dropdown-menu .dropdown-divider,
    body.theme-light .shadcn-dropdown-menu .border-bottom {
        border-color: #EAE4DC !important;
    }
    html.theme-light .shadcn-dropdown-menu .user-dropdown-header-role,
    html.theme-light .shadcn-dropdown-menu .text-muted,
    body.theme-light .shadcn-dropdown-menu .user-dropdown-header-role,
    body.theme-light .shadcn-dropdown-menu .text-muted {
        color: #78716C !important;
    }
    html.theme-light .shadcn-dropdown-menu .shadcn-item,
    body.theme-light .shadcn-dropdown-menu .shadcn-item {
        color: #44403C !important;
    }
    html.theme-light .shadcn-dropdown-menu .shadcn-item:hover,
    body.theme-light .shadcn-dropdown-menu .shadcn-item:hover {
        background: #FAF8F5 !important;
        color: #1C1917 !important;
    }
    html.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger,
    body.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger {
        color: #DC2626 !important;
    }
    html.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger:hover,
    body.theme-light .shadcn-dropdown-menu .shadcn-item.text-danger:hover {
        background: #FEF2F2 !important;
        color: #B91C1C !important;
    }

    /* Keep sidebar expanded when user dropdown is active */
    [data-sidebar-size="sm-hover"] .navbar-menu.user-dropdown-active {
        width: 250px !important;
        box-shadow: 14px 0 38px rgba(0, 0, 0, 0.6) !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu.user-dropdown-active .org-info,
    [data-sidebar-size="sm-hover"] .navbar-menu.user-dropdown-active .user-meta,
    [data-sidebar-size="sm-hover"] .navbar-menu.user-dropdown-active .menu-text {
        opacity: 1 !important;
        transform: translateX(0) !important;
        max-width: 170px !important;
        pointer-events: auto !important;
    }

    /* Sm-Hover Rail Mode (Modern Collapse) */
    [data-sidebar-size="sm-hover"] .navbar-menu {
        width: 68px !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu .org-info,
    [data-sidebar-size="sm-hover"] .navbar-menu .user-meta,
    [data-sidebar-size="sm-hover"] .navbar-menu .menu-text,
    [data-sidebar-size="sm-hover"] .navbar-menu .menu-title,
    [data-sidebar-size="sm-hover"] .navbar-menu .sidebar-badge-beta {
        opacity: 0 !important;
        transform: translateX(-12px) !important;
        max-width: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.15s ease, transform 0.15s ease, max-width 0.22s ease !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:not(:hover) .menu-dropdown {
        display: none !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:hover {
        width: 250px !important;
        box-shadow: 14px 0 38px rgba(0, 0, 0, 0.6) !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .org-info,
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .user-meta,
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .menu-text,
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .menu-title {
        opacity: 1 !important;
        transform: translateX(0) !important;
        max-width: 170px !important;
        pointer-events: auto !important;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    max-width 0.26s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    [data-sidebar-size="sm-hover"] .navbar-menu:hover .sidebar-badge-beta {
        opacity: 1 !important;
        transform: scale(1) !important;
        max-width: 45px !important;
        pointer-events: auto !important;
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s,
                    transform 0.22s cubic-bezier(0.16, 1, 0.3, 1) 0.06s !important;
    }
    /* Header Topbar Removed */
    #page-topbar {
        display: none !important;
    }
    .page-content {
        padding-top: 24px !important;
    }

    /* =========================================================
       SWEETALERT2 DARK & LIGHT THEME DYNAMIC NOTIFICATIONS
       ========================================================= */
    .swal2-popup.swal2-toast {
        background: #161B22 !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.6), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important;
        border-radius: 12px !important;
        padding: 12px 16px !important;
        overflow: hidden !important;
    }
    .swal2-popup.swal2-toast .swal2-title {
        color: #F8FAFC !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        letter-spacing: 0.2px !important;
        margin-bottom: 4px !important;
        text-align: left !important;
    }
    .swal2-popup.swal2-toast .swal2-html-container {
        color: #94A3B8 !important;
        font-size: 12.5px !important;
        font-weight: 400 !important;
        line-height: 1.45 !important;
        text-align: left !important;
        margin: 0 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon {
        margin: 0 12px 0 0 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-info {
        border-color: #F97316 !important;
        color: #F97316 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-success {
        border-color: #10B981 !important;
        color: #10B981 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-warning {
        border-color: #F59E0B !important;
        color: #F59E0B !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error {
        border-color: #EF4444 !important;
        color: #EF4444 !important;
    }
    .swal2-popup.swal2-toast .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #F97316, #F59E0B) !important;
        height: 3px !important;
        border-radius: 0 0 12px 12px !important;
        bottom: 0 !important;
    }

    /* Regular Modal SweetAlert (Dark) */
    .swal2-popup:not(.swal2-toast) {
        background: #161B22 !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.7) !important;
        border-radius: 14px !important;
        color: #F8FAFC !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-title {
        color: #F8FAFC !important;
        font-weight: 700 !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-html-container {
        color: #94A3B8 !important;
        font-size: 14px !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-close {
        color: #94A3B8 !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-close:hover {
        color: #FFFFFF !important;
    }

    /* SweetAlert2 Light Mode Support */
    body.theme-light .swal2-popup.swal2-toast {
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-title {
        color: #0F172A !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-html-container {
        color: #475569 !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-icon.swal2-info {
        border-color: #EA580C !important;
        color: #EA580C !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-icon.swal2-success {
        border-color: #10B981 !important;
        color: #10B981 !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-icon.swal2-warning {
        border-color: #F59E0B !important;
        color: #F59E0B !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-icon.swal2-error {
        border-color: #EF4444 !important;
        color: #EF4444 !important;
    }
    body.theme-light .swal2-popup.swal2-toast .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #EA580C, #F97316) !important;
    }

    body.theme-light .swal2-popup:not(.swal2-toast) {
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.12) !important;
        color: #0F172A !important;
    }
    body.theme-light .swal2-popup:not(.swal2-toast) .swal2-title {
        color: #0F172A !important;
    }
    body.theme-light .swal2-popup:not(.swal2-toast) .swal2-html-container {
        color: #475569 !important;
    }
    body.theme-light .swal2-popup:not(.swal2-toast) .swal2-close {
        color: #64748B !important;
    }
    body.theme-light .swal2-popup:not(.swal2-toast) .swal2-close:hover {
        color: #0F172A !important;
    }
        color: #ffffff !important;
    }

    /* ==========================================================================
       FLATPICKR SOLID THEME (CLEAN MINIMALIST — MATCHES USER REFERENCE DESIGN)
       ========================================================================== */
    .flatpickr-calendar,
    .flatpickr-calendar.arrowTop,
    .flatpickr-calendar.arrowBottom,
    .flatpickr-calendar.open,
    .flatpickr-calendar.inline {
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 16px !important;
        outline: none !important;
        -webkit-box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.03) !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.03) !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important;
        overflow: hidden !important;
        z-index: 999999 !important;
        width: 315px !important;
    }
    .flatpickr-calendar:focus,
    .flatpickr-calendar:focus-visible,
    .flatpickr-calendar *:focus,
    .flatpickr-calendar *:focus-visible {
        outline: none !important;
    }
    .flatpickr-calendar::before,
    .flatpickr-calendar::after,
    .flatpickr-calendar:before,
    .flatpickr-calendar:after,
    .flatpickr-calendar.arrowTop::before,
    .flatpickr-calendar.arrowTop::after,
    .flatpickr-calendar.arrowTop:before,
    .flatpickr-calendar.arrowTop:after,
    .flatpickr-calendar.arrowBottom::before,
    .flatpickr-calendar.arrowBottom::after,
    .flatpickr-calendar.arrowBottom:before,
    .flatpickr-calendar.arrowBottom:after {
        display: none !important;
        border: none !important;
        content: none !important;
        width: 0 !important;
        height: 0 !important;
    }
    .flatpickr-calendar.animate.open {
        animation: fpPopIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
    }
    @keyframes fpPopIn {
        0% {
            opacity: 0;
            transform: translateY(-8px) scale(0.97);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Container & Day Wrapper */
    .flatpickr-innerContainer,
    .flatpickr-rContainer,
    .flatpickr-days,
    .dayContainer {
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
    }
    .flatpickr-days,
    .dayContainer {
        padding: 6px 8px 12px !important;
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    /* Header (Month & Year) */
    .flatpickr-months {
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
        border-bottom: 1px solid #F1F5F9 !important;
        padding: 12px 14px 8px !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
    }
    .flatpickr-months .flatpickr-month {
        color: #0F172A !important;
        fill: #0F172A !important;
        height: 34px !important;
    }
    .flatpickr-current-month {
        color: #0F172A !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        padding-top: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 4px !important;
    }
    .flatpickr-current-month .cur-month {
        color: #0F172A !important;
        font-weight: 700 !important;
        font-size: 15px !important;
    }
    .flatpickr-current-month input.cur-year {
        color: #0F172A !important;
        font-weight: 700 !important;
        font-size: 15px !important;
    }
    .flatpickr-months .flatpickr-prev-month,
    .flatpickr-months .flatpickr-next-month {
        color: #64748B !important;
        fill: #64748B !important;
        width: 28px !important;
        height: 28px !important;
        border-radius: 8px !important;
        padding: 6px !important;
        top: 10px !important;
        transition: all 0.15s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .flatpickr-months .flatpickr-prev-month svg,
    .flatpickr-months .flatpickr-next-month svg {
        width: 14px !important;
        height: 14px !important;
        fill: currentColor !important;
    }
    .flatpickr-months .flatpickr-prev-month:hover,
    .flatpickr-months .flatpickr-next-month:hover {
        color: #0F172A !important;
        fill: #0F172A !important;
        background: #F1F5F9 !important;
    }

    /* Weekday Row (SUN MON TUE WED THU FRI SAT) — NO TEAL/GREEN BAR */
    .flatpickr-weekdays {
        background: #F8FAFC !important;
        background-color: #F8FAFC !important;
        border-top: 1px solid #F1F5F9 !important;
        border-bottom: 1px solid #F1F5F9 !important;
        padding: 6px 0 !important;
        height: 34px !important;
    }
    .flatpickr-weekdays .flatpickr-weekdaycontainer {
        background: transparent !important;
        background-color: transparent !important;
    }
    .flatpickr-weekdays span.flatpickr-weekday,
    span.flatpickr-weekday {
        background: transparent !important;
        background-color: transparent !important;
        color: #64748B !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        line-height: 22px !important;
    }

    /* Days */
    .flatpickr-day {
        color: #0F172A !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        border: 1.5px solid transparent !important;
        height: 36px !important;
        line-height: 33px !important;
        margin: 1px auto !important;
        background: transparent !important;
        transition: all 0.15s ease !important;
    }
    .flatpickr-day:hover,
    .flatpickr-day:focus {
        background: #F1F5F9 !important;
        color: #0F172A !important;
        border-color: transparent !important;
    }

    /* Today (Day 4 in Reference Image: Soft peach bg + orange border + bold orange text) */
    .flatpickr-day.today {
        border: 1.5px solid #EA580C !important;
        color: #EA580C !important;
        background: #FFF7ED !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
    }
    .flatpickr-day.today:hover,
    .flatpickr-day.today:focus {
        background: #FFEDD5 !important;
        border-color: #EA580C !important;
        color: #C2410C !important;
    }

    /* Selected Day */
    .flatpickr-day.selected,
    .flatpickr-day.selected:hover,
    .flatpickr-day.selected:focus {
        background: linear-gradient(135deg, #EA580C, #F97316) !important;
        border-color: #EA580C !important;
        color: #FFFFFF !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3) !important;
        border-radius: 8px !important;
    }

    /* Non-month Days (Muted slate grey) */
    .flatpickr-day.prevMonthDay,
    .flatpickr-day.nextMonthDay {
        color: #CBD5E1 !important;
        font-weight: 400 !important;
        background: transparent !important;
        border-color: transparent !important;
    }

    /* Clean Text Formatting for Date Filter Inputs */
    .dash-flatpickr,
    .ibk-flatpickr {
        background-image: none !important;
        text-align: center !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        letter-spacing: 0.5px !important;
        outline: none !important;
    }
    .dash-flatpickr:focus,
    .dash-flatpickr:focus-visible,
    .dash-flatpickr.active,
    .ibk-flatpickr:focus,
    .ibk-flatpickr:focus-visible,
    .ibk-flatpickr.active {
        outline: none !important;
        border-color: #EA580C !important;
        -webkit-box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
    }

    /* Optional Dark Mode Flatpickr (Only when html explicitly has dark attribute) */
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-calendar,
    html[data-theme="dark"]:not(.theme-light) .flatpickr-calendar,
    body.theme-dark .flatpickr-calendar {
        background: #181411 !important;
        border: 1px solid rgba(245, 158, 11, 0.28) !important;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.85), 0 0 20px rgba(245, 158, 11, 0.08) !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-innerContainer,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-rContainer,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-days,
    html[data-layout-mode="dark"]:not(.theme-light) .dayContainer,
    body.theme-dark .flatpickr-innerContainer,
    body.theme-dark .flatpickr-rContainer,
    body.theme-dark .flatpickr-days,
    body.theme-dark .dayContainer {
        background: #181411 !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-months,
    body.theme-dark .flatpickr-months {
        background: #14100D !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-months .flatpickr-month,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-current-month,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-current-month .cur-month,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-current-month input.cur-year,
    body.theme-dark .flatpickr-months .flatpickr-month,
    body.theme-dark .flatpickr-current-month,
    body.theme-dark .flatpickr-current-month .cur-month,
    body.theme-dark .flatpickr-current-month input.cur-year {
        color: #FAFAFA !important;
        fill: #FAFAFA !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-weekdays,
    body.theme-dark .flatpickr-weekdays {
        background: #14100D !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-weekdays span.flatpickr-weekday,
    body.theme-dark .flatpickr-weekdays span.flatpickr-weekday {
        color: #A8A29E !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day,
    body.theme-dark .flatpickr-day {
        color: #F5EFE6 !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day:hover,
    body.theme-dark .flatpickr-day:hover {
        background: rgba(245, 158, 11, 0.16) !important;
        color: #FAFAFA !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day.today,
    body.theme-dark .flatpickr-day.today {
        border: 1.5px solid #F59E0B !important;
        color: #F59E0B !important;
        background: rgba(245, 158, 11, 0.14) !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day.selected,
    body.theme-dark .flatpickr-day.selected {
        background: linear-gradient(135deg, #F59E0B, #EA580C) !important;
        border-color: #F59E0B !important;
        color: #FFFFFF !important;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.45) !important;
    }
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day.prevMonthDay,
    html[data-layout-mode="dark"]:not(.theme-light) .flatpickr-day.nextMonthDay,
    body.theme-dark .flatpickr-day.prevMonthDay,
    body.theme-dark .flatpickr-day.nextMonthDay {
        color: #57534E !important;
    }

    /* ==========================================================================
       CHOICES.JS GLOBAL STYLING (WARM OBSIDIAN & NO SCROLLBAR)
       ========================================================================== */
    .choices {
        margin-bottom: 0 !important;
    }
    .choices__inner {
        background: #181411 !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 8px !important;
        color: #FAFAFA !important;
        min-height: 38px !important;
        padding: 4px 10px !important;
        font-size: 13.5px !important;
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

    /* HIDE CHOICES SCROLLBAR */
    .choices__list,
    .choices__list--dropdown .choices__list {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    .choices__list::-webkit-scrollbar,
    .choices__list--dropdown .choices__list::-webkit-scrollbar {
        width: 0 !important;
        height: 0 !important;
        display: none !important;
    }

    /* Choices.js Light Mode */
    body.theme-light .choices__inner {
        background: #FFFFFF !important;
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

    /* Flatpickr Timepicker Dark Styling */
    .flatpickr-calendar.hasTime.noCalendar {
        background: #161e2e !important;
        border: 1px solid rgba(255, 255, 255, 0.16) !important;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.5) !important;
        border-radius: 10px !important;
        padding: 6px 10px !important;
        width: auto !important;
    }
    .flatpickr-time {
        background: transparent !important;
        border: none !important;
        height: 40px !important;
        line-height: 40px !important;
    }
    .flatpickr-time .numInputWrapper input {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 15px !important;
    }
    .flatpickr-time .flatpickr-time-separator {
        color: #94a3b8 !important;
        font-weight: 700 !important;
    }
    .flatpickr-time .numInputWrapper span {
        opacity: 0.75 !important;
    }
    .flatpickr-time .numInputWrapper span.arrowUp:after {
        border-bottom-color: #38bdf8 !important;
    }
    .flatpickr-time .numInputWrapper span.arrowDown:after {
        border-top-color: #38bdf8 !important;
    }
    .flatpickr-time .numInputWrapper span:hover {
        opacity: 1 !important;
        background: rgba(56, 189, 248, 0.25) !important;
    }

/* =========================================================
   TOKABE SIGNATURE PAGINATION (IDENTICAL TO DAFTAR INVOICE)
   ========================================================= */
.main-content {
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    min-height: 100vh !important;
    padding-bottom: 0 !important;
}

.ibk-page-stage {
    flex: 1 0 auto !important;
    display: flex !important;
    flex-direction: column !important;
    width: 100% !important;
}

.ibk-page-stage > .page-content {
    flex: 1 0 auto !important;
    padding-bottom: 24px !important;
}

.ibk-page-stage.is-entering {
    opacity: 0;
    filter: blur(3px);
    transform: translate3d(0, 8px, 0);
}

.ibk-page-stage.is-entering-active {
    will-change: opacity, transform, filter;
    backface-visibility: hidden;
    animation: ibkPageEnter 480ms cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

.ibk-page-stage.is-leaving {
    will-change: opacity, transform, filter;
    backface-visibility: hidden;
    animation: ibkPageExit 280ms cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
    pointer-events: none;
}

@keyframes ibkPageEnter {
    0% {
        opacity: 0;
        filter: blur(3px);
        transform: translate3d(0, 8px, 0);
    }
    100% {
        opacity: 1;
        filter: blur(0px);
        transform: translate3d(0, 0, 0);
    }
}

@keyframes ibkPageExit {
    0% {
        opacity: 1;
        filter: blur(0px);
        transform: translate3d(0, 0, 0);
    }
    100% {
        opacity: 0;
        filter: blur(3px);
        transform: translate3d(0, -4px, 0);
    }
}

@media (prefers-reduced-motion: reduce) {
    .ibk-page-stage.is-entering,
    .ibk-page-stage.is-entering-active,
    .ibk-page-stage.is-leaving {
        animation: none !important;
        opacity: 1 !important;
        filter: none !important;
        transform: none !important;
    }
}

.footer {
    position: static !important;
    left: auto !important;
    right: auto !important;
    bottom: auto !important;
    width: 100% !important;
    height: auto !important;
    min-height: 52px !important;
    margin-top: auto !important;
    padding: 16px 24px !important;
    background: transparent !important;
    border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
    color: #A8A29E !important;
    font-size: 13px !important;
    display: flex !important;
    align-items: center !important;
}

html.theme-light .footer,
body.theme-light .footer,
html[data-layout-mode="light"] .footer {
    background: transparent !important;
    border-top: 1px solid #E6E1D8 !important;
    color: #57534E !important;
}

.ibk-invoice-wrapper,
.ibk-catalog-wrapper {
    padding-bottom: 75px !important;
    margin-bottom: 24px !important;
}

.ibk-table-card,
.tokabe-card {
    margin-bottom: 28px !important;
}

.ibk-table-footer {
    padding: 16px 24px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    border-top: 1px solid var(--ibk-border, #334155) !important;
    background: var(--ibk-surface, transparent) !important;
    border-bottom-left-radius: 12px !important;
    border-bottom-right-radius: 12px !important;
    position: relative !important;
    z-index: 5 !important;
    min-height: 64px !important;
    box-sizing: border-box !important;
}

body.theme-light .ibk-table-footer,
html.theme-light .ibk-table-footer,
html[data-layout-mode="light"] .ibk-table-footer {
    border-top-color: #E2E8F0 !important;
    background: #FFFFFF !important;
}

#tokabeCustomInfo,
.ibk-table-footer #tokabeCustomInfo {
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
    padding: 0 !important;
    flex: 1 1 auto !important;
    min-width: 200px !important;
}

#tokabeCustomPaginate,
.ibk-table-footer #tokabeCustomPaginate {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    margin-left: auto !important;
    padding: 0 !important;
}

/* Fallback for DataTables wrapper default bottom row */
.dataTables_wrapper > .row:last-child,
div.dataTables_wrapper div.row:last-child {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 14px 20px 18px 20px !important;
    margin: 0 !important;
    border-top: 1px solid var(--ibk-border, #334155) !important;
    gap: 12px !important;
    background: var(--ibk-surface, transparent) !important;
}

/* Hide empty wrapper row when pagination has been relocated to custom footer */
.dataTables_wrapper > .row:last-child:empty,
div.dataTables_wrapper div.row:last-child:empty,
.ibk-table-card .dataTables_wrapper > .row:last-child,
.ibk-table-card div.dataTables_wrapper div.row:last-child,
.ibk-catalog-card .dataTables_wrapper > .row:last-child,
.ibk-catalog-card div.dataTables_wrapper div.row:last-child {
    display: none !important;
    margin: 0 !important;
    padding: 0 !important;
    border: none !important;
    height: 0 !important;
    min-height: 0 !important;
}

body.theme-light .dataTables_wrapper > .row:last-child,
body.theme-light div.dataTables_wrapper div.row:last-child,
html.theme-light .dataTables_wrapper > .row:last-child,
html[data-layout-mode="light"] .dataTables_wrapper > .row:last-child {
    border-top-color: #E2E8F0 !important;
    background: #FFFFFF !important;
}

.dataTables_wrapper .dataTables_info,
div.dataTables_wrapper div.dataTables_info,
#tokabeCustomInfo .dataTables_info {
    color: var(--ibk-text-muted, #94A3B8) !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    padding: 0 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
}

body.theme-light .dataTables_wrapper .dataTables_info,
body.theme-light div.dataTables_wrapper div.dataTables_info,
body.theme-light #tokabeCustomInfo .dataTables_info {
    color: #64748B !important;
}

.dataTables_wrapper .dataTables_paginate,
div.dataTables_wrapper div.dataTables_paginate,
#tokabeCustomPaginate .dataTables_paginate,
.dataTables_paginate {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    padding: 0 !important;
    margin: 0 !important;
}

.dataTables_paginate ul.pagination,
div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 4px 6px !important;
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px !important;
    height: 42px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 2px 8px rgba(0, 0, 0, 0.2) !important;
    box-sizing: border-box !important;
}

body.theme-light .dataTables_paginate ul.pagination,
html.theme-light .dataTables_paginate ul.pagination,
body.theme-light div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    background: #F8FAFC !important;
    border: 1px solid #E2E8F0 !important;
    box-shadow: 0 1px 4px rgba(15, 23, 42, 0.06) !important;
}

.dataTables_paginate li.page-item,
div.dataTables_wrapper div.dataTables_paginate li.page-item {
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    display: inline-flex !important;
}

.dataTables_paginate .page-link,
.dataTables_paginate .paginate_button,
div.dataTables_wrapper div.dataTables_paginate .page-link,
div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    min-width: 34px !important;
    height: 34px !important;
    padding: 0 10px !important;
    margin: 0 !important;
    border-radius: 8px !important;
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
    font-size: 12.5px !important;
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
    transition: all 0.15s ease !important;
    user-select: none !important;
    box-sizing: border-box !important;
}

body.theme-light .dataTables_paginate .page-link,
body.theme-light .dataTables_paginate .paginate_button,
html.theme-light .dataTables_paginate .page-link,
html.theme-light .dataTables_paginate .paginate_button,
body.theme-light div.dataTables_wrapper div.dataTables_paginate .page-link {
    color: #475569 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
}

/* Active Page Pill Pop Animation */
@keyframes ibkPageActivePop {
    0% { transform: scale(0.88); opacity: 0.7; }
    60% { transform: scale(1.1); }
    100% { transform: translateY(-1px) scale(1.06); opacity: 1; }
}

.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
.dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
div.dataTables_wrapper div.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover {
    background: rgba(249, 115, 22, 0.14) !important;
    border-color: rgba(249, 115, 22, 0.35) !important;
    color: #FB923C !important;
    transform: translateY(-2px) scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2) !important;
}

body.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
body.theme-light .dataTables_paginate .paginate_button:not(.current):not(.disabled):hover,
html.theme-light .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
html[data-layout-mode="light"] .dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:hover {
    background: #FFF7ED !important;
    border-color: #FDBA74 !important;
    color: #C2410C !important;
    transform: translateY(-2px) scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.12) !important;
}

.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:active,
.dataTables_paginate .paginate_button:not(.current):not(.disabled):active,
div.dataTables_wrapper div.dataTables_paginate li.page-item:not(.active):not(.disabled) .page-link:active {
    transform: scale(0.94) !important;
}

.dataTables_paginate li.page-item.active .page-link,
.dataTables_paginate .paginate_button.current,
div.dataTables_wrapper div.dataTables_paginate li.page-item.active .page-link {
    background: linear-gradient(135deg, #F97316 0%, #F59E0B 100%) !important;
    color: #1A0F05 !important;
    font-weight: 700 !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 4px 16px rgba(249, 115, 22, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.35) !important;
    transform: translateY(-1px) scale(1.06) !important;
    animation: ibkPageActivePop 260ms cubic-bezier(.2,.8,.2,1) !important;
    z-index: 2 !important;
}

body.theme-light .dataTables_paginate li.page-item.active .page-link,
body.theme-light .dataTables_paginate .paginate_button.current,
html.theme-light .dataTables_paginate li.page-item.active .page-link,
html.theme-light .dataTables_paginate .paginate_button.current,
html[data-layout-mode="light"] .dataTables_paginate li.page-item.active .page-link,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item.active .page-link {
    background: linear-gradient(135deg, #EA580C 0%, #F59E0B 100%) !important;
    color: #FFFFFF !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35) !important;
    transform: translateY(-1px) scale(1.06) !important;
    animation: ibkPageActivePop 260ms cubic-bezier(.2,.8,.2,1) !important;
}

/* Smooth Table Reloading Transition */
table.tokabe-table tbody,
#alternative-pagination tbody,
#scroll-horizontal tbody {
    transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
table.tokabe-table.dataTable-reloading tbody,
#alternative-pagination.dataTable-reloading tbody,
#scroll-horizontal.dataTable-reloading tbody {
    opacity: 0.35 !important;
    pointer-events: none !important;
}

.dataTables_paginate li.page-item.previous .page-link,
.dataTables_paginate li.page-item.next .page-link,
.dataTables_paginate li.page-item.first .page-link,
.dataTables_paginate li.page-item.last .page-link,
.dataTables_paginate .paginate_button.previous,
.dataTables_paginate .paginate_button.next {
    font-size: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    background: rgba(255, 255, 255, 0.04) !important;
}

body.theme-light .dataTables_paginate li.page-item.previous .page-link,
body.theme-light .dataTables_paginate li.page-item.next .page-link,
body.theme-light .dataTables_paginate li.page-item.first .page-link,
body.theme-light .dataTables_paginate li.page-item.last .page-link,
body.theme-light .dataTables_paginate .paginate_button.previous,
body.theme-light .dataTables_paginate .paginate_button.next,
body.theme-light div.dataTables_wrapper div.dataTables_paginate li.page-item.previous .page-link {
    border: 1px solid #E2E8F0 !important;
    background: #FFFFFF !important;
    color: #475569 !important;
}

.dataTables_paginate li.page-item.disabled .page-link,
.dataTables_paginate .paginate_button.disabled,
div.dataTables_wrapper div.dataTables_paginate li.page-item.disabled .page-link {
    opacity: 0.35 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    background: transparent !important;
    border-color: transparent !important;
    color: #94A3B8 !important;
    box-shadow: none !important;
    transform: none !important;
}

/* =========================================================
   SEGMENTED CATEGORY NAV & ANIMATED GLIDER
   ========================================================= */
.ibk-segmented-nav {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    background: var(--ibk-input-bg) !important;
    border: 1px solid var(--ibk-border) !important;
    border-radius: 8px !important;
    padding: 3px !important;
    gap: 2px !important;
    flex-wrap: wrap !important;
    isolation: isolate !important;
}

.ibk-nav-glider {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 0 !important;
    height: 0 !important;
    background: var(--ibk-brand-soft, rgba(234, 88, 12, 0.12)) !important;
    border: 1px solid var(--ibk-brand-border, rgba(234, 88, 12, 0.3)) !important;
    border-radius: 6px !important;
    pointer-events: none !important;
    z-index: 1 !important;
    opacity: 0;
    box-sizing: border-box !important;
    transition: transform 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                width 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                height 260ms cubic-bezier(0.25, 1, 0.5, 1), 
                opacity 150ms ease !important;
}

body.theme-light .ibk-nav-glider,
html.theme-light .ibk-nav-glider {
    background: #FFF7ED !important;
    border: 1px solid #FED7AA !important;
    box-shadow: 0 1px 3px rgba(234, 88, 12, 0.12) !important;
}

.ibk-segmented-nav .tombol {
    position: relative !important;
    z-index: 2 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    color: var(--ibk-text-muted) !important;
    padding: 5px 12px !important;
    border-radius: 6px !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: color 150ms ease !important;
    white-space: nowrap !important;
    outline: none !important;
    box-shadow: none !important;
}

.ibk-segmented-nav .tombol:hover {
    color: var(--ibk-text) !important;
}

.ibk-segmented-nav .tombol.btn-info {
    color: #EA580C !important;
    font-weight: 600 !important;
    background: transparent !important;
    border-color: transparent !important;
}

body.theme-light .ibk-segmented-nav .tombol.btn-info,
html.theme-light .ibk-segmented-nav .tombol.btn-info {
    color: #EA580C !important;
}
</style>
</head>

<body>
<script>if(document.documentElement.classList.contains('theme-light'))document.body.classList.add('theme-light');</script>
    @include('sweetalert::alert')
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                </div>
            </div>
        </div>

        {{-- SIDEBAR COMPONENT --}}
        @include('layout.sidebar')

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="ibk-page-stage is-entering" id="ibkPageStage">
                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Ibekami
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Hidden Logout Form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    @include('layout.vendor-script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    document.documentElement.classList.remove("ibk-preload");
                });
            });

            // 1. Toggle responsive sidebar size (sm-hover <-> lg)
            var hamburger = document.getElementById("topnav-hamburger-icon");
            if (hamburger) {
                hamburger.addEventListener("click", function () {
                    var html = document.documentElement;
                    var currentSize = html.getAttribute("data-sidebar-size");
                    var newSize = (currentSize === "sm-hover" || currentSize === "sm") ? "lg" : "sm-hover";
                    html.setAttribute("data-sidebar-size", newSize);
                    sessionStorage.setItem("data-sidebar-size", newSize);
                });
            }

            // 2. Keep sidebar expanded while dropdown is open
            var sidebar = document.querySelector(".navbar-menu");
            document.querySelectorAll(".sidebar-org-box .dropdown, .sidebar-user-footer .dropup").forEach(function (el) {
                el.addEventListener("show.bs.dropdown", function () {
                    if (sidebar) sidebar.classList.add("user-dropdown-active");
                });
                el.addEventListener("hidden.bs.dropdown", function () {
                    if (sidebar) sidebar.classList.remove("user-dropdown-active");
                });
            });

            // 3. Coordinate smooth submenu accordion enter & exit animations
            document.querySelectorAll(".navbar-menu .menu-dropdown").forEach(function (collapseEl) {
                collapseEl.addEventListener("show.bs.collapse", function () {
                    this.classList.remove("is-closing");
                    this.classList.add("is-opening");
                });
                collapseEl.addEventListener("shown.bs.collapse", function () {
                    this.classList.remove("is-opening");
                });
                collapseEl.addEventListener("hide.bs.collapse", function () {
                    this.classList.remove("is-opening");
                    this.classList.add("is-closing");
                });
                collapseEl.addEventListener("hidden.bs.collapse", function () {
                    this.classList.remove("is-closing");
                });
            });

            // 4. Highlight active sidebar links & propagate active color to parent dropdown
            function updateSidebarActiveStates() {
                document.querySelectorAll(".navbar-menu .sub-menu-list .nav-link.active").forEach(function(activeSub) {
                    var parentDropdown = activeSub.closest(".menu-dropdown");
                    if (parentDropdown) {
                        var parentItem = parentDropdown.closest(".nav-item");
                        if (parentItem) {
                            parentItem.classList.add("has-active-child");
                            var parentLink = parentItem.querySelector(":scope > .nav-link");
                            if (parentLink) {
                                parentLink.classList.add("active");
                            }
                        }
                    }
                });
            }
            updateSidebarActiveStates();

            // 5. Instant visual color feedback when clicking sidebar links
            document.querySelectorAll(".navbar-menu .navbar-nav .nav-link").forEach(function(link) {
                link.addEventListener("click", function() {
                    if (this.getAttribute("data-bs-toggle") === "collapse") {
                        return;
                    }
                    document.querySelectorAll(".navbar-menu .navbar-nav .nav-link").forEach(function(l) {
                        if (l.getAttribute("data-bs-toggle") !== "collapse") {
                            l.classList.remove("active");
                        }
                    });
                    this.classList.add("active");
                });
            });

            // 6. Sync theme toggle icon and text state on page load
            (function() {
                var isLight = document.body.classList.contains('theme-light') || document.documentElement.classList.contains('theme-light');
                document.querySelectorAll('#theme-toggle-icon, .theme-toggle-icon').forEach(function(icon) {
                    if (isLight) {
                        icon.classList.remove('ri-sun-line');
                        icon.classList.add('ri-moon-line');
                    } else {
                        icon.classList.remove('ri-moon-line');
                        icon.classList.add('ri-sun-line');
                    }
                });
                document.querySelectorAll('#theme-toggle-text').forEach(function(span) {
                    span.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
                });
            })();
        });

        // ==========================================================================
        // GLOBAL CIRCULAR REVEAL THEME CONTROLLER (VIEW TRANSITION API)
        // ==========================================================================
        var isGlobalThemeTransitioning = false;

        window.toggleDashboardTheme = function(event) {
            if (isGlobalThemeTransitioning) return;
            isGlobalThemeTransitioning = true;

            var current = document.body.classList.contains('theme-light') ? 'light' : 'dark';
            var targetTheme = (current === 'light') ? 'dark' : 'light';

            var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            var supportsViewTransition = typeof document.startViewTransition === 'function';

            function updateDOMTheme(theme) {
                var isLight = (theme === 'light');
                var root = document.documentElement;

                root.setAttribute('data-theme', theme);
                root.setAttribute('data-layout-mode', theme);
                root.setAttribute('data-sidebar', isLight ? 'light' : 'dark');

                if (isLight) {
                    root.classList.add('theme-light');
                    root.classList.remove('theme-dark');
                    if (document.body) {
                        document.body.classList.add('theme-light');
                        document.body.classList.remove('theme-dark');
                    }
                } else {
                    root.classList.add('theme-dark');
                    root.classList.remove('theme-light');
                    if (document.body) {
                        document.body.classList.add('theme-dark');
                        document.body.classList.remove('theme-light');
                    }
                }

                try {
                    localStorage.setItem('tokabe_theme', theme);
                    localStorage.setItem('ibekami_dash_theme', theme);
                    sessionStorage.setItem('data-layout-mode', theme);
                    sessionStorage.setItem('data-sidebar', isLight ? 'light' : 'dark');
                } catch(e) {}

                // Update icon in all theme toggle buttons across page
                document.querySelectorAll('#theme-toggle-icon, .theme-toggle-icon').forEach(function(icon) {
                    if (isLight) {
                        icon.classList.remove('ri-sun-line');
                        icon.classList.add('ri-moon-line');
                    } else {
                        icon.classList.remove('ri-moon-line');
                        icon.classList.add('ri-sun-line');
                    }
                });

                // Update text label if present
                document.querySelectorAll('#theme-toggle-text').forEach(function(span) {
                    span.textContent = isLight ? 'Mode Gelap' : 'Mode Terang';
                });

                // If dashboard charts need updating
                if (typeof window.updateAllChartsTheme === 'function') {
                    window.updateAllChartsTheme(theme);
                }
            }

            var btn = document.getElementById('btn-theme-toggle') || (event && event.target ? event.target.closest('button') : null);
            if (btn) btn.classList.add('theme-switching');

            if (!supportsViewTransition || prefersReducedMotion) {
                updateDOMTheme(targetTheme);
                if (btn) btn.classList.remove('theme-switching');
                isGlobalThemeTransitioning = false;
                return;
            }

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
                    updateDOMTheme(targetTheme);
                });

                if (transition && typeof transition.ready !== 'undefined') {
                    Promise.resolve(transition.ready).then(function() {
                        var anim = document.documentElement.animate(
                            {
                                clipPath: [
                                    'circle(0px at ' + x + 'px ' + y + 'px)',
                                    'circle(' + endRadius + 'px at ' + x + 'px ' + y + 'px)'
                                ]
                            },
                            {
                                duration: 850,
                                easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
                                pseudoElement: '::view-transition-new(root)'
                            }
                        );

                        if (anim && typeof anim.finished !== 'undefined') {
                            Promise.resolve(anim.finished).then(function() {
                                if (btn) btn.classList.remove('theme-switching');
                                isGlobalThemeTransitioning = false;
                            }).catch(function() {
                                if (btn) btn.classList.remove('theme-switching');
                                isGlobalThemeTransitioning = false;
                            });
                        } else {
                            setTimeout(function() {
                                if (btn) btn.classList.remove('theme-switching');
                                isGlobalThemeTransitioning = false;
                            }, 850);
                        }
                    }).catch(function() {
                        if (btn) btn.classList.remove('theme-switching');
                        isGlobalThemeTransitioning = false;
                    });
                } else {
                    if (btn) btn.classList.remove('theme-switching');
                    isGlobalThemeTransitioning = false;
                }
            } catch (err) {
                updateDOMTheme(targetTheme);
                if (btn) btn.classList.remove('theme-switching');
                isGlobalThemeTransitioning = false;
            }
        };

        (function initGlobalPageTransitions() {
            var stage = document.getElementById('ibkPageStage');
            if (!stage) return;

            var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            var isNavigating = false;

            function clearEnterState() {
                stage.classList.remove('is-entering', 'is-entering-active');
            }

            function playEnterAnimation() {
                if (prefersReduced) {
                    clearEnterState();
                    return;
                }
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        if (!isNavigating) {
                            stage.classList.add('is-entering-active');
                        }
                    });
                });
            }

            if (prefersReduced) {
                clearEnterState();
            } else {
                stage.addEventListener('animationend', function (e) {
                    if (e.animationName === 'ibkPageEnter') {
                        clearEnterState();
                    }
                });
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', playEnterAnimation);
                } else {
                    playEnterAnimation();
                }
                setTimeout(clearEnterState, 900);
            }

            window.addEventListener('pageshow', function (event) {
                isNavigating = false;
                stage.classList.remove('is-leaving');
                if (event.persisted && !prefersReduced) {
                    clearEnterState();
                    stage.classList.add('is-entering');
                    void stage.offsetWidth;
                    playEnterAnimation();
                }
            });

            document.addEventListener('click', function (e) {
                if (e.defaultPrevented || isNavigating || prefersReduced) return;
                if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;

                var link = e.target.closest('a[href]');
                if (!link) return;
                if (link.hasAttribute('download')) return;
                if (link.getAttribute('target') === '_blank') return;
                if (link.hasAttribute('data-bs-toggle')) return;
                if (link.getAttribute('onclick')) return;

                var rawHref = (link.getAttribute('href') || '').trim();
                if (!rawHref || rawHref.charAt(0) === '#' || rawHref.indexOf('javascript:') === 0 || rawHref.indexOf('mailto:') === 0 || rawHref.indexOf('tel:') === 0) {
                    return;
                }

                var targetUrl;
                try {
                    targetUrl = new URL(link.href, window.location.href);
                } catch (err) {
                    return;
                }

                if (targetUrl.origin !== window.location.origin) return;
                if (targetUrl.href === window.location.href) return;

                e.preventDefault();
                isNavigating = true;
                clearEnterState();
                stage.classList.add('is-leaving');

                setTimeout(function () {
                    window.location.href = targetUrl.href;
                }, 270);
            });
        })();
    </script>
</body>
</html>
