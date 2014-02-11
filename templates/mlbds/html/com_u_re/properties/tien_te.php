<?php $priceId = 'price' . $this->id . $this->moduleId;?>

<div class='items-add'>
	<span class="tiente_bds" >
			<strong>
				<div id="<?php echo $priceId;?>">
					<?php echo $this->giaChinh;?>
				</div>
			</strong>
	</span>
</div>

<div>
<?php 

					foreach ( $this->giaArr as $key => $value )
					{
					?> 
						<div <?php //if ( $this->donViTien[$i]['ten'] == $this->donViTienChinh ) 
						if ( $key == $this->donViTienChinh )
						{
							echo 'class="tien_te"';
							$classActive = 'ac';
						}
						else 
						{
							echo 'class="tien_te"';
							$classActive = '';
						}
						 ?>>
							<a href="javascript:changePrice( '<?php echo $this->giaArr[$key];?>',
															'<?php echo $this->id . $this->moduleId;?>',
															'<?php echo $key;?>',
															'ac',
															'<?php echo $this->don_vi_dien_tich_id;?>',
															''
															) " 
								class="<?php echo $classActive?>" id="<?php echo $key . $this->id . $this->moduleId;?>">
								<?php echo $key;?>
							</a>
						</div>
				<?php
					} 
				?> 
</div>