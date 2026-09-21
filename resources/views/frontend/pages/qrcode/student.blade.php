{{-- resources/views/frontend/pages/qrcode/student.blade.php --}}

@extends('frontend.layouts.default')

@section('title', $user ? 'QR কোড - ' . ($user->studentDetail->name_bn ?? $user->name) : 'Invalid QR Code')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --qr-primary: #8a4547;
        --qr-primary-dark: #5e2628;
        --qr-accent: #d4a24a;
        --qr-accent-dark: #b8862f;
        --qr-success: #1e9e6f;
        --qr-success-dark: #0f6e4c;
        --qr-ink: #1c1414;
        --qr-muted: #8a7d7d;
        --qr-line: #f0e6e6;
        --qr-surface: #ffffff;
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

    /* ===================== PAGE BAR ===================== */
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

    .qr-status-pill--invalid {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #fdecec 0%, #fadada 100%);
        border: 1px solid rgba(200, 57, 59, 0.22);
        color: #9c2224;
        border-radius: 50px;
        padding: 7px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        box-shadow: 0 6px 16px -8px rgba(200, 57, 59, 0.5);
        white-space: nowrap;
    }

    /* ===================== CARD ===================== */
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
        animation: qrCardIn 0.65s cubic-bezier(.2,.9,.3,1.1) both;
    }

    @keyframes qrCardIn {
        from { opacity: 0; transform: translateY(18px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .qr-card:hover {
        box-shadow: var(--qr-shadow-lg);
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

    /* ---- Header variants ---- */
    .qr-card-header--gold {
        background: linear-gradient(135deg, #fffaf0 0%, #fdf3dd 100%);
        border-bottom-color: #f3e4c4;
    }
    .qr-card-header--gold h6 .qr-hicon {
        background: linear-gradient(135deg, var(--qr-accent) 0%, var(--qr-accent-dark) 100%);
        color: #fff;
        box-shadow: 0 6px 14px -6px rgba(212, 162, 74, 0.7);
    }

    .qr-card-header--red {
        background: linear-gradient(135deg, #fdecec 0%, #fadada 100%);
        border-bottom-color: #f5c6c6;
    }
    .qr-card-header--red h6 .qr-hicon {
        background: linear-gradient(135deg, #c8393b 0%, #9c2224 100%);
        color: #fff;
        box-shadow: 0 6px 14px -6px rgba(200, 57, 59, 0.7);
    }

    /* ===================== BODY ===================== */
    .qr-card-body {
        padding: 1.75rem 1.5rem;
        text-align: center;
        flex: 1;
    }

    /* ===================== PRINT HEADER (hidden on screen) ===================== */
    .qr-print-header {
        display: none;
        text-align: center;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 2px dashed #d4a24a;
    }

    .qr-print-header-logo {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--qr-primary-dark);
        margin-bottom: 0.15rem;
        letter-spacing: -0.01em;
    }

    .qr-print-header-sub {
        font-size: 0.78rem;
        color: var(--qr-muted);
        font-weight: 600;
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
        animation: qrFrameIn 0.6s cubic-bezier(.2,.9,.3,1.2) 0.1s both;
        margin-bottom: 1rem;
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

    .qr-image-frame img {
        display: block;
        max-width: 220px;
        width: 100%;
        border-radius: 8px;
    }

    /* ===================== NAME BLOCK ===================== */
    .qr-qr-name-bn {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--qr-ink);
        margin-bottom: 0.15rem;
        letter-spacing: -0.01em;
        line-height: 1.3;
    }

    .qr-qr-name-en {
        font-size: 0.88rem;
        color: var(--qr-muted);
        font-weight: 500;
        margin-bottom: 0.35rem;
    }

    .qr-qr-roll {
        font-size: 0.82rem;
        color: var(--qr-muted);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    /* ===================== VERIFIED BADGE ===================== */
    .qr-verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #e9faf1 0%, #d6f3e5 100%);
        color: var(--qr-success-dark);
        border: 1px solid rgba(30, 158, 111, 0.2);
        border-radius: 50px;
        padding: 7px 18px;
        font-weight: 700;
        font-size: 0.82rem;
        box-shadow: 0 6px 16px -8px rgba(30, 158, 111, 0.5);
        margin-bottom: 1.25rem;
    }

    .qr-verified-badge i {
        animation: qrCheckPop 0.6s cubic-bezier(.2,.9,.3,1.5) 0.4s both;
    }

    @keyframes qrCheckPop {
        from { transform: scale(0) rotate(-30deg); }
        to   { transform: scale(1) rotate(0); }
    }

    /* ===================== INFO GRID ===================== */
    .qr-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.55rem 0.75rem;
        text-align: left;
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

    .qr-info-item--full {
        grid-column: 1 / -1;
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

    /* ===================== SECTION LABEL ===================== */
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
        background: linear-gradient(90deg, #f0dada 0%, transparent 100%);
    }

    /* ===================== HINT ===================== */
    .qr-hint {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.7rem 1.15rem;
        background: linear-gradient(135deg, #fffaf0 0%, #fdf3dd 100%);
        border: 1px solid #f3e4c4;
        border-radius: 14px;
        color: #7a5a1a;
        font-size: 0.82rem;
        font-weight: 600;
        line-height: 1.4;
        margin-top: 1.35rem;
        max-width: 100%;
    }

    .qr-hint i {
        color: var(--qr-accent-dark);
        flex-shrink: 0;
    }

    /* ===================== ACTIONS ===================== */
    .qr-actions {
        display: flex;
        gap: 0.6rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px solid #f0e6e6;
    }

    .qr-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.7rem 1.4rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid transparent;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        text-decoration: none;
        letter-spacing: 0.1px;
    }

    .qr-btn:hover { transform: translateY(-2px); color: inherit; }
    .qr-btn:active { transform: translateY(0); }

    .qr-btn-primary {
        background: linear-gradient(135deg, var(--qr-primary) 0%, var(--qr-primary-dark) 100%);
        color: #fff;
        box-shadow: 0 10px 22px -10px rgba(138, 69, 71, 0.65);
    }
    .qr-btn-primary:hover {
        color: #fff;
        box-shadow: 0 14px 28px -10px rgba(138, 69, 71, 0.75);
    }

    .qr-btn-ghost {
        background: #fff;
        color: var(--qr-ink);
        border-color: #e8dcdc;
        box-shadow: 0 4px 12px -6px rgba(40, 10, 10, 0.15);
    }
    .qr-btn-ghost:hover {
        color: var(--qr-primary);
        border-color: rgba(138, 69, 71, 0.35);
        background: #fdf9f9;
    }

    /* ===================== INVALID STATE ===================== */
    .qr-invalid-body {
        padding: 2.75rem 1.75rem 2.5rem;
        text-align: center;
    }

    .qr-invalid-icon {
        width: 92px;
        height: 92px;
        border-radius: 26px;
        background: linear-gradient(135deg, #fdecec 0%, #fadada 100%);
        border: 1px solid rgba(200, 57, 59, 0.18);
        color: #c8393b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 1.35rem;
        box-shadow: 0 14px 34px -14px rgba(200, 57, 59, 0.5);
        animation: qrInvalidIcon 0.7s cubic-bezier(.2,.9,.3,1.3) both;
    }

    @keyframes qrInvalidIcon {
        from { opacity: 0; transform: scale(0.6) rotate(-8deg); }
        to   { opacity: 1; transform: scale(1) rotate(0); }
    }

    .qr-invalid-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #9c2224;
        letter-spacing: -0.01em;
        margin-bottom: 0.5rem;
    }

    .qr-invalid-desc {
        color: var(--qr-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        max-width: 380px;
        margin: 0 auto 1.5rem;
    }

    /* ===================== PRINT-ONLY CUT MARK ===================== */
    .qr-print-cutline {
        display: none;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px dashed #c8b8a0;
        text-align: center;
        color: var(--qr-muted);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.4px;
    }

    .qr-print-cutline i {
        margin-right: 4px;
        color: var(--qr-accent-dark);
    }

    /* ============================================================
       ================  PRINT STYLES (A4 / portrait)  ============
       ============================================================ */
    @media print {
        /* Page setup */
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        /* Base reset */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        html, body {
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 12pt;
            width: 100%;
        }

        /* Hide everything that isn't the printable card */
        .qr-page-bar,
        .qr-actions,
        .qr-hint,
        .qr-quick-links,
        .qr-confetti,
        .qr-page-bg > .container > .row > .col-lg-4,
        .qr-page-bg > .container > .row > .col-lg-4 * {
            display: none !important;
        }

        /* Remove page background gradients */
        .qr-page-bg {
            background: #ffffff !important;
            padding: 0 !important;
            min-height: auto !important;
        }

        .qr-page-bg > .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .row { margin: 0 !important; }

        /* Card = the printable sheet */
        .qr-card {
            box-shadow: none !important;
            border: 2px solid #8a4547 !important;
            border-radius: 18px !important;
            overflow: visible !important;
            page-break-inside: avoid !important;
            animation: none !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 auto !important;
            background: #ffffff !important;
        }

        .qr-card:hover {
            transform: none !important;
            box-shadow: none !important;
        }

        .qr-card-header {
            background: linear-gradient(135deg, #fdf3dd 0%, #f5e3bd 100%) !important;
            border-bottom: 2px solid #d4a24a !important;
            padding: 12pt 16pt !important;
            border-radius: 16px 16px 0 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        .qr-card-header h6 {
            font-size: 13pt !important;
            color: #1c1414 !important;
        }

        .qr-card-header .qr-live-pill {
            display: inline-flex !important;
            font-size: 9pt !important;
            padding: 3pt 10pt !important;
            background: #ffffff !important;
            border: 1px solid #d4a24a !important;
            color: #7a5a1a !important;
            box-shadow: none !important;
        }

        .qr-card-body {
            padding: 18pt 20pt 22pt !important;
            display: block !important;
        }

        /* Show print header */
        .qr-print-header { display: block !important; }

        .qr-print-header-logo {
            font-size: 15pt !important;
            color: #5e2628 !important;
        }

        .qr-print-header-sub {
            font-size: 9pt !important;
            color: #8a7d7d !important;
        }

        /* QR frame — solid, no fancy shadows for clean print */
        .qr-image-frame {
            box-shadow: none !important;
            border: 3px solid #d4a24a !important;
            padding: 10pt !important;
            background: #ffffff !important;
            border-radius: 14px !important;
            margin: 4pt auto 10pt !important;
        }

        .qr-image-frame::after { display: none !important; }

        .qr-image-frame img {
            max-width: 160pt !important;
            width: 160pt !important;
            display: block !important;
            margin: 0 auto !important;
        }

        /* Names & roll */
        .qr-qr-name-bn {
            font-size: 14pt !important;
            color: #1c1414 !important;
            margin-bottom: 2pt !important;
        }
        .qr-qr-name-en {
            font-size: 11pt !important;
            color: #6a5d5d !important;
            margin-bottom: 3pt !important;
        }
        .qr-qr-roll {
            font-size: 10pt !important;
            color: #6a5d5d !important;
            margin-bottom: 8pt !important;
        }

        /* Verified badge — clean pill, printable */
        .qr-verified-badge {
            box-shadow: none !important;
            border: 1.5px solid #1e9e6f !important;
            background: #e9faf1 !important;
            color: #0f6e4c !important;
            font-size: 10pt !important;
            padding: 5pt 14pt !important;
            margin: 0 auto 12pt !important;
        }

        /* Info grid — two columns, clean borders */
        .qr-info-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 6pt !important;
            margin-bottom: 10pt !important;
        }

        .qr-info-item {
            background: #faf7f7 !important;
            border: 1px solid #e8dcdc !important;
            padding: 7pt 10pt !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transform: none !important;
            page-break-inside: avoid !important;
        }

        .qr-info-item .qr-info-label {
            font-size: 8pt !important;
            color: #8a7d7d !important;
            letter-spacing: 0.3px !important;
        }

        .qr-info-item .qr-info-label i { color: #8a4547 !important; }

        .qr-info-item .qr-info-value {
            font-size: 11pt !important;
            color: #1c1414 !important;
        }

        /* Section labels */
        .qr-section-label {
            font-size: 9pt !important;
            color: #8a4547 !important;
            margin: 10pt 0 6pt !important;
            page-break-after: avoid !important;
        }

        .qr-section-label i { color: #b8862f !important; }

        .qr-section-label::after {
            background: linear-gradient(90deg, #d4a24a 0%, transparent 100%) !important;
        }

        /* Show cut line / footer at bottom */
        .qr-print-cutline { display: block !important; }

        /* Prevent any link styling from breaking print */
        a { color: inherit !important; text-decoration: none !important; }

        /* Ensure no page breaks inside key blocks */
        .qr-card, .qr-card-body, .qr-image-frame,
        .qr-info-grid, .qr-info-item, .qr-section-label {
            page-break-inside: avoid !important;
        }

        /* Force single page */
        .qr-page-bg, .container, .row, .col-lg-5, .col-md-7 {
            page-break-after: avoid !important;
            page-break-before: avoid !important;
        }
    }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 767px) {
        .qr-info-grid { grid-template-columns: 1fr; }
        .qr-image-frame img { max-width: 200px; }
        .qr-qr-name-bn { font-size: 1.05rem; }
        .qr-page-bar { padding: 0.75rem 1rem; }
        .qr-page-bar-title h1 { font-size: 1.02rem; }
    }
</style>
@endpush

@section('content')
<div class="qr-page-bg">
    <div class="container">

        @if ($user)
            <!-- Page Bar (hidden on print) -->
            <div class="qr-page-bar">
                <div class="qr-page-bar-title">
                    <span class="qr-page-bar-icon"><i class="fas fa-qrcode"></i></span>
                    <div>
                        <h1>শিক্ষার্থীর প্রবেশ QR কোড</h1>
                        <p>সংবর্ধনায় প্রবেশের জন্য আপনার ব্যক্তিগত QR কোড</p>
                    </div>
                </div>
                <span class="qr-live-pill">
                    <i class="fas fa-check-circle"></i> অনুমোদিত
                </span>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="qr-card" id="printableCard">

                        <!-- Print-only header -->
                        <div class="qr-print-header">
                            <div class="qr-print-header-logo">সংবর্ধনা ২০২৫</div>
                            <div class="qr-print-header-sub">শিক্ষার্থীর প্রবেশ QR কোড</div>
                        </div>

                        <!-- Header -->
                        <div class="qr-card-header qr-card-header--gold">
                            <h6>
                                <span class="qr-hicon"><i class="fas fa-qrcode"></i></span>
                                শিক্ষার্থীর QR কোড
                            </h6>
                            <span class="qr-live-pill" style="padding: 4px 12px; font-size: 0.7rem;">
                                <i class="fas fa-id-card"></i> {{ $user->studentDetail->roll_number ?? '—' }}
                            </span>
                        </div>

                        <!-- Body -->
                        <div class="qr-card-body">

                            <div class="qr-image-frame">
                                <img src="{{ $qrDataUri }}" alt="QR Code">
                            </div>

                            <div class="qr-qr-name-bn">
                                {{ $user->studentDetail->name_bn ?? $user->name }}
                            </div>
                            <div class="qr-qr-name-en">
                                {{ $user->studentDetail->name_en ?? '' }}
                            </div>
                            <div class="qr-qr-roll">
                                রোল: {{ $user->studentDetail->roll_number ?? '—' }}
                            </div>

                            <div class="qr-verified-badge">
                                <i class="fas fa-check-circle"></i> যাচাইকৃত শিক্ষার্থী
                            </div>

                            <!-- Academic Info -->
                            <div class="qr-section-label">
                                <i class="fas fa-graduation-cap"></i> একাডেমিক তথ্য
                            </div>
                            <div class="qr-info-grid">
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-hashtag"></i> রোল নম্বর</div>
                                    <div class="qr-info-value">{{ $user->studentDetail->roll_number ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-id-card"></i> রেজিস্ট্রেশন</div>
                                    <div class="qr-info-value">{{ $user->studentDetail->registration_number ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-star"></i> জিপিএ</div>
                                    <div class="qr-info-value text-success">{{ $user->studentDetail->gpa_result ?? '—' }}</div>
                                </div>
                                <div class="qr-info-item">
                                    <div class="qr-info-label"><i class="fas fa-university"></i> বোর্ড</div>
                                    <div class="qr-info-value">
                                        {{ $user->studentDetail->board->name_bn ?? $user->studentDetail->board->name ?? '—' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="qr-section-label">
                                <i class="fas fa-phone"></i> যোগাযোগ
                            </div>
                            <div class="qr-info-grid">
                                <div class="qr-info-item qr-info-item--full">
                                    <div class="qr-info-label"><i class="fas fa-mobile-alt"></i> মোবাইল</div>
                                    <div class="qr-info-value">{{ $user->mobile ?? '—' }}</div>
                                </div>
                            </div>

                            <!-- Hint -->
                            <div class="qr-hint">
                                <i class="fas fa-info-circle"></i>
                                এই QR কোডটি স্ক্যান করলে প্রবেশ নিশ্চিত হবে।
                            </div>

                            <!-- Actions (hidden on print) -->
                            <div class="qr-actions">
                                <button type="button" onclick="printQrCard()" class="qr-btn qr-btn-primary">
                                    <i class="fas fa-print"></i> প্রিন্ট করুন
                                </button>
                                <a href="{{ url()->previous() }}" class="qr-btn qr-btn-ghost">
                                    <i class="fas fa-arrow-left"></i> ফিরে যান
                                </a>
                            </div>

                            <!-- Print-only footer/cut-line -->
                            <div class="qr-print-cutline">
                                <i class="fas fa-scissors"></i>
                                সংবর্ধনা ২০২৫ · শিক্ষার্থীর প্রবেশ QR কোড · এই QR কোডটি প্রবেশের সময় দেখান
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- Invalid State -->
            <div class="qr-page-bar">
                <div class="qr-page-bar-title">
                    <span class="qr-page-bar-icon" style="background: linear-gradient(135deg, #c8393b 0%, #9c2224 100%);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div>
                        <h1>অবৈধ QR কোড</h1>
                        <p>যাচাইকরণ ব্যর্থ হয়েছে</p>
                    </div>
                </div>
                <span class="qr-status-pill--invalid">
                    <i class="fas fa-times-circle"></i> অনুমোদিত নয়
                </span>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="qr-card">
                        <div class="qr-card-header qr-card-header--red">
                            <h6>
                                <span class="qr-hicon"><i class="fas fa-times-circle"></i></span>
                                যাচাইকরণ ব্যর্থ
                            </h6>
                        </div>
                        <div class="qr-invalid-body">
                            <span class="qr-invalid-icon"><i class="fas fa-times-circle"></i></span>
                            <h4 class="qr-invalid-title">Invalid or Unregistered QR Code</h4>
                            <p class="qr-invalid-desc">
                                এই মোবাইল নম্বরে কোনো নিবন্ধিত অনুমোদিত শিক্ষার্থী পাওয়া যায়নি। অনুগ্রহ করে সঠিক QR কোড ব্যবহার করুন অথবা আয়োজক টিমের সাথে যোগাযোগ করুন।
                            </p>

                            <div class="qr-actions" style="border-top: none; padding-top: 0;">
                                <a href="{{ url('/') }}" class="qr-btn qr-btn-primary">
                                    <i class="fas fa-home"></i> হোমে ফিরে যান
                                </a>
                                @guest
                                    <a href="{{ route('student.login') }}" class="qr-btn qr-btn-ghost">
                                        <i class="fas fa-sign-in-alt"></i> লগইন করুন
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
/**
 * Print the QR card in a dedicated, isolated print window.
 * This avoids inheriting the site's outer layout/scripts and guarantees
 * a clean A4 portrait output with the card centered.
 */
function printQrCard() {
    const card = document.getElementById('printableCard');
    if (!card) {
        window.print();
        return;
    }

    // Collect all <style> and <link rel="stylesheet"> tags from the parent document
    // so the print window inherits the same card styling.
    const styles = Array.from(document.querySelectorAll('style, link[rel="stylesheet"]'))
        .map(node => node.outerHTML)
        .join('\n');

    const printWindow = window.open('', '_blank', 'width=800,height=900');
    if (!printWindow) {
        // Popup blocked → fallback to native print
        window.print();
        return;
    }

    printWindow.document.open();
    printWindow.document.write(`
        <!DOCTYPE html>
        <html lang="bn">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>QR কোড প্রিন্ট</title>
            ${styles}
            <style>
                /* Belt-and-suspenders reset for the print window */
                html, body {
                    margin: 0;
                    padding: 0;
                    background: #ffffff;
                }
                body {
                    display: flex;
                    align-items: flex-start;
                    justify-content: center;
                    min-height: 100vh;
                    padding: 8mm;
                    font-family: 'Hind Siliguri', 'Plus Jakarta Sans', sans-serif;
                }
                /* Force the card to look printable */
                .qr-page-bg, .qr-page-bar, .qr-actions, .qr-hint { display: none !important; }
                .qr-card {
                    box-shadow: none !important;
                    max-width: 100% !important;
                    width: 100% !important;
                    margin: 0 auto !important;
                    animation: none !important;
                }
                .qr-image-frame::after { display: none !important; }
            </style>
        </head>
        <body>
            ${card.outerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();

    // Wait for images (QR code, avatars) to load before printing
    const waitForImages = () => {
        const imgs = printWindow.document.images;
        let loaded = 0;
        if (imgs.length === 0) return Promise.resolve();

        return new Promise(resolve => {
            const checkDone = () => {
                loaded++;
                if (loaded === imgs.length) resolve();
            };
            for (const img of imgs) {
                if (img.complete) checkDone();
                else {
                    img.addEventListener('load', checkDone);
                    img.addEventListener('error', checkDone);
                }
            }
        });
    };

    waitForImages().then(() => {
        setTimeout(() => {
            printWindow.focus();
            printWindow.print();
            // Close after print dialog is dismissed (best-effort)
            setTimeout(() => printWindow.close(), 500);
        }, 250);
    });
}
</script>
@endpush
