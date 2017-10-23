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
        $data = $model->orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(5);
        return view('lst',compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 文章添加页
     */
    function add()
    {
        // 检查是否登录
        if(!\Auth::check())
        {
            return redirect('/login');
        }
        return view('add');
    }

    /**
     * 文章详情页
     */
    function show(Article $article)
    {
        // 预加载文章的关联模型：评论
        $article->load('comments');
        return view('detail',compact('article'));
    }
    /**
     *  添加提交
     */
    function addArticlePost(Request $request)
    {
        // 检查是否登录
        if(!\Auth::check())
        {
            return redirect('\login');
        }
        $model = new Article();
//        dd($request['title']);
        // 验证数据
        $this->validate($request,['title'=>'required|max:100|min:1',
                                    'content'=>'required'
                    ]);
        $data = array_merge($request->all(),['user_id'=>\Auth::id()]);
        if(Article::create($data))
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
        $this->authorize('update',$article);
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
        // 赋予权限？这实际是一个检验的过程吧
        $this->authorize('update',$article);
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
        $this->authorize('delete',$article);
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
