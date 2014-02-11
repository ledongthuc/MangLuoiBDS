<?php 
foreach($data as $item)
{
	?>
	
	<div id='items-icon'>
	<div>
	<h3 class='items-link'><a href='<?php echo $item['link']?>'><?php echo $item['tieu_de']?></a></h3>
	</div>
	<div>
	<div class='f-l'>
		<img src=<?php echo $item['image']?>>
	</div>
	<div class=f-r>
			<li class='items-add'><?php echo JText::_('ADDRESS') . ':' . $item['tinh_thanh'] . ',' . $item['quan_huyen']?></li>
			<li class='list-area'><?php echo JText::_('AREA') . ':' . $item['dien_tich_su_dung']?></li>
			<li class='list-date'><?php echo JText::_('DATE_CREATE') . ':' . $item['ngay_dang']?></li>
			<li class='mts'><?php echo JText::_('MA_TS') . ':' . $item['ma_so']?></li>
	</div>
	</div>
	<div class='clear'>
	<span class='items-price'><?php echo $item['tien_te_HTML']?></span>
	</div>
	</div>
	
<?php 	
}
?>
