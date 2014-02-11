<?php 
foreach( $data as $item )
{
?>
		  <div class='items-icon'>

		
		<div class='f-l-tm'>
		<a href='<?php echo $item['link']?>' >
<?php						
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img  class=\"img_bds_tm\" src='$item[image]' >";			
}
else
{
	echo  "<img   class=\"img_bds_tm\" src='images/property/$item[id]/min.jpg' > ";
}
?>
		</a>

		</div>
		<div class='f-r-tm'>
		
				<li class='items-add'>
				
					<h4 class='items-link'>
							<a href='<?php echo $item['link']?>' >
								<?php  echo $item['tieu_de']?>
							</a>
					</h4>
				</li>
				<li class='items-add font11'>
			     <span>
				<?php
				echo JText::_('DIEN_TICH');
						if ( $item['dien_tich_khuon_vien_dai'] == 0 || $item['dien_tich_khuon_vien_rong'] == 0  )
						{
							echo "_";
						}
						else 
						{
							echo $item['dien_tich_khuon_vien_rong']."m"; 
							echo "&nbsp;x &nbsp;";
							echo  $item['dien_tich_khuon_vien_dai']."m";
							// echo $item['dien_tich_khuon_vien']." m<sup>2</sup>";
						}
					?>
			</span>
				</li>
				<li class='font11'>
				<?php 
				if ( empty($titleStrings) )
					 {
						echo JText::_('GIA');
					 }
					 else
					 {
						echo $titleStrings['GIA'];
					 }
					 	echo "&nbsp ";
					 	?>
					<span class='gia'>
					<?php echo $item['gia'];	?>
					</span>
				</li>
			<!-- <?php 
				if($hien_thi_luot_xem == 1)
				{
			?>
			 <div style='float:left;width:100%'>
				<?php 
					if ( empty($titleStrings) )
						{
							echo JText::_('LUOT_XEM');
						}
						else
						{
							echo $titleStrings['LUOT_XEM'];
						} 
					echo ': '.$item['luot_xem'] ?>
			</div>
			<?php }?>-->
	</div>
		

		</div>
		
	<?php 	
	}	
?>

<?php 
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div>
 		<div class='clear'></div>
	
