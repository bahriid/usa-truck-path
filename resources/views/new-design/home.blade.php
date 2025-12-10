@extends('new-design.partials.master')

@section('main')
<main>
    <!-- 1. Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-truck-highway.png') }}" alt="Truck on highway" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#0A2342]/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-transparent opacity-90"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 pt-20 pb-20">
            <div class="max-w-4xl">
                <div class="inline-block bg-[#1B75F0] px-4 py-2 mb-6 rounded-full shadow-lg">
                    <span class="font-bold uppercase text-white tracking-wider text-sm">Your Bridge to u.s. trucking</span>
                </div>

                <h1 class="font-heading text-5xl md:text-7xl font-bold uppercase leading-tight text-white mb-6 drop-shadow-lg">
                    Become a U.S. Truck Driver <br/>
                    <span class="text-[#F5B82E]">We Guide You Step-by-Step</span>
                </h1>

                <p class="text-xl md:text-2xl font-medium text-gray-200 max-w-2xl mb-10 leading-relaxed">
                    The complete step-by-step mentorship program guiding you from your home country to a high-paying trucking career in the United States.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('front.course') }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 text-lg h-14 px-8 w-full sm:w-auto rounded-md shadow-lg font-medium flex items-center justify-center">
                        Start Free Course
                    </a>
                    <a href="{{ route('front.mentorship') }}" class="btn-secondary bg-white text-[#0A2342] hover:bg-gray-100 text-lg h-14 px-8 w-full sm:w-auto rounded-md shadow-lg border border-gray-200 font-medium flex items-center justify-center">
                        Join Mentorship
                    </a>
                </div>

                <div class="mt-24 flex flex-wrap items-center gap-8 text-white font-bold uppercase tracking-wider text-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="users" class="h-5 w-5 text-[#F5B82E]"></i>
                        <span>500+ Students</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="globe" class="h-5 w-5 text-[#F5B82E]"></i>
                        <span>Hiring Companies</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="h-5 w-5 text-[#F5B82E]"></i>
                        <span>Visa,CV, & Interview Help</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. How It Works -->
    <section id="how-it-works" class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mb-4">How It Works</h2>
                <p class="text-xl max-w-2xl mx-auto font-medium text-gray-600">
                    A clear, proven pathway designed to take you from zero to hired in the USA. No guesswork, just results.
                </p>
            </div>

            <div class="grid md:grid-cols-5 gap-8 relative">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-10 left-0 w-full h-1 bg-gray-100 -z-10 rounded-full"></div>

                <!-- Step 1 -->
                <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-12 h-12 bg-[#0A2342] text-white font-heading font-bold text-xl flex items-center justify-center rounded-full mb-6 shadow-md group-hover:bg-[#1B75F0] transition-colors mx-auto md:mx-0">01</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Start Free Course</h3>
                    <p class="text-gray-600 font-medium leading-relaxed text-sm">Learn the basics of the US trucking industry.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-12 h-12 bg-[#0A2342] text-white font-heading font-bold text-xl flex items-center justify-center rounded-full mb-6 shadow-md group-hover:bg-[#1B75F0] transition-colors mx-auto md:mx-0">02</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Understand the Trucking Industry</h3>
                    <p class="text-gray-600 font-medium leading-relaxed text-sm">Master the rules, regulations, and requirements.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-12 h-12 bg-[#0A2342] text-white font-heading font-bold text-xl flex items-center justify-center rounded-full mb-6 shadow-md group-hover:bg-[#1B75F0] transition-colors mx-auto md:mx-0">03</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Join Mentorship</h3>
                    <p class="text-gray-600 font-medium leading-relaxed text-sm">Get personalized guidance and premium resources.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-12 h-12 bg-[#0A2342] text-white font-heading font-bold text-xl flex items-center justify-center rounded-full mb-6 shadow-md group-hover:bg-[#1B75F0] transition-colors mx-auto md:mx-0">04</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Get Hired</h3>
                    <p class="text-gray-600 font-medium leading-relaxed text-sm">Apply for jobs and move to the USA.</p>
                </div>

                <!-- Step 5 -->
                <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-12 h-12 bg-[#0A2342] text-white font-heading font-bold text-xl flex items-center justify-center rounded-full mb-6 shadow-md group-hover:bg-[#1B75F0] transition-colors mx-auto md:mx-0">05</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Get Licensed</h3>
                    <p class="text-gray-600 font-medium leading-relaxed text-sm">Support for CLP, CDL, and interview prep.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Free Course Section -->
    <section id="free-course" class="py-24 bg-[#F2F4F7] relative overflow-hidden">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-block bg-[#1B75F0] text-white px-3 py-1 font-bold uppercase tracking-widest mb-4 text-xs rounded-full">Lead Magnet</div>
                <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mb-4">Free Online Course</h2>
                <p class="text-lg font-medium text-gray-600 mb-8 leading-relaxed">
                    Not sure where to start? Our free course breaks down the complex US immigration and trucking landscape into simple, digestible lessons.
                </p>

                <ul class="space-y-4 mb-10">
                    <li class="flex items-start gap-3">
                        <div class="mt-1 bg-[#E6F0FF] p-1 rounded-full"><i data-lucide="check" class="h-4 w-4 text-[#1B75F0]"></i></div>
                        <span class="font-medium text-[#3A3A3A]">Overview of the US Trucking Industry</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 bg-[#E6F0FF] p-1 rounded-full"><i data-lucide="check" class="h-4 w-4 text-[#1B75F0]"></i></div>
                        <span class="font-medium text-[#3A3A3A]">Visa Types & Eligibility Requirements</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 bg-[#E6F0FF] p-1 rounded-full"><i data-lucide="check" class="h-4 w-4 text-[#1B75F0]"></i></div>
                        <span class="font-medium text-[#3A3A3A]">The CDL Process Explained Simply</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 bg-[#E6F0FF] p-1 rounded-full"><i data-lucide="check" class="h-4 w-4 text-[#1B75F0]"></i></div>
                        <span class="font-medium text-[#3A3A3A]">Cost Breakdown & Financial Planning</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 bg-[#E6F0FF] p-1 rounded-full"><i data-lucide="check" class="h-4 w-4 text-[#1B75F0]"></i></div>
                        <span class="font-medium text-[#3A3A3A]">Common Mistakes to Avoid</span>
                    </li>
                </ul>

                <a href="{{ route('front.course') }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-12 px-8 text-lg w-full md:w-auto rounded-md shadow-md font-medium flex items-center justify-center gap-2 inline-flex">
                    Start Learning For Free <i data-lucide="arrow-right" class="h-5 w-5"></i>
                </a>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-[#0A2342] rounded-2xl transform rotate-3 opacity-10"></div>
                <img src="{{ asset('images/truck-interior-sunset.png') }}" alt="Truck Interior" class="relative z-10 w-full h-auto rounded-2xl shadow-2xl transform -rotate-2 hover:rotate-0 transition-all duration-500">
                <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-lg shadow-lg z-20 max-w-[200px] border-l-4 border-[#F5B82E]">
                    <div class="flex gap-1 mb-1">
                        <i data-lucide="star" class="h-3 w-3 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-3 w-3 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-3 w-3 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-3 w-3 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-3 w-3 fill-[#F5B82E] text-[#F5B82E]"></i>
                    </div>
                    <p class="font-bold text-[#0A2342] text-sm leading-tight mb-1">"This course changed my life."</p>
                    <p class="text-xs text-gray-500">- Alex M., Canada</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Paid Mentorship Program -->
    <section id="mentorship" class="py-24 bg-[#0A2342] text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiLz48L3N2Zz4=')"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-6xl font-bold uppercase text-white mb-4">
                    Premium <span class="text-[#F5B82E]">Mentorship</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    The ultimate fast-track to your US trucking career. Get step-by-step guidance, daily support, and exclusive resources.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <!-- Left Column: Image -->
                <div class="lg:col-span-5 relative">
                    <div class="absolute inset-0 bg-[#F5B82E] rounded-2xl transform translate-x-4 translate-y-4"></div>
                    <img src="{{ asset('images/mentorship-training-v2.png') }}" alt="Mentorship Training" class="relative z-10 w-full h-full object-cover rounded-2xl shadow-2xl min-h-[400px]">
                </div>

                <!-- Right Column: Benefits -->
                <div class="lg:col-span-7">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <!-- Benefit 1 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="file-text" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">CV Review</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Professional optimization of your resume for US carriers.</p>
                        </div>
                        <!-- Benefit 2 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="truck" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">Hiring Companies</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Exclusive list of companies hiring foreign drivers.</p>
                        </div>
                        <!-- Benefit 3 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="users" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">Interview Prep</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Real questions and answers to ace your interview.</p>
                        </div>
                        <!-- Benefit 4 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="star" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">CLP & CDL Help</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Study guides and answers for your permit and license.</p>
                        </div>
                        <!-- Benefit 5 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="globe" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">Visa Guidance</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Step-by-step visa application support.</p>
                        </div>
                        <!-- Benefit 6 -->
                        <div class="bg-white/5 p-6 rounded-xl border border-white/10 hover:border-[#F5B82E] hover:bg-white/10 transition-all group">
                            <div class="bg-[#1B75F0]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#F5B82E] transition-colors">
                                <i data-lucide="shield-check" class="text-white"></i>
                            </div>
                            <h4 class="font-heading text-lg font-bold uppercase mb-2 text-white">Daily Support</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Direct access to mentors via private Heartbeat group.</p>
                        </div>
                    </div>

                    <div class="mt-10 bg-gradient-to-r from-[#1B75F0] to-[#0A2342] rounded-xl p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border border-white/10">
                        <div>
                            <h4 class="font-heading text-2xl font-bold uppercase text-white mb-1">Ready to commit?</h4>
                            <p class="text-gray-200">Join the elite group of drivers making the move.</p>
                        </div>
                        <a href="{{ route('front.mentorship') }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-12 px-8 whitespace-nowrap shadow-lg rounded font-medium flex items-center justify-center">
                            Join Program Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Who This Is For -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mb-4">Who Is This For?</h2>
                    <div class="space-y-4 mt-6">
                        <div class="flex items-center gap-4 bg-[#F2F4F7] p-4 rounded-lg border-l-4 border-[#1B75F0] hover:bg-white hover:shadow-md transition-all">
                            <div class="h-2 w-2 bg-[#0A2342] rounded-full"></div>
                            <span class="font-bold text-[#3A3A3A] text-lg">Canadians looking for higher pay in the USA</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#F2F4F7] p-4 rounded-lg border-l-4 border-[#1B75F0] hover:bg-white hover:shadow-md transition-all">
                            <div class="h-2 w-2 bg-[#0A2342] rounded-full"></div>
                            <span class="font-bold text-[#3A3A3A] text-lg">Foreign residents in Canada (Work Permit/PR)</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#F2F4F7] p-4 rounded-lg border-l-4 border-[#1B75F0] hover:bg-white hover:shadow-md transition-all">
                            <div class="h-2 w-2 bg-[#0A2342] rounded-full"></div>
                            <span class="font-bold text-[#3A3A3A] text-lg">Drivers from Europe, Middle East, & Africa</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#F2F4F7] p-4 rounded-lg border-l-4 border-[#1B75F0] hover:bg-white hover:shadow-md transition-all">
                            <div class="h-2 w-2 bg-[#0A2342] rounded-full"></div>
                            <span class="font-bold text-[#3A3A3A] text-lg">People confused about the steps to enter U.S. trucking</span>
                        </div>
                        <div class="flex items-center gap-4 bg-[#F2F4F7] p-4 rounded-lg border-l-4 border-[#1B75F0] hover:bg-white hover:shadow-md transition-all">
                            <div class="h-2 w-2 bg-[#0A2342] rounded-full"></div>
                            <span class="font-bold text-[#3A3A3A] text-lg">Anyone ready to change their life through trucking</span>
                        </div>
                    </div>
                </div>
                <div class="relative h-full min-h-[400px] bg-[#0A2342] rounded-2xl p-8 flex items-center justify-center overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 bg-[url('{{ asset('images/community-drivers.png') }}')] bg-cover bg-center opacity-40 mix-blend-overlay"></div>
                    <div class="relative z-10 text-center max-w-md">
                        <div class="w-20 h-1 bg-[#F5B82E] mx-auto mb-6 rounded-full"></div>
                        <p class="font-heading text-3xl md:text-4xl font-bold text-white uppercase leading-tight drop-shadow-lg">
                            "Finding companies that hire foreign drivers is hard — we make it simple."
                        </p>
                        <div class="w-20 h-1 bg-[#F5B82E] mx-auto mt-6 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Why Choose USATruckPath -->
    <section class="py-24 bg-[#F2F4F7]">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mx-auto mb-12">Why Choose Us?</h2>
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-t-4 border-[#1B75F0]">
                    <div class="w-16 h-16 bg-[#F2F4F7] text-[#0A2342] mx-auto flex items-center justify-center mb-6 font-heading text-3xl font-bold rounded-full shadow-inner">1</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-4 text-[#0A2342]">Real Experience</h3>
                    <p class="text-gray-600 font-medium leading-relaxed">Founded by drivers who have actually done it. No theory, just practical reality.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-t-4 border-[#1B75F0]">
                    <div class="w-16 h-16 bg-[#F2F4F7] text-[#0A2342] mx-auto flex items-center justify-center mb-6 font-heading text-3xl font-bold rounded-full shadow-inner">2</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-4 text-[#0A2342]">Structured Path</h3>
                    <p class="text-gray-600 font-medium leading-relaxed">Don't get lost in information. Follow a proven step-by-step roadmap.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-all hover:-translate-y-1 border-t-4 border-[#1B75F0]">
                    <div class="w-16 h-16 bg-[#F2F4F7] text-[#0A2342] mx-auto flex items-center justify-center mb-6 font-heading text-3xl font-bold rounded-full shadow-inner">3</div>
                    <h3 class="font-heading text-xl font-bold uppercase mb-4 text-[#0A2342]">Community First</h3>
                    <p class="text-gray-600 font-medium leading-relaxed">Join a private network of like-minded drivers supporting each other.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Visual Roadmap -->
    <section id="roadmap" class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mx-auto mb-4">Your Journey Map</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mt-4">
                    From your first lesson to your first paycheck in USD.
                </p>
            </div>

            <div class="relative">
                <!-- Central Line -->
                <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-[#E2E8F0] -translate-x-1/2 hidden md:block rounded-full"></div>

                <div class="space-y-12 relative z-10">
                    <!-- Step 1 -->
                    <div class="flex flex-col md:flex-row-reverse items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-right md:pr-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Start Learning</h3>
                                <p class="text-gray-600">Enroll in our free course and understand the basics.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-left md:pl-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Prepare Documents</h3>
                                <p class="text-gray-600">Gather passport, license, and background checks.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col md:flex-row-reverse items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-right md:pr-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Take CLP/CDL Training </h3>
                                <p class="text-gray-600">Study for and pass your Commercial Learner's Permit.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-left md:pl-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Begin CDL Steps</h3>
                                <p class="text-gray-600">Start your official training and road practice.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="flex flex-col md:flex-row-reverse items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-right md:pr-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Job Application</h3>
                                <p class="text-gray-600">Apply to our partner companies hiring foreigners.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="flex-1 w-full md:w-auto"></div>
                        <div class="w-8 h-8 bg-[#F5B82E] border-4 border-white shadow-md rounded-full z-20 my-4 md:my-0 shrink-0 flex items-center justify-center">
                            <div class="w-2 h-2 bg-[#0A2342] rounded-full"></div>
                        </div>
                        <div class="flex-1 w-full md:w-auto md:text-left md:pl-12">
                            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#0A2342]">Visa & Travel</h3>
                                <p class="text-gray-600">Secure your visa and book your ticket to the USA.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <div class="flex-1 w-full md:w-auto text-center">
                            <div class="bg-[#0A2342] text-white p-6 rounded-xl shadow-xl border-none hover:shadow-lg transition-all max-w-xl mx-auto transform scale-105">
                                <h3 class="font-heading text-xl font-bold uppercase mb-2 text-[#F5B82E]">Start Career</h3>
                                <p class="text-gray-300">Begin earning in USD and driving across America.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Testimonials -->
    <section class="py-24 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] text-center block mx-auto mb-12">Success Stories</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all p-8">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                    </div>
                    <p class="text-lg font-medium text-gray-600 mb-6 italic leading-relaxed">
                        "The mentorship program was worth every penny. I went from confused to hired in 4 months. The visa guidance was a lifesaver."
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="Avatar">
                        </div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Student Name</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving in Texas</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all p-8">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                    </div>
                    <p class="text-lg font-medium text-gray-600 mb-6 italic leading-relaxed">
                        "The mentorship program was worth every penny. I went from confused to hired in 4 months. The visa guidance was a lifesaver."
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=2" alt="Avatar">
                        </div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Student Name</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving in Texas</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all p-8">
                    <div class="flex gap-1 mb-4">
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                    </div>
                    <p class="text-lg font-medium text-gray-600 mb-6 italic leading-relaxed">
                        "The mentorship program was worth every penny. I went from confused to hired in 4 months. The visa guidance was a lifesaver."
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=3" alt="Avatar">
                        </div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Student Name</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving in Texas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. FAQ -->
    <section id="faq" class="py-24 bg-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] text-center block mx-auto mb-12">Common Questions</h2>
            <div class="space-y-4">
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        Do I need a Canadian passport?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        No, you can be a foreign citizen living in Canada with permanent or temporary residency. However, different visa rules apply.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        How much does the mentorship cost?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        We offer different tiers. Please join the free course to see our current pricing and packages.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        Can you guarantee a job?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        While we cannot legally guarantee a job, we provide you with a list of hiring companies and prepare you to be the best candidate possible.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        How long does the process take?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        Typically 3-6 months depending on your dedication and current document status.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        Is the CDL valid in all states?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        Yes, a Class A CDL is a federal license valid across all 50 US states.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- 10. Final CTA -->
    <section class="py-32 bg-[#0A2342] text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('{{ asset('images/hero-truck-highway.png') }}')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A2342] via-transparent to-[#0A2342]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 class="font-heading text-5xl md:text-7xl font-bold uppercase mb-8 text-white drop-shadow-lg">
                Start Your Engine
            </h2>
            <p class="text-xl md:text-2xl font-medium mb-12 max-w-2xl mx-auto text-gray-300">
                Don't wait for the opportunity. Drive towards it. Join hundreds of others who have successfully made the move.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('front.course') }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 text-xl h-16 px-12 rounded-md shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all font-medium flex items-center justify-center">
                    Start Free Course
                </a>
                <a href="{{ route('front.mentorship') }}" class="btn-secondary bg-white text-[#0A2342] hover:bg-gray-100 text-xl h-16 px-12 rounded-md shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all border border-gray-200 font-medium flex items-center justify-center">
                    Join Mentorship
                </a>
            </div>

            <p class="mt-16 text-sm opacity-60 uppercase tracking-widest font-bold text-gray-400">
                USATruckPath &copy; {{ date('Y') }} - Built for Drivers, By Drivers
            </p>
        </div>
    </section>
</main>
@endsection
