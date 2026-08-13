@extends('frontend.layouts.app')

@section('title', 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬')

@section('content')
    <!-- ========== 1. CAMPAIGN OVERVIEW / HERO ========== -->
    <section id="campaign" class="hero">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-7 text-center text-lg-start" data-aos="fade-up">
                    <div class="hero-badge d-inline-flex">
                        {{-- <span>২০২৬ সালের বৃহৎ শিক্ষা উদ্যোগ</span> --}}
                    </div>
                    <h1 class="fw-bold text-large">নাম্বার ওয়ান বাবার <span class="text-gradient">কৃতী
                            সন্তান</span> সংবর্ধনা - ২০২৬</h1>
                    <p class="second-heading">
                        প্রতিটি সন্তানের সাফল্যের পেছনে থাকে সংগ্রামী বাবা-মায়ের অক্লান্ত পরিশ্রম, ত্যাগ ও ভালোবাসা। স্বল্প
                        আয় এবং অপ্রতুল সুযোগ-সুবিধার মাঝেও বাবা-মায়েরা নিজের সর্বত্র চেষ্টার মাধ্যমে সন্তানের সুশিক্ষা
                        নিশ্চিতে সংগ্রাম করে যান প্রতিদিন। তাদের স্বপ্ন- সন্তানেরা নিজ যোগ্যতায় সমাজে প্রতিষ্ঠিত হবে। নিজেকে
                        গড়ে তুলবে একজন আত্মনির্ভরশীল নাগরিক হিসেবে। দেশ ও দশের জন্য বয়ে আনবে সুনাম। আর এভাবেই সন্তানেরা
                        তাদের বাবা-মায়ের সংগ্রামী জীবনকে দিবেন সার্থকতা।
                    </p>

                    <p class="second-heading others-heading">
                        দেশের প্রান্তিক পর্যায়ে ছড়িয়ে থাকা হাজারও চা-দোকানি বাবা-মায়েদের স্বপ্নের গল্পটাও একই। প্রিয়
                        সন্তানের আলোকিত ভবিষ্যতের জন্য কঠোর পরিশ্রম আর ত্যাগের মাধ্যমেই তারা স্বপ্ন বুনে যাচ্ছেন প্রতিদিন।
                        আর এই মেহনতি মানুষগুলোর স্বপ্নপূরণে তাদের ভালোবাসার ব্র্যান্ড নাম্বার ওয়ান সবসময়ই তাদের পাশে আছে।
                        যার ধারাবাহিকতায় এ বছরও আয়োজিত হতে যাচ্ছে <strong>‘নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা
                            ২০২৬’</strong>। এই
                        উদ্যোগের মাধ্যমে দেশের প্রান্তিক চা-দোকানিদের এসএসসি/সমমান ২০২৬ পরীক্ষায় জিপিএ-৫ প্রাপ্ত কৃতী
                        সন্তানদের সংবর্ধনা, শিক্ষা বৃত্তি (এককালীন), এইচএসসি অল সাবজেক্ট অনলাইন কোর্স, সনদ, ক্রেস্ট এবং
                        বিশেষ উপহার প্রদান করা হবে।
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center justify-content-lg-start">
                        <a href="{{ route('student.register') }}" class="btn btn-primary btn-lg px-4 px-lg-5"> রেজিস্ট্রেশন
                            করুন
                            <i class="fas fa-chevron-right"></i></a>
                        <a href="" id="heroMoreToggle" class="btn btn-outline-danger btn-lg px-4 px-lg-5">বিস্তারিত
                            দেখুন
                        </a>
                    </div>

                </div>
                <!-- Right Image with Enhanced Circular Background -->
                <div class="col-lg-5 text-center">
                    <div class="position-relative d-flex justify-content-center align-items-center"
                        style="min-height: 400px;" data-aos="fade-up" data-aos-easing="ease-out-back">
                        <!-- Outer Rotating Ring 1 -->
                        <div class="position-absolute rounded-circle"
                            style="width: 100%; height: 100%; max-width: 500px; max-height: 500px;
                                border: 3px solid rgba(255, 0, 0, 0.048);
                                animation: spin-ring 25s linear infinite;
                                top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        </div>

                        <!-- Outer Rotating Ring 2 (Dashed) -->
                        <div class="position-absolute rounded-circle"
                            style="width: 92%; height: 92%; max-width: 460px; max-height: 460px;
                                border: 2px dashed rgba(255, 166, 0, 0.151);
                                animation: spin-ring 35s linear infinite reverse;
                                top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        </div>

                        <!-- Decorative Dots on Ring Path -->
                        <div class="position-absolute rounded-circle"
                            style="width: 88%; height: 88%; max-width: 440px; max-height: 440px;
                                top: 50%; left: 50%; transform: translate(-50%, -50%);">

                            <!-- Dot 1 -->
                            <div class="position-absolute rounded-circle"
                                style="width: 10px; height: 10px; background-color: #ff00004d;
                                    top: -5%; left: 50%; transform: translate(-50%, -50%);">
                            </div>

                            <!-- Dot 2 -->
                            <div class="position-absolute rounded-circle"
                                style="width: 10px; height: 10px; background-color: #ffd0009a;
                                    top: 50%; left: 100%; transform: translate(-50%, -50%);">
                            </div>

                            <!-- Dot 3 -->
                            <div class="position-absolute rounded-circle"
                                style="width: 10px; height: 10px; background-color: #ff000023;
                                    top: 105%; left: 50%; transform: translate(-50%, -50%);">
                            </div>

                            <!-- Dot 4 -->
                            <div class="position-absolute rounded-circle"
                                style="width: 10px; height: 10px; background-color: #ffc4005b;
                                    top: 50%; left: 0%; transform: translate(-50%, -50%);">
                            </div>
                        </div>

                        <!-- Image with Floating Effect -->
                        <div class="position-relative" style="z-index: 2; width: 100%; max-width: 450px;">
                            <div class="position-relative" style="padding: 15px;">
                                <!-- Image Shadow Glow -->
                                <div class="position-absolute rounded-circle"
                                    style="width: 100%; height: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                        background: radial-gradient(circle, rgba(29, 2, 2, 0.274) 0%, transparent 70%);
                                        filter: blur(30px); z-index: -1;">
                                </div>

                                <img src="{{ asset('images/hero-image.jpeg') }}" alt="hero"
                                    class="img-fluid rounded-4 shadow-lg floating-image"
                                    style="height: auto; max-height: 500px; width: 100%; object-fit: cover; position: relative; z-index: 1;">

                                <!-- Subtle Overlay on Image -->
                                <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4"
                                    style="background: linear-gradient(135deg, rgba(255, 0, 0, 0.03), rgba(255, 165, 0, 0.03)); z-index: 2; pointer-events: none;">
                                </div>

                                <!-- Corner Decorations -->
                                <div class="position-absolute" style="top: 5px; left: 5px; z-index: 3;">
                                    <div
                                        style="width: 20px; height: 20px; border-top: 3px solid rgba(255, 0, 0, 0.2); border-left: 3px solid rgba(255, 0, 0, 0.2);">
                                    </div>
                                </div>
                                <div class="position-absolute" style="top: 5px; right: 5px; z-index: 3;">
                                    <div
                                        style="width: 20px; height: 20px; border-top: 5px solid rgba(255, 165, 0, 0.2); border-right: 3px solid rgba(255, 165, 0, 0.2);">
                                    </div>
                                </div>
                                <div class="position-absolute" style="bottom: 5px; left: 5px; z-index: 3;">
                                    <div
                                        style="width: 20px; height: 20px; border-bottom: 3px solid rgba(255, 165, 0, 0.2); border-left: 3px solid rgba(255, 165, 0, 0.2);">
                                    </div>
                                </div>
                                <div class="position-absolute" style="bottom: 5px; right: 5px; z-index: 3;">
                                    <div
                                        style="width: 20px; height: 20px; border-bottom: 3px solid rgba(255, 0, 0, 0.2); border-right: 3px solid rgba(255, 0, 0, 0.2);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 2. MESSAGE FROM NO.1 BRAND ========== -->
    <section class="container py-4 py-md-5 my-2 my-md-4 text-center">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center  mb-md-4">
                <h2 class="section-title mx-auto">
                    {{-- <img src="{{ asset('images/no1-logo.png') }}" alt="brand" height="45" class="me-2"> --}}
                    নাম্বার ওয়ান এর পক্ষ থেকে শুভেচ্ছা
                </h2>

                <p class="mt-3 fs-5 fs-md-4 text-dark-emphasis">
                    <span class="special-text"><strong>"সন্তানের সাফল্য, বাবা-মায়ের গর্ব"</strong></span>
                </p>
                <p class="fs-6 fs-md-5 mt-1">
                    স্বপ্নকে বাস্তবে রূপ দিতে যারা প্রতিদিন প্রতিকূলতার সঙ্গে লড়াই করেন, সন্তানের ভবিষ্যতের জন্য নিজের
                    সবটুকু উজাড় করে দেন, তারাই নাম্বার ওয়ান।
                </p>
                <p class="fs-6 fs-md-5 mt-1">
                    সেই সংগ্রামী মানুষদের প্রতি শ্রদ্ধা ও ভালোবাসা থেকেই <strong>‘নাম্বার ওয়ান বাবার কৃতী সন্তান
                        সংবর্ধনা-২০২৬’</strong> এর আয়োজন। যেখানে শুধু কৃতী সন্তানই নয়, তার সাফল্যের নেপথ্যের প্রকৃত নায়কেরাও
                    হন সম্মানিত ও স্বীকৃত।
                </p>
            </div>
        </div>
    </section>

    <!-- ========== 3. SCHOLARSHIP & FELICITATION DETAILS ========== -->
    <section class="bg-light py-5 py-md-6 mt-3 mt-md-5">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title">স্কলারশিপ ও সংবর্ধনা বিবরণ</h2>
                <p class="text-secondary px-2">
                    নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬-এ নির্বাচিত শিক্ষার্থীদের জন্য বিশেষ সুবিধা প্রদান করা হবে।
                </p>
            </div>

            <div class="card-premium p-4 p-md-5 position-relative overflow-hidden"
                style="background: linear-gradient(135deg, rgb(255, 255, 255), #fff7f7); border-radius: 1rem;">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="fancy-icon-wrapper bg-gradient-danger flex-shrink-0"
                        style="width: 65px; height: 65px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <i class="fas fa-award fs-2 text-white"></i>
                    </span>
                    <div>
                        <h3 class="fw-bold mb-1">নির্বাচিত শিক্ষার্থীরা পাবেন—</h3>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <!-- Card 1: Scholarship -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-danger mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-graduation-cap fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">শিক্ষা বৃত্তি (এককালীন)</h5>
                            <p class="small text-secondary mb-0">নির্বাচিত শিক্ষার্থীদের শিক্ষা বৃত্তি প্রদান করা হবে
                            </p>
                        </div>
                    </div>





                    <!-- Card 5: Educational Materials -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-info mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-book fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">এইচএসসি অল সাবজেক্ট অনলাইন কোর্স</h5>
                            <p class="small text-secondary mb-0">
                                নির্বাচিত শিক্ষার্থীদের এইচএসসি সকল বিষয় অনলাইন কোর্স প্রদান করা হবে
                            </p>
                        </div>
                    </div>

                    <!-- Card 3: Certificate -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-special mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-certificate fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">সনদ</h5>
                            <p class="small text-secondary mb-0">
                                সংবর্ধনা অনুষ্ঠানে নির্বাচিত শিক্ষার্থীদের সনদ প্রদান করা হবে
                            </p>
                        </div>
                    </div>



                    <!-- Card 4: Crest -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-success mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-trophy fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">ক্রেস্ট</h5>
                            <p class="small text-secondary mb-0">
                                নির্বাচিত শিক্ষার্থীদের সংবর্ধনা অনুষ্ঠানে ক্রেস্ট প্রদান করা হবে
                            </p>
                        </div>
                    </div>


                    <!-- Card 2: Medal -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-warning mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-medal fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">সংবর্ধনা মেডেল</h5>
                            <p class="small text-secondary mb-0">
                                সংবর্ধনা অনুষ্ঠানে নির্বাচিত শিক্ষার্থীদের সংবর্ধনা মেডেল প্রদান করা হবে
                            </p>
                        </div>
                    </div>

                    <!-- Card 6: Special Gift -->
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div
                            class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100 text-center mega-card">
                            <div class="fancy-icon-wrapper bg-gradient-danger mx-auto mb-3"
                                style="width: 65px; height: 65px;">
                                <i class="fas fa-gift fs-2 text-white"></i>
                            </div>
                            <h5 class="fw-bold mb-2">নাম্বার ওয়ান এর পক্ষ থেকে বিশেষ উপহার</h5>
                            <p class="small text-secondary mb-0">
                                নির্বাচিত শিক্ষার্থীদের জন্য নাম্বার ওয়ান এর পক্ষ থেকে বিশেষ উপহার প্রদান করা হবে
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Logo Overlay -->
                <div class="position-absolute"
                    style="right: -60px; bottom: -30px; opacity:0.15; transform: rotate(-20deg);">
                    <img src="{{ asset('images/no1-logo.png') }}" alt="logo" height="220">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 4. ELIGIBILITY CRITERIA + SPECIAL SEMINAR ========== -->
    <section id="eligibility" class="container py-4">
        <div class="row g-3 g-lg-4 align-items-stretch">

            <!-- CARD 1 & 2: column-wise (stacked vertically) -->
            <div class="col-12 col-md-6">
                <div class="d-flex flex-column gap-3 h-100">
                    <!-- CARD 1: যারা আবেদন করতে পারবে -->
                    <div
                        class="bg-white rounded-4 shadow-sm p-3 p-md-3 border border-light hover-shadow transition fancy-feature-card">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;">
                                {{-- <img src="{{ images/student.gif }}" alt="student" class="img-fluid" style="width: 24px; height: 24px;"> --}}
                                <img src="{{ asset('images/animated-icon/graduation-cap.gif') }}" alt="student"
                                    class="img-fluid" style="width: 50px; height: 50px;">
                            </div>
                            <h4 class="fw-bold mb-0 text-dark fs-5">যারা আবেদন করতে পারবে</h4>
                        </div>
                        <ul class="list-unstyled mt-2">
                            <p class="text-secondary ms-auto">আবেদন করতে একজন কৃতী সন্তানের—</p>
                            <li class="d-flex gap-2 mb-1 pb-1 border-bottom border-light">
                                <img src={{ asset('images/animated-icon/tick.gif') }} alt="tick" class="img-fluid"
                                    style="width: 20px; height: 20px;">
                                <span class="fs-6">এসএসসি/সমমান ২০২৬ পরীক্ষায় জিপিএ-৫ থাকতে হবে</span>
                            </li>
                            <li class="d-flex gap-2">
                                <img src={{ asset('images/animated-icon/tick.gif') }} alt="tick" class="img-fluid"
                                    style="width: 20px; height: 20px;">
                                <span class="fs-6">আবেদনকারী শিক্ষার্থীর বাবা/মা যেকোন একজন চা-দোকানি হতে হবে</span>
                            </li>
                        </ul>
                    </div>

                    <!-- CARD 2: যারা আবেদন করতে পারবে -->
                    <div
                        class="bg-white rounded-4 shadow-sm p-3 p-md-3 border border-light hover-shadow transition fancy-feature-card">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;">
                                {{-- <img src="{{ images/student.gif }}" alt="student" class="img-fluid" style="width: 24px; height: 24px;"> --}}
                                <img src="{{ asset('images/animated-icon/list.gif') }}" alt="student" class="img-fluid"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <h4 class="fw-bold mb-0 text-dark fs-5">আবেদন করার নিয়মাবলি</h4>
                        </div>
                        <ul class="list-unstyled mt-2">
                            <li class="d-flex gap-2 mb-1 pb-1 border-bottom border-light">
                                <img src={{ asset('images/animated-icon/tick.gif') }} alt="tick" class="img-fluid"
                                    style="width: 20px; height: 20px;">
                                <span class="fs-6">নির্ধারিত সময়ের মধ্যে অনলাইনে আবেদন সম্পন্ন করতে হবে</span>
                            </li>
                            <li class="d-flex gap-2">
                                <img src={{ asset('images/animated-icon/tick.gif') }} alt="tick" class="img-fluid"
                                    style="width: 20px; height: 20px;">
                                <span class="fs-6">প্রয়োজনীয় তথ্য ও ডকুমেন্ট সঠিকভাবে আপলোড করতে হবে</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CARD 3: Special Seminar / CTA -->
            <div class="col-12 col-md-6">
                <div class="rounded-4 p-3 p-md-4 h-100 d-flex flex-column justify-content-between mega-card hover-shadow transition shiny-border"
                    style="background: linear-gradient(145deg, #fffcf5 0%, #f5dc9d 100%);">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center"
                                style="width: 44px; height: 44px;">
                                <i class="fa-solid fa-bullhorn fs-5 text-danger"></i>
                            </div>
                            <span
                                class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill fw-semibold small">লিমিটেড
                                আসন</span>
                        </div>
                        <h4 class="fw-bold text-dark fs-4 mb-2">এখনই আবেদন করুন</h4>
                        <p class="text-dark-emphasis" style="font-size: 0.9rem; line-height: 1.5;">
                            আপনি যদি <strong><a href="{{ route('student.register') }}"
                                    style="text-decoration: none; color: #dc3545;">এসএসসি/সমমান ২০২৬ পরীক্ষায়</a></strong>
                            জিপিএ-৫ প্রাপ্ত
                            একজন কৃতী সন্তান হন এবং আপনার বাবা/মা যেকোনো একজন চায়ের দোকানি হন, তাহলে এখনই আবেদন করুন।
                        </p>
                        <div class="bg-white bg-opacity-50 rounded-3 p-2 mt-2">
                            <p class="fw-semibold mb-1 small text-dark">আবেদনের জন্য প্রয়োজন হবে—</p>
                            <ul class="list-unstyled small mb-0" style="font-size: 0.8rem;">
                                <li class="mb-1">
                                    <img src="{{ asset('images/animated-icon/tick-2.gif') }}" alt="tick"
                                        class="img-fluid" style="width: 20px; height: 20px;">
                                    শিক্ষার্থীর ছবি
                                </li>
                                <li class="mb-1">
                                    <img src="{{ asset('images/animated-icon/tick-2.gif') }}" alt="tick"
                                        class="img-fluid" style="width: 20px; height: 20px;">
                                    এসএসসি/সমমান ২০২৬
                                    পরীক্ষার তথ্য
                                </li>
                                <li class="mb-1">
                                    <img src="{{ asset('images/animated-icon/tick-2.gif') }}" alt="tick"
                                        class="img-fluid" style="width: 20px; height: 20px;">
                                    বাবা-মায়ের তথ্য
                                </li>
                                <li>
                                    <img src="{{ asset('images/animated-icon/tick-2.gif') }}" alt="tick"
                                        class="img-fluid" style="width: 20px; height: 20px;">
                                    অন্যান্য প্রয়োজনীয় তথ্য
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-2 pt-2 border-top border-warning border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center small text-dark-emphasis"
                            style="font-size: 0.75rem;">
                            <span><i class="fas fa-calendar-check text-danger me-1"></i>শেষ তারিখ: আগস্ট ২৫, ২০২৬</span>
                            <span><i class="fas fa-location-dot text-danger me-1"></i>সংবর্ধনার স্থান : ঢাকা</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- ========== 5. TIMELINE ========== -->
    <section id="timeline" class="py-4 py-md-6 mt-3 mt-md-5 position-relative overflow-hidden"
        style="background: linear-gradient(145deg, #F9FAFB 0%, #FFFFFF 100%);">
        <div class="container position-relative">
            <div class="text-center mb-4 mb-md-5 position-relative">
                <div
                    class="d-inline-flex align-items-center gap-2 bg-white px-4 py-2 rounded-pill shadow-sm mb-3 mb-md-4 border border-light mt-4">
                    <img src="{{ asset('images/animated-icon/calendar.gif') }}" alt="calendar" class="img-fluid"
                        style="width: 30px; height: 30px;">
                    <span class="fw-semibold small text-uppercase tracking-wide">গুরুত্বপূর্ণ সময়সূচি</span>
                </div>
                <h2 class="display-6 display-md-5 fw-bold text-dark">প্রধান সময়সূচি</h2>
                {{-- <p class="text-secondary fs-6 fs-md-5 px-2 mt-2">২০২৬ সালের গুরুত্বপূর্ণ মাইলফলক</p> --}}
            </div>

            <div class="row g-4 g-md-5 justify-content-center position-relative">
                <div class="col-6 col-md-4 position-relative" style="z-index: 2;">
                    <div class="timeline-card-elegant text-center p-3 p-md-4 rounded-4 bg-white shadow-sm border-0 h-100 d-flex flex-column align-items-center transition-all duration-300 position-relative"
                        style="border-bottom: 4px solid #46c8e5;">
                        <div class="d-none d-md-block position-absolute timeline-dot"
                            style="top: 50%; right: -1.2rem; width: 14px; height: 14px; background: #40cfcf; border-radius: 50%; transform: translateY(-50%); border: 3px solid white; box-shadow: 0 0 0 4px rgba(70, 75, 229, 0.15);">
                        </div>
                        <div class="timeline-icon-wrapper mb-2 mb-md-3" background: linear-gradient(135deg, #ffffff,
                            #fefeff); border-radius: 50%; display: flex; align-items: center; justify-content: center;
                            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            {{-- <i class="fas fa-calendar-plus fs-4 text-primary" style="color: #46dae5;"></i> --}}
                            <img src="{{ asset('images/animated-icon/start.gif') }}" alt="calendar" class="img-fluid"
                                style="width: 70px; height: 70px;">
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-5 mb-1">আবেদন শুরু </h5>
                        <p class="fs-4 fs-md-3 fw-bold text-dark mb-0">১১ আগস্ট </p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                        <span class="badge bg-info-soft text-info mt-2 px-3 py-1 rounded-pill small fw-normal"
                            style="background: #40cfcf28">শুরু</span>
                    </div>
                </div>

                <div class="col-6 col-md-4 position-relative" style="z-index: 2;">
                    <div class="timeline-card-elegant text-center p-3 p-md-4 rounded-4 bg-white shadow-sm border-0 h-100 d-flex flex-column align-items-center transition-all duration-300 position-relative"
                        style="border-bottom: 4px solid #EF4444;">
                        <div class="d-none d-md-block position-absolute timeline-dot"
                            style="top: 50%; right: -1.2rem; width: 14px; height: 14px; background: #EF4444; border-radius: 50%; transform: translateY(-50%); border: 3px solid white; box-shadow: 0 0 0 4px rgba(235, 43, 43, 0.15);">
                        </div>
                        <div class="timeline-icon-wrapper mb-2 mb-md-3" display: flex; align-items: center;
                            justify-content: center; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            {{-- <i class="fas fa-calendar-times fs-4" style="color: #EF4444;"></i> --}}
                            <img src="{{ asset('images/animated-icon/end.gif') }}" alt="calendar" class="img-fluid"
                                style="width: 70px; height: 70px;">
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-5 mb-1">আবেদনের শেষ তারিখ </h5>
                        <p class="fs-4 fs-md-3 fw-bold text-dark mb-0">২৫ আগস্ট</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                        <span class="badge bg-danger-soft text-danger mt-2 px-3 py-1 rounded-pill small fw-normal"
                            style="background: rgba(239, 68, 68, 0.08);">শেষ</span>
                    </div>
                </div>

                <div class="col-6 col-md-4 position-relative" style="z-index: 2;">
                    <div class="timeline-card-elegant text-center p-3 p-md-4 rounded-4 bg-white shadow-sm border-0 h-100 d-flex flex-column align-items-center transition-all duration-300 position-relative"
                        style="border-bottom: 4px solid #f6ec5c;">
                        <div class="d-none d-md-block position-absolute timeline-dot"
                            style="top: 50%; right: -1.2rem; width: 14px; height: 14px; background: #f6e75c; border-radius: 50%; transform: translateY(-50%); border: 3px solid rgb(255, 255, 255); box-shadow: 0 0 0 4px rgba(246, 244, 92, 0.308);">
                        </div>
                        <div class="timeline-icon-wrapper mb-2 mb-md-3" display: flex; align-items: center;
                            justify-content: center; transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <img src="{{ asset('images/animated-icon/people.gif') }}" alt="progress" class="img-fluid"
                                style="width: 70px; height: 70px;">
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-5 mb-1">সংবর্ধনা</h5>
                        <p class="fs-4 fs-md-3 fw-bold text-dark mb-0">৫ সেপ্টেম্বর  </p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                        <span class="badge bg-warning-soft text-warning mt-2 px-3 py-1 rounded-pill small fw-normal"
                            style="background: rgba(236, 246, 92, 0.08);">আয়োজন</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 mt-md-5 position-relative">
                <p class="text-muted small d-flex align-items-center justify-content-center gap-2 py-4">
                    <i class="fas fa-circle text-danger" style="font-size: 0.35rem; opacity: 0.5;"></i>
                    <span>সকল সময়সূচি পরিবর্তন সাপেক্ষ</span>
                    <i class="fas fa-circle text-danger" style="font-size: 0.35rem; opacity: 0.5;"></i>
                </p>
            </div>
        </div>
    </section>

    <!-- ========== 6. SUCCESS STORIES ========== -->
    <section id="stories" class="container py-4 py-md-5 my-3 my-md-4">
        <div class="text-center mb-4 mb-md-5">
            <img src="{{ asset('images/animated-icon/success.gif') }}" alt="success" class="img-fluid"
                style="width: 60px; height: 60px;">
            <h2 class="section-title mx-auto">
                সফলতার গল্প</h2>
            <p class="text-secondary px-2">বাংলাদেশের বিভিন্ন অঞ্চলের বহু প্রান্তিক চা-দোকানি কঠোর পরিশ্রম, ত্যাগ ও
                অক্লান্ত প্রচেষ্টার মাধ্যমে তাদের সন্তানদের শিক্ষাক্ষেত্রে অসাধারণ সাফল্য অর্জনের স্বপ্ন বুনে চলেছেন
                প্রতিদিন। তাদের প্রতিটি সংগ্রামের গল্প নতুন প্রজন্মকে অনুপ্রাণিত করে, আর সেই স্বপ্নপূরণের যাত্রায় দেশের
                প্রিয় নাম্বার ওয়ান সবসময়ই থেকেছে তাদের বিশ্বস্ত সঙ্গী।
            </p>

            <p class="text-secondary px-2">
                এরকম হাজারও সংগ্রামী বাবা-মায়ের স্বপ্নের সহযাত্রী হিসেবে নাম্বার ওয়ান বিশ্বাস করে- একজন সন্তানের সাফল্যই
                একটি পরিবারের সবচেয়ে বড় অর্জন। সেই বিশ্বাস থেকেই <strong>‘নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা’</strong>
                বছরের পর বছর
                সম্মান জানিয়ে আসছে মেধা, পরিশ্রম ও স্বপ্নকে।
            </p>


        </div>

        <!-- Stories Grid -->
        <div class="row g-3 g-md-4" id="storiesGrid">
            <!-- Stories will be injected here by JavaScript -->
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-4" id="storiesLoadMoreWrapper">
            <button type="button" class="btn btn-primary rounded-pill px-4 px-md-5" id="storiesLoadMoreBtn">
                <i class="fas fa-plus me-1"></i> আরও গল্প দেখুন
            </button>
        </div>
    </section>

    <!-- ========== 7. বিগত বছরের সংবর্ধনার ভিডিও চিত্র ========== -->
    <section class="bg-dark text-white py-5 py-md-6 mt-3 mt-md-5">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title text-white mx-auto fs-3 fs-md-2">বিগত বছরের সংবর্ধনার ভিডিও চিত্র</h2>
                <p class="text-light opacity-75 small">মুহূর্তগুলো দেখুন, অনুপ্রেরণা নিন</p>
            </div>
            <div class="row g-3 g-md-4" id="videoGrid">
                <!-- videos will be injected here by JS -->
            </div>
            <div class="text-center mt-4" id="loadMoreWrapper">
                <button type="button" class="btn btn-outline-light rounded-pill px-4" id="loadMoreVideosBtn">
                    <i class="fas fa-plus me-1"></i> আরও ভিডিও দেখুন
                </button>
            </div>
        </div>
    </section>

    <!-- ========== 8. সংবর্ধনার ছবি গ্যালারি ========== -->
    <section id="gallery" class="container py-5 py-md-6 mt-3 mt-md-5">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title mx-auto">ছবি গ্যালারি : ফ্রেমবন্দি অনুপ্রেরণা</h2>
            <p class="text-secondary px-2">আমাদের আয়োজনের স্মৃতিচারণ</p>
        </div>
        <div class="d-flex justify-content-center mb-4">
            <div class="tab-filter d-flex flex-wrap justify-content-center gap-1">
                <button class="tab-btn active" data-cat="all">সব ছবি</button>
                <button class="tab-btn" data-cat="2024">২০২৪</button>
                <button class="tab-btn" data-cat="2025">২০২৫</button>
            </div>
        </div>
        <div class="gallery-main-container">
            <img id="galleryMain" src="" alt="Gallery Main" class="gallery-main-img w-100 rounded-4 shadow-lg"
                style="height: auto; max-height: 450px; min-height: 250px; object-fit: cover;">
            <div id="galleryThumbs" class="row mt-3 mt-md-4 g-2 justify-content-center"></div>
        </div>
    </section>

    <!-- ========== 9. FAQs ========== -->
    <section id="faq" class="bg-light py-5 py-md-6 mt-3 mt-md-4">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title mx-auto">সচরাচর জিজ্ঞাসা (FAQ)</h2>
                <p class="text-secondary px-2">আপনার মনে যেকোনো প্রশ্নের উত্তর এখানে</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-11 col-lg-8">
                    <div class="accordion" id="faqAccordion">

                        <!-- FAQ 1 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq1">
                                    এটা কি ধরনের প্রোগ্রাম?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">চায়ের দোকানির মেধাবী সন্তান ও তাদের
                                    বাবা-মাকে নিয়ে সংবর্ধনা প্রোগ্রাম।</div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">
                                    কারা আবেদন করতে পারবে?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">এসএসসি/সমমান ২০২৬ পরীক্ষায় জিপিএ-৫
                                    প্রাপ্ত চায়ের দোকানির কৃতী সন্তানেরা আবেদন করতে পারবে।</div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">
                                    একজন শিক্ষার্থী কি একাধিক আবেদন করতে পারবে?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">না। একজন শিক্ষার্থী কেবলমাত্র একবারই আবেদন
                                    করতে পারবে। একাধিক আবেদন গ্রহণযোগ্য হবে না।</div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq4">
                                    আবেদন কীভাবে করা যাবে?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">শুধুমাত্র এই ওয়েবসাইটে রেজিস্ট্রেশন-এ
                                    ক্লিক করে অনলাইন আবেদন সম্পন্ন করতে হবে।</div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq5">
                                    আবেদন করতে কোনো ফি লাগবে?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">কোন ফি লাগবে না।</div>
                            </div>
                        </div>

                        <!-- FAQ 6 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq6">
                                    আবেদন করার শেষ তারিখ কবে?
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">ওয়েবসাইটে প্রকাশিত নির্ধারিত সময়সীমার
                                    মধ্যে আবেদন করতে হবে।</div>
                            </div>
                        </div>

                        <!-- FAQ 7 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq7">
                                    কী কী ডকুমেন্ট লাগবে?
                                </button>
                            </h2>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">শিক্ষার্থীর ছবি, এসএসসি/সমমান ২০২৬
                                    পরীক্ষার তথ্য, বাবা-মায়ের তথ্য এবং অন্যান্য প্রয়োজনীয় তথ্য।</div>
                            </div>
                        </div>

                        <!-- FAQ 8 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq8">
                                    নির্বাচিতদের কীভাবে জানানো হবে?
                                </button>
                            </h2>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">SMS এর মাধ্যমে জানানো হবে এবং নিজের ইউজার
                                    আইডি ও পাসওয়ার্ড ব্যবহার করেও এই ওয়েবসাইট থেকে জানা যাবে।</div>
                            </div>
                        </div>

                        <!-- FAQ 9 -->
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq9">
                                    নির্বাচিত শিক্ষার্থীরা কী কী সুবিধা পাবে?
                                </button>
                            </h2>
                            <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">
                                    নির্বাচিত শিক্ষার্থীরা পাবেন—<br>
                                    • শিক্ষা বৃত্তি (এককালীন)<br>
                                    • এইচএসসি অল সাবজেক্ট অনলাইন কোর্স<br>
                                    • সনদ<br>
                                    • ক্রেস্ট<br>
                                    • সংবর্ধনা মেডেল<br>
                                    • নাম্বার ওয়ান এর পক্ষ থেকে বিশেষ উপহার
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 10. আয়োজন পৃষ্ঠপোষকতায় Logo ========== -->
    <section class="py-4" style="background: linear-gradient(135deg, #F8FAFC, #FFFFFF);">
        <div class="container text-center">
            <h2 class="section-title mx-auto mb-md-5">আয়োজনের পৃষ্ঠপোষক</h2>
            <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                <img src="{{ asset('images/no1-logo-2.jpeg') }}" alt="MGI Logo" height="120"
                    style="object-fit: contain;">
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 overflow-hidden">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoFrame" src="" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Responsive Styles */
        :root {
            --mobile-padding: 1rem;
            --tablet-padding: 1.5rem;
            --desktop-padding: 2rem;
        }

        /* Fancy Feature Card */
        .fancy-feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }

        .fancy-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px -10px rgba(0, 0, 0, 0.89) !important;
        }

        .fancy-icon-wrapper {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .fancy-icon-wrapper {
                width: 70px;
                height: 70px;
            }
        }

        .shiny-border {
            transition: border-color 0.5s ease, box-shadow 0.5s ease;
            border: 2px solid #d0aa10;
            position: relative;
        }

        .shiny-border:hover {
            box-shadow: 0 0 20px rgba(9, 8, 7, 0.37);
        }

        /* For continuous automatic transition without hover */
        .shiny-border {
            animation: borderPulse 2.5s ease-in-out infinite alternate;
        }

        @keyframes borderPulse {
            0% {
                border-color: #f6e7b7ad;
                box-shadow: 0 0 0px rgba(223, 214, 184, 0.132);
            }

            100% {
                border-color: #f9bb1d45;
                box-shadow: 0 0 20px rgba(122, 101, 23, 0.32);
            }
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #f50b0bbe, #372020);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #089ffdc8, #273142);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #fff309c6, #3d3c24);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #54b4fdd2, #153337);
        }

        .bg-gradient-special {
            background: linear-gradient(135deg, #8f27ffcc 0%, #2a115a 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #14ffadd4, #203620);
        }

        /* Premium Shine Effect */
        .fancy-icon-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, .18),
                    transparent);
            transition: .7s;
        }

        .fancy-icon-wrapper:hover::before {
            left: 150%;
        }

        .fancy-icon-wrapper:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .22);
        }

        .mega-card {
            position: relative;
            overflow: hidden;
            transition: transform .35s ease, box-shadow .35s ease;
        }

        .mega-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -120%;
            width: 60%;
            height: 200%;
            background: linear-gradient(120deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.15) 30%,
                    rgba(255, 255, 255, 0.75) 50%,
                    rgba(255, 255, 255, 0.15) 70%,
                    transparent 100%);
            transform: rotate(20deg);
            transition: left 1.5s ease;
            pointer-events: none;
        }

        .mega-card:hover::before {
            left: 160%;
        }

        .mega-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
        }

        .text-gradient {
            background: linear-gradient(90deg,
                    #fd0e0e,
                    #f73558,
                    #ff9900,
                    #ffaf04,
                    #ff1b54);
            background-size: 300% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 5s linear infinite;
        }

        @keyframes gradientMove {
            from {
                background-position: 0%;
            }

            to {
                background-position: 300%;
            }
        }

        /* Timeline Card */
        @keyframes dotPulse {
            0% {
                transform: translateY(-50%) scale(1);
                box-shadow: 0 0 0 4px rgba(136, 18, 18, 0.15);
            }

            50% {
                transform: translateY(-50%) scale(1.3);
                box-shadow: 0 0 0 8px rgba(136, 18, 18, 0.25);
            }

            100% {
                transform: translateY(-50%) scale(1);
                box-shadow: 0 0 0 4px rgba(136, 18, 18, 0.15);
            }
        }

        .timeline-dot {
            animation: dotPulse 2s ease-in-out infinite;
        }

        /* Gallery Thumbnails */
        .gallery-thumb {
            transition: all 0.2s ease;
            opacity: 0.7;
            border: 2px solid transparent;
        }

        .gallery-thumb.active {
            opacity: 1;
            border-color: #881212;
            transform: scale(0.98);
        }

        .gallery-thumb:hover {
            opacity: 1;
            transform: scale(0.98);
        }

        /* Tab buttons responsive */
        .tab-btn {
            font-size: 0.8rem;
            padding: 0.4rem 1rem;
            border: 2px solid #e5e7eb;
            background: transparent;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tab-btn.active {
            background: #881212;
            color: white;
            border-color: #ce3c3c;
        }

        .tab-btn:hover:not(.active) {
            border-color: #881212;
            background: #f3f4f6;
        }

        @media (min-width: 768px) {
            .tab-btn {
                font-size: 1rem;
                padding: 0.5rem 1.8rem;
            }
        }

        /* Video thumb play button */
        .play-btn-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45px;
            height: 45px;
            background: rgba(239, 68, 68, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 2;
        }

        @media (min-width: 768px) {
            .play-btn-overlay {
                width: 60px;
                height: 60px;
                font-size: 1.7rem;
            }
        }

        .video-thumb {
            position: relative;
            cursor: pointer;
        }

        .video-thumb:hover .play-btn-overlay {
            transform: translate(-50%, -50%) scale(1.1);
            background: #881212;
        }

        /* Hero stats */
        .hero-stats {
            background: #fcf7f8;
            backdrop-filter: blur(8px);
            border-radius: 60px;
            padding: 0.5rem 1.2rem;
        }

        @media (min-width: 768px) {
            .hero-stats {
                padding: 0.5rem 1.5rem;
            }
        }

        /* Section spacing utilities */
        .py-6 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        @media (min-width: 768px) {
            .py-6 {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
        }

        /* Typography responsive */
        .display-large {
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .display-large {
                font-size: 2rem;
            }
        }

        @media (min-width: 992px) {
            .display-large {
                font-size: 3.0rem;
            }
        }

        .section-title {
            font-size: 1.6rem;
        }

        @media (min-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }

        @media (min-width: 992px) {
            .section-title {
                font-size: 2.5rem;
            }
        }

        /* Accordion button responsive */
        .accordion-button {
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .accordion-button {
                font-size: 1rem;
            }
        }


        /* Pulse Circle Animation */
        @keyframes pulse-circle {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.5;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.4);
                opacity: 1.2;
            }
        }

        /* Dot Pulse Animation */
        @keyframes dot-pulse {

            0%,
            100% {
                transform: translateX(-50%) scale(0.8);
                opacity: 0.6;
            }

            50% {
                transform: translateX(-50%) scale(1.2);
                opacity: 1.2;
            }
        }

        .position-absolute .position-absolute:nth-child(1) {
            animation: dot-pulse 2.5s ease-in-out infinite;
        }

        .position-absolute .position-absolute:nth-child(2) {
            animation: dot-pulse 2.5s ease-in-out infinite 0.5s;
        }

        .position-absolute .position-absolute:nth-child(3) {
            animation: dot-pulse 2.5s ease-in-out infinite 1s;
        }

        .position-absolute .position-absolute:nth-child(4) {
            animation: dot-pulse 2.5s ease-in-out infinite 1.5s;
        }

        @keyframes float-particle {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
                opacity: 0.3;
            }

            25% {
                transform: translate(30px, -40px) scale(1.2);
                opacity: 0.6;
            }

            50% {
                transform: translate(-20px, -80px) scale(0.8);
                opacity: 0.2;
            }

            75% {
                transform: translate(40px, -30px) scale(1.1);
                opacity: 0.5;
            }
        }

        /* Pulse Orb Animation */
        @keyframes pulse-orb {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }



        @media (min-width: 768px) {
            .text-large {
                font-size: clamp(1.2rem, 2.7vw, 2.7rem);
                white-space: nowrap;
            }

            .second-heading {
                line-height: 1.65;
                margin-top: 1.1rem;
                color: #020202dc;
            }
        }


        @media (max-width: 767px) {
            .text-large {
                font-size: clamp(1.8rem, 2.3vw, 1.8rem);
                white-space: normal;
            }

            .second-heading {
                font-size: clamp(0.95rem, 1.65vw, 1.4rem);
                line-height: 1.65;
                margin-top: 1.1rem;
                color: #020202dc;
            }
        }

        .others-heading {
            display: none;
        }

        .special-text {
            font-size: clamp(1.5rem, 1.8vw, 2.5rem);
            font-weight: 700;
            background: linear-gradient(90deg, #9d0505, #fa274ae6, #cb1f00e5, #bf1809, #8b0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.185);
            line-height: 1.4;
        }

    </style>
@endsection

@push('scripts')
    <script>
        // Global variable to store the current active modal instance
        let currentVideoModal = null;

        function playVideo(videoId) {
            // Destroy existing modal instance if it exists
            if (currentVideoModal) {
                currentVideoModal.dispose();
            }

            const modalElement = document.getElementById('videoModal');
            const iframe = document.getElementById('videoFrame');

            // Set the YouTube iframe src with autoplay
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&enablejsapi=1`;

            // Create new modal instance
            currentVideoModal = new bootstrap.Modal(modalElement);
            currentVideoModal.show();
        }

        // Reset video when modal is closed
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
            const iframe = document.getElementById('videoFrame');
            if (iframe) {
                iframe.src = '';
            }
        });

        // ============== DYNAMIC SUCCESS STORIES ==============
        const storyList = [{
                videoId: 'FN70yEkHFlY',
                quote: '“কমলাপুর, ঢাকা থেকে আগত নাম্বার ওয়ান বাবার কৃতী সন্তান জনাব জাহিদ হোসেন-এর বাবা জনাব মোঃ জাহাঙ্গীর তাঁর ভালো লাগার অনুভূতি শেয়ার করছেন।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-1.jpg') }}'
            },
            {
                videoId: '6ji8FHWegpU',
                quote: '“গাজীপুর থেকে আগত নাম্বার ওয়ান বাবার কৃতী সন্তান জনাব মো: মুজাহিদ প্রধান নাম্বার ওয়ান ব্র্যান্ড-কে ধন্যবাদ প্রদান করেছেন এই ধরণের প্রোগ্রাম আয়োজন করার জন্য।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-3.jpg') }}'
            },
            {
                videoId: '7-kC5XP-qYk',
                quote: '“ঠাকুরগাঁও থেকে আগত নাম্বার ওয়ান বাবা মোঃ আবুল হোসেন নাম্বার ওয়ান ব্র্যান্ডকে ধন্যবাদ জানিয়েছেন তাঁদেরকে নিয়ে এই প্রোগ্রাম আয়োজন করার জন্য।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-4.jpg') }}'
            },
            {
                videoId: '5Dtj-bUegMY',
                quote: '“কুমিল্লা থেকে আগত নাম্বার ওয়ান বাবার কৃতী সন্তান জনাব মো: তানিম আনাস তাঁর অনুভূতি শেয়ার করছেন।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-2.jpg') }}'
            },
            {
                videoId: '1558RuFY4D4',
                quote: '“দিনাজপুর থেকে আগত নাম্বার ওয়ান বাবার কৃতী সন্তান দিয়া রায় তাঁর অনুভূতি শেয়ার করছেন।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-5.png') }}'
            },
            {
                videoId: 'Ygc2yRAkhTU',
                quote: '“চট্টগ্রাম থেকে আগত নাম্বার ওয়ান বাবার কৃতী সন্তান মেহেরাজ আক্তার পুষ্পা তাঁর অনুভূতি শেয়ার করছেন।”',
                author: '',
                thumbnail: '{{ asset('images/thumbnail/thumb-9.png') }}'
            },
        ];

        const STORIES_PER_PAGE = 3;
        let storiesShown = 0;

        const storiesGrid = document.getElementById('storiesGrid');
        const loadMoreBtn = document.getElementById('storiesLoadMoreBtn');
        const loadMoreWrapper = document.getElementById('storiesLoadMoreWrapper');

        function renderStoryCard(story) {
            const col = document.createElement('div');
            col.className = 'col-12 col-md-4';

            col.innerHTML = `
                <div class="video-thumb rounded-4 overflow-hidden shadow-lg position-relative"
                     style="cursor: pointer;"
                     data-video-id="${story.videoId}">
                    <img src="${story.thumbnail}"
                         alt="Success Story"
                         class="w-100 story-thumbnail"
                         style="height: 200px; object-fit: cover;">
                    <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                </div>
                <p class="mt-2 mt-md-3 fw-bold text-center fs-6 fs-md-5 px-2">
                    ${story.quote}
                </p>
            `;
            return col;
        }

        function loadMoreStories() {
            const nextBatch = storyList.slice(storiesShown, storiesShown + STORIES_PER_PAGE);

            nextBatch.forEach(story => {
                const card = renderStoryCard(story);
                storiesGrid.appendChild(card);

                // Attach click handler to the video thumbnail
                const thumb = card.querySelector('.video-thumb');
                thumb.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const videoId = this.getAttribute('data-video-id');
                    if (videoId) {
                        playVideo(videoId);
                    }
                });
            });

            storiesShown += nextBatch.length;

            // Hide load more button if all stories are shown
            if (storiesShown >= storyList.length) {
                loadMoreWrapper.style.display = 'none';
            }
        }

        // Initial load - show first 2 stories
        loadMoreStories();

        // Load more on button click
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', loadMoreStories);
        }

        // ============== DYNAMIC VIDEO GALLERY ==============
        const videoList = [{
                id: 'tQ9s2vlJ_mU',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-5.jpg') }}'
            },
            {
                id: 'cm0n089vPDM',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-6.jpg') }}'
            },
            {
                id: 'QDJ2-roC3Zs',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-7.jpg') }}'
            },
            {
                id: 'NyCj_Ku4tqg',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-8.png') }}'
            },
            {
                id: 'Ygc2yRAkhTU',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-9.png') }}'
            },
            {
                id: 'bqGGZS_QQSc',
                title: 'সংবর্ধনা ২০২৫ - স্মৃতিচারণ',
                thumbnail: '{{ asset('images/thumbnail/thumb-10.png') }}'
            }
        ];

        const VIDEOS_PER_PAGE = 3;
        let videosShown = 0;

        const videoGrid = document.getElementById('videoGrid');
        const loadMoreVideosBtn = document.getElementById('loadMoreVideosBtn');
        const loadMoreVideosWrapper = document.getElementById('loadMoreWrapper');

        function renderVideoCard(video) {
            const col = document.createElement('div');
            col.className = 'col-12 col-md-4';

            col.innerHTML = `
           <div class="video-thumb rounded-4 overflow-hidden shadow-lg position-relative" data-video-id="${video.id}">
                <img src="${video.thumbnail}"
                    alt="${video.title}"
                    class="w-100"
                    style="height: 200px; object-fit: cover;"
                    onerror="this.onerror=null;this.src='/images/dummy-image.png';">
                <div class="play-btn-overlay">
                    <i class="fas fa-play text-white"></i>
                </div>
            </div>
                <p class="text-center mt-2 small fw-semibold">${video.title}</p>
            `;
            return col;
        }

        function loadMoreVideos() {
            const nextBatch = videoList.slice(videosShown, videosShown + VIDEOS_PER_PAGE);

            nextBatch.forEach(video => {
                const card = renderVideoCard(video);
                videoGrid.appendChild(card);

                // attach click handler to the newly added card
                card.querySelector('.video-thumb').addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    playVideo(this.getAttribute('data-video-id'));
                });
            });

            videosShown += nextBatch.length;

            if (videosShown >= videoList.length) {
                loadMoreVideosWrapper.style.display = 'none';
            }
        }

        // Initial load
        loadMoreVideos();

        if (loadMoreVideosBtn) {
            loadMoreVideosBtn.addEventListener('click', loadMoreVideos);
        }

        // ============== GALLERY FUNCTIONALITY ==============
        const galleryData = {
            all: [
                "{{ asset('images/success-story-1.jpg') }}",
                "{{ asset('images/success-story-2.jpg') }}",
                "{{ asset('images/success-story-4.jpg') }}",
                "{{ asset('images/success-story-5.jpg') }}",
                "{{ asset('images/success-story-6.jpg') }}",
                "{{ asset('images/success-story-7.jpg') }}",
            ],
            2024: [
                "{{ asset('images/success-story-6.jpg') }}",
                "{{ asset('images/success-story-7.jpg') }}",
            ],
            2025: [
                "{{ asset('images/success-story-1.jpg') }}",
                "{{ asset('images/success-story-2.jpg') }}",
                "{{ asset('images/success-story-4.jpg') }}",
                "{{ asset('images/success-story-5.jpg') }}",
            ]
        };

        let currentImages = galleryData.all,
            currentIdx = 0;
        const mainImg = document.getElementById('galleryMain');
        const thumbsDiv = document.getElementById('galleryThumbs');

        function renderGallery() {
            if (currentImages.length > 0 && mainImg) {
                mainImg.src = currentImages[currentIdx];
            }
            if (thumbsDiv) {
                thumbsDiv.innerHTML = '';
                currentImages.forEach((src, i) => {
                    const col = document.createElement('div');
                    col.className = 'col-3 col-md-2';
                    const thumb = document.createElement('img');
                    thumb.src = src;
                    thumb.className = 'gallery-thumb w-100 rounded-3';
                    thumb.style.height = '60px';
                    thumb.style.objectFit = 'cover';
                    thumb.style.cursor = 'pointer';
                    if (i === currentIdx) thumb.classList.add('active');
                    thumb.addEventListener('click', () => {
                        currentIdx = i;
                        renderGallery();
                    });
                    col.appendChild(thumb);
                    thumbsDiv.appendChild(col);
                });
            }
        }

        // Initialize gallery tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const cat = this.getAttribute('data-cat');
                currentImages = galleryData[cat] || galleryData.all;
                currentIdx = 0;
                renderGallery();
            });
        });

        const heroMoreToggle = document.getElementById('heroMoreToggle');
        const heroMoreText = document.querySelector('.others-heading');

        if (heroMoreToggle && heroMoreText) {
            heroMoreToggle.addEventListener('click', function(e) {
                e.preventDefault();

                const isHidden = heroMoreText.style.display === 'none' || getComputedStyle(heroMoreText).display ===
                    'none';
                heroMoreText.style.display = isHidden ? 'block' : 'none';
                this.textContent = isHidden ? 'সংক্ষিপ্ত করুন' : 'বিস্তারিত দেখুন';
            });
        }

        // Initialize gallery on page load
        renderGallery();
    </script>
@endpush
