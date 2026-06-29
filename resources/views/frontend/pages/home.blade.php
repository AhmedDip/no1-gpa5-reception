@extends('frontend.layouts.app')

@section('title', 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬')

@section('content')
    <!-- ========== 1. CAMPAIGN OVERVIEW / HERO ========== -->
    <section id="campaign" class="hero">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-7 text-center text-lg-start" data-aos="fade-up">
                    <div class="hero-badge d-inline-flex">
                        <span>২০২৬ সালের বৃহৎ শিক্ষা উদ্যোগ</span>
                    </div>
                    <h1 class="display-large fw-bold main-heading">নাম্বার ওয়ান বাবার <span class="text-gradient">কৃতী
                            সন্তান</span>
                        সংবর্ধনা - ২০২৬</h1>
                    <p class="lead text-secondary mt-3 mt-lg-4">
                        প্রতিটি সন্তানের সাফল্যের পেছনে থাকে একজন সংগ্রামী বাবা-মায়ের অক্লান্ত পরিশ্রম, ত্যাগ ও ভালোবাসা।
                        বাংলাদেশের হাজারো চা-স্টল ব্যবসায়ী প্রতিদিন কঠোর পরিশ্রম করে তাদের সন্তানদের শিক্ষার স্বপ্ন পূরণ
                        করে চলেছেন।
                        সেই সংগ্রামী বাবা-মায়ের অবদানকে সম্মান জানাতে এবং তাদের মেধাবী সন্তানদের অর্জনকে উদযাপন করতে
                        নাম্বার ওয়ান আয়োজন করেছে "নাম্বার ওয়ান বাবার কৃতি সন্তান সংবর্ধনা ২০২৬"।

                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center justify-content-lg-start">
                        <a href="{{ route('student.register') }}" class="btn btn-primary btn-lg px-4 px-lg-5"> নিবন্ধন করুন
                            <i class="fas fa-chevron-right"></i></a>
                        <a href="#faq" class="btn btn-outline-secondary btn-lg px-4 px-lg-5">বিস্তারিত দেখুন
                        </a>
                    </div>
                    <div class="hero-stats d-inline-flex mt-5 gap-3 gap-lg-4">
                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">১,০০০+</span>
                            <span class="small text-secondary">নিবন্ধিত শিক্ষার্থী</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">৫০০+</span>
                            <span class="small text-secondary">স্কলারশিপ প্রাপ্ত শিক্ষার্থী</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">৫০,০০০+ </span>
                            <span class="small text-secondary">টাকার আর্থিক অনুদান </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center floating-element">
                    <img src="{{ asset('images/hero-image.png') }}" alt="hero" class="img-fluid rounded-4 shadow-lg"
                        style="max-width: 92%;">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 2. MESSAGE FROM NO.1 BRAND ========== -->
    <section class="container py-4 py-md-5 my-2 my-md-4 text-center">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-8">
                <h2 class="section-title mx-auto">
                    <img src="{{ asset('images/mgi-logo.png') }}" alt="brand" height="40" class="me-2">
                    এর পক্ষ থেকে শুভেচ্ছা
                </h2>

                <p class="lead mt-4 fs-5 fs-md-4 fw-medium text-dark-emphasis">
                    "সন্তানের সাফল্য, বাবার গর্ব।
                    চা-স্টল ব্যবসায়ীদের অক্লান্ত পরিশ্রম ও তাদের সন্তানদের অসাধারণ অর্জনকে সম্মান জানাতে নাম্বার ওয়ান
                    সবসময় পাশে আছে।
                    নাম্বার ওয়ান বাবার কৃতি সন্তান সংবর্ধনা ২০২৬—সংগ্রামের গল্পকে সম্মানের মঞ্চে তুলে ধরার একটি আন্তরিক
                    উদ্যোগ।"

                </p>
                {{-- <img src="{{ asset('images/no1-logo.png') }}" alt="brand" height="60" class="me-2"> --}}
            </div>
        </div>
    </section>

    <!-- ========== 3. SCHOLARSHIP & FELICITATION DETAILS ========== -->
    <section class="bg-light py-5 py-md-6 mt-3 mt-md-5">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title">স্কলারশিপ ও সার্টিফিকেট বিবরণ</h2>
                <p class="text-secondary px-2">জিপিএ-৫ প্রাপ্ত প্রতিটি শিক্ষার্থী পেলেই অনন্য সুযোগ — আর্থিক বৃত্তি,
                    আন্তর্জাতিক মাপকাঠির সার্টিফিকেট ও এক্সক্লুসিভ মেন্টরশিপ।</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-12 col-lg-7">
                    <div class="card-premium h-100 p-4 p-md-5 position-relative overflow-hidden"
                        style="background: linear-gradient(135deg, rgba(159, 126, 249, 0.105), rgba(240, 231, 255, 0.1));">
                        {{-- <div class="ribbon">স্কলারশিপ</div> --}}
                        <div class="d-flex gap-3 align-items-start">
                            <div class="me-3 d-none d-md-block">
                                <div
                                    class="fancy-icon-wrapper bg-gradient-danger text-white d-flex align-items-center justify-content-center">
                                    <i class="fas fa-award fs-2 text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="fw-bold">জিপিএ-৫ প্রাপ্ত শিক্ষার্থীদের</h3>
                                <p class="text-dark-emphasis">স্কলারশিপের মাধ্যমে শিক্ষার্থীদের পড়াশোনার ব্যয় হ্রাস করা
                                    হবে। এছাড়া ডিজিটাল স্কিল ও ক্যারিয়ার মেন্টরশিপ প্রদান করা হবে যাতে তারা ভবিষ্যতে
                                    স্বনির্ভর হয়ে উঠতে পারে।</p>
                                <ul class="list-unstyled mt-3 mb-0">
                                    <li class="mb-2"><i class="fas fa-award text-secondary me-2"></i>আর্থিক মেধা
                                        বৃত্তি</li>
                                    <li class="mb-2"><i class="fas fa-certificate text-secondary me-2"></i>প্রিমিয়াম
                                        সার্টিফিকেট (ডিজিটাল + প্রিন্ট)</li>
                                    <li class="mb-2"><i class="fas fa-user-friends text-secondary me-2"></i>টপ-মেন্টরদের
                                        থেকে গাইডেন্স ও ক্যারিয়ার সাপোর্ট</li>
                                </ul>
                                <div class="mt-4">
                                    <a href="#eligibility" class="btn btn-primary me-2">যোগ্যতা দেখুন</a>
                                    <a href="#" class="btn btn-outline-secondary">আরও জানুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute"
                            style="right: -60px; bottom: -30px; opacity:0.12; transform: rotate(-20deg);">
                            <img src="{{ asset('images/no1-logo.png') }}" alt="logo" height="220">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-primary text-white">
                                        <i class="fas fa-certificate fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">সার্টিফিকেট</h5>
                                        <p class="small text-secondary mb-0">
                                            আন্তর্জাতিক মানের প্রিন্ট সার্টিফিকেট
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-warning text-white">
                                        <i class="fas fa-book fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">শিক্ষা উপকরণ </h5>
                                        <p class="small text-secondary mb-0">
                                            শিক্ষার্থীদের জন্য প্রয়োজনীয় শিক্ষা উপকরণ প্রদান করা হবে।
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--
                         <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-info mx-auto mb-2 mb-md-3">
                            <i class="fas fa-medal fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">সংবর্ধনা মেডেল</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">প্রতিযোগিতামূলক সংবর্ধনা মেডেল</p>
                    </div>
                </div> --}}

                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-success text-white">
                                        <i class="fas fa-medal fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">সংবর্ধনা মেডেল </h5>
                                        <p class="small text-secondary mb-0">প্রতিযোগিতামূলক সংবর্ধনা মেডেল</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature badges -->
            <div class="row mt-4 mt-md-5 g-3 g-md-4 justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-danger mx-auto mb-2 mb-md-3">
                            <i class="fas fa-award fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">শিক্ষা সহায়তা</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">বৃত্তি ও ভাতা</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-success mx-auto mb-2 mb-md-3">
                            <i class="fas fa-award fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">ক্রেস্ট</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">আন্তর্জাতিক মানের প্রিন্ট ক্রেস্ট</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-warning mx-auto mb-2 mb-md-3">
                            <i class="fas fa-star fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">মেন্টরশিপ</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">বিশেষ ওয়ার্কশপ</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-info mx-auto mb-2 mb-md-3">
                            <i class="fas fa-gift fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">বিশেষ উপহার</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">
                            নাম্বার ওয়ান এর পক্ষ থেকে বিশেষ উপহার
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 4. ELIGIBILITY CRITERIA + SPECIAL SEMINAR ========== -->
    <section id="eligibility" class="container py-4 py-md-5 my-3 my-md-5">
        <div class="row g-4 g-lg-5 align-items-stretch">
            <div class="col-12 col-lg-7">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 h-100 border border-light">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div
                            class="fancy-icon-wrapper bg-gradient-primary text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-shield-alt fs-2 text-white"></i>
                        </div>
                        <h2 class="section-title mb-0 fs-3 fs-md-2">যোগ্যতা ও নিয়মাবলী</h2>
                    </div>
                    <div class="mt-3 mt-md-4">
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="fas fa-solid fa-bullseye text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="fas fa-solid fa-bullseye text-danger fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">এসএসসি/সমমান ২০২৬ পরীক্ষায় </strong><br><span
                                    class="text-secondary small">কৃতিত্বের সাথে জিপিএ-৫ অর্জন করে সফলভাবে উত্তীর্ণ হতে
                                    হবে।</span></div>
                        </div>
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="fas fa-solid fa-bullseye text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="fas fa-solid fa-bullseye text-danger fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">আবেদনকারী শিক্ষার্থীর বাবা/অভিভাবক</strong><br><span
                                    class="text-secondary small">একজন সক্রিয় চা-স্টল ব্যবসায়ী হতে হবে এবং তা প্রমাণযোগ্য
                                    হতে হবে।</span></div>
                        </div>
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="fas fa-solid fa-bullseye text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="fas fa-solid fa-bullseye text-danger fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">নির্ধারিত সময়সীমার মধ্যে অনলাইনে</strong><br><span
                                    class="text-secondary small">আবেদনপত্রের সকল তথ্য সঠিকভাবে ও নির্ভুলভাবে পূরণ করে
                                    নির্ধারিত প্রক্রিয়ায় আবেদন সম্পন্ন করতে হবে।</span></div>
                        </div>
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            <i class="fas fa-solid fa-bullseye text-danger fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">আবেদনপত্রের সঙ্গে প্রয়োজনীয় সকল তথ্য, ছবি ও
                                    ডকুমেন্ট</strong><br><span class="text-secondary small">নির্ধারিত নির্দেশনা অনুযায়ী
                                    সঠিকভাবে, সম্পূরণভাবে এবং যথাসময়ে আপলোড করতে হবে।</span></div>
                        </div>

                        <div class="d-flex gap-3">
                            <i class="fas fa-solid fa-bullseye text-danger fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">আবেদনকারীকে নাম্বার ওয়ান কর্তৃপক্ষের
                                    নির্ধারিত</strong><br><span class="text-secondary small">যাচাই-বাছাই, তথ্য যাচাইকরণ ও
                                    চূড়ান্ত নির্বাচন প্রক্রিয়ায় সফলভাবে এবং সন্তোষজনকভাবে উত্তীর্ণ হতে হবে।</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="rounded-4 p-4 p-md-5 h-100 d-flex flex-column justify-content-between mega-card"
                    style="background: linear-gradient(135deg, #fbfdff 10%, #e3e7fc 90%);">
                    <div class="d-flex justify-content-between align-items-start mb-3 mb-md-4">
                        <i class="fa-solid fa-bullhorn fs-2 fs-md-1 text-danger opacity-75"></i>
                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill small">লিমিটেড আসন</span>
                    </div>
                    <h3 class="fw-bold fs-2 fs-md-1 text-dark">আজই নিবন্ধন করুন</h3>
                    <p class="fs-6 fs-md-5 text-dark-emphasis mt-2 mt-md-3">আপনি যদি <strong
                            class="text-primary">এসএসসি/সমমান ২০২৬ পরীক্ষায় </strong> কৃতিত্বের সাথে জিপিএ-৫ অর্জন করে
                        সফলভাবে উত্তীর্ণ হন এবং আপনার বাবা/অভিভাবক একজন চা-স্টল ব্যবসায়ী হন, তাহলে এখনই নিবন্ধন করুন।
                    </p>

                    <p class="fs-6 fs-md-5 text-dark-emphasis mt-2 mt-md-3">নিবন্ধন প্রক্রিয়ার জন্য আপনার কাছে থাকা উচিত:
                    <ul class="list-unstyled mt-2">
                        <li><i class="fas fa-check text-success me-2"></i>আবেদনকারীর ব্যক্তিগত তথ্য ও যোগাযোগের বিস্তারিত
                            বিবরণ। </li>
                        <li><i class="fas fa-check text-success me-2"></i>এসএসসি ২০২৬ পরীক্ষার ফলাফল ও একাডেমিক তথ্য।</li>
                        <li><i class="fas fa-check text-success me-2"></i>বাবা/অভিভাবকের পরিচয়, পেশা ও প্রয়োজনীয় তথ্য।
                        </li>
                        <li><i class="fas fa-check text-success me-2"></i>প্রয়োজনীয় ছবি, ডকুমেন্ট ও সহায়ক কাগজপত্র
                            আপলোড।</li>
                    </ul>
                    </p>


                    <div class="mt-3 mt-md-4">
                        <a href="{{ route('student.register') }}"
                            class="btn btn-dark btn-lg rounded-pill px-4 px-md-5 shadow-sm w-100 w-md-auto">আসন
                            নিশ্চিত করুন <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                    <div class="mt-3 mt-md-4 small text-dark-emphasis">
                        <i class="fas fa-calendar-check"></i> তারিখ: ১০ মে, ২০২৬ | স্থান: ঢাকা ও চট্টগ্রাম
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 5. TIMELINE (clean & modern) ========== -->
    <section id="timeline" class="py-5 py-md-6 mt-3 mt-md-5"
        style="background: linear-gradient(to bottom, #F8FAFC, #FFFFFF);">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <div
                    class="d-inline-flex align-items-center gap-2 bg-white px-3 px-md-4 py-2 rounded-pill shadow-sm mb-3 mb-md-4">
                    <i class="fas fa-calendar-event text-primary"></i>
                    <span class="fw-semibold small">গুরুত্বপূরণ তারিখসমূহ</span>
                </div>
                <h2 class="display-6 display-md-5 fw-bold text-dark">প্রধান সময়সূচি</h2>
                <p class="text-secondary fs-6 fs-md-5 px-2">২০২৬ সালের গুরুত্বপূরণ মাইলফলক</p>
            </div>
            <div class="row g-3 g-md-5 justify-content-center">
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-secondary shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">01</div>
                        <div class="fancy-icon-wrapper bg-gradient-primary mx-auto mb-2 mb-md-3">
                            <i class="fas fa-calendar-plus fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">নিবন্ধন শুরু</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">১ জানু</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-secondary shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">02</div>
                        <div class="fancy-icon-wrapper bg-gradient-danger mx-auto mb-2 mb-md-3">
                            <i class="fas fa-calendar-times fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">নিবন্ধন শেষ</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">১৫ মার্চ</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-secondary shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">03</div>
                        <div class="fancy-icon-wrapper bg-gradient-success mx-auto mb-2 mb-md-3">
                            <i class="fas fa-calendar-check fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">মেধা তালিকা</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">এপ্রিল</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-secondary shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">04</div>
                        <div class="fancy-icon-wrapper bg-gradient-special mx-auto mb-2 mb-md-3">
                            <i class="fas fa-people-group fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">সংবর্ধনা</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">মে</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 6. SUCCESS STORIES ========== -->
    <section id="stories" class="container py-4 py-md-5 my-3 my-md-4">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="section-title mx-auto">আলোকিত গল্প, সফলতার অনুপ্রেরণা</h2>
            <p class="text-secondary px-2">আগের বছরের কৃতী শিক্ষার্থীদের অভিজ্ঞতা</p>
        </div>
        <div class="row g-3 g-md-4">
            <div class="col-12 col-md-6">
                <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="k6X4nDePiTw">
                    <img src="{{ asset('images/success-story-1.jpg') }}" alt="success story" class="w-100"
                        style="height: 200px; object-fit: cover;">
                    <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                </div>
                <p class="mt-2 mt-md-3 fw-bold text-center fs-6 fs-md-5 px-2">“এই সংবর্ধনা আমার জীবনের মোড় ঘুরিয়ে
                    দিয়েছে।”
                    <br class="d-none d-md-block">— রাইসা, চাঁপাইনবাবগঞ্জ
                </p>
            </div>
            <div class="col-12 col-md-6">
                <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="k6X4nDePiTw">
                    <img src="{{ asset('images/success-story-4.jpg') }}" alt="success story" class="w-100"
                        style="height: 200px; object-fit: cover;">
                    <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                </div>
                <p class="mt-2 mt-md-3 fw-bold text-center fs-6 fs-md-5 px-2">সেরা কলেজ পেতে কৌশল - সাফল্যের সাক্ষী রাফসান
                </p>
            </div>
        </div>
    </section>

    <!-- ========== 7. বিগত বছরের সংবর্ধনার ভিডিও চিত্র ========== -->
    <section class="bg-dark text-white py-5 py-md-6 mt-3 mt-md-5">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title text-white mx-auto fs-3 fs-md-2">বিগত বছরের সংবর্ধনার ভিডিও চিত্র</h2>
                <p class="text-light opacity-75 small">মুহূর্তগুলো দেখুন, অনুপ্রেরণা নিন</p>
            </div>
            <div class="row g-3 g-md-4">
                <div class="col-12 col-md-4">
                    <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="k6X4nDePiTw">
                        <img src="{{ asset('images/success-story-1.jpg') }}" alt="success story" class="w-100"
                            style="height: 200px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">ঢাকা বিভাগীয় সংবর্ধনা ২০২৪</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="k6X4nDePiTw">
                        <img src="{{ asset('images/success-story-3.jpg') }}" alt="success story" class="w-100"
                            style="height: 200px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">ঢাকা বিভাগীয় সংবর্ধনা ২০২৫</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="k6X4nDePiTw">
                        <img src="{{ asset('images/success-story-4.jpg') }}" alt="success story" class="w-100"
                            style="height: 200px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="fas fa-play text-white"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">ঢাকা বিভাগীয় সংবর্ধনা ২০২৬</p>
                </div>
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
                <button class="tab-btn" data-cat="dhaka">২০২৬</button>
                <button class="tab-btn" data-cat="chattogram">২০২৫</button>
            </div>
        </div>
        <div class="gallery-main-container">
            <img id="galleryMain" src="" alt="Gallery Main" class="gallery-main-img w-100 rounded-4 shadow-lg"
                style="height: auto; max-height: 400px; min-height: 250px; object-fit: cover;">
            <div id="galleryThumbs" class="row mt-3 mt-md-4 g-2 justify-content-center"></div>
        </div>
    </section>

    <!-- ========== 9. FAQs ========== -->
    <section id="faq" class="bg-light py-5 py-md-6 mt-3 mt-md-4">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="section-title mx-auto">সাধারণ জিজ্ঞাসা</h2>
                <p class="text-secondary px-2">আপনার মনে যেকোনো প্রশ্নের উত্তর এখানে</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-11 col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq1">কারা আবেদন করতে পারবে?</button></h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">এসএসসি ২০২৬ পরীক্ষায় কৃতিত্বের সাথে
                                    উত্তীর্ণ চা-স্টল ব্যবসায়ীদের সন্তানেরা আবেদন করতে পারবে।</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">আবেদন কীভাবে করবো?</button></h2>
                            <div id="faq2" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">এই ওয়েবসাইটে নিবন্ধন করে অনলাইন আবেদন
                                    সম্পন্ন করতে হবে। </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">আবেদন করতে কোনো ফি লাগবে?</button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">না। আবেদন সম্পূর্ণ বিনামূল্যে।</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq4">আবেদন করার শেষ তারিখ কত?</button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">ওয়েবসাইটে প্রকাশিত নির্ধারিত সময়সীমার
                                    মধ্যে আবেদন করতে হবে।</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq5">কী কী ডকুমেন্ট লাগবে?</button></h2>
                            <div id="faq5" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">এসএসসি ফলাফল, শিক্ষার্থীর ছবি, অভিভাবকের
                                    তথ্য এবং প্রয়োজনীয় অন্যান্য ডকুমেন্ট।</div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq6">নির্বাচিতদের কীভাবে জানানো
                                    হবে?</button></h2>
                            <div id="faq6" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">SMS এবং ওয়েবসাইটের মাধ্যমে নির্বাচিতদের
                                    জানানো হবে।</div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq7">নির্বাচিত শিক্ষার্থীরা কী কী সুবিধা
                                    পাবে?</button></h2>
                            <div id="faq7" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">
                                    নির্বাচিত শিক্ষার্থীরা পাবেন—
                                    • সংবর্ধনা মেডেল
                                    • শিক্ষা সহায়তা (Scholarship)
                                    • সার্টিফিকেট
                                    • ক্রেস্ট
                                    • শিক্ষা উপকরণ
                                    • নাম্বার ওয়ান এর পক্ষ থেকে বিশেষ উপহার

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 10. CONTACT INFO ========== -->
    <section class="container my-4 my-md-5 py-3 py-md-4">
        <div class="bg-gradient-contact rounded-4 p-4 p-md-5 text-center text-md-start shadow-lg"
            style="background: linear-gradient(120deg, #eeeffce8 0%, #FFFFFF 100%);">
            <div class="row align-items-center g-3 g-md-4">
                <div class="col-12 col-md-8">
                    <h3 class="fw-bold fs-3 fs-md-2">আপনার প্রশ্ন আছে?</h3>
                    <p class="fs-6 fs-md-5 text-secondary mb-2 mb-md-3">আমাদের সাপোর্ট টিম ২৪/৭ নিয়োজিত আছে আপনার যেকোনো
                        সমস্যার সমাধানে।</p>
                    <div
                        class="d-flex flex-wrap gap-3 gap-md-4 mt-2 mt-md-3 justify-content-center justify-content-md-start">
                        <div class="small"><i class="fas fa-phone text-dark me-2"></i>
                            <strong>০১৯৮৮-৭৬৫৪৩২</strong>
                        </div>
                        <div class="small"><i class="fas fa-envelope text-dark me-2"></i>
                            <strong>support@babarkritisontan.com</strong>
                        </div>
                        <div class="small"><i class="fas fa-phone text-dark me-2"></i> <strong>০১৭XX-XXXXXX</strong>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mt-3 mt-md-0">
                    <img src="{{ asset('images/no1-logo.png') }}" alt="customer care"
                        class="rounded-circle shadow-lg border border-white border-3" width="90" height="90"
                        style="object-fit: cover;">
                    <p class="mt-2 fw-semibold small">কাস্টমার কেয়ার</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== 11. Section আয়োজন  পৃষ্ঠপোষকতায়  Logo of mgi and no1 ========== -->

    <section class="py-4" style="background: linear-gradient(135deg, #F8FAFC, #FFFFFF);">
        <div class="container text-center">
            <h2 class="section-title mx-auto mb-md-5">আমাদের আয়োজনের পৃষ্ঠপোষক</h2>
            <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                <img src="{{ asset('images/mgi-logo.png') }}" alt="MGI Logo" height="60"
                    style="object-fit: contain;">
                <img src="{{ asset('images/no1-logo.png') }}" alt="No1 Logo" height="120"
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
            box-shadow: 0 15px 25px -10px rgba(0, 0, 0, 0.12) !important;
        }

        .fancy-icon-wrapper {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        /* .fancy-feature-card:hover .fancy-icon-wrapper {
                                                            transform: scale(1.1);
                                                        } */

        @media (min-width: 768px) {
            .fancy-icon-wrapper {
                width: 70px;
                height: 70px;
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

        .bg-gradient-primary::before,
        .bg-gradient-success::before,
        .bg-gradient-warning::before,
        .bg-gradient-danger::before,
        .bg-gradient-info::before,
        .bg-gradient-special::before {

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

        .bg-gradient-primary:hover::before,
        .bg-gradient-success:hover::before,
        .bg-gradient-warning:hover::before,
        .bg-gradient-danger:hover::before,
        .bg-gradient-info:hover::before,
        .bg-gradient-special:hover::before {
            left: 150%;
        }

        .bg-gradient-primary:hover,
        .bg-gradient-success:hover,
        .bg-gradient-warning:hover,
        .bg-gradient-danger:hover,
        .bg-gradient-info:hover,
        .bg-gradient-special:hover,
        .bg-gradient-dark:hover {

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
                    #ff4d6d,
                    #5f12e4,
                    #25b6eb,
                    #ff4d6d);
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
        .timeline-card-modern {
            transition: all 0.3s ease;
        }

        .timeline-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px -10px rgba(0, 0, 0, 0.12) !important;
        }

        .timeline-number {
            font-size: 2rem;
            font-weight: 800;
            color: rgba(0, 0, 0, 0.04);
            position: absolute;
            top: 5px;
            right: 10px;
            line-height: 1;
        }

        @media (min-width: 768px) {
            .timeline-number {
                font-size: 3rem;
                top: 10px;
                right: 20px;
            }
        }

        /* Gallery Thumbnails */
        .gallery-thumb {
            transition: all 0.2s ease;
            opacity: 0.7;
            border: 2px solid transparent;
        }

        .gallery-thumb.active {
            opacity: 1;
            border-color: var(--primary, #4F46E5);
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
        }

        @media (min-width: 768px) {
            .play-btn-overlay {
                width: 60px;
                height: 60px;
                font-size: 1.7rem;
            }
        }

        .video-thumb:hover .play-btn-overlay {
            transform: translate(-50%, -50%) scale(1.1);
            background: var(--primary, #4F46E5);
        }

        /* Hero stats */
        .hero-stats {
            background: rgba(255, 255, 255, 0.8);
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
            font-size: 2rem;
        }

        @media (min-width: 768px) {
            .display-large {
                font-size: 3rem;
            }
        }

        @media (min-width: 992px) {
            .display-large {
                font-size: 3.5rem;
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

        // Handle video thumbnails click
        document.querySelectorAll('.video-thumb').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                let videoId = el.getAttribute('data-video-id');

                // If the clicked element doesn't have data-video-id, check parent
                if (!videoId && el.closest('[data-video-id]')) {
                    videoId = el.closest('[data-video-id]').getAttribute('data-video-id');
                }

                if (videoId) {
                    playVideo(videoId);
                } else {
                    console.error('No video ID found for:', el);
                }
            });
        });

        // Also handle any elements with .video-play-btn class
        document.querySelectorAll('.video-play-btn').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                let videoId = el.getAttribute('data-video-id');
                if (!videoId && el.closest('[data-video-id]')) {
                    videoId = el.closest('[data-video-id]').getAttribute('data-video-id');
                }

                if (videoId) {
                    playVideo(videoId);
                }
            });
        });

        // Reset video when modal is closed
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
            const iframe = document.getElementById('videoFrame');
            if (iframe) {
                iframe.src = '';
            }
        });

        // Gallery functionality
        const galleryData = {
            all: [
                // "http://127.0.0.1:8000/images/success-story-1.jpg",
                "{{ asset('images/success-story-1.jpg') }}",
                "{{ asset('images/success-story-2.jpg') }}",
                "{{ asset('images/success-story-3.jpg') }}",
                "{{ asset('images/success-story-4.jpg') }}"
            ],
            dhaka: [
                "{{ asset('images/success-story-1.jpg') }}",
                "{{ asset('images/success-story-2.jpg') }}",
            ],
            chattogram: [
                "{{ asset('images/success-story-3.jpg') }}",
                "{{ asset('images/success-story-4.jpg') }}",
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

        // Initialize gallery on page load
        renderGallery();
    </script>
@endpush
