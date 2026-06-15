{{-- frontend/partials/footer.blade.php --}}
<footer class="pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <div class="d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                    <img src="{{ asset('images/no1-logo.png') }}" alt="No1" height="45">
                    <img src="{{ asset('images/mgi-logo.png') }}" alt="MGI" height="35">
                </div>
                <p class="small mt-3 opacity-75">&copy; {{ date('Y') }} নং ১ বাবার কৃতী সন্তান সংবর্ধনা। সমস্ত অধিকার সংরক্ষিত।</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                    <a href="#" class="text-white-50"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-linkedin fs-5"></i></a>
                </div>
                <p class="small mt-2 opacity-75">হেল্পলাইন: ১৬৩২০ | support@babarkritisontan.com</p>
            </div>
        </div>
    </div>
</footer>