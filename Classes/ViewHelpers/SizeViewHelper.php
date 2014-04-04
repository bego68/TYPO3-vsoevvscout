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
class SizeViewHelper extends AbstractViewHelper {

		
	/**
	 * 
	 * @param \integer $size
	 * 
	 * @return \string
	 */
	public function render($size) {
		$humanReadableSize=$size . 'Byte';
		if($size>1024){
			$size = $size /1024;
			$humanReadableSize = sprintf("%01.1f", $size) . 'kB';
		}
		if($size>1024){
			$size = $size /1024;
			$humanReadableSize = sprintf("%01.1f", $size) . 'MB';
		}
		if($size>1024){
			$size = $size /1024;
			$humanReadableSize = sprintf("%01.1f", $size) . 'GB';
		}
		return $humanReadableSize;
	}
}