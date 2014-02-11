<?php 
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) );
require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
require 'configuration.php';
include 'libraries/joomla/user/helper.php';
$mainframe =& JFactory::getApplication('site');
$conf = new JConfig();
$conn = mysql_connect($conf->host, $conf->user,$conf->password);
mysql_select_db($conf->db, $conn);
$userid = $_GET['userid'];
$sql="select id from jos_yeu_cau_bds where user_id='$userid'";
$kq = mysql_query($sql);
if(mysql_num_rows($kq)>0){
	echo 'ok';
}
?>