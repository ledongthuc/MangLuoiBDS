<?php

 /*define( '_JEXEC', 1 );
    define( 'DS', '/' );
    define('JPATH_BASE', dirname(__FILE__) );
    require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
    require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );*/
    //$direct_script_access=TRUE;
//
//	
//
   // global $mainframe;
   // $mainframe->triggerEvent('onCaptcha_confirm', array(false));
function read_text_file($in_filename) 
{
    $file = fopen($in_filename, 'r');
    $output = array();
    while (!feof($file)) {
        $buf = fgets($file);
        $output[] = $buf;
    }
    fclose($file);
    unlink($in_filename);
	return $output[0];
}
	
$ip = $_SERVER['REMOTE_ADDR'];
$ip = str_replace('.', '_', $ip);

$namefile =  $_SERVER['PHP_SELF'];
//$rootPath = realpath(realpath($namefile));
//while(!file_exists($rootPath.'/components'))
//{
//	$rootPath = dirname($rootPath); 
//}


$fileName = 'images/security_code/sercu_'.$ip.'.txt';
$securityCode = read_text_file($fileName);	   

$securityCodeInput = $_POST['osolCatchaTxt'];

if ( $securityCodeInput != $securityCode )
{
	echo "Wrong_code";
	exit;
}
    
require 'configuration.php';
$conf = new JConfig();
$conn = mysql_connect($conf->host, $conf->user,$conf->password);
mysql_select_db($conf->db, $conn);

$obj       = $_POST['id'];
$comp      = $_POST['component_name'];
$title     = $_POST['title'];
$comment   = $_POST['comment'];
$name      = $_POST['name'];
$email     = $_POST['email'];
$date      = date("Y-m-d H:i:s");
$title     = trim(strip_tags($title));
$comment   = trim(strip_tags($comment));
$name      = trim(strip_tags($name));
$topicName = $_POST['topic_name'];

$query = "insert into jos_jcomments (source,object_id,object_group,name,email,title,comment,date) values ('$topicName',$obj,'$comp','$name','$email','$title','$comment','$date')";
mysql_query(' SET NAMES UTF8 ');
mysql_query($query);
echo "OK";
?>
