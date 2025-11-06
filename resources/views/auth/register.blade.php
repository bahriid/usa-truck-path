@extends('partials.master')

@push('styles')
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
@endpush

@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0">{{ __('Sign Up Free') }}</h3>
                        @if(request('course_id'))
                            <p class="mb-0 mt-2" style="font-size: 0.9rem;">Get instant access to your free course</p>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" id="registration-form">
                            @csrf

                            {{-- Hidden course ID (passed from free course landing page) --}}
                            @if(request('course_id'))
                                <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                            @endif

                            {{-- Personal Information --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror rounded-md"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus
                                           autocomplete="name"
                                           placeholder="John Doe">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror rounded-md"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           placeholder="john@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                    <input id="phone" type="tel"
                                           class="form-control @error('phone') is-invalid @enderror rounded-md"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           required
                                           autocomplete="tel"
                                           placeholder="+1 (555) 123-4567">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="country" class="form-label">{{ __('Country') }} <span class="text-danger">*</span></label>
                                    <input id="country" type="text"
                                           class="form-control @error('country') is-invalid @enderror rounded-md"
                                           name="country"
                                           value="{{ old('country') }}"
                                           required
                                           autocomplete="country-name"
                                           placeholder="e.g., United States">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row">
                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror rounded-md"
                                           name="password"
                                           required
                                           autocomplete="new-password"
                                           placeholder="Minimum 8 characters">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <input id="password_confirmation" type="password"
                                           class="form-control rounded-md"
                                           name="password_confirmation"
                                           required
                                           autocomplete="new-password"
                                           placeholder="Re-enter password">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <a class="text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <button type="submit" class="btn btn-success px-4" id="register-button">
                                    {{ __('Sign Up Free') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }
    </script>
@endsection
