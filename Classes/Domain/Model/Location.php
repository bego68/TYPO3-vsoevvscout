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
class Location extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Bezeichnung
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Kurzbezeichnung
	 *
	 * @var string
	 */
	protected $short = '';

	/**
	 * Adresse
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Address
	 */
	protected $address;

	/**
	 * Land
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 */
	protected $country;

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
	 * Returns the short
	 *
	 * @return string $short
	 */
	public function getShort() {
		
		return $this->short;
	}

	/**
	 * Sets the short
	 *
	 * @param string $short
	 * @return void
	 */
	public function setShort($short) {
		
		$this->short = $short;
	}

	/**
	 * Returns the address
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Address $address
	 */
	public function getAddress() {
		
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Address $address
	 * @return void
	 */
	public function setAddress(\Volleyballserver\Vsoevvscout\Domain\Model\Address $address) {
		
		$this->address = $address;
	}

	/**
	 * Returns the country
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Country $country
	 */
	public function getCountry() {
		
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $country
	 * @return void
	 */
	public function setCountry(\Volleyballserver\Vsoevvscout\Domain\Model\Country $country) {
		
		$this->country = $country;
	}

}
?>