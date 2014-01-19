<?php
namespace Volleyballserver\Vsoevvscout\Tests\Unit\Controller;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\PlayerController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class PlayerControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\PlayerController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\PlayerController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllPlayersFromRepositoryAndAssignsThemToView() {

		$allPlayers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$playerRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$playerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allPlayers));
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('players', $allPlayers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenPlayerToView() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('player', $player);

		$this->subject->showAction($player);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenPlayerToView() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newPlayer', $player);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($player);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenPlayerToPlayerRepository() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$playerRepository->expects($this->once())->method('add')->with($player);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($player);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($player);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($player);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenPlayerToView() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('player', $player);

		$this->subject->editAction($player);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenPlayerInPlayerRepository() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$playerRepository->expects($this->once())->method('update')->with($player);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($player);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($player);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$player = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();

		$playerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'playerRepository', $playerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($player);
	}
}
