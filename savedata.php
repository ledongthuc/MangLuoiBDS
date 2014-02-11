<?php
	define( '_JEXEC', 1 );
	define('JPATH_BASE', dirname(__FILE__));
	define( 'DS', DIRECTORY_SEPARATOR );
	require_once (JPATH_BASE . DS .'includes'.DS.'defines.php');
	require_once (JPATH_BASE . DS .'includes'.DS.'framework.php'); 
	$mainframe = JFactory::getApplication('site');    
	$session     = &JFactory::getSession(); 
	if (isset($_POST['abc'])) {
		$_SESSION['napquyen']=1;
		die();
	} 
	require_once 'configuration.php'; 
	$config=new JConfig; 
	mysql_connect('localhost',$config->user,$config->password);
	mysql_select_db($config->db); 
	mysql_query('SET NAMES "utf8"'); 
	
	$manga=$_POST['manga'];$mangb=$_POST['mangb'];$mangc=$_POST['mangc'];

	$dema=$_POST['dema'];$demb=$_POST['demb'];$demc=$_POST['demc']; 	   
	$daytin=0; $danhdau=0; $noibat=0; 
	
	$time=time();
	
	for ($i=1;$i<=$dema;$i++) 
		if  ($manga[7][$i]!=1) {
			$daytin+=$manga[4][$i];
			$datestart = $manga[1][$i].' '.$manga[2][$i].':'.$manga[3][$i];  
			$dateend = $manga[8][$i].' '.$manga[2][$i].':'.$manga[3][$i]; 
			
			if (!isset($manga[9][$i])) $mua=0; else $mua=$manga[9][$i];
			if (!isset($manga[10][$i])) $km=0; else $km=$manga[10][$i];
			
			$type=1;
			$status=0;
			$dstart=strtotime($datestart);
			$dend=strtotime($dateend); 
			$avg=$dend-$dstart;
			
			if ($dstart<$time) {
				$dstart=$time;
				$status=1;
				$dend=$dstart+$avg; 
			}
			  
			if ($dstart==$time) {
				$cmd="UPDATE `iland4_bat_dong_san_vi` SET ngay_chinh_sua=".$time." WHERE id=".$_POST['post'];
				mysql_query($cmd); 
			}
			
			$cmd='INSERT INTO `jos_push` VALUES (0,'.$_POST['post'].','.$_POST['user'].','.$dstart.','.$dend.','.$type.','.$status.','.$time.','.$mua.','.$km.')';  
			mysql_query($cmd);
		}
	for ($i=1;$i<=$demb;$i++)
		if  ($mangb[7][$i]!=1){  	 
			$danhdau+=$mangb[4][$i]; 
			$datestart = $mangb[1][$i].' '.$mangb[2][$i].':'.$mangb[3][$i];  
			$dateend = $mangb[8][$i].' '.$mangb[2][$i].':'.$mangb[3][$i]; 
			
			if (!isset($mangb[9][$i])) $mua=0; else $mua=$mangb[9][$i];
			if (!isset($mangb[10][$i])) $km=0; else $km=$mangb[10][$i];
			
			$type=2; 
			
			$dstart=strtotime($datestart);
			$dend=strtotime($dateend);
			$avg=$dend-$dstart;
			
			if ($dstart<$time) {
				$dstart=$time;
				$dend=$dstart+$avg;
			}
			
			$cmd='INSERT INTO `jos_push` VALUES (0,'.$_POST['post'].','.$_POST['user'].','.$dstart.','.$dend.','.$type.',0,'.$time.','.$mua.','.$km.')'; 		
			mysql_query($cmd);   
		}
	for ($i=1;$i<=$demc;$i++) 
		if  ($mangc[7][$i]!=1) {  	  
			$noibat+=$mangc[4][$i];
			$datestart = $mangc[1][$i].' '.$mangc[2][$i].':'.$mangc[3][$i];    
			$dateend = $mangc[8][$i].' '.$mangc[2][$i].':'.$mangc[3][$i];
			
			if (!isset($mangc[9][$i])) $mua=0; else $mua=$mangc[9][$i];
			if (!isset($mangc[10][$i])) $km=0; else $km=$mangc[10][$i];
			
			$type=3;
			
			$dstart=strtotime($datestart);
			$dend=strtotime($dateend);
			$avg=$dend-$dstart;
			
			if ($dstart<$time) { 
				$dstart=$time;
				$dend=$dstart+$avg;
			}
			 
			$cmd='INSERT INTO `jos_push` VALUES (0,'.$_POST['post'].','.$_POST['user'].','.$dstart.','.$dend.','.$type.',0,'.$time.','.$mua.','.$km.')'; 
			mysql_query($cmd); 
		}  
	$cmd='SELECT * FROM `jos_users` WHERE id='.$_POST['user'];
	$info=mysql_fetch_assoc(mysql_query($cmd));
	// SUBTRACT 
	
	if ($info['km_daytin']>=$daytin) $cmd='UPDATE `jos_users` SET km_daytin='.($info['km_daytin']-$daytin).' WHERE id='.$_POST['user']; else
	$cmd='UPDATE `jos_users` SET km_daytin=0,mua_daytin='.($info['mua_daytin']+$info['km_daytin']-$daytin).' WHERE id='.$_POST['user'];
	mysql_query($cmd);
	
	if ($info['km_danhdau']>=$danhdau) $cmd='UPDATE `jos_users` SET km_danhdau='.($info['km_danhdau']-$danhdau).' WHERE id='.$_POST['user']; else
	$cmd='UPDATE `jos_users` SET km_danhdau=0,mua_danhdau='.($info['mua_danhdau']+$info['km_danhdau']-$danhdau).' WHERE id='.$_POST['user']; 
	mysql_query($cmd);
	
	if ($info['km_noibat']>=$noibat) $cmd='UPDATE `jos_users` SET km_noibat='.($info['km_noibat']-$noibat).' WHERE id='.$_POST['user']; else
	$cmd='UPDATE `jos_users` SET km_noibat=0,mua_noibat='.($info['mua_noibat']+$info['km_noibat']-$noibat).' WHERE id='.$_POST['user']; 
	mysql_query($cmd);   
	  
	$_SESSION['hengio']=0; 
?>