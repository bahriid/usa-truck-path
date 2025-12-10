    <!-- Footer -->
    <footer class="bg-[#0A2342] text-white pt-20 pb-10 border-t-4 border-[#F5B82E]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand Column -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 font-heading text-2xl font-bold uppercase tracking-tighter mb-6">
                        <i data-lucide="truck" class="h-8 w-8 text-[#F5B82E]"></i>
                        <span>USATruckPath</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Helping people outside the USA understand how to become truck drivers in the United States. From Canada to your first mile on American roads.
                    </p>
                </div>

                <!-- PROGRAMS -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Programs</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('front.course') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Free Course</a></li>
                        <li><a href="{{ route('front.mentorship') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Mentorship</a></li>
                    </ul>
                </div>

                <!-- SUPPORT -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/#faq') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">FAQ</a></li>
                        <li><a href="{{ route('front.contact_us') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Contact Support</a></li>
                    </ul>
                </div>

                <!-- LEARN -->
                <div class="col-span-1">
                    <h4 class="font-heading text-lg font-bold uppercase mb-6 text-[#F5B82E] tracking-wide">Learn</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/#how-it-works') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">How It Works</a></li>
                        <li><a href="{{ url('/#testimonials') }}" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all inline-block">Success Stories</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 border-t border-white/10 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} USATruckPath. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide icons -->
    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>
</html>
