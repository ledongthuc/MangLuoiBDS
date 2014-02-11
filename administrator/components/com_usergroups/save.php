<?php
require_once '../../../configuration.php'; 
$config=new JConfig; 
mysql_connect('localhost',$config->user,$config->password);
mysql_select_db($config->db); 
mysql_query('SET NAMES "utf8"');

if ((isset($_GET['st1']))&&(isset($_GET['st2']))& (isset($_GET['group']))){ 
    $mang1=explode(".",$_GET['st1']);  // 32.34.21.43 ID của user
    $mang2=explode(".",$_GET['st2']);  // 1.1.1.0. ID có hiển thị hay không, nếu 0 thì nouser, nếu 1 thì update thành $_GET['group'
    $n=count($mang2);
    for ($i=0;$i<=$n-2;$i++) {
        $param=($mang2[$i]=='0')?'0':$_GET['group'];
        $cmd="UPDATE `jos_users` SET gid=".$param.' WHERE id='.$mang1[$i]; 
        mysql_query($cmd); 
    }
}
?>