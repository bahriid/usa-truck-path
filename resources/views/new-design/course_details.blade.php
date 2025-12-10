@extends('new-design.partials.master')

@push('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<style>
    .accordion-button:not(.collapsed) {
        background-color: #0A2342;
        color: white;
    }
    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(27, 117, 240, 0.25);
    }
    .modal-lg { max-width: 800px; }
</style>
@endpush

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-20 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('frontend/img/whitetruck.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A2342] to-[#0A2342]/80"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-3 gap-8 items-center">
                <div class="md:col-span-2">
                    <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase mb-4 text-[#F5B82E]">
                        {{ $course->title }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-6 leading-relaxed">
                        {{ $course->short_description ?? 'Pass Your CDL Permit — Fast and Easy: Get the exact questions and answers you\'ll see on the real DMV test. Study smarter, pass faster — and start your trucking career today!' }}
                    </p>
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                        <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                        <a href="{{ route('front.course') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Courses</a>
                        <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                        <span class="text-[#F5B82E]">{{ Str::limit($course->title, 30) }}</span>
                    </nav>
                </div>
                <div class="text-center md:text-right">
                    @include('new-design.partials.course-cta-button', ['course' => $course])
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="font-heading text-3xl font-bold text-center text-[#0A2342] uppercase mb-12">Choose Your Plan</h2>

            <div class="max-w-5xl mx-auto bg-[#F2F4F7] rounded-2xl overflow-hidden shadow-lg">
                <div class="grid md:grid-cols-2 gap-0">
                    <!-- Course Image -->
                    <div class="p-8 flex items-center justify-center bg-white">
                        @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="rounded-xl shadow-md max-h-80 object-cover">
                        @else
                            <img src="{{ asset('frontend/img/course-details.jpg') }}" alt="{{ $course->title }}" class="rounded-xl shadow-md max-h-80 object-cover">
                        @endif
                    </div>

                    <!-- Course Info -->
                    <div class="p-8 flex flex-col justify-center">
                        <h3 class="font-heading text-2xl font-bold text-[#0A2342] mb-6">What's Included</h3>

                        @if($course->isLanguageSelectorCourse())
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Get ready to pass your Commercial Learner's Permit (CLP) and all CDL endorsements with this complete course. Includes video lessons, audiobooks, and eBooks in your preferred language.
                            </p>
                        @else
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center gap-3">
                                    <i data-lucide="book-open" class="h-5 w-5 text-[#1B75F0]"></i>
                                    <span><strong>{{ $course->chapters->count() }}</strong> Chapters</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i data-lucide="list" class="h-5 w-5 text-[#1B75F0]"></i>
                                    <span><strong>{{ $course->chapters->sum(fn($ch) => $ch->topics->count()) }}</strong> Topics</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i data-lucide="users" class="h-5 w-5 text-[#1B75F0]"></i>
                                    <span><strong>{{ $course->students->count() }}</strong> Students Enrolled</span>
                                </li>
                            </ul>
                        @endif

                        <div class="mb-6">
                            @if($course->isLanguageSelectorCourse())
                                <p class="text-3xl font-bold text-[#1B75F0]">FREE</p>
                            @else
                                @if($course->original_price)
                                    <span class="text-gray-400 line-through text-xl mr-2">${{ $course->original_price }}</span>
                                @endif
                                <span class="text-3xl font-bold text-[#1B75F0]">${{ $course->price }}</span>
                            @endif
                        </div>

                        @include('new-design.partials.course-cta-button', ['course' => $course, 'fullWidth' => true])
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Description -->
    <section class="py-16 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-6">
                            Everything You Need to Pass Your CDL Permit Test
                        </h2>
                        <div class="prose prose-lg text-gray-600 leading-relaxed">
                            {!! $course->description !!}
                        </div>
                        <div class="mt-8">
                            @include('new-design.partials.course-cta-button', ['course' => $course])
                        </div>
                    </div>
                    <div>
                        <img src="{{ asset('frontend/img/training.jpg') }}" alt="Training" class="rounded-2xl shadow-xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">Why Choose USA Truck Path?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Your Fast-Track to a Truck Driving Career Starts Here</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#1B75F0] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="languages" class="h-7 w-7 text-white"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">Multilingual Learning</h3>
                    <p class="text-gray-600 text-sm">Study in English, Arabic, Somali, Amharic, French, or Nepali.</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#1B75F0] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="check-circle" class="h-7 w-7 text-white"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">Real DMV Questions</h3>
                    <p class="text-gray-600 text-sm">Practice with actual DMV questions from every U.S. state.</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#1B75F0] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="shield-check" class="h-7 w-7 text-white"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">100% Pass Guarantee</h3>
                    <p class="text-gray-600 text-sm">Pass on your first try — or get extended access for free.</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#F5B82E] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="play-circle" class="h-7 w-7 text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">All-in-One Course</h3>
                    <p class="text-gray-600 text-sm">Access videos, eBooks, and audio lessons for every learning style.</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#F5B82E] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="clock" class="h-7 w-7 text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">Learn at Your Pace</h3>
                    <p class="text-gray-600 text-sm">Study anytime, anywhere — on your schedule.</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-[#F5B82E] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="truck" class="h-7 w-7 text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">Built for Truckers</h3>
                    <p class="text-gray-600 text-sm">We specialize in helping aspiring CDL truck drivers succeed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Curriculum -->
    <section class="py-16 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-8">Course Curriculum</h2>

                @php
                    $chapters = $course->chapters->sortBy('order');
                    $user = auth()->user();
                    $hasAccess = $user && $user->hasApprovedCourse($course->id);
                @endphp

                <div class="space-y-4">
                    @forelse ($chapters as $index => $chapter)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm">
                            <button class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors" onclick="toggleAccordion({{ $index }})">
                                <span class="font-heading text-lg font-bold text-[#0A2342]">{{ $chapter->title }}</span>
                                <i data-lucide="chevron-down" class="h-5 w-5 text-gray-500 transition-transform" id="chevron-{{ $index }}"></i>
                            </button>
                            <div class="hidden px-6 pb-4" id="content-{{ $index }}">
                                @if ($chapter->topics->count() > 0)
                                    <ul class="space-y-3">
                                        @foreach ($chapter->topics as $topic)
                                            <li class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                                <div class="flex items-center gap-3">
                                                    @if ($topic->type === 'video')
                                                        <span class="bg-[#1B75F0]/10 text-[#1B75F0] px-2 py-1 rounded text-xs font-bold">VIDEO</span>
                                                    @elseif ($topic->type === 'voice')
                                                        <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded text-xs font-bold">AUDIO</span>
                                                    @elseif ($topic->type === 'pdf')
                                                        <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-bold">PDF</span>
                                                    @else
                                                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-bold">TEXT</span>
                                                    @endif
                                                    <span class="font-medium text-gray-700">{{ $topic->title }}</span>
                                                </div>

                                                @if ($hasAccess)
                                                    @if ($topic->type === 'voice' && $topic->voice)
                                                        <button class="bg-[#1B75F0] text-white px-3 py-1 rounded text-sm hover:bg-[#0A2342] transition-colors" data-bs-toggle="modal" data-bs-target="#audioModal{{ $topic->id }}">
                                                            <i data-lucide="play" class="h-4 w-4 inline"></i> Play
                                                        </button>
                                                    @elseif($topic->type === 'pdf' && $topic->pdf)
                                                        <a href="{{ asset('storage/' . $topic->pdf) }}" target="_blank" class="bg-[#F5B82E] text-[#0A2342] px-3 py-1 rounded text-sm hover:bg-[#F5B82E]/80 transition-colors">
                                                            <i data-lucide="file-text" class="h-4 w-4 inline"></i> View
                                                        </a>
                                                    @elseif($topic->type === 'video')
                                                        <button class="bg-[#1B75F0] text-white px-3 py-1 rounded text-sm hover:bg-[#0A2342] transition-colors" data-bs-toggle="modal" data-bs-target="#videoModal{{ $topic->id }}">
                                                            <i data-lucide="play" class="h-4 w-4 inline"></i> Watch
                                                        </button>
                                                    @else
                                                        <button class="bg-[#1B75F0] text-white px-3 py-1 rounded text-sm hover:bg-[#0A2342] transition-colors" data-bs-toggle="modal" data-bs-target="#readingModal{{ $topic->id }}">
                                                            <i data-lucide="book-open" class="h-4 w-4 inline"></i> Read
                                                        </button>
                                                    @endif
                                                @else
                                                    <span class="bg-gray-200 text-gray-500 px-3 py-1 rounded text-sm">
                                                        <i data-lucide="lock" class="h-4 w-4 inline"></i> Locked
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">No topics in this chapter.</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No chapters found for this course.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-4">What Our Students Say</h2>
                <p class="text-gray-600">Read inspiring stories from individuals who have successfully achieved their trucking careers.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-[#F2F4F7] rounded-xl p-6">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-4 italic">"I'm so glad I found USATruckPath! The practice questions were just like the real test. I passed my permit test on the first try!"</p>
                    <p class="font-bold text-[#0A2342]">Yodit Tadesse</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-4 italic">"I'm originally from Honduras and live in Columbus, Ohio. USATruckPath changed everything! The questions were just like the real test."</p>
                    <p class="font-bold text-[#0A2342]">Carlos Mendoza</p>
                </div>
                <div class="bg-[#F2F4F7] rounded-xl p-6">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="h-5 w-5 fill-[#F5B82E] text-[#F5B82E]"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-4 italic">"I'm originally from Egypt. The Arabic version of the guide was perfect for me! I passed my CDL permit test on the first try."</p>
                    <p class="font-bold text-[#0A2342]">Ahmed Hassan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-20 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading text-4xl font-bold uppercase mb-6">Ready to Start Your Trucking Career?</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                Join thousands of students who have passed their CDL permit test with our proven system.
            </p>
            @include('new-design.partials.course-cta-button', ['course' => $course, 'large' => true])
        </div>
    </section>
</main>

<!-- Modals for content (Audio, Video, PDF, Reading) -->
@if($hasAccess ?? false)
    @foreach ($chapters as $chapter)
        @foreach ($chapter->topics as $topic)
            @if ($topic->type === 'voice' && $topic->voice)
                <!-- Audio Modal -->
                <div class="modal fade" id="audioModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-heading font-bold">{{ $topic->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center p-6">
                                <audio id="audio-player-{{ $topic->id }}" controls style="width: 100%;" class="audio-player">
                                    <source src="{{ asset('storage/' . $topic->voice) }}" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($topic->type === 'video')
                <!-- Video Modal -->
                <div class="modal fade" id="videoModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-heading font-bold">{{ $topic->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                @if ($topic->source_from === 'local' && $topic->local_video)
                                    <video id="player-local-{{ $topic->id }}" class="plyr__video-player" controls style="width: 100%">
                                        <source src="{{ asset('storage/' . $topic->local_video) }}" type="video/mp4">
                                    </video>
                                @elseif($topic->source_from === 'youtube' && $topic->video_url)
                                    <div class="plyr__video-embed" id="player-embed-{{ $topic->id }}">
                                        <iframe src="{{ $topic->video_url }}?origin={{ url('/') }}&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                    </div>
                                @elseif($topic->source_from === 'vimeo' && $topic->video_url)
                                    <div class="plyr__video-embed" id="player-embed-{{ $topic->id }}">
                                        <iframe src="{{ $topic->video_url }}" allowfullscreen allowtransparency allow="autoplay"></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($topic->type === 'text' || ($topic->description && !$topic->pdf))
                <!-- Reading Modal -->
                <div class="modal fade" id="readingModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-heading font-bold">{{ $topic->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-6 prose max-w-none">
                                {!! $topic->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
@endif
@endsection

@push('scripts')
<!-- Bootstrap JS for modals -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Plyr for video/audio -->
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

<script>
    // Accordion toggle
    function toggleAccordion(index) {
        const content = document.getElementById('content-' + index);
        const chevron = document.getElementById('chevron-' + index);

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Initialize Plyr players
    document.addEventListener('DOMContentLoaded', () => {
        const players = Array.from(document.querySelectorAll('.plyr__video-player, .plyr__video-embed, .audio-player'))
            .map((p) => new Plyr(p));

        // Pause media when modal closes
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                let audio = modal.querySelector('audio');
                let video = modal.querySelector('video');
                if (audio) {
                    audio.pause();
                    audio.currentTime = 0;
                }
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            });
        });
    });
</script>
@endpush
