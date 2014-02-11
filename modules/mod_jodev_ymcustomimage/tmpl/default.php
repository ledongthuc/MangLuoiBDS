<?php
//echo 'day la module ho tro'; 
echo "<div class='yahoo'><span class='hotline'>0983 888 778</span></div>";
if(!$style || $style==0 || $style=="0") {
  for($i = 0; $i < count($arrayYahooId); $i++)
{ 
	
	echo "<div class='yahoo'>" ;
	echo '<div align="center" ><a href="ymsgr:sendIM?'.$arrayYahooId[$i].'"><img src="http://opi.yahoo.com/online?u='.$arrayYahooId[$i].'&m=g&t='.$yahooimage.'"  border="0" /></a></div>';
	if($arrayText[$i]=="")
	echo '<br>';
	else
	echo '<div align="center">'.$arrayText[$i].'</div>';
		echo "</div>" ;
}
echo "<div class='clear'></div>";		
} else {
for($i = 0; $i < count($arrayYahooId); $i++)
{
	$pageurl = "http://mail.opi.yahoo.com/online?u=".$arrayYahooId[$i]."&m=a&t=1";
	if(function_exists('curl_init')) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_URL, $pageurl );
		$status = curl_exec ( $ch );
		if($status == "01") {
			$online = true;
		} else {
			$online = false;
		}
		curl_close($ch);
	} else {
		$file = fopen($pageurl, "r");
		$read = fread($file, 200);
		$read = ereg_replace($arrayYahooId[$i], "", $read);
		if ($y = strstr ($read, "00")) {
			$online = false;
		} elseif ($y = strstr ($read, "01")) {
			$online = true;
		}
		fclose($file);
	}
	echo "<div>" ;
	echo '<div  align="'.$align.'" class="yahoo1"><a href="ymsgr:sendIM?'.$arrayYahooId[$i].'">';
	if($arrayText[$i]=="")
	echo '<br>';
	else
	echo '<div align="center">'.$arrayText[$i].'</div>';
	if($style=="1") {
		if($online) {
			echo '<img src="'.$uri->base().'/modules/mod_jodev_ymcustomimage/jodev_ymcustomimage/customonline'.$customimage.'.gif" border="0" />';
		} else {
			echo '<img src="'.$uri->base().'/modules/mod_jodev_ymcustomimage/jodev_ymcustomimage/customoffline'.$customimage.'.gif" border="0" />';
		}
	} 
	else {
		if($online) {
			echo '<img src="'.$image_online.'" border="0" />';
		} else {
			echo '<img src="'.$image_offline.'" border="0" />';
		}
	}
	echo '</a></div>';
}

}

?>