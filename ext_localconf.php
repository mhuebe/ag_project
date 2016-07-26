<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AG.' . $_EXTKEY,
	'Project',
	array(
		'Project' => 'list, show',
		'Category' => 'list',
	),
	// non-cacheable actions
	array(
		'Category' => '',
		'Project' => '',
	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AG.' . $_EXTKEY,
	'Project',
	array(
		'Project' => 'list, show',
		'Category' => 'list',
	),
	// non-cacheable actions
	array(
		'Category' => '',
		'Project' => '',

	)
);

