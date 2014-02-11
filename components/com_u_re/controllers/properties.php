<?php
/**
 * Controller of COM_U_RE. Unison Real Estate Component
 * 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

// include property view
require_once( COM_U_RE_VIEW_PROPERTY );

class U_ReControllerProperties extends JController
{
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view if none exists
		if ( !JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'properties' );
		}
		
		$task = JRequest::getVar( 'task' );
		$searchType = JRequest::getVar( 'searchType', '' );
		
		$id = JRequest::getInt('id', 0);
		
		parent::__construct( $default );
	}
	
	/*
	* Description: View properties detail 
	* Author: Minh Chau
	* Version: 1.0
	* Date create: 04-03-2011
	*/
	function viewDetail()
	{		
		$id = $_GET['id'];
		$propertiesView = new U_ReViewProperties();
		$propertiesView->displayPropertyDetail($id);
	}
	
	function save()
	{
		
			//	echo "save555";
			//exit();
			U_reModelProperties::save();
			// tam thoi tro ve trang chu
			//$this->setRedirect( 'index.php' );
			$this->setRedirect( 'index.php?option=com_u_re&view=manage&Itemid=8' );
		//	$this->_setDefaultRedirect();
		/*
		if ( false ===  $this->_model->save() )
		{
		    $this->edit();
		}
		else
		{
			/*
			$row =& $this->_model->getRow();
			
		  	if ( 'apply' == $this->getTask() )
		  	{
		  		$this->_controllerUrl .= '&task=edit&id=' . $row->id ;
		  	}
		  
		  	$msg = JText::sprintf( 'Successfully saved property', $row->ref ) ;
		    $this->setRedirect( $this->_controllerUrl  , $msg );
		}
		*/
	}
	function saveYeuCauBDS(){
		U_reModelProperties::saveYeuCauBDS();
		//$this->setRedirect( 'index.php' );
	}
	function untickEmail(){
		U_reModelProperties::untickYeuCauBDS();
	}
	/*
	* Description: Process search 
	* Author: Minh Chau
	* Version: 
	* Date create: 18-03-2011
	*/
	function search()
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
		
		if( !empty( $_GET['price_min'] ) )
		{
			$params['price_min'] = JRequest::getVar( 'price_min', '', 'GET' );  
		}
		
		if( !empty( $_GET['price_max'] ) )
		{
			$params['price_max'] = JRequest::getVar( 'price_max', '', 'GET' );  
		}

		if( !empty( $_GET['direction'] ) )
		{
			$params['direction'] = JRequest::getVar( 'direction', '', 'GET' );  
		}
		
		if( !empty( $_GET['project_id'] ) )
		{
			$params['project_id'] = JRequest::getVar( 'project_id', '', 'GET' );  
		}
		
		if( !empty( $_GET['project_type_id'] ) )
		{
			$params['project_type_id'] = JRequest::getVar( 'project_type_id', '', 'GET' );  
		}

		if( !empty( $_GET['kind_id'] ) )
		{
			$params['kind_id'] = JRequest::getVar( 'kind_id', '', '"post"' );  
		}
		
		// set search param to session for filter
//		$session = JFactory::getSession();
//		$session->set( 'u_reSearch', $params );
		
		$_SESSION['u_reSearch'] = $params;
		
		if ( !empty( $_GET['page'] ) )
		{
			$_SESSION['page'] = $_GET['page'];
		}
		else 
		{
			$_SESSION['page'] = 1;	
		}
		
		// get view
			
		$catDirect = JFactory::getURI()->getVar('catDirect');			
		$propertiesView = new U_ReViewProperties();
		
		if ( $catDirect )
		{
			$propertiesView->getPropertyCatDirect( $catDirect );
		}		
		else 
		{		
			$propertiesView->getPropertyList();
		}
	}
	
	function searchByCode(){
		if( !empty( $_GET['mataisan'] ) )
		{
			$ma_so=$_GET['mataisan'];
			$propertiesView = new U_ReViewProperties();
			$propertiesView->displayPropertiesByCode($ma_so);
		}
	}
	function deleteimg()
	{
		$id = JRequest::getVar('id',0);
		//$id = JRequest::getVar( 'cid', array(0), '', 'array' );
	    $propertiesView = new U_ReViewProperties();
		$propertiesView->getDeleteImage( $id );		
		$this->setRedirect( 'index.php?option=com_u_re&view=manage&Itemid=8&layout=form&id='. $id );

	}
	
	function compare()
	{
		$id = JRequest::getVar('id',0);
		//$id = JRequest::getVar( 'cid', array(0), '', 'array' );
	    $propertiesView = new U_ReViewProperties();
		$propertiesView->getDeleteImage( $id );		
	}
}
