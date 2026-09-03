{{-- resources/views/frontend/pages/qrcode/index.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'সংবর্ধনায় প্রবেশের QR কোড')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5">
                    <h3 class="mb-2">
                        <i class="fas fa-qrcode"></i> সংবর্ধনায় প্রবেশ
                    </h3>
                    <p class="text-muted mb-0">প্রবেশ নিশ্চিত করতে QR কোড স্ক্যান করুন</p>
                </div>
            </div>

            <!-- QR Code Display Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0 text-center">
                        <i class="fas fa-qrcode"></i> এই কোডটি স্ক্যান করুন
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <img
                            src="{{ $qrImageUrl }}"
                            alt="সংবর্ধনায় প্রবেশের QR কোড"
                            class="img-fluid border rounded"
                            style="max-width: 350px;"
                        >
                    </div>
                    <p class="text-muted small">
                        আপনার মোবাইল ক্যামেরা বা QR স্ক্যানার দিয়ে এই কোডটি স্ক্যান করুন।<br>
                        প্রবেশ যাচাই করতে অবশ্যই লগইন থাকতে হবে।
                    </p>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="card border-info">
                <div class="card-body">
                    <h6 class="card-title text-info">
                        <i class="fas fa-info-circle"></i> যেভাবে কাজ করে
                    </h6>
                    <ol class="mb-0 small">
                        <li>
                            <strong>প্রথমে লগইন করুন:</strong>
                            <a href="{{ route('student.login') }}">আপনার তথ্য দিয়ে লগইন করুন</a>
                        </li>
                        <li><strong>QR স্ক্যান করুন:</strong> ফোনের ক্যামেরা বা QR স্ক্যানার অ্যাপ ব্যবহার করুন</li>
                        <li><strong>স্ট্যাটাস যাচাই:</strong> সিস্টেম আপনার আবেদন অনুমোদিত কিনা যাচাই করবে</li>
                        <li><strong>প্রবেশাধিকার পান:</strong> অনুমোদিত হলে আপনি প্রবেশ করতে পারবেন</li>
                        <li><strong>একবারই স্ক্যান:</strong> শুধুমাত্র একবার স্ক্যান করা যাবে</li>
                    </ol>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-4 text-center">
                @auth
                    <p class="text-muted small mb-2">
                        ইতিমধ্যে লগইন করা আছে? <a href="{{ route('student.ceremony.history') }}">আপনার প্রবেশের ইতিহাস দেখুন</a>
                    </p>
                @endauth
                @guest
                    <p class="text-muted small mb-0">
                        প্রবেশ যাচাই করতে <a href="{{ route('student.login') }}">এখানে লগইন করুন</a>
                    </p>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection
