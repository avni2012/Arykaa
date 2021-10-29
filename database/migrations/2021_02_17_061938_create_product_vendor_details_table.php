<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product_vendor_details')){
            Schema::create('product_vendor_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->biginteger('product_id')->nullable()->unsigned()->comment('foreign key products');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->integer('vendor_id')->nullable()->unsigned()->comment('foreign key vendors');
                $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
                $table->string('SKU')->nullable();
                $table->float('price', 8, 2)->nullable();
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_vendor_details');
    }
}
