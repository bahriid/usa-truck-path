<footer id="footer" class="footer position-relative" style="background-color:#0B132B; color:#F4F4F4;">
    @php
        $setting = App\Models\SiteSetting::first();
    @endphp

    <div class="container py-5">
        <div class="row gy-4">

            <!-- Logo & About -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-3">
                    <img src="{{ Storage::url($setting->main_logo) }}" alt="Logo" style="max-height:60px;">
                </a>
                <p class="mb-3">
                    Your trusted guide to start a trucking career in the USA or Canada.
                    We provide courses, mentorship, and visa guidance for international drivers.
                </p>

                <!-- Social Links -->
                <div class="d-flex gap-3">
                    <a href="{{ $setting->facebook_url ?? '#' }}" target="_blank" class="text-light fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $setting->tiktok_url ?? '#' }}" target="_blank" class="text-light fs-5"><i class="bi bi-tiktok"></i></a>
                    <a href="{{ $setting->youtube_url ?? '#' }}" target="_blank" class="text-light fs-5"><i class="bi bi-youtube"></i></a>
                    <a href="{{ $setting->telegram_url ?? '#' }}" target="_blank" class="text-light fs-5"><i class="bi bi-telegram"></i></a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-geo-alt text-success"></i> Columbus, Ohio, USA</li>
                    <li class="mb-2"><i class="bi bi-telephone text-success"></i> {{ $setting->contact_phone ?? '1-669-204-5626' }}</li>
                    <li class="mb-2">
                        <i class="bi bi-envelope text-success"></i>
                        <a href="mailto:{{ $setting->contact_email ?? 'info@passyourpermit.com' }}" class="text-light text-decoration-none">
                            {{ $setting->contact_email ?? 'info@passyourpermit.com' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-light d-block mb-2"><i class="bi bi-house-door text-success"></i> Home</a></li>
                    <li><a href="{{ route('front.about_us') }}" class="text-light d-block mb-2"><i class="bi bi-star text-success"></i> Why Choose Us</a></li>
                    <li><a href="{{ route('front.how_it_works') }}" class="text-light d-block mb-2"><i class="bi bi-diagram-3 text-success"></i> How It Works</a></li>
                    <li><a href="{{ route('front.course') }}" class="text-light d-block mb-2"><i class="bi bi-mortarboard text-success"></i> Courses</a></li>
                    <li><a href="{{ route('front.contact_us') }}" class="text-light d-block mb-2"><i class="bi bi-envelope-paper text-success"></i> Contact</a></li>
                    <li><a href="{{ route('front.privacy_policy') }}" class="text-light d-block"><i class="bi bi-lock text-success"></i> Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Join Our Global Trucking Community</h5>
                <p class="small mb-3">
                    Learn how to get your CDL, apply for visas, and get hired as a truck driver in the USA or Canada.
                </p>
                <a href="{{ route('register') }}" class="btn btn-success fw-semibold px-4 py-2 rounded-pill">Register Now</a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center py-3 mt-4 border-top border-secondary">
        <small>© 2025 <strong class="text-success">USATruckPath.com</strong>. All Rights Reserved.<br>
        Empowering global drivers to achieve success in North America.</small>
    </div>
</footer>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('frontend/js/main.js') }}"></script>

<!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

@stack('scripts')
</body>
</html>
