<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    'default' => array(
        'type'        => 'pdo',
        'connection'  => array(
            'dsn'        => 'mysql:host=localhost;dbname=test_service',
//            'hostname'   => 'localhost',
//            'port'       => '3306',
//            'database'   => 'test_service',
            'username'   => 'oyama',
            'password'   => 'pass',
            'persistent' => false,
            'compress'   => false,
        ),
        'identifier'   => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => false,
    ),

);