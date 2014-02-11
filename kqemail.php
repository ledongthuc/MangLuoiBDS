<?php


//
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

$sql = "SELECT username FROM #__users WHERE email = '" . $_GET['email'] . "'";
$db = & JFactory::getDBO();
$db->setQuery($sql);
$result = $db->loadObjectList();

if ( $db->getErrorNum() ) {
JError::raiseWarning( 200, $db->getErrorMsg() );
}
if(count($result) > 0){
	if($_GET['email']!=''){
		echo '<input type="hidden" name="emailFail" id="emailFail" value="1"  /><i style="padding-left: 16px;font-size: 11px;color:red">Email "'. $_GET['email'].'" đã tồn tại !</i>';
	}
}
else{
		echo '<input type="hidden" name="emailFail" id="emailFail" value="0"  />';
}
?>