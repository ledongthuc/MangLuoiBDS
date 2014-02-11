
<?php
/**
* @version		$Id: helper.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modTyGiaHelper {
	
	function getData($link){		
		$result = array();
		$content = @file_get_contents($link);		
		$content = str_replace('var ', '', $content);
		$content = str_replace('new ', '', $content);
		$content = str_replace('Array ', 'array', $content);
		
		$content = str_replace('vForexs', '$'.'vForexs', $content);
		$content = str_replace('vCosts', '$'.'vCosts', $content);
		
		$allowed = "/[^a-z0-9\\$\\020\\[\\]\\'\\\"\\;\\=\\040\\(\\)\\.\\,\\-\\_\\\\]/i";
		$content = preg_replace($allowed,"",$content);

		eval($content);
		
		$result[0] = $vForexs;
		$result[1] = $vCosts;
		
		return $result;
	}
	
	
}
