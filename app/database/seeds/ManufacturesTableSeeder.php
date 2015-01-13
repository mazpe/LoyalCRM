<?php

class ManufacturesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('manufactures')->truncate();
        
		\DB::table('manufactures')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Toyota',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Chevrolet',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Mercedes-Benz',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-07-18 05:54:56',
				'updated_at' => '2014-07-18 05:54:56',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'Kia',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-06 10:25:51',
				'updated_at' => '2014-09-06 10:26:47',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'Independent',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-08 15:26:18',
				'updated_at' => '2014-09-08 15:26:18',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'Fiat',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-08 18:10:12',
				'updated_at' => '2014-09-08 18:10:12',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'Ford',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-08 18:10:27',
				'updated_at' => '2014-09-08 18:10:27',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'BMW',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-08 18:10:41',
				'updated_at' => '2014-09-08 18:10:41',
			),
			8 => 
			array (
				'id' => '9',
				'name' => 'Nissan',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-08 19:11:52',
				'updated_at' => '2014-09-08 19:11:52',
			),
			9 => 
			array (
				'id' => '10',
				'name' => 'Hyundai',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 11:50:53',
				'updated_at' => '2014-09-09 11:50:53',
			),
			10 => 
			array (
				'id' => '11',
				'name' => 'Volvo',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 11:51:02',
				'updated_at' => '2014-09-09 11:51:02',
			),
			11 => 
			array (
				'id' => '12',
				'name' => 'Buick',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 11:51:16',
				'updated_at' => '2014-09-09 11:51:16',
			),
			12 => 
			array (
				'id' => '13',
				'name' => 'GMC',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 11:51:24',
				'updated_at' => '2014-09-09 11:51:24',
			),
			13 => 
			array (
				'id' => '14',
				'name' => 'Chrysler',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 11:51:34',
				'updated_at' => '2014-09-09 11:51:34',
			),
			14 => 
			array (
				'id' => '15',
				'name' => 'VW',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 12:02:25',
				'updated_at' => '2014-09-09 12:02:25',
			),
			15 => 
			array (
				'id' => '16',
				'name' => 'Cadillac',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 12:09:04',
				'updated_at' => '2014-09-09 12:09:04',
			),
			16 => 
			array (
				'id' => '17',
				'name' => 'Dodge',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 12:12:25',
				'updated_at' => '2014-09-09 12:12:25',
			),
			17 => 
			array (
				'id' => '18',
				'name' => 'Mazda',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 21:27:22',
				'updated_at' => '2014-09-09 21:27:22',
			),
			18 => 
			array (
				'id' => '19',
				'name' => 'Mitsubishi',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-09 21:28:04',
				'updated_at' => '2014-09-09 21:28:04',
			),
			19 => 
			array (
				'id' => '20',
				'name' => 'Honda',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-10 00:15:07',
				'updated_at' => '2014-09-10 00:15:07',
			),
			20 => 
			array (
				'id' => '21',
				'name' => 'Suzuki',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-12 17:35:19',
				'updated_at' => '2014-09-12 17:35:19',
			),
			21 => 
			array (
				'id' => '22',
				'name' => 'Subaru',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-12 17:37:32',
				'updated_at' => '2014-09-12 17:37:32',
			),
			22 => 
			array (
				'id' => '23',
				'name' => 'Ferrari',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-12 18:51:08',
				'updated_at' => '2014-09-12 18:51:08',
			),
			23 => 
			array (
				'id' => '24',
				'name' => 'Lexus',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-09-12 18:51:26',
				'updated_at' => '2014-09-12 18:51:26',
			),
			24 => 
			array (
				'id' => '25',
				'name' => 'Infiniti
',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			25 => 
			array (
				'id' => '26',
				'name' => 'Porsche',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			26 => 
			array (
				'id' => '27',
				'name' => 'Acura',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			27 => 
			array (
				'id' => '28',
				'name' => 'Bentley',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			28 => 
			array (
				'id' => '29',
				'name' => 'Land Rover',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			29 => 
			array (
				'id' => '30',
				'name' => 'Audi',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			30 => 
			array (
				'id' => '31',
				'name' => 'Jeep',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			31 => 
			array (
				'id' => '33',
				'name' => 'Scion',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:04:37',
				'updated_at' => '2014-10-13 10:04:37',
			),
			32 => 
			array (
				'id' => '34',
				'name' => 'MINI',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:04:50',
				'updated_at' => '2014-10-13 10:04:50',
			),
			33 => 
			array (
				'id' => '35',
				'name' => 'Jaguar',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:08:26',
				'updated_at' => '2014-10-13 10:08:26',
			),
			34 => 
			array (
				'id' => '36',
				'name' => 'Infiniti',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:08:41',
				'updated_at' => '2014-10-13 10:08:41',
			),
			35 => 
			array (
				'id' => '37',
				'name' => 'Aston Martin',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:13:30',
				'updated_at' => '2014-10-13 10:13:30',
			),
			36 => 
			array (
				'id' => '38',
				'name' => 'Volkswagen',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:14:54',
				'updated_at' => '2014-10-13 10:14:54',
			),
			37 => 
			array (
				'id' => '39',
				'name' => 'Lincoln',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:15:45',
				'updated_at' => '2014-10-13 10:15:45',
			),
			38 => 
			array (
				'id' => '41',
				'name' => 'GM',
				'added_by_id' => '1',
				'active' => '1',
				'created_at' => '2014-10-13 10:25:42',
				'updated_at' => '2014-10-13 10:25:42',
			),
		));
	}

}
