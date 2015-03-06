<?php
namespace Wwwision\Neos\Vendors\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Wwwision.Neos.Vendors". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Wwwision\Neos\FrontendLogin\Domain\Model\User;

/**
 * A simple vendor that is bound to a "frontend user"
 *
 * @Flow\Entity
 */
class Vendor {

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var User
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\ManyToOne
	 */
	protected $owner;

	/**
	 * @param User $owner
	 * @return void
	 */
	public function setOwner(User $owner) {
		$this->owner = $owner;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return User
	 */
	public function getOwner() {
		return $this->owner;
	}
}