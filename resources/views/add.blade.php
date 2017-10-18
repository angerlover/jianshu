@extends("layout.main")
@section('content')

    <div class="col-sm-8 blog-main">
        <form action="/addarticlepost" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
            </div>
                        <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
        {{--错误提示--}}
        @if(count($errors) >0)
        <div class="alert-danger alert">
            @foreach($errors->all() as $error)
                <span>{{$error}}</span>

            @endforeach
        </div>
        @endif
    </div><!-- /.blog-main -->
@endsection
