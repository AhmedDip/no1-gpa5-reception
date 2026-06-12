{{-- frontend/partials/footer.blade.php --}}
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="{{ asset('images/no1-logo.png') }}" alt="Logo" height="50" class="mb-3">
                <p class="text-white-50">শিক্ষার আলোয় উদ্ভাসিত প্রতিটি মেধাবী সন্তানের পাশে নাম্বার ওয়ান ব্র্যান্ড।</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white-50"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">লিংক</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#overview" class="text-white-50 text-decoration-none">ভূমিকা</a></li>
                    <li class="mb-2"><a href="#eligibility" class="text-white-50 text-decoration-none">যোগ্যতা</a></li>
                    <li class="mb-2"><a href="#timeline" class="text-white-50 text-decoration-none">সময়সূচী</a></li>
                    <li class="mb-2"><a href="#faq" class="text-white-50 text-decoration-none">প্রশ্নোত্তর</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">যোগাযোগ</h6>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> +৮৮০ ১৬৩৪৫ ৬৭৮৯০</li>
                    <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> support@babarkritisontan.com</li>
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> ঢাকা, বাংলাদেশ</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold mb-3">নিউজলেটার</h6>
                <p class="text-white-50 small">আপডেট পেতে ইমেইল দিন</p>
                <div class="input-group">
                    <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="ইমেইল">
                    <button class="btn btn-primary-custom" type="button">সাবস্ক্রাইব</button>
                </div>
            </div>
        </div>
        <hr class="bg-secondary mt-4">
        <div class="text-center text-white-50 small">
            &copy; {{ date('Y') }} নাম্বার ওয়ান বাবার কৃতী সন্তান সংবর্ধনা। সর্বস্বত্ব সংরক্ষিত।
        </div>
    </div>
</footer>