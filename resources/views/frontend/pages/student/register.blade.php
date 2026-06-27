@extends('frontend.layouts.app')

@section('title', 'শিক্ষার্থী রেজিস্ট্রেশন')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="registration-card">
                    {{-- Card Header --}}
                    <div class="card-header-custom">
                        <h4><i class="bi bi-person-badge me-2"></i>শিক্ষার্থী রেজিস্ট্রেশন ফর্ম</h4>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('student.register.submit') }}" method="POST" enctype="multipart/form-data"
                            id="registerForm" novalidate>
                            @csrf

                            {{-- Personal Information Section --}}
                            <div class="form-section">
                                <div class="section-title-icon">
                                    <i class="fas fa-user"></i>
                                    <h5>ব্যক্তিগত তথ্য</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label required">ইংরেজিতে নাম</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                            name="name_en" value="{{ old('name_en') }}"
                                            placeholder="যেমন: Ahmed Rasidun Bari Dip" required>
                                        <div class="invalid-feedback">ইংরেজিতে নাম দিন</div>
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">বাংলায় নাম</label>
                                        <input type="text" class="form-control @error('name_bn') is-invalid @enderror"
                                            name="name_bn" value="{{ old('name_bn') }}"
                                            placeholder="যেমন: আহমেদ রাশিদুন বারী দ্বীপ" required>
                                        <div class="invalid-feedback">বাংলায় নাম দিন</div>
                                        @error('name_bn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">মোবাইল নম্বর</label>
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                            name="mobile" value="{{ old('mobile') }}" placeholder="01XXXXXXXXX"
                                            minlength="11" maxlength="11" required>
                                        <small class="text-muted"><i class="bi bi-info-circle"></i> ১১ ডিজিটের মোবাইল নম্বর
                                            দিন (যেমন: 01712345678)</small>
                                        <div class="invalid-feedback">সঠিক ১১ ডিজিটের মোবাইল নম্বর দিন</div>
                                        @error('mobile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">ইমেইল (ঐচ্ছিক)</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" placeholder="your@email.com">
                                        <div class="invalid-feedback">সঠিক ইমেইল ঠিকানা দিন</div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">পাসওয়ার্ড</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" minlength="6" required>
                                        <div class="invalid-feedback">পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে</div>
                                        <div class="password-strength" id="passwordStrength"></div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">পাসওয়ার্ড নিশ্চিত</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" minlength="6" required>
                                        {{-- <div class="invalid-feedback">পাসওয়ার্ড মিলছে না</div> --}}
                                        <small class="text-muted" id="passwordMatch"></small>
                                    </div>
                                </div>
                            </div>

                            {{-- Educational Information Section --}}
                            <div class="form-section">
                                <div class="section-title-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                    <h5>শিক্ষাগত তথ্য</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label required">এসএসসি বোর্ড</label>
                                        <select class="form-select @error('ssc_board_id') is-invalid @enderror"
                                            name="ssc_board_id" required>
                                            <option value="">বোর্ড নির্বাচন করুন</option>
                                            @foreach ($sscBoards as $board)
                                                <option value="{{ $board->id }}"
                                                    {{ old('ssc_board_id') == $board->id ? 'selected' : '' }}>
                                                    {{ $board->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">বোর্ড নির্বাচন করুন</div>
                                        @error('ssc_board_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">গ্রুপ</label>
                                        <select class="form-select @error('student_group_id') is-invalid @enderror"
                                            name="student_group_id" required>
                                            <option value="">গ্রুপ নির্বাচন করুন</option>
                                            @foreach ($studentGroups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ old('student_group_id') == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">গ্রুপ নির্বাচন করুন</div>
                                        @error('student_group_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">রোল নম্বর</label>
                                        <input type="text"
                                            class="form-control @error('roll_number') is-invalid @enderror" minlength="1"
                                            maxlength="8" name="roll_number" value="{{ old('roll_number') }}"
                                            placeholder="যেমন: 12345678" required>
                                        <div class="invalid-feedback">সঠিক রোল নম্বর দিন (সর্বোচ্চ ৮ ডিজিট)</div>
                                        @error('roll_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">রেজিস্ট্রেশন নম্বর</label>
                                        <input type="text"
                                            class="form-control @error('registration_number') is-invalid @enderror"
                                            minlength="1" maxlength="12" name="registration_number"
                                            value="{{ old('registration_number') }}" placeholder="যেমন: 123456789012"
                                            required>
                                        <div class="invalid-feedback">সঠিক রেজিস্ট্রেশন নম্বর দিন (সর্বোচ্চ ১২ ডিজিট)</div>
                                        @error('registration_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">জিপিএ/ফলাফল</label>
                                        <input type="text"
                                            class="form-control @error('gpa_result') is-invalid @enderror"
                                            name="gpa_result" value="{{ old('gpa_result') }}" placeholder="যেমন: 5.00"
                                            required>
                                        <div class="invalid-feedback">সঠিক জিপিএ দিন (যেমন: GPA-5.00 অথবা 5.00)</div>
                                        @error('gpa_result')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Address Information Section --}}
                            <div class="form-section">
                                <div class="section-title-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <h5>ঠিকানা তথ্য</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label required">বিভাগ</label>
                                        <select class="form-select @error('division_id') is-invalid @enderror"
                                            name="division_id" id="division_id" required>
                                            <option value="">বিভাগ নির্বাচন করুন</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                                    {{ $division->name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">বিভাগ নির্বাচন করুন</div>
                                        @error('division_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">জেলা</label>
                                        <select class="form-select @error('district_id') is-invalid @enderror"
                                            name="district_id" id="district_id" required>
                                            <option value="">প্রথমে বিভাগ নির্বাচন করুন</option>
                                        </select>
                                        <div class="invalid-feedback">জেলা নির্বাচন করুন</div>
                                        @error('district_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">উপজেলা</label>
                                        <select class="form-select @error('upazila_id') is-invalid @enderror"
                                            name="upazila_id" id="upazila_id" required>
                                            <option value="">প্রথমে জেলা নির্বাচন করুন</option>
                                        </select>
                                        <div class="invalid-feedback">উপজেলা নির্বাচন করুন</div>
                                        @error('upazila_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Photo Upload Section --}}
                            <div class="form-section">
                                <div class="section-title-icon">
                                    <i class="fas fa-camera"></i>
                                    <h5>শিক্ষার্থীর ছবি</h5>
                                </div>

                                <div class="photo-upload-container">
                                    <div class="photo-preview-area" id="photoPreviewArea">
                                        <div class="photo-placeholder" id="photoPlaceholder">
                                            <i class="fas fa-image" style="font-size: 4rem; color: #C7D2FE;"></i>
                                            <p class="text-muted mt-2 mb-0">ছবি নির্বাচন করুন</p>
                                            <small class="text-muted">JPG, PNG (2MB)</small>
                                        </div>
                                        <div class="photo-image-preview" id="photoImagePreview" style="display: none;">
                                            <img id="previewImg" src="" alt="প্রিভিউ">
                                            <button type="button" class="remove-photo-btn" id="removePhotoBtn"
                                                title="ছবি সরান">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-center">
                                        <input type="file" name="student_photo" id="studentPhoto"
                                            accept="image/jpeg,image/jpg,image/png" style="display: none;">
                                        <button type="button" class="btn btn-outline-primary" id="selectPhotoBtn">
                                            <i class="fas fa-folder-open"></i> ছবি নির্বাচন করুন
                                        </button>
                                        <small class="text-muted d-block mt-2">
                                            <i class="fas fa-info-circle"></i> ছবি না দিলেও রেজিস্ট্রেশন করা যাবে
                                            (পরবর্তীতে
                                            দেওয়া যাবে)
                                        </small>
                                    </div>

                                    @error('student_photo')
                                        <div class="text-danger small mt-2 text-center">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Section --}}
                            <div class="d-grid gap-3 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="bi bi-check-circle-fill"></i> রেজিস্ট্রেশন সম্পন্ন করুন
                                </button>
                                <div class="text-center">
                                    <a href="{{ route('student.login') }}" class="text-decoration-none">
                                        <i class="fas fa-sign-in-alt"></i> ইতিমধ্যে রেজিস্ট্রেশন করেছেন? লগইন করুন
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .registration-card {
                border: none;
                border-radius: 2rem;
                background: white;
                box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .card-header-custom {
                background: linear-gradient(135deg, #7e54de, #341284);
                padding: 1.5rem 2rem;
                color: white;
            }

            .card-header-custom h4 {
                margin: 0;
                font-weight: 700;
            }

            .form-section {
                background: #F9FAFB;
                border-radius: 1.2rem;
                padding: 1.5rem;
                margin-bottom: 2rem;
                border: 1px solid #E5E7EB;
                transition: all 0.3s ease;
            }

            .form-section:hover {
                border-color: #4F46E5;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
            }

            .section-title-icon {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
                border-bottom: 2px solid #E5E7EB;
            }

            .section-title-icon i {
                font-size: 1.5rem;
                color: #4F46E5;
                background: rgba(79, 70, 229, 0.1);
                padding: 8px;
                border-radius: 12px;
            }

            .section-title-icon h5 {
                margin: 0;
                font-weight: 700;
                color: #0F172A;
            }

            .form-label {
                font-weight: 600;
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
                color: #0F172A;
            }

            .required::after {
                content: "*";
                color: #EF4444;
                margin-left: 4px;
            }

            .form-control,
            .form-select {
                border-radius: 12px;
                border: 1.5px solid #E5E7EB;
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
                transition: all 0.2s ease;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #4F46E5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            }

            /* Validation Styles */
            .form-control.is-valid,
            .form-select.is-valid {
                border-color: #10B981;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310B981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.1875rem) center;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            }

            .form-control.is-invalid,
            .form-select.is-invalid {
                border-color: #EF4444;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23EF4444'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23EF4444' stroke='none'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.1875rem) center;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            }

            .form-control.is-valid:focus,
            .form-select.is-valid:focus {
                border-color: #10B981;
                box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
            }

            .form-control.is-invalid:focus,
            .form-select.is-invalid:focus {
                border-color: #EF4444;
                box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25);
            }

            .invalid-feedback {
                display: none;
                font-size: 0.8rem;
                margin-top: 0.3rem;
                color: #EF4444;
            }

            .form-control.is-invalid~.invalid-feedback,
            .form-select.is-invalid~.invalid-feedback {
                display: block;
            }

            .password-strength {
                margin-top: 0.5rem;
                font-size: 0.75rem;
            }

            /* Photo Upload Styles */
            .photo-upload-container {
                width: 100%;
            }

            .photo-preview-area {
                width: 200px;
                height: 200px;
                margin: 0 auto;
                border-radius: 50%;
                background: #F9FAFB;
                border: 2px dashed #E5E7EB;
                overflow: hidden;
                position: relative;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .photo-preview-area:hover {
                border-color: #4F46E5;
                background: #F3F4F6;
            }

            .photo-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .photo-image-preview {
                width: 100%;
                height: 100%;
                position: relative;
            }

            .photo-image-preview img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .remove-photo-btn {
                position: absolute;
                top: 5px;
                right: 5px;
                background: rgba(239, 68, 68, 0.9);
                border: none;
                border-radius: 50%;
                width: 28px;
                height: 28px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
                padding: 0;
                color: white;
            }

            .remove-photo-btn:hover {
                background: #EF4444;
                transform: scale(1.1);
            }

            .remove-photo-btn i {
                font-size: 1.2rem;
            }

            @media (max-width: 768px) {
                .card-header-custom h4 {
                    font-size: 1.3rem;
                }

                .card-body {
                    padding: 1.5rem !important;
                }

                .form-section {
                    padding: 1rem;
                }

                .photo-preview-area {
                    width: 150px;
                    height: 150px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ============== FORM VALIDATION ==============
                const form = document.getElementById('registerForm');
                const submitBtn = document.getElementById('submitBtn');

                // Validate single field
                function validateField(field) {
                    const value = field.value.trim();
                    let isValid = true;
                    let errorMessage = '';

                    // Remove existing validation states
                    field.classList.remove('is-valid', 'is-invalid');

                    // Check if required
                    if (field.hasAttribute('required') && value === '') {
                        isValid = false;
                        errorMessage = 'এই ফিল্ডটি পূরণ করুন';
                    }

                    // Specific validations based on field name
                    if (isValid) {
                        switch (field.name) {
                            case 'mobile':
                                if (!/^01[3-9]\d{8}$/.test(value)) {
                                    isValid = false;
                                    errorMessage = 'সঠিক ১১ ডিজিটের মোবাইল নম্বর দিন';
                                }
                                break;

                            case 'email':
                                if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                                    isValid = false;
                                    errorMessage = 'সঠিক ইমেইল ঠিকানা দিন';
                                }
                                break;

                            case 'password':
                                if (value.length < 6) {
                                    isValid = false;
                                    errorMessage = 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে';
                                }
                                break;

                            case 'roll_number':
                                if (!/^\d+$/.test(value)) {
                                    isValid = false;
                                    errorMessage = 'শুধুমাত্র সংখ্যা দিন';
                                } else if (value.length > 8) {
                                    isValid = false;
                                    errorMessage = 'সর্বোচ্চ ৮ ডিজিট হতে পারে';
                                }
                                break;

                            case 'registration_number':
                                if (!/^\d+$/.test(value)) {
                                    isValid = false;
                                    errorMessage = 'শুধুমাত্র সংখ্যা দিন';
                                } else if (value.length > 12) {
                                    isValid = false;
                                    errorMessage = 'সর্বোচ্চ ১২ ডিজিট হতে পারে';
                                }
                                break;

                            case 'gpa_result':
                                if (value && !/^(GPA-)?[0-5](\.\d{1,2})?$/i.test(value)) {
                                    isValid = false;
                                    errorMessage = 'সঠিক জিপিএ দিন (যেমন: GPA-5.00 বা 5.00)';
                                }
                                break;

                            case 'name_en':
                                if (value && !/^[a-zA-Z\s.]+$/.test(value)) {
                                    isValid = false;
                                    errorMessage = 'শুধুমাত্র ইংরেজি অক্ষর ব্যবহার করুন';
                                }
                                break;
                        }
                    }

                    // Set validation state
                    if (!isValid) {
                        field.classList.add('is-invalid');
                        const feedback = field.parentElement.querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errorMessage;
                        }
                    } else if (value !== '') {
                        field.classList.add('is-valid');
                    }

                    return isValid;
                }

                // Validate all fields
                function validateAllFields() {
                    let allValid = true;
                    const requiredFields = form.querySelectorAll('[required]');

                    requiredFields.forEach(field => {
                        if (!validateField(field)) {
                            allValid = false;
                        }
                    });

                    // Special validation for password match
                    const password = document.getElementById('password');
                    const confirmPassword = document.getElementById('password_confirmation');
                    if (password.value !== confirmPassword.value && confirmPassword.value !== '') {
                        confirmPassword.classList.add('is-invalid');
                        confirmPassword.classList.remove('is-valid');
                        const feedback = confirmPassword.parentElement.querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = 'পাসওয়ার্ড মিলছে না';
                        }
                        allValid = false;
                    }

                    return allValid;
                }

                // Real-time validation on blur
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.addEventListener('blur', function() {
                        validateField(this);

                        // Special check for password match
                        if (this.id === 'password' || this.id === 'password_confirmation') {
                            checkPasswordMatch();
                        }
                    });

                    // Real-time validation on input (clear errors)
                    input.addEventListener('input', function() {
                        if (this.classList.contains('is-invalid')) {
                            validateField(this);
                        }
                    });
                });

                // Password match validation
                function checkPasswordMatch() {
                    const password = document.getElementById('password');
                    const confirmPassword = document.getElementById('password_confirmation');
                    const matchMessage = document.getElementById('passwordMatch');

                    if (password.value === confirmPassword.value && password.value !== '') {
                        matchMessage.innerHTML =
                            '<i class="bi bi-check-circle-fill" style="color: #10B981;"></i> পাসওয়ার্ড মিলছে';
                        confirmPassword.classList.remove('is-invalid');
                        confirmPassword.classList.add('is-valid');
                        return true;
                    } else if (confirmPassword.value !== '') {
                        matchMessage.innerHTML =
                            '<i class="bi bi-x-circle-fill" style="color: #EF4444;"></i> পাসওয়ার্ড মিলছে না';
                        confirmPassword.classList.add('is-invalid');
                        confirmPassword.classList.remove('is-valid');
                        return false;
                    } else {
                        matchMessage.innerHTML = '';
                        confirmPassword.classList.remove('is-invalid', 'is-valid');
                        return false;
                    }
                }

                document.getElementById('password').addEventListener('keyup', checkPasswordMatch);
                document.getElementById('password_confirmation').addEventListener('keyup', checkPasswordMatch);

                // ============== DEPENDENT DROPDOWNS ==============
                document.getElementById('division_id').addEventListener('change', function() {
                    const divisionId = this.value;
                    const districtSelect = document.getElementById('district_id');
                    const upazilaSelect = document.getElementById('upazila_id');

                    districtSelect.innerHTML = '<option value="">লোড হচ্ছে...</option>';
                    upazilaSelect.innerHTML = '<option value="">প্রথমে জেলা নির্বাচন করুন</option>';

                    if (divisionId) {
                        fetch(`/api/districts/${divisionId}`)
                            .then(response => response.json())
                            .then(data => {
                                districtSelect.innerHTML = '<option value="">জেলা নির্বাচন করুন</option>';
                                data.forEach(district => {
                                    districtSelect.innerHTML +=
                                        `<option value="${district.id}">${district.name_bn}</option>`;
                                });
                                validateField(districtSelect);
                            })
                            .catch(error => {
                                districtSelect.innerHTML = '<option value="">ত্রুটি ঘটেছে</option>';
                            });
                    } else {
                        districtSelect.innerHTML = '<option value="">প্রথমে বিভাগ নির্বাচন করুন</option>';
                        validateField(districtSelect);
                    }
                });

                document.getElementById('district_id').addEventListener('change', function() {
                    const districtId = this.value;
                    const upazilaSelect = document.getElementById('upazila_id');

                    upazilaSelect.innerHTML = '<option value="">লোড হচ্ছে...</option>';

                    if (districtId) {
                        fetch(`/api/upazilas/${districtId}`)
                            .then(response => response.json())
                            .then(data => {
                                upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';
                                data.forEach(upazila => {
                                    upazilaSelect.innerHTML +=
                                        `<option value="${upazila.id}">${upazila.name_bn}</option>`;
                                });
                                validateField(upazilaSelect);
                            })
                            .catch(error => {
                                upazilaSelect.innerHTML = '<option value="">ত্রুটি ঘটেছে</option>';
                            });
                    } else {
                        upazilaSelect.innerHTML = '<option value="">প্রথমে জেলা নির্বাচন করুন</option>';
                        validateField(upazilaSelect);
                    }
                });

                // Preserve old values after validation error
                const oldDivision = "{{ old('division_id') }}";
                const oldDistrict = "{{ old('district_id') }}";
                const oldUpazila = "{{ old('upazila_id') }}";

                if (oldDivision) {
                    const divisionSelect = document.getElementById('division_id');
                    divisionSelect.value = oldDivision;
                    divisionSelect.dispatchEvent(new Event('change'));

                    setTimeout(() => {
                        if (oldDistrict) {
                            const districtSelect = document.getElementById('district_id');
                            districtSelect.value = oldDistrict;
                            districtSelect.dispatchEvent(new Event('change'));

                            setTimeout(() => {
                                if (oldUpazila) {
                                    const upazilaSelect = document.getElementById('upazila_id');
                                    upazilaSelect.value = oldUpazila;
                                }
                            }, 300);
                        }
                    }, 300);
                }

                // ============== PHOTO UPLOAD ==============
                const photoInput = document.getElementById('studentPhoto');
                const selectPhotoBtn = document.getElementById('selectPhotoBtn');
                const photoPreviewArea = document.getElementById('photoPreviewArea');
                const photoPlaceholder = document.getElementById('photoPlaceholder');
                const photoImagePreview = document.getElementById('photoImagePreview');
                const previewImg = document.getElementById('previewImg');
                const removePhotoBtn = document.getElementById('removePhotoBtn');

                function triggerFileInput() {
                    photoInput.click();
                }

                selectPhotoBtn.addEventListener('click', triggerFileInput);
                photoPreviewArea.addEventListener('click', triggerFileInput);

                photoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];

                    if (!file) return;

                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!allowedTypes.includes(file.type)) {
                        Swal.fire({
                            title: 'ত্রুটি!',
                            text: 'শুধুমাত্র JPG, JPEG এবং PNG ফরম্যাট সমর্থিত',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                        photoInput.value = '';
                        return;
                    }

                    // Validate file size (max 2MB)
                    const maxSize = 2 * 1024 * 1024;
                    if (file.size > maxSize) {
                        Swal.fire({
                            title: 'ত্রুটি!',
                            text: 'ছবির সাইজ 2MB এর কম হতে হবে',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                        photoInput.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        photoPlaceholder.style.display = 'none';
                        photoImagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                });

                removePhotoBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    photoInput.value = '';
                    photoPlaceholder.style.display = 'flex';
                    photoImagePreview.style.display = 'none';
                    previewImg.src = '';
                });

                // ============== FORM SUBMIT ==============
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Validate all fields
                    if (!validateAllFields()) {
                        // Scroll to first error
                        const firstInvalid = form.querySelector('.is-invalid');
                        if (firstInvalid) {
                            firstInvalid.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            firstInvalid.focus();
                        }

                        Swal.fire({
                            title: 'সতর্কতা!',
                            text: 'দয়া করে সব প্রয়োজনীয় ফিল্ড সঠিকভাবে পূরণ করুন',
                            icon: 'warning',
                            confirmButtonColor: '#4F46E5'
                        });
                        return;
                    }

                    // Check password match
                    if (!checkPasswordMatch()) {
                        Swal.fire({
                            title: 'পাসওয়ার্ড মিলছে না!',
                            text: 'দয়া করে পাসওয়ার্ড দুটি একই দিন',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                        return;
                    }

                    // Show confirmation
                    Swal.fire({
                        title: 'নিশ্চিত করুন',
                        text: "আপনার তথ্য সঠিক কিনা নিশ্চিত করুন",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'হ্যাঁ, জমা দিন',
                        cancelButtonText: 'বাতিল করুন',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML =
                                '<i class="bi bi-hourglass-split"></i> জমা দেওয়া হচ্ছে...';
                            form.submit();
                        }
                    });
                });

                // ============== MOBILE NUMBER AUTO-FORMAT ==============
                const mobileInput = document.querySelector('input[name="mobile"]');
                if (mobileInput) {
                    mobileInput.addEventListener('input', function() {
                        this.value = this.value.replace(/[^0-9]/g, '');
                        if (this.value.length > 11) {
                            this.value = this.value.slice(0, 11);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
