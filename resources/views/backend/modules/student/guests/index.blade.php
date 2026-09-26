@extends('backend.layouts.admin-template.main')

@section('title', 'Guest List')

@section('main-content')
<div class="container-fluid px-3 px-md-4 py-4 guest-list-page">

    {{-- ================= Page Header ================= --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="mb-1 fw-semibold text-dark">
                <i class="fas fa-users text-primary me-2"></i>Guest List
            </h4>
            <p class="text-muted mb-0 small">Manage and browse all registered guests</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                <i class="fas fa-user-check me-1"></i> Total: {{ $guests->total() }}
            </span>
        </div>
    </div>

    {{-- ================= Filter Card ================= --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-3 pb-2 px-4">
            <h6 class="mb-0 fw-semibold text-dark">
                <i class="fas fa-sliders-h text-primary me-2"></i>Filter Guests
            </h6>
        </div>
        <div class="card-body px-4 pb-4">
            <form method="GET" action="{{ route('admin.guests.index') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-5 col-lg-4">
                        <label class="form-label small fw-semibold text-muted text-uppercase">Search</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Search by name or mobile..."
                                value="{{ $filters['search'] ?? '' }}">
                        </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2">
                        <label class="form-label small fw-semibold text-muted text-uppercase">Per Page</label>
                        <select name="per_page" class="form-select">
                            @foreach ([10, 20, 50, 100] as $count)
                                <option value="{{ $count }}"
                                    {{ isset($filters['per_page']) && $filters['per_page'] == $count ? 'selected' : '' }}>
                                    {{ $count }} entries
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.guests.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="fas fa-undo me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= Guests Table Card ================= --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold text-dark">
                <i class="fas fa-list-ul text-primary me-2"></i>Guests
            </h6>
            <span class="text-muted small">
                Showing <strong>{{ $guests->firstItem() ?? 0 }}</strong>–<strong>{{ $guests->lastItem() ?? 0 }}</strong> of <strong>{{ $guests->total() }}</strong>
            </span>
        </div>

        <div class="table-responsive guest-table-wrapper">
            <table class="table table-hover align-middle mb-0 guest-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:60px;">#</th>
                        <th>Guest</th>
                        <th>Mobile / Unique ID</th>
                        <th class="text-center" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $index => $guest)
                        @php
                            $uploadsDisk = Storage::disk('uploads');
                            $photoPath   = ltrim(str_replace('\\', '/', $guest->photo), '/');
                            $hasPhoto    = $guest->photo && $uploadsDisk->exists($photoPath);
                        @endphp
                        <tr>
                            <td class="text-center text-muted fw-semibold">
                                {{ $guests->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        @if ($hasPhoto)
                                            <img src="{{ asset('uploads/' . $photoPath) }}"
                                                alt="{{ $guest->name ?? '-' }}"
                                                class="rounded-circle avatar-img">
                                        @else
                                            <span class="avatar-initial rounded-circle bg-primary-subtle text-primary fw-semibold">
                                                {{ strtoupper(substr($guest->name ?? 'N', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="lh-sm">
                                        <div class="fw-semibold text-dark">{{ $guest->name ?? '-' }}</div>
                                        <small class="text-muted d-md-none">{{ $guest->mobile ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-info-subtle text-info border border-info-subtle px-3 py-2">
                                    <i class="fas fa-phone-alt me-1"></i>
                                    {{ $guest->mobile ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.qrcode.guest.show', ['mobile' => $guest->mobile]) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3"
                                   title="View QR Code">
                                    <i class="fas fa-qrcode me-1"></i> QR
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-icon mb-3">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-1">No guests found</h6>
                                    <small class="text-muted">Try adjusting your search or filters</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($guests->hasPages())
            <div class="card-footer bg-white border-top px-4 py-3">
                <div class="d-flex justify-content-center">
                    {{ $guests->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')

<style>
    .guest-list-page .card {
        transition: box-shadow .2s ease;
    }

    .guest-list-page .form-label {
        letter-spacing: .3px;
        font-size: .72rem;
    }

    .guest-list-page .form-control,
    .guest-list-page .form-select {
        border-radius: .6rem;
        padding: .55rem .85rem;
        font-size: .875rem;
        border-color: #e5e7eb;
    }

    .guest-list-page .form-control:focus,
    .guest-list-page .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .15);
    }

    .guest-list-page .input-group-text {
        border-radius: .6rem 0 0 .6rem;
    }

    .guest-list-page .input-group .form-control {
        border-radius: 0 .6rem .6rem 0;
    }

    .guest-list-page .btn {
        border-radius: .6rem;
        font-weight: 500;
        font-size: .875rem;
    }

    /* Table */
    .guest-table-wrapper {
        max-height: 620px;
        overflow-y: auto;
    }

    .guest-table thead th {
        position: sticky;
        top: 0;
        z-index: 5;
        background: #f8fafc;
        color: #64748b;
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 600;
        padding: .9rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .guest-table tbody td {
        padding: .85rem 1rem;
        border-color: #f1f5f9;
        vertical-align: middle;
    }

    .guest-table tbody tr {
        transition: background-color .15s ease;
    }

    .guest-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Avatar */
    .guest-list-page .avatar {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        position: relative;
    }

    .guest-list-page .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
    }

    .guest-list-page .avatar-initial {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
    }

    /* Empty state */
    .empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 1.75rem;
        color: #94a3b8;
    }

    /* Badges */
    .badge.bg-primary-subtle  { background-color: #eef2ff !important; }
    .badge.bg-info-subtle     { background-color: #ecfeff !important; }

    /* Pagination */
    .guest-list-page .pagination {
        margin-bottom: 0;
        gap: .25rem;
    }

    .guest-list-page .pagination .page-link {
        border-radius: .5rem;
        border: 1px solid #e5e7eb;
        color: #475569;
        font-size: .82rem;
        padding: .4rem .7rem;
        transition: all .15s ease;
    }

    .guest-list-page .pagination .page-link:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #4f46e5;
    }

    .guest-list-page .pagination .active .page-link {
        background: #6366f1;
        border-color: #6366f1;
        color: #fff;
        box-shadow: 0 2px 6px rgba(99, 102, 241, .35);
    }

    /* Scrollbar */
    .guest-table-wrapper::-webkit-scrollbar {
        width: 8px;
    }

    .guest-table-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .guest-table-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .guest-table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    @media (max-width: 576px) {
        .guest-table thead th,
        .guest-table tbody td {
            padding: .65rem .6rem;
        }
        .guest-list-page .avatar {
            width: 36px;
            height: 36px;
        }
    }
</style>
@endpush
@endsection