{{-- resources/views/frontend/pages/qrcode/student.blade.php --}}

@extends('frontend.layouts.default')

@section('title', $user ? 'QR কোড - ' . ($user->studentDetail->name_bn ?? $user->name) : 'Invalid QR Code')

@section('content')
<div class="container my-5" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            @if ($user)
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-danger text-white text-center py-3">
                        <h5 class="mb-0"><i class="fas fa-id-card"></i> শিক্ষার্থীর প্রবেশ QR কোড</h5>
                    </div>
                    <div class="card-body text-center p-4">
                     <img src="{{ $qrDataUri }}" alt="QR Code" class="img-fluid border rounded mb-3" style="max-width: 260px;">

                        <h5 class="fw-bold mb-0">{{ $user->studentDetail->name_bn ?? $user->name }}</h5>
                        <p class="text-muted mb-3">{{ $user->studentDetail->name_en ?? '' }}</p>

                        {{-- <img src="{{ $qrDataUri }}" alt="QR Code" class="img-fluid border rounded mb-3" style="max-width: 260px;"> --}}

                        <div class="bg-light rounded p-3 text-start small">
                            <div class="d-flex justify-content-between border-bottom py-1">
                                <span class="text-muted">মোবাইল</span>
                                <strong>{{ $user->mobile }}</strong>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-1">
                                <span class="text-muted">রোল নম্বর</span>
                                <strong>{{ $user->studentDetail->roll_number ?? '—' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1">
                                <span class="text-muted">রেজিস্ট্রেশন নম্বর</span>
                                <strong>{{ $user->studentDetail->registration_number ?? '—' }}</strong>
                            </div>
                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            <i class="fas fa-info-circle"></i> এই QR কোডটি স্ক্যান করলে প্রবেশ নিশ্চিত হবে।
                        </p>

                        <button type="button" onclick="window.print()" class="btn btn-outline-secondary btn-sm mt-3">
                            <i class="fas fa-print"></i> প্রিন্ট করুন
                        </button>
                    </div>
                </div>
            @else
                <div class="card border-danger shadow-lg">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-times-circle text-danger mb-3" style="font-size: 3.5rem;"></i>
                        <h4 class="text-danger mb-2">Invalid or Unregistered QR Code.</h4>
                        <p class="text-muted mb-0">এই মোবাইল নম্বরে কোনো নিবন্ধিত অনুমোদিত শিক্ষার্থী পাওয়া যায়নি।</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
