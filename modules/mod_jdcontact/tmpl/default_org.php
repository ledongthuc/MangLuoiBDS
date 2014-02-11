<?php

/*------------------------------------------------------------------------
# J DContact
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2012 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://www.j-download.com
# Technical Support:    http://www.j-download.com/request-for-quotation.html
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
require_once(JPATH_ROOT.DS.'libraries'.DS.'com_u_re'.DS.'php'.DS.'config.php');
require("class.phpmailer.php");
global $u_reGlobalConfig;
$mailphp = new PHPMailer();
$mailphp1 = new PHPMailer();
$url  = JURI::base();
$u_reGlobalConfig		 = 		  U_ReConfig::getParams();

if($_POST)
{
    $javascript_enabled         =       trim($_REQUEST['browser_check']);
    $ten                      =       trim($_REQUEST['ten']);
    $email                      =       trim($_REQUEST['email']);
    $phno                       =       trim($_REQUEST['phno']);
    $subject                    =       "Liên hệ ".$attribs['subject'];
    $noidung                        =       trim($_REQUEST['noidung']);
	$to     =   $attribs['nguoinhan'];
	$nguoidang	= $attribs['tennguoinhan'];
	if ( $ten == "Tên:" )
	{
		$result = "".JText::_('Nhập tên')."";
	}
	elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email))
	{
		$result = "".JText::_('Email không đúng')."";
	}
	
	else if($phno=="Điện thoại:")
	{
		$result = "".JText::_('Nhập số điện thoại')."";
	}
	else if(!is_numeric($phno))
	{
	$result = "".JText::_('Điện thoại chỉ nhập số').""; 
	}
	else if($phno=="Nội dung:")
		{
			$result = "".JText::_('Nhập nội dung')."";
		}
	elseif ( strlen($noidung) < 20 )
	{
		$result = "".JText::_('Nội dung phải trên 20 ký tự')."";
	}
	else
	{
		
		// ngửi cho người đăng bds
		
		$from = "info@mangluoibds.vn";
		$fromname = $ten;
		$recipient = $to;
		$subject = "Liên hệ ".$attribs['subject'];
		$body = $message;
		//lấy templates mail
		include_once 'libraries/com_u_re/php/config.php';
		$art_id = U_ReConfig::getValueByKey('TEMPLATEEMAIL','lien_he_chi_tiet_nhan');
		$sqlcontent = "SELECT introtext from jos_content where id = '$art_id'"; 
		$db=& JFactory::getDBO();
		$db->setQuery($sqlcontent);
		$rowcontent=$db->loadRow();
		$mess = $rowcontent[0];	
		$mess = str_replace('%nguoinhan%', $nguoidang, $mess);
		$mess = str_replace('%nguoigui%', $ten, $mess);
		$mess = str_replace('%emailnguoigui%', $email, $mess);
		$mess = str_replace("images/", JURI::base()."images/", $mess);
		$mess = str_replace('%link%', $_SERVER['HTTP_REFERER'], $mess);
		$mess = str_replace('%batdongsan%', $attribs['subject'], $mess);
		$mess = str_replace('%noidung%', $noidung , $mess);
	
		$mailphp->From = $from;
		$mailphp->FromName = "Mạng lưới bất động sản";
		$mailphp->AddAddress($recipient);
		$mailphp->Subject=$subject;
		//$mailphp->Body = $mess;
		$mailphp->MsgHTML($mess);
		$mailphp->CharSet='UTF-8';
		$se = $mailphp->Send();
		if($se)
		{
			    $sucs=1;
		}
		
		// gửi cho người liên hệ
		
		$from =  $sales_address;
		$recipient1 = $email;
		$subject = "Liên hệ ".$attribs['subject'];
		$body = $message;
		
		//lấy templates mail
		$art_id = U_ReConfig::getValueByKey('TEMPLATEEMAIL','lien_he_chi_tiet_gui');
		$sqlcontent = "SELECT introtext from jos_content where id = '$art_id'"; 
		$db=& JFactory::getDBO();
		$db->setQuery($sqlcontent);
		$rowcontent=$db->loadRow();
		$mess = $rowcontent[0];	
		
		
		$mess = str_replace('%nguoigui%', $ten, $mess);
		$mess = str_replace('%batdongsan%', $attribs['subject'], $mess);
		$mess = str_replace("images/", JURI::base()."images/", $mess);
		$mess = str_replace('%link%', $_SERVER['HTTP_REFERER'], $mess);
		
		$mailphp1->From = "info@mangluoibds.vn";
		$mailphp1->FromName = "Mạng lưới bất động sản";
		$mailphp1->AddAddress($recipient1);
		$mailphp1->Subject=$subject;
		//$mailphp1->Body = $mess;
		$mailphp1->MsgHTML($mess);
		$mailphp1->CharSet='UTF-8';
		$se1=$mailphp1->Send();
		
        if($sucs==1){
		    $result = "".JText::_('Đã gửi')."";
		    echo "<script>
		    	document.getElementById('contact-form-mail').style.display = 'none';
		    	document.getElementById('ten').value = 'Tên:';
			   document.getElementById('email').value = 'Email:';
			   document.getElementById('phno').value = 'Điện thoại:';
			   document.getElementById('noidung').value = 'Nội dung:';
		    	alert('Cảm ơn bạn đã gửi email liên hệ cho bất động sản này, chúng tôi đã chuyển tin đến cho người đăng tin!');
		    	</script>";
        }
        else{	
            $result = "".JText::_('Gửi không thành công')."";
        }
	}

	if($javascript_enabled == "true") {
		echo $result;
		die();
	}
}
?>
<style>
	h2{
	position: relative;
	font: 20px 'Oswald',sans-serif;
	color: #292929;
	text-transform: uppercase;
	padding-bottom: 16px;
	}
	#contactform label {
		position:relative;
		display:inline-block;
	}
</style>
    <script src="modules/mod_jdcontact/tmpl/lib/jquery-1.4.4.js"></script>

        <form name="contactform" id="contactform" method="post" action="">
        <div id="result"></div>
            <table border="0" cellpadding="5" cellspacing="0" class='contentpane'>
	            <tr valign="top">
					<td>
						<div class="block" >
								<label class="ten">
									<input class="text" name="ten" id="ten" type="text" onclick="if(this.value=='Tên:') this.value=''" onBlur="if(this.value=='') this.value='Tên:'" value="<?php if(isset($ten)) echo $ten; else echo "Tên:"?>" /><br />
								</label>
						</div>
					</td>
	        	</tr>
	            <tr valign="top">
					<td>
							<label>
								<input class="text" name="email" id="email" type="text" onclick="if(this.value=='Email:') this.value=''" onBlur="if(this.value=='') this.value='Email:'" value="<?php if(isset($email)) echo $email; else echo "Email:"?>" /><br />
								</label>
					</td>
	        	</tr>
	            <tr valign="top">
					<td>
							<label>
								<input class="text" name="phno" id="phno" type="text" onclick="if(this.value=='Điện thoại:') this.value=''" onBlur="if(this.value=='') this.value='Điện thoại:'" value="<?php if(isset($phno)) echo $phno; else echo "Điện thoại:"?>" /><br />
							</label>
					</td>
	        	</tr>
	            <tr valign="top">
					<td>
						<label>
								<textarea class="text" id="noidung" name="noidung" onclick="if(this.value=='Nội dung:') this.value=''" onBlur="if(this.value=='') this.value='Nội dung:'" id="msg"><?php if(isset($msg)) echo $msg; else echo "Nội dung:"?></textarea><br />
						</label>  
	            
					</td>
				</tr>
				</table>
	        <div class="pad">
            <input type="hidden" name="browser_check" value="false" />
            <input type="submit" name="submit" class ='btn-search' value="<?php echo JText::_('Gửi'); ?>" id="submit" style="cursor: pointer;z-index:1;" />          
			</div>
            
        </form>
        <script type="text/javascript">
        jQuery.noConflict();
        jQuery('input[name="browser_check"]').val('true');
        jQuery("#submit").click(function(){
        	jQuery('#result').html('<img src="modules/mod_jdcontact/tmpl/images/loader.gif" class="loading-img" alt="loader image">').fadeIn();
		var browser_check=jQuery('input[name="browser_check"]').val();
		var ten=jQuery('input[name="ten"]').val();
		var email=jQuery('input[name="email"]').val();
		var phno=jQuery('input[name="phno"]').val();
		var noidung=jQuery('textarea[name="noidung"]').val();
		var input_data = 'browser_check='+browser_check+'&ten='+ten+'&email='+email+'&phno='+phno+'&noidung='+noidung;
		jQuery.ajax({
				   type: "POST",
				   url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
				   data: input_data,
				   success: function(msg){
					   if(msg == 'Đã gửi'){
						   jQuery("#ten").val("Tên:");
						   jQuery("#email").val("Email:");
						   jQuery("#phno").val("Điện thoại:");
						   jQuery("#noidung").val("Nội dung:");
					   }else{
						   jQuery('.loading-img').remove();
						   jQuery('<div class="message">').html(msg).appendTo('div#result').hide().fadeIn('slow');
					   }
					   //jQuery("#contact-form-mail").css('display','none');
					   //
                       //if(msg == '<?php echo "".JText::_('Đã gửi').""?>'){
                        	//alert(msg);
                            //document.contactform.ten.value='Tên:';
                            //document.contactform.email.value='Email:';
                            //document.contactform.phno.value='Điện thoại:';
                            //document.contactform.noidung.value='Nội dung:';
                        //    alert('Đã gửi thành công! Cảm ơn bạn');
                    	//}
                       
				   }
				});
			return false;
	    });
	    </script>
	  
