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
    						'year' => 1,
    						'month' => 1,
    						'day' => 3,
    						'location' => 4,
    						'competition' => 5, 
    						'hometeam.name' => 6,
    						'guestteam.name' => 7,
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
	 * getFileInfoFromIdentifier
	 * 
	 * array(6) {
	 * 	[0]=> string(0) ""
  	 * 	[1]=>  string(8) "scaut.me"
	 *  [2]=>  string(8) "scaut.me"
	 *  [3]=>  string(5) "Beach"   // Discipline
	 *  [4]=>  string(7) "Matches" // Matches/Teams/Players/
	 *  [5]=>  string(59) "D_2013_08_03_EM_Klagenfurt_LilianaBaquerizo-HoltwickSemmler"
	 *  [6]=>  string(64) "&d_2013_08_02_em_klagenfurt_baquerizoliliana-holtwicksemmler.dvw"
}

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

		/** @var array 	 */
		$fileIdentifierArray = explode('/', $file->getIdentifier());
		
		/** @var Discipline 	 */
		$discipline = $this->getDiszplineFromIdentifier($fileIdentifierArray[3]); //Beach, Halle,...
		
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
				$error[] = 'error 1396289866: The file must be in one of the subfolders Matches, Teams or Players ' . $file->getIdentifier();
			
		}		
		
		var_dump($fileIdentifierArray); die('Hallo');
				
		return $fileAssosiciated ;
	}
	
	
	/**
	 * @var string $subFolder
	 * @var Discipline $discipline
	 * 
	 * @return boolean
	 */
	private function addFileToMatch($file,$subFolder, Discipline $discipline){
		/** @var array */
		$matchProperties = $this->splitSubFolder($subFolder);
		$matchProperties = $this->transformPropertyArray($matchProperties,$discipline,'Match');
		if ($matchProperties['uid']>0){
			$match = $this->matchRepository->findByUid($matchProperties['uid']);
		}
		echo $match->getUid();
		print_r($matchProperties);die();
	}

	/**
	 * 
	 * @param \TYPO3\CMS\Core\Resource\File $file
	 * @var string $subFolder
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
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
			$persistenceManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
			$persistenceManager->persistAll();
			
		}
		
		return $this->insertFilereferenz( $file, $player->getUId(), 'tx_vsoevvscout_domain_model_player');
	}
	
	/**
	 * SPLIT SUBFOLDER 
	 * 
	 * @var string $subfolder
	 * 
	 * @return array 
	 */
	private function splitSubFolder($subFolder){
		/** @var array */
		$poperties = array();
		
		$subFolder = ltrim($subFolder, '&');  //trim & from datavolleyfiles
		$poperties  = explode('_', $subFolder);
		if (is_numeric($properties[0]===FALSE)){
			$poperties = array_merge(array(0), $poperties); 
		}

		return $poperties;
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
				'fieldname'=> 'file',
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
		$whereClause  = '(missing=0) AND (`storage`= ' . $storageId . ' ) AND identifier like "' . $searchPattern . '"  AND sys_file.uid not in (SELECT sys_file_reference.uid_local from sys_file_reference)';
		$groupBy      = '';
		$orderBy      = ''; // 'field(uid,' . $orderedUidList . ')';
		$limit        = '';
		
		$recordList = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows( $selectFields
                                                      , $fromTable
                                                      , $whereClause
                                                      , $groupBy
                                                      , $orderBy
                                                      , $limit
                                                      );
	
		return $recordList;
	}
	
	/**
	 * updateFileReferencesCommand
	 * 
	 */
	public function updateFileReferencesCommand() {
	
		$storageId = 2;
		
		$fileArray = $this->selectAllFilesWithoutReferenz( $storageId );		
		foreach ($fileArray  AS $FileUid){
			$file = $this->fileRepository->findByUid($FileUid['uid']);
			
			If (!$this->addFileWithInfoFromIdentifier($file)){
				$fehler['header'] = 'scaut.me: Fehler: ' . $info['error'];
				$fehler['body'] = date("d.m.Y - H:i") . ' - ' . implode(",", $info)  ;
				mail('info@berti-golf',$fehler['header'] ,$fehler['body']. 'lg Berti'  );
				//print_r($info);
			}	
				
			
		}				
		return true;
	}
	
	/**
	 * 
	 * @param string $short
	 * @return \Volleyballserver\Vsoevvscout\Domain\Model\Discipline
	 */
	private  function getDiszplineFromIdentifier($short){
		$discipline = $this->disciplineRepository->findOneByShort($short);
		if (!isset($discipline)){
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
	 * @param array $propertyArray
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Discipline $discipline
	 * @return multitype:unknown
	 */
	private function transformPropertyArray($propertyArray=array(), Discipline $discipline, $art = 'Match'){
		/**var array() */
		$transformedArray =array();
		foreach( $this->fileNamePattern[$discipline->getShort()][$art] as $key => $index ){
			$transformedArray[$key] = $propertyArray[$index];			
		}		
		return $transformedArray;
	}
	
}