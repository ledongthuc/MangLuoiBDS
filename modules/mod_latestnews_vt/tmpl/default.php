<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(); ?>modules/mod_latestnews_vt/tmpl/style.css" /> 
<!--  <ul id="latestnews_vt">
<?php $i=0; foreach ($list as $item) :  ?>
    <li class="listing_vt" style = "height:<?php echo $item->imgheight + 6; ?>px;">
            <a href="<?php echo $item->link; ?>">
              <img <?php  if($item->style_show == 0) { ?> style="float:left;" <?php } ?>
                   <?php  if($item->style_show == 1) { ?> style="float:right;" <?php } ?>
                   height="<?php echo $item->imgheight; ?>"
                   width="<?php echo  $item->imgwidth; ?>" src="<?php echo $item->image; ?>"/>
              <lu style="color:#0852a1;font-size:12px;" > <?php echo $item->text; ?></lu>
              <lu style="color:#0852a1;font-size:12px;" > <?php echo $item->introtext; ?></lu>
            </a>
     </li>
<?php $i++; endforeach; ?>
</ul>-->

<table>
<?php
	$listCount = count($list) - 1;
	for ($i = 0; $i < $listCount; $i+=$j) {
		echo "<tr>";
		for ($j = 0; $j < 2; $j++) {			
			echo "<td width='50%'>
					<table>
						<tr>
							<td colspan='2'>
								<a href='" . $list[$i+$j]->link . "'>"
								. $list[$i+$j]->text . "</a>"
						 . "</td>							
						</tr>
						<tr>
							<td>
								<img height='" . $list[$i+$j]->imgheight . "'" 
								. "width='" . $list[$i+$j]->imgwidth . "'"
								. "src='" . $list[$i+$j]->image . "'"
								. "style='float:left' />"
							. "</td>
							<td valign='top'>
								" . $list[$i+$j]->introtext . "
							</td>
						</tr>
					</table>			
				  </td>";			
		}
		echo "</tr>";
	}	 
?>
<tr>
	<td colspan="2" style="text-align:right;padding-right:5px">
		<a href="<?php echo $lists["catLink"]?>">
			>> Xem tất cả
		</a>
	</td>
</tr>	
</table>

