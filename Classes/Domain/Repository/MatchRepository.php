<?php
namespace Volleyballserver\Vsoevvscout\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Repository;
use Volleyballserver\Vsoevvscout\Service\UserRights;
use Volleyballserver\Vsoevvscout\Domain\Model\Player;
use Volleyballserver\Vsoevvscout\Domain\Model\Team;
use Volleyballserver\Vsoevvscout\Domain\Model\Agegroup;
use Volleyballserver\Vsoevvscout\Domain\Model\Competition;


/**
 * Match Repository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Berti Golf <info@berti-golf.de>
 */
class MatchRepository extends Repository {
	
	public function findAllByFilter(){
		$query = $this->createQuery();
		$constraints[] = $query->in('discipline', UserRights::getAllowedDisciplines());

		$query->matching($query->logicalAnd($constraints));

		return $query->execute();
	}

	/**
	 * 
	 * @param array $properties
	 * @return void
	 */
	public function findOneByProperties($properties){
		//var_dump($properties);
		/**  @var void  */
		$query = $this->createQuery();
		if ($properties['homecountry']){
			$constraints[] = $query->equals('homecountry.code', $properties['homecountry']);
		}
		if ($properties['agegroup']){
			$constraints[] = $query->equals('agegroup.short', $properties['agegroup']);
		}
		
		if ($properties['hometeamname']){
			$constraints[] = $query->equals('hometeam.name', $properties['hometeamname']);
		}

		$constraints[] = $query->equals('gender', $properties['gender']);
		$constraints[] = $query->equals('location.short', $properties['location']);
		$constraints[] = $query->equals('competition.short', $properties['competition']);
		$constraints[] = $query->equals('matchdate', $properties['matchdate']);
		$constraints[] = $query->equals('discipline', $properties['discipline']);
	
		$query->matching($query->logicalAnd($constraints));
		$match = $query->execute()->getFirst();
		//var_dump($match->getUid());echo '---------------------------------------';
        //die();
		return $match;


	}

}