<?php

class CampaignsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('campaigns')->truncate();
        
		\DB::table('campaigns')->insert(array (
			0 => 
			array (
				'id' => '1',
				'dealer_id' => '1',
				'name' => '5k Campaign',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			1 => 
			array (
				'id' => '2',
				'dealer_id' => '1',
				'name' => '10k Campaign',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-19 05:23:28',
			),
			2 => 
			array (
				'id' => '3',
				'dealer_id' => '1',
				'name' => '20k Campaign',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-19 05:23:18',
			),
		));
	}

}
