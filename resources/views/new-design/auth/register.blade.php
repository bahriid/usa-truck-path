<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - USATruckPath</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Oswald', 'sans-serif'],
                    },
                    colors: {
                        navy: '#0A2342',
                        brightBlue: '#1B75F0',
                        gold: '#F5B82E',
                        lightGray: '#F2F4F7',
                        darkGray: '#3A3A3A',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; color: #3A3A3A; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Oswald', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 selection:bg-[#F5B82E] selection:text-[#0A2342] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-[#0A2342] text-white shadow-md">
        <div class="container mx-auto px-4 flex h-20 items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-heading text-2xl font-bold uppercase tracking-tighter text-white hover:text-[#F5B82E] transition-colors">
                <i data-lucide="truck" class="h-8 w-8 text-[#F5B82E]"></i>
                <span>USATruckPath</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-bold uppercase tracking-wide text-white hover:text-[#F5B82E] transition-all flex items-center gap-2">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to Home
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-[#F5B82E]">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="font-heading text-3xl font-bold text-[#0A2342] uppercase">Create Account</h1>
                    <p class="text-gray-600 mt-2">Start your free trucking courses today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    {{-- Hidden course ID (passed from free course landing page) --}}
                    @if(request('course_id'))
                        <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('first_name') border-red-500 @enderror" placeholder="John">
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('last_name') border-red-500 @enderror" placeholder="Doe">
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden name field to combine first and last name -->
                    <input type="hidden" name="name" id="name" value="">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror" placeholder="you@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="password" name="password" required autocomplete="new-password" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('password') border-red-500 @enderror" placeholder="Create a password">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms" required class="mt-1 h-4 w-4 text-[#1B75F0] focus:ring-[#1B75F0] border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-600">
                            I agree to the <a href="{{ route('front.terms') }}" class="text-[#1B75F0] hover:underline">Terms of Service</a> and <a href="{{ route('front.privacy') }}" class="text-[#1B75F0] hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase tracking-wide py-3 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                        Create Free Account
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600 text-sm">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-[#1B75F0] font-bold hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        // Combine first and last name into name field before form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const firstName = document.querySelector('input[name="first_name"]').value;
            const lastName = document.querySelector('input[name="last_name"]').value;
            document.getElementById('name').value = firstName + ' ' + lastName;
        });
    </script>
</body>
</html>
