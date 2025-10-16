@extends('partials.master')

@push('styles')
<style>
    .how-it-works-hero {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .how-it-works-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><path d="M0 50 Q 25 25, 50 50 T 100 50" stroke="rgba(255,255,255,0.1)" fill="none" stroke-width="2"/></svg>');
        opacity: 0.3;
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
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        max-width: 800px;
        margin: 0 auto 30px;
        line-height: 1.6;
        opacity: 0.95;
    }

    .telegram-badge {
        background: white;
        color: #198754;
        padding: 12px 24px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin-top: 10px;
    }

    .step-timeline {
        position: relative;
        padding: 80px 0;
    }

    .step-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(25, 135, 84, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        position: relative;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
    }

    .step-number {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(255, 193, 7, 0.3);
    }

    .step-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin: 40px 0;
    }

    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        border: 2px solid #f8f9fa;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        border-color: #198754;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 20px;
        color: white;
    }

    .process-section {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        padding: 80px 0;
    }

    .info-box {
        background: linear-gradient(135deg, #e7f5ec 0%, #d1e7dd 100%);
        border-left: 5px solid #ffc107;
        padding: 25px 30px;
        border-radius: 12px;
        margin: 40px 0;
    }

    .info-box-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .benefits-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin: 30px 0;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .benefit-icon {
        width: 40px;
        height: 40px;
        background: #198754;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .faq-section {
        padding: 80px 0;
        background: white;
    }

    .faq-item {
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 15px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        border-color: #198754;
    }

    .faq-question {
        padding: 20px 25px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none;
    }

    .faq-answer {
        padding: 0 25px 20px;
        display: none;
        color: #6c757d;
        line-height: 1.7;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    .faq-toggle {
        width: 30px;
        height: 30px;
        background: #198754;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-toggle {
        transform: rotate(45deg);
    }

    .cta-section {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        padding: 60px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        .how-it-works-hero {
            padding: 60px 0 50px;
        }

        .step-card {
            padding: 30px 20px;
        }

        .feature-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('main')
<main class="main">
    <!-- Hero Section -->
    <section class="how-it-works-hero text-white">
        <div class="container" data-aos="fade-up">
            <div class="text-center">
                <div class="hero-badge">
                    For applicants worldwide → U.S. & Canada
                </div>
                <h1 class="hero-title">How USTruckPath Works</h1>
                <p class="hero-subtitle">
                    Wherever you live today, if your goal is to drive a truck in the
                    <strong>United States</strong> or <strong>Canada</strong>, we give you the roadmap,
                    training, and daily mentorship to make it real – step by step
                    from your country to your first job, and beyond.
                </p>
                <div class="telegram-badge">
                    <i class="bi bi-telegram"></i>
                    <span>Private Telegram Mentorship</span>
                    <span class="text-muted">• Join after purchase</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple 3-Step Process -->
    <section class="step-timeline">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-success mb-3">Your Journey in 3 Simple Steps</h2>
                <p class="lead text-muted">From enrollment to employment – we guide you through every stage</p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card text-center h-100">
                        <div class="step-number mx-auto">1</div>
                        <div class="step-icon">🚀</div>
                        <h3 class="h4 fw-bold mb-3">Start Your U.S. Trucking Journey Today</h3>
                        <p class="text-muted">
                            No matter where you live — Canada, Europe, Africa, or the Middle East — this is your chance to begin a real trucking career in the United States. Our online course and mentorship are designed by industry experts who have already helped hundreds of drivers make it here.
                        </p>
                        <p class="text-muted fw-bold mb-0">Limited-time promotion: Enroll now and secure your spot at a discounted price!</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card text-center h-100">
                        <div class="step-number mx-auto">2</div>
                        <div class="step-icon">💬</div>
                        <h3 class="h4 fw-bold mb-3">Get Daily Guidance From Our Mentors</h3>
                        <p class="text-muted">
                            After you enroll, you'll be added instantly to our private Telegram group, where our experienced team will support you every single day.
                        </p>
                        <p class="text-muted mb-0">
                            We'll help you fix your CV, guide you through the visa process, and answer every question so you never feel lost. You'll have step-by-step support until you're job-ready.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card text-center h-100">
                        <div class="step-number mx-auto">3</div>
                        <div class="step-icon">🎯</div>
                        <h3 class="h4 fw-bold mb-3">Land Your Dream Job in the USA or Canada</h3>
                        <p class="text-muted">
                            Once you complete your training, we'll help you apply to top U.S. trucking companies. We prepare you for interviews, help with documentation, and make sure you're ready for the move.
                        </p>
                        <p class="text-muted fw-bold mb-0">With our guidance, you'll be confident and fully prepared to succeed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You Get Section -->
    <section class="process-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-success mb-3">Everything You Need in One Place</h2>
                <p class="lead text-muted">Comprehensive support from start to finish</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="feature-icon">🎯</div>
                    <h4 class="fw-bold mb-2">Company Connections</h4>
                    <p class="text-muted mb-0">We help you apply to trusted U.S. trucking companies and prepare for interviews — so you can land your first trucking job fast.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="150">
                    <div class="feature-icon">✈️</div>
                    <h4 class="fw-bold mb-2">Get Your U.S. Visa Approved</h4>
                    <p class="text-muted mb-0">From forms to references, we'll guide you step by step to complete your visa process and start your new life in the USA.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="feature-icon">🌍</div>
                    <h4 class="fw-bold mb-2">Global Pathway</h4>
                    <p class="text-muted mb-0">Whether you're in Africa, Europe, Canada, or the Middle East, we'll show you the exact path to start your U.S. trucking career.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="250">
                    <div class="feature-icon">💬</div>
                    <h4 class="fw-bold mb-2">Private Telegram Group</h4>
                    <p class="text-muted mb-0">Get daily help and answers directly from our mentors. You'll never feel alone — we're with you every step.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="feature-icon">🚛</div>
                    <h4 class="fw-bold mb-2">CDL Permit Prep</h4>
                    <p class="text-muted mb-0">Learn online with easy videos and practice tests to pass your CDL permit fast and get ready for driving in the U.S.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="350">
                    <div class="feature-icon">💼</div>
                    <h4 class="fw-bold mb-2">Business Guidance</h4>
                    <p class="text-muted mb-0">Go beyond driving — learn how to start and grow your own trucking company once you're on the road.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="400">
                    <div class="feature-icon">🎓</div>
                    <h4 class="fw-bold mb-2">Lifetime Mentorship Access</h4>
                    <p class="text-muted mb-0">Enroll once and get lifetime support — our team will always be here to help you grow and succeed.</p>
                </div>

                <div class="feature-card" data-aos="zoom-in" data-aos-delay="450">
                    <div class="feature-icon">⚡</div>
                    <h4 class="fw-bold mb-2">Limited-Time Promotion</h4>
                    <p class="text-muted mb-0">Enroll now and save big! This offer is only available for a short time — secure your discounted spot today.</p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box" data-aos="fade-up">
                <div class="info-box-icon">💡</div>
                <h4 class="fw-bold mb-3">What Happens After Purchase?</h4>
                <p class="mb-0">
                    After you purchase, you unlock comprehensive lessons that explain trucking in
                    <strong>the U.S. and Canada</strong> step by step. You're then added to our
                    <strong>private Telegram mentorship</strong> for daily support while still in your country—
                    helping with your <strong>CV</strong>, company applications, interviews, <strong>visa</strong>
                    process, and CDL training until your first job. Later, we even guide you on how to
                    <strong>run your own trucking business</strong>.
                </p>
            </div>

            <!-- Benefits List -->
            <div class="benefits-list" data-aos="fade-up">
                <div class="benefit-item">
                    <div class="benefit-icon">✅</div>
                    <span>Designed for newcomers</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🌐</div>
                    <span>Works from any country</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🧭</div>
                    <span>Clear roadmap</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🤝</div>
                    <span>Real mentors</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">🚚</div>
                    <span>Training to license</span>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">📈</div>
                    <span>Business guidance</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-success mb-3">Frequently Asked Questions</h2>
                <p class="lead text-muted">Got questions? We've got answers</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item" data-aos="fade-up">
                        <div class="faq-question">
                            <span>Who is this program for?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            Anyone outside the U.S. or Canada who wants to become a professional truck driver with a guided path.
                            Whether you're completely new to trucking or looking to transition to driving in North America,
                            our program is designed to help you succeed.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="50">
                        <div class="faq-question">
                            <span>What do I get after purchase?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            Immediate access to the complete course including video lessons, study materials, and guides.
                            You'll also receive a private Telegram mentorship invite for daily support, CV review,
                            interview preparation, and ongoing guidance until you land your first trucking job.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="faq-question">
                            <span>Do I need previous trucking experience?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            No experience required! We start from the basics and coach you through every step including
                            permits, training, visa applications, company research, and job applications.
                            Our program is specifically designed for beginners.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="150">
                        <div class="faq-question">
                            <span>How long does the process take?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            The timeline varies depending on your starting point and visa processing times.
                            Most students complete the course materials within 4-8 weeks, but you'll have lifetime access.
                            Our mentors will help you create a personalized timeline based on your specific situation.
                        </div>
                    </div>

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-question">
                            <span>Will you help me find a job?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            Yes! We provide a curated list of trucking companies actively hiring international drivers,
                            help you prepare your application materials, conduct mock interviews, and guide you through
                            the entire job application process until you secure your first position.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-white">
        <div class="container position-relative" data-aos="zoom-in">
            <h2 class="display-5 fw-bold mb-3">Ready to Start Your Journey?</h2>
            <p class="lead mb-4">Join hundreds of aspiring truck drivers who are already on their path to success</p>
            <a href="{{ route('front.course') }}" class="btn btn-warning btn-lg fw-bold px-5 py-3 rounded-pill">
                Enroll Now & Get Started
            </a>
        </div>
    </section>
</main>

@push('scripts')
<script>
    // FAQ Toggle
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const item = question.parentElement;
            const isActive = item.classList.contains('active');

            // Close all items
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));

            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
</script>
@endpush
@endsection
