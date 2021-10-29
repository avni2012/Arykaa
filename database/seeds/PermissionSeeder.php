<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		DB::beginTransaction();

		$superadmin = Role::where('name', '=', 'super_admin')->first();
		// $shrek = User::where('name','=','Job Boosts Admin')->first();
		//dd($shrek->hasRole('supper_admin'));

		// if (!$shrek->hasRole('super_admin'))
		// {
		//     $shrek->attachRole( $superadmin->id );
		// }

		$this->command->info('Admin user seeded :-)');

		$module_name = ['Role', 'User', 'Cms', 'Faq', 'EmailTemplate', 'Setting', 'HomepageSlider', 'ContactUs', 'Coach', 'Staff'];
		foreach ($module_name as $item) {
			if ($item == 'EmailTemplate') {
				$permistion_list = ['Edit', 'List'];
			} else if ($item == 'Setting') {
				$permistion_list = ['Edit', 'List', 'Delete'];
			} else if ($item == 'ContactUs') {
				$permistion_list = ['List', 'Delete'];
			} else if ($item == 'Coach') {
				$permistion_list = ['Create', 'Edit', 'Delete', 'List', 'Manage'];
			} else {
				$permistion_list = ['Create', 'Edit', 'Delete', 'List'];
			}
			//$permistion_list = ['Create','Edit','Delete','List'];
		}

		for ($i = 0; $i < count($module_name); $i++) {
			for ($j = 0; $j < count($permistion_list); $j++) {
				if ($module_name[$i] == 'Coach' && $permistion_list[$j] == 'Manage') {
					$existing_perm = Permission::where('name', strtolower($permistion_list[$j]) . '-' . strtolower($module_name[$i]) . '-availability')->exists();
				} else {
					$existing_perm = Permission::where('name', strtolower($permistion_list[$j]) . '-' . strtolower($module_name[$i]))->exists();
				}

				//dd(strtolower($permistion_list[$j]).'-'.strtolower($module_name[$i]), $existing_perm);
				if (!$existing_perm) {
					$createRole = new Permission();
					if ($module_name[$i] == 'Coach' && $permistion_list[$j] == 'Manage') {
						$createRole->name = strtolower($permistion_list[$j]) . '-' . strtolower($module_name[$i]) . '-availability';
						$createRole->display_name = $permistion_list[$j] . ' ' . $module_name[$i] . ' availability';
						$createRole->description = 'Can ' . $permistion_list[$j] . ' ' . strtolower($module_name[$i]) . ' availability';
					} else {
						$createRole->name = strtolower($permistion_list[$j]) . '-' . strtolower($module_name[$i]);
						$createRole->display_name = $permistion_list[$j] . ' ' . $module_name[$i];
						$createRole->description = 'Can ' . $permistion_list[$j] . ' ' . strtolower($module_name[$i]);
					}
					$createRole->module_name = $module_name[$i];
					$createRole->save();

					$superadmin->attachPermission($createRole);
				}
			}
		}
		DB::commit();

	}
}
