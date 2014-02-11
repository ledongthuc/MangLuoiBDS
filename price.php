<?php 
	require_once 'configuration.php'; 
	$config=new JConfig;
	mysql_connect('localhost',$config->user,$config->password);
	mysql_select_db($config->db); 
	mysql_query('SET NAMES "utf-8"');
	if ($_POST['group']==40) $group=0; else $group=1; 
	// CHIET KHAU THEO NHOM NGUOI DUNG
	/*$cmd='SELECT * FROM `jos_core_acl_aro_groups` WHERE id="'.$group.'"';  
	$inf=mysql_fetch_assoc(mysql_query($cmd));
	$ck=$inf['chietKhau'];  */    
	 
	// CHIET KHAU THEO SO LUONG
	
	$cmd='SELECT * FROM `jos_price` WHERE groups="'.$group.'" AND types='.$_POST['type'].' ORDER BY max ASC'; 
	if (mysql_num_rows(mysql_query($cmd))==0){
		$cmd='SELECT * FROM `jos_price` WHERE groups="0" AND types='.$_POST['type'].' ORDER BY max ASC';  
	}  
	$excute=mysql_query($cmd); 
	$ok=false;  
	if (mysql_num_rows($excute)==1){
		$info=mysql_fetch_assoc($excute);
		$chietkhau=round((float)(1.00-$info['discount']/$info['price'])*100,2);
		echo $chietkhau.'|'.$info['price']; 
	} else {  
		while ($info=mysql_fetch_array($excute,MYSQL_ASSOC)){		
		    $chietkhau=round((float)(1.00-$info['discount']/$info['price'])*100,2); 
			if ($info['max']==0){           
				if ($info['min']<=$_POST['max']){
					echo $chietkhau.'|'.$info['price']; 
					$ok=true;
					break; 
				} 
			} else {
				if (($info['min']<=$_POST['max'])&&($info['max']>=$_POST['max'])){
					echo $chietkhau.'|'.$info['price'];
					$ok=true;
					break; 
				}	
			}
		}	 	
	}	
?>  	