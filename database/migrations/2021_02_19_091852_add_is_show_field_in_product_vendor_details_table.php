<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsShowFieldInProductVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_vendor_details', function (Blueprint $table) {
            $table->boolean('is_show')->default(0)->after('price')->comment('0-Hide,1-Show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_vendor_details', function (Blueprint $table) {
            $table->dropColumn('is_show');
        });
    }
}
