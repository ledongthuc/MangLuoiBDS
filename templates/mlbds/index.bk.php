<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
 <?php
/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once (dirname(__FILE__).DS.'ja_vars_1.5.php');
?>
<!-- template chính -->

<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/templates.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/menus/ja_moomenu/ja.moomenu.css" type="text/css" />
<script src="<?php echo $tmpTools->templateurl(); ?>/menus/ja_moomenu/ja.moomenu.js" language="javascript" type="text/javascript"></script>
<!-- <script type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/jquery-1.4.4.js"> </script> -->
<?php 
	$itemid = JRequest::getVar('Itemid');
	if($itemid == 1 || $itemid == 229){
?>
<script type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/mlbds.js"> </script>

<?php 
	}
?>
<script type="text/javascript" src="<?php echo JURI::base();?>includes/js/jquery.bpopup-0.7.0.min.js"></script>
<link rel="stylesheet" href="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/tabs.css" type="text/css" media="screen"/>
<script  type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ui.core.js"></script>
<script type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/jquery.scroll-follow.js"></script>
<script type="text/javascript" src="libraries/com_u_re/js/utils.js"></script>
</head>
<!-- add google analytics -->
<!--<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25336785-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>-->
<!-- end add google analytics -->

<body id="bd"> 
<div id="main"><!-- main-->
	<div class='bg-ft'>
			<div class='clear'>
				<div class='top-left'>
				<div align="center">Hệ thống đang chạy thử nghiệm để kiểm tra. Chúng tôi không chịu trách nhiệm về
nội dung trên website này !
</div>
					<jdoc:include type="modules" name="logo" style="sun" />
				</div>
				<div class='top-right'>
						<jdoc:include type="modules" name="dangnhap" style="sun" />
				</div>
				<div class='hotro'>
						<jdoc:include type="modules" name="hotro" style="sun" />
				</div>
			</div>
		
   <div id="menuheader"> <!-- menu -->
        <div id='classmenu'>
			        <div class='classmenu'>
			    	   	    <?php if ($tmpTools->getParam('ja_menu') != 'none') : ?>
				        	<?php if ($jamenu) $jamenu->genMenu (0); ?>
						    <?php endif; ?>
					</div>
		</div>
        </div><!-- menu --> 			
  
		<div class="main">
		<div class="main1">
        <?php if ($layout == 'trangchu') 
        { 
        	// load layout o trang chu 3 cot 180px 500px 300px
        	//include_once('layout/180-500-300/indexhomepage.php');
        	//Load trang chu co 3 cot 300px 500px 180px
        include_once('layout/300-500-180/indexhomepage.php');
        	//Load trang chu co 3 cot 500px 300px 180px
        	//include_once('layout/500-300-180/indexhomepage.php');
        	//Load trang chu co 2 cot 300px  680px
        	//include_once('layout/300-680/indexhomepage.php');
        	//Load layout cua trang chu co 2 cot 600px 180px
        	//include_once('layout/490-490/indexhomepage.php');
        		//Load layout cua trang chu co 2 cot 600px 180px
        	//include_once('layout/680-300/indexhomepage.php');
        }
        else if ($layout == '2cot')
        {	
        	// load layout 2 cot o trang trong
        	include_once('index2col-r.php');
        }
        else if ($layout == '1cot')
        {
        	// load layout 3 cot o trang trong
        	 include_once('index1col.php');
        }	
		   else if ($layout == '2cotsmall')
        {
        	// load layout 3 cot o trang trong
        	 include_once('2cotsmall.php');
        }	
		   else if ($layout == 'map')
        {
        	// load layout 3 cot o trang trong
        	 include_once('map.php');
        }	
        ?>
		
         </div>
         
	<div class="footer-f"><!-- footer  -->
		       <div class='footer'>
			    <div class='footer_l1'>
		         <jdoc:include type="modules" name="footer1" style="xhtml" />
		        </div>
				<div class='footer_l2'>
		         <jdoc:include type="modules" name="footer2" style="xhtml" />
		        </div>
				<div class='footer_l3'>
		         <jdoc:include type="modules" name="footer3" style="xhtml" />
		        </div>
				<div class='footer_l4'>
		         <jdoc:include type="modules" name="footer4" style="xhtml" />
		        </div>
				<div class='footer_l5'>
		         <jdoc:include type="modules" name="footer5" style="xhtml" />
		        </div>
				</div>
        </div><!-- footer -->
	</div><!-- main-->
</div>	
<div class='onfooter'>
	<div class='onfooter-l'>
		 <jdoc:include type="modules" name="onfooter-l" style="xhtml" />
	</div>
	<div class='onfooter-r'>
	 <jdoc:include type="modules" name="onfooter-r" style="xhtml" />
	</div>
</div>
</div>
	<script type="text/javascript"> 
	$(document).ready(function() {
		    	
		jQuery(function() { 		
		jQuery('#posfixed').css('height', jQuery('.main').height());			 
		if (document.getElementById("posfixed")) jQuery('#mainleft').css('margin-top','230px'); 
   			$(window).scroll(function() {   
   				if ($(this).scrollTop()<10) {
   					//$('#bttop').fadeIn(); 
   					$('#bttop').css("display","block");
					//if (document.getElementById("posfixed")) $('#mainleft').css('margin-top','230px');  
   				}else{
   					//$('#bttop').fadeOut();
   					$('#bttop').css("display","block");
					//if (document.getElementById("posfixed")) $('#mainleft').css('margin-top','20px');  
   				}
   			});
		//(function(d, t){var g = d.createElement(t),s = d.getElementsByTagName(t)[0];g.async = true;g.src = 'https://apis.google.com/js/plusone.js';s.parentNode.insertBefore(g, s);})(document, 'script');
		});
	});
   	</script> 
	
</body>
</html>
