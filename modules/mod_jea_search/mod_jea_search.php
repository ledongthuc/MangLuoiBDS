<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version		1.2 2008-07
 * @package		Jea.module.search
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */
 defined('_JEXEC') or die('Restricted access');
 
if ( !empty( $_SESSION['tmp'] ) )
{
	unset( $_SESSION['tmp'] );
}
 
require_once (dirname(__FILE__).DS.'helper.php');

$searchFor=$params->get( 'searchFor' );

if($params->get('JeaSearchType')=='Search')
{
	
	if(isset($searchFor) &&  $searchFor == "SearchById")
	{
		require(JModuleHelper::getLayoutPath('mod_jea_search','SearchById'));
		return;
	}
	else 
	{
	    require(JModuleHelper::getLayoutPath('mod_jea_search','search_mlbds'));
		//require(JModuleHelper::getLayoutPath('mod_jea_search','vertical'));
		return;
	}
	//require(JModuleHelper::getLayoutPath('mod_jea_search'));
}
else
{
	require(JModuleHelper::getLayoutPath('mod_jea_search','filter'));

}
		

