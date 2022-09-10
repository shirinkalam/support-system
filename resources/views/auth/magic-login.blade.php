@extends('layouts.app')

@section('title',__('auth.login'))
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

  <form action="{{route('auth.magic.send.token')}}" method="POST">
    @csrf
    <h1>@lang('auth.magic password')</h1>

    <fieldset>
      <fieldset>

        <label  for="mail">@lang('auth.email'):</label>
        <input value="{{old('email')}}" type="email" id="mail" name="email">

        <input type="checkbox" id="development" value="interest_development" name="remember"><label class="light" for="development">  @lang('auth.remember me')</label>
        </fieldset>
    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button type="submit">@lang('auth.send login link')</button>
  </form>

</body>
</html>
@endsection

