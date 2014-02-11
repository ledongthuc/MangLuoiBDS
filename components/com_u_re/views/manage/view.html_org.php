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
require_once(JPATH_ROOT . '/libraries/com_u_re/models/properties.php');
require_once(JPATH_ROOT . '/libraries/com_u_re/models/projects.php');

require_once('libraries/com_u_re/php/common_utils.php');
require_once "components/com_jea/models/realtors.php";

class U_reViewmanage extends U_ReView 
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
		switch ($this->getLayout())
		{
			case 'xoa':
				$this->getDeleteProperties();
				break;
			case 'hienthi':
				$this->getUpdatePropertiesfontend();
				break;
			case 'daytin':
				$this->getUpdatePropertiesFontendByNgay();
				break;
			case 'noibat':
				$this->getUpdatePropertiesFontendByLoaiTin(3);
				break;
			case 'danhdau':
				$this->getUpdatePropertiesFontendByLoaiTin(2);
				break;
			case 'form':
				$this->editItem();
				break;
			case 'form_mua_thue':
				$this->dangKyMuaThue();
				break;
			case 'yeucau':
				$this->editTYCBDS();
				break;
			case 'untick':
				$this->unTickEmail();
				break;
			case 'booking_project':
				$this->thongTinDatCho();
				break;
			default:
				$this->getlistproperties();
				break;
		}

		$this->assignRef('access', $access);
	//	parent::display($tpl);

	}
	
	function layDonViGia( $donvigia )
		{
			
		  	$pricevalue = "<select  id='price_unit' name='price_unit12' style='width:50px'>";		  	
		  	$pricevalue .=   "<option value='1'>VND</option>";
			$pricevalue .=   "<option  value='8'>triệu</option>";
			$pricevalue .=   "<option  value='7'>tỷ</option>";			
			$pricevalue .=   "<option  value='2'>USD</option>";
		 	$pricevalue .=   "<option  value='3' SELECTED >SJC</option>";
		    $pricevalue .= "</select>";
		    
		    //print_r($pricevalue );
		    
		    return $pricevalue;
		    
	}
	
	function unTickEmail(){
		$this->addTemplatePath('modules/mod_taoyeucau/tmpl/');
		$this->setLayout('untick');
	 	parent::display();
	}
	
	function editTYCBDS(){
		$lang = JFactory::getLanguage();
		$user		= & JFactory::getUser();
		$userid	= $user->get('id');
		
		if(isset($_SESSION['dang_tin'])){
			unset($_SESSION['tmp']);
			unset($_SESSION['dang_tin']);
		}
		$_SESSION['tao_yeu_cau'] = 'yes';
		if(isset($_SESSION['tmp'])){
			$data = $_SESSION['tmp'];
			$tienich 					= 	$data['tienich'];
			$loai_bds_id				=	$data['loai_bds_id'];
			$quan_huyen_id				=	$data['quanhuyen'];
			$loai_giao_dich_id			= 	$data['loai_giao_dich_id'];
			$tinh_thanh_id				=	$data['tinh_thanh_id'];		
			$du_an_id					= 	$data['du_an_id'];		
			$huong_id					= 	$data['huong_id'];
			$tinh_trang_noi_that		=	$data['tinh_trang_noi_that'];
		}else{
			$data = U_reModelProperties::layChiTietYeuCauBDS($userid);
			$tienich 					= 	$data->tien_ich_id;
			$loai_bds_id				=	$data->loai_bds_id;
			$quan_huyen_id				=	$data->quan_huyen_id;
			$loai_giao_dich_id			= 	$data->loai_giao_dich_id;
			$tinh_thanh_id				=	$data->tinh_thanh_id;		
			$du_an_id					= 	$data->du_an_id;		
			$huong_id					= 	$data->huong_id;
			$tinh_trang_noi_that		=	$data->tinh_trang_noi_that;
		}
		$quan_huyen_id = explode(',',$quan_huyen_id);
		
		$loai_giao_dich = U_reViewmanage::kieu_compobox( $param = array ('table' => 'loai_giao_dich', 'div_id'=>'loai_giao_dich_id','classname'=>'input-s', 'title'=>null,'index'=>$loai_giao_dich_id , 'is_town'=>'0','onchang'=>''));
		$loai_bds = U_reViewmanage::kieu_compobox( $param = array ('table' => 'loai_bds', 'div_id'=>'loai_bds_id', 'title'=>'Bất kỳ', 'classname'=>'input-s', 'index'=>$loai_bds_id, 'is_town'=>'0','onchang'=>'') );
		$onchangeTinhThanh1 = "onchange=" . '"layseachquanhuyen1' . "('quan_huyen_id',this.value,'" . $lang->getTag() . "','" . JURI::root() . "', 'quan_huyen_search', 'input-s')" . '"';
		$onchangeQuanHuyen = "onchange=" . '"layDanhSachDuAn' . "(this.value,'" . $lang->getTag() . "','" . JURI::root() . "')" . '"';
		$tinh_thanh_ycbds = U_reViewmanage::kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$tinh_thanh_id, 'is_town'=>'true',
											'onchang'=>$onchangeTinhThanh1 ) );		
		$quan_huyen = U_reViewmanage::kieu_compobox( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 'title'=>'Bất kỳ','index'=>$quan_huyen_id, 'is_town'=>$tinh_thanh_id,'onchang'=>$onchangeQuanHuyen));
		$huongHTML = U_reViewmanage::kieu_compobox( $param = array ('table' => 'huong', 'div_id'=>'huong_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$huong_id, 'is_town'=>'','onchang'=>'') );
		$duAnHTML = U_reViewmanage::kieu_compobox( $param = array ('table' => 'du_an', 'div_id'=>'du_an_id','classname'=>'input-s', 'title'=>'Bất kỳ','index'=>$du_an_id , 'is_town'=>'0','onchang'=>''));
		
		// lay tien ich
		$tienIchData = U_reViewmanage::lay_du_lieu( 'tien_ich' );
		
		$tienIchCurrent = $tienich;
		$tienIchCurrentArray = explode( ',', $tienIchCurrent );
		array_pop( $tienIchCurrentArray );
		$countTienIchCurrentArray = count( $tienIchCurrentArray );
		
		$tienIchHTML = U_reViewmanage::genListCheckBox( $tienIchData[0]['data'], 'tien_ich', 'tien_ich', 'ck', '', $tienIchCurrentArray );
		
		$this->assignRef('loai_giao_dich', $loai_giao_dich);
		$this->assignRef('loai_bds', $loai_bds);
		$this->assignRef('tinh_thanh_ycbds', $tinh_thanh_ycbds);
		$this->assignRef('quan_huyen', $quan_huyen);
		$this->assignRef('duong_pho', $duong_pho);
		$this->assignRef('duAnHTML', $duAnHTML);
		$this->assignRef('huongHTML', $huongHTML);
		$this->assignRef('tienIchHTML', $tienIchHTML);
		$this->assignRef('data', $data);
		
		
		$this->addTemplatePath('modules/mod_taoyeucau/tmpl/');
		$this->setLayout('default');
	 	parent::display();
	}
	function lay_du_lieu( $table,$townId = NULL )
	{
		$language = '';	
		if ($language == NULL )
		{
			$language = ilandCommonUtils::getLanguage();
		}			
		
		$propertyModel = new U_reModelProperties();
		$projectModel = new U_ReModelProjects();
		
		
		switch ( $table )
		{
			case 'loai_giao_dich':
				{
					return  $propertyModel->layDanhSachLoaiGiaoDich($language);
				}
								
			case 'huong':
				{
					return  $propertyModel->layDanhSachHuong($language);
				}
				
				case 'loai_bds':
				{
					return $propertyModel->layDanhSachLoaiBatDongSan($language);
				}
				
			case 'tinh_thanh':
				{
					return 	$propertyModel->layDanhSachTinhThanh( $language );
				}
			case 'quan_huyen':
				{
					return $propertyModel->layDanhSachQuanHuyen($townId, $language);
				}
			case 'phuong_xa':
				{
					if ( JRequest::getVar('quan_huyen_id') )
					{
						$quanHuyenId = JRequest::getVar('quan_huyen_id');
					}
					else 
					{
						$quanHuyenId = U_ReConfig::getValueByKey( 'COMMON', 'quan_huyen_mac_dinh' );							
					}
					return $propertyModel->layDanhSachPhuongXa( $quanHuyenId );
				}	
			case 'duong_pho':
				{
					if ( JRequest::getVar('quan_huyen_id') )
					{
						$quanHuyenId = JRequest::getVar('quan_huyen_id');
					}
					else 
					{
						$quanHuyenId = U_ReConfig::getValueByKey( 'COMMON', 'quan_huyen_mac_dinh' );							
					}
					return $propertyModel->layDanhSachDuongPho( $quanHuyenId );
				}
				
			case 'nhom_du_an':
				{
					return $nhomduan =  $projectModel->laynhomduan($language);	
				}
				
			case 'tien_ich':
				{
					return $propertyModel->layDanhSachTienIch( $language );
				}
			
			case 'du_an':
				{
					$ix_quan_huyen_id = JRequest::getVar('quan_huyen_id', 0);
					$ix_tinh_thanh_id = JRequest::getVar('tinh_thanh_id', 0);
					return $projectModel->laydanhsachduan( $ix_quan_huyen_id, $ix_tinh_thanh_id );
				}
				
		}
	}

	function kieu_compobox( $param )
	{
		$onchang = $param['onchang'];
		$rows= U_reViewmanage::lay_du_lieu($param['table']);
		if($param['table']== 'quan_huyen'){
			$rows= U_reViewmanage::lay_du_lieu($param['table'],$param['is_town']);
		}
		
		// xu ly rieng cho truong hop danh sach loai bat dong san
		/*if ( $param['div_id'] == 'loai_bds_tkkv_id' )
		{
			$propertyModel = new U_reModelProperties(); 
			$rows = $propertyModel->layDanhSachLoaiBDSTheoQuanHuyen( 'vi', JRequest::getVar('quan_huyen_id', 0), 
														JRequest::getVar('tinh_thanh_id', 0) );
		}
		*/
		
		for ( $i = 0; $i < count( $rows ); $i++ )
		{
			// $rows[$i]['title'] = $rows[$i]['id'] . '-' . $rows[$i]['alias'];
			$rows[$i]['title'] = $rows[$i]['alias'];
		}
		
		$index = $param['index'];
		
		// print_r( $index );
		if ( @$param['classname'] )
		{
			$classname = $param['classname'];
		}
		else 
		{
			$classname = "inputbox3";
		}
		
		if ( isset( $param['title']) )
		{
			$title =Array ( 'id' => 0 ,'ten' => $param['title']);
			array_unshift( $rows, $title );
			// array_unshift($rows, JHTML::_('select.option', 0, $param['title'] ));
		}	
		if($param['is_town']==true)
		{
			if ( JFactory::getURI()->getVar("town_id") )
			{
				$index = JFactory::getURI()->getVar("town_id");
			}
			if($param['table']== 'quan_huyen'){
				return JHTML::_('select.genericlist', $rows , $param['div_id'], 'class="'.$classname.'" size="1" '. $onchang. 'multiple="multiple"' ,  'id', 'ten', $index );
			}
			return JHTML::_('select.genericlist', $rows , $param['div_id'], 'class="'.$classname.'" size="1" '. $onchang , 'id', 	'ten', $index);
		}
		else
		{
			return JHTML::_('select.genericlist', $rows , $param['div_id'], 'class="'.$classname.'" size="1" '. $onchang ,  'id', 'ten', $index );
		}
		
}

	function kieu_link( $param )
	{
		$town_id = $param['town_id'];
		if ( JFactory::getURI()->getVar("town_id") )
		{
		$town_id = JFactory::getURI()->getVar("town_id");
		}
		$language='vi';
		$propertyModel = new U_reModelProperties();
		$rows= $propertyModel->layDanhSachQuanHuyen($town_id, $language);
		
		//$rows= lay_du_lieu($param['table']);
		$currentAreaId = JRequest::getInt('area_id', 1);		
		$htm = '';
		foreach($rows as $item)
		{				
					$selectedStyle = "";
					if ($item['id'] == $currentAreaId)
					{
						$selectedStyle = "style='color:red; font-weight:bold;'";
					}					
					$htm .= "<div id='filtertown' ><a $selectedStyle href=\"#\" onclick=\"HtlmLink('$item[id]',$town_id);\">".$item['ten']."</a><BR></div>";
		}
		return $htm;
	}
	function getPriceSelectBox( $param )
	{
		
		$resultStr = "<select id='price_list' class='".$param['classname']."' onchange='selectPrice(this.value,\"$param[value1]\", \"$param[value2]\" )'>";
		
		// parse title and value
		$priceTitleArr = explode("|",$param['tu']);
		$priceValueTempArr = explode("|",$param['den']);
		
		$count_value = count($priceTitleArr);
		
		$priceValueArr = array();
		$index = $param['index'];
		
		for ($i = 0; $i < $count_value; $i++)
		{
			$selected = '';
			if ( $index == $priceValueTempArr[$i])
			{
				$selected="selected='selected'";
			}
			
			$resultStr .= "<option $selected value='" . $priceValueTempArr[$i] . "'>" . $priceTitleArr[$i] . "</option>";	
		}
		$resultStr .= "</select>";

		return $resultStr;
	}
	
	
	/*RADIO */

	function getHtmlRadio( $param )
	{
		$rows= lay_du_lieu($param['table']);
		$name = $param['div_id'];
		$onclick = $param['onchang'];

		$iCheck=0;
		$htm ='';
		$type_id = JFactory::getURI()->getVar($name);
		foreach($rows as $item)
		{
			$idtype = $name.'_'.$item['id'];
			$checked = '';
			if($type_id == $item['id'] )
			{	
				$checked='checked'	;
			}
	
		$htm .= "<input '$checked' $onclick  id='$idtype' type=\"radio\" name='$name' value='$item[id]'><label for='$item[ten]'>".$item['ten']."</label></a><BR>";
		$iCheck++;
		}
		return $htm;
	}
	
	/* LAY GIA TIEN KHI FILTER */

	function getPriceLink($priceTitleStr, $priceValueStr)
	{
		// parse title and value
		$priceTitleArr = explode("|",$priceTitleStr);
		$priceValueTempArr = explode("|",$priceValueStr);
		
		$count_value = count($priceTitleArr);
		
		$priceValueArr = array();
		$htm = '';		
		for ($i = 1; $i < $count_value; $i++)
		{
			$price = 'pricestyle'.$i;
			$htm .=  "<div id='filtertown'><a id=$price href=\"#\" onclick=\"PriceLink('$priceValueTempArr[$i]','$price');\">".$priceTitleArr[$i]."</a><BR></div>";
		}

		return $htm;
		
	}

	function genListCheckBox( $data, $name, $id, $class, $style, $checkedIdArray )
	{
		$tempHTML = '';
		foreach ( $data as $item)
		{
			if ( is_array( $checkedIdArray ) && (  in_array( '1-' . $item['id'], $checkedIdArray ) ) )
			{
				$tempHTML .= '<span class="ck"><label style="margin-right:4px"><input name="list_thong_tin_them" value="' . $item['id'] . '" type="checkbox" checked></label>';	
			}
			else 
			{
				$tempHTML .= '<span class="ck"><label style="margin-right:4px"><input name="list_thong_tin_them" value="' . $item['id'] . '"type="checkbox"></label>';
			}

			$tempHTML .= '<label style="position: absolute;bottom: -4px;">'.$item['ten_tien_ich'].'</label>';
							
			$tempHTML .= '</span>';	
		}
		return $tempHTML;
		
	} 
		
	function editItem()
	{		
		global $u_reGlobalConfig;
		
		if ( isset( $_SESSION['tmp'] ) && ($_SESSION['tmp']['sess_tmp'] != 2) ) 
		{
			unset ( $_SESSION['tmp'] );
		}
		
		// check if exist info in session
		
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		if( $idurl =JFactory::getURI()->getVar("id"))
		{
			$id = $idurl;
		}
		else
		{
			$id = $cid[0];
		}
		
		// get template
		$currentTemplate = JFactory::getApplication()->getTemplate();
		$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
		
		JRequest::setVar( 'hidemainmenu', 1 );

		// khoi tao cac gia tri mac dinh
		$published = 1;
		$this->newsestChecked = '';
		$this->emphasisChecked = '';
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
		$this->propertyData['kinh_do'] = '10.7818082';	
		$this->propertyData['vi_do'] = '106.68513600000006';
		$this->propertyData['loai_tin_id'] = 1;
		
		$this->propertyData['alias'] = '';
		
		$this->propertyData['tieu_de_trang'] = '';	
		$this->propertyData['tu_khoa_trang'] = '';
		$this->propertyData['mo_ta_trang'] = '';
		$this->propertyData['tieu_de'] = '';
		$this->propertyData['ma_so'] = '';
		$this->propertyData['dia_chi'] = '';
		$this->propertyData['so_nha'] = ''; //vanganh
		$this->propertyData['duong_pho'] = ''; //vanganh
		$this->propertyData['gia'] = '';
		$this->propertyData['dien_tich_khuon_vien_rong'] = '';
		$this->propertyData['dien_tich_khuon_vien_rong_truoc'] = '';
		$this->propertyData['dien_tich_khuon_vien_dai'] = '';
		$this->propertyData['phuong_xa']='';
		$this->propertyData['du_an_id'] ='';
		/* */
		$this->propertyData['loai_bds'] = '';	
		$this->propertyData['phap_ly'] = '';
		$this->propertyData['phong_ngu'] = '';
		$this->propertyData['phong_tam'] = '';
		$this->propertyData['phong_khac'] = '';
		$this->propertyData['dien_tich_khuon_vien'] = '';
		
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
		$this->propertyData['loai_giao_dich'] = '';
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
		$this->propertyDataen['don_vi_dien_tich'] = '';
		$this->propertyDataen['don_vi_tien'] = '';
		$this->propertyDataen['nha_moi_gioi_ten'] = '';
		$this->propertyDataen['tinh_thanh'] = '';
		$this->propertyDataen['quan_huyen'] = '';
		$this->propertyDataen['phuong_xa'] = '';  //vanganh
		$this->propertyDataen['duong_pho'] = '';//vanganh
		$this->propertyDataen['tien_ich'] = '';
		//$this->propertyDataen['tien_ich_id'] = ''; //vanganh
		$this->propertyDataen['huong'] = '';
		$this->propertyData['phong_khach'] = 0;
		$realtorId = '';
		$this->mainImage['isfile']='';
		
		$imageData = array();
		$mainImage = '';
		$subImages = '';
		$imageData['id'] = 0;
		$imageData['status'] = 1;
		$imageData['title'] = '';
		$imageTemplateName = 'image_block';
		
		$this->propertyData['alias'] = '';
		
		if( $id )
		{
			$propertyData = U_reModelProperties::layChiTietBDS( $id, 'vi');
			$propertyDataen = U_reModelProperties::layChiTietBDS( $id, 'en');
			$this->assign( 'propertyData', $propertyData );
			$this->assign( 'propertyDataen', $propertyDataen );
						
    		$mainImage = ilandCommonUtils::getPropertyMainImage( $id );
    		$subImages = ilandCommonUtils::getPropertySubImages( $id );
    		
    		$imageData['id'] = $id;
    		    		
			$published = $propertyData['hien_thi_ra_ngoai'];
			
			if ($propertyData['moi_nhat'] == 1) 
			$this->newsestChecked = "checked";
			
			if ($propertyData['noi_bat'] == 1)
			$this->emphasisChecked = "checked";
			
			$phapLyId = $propertyData['phap_ly_id'];
			$quanHuyenId = $propertyData['quan_huyen_id'];
			$tinhThanhId = $propertyData['tinh_thanh_id'];
			$huongId = $propertyData['huong_id'];
			$loaiGiaoDichId = $propertyData['loai_giao_dich_id'];
			$loaiBDSId = $propertyData['loai_bds_id'];
			$nhaMoiGioiId = $propertyData['nha_moi_gioi_id'];
			$tieuDeBDS = $propertyData['tieu_de'];
			$duanId = $propertyData['du_an_id'];
			// add phuong xa, duong pho
			$phuongXaId = $propertyData['phuong_xa_id'];
			$duongPhoId = $propertyData['duong_pho_id'];
			
			$imageData['title'] = $propertyData['tieu_de'];							
		}
		if(isset($_SESSION['tao_yeu_cau'])){
			unset($_SESSION['tmp']);
			unset($_SESSION['tao_yeu_cau']);
		}
		$_SESSION['dang_tin'] = 'yes';
		if(isset($_SESSION['tmp'])){
			$loaiGiaoDichId = 	$_SESSION['tmp']['kind_id'];		
			$loaiBDSId		=	$_SESSION['tmp']['type_id'];
			$tinhThanhId	=	$_SESSION['tmp']['town_id'];
			$quanHuyenId	=	$_SESSION['tmp']['area_id'];
			$huongId		=	$_SESSION['tmp']['direction_id'];
			$duanId			=	$_SESSION['tmp']['du_an_id'];
			$propertyData['don_vi_dien_tich_id'] = $_SESSION['tmp']['price_area_unit'];
			if($_SESSION['tmp']['tien_ich']!= ''){
				$propertyData['tien_ich_id'] = implode(",",$_SESSION['tmp']['tien_ich']);
			}
		}
		
		$InsertPrice=$this->propertyData['gia'];
		//$InsertPrice=$this->getInsertPrice( $this->propertyData['gia'], $this->propertyData['don_vi_tien_id'], '1');
														
		//get price unit value
		$PriceUnit=$this->getInsertPrice($this->propertyData['gia'], 
												$this->propertyData['don_vi_tien_id']);				
		
   		$title = U_reViewmanage::getPageTitle( $this->get('category'), $tieuDeBDS );
	    
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
		$this->status = 1;

		$legal=ilandCommonUtils::getSelectBox('phap_ly','legal_status', JText::_('SELECT_LEGAL'),
													$phapLyId,'','','','class=opt');
    	$this->assignRef('legalStatusList' , $legal );
		$directions=ilandCommonUtils::getSelectBox('huong','direction_id','Vui lòng chọn', $huongId,'','','','');
    	$this->assignRef('directions' , $directions );
		
		$tienIchTemplate = $u_reGlobalConfig['PROPERTY']['admin_tien_ich_template'];
		
    	$tienIchHTML = U_ReModelProperties::fetchTienIchTemplate( $propertyData['tien_ich_id'], 
    																$templatePath, 
    																$tienIchTemplate, 
    																true, $lang );
	   	$this->assignRef('tienIchHTML' , $tienIchHTML );
		
		$realtorbds=ilandCommonUtils::getSelectBox('nha_moi_gioi','realtor_id',
													JText::_('realtor'), $realtorId,'','',"style='width:148px'");
    	$this->assignRef('realtor_bds' , $realtorbds );

    	$this->assignRef('InsertPrice' , $InsertPrice );

    	$this->assignRef('PriceUnit' , $PriceUnit );
    	
    	// exit;
    	
		$this->assignRef('properties_key' , $propertyData['ma_so'] );

		
    	// don vi
		//$getDonVi =  U_reViewmanage::getDonVi();
		$price_area_unit =  ilandCommonUtils::getSelectBox('don_vi_dien_tich', 'price_area_unit','', $propertyData['don_vi_dien_tich_id'],'','','','class=dangtin_donvitien');
		$this->assignRef('Unit' , $price_area_unit );
	
		// towns
		
		$areas =  ilandCommonUtils:: getSelectBox('quan_huyen', 'area_id', '',
									$quanHuyenId,'layDanhSachDuAn(this.value,"vi","' . JURI::root() . '")', $tinhThanhId, "style='width:160px'");
	    $this->assignRef('areas' , $areas );
		
		// towns layseachquanhuyen
		$towns =  ilandCommonUtils::getSelectBox('tinh_thanh', 'town_id','',$tinhThanhId,'layseachquanhuyen("area_id",this.value,"vi-VN","'.JURI::base().'","quanhuyens") ','',"style='width:160px'");
	    $this->assignRef('towns' , $towns );
	    
	    
		$kinds =  ilandCommonUtils::getSelectBox('loai_giao_dich','kind_id', '',
													$loaiGiaoDichId, 'layDanhSachDienTich("price_area_unit",this.value,"vi-VN","'.JURI::base().'","price_area_unit")', '', '',"class='opt'");
	    $this->assignRef('kinds' , $kinds );
	    
	    // onchange=getonchangevalue(\'type_id\',\'divtype\',\'\',0)
	    //$onchangeType = "getonchangevalue(\"type_id\",\"divtype\",\"\",0)";
	    $onchangeType ='';
		$types =  ilandCommonUtils::getSelectBox('loai_bds','type_id','',
													$loaiBDSId, $onchangeType,'','',"class='opt'");
	    $this->assignRef('types' , $types );
	
	    // add phuong xa, duong pho combo box
	    $phuongXaListHTML = ilandCommonUtils:: getSelectBox('phuong_xa', 'phuong_xa_id', 'Vui lòng chọn',
									$phuongXaId,"", $quanHuyenId, "style='width:160px'");
		$this->assignRef( 'phuongXaListHTML', $phuongXaListHTML );
		
		$duongPhoListHTML = ilandCommonUtils:: getSelectBox('duong_pho', 'duong_pho_id', 'Vui lòng chọn',
									$duongPhoId,"", $quanHuyenId, "style='width:160px'");
		$this->assignRef( 'duongPhoListHTML', $duongPhoListHTML );
	    
		$duAnHTML = ilandCommonUtils::getSelectBox('du_an', 'du_an_id','Vui lòng chọn',$duanId,'',$quanHuyenId,"style='width: 200px;padding: 2px;border: 1px solid #96A6C5;'");
		$this->assignRef( 'duAnHTML', $duAnHTML );
		
		$imageData['mainImage'] = $mainImage;
		$imageData['subImages'] = $subImages;
		$imageBlockHTML = ilandCommonUtils::fetchImageBlockTemplate( $templatePath, 
	    																$imageTemplateName, 
	    																$imageData );
	    $this->assignRef('imageBlockHTML' , $imageBlockHTML );
	    
		$this->addTemplatePath($templatePath);
		$this->setLayout( $u_reGlobalConfig['PROPERTY']['detail_template'] );
		// hoan dang lam
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
		$pricevalue .=   "<option $selectedtr value=\"8\">triệu</option>";
		$pricevalue .=   "<option $selectedti value=\"7\">tỷ</option>";
	  	$pricevalue .=   "<option $selected1 value=\"1\">VND</option>";
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

	 function getlistproperties()
	 {

	 	jimport('joomla.html.pagination');		
		$this->assignRef('lang' , $this->getLanguage() );
		global $u_reGlobalConfig;
		
		// get return field
		$returnField = $u_reGlobalConfig['PROPERTY']['du_lieu_tra_ve'];
		$limit = $u_reGlobalConfig['PROPERTY']['list_limit'];
		$orderby = $u_reGlobalConfig['PROPERTY']['orderby'];
				
		$limitstart =& JRequest::getVar('limitstart', 0);
		$page = ( $limitstart + $limit )/$limit ;
		
		$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->layDanhSachBatDongSan($returnField,
														   $page, $limit, $this->lang, $orderby, 1);

		$this->assignRef( 'tongDong', $propertiesData['rows'][0] );										   
	
		$this->pagination = new JPagination( $this->tongDong , $limitstart, $limit );
		
	    $this->assignRef( 'rows', $propertiesData['rows'][3]);	
	   // print_r( $propertiesData );
	  	// exit;
	    
	    foreach ($this->rows as $k => $row)
		{	
			$tien = array(
						'gia' => $row['gia'],
						'don_vi_tien_id' => $row['don_vi_tien_id'],
						'don_vi_dien_tich_id' => $row['don_vi_dien_tich_id'],
			);			
			$gia = ilandCommonUtils::layGiaTien( $tien );
			$this->rows[$k]['gia'] = $gia;
			
			// lay luot xem
			$this->rows[$k]['luot_xem'] = ilandCommonUtils::demLuotXemBDS($this->rows[$k]['id']);
		}
		$this->assignRef( 'loai_bds_id', $propertiesData['loai_bds_id'] );
		$type = ilandCommonUtils::getSelectBox( 'loai_bds', 'loai_bds_id', JText::_('TYPE'), $this->loai_bds_id, 'onchange=document.adminForm.submit()');
	    $this->assignRef( 'loai_bds', $type );

	    $this->assignRef( 'town_id', $propertiesData['town_id'] );
	    $towns = ilandCommonUtils::getSelectBox( 'tinh_thanh', 'town_id', JText::_('TOWNS'), $this->town_id, 'onchange=document.adminForm.submit()');
	    $this->assignRef( 'towns', $towns );
	    
	    $this->assignRef( 'area_id', $propertiesData['area_id'] );
	   	$areas = ilandCommonUtils::getSelectBox( 'quan_huyen', 'area_id', JText::_('AREAS'), $this->area_id, 'onchange=document.adminForm.submit()', $this->town_id);
	    $this->assignRef( 'areas', $areas );
	    
	    $this->assignRef( 'emphasis', $propertiesData['emphasis'] );
	    $this->assignRef( 'published', $propertiesData['published'] );
	   	$this->assignRef( 'search', $propertiesData['search'] );
	   	
	   	
	   	// get template
		$currentTemplate = JFactory::getApplication()->getTemplate();
		$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
	   	$this->addTemplatePath($templatePath);
		$this->setLayout( $u_reGlobalConfig['PROPERTY']['dang_tin_fontend_template'] );
	   	
		parent::display();
	 }
	 
// lay ngon ngu hien tai dang 2 ki tu
	function getLanguage()
	{
		$lang =& JFactory::getLanguage();
		$language = substr($lang->getTag(),0,2);
		return $language ;
	}
	function getUserIdByProperties($id){
		$db = &JFactory::getDBO();
		$sql = "select ma_nguoi_dang from iland4_bat_dong_san_vi where id =$id";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		return $result;
	} 
	function getDeleteProperties()
	{	
		$id[] = JFactory::getURI()->getVar("id");
    	$propertiesModel = new U_ReModelProperties();
    	$user = &JFactory::getUser(); 
    	$userid = $user->get('id');
    	$usertype = $user->get('usertype');
    	$data = U_reViewmanage::getUserIdByProperties($id[0]);
    	if( $data==$userid || $usertype == 'Super Administrator'){    	
			$propertiesData = $propertiesModel->getPropertiestDelete( $id );
    	}else{
    		
    	}		
		// redirect ve trang quan ly tin
		$Itemid = JRequest::getVar('Itemid');
		if(!empty($Itemid))
		{
		$Itemid =8;
		}
		header('Location: index.php?option=com_u_re&view=manage&Itemid='.$Itemid );
	}
    	
    // update project
    function getUpdateProperties($param)
    {    	
    	$id = JRequest::getVar( 'cid', array(0), '', 'array' );    	
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id[0], $param, $this->getLanguage());
    }
    
 // update properties fontend
    function getUpdatePropertiesfontend()
    {    	
    	
    	$id = JFactory::getURI()->getVar("id");
			$hienthirangoai = JFactory::getURI()->getVar("hienthirangoai");
			$hienthirangoai ? $value=0 : $value=1;
			$param = " hien_thi_ra_ngoai = ".$value;
			// print_r( $hienthirangoai.'------------'.$id.'----'.$value );
			//print_r($params );
			//exit;
    	
    	//$id = JRequest::getVar( 'cid', array(0), '', 'array' );    	
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id, $param, $this->getLanguage());
		//$this->_setDefaultRedirect();
		//$this->setRedirect( $this->_controllerUrl );
		
		// redirect ve trang quan ly tin
		$Itemid = JRequest::getVar('Itemid');
		if(!empty($Itemid))
		{
		$Itemid =8;
		}
		header('Location: index.php?option=com_u_re&view=manage&Itemid='. $Itemid );
		//header('Location: '.JURI::base().JRequest::getVar('lang').'/duan/24' );
	}
	
	function getUpdatePropertiesFontendByLoaiTin($loai_tin_id)
    {    	
    	
    		$id = JFactory::getURI()->getVar("id");
			$param = " loai_tin_id = ".$loai_tin_id;
			// print_r( $hienthirangoai.'------------'.$id.'----'.$value );
			//print_r($params );
			//exit;
    	
    	//$id = JRequest::getVar( 'cid', array(0), '', 'array' );    	
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id, $param, $this->getLanguage());
		//$this->_setDefaultRedirect();
		//$this->setRedirect( $this->_controllerUrl );
		
		// redirect ve trang quan ly tin
		$Itemid = JRequest::getVar('Itemid');
		if(!empty($Itemid))
		{
		$Itemid =8;
		}
		header('Location: index.php?option=com_u_re&view=manage&Itemid='. $Itemid );
		//header('Location: '.JURI::base().JRequest::getVar('lang').'/duan/24' );
	}
	function getUpdatePropertiesFontendByNgay()
    {    	
    	
    		$id = JFactory::getURI()->getVar("id");
    		$value= time();
			$param = " ngay_chinh_sua = ".$value;
			// print_r( $hienthirangoai.'------------'.$id.'----'.$value );
			//print_r($params );
			//exit;
    	
    	//$id = JRequest::getVar( 'cid', array(0), '', 'array' );    	
    	$propertiesModel = new U_ReModelProperties();
		$propertiesData = $propertiesModel->getUpdateProperties($id, $param, $this->getLanguage());
		//$this->_setDefaultRedirect();
		//$this->setRedirect( $this->_controllerUrl );
		
		// redirect ve trang quan ly tin
		$Itemid = JRequest::getVar('Itemid');
		if(!empty($Itemid))
		{
		$Itemid =8;
		}
		header('Location: index.php?option=com_u_re&view=manage&Itemid='. $Itemid );
		//header('Location: '.JURI::base().JRequest::getVar('lang').'/duan/24' );
	}

    function thongTinDatCho()
    {
    	// lay du lieu
    	global $u_reGlobalConfig;
    	$data = array();    	
    	$id = JRequest::getVar( 'id','0' );
    	$id = intval($id); 	
    	$project = U_ReModelProjects::getProjectById($id, 'vi');
    	if(!empty($project) && $project['hien_thi_ra_ngoai']==1)
    	{    		
    		$data['code'] = '1';
    		$data['du_an_id'] = $project['id'];
    		$data['ten_du_an'] = $project['ten'];
	    	$user = &JFactory::getUser();
	    	if($user->id != 0)
	    	{
	    		$data['ho_ten']=$user->name;
	    		$data['dia_chi']=$user->address;
	    		$data['so_dien_thoai']=$user->phone;
	    		$data['email']=$user->email;    		
	    	}
	    	else
	    	{
	    		$data['ho_ten']='';
	    		$data['dia_chi']='';
	    		$data['so_dien_thoai']='';
	    		$data['email']='';  
	    	}
    	}
    	else
    	{
    		$data['code'] = '500';
    	}
    	$this->assignRef( 'data', $data);
    	
    	// chon template    	
    	$currentTemplate = JFactory::getApplication()->getTemplate();
    	$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" . DS . "projects";
	   	$this->addTemplatePath($templatePath);
		$this->setLayout( $u_reGlobalConfig['PROJECT']['dat_cho_template'] );	   	
		parent::display();
    }
    
    function dangKyMuaThue()
    {
    	// lay du lieu
    	
    	// fetch template mua thue
    	$currentTemplate = JFactory::getApplication()->getTemplate();
    	$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" . DS . "properties";
	   	$this->addTemplatePath($templatePath);
		//$this->setLayout( $u_reGlobalConfig['PROPERTY']['mua_thue_template'] );	   	
		$this->setLayout( 'form_mua_thue' );
		parent::display();
    }
    
    function saveDangKyMuaThue()
    {
    	// save
    	U_ReModelProperties::saveDangKyMuaThue();

    	// redirect to response page
    	$currentTemplate = JFactory::getApplication()->getTemplate();
    	$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" . DS . "properties";
	   	$this->addTemplatePath($templatePath);
		//$this->setLayout( $u_reGlobalConfig['PROPERTY']['mua_thue_template'] );
	   	
		$this->setLayout( 'dang_ky_mua_thue_complete' );
		parent::display();
    }
    
}
