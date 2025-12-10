@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-20 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('frontend/img/whitetruck.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-[#0A2342]/80"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block bg-white/20 border border-white/30 px-5 py-2 rounded-full font-semibold mb-4 backdrop-blur-sm text-sm">
                For applicants worldwide → U.S. & Canada
            </span>
            <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-tighter mb-4 text-[#F5B82E]">
                How USATruckPath Works
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed mb-6">
                Wherever you live today, if your goal is to drive a truck in the
                <strong>United States</strong> or <strong>Canada</strong>, we give you the roadmap,
                training, and daily mentorship to make it real – step by step
                from your country to your first job, and beyond.
            </p>
            <div class="inline-flex items-center gap-3 bg-white text-[#0A2342] px-6 py-3 rounded-full font-semibold shadow-lg">
                <i data-lucide="send" class="h-5 w-5 text-[#1B75F0]"></i>
                <span>Private Telegram Mentorship</span>
                <span class="text-gray-500">• Join after purchase</span>
            </div>
        </div>
    </section>

    <!-- 3-Step Process -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Your Journey in 3 Simple Steps</h2>
                <p class="text-gray-600">From enrollment to employment – we guide you through every stage</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Step 1 -->
                <div class="bg-[#F2F4F7] rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg text-2xl font-bold text-[#0A2342]">1</div>
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Start Your U.S. Trucking Journey Today</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        No matter where you live — Canada, Europe, Africa, or the Middle East — this is your chance to begin a real trucking career in the United States. Our online course and mentorship are designed by industry experts who have already helped hundreds of drivers make it here.
                    </p>
                    <p class="text-[#1B75F0] font-semibold text-sm">Limited-time promotion: Enroll now and secure your spot at a discounted price!</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-[#F2F4F7] rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg text-2xl font-bold text-[#0A2342]">2</div>
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Get Daily Guidance From Our Mentors</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        After you enroll, you'll be added instantly to our private Telegram group, where our experienced team will support you every single day.
                    </p>
                    <p class="text-gray-600 text-sm">
                        We'll help you fix your CV, guide you through the visa process, and answer every question so you never feel lost. You'll have step-by-step support until you're job-ready.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-[#F2F4F7] rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg text-2xl font-bold text-[#0A2342]">3</div>
                    <div class="text-4xl mb-4">🎯</div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">Land Your Dream Job in the USA or Canada</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Once you complete your training, we'll help you apply to top U.S. trucking companies. We prepare you for interviews, help with documentation, and make sure you're ready for the move.
                    </p>
                    <p class="text-[#1B75F0] font-semibold text-sm">With our guidance, you'll be confident and fully prepared to succeed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What You Get Section -->
    <section class="py-20 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Everything You Need in One Place</h2>
                <p class="text-gray-600">Comprehensive support from start to finish</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="target" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Company Connections</h4>
                    <p class="text-gray-600 text-sm">We help you apply to trusted U.S. trucking companies and prepare for interviews.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="plane" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">U.S. Visa Guidance</h4>
                    <p class="text-gray-600 text-sm">From forms to references, we'll guide you step by step to complete your visa process.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="globe" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Global Pathway</h4>
                    <p class="text-gray-600 text-sm">Whether you're in Africa, Europe, Canada, or the Middle East, we'll show you the exact path.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="message-circle" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Private Telegram Group</h4>
                    <p class="text-gray-600 text-sm">Get daily help and answers directly from our mentors. You'll never feel alone.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="truck" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">CDL Permit Prep</h4>
                    <p class="text-gray-600 text-sm">Learn online with easy videos and practice tests to pass your CDL permit fast.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="briefcase" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Business Guidance</h4>
                    <p class="text-gray-600 text-sm">Go beyond driving — learn how to start and grow your own trucking company.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="graduation-cap" class="h-8 w-8 text-white"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Lifetime Mentorship</h4>
                    <p class="text-gray-600 text-sm">Enroll once and get lifetime support — our team will always be here to help you grow.</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="zap" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Limited-Time Promotion</h4>
                    <p class="text-gray-600 text-sm">Enroll now and save big! This offer is only available for a short time.</p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="max-w-4xl mx-auto mt-12 bg-gradient-to-r from-[#1B75F0]/10 to-[#0A2342]/10 border-l-4 border-[#F5B82E] p-6 rounded-xl">
                <div class="flex items-start gap-4">
                    <i data-lucide="lightbulb" class="h-8 w-8 text-[#F5B82E] flex-shrink-0 mt-1"></i>
                    <div>
                        <h4 class="font-heading font-bold text-[#0A2342] mb-2">What Happens After Purchase?</h4>
                        <p class="text-gray-700">
                            After you purchase, you unlock comprehensive lessons that explain trucking in
                            <strong>the U.S. and Canada</strong> step by step. You're then added to our
                            <strong>private Telegram mentorship</strong> for daily support while still in your country—
                            helping with your <strong>CV</strong>, company applications, interviews, <strong>visa</strong>
                            process, and CDL training until your first job. Later, we even guide you on how to
                            <strong>run your own trucking business</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Benefits Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 max-w-5xl mx-auto mt-8">
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="check" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">For newcomers</span>
                </div>
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="globe" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Any country</span>
                </div>
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="compass" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Clear roadmap</span>
                </div>
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="users" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Real mentors</span>
                </div>
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="truck" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Training</span>
                </div>
                <div class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm">
                    <div class="w-10 h-10 bg-[#1B75F0] rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="trending-up" class="h-5 w-5 text-white"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Business tips</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600">Got questions? We've got answers</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="border-2 border-gray-100 rounded-xl overflow-hidden hover:border-[#1B75F0] transition-colors faq-item">
                    <button class="w-full px-6 py-4 flex items-center justify-between text-left bg-[#F2F4F7] hover:bg-gray-100 transition-colors" onclick="toggleFaq(this)">
                        <span class="font-semibold text-[#0A2342]">Who is this program for?</span>
                        <span class="w-8 h-8 bg-[#1B75F0] text-white rounded-full flex items-center justify-center font-bold transition-transform faq-toggle">+</span>
                    </button>
                    <div class="px-6 py-4 hidden faq-answer">
                        <p class="text-gray-600">Anyone outside the U.S. or Canada who wants to become a professional truck driver with a guided path. Whether you're completely new to trucking or looking to transition to driving in North America, our program is designed to help you succeed.</p>
                    </div>
                </div>

                <div class="border-2 border-gray-100 rounded-xl overflow-hidden hover:border-[#1B75F0] transition-colors faq-item">
                    <button class="w-full px-6 py-4 flex items-center justify-between text-left bg-[#F2F4F7] hover:bg-gray-100 transition-colors" onclick="toggleFaq(this)">
                        <span class="font-semibold text-[#0A2342]">What do I get after purchase?</span>
                        <span class="w-8 h-8 bg-[#1B75F0] text-white rounded-full flex items-center justify-center font-bold transition-transform faq-toggle">+</span>
                    </button>
                    <div class="px-6 py-4 hidden faq-answer">
                        <p class="text-gray-600">Immediate access to the complete course including video lessons, study materials, and guides. You'll also receive a private Telegram mentorship invite for daily support, CV review, interview preparation, and ongoing guidance until you land your first trucking job.</p>
                    </div>
                </div>

                <div class="border-2 border-gray-100 rounded-xl overflow-hidden hover:border-[#1B75F0] transition-colors faq-item">
                    <button class="w-full px-6 py-4 flex items-center justify-between text-left bg-[#F2F4F7] hover:bg-gray-100 transition-colors" onclick="toggleFaq(this)">
                        <span class="font-semibold text-[#0A2342]">Do I need previous trucking experience?</span>
                        <span class="w-8 h-8 bg-[#1B75F0] text-white rounded-full flex items-center justify-center font-bold transition-transform faq-toggle">+</span>
                    </button>
                    <div class="px-6 py-4 hidden faq-answer">
                        <p class="text-gray-600">No experience required! We start from the basics and coach you through every step including permits, training, visa applications, company research, and job applications. Our program is specifically designed for beginners.</p>
                    </div>
                </div>

                <div class="border-2 border-gray-100 rounded-xl overflow-hidden hover:border-[#1B75F0] transition-colors faq-item">
                    <button class="w-full px-6 py-4 flex items-center justify-between text-left bg-[#F2F4F7] hover:bg-gray-100 transition-colors" onclick="toggleFaq(this)">
                        <span class="font-semibold text-[#0A2342]">How long does the process take?</span>
                        <span class="w-8 h-8 bg-[#1B75F0] text-white rounded-full flex items-center justify-center font-bold transition-transform faq-toggle">+</span>
                    </button>
                    <div class="px-6 py-4 hidden faq-answer">
                        <p class="text-gray-600">The timeline varies depending on your starting point and visa processing times. Most students complete the course materials within 4-8 weeks, but you'll have lifetime access. Our mentors will help you create a personalized timeline based on your specific situation.</p>
                    </div>
                </div>

                <div class="border-2 border-gray-100 rounded-xl overflow-hidden hover:border-[#1B75F0] transition-colors faq-item">
                    <button class="w-full px-6 py-4 flex items-center justify-between text-left bg-[#F2F4F7] hover:bg-gray-100 transition-colors" onclick="toggleFaq(this)">
                        <span class="font-semibold text-[#0A2342]">Will you help me find a job?</span>
                        <span class="w-8 h-8 bg-[#1B75F0] text-white rounded-full flex items-center justify-center font-bold transition-transform faq-toggle">+</span>
                    </button>
                    <div class="px-6 py-4 hidden faq-answer">
                        <p class="text-gray-600">Yes! We provide a curated list of trucking companies actively hiring international drivers, help you prepare your application materials, conduct mock interviews, and guide you through the entire job application process until you secure your first position.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-[#0A2342] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="font-heading text-4xl font-bold uppercase mb-4">Ready to Start Your Journey?</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                Join hundreds of aspiring truck drivers who are already on their path to success
            </p>
            <a href="{{ route('front.course') }}" class="inline-flex items-center justify-center bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase tracking-wide px-10 py-4 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                Enroll Now & Get Started
            </a>
        </div>
    </section>
</main>

@push('scripts')
<script>
    function toggleFaq(button) {
        const item = button.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const toggle = item.querySelector('.faq-toggle');
        const isHidden = answer.classList.contains('hidden');

        // Close all other FAQs
        document.querySelectorAll('.faq-item').forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.querySelector('.faq-answer').classList.add('hidden');
                otherItem.querySelector('.faq-toggle').textContent = '+';
                otherItem.querySelector('.faq-toggle').style.transform = 'rotate(0deg)';
            }
        });

        // Toggle current FAQ
        if (isHidden) {
            answer.classList.remove('hidden');
            toggle.textContent = '−';
            toggle.style.transform = 'rotate(45deg)';
        } else {
            answer.classList.add('hidden');
            toggle.textContent = '+';
            toggle.style.transform = 'rotate(0deg)';
        }
    }
</script>
@endpush
@endsection
