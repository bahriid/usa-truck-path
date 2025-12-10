@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-12 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-gray-300 hover:text-[#F5B82E] transition-colors text-sm">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    Back to Dashboard
                </a>
            </div>
            <h1 class="font-heading text-2xl md:text-3xl font-bold flex items-center gap-3">
                Upgrade to {{ ucfirst($tier) }} Tier
                @if($tier === 'premium')
                    <i data-lucide="star" class="h-8 w-8 text-[#1B75F0]"></i>
                @else
                    <i data-lucide="trophy" class="h-8 w-8 text-[#F5B82E]"></i>
                @endif
            </h1>
        </div>
    </section>

    <section class="py-12 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Course Details -->
                    <div class="md:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="p-6 border-b border-gray-100">
                                <h2 class="font-heading text-xl font-bold text-[#0A2342]">Course: {{ $course->title }}</h2>
                            </div>
                            <div class="p-6">
                                @if($course->image)
                                    <img src="{{ asset('storage/' . $course->image) }}"
                                         alt="{{ $course->title }}"
                                         class="w-full h-48 object-cover rounded-xl mb-6">
                                @endif

                                <!-- Tier Progress -->
                                <div class="flex items-center gap-3 mb-6">
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                        Current: {{ strtoupper($currentTier) }}
                                    </span>
                                    <i data-lucide="arrow-right" class="h-5 w-5 text-gray-400"></i>
                                    @if($tier === 'premium')
                                        <span class="bg-[#1B75F0]/10 text-[#1B75F0] px-3 py-1 rounded-full text-sm font-semibold">
                                            Upgrading to: PREMIUM
                                        </span>
                                    @else
                                        <span class="bg-[#F5B82E]/10 text-[#F5B82E] px-3 py-1 rounded-full text-sm font-semibold">
                                            Upgrading to: MENTORSHIP
                                        </span>
                                    @endif
                                </div>

                                <!-- Benefits Box -->
                                <div class="bg-[#F2F4F7] rounded-xl p-6">
                                    <h3 class="font-heading font-bold text-[#0A2342] mb-4 flex items-center gap-2">
                                        <i data-lucide="gift" class="h-5 w-5 text-[#F5B82E]"></i>
                                        What you'll get with {{ ucfirst($tier) }} Tier:
                                    </h3>

                                    @if($tier === 'premium')
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-700">Access to all FREE content</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-700">Access to all PREMIUM lessons</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-700">Advanced course materials</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-700">Exclusive video content</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-700">PDF resources and guides</span>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">Everything in FREE and PREMIUM tiers</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">Access to all MENTORSHIP content</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">1-on-1 mentorship sessions</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">Direct support from instructors</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">Priority access to new content</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <i data-lucide="check-circle" class="h-5 w-5 text-[#F5B82E] flex-shrink-0"></i>
                                                <span class="text-gray-700">Exclusive community access</span>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Sidebar -->
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-6">
                            <div class="p-6 border-b border-gray-100">
                                <h2 class="font-heading text-xl font-bold text-[#0A2342] flex items-center gap-2">
                                    @if($tier === 'premium')
                                        <i data-lucide="star" class="h-5 w-5 text-[#1B75F0]"></i>
                                        Premium Upgrade
                                    @else
                                        <i data-lucide="trophy" class="h-5 w-5 text-[#F5B82E]"></i>
                                        Mentorship Upgrade
                                    @endif
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold text-[#1B75F0]">${{ number_format($price, 0) }}</div>
                                    <p class="text-sm text-gray-500">One-time payment</p>
                                </div>

                                <div class="bg-[#F2F4F7] rounded-xl p-4 mb-6 flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i data-lucide="shield-check" class="h-5 w-5 text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-[#0A2342] text-sm">Secure Payment</p>
                                        <p class="text-xs text-gray-500">Powered by Stripe</p>
                                    </div>
                                </div>

                                <form action="{{ route('tier.upgrade.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="tier" value="{{ $tier }}">
                                    <input type="hidden" name="price" value="{{ $price }}">

                                    <button type="submit" class="w-full @if($tier === 'premium') bg-[#1B75F0] hover:bg-[#0A2342] @else bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] @endif text-white font-bold uppercase tracking-wide py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                        <i data-lucide="lock" class="h-5 w-5"></i>
                                        Upgrade Now - ${{ number_format($price, 0) }}
                                    </button>
                                </form>

                                <p class="text-xs text-gray-500 text-center mt-4 flex items-center justify-center gap-1">
                                    <i data-lucide="info" class="h-4 w-4"></i>
                                    You will be redirected to Stripe checkout
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
