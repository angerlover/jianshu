<?php

namespace App;

use App\BaseModel;
use Laravel\Scout\Searchable;

class Article extends BaseModel
{
    use Searchable;
    // 模型关联
    function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    function zan($user_id)
    {
        return $this->hasOne('\App\Zan')->where('user_id',$user_id);
    }

    function zans()
    {
        return $this->hasMany('App\Zan');
    }


    // 定义索引里面的type
    public function searchableAs()
    {
        return 'article';
    }
    // 定义哪些字段需要返回
    public function toSearchableArray()
    {
        return [
          'title'=>$this->title,
            'content'=>$this->content
        ];
    }
}
