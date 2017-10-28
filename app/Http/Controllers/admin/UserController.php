<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminUser;

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

    /**
     * 当前管理员所属角色列表
     */
    public function rolelist(AdminUser $admin)
    {
        // 所有的角色列表
        $allRoles = \App\Role::all();
        $myRoles = $admin->roles;
        return view('admin.user-role',compact('allRoles','myRoles','admin'));
    }

    /**
     * @param Admin $admin
     * 修改管理员的角色
     */
    public function editRole(AdminUser $admin)
    {

        $myRoles = $admin->roles;
        // 如果是空的则删除所有模型
        if(empty(request('roles')))
        {
            foreach($myRoles as $role)
            {
                $admin->removeRole($role);
            }

            return redirect('admin/adminlist');
        }
        // 寻找模型
        $roles = \App\Role::findMany(request('roles'));
//        dd($myRoles);
        // 要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach($deleteRoles as $role)
        {
            $admin->removeRole($role);
        }

        // 要增加的
        $addRoles = $roles->diff($myRoles);
        foreach($addRoles as $role)
        {
            $admin->assignRole($role);
        }

        return redirect('admin/adminlist');
    }
}
