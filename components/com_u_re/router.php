<?php
/**
* @version		$Id: router.php 10711 2008-08-21 10:09:03Z eddieajau $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

function U_reBuildRoute(&$query)
{
	$segments = array();
	
	if ( isset( $query['view'] ) && $query['view'] == 'manage' )
	{
		return $segments;
	}
	
	// project, property
	if ( !isset( $query['controller'] ) )
	{
		$segments[] = 'nhadat';
		unset( $query['controller'] );
	}
	else if ( $query['controller'] == 'projects')
	{
		$segments[] = 'duan';
		unset( $query['controller'] );
	}
	
	if ( isset( $query['task'] ) )
	{
		$segments[] = $query['task'];
		unset( $query['task'] );
	}
	
	if ( isset( $query['view'] ) )
	{
		$segments[] = $query['view'];
		unset( $query['view'] );
	}
	
	if ( isset( $query['layout'] ) )
	{
		$segments[] = $query['layout'];
		unset( $query['layout'] );
	}
	
	if ( isset( $query['Itemid'] ) )
	{
		$segments[] = $query['Itemid'];
		unset( $query['Itemid'] );
	}
	
	if ( isset( $query['id'] ) )
	{
		$segments[] = $query['id'];
		unset( $query['id'] );
	}
	
	if ( isset( $query['lang'] ) )
	{
		unset( $query['lang'] );
	}
	return $segments;
}

function U_reParseRoute($segments)
{
	for ( $i = 0; $i < count( $segments ); $i++ )
	{
		$segments[$i] = str_replace( ':', '-', $segments[$i] );
	}
	
	$vars = array();
	
	$count = count($segments);
	
	if ( $segments[0] == 'duan' )
	{
		$vars['controller'] = 'projects';
		//$vars['option'] = 'com_u_re';
	}
	else if ( $segments[0] == 'nhadat' )
	{
		$vars['controller'] = 'properties';
	}	
	else if ( $segments[0] =='save' )
	{
		//$vars['option'] = 'com_u_re';
		$vars['controller'] = 'properties';
		$vars['task'] = 'save';
	}
	
	if ( $segments[1] != 'manage' )
	{
		if ( $vars['controller'] == 'projects' && count( $segments ) == 2 )
		{
			$vars['Itemid'] = $segments[$count - 1];
			$vars['task'] = 'searchProject';
			$vars['id'] = '';
		}
		else if ( $vars['controller'] == 'projects' )
		{
			$vars['Itemid'] = $segments[$count - 1];
			$vars['task'] = 'viewDetail';
			$vars['id'] = $segments[$count - 1];
			$vars['Itemid'] = $segments[$count - 2];
		}
		else if ( $vars['controller'] == 'properties' ) 			
		{
			if ( $segments[$count-2] == 'search' )
			{
				$vars['task'] = 'search';
				$vars['Itemid'] = $segments[$count-1];
				$vars['sefIndex'] = $segments[$count-4];
				$vars['sefValue'] = $segments[$count-3];
				
				$searchArray = array();
				
				for ( $i = 1; $i < $count - 4; $i++ )
				{
					$searchArray[] = $segments[$i];	
				}
				$vars['searchArray'] = $searchArray;
			}
			else 
			{
				$vars['task'] = $segments[2];
				$vars['id'] = $segments[$count - 1];
				$vars['Itemid'] = $segments[$count - 2];
			}
		}
		else 
		{
			$vars['id'] = $segments[$count - 1];
			$vars['Itemid'] = $segments[$count - 2];
		}
	}
	else 
	{
		$vars['view'] = $segments[1];
		$vars['layout'] = $segments[2];	
		$vars['Itemid'] = $segments[$count - 1];
	}
	return $vars;
}
