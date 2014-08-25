<?php
namespace MusicTest\V1\Service\HalLinker;


use Music\V1\Rest\Artist\ArtistEntity;
use PHPUnit_Framework_MockObject_MockObject;
use ReflectionMethod;

class AbstractHalLinkerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var $instance \Music\V1\Service\HalLinker\AbstractHalLinker
	 */
	protected $instance;

	/**
	 * @var $mockAdapter PHPUnit_Framework_MockObject_MockObject
	 */
	protected $mockAdapter;

	protected function setUp() {
		$this->instance = $this->getMockForAbstractClass('Music\\V1\\Service\\HalLinker\\AbstractHalLinker');
	}

	protected function tearDown() {
		$this->instance = null;
	}

	/**
	 * HAL resource getter and setter test.
	 */
	public function testGetSetHalResource() {
		$mockHalEntity = $this->getMock('ZF\\Hal\\Entity', [], [[]]);
		$this->assertSame($this->instance, $this->instance->setHalResource($mockHalEntity));
		$this->assertEquals($mockHalEntity, $this->instance->getHalResource());
	}

	/**
	 * Resource getter and setter test.
	 */
	public function testGetSetResource() {
		$entity = new ArtistEntity();
		$this->assertSame($this->instance, $this->instance->setResource($entity));
		$this->assertEquals($entity, $this->instance->getResource());
		$this->assertEquals('Music\\V1\\Rest\\Artist\\ArtistEntity', $this->instance->getResourceClassName());
	}

	/**
	 * Resource setter exception test.
	 */
	public function testSetResourceException() {
		$this->setExpectedException('Exception');
		$this->instance->setResource('mock');
	}

	/**
	 * Build "AddLinks" method name test.
	 *
	 * @dataProvider dataProviderBuildAddLinksMethodName
	 */
	public function testBuildAddLinksMethodName($expected, $resource, $resourceType) {
		$method = new ReflectionMethod($this->instance, 'buildAddLinksMethodName');
		$method->setAccessible(true);
		$this->instance->setResource(new $resource());
		$this->assertEquals($expected, $method->invoke($this->instance, $resourceType));
	}

	public function dataProviderBuildAddLinksMethodName() {
		return [
			['addArtistEntityLinks', 'Music\\V1\\Rest\\Artist\\ArtistEntity', 'entity'],
			['addAlbumEntityLinks', 'Music\\V1\\Rest\\Album\\AlbumEntity', 'entity'],
			[null, 'Music\\V1\\Rest\\Album\\AlbumEntity', 'collection'],
		];
	}

	/**
	 * @dataProvider dataProviderIsResource
	 */
	public function testIsResource($expected, $resourceName, $resourceType) {
		$method = new ReflectionMethod($this->instance, 'isResource');
		$method->setAccessible(true);
		$this->assertEquals($expected, $method->invoke($this->instance, $resourceName, $resourceType));
	}

	public function dataProviderIsResource() {
		return [
			[true, 'AlbumEntity', 'Entity'],
			[true, 'AlbumCollection', 'Collection'],
			[false, 'AlbumCollection', 'Entity'],
			[false, '', ''],
			[false, 1, null],
			[false, '', 23],
		];
	}
}