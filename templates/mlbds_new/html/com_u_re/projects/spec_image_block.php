<!-- anh chinh -->
<!-- TODO: add SEO advance -->

<?php
//  || $this->data['status'] != 0
$status = $this->data['status'];
if ( (!empty( $this->data ) && is_array( $this->data )) || $status != 0 )
{
	$images = $this->data['images'];
	if ( !empty( $this->data['title'] ) && $this->data['title'] != '' )
	{
		$slideshowTitle = $this->data['title'];
	}
	else 
	{
		$slideshowTitle = '';
	}
		
	if ( $status != 0 )
	{
		$specName = $this->data['spec_name'];
	}
	else 
	{
		$specName = '';
	}
	
	if ( !empty( $this->data['id'] ) )
	{
		$id = $this->data['id'];
	}
	else 
	{
		$id = '';
	}
	
	if ( !empty( $this->data['folder'] ) )
	{
		$folder = $this->data['folder'];
	}
?>

<div class="snd_imgs" ><!--hình ảnh thumbsnail-->

    <?php 
	if ( !empty($images) && is_array($images) ) 
	{ 
		$dem = 0;
		foreach($images as $image) 
		{ 
			$dem ++;
			if ( empty( $image['max_url'] ) )
			{
				$image['max_url'] = $image['preview_url'];
			}
	?>
		  <li>
						
			  <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>"
			    title="<?php echo $image['title']?>" onclick="swapImage('img_preview','<?php echo $image['preview_url'] ?>', '<?php echo $image['max_url']; ?>')" />
			
			   <a rel='prettybox[image_bds]' href='<?php echo $image['max_url'] ?>' style='display:none' title='<?php echo $slideshowTitle?>'> </a>
			   
			    <?php // xoa hinh anh phu
				 	if ( $status == 1 )
				 	{
				 	?>									
			    		<a href="<?php echo JURI::base() . 'index.php?option=com_u_re'
			           .'&amp;controller=projects&amp;task=deleteimg&amp;id='.$id.'&amp;image='.$folder.DS.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
			    <?php 
				 	}
			    ?>
			    
			    <?php 
			    	if ( $status == 2 )
				 	{
				 	?>									
			    <a href="<?php echo JURI::base() . 'index.php?option=com_jea'
			           .'&amp;controller=projects&amp;task=deleteimg&amp;id='.$id.'&amp;image='.$folder.DS.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
			    <?php 
				 	}
			    ?>
    
          </li>
	<?php 
		} // end foreach
	?>
	
	
	<!-- Link xem hinh lon hon 
	<div class='clear phonglon'>
	  	<a style="cursor:pointer" onclick='openPopupSlideshow();'>
			<?php echo JText::_('XEM_HINH_LON_HON');?>
		</a>
	</div>-->
	<?php 
	}
	?>
	
<?php } // END first if ?>
</div><!-- anh phu -->
 <?php // the input de dua hinh anh phu len
if ( $this->data['status'] != 0 )
{
?>
<div class="project-img-r1">
<div class="clear">												

<table id="tblUpload_<?php echo $specName?>">
    <tbody>
        <tr id="0">
            <td valign="top" colspan="2">
				<span id='aj_SECONDARIES'>
					<?php echo JText::_('ANH_PHU') ?>
				</span>
				<span class="input_hinhanhphu_dangtin" >
				     <input name="<?php echo $specName;?>0" type="file" id="<?php echo $specName?>0" class="SForm" size="30" onchange="javascript:UploadImg(this, '<?php echo $specName?>')" />
				</span>
				</td>
		</tr>
	</tbody>
</table>
</div>
</div>
<?php 
}
?>
<?php if ( $status == 0 ) {?>
<script type="text/javascript" charset="utf-8">
	function openPopupSlideshow()
	{
		$("a[rel^='prettybox']:eq(0)").trigger('click');
		return false;
	 }	
</script>
<?php }?>
<div class="clear"> </div>
<div class="clear"> </div>
 