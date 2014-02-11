<?php 
/**
 * Google  Map default controller
 * 
 * @package    Joomla.component
 * @subpackage Components
 * @link http://inetlanka.com
 * @license		GNU/GPL
 * @auth inetlanka web team - [ info@inetlanka.com / inetlankapvt@gmail.com ]
 */
defined('_JEXEC') or die('Restricted access');



$conArr = $this->options;

$user_lan = $conArr[0]->mapLongitude;
$user_lat = $conArr[0]->mapLatitude;
$apiKeyVal = $conArr[0]->apiKey;
$apiWidth = $conArr[0]->mapWidth;
$apiHeight = $conArr[0]->mapHeight;
$apiComName = $conArr[0]->greeting;

$googleVideo = $conArr[0]->companyVideoProfile;
$imgDis  = $conArr[0]->mapPointImg ;
if($imgDis == NULL)
{
	$imgDis = "";
}
else
{
	$imgDis = "<img src=".$conArr[0]->mapPointImg." width='50' height='50'/>";
}

if($conArr[0]->mapViewHeight == NULL)
{
	$mapViewHeight = "18";
}
else
{
	$mapViewHeight = $conArr[0]->mapViewHeight;
}

if($conArr[0]->mapView == NULL)
{
	$mapView = "SATELLITE";
}
else
{
	$mapView = $conArr[0]->mapView;
}

	function generateCode($characters) {
	
			$possible = '987654321AbcdEFghJkMnpqrsTvwxYz';
	
			$code = '';
	
			$i = 0;
	
			while ($i < $characters) { 
	
				$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
	
				$i++;
	
			}
			
			
			
			
			return $code;
	
		}
		
	


$spamStatus = $conArr[0]->companySpamcheck;
$randSpamCode = generateCode(4);

 ?>
<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_ActiveX.js" type="text/javascript"></script>
<script src="DWConfiguration/ActiveContent/IncludeFiles/AC_RunActiveContent.js" type="text/javascript"></script>

<div>

<script language="javascript" >

	function comGoogleFrmValidate(comfrm)
		{
			
			var errorStr='';	
			my_name = document.comGoogleForm.myName;
			my_email = document.comGoogleForm.myEmail;
			mess_heading = document.comGoogleForm.messHeading;	
			messate_txt = document.comGoogleForm.messateTxt;	
			
			
			
			if(my_name.value == '')
				{
					errorStr += "<?php echo JText::_( 'GOOGLE_JS_NAME' ); ?>\n";
					my_name.style.borderColor  = "#FF0000";

				}
				
			if(my_email.value == '')
				{
					errorStr += "<?php echo JText::_( 'GOOGLE_JS_MYEMAIL' ); ?>\n";
					my_email.style.borderColor  = "#FF0000";
				}
			if(my_email.value!='')
				{
					
					if(echeck(my_email.value) == false)
					{
						errorStr += "<?php echo JText::_( 'GOOGLE_JS_VALEMAIL' ); ?>\n";
						my_email.style.borderColor  = "#FF0000";
					}
					
				}
				
			if(mess_heading.value == '')
				{
					errorStr += "<?php echo JText::_( 'GOOGLE_JS_MAILHEAD' ); ?>\n";
					mess_heading.style.borderColor  = "#FF0000";
				}
			if(messate_txt.value == '')
				{
					errorStr += "<?php echo JText::_( 'GOOGLE_JS_MAILTEXT' ); ?>\n";
					messate_txt.style.borderColor  = "#FF0000";
				}
				
			<?php
			
			if($spamStatus == "1")
			{
			?>
			messSpam_txt = document.comGoogleForm.messSpamtxt;		
			if(messSpam_txt.value == '')
				{
					errorStr += "<?php echo JText::_( 'GOOGLE_JS_MAILSPAM' ); ?>\n";
					messSpam_txt.style.borderColor  = "#FF0000";
				}
			if(messSpam_txt.value != '')
				{
					var spamTxtsend = "<?php echo $randSpamCode; ?>";
					if(messSpam_txt.value != spamTxtsend)
					{
						errorStr += "<?php echo JText::_( 'GOOGLE_JS_SPAMVAL' ); ?>\n";
						messSpam_txt.style.borderColor  = "#FF0000";
					}
					
				}
			<?php
			}
			?>
				
		
			if(errorStr=='')
				{
					<?php // echo '<div id="thongbao"> Thông tin đã được gửi thành công </div>'?>
					return true;
				}
			else
				{
					alert(errorStr);
					return false;
				}			  
		}
	
	
	
	function echeck(str)
	   {
	   		
			var at="@"
			var dot="."
			var lat=str.indexOf(at)
			var lstr=str.length
			var ldot=str.indexOf(dot)
			
			if (str.indexOf(at)==-1){			  
			   return false
			}
	
			if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){		   
			   return false
			}
	
			if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){		   
				return false
			}
	
			 if (str.indexOf(at,(lat+1))!=-1){				
				return false
			 }
	
			 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){				
				return false
			 }
	
			 if (str.indexOf(dot,(lat+2))==-1){			  
				return false
			 }
		
	
			 return true
	   }

</script>
	
<style>

#google_map
{
	width:<?php echo $apiWidth; ?>px;
	height:<?php echo $apiHeight; ?>px;
	border:1px solid #000;
	overflow:hidden;
	clear:both;
	border:1px #000000 solid;
}
</style>
<div class='googlemap'>
	<div class='google-left'>
		<div class="componentheading">
			Thông tin liên hệ
		</div>
		 <div class='google-content'>
		 <?php echo nl2br($conArr[0]->mapAddress); ?>
		 </div>
	</div>
	<div class='google-right'>
	<div class="componentheading">

			Gửi tin nhắn đến chúng tôi 
	</div>
	<form action="index.php" method="post" name="comGoogleForm" id="comGoogleForm" onsubmit="return comGoogleFrmValidate(this)">
			<table class='contentpane googleform'>
				<tr>
					<td align="right">
						<label id="contact_emailmsg" for="contact_email">
				&nbsp;<?php echo JText::_( 'GOOGLE_CON_YOUR_NAME' );?>:
			</label>
					</td>
					<td>
					<input type="text" name="myName" id="myName" size="30" />
					</td>
				<tr>
					<td align="right">
						<label id="contact_phonemsg"  for="my_phone">
				&nbsp;<?php echo JText::_( 'GOOGLE_CON_YOUR_PHONE' );?>:
			</label>
					</td>
					<td>
						<input type="text" name="myPhone" id="myPhone" size="30" />
					</td>
					
				</tr>
				<tr>
					<td align="right">
						<label id="contact_emailmsg" for="contact_email">
				&nbsp;<?php echo JText::_( 'GOOGLE_CON_EMAIL' );?>:
						</label>
					</td>
					<td>
						 <input type="text" name="myEmail" id="myEmail" size="30" />
						<input type="hidden" name="ourEmail" id="ourEmail" value="<?php echo $conArr[0]->mapEmail; ?>"  />
				  <input type="hidden" name="RedirectLinkComGoogle" id="RedirectLinkComGoogle" value="<?php echo $_SERVER['REQUEST_URI']; ?>"  />
					</td>
				</tr>
				<tr>
					<td align="right">
					<label for="contact_subject">
				&nbsp;<?php echo JText::_( 'GOOGLE_CON_SUBJECT' );?>:
					</label>
					</td>
					<td>
						<input type="text" name="messHeading" id="messHeading" size="30" />
					</td>
				</tr>
				<tr>
					<td align="right">
						<label id="contact_textmsg" for="contact_text">
				&nbsp;<?php echo JText::_( 'ENTER YOUR MESSAGE' );?>:
			</label>
					</td>
					<td>
						<textarea name="messateTxt" id="messateTxt" rows="5" cols="35"></textarea><br />
			<?php
			
			if($spamStatus == "1")
			{
			?>	
			
				
				<?php echo "<br /><img src='components/com_google/asset/captcha/captcha.php?spamCode=$randSpamCode' alt='' title='' />"; ?><br /><br />
				<input type="text" name="messSpamtxt" id="messSpamtxt"  />
			<label for="contact_subject">
				&nbsp;<?php echo JText::_( 'GOOGLE_CON_SPAMIMG' );?>
			</label>	
				
			
			<?php
			}
			?>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td> <input type="checkbox" value="copyMail" name="copyOfmail" id="copyOfmail"  /><label for="contact_email_copy">
					<?php echo JText::_( 'EMAIL_A_COPY' ); ?>
				</label>
					</td>
				</tr>
</table>

                
			
				
				<div style="text-align: center;">
				<input type="submit" align="left" name="task_button" class="btn-search" value="<?php echo JText::_('SEND'); ?>" />
				</div>
				<input type="hidden" name="option" value="com_google" />
				<input type="hidden" name="task" value="sendMail" />
				<input type="hidden" name="id" value="<?php echo $conArr[0]->id;?>" />
				<input type="hidden" name="Itemid" value="<?php echo $_GET['Itemid'];?>" />
				<?php echo JHTML::_( 'form.token' ); ?>
</form>
	</div>
	</div>
	<div class='clear'>
	</div>
</div>
<script language="javascript" >
		function initMap()
		{
				var myLatlng = new google.maps.LatLng(<?php echo $user_lan; ?>,<?php echo $user_lat; ?>);
			    var myOptions = {
					zoom: 16,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					overviewMapControl: true
				}			
			    var map = new google.maps.Map(document.getElementById("google_map"), myOptions);
			    var image = new google.maps.MarkerImage("components/com_google/asset/img/mappin.png",
			    	new google.maps.Size(20, 32)); 
			    var marker = new google.maps.Marker({
			    	position: myLatlng, 
			    	map: map,
			    	title:"<?php echo $apiComName; ?>",
			    	icon: image
			    });		
			    	
			    var address = "<span style='font-family:Arial;font-size:11px;'><b><?php echo $apiComName; ?></b><br/><?php echo $imgDis; ?><span> ";
			    var infowindow = new google.maps.InfoWindow({content:address,position:myLatlng});	
				//Add click event for the marker
				google.maps.event.addListener(marker, 'click', function() {						
					infowindow.open(map,marker);
				}); 					
				map.addOverlay(marker);
		}
		initMap();
	</script>
 

