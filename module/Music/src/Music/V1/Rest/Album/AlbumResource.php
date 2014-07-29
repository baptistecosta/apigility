<?php
namespace Music\V1\Rest\Album;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class AlbumResource extends AbstractResourceListener {

	/**
	 * @var AlbumMapper
	 */
	protected $mapper;

	/**
	 * @param AlbumMapper $mapper
	 */
	function __construct(AlbumMapper $mapper) {
		$this->mapper = $mapper;
	}

	/**
	 * Create a resource
	 *
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function create($data) {
		$albumId = $this->mapper->create((array)$data);
		return $this->mapper->fetchOne($albumId);
	}

	/**
	 * Delete a resource
	 *
	 * @param  mixed $id
	 * @return ApiProblem|mixed
	 */
	public function delete($id) {
		return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
	}

	/**
	 * Delete a collection, or members of a collection
	 *
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function deleteList($data) {
		return new ApiProblem(405, 'The DELETE method has not been defined for collections');
	}

	/**
	 * Fetch a resource
	 *
	 * @param  int $id
	 * @return ApiProblem|mixed
	 */
	public function fetch($id) {
		return $this->mapper->fetchOne($id);
	}

	/**
	 * Fetch all or a subset of resources
	 *
	 * @param  array $params
	 * @return ApiProblem|mixed
	 */
	public function fetchAll($params = []) {
		return $this->mapper->fetchAll([
			'conditions' => array_merge(
				['artist_id' => $this->getEvent()->getRouteParam('artist_id')],
				(array) $params
			)
		]);
	}

	/**
	 * Patch (partial in-place update) a resource
	 *
	 * @param  mixed $id
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function patch($id, $data) {
		$this->mapper->patch($id, (array)$data);
		return $this->mapper->fetchOne($id);
	}

	/**
	 * Replace a collection or members of a collection
	 *
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function replaceList($data) {
		return new ApiProblem(405, 'The PUT method has not been defined for collections');
	}

	/**
	 * Update a resource
	 *
	 * @param  mixed $id
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function update($id, $data) {
		return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
	}
}
