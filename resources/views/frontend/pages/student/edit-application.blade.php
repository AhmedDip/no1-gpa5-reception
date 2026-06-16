@extends('frontend.layouts.app')

@section('title', 'তথ্য সম্পাদনা')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header"><h4><i class="fas fa-edit"></i> তথ্য সম্পাদনা করুন</h4></div>
                <div class="card-body">
                    <div class="alert alert-info"><i class="fas fa-clock"></i> মনে রাখবেন: নির্ধারিত সময়ের মধ্যে তথ্য সম্পাদনা করা যাবে।</div>
                    <form action="{{ route('student.update.application') }}" method="POST" enctype="multipart/form-data" id="editForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label required">ইংরেজিতে নাম</label><input type="text" class="form-control" name="name_en" value="{{ $userDetail->name_en }}" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label required">বাংলায় নাম</label><input type="text" class="form-control" name="name_bn" value="{{ $userDetail->name_bn }}" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label required">এসএসসি বোর্ড</label>
                                <select class="form-control" name="ssc_board_id" required>
                                    <option value="">বোর্ড নির্বাচন করুন</option>
                                    @foreach($sscBoards as $board)
                                        <option value="{{ $board->id }}" {{ $userDetail->ssc_board_id == $board->id ? 'selected' : '' }}>{{ $board->name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3"><label class="form-label required">গ্রুপ</label>
                                <select class="form-control" name="student_group_id" required>
                                    <option value="">গ্রুপ নির্বাচন করুন</option>
                                    @foreach($studentGroups as $group)
                                        <option value="{{ $group->id }}" {{ $userDetail->student_group_id == $group->id ? 'selected' : '' }}>{{ $group->name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label required">রোল নম্বর</label><input type="text" class="form-control" name="roll_number" value="{{ $userDetail->roll_number }}" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label required">রেজিস্ট্রেশন নম্বর</label><input type="text" class="form-control" name="registration_number" value="{{ $userDetail->registration_number }}" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label required">জিপিএ/ফলাফল</label><input type="text" class="form-control" name="gpa_result" value="{{ $userDetail->gpa_result }}" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label required">বিভাগ</label>
                                <select class="form-control" name="division_id" id="division_id" required>
                                    <option value="">বিভাগ নির্বাচন করুন</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $userDetail->division_id == $division->id ? 'selected' : '' }}>{{ $division->name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3"><label class="form-label required">জেলা</label>
                                <select class="form-control" name="district_id" id="district_id" required>
                                    <option value="">জেলা নির্বাচন করুন</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $userDetail->district_id == $district->id ? 'selected' : '' }}>{{ $district->name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3"><label class="form-label required">উপজেলা</label>
                                <select class="form-control" name="upazila_id" id="upazila_id" required>
                                    <option value="">উপজেলা নির্বাচন করুন</option>
                                    @foreach($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}" {{ $userDetail->upazila_id == $upazila->id ? 'selected' : '' }}>{{ $upazila->name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label">শিক্ষার্থীর ছবি (নতুন ছবি দিলে পুরাতন ছবি পরিবর্তন হবে)</label><input type="file" class="form-control" name="student_photo" accept="image/*" id="studentPhoto">
                        @if($userDetail->student_photo)<div class="mt-2"><img src="{{ asset('storage/' . $userDetail->student_photo) }}" style="max-width: 150px; border-radius: 10px;"><small class="text-muted d-block">বর্তমান ছবি</small></div>@endif
                        <div id="photoPreview" class="mt-2"></div></div>
                        <div class="d-grid gap-2"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> তথ্য আপডেট করুন</button><a href="{{ route('student.dashboard') }}" class="btn btn-secondary">ড্যাশবোর্ডে ফিরুন</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Photo preview
    document.getElementById('studentPhoto')?.addEventListener('change', function(e) {
        const preview = document.getElementById('photoPreview');
        preview.innerHTML = '';
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.borderRadius = '10px';
                preview.appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Dependent dropdowns
    document.getElementById('division_id').addEventListener('change', function() {
        const divisionId = this.value;
        const districtSelect = document.getElementById('district_id');
        
        if (divisionId) {
            fetch(`/api/districts/${divisionId}`)
                .then(response => response.json())
                .then(data => {
                    districtSelect.innerHTML = '<option value="">জেলা নির্বাচন করুন</option>';
                    data.forEach(district => {
                        districtSelect.innerHTML += `<option value="${district.id}">${district.name_bn}</option>`;
                    });
                });
        }
    });
    
    document.getElementById('district_id').addEventListener('change', function() {
        const districtId = this.value;
        const upazilaSelect = document.getElementById('upazila_id');
        
        if (districtId) {
            fetch(`/api/upazilas/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    upazilaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';
                    data.forEach(upazila => {
                        upazilaSelect.innerHTML += `<option value="${upazila.id}">${upazila.name_bn}</option>`;
                    });
                });
        }
    });
    
    // Confirm update
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'আপডেট নিশ্চিত করুন',
            text: "আপনার তথ্য আপডেট করতে চান?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d32f2f',
            confirmButtonText: 'হ্যাঁ, আপডেট করুন',
            cancelButtonText: 'বাতিল করুন'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();
            }
        });
    });
</script>
@endpush
@endsection