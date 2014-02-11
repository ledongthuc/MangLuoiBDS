<h3 class='tieudemoinhat'>Bất động sản mới nhất</h3>



<a href='<?php echo JURI::base();?>nhadat/search/229/?searchType=dk' style="padding-top: 8px;text-decoration: underline;float: left;">Xem danh sách đầy đủ</a>

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
	echo "<div class='clear'></div><span id='thongbao' style='position: absolute;width:632px'>Không tìm thấy bất động sản theo yêu cầu</span>";
}else{
?>
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


<div class='moinhatlist'>
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
<div class='items-icon vipmoinhat'>
	
	<div class='f-r-tm listhome'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='white title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
				<!--	<span class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</span>
				-->
				</h4>
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
				<li class='li1'>
					<span class='li-title-h'>
						Diện tích sử dụng :
					</span>
					<span class='li-content-h'>
						<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</span>
				</li>
					<li class='li2'>
					<span class='li-title-h'>
						Nguyên căn:
					</span>
					<span class='li-content-h1'>
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
					</span>
					</li>
				
					<li class='li3'>
						<span class='li-title-1-h'>
						M<sup>2</sup>:
						</span>
						<span class='li-content2-h'>
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
						</span>
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
<div id='list-vip1'>
<?php 
if($item['loai_tin_id']==2){

?>
		
		
<div class='items-icon'>
	
	<div class='f-r-tm listhome'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
					<!--<span class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</span>-->
				</h4>
				
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
				<li class='li1'>
					<span class='li-title-h'>
						Diện tích sử dụng :
					</span>
					<span class='li-content-h'>
						<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</span>
				</li>
					
					<li class='li2'>
					<span class='li-title-h'>
						Nguyên căn:
					</span>
					<span class='li-content-h1'>
					
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
					</span>
					</li>
					
					<li class='li3'>
					<span class='li-title-1-h'>
						M<sup>2</sup>:
					</span>
					<span class='li-content2-h'>
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
					</span>
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
<div id='list-normal-home'>
<?php 
	if($item['loai_tin_id']==1){
?>
		
		
<div class='items-icon'>
	<div class='f-r-tm listhome'>
		<div style='float:left;width:496px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='title-link'> 		
						<?php echo $item['loai_giao_dich']." ".$item['loai_bds']." ".$item['du_an'].", ".$item['quan_huyen'].", ".$item['tinh_thanh'];?>
					</a>
					<!--<span class="icon-map">
						<img style="cursor: pointer;" onclick="loadMap(<?php echo $item['kinh_do'] ?>,<?php echo $item['vi_do']?>,'<?php echo $item['id'] ?>','<?php echo JURI::base()?>')" src="<?php echo JURI::base()?>images/icon-map.png" alt="Bản đồ" title="Xem bất động sản trên bản đồ" />						
					</span>-->
				</h4>
				
				
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
				<li class='li1'>
					<span class='li-title-h'>
						Diện tích sử dụng :
					</span>
					<span class='li-content-h'>
					<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
					</span>
					</li>
					
					<li class='li2'>
					<span class='li-title-h'>
						Nguyên căn:
					</span>
					<span class='li-content-h1'>
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
					</span>
					</li>
					
					<li class='li3'>
						<span class='li-title-1-h'>
						M<sup>2</sup>:
						</span>
						<span class='li-content2-h'>
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
						</span>
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

</div>
<?php
//if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<!--<div id="ajax_paging_bt_<?php echo $contentElementId?>" class="ajax_paging">
	<?php //echo $ajaxPaging;?>
</div>-->
<?php }?>

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
