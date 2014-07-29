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
	 * @param array $params
	 * @return AlbumCollection
	 */
	public function fetchAll(array $params = []) {
		$select = new Select($this->tableName);
		if (!empty($params['conditions']['artist_id'])) {
			$select->where(['artist_id' => $params['conditions']['artist_id']]);
		}
		$paginatorAdapter = new DbSelect($select, $this->adapter);
		$collection = new AlbumCollection($paginatorAdapter);
		return $collection;
	}

	/**
	 * @param $albumId
	 * @return bool|AlbumEntity
	 */
	public function fetchOne($albumId) {
		$resultSet = $this->adapter->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$albumId]);
		if (!$data = $resultSet->toArray()) {
			return false;
		}
		$entity = new AlbumEntity();
		$entity->exchangeArray($data[0]);
		return $entity;
	}

	/**
	 * @param $artistId
	 * @return array
	 */
	public function findAlbumIdsForArtist($artistId) {
		$results = $this->adapter->query("SELECT id FROM {$this->tableName} WHERE artist_id = ?", [$artistId]);
		$albumIds = $results->toArray();
		return array_map('current', $albumIds);
	}

	public function patch($id, array $data) {
		$update = new Update($this->tableName);
		$update->set($data)->where(['id' => $id]);
		$sql = new Sql($this->adapter);
		$sqlString = $sql->getSqlStringForSqlObject($update);
		/** @var $result Result */
		$this->adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);
	}

	/**
	 * @param $id
	 */
	public function delete($id) {

	}
}