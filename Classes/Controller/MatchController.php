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

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class MatchController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * matchRepository
	 *
	 * @var \Volleyballserver\Vsoevvscout\Domain\Repository\MatchRepository
	 * @inject
	 */
	protected $matchRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		
		$matches = $this->matchRepository->findAll();
		$this->view->assign('matches', $matches);
	}

	/**
	 * action show
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $match
	 * @return void
	 */
	public function showAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $match) {
		
		$this->view->assign('match', $match);
	}

	/**
	 * action new
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $newMatch
	 * @dontvalidate $newMatch
	 * @return void
	 */
	public function newAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $newMatch = NULL) {
		
		$this->view->assign('newMatch', $newMatch);
	}

	/**
	 * action create
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $newMatch
	 * @return void
	 */
	public function createAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $newMatch) {
		
		$this->matchRepository->add($newMatch);
		$this->flashMessageContainer->add('Your new Match was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $match
	 * @return void
	 */
	public function editAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $match) {
		
		$this->view->assign('match', $match);
	}

	/**
	 * action update
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $match
	 * @return void
	 */
	public function updateAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $match) {
		
		$this->matchRepository->update($match);
		$this->flashMessageContainer->add('Your Match was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Match $match
	 * @return void
	 */
	public function deleteAction(\Volleyballserver\Vsoevvscout\Domain\Model\Match $match) {
		
		$this->matchRepository->remove($match);
		$this->flashMessageContainer->add('Your Match was removed.');
		$this->redirect('list');
	}

}
?>