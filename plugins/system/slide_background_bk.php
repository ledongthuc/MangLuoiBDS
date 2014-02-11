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
class  plgSystemSlide_background extends JPlugin
{

	function plgSystemSlide_background(& $subject, $config)
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
		$listfile = $this->params->get('filename', '');
		
		if($listfile!=''){	
					
			$url=JURI::root().'images/background/';
			$listfile=explode(";",$listfile);
			
			$num=count($listfile);
			$result="<section style='display: block;' id='slider-wrapper'>";
			$result.="<div id='faded'><div style='position: relative;' align='center' class='rap'>";
			for($i=0;$i<$num;$i++){
				$result.="<img src='".$url.$listfile[$i]."' alt='' />";
			}
			$result.="</div></div></section>";		
			
			$jqueryJS = JURI::root(true)."/plugins/system/slide_background/js/jquery-1.js";
			$slideJS = JURI::root(true)."/plugins/system/slide_background/js/sbjquery.js";
			$slideCSS = JURI::root(true)."/plugins/system/slide_background/css/sbstyle.css";
			
			$doc->addScript($jqueryJS);
			$doc->addScript($slideJS);
			$doc->addStyleSheet($slideCSS);
			
			$div=$this->addHtml($result);
			$doc->addScriptDeclaration($div);
			$config=$this->loadManualDefault();
			$doc->addScriptDeclaration($config);
		}
	}
	
	function loadManualDefault()
	{
		$autoplay=$this->params->get('autoplay','1');
		if($autoplay==1)
		{
			$autoplay=9000;
		}
		$config="jQuery(window).load(function () {
			jQuery('#faded').faded({
				speed: ".$this->params->get('speed','500').",
				autoplay: ".$autoplay."
			});
			jQuery('#slider-wrapper').show();
		});";
		return $config;
	}
	
	function addHtml($str)
	{
		//$div="$(#wrapper).append(\"".$str."\");";		
		/*$div="$(document).ready(function(){
				$('#wrapper').append(\"$str\");
			});";*/
		$div="$(document).ready(function(){
				$('#slider').append(\"$str\");
			});";
		return $div;
	}
}