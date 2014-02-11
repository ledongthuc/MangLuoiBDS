<?php
/**
 * Controller projects of COM_U_RE. Unison Real Estate Component
 *
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

// include property view
require_once( COM_U_RE_VIEW_PROJECT );

class U_ReControllerProjects extends JController
{
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view if none exists
		if ( !JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'projects' );
		}
		
		$task = JRequest::getVar( 'task' );
		$searchType = JRequest::getVar( 'searchType', '' );
		
		$id = JRequest::getInt('id', 0);
		
		parent::__construct( $default );
		
		/*if ( $id )
		{
			// view property detail
			$this->viewDetail($id );
		}
		else
		{
			if ( $task == 'search' && $searchType != 'filter')
			{
				// remove session of before search
				unset( $_SESSION['projectSearch'] );
			}
			$this->searchProject();
		}*/
	}
	
	/*
	* Description: View properties detail
	* Author: Minh Chau
	* Version: 1.0
	* Date create: 04-03-2011
	*/
	function viewDetail()
	{
		$id = JRequest::getInt('id', 0);
		$projectsView = new U_ReViewProjects();
		$projectsView->displayProjectDetail( $id );
	}
	
	/*
	* Description: Process search
	* Author: Minh Chau
	* Version:
	* Date create: 18-03-2011
	*/
	function searchProject()
	{
		// get param search from GET
		$params = array();
		
		if( !empty( $_GET['title'] ) )
		{
			$params['title'] = JRequest::getVar( 'title', '', 'GET' );
		}
		
		if( !empty( $_GET['type_id'] ) )
		{
			$params['type_id'] = JRequest::getVar( 'type_id', '', 'GET' );
		}
		
		if( !empty( $_GET['town_id'] ) )
		{
			$params['town_id'] = JRequest::getVar( 'town_id', '', 'GET' );
		}
		
		$_SESSION['projectSearch'] = $params;
		
		if ( !empty( $_GET['page'] ) )
		{
			$_SESSION['page'] = $_GET['page'];
		}
		else
		{
			$_SESSION['page'] = 1;
		}
		
		// get view
		$projectView = new U_ReViewProjects();
		$projectView->getList();
	}
	

}
