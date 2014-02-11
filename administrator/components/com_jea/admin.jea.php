<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require JPATH_COMPONENT.DS.'jea.class.php' ;
require_once(JPATH_ROOT.DS.'libraries'.DS.'com_u_re'.DS.'php'.DS.'config.php');

// global config
global $u_reGlobalConfig;
$u_reGlobalConfig = U_ReConfig::getParams();
ComJea::run();

