<?php
namespace Music\V1\Rest\Artist;

use Zend\Stdlib\ArraySerializableInterface;

class ArtistEntity implements ArraySerializableInterface {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * Exchange internal values from provided array
	 *
	 * @param  array $array
	 * @return void
	 */
	public function exchangeArray(array $array) {
		$this->setId($array['id']);
		$this->setName($array['name']);
	}

	/**
	 * Return an array representation of the object
	 *
	 * @return array
	 */
	public function getArrayCopy() {
		return [
			'id' => $this->getId(),
			'name' => $this->getName(),
		];
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return $this
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
}
