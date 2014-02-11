<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package     Jea.site
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class JeaControllerProjects extends JController
{
    
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			
			JRequest::setVar('view', 'projects' );
		}		
		//clear search session if there is not a search
		if( ( JRequest::getVar( 'task' ) != 'search' ) &&  ( isset( $_SESSION['jea_search'] ) ) ) {
			unset( $_SESSION['jea_search'] );
		}		
		//$this->addModelPath( JPATH_COMPONENT_ADMINISTRATOR.DS.'models' );				
		$id = JRequest::getInt('id', 0);
		parent::__construct( $default );
	}
		function search()
	{	
		$session =& JFactory::getSession();
		
		if ( JRequest::checkToken() ) {
			$params = array(
				'key_search'           => JRequest::getVar('key_search', ''),		
				'Itemid'           => JRequest::getInt('Itemid', 0),
				'cat'              => JRequest::getVar('cat', ''),
				'type_id'          => JRequest::getInt('type_id', 0),
				'town_id'          => JRequest::getInt('town_id', 0),
				'project_groupd_id'       => JRequest::getInt('project_groupd_id', 0)
			);
			$session->set('params', $params, 'jea_search');
		} else {
		    $app = &JFactory::getApplication();
               $router = &$app->getRouter();
               // force the default to layout on search result
               $router->setVar( 'layout', 'default');
		}
		
		$params = $session->get('params', array() , 'jea_search');
		
		// Bug correction on search pagination
		if ($limit =JRequest::getInt('limit', 0)){
		    
		    $params['limit'] = $limit;
		    $session->set('params', $params, 'jea_search');
		}
		
		JRequest::set( $params , 'POST');
		$this->display();

	}
	
}
