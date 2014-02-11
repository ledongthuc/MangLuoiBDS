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

require_once(JPATH_COMPONENT.DS.'views'.DS.'properties'.DS.'view.html.php');

jimport('joomla.application.component.controller');

class JeaControllerProperties extends JController
{
    
    /**
     * property category ( renting or selling )
     *
     * @var string $_cat
     */

    var $_cat='';
	

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
			
			JRequest::setVar('view', 'properties' );
		}
		
		parent::__construct( $default );

		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'add', 'edit' );
		$this->registerTask( 'add', 'test' );
		// $mainframe = &JFactory::getApplication();
		// $this->_cat = $mainframe->getUserStateFromRequest( 'com_jea.properties.cat', 'cat', '', 'word' );
		// $this->_model =& $this->getModel( 'Properties' );
//		$this->_model->setCategory( $this->_cat );
// echo "<script>alert('$this->_cat')</script>";
		
			@$this->_controllerUrl = 'index.php?option=com_jea&controller=properties&cat=' . $_SESSION['cat'] ;
	}
	
	function display()
	{
		$this->viewList();
	}
	
	function edit()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->editItem();
		/*
		if ( $this->_model->checkout() ){
			$this->_display('form');
		} else {
			$this->_setDefaultRedirect();
		}
		*/
	}
	
	
	function save()
	{
		//echo "save control";
    	//exit;
		//print_r($this->_controllerUrl);
	//	exit;		
		// Check for request forgeries
 		// JRequest::checkToken() or die( 'Invalid Token' );
			//$this->laydulieuBDS();
			U_reModelProperties::save();
			$this->_setDefaultRedirect();
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
	
	//function  laydulieuBDS()
	//{
		//echo "ldsbds";
		//exit;
		//$propertiesView = new JeaViewProperties();
		//$propertiesView->laydulieuBDS();
		//U_reModelProperties::laydulieuBDS();
//	}
	
	function cancel()
	{
		//echo "vao cancal";
		//exit;
		$this->_setDefaultRedirect();
	}
	
	/*
	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		if ( $this->_model->remove() ) {
			
			$msg = JText::sprintf('SUCCESSFULLY REMOVED ITEMS', count($this->_model->getCid()));
			$this->setRedirect( 'index.php?option=com_jea&controller=properties', $msg );
			
		} else {
			
			$this->_setDefaultRedirect();
		}
	}
	*/
	/*
    function copy()
	{
	    // Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		if ( $this->_model->copy() ) {
			
			$msg = JText::sprintf('SUCCESSFULLY COPY ITEMS', count($this->_model->getCid()));
			$this->setRedirect( $this->_controllerUrl  , $msg  );
			
		} else {
			
			$this->_setDefaultRedirect();
		}
	}
	*/
	function deleteimg()
	{		
		$id = JRequest::getVar('id',0);
		//$id = JRequest::getVar( 'cid', array(0), '', 'array' );
	    $propertiesView = new JeaViewProperties();
		$propertiesView->getDeleteImage( $id );
	  //  $this->setRedirect('index.php?option=com_jea&controller=properties&cat=selling');
	$this->setRedirect( $this->_controllerUrl . '&task=edit&id=' . $id );
	}
	/*
	function unpublish()
	{
		$this->_publish(false);
	}
	
	function publish()
	{
		$this->_publish(true);
	}
	*/
	/*
	function orderdown()
	{
		$this->_order(1);
	}
	
	function orderup()
	{
		$this->_order(-1);
	}
	
	function emphasize()
	{
		$this->_model->emphasize();
		$this->_setDefaultRedirect();
	}
	/*
	function newsest()
	{
		$this->_model->newsest();
		$this->_setDefaultRedirect();
	}
	*/
	/******************************  Private functions   *****************************************/
	/*

	function _order( $inc )
	{
	    $model = & $this->getModel('Properties');
		$model->order($inc);
		$this->_setDefaultRedirect();
	}
	*/
	function _setDefaultRedirect()
	{
		$this->setRedirect( $this->_controllerUrl );
	}
	/*
	function _publish($bool)
	{
		if ( $this->_model->publish($bool) ) {
			
			$state = $bool ? 'published' : 'unpublished' ;
			//TODO:traduire
			$msg = JText::sprintf('Properties(s) successfully '. $state , count($this->_model->getCid()));
			$this->setRedirect( $this->_controllerUrl , $msg );
			
		} else {
			
			$this->_setDefaultRedirect();
		}
	}
	*/
	/*
	function _display( $tpl=null )
	{
		//create the view
		$view = & $this->getView('properties', 'html');
		// Push the model into the view (as default)
		$view->setModel($this->_model, true);
		
		$featuresModel = & $this->getModel('Features');
		// Push the  features model into the view
		$view->setModel( $featuresModel );
		
		// Display the view
		$view->display($tpl);
	}
	*/
	
	function viewList()
	{
		//chuyen den view.html.php
		$propertiesView = new JeaViewProperties();
		$propertiesView->getlistproperties();
		
	}
	
	// xoa properties by id
	function remove()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getDeleteProperties();
		$this->_setDefaultRedirect();
	}
	
	function unpublish()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdatePropertiesList("hien_thi_ra_ngoai = '0'");
		$this->_setDefaultRedirect();
	}
	
	function publish()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdatePropertiesList("hien_thi_ra_ngoai = '1'");
		$this->_setDefaultRedirect();
		
	}
	
	function emphasis()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("noi_bat = '1'");
		$this->_setDefaultRedirect();
	}
	
	function unemphasis()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("noi_bat = '0'");
		$this->_setDefaultRedirect();
	}
	
	function newsest()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("moi_nhat = '1'");
		$this->_setDefaultRedirect();
	}
	
	function unnewsest()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("moi_nhat = '0'");
		$this->_setDefaultRedirect();
	}
	
	function unda_ban()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("da_ban = '0'");
		$this->_setDefaultRedirect();	
	}
	
	function da_ban()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("da_ban = '1'");
		$this->_setDefaultRedirect();	
	}
	function unspam()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("bao_cao_sai_pham = '0'");
		$this->_setDefaultRedirect();
	}
	function unspamlist()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdatePropertiesList("bao_cao_sai_pham = '0'");
		$this->_setDefaultRedirect();
	}
	function spam()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties("bao_cao_sai_pham = '1'");
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
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateProperties($inc);
		$this->_setDefaultRedirect();
		
	}

	function ordering()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->getUpdateOrdering();
		$this->_setDefaultRedirect();
		
	}
	
	function luot_xem()
	{
		$propertiesView = new JeaViewProperties();
		$propertiesView->updateLuotXem();
		$this->_setDefaultRedirect();
	}
	
}
