<!-- anh chinh -->
<!-- TODO: add SEO advance -->

<?php
//  || $this->data['status'] != 0
$status = $this->data['status'];
if ( (!empty( $this->data ) && is_array( $this->data )) || $status != 0 )
{
	$mainImage = $this->data['mainImage'];
	$subImages = $this->data['subImages'];	
	$slideshowTitle = $this->data['title'];
	$id = $this->data['id'];
	
	if ( is_file($mainImage['isfile']))
	{
		if ( empty($mainImage['max_url']) )
		{
			$mainImage['max_url'] = $mainImage['preview_url'];
		}
	
	?>
	<a id='' rel='prettybox[image_bds]' href='<?php echo $mainImage['max_url'] ?>' title='<?php echo $slideshowTitle?>'>
	<img  id="img_preview" src="<?php echo $mainImage['preview_url'] ?>" />
	</a>
	
	<!-- Link xem hinh lon hon -->
	<div class='phonglon'>
	
	  <a style="cursor:pointer" onclick='openPopupSlideshow();' >
	<?php echo JText::_('XEM_HINH_LON_HON');?>
	</a></div>
	<?php 
	}
	else
	{
	?>
	<a rel='prettybox[image_bds]' href='<?php echo $mainImage['preview_url'] ?>'>
	<img id="img_preview" src="<?php echo JURI::root()?>images/noimage.jpg"  alt="preview.jpg"  /> 
	</a>
	<?php 
	}
?>

<?php  // the input de dua hinh anh chinh
if ( $status != 0 )
{
?>
<!-- <input type="file" id="main_image" name="main_image" value=""  size="30" />	-->
<?php 
}
?><div class="snd_imgs" ><!--hình ảnh thumbsnail-->
             <li>
             <?php
             // thumbsnaul cua anh chinh
 if ( is_file($mainImage['isfile']))
 {
 	 	
 ?>
 
 	<img src="<?php echo $mainImage['min_url'] ?>" 
 	alt="<?php echo $mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>"
 	onclick="swapImage('img_preview','<?php echo $mainImage['preview_url'] ?>', '<?php echo $mainImage['max_url'] ?>')" />

 	
 		<?php // xoa hinh anh chinh
	 	if ( $status != 0 )
	 	{
	 	?>
	 		 <a href="<?php echo JURI::base() . 'index.php?option=com_jea'
            .'&amp;controller=projects&amp;task=deleteimg&amp;id='. $id?>" ><?php echo JText::_('DELETE') ?></a>	
	 	<?php	
	 	}
	 	?>
 
 <?php 
 }	
 ?>
             </li>

                <?php 
	if ( !empty($subImages) && is_array($subImages) ) { 
	foreach($subImages as $image) { 
		if ( empty( $image['max_url'] ) )
		{
			$image['max_url'] = $image['preview_url'];
		}
	?>
                <li>
				
  <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>"
    title="<?php echo JText::_('title')?>" onclick="swapImage('img_preview','<?php echo $image['preview_url'] ?>', '<?php echo $image['max_url']; ?>')" />

   <a rel='prettybox[image_bds]' href='<?php echo $image['max_url'] ?>' style='display:none' title='<?php echo $slideshowTitle?>'> </a>
   
    <?php // xoa hinh anh phu
	 	if ( $status == 1 )
	 	{
	 	?>									
    <a href="<?php echo JURI::base() . 'index.php?option=com_u_re'
           .'&amp;controller=projects&amp;task=deleteimg&amp;id='.$id.'&amp;image='.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
    <?php 
	 	}
    ?>
    
    <?php 
    	if ( $status == 2 )
	 	{
	 	?>									
    <a href="<?php echo JURI::base() . 'index.php?option=com_jea'
           .'&amp;controller=projects&amp;task=deleteimg&amp;id='.$id.'&amp;image='.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
    <?php 
	 	}
    ?>
    
             </li>
                <?php } }?>
  </div>

 <?php
} 
 ?>
 <?php // the input de dua hinh anh phu len
if ( $this->data['status'] != 0 )
{
?>

<div class="clear">												
<div>
<!--  ANH_CHINH -->
<span id='aj_MAIN_PROPERTY_PICTURE'>
<?php echo JText::_('ANH_CHINH') ?>
</span>
<span class="input_hinhanhchinh_dangtin" >
  <input id='main_image' type="file" name="main_image" value=""  size="30"/><input type="button" value="Reset" onclick='resetImage(20)'>
  </span>
</div><!--  ANH_CHINH -->
 <input type="hidden" id="CountImage" name="CountImage" value='0' />

<table id="tblUpload"">
    <tbody>
        <tr id="0">
            <td valign="top" colspan="2">
				<span id='aj_SECONDARIES'>
					<?php echo JText::_('ANH_PHU') ?>
				</span>
				<span class="input_hinhanhphu_dangtin" >
				     <input name="secondaries_images0" type="file" id="secondaries_images0" class="SForm" size="30" onchange="javascript:UploadImg(this)" />
				</span>
				</td>
		</tr>
	</tbody>
</table>
</div>
<?php 
}
?>
<script type="text/javascript" charset="utf-8">
	function openPopupSlideshow()
	{
		$("a[rel^='prettybox']:eq(0)").trigger('click');
		return false;
	 }	
</script>
<div class="clear"> </div>
<div class="clear"> </div>
 