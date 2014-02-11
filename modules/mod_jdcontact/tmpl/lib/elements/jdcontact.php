<?php
/*------------------------------------------------------------------------
# J DContact
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2012 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://www.j-download.com
# Technical Support:    http://www.j-download.com/request-for-quotation.html
-------------------------------------------------------------------------*/

defined('_JEXEC') or die( 'Restricted access' );
class JElementjdcontact extends JElement {
	var	$_name = 'jdcontact';

	function fetchElement($name, $values, &$node, $control_name){

		$attributes = $node->attributes();
		$class = isset($attributes['group']) && trim($attributes['group']) == 'end' ? 'lof-end-group' : 'lof-group';
		$title=  isset($attributes['title']) ?  JText::_($attributes['title']):'Group';

		$string = '<div '.($title?"":'style="display:none"').'  class="'.$class.'" title="">'.$title.'</div>';
		if (!defined ('ADD_MEDIA_CONTROL')) {
			define ('ADD_MEDIA_CONTROL', 1);
			$uri = str_replace(DS,"/",str_replace( JPATH_SITE, JURI::base (), dirname(__FILE__) ));
			$uri = str_replace("/administrator/", "", $uri);

			JHTML::stylesheet('form.css', $uri."/media/");
		}
		return $string;
	}
}
?>