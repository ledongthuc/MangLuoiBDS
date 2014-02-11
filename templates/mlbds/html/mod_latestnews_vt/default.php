<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="latestnews">
<div>
<h4><a href="<?php echo $list[0]->link?>"><?php echo $list[0]->text?></a></h4>
</div>
<div class="lats clear" >
<img src="<?php echo $list[0]->image?>" />
<p>
<?php echo $list[0]->introtext;?>
</p>
</div>
<div class='clear'>
<div class="latestnews">
<?php
// tru ra cat link
$listCount = count($list) - 1; 
for ( $i = 1; $i < $listCount; $i++ )  {  ?>
	<div class="latestnews">
		<a href="<?php echo $list[$i]->link; ?>" class="latestnews2">
			<?php echo $list[$i]->text; ?></a>
	</div>
<?php } ?>
</div>
</div>
</div>
