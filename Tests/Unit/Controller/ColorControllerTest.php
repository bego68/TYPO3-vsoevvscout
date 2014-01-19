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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\ColorController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class ColorControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\ColorController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\ColorController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllColorsFromRepositoryAndAssignsThemToView() {

		$allColors = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$colorRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$colorRepository->expects($this->once())->method('findAll')->will($this->returnValue($allColors));
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('colors', $allColors);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenColorToView() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('color', $color);

		$this->subject->showAction($color);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenColorToView() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newColor', $color);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($color);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenColorToColorRepository() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$colorRepository->expects($this->once())->method('add')->with($color);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($color);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($color);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($color);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenColorToView() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('color', $color);

		$this->subject->editAction($color);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenColorInColorRepository() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$colorRepository->expects($this->once())->method('update')->with($color);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($color);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($color);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$color = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();

		$colorRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'colorRepository', $colorRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($color);
	}
}
