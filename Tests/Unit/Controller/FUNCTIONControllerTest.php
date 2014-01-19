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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\FunctionController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class FunctionControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\FunctionController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\FunctionController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFunctionsFromRepositoryAndAssignsThemToView() {

		$allFunctions = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$functionRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$functionRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFunctions));
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('functions', $allFunctions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFunctionToView() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('function', $function);

		$this->subject->showAction($function);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFunctionToView() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFunction', $function);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($function);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFunctionToFunctionRepository() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$functionRepository->expects($this->once())->method('add')->with($function);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($function);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($function);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($function);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFunctionToView() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('function', $function);

		$this->subject->editAction($function);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFunctionInFunctionRepository() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$functionRepository->expects($this->once())->method('update')->with($function);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($function);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($function);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$function = new \Volleyballserver\Vsoevvscout\Domain\Model\Function();

		$functionRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'functionRepository', $functionRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($function);
	}
}
