
<table width="293" height="142" border="0" cellspacing="0">
  <tr>
  <td>
  <?php  
  /* hien thi yahoo */
  echo testonline($arrayYahooId[0]);
  ?>   
    <br/>
     <div align="center" style="padding-top:0">
  <?php echo "<a href=\"ymsgr:sendIM?$arrayYahooId[0] \">".$arrayText[0]."</a>"?>
    </div>   
   </td>
   
<!--   phan hien thi skype -->
     <td>
    <div align="center">
    <a href="skype:<?php echo $arrayYahooId[1] ?>?call">
    <img  alt="iconyahoo" src="images/stories/kp/skype.jpg" width="60" height="57" />
    </a>
		
                
      </div>     
      <br/>
     <div align="center">
    <?php echo "<a href=\"skype:".$arrayYahooId[1]."?call\">".$arrayText[1]."</a>"; ?>
    </div>  
   </td>

  </tr>
    <tr>
<!--    <td>-->
<!--      <img  alt="dien thoai" src="images/stories/kp/dt.png" width="60" height="57" />-->
<!--    </td>-->
    
	    <td height="37" colspan="2">
		    <center>
		        <img  style='vertical-align:bottom' alt="iconyahoo" src="images/stories/kp/dt.png" width="50" height="47" />
		  <span style="font-size: 25px; color:#2d7ea5; font-weight:bold;"><?php echo $arrayText[2]?></span>
		  </center>
	  </td>
  </tr>
</table>
<?php 
	/* 
// start debug
//echo "<pre>";
//print_r('<img src="http://opi.yahoo.com/online?u='.$arrayYahooId[0].'&m=g&t='.$yahooimage.'"  border="0" />');
//echo "</pre>";
// end debug
if(!$style || $style==0 || $style=="0") {
  for($i = 0; $i < 1; $i++)
{


	echo '<div align="center"><a href="ymsgr:sendIM?'.$arrayYahooId[$i].'"><img src="http://opi.yahoo.com/online?u='.$arrayYahooId[$i].'&m=g&t='.$yahooimage.'"  border="0" /></a></div>';
	if($arrayText[$i]=="")
	echo '<br>';
	else
	echo '<div align="center">'.$arrayText[$i].'</div>';
}
} else {
for($i = 0; $i < 1; $i++)
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
	
	echo '<div  align="'.$align.'"><a href="ymsgr:sendIM?'.$arrayYahooId[$i].'">';
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
	} else {
		if($online) {
			echo '<img src="'.$image_online.'" border="0" />';
		} else {
			echo '<img src="'.$image_offline.'" border="0" />';
		}
	}
	echo '</a></div>';
}

}
*/
?>