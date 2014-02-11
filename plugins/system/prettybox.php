<?php
/**
 * Pretty Box System Plugin
 *  
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Pretty Box plugin
 *
 */
class  plgSystemPrettyBox extends JPlugin
{

	function plgSystemPrettyBox(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	* Converting the site URL to fit to the HTTP request
	*
	*/
	function onAfterDispatch()
	{
		global $mainframe;
		
		if ($mainframe->isAdmin()) return;
		
		$doc	=& JFactory::getDocument();
		$doctype	= $doc->getType();

		// Only render for HTML output
		if ( $doctype !== 'html' ) { return; }

		$profiler	=& $_PROFILER;
		
		// get parameter
		$theme = $this->params->get('theme', 'default');
		if($theme=='custom'){
			$theme=$this->params->get('custom_theme','default');
		}
		$theme='pp_'.$theme;
		
		$jqueryJS = JURI::root(true)."/plugins/system/pretty/js/jquery-1.4.4.min.js";
		$prettyboxJS = JURI::root(true)."/plugins/system/pretty/js/jquery.prettyPhoto.js";
		//$prettyboxJS = JURI::root(true)."/plugins/system/pretty/js/jquery.multy.photo.js";
		$modphotoJS=JURI::root(true)."/modules/mod_photo/js/jquery.mod_photo.js";
		$prettyboxCSS = JURI::root(true)."/plugins/system/pretty/css/".$theme.".css";
		
		//$doc->addScript($jqueryJS);
		$doc->addScript($prettyboxJS);
		//$doc->addScript($modphotoJS);
		$doc->addStyleSheet($prettyboxCSS);
		
		if ($this->params->get('custom-legacy', 0) == 1) {
			$config=$this->loadManualConfiguration($theme);
		} else {
			$config=$this->loadManualDefault($theme);
		}
		$doc->addScriptDeclaration($config);
	}
	
	function onAfterRender() {
		global $mainframe;		
		if ($mainframe->isAdmin()) return;
        $app =& JFactory::getApplication();
		$theme = $this->params->get('theme', 'default');
		if($theme=='custom'){
			$theme=$this->params->get('custom_theme','default');
		}       
        $file = file_get_contents(JURI::base()."plugins/system/pretty/html/".$theme.".html",true);
		if($file!=null && $file!=''){
        	$popup='0';
        	$file=preg_replace("/popupid/",$popup,$file);
        }
        JResponse::appendBody($file);        
    }
	
	function loadManualConfiguration($theme)
	{		
	    $config="
	    		//jQuery.noConflict();
	    		$(document).ready(function(){
				$(\"a[rel^='prettybox']\").prettyPhoto({animation_speed:'".$this->params->get('animation_speed','normal')."',
														opacity:'".$this->params->get('opacity','0.20')."',
														slideshow:".$this->params->get('slideshow','5000').",
														default_width:".$this->params->get('default_width','600').",
														default_height:".$this->params->get('default_height','480').",
														autoplay_slideshow:".$this->params->get('autoplay_slideshow','false').",
														show_title:".$this->params->get('show_title','true').",
														allow_resize:".$this->params->get('allow_resize','false').",
														default_width:".$this->params->get('default_width','640').",
														default_height:".$this->params->get('default_height','480').",
														width_content:".$this->params->get('width_content','650').",
														height_content:".$this->params->get('height_content','490').",
														width_popup:".$this->params->get('width_popup','650').",
														height_popup:".$this->params->get('height_popup','490').",
														thumbnail_size:".$this->params->get('thumbnail_size','50').",
														show_hoverbutton:".$this->params->get('show_hoverbutton','false').",
														show_thumbnailbutton:".$this->params->get('show_thumbnailbutton','false')."														
													});
			});";
		return $config;		
	}
	
	function loadManualDefault($theme)
	{
		$config="$(document).ready(function(){
				$(\"a[rel^='prettybox']\").prettyPhoto({animation_speed:'normal',theme:'$theme'});
			});";
		return $config;
	}
}