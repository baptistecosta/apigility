<?php
namespace Music\V1\Service\HalLinker;


use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

abstract class AbstractHalLinker implements ServiceLocatorAwareInterface, EventManagerAwareInterface, HalLinkerInterface {

	use ServiceLocatorAwareTrait;
	use EventManagerAwareTrait;

	/**
	 * Hypertext Application Language resource.
	 * @var $halResource
	 */
	protected $halResource;

	/**
	 * Resource (entity/collection)
	 * @var $resource
	 */
	protected $resource;

	/**
	 * Resource class name.
	 * @var string $resourceClassName
	 */
	protected $resourceClassName;

	/**
	 * Add links to HAL entity before it get rendered.
	 */
	public function addLinks() {
		if ($methodName = $this->buildMethodName(ucfirst($this->getResourceType()))) {
			call_user_func([$this, $methodName]);
		}
	}

	/**
	 * Set HAL resource.
	 * @param $halResource
	 * @return $this
	 */
	public function setHalResource($halResource) {
		$this->halResource = $halResource;
		$methodName = 'get' . ucfirst($this->getResourceType());
		$this->resource = $halResource->$methodName();
		$this->resourceClassName = get_class($this->resource);
		return $this;
	}

	protected function buildMethodName($resourceType) {
		$parts = explode('\\', $this->resourceClassName);
		$collectionName = end($parts);
		if (substr($collectionName, -strlen($resourceType)) !== $resourceType) {
			return null;
		}
		return 'add' . $collectionName . 'Links';
	}
}