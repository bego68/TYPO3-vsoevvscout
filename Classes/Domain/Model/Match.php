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
use Volleyballserver\Vsoevvscout\Domain\Model\Team;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Match extends AbstractEntity {

	/**
	 * Geschlecht
	 *
	 * @var integer
	 */
	protected $gender = 0;

	/**
	 * Spieldatum
	 *
	 * @var \DateTime
	 */
	protected $matchdate = NULL;

	/**
	 * Satz 1 Home
	 *
	 * @var integer
	 */
	protected $homeset1 = 0;

	/**
	 * Satz 2 Home
	 *
	 * @var integer
	 */
	protected $homeset2 = 0;

	/**
	 * Satz 3 Home
	 *
	 * @var integer
	 */
	protected $homeset3 = 0;

	/**
	 * Satz 4 Home
	 *
	 * @var integer
	 */
	protected $homeset4 = 0;

	/**
	 * Satz 5 Home
	 *
	 * @var integer
	 */
	protected $homeset5 = 0;

	/**
	 * Golden SET Home
	 *
	 * @var integer
	 */
	protected $homesetgold = 0;

	/**
	 * Satz 1 Gast
	 *
	 * @var integer
	 */
	protected $guestset1 = 0;

	/**
	 * Satz 2 Gast
	 *
	 * @var integer
	 */
	protected $guestset2 = 0;

	/**
	 * Satz 3 Gast
	 *
	 * @var integer
	 */
	protected $guestset3 = 0;

	/**
	 * Satz 4 Gast
	 *
	 * @var integer
	 */
	protected $guestset4 = 0;

	/**
	 * Satz 5 Gast
	 *
	 * @var integer
	 */
	protected $guestset5 = 0;

	/**
	 * Golden Set Gast
	 *
	 * @var integer
	 * 
	 */
	protected $guestsetgold = 0;

	/**
	 * Disziplin
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Discipline
	 * @lazy
	 */
	protected $discipline;

	/**
	 * Wettbewerb
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Competition
	 * @lazy
	 */
	protected $competition;

	/**
	 * Land Heimteam
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 * @lazy
	 */
	protected $homecountry;

	/**
	 * Kader
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Unit
	 * @lazy
	 */
	protected $unit;

	/**
	 * Altersgruppe
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup
	 * @lazy
	 */
	protected $agegroup;

	/**
	 * Land Gastteam
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 * @lazy
	 */
	protected $guestcountry;

	/**
	 * Farbe Heimmannschaft
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Color
	 * @lazy
	 */
	protected $homecolor;

	/**
	 * Farbe Gastmannschaft
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Color
	 * @lazy
	 */
	protected $guestcolor;

	/**
	 *  Heimmannschaft
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Team
	 * @lazy
	 */
	protected $hometeam;

	/**
	 * Spieler  Gastmannschaft
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Team
	 * @lazy
	 */
	protected $guestteam;
	
	/**
	 * file
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $file;
	
	
	/**
	 * Wetter
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Weather
	 * @lazy
	 */
	protected $weather;

	/**
	 * Sonne
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Sun
	 * @lazy
	 */
	protected $sun;

	/**
	 * Belag
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Surface
	 * @lazy
	 */
	protected $surface;

	/**
	 * Wetkampfort
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Location
	 * @lazy
	 */
	protected $location;

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
	 * Returns the matchdate
	 *
	 * @return \DateTime $matchdate
	 */
	public function getMatchdate() {
		
		return $this->matchdate;
	}

	/**
	 * Sets the matchdate
	 *
	 * @param \DateTime $matchdate
	 * @return void
	 */
	public function setMatchdate($matchdate) {
		
		$this->matchdate = $matchdate;
	}

	/**
	 * Returns the homeset1
	 *
	 * @return integer $homeset1
	 */
	public function getHomeset1() {
		
		return $this->homeset1;
	}

	/**
	 * Sets the homeset1
	 *
	 * @param integer $homeset1
	 * @return void
	 */
	public function setHomeset1($homeset1) {
		
		$this->homeset1 = $homeset1;
	}

	/**
	 * Returns the homeset2
	 *
	 * @return integer $homeset2
	 */
	public function getHomeset2() {
		
		return $this->homeset2;
	}

	/**
	 * Sets the homeset2
	 *
	 * @param integer $homeset2
	 * @return void
	 */
	public function setHomeset2($homeset2) {
		
		$this->homeset2 = $homeset2;
	}

	/**
	 * Returns the homeset3
	 *
	 * @return integer $homeset3
	 */
	public function getHomeset3() {
		
		return $this->homeset3;
	}

	/**
	 * Sets the homeset3
	 *
	 * @param integer $homeset3
	 * @return void
	 */
	public function setHomeset3($homeset3) {
		
		$this->homeset3 = $homeset3;
	}

	/**
	 * Returns the homeset4
	 *
	 * @return integer $homeset4
	 */
	public function getHomeset4() {
		
		return $this->homeset4;
	}

	/**
	 * Sets the homeset4
	 *
	 * @param integer $homeset4
	 * @return void
	 */
	public function setHomeset4($homeset4) {
		
		$this->homeset4 = $homeset4;
	}

	/**
	 * Returns the homeset5
	 *
	 * @return integer $homeset5
	 */
	public function getHomeset5() {
		
		return $this->homeset5;
	}

	/**
	 * Sets the homeset5
	 *
	 * @param integer $homeset5
	 * @return void
	 */
	public function setHomeset5($homeset5) {
		
		$this->homeset5 = $homeset5;
	}

	/**
	 * Returns the homesetgold
	 *
	 * @return integer $homesetgold
	 */
	public function getHomesetgold() {
		
		return $this->homesetgold;
	}

	/**
	 * Sets the homesetgold
	 *
	 * @param integer $homesetgold
	 * @return void
	 */
	public function setHomesetgold($homesetgold) {
		
		$this->homesetgold = $homesetgold;
	}

	/**
	 * Returns the guestset1
	 *
	 * @return integer $guestset1
	 */
	public function getGuestset1() {
		
		return $this->guestset1;
	}

	/**
	 * Sets the guestset1
	 *
	 * @param integer $guestset1
	 * @return void
	 */
	public function setGuestset1($guestset1) {
		
		$this->guestset1 = $guestset1;
	}

	/**
	 * Returns the guestset2
	 *
	 * @return integer $guestset2
	 */
	public function getGuestset2() {
		
		return $this->guestset2;
	}

	/**
	 * Sets the guestset2
	 *
	 * @param integer $guestset2
	 * @return void
	 */
	public function setGuestset2($guestset2) {
		
		$this->guestset2 = $guestset2;
	}

	/**
	 * Returns the guestset3
	 *
	 * @return integer $guestset3
	 */
	public function getGuestset3() {
		
		return $this->guestset3;
	}

	/**
	 * Sets the guestset3
	 *
	 * @param integer $guestset3
	 * @return void
	 */
	public function setGuestset3($guestset3) {
		
		$this->guestset3 = $guestset3;
	}

	/**
	 * Returns the guestset4
	 *
	 * @return integer $guestset4
	 */
	public function getGuestset4() {
		
		return $this->guestset4;
	}

	/**
	 * Sets the guestset4
	 *
	 * @param integer $guestset4
	 * @return void
	 */
	public function setGuestset4($guestset4) {
		
		$this->guestset4 = $guestset4;
	}

	/**
	 * Returns the guestset5
	 *
	 * @return integer $guestset5
	 */
	public function getGuestset5() {
		
		return $this->guestset5;
	}

	/**
	 * Sets the guestset5
	 *
	 * @param integer $guestset5
	 * @return void
	 */
	public function setGuestset5($guestset5) {
		
		$this->guestset5 = $guestset5;
	}

	/**
	 * Returns the guestsetgold
	 *
	 * @return integer $guestsetgold
	 */
	public function getGuestsetgold() {
		
		return $this->guestsetgold;
	}

	/**
	 * Sets the guestsetgold
	 *
	 * @param integer $guestsetgold
	 * @return void
	 */
	public function setGuestsetgold($guestsetgold) {
		
		$this->guestsetgold = $guestsetgold;
	}

	
	/**
	 * Returns the result
	 *
	 * @return string $result
	 */
	public function getresult() {
		$homeset = 0;
		$guestset = 0;
		$result =' (';
		
		if ( ( $this->homeset1 + $this->guestset1) >0 ){
			if ( $this->homeset1 > $this->guestset1) { $homeset++; } else { $guestset++; }
			$result .= ' ' . $this->homeset1 . ':' . $this->guestset1;
		}
		if ( ( $this->homeset2 + $this->guestset2) >0 ){
			if ( $this->homeset2 > $this->guestset2) { $homeset++; } else { $guestset++;}
			$result .= ', ' . $this->homeset2 . ':' . $this->guestset2;
		}
		if ( ( $this->homeset3 + $this->guestset3) >0 ){
			if ( $this->homeset3 > $this->guestset3) {	$homeset++; } else { $guestset++; }
			$result .= ' ' . $this->homeset3 . ':' . $this->guestset3;
		}
		if ( ( $this->homeset4 + $this->guestset4) >0 ){
			if ( $this->homeset4 > $this->guestset4) { $homeset++; } else { $guestset++; }
			$result .= ' ' . $this->homeset4 . ':' . $this->guestset4;
		}		
		if ( ( $this->homeset5 + $this->guestset5) >0 ){
			if ( $this->homeset5 > $this->guestset5) { $homeset++; } else { $guestset++; }
			$result .= ' ' . $this->homeset5 . ':' . $this->guestset5;
		}
		
		$result .= ') ';
		
		if ( ( $this->homesetgolden + $this->guestsetgolden) >0 ){
			$result .= ' golden set:' . $this->homesetgolden . ':' . $this->guestsetgolden;
		}
		
	    $result = $homeset . ':' . $guestset . $result; 	
		
		return $result;
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
	 * Returns the competition
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Competition $competition
	 */
	public function getCompetition() {
		
		return $this->competition;
	}

	/**
	 * Sets the competition
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Competition $competition
	 * @return void
	 */
	public function setCompetition(\Volleyballserver\Vsoevvscout\Domain\Model\Competition $competition) {
		
		$this->competition = $competition;
	}

	/**
	 * Returns the homecountry
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Country $homecountry
	 */
	public function getHomecountry() {
		
		return $this->homecountry;
	}

	/**
	 * Sets the homecountry
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $homecountry
	 * @return void
	 */
	public function setHomecountry(\Volleyballserver\Vsoevvscout\Domain\Model\Country $homecountry) {
		
		$this->homecountry = $homecountry;
	}

	/**
	 * Returns the unit
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Unit $unit
	 */
	public function getUnit() {
		
		return $this->unit;
	}

	/**
	 * Sets the unit
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Unit $unit
	 * @return void
	 */
	public function setUnit(\Volleyballserver\Vsoevvscout\Domain\Model\Unit $unit) {
		
		$this->unit = $unit;
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
	 * Returns the guestcountry
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Country $guestcountry
	 */
	public function getGuestcountry() {
		
		return $this->guestcountry;
	}

	/**
	 * Sets the guestcountry
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $guestcountry
	 * @return void
	 */
	public function setGuestcountry(\Volleyballserver\Vsoevvscout\Domain\Model\Country $guestcountry) {
		
		$this->guestcountry = $guestcountry;
	}

	/**
	 * Returns the homecolor
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Color $homecolor
	 */
	public function getHomecolor() {
		
		return $this->homecolor;
	}

	/**
	 * Sets the homecolor
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Color $homecolor
	 * @return void
	 */
	public function setHomecolor(\Volleyballserver\Vsoevvscout\Domain\Model\Color $homecolor) {
		
		$this->homecolor = $homecolor;
	}

	/**
	 * Returns the guestcolor
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Color $guestcolor
	 */
	public function getGuestcolor() {
		
		return $this->guestcolor;
	}

	/**
	 * Sets the guestcolor
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Color $guestcolor
	 * @return void
	 */
	public function setGuestcolor(\Volleyballserver\Vsoevvscout\Domain\Model\Color $guestcolor) {
		
		$this->guestcolor = $guestcolor;
	}

	/**
	 * Adds a file
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function addFile(FileReference $file) {		
		$this->file->attach($file);
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
	public function setFile($file) {
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
	 * Returns the hometeam
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Team $hometeam
	 */
	public function getHometeam() {
		
		return $this->hometeam;
	}

	/**
	 * Sets the hometeam
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $hometeam
	 * @return void
	 */
	public function setHometeam(Team $hometeam) {
		
		$this->hometeam = $hometeam;
	}

	
	/**
	 * Returns the guestteam
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Team $guestteam
	 */
	public function getGuestteam() {
		
		return $this->guestteam;
	}

	/**
	 * Sets the guestteam
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $guestteam
	 * @return void
	 */
	public function setGuestteam(Team $guestteam) {
		
		$this->guestteam = $guestteam;
	}

	/**
	 * Returns the weather
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Weather $weather
	 */
	public function getWeather() {
		
		return $this->weather;
	}

	/**
	 * Sets the weather
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Weather $weather
	 * @return void
	 */
	public function setWeather(\Volleyballserver\Vsoevvscout\Domain\Model\Weather $weather) {
		
		$this->weather = $weather;
	}

	/**
	 * Returns the sun
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Sun $sun
	 */
	public function getSun() {
		
		return $this->sun;
	}

	/**
	 * Sets the sun
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Sun $sun
	 * @return void
	 */
	public function setSun(\Volleyballserver\Vsoevvscout\Domain\Model\Sun $sun) {
		
		$this->sun = $sun;
	}

	/**
	 * Returns the surface
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Surface $surface
	 */
	public function getSurface() {
		
		return $this->surface;
	}

	/**
	 * Sets the surface
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Surface $surface
	 * @return void
	 */
	public function setSurface(\Volleyballserver\Vsoevvscout\Domain\Model\Surface $surface) {
		
		$this->surface = $surface;
	}

	/**
	 * Returns the location
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Location $location
	 */
	public function getLocation() {
		
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Location $location
	 * @return void
	 */
	public function setLocation(\Volleyballserver\Vsoevvscout\Domain\Model\Location $location) {
		
		$this->location = $location;
	}

	
	
	
}
?>