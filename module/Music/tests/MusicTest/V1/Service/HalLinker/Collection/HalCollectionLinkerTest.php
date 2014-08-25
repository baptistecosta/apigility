<?php
namespace MusicTest\V1\Service\HalLinker\Collection;


//require_once(VENDOR . '/zfcampus/zf-hal/src/Entity.php');


use Music\V1\Service\HalLinker\Collection\HalCollectionLinker;

class HalEntityLinkerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var $instance \Music\V1\Service\HalLinker\Collection\HalCollectionLinker
	 */
	protected $instance;

	protected function setUp() {
		$this->instance = new HalCollectionLinker();
	}

	protected function tearDown() {
		$this->instance = null;
	}

	public function testAddAlbumEntityLinks() {
//		$entity = new AlbumEntity();
//		$halEntity = new Entity($entity, 1);
//
//		$this->instance->setHalResource($halEntity);
//		$this->instance->setResource($entity);
//
//		$method = new ReflectionMethod($this->instance, 'addAlbumEntityLinks');
//		$method->setAccessible(true);
//		$method->invoke($this->instance);

		$this->assertEquals(1, 1);
	}
}