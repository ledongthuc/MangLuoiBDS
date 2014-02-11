<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>

<?php //echo $htmlText;?>

	<!-- banner right -->
	<div  id="right_float_div" style="position:absolute; visibility: hidden; 
			width:<?php echo $width ?>px; height:<?php echo $height ?>px;top:180px;right:0px; 
			padding:<?php echo $padding?>px;background:#FFFFFF;" >  
		<a href="<?php echo $link_right_banner?>" target="_blank">  
			<embed type="application/x-shockwave-flash" name="plugin" src="<?php echo $image_right_banner?>" 
				width="<?php echo $width ?>px" height="<?php echo $height?>px"/>
		</a>
	</div> 
	
	<!-- banner left -->
	<div id="left_float_div" style="position:absolute; visibility: hidden; 
			width:<?php echo $width ?>px; height:<?php echo $height ?>px;top:180px;right:0px; 
			padding:<?php echo $padding?>px;background:#FFFFFF;" > 
		<a href="<?php echo $link_left_banner?>" target="_blank">  
			<embed type="application/x-shockwave-flash" name="plugin" src="<?php echo $image_left_banner?>" 
				width="<?php echo $width ?>px" height="<?php echo $height?>px"/>
		</a>
	</div> 
	
	<script language="javascript" src="modules/mod_floating_advertising/floating-1.7.js"></script>n
	<script language="javascript">
		window.onload = toggleBannerEvent;
		window.onresize = toggleBannerEvent;
		function toggleBannerEvent()
		{
		    var myWidth = 0, myHeight = 0;
		    var floatContentWidth = <?php echo $width ?>;
		    var floatContentPadding = <?php echo $padding ?>;
		    var totalFloatContentWidth = 2*( floatContentWidth + floatContentPadding );
		    var mainContentWidth = 980;
		    //var mainContentWidth = parseInt(document.getElementById('main').style.width);
		    //alert(document.getElementById('main').style.width.toString());
			if( typeof( window.innerWidth ) == 'number' ) 
			{
				myWidth = window.innerWidth; 
				myHeight = window.innerHeight;
			} 
			else if( document.documentElement && ( document.documentElement.clientWidth ||document.documentElement.clientHeight ) ) 
			{
				myWidth = document.documentElement.clientWidth; 
				myHeight = document.documentElement.clientHeight;
			} 
			else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) 
			{
				myWidth = document.body.clientWidth; 
				myHeight = document.body.clientHeight;
			}
	
			if( myWidth > totalFloatContentWidth + mainContentWidth )
			{	
				document.getElementById("right_float_div").style.visibility="visible";
				document.getElementById("left_float_div").style.visibility="visible";
			}
			else
			{
			    document.getElementById("right_float_div").style.visibility="hidden";
				document.getElementById("left_float_div").style.visibility="hidden";
			}
		}
	
		floatingMenu.add('right_float_div',
							{targetRight: <?php echo $distance_right_left ?>,
							<?php if($target_top_bottom == "Top")
							{
							?>
								targetTop: <?php echo $distance_top_bottom ?>,
							<?php }
							else
							{
							?>
								targetBottom: <?php echo $distance_top_bottom ?>,
							<?php }?>
							snap: true
							});
	
		
		floatingMenu.add('left_float_div',
							{targetLeft: <?php echo $distance_right_left ?>,
							<?php if($target_top_bottom == "Top")
							{
							?>
								targetTop: <?php echo $distance_top_bottom ?>,
							<?php }
							else
							{
							?>
								targetBottom: <?php echo $distance_top_bottom ?>,
							<?php }?>
							snap: true
							});
	
	
	</script>