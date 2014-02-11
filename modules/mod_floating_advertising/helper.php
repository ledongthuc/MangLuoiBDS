<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
class ModFloatingAdvertising
{
    /**
     * Returns a list of post items
    */
    public function gethtmlText($width, $height, $padding, $distance_right_left, $target_top_bottom, $distance_top_bottom, $image_right_banner, $image_left_banner, $link_left_banner, $link_right_banner)
    {
		$htmlText = "<head>";
        
		
		//right banner
		$htmlText .= "<div  id=\"right_float_div\" style=\"" ;
		$htmlText .= "position:absolute; visibility: hidden;";  
		$htmlText .= "width:".$width."px;height:".$height."px;top:0px;right:0px;"; 
		$htmlText .= "padding:".$padding."px;background:#FFFFFF;";  
		$htmlText .= "\">";  
		$htmlText .= "<a href=\"".$link_right_banner."\" target=\"_blank\">";  
		$htmlText .= "<embed type=\"application/x-shockwave-flash\" name=\"plugin\" src=\"".$image_right_banner."\" width=\"".$width."px\" height=\"".$height."px\"/>";
		$htmlText .= "</a>";
		$htmlText .= "</div>"; 
		
		//left banner
		
		$htmlText .= "<div id=\"left_float_div\" style=\"" ;
		$htmlText .= "position:absolute; visibility: hidden;";  
		$htmlText .= "width:".$width."px;height:".$height."px;top:0px;right:0px;"; 
		$htmlText .= "padding:".$padding."px;background:#FFFFFF;";  
		$htmlText .= "\">";  
		$htmlText .= "<a href=\"".$link_left_banner."\" target=\"_blank\">";  
		$htmlText .= "<embed type=\"application/x-shockwave-flash\" name=\"plugin\" src=\"".$image_left_banner."\" width=\"".$width."px\" height=\"".$height."px\"/>";
		$htmlText .= "</a>";
		$htmlText .= "</div>"; 
		$htmlText .= "</head>";
		
		$htmlText .= "<script language=\"javascript\" src=\"modules/mod_floating_advertising/floating-1.7.js\"></script>\n";
		$htmlText .= "<script language=\"javascript\">";
		$htmlText .= "window.onload = toggleBannerEvent;";
		$htmlText .= "window.onresize = toggleBannerEvent;";
		$htmlText .= "function toggleBannerEvent(){";
	    $htmlText .= "var myWidth = 0, myHeight = 0;";
		$htmlText .= "if( typeof( window.innerWidth ) == 'number' ) {";
		$htmlText .= "myWidth = window.innerWidth; myHeight = window.innerHeight;";
		$htmlText .= "} else if( document.documentElement && ( document.documentElement.clientWidth ||document.documentElement.clientHeight ) ) {";
		$htmlText .= "myWidth = document.documentElement.clientWidth; myHeight = document.documentElement.clientHeight;";
		$htmlText .= "} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {";
		$htmlText .= "myWidth = document.body.clientWidth; myHeight = document.body.clientHeight;";
		$htmlText .= "}";
	
		// script for right banner
		$htmlText .= "if(myWidth > 1024){";	
		$htmlText .= "document.getElementById(\"right_float_div\").style.visibility=\"visible\";";
		$htmlText .= "document.getElementById(\"left_float_div\").style.visibility=\"visible\";";
		$htmlText .= "}else{";
    	$htmlText .= "document.getElementById(\"right_float_div\").style.visibility=\"hidden\";";
		$htmlText .= "document.getElementById(\"left_float_div\").style.visibility=\"hidden\";";
    	$htmlText .= "}}";
		
		$htmlText .= "floatingMenu.add('right_float_div',";
		$htmlText .= "{";
		$htmlText .= "targetRight: ".$distance_right_left.",";
		
		if($target_top_bottom == "Top"){
			$htmlText .= "targetTop: ".$distance_top_bottom.",";
		}else{
			$htmlText .= "targetBottom: ".$distance_top_bottom.",";
		}
		
		$htmlText .= "snap: true";
		$htmlText .= "});";
		
		// script for left banner
		
		$htmlText .= "floatingMenu.add('left_float_div',";
		$htmlText .= "{";
		$htmlText .= "targetLeft: ".$distance_right_left.",";
		
		if($target_top_bottom == "Top"){
			$htmlText .= "targetTop: ".$distance_top_bottom.",";
		}else{
			$htmlText .= "targetBottom: ".$distance_top_bottom.",";
		}
		
		$htmlText .= "snap: true";
		$htmlText .= "});";
		
		
		$htmlText .= "</script>";
		
        return $htmlText;
    }

} //end ModHelloWorld2Helper
?>