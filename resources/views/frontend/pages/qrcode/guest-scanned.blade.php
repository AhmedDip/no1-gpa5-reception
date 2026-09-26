{{-- resources/views/frontend/pages/qrcode/guest-scanned.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'প্রবেশ সফল')

@push('styles')
<style>
    /* ============================================
       DESIGN TOKENS
       ============================================ */
    :root {
        --gs-primary: #1e9e6f;
        --gs-primary-dark: #0f6e4c;
        --gs-primary-darker: #0a4f37;
        --gs-primary-light: #d6f3e5;
        --gs-primary-lighter: #eefaf4;
        --gs-accent: #d4a24a;
        --gs-accent-light: #fdf3dd;
        --gs-ink: #16211c;
        --gs-ink-soft: #3a4a43;
        --gs-muted: #7c8b84;
        --gs-line: #e4ede9;
        --gs-white: #ffffff;
        --gs-radius-sm: 12px;
        --gs-radius-md: 16px;
        --gs-radius-lg: 22px;
        --gs-radius-xl: 28px;
        --gs-shadow-sm: 0 4px 14px -6px rgba(15, 110, 76, 0.18);
        --gs-shadow-md: 0 16px 40px -18px rgba(15, 110, 76, 0.35);
        --gs-shadow-lg: 0 28px 70px -24px rgba(15, 110, 76, 0.5);
        --gs-font: 'Hind Siliguri', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* ============================================
       BASE
       ============================================ */
    .gs-page * {
        box-sizing: border-box;
    }

    .gs-page {
        font-family: var(--gs-font);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        min-height: 100vh;
        padding: 2rem 0 4rem;
        position: relative;
        overflow-x: hidden;
        background:
            radial-gradient(1100px 560px at 6% -10%, #e6fbf1 0%, transparent 58%),
            radial-gradient(900px 460px at 96% -6%, #fdf4e3 0%, transparent 52%),
            linear-gradient(180deg, #f4fdf9 0%, #ffffff 46%, #fbfefc 100%);
    }

    .gs-page .gs-container {
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 2;
    }

    /* ============================================
       CONFETTI
       ============================================ */
    .gs-confetti {
        position: fixed;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 1;
    }

    .gs-confetti span {
        position: absolute;
        top: -24px;
        opacity: 0;
        border-radius: 2px;
        animation: gsConfettiFall linear forwards;
        will-change: transform, opacity;
    }

    @keyframes gsConfettiFall {
        0% {
            opacity: 0;
            transform: translate3d(0, -10vh, 0) rotate(0deg);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 0.85;
        }
        100% {
            opacity: 0;
            transform: translate3d(0, 108vh, 0) rotate(760deg);
        }
    }

    /* ============================================
       TOP BAR
       ============================================ */
    .gs-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
        padding: 0.9rem 1.25rem;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(30, 158, 111, 0.16);
        border-radius: var(--gs-radius-md);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: var(--gs-shadow-sm);
        animation: gsTopbarIn 0.55s cubic-bezier(0.2, 0.9, 0.3, 1.1) both;
    }

    @keyframes gsTopbarIn {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .gs-topbar-left {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        min-width: 0;
    }

    .gs-topbar-icon {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        color: #fff;
        font-size: 1.15rem;
        background: linear-gradient(135deg, var(--gs-primary), var(--gs-primary-dark));
        box-shadow: 0 10px 22px -10px rgba(30, 158, 111, 0.65);
    }

    .gs-topbar-title h1 {
        margin: 0;
        color: var(--gs-ink);
        font-size: 1.12rem;
        font-weight: 800;
        line-height: 1.3;
        letter-spacing: -0.01em;
    }

    .gs-topbar-title p {
        margin: 2px 0 0;
        color: var(--gs-muted);
        font-size: 0.78rem;
        font-weight: 500;
        line-height: 1.3;
    }

    .gs-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 16px;
        border-radius: 50px;
        color: var(--gs-primary-dark);
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        background: linear-gradient(135deg, #eafaf1, var(--gs-primary-light));
        border: 1px solid rgba(30, 158, 111, 0.24);
        white-space: nowrap;
    }

    .gs-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: gsPulse 1.8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes gsPulse {
        70%  { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
        100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    /* ============================================
       MAIN CARD
       ============================================ */
    .gs-card {
        max-width: 620px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(30, 158, 111, 0.14);
        border-radius: var(--gs-radius-xl);
        box-shadow: var(--gs-shadow-lg);
        animation: gsCardIn 0.8s cubic-bezier(0.2, 0.9, 0.3, 1.1) both;
    }

    @keyframes gsCardIn {
        from { opacity: 0; transform: translateY(28px) scale(0.965); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ============================================
       CARD HEADER (GREEN BANNER)
       ============================================ */
    .gs-card-header {
        position: relative;
        padding: 2.75rem 1.5rem 4.75rem;
        text-align: center;
        overflow: hidden;
        background:
            radial-gradient(140% 140% at 0% 0%, rgba(255, 255, 255, 0.22), transparent 55%),
            radial-gradient(120% 120% at 100% 100%, rgba(52, 211, 153, 0.42), transparent 55%),
            linear-gradient(135deg, var(--gs-primary-darker) 0%, var(--gs-primary-dark) 25%, var(--gs-primary) 70%, #2bb37f 100%);
    }

    .gs-card-header::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.07) 1px, transparent 1px);
        background-size: 28px 28px;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 20%, transparent 78%);
        mask-image: radial-gradient(ellipse at center, #000 20%, transparent 78%);
    }

    /* Decorative corner glow */
    .gs-card-header::after {
        content: '';
        position: absolute;
        width: 260px;
        height: 260px;
        top: -130px;
        right: -100px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(212, 162, 74, 0.28), transparent 70%);
        pointer-events: none;
    }

    /* ============================================
       CHECK RING
       ============================================ */
    .gs-check-ring {
        position: relative;
        z-index: 2;
        width: 106px;
        height: 106px;
        margin: 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        font-size: 2.9rem;
        background: rgba(255, 255, 255, 0.16);
        border: 2px solid rgba(255, 255, 255, 0.36);
        backdrop-filter: blur(4px);
        box-shadow:
            0 22px 52px rgba(0, 0, 0, 0.22),
            inset 0 2px 0 rgba(255, 255, 255, 0.3);
        animation: gsRingIn 0.85s cubic-bezier(0.2, 0.9, 0.3, 1.5) both;
    }

    @keyframes gsRingIn {
        from { opacity: 0; transform: scale(0.45) rotate(-18deg); }
        to   { opacity: 1; transform: scale(1) rotate(0deg); }
    }

    .gs-check-ring::before,
    .gs-check-ring::after {
        content: '';
        position: absolute;
        inset: -14px;
        border: 2px solid rgba(255, 255, 255, 0.34);
        border-radius: 50%;
        animation: gsRingPulse 2.6s ease-out infinite;
    }

    .gs-check-ring::after {
        inset: -30px;
        opacity: 0.45;
        animation-delay: 0.55s;
    }

    @keyframes gsRingPulse {
        0%   { transform: scale(0.92); opacity: 0.75; }
        100% { transform: scale(1.2);  opacity: 0; }
    }

    /* ============================================
       HEADER TEXT
       ============================================ */
    .gs-card-title {
        position: relative;
        z-index: 2;
        margin: 1.6rem 0 0.45rem;
        color: #fff;
        font-size: 1.55rem;
        font-weight: 800;
        line-height: 1.32;
        letter-spacing: -0.01em;
        text-shadow: 0 2px 18px rgba(0, 0, 0, 0.22);
    }

    .gs-card-subtitle {
        position: relative;
        z-index: 2;
        margin: 0;
        color: rgba(255, 255, 255, 0.88);
        font-size: 0.93rem;
        font-weight: 500;
        line-height: 1.5;
    }

    /* ============================================
       CARD BODY
       ============================================ */
    .gs-card-body {
        padding: 0 1.75rem 2rem;
        text-align: center;
    }

    /* ============================================
       AVATAR
       ============================================ */
    .gs-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-top: -4.75rem;
        margin-bottom: 1.05rem;
    }

    .gs-avatar {
        display: block;
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        background: #fff;
        border: 5px solid #fff;
        box-shadow:
            0 0 0 5px rgba(30, 158, 111, 0.22),
            0 22px 46px -16px rgba(30, 158, 111, 0.6);
        animation: gsAvatarIn 0.8s cubic-bezier(0.2, 0.9, 0.3, 1.3) 0.15s both;
    }

    @keyframes gsAvatarIn {
        from { opacity: 0; transform: scale(0.72) translateY(16px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .gs-avatar-check {
        position: absolute;
        right: 0;
        bottom: 2px;
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 4px solid #fff;
        border-radius: 50%;
        color: #fff;
        font-size: 0.95rem;
        background: linear-gradient(135deg, var(--gs-primary), var(--gs-primary-dark));
        box-shadow: 0 10px 22px -8px rgba(30, 158, 111, 0.75);
        animation: gsAvatarCheckIn 0.5s cubic-bezier(0.2, 0.9, 0.3, 1.5) 0.55s both;
    }

    @keyframes gsAvatarCheckIn {
        from { opacity: 0; transform: scale(0.3); }
        to   { opacity: 1; transform: scale(1); }
    }

    /* ============================================
       GUEST NAME / ROLE / WELCOME
       ============================================ */
    .gs-guest-name {
        margin: 0.55rem 0 0.2rem;
        color: var(--gs-ink);
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1.28;
        letter-spacing: -0.015em;
    }

    .gs-guest-name span {
        color: var(--gs-primary-dark);
    }

    .gs-guest-role {
        margin-bottom: 1.35rem;
        color: var(--gs-muted);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .gs-welcome-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.9rem;
        padding: 9px 22px;
        border-radius: 50px;
        color: #7a5a1a;
        font-size: 0.84rem;
        font-weight: 700;
        line-height: 1.4;
        background: linear-gradient(135deg, #fffbf1, var(--gs-accent-light));
        border: 1px solid #f3e4c4;
        box-shadow: 0 6px 16px -10px rgba(212, 162, 74, 0.55);
    }

    .gs-welcome-pill i {
        color: var(--gs-accent);
        font-size: 0.9rem;
    }

    /* ============================================
       SECTION LABEL
       ============================================ */
    .gs-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 0.7rem;
        color: var(--gs-primary-dark);
        font-size: 0.71rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-align: left;
        text-transform: uppercase;
    }

    .gs-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--gs-primary-light), transparent);
    }

    .gs-section-label i {
        color: var(--gs-accent);
        font-size: 0.78rem;
    }

    /* ============================================
       INFO GRID
       ============================================ */
    .gs-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem 0.85rem;
        text-align: left;
    }

    .gs-info-item {
        padding: 0.8rem 1rem;
        border: 1px solid #d9f0e6;
        border-radius: var(--gs-radius-sm);
        background: linear-gradient(180deg, #f7fdfa, var(--gs-primary-lighter));
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .gs-info-item:hover {
        transform: translateY(-2px);
        border-color: rgba(30, 158, 111, 0.35);
        box-shadow: 0 8px 20px -12px rgba(30, 158, 111, 0.5);
    }

    .gs-info-item--full {
        grid-column: 1 / -1;
    }

    .gs-info-label {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #6a9d86;
        font-size: 0.67rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        line-height: 1.3;
    }

    .gs-info-label i {
        color: var(--gs-primary);
        font-size: 0.72rem;
    }

    .gs-info-value {
        margin-top: 4px;
        color: var(--gs-ink);
        font-size: 0.94rem;
        font-weight: 700;
        line-height: 1.45;
        word-break: break-word;
    }

    /* ============================================
       SCAN STAMP
       ============================================ */
    .gs-scan-stamp {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-top: 1.6rem;
        padding: 10px 22px;
        border: 1px dashed var(--gs-border-light);
        border-radius: 50px;
        color: var(--gs-muted);
        font-size: 0.81rem;
        font-weight: 600;
        background: #fdfaf9;
        line-height: 1.4;
    }

    .gs-scan-stamp i {
        color: #8a4547;
        font-size: 0.85rem;
    }

    .gs-scan-stamp strong {
        color: var(--gs-ink);
        font-weight: 700;
    }

    /* ============================================
       ACTIONS
       ============================================ */
    .gs-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.7rem;
        margin-top: 1.85rem;
        padding-top: 1.6rem;
        border-top: 1px solid var(--gs-line);
    }

    .gs-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.78rem 1.6rem;
        border: 1px solid transparent;
        border-radius: var(--gs-radius-sm);
        font-family: var(--gs-font);
        font-size: 0.86rem;
        font-weight: 700;
        line-height: 1.2;
        text-decoration: none;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        -webkit-tap-highlight-color: transparent;
    }

    .gs-btn:active {
        transform: translateY(0) scale(0.98);
    }

    .gs-btn i {
        font-size: 0.88rem;
    }

    .gs-btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--gs-primary), var(--gs-primary-dark));
        box-shadow: 0 14px 26px -12px rgba(30, 158, 111, 0.75);
    }

    .gs-btn-primary:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 20px 32px -12px rgba(30, 158, 111, 0.85);
    }

    .gs-btn-ghost {
        color: var(--gs-ink-soft);
        background: #fff;
        border-color: var(--gs-border-light);
        box-shadow: 0 4px 14px -8px rgba(40, 10, 10, 0.2);
    }

    .gs-btn-ghost:hover {
        color: var(--gs-primary-dark);
        background: var(--gs-primary-lighter);
        border-color: rgba(30, 158, 111, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 10px 22px -12px rgba(30, 158, 111, 0.5);
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 767px) {
        .gs-page {
            padding: 1.25rem 0 2.5rem;
        }

        .gs-container {
            padding: 0 0.85rem;
        }

        .gs-topbar {
            padding: 0.75rem 1rem;
            border-radius: var(--gs-radius-sm);
        }

        .gs-topbar-title h1 { font-size: 1rem; }
        .gs-topbar-title p  { font-size: 0.72rem; }
        .gs-topbar-icon     { width: 40px; height: 40px; font-size: 1rem; }
        .gs-status-pill     { font-size: 0.7rem; padding: 6px 13px; }

        .gs-card-header {
            padding: 2.25rem 1.15rem 4.25rem;
        }

        .gs-check-ring {
            width: 92px;
            height: 92px;
            font-size: 2.4rem;
        }

        .gs-card-title    { font-size: 1.28rem; margin-top: 1.35rem; }
        .gs-card-subtitle { font-size: 0.85rem; }

        .gs-card-body { padding: 0 1.15rem 1.75rem; }

        .gs-avatar {
            width: 108px;
            height: 108px;
            border-width: 4px;
            box-shadow:
                0 0 0 4px rgba(30, 158, 111, 0.22),
                0 18px 36px -14px rgba(30, 158, 111, 0.6);
        }

        .gs-avatar-check {
            width: 36px;
            height: 36px;
            font-size: 0.82rem;
            border-width: 3px;
        }

        .gs-guest-name    { font-size: 1.24rem; }
        .gs-guest-role    { font-size: 0.85rem; }
        .gs-welcome-pill  { font-size: 0.78rem; padding: 8px 18px; }

        .gs-info-grid { grid-template-columns: 1fr; gap: 0.6rem; }

        .gs-scan-stamp {
            font-size: 0.76rem;
            padding: 9px 16px;
        }

        .gs-actions {
            flex-direction: column;
            gap: 0.6rem;
        }

        .gs-btn {
            width: 100%;
            padding: 0.85rem 1.25rem;
        }
    }

    @media (max-width: 380px) {
        .gs-guest-name { font-size: 1.15rem; }
        .gs-check-ring { width: 84px; height: 84px; font-size: 2.15rem; }
    }

    /* ============================================
       PRINT
       ============================================ */
    @media print {
        body, .gs-page {
            padding: 0 !important;
            background: #fff !important;
            min-height: auto;
        }

        .gs-confetti,
        .gs-topbar,
        .gs-actions {
            display: none !important;
        }

        .gs-card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            border-radius: 12px;
            max-width: 100%;
            margin: 0;
        }

        .gs-card-header {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            padding: 1.75rem 1.25rem 3.5rem;
        }

        .gs-check-ring { width: 84px; height: 84px; font-size: 2.2rem; }
        .gs-avatar     { width: 100px; height: 100px; }
        .gs-card-title { font-size: 1.25rem; }
    }

    /* ============================================
       ACCESSIBILITY
       ============================================ */
    @media (prefers-reduced-motion: reduce) {
        .gs-page *,
        .gs-page *::before,
        .gs-page *::after {
            animation-duration: 0.001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.001ms !important;
        }
    }

    /* Focus states */
    .gs-btn:focus-visible {
        outline: 3px solid rgba(30, 158, 111, 0.5);
        outline-offset: 2px;
    }
</style>
@endpush

@section('content')
<div class="gs-page">
    <div class="gs-confetti" id="gsConfetti" aria-hidden="true"></div>

    <div class="gs-container">

        {{-- ========== TOP BAR ========== --}}
        <header class="gs-topbar">
            <div class="gs-topbar-left">
                <span class="gs-topbar-icon" aria-hidden="true">
                    <i class="fas fa-check-circle"></i>
                </span>
                <div class="gs-topbar-title">
                    <h1>প্রবেশ সফল হয়েছে</h1>
                    <p>সংবর্ধনায় আপনাকে স্বাগতম</p>
                </div>
            </div>
            <span class="gs-status-pill" role="status">
                <span class="gs-status-dot" aria-hidden="true"></span>
                যাচাই সম্পন্ন
            </span>
        </header>

        {{-- ========== MAIN CARD ========== --}}
        <main class="gs-card" role="main">

            {{-- Header banner --}}
            <div class="gs-card-header">
                <div class="gs-check-ring" aria-hidden="true">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="gs-card-title">প্রবেশ সফলভাবে রেকর্ড হয়েছে</h2>
                <p class="gs-card-subtitle">আপনার উপস্থিতি নিশ্চিত করা হয়েছে</p>
            </div>

            {{-- Body --}}
            <div class="gs-card-body">

                {{-- Avatar --}}
                <div class="gs-avatar-wrap">
                    @if ($user->photo && Storage::disk('uploads')->exists(ltrim(str_replace('\\', '/', $user->photo), '/')))
                        <img
                            src="{{ Storage::disk('uploads')->url(ltrim(str_replace('\\', '/', $user->photo), '/')) }}"
                            alt="{{ $user->name }}"
                            class="gs-avatar"
                            loading="eager"
                        >
                    @else
                        <img
                            src="{{ asset('images/default-user.png') }}"
                            alt="{{ $user->name }}"
                            class="gs-avatar"
                            loading="eager"
                        >
                    @endif
                    <span class="gs-avatar-check" aria-hidden="true">
                        <i class="fas fa-check"></i>
                    </span>
                </div>

                {{-- Name & Role --}}
                <h3 class="gs-guest-name">
                    প্রিয় <span>{{ $user->name }}</span>, আপনাকে স্বাগতম!
                </h3>
                <p class="gs-guest-role">সম্মানিত অতিথি</p>

                {{-- Welcome pill --}}
                <span class="gs-welcome-pill">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    আপনার প্রবেশ সফলভাবে সম্পন্ন হয়েছে
                </span>

                {{-- Info section --}}
                <div class="gs-section-label">
                    <i class="fas fa-id-card" aria-hidden="true"></i>
                    অতিথির তথ্য
                </div>

                <div class="gs-info-grid">
                    <div class="gs-info-item">
                        <div class="gs-info-label">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            নাম
                        </div>
                        <div class="gs-info-value">{{ $user->name ?: '—' }}</div>
                    </div>

                    <div class="gs-info-item">
                        <div class="gs-info-label">
                            <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                            মোবাইল
                        </div>
                        <div class="gs-info-value">{{ $user->mobile ?: '—' }}</div>
                    </div>

                    <div class="gs-info-item gs-info-item--full">
                        <div class="gs-info-label">
                            <i class="fas fa-user-tag" aria-hidden="true"></i>
                            পরিচয়
                        </div>
                        <div class="gs-info-value">সম্মানিত অতিথি</div>
                    </div>
                </div>

                {{-- Scan timestamp --}}
                <div class="gs-scan-stamp">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    স্ক্যান করা হয়েছে:
                    <strong>{{ now()->format('d M Y, h:i A') }}</strong>
                </div>

                {{-- Actions --}}
                <div class="gs-actions">
                    <button type="button" onclick="window.print()" class="gs-btn gs-btn-primary">
                        <i class="fas fa-print" aria-hidden="true"></i>
                        প্রিন্ট করুন
                    </button>
                    <a href="{{ url('/') }}" class="gs-btn gs-btn-ghost">
                        <i class="fas fa-home" aria-hidden="true"></i>
                        হোমে ফিরে যান
                    </a>
                </div>

            </div>
        </main>

    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var confettiWrap = document.getElementById('gsConfetti');
        if (!confettiWrap) return;

        // Respect reduced motion preference
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        var colors = ['#1e9e6f', '#34d399', '#d4a24a', '#f0d9a8', '#8a4547', '#8ab4f8', '#0f6e4c'];
        var fragment = document.createDocumentFragment();
        var PIECE_COUNT = 90;

        for (var i = 0; i < PIECE_COUNT; i++) {
            var piece = document.createElement('span');
            var size = 6 + Math.random() * 8;
            var isCircle = Math.random() > 0.5;

            piece.style.left = (Math.random() * 100) + 'vw';
            piece.style.width = size + 'px';
            piece.style.height = (size * (1.3 + Math.random() * 0.5)) + 'px';
            piece.style.background = colors[Math.floor(Math.random() * colors.length)];
            piece.style.borderRadius = isCircle ? '50%' : '2px';
            piece.style.animationDelay = (Math.random() * 1.6) + 's';
            piece.style.animationDuration = (3.4 + Math.random() * 2.6) + 's';
            piece.style.opacity = '0';

            fragment.appendChild(piece);
        }

        confettiWrap.appendChild(fragment);

        // Cleanup after the last animation finishes
        window.setTimeout(function () {
            if (confettiWrap) {
                confettiWrap.innerHTML = '';
            }
        }, 11000);
    });
})();
</script>
@endpush