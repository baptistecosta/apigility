<?php
namespace Music\V1\Rest\Album;

/**
 * Class AlbumResourceFactory
 * @package Music\V1\Rest\Album
 */
class AlbumResourceFactory {

	public function __invoke($services) {
		/** @var AlbumMapper $mapper */
		$mapper = $services->get('Music\\V1\\Rest\\Album\\AlbumMapper');
		return new AlbumResource($mapper);
	}
}