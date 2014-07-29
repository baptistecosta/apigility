<?php
namespace Music\V1\Service\HalEntityRenderer;


trait HalEntityRendererAwareTrait {

	/**
	 * @var HalEntityRenderer $halServiceLocator
	 */
	protected $halEntityRenderer = null;

	/**
	 * @return \Music\V1\Service\HalEntityRenderer\HalEntityRenderer
	 */
	public function getHalEntityRenderer() {
		return $this->halEntityRenderer;
	}

	/**
	 * @param \Music\V1\Service\HalEntityRenderer\HalEntityRenderer $halServiceLocator
	 * @return $this
	 */
	public function setHalEntityRenderer(HalEntityRenderer $halServiceLocator) {
		$this->halEntityRenderer = $halServiceLocator;
		return $this;
	}
} 