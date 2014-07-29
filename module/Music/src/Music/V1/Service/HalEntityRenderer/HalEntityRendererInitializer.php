<?php
namespace Music\V1\Service\HalEntityRenderer;


use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class HalEntityRendererInitializer
 * @package Music\V1\Service\HalEntityRenderer
 */
class HalEntityRendererInitializer implements InitializerInterface {

	/**
	 * Initialize
	 *
	 * @param $instance
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function initialize($instance, ServiceLocatorInterface $serviceLocator) {
		if ($instance instanceof HalEntityRendererAwareInterface) {
			$instance->setHalEntityRenderer($serviceLocator->get('music.service.hal-entity-renderer'));
		}
	}
}