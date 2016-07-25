<?php
namespace AG\AgProject\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
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
 ***************************************************************/

class ProjectRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @param $settings
     * @param $_GP
     */
    function getProducts($settings, $_GP = '')
    {
        $lang = $GLOBALS['TSFE']->sys_language_uid; 
        $storageFolder = $settings['storageFolder']; 
        $cId = isset($_GP['cID']) ? ' AND t2.uid_foreign=' . $_GP['cID'] : '';
        //$pId = isset($_GP['projectID']) ? ' AND t1.uid=' . $_GP['projectID'] : '';
        $uID = $_GP['projectID'];
        if ($uID > 0) {
            if ($lang > 0) {
                $pId = ' AND t1.l10n_parent = ' . $uID;
            } else {
                $pId = ' AND t1.uid = ' . $uID;
            }
        }
        $suche = isset($_GP['suche']) ? ' AND  ( t1.title LIKE "%' . $_GP['suche'] . '%" OR t1.description LIKE "%' . $_GP['suche'] . '%" OR t1.price LIKE "%' . $_GP['suche'] . '%"  ) ' : '';
        if ($lang > 0) {
            $field2 = ' , t1.l10n_parent as uid';
            $id = 'l10n_parent';
        } else {
            $field2 = ' , t1.uid as uid';
            $id = 'uid';
        }

        $fields = 't1.* '.$field2;

        $table = 'tx_agproject_domain_model_project t1 
                    LEFT JOIN tx_agproject_project_category_mm t2 ON t2.uid_local = t1.uid
                    LEFT JOIN tx_agproject_domain_model_category t3 ON t2.uid_foreign = t3.'.$id;
        $where = 't1.hidden = 0 AND t1.deleted = 0 AND t1.pid='.$storageFolder.' AND t1.sys_language_uid IN (-1,'.$lang.') ' . $cId . $pId . $suche;
        $groupBy = 't1.uid';
        $orderBy = $settings['orderBy'];
        $limit = '';
        //echo $getRows = $this->typo_db()->SELECTquery($fields, $table, $where, $groupBy, $orderBy, $limit); exit;
        $getRows = $this->typo_db()->exec_SELECTgetRows($fields, $table, $where, $groupBy, $orderBy, $limit);
        $result = $this->falImages($getRows, 'tx_agproject_domain_model_project', 'images');
        $result = $this->categoryMMList($result);
        $result = $this->projectStatusMM($result);
        if(isset($_GP['projectID'])){
            $result[0]['prevData'] = $this->prevData($_GP['projectID'],$settings);
            $result[0]['nextData'] = $this->nextData($_GP['projectID'],$settings);
        }
        return $result;
        
    } 
    
    function prevData($pId,$settings){

        if( $settings['orderBy'] == 't1.sorting' ) {
            $sort = $this->getSorting($pId);
            $additional_where = ' AND t1.sorting < '.$sort[0]['sorting']; 
            $orderBy = 't1.sorting DESC';
        }else{
            $additional_where = ' AND t1.uid < '.$pId; 
            $orderBy = 't1.uid DESC';
        }

        $fields = 't1.uid';
        $table = 'tx_agproject_domain_model_project t1';
        $where = 't1.hidden = 0 AND t1.deleted = 0'.$additional_where;
        $groupBy = 't1.uid';        
        $limit = '1';
        return $getRows = $this->typo_db()->exec_SELECTgetRows($fields, $table, $where, $groupBy, $orderBy, $limit);
    }
    
    function nextData($pId,$settings){

        if( $settings['orderBy'] == 't1.sorting' ) {
            $sort = $this->getSorting($pId);
            $additional_where = ' AND t1.sorting > '.$sort[0]['sorting']; 
            $orderBy = 't1.sorting ASC';
        }else{
            $additional_where = ' AND t1.uid > '.$pId; 
            $orderBy = 't1.uid ASC';
        }

        $fields = 't1.uid';
        $table = 'tx_agproject_domain_model_project t1';
        $where = 't1.hidden = 0 AND t1.deleted = 0'. $additional_where;
        $groupBy = 't1.uid';
        $limit = '1';

        return $getRows = $this->typo_db()->exec_SELECTgetRows($fields, $table, $where, $groupBy, $orderBy, $limit);
    }

    
    function getSorting($pId){
        
        $fields = 't1.sorting';
        $table = 'tx_agproject_domain_model_project t1';
        $where = 't1.hidden = 0 AND t1.deleted = 0 AND t1.uid ='. $pId;
        $groupBy = 't1.uid';
        $orderBy = 't1.uid';
        $limit = '';

        return $getRows = $this->typo_db()->exec_SELECTgetRows($fields, $table, $where, $groupBy, $orderBy, $limit); 
    }

    public function relatedProject($settings, $_GP = '') {
        $storageFolder = $settings['storageFolder']; 
        $pId = isset($_GP['projectID']) ? $_GP['projectID'] : '';
        $field = 'p.*';
        $orderBy = 'm.sorting_foreign';
        $table = 'tx_agproject_project_project_mm as m LEFT JOIN 
                         tx_agproject_domain_model_project as p ON m.uid_foreign = p.uid';
        $where = ' p.deleted=0 AND p.hidden=0 AND p.pid= '.$storageFolder.' AND m.uid_local = ' . $pId;

        $related = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($field, $table, $where, '', $orderBy,'10');

        return $this->falImages($related, 'tx_agproject_domain_model_project');
    }
    

    /**
     * @param $result
     */
    public function categoryMMList($result)
    {
        //print_r($result);

        $select = 'tx_agproject_domain_model_category.*,tx_agproject_domain_model_category.title as cat_title';
        $local_table = 'tx_agproject_domain_model_project';
        $mm_table = 'tx_agproject_project_category_mm';
        $foreign_table = 'tx_agproject_domain_model_category';
        //$whereClause = '';
        $groupBy = '';
        $orderBy = '';
        foreach ($result as $key => $value) {
            $whereClause = ' AND tx_agproject_domain_model_project.uid=' . $value['uid'];
            //echo $res = $GLOBALS['TYPO3_DB']->SELECT_mm_query ($select, $local_table, $mm_table, $foreign_table, $whereClause, $groupBy= '', $orderBy= '', $limit= ''); exit;
            $res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query($select, $local_table, $mm_table, $foreign_table, $whereClause, $groupBy = '', $orderBy = '', $limit = '');
            $arr = '';
            $i=1;
            $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
            while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
                $comma = ($i==$count) ? '' : ',';
                $arr['cat_title'] .= 'cat_' . $row['uid'] . ' ';
                $arr['cat_uid'] .= $row['uid'] . $comma;
                $i++;
            }
            $result[$key]['CategoryTitle'] = $arr;
        }
        return $result;
    }

    /**
     * @param $result
     */
    public function projectStatusMM($result)
    {
        $select = 'tx_agproject_domain_model_status.uid,tx_agproject_domain_model_status.name';
        $local_table = 'tx_agproject_domain_model_project';
        $mm_table = 'tx_agproject_project_status_mm';
        $foreign_table = 'tx_agproject_domain_model_status';
        //$whereClause = '';
        $groupBy = '';
        $orderBy = '';
        foreach ($result as $keyStatus => $valueStatus) {
            $whereClause = ' AND tx_agproject_domain_model_project.uid=' . $valueStatus['uid'];
            $res1 = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query($select, $local_table, $mm_table, $foreign_table, $whereClause, $groupBy = '', $orderBy = '', $limit = '');
            $arrStatus = '';
            $i=1;
            $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res1);
            while ($rowStatus = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res1)) {
                $comma = ($i==$count) ? '' : ',';                
                $arrStatus['project_status'] .= $rowStatus['uid'] . $comma;
                $i++;
            }
            $result[$keyStatus]['ProjectStauts'] = $arrStatus;
        }
        return $result;
    }

    /**
     * @param $settings
     */
    function getProductsCategory($settings)
    {
        $lang = $GLOBALS['TSFE']->sys_language_uid;    
        $storageFolder = $settings['storageFolder']; 
        if ($lang > 0) {
            $field2 = ' , t1.l10n_parent as uid';
        } else {
            $field2 = ' , t1.uid as uid';
        }
        $fields = 't1.*'.$field2;
        $table = 'tx_agproject_domain_model_category t1';
        $where = 't1.hidden = 0 AND t1.deleted = 0 AND pid = '.$storageFolder.' AND t1.sys_language_uid IN (-1,'.$lang.')';
        $groupBy = 't1.uid';
        $orderBy = 't1.sorting';
        $limit = '';
        $getRows = $this->typo_db()->exec_SELECTgetRows($fields, $table, $where, $groupBy, $orderBy, $limit);
        return $this->falImages($getRows, 'tx_agproject_domain_model_category', 'images');
    }
    
    function typo_db()
    {
        return $GLOBALS['TYPO3_DB'];
    }
    
    /**
     * falImages
     *
     * @param $result
     * @param $tablename
     * @param $fieldname
     * @return
     */
    public function falImages($result, $tablename = NULL, $fieldname = NULL)
    {
        // $query = $this->createQuery();
        // $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
        $where = '';
        if ($tablename != '') {
            $where = ' AND tablenames = "' . $tablename . '"';
        }
        if ($fieldname != '') {
            $where .= ' AND fieldname IN ("' . $fieldname . '")';
        }
        foreach ($result as $key => $value) {
            $whr = ' deleted= 0 and hidden = 0 ' . $where . ' AND uid_foreign = ' . $value['uid'];

            $sysImages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'sys_file_reference', $whr,'','sorting_foreign ASC','');
            $arr = '';
            foreach ($sysImages as $key1 => $value1) {
                $fields1 = '*';
                $table1 = 'sys_file';
                $where1 = 'uid = ' . $value1['uid_local'];
                $groupBy1 = $orderBy1 = $limit1 = '';
                $sysImageDetail = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($fields1, $table1, $where1, $groupBy1, $orderBy1, $limit1);
                // $sysImageDetail = 'SELECT * FROM sys_file WHERE uid = ' . $value1['uid_local'];
                // $query->statement($sysImageDetail);
                // $sysImageDetail = $query->execute();
                $arr[$value1['fieldname']][$value1['uid']]['identifier'] = 'fileadmin' . $sysImageDetail[0]['identifier'];
                $arr[$value1['fieldname']][$value1['uid']]['title'] = $value1['title'];
                $arr[$value1['fieldname']][$value1['uid']]['caption'] = $value1['description'];
                $arr[$value1['fieldname']][$value1['uid']]['extension'] = $sysImageDetail[0]['extension'];
                $arr[$value1['fieldname']][$value1['uid']]['mime_type'] = $sysImageDetail[0]['mime_type'];
                $arr[$value1['fieldname']][$value1['uid']]['name'] = $sysImageDetail[0]['name'];
                $arr[$value1['fieldname']][$value1['uid']]['uid'] = $sysImageDetail[0]['uid'];
                $arr1 = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('/', $sysImageDetail[0]['mime_type'], true);
                $arr[$value1['fieldname']][$value1['uid']]['mime'] = $arr1[0];
                $arr[$value1['fieldname']][$value1['uid']]['type'] = $arr1[1];
                $arr[$value1['fieldname']][$value1['uid']]['imageName'] = basename($sysImageDetail[0]['identifier']);
            }
            $result[$key]['media'] = $arr;
        }
        return $result;
    }
    
    /**
     * falImages
     *
     * @param $id
     * @param $additionalParams
     * @return
     */
    public function getURL($id, $additionalParams = '')
    {
        $this->fullURL = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
        $cObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\Page\PageRepository::class);
        $configurations['additionalParams'] = $additionalParams;
        $configurations['returnLast'] = 'url';
        // get it as URL
        $configurations['parameter'] = $id;
        return $this->fullURL . $cObject->typoLink_URL(NULL, $configurations);
    }

}