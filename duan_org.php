<?php
define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) );
require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
$mainframe =& JFactory::getApplication('site');
require_once('libraries/com_u_re/php/common_utils.php');

$language= $_REQUEST['lang'];
if($language=='')
	$language='vi-VN';
$extension = 'com_u_re';
$lang1 = JFactory::getLanguage();
$basePath = JPATH_BASE;

$ten = 'Bất kỳ';
if(strlen($language)> 5)
{
	$extension_id = substr($language,6);
	$lang = substr($language,0,5);
	switch($extension_id)
	{
		case '1':
			$extension = 'mod_jea_search';
			$lang1->load($extension, $basePath, $lang, true);
			$ten = JText::_('CHON_DU_AN');
			break;
		default:
			$extension = 'com_u_re';
			//$lang1->load($extension, $basePath, $lang, true);
			$ten = 'Bất kỳ';
			break;
	}	
}
else
{	
	//$lang1->load($extension, $basePath, $language, true);
	$ten = 'Bất kỳ';
}

$duAnName= $_GET['du_an_name'];
$quanHuyenId= $_GET['quan_huyen_id'];
$tinhThanhId = $_GET['tinh_thanh_id'];
$classstyle = JRequest::getVar('style', 'input-s');
$isadmin = JRequest::getVar('isadmin', 0);
$projectModel = new U_reModelProjects();
$rows = $projectModel->laydanhsachduan( $quanHuyenId, $tinhThanhId );

//$ix_quan_huyen_id = JRequest::getVar('quan_huyen_id', 367);
$ix_quan_huyen_id=0;	
if ($rows)
{
	if($ten != '')
	{
		$title =Array ( 'id' => 0 ,'ten' => $ten);
		array_unshift( $rows, $title );
	}
	if($isadmin==1)
		echo JHTML::_('select.genericlist', $rows , $duAnName, 'class="'.$classstyle.'" size="1" ' , 'id', 'ten', $ix_quan_huyen_id);		
	else
		echo JHTML::_('select.genericlist', $rows , $duAnName, 'class="'.$classstyle.'" size="1" ' , 'id', 'ten', $ix_quan_huyen_id);	
}
else
{
	echo "<select id='".$duAnName."' name='".$duAnName."' class='".$classstyle."' >";
	if($ten != '')
	{
		echo "<option value='0'>".$ten."</option>";
	}		
	echo "</select>";
}
?>