<?php
namespace Volleyballserver\Vsoevvscout\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Berti Golf info@berti-golf.de >
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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Volleyballserver\Vsoevvscout\Domain\Repository\AgegroupRepository;
/**
 *
 *
 * @package Vsoevvscout
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class MimeTypeViewHelper extends AbstractViewHelper {

		
	/**
	 * returns Type (image,video, ...)
	 * 
	 * @param \string $mimeType
	 * 
	 * @return \string
	 */
	public function render($mimeType) {
		
		$type = "undefined";
		$mimeTypeArray = explode('/', $mimeType );
		switch ( $mimeTypeArray[0] ) {
			case 'image':
			case 'text':
			case 'video': $type = $mimeTypeArray[0];
				break;
			default:
				switch ($mimeTypeArray[1]) {
					case 'zip':
					case 'msword':
					case 'msexcel': $type = $mimeTypeArray[1];
					break;
				}
			}
		return $type;
	}
}