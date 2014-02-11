<?php
defined('_JEXEC') or die('Restricted access');
require_once('libraries/com_u_re/php/common_utils.php');
include_once 'libraries/com_u_re/php/config.php';
$lang = JFactory::getLanguage();
$catDirect = JRequest::getVar('catDirect');

switch ( $catDirect )
{
	// case '0' :  $ix_loai_giao_dich_id = 0;
	// break;
	case 'selling' :  $ix_loai_giao_dich_id = 1;
	break;
	case 'renting' :  $ix_loai_giao_dich_id = 2;
	break;
	case 'needbuying' :  $ix_loai_giao_dich_id = 3;
	break;
	case 'needrenting' :  $ix_loai_giao_dich_id = 4;
	break;
	default: $ix_loai_giao_dich_id = 0;
}



// hard code cho bat ky
$ix_tinh_thanh_id = JRequest::getVar('tinh_thanh_id', 0);
if(isset($_SESSION['tmp'])){
	$yx_tinh_thanh_id = $_SESSION['tmp']['tinh_thanh_id'];
	$ix_huong_id = $_SESSION['tmp']['huong_id'];
	$ix_loai_bds_id = $_SESSION['tmp']['loai_bds_id'];	
	$ix_loai_giao_dich_id  = $_SESSION['tmp']['loai_giao_dich_id'];	
}else{
	$yx_tinh_thanh_id =  0;
	$ix_huong_id = JRequest::getVar('huong_id', 0);
	$ix_loai_bds_id = JRequest::getVar('loai_bds_id', 0);	
	if ( $ix_loai_giao_dich_id == 0 )
	{
		$ix_loai_giao_dich_id = JRequest::getVar('loai_giao_dich_id', 1);	
	}
}	
// hard code cho bat ky
$ix_quan_huyen_id = JRequest::getVar('quan_huyen_id', 0);
if(isset($_SESSION['tmp'])){
	$yx_quan_huyen_id = $_SESSION['tmp']['quanhuyen'];
}else{
	$yx_quan_huyen_id = JRequest::getVar('quan_huyen_id', 0);
}
$urli = JURI::base();
$ix_gia_tu = JRequest::getVar('gia_tu', 0);	
$ix_gia_den = JRequest::getVar('gia_den', 0);	
$ix_gia_tu_den = $ix_gia_tu.";".$ix_gia_den;

$ix_dien_tich_tu = JRequest::getVar('dien_tich_tu', 0);	
$ix_dien_tich_den = JRequest::getVar('dien_tich_den', 0);	
$ix_dien_tich_tu_den = $ix_dien_tich_tu.";".$ix_dien_tich_den;

$ix_nhom_du_an_id = JRequest::getVar('du_an_id', 0);	

/* cho lay du lieu */
$loai_giao_dich = kieu_compobox( $param = array ('table' => 'loai_giao_dich', 'div_id'=>'loai_giao_dich_id','classname'=>'input-s', 'title'=>null,'index'=>$ix_loai_giao_dich_id , 'is_town'=>'0','onchang'=>''));
//$loai_giao_dich_filter = getHtmlRadio( $param = array ('table' => 'loai_giao_dich', 'div_id'=>'loai_giao_dich_id','onchang'=>'onclick=RadioKindId(this.value)'));

$loai_bds = kieu_compobox( $param = array ('table' => 'loai_bds', 'div_id'=>'loai_bds_id', 'title'=>'Bất kỳ', 'classname'=>'input-s', 'index'=>$ix_loai_bds_id, 'is_town'=>'0','onchang'=>'') );
$loai_bds_tkkv = kieu_compobox( $param = array ('table' => 'loai_bds', 'div_id'=>'loai_bds_tkkv_id', 'title'=>'Bất kỳ', 'classname'=>'input-s', 'index'=>$ix_loai_bds_id, 'is_town'=>'0','onchang'=>'') );
//$loai_bds_filter = kieu_compobox( $param = array ('table' => 'loai_bds', 'div_id'=>'type_id', 'title'=>'loai_bds','index'=>'0', 'is_town'=>'0','onchang'=>'onchange=submitform()') );
//$loai_bds_filter = getHtmlRadio( $param = array ('table' => 'loai_bds', 'div_id'=>'loai_bds_id', 'onchang'=>'onclick=RadioTypeId(this.value)'));

$onchangeTinhThanh = "onchange=" . '"layseachquanhuyen' . "('quan_huyen_id',this.value,'" . $lang->getTag() . "','" . JURI::root() . "', 'quan_huyen_search', 'input-s')" . '"';
$onchangeTinhThanh1 = "onchange=" . '"layseachquanhuyen1' . "('quan_huyen_id',this.value,'" . $lang->getTag() . "','" . JURI::root() . "', 'quan_huyen_search', 'input-s')" . '"';
$onchangeTinhThanhtk = "onchange=" . '"layseachquanhuyentk' . "('quan_huyen_id',this.value,'" . $lang->getTag() . "','" . JURI::root() . "', 'quan_huyen_search', 'input-s')" . '"';
$onchangeQuanHuyen = "onchange=" . '"layDanhSachDuAn' . "(this.value,'" . $lang->getTag() . "','" . JURI::root() . "')" . '"';
$onchangeQuanHuyen1 = "onchange=" . '"layDanhSachDuAn1' . "(this.value,'" . $lang->getTag() . "','" . JURI::root() . "')" . '"';

$tinh_thanh = kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$ix_tinh_thanh_id, 'is_town'=>'true',
											'onchang'=>$onchangeTinhThanh ) );

$tinh_thanh_ycbds = kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$yx_tinh_thanh_id, 'is_town'=>'true',
											'onchang'=>$onchangeTinhThanh1 ) );

// neu la ix tinh thanh: dang o search thi gan lai tinh thanh hien tai
if ( $ix_tinh_thanh_id > 0 )
{
	$yx_tinh_thanh_id = $ix_tinh_thanh_id;
}
$tinh_thanh_tk = kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$yx_tinh_thanh_id, 'is_town'=>'true',
											'onchang'=>$onchangeTinhThanhtk ) );
//$tinh_thanh = kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>JText::_('CHON_TINH_THANH'),'classname'=>'input-s','index'=>$ix_tinh_thanh_id, 'is_town'=>'true','onchang'=>'onchange=layseachquanhuyen(\'quan_huyen_id\',this.value,\''.$lang->getTag().'\')') );
//$tinh_thanh_filter = kieu_compobox( $param = array ('table' => 'tinh_thanh', 'div_id'=>'tinh_thanh_id', 'title'=>'Tất cả','index'=>'0', 'is_town'=>'true','onchang'=>'onchange=town_change(this.value)') );

$huongHTML = kieu_compobox( $param = array ('table' => 'huong', 'div_id'=>'huong_id', 'title'=>'Bất kỳ','classname'=>'input-s','index'=>$ix_huong_id, 'is_town'=>'','onchang'=>'') );

$quan_huyen = kieu_compobox( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
										'title'=>'Bất kỳ','index'=>$ix_quan_huyen_id, 'is_town'=>'',
										'onchang'=>$onchangeQuanHuyen));

//$quan_huyen_ycbds = kieu_compobox( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
//										'title'=>'Bất kỳ','index'=>$yx_quan_huyen_id, 'is_town'=>'',
//										'onchang'=>$onchangeQuanHuyen1));

//$quan_huyen_ycbds = kieu_compobox( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
//										'title'=>'Bất kỳ','index'=>$ix_quan_huyen_id, 'is_town'=>'',
//										'onchang'=>$onchangeQuanHuyen1));

$quan_huyen_ycbds = quanhuyenTYC( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
										'title'=>'Bất kỳ','index'=>$ix_quan_huyen_id, 'is_town'=>'',
										'onchang'=>$onchangeQuanHuyen1));

$quan_huyen_ycbds1 = quanhuyenTYC( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_id', 'classname'=>'input-s', 
										'title'=>'Bất kỳ','index'=>$_SESSION['tmp']['quanhuyen'], 'is_town'=>'',
										'onchang'=>$onchangeQuanHuyen1));


// $onchangeQuanHuyenTKKV = "onchange=" . '"layDanhSachLoaiBDS' . "(this.value, 'loai_bds_id', 'loai_bds_tkkv_id','" . $lang->getTag() . "','" . JURI::root() . "')" . '"';
$onchangeQuanHuyenTKKV = '';
$quanHuyenTKKVHTML = kieu_compobox( $param = array ('table' => 'quan_huyen', 'div_id'=>'quan_huyen_tkkv_id', 'classname'=>'input-s', 
										'title'=>'Bất kỳ','index'=>$ix_quan_huyen_id, 'is_town'=>'',
										'onchang'=>$onchangeQuanHuyenTKKV));

//										'onchang'=>'onchange=layDanhSachDuAn(this.value,\''.$lang->getTag().'\');' ));
// layDanhSachPhuongXa(this.value, 'phuong_xa_select');
													//layDanhSachDuongPho(this.value, 'duong_pho_select')
//$quan_huyen_filter = kieu_link($param = array ('table' => 'quan_huyen', 'town_id'=>1));

// Get price title and price value from admin config
	$priceTitleStr = $params->get("priceTitles");
	$priceValueStr = $params->get("priceValues");
	
$khoanggia = getPriceSelectBox( array('tu'=> $priceTitleStr, 'den' => $priceValueStr, 'classname'=>'input-s', 'value1'=>'gia_tu', 'value2'=>'gia_den', 'index'=> $ix_gia_tu_den) );
//$khoanggia_filter = getPriceLink($priceTitleStr, $priceValueStr,'input-s');

	$areaTitleStr = $params->get("areaTitles");
	$areaValueStr = $params->get("areaValues");
$khoangdientich = getPriceSelectBox( array('tu'=> $areaTitleStr, 'den' => $areaValueStr, 'classname'=>'input-s', 'value1'=>'dien_tich_tu', 'value2'=>'dien_tich_den', 'index'=> $ix_dien_tich_tu_den ) );

// them moi duong pho, phuong xa
// $ix_phuong_xa = JRequest::getVar( 'phuong_xa_id', 0 );
// $phuongXaListHTML = kieu_compobox( $param = array ('table' => 'phuong_xa', 'div_id'=>'phuong_xa_id', 
												//'classname'=>'input-s', 'title'=>JText::_('CHON_PHUONG_XA'),
												//'index'=>$ix_phuong_xa, 'is_town'=>'','onchang'=>'') );

// $ix_duong_pho = JRequest::getVar( 'duong_pho_id', 0 );
//$duongPhoListHTML = kieu_compobox( $param = array ('table' => 'duong_pho', 'div_id'=>'duong_pho_id', 
//												'classname'=>'input-s', 'title'=>JText::_('CHON_DUONG_PHO'),
//												'index'=>$ix_duong_pho, 'is_town'=>'','onchang'=>'') );
												
	// lay nhom du an

if(isset($_SESSION['tmp'])){
	$ix_nhom_du_an_id = $_SESSION['tmp']['du_an_id'];
}else{
	$ix_nhom_du_an_id =  JRequest::getVar('du_an_id', 0);
}
// $nhom_du_an = kieu_compobox( $param = array ('table' => 'nhom_du_an', 'div_id'=>'du_an_id','classname'=>'input-s', 'title'=>'Bất kỳ','index'=>$ix_nhom_du_an_id , 'is_town'=>'0','onchang'=>''));

// lay nhung du an thuoc quan huyen 
$duAnHTML = kieu_compobox( $param = array ('table' => 'du_an', 'div_id'=>'du_an_id','classname'=>'input-s', 'title'=>'Bất kỳ','index'=>$ix_nhom_du_an_id , 'is_town'=>'0','onchang'=>''));

// lay tien ich
$tienIchData = lay_du_lieu( 'tien_ich' );

if(isset($_SESSION['tmp'])){
	$tienIchCurrent = $_SESSION['tmp']['tienich'];
}else{
	$tienIchCurrent = JRequest::getVar("thong_tin_them");
}

$tienIchCurrentArray = explode( ',', $tienIchCurrent );
array_pop( $tienIchCurrentArray );
$countTienIchCurrentArray = count( $tienIchCurrentArray );

$tienIchHTML = genListCheckBox( $tienIchData[0]['data'], 'tien_ich', 'tien_ich', 'ck', '', $tienIchCurrentArray );

// get search param config
$sefFieldStr = U_ReConfig::getValueByKey( 'PROPERTY', 'sefFieldStr' );
$sefFieldTypeStr = U_ReConfig::getValueByKey( 'PROPERTY', 'sefFieldTypeStr' );

$paramStr = U_ReConfig::getValueByKey( 'PROPERTY', 'paramStr' );
$paramTypeStr = U_ReConfig::getValueByKey( 'PROPERTY', 'paramTypeStr' );

$cbparamStr = U_ReConfig::getValueByKey( 'PROPERTY', 'cb_paramStr' );
$cbparamTypeStr = U_ReConfig::getValueByKey( 'PROPERTY', 'cb_paramTypeStr' );

function lay_du_lieu( $table )
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
					if ( JRequest::getVar('tinh_thanh_id') )
					{
						$townId = JRequest::getVar('tinh_thanh_id');
					}
					else 
					{
						// $townId = U_ReConfig::getValueByKey( 'COMMON', 'tinh_thanh_mac_dinh' );
						if(isset($_SESSION['tmp'])){
							$townId = $_SESSION['tmp']['tinh_thanh_id'];
						}else{
							$townId = 0;
						} 
					}
					return $propertyModel->layDanhSachQuanHuyen($townId, 'vi');
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
		$rows = lay_du_lieu($param['table']);
		
		// xu ly rieng cho truong hop danh sach loai bat dong san
		/*if ( $param['div_id'] == 'loai_bds_tkkv_id' )
		{
			$propertyModel = new U_reModelProperties(); 
			$rows = $propertyModel->layDanhSachLoaiBDSTheoQuanHuyen( 'vi', JRequest::getVar('quan_huyen_id', 0), 
														JRequest::getVar('tinh_thanh_id', 0) );
		}
		*/
		if($param['table']=='du_an')
		{
			$rowsCount = count( $rows );
			for ( $i = 0; $i < $rowsCount; $i++ )
			{
				$rows[$i]['lang'] = $i+1;
			}	
			
		}
		$rowsCount = count( $rows );
		for ( $i = 0; $i < $rowsCount; $i++ )
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
		
		/*echo "<pre>";
			print_r( $rows );
			echo "</pre>";*/
		
		if ( isset( $param['title']) )
		{
			$title =Array ( 'id' => 0 ,'ten' => $param['title']);
			
			array_unshift( $rows, $title );
			// array_unshift($rows, JHTML::_('select.option', 0, $param['title'] ));
		}
		
		
		if($param['table']=='quan_huyen'){
			$mutipal = 'multiple="multiple"';
		}	
		if($param['is_town']==true)
		{
			if ( JFactory::getURI()->getVar("town_id") )
			{
				$index = JFactory::getURI()->getVar("town_id");
			}
			return JHTML::_('select.genericlist', $rows , $param['div_id'], 'class="'.$classname.'" size="1" '. $onchang , 'id', 	'ten', $index);
		}
		else
		{
			return JHTML::_('select.genericlist', $rows , $param['div_id'], 'class="'.$classname.'" size="1" '. $onchang ,  'id', 'ten', $index );
		}
		
}

function quanhuyenTYC($param){
	$rows	= lay_du_lieu($param['table']);
	$index 	= $param['index'];
	$html	='<select name="quan_huyen_id" id="quan_huyen_id" multiple="multiple" class="input-s" size="1" '.$param['onchang'].'>';
	for ($i=0;$i<count($rows);$i++){
		if(in_array($rows[$i]['id'],explode(',',$index))){
			$select[$i] = " selected='selected'";
		}
		$html .=	'<option value="'.$rows[$i]['id'].'" title="'.$rows[$i]['alias'].'"'.$select[$i].'>'.$rows[$i]['ten'].'</option>';
	}
	$html	.= "</select>";
	return $html;
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
				$tempHTML .= '<span class="ck"><label style="margin-right:4px"><input name="list_thong_tin_them" value="' . $item['id'] . '" type="checkbox" checked /></label>';	
			}
			else 
			{
				$tempHTML .= '<span class="ck"><label style="margin-right:4px"><input name="list_thong_tin_them" value="' . $item['id'] . '"type="checkbox" /></label>';
			}

			$tempHTML .= '<label style="position: absolute;bottom: -4px;">'.$item['ten_tien_ich'].'</label>';
							
			$tempHTML .= '</span>';	
		}
		return $tempHTML;
		
	} 
	
	
?>