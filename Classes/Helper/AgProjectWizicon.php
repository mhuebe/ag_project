<?php
/**
 * Created by Ajay Gohel.
 * User: Ajay
 */
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class that adds the wizard icon.
 */
class AgProjectWizicon {

    /**
     * Processing the wizard items array
     *
     * @param array $wizardItems : The wizard items
     * @return Modified array with wizard items
     */
    function proc( $wizardItems ) {

        $wizardItems['plugins_tx_project_project'] = array(
            'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ag_project') . 'Resources/Public/Icons/wizicon_portfolio.gif',
            'title' => $GLOBALS['LANG']->sL('LLL:EXT:ag_project/Resources/Private/Language/locallang.xlf:plugin-title'),
            'description' => $GLOBALS['LANG']->sL('LLL:EXT:ag_project/Resources/Private/Language/locallang.xlf:plugin-description'),
            'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=plugins_tx_project_project'
        );

        return $wizardItems;
    }
}
?>