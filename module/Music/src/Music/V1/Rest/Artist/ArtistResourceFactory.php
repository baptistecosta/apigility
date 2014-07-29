<?php
namespace Music\V1\Rest\Artist;

/**
 * Class ArtistResourceFactory
 * @package Music\V1\Rest\Artist
 */
class ArtistResourceFactory {

	public function __invoke($services) {
		/** @var ArtistMapper $mapper */
		$mapper = $services->get('Music\\V1\\Rest\\Artist\\ArtistMapper');
		return new ArtistResource($mapper);
	}
}
