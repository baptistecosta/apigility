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
	 * @return ArtistCollection
	 */
	public function fetchAll() {
		$select = new Select($this->tableName);
		$paginatorAdapter = new DbSelect($select, $this->adapter);
		$collection = new ArtistCollection($paginatorAdapter);
		return $collection;
	}

	/**
	 * @param $artistId
	 * @return bool|ArtistEntity
	 */
	public function fetchOne($artistId) {
		$results = $this->adapter->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$artistId])->toArray();
		if (!$artistData = $results[0]) {
			return false;
		}
		$artist = new ArtistEntity();
		$artist->exchangeArray($artistData);
		return $artist;
	}

} 