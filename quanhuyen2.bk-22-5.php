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
			$ten = JText::_('CHON_QUAN_HUYEN');
			break;
		default:
			$extension = 'com_u_re';
			//$lang1->load($extension, $basePath, $lang, true);
			$ten = '';
			break;
	}	
}
else
{	
	//$lang1->load($extension, $basePath, $language, true);
	$ten = '';
}

$area_name= $_REQUEST['area_name'];
$townId= $_REQUEST['town_id'];
$QHID= $_REQUEST['quan_huyen_id'];
$classstyle = JRequest::getVar('style', 'input-s');
$isadmin = JRequest::getVar('isadmin', 0);
$propertyModel = new U_reModelProperties();
$rows = $propertyModel->layDanhSachQuanHuyen($townId, substr($language,0,2));

for ( $i = 0; $i < count( $rows ); $i++ )
{
	// $rows[$i]['title'] = $rows[$i]['id'] . '-' . $rows[$i]['alias'];
	$rows[$i]['title'] = $rows[$i]['alias'];
}

//$ix_quan_huyen_id = JRequest::getVar('quan_huyen_id', 367);
$ix_quan_huyen_id=0;	
if($QHID!=0){
	$onchangeQuanHuyen = "onchange=" . '"layDanhSachDuAn1' . "(this.value,'" . $language . "','" . JURI::root() . "')" . '"';
}else{
	$onchangeQuanHuyen = '';
}
if ($rows)
{
	if($ten != '')
	{
		$title =Array ( 'id' => 0 ,'ten' => $ten);
		array_unshift( $rows, $title );
	}
	if($isadmin==1)
		echo JHTML::_('select.genericlist', $rows , $area_name, 'class="'.$classstyle.'" size="1"' . $onchangeQuanHuyen . 'multiple="multiple"' , 'id', 'ten', $ix_quan_huyen_id);		
	else
		echo JHTML::_('select.genericlist', $rows , $area_name, 'class="'.$classstyle.'" size="1"' . $onchangeQuanHuyen . 'multiple="multiple"' , 'id', 'ten', $ix_quan_huyen_id);	
}
else
{
	echo "<select id='".$area_name."' name='".$area_name."' class='".$classstyle."' multiple='multiple' >";
	if($ten != '')
	{
		echo "<option value='0'>".$ten."</option>";
	}		
	echo "</select>";
}
?>
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery.multiselect.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery-ui.min.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery.multiselect.js"></script> 