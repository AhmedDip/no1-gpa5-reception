@extends('backend.layouts.admin-template.main')

@section('title', 'Student Applications')
@section('main-content')
    <div class="container-fluid456456">
       <!-- Status Cards -->
        <div class="row mb-4">
            <!-- Total Applications -->
            <div class="col-sm-6 col-xl-3">
                <a href="{{ route('admin.applications.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Total Applications</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['total'] ?? 0 }}</h4>
                                        <small class="text-primary">(Total)</small>
                                    </div>
                                    <small>All Applications</small>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="fas fa-file-alt fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending -->
            <div class="col-sm-6 col-xl-3">
                <a href="{{ route('admin.applications.index', ['status' => 1]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Pending</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['pending'] ?? 0 }}</h4>
                                        <small class="text-warning">(Pending)</small>
                                    </div>
                                    <small>Awaiting Review</small>
                                </div>
                                <span class="badge bg-label-warning rounded p-2">
                                    <i class="fas fa-hourglass-half fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Approved By RM -->
            <div class="col-sm-6 col-xl-3">
                <a href="{{ route('admin.applications.index', ['status' => 2]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Approved By RM</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['approved_by_rm'] ?? 0 }}</h4>
                                        <small class="text-info">(RM Approved)</small>
                                    </div>
                                    <small>Approved by Regional Manager</small>
                                </div>
                                <span class="badge bg-label-info rounded p-2">
                                    <i class="fas fa-user-check fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Rejected By RM -->
            <div class="col-sm-6 col-xl-3">
                <a href="{{ route('admin.applications.index', ['status' => 3]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Rejected By RM</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['rejected_by_rm'] ?? 0 }}</h4>
                                        <small class="text-danger">(RM Rejected)</small>
                                    </div>
                                    <small>Rejected by Regional Manager</small>
                                </div>
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="fas fa-user-times fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Approved By WM -->
            <div class="col-sm-6 col-xl-3 mt-2">
                <a href="{{ route('admin.applications.index', ['status' => 4]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Approved By WM</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['approved_by_wm'] ?? 0 }}</h4>
                                        <small class="text-success">(WM Approved)</small>
                                    </div>
                                    <small>Approved by Wing Manager</small>
                                </div>
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="fas fa-user-check fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Rejected By WM -->
            <div class="col-sm-6 col-xl-3 mt-2">
                <a href="{{ route('admin.applications.index', ['status' => 5]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Rejected By WM</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['rejected_by_wm'] ?? 0 }}</h4>
                                        <small class="text-danger">(WM Rejected)</small>
                                    </div>
                                    <small>Rejected by Wing Manager</small>
                                </div>
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="fas fa-user-times fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Approved (Final) -->
            <div class="col-sm-6 col-xl-3 mt-2">
                <a href="{{ route('admin.applications.index', ['status' => 6]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Final Approved</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['approved'] ?? 0 }}</h4>
                                        <small class="text-success">(Approved)</small>
                                    </div>
                                    <small>Fully approved applications</small>
                                </div>
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="fas fa-check-double fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Rejected (Final) -->
            <div class="col-sm-6 col-xl-3 mt-2">
                <a href="{{ route('admin.applications.index', ['status' => 7]) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Final Rejected</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2">{{ $counts['rejected'] ?? 0 }}</h4>
                                        <small class="text-danger">(Rejected)</small>
                                    </div>
                                    <small>Fully rejected applications</small>
                                </div>
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Filter Applications
                </h5>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.applications.export', request()->query()) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i> Export
                    </a>
                @endif
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.applications.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Name, email, phone..." value="{{ $filters['search'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ isset($filters['status']) && $filters['status'] == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Wing</label>
                            <select name="wing" class="form-select select2">
                                <option value="">All Wings</option>
                                @foreach ($wings as $wing)
                                    <option value="{{ $wing->id }}"
                                        {{ isset($filters['wing']) && $filters['wing'] == $wing->id ? 'selected' : '' }}>
                                        {{ $wing->wing_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Region</label>
                            <select name="region" class="form-select select2">
                                <option value="">All Regions</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ isset($filters['region']) && $filters['region'] == $region->id ? 'selected' : '' }}>
                                        {{ $region->dirg_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Board</label>
                            <select name="board" class="form-select">
                                <option value="">All Boards</option>
                                @foreach ($boards as $board)
                                    <option value="{{ $board->id }}"
                                        {{ isset($filters['board']) && $filters['board'] == $board->id ? 'selected' : '' }}>
                                        {{ $board->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Division</label>
                            <select name="division" class="form-select" id="divisionFilter">
                                <option value="">All Divisions</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ isset($filters['division']) && $filters['division'] == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">District</label>
                            <select name="district" class="form-select select2" id="districtFilter">
                                <option value="">All Districts</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ isset($filters['district']) && $filters['district'] == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
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
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
                                <i class="fas fa-undo me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Applications List
                </h5>
                @if (auth()->user()->isAdmin())
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success btn-sm" id="bulkApproveBtn" disabled>
                            <i class="fas fa-check me-1"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" id="bulkRejectBtn" disabled>
                            <i class="fas fa-times me-1"></i> Reject
                        </button>
                        <button type="button" class="btn btn-info btn-sm" id="bulkNotifyBtn" disabled>
                            <i class="fas fa-sms me-1"></i> Notify
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-hover table-bordered align-middle" style="font-size: 0.75rem; margin-bottom: 0;">
                        <thead class="table-light sticky-header">
                            <tr>
                                <th width="30" style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">
                                    @if (auth()->user()->isAdmin())
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    @endif
                                </th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">#</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Wing</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Region</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Territory</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Student</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Mobile</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Mobile Verified</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Parent Info.</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Board</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Division</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">District</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Upazila</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Status</th>
                                <th style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Date</th>
                                <th class="text-center" style="position: sticky; top: 0; background: #e7fffffd; z-index: 10;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $index => $application)
                                <tr>
                                    <td>
                                        @if (auth()->user()->isAdmin())
                                            <input type="checkbox" class="form-check-input application-checkbox"
                                                value="{{ $application->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $applications->firstItem() + $index }}</td>
                                    @php $org = $orgHierarchy[$application->upazila_id] ?? null; @endphp
                                    <td>{{ $org['wing'] ?? '—' }}</td>
                                    <td>{{ $org['region'] ?? '—' }}</td>
                                    <td>{{ $org['territory'] ?? '—' }}</td>
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    @if ($application->student_photo)
                                                        <img src="{{ $application->student_photo_url }}"
                                                            alt="Student Photo" class="rounded-circle" width="32"
                                                            height="32">
                                                    @else
                                                        {{ strtoupper(substr($application->name_en ?? 'N/A', 0, 1)) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $application->name_bn ?? '-' }}</h6>
                                                <small class="text-success">GPA:
                                                    {{ $application?->gpa_result ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                          {{ $application?->user?->mobile ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($application?->user?->is_mobile_verified)
                                            <span class="badge bg-label-success">YES</span>
                                        @else
                                            <span class="badge bg-label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($application?->is_parent_info_provided)
                                            <span class="badge bg-label-success">YES</span>
                                        @else
                                            <span class="badge bg-label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>{{ $application?->board?->name ?? '-' }}</td>
                                    <td>{{ $application?->division?->name ?? '-' }}</td>
                                    <td>{{ $application?->district?->name ?? '-' }}</td>
                                    <td>{{ $application?->upazila?->name ?? '-' }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'approved_by_rm' => 'info',
                                                'rejected_by_rm' => 'danger',
                                                'approved_by_wm' => 'primary',
                                                'rejected_by_wm' => 'danger',
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                            ];
                                            $statusColor =
                                                $statusColors[$application->applicationStatus->slug ?? 'pending'] ??
                                                'secondary';
                                        @endphp
                                        <span class="badge bg-label-{{ $statusColor }}">
                                            {{ $application->applicationStatus->name ?? 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $application->created_at ? $application->created_at->format('d M, Y') : 'N/A' }}
                                        <br>
                                        <small
                                            class="text-muted">{{ $application->created_at ? $application->created_at->format('h:i A') : '' }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.applications.show', $application->id) }}"
                                                class="btn btn-icon btn-outline-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if (auth()->user()->isAdmin())
                                                <button class="btn btn-icon btn-outline-primary btn-sm notify-btn"
                                                    data-id="{{ $application->id }}" title="Send Notification">
                                                    <i class="fas fa-sms"></i>
                                                </button>

                                                <a href="{{ route('admin.sms-logs.index', ['student_detail_id' => $application->id]) }}"
                                                    class="btn btn-icon btn-outline-secondary btn-sm position-relative"
                                                    title="SMS History">
                                                    <i class="fas fa-history"></i>
                                                    @if (($application->sms_logs_count ?? 0) > 0)
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                            style="font-size:0.55rem;">
                                                            {{ $application->sms_logs_count }}
                                                        </span>
                                                    @endif
                                                </a>
                                            @endif
                                            @php
                                                $slug = $application->applicationStatus->slug ?? null;
                                                $me = auth()->user();
                                                $canAct = $me->isAdmin()
                                                    ? in_array($slug, [
                                                        \App\Models\StudentDetail::STATUS_PENDING,
                                                        \App\Models\StudentDetail::STATUS_APPROVED_BY_RM,
                                                        \App\Models\StudentDetail::STATUS_APPROVED_BY_WM,
                                                        \App\Models\StudentDetail::STATUS_REJECTED_BY_RM,
                                                        \App\Models\StudentDetail::STATUS_REJECTED_BY_WM,
                                                    ])
                                                    : ($me->isRegionalManager() &&
                                                            $slug === \App\Models\StudentDetail::STATUS_PENDING) ||
                                                        ($me->isWingManager() &&
                                                            in_array($slug, [
                                                                \App\Models\StudentDetail::STATUS_APPROVED_BY_RM,
                                                            ]));
                                            @endphp

                                            @if ($canAct)
                                                <button class="btn btn-icon btn-outline-success btn-sm approve-btn"
                                                    data-id="{{ $application->id }}" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-icon btn-outline-danger btn-sm reject-btn"
                                                    data-id="{{ $application->id }}" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                                <a href="{{ route('admin.qrcode.student.show', ['mobile' => $application?->user?->mobile]) }}"
                                                    target="_blank"
                                                    class="btn btn-icon btn-outline-dark btn-sm" title="QR Code">
                                                    <i class="fas fa-qrcode"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                            <h6 class="mb-0">No applications found</h6>
                                            <small class="text-muted">Try adjusting your filters</small>
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
                    Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }} of
                    {{ $applications->total() }} applications
                </div>
                <div>
                    {{ $applications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle text-success me-2"></i>Approve Application
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="approveForm">
                    <div class="modal-body">
                        <input type="hidden" id="approveApplicationId" name="application_id">
                        <div class="mb-3">
                            <label class="form-label">Remarks <small class="text-muted">(Optional)</small></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Add remarks if any..."></textarea>
                        </div>
                        @if (auth()->user()->isAdmin())
                            <div class="mb-0">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="approveSendSms" name="send_sms"
                                        value="1" checked>
                                    <label class="form-check-label" for="approveSendSms">
                                        <i class="fas fa-sms me-1"></i> Send SMS Notification
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Approve
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-times-circle text-danger me-2"></i>Reject Application
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm">
                    <div class="modal-body">
                        <input type="hidden" id="rejectApplicationId" name="application_id">
                        <div class="mb-3">
                            <label class="form-label">Remarks <span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Please provide reason for rejection..."
                                required></textarea>
                        </div>
                        @if (auth()->user()->isAdmin())
                            <div class="mb-0">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="rejectSendSms" name="send_sms"
                                        value="1" checked>
                                    <label class="form-check-label" for="rejectSendSms">
                                        <i class="fas fa-sms me-1"></i> Send SMS Notification
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i> Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div class="modal fade" id="notifyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sms text-primary me-2"></i>Send Notification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="notifyForm">
                    <div class="modal-body">
                        <input type="hidden" id="notifyApplicationId" name="application_id">
                        <div class="mb-3">
                            <label class="form-label">Message Type</label>
                            <select name="message_type" class="form-select" id="messageType">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="custom">Custom Message</option>
                            </select>
                        </div>
                        <div class="mb-3" id="customMessageGroup" style="display:none;">
                            <label class="form-label">Custom Message</label>
                            <textarea name="custom_msg" class="form-control" rows="3" placeholder="Enter custom message..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulk Approve Modal -->
    <div class="modal fade" id="bulkApproveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle text-success me-2"></i>Bulk Approve Applications
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="bulkApproveForm">
                    <div class="modal-body">
                        <p class="text-muted">You are about to approve <strong id="bulkApproveCount">0</strong>
                            applications.</p>
                        <div class="mb-3">
                            <label class="form-label">Remarks <small class="text-muted">(Optional)</small></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Add remarks if any..."></textarea>
                        </div>
                        <div class="mb-0">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="bulkApproveSendSms" name="send_sms"
                                    value="1" checked>
                                <label class="form-check-label" for="bulkApproveSendSms">
                                    <i class="fas fa-sms me-1"></i> Send SMS Notification
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Approve All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulk Reject Modal -->
    <div class="modal fade" id="bulkRejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-times-circle text-danger me-2"></i>Bulk Reject Applications
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="bulkRejectForm">
                    <div class="modal-body">
                        <p class="text-muted">You are about to reject <strong id="bulkRejectCount">0</strong>
                            applications.</p>
                        <div class="mb-3">
                            <label class="form-label">Remarks <span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Please provide reason for rejection..."
                                required></textarea>
                        </div>
                        <div class="mb-0">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="bulkRejectSendSms" name="send_sms"
                                    value="1">
                                <label class="form-check-label" for="bulkRejectSendSms">
                                    <i class="fas fa-sms me-1"></i> Send SMS Notification
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i> Reject All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulk Notify Modal -->
    <div class="modal fade" id="bulkNotifyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sms text-primary me-2"></i>Bulk Send Notification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="bulkNotifyForm">
                    <div class="modal-body">
                        <p class="text-muted">Sending notification to <strong id="bulkNotifyCount">0</strong>
                            applicants.</p>
                        <div class="mb-3">
                            <label class="form-label">Message Type</label>
                            <select name="message_type" class="form-select" id="bulkMessageType">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="custom">Custom Message</option>
                            </select>
                        </div>
                        <div class="mb-3" id="bulkCustomMessageGroup" style="display:none;">
                            <label class="form-label">Custom Message</label>
                            <textarea name="custom_msg" class="form-control" rows="3" placeholder="Enter custom message..."></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Remarks <small class="text-muted">(Optional)</small></label>
                            <textarea name="remarks" class="form-control" rows="2" placeholder="Add remarks for audit log..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Send to All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .avatar {
            position: relative;
            display: inline-block;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
        }

        .avatar-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.857rem;
        }

        .bg-label-primary {
            background-color: #e9e7fd;
            color: #696cff;
        }

        .bg-label-success {
            background-color: #e8fadf;
            color: #71dd37;
        }

        .bg-label-danger {
            background-color: #ffe0db;
            color: #ff3e1d;
        }

        .bg-label-warning {
            background-color: #fff2d6;
            color: #ffab00;
        }

        .bg-label-secondary {
            background-color: #e7e7e8;
            color: #8592a3;
        }

        .bg-label-info {
            background-color: #d0f0fd;
            color: #03c3ec;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .gap-1 {
            gap: 0.25rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        /* Sticky Table Header */
        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
            position: relative;
        }

        .table-responsive .table thead th {
            position: sticky;
            top: 0;
            background: #151616;
            z-index: 10;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* Ensure table header stays above table body when scrolling */
        .table-responsive .table thead {
            z-index: 10;
        }

        .table-responsive .table tbody tr td {
            vertical-align: middle;
        }

        /* Fix for border overlap with sticky header */
        .table-responsive .table thead th {
            border-bottom: 2px solid #080808;
        }

        /* Optional: Add a subtle shadow to the sticky header */
        .sticky-header th {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Fix for card-body padding when table is sticky */
        .card-body.p-0 .table-responsive {
            border-radius: 0;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

            // =====================================================
            // SELECT ALL / ROW CHECKBOX SYNC
            // =====================================================
            $('#selectAll').change(function() {
                $('.application-checkbox').prop('checked', $(this).prop('checked'));
                updateBulkButtons();
            });

            $(document).on('change', '.application-checkbox', function() {
                // Keep "select all" checkbox in sync when rows are unchecked individually
                var total = $('.application-checkbox').length;
                var checked = $('.application-checkbox:checked').length;
                $('#selectAll').prop('checked', total > 0 && total === checked);
                updateBulkButtons();
            });

            function updateBulkButtons() {
                var count = $('.application-checkbox:checked').length;
                $('#bulkApproveBtn, #bulkRejectBtn, #bulkNotifyBtn').prop('disabled', count === 0);
            }

            function getSelectedIds() {
                var ids = [];
                $('.application-checkbox:checked').each(function() {
                    ids.push($(this).val());
                });
                return ids;
            }

            // =====================================================
            // SINGLE APPROVE
            // =====================================================
            $(document).on('click', '.approve-btn', function() {
                var id = $(this).data('id');
                $('#approveApplicationId').val(id);
                $('#approveModal').modal('show');
            });

            $('#approveForm').submit(function(e) {
                e.preventDefault();
                var id = $('#approveApplicationId').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/approve',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#approveForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Processing...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        toastr.error(msg);
                    },
                    complete: function() {
                        $('#approveForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-check me-1"></i> Approve');
                        $('#approveModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // SINGLE REJECT
            // =====================================================
            $(document).on('click', '.reject-btn', function() {
                var id = $(this).data('id');
                $('#rejectApplicationId').val(id);
                $('#rejectModal').modal('show');
            });

            $('#rejectForm').submit(function(e) {
                e.preventDefault();
                var id = $('#rejectApplicationId').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/reject',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#rejectForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Processing...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        toastr.error(msg);
                    },
                    complete: function() {
                        $('#rejectForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-times me-1"></i> Reject');
                        $('#rejectModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // BULK APPROVE
            // =====================================================
            $('#bulkApproveBtn').click(function() {
                console.log('Bulk Approve button clicked');
                var ids = getSelectedIds();
                if (ids.length === 0) return;
                $('#bulkApproveCount').text(ids.length);
                $('#bulkApproveForm')[0].reset();
                $('#bulkApproveSendSms').prop('checked', true);
                $('#bulkApproveModal').modal('show');
            });

            $('#bulkApproveForm').submit(function(e) {
                e.preventDefault();
                var ids = getSelectedIds();

                if (ids.length === 0) {
                    toastr.warning('No applications selected.');
                    $('#bulkApproveModal').modal('hide');
                    return;
                }

                var data = {};
                $.each($(this).serializeArray(), function(_, field) {
                    data[field.name] = field.value;
                });
                data.application_ids = ids;


                $.ajax({
                    url: '{{ route('admin.applications.bulk-approve-multiple') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#bulkApproveForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Processing...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                toastr.error(messages[0]);
                            });
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                        }
                    },
                    complete: function() {
                        $('#bulkApproveForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-check me-1"></i> Approve All');
                        $('#bulkApproveModal').modal('hide');
                    }
                });
            });


            // =====================================================
            // BULK REJECT
            // =====================================================
            $('#bulkRejectBtn').click(function() {
                var ids = getSelectedIds();
                if (ids.length === 0) return;
                $('#bulkRejectCount').text(ids.length);
                $('#bulkRejectForm')[0].reset();
                $('#bulkRejectModal').modal('show');
            });

            $('#bulkRejectForm').submit(function(e) {
                e.preventDefault();
                var ids = getSelectedIds();

                if (ids.length === 0) {
                    toastr.warning('No applications selected.');
                    $('#bulkRejectModal').modal('hide');
                    return;
                }

                var data = {};
                $.each($(this).serializeArray(), function(_, field) {
                    data[field.name] = field.value;
                });
                data.application_ids = ids;

                $.ajax({
                    url: '{{ route('admin.applications.bulk-reject-multiple') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#bulkRejectForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Processing...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                toastr.error(messages[0]);
                                $('#' + field + '_error').text(messages[0]);
                            });
                        } else {
                            toastr.error('Something went wrong!');
                        }
                    },
                    complete: function() {
                        $('#bulkRejectForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-times me-1"></i> Reject All');
                        $('#bulkRejectModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // SINGLE NOTIFY
            // =====================================================
            $(document).on('click', '.notify-btn', function() {
                var id = $(this).data('id');
                $('#notifyApplicationId').val(id);
                $('#notifyForm')[0].reset();
                $('#customMessageGroup').hide();
                $('#notifyModal').modal('show');
            });

            $('#messageType').change(function() {
                if ($(this).val() === 'custom') {
                    $('#customMessageGroup').show();
                } else {
                    $('#customMessageGroup').hide();
                }
            });

            $('#notifyForm').submit(function(e) {
                e.preventDefault();
                var id = $('#notifyApplicationId').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/notify',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#notifyForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Sending...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        toastr.error(msg);
                    },
                    complete: function() {
                        $('#notifyForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-paper-plane me-1"></i> Send');
                        $('#notifyModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // BULK NOTIFY
            // =====================================================
            $('#bulkNotifyBtn').click(function() {
                var ids = getSelectedIds();
                if (ids.length === 0) return;
                $('#bulkNotifyCount').text(ids.length);
                $('#bulkNotifyForm')[0].reset();
                $('#bulkCustomMessageGroup').hide();
                $('#bulkNotifyModal').modal('show');
            });

            $('#bulkMessageType').change(function() {
                $('#bulkCustomMessageGroup').toggle($(this).val() === 'custom');
            });

            $('#bulkNotifyForm').submit(function(e) {
                e.preventDefault();
                var ids = getSelectedIds();

                if (ids.length === 0) {
                    toastr.warning('No applications selected.');
                    $('#bulkNotifyModal').modal('hide');
                    return;
                }

                var data = {};
                $.each($(this).serializeArray(), function(_, field) {
                    data[field.name] = field.value;
                });
                data.application_ids = ids;

                $.ajax({
                    url: '{{ route('admin.applications.bulk-notify-multiple') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#bulkNotifyForm button[type="submit"]').prop('disabled', true)
                            .html(
                                '<span class="spinner-border spinner-border-sm me-1"></span> Sending...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            // Prevent accidental double-send to the same batch
                            $('.application-checkbox, #selectAll').prop('checked', false);
                            updateBulkButtons();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                toastr.error(messages[0]);
                            });
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                        }
                    },
                    complete: function() {
                        $('#bulkNotifyForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-paper-plane me-1"></i> Send to All');
                        $('#bulkNotifyModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // DEPENDENT DISTRICT DROPDOWN (FILTER FORM)
            // =====================================================
            $('#divisionFilter').change(function() {
                var divisionId = $(this).val();
                if (divisionId) {
                    $.ajax({
                        url: '{{ url('api/districts') }}/' + divisionId,
                        type: 'GET',
                        success: function(data) {
                            var $district = $('#districtFilter');
                            $district.empty().append('<option value="">All Districts</option>');
                            $.each(data, function(key, value) {
                                $district.append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush