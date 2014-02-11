<?php
session_start();
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );
// Required Files 
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
// To use Joomla's Database Class 
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
// Create the Application 
$mainframe =& JFactory::getApplication('site');

$session = &JFactory::getSession();
if($session->get('valueCompare_1'))
{
	$session->set('valueCompare_2', $_GET['id']);	
}
else
{
	$session->set('valueCompare_1', $_GET['id']);
} 

?>