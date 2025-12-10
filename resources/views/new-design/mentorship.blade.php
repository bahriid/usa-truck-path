@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-24 bg-[#0A2342] text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/mentorship-training-v2.png') }}" alt="Mentorship" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-[#0A2342]/95 to-[#0A2342]/80"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-[#F5B82E]/20 text-[#F5B82E] border border-[#F5B82E]/50 text-sm font-bold uppercase tracking-wider mb-6">
                Premium Program
            </span>
            <h1 class="font-heading text-4xl md:text-6xl font-bold uppercase tracking-tighter mb-6">
                Fast-Track Your <span class="text-[#F5B82E]">Trucking Career</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                Get personal guidance, exclusive job leads, and step-by-step support to move from your home country to a U.S. trucking job.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#pricing" class="btn-cta bg-[#F5B82E] text-[#0A2342] hover:bg-[#F5B82E]/90 h-14 px-10 flex items-center justify-center text-lg font-bold uppercase tracking-wide shadow-lg rounded">
                    View Plans & Pricing
                </a>
                <a href="#features" class="btn-cta bg-transparent border-2 border-white text-white hover:bg-white/10 h-14 px-10 flex items-center justify-center text-lg font-bold uppercase tracking-wide rounded">
                    What's Included
                </a>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-[#0A2342] uppercase mb-6">
                    More Than Just a Course
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    We don't just teach you the theory. We walk with you through every step of the complex immigration and hiring process.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E] transition-all group">
                    <div class="w-14 h-14 bg-[#0A2342] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#F5B82E] transition-colors">
                        <i data-lucide="users" class="h-8 w-8 text-white group-hover:text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-4">1-on-1 Mentorship</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Direct access to experienced mentors who have successfully made the move. Get answers to your specific visa and license questions.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E] transition-all group">
                    <div class="w-14 h-14 bg-[#0A2342] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#F5B82E] transition-colors">
                        <i data-lucide="briefcase" class="h-8 w-8 text-white group-hover:text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-4">Exclusive Job Board</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Access our curated list of U.S. trucking companies that are actively hiring and sponsoring foreign drivers right now.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-[#F5B82E] transition-all group">
                    <div class="w-14 h-14 bg-[#0A2342] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#F5B82E] transition-colors">
                        <i data-lucide="file-check" class="h-8 w-8 text-white group-hover:text-[#0A2342]"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-4">Document Review</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Don't get rejected for a simple mistake. We review your CV, cover letter, and visa application forms before you submit.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-[#0A2342] uppercase mb-6">
                    Simple, Transparent Pricing
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Invest in your future career. One trucking paycheck in the U.S. can cover the cost of this entire program.
                </p>
            </div>

            <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-[#F5B82E]">
                <div class="bg-[#0A2342] p-6 text-center text-white">
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide">Full Access Pass</h3>
                    <div class="mt-4 flex items-baseline justify-center gap-1">
                        <span class="text-5xl font-bold text-[#F5B82E]">$297</span>
                        <span class="text-gray-400">/ one-time</span>
                    </div>
                    <p class="mt-2 text-gray-300 text-sm">Lifetime access. No monthly fees.</p>
                </div>
                <div class="p-8">
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#1B75F0] flex-shrink-0"></i>
                            <span class="text-gray-700"><strong>Unlimited Access</strong> to all premium courses</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#1B75F0] flex-shrink-0"></i>
                            <span class="text-gray-700"><strong>Private Community</strong> of aspiring drivers</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#1B75F0] flex-shrink-0"></i>
                            <span class="text-gray-700"><strong>Weekly Q&A Calls</strong> with industry experts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#1B75F0] flex-shrink-0"></i>
                            <span class="text-gray-700"><strong>Direct Referrals</strong> to hiring partners</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="h-6 w-6 text-[#1B75F0] flex-shrink-0"></i>
                            <span class="text-gray-700"><strong>Resume & Visa</strong> document templates</span>
                        </li>
                    </ul>
                    <a href="{{ route('front.course') }}" class="block w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] text-center font-bold uppercase py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                        Get Started Now
                    </a>
                    <p class="text-center text-xs text-gray-500 mt-4">
                        30-Day Money-Back Guarantee. No questions asked.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="font-heading text-3xl font-bold text-[#0A2342] uppercase mb-10 text-center">
                Frequently Asked Questions
            </h2>
            <div class="space-y-4">
                <details class="group bg-gray-50 rounded-lg p-6 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 text-[#0A2342] font-bold text-lg">
                        <span>Do you guarantee a job?</span>
                        <span class="shrink-0 rounded-full bg-white p-1.5 text-[#0A2342] sm:p-3 group-open:-rotate-180 transition-transform">
                            <i data-lucide="chevron-down" class="h-5 w-5"></i>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-gray-600">
                        While we cannot legally guarantee a job as hiring decisions are made by the trucking companies, we provide you with the direct connections, preparation, and referrals that significantly increase your chances of success.
                    </p>
                </details>

                <details class="group bg-gray-50 rounded-lg p-6 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 text-[#0A2342] font-bold text-lg">
                        <span>Is this program for beginners?</span>
                        <span class="shrink-0 rounded-full bg-white p-1.5 text-[#0A2342] sm:p-3 group-open:-rotate-180 transition-transform">
                            <i data-lucide="chevron-down" class="h-5 w-5"></i>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-gray-600">
                        Yes! We have designed the program to guide you from zero experience all the way to obtaining your CDL and landing your first job.
                    </p>
                </details>
            </div>
        </div>
    </section>
</main>
@endsection
