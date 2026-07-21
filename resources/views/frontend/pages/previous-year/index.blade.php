@extends('frontend.layouts.app')

@section('title', 'বিগত বছরের সংবর্ধনা')

@section('content')

    <section class="py-5 mt-5" style="background: linear-gradient(135deg, #fffcfc 0%, #faf2f4 70%, #ffe2e2 100%);">
        <div class="container text-center">
            <h1 class="section-title mx-auto">বিগত বছরের সংবর্ধনা</h1>
            <p class="text-secondary px-2 mt-3">আগের বছরগুলোর স্মরণীয় মুহূর্ত, ভিডিও ও খবর একসাথে দেখুন</p>
        </div>
    </section>

    <section class="container py-4 py-md-5">
        {{-- Main Tabs --}}
        <ul class="nav nav-pills justify-content-center gap-3 mb-5 py-tab-nav" id="pyTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="py-photos-tab" data-bs-toggle="pill" data-bs-target="#py-photos"
                    type="button" role="tab" aria-controls="py-photos" aria-selected="true">
                    <i class="fas fa-images me-2"></i>সংবর্ধনার ছবি গ্যালারি
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="py-videos-tab" data-bs-toggle="pill" data-bs-target="#py-videos" type="button"
                    role="tab" aria-controls="py-videos" aria-selected="false">
                    <i class="fas fa-video me-2"></i>সংবর্ধনার ভিডিও গ্যালারি
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="py-news-tab" data-bs-toggle="pill" data-bs-target="#py-news" type="button"
                    role="tab" aria-controls="py-news" aria-selected="false">
                    <i class="fas fa-newspaper me-2"></i>সংবর্ধনার খবর
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pyTabContent">

            {{-- ============ TAB 1: PHOTO GALLERY ============ --}}
            <div class="tab-pane fade show active" id="py-photos" role="tabpanel" aria-labelledby="py-photos-tab">

                {{-- Year Filter --}}
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-4 year-filter-bar" data-target="#photoGrid">
                    <button class="tab-btn active" data-year="all">সব ছবি</button>
                    @foreach ($availableYears as $y)
                        <button class="tab-btn" data-year="{{ $y }}">{{ $y }}</button>
                    @endforeach
                </div>

                <div class="row g-4" id="photoGrid">
                    @forelse ($photos as $index => $photo)
                        <div class="col-6 col-md-4 col-lg-3 gallery-item" data-year="{{ $photo['year'] }}">
                            <div class="photo-card rounded-4 overflow-hidden shadow-sm" data-index="{{ $index }}">
                                <img src="{{ $photo['src'] ?? asset('images/dummy-image.png') }}" alt="{{ $photo['caption'] }}"
                                    loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/dummy-image.png') }}';">
                                <div class="photo-overlay">
                                    <i class="fas fa-expand"></i>
                                </div>
                            </div>
                            <p class="small text-center text-muted mt-2 mb-0 px-2">{{ $photo['caption'] }}</p>
                        </div>
                    @empty
                        <p class="text-center text-muted py-5">এই মুহূর্তে কোনো ছবি পাওয়া যায়নি।</p>
                    @endforelse
                </div>
            </div>

            {{-- ============ TAB 2: VIDEO GALLERY ============ --}}
            <div class="tab-pane fade" id="py-videos" role="tabpanel" aria-labelledby="py-videos-tab">

                {{-- Year Filter --}}
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-4 year-filter-bar" data-target="#videoGrid">
                    <button class="tab-btn active" data-year="all">সব ভিডিও</button>
                    @foreach ($availableYears as $y)
                        <button class="tab-btn" data-year="{{ $y }}">{{ $y }}</button>
                    @endforeach
                </div>

                <div class="row g-4" id="videoGrid">
                    @forelse ($videos as $video)
                        <div class="col-12 col-md-4 col-lg-4 video-item" data-year="{{ $video['year'] }}">
                            <div class="video-thumb rounded-4 overflow-hidden shadow-sm"
                                data-video-id="{{ $video['id'] }}">
                                <img src="{{ $video['thumbnail'] ?? asset('images/dummy-image.png') }}" alt="{{ $video['title'] }}" loading="lazy">
                                <div class="play-btn-overlay">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                            <p class="text-center mt-3 small fw-semibold">{{ $video['title'] }}</p>
                        </div>
                    @empty
                        <p class="text-center text-muted py-5">কোনো ভিডিও পাওয়া যায়নি।</p>
                    @endforelse
                </div>
            </div>

            {{-- ============ TAB 3: NEWS ============ --}}
            <div class="tab-pane fade" id="py-news" role="tabpanel" aria-labelledby="py-news-tab">

                {{-- Year Filter --}}
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-4 year-filter-bar" data-target="#newsGrid">
                    <button class="tab-btn active" data-year="all">সব খবর</button>
                    @foreach ($availableYears as $y)
                        <button class="tab-btn" data-year="{{ $y }}">{{ $y }}</button>
                    @endforeach
                </div>

                <div class="row g-4" id="newsGrid">
                    @forelse ($newsList as $news)
                        <div class="col-12 col-md-6 news-item" data-year="{{ $news['year'] }}">
                            <div class="card news-card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="{{ $news['image'] ?? asset('images/dummy-image.png') }}" class="news-card-img" alt="{{ $news['title'] }}"
                                    loading="lazy">
                                <div class="card-body">
                                    <span class="badge bg-danger-soft text-danger mb-2">
                                        <i class="far fa-calendar-alt me-1"></i>{{ $news['date'] }}
                                    </span>
                                    <h5 class="fw-bold">{{ $news['title'] }}</h5>
                                    <p class="text-secondary small mb-3">{{ $news['excerpt'] }}</p>
                                    <a href="{{ $news['link'] }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill">
                                        বিস্তারিত <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-5">কোনো খবর পাওয়া যায়নি।</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    {{-- ===== Photo Lightbox Modal ===== --}}
    <div class="modal fade" id="photoLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark border-0 rounded-4 overflow-hidden">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    style="z-index:10;" data-bs-dismiss="modal"></button>
                <div class="modal-body p-0 position-relative d-flex align-items-center justify-content-center"
                    style="min-height: 60vh;">
                    <button type="button" class="lightbox-nav lightbox-prev" id="lightboxPrev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <img id="lightboxImage" src="" alt="" class="img-fluid" style="max-height: 80vh;">
                    <button type="button" class="lightbox-nav lightbox-next" id="lightboxNext">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <p class="text-white text-center small pb-3 mb-0" id="lightboxCaption"></p>
            </div>
        </div>
    </div>

    {{-- ===== Video Modal ===== --}}
    <div class="modal fade" id="pyVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 overflow-hidden">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="pyVideoFrame" src="" frameborder="0" allow="autoplay; encrypted-media"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== News Detail Modal ===== --}}
    <div class="modal fade" id="newsDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 overflow-hidden">
                <img id="newsModalImage" src="" class="w-100" style="max-height:280px; object-fit:cover;">
                <div class="modal-body p-4">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <span class="badge bg-danger-soft text-danger mb-2" id="newsModalDate"></span>
                    <h4 class="fw-bold" id="newsModalTitle"></h4>
                    <p class="text-secondary" id="newsModalContent"></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tab Navigation Styles */
        .py-tab-nav .nav-link {
            color: #4a4a4a;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            border: 2px solid #e5e7eb;
            background: #ffffff;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .py-tab-nav .nav-link:hover {
            border-color: #aa1b1d;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(170, 27, 29, 0.12);
        }

        .py-tab-nav .nav-link.active {
            background: linear-gradient(135deg, #ffe1e1 0%, #ffe3ec 100%);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 8px 25px -6px rgba(170, 27, 29, 0.5);
            transform: translateY(-2px);
        }

        .py-tab-nav .nav-link i {
            transition: transform 0.3s ease;
        }

        .py-tab-nav .nav-link.active i {
            transform: scale(1.1);
        }

        /* Tab Content Fade Animation */
        .tab-pane {
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Year Filter Pills */
        .year-filter-bar .tab-btn {
            border: none;
            background: #F1F5F9;
            padding: 0.45rem 1.4rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .year-filter-bar .tab-btn.active {
            background: #aa1b1d;
            color: #fff;
            box-shadow: 0 6px 14px -6px rgba(170, 27, 29, 0.5);
        }

        .year-filter-bar .tab-btn:hover:not(.active) {
            background: #e9e2e2;
        }

        /* Photo Card Styles */
        .photo-card {
            position: relative;
            cursor: pointer;
            aspect-ratio: 1/1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .photo-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(255, 247, 247, 0.15);
        }

        .photo-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .photo-card:hover img {
            transform: scale(1.1);
        }

        .photo-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.205);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-card:hover .photo-overlay {
            opacity: 1;
        }

        .photo-overlay i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Video Card Styles */
        .video-thumb {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .video-thumb:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .video-thumb img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .video-thumb:hover img {
            transform: scale(1.05);
        }

        .play-btn-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .video-thumb:hover .play-btn-overlay {
            background: rgba(255, 158, 158, 0.253);
        }

        .play-btn-overlay i {
            color: #ffffff;
            font-size: 3.5rem;
            background: rgba(136, 12, 12, 0.979);
            padding: 20px 25px;
            border-radius: 50%;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }


        /* News Card Styles */
        .news-card {
            border-radius: 16px !important;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.04) !important;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .news-card-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .bg-danger-soft {
            background: rgba(170, 27, 29, 0.1) !important;
        }

        .text-danger {
            color: #aa1b1d !important;
        }

        /* Lightbox Navigation */
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 5;
        }

        .lightbox-nav:hover {
            background: #aa1b1d;
            border-color: #aa1b1d;
            transform: translateY(-50%) scale(1.05);
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .py-tab-nav .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            .py-tab-nav .nav-link i {
                margin-right: 0.5rem !important;
            }

            .photo-card {
                aspect-ratio: 4/3;
            }

            .video-thumb img {
                height: 180px;
            }

            .news-card-img {
                height: 180px;
            }

            .lightbox-nav {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .lightbox-prev {
                left: 10px;
            }

            .lightbox-next {
                right: 10px;
            }
        }

        @media (max-width: 576px) {
            .py-tab-nav {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            .py-tab-nav .nav-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                /* ---------- YEAR FILTER (Photos / Videos / News) ---------- */
                document.querySelectorAll('.year-filter-bar').forEach(function(bar) {
                    const target = document.querySelector(bar.dataset.target);
                    if (!target) return;

                    bar.querySelectorAll('.tab-btn').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            bar.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                            this.classList.add('active');

                            const selectedYear = this.dataset.year;

                            target.querySelectorAll('[data-year]').forEach(function(item) {
                                const matches = selectedYear === 'all' || item.dataset.year ===
                                    selectedYear;
                                item.classList.toggle('d-none', !matches);
                            });
                        });
                    });
                });

                /* ---------- PHOTO LIGHTBOX ---------- */
                const photos = @json($photos);
                const lightboxModalEl = document.getElementById('photoLightboxModal');
                const lightboxModal = new bootstrap.Modal(lightboxModalEl);
                const lightboxImage = document.getElementById('lightboxImage');
                const lightboxCaption = document.getElementById('lightboxCaption');
                let currentIndex = 0;

                function getVisiblePhotoCards() {
                    return Array.from(document.querySelectorAll(
                        '#photoGrid .gallery-item:not(.d-none) .photo-card'));
                }

                function showLightboxByCard(card) {
                    const index = parseInt(card.dataset.index, 10);
                    if (!photos[index]) return;
                    currentIndex = index;
                    lightboxImage.src = photos[index].src;
                    lightboxImage.alt = photos[index].caption;
                    lightboxCaption.textContent = photos[index].caption;
                }

                document.querySelectorAll('.photo-card').forEach(card => {
                    card.addEventListener('click', function() {
                        showLightboxByCard(this);
                        lightboxModal.show();
                    });
                });

                function navigateLightbox(direction) {
                    const visibleCards = getVisiblePhotoCards();
                    const currentPos = visibleCards.findIndex(c => parseInt(c.dataset.index, 10) ===
                        currentIndex);
                    if (currentPos === -1 || visibleCards.length === 0) return;

                    const nextPos = (currentPos + direction + visibleCards.length) % visibleCards.length;
                    showLightboxByCard(visibleCards[nextPos]);
                }

                document.getElementById('lightboxPrev').addEventListener('click', () => navigateLightbox(-
                    1));
                document.getElementById('lightboxNext').addEventListener('click', () => navigateLightbox(1));

                // Keyboard navigation for lightbox
                document.addEventListener('keydown', function(e) {
                    if (!lightboxModalEl.classList.contains('show')) return;
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        navigateLightbox(-1);
                    }
                    if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        navigateLightbox(1);
                    }
                    if (e.key === 'Escape') {
                        lightboxModal.hide();
                    }
                });

                /* ---------- VIDEO MODAL ---------- */
                const pyVideoModal = new bootstrap.Modal(document.getElementById('pyVideoModal'));
                const pyVideoFrame = document.getElementById('pyVideoFrame');

                document.querySelectorAll('.video-thumb').forEach(thumb => {
                    thumb.addEventListener('click', function() {
                        const videoId = this.dataset.videoId;
                        pyVideoFrame.src =
                            `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                        pyVideoModal.show();
                    });
                });

                document.getElementById('pyVideoModal').addEventListener('hidden.bs.modal', function() {
                    pyVideoFrame.src = '';
                });


                const newsDetailModal = new bootstrap.Modal(document.getElementById('newsDetailModal'));

                document.querySelectorAll('.news-read-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.getElementById('newsModalImage').src = this.dataset.image;
                        document.getElementById('newsModalTitle').textContent = this.dataset.title;
                        document.getElementById('newsModalDate').textContent = this.dataset.date;
                        document.getElementById('newsModalContent').textContent = this.dataset.content;
                        newsDetailModal.show();
                    });
                });


                document.querySelectorAll('.py-tab-nav .nav-link').forEach(tab => {
                    tab.addEventListener('shown.bs.tab', function(e) {

                        document.querySelectorAll('.tab-pane').forEach(pane => {
                            pane.classList.remove('show', 'active');
                        });

                        const target = document.querySelector(this.dataset.bsTarget);
                        if (target) {
                            target.classList.add('show', 'active');
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
