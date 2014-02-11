<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$use_ajax = $params->get('use_ajax', 0);
$styleBds = $params->get('styleBds');
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:8em;
	}");
$colorLink=$params->get( 'colorLink' );
$colorText=$params->get( 'colorText' );
?>

<?php 
	// Get cat direct and item id
	if (JRequest::getVar('catDirect') != '')
		$catDirect =  "&amp;catDirect=" . JRequest::getVar('catDirect');
	if (JRequest::getVar('Itemid') != '')
		$itemId =  "&amp;Itemid=" . JRequest::getVar('Itemid');
		
	$areas = getAreaList();
	global $selected_town_id;	
	$town_id = $selected_town_id;
?>

<script>
function quickTownSearch(town_id, area_id)
{
	var formSearch = document.forms["jea_quick_town_search_form"];

	formSearch["town_id"].value = town_id;
	formSearch["area_id"].value = area_id;
	
	formSearch.submit();
}
</script>

<div style=' <?php if($colorText) echo "color:$colorText;"  ?> ' >

<!-- Chau mod interface -->
<form action="index.php?option=com_jea&amp;task=search<?php echo $catDirect . $itemId; ?>"	
		method="post" id="jea_quick_town_search_form" name="jea_quick_town_search_form" enctype="application/x-www-form-urlencoded" >
<!--<form action="#" method="POST" name="jea_quick_town_search_form">-->
	<table>
		<?php foreach($areas as $area) {?>
		<tr>
			<td>
				<a onclick="quickTownSearch(<?php echo $town_id . ',' . $area->id;?>)" href="#"><?php echo $area->value . " (" . $area->num . ")"?></a>
			</td>
		</tr>
		<?php }?>
	</table>
<input type="hidden" name="town_id"></input>
<input type="hidden" name="area_id"></input>
</form>

<!-- end mod -->


