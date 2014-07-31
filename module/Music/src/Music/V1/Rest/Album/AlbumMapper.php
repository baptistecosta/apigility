<?php
namespace Music\V1\Rest\Album;


use Music\V1\Mapper\AbstractMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Paginator\Adapter\DbSelect;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class AlbumMapper
 * @package Music\V1\Rest\Album
 */
class AlbumMapper extends AbstractMapper implements ServiceLocatorAwareInterface {

	use ServiceLocatorAwareTrait;

	/**
	 * @var \Zend\Db\Adapter\Adapter
	 */
	protected $adapter;

	public function create(array $data) {
		$insert = new Insert($this->tableName);
		$insert->values($data);
		$sql = new Sql($this->adapter);
		$sqlString = $sql->getSqlStringForSqlObject($insert);

		/** @var $result Result */
		$result = $this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);
		return $result->getGeneratedValue();
	}

	/**
	 * Fetch all albums.
	 *
	 * @param array $params
	 * @return AlbumCollection
	 */
	public function fetchAll(array $params = []) {
		$select = new Select($this->tableName);
		if (!empty($params['artist_id'])) {
			$select->where(['artist_id' => $params['artist_id']]);
		}
		$paginatorAdapter = new DbSelect($select, $this->adapter);
		$collection = new AlbumCollection($paginatorAdapter);
		return $collection;
	}

	/**
	 * Fetch one album.
	 *
	 * @param $albumId
	 * @return bool|AlbumEntity
	 */
	public function fetchOne($albumId) {
		$resultSet = $this->adapter->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$albumId]);
		$results = $resultSet->toArray();
		if (empty($results)) {
			return false;
		}
		$entity = new AlbumEntity();
		$entity->exchangeArray($results[0]);
		return $entity;
	}

	public function patch($id, array $data) {
		$update = new Update($this->tableName);
		$update->set($data)->where(['id' => $id]);
		$sql = new Sql($this->adapter);
		$sqlString = $sql->getSqlStringForSqlObject($update);
		$this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);
	}

	/**
	 * @param $id
	 */
	public function delete($id) {

	}
}