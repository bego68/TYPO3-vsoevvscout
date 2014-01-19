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
 * Test case for class \Volleyballserver\Vsoevvscout\Domain\Model\Match.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Berti Golf <info@berti-golf.de>
 */
class MatchTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Volleyballserver\Vsoevvscout\Domain\Model\Match
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Volleyballserver\Vsoevvscout\Domain\Model\Match();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getGenderReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGender()
		);
	}

	/**
	 * @test
	 */
	public function setGenderForIntegerSetsGender() {
		$this->subject->setGender(12);

		$this->assertAttributeEquals(
			12,
			'gender',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMatchdateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getMatchdate()
		);
	}

	/**
	 * @test
	 */
	public function setMatchdateForDateTimeSetsMatchdate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setMatchdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'matchdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeset1ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomeset1()
		);
	}

	/**
	 * @test
	 */
	public function setHomeset1ForIntegerSetsHomeset1() {
		$this->subject->setHomeset1(12);

		$this->assertAttributeEquals(
			12,
			'homeset1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeset2ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomeset2()
		);
	}

	/**
	 * @test
	 */
	public function setHomeset2ForIntegerSetsHomeset2() {
		$this->subject->setHomeset2(12);

		$this->assertAttributeEquals(
			12,
			'homeset2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeset3ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomeset3()
		);
	}

	/**
	 * @test
	 */
	public function setHomeset3ForIntegerSetsHomeset3() {
		$this->subject->setHomeset3(12);

		$this->assertAttributeEquals(
			12,
			'homeset3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeset4ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomeset4()
		);
	}

	/**
	 * @test
	 */
	public function setHomeset4ForIntegerSetsHomeset4() {
		$this->subject->setHomeset4(12);

		$this->assertAttributeEquals(
			12,
			'homeset4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeset5ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomeset5()
		);
	}

	/**
	 * @test
	 */
	public function setHomeset5ForIntegerSetsHomeset5() {
		$this->subject->setHomeset5(12);

		$this->assertAttributeEquals(
			12,
			'homeset5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomesetgoldReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getHomesetgold()
		);
	}

	/**
	 * @test
	 */
	public function setHomesetgoldForIntegerSetsHomesetgold() {
		$this->subject->setHomesetgold(12);

		$this->assertAttributeEquals(
			12,
			'homesetgold',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestset1ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestset1()
		);
	}

	/**
	 * @test
	 */
	public function setGuestset1ForIntegerSetsGuestset1() {
		$this->subject->setGuestset1(12);

		$this->assertAttributeEquals(
			12,
			'guestset1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestset2ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestset2()
		);
	}

	/**
	 * @test
	 */
	public function setGuestset2ForIntegerSetsGuestset2() {
		$this->subject->setGuestset2(12);

		$this->assertAttributeEquals(
			12,
			'guestset2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestset3ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestset3()
		);
	}

	/**
	 * @test
	 */
	public function setGuestset3ForIntegerSetsGuestset3() {
		$this->subject->setGuestset3(12);

		$this->assertAttributeEquals(
			12,
			'guestset3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestset4ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestset4()
		);
	}

	/**
	 * @test
	 */
	public function setGuestset4ForIntegerSetsGuestset4() {
		$this->subject->setGuestset4(12);

		$this->assertAttributeEquals(
			12,
			'guestset4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestset5ReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestset5()
		);
	}

	/**
	 * @test
	 */
	public function setGuestset5ForIntegerSetsGuestset5() {
		$this->subject->setGuestset5(12);

		$this->assertAttributeEquals(
			12,
			'guestset5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestsetgoldReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getGuestsetgold()
		);
	}

	/**
	 * @test
	 */
	public function setGuestsetgoldForIntegerSetsGuestsetgold() {
		$this->subject->setGuestsetgold(12);

		$this->assertAttributeEquals(
			12,
			'guestsetgold',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDisciplineReturnsInitialValueForDiscipline() {
		$this->assertEquals(
			NULL,
			$this->subject->getDiscipline()
		);
	}

	/**
	 * @test
	 */
	public function setDisciplineForDisciplineSetsDiscipline() {
		$disciplineFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Discipline();
		$this->subject->setDiscipline($disciplineFixture);

		$this->assertAttributeEquals(
			$disciplineFixture,
			'discipline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCompetitionReturnsInitialValueForCompetition() {
		$this->assertEquals(
			NULL,
			$this->subject->getCompetition()
		);
	}

	/**
	 * @test
	 */
	public function setCompetitionForCompetitionSetsCompetition() {
		$competitionFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Competition();
		$this->subject->setCompetition($competitionFixture);

		$this->assertAttributeEquals(
			$competitionFixture,
			'competition',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomecountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getHomecountry()
		);
	}

	/**
	 * @test
	 */
	public function setHomecountryForCountrySetsHomecountry() {
		$homecountryFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Country();
		$this->subject->setHomecountry($homecountryFixture);

		$this->assertAttributeEquals(
			$homecountryFixture,
			'homecountry',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUnitReturnsInitialValueForUnit() {
		$this->assertEquals(
			NULL,
			$this->subject->getUnit()
		);
	}

	/**
	 * @test
	 */
	public function setUnitForUnitSetsUnit() {
		$unitFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Unit();
		$this->subject->setUnit($unitFixture);

		$this->assertAttributeEquals(
			$unitFixture,
			'unit',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAgegroupReturnsInitialValueForAgegroup() {
		$this->assertEquals(
			NULL,
			$this->subject->getAgegroup()
		);
	}

	/**
	 * @test
	 */
	public function setAgegroupForAgegroupSetsAgegroup() {
		$agegroupFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Agegroup();
		$this->subject->setAgegroup($agegroupFixture);

		$this->assertAttributeEquals(
			$agegroupFixture,
			'agegroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestcountryReturnsInitialValueForCountry() {
		$this->assertEquals(
			NULL,
			$this->subject->getGuestcountry()
		);
	}

	/**
	 * @test
	 */
	public function setGuestcountryForCountrySetsGuestcountry() {
		$guestcountryFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Country();
		$this->subject->setGuestcountry($guestcountryFixture);

		$this->assertAttributeEquals(
			$guestcountryFixture,
			'guestcountry',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomecolorReturnsInitialValueForColor() {
		$this->assertEquals(
			NULL,
			$this->subject->getHomecolor()
		);
	}

	/**
	 * @test
	 */
	public function setHomecolorForColorSetsHomecolor() {
		$homecolorFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();
		$this->subject->setHomecolor($homecolorFixture);

		$this->assertAttributeEquals(
			$homecolorFixture,
			'homecolor',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuestcolorReturnsInitialValueForColor() {
		$this->assertEquals(
			NULL,
			$this->subject->getGuestcolor()
		);
	}

	/**
	 * @test
	 */
	public function setGuestcolorForColorSetsGuestcolor() {
		$guestcolorFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Color();
		$this->subject->setGuestcolor($guestcolorFixture);

		$this->assertAttributeEquals(
			$guestcolorFixture,
			'guestcolor',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHomeplayerReturnsInitialValueForPlayer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getHomeplayer()
		);
	}

	/**
	 * @test
	 */
	public function setHomeplayerForObjectStorageContainingPlayerSetsHomeplayer() {
		$homeplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$objectStorageHoldingExactlyOneHomeplayer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneHomeplayer->attach($homeplayer);
		$this->subject->setHomeplayer($objectStorageHoldingExactlyOneHomeplayer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneHomeplayer,
			'homeplayer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addHomeplayerToObjectStorageHoldingHomeplayer() {
		$homeplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$homeplayerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$homeplayerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($homeplayer));
		$this->inject($this->subject, 'homeplayer', $homeplayerObjectStorageMock);

		$this->subject->addHomeplayer($homeplayer);
	}

	/**
	 * @test
	 */
	public function removeHomeplayerFromObjectStorageHoldingHomeplayer() {
		$homeplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$homeplayerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$homeplayerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($homeplayer));
		$this->inject($this->subject, 'homeplayer', $homeplayerObjectStorageMock);

		$this->subject->removeHomeplayer($homeplayer);

	}

	/**
	 * @test
	 */
	public function getGuestplayerReturnsInitialValueForPlayer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGuestplayer()
		);
	}

	/**
	 * @test
	 */
	public function setGuestplayerForObjectStorageContainingPlayerSetsGuestplayer() {
		$guestplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$objectStorageHoldingExactlyOneGuestplayer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGuestplayer->attach($guestplayer);
		$this->subject->setGuestplayer($objectStorageHoldingExactlyOneGuestplayer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGuestplayer,
			'guestplayer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGuestplayerToObjectStorageHoldingGuestplayer() {
		$guestplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$guestplayerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$guestplayerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($guestplayer));
		$this->inject($this->subject, 'guestplayer', $guestplayerObjectStorageMock);

		$this->subject->addGuestplayer($guestplayer);
	}

	/**
	 * @test
	 */
	public function removeGuestplayerFromObjectStorageHoldingGuestplayer() {
		$guestplayer = new \Volleyballserver\Vsoevvscout\Domain\Model\Player();
		$guestplayerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$guestplayerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($guestplayer));
		$this->inject($this->subject, 'guestplayer', $guestplayerObjectStorageMock);

		$this->subject->removeGuestplayer($guestplayer);

	}

	/**
	 * @test
	 */
	public function getWeatherReturnsInitialValueForWeather() {
		$this->assertEquals(
			NULL,
			$this->subject->getWeather()
		);
	}

	/**
	 * @test
	 */
	public function setWeatherForWeatherSetsWeather() {
		$weatherFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Weather();
		$this->subject->setWeather($weatherFixture);

		$this->assertAttributeEquals(
			$weatherFixture,
			'weather',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSunReturnsInitialValueForSun() {
		$this->assertEquals(
			NULL,
			$this->subject->getSun()
		);
	}

	/**
	 * @test
	 */
	public function setSunForSunSetsSun() {
		$sunFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Sun();
		$this->subject->setSun($sunFixture);

		$this->assertAttributeEquals(
			$sunFixture,
			'sun',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSurfaceReturnsInitialValueForSurface() {
		$this->assertEquals(
			NULL,
			$this->subject->getSurface()
		);
	}

	/**
	 * @test
	 */
	public function setSurfaceForSurfaceSetsSurface() {
		$surfaceFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Surface();
		$this->subject->setSurface($surfaceFixture);

		$this->assertAttributeEquals(
			$surfaceFixture,
			'surface',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForLocation() {
		$this->assertEquals(
			NULL,
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForLocationSetsLocation() {
		$locationFixture = new \Volleyballserver\Vsoevvscout\Domain\Model\Location();
		$this->subject->setLocation($locationFixture);

		$this->assertAttributeEquals(
			$locationFixture,
			'location',
			$this->subject
		);
	}
}
