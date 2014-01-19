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
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Ort
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $city = '';

	/**
	 * PLZ
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * Straße
	 *
	 * @var string
	 */
	protected $street = '';

	/**
	 * Land
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 */
	protected $country;

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		
		$this->city = $city;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		
		$this->zip = $zip;
	}

	/**
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		
		$this->street = $street;
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