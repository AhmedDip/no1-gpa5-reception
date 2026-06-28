@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Dashboard')

@push('css')
    <style>
        /* ── refined : simpler, more elegant ── */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

        :root {
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --bg-soft: #f6f4fe;
            --glass: rgba(255, 255, 255, 0.65);
            --glass-border: rgba(255, 255, 255, 0.5);
            --shadow-soft: 0 12px 40px -12px rgba(40, 20, 80, 0.12);
            --radius-card: 24px;
            --radius-sm: 14px;
            --color-primary: #4f3b8c;
            --color-primary-light: #7c6bb0;
            --color-text: #1f1a2e;
            --color-muted: #7a6e96;
            --color-border-light: rgba(79, 59, 140, 0.08);
        }

        body {
            font-family: var(--font) !important;
            background: var(--bg-soft) !important;
            color: var(--color-text);
            line-height: 1.5;
        }

        /* ── glassmorphism (gentle) ── */
        .gc {
            background: var(--glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: all 0.25s ease;
        }

        .gc:hover {
            box-shadow: 0 20px 48px -16px rgba(40, 20, 80, 0.18);
            border-color: rgba(255, 255, 255, 0.7);
        }

        /* ── hero (clean, minimal) ── */
        .hero-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.8), rgba(245, 240, 255, 0.6));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(120, 90, 200, 0.06), transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-greeting {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--color-text);
            line-height: 1.2;
        }

        .hero-greeting span {
            color: var(--color-primary);
        }

        .hero-meta {
            font-size: 0.85rem;
            color: var(--color-muted);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-top: 0.25rem;
        }

        .hero-meta i {
            margin-right: 4px;
            font-size: 1rem;
            vertical-align: -1px;
        }

        .btn-hero {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(79, 59, 140, 0.15);
            border-radius: 60px;
            padding: 8px 22px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--color-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            box-shadow: 0 2px 10px rgba(79, 59, 140, 0.06);
        }

        .btn-hero:hover {
            background: #fff;
            border-color: var(--color-primary-light);
            box-shadow: 0 8px 24px rgba(79, 59, 140, 0.12);
            transform: translateY(-1px);
            color: var(--color-primary);
        }

        /* ── stat cards (clean) ── */
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            flex-shrink: 0;
        }

        .si-purple {
            background: linear-gradient(145deg, #8b75c0, #5a4298);
        }

        .si-orange {
            background: linear-gradient(145deg, #eab55a, #ca9430);
        }

        .si-green {
            background: linear-gradient(145deg, #44c9a0, #1e9e7a);
        }

        .si-red {
            background: linear-gradient(145deg, #e6776a, #c34a3c);
        }

        .stat-num {
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--color-text);
            line-height: 1.1;
            margin-top: 0.6rem;
        }

        .stat-lbl {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--color-muted);
            letter-spacing: 0.2px;
            margin-top: 2px;
        }

        .stat-trend {
            font-size: 0.7rem;
            color: var(--color-muted);
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up {
            color: #1e9e7a;
            font-weight: 600;
        }

        .trend-warn {
            color: #b58a2a;
            font-weight: 600;
        }

        .trend-down {
            color: #b54a3c;
            font-weight: 600;
        }

        /* ── badges ── */
        .bdg {
            font-size: 0.6rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 40px;
            letter-spacing: 0.3px;
            background: rgba(79, 59, 140, 0.06);
            color: var(--color-primary-light);
            border: 1px solid rgba(79, 59, 140, 0.08);
        }

        .bdg-orange {
            background: rgba(235, 180, 60, 0.08);
            color: #b58a2a;
            border-color: rgba(235, 180, 60, 0.12);
        }

        .bdg-green {
            background: rgba(50, 200, 150, 0.08);
            color: #1e8a6a;
            border-color: rgba(50, 200, 150, 0.12);
        }

        .bdg-red {
            background: rgba(220, 90, 70, 0.07);
            color: #b54a3c;
            border-color: rgba(220, 90, 70, 0.10);
        }

        /* ── progress (clean) ── */
        .prog-track {
            height: 8px;
            border-radius: 20px;
            background: rgba(79, 59, 140, 0.06);
            overflow: hidden;
            display: flex;
        }

        .prog-seg {
            height: 100%;
            transition: width 0.6s ease;
        }

        .ps-g {
            background: #44c9a0;
        }

        .ps-o {
            background: #eab55a;
        }

        .ps-r {
            background: #e6776a;
        }

        .leg {
            display: flex;
            gap: 1.2rem;
            flex-wrap: wrap;
            margin-top: 0.6rem;
        }

        .leg-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 500;
            color: var(--color-muted);
        }

        .leg-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        /* ── section titles ── */
        .sec-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-text);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
        }

        .sec-title i {
            font-size: 1rem;
            color: var(--color-primary-light);
        }

        /* ── table (refined) ── */
        .tbl-wrap {
            border-collapse: separate;
            border-spacing: 0 6px;
            width: 100%;
        }

        .tbl-wrap thead th {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--color-muted);
            padding: 8px 14px;
            border: 0;
            background: transparent;
        }

        .tbl-wrap tbody tr {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(4px);
            border-radius: 14px;
            transition: all 0.2s ease;
        }

        .tbl-wrap tbody tr:hover {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 6px 20px -8px rgba(40, 20, 80, 0.12);
        }

        .tbl-wrap tbody td {
            border: 0;
            padding: 12px 14px;
            font-size: 0.8rem;
            vertical-align: middle;
            color: var(--color-text);
        }

        .tbl-wrap tbody td:first-child {
            border-radius: 14px 0 0 14px;
        }

        .tbl-wrap tbody td:last-child {
            border-radius: 0 14px 14px 0;
        }

        .td-name-en {
            font-weight: 600;
            font-size: 0.8rem;
        }

        .td-name-bn {
            font-size: 0.65rem;
            color: var(--color-muted);
            margin-top: 1px;
        }

        .gpa-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 30px;
            background: rgba(50, 200, 150, 0.08);
            color: #1e8a6a;
        }

        .st-pill {
            font-size: 0.6rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 30px;
            letter-spacing: 0.2px;
        }

        .st-pending {
            background: rgba(235, 180, 60, 0.08);
            color: #b58a2a;
        }

        .st-approved {
            background: rgba(50, 200, 150, 0.08);
            color: #1e8a6a;
        }

        .st-rejected {
            background: rgba(220, 90, 70, 0.07);
            color: #b54a3c;
        }

        .btn-viewall {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--color-primary-light);
            border: 1px solid rgba(79, 59, 140, 0.12);
            background: rgba(79, 59, 140, 0.02);
            border-radius: 40px;
            padding: 4px 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-viewall:hover {
            background: rgba(79, 59, 140, 0.06);
            border-color: rgba(79, 59, 140, 0.2);
            color: var(--color-primary);
        }

        /* ── charts placeholder ── */
        .chart-box {
            min-height: 220px;
            width: 100%;
        }

        /* ── responsive ── */
        @media (max-width: 576px) {
            .hero-greeting {
                font-size: 1.2rem;
            }

            .stat-num {
                font-size: 1.5rem;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }
        }
    </style>
@endpush

@section('main-content')

    {{-- ═══════════════════════════════════════
         WELCOME HERO
    ═══════════════════════════════════════ --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-card p-4 p-lg-5 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <div class="hero-greeting">স্বাগতম, <span>{{ Auth::user()->name }}</span></div>
                    <div class="hero-meta">
                        <span><i class="bx bx-calendar-alt"></i>{{ now()->translatedFormat('l, d F Y') }}</span>
                        <span class="d-none d-sm-inline" style="color:#d0c8e0;">|</span>
                        <span><i class="bx bx-badge-check"></i>{{ Auth::user()->webMenuGroup->wmng_name ?? 'Admin' }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('home') }}" target="_blank" class="btn-hero">
                        <i class="bx bx-globe"></i> পাবলিক সাইট
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
     STAT CARDS (with centered large icon)
══════════════════════════════════════ --}}
    <div class="row g-3 mb-4">

        {{-- Total --}}
        <div class="col-6 col-lg-3">
            <div class="gc"
                style="position:relative;overflow:hidden;background: linear-gradient(145deg, rgba(255, 255, 255, 0.8), rgba(226, 210, 255, 0.584));padding:16px 20px;min-height:120px;display:flex;flex-direction:column;justify-content:center;">
                <!-- Centered Background Icon - Large -->
                <div
                    style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:10rem; opacity:0.06; pointer-events:none; color:#5a4298; line-height:1;">
                    <i class="bx bx-file"></i>
                </div>
                <div style="position:relative;z-index:1;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="bdg">মোট</span>
                    </div>
                    <div class="stat-num" style="font-size:2.6rem;margin-top:0.2rem;">
                        {{ number_format($totalApplications) }}
                    </div>
                    <div class="stat-lbl">মোট আবেদন</div>
                    <div class="stat-trend" style="margin-top:4px;">
                        <i class="bx bx-trending-up trend-up"></i>
                        <span class="trend-up">সর্বমোট</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="col-6 col-lg-3">
            <div class="gc"
                style="position:relative;overflow:hidden;background: linear-gradient(145deg, rgba(255,255,255,0.8), rgba(255,248,240,0.5));padding:16px 20px;min-height:120px;display:flex;flex-direction:column;justify-content:center;">
                <!-- Centered Background Icon - Large -->
                <div
                    style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:10rem; opacity:0.06; pointer-events:none; color:#ca9430; line-height:1;">
                    <i class="bx bx-time-five"></i>
                </div>
                <div style="position:relative;z-index:1;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="bdg bdg-orange">অপেক্ষমাণ</span>
                    </div>
                    <div class="stat-num" style="font-size:2.6rem;margin-top:0.2rem;">
                        {{ number_format($pendingApplications) }}
                    </div>
                    <div class="stat-lbl">পেন্ডিং আবেদন</div>
                    <div class="stat-trend" style="margin-top:4px;">
                        <i class="bx bx-error-circle trend-warn"></i>
                        <span class="trend-warn">পর্যালোচনা প্রয়োজন</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Approved --}}
        <div class="col-6 col-lg-3">
            <div class="gc"
                style="position:relative;overflow:hidden;background: linear-gradient(145deg, rgba(255,255,255,0.8), rgba(240,255,248,0.5));padding:16px 20px;min-height:120px;display:flex;flex-direction:column;justify-content:center;">
                <!-- Centered Background Icon - Large -->
                <div
                    style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:10rem; opacity:0.06; pointer-events:none; color:#1e9e7a; line-height:1;">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div style="position:relative;z-index:1;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="bdg bdg-green">অনুমোদিত</span>
                    </div>
                    <div class="stat-num" style="font-size:2.6rem;margin-top:0.2rem;">
                        {{ number_format($approvedApplications) }}
                    </div>
                    <div class="stat-lbl">অনুমোদিত আবেদন</div>
                    <div class="stat-trend" style="margin-top:4px;">
                        <i class="bx bx-trending-up trend-up"></i>
                        <span class="trend-up">সফলভাবে প্রক্রিয়াকৃত</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rejected --}}
        <div class="col-6 col-lg-3">
            <div class="gc"
                style="position:relative;overflow:hidden;background: linear-gradient(145deg, rgba(255,255,255,0.8), rgba(255,245,243,0.5));padding:16px 20px;min-height:120px;display:flex;flex-direction:column;justify-content:center;">
                <!-- Centered Background Icon - Large -->
                <div
                    style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:10rem; opacity:0.06; pointer-events:none; color:#c34a3c; line-height:1;">
                    <i class="bx bx-x-circle"></i>
                </div>
                <div style="position:relative;z-index:1;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="bdg bdg-red">প্রত্যাখ্যাত</span>
                    </div>
                    <div class="stat-num" style="font-size:2.6rem;margin-top:0.2rem;">
                        {{ number_format($rejectedApplications) }}
                    </div>
                    <div class="stat-lbl">প্রত্যাখ্যাত আবেদন</div>
                    <div class="stat-trend" style="margin-top:4px;">
                        <i class="bx bx-trending-down trend-down"></i>
                        @if ($totalApplications > 0)
                            <span class="trend-down">{{ round(($rejectedApplications / $totalApplications) * 100) }}%</span>
                            মোটের মধ্যে
                        @else
                            <span>কোনো ডেটা নেই</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- ═══════════════════════════════════════
         PROGRESS SECTION - CHOOSE ONE OPTION
         (Uncomment the one you want to use)
    ═══════════════════════════════════════ --}}


    @if ($totalApplications > 0)
        @php
            $approvedPct = round(($approvedApplications / $totalApplications) * 100);
            $pendingPct = round(($pendingApplications / $totalApplications) * 100);
            $rejectedPct = round(($rejectedApplications / $totalApplications) * 100);
        @endphp
        <div class="row mb-4">
            <div class="col-12">
                <div class="gc p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <h6 class="sec-title"><i class="bx bx-pie-chart-alt"></i> আবেদন অগ্রগতি</h6>
                        <span style="font-size:0.75rem;font-weight:500;color:var(--color-muted);">মোট
                            {{ number_format($totalApplications) }}টি আবেদন</span>
                    </div>
                    <div class="row g-4">
                        <!-- Approved Ring -->
                        <div class="col-4 text-center">
                            <div class="position-relative d-inline-block">
                                <svg width="100" height="100" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#f0edf8"
                                        stroke-width="10" />
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#44c9a0"
                                        stroke-width="10" stroke-dasharray="{{ $approvedPct * 3.14 }} 314"
                                        stroke-dashoffset="0" stroke-linecap="round" transform="rotate(-90 60 60)" />
                                </svg>
                                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                    <div style="font-size:1.3rem;font-weight:700;color:#1f1a2e;">{{ $approvedPct }}%
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:8px;font-weight:600;color:#1e8a6a;font-size:0.85rem;">
                                <i class="bx bx-check-circle" style="vertical-align:-1px;"></i> অনুমোদিত
                            </div>
                            <div style="font-size:0.75rem;color:var(--color-muted);">
                                {{ number_format($approvedApplications) }}টি</div>
                        </div>

                        <!-- Pending Ring -->
                        <div class="col-4 text-center">
                            <div class="position-relative d-inline-block">
                                <svg width="100" height="100" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#f0edf8"
                                        stroke-width="10" />
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#eab55a"
                                        stroke-width="10" stroke-dasharray="{{ $pendingPct * 3.14 }} 314"
                                        stroke-dashoffset="0" stroke-linecap="round" transform="rotate(-90 60 60)" />
                                </svg>
                                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                    <div style="font-size:1.3rem;font-weight:700;color:#1f1a2e;">{{ $pendingPct }}%
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:8px;font-weight:600;color:#b58a2a;font-size:0.85rem;">
                                <i class="bx bx-time-five" style="vertical-align:-1px;"></i> অপেক্ষমাণ
                            </div>
                            <div style="font-size:0.75rem;color:var(--color-muted);">
                                {{ number_format($pendingApplications) }}টি</div>
                        </div>

                        <!-- Rejected Ring -->
                        <div class="col-4 text-center">
                            <div class="position-relative d-inline-block">
                                <svg width="100" height="100" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#f0edf8"
                                        stroke-width="10" />
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#e6776a"
                                        stroke-width="10" stroke-dasharray="{{ $rejectedPct * 3.14 }} 314"
                                        stroke-dashoffset="0" stroke-linecap="round" transform="rotate(-90 60 60)" />
                                </svg>
                                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                    <div style="font-size:1.3rem;font-weight:700;color:#1f1a2e;">{{ $rejectedPct }}%
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:8px;font-weight:600;color:#b54a3c;font-size:0.85rem;">
                                <i class="bx bx-x-circle" style="vertical-align:-1px;"></i> প্রত্যাখ্যাত
                            </div>
                            <div style="font-size:0.75rem;color:var(--color-muted);">
                                {{ number_format($rejectedApplications) }}টি</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif




    {{-- ═══════════════════════════════════════
         CHARTS (elegant)
    ═══════════════════════════════════════ --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="gc p-4 h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bx bx-pie-chart-alt-2 fs-5" style="color:var(--color-primary-light);"></i>
                    <h6 class="sec-title">বোর্ড অনুযায়ী আবেদন</h6>
                </div>
                <div id="boardChart" class="chart-box"></div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="gc p-4 h-100">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bx bx-map fs-5" style="color:#44c9a0;"></i>
                    <h6 class="sec-title">বিভাগ অনুযায়ী আবেদন</h6>
                </div>
                <div id="divisionChart" class="chart-box"></div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         RECENT APPLICATIONS TABLE
    ═══════════════════════════════════════ --}}
    <div class="row">
        <div class="col-12">
            <div class="gc p-0 overflow-hidden">

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 p-4 pb-2">
                    <h6 class="sec-title"><i class="bx bx-list-ul"></i> সাম্প্রতিক আবেদনসমূহ</h6>
                    @can('viewAny', \App\Models\StudentDetail::class)
                        <a href="{{ route('admin.applications.index') }}" class="btn-viewall">
                            সব দেখুন <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    @endcan
                </div>

                <div class="table-responsive px-2 pb-3">
                    <table class="tbl-wrap">
                        <thead>
                            <tr>
                                <th class="ps-3">#</th>
                                <th>শিক্ষার্থীর নাম</th>
                                <th>বোর্ড</th>
                                <th>রোল নম্বর</th>
                                <th>জিপিএ</th>
                                <th>বিভাগ</th>
                                <th>স্ট্যাটাস</th>
                                <th>তারিখ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications as $i => $app)
                                @php
                                    $statusMap = [
                                        1 => ['label' => 'অপেক্ষমাণ', 'class' => 'st-pending'],
                                        2 => ['label' => 'অনুমোদিত', 'class' => 'st-approved'],
                                        3 => ['label' => 'প্রত্যাখ্যাত', 'class' => 'st-rejected'],
                                    ];
                                    $st = $statusMap[$app->application_status_id] ?? [
                                        'label' => $app->applicationStatus->name ?? 'N/A',
                                        'class' => 'st-pending',
                                    ];
                                @endphp
                                <tr>
                                    <td class="ps-3" style="color:var(--color-muted);font-weight:600;font-size:0.7rem;">
                                        {{ $i + 1 }}</td>
                                    <td>
                                        <div class="td-name-en">{{ $app->name_en }}</div>
                                        <div class="td-name-bn">{{ $app->name_bn }}</div>
                                    </td>
                                    <td style="font-weight:500;color:var(--color-text);">{{ $app->board->name_bn ?? '—' }}
                                    </td>
                                    <td style="font-family:monospace;font-size:0.75rem;color:var(--color-muted);">
                                        {{ $app->roll_number }}</td>
                                    <td><span class="gpa-badge">{{ $app->gpa_result }}</span></td>
                                    <td style="color:var(--color-muted);">{{ $app->division->name_bn ?? '—' }}</td>
                                    <td><span class="st-pill {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                                    <td style="font-size:0.7rem;color:var(--color-muted);">
                                        {{ $app->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5" style="color:var(--color-muted);">
                                        <i class="bx bx-inbox"
                                            style="font-size:2rem;display:block;margin-bottom:0.4rem;opacity:0.4;"></i>
                                        কোনো আবেদন পাওয়া যায়নি
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ── BOARD Donut ── */
            const boardData = @json($applicationsByBoard);
            const boardNames = Object.keys(boardData);
            const boardVals = Object.values(boardData);

            if (boardNames.length) {
                new ApexCharts(document.querySelector('#boardChart'), {
                    chart: {
                        type: 'donut',
                        height: 240,
                        fontFamily: "'Inter', sans-serif",
                        toolbar: {
                            show: false
                        },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 650
                        }
                    },
                    series: boardVals,
                    labels: boardNames,
                    colors: ['#7c6bb0', '#44c9a2', '#5fc3d4', '#eab55a', '#e6776a', '#b59ad0', '#9aa6b5'],
                    legend: {
                        position: 'bottom',
                        fontSize: '10px',
                        fontFamily: "'Inter', sans-serif",
                        fontWeight: 500,
                        markers: {
                            radius: 6,
                            width: 10,
                            height: 10
                        },
                        itemMargin: {
                            horizontal: 8,
                            vertical: 3
                        },
                        labels: {
                            colors: '#5a4e7a'
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        color: '#7a6e96',
                                        offsetY: -4
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '20px',
                                        fontWeight: 700,
                                        color: '#1f1a2e',
                                        offsetY: 6,
                                        formatter: v => Number(v).toLocaleString()
                                    },
                                    total: {
                                        show: true,
                                        label: 'মোট',
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        color: '#7a6e96',
                                        formatter: w => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                            .toLocaleString()
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        colors: ['rgba(255,255,255,0.6)']
                    },
                    tooltip: {
                        theme: 'light',
                        y: {
                            formatter: v => v.toLocaleString() + ' টি'
                        }
                    }
                }).render();
            } else {
                document.querySelector('#boardChart').innerHTML =
                    '<div style="text-align:center;color:#9a8abc;padding:2rem 0;">কোনো ডেটা নেই</div>';
            }

            /* ── DIVISION Bar ── */
            const divData = @json($applicationsByDivision);
            const divNames = Object.keys(divData);
            const divVals = Object.values(divData);

            if (divNames.length) {
                new ApexCharts(document.querySelector('#divisionChart'), {
                    chart: {
                        type: 'bar',
                        height: 240,
                        fontFamily: "'Inter', sans-serif",
                        toolbar: {
                            show: false
                        },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 600
                        }
                    },
                    series: [{
                        name: 'আবেদন',
                        data: divVals
                    }],
                    xaxis: {
                        categories: divNames,
                        labels: {
                            style: {
                                fontSize: '10px',
                                fontWeight: 500,
                                colors: '#7a6e96'
                            },
                            rotate: -25,
                            trim: true
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: v => Math.floor(v).toLocaleString(),
                            style: {
                                fontSize: '10px',
                                colors: '#9a8abc'
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            gradientToColors: ['#5a4298'],
                            stops: [0, 100]
                        }
                    },
                    colors: ['#8b75c0'],
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            columnWidth: '46%',
                            borderRadiusApplication: 'end'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: v => v.toLocaleString(),
                        style: {
                            fontSize: '10px',
                            fontWeight: 600,
                            colors: ['#1f1a2e']
                        },
                        offsetY: -6
                    },
                    grid: {
                        borderColor: 'rgba(79, 59, 140, 0.04)',
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: false
                            }
                        }
                    },
                    tooltip: {
                        theme: 'light',
                        y: {
                            formatter: v => v.toLocaleString() + ' টি আবেদন'
                        }
                    }
                }).render();
            } else {
                document.querySelector('#divisionChart').innerHTML =
                    '<div style="text-align:center;color:#9a8abc;padding:2rem 0;">কোনো ডেটা নেই</div>';
            }

        });
    </script> --}}
@endpush
