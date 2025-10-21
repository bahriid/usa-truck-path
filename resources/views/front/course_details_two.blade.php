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

        .why-info-p{
            max-width: 1000px;
            margin: 0 auto;
            text-align: center
        }
    </style>
@endpush

@section('main')
    <main class="main">



        <section class="course-hero"
            style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%; background-repeat:no-repeat;  padding: 100px 0; position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;"></div>
            <div class="container" style="position: relative; z-index: 1;">
                <div class="row align-items-center">
                    <div class="col-md-8 text-white">
                        <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">
                            {{ $course->title }}</h1>
                        <p class="lead mb-4">
                            {{ $course->short_description ?? 'Unlock your potential with our comprehensive truck driving course.' }}
                        </p>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                        class="text-white text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" style="  color:var(--accent-color);" aria-current="page">
                                    {{ $course->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-4 text-md-end button-section">
                        @guest
                            <a href="{{ route('login') }}" class="cta-btn">Login to Enroll</a>
                        @else
                            @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="btn btn-success " disabled>Already Enrolled</button>
                            @else
                                @if ($course->status === 'upcoming')
                                    <button class="btn btn-secondary " disabled>Up Coming</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                    <button class="btn btn-info  w-100" disabled>Request Pending...</button>
                                @else
                                    <a href="{{ route('stripe.payment.view', $course->id) }}" class="cta-btn">Enroll Now</a>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>


        <div class="pricing-head">
            <h2 class="mt-4">Choose Your Plan</h2>

        </div>
        {{-- <h2 class="pricing-heading">Choose Your Plan!</h2> --}}
        <section class="pricing-section mt-4 row justify-content-center ">
            <div class="col-md-6 img-container">

                {{-- <div class="text-center mb-3"> --}}
                <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}"
                    class="img-fluid rounded object-fit-cover mb-3">
                {{-- </div> --}}
            </div>

            <div class="col-md-6">

                <h4 class="mb-3 text-center">This Course Includes:</h4>

                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-people me-2"></i>
                        <strong class="me-1">students:</strong>
                        <span>{{ $course->students->count() }} </span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-journal-bookmark me-2"></i>
                        <strong class="me-1">lessons:</strong>
                        <span>{{ $course->chapters->count() }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-list-task me-2"></i>
                        <strong class="me-1">Topics:</strong>
                        <span>{{ $course->chapters->sum(fn($ch) => $ch->topics->count()) }}</span>
                    </li>
                </ul>

                <div class="text-center">
                    <h5 class="mb-3">
                        <strong>Price:</strong> ${{ $course->price }}
                    </h5>

                    @guest
                        <a href="{{ route('login') }}" class="cta  mb-2">Login to Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="cta   mb-2" disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="cta   mb-2" disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <button class="cta  mb-2" disabled>Request Pending...</button>
                            @else
                                <a href="{{ route('stripe.payment.view', $course->id) }}" class="cta w-100">Enroll
                                    Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>

        </section>

        <section class="course-details py-5">
            <div class="container mx-auto">
                <div class="row">

                    <!-- Left Column: Description + Curriculum -->
                    <div class="col-lg-12 mb-5">

                        <div class="row g-4  align-items-center">
                            <div class="col-md-6 p-4 d-flex flex-column justify-content-between about-back">
                                <div>

                                    <h2 class="card-title mb-3 fw-bold" style="color: var(--heading-color)">About This
                                        Course
                                    </h2>
                                    <p class="card-subtitle text-muted mb-3">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ \Carbon\Carbon::parse($course->created_at ?? '')->format('l, F jS  ') }}
                                    </p>
                                    <p class="card-text lead text-secondary">{!! $course->description !!}</p>
                                </div>
                                <div class="mt-4 ">
                                    @guest
                                        <a href="{{ route('login') }}" class="cta-btn-course  mb-2"> Enroll</a>
                                    @else
                                        @if (auth()->user()->hasApprovedCourse($course->id))
                                            <button class="cta-btn-course  mb-2" disabled>Already Enrolled</button>
                                        @else
                                            @if ($course->status === 'upcoming')
                                                <button class="cta-btn-course mb-2" disabled>Up Coming</button>
                                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                                <button class="cta-btn-course  mb-2" disabled>Request Pending...</button>
                                            @else
                                                <a href="{{ route('stripe.payment.view', $course->id) }}"
                                                    class="cta-btn-course mb-2 ">Enroll
                                                    Now</a>
                                            @endif
                                        @endif
                                    @endguest
                                </div>
                            </div>
                            <div class="col-md-6   ">
                                <div class="h-100 overflow-hidden">

                                    <img src="{{ asset('frontend/img/training.jpg') }}" alt="Course Image"
                                        class="img-fluid object-fit-cover rounded h-100 shadow-md">
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>

        </section>

        <section class="why-choose-us py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2 class="fw-bold text-primary mb-3">Why Choose USA Truck Path?</h2>
                            <p class="lead text-muted">Your Fast-Track to a Truck Driving Career Starts Here
                                We empower future truck drivers with an easy, effective, and guaranteed way to pass the DMV
                                exam—regardless of language or background.</p>
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
                                <h5 class="fw-semibold mb-2">Multilingual Learning System</h5>
                                <p class="text-muted small">Study in your preferred language—English, Arabic, Somali,
                                    Amharic, French, or Nepali—with complete support for non-native speakers.
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
                                <p class="text-muted small">Our course includes the actual test format and questions used
                                    by DMVs across all states, ensuring you’re fully prepared.
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
                                <h5 class="fw-semibold mb-2">All-in-One Multimedia Course</h5>
                                <p class="text-muted small">Access video classes, eBooks, and audio lessons for a rich and
                                    engaging learning experience tailored to different learning styles.</p>
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
                                <h5 class="fw-semibold mb-2">100% Pass Guarantee</h5>
                                <p class="text-muted small">We’re so confident in our system that we guarantee you’ll pass
                                    your DMV test on the first try—or get extended access for free.
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
                                <h5 class="fw-semibold mb-2">Learn at Your Own Pace</h5>
                                <p class="text-muted small">Whether you have a full-time job or a busy life, our platform
                                    lets you study anytime, anywhere—on any device.</p>
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
                                <h5 class="fw-semibold mb-2">Built for Future Truckers</h5>
                                <p class="text-muted small">We specialize in helping aspiring CDL truck drivers—so you’re
                                    not just passing a test, you’re preparing for a career on the road.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="why-info bg-light py-5">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class=" ">
                        <h2 class="fw-bold text-primary mb-3 text-center">Interested in Preparing for Your CDL Permit Exam?</h2>
                        <p class="text-muted why-info-p">
                            Are you ready to start your journey toward becoming a professional truck driver? Our CDL permit training courses are designed to help students pass their commercial learner's permit (CLP) exams with ease. We provide comprehensive courses that teach all the questions and exact answers found on the CDL permit tests. Our courses are available in multiple languages, including English, Arabic, French, Amharic, Somali, and Nepali—making it easier for students from all backgrounds to succeed
                        </p>
                        <p class="text-muted text-center mb-0 mt-2" style="font-weight: 700; font-size:2rem; ">Here's what you need to do to get started:</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Registration by Filling Your Details</div>
                                    <p class="text-muted mb-0">Begin the process by providing your information through our student enrollment form. This ensures we have the necessary details to get you started with the training.</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Paying for the Course</div>
                                    <p class="text-muted mb-0">Secure your spot in the online course by completing the payment.  You'll also create your login credentials, giving you access to the training materials.</p>
                                </div>
                            </li>
                            <li class="list-group-item d-flex   align-items-start">
                                <div class="ms-2">
                                    <div class="fw-bold">Accessing the Course</div>
                                    <p class="text-muted mb-0">Once payment is confirmed, you'll receive an email with your Certificate of Completion.  Within one business day, we will submit your completion to the FMCSA's Training Provider Registry (TPR).</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        


        <section class="row container mx-auto">
            <div class="col-lg-12">
                <div class="course-curriculum">
                    <h3 class="mb-3">Course Curriculum</h3>
                    <div class="accordion" id="curriculumAccordion">
                        @php
                            $chapters = $course->chapters;
                            $chapters = $chapters->sortBy('order');
                        @endphp

                        @forelse ($chapters as $index => $chapter)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="chapterHeading{{ $index }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chapterCollapse{{ $index }}" aria-expanded="false"
                                        aria-controls="chapterCollapse{{ $index }}">
                                        {{ $chapter->title }}
                                    </button>
                                </h2>
                                <div id="chapterCollapse{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="chapterHeading{{ $index }}"
                                    data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        @if ($chapter->topics->count() > 0)
                                            <ul class="list-group">
                                                @foreach ($chapter->topics as $topic)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $topic->title }}</strong>
                                                            @if ($topic->type === 'video')
                                                                <span class="badge bg-primary ms-2">Video</span>
                                                            @elseif ($topic->type === 'voice')
                                                                <span class="badge bg-info ms-2">Audio</span>
                                                            @elseif ($topic->type === 'pdf')
                                                                <span class="badge bg-warning ms-2">PDF</span>
                                                            @else
                                                                <span class="badge bg-success ms-2">Reading</span>
                                                            @endif
                                                        </div>

                                                        @php
                                                            $user = auth()->user();
                                                            $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                                        @endphp

                                                        @if ($hasAccess)
                                                            @if ($topic->type === 'voice' && $topic->voice)
                                                                <!-- Button to Open Modal -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#audioModal{{ $topic->id }}">
                                                                    <i class="bi bi-volume-up"></i>
                                                                    Play Audio
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="audioModal{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <!-- Audio Player -->
                                                                                <audio
                                                                                    id="audio-player-{{ $topic->id }}"
                                                                                    controls style="width: 100%;"
                                                                                    class="audio-player">
                                                                                    <source
                                                                                        src="{{ asset('storage/' . $topic->voice) }}"
                                                                                        type="audio/mpeg">
                                                                                    Your browser does not support
                                                                                    the audio tag.
                                                                                </audio>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'pdf' && $topic->pdf)
                                                                <!-- Open PDF in a new tab -->
                                                                <span>


                                                                    <a href="{{ asset('storage/' . $topic->pdf) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-file-earmark-pdf"></i> View
                                                                        PDF
                                                                    </a>

                                                                    <!-- Open PDF in Modal -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModal{{ $topic->id }}">
                                                                        <i class="bi bi-eye"></i> Preview PDF
                                                                    </button>
                                                                </span>
                                                                <!-- PDF Modal -->
                                                                <div class="modal fade" id="pdfModal{{ $topic->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe
                                                                                    src="{{ asset('storage/' . $topic->pdf) }}"
                                                                                    width="100%"
                                                                                    height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'video')
                                                                {{-- Check source (local, youtube, vimeo, etc.) --}}
                                                                @if ($topic->source_from === 'local' && $topic->local_video)
                                                                    <!-- Button to open a modal or new page with the Plyr player -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video

                                                                    </button>

                                                                    <!-- Modal with Plyr for local video -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <video
                                                                                        id="player-local-{{ $topic->id }}"
                                                                                        class="plyr__video-player" controls
                                                                                        style="width: 100%">
                                                                                        <source
                                                                                            src="{{ asset('storage/' . $topic->local_video) }}"
                                                                                            type="video/mp4">
                                                                                        Your browser does not
                                                                                        support the video tag.
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                                                    <!-- Use Plyr embed for YouTube -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <!-- Modal for embedded YouTube -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->video_url }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                                                    <!-- Similar embed logic for Vimeo -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->video_url }}"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If 'other' or no recognized source -->
                                                                    <a href="{{ $topic->video_url }}" target="_blank"
                                                                        class="btn btn-sm btn-outline-success"><i
                                                                            class="bi bi-play-circle"></i>Play
                                                                        Video</a>
                                                                @endif
                                                            @else
                                                                {{-- Reading type --}}
                                                                @if ($topic->description)
                                                                    <!-- If it's textual reading, you can show it in a modal or link to a PDF -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#readingModal{{ $topic->id }}">
                                                                        <i class="bi bi-book"></i>
                                                                        Open Reading
                                                                    </button>

                                                                    <!-- Modal for reading content -->
                                                                    <div class="modal fade"
                                                                        id="readingModal{{ $topic->id }}"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {!! $topic->description !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If it's a PDF stored locally, you can link or embed it. For example: -->
                                                                    <a href="{{ asset('storage/' . $topic->pdf_file) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">Open
                                                                        PDF</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <button class="btn btn-sm btn-secondary"
                                                                disabled>Locked</button>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">No topics in this chapter.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No chapters found for this course.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>



        <section class="testimonial-slider-section py-5 bg-white">
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
                                        <img src="https://avatar.iran.liara.run/public" alt="John Doe"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">John Doe</h6>
                                </div>
                                <p class="text-muted mb-3">"The instructors were incredibly knowledgeable and supportive. I
                                    felt well-prepared for my CDL exam and now have a great job thanks to their guidance."
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
                                        <img src="https://avatar.iran.liara.run/public/boy" alt="Alice Smith"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Alice Smith</h6>
                                </div>
                                <p class="text-muted mb-3">"The modern trucks and facilities made learning enjoyable. The
                                    flexible scheduling allowed me to balance my training with other commitments."</p>
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
                                        <img src="https://avatar.iran.liara.run/public" alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Bob Miller</h6>
                                </div>
                                <p class="text-muted mb-3">"I appreciated the supportive learning environment. The
                                    instructors were always willing to go the extra mile to ensure I understood everything."
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
                                        <img src="https://avatar.iran.liara.run/public" alt="Bob Miller"
                                            class="img-fluid w-100 h-100 object-cover">
                                    </div>
                                    <h6 class="fw-semibold mb-0">Bob Miller</h6>
                                </div>
                                <p class="text-muted mb-3">"I appreciated the supportive learning environment. The
                                    instructors were always willing to go the extra mile to ensure I understood everything."
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


        <div class="pricing-head">
            <h2 class="mt-4">Choose Your Plan</h2>

        </div>
        {{-- <h2 class="pricing-heading">Choose Your Plan!</h2> --}}
        <section class="pricing-section mt-4 row justify-content-center ">
            <div class="col-md-6 img-container">

                {{-- <div class="text-center mb-3"> --}}
                <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}"
                    class="img-fluid rounded object-fit-cover mb-3">
                {{-- </div> --}}
            </div>

            <div class="col-md-6">

                <h4 class="mb-3 text-center">This Course Includes:</h4>

                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-people me-2"></i>
                        <strong class="me-1">students:</strong>
                        <span>{{ $course->students->count() }} </span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-journal-bookmark me-2"></i>
                        <strong class="me-1">lessons:</strong>
                        <span>{{ $course->chapters->count() }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-list-task me-2"></i>
                        <strong class="me-1">Topics:</strong>
                        <span>{{ $course->chapters->sum(fn($ch) => $ch->topics->count()) }}</span>
                    </li>
                </ul>

                <div class="text-center">
                    <h5 class="mb-3">
                        <strong>Price:</strong> ${{ $course->price }}
                    </h5>

                    @guest
                        <a href="{{ route('login') }}" class="cta w-100 mb-2">Login to Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="cta w-100 mb-2" disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="cta w-100 mb-2" disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <button class="cta w-100 mb-2" disabled>Request Pending...</button>
                            @else
                                <a href="{{ route('stripe.payment.view', $course->id) }}"
                                    class="btn btn-primary w-100">Enroll
                                    Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>

        </section>
        <!-- Main Course Content Section -->

    </main>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const players = Array.from(document.querySelectorAll('.plyr__video-player, .plyr__video-embed'))
                    .map((p) => new Plyr(p));


            });
        </script>

        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const players = Plyr.setup('.audio-player');
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pause audio when the modal is closed
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.addEventListener('hidden.bs.modal', function() {
                        let audio = modal.querySelector('audio');
                        if (audio) {
                            audio.pause();
                            audio.currentTime = 0; // Reset audio
                        }
                    });
                });
            });

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
