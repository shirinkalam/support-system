@component('mail::message')
# Login With Magic Link

The body of your message.

@component('mail::button', ['url' => $link])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
