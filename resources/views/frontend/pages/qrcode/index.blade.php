{{-- resources/views/frontend/pages/qrcode/index.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'সংবর্ধনায় প্রবেশের QR কোড')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <h3 class="mb-2"><i class="fas fa-qrcode"></i> সংবর্ধনায় প্রবেশ</h3>
            <p class="text-muted mb-0">প্রবেশ নিশ্চিত করতে QR কোড স্ক্যান করুন</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- QR Code + Instructions -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light border-bottom text-center">
                    <h6 class="mb-0"><i class="fas fa-qrcode"></i> এই কোডটি স্ক্যান করুন</h6>
                </div>
                <div class="card-body p-4 text-center">
                    <img
                        src="{{ $qrImageUrl }}"
                        alt="সংবর্ধনায় প্রবেশের QR কোড"
                        class="img-fluid border rounded mb-3"
                        style="max-width: 260px;"
                    >
                    <p class="text-muted small mb-0">
                        আপনার মোবাইল ক্যামেরা বা QR স্ক্যানার দিয়ে এই কোডটি স্ক্যান করুন।<br>
                        প্রবেশ যাচাই করতে অবশ্যই লগইন থাকতে হবে।
                    </p>
                </div>
            </div>

            <div class="card border-info">
                <div class="card-body">
                    <h6 class="card-title text-info">
                        <i class="fas fa-info-circle"></i> যেভাবে কাজ করে
                    </h6>
                    <ol class="mb-0 small">
                        <li>
                            <strong>প্রথমে লগইন করুন:</strong>
                            <a href="{{ route('student.login') }}">আপনার তথ্য দিয়ে লগইন করুন</a>
                        </li>
                        <li><strong>QR স্ক্যান করুন:</strong> ফোনের ক্যামেরা বা QR স্ক্যানার অ্যাপ ব্যবহার করুন</li>
                        <li><strong>স্ট্যাটাস যাচাই:</strong> সিস্টেম আপনার আবেদন অনুমোদিত কিনা যাচাই করবে</li>
                        <li><strong>প্রবেশাধিকার পান:</strong> অনুমোদিত হলে আপনি প্রবেশ করতে পারবেন</li>
                        <li><strong>একবারই স্ক্যান:</strong> শুধুমাত্র একবার স্ক্যান করা যাবে</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Last Scanned (featured) -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-success text-white text-center">
                    <h6 class="mb-0"><i class="fas fa-user-check"></i> সর্বশেষ প্রবেশ</h6>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center"
                     id="lastScannedBody" style="min-height: 380px;">
                    @if ($latestEntry)
                        <img src="{{ $latestEntry->studentDetail->student_photo_url }}"
                             alt="{{ $latestEntry->studentDetail->name_en ?? '' }}"
                             class="rounded-circle mx-auto mb-3"
                             style="width:130px;height:130px;object-fit:cover;border:4px solid #e8f5e9;">
                        <h5 class="fw-bold mb-1">
                            {{ $latestEntry->studentDetail->name_bn ?? $latestEntry->studentDetail->name_en }}
                        </h5>
                        <p class="text-muted mb-2">{{ $latestEntry->studentDetail->name_en }}</p>
                        <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
                            @if ($latestEntry->studentDetail->roll_number)
                                <span class="badge bg-primary">রোল: {{ $latestEntry->studentDetail->roll_number }}</span>
                            @endif
                            @if ($latestEntry->studentDetail->board?->name_bn)
                                <span class="badge bg-info text-dark">{{ $latestEntry->studentDetail->board->name_bn }}</span>
                            @endif
                        </div>
                        <small class="text-success fw-semibold">
                            <i class="fas fa-check-circle"></i> {{ $latestEntry->scanned_at->format('h:i A') }}
                        </small>
                    @else
                        <div class="text-muted py-5">
                            <i class="fas fa-user-clock fa-3x mb-3 d-block"></i>
                            এখনো কোনো প্রবেশ রেকর্ড হয়নি
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Scans List -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-list"></i> সাম্প্রতিক প্রবেশ তালিকা</h6>
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-circle text-success" style="font-size:8px;"></i> লাইভ
                    </span>
                </div>
                <div class="card-body p-0" style="max-height: 420px; overflow-y: auto;">
                    <ul class="list-group list-group-flush" id="recentScansList">
                        @forelse ($entries as $entry)
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <img src="{{ $entry->studentDetail->student_photo_url }}"
                                     class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold small">
                                        {{ $entry->studentDetail->name_bn ?? $entry->studentDetail->name_en }}
                                    </div>
                                    <div class="text-muted" style="font-size:0.75rem;">
                                        রোল: {{ $entry->studentDetail->roll_number ?? '—' }}
                                    </div>
                                </div>
                                <span class="text-muted" style="font-size:0.7rem;">
                                    {{ $entry->scanned_at->format('h:i A') }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">
                                কোনো তথ্য পাওয়া যায়নি
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="mt-4 text-center">
        @auth
            <p class="text-muted small mb-2">
                ইতিমধ্যে লগইন করা আছে? <a href="{{ route('student.ceremony.history') }}">আপনার প্রবেশের ইতিহাস দেখুন</a>
            </p>
        @endauth
        @guest
            <p class="text-muted small mb-0">
                প্রবেশ যাচাই করতে <a href="{{ route('student.login') }}">এখানে লগইন করুন</a>
            </p>
        @endguest
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const POLL_INTERVAL_MS = 10000;
    const lastScannedBody = document.getElementById('lastScannedBody');
    const recentScansList = document.getElementById('recentScansList');
    let lastEntryId = {{ $latestEntry?->id ?? 'null' }};

    function renderLastScanned(entry) {
        if (!entry) {
            lastScannedBody.innerHTML = `
                <div class="text-muted py-5">
                    <i class="fas fa-user-clock fa-3x mb-3 d-block"></i>
                    এখনো কোনো প্রবেশ রেকর্ড হয়নি
                </div>`;
            return;
        }

        lastScannedBody.innerHTML = `
            <img src="${entry.photo_url}" alt="${entry.name_en}" class="rounded-circle mx-auto mb-3"
                 style="width:130px;height:130px;object-fit:cover;border:4px solid #e8f5e9;">
            <h5 class="fw-bold mb-1">${entry.name_bn || entry.name_en}</h5>
            <p class="text-muted mb-2">${entry.name_en}</p>
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
                ${entry.roll_number ? `<span class="badge bg-primary">রোল: ${entry.roll_number}</span>` : ''}
                ${entry.board ? `<span class="badge bg-info text-dark">${entry.board}</span>` : ''}
            </div>
            <small class="text-success fw-semibold"><i class="fas fa-check-circle"></i> ${entry.scanned_at}</small>
        `;
    }

    function renderRecentItem(entry) {
        return `
            <li class="list-group-item d-flex align-items-center gap-2">
                <img src="${entry.photo_url}" class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                <div class="flex-grow-1">
                    <div class="fw-semibold small">${entry.name_bn || entry.name_en}</div>
                    <div class="text-muted" style="font-size:0.75rem;">রোল: ${entry.roll_number || '—'}</div>
                </div>
                <span class="text-muted" style="font-size:0.7rem;">${entry.scanned_at}</span>
            </li>`;
    }

    function refreshFeed() {
        fetch('{{ route('qrcode.latest-scans') }}')
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                if (data.latest && data.latest.id !== lastEntryId) {
                    lastEntryId = data.latest.id;
                    renderLastScanned(data.latest);
                } else if (!data.latest) {
                    lastEntryId = null;
                    renderLastScanned(null);
                }

                if (recentScansList) {
                    recentScansList.innerHTML = data.recent.length
                        ? data.recent.map(renderRecentItem).join('')
                        : '<li class="list-group-item text-center text-muted py-4">কোনো তথ্য পাওয়া যায়নি</li>';
                }
            })
            .catch(err => console.error('Failed to refresh scan feed:', err));
    }

    setInterval(refreshFeed, POLL_INTERVAL_MS);
});
</script>
@endpush
@endsection
