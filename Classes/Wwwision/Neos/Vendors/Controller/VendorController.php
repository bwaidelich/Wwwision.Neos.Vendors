<?php
namespace Wwwision\Neos\Vendors\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Security\Context;
use Wwwision\Neos\FrontendLogin\Domain\Model\User;
use Wwwision\Neos\FrontendLogin\Domain\Service\UserService;
use Wwwision\Neos\Vendors\Domain\Model\Vendor;
use Wwwision\Neos\Vendors\Domain\Repository\VendorRepository;

/**
 * Controller for managing vendors (used in the VendorAdministration plugin)
 */
class VendorController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var VendorRepository
	 */
	protected $vendorRepository;

	/**
	 * @Flow\Inject
	 * @var Context
	 */
	protected $securityContext;

	/**
	 * @var User
	 */
	protected $currentUser;

	/**
	 * @Flow\Inject
	 * @var UserService
	 */
	protected $userService;

	/**
	 * @param ViewInterface $view The view to be initialized
	 * @return void
	 */
	protected function initializeView(ViewInterface $view) {
		$this->currentUser = $this->userService->getCurrentUser();
		$view->assign('currentUser', $this->currentUser);
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		if ($this->currentUser !== NULL) {
			$this->view->assign('vendors', $this->vendorRepository->findByOwner($this->currentUser));
		}
	}

	/**
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * @param Vendor $vendor
	 * @return void
	 */
	public function createAction(Vendor $vendor) {
		$this->vendorRepository->add($vendor);

		$this->addFlashMessage('The vendor "%s" has been created', 'Vendor created', Message::SEVERITY_OK, array($vendor->getName()));
		$this->redirect('index');
	}


	/**
	 * @param Vendor $vendor
	 * @return void
	 */
	public function editAction(Vendor $vendor) {
		$this->view->assign('vendor', $vendor);
	}

	/**
	 * @param Vendor $vendor
	 * @return void
	 */
	public function updateAction(Vendor $vendor) {
		$this->vendorRepository->update($vendor);

		$this->addFlashMessage('The vendor "%s" has been updated', 'Vendor updated', Message::SEVERITY_OK, array($vendor->getName()));
		$this->redirect('index');
	}

	/**
	 * @param Vendor $vendor
	 * @return void
	 */
	public function deleteAction(Vendor $vendor) {
		$this->vendorRepository->remove($vendor);

		$this->addFlashMessage('The vendor "%s" has been removed', 'Vendor removed', Message::SEVERITY_NOTICE, array($vendor->getName()));
		$this->redirect('index');
	}

	/**
	 * Disable the technical error flash message
	 *
	 * @return boolean
	 */
	protected function getErrorFlashMessage() {
		return FALSE;
	}
}