<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'hostname' => 'localhost',
			'port'     => '3306',
			'database' => 'test_service',
			'username' => 'oyama',
			'password' => 'pass',
		),
        'profiling' => true,
	),
);
