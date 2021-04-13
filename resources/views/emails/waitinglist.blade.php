@component('mail::message')
# {{ __('Waiting List') }}

{{ __('You just subscribed to the waiting list. You will receive another email for access to the application.') }}

{{ __('Thanks') }},
{{ config('app.name') }}
@endcomponent
