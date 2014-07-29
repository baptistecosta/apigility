<?php
namespace Music\V1\Rest\Artist;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ArtistResource extends AbstractResourceListener {

	/**
	 * @var ArtistMapper
	 */
	protected $mapper;

	/**
	 * @param ArtistMapper $mapper
	 */
	function __construct(ArtistMapper $mapper) {
		$this->mapper = $mapper;
	}

	/**
	 * Create a resource
	 *
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function create($data) {
		return new ApiProblem(405, 'The POST method has not been defined');
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
	 * @param  mixed $id
	 * @return ApiProblem|mixed
	 */
	public function fetch($id) {
		/** @var \Zend\Mvc\MvcEvent $e */
		$e = $this->getEvent();
		$route = $e->getRouteMatch()->getMatchedRouteName();
		$artist = $this->mapper->fetchOne($id);

		return $artist;
	}

	/**
	 * Fetch all or a subset of resources
	 *
	 * @param  array $params
	 * @return ApiProblem|mixed
	 */
	public function fetchAll($params = array()) {
		$artists = $this->mapper->fetchAll();
		return $artists;
	}

	/**
	 * Patch (partial in-place update) a resource
	 *
	 * @param  mixed $id
	 * @param  mixed $data
	 * @return ApiProblem|mixed
	 */
	public function patch($id, $data) {
		return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
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
