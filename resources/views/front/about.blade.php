@extends('partials.master')

@push('styles')
    <style>
        .hero-banner {
            background-color: #28a745;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        .hero-banner h1 {
            font-size: 2.8rem;
            font-weight: bold;
        }
        .hero-banner p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .about-section {
            padding: 60px 0;
        }

        .section-heading {
            font-size: 1.8rem;
            color: #28a745;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .underline {
            width: 50px;
            height: 4px;
            background-color: #28a745;
            margin-bottom: 1.5rem;
        }

        .about-icon-list li {
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .about-icon-list li i {
            margin-right: 0.6rem;
            color: #28a745;
        }

        @media (max-width: 768px) {
            .hero-banner h1 {
                font-size: 2rem;
            }
            .hero-banner p {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('main')
<main class="main">

    <!-- Hero Banner Section -->
    <!-- <section class="hero-banner">
        <div class="container">
            <h1>Why Choose Us</h1>
            <p>Pass Your Permit is a leading platform helping students pass their permit tests confidently. Learn from experience. Grow with integrity.</p>
        </div>
    </section> -->

     <!-- Page Title -->
     <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Why Choose us<br></h1>
                            <p class="mb-0">USTRUCKPATH helps people worldwide become truck drivers in the USA and Canada. Our step-by-step courses, mentorship, and support community give you the knowledge and guidance to start your trucking career with confidence.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Why Choose us<br></li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

    <!-- About Content -->
    <section class="about-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <h2 class="section-heading">About Us</h2>
                    <div class="underline"></div>
                    <p>Welcome to our trucking education platform — built on real industry experience and a mission to guide new drivers and future owner‑operators from their first permit all the way to financial freedom.</p>

                    <h3 class="mt-4 section-heading">Who We Are</h3>
                    <div class="underline"></div>
                    <p>My name is Idris, and I’ve spent over 10 years in the trucking industry. I founded four trucking schools in Ohio, Utah, Michigan, and Minnesota, training over 10,000 students.</p>
                    <p>Born in Somalia and raised in a refugee camp, I came to the U.S. with resilience and a mission: to help others succeed without wasting money or hope.</p>

                    <h3 class="mt-4 section-heading">Our Mission</h3>
                    <div class="underline"></div>
                    <ul class="list-unstyled about-icon-list">
                        <li><i class="bi bi-check-circle-fill"></i> Help students earn their permit and CDL license</li>
                        <li><i class="bi bi-check-circle-fill"></i> Teach how to buy the right truck and become owner‑operators</li>
                        <li><i class="bi bi-check-circle-fill"></i> Provide knowledge on dispatching and running a trucking business</li>
                        <li><i class="bi bi-check-circle-fill"></i> Protect students from scams and false promises</li>
                        <li><i class="bi bi-check-circle-fill"></i> Guide them toward long‑term success in the industry</li>
                    </ul>

                    <h3 class="mt-4 section-heading">Why We Built These Courses</h3>
                    <div class="underline"></div>
                    <p>Too many immigrants and people overseas lose thousands of dollars to scams and fake promises. That's why we created affordable, high value courses that deliver 100x more value than their cost. Students learn steps like resume building, applying to trusted companies, and avoiding costly mistakes.</p>

                    <h3 class="mt-4 section-heading">Our Vision</h3>
                    <div class="underline"></div>
                    <p>We aim to reach students worldwide — from Africa and the Middle East to Canada and Europe. Our vision is to educate globally, provide tools for success, and help families achieve financial freedom through trucking careers.</p>

                    <h3 class="mt-4 section-heading">More Than Business</h3>
                    <div class="underline"></div>
                    <p>This is personal to me. I go live on TikTok daily to share knowledge and answer questions. Students join our Telegram group, where I share trusted trucking company connections. We’re building more than a platform — we’re building support, trust, and community.</p>

                    <h3 class="mt-4 section-heading">Our Beginning</h3>
                    <div class="underline"></div>
                    <p>Our journey started with <strong>CDLCity.com</strong>, my first trucking school. From there we expanded to multiple states, built courses, and grew globally. Today, our platform trains students worldwide with the same commitment to quality and honesty.</p>
                    <ul class="list-unstyled about-icon-list">
                        <li><i class="bi bi-building"></i> 4 trucking schools founded</li>
                        <li><i class="bi bi-people-fill"></i> 10,000+ students trained</li>
                        <li><i class="bi bi-globe"></i> Courses changing lives in many countries</li>
                    </ul>

                    <h3 class="mt-4 section-heading">Who I Am</h3>
                    <div class="underline"></div>
                    <ul class="list-unstyled about-icon-list">
                        <li><i class="bi bi-geo-alt-fill"></i> Originally from Somalia</li>
                        <li><i class="bi bi-house-fill"></i> Now an American citizen in Columbus, Ohio</li>
                        <li><i class="bi bi-heart-pulse"></i> Someone who lived through hardship and success, now helping others build theirs</li>
                    </ul>

                    <h3 class="mt-4 section-heading">Let’s Build Your Future</h3>
                    <div class="underline"></div>
                    <p>You don’t have to do this alone. We are here to teach, guide, and give you everything you need for long‑term success in the trucking industry — wherever you are in the world.</p>
                    <p><strong>Join us today and start building your future.</strong></p>

                </div>
            </div>
        </div>
    </section>

@endsection
