<?php
/**
* @package Author
* @author thongdd
* @website thietkewebbatdongsan.com
* @email thongdd@i-land.vn
* @copyright 2012
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
$document =& JFactory::getDocument();
$document->setTitle('Tạo yêu cầu BĐS không cần tài khoản');	
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
$userid	= $user->get('id');
if($userid!=0){
	$document->setTitle('Quản lý yêu cầu bất động sản');
}
if($_GET['layout']=='yeucau'){
	$loai_giao_dich = $this->loai_giao_dich; 
	$loai_bds	= $this->loai_bds;
	$tinh_thanh_ycbds = $this->tinh_thanh_ycbds;
	$quan_huyen_ycbds = $this->quan_huyen;
	$duAnHTML = $this->duAnHTML;
	$huongHTML = $this->huongHTML;
	$tienIchHTML = $this->tienIchHTML;
	
	if(isset($_SESSION['tmp']) && $_SESSION['tmp']['sess_tmp'] == 1){
		$data = $_SESSION['tmp'];
		$dien_tich_su_dung_tu		=	$data['dien_tich_su_dung_tu'];
		$dien_tich_su_dung_den		=	$data['dien_tich_su_dung_den'];
		$dien_tich_san_tu			=	$data['dien_tich_san_tu'];
		$dien_tich_san_den			=	$data['dien_tich_san_den'];
		$phong_ngu_tu 				= 	$data['phong_ngu_tu'];
		$phong_ngu_den				=	$data['phong_ngu_den'];
		$phong_tam_tu				=	$data['phong_tam_tu'];
		$phong_tam_den				= 	$data['phong_tam_den'];
		$muc_gia_tu					=	$data['muc_gia_tu'];
		$muc_gia_den				=	$data['muc_gia_den'];
		$so_tang_tu					=	$data['so_tang_tu'];
		$so_tang_den				=	$data['so_tang_den'];
		$loai_gia_nc				=	$data['loai_gia_nc'];
		$duong_pho					=	$data['duong_pho'];
		$chinh_chu					=	str_replace('on', '1',$data['chinh_chu']);
		$speak_english				=	str_replace('on', '1',$data['speak_english']);
		$email						=	$data['email'];
		$nhan_mail					=	str_replace('on', '1',$data['nhan_mail']);
	}else{
		$data = $this->data;
		$dien_tich_su_dung_tu		=	$data->dien_tich_su_dung_tu;
		$dien_tich_su_dung_den		=	$data->dien_tich_su_dung_den;
		$dien_tich_san_tu			=	$data->dien_tich_san_tu;
		$dien_tich_san_den			=	$data->dien_tich_san_den;
		$phong_ngu_tu 				= 	$data->phong_ngu_tu;
		$phong_ngu_den				=	$data->phong_ngu_den;
		$phong_tam_tu				=	$data->phong_tam_tu;
		$phong_tam_den				= 	$data->phong_tam_den;
		$muc_gia_tu					=	$data->muc_gia_tu;
		$muc_gia_den				=	$data->muc_gia_den;
		$so_tang_tu					=	$data->so_tang_tu;
		$so_tang_den				=	$data->so_tang_den;
		$loai_gia_nc				=	$data->loai_gia_nc;
		$duong_pho					=	$data->duong_pho;
		$chinh_chu					=	$data->chinh_chu;
		$speak_english				=	$data->speak_english;
		$email						=	$data->email;
		$nhan_mail					=	$data->nhan_mail;
		$tinh_trang_noi_that        =   $data->tinh_trang_noi_that;
	}
}else{
	if(isset($_SESSION['tmp'])){
		$data = $_SESSION['tmp'];
		$quan_huyen_ycbds = quanhuyenTYC( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
											'title'=>'Bất kỳ','index'=>$data['quanhuyen'], 'is_town'=>'',
											'onchang'=>$onchangeQuanHuyen1));
		
		$dien_tich_su_dung_tu		=	$data['dien_tich_su_dung_tu'];
		$dien_tich_su_dung_den		=	$data['dien_tich_su_dung_den'];
		$dien_tich_san_tu			=	$data['dien_tich_san_tu'];
		$dien_tich_san_den			=	$data['dien_tich_san_den'];
		$phong_ngu_tu 				= 	$data['phong_ngu_tu'];
		$phong_ngu_den				=	$data['phong_ngu_den'];
		$phong_tam_tu				=	$data['phong_tam_tu'];
		$phong_tam_den				= 	$data['phong_tam_den'];
		$muc_gia_tu					=	$data['muc_gia_tu'];
		$muc_gia_den				=	$data['muc_gia_den'];
		$so_tang_tu					=	$data['so_tang_tu'];
		$so_tang_den				=	$data['so_tang_den'];
		$loai_gia_nc				=	$data['loai_gia_nc'];
		$duong_pho					=	$data['duong_pho'];
		$chinh_chu					=	str_replace('on', '1',$data['chinh_chu']);
		$speak_english				=	str_replace('on', '1',$data['speak_english']);
		$email						=	$data['email'];
		$nhan_mail					=	str_replace('on', '1',$data['nhan_mail']);
	}
}
?>
<!-- dang ki và tao yeu cau BDS-->
<form action="index.php?option=com_u_re&task=saveYeuCauBDS&Itemid=<?php echo $_GET['Itemid']?>" method="post" name="fyeucaubds">
<?php if($userid==0){?>
<?php if($_GET['Itemid']=='245'){
$document->setTitle('Đăng ký thành viên & Tạo yêu cầu BĐS');	
?>
<div class="componentheading">
Đăng ký thành viên & Tạo yêu cầu BĐS
</div>
<!-- dang ki và tao yeu cau BDS-->
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
<tr>
	<td height="30" align='right'>
		<label id="emailmsg" for="email">Email đăng nhập: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="text" id="email" name="email" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['email'];?>"  maxlength="100"  onBlur="KiemTraEmail(this.value,'msgErrEmail','<?php echo JURI::base() ?>')"/><div id="msgErrEmail" class="errouser"><input type="hidden" name="emailFail" id="emailFail" value="0"  /></div>
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
  		<input type="text" name="name" id="name" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['name'];?>" onclick='document.getElementById("msgErrName").innerHTML=""'   maxlength="50" /><div id="msgErrName" class="errouser"></div>
  	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="addressmsg" for="address">
			<?php echo JText::_('Address'); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="address" name="address" size="30" value="" maxlength="255" />
	</td>
</tr>
<tr>
	<td height="30" align='right'>
		<label id="phonemsg" for="phone">
			<?php echo JText::_('Phone'); ?>: <span class='red'>*</span> 
		</label>
	</td>
	<td>
		<input type="text" id="phone" name="phone" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phone'];?>" maxlength="100" /><div id="msgErrPhone" class="errouser"></div>
	</td>
</tr>
<tr>
	<td height="30" align='right'>
	
	</td>
	<td style="padding-left: 30px;">
		<span class="clear check" style='margin-bottom:5px;'>
						<input type="checkbox" name="speak_english" id="speak_english" <?php if (isset($_SESSION['tmp']) && $_SESSION['tmp']['speak_english'] == 'on' ) echo 'checked="checked"';else echo '';?> > 
							Can you speak English?
		</span>
		<span class="clear check" style="margin-bottom:5px;">
					<input type="checkbox" name="chinh_chu" id="chinh_chu" <?php if (isset($_SESSION['tmp']) && $_SESSION['tmp']['chinh_chu'] == 'on' ) echo 'checked="checked"';else echo '';?>>  
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
		fyeucaubds.osolCatchaTxt.style.borderColor="#FF0000";
		fyeucaubds.osolCatchaTxt.focus();
		document.getElementsByName("osolCatchaTxt").setAttribute("onclick","document.getElementById('msgErrCapt').innerHTML=''");
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
<br/>
<?php }?>
<?php if($_GET['Itemid']=='246'){
$document->setTitle('Đăng nhập & Tạo yêu cầu BĐS');	
?>
<div class="componentheading">Đăng nhập & Tạo yêu cầu BĐS</div>
		
		<div class='clear register-mes-ct'>
			<table>
				<tr>
						<td height="30" align="right">
							<label id="usernamemsg" for="username">
							Email đăng nhập:
							</label>
						</td>
						<td>
							<input type="text" id="username" name="username" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['username'];?>" maxlength="25">
							<div id="msgErrUsername"><input type="hidden" id="userFail" value="0"></div>
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
<?php }?>
<?php }?>
<!--
<div class="componentheading">
Tạo yêu cầu BĐS
</div>-->
<div class='taoyeucau'>
<h6 class="mod-title"><span>
Tạo yêu cầu BĐS</span>
</h6>
<?php if($_GET['msg']=='success'){?>
<div id="thongbao">Cám ơn bạn đã tạo yêu cầu bđs ở www.mangluoibds.vn. Chúng tôi sẽ rà soát hệ thống mỗi ngày và gửi cho bạn thông tin theo yêu cầu ngay khi tìm được bđs phù hợp.</div>
<?php }
	if ($_GET['msg']=='fail'&& !isset($_SESSION['tmp'])){?>
	<div id="thongbao">Bạn đã có một yêu cầu bất động sản trước đó<br /> Bạn hãy thay đổi yêu cầu dưới đây nếu muốn </div>
<?php }?>

	<div class="tyc">
		<ul>
			<li>
				<span class='tl-tyc'>
				LOẠI GIAO DỊCH
				</span>
				<span>
					<?php echo $loai_giao_dich?>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					LOẠI BẤT ĐỘNG SẢN
				</span>
				<span>
					<?php echo $loai_bds?>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					TỈNH THÀNH
				</span>
				<span>
					<?php echo $tinh_thanh_ycbds?>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					QUẬN HUYỆN
				</span>
				<span>
					<span class='clear' id="quan_huyen_search">
						<?php echo $quan_huyen_ycbds;?>
					</span>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					ĐƯỜNG PHỐ
				</span>
				<span>
					<input id="duong_pho" name="duong_pho" type="text" value="<?php if(!empty($duong_pho)) echo $duong_pho?>" class="input-tyc">
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					THUỘC DỰ ÁN
				</span>
				<span id="duanie-taoyeucau">
					<?php echo $duAnHTML?>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					DTSD (m <sup>2</sup>)
				</span>
				<span>
					<input id="dien_tich_su_dung_tu" name="dien_tich_su_dung_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $dien_tich_su_dung_tu ) ) {
								echo $dien_tich_su_dung_tu; 
							} else { echo 'Từ'; }
							?>" 
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="dien_tich_su_dung_den" name="dien_tich_su_dung_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $dien_tich_su_dung_den ) ) {
								echo $dien_tich_su_dung_den; 
							} else { echo 'Đến'; }
							?>"onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					PHÒNG NGỦ
				</span>
				<span>
					<input id="phong_ngu_tu" name="phong_ngu_tu" type="text" class="input-s2" 
							value="<?php if ( !empty($phong_ngu_tu) ) {
								echo $phong_ngu_tu; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="phong_ngu_den" name="phong_ngu_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $phong_ngu_den ) ) {
								echo $phong_ngu_den; 
							} else { echo 'Đến'; }
							?>"onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					PHÒNG TẮM
				</span>
				<span>
					<input id="phong_tam_tu" name="phong_tam_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $phong_tam_tu) ) {
								echo $phong_tam_tu; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="phong_tam_den" name="phong_tam_den" type="text" class="input-s2" 
							value="<?php if ( !empty($phong_tam_den) ) {
								echo $phong_tam_den; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
				</span>
			</li>
			<li style="width: 46%;" class='mucgiataoyeucau'>
				<span class="tl-tyc">
				Mức giá
				</span>
				<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 244px;'>
							<input id="muc_gia_tu" name="muc_gia_tu" style='width:105px' type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $muc_gia_tu) ) {
								echo $muc_gia_tu; 
							} else { echo 'Từ'; }
							?>"
								onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )">
							<input id="muc_gia_den" style='width:105px' name="muc_gia_den" type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $muc_gia_den ) ) {
								echo $muc_gia_den; 
							} else { echo 'Đến'; }
							?>"onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )">
						</div>
						<div style='float: left;padding: 0;height: 20px;width: 93px;font-size: 12px;line-height: 17px;margin-top: -6px;'>
							<input id="loai_gia_nguyen_can_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $loai_gia_nc) || $loai_gia_nc != 'm2' ) ) echo 'checked';?> />
							<label id="nguyen_can_text_nc">nguyên căn</label><br/>
							<input id="loai_gia_m2_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $loai_gia_nc ) && $loai_gia_nc == 'm2' ) ) echo 'checked';?> />
							<span id="m2_text_nc">m<sup>2</sup></span>
						</div>
						
					</span>
			</li>
			<li style="margin-top:13px;width:122px;margin-bottom:0;padding-left: 8px;">
					<span class='clear check'>
						<label><input id="speak_english" name="speak_english"
							<?php if ($speak_english == 1 ) echo 'checked="checked"';?> 
							type="checkbox" /> 
						</label>
							<label>Speak English</label>
					</span>
					<span class='clear check'>
					<input id="chinh_chu" name="chinh_chu"
						<?php if ( $chinh_chu == 1 ) echo 'checked="checked"';?> 
						type="checkbox"/> 
						Chính chủ
					</span>
			</li>
			<li>
				<span class='tl-tyc'>
					DIỆN TÍCH SÀN (m <sup>2</sup>)
				</span>
				<span>
					<input id="dien_tich_san_tu" name="dien_tich_san_tu" type="text" class="input-s2" 
						value="<?php if ( !empty( $dien_tich_san_tu ) ) {
							echo $dien_tich_san_tu; 
						} else { echo 'Từ'; }
						?>"
						onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
					<input id="dien_tich_san_den" name="dien_tich_san_den" type="text" class="input-s2" 
						value="<?php if ( !empty( $dien_tich_san_den ) ) {
							echo $dien_tich_san_den; 
						} else { echo 'Đến'; }
						?>"
						onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					SỐ TẦNG LẦU
				</span>
				<span>
					<input id="so_tang_tu" name="so_tang_tu" type="text" class="input-s2"
						value="<?php if ( !empty( $so_tang_tu ) ) {
							echo $so_tang_tu; 
						} else { echo 'Từ'; }
						?>"
						onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
					<input id="so_tang_den" name="so_tang_den" type="text" class="input-s2" 
						value="<?php if ( !empty( $so_tang_den ) ) {
							echo $so_tang_den; 
						} else { echo 'Đến'; }
						?>"
						onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
					HƯỚNG
				</span>
				<span>
					<?php echo $huongHTML;?>
				</span>
			</li>
			<li>
				<span class='tl-tyc'>
				TÌNH TRẠNG NỘI THẤT
				</span>
				<span>
				<?php 
				// xu ly truong hop lay tinh trang noi that tu db
				$ttntbkSelected = '';
				$ttntcoSelected = '';
				$ttntkhongSelected = '';
				if ( !isset( $_SESSION['tmp'] ) )
				{
					if ( isset ( $tinh_trang_noi_that ) )
					{
						if ( $tinh_trang_noi_that == -1 )
						{
							$ttntbkSelected = 'selected';	
						}
						else if ( $tinh_trang_noi_that == 0 )
						{
							$ttntkhongSelected = 'selected';
						}
						else
						{
							$ttntcoSelected = 'selected';
						}
					} 
				}
				else
				{
					if ( $_SESSION['tmp']['tinh_trang_noi_that'] == 1 )
					{
						$ttntcoSelected = 'selected';
					}
					else if ( $_SESSION['tmp']['tinh_trang_noi_that'] == 0 )
					{
						$ttntkhongSelected = 'selected';
					}
				}
				
				?>
					<select id="tinh_trang_noi_that" name="tinh_trang_noi_that" class='sel-tyc'>
							<option value="-1" <?php echo $ttntbkSelected?>>Bất kỳ</option>
							<option value="1" <?php echo $ttntcoSelected?>>Có</option>
							<option value="0" <?php echo $ttntkhongSelected?>>Không</option>
					</select>
				</span>
			</li>
			<li class='clear' style="width:100%;margin-right:0;height:90px;">
				<span class='tl-tyc' style='margin-bottom:8px;'>
					THÔNG TIN THÊM
				</span>
				<span class='clear'>
					<?php echo $tienIchHTML?>
				</span>
				<span>
					
				</span>
			</li>
		</ul>
	</div>
	<div class='clear' style="text-align: center;border-top: 1px solid #96A6C5;padding-top:10px" >
	<?php if($_GET['Itemid']=='247'){?>
	<div class='clear' style="height: 80px">
	<div style="float: left;width: 30%">
	 Mã an toàn 
	</div>
	<div style="float: left;width: 70%;text-align: left;">
	
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
			fyeucaubds.osolCatchaTxt.style.borderColor="#FF0000";
			fyeucaubds.osolCatchaTxt.focus();
			document.getElementsByName("osolCatchaTxt").setAttribute("onclick","document.getElementById('msgErrCapt').innerHTML=''");
		</script>
	<?php 
	}
	?>
	</div><br />
	</div>
	<?php }?>
	<?php if($_GET['Itemid']=='247')
	{?>
	<div style="padding-top: 10px;border-top:1px solid #96A6C5">
	<div style="float: left;width: 30%">
	Email của bạn:<span class="red">*</span>
	</div>
	<div style="float: left;width: 67%;text-align: left;margin-left:19px">
	<input type="text" id="email" name="email" class="input-tyc" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['email'];?>" style="width: 400px!important;margin-left:0px" maxlength="100"  onBlur="KiemTraEmail(this.value,'msgErrEmail','<?php echo JURI::base() ?>')"/><div id="msgErrEmail" class="errouser"><input type="hidden" name="emailFail" id="emailFail" value="0"  /></div>
	<br />
	</div>
	</div>
	
	<div>
		<div style="float: left;width: 30%">
		Tên:
		</div>
		<div style="float: left;width: 67%;text-align: left;margin-left:19px;margin-bottom:20px">
			<input type="text" id="name" name="name" class="input-tyc" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['name'];?>" style="width: 400px!important;margin-left:0px" maxlength="100"/>
		<br />
		</div>
	</div>
	<div>
		<div style="float: left;width: 30%">
		Số điện thoại:
		</div>
		<div style="float: left;width: 67%;text-align: left;margin-left:19px">
			<input type="text" id="phone" name="phone" class="input-tyc" size="30" value="<?php if(isset($_SESSION['tmp'])) echo $_SESSION['tmp']['phone'];?>" style="width: 400px!important;margin-left:0px" maxlength="100"/>
		<br />
		</div>
	</div>
	<?php }?>
	<div class='clear' style='padding-top: 10px;'>
	<input id="nhan_mail" name="nhan_mail"
		<?php if (isset($nhan_mail) && $nhan_mail == 0 ) echo '';else echo 'checked="checked"';?> 
		type="checkbox" /> 
		</label>
		<label>Đăng ký nhận email theo yêu cầu bất động sản</label>
	
	</div>
	
<div class='clear' style="padding-top: 10px;">
<center>
	<input style='float:none'type="button" class="btn-search" value="Tạo yêu cầu" onclick="renderSQL()" />
	<input type="hidden" id="sql" name="sql" value="" />
	<input type="hidden" id="tienich" name="tienich" value="" />
	<input type="hidden" id="quanhuyen" name="quanhuyen" value="" />
	<input type="hidden" id="id" name="id" value="<?php echo $data->id; ?>" />
	<input type="hidden" id="item" name="item" value="<?php echo $_GET['Itemid'];?>" />
	<input type="hidden" name="customer" id="customer"  value="<?php echo $userid; ?>" />
	<?php if($_GET['Itemid']=='246'||$_GET['Itemid']=='242'){?>
	<input type="hidden" name="email" id="email"  value="<?php echo $user->get('email'); ?>" />
	<input type="hidden" name="phone" id="phone"  value="<?php echo $user->get('phone'); ?>" />
	<input type="hidden" name="name" id="name"  value="<?php echo $user->get('name'); ?>" />
	<?php }?>
	<input type="hidden" id="sess_tmp" name="sess_tmp" value="1" />

</center>
</div>
	</div>

</div>
</form>
<div id="coduantrongtaoyeucau" value="1" style="display: none"></div>
<script src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>
<script src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery.multiselect.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery-ui.min.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery.multiselect.js"></script>
<script src="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/jquery.searchabledropdown-1.0.8.src.js"></script>
<script type="text/javascript">
multi();
function multi(){
	$("#quan_huyen_id").multiselect();
}

function renderSQL(){
	var sql 	= 'SELECT * FROM iland4_bat_dong_san_vi WHERE ';
	var condition 	= '1'

	var loai_giao_dich = document.getElementById('loai_giao_dich_id').options[document.getElementById('loai_giao_dich_id').selectedIndex].value;

	condition 	+=	' AND loai_giao_dich_id = '+loai_giao_dich; 

	var loaibds = document.getElementById('loai_bds_id');
	var loai_bds_id = loaibds.options[loaibds.selectedIndex].value;
	if(loai_bds_id != 0){
		condition 	+=	' AND loai_bds_id = ' +loai_bds_id;
	}

	var tinhthanh = document.getElementById('tinh_thanh_id');
	var tinh_thanh_id = tinhthanh.options[tinhthanh.selectedIndex].value;
	if(tinh_thanh_id != 0){
		condition 	+=	' AND tinh_thanh_id = ' +tinh_thanh_id;
	}
	var quanhuyen = document.getElementById('quan_huyen_id');

	var quan_huyen_id = 0;
	if(quanhuyen.selectedIndex == -1 )
	{
		quan_huyen_id = 0;
	}
	else 
	{
		quan_huyen_id = quanhuyen.options[quanhuyen.selectedIndex].value;
	}
	if(quan_huyen_id!=0){
		var array_of_checked_values = $("#quan_huyen_id").multiselect("getChecked").map(function(){
			   return this.value;	
		}).get();
		condition 	+=	' AND quan_huyen_id in (' +array_of_checked_values + ')';
	}
	
	if ( jQuery.trim( $("#duong_pho").val() ) )
	{
		condition += " AND duong_pho LIKE " +"@%"+ $("#duong_pho").val()+"%@";
	}
	var duan = document.getElementById('du_an_id');
	var du_an_id = duan.options[duan.selectedIndex].value;
	if(du_an_id != 0){
		condition 	+=	' AND du_an_id = ' +du_an_id;
	}
		
	var dientich_tu = document.getElementById('dien_tich_su_dung_tu').value;
	var dientich_den = document.getElementById('dien_tich_su_dung_den').value;
	if(dientich_den > dientich_tu && dientich_tu != 'Từ' && dientich_den != 'Đến'){
		condition +=	' AND (dien_tich_su_dung BETWEEN '+dientich_tu + ' AND '+dientich_den+ ')'; 
	}
	
	var phongngu_tu = document.getElementById('phong_ngu_tu').value;
	var phongngu_den = document.getElementById('phong_ngu_den').value;
	if(phongngu_den > phongngu_tu && phongngu_tu != 'Từ' && phongngu_den != 'Đến'){
		condition +=	' AND (phong_ngu BETWEEN '+phongngu_tu + ' AND '+phongngu_den+ ')'; 
	} 
	
	var phongtam_tu = document.getElementById('phong_tam_tu').value;
	var phongtam_den = document.getElementById('phong_tam_den').value;
	if( phongtam_den > phongtam_tu && phongtam_tu != 'Từ' && phongtam_den != 'Đến'){
		condition +=	' AND (phong_tam BETWEEN '+phongtam_tu + ' AND '+phongtam_den+ ')'; 
	}
	
	var mucgia_tu = document.getElementById('muc_gia_tu').value;
	var mucgia_den = document.getElementById('muc_gia_den').value;
	if( mucgia_den > mucgia_tu && mucgia_tu != 'Từ' && mucgia_den != 'Đến'){

		if ( document.getElementById("loai_gia_nguyen_can_nc").checked )
		{
			loaiGiaValue = "gia_nguyen_can";
		}
		else 
		{
			loaiGiaValue = "gia_m2";
		}
		condition +=	' AND ('+loaiGiaValue+' BETWEEN '+mucgia_tu + ' AND '+mucgia_den+ ')'; 
	}

	if ( document.getElementById("speak_english").checked )
	{
		condition += ' AND speak_english = 1';
	}
	if ( document.getElementById("chinh_chu").checked )
	{
		condition += ' AND chinh_chu = 1';
	}

	var dientichsan_tu = document.getElementById('dien_tich_san_tu').value;
	var dientichsan_den = document.getElementById('dien_tich_san_den').value;
	if(dientich_den > dientichsan_den && dientichsan_tu != 'Từ' && dientichsan_den != 'Đến'){
		condition +=	' AND (dien_tich_khuon_vien BETWEEN '+dientichsan_tu + ' AND '+dientichsan_den+ ')'; 
	}
	
	var so_tang_tu = document.getElementById('so_tang_tu').value;
	var so_tang_den = document.getElementById('so_tang_den').value;
	if( so_tang_den > so_tang_tu && so_tang_tu != 'Từ' && so_tang_den != 'Đến'){
		condition +=	' AND (so_tang BETWEEN '+so_tang_tu + ' AND '+so_tang_den+ ')'; 
	}
	
	var huong = document.getElementById('huong_id');
	var huong_id = huong.options[huong.selectedIndex].value;
	if(huong_id != 0){
		condition 	+=	' AND huong_id = ' +huong_id;
	}

	var noithat = document.getElementById('tinh_trang_noi_that');
	var noithat_id = noithat.options[noithat.selectedIndex].value;
	if(noithat_id != -1){
		if(noithat_id == 1){
			condition 	+=	" AND (noi_that # @@ AND noi_that # @0@)";
		}
		if(noithat_id == 0){
			condition 	+=	" AND (noi_that = @@ OR noi_that = @0@)";
		}
	}

	var listThongTinThem = document.getElementsByName( "list_thong_tin_them" );
	var listThongTinThemValue="";var listThongTinThemValue1="";
	for(var i = 0; i < listThongTinThem.length; i++)
	{
		if( listThongTinThem[i].checked ) 
		{
			listThongTinThemValue1 += '1-' + listThongTinThem[i].value + ",";
			listThongTinThemValue = '1-' + listThongTinThem[i].value;
			condition += " AND tien_ich_id LIKE @%" + listThongTinThemValue + "%@";
		}
	}
	sql += condition+' AND hien_thi_ra_ngoai=1';
	if(array_of_checked_values == undefined) {
		array_of_checked_values = 0;
	}
	var itemid = <?php echo $_GET['Itemid'];?>;
	if(itemid == 245){
		if(valid_regisFTYC('fyeucaubds')){
			SubmitYCBDS('fyeucaubds',sql,listThongTinThemValue1,array_of_checked_values);
		}
	}
	else if(itemid==246){
		getDataLoginTYCBDS('fyeucaubds', "<?php echo JURI::base();?>" ,sql,listThongTinThemValue1, array_of_checked_values);
	}
	else{
		if(document.getElementById('email').value==''){
			alert('Vui lòng nhập email để chúng tôi có thể gửi kết quả tìm kiếm BĐS cho bạn');
			document.getElementById('email').style.borderColor="#FF0000";
			document.getElementById('email').focus();
			return false;
		}else{
			if(!validate_Email_Address(document.getElementById('email').value)){
				alert('Email không hợp lệ');
				document.getElementById('email').style.borderColor="#FF0000";
				document.getElementById('email').focus();
				return false;
			}
		}
		if($("#emailFail").val() == '1'){
			alert('Email này đã được đăng ký vui lòng sử dụng email khác');
			document.getElementsByName('email').style.borderColor="#FF0000";
			document.getElementsByName('email').focus();
			return false;
		}
		if(document.getElementsByName('osolCatchaTxt').value == ''){
			alert('Mã an toàn không được rỗng');
			document.getElementsByName('osolCatchaTxt').style.borderColor="#FF0000";
			return false;
		}
		SubmitYCBDS('fyeucaubds',sql,listThongTinThemValue1,array_of_checked_values);
	}
	
	return true;
}
function isNumeric(sText,decimals,negatives) {
	var isNumber=true;
	var numDecimals = 0;
	var validChars = ".,0123456789";
	if (decimals)  validChars += ".";
	if (negatives) validChars += "-";
	var thisChar;
	for (i = 0; i < sText.length && isNumber == true; i++) {  
		thisChar = sText.charAt(i); 
		if (negatives && thisChar == "-" && i > 0) isNumber = false;
		if (decimals && thisChar == "."){
			numDecimals = numDecimals + 1;
			if (i==0 || i == sText.length-1) isNumber = false;
			if (numDecimals > 1) isNumber = false;
		}
		if (validChars.indexOf(thisChar) == -1) isNumber = false;
	}
	return isNumber;
}
function SubmitYCBDS(form,condition,tienich,quanhuyen){
	document.forms[form].sql.value=condition;
	document.forms[form].tienich.value=tienich;
	document.forms[form].quanhuyen.value=quanhuyen;
	document.forms[form].submit();
}
function clearDefaultValue( inputEle, defaultValue )
{
	if ( inputEle.value == defaultValue )
	{
		inputEle.value = "";
	}
}

function setDefaultValue( inputEle, defaultValue )
{
	if ( inputEle.value == "" )
	{
		inputEle.value = defaultValue;
	}	
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
function changeLoaiGia()
{
	if ( $("#loai_giao_dich_id").val() == "2" )
	{
		$("#nguyen_can_text").html("nguyên căn/th");
		$("#m2_text").html("m<sup>2</sup>/th");
		$("#nguyen_can_text_nc").html("nguyên căn/th");
		$("#m2_text_nc").html("m<sup>2</sup>/th");
	}
	else 
	{
		$("#nguyen_can_text").html("nguyên căn");
		$("#m2_text").html("m<sup>2</sup>");
		$("#nguyen_can_text_nc").html("nguyên căn");
		$("#m2_text_nc").html("m<sup>2</sup>");
	}
}
jQuery(function(){
	jQuery("#loai_giao_dich_id").change(function() {
		changeLoaiGia();
    });
	if(jQuery.browser.msie){
		
	}else{
		jQuery("#du_an_id").searchable();
	}
	setTimeout(function () { 
	jQuery('[name="multiselect_quan_huyen_id"]').each(function(){
		   $(this).click(function(){
		          //alert(this.value);
				  			          
		          var selectedValueTemp = jQuery("#quan_huyen_id").val();
		          var selectedValue = '';
		          if ( selectedValueTemp != null )
		          {
			          selectedValue = selectedValueTemp.toString();
		          }
		          if ( selectedValue != null )
		          {
			          if ( selectedValue.indexOf( this.value ) >= 0 )
			          {
			        	  selectedValue.replace( this.value, '' );
				          if ( selectedValue.indexOf( ',' ) == 0 )
				          {
				        	  selectedValue.replace( ',', '' );
				          }
			          }
			          else
			          {
				          selectedValue += "," + this.value; 
			          }
		          }
		          layDanhSachDuAn1(selectedValue,'vi-VN','<?php echo JURI::base();?>');
		   });
		}); 

	jQuery(".ui-multiselect-all").each(function(){
		   $(this).click(function(){
		          //alert(this.value);
				  			          
		          var selectedValueTemp = jQuery("#quan_huyen_id").val();
		          
		          layDanhSachDuAn1(selectedValueTemp,'vi-VN','<?php echo JURI::base();?>');
		   });
		});

	jQuery(".ui-multiselect-none").each(function(){
		   $(this).click(function(){
		          //alert(this.value);
				  			          
		          var selectedValueTemp = jQuery("#quan_huyen_id").val();
		          
		          layDanhSachDuAn1(selectedValueTemp,'vi-VN','<?php echo JURI::base();?>');
		   });
		});
	 } , 1000);
	jQuery("#dien_tich_su_dung_tu").change(function(){
		numbersonly(this);
	});
	changeLoaiGia();
});
</script>