@extends('partials.master')

@section('main')
    <div class="container py-5">
        <div class="mb-5">
            <h1 class="display-4 fw-bold">Welcome back, {{ $user->name }}!</h1>
            <p class="lead text-muted">Your enrolled courses:</p>
        </div>

        <div class="row g-4">
            @foreach($coursesWithTiers as $item)
                @php
                    $course = $item['course'];
                    $currentTier = $item['current_tier'];
                    $premiumPrice = $item['premium_price'];
                    $mentorshipPrice = $item['mentorship_price'];
                @endphp

                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                {{-- Course Image --}}
                                <div class="col-md-3">
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}"
                                             alt="{{ $course->title }}"
                                             class="img-fluid rounded"
                                             style="max-height: 150px; object-fit: cover;">
                                    @endif
                                </div>

                                {{-- Course Info & Tier Status --}}
                                <div class="col-md-9">
                                    <h3 class="mb-2">{{ $course->title }}</h3>

                                    {{-- Current Tier Badge --}}
                                    <div class="mb-3">
                                        <span class="me-2">Current Access:</span>
                                        @if($currentTier === 'free')
                                            <span class="badge bg-success fs-6">FREE TIER ✓</span>
                                        @elseif($currentTier === 'premium')
                                            <span class="badge bg-primary fs-6">PREMIUM TIER ✓</span>
                                        @elseif($currentTier === 'mentorship')
                                            <span class="badge bg-warning fs-6">MENTORSHIP TIER ✓</span>
                                        @endif
                                    </div>

                                    {{-- Tier Progress Bar --}}
                                    <div class="progress mb-3" style="height: 10px;">
                                        @if($currentTier === 'free')
                                            <div class="progress-bar bg-success" style="width: 33%"></div>
                                        @elseif($currentTier === 'premium')
                                            <div class="progress-bar bg-primary" style="width: 66%"></div>
                                        @elseif($currentTier === 'mentorship')
                                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                                        @endif
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="d-flex gap-2 flex-wrap">
                                        {{-- Access Course Button --}}
                                        <a href="{{ route('course.curriculam', $course->id) }}"
                                           class="btn btn-lg btn-success">
                                            <i class="bi bi-play-circle"></i> Access Course
                                        </a>

                                        {{-- Upgrade Buttons --}}
                                        @if($currentTier === 'free')
                                            <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}"
                                               class="btn btn-lg btn-primary">
                                                <i class="bi bi-arrow-up-circle"></i> Upgrade to Premium - ${{ number_format($premiumPrice, 0) }}
                                            </a>
                                            <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'mentorship']) }}"
                                               class="btn btn-lg btn-warning">
                                                <i class="bi bi-star"></i> Upgrade to Mentorship - ${{ number_format($mentorshipPrice, 0) }}
                                            </a>
                                        @elseif($currentTier === 'premium')
                                            <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'mentorship']) }}"
                                               class="btn btn-lg btn-warning">
                                                <i class="bi bi-star"></i> Upgrade to Mentorship - ${{ number_format($mentorshipPrice, 0) }}
                                            </a>
                                        @endif
                                    </div>

                                    {{-- Tier Benefits Description --}}
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            @if($currentTier === 'free')
                                                <strong>Free Tier includes:</strong> Basic course content
                                            @elseif($currentTier === 'premium')
                                                <strong>Premium Tier includes:</strong> All basic content + Premium lessons
                                            @elseif($currentTier === 'mentorship')
                                                <strong>Mentorship Tier includes:</strong> Full access to all content + 1-on-1 mentorship
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
