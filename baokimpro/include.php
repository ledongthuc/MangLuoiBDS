<?php
require_once('BKPaymentProService2.php');
require_once('payment_lang.php');
require_once('client_function.php');
require_once('BaokimAdaptiveAccountsAPI.php');
 
$merchant_id    =   "6765";// Mã website
$secure_pass    =   "5877444d9cf1c58f";//Mật khẩu đi kèm mã website
$api_username   =   "thietkewebbatdongsan";
$api_password   =   "thietkewebbatdongsansdhyw0";
$secure_secret  =   "thietkewebbatdongsany64w5yv";
$baokim_seller_account_email= "finance@one-waystreet.vn";// Email đăng nhập baokim.vn

$payment_define = array(
                        1 =>"Các loại thẻ ATM trong nước",
                        2 =>"Các loại thẻ Tín dụng quốc tế",
                        3 =>"Chuyển khoản bằng Internet Banking",
                        4 =>"Chuyển khoản bằng máy ATM",
                        5 =>"Chuyển khoản tiền mặt tại quầy giao dịch",
						6=>"Thanh toán bằng Bảo Kim"
                    );
$payment_show = array(
                        1 =>"1",
                        2 =>"1",
                        3 =>"1",
                        4 =>"1",
                        5 =>"1",
						6=>"1"
                    );                    
                    
$arr_code       =   array(
                        1   =>"VND",
                        2   =>"USD"
                    );
$tax_fee            =   "0";
$shipping_fee       =   "0";
$order_description  =   "Note order";

$location = 'https://www.baokim.vn';

$bk                  = new BKPaymentProService2($location."/services/payment_pro_2/init?wsdl");

$domain_pay_bk       = $location;

?>