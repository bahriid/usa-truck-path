@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-16 bg-[#0A2342] text-white overflow-hidden">
        <div class="container mx-auto px-4">
            <h1 class="font-heading text-3xl md:text-4xl font-bold mb-2">Welcome back, {{ $user->name }}!</h1>
            <p class="text-gray-300 text-lg">Your enrolled courses:</p>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="py-12 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="space-y-6">
                @foreach($coursesWithTiers as $item)
                    @php
                        $course = $item['course'];
                        $currentTier = $item['current_tier'];
                        $premiumPrice = $item['premium_price'];
                    @endphp

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                                <!-- Course Image -->
                                <div class="flex-shrink-0">
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}"
                                             alt="{{ $course->title }}"
                                             class="w-full md:w-40 h-32 object-cover rounded-xl">
                                    @else
                                        <div class="w-full md:w-40 h-32 bg-gray-200 rounded-xl flex items-center justify-center">
                                            <i data-lucide="book-open" class="h-12 w-12 text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Course Info -->
                                <div class="flex-grow">
                                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-3">{{ $course->title }}</h3>

                                    <!-- Current Tier Badge -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="text-gray-600">Current Access:</span>
                                        @if($currentTier === 'free')
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                <i data-lucide="check" class="h-4 w-4"></i> FREE TIER
                                            </span>
                                        @elseif($currentTier === 'premium')
                                            <span class="inline-flex items-center gap-1 bg-[#1B75F0]/10 text-[#1B75F0] px-3 py-1 rounded-full text-sm font-semibold">
                                                <i data-lucide="star" class="h-4 w-4"></i> PREMIUM TIER
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Tier Progress Bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                        @if($currentTier === 'free')
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 50%"></div>
                                        @elseif($currentTier === 'premium')
                                            <div class="bg-[#1B75F0] h-2 rounded-full" style="width: 100%"></div>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('course.curriculam', $course->id) }}"
                                           class="inline-flex items-center gap-2 bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold px-6 py-3 rounded-lg transition-colors">
                                            <i data-lucide="play-circle" class="h-5 w-5"></i>
                                            Access Course
                                        </a>

                                        @if($currentTier === 'free')
                                            <a href="{{ route('tier.upgrade.page', ['course' => $course->id, 'tier' => 'premium']) }}"
                                               class="inline-flex items-center gap-2 bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold px-6 py-3 rounded-lg transition-colors">
                                                <i data-lucide="arrow-up-circle" class="h-5 w-5"></i>
                                                Upgrade to Premium - ${{ number_format($premiumPrice, 0) }}
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Tier Benefits Description -->
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">
                                            @if($currentTier === 'free')
                                                <strong>Free Tier includes:</strong> Basic course content
                                            @elseif($currentTier === 'premium')
                                                <strong>Premium Tier includes:</strong> All basic content + Premium lessons
                                            @elseif($currentTier === 'mentorship')
                                                <strong>Mentorship Tier includes:</strong> Full access to all content + 1-on-1 mentorship
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(count($coursesWithTiers) === 0)
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <i data-lucide="book-x" class="h-16 w-16 text-gray-300 mx-auto mb-4"></i>
                        <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-2">No Courses Yet</h3>
                        <p class="text-gray-600 mb-6">You haven't enrolled in any courses yet. Start your trucking journey today!</p>
                        <a href="{{ route('front.course') }}" class="inline-flex items-center gap-2 bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold px-8 py-3 rounded-lg transition-colors">
                            <i data-lucide="search" class="h-5 w-5"></i>
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
