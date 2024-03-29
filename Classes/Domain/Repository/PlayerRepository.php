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

use \TYPO3\CMS\Extbase\Persistence\Repository;
use Volleyballserver\Vsoevvscout\Service\UserRights;

/**
 * Player Repository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Berti Golf <info@berti-golf.de>
 */
class PlayerRepository extends Repository {
	
	/**
	 * 
	 */
	public function findAllByFilter(){
		$query = $this->createQuery();
		$constraints[] = $query->in('discipline', UserRights::getAllowedDisciplines());
		$constraints[] =  $query->logicalNot($query->equals('file.uid', NULL));
		$query->matching($query->logicalAnd($constraints));		
		return $query->execute();
	}
}