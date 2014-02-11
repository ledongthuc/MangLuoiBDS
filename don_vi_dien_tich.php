<?php 
require 'configuration.php';
$conf = new JConfig();
$conn = mysql_connect($conf->host, $conf->user,$conf->password);
$dieukien = $_GET['kind_id'];
mysql_select_db($conf->db, $conn);
mysql_query("set names 'utf8'");
if($dieukien==1||$dieukien==3){
	$sql="select * from iland4_don_vi_dien_tich_vi where id in (1,2) order by ordering asc";
}
else{
	$sql="select * from iland4_don_vi_dien_tich_vi where id in (3,4) order by ordering asc";
}
$result = mysql_query($sql);
while ($danhsach = mysql_fetch_assoc($result)){
	echo "<option value=".$danhsach['id'].">".$danhsach['ten']."</option>";
}
?>
