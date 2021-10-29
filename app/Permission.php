<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = "permissions";

    public function PermissionData()
    {
    	return $this->hasMany('App\Permission','module_name','module_name');
    }

 	public function IsActive()
 	{
 		return $this->belongsTo('App\PermissionRole','id','permission_id');
 	}

 	public function restore()
    {
        $this->restoreA();
    }
}
