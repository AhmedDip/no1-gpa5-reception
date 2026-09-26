@extends('backend.layouts.admin-template.main')

@section('title', 'Guest List')
@section('main-content')
    <div class="container-fluid456456">

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Filter Guests
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.guests.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Name or mobile..." value="{{ $filters['search'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Per Page</label>
                            <select name="per_page" class="form-select">
                                @foreach ([10, 20, 50, 100] as $count)
                                    <option value="{{ $count }}"
                                        {{ isset($filters['per_page']) && $filters['per_page'] == $count ? 'selected' : '' }}>
                                        {{ $count }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary">
                                <i class="fas fa-undo me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Guests Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>Guest List
                    <span class="badge bg-primary ms-2">{{ $guests->total() }}</span>
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-hover table-bordered align-middle"
                        style="font-size: 0.8rem; margin-bottom: 0;">
                        <thead class="table-light">
                            <tr>
                                <th width="60" style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">#</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Name</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Mobile</th>
                                <th class="text-center" width="120"
                                    style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guests as $index => $guest)
                                <tr>
                                    <td>{{ $guests->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($guest->name ?? 'N', 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $guest->name ?? '-' }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-info">
                                            <i class="fas fa-phone me-1"></i>
                                            {{ $guest->mobile ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{-- <a href="{{ route('admin.qr-code', $guest->mobile) }}"
                                            class="btn btn-icon btn-outline-dark btn-sm"
                                            title="Download QR Code" target="_blank">
                                            <i class="fas fa-qrcode"></i>
                                        </a> --}}

                                          <a href="{{ route('admin.qrcode.student.show', ['mobile' => $guest->mobile]) }}"
                                                    target="_blank"
                                                    class="btn btn-icon btn-outline-dark btn-sm" title="QR Code">
                                                    <i class="fas fa-qrcode"></i>
                                                </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                            <h6 class="mb-0">No guests found</h6>
                                            <small class="text-muted">Try adjusting your search</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $guests->firstItem() ?? 0 }} to {{ $guests->lastItem() ?? 0 }} of
                    {{ $guests->total() }} guests
                </div>
                <div>
                    {{ $guests->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
