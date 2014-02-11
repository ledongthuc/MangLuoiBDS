<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package		Jea.site
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// init com U_Re
require_once JPATH_COMPONENT.DS.'u_re.class.php';
require_once JPATH_COMPONENT.DS.'defines.php';
require_once 'libraries/com_u_re/php/config.php';

//add ACL
$acl = & JFactory::getACL();
$acl->addACL( 'com_u_re', 'edit', 'users', 'jea agent', 'property', 'own' );
$acl->addACL( 'com_u_re', 'edit', 'users', 'registered', 'property', 'own' );
$acl->addACL( 'com_u_re', 'edit', 'users', 'manager', 'property', 'all' );
$acl->addACL( 'com_u_re', 'edit', 'users', 'administrator', 'property', 'all' );
$acl->addACL( 'com_u_re', 'edit', 'users', 'super administrator', 'property', 'all' );

// global config
global $u_reGlobalConfig;
$u_reGlobalConfig = U_ReConfig::getParams();

ComU_Re::run('properties');
