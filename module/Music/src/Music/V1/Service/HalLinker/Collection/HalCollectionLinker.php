<?php
namespace Music\V1\Service\HalLinker\Collection;


use Music\V1\Service\HalLinker\AbstractHalLinker;
use ZF\Hal\Link\Link;

/**
 * Class HalCollectionLinker
 * @package Music\V1\Service\HalLinker\Collection
 */
class HalCollectionLinker extends AbstractHalLinker {

	/**
	 * Get the HAL resource type.
	 *
	 * @return string
	 */
	public function getResourceType() {
		return self::COLLECTION;
	}

	protected function addAlbumCollectionLinks() {
		/** @var $halResource \ZF\Hal\Collection */
		$halResource = $this->halResource;
		$routeOpts = $halResource->getCollectionRouteOptions();

		$params = [];
		if (!empty($routeOpts['query']['artist_id'])) {
			$params['artist_id'] = $routeOpts['query']['artist_id'];
		}

		/** @var \ZF\Hal\Link\LinkCollection $links */
		$this->halResource->getLinks()->add(Link::factory([
			'rel' => 'artist',
			'route' => [
				'name' => 'music.rest.artist',
				'params' => $params
			]
		]));
	}
}