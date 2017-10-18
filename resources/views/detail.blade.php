@extends("layout.main")
@section('content')


    <div class="col-sm-8 blog-main">
        <form action="/posts/62" method="POST">
            <div class="form-group">
                <label>{{$article->title}}</label>
                <span>作者:{{$article->user_id}}</span>
                <span>时间:{{$article->created_at}}</span>
                <span> <a href="/editarticle/{{$article->id}}">编辑</a></span>
                <span> <a onclick="return (confirm('确认删除这篇文章吗？'))" href="/deletearticle/{{$article->id}}">删除</a></span>
            </div>
            <div class="form-group">
                <p>{!!$article->content!!}</p>
            </div>
        </form>
        <br>
            </div><!-- /.blog-main -->



@endsection
