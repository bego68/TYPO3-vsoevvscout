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
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use \TYPO3\CMS\Extbase\Domain\Model\FileReference;
use Volleyballserver\Vsoevvscout\Domain\Model\Player;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Team extends AbstractEntity {

	/**
	 * Geschlecht
	 *
	 * @var integer
	 */
	protected $gender = 0;
		
	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = '';

	
	/**
	 * Disziplin
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Discipline
	 * @lazy
	 */
	protected $discipline;

	/**
	 * Land
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 * @lazy
	 */
	protected $country;


	/**
	 * Altersgruppe
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup
	 * @lazy
	 */
	protected $agegroup;

	
	/**
	 * file
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $file;
	
	/**
	 * player
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Player>
	 * @lazy
	 */
	protected $player;
	

	/**
	 * __construct
	 *
	 * @return Match
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
		$this->file = new ObjectStorage();
		$this->player = new ObjectStorage();
		
	}

	/**
	 * Returns the gender
	 *
	 * @return integer $gender
	 */
	public function getGender() {
		
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param integer $gender
	 * @return void
	 */
	public function setGender($gender) {
		
		$this->gender = $gender;
	}

	

	/**
	 * Returns the name
	 *
	 * @return integer $name
	 */
	public function getName() {
		
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param integer $name
	 * @return void
	 */
	public function setName($name) {
		
		$this->name = $name;
	}

		
	/**
	 * Returns the discipline
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 */
	public function getDiscipline() {		
		return $this->discipline;
	}

	/**
	 * Sets the discipline
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 * @return void
	 */
	public function setDiscipline(\Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline) {
		
		$this->discipline = $discipline;
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
	 * Returns the agegroup
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup $agegroup
	 */
	public function getAgegroup() {
		
		return $this->agegroup;
	}

	/**
	 * Sets the agegroup
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup $agegroup
	 * @return void
	 */
	public function setAgegroup(\Volleyballserver\Vsoevvscout\Domain\Model\Agegroup $agegroup) {
		
		$this->agegroup = $agegroup;
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
	
	
	/**
	 * add a player
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Player $player
	 * @return void
	 */
	public function addPlayer(Player $playerToRemove) {
	
		$this->player->attach($playerToRemove);
	}
	
	/**
	 * Removes a player
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Player $player
	 * @return void
	 */
	public function removePlayer(Player $playerToRemove) {
	
		$this->player->detach($playerToRemove);
	}
	/**
	 * sets  Player
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Player> $player
	 *
	 * @return void
	 */
	public function setPlayer(ObjectStorage $player) {
		$this->player = $player;
	}
	
	/**
	 * get the Players
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Volleyballserver\Vsoevvscout\Domain\Model\Player>
	 */
	public function getPlayer() {
		return $this->player;
	}
}