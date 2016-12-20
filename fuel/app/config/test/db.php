<?php
/**
 * The test database settings. These get merged with the global settings.
 *
 * This environment is primarily used by unit tests, to run on a controlled environment.
 */

return array(
	'default' => array(
		'connection'  => array(
		    'hostname'   => 'localhost',
		    'port'       => '3306',
			'database'   => 'test_service',
			'username'   => 'oyama',
			'password'   => 'pass',
		),
	),
);
