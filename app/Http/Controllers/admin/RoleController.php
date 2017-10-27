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
        return view('admin.rolelist');
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

    }

    /**
     * @param Role $role
     * 角色对应的权限列表
     */
    public function permissions(Role $role)
    {
        return view('admin.role_permission');
    }
}
