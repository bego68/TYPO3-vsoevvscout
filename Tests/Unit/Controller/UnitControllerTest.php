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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\UnitController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class UnitControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\UnitController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\UnitController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllUnitsFromRepositoryAndAssignsThemToView() {

		$allUnits = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$unitRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$unitRepository->expects($this->once())->method('findAll')->will($this->returnValue($allUnits));
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('units', $allUnits);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenUnitToView() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('unit', $unit);

		$this->subject->showAction($unit);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenUnitToView() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newUnit', $unit);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($unit);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenUnitToUnitRepository() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$unitRepository->expects($this->once())->method('add')->with($unit);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($unit);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($unit);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($unit);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenUnitToView() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('unit', $unit);

		$this->subject->editAction($unit);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenUnitInUnitRepository() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$unitRepository->expects($this->once())->method('update')->with($unit);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($unit);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($unit);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$unit = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();

		$unitRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'unitRepository', $unitRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($unit);
	}
}
