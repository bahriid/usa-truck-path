@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Page Title -->
    <section class="relative py-16 bg-[#0A2342] text-white overflow-hidden">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-tighter mb-4">Terms & Conditions</h1>
            <nav class="flex items-center justify-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <span class="text-[#F5B82E]">Terms & Conditions</span>
            </nav>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto prose prose-lg prose-headings:text-[#0A2342] prose-headings:font-heading prose-a:text-[#1B75F0] prose-strong:text-[#0A2342]">
                {!! $terms->terms_and_conditions ?? '<p class="text-gray-500 text-center">No terms and conditions available.</p>' !!}
            </div>
        </div>
    </section>
</main>
@endsection
