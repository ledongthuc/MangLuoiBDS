<?php
//echo "3333";
//exit;
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');

class JeaViewRealtors extends JView
{
	var $pagination = null ;
	var $user = null;

	function display( $tpl = null )
	{
		$this->user = & JFactory::getUser();
		
		switch ($tpl)
		{
			case 'form':
				$this->editItem();
				break;
			default :
				$this->listIems();

		}
		$params =& ComJea::getParams();
		$this->assignRef('params' , $params );

	//	parent::display($tpl);
	}

	function listIems()
	{
		jimport( 'joomla.html.pagination' );
		JHTML::_('behavior.tooltip');
		
		global $u_reGlobalConfig;
		
		// get return field
		$returnField = $u_reGlobalConfig['REALTOR']['realtor_list_return_field'];
		//get limit
		$limit = $u_reGlobalConfig['REALTOR']['list_limit'];

		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
		
//		print_r($returnField ."<br/>");
//		print_r($limit ."<br/>");
//		print_r($limitstart ."<br/>");
//		print_r($page ."<br/>");
//		exit;
		$ModelRealtors = new JeaModelRealtors();
    	$Danhsachnhamoigioi= $ModelRealtors->layDanhSachNhaMoiGioi( $returnField, $page, $limit);
		//print_r($Danhsachnhamoigioi['rows'][3]);
	//	exit;
//		$model = $this->getModel();
//		$items = $this->get('items');
		$this->assign('rows', $Danhsachnhamoigioi['rows'][3]);
		
		  $this->assignRef( 'tongDong', $Danhsachnhamoigioi['rows'][0] );										   
		  $this->assignRef( 'paging', ilandCommonUtils::getPage($Danhsachnhamoigioi['rows'][0], $limit) );
		$this->pagination = new JPagination( $this->tongDong , $limitstart, $limit );
		
		$this->assignRef( 'hien_thi', $Danhsachnhamoigioi['published'] );
		// print_r($this->hien_thi);
	//	exit;

	    JToolBarHelper::title( JText::_( ucfirst( $this->get('category') ) . ' management' ), 'jea.png' );
	    JToolBarHelper::publish();
	    JToolBarHelper::unpublish();
	    JToolBarHelper::addNew();
	    JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
	    
	    
	   	$templatePath = "../templates/WebGH/html/com_u_re/realtors/";
		$this->addTemplatePath($templatePath);
		$this->setLayout('list');
	    parent::display();
		
	}

	function editItem()
	{		
		
		JRequest::setVar( 'hidemainmenu', 1 );
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $idurl =JFactory::getURI()->getVar("id"))
		{
			$id = $idurl;
		}
		else
		{
			$id = $cid[0];
		}
		
		// print_r( $id );
		//$item =& $this->get('item');		
		//$this->assign( $item );
	    
		
		//print_r( $this->image);
		// exit;
		
		$ModelRealtors = new JeaModelRealtors();
    	$Chitietnhamoigioi= $ModelRealtors->layChiTietNhaMoiGioi( $id );
		$this->assignRef( 'row', $Chitietnhamoigioi[0] );
		
		$this->assignRef( 'image', ilandCommonUtils::getRealtorImage( $id ) );
		$this->image['xoa']	  = JURI::root() . 'administrator/index.php?option=com_jea'
			            						.'&amp;controller=realtors&amp;task=deleteimg&amp;id='. $this->row['id'];
			            						
		//exit;
	//	print_r($Chitietnhamoigioi);
	//	echo $this->row['id'];
		// exit;
		
		$title = "";
	    $title .= ' : ' ;
	    $title .= $this->row['id']? JText::_( 'Edit' ) . ' ' . $this->escape( $this->row['ten'] ) : JText::_( 'New' ) ;
	    JToolBarHelper::title( $title , 'jea.png' ) ;
	    
	    JToolBarHelper::save() ;
	    JToolBarHelper::apply() ;
	    JToolBarHelper::cancel() ;
	    $templatePath = "../templates/WebGH/html/com_u_re/realtors/";
		$this->addTemplatePath($templatePath);
		$this->setLayout('detail');
	    parent::display();
	}
	
	
	function getDeleteRealtor()
	{	
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$ModelRealtors = new JeaModelRealtors();
    	$ModelRealtors->getRealtorDelete( $id[0] );
	}
	
 // update realtor
    function getUpdateRealtor( $param )
    {    	
    	$getLanguage = ilandCommonUtils::getLanguage();
    	$id = JRequest::getVar( 'cid', array(0), '', 'array' );    	
    	$ModelRealtors = new JeaModelRealtors();
		$ModelRealtors->getUpdateRealtor($id[0], $param, $getLanguage );
    }
    
	function getDeleteImage( $id )
	{		
		
		// ilandCommonUtils::delete_img( $id );
		$ModelRealtors = new JeaModelRealtors();
		$ModelRealtors->delete_img( $id );
		
	}
	
	function is_checkout( $checked_out )
	{
		if ($this->user && JTable::isCheckedOut( $this->user->get('id'), $checked_out ) ) {
			return true;
		}
		return false;
	}
}