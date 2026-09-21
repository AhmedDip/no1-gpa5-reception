{{-- resources/views/frontend/pages/qrcode/index.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'সংবর্ধনায় প্রবেশের QR কোড')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --qr-primary: #8a4547;
        --qr-primary-soft: #8a4547cc;
        --qr-primary-dark: #5e2628;
        --qr-accent: #d4a24a;
        --qr-accent-light: #f0d9a8;
        --qr-success: #1e9e6f;
        --qr-success-dark: #0f6e4c;
        --qr-ink: #1c1414;
        --qr-muted: #8a7d7d;
        --qr-line: #f0e6e6;
        --qr-surface: #ffffff;
        --qr-bg: #faf7f7;
        --qr-shadow-sm: 0 2px 8px -2px rgba(40, 10, 10, 0.08);
        --qr-shadow-md: 0 12px 32px -12px rgba(40, 10, 10, 0.18);
        --qr-shadow-lg: 0 24px 60px -24px rgba(40, 10, 10, 0.28);
        --qr-radius: 22px;
        --qr-radius-sm: 14px;
    }

    body {
        font-family: 'Hind Siliguri', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .qr-page-bg {
        background:
            radial-gradient(1000px 460px at 8% -8%, #fdf1f1 0%, transparent 60%),
            radial-gradient(800px 380px at 92% -4%, #fdf6e9 0%, transparent 55%),
            linear-gradient(180deg, #faf7f7 0%, #ffffff 40%);
        min-height: 100vh;
        padding: 2.5rem 0 4rem;
        position: relative;
    }

    /* ===================== TOP PAGE BAR ===================== */
    .qr-page-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
        padding: 0.9rem 1.25rem;
        background: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(240, 230, 230, 0.9);
        border-radius: 18px;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: var(--qr-shadow-sm);
        animation: qrBarIn 0.5s cubic-bezier(.2,.9,.3,1.1) both;
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
        background: linear-gradient(135deg, var(--qr-primary) 0%, var(--qr-primary-dark) 100%);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        box-shadow: 0 8px 18px -8px rgba(138, 69, 71, 0.6);
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

    .qr-live-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #e9faf1 0%, #d6f3e5 100%);
        border: 1px solid rgba(30, 158, 111, 0.22);
        color: var(--qr-success-dark);
        border-radius: 50px;
        padding: 7px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        box-shadow: 0 6px 16px -8px rgba(30, 158, 111, 0.5);
        white-space: nowrap;
    }

    .qr-live-dot {
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

    /* ===================== CARDS ===================== */
    .qr-card {
        border: 1px solid rgba(240, 230, 230, 0.9);
        border-radius: var(--qr-radius);
        box-shadow: var(--qr-shadow-md);
        overflow: hidden;
        background: var(--qr-surface);
        transition: box-shadow 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .qr-card:hover {
        box-shadow: var(--qr-shadow-lg);
        transform: translateY(-4px);
        border-color: rgba(138, 69, 71, 0.16);
    }

    .qr-card-header {
        padding: 1.1rem 1.35rem;
        border-bottom: 1px solid var(--qr-line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        background: linear-gradient(180deg, #fffdfd 0%, #fbf6f6 100%);
    }

    .qr-card-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--qr-ink);
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: -0.005em;
    }

    .qr-card-header h6 .qr-hicon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(138, 69, 71, 0.12) 0%, rgba(138, 69, 71, 0.05) 100%);
        color: var(--qr-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    /* ---- Card header variants ---- */
    .qr-card-header--gold {
        background: linear-gradient(135deg, #fffaf0 0%, #fdf3dd 100%);
        border-bottom-color: #f3e4c4;
    }
    .qr-card-header--gold h6 .qr-hicon {
        background: linear-gradient(135deg, var(--qr-accent) 0%, #b8862f 100%);
        color: #fff;
        box-shadow: 0 6px 14px -6px rgba(212, 162, 74, 0.7);
    }

    .qr-card-header--green {
        background: linear-gradient(135deg, #f2fbf6 0%, #dff5ea 100%);
        border-bottom-color: #c6ecd9;
    }
    .qr-card-header--green h6 .qr-hicon {
        background: linear-gradient(135deg, var(--qr-success) 0%, var(--qr-success-dark) 100%);
        color: #fff;
        box-shadow: 0 6px 14px -6px rgba(30, 158, 111, 0.7);
    }

    .qr-card-header--dark {
        background:
            radial-gradient(120% 140% at 0% 0%, rgba(212,162,74,0.16) 0%, transparent 55%),
            linear-gradient(135deg, #1c1414 0%, #2c1f1f 100%);
        border-bottom: none;
    }
    .qr-card-header--dark h6 { color: #fff; }
    .qr-card-header--dark h6 .qr-hicon {
        background: linear-gradient(135deg, var(--qr-accent) 0%, #b8862f 100%);
        color: #fff;
    }

    .qr-live-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.4px;
    }

    .qr-live-badge::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 8px #4ade80;
        animation: qrPulseDot 1.8s infinite;
    }

    .qr-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(30, 158, 111, 0.1);
        color: var(--qr-success-dark);
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    /* ===================== QR IMAGE FRAME ===================== */
    .qr-image-frame {
        background:
            linear-gradient(#fff, #fff) padding-box,
            linear-gradient(135deg, var(--qr-accent) 0%, var(--qr-primary) 100%) border-box;
        border: 2px solid transparent;
        border-radius: 20px;
        padding: 16px;
        display: inline-block;
        box-shadow:
            0 12px 28px -12px rgba(138, 69, 71, 0.35),
            0 0 0 6px rgba(138, 69, 71, 0.04);
        position: relative;
        animation: qrFrameIn 0.6s cubic-bezier(.2,.9,.3,1.2) both;
    }

    @keyframes qrFrameIn {
        from { opacity: 0; transform: scale(0.9); }
        to   { opacity: 1; transform: scale(1); }
    }

    .qr-image-frame::after {
        content: '';
        position: absolute;
        inset: -14px;
        border-radius: 28px;
        border: 1px dashed rgba(138, 69, 71, 0.18);
        pointer-events: none;
    }

    .qr-empty-state {
        color: #b3a6a6;
        padding: 3rem 1rem;
        font-weight: 500;
        text-align: center;
    }

    .qr-empty-state i {
        font-size: 3rem;
        opacity: 0.32;
        display: block;
        margin-bottom: 0.9rem;
        color: var(--qr-primary);
    }

    /* ===================== QR NAME BLOCK ===================== */
    .qr-qr-name-bn {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--qr-ink);
        margin-bottom: 0.15rem;
        letter-spacing: -0.01em;
        line-height: 1.3;
    }

    .qr-qr-name-en {
        font-size: 0.85rem;
        color: var(--qr-muted);
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .qr-qr-roll {
        font-size: 0.8rem;
        color: var(--qr-muted);
        font-weight: 600;
    }

    /* ===================== HOW LIST ===================== */
    .qr-how-list {
        counter-reset: qrStep;
        list-style: none;
        padding-left: 0 !important;
        margin-bottom: 0;
    }

    .qr-how-list li {
        position: relative;
        padding: 0.6rem 0 0.6rem 2.5rem;
        counter-increment: qrStep;
        font-size: 0.87rem;
        color: #4a3e3e;
        line-height: 1.55;
        border-bottom: 1px dashed #f3eaea;
    }

    .qr-how-list li:last-child { border-bottom: none; }

    .qr-how-list li::before {
        content: counter(qrStep);
        position: absolute;
        left: 0;
        top: 0.55rem;
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: linear-gradient(135deg, var(--qr-primary) 0%, var(--qr-primary-dark) 100%);
        color: #fff;
        font-size: 0.74rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px -3px rgba(138, 69, 71, 0.5);
    }

    /* ===================== FEATURED ENTRY ===================== */
    .qr-featured-avatar {
        width: 128px;
        height: 128px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow:
            0 0 0 4px rgba(30, 158, 111, 0.2),
            0 16px 36px -12px rgba(30, 158, 111, 0.55);
        animation: qrAvatarIn 0.6s cubic-bezier(.2,.9,.3,1.3) both;
    }

    @keyframes qrAvatarIn {
        from { opacity: 0; transform: scale(0.85) translateY(8px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .qr-featured-name-bn {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--qr-ink);
        margin-bottom: 0.15rem;
        letter-spacing: -0.01em;
        line-height: 1.25;
    }

    .qr-featured-name-en {
        color: var(--qr-muted);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .qr-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.55rem 0.75rem;
    }

    .qr-info-item {
        background: linear-gradient(180deg, #fdf9f9 0%, #faf4f4 100%);
        border: 1px solid #f2e8e8;
        border-radius: var(--qr-radius-sm);
        padding: 0.62rem 0.82rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .qr-info-item:hover {
        transform: translateY(-2px);
        border-color: rgba(138, 69, 71, 0.22);
        box-shadow: 0 8px 18px -10px rgba(138, 69, 71, 0.3);
    }

    .qr-info-item .qr-info-label {
        font-size: 0.67rem;
        color: #a19191;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }

    .qr-info-item .qr-info-label i {
        color: var(--qr-primary);
        opacity: 0.72;
    }

    .qr-info-item .qr-info-value {
        font-weight: 700;
        font-size: 0.88rem;
        color: var(--qr-ink);
        margin-top: 3px;
        word-break: break-word;
        line-height: 1.4;
    }

    .qr-section-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--qr-primary);
        margin: 1.15rem 0 0.6rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .qr-section-label i {
        font-size: 0.8rem;
        color: var(--qr-accent);
    }

    .qr-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #f0dada 0%, transparent 100%);
    }

    .qr-scanned-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #e9faf1 0%, #d6f3e5 100%);
        color: var(--qr-success-dark);
        border: 1px solid rgba(30, 158, 111, 0.2);
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 700;
        font-size: 0.84rem;
        box-shadow: 0 6px 16px -8px rgba(30, 158, 111, 0.5);
    }

    .qr-scanned-badge i {
        animation: qrCheckPop 0.5s cubic-bezier(.2,.9,.3,1.5) both;
    }

    @keyframes qrCheckPop {
        from { transform: scale(0); }
        to   { transform: scale(1); }
    }

    /* ===================== RECENT SCANS ===================== */
    .qr-recent-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.8rem 1.2rem;
        border-bottom: 1px solid #f7f1f1;
        transition: background 0.2s ease;
        position: relative;
        animation: qrItemIn 0.4s ease both;
    }

    @keyframes qrItemIn {
        from { opacity: 0; transform: translateX(-6px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    .qr-recent-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--qr-accent) 0%, var(--qr-primary) 100%);
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .qr-recent-item:hover {
        background: linear-gradient(90deg, #fdf6f6 0%, #fbf9f4 100%);
    }

    .qr-recent-item:hover::before { opacity: 1; }
    .qr-recent-item:last-child { border-bottom: none; }

    .qr-recent-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px rgba(138, 69, 71, 0.14), 0 4px 10px -3px rgba(40,10,10,0.2);
        flex-shrink: 0;
        transition: transform 0.25s ease;
    }

    .qr-recent-item:hover .qr-recent-avatar {
        transform: scale(1.08);
    }

    .qr-recent-name {
        font-weight: 700;
        font-size: 0.86rem;
        color: var(--qr-ink);
        letter-spacing: -0.005em;
    }

    .qr-recent-meta {
        font-size: 0.72rem;
        color: var(--qr-muted);
        margin-top: 1px;
    }

    .qr-recent-time {
        font-size: 0.7rem;
        color: #a79696;
        font-weight: 700;
        white-space: nowrap;
        background: #faf4f4;
        border: 1px solid #f0e6e6;
        padding: 3px 10px;
        border-radius: 50px;
        letter-spacing: 0.2px;
    }

    .qr-scroll-panel {
        max-height: 560px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #e3d2d2 transparent;
    }

    .qr-scroll-panel::-webkit-scrollbar { width: 6px; }
    .qr-scroll-panel::-webkit-scrollbar-track { background: transparent; }
    .qr-scroll-panel::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #e3d2d2 0%, #d8c0c0 100%);
        border-radius: 10px;
    }
    .qr-scroll-panel::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #d8c0c0 0%, #c9a8a8 100%);
    }

    /* ===================== QUICK LINKS ===================== */
    .qr-quick-links a {
        color: var(--qr-primary);
        font-weight: 700;
        text-decoration: none;
        position: relative;
        padding-bottom: 1px;
        transition: color 0.2s ease;
    }

    .qr-quick-links a::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        background: currentColor;
        transform: scaleX(0.35);
        transform-origin: left;
        transition: transform 0.3s ease;
        opacity: 0.5;
    }

    .qr-quick-links a:hover { color: var(--qr-primary-dark); }
    .qr-quick-links a:hover::after { transform: scaleX(1); opacity: 1; }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 767px) {
        .qr-info-grid { grid-template-columns: 1fr; }
        .qr-featured-avatar { width: 108px; height: 108px; }
        .qr-page-bar { padding: 0.75rem 1rem; }
        .qr-page-bar-title h1 { font-size: 1.02rem; }
    }

    /* Entrance */
    .qr-fade-in { animation: qrFadeUp 0.55s cubic-bezier(.2,.8,.3,1) both; }
    .qr-fade-in.d1 { animation-delay: 0.06s; }
    .qr-fade-in.d2 { animation-delay: 0.12s; }
    .qr-fade-in.d3 { animation-delay: 0.18s; }

    @keyframes qrFadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
@php
    $d = $latestEntry?->studentDetail;
@endphp

<div class="qr-page-bg">
    <div class="container">

        <!-- Compact Page Bar -->
        <div class="qr-page-bar">
            <div class="qr-page-bar-title">
                <span class="qr-page-bar-icon"><i class="fas fa-qrcode"></i></span>
                <div>
                    <h1>সংবর্ধনায় প্রবেশ</h1>
                    <p>QR কোড স্ক্যান করে প্রবেশ নিশ্চিত করুন</p>
                </div>
            </div>
            <span class="qr-live-pill"><span class="qr-live-dot"></span> লাইভ আপডেট হচ্ছে</span>
        </div>

        <div class="row g-4">


            <div class="col-lg-4 qr-fade-in d1">
                <div class="qr-card">
                    <div class="qr-card-header qr-card-header--gold">
                        <h6>
                            <span class="qr-hicon"><i class="fas fa-qrcode"></i></span>
                            সর্বশেষ স্ক্যান করা QR কোড
                        </h6>
                    </div>
                    <div class="card-body p-4 text-center" id="latestQrBody">
                        @if ($latestQrDataUri && $d)
                            <div class="qr-image-frame mb-3">
                                <img src="{{ $latestQrDataUri }}"
                                    alt="{{ $d->name_en ?? '' }}"
                                    style="max-width: 220px; width: 100%; border-radius: 8px; display: block;">
                            </div>
                            <div class="qr-qr-name-bn">{{ $d->name_bn ?? $d->name_en }}</div>
                            <div class="qr-qr-name-en">{{ $d->name_en }}</div>
                            <div class="qr-qr-roll mb-3">রোল: {{ $d->roll_number ?? '—' }}</div>

                            <div class="qr-section-label text-start">
                                <i class="fas fa-graduation-cap"></i> একাডেমিক তথ্য
                            </div>
                            <div class="qr-info-grid text-start">
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-hashtag"></i> রোল নম্বর</div>
                                    <div class="qr-info-value">{{ $d->roll_number ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-id-card"></i> রেজিস্ট্রেশন</div>
                                    <div class="qr-info-value">{{ $d->registration_number ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-star"></i> জিপিএ</div>
                                    <div class="qr-info-value text-success">{{ $d->gpa_result ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-university"></i> বোর্ড</div>
                                    <div class="qr-info-value">{{ $d->board->name_bn ?? $d->board->name ?? '—' }}</div>
                                </div>
                            </div>
                        @else
                            <div class="qr-empty-state">
                                <i class="fas fa-qrcode"></i>
                                এখনো কোনো QR কোড স্ক্যান হয়নি
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Featured latest entry (guardian info) -->
            <div class="col-lg-4 qr-fade-in d2">
                <div class="qr-card">
                    <div class="qr-card-header qr-card-header--green">
                        <h6>
                            <span class="qr-hicon"><i class="fas fa-user-check"></i></span>
                            সর্বশেষ প্রবেশ
                        </h6>
                        <span class="qr-count-badge"><i class="fas fa-bolt"></i> লাইভ</span>
                    </div>
                    <div class="card-body p-4" id="lastScannedBody" style="min-height: 520px;">
                        @if ($latestEntry && $d)
                            <div class="text-center mb-3">
                                <img src="{{ $d->student_photo_url }}"
                                    alt="{{ $d->name_en ?? '' }}"
                                    class="qr-featured-avatar mb-3">
                                <div class="qr-featured-name-bn">{{ $d->name_bn ?? $d->name_en }}</div>
                                <div class="qr-featured-name-en">{{ $d->name_en }}</div>
                                <div class="mt-3">
                                    <span class="qr-scanned-badge">
                                        <i class="fas fa-check-circle"></i>
                                        {{ $latestEntry->scanned_at?->format('h:i A') }} · {{ $latestEntry->scanned_at?->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="qr-section-label"><i class="fas fa-phone"></i> যোগাযোগ</div>
                            <div class="qr-info-grid">
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-mobile-alt"></i> শিক্ষার্থীর মোবাইল</div>
                                    <div class="qr-info-value">{{ $latestEntry->student->mobile ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-phone-alt"></i> অভিভাবকের মোবাইল</div>
                                    <div class="qr-info-value">{{ $d->parent_mobile ?? '—' }}</div>
                                </div>
                            </div>

                            <div class="qr-section-label"><i class="fas fa-users"></i> অভিভাবকের তথ্য</div>
                            <div class="qr-info-grid">
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-male"></i> পিতার নাম</div>
                                    <div class="qr-info-value">{{ $d->father_name ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-female"></i> মাতার নাম</div>
                                    <div class="qr-info-value">{{ $d->mother_name ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item" style="grid-column: 1 / -1;">
                                    <div class="qr-info-label"><i class="fas fa-mug-hot"></i> চায়ের দোকান</div>
                                    <div class="qr-info-value">
                                        {{ $d->tea_stall_name ?? '—' }}
                                        @if ($d->tea_stall_location)
                                            <span class="text-muted fw-normal small d-block">{{ $d->tea_stall_location }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="qr-empty-state">
                                <i class="fas fa-user-clock"></i>
                                এখনো কোনো প্রবেশ রেকর্ড হয়নি
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent scans -->
            <div class="col-lg-4 qr-fade-in d3">
                <div class="qr-card">
                    <div class="qr-card-header qr-card-header--dark">
                        <h6>
                            <span class="qr-hicon"><i class="fas fa-list"></i></span>
                            সাম্প্রতিক প্রবেশ তালিকা
                        </h6>
                        <span class="qr-live-badge">লাইভ</span>
                    </div>
                    <div class="qr-scroll-panel" id="recentScansListWrap">
                        <ul class="list-unstyled mb-0" id="recentScansList">
                            @forelse ($entries as $entry)
                                @if ($entry->studentDetail)
                                    <li class="qr-recent-item">
                                        <img src="{{ $entry->studentDetail->student_photo_url }}"
                                            class="qr-recent-avatar">
                                        <div class="flex-grow-1 min-w-0">
                                            <div class="qr-recent-name text-truncate">
                                                {{ $entry->studentDetail->name_bn ?? $entry->studentDetail->name_en }}
                                            </div>
                                            <div class="qr-recent-meta">
                                                রোল: {{ $entry->studentDetail->roll_number ?? '—' }}
                                                @if ($entry->studentDetail->board?->name_bn)
                                                    · {{ $entry->studentDetail->board->name_bn }}
                                                @endif
                                            </div>
                                        </div>
                                        <span class="qr-recent-time">{{ $entry->scanned_at?->format('h:i A') }}</span>
                                    </li>
                                @endif
                            @empty
                                <li class="text-center text-muted py-5">কোনো তথ্য পাওয়া যায়নি</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="mt-5 text-center qr-quick-links">
            @auth
                <p class="text-muted small mb-2">
                    আপনি ইতিমধ্যে লগইন করেছেন
                    <a href="{{ route('admin.dashboard') }}">ড্যাশবোর্ডে যান</a>
                </p>
            @endauth
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const POLL_INTERVAL_MS = 5000;
    const lastScannedBody  = document.getElementById('lastScannedBody');
    const latestQrBody     = document.getElementById('latestQrBody');
    const recentScansList  = document.getElementById('recentScansList');

    let lastEntryId = @json($latestEntry?->id);

    function escapeHtml(str) {
        if (str == null || str === '') return '—';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    /* ---------- Render "সর্বশেষ প্রবেশ" card ---------- */
    function renderLastScanned(entry) {
        if (!entry) {
            lastScannedBody.innerHTML = `
                <div class="qr-empty-state">
                    <i class="fas fa-user-clock"></i>
                    এখনো কোনো প্রবেশ রেকর্ড হয়নি
                </div>`;
            return;
        }

        const teaStallLocationHtml = entry.tea_stall_location
            ? `<span class="text-muted fw-normal small d-block">${escapeHtml(entry.tea_stall_location)}</span>`
            : '';

        lastScannedBody.innerHTML = `
            <div class="text-center mb-3">
                <img src="${escapeHtml(entry.photo_url)}" alt="${escapeHtml(entry.name_en)}"
                     class="qr-featured-avatar mb-3">
                <div class="qr-featured-name-bn">${escapeHtml(entry.name_bn || entry.name_en)}</div>
                <div class="qr-featured-name-en">${escapeHtml(entry.name_en)}</div>
                <div class="mt-3">
                    <span class="qr-scanned-badge">
                        <i class="fas fa-check-circle"></i> ${escapeHtml(entry.scanned_at)} · ${escapeHtml(entry.scanned_date)}
                    </span>
                </div>
            </div>

            <div class="qr-section-label"><i class="fas fa-phone"></i> যোগাযোগ</div>
            <div class="qr-info-grid">
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-mobile-alt"></i> শিক্ষার্থীর মোবাইল</div>
                    <div class="qr-info-value">${escapeHtml(entry.mobile)}</div>
                </div>
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-phone-alt"></i> অভিভাবকের মোবাইল</div>
                    <div class="qr-info-value">${escapeHtml(entry.parent_mobile)}</div>
                </div>
            </div>

            <div class="qr-section-label"><i class="fas fa-users"></i> অভিভাবকের তথ্য</div>
            <div class="qr-info-grid">
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-male"></i> পিতার নাম</div>
                    <div class="qr-info-value">${escapeHtml(entry.father_name)}</div>
                </div>
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-female"></i> মাতার নাম</div>
                    <div class="qr-info-value">${escapeHtml(entry.mother_name)}</div>
                </div>
                <div class="qr-info-item" style="grid-column: 1 / -1;">
                    <div class="qr-info-label"><i class="fas fa-mug-hot"></i> চায়ের দোকান</div>
                    <div class="qr-info-value">${escapeHtml(entry.tea_stall_name)}${teaStallLocationHtml}</div>
                </div>
            </div>`;
    }

    /* ---------- Render "সর্বশেষ স্ক্যান করা QR কোড" card ---------- */
    function renderLatestQr(entry) {
        if (!entry || !entry.qr_data_uri) {
            latestQrBody.innerHTML = `
                <div class="qr-empty-state">
                    <i class="fas fa-qrcode"></i>
                    এখনো কোনো QR কোড স্ক্যান হয়নি
                </div>`;
            return;
        }

        latestQrBody.innerHTML = `
            <div class="qr-image-frame mb-3">
                <img src="${escapeHtml(entry.qr_data_uri)}" alt="${escapeHtml(entry.name_en)}"
                     style="max-width: 220px; width: 100%; border-radius: 8px; display: block;">
            </div>
            <div class="qr-qr-name-bn">${escapeHtml(entry.name_bn || entry.name_en)}</div>
            <div class="qr-qr-name-en">${escapeHtml(entry.name_en)}</div>
            <div class="qr-qr-roll mb-3">রোল: ${escapeHtml(entry.roll_number)}</div>

            <div class="qr-section-label text-start">
                <i class="fas fa-graduation-cap"></i> একাডেমিক তথ্য
            </div>
            <div class="qr-info-grid text-start">
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-hashtag"></i> রোল নম্বর</div>
                    <div class="qr-info-value">${escapeHtml(entry.roll_number)}</div>
                </div>
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-id-card"></i> রেজিস্ট্রেশন</div>
                    <div class="qr-info-value">${escapeHtml(entry.registration_number)}</div>
                </div>
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-star"></i> জিপিএ</div>
                    <div class="qr-info-value text-success">${escapeHtml(entry.gpa_result)}</div>
                </div>
                <div class="qr-info-item">
                    <div class="qr-info-label"><i class="fas fa-university"></i> বোর্ড</div>
                    <div class="qr-info-value">${escapeHtml(entry.board)}</div>
                </div>
            </div>`;
    }

    /* ---------- Render a single recent scan item ---------- */
    function renderRecentItem(entry) {
        const boardPart = entry.board ? ` · ${escapeHtml(entry.board)}` : '';
        return `
            <li class="qr-recent-item">
                <img src="${escapeHtml(entry.photo_url)}" class="qr-recent-avatar">
                <div class="flex-grow-1 min-w-0">
                    <div class="qr-recent-name text-truncate">${escapeHtml(entry.name_bn || entry.name_en)}</div>
                    <div class="qr-recent-meta">রোল: ${escapeHtml(entry.roll_number)}${boardPart}</div>
                </div>
                <span class="qr-recent-time">${escapeHtml(entry.scanned_at)}</span>
            </li>`;
    }

    /* ---------- Poll the feed ---------- */
    function refreshFeed() {
        fetch('{{ route('admin.qrcode.latest-scans') }}', {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                if (data.latest && data.latest.id !== lastEntryId) {
                    lastEntryId = data.latest.id;
                    renderLastScanned(data.latest);
                    renderLatestQr(data.latest);
                } else if (!data.latest) {
                    lastEntryId = null;
                    renderLastScanned(null);
                    renderLatestQr(null);
                }

                if (recentScansList) {
                    recentScansList.innerHTML = data.recent.length
                        ? data.recent.map(renderRecentItem).join('')
                        : '<li class="text-center text-muted py-5">কোনো তথ্য পাওয়া যায়নি</li>';
                }
            })
            .catch(err => console.error('Failed to refresh scan feed:', err));
    }

    setInterval(refreshFeed, POLL_INTERVAL_MS);
});
</script>
@endpush
