<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = '';
    protected $guarded = [];


    /**
     * 用户和角色的关联
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class,'admin_roles','admin_id','role_id')->withPivot(['role_id','admin_id']);
    }

    /**
     * @param $roles
     * 判断一个用户是否属于某些角色
     */
    public function isInRole($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    /**
     * @param $role
     * @return \Illuminate\Database\Eloquent\Model
     * 分配新角色
     */
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    /**
     * @param $role
     * @return int
     * 取消角色
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * @param $permission
     * 用户是否有某个权限
     */
    public function hasPermission($permission)
    {
        return $this->isInRole($permission->roles);
    }

}
