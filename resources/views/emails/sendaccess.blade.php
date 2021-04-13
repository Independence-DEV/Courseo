@component('mail::message')
# Create your Courseo account

Courseo is waiting you!

{{ __('To create your account, please click the button below.') }}
@component('mail::button', ['url' => env('APP_URL').'/register?email='.$prospect->email])
Start with Courseo
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
