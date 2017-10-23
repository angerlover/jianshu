<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 登录页面
    public function index()
    {
        if(!Auth::check())
        {
            return view('login.login');
        }
        else
        {
            return redirect('/articles');
        }
    }

    // 登录提交
    public function login(Request $request)
    {
        //验证
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $data = request(['email','password']);
        $remember = boolval(request('is_remember'));
        if(Auth::attempt($data,$remember))
        {
            // 登陆成功
            return redirect('/articles');
        }
        else
        {
            return \Redirect::back()->withError('用户名或密码错误');
        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/articles');
    }
}
