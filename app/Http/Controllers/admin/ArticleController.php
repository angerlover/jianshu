<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
class ArticleController extends Controller
{
    /**
     * 文章列表
     */
    public function lst()
    {

        $articles = Article::orderBy('created_at','desc')->withoutGlobalScope('available')->where('status',0)->paginate(10);

        return view('admin.articles',compact('articles'));
    }

    /**
     * @param Article $article
     * 审核文章提交
     */
    public function shenhe(Article $article)
    {
//        dd(1);
        // 验证
        $this->validate(request(),[
           'status'=>'required|in:-1,1',
        ]);
        $article->status = request('status');
        if($article->save())
        {
            return [
              'error' => 0,
                'msg' => ''
            ];
        }

        else
        {
            return [
                'error' => 1,
                'msg'  => '错了'
            ];
        }

    }
}
