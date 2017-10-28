<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{
    /**
     * 角色列表
     */
    public function rolelist()
    {
        $allRoles = \App\Role::all();
        return view('admin.rolelist',compact('allRoles'));
    }

    /**
     * 增加角色
     */
    public function addRole()
    {
        return view('admin.addrole');
    }

    /**
     * 增加角色的实现
     */
    public function storeRole()
    {
        // 验证
        $this->validate(request(),[
           'name' => 'required'
        ]);

        // 存储
        if(\App\Role::create(request()->all()))
        {
            return redirect('admin/rolelist');
        }
    }

    /**
     * @param Role $role
     * 角色对应的权限列表
     */
    public function permissions(Role $role)
    {
        // 全部的权限
        $allPermissions = \App\Permission::all();

        // 当前角色的权限
        $myPermissions = $role->permissions();
        return view('admin.role_permission',compact('allPermissions','myPermissions','role'));
    }

    /**
     *  处理提交的权限修改
     */
    public function editPermissions(Role $role)
    {

        // 当前角色的权限
        $myPermissions = $role->permissions;
        // 如果是空的则删除全部权限
        if(empty(request('permissions')))
        {
            foreach ($myPermissions as $permission)
            {
                $role->removePermission($permission);
            }

            return redirect('admin/rolelist');
        }
        // 获取对应的模型 Collection对象
        $permissions = \App\Permission::findMany(request('permissions'));
//        dd($myPermissions);
        // 要删除的权限
            $deletedPermissions = $myPermissions->diff($permissions);
            foreach($deletedPermissions as $permission)
            {
                $role->removePermission($permission);
            }

            // 要增加的权限
            $addPermissions = $permissions->diff($myPermissions);
            foreach($addPermissions as $permission)
            {
                $role->grantPermission($permission);
            }


        return redirect('/admin/rolelist');

    }
}
