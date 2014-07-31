<?php
namespace MusicTest\V1\Rest\Artist;


use Music\V1\Rest\Artist\ArtistMapper;
use PHPUnit_Framework_MockObject_MockObject;

class ArtistMapperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var $instance \Music\V1\Rest\Artist\ArtistMapper
	 */
	protected $instance;

	/**
	 * @var $mockAdapter PHPUnit_Framework_MockObject_MockObject
	 */
	protected $mockAdapter;

	protected function setUp() {
		$mockConnection = $this->getMock('Zend\\Db\\Adapter\\Driver\\ConnectionInterface');
		$mockDriver = $this->getMock('Zend\\Db\\Adapter\\Driver\\DriverInterface');
		$mockDriver
			->expects($this->any())
			->method('getConnection')
			->will($this->returnValue($mockConnection));

		$this->mockAdapter = $this->getMock('Zend\\Db\\Adapter\\Adapter', ['query'], [$mockDriver]);

		$this->instance = new ArtistMapper();
		$this->instance->setAdapter($this->mockAdapter);
	}

	protected function tearDown() {
		$this->instance = null;
	}

	public function testExtendsAbstractMapper() {
		$this->assertInstanceOf('Music\\V1\\Mapper\\AbstractMapper', $this->instance);
	}

	public function testFetchAll() {
		$this->assertInstanceOf('Music\\V1\\Rest\\Artist\\ArtistCollection', $this->instance->fetchAll());
	}

	public function testFetchOne() {
		$resultSetMock = $this->getMock('Zend\\Db\\ResultSet\\ResultSet', ['toArray']);
		$resultSetMock
			->expects($this->once())
			->method('toArray')
			->will($this->returnValue([
				[
					'id' => 1,
					'name' => 'Ben Harper'
				]
			]));

		$this->mockAdapter
			->expects($this->once())
			->method('query')
			->will($this->returnValue($resultSetMock));

		$artist = $this->instance->fetchOne(1);
		$this->assertInstanceOf('Music\\V1\\Rest\\Artist\\ArtistEntity', $artist);
	}

	public function testFetchOneFailed() {
		$resultSetMock = $this->getMock('Zend\\Db\\ResultSet\\ResultSet', ['toArray']);
		$resultSetMock
			->expects($this->once())
			->method('toArray')
			->will($this->returnValue([]));

		$this->mockAdapter
			->expects($this->once())
			->method('query')
			->will($this->returnValue($resultSetMock));

		$result = $this->instance->fetchOne(0);
		$this->assertEquals(false, $result);
	}
}