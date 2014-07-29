<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=music;host=127.0.0.1',
		'username' => 'root',
		'hostname' => '127.0.0.1',
	),
    'service_manager' => array(
        'factories' => array(
            'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'http' => array(
                'accept_schemes' => array(
                    0 => 'basic',
                ),
                'realm' => 'api',
            ),
        ),
    ),
);
