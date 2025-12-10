<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - USATruckPath</title>

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
                    <h1 class="font-heading text-3xl font-bold text-[#0A2342] uppercase">Welcome Back</h1>
                    <p class="text-gray-600 mt-2">Sign in to continue your trucking journey</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror" placeholder="you@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-[#1B75F0] hover:underline font-medium">Forgot password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('password') border-red-500 @enderror" placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-[#1B75F0] focus:ring-[#1B75F0] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <button type="submit" class="w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-3 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                        Sign In
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-[#1B75F0] font-bold hover:underline">Create free account</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
