
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">


    <title>laravel for blog</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/wangEditor.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <form action="/search" method="get">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/articles">首页</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/addarticle">写文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices/{{\Auth::id()}}">通知</a>
            </li>
            <li>
                <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
            </li>
            <li>
                <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
            </li>
        </ul>
        </form>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(\Auth::check()){{\Auth::user()->name}}@else 欢迎来到简书   @endif </a>
                    <ul class="dropdown-menu">
                        @if(\Auth::check())
                        <li><a href="/center/{{\Auth::id()}}">我的主页</a></li>
                        <li><a href="/setting/{user}">个人设置</a></li>
                        <li><a href="/logout">登出</a></li>
                        @else
                            <li><a href="/login">登录</a></li>
                            <li><a href="/register">注册</a></li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="container">

    <div class="blog-header">
    </div>
    <div class="row">
    @yield('content')
    @include("layout.sidebar")
    </div>
</div><!-- /.container -->

@include("layout.footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script src="/js/ylaravel.js"></script>

</body>
</html>
