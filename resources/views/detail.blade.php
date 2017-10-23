@extends("layout.main")
@section('content')


    <div class="col-sm-8 blog-main">
        <form action="/posts/62" method="POST">
            <div class="form-group">
                <label>{{$article->title}}</label>
                <span>作者:{{$article->user->name}}</span>
                <span>时间:{{$article->created_at}}</span>
                @can('update',$article)
                <span> <a href="/editarticle/{{$article->id}}">编辑</a></span>
                @endcan
                @can('delete',$article)
                <span> <a onclick="return (confirm('确认删除这篇文章吗？'))" href="/deletearticle/{{$article->id}}">删除</a></span>
                @endcan
            </div>
            <div class="form-group">
                <p>{!!$article->content!!}</p>
            </div>
        </form>
        <br>
        <div>
            @if(!$article->zan(\Auth::id())->exists())
            <a id="zan" href="/zan/{{$article->id}}" type="button" class="btn btn-primary btn-lg">赞</a>
            @else
            <a id="zan" href="/unzan/{{$article->id}}" type="button" class="btn btn-default btn-lg">取消赞</a>
            @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">评论</div>

            <ul class="list-group">
                @foreach($article->comments as $comment)
                    <li class="list-group-item">
                        <div>
                            <h5>{{$comment->user->name}}发表于{{$comment->user->created_at}}</h5>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Default panel contents -->
        <div class="panel-heading">发表评论</div>

        <!-- List group -->
        <ul class="list-group">
            <form action="/comment/{{$article->id}}" method="post">
                {{csrf_field()}}
                <li class="list-group-item">
                    <textarea name="content" class="form-control" rows="10"></textarea>
                    <button class="btn btn-default" type="submit">提交</button>
                </li>
            </form>

        </ul>
    </div>


    <script src="/js/lib/jquery-1.10.2.min.js"></script>


@endsection
