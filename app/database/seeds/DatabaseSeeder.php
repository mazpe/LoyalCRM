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
		$this->call('AppointmentsTableSeeder');
		$this->call('AssignedRolesTableSeeder');
		$this->call('CallRecordsTableSeeder');
		$this->call('CampaignsTableSeeder');
		$this->call('ContactTypesTableSeeder');
		$this->call('DealersTableSeeder');
		$this->call('DealerGroupsTableSeeder');
		$this->call('DispositionsTableSeeder');
		$this->call('ManufacturesTableSeeder');
		$this->call('MonthsTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('PermissionRoleTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('StagesTableSeeder');
		$this->call('TokenTableSeeder');
		$this->call('UsersTableSeeder');
	}

}

