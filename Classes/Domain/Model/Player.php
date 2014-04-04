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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Player extends AbstractEntity {

	/**
	 * Nachname
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $lastname = '';

	/**
	 * Vorname
	 *
	 * @var string
	 */
	protected $firstname = '';

	/**
	 * Trickotname
	 *
	 * @var string
	 */
	protected $shirtname = '';

	/**
	 * Geburtsdatum
	 *
	 * @var \DateTime
	 */
	protected $birthdate = NULL;

	/**
	 * Land
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 */
	protected $country;

	/**
	 * Funktion
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer
	 */
	protected $functionplayer;

	/**
	 * Disziplin
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Discipline>
	 */
	protected $discipline;
	
	/**
	 * file
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $file;

	/**
	 * __construct
	 *
	 * @return Player
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->discipline = new ObjectStorage();
		$this->file = new ObjectStorage();
	}

	/**
	 * Returns the lastname
	 *
	 * @return string $lastname
	 */
	public function getLastname() {
		
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param string $lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		
		$this->lastname = $lastname;
	}

	/**
	 * Returns the firstname
	 *
	 * @return string $firstname
	 */
	public function getFirstname() {
		
		return $this->firstname;
	}

	/**
	 * Sets the firstname
	 *
	 * @param string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		
		$this->firstname = $firstname;
	}

	/**
	 * Returns the shirtname
	 *
	 * @return string $shirtname
	 */
	public function getShirtname() {
		
		return $this->shirtname;
	}

	/**
	 * Sets the shirtname
	 *
	 * @param string $shirtname
	 * @return void
	 */
	public function setShirtname($shirtname) {
		
		$this->shirtname = $shirtname;
	}

	/**
	 * Returns the birthdate
	 *
	 * @return \DateTime $birthdate
	 */
	public function getBirthdate() {
		
		return $this->birthdate;
	}

	/**
	 * Sets the birthdate
	 *
	 * @param \DateTime $birthdate
	 * @return void
	 */
	public function setBirthdate($birthdate) {
		
		$this->birthdate = $birthdate;
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

	/**
	 * Returns the functionplayer
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer $functionplayer
	 */
	public function getFunctionplayer() {
		
		return $this->functionplayer;
	}

	/**
	 * Sets the functionplayer
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer $functionplayer
	 * @return void
	 */
	public function setFunctionplayer(\Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer $functionplayer) {
		
		$this->functionplayer = $functionplayer;
	}

	/**
	 * Adds a Discipline
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 * @return void
	 */
	public function addDiscipline(\Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline) {
		
		$this->discipline->attach($discipline);
	}

	/**
	 * Removes a Discipline
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $disciplineToRemove The Discipline to be removed
	 * @return void
	 */
	public function removeDiscipline(\Volleyballserver\Vsoevvscout\Domain\Model\Discipline $disciplineToRemove) {
		
		$this->discipline->detach($disciplineToRemove);
	}

	/**
	 * Returns the discipline
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Discipline> $discipline
	 */
	public function getDiscipline() {
		
		return $this->discipline;
	}

	/**
	 * Sets the discipline
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Discipline> $discipline
	 * @return void
	 */
	public function setDiscipline(ObjectStorage $discipline) {
		
		$this->discipline = $discipline;
	}
	/**
	 * add a file
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function addFile(FileReference $fileToRemove) {
	
		$this->file->attach($fileToRemove);
	}
	
	/**
	 * Removes a file
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function removeFile(FileReference $fileToRemove) {
	
		$this->file->detach($fileToRemove);
	}
	/**
	 * sets  File
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $file
	 *
	 * @return void
	 */
	public function setFile(ObjectStorage $file) {
		$this->file = $file;
	}
	
	/**
	 * get the Files
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	public function getFile() {
		return $this->file;
	}
}
