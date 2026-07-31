{{-- resources/views/frontend/pages/qrcode/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'QR কোড')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-3">
                    <i class="fas fa-qrcode text-danger me-2"></i>QR কোড
                </h4>

                <img src="{{ $qrImageUrl }}" alt="QR Code" class="img-fluid mb-3 mx-auto d-block"
                     style="max-width: 320px;">

                <p class="text-muted small mb-3 text-break">{{ $targetUrl }}</p>

                <a href="{{ $qrImageUrl }}" download="qrcode.png" class="btn btn-danger">
                    <i class="fas fa-download me-1"></i> ডাউনলোড করুন
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
