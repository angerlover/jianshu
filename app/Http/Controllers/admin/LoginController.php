<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 登录页面
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 登录行为
     */
    public function login()
    {
        // 和前台一样的需要验证
        $this->validate(request(),[
           'name' => 'required|min:3',
            'password' => 'required|min:3'
        ]);

        $data = request(['name','password']);

        if(\Auth::guard('admin')->attempt($data))
        {
            return redirect('admin/index');
        }

        return back()->withErrors('不对！');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 注销
     */
    public function logout()
    {
        if(\Auth::guard('admin')->logout());
        {
            return redirect('/admin/login');

        }
    }


}
