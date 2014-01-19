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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\AgegroupController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class AgegroupControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\AgegroupController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\AgegroupController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllAgegroupsFromRepositoryAndAssignsThemToView() {

		$allAgegroups = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$agegroupRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$agegroupRepository->expects($this->once())->method('findAll')->will($this->returnValue($allAgegroups));
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('agegroups', $allAgegroups);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenAgegroupToView() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('agegroup', $agegroup);

		$this->subject->showAction($agegroup);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenAgegroupToView() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newAgegroup', $agegroup);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($agegroup);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenAgegroupToAgegroupRepository() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$agegroupRepository->expects($this->once())->method('add')->with($agegroup);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($agegroup);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($agegroup);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($agegroup);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenAgegroupToView() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('agegroup', $agegroup);

		$this->subject->editAction($agegroup);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenAgegroupInAgegroupRepository() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$agegroupRepository->expects($this->once())->method('update')->with($agegroup);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($agegroup);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($agegroup);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$agegroup = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();

		$agegroupRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'agegroupRepository', $agegroupRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($agegroup);
	}
}
