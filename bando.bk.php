<script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=vi" type="text/javascript"></script>  
<script type="text/javascript" src="libraries/com_u_re/js/utils.js"></script>     
<script language="javascript" >
var lat=<?php echo $_GET['lat']?>;
var lng=<?php echo $_GET['lng']?>;
var text='<?php echo $_GET['text']?>';
		function initMap()
		{
			/*
				var myLatlng = new google.maps.LatLng(lat,lng);
			    var myOptions = {
					zoom: 16,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					overviewMapControl: true
				}			
			    var map = new google.maps.Map(document.getElementById("popup-map"), myOptions);	
		    */
		    showMapPopUp('popup-map',lat,lng,text,16);				
		}
</script>
<style type="text/css">		
	#popup-map
	{
		width:700px;
		height:500px;
	}
	body{
		margin:0;
		padding:0;
	}
</style>
<body onload="initMap()">
<div id="popup-map">
</div>
</body>