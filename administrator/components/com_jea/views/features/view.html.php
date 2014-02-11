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
//include_once COM_U_RE_COMMON_UTILS;
require_once('../libraries/com_u_re/php/common_utils.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.'features.php');
class JeaViewFeatures extends JView

{
	var $pagination = null ;

	function display( $tpl = null )
	{
		switch ($tpl) {
			case 'form':
				$this->editItem();
				break;
			default :
				$this->listItems();

		}

		parent::display($tpl);
	}


	function listItems()
	{
		
		$language = 'vi';
		jimport( 'joomla.html.pagination' );

		 global $u_reGlobalConfig;
		//get limit
		$limit = $u_reGlobalConfig['PROJECTGROUP']['list_limit'];
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
//print_r('lm'.$limit);
		$ModelFeatures = new JeaModelFeatures();
		
		$DanhSachBDS = $ModelFeatures->layDanhSachBatDongSan( $language );
		$this->assignRef('rows' , $DanhSachBDS['value'] );
		$this->assignRef('rows2' , $DanhSachBDS['value2'] );
//		print_r($this->row2);
//		$this->assignRef('rows_en' , $DanhSachBDS['value2'] );
		$this->assignRef('tenBang' , $DanhSachBDS['name'] );
		$this->assignRef('townId' , $DanhSachBDS['townId'] );
		$this->assignRef('tien_ichID' , $DanhSachBDS['tien_ichID'] );
		// print_r($this->tien_ichID);
		// exit;
		$tablesTranslations = array(
		    'loai_bds'         => 'LOAI_BDS' ,
	        'tinh_thanh'         => 'TINH_THANH' ,
	        'quan_huyen'         => 'QUAN_HUYEN' ,
			'tien_ich'    => 'TIEN_ICH' ,
	        'phap_ly'  => 'PHAP_LY',
			'don_vi_tien'   => 'DON_VI_TIEN',
			'don_vi_dien_tich'   => 'DON_VI_DIEN_TICH',
	    );
	    	

        $options = array();

        foreach ( $tablesTranslations as $tableName => $translation )
        {
        	$options[] = JHTML::_('select.option', $tableName, JText::_( $translation ) );
        }

        $selectTableList = JHTML::_( 'select.genericlist',
                                     $options,
	                                 'table',
	                                 'class="inputbox" size="1" onchange="document.adminForm.submit();"' ,
	                                 'value',
	                                 'text',
                                    $this->tenBang
                                    );
		if(  $this->tenBang == 'quan_huyen')
		{
		    $towns = ilandCommonUtils::getSelectBox( 'tinh_thanh', 'tinh_thanh', '', $this->townId, 'onchange=document.adminForm.submit()');
		    $this->assignRef( 'tinh_thanh', $towns );
		}
		
		if(  $this->tenBang == 'tien_ich')
		{
		    $loai_tien_ich = ilandCommonUtils::getSelectBox( 'loai_tien_ich', 'loai_tien_ich', '', $this->tien_ichID, 'onchange=test(),document.adminForm.submit()');
		    $this->assignRef( 'loai_tien_ich', $loai_tien_ich );
		}
		
		$this->assignRef('tongDong' ,count($this->rows) );
		$this->assignRef( 'paging', ilandCommonUtils::getPage($this->tongDong, $limit) );
		$this->pagination = new JPagination( $this->tongDong , $limitstart, $limit );
		
		$this->assignRef('chonDanhSachBDS' , $selectTableList );
		
		JToolBarHelper::title( JText::_($this->tenBang), 'jea.png' );
	    JToolBarHelper::addNew();
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
	}

	function editItem()
	{
		
		
		
		$urlId=JFactory::getURI()->getVar("id");
		if ( $urlId )
		{
			$id = $urlId;
		}
		else
		{
			$id =0;
		}
		
		$urlten=JFactory::getURI()->getVar("ten");
		if ( $urlten )
		{
			$ten = $urlten;
		}
		else
		{
			$ten = '';
		}
		
		$urltigia = JFactory::getURI()->getVar("tigia");
		if ( $urlten )
		{
			$tigia = $urltigia;
		}
		else
		{
			$tigia = '';
		}
		//$language = ilandCommonUtils::getLanguage();
		$language ='vi';
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
//		$id = 0;
//		$ten= '';
//		$tigia= '';
//		print_r($cid);
		$ModelFeatures = new JeaModelFeatures();
		$DanhSachBDS = $ModelFeatures->layDanhSachBatDongSan( $language);
		$this->assignRef('tenBang' , $DanhSachBDS['name'] );
		
		if( $cid[0] )
		{
			if ( $this->tenBang == 'don_vi_tien' )
			{
				list( $id, $ten, $tigia ) = explode('@#$%^',$cid[0]);
			}
			else
			{
				list( $id, $ten ) = explode('@#$%^',$cid[0]);
			}
		}
//		print_r($id);
//		echo "eee";
//		exit;
			$this->assignRef('ten' , $ten );
			$this->assignRef('id' , $id );
			$this->assignRef('ti_gia' , $tigia );
//			print_r($this->ten);
//			exit;
		JRequest::setVar( 'hidemainmenu', 1 );

		$table_name = JText::_( $this->tenBang ) ;
        
        if ( ! $id ) {
	        
	        $title = $table_name . ' [ ' . JText::_( 'New' ) . ' ]' ;
	    }
	    else
	    {
	        
		    $title  = $table_name . ' [ ' . JText::_( 'Edit' ) . ' : ' .  $this->ten . ' ]' ;
	    }

		JToolBarHelper::title( $title , 'jea.png' );
		JToolBarHelper::save() ;
		JToolBarHelper::apply() ;
		JToolBarHelper::cancel() ;
	  
			//neu Tinh thanh
		$townid = '';
		if(  $this->tenBang == 'quan_huyen')
			$townid = $DanhSachBDS['townId'];
			
		$this->assignRef('townId' , $townid );
		
		// echo "<script>alert('vvv')</script>";
		// neu la tien ich
		$tien_ichID = '';
		$ten_tien_ich = '';
		if(  $this->tenBang == 'tien_ich')
		{
			$tien_ichID = $DanhSachBDS['tien_ichID'];
			$ten_tien_ich = $DanhSachBDS['ten_tien_ich'];
		}
			
		$this->assignRef('tien_ichID' , $tien_ichID );
		$this->assignRef('ten_tien_ich' , $ten_tien_ich );	
	//	print_r($this->ten_tien_ich);
		//echo "<script>alert($this->ten_tien_ich)</script>";
		//exit;
	}
	
	function getDeleteFeatures()
	{
		$language = 'vi'; //gan tam
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		
		if( $cid[0] )
		{
			list( $id ) = explode('@#$%^',$cid[0]);
		}
		$this->assignRef('id' , $id );
  		$ModelFeatures = new JeaModelFeatures();
  		
		$DanhSachBDS = $ModelFeatures->layDanhSachBatDongSan( $language );
		$this->assignRef('tenBang' , $DanhSachBDS['name'] );
		
		$ModelFeatures->xoaDichVuBDS( $this->id, $this->tenBang );
	}
	
	
	function getUpdateFeatures( $param )
	{
		$language = 'vi'; //gan tam
//		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $cid[0] )
		{
			list( $id ) = explode('@#$%^',$cid[0]);
		}
		
		$ModelFeatures = new JeaModelFeatures();
		$DanhSachBDS = $ModelFeatures->layDanhSachBatDongSan( $language );
		$this->assignRef('tenBang' , $DanhSachBDS['name'] );
		
    	$ModelFeatures = new JeaModelFeatures();
		$ModelFeatures->ordering( $this->tenBang, $id, $param );
	}
	
	  function getUpdateOrdering(  )
	{
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $cid[0] )
		{
			list( $id ) = explode('@#$%^',$cid[0]);
		}
		
		
		$ordering = 'ordering_'.$id;
		$orderingvalue = JRequest::getVar( "$ordering", '' );
		$paramvalue = "ordering = '$orderingvalue'";
		
//		print_r($paramvalue);
//		exit;
//		$language = ilandCommonUtils::getLanguage();
		$language ='vi';
    	$ModelFeatures = new JeaModelFeatures();
    	$DanhSachBDS = $ModelFeatures->layDanhSachBatDongSan( $language );
		$this->assignRef('tenBang' , $DanhSachBDS['name'] );
		$ModelFeatures->ordering($this->tenBang, $id, $paramvalue );
	}
	
}