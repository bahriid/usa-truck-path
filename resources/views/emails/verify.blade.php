@component('mail::message')
<!-- Header with Logo -->
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ $logoUrl }}" alt="Logo sachin" style="max-width: 200px;">
</div>

# {{ __('Verify Email Address') }}

{{ __('Please click the button below to verify your email address.') }}

@component('mail::button', ['url' => $url])
{{ __('Verify Email Address') }}
@endcomponent

{{ __('If you did not create an account, no further action is required.') }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
