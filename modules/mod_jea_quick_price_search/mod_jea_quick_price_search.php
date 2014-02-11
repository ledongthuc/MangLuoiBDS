<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version		1.2 2008-07
 * @package		Jea.module.search
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */
 defined('_JEXEC') or die('Restricted access');
// defined('BDS-ThienMinh-117') or die('chua co BDS-ThienMinh-117');
require_once (dirname(__FILE__).DS.'helper.php');
//conflict between component searchform and module searchform because both use same id's
$conflict = JRequest::getVar('option') == 'com_jea' && JRequest::getVar('layout') == 'search' ;

if(!$conflict){
	require(JModuleHelper::getLayoutPath('mod_jea_quick_price_search'));
}

