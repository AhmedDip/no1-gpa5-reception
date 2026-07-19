@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Manage Permissions')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">
        <i class="fas fa-shield-alt me-2"></i>
        Permissions: <span class="text-primary">{{ $group->wmng_name }}</span>
        <span class="badge bg-label-secondary">{{ $group->wmng_code }}</span>
    </h5>
    <a href="{{ route('admin.menu-management.permissions.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> ফিরে যান
    </a>
</div>

<form action="{{ route('admin.menu-management.permissions.update', $group) }}" method="POST">
    @csrf

    @foreach($menus as $menu)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="{{ $menu->wmnu_icon }}"></i>
                <strong>{{ $menu->wmnu_name }}</strong>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>সাব-মেনু</th>
                                <th class="text-center" width="90">Visible</th>
                                <th class="text-center" width="90">Create</th>
                                <th class="text-center" width="90">Read</th>
                                <th class="text-center" width="90">Update</th>
                                <th class="text-center" width="90">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menu->subMenus as $sub)
                                @php $perm = $existingPermissions->get($sub->id); @endphp
                                <tr>
                                    <td>
                                        <input type="hidden" name="submenu_ids[]" value="{{ $sub->id }}">
                                        {{ $sub->wsmn_name }}
                                        <br>
                                        <small class="text-muted" style="font-family:monospace;">{{ $sub->wsmn_ukey }}</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input"
                                            name="permissions[{{ $sub->id }}][visible]" value="1"
                                            {{ $perm?->wsmu_vsbl ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input"
                                            name="permissions[{{ $sub->id }}][create]" value="1"
                                            {{ $perm?->wsmu_crat ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input"
                                            name="permissions[{{ $sub->id }}][read]" value="1"
                                            {{ $perm?->wsmu_read ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input"
                                            name="permissions[{{ $sub->id }}][update]" value="1"
                                            {{ $perm?->wsmu_updt ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input"
                                            name="permissions[{{ $sub->id }}][delete]" value="1"
                                            {{ $perm?->wsmu_delt ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted py-3">এই মেনুতে কোনো সাব-মেনু নেই।</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-end mb-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save me-1"></i> পারমিশন সংরক্ষণ করুন
        </button>
    </div>
</form>
@endsection
