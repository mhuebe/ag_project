<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "ag_project".
 *
 * Auto generated | Identifier: 4792b07e3c1197611721ad373a9c0a99
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Project Managment',
	'description' => 'Project managment with isotop or pagination option',
	'category' => 'plugin',
	'author' => 'Ajay Gohel',
	'author_email' => 'ajaygohel30@gmail.com',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '2.0.1',
	'constraints' => 
	array (
		'depends' => 
		array (
			'vhs' => '',
			'typo3' => '6.2.0-7.6.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
	'clearcacheonload' => false,
	'author_company' => NULL,
	'_md5_values_when_last_written' => 'a:90:{s:8:"Classes/";s:4:"d41d";s:20:"Classes/ViewHelpers/";s:4:"d41d";s:42:"Classes/ViewHelpers/PaginateViewHelper.php";s:4:"8093";s:16:"Classes/Service/";s:4:"d41d";s:34:"Classes/Service/RealurlService.php";s:4:"0af4";s:14:"Classes/Hooks/";s:4:"d41d";s:42:"Classes/Hooks/RealUrlAutoConfiguration.php";s:4:"00e2";s:15:"Classes/Helper/";s:4:"d41d";s:35:"Classes/Helper/AgProjectWizicon.php";s:4:"7e81";s:15:"Classes/Domain/";s:4:"d41d";s:19:"Classes/Controller/";s:4:"d41d";s:40:"Classes/Controller/ProjectController.php";s:4:"740a";s:41:"Classes/Controller/PaginateController.php";s:4:"810d";s:41:"Classes/Controller/CategoryController.php";s:4:"9acd";s:26:"Classes/Domain/Repository/";s:4:"d41d";s:47:"Classes/Domain/Repository/ProjectRepository.php";s:4:"e9e3";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"de7b";s:21:"Classes/Domain/Model/";s:4:"d41d";s:31:"Classes/Domain/Model/Status.php";s:4:"bc73";s:32:"Classes/Domain/Model/Project.php";s:4:"68fd";s:33:"Classes/Domain/Model/Category.php";s:4:"77fa";s:14:"Configuration/";s:4:"d41d";s:25:"Configuration/TypoScript/";s:4:"d41d";s:34:"Configuration/TypoScript/setup.txt";s:4:"5ffe";s:38:"Configuration/TypoScript/constants.txt";s:4:"d7f4";s:18:"Configuration/TCA/";s:4:"d41d";s:54:"Configuration/TCA/tx_agproject_domain_model_status.php";s:4:"1bbf";s:55:"Configuration/TCA/tx_agproject_domain_model_project.php";s:4:"75d2";s:56:"Configuration/TCA/tx_agproject_domain_model_category.php";s:4:"96a9";s:24:"Configuration/FlexForms/";s:4:"d41d";s:36:"Configuration/FlexForms/flexform.xml";s:4:"6545";s:31:"Configuration/ExtensionBuilder/";s:4:"d41d";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"bce7";s:28:"Configuration/TCA/Overrides/";s:4:"d41d";s:65:"Configuration/TCA/Overrides/tx_agproject_domain_model_project.php";s:4:"9996";s:10:"Resources/";s:4:"d41d";s:17:"Resources/Public/";s:4:"d41d";s:18:"Resources/Private/";s:4:"d41d";s:20:"Resources/Public/Js/";s:4:"d41d";s:35:"Resources/Public/Js/owl.carousel.js";s:4:"5b14";s:33:"Resources/Public/Js/ag-project.js";s:4:"5c01";s:24:"Resources/Public/Images/";s:4:"d41d";s:35:"Resources/Public/Images/monitor.png";s:4:"c24c";s:23:"Resources/Public/Icons/";s:4:"d41d";s:44:"Resources/Public/Icons/wizicon_portfolio.png";s:4:"2dd5";s:44:"Resources/Public/Icons/wizicon_portfolio.gif";s:4:"5513";s:59:"Resources/Public/Icons/tx_agproject_domain_model_status.gif";s:4:"1103";s:60:"Resources/Public/Icons/tx_agproject_domain_model_project.gif";s:4:"905a";s:61:"Resources/Public/Icons/tx_agproject_domain_model_category.gif";s:4:"905a";s:60:"Resources/Public/Icons/tx_agproduct_domain_model_product.gif";s:4:"905a";s:61:"Resources/Public/Icons/tx_agproduct_domain_model_category.gif";s:4:"905a";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:36:"Resources/Public/Icons/portfolio.ico";s:4:"d841";s:21:"Resources/Public/Css/";s:4:"d41d";s:37:"Resources/Public/Css/owl.carousel.css";s:4:"0371";s:35:"Resources/Public/Css/ag_project.css";s:4:"6149";s:28:"Resources/Private/Templates/";s:4:"d41d";s:27:"Resources/Private/Partials/";s:4:"d41d";s:26:"Resources/Private/Layouts/";s:4:"d41d";s:38:"Resources/Private/Layouts/Default.html";s:4:"065f";s:27:"Resources/Private/Language/";s:4:"d41d";s:49:"Resources/Private/Language/locallang_flexform.xlf";s:4:"4845";s:43:"Resources/Private/Language/locallang_db.xlf";s:4:"ae94";s:77:"Resources/Private/Language/locallang_csh_tx_agproject_domain_model_status.xlf";s:4:"7844";s:78:"Resources/Private/Language/locallang_csh_tx_agproject_domain_model_project.xlf";s:4:"8b8c";s:79:"Resources/Private/Language/locallang_csh_tx_agproject_domain_model_category.xlf";s:4:"4b39";s:40:"Resources/Private/Language/locallang.xlf";s:4:"d41a";s:43:"Resources/Private/Language/de.locallang.xlf";s:4:"c84f";s:36:"Resources/Private/Templates/Project/";s:4:"d41d";s:45:"Resources/Private/Templates/Project/Show.html";s:4:"80eb";s:45:"Resources/Private/Templates/Project/List.html";s:4:"7341";s:37:"Resources/Private/Templates/Paginate/";s:4:"d41d";s:47:"Resources/Private/Templates/Paginate/Index.html";s:4:"0090";s:37:"Resources/Private/Templates/Category/";s:4:"d41d";s:46:"Resources/Private/Templates/Category/List.html";s:4:"7127";s:36:"Resources/Private/Partials/Template/";s:4:"d41d";s:48:"Resources/Private/Partials/Template/catList.html";s:4:"4e13";s:47:"Resources/Private/Partials/Template/Search.html";s:4:"1b12";s:45:"Resources/Private/Partials/Template/List.html";s:4:"e39c";s:47:"Resources/Private/Partials/Template/Detail.html";s:4:"0bbc";s:35:"Resources/Private/Partials/Project/";s:4:"d41d";s:50:"Resources/Private/Partials/Project/Properties.html";s:4:"af52";s:45:"Resources/Private/Partials/Template/Category/";s:4:"d41d";s:54:"Resources/Private/Partials/Template/Category/List.html";s:4:"13ee";s:9:"ChangeLog";s:4:"b97e";s:12:"ext_icon.gif";s:4:"c146";s:17:"ext_localconf.php";s:4:"8181";s:14:"ext_tables.php";s:4:"611c";s:14:"ext_tables.sql";s:4:"7bba";s:9:"README.md";s:4:"aa33";}',
);

?>