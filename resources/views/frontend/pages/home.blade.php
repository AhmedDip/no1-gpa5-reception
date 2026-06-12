{{-- frontend/pages/home.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা ২০২৬')

@section('content')
<!-- Hero Section / Campaign Overview -->
<section id="overview" class="hero">
    <div class="floating-shapes">
        <div class="shape" style="top: 10%; left: 5%; width: 100px; height: 100px; background: var(--primary); border-radius: 50%;"></div>
        <div class="shape" style="bottom: 15%; right: 8%; width: 150px; height: 150px; background: var(--secondary); border-radius: 60% 40% 30% 70%;"></div>
        <div class="shape" style="top: 40%; right: 20%; width: 80px; height: 80px; background: var(--accent); border-radius: 40% 60% 70% 30%;"></div>
    </div>
    <div class="container">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="bi bi-star-fill me-1"></i> এসএসসি ২০২৬
                    </span>
                    <h1>মেধাবী সন্তানদের <br>অভিনন্দন ও সংবর্ধনা</h1>
                    <p class="lead text-muted mb-4">নাম্বার ওয়ান ব্র্যান্ডের উদ্যোগে চায়ের দোকানের মেধাবী সন্তানদের জন্য বিশেষ বৃত্তি ও সংবর্ধনা অনুষ্ঠান ২০২৬।</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="" class="btn btn-gradient btn-lg">
                            <i class="bi bi-pencil-square me-2"></i> নিবন্ধন করুন
                        </a>
                        <a href="#timeline" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-calendar-event me-2"></i> সময়সূচী দেখুন
                        </a>
                    </div>
                    <div class="mt-5 d-flex gap-4">
                        <div>
                            <h3 class="fw-bold text-primary mb-0">১০০০+</h3>
                            <small class="text-muted">বৃত্তি প্রদান</small>
                        </div>
                        <div>
                            <h3 class="fw-bold text-primary mb-0">৬৪</h3>
                            <small class="text-muted">জেলায় আয়োজন</small>
                        </div>
                        <div>
                            <h3 class="fw-bold text-primary mb-0">৫০০০+</h3>
                            <small class="text-muted">নিবন্ধন</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <div class="position-relative">
                    <div class="animate-float">
                        <img src="{{ asset('images/hero-image.png') }}" alt="Hero" class="img-fluid rounded-4 shadow-lg">
                    </div>
                    <div class="glass-card position-absolute bottom-0 start-0 translate-middle-y p-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-trophy-fill text-warning fs-4"></i>
                            <div>
                                <small class="text-muted d-block">জিপিএ-৫ অর্জনকারী</small>
                                <strong>হচ্ছেন সম্মানিত</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Message from No.1 Brand -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up">
                <i class="bi bi-chat-quote-fill display-1 text-primary opacity-25"></i>
                <p class="fs-3 fst-italic text-muted mt-3">"প্রতিটি মেধাবী সন্তানের স্বপ্নপূরণে নাম্বার ওয়ান ব্র্যান্ড সদা প্রস্তুত। শিক্ষা ও সংবর্ধনার মাধ্যমে আমরা গড়তে চাই উন্নত আগামী।"</p>
                <hr class="w-25 mx-auto my-4">
                <h5 class="fw-bold">মোঃ করিম উদ্দিন</h5>
                <p class="text-muted">ব্যবস্থাপনা পরিচালক, নাম্বার ওয়ান গ্রুপ</p>
            </div>
        </div>
    </div>
</section>

<!-- Scholarship & Felicitation Details -->
<section class="py-5">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">বৃত্তি ও সংবর্ধনা বিবরণী</h2>
            <p class="section-subtitle">মেধাবী শিক্ষার্থীদের জন্য বিশেষ আয়োজন ও প্রণোদনা</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="premium-card text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-trophy fs-1 text-primary"></i>
                    </div>
                    <h4 class="fw-bold">মেধা বৃত্তি</h4>
                    <p class="text-muted">জিপিএ-৫ প্রাপ্ত শিক্ষার্থীদের মধ্যে মেধা ক্রম অনুযায়ী নগদ বৃত্তি ও ক্রেস্ট প্রদান</p>
                    <h3 class="text-primary fw-bold">৫০,০০০ টাকা</h3>
                    <small class="text-muted">সর্বোচ্চ বৃত্তির পরিমাণ</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="premium-card text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-laptop fs-1 text-success"></i>
                    </div>
                    <h4 class="fw-bold">আইটি স্পেশালাইজেশন</h4>
                    <p class="text-muted">ফ্রি প্রিমিয়াম আইটি কোর্স ও সার্টিফিকেশন</p>
                    <h3 class="text-success fw-bold">৫টি কোর্স</h3>
                    <small class="text-muted">আর্টিফিশিয়াল ইন্টেলিজেন্স, ওয়েব ডেভেলপমেন্ট সহ</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="premium-card text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-people fs-1 text-warning"></i>
                    </div>
                    <h4 class="fw-bold">সম্মাননা ক্রেস্ট</h4>
                    <p class="text-muted">বিশেষ সংবর্ধনা অনুষ্ঠানে ক্রেস্ট ও সনদ প্রদান</p>
                    <h3 class="text-warning fw-bold">সকল জিপিএ-৫</h3>
                    <small class="text-muted">প্রাপ্তদের জন্য সম্মাননা</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Eligibility Criteria -->
<section id="eligibility" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('images/eligibility.png') }}" alt="Eligibility" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title mb-4">আবেদনের যোগ্যতা</h2>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded-circle p-2">
                            <i class="bi bi-check-lg text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="fw-bold">শিক্ষাগত যোগ্যতা</h6>
                        <p class="text-muted">২০২৬ সালের এসএসসি/সমমান পরীক্ষায় উত্তীর্ণ নিয়মিত শিক্ষার্থী</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded-circle p-2">
                            <i class="bi bi-check-lg text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="fw-bold">মেধার ভিত্তি</h6>
                        <p class="text-muted">জেএসসি ও এসএসসি উভয় স্তরের ফলাফলের ভিত্তিতে মেধা তালিকা তৈরি</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded-circle p-2">
                            <i class="bi bi-check-lg text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="fw-bold">সত্যতা যাচাই</h6>
                        <p class="text-muted">অনলাইন আবেদনে সকল তথ্যের সত্যতা নিশ্চিত করতে হবে। ভুল তথ্য দিলে আবেদন বাতিলযোগ্য।</p>
                    </div>
                </div>
                <a href="" class="btn btn-gradient mt-3">নিবন্ধন করুন <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Timeline -->
<section id="timeline" class="py-5">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">কার্যক্রমের সময়সূচী</h2>
            <p class="section-subtitle">মুখ্য আয়োজনগুলোর তারিখ ও সময়সীমা</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-icon"><i class="bi bi-calendar"></i></div>
                    <div class="premium-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="fw-bold">অনলাইন নিবন্ধন শুরু</h5>
                                <p class="text-muted mb-0">সকল যোগ্য শিক্ষার্থী নিবন্ধন করতে পারবেন</p>
                            </div>
                            <span class="badge bg-primary px-3 py-2">০১ মার্চ ২০২৬</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="100">
                    <div class="timeline-icon"><i class="bi bi-hourglass-split"></i></div>
                    <div class="premium-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="fw-bold">নিবন্ধনের শেষ সময়</h5>
                                <p class="text-muted mb-0">দেরী করে নিবন্ধন গ্রহণ করা হবে না</p>
                            </div>
                            <span class="badge bg-primary px-3 py-2">৩১ মার্চ ২০২৬</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="200">
                    <div class="timeline-icon"><i class="bi bi-trophy"></i></div>
                    <div class="premium-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="fw-bold">মেধা তালিকা প্রকাশ</h5>
                                <p class="text-muted mb-0">ওয়েবসাইট ও এসএমএসের মাধ্যমে জানানো হবে</p>
                            </div>
                            <span class="badge bg-primary px-3 py-2">১৫ এপ্রিল ২০২৬</span>
                        </div>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="300">
                    <div class="timeline-icon"><i class="bi bi-gift"></i></div>
                    <div class="premium-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="fw-bold">সংবর্ধনা ও বৃত্তি প্রদান</h5>
                                <p class="text-muted mb-0">রাজধানী ও বিভাগীয় শহরে অনুষ্ঠিত হবে</p>
                            </div>
                            <span class="badge bg-primary px-3 py-2">০১-১০ মে ২০২৬</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories -->
<section id="stories" class="py-5 bg-light">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">সাফল্যের গল্প</h2>
            <p class="section-subtitle">পূর্ববর্তী বর্ষের মেধাবী শিক্ষার্থীদের সাফল্যের কাহিনী</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="story-card">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=300&fit=crop" alt="Student" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-quote text-primary fs-1"></i>
                        </div>
                        <p class="text-muted">নাম্বার ওয়ানের সংবর্ধনা আমার জীবন বদলে দিয়েছে। আজ আমি বুয়েটে পড়ছি এবং একটি আইটি ফার্মে ইন্টার্ন করছি।</p>
                        <h6 class="fw-bold mb-0">রুবিনা আক্তার</h6>
                        <small class="text-muted">বৃত্তিপ্রাপ্ত ২০২৪, জিপিএ-৫</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="story-card">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop" alt="Student" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-quote text-primary fs-1"></i>
                        </div>
                        <p class="text-muted">বাবার চায়ের দোকানেই পড়ে স্বপ্ন দেখতাম বড় কিছু হবো। নাম্বার ওয়ান আমাকে সেই স্বপ্ন পূরণের পথ দেখিয়েছে।</p>
                        <h6 class="fw-bold mb-0">রকিবুল হাসান</h6>
                        <small class="text-muted">বৃত্তিপ্রাপ্ত ২০২৪, জিপিএ-৫</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="story-card">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=300&fit=crop" alt="Student" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-quote text-primary fs-1"></i>
                        </div>
                        <p class="text-muted">আইটি কোর্সের সুবাদে এখন আমি ফ্রিল্যান্সিং করে নিজের পড়ার খরচ চালাই। সংবর্ধনা অনুষ্ঠান ছিল জীবনের সেরা দিন।</p>
                        <h6 class="fw-bold mb-0">সাদিয়া ইসলাম</h6>
                        <small class="text-muted">বৃত্তিপ্রাপ্ত ২০২৫, জিপিএ-৫</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-5">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">সচরাচর জিজ্ঞাসা</h2>
            <p class="section-subtitle">আপনার মনে হতে পারে এমন কিছু প্রশ্নের উত্তর</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-4" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                নিবন্ধনের শেষ সময় কখন?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                অনলাইন নিবন্ধনের শেষ সময় ৩১ মার্চ ২০২৬। এর পর আর কোনো নিবন্ধন গ্রহণ করা হবে না। দেরি না করে দ্রুত নিবন্ধন সম্পন্ন করুন।
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                ফ্রি আইটি কোর্স কিভাবে পাবো?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                সফলভাবে নিবন্ধন শেষে আপনার রেজিস্টার্ড ইমেইলে ২৪ ঘণ্টার মধ্যে কোর্স অ্যাক্টিভেশন লিংক পাঠানো হবে। সেখান থেকে আপনি বিনামূল্যে কোর্সে অ্যাক্সেস পাবেন।
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                মেধা তালিকায় স্থান পাওয়ার নিয়ম কী?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                জেএসসি ও এসএসসি উভয় পরীক্ষার ফলাফলের ভিত্তিতে মেধা তালিকা তৈরি করা হবে। জিপিএ-৫ প্রাপ্তদের মধ্যে সর্বোচ্চ নম্বরের ভিত্তিতে স্থান নির্ধারণ করা হবে।
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 border-0 shadow-sm rounded-4" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                সংবর্ধনা অনুষ্ঠান কোথায় অনুষ্ঠিত হবে?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                সংবর্ধনা অনুষ্ঠান ঢাকা ও সকল বিভাগীয় শহরে অনুষ্ঠিত হবে। নির্দিষ্ট ভেন্যু ও তারিখ নিবন্ধন শেষে এসএমএসের মাধ্যমে জানিয়ে দেওয়া হবে।
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="contact-banner" data-aos="zoom-in">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">আপনার কোনো প্রশ্ন আছে?</h3>
                    <p class="mb-0">আমাদের হেল্পলাইন টিম ২৪/৭ সাপোর্টের জন্য প্রস্তুত। যেকোনো সমস্যায় যোগাযোগ করুন।</p>
                    <div class="d-flex gap-4 mt-4 flex-wrap">
                        <div><i class="bi bi-telephone-fill me-2"></i> হটলাইন: ১৬৩৪৫</div>
                        <div><i class="bi bi-envelope-fill me-2"></i> ইমেইল: support@babarkritisontan.com</div>
                        <div><i class="bi bi-whatsapp me-2"></i> হোয়াটসঅ্যাপ: ০১৯৯৯-৮৮৭৭৬৬</div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end text-center mt-4 mt-lg-0">
                    <a href="tel:16345" class="btn btn-light btn-lg px-4 rounded-pill">
                        <i class="bi bi-headset"></i> কল করুন
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
@endpush