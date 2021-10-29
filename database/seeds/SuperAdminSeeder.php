<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\HasRole;
use App\Role;
use App\User;


class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'vendor_id' => '2',
            //'mobile_no'=>1234567890,
            //'status'=>1,
            'email_verified_at'=>now(),
            'password' => Hash::make('superadmin@123'),
        ]);

        $admin = new Role();
        $admin->name         = 'super_admin';
        $admin->display_name = 'Super Admin';
        $admin->description  = 'The highest level of admin-ness';
        $admin->save();
        DB::commit();

    }

}
