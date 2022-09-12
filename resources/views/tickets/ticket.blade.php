@extends('layouts.app')

@section('title',__('support.new'))
@section('links')
<link rel="stylesheet" href="{{asset('css/register-style.css')}}">
<script src="{{asset('/js/script.js')}}"></script>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
@section('content')

<body>
  <form actio="" method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
        <h3>{{$ticket->title}}</h3>
        <div>
            <p>
                {{$ticket->text}}
            </p>

            @if ($ticket->hasFile())
            <a href="{{$ticket->file()}}">دانلود پیوست</a>
            @endif

            <div>
                <p>{{$ticket->created_at}} توسط {{$ticket->user->name}}</p>
            </div>

        </div>

        @foreach ($ticket->replies as $reply)
        <div>
            <p>
                {{$reply->text}}
            </p>
            <p>
                {{$reply->created_at}} توسط {{$reply->replible->name}}
            </p>
        </div>
        @endforeach

        <div>
        <input type="text" id="password" name="text" placeholder="@lang('support.your text')">
        </div>
    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button id="sumbit" type="submit">@lang('support.sent')</button>
  </form>

</body>
</html>
@endsection

