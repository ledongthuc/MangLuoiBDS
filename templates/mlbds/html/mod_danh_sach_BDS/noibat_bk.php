<?php 

if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div>
<?php 
//echo "<pre>";
// print_r(  $data);
//echo "</pre>";
foreach( $data as $item )
{
?>
		  <div class='items-icon1'>

		
<div class='f-l'>
		
		<a href='<?php echo $item['link']?>' >
				<?php						
				if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
				{
					echo "<img  class=\"img_bds\" src='$item[image]' >";			
				}
				else
				{
					echo  "<img   class=\"img_bds\" src='images/property/$item[id]/min.jpg' > ";
				}
				?>
		</a>
		<div  class="nb_mts">
			<span class="nb_mts_label">
			<?php
				if ( empty($titleStrings) )
				{
						echo JText::_('MABDS');
					 }
					 else
					 {
						echo $titleStrings['MABDS'];
				}
			?>
			</span>
			
			<span class="nb_mts_value">
					<?php  echo $item['id']?>
			</span>
		</div> 
</div>
		


		<div class='f-r'>
		
				<div class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo $item['tieu_de']?>
							</a>
					</h4>
			
					<div id="dia_chi<?php echo $item['id']?>">
						<span class="mn_diachi">
								<?php echo $item['dia_chi'];?>							
						  </span> 
					</div>
				</div>
			
				<div class='items-add'>
			     <span>
				<?php
						if ( $item['dien_tich_khuon_vien_dai'] == 0 || $item['dien_tich_khuon_vien_rong'] == 0  )
						{
							echo "_";
						}
						else 
						{
							echo $item['dien_tich_khuon_vien_dai']  * $item['dien_tich_khuon_vien_rong']." m<sup>2</sup>";
							// echo $item['dien_tich_khuon_vien']." m<sup>2</sup>";
						}
					?>
			</span>
				</div>
			
		
				<?php echo $item['tien_te_HTML']?>
		
	</div>
		

		</div>
		
		



	<?php 	
	}	
?>

 		<div class='clear'></div>
	
	
