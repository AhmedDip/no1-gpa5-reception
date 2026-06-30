@extends('backend.layouts.admin-template.main')

@section('title', 'Student Applications')
@section('main-content')
    <div class="container-fluid456456">
        <!-- Status Cards -->
        <div class="row mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Applications</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $counts['total'] ?? 0 }}</h4>
                                    <small class="text-success">(Total Applications)</small>
                                </div>
                                <small>All applications</small>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Pending</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $counts['pending'] ?? 0 }}</h4>
                                    <small class="text-warning">(Pending)</small>
                                </div>
                                <small>Awaiting review</small>
                            </div>
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="fas fa-clock fa-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Approved</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $counts['approved'] ?? 0 }}</h4>
                                    <small class="text-success">(Approved)</small>
                                </div>
                                <small>Approved applications</small>
                            </div>
                            <span class="badge bg-label-success rounded p-2">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Rejected</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h4 class="mb-0 me-2">{{ $counts['rejected'] ?? 0 }}</h4>
                                    <small class="text-danger">(Rejected)</small>
                                </div>
                                <small>Rejected applications</small>
                            </div>
                            <span class="badge bg-label-danger rounded p-2">
                                <i class="fas fa-times-circle fa-lg"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Filter Applications
                </h5>
                <a href="{{ route('admin.applications.export', request()->query()) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-1"></i> Export
                </a>
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <label class="form-label">District</label>
                            <select name="district" class="form-select" id="districtFilter">
                                <option value="">All Districts</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ isset($filters['district']) && $filters['district'] == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Applications List
                </h5>
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>#</th>
                                <th>Student</th>
                                <th>Contact</th>
                                <th>Board</th>
                                <th>Division</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $index => $application)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input application-checkbox"
                                            value="{{ $application->id }}">
                                    </td>
                                    <td>{{ $applications->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                {{-- <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($application->name_en ?? 'N/A', 0, 1)) }}
                                                </span> --}}
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    @if ($application->student_photo)
                                                        <img src="{{ asset('storage/' . $application->student_photo) }}"
                                                            alt="Student Photo" class="rounded-circle" width="40"
                                                            height="40">
                                                    @else
                                                        {{ strtoupper(substr($application->name_en ?? 'N/A', 0, 1)) }}
                                                    @endif
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $application->name_bn ?? 'N/A' }}</h6>
                                                <small class="text-muted">Result:
                                                    {{ $application?->gpa_result ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <small><i
                                                    class="fas fa-phone me-1"></i>{{ $application?->user?->mobile ?? 'N/A' }}</small>
                                            <br>
                                            <small><i
                                                    class="fas fa-envelope me-1"></i>{{ $application?->user?->email ?? 'N/A' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $application->board->name ?? 'N/A' }}</td>
                                    <td>{{ $application->division->name ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
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
                                    <td>
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
                                            @if ($application->application_status_id == 1)
                                                <button class="btn btn-icon btn-outline-success btn-sm approve-btn"
                                                    data-id="{{ $application->id }}" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-icon btn-outline-danger btn-sm reject-btn"
                                                    data-id="{{ $application->id }}" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                            <button class="btn btn-icon btn-outline-primary btn-sm notify-btn"
                                                data-id="{{ $application->id }}" title="Send Notification">
                                                <i class="fas fa-sms"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
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
                    <small class="text-muted">
                        Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }}
                        of {{ $applications->total() }} entries
                    </small>
                </div>
                <div>
                    {{ $applications->links() }}
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
                        <div class="mb-0">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="approveSendSms" name="send_sms"
                                    value="1" checked>
                                <label class="form-check-label" for="approveSendSms">
                                    <i class="fas fa-sms me-1"></i> Send SMS Notification
                                </label>
                            </div>
                        </div>
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
                        <div class="mb-0">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="rejectSendSms" name="send_sms"
                                    value="1" checked>
                                <label class="form-check-label" for="rejectSendSms">
                                    <i class="fas fa-sms me-1"></i> Send SMS Notification
                                </label>
                            </div>
                        </div>
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
                        <div class="mb-0">
                            <label class="form-label">Remarks <small class="text-muted">(Optional)</small></label>
                            <textarea name="remarks" class="form-control" rows="2" placeholder="Add remarks..."></textarea>
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
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            // =====================================================
            // SELECT ALL
            // =====================================================
            $('#selectAll').change(function() {
                $('.application-checkbox').prop('checked', $(this).prop('checked'));
                updateBulkButtons();
            });

            $(document).on('change', '.application-checkbox', function() {
                updateBulkButtons();
            });

            function updateBulkButtons() {
                var count = $('.application-checkbox:checked').length;
                $('#bulkApproveBtn, #bulkRejectBtn, #bulkNotifyBtn').prop('disabled', count === 0);
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
                var ids = getSelectedIds();
                if (ids.length === 0) return;

                if (!confirm('Are you sure you want to approve ' + ids.length + ' applications?')) return;

                $.ajax({
                    url: '{{ route('admin.applications.bulk-approve') }}',
                    type: 'POST',
                    data: {
                        application_ids: ids,
                        send_sms: 1
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#bulkApproveBtn').prop('disabled', true)
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
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        toastr.error(msg);
                    },
                    complete: function() {
                        $('#bulkApproveBtn').html('<i class="fas fa-check me-1"></i> Approve')
                            .prop('disabled', false);
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
                $('#bulkRejectModal').modal('show');
            });

            $('#bulkRejectForm').submit(function(e) {
                e.preventDefault();
                var ids = getSelectedIds();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('admin.applications.bulk-reject') }}',
                    type: 'POST',
                    data: formData + '&application_ids=' + JSON.stringify(ids),
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
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        toastr.error(msg);
                    },
                    complete: function() {
                        $('#bulkRejectForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-times me-1"></i> Reject All');
                        $('#bulkRejectModal').modal('hide');
                    }
                });
            });

            // =====================================================
            // NOTIFICATION
            // =====================================================
            $(document).on('click', '.notify-btn', function() {
                var id = $(this).data('id');
                $('#notifyApplicationId').val(id);
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

                var msg = prompt('Enter custom message to send to ' + ids.length + ' applicants:', '');
                if (msg === null) return;

                if (msg.trim() === '') {
                    toastr.warning('Message cannot be empty!');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.applications.bulk-notify') }}',
                    type: 'POST',
                    data: {
                        application_ids: ids,
                        message_type: 'custom',
                        custom_msg: msg
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#bulkNotifyBtn').prop('disabled', true)
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
                        $('#bulkNotifyBtn').html('<i class="fas fa-sms me-1"></i> Notify')
                            .prop('disabled', false);
                    }
                });
            });

            // =====================================================
            // HELPER FUNCTIONS
            // =====================================================
            function getSelectedIds() {
                var ids = [];
                $('.application-checkbox:checked').each(function() {
                    ids.push($(this).val());
                });
                return ids;
            }

            // Dynamic district loading
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
