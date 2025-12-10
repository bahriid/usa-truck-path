@extends('new-design.partials.master')

@push('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
@endpush

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-12 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('frontend/img/whitetruck.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-[#0A2342]/80"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="font-heading text-2xl md:text-3xl font-bold text-[#F5B82E] mb-2">{{ $course->title }}</h1>
            <p class="text-gray-300">{{ $course->short_description ?? 'Unlock your trucking career with our full CDL permit prep course.' }}</p>
            <nav class="flex items-center gap-2 text-sm mt-4">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <span class="text-[#F5B82E]">{{ $course->title }}</span>
            </nav>

            <!-- Tier Badge -->
            <div class="mt-6">
                @guest
                    <a href="{{ route('register') }}?course_id={{ $course->id }}" class="inline-flex items-center gap-2 bg-[#F5B82E] text-[#0A2342] px-6 py-3 rounded-lg font-bold">
                        <i data-lucide="log-in" class="h-5 w-5"></i>
                        Login to Enroll
                    </a>
                @else
                    @php
                        $currentTier = auth()->user()->getSubscriptionTier($course->id);
                        $isEnrolled = auth()->user()->hasApprovedCourse($course->id);
                    @endphp

                    @if ($course->isTierCourse())
                        @if ($currentTier === 'free')
                            <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-300 px-4 py-2 rounded-full font-semibold">
                                <i data-lucide="check" class="h-5 w-5"></i> FREE ACCESS
                            </span>
                        @elseif ($currentTier === 'premium')
                            <span class="inline-flex items-center gap-2 bg-[#1B75F0]/20 text-[#1B75F0] px-4 py-2 rounded-full font-semibold">
                                <i data-lucide="star" class="h-5 w-5"></i> PREMIUM ACCESS
                            </span>
                        @endif
                    @elseif ($course->isLanguageSelectorCourse())
                        @if ($isEnrolled)
                            <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-300 px-4 py-2 rounded-full font-semibold">
                                <i data-lucide="check" class="h-5 w-5"></i> ENROLLED
                            </span>
                        @endif
                    @else
                        @if ($isEnrolled)
                            <span class="inline-flex items-center gap-2 bg-[#1B75F0]/20 text-[#1B75F0] px-4 py-2 rounded-full font-semibold">
                                <i data-lucide="check" class="h-5 w-5"></i> ENROLLED
                            </span>
                        @endif
                    @endif
                @endguest
            </div>
        </div>
    </section>

    @php
        $user = auth()->user();
        $currentTier = $user ? $user->getSubscriptionTier($course->id) : null;
        $hasPremiumAccess = $currentTier === 'premium';
        $autoOpen = request('auto_open') == 1;

        // Get first free topic
        $firstFreeTopic = null;
        $premiumTopics = collect();

        foreach ($course->chapters->sortBy('order') as $chapter) {
            foreach ($chapter->topics->sortBy('order') as $topic) {
                if ($topic->tier === 'free' && !$firstFreeTopic) {
                    $firstFreeTopic = $topic;
                }
                if ($topic->tier === 'premium') {
                    $premiumTopics->push(['topic' => $topic, 'chapter' => $chapter]);
                }
            }
        }
    @endphp

    <section class="py-12 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <!-- Two Boxes Section -->
            <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-8">
                <!-- Free Course Box -->
                <div class="bg-white border-2 border-green-500 rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-all cursor-pointer"
                     @if($firstFreeTopic) data-modal-target="freeTopicModal" data-modal-toggle="freeTopicModal" onclick="openModal('freeTopicModal')" @endif>
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="play-circle" class="h-10 w-10 text-green-500"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-green-600 mb-2">Free Course</h3>
                    <p class="text-gray-600 mb-4">
                        @if($firstFreeTopic)
                            {{ $firstFreeTopic->title }}
                        @else
                            No free content available
                        @endif
                    </p>
                    <span class="inline-flex items-center gap-2 bg-green-500 text-white px-6 py-2 rounded-full font-semibold">
                        <i data-lucide="unlock" class="h-5 w-5"></i> Watch Free
                    </span>
                </div>

                <!-- Premium Course Box -->
                @if($hasPremiumAccess)
                    <div class="bg-white border-2 border-[#F5B82E] rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-all cursor-pointer"
                         onclick="togglePremiumContent()">
                        <div class="w-20 h-20 bg-[#F5B82E]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="layout-grid" class="h-10 w-10 text-[#F5B82E]"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-2">Premium Course</h3>
                        <p class="text-gray-600 mb-4">{{ $premiumTopics->count() }} premium lessons available</p>
                        <span class="inline-flex items-center gap-2 bg-[#F5B82E] text-[#0A2342] px-6 py-2 rounded-full font-semibold">
                            <i data-lucide="check-circle" class="h-5 w-5"></i> View All Lessons
                        </span>
                    </div>
                @else
                    <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}" class="block">
                        <div class="bg-white border-2 border-[#F5B82E] rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-all cursor-pointer">
                            <div class="w-20 h-20 bg-[#F5B82E]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="lock" class="h-10 w-10 text-[#F5B82E]"></i>
                            </div>
                            <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-2">Premium Course</h3>
                            <p class="text-gray-600 mb-4">Unlock Premium Courses</p>
                            <span class="inline-flex items-center gap-2 bg-[#F5B82E] text-[#0A2342] px-6 py-2 rounded-full font-semibold">
                                <i data-lucide="shopping-cart" class="h-5 w-5"></i> Upgrade - ${{ number_format($course->getPremiumPrice(), 0) }}
                            </span>
                        </div>
                    </a>
                @endif
            </div>

            <!-- Premium Content Accordion (only visible for premium users) -->
            @if($hasPremiumAccess)
                <div id="premiumContent" class="{{ $autoOpen ? '' : 'hidden' }} max-w-4xl mx-auto">
                    <div class="bg-white border-2 border-[#F5B82E] rounded-2xl overflow-hidden shadow-lg">
                        <div class="bg-[#F5B82E] text-[#0A2342] px-6 py-4 flex items-center gap-2 font-bold">
                            <i data-lucide="layout-grid" class="h-5 w-5"></i>
                            Premium Course Content
                        </div>
                        <div class="divide-y divide-gray-100">
                            @php
                                $groupedByChapter = $premiumTopics->groupBy(fn($item) => $item['chapter']->id);
                            @endphp

                            @foreach($groupedByChapter as $chapterId => $chapterTopics)
                                @php
                                    $chapter = $chapterTopics->first()['chapter'];
                                    $chapterIndex = $loop->index;
                                @endphp
                                <div class="chapter-accordion">
                                    <button class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors" onclick="toggleChapter('chapter-{{ $chapterId }}')">
                                        <span class="font-semibold text-[#0A2342]">{{ $chapter->title }}</span>
                                        <span class="flex items-center gap-2">
                                            <span class="bg-[#F5B82E]/20 text-[#F5B82E] text-xs px-2 py-1 rounded-full font-semibold">{{ $chapterTopics->count() }} lessons</span>
                                            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400 chapter-icon" id="icon-chapter-{{ $chapterId }}"></i>
                                        </span>
                                    </button>
                                    <div id="chapter-{{ $chapterId }}" class="{{ $chapterIndex === 0 ? '' : 'hidden' }} bg-gray-50 px-6 py-4">
                                        <ul class="space-y-3">
                                            @foreach($chapterTopics as $item)
                                                @php $topic = $item['topic']; @endphp
                                                <li class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm">
                                                    <div class="flex items-center gap-3">
                                                        <span class="font-medium text-[#0A2342]">{{ $topic->title }}</span>
                                                        @if ($topic->type === 'video')
                                                            <span class="bg-[#1B75F0]/10 text-[#1B75F0] text-xs px-2 py-1 rounded-full">Video</span>
                                                        @elseif ($topic->type === 'voice')
                                                            <span class="bg-cyan-100 text-cyan-700 text-xs px-2 py-1 rounded-full">Audio</span>
                                                        @elseif ($topic->type === 'pdf')
                                                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">PDF</span>
                                                        @else
                                                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">Reading</span>
                                                        @endif
                                                    </div>

                                                    @if ($topic->type === 'voice' && $topic->voice)
                                                        <button class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-medium text-sm" onclick="openModal('audioModal{{ $topic->id }}')">
                                                            <i data-lucide="volume-2" class="h-4 w-4"></i> Play
                                                        </button>
                                                    @elseif($topic->type === 'pdf' && $topic->pdf)
                                                        <a href="{{ asset('storage/' . $topic->pdf) }}" target="_blank" class="inline-flex items-center gap-1 text-[#1B75F0] hover:text-[#0A2342] font-medium text-sm">
                                                            <i data-lucide="file-text" class="h-4 w-4"></i> View PDF
                                                        </a>
                                                    @elseif($topic->type === 'video')
                                                        <button class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-medium text-sm" onclick="openModal('videoModal{{ $topic->id }}')">
                                                            <i data-lucide="play-circle" class="h-4 w-4"></i> Play
                                                        </button>
                                                    @elseif($topic->description)
                                                        <button class="inline-flex items-center gap-1 text-[#1B75F0] hover:text-[#0A2342] font-medium text-sm" onclick="openModal('readingModal{{ $topic->id }}')">
                                                            <i data-lucide="book-open" class="h-4 w-4"></i> Open
                                                        </button>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Telegram Group Support Section -->
                    @auth
                        @php
                            $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                            $hasAccess = $enrollment && $enrollment->pivot->status === 'approved';
                        @endphp

                        @if ($hasAccess && $enrollment && $course->telegram_chat_id && $enrollment->pivot->telegram_invite_link)
                            <div class="bg-white border-2 border-cyan-500 rounded-2xl overflow-hidden shadow-lg mt-6">
                                <div class="bg-cyan-500 text-white px-6 py-4 flex items-center gap-2 font-bold">
                                    <i data-lucide="send" class="h-5 w-5"></i>
                                    Group Support
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-700 mb-4">
                                        Join our exclusive Telegram group to connect with instructors and fellow students.
                                        Get support, ask questions, and stay updated!
                                    </p>
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                                        <p class="text-amber-800 text-sm flex items-start gap-2">
                                            <i data-lucide="alert-triangle" class="h-5 w-5 flex-shrink-0 mt-0.5"></i>
                                            <span><strong>Important:</strong> This is a one-time invitation link generated uniquely for you. The link can only be used once and will stop working after one person joins.</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('telegram.invite.redeem', $course->id) }}"
                                       class="inline-flex items-center justify-center gap-2 w-full bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 rounded-lg transition-colors"
                                       onclick="return confirm('Are you sure? This link can only be used once!')">
                                        <i data-lucide="send" class="h-5 w-5"></i>
                                        Join Telegram Group Now
                                    </a>
                                    <p class="text-gray-500 text-xs mt-3">
                                        Link generated: {{ $enrollment->pivot->telegram_invite_generated_at ? \Carbon\Carbon::parse($enrollment->pivot->telegram_invite_generated_at)->diffForHumans() : 'Just now' }}
                                    </p>

                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-4">
                                        <p class="text-gray-700 text-sm">
                                            <strong>Need Help?</strong><br>
                                            If, for any reason, the Telegram group link does not work for you, please contact me directly on WhatsApp at <a href="https://wa.me/16146052310" target="_blank" class="text-green-600 font-bold">+1 (614) 605-2310</a>.<br>
                                            <em class="text-gray-500">This number is for support purposes only to help resolve your issue.</em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- Language Selection Section (only for language_selector courses) -->
            @if($course->isLanguageSelectorCourse())
                <div class="max-w-5xl mx-auto mt-12">
                    <div class="text-center mb-8">
                        <h2 class="font-heading text-2xl font-bold text-green-600 mb-2">Ready to Get the Full Course?</h2>
                        <p class="text-gray-600">Choose your preferred language and upgrade to the complete CLP course with video lessons, audio guides, downloadable eBook, and lifetime access to our Telegram community support.</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($course->languageCourses as $langCourse)
                            <div class="bg-white rounded-2xl shadow-lg p-6 text-center border-2 border-transparent hover:border-[#F5B82E] transition-all">
                                <div class="w-16 h-16 bg-[#F5B82E]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="languages" class="h-8 w-8 text-[#F5B82E]"></i>
                                </div>
                                <h4 class="font-heading font-bold text-[#0A2342] text-lg mb-2">CLP {{ $langCourse->getLanguageName() }}</h4>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($langCourse->description ?? ''), 80) }}</p>

                                <div class="flex justify-center items-center gap-2 mb-4">
                                    @if($langCourse->original_price)
                                        <span class="text-gray-400 line-through">${{ number_format($langCourse->original_price, 2) }}</span>
                                    @endif
                                    <span class="text-2xl font-bold text-green-500">${{ number_format($langCourse->price, 2) }}</span>
                                </div>

                                @guest
                                    <a href="{{ route('register') }}?course_id={{ $langCourse->id }}" class="inline-flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition-colors">
                                        <i data-lucide="unlock" class="h-5 w-5"></i> Upgrade to {{ $langCourse->getLanguageName() }}
                                    </a>
                                @else
                                    @if(auth()->user()->hasApprovedCourse($langCourse->id))
                                        <a href="{{ route('course.curriculam', $langCourse->id) }}" class="inline-flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition-colors">
                                            <i data-lucide="check-circle" class="h-5 w-5"></i> Go to Course
                                        </a>
                                    @elseif(auth()->user()->hasPurchasedCourse($langCourse->id))
                                        <a href="{{ route('front.courses.enrollForm', $langCourse->id) }}" class="inline-flex items-center justify-center gap-2 w-full bg-[#F5B82E] text-[#0A2342] font-bold py-3 rounded-lg transition-colors">
                                            <i data-lucide="credit-card" class="h-5 w-5"></i> Continue Payment
                                        </a>
                                    @else
                                        <a href="{{ route('front.courses.enrollForm', $langCourse->id) }}" class="inline-flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition-colors">
                                            <i data-lucide="unlock" class="h-5 w-5"></i> Upgrade to {{ $langCourse->getLanguageName() }}
                                        </a>
                                    @endif
                                @endguest
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-[#1B75F0]/10 border border-[#1B75F0]/20 rounded-xl p-4 mt-8 text-center">
                        <p class="text-[#0A2342]">
                            <strong>One-Time Payment, Lifetime Access!</strong> Get instant access to all course materials, updates, and our supportive Telegram community.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>

<!-- Modals -->
@if($firstFreeTopic)
    <div id="freeTopicModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-black/50" onclick="closeModal('freeTopicModal')"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden">
                <div class="bg-green-500 text-white px-6 py-4 flex items-center justify-between">
                    <h3 class="font-bold flex items-center gap-2">
                        <i data-lucide="play-circle" class="h-5 w-5"></i>
                        {{ $firstFreeTopic->title }}
                    </h3>
                    <button onclick="closeModal('freeTopicModal')" class="text-white hover:text-gray-200">
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <div class="p-6">
                    @if ($firstFreeTopic->type === 'voice' && $firstFreeTopic->voice)
                        <audio controls class="w-full audio-player">
                            <source src="{{ asset('storage/' . $firstFreeTopic->voice) }}" type="audio/mpeg">
                        </audio>
                    @elseif($firstFreeTopic->type === 'pdf' && $firstFreeTopic->pdf)
                        <iframe src="{{ asset('storage/' . $firstFreeTopic->pdf) }}" class="w-full h-96"></iframe>
                    @elseif($firstFreeTopic->type === 'video')
                        @if ($firstFreeTopic->source_from === 'local' && $firstFreeTopic->local_video)
                            <video class="plyr__video-player w-full" controls>
                                <source src="{{ asset('storage/' . $firstFreeTopic->local_video) }}" type="video/mp4">
                            </video>
                        @elseif($firstFreeTopic->source_from === 'youtube' && $firstFreeTopic->video_url)
                            <div class="plyr__video-embed">
                                <iframe src="{{ $firstFreeTopic->getEmbedUrl() }}?origin={{ url('/') }}&iv_load_policy=3&modestbranding=1&rel=0" allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        @elseif($firstFreeTopic->source_from === 'vimeo' && $firstFreeTopic->video_url)
                            <div class="plyr__video-embed">
                                <iframe src="{{ $firstFreeTopic->getEmbedUrl() }}" allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        @else
                            <p>Video not available. <a href="{{ $firstFreeTopic->video_url }}" target="_blank" class="text-[#1B75F0]">Open external link</a></p>
                        @endif
                    @elseif($firstFreeTopic->description)
                        <div class="prose max-w-none">{!! $firstFreeTopic->description !!}</div>
                    @else
                        <p class="text-gray-500">Content not available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

@if($hasPremiumAccess)
    @foreach($premiumTopics as $item)
        @php $topic = $item['topic']; @endphp

        @if ($topic->type === 'voice' && $topic->voice)
            <div id="audioModal{{ $topic->id }}" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="fixed inset-0 bg-black/50" onclick="closeModal('audioModal{{ $topic->id }}')"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
                        <div class="bg-[#0A2342] text-white px-6 py-4 flex items-center justify-between">
                            <h3 class="font-bold">{{ $topic->title }}</h3>
                            <button onclick="closeModal('audioModal{{ $topic->id }}')" class="text-white hover:text-gray-200">
                                <i data-lucide="x" class="h-6 w-6"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            <audio controls class="w-full audio-player">
                                <source src="{{ asset('storage/' . $topic->voice) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($topic->type === 'video')
            <div id="videoModal{{ $topic->id }}" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="fixed inset-0 bg-black/50" onclick="closeModal('videoModal{{ $topic->id }}')"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 overflow-hidden">
                        <div class="bg-[#0A2342] text-white px-6 py-4 flex items-center justify-between">
                            <h3 class="font-bold">{{ $topic->title }}</h3>
                            <button onclick="closeModal('videoModal{{ $topic->id }}')" class="text-white hover:text-gray-200">
                                <i data-lucide="x" class="h-6 w-6"></i>
                            </button>
                        </div>
                        <div class="p-6">
                            @if ($topic->source_from === 'local' && $topic->local_video)
                                <video class="plyr__video-player w-full" controls>
                                    <source src="{{ asset('storage/' . $topic->local_video) }}" type="video/mp4">
                                </video>
                            @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                <div class="plyr__video-embed">
                                    <iframe src="{{ $topic->getEmbedUrl() }}?origin={{ url('/') }}&iv_load_policy=3&modestbranding=1&rel=0" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                </div>
                            @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                <div class="plyr__video-embed">
                                    <iframe src="{{ $topic->getEmbedUrl() }}" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                </div>
                            @else
                                <p>Video not available. <a href="{{ $topic->video_url }}" target="_blank" class="text-[#1B75F0]">Open external link</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif($topic->description)
            <div id="readingModal{{ $topic->id }}" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="fixed inset-0 bg-black/50" onclick="closeModal('readingModal{{ $topic->id }}')"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 overflow-hidden max-h-[90vh] flex flex-col">
                        <div class="bg-[#0A2342] text-white px-6 py-4 flex items-center justify-between flex-shrink-0">
                            <h3 class="font-bold">{{ $topic->title }}</h3>
                            <button onclick="closeModal('readingModal{{ $topic->id }}')" class="text-white hover:text-gray-200">
                                <i data-lucide="x" class="h-6 w-6"></i>
                            </button>
                        </div>
                        <div class="p-6 overflow-y-auto">
                            <div class="prose max-w-none">{!! $topic->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

@push('scripts')
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
    // Initialize Plyr
    document.addEventListener('DOMContentLoaded', () => {
        const players = Array.from(document.querySelectorAll('.plyr__video-player, .plyr__video-embed, .audio-player'))
            .map((p) => new Plyr(p));
    });

    // Modal functions
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Pause any playing media
        const modal = document.getElementById(id);
        const audio = modal.querySelector('audio');
        const video = modal.querySelector('video');
        if (audio) { audio.pause(); audio.currentTime = 0; }
        if (video) { video.pause(); video.currentTime = 0; }
    }

    // Toggle premium content
    function togglePremiumContent() {
        const content = document.getElementById('premiumContent');
        content.classList.toggle('hidden');
    }

    // Toggle chapter accordion
    function toggleChapter(id) {
        const chapter = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);
        chapter.classList.toggle('hidden');
        if (chapter.classList.contains('hidden')) {
            icon.style.transform = 'rotate(0deg)';
        } else {
            icon.style.transform = 'rotate(180deg)';
        }
    }

    // Auto-open free lesson modal when coming from registration
    @if($autoOpen && $firstFreeTopic)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                openModal('freeTopicModal');
            }, 500);
        });
    @endif
</script>
@endpush
@endsection
