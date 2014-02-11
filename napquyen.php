<?php
	require_once 'configuration.php';
	$config=new JConfig;
	mysql_connect('localhost',$config->user,$config->password);
	mysql_select_db($config->db);
	mysql_query('SET NAMES "utf-8"');
	$cmd='SELECT * FROM `jos_users` WHERE id='.$_POST['user'];
	$info=mysql_fetch_assoc(mysql_query($cmd));   
	echo $info['mua_daytin'].'-'.$info['mua_danhdau'].'-'.$info['mua_noibat'].'|'.$info['km_daytin'].'-'.$info['km_danhdau'].'-'.$info['km_noibat'].'|'; 