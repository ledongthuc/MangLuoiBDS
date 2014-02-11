<?php
/**
* @version		$Id: helper.php 2007-06-12 vinaora $
* @package		Joomla
* @copyright		Copyright (C) 2006 - 2008 VINAORA.COM. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modWeather
{
	function render(&$params)
	{

		$s_weather		=	@$params->get('s_weather', 1);
		$s_gold			=	@$params->get('s_gold', 1);
		$s_forex		=	@$params->get('s_forex', 1);
		
		$widthtable		=	@$params->get( 'widthtable', "100" );
		$pretext  		= 	@$params->get( 'pretext', "" );
		$posttext  		= 	@$params->get( 'posttext', "" );
		
		$content = '<div>';
		$content .= '<script language="JavaScript">var theme = "modules/mod_weather/images/";</script>';
		$content .= '<script language="JavaScript" src="modules/mod_weather/scripts/Lib.js"></script>';
		if ($pretext != "") $content .= '<div>'.$pretext.'</div>';

		$content		 .=	'<div><table class="mod_weather"><tr><td><img border=0 src="modules/mod_weather/images/bgck.png" /><td style="vertical-align:middle"><strong><a href="http://vnexpress.net/User/ck/hcm/" target="_blank" style="color:#000">Bảng Giá Chứng Khoán</a></strong></td></td></tr></table>
		<table cellpadding="0" cellspacing="0" style="text-align: center; width: '.$widthtable.'%;"><tbody  align="center">';
		// Show weather, gold, forex
		
		if($s_weather)		$content	.=	modWeather::spaceer("Weather");
		if($s_gold)			$content	.=	modWeather::spaceer("Gold");
		if($s_forex)		$content	.=	modWeather::spaceer("Forex");
		
		$content		.= "</tbody></table></div>";
		if ($posttext != "") $content		.= '<div>'.$posttext.'</div>';
		$content .= "</div>";
		echo $content;
	}
	function spaceer($a="123")
	{
		$ret = '<tr align="left"><td>';
		$ret .= '<Script language="JavaScript" src="http://vnexpress.net/Service/'.$a.'_Content.js"></Script>';
		$ret .='<Script language="JavaScript" src="modules/mod_weather/scripts/'.$a.'.js"></Script>';
		$ret .='</td></tr>';
		return $ret;
	}
}