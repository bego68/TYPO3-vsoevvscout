<?php
namespace Volleyballserver\Vsoevvscout\Controller;

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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \Volleyballserver\Vsoevvscout\Domain\Model\Team;
/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TeamController extends ActionController {

	/**
	 * teamRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\TeamRepository
	 * @inject
	 */
	protected $teamRepository;
	
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
	
		$teams = $this->teamRepository->findAllByFilter();
		$this->view->assign('teams', $teams);
	}

	/**
	 * action show
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $team
	 * @return void
	 */
	public function showAction(Team $team) {
		
		$this->view->assign('team', $team);
	}

	/**
	 * action new
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $newTeam
	 * @dontvalidate $newTeam
	 * @return void
	 */
	public function newAction(Team $newTeam = NULL) {
		
		$this->view->assign('newTeam', $newTeam);
	}

	/**
	 * action create
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $newTeam
	 * @return void
	 */
	public function createAction(Team $newTeam) {
		
		$this->functionRepository->add($newTeam);
		$this->flashMessageContainer->add('Your new Team was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $team
	 * @return void
	 */
	public function editAction(Team $team) {
		
		$this->view->assign('team', $team);
	}

	/**
	 * action update
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Team $team
	 * @return void
	 */
	public function updateAction(Team $team) {
		
		$this->teamRepository->update($team);
		$this->flashMessageContainer->add('Your Team was updated.');
		$this->redirect('list');
	}

}
?>