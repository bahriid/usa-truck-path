@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-12 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4">
            <h1 class="font-heading text-2xl md:text-3xl font-bold mb-2">Complete Your Enrollment</h1>
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <a href="{{ route('front.course') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Courses</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <span class="text-[#F5B82E]">Payment</span>
            </nav>
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
                                <h2 class="font-heading text-xl font-bold text-[#0A2342]">Course Details</h2>
                            </div>
                            <div class="p-6">
                                <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-4">{{ $course->title }}</h3>

                                <div class="prose prose-sm text-gray-600 mb-6">
                                    {!! $course->description ?? 'No description available.' !!}
                                </div>

                                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                    <span class="text-gray-600">Price:</span>
                                    @if($course->original_price)
                                        <span class="text-gray-400 line-through text-lg">${{ $course->original_price }}</span>
                                    @endif
                                    <span class="text-2xl font-bold text-[#1B75F0]">${{ $course->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Sidebar -->
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-6">
                            <div class="p-6 border-b border-gray-100">
                                <h2 class="font-heading text-xl font-bold text-[#0A2342]">Payment</h2>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 mb-6">Complete your enrollment by proceeding to secure payment.</p>

                                <div class="bg-[#F2F4F7] rounded-xl p-4 mb-6 flex items-center gap-3">
                                    <div class="w-12 h-12 bg-[#1B75F0] rounded-full flex items-center justify-center">
                                        <i data-lucide="credit-card" class="h-6 w-6 text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-[#0A2342]">Secure Payment</p>
                                        <p class="text-sm text-gray-500">Powered by Stripe</p>
                                    </div>
                                </div>

                                <form action="{{ route('stripe.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="price" value="{{ $course->price }}">

                                    <button type="submit" class="w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                        <i data-lucide="lock" class="h-5 w-5"></i>
                                        Checkout with Stripe
                                    </button>
                                </form>

                                <p class="text-xs text-gray-500 text-center mt-4">
                                    <i data-lucide="shield-check" class="h-4 w-4 inline"></i>
                                    Your payment information is secure
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
