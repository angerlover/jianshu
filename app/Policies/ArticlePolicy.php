<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 授权控制
    public function update(User $user,Article $article)
    {
        return $article->user_id == $user->id;
    }
    // 授权控制
    public function delete(User $user,Article $article)
    {
        return $article->user_id == $user->id;
    }
}
