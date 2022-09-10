@extends('layouts.app')

@section('title',__('auth.register user'))
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

  <form action="{{route('auth.register')}}" method="POST">
    @csrf
    <h1>Register</h1>

    <fieldset>
        <legend><span class="number">1</span>@lang('auth.enter your info')</legend>
        <label for="name">@lang('auth.name') :</label>
        <input value="{{old('name')}}" type="text" id="name" name="name">

        <label  for="mail">@lang('auth.email'):</label>
        <input value="{{old('email')}}" type="email" id="mail" name="email">

        <label for="password">@lang('auth.password'):</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">@lang('auth.confirm password'):</label>
        <input type="password" id="password" name="password_confirmation">

        <label for="phone_number">@lang('auth.phone number'):</label>
        <input type="text" id="phone_number" name="phone_number">

    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button id="sumbit" type="submit">@lang('auth.sign up')</button>
  </form>

</body>
</html>
@endsection

