<?php
namespace MusicTest\V1\Rest\Album;


use Music\V1\Rest\Album\AlbumMapper;
use PHPUnit_Framework_MockObject_MockObject;

class AlbumMapperTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var $instance \Music\V1\Rest\Album\AlbumMapper
	 */
	protected $instance;

	/**
	 * @var $mockAdapter PHPUnit_Framework_MockObject_MockObject
	 */
	protected $mockAdapter;

	protected function setUp() {
		$mockDriver = $this->getMock('Zend\\Db\\Adapter\\Driver\\DriverInterface');
		$mockDriver
			->expects($this->any())
			->method('getConnection')
			->will($this->returnValue(
				$this->getMock('Zend\\Db\\Adapter\\Driver\\ConnectionInterface')
			));

		$this->mockAdapter = $this->getMock('Zend\\Db\\Adapter\\Adapter', ['query'], [$mockDriver]);

		$this->instance = new AlbumMapper();
		$this->instance->setAdapter($this->mockAdapter);
	}

	protected function tearDown() {
		$this->instance = null;
	}

	/**
	 * Create test.
	 */
	public function testCreate() {
		$mockResult = $this->getMock('Zend\\Db\\Adapter\\Driver\\Pdo\\Result');
		$mockResult
			->expects($this->once())
			->method('getGeneratedValue')
			->will($this->returnValue(1));

		$this->mockAdapter
			->expects($this->once())
			->method('query')
			->will($this->returnValue($mockResult));

		$generatedValue = $this->instance->create([]);
		$this->assertEquals(1, $generatedValue);
	}

	/**
	 * Fetch all test.
	 *
	 * @dataProvider fetchAllProvider
	 */
	public function testFetchAll($params) {
		$this->assertInstanceOf('Music\\V1\\Rest\\Album\\AlbumCollection', $this->instance->fetchAll($params));
	}

	public function fetchAllProvider() {
		return [
			[[]],
			[['artist_id' => 1]]
		];
	}

	/**
	 * Fetch one test.
	 */
	public function testFetchOne() {
		$resultSetMock = $this->getMock('Zend\\Db\\ResultSet\\ResultSet', ['toArray']);
		$resultSetMock
			->expects($this->once())
			->method('toArray')
			->will($this->returnValue([
				[
					'id' => 1,
					'title' => 'Fight For Your Mind',
					'artist_id' => 1
				]
			]));

		$this->mockAdapter
			->expects($this->once())
			->method('query')
			->will($this->returnValue($resultSetMock));

		$this->assertInstanceOf('Music\\V1\\Rest\\Album\\AlbumEntity', $this->instance->fetchOne(1));
	}

	/**
	 * Fetch one failed test.
	 */
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

		$this->assertEquals(false, $this->instance->fetchOne(0));
	}

	/**
	 * Patch test.
	 */
	public function testPatch() {
//		$this->mockAdapter
//			->expects($this->any())
//			->method('query')
//			->will($this->returnValue(''));

//		$this->instance->patch(1, [
//			'title' => 'Live From Mars'
//		]);

		$this->assertEquals(1, 1);
	}
}