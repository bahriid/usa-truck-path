<footer id="footer" class="footer position-relative light-background" style="background-color: #323031; color:#ffffff">
    @php
    $setting = App\Models\SiteSetting::first();
  
    @endphp
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                     <img src="{{Storage::url($setting->main_logo)}}" alt="" > 
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ \Illuminate\Support\Str::words($setting->address??'', 4) }}</p>
                    <p>{{ \Illuminate\Support\Str::after($setting->address??'', \Illuminate\Support\Str::words($setting->address??'', 4, '')) }}</p>
                    
                    <p class="mt-3"><strong>Phone:</strong> <span>{{$setting->contact_phone??''}}</span></p>
                    <p><strong>Email:</strong> <a href="mailto:{{$setting->contact_email??''}}">{{$setting->contact_email??''}}</a></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <!--<a href="{{$setting->twitter_url??''}}"><i class="bi bi-twitter-x"></i></a>-->
                    <a href="{{$setting->facebook_url??''}}" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="{{$setting->tiktok_url??''}}" target="_blank"><i class="bi bi-tiktok"></i></a>
                    <!--<a href="{{$setting->linkedin_url??''}}"><i class="bi bi-linkedin"></i></a>-->
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{route('front.about_us')}}">Why Choose us</a></li>
                    <li><a href="{{route('front.how_it_works')}}">How It Works</a></li>
                    <li><a href="{{route('front.contact_us')}}">Contact</a></li>
                    <!--<li><a href="{{route('front.terms_condition')}}">Terms & Condition</a></li>-->
                    <!--<li><a href="{{route('front.privacy_policy')}}">Privacy policy</a></li>-->
                </ul>
            </div>

            <!--<div class="col-lg-2 col-md-3 footer-links">-->
            <!--    <h4>Our Services</h4>-->
            <!--    <ul>-->
            <!--        <li><a href="#">Web Design</a></li>-->
            <!--        <li><a href="#">Web Development</a></li>-->
            <!--        <li><a href="#">Product Management</a></li>-->
            <!--        <li><a href="#">Marketing</a></li>-->
            <!--        <li><a href="#">Graphic Design</a></li>-->
            <!--    </ul>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-md-12 footer-newsletter">-->
            <!--    <h4>Our Newsletter</h4>-->
            <!--    <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>-->
            <!--    <form action="forms/newsletter.php" method="post" class="php-email-form">-->
            <!--        <div class="newsletter-form"><input type="email" name="email"><input type="submit"-->
            <!--                value="Subscribe"></div>-->
            <!--        <div class="loading">Loading</div>-->
            <!--        <div class="error-message"></div>-->
            <!--        <div class="sent-message">Your subscription request has been sent. Thank you!</div>-->
            <!--    </form>-->
            <!--</div>-->

        </div>
    </div>

    <div class="container copyright text-center mt-4" style="background-color: #28a74688; color:white; ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">PassYourPermit</strong> <span>All Rights Reserved</span></p>
        
     
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

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
 <!-- Later in the body or a scripts section, include Plyr JS -->
 <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
@stack('scripts')
</body>

</html>