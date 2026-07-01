@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'SMS Logs')

@push('styles')
<style>
    .avatar { width: 32px; height: 32px; flex-shrink: 0; }
    .avatar-initial { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; border-radius: 50%; }
    .bg-label-primary { background-color: #e9e7fd; color: #696cff; }
    .bg-label-success { background-color: #e8fadf; color: #71dd37; }
    .bg-label-danger  { background-color: #ffe0db; color: #ff3e1d; }
    .bg-label-warning { background-color: #fff2d6; color: #ffab00; }
    .bg-label-secondary { background-color: #e7e7e8; color: #8592a3; }
    .msg-preview { max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; vertical-align: middle; }
</style>
@endpush

@section('main-content')

@if($driver !== 'twilio')
    <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
        <i class="fas fa-flask fa-lg me-3"></i>
        <div>
            <strong>Test Mode — driver: <code>{{ $driver }}</code></strong><br>
            <small>No real SMS is being sent right now. Every approve/reject/notify action is being logged here for free, exactly as it would look in production. Set <code>SMS_DRIVER=twilio</code> in your <code>.env</code> when you're ready to go live.</small>
        </div>
    </div>
@endif

@if($filteredStudent)
    <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
        <span>
            <i class="fas fa-filter me-2"></i>
            Showing SMS history for <strong>{{ $filteredStudent->name_bn ?? $filteredStudent->name_en }}</strong>
            ({{ $filteredStudent->user->mobile ?? 'N/A' }})
        </span>
        <a href="{{ route('admin.sms-logs.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-times me-1"></i> Clear
        </a>
    </div>
@endif

<div class="row mb-4">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span>Total Sent Attempts</span>
                    <h4 class="mb-0 mt-1">{{ $counts['total'] ?? 0 }}</h4>
                </div>
                <span class="badge bg-label-primary rounded p-2"><i class="fas fa-sms fa-lg"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span>Sent</span>
                    <h4 class="mb-0 mt-1">{{ $counts['sent'] ?? 0 }}</h4>
                </div>
                <span class="badge bg-label-success rounded p-2"><i class="fas fa-check-circle fa-lg"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span>Failed</span>
                    <h4 class="mb-0 mt-1">{{ $counts['failed'] ?? 0 }}</h4>
                </div>
                <span class="badge bg-label-danger rounded p-2"><i class="fas fa-times-circle fa-lg"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter</h5>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
        </a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.sms-logs.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Name or mobile..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    @foreach(['approved', 'rejected', 'custom'] as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5 class="mb-0"><i class="fas fa-list me-2"></i>SMS / Notification History</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Driver</th>
                        <th>Sent By</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $i => $log)
                        @php
                            $typeColor = ['approved' => 'success', 'rejected' => 'danger', 'custom' => 'primary'][$log->type] ?? 'secondary';
                            $statusColor = $log->status === 'sent' ? 'success' : 'danger';
                        @endphp
                        <tr>
                            <td>{{ $logs->firstItem() + $i }}</td>
                            <td>
                                @if($log->studentDetail)
                                    <a href="{{ route('admin.sms-logs.index', ['student_detail_id' => $log->studentDetail->id]) }}">
                                        {{ $log->studentDetail->name_bn ?? $log->studentDetail->name_en }}
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td style="font-family:monospace;">{{ $log->mobile }}</td>
                            <td><span class="badge bg-label-{{ $typeColor }}">{{ ucfirst($log->type) }}</span></td>
                            <td>
                                <span class="msg-preview" title="{{ $log->message }}">{{ \Illuminate\Support\Str::limit($log->message, 40) }}</span>
                            </td>
                            <td><span class="badge bg-label-{{ $statusColor }}">{{ ucfirst($log->status) }}</span></td>
                            <td><span class="badge bg-label-secondary">{{ $log->driver }}</span></td>
                            <td>{{ $log->sentBy->name ?? 'System' }}</td>
                            <td style="font-size:0.8rem;">{{ $log->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#messageModal"
                                    data-message="{{ $log->message }}"
                                    data-response="{{ $log->response }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                No SMS logs found yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} entries
        </small>
        {{ $logs->links() }}
    </div>
</div>

<!-- Full Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-comment-alt me-2"></i>Full Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-1 fw-semibold">Message:</p>
                <pre id="modalMessage" style="white-space:pre-wrap; font-family:inherit;"></pre>
                <p class="mb-1 fw-semibold mt-3">Provider Response:</p>
                <p id="modalResponse" class="text-muted small"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.getElementById('messageModal').addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        document.getElementById('modalMessage').textContent = btn.getAttribute('data-message');
        document.getElementById('modalResponse').textContent = btn.getAttribute('data-response') || '—';
    });
</script>
@endpush
