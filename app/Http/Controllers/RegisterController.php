<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    // 注册页面
    public function index()
    {
        return view('register.register');
    }

    // 注册提交
    public function register(Request $request)
    {
        // 验证
        $this->validate($request,[
            'name' => 'required|min:3|max:15|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|confirmed'
        ]);
        // 密码加密
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
//        dd($request->all());
        User::create($data);

        return redirect('/login');
    }



}

