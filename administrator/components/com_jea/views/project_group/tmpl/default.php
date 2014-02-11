<?php
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
$rowsCount = count( $this->rows ) ;
$altrow = 1;
?>

<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
        <th width="1%" class="title">#</th>
        <th width="2%"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
        <th width="100%"> <?php echo JText::_( 'Loại Dự Án' ); ?> </th>
        <!--
        <th nowrap="nowrap">
        <?php echo JText::_( 'PUBLISHED' ); ?>
        </th>
        -->
       <th nowrap="nowrap"  colspan="4" >
        <?php echo JText::_( 'ORDERING' ); ?>
        </th>
        <th width="1%">  <?php echo JText::_( 'ID' ); ?> </th>
        </tr>
    </thead>
    <tfoot>
		<tr>
			<td colspan="6">
				<del class="container">
					<div class="pagination">
						<div class="limit">
							<?php //echo JText::_('Items per page')?> &nbsp;&nbsp;
							<?php //echo $this->paging ?>&nbsp;&nbsp;
						</div>
						<?php //echo $this->pagination->getPagesLinks() ?>
						<div class="limit"><?php //echo $this->pagination->getPagesCounter() ?></div>
					</div>
				</del>
			</td>
		</tr>
	</tfoot>
<tbody>
<?php foreach ( $this->rows as $k => $row ) :?>

<?php $altrow = ( $altrow == 1 )? 0 : 1; ?>

		<tr class="row<?php echo $altrow ?>">
		    <td><?php echo $k+1 ?></td>
			<td><?php echo JHTML::_('grid.id', $k, $row['id'] ) ?></td>
			
			<td nowrap="nowrap">
			<a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','edit')">
			<?php echo $this->escape( $row['ten'] /* value */ ) ?>
			</a>
			</td>
            <!--
            <td align="center">
	           <?php
			//	$task 	= $row[2] ? 'unpublish' : 'publish';
				?>
				<a href="#" onclick="return listItemTask('cb<?php //echo $k ?>','<?php //echo $task ?>')">
				<img src="images/<?php //echo ( $row[2] ) ? 'tick.png' : 'publish_x.png';?>"
				width="16" height="16" border="0" alt="<?php //echo $row[2] ? JText::_('Yes') : JText::_('No') ?>" />
				</a>
            </td>
             -->
        	</td>
			<td align="center"><?php  echo $this->pagination->orderUpIcon( $k ) ?></td>

			<td align="center"><?php echo $this->pagination->orderDownIcon( $k, $rowsCount ) ?></td>
			<td>
			<input type="text" style="width:35px" value="<?php echo $row['ordering'] ?>" name="ordering_<?php echo $row['id']?>" />
			</td>
			<td>
				 <a href="#edit" onclick="return listItemTask('cb<?php echo $k ?>','ordering')">
	        		<img src="../images/filesave.png"  style="cursor:pointer" />
	       		 </a>
			</td>
			
            <td align="center"><?php echo $row['id'] /* Id */ ?></td>
		</tr>
		
<?php endforeach ?>
</tbody>
    </table>
</div>
 
<input type="hidden" name="option" value="com_jea" />
<input type="hidden" name="controller" value="project_group" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<!-- <input type="hidden" name="ordering" value="ordering" />
<input type="hidden" name="filter_order" value="<?php //echo $this->order ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php //echo $this->order_dir ?>" />-->
<!--<input type="hidden" name="limitstart" value="<?php echo $this->limitstart ?>" />-->

<?php echo JHTML::_( 'form.token' ) ?>
</form>