<form id="ComForm" name="ComForm" action="index.php?option=com_jea&task=compare#" method="get">
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
$Itemid=31;
?>
<div class='listproj'>
<?php if(!empty($this->tphcm)){?>
<div class="listduan">
<h3> Dự án tại TP.HCM</h3>
<?php if(!isset($_GET['tinh_thanh_id'])){?>
<div id="xtc"><a href="index.php?option=com_u_re&controller=projects&tinh_thanh_id=1&Itemid=24">Xem tất cả</a></div>
<?php }?>
<div class='clear duan'>

	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	//$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->tphcm as $item)
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
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" /></a>';
        }
        else
        {
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/NoCamera.jpg".'" /></a>';
        }
        ?>
		</div>
		<div class='list3'>
		
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
		</div>
		</div>
		</li>
       
		<?php 
		
	}?>
	<div class='clear'></div>
</div>
</div>
<?php }?>
<?php if(!empty($this->bd)){?>
<div class="listduan">
<h3>Dự án tại  Bình Dương</h3>
<?php if(!isset($_GET['tinh_thanh_id'])){?>
<div id="xtc"><a href="index.php?option=com_u_re&controller=projects&tinh_thanh_id=16&Itemid=24">Xem tất cả</a></div>
<?php }?>
<div class='clear duan'>

	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	//$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->bd as $item)
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
        	  echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" /></a>';
        }
        else
        {
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/NoCamera.jpg".'" /></a>';
        }
        ?>
		</div>
		<div class='list3'>
		
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
			
		
				
			  </div>
		</div>
		</li>
       
		<?php 
	}
	?>
	<div class='clear'></div>
	</div>
</div>
<?php }?>
<?php if(!empty($this->dn)){?>
<div class="listduan">
<h3> Dự án tại Đồng Nai</h3>
<?php if(!isset($_GET['tinh_thanh_id'])){?>
<div id="xtc"><a href="index.php?option=com_u_re&controller=projects&tinh_thanh_id=27&Itemid=24">Xem tất cả</a></div>
<?php }?>
<div class='clear duan'>

	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	//$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->dn as $item)
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
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" /></a>';
        }
        else
        {
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/NoCamera.jpg".'" /></a>';
        }
        ?>
		</div>
		<div class='list3'>
	
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
		</div>
			 
		
		</div>
		</li>
       
		<?php 
	}
	?>
	<div class='clear'></div>
	</div>
	</div>
	<?php }?>
<?php if(!empty($this->la)){?>
<div class="listduan">
	
<h3> Dự án tại Long AN</h3>
<?php if(!isset($_GET['tinh_thanh_id'])){?>
<div id="xtc"><a href="index.php?option=com_u_re&controller=projects&tinh_thanh_id=46&Itemid=24">Xem tất cả</a></div>
<?php }?>
<div class='clear duan'>

	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	//$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->la as $item)
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
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" /></a>';
        }
        else
        {
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/NoCamera.jpg".'" /></a>';
        }
        ?>
		</div>
		<div class='list3'>
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
			  </div>
			 
		
		</div>
		</li>
       
		<?php 
	}
	?>
	<div class='clear'>
	</div>
	</div>
	</div>
	<?php }?>
<?php if(!empty($this->ctk)){?>
<div class="listduan">
<h3>Các Tỉnh Thành Khác</h3>
<?php if(!isset($_GET['tinh_thanh_id'])){?>
<div id="xtc"><a href="index.php?option=com_u_re&controller=projects&tinh_thanh_id=-1&Itemid=24">Xem tất cả</a></div>
<?php }?>
<div class='clear duan '>
	<?php 
	//$lang = & JRequest::getVar('lang', 'vi');
 	//$Itemid =& JRequest::getVar('Itemid', 31);
 	// $Itemid = '193';
	foreach($this->ctk as $item)
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
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/project/$item[id]/min.jpg".'" /></a>';
        }
        else
        {
        	echo '<a href='.$itemLink.' ><img src="'.JURI::root()."images/NoCamera.jpg".'" /></a>';
        }
        ?>
		</div>
		<div class='list3'>
	
			<h4 class='font13'>
				<a href='<?php echo $itemLink; ?>' ><?php echo $item['ten']?></a>
				
			</h4>
			
		
			
			  </div>
			
		</div>
		</li>
       
		<?php 
	}
	?>
	<div class='clear'>
	</div>
	</div>
	</div>
	<?php }?>
</div>
 <!--<div id="pagination">
	<?php //echo $this->paging; ?>
</div>-->

	<input type="hidden" name="option" value="com_u_re" />
	<input type="hidden" name="controller" value="projects" />
	<input type="hidden" name="lang" value="<?php echo JRequest::getInt('lang', 0) ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	<input type="hidden" name="loai_du_an_id" value="<?php echo JRequest::getInt('loai_du_an_id', 0) ?>" />

</form>
 
	