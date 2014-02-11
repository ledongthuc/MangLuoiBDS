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

 require_once(JPATH_COMPONENT.DS.'views'.DS.'projects'.DS.'view.html.php');
jimport('joomla.application.component.controller');
class JeaControllerProjects extends JController
{
   	/**
	 * Base controller url
	 *
	 * @var string
	 */
	var $_controllerUrl = '';
	
	/**
	 * Default controller model
	 *
	 * @var object
	 */
	var $_model = NULL;

	/**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			
			JRequest::setVar('view', 'projects' );
		}
		parent::__construct( $default );
		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'add', 'edit' );
		$this->registerTask( 'remove', 'remove' );
//		$this->registerTask( 'edit', 'test' );
		
		$mainframe = &JFactory::getApplication();
		$this->_model =& $this->getModel( 'Projects' );
		$this->_controllerUrl = 'index.php?option=com_jea&controller=projects';
	}
	
	
	function display()
	{
		$this->viewList();
	}
	
	
	function edit()
	{
//		echo "edit";
//		exit;
		//chuyen den view.html.php
//		$id3 =JRequest::getInt( 'id', '', 'POST' );
//		print_r('3333'.$id3);
		$projectView = new JeaViewProjects();
		$projectView->editItem();
	}
	
	
	function save()
	{
		
		// echo "<script>alert('ddd')</script>";
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		if ( false ===  $this->_model->save() )
		{
		    $this->edit();
		    
		} else {
			
//			$row =& $this->_model->getRow();
			
		  	if ( 'apply' == $this->getTask() )
		  	{
//		  		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		  		 $id =  JRequest::getInt( 'id', '', 'POST' );
		  	//	print_r('id');
		  		$this->_controllerUrl .= '&task=edit&id=' .$id ;
		  	}
		  	
		  	$msg = JText::sprintf( 'Successfully saved project', $row->ref ) ;
		    $this->setRedirect( $this->_controllerUrl  , $msg );
		}
	}
	
	
	function cancel()
	{
		$this->_setDefaultRedirect();
	}
	
	function _setDefaultRedirect()
	{
		$this->setRedirect( $this->_controllerUrl );
	}
	
	function viewList()
	{		
		//chuyen den view.html.php
		$projectView = new JeaViewProjects();
		$projectView->getlistproject();
	}
	
	function emphasis()
	{
		//chuyen den view.html.php
		$projectView = new JeaViewProjects();
		$projectView->getUpdateProject("noi_bat= '1'");
		$this->_setDefaultRedirect();
	}
	
	function unemphasis()
	{
		//chuyen den view.html.php
		$projectView = new JeaViewProjects();
		$projectView->getUpdateProject("noi_bat= '0'");
		$this->_setDefaultRedirect();
	}
	
	
	function unpublish()
	{
		$projectView = new JeaViewProjects();
		$projectView->getUpdateProject("hien_thi_ra_ngoai = '0'");
		$this->_setDefaultRedirect();
	}
	
	function publish()
	{
		//chuyen den  update publish o view.html.php
		$projectView = new JeaViewProjects();
		$projectView->getUpdateProject("hien_thi_ra_ngoai = '1'");
		$this->_setDefaultRedirect();
		
	}
	
	
	// xoa project by id
	function remove()
	{
		$projectView = new JeaViewProjects();
		$projectView->getDeleteProject();
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
		$projectView = new JeaViewProjects();
		$projectView->getUpdateProject($inc);
		$this->_setDefaultRedirect();
	}

	function ordering()
	{
		$projectView = new JeaViewProjects();
		$projectView->getUpdateOrdering();
		$this->_setDefaultRedirect();
	}
	
	function deleteimg()
	{
		$id = JRequest::getVar('id',0);
		$projectView = new JeaViewProjects();
		$projectView->getDeleteImage( $id );
	    
		$this->setRedirect( $this->_controllerUrl . '&task=edit&id=' . $id );
	}
	
	
}
