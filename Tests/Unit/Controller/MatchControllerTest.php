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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\MatchController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class MatchControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\MatchController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\MatchController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMatchesFromRepositoryAndAssignsThemToView() {

		$allMatches = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('findAll'), array(), '', FALSE);
		$matchRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMatches));
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('matches', $allMatches);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMatchToView() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('match', $match);

		$this->subject->showAction($match);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenMatchToView() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newMatch', $match);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($match);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMatchToMatchRepository() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('add'), array(), '', FALSE);
		$matchRepository->expects($this->once())->method('add')->with($match);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($match);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($match);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($match);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenMatchToView() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('match', $match);

		$this->subject->editAction($match);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenMatchInMatchRepository() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('update'), array(), '', FALSE);
		$matchRepository->expects($this->once())->method('update')->with($match);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($match);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($match);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($match);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMatchFromMatchRepository() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('remove'), array(), '', FALSE);
		$matchRepository->expects($this->once())->method('remove')->with($match);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($match);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($match);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$match = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();

		$matchRepository = $this->getMock('Volleyballserver\\Vsoevvscout\\Domain\\Repository\\MatchRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'matchRepository', $matchRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($match);
	}
}
