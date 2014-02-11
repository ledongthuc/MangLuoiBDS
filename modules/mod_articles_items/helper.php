<?php
/**
*
* @copyright	Inspiration Web Design
* License GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class mod_articles_items
{
	function getList(&$params)
	{
		global $mainframe;

		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');
		$special_id =  trim( $params->get('special_id') );	
		$special_textcount =  (int) $params->get('special_textcount', 50);	//them code
		$special_articleid	= trim( $params->get('special_articleid') );	
		$count		= (int) $params->get('count', 5);
		$catid		= trim( $params->get('catid') );
		$secid		= trim( $params->get('secid') );
		$articleid	= trim( $params->get('articleid') );		
		$show_front	= $params->get('show_front', 1);
		$show_images= $params->get('show_images', 1);
		
		$aid		= $user->get('aid', 0);
		$textcount	= (int) $params->get('textcount', 50);
		$maxsize	= (int) $params->get('maximagesize', 100);						

		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');

		$nullDate	= $db->getNullDate();

		$date =& JFactory::getDate();
		$now = $date->toMySQL();

		$where		= 'a.state = 1'
			. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
			. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
			;

		// User Filter
		switch ($params->get( 'user_id' ))
		{
			case 'by_me':
				$where .= ' AND (created_by = ' . (int) $userId . ' OR modified_by = ' . (int) $userId . ')';
				break;
			case 'not_me':
				$where .= ' AND (created_by <> ' . (int) $userId . ' AND modified_by <> ' . (int) $userId . ')';
				break;
		}

		// Ordering
		switch ($params->get( 'ordering' ))
		{
		    case 'h_dsc': $ordering = 'a.hits DESC';
			              break; 
			case 'h_asc': $ordering = 'a.hits ASC';
			              break;
            case 'o_asc': $ordering = 'a.ordering ASC';
			              break;						  
			case 'm_dsc': $ordering = 'a.modified DESC, a.created DESC';
				          break;
			case 'c_dsc':
			default:  $ordering = 'a.created DESC';
				      break;
		}

		if ($catid)
		{
			$ids = explode( ',', $catid );
			JArrayHelper::toInteger( $ids );
			$catCondition = ' AND (cc.id=' . implode( ' OR cc.id=', $ids ) . ')';
		}
		if ($secid)
		{
			$ids = explode( ',', $secid );
			JArrayHelper::toInteger( $ids );
			$secCondition = ' AND (s.id=' . implode( ' OR s.id=', $ids ) . ')';
		}
		

		if ($articleid)
		{
			$ids = explode( ',', $articleid );
			JArrayHelper::toInteger( $ids );
			$artCondition = ' AND (a.id=' . implode( ' OR a.id=', $ids ) . ')';
		}

		// Content Items only
	/*	$query = 'SELECT a.*, ' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a' .
			($show_front == '0' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '') .
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE '. $where .' AND s.id > 0' .
			($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
			($catid ? $catCondition : '').
			($secid ? $secCondition : '').
			($articleid ? $artCondition : '').	
			($show_front == '0' ? ' AND f.content_id IS NULL ' : '').
			' AND s.published = 1' .
			' AND cc.published = 1' .
			' ORDER BY '. $ordering; */
			
			$query='SELECT a.*,'.
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a'.
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE a.state=1'.
			($catid ? $catCondition : '').
			($secid ? $secCondition : '').
			($articleid ? $artCondition : '').	
			' AND s.published = 1' .
			' AND cc.published = 1' .
			($articleid ? '' : ' ORDER BY '. $ordering);

		//echo $query;
		if ($params->get( 'ordering' ) == 'random')
		{
		  $db->setQuery($query, 0, 0);
		  $temprows = $db->loadObjectList();
		  shuffle( $temprows );		  
		  $rows = array_slice( $temprows, 0, $count );		
		}
		else
		{
	     	$db->setQuery($query, 0, $count);
		    $rows = $db->loadObjectList();		
		}
		return $rows;
	}
	//them
	
	function getList_spec(&$params)
	{
		$db			=& JFactory::getDBO();
		$special_items_count = (int) $params->get('special_items_count', 5);	
		$special_textcount =  (int) $params->get('special_textcount', 50);	//them code
		$special_articleid	= trim( $params->get('special_articleid') );	
		if ($special_articleid)
		{
			$ids = explode( ',', $special_articleid );
			JArrayHelper::toInteger( $ids );
			$artCondition_spec = ' AND (a.id=' . implode( ' OR a.id=', $ids ) . ')';
		}			
			$query_spec='SELECT a.*,'.
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a'.
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE a.state=1'.
			($special_articleid ? $artCondition_spec : '').	
			' AND s.published = 1' .
			' AND cc.published = 1' ;

		//echo $query;
	     	$db->setQuery($query_spec);
		    $rows_spec = $db->loadObjectList();		
			return $rows_spec;
	}
}
