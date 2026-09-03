{{-- resources/views/frontend/pages/qrcode/index.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'Ceremony Entry QR Code')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5">
                    <h3 class="mb-2">
                        <i class="fas fa-ticket-alt text-primary"></i> Ceremony Entry
                    </h3>
                    <p class="text-muted mb-0">Scan QR code to verify your entry</p>
                </div>
            </div>

            <!-- QR Code Display Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0 text-center">
                        <i class="fas fa-qrcode"></i> Scan This Code
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <img
                            src="{{ $qrImageUrl }}"
                            alt="Ceremony Entry QR Code"
                            class="img-fluid border rounded"
                            style="max-width: 350px;"
                        >
                    </div>
                    <p class="text-muted small">
                        Point your mobile camera or QR scanner at this code.<br>
                        You must be logged in to verify your entry.
                    </p>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="card border-info">
                <div class="card-body">
                    <h6 class="card-title text-info">
                        <i class="fas fa-info-circle"></i> How It Works
                    </h6>
                    <ol class="mb-0 small">
                        <li>
                            <strong>Login First:</strong>
                            <a href="{{ route('student.login') }}">Log in with your credentials</a>
                        </li>
                        <li><strong>Scan QR:</strong> Use your phone camera or QR scanner app</li>
                        <li><strong>Verify Status:</strong> System checks if you're approved</li>
                        <li><strong>Get Access:</strong> If approved, you'll gain entry</li>
                        <li><strong>One Scan Per Day:</strong> You can only scan once per day</li>
                    </ol>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-4 text-center">
                @auth
                    <p class="text-muted small mb-2">
                        Already logged in? <a href="{{ route('student.ceremony.history') }}">View your entry history</a>
                    </p>
                @endauth
                @guest
                    <p class="text-muted small mb-0">
                        <a href="{{ route('student.login') }}">Login here</a> to verify your entry
                    </p>
                @endguest
            </div>

        </div>
    </div>
</div>
@endsection
