
<?php 
require_once 'includes/ham_tien_ich.php';
include_once 'libraries/com_u_re/php/config.php';
$document =& JFactory::getDocument();
$document->addScript('includes/js/joomla.javascript.js');

$title = $document->getTitle();
if($title=='TRANG CHỦ'){
	$title = 'Mạng lưới Bất động sản – mạng lưới thông tin cho thuê và mua bán nhà, đất, văn phòng, căn hộ';
}
$document->setTitle($title);

function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 	$pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
 return $pageURL;
}
if($data==null){
	$user = JFactory::getUser();
	if($user->get('id')!=0){
		$link = JURI::base()."vi?option=com_u_re&view=manage&layout=yeucau&Itemid=242";
	}else{
		$link= JURI::base()."vi/dang-ky-thanh-vien-tao-yeu-cau-bds";
	}
	echo "<div class='clear'></div><span id='thongbao'>Không tìm thấy bất động sản theo yêu cầu<br /><a href='".$link."'>Tạo yêu cầu BĐS, chúng tôi sẽ tự động gửi mail thông báo cho bạn</a></span>";
}else{
?>
<div class='ngaydang'>
<form action="<?php echo curPageURL(); ?>" name="formclause" method="get">
	<select class="input-s" name="clause" onchange="changeOrder(this.options[this.selectedIndex].value)" style="width: 182px">
			<option value="ngay_chinh_sua" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='ngay_chinh_sua') echo "selected='selected'"?> >Ngày cập nhật</option>
			<option value="dien_tich_su_dung_ASC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='dien_tich_su_dung_ASC') echo "selected='selected'"?> >Diện tích sử dụng thấp nhất</option>
			<option value="dien_tich_su_dung_DESC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='dien_tich_su_dung_DESC') echo "selected='selected'"?> >Diện tích sử dụng cao nhất</option>
			<option value="gia_nguyen_can_ASC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='gia_nguyen_can_ASC') echo "selected='selected'"?>>Giá nguyên căn thấp nhất</option>
			<option value="gia_nguyen_can_DESC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='gia_nguyen_can_DESC') echo "selected='selected'"?> >Giá nguyên căn cao nhất</option>	
			<option value="gia_m2_ASC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='gia_m2_ASC') echo "selected='selected'"?> >Giá m<sup>2</sup> thấp nhất</option>	
			<option value="gia_m2_DESC" <?php if(isset($_GET['clause'])&&($_GET['clause'])=='gia_m2_DESC') echo "selected='selected'"?> >Giá m<sup>2</sup> cao nhất</option>				
	</select>
</form>
</div>

<div class='facebook1'style="display:none;">
		<div class="pp_top fb_top">
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
	<div class='pp_content_container fb_content_container'>
		<div class="pp_left fb_left ">
			<div class="pp_right fb_right"><span class="bClose"></span>
				<div id="map" style="width:700px;height:500px;margin:0"></div>
			</div>
		</div>
	</div>
		<div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>	
	</div>

<?php 
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div>
<?php
foreach( $data as $item ){
	if($item['du_an']=='Vui lòng chọn'){
		$item['du_an']='';
	}
?>
<div class='clear'>

<div id='supper-vip'>
<?php 
if($item['loai_tin_id']==3){

?>
<div class='items-icon'>
	<div class='f-l-tm'>
	<div class='tinnoibat'>
	</div>
		<a href='<?php echo $item['link']?>' >
			<?php						
				if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
					{
						echo "<img  alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."$item[image]' />";			
					}
				else
					{
						if(isset($_GET['debug'])){
							$size_hinh = getNewSize(JURI::base() ."images/property/$item[id]/min.jpg",160,120);
							echo "<pre>";
							print_r(JURI::base() ."images/property/$item[id]/min.jpg");
							echo "</pre>";
						}
						echo  "<img  alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."images/property/$item[id]/min.jpg' /> ";
					}
			?>
		</a>
	</div>
	<div class='f-r-tm'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='white title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
				</h4>
				<span class='its font11'>
				<?php if($item['chinh_chu']==1&&$item['speak_english']==1) $phay=", "; else $phay="";?>
						<?php if($item['chinh_chu']==1){
							echo "Chính chủ";
						} 
						echo $phay;
						if($item['speak_english']==1){
							echo "Speak English";
						}
						if($item['chinh_chu']==1||$item['speak_english']==1){
							echo ', ';
						}
						?>
						<span>
							Mã số:
							<?php echo $item['ma_so'];?>
						</span>
				<span class='its datelist' style="float:right">
				Ngày cập nhật: <?php if($item['ngay_chinh_sua']!=null) echo $item['ngay_chinh_sua']; else echo $item['ngay_dang'];?>&nbsp;&nbsp;Lượt xem: <?php echo $item['luot_xem'];?>
				</span>
				</span>
		</div>
		<div class='clear'>
				<ul class='clear'>
					<!-- <li class='li-title'>
						Địa chỉ:
					</li> -->
					<li class='li-content1'>
						<?php echo $item['dia_chi'];?>
					</li>
					<li class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Giá nguyên căn:
					</li>
					<li class='li-content'>
						<span class='gia'> 
						<?php 
						if($item['gia_nguyen_can']!=0){
							echo $item['gia_nguyen_can'];
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?></span>
					</li>
					<li class='li-title-1'>
						Giá theo m<sup>2</sup>:
					</li>
					<li class='li-content2'>
						<span class='gia'> 
						<?php 
						if($item['gia_m2']!=0){
							echo $item['gia_m2']."/m<sup>2</sup>";
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?>						
						</span>
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Diện tích sử dụng: 
					</li>
					<li class='li-content'>
						<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</li>
					<li class='li-title-1'>
						Diện tích sàn:
					</li>
					<li class='li-content2'>
						<span>
						<?php 
						if($item['dien_tich_khuon_vien']!=0){
							echo $item['dien_tich_khuon_vien'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span> 
						
						<span class='font11'>
						(Mặt tiền: 
							<?php 
							if($item['dien_tich_khuon_vien_rong']!=0){
								echo $item['dien_tich_khuon_vien_rong'];?>
							<?php }else{
								echo " _";
							}?>m,Sâu: 
							<?php 
							if($item['dien_tich_khuon_vien_dai']!=0){
								echo $item['dien_tich_khuon_vien_dai'];?>
							<?php }else{
								echo " _";
							}?>m)
						</span>
					</li>
				</ul>
				<ul class='clear' style='border:none;'>
					<li class='li-title'>
						Số phòng ngủ:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_ngu'])){
							echo $item['phong_ngu'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
					<li class='li-title-1'>
						Số phòng tắm:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_tam'])){
							echo $item['phong_tam'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
				</ul>
		</div>
		
	</div>
	<div class='clear'>
	</div>
</div>

	
		
	<?php 	
	}

?>
</div>
<div id='list-vip'>
<?php 
if($item['loai_tin_id']==2){

?>
		
		
<div class='items-icon'>
	<div class='f-l-tm'>
	<div class='tinnoibat'>
	</div>
		<a href='<?php echo $item['link']?>' >
			<?php						
				if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
					{
						echo "<img  alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."$item[image]' />";			
					}
				else
					{
						echo  "<img alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."images/property/$item[id]/min.jpg' /> ";
					}
			?>
		</a>
	</div>
	<div class='f-r-tm'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
				</h4>
				<span class='its font11'>
				<?php if($item['chinh_chu']==1&&$item['speak_english']==1) $phay=", "; else $phay="";?>
						<?php if($item['chinh_chu']==1){
							echo "Chính chủ";
						} 
						echo $phay;
						if($item['speak_english']==1){
							echo "Speak English";
						}
						if($item['chinh_chu']==1||$item['speak_english']==1){
							echo ', ';
						}
						?>
						<span>
							Mã số:
							<?php echo $item['ma_so'];?>
						</span>
				<span class='its datelist' style="float:right">
				Ngày cập nhật: <?php if($item['ngay_chinh_sua']!=null) echo $item['ngay_chinh_sua']; else echo $item['ngay_dang'];?>&nbsp;&nbsp;Lượt xem: <?php echo $item['luot_xem'];?>
				</span>
				</span>
		</div>
		<div class='clear'>
				<ul class='clear'>
					<!-- <li class='li-title'>
						Địa chỉ:
					</li> -->
					<li class='li-content1'>
						<?php echo $item['dia_chi'];?>
					</li>
					<li class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Giá nguyên căn:
					</li>
					<li class='li-content'>
						<span class='gia'> 
						<?php 
						if($item['gia_nguyen_can']!=0){
							echo $item['gia_nguyen_can'];
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?></span>
					</li>
					<li class='li-title-1'>
						Giá theo m<sup>2</sup>:
					</li>
					<li class='li-content2'>
						<span class='gia'> 
						<?php 
						if($item['gia_m2']!=0){
							echo $item['gia_m2']."/m<sup>2</sup>";
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?>						
						</span>
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Diện tích sử dụng: 
					</li>
					<li class='li-content'>
						<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</li>
					<li class='li-title-1'>
						Diện tích sàn:
					</li>
					<li class='li-content2'>
						<span>
						<?php 
						if($item['dien_tich_khuon_vien']!=0){
							echo $item['dien_tich_khuon_vien'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span> 
						
						<span class='font11'>
						(Mặt tiền: 
							<?php 
							if($item['dien_tich_khuon_vien_rong']!=0){
								echo $item['dien_tich_khuon_vien_rong'];?>
							<?php }else{
								echo " _";
							}?>m,Sâu: 
							<?php 
							if($item['dien_tich_khuon_vien_dai']!=0){
								echo $item['dien_tich_khuon_vien_dai'];?>
							<?php }else{
								echo " _";
							}?>m)
						</span>
					</li>
				</ul>
				<ul class='clear' style='border:none;'>
					<li class='li-title'>
						Số phòng ngủ:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_ngu'])){
							echo $item['phong_ngu'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
					<li class='li-title-1'>
						Số phòng tắm:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_tam'])){
							echo $item['phong_tam'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
				</ul>
		</div>
		
	</div>
	<div class='clear'>
	</div>
</div>

	
		
	<?php 	
	}

?>
</div>
<div id='list-normal'>
<?php 
	if($item['loai_tin_id']==1){
?>
		
		
<div class='items-icon'>
	<div class='f-l-tm'>
	<div class='tinnoibat'>
	</div>
		<a href='<?php echo $item['link']?>' >
			<?php						
				if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
					{
						echo "<img  alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."$item[image]' />";			
					}
				else
					{
						echo  "<img   alt='".$item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh']."' class=\"img_bds_tm\" src='" . JURI::base() ."images/property/$item[id]/min.jpg' /> ";
					}
			?>
		</a>
	</div>
	<div class='f-r-tm'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
				</h4>
				<span class='its font11'>
				<?php if($item['chinh_chu']==1&&$item['speak_english']==1) $phay=", "; else $phay="";?>
						<?php if($item['chinh_chu']==1){
							echo "Chính chủ";
						} 
						echo $phay;
						if($item['speak_english']==1){
							echo "Speak English";
						}
						if($item['chinh_chu']==1||$item['speak_english']==1){
							echo ', ';
						}
						?>
						<span>
							Mã số:
							<?php echo $item['ma_so'];?>
						</span>
				<span class='its datelist' style="float:right">
				Ngày cập nhật: <?php if($item['ngay_chinh_sua']!=null) echo $item['ngay_chinh_sua']; else echo $item['ngay_dang'];?>&nbsp;&nbsp;Lượt xem: <?php echo $item['luot_xem'];?>
				</span>
				</span>
		</div>
		<div class='clear'>
				<ul class='clear'>
					<!-- <li class='li-title'>
						Địa chỉ:
					</li> -->
					<li class='li-content1'>
						<?php echo $item['dia_chi'];?>
					</li>
					<li class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Giá nguyên căn:
					</li>
					<li class='li-content'>
						<span class='gia'> 
						<?php 
						if($item['gia_nguyen_can']!=0){
							echo $item['gia_nguyen_can'];
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?></span>
					</li>
					<li class='li-title-1'>
						Giá theo m<sup>2</sup>:
					</li>
					<li class='li-content2'>
						<span class='gia'> 
						<?php 
						if($item['gia_m2']!=0){
							echo $item['gia_m2']."/m<sup>2</sup>";
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
						}else{
							echo "Thương lượng";
						}					
						?>						
						</span>
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Diện tích sử dụng: 
					</li>
					<li class='li-content'>
						<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</li>
					<li class='li-title-1'>
						Diện tích sàn:
					</li>
					<li class='li-content2'>
						<span>
						<?php 
						if($item['dien_tich_khuon_vien']!=0){
							echo $item['dien_tich_khuon_vien'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span> 
						
						<span class='font11'>
						(Mặt tiền: 
							<?php 
							if($item['dien_tich_khuon_vien_rong']!=0){
								echo $item['dien_tich_khuon_vien_rong'];?>
							<?php }else{
								echo " _";
							}?>m,Sâu: 
							<?php 
							if($item['dien_tich_khuon_vien_dai']!=0){
								echo $item['dien_tich_khuon_vien_dai'];?>
							<?php }else{
								echo " _";
							}?>m)
						</span>
					</li>
				</ul>
				<ul class='clear' style='border:none;'>
					<li class='li-title'>
						Số phòng ngủ:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_ngu'])){
							echo $item['phong_ngu'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
					<li class='li-title-1'>
						Số phòng tắm:
					</li>
					<li class='li-content'>
						<span><?php 
						if(!empty($item['phong_tam'])){
							echo $item['phong_tam'];
						}else{
							echo "_";	
						}
						?></span>
					</li>
				</ul>
		</div>
		
	</div>
	<div class='clear'>
	</div>
</div>

	
		
	<?php 	
	}

?>
</div>
</div>
<?php 
}

?>
<div class='clear'></div>
<div class='ngaydang'>
<div id='bttop' onclick="crollTop()">Lên đầu trang</div>
</div>
<?php
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_bt_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div>
<?php }?>
<div class='clear'></div>
<script type="text/javascript">
var curURL = "<?php echo curPageURL();?>";
var clauseStr = "";

<?php if ( !empty( $_GET['clause'] ) ) {?>
clauseStr = "clause=" + "<?php echo $_GET['clause']?>";
<?php }?>

function changeOrder( value )
{
	/*if ( curURL.indexOf('&clause') > 0 )
	{
		curURL = curURL.substring( 0, curURL.indexOf('&clause') );
	}
	else if ( curURL.indexOf('?clause') > 0 )
	{
		curURL = curURL.substring( 0, curURL.indexOf('?clause') );
	}*/

	// get url without clause
	if ( clauseStr != "" )
	{
		curURL = curURL.replace( "?" + clauseStr, "" );
		curURL = curURL.replace( "&" + clauseStr, "" );
		curURL = curURL.replace( "/&", "/?" );
	}

	//alert('cur = ' + curURL );
	
	if ( curURL.indexOf("?") > 0 )
	{
		var changeOrderURL = curURL + "&clause=" + value;
	}
	else 
	{
		var changeOrderURL = curURL + "?clause=" + value;
	}

	//alert('change order cur = ' + changeOrderURL );
	
	if( curURL == "<?php echo JURI::base(); ?>"){
		var changeOrderURL = curURL + "?clause=" + value;
	}

	//alert('final change order cur = ' + changeOrderURL );
	
	window.location = changeOrderURL;
}
</script>
