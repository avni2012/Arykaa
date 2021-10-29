<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVendorDetail extends Model
{
    use SoftDeletes;
    protected $table = 'product_vendor_details';

    protected $fillable = ['product_id','vendor_id','SKU','price'];

    public function vendors() {
    	return $this->belongsTo(Vendor::class, 'vendor_id','id');
	}

	public function products()
    {
        return $this->belongsToMany('App\Product');
    }
	/*public function products() {
    	return $this->belongsTo('App\Product', 'product_id','id');
	}*/
}
