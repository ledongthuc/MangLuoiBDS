<?php

/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package     Jea.site
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

require_once JPATH_COMPONENT.DS.'view.php';
//require_once COM_U_RE_MODEL_PROPERTY;
require_once 'libraries/com_u_re/models/properties.php';
require_once('libraries/com_u_re/php/common_utils.php');
require_once COM_U_RE_UTILS;
require_once COM_U_RE_COMMON_UTILS;
jimport( 'joomla.document.document' );

class U_ReViewProperties extends U_ReView 
{
	function display( $tpl = null, $dataHTML = null )
	{
		if ( $dataHTML != null )
		{
			// start capturing output into a buffergetList
			ob_start();
			$this->_output = $dataHTML;
			ob_end_clean();
			echo $this->_output;
		}
		else 
		{
			parent::display($tpl);
		}
	}

	/*
	* Description: 
	* Author: Minh Chau
	* Version: 
	* Date create: 26-03-2011
	*/
	function getList()
	{
		// get param from session & search
		//$session = JFactory::getSession();
		//$searchParams = $session->get( 'u_reSearch' );
		$searchParams = $_SESSION['u_reSearch'];
		$conditionParams = U_ReViewProperties::genConditionParam( $searchParams );
		
		global $u_reGlobalConfig;		
		
		// get return field
		$returnField = $u_reGlobalConfig['PROPERTY']['du_lieu_tra_ve'];
		
		// get current page & limit
		$page = $_SESSION['page'];
		
		$page = 1;
		$limit = $u_reGlobalConfig['PROPERTY']['list_limit'];
		
		$currentTemplate = JFactory::getApplication()->getTemplate();
		$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
		$this->addTemplatePath( $templatePath );
				
		$propertyModel = new U_ReModelProperties();
		$propertyList = $propertyModel->getListProperties( $returnField, $conditionParams, 
														   $page, $limit );
														   
		$data = ilandCommonUtils::boSungThongTinBDS( $propertyList[3], $templatePath );
		// get template
		// hardcode template name
		$this->setLayout( $u_reGlobalConfig['PROPERTY']['list_template'] );
		
		// assign
		$this->assignRef('data' , $data );
		parent::display();
	}
	
	// TODO: xem lai, ham nay tam thoi xu li viec load module danh sach bat dong san trong phan list
	function getPropertyCatDirect( $catdirect )
	{		
		// echo "catDirect";
	//	exit;
		switch ( $catdirect )
		{
			case 'selling': $catdirectvalue = 'CẦN BÁN';
			break;
			
			case 'renting': $catdirectvalue = 'CHO THUÊ';
			break;
			
			//case 'needbuying': $catdirectvalue = 'CẦN MUA';
			//break;
			
			//case 'needrenting': $catdirectvalue = 'CẦN THUÊ';
			//break;
		}
		
		$modProperties = JModuleHelper::getModule('danh_sach_BDS', $catdirectvalue); 
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modProperties, $attribs );
		echo $dataHTML;
	}
	
// TODO: xem lai, ham nay tam thoi xu li viec load module danh sach bat dong san trong phan list
	function getPropertyList()
	{		
		$modProperties = JModuleHelper::getModule('danh_sach_BDS', 'KẾT QUẢ TÌM KIẾM'); 
		 
        $attribs['style'] = 'raw';        
		$dataHTML = JModuleHelper::renderModule( $modProperties, $attribs );
		echo $dataHTML;
	}
	function genConditionParam( $params )
	{
		if ( empty( $params ) )
		{
			return '1';
		}
		$result = '';
		foreach ( $params as $key => $value )
		{
			$result .= $key . '=' . $value;
		}
		return $result;
	}
	
	/*
	* Description: Display properties detail 
	* Author: Minh Chau
	* Version: 1.0
	* Date create: 04-03-2011
	*/
	function displayPropertyDetail( $id )	
	{	
		
		global $u_reGlobalConfig;
		
		$language = ilandCommonUtils::getLanguage();
		// get data
		$propertyModel = new U_ReModelProperties();
		$propertyData = $propertyModel->layChiTietBDS( $id , $language );
		
		// get template
		$templateName = JFactory::getApplication()->getTemplate();
		$templatePath = JPATH_THEMES . DS . $templateName . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
		$this->addTemplatePath( $templatePath );
		$hien_thi_luot_xem = 0;
		if(isset($propertyData['hien_thi_ra_ngoai']) && $propertyData['hien_thi_ra_ngoai']!=0 
					|| !empty($_GET['preview'])) {	
			$ip = $_SERVER['REMOTE_ADDR'];
			$session = JFactory::getSession();
			$ipSession = $session->get( 'bds_' . $propertyData['id'] );
			ilandCommonUtils::themLuotXemBDS($id,$propertyData['luot_xem']);
			if ( empty( $ipSession ) || $ipSession != $ip )
			{
				$propertyData['luot_xem'] += 1;
			}
			//$propertyData['luot_xem'] += 1;
			//$propertyData['luot_xem'] = ilandCommonUtils::demLuotXemBDS($id, 0);
			if($u_reGlobalConfig['COMMON']['luot_xem_bds'] == 1 )
				$hien_thi_luot_xem = 1 ;
			else
				$hien_thi_luot_xem = 0 ;
			$this->setLayout( $u_reGlobalConfig['PROPERTY']['detail_template'] );
			
			
		}else{
			$this->setLayout( $u_reGlobalConfig['PROPERTY']['detail_template'].'_error' );
			parent::display();
			return;
		}
		
		$this->assign( 'hien_thi_luot_xem', $hien_thi_luot_xem );
		
		// neu la loai can mua, can thue, hien thi template can mua can thue
		if ( $propertyData['loai_giao_dich_id'] == '3' || $propertyData['loai_giao_dich_id'] == '4' )
		{
			$this->assignRef('propertyData', $propertyData);
			$this->setLayout( $u_reGlobalConfig['PROPERTY']['can_mua_template'] );
			parent::display();
			return;
		}
		
		// status 0 => trang chi tiet bat dong san	
				
		$this->assign( 'status', 0 );
		$this->assign( 'googlemapDisplay', $u_reGlobalConfig['MAP']['property_map_function_on'] );
		$this->assign( 'googlemapEnable', $u_reGlobalConfig['MAP']['property_map_function_enable'] );
		
		// hien thi cho trinh dien anh
		$mainImage = ilandCommonUtils::getPropertyMainImage( $id );
	    //$this->assignRef('mainImage' , $mainImage );

		// hien thi cho trinh dien anh
		$subImages = ilandCommonUtils::getPropertySubImages( $id );
	    //$this->assignRef('secondariesImages' , $secondariesImages );
	    
		$imageData = array();
			
		$imageData['mainImage'] = $mainImage;
		$imageData['subImages'] = $subImages;
		$imageData['status'] = 0; // chi tiet bds front end
		$imageData['id'] = $id; // chi tiet bds front end
		$imageTemplateName = 'image_block';
		$imageData['title'] = $propertyData['tieu_de'];
				
	    $imageBlockHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath, 
	    																$imageTemplateName, 
	    																$imageData );
	    $this->assignRef('imageBlockHTML' , $imageBlockHTML );
	    
	    // Lấy chuỗi thông tin diện tích khuôn viên
	    $areaInfoString = U_ReViewProperties::getAreaInfoString( 
	    							$propertyData['dien_tich_khuon_vien_rong'], 
	    							$propertyData['dien_tich_khuon_vien_dai'] );
	    $this->assignRef('areaInfoString' , $areaInfoString );
	    
	    // Lấy chuỗi thông tin diện tích sử dụng
	    $usedAreaInfoString = U_ReViewProperties::getAreaInfoString( 
	    							$propertyData['dien_tich_su_dung_rong'], 
	    							$propertyData['dien_tich_su_dung_dai'] );
	    $this->assignRef('usedAreaInfoString' , $usedAreaInfoString );
	    
	    	    // Lấy chuỗi thông tin diện tích xay dung
	    $construcAreaInfoString = U_ReViewProperties::getAreaInfoString( 
	    							$propertyData['dien_tich_xay_dung_rong'], 
	    							$propertyData['dien_tich_xay_dung_dai'] );
	    $this->assignRef('construcAreaInfoString' , $construcAreaInfoString );
	   
	    $livingSpaceString = U_ReViewProperties::getLivingSpaceString( 
	    							$propertyData['dien_tich_su_dung'] );
	    $this->assignRef('livingSpaceString' , $livingSpaceString );	    

	    
	    // phong khach 
	    if ( empty( $propertyData['phong_khach'] ) )
	    {
	    	$propertyData['phong_khach'] = '_';
	    }
	    
	    // phong ngu
	    if ( empty( $propertyData['phong_ngu'] ) )
	    {
	    	$propertyData['phong_ngu'] = '_';
	    }
	    
	    // phong tam
	    if ( empty( $propertyData['phong_tam'] ) )
	    {
	    	$propertyData['phong_tam'] = '_';
	    }
	    
	    // cac phong khac
		if ( empty( $propertyData['phong_khac'] ) )
	    {
	    	$propertyData['phong_khac'] = '_';
	    }
	    
	    // huong
		if ( empty( $propertyData['huong'] ) )
	    {
	    	$propertyData['huong'] = '_';
	    }
	    
	    // dien tich xay dung
		if ( empty( $propertyData['dien_tich_xay_dung_dai'] ) )
		{
			$propertyData['dien_tich_xay_dung_dai'] = '_' ;
		}
		
		if ( empty( $propertyData['dien_tich_xay_dung_rong'] ) )
		{
			$propertyData['dien_tich_xay_dung_rong'] = '_' ;
		}
	    
		// phap ly
		if ( empty( $propertyData['phap_ly'] ) )
		{
			$propertyData['phap_ly'] = '_' ;
		}
		
		if ( empty( $propertyData['dia_chi'] ) )
		{
			$propertyData['dia_chi'] = ilandCommonUtils::ketHopDiaChi( $propertyData['so_nha'], 
													 $propertyData['duong_pho'],
													 $propertyData['phuong_xa'],
													 $propertyData['quan_huyen'],
													 $propertyData['tinh_thanh'] );
			
		}

		/*
		 * Get same properties
		 *  - Get id
		 *  - Get current page
		 */		
		// mặc định là trang 1
		$currentPage = 1;
		
		// get data & fetch template
		$returnFieldList = U_ReConfig::getValueByKey( 'PROPERTY', 'bdslq_truong_du_lieu' );
		$conditionStr = U_ReConfig::getValueByKey( 'PROPERTY', 'bdslq_dieu_kien' );
		$sameProperties = $propertyModel->getSameProperties( $language, $returnFieldList, 
															 $conditionStr, 
															 $propertyData, $currentPage );
															 
		$sameProperties[3] = ilandCommonUtils::boSungThongTinBDS( $sameProperties[3], $templatePath, 'bdslq' );													 
		
		// get ajax paging
		$samePropertiesConditionParam = ilandCommonUtils::genBDSLQConditionParam( 
													$conditionStr, $propertyData );
													
													
		$samePropertiesTemplate = $u_reGlobalConfig['PROPERTY']['bdslq_template'];
		$url = JURI::base() . 'ajax_function.php?task=bdslq&page=' . $currentPage . '&id=' . $id . 
									'&condition=' . $conditionStr .
									'&return_field=' . $returnFieldList . 
									'&template_path=' . $templatePath .
									'&template_name=' . $samePropertiesTemplate .
									'&tienTemplatePath=tiente3&moduleId=tranga&id=' . $propertyData['id'] . 
									'&idContentElement=tranga' . 
									'&ajaxPagingTemplate=' . $u_reGlobalConfig['COMMON']['ajax_paging_template'];		
		$conditionParam = explode( ',', $conditionStr );
		foreach ( $conditionParam as $param )
		{
			$url .= '&' . $param . '=' . $propertyData[$param];	
		}
		
		$idContentElement = 'tranga';
		$totalPage = $sameProperties[1];
		$samePropertiesAjaxPagingTemplateName = $u_reGlobalConfig['COMMON']['ajax_paging_template'];
		$samePropertiesAjaxPagingHTML = ilandCommonUtils::getAjaxPagination( $idContentElement, 
																$url, $currentPage, $totalPage, 
																	$templatePath, 
															$samePropertiesAjaxPagingTemplateName );
															
															

		if ( !empty($sameProperties[3] ))
		{													
		$samePropertiesHTML = ilandCommonUtils::fetchPropertiesTemplate( $templatePath, 
															   $samePropertiesTemplate, 
															   $sameProperties[3] );
		}	
		else 
		{
			$samePropertiesHTML = 0;
		}
														   
	    $this->assignRef( 'samePropertiesHTML', $samePropertiesHTML );
	    $this->assignRef( 'samePropertiesAjaxPagingHTML', $samePropertiesAjaxPagingHTML );
			
		// getAdvantageslist
//		$advantagesList =  $propertyModel->layDanhSachTienIch( $id );
//	    $this->assignRef( 'advantagesList', $advantagesList );
	    $tempalateName = 'tien_te3';
	    // lay template gia tien
	    $gia = array( 
	    	$propertyData['VND'], 
	    	$propertyData['USD'], 
	    	$propertyData['SJC'] );
	    $donViTien = array ( 'VND',	'USD', 'SJC');
	    $templateTien = $u_reGlobalConfig['PROPERTY']['tien_template'];
		$tienHTML = ilandCommonUtils::fetchCurrencyTemplate( $propertyData, $templatePath, 
																			'chitietBDS' ,$tempalateName ); 
		$this->assignRef( 'tienHTML', $tienHTML );
		
		$gia_nguyen_can =  ilandCommonUtils::reFormatPrice($propertyData['gia_nguyen_can']);
		$gia_m2        =  ilandCommonUtils::reFormatPrice($propertyData['gia_m2']);
		/*
		$giam2 =  ilandCommonUtils::layGiaM2( array('dien_tich_su_dung'=>$propertyData['dien_tich_su_dung'],'gia'=>$propertyData['gia']) );
		$gia1 =  ilandCommonUtils::layGiaTien( array('don_vi_tien_id'=>$propertyData['don_vi_tien_id'], 
												'don_vi_dien_tich_id'=>$propertyData['don_vi_dien_tich_id'],
											 									'gia'=>$propertyData['gia']) );
		*/
		$this->assignRef( 'gia_nguyen_can', $gia_nguyen_can );
		$this->assignRef( 'gia_m2', $gia_m2 );
		//$this->assignRef( 'gia', ilandCommonUtils::reFormatPrice($gia1 ));
		// get all flag & fetch tien ich template
		$tienIchAllFlag = $u_reGlobalConfig['PROPERTY']['tien_ich_all_flag'];
		$tienIchTemplate = $u_reGlobalConfig['PROPERTY']['tien_ich_template'];
		$tienIchHTML = $propertyModel->fetchTienIchTemplate( $propertyData['tien_ich_id'], 
															 $templatePath, $tienIchTemplate,	
															 $tienIchAllFlag, $language );
		$this->assignRef( 'tienIchHTML', $tienIchHTML );
		
		// get map config
		$this->assignRef( 'mapZoom', $u_reGlobalConfig['MAP']['map_zoom'] ); 
		
		// get comment
		$commentHTML = ilandCommonUtils::getComment( $propertyData['id'], $propertyData['tieu_de'], 'bds' );
		$this->assignRef( 'commentHTML', $commentHTML );
		 /* thông tắt 2 mod 
		// get module tim kiem bat dong san
		$timKiemBDSHTML = ilandCommonUtils::getModuleTimKiemBDS( 'TÌM KIẾM BẤT ĐỘNG SẢN TRANG CHI TIẾT' );
		$this->assignRef( 'timKiemBDSHTML', $timKiemBDSHTML );
		
		// get quang cao*/
		$moduleChiase = 'CHIA SE';
		$quangCaoHTML = ilandCommonUtils::getChiaSe( $moduleChiase );
		$this->assignRef( 'chiase', $quangCaoHTML );
		
		
		$moduleQC = 'Banner Ad - Chi tiết tin';
		$QCHTML = $this->getModuleQC( $moduleQC );
		$this->assignRef( 'quangcao', $QCHTML );
		
	    // $propertyData['dien_tich_khuon_vien'] ='';
	    $this->assignRef( 'propertyData', $propertyData );	  
		
		$document=& JFactory::getDocument();
		
		$subject= $this->propertyData['tieu_de'];
		$nguoinhan = $this->propertyData['email_nguoi_lien_he'];
		$tennguoinhan = $this->propertyData['ten_nguoi_lien_he'];
		$lienhe=$this->getModule('mod_jdcontact', 'mod_jdcontact', 'raw', $subject,$nguoinhan,$tennguoinhan);
		$this->assignRef('lienhe',$lienhe);	
		
		// print_r( $u_reGlobalConfig['SEO']['mo_ta_trang_mac_dinh'] );
		if($this->escape($propertyData['tieu_de_trang'] ) == NULL)
		{
			if($propertyData['du_an']=='Vui lòng chọn') 
	        	$da= ''; 
	        else 
	        	$da=  $propertyData['du_an'];
			// $page_title = $propertyData['thong_tin_tong_quan'] ;
			$title = $propertyData['loai_giao_dich']." ".$propertyData['loai_bds']." ".$da.", ".$propertyData['quan_huyen'].", ".$propertyData['tinh_thanh'];
			$page_title =  $title;
		}
		else
		{
			$page_title = ucfirst($this->escape($propertyData['tieu_de_trang'] ));				
		}
		
		if($this->escape($propertyData['tu_khoa_trang']) == NULL)
		{
			$page_keywords = $u_reGlobalConfig['SEO']['tu_khoa_trang_mac_dinh'];
		}
		else
		{
			$page_keywords = ucfirst($this->escape($propertyData['tu_khoa_trang']));
		}
		$document->setMetaData('keywords', $page_keywords );
		
		if($this->escape($propertyData['mo_ta_trang']) == NULL)
		{
			$page_description = $u_reGlobalConfig['SEO']['mo_ta_trang_mac_dinh'];
		}
		else 
		{
			$page_description = ucfirst($this->escape($propertyData['mo_ta_trang']));
		}
		$document->setMetaData('description', $page_description);
		
		$mainframe =& JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		$pathway->addItem( $page_title );
		$document->setTitle( $page_title );
    
		parent::display();
	}
	function updateSaiPham($id)
    { 
		$param = " bao_cao_sai_pham = 1";   	
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id, $param, $this->getLanguage());
	}
	function getModule($modname,$modulhelper,$style,$subject,$nguoinhan,$tennguoinhan) {
        $mod = JModuleHelper::getModule($modulhelper, $modname);
        $attribs['style'] = $style;
        $attribs['subject'] = $subject;
        $attribs['nguoinhan'] = $nguoinhan;
        $attribs['tennguoinhan'] = $tennguoinhan;
        $dataHTML = JModuleHelper::renderModule($mod, $attribs);
        return $dataHTML;
    }
	function getModuleQC( $moduleTitle )
	{
		$modSearch = JModuleHelper::getModule('quangcao', $moduleTitle); 
		
		$modSearch->title = 'Banner Ad - Chi tiết tin';
		$modSearch->showtitle = 0;
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modSearch, $attribs );
		
		return $dataHTML;
	}
    
	function displayPropertiesByCode($ma_so){
		$propertyModel = new U_ReModelProperties();
		$language = ilandCommonUtils::getLanguage();
		$propertyId = $propertyModel->layBDSId( $ma_so, $language );
		$this->displayPropertyDetail($propertyId);
	}
	
	/*
	* Description: Lấy chuỗi thông tin diện tích khuôn viên 
	* Author: Minh Chau
	* Version: 
	* Date create: 22-03-2011
	* @return: Chuỗi có định dạng: <$width>m X <?length>m
	*  			Nếu width hoặc length bằng 0 => _
	*/
	function getAreaInfoString( $width, $length )
	{
		if( empty( $width ) || empty( $length ) )
		{
			return '_';
		}
        else 
        {
        	return $length . 'm X '. $width . 'm';
        }
	}
	
	/*
	* Description: Lấy chuỗi thông tin tổng diện tích sử dụng 
	* Author: Minh Chau
	* Version: 
	* Date create: 22-03-2011
	* @return: Chuỗi có định dạng: <$width>m X <?length>m
	*/
	function getLivingSpaceString( $livingSpace )
	{
		if( empty( $livingSpace ) )
		{
			return '_';
		}
		else
		{
			return $livingSpace . 'm<sup>2</sup>';
		}
	}
	
	function getDeleteImage( $id )
	{		
		ilandCommonUtils::delete_img( $id );		
	}
	
	function compareProperty( $ids )
	{
		$maxIndex = count( $ids ) - 1;
		$where = ' id IN (';
		
		for ( $i = 0; $i < $maxIndex; $i++ )
		{
			$where .= $ids[$maxIndex] . ',';
		}
		$where .= $ids[$maxIndex];
		$where .= ')';
		
		global $u_reGlobalConfig;
		
		$returnField = $u_reGlobalConfig['PROPERTY']['du_lieu_so_sanh_bat_dong_san'];

		$listData = U_ReModelProperties::getListProperties( $returnField, $where, 1, 
																			'', $maxIndex + 1 );

		// load template
		$templateName = JFactory::getApplication()->getTemplate();
		$templatePath = JPATH_THEMES . DS . $templateName . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
		$this->addTemplatePath( $templatePath );
		
		$this->setLayout( $u_reGlobalConfig['PROPERTY']['compare_template'] );
		
		$this->assignRef( 'data', $listData );
		parent::display();
	}
}
?>