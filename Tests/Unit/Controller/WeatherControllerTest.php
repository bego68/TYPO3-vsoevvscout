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
 * Test case for class Volleyballserver\Vsoevvscout\Controller\WeatherController.
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class WeatherControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Volleyballserver\Vsoevvscout\Controller\WeatherController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Volleyballserver\\Vsoevvscout\\Controller\\WeatherController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllWeathersFromRepositoryAndAssignsThemToView() {

		$allWeathers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$weatherRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$weatherRepository->expects($this->once())->method('findAll')->will($this->returnValue($allWeathers));
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('weathers', $allWeathers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenWeatherToView() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('weather', $weather);

		$this->subject->showAction($weather);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenWeatherToView() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newWeather', $weather);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($weather);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenWeatherToWeatherRepository() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$weatherRepository->expects($this->once())->method('add')->with($weather);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($weather);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($weather);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($weather);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenWeatherToView() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('weather', $weather);

		$this->subject->editAction($weather);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenWeatherInWeatherRepository() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$weatherRepository->expects($this->once())->method('update')->with($weather);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($weather);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($weather);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$weather = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();

		$weatherRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'weatherRepository', $weatherRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($weather);
	}
}
