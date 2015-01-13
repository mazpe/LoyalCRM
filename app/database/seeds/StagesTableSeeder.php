<?php

class StagesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('stages')->truncate();
        
		\DB::table('stages')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Active',
				'description' => 'Active',
				'sorting' => 'A',
				'created_at' => '2014-09-10 17:43:48',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Pending Activation',
				'description' => 'Pending Activation',
				'sorting' => 'B',
				'created_at' => '2014-09-10 17:43:46',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Sold / CIT',
				'description' => 'Sold',
				'sorting' => 'C',
				'created_at' => '2014-09-10 17:43:41',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'Very Hot',
				'description' => 'Will def close this month',
				'sorting' => 'D',
				'created_at' => '2014-09-10 17:43:07',
				'updated_at' => '0000-00-00 00:00:00',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'Hot',
				'description' => 'Will def close by next month',
				'sorting' => 'E',
				'created_at' => '2014-09-10 17:43:57',
				'updated_at' => '0000-00-00 00:00:00',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'Medium',
				'description' => 'Will def close but not sure when',
				'sorting' => 'F',
				'created_at' => '2014-09-10 17:44:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'Cold',
				'description' => 'Don\'t know when if or when it will close',
				'sorting' => 'G',
				'created_at' => '2014-09-10 17:44:03',
				'updated_at' => '0000-00-00 00:00:00',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'Dead',
				'description' => 'Not Interested',
				'sorting' => 'I',
				'created_at' => '2014-09-10 18:22:22',
				'updated_at' => '0000-00-00 00:00:00',
			),
			8 => 
			array (
				'id' => '9',
				'name' => 'Unknown',
				'description' => 'Not contacted Yet',
				'sorting' => 'H',
				'created_at' => '2014-09-10 18:22:24',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
