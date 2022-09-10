@if($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <div class="offset-sm-3">
            <li class="text-danger">{{$error}}</li>
        </div>
    @endforeach
</ul>
@endif
