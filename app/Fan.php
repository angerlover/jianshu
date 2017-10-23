<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends BaseModel
{
    // 模型关联

    public function fuser()
    {
        return $this->hasOne('\App\User','id','fan_id');
    }

    public function suser()
    {
        return $this->hasOne('App\User','id','star_id');
    }
}
