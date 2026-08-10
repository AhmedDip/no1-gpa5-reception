<nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav-left d-flex align-items-center mt-1">
            {{-- <p id="clock" class="fw-bold text-secondary"></p> --}}
            নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('images/no1-logo.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('images/no1-logo.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <!-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"> <i
                                class="bx bx-cog bx-md me-3"></i><span>Settings</span> </a>
                    </li> -->
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#adminPasswordModal">
                            <i class="bx bx-key bx-md me-3"></i><span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                            <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Change Password Modal -->
<div class="modal fade" id="adminPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-4"><i class="bx bx-key me-2"></i>Change Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.password.update') }}" method="POST" id="adminPasswordForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" id="admin_current_password" required>
                            <button class="btn btn-outline-secondary toggle-pass" type="button"
                                data-target="admin_current_password"><i class="bx bx-show"></i></button>
                            @error('current_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" id="admin_new_password" minlength="6" required>
                            <button class="btn btn-outline-secondary toggle-pass" type="button"
                                data-target="admin_new_password"><i class="bx bx-show"></i></button>
                            @error('new_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Must be at least 6 characters</small>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="new_password_confirmation"
                                id="admin_new_password_confirmation" minlength="6" required>
                            <button class="btn btn-outline-secondary toggle-pass" type="button"
                                data-target="admin_new_password_confirmation"><i class="bx bx-show"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->has('current_password') || $errors->has('new_password'))
                new bootstrap.Modal(document.getElementById('adminPasswordModal')).show();
            @endif

            document.querySelectorAll('#adminPasswordModal .toggle-pass').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const target = document.getElementById(this.dataset.target);
                    const icon = this.querySelector('i');
                    const isHidden = target.type === 'password';
                    target.type = isHidden ? 'text' : 'password';
                    icon.classList.toggle('bx-show', !isHidden);
                    icon.classList.toggle('bx-hide', isHidden);
                });
            });

            const adminPasswordForm = document.getElementById('adminPasswordForm');
            if (adminPasswordForm) {
                adminPasswordForm.addEventListener('submit', function(e) {
                    const newPass = document.getElementById('admin_new_password').value;
                    const confirmPass = document.getElementById('admin_new_password_confirmation').value;
                    if (newPass !== confirmPass) {
                        e.preventDefault();
                        toastr.error('New password and confirmation do not match.');
                    }
                });
            }
        });
    </script>
@endpush
