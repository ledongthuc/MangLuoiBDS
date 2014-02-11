<?php 
if ( empty ( $data ) )
{
	$data = $this->data;
}

if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
	<?php echo $ajaxPaging;?>
</div>
<?php 
foreach( $data as $item )
{
?>
		  <div class='items-icon'>
		<div>
		<h4 class='items-link'>	<a href='<?php echo $item['link']?>' >
<?php echo $item['tieu_de']?>
</a>
</h4>
		</div>
		<div>
		<div class='f-l'>
<?php
if ( !file_exists( "images/property/".$item['id']."/min.jpg"  ) )
{
	echo "<img src='$item[image]' >";			
}
else
{
	echo  "<img src='images/property/$item[id]/min.jpg' > ";
}
?>
		

		</div>
		<div class='f-r'>
				<li class='items-add'>
					<div id="dia_chi<?php echo $item['id']?>">
				<span class="font12">
                <?php if ( empty($titleStrings) ) {echo JText::_('DIA_CHI');}
                		else {echo $titleStrings['DIA_CHI'];}?>
          		  </span> 
            <span><?php echo $item['dia_chi']?></span>
					</div>
				</li>
				<li class='list-area'>
					<span class="font12">
					<?php if ( empty($titleStrings) )
						 {
					 	echo JText::_('DIEN_TICH');
						 }
						else 
					 	 {
						echo $titleStrings['DIEN_TICH'];
							}
					?>
</span> 
			<?php echo $item['dien_tich_khuon_vien']?>
</li>
		</div>
		</div>
		<div class='clear'>
		<span class='items-price'><?php echo $item['tien_te_HTML']?></span>
		</div>
		</div>
		
	<?php 	
	}	
?>
<div class='clear'>
		</div>

 
	
