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

$dsduan=modDS_DuAn::LayDSDuAn($params);
$ma_duan=JRequest::getVar( 'id', '0');
$itemId=JRequest::getVar( 'Itemid', '');
if($itemId!='')
	$itemId='&Itemid='.$itemId;

require(JModuleHelper::getLayoutPath('mod_DS_DuAn'));