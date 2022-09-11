@extends('layouts.app')

@section('title',__('support.new'))
@section('links')
<link rel="stylesheet" href="{{asset('css/register-style.css')}}">
<script src="{{asset('/js/script.js')}}"></script>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
@section('content')

<body>
  <form action="{{route('ticket.create')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
        <label for="title">@lang('support.the title of article') :</label>
        <input value="{{old('title')}}" type="text" id="name" name="title">

        <label  for="department">@lang('support.department'):</label>
        <select name="department" id="">
            <option value="1">فنی</option>
        </select>

        <label for="periority">@lang('support.periority'):</label>
        <select name="periority" id="">
            <option value="1">پایین</option>
        </select>

        <label for="text">@lang('support.text'):</label>
        <input type="text" id="password" name="text">

        <label for="attachment">@lang('support.attachment'):</label>
        <input type="file" name="file">

    </fieldset>

    <div class="">
        @include('partials.validations-errors')
    </div>

    <button id="sumbit" type="submit">@lang('support.submit')</button>
  </form>

</body>
</html>
@endsection

