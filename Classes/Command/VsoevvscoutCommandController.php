<?php
namespace Volleyballserver\Vsoevvscout\Command;
/***************************************************************
 *  Copyright notice
*
*  (c) 2014 Berti Golf <info@berti-golf.de>, volleyballserver.de
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
	use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
	use TYPO3\CMS\Core\Resource\File;
	use TYPO3\CMS\Core\Utility\GeneralUtility;
	use Volleyballserver\Vsoevvscout\Domain\Model\Discipline;
	use Volleyballserver\Vsoevvscout\Domain\Model\Player;
	use Volleyballserver\Vsoevvscout\Domain\Model\Team;
	use Volleyballserver\Vsoevvscout\Domain\Model\Match;
	use Volleyballserver\Vsoevvscout\Domain\Model\Location;
	use Volleyballserver\Vsoevvscout\Domain\Model\AgeGroup;
	use Volleyballserver\Vsoevvscout\Domain\Model\Competition;
	use Volleyballserver\Vsoevvscout\Domain\Model\Country;
	
	
/**
 * Command for TYPO3 schedueller
 *
 * @package Vsoevvscout
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Berti Golf <info@berti-golf.de>
 */
class VsoevvscoutCommandController extends CommandController {
	
    /**
     * PID
     * 
     * @var integer
     */
    protected $pid = 3;
    
    /**
     * errorMessage
     *
     * @var array
     */
    protected $errorMessage = array();
    
    /**
     * FileNamePattern
     * 
     * @var array
     */
    protected $fileNamePattern = array (
    	
    	'Halle' => array(
    			'Match' =>
    				array(
    						'uid' => 0,
    						'kind' => 1,
    						'year' => 2,
    						'month' => 3,
    						'day' => 4,
    						'location' => 5,
    						'competition' => 6,
    						'homecountry' => 7,
    						'guestcountry' => 8,
    				),
    			
    	),
    	'Beach' => array(
    			'Match' =>
    					array(
    						'uid' => 0,
    						'kind' => 1,
    						'year' => 2,
    						'month' => 3,
    						'day' => 4,
    						'location' => 5,
    						'competition' => 6, 
    						'hometeamname' => 7,
    						'guestteamname' => 8,
    			),
    			'Player' =>
    					array(
    							'uid' => 0,
    							'name' => 1,
    			)
    					
    	)
    );
 
    /**
	 * storageRepository
	 *
	 * @var \TYPO3\CMS\Core\Resource\StorageRepository
	 * @inject
	 */
	protected $storageRepository;

	/**
	 * fileRepository
	 *
	 * @var \TYPO3\CMS\Core\Resource\FileRepository
	 * @inject
	 */
	protected $fileRepository;


	/**
	 * MatchRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\MatchRepository
	 * @inject
	 */
	protected $matchRepository;
	
	
	/**
	 * TeamRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\TeamRepository
	 * @inject
	 */
	protected $teamRepository;
	
	/**
	 * playerRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\PlayerRepository
	 * @inject
	 */
	protected $playerRepository;
	
	/**
	 * DisciplineRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\DisciplineRepository
	 * @inject
	 */
	protected $disciplineRepository;
	
	
	/**
	 * LocationRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository;
	
	/**
	 * CountryRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\CountryRepository
	 * @inject
	 */
	protected $countryRepository;
	
	/**
	 * CompetitionRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\CompetitionRepository
	 * @inject
	 */
	protected $competitionRepository;
	
	/**
	 * AgegroupRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\AgegroupRepository
	 * @inject
	 */
	protected $agegroupRepository;

	
	/**
	 * updateFileReferencesCommand
	 *
	 */
	public function updateFileReferencesCommand() {
	
		$storageId = 2;
	
		$fileArray = $this->selectAllFilesWithoutReferenz( $storageId );
		foreach ($fileArray  AS $FileUid){
			$file = $this->fileRepository->findByUid($FileUid['uid']);
			$result = $this->addFileWithInfoFromIdentifier($file);
			If (!result){
				$fehler['header'] = 'scaut.me: Fehler bei der Zuordnung von Dateien ';
				$fehler['body'] = date("d.m.Y - H:i") . ' - ' . $this->errorMessage  ;
				mail('info@berti-golf',$fehler['header'] ,$fehler['body']. 'lg Berti'  );
				//print_r($info);
			}
		}
		return true;
	}
		
	
	/**
	 * addFileWithInfoFromIdentifier
	 * 
	 * array(6) {
	 * 	[0]=> string(0) ""
  	 * 	[1]=>  string(8) "scaut.me"
	 *  [2]=>  string(8) "scaut.me"
	 *  [3]=>  string(5) "Beach"   // Discipline
	 *  [4]=>  string(7) "Matches" // Matches/Teams/Players/
	 *  [5]=>  string(59) "D_2013_08_03_EM_Klagenfurt_LilianaBaquerizo-HoltwickSemmler"
	 *  [6]=>  string(64) "&d_2013_08_02_em_klagenfurt_baquerizoliliana-holtwicksemmler.dvw"
	 * 
	 * 
	 * @param File $file
	 * @return boolean
	 */
	private function addFileWithInfoFromIdentifier($file){
		/** @verg boolean 	 */
		$fileAssosiciated = FALSE;
		
		/** @var array 	 */
		$info = array();

		/** @var string 	 */
		$fileIdentifierWithoutSuffix ='';
		if (substr_count($file->getIdentifier(), '.') >2){
			$fileIdentifierWithoutSuffix = substr($file->getIdentifier(),0, strrpos($file->getIdentifier(), '.'));
		}else{
			$fileIdentifierWithoutSuffix = $file->getIdentifier();
		}
		echo $fileIdentifierWithoutSuffix  . ' ---- ' . $file->getIdentifier() . "\n\n";
		/** @var array 	 */
		$fileIdentifierArray = explode('/', $fileIdentifierWithoutSuffix);

		/** @var Discipline 	 */
		$discipline = $this->getDiszplineFromIdentifier($fileIdentifierArray[3]); //Beach, Halle,...
		if ($discipline != NULL){
			/** @var string 	 */
			$subFolder1 = $fileIdentifierArray[4]; //Matches, Players, Teams
			$subFolder2 = $fileIdentifierArray[5]; // f.e. D_2013_08_03_EM_Klagenfurt_LilianaBaquerizo-HoltwickSemmler 
			switch($subFolder1){
				case 'Matches':	
					$fileAssosiciated = $this->addFileToMatch($file,$subFolder2,$discipline);
					break;
				case 'Teams':
					$fileAssosiciated = $this->addFileToTeam($file,$subFolder2,$discipline);
					break;
				case 'Players':
					$fileAssosiciated = $this->addFileToPlayer($file,$subFolder2,$discipline);
				break;
				default:
					$fileAssosiciated = false;
					$this->errorMessage[] = 'error 1396289866: The file must be in one of the subfolders Matches, Teams or Players ' . $file->getIdentifier();
				
			}		
		}
		return $fileAssosiciated ;
	}


	/**
	 * @param string $subFolder
	 * @param Discipline $discipline
	 * 
	 * @return boolean
	 */
	private function addFileToMatch($file,$subFolder, Discipline $discipline){
		/** @var array */
		$matchProperties = $this->splitSubFolder($subFolder);
		$matchProperties = $this->transformPropertyArray($matchProperties,$discipline,'Match');
		if ($matchProperties['uid']>0){
			$match = $this->matchRepository->findByUid($matchProperties['uid']);
		}else{
			$match = $this->matchRepository->findOneByProperties($matchProperties);
		}
		
		If($match === NULL){
			$match = $this->createMatchWithProperties($matchProperties);
		}
		return $this->insertFilereferenz( $file, $match->getUId(), 'tx_vsoevvscout_domain_model_match');
	}

	/**
	 * 
	 * @param \TYPO3\CMS\Core\Resource\File $file
	 * @param string $subFolder
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 *
	 * @return boolean
	 */
	private function addFileToPlayer(File $file,$subFolder, Discipline $discipline){
		/** @var array */
		$playerProperties = $this->splitSubFolder($subFolder);
		if (is_numeric($playerProperties[0])){
			$name = $playerProperties[0];
			if (intval($playerProperties[0]) > 0 ){
				$player = $this->playerRepository->findByUid($playerProperties[0]);
			}
			else{
				$player = $this->playerRepository->findOneByName($playerProperties[1]);
			}
		}
		else{
			$name = $playerProperties[0];
			$player = $this->playerRepository->findOneByLastname($playerProperties[0]);
		}
		if ($player===NULL){
			$player = new Player();
			$player->setLastname($name);
			$player->setDiscipline($discipline);
			$this->playerRepository->add($player);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
			
		}
		
		return $this->insertFilereferenz( $file, $player->getUId(), 'tx_vsoevvscout_domain_model_player');
	}

	/**
	 * addFileToTeam
	 *
	 * @param \TYPO3\CMS\Core\Resource\File $file
	 * @param string $subFolder
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 *
	 * @return boolean
	 */
	private function addFileToTeam(File $file,$subFolder, Discipline $discipline){
		/** @var array */
		$teamProperties = $this->splitSubFolder($subFolder);
		if (is_numeric($teamProperties[0])){
			$name = $teamProperties[1];
			if (intval($teamProperties[0]) > 0 ){
				$team = $this->teamRepository->findByUid($teamProperties[0]);
			}
			else{
				$team = $this->teamRepository->findOneByName($teamProperties[1]);
			}
		}
		else{
			$name = $teamProperties[0];
			
			$team = $this->teamRepository->findOneByName($teamProperties[0]);
		}
		if ($team===NULL){
			$team = new Team();
			$team->setName($name);
			$team->setPid($this->pid);
			$team->setDiscipline($discipline);
			$this->teamRepository->add($team);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
				
		}
	
		return $this->insertFilereferenz( $file, $team->getUId(), 'tx_vsoevvscout_domain_model_team');
	}
	
	/**
	 * SPLIT SUBFOLDER 
	 * 
	 * @param string $subfolder
	 * 
	 * @return array 
	 */
	private function splitSubFolder($subFolder){
		/** @var array */
		$properties = array();
		
		$subFolder = strtoupper(ltrim(str_replace('-','_', $subFolder), '&'));  //trim & from datavolleyfiles
		$properties  = explode('_', $subFolder);
		if (is_numeric($properties[0])===false){
			$properties = array_merge(array('0'), $properties);  
		}
		return $properties;
	}
	
	/**
	 * 
	 * @param File $file
	 * @param integer $uidForeign
	 * @param string $tablenames
	 */
	private function insertFilereferenz( File $file, $uidForeign=0, $tablenames='tx_qualinet2012_domain_model_veranstaltungen'){
		$insertArray =array(
				'uid_local' =>  $file->getUid(),
				'uid_foreign'=> $uidForeign,
				'tablenames'=> $tablenames,
				'pid'=> $this->pid,
				'fieldname'=> 'files',
				'sorting_foreign'=> 1,
				'table_local'=> 'sys_file',
				'title'=> $file->getProperty('title'),
				'description'=>  $file->getProperty('description')
		);
	
		$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_file_reference', $insertArray);
	}
		
	/**
	 * 
	 * @param integer $storageId
	 * @param string $searchPattern
	 * @return unknown
	 */
	private function selectAllFilesWithoutReferenz( $storageId = 2, $searchPattern='/scaut.me%' ){
		
		$selectFields = 'uid';
		$fromTable    = 'sys_file';
		$whereClause  = '(missing=0) AND (`storage`= ' . $storageId . ' ) AND identifier not like "%.DAV%" AND identifier like "' . $searchPattern . '"  AND sys_file.uid not in (SELECT sys_file_reference.uid_local from sys_file_reference)';
		$groupBy      = '';
		$orderBy      = ''; // 'field(uid,' . $orderedUidList . ')';
		$limit        = '';
		
		$recordList = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows( 
														$selectFields
														, $fromTable
														, $whereClause
														, $groupBy
														, $orderBy
														, $limit
														);
	
		return $recordList;
	}
	
	
	/**
	 * 
	 * @param string $short
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Discipline
	 */
	private  function getDiszplineFromIdentifier($short){
		$discipline = $this->disciplineRepository->findOneByShort($short);
		if (!isset($discipline) and $short!=''){
			$discipline = new Discipline;
			$discipline->setShort($short);
			$discipline->setName($short);
			$discipline->setPid($this->pid);
			$discipline = $this->disciplineRepository->add($discipline);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}	
		return $discipline;		
	}
	
	/**
	 * 
	 * @param string $properties
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Match
	 */
	private  function createMatchWithProperties($properties){

		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Match */
		$match = new Match();
		$match->setPid($this->pid);
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Location */
		$location = $this->getLocation($properties['location']);
		$match->setLocation($location);
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Discipline */
		$discipline = $properties['discipline'];
		$match->setDiscipline($discipline);
		/** @var integer*/
		$gender = $properties['gender'];
		$match->setGender($gender);
		/** @var /dateTime*/
		$matchdate = $properties['matchdate'];
		$match->setMatchdate($matchdate);
		if ($properties['agegroup']){
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup */
			$agegroup = $this->getAgegroup($properties['agegroup']);
			$match->setAgegroup($agegroup);
		}else{
			$agegroup=NULL;
		}
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Competition */
		$competition = $this->getCompetition($properties['competition'],$discipline);
		$match->setCompetition($competition);
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Country */
		
		if ($properties['homecountry']){
			$homecountry = $this->getCountry($properties['homecountry']);
			$match->setHomecountry($homecountry);
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Country */
			$guestcountry = $this->getCountry($properties['guestcountry']);
			$match->setGuestcountry($guestcountry);
			
			
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Team */
			$homeTeam = $this->getTeam($discipline,$gender,$agegroup,$homecountry);
			$match->setHometeam($homeTeam);
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Team */
			$guestTeam = $this->getTeam($discipline,$gender,$agegroup,$guestcountry);
			$match->setGuestteam($guestTeam);
		}
		
		if ($properties['hometeamname']){
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Team */
			$homeTeam = $this->getTeam($discipline,$gender,$agegroup,NULL,$properties['hometeamname']);
			$match->setHometeam($homeTeam);
			/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Team */
			$guestTeam = $this->getTeam($discipline,$gender,$agegroup,NULL,$properties['guestteamname']);
			$match->setGuestteam($guestTeam);
			
		}

		
		$this->matchRepository->add($match);
		$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();
		
		return $match;
	}
	
	/**
	 * 
	 * @param string $location
	 */
	private  function getLocation($locationShort=''){
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Location */
		$location = $this->locationRepository->findOneByShort($locationShort);
		If ($location===NULL){
			$location = new Location();
			$location->setPid($this->pid);
			$location->setShort($locationShort);
			$location->setName($locationShort);
			$this->locationRepository->add($location);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}
		return $location;
	}
	
	/**
	 *
	 * @param string $agegroup
	 */
	private  function getAgegroup($agegroupShort=''){
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup */
		$agegroup = $this->agegroupRepository->findOneByShort($agegroupShort);
		If ($agegroup===NULL){
			$agegroup = new agegroup();
			$agegroup->setPid($this->pid);
			$agegroup->setShort($agegroupShort);
			$agegroup->setName($agegroupShort);
			$this->agegroupRepository->add($agegroup);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}

		return $agegroup;
	}
	/**
	 *
	 * @param string $countryCode
	 */
	private  function getCountry($countryCode=''){
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Country */
		$country = $this->countryRepository->findOneByCode($countryCode);
		If ($country===NULL){
			$country = new country();
			$country->setPid($this->pid);
			$country->setCode($countryCode);
			$country->setName($countryCode);
			$this->countryRepository->add($country);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}
		return $country;
	}

	/**
	 *
	 * 
	 * @param  \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 * @param integer $gender
	 * @param  \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup $agegroup
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country
	 * 
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Team
	*/
	private  function getTeam(Discipline $discipline,$gender,Agegroup $agegroup=NULL,$country=NULL,$name=NULL ){
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Team */
		If($country){
			$team = $this->teamRepository->findOneByCountryDisciplineGenderAgegroup($country,$discipline,$gender,$agegroup);
		}else{
			$team = $this->teamRepository->findOneByDisciplineGenderName($discipline,$gender,$name);
		}
		If ($team===NULL){
			$team = new team();
			$team->setPid($this->pid);
			if ($country){
				$team->setCountry($country);
				if ($gender===1){
					$genderName = Men;
				}else{
					$genderName = Women;
				}
				$team->setName($country->getName(). ' ' . $genderName . ' ' . $agegroup->getName() );
				$team->setAgegroup($agegroup);
			}else{
				$team->setName($name);
			}
				$team->setGender($gender);
				$team->setDiscipline($discipline);
				

			$this->teamRepository->add($team);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}
		return $team;
	}

	/**
	 *
	 * @param string $competition
	 * @param  \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 *
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Competition
	 */
	private  function getCompetition($competitionShort='', Discipline $discipline ){
		/** @var \Volleyballserver\Vsoevvscout\Domain\Model\Competition */
		$competition = $this->competitionRepository->findOneByShortAndDiscipline($competitionShort,$discipline);
		If ($competition===NULL){
			$competition = new competition();
			$competition->setPid($this->pid);
			$competition->setShort($competitionShort);
			$competition->setName($competitionShort);
			$competition->setDiscipline($discipline);
			$this->competitionRepository->add($competition);
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
		}
		return $competition;
	}
	
	
	/**
	 * 
	 * @param array $propertyArray
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 * @return multitype:unknown
	 */
	private function transformPropertyArray($propertyArray=array(), Discipline $discipline, $art = 'Match'){;
		/**var array() */
		$transformedArray =array();
		foreach( $this->fileNamePattern[$discipline->getShort()][$art] as $key => $index ){
			$transformedArray[$key] =  $propertyArray[$index];			
		}
		
		if($transformedArray['kind'][0]==='V'){ //Halle
			if ($transformedArray['kind'][1] === 'M'){
				$transformedArray['gender'] = 1;
			}else{
				$transformedArray['gender'] = 2;
			}
			$transformedArray['agegroup'] = substr($transformedArray['kind'], 2, 2);
		}else{ //Beach
			if ($transformedArray['kind'][0] === 'H'){
				$transformedArray['gender'] = 1;
			}else{
				$transformedArray['gender'] = 2;
			}
			$transformedArray['agegroup'] = substr($transformedArray['kind'], 1, 2);
		}
		$transformedArray['matchdate'] = new \DateTime($transformedArray['year'] .'-' . $transformedArray['month'] . '-' . $transformedArray['day']);
		$transformedArray['discipline'] = $discipline;
		return $transformedArray;
	}
	
	

}