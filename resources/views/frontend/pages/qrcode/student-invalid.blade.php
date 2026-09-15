{{-- resources/views/frontend/pages/qrcode/student-invalid.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'Invalid QR Code')

@section('content')
<div class="container my-5" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-danger shadow-lg">
                <div class="card-body text-center py-5">
                    <i class="fas fa-times-circle text-danger mb-3" style="font-size: 4rem;"></i>
                    <h3 class="text-danger mb-2">Invalid or Unregistered QR Code.</h3>
                    <p class="text-muted mb-0">এই QR কোডটি সঠিক নয় অথবা কোনো নিবন্ধিত শিক্ষার্থীর সাথে সম্পর্কিত নয়।</p>
                    <a href="{{ route('qrcode.index') }}" class="btn btn-outline-danger mt-4">
                        <i class="fas fa-arrow-left"></i> ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
