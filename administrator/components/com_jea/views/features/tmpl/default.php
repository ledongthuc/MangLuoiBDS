<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
$altrow = 1;
?>

<?php
	if ($this->tenBang == 'don_vi_tien')
	{
		include_once('price_units.php');
	}
	else
	{
?>

<form action="index.php?option=com_jea&controller=features" method="post" name="adminForm" id="adminForm" >
<?php
//echo $this->chonDanhSachBDS;
//echo $this->paging;
?>

<table class="adminheading">
	<tr>
		<td width="100%">
		<?php echo JText::_('DANHMUC') ?> : <?php echo $this->chonDanhSachBDS ?>
		<?php 
			if($this->tenBang == 'quan_huyen') {
				echo JText::_('TOWN').$this->tinh_thanh;
			}else{
				if($this->tenBang == 'phuong_xa' || $this->tenBang == 'duong_pho'  ){
					echo JText::_('TOWN').$this->tinh_thanh;
					echo JText::_('AREA').$this->quan_huyen;					
				}
				/*else{
					if($this->tenBang == 'tien_ich'){
						echo JText::_('loai_tien_ich').$this->loai_tien_ich;
					}
				}*/
			}
		 ?>
		</td>		
	</tr>
</table>

<table class="adminlist">
	<thead>
		<tr>
			<th width="1%" class="title">#</th>
			<th width="2%">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $this->tongDong ?>);" />
			</th>
			
			<th nowrap="nowrap" width="100%" ><?php echo JText::_('Value') ?></th>

			
			<th nowrap="nowrap"  colspan="4" >
	        	<?php echo JText::_( 'ORDERING' ); ?>
	        </th>
			<th width="1%" class="title">ID</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="6">
				<del class="container">
					<div class="pagination">
						<div class="limit">
							<?php //echo JText::_('Items per page')?> :&nbsp;&nbsp;
							<?php //echo $this->pagination->getLimitBox() ?>&nbsp;&nbsp;
						</div>
						<?php //echo $this->pagination->getPagesLinks() ?>
						<div class="limit"><?php //echo $this->pagination->getPagesCounter() ?></div>
					</div>
				</del>
			</td>
		</tr>
	</tfoot>

	<tbody>

<?php
 if( $this->tenBang == 'tien_ich' )
 { 
 ?>
 
		<?php foreach ( $this->rows as $k => $row ) :?>
		
		<?php $altrow = ( $altrow == 1 )? 0 : 1; ?>
		
				<tr class="row<?php echo $altrow ?>">
				    <td><?php echo $k+1 ?></td>
				    <?php //echo JHTML::_('grid.ten', $k, $row['ten'] ) ?>
					<td><?php echo JHTML::_('grid.id', $k, "$row[id]@#$%^$row[ten_tien_ich]") ?></td>
		<!--			<td><?php //echo JHTML::_('grid.newid', $k, "$row[id]@#$%^$row[ten]" , 'vi') ?></td>-->
					<td nowrap="nowrap"><a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit') "><?php echo $row['ten_tien_ich'] ?></a></td>
					<td align="center"><?php echo $this->pagination->orderUpIcon( $k ) ?></td>
					<td align="center"><?php  echo $this->pagination->orderDownIcon( $k, $this->tongDong ) ?></td>
					
					
					<td>
						<input type="text" style="width:35px" value="<?php echo $row['ordering'] ?>" name="ordering_<?php echo $row['id']?>" />
					</td>
					<td>
						 <a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','ordering')">
			        		<img src="../images/filesave.png"  style="cursor:pointer" />
			       		 </a>
					</td>
					
		            <td align="center"><?php echo $row['id']?></td>
				</tr>
				
		<?php endforeach ?>
<?php 
 }
 else 
 {
 ?>
 		<?php foreach ( $this->rows as $k => $row ) :?>
		
		<?php $altrow = ( $altrow == 1 )? 0 : 1; ?>
		
				<tr class="row<?php echo $altrow ?>">
				    <td><?php echo $k+1 ?></td>
				    <?php //echo JHTML::_('grid.ten', $k, $row['ten'] ) ?>
					<td><?php echo JHTML::_('grid.id', $k, "$row[id]@#$%^$row[ten]") ?></td>
		<!--			<td><?php //echo JHTML::_('grid.newid', $k, "$row[id]@#$%^$row[ten]" , 'vi') ?></td>-->
					<td nowrap="nowrap"><a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit') "><?php echo $row['ten'] ?></a></td>
					<td align="center"><?php echo $this->pagination->orderUpIcon( $k ) ?></td>
					<td align="center"><?php  echo $this->pagination->orderDownIcon( $k, $this->tongDong ) ?></td>
					
					
					<td>
						<input type="text" style="width:35px" value="<?php echo $row['ordering'] ?>" name="ordering_<?php echo $row['id']?>" />
					</td>
					<td>
						 <a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','ordering')">
			        		<img src="../images/filesave.png"  style="cursor:pointer" />
			       		 </a>
					</td>
					
		            <td align="center"><?php echo $row['id']?></td>
				</tr>
				
		<?php endforeach ?>
 <?php 
 }
 ?>


<?php //foreach ( $this->rows2 as  $rowen ) :?>
<!--	<input type="hidden" name="<?php //echo "en".$rowen['id']; ?>"  value="<?php //echo $rowen['ten'];?>" />-->
<?php //endforeach ?>

	</tbody>

</table>

<div>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="limitstart" value="<?php echo $this->limitstart ?>" />
	<input type="hidden" id="ten_tien_ich" name="ten_tien_ich" value="" />
	<input type="hidden" id="tinh_thanh_id" name="tinh_thanh_id" value="<?php echo $this->townId ?>" />
	<?php echo JHTML::_( 'form.token' ) ?>
</div>

</form>
<?php
	} // end else
?>
<script language="javascript">
	function test()
	{
		var jsten_tien_ich = document.getElementById("loai_tien_ich");
		// alert(jsten_tien_ich);
		if ( jsten_tien_ich != 0 )
		{
		//	alert(jsten_tien_ich);
			// townidvalue = jstown_id.options[jstown_id.selectedIndex].text;
			ten_tien_ich = jsten_tien_ich.options[jsten_tien_ich.selectedIndex].text;
			document.getElementById("ten_tien_ich").value = ten_tien_ich;
			// alert(ten_tien_ich);
		}
	}
</script>