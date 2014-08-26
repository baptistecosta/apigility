<?php
namespace Music\V1\Rest\Artist;


use Music\V1\Mapper\AbstractMapper;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Stdlib\Hydrator\ObjectProperty;

class ArtistMapper extends AbstractMapper {

	/**
	 * @var \Zend\Db\Adapter\Adapter
	 */
	protected $adapter;

	/**
	 * Fetch artist collection (paginated results).
	 *
	 * @param array $params
	 * @return ArtistCollection
	 */
	public function fetchAll(array $params = []) {
		$select = new Select($this->tableName);
		if (!empty($params['order'])) {
			$select->order($params['order']);
		}

		$paginatorAdapter = new DbSelect($select, $this->adapter);
		$collection = new ArtistCollection($paginatorAdapter);
		return $collection;
	}

	/**
	 * @param $artistId
	 * @return bool|ArtistEntity
	 */
	public function fetchOne($artistId) {
		$resultSet = $this->adapter->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$artistId]);
		$results = $resultSet->toArray();
		if (empty($results)) {
			return false;
		}
		$artist = new ArtistEntity();
		$artist->exchangeArray($results[0]);
		return $artist;
	}

} 