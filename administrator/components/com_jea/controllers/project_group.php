<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.txt
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT.DS.'views'.DS.'project_group'.DS.'view.html.php');
class JeaControllerProject_group extends JController
{
    
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		 //Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			
			JRequest::setVar('view', 'project_group' );
		}
		
		parent::__construct( $default );
		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'add', 'edit' );
		
		$this->_model =& $this->getModel( 'Project_group' );
	}
	
	function display()
	{
		$this->viewList();
	}
	
	function save()
	{
		
		
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		// Get/Create the model
		$model = & $this->getModel('Project_group');
		
		$url = 'index.php?option=com_jea&controller=project_group' ;
		
		if ( false ===  $model->save() ) {

		    $this->edit();
		    
		} else {

		  	if ( 'apply' == $this->getTask() )
		  	{
		  		
		  		$id = JRequest::getVar( 'id') ;
		  		$url = $url . '&task=edit&id=' . $id;
		  	}
		  	
		  	$msg = JText::_( 'Successfully saved Loai Du An' ) ; //TODO:traduire
		    $this->setRedirect( $url , $msg );
		}
	}

	function cancel()
	{
		$this->_setDefaultRedirect();
	}
	
	function _setDefaultRedirect()
	{
		$this->setRedirect( 'index.php?option=com_jea&controller=project_group' );
	}
	
	function viewList()
	{
		//chuyen den view.html.php
		$ProjectGroup = new JeaViewProject_group();
		$ProjectGroup->getListProjectGroup();
	}
	
	function edit()
	{
		//chuyen den view.html.php
		$ProjectGroup = new JeaViewProject_group();
		$ProjectGroup->editItem();
	}
	
	
	function remove()
	{
		$ProjectGroup = new JeaViewProject_group();
		$ProjectGroup->getDeleteProjectGroup();
		$this->_setDefaultRedirect();
		
	}
	
	function orderdown()
	{
		$this->_order("ordering=ordering + 1");
	}
	
	function orderup()
	{
		$this->_order("ordering=ordering - 1");
	}
	
	function _order( $inc )
	{
		$ProjectGroup = new JeaViewProject_group();
		$ProjectGroup->getUpdateProjectgroup($inc);
		$this->_setDefaultRedirect();
	}

	function ordering()
	{
		$ProjectGroup = new JeaViewProject_group();
		$ProjectGroup->getUpdateOrdering();
		$this->_setDefaultRedirect();
	}
	
	
	
}
