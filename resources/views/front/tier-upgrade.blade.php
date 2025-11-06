@extends('partials.master')

@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>

                <h2 class="mb-4">
                    Upgrade to {{ ucfirst($tier) }} Tier
                    @if($tier === 'premium')
                        <i class="bi bi-star-fill text-primary"></i>
                    @else
                        <i class="bi bi-trophy-fill text-warning"></i>
                    @endif
                </h2>

                <div class="row">
                    {{-- Course Details --}}
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Course: {{ $course->title }}</h5>

                                @if($course->image)
                                    <img src="{{ asset('storage/' . $course->image) }}"
                                         alt="{{ $course->title }}"
                                         class="img-fluid rounded mb-3"
                                         style="max-height: 200px; object-fit: cover;">
                                @endif

                                <div class="mb-3">
                                    <span class="badge bg-info">Current Tier: {{ strtoupper($currentTier) }}</span>
                                    <i class="bi bi-arrow-right mx-2"></i>
                                    @if($tier === 'premium')
                                        <span class="badge bg-primary">Upgrading to: PREMIUM</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Upgrading to: MENTORSHIP</span>
                                    @endif
                                </div>

                                <div class="card bg-light mt-4">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-3 text-muted">
                                            <i class="bi bi-gift"></i> What you'll get with {{ ucfirst($tier) }} Tier:
                                        </h6>

                                        @if($tier === 'premium')
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Access to all FREE content</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Access to all PREMIUM lessons</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Advanced course materials</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Exclusive video content</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> PDF resources and guides</li>
                                            </ul>
                                        @else
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> Everything in FREE and PREMIUM tiers</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> Access to all MENTORSHIP content</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> 1-on-1 mentorship sessions</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> Direct support from instructors</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> Priority access to new content</li>
                                                <li class="mb-2"><i class="bi bi-check-circle-fill text-warning me-2"></i> Exclusive community access</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Sidebar --}}
                    <div class="col-md-4">
                        <div class="card sticky-top" style="top: 20px;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if($tier === 'premium')
                                        <i class="bi bi-star-fill text-primary me-2"></i>Premium Upgrade
                                    @else
                                        <i class="bi bi-trophy-fill text-warning me-2"></i>Mentorship Upgrade
                                    @endif
                                </h5>

                                <div class="my-4 text-center">
                                    <div class="display-5 fw-bold" style="color: var(--accent-color);">
                                        ${{ number_format($price, 0) }}
                                    </div>
                                    <small class="text-muted">One-time payment</small>
                                </div>

                                <div class="border rounded p-3 mb-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-check text-success me-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <strong>Secure Payment</strong>
                                            <br>
                                            <small class="text-muted">Powered by Stripe</small>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('tier.upgrade.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="tier" value="{{ $tier }}">
                                    <input type="hidden" name="price" value="{{ $price }}">

                                    <button type="submit" class="btn btn-lg w-100 @if($tier === 'premium') btn-primary @else btn-warning @endif">
                                        <i class="bi bi-lock-fill me-2"></i>
                                        Upgrade Now - ${{ number_format($price, 0) }}
                                    </button>
                                </form>

                                <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        You will be redirected to a secure Stripe checkout page
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
