{{-- frontend/partials/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('images/no1-logo.png') }}" alt="Logo" height="45">
            <span class="fw-bold" style="font-size: 1.2rem;">বাবার কৃতী সন্তান</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1 gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#overview">ভূমিকা</a></li>
                <li class="nav-item"><a class="nav-link" href="#eligibility">যোগ্যতা</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline">সময়সূচী</a></li>
                <li class="nav-item"><a class="nav-link" href="#stories">সাফল্যের গল্প</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">প্রশ্নোত্তর</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">যোগাযোগ</a></li>
                <li class="nav-item"><a class="btn btn-outline-custom ms-lg-2" href="">লগইন</a></li>
                <li class="nav-item"><a class="btn btn-primary-custom" href="">নিবন্ধন করুন</a></li>
            </ul>
        </div>
    </div>
</nav>