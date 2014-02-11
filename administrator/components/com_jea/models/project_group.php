<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package     Jea.admin
 * @copyright   Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class JeaModelProject_group extends JModel
{
	
	 
    function getListProjectGroup()
    {
		$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		return iland4_layDanhSachLoaiDuAn($DBConfig, $language);
    }

    function getProjectGroupById( $id, $language )
    {
    	
    	if ( !$id )
    	{
    		return ;
    	}
    
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_layTenLoaiDuAn($DBConfig, $id, $language);
		
    }
    
    function updateProject_group( $id, $paramvalue, $language)
    {
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_suaLoaiDuAn($DBConfig, $id, $paramvalue, $language);
    }
    
	function getDeleteProjectGroup( $id )
    {
    	$language = ilandCommonUtils::getArrayLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_xoaLoaiDuAn($DBConfig, $id, $language);
    }
    
	function getInsertProjectGroup( $arr_value )
    {
//    	$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		$language = 'vi';
		$language1 = 'en';
		
		$tenvi = JRequest::getVar( 'vi_hidden_ten') ;
		$tenen = JRequest::getVar( 'en_hidden_ten') ;
		
		
		$paramfieldDeafaul = 'ten, ordering';
		$paramfield_en = 'id, ten, ordering';
		$insertId = iland4_themLoaiDuAn($DBConfig, $paramfieldDeafaul, $arr_value, $language);
		
		return iland4_themLoaiDuAn($DBConfig, $paramfield, $arr_value, $language);

    }
    
    
	function save()
	{
		$id = JRequest::getInt( 'id', 0 , 'POST' );
		$datas = array (
		'value' =>  JRequest::getVar( 'vi_hidden_ten' ) ,
		'ordering' => '0' ,
//		'ordering' => JRequest::getVar( 'ordering' ) ,
		);
//		$datas_en = array (
//		'value' =>  JRequest::getVar( 'en_hidden_ten' ) ,
//		'ordering' => '0' ,
////		'ordering' => JRequest::getVar( 'ordering' ) ,
//		);
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
			
			$language = 'vi';
			$language1 = 'en';
			
//			$tenvi = JRequest::getVar( 'vi_hidden_ten') ;
//			$datas_en['id'] = JRequest::getVar( 'en_hidden_ten') ;
			
			
			$paramfieldDeafaul = 'ten, ordering';
			$paramfield_en = 'id, ten, ordering';
			
		if( !$id )
		{
			// them loai du an moi
				$insertId = iland4_themLoaiDuAn($DBConfig, $paramfieldDeafaul, $datas, $language);
				$datas_en[] =  "$insertId";
				$datas_en[] = JRequest::getVar( 'en_hidden_ten' );
				$datas_en[] = '6';
				return iland4_themLoaiDuAn($DBConfig, $paramfield_en, $datas_en, $language1);
		}
		// sua loai du an moi
		
		
		
//		return iland4_suaLoaiDuAn($DBConfig, $id, $paramvalue, $language);
		
		$dataEn = JRequest::getVar( 'en_hidden_ten' );
		
		$giaTriTen = "ten='$datas[value]'";
		$this->updateProject_group( $id, $giaTriTen, $language );
		$giaTriTenEn = "ten='$dataEn'";
		$this->updateProject_group( $id, $giaTriTenEn, $language1 );
//		print_r($giaTriTen);
//		exit;
		
//        $this->_lastId = $id;
//        print_r($this->_lastId);
//        exit;
//        echo "<script>alert($this->_lastId)</script>";

        return true;
	}
	
	function ordering( $id, $language)
	{
		
		$ordering = 'ordering_'.$id;
		$orderingvalue = JRequest::getVar( "$ordering", '' );
		$paramvalue = "ordering = '$orderingvalue'";
		$this->updateProject_group( $id, $paramvalue, $language );
	}
	
	
    
    
}