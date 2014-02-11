<?php 
require_once("class/lang.php");
require_once("class/BKPaymentProService2.php");
// SENDING ...
$merchant_id    =  "6765";// Mã website
$secure_pass    =   "5877444d9cf1c58f";  //Mật khẩu đi kèm mã website
$api_username   =   "thietkewebbatdongsan";
$api_password   =   "thietkewebbatdongsansdhyw0";
$secure_secret  =   "thietkewebbatdongsany64w5yv";
$baokim_seller_account_email= "finance@one-waystreet.vn";// Email đăng nhập baokim.vn

		$request_info = new PaymentInfoRequest();
		$request_info->api_username    = $api_username;
		$request_info->api_password    = $api_password;
		$request_info->merchant_id     = $merchant_id;

		$request_info->bk_seller_email = $baokim_seller_account_email;
	    $request_info->order_id        ='ABCSDF';
	    $request_info->total_amount    = '70000';
	    $request_info->tax_fee         = 0;
	    $request_info->shipping_fee    = 0;
	    $request_info->order_description = 'Thanh toán Bảo kim';
	    $request_info->currency_code   = 'VND';

	    $request_info->bank_payment_method_id =63;
	    $request_info->payment_mode    = 1;
	    $request_info->payer_name      = 'Nguyen Trung Loi';
	    $request_info->payer_email     = 'loinguyentrung@gmail.com';
	    $request_info->payer_phone_no  = '8401226167354';
	    $request_info->shipping_address = '';
	    $request_info->payer_message   = '';
	    $request_info->escrow_timeout  = 0;
	    $request_info->extra_fields_value = '';
	    $request_info->url_return      = 'http://google.com';
		$baokim= new BKPaymentProService2('https://www.baokim.vn/services/payment_pro_2/init?wsdl');
		try{
        	$response = $baokim->DoPaymentPro($request_info);
			var_dump($response);
			
        	if($response->error_code == 0){
				die('Connect thành công !');
			}	
		} catch(SoapFault $e){
			die('Không thể kết nối !'); 
		}
		
		
		
		
		
		
		
		
		
		



	