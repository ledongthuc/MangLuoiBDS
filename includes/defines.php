<?php
/**
* @version		$Id: defines.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
//echo("test");
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Joomla! Application define
*/

//Global definitions
//Joomla framework path definitions
$parts = explode( DS, JPATH_BASE );

//Defines
define( 'JPATH_ROOT',			implode( DS, $parts ) );

define( 'JPATH_SITE',			JPATH_ROOT );
define( 'JPATH_CONFIGURATION', 	JPATH_ROOT );
define( 'JPATH_ADMINISTRATOR', 	JPATH_ROOT.DS.'administrator' );
define( 'JPATH_XMLRPC', 		JPATH_ROOT.DS.'xmlrpc' );
define( 'JPATH_LIBRARIES',	 	JPATH_ROOT.DS.'libraries' );
define( 'JPATH_PLUGINS',		JPATH_ROOT.DS.'plugins'   );
define( 'JPATH_INSTALLATION',	JPATH_ROOT.DS.'installation' );
define( 'JPATH_THEMES'	   ,	JPATH_BASE.DS.'templates' );
define( 'JPATH_CACHE',			JPATH_BASE.DS.'cache');

// define for com U_Re

// Define views
define( 'COM_U_RE_VIEW_PROPERTY', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'views'.DS.'properties'.DS.'view.html.php' );
define( 'COM_U_RE_VIEW_PROJECT', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'views'.DS.'projects'.DS.'view.html.php' );
define( 'COM_U_RE_VIEW_REALTOR', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'views'.DS.'realtors'.DS.'view.html.php' );

// Define models
define( 'COM_U_RE_MODEL_PROPERTY', JPATH_LIBRARIES.DS.'com_u_re'.DS.'models'.DS.'properties.php' );
define( 'COM_U_RE_MODEL_PROJECT', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'models'.DS.'projects.php' );
define( 'COM_U_RE_MODEL_REALTOR', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'models'.DS.'realtors.php' );
define( 'COM_U_RE_MODEL_DATAXML', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'models'.DS.'data.xml' );
											
// Define controllers
define( 'COM_U_RE_CONTROLLER_PROPERTY', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'controllers'.DS.'properties.php' );
define( 'COM_U_RE_CONTROLLER_PROJECT', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'controllers'.DS.'projects.php' );
define( 'COM_U_RE_CONTROLLER_REALTOR', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re'.DS.'controllers'.DS.'realtors.php' );

// Define config
define( 'COM_U_RE_CONFIG_FILE_PATH', JPATH_ROOT.DS.'com_u_re_config.ini' );

// Define utils
define( 'COM_U_RE_UTILS', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re' . DS .'utils.php' );

// Define simul test
define( 'COM_U_RE_SIMUL_TEST', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re' . DS .'simul_test.php' );

// Define libararies project model
define( 'COM_U_RE_LIBRARIES_MODEL_PROJECT', JPATH_BASE . DS .'libraries'.DS.'com_u_re'.DS.'models'.DS.'projects.php' );

// Define libararies  common_utils.php
define( 'COM_U_RE_COMMON_UTILS', JPATH_LIBRARIES.DS.'com_u_re'.DS.'php'.DS.'common_utils.php' );

// Define some icons, image
define ( 'COM_U_RE_PROPERTY_IMAGE_NO_PHOTO', 'images/icons/image_no_photo.jpg' );
define ( 'COM_U_RE_PROPERTY_IMAGE_NO_PHOTO_THUMBNAIL', 'images/icons/image_no_photo_thumbnail.jpg' );
define ( 'COM_U_RE_ICON_VIP', 'images/icons/icon_vip.png' );
define ( 'COM_U_RE_ICON_CHECK', 'images/icons/icon_.png' );
define ( 'IMAGE_AJAXPAGING_PRE', 'images/button_pre.gif');
define ( 'IMAGE_AJAXPAGING_NEXT', 'images/button_next.gif');
