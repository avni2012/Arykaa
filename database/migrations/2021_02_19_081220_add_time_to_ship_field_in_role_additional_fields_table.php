<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeToShipFieldInRoleAdditionalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_additional_fields', function (Blueprint $table) {
            $table->enum('time_to_ship', ['0','1'])->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_additional_fields', function (Blueprint $table) {
            $table->dropColumn('time_to_ship');
        });
    }
}
