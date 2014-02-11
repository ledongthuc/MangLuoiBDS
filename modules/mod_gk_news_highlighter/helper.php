<?php

/**
* Gavick News Highlighter - helper class
* @package Joomla!
* @Copyright (C) 2008-2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.5.1 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

// import JString class for UTF-8 problems
jimport('joomla.utilities.string'); 

class NewsHighlighter
{	
	var $config,
	$content,
	$ids_tab,
	$SIDTab, 
	$titleTab,
	$textTab, 
	$idTab,
	$cidTab;
	
	function init(&$params)
	{
		global $mainframe;
		//
		$this->config = array(
			'module_id' => 0, 
			'moduleHeight' => 0,
			'moduleWidth' => 0,
			'interfaceWidth' => 0,
			'extra_divs' => 0,
			'arrows' => 0,
			'news_amount' => 0,
			'section' => 0,
			'category' => 0,
			'sections' => 0,
			'categoriess' => 0,
			'IDs' => 0,
		    'news_sort_value' => 0,
			'news_sort_order' => 0,
			'news_frontpage' => 0, 
			'unauthorized' => 0,
			'only_frontpage' => 0,
			'startposition' => 0,
			'links' => 0,
			'show_title' => 0,
			'show_description' => 0,
			'title_length' => 0,
			'desc_length' => 0,
			'bgcolor' => 0,
			'bordercolor' => 0,
			'linkcolor' => 0,
			'hlinkcolor' => 0,
			'textleft_color' => 0,
			'textleft_style' => 0,	
			'animation_type' => 0,
			'animation_fun' => 0,
			'animation_speed' => 0,
			'animation_interval' => 0,
			'mouseover' => 0,
			'useMoo' => 0, 
			'useScript' => 0, 
			'clean_code' => 0,
			'compress_js' => 0,
			// value necessary for compatibility with engine
			'username' => 1
		);
		//
		$this->config['module_id'] = $params->get('module_id',"news-highlight-1"); 
		$this->config['moduleHeight'] = $params->get('moduleHeight', 24);
		$this->config['moduleWidth'] = $params->get('moduleWidth' ,780);
		$this->config['interfaceWidth'] = $params->get('interfaceWidth', 120);
		$this->config['extra_divs'] = $params->get('extra_divs', 1);
		$this->config['arrows'] = $params->get('arrows', 1);
		$this->config['introtext'] = $params->get('introtext', 'HOT NEWS');
		//
        $this->config['news_amount'] = $params->get('news_amount', 10);
        $this->config['section'] = $params->get('section', 0);
        $this->config['category'] = $params->get('category', 0);
        $this->config['sections'] = $params->get('sections', '');
        $this->config['categoriess'] = $params->get('categories', '');
        $this->config['IDs'] = $params->get('ids', '');
        $this->config['news_sort_value'] = $params->get('news_sort_value', 0);
		$this->config['news_sort_order'] = $params->get('news_sort_order', 0);
		$this->config['news_frontpage'] = $params->get('news_frontpage',1);
		$this->config['unauthorized'] = $params->get('unauthorized', 0);
		$this->config['only_frontpage'] = $params->get('only_frontpage', 0);
		$this->config['startposition'] = $params->get('startposition', 0);
    	//
        $this->config['links'] = $params->get('links', 1);
        $this->config['show_title'] = $params->get('show_title', 1);
        $this->config['show_description'] = $params->get('show_description', 1);
    	$this->config['title_length'] = $params->get('title_length', 50);
        $this->config['desc_length'] = $params->get('desc_length', 50);
        //
        $this->config['bgcolor'] = $params->get('bgcolor', '#FFFFEE');
        $this->config['bordercolor'] = $params->get('bordercolor', '#E9E9A1');
        $this->config['linkcolor'] = $params->get('linkcolor', '');
		$this->config['hlinkcolor'] = $params->get('hlinkcolor', '');
		$this->config['textleft_color'] = $params->get('textleft_color', '');
		$this->config['textleft_style'] = $params->get('textleft_style', 'normal');
		//
        $this->config['animation_type'] = $params->get('animationType', 1);
        $this->config['animation_fun'] = $params->get('animationFun', 'Fx.Transitions.linear');
		$this->config['animation_interval'] = $params->get('animationInterval', 5000);
		$this->config['animation_speed'] = $params->get('animationSpeed', 250);
		$this->config['mouseover'] = $params->get('mouseover', 1);
		//
		$this->config['useMoo'] = $params->get('useMoo',1);
		$this->config['useScript'] = $params->get('useScript',1);
		$this->config['compress_js'] = $params->get('compress_js', 1);
		$this->config['clean_code'] = $params->get('clean_code', 1);
		//
		$db =& JFactory::getDBO();
		// getting instance of GK_JoomlaNews
		$newsClass = new GK_JoomlaNews();
		// Getting list of categories
		$categories = $newsClass->getSources($this->config, 0);
		//
		$sql_where = '';
		// if in database exist some needs datas
		if($categories)
		{
			//
			$j = 0;
			// getting categories ItemIDs
			foreach ($categories as $item) 
			{
				//
				$sql_where .= ($j != 0) ? ' OR content.catid = '.$item->ID : ' content.catid = '.$item->ID;
				//
				$j++;
			}
		}
		// getting content
		$this->content = $newsClass->getNewsStandardMode($categories, $sql_where, $this->config, $this->config['news_amount']);
		//
		$this->SIDTab = $this->content['SID'];
		$this->titleTab = $this->content['title']; 
		$this->textTab = $this->content['text']; 
		$this->idTab = $this->content['ID'];
		$this->cidTab = $this->content['CID'];
	}
	
	function render(&$params)
	{
		$content = array();
		//
		$r=0;
		for($i = 0; $i < count($this->idTab); $i++)
		{
		$r=1-$r;
			$content[$i] = '';
			//
			if($this->config['links'] == 1)
			{
				$content[$i] .= '<a href="'.JRoute::_(ContentHelperRoute::getArticleRoute($this->idTab[$i], $this->cidTab[$i], $this->SIDTab[$i])).'">';
			}
			//
			if($this->config['show_title'] == 1)
			{
				$content[$i] .= '<span class="gk_news_highlighter_title_'.$r.'">'.JString::substr($this->titleTab[$i], 0, $this->config['title_length']).((JString::strlen($this->titleTab[$i]) > $this->config['title_length']) ? '...' : '').'</span>';
			}
			//
			if($this->config['show_description'] == 1)
			{
				if($this->config['show_title'] == 1) $content[$i] .= ' &raquo; ';
				// 
				$content[$i] .= '<span class="gk_news_highlighter_desc">'.JString::substr(strip_tags($this->textTab[$i]), 0, $this->config['desc_length']).''.((JString::strlen(strip_tags($this->textTab[$i])) > $this->config['desc_length']) ? '...' : '').'</span>';
			}
			//
			if($this->config['links'] == 1)
			{
				$content[$i] .= '</a>';
			}
		}
		
		// create instances of basic Joomla! classes
		$document =& JFactory::getDocument();
		$uri = JURI::getInstance();
		// add stylesheets to document header
		$document->addStyleSheet( $uri->root().'modules/mod_gk_news_highlighter/style/style.php?suffix='.$this->config['module_id'].'&amp;moduleHeight='.$this->config['moduleHeight'].'&amp;moduleWidth='.$this->config['moduleWidth'].'&amp;interfaceWidth='.$this->config['interfaceWidth'].'&amp;extra_divs='.$this->config['extra_divs'].'&amp;bgcolor='.substr($this->config['bgcolor'], 1).'&amp;bordercolor='.substr($this->config['bordercolor'], 1).'&amp;set='.$this->config['arrows'].'&amp;linkcolor='.substr($this->config['linkcolor'], 1).'&amp;hlinkcolor='.substr($this->config['hlinkcolor'], 1).'&amp;textleft_color='.substr($this->config['textleft_color'], 1).'&amp;textleft_style='.$this->config['textleft_style'], 'text/css' );	
		// init $headData variable
		$headData = false;
		// add scripts with automatic mode to document header
		if($this->config['useMoo'] == 2)
		{
			// getting module head section datas
			unset($headData);
			$headData = $document->getHeadData();
			// generate keys of script section
			$headData_keys = array_keys($headData["scripts"]);
			// set variable for false
			$mootools_founded = false;
			// searching phrase mootools in scripts paths
			for($i = 0;$i < count($headData_keys); $i++)
			{
				if(preg_match('/mootools/i', $headData_keys[$i]))
				{
					// if founded set variable to true and break loop
					$mootools_founded = true;
					break;
				}
			}
			// if mootools file doesn't exists in document head section
			if(!$mootools_founded)
			{
				// add new script tag connected with mootools from module
				$headData["scripts"][$uri->root().'modules/mod_gk_news_highlighter/js/mootools.js'] = "text/javascript";
				// if added mootools from module then this operation have sense
				$document->setHeadData($headData);
			}
		}
		
		if($this->config['useScript'] == 2)
		{
			// getting module head section datas
			unset($headData);
			$headData = $document->getHeadData();
			// generate keys of script section
			$headData_keys = array_keys($headData["scripts"]);
			// set variable for false
			$engine_founded = false;
			// searching phrase mootools in scripts paths
			if(array_search($uri->root().'modules/mod_gk_news_highlighter/scripts/engine'.(($this->config['compress_js'] == 1) ? '_compress' : '').'.js', $headData_keys) > 0)
			{
				// if founded set variable to true
				$engine_founded = true;
			}
			// if mootools file doesn't exists in document head section
			if(!$engine_founded)
			{
				// add new script tag connected with mootools from module
				$headData["scripts"][$uri->root().'modules/mod_gk_news_highlighter/scripts/engine'.(($this->config['compress_js'] == 1) ? '_compress' : '').'.js'] = "text/javascript";
				// if added mootools from module then this operation have sense
				$document->setHeadData($headData);
			}
		}
	
		// if clean code is enable use importer.php to include 
		// module settings in head section of document
		if($this->config['clean_code'] == 1)
		{
			/* 
				add script tag with module configuration to document head section
			*/	
			
			// get head document section data 
			unset($headData);
			$headData = $document->getHeadData();
			// add new script tag to head document section data array				
			$headData["scripts"][$uri->root().'modules/mod_gk_news_highlighter/scripts/importer.php?module_id='.$this->config['module_id'].'&amp;animation_type='.$this->config['animation_type'].'&amp;animation_speed='.$this->config['animation_speed'].'&amp;animation_interval='.$this->config['animation_interval'].'&amp;animation_fun='.$this->config['animation_fun'].'&amp;mouseover='.$this->config['mouseover']] = "text/javascript";
			// if added mootools from module then this operation have sense
			$document->setHeadData($headData);
		} 
						
		// add default.php template to parse if it's needed
		if($this->config['useMoo'] != 2 || $this->config['useScript'] != 2 || $this->config['clean_code'] == 0)
		{
			require(JModuleHelper::getLayoutPath('mod_gk_news_highlighter', 'default'));
		}
		
		require(JModuleHelper::getLayoutPath('mod_gk_news_highlighter', 'content'));
	}
}

?>