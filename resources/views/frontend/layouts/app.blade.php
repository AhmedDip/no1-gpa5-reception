{{-- frontend/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'নং ১ বাবার কৃতী সন্তান সংবর্ধনা ২০২৬')</title>
    <link rel="icon" href="{{ asset('images/no1-logo.png') }}" type="image/png">

    <!-- Necessary CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/bengali-font.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/toastr/toastr.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" rel="stylesheet" />



    @stack('styles')
    <style>
        :root {
            --primary: #7e55dd;
            /* indigo-600 */
            --primary-dark: #520996;
            --secondary: #852fa7;
            /* amber-500 */
            --accent: #EF4444;
            /* red-500 */
            --dark: #0F172A;
            --gray: #64748B;
            --light-bg: #F8FAFC;
            --card-radius: 1.5rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            /* --common: linear-gradient(135deg, #7c8dffb9 0%, #4037e9f3 100%); */
               /* background: linear-gradient(135deg, #7e54de, #341284); */
             --common: linear-gradient(135deg, #6041a9, #7e54de);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            color: var(--dark);
            background-color: #FFFFFF;
            line-height: 1.5;
            scroll-behavior: smooth;
        }

        /* modern scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        .heading {
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .display-large {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .section-title-icon i {
            color: var(--primary);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 70px;
            height: 4px;
            background: var(--secondary);
            border-radius: 4px;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Buttons */
        .btn {
            border-radius: 60px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            transition: var(--transition);
            letter-spacing: -0.01em;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            box-shadow: 0 8px 20px -8px rgba(79, 70, 229, 0.4);
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }



        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -12px rgba(79, 70, 229, 0.5);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            padding: 1rem 0;
            transition: all 0.2s;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            margin: 0 0.25rem;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            /* background: linear-gradient(135deg, #ffffff 0%, #eedffd 100%); */
            background: linear-gradient(135deg, #ffffff 0%, #eeeeff 50%, #dbd2ff 100%);
            position: relative;
            overflow: hidden;
            padding: 8rem 0 7rem;
        }

        .hero-badge {
            background: rgba(79, 70, 229, 0.1);
            backdrop-filter: blur(4px);
            border-radius: 80px;
            padding: 0.3rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .hero-stats {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            border-radius: 70px;
            padding: 0.5rem 1.5rem;
        }

        .video-thumb {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
        }


        /* gallery thumbnail */
        .gallery-thumb {
            border-radius: 1rem;
            transition: var(--transition);
            opacity: 0.7;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .gallery-thumb.active {
            opacity: 1;
            border-color: var(--primary);
            transform: scale(0.98);
        }

        .gallery-main-img {
            border-radius: 2rem;
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.2);
        }

        /* Tabs */
        .tab-filter {
            background: #F1F5F9;
            padding: 0.5rem;
            border-radius: 60px;
            display: inline-flex;
            gap: 0.5rem;
        }

        .tab-btn {
            border: none;
            background: transparent;
            padding: 0.5rem 1.8rem;
            border-radius: 40px;
            font-weight: 600;
            transition: var(--transition);
        }

        .tab-btn.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 8px 14px -8px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: "#e4edf4";
            background: linear-gradient(135deg, #efeff2 0%, #e3e7fc 100%);
            color: var(--dark);
        }

        /* responsive */
        @media (max-width: 768px) {
            .display-large {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .hero {
                padding: 3rem 0;
            }

            .btn {
                padding: 0.6rem 1.2rem;
            }
        }

        /* Fancy features & badges */
        .fancy-feature-card {
            transition: var(--transition);
        }

        .fancy-feature-card .fancy-icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.08);
        }

        .card-header-custom {
            background: var(--common);
            padding: 1rem 1.5rem;
            text-align: center;
            border-bottom: none;
        }

        .card-header-custom h4 {
            color: white;
            margin: 0;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .card-header-custom p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0.5rem 0 0;
            font-size: 0.9rem;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(2, 6, 23, 0.08);
        }

        .video-play-btn {
            text-decoration: none;
        }

        .text-dark-emphasis {
            color: rgba(15, 23, 42, 0.9);
        }

        .bg-gradient-special {
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.06);
        }
    </style>
</head>

<body>
    @include('frontend.partials.navigation')
    <main>
        @yield('content')
    </main>
    @include('frontend.partials.footer')


    {{-- Necessary JS Scripts --}}
    <script src="{{ asset('template/assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/toastr/toastr.js') }}"></script>

    @stack('scripts')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

</body>

</html>
