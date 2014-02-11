<?php
//print_r($this->rows);
//$rows =$this->rows[3];
//exit;
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
$rowsCount = count( $this->rows ) ;
//print_r($rowsCount);
$altrow = 1;
?>
<form action="index.php?option=com_jea&controller=projects" method="post" name="adminForm" id="adminForm">

<table class="adminheading">
	<tr>
		<td width="100%">
			<label for="search" ><?php echo JText::_('TIM_TIEU_DE'); ?></label> :
			<input type="text" id="search" name="search" size="60" value="<?php echo $this->search ?>" />
			<input type="submit" value="<?php echo JText::_('TIM');?>" />
		</td>
		<td nowrap="nowrap">
			<?php echo JText::_('Filter') ?> :
			<!--<?php echo  $this->type ?>-->
			<?php echo  $this->towns ?>
			<?php echo  $this->areas ?>
            <select name="published" onchange="document.adminForm.submit();">
            	<option value="-1" <?php echo ($this->published)?'selected="selected"':''?>>- Chọn trạng thái -</option>
            	<option value="1" <?php echo ($this->published==1)?'selected="selected"':''?>>Đã được bật</option>
                <option value="0" <?php echo ($this->published==0)?'selected="selected"':''?>>Đã được tắt</option>
            </select>
            <!--<select name="emphasis" onchange="document.adminForm.submit();">
            	<option value="-1">- Nổi bật -</option>
            	<option value="1" <?php echo ($this->emphasis==1)?'selected="selected"':''?>>Có</option>
                <option value="0" <?php echo ($this->emphasis==0)?'selected="selected"':''?>>Không</option>
            </select>-->
            <span id="view_area_dangtin"></span>
            <script type="text/javascript">
		  
		  
	
          </script>
		</td>
	</tr>
</table>

<table class="adminlist">
	<thead>
		<tr>
        <th>#</th>
			<th style="text-align:left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $rowsCount ?>);" /></th>
			
			<th nowrap="nowrap">
				<?php echo JText::_('Name') ?>
			</th>
					
			<th nowrap="nowrap"><?php echo JText::_('Town') ?></th>
			<th nowrap="nowrap"><?php echo JText::_('Area') ?></th>
			
            <th>ID</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="13">
				<del class="container">
					<div class="pagination">
						<div class="limit">
							<?php echo $this->paging ?>
						</div>
					</div>
				</del>
			</td>
		</tr>
	</tfoot>

	<tbody>

	<?php foreach ($this->rows as $k => $row) :?>
	<?php $altrow = ( $altrow == 1 )? 0 : 1; ?>

		<tr class="row<?php echo $altrow ?>">
        <td><?php echo $k+1?></td>

			<td><?php echo JHTML::_('grid.id',$k, $row['id'] ) ?></td>
			<td>
			<?php if ($this->is_checkout($row['id'])) : ?>
			<?php echo $row['ten'] //name ?>
			<?php else : ?>
				<a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit')">
				<?php echo $row['ten'] //short_description ?></a><span>
			<?php endif ?>
			</td>
			
			<td><?php echo $row['tinh_thanh'] //town ?></td>
			<td><?php echo $row['quan_huyen'] // area  ?></td>
            <td><?php echo $row['id'] ?></td>
		</tr>

		<?php endforeach ?>

	</tbody>

</table>

<div>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="ordering" value="ordering" />
	<input type="hidden" name="filter_order" value="<?php echo $this->order ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->order_dir ?>" />
	<input type="hidden" name="limitstart" value="<?php echo $this->limitstart ?>" />
	<?php echo JHTML::_( 'form.token' ) ?>
</div>

</form>

