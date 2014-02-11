<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(); ?>modules/mod_DS_DuAn/css/default.css" />
<div class="mod_dsduan">
	<ul>
	<?php
		foreach($dsduan[3] as $duan){
			if($ma_duan==$duan['id'])
				$hien_tai="duan_active";
			else
				$hien_tai="duan_inactive";
	?>
			<li class="<?php echo $hien_tai?>">
				<a href='index.php?option=com_u_re&controller=projects&id=<?php echo ($duan['id'].$itemId);?>'>
					<?php echo $duan['ten']?>
				</a>
			</li>			
	<?php }	?>
	</ul>
</div>
