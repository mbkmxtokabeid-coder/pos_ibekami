<!doctype html>
<html lang="en" data-layout-mode="dark" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none" data-preloader="disable">

<head>

<meta charset="utf-8" />
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

<!-- Preload & Load Google Font DM Sans with display=swap to prevent layout shift (CLS) -->
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

{{-- HEAD CSS  --}}
@yield('head')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    /* =========================================================
       ULTRA-SMOOTH SHADCN THEMED SIDEBAR STYLING (IBEKAMI)
       ========================================================= */
    :root {
        --shadcn-sidebar-bg: #0d1117;
        --shadcn-sidebar-surface: #161b22;
        --shadcn-sidebar-border: rgba(255, 255, 255, 0.08);
        --shadcn-sidebar-muted: #8b949e;
        --shadcn-sidebar-text: #e6edf3;
        --shadcn-sidebar-active-bg: rgba(56, 189, 248, 0.12);
        --shadcn-sidebar-active-text: #38bdf8;
        --shadcn-sidebar-hover-bg: rgba(255, 255, 255, 0.06);
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
        border-radius: 8px;
        background: #1f2937;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.12);
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
        font-weight: 600;
        color: #f0f6fc;
        line-height: 1.2;
    }
    .org-badge-pro {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #38bdf8;
        background: rgba(56, 189, 248, 0.12);
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
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: #4b5563 !important;
        white-space: nowrap;
        overflow: hidden;
    }
    .sidebar-badge-beta {
        font-size: 9px !important;
        font-weight: 700 !important;
        padding: 2px 6px !important;
        border-radius: 4px !important;
        background: rgba(56, 189, 248, 0.15) !important;
        color: #38bdf8 !important;
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
        color: var(--shadcn-sidebar-muted) !important;
        transform: rotate(-90deg) !important;
        transform-origin: center center !important;
        transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), color 0.18s ease !important;
        will-change: transform;
    }
    .navbar-menu .navbar-nav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]:after {
        transform: rotate(0deg) !important;
        color: #ffffff !important;
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
        color: #38bdf8 !important;
        background: rgba(56, 189, 248, 0.12) !important;
        font-weight: 600 !important;
    }
    .navbar-menu .navbar-nav .sub-menu-list .nav-link.active .sub-menu-icon {
        color: #38bdf8 !important;
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
        background: linear-gradient(135deg, #10b981, #06b6d4);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        margin-left: 9px;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
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
        background: #161b22 !important;
        border: 1px solid var(--shadcn-sidebar-border) !important;
        border-radius: 12px !important;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.06) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
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
        color: #F8FAFC;
    }
    .shadcn-dropdown-menu .shadcn-item {
        padding: 8px 12px !important;
        border-radius: 7px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #E2E8F0 !important;
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
       SWEETALERT2 DARK THEME & HIGH-CONTRAST TOAST NOTIFICATIONS
       ========================================================= */
    .swal2-popup.swal2-toast {
        background: #1e293b !important;
        border: 1px solid rgba(255, 255, 255, 0.16) !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.6), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important;
        border-radius: 12px !important;
        padding: 12px 16px !important;
    }
    .swal2-popup.swal2-toast .swal2-title {
        color: #ffffff !important;
        font-size: 14.5px !important;
        font-weight: 700 !important;
        letter-spacing: 0.2px !important;
        margin-bottom: 4px !important;
        text-align: left !important;
    }
    .swal2-popup.swal2-toast .swal2-html-container {
        color: #cbd5e1 !important;
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
        border-color: #38bdf8 !important;
        color: #38bdf8 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-success {
        border-color: #10b981 !important;
        color: #10b981 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-warning {
        border-color: #f59e0b !important;
        color: #f59e0b !important;
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error {
        border-color: #ef4444 !important;
        color: #ef4444 !important;
    }
    .swal2-popup.swal2-toast .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #38bdf8, #818cf8) !important;
        height: 3px !important;
        border-radius: 0 0 12px 12px !important;
    }

    /* Regular Modal SweetAlert */
    .swal2-popup:not(.swal2-toast) {
        background: #161e2e !important;
        border: 1px solid rgba(255, 255, 255, 0.14) !important;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.7) !important;
        border-radius: 14px !important;
        color: #f1f5f9 !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-title {
        color: #ffffff !important;
        font-weight: 700 !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-html-container {
        color: #cbd5e1 !important;
        font-size: 14px !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-close {
        color: #94a3b8 !important;
    }
    .swal2-popup:not(.swal2-toast) .swal2-close:hover {
        color: #ffffff !important;
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
</style>
</head>

<body>
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
            @yield('content')

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
        });
    </script>
</body>
</html>
