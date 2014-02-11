<?php
class NL_Checkout{
	private $nganluong_url = 'https://www.nganluong.vn/checkout.php';
	private $merchant_site_code;
	private $secure_pass;
	public function __construct($code,$pass){
		$this->merchant_site_code =$code;
		$this->secure_pass=$pass;   
	}
	public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price, $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = '', $buyer_info = '', $affiliate_code = ''){	
		$arr_param = array(
			'merchant_site_code'=>	strval($this->merchant_site_code),
			'return_url'		=>	strval(strtolower($return_url)),
			'receiver'			=>	strval($receiver),
			'transaction_info'	=>	strval($transaction_info),
			'order_code'		=>	strval($order_code),
			'price'				=>	strval($price),
			'currency'			=>	strval($currency),
			'quantity'			=>	strval($quantity),
			'tax'				=>	strval($tax),
			'discount'			=>	strval($discount),
			'fee_cal'			=>	strval($fee_cal),
			'fee_shipping'		=>	strval($fee_shipping),
			'order_description'	=>	strval($order_description),
			'buyer_info'		=>	strval($buyer_info),
			'affiliate_code'	=>	strval($affiliate_code)
		);
		$secure_code = implode(' ', $arr_param) . ' ' . $this->secure_pass;
		$arr_param['secure_code'] = md5($secure_code);
		$redirect_url = $this->nganluong_url;
		if (strpos($redirect_url, '?') === false) {
			$redirect_url .= '?';
		} else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false) {
			$redirect_url .= '&';			
		}
		$url = '';
		foreach ($arr_param as $key=>$value) {
			$value = urlencode($value);
			($url == '')?$url .= $key . '=' . $value:$url .= '&' . $key . '=' . $value;
		}		
		return $redirect_url.$url;
	}	
} 