@component('mail::message')

<p>Hello {{ $user->name }}</p>
<p>We understand it happens</p>

@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>If you encounter any password-related issues, please feel free to contact us using our contact form. We'll be happy to assist you with resetting your password.</p>

Thanks <br/>
{{ config('app.name') }}
@endcomponent
