<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 个人设置页面
    public function index()
    {

    }
    // 个人设置提交
    public function settings()
    {

    }

    // 个人中心
    public function center(User $user)
    {

        // 当前的user并没有文章数和粉丝数等信息
        $user = User::withCount(['stars','articles','fans'])->find($user->id);
        // 文章
        $articles = $user->articles()->orderBy('created_at','desc')->take(10)->get();

        // 当前用户的粉丝（包含粉丝的文章数，粉丝数等）
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','articles','fans'])->get();

        // 当前用户的关注（包括关注的文章数，粉丝数等）
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','articles','fans'])->get();
        return view('center',compact('user','articles','fusers','susers'));
    }

    /**
     * @param User $user
     * （当前用户）关注一个用户
     */
    public function fan(User $user)
    {
        // 当前用户
        $me = \Auth::user();
        $me->doFan($user->id);

        // ajax操作所以返回json吧
        return [
          'error'=>0,
            'msg' =>'关注'.$user->name.'成功',
        ];

    }

    /**
     * @param User $user
     * 取关一个用户
     */
    public function unfan(User $user)
    {
        // 当前用户
        $me = \Auth::user();
        $me->unDoFan($user->id);

        // ajax操作所以返回json吧
        return [
            'error'=>0,
            'msg' =>'取消关注'.$user->name.'成功',
        ];

    }
}
