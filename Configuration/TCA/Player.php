<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vsoevvscout_domain_model_player'] = array(
	'ctrl' => $TCA['tx_vsoevvscout_domain_model_player']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, lastname, firstname, shirtname, birthdate, country, functionplayer, discipline,file,team',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, lastname, firstname, shirtname, birthdate, country, functionplayer, discipline,file,team,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_vsoevvscout_domain_model_player',
				'foreign_table_where' => 'AND tx_vsoevvscout_domain_model_player.pid=###CURRENT_PID### AND tx_vsoevvscout_domain_model_player.sys_language_uid IN (-1,0)',
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
		'lastname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.lastname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'firstname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.firstname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'shirtname' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.shirtname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'birthdate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.birthdate',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.country',
			'config' => array(
				'type' => 'inline',
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
		'functionplayer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.functionplayer',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_vsoevvscout_domain_model_functionplayer',
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
		'discipline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.discipline',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vsoevvscout_domain_model_discipline',
				'MM' => 'tx_vsoevvscout_player_discipline_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
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
							'table' => 'tx_vsoevvscout_domain_model_discipline',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'team' => array(
				'exclude' => 0,
				'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_match.team',
				'config' => array(
						'type' => 'inline',
						'foreign_table' => 'tx_vsoevvscout_domain_model_team',
						'MM' => 'tx_vsoevvscout_team_player_mm',
						'MM_opposite_field' => 'player',
						'size' => 5,
						'autoSizeMax' => 30,
						'maxitems' => 9999,
						'multiple' => 0,
						
				),
		),
		'file' => array(
				'exclude' => 0,
				'label' => 'LLL:EXT:vsoevvscout/Resources/Private/Language/locallang_db.xlf:tx_vsoevvscout_domain_model_player.file',
				'config' => 	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig( 'files' ),
		),
	),
);

?>
