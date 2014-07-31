<?php
namespace MusicTest\V1\Mapper;


use Music\V1\Mapper\AbstractMapper;

/**
 * Class AbstractMapperTest
 * @package MusicTest\V1\Mapper
 */
class AbstractMapperTest extends \PHPUnit_Framework_TestCase {

	/** @var AbstractMapper $instance */
	protected $instance;

	protected function setUp() {
		$this->instance = $this->getMockForAbstractClass('Music\V1\Mapper\AbstractMapper', [], 'AbstractMapper', true, true, true, [
			'getAdapter',
			'setAdapter',
			'getTableName',
			'setTableName'
		]);
	}

	protected function tearDown() {
		$this->instance = null;
	}

	public function testGetSetAdapter() {
		$mockAdapter = $this->getMockForAbstractClass('\\Zend\\Db\\Adapter\\AdapterInterface');

		$this->instance
			->expects($this->once())
			->method('setAdapter')
			->with($mockAdapter)
			->will($this->returnValue($this->instance));

		$this->instance
			->expects($this->once())
			->method('getAdapter')
			->will($this->returnValue($mockAdapter));

		$this->assertSame($this->instance, $this->instance->setAdapter($mockAdapter));
		$this->assertEquals($mockAdapter, $this->instance->getAdapter());
	}

	public function testGetSetTableName() {
		$fixture = 'table_name';
		$this->instance
			->expects($this->once())
			->method('setTableName')
			->with($fixture)
			->will($this->returnValue($this->instance));

		$this->assertSame($this->instance, $this->instance->setTableName($fixture));

		$this->instance
			->expects($this->once())
			->method('getTableName')
			->will($this->returnValue($fixture));

		$this->assertEquals($fixture, $this->instance->getTableName());
	}
} 