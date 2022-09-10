@extends('layouts.app')

@section('title',__('auth.reset password'))
@section('links')
<link rel="stylesheet" href="{{asset('css/register-style.css')}}">
<script src="{{asset('/js/script.js')}}"></script>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
@section('content')

<body>

    <div>
        @include('partials.alerts')
    </div>

  <form action="{{route('auth.password.reset')}}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <h1>@lang('auth.reset your password')</h1>

    <fieldset>

        <label  for="mail">@lang('auth.email'):</label>
        <input value="{{$email}}" type="email" id="mail" readonly name="email">

        <label for="password">@lang('auth.password'):</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">@lang('auth.confirm password'):</label>
        <input type="password" id="password" name="password_confirmation">


    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button id="sumbit" type="submit">@lang('auth.reset your password')</button>
  </form>

</body>
</html>
@endsection

