@extends('partials.master')
@push('styles')
    <style>
        .owl-nav {
            display: none !important;
        }

        .why-choose-us .section-title h2 {
            font-size: 2.5rem;
            font-weight: 600;
            font-family: var(--heading-font);
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .why-choose-us .section-title p {
            max-width: 700px;
            text-align: center;
            margin: 0 auto;
            font-size: 1.5rem;
            opacity: 0.9;
            color: #6c757d;
        }

        /* Video Section Styling */
        .video-section {
            padding: 80px 0;
        }

        .video-section .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 1rem;
        }

        .video-wrapper {
            position: relative;
            transition: transform 0.3s ease;
        }

        .video-wrapper:hover {
            transform: translateY(-5px);
        }

        .video-wrapper .ratio {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .video-wrapper iframe {
            border-radius: 15px;
        }

        @media (max-width: 768px) {
            .why-choose-us .section-title h2 {
                font-size: 2rem;
            }

            .why-choose-us .section-title p {
                font-size: 1rem;
            }

            .video-section {
                padding: 60px 0;
            }

            .video-section .section-title h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .why-choose-us .section-title h2 {
                font-size: 1.75rem;
            }

            .why-choose-us .section-title p {
                font-size: 0.85rem;
            }

            .video-section .section-title h2 {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush

@section('main')
    <main class="main">

        <!-- Hero Section -->

        <section id="hero-section" class="hero-section">
            <div class="hero-carousel owl-carousel">
                @foreach ($sliders as $slider)
                    <div class="hero-slide">
                        <img src="{{ Storage::url($slider->image) }}" alt="Slider Image" class="hero-image">
                        <div
                            style="position: absolute; width:100%;height:100%; top:0;left:0;background-color:rgba(0,0,0,0.6)">
                        </div>

                        <div class="hero-content">
                            <div class="container text-center">
                                <h2 class="hero-title" style="color: #5fcf80;" data-aos="fade-up" data-aos-delay="100">
                                    <!--{{ $slider->title }} -->
                                    {!! $slider->title !!}
                                </h2>
                                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">{{ $slider->subtitle }}</p> 
                                <a href="#scrollelem" class="hero-btn" data-aos="fade-up" data-aos-delay="300">Get
                                    Started</a>
                                <!--<button onclick = "document.getElementById('about').scrollIntoView({behavior:'smooth'})" class="hero-btn" data-aos="fade-up" data-aos-delay="300">Get Started</button>-->
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


        </section>
        <div id="scrollelem" style="visibility: hidden;"></div>
        <!-- Courses Section -->
        <section id="courses" class="courses section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Courses</h2>

                <p>CDL Class A Permit Course</p>
            </div><!-- End Section Title -->
            <div class="container">

                <div class="row mb-3">




                    @forelse ($courses as $course)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-3" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div class="course-item">
                                <a href="{{ route('front.course.details', $course->slug) }}">
                                    <img src="{{ Storage::url($course->image ?? '') }}" class="" alt="..."
                                        style="max-width: 100%; height: 274px;"></a>
                                <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                                        {{-- @guest
                                            <a href="{{ route('register') }}?course_id={{ $course->id }}"
                                                class="btn btn-primary">Login to Enroll</a>

                                             
                                        @else
                                            @if (auth()->user()->hasApprovedCourse($course->id))
                                                <button class="btn btn-success" disabled>Already Enrolled</button>
                                            @else
                                                <!-- If you want to show 'Up Coming' based on course status, you can do something like: -->
                                                @if ($course->status === 'upcoming')
                                                    <button class="btn btn-secondary" disabled>Up Coming</button>
                                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                                    <button class="btn btn-info " disabled>Request Pending...</button>
                                                @else
                                                    <!-- Instead of directly purchasing, go to the enroll form -->
                                                    <a href="{{ route('stripe.payment.view', $course->id) }}"
                                                        class="btn btn-primary">Enroll
                                                        Now</a>
                                                @endif
                                            @endif
                                        @endguest --}}
                                        <a href="{{ route('front.course.category', $course->category) }}"
                                            class="btn btn-info">More Details</a>
                                        <p class="price">${{ $course->price ?? '' }}</p>
                                    </div>

                                    <h3><a
                                            href="{{ route('front.course.category', $course->category) }}">{{ Str::limit($course->title ?? '', 60) }}</a>
                                    </h3>
                                    <!-- <p class="description">{!! Str::limit($course->description ?? '', 152) !!}.</p> -->
                                    <p class="description">{{ Str::limit(strip_tags($course->description ?? ''), 152, '...') }}</p>

                                    <!--<div class="trainer d-flex justify-content-between align-items-center">-->
                                    <!--<div class="trainer-profile d-flex align-items-center">-->
                                    <!--<i class="bi bi-clock"></i>&nbsp;2:30 h -->
                                    <!--              </div>-->
                                    <!--              <div class="trainer-rank d-flex align-items-center">-->
                                    <!--                  <i class="bi bi-people"></i>&nbsp;{{ $course->students->count() }} students-->
                                    <!--                  &nbsp;&nbsp;-->
                                    <!--                  <i class="bi bi-book"></i>&nbsp;{{ $course->chapters->count() }} lessons-->
                                    <!--              </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div> <!-- End Course Item-->
                    @empty
                        <div>No course Found</div>
                    @endforelse



                </div>
                <!-- Load More Button -->
                @if ($courses->hasMorePages())
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('front.course') }}" id="loadMore" data-page="2"
                            style ="background: var(--accent-color);
    border: none;">Load More...</a>
                    </div>
                @endif

            </div>
        </section><!-- /Courses Section -->

        <!-- Video Section -->
        <section id="video-section" class="video-section section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 text-center">
                        <div class="section-title" data-aos="fade-up">
                            <h2>Watch How It Works</h2>
                            <p class="lead text-muted">See how USTRUCKPATH can help you start your trucking career in the USA</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="video-wrapper" data-aos="zoom-in" data-aos-delay="100">
                            <div class="ratio ratio-16x9 shadow-lg rounded overflow-hidden">
                                <iframe
                                    src="https://www.youtube.com/embed/abelH0rm-h0"
                                    title="USTRUCKPATH Introduction Video"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Video Section -->

        <!--<section id="about" class="about section">-->

        <!--       <div class="container">-->

        <!--           <div class="row gy-4">-->

        <!--               <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">-->
        <!--                   <img src="{{ asset('frontend/img/compressed_truck1.png ') }}" class="img-fluid" alt="">-->
        <!--               </div>-->

        <!--               <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">-->
        <!--                   <h3>CLP English</h3>-->
        <!--                   <p class="">-->
        <!--                       Pass your CDL Permit Test on your first try! Our English study guide provides the exact-->
        <!--                       questions and answers you'll-->
        <!--                       see on the test. We offer multiple study versions, including a course, ebook, and audiobook, so-->
        <!--                       you can choose the format-->
        <!--                       that works best for you. Our guide covers all the essential topics, such as General Knowledge,-->
        <!--                       Air brakes,-->
        <!--                       and Combination tests. Don't let language barriers hold you back - study and pass-->
        <!--                       your test today!-->
        <!--                   </p>-->

        <!--               </div>-->

        <!--           </div>-->

        <!--       </div>-->

        <!--   </section>-->
        <!--   <section id="about" class="about section">-->

        <!--       <div class="container">-->

        <!--           <div class="row gy-4">-->



        <!--               <div class="col-lg-6 order-2 order-lg-2 content" data-aos="fade-up" data-aos-delay="200">-->
        <!--                   <h3>CLP Arabic</h3>-->
        <!--                   <p class="">-->
        <!--                       Pass your CDL Permit Test on your first try! Our Arabic study guide provides the exact questions-->
        <!--                       and answers you'll see on the test. We offer multiple study versions, including a course, eBook,-->
        <!--                       and audiobook, so you can choose the format that works best for you. Our guide covers all the-->
        <!--                       essential topics, such as General Knowledge, Air brakes, and Combination tests. Don't let-->
        <!--                       language barriers hold you back - study and pass your test today!</p>-->
        <!--                   <p>-->

        <!--                       اجْتَاز اخْتِبَارَ رُخْصَةِ القِيَادَةِ التِجَارِيَّةِ مِنَ أَوَّلِ مَرَّةٍ! تُوَفِّرُ-->
        <!--                       دَلِيلُنَا الدِّرَاسِيُّ بِاللُّغَةِ الْعَرَبِيَّةِ الأَسْئِلَةَ وَالْإِجَابَاتِ-->
        <!--                       الْمُطْلَقَةَ الَّتِي سَتَرَاهَا فِي الاخْتِبَارِ. نَحْنُ نُقَدِّمُ عِدَّةَ نُسَخٍ دِرَاسِيَّةٍ،-->
        <!--                       بِمَا فِي ذَلِكَ دُورَةٌ تَعْلِيمِيَّةٌ وَكِتَابٌ إِلَكْتْرُونِيٌّ وَكِتَابٌ صَوْتِيٌّ، لِكَيْ-->
        <!--                       تَخْتَارَ الْصِّيَغَةَ الَّتِي تَنَاسِبُكَ. يَغْطِي دَلِيلُنَا جَمِيعَ الْمَوَاضِيعِ-->
        <!--                       الْأَسَاسِيَّةِ، مِثْلَ الْمَعْرِفَةِ الْعَامَّةِ وَفَرَامِلِ الْهَوَاءِ والإختبار المختلط<.-->
        <!--                           </p>-->
        <!--                           <p>-->
        <!--                               لَا تَدَعْ الْحَوَاجِزَ اللُّغَوِيَّةَ تَعْيِقُكَ - اِدْرُسْ وَاَجْتَزْ-->
        <!--                               اخْتِبَارَكَ الْيَوْمَ-->
        <!--                           </p>-->

        <!--               </div>-->
        <!--               <div class="col-lg-6 order-1 order-lg-1" data-aos="fade-up" data-aos-delay="100">-->
        <!--                   <img src="{{ asset('frontend/img/compressed_truck2.png ') }}" class="img-fluid" alt="">-->
        <!--               </div>-->

        <!--           </div>-->

        <!--       </div>-->

        <!--   </section>-->



        <!-- /Hero Section -->













        <!-- Why Us Section -->
        <section class="why-choose-us py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2 class="fw-bold text-success mb-3">Why Choose USTRUCKPATH</h2>
                            <p class="lead text-muted">USTRUCKPATH helps people from around the world become truck drivers in the USA and Canada. We provide step-by-step courses, real mentorship, and daily support so you can reach your trucking goals with confidence.</p>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-primary-subtle text-primary rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Your All-in-One Solution</h5>
                                <p class="text-muted small">Stop searching in a dozen different places. We are your single, complete resource for starting your American trucking career. From writing your CV and understanding the visa process to passing your CDL test and finding the right company, we guide you through every single step.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-success-subtle text-success rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Real DMV Test Questions & Answers</h5>
                                <p class="text-muted small">We are located in the heart of the American trucking industry in Columbus, Ohio. This means you get accurate, up-to-date information and insider knowledge about the best companies, regulations, and opportunities directly from the source.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-warning-subtle text-warning rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-collection-play-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">You Are Not Alone: Our Daily Support</h5>
                                <p class="text-muted small">When you buy a course, you don't just get videos and documents. You get instant access to our private Telegram group. Here, you can ask questions daily and get answers from our mentors and a community of drivers on the same journey. It’s like having a personal guide.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-danger-subtle text-danger rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-shield-fill-check"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">A Clear Path from Zero to Hired</h5>
                                <p class="text-muted small">We have created a step-by-step system that takes you from having a dream to getting a job. Our premium courses break down the complex process of moving to the USA into simple, easy-to-follow steps, so you always know what to do next.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-info-subtle text-info rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">Direct Access to Hiring Companies</h5>
                                <p class="text-muted small">We don't just teach you how to get a job; we help you connect with one. We educate you on which trucking companies are actively hiring international drivers and how to successfully apply to them, increasing your chances of getting hired.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box bg-secondary-subtle text-secondary rounded-circle mb-3 mx-auto"
                                    style="width: 60px; height: 60px; line-height: 60px; font-size: 1.5rem;">
                                    <i class="bi  bi-truck-front-fill"></i>
                                </div>
                                <h5 class="fw-semibold mb-2">A One-Time Investment for a Lifetime Career</h5>
                                <p class="text-muted small">Your one-time payment unlocks your future. There are no hidden fees or extra charges. You get lifetime access to your course materials and our supportive Telegram community, ensuring you have help until you achieve your dream.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimonials</h2>
                <p>What are they saying</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 400,
              "autoplay": {
                "delay": 3000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                }
              }
            }
          </script>
                    <div class="swiper-wrapper">

                    {{-- <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <!--<img src="{{ asset('frontend//img/testimonials/testimonials-2.jpg') }}"-->
                                    <!--    class="testimonial-img" alt="">-->
                                    <h3>Yodit Tadesse</h3>
                                    <!--<h4>Ceo &amp; Founder</h4>-->
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>"I’m so glad I found PassYourPermit.com! The practice questions were just like
                                            the real test and gave me the confidence I needed. I passed my permit test on
                                            the first try and even joined their trucking school, CDL City Truck Driving
                                            School, which is very affordable. Now I have my CDL, and I couldn’t be happier!"
                                        </span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <!--<img src="{{ asset('frontend//img/testimonials/testimonials-1.jpg') }}"-->
                                    <!--    class="testimonial-img" alt="">-->
                                    <h3>Carlos Mendoza</h3>
                                    <!--<h4>Designer</h4>-->
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>"I’m originally from Honduras and live in Columbus, Ohio. I had tried a couple
                                            of other programs to pass my CDL permit test, but they didn’t work for me. Then
                                            I found PassYourPermit.com, and it changed everything! The questions were just
                                            like the real test, and the lessons were easy to understand. I passed my permit
                                            test on the first try and joined CDL City Truck Driving School here in Columbus.
                                            Now I have my CDL, and I couldn’t be happier!"</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <!--<img src="{{ asset('frontend//img/testimonials/testimonials-1.jpg') }}"-->
                                    <!--    class="testimonial-img" alt="">-->
                                    <h3>Ahmed Hassan</h3>
                                    <!--<h4>Store Owner</h4>-->
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>"I’m originally from Egypt and lived in Dearborn, Michigan, working as a
                                            DoorDash delivery driver. I was tired of the long hours and low pay and wanted a
                                            better career. That’s when I found PassYourPermit.com and bought the Arabic
                                            version of the guide. It was perfect for me! The questions were just like the
                                            real test, and the lessons were so easy to follow in my own language. I passed
                                            my CDL permit test on the first try and joined CDL City Truck Driving School.
                                            Now I have my CDL and a new career I’m proud of. Thank you, PassYourPermit!"
                                        </span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
--}}
                        <!-- New testimonial item -->
<div class="swiper-slide">
    <div class="testimonial-wrap">
        <div class="testimonial-item">
            <h3>Juan Ramirez</h3>
            <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i>
            </div>
            <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>"USTruckPath completely changed my journey. I’m originally from Honduras and now live in Columbus, Ohio. Their mentorship program gave me the exact training and practice I needed. I passed my CDL permit test on the first try, joined CDL school, and today I’m working as a truck driver in the U.S. I couldn’t be happier!"</span>
                <i class="bi bi-quote quote-icon-right"></i>
            </p>
        </div>
    </div>
</div>
<!-- End testimonial item -->

<!-- New testimonial item -->
<div class="swiper-slide">
    <div class="testimonial-wrap">
        <div class="testimonial-item">
            <h3>Sara Mohammed</h3>
            <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i>
            </div>
            <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>"I’m so thankful I found USTruckPath. The mentorship program gave me the confidence I needed, and the practice tests were just like the real thing. I passed my permit test right away and got connected to CDL training. Today I drive trucks full time, and it all started with USTruckPath!"</span>
                <i class="bi bi-quote quote-icon-right"></i>
            </p>
        </div>
    </div>
</div>
<!-- End testimonial item -->

<!-- New testimonial item -->
<div class="swiper-slide">
    <div class="testimonial-wrap">
        <div class="testimonial-item">
            <h3>Mohamed Abdi</h3>
            <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i>
            </div>
            <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>"I’m originally from Somalia and was working delivery jobs before. I wanted a better career, and USTruckPath gave me the tools to achieve it. The lessons were simple, the mentorship was clear, and I passed my CDL test on the first try. Now I’m proud to be a truck driver in the U.S."</span>
                <i class="bi bi-quote quote-icon-right"></i>
            </p>
        </div>
    </div>
</div>
<!-- End testimonial item -->




                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <section class="why-info bg-light py-5">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class=" ">
                        <h2 class="fw-bold text-success mb-3 text-center">About USATruckPath</h2>
                        <p class="text-muted why-info-p">

                            We make it easy to pass your Commercial Learner’s Permit (CLP) test. Our all-in-one course
                            includes video lessons, audio guides, and an eBook—available in multiple languages. It’s
                            everything you need to get started in trucking.
                        </p>
                       {{-- <p class="text-muted text-center mb-0 mt-2" style="font-weight: 700; font-size:2rem; ">Here's what
                            you need to do to get started:</p> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                    <section class="py-5 bg-light" id="faq">
  <div class="container">
    <h2 class="text-center mb-4">🚚 Frequently Asked Questions (FAQ)</h2>
    <p class="text-center mb-5">Find answers to the most common questions about starting your trucking journey with USTRUCKPATH.</p>

    <div class="accordion" id="faqAccordion">

      <!-- FAQ 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq1-heading">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
            ❓ What is USTRUCKPATH?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            USTRUCKPATH is a global online learning platform that helps people from around the world become licensed truck drivers in the USA and Canada.<br>
            We provide step-by-step video courses, visa assistance, and mentorship programs to guide you from your home country all the way to working as a professional truck driver in North America.
          </div>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq2-heading">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
            🌍 Who can join USTRUCKPATH?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Anyone who wants to start or grow a trucking career in the USA or Canada can join — whether you live locally or internationally.<br>
            Our program is designed for new drivers, immigrants, and international students who want to qualify for trucking opportunities in North America.
          </div>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq3-heading">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
            📘 What does the course include?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            <ul>
              <li>CLP/CDL (USA) and Class 1 (Canada) licensing guides</li>
              <li>Visa and immigration guidance</li>
              <li>Job application templates and interview prep</li>
              <li>Cross-border driving rules and compliance</li>
              <li>Real-world advice from experienced drivers</li>
              <li>Private Telegram mentorship group</li>
              <li>Weekly live Zoom classes</li>
              <li>Lifetime access to all materials and updates</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq4-heading">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
            💰 How much does it cost?
          </button>
        </h2>
        <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            The full program is normally <strong>$497</strong>, but it’s currently available for a <strong>one-time payment of $160</strong>.<br>
            ✅ No subscriptions. No hidden fees. Just one payment for full lifetime access.
          </div>
        </div>
      </div>

      <!-- FAQ 5 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq5-heading">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
            🗣️ Do I need to know English?
          </button>
        </h2>
        <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faq5-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes. Basic English is required.<br>
            You must understand basic English to follow the lessons, complete forms, and communicate during your training.<br>
            We provide clear, simple lessons to make learning easy for everyone, even if English is your second language.
          </div>
        </div>
      </div>

      <!-- FAQ 6 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="faq6-heading">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
            🔒 How long do I have access to the course?
          </button>
        </h2>
        <div id="faq6" class="accordion-collapse collapse" aria-labelledby="faq6-heading" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Once enrolled, you receive <strong>lifetime access</strong> to:
            <ul>
              <li>All course materials and updates</li>
              <li>Our private Telegram support group</li>
              <li>Weekly mentorship sessions and community support</li>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <div class="text-center mt-5">
      <p>Still have questions?<br>
        📩 <strong><a href="{{ route('front.contact_us') }}">Contact us</a></strong> or join our Telegram group to speak directly with a mentor.
      </p>
    </div>
  </div>
</section>


                        <ul class="list-group list-group-numbered">
                            {{-- <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">What You Get</div>
                                    <p class="text-muted mb-0">Original price $297, now only $80.
                                        You’ll get full access to:
                                        <p>Video course, Audio course, Downloadable eBook, Covers all topics: General Knowledge, Air Brakes, Combination, Hazmat (H), Tanker (N), Doubles & Triples (T), Passenger (P), School Bus (S), Tanker + Hazmat (X)</p>
                                         
                                    <!-- <ul>
                                        <li>Video course</li>
                                        <li>Audio course</li>
                                        <li>Downloadable eBook</li>
                                        <li>Covers all topics:
                                            <ul>
                                                <li>General Knowledge</li>
                                                <li>Air Brakes</li>
                                                <li>Combination</li>
                                                <li>Hazmat (H)</li>
                                                <li>Tanker (N)</li>
                                                <li>Doubles & Triples (T)</li>
                                                <li>Passenger (P)</li>
                                                <li>School Bus (S)</li>
                                                <li>Tanker + Hazmat (X)</li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                    </p>
                                </div>
                            </li> --}}
                           {{-- <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Proven Method</div>
                                    <p class="text-muted mb-0">Our study method is simple and guaranteed.
                                        You’ll get one question and one correct answer—no confusing multiple-choice options.
                                        Everyone who purchased our course has passed their test.</p>
                                </div>
                            </li> --}}
                            {{-- <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Get Started Now</div>
                                    <p class="text-muted mb-0">This is your first step to becoming a CDL driver. Join
                                        thousands who’ve passed with our guide. Study at your own pace and pass with
                                        confidence—guaranteed..</p>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </section>


    </main>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".hero-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    animateOut: 'fadeOut',
                    dots: true,
                    nav: true, // Enable navigation arrows
                    navText: ["<i class='bi bi-chevron-left'></i>",
                        "<i class='bi bi-chevron-right'></i>"
                    ], // Bootstrap Icons
                });
            });
        </script>
    @endpush
@endsection
