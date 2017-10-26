<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 管理员列表页面
     */
    public function lst()
    {
        $admins = \App\AdminUser::all();

        return view('admin.adminlist',compact('admins'));
    }

    /**
     * 添加管理员页面
     */
    public function add()
    {
        return view('admin.adminadd');
    }

    /**
     * 添加操作
     */
    public function store()
    {
        // 验证
        $this->validate(request(),[
           'name' => 'required',
            'password' => 'required|min:3'
        ]);


        $data = request()->all();
        $data['password'] = bcrypt($data['password']);

        if(\App\AdminUser::create($data))
        {
            return redirect('admin/adminlist');
        }

        return back();
    }
}