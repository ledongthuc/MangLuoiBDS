<?php

/**
* Gavick News Highlighter - main PHP file
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.1 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

// helper loading
require_once (dirname(__FILE__).DS.'helper.php');
//
if (!class_exists('GK_JoomlaNews')) 
{
	require_once (dirname(__FILE__).DS.'gk_classes'.DS.'joomla.news.class.php');
}
//
$helper = new NewsHighlighter(); 
// run variables validation
$helper->init($params);
// creating XHTML code	
$helper->render($params);

?>