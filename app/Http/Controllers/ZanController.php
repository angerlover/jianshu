<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zan;
use App\Article;

class ZanController extends Controller
{
    //点赞
    public function zan(Article $article,Request $request)
    {
        // 有则查找 无则创建
        Zan::firstOrCreate(['user_id'=>\Auth::id(),'article_id'=>$article->id]);
        return back();

    }

    public function unzan(Article $article)
    {
        $article->zan(\Auth::id())->delete();
        return back();
    }
}
