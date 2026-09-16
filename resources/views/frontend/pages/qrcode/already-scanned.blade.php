{{-- resources/views/frontend/pages/qrcode/already-scanned.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'ইতিমধ্যে স্ক্যান করা হয়েছে')

@section('content')
<div class="container py-4 py-md-5" style="margin-top: 50px; margin-bottom: 100px;">
    <div class="row justify-content-center py-4 py-md-5">
        <div class="col-lg-6 col-md-8">

            <!-- Warning Card -->
            <div class="card border-warning shadow-lg">
                <div class="card-body text-center py-5">

                    <!-- Icon -->
                    <div class="mb-4">
                        <i class="fas fa-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                    </div>

                    <!-- Title & Message -->
                    <h2 class="mb-3 text-warning">
                        প্রবেশ ইতিমধ্যে স্ক্যান করা হয়েছে
                    </h2>

                    <p class="text-muted mb-4">
                        {{ $message }}
                    </p>

                    <!-- Details -->
                    <div class="bg-light p-4 rounded mb-4">
                        <p class="mb-2">
                            <strong>শিক্ষার্থীর নাম:</strong><br>
                            {{ auth()->user()->name }}
                        </p>
                        <hr>
                        <p class="mb-0">
                            <strong>পূর্বে স্ক্যান করা হয়েছে:</strong><br>
                            {{ $scanned_at }}
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('student.ceremony.history') }}" class="btn btn-warning text-white btn-lg">
                            <i class="fas fa-history"></i> প্রবেশের ইতিহাস দেখুন
                        </a>
                        <a href="{{ route('qrcode.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> QR কোডে ফিরে যান
                        </a>
                    </div>

                    <p class="text-muted small mt-4 mb-0">
                        শুধুমাত্র একবার প্রবেশ স্ক্যান করা যায়।
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
