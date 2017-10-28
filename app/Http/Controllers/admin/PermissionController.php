<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * 权限列表
     */
    public function lst()
    {
        // 取出所有的权限
        $permissions = \App\Permission::all();
        return view('admin.permissionlst',compact('permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 增加权限
     */
    public function add()
    {
        return view('admin.addpermission');
    }

    /**
     * 增加权限的操作
     */
    public function addPost()
    {
        $this->validate(request(),[
           'name' => 'required'
        ]);

        if(\App\Permission::create(request()->all()))
        {
            return redirect('admin/permissionlist');
        }

    }
}
