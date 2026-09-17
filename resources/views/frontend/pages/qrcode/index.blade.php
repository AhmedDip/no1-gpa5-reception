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
            {{-- Latest Scanned QR --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light border-bottom text-center">
                        <h6 class="mb-0"><i class="fas fa-qrcode"></i> সর্বশেষ স্ক্যান করা QR কোড</h6>
                    </div>
                    <div class="card-body p-4 text-center" id="latestQrBody">
                        @if ($latestQrDataUri && $latestEntry?->studentDetail)
                            <img src="{{ $latestQrDataUri }}"
                                alt="{{ $latestEntry->studentDetail->name_en ?? '' }}"
                                class="img-fluid border rounded mb-3" style="max-width: 260px;">
                            <h6 class="fw-bold mb-1">
                                {{ $latestEntry->studentDetail->name_bn ?? $latestEntry->studentDetail->name_en }}
                            </h6>
                            <p class="text-muted small mb-0">
                                রোল: {{ $latestEntry->studentDetail->roll_number ?? '—' }}
                            </p>
                        @else
                            <div class="text-muted py-5">
                                <i class="fas fa-qrcode fa-3x mb-3 d-block"></i>
                                এখনো কোনো QR কোড স্ক্যান হয়নি
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card border-info">
                    <div class="card-body">
                        <h6 class="card-title text-info">
                            <i class="fas fa-info-circle"></i> যেভাবে কাজ করে
                        </h6>
                        <ol class="mb-0 small">
                            <li>শিক্ষার্থী তার নিজস্ব QR কোডটি স্ক্যানারের সামনে ধরবেন</li>
                            <li>আয়োজক টিম QR কোডটি স্ক্যান করবেন</li>
                            <li>সিস্টেম শিক্ষার্থীর আবেদন অনুমোদিত কিনা যাচাই করবে</li>
                            <li>অনুমোদিত হলে প্রবেশাধিকার নিশ্চিত হবে</li>
                            <li>এই পেজে সর্বশেষ স্ক্যান করা QR কোড স্বয়ংক্রিয়ভাবে দেখা যাবে</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Last Scanned (featured) --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-success text-white text-center">
                        <h6 class="mb-0"><i class="fas fa-user-check"></i> সর্বশেষ প্রবেশ</h6>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-center"
                        id="lastScannedBody" style="min-height: 380px;">
                        @if ($latestEntry && $latestEntry->studentDetail)
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
                                    <span class="badge bg-primary">
                                        রোল: {{ $latestEntry->studentDetail->roll_number }}
                                    </span>
                                @endif
                                @if ($latestEntry->studentDetail->board?->name_bn)
                                    <span class="badge bg-info text-dark">
                                        {{ $latestEntry->studentDetail->board->name_bn }}
                                    </span>
                                @endif
                            </div>
                            <small class="text-success fw-semibold">
                                <i class="fas fa-check-circle"></i>
                                {{ $latestEntry->scanned_at?->format('h:i A') }}
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

            {{-- Recent Scans List --}}
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
                                @if ($entry->studentDetail)
                                    <li class="list-group-item d-flex align-items-center gap-2">
                                        <img src="{{ $entry->studentDetail->student_photo_url }}"
                                            class="rounded-circle" width="40" height="40"
                                            style="object-fit:cover;">
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold small">
                                                {{ $entry->studentDetail->name_bn ?? $entry->studentDetail->name_en }}
                                            </div>
                                            <div class="text-muted" style="font-size:0.75rem;">
                                                রোল: {{ $entry->studentDetail->roll_number ?? '—' }}
                                            </div>
                                        </div>
                                        <span class="text-muted" style="font-size:0.7rem;">
                                            {{ $entry->scanned_at?->format('h:i A') }}
                                        </span>
                                    </li>
                                @endif
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
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    const REFRESH_EVERY_MS = 5000; // 10 seconds

    // Cache jQuery selectors
    const $lastScannedBox = $('#lastScannedBody');
    const $latestQrBox    = $('#latestQrBody');
    const $recentList     = $('#recentScansList');

    let lastEntryId = @json($latestEntry?->id);

    // Simple text sanitizer (prevents HTML injection)
    function clean(text) {
        if (text == null) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Build HTML for "Latest Entry" card
    function buildLastScannedHtml(entry) {
        if (!entry) {
            return `
                <div class="text-muted py-5">
                    <i class="fas fa-user-clock fa-3x mb-3 d-block"></i>
                    এখনো কোনো প্রবেশ রেকর্ড হয়নি
                </div>`;
        }

        const rollBadge  = entry.roll_number
            ? `<span class="badge bg-primary">রোল: ${clean(entry.roll_number)}</span>` : '';
        const boardBadge = entry.board
            ? `<span class="badge bg-info text-dark">${clean(entry.board)}</span>` : '';

        return `
            <img src="${clean(entry.photo_url)}" alt="${clean(entry.name_en)}"
                 class="rounded-circle mx-auto mb-3"
                 style="width:130px;height:130px;object-fit:cover;border:4px solid #e8f5e9;">
            <h5 class="fw-bold mb-1">${clean(entry.name_bn || entry.name_en)}</h5>
            <p class="text-muted mb-2">${clean(entry.name_en)}</p>
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
                ${rollBadge}${boardBadge}
            </div>
            <small class="text-success fw-semibold">
                <i class="fas fa-check-circle"></i> ${clean(entry.scanned_at)}
            </small>`;
    }

    // Build HTML for "Latest QR" card
    function buildLatestQrHtml(entry) {
        if (!entry || !entry.qr_data_uri) {
            return `
                <div class="text-muted py-5">
                    <i class="fas fa-qrcode fa-3x mb-3 d-block"></i>
                    এখনো কোনো QR কোড স্ক্যান হয়নি
                </div>`;
        }

        return `
            <img src="${clean(entry.qr_data_uri)}" alt="${clean(entry.name_en)}"
                 class="img-fluid border rounded mb-3" style="max-width: 260px;">
            <h6 class="fw-bold mb-1">${clean(entry.name_bn || entry.name_en)}</h6>
            <p class="text-muted small mb-0">রোল: ${clean(entry.roll_number || '—')}</p>`;
    }

    // Build HTML for one row in the recent list
    function buildRecentItemHtml(entry) {
        return `
            <li class="list-group-item d-flex align-items-center gap-2">
                <img src="${clean(entry.photo_url)}" class="rounded-circle"
                     width="40" height="40" style="object-fit:cover;">
                <div class="flex-grow-1">
                    <div class="fw-semibold small">${clean(entry.name_bn || entry.name_en)}</div>
                    <div class="text-muted" style="font-size:0.75rem;">
                        রোল: ${clean(entry.roll_number || '—')}
                    </div>
                </div>
                <span class="text-muted" style="font-size:0.7rem;">${clean(entry.scanned_at)}</span>
            </li>`;
    }

    // Apply a new "latest" entry to both the photo card and the QR card
    function updateLatestCards(entry) {
        $lastScannedBox.html(buildLastScannedHtml(entry));
        $latestQrBox.html(buildLatestQrHtml(entry));
    }

    // Update only the recent scans list
    function updateRecentList(items) {
        if (!items.length) {
            $recentList.html(`
                <li class="list-group-item text-center text-muted py-4">
                    কোনো তথ্য পাওয়া যায়নি
                </li>`);
            return;
        }
        $recentList.html(items.map(buildRecentItemHtml).join(''));
    }

    // Fetch new data with jQuery AJAX and update the page
    function refreshFeed() {
        $.ajax({
            url: '{{ route('admin.qrcode.latest-scans') }}',
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                if (!data.success) return;

                const entry   = data.latest;
                const entryId = entry ? entry.id : null;

                // Only rebuild the big cards if the latest entry changed
                if (entryId !== lastEntryId) {
                    lastEntryId = entryId;
                    updateLatestCards(entry);
                }

                updateRecentList(data.recent || []);
            },
            error: function (xhr, status, err) {
                console.error('Failed to refresh scan feed:', status, err);
            }
        });
    }

    // Poll every 10 seconds
    setInterval(refreshFeed, REFRESH_EVERY_MS);
});
</script>
@endpush
