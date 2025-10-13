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
                            {{-- <a href="{{ route('register') }}" class="cta-btn">Login to Enroll</a> --}}
                            <a href="{{ route('register') }}?course_id={{ $course->id }}" class="cta-btn">Login to Enroll</a>
                        @else
                            @if (auth()->user()->hasApprovedCourse($course->id))
                                <button class="btn btn-success " disabled>Already Enrolled</button>
                            @else
                                @if ($course->status === 'upcoming')
                                    <button class="btn btn-secondary " disabled>Up Coming</button>
                                @elseif(auth()->user()->hasPurchasedCourse($course->id))
                                    <button class="btn btn-info  w-100" disabled>Request Pending...</button>
                                @else
                                    <a href="{{ route('stripe.payment.view', $course->id) }}" class="cta-btn">Enroll Now</a>
                                @endif
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <section class="row container mx-auto">

            <div class="col-lg-12">
                <div class="course-curriculum">
                    <h3 class="mb-3">Course Curriculum</h3>
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
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $topic->title }}</strong>
                                                            @if ($topic->type === 'video')
                                                                <span class="badge bg-primary ms-2">Video</span>
                                                            @elseif ($topic->type === 'voice')
                                                                <span class="badge bg-info ms-2">Audio</span>
                                                            @elseif ($topic->type === 'pdf')
                                                                <span class="badge bg-warning ms-2">PDF</span>
                                                            @else
                                                                <span class="badge bg-success ms-2">Reading</span>
                                                            @endif
                                                        </div>

                                                        @php
                                                            $user = auth()->user();
                                                            $hasAccess = $user && $user->hasApprovedCourse($course->id);
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
                                                                                            src="{{ $topic->video_url }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0"
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
                                                                                            src="{{ $topic->video_url }}"
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
                                                            <button class="btn btn-sm btn-secondary"
                                                                disabled>Locked</button>
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

                        {{-- Telegram Group Support Section --}}
                        @auth
                            @php
                                $user = auth()->user();
                                $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                                $hasAccess = $user && $user->hasApprovedCourse($course->id);
                            @endphp

                            @if ($hasAccess && $enrollment && $course->telegram_chat_id)
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
                                            @if ($enrollment->pivot->telegram_invite_link)
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
                                            @else
                                                <div class="alert alert-info border-0">
                                                    <i class="bi bi-hourglass-split me-2"></i>
                                                    Generating your unique Telegram invite link... Please refresh the page.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
