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

$sql = "SELECT username FROM #__users WHERE username = '" . $_GET['username'] . "'";
$db = & JFactory::getDBO();
$db->setQuery($sql);
$result = $db->loadObjectList();

if ( $db->getErrorNum() ) {
JError::raiseWarning( 200, $db->getErrorMsg() );
}
if(count($result) > 0)
	if($_GET['username']!=''){
		echo '<input type="hidden" id="userFail" value="1"  />Tên tài khoản "'. $_GET['username'].'" đã tồn tại !';
	}else{
		echo '<input type="hidden" id="userFail" value="1"  /><i style="color:black">Tên đăng nhập chỉ bao gồm ký tự từ a-z, 0-9</i>';
	}
else
		echo '<input type="hidden" id="userFail" value="0"  /><i style="color:black">Tên đăng nhập chỉ bao gồm ký tự từ a-z, 0-9</i>';
?>