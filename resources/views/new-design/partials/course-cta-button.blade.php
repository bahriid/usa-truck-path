@php
    $fullWidth = $fullWidth ?? false;
    $large = $large ?? false;

    $baseClasses = 'inline-flex items-center justify-center font-bold uppercase tracking-wide rounded-lg shadow-lg transition-all';

    // Size classes
    if ($large) {
        $sizeClasses = 'text-lg px-10 py-4';
    } else {
        $sizeClasses = 'px-6 py-3';
    }

    // Width classes
    $widthClasses = $fullWidth ? 'w-full' : '';

    // Primary CTA style (gold)
    $primaryClasses = "bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] $baseClasses $sizeClasses $widthClasses transform hover:-translate-y-1";

    // Secondary style (blue)
    $secondaryClasses = "bg-[#1B75F0] hover:bg-[#0A2342] text-white $baseClasses $sizeClasses $widthClasses transform hover:-translate-y-1";

    // Warning style (orange)
    $warningClasses = "bg-orange-500 hover:bg-orange-600 text-white $baseClasses $sizeClasses $widthClasses transform hover:-translate-y-1";

    // Disabled style
    $disabledClasses = "bg-gray-400 text-gray-600 cursor-not-allowed $baseClasses $sizeClasses $widthClasses";

    $isLanguageSelector = $course->isLanguageSelectorCourse();
    $isComingSoon = $course->coming_soon ?? false;
@endphp

{{-- Coming Soon - Show disabled button for all users --}}
@if($isComingSoon)
    <button class="{{ $disabledClasses }}" disabled>
        <i data-lucide="clock" class="h-5 w-5 mr-2"></i>
        Coming Soon
    </button>
@elseif($isLanguageSelector)
    {{-- Language Selector Course (FREE) --}}
    @guest
        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="{{ $primaryClasses }}">
            <i data-lucide="log-in" class="h-5 w-5 mr-2"></i>
            Login to Enroll
        </a>
    @else
        <a href="{{ route('course.curriculam', $course->id) }}" class="{{ $primaryClasses }}">
            <i data-lucide="play-circle" class="h-5 w-5 mr-2"></i>
            Start Free Course
        </a>
    @endguest
@else
    {{-- Paid Course --}}
    @guest
        <a href="{{ route('register') }}?course_id={{ $course->id }}" class="{{ $primaryClasses }}">
            <i data-lucide="log-in" class="h-5 w-5 mr-2"></i>
            Login to Enroll
        </a>
    @else
        @if (auth()->user()->hasApprovedCourse($course->id))
            <a href="{{ route('course.curriculam', $course->id) }}" class="{{ $secondaryClasses }}">
                <i data-lucide="book-open" class="h-5 w-5 mr-2"></i>
                Go to Curriculum
            </a>
        @else
            @if ($course->status === 'upcoming')
                <button class="{{ $disabledClasses }}" disabled>
                    <i data-lucide="clock" class="h-5 w-5 mr-2"></i>
                    Coming Soon
                </button>
            @elseif(auth()->user()->hasPurchasedCourse($course->id))
                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="{{ $warningClasses }}">
                    <i data-lucide="credit-card" class="h-5 w-5 mr-2"></i>
                    Continue Payment
                </a>
            @else
                <a href="{{ route('front.courses.enrollForm', $course->id) }}" class="{{ $primaryClasses }}">
                    <i data-lucide="user-plus" class="h-5 w-5 mr-2"></i>
                    Enroll Now
                </a>
            @endif
        @endif
    @endguest
@endif
