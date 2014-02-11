<?php
/**
 * Main File
 *
 * @package     CustoMenu
 * @version     2.5.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'customenu'.DS.'helper.php');
$show_page = ( JRequest::getVar( 'controller' ) == 'menuitems' );

$output = modCustoMenuHelper::getOutput( $params );

require( JModuleHelper::getLayoutPath( 'mod_customenu'.DS.'customenu' ) );