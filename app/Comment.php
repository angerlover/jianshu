<?php

namespace App;



class Comment extends BaseModel
{
    // 模型关联
    function article()
    {
        return $this->belongsTo('App\Article','article_id','id');
    }


    function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
