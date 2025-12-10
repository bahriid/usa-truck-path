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
                    <h1 class="font-heading text-3xl font-bold text-[#0A2342] uppercase">Sign Up Free</h1>
                    @if(request('course_id'))
                        <p class="text-gray-600 mt-2">Get instant access to your free course</p>
                    @else
                        <p class="text-gray-600 mt-2">Start your free trucking courses today</p>
                    @endif
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Hidden course ID (passed from free course landing page) --}}
                    @if(request('course_id'))
                        <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                    @endif

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('name') border-red-500 @enderror" placeholder="John Doe">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror" placeholder="you@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Phone Number <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="phone" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('phone') border-red-500 @enderror" placeholder="+1 (555) 123-4567">
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-bold text-gray-700 mb-2">Country <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="globe" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400 z-10"></i>
                            <select id="country" name="country" required class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all appearance-none bg-white @error('country') border-red-500 @enderror">
                                <option value="">Select your country</option>
                                <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                <option value="Albania" {{ old('country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                <option value="Algeria" {{ old('country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                <option value="Bulgaria" {{ old('country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                <option value="Cameroon" {{ old('country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                <option value="Congo" {{ old('country') == 'Congo' ? 'selected' : '' }}>Congo</option>
                                <option value="Croatia" {{ old('country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                <option value="Czech Republic" {{ old('country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                <option value="Denmark" {{ old('country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                <option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                <option value="Eritrea" {{ old('country') == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                <option value="Ethiopia" {{ old('country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                <option value="Finland" {{ old('country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                <option value="Greece" {{ old('country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                <option value="Honduras" {{ old('country') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                <option value="Hungary" {{ old('country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Iran" {{ old('country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                <option value="Iraq" {{ old('country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                <option value="Israel" {{ old('country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                <option value="Jamaica" {{ old('country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                <option value="Jordan" {{ old('country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                <option value="Kuwait" {{ old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                <option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                <option value="Libya" {{ old('country') == 'Libya' ? 'selected' : '' }}>Libya</option>
                                <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                <option value="Morocco" {{ old('country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                <option value="Nepal" {{ old('country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                <option value="New Zealand" {{ old('country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                <option value="Norway" {{ old('country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                <option value="Poland" {{ old('country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                <option value="Qatar" {{ old('country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                <option value="Romania" {{ old('country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                <option value="Senegal" {{ old('country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                <option value="Serbia" {{ old('country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                <option value="Somalia" {{ old('country') == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                <option value="South Korea" {{ old('country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                <option value="Spain" {{ old('country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                <option value="Sudan" {{ old('country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                <option value="Sweden" {{ old('country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                <option value="Switzerland" {{ old('country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                <option value="Syria" {{ old('country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                <option value="Tanzania" {{ old('country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                <option value="Turkey" {{ old('country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                <option value="Uganda" {{ old('country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                <option value="Ukraine" {{ old('country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                <option value="United Arab Emirates" {{ old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="Venezuela" {{ old('country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                <option value="Yemen" {{ old('country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                <option value="Zambia" {{ old('country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                <option value="Zimbabwe" {{ old('country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                <option value="Other" {{ old('country') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="password" id="password" name="password" required autocomplete="new-password" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('password') border-red-500 @enderror" placeholder="Minimum 8 characters">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all" placeholder="Re-enter password">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase tracking-wide py-3 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                        Sign Up Free
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

    <script>lucide.createIcons();</script>
</body>
</html>
