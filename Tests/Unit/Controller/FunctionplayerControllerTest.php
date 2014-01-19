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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\FunctionplayerController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class FunctionplayerControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\FunctionplayerController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\FunctionplayerController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFunctionplayersFromRepositoryAndAssignsThemToView() {

		$allFunctionplayers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$functionplayerRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$functionplayerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFunctionplayers));
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('functionplayers', $allFunctionplayers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFunctionplayerToView() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('functionplayer', $functionplayer);

		$this->subject->showAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFunctionplayerToView() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFunctionplayer', $functionplayer);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFunctionplayerToFunctionplayerRepository() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$functionplayerRepository->expects($this->once())->method('add')->with($functionplayer);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFunctionplayerToView() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('functionplayer', $functionplayer);

		$this->subject->editAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFunctionplayerInFunctionplayerRepository() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$functionplayerRepository->expects($this->once())->method('update')->with($functionplayer);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($functionplayer);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$functionplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();

		$functionplayerRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'functionplayerRepository', $functionplayerRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($functionplayer);
	}
}
