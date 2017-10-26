<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Article;

class TopicController extends Controller
{
    // 详情页
    public function show(Topic $topic)
    {
        // 带文章数的专题(重做topic)
        $topic = Topic::withCount('articleTopics')->find($topic->id);

        // 当前话题下的所有文章
        $articles = $topic->articles()->orderBy('created_at','desc')->take(10)->get();

        // 属于当前用户的未投稿的文章
        $myArticles = Article::authorBy(\Auth::id())->TopicNot($topic->id)->get();
//        dd($myArticles);
        return view('topic',compact('topic','articles','myArticles'));
    }


    // 投稿
    public function submit(Topic $topic)
    {
        // 验证
        $this->validate(request(),[
           'article_ids' => 'required|array'
        ]);


        // 逻辑
        $article_ids = request('article_ids');
        $topic_id = $topic->id;

        foreach ($article_ids as $article_id)
        {
            \App\ArticleTopic::firstOrCreate(compact('topic_id','article_id'));
        }

        return back();
    }
}
