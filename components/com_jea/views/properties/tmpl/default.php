<?php // no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php'); 
include_once "libraries/unisonlib/com_jea_lib.php";

?>
<br />
<?php 
if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<?php endif ?>

<?php if( JRequest::getVar('task') == 'search') : ?>
<div class="search_parameters">
	<?php echo $this->getSearchParameters() ?>

</div>
<?php endif ?>
<?php 
	$linktam = $_SERVER['REQUEST_URI']."&limitstart=0&gia_tu=-1&gia_den=-1";
?>
<?php if( !empty($this->rows) ) : ?>
	<div align="left">
		<table width=100%> 
			<tr>
				<td width="18%" align="left"><?php echo $this->pagination->getPagesCounter(); ?></td>
				<td  width="50%" align="center"><?php echo $this->pagination->getPagesLinks(); ?></td>
				<td width="32%" align="right"><form id="jForm"  action="<?php echo $linktam; ?>" method="post">
    				<div style="float:right;"><em><?php echo JText::_('Results per page') ?> : </em><?php echo $this->pagination->getLimitBox() ?></div>
    				</form>
    			</td>
			</tr>
		</table>
	</div>
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
    </div>
	<div class="clr" ></div>
	
	<?php 
	$r=0;
	$iCheck=0;
	echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"  style=\"margin-top:3px;border-top:1px solid #ccc\">";
	foreach ($this->rows as $k => $row) :
	$r=1-$r;
	?>
    <tr><td>
	 <table width="100%" class="jea_mod_emphasis_item_<?php echo $r; ?>" style="border-bottom:1px solid #ccc;border-left:1px solid #ccc;border-right:1px solid #ccc" cellpadding="2" cellspacing="0">

     
  <tr class="modEmphasis_row0">
    <td rowspan="2" width="5%">	<?php
if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' ) )
	{
		$img= 'images/com_jea/images/'.$row->id.'/'.'min.jpg' ;
		echo "<img src='$img'  height='60px' width='75px'/>";
	}
else
	{
		echo '<img src="images/noimage.jpg"  height="60px" width="75px"/>';
	} 
	?>
	</td>
    <td colspan="3" class="title"  width="59%">
	<span onmouseover="showttip( '<div style=\'z-index:999;\'><table width=100% border=\'0\' cellpadding=5 cellspacing=0><tr><td colspan=2><strong><?php echo $row->ref; ?></strong></td></tr><tr><?php if(is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$row->id.DS.'min.jpg' )) {?> <td  valign=top width=1px><img src=<?php echo JURI::root()."images/com_jea/images/$row->id/min.jpg"; ?>  /> </td><?php }  ?><td valign=top><?php echo removetag($row->description); ?></td></tr></table><div>');" onmouseout="hidettip();">
	 <?php
	 		
			if($row->kind_id == '1')
			{
			$kind_name= JText::_('Cần bán') ;
			$itemid = '&Itemid=10'; 
			}
			elseif($row->kind_id == '2')
			{
			$kind_name =  JText::_('Cho thuê') ;
			$itemid = '&Itemid=11'; 
			}
			elseif($row->kind_id == '3')
			{
			$kind_name = JText::_('Cần mua') ;
			$itemid = '&Itemid=12'; 
			}
			elseif($row->kind_id == '4')
			{
			$kind_name = JText::_('Cần thuê') ;
			$itemid = '&Itemid=13'; 
			}
			?>
	<a href="<?php echo $this->getViewUrl ($itemid, $row->id) ?>"  > 
			<strong> 
			<?php echo $kind_name; ?>
			 </span>: 
			 <?php echo mb_convert_case($row->ref, MB_CASE_UPPER, "utf-8"); ?>
			 </strong>
	</a>
	</span>
	</td >
    
    <td width="17%"><strong><?php echo $row->town; ?></strong></td>
  </tr>
  <tr class="modEmphasis_row1">
    <td width="22%">
	<?php if ($row->living_space) {
		    echo  'Diện tích : <strong>' . $row->living_space . ' ' 
		    	  . $this->params->get('surface_measure') . '</strong>' .PHP_EOL ;
		}  ?>
	</td>
    <td width="22%">
 <?php //echo 'Giá: '.$this->formatPrice( floatval($row->price) , JText::_('Consult us') ) ?>
		
		<?php 
		switch($row->price_unit)
				{
					case "USD" : $donvitien=" USD";
					break;
					case "VND" : $donvitien="";
					break;
					case "SJC" : $donvitien=" lượng";
					break;
					default: $donvitien="";
					break;					
				}
						switch($row->price_area_unit)
				{
					case "m2" : $donvidat="/m<sup>2</sup>";
					break;
					case "Nguyên căn" : $donvidat="";
					break;
					case "Tháng" : $donvidat="/tháng";
					break;
					default: $donvidat="";
					break;					
				}				
					$ddgia=reFormatPrice($row->price,$row->price_unit);
				if($row->price > 0)
				{
					$hientien = "Giá: ".trim($ddgia.$donvitien).$donvidat;		
				}
				else
				{
					$hientien= "Giá: Thương lượng";
				}
		
				echo $hientien;	
		?>
	
	</td>
    <td width="10%">
    <?php
	echo date("d-m", strtotime($row->date_insert)); if ($row->emphasis) {echo "<img src='images/com_jea/vip.gif'>";}
	?></td>
    <td><?php echo $row->area; ?></td>
  </tr>
</table>
</td></tr>
<?php $iCheck++; ?>
<?php endforeach ?>
	</table>
	<div class="clear">
	  <input type="hidden" id="filter_order" name="filter_order" value="<?php echo $this->order ?>" />
	  <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	</div>
	<div align="center">
	<p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?>
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p>
    </div>
 </form>
<?php else : ?>
	<?php if( JRequest::getVar('task') == 'search') : ?>
		<p><strong><big><?php echo JText::_('No matches found') ?></big></strong></p>
		<p><a href="javascript:window.history.back()" class="jea_return_link" ><?php echo JText::_('Back')?></a></p>
	<?php endif ?>
<?php endif ?>