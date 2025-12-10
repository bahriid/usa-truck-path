@extends('new-design.partials.master')

@section('main')
<main>
    @if (auth()->check() && auth()->user()->purchasedCourses->contains($course))
    <!-- Hero Section for Enrolled Users -->
    <section class="relative bg-cover bg-center py-24" style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-position: center 80%;">
        <div class="absolute inset-0 bg-[#0A2342]/80"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-white max-w-2xl">
                    <h1 class="font-heading text-4xl md:text-5xl font-bold text-[#F5B82E] uppercase mb-4">{{ $course->title }}</h1>
                    <p class="text-lg text-gray-200 mb-6">{{ $course->short_description }}</p>
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ url('/') }}" class="text-white hover:text-[#F5B82E] transition-colors">Home</a>
                        <span class="text-gray-400">/</span>
                        <span class="text-[#F5B82E]">{{ $course->title }}</span>
                    </nav>
                </div>
                <div>
                    @guest
                        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-block bg-white hover:bg-[#F5B82E] text-[#0A2342] font-bold uppercase tracking-wide py-3 px-8 rounded-lg transition-all">Login to Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="bg-green-500 text-white font-bold uppercase py-3 px-8 rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="bg-gray-500 text-white font-bold uppercase py-3 px-8 rounded-lg cursor-not-allowed" disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 px-8 rounded-lg transition-all">Continue Payment</a>
                            @else
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-white hover:bg-[#F5B82E] text-[#0A2342] font-bold uppercase tracking-wide py-3 px-8 rounded-lg transition-all">Enroll Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </section>

    @if($course->isTierCourse())
    <section class="container mx-auto px-4 py-6">
        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h5 class="font-bold text-green-700 flex items-center gap-2 mb-2">
                        <i data-lucide="gift" class="h-5 w-5"></i>
                        Start Learning FREE Today!
                    </h5>
                    <p class="text-sm text-gray-600">Enroll now at no cost and upgrade anytime to unlock premium content and mentorship.</p>
                </div>
                <div class="flex flex-col gap-1 text-sm">
                    <span class="text-gray-600"><i data-lucide="check-circle" class="h-4 w-4 text-green-500 inline"></i> <strong>FREE</strong> tier included</span>
                    <span class="text-gray-600"><i data-lucide="star" class="h-4 w-4 text-[#1B75F0] inline"></i> <strong>Premium</strong> ${{ number_format($course->premium_price ?? 150, 0) }}</span>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Course Curriculum for Enrolled Users -->
    <section class="bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <h3 class="font-heading text-2xl font-bold text-[#0A2342] uppercase mb-6">Course Curriculum</h3>
            <div class="space-y-4">
                @php
                    $chapters = $course->chapters->sortBy('order');
                @endphp

                @forelse ($chapters as $index => $chapter)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden" x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition-colors">
                            <span class="font-bold text-[#0A2342]">{{ $chapter->title }}</span>
                            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-collapse class="border-t border-gray-100">
                            @if ($chapter->topics->count() > 0)
                                <ul class="divide-y divide-gray-100">
                                    @foreach ($chapter->topics as $topic)
                                        <li class="p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <strong class="text-gray-700">{{ $topic->title }}</strong>
                                                @if ($topic->type === 'video')
                                                    <span class="bg-[#1B75F0] text-white text-xs px-2 py-1 rounded">Video</span>
                                                @elseif ($topic->type === 'voice')
                                                    <span class="bg-cyan-500 text-white text-xs px-2 py-1 rounded">Audio</span>
                                                @elseif ($topic->type === 'pdf')
                                                    <span class="bg-[#F5B82E] text-[#0A2342] text-xs px-2 py-1 rounded">PDF</span>
                                                @else
                                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">Reading</span>
                                                @endif
                                            </div>
                                            @php
                                                $user = auth()->user();
                                                $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                            @endphp
                                            @if ($hasAccess)
                                                <a href="{{ route('course.curriculam', ['course' => $course->id]) }}" class="text-[#1B75F0] hover:text-[#0A2342] font-bold text-sm">
                                                    Access Content
                                                </a>
                                            @else
                                                <button class="bg-gray-200 text-gray-500 text-sm px-3 py-1 rounded cursor-not-allowed" disabled>Locked</button>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="p-4 text-gray-500">No topics in this chapter.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No chapters found for this course.</p>
                @endforelse
            </div>
        </div>
    </section>

    @else
    <!-- Hero Section for Non-Enrolled Users -->
    <section class="relative bg-cover bg-center py-24" style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-position: center 80%;">
        <div class="absolute inset-0 bg-[#0A2342]/80"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-white max-w-2xl">
                    <h1 class="font-heading text-4xl md:text-5xl font-bold text-[#F5B82E] uppercase mb-4">{{ $course->title }}</h1>
                    <p class="text-lg text-gray-200 mb-6">{{ $course->short_description }}</p>
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ url('/') }}" class="text-white hover:text-[#F5B82E] transition-colors">Home</a>
                        <span class="text-gray-400">/</span>
                        <span class="text-[#F5B82E]">{{ $course->title }}</span>
                    </nav>
                </div>
                <div>
                    @guest
                        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-block bg-white hover:bg-[#F5B82E] text-[#0A2342] font-bold uppercase tracking-wide py-3 px-8 rounded-lg transition-all">Login to Enroll</a>
                    @else
                        @if (auth()->user()->hasApprovedCourse($course->id))
                            <button class="bg-green-500 text-white font-bold uppercase py-3 px-8 rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                        @else
                            @if ($course->status === 'upcoming')
                                <button class="bg-gray-500 text-white font-bold uppercase py-3 px-8 rounded-lg cursor-not-allowed" disabled>Up Coming</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 px-8 rounded-lg transition-all">Continue Payment</a>
                            @else
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-white hover:bg-[#F5B82E] text-[#0A2342] font-bold uppercase tracking-wide py-3 px-8 rounded-lg transition-all">Enroll Now</a>
                            @endif
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Choose Your Plan Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="font-heading text-3xl font-bold text-center text-[#0A2342] uppercase mb-8">Choose Your Plan</h2>
            <div class="max-w-5xl mx-auto bg-gray-50 rounded-2xl p-8">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full rounded-xl shadow-lg">
                        @else
                            <img src="{{ asset('frontend/img/course-details.jpg') }}" alt="{{ $course->title }}" class="w-full rounded-xl shadow-lg">
                        @endif
                    </div>
                    <div>
                        <h4 class="font-heading text-xl font-bold text-[#0A2342] mb-4">What's Included in This Course:</h4>
                        <p class="text-gray-600 mb-4">Starting a trucking company can feel overwhelming - but this course breaks it all down step by step. You'll learn exactly how to build a legal, profitable, and compliant trucking business from the ground up.</p>
                        <p class="font-bold text-gray-700 mb-3">You'll learn:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to form your LLC, EIN, and business bank account</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to apply for USDOT, MC Authority, BOC-3, UCR, IRP, and IFTA</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to choose the best insurance and drug consortium (C/TPA)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to buy the best truck - new or used - and what to inspect</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to find loads, work with dispatchers, and connect with direct shippers</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600">How to stay compliant with ELD, maintenance, and safety records</span>
                            </li>
                        </ul>
                        <p class="text-gray-600 mb-6">Once enrolled, you'll be added to our private Telegram mentorship group where we'll help you daily until your business is fully running.</p>
                        <div class="text-center">
                            <p class="text-xl font-bold text-[#0A2342] mb-4">
                                Price:
                                @if($course->isTierCourse())
                                    <span class="text-green-500">FREE</span>
                                @else
                                    ${{ $course->price }}
                                @endif
                            </p>
                            @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="block w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 rounded-lg transition-all">Login to Enroll</a>
                            @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                    <button class="w-full bg-green-500 text-white font-bold uppercase py-3 rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="block w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 rounded-lg transition-all">Continue Payment</a>
                                @else
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="block w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 rounded-lg transition-all">Enroll Now</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About This Course Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div class="p-6">
                        <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">About This Course</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            This course and mentorship program walks you through everything you need to start your own trucking company in the U.S. You'll learn how to open your LLC, get USDOT and MC numbers, choose the best insurance, and buy the right truck. You'll also join our private Telegram group for lifetime guidance and daily business support.
                        </p>
                        @guest
                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-block bg-[#0A2342] hover:bg-[#1B75F0] text-white font-bold uppercase py-3 px-6 rounded-lg transition-all">Login to Enroll</a>
                        @else
                            @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="bg-green-500 text-white font-bold uppercase py-3 px-6 rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 px-6 rounded-lg transition-all">Continue Payment</a>
                            @else
                                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#0A2342] hover:bg-[#1B75F0] text-white font-bold uppercase py-3 px-6 rounded-lg transition-all">Enroll Now</a>
                            @endif
                        @endguest
                    </div>
                    <div>
                        <img src="{{ asset('frontend/img/training.jpg') }}" alt="Course Image" class="w-full rounded-xl shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose USA Truck Path Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Why Choose USA Truck Path?</h2>
                <p class="text-gray-600 text-lg">Your Fast-Track to a Truck Driving Career Starts Here. We empower future truck drivers with an easy, effective, and guaranteed way to pass the DMV exam - regardless of language or background.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#1B75F0]/10 text-[#1B75F0] rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="languages" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">Multilingual Learning System</h5>
                    <p class="text-gray-600 text-sm">Study in your preferred language - English, Arabic, Somali, Amharic, French, or Nepali - with complete support for non-native speakers.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="message-square" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">Real DMV Test Questions & Answers</h5>
                    <p class="text-gray-600 text-sm">Our course includes the actual test format and questions used by DMVs across all states, ensuring you're fully prepared.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-[#F5B82E]/20 text-[#F5B82E] rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="play-circle" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">All-in-One Multimedia Course</h5>
                    <p class="text-gray-600 text-sm">Access video classes, eBooks, and audio lessons for a rich and engaging learning experience tailored to different learning styles.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-red-100 text-red-500 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="shield-check" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">100% Pass Guarantee</h5>
                    <p class="text-gray-600 text-sm">We're so confident in our system that we guarantee you'll pass your DMV test on the first try - or get extended access for free.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-cyan-100 text-cyan-500 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="award" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">Learn at Your Own Pace</h5>
                    <p class="text-gray-600 text-sm">Whether you have a full-time job or a busy life, our platform lets you study anytime, anywhere - on any device.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="truck" class="h-7 w-7"></i>
                    </div>
                    <h5 class="font-bold text-[#0A2342] mb-2">Built for Future Truckers</h5>
                    <p class="text-gray-600 text-sm">We specialize in helping aspiring CDL truck drivers - so you're not just passing a test, you're preparing for a career on the road.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Curriculum Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="font-heading text-2xl font-bold text-[#0A2342] uppercase mb-6">Course Curriculum</h3>
            <div class="space-y-4">
                @php
                    $chapters = $course->chapters->sortBy('order');
                @endphp

                @forelse ($chapters as $index => $chapter)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden" x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition-colors">
                            <span class="font-bold text-[#0A2342]">{{ $chapter->title }}</span>
                            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-collapse class="border-t border-gray-100">
                            @if ($chapter->topics->count() > 0)
                                <ul class="divide-y divide-gray-100">
                                    @foreach ($chapter->topics as $topic)
                                        <li class="p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <strong class="text-gray-700">{{ $topic->title }}</strong>
                                                @if ($topic->type === 'video')
                                                    <span class="bg-[#1B75F0] text-white text-xs px-2 py-1 rounded">Video</span>
                                                @elseif ($topic->type === 'voice')
                                                    <span class="bg-cyan-500 text-white text-xs px-2 py-1 rounded">Audio</span>
                                                @elseif ($topic->type === 'pdf')
                                                    <span class="bg-[#F5B82E] text-[#0A2342] text-xs px-2 py-1 rounded">PDF</span>
                                                @else
                                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">Reading</span>
                                                @endif
                                            </div>
                                            <button class="bg-gray-200 text-gray-500 text-sm px-3 py-1 rounded cursor-not-allowed" disabled>Locked</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="p-4 text-gray-500">No topics in this chapter.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No chapters found for this course.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About USATruckPath Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">About USATruckPath</h2>
                <p class="text-gray-600 text-lg">
                    We make it easy to pass your Commercial Learner's Permit (CLP) test. Our all-in-one course includes video lessons, audio guides, and an eBook - available in multiple languages. It's everything you need to get started in trucking.
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">What Our Students Say</h2>
                <p class="text-gray-600">Read inspiring stories from individuals who have successfully achieved their trucking careers with us.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('frontend/img/public.png') }}" alt="Yodit Tadesse" class="w-12 h-12 rounded-full object-cover">
                        <h6 class="font-bold text-[#0A2342]">Yodit Tadesse</h6>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">"I'm so glad I found USATruckPath.com! The practice questions were just like the real test and gave me the confidence I needed. I passed my permit test on the first try!"</p>
                    <div class="flex gap-1 text-[#F5B82E]">
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('frontend/img/boy.png') }}" alt="Carlos Mendoza" class="w-12 h-12 rounded-full object-cover">
                        <h6 class="font-bold text-[#0A2342]">Carlos Mendoza</h6>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">"I'm originally from Honduras and live in Columbus, Ohio. The questions were just like the real test, and the lessons were easy to understand. I passed my permit test on the first try!"</p>
                    <div class="flex gap-1 text-[#F5B82E]">
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('frontend/img/boy.png') }}" alt="Ahmed Hassan" class="w-12 h-12 rounded-full object-cover">
                        <h6 class="font-bold text-[#0A2342]">Ahmed Hassan</h6>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">"I'm originally from Egypt. I bought the Arabic version of the guide. The lessons were so easy to follow in my own language. I passed my CDL permit test on the first try!"</p>
                    <div class="flex gap-1 text-[#F5B82E]">
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="font-heading text-3xl font-bold text-[#F5B82E] uppercase mb-4">Ready to start your own trucking company and become your own boss?</h2>
                <p class="text-gray-300 text-lg mb-6">Join today - learn how to start, grow, and manage your company with lifetime mentorship and step-by-step support.</p>
                <p class="text-gray-300 mb-8">Enroll now and let us help you buy your first truck the right way.</p>
                @guest
                    <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-4 px-10 rounded-lg text-lg transition-all">Login to Enroll</a>
                @else
                    @if (auth()->user()->hasApprovedCourse($course->id))
                        <button class="bg-green-500 text-white font-bold uppercase py-4 px-10 rounded-lg text-lg cursor-not-allowed" disabled>Already Enrolled</button>
                    @elseif(auth()->user()->hasPurchasedCourse($course->id))
                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-4 px-10 rounded-lg text-lg transition-all">Continue Payment</a>
                    @else
                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-4 px-10 rounded-lg text-lg transition-all">Enroll Now</a>
                    @endif
                @endguest
            </div>
        </div>
    </section>
    @endif
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
