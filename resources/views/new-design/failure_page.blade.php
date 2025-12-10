@extends('new-design.partials.master')

@section('main')
<main>
    <section class="py-20 bg-[#F2F4F7] min-h-[60vh] flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto text-center">
                <div class="bg-white rounded-2xl shadow-lg p-10">
                    <!-- Error Icon -->
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="x-circle" class="h-10 w-10 text-red-500"></i>
                    </div>

                    <h1 class="font-heading text-2xl font-bold text-[#0A2342] mb-4">Payment Failed</h1>

                    <p class="text-gray-600 mb-6">
                        {{ $error ?? 'An error occurred during payment processing.' }}
                    </p>

                    <p class="text-gray-500 mb-8">
                        Please try again, or contact our support team if the problem persists.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('front.course') }}" class="inline-flex items-center justify-center gap-2 bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold px-6 py-3 rounded-lg transition-colors">
                            <i data-lucide="arrow-left" class="h-5 w-5"></i>
                            Back to Courses
                        </a>
                        <a href="{{ route('front.contact_us') }}" class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-lg transition-colors">
                            <i data-lucide="message-circle" class="h-5 w-5"></i>
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
