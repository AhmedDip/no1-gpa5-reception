@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Upazila Manager Assignments')

@section('main-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="bx bx-map-pin me-1"></i> Upazila Manager Assignments</h5>
        <button type="button" class="btn btn-primary btn-sm" id="btnAddAssignment">
            <i class="fas fa-plus me-1"></i> New Assignment
        </button>
    </div>

    {{-- Filter --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filter</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.upazila-manager-assignments.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Upazila name or staff ID..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Assigned Manager</label>
                    <select name="user_id" class="form-select f-select2">
                        <option value="">All Managers</option>
                        @foreach ($staffUsers as $staff)
                            <option value="{{ $staff->id }}" {{ request('user_id') == $staff->id ? 'selected' : '' }}>
                                {{ $staff->name }} - {{ $staff->email }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Per Page</label>
                    <select name="per_page" class="form-select">
                        @foreach ([100, 200, 300, 500] as $count)
                            <option value="{{ $count }}" {{ request('per_page', 20) == $count ? 'selected' : '' }}>
                                {{ $count }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Filter
                    </button>
                </div>
                <div class="col-12">
                    <a href="{{ route('admin.upazila-manager-assignments.index') }}"
                        class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Assignments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Staff ID</th>
                            <th>Assigned Manager</th>
                            <th>Reports To</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignments as $i => $row)
                            <tr>
                                <td>{{ $assignments->firstItem() + $i }}</td>
                                <td>{{ $row->division_name }}</td>
                                <td>{{ $row->district_name }}</td>
                                <td>
                                    {{ $row->upazila_name }}
                                    <br><small class="text-muted" style="font-family:monospace;">ID:
                                        {{ $row->upazila_id }}</small>
                                </td>
                                <td style="font-family:monospace;">{{ $row->staff_id ?: '—' }}</td>
                                <td>
                                    @if ($row->manager)
                                        {{ $row->manager->name }}
                                        <br>
                                        <span
                                            class="badge bg-label-{{ $row->manager->isRegionalManager() ? 'info' : 'primary' }}">
                                            {{ $row->manager->isRegionalManager() ? 'Regional Manager' : 'Wing Manager' }}
                                        </span>
                                    @else
                                        <span class="badge bg-label-danger">Unassigned</span>
                                    @endif
                                </td>
                                {{-- <td>{{ $row->manager?->manager?->name ?? '—' }}</td> --}}
                                <td>
                                    {{ $row->manager?->manager?->name }} ({{ $row->manager?->manager?->email ?? '—' }})
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-icon btn-outline-warning btn-sm btn-edit-assignment"
                                        data-id="{{ $row->id }}" data-upazila-id="{{ $row->upazila_id }}"
                                        data-user-id="{{ $row->user_id }}" data-staff-id="{{ $row->staff_id }}"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-icon btn-outline-danger btn-sm btn-delete-assignment"
                                        data-id="{{ $row->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                    No assignments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                Showing {{ $assignments->firstItem() ?? 0 }} to {{ $assignments->lastItem() ?? 0 }} of
                {{ $assignments->total() }} entries
            </div>
            <div>
                {{ $assignments->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    <div class="modal fade" id="assignmentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignmentModalTitle">New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="assignmentForm">
                    @csrf
                    <input type="hidden" name="_method" id="assignmentMethod" value="POST">
                    <input type="hidden" id="assignmentId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Upazila <span class="text-danger">*</span></label>
                            <select name="upazila_id" id="upazila_id" class="form-select select2" required>
                                <option value="">নির্বাচন করুন</option>
                                @foreach ($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-error="upazila_id"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assigned Manager</label>
                            <select name="user_id" id="user_id" class="form-select select2">
                                <option value="">— Unassigned —</option>
                                @foreach ($staffUsers as $staff)
                                    <option value="{{ $staff->id }}" data-staff-email="{{ $staff->email }}">
                                        {{ $staff->name }} ({{ $staff->isRegionalManager() ? 'RM' : 'WM' }})
                                        @if ($staff->manager)
                                            — reports to {{ $staff->manager->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" data-error="user_id"></div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Staff ID</label>
                            <input type="text" name="staff_id" id="staff_id" class="form-control" maxlength="20"
                                placeholder="e.g. 003221">
                            <small class="text-muted">Auto-filled from the selected manager; editable.</small>
                            <div class="invalid-feedback" data-error="staff_id"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="assignmentSubmitBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-label-primary {
            background-color: #e9e7fd;
            color: #696cff;
        }

        .bg-label-info {
            background-color: #d9f2ff;
            color: #03c3ec;
        }

        .bg-label-danger {
            background-color: #ffe0db;
            color: #ff3e1d;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            const assignmentModalEl = document.getElementById('assignmentModal');
            const assignmentModal = new bootstrap.Modal(assignmentModalEl);

            function initSelect2() {
                $('.select2').select2({
                    dropdownParent: $(assignmentModalEl),
                    width: '100%'
                });
                $('.select2:not(.select2)').select2({
                    width: '100%'
                });
            }
            initSelect2();

            function clearErrors() {
                $('#assignmentForm .form-control, #assignmentForm .form-select').removeClass('is-invalid');
                $('#assignmentForm .invalid-feedback').text('');
            }

            function showErrors(errors) {
                $.each(errors, function(field, messages) {
                    $('#' + field).addClass('is-invalid');
                    $('[data-error="' + field + '"]').text(messages[0]);
                });
            }

            // Auto-fill staff_id from the selected manager's email/username
            $('#user_id').on('change', function() {
                const staffEmail = $(this).find(':selected').data('staff-email');
                if (staffEmail) {
                    $('#staff_id').val(staffEmail);
                }
            });

            // ===================== ADD =====================
            $('#btnAddAssignment').click(function() {
                $('#assignmentForm')[0].reset();
                clearErrors();
                $('#assignmentMethod').val('POST');
                $('#assignmentId').val('');
                $('#upazila_id').val('').trigger('change');
                $('#user_id').val('').trigger('change');
                $('#assignmentModalTitle').text('New Assignment');
                assignmentModal.show();
            });

            // ===================== EDIT =====================
            $(document).on('click', '.btn-edit-assignment', function() {
                $('#assignmentForm')[0].reset();
                clearErrors();
                $('#assignmentMethod').val('PUT');
                $('#assignmentId').val($(this).data('id'));
                $('#upazila_id').val($(this).data('upazila-id')).trigger('change');
                $('#user_id').val($(this).data('user-id')).trigger('change');
                $('#staff_id').val($(this).data('staff-id'));
                $('#assignmentModalTitle').text('Edit Assignment');
                assignmentModal.show();
            });

            // ===================== SAVE (CREATE/UPDATE) =====================
            $('#assignmentForm').submit(function(e) {
                e.preventDefault();
                clearErrors();

                const id = $('#assignmentId').val();
                const method = $('#assignmentMethod').val();
                const url = method === 'PUT' ?
                    '{{ url('admin/upazila-manager-assignments') }}/' + id :
                    '{{ route('admin.upazila-manager-assignments.store') }}';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: () => $('#assignmentSubmitBtn').prop('disabled', true)
                        .html(
                            '<span class="spinner-border spinner-border-sm me-1"></span> Saving...'
                            ),
                    success: function(res) {
                        toastr.success(res.message);
                        assignmentModal.hide();
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong.');
                        }
                    },
                    complete: () => $('#assignmentSubmitBtn').prop('disabled', false).text('Save')
                });
            });

            // ===================== DELETE =====================
            $(document).on('click', '.btn-delete-assignment', function() {
                const id = $(this).data('id');
                if (!confirm('Are you sure you want to delete this assignment?')) return;

                $.ajax({
                    url: '{{ url('admin/upazila-manager-assignments') }}/' + id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(res) {
                        toastr.success(res.message);
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Could not delete.');
                    }
                });
            });

            $('.f-select2').select2({
                width: '100%'
            });
        });
    </script>
@endpush
