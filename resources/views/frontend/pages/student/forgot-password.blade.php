@extends('frontend.layouts.app')

@section('title', 'পাসওয়ার্ড ভুলে গেছেন')

@section('content')
    <div class="container py-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 mt-4">
                <div class="login-wrapper">
                    <div class="text-center mb-4">
                        <div class="login-icon mb-3">
                            <i class="fas fa-unlock-alt"></i>
                        </div>
                        <h3 class="fw-bold mb-1">পাসওয়ার্ড ভুলে গেছেন?</h3>
                        <p class="text-muted small">আপনার নিবন্ধিত মোবাইল নম্বর দিন, আমরা OTP পাঠাবো</p>
                    </div>

                    <div class="login-card">
                        <form action="{{ route('student.password.forgot.submit') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="fas fa-phone me-1"></i> মোবাইল নম্বর
                                </label>
                                <input type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ old('mobile') }}"
                                    placeholder="মোবাইল নম্বর দিন - 017XXXXXXXX" maxlength="11" required autofocus>
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-paper-plane me-2"></i>OTP পাঠান
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('student.login') }}" class="text-decoration-none small">
                            <i class="fas fa-arrow-left me-1"></i> লগইনে ফিরে যান
                        </a>
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
            .form-control {
                border: 1.5px solid #f0e2e2; border-radius: 10px; padding: 10px 14px;
                font-size: 0.95rem; background: #f7fafc;
            }
            .form-control:focus { border-color: #aa3030; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.12); background: white; }
        </style>
    @endpush
@endsection
