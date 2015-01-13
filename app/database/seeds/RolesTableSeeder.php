<?php

class RolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('roles')->truncate();
        
		\DB::table('roles')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Admin',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Technical Support',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Manager',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'Supervisor',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'Team Leader',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'Agent',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'Sales Representative',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'Dealer',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
		));
	}

}
