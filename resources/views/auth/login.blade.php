<!doctype html>
<html lang="id" class="dark" data-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — Ibekami</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Kasir, Invoice, dan Produksi Ibekami" name="description" />
    <meta content="Ibekami" name="author" />

    <link rel="shortcut icon" href="{{ asset('images/Ibekami.png') }}">

    <!-- Preload Logo for Zero-Lag Intro -->
    <link rel="preload" as="image" href="{{ asset('images/Ibekami.png') }}">

    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        :root,
        .dark {
            --background: #070709;
            --foreground: #FAFAFA;

            /* Apple Liquid Glass Surface Tokens */
            --glass-card-bg: linear-gradient(
                145deg,
                rgba(255, 255, 255, 0.055) 0%,
                rgba(255, 255, 255, 0.015) 55%,
                rgba(245, 158, 11, 0.025) 100%
            );
            --glass-card-border: rgba(255, 255, 255, 0.16);
            --glass-card-shadow:
                0 24px 54px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.28),
                inset 0 -1px 0 0 rgba(255, 255, 255, 0.06),
                inset 1px 0 0 0 rgba(255, 255, 255, 0.10);

            /* Apple Liquid Glass Input Tokens */
            --glass-input-bg: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.05) 0%,
                rgba(255, 255, 255, 0.015) 100%
            );
            --glass-input-bg-hover: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.085) 0%,
                rgba(255, 255, 255, 0.03) 100%
            );
            --glass-input-bg-focus: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.09) 0%,
                rgba(245, 158, 11, 0.04) 100%
            );
            --glass-input-border: rgba(255, 255, 255, 0.18);
            --glass-input-border-hover: rgba(255, 255, 255, 0.30);
            --glass-input-shadow:
                inset 0 1px 0 0 rgba(255, 255, 255, 0.24),
                inset 0 -1px 0 0 rgba(255, 255, 255, 0.05),
                0 4px 14px rgba(0, 0, 0, 0.15);

            --primary: #F59E0B;
            --primary-hover: #FBBF24;
            --primary-foreground: #09090B;

            --muted-foreground: #A1A5B2;
            --placeholder: rgba(255, 255, 255, 0.38);
            --footer-text: rgba(255, 255, 255, 0.42);

            --destructive: #EF4444;
            --destructive-bg: rgba(239, 68, 68, 0.12);
            --destructive-border: rgba(239, 68, 68, 0.32);

            --success: #10B981;
            --success-bg: rgba(16, 185, 129, 0.12);
            --success-border: rgba(16, 185, 129, 0.32);

            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --ease: 160ms cubic-bezier(0.2, 0, 0, 1);
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            background-color: var(--background);
            color: var(--foreground);
            font-family: var(--font-sans);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        @media (min-width: 768px) {
            html, body {
                height: 100vh;
                overflow: hidden;
            }
        }

        /* ==========================================================================
           LIQUID GLASS LOGO REVEAL + SHARED-ELEMENT FLY-TO-HEADER OVERLAY
           ========================================================================== */
        .glass-intro-overlay {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            user-select: none;
            opacity: 1;
            visibility: visible;
            transition: opacity 220ms ease-out, visibility 220ms ease-out;
        }

        .glass-intro-overlay.is-finished {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .glass-intro-stage {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .glass-intro-caption {
            position: relative;
            z-index: 2;
            margin-top: 260px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            pointer-events: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 380ms cubic-bezier(0.22, 1, 0.36, 1), transform 380ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .glass-intro-caption.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .glass-intro-caption.is-hiding {
            opacity: 0;
            transform: translateY(-10px) scale(0.96);
        }

        .glass-intro-brand {
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.9);
        }

        .glass-intro-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.45);
        }

        /* Smooth Staggered Entrance of Login Elements as Logo Flies In */
        body.intro-active .brand-icon {
            opacity: 0;
        }

        body.intro-active.intro-landed .brand-icon {
            opacity: 1;
            transition: opacity 180ms ease-out;
        }

        body.intro-active .brand-title,
        body.intro-active .heading-block,
        body.intro-active .login-card,
        body.intro-active .login-footer {
            opacity: 0;
            transform: translateY(14px);
        }

        body.intro-docking .brand-title,
        body.intro-docking .heading-block,
        body.intro-docking .login-card,
        body.intro-docking .login-footer {
            opacity: 1;
            transform: translateY(0);
            transition:
                opacity 620ms cubic-bezier(0.22, 1, 0.36, 1),
                transform 620ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        body.intro-docking .heading-block {
            transition-delay: 50ms;
        }

        body.intro-docking .login-card {
            transition-delay: 100ms;
        }

        body.intro-docking .login-footer {
            transition-delay: 150ms;
        }

        /* ==========================================================================
           REACT BITS <SideRays /> WEBGL2 BACKGROUND CONTAINER
           ========================================================================== */
        .side-rays-bg {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .side-rays-canvas {
            position: absolute;
            inset: 0;
            display: block;
            width: 100%;
            height: 100%;
        }

        /* ==========================================================================
           FOREGROUND LOGIN SHELL
           ========================================================================== */
        .login-viewport {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-container {
            width: 100%;
            max-width: 384px;
        }

        /* Brand Header (Liquid Glass Icon Box) */
        .brand-row {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
            color: var(--foreground);
            margin-bottom: 24px;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.10), rgba(255, 255, 255, 0.03));
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.22), 0 8px 20px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px;
            transition: opacity 150ms ease-out;
        }

        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--foreground);
        }

        /* Heading Block */
        .heading-block {
            margin-bottom: 22px;
        }

        .heading-title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: var(--foreground);
            margin: 0 0 8px 0;
            line-height: 1.2;
        }

        .heading-subtitle {
            font-size: 14px;
            color: var(--muted-foreground);
            margin: 0;
            line-height: 1.5;
        }

        /* ==========================================================================
           APPLE LIQUID GLASS CARD & INPUTS
           Translucent refractive glass so SideRays light shimmers through
           ========================================================================== */
        .login-card {
            position: relative;
            background: var(--glass-card-bg);
            border: 1px solid var(--glass-card-border);
            border-radius: 18px;
            padding: 24px;
            backdrop-filter: blur(14px) saturate(160%);
            -webkit-backdrop-filter: blur(14px) saturate(160%);
            box-shadow: var(--glass-card-shadow);
        }

        /* Alerts */
        .alert-banner {
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 12.5px;
            margin-bottom: 16px;
            line-height: 1.45;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .alert-banner.is-error {
            background-color: var(--destructive-bg);
            border: 1px solid var(--destructive-border);
            color: #FCA5A5;
        }

        .alert-banner.is-success {
            background-color: var(--success-bg);
            border: 1px solid var(--success-border);
            color: #6EE7B7;
        }

        .d-none {
            display: none !important;
        }

        /* Fields */
        .field-group {
            margin-bottom: 18px;
        }

        .field-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .field-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--foreground);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
        }

        .forgot-link {
            font-size: 12.5px;
            color: var(--muted-foreground);
            text-decoration: none;
            transition: color var(--ease);
            border-radius: 4px;
        }

        .forgot-link:hover {
            color: var(--foreground);
        }

        .forgot-link:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
            color: var(--foreground);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Apple Liquid Glass Input */
        .form-input {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            background: var(--glass-input-bg);
            border: 1px solid var(--glass-input-border);
            border-radius: 10px;
            color: var(--foreground);
            font-family: var(--font-sans);
            font-size: 14px;
            backdrop-filter: blur(14px) saturate(150%);
            -webkit-backdrop-filter: blur(14px) saturate(150%);
            box-shadow: var(--glass-input-shadow);
            transition: border-color var(--ease), box-shadow var(--ease), background var(--ease);
        }

        .form-input.has-toggle {
            padding-right: 42px;
        }

        .form-input::placeholder {
            color: var(--placeholder);
        }

        .form-input:hover {
            background: var(--glass-input-bg-hover);
            border-color: var(--glass-input-border-hover);
        }

        .form-input:focus,
        .form-input:focus-visible {
            outline: none;
            background: var(--glass-input-bg-focus);
            border-color: rgba(245, 158, 11, 0.75);
            box-shadow:
                inset 0 1px 0 0 rgba(255, 255, 255, 0.25),
                0 0 0 3px rgba(245, 158, 11, 0.22),
                0 8px 24px rgba(245, 158, 11, 0.12);
        }

        .form-input.is-invalid {
            border-color: var(--destructive);
        }

        /* Keep Chrome Autofill 100% Translucent Liquid Glass (No Opaque Fill) */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--foreground) !important;
            caret-color: var(--foreground);
            -webkit-box-shadow:
                inset 0 1px 0 0 rgba(255, 255, 255, 0.20),
                0 0 0 1000px rgba(255, 255, 255, 0.04) inset !important;
            transition: background-color 99999s ease-in-out 0s;
        }

        .eye-btn {
            position: absolute;
            right: 4px;
            width: 36px;
            height: 36px;
            background: transparent;
            border: none;
            border-radius: 7px;
            color: rgba(255, 255, 255, 0.6);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 17px;
            transition: color var(--ease), background-color var(--ease);
        }

        .eye-btn:hover {
            color: var(--foreground);
            background-color: rgba(255, 255, 255, 0.06);
        }

        .eye-btn:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: -2px;
            color: var(--foreground);
        }

        .field-error {
            font-size: 12px;
            color: #F87171;
            margin-top: 6px;
        }

        /* Liquid Glass Checkbox */
        .remember-block {
            margin: 16px 0 20px 0;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.72);
            cursor: pointer;
            user-select: none;
            transition: color var(--ease);
        }

        .checkbox-label:hover {
            color: var(--foreground);
        }

        .checkbox-input {
            appearance: none;
            -webkit-appearance: none;
            width: 17px;
            height: 17px;
            margin: 0;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 5px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            cursor: pointer;
            display: inline-grid;
            place-content: center;
            transition: background-color var(--ease), border-color var(--ease), box-shadow var(--ease);
        }

        .checkbox-input::before {
            content: "";
            width: 9px;
            height: 5px;
            border-left: 2px solid var(--primary-foreground);
            border-bottom: 2px solid var(--primary-foreground);
            transform: rotate(-45deg) scale(0);
            margin-top: -1px;
            transition: transform 100ms ease-in-out;
        }

        .checkbox-input:checked {
            background: var(--primary);
            border-color: #FBBF24;
        }

        .checkbox-input:checked::before {
            transform: rotate(-45deg) scale(1);
        }

        .checkbox-input:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.35);
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 44px;
            background: linear-gradient(180deg, #FBBF24 0%, #F59E0B 100%);
            border: 1px solid #FDE68A;
            border-radius: 10px;
            color: var(--primary-foreground);
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35), 0 8px 20px rgba(245, 158, 11, 0.25);
            transition: filter var(--ease), transform var(--ease), box-shadow var(--ease);
        }

        .btn-submit:hover:not(:disabled) {
            filter: brightness(1.06);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.45), 0 10px 24px rgba(245, 158, 11, 0.32);
        }

        .btn-submit:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.45);
        }

        .btn-submit:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        /* Footer */
        .login-footer {
            margin-top: 26px;
            text-align: center;
            font-size: 12.5px;
            color: var(--footer-text);
        }
    </style>
</head>

@php
    $skipIntro = $errors->any() || session()->has('error') || session()->has('success');
@endphp

<body class="{{ $skipIntro ? '' : 'intro-active' }}">
    <!-- 21st.dev Liquid Glass Logo Reveal Intro Overlay (Flies into #targetBrandIcon) -->
    <div
        id="glassIntroOverlay"
        class="glass-intro-overlay {{ $skipIntro ? 'is-finished' : '' }}"
        role="img"
        aria-label="Intro Ibekami Liquid Glass">
        <div id="glassIntroStage" class="glass-intro-stage"></div>
        <div id="glassIntroCaption" class="glass-intro-caption">
            <span class="glass-intro-brand">Ibekami</span>
            <span class="glass-intro-sub">Ikhtiar Berkah</span>
        </div>
    </div>

    <!-- React Bits <SideRays /> WebGL2 Background -->
    <div id="sideRaysContainer" class="side-rays-bg" aria-hidden="true">
        <canvas id="sideRaysCanvas" class="side-rays-canvas" aria-hidden="true"></canvas>
    </div>

    <main class="login-viewport">
        <div class="login-container">
            <a href="{{ url('/') }}" class="brand-row" id="replayIntroBtn" title="Putar ulang intro">
                <span class="brand-icon" id="targetBrandIcon">
                    <img src="{{ asset('images/Ibekami.png') }}" alt="Ibekami" width="20" height="20">
                </span>
                <span class="brand-title">Ibekami</span>
            </a>

            <div class="heading-block">
                <h1 class="heading-title" id="loginTitle">Masuk ke akun</h1>
                <p class="heading-subtitle">Gunakan email dan kata sandi untuk membuka workspace Anda.</p>
            </div>

            <section class="login-card" data-slot="card" aria-labelledby="loginTitle">
                @if(session()->has('error'))
                    <div class="alert-banner is-error" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert-banner is-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div id="clientErrorBox" class="alert-banner is-error d-none" role="alert">
                    Harap isi alamat email dan kata sandi terlebih dahulu.
                </div>

                <form action="{{ route('login') }}" method="POST" id="loginForm" autocomplete="on" novalidate>
                    @csrf

                    <div class="field-group">
                        <div class="field-header">
                            <label for="inputEmail" class="field-label" data-slot="label">Email</label>
                        </div>
                        <div class="input-wrapper">
                            <input
                                type="email"
                                data-slot="input"
                                class="form-input @error('email') is-invalid @enderror"
                                id="inputEmail"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@ibekami.com"
                                required
                                autocomplete="email"
                                autofocus>
                        </div>
                        @error('email')
                            <div class="field-error" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <div class="field-header">
                            <label for="inputPassword" class="field-label" data-slot="label">Kata sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Lupa kata sandi?</a>
                            @endif
                        </div>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                data-slot="input"
                                class="form-input has-toggle @error('password') is-invalid @enderror"
                                id="inputPassword"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                required
                                autocomplete="current-password">
                            <button
                                type="button"
                                class="eye-btn"
                                id="togglePasswordBtn"
                                aria-label="Tampilkan kata sandi"
                                aria-pressed="false">
                                <i class="las la-eye" id="togglePasswordIcon" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="remember-block">
                        <label class="checkbox-label" for="rememberCheck">
                            <input
                                class="checkbox-input"
                                data-slot="checkbox"
                                type="checkbox"
                                name="remember"
                                id="rememberCheck"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>Ingat perangkat ini</span>
                        </label>
                    </div>

                    <button type="submit" data-slot="button" class="btn-submit" id="submitLoginBtn">
                        Masuk
                    </button>
                </form>
            </section>

            <footer class="login-footer">
                &copy; {{ date('Y') }} Ibekami, Ikhtiar Berkah
            </footer>
        </div>
    </main>

    <!-- 1) Liquid Glass Logo Reveal + Fly-to-Header Engine + 2) <SideRays /> Engine -->
    <script>
        (function() {
            /* ==========================================================================
               PART 1: LIQUID GLASS LOGO REVEAL + FLY-TO-HEADER ENGINE
               Phase 1 (0.0s -> 1.85s): Liquid droplet lands, refracts Ibekami logo, sweeps sheen
               Phase 2 (1.85s -> 2.75s): Glass icon shrinks & glides directly into #targetBrandIcon
               ========================================================================== */
            const TEX = 512;
            const BOX = 0.75;

            const INTRO_SETTINGS = {
                tileSize: 200,
                logoScale: 0.68,
                finalScale: 0.82,
                logoOffset: [0, 0],
                iconPlate: true,
                keepPlate: true,
                originalColors: true,
                opticalDepth: 0.75,
                dispersion: 0.95,
                colorBleed: 0.45,
                doubleBevel: 1,
                bevelWidth: 0.20,
                corner: 4.4,
                cornerPull: 1.35,
                cornerWidth: 1.2,
                cornerFocus: 0.40,
                edgeSmear: 1.15,
                stretch: 0,
                tilt: 0.08,
                bulge: 1,
                specular: 1,
                halo: 1,
                shadow: 0,
                ripple: 0.55,
                bounce: 0,
                response: 0.36,
                startSize: 0.22,
                startZoom: 1.55,
                glide: 1.05,
                present: 1.15,
                drift: 0.03,
                swell: 0.4,
                focus: 1,
                sheen: 1,
                lightTurn: 0.9,
                hold: 0.2,
                background: "#070709",
                plateColor: "#111216",
                logoColor: "#F59E0B"
            };

            const GLASS_VERT = `#version 300 es
in vec2 aPos;
void main() { gl_Position = vec4(aPos, 0.0, 1.0); }`;

            const GLASS_FRAG = `#version 300 es
precision highp float;
out vec4 outColor;

uniform vec2 uCenter;
uniform float uTile;
uniform sampler2D uSdf;
uniform sampler2D uCol;
uniform float uTexSize;
uniform float uBoxFrac;

uniform float uPlateScale;
uniform float uShapeN;
uniform float uCornerN;
uniform float uOptics;
uniform float uPlateAlpha;
uniform float uLogoHalf;
uniform vec2 uLogoOff;
uniform float uBold;
uniform float uBlur;
uniform float uFrost;
uniform float uDome;
uniform float uDrop;
uniform float uPinch;
uniform float uTilt;
uniform float uRim;
uniform float uHalo;
uniform float uShadow;
uniform float uGhost;
uniform float uRipR;
uniform float uRipA;
uniform float uBare;
uniform float uReach;
uniform float uCornerPull;
uniform float uStreak;
uniform float uWiden;
uniform float uSlab;
uniform float uEtaSpread;
uniform float uFocus;
uniform float uFocusK;
uniform float uFocusSplit;
uniform float uRimLine;
uniform float uCornerOn;
uniform float uDissolve;
uniform float uGlow;
uniform float uFaceDisp;
uniform float uVivid;

uniform float uDisp;
uniform float uDouble;
uniform float uBevelW;
uniform float uSpec;
uniform float uIconPlate;
uniform float uUseColor;
uniform float uLightScene;
uniform float uLightGlass;
uniform float uKeep;
uniform float uSheen;
uniform float uSweep;
uniform float uLightAng;
uniform float uBgAlpha;

uniform vec3 uBg;
uniform vec3 uPlateCol;
uniform vec3 uLogoCol;

float px;

vec2 rot(vec2 v, float a) { float c = cos(a), s = sin(a); return vec2(c * v.x - s * v.y, s * v.x + c * v.y); }

vec4 logoAt(vec2 q, float blur, float aa) {
  float L = uLogoHalf;
  float k = 0.5 * uBoxFrac / L;
  vec2 uv = vec2(0.5 + (q.x - uLogoOff.x) * k, 0.5 - (q.y - uLogoOff.y) * k);
  float d = texture(uSdf, uv).r / k;
  float w = 0.75 * aa + blur;
  float a = 1.0 - smoothstep(-w, w, d - uBold * L);
  vec3 c = uLogoCol;
  if (uUseColor > 0.5) {
    float lod = log2(max(1.0, w * k * uTexSize));
    vec4 c0 = textureLod(uCol, uv, lod);
    vec4 c1 = textureLod(uCol, uv, lod + 3.0);
    vec4 c2 = textureLod(uCol, uv, 7.0);
    c = c2.rgb / max(c2.a, 1e-4);
    c = mix(c, c1.rgb / max(c1.a, 1e-4), smoothstep(0.0, 0.06, c1.a));
    c = mix(c, c0.rgb / max(c0.a, 1e-4), smoothstep(0.02, 0.3, c0.a));
  }
  return vec4(c, a);
}

float shape(vec2 p, float scale, float n, out vec2 nOut, out float g, out vec2 dg) {
  vec2 pp = p / scale;
  vec2 a = max(abs(pp), vec2(1e-6));
  g = pow(pow(a.x, n) + pow(a.y, n), 1.0 / n);
  dg = sign(pp) * pow(a, vec2(n - 1.0)) * pow(max(g, 1e-6), 1.0 - n);
  float dgl = max(length(dg), 1e-6);
  nOut = dg / dgl;
  return (g - 1.0) / dgl * scale;
}

float contourRadius(vec2 p, float scale, float n) {
  vec2 a = max(abs(p / scale), vec2(1e-4));
  vec2 a1 = pow(a, vec2(n - 1.0));
  vec2 a2 = pow(a, vec2(n - 2.0));
  float k = (n - 1.0) * (a2.x * a1.y * a1.y + a2.y * a1.x * a1.x) / pow(max(dot(a1, a1), 1e-30), 1.5);
  return scale / max(k, 1e-3);
}

vec2 refractSample(float x, float bwF, float eta, float R, vec2 dirOut, vec2 p, float dome, float offMul) {
  float u = clamp(1.0 - x, 0.0, 0.995);
  float th = asin(u), thr = asin(u / eta);
  float z = uSlab + bwF * sqrt(1.0 - u * u);
  float off = offMul * z * tan(th - thr);
  off = off / (1.0 + off / (6.0 * R));
  return p - (dirOut * off + p * dome) * uOptics;
}

float gauss(float x, float c, float w) { float d = (x - c) / w; return exp(-0.5 * d * d); }
float band(float x, float a, float b, float w) { return smoothstep(a - w, a, x) * (1.0 - smoothstep(b, b + w, x)); }
float bump(float x, float c, float w) { float d = (x - c) / w; return exp(-0.5 * d * d); }
vec3 spectrum(float x) {
  return vec3(bump(x, 0.34, 0.2) + 0.08 * bump(x, 0.93, 0.05), bump(x, 0.58, 0.1), bump(x, 0.8, 0.11));
}
float hash(vec2 p) { return fract(sin(dot(p, vec2(12.9898, 78.233))) * 43758.5453); }

void main() {
  px = 2.0 / uTile;
  vec2 p = (gl_FragCoord.xy - uCenter) * px;

  if (max(abs(p.x), abs(p.y)) > uPlateScale * 1.48) {
    outColor = vec4(uBg * uBgAlpha, uBgAlpha);
    return;
  }

  vec2 nOut, dg; float g;
  float sd = shape(p, uPlateScale, uShapeN, nOut, g, dg);
  float s = -sd;
  float bw = max(uBevelW, 0.004) * uPlateScale;
  float x = clamp(s / bw, 0.0, 1.0);
  float R = contourRadius(p, uPlateScale, uShapeN);
  vec2 pq = p * p;
  float diag = 4.0 * pq.x * pq.y / max((pq.x + pq.y) * (pq.x + pq.y), 1e-6);
  float tilt = mix(1.0 - uTilt, 1.0, smoothstep(-0.02, 0.02, p.x * p.y));
  float pinchPart = uPinch * min(g * g, 1.0) * diag * diag * tilt;
  float dome = uDome * (1.0 - min(g * g, 1.0)) + pinchPart;
  vec2 dirOut = normalize(mix(nOut, p / max(length(p), 1e-4), 0.2));
  float cornerness = max(smoothstep(0.1, 0.9, 4.0 * nOut.x * nOut.x * nOut.y * nOut.y), smoothstep(0.15, 0.75, diag));
  float offMul = 1.0 + 0.4 * max(uCornerPull - 1.0, 0.0) * tilt * cornerness * uCornerOn;
  vec2 focus = sign(p) * (pow(0.5, 1.0 / uShapeN) - uFocus * 0.70710678) * uPlateScale;
  float focusW = tilt * cornerness * uOptics * uCornerOn;
  float bwF = max(uReach, 0.004) * (1.0 + uWiden * tilt * cornerness * uCornerOn);
  float xf = clamp(s / bwF, 0.0, 1.0);
  vec2 qc = refractSample(xf, bwF, 1.5, R, dirOut, p, dome, offMul);
  float foot = max(max(length(dFdx(qc)), length(dFdy(qc))), 0.25 * px);

  vec3 bg = uBg;
  float outside = max(sd, 0.0);
  if (uRipA > 0.001) {
    float d0 = (uRipR - 1.0) * uPlateScale;
    float rx = (sd - d0) / 0.022;
    float ring = exp(-rx * rx);
    bg += uRipA * ring * (0.04 * (0.55 + 0.45 * dot(nOut, normalize(vec2(-0.5, 0.8)))));
  }
  vec3 haloCol = vec3(0.96, 0.65, 0.15);
  float haloAmt = clamp(uHalo * (0.25 * exp(-outside / (0.025 * uPlateScale)) + 0.06 * exp(-outside / (0.12 * uPlateScale))), 0.0, 1.0) * step(0.0, sd);
  bg = mix(bg, haloCol, haloAmt);

  vec3 col = bg;
  float cov = 0.0;
  float soft = px + uBlur * 0.8;
  if (sd < soft) {
    float y1 = 1.0 - x;
    const float K = 2.6;
    float base1 = max(1.0 - pow(y1, K), 1e-4);
    float db = min(pow(y1, K - 1.0) * pow(base1, 1.0 / K - 1.0), 25.0);
    float s1 = bw * 0.62;
    float w2 = bw * 0.22;
    float t2 = clamp((s - s1) / w2, -1.0, 1.0);
    float dh2 = uDouble * bw * 0.16;
    float dd = dh2 * 0.5 * cos(t2 * 1.5707963) * 1.5707963 / w2 * step(abs(t2), 0.999);
    vec2 gDome = -uDome * 2.0 * g * dg * step(g, 1.0);
    vec2 grad = -(db + dd) * nOut + gDome;

    vec3 back = mix(uBg, uPlateCol, uIconPlate);
    vec3 liftG = back + vec3(0.06);
    float rblur = uBlur + 0.05 * length(qc - p) + min(uGlow * uOptics * (1.0 - xf) * foot / px, 0.04);

    float cornerW = smoothstep(0.1, 0.9, 4.0 * nOut.x * nOut.x * nOut.y * nOut.y);
    float streak = 0.35 * uStreak * bw * mix(0.15, 1.0, cornerW) * pow(1.0 - xf, 1.5) * uOptics;
    vec2 tangent = vec2(-nOut.y, nOut.x);
    vec3 acc = vec3(0.0), wsum = vec3(0.0);
    for (int i = 0; i < 12; i++) {
      float lam = (float(i) + 0.5) / 12.0;
      float c = uDisp * (1.0 - 2.0 * lam);
      vec2 along = tangent * (streak * 2.0 * (fract(float(i) * 0.618034 + 0.31) - 0.5));
      float cf = uDisp * (1.0 - 2.0 * lam) * (lam > 0.5 ? 1.0 : 0.5);
      vec2 sp = refractSample(xf, bwF, 1.5 + uEtaSpread * c, R, dirOut, p + along,
                              dome + pinchPart * 0.3 * c, offMul);
      vec2 focusL = focus - sign(p) * (0.70710678 * uFocusSplit * c * uPlateScale);
      float wFocus = pow(1.0 - xf, uFocusK) * smoothstep(0.0, uRimLine * (1.0 + 0.6 * c), xf);
      sp = mix(sp, mix(p + along, focusL, wFocus), focusW);
      float faceOnly = smoothstep(0.7, 1.0, xf) * uOptics;
      sp *= 1.0 + uFaceDisp * cf * faceOnly;
      vec4 l = logoAt(sp, rblur + 0.12 * streak + uFaceDisp * 0.5 * max(c, 0.0) * faceOnly, foot);
      vec3 w = spectrum(lam);
      acc += mix(back, l.rgb, l.a) * w;
      wsum += w;
    }
    vec3 trans = acc / wsum;
    float tl = dot(trans, vec3(0.2126, 0.7152, 0.0722));
    trans = clamp(tl + (trans - tl) * (1.0 + uVivid * uOptics), 0.0, 1.0);
    float hazeLum = dot(trans, vec3(0.2126, 0.7152, 0.0722));
    float hazeGate = 1.0 - smoothstep(0.25, 0.75, hazeLum);
    trans = mix(trans, liftG, uFrost * 0.45 * hazeGate);

    float glassAmt = pow(1.0 - uDissolve, 1.5);
    float lit = uSpec * glassAmt;
    vec3 rimCol = vec3(0.98, 0.82, 0.45);

    vec3 Nl = normalize(vec3(-grad, 1.0));
    float edge = 1.0 - Nl.z;
    vec2 ldir = rot(normalize(vec2(-0.62, 0.78)), uLightAng);
    float side = dot(nOut, ldir);
    float fres = pow(edge, 1.5);
    vec3 rim = rimCol * fres * (0.35 + 0.65 * max(side, -side * 0.8)) * uRim * 0.65;
    vec3 Hv = normalize(normalize(vec3(-0.45, 0.6, 0.66)) + vec3(0.0, 0.0, 1.0));
    float spc = pow(max(dot(Nl, Hv), 0.0), 140.0) * 0.8 * smoothstep(0.0, 0.25, y1);
    vec3 glass = trans * (1.0 - 0.25 * fres) + (rim + vec3(spc)) * lit;
    glass = mix(glass, rimCol, uDrop * 0.4 * uSpec * (1.0 - smoothstep(0.0, 0.1 * uPlateScale, s)));

    float sweepD = dot(p / uPlateScale, normalize(vec2(0.8, 0.6))) - uSweep;
    float sheen = uSheen * glassAmt * exp(-sweepD * sweepD / 0.03) * (0.55 + 0.45 * (1.0 - x));
    glass = mix(glass, vec3(1.0), sheen * 0.24);

    cov = clamp(0.5 - sd / soft, 0.0, 1.0) * uPlateAlpha;
    col = mix(bg, glass, cov);
  }

  float alpha = max(cov, max(uBgAlpha, haloAmt * uBgAlpha));
  outColor = vec4(col * alpha, alpha);
}`;

            function fitToTexture(source, sw, sh) {
                const tmp = document.createElement("canvas");
                tmp.width = tmp.height = TEX;
                const tc = tmp.getContext("2d", { willReadFrequently: true });
                const s0 = Math.min(TEX / sw, TEX / sh);
                const dx0 = (TEX - sw * s0) / 2;
                const dy0 = (TEX - sh * s0) / 2;
                tc.drawImage(source, dx0, dy0, sw * s0, sh * s0);
                const d = tc.getImageData(0, 0, TEX, TEX).data;

                let opaque = true;
                for (let i = 3; i < d.length; i += 4 * 97) {
                    if (d[i] < 250) { opaque = false; break; }
                }
                const key = [d[0], d[1], d[2]];
                const keyAlpha = (r, g, b) =>
                    Math.min(1, Math.max(0, (Math.hypot(r - key[0], g - key[1], b - key[2]) / 441 - 0.08) / 0.2));

                let x0 = TEX, y0 = TEX, x1 = -1, y1 = -1;
                for (let y = 0; y < TEX; y++) {
                    for (let x = 0; x < TEX; x++) {
                        const i = (y * TEX + x) * 4;
                        const a = opaque ? keyAlpha(d[i], d[i + 1], d[i + 2]) * 255 : d[i + 3];
                        if (a > 8) {
                            if (x < x0) x0 = x;
                            if (x > x1) x1 = x;
                            if (y < y0) y0 = y;
                            if (y > y1) y1 = y;
                        }
                    }
                }
                if (x1 < 0) return tmp;
                const bw = x1 - x0 + 1;
                const bh = y1 - y0 + 1;
                const s = (TEX * BOX) / Math.max(bw, bh);

                const out = document.createElement("canvas");
                out.width = out.height = TEX;
                const oc = out.getContext("2d", { willReadFrequently: true });
                oc.imageSmoothingQuality = "high";
                oc.drawImage(source, TEX / 2 - (x0 + bw / 2 - dx0) * s, TEX / 2 - (y0 + bh / 2 - dy0) * s, sw * s0 * s, sh * s0 * s);
                if (opaque) {
                    const im = oc.getImageData(0, 0, TEX, TEX);
                    const e = im.data;
                    for (let i = 0; i < e.length; i += 4) e[i + 3] = Math.round(e[i + 3] * keyAlpha(e[i], e[i + 1], e[i + 2]));
                    oc.putImageData(im, 0, 0);
                }
                return out;
            }

            function edt1d(grid, offset, stride, f, v, z, INF) {
                v[0] = 0;
                z[0] = -INF;
                z[1] = INF;
                f[0] = grid[offset];
                for (let q = 1, k = 0, s = 0; q < TEX; q++) {
                    f[q] = grid[offset + q * stride];
                    const q2 = q * q;
                    do {
                        const r = v[k];
                        s = (f[q] - f[r] + q2 - r * r) / (q - r) / 2;
                    } while (s <= z[k] && --k > -1);
                    k++;
                    v[k] = q;
                    z[k] = s;
                    z[k + 1] = INF;
                }
                for (let q = 0, k = 0; q < TEX; q++) {
                    while (z[k + 1] < q) k++;
                    const r = v[k];
                    const qr = q - r;
                    grid[offset + q * stride] = f[r] + qr * qr;
                }
            }

            function buildSdf(canvas) {
                const n = TEX * TEX;
                const alpha = canvas.getContext("2d", { willReadFrequently: true }).getImageData(0, 0, TEX, TEX).data;
                const INF = 1e20;
                const outer = new Float64Array(n);
                const inner = new Float64Array(n);
                for (let i = 0; i < n; i++) {
                    const a = alpha[i * 4 + 3] / 255;
                    if (a >= 1) { outer[i] = 0; inner[i] = INF; }
                    else if (a <= 0) { outer[i] = INF; inner[i] = 0; }
                    else {
                        const dd = 0.5 - a;
                        outer[i] = dd > 0 ? dd * dd : 0;
                        inner[i] = dd < 0 ? dd * dd : 0;
                    }
                }
                const f = new Float64Array(TEX);
                const z = new Float64Array(TEX + 1);
                const v = new Uint16Array(TEX);
                for (let x = 0; x < TEX; x++) edt1d(outer, x, TEX, f, v, z, INF);
                for (let y = 0; y < TEX; y++) edt1d(outer, y * TEX, 1, f, v, z, INF);
                for (let x = 0; x < TEX; x++) edt1d(inner, x, TEX, f, v, z, INF);
                for (let y = 0; y < TEX; y++) edt1d(inner, y * TEX, 1, f, v, z, INF);
                const sdf = new Float32Array(n);
                for (let i = 0; i < n; i++) sdf[i] = (Math.sqrt(outer[i]) - Math.sqrt(inner[i])) / TEX;
                return sdf;
            }

            const clamp01 = x => (x < 0 ? 0 : x > 1 ? 1 : x);
            const mixVal = (a, b, t) => a + (b - a) * t;
            const smooth = (a, b, x) => {
                const t = clamp01((x - a) / (b - a));
                return t * t * (3 - 2 * t);
            };
            const smoother = (a, b, x) => {
                const t = clamp01((x - a) / (b - a));
                return t * t * t * (t * (t * 6 - 15) + 10);
            };
            function hexToRgb(hex) {
                let h = hex.replace("#", "");
                if (h.length === 3) h = h.replace(/./g, "$&$&");
                const v = parseInt(h.slice(0, 6), 16) || 0;
                return [((v >> 16) & 255) / 255, ((v >> 8) & 255) / 255, (v & 255) / 255];
            }

            function spring(t, response, damping) {
                if (t <= 0) return 0;
                const w = (2 * Math.PI) / response;
                if (damping >= 1) return 1 - Math.exp(-w * t) * (1 + w * t);
                const wd = w * Math.sqrt(1 - damping * damping);
                return 1 - Math.exp(-damping * w * t) * (Math.cos(wd * t) + ((damping * w) / wd) * Math.sin(wd * t));
            }

            function timeToReach(level, response, damping) {
                let lo = 0, hi = 3;
                for (let i = 0; i < 32; i++) {
                    const mid = (lo + hi) / 2;
                    if (spring(mid, response, damping) < level) lo = mid;
                    else hi = mid;
                }
                return hi;
            }

            function frameAt(T, P) {
                const tx = P.present;
                const keep = 1;
                const damping = 1 - P.bounce;
                const grow = spring(T + 0.01, P.response, damping);
                const tl = timeToReach(0.85, P.response, damping) - 0.01;
                const tm = timeToReach(0.92, P.response, damping) - 0.01;
                const morph = spring(T - tm, 0.4, 1);
                const drop = 1 - smooth(0.05, 1, morph);
                const appear = smooth(0, 0.08, T);
                const drift = P.drift * spring(T - 0.3, 2.2, 1);
                const zoomIn = 0.25 * spring(T, 0.7, 1) + 0.75 * smoother(0, P.glide, T);
                const settle = spring(T - 0.5, 2.4, 1);
                const exit = spring(T - tx, 0.55, 1);
                const release = spring(T - tx - 0.02, 0.48, 1);
                const dome = 0.15 * P.bulge * (1 - smooth(0.4, 0.95, grow));
                const view = (1 + (P.startZoom - 1) * (1 - zoomIn)) * (1 - 0.045 * settle) * mixVal(1, P.finalScale, exit);
                const bandW = mixVal(P.bevelWidth, Math.max(P.bevelWidth, 0.4), drop);
                const plateScale = mixVal(P.startSize, 1, grow) * (1 + drift) * (1 - 0.03 * release);
                const bg = hexToRgb(P.background);
                return {
                    uPlateScale: plateScale,
                    uShapeN: mixVal(2, P.corner, morph),
                    uCornerN: P.corner,
                    uOptics: 1 - 0.92 * smooth(0.25, 0.95, release),
                    uPlateAlpha: appear,
                    uLogoHalf: P.logoScale * view,
                    uLogoOff: [P.logoOffset[0] * view, P.logoOffset[1] * view],
                    uKeep: keep,
                    uSheen: P.sheen,
                    uSweep: mixVal(-1.6, 1.6, smoother(0.35, tx + 0.30, T)),
                    uLightAng: P.lightTurn * smoother(0.25, tx + 0.35, T),
                    uBold: P.swell * 0.03 * (1 - zoomIn),
                    uBlur: P.focus * 0.05 * (1 - smooth(0.3, 0.95, grow)),
                    uFrost: P.focus * (1 - smooth(0.5, 0.95, grow)),
                    uPinch: 0.38 * P.stretch * smooth(0.1, 0.9, morph) * smooth(0.75, 0.97, zoomIn),
                    uTilt: P.tilt * (1 - release),
                    uDome: dome * (1 - 0.85 * release),
                    uDrop: drop,
                    uRim: 1 + 0.8 * drop,
                    uHalo: P.halo * (0.5 + 0.5 * drop) * (1 - 0.65 * release),
                    uShadow: P.shadow * smooth(0.45, 0.8, grow) * (1 - smooth(0, 0.6, morph)),
                    uGhost: smooth(0, 0.03, T) * (1 - smooth(0.04, 0.08, T)),
                    uRipR: 1 + 0.9 * Math.max(0, T - tl),
                    uRipA: P.ripple * smooth(tl, tl + 0.06, T) * Math.exp(-Math.max(0, T - tl) / 0.6),
                    uBare: 0,
                    uReach: bandW * plateScale,
                    uCornerPull: P.cornerPull,
                    uStreak: P.edgeSmear,
                    uWiden: P.cornerWidth,
                    uSlab: 0.3 * P.opticalDepth,
                    uEtaSpread: 0.06,
                    uFocus: P.cornerFocus,
                    uFocusK: 1.0,
                    uFocusSplit: 0.056 * P.colorBleed,
                    uRimLine: 0.09,
                    uCornerOn: smooth(0.35, 1, morph) * (1 - smooth(0.15, 0.85, release)),
                    uGlow: 0.012 * P.colorBleed,
                    uFaceDisp: 0.012 * P.dispersion,
                    uVivid: 0.85,
                    uDissolve: 0.35 * release,
                    uDisp: P.dispersion,
                    uDouble: P.doubleBevel,
                    uBevelW: bandW * (1 - 0.55 * release),
                    uSpec: P.specular,
                    uIconPlate: 1,
                    uUseColor: 1,
                    uLightScene: 0,
                    uLightGlass: 0,
                    uBg: bg,
                    uPlateCol: hexToRgb(P.plateColor),
                    uLogoCol: hexToRgb(P.logoColor)
                };
            }

            let cachedLogoData = null;
            let activeIntroRaf = 0;
            let finishCleanupTimer = 0;

            function playGlassIntro(logoSrc, forceReplay) {
                const overlay = document.getElementById("glassIntroOverlay");
                const stage = document.getElementById("glassIntroStage");
                const caption = document.getElementById("glassIntroCaption");
                const targetIcon = document.getElementById("targetBrandIcon");
                if (!overlay || !stage || !targetIcon) return;

                if (!forceReplay && overlay.classList.contains("is-finished")) return;

                if (activeIntroRaf) cancelAnimationFrame(activeIntroRaf);
                if (finishCleanupTimer) clearTimeout(finishCleanupTimer);
                document.body.classList.remove("intro-docking", "intro-landed");
                document.body.classList.add("intro-active");
                overlay.classList.remove("is-finished");
                if (caption) {
                    caption.classList.remove("is-visible", "is-hiding");
                }
                stage.innerHTML = "";

                const canvas = document.createElement("canvas");
                canvas.style.cssText = "position:absolute;inset:0;width:100%;height:100%;display:block";
                stage.appendChild(canvas);

                const gl = canvas.getContext("webgl2", {
                    alpha: true,
                    premultipliedAlpha: true,
                    antialias: false
                });
                if (!gl) {
                    document.body.classList.remove("intro-active", "intro-docking");
                    overlay.classList.add("is-finished");
                    return;
                }

                const compileShader = (type, src) => {
                    const sh = gl.createShader(type);
                    gl.shaderSource(sh, src);
                    gl.compileShader(sh);
                    if (!gl.getShaderParameter(sh, gl.COMPILE_STATUS)) return null;
                    return sh;
                };

                const vs = compileShader(gl.VERTEX_SHADER, GLASS_VERT);
                const fs = compileShader(gl.FRAGMENT_SHADER, GLASS_FRAG);
                const prog = vs && fs ? gl.createProgram() : null;
                if (!prog) {
                    document.body.classList.remove("intro-active", "intro-docking");
                    overlay.classList.add("is-finished");
                    return;
                }
                gl.attachShader(prog, vs);
                gl.attachShader(prog, fs);
                gl.linkProgram(prog);
                if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
                    document.body.classList.remove("intro-active", "intro-docking");
                    overlay.classList.add("is-finished");
                    return;
                }
                gl.useProgram(prog);

                gl.bindBuffer(gl.ARRAY_BUFFER, gl.createBuffer());
                gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
                const loc = gl.getAttribLocation(prog, "aPos");
                gl.enableVertexAttribArray(loc);
                gl.vertexAttribPointer(loc, 2, gl.FLOAT, false, 0, 0);

                const U = {};
                const count = gl.getProgramParameter(prog, gl.ACTIVE_UNIFORMS);
                for (let i = 0; i < count; i++) {
                    const info = gl.getActiveUniform(prog, i);
                    if (info) U[info.name] = gl.getUniformLocation(prog, info.name);
                }

                const sdfTex = gl.createTexture();
                const colTex = gl.createTexture();
                gl.uniform1i(U.uSdf, 0);
                gl.uniform1i(U.uCol, 1);

                const setParams = filter => {
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, filter);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                };

                let dismissed = false;
                const finishIntro = () => {
                    if (dismissed) return;
                    dismissed = true;
                    if (activeIntroRaf) cancelAnimationFrame(activeIntroRaf);
                    if (finishCleanupTimer) clearTimeout(finishCleanupTimer);
                    document.body.classList.remove("intro-active", "intro-docking", "intro-landed");
                    overlay.classList.add("is-finished");
                    finishCleanupTimer = setTimeout(() => {
                        gl.getExtension("WEBGL_lose_context")?.loseContext();
                        stage.innerHTML = "";
                    }, 240);
                };

                overlay.onclick = finishIntro;

                const startLoop = logoData => {
                    if (dismissed) return;
                    gl.activeTexture(gl.TEXTURE0);
                    gl.bindTexture(gl.TEXTURE_2D, sdfTex);
                    gl.pixelStorei(gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL, false);
                    gl.texImage2D(gl.TEXTURE_2D, 0, gl.R16F, TEX, TEX, 0, gl.RED, gl.FLOAT, logoData.sdf);
                    setParams(gl.LINEAR);

                    gl.activeTexture(gl.TEXTURE1);
                    gl.bindTexture(gl.TEXTURE_2D, colTex);
                    gl.pixelStorei(gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL, true);
                    gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA8, gl.RGBA, gl.UNSIGNED_BYTE, logoData.canvas);
                    gl.pixelStorei(gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL, false);
                    gl.generateMipmap(gl.TEXTURE_2D);
                    setParams(gl.LINEAR_MIPMAP_LINEAR);

                    if (caption) {
                        setTimeout(() => {
                            if (!dismissed) caption.classList.add("is-visible");
                        }, 160);
                    }

                    let t = 0;
                    let last = 0;
                    let dockingStarted = false;
                    let landedStarted = false;
                    const flyStart = INTRO_SETTINGS.present + 0.42; // 1.57s: Glass corner release settled
                    const flyDuration = 0.85;                       // 0.85s: Silky curved shrink & fly into #targetBrandIcon
                    const totalEnd = flyStart + flyDuration;

                    const step = now => {
                        if (dismissed) return;
                        if (!last) last = now;
                        const dt = Math.min(0.035, (now - last) / 1000);
                        last = now;
                        t += dt;

                        const dpr = Math.min(window.devicePixelRatio || 1, 2);
                        const cw = canvas.clientWidth || window.innerWidth;
                        const ch = canvas.clientHeight || window.innerHeight;
                        const w = Math.max(1, Math.round(cw * dpr));
                        const h = Math.max(1, Math.round(ch * dpr));
                        if (canvas.width !== w || canvas.height !== h) {
                            canvas.width = w;
                            canvas.height = h;
                        }

                        // Evaluate liquid glass state continuously so corner release completes cleanly
                        const fr = frameAt(t, INTRO_SETTINGS);

                        // Calculate fly-to-header interpolation (0 -> 1)
                        const rawFly = clamp01((t - flyStart) / flyDuration);
                        // Exponential-cubic ease-in-out for natural physical trajectory
                        const flyEase = smoother(0, 1, rawFly);
                        const flyEaseX = smoother(0, 1, Math.pow(rawFly, 0.92));

                        if (rawFly > 0.02 && !dockingStarted) {
                            dockingStarted = true;
                            if (caption) caption.classList.add("is-hiding");
                            document.body.classList.add("intro-docking");
                        }

                        if (rawFly >= 0.78 && !landedStarted) {
                            landedStarted = true;
                            document.body.classList.add("intro-landed");
                        }

                        // Start center & tile size vs Target #targetBrandIcon rect
                        const startX = w / 2;
                        const startY = h / 2 + 20 * dpr;
                        // Subtle anticipation swell just as it takes off
                        const anticipation = 1 + 0.04 * Math.sin(Math.min(1, rawFly * 3.5) * Math.PI) * (1 - rawFly);
                        const startTile = Math.min(INTRO_SETTINGS.tileSize, Math.min(cw, ch) / 1.75) * dpr * anticipation;

                        const rect = targetIcon.getBoundingClientRect();
                        const targetX = (rect.left + rect.width / 2) * dpr;
                        const targetY = (ch - (rect.top + rect.height / 2)) * dpr;
                        const targetTile = (rect.width / Math.max(fr.uPlateScale, 0.5)) * dpr;

                        const curX = mixVal(startX, targetX, flyEaseX);
                        const curY = mixVal(startY, targetY, flyEase);
                        const curTile = mixVal(startTile, targetTile, flyEase);

                        // Fade dark backdrop smoothly as the glass tile flies to header
                        const bgAlpha = 1 - smoother(0.0, 0.66, rawFly);
                        fr.uHalo = fr.uHalo * (1 - flyEase);
                        fr.uOptics = fr.uOptics * (1 - 0.85 * flyEase);
                        if (rawFly > 0.80) {
                            fr.uPlateAlpha = fr.uPlateAlpha * (1 - smoother(0.80, 1.0, rawFly));
                        }

                        gl.viewport(0, 0, w, h);
                        gl.clearColor(0, 0, 0, 0);
                        gl.clear(gl.COLOR_BUFFER_BIT);
                        gl.uniform2f(U.uCenter, curX, curY);
                        gl.uniform1f(U.uTile, curTile);
                        gl.uniform1f(U.uTexSize, TEX);
                        gl.uniform1f(U.uBoxFrac, BOX);
                        gl.uniform1f(U.uBgAlpha, bgAlpha);
                        for (const k in fr) {
                            if (typeof fr[k] === "number" && U[k]) gl.uniform1f(U[k], fr[k]);
                        }
                        gl.uniform3fv(U.uBg, fr.uBg);
                        gl.uniform3fv(U.uPlateCol, fr.uPlateCol);
                        gl.uniform3fv(U.uLogoCol, fr.uLogoCol);
                        gl.uniform2fv(U.uLogoOff, fr.uLogoOff);
                        gl.drawArrays(gl.TRIANGLES, 0, 3);

                        if (t >= totalEnd) {
                            finishIntro();
                        } else {
                            activeIntroRaf = requestAnimationFrame(step);
                        }
                    };

                    activeIntroRaf = requestAnimationFrame(step);
                };

                if (cachedLogoData) {
                    startLoop(cachedLogoData);
                } else {
                    const img = new Image();
                    img.crossOrigin = "anonymous";
                    img.onload = () => {
                        const fitted = fitToTexture(img, img.naturalWidth || TEX, img.naturalHeight || TEX);
                        cachedLogoData = { canvas: fitted, sdf: buildSdf(fitted) };
                        startLoop(cachedLogoData);
                    };
                    img.onerror = finishIntro;
                    img.src = logoSrc;
                }
            }

            /* ==========================================================================
               PART 2: REACT BITS <SideRays /> WEBGL2 ENGINE
               ========================================================================== */
            const PIXEL_BUDGET = 2.4e6;
            const TAU = Math.PI * 2;

            const ORIGINS = {
                'top-right': { flipX: 0, flipY: 0, side: 0 },
                'top-left': { flipX: 1, flipY: 0, side: 0 },
                'bottom-right': { flipX: 0, flipY: 1, side: 0 },
                'bottom-left': { flipX: 1, flipY: 1, side: 0 },
                right: { flipX: 0, flipY: 0, side: 1 },
                left: { flipX: 1, flipY: 0, side: 1 }
            };

            const VERTEX = `#version 300 es
const vec2 corners[3] = vec2[3](vec2(-1.0, -1.0), vec2(3.0, -1.0), vec2(-1.0, 3.0));
void main() {
  gl_Position = vec4(corners[gl_VertexID], 0.0, 1.0);
}`;

            const FRAGMENT = `#version 300 es
precision highp float;
uniform vec2 uResolution;
uniform float uTime;
uniform vec3 uColorA;
uniform vec3 uColorB;
uniform float uBlend;
uniform float uIntensity;
uniform float uSpread;
uniform float uDensity;
uniform float uSharpness;
uniform float uFalloff;
uniform float uGlow;
uniform float uSaturation;
uniform float uDust;
uniform float uOpacity;
uniform float uReveal;
uniform float uLight;
uniform vec3 uFrame;
uniform float uAim;
uniform vec3 uFocus;
uniform float uSway;
out vec4 fragColor;

float hash(vec2 p) {
  p = fract(p * vec2(123.34, 456.21));
  p += dot(p, p + 45.32);
  return fract(p.x * p.y);
}

float noise(vec2 p) {
  vec2 i = floor(p);
  vec2 f = p - i;
  vec2 w = f * f * f * (f * (f * 6.0 - 15.0) + 10.0);
  float a = hash(i);
  float b = hash(i + vec2(1.0, 0.0));
  float c = hash(i + vec2(0.0, 1.0));
  float d = hash(i + vec2(1.0, 1.0));
  return mix(mix(a, b, w.x), mix(c, d, w.x), w.y);
}

float shafts(float u, float t, float seed, float aa) {
  float sway = (0.4 * sin(t * 0.31 + seed) + 0.24 * sin(t * 0.17 + seed * 2.3)) * uSway;
  float n = 0.7 * noise(vec2(u + sway + seed, t * 0.3)) + 0.3 * noise(vec2(u * 2.4 + sway * 1.5 + seed * 1.7, t * 0.45 + 3.0));
  float width = mix(0.5, 0.1, uSharpness);
  float s = mix(smoothstep(0.5 - width, 0.5 + width, n), 0.5, aa);
  return mix(0.05, 1.0, s);
}

float motes(vec2 p, float cell, float t, float seed) {
  p += vec2(t * 0.021, -t * 0.013) + seed * 7.31;
  vec2 grid = p / cell;
  vec2 id = floor(grid);
  vec2 f = grid - id;
  float h = hash(id + seed);
  if (h > 0.5) return 0.0;
  vec2 center = 0.25 + 0.5 * vec2(hash(id + 1.7 + seed), hash(id + 3.1 + seed));
  center += 0.1 * vec2(sin(t * 0.7 + h * 31.0), cos(t * 0.6 + h * 23.0));
  float size = mix(0.035, 0.09, hash(id + 5.3 + seed));
  float edge = length(fwidth(grid)) * 0.7;
  float twinkle = 0.55 + 0.45 * sin(t * 1.9 + h * 41.0);
  return (1.0 - smoothstep(size - edge, size + edge, length(f - center))) * twinkle;
}

void main() {
  float aspect = uResolution.x / uResolution.y;
  vec2 q = (gl_FragCoord.xy - 0.5 * uResolution) / uResolution.y;
  if (uFrame.x > 0.5) q.x = -q.x;
  if (uFrame.y > 0.5) q.y = -q.y;
  vec2 source = uFrame.z > 0.5 ? vec2(aspect * 0.5 + 0.42, 0.3) : vec2(aspect * 0.5 + 0.1, 0.62);
  float heading = (uFrame.z > 0.5 ? 3.42 : -2.48) + uAim + 0.035 * sin(uTime * 0.21) * uSway;
  vec2 v = q - source;
  float r = length(v);
  float angle = mod(atan(v.y, v.x) - heading + 3.14159265, 6.28318531) - 3.14159265;
  float t = uTime;
  float u = angle * uDensity;
  float aa = smoothstep(0.12, 0.45, fwidth(u));
  float offset = uSpread * 0.22;
  float fanA = exp(-pow((angle + offset) / uSpread, 2.0) * 1.4);
  float fanB = exp(-pow((angle - offset) / (uSpread * 1.15), 2.0) * 1.4);
  float focus = 1.0 + uFocus.z * exp(-pow((angle - uFocus.x) / uFocus.y, 2.0));
  float lightA = fanA * shafts(u, t, 0.0, aa) * focus;
  float lightB = fanB * shafts(u * 0.83, t * 0.6, 17.0, aa) * focus;
  float reach = 1.0 / (1.0 + pow(r / 0.4, uFalloff));
  vec3 glowColor = mix(uColorA, uColorB, uBlend);
  vec3 light = (uColorA * lightA * (1.0 - uBlend) + uColorB * lightB * uBlend) * 2.0 * reach;
  light += glowColor * uGlow * exp(-pow(r / 0.4, 2.0));
  if (uDust > 0.0) {
    float sparkle = motes(q, 0.06, t, 0.0) + 0.7 * motes(q, 0.038, t * 0.8, 9.0);
    light += mix(glowColor, vec3(1.0), 0.6) * sparkle * (lightA + lightB) * reach * uDust * 2.5;
  }
  light *= uIntensity * (1.0 - smoothstep(uReveal * 2.6 - 0.45, uReveal * 2.6, r)) * smoothstep(0.0, 0.35, uReveal);
  float gray = dot(light, vec3(0.2126, 0.7152, 0.0722));
  light = max(mix(vec3(gray), light, uSaturation), 0.0);
  float peak = max(light.r, max(light.g, light.b));
  float grain = (fract(52.9829189 * fract(dot(gl_FragCoord.xy, vec2(0.06711056, 0.00583715)))) - 0.5) / 255.0;
  if (uLight > 0.5) {
    vec3 ink = pow(light / max(peak, 1e-4), vec3(2.0)) * 0.75;
    float alpha = clamp(pow(1.0 - exp(-peak * 2.6), 2.5) * 0.9 * uOpacity + grain, 0.0, 1.0);
    fragColor = vec4(pow(ink, vec3(1.0 / 2.2)) * alpha, alpha);
    return;
  }
  float mapped = 1.0 - exp(-peak);
  vec3 tone = light * (mapped / max(peak, 1e-4));
  tone = mix(tone, vec3(mapped), smoothstep(0.7, 1.0, mapped) * 0.55);
  vec3 shown = clamp(tone * uOpacity, 0.0, 1.0);
  float alpha = max(shown.r, max(shown.g, shown.b));
  vec3 color = clamp(shown * alpha + grain, 0.0, 1.0);
  fragColor = vec4(min(color, vec3(alpha)), alpha);
}`;

            const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
            const wrapAngle = angle => ((((angle + Math.PI) % TAU) + TAU) % TAU) - Math.PI;

            const parseColor = value => {
                const text = String(value || '').trim();
                const hex = /^#?([0-9a-f]{3}|[0-9a-f]{6})$/i.exec(text);
                if (hex) {
                    const full = hex[1].length === 3 ? hex[1].replace(/./g, d => d + d) : hex[1];
                    return [0, 2, 4].map(i => parseInt(full.slice(i, i + 2), 16) / 255);
                }
                return [1, 1, 1];
            };

            const geometryFor = (frame, aspect) => ({
                source: frame.side ? [aspect * 0.5 + 0.42, 0.3] : [aspect * 0.5 + 0.1, 0.62],
                heading: frame.side ? 3.42 : -2.48
            });

            const compile = (gl, type, source) => {
                const shader = gl.createShader(type);
                if (!shader) return null;
                gl.shaderSource(shader, source);
                gl.compileShader(shader);
                if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                    gl.deleteShader(shader);
                    return null;
                }
                return shader;
            };

            const link = gl => {
                const vertex = compile(gl, gl.VERTEX_SHADER, VERTEX);
                const fragment = compile(gl, gl.FRAGMENT_SHADER, FRAGMENT);
                const program = vertex && fragment ? gl.createProgram() : null;
                if (!vertex || !fragment || !program) return null;
                gl.attachShader(program, vertex);
                gl.attachShader(program, fragment);
                gl.linkProgram(program);
                gl.deleteShader(vertex);
                gl.deleteShader(fragment);
                if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
                    gl.deleteProgram(program);
                    return null;
                }
                const uniforms = {};
                const count = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
                for (let i = 0; i < count; i++) {
                    const info = gl.getActiveUniform(program, i);
                    if (info) uniforms[info.name] = gl.getUniformLocation(program, info.name);
                }
                return { program, uniforms };
            };

            function initSideRays(options) {
                const container = document.getElementById('sideRaysContainer');
                const canvas = document.getElementById('sideRaysCanvas');
                if (!container || !canvas) return;

                const s = {
                    colorA: parseColor(options.rayColor1 || '#FFC46B'),
                    colorB: parseColor(options.rayColor2 || '#F59E0B'),
                    blend: clamp(options.blend ?? 0.5, 0, 1),
                    frame: ORIGINS[options.origin || 'top-right'] || ORIGINS['top-right'],
                    speed: Math.max(0, options.speed ?? 2.5) * 0.4,
                    intensity: Math.max(0, options.intensity ?? 2.2) * 0.75,
                    spread: clamp(options.spread ?? 2.4, 0.1, 8) * 0.225,
                    density: clamp(options.density ?? 5, 1, 40),
                    sharpness: clamp(options.sharpness ?? 0.55, 0, 1),
                    tilt: (clamp(options.tilt ?? 4, -180, 180) * Math.PI) / 180,
                    falloff: clamp(options.falloff ?? 0.92, 0.2, 6),
                    glow: Math.max(0, options.glow ?? 1.15) * 1.2,
                    saturation: Math.max(0, options.saturation ?? 1),
                    dust: clamp(options.dust ?? 0.28, 0, 1),
                    followMouse: options.followMouse ?? true,
                    mouseInfluence: clamp(options.mouseInfluence ?? 0.5, 0, 1),
                    intro: options.intro ?? true,
                    light: options.lightMode ?? false,
                    opacity: clamp(options.opacity ?? 0.95, 0, 1),
                    maxRatio: clamp(options.maxDevicePixelRatio ?? 2, 0.5, 3)
                };

                const gl = canvas.getContext('webgl2', {
                    alpha: true,
                    premultipliedAlpha: true,
                    antialias: false,
                    depth: false,
                    stencil: false,
                    powerPreference: 'high-performance'
                });
                const shader = gl ? link(gl) : null;
                if (!gl || !shader) return;

                const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                const vao = gl.createVertexArray();
                const size = { width: 1, height: 1 };
                const pointer = { x: 0, y: 0, inside: false };
                const aim = { value: 0, velocity: 0 };
                const focus = { angle: 0, strength: 0 };
                let time = Math.random() * 100;
                let reveal = s.intro && !reduced ? 0 : 1;
                let raf = 0;
                let last = 0;
                let pageVisible = document.visibilityState !== 'hidden';

                const resize = () => {
                    const rect = container.getBoundingClientRect();
                    const cssWidth = Math.max(1, rect.width);
                    const cssHeight = Math.max(1, rect.height);
                    const ratio = Math.min(
                        window.devicePixelRatio || 1,
                        s.maxRatio,
                        Math.sqrt(PIXEL_BUDGET / (cssWidth * cssHeight))
                    );
                    const width = Math.max(1, Math.round(cssWidth * ratio));
                    const height = Math.max(1, Math.round(cssHeight * ratio));
                    if (canvas.width !== width || canvas.height !== height) {
                        canvas.width = width;
                        canvas.height = height;
                    }
                    size.width = cssWidth;
                    size.height = cssHeight;
                };

                const pointerAngle = () => {
                    let x = (pointer.x - size.width / 2) / size.height;
                    let y = (size.height / 2 - pointer.y) / size.height;
                    if (s.frame.flipX) x = -x;
                    if (s.frame.flipY) y = -y;
                    const { source, heading } = geometryFor(s.frame, size.width / size.height);
                    return wrapAngle(Math.atan2(y - source[1], x - source[0]) - heading - s.tilt);
                };

                const frame = now => {
                    raf = 0;
                    const introOpaque =
                        document.body.classList.contains('intro-active') &&
                        !document.body.classList.contains('intro-docking');
                    if (introOpaque) {
                        last = now;
                        reveal = 0.15;
                        if (pageVisible) raf = requestAnimationFrame(frame);
                        return;
                    }
                    const dt = clamp((now - last) / 1000 || 0, 0, 0.05);
                    last = Math.max(last, now);
                    time += dt * s.speed * (reduced ? 0.3 : 1);
                    if (reveal < 1) reveal = Math.min(1, reveal + dt / 1.35);

                    const tracking = s.followMouse && pointer.inside && !reduced;
                    const pointed = tracking ? pointerAngle() : 0;
                    const target = tracking ? clamp(pointed, -s.spread, s.spread) * s.mouseInfluence : 0;
                    const focusTarget = tracking ? s.mouseInfluence : 0;
                    const ease = 1 - Math.exp(-dt * 6);
                    if (tracking) focus.angle += (clamp(pointed - aim.value, -s.spread * 1.5, s.spread * 1.5) - focus.angle) * ease;
                    focus.strength += (focusTarget - focus.strength) * ease;
                    const stiffness = 18;
                    const damping = 2 * Math.sqrt(stiffness);
                    aim.velocity += ((target - aim.value) * stiffness - aim.velocity * damping) * dt;
                    aim.value += aim.velocity * dt;

                    gl.viewport(0, 0, canvas.width, canvas.height);
                    gl.useProgram(shader.program);
                    gl.bindVertexArray(vao);
                    const u = shader.uniforms;
                    gl.uniform2f(u.uResolution, canvas.width, canvas.height);
                    gl.uniform1f(u.uTime, time);
                    gl.uniform3f(u.uColorA, s.colorA[0], s.colorA[1], s.colorA[2]);
                    gl.uniform3f(u.uColorB, s.colorB[0], s.colorB[1], s.colorB[2]);
                    gl.uniform1f(u.uBlend, s.blend);
                    gl.uniform1f(u.uIntensity, s.intensity);
                    gl.uniform1f(u.uSpread, s.spread);
                    gl.uniform1f(u.uDensity, s.density);
                    gl.uniform1f(u.uSharpness, s.sharpness);
                    gl.uniform1f(u.uFalloff, s.falloff);
                    gl.uniform1f(u.uGlow, s.glow);
                    gl.uniform1f(u.uSaturation, s.saturation);
                    gl.uniform1f(u.uDust, s.dust);
                    gl.uniform1f(u.uOpacity, s.opacity);
                    gl.uniform1f(u.uReveal, 1 - Math.pow(1 - reveal, 3));
                    gl.uniform1f(u.uLight, s.light ? 1 : 0);
                    gl.uniform3f(u.uFrame, s.frame.flipX, s.frame.flipY, s.frame.side);
                    gl.uniform1f(u.uAim, s.tilt + aim.value);
                    gl.uniform3f(u.uFocus, focus.angle, Math.max(0.06, s.spread * 0.25), focus.strength * 1.4);
                    gl.uniform1f(u.uSway, reduced ? 0 : 1);
                    gl.drawArrays(gl.TRIANGLES, 0, 3);

                    const settling =
                        Math.abs(target - aim.value) > 1e-4 ||
                        Math.abs(aim.velocity) > 1e-4 ||
                        Math.abs(focusTarget - focus.strength) > 1e-3;
                    const busy = (s.speed > 0 && !reduced) || reveal < 1 || settling;
                    if (busy && pageVisible) raf = requestAnimationFrame(frame);
                };

                const wake = () => {
                    if (raf || !pageVisible) return;
                    last = performance.now();
                    raf = requestAnimationFrame(frame);
                };

                window.addEventListener('pointermove', event => {
                    const rect = container.getBoundingClientRect();
                    pointer.x = event.clientX - rect.left;
                    pointer.y = event.clientY - rect.top;
                    pointer.inside =
                        event.clientX >= rect.left &&
                        event.clientX <= rect.right &&
                        event.clientY >= rect.top &&
                        event.clientY <= rect.bottom;
                    wake();
                }, { passive: true });

                document.documentElement.addEventListener('pointerleave', () => {
                    pointer.inside = false;
                    wake();
                });

                window.addEventListener('resize', () => {
                    resize();
                    wake();
                });

                document.addEventListener('visibilitychange', () => {
                    pageVisible = document.visibilityState !== 'hidden';
                    wake();
                });

                resize();
                wake();
            }

            $(document).ready(function() {
                const logoSrc = "{{ asset('images/Ibekami.png') }}";
                playGlassIntro(logoSrc, false);

                $('#replayIntroBtn').on('click', function(e) {
                    e.preventDefault();
                    playGlassIntro(logoSrc, true);
                });

                initSideRays({
                    rayColor1: '#FFC46B',
                    rayColor2: '#F59E0B',
                    origin: 'top-right',
                    speed: 2.5,
                    intensity: 2.35,
                    spread: 2.6,
                    density: 5,
                    falloff: 0.78,
                    tilt: -11,
                    dust: 0.28,
                    followMouse: true
                });

                $('#togglePasswordBtn').on('click', function() {
                    var passwordInput = $('#inputPassword');
                    var icon = $('#togglePasswordIcon');
                    var isHidden = passwordInput.attr('type') === 'password';

                    if (isHidden) {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('la-eye').addClass('la-eye-slash');
                        $(this).attr('aria-label', 'Sembunyikan kata sandi').attr('aria-pressed', 'true');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('la-eye-slash').addClass('la-eye');
                        $(this).attr('aria-label', 'Tampilkan kata sandi').attr('aria-pressed', 'false');
                    }
                });

                $('#loginForm').on('submit', function(e) {
                    var emailVal = $.trim($('#inputEmail').val());
                    var passVal = $('#inputPassword').val();
                    var errBox = $('#clientErrorBox');

                    $('#inputEmail, #inputPassword').removeClass('is-invalid');
                    errBox.addClass('d-none');

                    if (!emailVal || !passVal) {
                        e.preventDefault();
                        if (!emailVal) $('#inputEmail').addClass('is-invalid').focus();
                        else if (!passVal) $('#inputPassword').addClass('is-invalid').focus();
                        errBox.removeClass('d-none');
                        return false;
                    }

                    var btn = $('#submitLoginBtn');
                    btn.prop('disabled', true).text('Memproses...');
                });
            });
        })();
    </script>
    <script>
        setTimeout(function() {
            document.body.classList.remove('intro-active', 'intro-docking', 'intro-landed');
            var overlay = document.getElementById('glassIntroOverlay');
            if (overlay) overlay.classList.add('is-finished');
        }, 3200);
    </script>
</body>

</html>
