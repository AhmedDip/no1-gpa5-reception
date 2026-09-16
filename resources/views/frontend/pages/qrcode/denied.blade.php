{{-- resources/views/frontend/pages/qrcode/denied.blade.php --}}

@extends('frontend.layouts.default')

@section('title', 'প্রবেশ প্রত্যাখ্যাত')

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
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
                        প্রবেশ প্রত্যাখ্যাত হয়েছে
                    </h2>

                    <p class="lead text-muted mb-4">
                        {{ $message }}
                    </p>

                    <!-- Status Info -->
                    <div class="alert alert-warning">
                        <p class="mb-0">
                            <strong>বর্তমান স্ট্যাটাস:</strong><br>
                            <span class="badge bg-warning text-dark">{{ $current_status ?? '' }}</span>
                        </p>
                    </div>

                    <!-- Details -->
                    <div class="bg-light p-4 rounded mb-4">
                        <p class="small mb-2">
                            <strong>শিক্ষার্থীর নাম:</strong><br>
                            {{ auth()->user()->name }}
                        </p>
                        <hr>
                        <p class="small mb-0">
                            <strong>আবেদনের স্ট্যাটাস:</strong><br>
                            প্রবেশাধিকার পেতে আপনার আবেদন অনুমোদিত হতে হবে।
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('qrcode.index') }}" class="btn btn-outline-danger btn-lg">
                            <i class="fas fa-arrow-left"></i> QR কোডে ফিরে যান
                        </a>
                        <button type="button" class="btn btn-light" onclick="contactSupport()">
                            <i class="fas fa-envelope"></i> সহায়তার সাথে যোগাযোগ করুন
                        </button>
                    </div>

                    <!-- Help Text -->
                    <div class="alert alert-info mt-4 mb-0">
                        <small class="mb-0">
                            যদি আপনি মনে করেন এটি একটি ভুল, অনুগ্রহ করে আমাদের সহায়তা টিমের সাথে যোগাযোগ করুন।
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function contactSupport() {
    alert('সহায়তার জন্য নির্ধারিত প্রতিনিধির সাথে যোগাযোগ করুন');
}
</script>
@endsection
