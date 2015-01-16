<?php

return array(

	'fetch' => PDO::FETCH_CLASS,

	'default' => 'mysql',

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'loyaldriver_crm_devel',
			'username'  => 'root',
			'password'  => 'gbRND2008',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),

);
