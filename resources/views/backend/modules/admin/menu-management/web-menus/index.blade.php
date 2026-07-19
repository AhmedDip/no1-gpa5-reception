@extends('backend.layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Web Menus')

@section('main-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="bx bx-menu me-1"></i> Web Menu List</h5>
        @if ($currentPermissions['create'] ?? true)
            <button type="button" class="btn btn-primary btn-sm" id="btnAddMenu">
                <i class="fas fa-plus me-1"></i> নতুন মেনু
            </button>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60">ক্রম</th>
                            <th>আইকন</th>
                            <th>নাম</th>
                            <th>সাব-মেনু সংখ্যা</th>
                            <th>স্ট্যাটাস</th>
                            <th width="120" class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            <tr>
                                <td>{{ $menu->wmnu_oseq }}</td>
                                <td><i class="{{ $menu->wmnu_icon }} fs-5"></i></td>
                                <td>{{ $menu->wmnu_name }}</td>
                                <td>{{ $menu->sub_menus_count }}</td>
                                <td>
                                    @if ($menu->var)
                                        <span class="badge bg-label-success">সক্রিয়</span>
                                    @else
                                        <span class="badge bg-label-danger">নিষ্ক্রিয়</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-icon btn-outline-warning btn-sm btn-edit-menu"
                                        data-id="{{ $menu->id }}" data-name="{{ $menu->wmnu_name }}"
                                        data-icon="{{ $menu->wmnu_icon }}" data-oseq="{{ $menu->wmnu_oseq }}"
                                        data-var="{{ $menu->var }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-outline-danger btn-sm btn-delete-menu"
                                        data-id="{{ $menu->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">কোনো মেনু পাওয়া যায়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="menuModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuModalTitle">নতুন মেনু</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="menuForm">
                    @csrf
                    <input type="hidden" name="_method" id="menuMethod" value="POST">
                    <input type="hidden" id="menuId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">মেনুর নাম <span class="text-danger">*</span></label>
                            <input type="text" name="wmnu_name" id="wmnu_name" class="form-control" maxlength="30"
                                required>
                            <div class="invalid-feedback" data-error="wmnu_name"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">আইকন ক্লাস (Boxicons) <span class="text-danger">*</span></label>
                            <input type="text" name="wmnu_icon" id="wmnu_icon" class="form-control" maxlength="30"
                                placeholder="যেমন: bx bx-home-smile" required>
                            <div class="invalid-feedback" data-error="wmnu_icon"></div>
                            <small class="text-muted">
                                <a href="https://boxicons.com/" target="_blank">boxicons.com</a> থেকে আইকন ক্লাস কপি করুন
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ক্রম (Order) <span class="text-danger">*</span></label>
                            <input type="number" name="wmnu_oseq" id="wmnu_oseq" class="form-control" min="0"
                                required>
                            <div class="invalid-feedback" data-error="wmnu_oseq"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">স্ট্যাটাস <span class="text-danger">*</span></label>
                            <select name="lfcl_id" id="lfcl_id" class="form-select" required>
                                <option value="1">সক্রিয়</option>
                                <option value="0">নিষ্ক্রিয়</option>
                            </select>
                            <div class="invalid-feedback" data-error="lfcl_id"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-primary" id="menuSubmitBtn">সংরক্ষণ করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const menuModal = new bootstrap.Modal(document.getElementById('menuModal'));

            $('#btnAddMenu').click(function() {
                $('#menuForm')[0].reset();
                clearErrors('menuForm');
                $('#menuMethod').val('POST');
                $('#menuId').val('');
                $('#menu_var').prop('checked', true);
                $('#menuModalTitle').text('নতুন মেনু');
                menuModal.show();
            });

            $('.btn-edit-menu').click(function() {
                $('#menuForm')[0].reset();
                clearErrors('menuForm');
                $('#menuMethod').val('PUT');
                $('#menuId').val($(this).data('id'));
                $('#wmnu_name').val($(this).data('name'));
                $('#wmnu_icon').val($(this).data('icon'));
                $('#wmnu_oseq').val($(this).data('oseq'));
                $('#menu_var').prop('checked', $(this).data('var') == 1);
                $('#menuModalTitle').text('মেনু সম্পাদনা');
                menuModal.show();
            });

            $('#menuForm').submit(function(e) {
                e.preventDefault();
                clearErrors('menuForm');

                const id = $('#menuId').val();
                const method = $('#menuMethod').val();
                const url = method === 'PUT' ?
                    '{{ url('admin/menu-management/web-menus') }}/' + id :
                    '{{ route('admin.menu-management.web-menus.store') }}';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: () => $('#menuSubmitBtn').prop('disabled', true)
                        .html(
                            '<span class="spinner-border spinner-border-sm me-1"></span> সংরক্ষণ হচ্ছে...'
                            ),
                    success: function(res) {
                        toastr.success(res.message);
                        menuModal.hide();
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            showErrors('menuForm', xhr.responseJSON.errors);
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'একটি ত্রুটি ঘটেছে।');
                        }
                    },
                    complete: () => $('#menuSubmitBtn').prop('disabled', false).text('সংরক্ষণ করুন')
                });
            });

            $('.btn-delete-menu').click(function() {
                const id = $(this).data('id');
                if (!confirm('আপনি কি নিশ্চিত এই মেনুটি মুছে ফেলতে চান?')) return;

                $.ajax({
                    url: '{{ url('admin/menu-management/web-menus') }}/' + id,
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
                        toastr.error(xhr.responseJSON?.message || 'মুছে ফেলা যায়নি।');
                    }
                });
            });

            function clearErrors(formId) {
                $('#' + formId + ' .form-control').removeClass('is-invalid');
                $('#' + formId + ' .invalid-feedback').text('');
            }

            function showErrors(formId, errors) {
                $.each(errors, function(field, messages) {
                    $('#' + field).addClass('is-invalid');
                    $('[data-error="' + field + '"]').text(messages[0]);
                });
            }
        });
    </script>
@endpush
