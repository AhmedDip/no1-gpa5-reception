@extends('frontend.layouts.app')

@section('title', 'শিক্ষার্থী লগইন')

@section('content')
<div class="container py-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-wrapper">
                {{-- Logo/Brand --}}
                <div class="text-center mb-4">
                    <div class="login-icon mb-3">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="fw-bold mb-1">শিক্ষার্থী লগইন</h3>
                    <p class="text-muted small">আপনার অ্যাকাউন্টে লগইন করুন</p>
                </div>

                {{-- Login Form --}}
                <div class="login-card">
                    <form action="{{ route('student.login.submit') }}" method="POST" id="loginForm">
                        @csrf
                        
                        {{-- Mobile Field --}}
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-phone me-1"></i> মোবাইল নম্বর
                            </label>
                            <input type="tel" 
                                   class="form-control @error('mobile') is-invalid @enderror" 
                                   name="mobile" 
                                   value="{{ old('mobile') }}" 
                                   placeholder="মোবাইল নম্বর দিন - 017XXXXXXXX" 
                                   maxlength="11"
                                   required 
                                   autofocus>
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Password Field --}}
                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-lock me-1"></i> পাসওয়ার্ড
                            </label>
                            <div class="password-wrapper">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       id="password" 
                                       placeholder="পাসওয়ার্ড দিন" 
                                       required>
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Remember Me & Forgot Password --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                <label class="form-check-label small" for="rememberMe">
                                    আমাকে মনে রাখুন
                                </label>
                            </div>
                            <a href="#" class="text-decoration-none small" id="forgotPassword">
                                পাসওয়ার্ড ভুলে গেছেন?
                            </a>
                        </div>
                        
                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100" id="loginBtn">
                            <i class="fas fa-sign-in-alt me-2"></i>লগইন করুন
                        </button>
                    </form>
                </div>

                {{-- Register Link --}}
                <div class="text-center mt-3">
                    <p class="mb-0 small">
                        এখনো রেজিস্ট্রেশন করেননি? 
                        <a href="{{ route('student.register') }}" class="text-decoration-none fw-semibold">
                            রেজিস্ট্রেশন করুন
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .login-wrapper {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px 0;
    }

    .login-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .login-card {
        background: white;
        padding: 30px 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .form-label {
        color: #2d3748;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #f7fafc;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.12);
        background: white;
    }

    .form-control.is-invalid {
        border-color: #fc8181;
        background: #fff5f5;
    }

    .invalid-feedback {
        font-size: 0.8rem;
        margin-top: 4px;
        color: #e53e3e;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 45px;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        padding: 0;
        cursor: pointer;
        transition: color 0.2s;
    }

    .password-toggle:hover {
        color: #4a5568;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 11px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        transform: none;
    }

    .form-check-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-label {
        color: #4a5568;
        cursor: pointer;
    }

    .form-check-label:hover {
        color: #2d3748;
    }

    a {
        color: #667eea;
        transition: color 0.2s;
    }

    a:hover {
        color: #5a67d8;
    }

    /* Toastr customization */
    #toast-container > .toast-error {
        background: linear-gradient(135deg, #f56565, #e53e3e) !important;
        box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3) !important;
    }
    #toast-container > .toast-success {
        background: linear-gradient(135deg, #48bb78, #38a169) !important;
        box-shadow: 0 4px 12px rgba(56, 161, 105, 0.3) !important;
    }
    #toast-container > .toast-warning {
        background: linear-gradient(135deg, #f6ad55, #ed8936) !important;
        box-shadow: 0 4px 12px rgba(237, 137, 54, 0.3) !important;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .login-wrapper {
            padding: 10px 0;
        }
        .login-card {
            padding: 20px 16px;
        }
        .login-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        .form-control {
            font-size: 0.9rem;
            padding: 8px 12px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Loading state on submit
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>লগইন হচ্ছে...';
        loginBtn.disabled = true;
    });

    // Forgot password
    document.getElementById('forgotPassword').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'পাসওয়ার্ড রিসেট',
            text: 'পাসওয়ার্ড রিসেট করার সুবিধা শীঘ্রই যোগ করা হবে।',
            icon: 'info',
            confirmButtonColor: '#667eea',
            confirmButtonText: 'বুঝেছি'
        });
    });
</script>
@endpush
@endsection