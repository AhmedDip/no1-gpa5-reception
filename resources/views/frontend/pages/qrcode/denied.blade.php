{{-- resources/views/frontend/pages/qrcode/denied.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'Entry Denied')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Denied Card -->
            <div class="card border-danger shadow-lg">
                <div class="card-body text-center py-5">

                    <!-- Warning Icon -->
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                    </div>

                    <!-- Title & Message -->
                    <h2 class="mb-3 text-danger">
                        Entry Denied
                    </h2>

                    <p class="lead text-muted mb-4">
                        {{ $message }}
                    </p>

                    <!-- Status Info -->
                    <div class="alert alert-warning">
                        <p class="mb-0">
                            <strong>Current Status:</strong><br>
                            <span class="badge bg-warning text-dark">{{ $current_status ?? 'Unknown' }}</span>
                        </p>
                    </div>

                    <!-- Details -->
                    <div class="bg-light p-4 rounded mb-4">
                        <p class="small mb-2">
                            <strong>Student Name:</strong><br>
                            {{ auth()->user()->name }}
                        </p>
                        <hr>
                        <p class="small mb-0">
                            <strong>Application Status:</strong><br>
                            Your application needs to be approved to gain entry.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('ceremony.display') }}" class="btn btn-outline-danger btn-lg">
                            <i class="fas fa-arrow-left"></i> Back to QR Code
                        </a>
                        <button type="button" class="btn btn-light" onclick="contactSupport()">
                            <i class="fas fa-envelope"></i> Contact Support
                        </button>
                    </div>

                    <!-- Help Text -->
                    <div class="alert alert-info mt-4 mb-0">
                        <small class="mb-0">
                            For assistance, please contact the administration office or email support.
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function contactSupport() {
    // You can customize this based on your support channel
    alert('Please contact: admin@example.com');
}
</script>
@endsection
