@extends('partials.master')

@push('styles')
<style>
    .why-hero {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .why-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
        opacity: 0.2;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        font-size: 0.9rem;
    }

    .why-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .why-hero p {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.7;
        opacity: 0.95;
    }

    .story-section {
        padding: 80px 0;
        background: white;
    }

    .story-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border-left: 5px solid #ffc107;
    }

    .founder-intro {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding: 25px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .founder-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        flex-shrink: 0;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin: 60px 0;
    }

    .mission-card {
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .mission-card:hover {
        transform: translateY(-5px);
        border-color: #198754;
        box-shadow: 0 10px 35px rgba(25, 135, 84, 0.15);
    }

    .mission-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(255, 193, 7, 0.3);
    }

    .stats-section {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 80px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .stat-card {
        text-align: center;
        padding: 30px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        color: #ffc107;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 600;
        opacity: 0.95;
    }

    .values-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
    }

    .value-item {
        display: flex;
        gap: 20px;
        padding: 30px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .value-item:hover {
        transform: translateX(10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .value-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 800;
        color: #198754;
        margin-bottom: 15px;
    }

    .section-title p {
        font-size: 1.2rem;
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
    }

    .highlight-box {
        background: linear-gradient(135deg, #e7f5ec 0%, #d1e7dd 100%);
        border-left: 5px solid #198754;
        padding: 30px;
        border-radius: 12px;
        margin: 40px 0;
    }

    .highlight-box h4 {
        color: #198754;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .cta-box {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 20px;
        text-align: center;
        margin-top: 60px;
        box-shadow: 0 15px 50px rgba(25, 135, 84, 0.3);
    }

    .cta-box h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .cta-box p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.95;
    }

    @media (max-width: 768px) {
        .why-hero {
            padding: 60px 0 50px;
        }

        .story-card {
            padding: 30px 25px;
        }

        .founder-intro {
            flex-direction: column;
            text-align: center;
        }

        .mission-grid {
            grid-template-columns: 1fr;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('main')
<main class="main">
    <!-- Hero Section -->
    <section class="why-hero text-white">
        <div class="container position-relative" data-aos="fade-up">
            <div class="text-center">
                <div class="hero-badge">
                    Built on 10+ Years of Real Experience
                </div>
                <h1>Why Drivers Choose Us</h1>
                <p>
                    USATRUCKPATH helps people worldwide become truck drivers in the USA and Canada.
                    Our step-by-step courses, real mentorship, and support community give you the
                    knowledge and guidance to start your trucking career with confidence.
                </p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="story-card" data-aos="fade-up">
                <div class="founder-intro">
                    <div class="founder-icon">👨‍💼</div>
                    <div>
                        <h3 class="mb-2 fw-bold">Meet Idris, Our Founder</h3>
                        <p class="mb-0 text-muted">10+ Years in Trucking | 4 Schools Founded | 10,000+ Students Trained</p>
                    </div>
                </div>

                <h3 class="fw-bold text-success mb-3">Our Story</h3>
                <p class="lead mb-4">
                    Welcome to our trucking education platform — built on real industry experience and a
                    mission to guide new drivers and future owner-operators from their first permit all the
                    way to financial freedom.
                </p>

                <p>
                    My name is Idris, and I've spent over 10 years in the trucking industry. I founded four
                    trucking schools in Ohio, Utah, Michigan, and Minnesota, training over 10,000 students.
                </p>

                <p>
                    Born in Somalia and raised in a refugee camp, I came to the U.S. with resilience and a
                    mission: to help others succeed without wasting money or hope.
                </p>

                <div class="highlight-box mt-4">
                    <h4><i class="bi bi-lightbulb-fill"></i> Why We Built These Courses</h4>
                    <p class="mb-0">
                        Too many immigrants and people overseas lose thousands of dollars to scams and fake promises.
                        That's why we created affordable, high-value courses that deliver 100x more value than their cost.
                        Students learn steps like resume building, applying to trusted companies, and avoiding costly mistakes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container position-relative">
            <div class="section-title text-white mb-5" data-aos="fade-up">
                <h2 class="text-white">Our Impact in Numbers</h2>
                <p class="text-white opacity-75">Real results from real commitment</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">4</div>
                        <div class="stat-label">Trucking Schools Founded</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Students Trained</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Years of Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Our Mission & Values</h2>
                <p>Everything we do is guided by these core principles</p>
            </div>

            <div class="mission-grid">
                <div class="mission-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="mission-icon">🎓</div>
                    <h4 class="fw-bold mb-3">Education First</h4>
                    <p class="text-muted mb-0">
                        Help students earn their permit and CDL license with comprehensive, easy-to-follow training materials
                    </p>
                </div>

                <div class="mission-card" data-aos="fade-up" data-aos-delay="150">
                    <div class="mission-icon">🚚</div>
                    <h4 class="fw-bold mb-3">Owner-Operator Path</h4>
                    <p class="text-muted mb-0">
                        Teach how to buy the right truck and become successful owner-operators with smart business decisions
                    </p>
                </div>

                <div class="mission-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="mission-icon">💼</div>
                    <h4 class="fw-bold mb-3">Business Knowledge</h4>
                    <p class="text-muted mb-0">
                        Provide complete knowledge on dispatching, compliance, and running a profitable trucking business
                    </p>
                </div>

                <div class="mission-card" data-aos="fade-up" data-aos-delay="250">
                    <div class="mission-icon">🛡️</div>
                    <h4 class="fw-bold mb-3">Scam Protection</h4>
                    <p class="text-muted mb-0">
                        Protect students from scams and false promises by providing honest, transparent guidance
                    </p>
                </div>

                <div class="mission-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="mission-icon">🌟</div>
                    <h4 class="fw-bold mb-3">Long-Term Success</h4>
                    <p class="text-muted mb-0">
                        Guide students toward sustainable, long-term success in the trucking industry
                    </p>
                </div>

                <div class="mission-card" data-aos="fade-up" data-aos-delay="350">
                    <div class="mission-icon">🌍</div>
                    <h4 class="fw-bold mb-3">Global Reach</h4>
                    <p class="text-muted mb-0">
                        Reach students worldwide from Africa, Middle East, Canada, Europe and help families achieve financial freedom
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="story-section bg-light">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>What Makes Us Different</h2>
                <p>More than just a platform — we're building a community</p>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="value-item" data-aos="fade-right" data-aos-delay="100">
                        <div class="value-icon">💬</div>
                        <div>
                            <h5 class="fw-bold mb-2">Daily Live Support</h5>
                            <p class="text-muted mb-0">
                                I go live on TikTok daily to share knowledge and answer questions. This is personal to me —
                                I'm committed to helping you succeed every single day.
                            </p>
                        </div>
                    </div>

                    <div class="value-item" data-aos="fade-right" data-aos-delay="150">
                        <div class="value-icon">👥</div>
                        <div>
                            <h5 class="fw-bold mb-2">Real Community</h5>
                            <p class="text-muted mb-0">
                                Students join our Telegram group where I share trusted trucking company connections.
                                We're building support, trust, and a real community of drivers helping each other.
                            </p>
                        </div>
                    </div>

                    <div class="value-item" data-aos="fade-right" data-aos-delay="200">
                        <div class="value-icon">🏆</div>
                        <div>
                            <h5 class="fw-bold mb-2">Proven Track Record</h5>
                            <p class="text-muted mb-0">
                                Our journey started with CDLCity.com, my first trucking school. From there we expanded to
                                multiple states and now train students globally with the same commitment to quality and honesty.
                            </p>
                        </div>
                    </div>

                    <div class="value-item" data-aos="fade-right" data-aos-delay="250">
                        <div class="value-icon">❤️</div>
                        <div>
                            <h5 class="fw-bold mb-2">Personal Mission</h5>
                            <p class="text-muted mb-0">
                                As someone who lived through hardship and success, I understand the journey.
                                I'm here to help you build your future — wherever you are in the world.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cta-box" data-aos="zoom-in">
                <h3>Let's Build Your Future Together</h3>
                <p>You don't have to do this alone. We are here to teach, guide, and give you everything
                   you need for long-term success in the trucking industry.</p>
                <a href="{{ route('login') }}" class="btn btn-warning btn-lg fw-bold px-5 py-3 rounded-pill">
                    Join Us Today & Start Your Journey
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Get in Touch</h2>
                <p>Have questions? We're here to help you start your trucking journey</p>
            </div>

            <!-- Map -->
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);">
                <iframe style="border:0; width: 100%; height: 400px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11967.737352649469!2d-82.9987942!3d39.9611755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88388f3b93db6a9b%3A0x18c340da05d4a70e!2sColumbus%2C%20OH%2C%20USA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                    frameborder="0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="row gy-4">
                <!-- Contact Info -->
                <div class="col-lg-4">
                    <div class="value-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Address</h5>
                            <p class="text-muted mb-0">{{ $setting->address ?? '' }}</p>
                        </div>
                    </div>

                    <div class="value-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="value-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Call Us</h5>
                            <p class="text-muted mb-0">{{ $setting->contact_phone ?? '' }}</p>
                        </div>
                    </div>

                    <div class="value-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Email Us</h5>
                            <p class="text-muted mb-0">{{ $setting->contact_email ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div style="background: #f8f9fa; padding: 40px; border-radius: 20px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="fw-bold mb-4 text-success">Send Us a Message</h4>
                        <form action="{{ route('front.contact.send') }}" method="POST" class="php-email-form">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required style="padding: 15px; border-radius: 12px; border: 2px solid #e9ecef;">
                                    @error('name')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required style="padding: 15px; border-radius: 12px; border: 2px solid #e9ecef;">
                                    @error('email')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required style="padding: 15px; border-radius: 12px; border: 2px solid #e9ecef;">
                                    @error('subject')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Your Message" required style="padding: 15px; border-radius: 12px; border: 2px solid #e9ecef;"></textarea>
                                    @error('message')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-lg fw-bold px-5 py-3 rounded-pill w-100" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); border: none;">
                                        <i class="bi bi-send me-2"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
