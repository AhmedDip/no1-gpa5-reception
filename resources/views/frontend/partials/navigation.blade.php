{{-- frontend/partials/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('images/no1-logo.png') }}" alt="Logo" height="45">
            <span class="text-dark" style="font-weight: 800;">বাবার কৃতী সন্তান</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#campaign">ভূমিকা</a></li>
                <li class="nav-item"><a class="nav-link" href="#eligibility">যোগ্যতা</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline">সময়সূচি</a></li>
                <li class="nav-item"><a class="nav-link" href="#stories">সফলতার গল্প</a></li>
                <li class="nav-item"><a class="nav-link" href="#gallery">গ্যালারি</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item ms-lg-2"><a class="btn btn-outline-primary" href="#">লগইন</a></li>
                <li class="nav-item"><a class="btn btn-primary text-white" href="#">নিবন্ধন <i class="bi bi-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
</nav>