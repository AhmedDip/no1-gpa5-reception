{{-- resources/views/frontend/pages/qrcode/approved.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'Entry Approved')

@section('content')
<div class="container my-5">
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
                    <h2 class="mb-3 text-success">
                        {{ $message }}
                    </h2>

                    <!-- Details -->
                    <div class="bg-light p-4 rounded mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Student Name:</strong><br>
                                    {{ auth()->user()->name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Entry ID:</strong><br>
                                    #{{ $entry_id }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-0">
                            <strong>Scanned At:</strong><br>
                            {{ $scanned_at }}
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('ceremony.display') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-arrow-left"></i> Back to QR Code
                        </a>
                        <a href="{{ route('ceremony.history') }}" class="btn btn-outline-primary">
                            <i class="fas fa-history"></i> View Entry History
                        </a>
                    </div>

                    <!-- Note -->
                    <p class="text-muted small mt-4 mb-0">
                        <i class="fas fa-check"></i> You are authorized to enter the ceremony venue.
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
