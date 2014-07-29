<?php
namespace Music\V1\Service\HalLinker;


/**
 * Interface InterfaceHalLinker
 * @package Music\V1\Service\HalLinker
 */
interface HalLinkerInterface {

	const ENTITY = 'entity';
	const COLLECTION = 'collection';

	/**
	 * Get the HAL resource type, "entity" or "collection".
	 *
	 * @return string
	 */
	public function getResourceType();

	/**
	 * @param $halResource
	 * @return mixed
	 */
	public function setHalResource($halResource);

	/**
	 * @return mixed
	 */
	public function addLinks();

}