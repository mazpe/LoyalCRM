<?php

class MonthsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('months')->truncate();
        
		\DB::table('months')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'January 31',
				'number' => '1',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'February 28',
				'number' => '2',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'March 31',
				'number' => '3',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'April 30',
				'number' => '4',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'May 31',
				'number' => '5',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'June 30',
				'number' => '6',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'July 31',
				'number' => '7',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'August 30',
				'number' => '8',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			8 => 
			array (
				'id' => '9',
				'name' => 'September 30',
				'number' => '9',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			9 => 
			array (
				'id' => '10',
				'name' => 'October 31',
				'number' => '10',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			10 => 
			array (
				'id' => '11',
				'name' => 'November 30',
				'number' => '11',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			11 => 
			array (
				'id' => '12',
				'name' => 'December 31',
				'number' => '12',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
		));
	}

}
