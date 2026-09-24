{{-- resources/views/frontend/pages/qrcode/student-scanned.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'প্রবেশ সফল')

@push('styles')

<style>
    :root {
        --qr-primary: #8a4547;
        --qr-primary-dark: #5e2628;
        --qr-accent: #d4a24a;
        --qr-accent-dark: #b8862f;
        --qr-success: #1e9e6f;
        --qr-success-dark: #0f6e4c;
        --qr-success-light: #34d399;
        --qr-ink: #1c1414;
        --qr-muted: #8a7d7d;
        --qr-line: #f0e6e6;
        --qr-surface: #ffffff;
        --qr-shadow-sm: 0 2px 8px -2px rgba(40, 10, 10, 0.08);
        --qr-shadow-md: 0 12px 32px -12px rgba(40, 10, 10, 0.18);
        --qr-shadow-lg: 0 24px 60px -24px rgba(40, 10, 10, 0.28);
        --qr-shadow-success: 0 24px 60px -22px rgba(30, 158, 111, 0.45);
        --qr-radius: 22px;
        --qr-radius-sm: 14px;
    }

    body {
        font-family: 'Hind Siliguri', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .qr-success-page {
        background:
            radial-gradient(1000px 500px at 8% -8%, #eefcf5 0%, transparent 60%),
            radial-gradient(800px 400px at 92% -4%, #fdf6e9 0%, transparent 55%),
            linear-gradient(180deg, #f5fdf9 0%, #ffffff 42%);
        min-height: 100vh;
        padding: 2.25rem 0 4rem;
        position: relative;
        overflow: hidden;
    }


    .qr-confetti {
        position: fixed;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 1;
    }

    .qr-confetti span {
        position: absolute;
        width: 10px;
        height: 14px;
        opacity: 0;
        top: -20px;
        animation: qrConfettiFall linear forwards;
        border-radius: 2px;
    }

    @keyframes qrConfettiFall {
        0% {
            opacity: 0;
            transform: translateY(-10vh) rotate(0deg);
        }
        10% { opacity: 1; }
        100% {
            opacity: 0.9;
            transform: translateY(105vh) rotate(720deg);
        }
    }


    .qr-page-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
        padding: 0.9rem 1.25rem;
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(30, 158, 111, 0.16);
        border-radius: 18px;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 10px 28px -16px rgba(30, 158, 111, 0.35);
        animation: qrBarIn 0.55s cubic-bezier(.2,.9,.3,1.1) both;
        position: relative;
        z-index: 2;
    }

    @keyframes qrBarIn {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .qr-page-bar-title {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        min-width: 0;
    }

    .qr-page-bar-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--qr-success) 0%, var(--qr-success-dark) 100%);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        box-shadow: 0 8px 18px -8px rgba(30, 158, 111, 0.6);
        flex-shrink: 0;
    }

    .qr-page-bar-title h1 {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--qr-ink);
        margin: 0;
        letter-spacing: -0.01em;
        line-height: 1.25;
    }

    .qr-page-bar-title p {
        font-size: 0.78rem;
        color: var(--qr-muted);
        margin: 0;
        line-height: 1.3;
    }

    .qr-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 50px;
        padding: 7px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        white-space: nowrap;
        background: linear-gradient(135deg, #e9faf1 0%, #d6f3e5 100%);
        border: 1px solid rgba(30, 158, 111, 0.22);
        color: var(--qr-success-dark);
        box-shadow: 0 6px 16px -8px rgba(30, 158, 111, 0.5);
    }

    .qr-status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: qrPulseDot 1.8s infinite;
    }

    @keyframes qrPulseDot {
        0%   { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.65); }
        70%  { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
        100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }


    .qr-success-card {
        border: 1px solid rgba(30, 158, 111, 0.18);
        border-radius: 26px;
        box-shadow: var(--qr-shadow-success);
        overflow: hidden;
        background: var(--qr-surface);
        position: relative;
        animation: qrCardIn 0.75s cubic-bezier(.2,.9,.3,1.1) both;
        z-index: 2;
    }

    @keyframes qrCardIn {
        from { opacity: 0; transform: translateY(24px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }


    .qr-success-header {
        background:
            radial-gradient(140% 140% at 0% 0%, rgba(255,255,255,0.22) 0%, transparent 55%),
            radial-gradient(120% 120% at 100% 100%, rgba(52, 211, 153, 0.4) 0%, transparent 55%),
            linear-gradient(135deg, #0f6e4c 0%, var(--qr-success) 55%, #2bb37f 100%);
        padding: 2.75rem 1.5rem 4.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .qr-success-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 26px 26px;
        mask-image: radial-gradient(ellipse at center, #000 25%, transparent 82%);
        -webkit-mask-image: radial-gradient(ellipse at center, #000 25%, transparent 82%);
        pointer-events: none;
    }

    .qr-success-header::after {
        content: '';
        position: absolute;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 62%);
        top: -180px;
        right: -120px;
        pointer-events: none;
        animation: qrFloat 9s ease-in-out infinite;
    }

    @keyframes qrFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50%      { transform: translate(-18px, 16px) scale(1.06); }
    }

    /* Animated check ring */
    .qr-check-ring {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: rgba(255,255,255,0.16);
        border: 2px solid rgba(255,255,255,0.32);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        box-shadow:
            0 20px 50px rgba(0,0,0,0.22),
            inset 0 2px 0 rgba(255,255,255,0.28);
        animation: qrRingIn 0.8s cubic-bezier(.2,.9,.3,1.5) both;
    }

    @keyframes qrRingIn {
        from { opacity: 0; transform: scale(0.5) rotate(-15deg); }
        to   { opacity: 1; transform: scale(1) rotate(0); }
    }

    .qr-check-ring::before,
    .qr-check-ring::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.35);
        pointer-events: none;
    }

    .qr-check-ring::before {
        inset: -14px;
        animation: qrRingPulse 2.4s ease-out infinite;
    }

    .qr-check-ring::after {
        inset: -28px;
        opacity: 0.5;
        animation: qrRingPulse 2.4s ease-out 0.5s infinite;
    }

    @keyframes qrRingPulse {
        0%   { transform: scale(0.94); opacity: 0.7; }
        100% { transform: scale(1.16); opacity: 0; }
    }

    .qr-check-icon {
        font-size: 3rem;
        color: #fff;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.25));
        animation: qrCheckDraw 0.7s cubic-bezier(.2,.9,.3,1.6) 0.35s both;
    }

    @keyframes qrCheckDraw {
        from { transform: scale(0) rotate(-60deg); opacity: 0; }
        to   { transform: scale(1) rotate(0); opacity: 1; }
    }

    .qr-success-title {
        font-size: 1.55rem;
        font-weight: 800;
        color: #fff;
        margin: 1.5rem 0 0.4rem;
        letter-spacing: -0.01em;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 16px rgba(0,0,0,0.2);
        line-height: 1.3;
    }

    .qr-success-subtitle {
        font-size: 0.92rem;
        color: rgba(255,255,255,0.86);
        margin: 0;
        position: relative;
        z-index: 1;
        font-weight: 500;
    }


    .qr-success-body {
        padding: 0 1.75rem 2rem;
        text-align: center;
        position: relative;
    }

    /* Floating avatar */
    .qr-success-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-top: -4.5rem;
        margin-bottom: 1rem;
    }

    .qr-success-avatar {
        width: 128px;
        height: 128px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow:
            0 0 0 5px rgba(30, 158, 111, 0.2),
            0 20px 42px -14px rgba(30, 158, 111, 0.55);
        background: #fff;
        display: block;
        animation: qrAvatarIn 0.75s cubic-bezier(.2,.9,.3,1.3) 0.15s both;
    }

    @keyframes qrAvatarIn {
        from { opacity: 0; transform: scale(0.75) translateY(14px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .qr-success-avatar-check {
        position: absolute;
        right: -2px;
        bottom: -2px;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--qr-success) 0%, var(--qr-success-dark) 100%);
        border: 4px solid #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.9rem;
        box-shadow: 0 8px 20px -6px rgba(30, 158, 111, 0.7);
        animation: qrBadgePop 0.55s cubic-bezier(.2,.9,.3,1.6) 0.6s both;
    }

    @keyframes qrBadgePop {
        from { transform: scale(0) rotate(-45deg); }
        to   { transform: scale(1) rotate(0); }
    }


    .qr-student-name-bn {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--qr-ink);
        letter-spacing: -0.01em;
        margin: 0.5rem 0 0.15rem;
        line-height: 1.25;
    }

    .qr-student-name-en {
        color: var(--qr-muted);
        font-size: 0.92rem;
        font-weight: 500;
        margin-bottom: 1.35rem;
    }


    .qr-welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #fffaf0 0%, #fdf3dd 100%);
        border: 1px solid #f3e4c4;
        border-radius: 50px;
        padding: 8px 20px;
        color: #7a5a1a;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 8px 20px -10px rgba(212, 162, 74, 0.6);
        margin-bottom: 1.75rem;
        animation: qrBadgePop 0.5s cubic-bezier(.2,.9,.3,1.5) 0.75s both;
    }

    .qr-welcome-badge i {
        color: var(--qr-accent-dark);
    }

    /* Section label */
    .qr-section-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--qr-success-dark);
        margin: 1.15rem 0 0.6rem;
        display: flex;
        align-items: center;
        gap: 8px;
        text-align: left;
    }

    .qr-section-label i {
        font-size: 0.8rem;
        color: var(--qr-accent);
    }

    .qr-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #d6f3e5 0%, transparent 100%);
    }

    /* Info grid */
    .qr-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.6rem 0.85rem;
        text-align: left;
    }

    .qr-info-item {
        background: linear-gradient(180deg, #f6fdf9 0%, #eefaf4 100%);
        border: 1px solid #d6f3e5;
        border-radius: var(--qr-radius-sm);
        padding: 0.72rem 0.9rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .qr-info-item:hover {
        transform: translateY(-2px);
        border-color: rgba(30, 158, 111, 0.35);
        box-shadow: 0 10px 22px -12px rgba(30, 158, 111, 0.5);
    }

    .qr-info-item .qr-info-label {
        font-size: 0.68rem;
        color: #6a9d86;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .qr-info-item .qr-info-label i {
        color: var(--qr-success);
        opacity: 0.85;
    }

    .qr-info-item .qr-info-value {
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--qr-ink);
        margin-top: 3px;
        word-break: break-word;
        line-height: 1.4;
    }

    .qr-info-item--full {
        grid-column: 1 / -1;
    }

    /* Scan time stamp */
    .qr-scan-stamp {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: linear-gradient(135deg, #fdf9f9 0%, #faf4f4 100%);
        border: 1px dashed #e8dcdc;
        border-radius: 50px;
        padding: 9px 20px;
        color: var(--qr-muted);
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 1.5rem;
    }

    .qr-scan-stamp i {
        color: var(--qr-primary);
        opacity: 0.75;
    }

    .qr-scan-stamp strong {
        color: var(--qr-ink);
        font-weight: 700;
    }

    /* Actions */
    .qr-success-actions {
        display: flex;
        gap: 0.65rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 1.75rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f0e6e6;
    }

    .qr-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.86rem;
        border: 1px solid transparent;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        text-decoration: none;
        letter-spacing: 0.1px;
    }

    .qr-btn:hover { transform: translateY(-2px); color: inherit; }
    .qr-btn:active { transform: translateY(0); }

    .qr-btn-success {
        background: linear-gradient(135deg, var(--qr-success) 0%, var(--qr-success-dark) 100%);
        color: #fff;
        box-shadow: 0 12px 24px -10px rgba(30, 158, 111, 0.7);
    }
    .qr-btn-success:hover {
        color: #fff;
        box-shadow: 0 16px 30px -10px rgba(30, 158, 111, 0.8);
    }

    .qr-btn-ghost {
        background: #fff;
        color: var(--qr-ink);
        border-color: #e8dcdc;
        box-shadow: 0 4px 12px -6px rgba(40, 10, 10, 0.15);
    }
    .qr-btn-ghost:hover {
        color: var(--qr-success-dark);
        border-color: rgba(30, 158, 111, 0.4);
        background: #f6fdf9;
    }


    @media print {
        .qr-page-bar, .qr-success-actions, .qr-confetti { display: none !important; }
        body, .qr-success-page { background: #fff !important; padding: 0 !important; }
        .qr-success-card { box-shadow: none !important; border: 1px solid #ccc !important; animation: none !important; }
    }

    @media (max-width: 767px) {
        .qr-info-grid { grid-template-columns: 1fr; }
        .qr-success-header { padding: 2.25rem 1.25rem 4rem; }
        .qr-success-body { padding: 0 1.25rem 1.75rem; }
        .qr-success-avatar { width: 108px; height: 108px; }
        .qr-success-avatar-check { width: 36px; height: 36px; font-size: 0.78rem; }
        .qr-student-name-bn { font-size: 1.28rem; }
        .qr-check-ring { width: 92px; height: 92px; }
        .qr-check-icon { font-size: 2.5rem; }
        .qr-success-title { font-size: 1.3rem; }
        .qr-page-bar { padding: 0.75rem 1rem; }
        .qr-page-bar-title h1 { font-size: 1.02rem; }
    }
</style>
@endpush

@section('content')
<div class="qr-success-page">

    <!-- Confetti Layer -->
    <div class="qr-confetti" id="qrConfetti" aria-hidden="true"></div>

    <div class="container position-relative" style="z-index: 2;">

        <!-- Page Bar -->
        <div class="qr-page-bar">
            <div class="qr-page-bar-title">
                <span class="qr-page-bar-icon"><i class="fas fa-check-circle"></i></span>
                <div>
                    <h1>প্রবেশ সফল হয়েছে</h1>
                    <p>সংবর্ধনায় আপনাকে স্বাগতম</p>
                </div>
            </div>
            <span class="qr-status-pill">
                <span class="qr-status-dot"></span> যাচাই সম্পন্ন
            </span>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="qr-success-card">

                    <!-- Header -->
                    <div class="qr-success-header">
                        <div class="qr-check-ring">
                            <i class="fas fa-check qr-check-icon"></i>
                        </div>
                        <h2 class="qr-success-title">প্রবেশ সফলভাবে রেকর্ড হয়েছে</h2>
                        <p class="qr-success-subtitle">আপনার উপস্থিতি নিশ্চিত করা হয়েছে</p>
                    </div>

                    <!-- Body -->
                    <div class="qr-success-body">

                        <div class="qr-success-avatar-wrap">
                            <img src="{{ $detail?->student_photo_url }}"
                                 alt="{{ $detail?->name_bn ?? $user->name }}"
                                 class="qr-success-avatar">
                            <span class="qr-success-avatar-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>

                        <div class="qr-student-name-bn">
                            প্রিয় নাম্বার ওয়ান বাবার কৃতী সন্তান {{ $detail?->name_bn ?? $user->name }},আপনাকে স্বাগতম!
                        </div>
                        <div class="qr-student-name-en">
                            {{ $detail?->name_en ?? '' }}
                        </div>

                        <span class="qr-welcome-badge">
                            <i class="fas fa-star"></i> আপনার প্রবেশ সফলভাবে সম্পন্ন হয়েছে
                        </span>

                        <!-- Info Grid -->
                        <div class="qr-section-label">
                            <i class="fas fa-id-card"></i> শিক্ষার্থীর তথ্য
                        </div>

                        <div class="qr-info-grid">
                            <div class="qr-info-item">
                                <div class="qr-info-label"><i class="fas fa-user"></i> নাম (ইংরেজি)</div>
                                <div class="qr-info-value">{{ $detail?->name_en ?? '—' }}</div>
                            </div>
                            <div class="qr-info-item">
                                <div class="qr-info-label"><i class="fas fa-mobile-alt"></i> মোবাইল</div>
                                <div class="qr-info-value">{{ $user->mobile ?? '—' }}</div>
                            </div>
                            <div class="qr-info-item">
                                <div class="qr-info-label"><i class="fas fa-hashtag"></i> রোল নম্বর</div>
                                <div class="qr-info-value">{{ $detail?->roll_number ?? '—' }}</div>
                            </div>
                            <div class="qr-info-item">
                                <div class="qr-info-label"><i class="fas fa-id-badge"></i> রেজিস্ট্রেশন</div>
                                <div class="qr-info-value">{{ $detail?->registration_number ?? '—' }}</div>
                            </div>
                        </div>

                        <!-- Scan Timestamp -->
                        <div class="qr-scan-stamp">
                            <i class="fas fa-clock"></i>
                            স্ক্যান করা হয়েছে: <strong>{{ now()->format('d M Y, h:i A') }}</strong>
                        </div>

                        <!-- Actions -->
                        <div class="qr-success-actions">
                            <button type="button" onclick="window.print()" class="qr-btn qr-btn-success">
                                <i class="fas fa-print"></i> প্রিন্ট করুন
                            </button>
                            <a href="{{ url('/') }}" class="qr-btn qr-btn-ghost">
                                <i class="fas fa-home"></i> হোমে ফিরে যান
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const confettiWrap = document.getElementById('qrConfetti');
    const colors = ['#1e9e6f', '#34d399', '#d4a24a', '#f0d9a8', '#8a4547', '#8ab4f8'];
    const pieces = 100;

    if (confettiWrap) {
        for (let i = 0; i < pieces; i++) {
            const span = document.createElement('span');
            const size = 6 + Math.random() * 8;
            const left = Math.random() * 100;
            const delay = Math.random() * 1.5;
            const duration = 3.2 + Math.random() * 2.4;
            const color = colors[Math.floor(Math.random() * colors.length)];

            span.style.left = left + 'vw';
            span.style.width = size + 'px';
            span.style.height = (size * 1.4) + 'px';
            span.style.background = color;
            span.style.borderRadius = Math.random() > 0.5 ? '50%' : '2px';
            span.style.animationDelay = delay + 's';
            span.style.animationDuration = duration + 's';
            span.style.boxShadow = '0 0 8px ' + color + '66';

            confettiWrap.appendChild(span);
        }


        setTimeout(() => {
            if (confettiWrap) confettiWrap.innerHTML = '';
        }, 10000);
    }
});
</script>
@endpush
