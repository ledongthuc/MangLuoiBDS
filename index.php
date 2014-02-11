<?php
/**
* @version		$Id: index.php 11407 2009-01-09 17:23:42Z willebil $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2009 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Set flag that this is a parent file
define( '_JEXEC', 1 );

// default properties controller
function microtime_float ()
{
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}

define('JPATH_BASE', dirname(__FILE__) );

define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

// Get starting time.
//$start = microtime_float();

JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;

/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('site');
$lang = JFactory::getLanguage();
$lang->setLanguage('vi');
     
function cron() {
	$db =& JFactory::getDBO();
	$time=time(); 
	$sql='SELECT * FROM `jos_push` WHERE type=1 AND status=0 AND start<='.$time;
	$db->setQuery($sql);
	$db->query();  
	$info=$db->loadObjectList(); 
	foreach ($info as $row) { 
		$cmd="UPDATE `iland4_bat_dong_san_vi` SET ngay_chinh_sua=".$row->start." WHERE id=".$row->bds; 
		mysql_query($cmd);   
		$cmd="UPDATE `jos_push` SET status=1 WHERE id=".$row->id;
		mysql_query($cmd); 
	}
}
cron();


/**
 * INITIALISE THE APPLICATION
 *
 * NOTE :
 */
// set the language
$mainframe->initialise();

JPluginHelper::importPlugin('system');

// trigger the onAfterInitialise events
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;
$mainframe->triggerEvent('onAfterInitialise');

/**
 * ROUTE THE APPLICATION
 *
 * NOTE :
 */
$mainframe->route();

// authorization
$Itemid = JRequest::getInt( 'Itemid');
$mainframe->authorize($Itemid);

// trigger the onAfterRoute events
JDEBUG ? $_PROFILER->mark('afterRoute') : null;
$mainframe->triggerEvent('onAfterRoute');

/**
 * DISPATCH THE APPLICATION
 *
 * NOTE :
 */
$option = JRequest::getCmd('option');
$mainframe->dispatch($option);

// trigger the onAfterDispatch events
JDEBUG ? $_PROFILER->mark('afterDispatch') : null;
$mainframe->triggerEvent('onAfterDispatch');


/**
 * RENDER  THE APPLICATION
 *
 * NOTE :
 */
$mainframe->render();

// trigger the onAfterRender events
JDEBUG ? $_PROFILER->mark('afterRender') : null;
$mainframe->triggerEvent('onAfterRender');


/**
 * RETURN THE RESPONSE
 */
echo JResponse::toString($mainframe->getCfg('gzip'));

//$end = microtime_float();

//echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';
