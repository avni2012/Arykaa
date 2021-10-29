<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalRole extends Model
{
    use SoftDeletes;
    protected $table = 'role_additional_fields';

    protected $fillable = ['rel_id','product_name','chahat_catlog_no','chahat_design_no','purchase_price','our_price','product_type','fabric','ucode','ncode','color','total_stock','available_stock','image1','image2','date'];
    // protected $hidden = ['product_name'];

    public function role()
    {
    	return $this->hasOne('App\Role','id','role_id')->where('name','!=','super_admin');
    }
}
