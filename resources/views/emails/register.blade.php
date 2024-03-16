@component('mail::message')

<p>Hello {{ $user->name }}</p>

@component('mail::button',['url'=>url('verify/'.$user->remember_token)])
Verify
@endcomponent

<p>If you encounter any issues, please feel free to contact us using our contact form.</p>

Thanks <br/>
{{ config('app.name') }}
@endcomponent