{{-- resources/views/frontend/pages/student/login.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'শিক্ষার্থী লগইন')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header-custom text-center text-white rounded-top-3">
                    <h4 class="mb-0 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i> শিক্ষার্থী লগইন
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('student.login.submit') }}" method="POST" id="loginForm">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold required">
                                <i class="fas fa-phone me-2"></i>মোবাইল নম্বর
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-phone text-primary"></i>
                                </span>
                                <input type="tel" 
                                       class="form-control form-control-lg @error('mobile') is-invalid @enderror" 
                                       name="mobile" 
                                       value="{{ old('mobile') }}" 
                                       placeholder="01XXXXXXXXX" 
                                       required 
                                       autofocus>
                            </div>
                            @error('mobile')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">রেজিস্ট্রেশনের সময় ব্যবহৃত মোবাইল নম্বর দিন</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold required">
                                <i class="fas fa-lock me-2"></i>পাসওয়ার্ড
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-key text-primary"></i>
                                </span>
                                <input type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" 
                                       id="password" 
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">
                                <i class="fas fa-check-circle me-1"></i>আমাকে মনে রাখুন
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="loginBtn">
                                <i class="fas fa-sign-in-alt"></i> লগইন করুন
                            </button>
                            
                            <div class="text-center mt-3">
                                <a href="{{ route('student.register') }}" class="text-decoration-none">
                                    <i class="fas fa-user-plus me-1"></i>এখনো রেজিস্ট্রেশন করেননি? রেজিস্ট্রেশন করুন
                                </a>
                            </div>
                            
                            <div class="text-center mt-2">
                                <a href="#" class="text-muted text-decoration-none small" id="forgotPassword">
                                    <i class="fas fa-question-circle me-1"></i>পাসওয়ার্ড ভুলে গেছেন?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">
                    <i class="fas fa-shield-alt me-1"></i> আপনার তথ্য নিরাপদে রাখা হবে
                </p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .required:after {
        content: " *";
        color: red;
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
    
    // Add loading effect on submit
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> লগইন হচ্ছে...';
        loginBtn.disabled = true;
    });
    
    // Forgot password alert (temporary)
    document.getElementById('forgotPassword').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'পাসওয়ার্ড রিসেট',
            text: 'পাসওয়ার্ড রিসেট করার সুবিধা শীঘ্রই যোগ করা হবে। দয়া করে আপনার মোবাইল নম্বর দিয়ে লগইন করার চেষ্টা করুন।',
            icon: 'info',
            confirmButtonColor: '#d32f2f',
            confirmButtonText: 'বুঝেছি'
        });
    });
    
    // Auto-fill demo credentials (optional, remove in production)
    // Uncomment the following lines to auto-fill demo credentials for testing
    /*
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        document.querySelector('input[name="mobile"]').value = '01700000000';
        document.querySelector('input[name="password"]').value = 'password123';
    }
    */
</script>
@endpush
@endsection