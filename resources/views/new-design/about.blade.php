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
                Built on 10+ Years of Real Experience
            </span>
            <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-tighter mb-4 text-[#F5B82E]">
                Why Drivers Choose Us
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                USATRUCKPATH helps people worldwide become truck drivers in the USA and Canada.
                Our step-by-step courses, real mentorship, and support community give you the
                knowledge and guidance to start your trucking career with confidence.
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-[#F2F4F7] rounded-2xl p-8 md:p-12 shadow-lg border-l-4 border-[#F5B82E]">
                <!-- Founder Intro -->
                <div class="flex flex-col md:flex-row items-center gap-6 mb-8 p-6 bg-white rounded-xl shadow-sm">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-full flex items-center justify-center text-4xl flex-shrink-0">
                        <i data-lucide="user" class="h-10 w-10 text-white"></i>
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="font-heading text-2xl font-bold text-[#0A2342] mb-1">Meet Idris, Our Founder</h3>
                        <p class="text-gray-600">10+ Years in Trucking | 4 Schools Founded | 10,000+ Students Trained</p>
                    </div>
                </div>

                <h3 class="font-heading text-2xl font-bold text-[#1B75F0] mb-4">Our Story</h3>
                <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                    Welcome to our trucking education platform — built on real industry experience and a
                    mission to guide new drivers and future owner-operators from their first permit all the
                    way to financial freedom.
                </p>
                <p class="text-gray-600 mb-4">
                    My name is Idris, and I've spent over 10 years in the trucking industry. I founded four
                    trucking schools in Ohio, Utah, Michigan, and Minnesota, training over 10,000 students.
                </p>
                <p class="text-gray-600 mb-6">
                    Born in Somalia and raised in a refugee camp, I came to the U.S. with resilience and a
                    mission: to help others succeed without wasting money or hope.
                </p>

                <!-- Highlight Box -->
                <div class="bg-gradient-to-r from-[#1B75F0]/10 to-[#0A2342]/10 border-l-4 border-[#1B75F0] p-6 rounded-lg">
                    <h4 class="font-heading font-bold text-[#1B75F0] mb-2 flex items-center gap-2">
                        <i data-lucide="lightbulb" class="h-5 w-5"></i>
                        Why We Built These Courses
                    </h4>
                    <p class="text-gray-700">
                        Too many immigrants and people overseas lose thousands of dollars to scams and fake promises.
                        That's why we created affordable, high-value courses that deliver 100x more value than their cost.
                        Students learn steps like resume building, applying to trusted companies, and avoiding costly mistakes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-[#0A2342] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold uppercase mb-4 text-[#F5B82E]">Our Impact in Numbers</h2>
                <p class="text-gray-300">Real results from real commitment</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 text-center hover:bg-white/15 transition-all">
                    <div class="text-5xl font-bold text-[#F5B82E] mb-2">4</div>
                    <div class="text-lg font-semibold">Trucking Schools Founded</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 text-center hover:bg-white/15 transition-all">
                    <div class="text-5xl font-bold text-[#F5B82E] mb-2">10K+</div>
                    <div class="text-lg font-semibold">Students Trained</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 text-center hover:bg-white/15 transition-all">
                    <div class="text-5xl font-bold text-[#F5B82E] mb-2">10+</div>
                    <div class="text-lg font-semibold">Years of Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Our Mission & Values</h2>
                <p class="text-gray-600">Everything we do is guided by these core principles</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="graduation-cap" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Education First</h4>
                    <p class="text-gray-600 text-sm">Help students earn their permit and CDL license with comprehensive, easy-to-follow training materials</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="truck" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Owner-Operator Path</h4>
                    <p class="text-gray-600 text-sm">Teach how to buy the right truck and become successful owner-operators with smart business decisions</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="briefcase" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Business Knowledge</h4>
                    <p class="text-gray-600 text-sm">Provide complete knowledge on dispatching, compliance, and running a profitable trucking business</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="shield-check" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Scam Protection</h4>
                    <p class="text-gray-600 text-sm">Protect students from scams and false promises by providing honest, transparent guidance</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="star" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Long-Term Success</h4>
                    <p class="text-gray-600 text-sm">Guide students toward sustainable, long-term success in the trucking industry</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow border-2 border-transparent hover:border-[#1B75F0]">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#F5B82E] to-[#F5B82E]/80 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="globe" class="h-8 w-8 text-[#0A2342]"></i>
                    </div>
                    <h4 class="font-heading font-bold text-[#0A2342] mb-2">Global Reach</h4>
                    <p class="text-gray-600 text-sm">Reach students worldwide from Africa, Middle East, Canada, Europe and help families achieve financial freedom</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What Makes Us Different -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">What Makes Us Different</h2>
                <p class="text-gray-600">More than just a platform — we're building a community</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="flex gap-5 p-6 bg-[#F2F4F7] rounded-xl shadow-sm hover:shadow-md transition-all hover:translate-x-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="message-circle" class="h-7 w-7 text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-heading font-bold text-[#0A2342] mb-2">Daily Live Support</h5>
                        <p class="text-gray-600">I go live on TikTok daily to share knowledge and answer questions. This is personal to me — I'm committed to helping you succeed every single day.</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-[#F2F4F7] rounded-xl shadow-sm hover:shadow-md transition-all hover:translate-x-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="users" class="h-7 w-7 text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-heading font-bold text-[#0A2342] mb-2">Real Community</h5>
                        <p class="text-gray-600">Students join our Telegram group where I share trusted trucking company connections. We're building support, trust, and a real community of drivers helping each other.</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-[#F2F4F7] rounded-xl shadow-sm hover:shadow-md transition-all hover:translate-x-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="trophy" class="h-7 w-7 text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-heading font-bold text-[#0A2342] mb-2">Proven Track Record</h5>
                        <p class="text-gray-600">Our journey started with CDLCity.com, my first trucking school. From there we expanded to multiple states and now train students globally with the same commitment to quality and honesty.</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-[#F2F4F7] rounded-xl shadow-sm hover:shadow-md transition-all hover:translate-x-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#1B75F0] to-[#0A2342] rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="heart" class="h-7 w-7 text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-heading font-bold text-[#0A2342] mb-2">Personal Mission</h5>
                        <p class="text-gray-600">As someone who lived through hardship and success, I understand the journey. I'm here to help you build your future — wherever you are in the world.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Box -->
            <div class="max-w-3xl mx-auto mt-12 bg-gradient-to-br from-[#0A2342] to-[#1B75F0] text-white p-10 rounded-2xl text-center shadow-xl">
                <h3 class="font-heading text-3xl font-bold mb-4">Let's Build Your Future Together</h3>
                <p class="text-lg text-gray-200 mb-6">
                    You don't have to do this alone. We are here to teach, guide, and give you everything
                    you need for long-term success in the trucking industry.
                </p>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase tracking-wide px-8 py-4 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                    Join Us Today & Start Your Journey
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
