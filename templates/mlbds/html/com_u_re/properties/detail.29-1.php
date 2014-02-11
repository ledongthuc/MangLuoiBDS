<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php if ( empty ($_GET['debug'] ) ) { ?>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/jstab.js"></script>
<?php }?>
 
<script>
// FORMAT CURRENCY
function fmoney(num){ 
	if ( num == null || isNaN(num) )
	{
		return "0";
	}
		
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
			cents = "0" + cents;
			for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+','+
			num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') +num);
}
function limit(evt,vl,num) {    
        var charCode = (evt.which)?evt.which:event.keyCode; 
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false; 		
}	 
function validateTimeFormat24(hour, minute){
		var value = hour + ":" + minute; 
		var valid = /^([01]?[0-9]|2[0-3]):([0-9]|[0-5][0-9])$/.test(value);
		return valid;
}		
function copythis(a,b,max,div) { 
	if (b>max) document.getElementById(div).value=Math.ceil(b/10)-1; 
	else document.getElementById(a).value=b;
} 
</script>
<!-- Hien thi ngon ngu de chon khi nhap du lieu -->

<!-- End  Hien thi ngon ngu de chon khi nhap du lieu -->
<?php
defined('_JEXEC') or die('Restricted access');
$editor =& JFactory::getEditor();
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
$userchinhchu	= $user->get('chinh_chu');
$userenglish	= $user->get('speak_english');
$document =& JFactory::getDocument();

JHTML::stylesheet('jea.css', 'media/com_jea/css/');
//$document->addScript('includes/js/joomla.javascript.js');

if($_GET['Itemid']==186){
	$title = strip_tags($document->getTitle());
	$document->setTitle($title);
}else{
	if($user->get('id')!=0){
		$document->setTitle('Đăng tin');
	}else{
		$document->setTitle('Đăng tin không cần tài khoản');
	}
}

if( $this->status == 0 )
{
	if ( !is_array($this->propertyData) || empty($this->propertyData) )
	{
	    echo JText::_('THIS_PROPERTY_DO_NOT_EXISTS_ANYMORE');
	    return;
	}
}
?>

<?php
if ( $this->status == 2)
{
	echo "<div style='width: 800px'>";
?>
	<form action="index.php?option=com_jea&controller=properties&cat=needrenting&task=save" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" />
<?php
}
else if ( $this->status == 1)
{
?>
	<form action="<?php echo JRoute::_('&task=save') ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data"  onsubmit=""/>
<?php
}
?>
<?php		
		
		// kiem tra phe duyet cua admin
		/*
			 $user->approved == "0" : dang tin khong can phe duyet, hien thi luon
		*/
		$op=0;
		if( $usertype == "Administrator" || $usertype == "Super Administrator" )
		{
			$op=1;
		}
		
		//kiem tra login cua user
		/*
		neu user login se ton tai gid
		*/
		if (  !$user->usertype )
		{
			$usergid = '0';
		}
		else
		{
			$usergid =$user->gid;
		}
		
		// thong bao chua login 
		/*
		if ( $usergid == '0' && $this->status == 1)
		{
			echo  "<center><h3>".JText::_('USER_PHAI_DANG_NHAP')."</center</h3>";
		}
		*/
		
		
 if ( $this->status == 2 ) 
		{
			?>
			
			<div style="width:800px" >
				<center>
						<input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3', '<?php echo $this->lang ?>')" name="save_review" class="btn-search" value="<?php echo JText::_('LUU') ?>" />
					<span id ='ajCancael'>
						 <input type="button" onclick="submitbutton('cancel')" name="save_cancel" class="btn-search" value="<?php echo JText::_('CANCEL') ?>" />
					</span>
				</center>
				<div id="error_message_id" class="error"></div>
		    </div>
			<?php 
		//echo "	<hr class='margin_hr_dangtin'>";
		}
		
?>
	
<!-- Cáº¥u hÃ¬nh SEO + hiá»ƒn thá»‹ ra ngoÃ i -->	
<?php
 if ( $this->status != 0)
{
?>
		
		
	<!-- end Cáº¥u hÃ¬nh SEO + hiá»ƒn thá»‹ ra ngoÃ i -->
		<?php
		/* hien thi Published o dang tin admin */
		if ( $this->status == 2)
		{
		?>
			<div class='dangtinadminbds'>
			<span id='PUBLISHED'><?php echo JText::_('HIEN_THI_RA_NGOAI') ?> </span>
			</div>
			<div class='dangtinadminbds_ck'>
				<?php echo $this->published;?>
			</div>
			<div class='dangtinadminbds'  style="display:none">
			<span id='EMPHASIS'><?php echo JText::_('DANG_TIN_NOI_BAT') ; ?> </span>
			</div>
			<div class='dangtinadminbds_ck' style="display:none">
			<input type='checkbox' value='1' id='emphasis' name='noi_bat' <?php echo $this->emphasisChecked ?> />
			</div>	
			<div class='dangtinadminbds'  style="display:none">
			<span id='NEWSEST'><?php	echo JText::_('DANG_TIN_MOI_NHAT') ; //tin moi nhat		?></span>
			</div>	
			<div class='dangtinadminbds_ck'  style="display:none">
			<input type='checkbox' value='1' id='newsest' name='moi_nhat' <?php echo  $this->newsestChecked ?> />
			</div>	
		<?php 
		}
		?>	
	<?php 
			//echo "<hr class='margin_hr_dangtin'>";
}
else 
{
?>
	<input type="hidden" id='SEO_CONFIG' name="SEO_CONFIG" value="" />
	<input type="hidden" id='SEO_PAGE_TITLE' name="tieu_de_trang" value="" />
	<input type="hidden" id='SEO_PAGE_KEYWORDS' name="tu_khoa_trang" value="" />
	<input type="hidden" id='SEO_PAGE_DESCRIPTION' name="mo_ta_trang" value="" />
<?php 
}
if(isset($_GET['task2'])&&$_GET['task2']=='register'){
$document->setTitle('Đăng ký & Đăng tin');
?>
<!-- dang ki roi dang tin-->
<div class="componentheading">
Đăng ký & Đăng tin
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">

<tr>
	<td height="30" align='right'>
		<label id="emailmsg" for="email">
			<?php echo JText::_( 'Email' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="text" id="email" name="email" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['email'];?>"  maxlength="100" onchange="setValue(this.value,'email_vl')"  onBlur="KiemTraEmail(this.value,'msgErrEmail','<?php echo JURI::base() ?>')"/><div id="msgErrEmail" class="errouser"><input type="hidden" name="emailFail" id="emailFail" value="0"  /></div>
	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="pwmsg" for="password">
			<?php echo JText::_( 'Password' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
  	<td>
  		<input  type="password" id="password" name="password" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['password'];?>" /><div id="msgPassword" class="errouser"></div>
  	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="pw2msg" for="password2">
			<?php echo JText::_( 'Verify Password' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="password" id="password2" name="password2" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['password2'];?>" onBlur ="KiemTra2MatKhau( document.getElementById('password').value,this.value,'msgErrPass');" /><div id="msgErrPass" class="errouser"></div>
	</td>
</tr>
<tr>
	<td width="30%" height="30" align='right'>
		<label id="namemsg" for="name">
			<?php echo JText::_( 'Name' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
  	<td>
  		<input type="text" name="name" id="name" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['name'];?>" onclick='document.getElementById("msgErrName").innerHTML=""'   maxlength="50" onchange="setValue(this.value,'name_vl')"/><div id="msgErrName" class="errouser"></div>
  	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="addressmsg" for="address">
			<?php echo JText::_('Address'); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="address" name="address" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['address'];?>" maxlength="255" />
	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="phonemsg" for="phone">
			<?php echo JText::_('Phone'); ?>: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="text" id="phone" name="phone" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phone'];?>" maxlength="100" onchange="setValue(this.value,'phone_vl')" /><div id="msgErrPhone" class="errouser"></div>
	</td>
</tr>
<tr>
	<td height="30" align='right'>
	
	</td>
	<td style="padding-left: 30px;">
		<span class="clear check" style='margin-bottom:5px;'>
						<input type="checkbox" name="speak_english1" id="speak_english1" onchange="setCheckbox(speak_english1,'speak_english')" <?php if (isset($_SESSION['tmp']) && $_SESSION['tmp']['speak_english1'] == 'on' ) echo 'checked="checked"';else echo '';?> > 
							Can you speak English?
		</span>
		<span class="clear check" style="margin-bottom:5px;">
					<input type="checkbox" name="chinh_chu1" id="chinh_chu1" onchange="setCheckbox(chinh_chu1,'chinh_chu')" <?php if (isset($_SESSION['tmp']) && $_SESSION['tmp']['chinh_chu1'] == 'on' ) echo 'checked="checked"';else echo '';?>> 
					Bạn là môi giới?
		</span>
		<span class="clear check">
					<input type="checkbox" name="nhan_mail" id="nhan_mail" <?php if (isset($_SESSION['tmp']) && $_SESSION['tmp']['nhan_mail'] == 'on' ) echo 'checked="checked"';else echo '';?>>
					Đăng ký nhận báo cáo hàng tháng
		</span>
	</td>
</tr>
<tr>
<td height="30" align='right' valign='top'>
	 Mã an toàn 
</td>
<td>

<?php

global $mainframe;
//set the argument below to true if you need to show vertically( 3 cells one below the other)
$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
?>
<?php if(isset($_SESSION['tmp']))
{?>
	<script type="text/javascript">
	<?php if($_SESSION['tmp']['captcha']!=''){?>
		alert('<?php echo $_SESSION['tmp']['captcha'];unset($_SESSION['tmp']['captcha'])?>');
	<?php }?>
		adminForm.osolCatchaTxt.style.borderColor="#FF0000";
		adminForm.osolCatchaTxt.focus();
		document.getElementById("osolCatchaTxt0").setAttribute("onclick","document.getElementById('msgErrCapt').innerHTML=''");
	</script>
<?php }
?>
</td>
</tr>

<td height="30" align='right'>
</td>
	<td style="padding-left: 27px;">
		Những phần đánh dấu(<span class="red">*</span>) là bắt buộc!		
		
		
	</td>
</tr>
</table>

<!-- dang ki roi dang tin-->
<?php }

if(isset($_GET['task2'])&&$_GET['task2']=='login'){
$document->setTitle('Đăng nhập & Đăng tin');
?>
	<!-- dang nhap roi dang tin-->	
	<div class='dangnhapdangtin'>
				<div class="componentheading">Đăng nhập & Đăng tin</div>
		
		<div class='clear register-mes-ct'>
			<table>
				<tr>
						<td height="30" align="right">
							<label id="usernamemsg" for="username">
							Email đăng nhập:
							</label>
						</td>
						<td>
							<input type="text" id="username" name="username" size="30" value="" maxlength="25"><div id="msgErrUsername"><input type="hidden" id="userFail" value="0"></div>
						</td>  
				</tr>
				<tr>
						<td height="30" align="right">
							<label id="pwmsg" for="password">
							Mật khẩu:
							</label>
						</td>
						<td>
						<input type="password" id="password" name="password" size="30" value="" >
						</td>
				</tr>
				<tr>
					<td>
					</td>
					<td style="padding-left: 29px;text-decoration: underline;">
						<span class='clear'>
						<a href='<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' )?>'>Quên mật khẩu?</a>
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
<!-- dang nhap roi dang tin-->
<?php }?>

<div class="properties"><!--div big-->
	<div class="info-detail"><!-- div chua title-->
        <div class="info-structure">
	        <?php
	        if ( $this->status == 0)
	        {
	        ?>
	        <h2 class='title_details'>
	        <?php 
	        if($this->propertyData['du_an']=='Vui lòng chọn') 
	        	$da= ''; 
	        else 
	        	$da=  $this->propertyData['du_an'];
	        echo "<span>".$this->propertyData['loai_giao_dich']." ".$this->propertyData['loai_bds']." ".$da.", ".$this->propertyData['quan_huyen'].", ".$this->propertyData['tinh_thanh']."</span>";?>
	        <div class='class1' style="float:right;font-weight: normal;text-transform: none;"> 
							<li class='datalist'>
								Mã số:
							</li>
							<li class='datalist-detail'>
								<?php echo $this->propertyData['ma_so'];?>
							</li>
			
			</div>
			</h2>
		
			<?php
				$time=time(); 
				$db=& JFactory::getDBO();
				$db->setQuery("SELECT * FROM `jos_push` WHERE bds=".$_GET['id'].' AND type=1 AND start>'.$time.' ORDER BY start ASC'); 
				$info1=$db->loadAssoc();
				$db->setQuery("SELECT * FROM `jos_push` WHERE bds=".$_GET['id'].' AND type=2 AND start>'.$time.' ORDER BY start ASC'); 
				$info2=$db->loadAssoc();
				$db->setQuery("SELECT * FROM `jos_push` WHERE bds=".$_GET['id'].' AND type=3 AND start>'.$time.' ORDER BY start ASC'); 
				$info3=$db->loadAssoc();	  

				$queryInfoAll = "SELECT * FROM `jos_push` WHERE bds=" . $_GET['id'] . ' AND `end` >' . $time . 
								" ORDER BY start ASC LIMIT 3";
				$db->setQuery($queryInfoAll);
				$infoAll = $db->loadAssocList();
				
			?>
			<?php if( count($infoAll) == 0 ) {
			    echo '<table><tr><td>';
				echo "<div style='float:left;line-height:15px'>Hiện tin này không có lệnh đẩy/đánh dấu/nổi bật</div></td></tr>"; 
				?> 
			
				<tr><td><div style="margin-top:10px; margin-bottom:10px;"> <input type="button" class="sb_ck3" onclick="hen_gio_non_user(<?php echo $_GET['id'];?>);" value="Đẩy | Đánh dấu | Nổi bật tin này"></div></td></tr>
				</tr>
				</table>
			<?php	
			} else {	
			?> 
			<table border="0" style="width:450px; margin-left:-3px;">
				<?php foreach ( $infoAll as $infoItem ) {?>
				<?php if ($infoItem['type'] == 1) {?>
					<tr><td>Đã được hẹn giờ đẩy tin lúc <b><?php echo date("H:i d-m-Y",$infoItem['start']); ?></b></td></tr>
				<?php }?>
				<?php if ($infoItem['type'] == 2) {?>
					<tr><td>Đã được hẹn giờ đánh dấu lúc <b><?php echo date("H:i d-m-Y",$infoItem['start']); ?></b> đến <b><?php echo date("H:i d-m-Y",$infoItem['end']); ?></b></td></tr>
				<?php }?>
				<?php if ($infoItem['type'] == 3) {?>
					<tr><td>Đã được hẹn giờ nổi bật lúc <b><?php echo date("H:i d-m-Y",$infoItem['start']); ?></b> đến <b><?php echo date("H:i d-m-Y",$infoItem['end']); ?></b></td></tr>
				<?php }?>
				<?php } // end foreach ?>
				<?php 
				$userid = $user->id; 
				if(($this->propertyData['ma_nguoi_dang']==$userid)&&($userid!=0)){ ?>
				<tr> 
					<td><a href="index.php?option=com_hengio&Itemid=249">Sửa/Xóa</a></td>				
				</tr>
				<?php } ?>
				<tr> 
					<td><div style="margin-top:10px; margin-bottom:10px;"> <input type="button" class="sb_ck3" onclick="hen_gio_non_user(<?php echo $_GET['id'];?>);" value="Đẩy | Đánh dấu | Nổi bật tin này"></div></td>				
				</tr>
			</table>
			<?php } // end else count ?> 
			<!---------------------------------------->
			<?php if ( empty($_GET['debug'] ) ) {?>
			<script type="text/javascript" src="<?php echo JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick.min.1.3.js"></script>
			<?php }?>	
			<link rel="stylesheet" href="<?php  JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick_ltr.css"/>
			
		 	<?php
				if ($user->id!=0) include dirname(__FILE__).'/hen_gio_user.php' ; else include dirname(__FILE__).'/hen_gio_non_user.php' ; 
			?> 
			
	        <?php 
	        	if($this->hien_thi_luot_xem == 1)
	        	{?>
        		<div  style='float:right;display:inline'>
    
					<ul class='share'>
						<li>
							<?php echo $this->chiase;?>
						</li>						
						<li class='print'>		
								<a href="javascript:window.print()"> </a>
						</li>	
						<li class='luotxem'>
						<?php echo JText::_('LUOT_XEM').': '.$this->propertyData['luot_xem']; ?>	  
						</li>
					</ul>
        	
        			
        			
        		</div>
        		
	        <?php }	        
	        }
	        else
	        {?>
				<table style="display:none">
					<tr>
						<td style="width:70px">
						<span id='REF_SAVE'><?php echo JText::_('TIEU_DE').": "; ?></span>
						</td>
						<td>
							<input type='text'  size='70px' id='ref' name='tieu_de' disabled="disabled" value='<?php echo $this->propertyData['tieu_de'] ?>' class='inputbox_seo' /><span class="error-dt" id="tieude-error"></span>
						</td>
					</tr>
					<tr>
						<td style="width:70px">
						<span id='span_alias'><?php echo JText::_('ALIAS').": "; ?></span>
						</td>
						<td>
							<input type='text'  size='70px' id='alias' name='alias' disabled="disabled" value='<?php echo $this->propertyData['alias'] ?>' class='inputbox_seo' />
						</td>
					</tr>				
				</table>
<?php
	        }
?>
        </div>
	</div>
	
	 <!-- hinh anh, ban do -->
	 <div id="properties-detail_w">	
	 <div class='properties-detail-img-l'>
        <div class="smoothness"> <!-- div chua tab -->
	   		<ul id="tabheader" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
	   			<li rel="subtab1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
					<span class="tab_active">
						<a><?php  echo JText::_('THÔNG TIN'); ?></a>
					</span>
				</li>
				<li rel="subtab2" class="ui-state-default ui-corner-top"><!-- báº£n Ä‘á»“ -->
					<span class="tab_inactive">
						<a><?php  echo JText::_('BAN_DO'); ?></a>
					</span>		
				</li><!-- báº£n Ä‘á»“ -->
	 		</ul>
	 	</div><!-- div chua tab--> 
 		<div class="boxholder">
			<div id="subtab1" class="box"> 
					 
				<div class="image-bds">					
					<?php 
						if ( !empty( $this->imageBlockHTML ) )
						{
							echo $this->imageBlockHTML;								
						}
					?>					
				</div>	
					<div class='properties-detail-img-r <?php  if( $this->status != 0 ) echo "properties-detail-img-r1" ?>'>
	<?php if($this->status==0){?>
						<div class='class1' style="display:none"> 
							<li class='datalist'>
								Mã tài sản:
							</li>
							<li class='datalist-detail'>
								<?php echo $this->propertyData['ma_so'];?>
							</li>
			
						</div>
						<div class='clas2'> <!-- loại giao dich-->
								<li class='datalist'>
									Mục đích:
								</li>
								<li class='datalist-detail'>
									<?php echo $this->propertyData['loai_giao_dich']?>
								</li>
						</div>
			
						<div class='class1'> <!-- loại hình giao dịch-->
							<li class='datalist'>
								Loại hình: 
							</li>
							<li class='datalist-detail'>
								<?php echo $this->propertyData['loai_bds']?>
							</li>
						</div> <!-- loại hình giao dịch-->
						
						<div class='clas2'> <!-- loại hình giao dịch-->
							<li class='datalist'>
								Thuộc dự án: 
							</li>
							<li class='datalist-detail'>
								<?php if($this->propertyData['du_an']=='Vui lòng chọn' || empty($this->propertyData['du_an'])) echo '_'; else echo $this->propertyData['du_an']?>
							</li>
						</div> <!-- loại hình giao dịch-->
	
						<div class='class1'> <!-- địc chỉ-->
							<li class='datalist'>
							Địa chỉ:
							</li>
							<li class='datalist-detail'>
								<?php 
									if ( !empty($this->propertyData['dia_chi']) )
									{
									echo $this->propertyData['dia_chi'];
									}
									else
									{
									echo '_';	
									}
								?>
							
							</li>
			
						</div><!-- địa chỉ-->
						<div class='clas2'> <!-- diện tích sử dụng-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>' >
					DT sử dụng: 
				</li>
				<li class='datalist-detail'>
					<?php
					  if ( !empty($this->propertyData['dien_tich_su_dung']) )
							{
				      			echo $this->propertyData['dien_tich_su_dung'] . 'm<sup>2</sup>';
								
							}
							else
							{
								echo '_';	
							}			  
					 ?>
				</li>
			</div> <!-- diện tích sử dụng-->	
			
			<?php 
			}
			else
			{ ?>
						<div class='class1' style="display:none"> <!-- mã tài sản-->

							<li class='datalist datalistadmin'>
					Mã tài sản:
							</li>
							<li class='datalist-detail'>
					<?php	
						echo "<input type='text' id='properties_key'  name='properties_key' value='". $this->properties_key ."' class='inputbox_id admin-input'/>";
					?>
							</li>
			
						</div><!-- loại giao dich-->
						<div class='clas2'> <!-- loại giao dich-->
				<li class='datalist datalistadmin'>
					Mục đích:<span class="red">*</span>
				</li>
				<li class='datalist-detail'>
					<?php echo $this->kinds; ?>
				</li>
			
			</div><!-- loại giao dich-->
			
						<div class='class1'> <!-- loại hình giao dịch-->
				<li class='datalist datalistadmin'>
					Loại hình: <span class="red">*</span>
				</li>
				<li class='datalist-detail'>
					<?php echo $this->types; ?> 
				</li>
			</div> <!-- loại hình giao dịch-->
						<div class='clas2'> <!-- tinh-->
				<li class='datalist datalistadmin'>
					Tỉnh thành: <span class="red">*</span>
				</li>
				<li class='datalist-detail'>
					<?php echo $this->towns; ?> 
				</li>
			</div> <!-- tinh-->
						<div class='class1'> <!-- huyen-->
				<li class='datalist datalistadmin'>
					Quận huyện: <span class="red">*</span>
				</li>
				<li class='datalist-detail'>
					<span id="quanhuyens">
					<?php echo $this->areas; ?>
					</span>
				</li>
			</div> <!-- loại hình giao dịch-->
			<div class='class1'> <!-- địc chỉ-->
				<li class='datalist datalistadmin'>
					Địa chỉ:<span class="red">*</span>
				</li>
				<li class='datalist-detail'>
					<input type="text" id="address" name="dia_chi" onchange="changval(this)" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['dia_chi']; else echo $this->propertyData['duong_pho']?>" class="inputbox_address admin-input" size="20" />
				</li>
			
			</div><!-- địa chỉ-->
			
			<div class='clas2'> <!-- diện tích sử dụng-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>' >
					DT sử dụng: <?php if( $this->status != 0 ) echo '<span class="red">*</span>' ?>
				</li>
				<li class='datalist-detail'>
					<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['dien_tich_su_dung']) )
							{
				      			echo $this->propertyData['dien_tich_su_dung'] . 'm<sup>2</sup>';
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="dien_tich_su_dung" type="text" name="dien_tich_su_dung" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['dien_tich_su_dung']; else echo $this->propertyData['dien_tich_su_dung'] ?>" class="numberbox dt livinguse admin-input" size="7" onChange="getonchangevalue(this.value,'divliving_space','m<sup>2',1)"/>m<sup>2</sup>

					  	<?php
					  }
					 ?>
				</li>
			</div> <!-- diện tích sử dụng-->		
			
			<div class='clas2'> <!-- dự án-->
				<li class='datalist datalistadmin'>
					Thuộc dự án: 
				</li>
				<li class='datalist-detail'>
				<span id="duans">
					<?php echo $this->duAnHTML; ?>
				</span>
					 <input type="hidden" name="du_an_text_value" id="du_an_text_value" value="" />
				</li>
			</div> <!-- loại hình giao dịch-->			
			
			<?php }			
			?>
			
			<div class='class1'> <!-- diện tích sàn-->
				<li class='datalist datalistadmin wlable'>
					Diện tích sàn: 
				</li>
				<li class='datalist-detail'>
				<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['dien_tich_khuon_vien']) )
							{
				      			echo $this->propertyData['dien_tich_khuon_vien'] . 'm<sup>2</sup>';
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="dien_tich_khuon_vien" type="text" name="dien_tich_khuon_vien" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['dien_tich_khuon_vien']; else echo $this->propertyData['dien_tich_khuon_vien'] ?>" class="numberbox dt livinguse admin-input" size="7" onChange="getonchangevalue(this.value,'divliving_space','m<sup>2',1)"/>m<sup>2</sup>

					  	<?php
					  }
					 ?>
				</li>
			</div> <!--diện tích sàn-->
			
			<div class='class1'> <!-- số tầng-->
				<li class='datalist datalistadmin wlable'>
					Số tầng: 
				</li>
				<li class='datalist-detail'>
				<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['so_tang']) )
							{
				      			echo $this->propertyData['so_tang'];
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="so_tang" type="text" name="so_tang" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['so_tang']; else echo $this->propertyData['so_tang'] ?>" class="numberbox livinguse admin-input" size="7" />

					  	<?php
					  }
					 ?>
				</li>
			</div> <!--số tầng-->
			
			<div class='class1'> <!-- chiều rộng-->
				
				<li style='line-height:20px;' class="datalist	<?php  if( $this->status != 0 ) echo "datalistadmin" ?> " style="margin-bottom: 2px;">
					Mặt tiền: 
				</li>
				<li class='datalist-detail'>
				<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['dien_tich_khuon_vien_rong']) )
							{
				      			echo "<span>".$this->propertyData['dien_tich_khuon_vien_rong'] . 'm</span>';
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="dien_tich_khuon_vien_rong" type="text" name="dien_tich_khuon_vien_rong" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['dien_tich_khuon_vien_rong']; else echo $this->propertyData['dien_tich_khuon_vien_rong'] ?>" style="width:50px;" class="numberbox livinguse admin-input" size="7" />m

					  	<?php
					  }
					 ?>
					</li>
					
					 <li style='line-height:20px;' class="datalist">
					 &nbsp;x &nbsp;Sâu: 
					 </li>
					 <li class='datalist-detail'>
				<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['dien_tich_khuon_vien_dai']) )
							{
				      			echo $this->propertyData['dien_tich_khuon_vien_dai'] . 'm';
								
							}
							else
							{
								echo '_';	
							}
					  }
				
					  else
					  {
					  
					  	?>

					  	<input id="dien_tich_khuon_vien_dai" type="text" name="dien_tich_khuon_vien_dai" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['dien_tich_khuon_vien_dai']; else echo $this->propertyData['dien_tich_khuon_vien_dai'] ?>" style="width:54px;" class="numberbox livinguse admin-input" size="7" />m

					  	<?php
					  }
					 ?>
					</li>
			
			</div> <!--chiều dài-->
			<?php 
					if($this->status == 0)
                    { ?><div class="gia-noibat"><?php }?>
			<?php if($this->status==0){?>
						<div class='class1'>
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'> <!-- gia nguyen can-->
					Giá nguyên căn: 
				</li>
				<li class='datalist-detail'>
				<span class="gia"> 
					<?php 
					if($this->status == 0)
                    {
                    	if($this->gia_nguyen_can != 0 ){
							echo $this->gia_nguyen_can;
							if( $this->propertyData['don_vi_dien_tich_id'] == 3 || $this->propertyData['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
                    	}
                    	else{
                    		echo "Thương lượng";
                    	}
                    }
                    ?>
				</span>
				</li>
			</div><!-- gia nguyen can-->
			
			
						<div class='clas2'>
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'> <!-- gia theo m-->
					Giá theo m<sup>2</sup>:
				</li>
				<li class='datalist-detail'>
				<span class="gia"> 						
					<?php 
					if($this->status == 0)
                    {
                    	if($this->gia_m2 != 0 ){
							echo $this->gia_m2."/m<sup>2</sup>";
							if( $this->propertyData['don_vi_dien_tich_id'] == 3 || $this->propertyData['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
                    	}
                    	else{
                    		echo "Thương lượng";
                    	}
                    }
                    ?>
				</span>
				</li>
			</div><!-- gia nguyen can-->
			<?php 
			}else
			{			
			?>
					<div class='class1'>
				<li class='datalist datalistadmin'>Giá :</li>
				<li>
				<input  id="price" type="text" name="gia" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['gia']; else  echo  $this->InsertPrice; ?>" onkeypress="return numbersonly(this, event)" onkeyup="formatThousandPoint(this,this.value)" placeholder="thương lượng" class="numberbox new2 admin-input" size="10"  />
				<span id='aj_unit'> <?php echo $this->Unit;?></span>
				</li>
			</div>
			
			<?php }?>
			<?php 
					if($this->status == 0)
                    { ?> </div> <?php }?>
			<div class='clas2'> <!-- số phòng ngủ-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Phòng ngủ: 
				</li>
				<li class='datalist-detail'>
					<?php
					  if( $this->status == 0 )
					  {
					
							if ( !empty($this->propertyData['phong_ngu']) )
							{
				      			echo $this->propertyData['phong_ngu'];
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input class='admin-input' id="phong_ngu" type="text" name="phong_ngu" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phong_ngu']; else  echo $this->propertyData['phong_ngu'] ?>"/>

					  	<?php
					  }
					 ?>
				</li>
			</div> <!-- diện tích sử dụng-->
			
			<div class='class1'> <!-- số phòng tắm-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Phòng tắm: 
				</li>
				<li class='datalist-detail'>
					<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['phong_tam']) )
							{
				      			echo $this->propertyData['phong_tam'];
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="phong_tam" class='admin-input' type="text" name="phong_tam" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phong_tam']; else  echo $this->propertyData['phong_tam'] ?>" />

					  	<?php
					  }
					 ?>
				</li>
			</div> <!-- số phòng tắm-->
			<div class='clas2'> <!-- số phòng khác-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Phòng khác: 
				</li>
				<li class='datalist-detail'>
					<?php
					  if( $this->status == 0 )
					  {
							if ( !empty($this->propertyData['phong_khac']) )
							{
				      			echo $this->propertyData['phong_khac'];
								
							}
							else
							{
								echo '_';	
							}
					  }
					  else
					  {
					  
					  	?>

					  	<input id="phong_khac" type="text" class='admin-input' name="phong_khac" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phong_khac']; else  echo $this->propertyData['phong_khac'] ?>" />

					  	<?php
					  }
					 ?>
				</li>
			</div> <!-- diện tích sử dụng-->
			
			
			<div class='class1'> <!-- hướng-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Hướng: 
				</li>
				<li class='datalist-detail'>
					<?php 
					if ( $this->status == 0)
				    {
					    echo $this->propertyData['huong'];
				    }	
				    else{
				    	echo $this->directions;
				    }				
					?>
				</li>
			</div> <!--hướng-->
			
			<div class='clas2'> <!-- Pháp lý-->
				<li class='wlable datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Pháp lý: 
				</li>
				<li class='datalist-detail'>
					<?php 
					if( $this->status == 0)
	 				{
	 					if ( $this->propertyData['phap_ly'] != '' )
					    {
					    	echo $this->propertyData['phap_ly'];
	 					}
	 					else 
	 					{
	 						echo '_';
	 					}
	 				}else{?>
	 					<input id="phap_ly" class='admin-input' type="text" name="phap_ly" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phap_ly']; else  echo $this->propertyData['phap_ly'] ?>" />
	 				<?php 
	 				}
					?>
				</li>
			</div> <!-- Pháp lý-->
			<div class="clas2">
		
			
			 
				<?php if($this->status==0){?>
				<li class="datalist datalistadmin">
					 Nội thất:
					</li>
				<li class='datalist-detail'>
						<?php if ( $this->propertyData['noi_that'] != '' )
					    {
					    	echo $this->propertyData['noi_that'];
	 					}
	 					else 
	 					{
	 						echo '_';
	 					}
						?>
				</li>
				<?php }else{?>
					<li class="datalist datalistadmin">
					 Nội thất:
					</li>
					<li class='datalist-detail'>
						<input id="noi_that" type="text" class='admin-input' name="noi_that" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['noi_that']; else  echo $this->propertyData['noi_that'] ?>" placeholder="nếu không có thì không cần ghi vào" />
						<!--  <textarea  style='margin-top:10px' id="noi_that" name="noi_that" rows="2" cols="45" class="class_noi_that"><?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['noi_that']; else echo $this->propertyData['noi_that'];  ?></textarea> -->
					</li>
				<?php } ?>
			
	</div>
			<div class='class1' <?php if($_GET['Itemid']==226){ echo "style='display:block;'"; }else echo "style='display:none;'";?>> <!-- Chính chủ-->
				<li class='datalist'> 
				<?php if($this->status==0){?>
						<?php if($this->propertyData['chinh_chu']==1){?>
							Chính chủ <img height="12" width="12" src="<?php echo JURI::base()?>images/com_jea/check.gif">
						<?php }?>
				</li>
				<li class='datalist-detail'>
						<?php if($this->propertyData['speak_english']==1){?>
							Speak English <img height="12" width="12" src="<?php echo JURI::base()?>images/com_jea/check.gif">
						<?php }?>
				<?php 
					}else{ ?>
					<li class="datalist-detail">
					<?php if(isset($_SESSION['tmp'])){
						?>
						<input name="chinh_chu" id="chinh_chu" type="checkbox" <?php if($_SESSION['tmp']['chinh_chu']=='on') echo "checked='checked'"; ?> />&nbsp;Bạn là môi giới?&nbsp;&nbsp;&nbsp;&nbsp; <input name="speak_english" id="speak_english" type="checkbox" <?php if($_SESSION['tmp']['speak_english']=='on') echo "checked='checked'"; ?> />&nbsp;Can you speak English?
					<?php } else{
					?>
					<input name="chinh_chu" id="chinh_chu" type="checkbox" <?php if(!empty($this->propertyData['chinh_chu'])&&$this->propertyData['chinh_chu']==1) echo "checked='checked'"; ?> />&nbsp;Bạn là môi giới?&nbsp;&nbsp;&nbsp;&nbsp; <input name="speak_english" id="speak_english" type="checkbox" <?php if(!empty($this->propertyData['speak_english'])&&$this->propertyData['speak_english']==1) echo "checked='checked'"; ?> />&nbsp;Can you speak English?
					</li> 
						
				<?php 	}
					}
				?>
				</li>
			</div> <!--Chính chủ-->
			
			<?php if($this->status==0){?>
			
			<div class='clas2'>
				<ul> 
<?php 
	if (!isset($_SESSION['now'])) {
		$_SESSION['now']='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$_SESSION['goback']=$_SERVER['HTTP_REFERER']; 
	} else
	{
		if ($_SESSION['now']!='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']) {
			$_SESSION['now']='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];	
			$_SESSION['goback']=$_SERVER['HTTP_REFERER'];
		}
	}
?>
				<li class='back' onclick='<?php if (isset($_SESSION['goback'])) echo 'window.location="'.$_SESSION['goback'].'"'; else echo 'history.go(-1)'; ?>'>
					Quay lại
					</li>
					<li class='spam' onclick="getSaiPham(<?php echo $this->propertyData['id'] ?>,'<?php echo JURI::base()?>')">
					Báo cáo sai phạm
					</li>
				</ul>
			
			</div>
			<?php }?>
			
			
		</div> 
  		</div>
       		<div class='clear'>	</div>           
			</div>
		<div id="subtab2" class="box" style="visibility: hidden;height:0">
				<?php if ( $this->googlemapDisplay )
					{
						if ( $this->status != 0)
						{
						?>
							<span id='ajUPDATE_MAP'>
							Bạn có thể kéo thả con trỏ địa chỉ trên bản đồ tới vị trí chính xác hơn.
							</span>
						<?php
						}
						?>
						<div id="map_canvas">
							<div id="map"></div>
						</div>
				
					<?php
					}
					?>
			</div>
		</div>
	</div>
	</div> 	
	<!--  thong tin co ban -->
	<div class='properties-detail'>
	
<div class="info-structure" class='chitiet-mlbds'>
				<div class='info-structure-title'>
					<h4>
						<span id='aj_MO_TA'>
							<?php echo JText::_('MO_TA'); ?> 
						</span>
					</h4>
				</div>



		         <?php
		         if( $this->status == 0)
		         {
					echo "<div class='space'>";
		         	//echo $this->propertyData->description;
		         	echo $this->propertyData['mo_ta_chi_tiet'];
					echo "</div>";
		         }
				 
		         else
		         {
		         	if(isset($_SESSION['tmp'])) $noidung =  $_SESSION['tmp']['mo_ta_chi_tiet']; else $noidung = $this->propertyData['mo_ta_chi_tiet'] ;
					echo "<div class='space1'>";
					echo $this->editor->display('mo_ta_chi_tiet', $noidung, '99%', '300', '75', '20', false ) ;				
					echo "</div>";
		         }
		         ?>
		  	

</div>
</div>
<!-- MO TA -->
			
				<!-- TIEN_ICH -->
					<?php
            if ( $this->status == 0 )
            {
	            if( !empty( $this->tienIchHTML ) )
	            {
		            ?>
				        <div class="info-structure">
								<div class="info-structure-title">
									
											<h4>
											<?php echo JText::_('Thông tin thêm');?>
											</h4>
								</div>
							
							
								<div class="StructureC222">
										<?php
										echo $this->tienIchHTML;
										?>
								</div>
								
						</div>
						
					
					<?php
           		}
            }
            else
            {
			?>
            <div class="info-structure">
				<div class='info-structure-title'>
					
							<h4><span id="aj_ADVANTAGES"><?php echo JText::_('Thông tin thêm'); ?> </span></h4>				
				</div>
				
			<div class='adminimages'>
			<span id="ajbackend_ADVANTAGES"> <?php echo $this->tienIchHTML; ?></span>
			</div>
			</div>
			<?php
            }
            
?>				<!-- TIEN ICH -->
	

			<div class='clas3' id="gantruong"> <!-- gần trường-->
				<li class='datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Gần trường: 
				</li>
				<li class='datalist-detail'>
					<?php 
					if( $this->status == 0)
	 				{
	 					if ( $this->propertyData['truong'] != '' )
					    {
					    	echo $this->propertyData['truong'];
	 					}
	 					else 
	 					{
	 						echo '<script>document.getElementById("gantruong").style.display = "none" </script>';
	 					}
	 				}else{?>
	 					<input type="text" id="truong"  name="truong" class="admin-input" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['truong']; else echo $this->propertyData['truong'] ?>" /> 
	 				<?php }
					?>
				</li>
			</div>
			<div class='clas3' id="ganbenhvien">
				<li style='width:85px;' class='datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>'>
					Gần bệnh viện: 
				</li>
				<li class='datalist-detail'>
					<?php 
					if( $this->status == 0)
	 				{
	 					if ( $this->propertyData['benh_vien'] != '' )
					    {
					    	echo $this->propertyData['benh_vien'];
	 					}
	 					else 
	 					{
	 						echo '<script>document.getElementById("ganbenhvien").style.display = "none" </script>';
	 					}
	 				}else{?>
	 					<input type="text" id="benhvien"  name="benhvien" class="admin-input" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['benhvien']; else  echo $this->propertyData['benh_vien'] ?>" /> 
	 				<?php }
					?>
				</li>
			</div> 
			
			<div class='clas3' id="gancho"> <!-- gần sieu thị-->
				<li class='datalist <?php  if( $this->status != 0 ) echo "datalistadmin" ?>' style="width:95px;">
					Gần chợ/siêu thị: 
				</li>
				<li class='datalist-detail'>
					<?php 
					if( $this->status == 0)
	 				{
	 					if ( $this->propertyData['sieu_thi'] != '' )
					    {
					    	echo $this->propertyData['sieu_thi'];
	 					}
	 					else 
	 					{
	 						echo '<script>document.getElementById("gancho").style.display = "none" </script>';
	 					}
	 				}else{?>
	 					<input type="text" id="sieuthi"  name="sieuthi" class="admin-input" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['sieuthi']; else echo $this->propertyData['sieu_thi'] ?>" /> 
	 				<?php }
					?>
				</li>
			</div> 
		
	 <div class="info-structure">
      	<?php if( $this->status == 0 )
		{ ?>
   <div id="posfixed"  style="position:absolute; top:0px;">
	    <div id="lienhe" <?php if ($this->status==0)echo "style='100px;'" ?>>
		<div class='lienhe1'>
		<div class='lienhe2'>	
			<div class='info-contact'>
				<h4>
					Thông tin liên hệ
				</h4>
				
				<div class='details-contact'>
					<ul>
						<li>
							<span>
									Người đăng:
							</span>
							<span class='bold' id="tennguoilienhebds">
							
									<?php echo $this->propertyData['ten_nguoi_lien_he'] ?>
							
							</span>
						</li>
						<li>
							<span>
									Số điện thoại:
							</span>
							<span class='bold'>
							
									<?php echo $this->propertyData['dien_thoai_nguoi_lien_he'] ?> 							
						
							</span>
							<span class="error-dt" id="dienthoai-error"></span>
						</li>				
						<li>
							<span>
									Email:
							</span>
							<span class='bold' id="emailnguoilienhe">
						
									<?php echo $this->propertyData['email_nguoi_lien_he'] ?>  
									
							</span>
						</li>						
						<li>
							<span>
									Ghi chú:
							</span>
							<span class='bold'>
							
									<?php echo $this->propertyData['ghi_chu_nguoi_lien_he'] ?>  
							
									
							</span>
						</li>
						<li>
							<span class="check bold">
								<?php 
								if($this->status==0){
										if($this->propertyData['chinh_chu']==1){?>
											 Chính chủ&nbsp;<img height="12" width="12" src="<?php echo JURI::base()?>images/com_jea/check.gif">
								<?php }
								}
								?>
								<?php 
								if($this->status==0){	
									if($this->propertyData['speak_english']==1){?>
										 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speak English&nbsp;<img height="12" width="12" src="<?php echo JURI::base()?>images/com_jea/check.gif">
								<?php }
								}
								?>
							</span>
						</li>
						<li>
							<h4 class='componentheading'><a class='btn-search show_hide' href="javascript:;" id="lienhe-gui">Gửi tin nhắn</a></h4>
							<script>
								//function showContact(){
								//	document.getElementById("contact-form-mail").style.display='block';
								//	document.getElementById("lienhe").style.height='450px';
								//}
								$(document).ready(function(){
 
								$(".slidingDiv").hide();
									$(".show_hide").show();
 
									$('.show_hide').click(function() {
							<?php
									if ($this->propertyData['email_nguoi_lien_he']=='') {
										echo 'alert(\'Vui lòng liên hệ qua số điện thoại\');
											return false;';
									} else echo '$(".slidingDiv").slideToggle();';
							?> 
									});
 
								});

							</script>
						</li>
						
					</ul>
					
					
				</div>

			</div>
			
			<div class='slidingDiv' id="contact-form-mail" class='contact-form' style="display: none">
					<?php echo $this->lienhe; ?>
			</div>
		
			<div class='clear'>
			</div>	
		
		</div>
		</div>
		</div>
		</div>	
		<?php }?>
		
	<?php if( $this->status != 0 ){ ?>
	<?php 	
		$mandary = '';
		if(isset($_GET['task2'])&& $_GET['task2']=='noregister'){
			$mandary = '<span class="red"> *</span>';
		}
	?>
	
				<div class='lienheadmin'>
				<h4 class='componentheading'>
					Thông tin liên hệ
				</h4>
				<?php if((isset($_GET['task2'])&& $_GET['task2']=='login') || (isset($_GET['task2'])&& $_GET['task2']=='register')){?>
				<div style="padding-top:10px">Thông tin này sẽ được truy xuất từ thông tin bạn dùng lúc đăng ký tài khoản, chỉ nhập vào nếu bạn muốn thay đổi</div>
				<?php }
					if($this->propertyData['ma_nguoi_dang']!=$user->id){
						$user->email = '';
					}
				?>
				<table width="100%" border="0" class='contentpane fromlienhe'>
						<tr>
							<td align="right">
								<span>
									Người đăng:<?php echo $mandary?>
								</span>
							</td>
							<td>
								<input type="text" id="name_vl"  name="name_vl" class="class_lienhe_dangtin" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['name_vl']; else { if($this->propertyData['ten_nguoi_lien_he']!='')echo $this->propertyData['ten_nguoi_lien_he']; else echo $user->name;} ?>" />  
							</td>
					</tr>
					<tr>
							<td align="right">
								<span>
									Số điện thoại:<?php echo $mandary?>
								</span>
							</td>
							<td>
								<input type="text" name="phone_vl" id="phone_vl" class="class_lienhe_dangtin" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phone_vl']; else{ if($this->propertyData['dien_thoai_nguoi_lien_he']!='')echo $this->propertyData['dien_thoai_nguoi_lien_he']; else echo $user->phone;} ?>"/>
									<span class="error-dt" id="dienthoai-error"></span>
							</td>
					</tr>
					<tr>
							<td align="right">
								<span>
									Email:
								</span>
							</td>
							<td>
							<input type="text" name="email_vl" id="email_vl" class="class_lienhe_dangtin" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['email_vl']; else { if($this->propertyData['email_nguoi_lien_he']!='')echo $this->propertyData['email_nguoi_lien_he']; else echo $user->email;}?>"/></td>
					</tr>
					<tr>
							<td align="right">
								<span>
									Ghi chú:
								</span>
							</td>
							<td>
								<textarea  id="ghichu" name="ghichu" rows="7" cols="5" class="class_lienhe_dangtin"><?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['ghichu']; else echo $this->propertyData['ghi_chu_nguoi_lien_he'];  ?></textarea>
							</td>
					</tr>
			</table>
				</div>
			<?php }?>

	</div>
       <?php
if( $this->status == 0) // if bat dong san lien quan
{
	if( !empty( $this->samePropertiesHTML ) && trim( $this->samePropertiesHTML ) != '' )
	// if( !empty( $this->samePropertiesHTML ) && trim( $this->samePropertiesHTML ) != '' )
	{
	?>
	  <div class="info-structure1"><!--BAT_DONG_SAN_LIEN_QUAN -->
            <div>
   					  	<h4 class="componentheading"><?php  echo JText::_('BAT_DONG_SAN_LIEN_QUAN');?></h4>
					
			 </div>
		      <div id="loading" style="display:none;position:absolute;  padding-left:320px;">
		      <img src="images/loading.gif">
		      </div>
		    <div class="tranga">
		    		<?php
						// echo $this->samePropertiesAjaxPagingHTML;
					?>
				<?php
					echo $this->samePropertiesHTML;
				?>
				</div>
		</div> <!-- BATT_DONG_SAN_LIEN_QUAN -->
	<?php
	}
	?>
	
   <?php
	} // end if bat dong san lien quan
	
   ?>
   <?php
 if ( $this->status != 0)
{
?>

<!--
  
		<div class="dangtinadminbds_no">
			 <span id='SEO_CONFIG' class='componentheading'><?php echo JText::_('CAU_HINH_SEO') ; ?> </span>	
		</div>
		<div class="dangtinadminbds">
			 <span id='SEO_PAGE_TITLE'><?php echo JText::_('TIEU_DE_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
				
		</div>
		<div class="dangtinadminbds">		
			<span id='SEO_PAGE_KEYWORDS'><?php 	echo JText::_('TU_KHOA_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
				<textarea id='page_keywords'  name='tu_khoa_trang'  class="seo_bds_admin_tieude"><?php echo $this->propertyData['tu_khoa_trang'] ?></textarea>			
		</div>	
		<div class="dangtinadminbds">			
			<span id='SEO_PAGE_DESCRIPTION'><?php 	echo JText::_('DIEN_GIAI_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
			
		</div>
		-->
		<div class="dangtinadminbds_no">
			 <span id='SEO_CONFIG' class='componentheading'><?php echo JText::_('CAU_HINH_SEO') ; ?> </span>	
		</div>
		<table width="100%" border="0" class='contentpane'>
				<tr>
					<td align="right">
						<span id='SEO_PAGE_TITLE'>
							<?php echo JText::_('TIEU_DE_SEO') ; ?>:
						</span>
					</td>
					<td>
						<textarea id='page_title'  name='tieu_de_trang'  class="seo_bds_admin_tieude"><?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['tieu_de_trang']; else  echo $this->propertyData['tieu_de_trang'] ?></textarea>				
					</td>
				</tr>
				<tr>
					<td align="right"><span id='SEO_PAGE_KEYWORDS'><?php 	echo JText::_('TU_KHOA_SEO') ; ?>:</span></td>
					<td><textarea id='page_keywords'  name='tu_khoa_trang'  class="seo_bds_admin_tieude"><?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['tu_khoa_trang']; else  echo $this->propertyData['tu_khoa_trang'] ?></textarea>			
					</td>
				</tr>
				<tr>
					<td align="right"><span id='SEO_PAGE_DESCRIPTION'><?php 	echo JText::_('DIEN_GIAI_SEO') ; ?>:</span></td>
					<td><textarea id='page_description'  name='mo_ta_trang'  class="seo_bds_admin_diengiai"><?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['mo_ta_trang']; else  echo $this->propertyData['mo_ta_trang'] ?></textarea>
					</td>
				</tr>

</table>
      
<?php 
}
	if( $this->status == 1 )
	{
	//	print_r($user);
	     //echo "<hr>";
		//global $mainframe;
		//set the argument below to true if you need to show vertically( 3 cells one below the other)
		//$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
		
		
		
		?>
	 <?php if(isset($_GET['task2'])&& $_GET['task2']=='noregister' || $_GET['Itemid']=='226'){?>	
	 <table width="100%">
	 <tr>
		<td height="30" align='right' valign='top' style="width: 108px;">
	 Mã an toàn 
</td>
<td>

<?php

global $mainframe;
//set the argument below to true if you need to show vertically( 3 cells one below the other)
$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
?>
<?php if(isset($_SESSION['tmp']))
{?>
	<script type="text/javascript">
	<?php if($_SESSION['tmp']['captcha']!=''){?>
		alert('<?php echo $_SESSION['tmp']['captcha'];unset($_SESSION['tmp']['captcha'])?>');
	<?php }?>
		adminForm.osolCatchaTxt.style.borderColor="#FF0000";
		adminForm.osolCatchaTxt.focus();
		document.getElementById("osolCatchaTxt0").setAttribute("onclick","document.getElementById('msgErrCapt').innerHTML=''");
	</script>
<?php }
?>
</td>
</tr>
</table>
<?php }?>
		
			<div class='listbutton' style="width:800px;clear:both" >
		     <center>
		     <ul style="height:40px;padding-left: 290px;">
		     <li style='float:left'>
		      <?php if(isset($_GET['task2'])&& $_GET['task2']=='register'){?>
		      <input type="hidden" name="tks" value="1" />
		      <span id ='ajSAVE_PUBLISHED'>
				 <input type="button" onclick="valid_regisF(adminForm,'2')" name="save_published" class="btn-search" value="<?php echo JText::_('Đăng tin') ?>" />
			  </span>			      
		      <?php }elseif(isset($_GET['task2'])&& $_GET['task2']=='login'){?>		      
		     	<input type="hidden" name="tkslogin" value="1" />
		      <span id ='ajSAVE_PUBLISHED'>
				 <input type="button" onclick="getDataLogin(adminForm,'2')" name="save_published" class="btn-search" value="<?php echo JText::_('Đăng tin') ?>" />
			  </span>	
		     
		      <?php }elseif(isset($_GET['task2'])&& $_GET['task2']=='noregister'){?>
		      <span id ='ajSAVE_PUBLISHED'>
				 <input type="button" onclick="submitForm('noregister','<?php echo $op ?>',<?php echo $op ?>,'2', '<?php echo $this->lang ?>')" name="save_published" class="btn-search" value="<?php echo JText::_('Đăng tin') ?>" />
			  </span>	     
		      <?php }else{?>		      
		      <span id ='ajSAVE_PUBLISHED'>
				 <input type="button" onclick="submitForm('<?php echo  $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'2', '<?php echo $this->lang ?>')" name="save_published" class="btn-search" value="<?php echo JText::_('Đăng tin') ?>" />
				 <input type="hidden" name="chinh_chu" id="chinh_chu"  value="<?php echo $userchinhchu ?>" />
				 <input type="hidden" name="speak_english" id="speak_english"  value="<?php echo $userenglish ?>" />
			  </span>
		      <?php }?>
		      </li>
		      </ul>		     
		     <input type="hidden" id="frmre_link" name="re_link"/>
		     <input type="hidden" id="frmpublished" name="hien_thi_ra_ngoai"/>
		     <input type="hidden" id="getKnowId" name="getKnowId"/>
		      </center>
		      </div>

		
	<?php	
	}
	else 
	 if ( $this->status == 2 ) 
		{
			?>
			<div style="width:800px" >
		     <center>

 <input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3','<?php echo $this->lang ?>')" name="save_review" class="btn-search" value="<?php echo JText::_('LUU') ?>" />
				<span id ='ajCancael'>
			     <input type="button" onclick="submitbutton('cancel')" name="save_cancel" class="btn-search" value="<?php echo JText::_('CANCEL') ?>" />
				</span>
				<input type="hidden" id="frmre_link" name="re_link"/>
		     <input type="hidden" id="frmpublished" name="published"/>
		     <input type="hidden" id="getKnowId" name="getKnowId"/>
			      </center>
		      </div>
			<?php 
		}
?>

<!--  begin google map -->

<!-- map position -->
  <input id="loai_tin_id" type="hidden" name="loai_tin_id" value="<?php echo $this->propertyData['loai_tin_id'];?>" />
  <input id="map_lat" type="hidden" name="map_lat" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['map_lat']; else  echo $this->propertyData['kinh_do'];?>" />
  <input id="map_lng" type="hidden" name="map_lng" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['map_lng']; else  echo $this->propertyData['vi_do'];?>" />
  <input id="pro_total_info" type="hidden" name="pro_total_info" value="3" />
  
  <!-- hidden chuc nang dang tin -->
  <input id="sess_tmp" type="hidden" name="sess_tmp" value="2" />

  
  <style type="text/css">
            #map{width:700px;margin-top:5px;margin-left:5px;border:1px solid;
                 height:400px;}
</style>




<?php if ( empty( $_GET['debug'] ) ) {?>
<script language="javascript" type="text/javascript" src="libraries/js/mailBDS.js"></script>
<?php }?>
<?php
if ( $this->googlemapDisplay )
{
	?>
	<style type="text/css">
		#map_canvas
		{
		width:630px;
		margin-top:2px;
		margin-left:2px;
		border:1px solid dashed;
		height:400px;
		}
	</style>
		
<?php
}
?>
  
<?php
if ( $this->status != 0 )
{
	if($this->propertyData['loai_bds_id'])
	{
	?>
		<script type="text/javascript" defer="defer" >
			// TODO: add filter
			//jea_types_filter(<?=$this->propertyData['loai_bds_id']?>);
		</script>
	<?php
	}
}
?>


<?php
if ($this->status == 2 )
{
?>


	<input type="hidden" name="task" value="" />
	<input type="hidden" name="zip_code" value="084" />
	<input type="hidden" name="id" value="<?php echo $this->propertyData['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>
	
<?php
}
?>

<!-- cac the hidden chua tam toan bo data khi dang tin -->
<?php
if ($this->status != 0 )
{
?>
	<!-- phan hidden thay doi theo ngon ngu -->
	<input type="hidden" name="currentLang" id="currentLang"  value="<?php echo $this->lang ?>" />
	<input type="hidden" name="customer" id="customer"  value="<?php if($this->propertyData['ma_nguoi_dang']!=''){ echo $this->propertyData['ma_nguoi_dang']; }else { echo $user->id; }?>" />
		<!-- tieng viet -->
	<input type="hidden" name="vi_hidden_ref" id="vi_hidden_ref" value=" " />
	<input type="hidden" name="vi_hidden_address" id="vi_hidden_address"  value=" " />
	<input type="hidden" name="vi_hidden_description" id="vi_hidden_description"  value=" " />
	<input type="hidden" name="vi_hidden_name_vl" id="vi_hidden_name_vl"  value=" " />
	<input type="hidden" name="vi_hidden_address_vl"  id="vi_hidden_address_vl" value=" " />
	<input type="hidden" name="vi_hidden_ghichu" id="vi_hidden_ghichu" value=" " />
	<input type="hidden" name="vi_hidden_page_title" id="vi_hidden_page_title" value=" " />
	<input type="hidden" name="vi_hidden_page_keywords"  id="vi_hidden_page_keywords" value=" " />
	<input type="hidden" name="vi_hidden_page_description"  id="vi_hidden_page_description"  value=" " />
	<input type="hidden" name="vi_hidden_properties_key" id="vi_hidden_properties_key"  value=" " />
	
		<!-- tieng anh -->
	<input type="hidden" name="en_hidden_ref" id="en_hidden_ref" value="<?php echo $this->propertyDataen['tieu_de'] ?>" />
	<input type="hidden" name="en_hidden_address" id="en_hidden_address"  value="<?php echo $this->propertyDataen['dia_chi'] ?>" />
	<input type="hidden" name="en_hidden_description" id="en_hidden_description"  value="<?php echo $this->propertyDataen['mo_ta_chi_tiet'] ?>" />
	<input type="hidden" name="en_hidden_name_vl" id="en_hidden_name_vl"  value="<?php echo $this->propertyDataen['ten_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_address_vl"  id="en_hidden_address_vl" value="<?php echo $this->propertyDataen['dia_chi_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_ghichu" id="en_hidden_ghichu" value="<?php echo $this->propertyDataen['ghi_chu_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_page_title" id="en_hidden_page_title" value="<?php echo $this->propertyDataen['tieu_de_trang'] ?>" />
	<input type="hidden" name="en_hidden_page_keywords"  id="en_hidden_page_keywords" value="<?php echo $this->propertyDataen['tu_khoa_trang'] ?>" />
	<input type="hidden" name="en_hidden_page_description"  id="en_hidden_page_description"  value="<?php echo $this->propertyDataen['mo_ta_trang'] ?>" />
	<input type="hidden" name="en_hidden_properties_key" id="en_hidden_properties_key"  value=" " />
	<input type="hidden" name="advantagesGetValue" id="advantagesGetValue"  value=" " />
	

	<!--  tieng viet -->
	<input type="hidden" name="vi_loai_bds" id="vi_loai_bds"  value=" " />
	<input type="hidden" name="vi_loai_giao_dich" id="vi_loai_giao_dich"  value=" " />
	<input type="hidden" name="vi_phap_ly" id="vi_phap_ly"  value=" " />
	<input type="hidden" name="vi_don_vi_dien_tich" id="vi_don_vi_dien_tich"  value=" " />
	<input type="hidden" name="vi_don_vi_tien" id="vi_don_vi_tien"  value=" " />
	<input type="hidden" name="vi_nha_moi_gioi_ten" id="vi_nha_moi_gioi_ten"  value=" " />
	<input type="hidden" name="vi_tinh_thanh" id="vi_tinh_thanh"  value=" " />
	<input type="hidden" name="vi_quan_huyen" id="vi_quan_huyen"  value=" " />
	<input type="hidden" name="vi_tien_ich" id="vi_tien_ich"  value=" " />
	<input type="hidden" name="vi_huong" id="vi_huong"  value=" " />
	<input type="hidden" name="vi_vi_tri" id="vi_vi_tri"  value=" " />
	<input type="hidden" name="vi_nha_moi_gioi" id="vi_nha_moi_gioi"  value=" " />
	<input type="hidden" name="vi_du_an" id="vi_du_an"  value=" " />

	<!--  tieng anh -->
	<input type="hidden" name="en_loai_bds" id="en_loai_bds"  value="<?php echo $this->propertyDataen['loai_bds'] ?>" />
	<input type="hidden" name="en_loai_giao_dich" id="en_loai_giao_dich"  value="<?php echo $this->propertyDataen['loai_giao_dich'] ?>" />
	<input type="hidden" name="en_phap_ly" id="en_phap_ly"  value="<?php echo $this->propertyDataen['phap_ly'] ?>" />
	<input type="hidden" name="en_don_vi_dien_tich" id="en_don_vi_dien_tich"  value="<?php echo $this->propertyDataen['don_vi_dien_tich'] ?>" />
	<input type="hidden" name="en_don_vi_tien" id="en_don_vi_tien"  value="<?php echo $this->propertyDataen['don_vi_tien'] ?>" />
	<!-- <input type="hidden" name="en_nha_moi_gioi_ten" id="en_nha_moi_gioi_ten"  value="<?php echo $this->propertyDataen['nha_moi_gioi_ten'] ?>" /> -->
	<input type="hidden" name="en_tinh_thanh" id="en_tinh_thanh"  value="<?php echo $this->propertyDataen['tinh_thanh'] ?>" />
	<input type="hidden" name="en_quan_huyen" id="en_quan_huyen"  value="<?php echo $this->propertyDataen['quan_huyen'] ?>" />
	<input type="hidden" name="en_tien_ich" id="en_tien_ich"  value="<?php echo $this->propertyDataen['tien_ich'] ?>" />
	<input type="hidden" name="en_huong" id="en_huong"  value="<?php echo $this->propertyDataen['huong'] ?>" />
	<input type="hidden" name="en_vi_tri" id="en_vi_tri"  value=" " />
	<input type="hidden" name="en_nha_moi_gioi" id="en_nha_moi_gioi"  value=" " />
	
	<!-- them du an text value -->
	
		<input type="hidden" name="id" id="idobj" value="<?php echo $this->propertyData['id'] ?>" />
		<input type='hidden'  id='path' value='<?php echo JURI::root() ?>'/>
<?php
}
?>


</form>
<link rel="stylesheet" href="<?php echo JURI::root()?>templates/mlbds/css/templates.css" type="text/css" /> 
	<!-- <link rel="stylesheet" href="<?php echo JURI::root()?>templates/WebVHL/css/templates.css" type="text/css" /> -->
	
	<?php if ( empty( $_GET['debug'] ) ) { ?>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ham-tien-ich.js"></script>
	
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/utils.js"></script>

	<?php }?>
<!-- add javascript & init script -->
<?php if ( $this->status == 0 ) {?>

<script language="javascript">
// init map <?php /*?>
showMap( 'map_canvas', <?php echo $this->propertyData['kinh_do'] . "," .$this->propertyData['vi_do'] . ",'" . $this->propertyData['id'] . "',16" ?>);<? */ ?>
</script>
<?php }
else if($this->status == 1)
{
?>
<!--  load script admin -->
<?php if ( empty( $_GET['debug'] ) ) { ?>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<script src="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/jquery.searchabledropdown-1.0.8.src.js"></script>
<?php }?>
<script src="<?php echo JURI::root()?>templates/mlbds/js/placeholder.js"></script>
<script>
	jQuery(function(){
		jQuery("#town_id").change(function(){
			var town  = jQuery("select#town_id option:selected").text();
			getCoordinates(town);
		});
		jQuery("#area_id").change(function(){
			var town  = jQuery("select#town_id option:selected").text();
			var area  = jQuery("select#area_id option:selected").text();
			getCoordinates(area+", " +town);
		});
		 if(jQuery.browser.msie){
			jQuery('#noi_that').placeHolder(); 
			jQuery('[name="gia"]').placeHolder(); 
		 }else{
			 jQuery("#du_an_id").searchable();
		 }
		var valt = jQuery("#du_an_id :selected").html();
		jQuery("#du_an_text_value").val(valt);
		jQuery("#du_an_id").change(function(){
			jQuery("#du_an_text_value").val(jQuery("#du_an_id :selected").html());
		});
		var unit = jQuery("select#kind_id option:selected").val();
		/*layDanhSachDienTich('price_area_unit',unit,'vi-VN','<?php echo JURI::base();?>','price_area_unit');*/
	});
	function changval(changval){
		var add = changval.value;
		var town  = jQuery("select#town_id option:selected").text();
		var area  = jQuery("select#area_id option:selected").text();
		getCoordinates(add+", "+area+ ", " +town);
	}
	var map, geocoder, marker, infowindow; 	   
	function getLatLng() { 
		// Creating a new map 
		var options = {   
		  zoom: 15,   
		  center: new google.maps.LatLng(106.70015,10.777746),   
		  mapTypeId: google.maps.MapTypeId.ROADMAP,
		  panControl:true,
		  zoomControl: true   
		};   		
		map = new google.maps.Map(document.getElementById('map_canvas'), options);	
	} 
	 
	  // Create a function the will return the coordinates for the address 
	function getCoordinates(address) { 
		// Check to see if we already have a geocoded object. If not we create one 
		if(!geocoder) { 
		  geocoder = new google.maps.Geocoder();  
		} 
	 
		// Creating a GeocoderRequest object 
		var geocoderRequest = { 
		  address: address 
		} 	 
		// Making the Geocode request
		geocoder.geocode(geocoderRequest, function(results, status) { 		   
		  // Check if status is OK before proceeding 
		    if (status == google.maps.GeocoderStatus.OK) { 	 
				// Center the map on the returned location 
				map.setCenter(results[0].geometry.location); 	 
				// Check to see if we've already got a Marker object 
				if (!marker) { 
				  // Creating a new marker and adding it to the map 
				  marker = new google.maps.Marker({ 
					map: map 
				  }); 
				} 
				 
				// Setting the position of the marker to the returned location 
				marker.setPosition(results[0].geometry.location); 
		 
				// Check to see if we've already got an InfoWindow object 
				if (!infowindow) { 
				  // Creating a new InfoWindow 
				  infowindow = new google.maps.InfoWindow(); 
				} 		 
				// Creating the content of the InfoWindow to the address 
				// and the returned position 
				document.getElementById('map_lat').value= results[0].geometry.location.lat();
				document.getElementById('map_lng').value= results[0].geometry.location.lng(); 		 
				// Adding the content to the InfoWindow 	 
				// Opening the InfoWindow 
				infowindow.open(map, marker); 
	 
			}  
		   
		}); 
	}
	function formatThousandPoint(ele, value){
		var tmp1='';
		for (i=0;i<=value.length-1;i++) if ((value[i]!=',')&&(value[i]!=' ')) tmp1+=value[i];
		if (tmp1.length>3){
			var tmp=''; var sub=''; var dem=0;		
			for (i=tmp1.length-1;i>=0;i--){
				tmp=tmp1[i]+tmp; dem++;
				if (dem%3==0){dem=0; (i==0)?sub=tmp+sub:sub= ','+tmp+sub; tmp='';}
			}			
			ele.value=tmp1.substr(0,tmp1.length%3)+sub;
		}
	}
</script>

<?php }
else {
?>
<!--  load script admin -->
<?php if ( empty( $_GET['debug'] ) ) { ?>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<?php }?>
<script>
	jQuery(function(){
		jQuery("#town_id").change(function(){
			var town  = jQuery("select#town_id option:selected").text();
			getCoordinates(town);
		});
		jQuery("#area_id").change(function(){
			var town  = jQuery("select#town_id option:selected").text();
			var area  = jQuery("select#area_id option:selected").text();
			getCoordinates(area+", " +town);
		});
		var valt = jQuery("#du_an_id :selected").html();
		jQuery("#du_an_text_value").val(valt);
		jQuery("#du_an_id").change(function(){
			jQuery("#du_an_text_value").val(jQuery("#du_an_id :selected").html());
		});
		var unit = jQuery("select#kind_id option:selected").val();
		layDanhSachDienTich('price_area_unit',unit,'vi-VN','<?php echo JURI::base();?>','price_area_unit');
	});
	function changval(changval){
		var add = changval.value;
		var town  = $("select#town_id option:selected").text();
		var area  = $("select#area_id option:selected").text();
		getCoordinates(add+", "+area+ ", " +town);
	}
	var map, geocoder, marker, infowindow; 	   
	function getLatLng() { 
		// Creating a new map 
		var options = {   
		  zoom: 15,   
		  center: new google.maps.LatLng(106.70015,10.777746),   
		  mapTypeId: google.maps.MapTypeId.ROADMAP,
		  panControl:true,
		  zoomControl: true   
		};   		
		map = new google.maps.Map(document.getElementById('map_canvas'), options);	
	} 
	 
	  // Create a function the will return the coordinates for the address 
	function getCoordinates(address) { 
		// Check to see if we already have a geocoded object. If not we create one 
		if(!geocoder) { 
		  geocoder = new google.maps.Geocoder();  
		} 
	 
		// Creating a GeocoderRequest object 
		var geocoderRequest = { 
		  address: address 
		} 	 
		// Making the Geocode request
		geocoder.geocode(geocoderRequest, function(results, status) { 		   
		  // Check if status is OK before proceeding 
		    if (status == google.maps.GeocoderStatus.OK) { 	 
				// Center the map on the returned location 
				map.setCenter(results[0].geometry.location); 	 
				// Check to see if we've already got a Marker object 
				if (!marker) { 
				  // Creating a new marker and adding it to the map 
				  marker = new google.maps.Marker({ 
					map: map 
				  }); 
				} 
				 
				// Setting the position of the marker to the returned location 
				marker.setPosition(results[0].geometry.location); 
		 
				// Check to see if we've already got an InfoWindow object 
				if (!infowindow) { 
				  // Creating a new InfoWindow 
				  infowindow = new google.maps.InfoWindow(); 
				} 		 
				// Creating the content of the InfoWindow to the address 
				// and the returned position 
				document.getElementById('map_lat').value= results[0].geometry.location.lat();
				document.getElementById('map_lng').value= results[0].geometry.location.lng(); 		 
				// Adding the content to the InfoWindow 	 
				// Opening the InfoWindow 
				infowindow.open(map, marker); 
	 
			}  
		   
		}); 
	}
	function formatThousandPoint(ele, value){
		var tmp1='';
		for (i=0;i<=value.length-1;i++) if ((value[i]!=',')&&(value[i]!=' ')) tmp1+=value[i];
		if (tmp1.length>3){
			var tmp=''; var sub=''; var dem=0;		
			for (i=tmp1.length-1;i>=0;i--){
				tmp=tmp1[i]+tmp; dem++;
				if (dem%3==0){dem=0; (i==0)?sub=tmp+sub:sub= ','+tmp+sub; tmp='';}
			}			
			ele.value=tmp1.substr(0,tmp1.length%3)+sub;
		}
	}
</script>

<?php }
?>
<script language="javascript">
//window.onload=initalizetab("tabheader")
initalizetab("tabheader"); 
initalizetab("tabpoppu"); 
initalizetab("tabpoppu2");
//initTab('box', 'tab_image', 'tab_map');
</script>
<?php 
if ( $this->status == 2 )
{
	//echo "</div>";
	
}
?>
