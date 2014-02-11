<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php
 //print_r($duan);
?>

<ul class="menu" >

<?php
// tru ra cat link
foreach($dsduan[3] as $duan){  ?>
	<li class="">
		<!--<a href='index.php?option=com_u_re&controller=projects&id=<?php // echo ($duan['id'].$itemId);?>'>
		<img src="<?php // echo $duan['image']['min_url']?>" /></a>-->
		
		<?php 
		$alias = str_replace(' ', '-', $duan['ten']);
		$itemLink = ilandCommonUtils::getProjectLink( $alias, $duan['id'], 31 );?>
		<a class='' href='<?php echo $itemLink;?>'>
			<?php echo $duan['ten']?>
		</a>
		<!--<div class='des-pro'>
		<?php echo modDS_DuAn::shortDesc($duan['mo_ta_ngan'],150);?>
		</div>-->
	</li>
<?php } ?>
	
	<!-- Nut xem tat ca -->
<!--	<div>
	  <a class='readmore' href='<?php echo $linkViewAll?>'>
	  	Xem tất cả
	  </a>
  	</div>-->
  	<!-- end nut xem tat ca -->
  	
</ul>