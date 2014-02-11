<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//JHTML::stylesheet('mod_jea_emphasis.css', 'modules/mod_jea_emphasis/');
JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
include_once "libraries/unisonlib/com_jea_lib.php";
?>

<?php 
//echo thu::test();
//echo modJeaEmphasisHelper::test();
?>


<!-- <link rel="stylesheet" href="components/com_jea/views/properties/tmpl/js/dhtmltooltip.css" type="text/css">
 <script type="text/javascript" src="components/com_jea/views/properties/tmpl/js/dhtmltooltip.js"></script> -->
<div id="<?php echo $idPaging?>"><!-- display list here --> <?php 
?> <?php

if (count($rows) > 0)
{
	echo '<table width="100%" cellpadding="0" cellspacing="0">';

	$k=0;
	$dem = 0;
	$baseImagePath = "images/com_jea/images/";

	foreach($rows as $row)
	{

		$k++;
		$dem++;
		if($k==1)
		{ 	echo "<tr>";
		if ($dem < 3)
		{
			echo "<td width='50%' valign='top' class='border_right1'>";
		}
		else
		{
			echo "<td width='50%' valign='top' style='border-top:1px solid silver;' class='border_right1'>";
		}
		}
		else
		{
			if ($dem < 3)
			{
				echo "<td width='50%' valign='top' class='border_right2'>";
			}
			else
			{
				echo "<td width='50%' valign='top' style='border-top:1px solid silver;' class='border_right2'>";
			}
		}

		// layout 1 item
		$kindString = "";
		$itempa=modJeaEmphasisHelper::getparamItemId($params);
		$pa=explode(',',trim($itempa));
		switch ($row->kind_id)
		{
			case 1:
				$kindString = "Cần bán";
				$itemid= $pa[0] ;
				break;
			case 2:
				$kindString = "Cho thuê";
				$itemid=  $pa[1];
				break;
			case 3:
				$kindString = "Cần mua";
				$itemid= $pa[2] ;
				break;
			case 4:
				$kindString = "Cần thuê";
				$itemid=  $pa[3];
				break;
		}


		$detailLink = modJeaEmphasisHelper::getComponentUrl( $row->id ,$itemid);
		
		  				$quanhuyen = $row->area;
                       $phuongxa =  $row->phuongxa; 
                        $duongpho = $row->duongpho;
                        
                        ($duongpho != "")? $dau1 = ", " : $dau1 = "";
                        ($phuongxa != "")? $dau2 = ", " : $dau2 = "";
                        ($quanhuyen != "")? $dau3 = ", " : $dau3 = "";
                       $FullAdress=$duongpho.$dau1.$phuongxa.$dau2.$quanhuyen.$dau3.$row->town;
                      
                        
//		$addressStr = $row->area;
//
//		if (!empty($addressStr))
//		{
//			$addressStr .= " - ";
//		}
//		$addressStr .= $row->town;

		//$kindString = getKindString($row->kind_id);
		echo "<table>";
		echo "<tr>";
		echo "<td  class='border_right3' colspan='2'>";
		echo "<a href='$detailLink' >" . $kindString . ": " . $row->ref . "</a>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
//		echo "<td width='30%';style='padding-top:10px'>";
		echo "<td width='30%' valign='top'>";
		if ( is_file( $baseImagePath . $row->id . '/min.jpg' ) )
		{
			echo "<a href='$detailLink' ><img width='100' height='80' src='" . $baseImagePath . $row->id . "/min.jpg'></a>";
		}
		else
		{
			echo "<a href='$detailLink' ><img src=\"images/noimage.jpg\"  width='100' height='80' /></a>";
		}


		echo "</td>";
		echo "<td  valign='top'>";
		echo "<table>";
		echo "<tr>";
		echo "<td nowrap='nowrap'  valign='top' >Địa chỉ:</td>";
		echo "<td>";
		echo "<strong>".$FullAdress."</strong>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td nowrap='nowrap'  valign='bottom' >Diện tích:</td>";
		echo "<td>";
		if($row->living_space == 0)
		{
			echo "<strong> _</strong>";
		}
		else
		{
			echo "<strong>".$row->living_space."m<sup>2</sup></strong>";
		}
			
		echo "</td>";
		echo "</tr>";
		echo "</table>";
			echo "</td>";
		echo "</tr>";
			echo "</table>";
			
		echo "<table>";	
		echo "<tr>";
		$pageid = $row->id.modJeaEmphasisHelper::getparamidPaging($params);
		echo "<td nowrap='nowrap' width='100px' style='vertical-align:top' >";
		echo "<center><strong><font color='red'><div id=\"$pageid\">".modJeaEmphasisHelper::getprice($row->price_unit,$row->price_area_unit,$row->price)."</div></font></strong></center>";
		"</td>";
		echo "<td nowrap='nowrap' style='vertical-align:top'>";
		
		echo  @modJeaEmphasisHelper::getAjaxButton($row->price_unit,$row->price_area_unit,$row->price,$pageid);
		echo "</td>";
		echo "</tr>";	
		echo "</table>";			
		
//		echo "<table>";
//		echo "<tr>";
//		echo "<td nowrap='nowrap'colspan=\"2\">";
		//echo  @modJeaEmphasisHelper::getAjaxButton($row->price_unit,$row->price_area_unit,$row->price,$row->id);
//		"</td>";
//		echo "</tr>";
//		echo "</table>";
	

	
//		echo "<tr>";
//		echo "<td nowrap='nowrap' colspan=\"2\">".
//		@modJeaEmphasisHelper::getAjaxButton($row->price_unit,$row->price_area_unit,$row->price,$row->id);
//		"</td>";			
//		echo "</tr>";
	

		echo" </td>";
		if($k==2)
		{
			echo " </tr>";
			$k=0;
		}
	}
	if($k==1)echo " </tr>";
}
echo "</table>";
?>

<!--<p id="myP"    style="text-decoration:underline; cursor:hand;"   onclick="function1()">Render this text using the myC class</p>-->
<div id="page_nagi" align="center"></div>
</div>
<script type="text/javascript">
//function paging(paging,f,number_per_page,style,order_by,i,tPage,measure)
//{
//apaging_modJeaEmphasis(paging,f,number_per_page,style,order_by,i,tPage,measure,Array(<?php echo implode(',', $idKind); ?>));
//}

</script>


