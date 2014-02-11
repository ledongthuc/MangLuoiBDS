<?php // no direct access
defined('_JEXEC') or die('Restricted access');
include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php'); 
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
include_once "libraries/unisonlib/com_jea_lib.php";
$rowsCount = count( $this->rows );
$altrow = 1;
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
$usergid	= $user->get('gid');
?>
<?php if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<h1><?php echo $this->params->get('page_title') ?></h1>
<?php endif ?>
<br>
<center>
<strong><a href="<?php echo JRoute::_('&Itemid=6&layout=form') ?>"><?php echo JText::_('Add new property' )?></a></strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong><a href="index.php"><?php echo JText::_('back home' ) ?></a></strong>
</center>

<form name="adminForm" id="adminForm" action="<?php echo JRoute::_('') ?>" method="post">
	<input type="text" name="search" size="27px">
	<input type="submit" name="serch_button" value="<?php echo JText::_('serch') ?>"> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
	
	<?php echo  $this->loai_bds ?>
        <select name="published" onchange="document.adminForm.submit();">
            	<option value="-1">- Hiển thị ra ngoài -</option>
            	<option value="1" <?php echo ($this->published==1)?'selected="selected"':''?>>Đang bật</option>
                <option value="0" <?php echo ($this->published==0)?'selected="selected"':''?>>Đang tắt</option>
            </select>
	
	<table class="jea_listing" width="99%" align="center" >
		<thead>
		<tr>
		
			<th class="ref">
					<?php //echo JHTML::_('grid.sort', 'Ref', 'ref', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('TITLE')?>
			</th>
			<th class="ref" width="6%">
					<?php // echo JHTML::_('grid.sort', 'Date Insert', 'date_insert', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('DATE_INSERT')?>
			</th>			
			<th class="type">
					<?php // echo JHTML::_('grid.sort', 'Loại BĐS', 'type', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('PROPERTIES_TYPE')?>
			</th>			
			<th class="price number" width="13%">
					<?php  // echo JHTML::_('grid.sort', 'renting' ? JText::_('Renting price') :  JText::_('Selling price'), 'price', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('PRICE')?>
			</th>
			
			
		<?php 
//		if($usergid > 24)
//		{
//			if($usertype == 'Manager' || $usertype == 'Administrator' || $usertype == 'Super Administrator')
//			echo "<th>".JHTML::_('grid.sort', 'Người Đăng', 'author', $this->order_dir , $this->order )."</th>" ;
//		}
		
		?>
			<th class="published" width="8%"><?php echo JText::_('Published' )?></th>

			<th class="edit"><?php echo JText::_('Delete' )?></th>
	
		</tr>
		</thead>

		<tbody>

<?php foreach ($this->rows as $k => $row): $altrow = $altrow ? 0 : 1 ?>
		<tr class="row<?php echo $altrow ?>" >
			<td class="ref" width="50%">			
					<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&Itemid=8&layout=form&id='.$row['id'] ) ?>" title="<?php echo JText::_('Edit') ?>" > 
						<?php echo $row['loai_giao_dich'].": ".$row['tieu_de'] ?>
					</a>
			</td>
			<td class="date_insert">
			<?php echo date('d-m-Y', $row['ngay_dang']);      ?>
				<?php // echo JHTML::_('date',  $row['ngay_dang'], JText::_('DATE_FORMAT_LC4') ); ?>
				<?php //echo date("d/m/Y",strtotime($row->date_insert));?>
			</td>
			<td class="type"><?php echo $row['loai_bds'] ?></td>	  
			
			<td class="price number">
				<?php	echo  $row['gia'] ;	?>
			</td>
			<td class="published">
			<?php 
			if ( $usergid > 24 )
			{
			?>
				<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&layout=hienthi&Itemid=16&lang=vi&id='.$row['id'] .'&hienthirangoai='.$row['hien_thi_ra_ngoai'] ) ?>" >
				<?php echo $row['hien_thi_ra_ngoai'] ? JHTML::_('image.site', 'publish_g.png', '/administrator/images/') : JHTML::_('image.site', 'publish_r.png', '/administrator/images/')
				?>
				</a>
			<?php 
			}
			else 
			{
			?>
				<a href="#" 
				onclick="alert('<?php echo JText::_('PHAI_DOI_ADMINISTRATOR_DUYEN_TIN' ) ?>')">
				<?php echo $row['hien_thi_ra_ngoai'] ? JHTML::_('image.site', 'publish_g.png', '/administrator/images/') : JHTML::_('image.site', 'publish_r.png', '/administrator/images/')
				?>
				</a>
			<?php 
			}
			?>
			
			</td>
			<td class="delete">
			<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&layout=xoa&Itemid=16&lang=vi&id='.$row['id'] ) ?>" 
			   title="<?php echo JText::_('Delete') ?>"
			   onclick="return confirm('<?php echo JText::_('Are you sure you want to delete this item?') ?>')">
			<?php echo JHTML::_('image.site', 'media_trash.png', '/media/com_jea/images/') ?></a>
			</td>
		</tr>
<?php endforeach ?>
		</tbody>
	</table>
	 <div>
	  <input type="hidden" name="filter_order" value="<?php echo $this->order ?>" />
      <input type="hidden" name="filter_order_Dir" value="<?php echo $this->order_dir ?>" />
	  <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	</div>
	
	<p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?><br />
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p>

</form>
