<?php // no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
?>
<!-- <link rel="stylesheet" href="modules/mod_jea_emphasis_newest/js/dhtmltooltip.css" type="text/css">
<script type="text/javascript" src="modules/mod_jea_emphasis_newest/js/dhtmltooltip.js"></script>  -->
<?php 
$r=0;
foreach ($rows as $k => $row) :
$r=1-$r;
?>
<!--	<dl class="jea_mod_emphasis_item" >
		<dt class="jea_mod_emphasis_title" >
			<a href="<?php //echo modJeaEmphasisNewestHelper::getComponentUrl( $row->id ) ?>" title="<?php //echo JText::_('Show detail') ?>" > 
			<strong> 
			<?php //echo ucfirst( JText::sprintf('PROPERTY TYPE IN TOWN', htmlentities($row->type), htmlentities($row->town) ) ) ?>
			</strong> 
			( <?php //echo JText::_('Ref' ) . ' : ' . $row->ref ?> )
			</a>
		</dt>
	
		<?php //if ( $params->get('display_thumbnails', 0) && $imgUrl = modJeaEmphasisNewestHelper::getItemImg( $row->id ) ) : ?>
		<dt class="image">
		    <a href="<?php //echo modJeaEmphasisNewestHelper::getComponentUrl( $row->id ) ?>" title="<?php //echo JText::_('Detail') ?>">
		      <img src="<?php //echo $imgUrl ?>" alt="<?php //echo JText::_('Detail') ?>" />
			</a>
		</dt>
		<?php //endif ?>

<?php //if ($params->get('display_details', 0)) : ?>	
		<dd>
		<?php //if ($row->slogan): ?> 
		<span class="slogan" >
			<strong><?php //echo htmlentities($row->slogan) ?></strong><br />
		</span>
		<?php //endif ?>
	
		<?php //echo $row->is_renting ? JText::_('Renting price') :  JText::_('Selling price') ?> : 
		<strong> <?php //echo modJeaEmphasisNewestHelper::formatPrice( floatval($row->price) , JText::_('Consult us') ) ?></strong>
		<br />
		
		<?php 
		//if ($row->living_space) {
		   // echo  JText::_('Living space') . ' : <strong>' . $row->living_space . ' ' 
		    	  //. $params->get('surface_measure') . '</strong>' .PHP_EOL ;
		//}?>
		<br />

		<?php
		//if ($row->land_space) {
		 //   echo  JText::_('Land space') . ' : <strong>' . $row->land_space  .' '
		 //         . $params->get('surface_measure'). '</strong>' .PHP_EOL ;
		//}		
		?>
		
		<?php //if ( $row->advantages ) : ?>
		    <br /><strong><?php //echo JText::_('Advantages') ?> : </strong>
		    <?php //echo modJeaEmphasisNewestHelper::getAdvantages( $row->advantages )?>
		<?php //endif ?>
		
		<br />
		<a href="<?php //echo modJeaEmphasisNewestHelper::getComponentUrl( $row->id ) ?>" title="<?php //echo JText::_('Show detail') ?>"> 
		<?php //echo JText::_('Detail') ?> </a>
		</dd>
<?php //endif ?>
		<dd class="clr"></dd>
	
	</dl>  -->
	<!-- <div class="bogocsanpham"><div><div><div> -->
    <table width="100%" class="jea_mod_emphasis_item_<?php echo $r; ?>" width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td rowspan="2" width="5%">
	
	<?php if($imgUrl = modJeaEmphasisNewestHelper::getItemImg( $row->id )) {?> <img src="images/Camera.jpg"  height="40px" width="35px"/><?php }  else { ?> <img src="images/NoCamera.jpg"  height="40px" width="35px"/> <?php } ?>
	
	</td>
    <td colspan="3" class="title"  width="65%">
	<span onmouseover="showttip( '<table width=100% border=\'0\' cellpadding=5 cellspacing=0><tr><td colspan=2><strong><?php echo $row->ref; ?></strong></td></tr><tr><?php if($imgUrl = modJeaEmphasisNewestHelper::getItemImg( $row->id )) {?> <td  align=left valign=top width=1px><img src=<?php echo $imgUrl ?>  /> </td><?php }  ?><td align=left valign=top><?php echo  htmlspecialchars($row->description, ENT_QUOTES); ?></td></tr></table>');" onmouseout="hidettip();">
	<a href="<?php echo modJeaEmphasisNewestHelper::getComponentUrl( $row->id ) ?>"  >  <!-- htmlentities  -->
			<span class="kindBds"> <?php
			if($row->kind_id == '1')
			echo JText::_('Cần bán') ;
			elseif($row->kind_id == '2')
			echo  JText::_('Cho thuê') ;
			elseif($row->kind_id == '3')
			echo  JText::_('Cần mua') ;
			elseif($row->kind_id == '4')
			echo  JText::_('Cần thuê') ;
			?> </span>: 
		
	<?php 
	

	echo substr(mb_convert_case($row->ref, MB_CASE_UPPER, "utf-8"),0,52).'...'; ?>
	</a>
	</span>
	</td >
    <td width="17%"><strong><?php echo $row->town; ?></strong></td>
  </tr>
  <tr>
    <td width="20%"><?php echo 'Diện tích: '.$row->living_space.' '. $params->get('surface_measure'); ?></td>
    <td width="30%"> <strong><?php echo 'Giá: '.modJeaEmphasisNewestHelper::formatPrice( floatval($row->price) , JText::_('Thương lượng') ) ?></strong></td>
    <td><?php echo date("d-m", strtotime($row->date_insert)); ?></td>
    <td ><?php echo $row->area; ?></td>
  </tr>
</table>

<hr>
<!-- </div></div></div></div>  -->
<?php endforeach ?>