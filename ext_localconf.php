<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Volleyballserver.' . $_EXTKEY,
	'Pi1',
	array(
		'Match' => 'list, show, new, create, edit, update, delete',
		'Discipline' => 'list, show, new, create',
		'Competition' => 'list, show, new, create',
		'Country' => 'list, show, new, create, edit, update',
		
	),
	// non-cacheable actions
	array(
		'Match' => 'create, update, delete',
		'Discipline' => 'create',
		'Competition' => 'create',
		'Country' => 'create, update',
		
	)
);

?>