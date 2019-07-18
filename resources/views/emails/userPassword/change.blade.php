@component('mail::message')
    @if($user)
# Your account has been created , please find your credentials :
your email is :{{$user->email}}

your password is : {{$password}}

@endif

If You wnat to change your password, please press here :

@component('mail::button', ['url' => 'login'])
Reset your Password
@endcomponent

Thanks for using,<br>
{{ config('app.name') }}
@endcomponent
