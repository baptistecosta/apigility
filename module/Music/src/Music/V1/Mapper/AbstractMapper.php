<?php
namespace Music\V1\Mapper;
use Zend\Db\Adapter\AdapterInterface;


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
	 * @var AdapterInterface
	 */
	protected $adapter;

	/**
	 * @return AdapterInterface
	 */
	public function getAdapter() {
		return $this->adapter;
	}

	/**
	 * @param AdapterInterface $adapter
	 * @return $this
	 */
	public function setAdapter(AdapterInterface $adapter) {
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