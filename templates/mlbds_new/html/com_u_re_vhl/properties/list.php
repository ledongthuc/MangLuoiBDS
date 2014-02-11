
<?php 

if ( empty ( $data ) )
{
	$data = $this->data;
}

foreach( $data as $item )
{
	?>
	<div class='list1'>
	<div  class="l-img">
		<img src=<?php echo $item['image']?>>
		<div class=l-mts><?php echo $item['ma_so']?></div>
	</div>
	<div class="l-titile">
		<h3 class='items-link'>
			<a href='<?php echo $item['link']?>'><?php echo $item['tieu_de']?></a>
		</h3>
		<p>
			<li class='list-area'><?php echo JText::_('DIEN_TICH_SU_DUNG') . ':' . $item['dien_tich_su_dung']?></li>
			<li class='list-price'><?php echo JText::_('GIA') . ':'?><span class='items-price'><?php echo $item['tien_te_HTML']?></span></li>
		</p>
	</div>
	<div class="l-date">
		<?php echo $item['ngay_dang']?>
		<?php if ( !empty( $item['noi_bat'] ) )?>
		<img src='<?php echo COM_U_RE_ICON_VIP?>'>
	</div>
	<div class="l-add">
		<li class='items-add'><?php echo $item['dia_chi']?></li>
		<li><?php echo $item['quan_huyen'] . ',' . $item['quan_huyen']?></li>	
	</div>
	
	</div>
	
	<?php 
}
?>
 
	