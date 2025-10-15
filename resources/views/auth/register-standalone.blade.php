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
            <div class="col-lg-5 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0">{{ __('Create Your Account') }}</h3>
                        <p class="mb-0 mt-2 small">Join USTRUCKPATH Today</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register.standalone.store') }}" id="registration-form">
                            @csrf

                            {{-- Full Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Full Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}"
                                       required autofocus autocomplete="name"
                                       placeholder="Enter your full name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email Address --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       required autocomplete="email"
                                       placeholder="your.email@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone Number (Optional) --}}
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-muted small">(Optional)</span></label>
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}"
                                       autocomplete="tel"
                                       placeholder="+1 (555) 123-4567">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password"
                                       placeholder="Create a strong password">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                      style="margin-top: 12px;"
                                      onclick="togglePassword('password')">
                                    <i class="bi bi-eye-fill cursor-pointer"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-4 position-relative">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       required autocomplete="new-password"
                                       placeholder="Re-enter your password">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                      style="margin-top: 12px;"
                                      onclick="togglePassword('password_confirmation')">
                                    <i class="bi bi-eye-fill cursor-pointer"></i>
                                </span>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg" id="register-button">
                                    {{ __('Create Account') }}
                                </button>
                            </div>

                            {{-- Login Link --}}
                            <div class="text-center">
                                <p class="mb-0">
                                    {{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        {{ __('Login here') }}
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="card border-0 bg-light mt-3">
                    <div class="card-body text-center py-3">
                        <small class="text-muted">
                            <i class="bi bi-shield-check text-success"></i>
                            Your information is secure and will never be shared
                        </small>
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
