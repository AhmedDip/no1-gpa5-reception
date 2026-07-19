@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Sub Menus')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0"><i class="bx bx-list-ul me-1"></i> Sub Menu List</h5>
    @if($currentPermissions['create'] ?? true)
        <button type="button" class="btn btn-primary btn-sm" id="btnAddSubMenu">
            <i class="fas fa-plus me-1"></i> নতুন সাব-মেনু
        </button>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>প্যারেন্ট মেনু</th>
                        <th>নাম</th>
                        <th>URL</th>
                        <th>Permission Key</th>
                        <th width="60">ক্রম</th>
                        <th>স্ট্যাটাস</th>
                        <th width="120" class="text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subMenus as $sub)
                        <tr>
                            <td>{{ $sub->webMenu->wmnu_name ?? '—' }}</td>
                            <td>{{ $sub->wsmn_name }}</td>
                            <td><code>{{ $sub->wsmn_wurl }}</code></td>
                            <td><span class="badge bg-label-info" style="font-family:monospace;">{{ $sub->wsmn_ukey }}</span></td>
                            <td>{{ $sub->wsmn_oseq }}</td>
                            <td>
                                @if($sub->var)
                                    <span class="badge bg-label-success">সক্রিয়</span>
                                @else
                                    <span class="badge bg-label-danger">নিষ্ক্রিয়</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-icon btn-outline-warning btn-sm btn-edit-sub"
                                    data-id="{{ $sub->id }}"
                                    data-wmnu="{{ $sub->wmnu_id }}"
                                    data-name="{{ $sub->wsmn_name }}"
                                    data-url="{{ $sub->wsmn_wurl }}"
                                    data-ukey="{{ $sub->wsmn_ukey }}"
                                    data-oseq="{{ $sub->wsmn_oseq }}"
                                    data-var="{{ $sub->var }}"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-danger btn-sm btn-delete-sub"
                                    data-id="{{ $sub->id }}" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">কোনো সাব-মেনু পাওয়া যায়নি।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="subMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subMenuModalTitle">নতুন সাব-মেনু</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="subMenuForm">
                @csrf
                <input type="hidden" name="_method" id="subMenuMethod" value="POST">
                <input type="hidden" id="subMenuId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">প্যারেন্ট মেনু <span class="text-danger">*</span></label>
                        <select name="wmnu_id" id="wmnu_id" class="form-select" required>
                            <option value="">নির্বাচন করুন</option>
                            @foreach($webMenus as $wm)
                                <option value="{{ $wm->id }}">{{ $wm->wmnu_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" data-error="wmnu_id"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">সাব-মেনুর নাম <span class="text-danger">*</span></label>
                        <input type="text" name="wsmn_name" id="wsmn_name" class="form-control" maxlength="30" required>
                        <div class="invalid-feedback" data-error="wsmn_name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="text" name="wsmn_wurl" id="wsmn_wurl" class="form-control" maxlength="100"
                               placeholder="/admin/example" required>
                        <div class="invalid-feedback" data-error="wsmn_wurl"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permission Key (Unique) <span class="text-danger">*</span></label>
                        <input type="text" name="wsmn_ukey" id="wsmn_ukey" class="form-control" maxlength="255"
                               placeholder="যেমন: example.list" required>
                        <div class="invalid-feedback" data-error="wsmn_ukey"></div>
                        <small class="text-muted">middleware('menu.permission:KEY,action') এ ব্যবহৃত হবে</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ক্রম (Order) <span class="text-danger">*</span></label>
                        <input type="number" name="wsmn_oseq" id="wsmn_oseq" class="form-control" min="0" required>
                        <div class="invalid-feedback" data-error="wsmn_oseq"></div>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="var" id="sub_var" value="1" checked>
                        <label class="form-check-label" for="sub_var">সক্রিয়</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary" id="subMenuSubmitBtn">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(function () {
    const subMenuModal = new bootstrap.Modal(document.getElementById('subMenuModal'));

    $('#btnAddSubMenu').click(function () {
        $('#subMenuForm')[0].reset();
        clearErrors('subMenuForm');
        $('#subMenuMethod').val('POST');
        $('#subMenuId').val('');
        $('#sub_var').prop('checked', true);
        $('#subMenuModalTitle').text('নতুন সাব-মেনু');
        subMenuModal.show();
    });

    $('.btn-edit-sub').click(function () {
        $('#subMenuForm')[0].reset();
        clearErrors('subMenuForm');
        $('#subMenuMethod').val('PUT');
        $('#subMenuId').val($(this).data('id'));
        $('#wmnu_id').val($(this).data('wmnu'));
        $('#wsmn_name').val($(this).data('name'));
        $('#wsmn_wurl').val($(this).data('url'));
        $('#wsmn_ukey').val($(this).data('ukey'));
        $('#wsmn_oseq').val($(this).data('oseq'));
        $('#sub_var').prop('checked', $(this).data('var') == 1);
        $('#subMenuModalTitle').text('সাব-মেনু সম্পাদনা');
        subMenuModal.show();
    });

    $('#subMenuForm').submit(function (e) {
        e.preventDefault();
        clearErrors('subMenuForm');

        const id = $('#subMenuId').val();
        const method = $('#subMenuMethod').val();
        const url = method === 'PUT'
            ? '{{ url('admin/menu-management/sub-menus') }}/' + id
            : '{{ route('admin.menu-management.sub-menus.store') }}';

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            beforeSend: () => $('#subMenuSubmitBtn').prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm me-1"></span> সংরক্ষণ হচ্ছে...'),
            success: function (res) {
                toastr.success(res.message);
                subMenuModal.hide();
                setTimeout(() => location.reload(), 1000);
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    showErrors('subMenuForm', xhr.responseJSON.errors);
                } else {
                    toastr.error(xhr.responseJSON?.message || 'একটি ত্রুটি ঘটেছে।');
                }
            },
            complete: () => $('#subMenuSubmitBtn').prop('disabled', false).text('সংরক্ষণ করুন')
        });
    });

    $('.btn-delete-sub').click(function () {
        const id = $(this).data('id');
        if (!confirm('আপনি কি নিশ্চিত এই সাব-মেনুটি মুছে ফেলতে চান? এর সাথে যুক্ত সব পারমিশনও মুছে যাবে।')) return;

        $.ajax({
            url: '{{ url('admin/menu-management/sub-menus') }}/' + id,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
            success: function (res) {
                toastr.success(res.message);
                setTimeout(() => location.reload(), 1000);
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON?.message || 'মুছে ফেলা যায়নি।');
            }
        });
    });

    function clearErrors(formId) {
        $('#' + formId + ' .form-control, #' + formId + ' .form-select').removeClass('is-invalid');
        $('#' + formId + ' .invalid-feedback').text('');
    }
    function showErrors(formId, errors) {
        $.each(errors, function (field, messages) {
            $('#' + field).addClass('is-invalid');
            $('[data-error="' + field + '"]').text(messages[0]);
        });
    }
});
</script>
@endpush
