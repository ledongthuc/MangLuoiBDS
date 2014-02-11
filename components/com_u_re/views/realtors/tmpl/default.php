<?php // no direct access

defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php'); 
$rowsCount = count( $this->rows );
?>
<?php 
if ( $this->params->get('show_page_title', 0) && $this->params->get('page_title', '') ) : ?>
<h1><?php echo $this->params->get('page_title') ?></h1>
<?php endif ?>

<div id="content1"><h1 class="componentheading"><?php if (!empty($this->project_group_name)) echo $this->project_group_name?></h1></div>

<?php if( JRequest::getVar('task') == 'search') : ?>
<div class="search_parameters">
	<!-- <h4 align="center"><?php //echo 'Tìm Kiếm'echo JText::_('Search parameters') ?></h4> -->
	<?php echo $this->getSearchparameters() ?>
</div>
<?php endif ?>

<?php if( !empty($this->rows) ) : ?>

<!-- <form id="jForm" name="jForm" action="<?php echo $this->getViewUrl() ?>" method="post">  -->

	<div id="content1">
    <p class="pagenavigation"><?php echo $this->pagination->getPagesLinks() ?>
	<em><?php echo $this->pagination->getPagesCounter(); ?></em></p></br>
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
     <form id="jForm"  action="<?php echo $this->getViewUrl() ?>" method="post">
    <div style="float:right;"><em><?php echo JText::_('Results per page') ?> : </em><?php echo $this->pagination->getLimitBox() ?></div>
    </form>
    <form id="ComForm" name="ComForm" action="index.php?option=com_jea&task=compare#" method="post">
   <div style="float:left">    
     </div>
    </div>
	<!--<p class="limitbox">
   
    <em><?php //echo JText::_('Results per page') ?> : </em><?php //echo $this->pagination->getLimitBox() ?></p>  -->
	
	
	<div class="clr" ></div>
	
<?php 
$r=0;
$iCheck=0;
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"  style=\"margin-top:3px;border-top:1px solid #ccc\">";
foreach ($this->rows as $k => $row) :
$r=1-$r;
?>
<tr>
<td>
    <table width="100%" border="0" style="border-bottom:1px solid #ccc">
      <tr>
        <td rowspan="2" width="1%" style="padding:5px">
        <?php if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS."Plan_".$row->id.DS.'min.jpg' ) ){
                echo '<img src="'.JURI::root()."images/com_jea/images/Plan_$row->id/min.jpg".'"  height="60px" width="60px"/>'; }
        else
        {echo '<img src="images/NoImage.jpg"  height="60px" width="60px"/>';}
        ?>
        </td>
        <td height="23"><a href="index.php?option=com_jea&view=projects&id=<?php echo $row->id?>"  > <b><?php echo $row->value?></b></a></td>
      </tr>
      <tr>
        <td valign="top"><?php echo $row->short_desc?><br /><div class="article-content">
        <a class="readon" href="index.php?option=com_jea&view=projects&id=<?php echo $row->id?>">
							<?php echo JText::_('SHOW_DETAIL');?>				</a>
        
       <!-- <input  class="readon" type="button" name="button" value="Chi tiết" onclick="window.location.href='index.php?option=com_jea&view=projects&id=<?php //echo $row->id?>'" />-->
       </div></td>
      </tr>
    </table>
</td>
</tr>
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
<!-- </form>  -->
<?php else : ?>
	<?php if( JRequest::getVar('task') == 'search') : ?>
		<p><strong><big><?php echo JText::_('No matches found') ?></big></strong></p>
		<p><a href="javascript:window.history.back()" class="jea_return_link" ><?php echo JText::_('Back')?></a></p>
	<?php endif ?>
<?php endif ?>