<!doctype html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk ke Akun — Ibekami POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Kasir & Invoice Terintegrasi Ibekami" name="description" />
    <meta content="Ibekami" name="author" />

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/Ibekami.png') }}">

    <!-- Google Fonts: Inter & JetBrains Mono (DESIGN.md §5.1) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ==========================================================================
           TOKABE DESIGN SYSTEM - FULLSCREEN SPLIT LOGIN (DESIGN.md)
           Palette: Dark Slate (#020617, #0F172A, #161B22, #1E293B, #334155)
           Accent: Golden Amber (#FBBF24 / #F59E0B) & Brand Indigo (#4F46E5)
           ========================================================================== */
        :root {
            --bg-app: #0B0F19;
            --bg-surface: #0F172A;
            --bg-surface-2: #161B22;
            --bg-input: #070D18;
            --border-subtle: #1E293B;
            --border-default: #334155;
            --border-focus: #F59E0B;
            --text-primary: #F8FAFC;
            --text-secondary: #CBD5E1;
            --text-tertiary: #94A3B8;
            --text-disabled: #64748B;
            --accent-amber: #F59E0B;
            --accent-amber-light: #FBBF24;
            --brand: #4F46E5;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 26px;
            --radius-pill: 9999px;
            --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        * {
            box-sizing: border-box;
        }

        /* 100% Fit Viewport, Strictly No Scrollbar */
        html, body {
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            overflow: hidden !important;
            background-color: var(--bg-app);
            font-family: var(--font-sans);
            color: var(--text-primary);
        }

        /* Fullscreen Edge-to-Edge Grid */
        .login-fullscreen-layout {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Glow behind left panel */
        .ambient-left-glow {
            position: absolute;
            top: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* ========================================================
           LEFT COLUMN: FULL-HEIGHT AUTH FORM PANE
           ======================================================== */
        .login-left-pane {
            flex: 1;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 28px 36px;
            position: relative;
            z-index: 1;
            background-color: var(--bg-app);
            overflow-y: auto;
            scrollbar-width: none;
        }
        .login-left-pane::-webkit-scrollbar {
            display: none;
        }

        @media (min-width: 992px) {
            .login-left-pane {
                flex: 0 0 46%;
                max-width: 46%;
                padding: 32px 56px;
            }
        }

        @media (min-width: 1400px) {
            .login-left-pane {
                flex: 0 0 42%;
                max-width: 42%;
                padding: 40px 72px;
            }
        }

        /* Brand Pill (Matching reference "Crextio" pill) */
        .brand-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid var(--border-default);
            border-radius: var(--radius-pill);
            padding: 6px 16px;
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: -0.01em;
            width: fit-content;
            margin-bottom: 0;
            backdrop-filter: blur(8px);
        }

        .login-top-bar {
            display: flex;
            align-items: center;
        }

        .login-form-center {
            margin: auto 0;
            width: 100%;
            max-width: 460px;
            padding: 8px 0;
        }

        .brand-pill-badge img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        /* Form Heading & Subtitle */
        .login-heading {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            margin-bottom: 4px;
            line-height: 1.25;
        }

        .login-subtitle {
            font-size: 13px;
            color: var(--text-tertiary);
            margin-bottom: 22px;
            line-height: 1.45;
        }

        /* Form Fields */
        .form-label-auth {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-auth {
            background-color: var(--bg-input) !important;
            border: 1.5px solid var(--border-default) !important;
            color: var(--text-primary) !important;
            border-radius: var(--radius-md) !important;
            height: 44px !important;
            padding: 0 16px !important;
            font-size: 13.5px !important;
            transition: all 0.2s ease;
            width: 100% !important;
        }

        .form-control-auth:focus {
            border-color: var(--accent-amber) !important;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.25) !important;
            background-color: #040810 !important;
            color: #FFFFFF !important;
            outline: none !important;
        }

        .form-control-auth::placeholder {
            color: var(--text-disabled) !important;
        }

        .form-control-auth:-webkit-autofill,
        .form-control-auth:-webkit-autofill:hover, 
        .form-control-auth:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #070D18 inset !important;
            -webkit-text-fill-color: var(--text-primary) !important;
        }

        /* Password Toggle Button */
        .password-wrap {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--text-tertiary);
            padding: 4px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease;
        }

        .password-toggle-btn:hover {
            color: var(--text-primary);
        }

        /* Remember Me & Links */
        .auth-check-label {
            font-size: 12.5px;
            color: var(--text-secondary) !important;
            cursor: pointer;
            user-select: none;
        }

        .auth-checkbox {
            background-color: var(--bg-input) !important;
            border: 1.5px solid var(--border-default) !important;
            cursor: pointer;
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        .auth-checkbox:checked {
            background-color: var(--accent-amber);
            border-color: var(--accent-amber);
        }

        .auth-link {
            font-size: 12px;
            color: var(--text-tertiary);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .auth-link:hover {
            color: var(--accent-amber-light);
            text-decoration: underline;
        }

        /* Golden Amber Action Button (Matching reference "Submit") */
        .btn-auth-submit {
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%) !important;
            border: 1px solid rgba(251, 191, 36, 0.4) !important;
            color: #0F172A !important;
            font-weight: 700;
            font-size: 14.5px;
            letter-spacing: 0.01em;
            border-radius: var(--radius-md);
            height: 46px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(245, 158, 11, 0.35);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: 6px;
        }

        .btn-auth-submit:hover {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.45);
            color: #000000 !important;
        }

        .btn-auth-submit:active {
            transform: scale(0.99);
        }

        /* Role Hint Chips */
        .role-hint-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .role-hint-chip {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-tertiary);
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 6px;
            padding: 3px 8px;
        }

        /* Bottom Footer */
        .login-footer-row {
            margin-top: 24px;
            padding-top: 14px;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            font-size: 12px;
            color: var(--text-disabled);
        }

        .login-footer-row a {
            color: var(--text-tertiary);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .login-footer-row a:hover {
            color: var(--text-primary);
        }

        /* Alert Styling */
        .auth-alert {
            background-color: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #FCA5A5;
            border-radius: var(--radius-md);
            padding: 9px 12px;
            font-size: 12.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .auth-alert-success {
            background-color: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6EE7B7;
        }

        /* ========================================================
           RIGHT COLUMN: HERO SHOWCASE (Direct, edge-to-edge frame)
           ======================================================== */
        .login-hero-wrapper {
            flex: 1;
            height: 100vh;
            padding: 14px 14px 14px 0;
            display: none;
        }

        @media (min-width: 992px) {
            .login-hero-wrapper {
                display: flex;
            }
        }

        .login-hero-card {
            width: 100%;
            height: 100%;
            border-radius: var(--radius-xl);
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 28px;
            background: 
                linear-gradient(180deg, rgba(2, 6, 23, 0.25) 0%, rgba(2, 6, 23, 0.75) 100%),
                url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat,
                url("{{ asset('images/bg-auth.jpg') }}") center/cover no-repeat;
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.6), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        /* Hero Top Header: Status & Close button */
        .hero-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 3;
        }

        .hero-version-pill {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-pill);
            padding: 5px 14px;
            font-size: 11.5px;
            font-weight: 600;
            color: #E2E8F0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .hero-version-dot {
            width: 6.5px;
            height: 6.5px;
            border-radius: 50%;
            background: #10B981;
            box-shadow: 0 0 6px #10B981;
        }

        .hero-close-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #CBD5E1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.15s ease;
            font-size: 16px;
        }

        .hero-close-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* Floating Widgets Container */
        .hero-widgets-area {
            position: relative;
            z-index: 3;
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* 1. Top Floating Task Card (Golden Amber like in screenshot) */
        .hero-float-task {
            align-self: flex-start;
            background: #FBBF24;
            color: #0F172A;
            padding: 9px 15px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 0 15px rgba(251, 191, 36, 0.3);
            display: inline-block;
            max-width: 230px;
            transition: transform 0.2s ease;
        }

        .hero-float-task:hover {
            transform: translateY(-2px);
        }

        .task-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 2px;
        }

        .task-title {
            font-size: 12px;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.2;
        }

        .task-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0F172A;
        }

        .task-time {
            font-size: 10.5px;
            font-weight: 600;
            color: #78350F;
        }

        /* 2. Middle Frosted Glass Calendar Widget (Exact Match to screenshot!) */
        .hero-calendar-glass {
            background: rgba(15, 23, 42, 0.68);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 350px;
        }

        .cal-days-row, .cal-dates-row {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
        }

        .cal-days-row {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-tertiary);
            margin-bottom: 6px;
        }

        .cal-dates-row {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            font-variant-numeric: tabular-nums;
        }

        .cal-date-cell {
            padding: 3px 0;
            border-radius: 4px;
        }

        .cal-date-active {
            color: #FBBF24;
            position: relative;
        }

        /* Diagonal Stripe Pattern beneath active day */
        .cal-stripe-accent {
            margin-top: 6px;
            height: 7px;
            border-radius: 3px;
            background: repeating-linear-gradient(
                -45deg,
                rgba(251, 191, 36, 0.4),
                rgba(251, 191, 36, 0.4) 3px,
                transparent 3px,
                transparent 7px
            );
        }

        /* 3. Floating Avatar Stack (Overlapping on side) */
        .hero-avatar-stack {
            position: absolute;
            right: 22px;
            top: 48%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: -8px;
            z-index: 4;
        }

        .avatar-bubble {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid #0F172A;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            margin-top: -10px;
            transition: transform 0.2s ease;
        }

        .avatar-bubble:first-child {
            margin-top: 0;
        }

        .avatar-bubble:hover {
            transform: scale(1.15) !important;
            z-index: 10;
        }

        /* 4. Bottom Floating Card (Daily Meeting / Real-time Sync) */
        .hero-bottom-card {
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 14px;
            padding: 10px 15px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.6);
            width: fit-content;
            min-width: 210px;
            align-self: flex-start;
        }

        .live-dot-pulse {
            width: 6.5px;
            height: 6.5px;
            border-radius: 50%;
            background: #10B981;
            box-shadow: 0 0 6px #10B981;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 5px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .mini-avatar-group {
            display: flex;
            align-items: center;
        }

        .mini-avatar {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 2px solid #0F172A;
            object-fit: cover;
            margin-left: -5px;
        }

        .mini-avatar:first-child {
            margin-left: 0;
        }

        .mini-avatar-more {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #334155;
            color: #F1F5F9;
            font-size: 9.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #0F172A;
            margin-left: -5px;
        }
    </style>
</head>

<body>
    <!-- Fullscreen Edge-to-Edge Layout (No Box Container, 100% Fit) -->
    <div class="login-fullscreen-layout">
        <!-- Ambient Light -->
        <div class="ambient-left-glow"></div>

        <!-- ========================================================
             LEFT COLUMN: DIRECT FORM PANE
             ======================================================== -->
        <div class="login-left-pane">
            <!-- Top Bar: Brand Pill -->
            <div class="login-top-bar">
                <div class="brand-pill-badge">
                    <img src="{{ asset('images/Ibekami.png') }}" alt="Ibekami" style="width: 20px; height: 20px; object-fit: contain;">
                    <span>Ibekami POS</span>
                </div>
            </div>

            <!-- Center Body: Form Centered Vertically -->
            <div class="login-form-center">
                <!-- Header -->
                <h1 class="login-heading">Masuk ke Akun</h1>
                <p class="login-subtitle">Silakan masukkan email dan kata sandi untuk mengakses sistem POS IBEKAMI.</p>

                <!-- Alert Notifikasi Session -->
                @if(session()->has('error'))
                    <div class="auth-alert" role="alert">
                        <i class="las la-exclamation-circle fs-18"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="auth-alert auth-alert-success" role="alert">
                        <i class="las la-check-circle fs-18"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ route('login') }}" method="POST" id="loginForm" autocomplete="on">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-2">
                        <label for="inputEmail" class="form-label-auth">
                            Alamat Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                            class="form-control form-control-auth @error('email') is-invalid @enderror" 
                            id="inputEmail" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="nama@ibekami.com" 
                            required 
                            autocomplete="email" 
                            autofocus>
                        @error('email')
                            <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <label for="inputPassword" class="form-label-auth mb-0">
                                Kata Sandi <span class="text-danger">*</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link">Lupa sandi?</a>
                            @endif
                        </div>
                        <div class="password-wrap">
                            <input type="password" 
                                class="form-control form-control-auth pe-5 @error('password') is-invalid @enderror" 
                                id="inputPassword" 
                                name="password" 
                                placeholder="••••••••••••" 
                                required 
                                autocomplete="current-password">
                            <button type="button" class="password-toggle-btn" id="togglePasswordBtn" aria-label="Lihat kata sandi">
                                <i class="las la-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Checkbox Ingat Saya -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="form-check m-0">
                            <input class="form-check-input auth-checkbox" type="checkbox" name="remember" id="rememberCheck" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label auth-check-label" for="rememberCheck">
                                Ingat saya di perangkat ini
                            </label>
                        </div>
                    </div>

                    <!-- Golden Amber Submit Button (Exact reference style!) -->
                    <button type="submit" class="btn-auth-submit" id="submitLoginBtn">
                        <span>Masuk Sekarang</span>
                        <i class="las la-arrow-right fs-16"></i>
                    </button>

                    <!-- Role Hint Chips -->
                    <div class="role-hint-row">
                        <span class="role-hint-chip"><i class="las la-user-shield me-1"></i>Admin</span>
                        <span class="role-hint-chip"><i class="las la-cash-register me-1"></i>Magang</span>
                        <span class="role-hint-chip"><i class="las la-boxes me-1"></i>Stockist</span>
                        <span class="role-hint-chip"><i class="las la-crown me-1"></i>Pemilik</span>
                    </div>
                </form>
            </div>

            <!-- Footer Row -->
            <div class="login-footer-row">
                <span>Butuh akses akun? <a href="mailto:admin@ibekami.id" class="text-white fw-semibold">Hubungi Admin</a></span>
                <span>&copy; {{ date('Y') }} Ibekami POS</span>
            </div>
        </div>

        <!-- ========================================================
             RIGHT COLUMN: SHOWCASE HERO WITH FLOATING GLASS WIDGETS
             ======================================================== -->
        <div class="login-hero-wrapper">
            <div class="login-hero-card">
                <!-- Top Row: Status & Close button -->
                <div class="hero-top-row">
                    <div class="hero-version-pill">
                        <span class="hero-version-dot"></span>
                        <span>POS v2.0 &bull; Cloud Active</span>
                    </div>
                    <a href="{{ url('/') }}" class="hero-close-btn" title="Kembali ke Beranda">
                        <i class="las la-times"></i>
                    </a>
                </div>

                <!-- Floating Avatar Stack on the Right -->
                <div class="hero-avatar-stack">
                    <img src="{{ asset('images/users/avatar-1.jpg') }}" class="avatar-bubble" width="42" height="42" alt="Admin" title="Admin POS">
                    <img src="{{ asset('images/users/avatar-2.jpg') }}" class="avatar-bubble" width="42" height="42" alt="Kasir" title="Kasir Toko">
                    <img src="{{ asset('images/users/avatar-3.jpg') }}" class="avatar-bubble" width="42" height="42" alt="Staff" title="Operator Produksi">
                </div>

                <!-- Floating Frosted Glass Widgets Area -->
                <div class="hero-widgets-area">
                    <!-- Widget 1: Top Floating Task Card (Golden Amber) -->
                    <div class="hero-float-task">
                        <div class="task-header">
                            <span class="task-title">Shift Aktif</span>
                            <span class="task-dot"></span>
                        </div>
                        <span class="task-time">08.30 - 17.00 WIB</span>
                    </div>

                    <!-- Widget 2: Middle Frosted Glass Calendar (Exact match to reference!) -->
                    <div class="hero-calendar-glass">
                        <div class="cal-days-row">
                            <span>Min</span>
                            <span>Sen</span>
                            <span>Sel</span>
                            <span>Rab</span>
                            <span>Kam</span>
                            <span>Jum</span>
                            <span>Sab</span>
                        </div>
                        <div class="cal-dates-row">
                            <span class="cal-date-cell">24</span>
                            <span class="cal-date-cell">25</span>
                            <span class="cal-date-cell">26</span>
                            <span class="cal-date-cell cal-date-active">27</span>
                            <span class="cal-date-cell">28</span>
                            <span class="cal-date-cell">29</span>
                            <span class="cal-date-cell">30</span>
                        </div>
                        <div class="cal-stripe-accent"></div>
                    </div>

                    <!-- Widget 3: Bottom Live Status Card -->
                    <div class="hero-bottom-card">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="fw-semibold text-white fs-12">Sistem POS IBEKAMI</span>
                            <span class="live-dot-pulse"></span>
                        </div>
                        <div class="text-muted fs-11 mb-2">Sinkronisasi Real-time Aktif</div>
                        <div class="mini-avatar-group">
                            <img src="{{ asset('images/users/avatar-4.jpg') }}" class="mini-avatar" width="25" height="25" alt="Team 1">
                            <img src="{{ asset('images/users/avatar-5.jpg') }}" class="mini-avatar" width="25" height="25" alt="Team 2">
                            <img src="{{ asset('images/users/avatar-6.jpg') }}" class="mini-avatar" width="25" height="25" alt="Team 3">
                            <span class="mini-avatar-more">+3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JAVASCRIPT: Interactivity -->
    <script>
        $(document).ready(function() {
            // Password Show/Hide Toggle
            $('#togglePasswordBtn').on('click', function() {
                var passwordInput = $('#inputPassword');
                var icon = $('#togglePasswordIcon');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('la-eye').addClass('la-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('la-eye-slash').addClass('la-eye');
                }
            });

            // Prevent double submission
            $('#loginForm').on('submit', function() {
                var btn = $('#submitLoginBtn');
                btn.prop('disabled', true);
                btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...');
            });
        });
    </script>
</body>
</html>

