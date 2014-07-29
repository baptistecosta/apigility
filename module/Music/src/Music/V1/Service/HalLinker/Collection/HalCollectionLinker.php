<?php
namespace Music\V1\Service\HalLinker\Collection;


use Music\V1\Service\HalLinker\AbstractHalLinker;

/**
 * Class HalCollectionLinker
 * @package Music\V1\Service\HalLinker\Collection
 */
class HalCollectionLinker extends AbstractHalLinker {

	/**
	 * Get the HAL resource type.
	 *
	 * @return string
	 */
	public function getResourceType() {
		return self::COLLECTION;
	}


}