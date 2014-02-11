<?php
/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

include_once (dirname(__FILE__).DS.'/ja_templatetools_1.5.php');
$mainframe =& JFactory::getApplication('site');

if (defined('_DEMO_MODE_')) $tmpTools = new JA_Tools($this, array(JA_TOOL_MENU, JA_TOOL_COLOR));	
else $tmpTools = new JA_Tools($this);

$tmpTools->setScreenSizes (array('wide','narrow'));
$tmpTools->setColorThemes (array('default','cyan','blue','red'));

# Auto Collapse Divs Functions ##########
$ja_left = $this->countModules('left');
$ja_right = $this->countModules('right');
if ($tmpTools->isContentEdit()) {
	$ja_right = $ja_left = 0;
}
if ( $ja_left && $ja_right ) {
	$divid = '';
	} elseif ( $ja_left ) {
	$divid = '-fr';
	} elseif ( $ja_right ) {
	$divid = '-fl';
	} else {
	$divid = '-f';
}

//Main navigation
$ja_menutype = $tmpTools->getParam(JA_TOOL_MENU);
$jamenu = null;
if ($ja_menutype != 'none') {
include_once( dirname(__FILE__).DS.'menus/Base.class.php' );
$japarams = JA_Base::createParameterObject('');
$japarams->set( 'menutype', $tmpTools->getParam('menutype', 'mainmenu') );
$japarams->set( 'menu_images_align', 'left' );
$japarams->set( 'menupath', $tmpTools->templateurl() .'/menus');
$japarams->set('menu_title', 0);
$japarams->set('menu_title', 0);
$japarams->set('menu_images', 0);
switch ($ja_menutype) {
	case 'css':
		$menu = "CSSmenu";
		include_once( dirname(__FILE__).DS.'menus/'.$menu.'.class.php' );
		break;
	case 'moo':
		$menu = "Moomenu";
		include_once( dirname(__FILE__).DS.'menus/'.$menu.'.class.php' );
		break;
	case 'split':
	default:
		$japarams->set('menu_title', 0);
		$japarams->set('menu_images', 1);
		$menu = "Splitmenu";
		include_once( dirname(__FILE__).DS.'menus/'.$menu.'.class.php' );
		break;
}
$menuclass = "JA_$menu";
$jamenu = new $menuclass ($japarams);

$hasSubnav = false;
if ($jamenu->hasSubMenu (1) && $jamenu->showSeparatedSub ) 
	$hasSubnav = true;
}	
//End for main navigation

// Xac dinh layout trang: trang chu, trang trong 2 cot hay trang trong 3 cot
$itemId = JRequest::getVar( 'Itemid', '1' );
$menuIdTrangChu = array( '1' );
$menuId2Cot = array( '2','3','6','20','101','45','14','24','32','33',
							'95','96','97','98','135','136','131','137','138','134',
								'132','133','139','111','109','108','117','119','127','122',
								'123','121','128','129','124','130','80','140','141','142',
								'143','144','145','146','147','148','149','150','151','152','153',
								'154','155','156','157','160','161','162','163','164','165','175','179','177',
								'184','185','186','187','89','84','85','86','87','69','191','199',
								'200','195','73','219','210','211','212',
								'208','209','213','214','215','216','217',
							'231','232','233','234','235','237',
								'238','239','240','207','241','313','248','256','258',
								'260','261','262','263','264','265','267','268','269','270','271','294','295','296','10','11','12','13','218','31','316','317','318','319','320','229','321','315'
								);
$menuId1Cot = array('224','19','16','8','81','225','226','228','198','196','245','246','247','242','251','250','253','254','252','227','243','249','257');
$menuId2Cotsmall = array('19','4','197','219','220','221','223','255');
$map = array('244');


$layout = '';
if ( in_array( $itemId, $menuIdTrangChu ) )
{	
	$layout = "trangchu";
}
else if ( in_array( $itemId, $menuId2Cotsmall ) )
{
	$layout = "2cotsmall";
}
else if ( in_array( $itemId, $menuId2Cot ) )
{
	$layout = "2cot";
}

else if ( in_array( $itemId, $menuId1Cot ) )
{
	$layout = "1cot";
}
else if ( in_array( $itemId, $map ) )
{
	$layout = "map";
}
// default trang chu neu layout khong co gia tri
if ( $layout == '' )
{
	$layout = 'trangchu';
}

?>
