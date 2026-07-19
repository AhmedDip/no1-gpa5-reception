@extends('frontend.layouts.app')

@section('title', 'নতুন পাসওয়ার্ড')

@section('content')
    <div class="container py-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 mt-4">
                <div class="login-wrapper">
                    <div class="text-center mb-4">
                        <div class="login-icon mb-3"><i class="fas fa-lock"></i></div>
                        <h3 class="fw-bold mb-1">নতুন পাসওয়ার্ড দিন</h3>
                        <p class="text-muted small">আপনার অ্যাকাউন্টের জন্য একটি নতুন পাসওয়ার্ড সেট করুন</p>
                    </div>

                    <div class="login-card">
                        <form action="{{ route('student.password.reset.submit') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold small">নতুন পাসওয়ার্ড</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" minlength="6" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold small">পাসওয়ার্ড নিশ্চিত করুন</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    minlength="6" required>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-save me-2"></i> পাসওয়ার্ড সংরক্ষণ করুন
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .login-wrapper { max-width: 400px; margin: 0 auto; padding: 20px 0; }
            .login-icon {
                width: 70px; height: 70px; margin: 0 auto;
                background: linear-gradient(135deg, #aa1b1d 0%, #7c1a1c 100%);
                border-radius: 50%; display: flex; align-items: center; justify-content: center;
                color: white; font-size: 28px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            }
            .login-card {
                background: white; padding: 30px 25px; border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06); border: 1px solid rgba(0, 0, 0, 0.04);
            }
            .form-control { border: 1.5px solid #f0e2e2; border-radius: 10px; padding: 10px 14px; background: #f7fafc; }
            .form-control:focus { border-color: #aa3030; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.12); background: white; }
        </style>
    @endpush
@endsection
