<?php
namespace Music\V1\Listener;


use Music\V1\Service\HalEntityRenderer\HalEntityRendererAwareInterface;
use Music\V1\Service\HalEntityRenderer\HalEntityRendererAwareTrait;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Class HalListener
 * @package Music\V1\Listener
 */
class HalListener implements HalEntityRendererAwareInterface {

	use HalEntityRendererAwareTrait;

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
		$this->getHalEntityRenderer()->setHalEntity($e->getParam('entity'))->addLinks();

		/** @var $halEntityRenderer HalEntityRenderer */
//		$halEntityRenderer = $this->getServiceLocator()->get('music.service.hal-entity-renderer');
//		$halEntityRenderer
//			->setHalEntity($e->getParam('entity'))
//			->process();
	}

	/**
	 * On render collection callback.
	 *
	 * @param Event $e
	 */
	public function onRenderCollection(Event $e) {

	}
}