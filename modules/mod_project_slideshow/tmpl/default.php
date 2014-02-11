<?php 
$arrtext = explode  ('##',$getprovalue);
$arrimg = explode  ('##',$getproimg);
$speed = $params->get('SLIDE_speed', 3000);
$patch = $params->get('SLIDE_path');

//$arrlist = explode  ('##',$lists);
// start debug
//echo "<pre>";
//print_r($arrimg);
//echo "</pre>";
// end debug

?>


<?php


for($i=0; $i<4;$i++)
{
	// start debug
//	echo "<pre>";
//	print_r($i."--". $lists[$i]->image ."<br/>");
//	echo "</pre>";
	
	// end debug
//	echo "<img class='lastnews'" 								
//								. "src='" . $lists[$i]->image . "'"
//								. "style='float:left' />";
}
/*	
$listCount = count($list) - 1;
	for ($i = 0; $i < $listCount; $i+=$j) {
		echo "<tr>";
		for ($j = 0; $j < 1; $j++) {	
							// start debug
							echo "<pre>";
							print_r($i+$j);
							echo "</pre>";
							// end debug
			echo "<td width='100%'>
					<table>
						
						<tr>
							<td>
							
								<img class='lastnews'" 								
								. "src='" . $lists[$i+$j]->image . "'"
								. "style='float:left' />"
							. "</td>							
						</tr>
					</table>			
				  </td>";			
		}
		echo "</tr>";
	}	 
	*/
?>

<script language="javascript" type="text/javascript" src="libraries/js/slideshow_project.js"></script>

<!--javascrip-->


<!--<body onLoad="SLIDE_start()">-->


<style type="text/css">

.emphasis_other
{
	color:blue;
	padding:0px 2px 0px 0px;
	font-size:18px;
	display: block;
	text-align: center;
	background-color: silver;
	height: 20px;
}
.emphasis
{
	padding: 7px 7px;

}
</style>

<?php
defined('_JEXEC') or die('Restricted access');
?>
	<table width='100%' border="1">
	<tr>	
	    <td colspan="2" class='emphasis' width='67%' valign="top" rowspan="2">
	    <span id="SLIDE_textBox" align="center" ></span>
		    <div style="width: 250px; height: 250px;  border:2px solid #d3d3d3; ">
		    <img width="250px"  height="250px"   name="SLIDE_picBox" style="border: thin inset white">	  
		    </div>  
	    </td>
		<td valign='top'>
			<img  alt="back" src="./images/back.gif" onClick="slideshow(<?php echo $arrtext ?>,<?php echo $arrimg ?> , <?php echo $speed ?>,'s')">
	  		<img src="./images/play.gif" onClick="test()">
	  	 	<img src="./images/pause.gif" onClick="SLIDE_pause()">
	  		<img alt="back" src="./images/next.gif" onClick="SLIDE_forward()">
		</td>

</tr>
</table>
</td>
	</tr>
</table>
