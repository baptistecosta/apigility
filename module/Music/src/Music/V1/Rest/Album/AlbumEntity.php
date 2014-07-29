<?php
namespace Music\V1\Rest\Album;

use Closure;
use Zend\Stdlib\ArraySerializableInterface;
use ZF\Hal\Link\Link;

/**
 * Class AlbumEntity
 * @property Closure $artistProvider
 * @package Music\V1\Rest\Album
 */
class AlbumEntity implements ArraySerializableInterface {

	public $id;
	public $artistId;
	public $title;

	public function exchangeArray(array $array) {
		$this->setId(empty($array['id']) ? null : $array['id']);
		$this->setArtistId($array['artist_id']);
		$this->setTitle($array['title']);
	}

	public function getArrayCopy() {
		return [
			'id' => $this->getId(),
			'artist_id' => $this->getArtistId(),
			'title' => $this->getTitle(),
		];
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return $this
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return Link
	 */
	public function getArtistId() {
		return $this->artistId;
	}

	/**
	 * @param mixed $artistId
	 * @return $this
	 */
	public function setArtistId($artistId) {
		$this->artistId = $artistId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 * @return $this
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
}
