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
 *  Developed by Unison 11-2010 for iLand v3.0
 *
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT.DS.'views'.DS.'realtors'.DS.'view.html.php');
class JeaControllerRealtors extends JController
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
			
			JRequest::setVar('view', 'realtors' );
		}
		
		parent::__construct( $default );

		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'add', 'edit' );
		
		$mainframe = &JFactory::getApplication();
		$this->_model =& $this->getModel( 'Realtors' );
		$this->_controllerUrl = 'index.php?option=com_jea&controller=realtors';
	}
	
	function edit()
	{
		$realtorView = new JeaViewRealtors();
		$realtorView->editItem();	
	}
	
	
	function save()
	{
		  		 JeaModelRealtors::save();
			
			$id =  JRequest::getInt( 'id', '', 'POST' );
		  	if ( 'apply' == $this->getTask() )
		  	{
		  		$this->_controllerUrl .= '&task=edit&id=' . $id ;
		  	}
		  	else 
		  	{
			     $this->_setDefaultRedirect();
		  	}
		  	$msg = JText::sprintf( 'Successfully saved realtor', $row['ten'] ) ;
		    $this->setRedirect( $this->_controllerUrl  , $msg );
	}
	
	
	function cancel()
	{
		$this->_setDefaultRedirect();
	}
	
	// xoa properties by id
	function remove()
	{
		$realtorView = new JeaViewRealtors();
		$realtorView->getDeleteRealtor();	
		$this->_setDefaultRedirect();
	}
	function unpublish()
	{
		$realtorView = new JeaViewRealtors();
		$realtorView->getUpdateRealtor("hien_thi_ra_ngoai = '0'");
		$this->_setDefaultRedirect();
	}
	
	function publish()
	{
		$realtorView = new JeaViewRealtors();
		$realtorView->getUpdateRealtor("hien_thi_ra_ngoai = '1'");
		$this->_setDefaultRedirect();		
	}

	function deleteimg()
	{
		$id = JRequest::getVar('id',0);
		
		$realtorView = new JeaViewRealtors();
		$realtorView->getDeleteImage( $id );
	    
		$this->setRedirect( $this->_controllerUrl . '&task=edit&id=' . $id );
	}
	
	function _setDefaultRedirect()
	{
		$this->setRedirect( $this->_controllerUrl );
	}
}
