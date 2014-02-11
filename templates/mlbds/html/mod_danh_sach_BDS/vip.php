<?php 
require_once 'includes/ham_tien_ich.php';
include_once 'libraries/com_u_re/php/config.php';
//$sotu = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'so_tu_tieu_de' );	?>
<?php 
	jimport( 'joomla.application.module.helper' );
	$module = JModuleHelper::getModule( 'custom', 'bdsmoinhat' );
?>
<div id='list-vip'>
<?php 
/*echo "<pre>";
print_r($data);
echo "</pre>";
exit();*/
foreach( $data as $item )
{
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
						echo "<img  class=\"img_bds_tm\" src='$item[image]' >";			
					}
				else
					{
						echo  "<img   class=\"img_bds_tm\" src='" . JURI::base() ."images/property/$item[id]/min.jpg' > ";
					}
			?>
		</a>
	</div>
	<div class='f-r-tm'>
		<div style='float:left;widht:366px'>
				<h4> 
					<a href='<?php echo $item['link']?>' class='title-link'> 		
						<?php echo $item['tieu_de'];?>
					</a>
				</h4>
				<span class='its font11'>
						<?php if($item['chinh_chu']==1){
							echo "Chính chủ";
						} 
						if($item['speak_english']==1){
							echo "Speak English";
						}
						?>
				</span>
		</div>
		<div class='font11 r-it'>				
				<dl class='its'>
				Ngày cập nhật: <?php echo $item['ngay_dang'];?>
				</dl>
				<dl class='its'>Lượt xem: <?php echo $item['luot_xem'];?>
				</dl>
		</div>
		<div class='clear'>
				<ul class='clear'>
					<li class='li-title'>
						Địa chỉ:
					</li>
					<li class='li-content1'>
						<?php echo $item['dia_chi'];?>
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						Giá nguyên căn:
					</li>
					<li class='li-content'>
						<span class='gia'> 
						<?php 
						if($item['don_vi_dien_tich_id']==1){
							echo $item['gia_nguyen_can'];
						}else{
							echo $item['gia'];
						}					
						?></span>
					</li>
					<li class='li-title'>
						Giá nguyên m<sup>2</sup>:
					</li>
					<li class='li-content2'>
						<span class='gia'> 
						<?php 
						if($item['don_vi_dien_tich_id']==1){
							echo $item['gia'];
						}else{
							echo $item['gia_m2']."/m2";
						}						
						?>
						</span>
					</li>
				</ul>
				<ul class='clear'>
					<li class='li-title'>
						DTSD:
					</li>
					<li class='li-content'>
						<span>  <?php echo $item['dien_tich_su_dung'];?> m<sup>2</sup></span>
					</li>
					<li class='li-title'>
						Diện tích sàn:
					</li>
					<li class='li-content2'>
						<span><?php echo $item['dien_tich_khuon_vien'];?> m<sup>2</sup></span> <span class='font11'>(Mặt tiền: <?php echo $item['dien_tich_su_dung_rong'];?>m,Sâu: <?php echo $item['dien_tich_su_dung_dai'];?>m)</span>
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
					<li class='li-title'>
						Số phòng tắm
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
}
?>
</div>
<div class='clear'></div>