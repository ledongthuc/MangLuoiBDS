<?php
defined('_JEXEC') or die('Restricted access');
/* This template for headline (frontpage): first news with big image and next news with smaller images
bigimg_w, bigimg_h, smallimg_w, smallimg_h
*/
$showhlreadmore 				= 	intval (trim( $params->get( 'showhlreadmore', 0 ) ));
$hiddenClasses 				= 	trim( $params->get( 'hiddenClasses', '' ) );
$i = 0;
?>
<div>
	<?php foreach ($rows as $news) :
	if($i<$bigitems) :
		$link   = JRoute::_(ContentHelperRoute::getArticleRoute($news->slug, $news->catslug, $news->sectionid));
		$image = modJANewsHelper::replaceImage ($news, $imgalign, 1, $bigmaxchar, $bigshowimage, $bigimg_w, $bigimg_h, $hiddenClasses);
	  //First new
	?>
     <table width="100%" border="0">
  <tr>
    <td rowspan="3" style="padding-right:5px;vertical-align:top;"><?php echo $image; ?></td>
    <td valign="top" height="10%" ><span style="font-size:130%;margin-bottom:5px;font-weight:bold"><a href="<?php echo $link;?>" title="<?php echo strip_tags($news->title); ?>"><?php echo $news->title;?></a></span></td>
  </tr>
  <tr>
    <td valign="top" ><?php echo $bigmaxchar?$news->introtext1:$news->introtext;?></td>    
  </tr>
  <tr>
  <td align="right"><strong><a href="index.php?option=com_content&view=category&layout=blog&id=1&Itemid=3" > Xem tất cả >> </a></strong></td>
  </tr>
	</table>
    <hr/>
<?php    if($params->get( 'display_type')=='list') { ?>
    <ul>
    <? } else { ?>
    <table>
    <?php } ?>
    <?php //endif;?>
	<?php else: ?> 
	 <?php
		$link   = JRoute::_(ContentHelperRoute::getArticleRoute($news->slug, $news->catslug, $news->sectionid));
		$image = modJANewsHelper::replaceImage ($news, $imgalign, 1, $smallmaxchar, $smallshowimage, $smallimg_w, $smallimg_h, $hiddenClasses);
	  //Next news
	?>
    <?php    if($params->get( 'display_type')=='list') { ?>
    <li><span onmouseover="showttip( '<?php echo $bigmaxchar?strip_tags($news->introtext1):strip_tags($news->introtext);?>');" onmouseout="hidettip();">
    <strong><a href="<?php echo $link;?>" title="<?php echo strip_tags($news->title); ?>" style="color:#000 !important;"><?php echo $news->title;?></a></strong></span>
    </li>
    <? } else { ?>
     <td width="<?php echo $smallimg_w+5; ?>px" style="padding-right:5px;vertical-align:top">
    <p><?php echo $image; ?></p>
    <p style="margin-top:4px"><strong><a href="<?php echo $link;?>" title="<?php echo strip_tags($news->title); ?>" style="color:#000 !important;"><?php echo $news->title;?></a></strong></p>
    </td>
    <?php } ?>    
    <?php
	endif;
	$i++;
	?>

<?php    endforeach;?>
    
    <?php    if($params->get( 'display_type')=='list') { ?>
    </ul>
    <? } else { ?>
    </table>
    <?php } ?>
</div>


