<?php
require_once 'configuration.php';
$config=new JConfig;
mysql_connect('localhost',$config->user,$config->password);
mysql_select_db($config->db);
mysql_query('SET NAMES "utf8"'); 

$cuphap=strtoupper($_REQUEST['message']);
$phone= $_REQUEST['phone'];
$service=$_REQUEST['service'];
$outb = md5(uniqid(rand(), true));
$tmp=explode(" ",$cuphap);

function response($phone,$note){ 
	echo '
	<ClientResponse>
		<Message>
		<PhoneNumber>'.$phone.'</PhoneNumber>
		<Message>Mang luoi Bat Dong San - Da '.$note.' thanh cong !</Message>
		<SMSID></SMSID>
		<ServiceNo></ServiceNo>
		</Message>
	</ClientResponse>'; 
} 
function apply($note,$type,$price){ 
	global $tmp,$phone;
	if  ($type==1) $add='daytin'; else 
		if ($type==2) $add='danhdau'; else $add='noibat';
	$bds=$tmp[2]; $user=$phone; $start=time(); $end=$start+86400; $date=$start;
	if ($type==1) $cmd="INSERT INTO `jos_push` (id,bds,user,start,end,type,date,mua,status) VALUES (0,".$bds.",".$phone.",".$start.",".$end.",".$type.",".$date.",1,1)"; 
						else $cmd="INSERT INTO `jos_push` (id,bds,user,start,end,type,date,mua) VALUES (0,".$bds.",".$phone.",".$start.",".$end.",".$type.",".$date.",1)"; 
	mysql_query($cmd);
	if ($type==1) {
		$cmd="UPDATE `iland4_bat_dong_san_vi` SET ngay_chinh_sua=".$date." WHERE id=".$bds;
		mysql_query($cmd); 
	}
	$cmd="INSERT INTO `jos_history` (userid,time,method,".$add.",tongcong) VALUES (".$user.",".$date.",'Tin nhắn SMS','1|".$price."',".$price.")"; 
	mysql_query($cmd); 
	response($user,$note); 
} 
function buy($note,$type,$count,$price){
	global $tmp,$phone;
	if  ($type==1) $add='daytin'; else  
		if ($type==2) $add='danhdau'; else $add='noibat';
	$acc=$tmp[2]; $user=$tmp[2]; $date=time();	
	$cmd="SELECT * FROM `jos_users` WHERE id=".$acc;
	$inf=mysql_fetch_assoc(mysql_query($cmd));
	$inc=$inf['mua_'.$add]+$count;
	$cmd="UPDATE `jos_users` SET mua_".$add.'='.$inc.' WHERE id='.$acc;
	mysql_query($cmd);
	$cmd="INSERT INTO `jos_history` (userid,time,method,".$add.",tongcong) VALUES (".$user.",".$date.",'Tin nhắn SMS','".$count."|".($price/$count)."',".$price.")"; 
        mysql_query($cmd); 
	response($phone,$note); 
}
switch ($tmp[1]){
	case 'NUP':apply('day tin',1,5000); 
		break;
	case 'NDD':apply('danh dau tin',2,10000);   
		break; 
	case 'NNB':apply('noi bat tin',3,15000); 
		break; 
	case 'MUP':buy('nap quyen day tin',1,2,5000); 
		break; 
	case 'MDD':buy('nap quyen danh dau tin',2,1,10000); 
		break;
	case 'MNB':buy('nap quyen noi bat tin',3,1,15000); 
		break;
} 
?>