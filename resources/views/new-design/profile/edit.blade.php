@extends('new-design.partials.master')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="py-12 bg-[#0A2342] text-white">
        <div class="container mx-auto px-4">
            <h1 class="font-heading text-3xl font-bold uppercase">My Profile</h1>
            <p class="text-gray-300 mt-2">Manage your account settings and view your enrolled courses</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 mb-8">
                <!-- Update Profile Information -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="font-heading text-xl font-bold text-[#0A2342] uppercase mb-6">Profile Information</h2>
                    <p class="text-gray-600 text-sm mb-6">Update your account's profile information and email address.</p>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800">
                                        Your email address is unverified.
                                        <button form="send-verification" class="underline text-sm text-[#1B75F0] hover:text-[#0A2342]">
                                            Click here to re-send the verification email.
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            A new verification link has been sent to your email address.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-3 px-6 rounded-lg transition-all">
                                Save Changes
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600">Saved.</p>
                            @endif
                        </div>
                    </form>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
                        @csrf
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="font-heading text-xl font-bold text-[#0A2342] uppercase mb-6">Update Password</h2>
                    <p class="text-gray-600 text-sm mb-6">Ensure your account is using a long, random password to stay secure.</p>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                                    class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('current_password', 'updatePassword') border-red-500 @enderror">
                                <button type="button" onclick="togglePassword('current_password', this)" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" autocomplete="new-password"
                                    class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('password', 'updatePassword') border-red-500 @enderror">
                                <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                            @error('password', 'updatePassword')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirm Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                                    class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-300 focus:border-[#1B75F0] focus:ring-2 focus:ring-[#1B75F0]/20 outline-none transition-all @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                                <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-[#1B75F0] hover:bg-[#0A2342] text-white font-bold uppercase tracking-wide py-3 px-6 rounded-lg transition-all">
                                Update Password
                            </button>

                            @if (session('status') === 'password-updated')
                                <p class="text-sm text-green-600">Saved.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- My Courses Section -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="font-heading text-xl font-bold text-[#0A2342] uppercase mb-6">My Courses</h2>

                @if($courses->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            @php
                                $enrollmentStatus = $course->pivot->status ?? ucfirst($course->status);
                            @endphp
                            <div class="bg-[#F2F4F7] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                                <a href="{{ route('front.course.details', $course->slug) }}">
                                    @if($course->image)
                                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-40 object-cover">
                                    @else
                                        <img src="{{ asset('frontend/img/course-details.jpg') }}" alt="{{ $course->title }}" class="w-full h-40 object-cover">
                                    @endif
                                </a>
                                <div class="p-4">
                                    <h3 class="font-heading text-lg font-bold text-[#0A2342] mb-2">
                                        <a href="{{ route('front.course.details', $course->slug) }}" class="hover:text-[#1B75F0] transition-colors">
                                            {{ Str::limit($course->title, 30) }}
                                        </a>
                                    </h3>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="check-circle" class="h-4 w-4 text-[#1B75F0]"></i>
                                            <span class="text-gray-600">Status:
                                                @if($enrollmentStatus === 'approved')
                                                    <span class="text-green-600 font-bold">Approved</span>
                                                @elseif($enrollmentStatus === 'pending')
                                                    <span class="text-yellow-600 font-bold">Pending</span>
                                                @else
                                                    <span class="font-bold">{{ $enrollmentStatus }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        @if($course->isTierCourse())
                                            @php
                                                $userTier = auth()->user()->getSubscriptionTier($course->id);
                                            @endphp
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="star" class="h-4 w-4 text-[#F5B82E]"></i>
                                                <span class="text-gray-600">Tier:
                                                    @if($userTier === 'free')
                                                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-bold">FREE</span>
                                                    @elseif($userTier === 'premium')
                                                        <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold">PREMIUM</span>
                                                    @elseif($userTier === 'mentorship')
                                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded text-xs font-bold">MENTORSHIP</span>
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('course.curriculam', $course->id) }}" class="block w-full bg-[#1B75F0] hover:bg-[#0A2342] text-white text-center font-bold uppercase text-sm py-2 rounded-lg transition-colors">
                                            Go to Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i data-lucide="book-open" class="h-16 w-16 text-gray-300 mx-auto mb-4"></i>
                        <p class="text-gray-500 mb-4">You haven't enrolled in any courses yet.</p>
                        <a href="{{ route('front.course') }}" class="inline-block bg-[#F5B82E] hover:bg-[#F5B82E]/90 text-[#0A2342] font-bold uppercase py-3 px-6 rounded-lg transition-all">
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white rounded-xl shadow-md p-8 mt-8 border-l-4 border-red-500">
                <h2 class="font-heading text-xl font-bold text-red-600 uppercase mb-4">Delete Account</h2>
                <p class="text-gray-600 text-sm mb-6">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Before deleting your account, please download any data or information that you wish to retain.
                </p>

                <button type="button" onclick="document.getElementById('delete-modal').classList.remove('hidden')"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold uppercase tracking-wide py-3 px-6 rounded-lg transition-all">
                    Delete Account
                </button>
            </div>
        </div>
    </section>
</main>

<!-- Delete Account Modal -->
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
        <h3 class="font-heading text-xl font-bold text-[#0A2342] mb-4">Are you sure you want to delete your account?</h3>
        <p class="text-gray-600 text-sm mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please enter your password to confirm you would like to permanently delete your account.
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
            @csrf
            @method('delete')

            <div>
                <label for="delete_password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="delete_password" placeholder="Enter your password"
                        class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                    <button type="button" onclick="togglePassword('delete_password', this)" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                        <i data-lucide="eye" class="h-5 w-5"></i>
                    </button>
                </div>
                @error('password', 'userDeletion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold uppercase tracking-wide py-2 px-4 rounded-lg transition-all">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold uppercase tracking-wide py-2 px-4 rounded-lg transition-all">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
<script>
    document.getElementById('delete-modal').classList.remove('hidden');
</script>
@endif

@push('scripts')
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
@endpush
@endsection
