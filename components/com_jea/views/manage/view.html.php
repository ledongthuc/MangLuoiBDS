<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package     Jea.site
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
require_once JPATH_COMPONENT.DS.'view.php';

// print_r( JPATH_COMPONENT );
// exit;
// require_once JPATH_COMPONENT.DS.'models'.DS.'properties.php';
require_once(JPATH_ROOT . '/libraries/com_u_re/models/properties.php');
//require_once JPATH_COMPONENT_ADMINISTRATOR .DS.'models'.DS.'properties.php';
//require_once JPATH_COMPONENT_ADMINISTRATOR .DS.'models'.DS.'features.php';
//$test = JeaViewManage::test();

class JeaViewManage extends JeaView
{
	function tetst()
	{
		return "test";
	}
}


