<?php
namespace Music\V1\Mapper;


/**
 * Class AbstractMapper
 * @package Music\V1\Mapper
 * @author Baptiste Costa
 */
class AbstractMapper {

	/**
	 * @var String
	 */
	protected $tableName;

	/**
	 * @var \Zend\Db\Adapter\AdapterInterface
	 */
	protected $adapter;

	/**
	 * @return \Zend\Db\Adapter\AdapterInterface
	 */
	public function getAdapter() {
		return $this->adapter;
	}

	/**
	 * @param \Zend\Db\Adapter\AdapterInterface $adapter
	 * @return $this
	 */
	public function setAdapter($adapter) {
		$this->adapter = $adapter;
		return $this;
	}

	/**
	 * @return String
	 */
	public function getTableName() {
		return $this->tableName;
	}

	/**
	 * @param String $tableName
	 * @return $this
	 */
	public function setTableName($tableName) {
		$this->tableName = $tableName;
		return $this;
	}

}