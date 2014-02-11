<?php
error_reporting(E_ALL);
require_once '../../../configuration.php'; 
$config=new JConfig; 
mysql_connect('localhost',$config->user,$config->password);
mysql_select_db($config->db); 
mysql_query('SET NAMES "utf-8"');

if (isset($_GET['key'])){
    $key=$_GET['key']; 
    $sql="SELECT * FROM `jos_users` WHERE gid=0 AND username LIKE '%$key%'"; 

    $excute = mysql_query($sql);
    $dem=0;

    $soDong = mysql_num_rows($excute);
    echo '<script>sum='.$soDong.'</script>';
    echo '<table class="listselect">
         <th width="25px"><input type="checkbox" onclick="checkall('."'nonuser'".',this)"/></th>
         <th width="100px">Username</th>
         <th>Email</th>';
    while ($info=mysql_fetch_array($excute,MYSQL_ASSOC)){
        echo '<tr>';
        echo '<td><input type="checkbox" class="nonuser" id="box2_'.$dem.'" uid="'.$info['id'].'" uname="'.$info['username'].'" uemail="'.$info['email'].'"/></td>';
        echo '<td>'.$info['username'].'</td>';
        echo '<td>'.$info['email'].'</td>';
        echo '</tr>';
        $dem++;
    }
    echo '</table>';
}
?>