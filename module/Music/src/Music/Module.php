<?php
namespace Music;

use Music\V1\Rest\Album\AlbumMapper;
use Music\V1\Rest\Artist\ArtistMapper;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;
use Zend\View\ViewEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface, ServiceProviderInterface, BootstrapListenerInterface {

	/**
	 * Listen to the bootstrap event
	 *
	 * @param EventInterface $e
	 * @return array
	 */
	public function onBootstrap(EventInterface $e) {
		$serviceManager = $e->getApplication()->getServiceManager();

		/** @var \ZF\Hal\Plugin\Hal $hal */
		$hal = $serviceManager->get('ViewHelperManager')->get('Hal');
		$serviceManager->get('music.listener.hal-listener')->attach($hal->getEventManager());

		// Event tests
		/** @var \Zend\Mvc\Application $app */
/*		$app = $e->getApplication();
		$em = $app->getEventManager();
		$counter = 0;
		$cb = function($e) use (&$counter) {
			var_dump(json_encode([
				'event' => $e->getName(),
				'counter' => ++$counter
			]));
		};
		$em->attach(MvcEvent::EVENT_ROUTE, $cb);
		$em->attach(MvcEvent::EVENT_DISPATCH, $cb);
		$em->attach(MvcEvent::EVENT_RENDER, $cb);
		$em->attach(MvcEvent::EVENT_FINISH, $cb);
		$em->attach(ModuleEvent::EVENT_MERGE_CONFIG, $cb);
		$em->attach(ViewEvent::EVENT_RENDERER, $cb);
		$em->attach(ViewEvent::EVENT_RESPONSE, $cb);
		$em->attach(ModuleEvent::EVENT_LOAD_MODULE, $cb);
*/
	}

	public function getConfig() {
		return include __DIR__ . '/../../config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return [
			'ZF\Apigility\Autoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__,
				],
			],
		];
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig() {
		return [
			'factories' => [
				'Music\\V1\\Rest\\Album\\AlbumMapper' => function (ServiceManager $sm) {
						$adapter = $sm->get('\\Zend\\Db\\Adapter\\Adapter');
						$albumMapper = new AlbumMapper();
						return $albumMapper->setAdapter($adapter)->setTableName('albums');
					},
				'Music\\V1\\Rest\\Artist\\ArtistMapper' => function (ServiceManager $sm) {
						$adapter = $sm->get('\\Zend\\Db\\Adapter\\Adapter');
						$artistMapper = new ArtistMapper();
						return $artistMapper->setAdapter($adapter)->setTableName('artists');
					}
			],
		];
	}
}
