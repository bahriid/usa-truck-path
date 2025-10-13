@extends('partials.master')

@push('styles')
    <style>
        body {
            overflow-x: hidden;
        }

        /* Reusable heading styles */
        .pricing-head h2,
        .testimonials .section-title h2,
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 600;
            font-family: var(--heading-font);
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .button-section {
            margin-top: 2rem;
        }

        /* Specific heading colors */
        .pricing-head h2 {
            color: #333;
        }

        .pricing-head p {

            font-weight: 700;
            font-family: var(--nav-font);
        }

        .testimonials .section-title h2 {
            color: #28a745;
            /* Your success color */
        }

        .section-title h2 {
            color: #28a745;
            /* Inherit color if not pricing or testimonials */
            max-width: 100%;
            /* Ensure full width if needed */
        }

        /* Reusable paragraph styles */
        .pricing-head p.lead.text-muted,
        .testimonials .section-title p.lead.text-muted,
        .section-title p {
            max-width: 700px;
            text-align: center;
            margin: 0 auto;
            font-size: 1.5rem;
            opacity: 0.9;
            color: #6c757d;
        }


        .cta-btn {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 1rem 1.5rem;
            border-radius: 2rem;
            color: black;
            font-family: var(--nav-font);
        }

        .cta-btn:hover {
            background-color: var(--accent-color);
            color: white;
        }

        /* pricing-section styles */
        .pricing-section {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 10px;
            background-color: #f8f9fa;

            text-align: center;
        }

        .pricing-section .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pricing-section img {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* max-height: 400px; */
            height: 100%;
            max-width: 100%;
            object-fit: cover;
            border-radius: 8px;
            /* margin-bottom: 1.5rem; */
        }

        .pricing-section h4 {
            color: #343a40;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .pricing-section .list-unstyled {
            color: #495057;
            padding-left: 0;
        }

        .pricing-section .list-unstyled li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .pricing-section .list-unstyled li:last-child {
            border-bottom: none;
        }

        .pricing-section .list-unstyled i {
            color: #28a745;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .pricing-section .list-unstyled strong {
            font-weight: 600;
            color: #212529;
        }

        .pricing-section h5 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            color: #28a745;
        }

        .pricing-section h5 strong {
            font-size: 1.4rem;
        }

        .pricing-section .cta,
        .pricing-section .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            background-color: transparent;
            background-color: #28a745;

            border: 1px solid #28a745;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.15s ease-in-out, border-color 0.15s ease-in-out;
            width: 90%;
            margin: 0.5rem auto;
        }

        .pricing-section .cta:hover,
        .pricing-section .btn:hover {
            transform: scale(0.97)
        }

        .pricing-section .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .pricing-section .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1c7430;
        }

        .pricing-section .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .pricing-section .btn-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
        }

        .pricing-section .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .pricing-section .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .pricing-section .text-white {
            color: #343a40 !important;
        }

        .pricing-section .list-unstyled.text-white li,
        .pricing-section .list-unstyled.text-white strong,
        .pricing-section .list-unstyled.text-white i,
        .pricing-section h5.text-white {
            color: inherit !important;
        }

        /* why-choose-us card hover effect (applied to .card directly) */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }



        .testimonial-slider-section .section-title h2 {
            font-size: 2.5rem;
            font-weight: 600;
            font-family: var(--nav-font);
            color: var(--bs-success);
            /* Adjust to your preferred success color */
            margin-bottom: 0.75rem;
        }

        .testimonial-slider-section .section-title p {
            font-size: 0.9rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.95;
        }

        .testimonial-slide {
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.08);
            /* Lighter shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .testimonial-slide:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.12);
            /* Slightly stronger hover shadow */
        }

        .testimonial-avatar {
            overflow: hidden;
        }

        .testimonial-avatar img {
            object-fit: cover;
        }

        .testimonial-slide h6 {
            color: #333;
            font-size: 1rem;
            font-weight: 600;
            font-family: var(--body-font);
            /* Ensure this variable is defined */
            margin-bottom: 0.2rem;
        }

        .testimonial-slide p {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .testimonial-slide .rating i {
            font-size: 1rem;
            margin-right: 0.1rem;
            color: #ffc107;
            /* Bootstrap warning color for stars */
        }

        /* Swiper styles */
        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            width: 80%;
            /* Adjust slide width as needed */
            margin: 0 auto;
            /* Center the slides */
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .swiper {
                padding-top: 10px;
            }

            .testimonial-slider-section .section-title h2 {
                font-size: 2rem;
            }

            .testimonial-slider-section .section-title p {
                font-size: 1rem;
            }

            .swiper-slide {
                width: 95%;
                margin-top: 0.2rem;
            }

            .swiper-nav-button {
                font-size: 1.2rem;
                width: 30px;
                height: 30px;
            }
        }

        .swiper-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 10;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .swiper-nav-button:hover {
            background-color: var(--accent-color);
            color: white;
        }

        .swiper-button-prev {
            left: 10px;
        }

        .swiper-button-next {
            right: 10px;
        }

        /* Hide default Swiper arrows */
        .swiper-button-prev::after,
        .swiper-button-next::after {
            content: '';
        }

        /* Add Bootstrap Icons */
        .swiper-button-prev::before {
            content: '\f284';
            /* bi-chevron-left */
            font-family: 'bootstrap-icons';
            font-size: 1.5rem;
        }

        .swiper-button-next::before {
            content: '\f285';
            /* bi-chevron-right */
            font-family: 'bootstrap-icons';
            font-size: 1.5rem;
        }

        .section-title {
            padding-bottom: 10px !important;
        }

        /* Responsive adjustments */
        @media (max-width:1084px) {
            .pricing-section {
                max-width: 1000px;
                width: 100%
            }
        }

        @media (max-width: 768px) {

            .pricing-section {
                max-width: 700px;
                width: 100%;
            }

            .pricing-section .img-container {
                width: 100%;

            }

            .pricing-head h2,
            .testimonial-slider-section .section-title h2,
            .section-title h2 {
                font-size: 2rem;
            }

            .pricing-head p.lead.text-muted,
            .testimonial-slider-section .section-title p.lead.text-muted,
            .section-title p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .pricing-section {
                max-width: 500px;
            }

            .pricing-head h2,
            .testimonial-slider-section .section-title h2,
            .section-title h2 {
                font-size: 1.75rem;
            }

            .pricing-head p,
            .testimonial-slider-section .section-title p.lead.text-muted,
            .section-title p {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .pricing-section {
                max-width: 400px;
            }


        }

        .cta-btn-course {
            padding: 0.8rem 2rem;
            border-radius: 3px;
            border: 1px solid rgba(0, 0, 0, 0.164);
            transition: all 0.3s ease;
            background-color: #343a40;
            color: white
        }

        .cta-btn-course:hover {
            background-color: var(--accent-color);
            color: white
        }

        .img-fluid {
            max-height: 500px;
        }

        .about-back {
            /* background-color: #0dcc3a1e */
        }

        .course-details {
            max-width: 1200px;
            margin: 0 auto;
        }

        .why-info-p {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center
        }
    </style>
@endpush

@section('main')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>About Us<br></h1>
                            <p class="mb-0">Pass Your Permit is a leading online learning platform dedicated to helping
                                students pass their permit tests with confidence. We believe that learning should be easy,
                                effective, and accessible, which is why we provide high-quality courses that guarantee
                                success.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">About Us<br></li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- About Us Section -->
        <section id="about-us" class="section about-us">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>About Pass Your Permit</h3>
                        <p class="fst-italic">
                            At Pass Your Permit, we make passing your permit test simple, effective, and guaranteed. Our
                            platform provides high-quality study materials, including videos, audios, and eBooks, designed
                            to ensure success in multiple languages.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Exact Exam Questions & Answers – Study real test
                                    questions with correct answers.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Multilingual Learning – Available in English,
                                    Arabic, Somali, French, Nepali, and Amharic.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>100% Pass Guarantee – Follow our study plan and
                                    pass with confidence!.</span></li>
                        </ul>
                    </div>

                </div>

            </div>

        </section><!-- /About Us Section -->



        <!-- Testimonials Section -->
        <section class="testimonial-slider-section py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-1">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2 class="fw-bold text-success mb-3 mb-sm-1">What Our Students Say</h2>
                            <p class="lead text-muted">Read inspiring stories from individuals who have successfully
                                achieved their trucking careers with us.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/public.png') }} alt="John Doe"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Yodit Tadesse</h6>
                                </div>
                                <p class="text-muted mb-3">"I’m so glad I found PassYourPermit.com! The practice questions
                                    were just like the real test and gave me the confidence I needed. I passed my permit
                                    test on the first try and even joined their trucking school, CDL City Truck Driving
                                    School, which is very affordable. Now I have my CDL, and I couldn’t be happier!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/boy.png') }} alt="Alice Smith"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Carlos Mendoza</h6>
                                </div>
                                <p class="text-muted mb-3">"I’m originally from Honduras and live in Columbus, Ohio. I had
                                    tried a couple of other programs to pass my CDL permit test, but they didn’t work for
                                    me. Then I found PassYourPermit.com, and it changed everything! The questions were just
                                    like the real test, and the lessons were easy to understand. I passed my permit test on
                                    the first try and joined CDL City Truck Driving School here in Columbus. Now I have my
                                    CDL, and I couldn’t be happier!"</p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/boy.png') }} alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Ahmed Hassan</h6>
                                </div>
                                <p class="text-muted mb-3">"I’m originally from Egypt and lived in Dearborn, Michigan,
                                    working as a DoorDash delivery driver. I was tired of the long hours and low pay and
                                    wanted a better career. That’s when I found PassYourPermit.com and bought the Arabic
                                    version of the guide. It was perfect for me! The questions were just like the real test,
                                    and the lessons were so easy to follow in my own language. I passed my CDL permit test
                                    on the first try and joined CDL City Truck Driving School. Now I have my CDL and a new
                                    career I’m proud of. Thank you, PassYourPermit!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide card border-0 shadow-sm rounded-4 p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="testimonial-avatar rounded-circle overflow-hidden me-3"
                                        style="width: 50px; height: 50px;">
                                        <img src={{ asset('frontend/img/public.png') }} alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Yodit Tadesse</h6>
                                </div>
                                <p class="text-muted mb-3">"I’m so glad I found PassYourPermit.com! The practice questions
                                    were just like the real test and gave me the confidence I needed. I passed my permit
                                    test on the first try and even joined their trucking school, CDL City Truck Driving
                                    School, which is very affordable. Now I have my CDL, and I couldn’t be happier!"
                                </p>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mt-4 d-flex justify-content-center"></div>

                    <div class="swiper-button-prev swiper-nav-button"></div>
                    <div class="swiper-button-next swiper-nav-button"></div>
                </div>
            </div>
        </section>

    </main>

    @push('scripts')
        <script>
            const swiper = new Swiper('.testimonialSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: { // Add this autoplay object
                    delay: 3000, // Autoplay every 5 seconds (5000 milliseconds)
                    disableOnInteraction: false, // Don't stop autoplay on user interaction
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                }
            });
        </script>
    @endpush
@endsection
