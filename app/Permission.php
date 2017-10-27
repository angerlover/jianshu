<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';


    /*****************模型关联********************/
    /**
     * 角色有哪些权限
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class,'role_permissions','permission_id','role_id')->withPivot(['role_id','permission_id']);
    }
}
