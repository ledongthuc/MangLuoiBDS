<form id="ComForm" name="ComForm" action="index.php?option=com_jea&task=compare#" method="get">
		 <h2 class="componentheading">
		 	<?php echo JText::_('Danh sách dự án');?>
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
	<?php 
	foreach($this->rows as $item)
	{
		?>
		 <?php 	 $Itemid =& JRequest::getVar('Itemid', 31);    ?>
		<div id='items-list'>
		<div class='item-project'>
		<a href='index.php?option=com_u_re&controller=projects&Itemid=<?php echo $Itemid ?>&id=<?php echo $item['id']?>' ><?php echo $item['ten']?></a>
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
			  <li class='list3'>
				<?php echo $item['mo_ta_ngan']?>
			  </li>
			  <li class='chi-tiet'>
			   <a href="index.php?option=com_u_re&controller=projects&Itemid=<?php echo $Itemid ?>&id=<?php echo $item['id']?>" class="readon">
                	<?php echo JText::_('CHI_TIET');?>
                </a>
			  </li>
		
		</div>
		</div>
        <div class='clear'></div>
		<?php 
	}
	?>
 <div id="pagination">
	<?php echo $this->paging; ?>
</div>

	<input type="hidden" name="option" value="com_u_re" />
	<input type="hidden" name="controller" value="projects" />
	<input type="hidden" name="lang" value="<?php echo JRequest::getInt('lang', 0) ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	<input type="hidden" name="loai_du_an_id" value="<?php echo JRequest::getInt('loai_du_an_id', 0) ?>" />
</form>
 
	