<?php 
require_once 'includes/ham_tien_ich.php';
include_once 'libraries/com_u_re/php/config.php';
//$sotu = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'so_tu_tieu_de' );
if ( empty ( $data ) )
{
	$data = $this->data;
}
if ( empty ( $hien_thi_luot_xem ) )
{
	$hien_thi_luot_xem = $this->hien_thi_luot_xem;
}
?>
<?php 
foreach( $data as $item )
{
?>
		   <div class='items-icon-list'>

		
		<div class='f-l-tm1'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm_lg\" src='".JURI::base()."$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm_lg\" src='" . JURI::base() . "images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm1'>
		
				<li class='items-add'>
				
					<h4 style='line-height: 15px;'>
							<a href='<?php echo $item['link']?>' class="title-link" >
							<?php echo $item['tieu_de'];?>
							</a>
					</h4>
				</li>
				
				
					<li class='li-title-lg'>
						Giá nguyên căn:
					</li>
					<li class='li-content-lg' style="width: 88px;">
						<span class='gia'> 
						<?php
						if($item['gia_nguyen_can'] != 0 ){
							echo $item['gia_nguyen_can'];
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
                    	}
                    	else{
                    		echo "Thương lượng";
                    	} 					
						?></span>
					</li>
					
					<li class='li-title-lg'>
						Giá theo m<sup>2</sup>:
					</li>
					<li class='li-content-lg'>
						<span class='gia'> 
						<?php 
						if($item['gia_m2'] != 0 ){
							echo $item['gia_m2'];
							if( $item['don_vi_dien_tich_id'] == 3 || $item['don_vi_dien_tich_id'] == 4){
								echo "/tháng";
							}
                    	}
                    	else{
                    		echo "Thương lượng";
                    	}					
						?>
						</span>
					</li>
					<li class='li-title-lg' style='clear:both'>
				DTSD:
				</li>
				<li class='li-content-lg'>
					<span>  
						<?php 
						if($item['dien_tich_su_dung']!=0){
							echo $item['dien_tich_su_dung'];?> m<sup>2</sup>
						<?php }else{
							echo " _";
						}?>
						</span>
				</li>
			
	</div>
		
<div class='clear'></div>
		</div>
		
		



	<?php 	
	}	
?>

 		
	
	
