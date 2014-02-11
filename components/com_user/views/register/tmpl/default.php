<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
function clearS(){
	document.getElementById("username").value='';
	document.getElementById("password").value='';
	document.getElementById("password2").value='';
	document.getElementById("email").value='';
	document.getElementById("phone").value='';
	document.getElementById("name").value='';
	document.getElementById("address").value='';
	document.getElementById("msgErrUsername").innerHTML	='';
	document.getElementById("msgErrName").innerHTML	='';
	document.getElementById("msgPassword").innerHTML	='';
	document.getElementById("msgErrEmail").innerHTML	='';
	document.getElementById("msgErrPhone").innerHTML	='';
	
	
}
</script>

<?php
	if(isset($this->message)){
		$this->display('message');
	}
?>
<div class='register'>
	<div class='register-l'>
		<form action="<?php echo JRoute::_( 'index.php?option=com_user&task=register_save&Itemid=19' ); ?>" method="post" name="josForm" id="josForm" onsubmit="return valid_regisF(this);">
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">Đăng ký thành viên</div>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
<tr>
	<td height="30" align='right'>
		<label id="emailmsg" for="email">
			<?php echo JText::_( 'Email' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="text" id="email" name="email" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['email'];?>"  maxlength="100"  onBlur="KiemTraEmail(this.value,'msgErrEmail','<?php echo JURI::base() ?>')"/><div id="msgErrEmail" class="errouser"><input type="hidden" id="emailFail" value="0"  /></div>
	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="pwmsg" for="password">
			<?php echo JText::_( 'Password' ); ?>: <span class='red'>*</span> 
		</label>
	</td>
  	<td>
  		<input  type="password" id="password" name="password" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['password'];?>" onchange='document.getElementById("msgPassword").innerHTML=""' /><div id="msgPassword" class="errouser"></div>
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
  		<input type="text" name="name" id="name" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['name']; else echo $this->escape($this->user->get( 'name' ));?>" onchange='document.getElementById("msgErrName").innerHTML=""'  maxlength="50" /><div id="msgErrName" class="errouser"></div>
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
		<input type="text" id="phone" name="phone" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phone'];?>" maxlength="100" onchange='document.getElementById("msgErrPhone").innerHTML=""' /><div id="msgErrPhone" class="errouser"></div>
	</td>
</tr>
<tr>
	<td height="30" align='right'>
	
	</td>
	<td style="padding-left: 30px;">
		<span class="clear check" style='margin-bottom:5px;'>
						<input type="checkbox" id="speak_english" name="speak_english"> 
							Can you speak English?
		</span>
		<span class="clear check" style="margin-bottom:5px;">
					<input type="checkbox" id="chinh_chu" name="chinh_chu" > 
					Bạn là môi giới?
					
				<script type="text/javascript">
					jQuery(function(){
						jQuery("#quan_huyen_id").change(function(){
							setValQH();
						});
						jQuery('#chinh_chu:checkbox').click(function()
						{
						    if (jQuery(this).is(':checked'))
						    {
						        jQuery("#khu_vuc_quan_ly").slideDown();
						    }
						    else
						    {
						    	jQuery("#khu_vuc_quan_ly").slideUp();
						    }
						});
					});	
				</script>
				<div id="khu_vuc_quan_ly" style="height: 200px;display: none">
				<fieldset style="border: 1px solid #96A6C5;border-radius:5px;padding:4px;padding:10px;width:230px;margin-left: -11px;margin-top:10px">
				    <legend>Thông tin khu vực</legend>
				    Tỉnh thành:
				    <?php 
				    function getTinhThanh(){
				    	$db = JFactory::getDBO();
				    	$db->setQuery("SELECT * FROM `iland4_tinh_thanh` order by ordering");
				    	$db->query();
				    	$results = $db->loadObjectList();
				    	return $results;				    	
				    }
				    $tinhthanh = getTinhThanh();
				    
				    ?>
				    <select name="tinh_thanh_id" id="tinh_thanh_id" class="input-s" size="1" onchange="layseachquanhuyentk('quan_huyen_id',this.value,'vi-VN','<?php echo JURI::root();?>', 'quan_huyen_search', 'input-s')">
				    <?php 
				    foreach($tinhthanh as $item){
				    	?>
				    	<option value="<?php echo $item->id?>" ><?php echo $item->ten?></option>
				    	<?php 
				    }
				    ?>				    	
				    </select>
				    
				    Quận huyện:
				    <?php 
				    function getQuanHuyenKV($id){
				    	$db = JFactory::getDBO();
				    	$db->setQuery("SELECT * FROM `iland4_quan_huyen` where tinh_thanh_id = $id order by ordering");
				    	$db->query();
				    	$results = $db->loadObjectList();
				    	return $results;				    	
				    }
				    $quanhuyen = getQuanHuyenKV('2');
				    
				    ?>
				    <input type="hidden" id="quanhuyen_id" name="quanhuyen_id"  value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['quanhuyen_id'];?>" />
				    <span  class='clear' id="quan_huyen_search">
				    <select name="quan_huyen_id" id="quan_huyen_id" class="input-s" size="1" onchange="setValQH()">
				    <?php 
				    foreach($quanhuyen as $item){
				    	?>
				    	<option value="<?php echo $item->id?>" ><?php echo $item->ten?></option>
				    	<?php 
				    }
				    ?>				    	
				    </select>
				    </span>
				    
				    
				    Loại hình chuyên trách:
				    <?php 
				    function getLoaiBDS(){
				    	$db = JFactory::getDBO();
				    	$db->setQuery("SELECT * FROM `iland4_loai_bds_vi` order by ordering");
				    	$db->query();
				    	$results = $db->loadObjectList();
				    	return $results;				    	
				    }
				    $bds = getLoaiBDS();
				    
				    ?>
				    <input type="hidden" id="loaibds_id" name="loaibds_id"  value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['loaibds_id'];?>" />
				    <select name="loai_bds_id" id="loai_bds_id" class="input-s" size="1" onchange="setValLBDS()">
				    <?php 
				    foreach($bds as $item){
				    	?>
				    	<option value="<?php echo $item->id?>" ><?php echo $item->ten?></option>
				    	<?php 
				    }
				    ?>				    	
				    </select>
				    
				    <link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery-ui.css" type="text/css" media="screen">
					<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery.multiselect.css" type="text/css" media="screen">
					<script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>
					<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery-ui.min.js"></script>
					<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery.multiselect.js"></script> 
					<script type="text/javascript">
					multi();
					function getData(){
						setValQH();
						setValLBDS();
					}
					function multi(){
						$("#quan_huyen_id").multiselect({
							selectedText: "# trong # quận đã chọn"
						});
						$("#loai_bds_id").multiselect({
							selectedText: "# trong # loại hình đã chọn"
						});
					}
					function setValQH(){
						var array_of_checked_values = $("#quan_huyen_id").multiselect("getChecked").map(function(){
							   return this.value;	
						}).get();
						$("#quanhuyen_id").val(array_of_checked_values);
					}
					function setValLBDS(){
						var array_of_checked_value = $("#loai_bds_id").multiselect("getChecked").map(function(){
							   return this.value;	
						}).get();
						$("#loaibds_id").val(array_of_checked_value);
					}
					function layseachquanhuyentk(area_name,town_id,lang,path,targetId )
					{
						if(lang==null){
							lang='vi-VN';
						}	
						
						var address=path+"quanhuyentv.php?area_name="+area_name+"&town_id="+town_id+"&lang="+lang+"&quan_huyen_id=0";
						$('#quan_huyen_search').load(address,function(){
							$("#quan_huyen_id").multiselect();
						});
						
					}
					/*$(function(){
						$('[name="multiselect_quan_huyen_id"]').change(function(){
							alert('change multi');
						});
					})*/
					</script>
				    
				    <span class="clear check">
						<input type="checkbox" id="nhan_mail" name="nhan_mail"> 
						Đăng ký nhận báo cáo hàng tháng
					</span> 
			   </fieldset>
					
					
				</div>
					
		</span>
	</td>
</tr>
<tr>
<td height="30" align='right' valign='top'>
	 Mã an toàn: 
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
		josForm.osolCatchaTxt.style.borderColor="#FF0000";
		josForm.osolCatchaTxt.focus();
		document.getElementById("osolCatchaTxt0").setAttribute("onclick","document.getElementById('msgErrCapt').innerHTML=''");
	</script>
<?php }

?>
</td>
</tr>

<td height="30" align='right'>
</td>
	<td style="padding-left: 27px;">
		<?php echo JText::_( 'REGISTER_REQUIRED' ); ?>
		
		
	</td>
</tr>
</table>
<div style="padding-left: 137px;">
	<input class='btn-search' type="submit" id="dktv" name="submit" value="<?php echo JText::_('Register'); ?>" onclick="getData()" />
	<input class='btn-search' type="reset" onclick="clearS()" value="<?php unset($_SESSION['tmp']);echo JText::_('Nhập lại'); ?>" />

</div>	
	<?php echo JHTML::_( 'form.token' ); ?>

</form>
	</div>
	<div class='register-r'>
		<div class='register-mes'>
			<div class="componentheading">Lợi ích thành viên</div>
			<div class='register-mes-ct1'>
				<?php echo $this->quyenloi?>
			
			</div>
		</div>
		<?php /*?>
		<div class='register-login'>
				<div class="componentheading">Đăng nhập</div>
		<form action="index.php" method="post" name="login" id="login" class='login_mlbds1 ' >
		<div class='clear register-mes-ct'>
			<table>
				<tr>
						<td height="30" align="right">
							<label id="usernamemsg" for="username">
							Tên đăng nhập:
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
						<input type="password" id="password" name="passwd" size="30" value="" >
						</td>
				</tr>
				<tr>
					<td>
					</td>
					<td style="padding-left: 29px;text-decoration: underline;">
						<span class='clear'>
						<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' ); ?>">Quên mật khẩu</a> / <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind&Itemid=19' ); ?>">Tên đăng nhập</a>
						</span>
					</td>
				</tr>
			</table>
			<div style="padding-left: 118px;"> 
				<input class="btn-search" type="submit" name="submit" value="Đăng nhập" style="margin-left:19px;">
			</div>
		</div>
		<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo JURI::base(); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	</div>
	<?php */ ?>
	</div>
	<div class='clear'>
	</div>
</div>



