@component('mail::message')
# {{ __('Course access : ').$course->title }}

{{ __('Hello ').$name.',' }}

{{ __('To have your access to this course, please click the button below.') }}
@component('mail::button', ['url' => 'https://independence-dev.com'.$url])
Get my course
@endcomponent

{{ __('Thanks,') }}
{{ $course->account->name }}
@endcomponent
