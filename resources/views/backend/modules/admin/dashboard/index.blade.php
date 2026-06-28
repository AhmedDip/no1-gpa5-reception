{{-- resources/views/backend/modules/admin/dashboard/index.blade.php --}}

@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Dashboard')

@push('css')
    <style>
        .stat-card {
            border: none;
            border-radius: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12) !important;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .stat-gradient-blue {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .stat-gradient-green {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .stat-gradient-orange {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }

        .stat-gradient-red {
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        }

        .stat-num {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .badge-status {
            border-radius: 30px;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #444;
            letter-spacing: 0.3px;
        }

        .permission-badge {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
        }
    </style>
@endpush

@section('main-content')

    {{-- ── Welcome Bar ─────────────────────────────────────────────── --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm"
                style="background: linear-gradient(135deg, #6041a9 0%, #7e54de 100%); border-radius: 16px;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="text-white">
                        <h4 class="fw-bold mb-1">স্বাগতম, {{ Auth::user()->name }}! 👋</h4>
                        <p class="mb-0 opacity-75 small">
                            <i class="bx bx-calendar me-1"></i>{{ now()->format('l, d F Y') }}
                            &nbsp;|&nbsp;
                            <i class="bx bx-badge-check me-1"></i>{{ Auth::user()->webMenuGroup->wmng_name ?? 'Admin' }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-light text-purple fw-semibold">
                            <i class="bx bx-globe me-1"></i> পাবলিক সাইট দেখুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Stat Cards ──────────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon stat-gradient-blue text-white">
                            <i class="bx bx-file"></i>
                        </div>
                        <span class="badge bg-label-primary permission-badge">মোট</span>
                    </div>
                    <div class="stat-num text-dark">{{ number_format($totalApplications) }}</div>
                    <div class="small text-muted mt-1">মোট আবেদন</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon stat-gradient-orange text-white">
                            <i class="bx bx-time"></i>
                        </div>
                        <span class="badge bg-label-warning permission-badge">অপেক্ষমাণ</span>
                    </div>
                    <div class="stat-num text-dark">{{ number_format($pendingApplications) }}</div>
                    <div class="small text-muted mt-1">পেন্ডিং আবেদন</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon stat-gradient-green text-white">
                            <i class="bx bx-check-circle"></i>
                        </div>
                        <span class="badge bg-label-success permission-badge">অনুমোদিত</span>
                    </div>
                    <div class="stat-num text-dark">{{ number_format($approvedApplications) }}</div>
                    <div class="small text-muted mt-1">অনুমোদিত আবেদন</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon stat-gradient-red text-white">
                            <i class="bx bx-x-circle"></i>
                        </div>
                        <span class="badge bg-label-danger permission-badge">প্রত্যাখ্যাত</span>
                    </div>
                    <div class="stat-num text-dark">{{ number_format($rejectedApplications) }}</div>
                    <div class="small text-muted mt-1">প্রত্যাখ্যাত আবেদন</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Progress Summary ─────────────────────────────────────────── --}}
    @if ($totalApplications > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="section-title mb-0"><i class="bx bx-bar-chart-alt-2 me-2 text-primary"></i>আবেদন
                                অগ্রগতি</h6>
                            <span class="small text-muted">মোট {{ number_format($totalApplications) }}টি আবেদন</span>
                        </div>
                        <div class="progress mb-2" style="height: 24px; border-radius: 12px;">
                            @php
                                $approvedPct =
                                    $totalApplications > 0
                                        ? round(($approvedApplications / $totalApplications) * 100)
                                        : 0;
                                $pendingPct =
                                    $totalApplications > 0
                                        ? round(($pendingApplications / $totalApplications) * 100)
                                        : 0;
                                $rejectedPct =
                                    $totalApplications > 0
                                        ? round(($rejectedApplications / $totalApplications) * 100)
                                        : 0;
                            @endphp
                            <div class="progress-bar bg-success" style="width: {{ $approvedPct }}%">
                                @if ($approvedPct > 8)
                                    {{ $approvedPct }}%
                                @endif
                            </div>
                            <div class="progress-bar bg-warning text-dark" style="width: {{ $pendingPct }}%">
                                @if ($pendingPct > 8)
                                    {{ $pendingPct }}%
                                @endif
                            </div>
                            <div class="progress-bar bg-danger" style="width: {{ $rejectedPct }}%">
                                @if ($rejectedPct > 8)
                                    {{ $rejectedPct }}%
                                @endif
                            </div>
                        </div>
                        <div class="d-flex gap-4 mt-2 flex-wrap">
                            <span class="small"><span class="badge bg-success me-1">■</span>অনুমোদিত
                                {{ $approvedPct }}%</span>
                            <span class="small"><span class="badge bg-warning text-dark me-1">■</span>অপেক্ষমাণ
                                {{ $pendingPct }}%</span>
                            <span class="small"><span class="badge bg-danger me-1">■</span>প্রত্যাখ্যাত
                                {{ $rejectedPct }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ── Charts Row ───────────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        {{-- Board Chart --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="section-title"><i class="bx bx-pie-chart-alt-2 me-2 text-info"></i>বোর্ড অনুযায়ী আবেদন</h6>
                </div>
                <div class="card-body">
                    <div id="boardChart" style="min-height: 260px;"></div>
                </div>
            </div>
        </div>

        {{-- Division Chart --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h6 class="section-title"><i class="bx bx-map me-2 text-success"></i>বিভাগ অনুযায়ী আবেদন</h6>
                </div>
                <div class="card-body">
                    <div id="divisionChart" style="min-height: 260px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Recent Applications Table ───────────────────────────────── --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div
                    class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h6 class="section-title mb-0"><i class="bx bx-list-ul me-2 text-primary"></i>সাম্প্রতিক আবেদনসমূহ</h6>
                    @can('viewAny', \App\Models\UserDetail::class)
                        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline-primary">
                            সব দেখুন <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">#</th>
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
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $app->name_en }}</div>
                                            <div class="small text-muted">{{ $app->name_bn }}</div>
                                        </td>
                                        <td class="small">{{ $app->board->name_bn ?? '—' }}</td>
                                        <td class="small font-monospace">{{ $app->roll_number }}</td>
                                        <td>
                                            <span class="badge bg-label-success fw-bold">{{ $app->gpa_result }}</span>
                                        </td>
                                        <td class="small">{{ $app->division->name_bn ?? '—' }}</td>
                                        <td>
                                            @php
                                                $statusClass = match ($app->application_status_id) {
                                                    1 => 'bg-label-warning',
                                                    2 => 'bg-label-success',
                                                    3 => 'bg-label-danger',
                                                    default => 'bg-label-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }} badge-status">
                                                {{ $app->applicationStatus->name ?? 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="small text-muted">{{ $app->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="bx bx-inbox fs-1 d-block mb-2"></i>
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

            // ── Board Chart ─────────────────────────────────
            const boardData = @json($applicationsByBoard);
            const boardNames = Object.keys(boardData);
            const boardVals = Object.values(boardData);

            if (boardNames.length > 0) {
                new ApexCharts(document.querySelector('#boardChart'), {
                    chart: {
                        type: 'donut',
                        height: 260,
                        fontFamily: 'Hind Siliguri, sans-serif'
                    },
                    series: boardVals,
                    labels: boardNames,
                    colors: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69',
                        '#2e59d9', '#17a673'
                    ],
                    legend: {
                        position: 'bottom',
                        fontSize: '12px'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'মোট',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                }).render();
            } else {
                document.querySelector('#boardChart').innerHTML =
                    '<div class="text-center text-muted py-5">কোনো ডেটা নেই</div>';
            }

            // ── Division Chart ───────────────────────────────
            const divData = @json($applicationsByDivision);
            const divNames = Object.keys(divData);
            const divVals = Object.values(divData);

            if (divNames.length > 0) {
                new ApexCharts(document.querySelector('#divisionChart'), {
                    chart: {
                        type: 'bar',
                        height: 260,
                        fontFamily: 'Hind Siliguri, sans-serif',
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: 'আবেদন',
                        data: divVals
                    }],
                    xaxis: {
                        categories: divNames
                    },
                    colors: ['#6041a9'],
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            horizontal: false,
                            columnWidth: '55%'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => val
                    },
                    grid: {
                        borderColor: '#f0f0f0'
                    },
                    yaxis: {
                        labels: {
                            formatter: (val) => Math.floor(val)
                        }
                    },
                }).render();
            } else {
                document.querySelector('#divisionChart').innerHTML =
                    '<div class="text-center text-muted py-5">কোনো ডেটা নেই</div>';
            }

        });
    </script>
@endpush
