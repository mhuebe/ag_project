<?php


$GLOBALS['TCA']['tx_agproject_domain_model_project']['columns']['images']['config']['maxitems'] = 10;
$GLOBALS['TCA']['tx_agproject_domain_model_project']['columns']['status']['config']['maxitems'] = 1;
$GLOBALS['TCA']['tx_agproject_domain_model_project']['columns']['status']['config']['size'] = 1;

//$GLOBALS['TCA']['tx_agproject_domain_model_project']['columns']['category']['config']['foreign_table_where'] = ' AND tx_agproject_domain_model_category.sys_language_uid IN (-1,0)';

$GLOBALS['TCA']['tx_agproject_domain_model_project']['columns']['website_url']['config'] = array(
		'type' => 'input',
		'size' => '50',
		'max' => '256',
		'eval' => 'trim',
		'wizards' => array(
		     'link' => array(
		             'type' => 'popup',
		             'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
		             'icon' => 'link_popup.gif',
		             'module' => array(
		                     'name' => 'wizard_element_browser',
		                     'urlParameters' => array(
		                             'mode' => 'wizard'
		                     )
		             ),
		             'params' => array(
		             	'blindLinkOptions' => 'file,page,mail,spec,folder',
		             ),
		             'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
		     )
		),
		'softref' => 'typolink'
);