@extends('new-design.partials.master')

@section('main')
<main>
    <!-- 1. Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            @if($sliders->count() > 0 && $sliders->first()->image)
                <img src="{{ Storage::url($sliders->first()->image) }}" alt="Truck on highway" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-[#0A2342]"></div>
            @endif
            <div class="absolute inset-0 bg-[#0A2342]/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-transparent opacity-90"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 pt-20 pb-20">
            <div class="max-w-4xl">
                <div class="inline-block bg-[#1B75F0] px-4 py-2 mb-6 rounded-full shadow-lg">
                    <span class="font-bold uppercase text-white tracking-wider text-sm">Your Bridge to U.S. Trucking</span>
                </div>

                <h1 class="font-heading text-5xl md:text-7xl font-bold uppercase leading-tight text-white mb-6 drop-shadow-lg">
                    Become a U.S. Truck Driver <br/>
                    <span class="text-[#F5B82E]">We Guide You Step-by-Step</span>
                </h1>

                <p class="text-xl md:text-2xl font-medium text-gray-200 max-w-2xl mb-10 leading-relaxed">
                    The complete step-by-step mentorship program guiding you from your home country to a high-paying trucking career in the United States.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    @php
                        $freeClpCourse = App\Models\Course::where('course_type', 'language_selector')
                            ->where('status', 'active')
                            ->where('is_active', 1)
                            ->first();
                    @endphp
                    @if($freeClpCourse)
                        <a href="{{ route('front.course.details', $freeClpCourse->slug) }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 text-lg h-14 px-8 w-full sm:w-auto rounded-md shadow-lg font-medium flex items-center justify-center">
                            Start Free Course
                        </a>
                    @endif
                    <a href="{{ route('front.course') }}" class="btn-secondary bg-white text-[#0A2342] hover:bg-gray-100 text-lg h-14 px-8 w-full sm:w-auto rounded-md shadow-lg border border-gray-200 font-medium flex items-center justify-center">
                        View All Courses
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
                        <span>Visa, CV, & Interview Help</span>
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
                    <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">Understand the Industry</h3>
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

    <!-- 3. Courses Section -->
    <section id="courses" class="py-24 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-block bg-[#1B75F0] text-white px-3 py-1 font-bold uppercase tracking-widest mb-4 text-xs rounded-full">Our Programs</div>
                <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mb-4">Your Path. Your Journey. Our Guidance.</h2>
                <p class="text-lg font-medium text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    American Trucking Starts Here
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($courses as $course)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <a href="{{ route('front.course.details', $course->slug) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                                @if(in_array($course->course_type ?? 'paid', ['tier', 'language_selector']))
                                    <div class="absolute top-4 right-4 bg-[#F5B82E] text-[#0A2342] px-3 py-1 rounded-full text-xs font-bold uppercase">Free</div>
                                @endif
                            </div>
                        </a>
                        <div class="p-6">
                            <h3 class="font-heading text-xl font-bold uppercase mb-3 text-[#0A2342]">
                                <a href="{{ route('front.course.details', $course->slug) }}" class="hover:text-[#1B75F0] transition-colors">
                                    {{ Str::limit($course->title ?? '', 60) }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit(strip_tags($course->description ?? ''), 120, '...') }}</p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="price-wrapper">
                                    @if(in_array($course->course_type ?? 'paid', ['tier', 'language_selector']))
                                        <span class="text-[#1B75F0] font-bold text-lg">FREE</span>
                                    @else
                                        @if($course->original_price)
                                            <span class="text-gray-400 line-through text-sm mr-2">${{ $course->original_price }}</span>
                                        @endif
                                        <span class="text-[#1B75F0] font-bold text-lg">${{ $course->price ?? '' }}</span>
                                    @endif
                                </div>

                                @if(in_array($course->course_type ?? 'paid', ['tier', 'language_selector']))
                                    <a href="{{ route('front.course.details', $course->slug) }}" class="bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 px-4 py-2 rounded font-medium text-sm transition-colors">
                                        Start Free
                                    </a>
                                @else
                                    <a href="{{ route('front.course.details', $course->slug) }}" class="bg-[#1B75F0] text-white hover:bg-[#1B75F0]/90 px-4 py-2 rounded font-medium text-sm transition-colors">
                                        View Details
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">No courses found</p>
                    </div>
                @endforelse
            </div>

            @if ($courses->hasMorePages())
                <div class="text-center mt-12">
                    <a href="{{ route('front.course') }}" class="btn-cta bg-[#0A2342] text-white hover:bg-[#0A2342]/90 px-8 py-4 rounded-md font-medium inline-flex items-center gap-2">
                        View All Courses <i data-lucide="arrow-right" class="h-5 w-5"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- 4. Who This Is For -->
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

    <!-- 5. Why Choose Us -->
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

    <!-- 6. Video Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] mb-4">Watch How It Works</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    See how USATRUCKPATH can help you start your trucking career in the USA
                </p>
            </div>
            <div class="max-w-4xl mx-auto">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <div class="aspect-video">
                        <iframe
                            src="https://player.vimeo.com/video/1128489796"
                            title="USATRUCKPATH Introduction Video"
                            frameborder="0"
                            allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen
                            class="w-full h-full">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Testimonials -->
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
                        "USATruckPath completely changed my journey. I'm originally from Honduras and now live in Columbus, Ohio. Their mentorship program gave me the exact training and practice I needed. I passed my CDL permit test on the first try!"
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-[#0A2342] rounded-full flex items-center justify-center text-white font-bold">JR</div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Juan Ramirez</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving in Ohio</p>
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
                        "I'm so thankful I found USATruckPath. The mentorship program gave me the confidence I needed, and the practice tests were just like the real thing. I passed my permit test right away and got connected to CDL training!"
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-[#1B75F0] rounded-full flex items-center justify-center text-white font-bold">SM</div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Sara Mohammed</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving full time</p>
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
                        "I'm originally from Somalia and was working delivery jobs before. I wanted a better career, and USATruckPath gave me the tools to achieve it. The lessons were simple, and I passed my CDL test on the first try!"
                    </p>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <div class="w-12 h-12 bg-[#F5B82E] rounded-full flex items-center justify-center text-[#0A2342] font-bold">MA</div>
                        <div>
                            <p class="font-bold uppercase text-[#0A2342]">Mohamed Abdi</p>
                            <p class="text-sm text-[#1B75F0] font-medium">Now driving in the U.S.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. FAQ -->
    <section id="faq" class="py-24 bg-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="font-heading text-4xl font-bold uppercase text-[#0A2342] text-center block mx-auto mb-12">Common Questions</h2>
            <div class="space-y-4">
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        What is USATRUCKPATH?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        USATRUCKPATH is a global online learning platform that helps people from around the world become licensed truck drivers in the USA and Canada. We provide step-by-step video courses, visa assistance, and mentorship programs to guide you from your home country all the way to working as a professional truck driver in North America.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        Who can join USATRUCKPATH?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        Anyone who wants to start or grow a trucking career in the USA or Canada can join — whether you live locally or internationally. Our program is designed for new drivers, immigrants, and international students who want to qualify for trucking opportunities in North America.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        Do I need to know English?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        Yes. Basic English is required. You must understand basic English to follow the lessons, complete forms, and communicate during your training. We provide clear, simple lessons to make learning easy for everyone, even if English is your second language.
                    </div>
                </details>
                <details class="border border-gray-200 rounded-lg px-4 shadow-sm hover:shadow-md transition-all bg-white group">
                    <summary class="font-heading text-lg font-bold uppercase text-[#0A2342] hover:text-[#1B75F0] py-6 cursor-pointer list-none flex justify-between items-center">
                        How long do I have access to the course?
                        <i data-lucide="chevron-down" class="h-5 w-5 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="text-base text-gray-600 pb-6 leading-relaxed">
                        Once enrolled, you receive lifetime access to all course materials and updates, our private Telegram support group, and weekly mentorship sessions and community support.
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

    <!-- 9. Final CTA -->
    <section class="py-32 bg-[#0A2342] text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A2342] via-transparent to-[#0A2342]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 class="font-heading text-5xl md:text-7xl font-bold uppercase mb-8 text-white drop-shadow-lg">
                Start Your Engine
            </h2>
            <p class="text-xl md:text-2xl font-medium mb-12 max-w-2xl mx-auto text-gray-300">
                Don't wait for the opportunity. Drive towards it. Join hundreds of others who have successfully made the move.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                @if($freeClpCourse ?? false)
                    <a href="{{ route('front.course.details', $freeClpCourse->slug) }}" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 text-xl h-16 px-12 rounded-md shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all font-medium flex items-center justify-center">
                        Start Free Course
                    </a>
                @endif
                <a href="{{ route('front.course') }}" class="btn-secondary bg-white text-[#0A2342] hover:bg-gray-100 text-xl h-16 px-12 rounded-md shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all border border-gray-200 font-medium flex items-center justify-center">
                    View All Courses
                </a>
            </div>

            <p class="mt-16 text-sm opacity-60 uppercase tracking-widest font-bold text-gray-400">
                USATruckPath &copy; {{ date('Y') }} - Built for Drivers, By Drivers
            </p>
        </div>
    </section>
</main>
@endsection
