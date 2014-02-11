<?php // no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::stylesheet('jea.css', 'media/com_jea/css/');
JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
$rowsCount = count( $this->rows );
?>
<link rel="stylesheet" href="components/com_jea/views/properties/tmpl/js/dhtmltooltip.css" type="text/css">
<script type="text/javascript" src="components/com_jea/views/properties/tmpl/js/dhtmltooltip.js"></script>  

<?php if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<h1><?php //echo $this->params->get('page_title') ?></h1>
<?php endif ?>

<?php if( JRequest::getVar('task') == 'search') : ?>
<div class="search_parameters">
	<!-- <h4 align="center"><?php //echo 'Tìm Kiếm'echo JText::_('Search parameters') ?></h4> -->
	<?php echo $this->getSearchparameters() ?>
</div>
<?php endif ?>

<?php if( !empty($this->rows) ) : ?>
<hr>
<!-- <form id="jForm" name="jForm" action="<?php echo $this->getViewUrl() ?>" method="post">  -->

	<p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?><br />
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p>
	
	<div class="clr" ></div>
	
	<div id="sort_options">
		<?php if ( $this->params->get('sort_price') ): ?>
		<a href="javascript:changeOrdering('price')"><?php echo JText::_('Sort by price') ?></a><br />
		<?php endif ?>
		<?php if ( $this->params->get('sort_livingspace') ): ?>
		<a href="javascript:changeOrdering('living_space')"><?php echo JText::_('Sort by living space') ?></a><br />
		<?php endif ?>
		<?php if ( $this->params->get('sort_landspace') ): ?>
		<a href="javascript:changeOrdering('land_space')"><?php echo JText::_('Sort by land space') ?></a><br />
		<?php endif ?>
	</div>
	
    <div>
     <form id="jForm"  action="<?php echo $this->getViewUrl() ?>" method="post">
    <div style="float:right;"><em><?php echo JText::_('Results per page') ?> : </em><?php echo $this->pagination->getLimitBox() ?></div>
    </form>
    <form id="ComForm" name="ComForm" action="index.php?option=com_jea&task=compare#" method="post">
   <div style="float:left">
     <input type="button" name="submit_sosanh" value="So sánh" class="button" onclick="SoSanh('ComForm','sosanh[]',true)"/>
     </div>
    <div>
	<!--<p class="limitbox">
   
    <em><?php //echo JText::_('Results per page') ?> : </em><?php //echo $this->pagination->getLimitBox() ?></p>  -->
	
	
	<div class="clr" ></div>
	
<?php 
$r=0;
foreach ($this->rows as $k => $row) :
$r=1-$r;
?>
<!--
	<dl class="jea_item" >
		<dt class="title" >
			<a href="<?php //echo $this->getViewUrl ( $row->id ) ?>" title="<?php //echo JText::_('Show detail') ?>" > 
			<strong> 
			<?php //echo ucfirst( JText::sprintf('PROPERTY TYPE IN TOWN', $this->escape($row->type), $this->escape($row->town) ) ) ?>
			</strong> 
			( <?php //echo JText::_('Ref' ) . ' : ' . $row->ref ?> )
			</a>
		</dt>
	
		<?php //if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' ) ) : ?>
		<dt class="image">
		    <a href="<?php //echo $this->getViewUrl ( $row->id ) ?>" title="<?php//echo JText::_('Detail') ?>">
		      <img src="<?php //echo JURI::root().'images/com_jea/images/'.$row->id.'/min.jpg' ?>" alt="<?php //echo JText::_('Detail') ?>" />
			</a>
		</dt>
		<?php //endif ?>
	
		<dd>
		<?php //if ($row->slogan): ?> 
		<span class="slogan">
		    
		    <?php //if( $img = is_file(JPATH_COMPONENT.'/upload/slogans/'.$row->slogan_id.'.png') ) : ?>
			<img src="<?php //echo JURI::root().'components/com_jea/upload/slogans/'.$row->slogan_id.'.png' ?>" alt="<?php //echo $this->escape($row->slogan)  ?>" />
			<?php //else : ?>
			<strong><?php //echo $this->escape($row->slogan) ?></strong>
			<?php //endif ?>
			
		</span>
		<?php //endif ?>
			
		<?php //echo $this->cat == 'renting' ? JText::_('Renting price') :  JText::_('Selling price') ?> : 
		<strong> <?php //echo $this->formatPrice( floatval($row->price) , JText::_('Consult us') ) ?></strong>
		<br />
		
		<?php 
		//if ($row->living_space) {
		//    echo  JText::_('Living space') . ' : <strong>' . $row->living_space . ' ' 
		//    	  . $this->params->get('surface_measure') . '</strong>' .PHP_EOL ;
		//}?>
		<br />

		<?php
		//if ($row->land_space) {
		 //   echo  JText::_('Land space') . ' : <strong>' . $row->land_space  .' '
		 //         . $this->params->get('surface_measure'). '</strong>' .PHP_EOL ;
		//}		
		
		?>
		 
		<?php //if ( $row->advantages ) : ?>
		    <br /><strong><?php //echo JText::_('Advantages') ?> : </strong>
		    <?php //echo $this->getAdvantages( $row->advantages )?>
		<?php //endif ?>
		
		<br />
		<a href="<?php //echo $this->getViewUrl ( $row->id ) ?>" title="<?php //echo JText::_('Show detail') ?>"> 
		<?php //echo JText::_('Detail') ?> </a>
		</dd>
	
		<dd class="clr"></dd>
	
	</dl>
	-->
    
	 <table width="100%" class="jea_mod_emphasis_item_<?php echo $r; ?>" border="0" cellpadding="2" cellspacing="0">

     
  <tr>
  <td rowspan="2" width="3%">
  <input type="checkbox" name="sosanh[]" value="<?=$row->id?>" />
  </td>

    <td rowspan="2" width="10%">	<?php
if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' ) ){
			echo '<img src="images/Camera.jpg"  height="40px" width="60px"/>';
			//echo "<img src='".JURI::root()."images/com_jea/images/$row->id/min.jpg'  height=\"40px\" width=\"60px\"/>";
	}
else
{
echo '<img src="images/NoCamera.jpg"  height="40px" width="60px"/>';
}  ?>
	</td>
    <td colspan="3" class="title"  width="65%">
	<span onmouseover="showttip( '<div style=\'z-index:999;\'><table width=100% border=\'0\' cellpadding=5 cellspacing=0><tr><td colspan=2><strong><?php echo $row->ref; ?></strong></td></tr><tr><?php if(is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' )) {?> <td  valign=top width=1px><img src=<?php echo JURI::root()."images/com_jea/images/$row->id/min.jpg"; ?>  /> </td><?php }  ?><td valign=top><?php echo str_replace('"','&quot;',$row->description); ?></td></tr></table><div>');" onmouseout="hidettip();">
	
	<a href="<?php echo $this->getViewUrl ( $row->id ) ?>"  > 
			<strong> 
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
			 <?php echo mb_convert_case($row->ref, MB_CASE_UPPER, "utf-8"); ?> 
			 </strong>
	</a>
	</span>
	</td >
    
    <td width="12%"><strong><?php echo $row->town; ?></strong></td>
  </tr>
  <tr>
    <td width="20%" class="row2">
	<?php if ($row->living_space) {
		    echo  'Diện tích : <strong>' . $row->living_space . ' ' 
		    	  . $this->params->get('surface_measure') . '</strong>' .PHP_EOL ;
		}  ?>
	</td>
    <td class="row2" width="20%">
	 <?php echo 'Giá: '.$this->formatPrice( floatval($row->price) , JText::_('Consult us') ) ?>
	</td>
    <td width="20%"><?php //echo date("d-m", strtotime($row->date_insert)); 
	echo date("d-m");
	?></td>
    <td class="row2"><?php echo $row->area; ?></td>
  </tr>
</table>
<hr>
<?php endforeach ?>
	
	<div class="clear">
	  <input type="hidden" id="filter_order" name="filter_order" value="<?php echo $this->order ?>" />
	  <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	</div>
	
	<p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?><br />
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p>
 </form>
<!-- </form>  -->
<?php else : ?>
	<?php if( JRequest::getVar('task') == 'search') : ?>
		<p><strong><big><?php echo JText::_('No matches found') ?></big></strong></p>
		<p><a href="javascript:window.history.back()" class="jea_return_link" ><?php echo JText::_('Back')?></a></p>
	<?php endif ?>
<?php endif ?>