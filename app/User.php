<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    /******模型关联*******/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 所有的文章
     */
    public function articles()
    {
        return $this->hasMany('\App\Article','user_id','id');
    }

    // 当前用户的所有粉丝
    public function fans()
    {
        return $this->hasMany('App\Fan','star_id','id');
    }


    // 当前用户所有的关注人
    public function stars()
    {
        return $this->hasMany('App\Fan','fan_id','id');
    }
    // 当前用户的通知
    public function notices()
    {
        return $this->belongsToMany('App\Notice','user_notices','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }

    // 增加一条通知
    public function addNotice(Notice $notice)
    {
        return $this->notices()->save($notice);
    }

    /**
     * @param $user_id
     * 关注操作
     */
    public function doFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->save($fan);
    }
    /**
     * @param $user_id
     * 取关操作
     */
    public function unDoFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->delete($fan);
    }

    /**
     * @param $user_id
     * 是否被某个用户关注了
     */
    public function hasFun($user_id)
    {
        return $this->funs()->where('fan_id',$user_id)->count();
    }
    /**
     * @param $user_id
     * 是否关注了某个用户
     */
    public function hasStar($user_id)
    {
        return $this->stars()->where('star_id',$user_id)->count();
    }
}
