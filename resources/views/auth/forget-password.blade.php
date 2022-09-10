@extends('layouts.app')

@section('title',__('auth.forget password'))
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

  <form action="{{route('auth.password.forget')}}" method="POST">
    @csrf
    <h1>@lang('auth.forget password')</h1>

    <fieldset>
      <legend>@lang('auth.enter your info')</legend>
      <fieldset>

        <label  for="mail">@lang('auth.email'):</label>
        <input value="{{old('email')}}" type="email" id="mail" name="email">

        </fieldset>
    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button type="submit">@lang('auth.recover password')</button>
  </form>

</body>
</html>
@endsection

