<?php // no direct access
include_once('my_string_lib.php');
$conta=0;
$i=0;
$title="";
$title_spec="";  //them code
//$countSpecial=$params->get('special_items_count');
$columnas=$params->get('rows');
$columnas_spec=$params->get('rows_spec');
$linkShowAll=$params->get('linkShowAll');
$image=$params->get('background');
$cat_text=explode( "\n", $params->get('cat_text') );	
$cat_link=explode( "\n", $params->get('cat_link') );	
if($params->get('item_width')=="") {
	$porcentaje=100/$columnas;
	$porcentaje.="%";
}
else $porcentaje=$params->get('item_width');
defined('_JEXEC') or die('Restricted access'); ?>
<div class="featureditems<?php echo $params->get('moduleclass_sfx'); ?>">
<table width="" >

<?php if($list_spec): ?>
<tr>
<?php foreach ($list_spec as $item_spec) :  ?>
<?php  
$link   = JRoute::_(ContentHelperRoute::getArticleRoute($item_spec->slug, $item_spec->catslug, $item_spec->sectionid));
//echo $list_spec;
//code them
$title_spec=$item_spec->title;
$title_spec_full=htmlspecialchars($item_spec->title);
if(mb_strlen($title_spec) > $params->get('special_textcount'))
$title_spec=mb_substr($title_spec,0,$params->get('special_textcount')).'...';
//
//if($i < $countSpecial) { ?>
<td width="<?php echo $porcentaje.""; ?>" height="<?php echo $params->get('special_item_height'); ?>" align="left" valign="middle" background="<?php echo $image; ?>" style="border-bottom:dotted 1px #CCC; padding-bottom:3px; font-size:<?=$params->get('special_item_fontsize')?>" bgcolor="<?=$params->get('special_item_background') ?>">
		<img src="modules/mod_articles_items/tmpl/arrrow_Icon.png"  />	
        <span onmouseover="showttip( '<div align=left><?=$title_spec_full ?></div>');" onmouseout="hidettip();"/>
        <a href="<?php echo $link; ?>" style="color:<?=$params->get('special_item_color') ?> !important">
				<?php echo $title_spec; ?></a>
                </span>
                <?php // echo $item->imageTag; ?>      
    <?php
	if($params->get('sep_width')!="") {
		echo '<td width="'.$params->get('sep_width').'"></td>';
	}
	
	$i++;
	$conta++;
	if($conta>=$columnas_spec) {
		
		$conta=0;
		if($params->get('sep_height')!="") {
			echo '</tr><tr height="'.$params->get('sep_height').'" >';
		}
		echo '</tr><tr>';
	}
	?>
            </td>	
<?php endforeach; ?>
</tr>  <?php endif; ?>
<tr>
<?php foreach ($list as $item) :  ?>
<?php  
//code them
$link   = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
$title=$item->title;
$title_full=htmlspecialchars($item->title);
if(mb_strlen($title) > $params->get('textcount'))
//$title=mb_substr($title,0,$params->get('textcount')).'...';
$title = fixContentLenght($title, $params->get('textcount'));
//if($i < $countSpecial) { ?>
    
		    
     <td width="<?php echo $porcentaje.""; ?>" height="<?php echo $params->get('item_height'); ?>" align="left" valign="middle" background="<?php echo $image; ?>" style="border-bottom:dotted 1px #CCC; padding-bottom:3px" >
    
		<img src="modules/mod_articles_items/tmpl/arrrow_Icon.png"  />	
        <span onmouseover="showttip( '<div align=left><strong><?=$title_full ?></strong></div>');" onmouseout="hidettip();"/>
        <a href="<?php echo $link; ?>" >
				<?php echo $title; ?></a>
                </span>
		
		
		    <?php // echo $item->imageTag; ?>
			<?php //echo $item->text; ?>
    <?php //} ?>
    <?php
	if($params->get('sep_width')!="") {
		echo '<td width="'.$params->get('sep_width').'"></td>';
	}
	
	$i++;
	$conta++;
	if($conta>=$columnas) {
		
		$conta=0;
		if($params->get('sep_height')!="") {
			echo '</tr><tr height="'.$params->get('sep_height').'" >';
		}
		echo '</tr><tr>';
	}
	?>
<?php endforeach; ?>
</tr>
<tr><td>
<?php for($i=0;$i<count($cat_text);$i++) { ?>


<div style="width:50%;height:41px;  background: url(images/bg_o_r.gif) no-repeat right;float:left;">
<div style="font-size:11px; height:41px;background: url(images/bg_o_l.gif) no-repeat; padding-left:8px; padding-right:8px;text-align:center"> 
<div style="padding-top:8px;"><?php echo "<a style=color:#fff; href=\"$cat_link[$i]\">$cat_text[$i]</a>";?>
</div>
</div>
</div>
<?php  } ?>
</td>
</tr>
<?php if($linkShowAll){ ?>
<tr>
<td  style="text-align:right"align="right"><a href="<?php echo $linkShowAll ?>">Xem tất cả >></a></td>
</tr>
<?php } ?>

</table>


</div>