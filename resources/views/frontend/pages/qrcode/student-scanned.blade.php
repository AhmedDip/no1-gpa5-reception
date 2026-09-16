{{-- resources/views/frontend/pages/qrcode/student-scanned.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'প্রবেশ সফল')

@section('content')
<div class="container my-5" style="margin-top: 90px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-success shadow-lg">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>

                    <img src="{{ $detail->student_photo_url }}"
                         class="rounded-circle mb-3"
                         style="width:110px;height:110px;object-fit:cover;border:4px solid #e8f5e9;"
                         alt="{{ $user->name }}">

                    <h3 class="mb-1">প্রিয় {{ $detail->name_bn ?? $user->name }}, স্বাগতম!</h3>
                    <p class="text-muted mb-4">আপনার প্রবেশ সফলভাবে রেকর্ড করা হয়েছে।</p>

                    <div class="bg-light p-4 rounded mb-4 text-start">
                        <div class="row g-2">
                            <div class="col-6">
                                <small class="text-muted d-block">নাম (ইংরেজি)</small>
                                <strong>{{ $detail->name_en ?? '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">মোবাইল</small>
                                <strong>{{ $user->mobile }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">রোল নম্বর</small>
                                <strong>{{ $detail->roll_number ?? '—' }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">রেজিস্ট্রেশন নম্বর</small>
                                <strong>{{ $detail->registration_number ?? '—' }}</strong>
                            </div>
                        </div>
                    </div>

                    <p class="text-muted small mb-0">
                        <i class="fas fa-clock"></i> স্ক্যান করা হয়েছে: {{ now()->format('d M Y, h:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
