<?php

namespace Volleyballserver\Vsoevvscout\Tests\Unit\Domain\Model;

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
 * Test case for class \Volleyballserver\Vsoevvscout\Domain\Model\Player.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class PlayerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Player
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getLastnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastname()
		);
	}

	/**
	 * @test
	 */
	public function setLastnameForStringSetsLastname() {
		$this->subject->setLastname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFirstnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstname()
		);
	}

	/**
	 * @test
	 */
	public function setFirstnameForStringSetsFirstname() {
		$this->subject->setFirstname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getShirtnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getShirtname()
		);
	}

	/**
	 * @test
	 */
	public function setShirtnameForStringSetsShirtname() {
		$this->subject->setShirtname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'shirtname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBirthdateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getBirthdate()
		);
	}

	/**
	 * @test
	 */
	public function setBirthdateForDateTimeSetsBirthdate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setBirthdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'birthdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForCountrySetsCountry() {
		$countryFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Country();
		$this->subject->setCountry($countryFixture);

		$this->assertAttributeEquals(
			$countryFixture,
			'country',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFunctionplayerReturnsInitialValueForFunctionplayer() {
		$this->assertEquals(
			NULL,
			$this->subject->getFunctionplayer()
		);
	}

	/**
	 * @test
	 */
	public function setFunctionplayerForFunctionplayerSetsFunctionplayer() {
		$functionplayerFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Functionplayer();
		$this->subject->setFunctionplayer($functionplayerFixture);

		$this->assertAttributeEquals(
			$functionplayerFixture,
			'functionplayer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDisciplineReturnsInitialValueForDiscipline() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDiscipline()
		);
	}

	/**
	 * @test
	 */
	public function setDisciplineForObjectStorageContainingDisciplineSetsDiscipline() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();
		$objectStorageHoldingExactlyOneDiscipline = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDiscipline->attach($discipline);
		$this->subject->setDiscipline($objectStorageHoldingExactlyOneDiscipline);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDiscipline,
			'discipline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDisciplineToObjectStorageHoldingDiscipline() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();
		$disciplineObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$disciplineObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($discipline));
		$this->inject($this->subject, 'discipline', $disciplineObjectStorageMock);

		$this->subject->addDiscipline($discipline);
	}

	/**
	 * @test
	 */
	public function removeDisciplineFromObjectStorageHoldingDiscipline() {
		$discipline = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();
		$disciplineObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$disciplineObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($discipline));
		$this->inject($this->subject, 'discipline', $disciplineObjectStorageMock);

		$this->subject->removeDiscipline($discipline);

	}
}
