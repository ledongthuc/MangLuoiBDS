<?php

/**
 * View projects of COM_U_RE
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once JPATH_COMPONENT.DS.'view.php';
require_once COM_U_RE_UTILS;
require_once COM_U_RE_LIBRARIES_MODEL_PROJECT;
require_once COM_U_RE_COMMON_UTILS;
class U_ReViewProjects extends U_ReView
{
	function display( $tpl = null )
	{
		parent::display($tpl);
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
		// $searchParams = $_SESSION['projectSearch'];
		$conditionParamStr = ' hien_thi_ra_ngoai = 1 ';
		
		if( !empty( $_GET['key_search'] ) )
		{
			$conditionParamStr .= " AND ten LIKE '%" . $_GET['key_search'] . "%' ";
		}
		
		if( !empty( $_GET['loai_du_an_id'] ) )
		{
			$conditionParamStr .= " AND loai_du_an_id = '" . $_GET['loai_du_an_id'] . "'";
		}
		
		if( !empty( $_GET['tinh_thanh_id'] ) )
		{
			$conditionParamStr .= " AND tinh_thanh_id = '" . $_GET['tinh_thanh_id'] . "'";
		}
		
		$this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		global $u_reGlobalConfig;
		
		// get return field
		$returnField = $u_reGlobalConfig['PROJECT']['project_list_return_field'];
		
		$limit = $u_reGlobalConfig['PROJECT']['list_limit'];
		
		if (  JFactory::getURI()->getVar('limit') )
		{
			$limit = JFactory::getURI()->getVar('limit');
		}
		$orderby = $u_reGlobalConfig['PROJECT']['orderby'];
		// get current page & limit
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
		$showPageTitle = $this->params->get('show_page_title', 0);
		$this->assignRef('showPageTitle' , $showPageTitle );
		
		$pageTitle = $this->params->get('page_title', '');
		$this->assignRef('pageTitle' , $pageTitle );
		
		$projectModel = new U_ReModelProjects();
		$projectList = $projectModel->getListProjects( $returnField, $conditionParamStr,
														   $page, $limit, $orderby);
														   
		//$projectList['rows'][3]= ilandCommonUtils::boSungThongTinDuAn($projectList['rows'][3]);
		if($u_reGlobalConfig['COMMON']['luot_xem_ds_du_an']==1)
		{
			$hien_thi = 1;
		}
		else
		{
			$hien_thi = 0;
		}
		$this->assignRef( 'hien_thi_luot_xem', $hien_thi );
														   
		// get template
		$templateName = JFactory::getApplication()->getTemplate();
		$this->addTemplatePath( JPATH_THEMES . DS . $templateName . DS . "html" . DS . "com_u_re"
										. DS . "projects" );
		$this->setLayout( $u_reGlobalConfig['PROJECT']['list_template'] );
		
		// get  paging
		$paging = ilandCommonUtils::getPage( $projectList['rows'][0], $limit);
	    $this->assignRef( 'paging', $paging );
	    
		jimport('joomla.html.pagination');
		$this->pagination = new JPagination( $projectList['rows'][0] , $limitstart, $limit );
		
		// assign
		$this->assignRef('rows' , $projectList['rows'][3] );
		
		parent::display();
	}
	
	function genConditionParam( $params )
	{
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
	function displayProjectDetail( $id )
	{
		 $this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		 $this->assignRef('SiteDBConfig' , ilandCommonUtils::getSiteDBConfig() );
		 
		// global config
		global $u_reGlobalConfig;
		
		// get data
		$projectModel = new U_ReModelProjects();
		$projectData = $projectModel->getProjectById( $id, $this->lang,  $this->SiteDBConfig);
		// get template
		//$templateName = JFactory::getApplication()->getTemplate();		
		//$templatePath = JPATH_THEMES . DS . $templateName . DS . "html" . DS . "com_u_re". DS . "projects";
		echo "<pre>";
		print_r($projectData);
		echo "</pre>";
		exit();
		ilandCommonUtils::themLuotXemDuAn($id);
		
		$projectData['luot_xem'] = ilandCommonUtils::demLuotXemDuAn($id);
		$hien_thi_luot_xem = 0;
		if($u_reGlobalConfig['COMMON']['luot_xem_bds'] == 1 )
		{
			$hien_thi_luot_xem = 1 ;
		}
		else
		{
			$hien_thi_luot_xem = 0 ;
		}
		$this->assign( 'hien_thi_luot_xem', $hien_thi_luot_xem );
		$templatePath= "templates/".$u_reGlobalConfig['DB']['template']."/html/com_u_re/projects/"; 
		
		$this->addTemplatePath( $templatePath );
		// hardcode template name
		$this->setLayout( $u_reGlobalConfig['PROJECT']['detail_template'] );
		// assign template
		// status 0 => trang chi tiet bat dong san
		$this->assign( 'status', 0 );
		$this->assign( 'googlemapDisplay', $u_reGlobalConfig['MAP']['property_map_function_on'] );
		$this->assign( 'googlemapEnable', $u_reGlobalConfig['MAP']['property_map_function_enable'] );
		
		// hien thi cho chinh
		$mainImage = ilandCommonUtils::getProjectMainImage( $id );
		// hien thi cho trinh dien anh
		$subImages = ilandCommonUtils::getProjectSubImages( $id );
	    
		$imageData = array();
		$imageData['mainImage'] = $mainImage;
		$imageData['subImages'] = $subImages;
		$imageData['status'] = 0; // chi tiet bds front end
		$imageData['title'] = $projectData['ten'];
		$imageTemplateName = 'image_block';
		
	    $imageBlockHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath, 
	    																$imageTemplateName, 
	    																$imageData );
	    																
	    $this->assignRef( 'imageBlockHTML', $imageBlockHTML );
		
	    // get comment
		$commentHTML = ilandCommonUtils::getComment( $id, 'duan' );
		$this->assignRef( 'commentHTML', $commentHTML );
	    
	    $this->status =0;
	    
		/*
		 * Get same properties
		 *  - Get id
		 *  - Get current page
		 */
	    
		// mặc định là trang 1
		$currentPage = 1;

		$this->assignRef( 'row', $projectData );
						
		$document=& JFactory::getDocument();
			
		if( $this->escape($projectData['tieu_de_trang'] ) == NULL 
			|| trim( $projectData['tieu_de_trang'] ) == '' )
		{
			$page_title =  ucfirst( JText::sprintf(			
						$projectData['ten'].', '.$this->escape($projectData['dia_chi'])));
		}
		else
		{
			$page_title = ucfirst($this->escape($projectData['tieu_de_trang'] ));				
		}
		
		if( $this->escape($projectData['tu_khoa_trang']) == NULL 
			|| trim( $projectData['tu_khoa_trang'] ) == '' )
		{
			$page_keywords = $u_reGlobalConfig['SEO']['tu_khoa_trang_mac_dinh'];
		}
		else
		{
			$page_keywords = ucfirst($this->escape($projectData['tu_khoa_trang']));
		}
		$document->setMetaData('keywords', $page_keywords );
		
		if( $this->escape($projectData['mo_ta_trang']) == NULL 
			|| trim( $projectData['mo_ta_trang'] ) == '' )
		{
			$page_description = $u_reGlobalConfig['SEO']['mo_ta_trang_mac_dinh'];
		}
		else 
		{
			$page_description = ucfirst($this->escape($projectData['mo_ta_trang']));
		}
		$document->setMetaData('description', $page_description);
		
		$mainframe =& JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		$pathway->addItem( $page_title );
		$document->setTitle( $page_title );
	    
		$this->layDuAnLienQuan( $id );
		parent::display();
	}
	
	function layDuAnLienQuan( $projectId )
	{
		global $u_reGlobalConfig;
		// get return field
		$returnField = $u_reGlobalConfig['SAMEINVESTOR']['project_list_return_field'];
		
		$limit = $u_reGlobalConfig['SAMEINVESTOR']['list_limit'];
		
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
		if (  JFactory::getURI()->getVar('limit') )
		{
			$limit = JFactory::getURI()->getVar('limit');
		}
		$orderby = $u_reGlobalConfig['SAMEINVESTOR']['orderby'];
		$this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		$projectModel = new U_ReModelProjects();
		$rows = $projectModel->layDuAnLienQuan($returnField, $projectId, $page, $limit,  $orderby, $this->lang);
		$this->assignRef('duanlienquan' , $rows[3] );
		
	}
	
	function datCho( $id )
	{
		$this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		$this->assignRef('SiteDBConfig' , ilandCommonUtils::getSiteDBConfig() );
		// global config
		global $u_reGlobalConfig;
		
		// get data
		$projectModel = new U_ReModelProjects();
		$projectData = $projectModel->getProjectById( $id, $this->lang,  $this->SiteDBConfig);
		
		// hardcode 
		// TODO: viet ham lay dong itemid
		$Itemid = '193';
		$linkChiTiet = 'index.php?option=com_u_re&controller=projects&Itemid=' . $Itemid . 
							'&id=' . $projectData['id'];
		
		$templatePath= "templates/".$u_reGlobalConfig['DB']['template']."/html/com_u_re/projects/"; 
		$this->addTemplatePath( $templatePath );

		// hardcode template name
		$this->setLayout( 'dat_cho' );		
		
		// assign
		$this->assignRef( 'idDuAn', $projectData['id'] );
		$this->assignRef( 'tenDuAn', $projectData['ten'] );
		$this->assignRef( 'linkChiTiet', $linkChiTiet );		
		
		// display template
		parent::display();
	}
	
	function luuThongTinDatCho( $id )
	{
		$this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		$this->assignRef('SiteDBConfig' , ilandCommonUtils::getSiteDBConfig() );
		// global config
		global $u_reGlobalConfig;
		
		// get data from post
		$data = array();
		$data['du_an_id'] = $id;
		$data['ten_du_an'] = $_POST['ten_du_an'];
		$data['ho_ten'] = $_POST['ho_ten'];
		$data['dia_chi'] = $_POST['dia_chi'];
		$data['dien_thoai'] = $_POST['dien_thoai'];
		$data['email'] = $_POST['email'];
		$yeuCauArr = $_POST['yeu_cau'];
		$data['yeu_cau'] = implode( ". ", $yeuCauArr );
		$data['ngay_gui'] = ''.time();
		$data['dat_cho'] = '1';
		$data['giao_dich_thanh_cong'] = '0';
		
		// luu data
		$projectModel = new U_ReModelProjects();
		$result = $projectModel->luuThongTinDatChoDuAn( $data );
		
		// chuyen sang trang thong bao luu thanh cong
		$templatePath= "templates/".$u_reGlobalConfig['DB']['template']."/html/com_u_re/projects/"; 
		
		$this->addTemplatePath( $templatePath );
		// hardcode template name
		$this->setLayout( 'dat_cho_thanh_cong' );		
		
		$linkData = array();
		$linkData['linkTrangChu'] = 'index.php';
		$linkData['linkListDuAn'] = 'index.php?option=com_u_re&controller=projects&Itemid=24';
		$linkData['linkChiTietDuAn'] = $_POST['link_chi_tiet'];
		
		// assign
		$this->assignRef( 'idDuAn', $id );
		$this->assignRef( 'tenDuAn', $data['ten_du_an'] );		
		$this->assignRef( 'linkData', $linkData );
		
		// display template
		parent::display();
	}
	
	function dangKyMail( $email )
	{
		$this->assignRef('lang' , ilandCommonUtils::getLanguage() );
		$this->assignRef('SiteDBConfig' , ilandCommonUtils::getSiteDBConfig() );
		// global config
		global $u_reGlobalConfig;
		
		// get data from post
		$data = array();
		$data['du_an_id'] = '-1';
		$data['ten_du_an'] = '';
		$data['ho_ten'] = '';
		$data['dia_chi'] = '';
		$data['dien_thoai'] = '';
		$data['email'] = $email;
		$data['yeu_cau'] = 'Nhận tin mới qua mail';
		$data['ngay_gui'] = ''.time();
		$data['dat_cho'] = '0';
		$data['giao_dich_thanh_cong'] = '0';
		
		// luu data
		$projectModel = new U_ReModelProjects();
		$result = $projectModel->luuThongTinDatChoDuAn( $data );
		
		// chuyen sang trang thong bao luu thanh cong
		$templatePath= "templates/".$u_reGlobalConfig['DB']['template']."/html/com_u_re/projects/"; 
		
		$this->addTemplatePath( $templatePath );
		// hardcode template name
		$this->setLayout( 'dang_ky_mail_thanh_cong' );		
		
		$linkData = array();
		$linkData['linkTrangChu'] = 'index.php';
		$linkData['linkListDuAn'] = 'index.php?option=com_u_re&controller=projects&Itemid=24';
		
		// assign
		$this->assignRef( 'linkData', $linkData );
		
		// display template
		parent::display();
	}
}
?>


