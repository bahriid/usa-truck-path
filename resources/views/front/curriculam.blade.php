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

        {{-- Tier-based Upgrade Banner --}}
        @auth
            @php
                $user = auth()->user();
                $currentTier = $user->getSubscriptionTier($course->id);
            @endphp

            @if($course->isTierCourse() && $currentTier && $currentTier === 'free')
                <section class="container my-4">
                    <div class="alert alert-info border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="row align-items-center text-white">
                            <div class="col-md-8">
                                <h3 class="mb-2">🚀 Ready to Level Up?</h3>
                                <p class="mb-0">Unlock all premium content and features, including exclusive Telegram group access!</p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}"
                                   class="btn btn-light btn-lg mb-2">
                                    <i class="bi bi-arrow-up-circle"></i> Upgrade to Premium - ${{ number_format($course->getPremiumPrice(), 0) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endauth

        <section class="row container mx-auto">

            <div class="col-lg-12">
                <div class="course-curriculum">
                    <h3 class="mb-3">Course Curriculum</h3>

                    {{-- Legend for Free vs Premium --}}
                    <div class="d-flex flex-wrap gap-3 mb-3 p-3 bg-white rounded shadow-sm">
                        <div class="d-flex align-items-center">
                            <span class="d-inline-block me-2" style="width: 4px; height: 20px; background-color: #198754; border-radius: 2px;"></span>
                            <span class="badge bg-success me-1">✓ FREE</span>
                            <small class="text-muted">Included with free signup</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="d-inline-block me-2" style="width: 4px; height: 20px; background-color: #ffc107; border-radius: 2px;"></span>
                            <span class="badge bg-warning text-dark me-1">🔒 PREMIUM</span>
                            <small class="text-muted">Requires upgrade</small>
                        </div>
                    </div>

                    <div class="accordion" id="curriculumAccordion">
                        @php
                            $chapters = $course->chapters;
                            $chapters = $chapters->sortBy('order');
                        @endphp

                        @forelse ($chapters as $index => $chapter)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="chapterHeading{{ $index }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chapterCollapse{{ $index }}" aria-expanded="false"
                                        aria-controls="chapterCollapse{{ $index }}">
                                        {{ $chapter->title }}
                                    </button>
                                </h2>
                                <div id="chapterCollapse{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="chapterHeading{{ $index }}"
                                    data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        @if ($chapter->topics->count() > 0)
                                            <ul class="list-group">
                                                @foreach ($chapter->topics as $topic)
                                                    @php
                                                        $isPremium = $topic->tier === 'premium';
                                                        $isFree = $topic->tier === 'free';
                                                    @endphp
                                                    <li class="list-group-item d-flex justify-content-between align-items-center {{ $isPremium ? 'border-start border-4 border-warning bg-light' : ($isFree ? 'border-start border-4 border-success' : '') }}">
                                                        <div>
                                                            <strong>{{ $topic->title }}</strong>

                                                            {{-- Content Type Badge --}}
                                                            @if ($topic->type === 'video')
                                                                <span class="badge bg-primary ms-2">Video</span>
                                                            @elseif ($topic->type === 'voice')
                                                                <span class="badge bg-info ms-2">Audio</span>
                                                            @elseif ($topic->type === 'pdf')
                                                                <span class="badge bg-warning text-dark ms-2">PDF</span>
                                                            @else
                                                                <span class="badge bg-secondary ms-2">Reading</span>
                                                            @endif

                                                            {{-- Tier Badge --}}
                                                            @if ($isFree)
                                                                <span class="badge bg-success ms-2">✓ FREE</span>
                                                            @elseif ($isPremium)
                                                                <span class="badge bg-warning text-dark ms-2">🔒 PREMIUM</span>
                                                            @endif
                                                        </div>

                                                        @php
                                                            $user = auth()->user();
                                                            $hasAccess = $user && $user->canAccessTopic($topic, $course->id);
                                                        @endphp

                                                        @if ($hasAccess)
                                                            @if ($topic->type === 'voice' && $topic->voice)
                                                                <!-- Button to Open Modal -->
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#audioModal{{ $topic->id }}">
                                                                    <i class="bi bi-volume-up"></i>
                                                                    Play Audio
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="audioModal{{ $topic->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <!-- Audio Player -->
                                                                                <audio
                                                                                    id="audio-player-{{ $topic->id }}"
                                                                                    controls style="width: 100%;"
                                                                                    class="audio-player">
                                                                                    <source
                                                                                        src="{{ asset('storage/' . $topic->voice) }}"
                                                                                        type="audio/mpeg">
                                                                                    Your browser does not support
                                                                                    the audio tag.
                                                                                </audio>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'pdf' && $topic->pdf)
                                                                <!-- Open PDF in a new tab -->
                                                                <span>


                                                                    <a href="{{ asset('storage/' . $topic->pdf) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-file-earmark-pdf"></i> View
                                                                        PDF
                                                                    </a>

                                                                    <!-- Open PDF in Modal -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#pdfModal{{ $topic->id }}">
                                                                        <i class="bi bi-eye"></i> Preview PDF
                                                                    </button>
                                                                </span>
                                                                <!-- PDF Modal -->
                                                                <div class="modal fade" id="pdfModal{{ $topic->id }}"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $topic->title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <iframe
                                                                                    src="{{ asset('storage/' . $topic->pdf) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($topic->type === 'video')
                                                                {{-- Check source (local, youtube, vimeo, etc.) --}}
                                                                @if ($topic->source_from === 'local' && $topic->local_video)
                                                                    <!-- Button to open a modal or new page with the Plyr player -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video

                                                                    </button>

                                                                    <!-- Modal with Plyr for local video -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <video
                                                                                        id="player-local-{{ $topic->id }}"
                                                                                        class="plyr__video-player" controls
                                                                                        style="width: 100%">
                                                                                        <source
                                                                                            src="{{ asset('storage/' . $topic->local_video) }}"
                                                                                            type="video/mp4">
                                                                                        Your browser does not
                                                                                        support the video tag.
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                                                    <!-- Use Plyr embed for YouTube -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <!-- Modal for embedded YouTube -->
                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->getEmbedUrl() }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                                                    <!-- Similar embed logic for Vimeo -->
                                                                    <button class="btn btn-sm btn-outline-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#videoModal{{ $topic->id }}">
                                                                        <i class="bi bi-play-circle"></i>
                                                                        Play Video
                                                                    </button>

                                                                    <div class="modal fade"
                                                                        id="videoModal{{ $topic->id }}" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="plyr__video-embed"
                                                                                        id="player-embed-{{ $topic->id }}">
                                                                                        <iframe
                                                                                            src="{{ $topic->getEmbedUrl() }}"
                                                                                            allowfullscreen
                                                                                            allowtransparency
                                                                                            allow="autoplay"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If 'other' or no recognized source -->
                                                                    <a href="{{ $topic->video_url }}" target="_blank"
                                                                        class="btn btn-sm btn-outline-success"><i
                                                                            class="bi bi-play-circle"></i>Play
                                                                        Video</a>
                                                                @endif
                                                            @else
                                                                {{-- Reading type --}}
                                                                @if ($topic->description)
                                                                    <!-- If it's textual reading, you can show it in a modal or link to a PDF -->
                                                                    <button class="btn btn-sm btn-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#readingModal{{ $topic->id }}">
                                                                        <i class="bi bi-book"></i>
                                                                        Open Reading
                                                                    </button>

                                                                    <!-- Modal for reading content -->
                                                                    <div class="modal fade"
                                                                        id="readingModal{{ $topic->id }}"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        {{ $topic->title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {!! $topic->description !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- If it's a PDF stored locally, you can link or embed it. For example: -->
                                                                    <a href="{{ asset('storage/' . $topic->pdf_file) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">Open
                                                                        PDF</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{-- Locked content --}}
                                                            @auth
                                                                @php
                                                                    $currentTier = auth()->user()->getSubscriptionTier($course->id);
                                                                @endphp

                                                                @if ($topic->tier === 'premium' && $currentTier === 'free')
                                                                    <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}"
                                                                       class="btn btn-sm btn-warning text-dark">
                                                                        <i class="bi bi-unlock"></i> Unlock
                                                                    </a>
                                                                @else
                                                                    <button class="btn btn-sm btn-secondary" disabled>
                                                                        <i class="bi bi-lock"></i> Locked
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <a href="{{ route('register') }}?course_id={{ $course->id }}"
                                                                   class="btn btn-sm btn-success">
                                                                    <i class="bi bi-person-plus"></i> Sign Up Free
                                                                </a>
                                                            @endauth
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">No topics in this chapter.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No chapters found for this course.</p>
                        @endforelse

                        {{-- Telegram Group Support Section (ONLY for Premium Tier) --}}
                        @auth
                            @php
                                $user = auth()->user();
                                $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                                $currentTier = $user->getSubscriptionTier($course->id);
                                $hasAccess = $enrollment && $enrollment->pivot->status === 'approved';
                            @endphp

                            @if ($hasAccess && $enrollment && $currentTier === 'premium' && $course->telegram_chat_id && $enrollment->pivot->telegram_invite_link)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#telegramSupport" aria-expanded="false"
                                            aria-controls="telegramSupport">
                                            <i class="bi bi-telegram me-2"></i> Group Support
                                        </button>
                                    </h2>
                                    <div id="telegramSupport" class="accordion-collapse collapse">
                                        <div class="accordion-body">
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
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
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
@endsection
