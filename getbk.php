<?php
require_once 'configuration.php'; 
$config=new JConfig; 
mysql_connect('localhost',$config->user,$config->password);
mysql_select_db($config->db);
mysql_query('SET NAMES "utf-8"');
 
$cmd='SELECT * FROM `jos_baokim` '; 
$info=mysql_fetch_assoc(mysql_query($cmd));
var_dump(unserialize($info['data'])); 
//var_dump($datatmp);
?>