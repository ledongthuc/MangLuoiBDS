<?php
/**
 * Helper File
 *
 * @package     CustoMenu
 * @version     2.5.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

 /**
 * CustoMenu Helper
 */
class modCustoMenuHelper
{
	function getOutput( &$params )
	{
		global $mainframe, $Itemid;

		$params = new JParameter( $params->_raw, JPATH_SITE.DS.'modules'.DS.'mod_customenu'.DS.'mod_customenu.xml' );
		$this->params = modCustoMenuHelper::getParamValues( $params );
		
		modCustoMenuHelper::setExtraParams();

		// Script
		JHTML::script( 'customenu.js', 'modules/mod_customenu/customenu/js/' );
		
		// Stylesheet
		if ( $this->_params->stylesheet ) {
			JHTML::stylesheet( $this->_params->stylesheet, 'modules/mod_customenu/customenu/css/' );
		}
		
		// Get menu items
		$items = modCustoMenuHelper::getItems();
		
		// Generate output by layout
		$output = modCustoMenuHelper::getLayoutOutput( $items );
		
		return $output;
	}
	
	function setExtraParams()
	{
		global $mainframe;

		$user =& JFactory::getUser();
		
		$this->_params = '';
		// PARAMS
		$this->_params->use_menu =				$this->params->use_menu;
		$this->_params->show_unpublished =		$this->params->show_unpublished;
		$this->_params->access =				$user->get( 'aid', 0 );
		$this->_params->show_non_access =		$this->params->show_non_access;
		$this->_params->active_on_child_ids =	$this->params->active_on_child_ids;
		$this->_params->hide_text =				$this->params->hide_text;
		$this->_params->layout =				$this->params->layout;
		$this->_params->stylesheet =			$this->params->stylesheet;
		if ( $this->_params->stylesheet == -1 ) {
			$this->_params->stylesheet = '';
		}
		$this->_params->suffix =				$this->params->suffix;
		
		if ( $this->_params->use_menu ) {
			$this->_params->use_menu_stucture =		$this->params->use_menu_stucture;
			$this->_params->extra_item_css =		$this->params->extra_item_css;	
			$this->_params->extra_item_css_prefix =	$this->params->extra_item_css_prefix;
		} else {
			$this->_params->items = array();
			$this->_params->nrOfItems = 20;
			for( $i = 1; $i <= $this->_params->nrOfItems; $i++ ) {
				$item = '';
				$var = 'menu_id_'.$i;
				$item->menu_id = $this->params->$var;
				if( $item->menu_id < 0 || $item->menu_id == 99999999 ) {
					$item->menu_id = 0;
				}
				$var = 'show_unpublished_'.$i;
				$item->show_unpublished  = $this->params->$var;
				if ( $item->show_unpublished == -1 ) {
					$item->show_unpublished = $this->_params->show_unpublished;
				}
				$var = 'access_'.$i;
				$item->overrule_access = $this->params->$var;
				$var = 'show_non_access_'.$i;
				$item->show_non_access = $this->params->$var;
				if ( $item->show_non_access == -1 ) {
					$item->show_non_access = $this->_params->show_non_access;
				}
				$var = 'overrule_text_'.$i;
				$item->overrule_text = $this->params->$var;
				$var = 'hide_text_'.$i;
				$item->hide_text = $this->params->$var;
				if ( $item->hide_text == -1 ) {
					$item->hide_text = $this->_params->hide_text;
				}
				$var = 'overrule_link_'.$i;
				$item->overrule_link = $this->params->$var;
				$var = 'target_'.$i;
				$item->target = $this->params->$var;
				$var = 'active_by_default_'.$i;
				$item->active_by_default = $this->params->$var;
				$var = 'active_on_child_ids_'.$i;
				$item->active_on_child_ids = $this->params->$var;
				if ( $item->active_on_child_ids == -1 ) {
					$item->active_on_child_ids = $this->_params->active_on_child_ids;
				}
				$var = 'active_on_extra_ids_'.$i;
				$item->active_on_extra_ids = $this->params->$var;
				$var = 'stylesheet_'.$i;
				$item->stylesheet = $this->params->$var;
				$var = 'class_name_'.$i;
				$item->class_name = $this->params->$var;
				$this->_params->items[$i] = $item;
			}
		}
	}
	
	function getItems ()
	{
		global $Itemid, $cm_active_ids;
		
		$items = array();
		$db =& JFactory::getDBO();
		
		if ( $this->_params->use_menu ) {
			$query = 'SELECT *'
				. ' FROM #__menu'
				. ' WHERE menutype = "'.$this->_params->use_menu_stucture.'"'
				. ' AND parent = 0'
				. ' AND published != -2'
				. ' ORDER BY ordering';
			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			$i = 1;
			foreach( $rows as $row ) {
				if ( $row->type != 'separator' ) {
					// check whether item should be displayed
					// published & acceslevel
					if (
						( $row->published == 1 || $this->_params->show_unpublished ) &&
						( ( $row->access <= $this->_params->access ) || $this->_params->show_non_access )
					) {
						$curr_item = modCustoMenuHelper::getDefaultItem();
						
						$curr_item->text = $row->name;
							
						if ( $row->type == 'menulink' ) {
							$itemid = (int) str_replace( 'menu_item=', '', $row->params );
							$query = 'SELECT *'
								.' FROM #__menu'
								.' WHERE id = '.$itemid
								.' LIMIT 1';
							$db->setQuery( $query );
							$row = $db->loadObject();
						}
						
						$curr_item->link = $row->link;
	
						// Only attach Itemid if link is internal
						if ( modCustoMenuHelper::isInternal( $curr_item->link ) ) {
							$curr_item->link .= ( strpos( $curr_item->link, '?' ) === false ) ? '?' : '&';
							$curr_item->link .= 'Itemid='.$row->id;
							// Translates an internal Joomla URL to a humanly readible URL.
							$curr_item->link = JRoute::_( $curr_item->link, false );
						}
						
						// Check if menu item should be set to active
						$active_on_ids = array( $row->id );
						if ( $this->_params->active_on_child_ids ) {
							$child_ids = modCustoMenuHelper::getMenuItemChildIds( $row->id );
							$active_on_ids = array_merge( $active_on_ids, $child_ids );
						}
	
						if ( $Itemid && in_array( $Itemid, $active_on_ids ) ) {
							$cm_active_ids = $active_on_ids;
							$curr_item->active = 1;
							// Stylesheet
							if ( $this->_params->extra_item_css ) {
								JHTML::stylesheet( $this->_params->extra_item_css_prefix.$i.'.css', 'modules/mod_customenu/customenu/css_extra/' );
							}
						}
						
						// Target
						$curr_item->target = ( $row->browserNav ) ? 1 : 0;
						
						$i++;
						$items[$i] = $curr_item;
					}
				}
			}
		} else {
			for( $i = 1; $i <= $this->_params->nrOfItems; $i++ ) {
				$item = $this->_params->items[$i];
				if ( $item->menu_id || $item->overrule_text ) {
					$ok = 1;

					$access = $item->overrule_access;
					
					$curr_item = modCustoMenuHelper::getDefaultItem();
					
					$curr_item->link = $item->overrule_link;
					$curr_item->text = $item->overrule_text;
					
					// Target
					$curr_item->target = $item->target;

					// Get menu item data from database
					if ( $item->menu_id ) {
						$query = 'SELECT name, link, browserNav, published, access'
							.' FROM #__menu'
							.' WHERE id = '.$item->menu_id;
						$db->setQuery( $query );
						$row = $db->loadObject();

						if ( $row ) {
							// check whether item should be displayed
							// published
							if ( !$item->show_unpublished && !$row->published ) { $ok = 0; }
							// acces level
							if ( $access == -1 ) { $access = $row->access; }
							
							// Set the text
							if ( !$curr_item->text ) {
								$curr_item->text = $row->name;
							}
							// Set the link
							if ( !$curr_item->link ) {
								$curr_item->link = $row->link;
							}
							
							// Target
							if ( $curr_item->target == -1 ) {
								$curr_item->target = ( $row->browserNav ) ? 1 : 0;
							}
						}
					}
					// acces level
					if ( $access == -1 ) { $access = 0; }
					if ( !$item->show_non_access && ( $access > $this->_params->access ) ) { $ok = 0; }
					
					if ( $ok ) {
						// Only attach Itemid if link is internal
						if ( modCustoMenuHelper::isInternal( $curr_item->link ) ) {
							$curr_item->link .= ( strpos( $curr_item->link, '?' ) === false ) ? '?' : '&';
							$curr_item->link .= 'Itemid='.$item->menu_id;
							// Translates an internal Joomla URL to a humanly readible URL.
							$curr_item->link = JRoute::_( $curr_item->link, false );
						}

						// Check if menu item should be set to active
						$active_on_ids = array( $item->menu_id );
						$active_on_ids = array_merge( $active_on_ids, explode( ',', $item->active_on_extra_ids ));

						if ( $item->active_on_child_ids ) {
							$child_ids = modCustoMenuHelper::getMenuItemChildIds( $item->menu_id );
							$active_on_ids = array_merge( $active_on_ids, $child_ids );
						}

						if ( ( !$Itemid && $item->active_by_default ) || ( $Itemid && in_array( $Itemid, $active_on_ids ) ) ) {
							$cm_active_ids = $active_on_ids;
							$curr_item->active = 1;
							// Stylesheet
							if ( $item->stylesheet ) {
								JHTML::stylesheet( $item->stylesheet, 'modules/mod_customenu/customenu/css_extra/' );
							}
						}

						// Target
						if ( $curr_item->target == -1 ) {
							$curr_item->target = 0;
						}

						// Hide text
						$curr_item->hide_text = $item->hide_text;
						
						// Extra class name
						$curr_item->class = $item->class_name;
						
						$items[$i] = $curr_item;
					}
				}
			}
		}
		return $items;
	}
	
	function getDefaultItem()
	{
		$item = '';
		$item->text = '';
		$item->link = '';
		$item->title = '';
		$item->class = '';
		$item->active = 0;
		$item->target = 0;
		$item->hide_text = $this->_params->hide_text;
		
		return $item;
	}

	function getLayoutOutput( &$items )
	{
		$layout = '';
		
		$layout_path = dirname( __FILE__ ).DS.'layouts'.DS;
		
		$layout_file = @fopen( $layout_path.$this->_params->layout.'.ini', 'r' );
		if ( $layout_file ) {
			while ( !feof( $layout_file ) ) {
				$layout .= fread( $layout_file, 1024 );
			}		
		}
		if ( !$layout ) {
			$layout_file = @fopen( $layout_path.'default.ini', 'r' );
			if ( $layout_file ) {
				while ( !feof( $layout_file ) ) {
					$layout .= fread( $layout_file, 1024 );
				}
			}
		}
		if ( !$layout ) {
			return '<!-- CustoMenu: No layout file found: /modules/mod_customenu/customenu/layouts/'.$this->_params->layout.'.ini'.'--->';
		}
		
		$html = $layout;
		// remove comments
		$html = preg_replace( '#\s*/\*.*?\*/\s*#s', '', $html );
		// remove redundant whitespace (space between html tags and dynamic tags)
		$html = preg_replace( '#>\s+<#s', '><', $html );
		$html = preg_replace( '#>\s+{#s', '>{', $html );
		$html = preg_replace( '#}\s+<#s', '}<', $html );
		// remove leading / trailing whitespace
		$html = trim( $html );
		// match the menu items part
		preg_match( '#{items}(.*?){/items}#s', $html, $layout_item );
		
		$html_items = '';
		foreach ( $items as $item_nr => $item ) {			
			$html_item = $layout_item['1'];
			$html_item = str_replace( '{item_nr}', $item_nr, $html_item );
			
			$link = JFilterOutput::ampReplace( $item->link );
			$link_href = 'href="'.$link.'"';
			if ( $item->target ) {
				$target = '_blank';
				$link_href .= ' target="_blank"';
				$link_onclick = 'onclick="window.open(\''.$link.'\');"';
			} else {
				$target = '';
				$link_onclick = 'onclick="location.href=\''.$link.'\';"';
			}
			$html_item = str_replace( '{item_link}', $link, $html_item );
			$html_item = str_replace( '{item_link_href}', $link_href, $html_item );
			$html_item = str_replace( '{item_link_onclick}', $link_onclick, $html_item );
			
			$html_item = str_replace( '{item_target}', $target, $html_item );
			$html_item = str_replace( '{item_target_bool}', $item->target, $html_item );
			
			
			$text = $item->text;
			if ( $item->hide_text ) {
				$text = '<p style="text-indent: -9000px;">'.$text.'</p>';
			}
			$html_item = str_replace( '{item_text}', $text, $html_item );
			$html_item = str_replace( '{item_title}', JFilterOutput::cleanText( $item->text ), $html_item );
			
			$html_item = str_replace( '{item_class}', $item->class, $html_item );
			
			$html_item = str_replace( '{item_active}', ( $item->active ? 'active' : 'inactive' ), $html_item );
			$html_item = str_replace( '{item_active_bool}', $item->active, $html_item );
						
			$html_items .= $html_item;
		}
		$html = str_replace( $layout_item['0'], $html_items, $html );
		
		// replace the overal dynamic tags
		$suffix = $this->_params->suffix;
		$html = str_replace( '{suffix}', $suffix, $html );
		$html = str_replace( '{style}', $suffix, $html ); // for backward compatibility
		$hover = 'onmouseover="changeClassName(this,\'link_normal\',\'link_hover\');" onmouseout="changeClassName(this,\'link_hover\',\'link_normal\');"';
		$html = str_replace( '{hover}', $hover, $html );

		return $html;
	}

	function getMenuItemChildIds( $menu_id = 1 )
	{
		$db	=& JFactory::getDBO();

		$child_ids = array();
		$current_child_ids = array();
		$current_child_ids[] = $menu_id;

		while ( count( $current_child_ids ) ) {
			$query = 'SELECT id'
				.' FROM #__menu'
				.' WHERE parent IN ( '.implode( ",", $current_child_ids ).' )';
			$db->setQuery( $query );
			$rows = $db->loadObjectList();
			$current_child_ids = array();
			if( is_array( $rows ) ) {
				foreach ( $rows as $child ) {
					$current_child_ids[] = $child->id;
				}
			}
			$child_ids = array_merge( $child_ids, $current_child_ids );
		}

		return $child_ids;
	}
	
	function isInternal( $url )
	{
		// hostname: give preference to SERVER_NAME, because this includes subdomains
		$hostname = ( $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
		$is_internal = ( !(strpos( $url, $hostname ) === false ) || ( strpos( $url, '://' ) === false ) );
		return $is_internal;
	}

	function getParamValues( &$params )
	{
		$values = '';
		if ( isset( $params->_xml ) ) {
			foreach ( $params->_xml as $xml_group ) {
				foreach ( $xml_group->children() as $xml_child ) {
					$key = $xml_child->attributes('name');
					if ( !empty( $key ) && $key['0'] != '@' ) {
						$val = $params->get( $key );
						if ( !strlen( $val ) ) {
							$val = $xml_child->attributes('default');
							if ( $xml_child->attributes('type') == 'textarea' ) {
								$val = str_replace( '<br />', "\n", $val );
							}
						}
						$values->$key = $val;
					}
				}
			}
		}

		return $values;
	}
}