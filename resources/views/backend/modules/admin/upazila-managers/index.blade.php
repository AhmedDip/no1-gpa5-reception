@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'upazila Manager Assignments')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Upazila Manager Assignments</h5>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-users me-2"></i>Upazila Assignments
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Upazila ID</th>
                        <th>Upazila Name</th>
                        <th>Staff ID</th>
                        <th>Assigned Manager</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignments as $row)
                        <tr>
                            <td>{{ $row->upazila_id }}</td>
                            <td>{{ $row->upazila_name }}</td>
                            <td style="font-family:monospace;">{{ $row->staff_id }}</td>
                            <td>
                                @if ($row->manager)
                                    {{ $row->manager->name }}
                                @else
                                    <span class="badge bg-label-danger">Unmatched</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-2 d-block"></i>
                                No assignments found yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
