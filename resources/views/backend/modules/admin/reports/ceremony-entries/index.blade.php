@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Daily Ceremony Entries')

@section('main-content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1">Daily Ceremony Entries</h4>
                        <p class="text-muted mb-0">Unique approved entries for the selected day.</p>
                    </div>
                    <div class="badge bg-label-primary fs-6 px-3 py-2">
                        <i class="fas fa-users me-1"></i> {{ $entries->total() }} unique entries
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Choose date</h5>
            <a href="{{ route('admin.qrcode.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-qrcode me-1"></i> QR dashboard
            </a>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ceremony-entries.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4 col-lg-3">
                    <label for="entry-date" class="form-label">Entry date</label>
                    <input id="entry-date" type="date" name="date" class="form-control" value="{{ $date }}"
                        required>
                </div>
                <div class="col-md-3 col-lg-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-1"></i> Show entries
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Entries for
                {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Scanned at</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $index => $entry)
                            @php
                                $user = $entry->student;
                                $detail = $entry->studentDetail;
                                $name = $detail?->name_bn ?: ($detail?->name_en ?: ($user?->name ?: 'Unknown'));
                                $type = $user?->userType?->name ?: ($user?->user_type_id == 5 ? 'Guest' : 'Student');
                            @endphp
                            <tr>
                                <td>{{ $entries->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $name }}</div>
                                    @if ($detail?->name_en && $detail->name_bn)
                                        <small class="text-muted">{{ $detail->name_en }}</small>
                                    @endif
                                </td>
                                <td style="font-family: monospace;">{{ $user?->mobile ?: '—' }}</td>
                                <td><span class="badge bg-label-info">{{ $type }}</span></td>
                                <td><span class="badge bg-label-success">{{ ucfirst($entry->status) }}</span></td>
                                <td>{{ $entry->scanned_at?->format('d M Y, h:i A') ?: '—' }}</td>
                                <td>{{ $entry->remarks ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-2 d-block"></i>
                                    No approved ceremony entries found for this date.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($entries->hasPages())
                <div class="mt-4">{{ $entries->links() }}</div>
            @endif
        </div>
    </div>
@endsection
