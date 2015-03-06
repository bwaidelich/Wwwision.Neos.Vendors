<?php
namespace Wwwision\Neos\Vendors\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Wwwision.Neos.Vendors". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryResultInterface;
use TYPO3\Flow\Persistence\Repository;
use Wwwision\Neos\FrontendLogin\Domain\Model\User;

/**
 * @Flow\Scope("singleton")
 */
class VendorRepository extends Repository {

	/**
	 * @param User $owner
	 * @return QueryResultInterface
	 */
	public function findByOwner(User $owner) {
		$query = $this->createQuery();
		return
			$query->matching(
				$query->equals('owner', $owner)
			)
			->execute();
	}

}