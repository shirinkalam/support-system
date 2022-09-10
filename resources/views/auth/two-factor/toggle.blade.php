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

        </div>
        @if (Auth::user()->hasTwoFactor())
        <div>
            <div>
                <small>
                    @lang('auth.two factor is active',['number'=>Auth::user()->phone_number])
                </small>
            </div>
            <a href="{{route('auth.two.factor.deactivate')}}" class="active-btn">@lang('auth.deactivate')</a>
        </div>
        @else
        <div>
            <div>
                <small>
                    @lang('auth.two factor is inactive',['number'=>Auth::user()->phone_number])
                </small>
            </div>
            <a href="{{route('auth.two.factor.activate')}}" class="active-btn">@lang('auth.activate')</a>
        </div>
        @endif
    </div>
</body>
</html>
@endsection

