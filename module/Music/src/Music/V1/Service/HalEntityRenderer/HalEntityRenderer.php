<?php
namespace Music\V1\Service\HalEntityRenderer;


use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\Hal\Entity;
use ZF\Hal\Link\Link;

/**
 * Class HalEntityRenderer
 * @package Music\V1\Service
 */
class HalEntityRenderer implements ServiceLocatorAwareInterface, EventManagerAwareInterface {

	use ServiceLocatorAwareTrait;
	use EventManagerAwareTrait;

	/**
	 * Hypertext Application Language entity.
	 * @var Entity $halEntity
	 */
	protected $halEntity;

	/**
	 * Entity
	 * @var $entity
	 */
	protected $entity;

	/**
	 * Entity class name.
	 * @var string $entityClassName
	 */
	protected $entityClassName;

	/**
	 * Set HAL entity.
	 * @param Entity $halEntity
	 * @return $this
	 */
	public function setHalEntity(Entity $halEntity) {
		$this->halEntity = $halEntity;
		$this->entity = $halEntity->entity;
		$this->entityClassName = get_class($this->entity);
		return $this;
	}

	/**
	 * Add links to HAL entity before it get rendered.
	 */
	public function addLinks() {
		$parts = explode('\\', $this->entityClassName);
		$entityName = end($parts);
		if (substr($entityName, -strlen('Entity')) !== 'Entity') {
			return;
		}
		call_user_func([$this, 'add' . $entityName . 'Links']);
	}

	private function addAlbumEntityLinks() {
		/** @var \ZF\Hal\Link\LinkCollection $links */
		$this->halEntity->getLinks()->add(Link::factory([
			'rel' => 'artist',
			'route' => [
				'name' => 'music.rest.artist',
				'params' => [
					'artist_id' => $this->entity->getArtistId()
				]
			]
		]));
	}

	private function addArtistEntityLinks() {
		/** @var $albumMapper \Music\V1\Rest\Album\AlbumMapper */
		$albumMapper = $this->getServiceLocator()->get('Music\\V1\\Rest\\Album\\AlbumMapper');
		$albumIds = $albumMapper->findAlbumIdsForArtist($this->entity->getId());

		foreach ($albumIds as $albumId) {
			$this->halEntity->getLinks()->add(Link::factory([
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