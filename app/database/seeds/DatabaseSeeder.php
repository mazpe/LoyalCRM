<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        Eloquent::unguard();
		$this->call('MonthsTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('ManufacturesTableSeeder');
		$this->call('ContactTypesTableSeeder');
		$this->call('CampaignsTableSeeder');
		$this->call('StagesTableSeeder');
		$this->call('AppointmentsTableSeeder');
		$this->call('AssignedRolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('DealerGroupsTableSeeder');
		$this->call('DealersTableSeeder');
		$this->call('DispositionsTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('PermissionRoleTableSeeder');
		$this->call('TokenTableSeeder');
		$this->call('CallRecordsTableSeeder');
	}

}

