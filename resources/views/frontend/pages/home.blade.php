@extends('frontend.layouts.app')

@section('title', 'নং ১ বাবার কৃতী সন্তান সংবর্ধনা ২০২৬')

@section('content')
    <!-- ========== 1. CAMPAIGN OVERVIEW / HERO ========== -->
    <section id="campaign" class="hero">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-7 text-center text-lg-start" data-aos="fade-up">
                    <div class="hero-badge d-inline-flex">
                        <i class="bi bi-trophy-fill"></i> <span>২০২৬ সালের বৃহৎ শিক্ষা উদ্যোগ</span>
                    </div>
                    <h1 class="display-large fw-bold">নং ১ বাবার <span class="text-gradient">কৃতী সন্তান</span> সংবর্ধনা</h1>
                    <p class="lead text-secondary mt-3 mt-lg-4">
                        আগামীর চ্যালেঞ্জ মোকাবিলায় নিজেকে প্রস্তুত রাখতে অনলাইনে নিবন্ধন করলেই বাংলায় এআই শেখার ২টি কোর্স
                        এবং নিজেকে এগিয়ে রাখতে ও স্বপ্নের কলেজে ভর্তির পরামর্শ পেতে অর্জন করতে পারো নানা উপহার।
                        সারা দেশে ২০২৬ সালের এসএসসি ও সমমানের পরীক্ষায় জিপিএ-৫ অর্জন করে তোমার শহরে সংবর্ধনায় যোগ দিতে
                        পারবে।
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center justify-content-lg-start">
                        <a href="#" class="btn btn-primary btn-lg px-4 px-lg-5">এখনই নিবন্ধন <i
                                class="bi bi-chevron-right"></i></a>
                        <a href="#faq" class="btn btn-outline-secondary btn-lg px-4 px-lg-5">বিস্তারিত দেখুন</a>
                    </div>
                    <div class="hero-stats d-inline-flex mt-5 gap-3 gap-lg-4">
                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">১০,০০০+</span>
                            <span class="small text-secondary">নিবন্ধিত শিক্ষার্থী</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">৫০০+</span>
                            <span class="small text-secondary">স্কলারশিপ প্রাপ্ত শিক্ষার্থী</span>
                        </div>
                        
                        <div class="d-flex flex-column align-items-center">
                            <span class="fs-3 fw-bold">৫০+</span>
                            <span class="small text-secondary">সংবর্ধনা অনুষ্ঠান</span>
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
                    “শিক্ষাই মূল চাবিকাঠি। প্রতিটি ঘরের মেধাবী সন্তান যেন তার স্বপ্নের পথে অগ্রসর হতে পারে—
                    <img src="{{ asset('images/no1-logo.png') }}" alt="brand" height="30" class="mx-2">
                    এর এই উদ্যোগ সেই লক্ষ্যেই এগিয়ে যায়। আমরা গর্বিত তোমাদের সাফল্যে। এই উদ্যোগ তোমাদের জন্য নতুন দিগন্ত
                    উন্মোচন করবে। 
                    সবার জন্য শুভকামনা রইল!”
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
                <p class="text-secondary px-2">জিপিএ-৫ প্রাপ্ত প্রতিটি শিক্ষার্থী পেলেই অনন্য সুযোগ — আর্থিক বৃত্তি, আন্তর্জাতিক মাপকাঠির সার্টিফিকেট ও এক্সক্লুসিভ মেন্টরশিপ।</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-12 col-lg-7">
                    <div class="card-premium h-100 p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(79,70,229,0.06), rgba(124,58,237,0.03));">
                        {{-- <div class="ribbon">স্কলারশিপ</div> --}}
                        <div class="d-flex gap-3 align-items-start">
                            <div class="me-3 d-none d-md-block">
                                <div class="fancy-icon-wrapper bg-gradient-primary text-white d-flex align-items-center justify-content-center">
                                    <i class="bi bi-award fs-1 text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="fw-bold">জিপিএ-৫ প্রাপ্ত শিক্ষার্থীদের জন্য সম্পূর্ণ প্যাকেজ</h3>
                                <p class="text-dark-emphasis">স্কলারশিপের মাধ্যমে শিক্ষার্থীদের পড়াশোনার ব্যয় হ্রাস করা হবে। এছাড়া ডিজিটাল স্কিল ও ক্যারিয়ার মেন্টরশিপ প্রদান করা হবে যাতে তারা ভবিষ্যতে স্বনির্ভর হয়ে উঠতে পারে।</p>
                                <ul class="list-unstyled mt-3 mb-0">
                                    <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i>আর্থিক মেধা বৃত্তি</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i>প্রিমিয়াম সার্টিফিকেট (ডিজিটাল + প্রিন্ট)</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle text-primary me-2"></i>টপ-মেন্টরদের থেকে গাইডেন্স ও ক্যারিয়ার সাপোর্ট</li>
                                </ul>
                                <div class="mt-4">
                                    <a href="#eligibility" class="btn btn-primary me-2">যোগ্যতা দেখুন</a>
                                    <a href="#" class="btn btn-outline-secondary">আরও জানুন</a>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute" style="right: -60px; bottom: -30px; opacity:0.12; transform: rotate(-20deg);">
                            <img src="{{ asset('images/no1-logo.png') }}" alt="logo" height="220">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-success text-white">
                                        <i class="bi bi-patch-check fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">সার্টিফিকেট</h5>
                                        <p class="small text-secondary mb-0">আন্তর্জাতিক মানের ডিজিটাল ও প্রিন্ট সার্টিফিকেট</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-warning text-white">
                                        <i class="bi bi-gear-wide-connected fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">ডিজিটাল টুলস মাস্টারি</h5>
                                        <p class="small text-secondary mb-0">এক্সেল, কন্টেন্ট ক্রিয়েশন ও ফ্রিল্যান্সিং বেসিক</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="fancy-feature-card bg-white rounded-4 p-3 p-md-4 shadow-sm hover-lift h-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="fancy-icon-wrapper bg-gradient-info text-white">
                                        <i class="bi bi-people fs-3 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">ক্যারিয়ার বুটক্যাম্প</h5>
                                        <p class="small text-secondary mb-0">বিশেষ সেমিনার ও সরাসরি মেন্টরশিপ সেশন</p>
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
                        <div class="fancy-icon-wrapper bg-gradient-primary mx-auto mb-2 mb-md-3">
                            <i class="bi bi-award fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">আর্থিক সহায়তা</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">বৃত্তি ও ভাতা</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-success mx-auto mb-2 mb-md-3">
                            <i class="bi bi-award fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">সার্টিফিকেট</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">নাগরিক ও আন্তর্জাতিক</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-warning mx-auto mb-2 mb-md-3">
                            <i class="bi bi-star fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">মেন্টরশিপ</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">বিশেষ ওয়ার্কশপ</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fancy-feature-card text-center p-3 p-md-4 rounded-4 bg-white shadow-sm hover-lift">
                        <div class="fancy-icon-wrapper bg-gradient-info mx-auto mb-2 mb-md-3">
                            <i class="bi bi-book fs-1 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-0 mb-md-1 fs-6 fs-md-5">রিসোর্স</h5>
                        <p class="small text-secondary mb-0 d-none d-md-block">প্রিমিয়াম কোর্স ম্যাটেরিয়াল</p>
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
                        <div class="fancy-icon-wrapper bg-gradient-primary text-white d-flex align-items-center justify-content-center">
                            <i class="bi bi-shield-check fs-2 text-white"></i>
                        </div>
                        <h2 class="section-title mb-0 fs-3 fs-md-2">যোগ্যতা ও নিয়মাবলী</h2>
                    </div>
                    <div class="mt-3 mt-md-4">
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="bi bi-check-circle-fill text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="bi bi-check2-circle text-primary fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">২০২৬ সালের এসএসসি/সমমান</strong><br><span
                                    class="text-secondary small">পরীক্ষায় উত্তীর্ণ নিয়মিত শিক্ষার্থীরা আবেদন করতে
                                    পারবেন।</span></div>
                        </div>
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="bi bi-check-circle-fill text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="bi bi-check2-circle text-primary fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">জেএসসি ও এসএসসি উভয় স্তরের ফলাফল</strong><br><span
                                    class="text-secondary small">মেধা তালিকা তৈরি হবে মোট নম্বরের ভিত্তিতে। জিপিএ-৫
                                    বাধ্যতামূলক।</span></div>
                        </div>
                        <div class="d-flex gap-3 mb-3 mb-md-4 pb-2 border-bottom">
                            {{-- <i class="bi bi-check-circle-fill text-primary fs-6 fs-md-5 mt-1"></i> --}}
                            <i class="bi bi-check2-circle text-primary fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">সঠিক তথ্য প্রদান আবশ্যক</strong><br><span
                                    class="text-secondary small">অনলাইন ফরমে তথ্যের অমিল পাওয়া গেলে আবেদন বাতিল
                                    হবে।</span></div>
                        </div>
                        <div class="d-flex gap-3">
                            <i class="bi bi-check2-circle text-primary fs-6 fs-md-5 mt-1"></i>
                            <div><strong class="fs-6 fs-md-5">কোটা সুবিধা প্রাপ্তি</strong><br><span
                                    class="text-secondary small">উপযুক্ত প্রমাণপত্র সাবমিট করতে হবে।</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="bg-gradient-special rounded-4 p-4 p-md-5 h-100 d-flex flex-column justify-content-between"
                    style="background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);">
                    <div class="d-flex justify-content-between align-items-start mb-3 mb-md-4">
                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill small">লিমিটেড আসন</span>
                        <i class="bi bi-megaphone fs-2 fs-md-1 text-dark opacity-50"></i>
                    </div>
                    <h3 class="fw-bold fs-2 fs-md-1 text-dark">বিশেষ মেগা সেমিনার ২০২৬</h3>
                    <p class="fs-6 fs-md-5 text-dark-emphasis mt-2 mt-md-3">অনলাইন নিবন্ধনকারী প্রতিটি শিক্ষার্থী <strong
                            class="text-primary">সেন্ট্রাল ক্যারিয়ার ওরিয়েন্টেশন ইভেন্টে</strong> আমন্ত্রিত। সেরা
                        মেন্টরদের সাথে সরাসরি মতবিনিময়।</p>
                    <div class="mt-3 mt-md-4">
                        <button class="btn btn-dark btn-md btn-lg rounded-pill px-4 px-md-5 shadow-sm w-100 w-md-auto">আসন
                            নিশ্চিত করুন <i class="bi bi-arrow-right ms-2"></i></button>
                    </div>
                    <div class="mt-3 mt-md-4 small text-dark-emphasis">
                        <i class="bi bi-calendar-check"></i> তারিখ: ১০ মে, ২০২৬ | স্থান: ঢাকা ও চট্টগ্রাম
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
                    <i class="bi bi-calendar-event text-primary"></i>
                    <span class="fw-semibold small">গুরুত্বপূর্ণ তারিখসমূহ</span>
                </div>
                <h2 class="display-6 display-md-5 fw-bold text-dark">প্রধান সময়সূচি</h2>
                <p class="text-secondary fs-6 fs-md-5 px-2">২০২৬ সালের গুরুত্বপূর্ণ মাইলফলক</p>
            </div>
            <div class="row g-3 g-md-5 justify-content-center">
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-warning shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">01</div>
                        <div class="timeline-icon mb-2 mb-md-3">
                            <i class="bi bi-calendar-plus fs-2 fs-md-1 text-warning"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">নিবন্ধন শুরু</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">১ জানু</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-primary shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">02</div>
                        <div class="timeline-icon mb-2 mb-md-3">
                            <i class="bi bi-calendar-x fs-2 fs-md-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">নিবন্ধন শেষ</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">১৫ মার্চ</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-success shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">03</div>
                        <div class="timeline-icon mb-2 mb-md-3">
                            <i class="bi bi-trophy fs-2 fs-md-1 text-success"></i>
                        </div>
                        <h5 class="fw-bold fs-6 fs-md-4">মেধা তালিকা</h5>
                        <p class="fs-5 fs-md-4 fw-bold text-dark mb-0">এপ্রিল</p>
                        <p class="text-secondary small mb-0">২০২৬</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div
                        class="timeline-card-modern text-center p-3 p-md-4 rounded-4 bg-white border-bottom border-4 border-danger shadow-sm h-100">
                        <div class="timeline-number mb-2 d-none d-md-block">04</div>
                        <div class="timeline-icon mb-2 mb-md-3">
                            <i class="bi bi-people fs-2 fs-md-1 text-danger"></i>
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
                <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="jg-EvmKaqTQ">
                    <img src="{{ asset('images/success-story-1.jpg') }}" alt="success story 1" class="w-100"
                        style="height: 200px; object-fit: cover;">
                    <div class="play-btn-overlay"><i class="bi bi-play-fill text-white"></i></div>
                </div>
                <p class="mt-2 mt-md-3 fw-bold text-center fs-6 fs-md-5 px-2">“এই উদ্যোগ আমাকে এআই শেখার সুযোগ করে দিয়েছে”
                    <br class="d-none d-md-block">— রাইসা, চাঁপাইনবাবগঞ্জ
                </p>
            </div>
            <div class="col-12 col-md-6">
                <div class="video-thumb rounded-4 overflow-hidden shadow-lg" data-video-id="dQw4w9WgXcQ">
                    <img src="{{ asset('images/success-story-1.jpg') }}" alt="success story 2" class="w-100"
                        style="height: 200px; object-fit: cover;">
                    <div class="play-btn-overlay"><i class="bi bi-play-fill"></i></div>
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
                    <div class="video-thumb rounded-4 overflow-hidden" data-video-id="SxR6m7kqP9M">
                        <img src="https://ncdn.ntvbd.com/sites/default/files/styles/big_3/public/images/2024/06/05/mgi.jpg"
                            class="w-100" style="height: 180px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="bi bi-play-fill"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">ঢাকা বিভাগীয় সংবর্ধনা ২০২৫</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="video-thumb rounded-4 overflow-hidden" data-video-id="jg-EvmKaqTQ">
                        <img src="https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp"
                            class="w-100" style="height: 180px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="bi bi-play-fill"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">চট্টগ্রাম সিটি কর্পোরেশন অনুষ্ঠান</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="video-thumb rounded-4 overflow-hidden" data-video-id="dQw4w9WgXcQ">
                        <img src="{{ asset('images/success-story-1.jpg') }}" alt="khulna-rajshahi reception"
                            class="w-100" style="height: 180px; object-fit: cover;">
                        <div class="play-btn-overlay"><i class="bi bi-play-fill"></i></div>
                    </div>
                    <p class="text-center mt-2 small fw-semibold">রাজশাহী ও খুলনা অঞ্চলের আয়োজন</p>
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
                <button class="tab-btn" data-cat="dhaka">ঢাকা ভেন্যু</button>
                <button class="tab-btn" data-cat="chattogram">চট্টগ্রাম ভেন্যু</button>
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
                                    data-bs-toggle="collapse" data-bs-target="#faq1">অনলাইন নিবন্ধনের শেষ সময়
                                    কখন?</button></h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small">১৫ মার্চ ২০২৬ পর্যন্ত নিবন্ধন চলবে। এর পরে
                                    কোনো সুযোগ থাকবে না।</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-2 mb-md-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">ফ্রি কোর্স কিভাবে পাব?</button></h2>
                            <div id="faq2" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">নিবন্ধনের ২৪ ঘণ্টার মধ্যে আপনার ইমেইল ও
                                    মোবাইল নম্বরে কোর্স অ্যাক্সেস লিংক পাঠিয়ে দেওয়া হবে।</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header"><button
                                    class="accordion-button collapsed rounded-4 fw-semibold small fs-6 fs-md-5 py-3"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">মেধা তালিকায় স্থান পাওয়ার
                                    নিয়ম?</button></h2>
                            <div id="faq3" class="accordion-collapse collapse">
                                <div class="accordion-body text-secondary small">জেএসসি ও এসএসসি মোট নম্বরের ভিত্তিতে
                                    মেধাক্রম নির্ধারণ করা হবে। জিপিএ-৫ থাকা আবশ্যক।</div>
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
            style="background: linear-gradient(120deg, #EFF6FF 0%, #FFFFFF 100%);">
            <div class="row align-items-center g-3 g-md-4">
                <div class="col-12 col-md-8">
                    <h3 class="fw-bold fs-3 fs-md-2">আপনার প্রশ্ন আছে?</h3>
                    <p class="fs-6 fs-md-5 text-secondary mb-2 mb-md-3">আমাদের সাপোর্ট টিম ২৪/৭ নিয়োজিত আছে আপনার যেকোনো
                        সমস্যার সমাধানে।</p>
                    <div
                        class="d-flex flex-wrap gap-3 gap-md-4 mt-2 mt-md-3 justify-content-center justify-content-md-start">
                        <div class="small"><i class="bi bi-telephone-fill text-primary me-2"></i>
                            <strong>০১৯৮৮-৭৬৫৪৩২</strong>
                        </div>
                        <div class="small"><i class="bi bi-envelope-fill text-primary me-2"></i>
                            <strong>support@babarkritisontan.com</strong>
                        </div>
                        <div class="small"><i class="bi bi-whatsapp text-success me-2"></i> <strong>০১৭XX-XXXXXX</strong>
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

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-black border-0 rounded-4">
                <div class="modal-body p-0 position-relative" style="padding-top: 56.25%;">
                    <div id="videoFrame" style="position:absolute; top:0; left:0; width:100%; height:100%;"></div>
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2 m-md-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>
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

        .fancy-feature-card:hover .fancy-icon-wrapper {
            transform: scale(1.08);
        }

        @media (min-width: 768px) {
            .fancy-icon-wrapper {
                width: 70px;
                height: 70px;
            }
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #5f1727, #f02367);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #10B981, #037c56);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #F59E0B, #b46307);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #06B6D4, #06667e);
        }

        /* Timeline Card */
        .timeline-card-modern {
            position: relative;
            transition: all 0.3s ease;
        }

        .timeline-card-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
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
        function playVideo(videoId) {
            const container = document.getElementById('videoFrame');
            container.innerHTML =
                `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="width:100%;height:100%;position:absolute;top:0;left:0"></iframe>`;
            new bootstrap.Modal(document.getElementById('videoModal')).show();
        }

        document.querySelectorAll('.video-thumb, .video-play-btn').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                let videoId = el.getAttribute('data-video-id');
                if (!videoId && el.closest('[data-video-id]')) videoId = el.closest('[data-video-id]')
                    .getAttribute('data-video-id');
                if (videoId) playVideo(videoId);
            });
        });

        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('videoFrame').innerHTML = '';
        });

        const galleryData = {
            all: [
                "https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800",
                "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800",
                "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800",
                "https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800"
            ],
            dhaka: [
                "https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800",
                "https://images.unsplash.com/photo-1541336032412-2048a678540d?w=800",
                "https://ncdn.ntvbd.com/sites/default/files/styles/big_3/public/images/2024/06/05/mgi.jpg"
            ],
            chattogram: [
                "https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp",
                "https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800",
                "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800"
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

        renderGallery();
    </script>
@endpush
