<?php
/**
 * @version		$Id: mediaplayer.php
 * @package		MediaPlayer
 * @subpackage	Content
 * @copyright	Copyright (C) 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
//Now set the registerEvent. The action will start before the content is opened.
//In plgContentVote you should replace Vote by the name of your own Plugin.
$mainframe->registerEvent( 'onPrepareContent', 'plgContentMediaPlayer' );
JPlugin::loadLanguage( 'plg_content_mediaplayer' );
//Here the real function starts.
function plgContentMediaPlayer( &$row, &$params, $page=0 )
{
	// simple performance check to determine whether bot should process further	
	if ( JString::strpos( $row->text, '{player' ) === false ) 
	{
		return true;
	}
	
	// Get Plugin info
 	$plugin =& JPluginHelper::getPlugin('content', 'mediaplayer');
	//Access the parameters	
	$mp_params = new JParameter( $plugin->params );

	//Design
	$width		=	$mp_params->get( 'width' );
	$height		=	$mp_params->get( 'height' );
	$backcolor	=	$mp_params->get( 'backcolor' );
	$lightcolor	=	$mp_params->get( 'lightcolor' );
	$frontcolor	=	$mp_params->get( 'frontcolor' );
	$cbar		=	$mp_params->get( 'cbar' );
	$skin		=	$mp_params->get( 'skin' );
	$logo		=	$mp_params->get( 'logo' );
	$icons		=	$mp_params->get( 'icons' );	
	//Behaviour
	$volume 	= 	$mp_params->get( 'volume' );
	$item		=	$mp_params->get( 'item' );
	$autostart 	= 	$mp_params->get( 'autostart' );
	$repeat 	= 	$mp_params->get( 'repeat' );
	$shuffle 	= 	$mp_params->get( 'shuffle' );
	$stretch	=	$mp_params->get( 'stretch' );
	$buffer		=	$mp_params->get( 'buffer' );
	//Constants
	require_once (dirname(__FILE__).DS.'mediaplayer/constants.php');
	// define the regular expression for the bot
	$regex = '/{player\s*(.*?)}\s*(.*?){\/player}/i';	

	// perform the replacement
	$row->text = preg_replace_callback( $regex, 'plgContentMediaPlayer_replacer', $row->text );

	return true;
}

function plgContentMediaPlayer_replacer( &$matches )
{
	static $c;
	
	if(empty($matches[1]))
	{
		$width 	= _WIDTH_;
		$height = _HEIGHT_;
		$image 	= '';
	}
	else
	{
		$atributes = explode(' ', $matches[1]);		
		
		for($i=0; $i<3; $i++)
		{
			if(eregi('w:', $atributes[$i]))
				$width = substr($atributes[$i], 2);
			if(eregi('h:', $atributes[$i]))
				$height = substr($atributes[$i], 2);
			if(eregi('i:', $atributes[$i]))
				$image = substr($atributes[$i], 2);				
		}
		if(empty($width))
			$width 	= _WIDTH_;
		if(empty($height))
			$height = _HEIGHT_;
		if(empty($image))
			$image 	= '';
		else
			$image = '&image=' . $image;
	}

	$text = $matches[2];
	$text = _PlayerDIV_1_ . ++$c . _PlayerDIV_2_ .'
	<script type="text/javascript" src="plugins/content/mediaplayer/swfobject.js"></script>
	<script type="text/javascript">
		var s1 = new SWFObject("'. _URL_ .'player.swf","ply","' . $width . '","' . $height . '","9","#FFFFFF");
		s1.addParam("allowfullscreen","true");
		s1.addParam("allowscriptaccess","always");
		s1.addParam("flashvars","file='.$text. _BACK_ . _FRONT_ . _LIGHT_ . _CBAR_ . 
		_SKIN_ . _LOGO_ . _ICONS_ .  _VOLUME_ . 
		_AUTOSTART_. _REPEAT_ . _SHUFFLE_ . _STRETCH_ . _BUFFER_ .
		$image .
		'");
		s1.write("plg_mediaplayer'. $c .'");
	</script>';
	return $text;
}