<?php 
error_reporting(); 
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__));
define( 'DS', DIRECTORY_SEPARATOR );
require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');
$mainframe = JFactory::getApplication('site'); 
$session     = &JFactory::getSession();
$link='';
require_once 'configuration.php'; 
require_once('nganluong/config.php'); 
require_once('nganluong/include/lib/nusoap.php');
require_once('nganluong/include/nganluong.microcheckout.class.php'); 
	  
$config=new JConfig; 
mysql_connect('localhost',$config->user,$config->password);
mysql_select_db($config->db);
mysql_query('SET NAMES "utf-8"');
 
function desession() {
	global $code,$pass,$link;
	$link=$_SESSION['www']; 
	unset($_SESSION['payment']);
	$code='';
	$pass='';
} 
// THANH TOÁN THÀNH CÔNG
function success($data,$mt) {  
	// User đã đăng nhập  
	if ($data['user']!=0) {     
	    $user=$data['user'];  $start=time(); $end=$start+86400; $date=$start;   
		if ($data['daytin']<0) return; 
		if ($data['danhdau']<0) return;
		if ($data['noibat']<0) return;  
		
		$cmd="INSERT INTO `jos_history` (userid,time,method,daytin,danhdau,noibat,tongcong) VALUES (".$user.",".$date.",'".$mt."','".$data['daytin'].'|'.$data['gia1']."','".$data['danhdau'].'|'.$data['gia2']."','".$data['noibat'].'|'.$data['gia3']."',".$data['price'].")";
		@mysql_query($cmd);   
		$cmd="SELECT * FROM `jos_users` WHERE id=".$data['user'];  
		$info=mysql_fetch_assoc(mysql_query($cmd));  
		$daytin=$info['mua_daytin']+$data['daytin'];  
		$danhdau=$info['mua_danhdau']+$data['danhdau']; 
		$noibat=$info['mua_noibat']+$data['noibat'];
		$cmd="UPDATE `jos_users` SET mua_daytin=".$daytin.', mua_danhdau='.$danhdau.',mua_noibat='.$noibat.' WHERE id='.$data['user'];
		@mysql_query($cmd);		
		if ($_SESSION['payment']=='nganluong') {
			desession(); 
			global $link;  
			header('location:'.$link);
		}		
	} else {    
		$manga=$data['a'];$mangb=$data['b'];$mangc=$data['c'];
		$dema=$data['dema'];$demb=$data['demb'];$demc=$data['demc']; 	   
		$manga=str_replace('undefined',0,$manga); 
		$user=0;  $start=time(); $end=$start+86400; $date=$start; 
		$daytin1=0; $danhdau1=0; $noibat1=0;
		$gia1=0; $gia2=0; $gia3=0;
	
		for ($i=1;$i<=$dema;$i++)
			if ($manga[7][$i]!=1) {
				++$daytin1;
				$gia1=$manga[5][$i];
				$datestart = $manga[1][$i].' '.$manga[2][$i].':'.$manga[3][$i];  
				$dateend = $manga[8][$i].' '.$manga[2][$i].':'.$manga[3][$i];  
				$type=1; 
				$cmd='INSERT INTO `jos_push` VALUES (0,'.$data['post'].','.$data['user'].','.strtotime($datestart).','.strtotime($dateend).','.$type.',0,'.time().')';  
				@mysql_query($cmd);
		}	
		for ($i=1;$i<=$demb;$i++)
			if  ($mangb[7][$i]!=1) {  	 
				++$danhdau1;
				$gia2=$mangb[5][$i];
				$datestart = $mangb[1][$i].' '.$mangb[2][$i].':'.$mangb[3][$i];   
				$dateend=$mangb[8][$i].' '.$mangb[2][$i].':'.$mangb[3][$i];  
				$type=2;
				$cmd='INSERT INTO `jos_push` VALUES (0,'.$data['post'].','.$data['user'].','.strtotime($datestart).','.strtotime($dateend).','.$type.',0,'.time().')'; 
				@mysql_query($cmd);  
		}  
		for ($i=1;$i<=$demc;$i++) 
			if  ($mangc[7][$i]!=1) {   	  
				++$noibat1;
				$gia3=$mangc[5][$i];  
				$datestart = $mangc[1][$i].' '.$mangc[2][$i].':'.$mangc[3][$i];   
				$dateend=$mangc[8][$i].' '.$mangc[2][$i].':'.$mangc[3][$i];  
				$type=3;  
				$cmd='INSERT INTO `jos_push` VALUES (0,'.$data['post'].','.$data['user'].','.strtotime($datestart).','.strtotime($dateend).','.$type.',0,'.time().')';  
				@mysql_query($cmd);
		}
		$cmd="INSERT INTO `jos_history` (userid,time,method,daytin,danhdau,noibat,tongcong) VALUES (".$user.",".$date.",'".$mt."','".$daytin1."|".$gia1."','".$danhdau1."|".$gia2."','".$noibat1."|".$gia3."',".$data['price'].")";  	 
		@mysql_query($cmd);  
		
		desession(); 
		global $link;
		header('location:'.$link);
	} 
}

// THANH TOÁN THẤT BẠI 
function fail(){ 
	desession();
	global $link;
	echo '<meta charset="utf-8"/><script>alert("Giao dịch không thành công !"); 
	window.location="'.$link.'";</script>'; 
} 
 
if ($_SESSION['payment']=='nganluong') {
$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
if ($obj->checkReturnUrlAuto()) {
	$inputs = array(
		'token'=> $obj->getTokenCode(),
	);
	$result = $obj->getExpressCheckout($inputs);
	if ($result != false) {
		if ($result['result_code'] != '00') {
			fail();
		}
	} else {
		die('<meta charset="utf-8"/>Lỗi kết nối tới cổng thanh toán Ngân Lượng');
	}
} else {
	die('<meta charset="utf-8"/>Tham số truyền không đúng');
} 

$code=$_SESSION['code'];
$pass=$_SESSION['pass'];
$link='';
if (isset($result) && !empty($result)) {
		if ($result['result_code'] == '00') {
			success($_SESSION,'Ngân Lượng'); 
		} else fail();
	} else fail();	
}	

if (isset($_POST['transaction_id'])) {
$req = '';  
foreach ( $_POST as $key => $value ) {
	$value = urlencode ( stripslashes ( $value ));
	$req .= "&$key=$value";
}
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL,'https://www.baokim.vn/bpn/verify');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$error = curl_error($ch); 

if($result != '' && strstr($result,'VERIFIED') && $status==200) {
	//thuc hien update hoa don
	$order_id = $_POST['order_id'];
	$transaction_id = $_POST['transaction_id'];
	$transaction_status = $_POST['transaction_status'];
	$total_amount = $_POST['total_amount'];
	$customer_name = $_POST['customer_name'];
	$customer_address = $_POST['customer_address']; 
if ($transaction_status == 4||$transaction_status == 13) {
		$cmd='SELECT * FROM `jos_baokim` WHERE code="'.$order_id.'"';
	    $info=mysql_fetch_assoc(mysql_query($cmd));
	    $datatmp=unserialize($info['data']); 
		success($datatmp,'Bảo Kim');    
	}  
} 
}