<?php
namespace Music\V1\Service\HalLinker;


use SebastianBergmann\Exporter\Exception;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Paginator\Paginator;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Stdlib\ArraySerializableInterface;

abstract class AbstractHalLinker implements ServiceLocatorAwareInterface, EventManagerAwareInterface, HalLinkerInterface {

	use ServiceLocatorAwareTrait;
	use EventManagerAwareTrait;

	/**
	 * Hypertext Application Language resource.
	 *
	 * @var $halResource
	 */
	protected $halResource;

	/**
	 * Resource, entity or collection.
	 *
	 * @var $resource
	 */
	protected $resource;

	/**
	 * Resource class name.
	 *
	 * @var string $resourceClassName
	 */
	protected $resourceClassName;

	/**
	 * Set HAL resource.
	 * @param $halResource
	 * @return $this
	 */
	public function setHalResource($halResource) {
		$this->halResource = $halResource;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHalResource() {
		return $this->halResource;
	}

	/**
	 * Set a shortcut to the resource
	 *
	 * @param $resource
	 * @throws \SebastianBergmann\Exporter\Exception
	 * @return $this
	 */
	public function setResource($resource) {
		if (!$resource instanceof ArraySerializableInterface && !$resource instanceof Paginator) {
			throw new Exception('Resource must be an instance of Zend\Stdlib\ArraySerializableInterface or Zend\Paginator\Paginator');
		}
		$this->resource = $resource;
		$this->resourceClassName = get_class($resource);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getResource() {
		return $this->resource;
	}

	/**
	 * @return string
	 */
	public function getResourceClassName() {
		return $this->resourceClassName;
	}

	/**
	 * Add links to HAL entity before it get rendered.
	 */
	public function addLinks() {
		if (!$this->halResource) {
			throw new \Exception('Hal resource is null!');
		}
		if (!$this->resource) {
			throw new \Exception('Resource is null!');
		}

		$resourceType = ucfirst($this->getResourceType());
		if ($methodName = $this->buildAddLinksMethodName($resourceType)) {
			if (method_exists($this, $methodName)) {
				$this->$methodName();
			}
		}
	}

	/**
	 * @param $resourceType
	 * @return null|string
	 */
	protected function buildAddLinksMethodName($resourceType) {
		$parts = explode('\\', $this->resourceClassName);
		$resourceName = end($parts);
		if (!$this->isResource($resourceName, $resourceType)) {
			return null;
		}
		return 'add' . $resourceName . 'Links';
	}

	/**
	 * @param $collectionName
	 * @param $resourceType
	 * @return bool
	 */
	private function isResource($collectionName, $resourceType) {
		if (empty($collectionName) || empty($resourceType)) {
			return false;
		}
		return strcasecmp(substr($collectionName, -strlen($resourceType)), $resourceType) === 0;
	}
}