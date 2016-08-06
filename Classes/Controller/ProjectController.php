<?php
namespace AG\AgProject\Controller;

/**
 *
 *  Copyright notice
 *
 *  (c) 2015
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
 */

/**
 * ProjectController
 */
class ProjectController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

	/**
	 * projectRepository
	 *
	 * @var \AG\AgProject\Domain\Repository\ProjectRepository
	 * @inject
	 */
	protected $projectRepository = NULL;

	/**
	 * action list
	 *
	 * @param \AG\AgProject\Domain\Model\Project
	 * @return void
	 */
	public function listAction()
	{
		$_GP = \TYPO3\CMS\Core\Utility\GeneralUtility::_GET();
		$post = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST();

		$settings = $this->settings;
		$GLOBALS["TSFE"]->set_no_cache();
		$modeOptions = $settings['modeOptions'];

		if ($modeOptions == 'Project->list' || $modeOptions == 'Project->detail') {
			$uriArr = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_porject_porject');
			if (isset($_GP['categoryID'])) {
				$GLOBALS['TSFE']->additionalFooterData['gridJavascript'] = '
				<script>
				jQuery(function(){
				   jQuery("#cat_' . $_GP['categoryID'] . '").click();
				});
				</script>';
			}

			$categoryListForGrid = $this->projectRepository->getProductsCategory($settings);
			$project_list = $this->projectRepository->getProducts($settings, $_GP);
			if (isset($_GP['projectID'])) {
				$related_project = $this->projectRepository->relatedProject($settings, $_GP);
			}
		} elseif ($modeOptions == 'Category->list') {
			$category_list = $this->projectRepository->getProductsCategory($settings);
		}

		$actionUrl = $this->uriBuilder->getRequest()->getRequestUri();

		$this->view->assign('products-list', $project_list);
		$this->view->assign('related_project', $related_project);
		$this->view->assign('category-list', $category_list);
		$this->view->assign('categoryListGrid', $categoryListForGrid);


		$this->view->assign('gp', $_GP);
		$this->view->assign('actionUrl', $actionUrl);
	}

	/**
	 * action show
	 *
	 * @param \AG\AgProject\Domain\Model\Project $project
	 * @return void
	 */
	public function showAction(\AG\AgProject\Domain\Model\Project $project)
	{
		$this->view->assign('product', $project);
	}

}