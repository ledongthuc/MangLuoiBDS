<?php
/**
* @version		$Id: view.html.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @subpackage	Users
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Users component
 *
 * @static
 * @package		Joomla
 * @subpackage	Users
 * @since 1.0
 */
class UsersViewUsers extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db				=& JFactory::getDBO();
		$currentUser	=& JFactory::getUser();
		$acl			=& JFactory::getACL();
		//TODO lay gia user id chinh
		/*
		$app =& JFactory::getApplication();
		$hideUserId = $app->getCfg('Master_U');
		*/
		$hideUserId =  164;

		$filter_order		= $mainframe->getUserStateFromRequest( "$option.filter_order",		'filter_order',		'a.name',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( "$option.filter_order_Dir",	'filter_order_Dir',	'',			'word' );
		$filter_type		= $mainframe->getUserStateFromRequest( "$option.filter_type",		'filter_type', 		0,			'string' );

		$filter_speak		= $mainframe->getUserStateFromRequest( "$option.filter_speak",		'filter_speak', 	2,			'int' );
		$filter_boss		= $mainframe->getUserStateFromRequest( "$option.filter_boss",		'filter_boss', 		2,			'int' );
		$filter_report		= $mainframe->getUserStateFromRequest( "$option.filter_report",		'filter_report', 	2,			'int' );
		$filter_logged		= $mainframe->getUserStateFromRequest( "$option.filter_logged",		'filter_logged', 	0,			'int' );
		$search				= $mainframe->getUserStateFromRequest( "$option.search",			'search', 			'',			'string' );
		$search				= JString::strtolower( $search );

		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

		$where = array();
		if (isset( $search ) && $search!= '')
		{
			$searchEscaped = $db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$where[] = 'a.username LIKE '.$searchEscaped.' OR a.email LIKE '.$searchEscaped.' OR a.name LIKE '.$searchEscaped;
		}
		
		// LỌC TYPE
		if ( $filter_type )
		{
			if ( $filter_type == 'Public Frontend' )
			{
				$where[] = ' a.usertype = \'Registered\' OR a.usertype = \'Author\' OR a.usertype = \'Editor\' OR a.usertype = \'Publisher\' ';
			}
			else if ( $filter_type == 'Public Backend' )
			{
				$where[] = 'a.usertype = \'Manager\' OR a.usertype = \'Administrator\' OR a.usertype = \'Super Administrator\' ';
			}
			else
			{
				$where[] = 'a.usertype = LOWER( '.$db->Quote($filter_type).' ) ';
			}
		}
		//  LỌC LOGGED
		if ( $filter_logged == 1 )
		{
			$where[] = 's.userid = a.i=';
		}
		else if ($filter_logged == 2)
		{
			$where[] = 's.userid IS NULL';
		}
		
		if ( $filter_speak !='2') $where[] = 'a.speak_english='.$filter_speak;
		if ( $filter_boss !='2') $where[] = 'a.chinh_chu='.$filter_boss;
		if ( $filter_report !='2') $where[] = 'a.nhan_mail='.$filter_report;

		// exclude any child group id's for this user
		$pgids = $acl->get_group_children( $currentUser->get('gid'), 'ARO', 'RECURSE' );

		if (is_array( $pgids ) && count( $pgids ) > 0)
		{
			JArrayHelper::toInteger($pgids);
			$where[] = 'a.gid NOT IN (' . implode( ',', $pgids ) . ')';
		}
		$filter = '';
		if ($filter_logged == 1 || $filter_logged == 2)
		{
			$filter = ' INNER JOIN #__session AS s ON s.userid = a.id';
		}

		$orderby = ' ORDER BY '. $filter_order .' '. $filter_order_Dir;
		$where = ( count( $where ) ? ' WHERE (' . implode( ') AND (', $where ) . ')' : '' );

		$query = 'SELECT COUNT(a.id)'
		. ' FROM #__users AS a'
		. $filter
		. $where
		;
		$db->setQuery( $query );
		$total = $db->loadResult();

		$where2 = ' AND a.id <> '.$hideUserId;		
		
		jimport('joomla.html.pagination');
		$pagination = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT a.*, g.name AS groupname'
			. ' FROM #__users AS a'
			. ' INNER JOIN #__core_acl_aro AS aro ON aro.value = a.id'
			. ' INNER JOIN #__core_acl_groups_aro_map AS gm ON gm.aro_id = aro.id'
			. ' INNER JOIN #__core_acl_aro_groups AS g ON g.id = gm.group_id'
			. $filter
			. $where
			. $where2
			. ' GROUP BY a.id'
			. $orderby
		;
		$db->setQuery( $query, $pagination->limitstart, $pagination->limit );
		$rows = $db->loadObjectList();

		$n = count( $rows );
		$template = 'SELECT COUNT(s.userid)'
			. ' FROM #__session AS s'
			. ' WHERE s.userid = %d'
		;
		for ($i = 0; $i < $n; $i++)
		{
			$row = &$rows[$i];
			$query = sprintf( $template, intval( $row->id ) );
			$db->setQuery( $query );
			$row->loggedin = $db->loadResult();
		}

		// USES FILTTER
		$query = 'SELECT name AS value, name AS text'
			. ' FROM #__core_acl_aro_groups'
			. ' WHERE name != "ROOT"'
			. ' AND name != "USERS"'
		;
		$db->setQuery( $query );
		
		$types[] 		= JHTML::_('select.option',  '0', '- '. JText::_( 'Select Group' ) .' -' );
		foreach( $db->loadObjectList() as $obj )
		{
			$types[] = JHTML::_('select.option',  $obj->value, JText::_( $obj->text ) );
		}
		$lists['type'] 	= JHTML::_('select.genericlist',   $types, 'filter_type', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_type" );

		
		
		// CSNTL - Speak English
		
		$speak[] = JHTML::_('select.option',  2, '- '. JText::_( 'Speak English' ) .' -');
		$speak[] = JHTML::_('select.option',  0, JText::_( 'Không english' ) );
		$speak[] = JHTML::_('select.option',  1, JText::_( 'Có english' ) );
		$lists['speak'] = JHTML::_('select.genericlist',$speak, 'filter_speak', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_speak" );
		
		// Chính chủ
		$boss[] = JHTML::_('select.option',  2, '- '. JText::_( 'Chính chủ' ) .' -');
		$boss[] = JHTML::_('select.option',  0, JText::_( 'Không chính chủ' ) );
		$boss[] = JHTML::_('select.option',  1, JText::_( 'Có chính chủ' ) );
		$lists['boss'] = JHTML::_('select.genericlist',$boss, 'filter_boss', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_boss" );
		
		// Đăng ký nhận báo cáo
		$report[] = JHTML::_('select.option',  2, '- '. JText::_( 'Đăng ký nhận thông báo' ) .' -');
		$report[] = JHTML::_('select.option',  0, JText::_( 'Không nhận thông báo' ) );
		$report[] = JHTML::_('select.option',  1, JText::_( 'Có nhận thông báo' ) );
		$lists['report'] = JHTML::_('select.genericlist',$report, 'filter_report', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_report" );
		
		
		
		$logged[] = JHTML::_('select.option',  0, '- '. JText::_( 'Select Log Status' ) .' -');
		$logged[] = JHTML::_('select.option',  1, JText::_( 'Logged In' ) );
		$lists['logged'] = JHTML::_('select.genericlist',   $logged, 'filter_logged', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_logged" );

		// table ordering
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;

		// search filter
		$lists['search']= $search;
		
		
		
		
		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$rows);
		$this->assignRef('pagination',	$pagination);

		parent::display($tpl);
	}
}