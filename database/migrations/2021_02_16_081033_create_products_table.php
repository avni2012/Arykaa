<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('rel_id')->nullable();
                $table->string('product_name')->nullable();
                $table->string('chahat_catlog_no')->nullable();
                $table->string('chahat_design_no')->nullable();
                $table->float('purchase_price', 8, 2)->nullable();
                $table->float('our_price', 8, 2)->nullable();
                $table->string('product_type')->nullable();
                $table->string('fabric')->nullable();
                $table->string('ucode')->nullable();
                $table->string('ncode')->nullable();
                $table->string('color')->nullable();
                $table->integer('total_stock')->nullable();
                $table->integer('available_stock')->nullable();
                $table->string('image1')->nullable();
                $table->string('image2')->nullable();
                $table->date('date')->nullable();
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
        Schema::dropIfExists('products');
    }
}
