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

$ten = '';
if(strlen($language)> 5)
{
	$extension_id = substr($language,6);
	$lang = substr($language,0,5);
	switch($extension_id)
	{
		case '1':
			$extension = 'mod_jea_search';
			$lang1->load($extension, $basePath, $lang, true);
			$ten = JText::_('CHON_PHUONG_XA');
			break;
		default:
			$extension = 'com_u_re';
			$lang1->load($extension, $basePath, $lang, true);
			$ten = JText::_('CHON_PHUONG_XA');
			break;
	}	
}
else
{	
	$lang1->load($extension, $basePath, $language, true);
	$ten = JText::_('CHON_PHUONG_XA');
}

$quanHuyenId = $_GET['quan_huyen_id'];
$propertyModel = new U_reModelProperties();
$rows = $propertyModel->layDanhSachPhuongXa( $quanHuyenId, substr($language,0,2) );

$ix_phuong_xa_id = JRequest::getVar('phuong_xa_id', 0);	
if ($rows)
{
	if($ten !='')
	{
		$title =Array ( 'id' => 0 ,'ten' => $ten);
		array_unshift( $rows, $title );
	}	
	echo JHTML::_('select.genericlist', $rows , 'phuong_xa_id', 'class="opt" size="1" ' , 'id', 'ten', $ix_phuong_xa_id);	
}
else
{
	echo "<select id='phuong_xa_id' name='phuong_xa_id' class='opt' >";
	if( $ten!='')
	{
		echo "<option value='0'>".$ten."</option>";	
	}	
	echo "</select>";
}
?>