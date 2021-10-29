<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert(array(
	     	array(
	       		'name' => 'Chahat'
	     	),
	     	array(
	       		'name' => 'Arykaa'
	     	),
	     	array(
	       		'name' => 'IndiAttire'
	     	),
	     	array(
	       		'name' => 'Myramisty'
	     	),
	     	array(
	       		'name' => 'Maahi Styles'
	     	),
	     	array(
	       		'name' => 'View Only'
	     	),
	   ));
    }
}
