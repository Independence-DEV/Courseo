@component('mail::message')
# {{ __('Welcome ').$name }}

{{ __('You can start to work on your website!') }}

@component('mail::button', ['url' => 'https://courseo.tech/app'])
My Courseo Access
@endcomponent

{{ __('Your website is accessible here : ') }}<a href="http://{{ $website }}">{{$website}}</a>

{{ __('Thanks,') }}
{{ config('app.name') }}
@endcomponent
