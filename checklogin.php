<?php 
require 'configuration.php';
include 'libraries/joomla/user/helper.php';
$conf = new JConfig();
$conn = mysql_connect($conf->host, $conf->user,$conf->password);
mysql_select_db($conf->db, $conn);
mysql_query("set names 'utf8'");
$username = $_GET['username'];
$sql="select id,name,phone,address,email,password,usertype from jos_users where email='$username'";
$kq = mysql_query($sql);
$kq = mysql_fetch_assoc($kq);

$parts = explode( ':', $kq['password']);
$crypt = $parts[0];
$salt = @$parts[1];
$testcrypt  = JUserHelper::getCryptedPassword($_GET['password'], $salt);
if($testcrypt==$crypt){
	echo  $kq['id'].",".$kq['phone'].",".$kq['address'].",".$kq['email'].",".$kq['usertype'].",".$kq['name'];
}?>