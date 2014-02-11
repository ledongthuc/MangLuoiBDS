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
	$numrecord = count($list); //list chua cac record
if($numrecord>=1)
{
?>
	<table width='100%' >
	<tr>
	<?php 
//	// start debug
//	echo "<pre>";
//	print_r(modEmphasisNewsHelper::renderEmphasis($list[0]));
//	echo "</pre>";
//	// end debug
	?>
	    <td  class='emphasis' width='67%' valign="top" rowspan=" <?php echo $numrecord;?>"><?php  modEmphasisNewsHelper::renderEmphasis($list[0]);?></td>
        <td  class="dot">
        </td>
		<td valign='top'>
			<!-- cac emphasis khac -->
			<?php 
			for($i=1;$i<$numrecord;$i++)
			{
				echo "<table>";
				//echo "<tr> <td valign='top' class='item'><img  style='padding-right:3px' src='" . $list[i]->image . "'>";
			  	modEmphasisNewsHelper::renderEmphasisNews($list[$i]);
			  	echo "</table>";
			  	
			  	//echo" </td></tr>";
			}
		echo "</td>";
}
?>
</tr>
</table>
</td>
	</tr>
</table>