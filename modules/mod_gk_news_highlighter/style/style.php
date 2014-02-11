<?php

/**
* Gavick News Highlighter - dynamic styles
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.2 $
**/	

// access restriction for this file haven't any sense
	
// set document type as text/css	

header("Content-Type: text/css");

?>

:focus {
	outline: 0;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter{
	font-family: Verdana, Arial;
	font-size: 11px;
	color: #666;	
}

div<?php echo '#'.$_GET['suffix']; ?>{
	width: <?php echo $_GET['moduleWidth']; ?>px;
	height: <?php echo $_GET['moduleHeight']; ?>px;
	<?php if($_GET['bordercolor'] != '' && $_GET['bordercolor'] != 'transparent') : ?>border-top: 1px solid #<?php echo $_GET['bordercolor']; ?>;<?php endif;?>
	<?php if($_GET['bordercolor'] != '' && $_GET['bordercolor'] != 'transparent') : ?>border-bottom: 1px solid #<?php echo $_GET['bordercolor']; ?>;<?php endif;?>
	<?php if($_GET['bgcolor'] != '' && $_GET['bgcolor'] != 'ransparent') : ?>background: #<?php echo $_GET['bgcolor']; ?>;<?php endif;?>
<!-- clear: both; -->
	overflow: hidden;
	margin-bottom:5px;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_wrapper{
	float: left;
	width: <?php echo ($_GET['extra_divs'] == 1) ? $_GET['moduleWidth'] - $_GET['interfaceWidth']-20 : $_GET['moduleWidth']; ?>px;
	height: <?php echo $_GET['moduleHeight']; ?>px;
	line-height: <?php echo $_GET['moduleHeight']; ?>px;
	overflow: hidden;
	position: relative;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_item{
	width: auto;
	height: <?php echo $_GET['moduleHeight']; ?>px;
	padding-left: 20px;
	display: none;
	position: absolute;
}

div<?php echo '#'.$_GET['suffix']; ?> .nowrap{
	white-space: nowrap;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_title_0{
	padding-left: 5px;
}
div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_title_1{
	padding-left: 5px;
	color:#00C;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_desc{	
	padding-right: 5px;
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface{
	float: left;
	width: <?php echo $_GET['interfaceWidth']; ?>px;
	height: <?php echo $_GET['moduleHeight']; ?>px;
	text-align: right;
	line-height: <?php echo $_GET['moduleHeight']; ?>px;
	z-index: 1000;        
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface .text{
	float: left;
	display: block;
	width: auto;
	padding-left: 5px;
	<?php if($_GET['textleft_color'] != '') : ?>color: #<?php echo $_GET['textleft_color'];?>;<?php endif; ?>
	<?php if($_GET['textleft_style'] == 'italic' || $_GET['textleft_style'] == 'normal') : ?>font-style: <?php echo $_GET['textleft_style'];?>;<?php endif; ?>
	<?php if($_GET['textleft_style'] == 'bold') : ?>font-weight: <?php echo $_GET['textleft_style'];?>;<?php endif; ?>
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface div {width: 30px; float: right;}
div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface a.prev,
div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface a.next {
	cursor: pointer;
	width: 13px;
	height: <?php echo $_GET['moduleHeight']; ?>px;
	display: block;
	background: url('../images/<?php echo $_GET['set'] ?>set.png') no-repeat 0 50%;
	float: left; 
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface a:hover.prev {	
	background-position: -13px 50%;	      
}

div<?php echo '#'.$_GET['suffix']; ?> a, 
div<?php echo '#'.$_GET['suffix']; ?> a:link,
div<?php echo '#'.$_GET['suffix']; ?> a:visited,
div<?php echo '#'.$_GET['suffix']; ?> a:active,
div<?php echo '#'.$_GET['suffix']; ?> a:focus {	
	<?php if($_GET['linkcolor'] != '') : ?>color: #<?php echo $_GET['linkcolor'];?>;<?php endif; ?>
}

div<?php echo '#'.$_GET['suffix']; ?> a:hover {	
	<?php if($_GET['hlinkcolor'] != '') : ?>color: #<?php echo $_GET['hlinkcolor'];?>;<?php endif; ?>
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface a.next {
	float: right;
	background-position: -26px 50%;	   
}

div<?php echo '#'.$_GET['suffix']; ?> .gk_news_highlighter_interface a:hover.next {
	background-position: -39px 50%;	   
}