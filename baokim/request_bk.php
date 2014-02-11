<?php
	require_once('include.php');
	
	/*
	 * Check đã thanh toán Thành Công chưa
	 * */
    if(isset($_GET['checksum']) && isset($_GET['error_code']) && isset($_GET['error_message']) && isset($_GET['url_guide'])){
        $checksum = $_GET['checksum'];
        
        $error_code = $_GET['error_code'];
        $error_message = $_GET['error_message'];
        $url_guide = $_GET['url_guide'];
        
        if ($checksum !== md5($error_code."_".$error_message."_".$url_guide."_".$secure_secret)){
        	die('Mã checksum khong chinh xac - Đã có tác động bên ngoài');
            die();
        } else {
        	redirect($url_guide);
        }
    }
	
	
	$order_id = 	time();
	$action 			= getValue('accountBaoKim','str','POST','');
	$pagePayment		= getValue('pagePayment','str','POST','');
    $payment_mode       =   getValue("payment_mode","str","POST","2");
    $bank_payment_method_id = getValue("bank_payment_method_id","int","POST",0);
    $currency_code      =   getValue("currency_code","str","POST","VND");
    $payer_name         =   getValue("payer_name","str","POST",""); 
    $payer_email        =   getValue("payer_email","str","POST","");
    $payer_phone_no     =   getValue("payer_phone_no","str","POST","");
    $shipping_address   =   getValue("shipping_address","str","POST","");
    $payer_message      =   getValue("payer_message","str","POST","");
    $escrow_timeout     =   getValue("escrow_timeout","str","POST","3");
    $extra_fields_value =   getValue("extra_fields_value","str","POST","");
    $url_return         =   "http://google.com.vn/";
    $extra_payment      =   getValue("extra_payment","str","POST","");
	$baokim_buyer_account_email = getValue("baokim_buyer_account_email","str",'POST','');
	$pin_the_cao		=   getValue("pin_the_cao","str","POST","");
	$seri_the_cao		=   getValue("seri_the_cao","str","POST","");
	$total_amount 		= 	getValue('total_amount','str','POST','');
	$email_for_payment_card = getValue('email_for_payment_card','str','POST','');
    /*
     * Check khi thanh toan bang API tk BaoKim
     * */
   
	/**
	 * Thanh toán thẻ cào
	 */

	/*
	 * Thanh toan Ngân hàng
	 * */
    if(isset($_POST["active_submit"]) && !empty($_POST["active_submit"])){
        
    	$request_info = new PaymentInfoRequest();
    	
    	//local
    	$request_info->api_username    = $api_username;
    	$request_info->api_password    = $api_password;
    	$request_info->merchant_id     = $merchant_id;
    	
    	$request_info->bk_seller_email = $baokim_seller_account_email;
    	$request_info->order_id        = $order_id;
    	$request_info->total_amount    = $total_amount;
    	$request_info->tax_fee         = $tax_fee;
    	$request_info->shipping_fee    = $shipping_fee;
    	$request_info->order_description = $order_description;
    	$request_info->currency_code   = $currency_code;
    	
    	$request_info->bank_payment_method_id = $bank_payment_method_id;
    	$request_info->payment_mode    = 1;
    	$request_info->payer_name      = $payer_name; 
    	$request_info->payer_email     = $payer_email;
    	$request_info->payer_phone_no  = $payer_phone_no;
    	$request_info->shipping_address = $shipping_address;
    	$request_info->payer_message   = $payer_message;
    	$request_info->escrow_timeout  = $escrow_timeout;
    	$request_info->extra_fields_value = $extra_fields_value;
    	
    	$request_info->url_return      = $url_return;//Khi thanh toán thành công sẽ trở về url này
    	$response_info = $bk->DoPaymentPro($request_info);

    	if($response_info->error_code == 0){
            $url    =   $response_info->url_redirect;
            redirect($url);
    	}
        else{
            var_dump($response_info);
        }
        die();
    }


?>