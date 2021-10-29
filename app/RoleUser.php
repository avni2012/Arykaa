<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RoleUser extends Model
{	

    protected $table="role_user";
    public $timestamps = false;


    public function role()
    {
    	return $this->hasOne('App\Role','id','role_id')->where('name','!=','super_admin');
    }

  
}
