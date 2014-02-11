<?php
/**
* @version		$Id: mod_vavim.php 2009-12-24 vinaora $
* @package		Vinaora AVIM Keyboard
* @copyright	Copyright (C) 2007 - 2010 VINAORA. All rights reserved.
* @license		GNU/GPL
* @website		http://vinaora.com
* @email		admin@vinaora.com
*
* @note			AVIM Javascript (avim.js) - Copyright (C) 2004-2008 Hieu Tran Dang <lt2hieu2004 (at) users (dot) sf (dot) net
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<?php

// variable for avim
$style 		=	$params->get('style', "full");
$method		=	$params->get('method', 0);
$ckSpell	=	$params->get('ckSpell', 1);
$oldAccent	=	$params->get('oldAccent', 1);
$useCookie	=	$params->get('useCookie', 1);
$exclude	=	$params->get('exclude', "email");

// other variables
$pretext	=	$params->get('pretext', "");
$posttext	=	$params->get('posttext', "");
$onOff		=	$method=="-1"?0:1;

$showControl	=	($style=="float")?"1":"0";

$css		= JURI::base()."media/mod_vavim/css/avim.css";
$avim		= JURI::base()."media/mod_vavim/js/avim.js";

$avimtag	= '<script type="text/javascript" src="'.$avim.'"></script>';

$avim_config = '
	<script type="text/javascript">
	var AVIMGlobalConfig = {
		method: '.$method.', //Default input method: 0=AUTO, 1=TELEX, 2=VNI, 3=VIQR, 4=VIQR*
		onOff: '.$onOff.', //Starting status: 0=Off, 1=On
		ckSpell: '.$ckSpell.', //Spell Check: 0=Off, 1=On
		oldAccent: '.$oldAccent.', //0: New way (oa`, oe`, uy`), 1: The good old day (o`a, o`e, u`y)
		useCookie: '.$useCookie.', //Cookies: 0=Off, 1=On
		exclude: ["'.$exclude.'"], //IDs of the fields you DON\'T want to let users type Vietnamese in
		showControl: '.$showControl.', //Show control panel: 0=Off, 1=On. If you turn this off, you must write your own control panel.
		controlCSS: "'.$css.'" //Path to avim.css
	};

	//Set to true the methods which you want to be included in the AUTO method
	var AVIMAutoConfig = {
		telex: true,
		vni: true,
		viqr: false,
		viqrStar: false
	};	
	</script>';

$document =& JFactory::getDocument();
$document->addCustomTag($avim_config);

echo "\n<!-- Begin: Vinaora AVIM Vietnamese Keyboard -->\n";
if ( !empty($pretext) && ($style!="float") && ($style!="hide") ) echo $pretext;

switch ( $style ) {
	/*  Full Style */
	case 'full':
		require(JModuleHelper::getLayoutPath('mod_vavim','full'));
		break;
	
	/* Simple Style */
	case 'simple':
		require(JModuleHelper::getLayoutPath('mod_vavim','simple'));
		break;
	
	/* Drop Down List Style */
	case 'dropdownlist':
		require(JModuleHelper::getLayoutPath('mod_vavim','dropdownlist'));
		break;
	
	/* Horizontal List Style*/
	case 'horizontal':
		require(JModuleHelper::getLayoutPath('mod_vavim','horizontal'));
		break;

	/* Float Style*/
	case 'float':
		//require(JModuleHelper::getLayoutPath('mod_vavim','float'));
		$document->addCustomTag($avimtag);
		break;
		
	case 'hide':
		$document->addCustomTag($avimtag);
		break;
	
	default:
		require(JModuleHelper::getLayoutPath('mod_vavim'));
		break;
}

if ( !empty($posttext) && ($style!="float") && ($style!="hide") ) echo $posttext;
echo "\n<!-- End: Vinaora AVIM Vietnamese Keyboard -->\n";
?>