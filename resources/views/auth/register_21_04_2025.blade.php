@extends('partials.master')

@push('styles')
    <style>
        #card-element {
            padding: 1rem;
            color: #374151; /* Darker gray text */
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af; /* Medium gray icon color */
        }
    </style>
@endpush

@section('main')
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}" id="registration-form">
            @csrf
            <input type="hidden" name="course_id" value="{{ $courseId }}">

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4 position-relative">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <span class="password-toggle" onclick="togglePassword('password')">
                    <i class="bi bi-eye-fill"></i>
                </span>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 position-relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                    <i class="bi bi-eye-fill"></i>
                </span>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>


            <h5 class="text-bold mt-6">Payment Information</h5>
            <hr class="mt-2 mb-4">

            <p>You are registering for the course:
                <strong>{{ \App\Models\Course::find($courseId)->title ?? 'Unknown Course' }}</strong></p>
            <div class="mt-4">
                <x-input-label for="price" :value="__('Course Price')" />
                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                    value="{{ \App\Models\Course::find($courseId)->price ?? 'N/A' }}" readonly />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="card-element" :value="__('Credit or debit card')" />
                <div id="card-element"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div id="card-errors" role="alert" class="mt-2 text-sm text-red-600 space-y-1"></div>
                <input type="hidden" name="stripeToken" id="stripeToken">
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4" id="register-button" style="background-color: #5fcf80 !important;">
                    {{ __('Register and Pay') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();

        const cardElement = elements.create('card', {
            style: {
                base: {
                    color: '#374151', // Darker gray text (like Tailwind's gray-700)
                    backgroundColor: '#f9fafb', // Light gray background (like Tailwind's gray-50)
                    fontFamily: 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                    fontSize: '1rem',
                    '::placeholder': {
                        color: '#9ca3af', // Medium gray placeholder (like Tailwind's gray-400)
                    },
                    padding: '1rem',
                    borderRadius: '0.375rem',
                    border: '1px solid #d1d5db', // Light gray border (like Tailwind's gray-300)
                },
                invalid: {
                    color: '#dc2626',
                    border: '1px solid #ef4444',
                },
                focus: {
                    borderColor: '#6366f1',
                    boxShadow: '0 0 0 0.2rem rgba(99, 102, 241, 0.25)',
                },
            },
        });

        cardElement.mount('#card-element');

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

        registrationForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            registerButton.disabled = true;

            const {
                token,
                error
            } = await stripe.createToken(cardElement);

            if (error) {
                cardErrors.textContent = error.message;
                registerButton.disabled = false;
            } else {
                stripeTokenInput.value = token.id;
                registrationForm.submit();
            }
        });
    </script>
@endsection