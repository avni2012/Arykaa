<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAdditionalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('role_additional_fields')){
            Schema::create('role_additional_fields', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('role_id')->nullable()->unsigned()->comment('foreign key roles');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->enum('rel_id', ['0','1']);
                $table->enum('product_name', ['0','1']);
                $table->enum('chahat_catlog_no', ['0','1']);
                $table->enum('chahat_design_no', ['0','1']);
                $table->enum('purchase_price', ['0','1']);
                $table->enum('our_price', ['0','1']);
                $table->enum('product_type', ['0','1']);
                $table->enum('fabric', ['0','1']);
                $table->enum('ucode', ['0','1']);
                $table->enum('ncode', ['0','1']);
                $table->enum('color', ['0','1']);
                $table->enum('total_stock', ['0','1']);
                $table->enum('available_stock', ['0','1']);
                $table->enum('image1', ['0','1']);
                $table->enum('image2', ['0','1']);
                $table->enum('date', ['0','1']);
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
        Schema::dropIfExists('role_additional_fields');
    }
}
