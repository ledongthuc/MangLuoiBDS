<div style="padding-left:5px; text-align:left">
	<strong><?php echo JText::_("Hỗ trợ: ");?></strong><span style="font-size: 12px; color:#2d7ea5; font-weight:bold;"><?php echo $arrayText[0]?></span>
	<br/>
		<strong><?php echo JText::_("Hotline: ");?></strong><span style="font-size: 12px; color:#2d7ea5; font-weight:bold;"><?php echo $arrayText[1]?></span>
	<br/>
	<?php    /* hien thi yahoo */
		//echo testonline_footer($arrayYahooId[0]);
		echo '<a href="ymsgr:sendIM?'.$arrayYahooId[0].'"><img src="http://opi.yahoo.com/online?u='.$arrayYahooId[0].'&m=g&t='.$yahooimage.'"  border="0" width="15px" height="15px" /></a>';
	?> 
	&nbsp
	<a href="skype:<?php echo $arrayYahooId[1] ?>?call">
	<img src="http://mystatus.skype.com/smallicon/<?php echo $arrayYahooId[1]; ?>" " border="0" >
				<!-- <img  alt="iconyahoo" src="images/stories/kp/skype.png" width="15px" height="15px" /> -->
	</a>						
</div>