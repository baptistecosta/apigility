<?php
namespace Music\V1\Service\HalLinker\Entity;

use Music\V1\Service\HalLinker\AbstractHalLinker;


/**
 * Class HalEntityRenderer
 * @package Music\V1\Service\HalLinker\Entity
 */
class HalEntityLinker extends AbstractHalLinker {

	/**
	 * @return string
	 */
	public function getResourceType() {
		return self::ENTITY;
	}

	private function addAlbumEntityLinks() {
		/** @var \ZF\Hal\Link\LinkCollection $links */
		$this->halResource->getLinks()->add(Link::factory([
			'rel' => 'artist',
			'route' => [
				'name' => 'music.rest.artist',
				'params' => [
					'artist_id' => $this->resource->getArtistId()
				]
			]
		]));
	}

	private function addArtistEntityLinks() {
		/** @var $albumMapper \Music\V1\Rest\Album\AlbumMapper */
		$albumMapper = $this->getServiceLocator()->get('Music\\V1\\Rest\\Album\\AlbumMapper');
		$albumIds = $albumMapper->findAlbumIdsForArtist($this->resource->getId());

		foreach ($albumIds as $albumId) {
			$this->halResource->getLinks()->add(Link::factory([
				'rel' => 'album',
				'route' => [
					'name' => 'music.rest.album',
					'params' => [
						'album_id' => $albumId
					]
				]
			]));
		}
	}
}