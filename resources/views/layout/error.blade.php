{{--错误提示--}}
@if(count($errors) >0)
    <div class="alert-danger alert">
        @foreach($errors->all() as $error)
            <span>{{$error}}</span>

        @endforeach
    </div>
@endif