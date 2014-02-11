<?php
	require_once('include.php');
	$accountInfoRequest = new AccountInfoRequest();
	$accountInfoRequest->merchant_id  = $merchant_id;
	$accountInfoRequest->api_username = $api_username;
	$accountInfoRequest->api_password = $api_password;
	try{
		$accountInfoResponse = $bk->GetAccountInfo($accountInfoRequest);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		var_dump($e);
	}
   //var_dump($accountInfoResponse); 
	//die();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="silverhand" />

	<title>Demo V2</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery_bank.js"></script>
<script type="text/javascript" language="javascript">
function set_id_bank(id){
    document.getElementById("bank_payment_method_id").value = id;
    $('.bank .divChecked').css("display","none");
    $('#divChecked_' + id).css("display","block"); 
    document.forms["demo_v2"].submit();
}

function chane_info_payment(rad){
    var id = rad.value;
    if(id==1){
        document.getElementById('info_1').style.display = 'block';
        document.getElementById('info_2').style.display = 'none';
    }else{
        document.getElementById('info_1').style.display = 'none';
        document.getElementById('info_2').style.display = 'block';
    } 
}
function popup(url,namepopup) 
{
 var width  = 800;
 var height = 800;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=0';
 params += ', menubar=0';
 params += ', scrollbars=auto';
 params += ', status=0';
 params += ', toolbar=no';
 params += ', modal=yes';
 params += ', alwaysRaised=yes';
 var newwin = window.open(url,"_blank", params);
 if (window.focus) {newwin.location()}
 return false;
}

function extra_payment(method){
    document.getElementById('extra_payment').value = method;
    $('#'+method).css("display","block");     
    hidden_bank(method);   
}

function hidden_bank(id){
    var myBank=new Array(1,2,3,4,5,'baokim','thecao');
    for(i in myBank){
        if(myBank[i] == id) continue;
        $('.content_bank[lang='+myBank[i]+']').css("display","none");        
    }
}
</script> 

<body bgcolor="#ffffff">
<div align="center" style="margin-left:20px">
<form action="<?php echo getURL(1,1,0,0)?>request_bk.php" method="post" name="demo_v2" onsubmit="return popup('<?php echo getURL(1,1,0,0)?>request_bk.php','namepopup');">
<input type="hidden" name="active_submit" value="submit" /> 
<input type="hidden" name="bank_payment_method_id" id="bank_payment_method_id" value="" />
<input type="hidden" name="payer_name" size="30" value="HUY" />
<input type="hidden" name="payer_email" size="30" value="huynq@baokim.vn" />
<input type="hidden" name="payer_phone_no" size="30" value="0982561129"/>
<input type="hidden" name="shipping_address" size="30" value="Hà Nội"/>
<input type="hidden" name="payer_message" size="30" value="Ok" />
<input type="hidden" name="extra_fields_value" size="30" value="" />
<input type="hidden" name="extra_payment" id="extra_payment" value="" />
<input type="hidden" name="total_amount" value="20000" />
<table border="0">

        <?php
        if($accountInfoResponse->error_code != 0){
            ?>
            <tr>
                <td colspan="2">
            <?php
    		echo "Error_code: ".$accountInfoResponse->error_code;
    		echo "Error_message: ".$accountInfoResponse->error_message;
            ?>
            
                </td>
            </tr>
            <?php
    	}

        ?>
    <tr>
  
    	<td>
    		<table width="600px" style="padding-left:25px">
            		
                   
                    <tr>
                        <td colspan="2" >
                            <span class="title-step"> HÌNH THỨC THANH TOÁN</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            //while (list($key, $value) = each($payment_define)) {
                            foreach($payment_define as $key=>$value){
                            ?>
                                <div class="title_type" lang="<?php echo $key?>" onclick="hidden_bank(<?php echo $key?>)">
                                    <?php echo $payment_define[$key]?>
                                </div>
                                <div class="content_bank" lang="<?php echo $key?>" style="display: <?php if($payment_show[$key]=='0') echo 'none'; ?>;">
                                    <div class="content">
                                        <?php
                                        $count=0;
                                        foreach($accountInfoResponse->account_info->payment_methods as $payment_method){
                        	    			if($payment_method->payment_method_type == $key){
                        	    			$count++;
                                            $time_suscess   = isset($payment_method->complete_time) ? $payment_method->complete_time : "Ngay lập tức";
                                            if(intval($payment_method->fix_fee) == 0){
                                                $fix_fee = "Miễn phí";
                                                $percent_fee = "";
                                            }else{
                                                $fix_fee = number_format($payment_method->fix_fee,0,"",".") . " vnđ";
                                                $percent_fee = "+" . number_format($payment_method->percent_fee,"1",",",".") . "%";
                                            }
                        	    		?>
                       					<div class="bank" onclick="hidden_bank(<?php echo $key?>)">
                                            <div style="display: table-cell; vertical-align: middle;">
                                                <center>
                                                    <img onclick="set_id_bank(<?php echo $payment_method->id?>)" name="<?php echo$time_suscess?>" lang="<?php echo$percent_fee?>" alt="<?php echo $fix_fee?>"  width="50px" id="<?php echo$payment_method->id?>" src="<?php echo$payment_method->logo_url?>" title="<?php echo $payment_method->name?>" />
                                                </center>
                                            </div>
                                            <div id="divChecked_<?php echo $payment_method->id?>" class="divChecked"><img class="imgChecked" border="0" src="images/checked.png" /></div>
                                        </div>
                                        
                        				<?php }}
                                        ?>
                                    </div>
                                    
                                </div>
                            <?php
                            }
                            
                            ?>
                            	
                                
                        </td>
                    </tr>
                 
                       
            </table>
            <div id="step-payment-bk-2">
            </div>
    	</td>
    </tr>
    
</table>
</form>
</div>
</body>
</html>