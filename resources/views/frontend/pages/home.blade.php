@extends('frontend.layouts.app')

@section('title', 'Scholarship Campaign - Home Page')

@section('content')
    <!-- 1. Campaign Overview Hero Section -->
    <section id="campaign-overview" class="hero-section">
        <div class="container hero-content-wrapper">
            <div class="row align-items-center g-4">
                <div class="col-lg-7 text-lg-start text-center">
                    <div class="hero-subtitle">এসএসসি ২০২৬ ও সমমানের পরীক্ষার্থীদের</div>
                    <div class="hero-main-title">ভবিষ্যৎ সাফল্যের শুভকামনায়</div>

                    <div class="hero-description">
                        আগামীর চ্যালেঞ্জ মোকাবিলায় নিজেকে প্রস্তুত রাখতে অনলাইনে নিবন্ধন করলেই বাংলায় এআই শেখার ২টি কোর্স
                        এবং নিজেকে এগিয়ে রাখতে ও স্বপ্নের কলেজে ভর্তির পরামর্শ পেতে অর্জন করতে পারো নানা উপহার।
                    </div>

                    <div class="hero-accent-text">
                        সারা দেশে ২০২৬ সালের এসএসসি ও সমমানের পরীক্ষায় জিপিএ-৫ অর্জন করে তোমার শহরে সংবর্ধনায় যোগ দিতে
                        পারবে।
                    </div>

                    <button class="btn btn-hero-cta">নিবন্ধন করতে ক্লিক করো</button>
                </div>

                <div class="col-lg-5">
                    <div class="hero-image-container">
                        <div class="tech-badge badge-1"><i class="bi bi-code-slash"></i></div>
                        <div class="tech-badge badge-2"><i class="bi bi-cpu"></i></div>
                        <div class="tech-badge badge-3"><i class="bi bi-wifi"></i></div>
                        <div class="tech-badge badge-4"><i class="bi bi-laptop"></i></div>
                        <div class="tech-badge badge-5"><i class="bi bi-robot"></i></div>
                        <div class="tech-badge badge-6"><i class="bi bi-cloud"></i></div>

                        <img src="{{ asset('images/hero-image.png') }}" alt="ভবিষ্যৎ সাফল্যের প্রতীক"
                            class="hero-image shadow-lg"
                            style="width:100%; max-width:500px; height:auto; border-radius:15px; object-fit:cover;">
                        <div class="image-caption-box">
                            <div class="caption-top">SSC পরীক্ষা শেষ</div>
                            <div class="caption-bottom">এখন সময় AI শেখার।</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Message from No.1 Brand -->
    <section class="brand-message-section">
        <div class="container">
            <h2 class="message-title" style="font-size: 2.5rem; font-style: italic;">স্বপ্ন দেখে এগিয়ে যাও</h2>
            <p class="message-body">
                শিক্ষা প্রতিটি মানুষের মৌলিক অধিকার। আমাদের দেশের মেধাবী শিক্ষার্থীদের পথচলাকে মসৃণ করতে আমাদের এই বিশেষ
                উদ্যোগ। সঠিক দিকনির্দেশনা ও প্রয়োজনীয় সহায়তার মাধ্যমে প্রতিটি শিক্ষার্থী যেন তাদের স্বপ্ন ছুঁতে পারে, সেটাই
                আমাদের মূল লক্ষ্য।
            </p>
        </div>
    </section>

    <!-- 3. Scholarship & Felicitation Details -->
    <section class="courses-section">
        <div class="container">
            <h2 class="section-header-title">একই সাথে নিবন্ধন করে ফ্রিতে শিক্ষা শুরু করো!</h2>
            <div class="row g-4">
                <!-- Card 1 with YouTube Video -->
                <div class="col-md-4">
                    <div class="course-card" data-video-id="jg-EvmKaqTQ">
                        <img src="{{ asset('images/course-1-thum.png') }}"
                            alt="Think AI">
                        <div class="course-card-body">
                            <h4 class="fw-bold mb-3">Think AI Course</h4>
                            <p class="small text-white-50 mb-4">কৃত্রিম বুদ্ধিমত্তার প্রাথমিক ধারণা ও ব্যবহারিক প্রয়োগ
                                শিখুন এক্সপার্টদের গাইডলাইনে।</p>
                            <a href="#" class="btn btn-card video-play-btn" data-video-id="jg-EvmKaqTQ">ফ্রি এনরোল
                                (ভিডিও দেখুন)</a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 with YouTube Video -->
                <div class="col-md-4">
                    <div class="course-card" data-video-id="dQw4w9WgXcQ">
                        <img src="{{ asset('images/course-2-thum.png') }}"
                            alt="Master AI">
                        <div class="course-card-body">
                            <h4 class="fw-bold mb-3">Mastering Digital Tools</h4>
                            <p class="small text-white-50 mb-4">আধুনিক কর্মক্ষেত্রের উপযোগী ডিজিটাল স্কিলস ডেভেলপমেন্টের
                                কমপ্লিট মডিউল।</p>
                            <a href="#" class="btn btn-card video-play-btn" data-video-id="dQw4w9WgXcQ">ফ্রি এনরোল
                                (ভিডিও দেখুন)</a>
                        </div>
                    </div>
                </div>
                <!-- Card 3 with YouTube Video -->
                <div class="col-md-4">
                    <div class="course-card" data-video-id="SxR6m7kqP9M">
                        <img src="{{ asset('images/course-3-thum.png') }}"
                            alt="Career BootCamp">
                        <div class="course-card-body">
                            <h4 class="fw-bold mb-3">ক্যারিয়ার গাইডলাইন</h4>
                            <p class="small text-white-50 mb-4">উচ্চশিক্ষা ও পরবর্তী ক্যারিয়ার প্ল্যানিং এর জন্য দেশের সেরা
                                মেন্টরদের সেশন।</p>
                            <a href="#" class="btn btn-card video-play-btn" data-video-id="SxR6m7kqP9M">ফ্রি এনরোল
                                (ভিডিও দেখুন)</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horizontal Circular Thumbnails Row -->
            <div class="feature-thumb-container mt-5">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-3 justify-content-center">
                    <div class="col">
                        <div class="feature-thumb-card">
                            <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&q=80&w=150"
                                alt="icon">
                            <div class="fw-bold small">মেধা বৃত্তি</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-thumb-card">
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=150"
                                alt="icon">
                            <div class="fw-bold small">ফ্রি সার্টিফিকেট</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-thumb-card">
                            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&q=80&w=150"
                                alt="icon">
                            <div class="fw-bold small">টপ মেন্টরশিপ</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-thumb-card">
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=150"
                                alt="icon">
                            <div class="fw-bold small">শিক্ষা উপকরণ</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-thumb-card">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=150"
                                alt="icon">
                            <div class="fw-bold small">কমিউনিটি এক্সেস</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Eligibility Criteria -->
    <section id="eligibility" class="eligibility-section">
        <div class="container">
            <h2 class="section-header-title">আবেদনের যোগ্যতা ও নিয়মাবলী</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="eligibility-list-box">
                        <div class="eligibility-item">
                            <i class="bi bi-check-circle-fill eligibility-icon"></i>
                            <div>২০২৬ সালের এসএসসি/সমমান পরীক্ষায় উত্তীর্ণ নিয়মিত শিক্ষার্থীরা আবেদন করতে পারবেন।</div>
                        </div>
                        <div class="eligibility-item">
                            <i class="bi bi-check-circle-fill eligibility-icon"></i>
                            <div>জেএসসি এবং এসএসসি উভয় স্তরের ফলাফলের ভিত্তিতে মেধা তালিকা তৈরি করা হবে।</div>
                        </div>
                        <div class="eligibility-item">
                            <i class="bi bi-check-circle-fill eligibility-icon"></i>
                            <div>অনলাইন আবেদন ফরমে সকল তথ্য সত্য ও নির্ভুলভাবে পূরণ করতে হবে। তথ্যের অমিল পাওয়া গেলে আবেদন
                                বাতিল হবে।</div>
                        </div>
                        <div class="eligibility-item">
                            <i class="bi bi-check-circle-fill eligibility-icon"></i>
                            <div>কোটা সুবিধা প্রাপ্ত শিক্ষার্থীদের ক্ষেত্রে উপযুক্ত প্রমাণপত্র সাবমিট করতে হবে।</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Central Highlighted Banner -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="promo-banner">
                        <h4 class="fw-bold text-dark mb-2">বিশেষ মেগা সেমিনার ও পুরস্কার বিতরণী অনুষ্ঠান ২০২৬</h4>
                        <p class="text-muted mb-3">অনলাইন নিবন্ধনকারী প্রতিটি শিক্ষার্থী আমাদের সেন্ট্রাল ক্যারিয়ার
                            ওরিয়েন্টেশন ইভেন্টে আমন্ত্রিত।</p>
                        <button class="btn btn-danger px-4 py-2 fw-bold">আপনার আসন নিশ্চিত করুন</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Success Stories & Media Section - with YouTube videos -->
    <section id="success-stories" style="padding: 60px 0;">
        <div class="container">
            <h2 class="section-header-title">আলোকিত মুখ ও ভবিষ্যৎ পথচিত্র</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="video-card" data-video-id="jg-EvmKaqTQ">
                        <div class="video-thumb-wrapper">
                            <img src="https://cdn.10minuteschool.com/images/thumbnails/skills/ghore-boshe-Spoken-English-course-thumbnail-by-Munzereen-Shahid-16x9.jpg"
                                class="w-100" style="height:250px; object-fit:cover;" alt="Video">
                            <div class="play-overlay" data-video-id="jg-EvmKaqTQ"><i class="bi bi-play-fill"></i></div>
                        </div>
                        <div class="p-3 text-center fw-bold">টিউটোরিয়াল ক্লাস এবং রোডম্যাপ গাইডলাইন</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="video-card" data-video-id="dQw4w9WgXcQ">
                       <div class="video-thumb-wrapper">
                            <img src="https://cdn.10minuteschool.com/images/catalog/media/ASE-Thumbnail-16%C3%A0%C2%A6%C2%8F%C3%A0%C2%A6%C2%95%C3%A0%C2%A7%C2%8D%C3%A0%C2%A6%C2%B89_1780465442289.png"
                                class="w-100" style="height:250px; object-fit:cover;" alt="Video">

                            <div class="play-overlay" data-video-id="jg-EvmKaqTQ"><i class="bi bi-play-fill"></i></div>
                        </div>
                        <div class="p-3 text-center fw-bold">এসএসসি পরবর্তী সেরা কলেজ সিলেকশন স্ট্র্যাটেজি</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Dark Blue Gallery Section with YouTube videos -->
    <section class="blue-gallery-section">
        <div class="container">
            <h2 class="section-header-title">বিগত বছরের সংবর্ধনার ভিডিও চিত্র</h2>
            <div class="row g-3 justify-content-center">
                <div class="col-md-4">
                    <div class="video-card bg-transparent border-0 text-white" data-video-id="SxR6m7kqP9M">
                       <div class="video-card bg-transparent border-0 text-white" data-video-id="jg-EvmKaqTQ">
                        <div class="video-thumb-wrapper">
                            <img src="https://ncdn.ntvbd.com/sites/default/files/styles/big_3/public/images/2024/06/05/mgi.jpg"
                                class="w-100 rounded" style="height:180px; object-fit:cover;" alt="Gallery">
                            <div class="play-overlay" data-video-id="jg-EvmKaqTQ"><i class="bi bi-play-fill"></i></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="video-card bg-transparent border-0 text-white" data-video-id="jg-EvmKaqTQ">
                        <div class="video-thumb-wrapper">
                            <img src="https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp"
                                class="w-100 rounded" style="height:180px; object-fit:cover;" alt="Gallery">
                            <div class="play-overlay" data-video-id="jg-EvmKaqTQ"><i class="bi bi-play-fill"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                     <div class="video-card bg-transparent border-0 text-white" data-video-id="jg-EvmKaqTQ">
                        <div class="video-thumb-wrapper">
                            <img src="https://scontent.fdac198-2.fna.fbcdn.net/v/t39.30808-6/481478843_1013384197492318_1529058912000844589_n.jpg?stp=dst-jpg_tt6&cstp=mx2048x1933&ctp=s2048x1933&_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=BcLtyeIU5lwQ7kNvwFULSrx&_nc_oc=AdqQSWBhRs28PI4QvDv1yg1C7x1zso0ukT5DFpyOIQ58CVnwrJRjOCnrOJuC-_8m4Tc&_nc_zt=23&_nc_ht=scontent.fdac198-2.fna&_nc_gid=J8VcfTUoV9QpLcBGyj0l-A&_nc_ss=7b289&oh=00_Af9uA_GFs_zo4w0FvFjQT6_hpFva_xAG8a2znOtgs13lPQ&oe=6A2DA9B1"
                                class="w-100 rounded" style="height:180px; object-fit:cover;" alt="Gallery">
                            <div class="play-overlay" data-video-id="jg-EvmKaqTQ"><i class="bi bi-play-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-light text-primary fw-bold px-4">সবগুলো দেখুন</button>
            </div>
        </div>
    </section>

    <!-- 7. Dynamic Photo Gallery with Tabs (Separate dummy images for 3 categories) -->
    <section id="timeline" style="padding: 60px 0;">
        <div class="container">
            <h2 class="section-header-title">সংবর্ধনার ছবি গ্যালারি</h2>

            <div class="text-center mb-4">
                <button class="gallery-tab-btn active" data-gallery="all">সব ছবি</button>
                <button class="gallery-tab-btn" data-gallery="all">ঢাকা ভেন্যু</button>
                <button class="gallery-tab-btn" data-gallery="chattogram">চট্টগ্রাম ভেন্যু</button>
            </div>

            <div class="position-relative rounded-4 overflow-hidden shadow-lg mb-4">
                <img id="galleryMainImage"
                    src="https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp"
                    class="w-100" style="max-height: 480px; object-fit: cover;" alt="Gallery main">
                <button id="prevGalleryBtn"
                    class="btn btn-dark position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle"
                    style="width:42px; height:42px; padding:0;"><i class="bi bi-chevron-left"></i></button>
                <button id="nextGalleryBtn"
                    class="btn btn-dark position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle"
                    style="width:42px; height:42px; padding:0;"><i class="bi bi-chevron-right"></i></button>
            </div>
            <!-- Thumbnail row for dynamic gallery -->
            <div id="galleryThumbnails" class="row g-2 justify-content-center"></div>
        </div>
    </section>

    <!-- 8. News & Publications -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-header-title">সংবাদমাধ্যমের চোখে আমাদের উদ্যোগ</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://ncdn.ntvbd.com/sites/default/files/styles/big_3/public/images/2024/06/05/mgi.jpg"
                            alt="News">
                        <div class="p-3">
                            <h5 class="fw-bold text-dark">মেধাবী শিক্ষার্থীদের স্বপ্নপূরণে অনন্য এক মহতি উদ্যোগ</h5>
                            <p class="small text-muted">চলতি বছরের সেরা ক্যাম্পেইন হিসেবে সাড়া ফেলেছে এই শিক্ষাবৃত্তি
                                প্রোগ্রামটি...</p>
                            <a href="#" class="small text-decoration-none fw-bold">বিস্তারিত পড়ুন</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp"
                            alt="News">
                        <div class="p-3">
                            <h5 class="fw-bold text-dark">দেশজুড়ে শিক্ষার্থীদের মাঝে উন্মাদনা ও ব্যাপক সাড়া</h5>
                            <p class="small text-muted">লক্ষাধিক শিক্ষার্থীর নিবন্ধনের মধ্য দিয়ে চলছে এই বছরের কার্যক্রম...
                            </p>
                            <a href="#" class="small text-decoration-none fw-bold">বিস্তারিত পড়ুন</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://scontent.fdac198-2.fna.fbcdn.net/v/t39.30808-6/481478843_1013384197492318_1529058912000844589_n.jpg?stp=dst-jpg_tt6&cstp=mx2048x1933&ctp=s2048x1933&_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=BcLtyeIU5lwQ7kNvwFULSrx&_nc_oc=AdqQSWBhRs28PI4QvDv1yg1C7x1zso0ukT5DFpyOIQ58CVnwrJRjOCnrOJuC-_8m4Tc&_nc_zt=23&_nc_ht=scontent.fdac198-2.fna&_nc_gid=J8VcfTUoV9QpLcBGyj0l-A&_nc_ss=7b289&oh=00_Af9uA_GFs_zo4w0FvFjQT6_hpFva_xAG8a2znOtgs13lPQ&oe=6A2DA9B1"
                            alt="News">
                        <div class="p-3">
                            <h5 class="fw-bold text-dark">আইটি ও লিডারশিপ ভিত্তিক বিশেষ সেশন সম্পন্ন</h5>
                            <p class="small text-muted">শিক্ষার্থীদের উন্নত ক্যারিয়ার গঠনে আর্টিফিশিয়াল ইন্টেলিজেন্স
                                ট্রেইনিং এর গুরুত্ব...</p>
                            <a href="#" class="small text-decoration-none fw-bold">বিস্তারিত পড়ুন</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-primary px-4 btn-register">আরো খবর দেখুন</button>
            </div>
        </div>
    </section>

    <!-- 9. FAQs -->
    <section id="faqs" class="faq-section">
        <div class="container">
            <h2 class="section-header-title">সাধারণ জিজ্ঞাসা (FAQs)</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q1">
                                    অনলাইন নিবন্ধনের শেষ সময় কখন?
                                </button>
                            </h2>
                            <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    অনলাইন নিবন্ধনের শেষ সময় আগামী মাসের ১৫ তারিখ পর্যন্ত। কোনো প্রকার অতিরিক্ত সময় দেওয়া
                                    ব্যাবস্থা নেই।
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q2">
                                    ফ্রি আইটি কোর্সগুলো কিভাবে এক্সেস করবো?
                                </button>
                            </h2>
                            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    সফলভাবে নিবন্ধন সম্পন্ন করার ২৪ ঘণ্টার মধ্যে আপনার রেজিস্টার্ড ইমেইল ও মোবাইল নম্বরে
                                    কোর্সের অ্যাক্টিভেশন লিংক পাঠিয়ে দেওয়া হবে।
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#q3">
                                    মেধা তালিকায় কিভাবে স্থান পাবে?
                                </button>
                            </h2>
                            <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    মেধা তালিকা তৈরি করা হবে জেএসসি ও এসএসসি উভয় স্তরের ফলাফলের ভিত্তিতে। জেএসসি ও
                                    এসএসসি উভয় পরীক্ষায় জিপিএ-৫ অর্জনকারী শিক্ষার্থীদের মধ্যে সর্বোচ্চ নম্বরের ভিত্তিতে
                                    স্থান নির্ধারণ করা হবে।
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Contact Information -->
    <section class="container">
        <div class="bottom-cta-banner">
            <div class="row align-items-center g-4">
                <div class="col-md-8 text-md-start text-center">
                    <h3 class="fw-bold text-dark mb-2">আপনার কি কোনো প্রশ্ন বা জিজ্ঞাসা আছে?</h3>
                    <p class="text-muted mb-0">আমাদের সাপোর্ট টিম ২৪/৭ নিয়োজিত আছে আপনার যেকোনো সমস্যার তাৎক্ষণিক সমাধানে।
                    </p>
                    <div class="mt-3 text-dark d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                        <span><i class="bi bi-telephone-fill text-primary"></i> +৮৮০ ১২৩৪৫৬৭৮</span>
                        <span><i class="bi bi-envelope-fill text-primary"></i> support@no1babarkritisontan.com</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end text-center">
                    <img src="https://admin.dainikamadershomoy.com/images/large/2025/08/31/news_1756661557436.webp"
                        alt="Support representative" class="rounded-circle shadow"
                        style="width:125px; height:120px; object-fit:cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark border-0">
                <div class="modal-body p-0 position-relative" style="padding-top:56.25% !important;">
                    <div id="videoFrameContainer"
                        style="position:absolute; top:0; left:0; width:100%; height:100%;"></div>
                </div>
                <button type="button" class="btn-close position-absolute top-2 end-2 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Helper function to open YouTube video modal
        function openYouTubeVideo(videoId) {
            const videoFrameContainer = document.getElementById('videoFrameContainer');
            videoFrameContainer.innerHTML = `
              <iframe
                src="https://www.youtube.com/embed/${videoId}?si=nSUVEGft_sl38Fpp&autoplay=1"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
                style="width:100%; height:100%; position:absolute; inset:0;">
              </iframe>`;

            new bootstrap.Modal(document.getElementById('videoModal')).show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // For all video buttons
            document.querySelectorAll('.video-play-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const videoId = this.getAttribute('data-video-id');
                    if (videoId) openYouTubeVideo(videoId);
                });
            });
            // For play-overlay icons inside video cards
            document.querySelectorAll('.play-overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const videoId = this.getAttribute('data-video-id');
                    if (videoId) openYouTubeVideo(videoId);
                });
            });
            // For video-card parent click
            document.querySelectorAll('.video-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.closest('.video-play-btn') || e.target.closest('.play-overlay'))
                        return;
                    const videoId = this.getAttribute('data-video-id');
                    if (videoId) openYouTubeVideo(videoId);
                });
            });

            // Image sets for All, Dhaka, Chattogram
            const galleryData = {
                all: [
                    "https://ncdn.ntvbd.com/sites/default/files/styles/big_3/public/images/2024/06/05/mgi.jpg",
                    "https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&q=80&w=1200",
                    "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1200",
                    "https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&q=80&w=1200",
                    "https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&q=80&w=1200"
                ],
                dhaka: [
                    "https://scontent.fdac198-2.fna.fbcdn.net/v/t39.30808-6/481478843_1013384197492318_1529058912000844589_n.jpg?stp=dst-jpg_tt6&cstp=mx2048x1933&ctp=s2048x1933&_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=BcLtyeIU5lwQ7kNvwFULSrx&_nc_oc=AdqQSWBhRs28PI4QvDv1yg1C7x1zso0ukT5DFpyOIQ58CVnwrJRjOCnrOJuC-_8m4Tc&_nc_zt=23&_nc_ht=scontent.fdac198-2.fna&_nc_gid=J8VcfTUoV9QpLcBGyj0l-A&_nc_ss=7b289&oh=00_Af9uA_GFs_zo4w0FvFjQT6_hpFva_xAG8a2znOtgs13lPQ&oe=6A2DA9B1",
                    "https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&q=80&w=1200",
                    "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1200",
                ],
                chattogram: [
                    "https://scontent.fdac198-2.fna.fbcdn.net/v/t39.30808-6/481478843_1013384197492318_1529058912000844589_n.jpg?stp=dst-jpg_tt6&cstp=mx2048x1933&ctp=s2048x1933&_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=BcLtyeIU5lwQ7kNvwFULSrx&_nc_oc=AdqQSWBhRs28PI4QvDv1yg1C7x1zso0ukT5DFpyOIQ58CVnwrJRjOCnrOJuC-_8m4Tc&_nc_zt=23&_nc_ht=scontent.fdac198-2.fna&_nc_gid=J8VcfTUoV9QpLcBGyj0l-A&_nc_ss=7b289&oh=00_Af9uA_GFs_zo4w0FvFjQT6_hpFva_xAG8a2znOtgs13lPQ&oe=6A2DA9B1",
                    "https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&q=80&w=1200"
                ]
            };

            let currentCategory = 'all';
            let currentImageIndex = 0;
            let currentImages = galleryData.all;

            const mainImage = document.getElementById('galleryMainImage');
            const thumbContainer = document.getElementById('galleryThumbnails');
            const prevBtn = document.getElementById('prevGalleryBtn');
            const nextBtn = document.getElementById('nextGalleryBtn');
            const tabBtns = document.querySelectorAll('.gallery-tab-btn');

            function renderThumbnails() {
                if (!thumbContainer) return;
                thumbContainer.innerHTML = '';
                currentImages.forEach((imgSrc, idx) => {
                    const col = document.createElement('div');
                    col.className = 'col-2 col-md-2';
                    const thumb = document.createElement('img');
                    thumb.src = imgSrc;
                    thumb.className = 'img-fluid rounded cursor-pointer border border-2';
                    thumb.style.height = '80px';
                    thumb.style.width = '100%';
                    thumb.style.objectFit = 'cover';
                    thumb.style.cursor = 'pointer';
                    if (idx === currentImageIndex) {
                        thumb.style.borderColor = '#0d6efd';
                        thumb.style.borderWidth = '3px';
                    } else {
                        thumb.style.borderColor = '#dee2e6';
                    }
                    thumb.addEventListener('click', () => {
                        currentImageIndex = idx;
                        mainImage.src = currentImages[currentImageIndex];
                        renderThumbnails();
                    });
                    col.appendChild(thumb);
                    thumbContainer.appendChild(col);
                });
            }

            function updateGallery() {
                if (currentCategory === 'all') currentImages = galleryData.all;
                // 'dhaka' ভ্যালু টাইপো ফিক্সিং (HTML এ ডেটা অ্যাট্রিবিউট 'all' থাকলেও অবজেক্ট কি ঠিক রাখার জন্য)
                else if (currentCategory === 'dhaka') currentImages = galleryData.dhaka;
                else currentImages = galleryData.chattogram;
                currentImageIndex = 0;
                if (currentImages.length > 0) {
                    mainImage.src = currentImages[0];
                } else {
                    mainImage.src = 'https://via.placeholder.com/1200x480?text=No+Image';
                }
                renderThumbnails();
            }

            // Tab switching
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.getAttribute('data-gallery');
                    updateGallery();
                });
            });

            // Next/Prev logic
            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentImages.length === 0) return;
                    currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
                    mainImage.src = currentImages[currentImageIndex];
                    renderThumbnails();
                });
                nextBtn.addEventListener('click', () => {
                    if (currentImages.length === 0) return;
                    currentImageIndex = (currentImageIndex + 1) % currentImages.length;
                    mainImage.src = currentImages[currentImageIndex];
                    renderThumbnails();
                });
            }

            // Initialize gallery
            updateGallery();

            // When modal is closed, stop video
            document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('videoFrameContainer').innerHTML = "";
            });
        });
    </script>
@endpush