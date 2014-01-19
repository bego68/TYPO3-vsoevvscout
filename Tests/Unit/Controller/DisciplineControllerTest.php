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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\DisciplineController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class DisciplineControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\DisciplineController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\DisciplineController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllDisciplinesFromRepositoryAndAssignsThemToView() {

		$allDisciplines = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$disciplineRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$disciplineRepository->expects($this->once())->method('findAll')->will($this->returnValue($allDisciplines));
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('disciplines', $allDisciplines);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenDisciplineToView() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('discipline', $discipline);

		$this->subject->showAction($discipline);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenDisciplineToView() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newDiscipline', $discipline);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($discipline);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenDisciplineToDisciplineRepository() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$disciplineRepository->expects($this->once())->method('add')->with($discipline);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($discipline);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($discipline);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($discipline);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenDisciplineToView() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('discipline', $discipline);

		$this->subject->editAction($discipline);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenDisciplineInDisciplineRepository() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$disciplineRepository->expects($this->once())->method('update')->with($discipline);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($discipline);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($discipline);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();

		$disciplineRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'disciplineRepository', $disciplineRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($discipline);
	}
}
