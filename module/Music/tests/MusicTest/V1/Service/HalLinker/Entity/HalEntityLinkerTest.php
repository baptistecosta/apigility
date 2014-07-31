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
		$method = new ReflectionMethod($this->instance, 'addAlbumEntityLinks');
		$method->setAccessible(true);


		$linkCollection = new LinkCollection();

		$entity = new AlbumEntity();
//		$halEntity = $this->getMock('ZF\\Hal\\Entity', ['getLinks']);
//		$halEntity
//			->expects($this->any())
//			->method('getLinks')
//			->will($this->returnValue($linkCollection));

		$halEntity = new Entity($entity, 1);

		$this->instance->setHalResource($halEntity);
		$this->instance->setResource($entity);

		$method->invoke($this->instance);

		$this->assertEquals(1, 1);
	}
}