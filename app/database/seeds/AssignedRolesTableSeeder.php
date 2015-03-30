<?php

class AssignedRolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('assigned_roles')->truncate();
        
		\DB::table('assigned_roles')->insert(array (
			0 => 
			array (
				'id' => '1',
				'user_id' => '1',
				'role_id' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			1 => 
			array (
				'id' => '2',
				'user_id' => '1',
				'role_id' => '2',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			2 => 
			array (
				'id' => '3',
				'user_id' => '1',
				'role_id' => '3',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			3 => 
			array (
				'id' => '4',
				'user_id' => '1',
				'role_id' => '4',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			4 => 
			array (
				'id' => '5',
				'user_id' => '1',
				'role_id' => '5',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			5 => 
			array (
				'id' => '6',
				'user_id' => '2',
				'role_id' => '1',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			6 => 
			array (
				'id' => '7',
				'user_id' => '2',
				'role_id' => '2',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			7 => 
			array (
				'id' => '8',
				'user_id' => '2',
				'role_id' => '3',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			8 => 
			array (
				'id' => '9',
				'user_id' => '2',
				'role_id' => '4',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			9 => 
			array (
				'id' => '10',
				'user_id' => '2',
				'role_id' => '5',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			10 => 
			array (
				'id' => '16',
				'user_id' => '4',
				'role_id' => '3',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			11 => 
			array (
				'id' => '17',
				'user_id' => '4',
				'role_id' => '6',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			12 => 
			array (
				'id' => '18',
				'user_id' => '5',
				'role_id' => '6',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			13 => 
			array (
				'id' => '20',
				'user_id' => '7',
				'role_id' => '8',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			14 => 
			array (
				'id' => '21',
				'user_id' => '8',
				'role_id' => '8',
				'created_at' => '2014-07-18 05:55:06',
				'updated_at' => '2014-07-18 05:55:06',
			),
			15 => 
			array (
				'id' => '22',
				'user_id' => '6',
				'role_id' => '6',
				'created_at' => '2014-07-19 09:33:23',
				'updated_at' => '2014-07-19 09:33:23',
			),
			16 => 
			array (
				'id' => '23',
				'user_id' => '9',
				'role_id' => '8',
				'created_at' => '2014-07-19 09:45:35',
				'updated_at' => '2014-07-19 09:45:35',
			),
			17 => 
			array (
				'id' => '24',
				'user_id' => '10',
				'role_id' => '6',
				'created_at' => '2014-08-07 10:11:42',
				'updated_at' => '2014-08-07 10:11:42',
			),
			18 => 
			array (
				'id' => '25',
				'user_id' => '11',
				'role_id' => '6',
				'created_at' => '2014-08-07 10:30:12',
				'updated_at' => '2014-08-07 10:30:12',
			),
			19 => 
			array (
				'id' => '26',
				'user_id' => '14',
				'role_id' => '8',
				'created_at' => '2014-08-14 05:36:21',
				'updated_at' => '2014-08-14 05:36:21',
			),
			20 => 
			array (
				'id' => '28',
				'user_id' => '15',
				'role_id' => '6',
				'created_at' => '2014-09-08 18:38:06',
				'updated_at' => '2014-09-08 18:38:06',
			),
			21 => 
			array (
				'id' => '29',
				'user_id' => '16',
				'role_id' => '6',
				'created_at' => '2014-09-08 23:23:33',
				'updated_at' => '2014-09-08 23:23:33',
			),
			22 => 
			array (
				'id' => '30',
				'user_id' => '3',
				'role_id' => '6',
				'created_at' => '2014-09-10 15:43:05',
				'updated_at' => '2014-09-10 15:43:05',
			),
			23 => 
			array (
				'id' => '32',
				'user_id' => '18',
				'role_id' => '6',
				'created_at' => '2014-09-17 12:38:55',
				'updated_at' => '2014-09-17 12:38:55',
			),
			24 => 
			array (
				'id' => '33',
				'user_id' => '19',
				'role_id' => '1',
				'created_at' => '2014-10-25 18:55:53',
				'updated_at' => '2014-10-25 18:55:53',
			),
			25 => 
			array (
				'id' => '35',
				'user_id' => '20',
				'role_id' => '6',
				'created_at' => '2014-10-29 10:50:29',
				'updated_at' => '2014-10-29 10:50:29',
			),
			26 => 
			array (
				'id' => '36',
				'user_id' => '22',
				'role_id' => '6',
				'created_at' => '2014-11-11 20:53:05',
				'updated_at' => '2014-11-11 20:53:05',
			),
			27 => 
			array (
				'id' => '37',
				'user_id' => '23',
				'role_id' => '6',
				'created_at' => '2014-11-11 20:58:10',
				'updated_at' => '2014-11-11 20:58:10',
			),
			28 => 
			array (
				'id' => '38',
				'user_id' => '21',
				'role_id' => '6',
				'created_at' => '2014-11-18 19:38:56',
				'updated_at' => '2014-11-18 19:38:56',
			),
			29 => 
			array (
				'id' => '39',
				'user_id' => '24',
				'role_id' => '6',
				'created_at' => '2015-01-10 08:26:57',
				'updated_at' => '2015-01-10 08:26:57',
			),
		));
	}

}
