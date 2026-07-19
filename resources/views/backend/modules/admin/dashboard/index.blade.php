@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Dashboard')

@push('css')
    <style>
        /* Stats Card Animations */
        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(200%) rotate(45deg); }
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none !important;
            border-radius: 20px !important;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08) !important;
        }

        .stat-card:hover .stat-icon-wrapper > div {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .stat-card .stat-icon-wrapper > div {
            transition: transform 0.3s ease;
        }

        .stat-card .badge {
            transition: all 0.2s ease;
        }

        .stat-card:hover .badge {
            transform: scale(1.02);
        }

        .stat-card .progress-bar-animated {
            transition: width 1.5s ease-in-out;
        }

        /* Chart Styles */
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 280px;
        }

        .chart-container .apexcharts-canvas {
            margin: 0 auto;
        }

        /* Table Styles */
        .td-name-en {
            font-weight: 600;
            font-size: 0.8rem;
        }

        .td-name-bn {
            font-size: 0.65rem;
            color: #7a6e96;
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
            color: #7c6bb0;
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
            color: #4f3b8c;
        }

        .hero-greeting {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #1f1a2e;
            line-height: 1.2;
        }

        .hero-greeting span {
            color: #4f3b8c;
        }

        .hero-meta {
            font-size: 0.85rem;
            color: #7a6e96;
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
            color: #4f3b8c;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            box-shadow: 0 2px 10px rgba(79, 59, 140, 0.06);
        }

        .btn-hero:hover {
            background: #fff;
            border-color: #7c6bb0;
            box-shadow: 0 8px 24px rgba(79, 59, 140, 0.12);
            transform: translateY(-1px);
            color: #4f3b8c;
        }

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
            color: #7a6e96;
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
            color: #1f1a2e;
        }

        .tbl-wrap tbody td:first-child {
            border-radius: 14px 0 0 14px;
        }

        .tbl-wrap tbody td:last-child {
            border-radius: 0 14px 14px 0;
        }

        /* Progress Ring Styles */
        .progress-ring {
            transition: all 0.3s ease;
        }

        .progress-ring:hover {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .hero-greeting {
                font-size: 1.2rem;
            }

            .stat-card .card-body {
                padding: 1.25rem !important;
            }

            .stat-card h2 {
                font-size: 1.6rem !important;
            }

            .stat-icon-wrapper > div {
                width: 44px !important;
                height: 44px !important;
            }

            .stat-icon-wrapper > div i {
                font-size: 1.4rem !important;
            }
        }
    </style>
@endpush

@section('main-content')
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <div class="hero-greeting">স্বাগতম, <span>{{ Auth::user()->name }}</span></div>
                        <div class="hero-meta">
                            <span><i class="bx bx-calendar-alt"></i>{{ now()->translatedFormat('l, d F Y') }}</span>
                            <span class="d-none d-sm-inline" style="color:#d0c8e0;">|</span>
                            <span><i class="bx bx-badge-check"></i>{{ Auth::user()?->userType?->name ?? 'Admin' }}</span>
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
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        @php
            $stats = [
                [
                    'label' => 'মোট আবেদন',
                    'value' => $totalApplications,
                    'icon' => 'bx-file',
                    'color' => 'purple',
                    'trend' => $totalApplications > 0 ? '100% মোটের মধ্যে' : 'কোনো ডেটা নেই',
                    'trendClass' => 'text-success',
                    'bgGradient' => 'linear-gradient(135deg, #8b75c0 0%, #5a4298 100%)',
                    'shadowColor' => 'rgba(90, 66, 152, 0.15)',
                    'iconBg' => 'rgba(255, 255, 255, 0.2)'
                ],
                [
                    'label' => 'পেন্ডিং আবেদন',
                    'value' => $pendingApplications,
                    'icon' => 'bx-time-five',
                    'color' => 'orange',
                    'trend' => $totalApplications > 0 ? round(($pendingApplications / $totalApplications) * 100) . '% মোটের মধ্যে' : 'কোনো ডেটা নেই',
                    'trendClass' => 'text-warning',
                    'bgGradient' => 'linear-gradient(135deg, #eab55a 0%, #ca9430 100%)',
                    'shadowColor' => 'rgba(202, 148, 48, 0.15)',
                    'iconBg' => 'rgba(255, 255, 255, 0.2)'
                ],
                [
                    'label' => 'অনুমোদিত আবেদন',
                    'value' => $approvedApplications,
                    'icon' => 'bx-check-circle',
                    'color' => 'green',
                    'trend' => $totalApplications > 0 ? round(($approvedApplications / $totalApplications) * 100) . '% মোটের মধ্যে' : 'কোনো ডেটা নেই',
                    'trendClass' => 'text-success',
                    'bgGradient' => 'linear-gradient(135deg, #44c9a0 0%, #1e9e7a 100%)',
                    'shadowColor' => 'rgba(30, 158, 122, 0.15)',
                    'iconBg' => 'rgba(255, 255, 255, 0.2)'
                ],
                [
                    'label' => 'প্রত্যাখ্যাত আবেদন',
                    'value' => $rejectedApplications,
                    'icon' => 'bx-x-circle',
                    'color' => 'red',
                    'trend' => $totalApplications > 0 ? round(($rejectedApplications / $totalApplications) * 100) . '% মোটের মধ্যে' : 'কোনো ডেটা নেই',
                    'trendClass' => 'text-danger',
                    'bgGradient' => 'linear-gradient(135deg, #e6776a 0%, #c34a3c 100%)',
                    'shadowColor' => 'rgba(195, 74, 60, 0.15)',
                    'iconBg' => 'rgba(255, 255, 255, 0.2)'
                ],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-6 col-lg-3">
                <div class="card stat-card h-100" style="background: #ffffff; box-shadow: 0 4px 20px {{ $stat['shadowColor'] }};">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="flex-grow-1 me-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge" style="background: {{ $stat['bgGradient'] }}; color: white; padding: 4px 12px; border-radius: 50px; font-size: 0.6rem; font-weight: 600; letter-spacing: 0.3px; text-transform: uppercase;">
                                        {{ $stat['label'] }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-baseline gap-2">
                                    <h2 class="mb-0" style="font-size: 2.2rem; font-weight: 700; color: #1f1a2e; line-height: 1.2; letter-spacing: -0.02em;">
                                        {{ number_format($stat['value']) }}
                                    </h2>
                                    <span class="text-muted" style="font-size: 0.75rem; font-weight: 500;">টি</span>
                                </div>

                                <div class="mt-2 d-flex align-items-center gap-2">
                                    <span class="badge {{ $stat['trendClass'] }}" style="background: {{ $stat['trendClass'] == 'text-success' ? 'rgba(30, 158, 122, 0.1)' : ($stat['trendClass'] == 'text-warning' ? 'rgba(202, 148, 48, 0.1)' : 'rgba(195, 74, 60, 0.1)') }}; color: {{ $stat['trendClass'] == 'text-success' ? '#1e9e7a' : ($stat['trendClass'] == 'text-warning' ? '#b58a2a' : '#b54a3c') }}; border-radius: 50px; padding: 4px 10px; font-size: 0.6rem; font-weight: 600;">
                                        <i class="bx bx-trending-up"></i> {{ $stat['trend'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="stat-icon-wrapper" style="position: relative; flex-shrink: 0;">
                                <div style="width: 56px; height: 56px; border-radius: 16px; background: {{ $stat['bgGradient'] }}; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px {{ $stat['shadowColor'] }}; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: -50%; right: -50%; width: 100%; height: 100%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent); transform: rotate(45deg); animation: shine 3s infinite;"></div>
                                    <i class="bx {{ $stat['icon'] }}" style="font-size: 1.8rem; color: white; position: relative; z-index: 1;"></i>
                                </div>
                                <div style="position: absolute; top: -4px; right: -4px; width: 64px; height: 64px; border-radius: 20px; border: 2px solid {{ $stat['shadowColor'] }}; opacity: 0.3; pointer-events: none;"></div>
                            </div>
                        </div>

                        <div class="mt-3" style="height: 3px; background: #f0edf8; border-radius: 10px; overflow: hidden;">
                            <div class="progress-bar-animated" style="height: 100%; width: {{ $totalApplications > 0 ? round(($stat['value'] / $totalApplications) * 100) : 0 }}%; background: {{ $stat['bgGradient'] }}; border-radius: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Progress Rings -->
    @if($totalApplications > 0)
        @php
            $approvedPct = round(($approvedApplications / $totalApplications) * 100);
            $pendingPct = round(($pendingApplications / $totalApplications) * 100);
            $rejectedPct = round(($rejectedApplications / $totalApplications) * 100);
            $rings = [
                ['pct' => $approvedPct, 'color' => '#44c9a0', 'label' => 'অনুমোদিত', 'icon' => 'bx-check-circle', 'count' => $approvedApplications, 'textColor' => '#1e8a6a', 'bgGradient' => 'linear-gradient(135deg, #44c9a0 0%, #1e9e7a 100%)'],
                ['pct' => $pendingPct, 'color' => '#eab55a', 'label' => 'অপেক্ষমাণ', 'icon' => 'bx-time-five', 'count' => $pendingApplications, 'textColor' => '#b58a2a', 'bgGradient' => 'linear-gradient(135deg, #eab55a 0%, #ca9430 100%)'],
                ['pct' => $rejectedPct, 'color' => '#e6776a', 'label' => 'প্রত্যাখ্যাত', 'icon' => 'bx-x-circle', 'count' => $rejectedApplications, 'textColor' => '#b54a3c', 'bgGradient' => 'linear-gradient(135deg, #e6776a 0%, #c34a3c 100%)'],
            ];
        @endphp
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                            <h6 class="card-title mb-0"><i class="bx bx-pie-chart-alt"></i> আবেদন অগ্রগতি</h6>
                            <span class="text-muted small">মোট {{ number_format($totalApplications) }}টি আবেদন</span>
                        </div>
                        <div class="row g-4">
                            @foreach($rings as $ring)
                                <div class="col-4 text-center">
                                    <div class="progress-ring position-relative d-inline-block">
                                        <svg width="100" height="100" viewBox="0 0 120 120">
                                            <circle cx="60" cy="60" r="50" fill="none" stroke="#f0edf8" stroke-width="10"/>
                                            <circle cx="60" cy="60" r="50" fill="none" stroke="{{ $ring['color'] }}" stroke-width="10"
                                                stroke-dasharray="{{ $ring['pct'] * 3.14 }} 314" stroke-dashoffset="0"
                                                stroke-linecap="round" transform="rotate(-90 60 60)"/>
                                        </svg>
                                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                            <div style="font-size:1.3rem;font-weight:700;color:#1f1a2e;">{{ $ring['pct'] }}%</div>
                                        </div>
                                    </div>
                                    <div class="mt-2 fw-semibold" style="color:{{ $ring['textColor'] }};">
                                        <i class="bx {{ $ring['icon'] }}"></i> {{ $ring['label'] }}
                                    </div>
                                    <div class="text-muted small">{{ number_format($ring['count']) }}টি</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Charts -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bx bx-pie-chart-alt-2 fs-5" style="color:#7c6bb0;"></i>
                        <h6 class="card-title mb-0">বোর্ড অনুযায়ী আবেদন</h6>
                    </div>
                    <div id="boardChart" class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bx bx-map fs-5" style="color:#44c9a0;"></i>
                        <h6 class="card-title mb-0">বিভাগ অনুযায়ী আবেদন</h6>
                    </div>
                    <div id="divisionChart" class="chart-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h6 class="card-title mb-0"><i class="bx bx-list-ul"></i> সাম্প্রতিক আবেদনসমূহ</h6>
                    @can('viewAny', \App\Models\StudentDetail::class)
                        <a href="{{ route('admin.applications.index') }}" class="btn-viewall">
                            সব দেখুন <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="tbl-wrap">
                            <thead>
                                <tr>
                                    <th class="ps-3">#</th>
                                    <th>শিক্ষার্থীর নাম</th>
                                    <th>মোবাইল</th>
                                    <th>বোর্ড</th>
                                    <th>রোল</th>
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
                                        $st = $statusMap[$app->application_status_id] ?? ['label' => $app->applicationStatus->name ?? 'N/A', 'class' => 'st-pending'];
                                    @endphp
                                    <tr>
                                        <td class="ps-3 text-muted fw-semibold small">{{ $i + 1 }}</td>
                                        <td>
                                            <div class="td-name-en">{{ $app->name_en }}</div>
                                            <div class="td-name-bn">{{ $app->name_bn }}</div>
                                        </td>
                                        <td class="text-muted small font-monospace">{{ $app?->user?->mobile ?? '—' }}</td>
                                        <td class="fw-medium">{{ $app->board->name_bn ?? '—' }}</td>
                                        <td class="text-muted small font-monospace">{{ $app->roll_number }}</td>
                                        <td><span class="gpa-badge">{{ $app->gpa_result }}</span></td>
                                        <td class="text-muted">{{ $app->division->name_bn ?? '—' }}</td>
                                        <td><span class="st-pill {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                                        <td class="text-muted small">{{ $app->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="bx bx-inbox" style="font-size:2rem;display:block;margin-bottom:0.4rem;opacity:0.4;"></i>
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
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to safely render charts
            function renderChart(selector, options) {
                const element = document.querySelector(selector);
                if (!element) return;

                // Check if there's data to display
                const hasData = options.series && options.series.length > 0 &&
                               options.series.some(s => s.data && s.data.some(v => v > 0));

                if (!hasData) {
                    element.innerHTML = '<div class="text-center text-muted py-4">কোনো ডেটা নেই</div>';
                    return;
                }

                try {
                    element.innerHTML = '';
                    const chart = new ApexCharts(element, options);
                    chart.render();
                } catch (e) {
                    console.warn('Chart render error:', e);
                    element.innerHTML = '<div class="text-center text-muted py-4">চার্ট লোড করা যায়নি</div>';
                }
            }

            // Board Chart - Bar Chart
            const boardData = @json($applicationsByBoard);
            const boardNames = Object.keys(boardData);
            const boardValues = Object.values(boardData);

            renderChart('#boardChart', {
                chart: {
                    type: 'bar',
                    height: 280,
                    fontFamily: "'Inter', sans-serif",
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 650
                    }
                },
                series: [{
                    name: 'আবেদন',
                    data: boardValues,
                    color: '#7c6bb0'
                }],
                xaxis: {
                    categories: boardNames,
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#7a6e96'
                        },
                        rotate: -25
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: v => Math.floor(v).toLocaleString(),
                        style: {
                            fontSize: '11px',
                            colors: '#9a8abc'
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '55%',
                        borderRadiusApplication: 'end',
                        colors: {
                            ranges: [{
                                from: 0,
                                to: 1000,
                                color: '#7c6bb0'
                            }]
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
                    xaxis: { lines: { show: false } }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: v => v.toLocaleString() + ' টি আবেদন'
                    }
                }
            });

            // Division Chart - Area Chart
            const divData = @json($applicationsByDivision);
            const divNames = Object.keys(divData);
            const divValues = Object.values(divData);

            renderChart('#divisionChart', {
                chart: {
                    type: 'area',
                    height: 280,
                    fontFamily: "'Inter', sans-serif",
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 650
                    }
                },
                series: [{
                    name: 'আবেদন',
                    data: divValues,
                    color: '#44c9a0'
                }],
                xaxis: {
                    categories: divNames,
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#7a6e96'
                        },
                        rotate: -25
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: v => Math.floor(v).toLocaleString(),
                        style: {
                            fontSize: '11px',
                            colors: '#9a8abc'
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        gradientToColors: ['#1e9e7a'],
                        stops: [0, 90]
                    }
                },
                markers: {
                    size: 5,
                    colors: ['#fff'],
                    strokeColors: '#44c9a0',
                    strokeWidth: 2,
                    hover: {
                        size: 7
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
                    offsetY: -10
                },
                grid: {
                    borderColor: 'rgba(79, 59, 140, 0.04)',
                    strokeDashArray: 4,
                    xaxis: { lines: { show: false } }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: v => v.toLocaleString() + ' টি আবেদন'
                    }
                }
            });
        });
    </script>
@endpush
