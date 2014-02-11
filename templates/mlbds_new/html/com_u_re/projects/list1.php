<form id="ComForm" name="ComForm" action="index.php?option=com_jea&task=compare#" method="get">
		 <h2 class="componentheading">
		 	<span class='componentheading_s'><?php echo JText::_('Danh sách Dự án');?></span>
		 </h2>
<?php
$rowsCount = count( $this->rows );
if($rowsCount <=0 ) // neu khong co du lieu se hien thi uploadting
{
	echo JText::_('UPDATING') ;
}
?>
		
<?php
// if($rowsCount > 0 ) // neu  co du lieu se hien thi phan trang
// {
?>
<!-- 
	 <div id="pagination">
		<?php //echo $this->paging; ?>
		<?php //echo JText::_('Results per page') ?> : <?php //echo $this->pagination->getLimitBox(); ?>
	</div>
-->
<?php
// }
?>
<div class='listproj'>
	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->rows as $item)
	{
		?>
		 <?php 	 
		 	if ( empty( $item['alias'] ) )
		 	{
		 		$item['alias'] = str_replace(' ', '-', $item['ten']);
		 	}
			$itemLink = ilandCommonUtils::getProjectLink(  $item['alias'], $item['id'], $Itemid );
			 //'index.php?option=com_u_re&controller=projects&Itemid=' . $Itemid . 
				//			'&id=' . $item['id'] . '&lang=' . $lang;
		 ?>
		<li id='items-list'>
		<div class='item-project'>
		<div class='hinhduan'>
		 <?php
        if ( is_file( JPATH_ROOT.DS.'images'.DS.'project'.DS.$item['id'].DS.'min.jpg' ) )
        {
        	   echo '<img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" />';
        }
        else
        {
        	echo '<img src="'.JURI::root()."images/NoCamera.jpg".'" />';
        }
        ?>
		</div>
		<div class='list3'>
		<div>
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
			<!--<?php
				if($this->hien_thi_luot_xem == 1)
				{?>
				<div style='float:right'><?php echo JText::_('LUOT_XEM').': '.$item['luot_xem'];?></div>		
			<?php }	?>-->
			
		</div>
				<div class='list-c'><?php echo $item['mo_ta_ngan']?></div>
			  </div>
			  <div class='chi-tiet'>
			   <a href='<?php echo $itemLink;?>' class="readon">
                	<?php echo JText::_('CHI_TIET');?>
                </a>
			  </div>
		
		</div>
		</li>
       
		<?php 
	}
	?>
	</div>
 <div id="pagination">
	<?php echo $this->paging; ?>
</div>

	<input type="hidden" name="option" value="com_u_re" />
	<input type="hidden" name="controller" value="projects" />
	<input type="hidden" name="lang" value="<?php echo JRequest::getInt('lang', 0) ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	<input type="hidden" name="loai_du_an_id" value="<?php echo JRequest::getInt('loai_du_an_id', 0) ?>" />
</form>
 
	