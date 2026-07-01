{{-- frontend/partials/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('images/no1-logo.png') }}" alt="Logo" height="45">
            <span class="text-dark" style="font-weight: 800;">বাবার কৃতী সন্তান</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="fas fa-bars fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#introduction">ভূমিকা</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#eligibility">যোগ্যতা</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#timeline">সময়সূচি</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#stories">সফলতার গল্প</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#gallery">গ্যালারি</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#faq">FAQ</a></li>

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
                                <i class="fas fa-bell fs-5"></i>
                                @if ($unreadNotifCount > 0)
                                    <span class="notif-badge"
                                        id="notifBadge">{{ $unreadNotifCount > 9 ? '9+' : $unreadNotifCount }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 notif-dropdown"
                                aria-labelledby="notifBellToggle">
                                <li class="px-3 py-2 d-flex justify-content-between align-items-center border-bottom">
                                    <span class="fw-bold small">নোটিফিকেশন</span>
                                    @if ($unreadNotifCount > 0)
                                        <button type="button" class="btn btn-link btn-sm p-0 small text-decoration-none"
                                            id="markAllReadBtn">সব পঠিত করুন</button>
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
                                <img src="{{ asset('storage/' . $studentDetail->student_photo) }}" class="rounded-circle"
                                    width="32" height="32" style="object-fit: cover;">
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
                                <a class="dropdown-item" href="{{ route('student.edit.application') }}">
                                    <i class="fas fa-edit me-2 text-dark"></i> তথ্য সম্পাদনা
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
                        <a class="btn btn-outline-primary px-4" href="{{ route('student.login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> লগইন
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary text-white px-4" href="{{ route('student.register') }}">
                            <i class="fas fa-user-plus me-1"></i> নিবন্ধন <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>

@push('styles')
    <style>
        /* Navigation Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 12px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 8px 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand span {
            font-size: 1.2rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 12px !important;
        }

        .nav-link:hover {
            color: #d32f2f !important;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #d32f2f;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .btn-outline-primary {
            border: 2px solid #d32f2f;
            color: #d32f2f;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #d32f2f;
            border-color: #d32f2f;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        .btn-primary {
            background: #d32f2f;
            border: 2px solid #d32f2f;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #b71c1c;
            border-color: #b71c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        .dropdown-menu {
            border-radius: 12px;
            margin-top: 10px;
            animation: fadeInDown 0.3s ease;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .dropdown-item i {
            width: 20px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Navigation */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                padding: 20px;
                border-radius: 12px;
                margin-top: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .navbar-nav {
                gap: 10px !important;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                padding: 10px 0 !important;
                text-align: center;
            }

            .btn-outline-primary,
            .btn-primary {
                width: 100%;
                text-align: center;
                margin: 5px 0;
            }

            .dropdown-menu {
                border: none;
                box-shadow: none;
                padding-left: 20px;
            }

            .dropdown-toggle::after {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Active link styling */
        .nav-link.active {
            color: #d32f2f !important;
        }

        .nav-link.active::after {
            width: 80%;
        }

        .notif-badge {
            position: absolute;
            top: 2px;
            right: -2px;
            background: #d32f2f;
            color: #fff;
            border-radius: 50%;
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 17px;
            height: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
            line-height: 1;
        }

        .notif-dropdown {
            width: 360px;
            max-width: 90vw;
            max-height: 420px;
            overflow-y: auto;
            padding: 0;
        }

        .notif-item.unread {
            background: #fff5f5;
        }

        .notif-item .notif-msg {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
        }
    </style>
@endpush

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
