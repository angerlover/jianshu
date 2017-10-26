<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends BaseModel
{
    // 这个专题的所有文章
    public function articles()
    {
        return $this->belongsToMany(\App\Article::class,'article_topics','topic_id','article_id');

    }

    // 和中间表关联（用于获取文章数）
    public function articleTopics()
    {
        return $this->hasMany(\App\ArticleTopic::class,'topic_id','id');
    }
}
