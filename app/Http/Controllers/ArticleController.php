<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 文章列表页
     */
    function lst()
    {
        $model = new Article();
        $data = $model->orderBy('created_at','desc')->paginate(5);
        return view('lst',compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 文章添加页
     */
    function add()
    {
        return view('add');
    }

    /**
     * 文章详情页
     */
    function show(Article $article)
    {
        return view('detail',compact('article'));
    }
    /**
     *  添加提交
     */
    function addArticlePost(Request $request)
    {
        $model = new Article();
//        dd($request['title']);
        // 验证数据
        $this->validate($request,['title'=>'required|max:100|min:1',
                                    'content'=>'required'
                    ]);
        if(Article::create($request->all()))
        {
            return redirect('/articles');
        }

    }

    /**
     * @param $id
     * 编辑文章
     */
    function edit(Article $article)
    {
        return view('editarticle',compact('article'));
    }

    /**
     * 文章修改后提交
     */
    function editArticlePost(Article $article)
    {
        $request = request();
        // 验证
        $this->validate($request,['title'=>'required|max:100|min:1',
            'content'=>'required'
        ]);
//        $article->title = $request->all()['title'];
//        $article->content = $request->all(['content']);

        if($article->update(request(['title','content'])))
        {
            return redirect('/articles/'.$article->id);
        }
    }

    /**
     * @param $id
     * 删除文章
     */
    function deleteArticle(Article $article)
    {
        if($article->delete())
        {
            return redirect('/articles');
        }
    }

    function uploadImage(Request $request)
    {
        // 直接利用Laravel的文件系统保存
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}
