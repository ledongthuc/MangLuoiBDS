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

//require_once "../libraries/unisonlib/com_jea_lib.php";
require_once('../libraries/com_u_re/models/properties.php');
require_once('../libraries/com_u_re/php/common_utils.php');
require_once "components/com_jea/models/realtors.php";

class JeaViewProperties extends JView
{
	var $pagination = null ;
	var $user = null;
	
	function getSelectAdvantage($language)
	{
		$html = '';
		$rows = getAdvantageList($this->getSiteConfig(), $language);
		$advantages = array();
		if ( !empty( $this->row->advantages ) )
		{
            $advantages = explode( '-' , $this->row->advantages );
        }
		
        foreach ( $rows as $k=> $row )
		{
            $checked = '';
            if ( in_array($row[0], $advantages) )
			{
                $checked = 'checked="checked"' ;
            }
		
			$html .= '<label class="advantage">' . PHP_EOL
                  .'<input type="checkbox" id="advantages[' . $k . ']" name="advantagedValue" value="'
                  . $row[0] . '" ' . $checked . ' />' . PHP_EOL
                  . $row[1] . PHP_EOL
                  . '</label>' . PHP_EOL ;
			
        }
        return $html;
								  
	}

	function display( $tpl = null )
	{
		echo "vao toi list";
		exit;
		$tpl = null;
		parent::display($tpl);
	}
	
	function getEditSecondariesImage()
	{
	
		$Img = '';
		foreach($this->secondaries_images1 as $image1)
		{
			$Img .= "<div class='advantage_a'>";
			$Img .= "<fieldset style='margin-top:10px;'>";
			$Img .= "<img src='". $image1['min_url'] ."' alt='". $image1['name'] ."' title='". $image1['width'].'X'.$image1['height'].'px - '.$image1['weight'].' ko' ."' />";
			$Img .=	"<a href='". $image1['delete_url'] ."' >";
			$Img .= JText::_('Delete') ."</a></div>";
		}
		return $Img ;
	}
	
	
	function getEditMainImage()
	{
		if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row->id.DS.'min.jpg' ) )
		{
			$Img = '';
			$Img .= "<fieldset style='margin-top:10px;'>";
			$Img .= "<img src='". $this->main_image['min_url']."'  alt='preview.jpg' title='". $this->main_image['width'].'X'.$this->main_image['height'].'px - '.$this->main_image['weight'].' ko' ."' />";
			$Img .=" <a href='". $this->main_image['delete_url'] ."' >";
			$Img .= JText::_('Delete') . '</a>';
			$Img .= "</fieldset>";
			return $Img ;
		}
	}

	function listIems()
	{
		jimport( 'joomla.html.pagination' );
		JHTML::_('behavior.tooltip');
		
		$model = $this->getModel();
		$items = $this->get('items');		
		$this->assign( $items );
		$this->pagination = new JPagination($items['total'], $items['limitstart'], $items['limit']);

	    JToolBarHelper::title( JText::_( ucfirst( $this->get('category') ) . ' management' ), 'jea.png' );
	    JToolBarHelper::publish('setPublish');
	    JToolBarHelper::unpublish();
	    JToolBarHelper::addNew();
	    JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
	}

	function editItem()
	{
		global $u_reGlobalConfig;
		$backEndDetail = $u_reGlobalConfig['IFRAME']['backEndDetail'];
		if ( $backEndDetail == 1 )
		{
			// echo "<strong><a href='index.php?option=com_jea&controller=properties&task=add'>dang them </a></strong>";
		 	$templatePath = "../templates/mlbds/html/com_u_re/properties/";
		 	//$templatePath = "../templates/WebGH/html/com_u_re/properties/";
		    $this->addTemplatePath($templatePath);
			$this->setLayout('admin_detail');
		    parent::display();
		    return;
		}
		
		$templatePath = "../templates/mlbds/html/com_u_re/properties/";
		
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $idurl =JFactory::getURI()->getVar("id"))
		{
			$id = $idurl;
		}
		else
		{
			$id = $cid[0];
		}
	//	$id = 14;
		//echo "edit ";
		
		JRequest::setVar( 'hidemainmenu', 1 );

		//$item = & $this->get('item');
		// lay du lieu
		
		// khoi tao cac gia tri mac dinh
		$published = 1;
		$this->newsestChecked = '';
		$this->emphasisChecked = '';
		$this->daBanChecked = '';
		$phapLyId = 0;
		$huongId = 0;
		$loaiBDSId = 0;
		$loaiGiaoDichId = 0;
		$duanId = 0;
		$tinhThanhId = $u_reGlobalConfig['COMMON']['tinh_thanh_mac_dinh'];
		$quanHuyenId = $u_reGlobalConfig['COMMON']['quan_huyen_mac_dinh'];
		
		$donViTien = 1;
		$donViDienTich = 1;
		$viTriId = 0;
		$nhaMoiGioiId = 0;
		$tieuDeBDS = JText::_( 'New' );
		$this->mainImage ='';
		$this->secondariesImage ='';
		
		// add phuong xa, duong pho
		$phuongXaId = 0;
		$duongPhoId = 0;

		// TODO: remove hard code id 
		// $id = 174;
		
		$this->propertyData['loai_tin_id'] = '';	
		
		$this->propertyData['tieu_de_trang'] = '';	
		$this->propertyData['tu_khoa_trang'] = '';
		$this->propertyData['mo_ta_trang'] = '';
		$this->propertyData['tieu_de'] = '';
		$this->propertyData['ma_so'] = '';
		$this->propertyData['dia_chi'] = '';
		$this->propertyData['gia'] = '';
		$this->propertyData['dien_tich_khuon_vien_rong'] = '';
		$this->propertyData['dien_tich_khuon_vien'] = '';
		$this->propertyData['dien_tich_khuon_vien_dai'] = '';
		$this->propertyData['phuong_xa'] = '';
		
		$this->propertyData['alias'] = '';
		
		/* */
		
		$this->propertyData['loai_bds'] = '';	
		$this->propertyData['phap_ly'] = '';
		$this->propertyData['phong_ngu'] = '';
		$this->propertyData['phong_tam'] = '';
		$this->propertyData['phong_khac'] = '';
		
		//////
		$this->propertyData['dien_tich_su_dung'] = '';
		$this->propertyData['ghi_chu_nguoi_lien_he'] = '';
		$this->propertyData['mo_ta_chi_tiet'] = '';
		
		$this->propertyData['dien_tich_xay_dung_dai'] = '';
		$this->propertyData['dien_tich_xay_dung_rong'] = '';
		$this->propertyData['loai_bds_id'] = '';
		$this->propertyData['don_vi_tien'] = '';
		$this->propertyData['id'] = '';
		$this->propertyData['don_vi_tien_id'] = '';
		$propertyData['tien_ich_id'] = '';
		$propertyData['don_vi_dien_tich_id'] = '';
		$propertyData['phuong_xa'] = '';
		
		
		$this->propertyData['chinh_chu'] = '';
		$this->propertyData['speak_english'] = '';
		$this->propertyData['duong_pho'] = '';
		$this->propertyData['so_nha'] = '';
		$this->propertyData['phong_khach'] = '';
		
		$this->propertyData['ten_nguoi_lien_he'] = '';
		$this->propertyData['dia_chi_nguoi_lien_he'] = '';
		$this->propertyData['dien_thoai_nguoi_lien_he'] = '';

		$this->propertyDataen['tieu_de'] = '';
		$this->propertyDataen['dia_chi'] = '';
		$this->propertyDataen['mo_ta_chi_tiet'] = '';
		$this->propertyDataen['ten_nguoi_lien_he'] = '';
		$this->propertyDataen['dia_chi_nguoi_lien_he'] = '';
		$this->propertyDataen['ghi_chu_nguoi_lien_he'] = '';
		$this->propertyDataen['tieu_de_trang'] = '';
		$this->propertyDataen['tu_khoa_trang'] = '';
		$this->propertyDataen['mo_ta_trang'] = '';
		$this->propertyDataen['loai_bds'] = '';
		$this->propertyDataen['loai_giao_dich'] = '';
		$this->propertyDataen['phap_ly'] = '';
		$this->propertyDataen['don_en_dien_tich'] = '';
		$this->propertyDataen['don_en_tien'] = '';
		$this->propertyDataen['nha_moi_gioi_ten'] = '';
		$this->propertyDataen['tinh_thanh'] = '';
		$this->propertyDataen['quan_huyen'] = '';
		$this->propertyDataen['tien_ich'] = '';
		$this->propertyDataen['huong'] = '';
		$realtorId = '';
		$this->mainImage['isfile']='';
		
		$imageData = array();
		$mainImage = '';
		$subImages = '';
		$imageData['id'] = 0;
		$imageData['title'] = $this->propertyData['tieu_de'];
		$imageData['status'] = 2;
		$imageData['title'] = '';
		$imageTemplateName = 'image_block';

		if( $id )
		{
			$propertyData = U_reModelProperties::layChiTietBDS( $id, 'vi');
			$propertyDataen = U_reModelProperties::layChiTietBDS( $id, 'en');
			// print_r($propertyData);
			$this->assign( 'propertyData', $propertyData );
			
			$this->assign( 'propertyDataen', $propertyDataen );
			//print_r($this->propertyDataen);
			//exit;
			//get edit main image
    		//$this->assignRef( 'mainImage', ilandCommonUtils::getPropertyMainImage( $id ) );
			$mainImage = ilandCommonUtils::getPropertyMainImage( $id );
    		
			//get edit sub image
    		//$this->assignRef( 'secondariesImage', ilandCommonUtils::getPropertySubImages( $id ) );
    		$subImages = ilandCommonUtils::getPropertySubImages( $id );
    		
			$imageData['mainImage'] = $mainImage;
			$imageData['subImages'] = $subImages;
			$imageData['id'] = $propertyData['id'];
			 // chi tiet bds front end
			
		    $this->assignRef('imageBlockHTML' , $imageBlockHTML );
    		
			$published = $propertyData['hien_thi_ra_ngoai'];
			
			// $this->newsestChecked = "checked";
			
			if ($propertyData['moi_nhat'] == 1) 
			{
				$this->newsestChecked = "checked";	
			}
			
			if ($propertyData['noi_bat'] == 1)
			{
				$this->emphasisChecked = "checked";
			}
			
			if ( $propertyData['da_ban'] == 1 )
			{
				$this->daBanChecked = "checked";
			}
			
			$phapLyId = $propertyData['phap_ly_id'];
			$quanHuyenId = $propertyData['quan_huyen_id'];
			$tinhThanhId = $propertyData['tinh_thanh_id'];
			$huongId = $propertyData['huong_id'];
			$loaiGiaoDichId = $propertyData['loai_giao_dich_id'];
			$loaiBDSId = $propertyData['loai_bds_id'];
			//$viTriId = $propertyData['vi_tri_id'];
			$viTriId = 1;
			$nhaMoiGioiId = $propertyData['nha_moi_gioi_id'];
			$tieuDeBDS = $propertyData['tieu_de'];
										
			// add phuong xa, duong pho
			$phuongXaId = $propertyData['phuong_xa_id'];
			$duongPhoId = $propertyData['duong_pho_id'];
		}
		
			//		get price insert value
		$InsertPrice=$this->propertyData['gia'];
		//$InsertPrice=JeaViewProperties::getInsertPrice( $this->propertyData['gia'],$this->propertyData['don_vi_tien_id'], '1');
														
					//get price unit value
		$PriceUnit=JeaViewProperties::getInsertPrice($this->propertyData['gia'], 
												$this->propertyData['don_vi_tien_id']);			
		
   		$title = JeaViewProperties::getPageTitle( $this->get('category'), $tieuDeBDS );
	    
		$editor =& JFactory::getEditor();
		$this->assignRef('editor' , $editor );
		
		$user		= & JFactory::getUser();
		$usertype	= $user->get('usertype');
		$this->assignRef('usertype' , $usertype );
		
		//lay 2 ky tu cua ngon ngu hien tai
		//EX: Vi, En, Ja, Ch...
		
		$language =& JFactory::getLanguage();
		$lang = substr($language->getTag(),0,2);
		$this->assignRef('lang' , $lang );
			
		//get params values
		// TODO: get from global config
		
		$this->googlemapDisplay = $u_reGlobalConfig['MAP']['property_map_function_on']; 
		$this->googlemapEnable = $u_reGlobalConfig['MAP']['property_map_function_enable'];

		// lay list lua chon hien thi ra ngoai
		$publishedHTML = JHTML::_('select.booleanlist',  'hien_thi_ra_ngoai' , 'class="inputbox"' , $published  );
		$this->assignRef('published' , $publishedHTML );
		
		//  hien thi layout dang tin o backend
		$this->status = 2;
		
		$legal=ilandCommonUtils::getSelectBox('phap_ly','legal_status', JText::_('SELECT_LEGAL'),
													$phapLyId,
							"onchange=getonchangevalue('legal_status','divlegalstatus','',0)",
											'','','class=opt');
    	$this->assignRef('legalStatusList' , $legal );
		//get direction
		$directions=ilandCommonUtils::getSelectBox('huong','direction_id',
													JText::_('Directions'), $huongId,'','','','class=opt');
    	$this->assignRef('directions' , $directions );
		
    	//$propertyData['tien_ich_id'] = '-2-3-';
		$Advantage=ilandCommonUtils::getSelectAdvantage($lang, $propertyData['tien_ich_id']);
	   	$this->assignRef('Advantage' , $Advantage );
		
	   		//get realtor
	   //	$realtorId=1;	
		$realtorbds=ilandCommonUtils::getSelectBox('nha_moi_gioi','realtor_id',
													JText::_('realtor'), $realtorId,'','',"style='width:148px'");
    	$this->assignRef('realtor_bds' , $realtorbds );

    	$this->assignRef('InsertPrice' , $InsertPrice );

    	$this->assignRef('PriceUnit' , $PriceUnit );
	
		$this->assignRef('properties_key' , $propertyData['ma_so'] );

    	// don vi
		//$getDonVi =  JeaViewProperties::getDonVi();
		
		$price_area_unit =  ilandCommonUtils::getSelectBox('don_vi_dien_tich', 'price_area_unit','', $propertyData['don_vi_dien_tich_id']);
		$this->assignRef('Unit' , $price_area_unit );
	
		// towns
//		$areas =  ilandCommonUtils:: getSelectBox('quan_huyen', 'area_id', '',
//									$quanHuyenId,"", $tinhThanhId, "style='width:137px'");

		$areas =  ilandCommonUtils:: getSelectBox('quan_huyen', 'area_id', '',
									$quanHuyenId,'layDanhSachDuAn(this.value,"vi","' . JURI::root() . '")', 
									$tinhThanhId, "style='width:160px'");
		
	    $this->assignRef('areas' , $areas );
	    
	    $baseurl = $u_reGlobalConfig['COMMON']['root'];
		
		// towns
		$towns =  ilandCommonUtils::getSelectBox('tinh_thanh', 'town_id','',
												$tinhThanhId, 'layseachquanhuyen("area_id",this.value,"vi-VN","'.$baseurl.'","area_id")','',
												"style='width:160px'");
	    $this->assignRef('towns' , $towns );
		
	    // add phuong xa, duong pho
	    $phuongXaListHTML = ilandCommonUtils:: getSelectBox('phuong_xa', 'phuong_xa_id', 'Vui lòng chọn',
									$phuongXaId,"", $quanHuyenId, "style='width:160px'");
		$this->assignRef( 'phuongXaListHTML', $phuongXaListHTML );
		
		$duongPhoListHTML = ilandCommonUtils:: getSelectBox('duong_pho', 'duong_pho_id', 'Vui lòng chọn',
									$duongPhoId,"", $quanHuyenId, "style='width:160px'");
		$this->assignRef( 'duongPhoListHTML', $duongPhoListHTML );
		
		$duAnHTML = ilandCommonUtils::getSelectBox('du_an', 'du_an_id','Vui lòng chọn',$duanId,'',$quanHuyenId,"style='width: 200px;padding: 2px;border: 1px solid #96A6C5;'");
		$this->assignRef( 'duAnHTML', $duAnHTML );
	    
		$onchangedonvidientich = 'onchange=' . '"layDanhSachDienTich(' . "'price_area_unit',this.value,'vi-VN','".$baseurl."','price_area_unit')" . '"';
		$kinds =  ilandCommonUtils::getSelectBox('loai_giao_dich','kind_id', '',
													$loaiGiaoDichId, $onchangedonvidientich, '', '','class=opt');
	    $this->assignRef('kinds' , $kinds );
		
		$types =  ilandCommonUtils::getSelectBox('loai_bds','type_id','',
													$loaiBDSId, 'onchange=getonchangevalue(\'type_id\',\'divtype\',\'\',0)','','','class=opt');
	    $this->assignRef('types' , $types );
	   // print_r($this->types);
	
		// lay position
		$position =  ilandCommonUtils::getSelectBox('vi_tri','position', '', $viTriId);
	    $this->assignRef('position' , $position );
		
		if ( empty( $this->propertyData['ten_nguoi_lien_he'] ) && 
			 empty( $this->propertyData['dien_thoai_nguoi_lien_he'] ) && 
			 empty( $this->propertyData['dia_chi_nguoi_lien_he'] ) )
		{
			// Chau add: get realtor info
			/*
			$realtor = $this->getRealtorById($nhaMoiGioiId);
			$this->propertyData['ten_nguoi_lien_he'] = $realtor->name;
			$this->propertyData['dien_thoai_nguoi_lien_he'] = $realtor->phone;
			$this->propertyData['dia_chi_nguoi_lien_he'] = $realtor->address;
			$row->realtor_link = array('profile' => $realtor->link['profile'],
									   'listing' => $realtor->link['listing']);
			*/
		
				if($nhaMoiGioiId >0)
				{
					$row->realtor_avatar = $realtor->image['image']['name'];
				}
		}
		
		//$templatePath = "../templates/WebGH/html/com_u_re/properties/";
		//$templatePath = "../templates/WebVHL/html/com_u_re/properties/";
		
		$tienIchTemplate = $u_reGlobalConfig['PROPERTY']['admin_tien_ich_template'];
		
    	$tienIchHTML = U_ReModelProperties::fetchTienIchTemplate( $propertyData['tien_ich_id'], 
    																$templatePath, 
    																$tienIchTemplate, 
    																true , $lang );
	   	$this->assignRef('tienIchHTML' , $tienIchHTML );
	   	
	   	// image block
		$imageData['mainImage'] = $mainImage;
		$imageData['subImages'] = $subImages;
		
	    $imageBlockHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath, 
	    																$imageTemplateName, 
	    																$imageData );
	    $this->assignRef('imageBlockHTML' , $imageBlockHTML );
	   	
		$this->addTemplatePath($templatePath);
		// $this->setLayout('admin_detail');
		$this->setLayout('detail');
		
	    JToolBarHelper::title( $title , 'jea.png' ) ;
	    
	   parent::display();
	   
	}

	/*
	* Description: lấy tiêu đề trang 
	* Author: Minh Chau
	* Version: 
	* Date create: 11-04-2011
	*/
	function getPageTitle( $transactionTypeName, $propertyTitle )
	{
		$result = '';
		if ($propertyTitle)
		{
			$result .= JText::_('EDIT');
		}
		else
		{
			$result .= JText::_('NEW');
		}
		
		if($transactionTypeName == 'renting')
	    {
	    	$title .= JText::_( 'RENTING' );
	    }
	    else if($transactionTypeName == 'selling')
	    {
	    	$title .= JText::_( 'SELLING' );
	    }
	    if($transactionTypeName == 'needrenting')
	    {
	    	$title .= JText::_( 'NEEDRENTING' );
	    }
	    if($transactionTypeName == 'needbuying')
	    {
	    	$title = JText::_( 'NEEDBUYING' );
	    }
	    
	    $result .= ' : ' . $propertyTitle;
	    
	    return $result;
	}
	
	/*
	 * Chau:
	 * Get realtor of property
	 */
	function getRealtorById( $id )
	{
		$realtorModel = new JeaModelRealtors();
		
		$realtorData = $realtorModel->getRowById( $id );
		$realtorData->link = $this->getRealtorLink( $id );
		
		return $realtorData;
	}
	
	/*
	 * Chau:
	 * Get realtor link of property
	 */
	function getRealtorLink( $id )
	{
		$link = array();
		$link['profile'] = 'index.php?option=com_jea&controller=realtors&id=' . $id;
		$link['listing'] = 'index.php?option=com_jea&controller=properties&task=search&realtor_id=' . $id;
		return $link;
	}
	
	/* hoan them lay thong tin nha môi giới */
	function getRealtors($title,$checked)
	{
	
			$sql = "SELECT `id` AS value ,`name` AS text FROM #__jea_realtors ORDER BY ordering" ;
			$db = & JFactory::getDBO();
			$db->setQuery($sql);
			$rows = $db->loadObjectList();
			if ( $db->getErrorNum() ) {
				JError::raiseWarning( 200, $db->getErrorMsg() );
			}
			array_unshift($rows, JHTML::_('select.option', '0',$title));
			 return JHTML::_('select.genericlist',
			 				 $rows ,
			 				 'realtor',
			 				 'class="inputbox" size="1" style="width:150px"' ,
			 				 'value',
			 				 'text',
			 				 $checked);
	
	}
	/* end lay thong tin nha môi giới */
	    
	function getHtmlList_Area($tableName, $default=0, $grid=false, $idTown)
	{
		
		if ( !$idTown )
		{
			return '<select name="area_id" style="width: 150px;">
						<option value="0">--Quận/Huyện--</option>
					</select>';
		}

		static $lists = null;
		
	    if (!is_array($lists)) {
		
			$t_department    = '- ' . JText::_( 'Department' ).' -' ;
		    $t_condition     = '- ' . JText::_( 'Condition' ).' -' ;
		    $t_area          = '- ' . JText::_( 'Area' ).' -' ;
		    $t_slogan        = '- ' . JText::_( 'Slogan' ).' -' ;
		    $t_town          = '- ' . JText::_( 'Town' ).' -' ;
		    $t_property_type = '- ' . JText::_( 'Property type' ).' -' ;
		    $t_heating_type  = '- ' . JText::_( 'Heating type' ).' -' ;
		    $t_hotwater_type = '- ' . JText::_( 'Hot water type' ).' -' ;
		    
		    $lists = array( 'departments' => array( $t_department , 'department_id'),
		                    'conditions' => array( $t_condition , 'condition_id' ),
		                    'areas' => array( $t_area , 'area_id' ),
		                    'slogans' => array( $t_slogan , 'slogan_id' ),
		                    'towns' => array( $t_town , 'town_id' ),
		                    'types' => array( $t_property_type , 'type_id' ),
		                    'heatingtypes' => array( $t_heating_type , 'heating_type' ),
		                    'hotwatertypes' => array( $t_hotwater_type , 'hot_water_type' ),
		                  );
		}
	    
		if ( isset($lists[$tableName]) ) {
			
			$onChange = $grid ? 'onchange="document.adminForm.submit();"' : '' ;
			$featuresModel =& $this->getModel('features');
	    	$featuresModel->setTableName( $tableName );
	    	$rows=$featuresModel->getAreaByTown($idTown);
	    	
	    	return  JHTML::_('select.genericlist',
	    	                 $rows,
	    	                'area_id',
	    	                'class="inputbox" style="width:150px" size="1" '.$onChange ,
	    	                'value',
	    	                'text',
	    	                $default );
		}
		
		return 'list Error';
	}
	
	function getListUser($idCurrent)
	{
		$sql ='SELECT id,username FROM #__users';
		$db=JFactory::getDBO();
		$db->setQuery($sql);
		$rows=$db->loadObjectList();
		
		echo "<select name=created_by onchange=\"document.adminForm.submit();\"><option value=-1>Người đăng</option>";
		foreach($rows as $row){
			$selected=($row->id==$idCurrent)?'selected=selected':'';
		echo "<option value=$row->id $selected>$row->username</option>";}
		echo"</select>";
	}
	
	function getHtmlList($tableName, $default=1,$grid=false,$isTown=false,$parentChild=false,$idInner='' )
    {
        static $lists = null;
        
        if (!is_array($lists)) {
        
            $t_department    = '- ' . JText::_( 'Department' ).' -' ;
            $t_condition     = '- ' . JText::_( 'Condition' ).' -' ;
            $t_area          = '- ' . JText::_( 'Area' ).' -' ;
            $t_slogan        = '- ' . JText::_( 'Slogan' ).' -' ;
            $t_town          = '- ' . JText::_( 'Town' ).' -' ;
			$t_direction     = '- ' . JText::_( 'Direction' ).' -' ;
            $t_property_type = '- ' . JText::_( 'Property type' ).' -' ;
            $t_heating_type  = '- ' . JText::_( 'Heating type' ).' -' ;
            $t_hotwater_type = '- ' . JText::_( 'Hot water type' ).' -' ;
            $t_kinds = '- ' . JText::_( 'Chongiatri' ).' -' ;
			$t_planchilds          = '- ' . JText::_( 'Plan Childs' ).' -' ;
			$t_plans          = '- ' . JText::_( 'Plans' ).' -' ;
            $lists = array( 'departments' => array( $t_department , 'department_id'),
                            'conditions' => array( $t_condition , 'condition_id' ),
                            'areas' => array( $t_area , 'area_id' ),
                            'slogans' => array( $t_slogan , 'slogan_id' ),
                            'towns' => array( $t_town , 'town_id' ),
							'directions' => array( $t_direction , 'direction_id' ),
                            'types' => array( $t_property_type , 'type_id' ),
                            'heatingtypes' => array( $t_heating_type , 'heating_type' ),
                            'hotwatertypes' => array( $t_hotwater_type , 'hot_water_type' ),
                            'kinds' => array( $t_kinds , 'kind_id' ),
							'planchilds' => array( $t_planchilds , 'plan_id' ),
							'plans' => array( $t_planchilds , 'plan_parent_id' ),
                          );
        }
        
        if ( isset($lists[$tableName]) ) {
			if($grid)
			{
				if($tableName=='types')
					//$onChange =	'onchange="jea_types_filter(this.value);"';
					$onChange =	'onchange="jea_types_filter(this.value); onchange=getonchangvalue(\'type_id\',\'divtype\',\'\',0)"';
					//$onChange =	'onchange="document.adminForm.submit();"';
				else
					$onChange =	'onchange="document.adminForm.submit();"';
			}
			else
				$onChange =	'';
			if($parentChild)
			{
					if($tableName == 'towns')
					$onChange = 'onchange="jea_change_form_towns(this.value,\''.$idInner.'\',\''.$default.'\');"' ;
					if($tableName == 'plans')
					$onChange = 'onchange="jea_change_form_plans(this.value,\''.$idInner.'\',\''.$default.'\');"' ;
					
			}
            $featuresModel = new JeaModelFeatures();
            $featuresModel->setTableName( $tableName );
            
            return JHTML::_('select.genericlist',
                            $featuresModel->getListForHtml($lists[$tableName][0]) ,
                            $lists[$tableName][1],
                            'class="inputbox" size="1" style="width:100px" '.$onChange ,
                            'value',
                            'text',
                            $default );
                          
		
        }
        
        return 'list Error';
    }
	


	function getHtmlList_Form($tableName,$default=0, $idInner,$grid=false )
	{
	    static $lists = null;
	    
	    if (!is_array($lists)) {
		
			$t_department    = '- ' . JText::_( 'Department' ).' -' ;
		    $t_condition     = '- ' . JText::_( 'Condition' ).' -' ;
		    $t_area          = '- ' . JText::_( 'Area' ).' -' ;
		    $t_slogan        = '- ' . JText::_( 'Slogan' ).' -' ;
		    $t_town          = '- ' . JText::_( 'Town' ).' -' ;
			$t_direction          = '- ' . JText::_( 'Direction' ).' -' ;
		    $t_property_type = '- ' . JText::_( 'Property type' ).' -' ;
		    $t_heating_type  = '- ' . JText::_( 'Heating type' ).' -' ;
		    $t_hotwater_type = '- ' . JText::_( 'Hot water type' ).' -' ;
		    
		    $lists = array( 'departments' => array( $t_department , 'department_id'),
		                    'conditions' => array( $t_condition , 'condition_id' ),
		                    'areas' => array( $t_area , 'area_id' ),
		                    'slogans' => array( $t_slogan , 'slogan_id' ),
		                    'towns' => array( $t_town , 'town_id' ),
							'directions' => array( $t_direction , 'direction_id' ),
		                    'types' => array( $t_property_type , 'type_id' ),
		                    'heatingtypes' => array( $t_heating_type , 'heating_type' ),
		                    'hotwatertypes' => array( $t_hotwater_type , 'hot_water_type' ),
		                  );
		}
	    
		if ( isset($lists[$tableName]) ) {
			
			$onChange = $grid ? 'onchange="jea_change_form(this.value,"'.$tableName.'");"' : '' ;
			$featuresModel =& $this->getModel('features');
	    	$featuresModel->setTableName( $tableName );
	    	
	    	return JHTML::_('select.genericlist',
	    	                $featuresModel->getListForHtml($lists[$tableName][0]) ,
	    	                $lists[$tableName][1],
	    	                'class="inputbox" size="1" onchange="jea_change_form(this.value,\''.$tableName.'\',\''.$idInner.'\');"',
	    	                'value',
	    	                'text',
	    	                $default );
		}
		
		return 'list Error';
	}
	
	function getInsertPrice( $price, $priceUnit, $isprice = NULL )
		{
			$tientien = $price;
			$selected1="";
			$selected2="";
			$selected3="";
			$selectedti="";
			$selectedtr="";
			if($selected1==1){
				$selected1="selected";
			}else{
				if($priceUnit == 2){
					$selected2="selected";
				}else if($priceUnit==3){
					$selected3="selected";
				}
			}
			
             if($tientien/1000000000 >=1)
             {
             	$PriceChange = $tientien/1000000000;
             	$selectedti="selected";
             }
             else if($tientien/1000000 >=1)
             {
             	$PriceChange = $tientien/1000000;
             	$selectedtr="selected";
             }
             else
             {
             	$PriceChange = $tientien;
             	$selected="selected";
             
             }

             if( $isprice == 1)
             {
              return $PriceChange;
             }
		  	$pricevalue = "<select  id=\"price_unit\" name=\"price_unit\" style=\"width:50px\">";
		  	$pricevalue .=   "<option $selected1 value=\"1\">VND</option>";
			$pricevalue .=   "<option $selectedtr value=\"8\">triệu</option>";
			$pricevalue .=   "<option $selectedti value=\"7\">tỷ</option>";
		  	$pricevalue .=   "<option $selected2 value=\"2\">USD</option>";
		 	$pricevalue .=   "<option $selected3 value=\"3\">SJC</option>";
		    $pricevalue .= "</select>";
		    return $pricevalue;
		    
		}

		function getDonVi()
			{
				$value = '';
				$value .=  "<select name=\"price_area_unit\" style=\"width:95px\">";
				   $db =& JFactory::getDBO();
				$query  = "SELECT * FROM #__jea_price_area_units ORDER BY ordering";
				$db->setQuery($query);
				$result = $db->loadObjectList();
			
				foreach ($result as $row)
				{
					$selected="";
				    if($this->row->price_area_unit==$row->id)
				    {
				    	$selected="selected";
				    }
					$value .=   "<option  $selected value='$row->id'>".$row->value."</option>";
					
				}
			
			    $value .=  "</select>";
			    return $value;
			}
			/* hoan them combobox vi trí */

	
		function getViTri($table,$title,$checked, $idtab)
		    {
//		$table = '';
				$sql = "SELECT `id` AS value ,`value` AS text FROM #__$table ORDER BY ordering" ;
				$db = & JFactory::getDBO();
				$db->setQuery($sql);
				$rows = $db->loadObjectList();
				if ( $db->getErrorNum() ) {
					JError::raiseWarning( 200, $db->getErrorMsg() );
				}
				array_unshift($rows, JHTML::_('select.option', '0',$title));
				 return JHTML::_('select.genericlist', $rows , $idtab, 'class="inputboxd"  size="1" style="width: 90px" ' , 'value', 'text',$checked);
		
		    }

 
	/* hoan thêm loại tin rao */
    function getRadioList()
    {
    	$html = '';
        $featuresModel = new JeaModelFeatures();
        $featuresModel->setTableName( 'kinds' );
        $res = $featuresModel->getItems(true);
      	foreach ( $res['rows'] as $k=> $row )
       	{
            $checked ="";
		    $loai=JFactory::getURI()->getVar("cat");
		    switch($loai)
			{
				case "selling" : $kinks=1;
				break;
				case "renting" : $kinks=2;
				break;
				case "needbuying" : $kinks=3;
				break;
				case "needrenting" : $kinks=4;
				break;
				default: $kinks=1;
				break;
			}
		
            if($row->id ==$kinks)
            {
            	$checked= 'checked' ;
            }
		           
	        $html 	.= '<label class="radio_dangtin">' . PHP_EOL
	  				.'<input type="radio" name="kind_id" value="'
					. $row->id . '" '.$checked.'>' . PHP_EOL .
	  				$row->value . PHP_EOL . '</label>' . PHP_EOL ;
       	}
						
        return $html;
    }
	    
	/* hoan them tình trạng pháp lý */
	function getLegal_StatusCheckBoxList($title, $checked, $onchange=NULL)//dang combobox
    {
		$sql = "SELECT `id` AS value ,`value` AS text FROM #__jea_legal_status ORDER BY ordering" ;
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
		array_unshift($rows, JHTML::_('select.option', '0',$title));
		 return JHTML::_('select.genericlist', $rows , 'legal_status', 'class="inputbox"
		 								style="width:150px" size="1" '. $onchange, 'value', 'text',$checked);
    }
    
	function getLegalStatusRadioList()//dang checkbox
	{
	    $html = '';
	    
	    $featuresModel =& $this->getModel('features');
	    $featuresModel->setTableName( 'legal_status' );
	    $res = $featuresModel->getItems(true);
	    
	    $legal_status = array();
	    
	    if ( !empty( $this->row->legal_status ) ) {
	        $legal_status = explode( '-' , $this->row->legal_status );
	    }
	    
	    foreach ( $res['rows'] as $k=> $row ) {
	        
	        $checked = '';
	        
	        if ( in_array($row->id, $legal_status) ) {
	            $checked = 'checked="checked"' ;
	        }
	        
	        $html .= '<label class="advantage">' . PHP_EOL
	              .'<input type="checkbox" name="legal_status[' . $k . ']" value="'
				  . $row->id . '" ' . $checked . ' />' . PHP_EOL
				  . $row->value . PHP_EOL
	              . '</label>' . PHP_EOL ;
	    }
	    return $html;
	}
	/* end them tình trạng pháp lý */
	
	/* hoan them giao thong di lai*/
	function gettrafficmovementRadioList()
	{
	    $html = '';
	    
	    $featuresModel =& $this->getModel('features');
	    $featuresModel->setTableName( 'trafficmovement' );
	    $res = $featuresModel->getItems(true);
	    
	    $trafficmovement = array();
	    
	    if ( !empty( $this->row->trafficmovement ) ) {
	        $trafficmovement = explode( '-' , $this->row->trafficmovement );
	    }
	    
	    foreach ( $res['rows'] as $k=> $row ) {
	        
	        $checked = '';
	        
	        if ( in_array($row->id, $trafficmovement) ) {
	            $checked = 'checked="checked"' ;
	        }
	        
	        $html .= '<label class="advantage">' . PHP_EOL
	              .'<input type="checkbox" name="trafficmovement[' . $k . ']" value="'
				  . $row->id . '" ' . $checked . ' />' . PHP_EOL
				  . $row->value . PHP_EOL
	              . '</label>' . PHP_EOL ;
	    }
	    return $html;
	}
	/* end them giao thong di lai */
			
	function getAdvantagesRadioList()
	{
	    $html = '';
	    
	    $featuresModel =& $this->getModel('features');
	    $featuresModel->setTableName( 'advantages' );
	    $res = $featuresModel->getItems(true);
	    
	    $advantages = array();
	    
	    if ( !empty( $this->row->advantages ) ) {
	        $advantages = explode( '-' , $this->row->advantages );
	    }
	    
	    foreach ( $res['rows'] as $k=> $row ) {
	        
	        $checked = '';
	        
	        if ( in_array($row->id, $advantages) ) {
	            $checked = 'checked="checked"' ;
	        }
	        
	        $html .= '<label class="advantage">' . PHP_EOL
	              .'<input type="checkbox" name="advantages[' . $k . ']" value="'
				  . $row->id . '" ' . $checked . ' />' . PHP_EOL
				  . $row->value . PHP_EOL
	              . '</label>' . PHP_EOL ;
	    }
	    return $html;
	}
	
	function is_checkout( $checked_out )
	{
		if ($this->user && JTable::isCheckedOut( $this->user->get('id'), $checked_out ) ) {
			return true;
		}
		return false;
	}
	
 	function  getInsertId()
    {
    	return "dddd";
    	/*
    	if ( empty($this->row->properties_key))
    	{
			$sql = "SELECT MAX(id)+1 AS id FROM #__jea_properties" ;
			$db = & JFactory::getDBO();
			$db->setQuery($sql);
			$rows = $db->loadObject();
			if ( $db->getErrorNum() ) {
				JError::raiseWarning( 200, $db->getErrorMsg() );
			}
			return $rows->id;
    	}
    	else
    	{
    		return $this->row->properties_key;
    	}
    	*/
    }
    
    /* Hoan dang lam */
    
/* lay thong tin cua site */
    /*
	 function getSiteConfig()
	 {
		$app =& JFactory::getApplication();
		
	 	$site=array();
		$site[]= $app->getCfg('host');  //outputs database host
		$site[]= $app->getCfg('user'); //outputs database user
		$site[]= $app->getCfg('password'); //outputs site password
		$site[]= $app->getCfg('db'); //outputs database name
		return $site;
	 }
	 */    
	 function getlistproperties()
	 {
	 	
	 	global $u_reGlobalConfig;
	 	$backEndList = $u_reGlobalConfig['IFRAME']['backEndList'];
	 	
	 	if ( $backEndList == 1 )
	 	{
	 		
		// echo "<strong><a href='index.php?option=com_jea&controller=properties&task=add'>".JText::_('ADD_NEW_PROPERTY')."</a></strong>";
	 	$templatePath = "../templates/mlbds/html/com_u_re/properties/";
	    $this->addTemplatePath($templatePath);
		$this->setLayout('admin_list');
	 		
	 	}
	 	else
	 	{
	 	
		jimport('joomla.html.pagination');
	
		$cat =& JRequest::getVar('cat', '');
		//JToolBarHelper::title( JText::_( ucfirst( $this->get('category') ) . ' management' ), 'jea.png' );
		JToolBarHelper::title( JText::_( ucfirst( $cat ) . ' management' ), 'jea.png' );
		JToolBarHelper::publish('unspamlist','Bỏ qua sai phạm');
	    JToolBarHelper::publish();
	    JToolBarHelper::unpublish();
	    JToolBarHelper::addNew();
	    JToolBarHelper::editList();
	    JToolBarHelper::deleteList( JText::_( 'CONFIRM_DELETE_MSG' ) );
		
		
		$this->assignRef('lang' , $this->getLanguage() );
		$this->assignRef('cat' , $cat );
		
		// get return field
		$returnField = $u_reGlobalConfig['PROPERTY']['du_lieu_tra_ve'];
		$returnField .= ',da_ban';
		$limit = $u_reGlobalConfig['PROPERTY']['list_limit'];
		$orderby = $u_reGlobalConfig['PROPERTY']['orderby'];
				
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
		$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->layDanhSachBatDongSan($returnField,
														   $page, $limit, $this->lang, $orderby);
														 
		$this->assignRef( 'tongDong', $propertiesData['rows'][0] );										   
	
		$this->pagination = new JPagination( $this->tongDong , $limitstart, $limit );
		
	    $this->assignRef( 'rows', $propertiesData['rows'][3]);
	    
	    $db = JFactory::getDBO();
	    if(!empty($this->rows)){
		    foreach ($this->rows as $k => $row)
			{	
				$id = $row['id'];
				$mainImage = ilandCommonUtils::getPropertyMainImage( $id );
				$subImages = ilandCommonUtils::getPropertySubImages( $id );
				
				if ( !is_file($mainImage['isfile'])){
					$mainImage['max_url'] = JURI::root()."images/noimage.jpg";
				}
				$this->rows[$k]['hinhanh1'] = $mainImage;
				$this->rows[$k]['hinhanh'] = $subImages;
				$tien = array(
							'gia' => $row['gia'],
							'don_vi_tien_id' => $row['don_vi_tien_id'],
							'don_vi_dien_tich_id' => $row['don_vi_dien_tich_id'],
				);			
				$gia = ilandCommonUtils::layGiaTien( $tien );
				 $this->rows[$k]['gia'] = $gia;
				 
				$query = "SELECT username FROM jos_users WHERE id=".$row['ma_nguoi_dang'];
				$db->setQuery($query);
				$tennguoidang = $db->loadRow();
				$this->rows[$k]['ten_nguoi_dang'] = $tennguoidang[0];
					
			}
	    }
		
		$this->assignRef( 'loai_bds_id', $propertiesData['loai_bds_id'] );
		$type = ilandCommonUtils::getSelectBox( 'loai_bds', 'loai_bds_id', JText::_('TYPE'), $this->loai_bds_id, 'onchange=document.adminForm.submit()');
	    $this->assignRef( 'loai_bds', $type );

	    $this->assignRef( 'town_id', $propertiesData['town_id'] );
	    $towns = ilandCommonUtils::getSelectBox( 'tinh_thanh', 'town_id', JText::_('TOWNS'), $this->town_id, 'document.adminForm.submit()');
	    $this->assignRef( 'towns', $towns );
	    
	    $this->assignRef( 'area_id', $propertiesData['area_id'] );
	   	$areas = ilandCommonUtils::getSelectBox( 'quan_huyen', 'area_id', JText::_('AREAS'), $this->area_id, 'onchange=document.adminForm.submit()', $this->town_id);
	    $this->assignRef( 'areas', $areas );
		
	    $this->assignRef( 'emphasis', $propertiesData['emphasis'] );
	    $this->assignRef( 'published', $propertiesData['published'] );
	    $this->assignRef( 'spam', $propertiesData['spam'] );
	   	$this->assignRef( 'search', $propertiesData['search'] );
	   	
	 	}
	 	
		parent::display();
	
	 }
	 
// lay ngon ngu hien tai dang 2 ki tu
	function getLanguage()
	{
		$lang =& JFactory::getLanguage();
		$language = substr($lang->getTag(),0,2);
		return $language ;
	}
	
	/*
	 *
	 */
	/*
	function getChangPriceUnit($PriceUnit, $AreaUnit, $Price)
	{
		switch($PriceUnit)
		{
			case "USD" : $donvitien=" USD";
			break;
			case "VND" : $donvitien="";
			break;
			case "SJC" : $donvitien=" lượng";
			break;
			default: $donvitien="";
			break;
		}
		
		switch($AreaUnit)
		{
			case "m2" : $donvidat="/m2";
			break;
			case "Nguyên căn" : $donvidat="";
			break;
			case "Tháng" : $donvidat="/tháng";
			break;
			default: $donvidat="";
			break;
		}
		
		$ddgia=reFormatPrice($Price,$AreaUnit);
		
		if( $Price > 0)
		{
			$hientien = $ddgia.$donvitien.$donvidat;
		}
		else
		{
			$hientien= "Thương lượng";
		}
		
			return $hientien;
	}
	*/
	
	function getDeleteProperties()
	{	
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getPropertiestDelete($id);
	}
    	
    // update project
    function getUpdateProperties($param)
    {    	
    	$id = JRequest::getVar( 'cid', array(0), '', 'array' );   
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id[0], $param, $this->getLanguage());
    }
 	function getUpdatePropertiesList($param)
    {    	
    	$id = JRequest::getVar( 'cid', array(0), '', 'array' );   
    	$sotin = count($id);
    	$propertiesModel = new U_ReModelProperties();
    	for($i=0;$i<$sotin;$i++){
			$propertiesData = $propertiesModel->getUpdateProperties($id[$i], $param, $this->getLanguage());
    	}
    }
    
    function getUpdateOrdering(  )
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$language = ilandCommonUtils::getLanguage();
		$propertiesModel = new U_ReModelProperties();
		$propertiesModel->ordering( $id[0], $language );
	}
	
	function getDeleteImage( $id )
	{		
		//echo $id;
		//exit;
		ilandCommonUtils::delete_img( $id );
		
	}
	
	function updateLuotXem()
	{
		$id = JRequest::getVar( 'cid', array(0), '', 'array' );
		$language = ilandCommonUtils::getLanguage();
		$propertiesModel = new U_ReModelProperties();
		$propertiesModel->setLuotXem( $id[0], $language );
	}
}
