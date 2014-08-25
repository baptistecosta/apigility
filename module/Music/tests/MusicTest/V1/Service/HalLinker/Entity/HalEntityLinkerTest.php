<?php
namespace MusicTest\V1\Service\HalLinker\Entity;

use Music\V1\Rest\Album\AlbumEntity;
use Music\V1\Service\HalLinker\Entity\HalEntityLinker;
use ReflectionMethod;
use ZF\Hal\Entity;
use ZF\Hal\Link\LinkCollection;

require_once(VENDOR . '/zfcampus/zf-hal/src/Entity.php');


class HalEntityLinkerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var $instance \Music\V1\Service\HalLinker\Entity\HalEntityLinker
	 */
	protected $instance;

	protected function setUp() {
		$this->instance = new HalEntityLinker();
	}

	protected function tearDown() {
		$this->instance = null;
	}

	public function testAddAlbumEntityLinks() {
		$entity = new AlbumEntity();
		$halEntity = new Entity($entity, 1);

		$this->instance->setHalResource($halEntity);
		$this->instance->setResource($entity);

		$method = new ReflectionMethod($this->instance, 'addAlbumEntityLinks');
		$method->setAccessible(true);
		$method->invoke($this->instance);

		/** @var $halResource Entity */
		$link = $this->instance->getHalResource()->getLinks()->get('artist');

		$this->assertInstanceOf('ZF\Hal\Link\Link', $link);
	}

	public function testAddArtistEntityLinks() {

	}
}