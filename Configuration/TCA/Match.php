<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vsoevvscout_domain_model_match'] = array(
	'ctrl' => $TCA['tx_vsoevvscout_domain_model_match']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, matchdate, homeset1, homeset2, homeset3, homeset4, homeset5, homesetgold, guestset1, guestset2, guestset3, guestset4, guestset5, guestsetgold, discipline, competition, homecountry, unit, agegroup, guestcountry, homecolor, guestcolor, hometeam, guestteam, weather, sun, surface, location,file',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, gender, matchdate, homeset1, homeset2, homeset3, homeset4, homeset5, homesetgold, guestset1, guestset2, guestset3, guestset4, guestset5, guestsetgold, discipline, competition, homecountry, unit, agegroup, guestcountry, homecolor, guestcolor, hometeam, guestteam, weather, sun, surface, location,file,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_vsoevvscout_domain_model_match',
				'foreign_table_where' => 'AND tx_vsoevvscout_domain_model_match.pid=###CURRENT_PID### AND tx_vsoevvscout_domain_model_match.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.gender',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('Wähle Geschlecht', 0),
					array('männlich', 1),
					array('weiblich', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'matchdate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.matchdate',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'homeset1' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homeset1',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homeset2' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homeset2',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homeset3' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homeset3',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homeset4' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homeset4',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homeset5' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homeset5',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homesetgold' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homesetgold',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestset1' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestset1',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestset2' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestset2',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestset3' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestset3',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestset4' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestset4',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestset5' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestset5',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'guestsetgold' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestsetgold',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'discipline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.discipline',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_discipline',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'competition' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.competition',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_competition',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'homecountry' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homecountry',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_country',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'unit' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.unit',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_unit',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'agegroup' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.agegroup',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_agegroup',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'guestcountry' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestcountry',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_country',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'homecolor' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.homecolor',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_color',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'guestcolor' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestcolor',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_color',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'hometeam' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.hometeam',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_team',
				'autoSizeMax' => 30,
				'maxitems' => 1,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_vsoevvscout_domain_model_team',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'guestteam' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.guestteam',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_team',
				'autoSizeMax' => 30,
				'maxitems' => 1,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_vsoevvscout_domain_model_team',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'weather' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.weather',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_weather',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'sun' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.sun',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_sun',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'surface' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.surface',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_surface',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.location',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_location',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.file',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig( 'files' ),
		),
	),
);
