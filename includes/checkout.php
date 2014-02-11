<?php 
if (!isset($_POST['payment'])) die(); 
echo 'OK';
define('_JEXEC',1);  
define('JPATH_BASE','/home/mlbds/domains/mangluoibds.vn/public_html'); 
define( 'DS', DIRECTORY_SEPARATOR ); 
require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');
require_once(JPATH_BASE . DS . 'nganluong/config.php');
require_once(JPATH_BASE . DS .'nganluong/include/lib/nusoap.php');
require_once(JPATH_BASE . DS .'nganluong/include/nganluong.microcheckout.class.php');
require_once JPATH_BASE . DS .'configuration.php';  
$config=new JConfig;   
mysql_connect('localhost',$config->user,$config->password); 
mysql_select_db($config->db);   
mysql_query('SET NAMES "utf-8"'); 
//-------------------------
require_once(dirname(__FILE__).'/model/'.$_POST['payment'].'.php');

$mainframe = JFactory::getApplication('site');
$session     = &JFactory::getSession();
$ses['hengio']=$_SESSION['hengio']=1;  
$ses['payment']=$_SESSION['payment']=$_POST['payment']; 
$ses['a']=$manga=$_SESSION['a']=$_POST['a'];
$ses['b']=$mangb=$_SESSION['b']=$_POST['b'];
$ses['c']=$mangc=$_SESSION['c']=$_POST['c'];
$ses['danhdau']=$danhdau=$_SESSION['danhdau']=$_POST['danhdau'];
$ses['daytin']=$daytin=$_SESSION['daytin']=$_POST['daytin'];
$ses['noibat']=$noibat=$_SESSION['noibat']=$_POST['noibat']; 
$ses['mark']=$_SESSION['mark']=$_POST['mark'];
$ses['dema']=$dema=$_SESSION['dema']=$_POST['dema'];  
$ses['demb']=$demb=$_SESSION['demb']=$_POST['demb']; 
$ses['demc']=$demc=$_SESSION['demc']=$_POST['demc'];  
$ses['www']=$_SESSION['www']=$_POST['www'];
$ses['user']=$_SESSION['user']=$_POST['user'];
$ses['post']=$_SESSION['post']=$_POST['post'];
$ses['gia1']=$gia1=$_SESSION['gia1']=$_POST['ddgia1']; 
$ses['gia2']=$gia2=$_SESSION['gia2']=$_POST['ddgia2'];  
$ses['gia3']=$gia3=$_SESSION['gia3']=$_POST['ddgia3']; 
$code=$_POST['code']-12743; // secure 
$ses['code']=$_SESSION['code']=$code;   
$pass=$_POST['pass'];
$ses['pass']=$_SESSION['pass']=$pass;
$receiver=$_POST['email']; 
$return_url=$_POST['url'];  
$cancel_url='http://mangluoibds.vn';
$price=$_POST['price']; 
$ses['price']=$_SESSION['price']=$_POST['price'];
$order_code=$_POST['order'];
$order_description=$_POST['detail'];
$ordercode='AB2D'.date('His-dmY'); 
	if ($_POST['payment']=='nganluong') {
		$amount = 0;
		$items=array();

		if  ($_SESSION['user']==0){
		$daytin=0; $sum=0;
		for ($i=1;$i<=$dema;$i++)
			if ($manga[7][$i]!=1) {
				$daytin+=$manga[4][$i];
				$sum+=$manga[4][$i]*$manga[5][$i];
			}
		$items[1] = array(
				'item_name'		=> 'Quyền đẩy tin',
				'item_quanty'	=> $daytin,
				'item_amount'	=> $sum
		);		
		
		$danhdau=0; $sum=0;
		for ($i=1;$i<=$demb;$i++)
			if ($mangb[7][$i]!=1) {
				$danhdau+=$mangb[4][$i];
				$sum+=$mangb[4][$i]*$mangb[5][$i];
			}
		$items[2] = array(
				'item_name'		=> 'Quyền đánh dấu tin',
				'item_quanty'	=> $danhdau,
				'item_amount'	=> $sum
		);
		
		$noibat=0; $sum=0;
		for ($i=1;$i<=$demc;$i++)
			if ($mangc[7][$i]!=1) {
				$noibat+=$mangc[4][$i]; 
				$sum+=$mangc[4][$i]*$mangc[5][$i];
			}
		$items[3] = array(
				'item_name'		=> 'Quyền  làm nổi bật tin',
				'item_quanty'	=> $noibat,
				'item_amount'	=> $sum
		);
		} else
		{
			$items[1] = array(
				'item_name'		=> 'Quyền đánh đẩy tin',
				'item_quanty'	=> $daytin,
				'item_amount'	=> $gia1
			);
			$items[2] = array(
				'item_name'		=> 'Quyền đánh dấu tin',
				'item_quanty'	=> $danhdau,
				'item_amount'	=> $gia2
			);
			$items[3] = array(
				'item_name'		=> 'Quyền làm nổi bật tin',
				'item_quanty'	=> $noibat,
				'item_amount'	=> $gia3
			);
		}
$inputs = array(
		'receiver'		=> RECEIVER,
		'order_code'	=> $ordercode,
		'amount'		=> $price,
		'currency_code'	=> 'vnd',
		'tax_amount'	=> '0',
		'discount_amount'	=> '0',
		'fee_shipping'	=> '0',
		'request_confirm_shipping'	=> '0',
		'no_shipping'	=> '1',
		'return_url'	=> $return_url,
		'cancel_url'	=> $cancel_url,
		'language'		=> 'vn',
		'items'			=> $items
	);
$link_checkout = '';
$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
$result = $obj->setExpressCheckoutPayment($inputs);
if ($result != false) { 
		if ($result['result_code'] == '00') {
			echo $result['link_checkout']; 
		} else {
			die('Mã lỗi '.$result['result_code'].' ('.$result['result_description'].') ');
		}
} else {
	die('Lỗi kết nối tới cổng thanh toán Ngân Lượng');
}
}   

if ($_POST['payment']=='baokim') {
		$data=serialize($ses);   
		$cmd='INSERT INTO `jos_baokim` VALUES(0,"'.$ordercode.'",\''.$data.'\')';
		mysql_query($cmd);  
		$url_cancel=$return_url;
		$url_detail=$return_url;
		$bk=new BaoKimPayment($code,$pass);
		echo $bk->createRequestUrl($ordercode,$receiver,$price,$fee_shipping,$tax,$order_description,$return_url,$url_cancel,$url_detail);
	}