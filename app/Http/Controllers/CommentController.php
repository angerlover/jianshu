<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;

class CommentController extends Controller
{
    // 提交评论
    public function comment(Article $article,Request $request)
    {
        // 验证用户登录
        if(!\Auth::check())
        {
            return redirect('/login');
        }
        //验证用户提交数据
        $this->validate($request,[
            'content' => 'required|min:3'
        ]);
//        $this->authorize('create');

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = \Auth::id();
//        dd($article);
        //提交
        $article->comments()->save($comment);

        // 返回当前页
        return back();

    }
}
