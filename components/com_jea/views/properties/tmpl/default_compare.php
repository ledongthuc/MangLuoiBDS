<?php // no direct access
//session_start();
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
$session = &JFactory::getSession();
//echo "Session 1: ".$session->get('valueCompare_1');
//echo "<br>Session 2: ".$session->get('valueCompare_2');

//$session->clear('valueCompare_1');
//$session->clear('valueCompare_2');
//if(!$this->row1->id){
   // echo JText::_('This property doesn\'t exists anymore');
    //return;
//}

?>

    <table class="jea_listing" border="0" width="99%" cellpadding="4" align="center" >
	<tr class="row0">
    <td colspan="3" ><div align="center"><h2>So Sánh Bất Động Sản</h2></div></td>
    </tr>
    <tr class="row1">
    <td width="14%" ><strong>Tiêu Đề:</strong></td>
    <td width="43%" ><h4><a href="index.php?option=com_jea&task=search&id=<?=$this->row1->id?>"><?php echo $this->row1->ref ?></a></h4></td>
    <td width="43%"><h4><a href="index.php?option=com_jea&task=search&id=<?=$this->row2->id?>"><?php echo $this->row2->ref ?></a></h4></td>
    </tr>
	<tr class="row0">
    	<td><strong>Nội Dung:</strong></td>
		<td><?php echo $this->row1->description ?> </td>
        <td><?php echo $this->row2->description ?></td>
	</tr>
	<tr class="row1">
		<td><strong>Loại tin</strong></td>
		<td>
		<?php	echo $this->row1->kind; ?>
		</td>
        <td>
        <?php	echo $this->row2->kind; ?>
        </td>
	</tr>
	<tr class="row0">
		<td><strong>Loại BĐS</strong></td>
		<td>
		<?php	echo $this->row1->type; ?>
		</td>
        <td>
        <?php	echo $this->row2->type; ?>
        </td>
	</tr>
	<tr class="row1">
		<td><strong>Diện tích</strong></td>
		<td>
		<span style="color:#F00"><?php	echo $this->row1->living_width.' x '.$this->row1->living_length ?><?php	echo ' = '.$this->row1->living_space .' '. $this->params->get( 'surface_measure' ).PHP_EOL ; ?></span>
		</td>
        <td>
        <span style="color:#F00"><?php	echo $this->row2->living_width.' x '.$this->row2->living_length ?><?php	echo ' = '.$this->row2->living_space .' '. $this->params->get( 'surface_measure' ).PHP_EOL ; ?></span>
        </td>
	</tr>
	<tr class="row0">
		<td><strong>Giá</strong></td>
		<td>
			<span style="color:#F00"><?php echo $this->formatPrice( floatval($this->row1->price) , JText::_('Consult us') ) ?></span>
		</td>
        <td>
        <span style="color:#F00"><?php echo $this->formatPrice( floatval($this->row2->price) , JText::_('Consult us') ) ?></span>
        </td>
	</tr>
	<tr class="row1">
	<td><strong>Địa Chỉ</strong></td>
	<td>
		<?php echo $this->escape( $this->row1->adress ) ?>
	</td>
    <td>
    <?php echo $this->escape( $this->row2->adress ) ?>
    </td>
	</tr>
	<tr class="row0">
	<td><strong>Tỉnh/Thành</strong></td>
	<td>
		<?php echo $this->escape( $this->row1->town ) ?>
	</td>
    <td>
    <?php echo $this->escape( $this->row2->town ) ?>
    </td>
	</tr>
	<tr class="row1">
	<td><strong>Quận/Huyện</strong></td>
	<td>
		<?php echo $this->escape( $this->row1->area ) ?>
	</td>
    <td>
    <?php echo $this->escape( $this->row2->area ) ?>
    </td>
	</tr>
	<tr class="row0">
	<td><strong>Số phòng</strong></td>
	<td>
		<?php echo $this->row1->rooms  ?>
	</td>
    <td>
    <?php echo $this->row2->rooms  ?>
    </td>
	</tr>
	<tr class="row1">
	<td><strong>Số phòng tắm/WC</strong></td>
	<td>
		<?php echo $this->row1->bathrooms  ?>
	</td>
    <td>
    <?php echo $this->row2->bathrooms  ?>
    </td>
	</tr>
	<tr class="row0">
	<td><strong>Thông tin thêm</strong></td>
	<td>
		<?php echo $this->getAdvantages( $this->row1->advantages , 'ul' ) ?>
	</td>
    <td>
    <?php echo $this->getAdvantages( $this->row2->advantages , 'ul' ) ?>
    </td>
	</tr> 
    <tr>
    <td><strong>Hình Ảnh</strong></td>
    <td>
    <?php if($img = is_file(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row1->id.DS.'min.jpg')) : ?>
	  <div> <img id="img_preview" src="<?php echo $this->main_image_0['preview_url'] ?>" alt="preview.jpg"  width="304px"/> </div>
<?php endif ?>
    </td>
    <td>
    <?php if($img = is_file(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row2->id.DS.'min.jpg')) : ?>
	  <div> <img id="img_preview" src="<?php echo $this->main_image_1['preview_url'] ?>" alt="preview.jpg"  width="304px"/> </div>
<?php endif ?>
    </td>
    </tr>
 <!--   <tr>
    <td><strong>Bản Đồ:</strong></td>
    <td>
  	<?php  //$this->activateGoogleMap($this->row1, 'map_canvas') ?>
	<div id="map_canvas" style="width: 304px; height: 280px"></div>
    </td>
    <td>
     <?php  //$this->activateGoogleMap($this->row2, 'map_canvas_2') ?>
 	<div id="map_canvas_2" style="width: 304px; height: 280px"></div>
    </td>
    </tr>
    -->
</table>