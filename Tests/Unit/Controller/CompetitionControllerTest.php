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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\CompetitionController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class CompetitionControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\CompetitionController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\CompetitionController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCompetitionsFromRepositoryAndAssignsThemToView() {

		$allCompetitions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$competitionRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$competitionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCompetitions));
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('competitions', $allCompetitions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCompetitionToView() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('competition', $competition);

		$this->subject->showAction($competition);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenCompetitionToView() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newCompetition', $competition);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($competition);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCompetitionToCompetitionRepository() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$competitionRepository->expects($this->once())->method('add')->with($competition);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($competition);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($competition);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($competition);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCompetitionToView() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('competition', $competition);

		$this->subject->editAction($competition);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCompetitionInCompetitionRepository() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$competitionRepository->expects($this->once())->method('update')->with($competition);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($competition);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($competition);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$competition = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();

		$competitionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'competitionRepository', $competitionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($competition);
	}
}
