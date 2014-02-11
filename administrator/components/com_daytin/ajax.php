<?php
//error_reporting(E_ALL);
require_once  '../../../configuration.php'; 
$config=new JConfig;	
mysql_connect('localhost',$config->user ,$config->password);
mysql_select_db($config->db);
mysql_query('SET NAMES "utf8"');

if (isset($_GET['key'])) {
    $key=$_GET['key']; 
    if ($_GET['obj']==1)$cmd="SELECT * FROM `jos_users` WHERE gid<>25 AND gid<>32 AND gid<>40 AND gid<>17 AND gid<>29 AND gid<>18 AND gid<>19 AND gid<>20 AND gid<>24 AND gid<>23 AND gid<>30 AND gid<>21 AND gid<>28 AND gid<>33 AND gid<>31 AND username LIKE '%".$key."%'";
    else $cmd="SELECT * FROM `jos_core_acl_aro_groups` WHERE id<>25 AND id<>32 AND id<>40 AND id<>17 AND id<>29 AND id<>18 AND id<>19 AND id<>20 AND id<>24 AND id<>23 AND id<>30 AND id<>21 AND id<>28 AND id<>33 AND id<>31 AND name LIKE '%".$key."%'";
    $excute=mysql_query($cmd);
    echo '{"results":[';
    while ($info=mysql_fetch_array($excute,MYSQL_ASSOC)) {
        echo json_encode($info);  
        echo ','; 
    } 
    echo ']}';
} 

if (isset($_GET['update'])) { 
    $guser=explode('|',$_GET['update']);
	$data=explode('|',$_GET['data']);
	$select=$_GET['select']; 	
	if ($data[0]==-1) $data[0]=0;
	if ($data[1]==-1) $data[1]=0;
	if ($data[2]==-1) $data[2]=0; 
	
	$logdaytin=0;
	$logdanhdau=0; 
	$lognoibat=0;
	
	if ($data[3]==-1) $kmdaytin=''; else { $kmdaytin='km_daytin='.$data[3]; $logdaytin=$data[3]; }
	if ($data[4]==-1) $kmdanhdau=''; else { $kmdanhdau='km_danhdau='.$data[4]; $logdanhdau=$data[4]; }
	if ($data[5]==-1) $kmnoibat=''; else  { $kmnoibat='km_noibat='.$data[5];  $lognoibat=$data[5]; }
	
	if ($select==1) 
	foreach ($guser as $gu) {          
	    if ($gu=='') break;  
	    $sql="SELECT * FROM `jos_users` WHERE id=".$gu; 
		$info=mysql_fetch_assoc(mysql_query($sql));   
		//$time=time();
		//$cmd="INSERT INTO `jos_history` VALUES(0,".$gu.",".$time.",'Tặng quyền khuyến mãi',")"; 
		  
		$cmd="UPDATE `jos_users` SET mua_daytin=".($info['mua_daytin']+$data[0]).",mua_danhdau=".($info['mua_danhdau']+$data[1]).",mua_noibat=".($info['mua_noibat']+$data[2])." WHERE id=".$gu;
		mysql_query($cmd);
		 
		$cmd="UPDATE `jos_users` SET ".$kmdaytin." WHERE id=".$gu;
		if ($kmdaytin!='') mysql_query($cmd);
		
		$cmd="UPDATE `jos_users` SET ".$kmdanhdau." WHERE id=".$gu;
		if ($kmdanhdau!='')  mysql_query($cmd); 
	
		$cmd="UPDATE `jos_users` SET ".$kmnoibat." WHERE id=".$gu;
		if ($kmnoibat!='') mysql_query($cmd);
		
		// Log
		$time=time(); 
		if (($kmdaytin!='')||($kmdanhdau!='')||($kmnoibat!='')){ 
			$method='Admin khuyến mãi';  
			$sql="INSERT INTO `jos_history` VALUES (0,".$gu.",".$time.",'".$method."','".$logdaytin."|0','".$logdanhdau."|0','".$lognoibat."|0',0)";
			mysql_query($sql);
		} 
		if (($data[0]>0)||($data[1]>0)||($data[2]>0)){
			$method='Admin tặng quyền';  
			$sql="INSERT INTO `jos_history` VALUES (0,".$gu.",".$time.",'".$method."','".$data[0]."|0','".$data[1]."|0','".$data[2]."|0',0)";		
			mysql_query($sql); 
		}
	}	  
	
	if ($select==2) 
	foreach ($guser as $gu) { 
	    if ($gu=='') break; 
		$sql="SELECT * FROM `jos_users` WHERE gid=".$gu;
		$info=mysql_fetch_assoc(mysql_query($sql));   
		$cmd="UPDATE `jos_users` SET km_daytin=".$data[3].",km_danhdau=".$data[4].",km_noibat=".$data[5]." ,mua_daytin=".($info['mua_daytin']+$data[0]).",mua_danhdau=".($info['mua_danhdau']+$data[1]).",mua_noibat=".($info['mua_noibat']+$data[2])." WHERE gid=".$gu;
		mysql_query($cmd); 
	}	
}