<?php
namespace Music\V1\Service\HalEntityRenderer;

/**
 * Interface HalEntityRendererAwareInterface
 * @package Music\V1\Service\HalEntityRenderer
 */
interface HalEntityRendererAwareInterface {

	/**
	 * Set HAL entity renderer
	 *
	 * @param HalEntityRenderer $halEntityRenderer
	 */
	public function setHalEntityRenderer(HalEntityRenderer $halEntityRenderer);

	/**
	 * Get HAL entity renderer
	 *
	 * @return HalEntityRenderer
	 */
	public function getHalEntityRenderer();
} 