@extends("layout.main")
@section("content")
    <div class="row">

    <div class="alert alert-success" role="alert">
        下面是搜索"{{$query}}"出现的文章，共{{$articles->total()}}条
    </div>

    <div class="col-sm-8 blog-main">
        @foreach($articles as $article)
                    <div class="blog-post">
                <h2 class="blog-post-title"><a href="/articles/{{$article->id}}" >{{$article->title}}</a></h2>
                <p class="blog-post-meta">{{$article->created_at}} By <a href="#"></a></p>

                <p>{!! str_limit($article->content,100,'...') !!}</p>
                <p class="blog-post-meta">赞 {{$article->zans_count}} | 评论 {{$article->comment_count}}</p>
        @endforeach
                        {{$articles->links()}}
                    </div>

            {{--分页--}}
    </div><!-- /.blog-main -->

    </div>

  @endsection