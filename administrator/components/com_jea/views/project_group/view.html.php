<?php
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
//require_once('../libraries/com_u_re/php/common_utils.php');
jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT.DS.'models'.DS.'project_group.php');
//require_once( JPATH_COMPONENT . DS .'utils.php'  );
require_once('../libraries/com_u_re/php/common_utils.php');
include_once('../libraries/unisonlib/com_jea_lib.php');

class JeaViewProject_group extends JView

{
	function editItem()
	{
		JToolBarHelper::title( 'Chỉnh sửa Loại Dự Án' , 'jea.png' );
		JToolBarHelper::save() ;
		JToolBarHelper::apply() ;
		JToolBarHelper::cancel() ;
		$language = ilandCommonUtils::getLanguage();
		$this->assignRef( 'lang', $language );
		$language1 = 'en';
		$cid= JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $idurl =JFactory::getURI()->getVar("id"))
		{
			$id = $idurl;
		}
		else
		{
			$id = $cid[0];
		}
//		print_r($id);
//		exit;
	 	$Project_groupModel = new JeaModelProject_group();
		$ProjectGroupData = $Project_groupModel->getProjectGroupById( $id, $language);
		$ProjectGroupData_en = $Project_groupModel->getProjectGroupById( $id, $language1);
		$this->assignRef( 'ten', $ProjectGroupData );
		$this->assignRef( 'ten_en', $ProjectGroupData_en);
		$this->assignRef( 'id', $id );
		$title = "";
	    $title .= ' : ' ;
	    $title .= $this->ten ? JText::_( 'Edit' ) . ' ' . $this->ten  : JText::_( 'New' ) ;
	    JToolBarHelper::title( $title , 'jea.png' ) ;
	    
		  parent::display('form');
	}

	function getListProjectGroup()
	{
		JToolBarHelper::title( JText::_('bang' ), 'jea.png' );
	    JToolBarHelper::addNew();
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
	    
		$ProjectGroup = new JeaModelProject_group();
		$ProjectGroupData = $ProjectGroup->getListProjectGroup( );
		 global $u_reGlobalConfig;
		//get limit
		$limit = $u_reGlobalConfig['PROJECTGROUP']['list_limit'];
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		$total = count($ProjectGroupData);
		
		
		jimport('joomla.html.pagination');
		$this->pagination = new JPagination( $total , $limitstart, $limit );
		
	
	    $this->assignRef( 'rows', $ProjectGroupData );
	    parent::display();
	}
	
	function getUpdateProjectgroup( $param)
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$language = ilandCommonUtils::getLanguage();
    	$ProjectGroup = new JeaModelProject_group();
		$ProjectGroup->updateProject_group( $id[0], $param, $language );
	}
	
	function getUpdateOrdering(  )
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$language = ilandCommonUtils::getLanguage();
    	$ProjectGroup = new JeaModelProject_group();
		$ProjectGroup->ordering( $id[0], $language );
	}
	
	function getDeleteProjectGroup()
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
    	$ProjectGroup = new JeaModelProject_group();
		$ProjectGroup->getDeleteProjectGroup( $id[0] );
	}

}