<?php
	require_once  '../../../configuration.php';
	$config=new JConfig;	
	mysql_connect('localhost',$config->user ,$config->password);
	mysql_select_db($config->db);
	mysql_query('SET NAMES "utf8"');
	$cmd="UPDATE `iland4_bat_dong_san_vi`  SET facebook=1 WHERE id=".$_GET['id'];
	mysql_query($cmd); 
?>