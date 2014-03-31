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
	use \TYPO3\CMS\Core\Utility\GeneralUtility;
	use Volleyballserver\Vsoevvscout\Domain\Model\Discipline;
	
	
	
/**
 * Comand for TYPO3 schedueller
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
    protected $pid=3;
    
    
    protected FileNamePattern = array (
    	
    	'Halle' => array(
    			array('Match' =>
    				array(
    						uid => 0,
    						kind => 1,
    						year => 2,
    						month => 3,
    						day => 4,
    						location => 5,
    						competition => 6,
    						homecountry => 7,
    						guestcountry => 7,
    						)
    			)
    	)
    	'Beach' => array(
    			array('Match' =>
    					array(
    						uid => 0,
    						kind => 1,
    						year => 2,
    						month => 3,
    						day => 4,
    						location => 5,
    						competition => 6,
    						hometeam.name => 7,
    						guestteam.name=> 7,
    						)
    			)
    					
    			)
    	)
        		
    		
    )
    }
    
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
	 * @var TYPO3\CMS\Core\Resource\FileRepository
	 * @inject
	 */
	protected $fileRepository;


	/**
	 * MatchRepository
	 *
	 * @var Volleyballserver\Vsoevvscout\Domain\Repository\MatchRepository
	 * @inject
	 */
	protected $matchRepository;
	
	
	/**
	 * TeamRepository
	 *
	 * @var Volleyballserver\Vsoevvscout\Domain\Repository\TeamRepository
	 * @inject
	 */
	protected $teamRepository;
	
	/**
	 * playerRepository
	 *
	 * @var Volleyballserver\Vsoevvscout\Domain\Repository\PlayerRepository
	 * @inject
	 */
	protected $playerRepository;
	
	/**
	 * DisciplineRepository
	 *
	 * @var Volleyballserver\Vsoevvscout\Domain\Repository\DisciplineRepository
	 * @inject
	 */
	protected $disciplineRepository;
	
	// public function initialize

	/**
	 * array(6) {
	 * 	[0]=> string(0) ""
  	 * 	[1]=>  string(8) "scaut.me"
	 *  [2]=>  string(8) "scaut.me"
	 *  [3]=>  string(5) "Beach"   // Diszipline
	 *  [4]=>  string(7) "Matches" // Matches/Teams/Players/
	 *  [5]=>  string(59) "D_2013_08_03_EM_Klagenfurt_LilianaBaquerizo-HoltwickSemmler"
	 *  [6]=>  string(64) "&d_2013_08_02_em_klagenfurt_baquerizoliliana-holtwicksemmler.dvw"
}

	 * 
	 * 
	 * @param File $file
	 * @return array
	 */
	private function getFileInfoFromIdentifier($file){
		
		/** @var array 	 */
		$info = array();

		/** @var array 	 */
		$fileIdentifierArray = explode('/', $file->getIdentifier());
		
		/** @var Diszipline 	 */
		$diszipline = $this->getDiszplineFromIdentifier($fileIdentifierArray[3]);
		
		
		var_dump($fileIdentifierArray); die('Hallo');
		
		$info = array();
		$info['jahr'] = $fileInfoArr[1];
		$info['interneid'] = $fileInfoArr[2];
		//$_GET['DEBUGSQL'] = 1;
		$veranstaltung = $this->veranstaltungenRepository->findOneByInterneid($info['interneid']);
		
		if( $veranstaltung ){
			
			switch($fileInfoArr[3]){
				case 'Referenten':
					$info['art'] = $fileInfoArr[3];
					$info['tablenames'] = 'tx_qualinet2012_domain_model_referenten';				
					
					$userInfoArr = explode('_', $fileInfoArr[4]);
					$info['ref'] = $userInfoArr[0];
					$info['ref_name'] = $userInfoArr[1];
					$info['file'] = $fileInfoArr[5];
					$feuser = $this->feuserRepository->findOneByNavid($info['ref']);		
								
					if ($feuser){						
						$referent = $this->referentenRepository->findByFeuserAndVeranstaltung( $feuser , $veranstaltung);
						if ( $referent){
							$info['uidForeign'] =$referent->getUid();
						}
						else{
							$info['error'] = 'keine Referenz zu diesem file gefunden';
							$info['uidForeign'] = 0;
						}
					}
					else{
						return array( 
							'error'=>'kein Feuser zu diesem file gefunden',
							'info'=>$fileInfoArr
						);
					}
					
					break;
					
				case 'Teilnehmer':
					$info['art'] = $fileInfoArr[3];
					$info['tablenames'] = 'tx_qualinet2012_domain_model_buchungen';
					$userInfoArr = explode('_', $fileInfoArr[4]);
					$info['tn'] = $userInfoArr[0];
					$info['tn_name'] = $userInfoArr[1];	
					$info['file'] = $fileInfoArr[5];
					
					$feuser = $this->feuserRepository->findOneByNavid($info['tn']);	
					if ($feuser){			
						$buchung = $this->buchungenRepository->findByTeilnehmerAndVeranstaltung( $feuser,$veranstaltung);
						if ( $buchung ){
							$info['uidForeign'] = $buchung->getUid();
						}
						else{
							$info['error'] = 'keine Buchung zu diesem file gefunden';
							$info['uidForeign'] = 0;
							
						}
					}
					else{
						$info['error'] = 'keine Feuser zu diesem file gefunden';
						$info['uidForeign'] = 0;						
					}						
										
					
					break;
					
				case 'Veranstaltungsorte': 	
					$_GET['DEBUGSQL'] = 1;
					$info['art'] = $fileInfoArr[3];
					$info['tablenames'] = 'tx_qualinet2012_domain_model_ort';
					$userInfoArr = explode('_', $fileInfoArr[4]);
					$info['ort'] = $userInfoArr[0];
					$info['ort_name'] = $userInfoArr[1];						
					$info['file'] = $fileInfoArr[5];
					$ort = $this->ortRepository->findOneByNavid( $info['ort']  );
					if ( $ort ){
						$info['uidForeign'] = $ort ->getUid();
					}
					else{
						$info['error'] = 'keine Ort zu diesem file gefunden';
						$info['uidForeign'] = 0;
					}															
					
					break;
				
					
				default:
					$info['art'] = 'Veranstaltungen';
					$info['tablenames'] = 'tx_qualinet2012_domain_model_veranstaltungen';
					$info['interneid'] = $fileInfoArr[2];
					$info['file'] = $fileInfoArr[3];				
					$info['uidForeign'] = $veranstaltung->getUid();						
			}
			
		}else{			
			$info['error'] = 'keine Veranstaltung zu diesem file gefunden';
			$info['uidForeign'] = 0;
			$info['tablenames'] = 'tx_qualinet2012_domain_model_veranstaltungen';
		}	

		return $info;
	}
	
	/**
	 * 
	 * @param File $file
	 * @param integer $uidForeign
	 * @param string $tablenames
	 */
	private function insertFilereferenz( File $file, $uidForeign=0, $tablenames=tx_qualinet2012_domain_model_veranstaltungen){
		$insertArray =array(
				'uid_local' =>  $file->getUid(),
				'uid_foreign'=> $uidForeign,
				'tablenames'=> $tablenames,
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
	 * 
	 */
	public function updateFileReferencesCommand() {
	
		$storageId = 2;
		
		$fileArray = $this->selectAllFilesWithoutReferenz( $storageId );		
		foreach ($fileArray  AS $FileUid){
			$file = $this->fileRepository->findByUid($FileUid['uid']);
			
			$info = $this->getFileInfoFromIdentifier($file);
			
				
			If ($info['error']){
				$fehler['header'] = 'scaut.me: Fehler: ' . $info['error'];
				$fehler['body'] = date("d.m.Y - H:i") . ' - ' . implode(",", $info)  ;
				mail('info@berti-golf',$fehler['header'] ,$fehler['body']. 'lg Berti'  );
				//print_r($info);
			}	
				
				$this->insertFilereferenz(  $file, $info['uidForeign'],$info['tablenames'] );			
		}				
		return true;
	}
	
	/**
	 * 
	 * @param string $short
	 * @return Diszipline
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
}