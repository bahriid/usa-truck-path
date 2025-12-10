@extends('new-design.partials.master')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 48px;
        padding: 10px 16px;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px;
        color: #374151;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }
    .select2-dropdown {
        border-radius: 0.5rem;
        border-color: #d1d5db;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #1B75F0;
    }
</style>
@endpush

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative py-12 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4">
            <h1 class="font-heading text-2xl md:text-3xl font-bold mb-2">Enroll in {{ $course->title }}</h1>
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Home</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <a href="{{ route('front.course') }}" class="text-gray-300 hover:text-[#F5B82E] transition-colors">Courses</a>
                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-500"></i>
                <span class="text-[#F5B82E]">Enroll</span>
            </nav>
        </div>
    </section>

    <section class="py-12 bg-[#F2F4F7]">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        @if($course->isTierCourse())
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                                <i data-lucide="gift" class="h-6 w-6 text-green-600 flex-shrink-0 mt-0.5"></i>
                                <div>
                                    <p class="font-semibold text-green-800">Great news!</p>
                                    <p class="text-green-700 text-sm">This course offers FREE access to get started!</p>
                                </div>
                            </div>
                        @else
                            <div class="bg-[#1B75F0]/10 border border-[#1B75F0]/20 rounded-xl p-4 mb-6 flex items-start gap-3">
                                <i data-lucide="info" class="h-6 w-6 text-[#1B75F0] flex-shrink-0 mt-0.5"></i>
                                <div>
                                    <p class="font-semibold text-[#0A2342]">Course Price</p>
                                    <p class="text-2xl font-bold text-[#1B75F0]">${{ number_format($course->price, 2) }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('front.courses.processEnroll', $course->id) }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name"
                                       value="{{ old('full_name', auth()->user()->name) }}"
                                       required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('full_name') border-red-500 @enderror"
                                       placeholder="Enter your full name">
                                @error('full_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror"
                                       placeholder="Enter your email">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Phone <span class="text-red-500">*</span></label>
                                <input type="text" name="phone"
                                       value="{{ old('phone', auth()->user()->phone) }}"
                                       required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('phone') border-red-500 @enderror"
                                       placeholder="Enter your phone number">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Country <span class="text-red-500">*</span></label>
                                <select id="country" name="country" required class="w-full @error('country') border-red-500 @enderror">
                                    <option value="">Select your country</option>
                                    @php
                                        $countries = ['United States', 'Canada', 'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Cape Verde', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'East Timor', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'North Korea', 'South Korea', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'];
                                        $userCountry = old('country', auth()->user()->country ?? '');
                                    @endphp
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ $userCountry == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-3 pt-4">
                                @if($course->isTierCourse())
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold uppercase tracking-wide py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                        <i data-lucide="check-circle" class="h-5 w-5"></i>
                                        Enroll for FREE
                                    </button>
                                @else
                                    <button type="submit" class="w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                        <i data-lucide="arrow-right" class="h-5 w-5"></i>
                                        Continue to Payment
                                    </button>
                                @endif

                                <a href="{{ route('front.course.details', $course->slug) }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 rounded-lg transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="arrow-left" class="h-5 w-5"></i>
                                    Back to Course
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#country').select2({
            placeholder: 'Select your country',
            allowClear: false,
            width: '100%'
        });
    });
</script>
@endsection
