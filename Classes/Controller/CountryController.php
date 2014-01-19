<?php
namespace Volleyballserver\Vsoevvscout\Controller;

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
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CountryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		
		$countries = $this->countryRepository->findAll();
		$this->view->assign('countries', $countries);
	}

	/**
	 * action show
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $country
	 * @return void
	 */
	public function showAction(\Volleyballserver\Vsoevvscout\Domain\Model\Country $country) {
		
		$this->view->assign('country', $country);
	}

	/**
	 * action new
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $newCountry
	 * @dontvalidate $newCountry
	 * @return void
	 */
	public function newAction(\Volleyballserver\Vsoevvscout\Domain\Model\Country $newCountry = NULL) {
		
		$this->view->assign('newCountry', $newCountry);
	}

	/**
	 * action create
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $newCountry
	 * @return void
	 */
	public function createAction(\Volleyballserver\Vsoevvscout\Domain\Model\Country $newCountry) {
		
		$this->countryRepository->add($newCountry);
		$this->flashMessageContainer->add('Your new Country was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $country
	 * @return void
	 */
	public function editAction(\Volleyballserver\Vsoevvscout\Domain\Model\Country $country) {
		
		$this->view->assign('country', $country);
	}

	/**
	 * action update
	 *
	 * @param \Volleyballserver\Vsoevvscout\Domain\Model\Country $country
	 * @return void
	 */
	public function updateAction(\Volleyballserver\Vsoevvscout\Domain\Model\Country $country) {
		
		$this->countryRepository->update($country);
		$this->flashMessageContainer->add('Your Country was updated.');
		$this->redirect('list');
	}

}
?>