@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Application Detail')

@section('main-content')
    @php
        $slug = $application->applicationStatus->slug ?? null;
        $me = auth()->user();

        $canAct = $me->isAdmin()
            ? in_array($slug, [
                \App\Models\StudentDetail::STATUS_PENDING,
                \App\Models\StudentDetail::STATUS_APPROVED_BY_RM,
                \App\Models\StudentDetail::STATUS_APPROVED_BY_WM,
            ])
            : ($me->isRegionalManager() && $slug === \App\Models\StudentDetail::STATUS_PENDING) ||
                ($me->isWingManager() && $slug === \App\Models\StudentDetail::STATUS_APPROVED_BY_RM);

        $statusColors = [
            'pending'        => 'warning',
            'approved_by_rm' => 'info',
            'approved_by_wm' => 'primary',
            'approved'       => 'success',
            'rejected'       => 'danger',
        ];
        $statusColor = $statusColors[$slug] ?? 'secondary';
    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
        </a>
        <a href="{{ route('admin.sms-logs.index', ['student_detail_id' => $application->id]) }}"
            class="btn btn-outline-info btn-sm">
            <i class="fas fa-history me-1"></i> SMS History
            @if ($application->smsLogs->count() > 0)
                <span class="badge bg-label-secondary ms-1">{{ $application->smsLogs->count() }}</span>
            @endif
        </a>
    </div>

    <div class="row">
        <!-- ===================== LEFT: STUDENT INFO ===================== -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3 flex-wrap">
                        <img src="{{ $application->student_photo_url }}" alt="Student Photo"
                            class="rounded-circle" width="90" height="90" style="object-fit:cover;">

                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <h4 class="mb-0">{{ $application->name_en ?? 'N/A' }}</h4>
                                <span class="badge bg-label-{{ $statusColor }}">
                                    {{ $application->applicationStatus->name ?? 'Pending' }}
                                </span>
                            </div>
                            <p class="text-muted mb-1">{{ $application->name_bn }}</p>
                            <small class="text-muted">
                                <i class="fas fa-phone me-1"></i>{{ $application?->user?->mobile ?? 'N/A' }}
                                @if ($application?->user?->email)
                                    &nbsp;|&nbsp; <i class="fas fa-envelope me-1"></i>{{ $application?->user?->email }}
                                @endif
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>Submitted:
                                {{ $application?->created_at?->format('d M Y, h:i A') }}
                                ({{ $application?->created_at?->diffForHumans() }})
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Academic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">SSC Board</small>
                            <strong>{{ $application?->board?->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Group</small>
                            <strong>{{ $application?->group?->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">GPA / Result</small>
                            <strong class="text-success">{{ $application?->gpa_result }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Roll Number</small>
                            <strong style="font-family:monospace;">{{ $application?->roll_number }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Registration Number</small>
                            <strong style="font-family:monospace;">{{ $application?->registration_number }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Address</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Division</small>
                            <strong>{{ $application?->division?->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">District</small>
                            <strong>{{ $application?->district?->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Upazila</small>
                            <strong>{{ $application?->upazila?->name ?? 'N/A' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Parent Information</h5>
                    @if (!$application?->is_parent_info_provided)
                        <span class="badge bg-label-warning">Not Provided</span>
                    @endif
                </div>
                @if ($application?->is_parent_info_provided)
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block">Father's Name</small>
                                <strong>{{ $application?->father_name }}</strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Mother's Name</small>
                                <strong>{{ $application?->mother_name }}</strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Parent's Mobile</small>
                                <strong>{{ $application?->parent_mobile }}</strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Tea Stall Name</small>
                                <strong>{{ $application?->tea_stall_name }}</strong>
                            </div>
                            <div class="col-md-12">
                                <small class="text-muted d-block">Tea Stall Location</small>
                                <strong>{{ $application?->tea_stall_location }}</strong>
                            </div>
                            @if ($application?->parent_photo)
                                <div class="col-md-12">
                                    <small class="text-muted d-block mb-1">Parent's Photo</small>
                                    <img src="{{ $application?->parent_photo_url }}" alt="Parent Photo"
                                        class="rounded" width="100" height="100" style="object-fit:cover;">
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card-body text-muted small">
                        Parent information has not been submitted by the student yet.
                    </div>
                @endif
            </div>

            <!-- Audit Log Timeline -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Activity Timeline</h5>
                </div>
                <div class="card-body">
                    @forelse ($application?->auditLogs as $log)
                        <div class="d-flex gap-3 pb-3 mb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="flex-shrink-0">
                                <span class="badge bg-label-secondary rounded-circle p-2">
                                    <i class="fas fa-clock"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between flex-wrap gap-1">
                                    <strong class="text-capitalize">{{ str_replace('_', ' ', $log->action) }}</strong>
                                    <small class="text-muted">{{ $log->created_at->format('d M Y, h:i A') }}</small>
                                </div>
                                <div class="small text-muted">
                                    By {{ $log->performedBy->name ?? 'System' }}
                                    @if ($log->previousStatus || $log->newStatus)
                                        &mdash;
                                        {{ $log->previousStatus->name ?? 'N/A' }}
                                        <i class="fas fa-arrow-right mx-1"></i>
                                        {{ $log->newStatus->name ?? 'N/A' }}
                                    @endif
                                </div>
                                @if ($log->remarks)
                                    <div class="small mt-1">"{{ $log->remarks }}"</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center mb-0 py-3">No activity recorded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ===================== RIGHT: STATUS & ACTIONS ===================== -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Current Status</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <span class="badge bg-label-{{ $statusColor }} p-2 px-3" style="font-size:0.95rem;">
                            {{ $application->applicationStatus->name ?? 'Pending' }}
                        </span>
                    </div>

                    @if ($application->rmReviewer)
                        <div class="detail-row d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted small">RM Reviewed By</span>
                            <strong class="small">{{ $application->rmReviewer->name }}</strong>
                        </div>
                        <div class="detail-row d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted small">RM Reviewed At</span>
                            <span class="small">{{ $application->rm_reviewed_at?->format('d M Y, h:i A') }}</span>
                        </div>
                    @endif

                    @if ($application->wmReviewer)
                        <div class="detail-row d-flex justify-content-between border-bottom py-2">
                            <span class="text-muted small">WM Reviewed By</span>
                            <strong class="small">{{ $application->wmReviewer->name }}</strong>
                        </div>
                        <div class="detail-row d-flex justify-content-between py-2">
                            <span class="text-muted small">WM Reviewed At</span>
                            <span class="small">{{ $application->wm_reviewed_at?->format('d M Y, h:i A') }}</span>
                        </div>
                    @endif

                    @if (!$application->rmReviewer && !$application->wmReviewer)
                        <p class="text-muted small text-center mb-0 py-2">No manager review yet.</p>
                    @endif
                </div>
            </div>

            @if ($canAct)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body d-grid gap-2">
                        <button type="button" class="btn btn-success approve-btn" data-id="{{ $application->id }}">
                            <i class="fas fa-check me-1"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger reject-btn" data-id="{{ $application->id }}">
                            <i class="fas fa-times me-1"></i> Reject
                        </button>
                    </div>
                </div>
            @endif

            @if ($me->isAdmin())
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-sms me-2"></i>Notify Student</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-primary w-100 notify-btn"
                            data-id="{{ $application->id }}">
                            <i class="fas fa-paper-plane me-1"></i> Send Notification
                        </button>
                    </div>
                </div>
            @endif

            <!-- Recent SMS Logs -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-comment-dots me-2"></i>Recent SMS</h5>
                    <a href="{{ route('admin.sms-logs.index', ['student_detail_id' => $application->id]) }}"
                        class="small text-decoration-none">View all</a>
                </div>
                <div class="card-body">
                    @forelse ($application->smsLogs->take(5) as $log)
                        @php
                            $typeColor = ['approved' => 'success', 'rejected' => 'danger', 'custom' => 'primary'][$log->type] ?? 'secondary';
                            $statColor = $log->status === 'sent' ? 'success' : 'danger';
                        @endphp
                        <div class="d-flex justify-content-between align-items-start pb-2 mb-2 border-bottom">
                            <div>
                                <span class="badge bg-label-{{ $typeColor }}">{{ ucfirst($log->type) }}</span>
                                <div class="small text-muted mt-1">{{ $log->created_at->format('d M, h:i A') }}</div>
                            </div>
                            <span class="badge bg-label-{{ $statColor }}">{{ ucfirst($log->status) }}</span>
                        </div>
                    @empty
                        <p class="text-muted small text-center mb-0 py-2">No SMS sent yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-check-circle text-success me-2"></i>Approve Application</h5>
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
                        <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i> Approve</button>
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
                    <h5 class="modal-title"><i class="fas fa-times-circle text-danger me-2"></i>Reject Application</h5>
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
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times me-1"></i> Reject</button>
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
                    <h5 class="modal-title"><i class="fas fa-sms text-primary me-2"></i>Send Notification</h5>
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-label-primary { background-color: #e9e7fd; color: #696cff; }
        .bg-label-success { background-color: #e8fadf; color: #71dd37; }
        .bg-label-danger  { background-color: #ffe0db; color: #ff3e1d; }
        .bg-label-warning { background-color: #fff2d6; color: #ffab00; }
        .bg-label-info    { background-color: #d9f2ff; color: #03c3ec; }
        .bg-label-secondary { background-color: #e7e7e8; color: #8592a3; }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            // ===================== APPROVE =====================
            $('.approve-btn').click(function() {
                $('#approveApplicationId').val($(this).data('id'));
                $('#approveModal').modal('show');
            });

            $('#approveForm').submit(function(e) {
                e.preventDefault();
                var id = $('#approveApplicationId').val();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/approve',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function() {
                        $('#approveForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm me-1"></span> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    },
                    complete: function() {
                        $('#approveForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-check me-1"></i> Approve');
                        $('#approveModal').modal('hide');
                    }
                });
            });

            // ===================== REJECT =====================
            $('.reject-btn').click(function() {
                $('#rejectApplicationId').val($(this).data('id'));
                $('#rejectModal').modal('show');
            });

            $('#rejectForm').submit(function(e) {
                e.preventDefault();
                var id = $('#rejectApplicationId').val();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/reject',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function() {
                        $('#rejectForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm me-1"></span> Processing...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    },
                    complete: function() {
                        $('#rejectForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-times me-1"></i> Reject');
                        $('#rejectModal').modal('hide');
                    }
                });
            });

            // ===================== NOTIFY =====================
            $('.notify-btn').click(function() {
                $('#notifyApplicationId').val($(this).data('id'));
                $('#notifyModal').modal('show');
            });

            $('#messageType').change(function() {
                $('#customMessageGroup').toggle($(this).val() === 'custom');
            });

            $('#notifyForm').submit(function(e) {
                e.preventDefault();
                var id = $('#notifyApplicationId').val();

                $.ajax({
                    url: '{{ url('admin/applications') }}/' + id + '/notify',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function() {
                        $('#notifyForm button[type="submit"]').prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm me-1"></span> Sending...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 1200);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    },
                    complete: function() {
                        $('#notifyForm button[type="submit"]').prop('disabled', false)
                            .html('<i class="fas fa-paper-plane me-1"></i> Send');
                        $('#notifyModal').modal('hide');
                    }
                });
            });
        });
    </script>
@endpush
