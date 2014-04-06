<?php
use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

ExtensionUtility::configurePlugin(
	'Volleyballserver.' . $_EXTKEY,
	'Pi1',
	array(
		'Match' => 'list, show, new, create, edit, update, delete',
		'Discipline' => 'list, show, new, create',
		'Competition' => 'list, show, new, create',
		'Country' => 'list, show, new, create, edit, update',
		'Player' => 'list, show, new, create, edit, update',
		'Team' => 'list, show, new, create, edit, update',
	),
	// non-cacheable actions
	array(
		'Match' => 'list,show,create, update, delete',
		'Discipline' => 'create',
		'Competition' => 'create',
		'Country' => 'create, update',
		'Player' => 'list, show, create, edit, update',
	)
);

//include_once(t3lib_extMgm::extPath($_EXTKEY).'Classes/Command/VsoevvscoutCommandController.php');
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Volleyballserver\\Vsoevvscout\\Command\\VsoevvscoutCommandController';

