<?php
/**
* Author:	Omar Muhammad
* Email:	Knightofbaghdad@yahoo.com
* Module:	Simple Select Box
* Version:	1.5.4
* Date:		30/5/2009
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
$target	= $params->get( 'target', "" );
$pretext= $params->get( 'pretext', "" );
$prepos = $params->get( 'prepos', "" );
$width  = $params->get( 'width', "" );
$align	= $params->get( 'align', "" );
$dir	= $params->get( 'direction', "" );
$link[]	= "!";
$title[]= $params->get( 'title0', "" );
for ($j=1; $j<=30; $j++)
	{
	$title[]= $params->get( 'title'.$j , "" );
	$link[]	= $params->get( 'link'.$j , "" );
	}
?>

<!-- Simple Select Box 1.5.4 starts here -->
<script type="text/javascript">
<!--
function openpage(link)
	{
	if (link!="!")
		window.open(link);
	return false;
	}
-->
</script>
<table  class="mod_ssb" cellpadding="2px" cellspacing="0" style="text-align: <?php echo $align; ?>; direction: <?php echo $dir; ?>;">
	<tr>
		<td><?php echo $pretext; ?></td>
		<?php if ($prepos==1)	{echo "</tr><tr>";} ?>
		<td>
			<form method="get" action="">
				<select name="Select" style="width: <?php echo $width;?>px" onchange="<?php echo (($target==0) ? "top.location.href=this.options[this.selectedIndex].value" : "openpage(this.options[this.selectedIndex].value);") ?>">
				<?php 
				for ($i=0; $i<=30; $i++)
					{if ($title[$i] != null) { echo "<option value='$link[$i]'>$title[$i]</option>"; }}
				?>
				</select>
			</form>
		</td>
	</tr>
</table>
<!-- Simple Select Box 1.5.4 ends here -->
