<?php 
if ( empty ( $data ) && !empty( $this->data ) )
{
	$data = $this->data;
}

if ( empty( $data ) && empty( $this->data ) )
{
	echo JText::_('KHONG_TIM_THAY');
}
else 
{
	?>
	<!-- PAGING -->
	<?php if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
	<div id="ajax_paging_<?php echo $contentElementId?>" class="ajax_paging">
		<?php echo $ajaxPaging;?>
	</div>
	
<?php 
	foreach( $data as $item )
	{
		
		?>
		
		<!-- LAYOUT -->
		<div class='items-icon2'>
	<div class="items-icon2-l">
		<div class="left">
			<h4 class='items-link'>
				<a href='<?php echo $item['link']?>' >
					<?php echo $item['tieu_de']?>
				</a>
			</h4>
		</div>
	        <div class="date-em font11" >
	        	<?php echo $item['ngay_dang'];?>
	        	<?php 
					if ( !empty($item['noi_bat']) && $item['noi_bat']=='1' )
						echo "<img src='".COM_U_RE_ICON_VIP."'/>";					
				?>
	        </div>
		<div>
		<div>
		<li class='items-add'>
	            
	            <div id="dia_chi<?php echo $item['id']?>">
					<span class="font11">
	                <?php if ( empty($titleStrings) ) {echo JText::_('DIA_CHI');}
                		else {echo $titleStrings['DIA_CHI'];}?>
	            </span><?php echo $item['dia_chi']?>
				</div>
	        </li>
			<li class='list-area-icon'>
	            <span class="font11"><?php if ( empty($titleStrings) ) {echo JText::_('DIEN_TICH');}
										else {echo $titleStrings['DIEN_TICH'];}?></span> 
				<?php
					if ( $item['dien_tich_khuon_vien'] == 0 )
					{
						echo "_";
					}
					else 
					{
						echo $item['dien_tich_khuon_vien']." m<sup>2</sup>";
					}
				?>
	        </li>
	        <li class="list-area-icon">
	            <span class="font11"><?php if ( empty($titleStrings) ) {echo JText::_('CHIEU_RONG');}
										else {echo $titleStrings['CHIEU_RONG'];}?> </span>
				<?php
					if ( $item['dien_tich_khuon_vien_rong'] == 0 )
					{
						echo "_";
					}
					else 
					{
						echo $item['dien_tich_khuon_vien_rong']." m";
					}
				?>
         	</li>
		</div>
		<div class='clear'>
		<li class='list-date list-area-icon'>
				<span class="font11"><?php if ( empty($titleStrings) ) {echo JText::_('HUONG');}
										else {echo $titleStrings['HUONG'];}?></span>
				<?php
					if ( $item['huong'] == '' || strlen($item['huong'])==(strlen('Hướng')-1))
					{
						echo "_";
					}
					else 
					{
						echo $item['huong'];
					}
				?>
			</li>
	        <li class="list-area-icon">
		        <span class="font11"><?php if ( empty($titleStrings) ) {echo JText::_('CHIEU_DAI');}
										else {echo $titleStrings['CHIEU_DAI'];}?>  </span>
				<?php
					if ( $item['dien_tich_khuon_vien_dai'] == 0 )
					{
						echo "_";
					}
					else 
					{
						echo $item['dien_tich_khuon_vien_dai']." m";
					}
				?>
	        </li>
		</div>
			
			
		</div>
		<div class='clear'>
			<div class='items-price left'>
				<li class='gia'>
				<span class="font11"><?php if ( empty($titleStrings) ) {echo JText::_('GIA');}
										else {echo $titleStrings['GIA'];}?></span>
				</li>
				<li><?php echo $item['tien_te_HTML']?></li>
				
			</div>
	        <span class="date-em">
	        	<a href="<?php echo $item['link']?>" class="readon"	>
	        		<?php if ( empty($titleStrings) ) {echo JText::_('CHI_TIET');}
										else {echo $titleStrings['CHI_TIET'];}?>
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
<?php }?>
 
	