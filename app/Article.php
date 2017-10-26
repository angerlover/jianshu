<?php

namespace App;

use App\BaseModel;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 文章和专题的关联
     */
    function articleTopics()
    {
        return $this->hasMany(\App\ArticleTopic::class,'article_id','id');
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

    /**
     * @param Builder $query
     * @param $user_id
     * @return $this
     * 利用scope实现某个作者的文章
     */
    public function scopeAuthorBy(Builder $query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }

    /**
     * @param Builder $query
     * @param $topic_id
     * @return Builder|static
     * 不属于某个话题的文章
     */
    public function scopeTopicNot(Builder $query,$topic_id)
    {
        return $query->doesntHave('articleTopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }

    /**
     * 重写全局scope 获取状态为0或1的文章（除了不通过之外）
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('available',function(Builder $builder)
        {
           $builder->whereIn('status',[0,1]);
        });
    }
}
