<?php echo 'danh sach bat dong sanr'?>
<?php 

if ( empty ( $data ) )
{
	$data = $this->data;
}

foreach($data as $item)
{
	?>
	  
	<div id='items-icon2'>
      <div class='checkbox'>
        <input type="checkbox" />
        </div>
        <div class="items-icon2-r">
	<div class="left">
       
<h3 class='items-link'><a href='<?php echo $item['link']?>'><?php echo $item['tieu_de']?></a></h3>
	</div>
        <div class="date-em font11">
        	<?php echo $item['ngay_dang']?>
        </div>
	<div class="clear">
			<li class='items-add'>
                <span class="font11"><?php echo JText::_('DIA_CHI');?></span>
				<?php echo $item['dia_chi']?>
            </li>
			<li class='list-area-icon'>
                <span class="font11"><?php echo JText::_('DIEN_TICH')?></span> 
				<?php echo $item['dien_tich_khuon_vien']?>
              	<li class="list-area-icon">
                	<span class="font11"><?php echo JText::_('MAT_TIEN_RONG')?> </span>
                	<?php echo $item['dien_tich_khuon_vien_rong']?>
              	</li>
            </li>
			<li class='list-date list-area-icon'><span class="font11"><?php echo JText::_('HUONG')?></span><?php echo $item['huong']?></li>
            <li class="list-area-icon">
                <span class="font11"><?php echo JText::_('CHIEU_DAI')?></span>
                <?php echo $item['dien_tich_khuon_vien_dai']?>
            </li>
	</div>
	<div>
	<div class='items-price left'><span class="font11">
		<?php echo JText::_('GIA')?></span><?php echo $item['tien_te_HTML']?></div>
        <span class="date-em"><a href="#" class="readon"><?php echo $item['mo_ta_chi_tiet']?></a></span>
	</div>
        </div>
        <div class="clear"/></div>
	</div>
	
<?php 	
}
?>

 
	