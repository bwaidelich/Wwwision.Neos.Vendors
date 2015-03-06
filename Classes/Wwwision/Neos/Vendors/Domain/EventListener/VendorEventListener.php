<?php
namespace Wwwision\Neos\Vendors\Domain\EventListener;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Wwwision.Neos.Vendors". *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Event\LifecycleEventArgs;
use TYPO3\Flow\Annotations as Flow;
use Wwwision\Neos\Vendors\Domain\Model\Vendor;
use Wwwision\Neos\Vendors\Domain\Service\VendorNodeService;

/**
 * Doctrine event listener for the Vendor domain model that syncs vendor events to the corresponding vendor nodes in the TYPO3CR using the VendorNodeService
 */
class VendorEventListener {

	/**
	 * @Flow\Inject
	 * @var VendorNodeService
	 */
	protected $vendorNodeService;

	/**
	 * @param LifecycleEventArgs $eventArgs
	 * @return void
	 */
	public function prePersist(LifecycleEventArgs $eventArgs) {
		$entity = $eventArgs->getEntity();
		if (!$entity instanceof Vendor) {
			return;
		}
		$this->vendorNodeService->createNodeForVendor($entity);
	}

	/**
	 * @param LifecycleEventArgs $eventArgs
	 * @return void
	 */
	public function preUpdate(LifecycleEventArgs $eventArgs) {
		$entity = $eventArgs->getEntity();
		if (!$entity instanceof Vendor) {
			return;
		}
		$this->vendorNodeService->updateNodeForVendor($entity);
	}

	/**
	 * @param LifecycleEventArgs $eventArgs
	 * @return void
	 */
	public function preRemove(LifecycleEventArgs $eventArgs) {
		$entity = $eventArgs->getEntity();
		if (!$entity instanceof Vendor) {
			return;
		}
		$this->vendorNodeService->removeNodeForVendor($entity);
	}

}
