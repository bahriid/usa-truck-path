@extends('partials.master')

@push('styles')
    <style>
        .form-control-stripe {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.75rem;
            background-color: #fff;
            color: #495057;
            box-shadow: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            width: 100%;
            /* Ensure they take full width of their container */
        }

        .form-control-stripe.StripeElement--focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control-stripe.StripeElement--invalid {
            border-color: #dc3545;
        }

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
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0">{{ __('Register & Pay') }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" id="registration-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $courseId }}">
                             
                        
                            {{-- Personal Information --}}
                            <h5 class="mb-3">{{ __('Personal Information') }}</h5>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-md" name="name"
                                           value="{{ old('name') }}" required autofocus autocomplete="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-md" name="email"
                                           value="{{ old('email') }}" required autocomplete="username">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror rounded-md" name="phone"
                                           value="{{ old('phone') }}" required autocomplete="username">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row">
                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror rounded-md" name="password"
                                           required autocomplete="new-password">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control rounded-md"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Payment Info --}}
                            <hr class="my-4">
                            <h5 class="mb-3">{{ __('Payment Information') }}</h5>

                            <div class="mb-3">
                                <p class="mb-1">{{ __('You are registering for:') }}
                                    <strong>{{ \App\Models\Course::find($courseId)->title ?? 'Unknown Course' }}</strong>
                                </p>
                                <label for="price" class="form-label">{{ __('Course Price') }}</label>
                                <input id="price" type="text" class="form-control rounded-md" name="price"
                                       value="{{ \App\Models\Course::find($courseId)->price ?? 'N/A' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Card Number') }}</label>
                                <div id="card-number" class="form-control py-2 rounded-md"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Expiry Date') }}</label>
                                    <div id="card-expiry" class="form-control py-2 rounded-md"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('CVC') }}</label>
                                    <div id="card-cvc" class="form-control py-2 rounded-md"></div>
                                </div>
                            </div>

                            <div id="card-errors" class="text-danger mb-3"></div>
                            <input type="hidden" name="stripeToken" id="stripeToken">

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <a class="text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Already registered? Login') }}
                                </a>
                                <button type="submit" class="btn btn-success px-2" id="register-button">{{ __('Register and Pay') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();

            const cardNumberElement = elements.create('cardNumber', {
                style: {
                    base: {
                        color: '#495057',
                        fontFamily: 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        fontSize: '1rem',
                        '::placeholder': {
                            color: '#6c757d',
                        },
                        padding: '0.75rem',
                        border: '1px solid transparent',
                        /* Remove border as it's handled by the container */
                        borderRadius: '0.25rem',
                        backgroundColor: 'transparent',
                        boxShadow: 'none',
                    },
                    invalid: {
                        color: '#dc3545',
                    },
                    focus: {
                        borderColor: '#007bff',
                        /* Focus style will be applied to the container */
                        boxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',
                        /* Focus style on container */
                    },
                },
            });
            cardNumberElement.mount('#card-number');

            const cardExpiryElement = elements.create('cardExpiry', {
                style: {
                    base: {
                        color: '#495057',
                        fontFamily: 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        fontSize: '1rem',
                        '::placeholder': {
                            color: '#6c757d',
                        },
                        padding: '0.75rem',
                        border: '1px solid transparent',
                        borderRadius: '0.25rem',
                        backgroundColor: 'transparent',
                        boxShadow: 'none',
                    },
                    invalid: {
                        color: '#dc3545',
                    },
                    focus: {
                        borderColor: '#007bff',
                        boxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',
                    },
                },
            });
            cardExpiryElement.mount('#card-expiry');

            const cardCvcElement = elements.create('cardCvc', {
                style: {
                    base: {
                        color: '#495057',
                        fontFamily: 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        fontSize: '1rem',
                        '::placeholder': {
                            color: '#6c757d',
                        },
                        padding: '0.75rem',
                        border: '1px solid transparent',
                        borderRadius: '0.25rem',
                        backgroundColor: 'transparent',
                        boxShadow: 'none',
                    },
                    invalid: {
                        color: '#dc3545',
                    },
                    focus: {
                        borderColor: '#007bff',
                        boxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',
                    },
                },
            });
            cardCvcElement.mount('#card-cvc');

            const cardErrors = document.getElementById('card-errors');
            const registrationForm = document.getElementById('registration-form');
            const registerButton = document.getElementById('register-button');
            const stripeTokenInput = document.getElementById('stripeToken');

            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = passwordInput.nextElementSibling.querySelector('i');
                icon.classList.toggle('bi-eye-fill');
                icon.classList.toggle('bi-eye-slash-fill');
            }

            // registrationForm.addEventListener('submit', async (event) => {

            //     event.preventDefault();
            //     registerButton.disabled = true;

            //     console.log('cardNumberElement:', cardNumberElement);
            //     console.log('cardExpiryElement:', cardExpiryElement);
            //     console.log('cardCvcElement:', cardCvcElement);

            //     setTimeout(async () => {
            //         const {
            //             token,
            //             error
            //         } = await stripe.createToken({
            //             card: cardNumberElement,
            //             cvc: cardCvcElement,
            //             exp: cardExpiryElement,
            //         });

            //         if (error) {
            //             cardErrors.textContent = error.message;
            //             registerButton.disabled = false;
            //         } else {
            //             stripeTokenInput.value = token.id;
            //             registrationForm.submit();
            //         }
            //     }, 500);
            // });
            registrationForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                registerButton.disabled = true;

                const { token, error } = await stripe.createToken(cardNumberElement);

                if (error) {
                    cardErrors.textContent = error.message;
                    registerButton.disabled = false;
                } else {
                    stripeTokenInput.value = token.id;
                    registrationForm.submit();
                }
            });
        });

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
