<?php
namespace Wwwision\Neos\Vendors\Domain\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Wwwision.Neos.Vendors". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Neos\Service\NodeNameGenerator;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\TYPO3CR\Domain\Model\NodeTemplate;
use TYPO3\TYPO3CR\Domain\Service\ContextFactoryInterface;
use TYPO3\TYPO3CR\Domain\Service\NodeTypeManager;
use Wwwision\Neos\Vendors\Domain\Model\Vendor;

/**
 * The central authority to interact with "vendor nodes"
 *
 * @Flow\Scope("singleton")
 */
class VendorNodeService {

	/**
	 * @Flow\Inject
	 * @var ContextFactoryInterface
	 */
	protected $contentContextFactory;

	/**
	 * @Flow\Inject
	 * @var NodeTypeManager
	 */
	protected $nodeTypeManager;

	/**
	 * @Flow\Inject
	 * @var NodeNameGenerator
	 */
	protected $nodeNameGenerator;

	/**
	 * The absolute path of the node to create "vendor nodes" in (see Settings.yaml)
	 *
	 * @Flow\InjectConfiguration("vendorsParentNodePath")
	 * @var string
	 */
	protected $vendorsParentNodePath;

	/**
	 * Create a new vendor node bound to the given $vendor
	 *
	 * @param Vendor $vendor
	 * @return void
	 */
	public function createNodeForVendor(Vendor $vendor) {
		$vendorsParentNode = $this->getVendorsParentNode();

		$vendorNode = new NodeTemplate();
		$vendorNode->setName($this->nodeNameGenerator->generateUniqueNodeName($vendorsParentNode, $vendor->getName()));
		$vendorNode->setNodeType($this->nodeTypeManager->getNodeType('Wwwision.Neos.Vendors:Vendor'));
		$vendorNode->setProperty('vendor', $vendor);

		$vendorsParentNode->createNodeFromTemplate($vendorNode);
	}

	/**
	 * Update the vendor node that is bound to the given $vendor
	 *
	 * @param Vendor $vendor
	 * @return void
	 */
	public function updateNodeForVendor(Vendor $vendor) {
		$vendorNode = $this->getVendorNodeByVendor($vendor);
		if ($vendorNode === NULL) {
			// TODO throw exception?
			return;
		}
		// Note: Usually the following line doesn't have any effect apart from flushing the content cache for the affected vendor node!
		$vendorNode->setProperty('vendor', $vendor);
	}

	/**
	 * Delete the vendor node that is bound to the given $vendor
	 *
	 * @param Vendor $vendor
	 * @return void
	 */
	public function removeNodeForVendor(Vendor $vendor) {
		$vendorNode = $this->getVendorNodeByVendor($vendor);
		if ($vendorNode === NULL) {
			// TODO throw exception?
			return;
		}
		$vendorNode->remove();
	}

	/**
	 * @return NodeInterface
	 */
	protected function getVendorsParentNode() {
		$contentContext = $this->contentContextFactory->create();
		return $contentContext->getNode($this->vendorsParentNodePath);
	}

	/**
	 * @param Vendor $vendor
	 * @return NodeInterface
	 */
	protected function getVendorNodeByVendor(Vendor $vendor) {
		$vendorsParentNode = $this->getVendorsParentNode();
		/** @var NodeInterface $vendorNode */
		foreach ($vendorsParentNode->getChildNodes('Wwwision.Neos.Vendors:Vendor') as $vendorNode) {
			if ($vendorNode->getProperty('vendor') === $vendor) {
				return $vendorNode;
			}
		}
		return NULL;
	}
}
