@extends('frontend.layouts.app')

@section('title', 'OTP যাচাই')

@section('content')
    <div class="otp-container">
        <div class="otp-card">
            <div class="otp-header">
                <div class="otp-icon"><i class="fas fa-shield-alt"></i></div>
                <h3 class="mb-1">OTP যাচাই করুন</h3>
                <p class="mb-0 opacity-90">পাসওয়ার্ড রিসেট করতে OTP লিখুন</p>
            </div>

            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <p class="text-muted mb-1">আমরা একটি OTP পাঠিয়েছি</p>
                    <div class="mobile-display">
                        <i class="fas fa-phone me-2"></i>{{ $user->mobile }}
                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('student.password.reset.otp.verify') }}" method="POST" id="otpForm">
                    @csrf
                    <div class="otp-input-group" id="otpInputs">
                        @for ($i = 0; $i < 6; $i++)
                            <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric"
                                {{ $i === 0 ? 'autofocus' : '' }}>
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otpHidden">

                    <div class="text-center mt-3">
                        <button type="button" class="resend-btn" id="resendBtn" disabled>
                            <i class="fas fa-sync-alt me-1"></i> OTP পুনরায় পাঠান
                        </button>
                        <div class="timer-text mt-2">
                            <span>অবশিষ্ট সময়: </span><span class="time" id="timerDisplay">05:00</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 mt-3 py-3">
                        <i class="fas fa-check-circle me-2"></i> যাচাই করুন
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .otp-container { min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
            .otp-card { max-width: 450px; width: 100%; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); background: white; margin-top: 20px; }
            .otp-header { background: linear-gradient(135deg, #d46c6c 0%, #b44444 100%); color: white; border-radius: 20px 20px 0 0; padding: 30px 25px; text-align: center; }
            .otp-icon { width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 35px; }
            .otp-input-group { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
            .otp-input { width: 50px; height: 60px; text-align: center; font-size: 24px; font-weight: bold; border: 2px solid #e0e0e0; border-radius: 10px; background: #f8f9fa; }
            .otp-input:focus { border-color: #d32f2f; background: white; }
            .mobile-display { background: #f8f9fa; padding: 10px 15px; border-radius: 10px; font-weight: 600; display: inline-block; }
            .timer-text .time { font-weight: bold; color: #d32f2f; }
            .timer-text .time.expired { color: #28a745; }
            .resend-btn { color: #d32f2f; background: none; border: none; font-weight: 600; }
            .resend-btn:disabled { color: #999; }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.otp-input');
                const hidden = document.getElementById('otpHidden');
                const resendBtn = document.getElementById('resendBtn');
                const timerDisplay = document.getElementById('timerDisplay');
                let timeLeft = 300, timerInterval;

                function startTimer() {
                    clearInterval(timerInterval);
                    timeLeft = 300;
                    resendBtn.disabled = true;
                    timerDisplay.classList.remove('expired');
                    timerInterval = setInterval(() => {
                        timeLeft--;
                        const m = Math.floor(timeLeft / 60), s = timeLeft % 60;
                        timerDisplay.textContent = `${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            resendBtn.disabled = false;
                            timerDisplay.classList.add('expired');
                        }
                    }, 1000);
                }
                startTimer();

                inputs.forEach((input, i) => {
                    input.addEventListener('input', () => {
                        if (input.value.length === 1 && i < inputs.length - 1) inputs[i + 1].focus();
                        syncHidden();
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && input.value.length === 0 && i > 0) inputs[i - 1].focus();
                    });
                });

                function syncHidden() {
                    hidden.value = Array.from(inputs).map(i => i.value).join('');
                }

                document.getElementById('otpForm').addEventListener('submit', function(e) {
                    syncHidden();
                    if (hidden.value.length !== 6) {
                        e.preventDefault();
                        toastr.error('দয়া করে ৬ ডিজিটের OTP লিখুন।');
                    }
                });

                resendBtn.addEventListener('click', function() {
                    fetch('{{ route('student.password.reset.otp.resend') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            startTimer();
                            inputs.forEach(i => i.value = '');
                            inputs[0].focus();
                            toastr.success(data.message || 'OTP পুনরায় পাঠানো হয়েছে।');
                        } else {
                            toastr.error(data.message || 'ব্যর্থ হয়েছে।');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
