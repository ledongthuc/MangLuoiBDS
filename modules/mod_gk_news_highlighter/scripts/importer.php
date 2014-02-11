<?php

/**
* Gavick News Highlighter - importer file
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.1 $
**/

// access restriction for this file haven't any sense

/*
	This file generate configuration JSON data for specified in $_GET variables module
*/
	
// set document type as tsext/javascript	

header("Content-Type: text/javascript");
	
?>

try {$Gavick;}catch(e){$Gavick = {};};

$Gavick["gk_news_highlighter<?php echo $_GET['module_id'];?>"] = {
		"animationType" : <?php echo $_GET['animation_type']; ?>,
		"animationSpeed" : <?php echo $_GET['animation_speed']; ?>,
		"animationInterval" : <?php echo $_GET['animation_interval']; ?>,
		"animationFun" : <?php echo $_GET['animation_fun']; ?>,
		"mouseover" : <?php echo $_GET['mouseover']; ?>
};