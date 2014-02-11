<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version		1.2 2008-07
 * @package		Jea.module.emphasis
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');

// get parameter
$theme='mod_slide';
$folder=$params->get('folder', 'image/stories/fruits');
$width=$params->get('width', '400');
$height=$params->get('height', '300');
$speed=$params->get('speed', 5000);
$showtitle=$params->get('showtitle', 1);
$autoplay=$params->get('autoplay', 1);
$margin_left=$params->get('margin_left', 0);
//
$listimage=modPhotoHelper::getListImage($folder);
$html=modPhotoHelper::getHtmlTemplate($module->id,$theme);
$theme='pp_'.$theme;
$doc	=& JFactory::getDocument();
$prettyboxCSS = JURI::root(true)."/plugins/system/pretty/css/".$theme.".css";
$doc->addStyleSheet($prettyboxCSS);

require(JModuleHelper::getLayoutPath('mod_photo','facebook'));