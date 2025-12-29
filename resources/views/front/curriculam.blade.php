@extends('partials.master')

@section('main')
    <main class="main">
        <section class="course-hero"
            style="background-image: url('{{ asset('frontend/img/whitetruck.jpg') }}'); background-size: cover; background-position: center 80%; background-repeat:no-repeat;  padding: 100px 0; position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color:#0a3d1ab0;"></div>
            <div class="container" style="position: relative; z-index: 1;">
                <div class="row align-items-center">
                    <div class="col-md-8 text-white">
                        <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold;  color:var(--accent-color)  ;">
                            {{ $course->title }}</h1>
                        <p class="lead mb-4">
                            {{ $course->short_description ?? 'Unlock your trucking career with our full CDL permit prep course — with video, audio, and eBook lessons.' }}
                        </p>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"
                                        class="text-white text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" style="  color:var(--accent-color);" aria-current="page">
                                    {{ $course->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-4 text-md-end button-section">
                        @guest
                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Sign Up Free</a>
                        @else
                            @php
                                $currentTier = auth()->user()->getSubscriptionTier($course->id);
                                $isEnrolled = auth()->user()->hasApprovedCourse($course->id);
                            @endphp

                            @if ($course->isTierCourse())
                                {{-- Tier-based course: show tier badges --}}
                                @if ($currentTier === 'free')
                                    <span class="badge bg-success fs-6 me-2">FREE ACCESS</span>
                                @elseif ($currentTier === 'premium')
                                    <span class="badge bg-primary fs-6 me-2">PREMIUM ACCESS</span>
                                @else
                                    <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Sign Up Free</a>
                                @endif
                            @elseif ($course->isLanguageSelectorCourse())
                                {{-- Language selector course (free): show enrolled --}}
                                @if ($isEnrolled)
                                    <span class="badge bg-success fs-6 me-2">ENROLLED</span>
                                @endif
                            @else
                                {{-- Regular paid course: show enrolled --}}
                                @if ($isEnrolled)
                                    <span class="badge bg-primary fs-6 me-2">ENROLLED</span>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <section class="container mt-4">
            @php
                $user = auth()->user();
                $currentTier = $user ? $user->getSubscriptionTier($course->id) : null;
                $isEnrolledAndApproved = $user && $user->hasApprovedCourse($course->id);

                // For paid courses, enrollment = full access. For tier courses, need premium tier.
                $hasPremiumAccess = ($course->course_type === 'paid' && $isEnrolledAndApproved)
                                  || $currentTier === 'premium';
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

            {{-- Two Boxes Section --}}
            <div class="row g-4 mb-4">
                {{-- Free Course Box --}}
                <div class="col-md-6">
                    <div class="card h-100 border-2 border-success shadow-sm" style="cursor: pointer;"
                         @if($firstFreeTopic)
                             data-bs-toggle="modal" data-bs-target="#freeTopicModal"
                         @endif>
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="bi bi-play-circle-fill text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title fw-bold text-success mb-3">Free Course</h3>
                            <p class="card-text text-muted mb-4">
                                @if($firstFreeTopic)
                                    {{ $firstFreeTopic->title }}
                                @else
                                    No free content available
                                @endif
                            </p>
                            <span class="badge bg-success fs-6 px-4 py-2">
                                <i class="bi bi-unlock-fill me-2"></i>Watch Free
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Paid Course Box (hidden only for course 20) --}}
                @if($course->id != 20)
                <div class="col-md-6">
                    @if($hasPremiumAccess)
                        {{-- User has premium - show button to expand paid content --}}
                        <div class="card h-100 border-2 border-warning shadow-sm" style="cursor: pointer;"
                             data-bs-toggle="collapse" data-bs-target="#paidContentAccordion">
                            <div class="card-body text-center p-5">
                                <div class="mb-3">
                                    <i class="bi bi-collection-play-fill text-warning" style="font-size: 4rem;"></i>
                                </div>
                                <h3 class="card-title fw-bold text-dark mb-3">Premium Course</h3>
                                <p class="card-text text-muted mb-4">
                                    {{ $premiumTopics->count() }} premium lessons available
                                </p>
                                <span class="badge bg-warning text-dark fs-6 px-4 py-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>View All Lessons
                                </span>
                            </div>
                        </div>
                    @else
                        {{-- User needs to pay - redirect to payment --}}
                        @if($course->course_type === 'paid')
                            {{-- Paid course: use course price and link to enroll form --}}
                            <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="text-decoration-none">
                                <div class="card h-100 border-2 border-warning shadow-sm" style="cursor: pointer;">
                                    <div class="card-body text-center p-5">
                                        <div class="mb-3">
                                            <i class="bi bi-lock-fill text-warning" style="font-size: 4rem;"></i>
                                        </div>
                                        <h3 class="card-title fw-bold text-dark mb-3">Premium Course</h3>
                                        <p class="card-text text-muted mb-4">
                                            Unlock Premium Courses
                                        </p>
                                        <span class="badge bg-warning text-dark fs-6 px-4 py-2">
                                            <i class="bi bi-cart-fill me-2"></i>Upgrade - ${{ number_format($course->price, 0) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @else
                            {{-- Tier course: use premium price and link to tier upgrade --}}
                            <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}" class="text-decoration-none">
                                <div class="card h-100 border-2 border-warning shadow-sm" style="cursor: pointer;">
                                    <div class="card-body text-center p-5">
                                        <div class="mb-3">
                                            <i class="bi bi-lock-fill text-warning" style="font-size: 4rem;"></i>
                                        </div>
                                        <h3 class="card-title fw-bold text-dark mb-3">Premium Course</h3>
                                        <p class="card-text text-muted mb-4">
                                            Unlock Premium Courses
                                        </p>
                                        <span class="badge bg-warning text-dark fs-6 px-4 py-2">
                                            <i class="bi bi-cart-fill me-2"></i>Upgrade - ${{ number_format($course->getPremiumPrice(), 0) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                </div>
                @endif
            </div>

            {{-- Premium Content Accordion (only visible for premium users) --}}
            @if($hasPremiumAccess)
                <div class="collapse {{ $autoOpen ? 'show' : '' }}" id="paidContentAccordion">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark fw-bold">
                            <i class="bi bi-collection-play me-2"></i>Premium Course Content
                        </div>
                        <div class="card-body p-0">
                            <div class="accordion" id="premiumAccordion">
                                @php
                                    $groupedByChapter = $premiumTopics->groupBy(fn($item) => $item['chapter']->id);
                                @endphp

                                @foreach($groupedByChapter as $chapterId => $chapterTopics)
                                    @php
                                        $chapter = $chapterTopics->first()['chapter'];
                                        $chapterIndex = $loop->index;
                                    @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $chapterIndex === 0 ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#premiumChapter{{ $chapterId }}">
                                                {{ $chapter->title }}
                                                <span class="badge bg-warning text-dark ms-2">{{ $chapterTopics->count() }} lessons</span>
                                            </button>
                                        </h2>
                                        <div id="premiumChapter{{ $chapterId }}"
                                             class="accordion-collapse collapse {{ $chapterIndex === 0 ? 'show' : '' }}"
                                             data-bs-parent="#premiumAccordion">
                                            <div class="accordion-body p-0">
                                                <ul class="list-group list-group-flush">
                                                    @foreach($chapterTopics as $item)
                                                        @php $topic = $item['topic']; @endphp
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <strong>{{ $topic->title }}</strong>
                                                                @if ($topic->type === 'video')
                                                                    <span class="badge bg-primary ms-2">Video</span>
                                                                @elseif ($topic->type === 'voice')
                                                                    <span class="badge bg-info ms-2">Audio</span>
                                                                @elseif ($topic->type === 'pdf')
                                                                    <span class="badge bg-secondary ms-2">PDF</span>
                                                                @else
                                                                    <span class="badge bg-secondary ms-2">Reading</span>
                                                                @endif
                                                            </div>

                                                            {{-- Topic action buttons --}}
                                                            @if ($topic->type === 'voice' && $topic->voice)
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#premiumAudioModal{{ $topic->id }}">
                                                                    <i class="bi bi-volume-up"></i> Play Audio
                                                                </button>
                                                            @elseif($topic->type === 'pdf' && $topic->pdf)
                                                                <span>
                                                                    <a href="{{ asset('storage/' . $topic->pdf) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                                                    </a>
                                                                </span>
                                                            @elseif($topic->type === 'video')
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#premiumVideoModal{{ $topic->id }}">
                                                                    <i class="bi bi-play-circle"></i> Play Video
                                                                </button>
                                                            @elseif($topic->description)
                                                                <button class="btn btn-sm btn-outline-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#premiumReadingModal{{ $topic->id }}">
                                                                    <i class="bi bi-book"></i> Open Reading
                                                                </button>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Telegram Group Support Section (ONLY for Premium Tier) --}}
                    @auth
                        @php
                            $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                            $hasAccess = $enrollment && $enrollment->pivot->status === 'approved';
                        @endphp

                        @if ($hasAccess && $enrollment && $course->telegram_chat_id && $enrollment->pivot->telegram_invite_link)
                            <div class="card border-info mt-3">
                                <div class="card-header bg-info text-white fw-bold">
                                    <i class="bi bi-telegram me-2"></i>Group Support
                                </div>
                                <div class="card-body">
                                    <p class="mb-3">
                                        <i class="bi bi-info-circle text-primary me-1"></i>
                                        Join our exclusive Telegram group to connect with instructors and fellow students.
                                        Get support, ask questions, and stay updated!
                                    </p>
                                    <div class="alert alert-warning border-0 mb-3">
                                        <small>
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <strong>Important:</strong> This is a one-time invitation link generated uniquely for you.
                                            The link can only be used once and will stop working after one person joins.
                                        </small>
                                    </div>
                                    <a href="{{ route('telegram.invite.redeem', $course->id) }}"
                                       class="btn btn-success w-100"
                                       onclick="return confirm('Are you sure? This link can only be used once!')">
                                        <i class="bi bi-telegram me-2"></i> Join Telegram Group Now
                                    </a>
                                    <p class="text-muted small mt-2 mb-0">
                                        <i class="bi bi-clock me-1"></i>Link generated: {{ $enrollment->pivot->telegram_invite_generated_at ? \Carbon\Carbon::parse($enrollment->pivot->telegram_invite_generated_at)->diffForHumans() : 'Just now' }}
                                    </p>

                                    <div class="alert alert-light border mt-3 mb-0">
                                        <p class="small mb-0">
                                            <i class="bi bi-whatsapp text-success me-1"></i>
                                            <strong>Need Help?</strong><br>
                                            If, for any reason, the Telegram group link does not work for you, please contact me directly on WhatsApp at <a href="https://wa.me/16146052310" target="_blank" class="text-success fw-bold">+1 (614) 605-2310</a>.<br>
                                            <em class="text-muted">This number is for support purposes only to help resolve your issue — it is not a general communication line.</em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Premium Topic Modals --}}
                @foreach($premiumTopics as $item)
                    @php $topic = $item['topic']; @endphp

                    @if ($topic->type === 'voice' && $topic->voice)
                        <div class="modal fade" id="premiumAudioModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $topic->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <audio controls style="width: 100%;" class="audio-player">
                                            <source src="{{ asset('storage/' . $topic->voice) }}" type="audio/mpeg">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($topic->type === 'video')
                        <div class="modal fade" id="premiumVideoModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $topic->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($topic->source_from === 'local' && $topic->local_video)
                                            <video class="plyr__video-player" controls style="width: 100%">
                                                <source src="{{ asset('storage/' . $topic->local_video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                            <div class="plyr__video-embed">
                                                <iframe src="{{ $topic->getEmbedUrl() }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                        allowfullscreen allowtransparency allow="autoplay"></iframe>
                                            </div>
                                        @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                            <div class="plyr__video-embed">
                                                <iframe src="{{ $topic->getEmbedUrl() }}" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                            </div>
                                        @else
                                            <p>Video not available. <a href="{{ $topic->video_url }}" target="_blank">Open external link</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($topic->description)
                        <div class="modal fade" id="premiumReadingModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $topic->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! $topic->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            {{-- Free Topic Modal --}}
            @if($firstFreeTopic)
                <div class="modal fade" id="freeTopicModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">
                                    <i class="bi bi-play-circle me-2"></i>{{ $firstFreeTopic->title }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($firstFreeTopic->type === 'voice' && $firstFreeTopic->voice)
                                    <audio controls style="width: 100%;" class="audio-player">
                                        <source src="{{ asset('storage/' . $firstFreeTopic->voice) }}" type="audio/mpeg">
                                        Your browser does not support the audio tag.
                                    </audio>
                                @elseif($firstFreeTopic->type === 'pdf' && $firstFreeTopic->pdf)
                                    <iframe src="{{ asset('storage/' . $firstFreeTopic->pdf) }}" width="100%" height="500px"></iframe>
                                @elseif($firstFreeTopic->type === 'video')
                                    @if ($firstFreeTopic->source_from === 'local' && $firstFreeTopic->local_video)
                                        <video class="plyr__video-player" controls style="width: 100%">
                                            <source src="{{ asset('storage/' . $firstFreeTopic->local_video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif($firstFreeTopic->source_from === 'youtube' && $firstFreeTopic->video_url)
                                        <div class="plyr__video-embed">
                                            <iframe src="{{ $firstFreeTopic->getEmbedUrl() }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                                        </div>
                                    @elseif($firstFreeTopic->source_from === 'vimeo' && $firstFreeTopic->video_url)
                                        <div class="plyr__video-embed">
                                            <iframe src="{{ $firstFreeTopic->getEmbedUrl() }}" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                        </div>
                                    @else
                                        <p>Video not available. <a href="{{ $firstFreeTopic->video_url }}" target="_blank">Open external link</a></p>
                                    @endif
                                @elseif($firstFreeTopic->description)
                                    {!! $firstFreeTopic->description !!}
                                @else
                                    <p class="text-muted">Content not available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        {{-- Language Selection Section (only for language_selector courses) --}}
        @if($course->isLanguageSelectorCourse())
            <section id="language-selector-section" class="language-selector-section py-5 bg-light">
                <div class="container">
                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-10 text-center">
                            <h2 class="fw-bold text-success mb-3">Ready to Get the Full Course?</h2>
                            <p class="lead text-muted">Choose your preferred language and upgrade to the complete CLP course with video lessons, audio guides, downloadable eBook, and lifetime access to our Telegram community support.</p>
                        </div>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @foreach($course->languageCourses as $langCourse)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <div class="icon-box mb-3">
                                            <i class="bi bi-translate" style="font-size: 3rem; color: var(--accent-color);"></i>
                                        </div>
                                        <h4 class="card-title fw-bold mb-3">CLP {{ $langCourse->getLanguageName() }}</h4>
                                        <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($langCourse->description ?? ''), 100, '...') }}</p>

                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            @if($langCourse->original_price)
                                                <span class="text-decoration-line-through text-muted me-2" style="font-size: 1.2rem;">${{ number_format($langCourse->original_price, 2) }}</span>
                                            @endif
                                            <span class="fw-bold" style="color: #5fcf80; font-size: 2rem;">${{ number_format($langCourse->price, 2) }}</span>
                                        </div>

                                        @guest
                                            <a href="{{ route('register') }}?course_id={{ $langCourse->id }}" class="btn btn-success w-100">
                                                <i class="bi bi-unlock-fill me-2"></i>Upgrade to {{ $langCourse->getLanguageName() }}
                                            </a>
                                        @else
                                            @if(auth()->user()->hasApprovedCourse($langCourse->id))
                                                <a href="{{ route('course.curriculam', $langCourse->id) }}" class="btn btn-success w-100">
                                                    <i class="bi bi-check-circle-fill me-2"></i>Go to Course
                                                </a>
                                            @elseif(auth()->user()->hasPurchasedCourse($langCourse->id))
                                                <a href="{{ route('front.courses.enrollForm', $langCourse->id) }}" class="btn btn-warning w-100">
                                                    <i class="bi bi-credit-card me-2"></i>Continue Payment
                                                </a>
                                            @else
                                                <a href="{{ route('front.courses.enrollForm', $langCourse->id) }}" class="btn btn-success w-100">
                                                    <i class="bi bi-unlock-fill me-2"></i>Upgrade to {{ $langCourse->getLanguageName() }}
                                                </a>
                                            @endif
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-8 mx-auto text-center">
                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <strong>One-Time Payment, Lifetime Access!</strong> Get instant access to all course materials, updates, and our supportive Telegram community.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    {{-- Auto-open free lesson modal when coming from registration --}}
    @if($autoOpen && $firstFreeTopic)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Small delay to ensure Bootstrap is fully initialized
                setTimeout(function() {
                    var freeModal = document.getElementById('freeTopicModal');
                    if (freeModal && typeof bootstrap !== 'undefined') {
                        var modal = new bootstrap.Modal(freeModal);
                        modal.show();
                    }
                }, 500);
            });
        </script>
    @endif
@endsection
