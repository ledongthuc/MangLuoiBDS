<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

//print_r($this->rows);
//exit;
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
$rowsCount = count( $this->rows ) ;
$altrow = 1;
include_once('libraries/js/ham-tien-ich-php.php');
?>


<form action="index.php?option=com_jea&controller=realtors" method="post" name="adminForm" id="adminForm">

<table class="adminheading">
	<tr>
		<td width="100%">
			<label for="search" ><?php echo JText::_('Find reference') ?></label> : 
			<input type="text" id="search" name="search" size="8" value="<?php // echo $this->search ?>" /> 
			<input type="submit" value="ok" />
		</td>
		<td nowrap="nowrap">
			<?php echo JText::_('Filter') ?> : 
            <select name="published" onchange="document.adminForm.submit();">
            	<option value="-1" <?php echo ($this->hien_thi)?'selected="selected"':''?>>- Chọn trạng thái -</option>
            	<option value="1" <?php echo ($this->hien_thi==1)?'selected="selected"':''?>>Đã được bật</option>
                <option value="0" <?php echo ($this->hien_thi==0)?'selected="selected"':''?>>Đã được tắt</option>
            </select>
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
			</th>
			<th nowrap="nowrap"><?php echo JText::_('email') ?></th>	
			<th nowrap="nowrap"><?php echo JText::_('Address') ?></th>		
			<th nowrap="nowrap"><?php echo JText::_('Operational_range') ?></th>	
			<th nowrap="nowrap">
				<?php echo JText::_('Published') ?>
			</th>
			
			<!-- 
			<th colspan="2" nowrap="nowrap">
				<?php echo JText::_('Ordering') ?>
			</th>
			-->
            <th>ID</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="13">
				<del class="container">
					<div class="pagination">
						<div class="limit">
							<?php echo JText::_('Items per page')?> :&nbsp;&nbsp;
							<?php echo $this->paging ?>&nbsp;&nbsp;
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

			<td>
				<?php echo JHTML::_('grid.id', $k, $row['id'] ) ?></td>
			</td>

			<td>
			<?php //if ($this->is_checkout($row['dang_chinh_sua'])) : ?>
			<?php //echo $this->escape( $row['ten'] ) ?>
			<?php //else : ?>
				<a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit')">
				<?php echo  $row['ten'] ?></a>
			<?php //endif ?>
			</td>
			<td><?php echo $this->escape( $row['email'] ) ?></td>
			<td><?php echo $this->escape( $row['dia_chi'] ) ?></td>
			<td><?php echo $this->escape( $row['pham_vi_hoat_dong'] ) ?></td>				            


			<td align="center">
				<?php $task_publish 	= $row['hien_thi_ra_ngoai'] ? 'unpublish' : 'publish';		?>
				<a href="#" onclick="return listItemTask('cb<?php echo $k ?>','<?php echo $task_publish ?>')">
					<img src="images/<?php echo ( $row['hien_thi_ra_ngoai'] ) ? 'tick.png' : 'publish_x.png';?>"
					width="16" height="16" border="0" alt="<?php echo $row['hien_thi_ra_ngoai'] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
			</td>



<!-- 
			<td align="center"><?php  echo $this->pagination->orderUpIcon( $k ) ?></td>

			<td align="center"><?php echo $this->pagination->orderDownIcon( $k, $this->tongDong ) ?></td>
 -->
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
