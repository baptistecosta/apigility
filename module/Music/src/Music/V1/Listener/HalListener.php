<?php
namespace Music\V1\Listener;


use Music\V1\Service\HalLinker\Collection\HalCollectionLinker;
use Music\V1\Service\HalLinker\Entity\HalEntityLinker;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class HalListener
 * @package Music\V1\Listener
 */
class HalListener implements ServiceLocatorAwareInterface {

	use ServiceLocatorAwareTrait;

	/**
	 * Attach one or more listeners
	 *
	 * Implementors may add an optional $priority argument; the EventManager
	 * implementation will pass this to the aggregate.
	 *
	 * @param EventManagerInterface $events
	 *
	 * @return void
	 */
	public function attach(EventManagerInterface $events) {
		$this->listeners[] = $events->attach('renderEntity', [$this, 'onRenderEntity']);
		$this->listeners[] = $events->attach('renderCollection', [$this, 'onRenderCollection']);
	}

	/**
	 * On render entity callback.
	 *
	 * @param Event $e
	 */
	public function onRenderEntity(Event $e) {
		/** @var $halEntityLinker HalEntityLinker */
		$halEntityLinker = $this->getServiceLocator()->get('music.service.hal.entity.linker');
		$halEntityLinker
			->setHalResource($e->getParam('entity'))
			->setResource($e->getParam('entity')->entity)
			->addLinks();
	}

	/**
	 * On render collection callback.
	 *
	 * @param Event $e
	 */
	public function onRenderCollection(Event $e) {
		/** @var $halCollectionLinker HalCollectionLinker */
		$halCollectionLinker = $this->getServiceLocator()->get('music.service.hal.collection.linker');
		$halCollectionLinker
			->setHalResource($e->getParam('collection'))
			->setResource($e->getParam('collection')->getCollection())
			->addLinks();
	}
}