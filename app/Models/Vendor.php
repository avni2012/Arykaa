<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;
    protected $table = 'vendors';

    protected $fillable = ['name'];

    public function product_vendor_details()
    {
        return $this->hasMany('App\Models\ProductVendorDetail','vendor_id','id');
    }
}
