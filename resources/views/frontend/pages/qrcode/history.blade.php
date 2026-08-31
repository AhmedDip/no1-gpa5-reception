{{-- resources/views/frontend/pages/qrcode/history.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'Ceremony Entry History')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-history"></i> Ceremony Entry History
                    </h3>
                    <p class="text-muted mb-0">Your attendance record</p>
                </div>
                <a href="{{ route('ceremony.display') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-qrcode"></i> Scan Again
                </a>
            </div>

            <!-- Entries List -->
            @if($entries->count() > 0)
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            <strong>{{ $entry->scanned_at->format('M d, Y') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $entry->scanned_at->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            @if($entry->status === 'approved')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Approved
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle"></i> Denied
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
                        No entries yet. <a href="{{ route('ceremony.display') }}">Scan the QR code</a>
                    </p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
