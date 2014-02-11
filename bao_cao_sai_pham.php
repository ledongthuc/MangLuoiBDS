<?php 
require 'configuration.php';
$conf = new JConfig();
$conn = mysql_connect($conf->host, $conf->user,$conf->password);
mysql_select_db($conf->db, $conn);
$sql="UPDATE iland4_bat_dong_san_vi SET bao_cao_sai_pham = 1 WHERE id=".$_GET['id'];
mysql_query($sql);
?>