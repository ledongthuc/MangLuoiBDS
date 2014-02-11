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
		
	// Get price title and price value from admin config
	$priceTitleStr = $params->get("priceTitles");
	$priceValueStr = $params->get("priceValues");
	
	// parse title and value
	$priceTitleArr = explode("|",$priceTitleStr);
	$priceValueTempArr = explode("|",$priceValueStr);
	
	$priceValueArr = array();
	
	foreach ($priceValueTempArr as $priceValue)
	{
		$temp = explode(";", $priceValue);		
		$priceValueArr[] = $temp;
	}
	
	$count_value = count($priceTitleArr);
?>

<script>
function quickPriceSearch(gia_tu, gia_den)
{
	var formSearch = document.forms["jea_quick_price_search_form"];

	formSearch["gia_tu"].value = gia_tu;
	formSearch["gia_den"].value = gia_den;
	
	formSearch.submit();
}
</script>
<?php 
	// Get cat direct and item id
	if (JRequest::getVar('catDirect') != '')
		$catDirect =  "&amp;catDirect=" . JRequest::getVar('catDirect');
	if (JRequest::getVar('Itemid') != '')
		$itemId =  "&amp;Itemid=" . JRequest::getVar('Itemid');
?>

<div style=' <?php if($colorText) echo "color:$colorText;"  ?> ' >

<!-- Chau mod interface -->
<?php //global $haveResultFlag; if (!$haveResultFlag) {?>
<form action="index.php?option=com_jea&amp;task=search<?php echo $catDirect . $itemId; ?>"	
		method="post" id="jea_quick_price_search_form" name="jea_quick_price_search_form" enctype="application/x-www-form-urlencoded" >
<!--<form action="#" method="POST" name="jea_quick_price_search_form">-->
	<table>
		<?php for($i = 0; $i < $count_value; $i++) {?>
		<tr>
			<td>
				<a onclick="quickPriceSearch('<?php echo $priceValueArr[$i][0] . "','" . $priceValueArr[$i][1];?>')" href="#"><?php echo $priceTitleArr[$i]; ?></a>
			</td>
		</tr>
		<?php }?>
	</table>
<input type="hidden" name="gia_tu"></input>
<input type="hidden" name="gia_den"></input>
</form>
<?php //}?>

<!-- end mod -->


