<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<html>
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/templates.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/menus/ja_moomenu/ja.moomenu.css" type="text/css" />
<script src="<?php echo $tmpTools->templateurl(); ?>/menus/ja_moomenu/ja.moomenu.js" language="javascript" type="text/javascript" ></script>
</head>
<body id="bd"> 
	<div id="main"><!-- main-->
		<div class='sun'>
		<jdoc:include type="modules" name="sun" style="sun" />
		</div>
    	<div id="banner"> <!-- banner-->
		
			<div class="bner"><!-- logo -->
				<div id="banner-l">
					<jdoc:include type="modules" name="banner-l" style="banner" />
				</div>
				<div id='banner-r'>
                <div>
				<!--
				<div class="banner_r_logo">
				<object height="130" width="500" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,124,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
				<param name="src" value="images/stories/banner.swf" />
				<param name="wmode" value="transparent" />
				<param name="base" value="http://i-land.vn/enrichland/" />				
				<param name="name" value="banner.swf" />
				<embed height="130" width="500" name="banner.swf"  wmode="transparent" src="images/stories/banner.swf" type="application/x-shockwave-flash"></embed>
				</object>				
				</div>
				-->
					<jdoc:include type="modules" name="banner-r" />
					
                </div>
                <div id="menuheader"> <!-- menu -->
				<div id='classmenu' class="classmenu" >
					<div class="temp">
							<?php if ($tmpTools->getParam('ja_menu') != 'none') : ?>
							<?php if ($jamenu) $jamenu->genMenu(0); ?>
							<?php endif;?>
					</div>
					
				</div>
				
			</div> <!-- menu --->
                  
				</div>
            
			</div><!-- logo-->

			
			
        </div><!-- banner-->		
  
		<div class="main"> <!-- class main -->
	
	
        <?php if ($layout == 'trangchu') 
        { 
        	// load layout o trang chu 3 cot 180px 500px 300px
        	//include_once('layout/180-500-300/indexhomepage.php');
        	//Load trang chu co 3 cot 300px 500px 180px
        	//include_once('layout/300-500-180/indexhomepage.php');
        	//Load trang chu co 3 cot 500px 300px 180px
        //	include_once('layout/500-300-180/indexhomepage.php');
        	//Load trang chu co 2 cot 300px  680px
        	include_once('layout/300-680/indexhomepage.php');
        	//Load layout cua trang chu co 2 cot 600px 180px
        	//include_once('layout/490-490/indexhomepage.php');
        		//Load layout cua trang chu co 2 cot 600px 180px
        	//include_once('layout/680-300/indexhomepage.php');
        }
        else if ($layout == '2cot')
        {	
        	// load layout 2 cot o trang trong
        	include_once('index2col-l.php');
        }
        else if ($layout == '3cot')
        {
        	// load layout 3 cot o trang trong
        	// include_once('index3col.php');
        }	
        ?>


        </div><!-- class main -->
	     
	</div><!-- main-->
	
	<div id="footer"><!-- footer  -->
		       <div class='footer'>
			        <div class='footer_l'>
		         <jdoc:include type="modules" name="footer-l" style="raw" />
		        </div>
			    <div class='footer_r'>
			       <jdoc:include type="modules" name="footer-r" style="raw" />
			    </div>
				</div>
        </div><!-- footer -->
</body>
<script type="text/javascript" src="libraries/com_u_re/js/utils.js"></script>
</html>
