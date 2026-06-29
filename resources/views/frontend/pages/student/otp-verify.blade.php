{{-- resources/views/frontend/pages/student/otp-verify.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'মোবাইল নম্বর যাচাই')

@section('content')
    <style>
        .otp-container {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .otp-card {
            max-width: 450px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease-out;
            background: white;
            border: none;
            margin-top: 20px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .otp-header {
            background: linear-gradient(135deg, #d46c6c 0%, #b44444 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 30px 25px;
            text-align: center;
        }

        .otp-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 35px;
        }

        .otp-input-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }

        .otp-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .otp-input:focus {
            border-color: #d32f2f;
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
            background: white;
            transform: scale(1.05);
        }

        .otp-input.filled {
            border-color: #28a745;
            background: #f0fff4;
        }

        .otp-input.error {
            border-color: #dc3545;
            background: #fff5f5;
            animation: shake 0.5s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        .timer-text {
            color: #666;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .timer-text .time {
            font-weight: bold;
            color: #d32f2f;
            font-size: 18px;
        }

        .timer-text .time.expired {
            color: #28a745;
        }

        .resend-btn {
            color: #d32f2f;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resend-btn:hover {
            color: #b71c1c;
            text-decoration: underline;
        }

        .resend-btn:disabled {
            color: #999;
            cursor: not-allowed;
            text-decoration: none;
        }

        .mobile-display {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 600;
            color: #333;
            display: inline-block;
        }

        .otp-hint {
            font-size: 13px;
            color: #888;
            margin-top: 15px;
        }

        @media (max-width: 576px) {
            .otp-input {
                width: 40px;
                height: 50px;
                font-size: 20px;
            }

            .otp-header h3 {
                font-size: 20px;
            }
        }
    </style>

    <div class="otp-container mt-5">
        <div class="otp-card">
            <!-- Header -->
            <div class="otp-header">
                <div class="otp-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="mb-1">মোবাইল নম্বর যাচাই</h3>
                <p class="mb-0 opacity-90">
                    আপনার নিবন্ধন সম্পূর্ণ করতে মোবাইল নম্বর যাচাই করুন
                </p>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <p class="text-muted mb-1">আমরা একটি OTP পাঠিয়েছি</p>
                    <div class="mobile-display">
                        <i class="fas fa-phone me-2"></i>
                        {{ Auth::user()->mobile }}
                    </div>
                    <p class="text-muted small mt-2">
                        আপনার মোবাইলে ৬ ডিজিটের OTP লিখুন
                    </p>
                </div>

                <!-- OTP Input -->
                <form id="otpForm">
                    @csrf
                    <div class="otp-input-group" id="otpInputs">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric"
                            autofocus>
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    </div>

                    <!-- Error Message -->
                    <div id="otpError" class="alert alert-danger d-none" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span id="errorMessage"></span>
                    </div>

                    <!-- Timer & Resend -->
                    <div class="text-center mt-3">
                        <div class="timer-text">
                            <i class="fas fa-clock"></i>
                            <span>অবশিষ্ট সময়: </span>
                            <span class="time" id="timerDisplay">05:00</span>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="resend-btn" id="resendBtn" disabled>
                                <i class="fas fa-sync-alt me-1"></i>
                                OTP পুনরায় পাঠান
                            </button>
                        </div>
                        <div class="otp-hint">
                            <i class="fas fa-info-circle me-1"></i>
                            OTP ৫ মিনিটের জন্য বৈধ
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-danger w-100 mt-3 py-3" id="verifyBtn">
                        <i class="fas fa-check-circle me-2"></i>
                        যাচাই করুন
                    </button>

                    <!-- Skip Verification (Development Only) -->
                    {{-- @if (app()->environment('local', 'testing'))
                    <div class="text-center mt-3">
                        <a href="{{ route('otp.skip') }}" class="text-muted small text-decoration-none">
                            <i class="fas fa-forward me-1"></i>
                            ডেভেলপমেন্ট: যাচাই বাদ দিন
                        </a>
                    </div>
                @endif --}}
                </form>
            </div>
        </div>
    </div>

    {{-- resources/views/frontend/pages/student/otp-verify.blade.php --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const otpInputs = document.querySelectorAll('.otp-input');
                const otpForm = document.getElementById('otpForm');
                const resendBtn = document.getElementById('resendBtn');
                const timerDisplay = document.getElementById('timerDisplay');
                const otpError = document.getElementById('otpError');
                const errorMessage = document.getElementById('errorMessage');

                let timerDuration = 300; // 5 minutes in seconds
                let timerInterval;

                // Function to start the countdown timer
                function startTimer() {
                    clearInterval(timerInterval);
                    let timeLeft = timerDuration;
                    updateTimerDisplay(timeLeft);

                    timerInterval = setInterval(() => {
                        timeLeft--;
                        updateTimerDisplay(timeLeft);

                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            resendBtn.disabled = false;
                            timerDisplay.classList.add('expired');
                        }
                    }, 1000);
                }

                // Function to update the timer display
                function updateTimerDisplay(seconds) {
                    const minutes = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    timerDisplay.textContent =
                        `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                }

                // Start the timer on page load
                startTimer();

                // Handle OTP input focus and navigation
                otpInputs.forEach((input, index) => {
                    input.addEventListener('input', () => {
                        if (input.value.length === 1 && index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                        if (input.value.length === 0 && index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    });

                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    });
                });

                // Handle OTP form submission
                otpForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const otpValue = Array.from(otpInputs).map(input => input.value).join('');

                    if (otpValue.length !== 6) {
                        showError('দয়া করে ৬ ডিজিটের OTP লিখুন।');
                        return;
                    }

                    // Disable the verify button to prevent multiple submissions
                    const verifyBtn = document.getElementById('verifyBtn');
                    verifyBtn.disabled = true;
                    verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> যাচাই হচ্ছে...';

                    // Send OTP for verification via AJAX
                    fetch('{{ route('student.otp.verify.submit') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                otp: otpValue
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showError('OTP সফলভাবে যাচাই হয়েছে!', false);
                                setTimeout(() => {
                                    window.location.href = '{{ route('student.dashboard') }}';
                                }, 1500);
                            } else {
                                showError(data.message || 'OTP যাচাই ব্যর্থ হয়েছে।');
                                verifyBtn.disabled = false;
                                verifyBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> যাচাই করুন';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showError('একটি ত্রুটি ঘটেছে। অনুগ্রহ করে পরে আবার চেষ্টা করুন।');
                            verifyBtn.disabled = false;
                            verifyBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> যাচাই করুন';
                        });
                });

                // Handle Resend OTP
                resendBtn.addEventListener('click', function() {
                    resendBtn.disabled = true;
                    resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> OTP পাঠানো হচ্ছে...';

                    fetch('{{ route('student.otp.resend') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                startTimer();
                                otpInputs.forEach(input => input.value = '');
                                otpInputs[0].focus();
                                showError('OTP পুনরায় পাঠানো হয়েছে।', false);
                            } else {
                                showError(data.message || 'OTP পুনরায় পাঠানো ব্যর্থ হয়েছে।');
                            }
                            resendBtn.disabled = false;
                            resendBtn.innerHTML = '<i class="fas fa-sync-alt me-1"></i> OTP পুনরায় পাঠান';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showError('একটি ত্রুটি ঘটেছে। অনুগ্রহ করে পরে আবার চেষ্টা করুন।');
                            resendBtn.disabled = false;
                            resendBtn.innerHTML = '<i class="fas fa-sync-alt me-1"></i> OTP পুনরায় পাঠান';
                        });
                });

                // Function to show error messages
                function showError(message, isError = true) {
                    errorMessage.textContent = message;
                    otpError.classList.toggle('d-none', !isError);
                    if (isError) {
                        otpInputs.forEach(input => input.classList.add('error'));
                        setTimeout(() => {
                            otpInputs.forEach(input => input.classList.remove('error'));
                        }, 500);
                    }
                }
            });
        </script>
    @endpush
@endsection
