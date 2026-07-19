@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Permissions')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>User Group Permissions</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>গ্রুপের নাম</th>
                        <th>কোড</th>
                        <th>মেনু পারমিশন সংখ্যা</th>
                        <th width="160" class="text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $i => $group)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $group->wmng_name }}</td>
                            <td><span class="badge bg-label-secondary">{{ $group->wmng_code }}</span></td>
                            <td>{{ $group->user_group_menus_count }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.menu-management.permissions.edit', $group) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i> ম্যানেজ করুন
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">কোনো গ্রুপ পাওয়া যায়নি।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
