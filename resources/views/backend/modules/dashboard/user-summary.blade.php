@extends('layouts.admin-template.main')

@section('title', $page_content['page_title'] ?? 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
            <form action="" method="get">
                <div class="card p-3">
                    <!-- Search Bar -->
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                    </div>

                    <!-- User Summary Card with Progress Bars -->
                    <div class="card mb-4 p-3">
                        <h5 class="mb-3">User Summary</h5>
                        <div class="row">
                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Total SR</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">75</span>
                                </div>
                            </div>

                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Active</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 33%;"
                                            aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">33</span>
                                </div>
                            </div>

                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Present</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 55%;"
                                            aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">55</span>
                                </div>
                            </div>

                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Inactive</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 85%;"
                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">85</span>
                                </div>
                            </div>

                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Absent</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%;"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">15</span>
                                </div>
                            </div>

                            <div class="col-6 mb-4">
                                <p class="mb-1 text">Leave</p>
                                <div class="d-flex align-items-center">
                                    <div class="progress" style="height:10px; width: 100%;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ms-2" style="font-weight: bold;">25</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Details Card -->
                    <div class="card p-3 info-card">
                        <div class="row">
                            <div class="d-flex align-items-center mb-4">
                                <img src="{{ asset('template/assets/img/avatars/1.png') }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                <div class="p-4">
                                    <h6 class="mb-1">Md Masum Billah - TSM - Badda Zone -</h6>
                                    <p class="mb-1">Mr. Noodles Group</p>
                                    <p class="mb-1">Number of SR #13</p>
                                    <p class="mb-1">Staff ID# 376584</p>
                                    <p class="mb-1">Mobile: +8801787935648</p>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex flex-column gap-3">
                                        <!-- Call Button -->
                                        <a href="#" class="icon-button call-button">
                                            <i class='bx bx-phone-call'></i>
                                            <span>Call</span>
                                        </a>

                                        <!-- Map Button -->
                                        <a href="#" class="icon-button map-button">
                                            <i class='bx bxs-map'></i>
                                            <span>Map</span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4>Report Summary</h4>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">10:00 AM</div>
                                    <div class="label">Log In</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">752</div>
                                    <div class="label">First Order</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">332</div>
                                    <div class="label">First PO</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">743</div>
                                    <div class="label">SC</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">89</div>
                                    <div class="label">CAP</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="summary-item">
                                    <div class="time">9</div>
                                    <div class="label">TC</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">RETAILING</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('script')
@endpush
