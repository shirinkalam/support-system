

@extends('layouts.app')

@section('title',__('auth.login'))
@section('links')
<link rel="stylesheet" href="{{asset('css/register-style.css')}}">
<script src="{{asset('/js/script.js')}}"></script>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
<script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
@section('content')

<body>

    <div>
        @include('partials.alerts')
    </div>
    <div class="container-two-factor">
        <div>
            <h2>@lang('auth.two factor authentication')</h2>
        </div>
        <div>

        </div>
        <form action="{{route('auth.login.code')}}" method="POST">
            <div>
                <small>
                    @lang('auth.two factor code sent')
                </small>
            </div>
            <div>
                <input type="text" name="code" placeholder="کد را وارد نمایید ...">
            </div>
            <a class="not-give-dode" href="{{route('auth.two.factor.resent')}}">@lang('auth.not give code')</a><br>
            <br><a href="" class="confirm-btn">@lang('auth.confirm')</a>
        </form>
    </div>
</body>
</html>
@endsection

