<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
/**
 * Google  Map default controller
 * 
 * @package    Joomla.component
 * @subpackage Components
 * @link http://inetlanka.com
 * @license		GNU/GPL
 * @auth inetlanka web team - [ info@inetlanka.com / inetlankapvt@gmail.com ]
 */
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td colspan="2">
			<?php 
			if($this->google->apiKey == NULL)
			{
				echo "<b>This is first time you are comming to this area so, First you have to save your <a href='http://code.google.com/apis/maps/signup.html' target=_blank>API Key</a><br> then after you can your Map here<b>";
			}
			?>
			
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Company Name'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="greeting" id="greeting" size="32" maxlength="250" value="<?php echo $this->google->greeting;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Google Map API key'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="apiKey" id="apiKey" size="32" maxlength="250" value="<?php echo $this->google->apiKey;?>" />
				<a href="http://code.google.com/apis/maps/signup.html" target="_blank">Get API Key</a>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Map Width'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="mapWidth" id="mapWidth" size="32" maxlength="250" value="<?php echo $this->google->mapWidth;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Map Height'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="mapHeight" id="mapHeight" size="32" maxlength="250" value="<?php echo $this->google->mapHeight;?>" />
			</td>
		</tr>
	
		<tr>
		
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'E-mail'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="mapEmail" id="mapEmail" size="32" maxlength="250" value="<?php echo $this->google->mapEmail;?>" />
				
			</td>
			
		</tr>
			<!--
		<tr>
		
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php //echo JText::_( 'Fax'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="mapFax" id="mapFax" size="32" maxlength="250" value="<?php //echo $this->google->mapFax;?>" />
				
			</td>
		
		</tr>
		<tr>
	
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php //echo JText::_( 'TP'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="mapTp" id="mapTp" size="32" maxlength="250" value="<?php// echo $this->google->mapTp;?>" />
				
			</td>
			
		</tr>
		<tr>
	
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php //echo JText::_( 'Mobile Phone'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="mapPhone" id="mapPhone" size="32" maxlength="250" value="<?php// echo $this->google->mapPhone;?>" />
				
			</td>
			
		</tr>
		-->
		<tr>
		<!--
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php //echo JText::_( 'Address'); ?>:
				</label>
			</td>
			<td>
			-->
			 <?php
                                        $editor =& JFactory::getEditor();
                                        echo $editor->display('mapAddress',$this->google->mapAddress, '550', '400', '60', '20', false);
                                ?>
			<!--<textarea class="text_area" cols="50" rows="5" name="mapAddress" id="mapAddress"><?php //echo $this->google->mapAddress;?></textarea>-->
				
			<!--</td>-->
		</tr>
		
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Latitude'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" readonly="" name="mapLatitude" id="mapLatitude" size="32" maxlength="250" value="<?php if(trim($this->google->mapLatitude) == "" ) {echo $user_lat = 79.9286111;} else {echo $this->google->mapLatitude; } ?>" />
				
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Longitude'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" readonly="" name="mapLongitude" id="mapLongitude" size="32" maxlength="250" value="<?php if($this->google->mapLongitude == ""  ){ echo $user_lan = 6.6641667;} else { echo $this->google->mapLongitude; }?>" />
				
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Map View'); ?>:
				</label>
			</td>
			<td>
			
			<select name="mapView" id="mapView">
<!--				<option value="">Select One</option>-->
<!--				<option value="PHYSICAL">Physical</option>-->
				<option value="NORMAL">Normal</option>
<!--				<option value="SATELLITE">Satellite</option>-->
<!--				<option value="HYBRID">Hybrid</option>-->
				
			</select>
				
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Map View Height'); ?>:
				</label>
			</td>
			<td>
			<select name="mapViewHeight" id="mapViewHeight">
			<?php
			$selectedVal = "";
			$saveHi = $this->google->mapViewHeight;
			$mapHightArr = array("","18","12","14");
			$mapDisHightArr = array("Select View Height","200 ft","2 mi","900 me");
			for($m=0; $m < count($mapHightArr); $m++)
			{
				$selected = "";
				if($mapHightArr[$m] == $saveHi)
				{
					$selectedVal ='selected="selected"';
				
				}
				echo "<option value=".$mapHightArr[$m]." ".$selectedVal.">".$mapDisHightArr[$m]."</option><br>";
			}
			
			?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Point Image'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="mapPointImg" id="mapPointImg" size="32" maxlength="250" value="<?php echo $this->google->mapPointImg;?>" />
				
			</td>
		</tr>
		<tr>
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Company Video Profile (youtube code)'); ?>:
				</label>
			</td>
			<td>
			<input class="text_area" type="text" name="companyVideoProfile" id="companyVideoProfile" size="32" maxlength="250" value="<?php echo $this->google->companyVideoProfile;?>" />
				
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key" valign="top">
				<label for="greeting">
					<?php echo JText::_( 'Do you need to add SPAM checking'); ?>:
				</label>
			</td>
			<td>
		
			<select name="companySpamcheck" id="companySpamcheck">
			<?php
			$selectedVal = "";
			$saveSpam = $this->google->companySpamcheck;
			$mapSpamArr = array("","1","0");
			$mapSpamTxtArr = array("Select Spam or not","Yes","No");
			for($m=0; $m < count($mapSpamArr); $m++)
			{
				$selected = "";
				if($mapSpamArr[$m] == $saveSpam)
				{
					$selectedVal ='selected="selected"';
				
				}
				else
				{
					$selectedVal="";
				}
				
				
				echo "<option value=".$mapSpamArr[$m]." ".$selectedVal.">".$mapSpamTxtArr[$m]."</option>";
			}
			
			?>
				</select>
			
				
			</td>
		</tr>
		
		<tr>
			
			<td colspan="2">
			
			<table border="0" cellpadding="4" cellspacing="5">
<!--			<tr>-->
<!--				<Td>-->
<!--				<b><i>-->
<!--				way to point your own locaiton-->
<!--				<ul>-->
<!--					<li>1. Put site relevent google API key</li>-->
<!--					<li>2. Find you own location</li>-->
<!--					<li>3. Click on the map</li>-->
<!--					<li>4. Then it pop up form</li>-->
<!--					<li>5. Fill the form and click save button - automaticaly set </li>-->
<!--					<li>6. <a href="http://joomlacomponent.inetlanka.com">help</a></li>-->
<!--					<li>7. For more details watch the video at the above site</li>-->
<!--				</ul>-->
<!--				</i></b>-->
<!--				</Td>-->
<!--			</tr>-->
			
			<tr>
			<td valign="top">
			<?php 
			if($this->google->apiKey == NULL)
			{
				echo "This is first time you are comming to this area so, First you have to save your <a href='http://code.google.com/apis/maps/signup.html' target=_blank>API Key</a><br> then after you can your Map here";
			}
			else
			{
			$apiKeyVal = $this->google->apiKey;
			
			$showGreetingTxt = $this->google->greeting;
			$showMapAddressTxt = $this->google->mapAddress;
			$showGreeting = $showGreetingTxt;
			$showMapAddress = $showGreetingTxt;
			
			if(trim($this->google->mapLongitude) == "" AND trim($this->google->mapLatitude) == "" )
			{
				$user_lan = 6.6641667;
				$user_lat = 79.9286111;
			}
			else
			{
				$user_lan = $this->google->mapLongitude;
				$user_lat = $this->google->mapLatitude;
			}
			
			if($this->google->mapViewHeight == NULL)
			{
				$mapViewHeight = "18";
			}
			else
			{
				$mapViewHeight = $this->google->mapViewHeight;
			}
			
			if($this->google->mapView == NULL)
			{
				$mapView = "SATELLITE";
			}
			else
			{
				$mapView = $this->google->mapView;
			}
			if($this->google->mapPointImg == NULL)
			{
				$imgDis = "";
			}
			else
			{
				$imgDis = "<img src=".$this->google->mapPointImg." width='50' height='50'/>";
			}
			
			?>
			
			
<style>

#home_town
{
	width:400px;
	height:250px;
	border:1px solid #000;
	overflow:hidden;
	clear:both;
}
</style>
			<div id="home_town"><!-- --></div>
			<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $apiKeyVal; ?>" type="text/javascript"></script>
                     	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $apiKeyVal; ?>" type="text/javascript"></script>
            <script src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=<?php echo $apiKeyVal; ?>" type="text/javascript"></script>
        
<script language="javascript" >
						
									
										
	var map = new GMap(document.getElementById("home_town"));
    var recording_flag = 1;
    var x_array = new Array(0);
    var y_array = new Array(0);
    var segment_distance_array = new Array(0);
    var total_distance_array = new Array(0);
	var preLatTxt  ="";
	var preLonTxt  ="";
	var preConcatLocName ="";
	

    var inetLatLng = new GLatLng("<?php echo $user_lan; ?>", "<?php echo $user_lat; ?>");
	var zoomFactor = 14;
	
	map.setCenter(inetLatLng, zoomFactor);
	map.setMapType(G_HYBRID_MAP);
	map.addControl(new GSmallMapControl());
    map.addControl(new GMapTypeControl());

	GEvent.addListener(map, 'click', 
		function(overlay, point) {
		    if (point) {
			if (recording_flag > 0) {
			    x_array.push(point.x);
			    y_array.push(point.y);
			   // drawRoute();

			    document.getElementById('mapLongitude').value = point.y; 
			    document.getElementById('mapLatitude').value = point.x;
	
				
				var inputForm = document.createElement("form");
				inputForm.setAttribute("action","");
				inputForm.setAttribute("method","post");
				inputForm.onsubmit = function() {storeMarker(); return false;};
				//retrieve the longitude and lattitude of the click point
				var lng = point.lng();
				var lat = point.lat();
				inputForm.innerHTML = '<fieldset style="width:150px;">'
				+ '<legend>Next Point</legend>'
				+ '<label for="found">Place</label>'
				+ '<input type="text" id="place" style="width:100%;"/>'
				+ '<label for="left"></label>'
				+ '<input type="hidden" id="left" style="width:100%;"/>'
				+ '<input type="submit" value="Save"/>'
				+ '<input type="hidden" id="longitude" value="' + lng + '"/>'
				+ '<input type="hidden" id="latitude" value="' + lat + '"/>'
				+ '</fieldset>';
				map.openInfoWindow (point,inputForm); 
				


			}
		    }
			

		}
	    );   // end of GEvent.addListener

	
	

function storeMarker(){

	var lng = document.getElementById("longitude").value;
	var lat = document.getElementById("latitude").value;
	var disTxt = document.getElementById("place").value;
	var latlng = new GLatLng(parseFloat(lat),parseFloat(lng));
	
	
	var marker = new GMarker(latlng);
	
	
	GEvent.addListener(marker, 'click', function() {
	var markerHTML = disTxt;
	marker.openInfoWindowHtml(markerHTML);
	});
	map.addOverlay(marker);
	
	
	map.closeInfoWindow();
 



return false;



}								
			
			

</script>
			<?php
			}
			?>	

			
			</td>
			<td valign="top">
			<?php
			if($this->google->companyVideoProfile == NULL)
			{
				$videoDis = "";
			}
			else
			{
				$videoDis = '<object width="425" height="344"><param name="movie" value="http://www.youtube.com/v/'.$this->google->companyVideoProfile.'&hl=en&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$this->google->companyVideoProfile.'&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>';
			}
			?>
				
				<?php echo $videoDis; ?>
			</td>
		</tr>
		</table>
		</td>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_google" />
<input type="hidden" name="id" value="<?php echo $this->google->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="google" />
</form>
