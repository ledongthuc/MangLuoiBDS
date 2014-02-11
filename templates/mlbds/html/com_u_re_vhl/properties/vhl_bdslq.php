<?php 

if ( empty ( $data ) )
{
	$data = $this->data;
}

foreach( $data as $item )
{
	?><!--
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
			<li class='list-area'><?php echo JText::_('LIVING_SPACE') . ':' . $item['dien_tich_su_dung']?></li>
			<li class='list-price'><?php echo JText::_('PRICE') . ':'?><span class='items-price'><?php echo $item['tien_te_HTML']?></span></li>
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
	
	</div>-->
	
	<!-- LAYOUT -->
	<div class='items-icon2'>
	
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
<div class="items-icon2-r">
	<div class="left">
		<h4 class='items-link'>
			<a href='<?php echo $item['link']?>' >
				<?php echo $item['tieu_de']?>
			</a>
		</h4>
	</div>
        <div class="date-em font11" >
        	<?php echo date('d-m-Y', $item['ngay_dang']);      ?>
        	<?php if ( !empty( $item['noi_bat'] ) )?>
		<img src='<?php echo COM_U_RE_ICON_VIP?>'>
        </div>
	<div>
		<li class='items-add'>
            
            <div id="dia_chi<?php echo $item['id']?>">
				<span class="font11">
                <?php echo JText::_('DIA_CHI')?>
            </span><?php echo $item['dia_chi']?>
			</div>
        </li>
		<li class='list-area-icon'>
            <span class="font11"><?php echo JText::_('DIEN_TICH')?></span> 
			<?php echo $item['dien_tich_khuon_vien']?>
        	<li class="list-area-icon">
            <span class="font11"><?php echo JText::_('MAT_TIEN_RONG')?> </span>
			<?php echo $item['dien_tich_khuon_vien_rong']?>
         	</li>
        </li>
		<li class='list-date list-area-icon'>
			<span class="font11"><?php echo JText::_('HUONG')?></span>
			<?php echo $item['huong']?>
		</li>
        <li class="list-area-icon">
	        <span class="font11"><?php echo JText::_('CHIEU_DAI')?> </span>
			<?php echo $item['dien_tich_khuon_vien_dai']?>
        </li>
	</div>
	<div>
		<div class='items-price left'><!--
			<span class="font11"><?php echo JText::_('GIA')?></span>
			--><?php echo $item['tien_te_HTML']?>
		</div>
        <span class="date-em">
        	<a href="<?php echo $item['link']?>" class="readon"	>
        		<?php echo JText::_('CHI_TIET')?>
        	</a>
        </span>
	</div>
       
	</div>	
	 <div class="clear"/></div>
</div>
	<!-- LAYOUT -->
	
	<div class='clear'></div>
	<?php 
}
?>
 
	