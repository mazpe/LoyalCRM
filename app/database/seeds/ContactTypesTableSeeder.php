<?php

class ContactTypesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('contact_types')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Call',
				'created_at' => '2014-09-08 09:27:44',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Email',
				'created_at' => '2014-09-08 09:27:49',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Visit',
				'created_at' => '2014-09-08 09:27:54',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => '5',
				'name' => 'Text',
				'created_at' => '2014-09-10 13:54:07',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
