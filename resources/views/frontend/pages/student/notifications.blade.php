@extends('frontend.layouts.app')

@section('title', 'নোটিফিকেশন')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div
                        class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="mb-0"><i class="fas fa-bell text-danger me-2"></i>আমার নোটিফিকেশন</h4>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> ড্যাশবোর্ডে ফিরুন
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($notifications as $notif)
                            <div class="notif-list-item d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }} {{ $notif->is_read ? '' : 'bg-light' }}"
                                data-read-url="{{ route('student.notifications.read', $notif->id) }}"
                                data-title="{{ $notif->title }}" data-message="{{ $notif->message }}"
                                style="cursor: pointer; border-radius: 10px; padding-left: 10px; padding-right: 10px;">
                                <div class="flex-shrink-0">
                                    <i class="fas {{ $notif->icon }} fs-4"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <h6 class="mb-1 fw-bold">{{ $notif->title }}</h6>
                                        @if (!$notif->is_read)
                                            <span class="badge bg-danger rounded-pill"
                                                style="font-size: 0.6rem;">নতুন</span>
                                        @endif
                                    </div>
                                    <p class="mb-1 text-muted small">
                                        {{ \Illuminate\Support\Str::limit($notif->message, 150) }}</p>
                                    <small class="text-muted">{{ $notif->created_at->format('d M Y, h:i A') }}
                                        ({{ $notif->created_at->diffForHumans() }})
                                    </small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">কোনো নোটিফিকেশন পাওয়া যায়নি</p>
                            </div>
                        @endforelse
                    </div>
                    @if ($notifications->hasPages())
                        <div class="card-footer bg-white border-0">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            document.querySelectorAll('.notif-list-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    const title = this.dataset.title;
                    const message = this.dataset.message;

                    Swal.fire({
                        title: title,
                        html: message.replace(/\n/g, '<br>'),
                        icon: 'info',
                        confirmButtonColor: '#d32f2f',
                        confirmButtonText: 'বন্ধ করুন'
                    });

                    if (this.classList.contains('bg-light')) {
                        this.classList.remove('bg-light');
                        const newBadge = this.querySelector('.badge');
                        if (newBadge) newBadge.remove();

                        fetch(this.dataset.readUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            }
                        }).catch(() => {});
                    }
                });
            });
        });
    </script>
@endpush
