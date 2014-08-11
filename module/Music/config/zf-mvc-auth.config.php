<?php
return [
	'zf-mvc-auth' => [
		'authorization' => [
			'Music\\V1\\Rest\\Artist\\Controller' => [
				'entity' => [
					'GET' => true,
					'POST' => false,
					'PATCH' => true,
					'PUT' => true,
					'DELETE' => true,
				],
				'collection' => [
					'GET' => false,
					'POST' => true,
					'PATCH' => false,
					'PUT' => false,
					'DELETE' => false,
				],
			],
			'Music\\V1\\Rest\\Album\\Controller' => [
				'entity' => [
					'GET' => true,
					'POST' => false,
					'PATCH' => true,
					'PUT' => true,
					'DELETE' => true,
				],
				'collection' => array(
					'GET' => false,
					'POST' => true,
					'PATCH' => false,
					'PUT' => false,
					'DELETE' => false,
				),
			],
		],
	],
];