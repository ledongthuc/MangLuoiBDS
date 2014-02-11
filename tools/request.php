<?php
	set_time_limit(0);  // MAX TIME EXCUTE
	require_once '../configuration.php';
	require_once 'phpmailer.php';
	
	$config=new JConfig;
	mysql_connect('localhost',$config->user,$config->password);
	mysql_select_db($config->db);
	mysql_query('SET NAMES "utf8"'); 
	
	function email($from,$fromname,$to,$subject,$msg) {		
		$mail = new PHPMailer();
		$mail->IsMail();
		$mail->CharSet = "utf-8";
		$mail->AddReplyTo($from,$fromname);
		$mail->AddAddress($to);
		$mail->SetFrom($from,$fromname);
		$mail->Subject = $subject;
		$mail->MsgHTML($msg); 
		$mail->Send();
	}
	$sql="SELECT * FROM  `jos_yeu_cau_bds` "; //LEFT JOIN `jos_users` ON jos_yeu_cau_bds.email=jos_users.id";  
	$excute=mysql_query($sql);
	while ($inf=mysql_fetch_array($excute,MYSQL_ASSOC)) {
		$cmd=str_replace('@',"'",$inf['query']); 
		$cmd=str_replace('#',"<>",$cmd);  	
		$excute2=mysql_query($cmd);	
		$demtin=0;  
		if (($excute2)&&(mysql_num_rows($excute2)!=0)) {
			$num=mysql_num_rows($excute2); 
			$table='';
			$sent=false;
			if ($inf['cronjob']==1) $sent=true;
			while ($info=mysql_fetch_array($excute2,MYSQL_ASSOC)) {   
				$time=time();
				if ((!$sent)||($time-86400<$info['ngay_chinh_sua'])) {  
					$demtin++;  
					$table.=' 
					<tr> 
					<td width="40px">'.$info['id'].'</td>
					<td width="250px"><a href="http://mangluoibds.vn/nhadat/'.$info['alias'] .'/viewDetail/186/'.$info['id'].'">'.$info['tieu_de'].'</a></td>
					<td>Giá nguyên căn: '.$info['gia_nguyen_can'].' - Diện tích sử dụng: '.$info['dien_tich_su_dung'].' - Phòng ngủ: '.$info['phong_ngu'].' - Phòng tắm: '.$info['phong_tam'].' - Địa chỉ: '.$info['dia_chi'].'</td>
					</tr>
					';  
				}    
			}    
			$stoplink='http://mangluoibds.vn/stop.php?id='.$inf['user_id'].'&code='.md5(sha1($inf['user_id'].$inf['email'])); 
			$content=file_get_contents(dirname(__DIR__).'/email.html'); 	
			$content=str_replace('@soluong@',$num,$content); 
			$content=str_replace('@table@',$table,$content);
			$content=str_replace('@nickname@',is_numeric($inf['user_id'])?$inf['username']:'bạn',$content); 
			$content=str_replace('@stop@',$stoplink,$content);
			if ($demtin>0) { 
				email('info@mangluoibds.vn','Mạng lưới Bất Động Sản',$inf['email'],'Thông báo có '.$num.' BÐS thoả yêu cầu !',$content); 
			}
			if (!$sent) {    
				$cmd='UPDATE `jos_yeu_cau_bds` SET cronjob=1 WHERE email="'.$inf['email'].'"';
				mysql_query($cmd);
			}   
		}
	}
?>