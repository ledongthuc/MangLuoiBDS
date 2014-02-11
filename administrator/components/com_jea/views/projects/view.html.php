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

jimport( 'joomla.application.component.view');

//require_once(JPATH_COMPONENT.DS.'models'.DS.'projects.php');
//require_once( JPATH_COMPONENT . DS .'utils.php'  );
require_once('../libraries/com_u_re/php/common_utils.php');
include_once('libraries/js/ham-tien-ich-php.php');
include_once('../libraries/unisonlib/com_jea_lib.php');
class JeaViewProjects extends JView
{
	var $pagination = null ;
	var $user = null;

	function is_checkout( $checked_out )
	{
		if ($this->user && JTable::isCheckedOut( $this->user->get('id'), $checked_out ) ) {
			return true;
		}
		return false;
	}
	
	function getlisDuAn($returnfield,$condition,$limit,$order){
		$db = JFactory::getDBO();
		$query = "select $returnfield from iland4_du_an_vi where $condition order by $order limit $limit ";
		$db->setQuery($query);
		$result = $db->loadRowList();
		return $result;
		
	}
	function getlistproject()
	{
		jimport('joomla.html.pagination');

		JToolBarHelper::title( JText::_( ucfirst( $this->get('category') ) . ' management' ), 'jea.png' );
	    JToolBarHelper::publish();
	    JToolBarHelper::unpublish();
	    JToolBarHelper::addNew();
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
	
		global $u_reGlobalConfig;
		
		// get return field
		$returnField = $u_reGlobalConfig['PROJECT']['project_list_return_field'];
		//get limit
		$limit = $u_reGlobalConfig['PROJECT']['list_limit'];
		$orderby = $u_reGlobalConfig['PROJECT']['orderby'];
		
		// get condition param
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
		$patch_split_f =   split("/", JFactory::getURI()->_path);	
    	$type_id = $mainframe->getUserStateFromRequest( $context.'type_id', 'type_id', 0, 'int' );
    	$town_id = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
    	$search  = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
		$published = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis  = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );

		$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$conditionParams =  ' 1 '; 
		
		//$loai_du_an_id = JFactory::getURI()->getVar("loai_du_an_id");
		
		$isfontend = 1;
		foreach (  $patch_split_f as $patch_value )
		{
			if ( $patch_value =='administrator' )
			{
				$isfontend = 0;
				break;
			}	
		}
		if ( $isfontend )
		{
			$conditionParams .= ' AND hien_thi_ra_ngoai = 1';
		}
		//else
		//{
		//	if ( $published!=-1 ) $conditionParams .= ' AND hien_thi_ra_ngoai = '.$published;		
		//}
		
		//if( $emphasis != -1 ) $conditionParams .= ' AND noi_bat = '.$emphasis;		
		if ( $town_id!= 0 )  $conditionParams .= ' AND tinh_thanh_id = '.$town_id;
		if ( $area_id!= 0 &&  $town_id!= 0 )  $conditionParams .= ' AND quan_huyen_id = '.$area_id;
		//if ( $type_id!= 0 )  $conditionParams .= ' AND loai_du_an_id = '.$type_id;
		if ( $search!=NULL )  $conditionParams .= ' AND ten LIKE \'%'. $search .'%\'';
		//if( $loai_du_an_id ) $conditionParams .= ' AND loai_du_an_id = '.$loai_du_an_id;
		
		// end get condition param

		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		$projectModel = new U_ReModelProjects();
		
		$projectData = $projectModel->getListProjects($returnField, $conditionParams,$page, $limit, $orderby);
		
		
		//$this->assignRef( 'type_id', $projectData['type_id'] );
		//$type = ilandCommonUtils::getSelectBox( 'loai_du_an', 'type_id', JText::_('LOAI_DU_AN'), $type_id, 'onchange=document.adminForm.submit()');
	    //$this->assignRef( 'type', $type );

		$this->assignRef( 'town_id', $town_id );
	    $towns = ilandCommonUtils::getSelectBox( 'tinh_thanh', 'town_id', JText::_('TINH_THANH'), $town_id, 'onchange=document.adminForm.submit()');
	    $this->assignRef( 'towns', $towns );
	   	$this->assignRef( 'area_id', $projectData['area_id'] );
	   	$areas = ilandCommonUtils::getSelectBox( 'quan_huyen', 'area_id', JText::_('QUAN_HUYEN'), $area_id, 'onchange=document.adminForm.submit()', $this->town_id);
	    $this->assignRef( 'areas', $areas );
	    
	    $this->assignRef( 'paging', ilandCommonUtils::getPage($projectData['rows'][0], $limit) );
	    $this->assignRef( 'rows', $projectData['rows'][3]);
	    //$this->assignRef( 'emphasis', $emphasis );
	    $this->assignRef( 'published', $published );
	   	$this->assignRef( 'search', $search );
	    
		$this->pagination = new JPagination( $projectData['rows'][0] , $limitstart, $limit );
		
		parent::display();
	}
	
	function editItem()
	{
		global $u_reGlobalConfig;
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $idurl =JFactory::getURI()->getVar("id"))
		{
			$id = $idurl;
		}
		else
		{
			$id = $cid[0];
		}
		$tinhThanhId = $u_reGlobalConfig['COMMON']['tinh_thanh_mac_dinh'];
		$quanHuyenId = $u_reGlobalConfig['COMMON']['quan_huyen_mac_dinh'];
		
		$templatePath= "../templates/".$u_reGlobalConfig['DB']['template']."/html/com_u_re/projects/"; 
		
		$this->assignRef('lang' , ilandCommonUtils::getLanguage());
		$this->status = 2;
		$projectModel = new U_ReModelProjects();
		$projectData = $projectModel->getProjectById($id, $this->lang);
		$tinhThanhId = $projectData['tinh_thanh_id'];
		$quanHuyenId = $projectData['quan_huyen_id'];
		$projectDataEn = $projectModel->getProjectById($id, 'en');
		$this->assignRef( 'row', $projectData );
		$this->assignRef( 'rowEn', $projectDataEn );
		$this->assignRef( 'town_id', $projectData['tinh_thanh_id'] );
		$towns =  ilandCommonUtils::getSelectBox('tinh_thanh', 'town_id','',$tinhThanhId,'layseachquanhuyenadmin("area_id",this.value,"vi-VN","'.JURI::root().'","area_id") ','',"style='width:264px!important'","class='inputbox2'");
	    $this->assignRef('towns' , $towns );
	    $this->assignRef( 'area_id', $projectData['quan_huyen_id'] );
		$areas =  ilandCommonUtils:: getSelectBox('quan_huyen', 'area_id', '',$quanHuyenId,'', 	$tinhThanhId,"style='width:264px!important'","class='inputbox2'");		
	    $this->assignRef('areas' , $areas );
//		$type_selected = $this->row['loai_du_an_id'] ;
		//$type_id = ilandCommonUtils::getSelectBox( 'loai_du_an', 'type_id','', $type_selected,'','','','',$this->lang);
 		//$this->assignRef( 'type', $type_id );

 		// hien thi cho chinh
		$mainImage = ilandCommonUtils::getProjectMainImage( $id );

		// hien thi cho trinh dien anh
		$subImages = ilandCommonUtils::getProjectSubImages( $id);
 		
		// get image block
		$imageData = array();
		$imageData['status'] = 2;
		$imageTemplateName = 'image_block';
		$imageData['mainImage'] = $mainImage;
		$imageData['subImages'] = $subImages;
		$imageData['title'] = '';
		$imageData['id'] = $id;
		$imageBlockHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath, 
	    																$imageTemplateName, 
	    																$imageData );
	    $this->assignRef('imageBlockHTML' , $imageBlockHTML );

	    // lay cac hinh anh dac biet: so do mat bang, noi that, ngoai that
	    // so do mat bang
		$soDoMatBangImageData = array();
		$soDoMatBangImageData['id'] = 0;
		$soDoMatBangImageData['status'] = 2;
		$soDoMatBangImageData['images'] = '';
		$soDoMatBangImageData['folder'] = 'sodomatbang';
		$soDoMatBangImageData['spec_name'] = 'so_do_mat_bang_img';
		
		// noi that
		$noiThatImageData = array();
		$noiThatImageData['id'] = 0;
		$noiThatImageData['status'] = 2;
		$noiThatImageData['images'] = '';
		$noiThatImageData['folder'] = 'noithat';
		$noiThatImageData['spec_name'] = 'noi_that_img';			 
		
		// ngoai that
		$ngoaiThatImageData = array();
		$ngoaiThatImageData['id'] = 0;
		$ngoaiThatImageData['status'] = 2;
		$ngoaiThatImageData['images'] = '';
		$ngoaiThatImageData['folder'] = 'ngoaithat';
		$ngoaiThatImageData['spec_name'] = 'ngoai_that_img';

		if ( $id )
		{
			// so do mat bang
			$soDoMatBangImageData['id'] = $id;
			$soDoMatBangImageData['images'] = ilandCommonUtils::layHinhAnhSoDoMatBang( $id, 'project' );
			
			// noi that
			$noiThatImageData['id'] = $id;
			$noiThatImageData['images'] = ilandCommonUtils::layHinhAnhNoiThat( $id, 'project' );
			
			// ngoai that
			$ngoaiThatImageData['id'] = $id;
			$ngoaiThatImageData['images'] = ilandCommonUtils::layHinhAnhNgoaiThat( $id, 'project' );
		}
	    
		// fetch hinh anh so do mat bang, noi that, ngoai that
	    $soDoMatBangImageHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath,
	    																	 'spec_image_block',
	    																	 $soDoMatBangImageData ); 
	    $this->assignRef( 'soDoMatBangImageHTML', $soDoMatBangImageHTML );
	    
	    $noiThatImageHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath,
	    																	 'spec_image_block',
	    																	 $noiThatImageData ); 
	    $this->assignRef( 'noiThatImageHTML', $noiThatImageHTML );
	    
	    $ngoaiThatImageHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath,
	    																	 'spec_image_block',
	    																	 $ngoaiThatImageData ); 
	    $this->assignRef( 'ngoaiThatImageHTML', $ngoaiThatImageHTML );
		
	    // lay thong tin dat cho
	    $this->row['status'] = 2;
	    
		JRequest::setVar( 'hidemainmenu', 1 );
		$title = "";
	    $title .= ' : ' ;
	    $title .= $this->row['ten'] ? JText::_( 'Edit' ) . ' ' . $this->row['ten']  : JText::_( 'New' ) ;
	    JToolBarHelper::title( $title , 'jea.png' ) ;
	    $app =& JFactory::getApplication();
		
		$this->addTemplatePath($templatePath);
		$this->setLayout('detail');		
	    parent::display();	    
	}
	
	
 	function getemphasis($param)
    {
    	$this->assignRef('lang' , ilandCommonUtils::getLanguage());
		$id = JeaViewProjects::getId();
    	$projectModel = new JeaModelProjects();
		$projectData = $projectModel->updateProject( $id, $param, $this->lang);
    }
    
    // cap nhat thong tin du an
    function getUpdateProject($param)
    {
    	$this->assignRef('lang' , ilandCommonUtils::getLanguage());
		$id = JeaViewProjects::getId();
    	$projectModel = new JeaModelProjects();
		$projectData = $projectModel->updateProject( $id, $param, $this->lang);
    }
    
    // xoa du an
    function getDeleteProject()
    {
    	$id = JeaViewProjects::getId();
    	$projectModel = new JeaModelProjects();
		$projectData = $projectModel->getProjectDelete( $id );
    }
	
    // get project id
    function getId()
    {
    	$id = JRequest::getVar( 'cid', array(0), '', 'array' );
    	return $id[0];
    }

    function getUpdateOrdering(  )
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$language = ilandCommonUtils::getLanguage();
    	$projectModel = new JeaModelProjects();
		$projectModel->ordering( $id[0], $language );
	}
	
	function getDeleteImage( $id )
	{		
		
		// ilandCommonUtils::delete_img( $id );
		$projectModel = new JeaModelProjects();
		$projectModel->delete_img( $id );
		
	}
	

}
