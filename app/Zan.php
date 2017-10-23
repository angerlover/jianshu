<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends BaseModel
{
    // 模型关联
    public function user()
    {
        // 赞vs用户 多对一
        return $this->belongsTo('App\User');
    }

    public function article()
    {
        // 赞vs文章  多对一
        return $this->belongsTo('App\Article');
    }
}
