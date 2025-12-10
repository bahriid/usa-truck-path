@extends('new-design.partials.master')

@section('main')
<main>
    @if (auth()->check() && auth()->user()->purchasedCourses->contains($course))
        <!-- Hero Section for Enrolled Users -->
        <section class="relative min-h-[400px] flex items-center" style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%;">
            <div class="absolute inset-0 bg-navy/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl">
                    <h1 class="font-heading text-4xl md:text-5xl font-bold text-gold mb-4">{{ $course->title }}</h1>
                    <p class="text-xl text-white/90 mb-6">Unlock your trucking career with our full CDL permit prep course - available in both Amharic and English, with video, audio, and eBook lessons.</p>
                    <nav class="flex items-center space-x-2 text-sm">
                        <a href="{{ url('/') }}" class="text-white hover:text-gold transition-colors">Home</a>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-white/60"></i>
                        <span class="text-gold">{{ $course->title }}</span>
                    </nav>
                </div>
            </div>
        </section>

        <!-- Tier Course Notification Banner -->
        @if($course->isTierCourse())
        <div class="bg-gold/10 border-b border-gold/20">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-center gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-gold"></i>
                    <p class="text-navy text-center">
                        <span class="font-semibold">Free Course!</span> You're enrolled in the free tier.
                        <a href="{{ route('front.courses') }}" class="text-blue underline hover:no-underline">Upgrade to Premium</a> for full access to all content.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Course Curriculum Section for Enrolled Users -->
        <section class="py-12 bg-light-gray">
            <div class="container mx-auto px-4">
                <h2 class="font-heading text-3xl font-bold text-navy mb-8">Course Curriculum</h2>

                @php
                    $chapters = $course->chapters->sortBy('order');
                @endphp

                <div class="space-y-4">
                    @forelse ($chapters as $index => $chapter)
                        <details class="bg-white rounded-lg shadow-sm border border-gray-200 group">
                            <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <span class="font-semibold text-navy">{{ $chapter->title }}</span>
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="p-4 border-t border-gray-200">
                                @if ($chapter->topics->count() > 0)
                                    <ul class="space-y-3">
                                        @foreach ($chapter->topics as $topic)
                                            <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="font-medium text-navy">{{ $topic->title }}</span>
                                                    @if ($topic->type === 'video')
                                                        <span class="px-2 py-1 bg-blue text-white text-xs rounded">Video</span>
                                                    @elseif ($topic->type === 'voice')
                                                        <span class="px-2 py-1 bg-teal-500 text-white text-xs rounded">Audio</span>
                                                    @elseif ($topic->type === 'pdf')
                                                        <span class="px-2 py-1 bg-gold text-navy text-xs rounded">PDF</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">Reading</span>
                                                    @endif
                                                </div>

                                                @php
                                                    $user = auth()->user();
                                                    $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                                @endphp

                                                @if ($hasAccess)
                                                    @if ($topic->type === 'voice' && $topic->voice)
                                                        <button onclick="openAudioModal('{{ $topic->id }}', '{{ $topic->title }}', '{{ asset('storage/' . $topic->voice) }}')" class="flex items-center gap-2 px-3 py-1.5 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm">
                                                            <i data-lucide="volume-2" class="w-4 h-4"></i>
                                                            Play Audio
                                                        </button>
                                                    @elseif($topic->type === 'pdf' && $topic->pdf)
                                                        <div class="flex gap-2">
                                                            <a href="{{ asset('storage/' . $topic->pdf) }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 border border-blue text-blue rounded hover:bg-blue/5 transition-colors text-sm">
                                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                                                View PDF
                                                            </a>
                                                        </div>
                                                    @elseif($topic->type === 'video')
                                                        @if ($topic->source_from === 'local' && $topic->local_video)
                                                            <button onclick="openVideoModal('{{ $topic->id }}', '{{ $topic->title }}', '{{ asset('storage/' . $topic->local_video) }}', 'local')" class="flex items-center gap-2 px-3 py-1.5 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm">
                                                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                                                                Play Video
                                                            </button>
                                                        @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                                            <button onclick="openVideoModal('{{ $topic->id }}', '{{ $topic->title }}', '{{ $topic->video_url }}', 'youtube')" class="flex items-center gap-2 px-3 py-1.5 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm">
                                                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                                                                Play Video
                                                            </button>
                                                        @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                                            <button onclick="openVideoModal('{{ $topic->id }}', '{{ $topic->title }}', '{{ $topic->video_url }}', 'vimeo')" class="flex items-center gap-2 px-3 py-1.5 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm">
                                                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                                                                Play Video
                                                            </button>
                                                        @else
                                                            <a href="{{ $topic->video_url }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 border border-green-500 text-green-600 rounded hover:bg-green-50 transition-colors text-sm">
                                                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                                                                Play Video
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if ($topic->description)
                                                            <button onclick="openReadingModal('{{ $topic->id }}', '{{ $topic->title }}')" class="flex items-center gap-2 px-3 py-1.5 border border-blue text-blue rounded hover:bg-blue/5 transition-colors text-sm">
                                                                <i data-lucide="book-open" class="w-4 h-4"></i>
                                                                Open Reading
                                                            </button>
                                                        @endif
                                                    @endif
                                                @else
                                                    <button class="flex items-center gap-2 px-3 py-1.5 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-sm" disabled>
                                                        <i data-lucide="lock" class="w-4 h-4"></i>
                                                        Locked
                                                    </button>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">No topics in this chapter.</p>
                                @endif
                            </div>
                        </details>
                    @empty
                        <p class="text-gray-500">No chapters found for this course.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Reading Content Modals -->
        @foreach ($chapters as $chapter)
            @foreach ($chapter->topics as $topic)
                @if ($topic->description)
                    <div id="reading-modal-{{ $topic->id }}" class="fixed inset-0 z-50 hidden">
                        <div class="absolute inset-0 bg-black/50" onclick="closeReadingModal('{{ $topic->id }}')"></div>
                        <div class="absolute inset-4 md:inset-10 bg-white rounded-lg overflow-hidden flex flex-col">
                            <div class="flex items-center justify-between p-4 border-b">
                                <h3 class="font-semibold text-navy">{{ $topic->title }}</h3>
                                <button onclick="closeReadingModal('{{ $topic->id }}')" class="p-2 hover:bg-gray-100 rounded-full">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <div class="flex-1 overflow-auto p-6 prose max-w-none">
                                {!! $topic->description !!}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach

    @else
        <!-- Hero Section for Non-Enrolled Users -->
        <section class="relative min-h-[500px] flex items-center" style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%;">
            <div class="absolute inset-0 bg-navy/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h1 class="font-heading text-4xl md:text-5xl font-bold text-gold mb-4">{{ $course->title }}</h1>
                        <p class="text-xl text-white/90 mb-6">{{ $course->short_description ?? 'Unlock your trucking career with our full CDL permit prep course - available in both Amharic and English, with video, audio, and eBook lessons.' }}</p>
                        <nav class="flex items-center space-x-2 text-sm">
                            <a href="{{ url('/') }}" class="text-white hover:text-gold transition-colors">Home</a>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-white/60"></i>
                            <span class="text-gold">{{ $course->title }}</span>
                        </nav>
                    </div>
                    <div class="text-center md:text-right">
                        @guest
                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gold text-navy font-semibold rounded-lg hover:bg-gold/90 transition-colors">
                                <i data-lucide="user-plus" class="w-5 h-5"></i>
                                Sign Up to Enroll
                            </a>
                        @else
                            @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="px-8 py-4 bg-green-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                            @else
                                @if ($course->status === 'upcoming')
                                    <button class="px-8 py-4 bg-gray-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Coming Soon</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gold text-navy font-semibold rounded-lg hover:bg-gold/90 transition-colors">
                                        Continue Payment
                                    </a>
                                @else
                                    <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gold text-navy font-semibold rounded-lg hover:bg-gold/90 transition-colors">
                                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                        Enroll Now
                                    </a>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- Tier Course Notification -->
        @if($course->isTierCourse())
        <div class="bg-green-50 border-b border-green-200">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-center gap-3">
                    <i data-lucide="gift" class="w-5 h-5 text-green-600"></i>
                    <p class="text-green-800 text-center">
                        <span class="font-semibold">This is a FREE course!</span> Sign up now to start learning immediately.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- What's Included Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-8">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-green-600 mb-4">Choose Your Plan</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="flex justify-center">
                        <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}" class="rounded-xl shadow-lg max-h-[400px] object-cover">
                    </div>
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-navy mb-6">What's Included in This Course</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Get ready to pass your Commercial Learner's Permit (CLP) and all CDL endorsements with this complete, easy-to-follow course designed for all 50 states. You'll learn everything you need to know through video lessons, audiobooks, and eBooks in Amharic and English. This course covers the General Knowledge test, Air Brakes, Combination Vehicles, Doubles/Triples, Hazmat, Tanker, Passenger, and School Bus endorsements. It includes real DMV-style practice questions and answers - just like the actual test. Accessible on your phone, tablet, or computer, and with lifetime access for a one-time payment, this is the fastest and most convenient way to prepare. Start today and pass with confidence!</p>

                        <div class="bg-light-gray rounded-xl p-6 text-center">
                            <p class="text-2xl font-bold text-navy mb-4">
                                Price:
                                @if($course->isTierCourse())
                                    <span class="text-green-600">FREE</span>
                                @else
                                    <span class="text-gold">${{ $course->price }}</span>
                                @endif
                            </p>
                            @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                                    Sign Up to Enroll
                                </a>
                            @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                    <button class="w-full px-6 py-3 bg-green-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                                @else
                                    @if ($course->status === 'upcoming')
                                        <button class="w-full px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Coming Soon</button>
                                    @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-gold text-navy font-semibold rounded-lg hover:bg-gold/90 transition-colors">
                                            Continue Payment
                                        </a>
                                    @else
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                            Enroll Now
                                        </a>
                                    @endif
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About This Course Section -->
        <section class="py-16 bg-light-gray">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div>
                        <h2 class="font-heading text-3xl font-bold text-green-600 mb-6">About This Course</h2>
                        <div class="prose max-w-none text-gray-600">
                            {!! $course->description !!}
                        </div>
                        <div class="mt-8">
                            @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-semibold rounded-lg hover:bg-navy/90 transition-colors">
                                    Sign Up to Enroll
                                </a>
                            @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                    <button class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                                @else
                                    @if ($course->status === 'upcoming')
                                        <button class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Coming Soon</button>
                                    @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                        <button class="px-6 py-3 bg-gold text-navy font-semibold rounded-lg cursor-not-allowed" disabled>Request Pending...</button>
                                    @else
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-semibold rounded-lg hover:bg-navy/90 transition-colors">
                                            Enroll Now
                                        </a>
                                    @endif
                                @endif
                            @endguest
                        </div>
                    </div>
                    <div>
                        <img src="{{ asset('frontend/img/training.jpg') }}" alt="Course Image" class="rounded-xl shadow-lg w-full object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose USA Truck Path Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-green-600 mb-4">Why Choose USA Truck Path?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Your Fast-Track to a Truck Driving Career Starts Here. We empower future truck drivers with an easy, effective, and guaranteed way to pass the DMV exam - regardless of language or background.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="languages" class="w-8 h-8 text-blue"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">Multilingual Learning System</h3>
                        <p class="text-gray-600">Study in your preferred language - English, Arabic, Somali, Amharic, French, or Nepali - with complete support for non-native speakers.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="message-square" class="w-8 h-8 text-green-600"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">Real DMV Test Questions & Answers</h3>
                        <p class="text-gray-600">Our course includes the actual test format and questions used by DMVs across all states, ensuring you're fully prepared.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-gold/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="play-circle" class="w-8 h-8 text-gold"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">All-in-One Multimedia Course</h3>
                        <p class="text-gray-600">Access video classes, eBooks, and audio lessons for a rich and engaging learning experience tailored to different learning styles.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="shield-check" class="w-8 h-8 text-red-500"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">100% Pass Guarantee</h3>
                        <p class="text-gray-600">We're so confident in our system that we guarantee you'll pass your DMV test on the first try - or get extended access for free.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="award" class="w-8 h-8 text-teal-500"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">Learn at Your Own Pace</h3>
                        <p class="text-gray-600">Whether you have a full-time job or a busy life, our platform lets you study anytime, anywhere - on any device.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="truck" class="w-8 h-8 text-gray-600"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-navy mb-3">Built for Future Truckers</h3>
                        <p class="text-gray-600">We specialize in helping aspiring CDL truck drivers - so you're not just passing a test, you're preparing for a career on the road.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Curriculum Preview -->
        <section class="py-16 bg-light-gray">
            <div class="container mx-auto px-4">
                <h2 class="font-heading text-3xl font-bold text-navy mb-8">Course Curriculum</h2>

                @php
                    $chapters = $course->chapters->sortBy('order');
                @endphp

                <div class="space-y-4 max-w-4xl mx-auto">
                    @forelse ($chapters as $index => $chapter)
                        <details class="bg-white rounded-lg shadow-sm border border-gray-200 group">
                            <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <span class="font-semibold text-navy">{{ $chapter->title }}</span>
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="p-4 border-t border-gray-200">
                                @if ($chapter->topics->count() > 0)
                                    <ul class="space-y-3">
                                        @foreach ($chapter->topics as $topic)
                                            <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <span class="font-medium text-navy">{{ $topic->title }}</span>
                                                    @if ($topic->type === 'video')
                                                        <span class="px-2 py-1 bg-blue text-white text-xs rounded">Video</span>
                                                    @elseif ($topic->type === 'voice')
                                                        <span class="px-2 py-1 bg-teal-500 text-white text-xs rounded">Audio</span>
                                                    @elseif ($topic->type === 'pdf')
                                                        <span class="px-2 py-1 bg-gold text-navy text-xs rounded">PDF</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">Reading</span>
                                                    @endif
                                                </div>
                                                @php
                                                    $user = auth()->user();
                                                    $hasAccess = $user && $user->hasApprovedCourse($course->id);
                                                @endphp
                                                @if (!$hasAccess)
                                                    <button class="flex items-center gap-2 px-3 py-1.5 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-sm" disabled>
                                                        <i data-lucide="lock" class="w-4 h-4"></i>
                                                        Locked
                                                    </button>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">No topics in this chapter.</p>
                                @endif
                            </div>
                        </details>
                    @empty
                        <p class="text-gray-500">No chapters found for this course.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- About USATruckPath Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-green-600 mb-4">About USATruckPath</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">We make it easy to pass your Commercial Learner's Permit (CLP) test. Our all-in-one course includes video lessons, audio guides, and an eBook - available in multiple languages including Amharic. It's everything you need to get started in trucking.</p>
                    <p class="text-2xl font-bold text-gray-700 mt-6">Here's what you need to do to get started:</p>
                </div>
                <div class="max-w-4xl mx-auto space-y-4">
                    <div class="bg-light-gray rounded-xl p-6 border-l-4 border-green-600">
                        <h3 class="font-bold text-navy text-lg mb-2">1. What You Get</h3>
                        <p class="text-gray-600">Original price $297, now only $80. You'll get full access to: Video course, Audio course, Downloadable eBook. Covers all topics: General Knowledge, Air Brakes, Combination, Hazmat (H), Tanker (N), Doubles & Triples (T), Passenger (P), School Bus (S), Tanker + Hazmat (X).</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 border-l-4 border-green-600">
                        <h3 class="font-bold text-navy text-lg mb-2">2. Proven Method</h3>
                        <p class="text-gray-600">Our study method is simple and guaranteed. You'll get one question and one correct answer - no confusing multiple-choice options. Everyone who purchased our course has passed their test.</p>
                    </div>
                    <div class="bg-light-gray rounded-xl p-6 border-l-4 border-green-600">
                        <h3 class="font-bold text-navy text-lg mb-2">3. Get Started Now</h3>
                        <p class="text-gray-600">This is your first step to becoming a CDL driver. Join thousands who've passed with our guide. Study at your own pace and pass with confidence - guaranteed.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16 bg-light-gray">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-green-600 mb-4">What Our Students Say</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Read inspiring stories from individuals who have successfully achieved their trucking careers with us.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('frontend/img/public.png') }}" alt="Yodit Tadesse" class="w-12 h-12 rounded-full object-cover">
                            <h4 class="font-semibold text-navy">Yodit Tadesse</h4>
                        </div>
                        <p class="text-gray-600 mb-4">"I'm so glad I found USATruckPath.com! The practice questions were just like the real test and gave me the confidence I needed. I passed my permit test on the first try and even joined their trucking school, CDL City Truck Driving School, which is very affordable. Now I have my CDL, and I couldn't be happier!"</p>
                        <div class="flex text-gold">
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('frontend/img/boy.png') }}" alt="Carlos Mendoza" class="w-12 h-12 rounded-full object-cover">
                            <h4 class="font-semibold text-navy">Carlos Mendoza</h4>
                        </div>
                        <p class="text-gray-600 mb-4">"I'm originally from Honduras and live in Columbus, Ohio. I had tried a couple of other programs to pass my CDL permit test, but they didn't work for me. Then I found USATruckPath.com, and it changed everything! The questions were just like the real test, and the lessons were easy to understand. I passed my permit test on the first try!"</p>
                        <div class="flex text-gold">
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('frontend/img/boy.png') }}" alt="Ahmed Hassan" class="w-12 h-12 rounded-full object-cover">
                            <h4 class="font-semibold text-navy">Ahmed Hassan</h4>
                        </div>
                        <p class="text-gray-600 mb-4">"I'm originally from Egypt and lived in Dearborn, Michigan, working as a DoorDash delivery driver. I was tired of the long hours and low pay. Then I found USATruckPath.com and bought the Arabic version of the guide. It was perfect for me! I passed my CDL permit test on the first try. Thank you, USATruckPath!"</p>
                        <div class="flex text-gold">
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-8">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-green-600 mb-4">Choose Your Plan</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="flex justify-center">
                        <img src="{{ Storage::url($course->image ?? '') }}" alt="{{ $course->title }}" class="rounded-xl shadow-lg max-h-[400px] object-cover">
                    </div>
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-navy mb-6">What's Included in This Course</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Get ready to pass your Commercial Learner's Permit (CLP) and all CDL endorsements with this complete, easy-to-follow course designed for all 50 states. You'll learn everything you need to know through video lessons, audiobooks, and eBooks in Amharic and English. This course covers the General Knowledge test, Air Brakes, Combination Vehicles, Doubles/Triples, Hazmat, Tanker, Passenger, and School Bus endorsements.</p>

                        <div class="bg-light-gray rounded-xl p-6 text-center">
                            <p class="text-2xl font-bold text-navy mb-4">
                                Price:
                                @if($course->isTierCourse())
                                    <span class="text-green-600">FREE</span>
                                @else
                                    <span class="text-gold">${{ $course->price }}</span>
                                @endif
                            </p>
                            @guest
                                <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                                    Sign Up to Enroll
                                </a>
                            @else
                                @if (auth()->user()->hasApprovedCourse($course->id))
                                    <button class="w-full px-6 py-3 bg-green-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Already Enrolled</button>
                                @else
                                    @if ($course->status === 'upcoming')
                                        <button class="w-full px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg cursor-not-allowed" disabled>Coming Soon</button>
                                    @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-gold text-navy font-semibold rounded-lg hover:bg-gold/90 transition-colors">
                                            Continue Payment
                                        </a>
                                    @else
                                        <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-blue text-white font-semibold rounded-lg hover:bg-blue/90 transition-colors">
                                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                            Enroll Now
                                        </a>
                                    @endif
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</main>

<!-- Video Modal -->
<div id="video-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/80" onclick="closeVideoModal()"></div>
    <div class="absolute inset-4 md:inset-10 lg:inset-20 bg-black rounded-lg overflow-hidden flex flex-col">
        <div class="flex items-center justify-between p-4 bg-navy">
            <h3 id="video-modal-title" class="font-semibold text-white">Video</h3>
            <button onclick="closeVideoModal()" class="p-2 hover:bg-white/10 rounded-full text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div id="video-modal-content" class="flex-1 flex items-center justify-center">
            <!-- Video will be inserted here -->
        </div>
    </div>
</div>

<!-- Audio Modal -->
<div id="audio-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeAudioModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg w-full max-w-md overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 id="audio-modal-title" class="font-semibold text-navy">Audio</h3>
            <button onclick="closeAudioModal()" class="p-2 hover:bg-gray-100 rounded-full">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="p-6">
            <audio id="audio-player" controls class="w-full">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    function openVideoModal(id, title, url, type) {
        const modal = document.getElementById('video-modal');
        const titleEl = document.getElementById('video-modal-title');
        const contentEl = document.getElementById('video-modal-content');

        titleEl.textContent = title;

        if (type === 'local') {
            contentEl.innerHTML = `<video controls class="w-full h-full"><source src="${url}" type="video/mp4">Your browser does not support the video tag.</video>`;
        } else if (type === 'youtube' || type === 'vimeo') {
            contentEl.innerHTML = `<iframe src="${url}?autoplay=1" class="w-full h-full" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
        }

        modal.classList.remove('hidden');
        lucide.createIcons();
    }

    function closeVideoModal() {
        const modal = document.getElementById('video-modal');
        const contentEl = document.getElementById('video-modal-content');
        contentEl.innerHTML = '';
        modal.classList.add('hidden');
    }

    function openAudioModal(id, title, url) {
        const modal = document.getElementById('audio-modal');
        const titleEl = document.getElementById('audio-modal-title');
        const audioEl = document.getElementById('audio-player');

        titleEl.textContent = title;
        audioEl.src = url;

        modal.classList.remove('hidden');
        lucide.createIcons();
    }

    function closeAudioModal() {
        const modal = document.getElementById('audio-modal');
        const audioEl = document.getElementById('audio-player');
        audioEl.pause();
        audioEl.src = '';
        modal.classList.add('hidden');
    }

    function openReadingModal(id) {
        const modal = document.getElementById('reading-modal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeReadingModal(id) {
        const modal = document.getElementById('reading-modal-' + id);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection
