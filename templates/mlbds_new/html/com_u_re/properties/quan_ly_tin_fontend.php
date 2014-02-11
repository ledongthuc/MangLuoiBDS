<?php
defined('_JEXEC') or die('Restricted access');
include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php'); 
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
include_once "libraries/unisonlib/com_jea_lib.php";
$rowsCount = count( $this->rows );
$altrow = 1;
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
$usergid	= $user->get('gid');
$userapproved = $user->get('approved');

?>
<script>
// FORMAT CURRENCY
function fmoney(num){ 
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
			cents = "0" + cents;
			for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+','+
			num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') +num);
}
</script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/jstab.js"></script>

<script type="text/javascript" src="<?php echo JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick.min.1.3.js"></script>
<div class='quanlitin'>
<?php if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<h1><?php echo $this->params->get('page_title') ?></h1>
<?php endif ?>
<div class="componentheading">
	Quản lý tin
</div>
<form name="adminForm" id="adminForm" action="<?php echo JRoute::_('') ?>" method="post">
	<ul class='adminbutton'>
		<li>
		<a class='button' href="<?php echo JRoute::_('&Itemid=224&layout=form') ?>"><?php echo JText::_('Add new property' )?></a></strong>
	
		</li>
		
		<li style="margin-top: 5px;margin-left: 8px;margin-right: 6px;">
			<input type="text" name="search" class='input-s1'>
		</li>
		<li>
		<input type="submit" class='button' name="serch_button" value="<?php echo JText::_('TIM_KIEM') ?>">
		</li>
	<li  style="margin-right: 10px;margin-left: 10px;">
	<?php echo  $this->loai_bds ?>
    </li>
	<li>	
	    <select class='input-s' name="published" onchange="document.adminForm.submit();">
            	<option value="-1">- Hiển thị ra ngoài -</option>
            	<option value="1" <?php echo ($this->published==1)?'selected="selected"':''?>>Đang bật</option>
                <option value="0" <?php echo ($this->published==0)?'selected="selected"':''?>>Đang tắt</option>
        </select>
	</li>
	</ul>
<?php 
if ( count($this->rows) == 0 )
{
	echo "<br/>";
	 echo JText::_('CHUA_CO_DU_LIEU' ) ;
	return ;
}
?>
	<table class="jea_listing contentpane" width="99%" align="center" >
		<thead>
		<tr>
		
			<th>
					<?php //echo JHTML::_('grid.sort', 'Ref', 'ref', $this->order_dir , $this->order ) ?>
					<?php echo 'Mã tin'; ?>
			</th>
			<th class="ref">
					<?php //echo JHTML::_('grid.sort', 'Ref', 'ref', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('TITLE'); ?>
			</th>
			<th class="type" width="100px">
					<?php // echo JHTML::_('grid.sort', 'Loại BĐS', 'type', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('Hẹn giờ'); ?>
			</th>						
			
		<?php 
//		if($usergid > 24)
//		{
//			if($usertype == 'Manager' || $usertype == 'Administrator' || $usertype == 'Super Administrator')
//			echo "<th>".JHTML::_('grid.sort', 'Người Đăng', 'author', $this->order_dir , $this->order )."</th>" ;
//		}
		
		?>
			<!--<th class="ref">
					<?php echo JText::_('LUOT_XEM')?>
			</th>-->
			<th class="ref" width="80px">
					<?php // echo JHTML::_('grid.sort', 'Date Insert', 'date_insert', $this->order_dir , $this->order ) ?>
					<?php echo JText::_('DATE_INSERT')?>
			</th>	
			<th class="published" width="30px"><?php echo JText::_('Published' )?></th>
			<th class="edit" width="30px"><?php echo JText::_('Delete' )?></th> 	
		</tr>
		</thead>

		<tbody>

<?php foreach ($this->rows as $k => $row): $altrow = $altrow ? 0 : 1 ?>
		<tr class="row<?php echo $altrow ?>" >
			<td>
						<?php echo $row['id'] ?>
			</td>
			<td class="ref">			
					<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&Itemid=224&layout=form&id='.$row['id'] ) ?>" title="<?php echo JText::_('Edit') ?>" > 
						<?php echo $row['tieu_de'] ?>
					</a>
			</td> 
			<td class="daytin">	
				<input type="button" class="sb_ck3" onclick="hen_gio_non_user(<?php echo $row['id'] ?>)" value="ĐẨY | ĐÁNH DẤU | NỔI BẬT TIN NÀY"> 		
			</td>	  
			<!--<td class="published">				
				 <?php echo $row['luot_xem'];      ?>				
			</td>-->
			<td class="date_insert">
				<?php // echo $row['ngay_dang']?>
				 <?php echo date('d-m-Y', $row['ngay_dang']);      ?>
				<?php // echo JHTML::_('date',  $row['ngay_dang'], JText::_('DATE_FORMAT_LC4') ); ?>
				<?php //echo date("d/m/Y",strtotime($row->date_insert));?>
			</td>
			<td class="published">
			<?php 
			if ( $usertype == "Administrator" || $usertype == "Super Administrator" ) 
			{
			?>
				<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&layout=hienthi&Itemid=8&lang=vi&id='.$row['id'] .'&hienthirangoai='.$row['hien_thi_ra_ngoai'] ) ?>" >
				<?php echo $row['hien_thi_ra_ngoai'] ? JHTML::_('image.site', 'tick.png', '/administrator/images/') : JHTML::_('image.site', 'publish_x.png', '/administrator/images/')
				?>
				</a>
			<?php 
			}
			else 
			{
			?>
				<a href="javascript:;" 
				onclick="alert('<?php echo JText::_('BAN_KHONG_CO_QUYEN' ) ?>')">
				<?php echo $row['hien_thi_ra_ngoai'] ? JHTML::_('image.site', 'tick.png', '/administrator/images/') : JHTML::_('image.site', 'publish_x.png', '/administrator/images/')
				?>
				</a>
			<?php 
			}
			?>
			
			</td>
			<td class="delete"> 
			<a href="<?php echo JRoute::_( 'index.php?option=com_u_re&view=manage&layout=xoa&Itemid=8&lang=vi&id='.$row['id'] ) ?>" 
			   title="<?php echo JText::_('Delete') ?>"
			   onclick="return confirm('<?php echo JText::_('BAN_CHAC_CHAN_XOA_TIN_NAY') ?>')">
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
</div>
<?php include 'hen_gio_user.php'; ?>  
<script language="javascript">
	initalizetab("tabpoppu"); 
	initalizetab("tabpoppu2");
</script>