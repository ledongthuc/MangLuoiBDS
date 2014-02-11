<?php
	$numrecord = count($list); //list chua cac record
if($numrecord>=1)
{
?>
<div id="duannoibat">
<div class="emphasis">
<?php  modEmphasisNewsHelper::renderEmphasis($list[0]);?>
</div>
<div class="item">
<?php 
			for($i=1;$i<$numrecord;$i++)
			{
				echo "<li class='clear'>";
			  	modEmphasisNewsHelper::renderEmphasisNews($list[$i]);
			  	echo "</li>";		  
			}
		
}
?>
</div>
</div>
<div class='clear'>
</div>