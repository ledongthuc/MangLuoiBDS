<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php if (file_exists($review->image)) {?>
	<tr>
		<td valign='top' class='item'>
			<img width="60" height="60" style='padding-right:3px' src='<?php echo $review->image?>'>
		</td>
	
		<td valign="top" onmouseover="showttip( '<?php echo $project_spec ?>');" onmouseout="hidettip();"/>
			<a href="<?php echo $link ?>"><?php echo $review->ten; ?></a>
		</td>
	</tr>
<?php }
else
{?>
<tr>
	<td colspan="2" valign="top" onmouseover="showttip( '<?php echo $project_spec ?>');" onmouseout="hidettip();"/><a href="<?php echo $link ?>"><?php echo $review->ten; ?></a>
</td></tr>
<?php }?>


