@extends('backend.layouts.admin-template.main')

@section('title', 'Student Applications')
@section('main-content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h4 class="mb-0">{{ $page_content['page_title'] ?? 'Applications' }}</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $page_content['module_name'] ?? 'Applications' }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('admin.applications.export', request()->query()) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Summary Cards -->
        <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $counts['total'] ?? 0 }}</h3>
                        <p>Total Applications</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="{{ route('admin.applications.index', ['status' => 'all']) }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $counts['pending'] ?? 0 }}</h3>
                        <p>Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $counts['approved'] ?? 0 }}</h3>
                        <p>Approved</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="{{ route('admin.applications.index', ['status' => 'approved']) }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $counts['rejected'] ?? 0 }}</h3>
                        <p>Rejected</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <a href="{{ route('admin.applications.index', ['status' => 'rejected']) }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Applications</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.applications.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name, email, phone..." value="{{ $filters['search'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ isset($filters['status']) && $filters['status'] == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Board</label>
                                <select name="board" class="form-control">
                                    <option value="">All Boards</option>
                                    @foreach ($boards as $board)
                                        <option value="{{ $board->id }}"
                                            {{ isset($filters['board']) && $filters['board'] == $board->id ? 'selected' : '' }}>
                                            {{ $board->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Division</label>
                                <select name="division" class="form-control" id="divisionFilter">
                                    <option value="">All Divisions</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ isset($filters['division']) && $filters['division'] == $division->id ? 'selected' : '' }}>
                                            {{ $division->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>District</label>
                                <select name="district" class="form-control" id="districtFilter">
                                    <option value="">All Districts</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ isset($filters['district']) && $filters['district'] == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Per Page</label>
                                <select name="per_page" class="form-control">
                                    @foreach ([10, 20, 50, 100] as $count)
                                        <option value="{{ $count }}"
                                            {{ isset($filters['per_page']) && $filters['per_page'] == $count ? 'selected' : '' }}>
                                            {{ $count }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Applications List</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success" id="bulkApproveBtn" disabled>
                            <i class="fas fa-check"></i> Approve Selected
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" id="bulkRejectBtn" disabled>
                            <i class="fas fa-times"></i> Reject Selected
                        </button>
                        <button type="button" class="btn btn-sm btn-info" id="bulkNotifyBtn" disabled>
                            <i class="fas fa-sms"></i> Notify Selected
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>SL</th>
                            <th>Student</th>
                            <th>Contact</th>
                            <th>Board</th>
                            <th>Division</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $index => $application)
                            <tr>
                                <td>
                                    <input type="checkbox" class="application-checkbox" value="{{ $application->id }}">
                                </td>
                                <td>{{ $applications->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $application->student_name ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">ID: {{ $application->student_id ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <i class="fas fa-phone"></i> {{ $application->phone ?? 'N/A' }}
                                    <br>
                                    <i class="fas fa-envelope"></i> {{ $application->email ?? 'N/A' }}
                                </td>
                                <td>{{ $application->board->name ?? 'N/A' }}</td>
                                <td>{{ $application->division->name ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statusColor =
                                            [
                                                'pending' => 'warning',
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                            ][$application->applicationStatus->slug ?? 'pending'] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $statusColor }}">
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
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.applications.show', $application->id) }}"
                                            class="btn btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($application->application_status_id == 1)
                                            <button class="btn btn-success approve-btn" data-id="{{ $application->id }}"
                                                title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-danger reject-btn" data-id="{{ $application->id }}"
                                                title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-primary notify-btn" data-id="{{ $application->id }}"
                                            title="Send Notification">
                                            <i class="fas fa-sms"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }}
                        of {{ $applications->total() }} entries
                    </div>
                    <div>
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Application</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="approveForm">
                    <div class="modal-body">
                        <input type="hidden" id="approveApplicationId" name="application_id">
                        <div class="form-group">
                            <label>Remarks (Optional)</label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Add remarks if any..."></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="approveSendSms" name="send_sms"
                                    value="1" checked>
                                <label class="custom-control-label" for="approveSendSms">
                                    Send SMS Notification
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Approve</button>
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
                    <h5 class="modal-title">Reject Application</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="rejectForm">
                    <div class="modal-body">
                        <input type="hidden" id="rejectApplicationId" name="application_id">
                        <div class="form-group">
                            <label>Remarks <span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Please provide reason for rejection..."
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="rejectSendSms" name="send_sms"
                                    value="1" checked>
                                <label class="custom-control-label" for="rejectSendSms">
                                    Send SMS Notification
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
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
                    <h5 class="modal-title">Send Notification</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="notifyForm">
                    <div class="modal-body">
                        <input type="hidden" id="notifyApplicationId" name="application_id">
                        <div class="form-group">
                            <label>Message Type</label>
                            <select name="message_type" class="form-control" id="messageType">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="custom">Custom Message</option>
                            </select>
                        </div>
                        <div class="form-group" id="customMessageGroup" style="display:none;">
                            <label>Custom Message</label>
                            <textarea name="custom_msg" class="form-control" rows="3" placeholder="Enter custom message..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control" rows="2" placeholder="Add remarks..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send</button>
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
                    <h5 class="modal-title">Bulk Reject Applications</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="bulkRejectForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Remarks <span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Please provide reason for rejection..."
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="bulkRejectSendSms"
                                    name="send_sms" value="1">
                                <label class="custom-control-label" for="bulkRejectSendSms">
                                    Send SMS Notification
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .small-box {
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            position: relative;
            display: block;
            margin-bottom: 20px;
            padding: 15px;
        }

        .small-box .inner {
            padding: 10px 0;
        }

        .small-box .icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 70px;
            opacity: 0.3;
            color: #fff;
        }

        .btn-group-sm .btn {
            margin: 0 2px;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            // =====================================================
            // SELECT ALL CHECKBOX
            // =====================================================
            $('#selectAll').change(function() {
                $('.application-checkbox').prop('checked', $(this).prop('checked'));
                updateBulkButtons();
            });

            $('.application-checkbox').change(function() {
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
                            .html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#approveForm button[type="submit"]').prop('disabled', false)
                            .html('Approve');
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
                            .html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#rejectForm button[type="submit"]').prop('disabled', false)
                            .html('Reject');
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

                if (!confirm('Approve ' + ids.length + ' applications?')) return;

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
                            .html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#bulkApproveBtn').html(
                                '<i class="fas fa-check"></i> Approve Selected')
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
                            .html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#bulkRejectForm button[type="submit"]').prop('disabled', false)
                            .html('Reject All');
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
                            .html('<i class="fas fa-spinner fa-spin"></i> Sending...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#notifyForm button[type="submit"]').prop('disabled', false)
                            .html('Send');
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
                    showToast('warning', 'Message cannot be empty!');
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
                            .html('<i class="fas fa-spinner fa-spin"></i> Sending...');
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON?.message || 'Something went wrong!';
                        showToast('error', msg);
                    },
                    complete: function() {
                        $('#bulkNotifyBtn').html('<i class="fas fa-sms"></i> Notify Selected')
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

            function showToast(type, message) {
                var bg = type === 'success' ? 'bg-success' :
                    type === 'error' ? 'bg-danger' :
                    type === 'warning' ? 'bg-warning' : 'bg-info';

                var toast = $(
                    '<div class="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999;" data-delay="5000">' +
                    '<div class="toast-header ' + bg + ' text-white">' +
                    '<strong class="mr-auto">Notification</strong>' +
                    '<button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>' +
                    '</div>' +
                    '<div class="toast-body">' + message + '</div>' +
                    '</div>');

                $('body').append(toast);
                toast.toast('show');

                setTimeout(function() {
                    toast.remove();
                }, 5000);
            }

            // Dynamic district loading based on division
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
