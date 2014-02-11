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
//if($_SERVER['HTTP_HOST']!='localhost')
//die( 'Restricted access' );
//define('BDS-ThienMinh-117','allow');
include_once (dirname(__FILE__).DS.'ja_vars_1.5.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">

<head>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<!-- PHP, JAVASCRIPT AND CSS MINH THEM -->
<?php include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php'); ?>
<script language="javascript" type="text/javascript" src="libraries/js/ham-tien-ich.js"></script>
<!--hoan chinh sua phan gop css-->
<!--<link rel="stylesheet" href="libraries/TabJoomLa/tab-view.css" type="text/css" />-->
<link rel="stylesheet" href="/ja_cssmenu/ja.cssmenu.css" type="text/css" />

<!--end chinh sua phan gop css-->
<script language="javascript" type="text/javascript" src="libraries/TabJoomLa/tab-view.js"></script>
<script type="text/javascript" src="libraries/js/ajax.js"></script> 
<link rel="stylesheet" href="libraries/js/dhtmltooltip.css" type="text/css">
<script type="text/javascript" src="libraries/js/dhtmltooltip.js"></script>
<script type="text/javascript" src="libraries/js/corner_image.js"></script>    
<script type="text/javascript" src="libraries/js/prototype.lite.js"></script>
<script type="text/javascript" src="libraries/js/moo.fx.js"></script>
<script type="text/javascript" src="libraries/js/moo.fx.pack.js"></script>
<!-- Ket thuc -->

<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/typo.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/ja.vm.css" type="text/css" />

	<!--[if IE]>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/bogocIE.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if IE]>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/ie7.css" rel="stylesheet" type="text/css" />
	<![endif]-->
<!--[if IE 6]>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->


<script language="javascript" type="text/javascript">
	var siteurl = '<?php echo $tmpTools->baseurl();?>';
	var tmplurl = '<?php echo $tmpTools->templateurl();?>';
</script>

<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.script.js"></script>
<!-- js for dragdrop -->

<!-- Menu head -->
<?php if ($jamenu) $jamenu->genMenuHead(); ?>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/colors/<?php echo strtolower ($tmpTools->getParam(JA_TOOL_COLOR)); ?>.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 6]>
<style type="text/css">
img {border: none;}
</style>
<![endif]-->

<?php if ($tmpTools->isIE6()) { ?>
<!--[if lte IE 6]>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/ie6.php" rel="stylesheet" type="text/css" />
<link href="<?php echo $tmpTools->templateurl(); ?>/css/colors/<?php echo strtolower ($tmpTools->getParam(JA_TOOL_COLOR)); ?>-ie6.php" rel="stylesheet" type="text/css" />
<script type="text/javascript">
window.addEvent ('load', makeTransBG);
function makeTransBG() {
makeTransBg($$('img'));
}
</script>
<![endif]-->
<?php } ?>
<!--[if gt IE 7]>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

</head>

<body id="bd" class="<?php echo $tmpTools->getParam(JA_TOOL_LAYOUT);?> <?php echo $tmpTools->getParam(JA_TOOL_SCREEN);?> fs<?php echo $tmpTools->getParam(JA_TOOL_FONT);?>" >


<ul class="accessibility">
	<li><a href="<?php echo $tmpTools->getCurrentURL();?>#ja-content" title="<?php echo JText::_("Skip to content");?>"><?php echo JText::_("Skip to content");?></a></li>
	<li><a href="<?php echo $tmpTools->getCurrentURL();?>#ja-mainnav" title="<?php echo JText::_("Skip to main navigation");?>"><?php echo JText::_("Skip to main navigation");?></a></li>
	<li><a href="<?php echo $tmpTools->getCurrentURL();?>#ja-col1" title="<?php echo JText::_("Skip to 1st column");?>"><?php echo JText::_("Skip to 1st column");?></a></li>
	<li><a href="<?php echo $tmpTools->getCurrentURL();?>#ja-col2" title="<?php echo JText::_("Skip to 2nd column");?>"><?php echo JText::_("Skip to 2nd column");?></a></li>
</ul>
<div id="main">
<div id="main1"><!---hang-->
<div id="main2">
<div id="main3">
<div id="main4">
<div id="main5">
<div id="main6">
<div id="banner">
<!--<div id="position_top">-->
<!--<jdoc:include type="modules" name="top_right" style="raw" />-->
<!--</div>-->
<div class="content_banner">
<div id="logo1">
<jdoc:include type="modules" name="logo" style="raw" />
</div>
<div class="banner">
<jdoc:include type="modules" name="banner" style="raw" />
</div>

		     
<!--<div class="banner">-->
<!--<jdoc:include type="modules" name="banner" style="raw" />-->
</div>
 <div id="bds-dk">
				<jdoc:include type="modules" name="bds-dk" style="box8contentdt" />
			</div> 	
</div>
<!-- BEGIN: HEADER -->
	 
<div id="ja-header" class="clearfix">

<?php if ($tmpTools->getParam('ja_menu') != 'none') : ?>
<div id="ja-mainnavwrap">

 
  <div id="ja-mainnav" class="clearfix">

		<?php if ($jamenu) $jamenu->genMenu (0); ?>
  </div>
	
</div>
<?php endif; ?>
</div>
<!-- END: HEADER -->
</div>
<div id="content">
<div id="ja-wrapper">


<?php if (!$tmpTools->isContentEdit() && $this->countModules('ja-slideshow')) { ?>
<!-- BEGIN: SLIDESHOW -->
<div id="ja-slideshow" class="clearfix">
  <div id="ja-slideshow-bot"><div id="ja-slideshow-top" class="clearfix">
    <jdoc:include type="modules" name="ja-slideshow" style="raw" />
  </div></div>
</div>
<!-- END: SLIDESHOW -->
<?php } ?>
<?php if($this->countModules('onTop') ) : ?><!-- && JRequest::getVar( 'option' ) != 'com_jea' -->
<div id="Top">               
    <div id="leftTop">
  </div>
<div id="onTop">
<jdoc:include type="modules" name="onTop" />
</div> 
<div style="clear:both"></div>
</div>
<?php endif; ?>

<?php if((JRequest::getVar( 'option' ) == 'com_jea' && JRequest::getVar( 'task' ) == 'compare') || (JRequest::getVar( 'option' ) == 'com_content' && JRequest::getVar( 'task' ) == 'edit') || (JRequest::getVar( 'option' ) == 'com_jea' && JRequest::getVar( 'layout' ) == 'form') ) {$divid = '-fr';} ?>
<div id="ja-containerwrap<?php echo $divid; ?>">
<div id="ja-container">
<div id="ja-container-inner" class="clearfix">

	<!-- BEGIN: CONTENT -->
	<div id="ja-mainbodywrap">
	<?php if(($this->countModules('news-left') ||  $this->countModules('news-right')) && JRequest::getVar( 'option' ) != 'com_jea') : ?>
	<div id="bds-news" class="clearfix">
	<div>
		<div id="news-left"><jdoc:include type="modules" name="news-left" style="news" /></div>
		<div id="news-right"><jdoc:include type="modules" name="news-right" style="box8_Gray" /></div>
		
	</div>
	<?php endif; ?>


	<?php if($this->countModules('bds-news-2') && JRequest::getVar( 'option' ) != 'com_jea') { 	?>
	<div class="bds_news">
		<div id="bds-news-2">
			<jdoc:include type="modules" name="bds-news-2" style="box8content1" />
		</div>
		
<!--		<div id="bds-news-4">-->		
		<div id="bds-news-4">
			<jdoc:include type="modules" name="bds-news-3" style="search" />
		</div>
		<div id="bds-news-4">
			<jdoc:include type="modules" name="bds-news-5" style="search1" />
		</div>
		
	</div>
	
	<?php  }   ?>
	
	<div id="ja-mainbody" class="clearfix">

		<div id="ja-contentwrapper">
		 <?php if ( $this->countModules('vm-fp') ) { ?>
        <div id="ja-fp">
          <jdoc:include type="modules" name="vm-fp" style="box8content"  />
        </div>
        <?php } ?>
        
<!--        position doi tac nam duoi slideshow-->
      	 <?php if ( $this->countModules('bds-dt') ) { ?>  
		     <div id="bds-dt">
				<jdoc:include type="modules" name="bds-dt" style="box8contentdt" />
			</div>
	 	 <?php } ?>
	
    <?php //if ( !$tmpTools->isContentEdit() && ($this->countModules('vm-fp') || $this->countModules('ja-slider') || $this->countModules('ja-slider2')) && JRequest::getVar( 'option' ) != 'com_jea' ) { ?>
      <!-- <div id="ja-productwrap"><div id="ja-product-bot"><div id="ja-product-top" class="clearfix"> -->             
       <?php if ( $this->countModules('ja-slider2') ) { ?>
        <div id="ja-slider2">
          <jdoc:include type="modules" name="ja-slider2" style="box8content" />
<!--           <jdoc:include type="modules" name="ja-slider2a" style="pageBDS" />-->
        </div>        
        <?php } ?>
      <?php //} ?>  
            <?php if ( $this->countModules('search_left')&& $this->countModules('search_right') ) { ?>
      <div >
                <div id="search_left">
                <jdoc:include type="modules" name="search_left" style="box8content" />
                </div>
                <div id="search_right">
                 <jdoc:include type="modules" name="search_right" style="box8content" />
                </div>
        </div>
        <div style="clear:both"></div>
         <?php } ?>
         
         <?php if ( !$tmpTools->isContentEdit() && ($this->countModules('vm-fp') || $this->countModules('ja-slider') || $this->countModules('ja-slider2')) && JRequest::getVar( 'option' ) != 'com_jea' ) { ?> 
        <?php if ( $this->countModules('ja-slider') ) { ?>
        <div id="ja-slider">
          <jdoc:include type="modules" name="ja-slider" style="box8content" />
        </div>        
        <?php } ?>
         <?php } ?>
        
        <!--        position phan quang cao nam o giua-->
      	 <?php if ( $this->countModules('bds-qcg') ) { ?>  
		     <div id="bds-dt">
				<jdoc:include type="modules" name="bds-qcg" style="box8content1aa" />
			</div>
	 	 <?php } ?>
	 	 
	 	  <?php if ( !$tmpTools->isContentEdit() && ($this->countModules('vm-fp') || $this->countModules('ja-slider_m') || $this->countModules('ja-slider2')) && JRequest::getVar( 'option' ) != 'com_jea' ) { ?> 
        <?php if ( $this->countModules('ja-slider_m') ) { ?>
        <div id="ja-slider">
          <jdoc:include type="modules" name="ja-slider_m" style="box8content" />
        </div>        
		<div id="ja-slider">
          <jdoc:include type="modules" name="ja-slider_n" style="box8content2" />
        </div> 
        <?php } ?>
     
  <!--    </div></div></div>  -->
    <?php } ?>
 <!-- BEGIN: CONTENT -->
		<!-- code de tat khung show component o trang chu -->
                                                        <?php if( JRequest::getVar( 'view' ) == 'frontpage' ) { 
														// ban dang o trang chu
                                                            // thuc hien bat cu cong viec gi ban muon
														?>
                                                            
                                                        <?php } else {
														// ban khong o trang chu
                                                            // hien thi main body binh thuong
														 ?>
                          <!--              <div id="ja-contentwrap"><div id="ja-content"><div id="ja-current-content" class="clearfix">    -->
		 <div id="box8content">
				  	<div id="box8content_top_mid">
                        <div id="box8content_right_mid">
                            <div id="box8content_left_mid">
								<div id="box8content_top_left">
									<div id="box8content_top_right">
										<div id="box8content_bottom_right">
											<div id="box8content_bottom_left"> 
											 <div id="box8_content"> 
                                               <div id="box8_content_com">
			<jdoc:include type="message" />

			
    		<jdoc:include type="component" />
											 </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                  </div>
				 </div>
			</div>

<!-- 			 </div></div></div> -->
                                                        <?php } ?>
						<!-- ket thuc code -->		
		<!-- END: CONTENT -->

		
    </div>

	  <?php if ($ja_left) { ?>
	  <!-- BEGIN: LEFT COLUMN -->
		<div id="ja-col1">
		<div class="ja-innerpad">

			<?php if ($hasSubnav) : ?>
			<div id="ja-subnav" class="module_menu"><div><div><div>
				<h3>On this page</h3>
				<?php if ($jamenu) $jamenu->genMenu (1,1);	?>
			</div></div></div></div>
			<?php endif; ?>
		
			<jdoc:include type="modules" name="left" style="box8_Gray" />

		</div>
		</div>
		<!-- END: LEFT COLUMN -->
		<?php } ?>

	</div></div>
	<!-- END: CONTENT -->
		
	<?php  if ($ja_right && 
		(JRequest::getVar( 'option' ) == 'com_jea' 
					&& JRequest::getVar( 'controller' ) == 'projects' 
					&& JRequest::getVar( 'id' ) != '') 
		|| (JRequest::getVar( 'option' ) == 'com_jea' && JRequest::getVar( 'task' ) == 'compare') 
		|| (JRequest::getVar( 'option' ) == 'com_content' && JRequest::getVar( 'task' ) == 'edit') 
		|| (JRequest::getVar( 'option' ) == 'com_jea' && JRequest::getVar( 'layout' ) == 'form')) {} else {;
		?>
	<!-- BEGIN: RIGHT COLUMN -->
	<div id="ja-col2">
	<div class="ja-innerpad">
		<jdoc:include type="modules" name="right3" style="box8_Gray" />
	<jdoc:include type="modules" name="right1" style="box8_right" />
	<jdoc:include type="modules" name="right2" style="box8_right2" />
		<jdoc:include type="modules" name="right" style="box8_Gray" />
		<jdoc:include type="modules" name="right_adv" style="box8_Gray1" />
	</div></div>
	<!-- END: RIGHT COLUMN -->
	<?php } 
	//} ?>

</div></div>
</div>

	<?php
	$spotlight = array ('user1','user2','user5','user6','user7');
	$botsl = $tmpTools->calSpotlight ($spotlight,$tmpTools->isOP()?100:99.9);
	if( !$tmpTools->isContentEdit() && $botsl ) {
	?>
	<!-- BEGIN: BOTTOM SPOTLIGHT-->
	<div id="ja-botsl"><div id="ja-botsl-bot"><div id="ja-botsl-top" class="clearfix">
	
	  <?php if( $this->countModules('user1') ) {?>
	  <div class="ja-box<?php echo $botsl['user1']['class']; ?>" style="width: <?php echo $botsl['user1']['width']; ?>;">
			<jdoc:include type="modules" name="user1" style="xhtml" />
	  </div>
	  <?php } ?>
	  
	  <?php if( $this->countModules('user2') ) {?>
	  <div class="ja-box<?php echo $botsl['user2']['class']; ?>" style="width: <?php echo $botsl['user2']['width']; ?>;">
			<jdoc:include type="modules" name="user2" style="xhtml" />
	  </div>
	  <?php } ?>
	  
	  <?php if( $this->countModules('user5') ) {?>
	  <div class="ja-box<?php echo $botsl['user5']['class']; ?>" style="width: <?php echo $botsl['user5']['width']; ?>;">
			<jdoc:include type="modules" name="user5" style="xhtml" />
	  </div>
	  <?php } ?>
	
	  <?php if( $this->countModules('user6') ) {?>
	  <div class="ja-box<?php echo $botsl['user6']['class']; ?>" style="width: <?php echo $botsl['user6']['width']; ?>;">
			<jdoc:include type="modules" name="user6" style="xhtml" />
	  </div>
	  <?php } ?>

	  <?php if( $this->countModules('user7') ) {?>
	  <div class="ja-box<?php echo $botsl['user7']['class']; ?>" style="width: <?php echo $botsl['user7']['width']; ?>;">
			<jdoc:include type="modules" name="user7" style="xhtml" />
	  </div>
	  <?php } ?>

	</div></div></div>
	<!-- END: BOTTOM SPOTLIGHT -->
	<?php } ?>
 <?php if( $this->countModules('bds-bottom') ) :?>
<div id="bds-bottom"><jdoc:include type="modules" name="bds-bottom" style="news" /></div>
<?php endif; ?>
<!--<div id="ja-header" class="clearfix"><?php //if ($jamenu) $jamenu->genMenu (0); ?></div>-->
<script type="text/javascript">
	addSpanToTitle();
	//jaAddFirstItemToTopmenu();
	//jaRemoveLastContentSeparator();
	//jaRemoveLastTrBg();
	//moveReadmore();
	//addIEHover();
	//slideshowOnWalk ();
	jaMenuIcon();
	fixMenuWidth();
</script>
</div>
</div>
</div><!-- main2 -->
</div><!-- main3 -->
</div><!-- main4 -->
</div><!-- mani5 -->
</div><!-- main 6 -->

  <!--        position phan quang cao nam o duoi gan footer-->
      	 <?php //if ( $this->countModules('bds-qcd') ) { ?>  
		     <div id="bds-qcd1" style="padding-left:4px;">
				<jdoc:include type="modules" name="bds-qcd" style="box8contentqcd" />
			</div>
	 	 <?php //} ?>

<div id="footer">
	<div style="float:left">
	<jdoc:include type="modules" name="footer_left" />
	</div>
	
	<div class="footer_right">
		<jdoc:include type="modules" name="footer_right" />
		<jdoc:include type="modules" name="footer" />
	</div>
</div>






<!--</div>-->
</div><!--main1--->

</body>

</html>
