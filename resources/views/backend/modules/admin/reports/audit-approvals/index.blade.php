@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Approval Audit Report')

@section('main-content')
<div class="card mb-4">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link {{ $type === 'rm' ? 'active' : '' }}"
                   href="{{ route('admin.reports.audit-approvals.index', array_merge($filters, ['type' => 'rm'])) }}">
                    <i class="fas fa-user-check me-1"></i> RM Approved
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $type === 'wm' ? 'active' : '' }}"
                   href="{{ route('admin.reports.audit-approvals.index', array_merge($filters, ['type' => 'wm'])) }}">
                    <i class="fas fa-user-check me-1"></i> WM Approved
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.reports.audit-approvals.index') }}" class="row g-3 mb-4">
            <input type="hidden" name="type" value="{{ $type }}">

            <div class="col-md-3">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Name, roll, mobile..."
                       value="{{ $filters['search'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">From</label>
                <input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">To</label>
                <input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Board</label>
                <select name="board" class="form-select">
                    <option value="">All Boards</option>
                    @foreach ($boards as $board)
                        <option value="{{ $board->id }}" {{ ($filters['board'] ?? '') == $board->id ? 'selected' : '' }}>
                            {{ $board->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Division</label>
                <select name="division" class="form-select">
                    <option value="">All Divisions</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ ($filters['division'] ?? '') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2 flex-wrap">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Filter
                </button>
                <a href="{{ route('admin.reports.audit-approvals.index', ['type' => $type]) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-undo me-1"></i> Reset
                </a>
                <a href="{{ route($type === 'rm' ? 'admin.reports.audit-approvals.export.rm' : 'admin.reports.audit-approvals.export.wm', $filters) }}"
                   class="btn btn-success ms-auto">
                    <i class="fas fa-file-excel me-1"></i> Export {{ strtoupper($type) }} Approved
                </a>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>TERRITORY</th>
                        <th>REGION</th>
                        <th>WING</th>
                        <th>STUDENT</th>
                        <th>ROLL</th>
                        <th>GPA</th>
                        <th>BOARD</th>
                        <th>DIVISION</th>
                        <th>USER MOBILE</th>
                        <th>USER NAME</th>
                        <th>APPS</th>
                        <th>{{ strtoupper($type) }} STAFF</th>
                        <th>APPROVED AT</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $i => $row)
                        <tr>
                            <td>{{ $records->firstItem() + $i }}</td>
                            <td><span class="badge bg-info">{{ $row->territory_name ?? '—' }}</span></td>
                            <td>{{ $row->region_name ?? '—' }}</td>
                            <td><span class="badge bg-primary">{{ $row->wing_name ?? '—' }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(!empty($row->student_photo))
                                        <img src="{{ $row->student_photo }}" alt="Student"
                                             style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; margin-right: 8px;">
                                    @else
                                        <div class="avatar avatar-sm me-2 bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-white" style="font-size: 14px;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div><strong>{{ $row->student_name }}</strong></div>
                                        @if(!empty($row->student_name_bangla))
                                            <small class="text-muted">{{ $row->student_name_bangla }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td><code>{{ $row->roll_number }}</code></td>
                            <td>
                                <span class="badge bg-{{ $row->gpa_result >= 5 ? 'success' : ($row->gpa_result >= 4 ? 'warning' : 'danger') }}">
                                    {{ $row->gpa_result }}
                                </span>
                            </td>
                            <td>{{ $row->board_name }}</td>
                            <td>{{ $row->division_name }}</td>
                            <td>
                                <a href="tel:{{ $row->user_mobile }}" class="text-decoration-none">
                                    <i class="fas fa-phone me-1"></i>
                                    <code>{{ $row->user_mobile ?? '—' }}</code>
                                </a>
                            </td>
                            <td>{{ $row->user_name ?? '—' }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $row->total_applications ?? 0 }}</span>
                            </td>
                            <td>
                                <div><strong>{{ $row->staff_name }}</strong></div>
                                <small class="text-muted">{{ $row->staff_id }}</small>
                            </td>
                            <td>
                                <div>{{ \Illuminate\Support\Carbon::parse($row->approved_at)->format('d M Y') }}</div>
                                <small class="text-muted">{{ \Illuminate\Support\Carbon::parse($row->approved_at)->format('h:i A') }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted d-block mb-3"></i>
                                <span class="text-muted">No records found for the selected filters.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <div>
                <small class="text-muted">
                    Showing {{ $records->firstItem() ?? 0 }} to {{ $records->lastItem() ?? 0 }}
                    of {{ $records->total() }} entries
                </small>
            </div>
            <div>
                {{ $records->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
