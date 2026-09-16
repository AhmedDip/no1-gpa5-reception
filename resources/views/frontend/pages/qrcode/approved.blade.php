{{-- resources/views/frontend/pages/qrcode/approved.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'প্রবেশ অনুমোদিত')

@section('content')
<div class="container my-5" style="margin-top: 90px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Success Card -->
            <div class="card border-success shadow-lg">
                <div class="card-body text-center py-5">

                    <!-- Success Icon -->
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>

                    <!-- Title & Message -->
                    <h2 class="mb-3">
                        প্রিয় নাম্বার ওয়ান বাবার কৃতী সন্তান  {{ $studnetBname }} আপনাকে স্বাগতম
                    </h2>

                    <!-- Details -->
                    <div class="bg-light p-4 rounded mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>শিক্ষার্থীর নাম:</strong><br>
                                    {{ auth()->user()->name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>এন্ট্রি আইডি:</strong><br>
                                    #{{ $entry_id }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-0">
                            <strong>স্ক্যান করা হয়েছে:</strong><br>
                            {{ $scanned_at }}
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('qrcode.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-arrow-left"></i> QR কোডে ফিরে যান
                        </a>
                        <a href="{{ route('student.ceremony.history') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history"></i> প্রবেশের ইতিহাস দেখুন
                        </a>
                    </div>

                    <!-- Note -->
                    <p class="text-muted small mt-4 mb-0">
                        <i class="fas fa-check"></i> আপনি সংবর্ধনার ভেন্যুতে প্রবেশের জন্য অনুমোদিত।
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
