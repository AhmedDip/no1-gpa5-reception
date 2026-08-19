@extends('frontend.layouts.app')

@section('title', 'তথ্য সম্পাদনা')

@section('content')
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .info-card {
            border-radius: 15px;
            border: none;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #333;
        }

        .required:after {
            content: " *";
            color: red;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            width: 100%;
        }

        .invalid-feedback.show {
            display: block;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .alert-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            color: #1565c0;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee 0%, #fce4ec 100%);
            color: #c62828;
        }

        .card-header-custom {
            background: transparent;
            border-bottom: 2px solid #f0f0f0;
            padding: 1rem 1.25rem 0.5rem 1.25rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-back {
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .btn-back:hover {
            background-color: #e0e0e0;
            color: #333;
        }

        .photo-preview {
            position: relative;
            display: inline-block;
            margin-top: 1rem;
        }

        .photo-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            object-fit: cover;
        }

        .current-photo {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .current-photo img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #ddd;
            object-fit: cover;
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
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

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #667eea;
            display: inline-block;
        }

        .btn-group-custom {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-group-custom .btn {
            flex: 1;
        }

        .form-row-info {
            font-size: 0.875rem;
            color: #666;
            margin-top: 0.5rem;
        }

        /* Dashboard style consistency */
        .welcome-banner {
            background: linear-gradient(135deg, #c96a6a 0%, #940b0b 100%);
            border-radius: 15px;
            padding: 30px;
            color: rgb(255, 255, 255);
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
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

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .detail-value {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .stat-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f9ff 5%, #fdfdff 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-edit {
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="container py-4 mb-5">
        <!-- Welcome Banner -->
        <div class="welcome-banner fade-in-up" style="margin-top: 80px; margin-bottom: 40px;">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">
                        <i class="fas fa-edit me-2"></i>
                        তথ্য সম্পাদনা
                    </h2>
                    <p class="mb-0 opacity-90">
                        <i class="fas fa-info-circle me-2"></i>
                        আপনার আবেদনের তথ্য আপডেট করুন। সমস্ত বাধ্যতামূলক ক্ষেত্র চিহ্নিত করা হয়েছে।
                    </p>
                    <p class="mt-2 mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        {{ $studentDetail->name_bn ?? '' }} ({{ $studentDetail->name_en ?? '' }})
                    </p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex p-3">
                        <i class="fas fa-user-edit fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile Info (like dashboard) -->
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.1s">
                <!-- Profile Card -->
                <div class="card info-card shadow-sm mb-4">
                    <div class="card-body text-center p-4">
                        <div class="position-relative d-inline-block">
                            @if ($studentDetail?->student_photo)
                                <img src="{{ $studentDetail->student_photo_url }}" class="rounded-circle profile-image"
                                    alt="{{ $studentDetail->name_en }}">
                            @else
                                <div class="rounded-circle profile-image bg-gradient d-flex align-items-center justify-content-center mx-auto"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-user-graduate fa-3x text-white"></i>
                                </div>
                            @endif
                        </div>

                        <h3 class="mt-3 mb-1 fw-bold">{{ $studentDetail?->name_en }}</h3>
                        <p class="text-muted mb-3">{{ $studentDetail?->name_bn }}</p>

                        @php
                            $statusColors = [
                                1 => ['bg' => 'warning', 'text' => 'pending'],
                                2 => ['bg' => 'success', 'text' => 'approved'],
                                3 => ['bg' => 'danger', 'text' => 'rejected'],
                                4 => ['bg' => 'info', 'text' => 'under-review'],
                            ];
                            $status = $statusColors[$studentDetail->application_status_id] ?? [
                                'bg' => 'secondary',
                                'text' => 'pending',
                            ];
                        @endphp

                        <span class="status-badge bg-{{ $status['bg'] }} text-white d-inline-block mb-3">
                            <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                            স্ট্যাটাস: {{ $studentDetail?->applicationStatus->name ?? 'Pending' }}
                        </span>

                        <div class="row mt-3 g-2">
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

                        <hr>

                        <a href="{{ route('student.dashboard') }}" class="btn btn-back w-100">
                            <i class="fas fa-arrow-left me-2"></i>ড্যাশবোর্ডে ফিরুন
                        </a>
                    </div>
                </div>

                <!-- Academic Information Card (Read-only summary) -->
                <div class="card info-card shadow-sm">
                    <div class="card-header card-header-custom">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-book-open text-primary me-2"></i>
                            বর্তমান শিক্ষাগত তথ্য
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="detail-row">
                            <div class="row g-0">
                                <div class="col-6 detail-label">এসএসসি বোর্ড:</div>
                                <div class="col-6 detail-value">{{ $studentDetail->board->name_bn ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="row g-0">
                                <div class="col-6 detail-label">গ্রুপ:</div>
                                <div class="col-6 detail-value">{{ $studentDetail->group->name_bn ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="row g-0">
                                <div class="col-6 detail-label">রোল নম্বর:</div>
                                <div class="col-6 detail-value">{{ $studentDetail->roll_number }}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="row g-0">
                                <div class="col-6 detail-label">রেজিস্ট্রেশন নম্বর:</div>
                                <div class="col-6 detail-value">{{ $studentDetail->registration_number }}</div>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="row g-0">
                                <div class="col-6 detail-label">জিপিএ/ফলাফল:</div>
                                <div class="col-6 detail-value text-success">{{ $studentDetail->gpa_result }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Edit Form -->
            <div class="col-lg-8 fade-in-up" style="animation-delay: 0.2s">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading">
                            <i class="fas fa-exclamation-circle me-2"></i>দয়া করে নিম্নলিখিত ত্রুটিগুলো সংশোধন করুন:
                        </h5>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Info Alert -->
                <div class="alert alert-info">
                    <i class="fas fa-clock me-2"></i>
                    <strong>মনে রাখবেন:</strong> নির্ধারিত সময়ের মধ্যে শুধুমাত্র আপনার তথ্য সম্পাদনা করা যাবে।
                </div>

                <!-- Statistics Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card text-dark h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-dark-50 mb-1">আবেদন স্ট্যাটাস</h6>
                                        <h3 class="text-dark mb-0">
                                            {{ $studentDetail?->applicationStatus->name ?? 'Pending' }}
                                        </h3>
                                    </div>
                                    <img src="{{ asset('images/animated-icon/status.gif') }}" alt="Application Status"
                                        class="img-fluid" style="max-width: 40px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card bg-success text-dark h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-dark-50 mb-1">এসএসসি ফলাফল</h6>
                                        <h3 class="text-dark mb-0">{{ $studentDetail?->gpa_result }}</h3>
                                    </div>
                                    <img src="{{ asset('images/animated-icon/result.gif') }}" alt="GPA Result"
                                        class="img-fluid" style="max-width: 40px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card bg-info text-dark h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-dark-50 mb-1">নিবন্ধন নম্বর</h6>
                                        <h6 class="text-dark mb-0">{{ $studentDetail?->registration_number }}</h6>
                                    </div>
                                    <img src="{{ asset('images/animated-icon/registration.gif') }}"
                                        alt="Registration Number" class="img-fluid" style="max-width: 40px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="card info-card shadow-sm">
                    <div class="card-header card-header-custom">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-user-edit text-primary me-2"></i>
                            তথ্য সম্পাদনা ফর্ম
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('student.update.application') }}" method="POST" enctype="multipart/form-data" id="editForm" novalidate>
                            @csrf

                            <!-- Name Section -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-user me-2"></i>ব্যক্তিগত তথ্য
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">ইংরেজিতে নাম</label>
                                        <input type="text" 
                                               class="form-control @error('name_en') is-invalid @enderror" 
                                               name="name_en" 
                                               placeholder="ইংরেজি নাম" 
                                               value="{{ old('name_en', $studentDetail->name_en) }}" 
                                               required 
                                               minlength="3" 
                                               maxlength="100">
                                        <div class="form-row-info">শুধুমাত্র ইংরেজি অক্ষর ব্যবহার করুন</div>
                                        @error('name_en')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">বাংলায় নাম</label>
                                        <input type="text" 
                                               class="form-control @error('name_bn') is-invalid @enderror" 
                                               name="name_bn" 
                                               placeholder="বাংলা নাম" 
                                               value="{{ old('name_bn', $studentDetail->name_bn) }}" 
                                               required 
                                               minlength="3" 
                                               maxlength="100">
                                        <div class="form-row-info">শুধুমাত্র বাংলা অক্ষর ব্যবহার করুন</div>
                                        @error('name_bn')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information Section -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-book-open me-2"></i>শিক্ষাগত তথ্য
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">এসএসসি বোর্ড</label>
                                        <select class="form-select @error('ssc_board_id') is-invalid @enderror" 
                                                name="ssc_board_id" 
                                                required>
                                            <option value="">বোর্ড নির্বাচন করুন</option>
                                            @foreach($sscBoards as $board)
                                                <option value="{{ $board->id }}" 
                                                        {{ old('ssc_board_id', $studentDetail->ssc_board_id) == $board->id ? 'selected' : '' }}>
                                                    {{ $board->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ssc_board_id')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">গ্রুপ</label>
                                        <select class="form-select @error('student_group_id') is-invalid @enderror" 
                                                name="student_group_id" 
                                                required>
                                            <option value="">গ্রুপ নির্বাচন করুন</option>
                                            @foreach($studentGroups as $group)
                                                <option value="{{ $group->id }}" 
                                                        {{ old('student_group_id', $studentDetail->student_group_id) == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_group_id')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">রোল নম্বর</label>
                                        <input type="text" 
                                               class="form-control @error('roll_number') is-invalid @enderror" 
                                               name="roll_number" 
                                               placeholder="রোল নম্বর" 
                                               value="{{ old('roll_number', $studentDetail->roll_number) }}" 
                                               required 
                                               maxlength="10"
                                               pattern="[0-9]+">
                                        <div class="form-row-info">শুধুমাত্র সংখ্যা ব্যবহার করুন</div>
                                        @error('roll_number')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">রেজিস্ট্রেশন নম্বর</label>
                                        <input type="text" 
                                               class="form-control @error('registration_number') is-invalid @enderror" 
                                               name="registration_number" 
                                               placeholder="রেজিস্ট্রেশন নম্বর" 
                                               value="{{ old('registration_number', $studentDetail->registration_number) }}" 
                                               required 
                                               maxlength="15"
                                               pattern="[0-9]+">
                                        <div class="form-row-info">শুধুমাত্র সংখ্যা ব্যবহার করুন</div>
                                        @error('registration_number')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">জিপিএ/ফলাফল</label>
                                        <input type="number"
                                               class="form-control @error('gpa_result') is-invalid @enderror" 
                                               step="0.01" 
                                               min="0" 
                                               max="5"
                                               name="gpa_result" 
                                               placeholder="যেমন: 5.00" 
                                               value="{{ old('gpa_result', $studentDetail->gpa_result) }}" 
                                               required>
                                        <div class="form-row-info">
                                            জিপিএ ৫ এর মধ্যে হতে হবে। যেমন: 4.75, 5.00 ইত্যাদি।
                                        </div>
                                        @error('gpa_result')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Location Section -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-map-marker-alt me-2"></i>ঠিকানা
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-4">
                                        <label class="form-label required">বিভাগ</label>
                                        <select class="form-select @error('division_id') is-invalid @enderror" 
                                                name="division_id" 
                                                id="division_id" 
                                                required>
                                            <option value="">বিভাগ নির্বাচন করুন</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" 
                                                        {{ old('division_id', $studentDetail->division_id) == $division->id ? 'selected' : '' }}>
                                                    {{ $division->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">জেলা</label>
                                        <select class="form-select @error('district_id') is-invalid @enderror" 
                                                name="district_id" 
                                                id="district_id" 
                                                required>
                                            <option value="">জেলা নির্বাচন করুন</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" 
                                                        {{ old('district_id', $studentDetail->district_id) == $district->id ? 'selected' : '' }}>
                                                    {{ $district->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">উপজেলা</label>
                                        <select class="form-select @error('upazila_id') is-invalid @enderror" 
                                                name="upazila_id" 
                                                id="upazila_id" 
                                                required>
                                            <option value="">উপজেলা নির্বাচন করুন</option>
                                            @foreach($upazilas as $upazila)
                                                <option value="{{ $upazila->id }}" 
                                                        {{ old('upazila_id', $studentDetail->upazila_id) == $upazila->id ? 'selected' : '' }}>
                                                    {{ $upazila->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('upazila_id')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Photo Section -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-image me-2"></i>ছবি
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">শিক্ষার্থীর ছবি আপলোড করুন</label>
                                        <small class="text-muted d-block mb-2">
                                            <i class="fas fa-info-circle me-1"></i>
                                            JPEG বা PNG ফরম্যাটে, সর্বোচ্চ ৫এমবি।
                                        </small>
                                        <input type="file" 
                                               class="form-control @error('student_photo') is-invalid @enderror" 
                                               name="student_photo" 
                                               accept="image/jpeg,image/png,image/jpg" 
                                               id="studentPhoto">
                                        @error('student_photo')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror

                                        <!-- Photo Preview -->
                                        <div id="photoPreview" class="photo-preview"></div>
                                    </div>
                                    <div class="col-md-6">
                                        @if($studentDetail->student_photo)
                                            <label class="form-label">বর্তমান ছবি</label>
                                            <div class="current-photo">
                                                <img src="{{ $studentDetail->student_photo_url }}" alt="বর্তমান ছবি">
                                            </div>
                                        @else
                                            <div class="text-center text-muted py-4">
                                                <i class="fas fa-user-circle fa-4x mb-2 d-block"></i>
                                                <p>কোন ছবি আপলোড করা হয়নি</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="btn-group-custom">
                                <button type="submit" class="btn btn-submit" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>তথ্য আপডেট করুন
                                </button>
                                <a href="{{ route('student.dashboard') }}" class="btn btn-back">
                                    <i class="fas fa-times me-2"></i>বাতিল করুন
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editForm = document.getElementById('editForm');
                const submitBtn = document.getElementById('submitBtn');

                // Function to show validation errors
                function showError(field, message) {
                    field.classList.add('is-invalid');
                    let errorDiv = field.nextElementSibling;
                    while (errorDiv && !errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv = errorDiv.nextElementSibling;
                    }
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.textContent = message;
                        errorDiv.classList.add('show');
                    } else {
                        // Create error div if it doesn't exist
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback show';
                        errorDiv.textContent = message;
                        field.parentNode.insertBefore(errorDiv, field.nextSibling);
                    }
                }

                // Function to clear validation errors
                function clearErrors(field) {
                    field.classList.remove('is-invalid');
                    let errorDiv = field.nextElementSibling;
                    while (errorDiv && !errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv = errorDiv.nextElementSibling;
                    }
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.classList.remove('show');
                        errorDiv.textContent = '';
                    }
                }

                // Clear errors on input
                const formInputs = editForm.querySelectorAll('input, select');
                formInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.classList.contains('is-invalid')) {
                            clearErrors(this);
                        }
                    });
                    input.addEventListener('change', function() {
                        if (this.classList.contains('is-invalid')) {
                            clearErrors(this);
                        }
                    });
                });

                // Form validation on submit
                editForm.addEventListener('submit', function(e) {
                    let isValid = true;
                    
                    // Clear all previous errors
                    this.querySelectorAll('.is-invalid').forEach(el => clearErrors(el));
                    
                    // Validate all required fields
                    const requiredFields = this.querySelectorAll('[required]');
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            showError(field, 'এই ফিল্ডটি পূরণ করুন।');
                        }
                    });

                    // Validate GPA
                    const gpaField = document.querySelector('[name="gpa_result"]');
                    if (gpaField && gpaField.value.trim()) {
                        const gpa = parseFloat(gpaField.value);
                        if (isNaN(gpa) || gpa < 0 || gpa > 5) {
                            isValid = false;
                            showError(gpaField, 'জিপিএ ৫ এর মধ্যে হতে হবে।');
                        }
                    }

                    // Validate roll number
                    const rollField = document.querySelector('[name="roll_number"]');
                    if (rollField && rollField.value.trim()) {
                        if (!/^\d+$/.test(rollField.value)) {
                            isValid = false;
                            showError(rollField, 'রোল নম্বর শুধুমাত্র সংখ্যা হতে পারে।');
                        }
                    }

                    // Validate registration number
                    const regField = document.querySelector('[name="registration_number"]');
                    if (regField && regField.value.trim()) {
                        if (!/^\d+$/.test(regField.value)) {
                            isValid = false;
                            showError(regField, 'রেজিস্ট্রেশন নম্বর শুধুমাত্র সংখ্যা হতে পারে।');
                        }
                    }

                    // Validate name fields (letters only)
                    const nameEnField = document.querySelector('[name="name_en"]');
                    if (nameEnField && nameEnField.value.trim()) {
                        if (!/^[a-zA-Z\s]+$/.test(nameEnField.value)) {
                            isValid = false;
                            showError(nameEnField, 'ইংরেজি নাম শুধুমাত্র অক্ষর এবং স্পেস হতে পারে।');
                        }
                    }

                    const nameBnField = document.querySelector('[name="name_bn"]');
                    if (nameBnField && nameBnField.value.trim()) {
                        if (!/^[\u0980-\u09FF\s]+$/.test(nameBnField.value)) {
                            isValid = false;
                            showError(nameBnField, 'বাংলা নাম শুধুমাত্র বাংলা অক্ষর এবং স্পেস হতে পারে।');
                        }
                    }

                    if (!isValid) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Scroll to first error
                        const firstError = this.querySelector('.is-invalid');
                        if (firstError) {
                            setTimeout(() => {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                firstError.focus();
                            }, 100);
                        }
                    } else {
                        // Show loading state
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>আপডেট হচ্ছে...';
                    }
                });

                // Photo preview
                const studentPhotoInput = document.getElementById('studentPhoto');
                if (studentPhotoInput) {
                    studentPhotoInput.addEventListener('change', function(e) {
                        const preview = document.getElementById('photoPreview');
                        preview.innerHTML = '';

                        if (this.files && this.files[0]) {
                            // Validate file size (5MB max)
                            const maxSize = 5 * 1024 * 1024;
                            if (this.files[0].size > maxSize) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'alert alert-danger mt-2';
                                errorDiv.textContent = 'ফাইল সাইজ ৫এমবি এর চেয়ে বড় হতে পারে না।';
                                preview.appendChild(errorDiv);
                                this.value = '';
                                return;
                            }

                            // Validate file type
                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                            if (!allowedTypes.includes(this.files[0].type)) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'alert alert-danger mt-2';
                                errorDiv.textContent = 'শুধুমাত্র JPEG, PNG অথবা JPG ফাইল অনুমোদিত।';
                                preview.appendChild(errorDiv);
                                this.value = '';
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'mt-2';
                                preview.appendChild(img);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                }
                
                // Dependent dropdowns
                const divisionSelect = document.getElementById('division_id');
                const districtSelect = document.getElementById('district_id');
                const upazilaSelect = document.getElementById('upazila_id');

                if (divisionSelect) {
                    divisionSelect.addEventListener('change', function() {
                        const divisionId = this.value;
                        
                        districtSelect.innerHTML = '<option value="">জেলা নির্বাচন করুন</option>';
                        upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';

                        if (divisionId) {
                            fetch(`/api/districts/${divisionId}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (Array.isArray(data)) {
                                        data.forEach(district => {
                                            const option = document.createElement('option');
                                            option.value = district.id;
                                            option.textContent = district.name_bn;
                                            districtSelect.appendChild(option);
                                        });
                                    }
                                })
                                .catch(error => console.error('Error loading districts:', error));
                        }
                    });
                }

                if (districtSelect) {
                    districtSelect.addEventListener('change', function() {
                        const districtId = this.value;
                        
                        upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';

                        if (districtId) {
                            fetch(`/api/upazilas/${districtId}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (Array.isArray(data)) {
                                        data.forEach(upazila => {
                                            const option = document.createElement('option');
                                            option.value = upazila.id;
                                            option.textContent = upazila.name_bn;
                                            upazilaSelect.appendChild(option);
                                        });
                                    }
                                })
                                .catch(error => console.error('Error loading upazilas:', error));
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection