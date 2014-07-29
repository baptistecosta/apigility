<?php
return [
	'router' => [
		'routes' => [
			'music.rest.artist' => [
				'type' => 'Segment',
				'options' => [
					'route' => '/artist[/:artist_id]',
					'defaults' => [
						'controller' => 'Music\\V1\\Rest\\Artist\\Controller',
					],
				],
			],
			'music.rest.artist-albums' => [
				'type' => 'Segment',
				'options' => [
					'route' => '/artist/:artist_id/albums',
					'defaults' => [
						'controller' => 'Music\\V1\\Rest\\Album\\Controller',
					],
				],
			],
			'music.rest.album' => [
				'type' => 'Segment',
				'options' => [
					'route' => '/album[/:album_id]',
					'defaults' => [
						'controller' => 'Music\\V1\\Rest\\Album\\Controller',
					],
				],
			],
		],
	],
	'zf-rest' => array(
		'Music\\V1\\Rest\\Album\\Controller' => array(
			'listener' => 'Music\\V1\\Rest\\Album\\AlbumResource',
			'route_name' => 'music.rest.album',
			'route_identifier_name' => 'album_id',
			'collection_name' => 'album',
			'entity_http_methods' => array(
				0 => 'GET',
				1 => 'PATCH',
				2 => 'PUT',
				3 => 'DELETE',
			),
			'collection_http_methods' => array(
				0 => 'GET',
				1 => 'POST',
			),
			'collection_query_whitelist' => [
				'artist_id'
			],
			'page_size' => 25,
			'page_size_param' => null,
			'entity_class' => 'Music\\V1\\Rest\\Album\\AlbumEntity',
			'collection_class' => 'Music\\V1\\Rest\\Album\\AlbumCollection',
			'service_name' => 'Album',
		),
		'Music\\V1\\Rest\\Artist\\Controller' => array(
			'listener' => 'Music\\V1\\Rest\\Artist\\ArtistResource',
			'route_name' => 'music.rest.artist',
			'route_identifier_name' => 'artist_id',
			'collection_name' => 'artist',
			'entity_http_methods' => array(
				0 => 'GET',
				1 => 'PATCH',
				2 => 'PUT',
				3 => 'DELETE',
			),
			'collection_http_methods' => array(
				0 => 'GET',
				1 => 'POST',
			),
			'collection_query_whitelist' => array(),
			'page_size' => 25,
			'page_size_param' => null,
			'entity_class' => 'Music\\V1\\Rest\\Artist\\ArtistEntity',
			'collection_class' => 'Music\\V1\\Rest\\Artist\\ArtistCollection',
			'service_name' => 'Artist',
		),
	),
	'zf-versioning' => array(
		'uri' => array(
			0 => 'music.rest.album',
			1 => 'music.rest.artist',
		),
	),
	'service_manager' => array(
		'invokables' => [
			'music.listener.hal-listener' => 'Music\\V1\\Listener\\HalListener',
			'music.service.hal.entity.linker' => 'Music\\V1\\Service\\HalLinker\\Entity\\HalEntityLinker',
			'music.service.hal.collection.linker' => 'Music\\V1\\Service\\HalLinker\\Collection\\HalCollectionLinker',
//			'music.service.hal-entity-renderer' => 'Music\\V1\\Service\\HalEntityRenderer\\HalEntityRenderer',
		],
		'factories' => array(
			'Music\\V1\\Rest\\Album\\AlbumResource' => 'Music\\V1\\Rest\\Album\\AlbumResourceFactory',
			'Music\\V1\\Rest\\Artist\\ArtistResource' => 'Music\\V1\\Rest\\Artist\\ArtistResourceFactory',
		),
		'initializers' => [
//			'Music\\V1\\Service\\HalEntityRenderer\\HalEntityRendererInitializer'
		],
	),

	'zf-content-negotiation' => array(
		'controllers' => array(
			'Music\\V1\\Rest\\Album\\Controller' => 'HalJson',
			'Music\\V1\\Rest\\Artist\\Controller' => 'HalJson',
		),
		'accept_whitelist' => array(
			'Music\\V1\\Rest\\Album\\Controller' => array(
				0 => 'application/vnd.music.v1+json',
				1 => 'application/hal+json',
				2 => 'application/json',
			),
			'Music\\V1\\Rest\\Artist\\Controller' => array(
				0 => 'application/vnd.music.v1+json',
				1 => 'application/hal+json',
				2 => 'application/json',
			),
		),
		'content_type_whitelist' => array(
			'Music\\V1\\Rest\\Album\\Controller' => array(
				0 => 'application/vnd.music.v1+json',
				1 => 'application/json',
			),
			'Music\\V1\\Rest\\Artist\\Controller' => array(
				0 => 'application/vnd.music.v1+json',
				1 => 'application/json',
			),
		),
	),
	'zf-hal' => array(
		'metadata_map' => array(
			'Music\\V1\\Rest\\Album\\AlbumEntity' => array(
				'entity_identifier_name' => 'id',
				'route_name' => 'music.rest.album',
				'route_identifier_name' => 'album_id',
				'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
				// Une façon possible pour lier les entités entre elles, le problèmes ici et que l'on a pas l'ID de l'artiste...
//				'links' => [
//					[
//						'rel' => 'artist',
//						'route' => [
//							'name' => 'music.rest.artist',
//							'params' => [
//								'artist_id' => '??'
//							]
//						]
//					]
//				]
			),
			'Music\\V1\\Rest\\Album\\AlbumCollection' => array(
				'entity_identifier_name' => 'id',
				'route_name' => 'music.rest.album',
				'route_identifier_name' => 'album_id',
				'is_collection' => true,
			),
			'Music\\V1\\Rest\\Artist\\ArtistEntity' => array(
				'entity_identifier_name' => 'id',
				'route_name' => 'music.rest.artist',
				'route_identifier_name' => 'artist_id',
				'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
			),
			'Music\\V1\\Rest\\Artist\\ArtistCollection' => array(
				'entity_identifier_name' => 'id',
				'route_name' => 'music.rest.artist',
				'route_identifier_name' => 'artist_id',
				'is_collection' => true,
			),
		),
	),
];
