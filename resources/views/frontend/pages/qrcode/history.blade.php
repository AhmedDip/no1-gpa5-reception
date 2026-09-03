{{-- resources/views/frontend/pages/qrcode/history.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'সংবর্ধনায় প্রবেশের ইতিহাস')

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-history"></i> সংবর্ধনায় প্রবেশের ইতিহাস
                    </h3>
                    <p class="text-muted mb-0">আপনার উপস্থিতির রেকর্ড</p>
                </div>
                <a href="{{ route('qrcode.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-qrcode"></i> আবার স্ক্যান করুন
                </a>
            </div>

            <!-- Entries List -->
            @if($entries->count() > 0)
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>তারিখ ও সময়</th>
                                    <th>স্ট্যাটাস</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            <strong>{{ $entry->scanned_at->format('d M, Y') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $entry->scanned_at->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            @if($entry->status === 'approved')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> অনুমোদিত
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle"></i> প্রত্যাখ্যাত
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($entries->hasPages())
                    <div class="mt-4">
                        {{ $entries->links() }}
                    </div>
                @endif
            @else
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                    <p class="mt-3 mb-0">
                        এখনো কোনো এন্ট্রি নেই। <a href="{{ route('ceremony.display') }}">QR কোড স্ক্যান করুন</a>
                    </p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
