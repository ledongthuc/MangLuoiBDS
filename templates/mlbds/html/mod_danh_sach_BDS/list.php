<?php 
require_once 'includes/ham_tien_ich.php';
include_once 'libraries/com_u_re/php/config.php';
$sotu = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'so_tu_tieu_de' );	
if(isset($_GET['loai_bds_id'])){
?>
<div class="property-town">
<?php if(!empty($datatp)){?>
<!-- TP.Hồ Chí Minh -->
	<div class="list-bds">
		<h3>TP.Hồ Chí Minh</h3> 
		<div id="xtc"><a href="index.php?tinh_thanh_id=1&task=search&option=com_u_re&Itemid=218&Issearch=1">Xem tất cả</a></div>
		<?php 
foreach( $datatp as $item )
{
?>
		  <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
		
				<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
				
	</div>
		

		</div>
		
	<?php 	
	}
	?><div class='clear'></div>
	</div>
	<!-- end TP.Hồ Chí Minh -->
	
	<?php }?>
	<?php if(!empty($databd)){?>
	<!-- Bình Dương -->
	<div class="list-bds">
		<h3>Bình Dương</h3>
		<div id="xtc"><a href="index.php?tinh_thanh_id=16&task=search&option=com_u_re&Itemid=218&Issearch=1">Xem tất cả</a></div>
		<?php 
foreach( $databd as $item )
{
?>
		  <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
		<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
				
			
			
	</div>
		

		</div>
		
	<?php 	
	}
	?><div class='clear'></div>
	</div>
	<!-- end Bình Dương -->
	
	<?php }?>
	<?php if(!empty($datadn)){?>
	<!-- Đồng Nai -->
	<div class="list-bds">
		<h3>Đồng nai</h3>
		<div id="xtc"><a href="index.php?tinh_thanh_id=27&task=search&option=com_u_re&Itemid=218&Issearch=1">Xem tất cả</a></div>
		<?php 
foreach( $datadn as $item )
{
?>
		  <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
		
			
			<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
	</div>
		

		</div>
		
	<?php 	
	}
	?><div class='clear'></div>
	</div>
	<!-- end Đồng Nai -->
	
	<?php }?>
	<?php if(!empty($datala)){?>
	<!-- Long An -->
	<div class="list-bds">
		<h3>Long An</h3>
		<div id="xtc"><a href="index.php?tinh_thanh_id=46&task=search&option=com_u_re&Itemid=218&Issearch=1">Xem tất cả</a></div>
		<?php 
foreach( $datala as $item )
{
?>
		  <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
		
			<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
	</div>
		

		</div>
		
	<?php 	
	}
	?><div class='clear'></div>
	</div>
	<!-- end Long An -->
	
	<?php }?>
	<?php if(!empty($datactk)){?>
	<!-- Các tỉnh khác -->
	<div class="list-bds">
		<h3>Các tỉnh khác</h3>
		<div id="xtc"><a href="index.php?task=search&option=com_u_re&Itemid=218&Issearch=1">Xem tất cả</a></div>
		<?php 
foreach( $datactk as $item )
{
?>
		  <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
	
	</div>
		

		</div>
		
	<?php 	
	}
	?><div class='clear'></div>
	</div>
	<!-- end Các Tỉnh Khác -->
	
	<?php }?>
</div>
<?php 	
}else{
?>
<?php 
	if(!empty($data)){
		echo "<h3 class='dsbds'>DANH SÁCH BẤT ĐỘNG SẢN</h3>";
	foreach( $data as $item )
	{
	?>
			  <div class='items-icon-list'>
			<div class='f-l-tm1'>
			<a href='<?php echo $item['link']?>' >
	<?php						
	if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
	{
		echo "<img  class=\"img_bds_tm\" src='". JURI::base() . "$item[image]' >";			
	}
	else
	{
		echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
	}
	?>
			</a>
	
			</div>
			<div class='f-r-tm1'>
<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo getShortDescription($item['tieu_de'],$sotu)?>
							</a>
					</h4>
				</li>
				
				<li class='font11'>
				<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
				<li class='items-add'>
			     <span>
				<?php
							echo $item['dien_thoai_nguoi_lien_he'];
				?>
				</span>
				</li>
		</div>
			
	<div class='clear'>
	</div>
			</div>
			
		<?php 	
		}
	}	
	if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
	<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
		<?php echo $ajaxPaging;?>
	</div>
	<?php 
}
?>

<?php /*
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div> */ ?>
<div class='clear'></div>
<<<<<<< .mine
=======
<div id="hidden_ajax_paging_<?php echo $contentElementId ?>" style='display:none'></div>
	
>>>>>>> .r10966
