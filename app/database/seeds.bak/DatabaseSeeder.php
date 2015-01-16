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

        //$this->call('UsersTableSeeder');
        //$this->call('RolesTableSeeder');
        //$this->call('ManufacturesTableSeeder');
        //$this->call('DealerGroupsTableSeeder');
        //$this->call('DealersTableSeeder');
        //$this->call('CampaignsTableSeeder');
        //$this->call('Deals2TableSeeder');
        //$this->call('DispositionsTableSeeder');
        $this->call('RO2TableSeeder');
        //$this->call('UserDealerTableSeeder');
        //$this->call('AssignedRolesTableSeeder');
        //$this->call('MonthsTableSeeder');
	}

}

