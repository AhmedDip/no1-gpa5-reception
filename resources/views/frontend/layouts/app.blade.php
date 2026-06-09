<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Scholarship Campaign - Landing Page')</title>
    
    <!-- Google Fonts: Hind Siliguri for Bangla typography, Inter for UI elements -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    @stack('styles')
    
    <style>
        :root {
            --brand-blue: #4F6EF7;
            --brand-dark-blue: #1A2E76;
            --brand-bg-light: #F4F7FC;
            --brand-orange-red: #E64A19;
            --brand-yellow: #F6A61A;
            --text-dark: #222222;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* --- Header / Navbar --- */
        .navbar {
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background: #ffffff;
        }
        .nav-link {
            font-weight: 500;
            color: #444 !important;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--brand-blue) !important;
        }
        .btn-register {
            background-color: var(--brand-blue);
            color: white !important;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background-color: #3b56cb;
            transform: translateY(-2px);
        }
        .btn-login {
            border: 1px solid var(--brand-blue);
            color: var(--brand-blue) !important;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: var(--brand-blue);
            color: white !important;
        }

        /* --- Hero Section  --- */
        .hero-section {
            background: linear-gradient(90deg, #ffffff 0%, #fbf6ff 45%, #b19fed 75%, #804ecb 100%);
            padding: 70px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-content-wrapper {
            z-index: 2;
            position: relative;
        }
        .hero-subtitle {
            font-size: 2.2rem;
            font-weight: 700;
            color: #111111;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }
        .hero-main-title {
            font-size: 3.2rem;
            font-weight: 700;
            color: var(--brand-orange-red);
            margin-bottom: 25px;
        }
        .hero-description {
            font-size: 1.15rem;
            color: #2c3e50;
            line-height: 1.7;
            margin-bottom: 20px;
            max-width: 680px;
        }
        .hero-accent-text {
            font-size: 1.1rem;
            color: #34495e;
            font-weight: 500;
            margin-bottom: 35px;
            max-width: 680px;
        }
        .btn-hero-cta {
            background-color: var(--brand-blue);
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            padding: 12px 40px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 15px rgba(79, 110, 247, 0.4);
            transition: all 0.3s ease;
        }
        .btn-hero-cta:hover {
            background-color: #3b56cb;
            transform: translateY(-2px);
            color: white;
        }
        
        /* Right Side Image Graphics */
        .hero-image-container {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
      
        /* Tech Overlay Badges */
        .tech-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            z-index: 3;
            animation: floatEffect 4s ease-in-out infinite;
        }
        .badge-1 { top: 10%; left: 0%; animation-delay: 0s; }
        .badge-2 { top: -5%; right: 40%; animation-delay: 1s; }
        .badge-3 { bottom: 25%; left: -5%; animation-delay: 2s; }
        .badge-4 { bottom: -5%; right: 5%; animation-delay: 1.5s; }
        .badge-5 { top: 20%; right: -5%; animation-delay: 0.5s; }
        .badge-6 { bottom: -2%; left: 30%; animation-delay: 2.5s; }

        .image-caption-box {
            position: absolute;
            bottom: 30px;
            right: 20px;
            z-index: 4;
            text-align: right;
            color: white;
            text-shadow: 0 2px 8px rgba(0,0,0,0.8);
        }
        .caption-top {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .caption-bottom {
            font-size: 1.6rem;
            color: #FFE57F;
            font-weight: 700;
        }

        @keyframes floatEffect {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* --- Brand Message --- */
        .brand-message-section {
            padding: 60px 0;
            text-align: center;
        }
        .message-title {
            color: var(--brand-orange-red);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .message-body {
            font-size: 1.2rem;
            color: #444;
            max-width: 850px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* --- Course Cards Section --- */
        .courses-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .section-header-title {
            color: var(--brand-dark-blue);
            font-weight: 700;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 40px;
        }
        .course-card {
            background: #0B132B;
            border: 1px solid #1C2541;
            border-radius: 16px;
            overflow: hidden;
            color: white;
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .course-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .course-card:hover img {
            transform: scale(1.05);
        }
        .course-card-body {
            padding: 24px;
            text-align: center;
        }
        .btn-card {
            background-color: var(--brand-blue);
            color: white;
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-card:hover {
            background-color: #3b56cb;
            transform: translateY(-2px);
        }

        /* --- Round Thumbnails Grid --- */
        .feature-thumb-container {
            padding: 40px 0;
        }
        .feature-thumb-card {
            background: #FFF9E6;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            border: 1px solid #FFEAA7;
            height: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .feature-thumb-card:hover {
            background: #FFEAA7;
            transform: translateY(-5px);
        }
        .feature-thumb-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            border: 3px solid #ffffff;
        }

        /* --- Eligibility Section --- */
        .eligibility-section {
            background-color: var(--brand-bg-light);
            padding: 60px 0;
        }
        .eligibility-list-box {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.03);
        }
        .eligibility-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 1px solid #ECEFF5;
            padding-bottom: 15px;
        }
        .eligibility-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .eligibility-icon {
            color: var(--brand-blue);
            font-size: 1.4rem;
            margin-right: 18px;
            margin-top: 2px;
        }

        /* --- Centered Gold Highlight Banner --- */
        .promo-banner {
            background: linear-gradient(90deg, #FFF3E0 0%, #FFE0B2 100%);
            border: 1px solid #FFCC80;
            border-radius: 16px;
            padding: 45px;
            text-align: center;
            margin: 50px 0;
        }

        /* --- Video Modules --- */
        .video-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-bottom: 20px;
            position: relative;
            transition: transform 0.3s;
        }
        .video-card:hover {
            transform: translateY(-5px);
        }
        .video-thumb-wrapper {
            position: relative;
            cursor: pointer;
        }
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(230, 74, 25, 0.95);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .play-overlay:hover {
            transform: translate(-50%, -50%) scale(1.1);
        }
        .blue-gallery-section {
            background-color: #1E2D5F;
            color: white;
            padding: 60px 0;
        }
        .blue-gallery-section .section-header-title {
            color: white;
        }

        /* --- Success Stories Gallery Tabs --- */
        .gallery-tab-btn {
            background: #E8EBF5;
            color: #333;
            border: none;
            padding: 10px 24px;
            border-radius: 30px;
            margin: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .gallery-tab-btn.active {
            background: var(--brand-blue);
            color: white;
        }
        .gallery-tab-btn:hover {
            background: var(--brand-blue);
            color: white;
        }

        /* --- News Section --- */
        .news-section {
            background-color: var(--brand-bg-light);
            padding: 60px 0;
        }
        .news-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            height: 100%;
            transition: all 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* --- FAQ Accordion --- */
        .faq-section {
            padding: 60px 0;
        }
        .accordion-button:not(.collapsed) {
            background-color: var(--brand-blue);
            color: white;
        }

        /* --- Bottom CTA Contact Banner --- */
        .bottom-cta-banner {
            background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%);
            border-radius: 20px;
            padding: 45px;
            margin-bottom: 70px;
        }

        /* --- Footer --- */
        footer {
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 35px 0;
            font-size: 0.95rem;
        }

        /* Responsive Layout */
        @media (max-width: 991px) {
            .hero-section {
                text-align: center;
                padding: 50px 0;
            }
            .hero-subtitle { font-size: 1.8rem; }
            .hero-main-title { font-size: 2.5rem; }
            .hero-description, .hero-accent-text { 
                margin-left: auto; 
                margin-right: auto; 
            }
            .hero-image-container { 
                margin-top: 40px; 
            }
            .student-profile-img { 
                width: 85%; 
            }
            .badge-3 { 
                left: 5%; 
            }
        }

        /* Animation for sections */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    @include('frontend.partials.navigation')
    
    <main>
        @yield('content')
    </main>
    
    @include('frontend.partials.footer')
    
    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>