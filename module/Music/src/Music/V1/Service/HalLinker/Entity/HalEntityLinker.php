<?php
namespace Music\V1\Service\HalLinker\Entity;

use Music\V1\Service\HalLinker\AbstractHalLinker;
use ZF\Hal\Link\Link;


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

	protected function addAlbumEntityLinks() {
		/** @var \ZF\Hal\Link\LinkCollection $links */
		$links = $this->getHalResource()->getLinks();
		$links->add(Link::factory([
			'rel' => 'artist',
			'route' => [
				'name' => 'music.rest.artist',
				'params' => [
					'artist_id' => $this->resource->getArtistId()
				]
			]
		]));
	}

	protected function addArtistEntityLinks() {
		$link = new Link('album');
		$link->setRoute('music.rest.album');
		$link->setRouteOptions([
			'query' => [
				'artist_id' => $this->resource->getId()
			]
		]);
		$this->halResource->getLinks()->add($link, true);

//		$this->halResource->getLinks()->add(Link::factory([
//			'rel' => 'album',
//			'route' => [
//				'name' => 'music.rest.album',
//				'options' => [
//					'query' => [
//						'artist_id' => $this->resource->getId()
//					]
//				]
//			]
//		]));
	}
}
