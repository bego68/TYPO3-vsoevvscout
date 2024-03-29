<?php
namespace Volleyballserver\Vsoevvscout\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Berti Golf <info@berti-golf.de>, volleybalserver.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Country extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Land
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name = '';

	/**
	 * Code
	 *
	 * @var string
	 */
	protected $code = '';

	/**
	 * Iso
	 *
	 * @var string
	 */
	protected $iso = '';
	
	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		
		$this->name = $name;
	}

	/**
	 * Returns the code
	 *
	 * @return string $code
	 */
	public function getCode() {
		
		return $this->code;
	}

	/**
	 * Sets the code
	 *
	 * @param string $code
	 * @return void
	 */
	public function setCode($code) {
		
		$this->code = $code;
	}

	/**
	 * Returns the iso
	 *
	 * @return string $iso
	 */
	public function getIso() {
	
		return $this->iso;
	}
	
	/**
	 * Returns the iso lowercase
	 *
	 * @return string $iso
	 */
	public function getIsolower() {
	
		return strtolower($this->iso);
	}
	
	/**
	 * Sets the iso
	 *
	 * @param string $iso
	 * @return void
	 */
	public function setIso($iso) {
	
		$this->iso = $iso;
	}
}