<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [];
    /*******************模型关联**********************/

    /**
     * @return $this
     * 角色有哪些权限
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Permission::class,'role_permissions','role_id','permission_id')->withPivot(['role_id','permission_id']);
    }

    /**
     * @param $permission
     * @return bool
     * 给角色赋予权限
     */
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * @param $permission
     * @return mixed
     * 取消角色的权限
     */
    public function removePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * @param $permission
     * @return bool
     * 判断角色是否有权限
     */
    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission);
    }
}
