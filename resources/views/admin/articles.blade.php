@extends("admin.layout.main")
@section("content")

            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>文章标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>{{$article->title}}</td>
                                <td>
                                    <button type="button" class="btn btn-block btn-default post-audit" article-id="{{$article->id}}" article-action-status="1" >通过</button>
                                    <button type="button" class="btn btn-block btn-default post-audit" article-id="{{$article->id}}" article-action-status="-1" >拒绝</button>
                                </td>
                            </tr>
                                @endforeach
                            </tbody></table>
                    </div>


                </div>
            </div>
        </div>
        {{$articles->links()}}
    </section>
        <!-- /.content -->
   @endsection