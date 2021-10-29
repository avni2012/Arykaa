<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = ['rel_id','product_name','chahat_catlog_no','chahat_design_no','purchase_price','our_price','product_type','fabric','ucode','ncode','color','total_stock','available_stock','image1','image2','date'];

    public function AdditionalRole() {
      return $this->belongsTo('App\AdditionalRole');
	}

	public function product_vendor_details() {
        return $this->hasMany('App\Models\ProductVendorDetail');   
    }
}
