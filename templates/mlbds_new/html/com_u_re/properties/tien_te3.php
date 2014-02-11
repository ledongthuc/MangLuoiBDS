<?php $priceId = 'price' . $this->id . $this->moduleId;?>
<table>
	<tbody>
		<tr>
			<td width="100px" nowrap="nowrap" style="vertical-align: top;">
				<center><strong><font color="red">
					<div id="<?php echo $priceId;?>">
						<strong><?php echo $this->giaChinh;?></strong>
					</div>
				</font></strong></center>
			</td>
			<td nowrap="nowrap" style="vertical-align: top;">
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
					} // end for
				?> 
			</td>
		</tr>
	</tbody>
</table>