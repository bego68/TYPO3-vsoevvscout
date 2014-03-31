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

use  TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use  Volleyballserver\Vsoevvscout\Domain\Model\Player;
/**
 *
 * @package Vsoevvscout
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Berti Golf <info@berti-golf.de>
 */
class PlayerController extends ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		
		$players = $this->playerRepository->findAll();
		$this->view->assign('players', $players);
	}

	/**
	 * action show
	 *
	 * @param Player $player
	 * @return void
	 */
	public function showAction(Player $player) {
		
		$this->view->assign('player', $player);
	}

	/**
	 * action new
	 *
	 * @param Player $newPlayer
	 * @dontvalidate $newPlayer
	 * @return void
	 */
	public function newAction(Player $newPlayer = NULL) {
		
		$this->view->assign('newPlayer', $newPlayer);
	}

	/**
	 * action create
	 *
	 * @param Player $newPlayer
	 * @return void
	 */
	public function createAction(Player $newPlayer) {
		
		$this->playerRepository->add($newPlayer);
		$this->flashMessageContainer->add('Your new Player was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param Player $player
	 * @return void
	 */
	public function editAction(Player $player) {
		
		$this->view->assign('player', $player);
	}

	/**
	 * action update
	 *
	 * @param Player $player
	 * @return void
	 */
	public function updateAction(Player $player) {
		
		$this->playerRepository->update($player);
		$this->flashMessageContainer->add('Your Player was updated.');
		$this->redirect('list');
	}

}