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
<!--<link rel="stylesheet" href="components/com_jea/views/properties/tmpl/js/dhtmltooltip.css" type="text/css">
<script type="text/javascript" src="components/com_jea/views/properties/tmpl/js/dhtmltooltip.js"></script>  -->

<?php if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<h1><?php echo $this->params->get('page_title') ?></h1>
<?php endif ?>
<br>
<center>
<strong><a href="<?php echo JRoute::_('&Itemid=6&layout=form') ?>"><?php echo JText::_('Add new property' )?></a></strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong><a href="index.php"><?php echo JText::_('back home' ) ?></a></strong>
</center>
<?php //if( !empty($this->rows) ) : ?>

<form name="adminForm" id="adminForm" action="<?php echo JRoute::_('') ?>" method="post">

	<p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?><br />
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p>
	
	<p class="limitbox"><em><?php echo JText::_('Results per page') ?> : </em><?php echo $this->pagination->getLimitBox() ?></p>
	
	<p>
	
	
	<input type="text" name="keyserch" size="35px">
	<input type="submit" name="serch" value="<?php echo JText::_('serch') ?>"> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
    	<select name="cat" onchange="document.adminForm.submit();" class="inputbox" size="1" style="margin-left:3px">
    	   <option value="-1">--<?php echo JText::_('Filter') ?>--</option>    	  
    	   <option value="1" <?php if($this->cat == 1) echo 'selected="selected"' ?>><?php echo JText::_('Selling') ?></option>
		    <option value="2" <?php if($this->cat == 2) echo 'selected="selected"' ?>><?php echo JText::_('Renting') ?></option>
    	   <option value="3" <?php if($this->cat == 3) echo 'selected="selected"' ?>><?php echo JText::_('Needbuying') ?></option>
    	    <option value="4" <?php if($this->cat == 4) echo 'selected="selected"' ?>><?php echo JText::_('Needrenting') ?></option>
    	</select>  	
    	    	
        <select name="published" onchange="document.adminForm.submit();">
            	<option value="-1">- Hiển thị ra ngoài -</option>
            	<option value="1" <?php echo ($this->published==1)?'selected="selected"':''?>>Đang bật</option>
                <option value="0" <?php echo ($this->published==0)?'selected="selected"':''?>>Đang tắt</option>
            </select>
        <?php echo $this->getHtmlList('types',$this->type_id,true);?>
	</p>
	
	<table class="jea_listing" width="99%" align="center" >
		<thead>
		<tr>
		
			<th class="ref"><?php echo JHTML::_('grid.sort', 'Ref', 'ref', $this->order_dir , $this->order ) ?></th>
			<th class="ref" width="6%"><?php echo JHTML::_('grid.sort', 'Date Insert', 'date_insert', $this->order_dir , $this->order ) ?></th>			
			<th class="type"><?php echo JHTML::_('grid.sort', 'Loại BĐS', 'type', $this->order_dir , $this->order ) ?></th>			
<!--			<th class="type" width="8%"><?php echo JHTML::_('grid.sort', 'Loại Tin', 'is_renting', $this->order_dir , $this->order ) ?></th>-->
		<!--	<th class="adress"><?php //echo JText::_('Adress' )?></th>
			 <th class="town"><?php //echo JHTML::_('grid.sort', 'Town', 'town', $this->order_dir , $this->order ) ?></th> 
			<th class="land_space number"><?php //echo JHTML::_('grid.sort', 'Quận Huyên', 'area', $this->order_dir , $this->order ) ?></th> 
			<th class="living_space number"><?php //echo JHTML::_('grid.sort', 'DT', 'living_space', $this->order_dir , $this->order ) ?></th>  -->
			
			<th class="price number" width="13%"><?php echo JHTML::_('grid.sort', 'renting' ? JText::_('Renting price') :  JText::_('Selling price'), 'price', $this->order_dir , $this->order ) ?></th>
			
			
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
<?php 
	switch($row->kind_id)
				{
					case 1 : $typeloai="Cần bán";
					break;
					case 2 : $typeloai="Cho thuê";
					break;
					case 3 : $typeloai="Cần mua";
					break;
					case 4 : $typeloai="Cần thuê";
					break;
					default: $typeloai="Cần bán";
					break;					
				}
?>
		<tr class="row<?php echo $altrow ?>" >
			<td class="ref" width="50%">
			
			<span onmouseover="showttip( '<table width=100% border=\'0\' cellpadding=5 cellspacing=0><tr><td colspan=2><strong><?php echo $row->ref; ?></strong></td></tr><tr><?php if(is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' )) {?> <td  valign=top width=1px><img src=<?php echo JURI::root()."images/com_jea/images/$row->id/min.jpg"; ?>  /> </td><?php }  ?><td valign=top><?php echo removetag($row->description); ?></td></tr></table>');" onmouseout="hidettip();">
			
			<a href="<?php echo JRoute::_( 'index.php?option=com_jea&view=manage&layout=form&id='.$row->id ) ?>" title="<?php echo JText::_('Edit') ?>" > 
			<?php echo $typeloai.": ".$row->ref ?></a>
			</span>
			
			</td>
			<td class="date_insert"><?php echo date("d/m/Y",strtotime($row->date_insert));?></td>
			<td class="type"><?php echo $row->type ?></td>	  
			
			<td class="price number">
			<?php	
			
			switch($row->price_unit)
				{
					case "USD" : $donvitien="USD";
					break;
					case "VND" : $donvitien="";
					break;
					case "SJC" : $donvitien="lượng";
					break;
					default: $donvitien="";
					break;					
				}
						switch($row->price_area_unit)
				{
					case "m2" : $donvidat="/m<sup>2</sup>";
					break;
					case "Nguyên căn" : $donvidat="";
					break;
					case "Tháng" : $donvidat="/tháng";
					break;
					default: $donvidat="";
					break;					
				}			
					$ddgia=reFormatPrice($row->price,$row->price_unit);
				if($row->price > 0)
				{
					$hientien = trim($ddgia.$donvitien).$donvidat;		
				}
				else
				{
					$hientien= "Thương lượng";
				}
		
				echo $hientien;				
		?>
			
			
					
			</td>
			<?php 
//				if($usergid > 24)
//					{
//					
//						if($usertype == 'Manager' || $usertype == 'Administrator' || $usertype == 'Super Administrator')
//							{
//								if($row->author_id==0)
//								{
//									echo "<td><span onmouseover=\"showttip( '<table><tr><td width=20% valign=left>Tên</td><td >$row->name_vl</td></tr><tr><td>Địa chỉ</td><td>$row->address_vl</td></tr><tr><td>Điện thoại</td><td>$row->phone_vl</td></tr></table>');\" onmouseout=\"hidettip();\">$row->author</span></td>" ; 
//								}
//								else
//								{
//									echo "<td>$row->author</td>" ; 
//								}
//						
//							}
//					}	
			?>
		
			<td class="published"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $row->id ?>','unpublish')"><?php echo $row->published ? JHTML::_('image.site', 'publish_g.png', '/administrator/images/') : JHTML::_('image.site', 'publish_r.png', '/administrator/images/') ?></a></td>
			<td class="delete">
			<a href="<?php echo JRoute::_( 'index.php?option=com_jea&task=delete&id='.$row->id ) ?>" 
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

<?php //endif ?>