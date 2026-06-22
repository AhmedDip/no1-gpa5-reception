{{-- resources/views/frontend/pages/student/dashboard.blade.php --}}

@extends('frontend.layouts.app')

@section('title', 'শিক্ষার্থী ড্যাশবোর্ড')

@section('content')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .stat-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .profile-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .profile-image:hover {
        transform: scale(1.05);
    }
    .info-card {
        border-radius: 15px;
        border: none;
        transition: all 0.3s ease;
    }
    .info-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }
    .menu-btn {
        transition: all 0.3s ease;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
    }
    .menu-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .progress-bar-custom {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }
    .event-card {
        border-left: 4px solid #d32f2f;
        transition: all 0.3s ease;
    }
    .event-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        transform: rotate(45deg);
    }
    .detail-row {
        border-bottom: 1px solid #e0e0e0;
        padding: 12px 0;
        transition: all 0.3s ease;
    }
    .detail-row:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }
    .quick-action-btn {
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .quick-action-btn:hover {
        transform: translateY(-2px);
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #d32f2f;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        font-weight: bold;
    }
</style>

<div class="container py-4 mb-5">
    <!-- Welcome Banner -->
    <div class="welcome-banner fade-in-up" style="margin-top: 80px; margin-bottom: 40px;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">
                    <i class="fas fa-user-graduate fa-flip me-2"  style="--fa-animation-duration: 5s;"></i>
                    স্বাগতম, {{ $userDetail->name_bn }}!
                </h2>
                <p class="mb-0 opacity-90">
                    <i class="fas fa-calendar-alt me-2"></i>
                    আজকে {{ date('j F, Y', strtotime(now())) }} |
                    <i class="fas fa-clock ms-2 me-2"></i>
                    {{ date('h:i A', strtotime(now())) }}
                </p>
                <p class="mt-2 mb-0">
                    <i class="fas fa-trophy me-2"></i>
                    আপনার আবেদন সফলভাবে জমা হয়েছে। শুভ কামনা!
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex p-3">
                    <i class="fas fa-graduation-cap fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Information -->
        <div class="col-lg-4 mb-4 fade-in-up" style="animation-delay: 0.1s">
            <!-- Profile Card -->
            <div class="card info-card shadow-sm mb-4">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block">
                        @if($userDetail->student_photo)
                            <img src="{{ asset('storage/' . $userDetail->student_photo) }}"
                                 class="rounded-circle profile-image"
                                 alt="{{ $userDetail->name_en }}">
                        @else
                            <div class="rounded-circle profile-image bg-gradient d-flex align-items-center justify-content-center mx-auto"
                                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-user-graduate fa-4x text-white"></i>
                            </div>
                        @endif
                    </div>

                    <h3 class="mt-3 mb-1 fw-bold">{{ $userDetail->name_en }}</h3>
                    <p class="text-muted mb-3">{{ $userDetail->name_bn }}</p>

                    @php
                        $statusColors = [
                            1 => ['bg' => 'warning', 'text' => 'pending'],
                            2 => ['bg' => 'success', 'text' => 'approved'],
                            3 => ['bg' => 'danger', 'text' => 'rejected'],
                            4 => ['bg' => 'info', 'text' => 'under-review']
                        ];
                        $status = $statusColors[$userDetail->application_status_id] ?? ['bg' => 'secondary', 'text' => 'pending'];
                    @endphp

                    <span class="status-badge bg-{{ $status['bg'] }} text-white d-inline-block mb-3">
                        <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                        স্ট্যাটাস: {{ $userDetail->applicationStatus->name ?? 'Pending' }}
                    </span>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="border-end">
                                <small class="text-muted d-block">মোবাইল</small>
                                <strong>{{ $user->mobile }}</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <small class="text-muted d-block">ইমেইল</small>
                                <strong class="small">{{ $user->email ?? 'প্রদান করা হয়নি' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Information Card -->
            <div class="card info-card shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-book-open text-primary me-2"></i>
                        শিক্ষাগত তথ্য
                    </h5>
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="row">
                            <div class="col-6 text-muted">এসএসসি বোর্ড:</div>
                            <div class="col-6 fw-semibold">{{ $userDetail->board->name_bn ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="row">
                            <div class="col-6 text-muted">গ্রুপ:</div>
                            <div class="col-6 fw-semibold">{{ $userDetail->group->name_bn ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="row">
                            <div class="col-6 text-muted">রোল নম্বর:</div>
                            <div class="col-6 fw-semibold">{{ $userDetail->roll_number }}</div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="row">
                            <div class="col-6 text-muted">রেজিস্ট্রেশন নম্বর:</div>
                            <div class="col-6 fw-semibold">{{ $userDetail->registration_number }}</div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="row">
                            <div class="col-6 text-muted">জিপিএ/ফলাফল:</div>
                            <div class="col-6 fw-bold text-success">{{ $userDetail->gpa_result }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Main Content -->
        <div class="col-lg-8 fade-in-up" style="animation-delay: 0.2s">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card stat-card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">আবেদন স্ট্যাটাস</h6>
                                    <h3 class="text-white mb-0">{{ $userDetail->applicationStatus->name ?? 'Pending' }}</h3>
                                </div>
                                <i class="fas fa-clipboard-list fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card stat-card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">এসএসসি ফলাফল</h6>
                                    <h3 class="text-white mb-0">{{ $userDetail->gpa_result }}</h3>
                                </div>
                                <i class="fas fa-chart-line fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card stat-card bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">নিবন্ধন নম্বর</h6>
                                    <h6 class="text-white mb-0">{{ $userDetail->registration_number }}</h6>
                                </div>
                                <i class="fas fa-id-card fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card info-card shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        দ্রুত কর্মসমূহ
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('student.edit.application') }}" class="text-decoration-none">
                                <div class="menu-btn bg-light">
                                    <i class="fas fa-edit fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0 text-dark">তথ্য সম্পাদনা</h6>
                                    <small class="text-muted">আপনার তথ্য আপডেট করুন</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('student.download.certificate') }}" class="text-decoration-none">
                                <div class="menu-btn bg-light">
                                    <i class="fas fa-download fa-2x text-success mb-2"></i>
                                    <h6 class="mb-0 text-dark">একনলজমেন্ট সার্টিফিকেট</h6>
                                    <small class="text-muted">ডাউনলোড করুন</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('student.invitation.letter') }}" class="text-decoration-none" id="downloadInvitation">
                                <div class="menu-btn bg-light">
                                    <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
                                    <h6 class="mb-0 text-dark">আমন্ত্রণপত্র</h6>
                                    <small class="text-muted">ইভেন্টের আমন্ত্রণপত্র</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parent Information Card -->
            @if($userDetail->is_parent_info_provided)
            <div class="card info-card shadow-sm mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-users text-info me-2"></i>
                        অভিভাবকের তথ্য
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-row">
                                <div class="row">
                                    <div class="col-5 text-muted">পিতার নাম:</div>
                                    <div class="col-7 fw-semibold">{{ $userDetail->father_name }}</div>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="row">
                                    <div class="col-5 text-muted">মাতার নাম:</div>
                                    <div class="col-7 fw-semibold">{{ $userDetail->mother_name }}</div>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="row">
                                    <div class="col-5 text-muted">অভিভাবকের মোবাইল:</div>
                                    <div class="col-7 fw-semibold">{{ $userDetail->parent_mobile }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-row">
                                <div class="row">
                                    <div class="col-5 text-muted">চায়ের দোকানের নাম:</div>
                                    <div class="col-7 fw-semibold">{{ $userDetail->tea_stall_name }}</div>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="row">
                                    <div class="col-5 text-muted">দোকানের অবস্থান:</div>
                                    <div class="col-7 fw-semibold">{{ $userDetail->tea_stall_location }}</div>
                                </div>
                            </div>
                            @if($userDetail->parent_photo)
                            <div class="mt-2">
                                <small class="text-muted">অভিভাবকের ছবি:</small>
                                <a href="{{ asset('storage/' . $userDetail->parent_photo) }}" target="_blank" class="d-block">
                                    <i class="fas fa-image"></i> ছবি দেখুন
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Event Information Card -->
            <div class="card info-card shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-calendar-alt text-danger me-2"></i>
                        ইভেন্ট তথ্য
                    </h5>
                </div>
                <div class="card-body">
                    <div class="event-card p-3 mb-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">স্থান</h6>
                                <p class="mb-0 text-muted">শীঘ্রই ঘোষণা করা হবে</p>
                            </div>
                        </div>
                    </div>

                    <div class="event-card p-3 mb-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fas fa-calendar-day fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">তারিখ ও সময়</h6>
                                <p class="mb-0 text-muted">শীঘ্রই ঘোষণা করা হবে</p>
                            </div>
                        </div>
                    </div>

                    <div class="event-card p-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fas fa-info-circle fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">বিশেষ দ্রষ্টব্য</h6>
                                <p class="mb-0 text-muted small">
                                    সকল আপডেট এই ড্যাশবোর্ডে জানানো হবে। নিয়মিত ভিজিট করার জন্য ধন্যবাদ।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Parent Information Modal (if not provided) -->
@if($showParentModal)
<div class="modal fade" id="parentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-users me-2"></i>অভিভাবকের তথ্য প্রদান করুন
                </h5>

            </div>
            <form action="{{ route('student.update.parent') }}" method="POST" enctype="multipart/form-data" id="parentForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        আপনার ড্যাশবোর্ড সম্পূর্ণভাবে দেখার জন্য অভিভাবকের তথ্য প্রদান করা আবশ্যক।
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">পিতার নাম</label>
                            <input type="text" class="form-control" name="father_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">মাতার নাম</label>
                            <input type="text" class="form-control" name="mother_name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">চায়ের দোকানের নাম</label>
                            <input type="text" class="form-control" name="tea_stall_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">চায়ের দোকানের অবস্থান</label>
                            <input type="text" class="form-control" name="tea_stall_location" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">অভিভাবকের মোবাইল নম্বর</label>
                            <input type="tel" class="form-control" name="parent_mobile" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">অভিভাবকের ছবি</label>
                            <input type="file" class="form-control" name="parent_photo" accept="image/*" id="parentPhoto">
                            <small class="text-muted">জেপিইজি বা পিএনজি ফরম্যাটে (সর্বোচ্চ ২এমবি)</small>
                            <div id="parentPhotoPreview" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-save me-2"></i>সেভ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    @if($showParentModal)
    // Show parent modal on page load
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('parentModal'));
        modal.show();

        // Parent photo preview
        document.getElementById('parentPhoto').addEventListener('change', function(e) {
            const preview = document.getElementById('parentPhotoPreview');
            preview.innerHTML = '';

            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.maxHeight = '200px';
                    img.style.marginTop = '10px';
                    img.style.borderRadius = '10px';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    @endif

    // Welcome animation and notification
    document.addEventListener('DOMContentLoaded', function() {
        // Download invitation button handler
        document.getElementById('downloadInvitation').addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            window.open(url, '_blank');
        });
    });

    // Real-time clock update
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('bn-BD', { hour: '2-digit', minute: '2-digit' });
        const clockElement = document.querySelector('.fa-clock');
        if (clockElement) {
            clockElement.nextSibling.textContent = ` ${timeString}`;
        }
    }
    setInterval(updateClock, 60000);
</script>
@endpush
@endsection
