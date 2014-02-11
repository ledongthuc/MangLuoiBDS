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
require_once('../libraries/com_u_re/php/common_utils.php');
class JeaModelFeatures extends JModel
{
	
	function save()
	{
		/*
		 * con ordering chua lam, hien tai la so co dinh
		 */
		
		
		$tenvi = JRequest::getVar( 'vi_hidden_ten') ;
		$tenen = JRequest::getVar( 'en_hidden_ten') ;
		$language = 'vi';
		$language1 = 'en'; //gan tam
		$ordering  = 3; //gan tam
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	
		$table = JRequest::getVar( 'table') ;
//		$ten = JRequest::getVar( 'value') ;
		$townId = JRequest::getVar( 'townId') ;
		$id = JRequest::getVar( 'id') ;
		$tiGia = JRequest::getVar( 'rate') ;
		
		$ten_loai = JRequest::getVar( 'ten_loai') ;
		$loai_tien_ich_id = JRequest::getVar( 'loai_tien_ich_id') ;
		if ( !$id )
		{
			//them
			if ( $townId )
			{
				// quan huyen
			$paramFeid = 'ten, ordering, tinh_thanh_id';
			
			$paramValue[] = $tenvi;
			$paramValue[] = '6';
			$paramValue[] = $townId;
			}
			else if ( $tiGia )
			{
				$paramFeidDefault = 'ten, ti_gia, ordering';
				$paramValue_vi[] = $tenvi ;
				$paramValue_vi[] = $tiGia;
				$paramValue_vi[] = '6';
			}
			else if ( $table == 'tien_ich' )
			{
				// print_r($ten_loai.'----'.$loai_tien_ich_id);
				// exit;
				$paramFeidDefault = 'loai_tien_ich_id, ten_loai ,ten_tien_ich, ordering';
				$paramValue_vi[] = '1' ;
				$paramValue_vi[] = 'Nội khu';
				$paramValue_vi[] = $tenvi;
				$paramValue_vi[] = '6';
				$paramFeid_en = 'id, loai_tien_ich_id, ten_loai, ten_tien_ich, ordering';
			}
			
			else
			{
				$paramFeidDefault = 'ten, ordering'; // lay cac feid dau tien..chua co id
				$paramValue_vi['ten'] = $tenvi;
				$paramValue_vi['ordering'] = '6';
				
				$paramFeid_en = 'id, ten, ordering';
//				$paramValue_en['ten'] = $tenen;
//				$paramValue_en['ordering'] = '6';
			}
//
//						print_r($DBConfig);
//						print_r($paramFeidDefault.'<br/>');
//						print_r($paramValue_vi);
//						exit;
//
//			iland4_themTinhThanhPho( $DBConfig, $paramFeidDefault, $paramValue_vi );
			
		}
		else
		{
			//sua
			if ( $townId )
			{
				$paramstring_vi = "ten='$tenvi', ordering = '$ordering', tinh_thanh_id = '$townId'";
			}
			else if ( $tiGia )
			{
				$paramstring_vi = "ten='$tenvi', ti_gia = '$tiGia', ordering = '$ordering'";				
			}
			else if ( $table == 'tien_ich')
			{
				$paramstring_vi = "ten_tien_ich='$tenvi'";
				$paramstring_en = "ten_tien_ich='$tenen'";
			}
			else
			{
				$paramstring_vi = "ten='$tenvi', ordering = '$ordering'";
				$paramstring_en = "ten='$tenen', ordering = '$ordering'";
			}
		}
		
		if ( !$id )
		{
			//them
			switch ( $table )
	    	{
	
	    		case 'phap_ly': // ok
					{
						$insertId = iland4_themPhapLy( $DBConfig, $paramFeidDefault, $paramValue_vi, $language );
						$paramValue_en['id']  = "$insertId";
						$paramValue_en['ten'] = $tenen;
						$paramValue_en['ordering'] = '6';
						iland4_themPhapLy( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
						break;
					}
	
				case 'don_vi_tien': //ok
					{
						iland4_themDonViTien( $DBConfig, $paramFeidDefault, $paramValue_vi );
						break;
					}
				case 'don_vi_dien_tich': //ok
					{
						$insertId = iland4_themDonViDienTich( $DBConfig, $paramFeidDefault, $paramValue_vi, $language );
						$paramValue_en['id']  = "$insertId";
						$paramValue_en['ten'] = $tenen;
						$paramValue_en['ordering'] = '6';
						iland4_themDonViDienTich( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
						break;
					}
				case 'loai_tien_ich': // ok
					{
						$insertId = iland4_themLoaiTienIch( $DBConfig, $paramFeidDefault, $paramValue_vi, $language );
					
						$paramValue_en['id']  = "$insertId";
						$paramValue_en['ten'] = $tenen;
						$paramValue_en['ordering'] = '6';
						iland4_themLoaiTienIch( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
						break;
					}
	    		case 'tien_ich': // ok
					{
						$insertId = iland4_themTienIch( $DBConfig, $paramFeidDefault, $paramValue_vi, $language );
						//$paramValue_en['id']  = "$insertId";
						
						//$paramValue_en['loai_tien_ich_id'] = $loai_tien_ich_id;
						//$paramValue_en['ten_loai'] = $ten_loai;
						
						//$paramValue_en['ten'] = $tenen;
						//$paramValue_en['ordering'] = '6';
						//iland4_themTienIch( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
						/*
						print_r( $paramFeid_en);
						echo "<br/>";
						print_r( $paramValue_en);
						echo "<br/>";
						print_r( $language1);
						exit;
						*/
						
						break;
					}
				case 'tinh_thanh': //ok
					{
						iland4_themTinhThanhPho( $DBConfig, $paramFeidDefault, $paramValue_vi );
						break;
					}
				case 'quan_huyen': //ok
					{
//
						iland4_themQuanHuyen( $DBConfig, $paramFeid, $paramValue );
						break;
					}
					
				case 'loai_bds': //ok
					{
					$insertId= iland4_themLoaiBDS( $DBConfig, $paramFeidDefault, $paramValue_vi, 'vi' );
					$paramValue_en['id']  = "$insertId";
					$paramValue_en['ten'] = $tenen;
					$paramValue_en['ordering'] = '6';
					iland4_themLoaiBDS( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
					break;
					}
	    		case 'loai_du_an':
					{
									// iland4_themLoaiDuAn($DBConfig, $paramfield, $arr_value, $language);
						$insertId= iland4_themLoaiDuAn( $DBConfig, $paramFeidDefault, $paramValue_vi, 'vi' );
						$paramValue_en['id']  = "$insertId";
						$paramValue_en['ten'] = $tenen;
						$paramValue_en['ordering'] = '6';
						iland4_themLoaiDuAn( $DBConfig, $paramFeid_en, $paramValue_en, $language1 );
					}
			}
			
		}
		else
		{
			//sua
			switch ( $table )
	    	{
	
	    		case 'phap_ly':
					{
						iland4_suaPhapLy( $DBConfig, $id, $paramstring_vi, $language );
						break;
					}
	
				case 'don_vi_tien':
					{
						iland4_suaDonViTien( $DBConfig, $id, $paramstring_vi );
						break;
					}
				case 'don_vi_dien_tich':
					{
						iland4_suaDonViDienTich( $DBConfig, $id, $paramstring_vi, $language );
						break;
					}
				case 'loai_tien_ich':
					{
											
						iland4_suaLoaiTienIch( $DBConfig, $id, $paramstring_vi, $language );
						iland4_suaLoaiTienIch( $DBConfig, $id, $paramstring_en, 'en' );
						break;
					}
				case 'tien_ich': // ok
					{
						iland4_suaTienIch( $DBConfig, $id, $paramstring_vi, 'vi' );
						break;
					}
				case 'tinh_thanh':
					{
						iland4_suaTinhThanhPho( $DBConfig, $id, $paramstring_vi );
						break;
					}
				case 'quan_huyen':
					{
						iland4_suaQuanHuyen( $DBConfig, $id, $paramstring_vi );
						break;
					}
					
				case 'loai_bds':
					{
						iland4_suaLoaiBDS( $DBConfig, $id, $paramstring_vi, $language );
						break;
					}
	    		case 'loai_du_an':
					{
						iland4_suaLoaiDuAn( $DBConfig, $id, $paramstring_vi, $language );
						break;
					}
			}
		}
        return true;
		
	}
	/*
	
	function remove()
	{
		$cids = implode( ',', $this->getCid() );
		
		//only one request
		$this->_db->setQuery( 'DELETE FROM `'. $this->getSqlTableName() .'` WHERE id IN (' . $cids . ')' );
		
		if ( !$this->_db->query() ) {
			JError::raiseError( 500, $this->_db->getErrorMsg() );
			return false;
		}
		
		return true;
	}
	*/
	/* hoan dang lam */
	function layDanhSachBatDongSan( $language )
    {
    	$language = 'vi'; //gan tam
    	$language2 = 'en';
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$result = array();
    	$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
    	$table = $mainframe->getUserStateFromRequest( $context.'table', 'table', 0, 'string' );
    	$townId = $mainframe->getUserStateFromRequest( $context.'tinh_thanh', 'tinh_thanh', 0, 'string' );
    	$tien_ichID = $mainframe->getUserStateFromRequest( $context.'loai_tien_ich', 'loai_tien_ich', 0, 'string' );
    	
    	
    	$ten_tien_ich = $mainframe->getUserStateFromRequest( $context.'ten_tien_ich', 'ten_tien_ich', 0, 'string' );
    //	$_SESSION['ten_tien_ich_config'] = '';
    	if ( $ten_tien_ich != NULL )
    	{
    		$_SESSION['ten_tien_ich_config'] = $ten_tien_ich;
    	}
    	
		if ( !$table )
		{
			$table = 'loai_bds';
		}
    	$result['name'] = $table;
    	$result['townId'] = $townId;
    	$result['tien_ichID'] = $tien_ichID;
    	@$result['ten_tien_ich'] = $_SESSION['ten_tien_ich_config'];
    	 // print_r( "tttt---".$result['ten_tien_ich'] );
    	if ( !$townId )
    	{
    		$townId = 1;
    	}
    	
    	if ( !$tien_ichID )
    	{
    		$tien_ichID = 1;
    	}
    	
//    	$townId =1;
//    	print_r($townId);
//    	exit;
//		print_r($table);
//		exit;
//		echo "<script> alert($table)</script>";
    	switch ( $table )
    	{

    		case 'phap_ly':
				{
					$result['value'] = iland4_layDanhSachPhapLy($DBConfig, $language);
					$result['value2'] = iland4_layDanhSachPhapLy($DBConfig, $language2);
					break;
				}

			case 'don_vi_tien':
				{
					$result['value']  = iland4_layDanhSachDonViTien($DBConfig);
					$result['value2']  = iland4_layDanhSachDonViTien($DBConfig);
					break;
				}
			case 'don_vi_dien_tich':
				{
					$result['value']  = iland4_layDanhSachDonViDienTich( $DBConfig, $language );
					$result['value2']  = iland4_layDanhSachDonViDienTich( $DBConfig, $language2 );
					break;
				}
			case 'loai_tien_ich':
				{
					$result['value']  = iland4_layDanhSachLoaiTienIch( $DBConfig, $language );
					$result['value2']  = iland4_layDanhSachLoaiTienIch( $DBConfig, $language2 );
					break;
				}
    		case 'tien_ich':
				{
					$result['value']  = iland4_layDanhSachTienIchTheoLoai( $DBConfig, $tien_ichID, $language );
					$result['value2']  = iland4_layDanhSachTienIchTheoLoai( $DBConfig, $tien_ichID, $language2 );
					break;
				}				
			case 'tinh_thanh':
				{
					$result['value']  = iland4_layDanhSachTinhThanhPho( $DBConfig );
					$result['value2']  = iland4_layDanhSachTinhThanhPho( $DBConfig );
					break;
				}
			case 'quan_huyen':
				{
					$result['value']  =  iland4_layDanhSachQuanHuyen( $DBConfig, $townId );
					$result['value2']  =  iland4_layDanhSachQuanHuyen( $DBConfig, $townId );
					break;
				}
				
			case 'loai_bds':
				{
					$result['value']  =  iland4_layDanhSachLoaiBDS( $DBConfig, $language );
					$result['value2']  =  iland4_layDanhSachLoaiBDS( $DBConfig, $language2 );
//					print_r($result['value2']);
//					exit;
					break;
				}
				
    		case 'loai_du_an':
				{
					$result['value']  =  iland4_layDanhSachLoaiDuAn($DBConfig, $language);
					$result['value2']  =  iland4_layDanhSachLoaiDuAn($DBConfig, $language2);
					break;
				}
				
				
				
//			default: $result['value']  = iland4_layDanhSachLoaiBDS( $DBConfig, $language );
		}
//    	print_r($result['value']);
//    	exit;
  		return $result ;
    }
    
    function xoaDichVuBDS( $id, $table )
    {
//    	echo $table;
//    	exit;
		$language = ilandCommonUtils::getArrayLanguage();
//		print_r($language);
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
//		iland4_xoaLoaiTienIch( $DBConfig, $id, $language );
    	switch ( $table )
	    	{
	
	    		case 'phap_ly':
					{
						iland4_xoaPhapLy( $DBConfig, $id, $language );
						break;
					}
	
				case 'don_vi_tien': //chua co extention
					{
						iland4_xoaDonViTien( $DBConfig, $id, $language );
						break;
					}
				case 'don_vi_dien_tich':
					{
						iland4_xoaDonViDienTich( $DBConfig, $id, $language );
						break;
					}
				case 'loai_tien_ich':
					{
						iland4_xoaLoaiTienIch( $DBConfig, $id, $language );
						break;
					}
	    		case 'tien_ich':
					{
						iland4_xoaTienIch( $DBConfig, $id, $language );
						break;
					}
				case 'tinh_thanh':
					{
						iland4_xoaTinhThanhPho( $DBConfig, $id );
						break;
					}
				case 'quan_huyen':
					{
						iland4_xoaQuanHuyen( $DBConfig, $id );
						break;
					}
					
				case 'loai_bds':
					{
						iland4_xoaLoaiBDS( $DBConfig, $id, $language );
						break;
					}
		    	case 'loai_du_an':
					{
						iland4_xoaLoaiDuAn($DBConfig, $id, $language);
						break;
					}
			}
    }
    
    function ordering( $table, $id, $paramstring )
    {
//    	print_r($table);
//    	print_r($id);
//    	print_r($paramstring);
//    	exit;
    	$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		
		
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$ordering = 'ordering_'.$id;
		$orderingvalue = JRequest::getVar( "$ordering", '' );
		$paramvalue = "ordering = '$orderingvalue'";
		
			switch ( $table )
	    	{
	
	    		case 'phap_ly':
					{
						iland4_suaPhapLy( $DBConfig, $id, $paramstring, $language );
						break;
					}
	
				case 'don_vi_tien':
					{
						iland4_suaDonViTien( $DBConfig, $id, $paramstring );
						break;
					}
				case 'don_vi_dien_tich':
					{
						iland4_suaDonViDienTich( $DBConfig, $id, $paramstring, $language );
						break;
					}
				case 'loai_tien_ich':
					{
						iland4_suaLoaiTienIch( $DBConfig, $id, $paramstring, $language );
						break;
					}
	    		case 'tien_ich':
					{
						iland4_suaTienIch( $DBConfig, $id, $paramstring, $language );
						break;
					}
				case 'tinh_thanh':
					{
						iland4_suaTinhThanhPho( $DBConfig, $id, $paramstring );
						break;
					}
				case 'quan_huyen':
					{
						iland4_suaQuanHuyen( $DBConfig, $id, $paramstring );
						break;
					}
					
				case 'loai_bds':
					{
						iland4_suaLoaiBDS( $DBConfig, $id, $paramstring, $language );
						break;
					}
	    		case 'loai_du_an':
					{
						iland4_suaLoaiDuAn($DBConfig, $id, $paramstring, $language);
						break;
					}
			}
    }
    
}