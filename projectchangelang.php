<?php
define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) );
require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
$mainframe =& JFactory::getApplication('site');
include_once ('libraries'.DS.'unisonlib'.DS.'com_jea_lib.php');
include_once('libraries/com_u_re/php/common_utils.php');

// phan lay ngon ngu
$language= $_REQUEST['lang'];
$lang = substr($language,0,2);
//print_r($lang);
$lang1 = JFactory::getLanguage();
$extension = 'com_jea';
$basePath = JPATH_BASE;
$lang1->load($extension, $basePath, $language, true);



/* dang xu ly */
/*
		$projectModel = new U_ReModelProjects();
		$projectData = $projectModel->getProjectById( '1028' , $lang);
	print_r($projectData);
	exit;
//		$this->assignRef( 'row', $projectData );
		
/* dang xu ly */

$type_id= $_REQUEST['type_id'];
$strbreak = '--||ABC||--'; // Gan gia tri de split ra khi dem vao ajax
// [0]
echo JText::_('TEN') ;
echo $strbreak;
// [1]
echo JText::_('TONG_QUAN') ;
echo $strbreak;
// [2]
echo JText::_('LOAI_DU_AN') ;
echo $strbreak;
// [3]
echo JText::_('NGAY_KHOI_CONG') ;
echo $strbreak;
// [4]
echo JText::_('NGAY_HOAN_THANH') ;
echo $strbreak;
// [5]
echo JText::_('NHA_DAU_TU') ;
echo $strbreak;
// [6]
echo JText::_('GIOI_THIEU') ;
echo $strbreak;
// [7]
echo JText::_('BAN_DO_VI_TRI') ;
echo $strbreak;
// [8]
echo JText::_('SO_DO_MAT_BANG') ;
echo $strbreak;
// [9]
echo JText::_('TIEN_DO') ;
echo $strbreak;
// [10]
echo JText::_('DOI_TAC') ;
echo $strbreak;
// [11]
echo JText::_('ANH_PHU') ;
echo $strbreak;
// [12]
echo JText::_('THANH_TOAN') ;
echo $strbreak;
// [13]
echo JText::_('DIA_CHI') ;
echo $strbreak;
// [14]
echo JText::_('DU_AN_MOI') ;
echo $strbreak;
// [15]
echo JText::_('SPECIFICATIONS') ;
echo $strbreak;
// [16]
echo JText::_('CONTACTNAME') ;
echo $strbreak;
// [17]
echo JText::_('CONTACTADDRESS') ;
echo $strbreak;
// [18]
echo JText::_('CONTACTPHONE') ;
echo $strbreak;
// [19]
echo JText::_('MO_TA_NGAN') ;
echo $strbreak;
// [20]
echo JText::_('MO_TA_DAY_DU') ;
echo $strbreak;
// [21]
echo JText::_('PICTURES') ;
echo $strbreak;
// [22]
echo JText::_('ANH_CHINH') ;
echo $strbreak;

// [23]
echo JText::_('SEND') ;
echo $strbreak;

// [24]
echo JText::_('DELETE') ;
echo $strbreak;
// [25]
echo JText::_('DU_AN_NOI_BAT') ;
echo $strbreak;
// [26]
echo JText::_('LIEN_HE') ;
echo $strbreak;
// [27]
echo JText::_('SEO_CONFIG') ;
echo $strbreak;
// [28]
echo JText::_('SEO_PAGE_TITLE') ;
echo $strbreak;
// [29]
echo JText::_('SEO_PAGE_KEYWORDS') ;
echo $strbreak;
// [30]
echo JText::_('SEO_PAGE_DESCRIPTION') ;
echo $strbreak;
// [31]
echo JText::_('HIEN_THI');
echo $strbreak;
// [32]
echo JText::_('SECONDARIES_PROPERTY_PICTURES') ;
echo $strbreak;
// [33]
echo "<input class='button' type='button' value='".JText::_('SEND')."' onclick=\"submitbutton('apply')\" />";
echo $strbreak;
// [34]
echo ilandCommonUtils::getSelectBox('loai_du_an', 'type_id','', $type_id, '', '', '', '',$lang);
echo $strbreak;
// [35]
echo JText::_('CHI_TIET_DU_AN');
echo $strbreak;
// [42]
echo JText::_('LUU');
echo $strbreak;
// [43]
echo JText::_('HUY');
echo $strbreak;
?>