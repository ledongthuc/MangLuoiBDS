
<div style="height:171px">

 	<marquee  style="font-family:Book Antiqua; color: blue" scrolldelay="0">
		<?php 
			for ( $i = 0; $i <= 4; $i ++ )
			{
				// echo "<div>";
				echo  "<img src='$arrayhinh[$i]' height=150px > ";				
			 	//echo "<div>". $arraytieude[$i] ."</div>";
			 	echo "<span>". $arraytieude[$i] ."</span>";
			 	// echo "</div>";
			}
		?>
	</marquee>
</div>
