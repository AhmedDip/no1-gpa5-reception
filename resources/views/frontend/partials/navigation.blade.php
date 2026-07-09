{{-- frontend/partials/navigation.blade.php --}}
@unless (request()->routeIs('student.otp.verify'))
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-3" href="{{ url('/') }}">
                <img src="{{ asset('images/no1-2026.png') }}" alt="NUMBER 1 Logo" class="logo-img"
                    style="height: 60px; width: auto; object-fit: contain;">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars fs-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#campaign">ভূমিকা</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#eligibility">যোগ্যতা</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#timeline">সময়সূচি</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#stories">সফলতার গল্প</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#gallery">গ্যালারি</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#faq">
                        সাধারণ জিজ্ঞাসা
                    </a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative d-inline-flex align-items-center gap-1"
                            href="{{ route('previous-year.index') }}">
                            বিগত বছর
                            <span class="badge-archive-glow">
                               Archive
                            </span>
                        </a>
                    </li>

                    @auth
                        @if (Auth::user()->user_type_id == 1)
                            @php
                                $unreadNotifCount = \App\Models\StudentNotification::where('user_id', Auth::id())
                                    ->where('is_read', false)
                                    ->count();
                                $latestNotifications = \App\Models\StudentNotification::where('user_id', Auth::id())
                                    ->latest()
                                    ->limit(6)
                                    ->get();
                            @endphp
                            <li class="nav-item dropdown me-lg-1">
                                <a class="nav-link position-relative" href="#" id="notifBellToggle" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell fs-5 text-warning"></i>
                                    @if ($unreadNotifCount > 0)
                                        <span class="notification-glow position-absolute top-0 start-100 translate-middle"
                                            id="notifBadge">{{ $unreadNotifCount > 9 ? '9+' : $unreadNotifCount }}</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 notif-dropdown"
                                    aria-labelledby="notifBellToggle">
                                    <li class="px-3 py-2 d-flex justify-content-between align-items-center border-bottom">
                                        <span class="fw-bold small">নোটিফিকেশন</span>
                                        @if ($unreadNotifCount > 0)
                                            <button type="button" class="btn btn-link btn-sm p-0 small text-decoration-none"
                                                id="markAllReadBtn">সব নোটিফিকেশন পড়ুন</button>
                                        @endif
                                    </li>
                                    @forelse($latestNotifications as $notif)
                                        <li>
                                            <a href="javascript:void(0)"
                                                class="dropdown-item notif-item {{ $notif->is_read ? '' : 'unread' }}"
                                                data-id="{{ $notif->id }}" data-title="{{ $notif->title }}"
                                                data-message="{{ $notif->message }}"
                                                data-read-url="{{ route('student.notifications.read', $notif->id) }}">
                                                <div class="d-flex gap-2">
                                                    <i class="fas {{ $notif->icon }} mt-1"></i>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold small">{{ $notif->title }}</div>
                                                        <div class="text-muted small notif-msg">
                                                            {{ \Illuminate\Support\Str::limit($notif->message, 60) }}</div>
                                                        <div class="text-muted" style="font-size: 0.7rem;">
                                                            {{ $notif->created_at->diffForHumans() }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item-text text-muted small text-center py-3 d-block">কোনো
                                                নোটিফিকেশন নেই</span></li>
                                    @endforelse
                                    <li>
                                        <hr class="dropdown-divider m-0">
                                    </li>
                                    <li class="text-center">
                                        <a href="{{ route('student.notifications.index') }}"
                                            class="dropdown-item text-center small fw-semibold py-2">সব নোটিফিকেশন দেখুন</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $studentDetail = Auth::user()->studentDetail;
                                @endphp
                                @if ($studentDetail && $studentDetail->student_photo)
                                    <img src="{{ $studentDetail->student_photo_url }}" class="rounded-circle" width="32"
                                        height="32" style="object-fit: cover;">
                                @else
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;">
                                        <i class="fas fa-user fa-sm"></i>
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2 text-dark"></i> ড্যাশবোর্ড
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('student.logout') }}" id="logout-form">
                                        @csrf
                                        <button type="button" class="dropdown-item text-danger" id="logoutBtn">
                                            <i class="fas fa-sign-out-alt me-2"></i> লগআউট
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- When user is not logged in -->
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-outline-danger px-4" href="{{ route('student.login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> লগইন
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger text-white px-4 btn-register-glow"
                                href="{{ route('student.register') }}">
                                <i class="fas fa-user-plus me-1"></i>
                                নিবন্ধন
                            </a>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>
@endunless

@push('scripts')
    <script>
        // Change navbar style on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Active link highlighting based on scroll position
        const sections = document.querySelectorAll('section, div[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            const scrollPosition = window.scrollY + 100;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                const sectionId = section.getAttribute('id');

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    current = sectionId;
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Handle logout with SweetAlert
        @auth
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'লগআউট করুন',
                    text: "আপনি কি নিশ্চিত যে লগআউট করতে চান?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d32f2f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'হ্যাঁ, লগআউট',
                    cancelButtonText: 'বাতিল করুন',
                    background: '#fff',
                    iconColor: '#d32f2f'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            });
        }
        @endauth

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '' && href !== '#userDropdown') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>

    @auth
        @if (Auth::user()->user_type_id == 1)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    function updateBadge(delta) {
                        const badge = document.getElementById('notifBadge');
                        if (!badge) return;
                        let count = parseInt(badge.textContent) || 0;
                        count = Math.max(0, count + delta);
                        if (count === 0) {
                            badge.remove();
                        } else {
                            badge.textContent = count > 9 ? '9+' : count;
                        }
                    }

                    document.querySelectorAll('.notif-item[data-id]').forEach(function(item) {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            const title = this.dataset.title;
                            const message = this.dataset.message;
                            const wasUnread = this.classList.contains('unread');

                            Swal.fire({
                                title: title,
                                html: message.replace(/\n/g, '<br>'),
                                icon: 'info',
                                confirmButtonColor: '#d32f2f',
                                confirmButtonText: 'বন্ধ করুন'
                            });

                            if (wasUnread) {
                                this.classList.remove('unread');
                                updateBadge(-1);
                                fetch(this.dataset.readUrl, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Content-Type': 'application/json'
                                    }
                                }).catch(() => {});
                            }
                        });
                    });

                    const markAllBtn = document.getElementById('markAllReadBtn');
                    if (markAllBtn) {
                        markAllBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            fetch('{{ route('student.notifications.read-all') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json'
                                }
                            }).then(() => {
                                document.querySelectorAll('.notif-item.unread').forEach(el => el.classList
                                    .remove('unread'));
                                const badge = document.getElementById('notifBadge');
                                if (badge) badge.remove();
                                this.remove();
                            });
                        });
                    }
                });
            </script>
        @endif
    @endauth
@endpush
