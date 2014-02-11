<?php
/**
 * ILAND 4.0.
 */
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
include_once 'libraries/com_u_re/models/properties.php';
include_once 'libraries/com_u_re/php/config.php';
include_once 'libraries/com_u_re/php/common_utils.php';
include_once 'components/com_mapbds/models/mapbds.php';

// lay danh sach tu DB
$returnField = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'du_lieu_tra_ve' );

$limit = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'so_luong_tin_tren_mot_trang' );
$template = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'template' );

// TODO: lay condition param theo dieu kien lay danh sach bat dong san duoc cau hinh trong module
//$conditionParam = ' 1 AND 1 ';
$typeList = $params->get('style');
$layoutname = $params->get('layoutname');
if ( $typeList == 'selling'  ) 
{
	// TODO: lay bat dong san moi nhat
	$conditionParam = ' loai_giao_dich_id = 1 ';
	$limit = U_ReConfig::getValueByKey( 'PROPERTY', 'list_limit' );
	$template = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'template_list' );
}
else if ( $typeList == 'renting'  ) 
{
	// TODO: lay bat dong san moi nhat
	$conditionParam = ' loai_giao_dich_id = 2 ';
	$limit = U_ReConfig::getValueByKey( 'PROPERTY', 'list_limit' );
	$template = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'template_list' );
}

else if ( $typeList == 'list' )
{
	// if empty searchType: danh sach bat dong san moi nhat o trang chu
	if ( empty ( $_GET['searchType'] ) )
	{
		$conditionParam = ' 1 AND 1 ';
		// $limit = U_ReConfig::getValueByKey( 'PROPERTY', 'list_limit' );
		$limit = 10;
		$template = 'listhome';
		
	} else {
	
	// TODO: lay danh sach bat dong san theo dieu kien GET (component)
	// lay cac dieu kien tim kiem tu bien GET
	$searchParam = array();
	
	// get search param from sef
	$searchSefNameStr = U_ReConfig::getValueByKey( 'PROPERTY', 'sefFieldStr' );
	$searchSefNameArr = explode( ',', $searchSefNameStr );
	
	$searchParamStr = U_ReConfig::getValueByKey( 'PROPERTY', 'paramStr' );
	$searchParamArr = explode( ',', $searchParamStr );
	
	$searchSefIndexStr = JRequest::getVar( 'sefIndex' );
	$searchSefIndexArr = explode( '-', $searchSefIndexStr );
	array_pop($searchSefIndexArr);
	
	$searchSefValueStr = JRequest::getVar( 'sefValue' );
	$searchSefValueArr = explode( '-', $searchSefValueStr );
	array_pop($searchSefValueArr);
	
	// perform search from sef & get param\
	// sef search
	$countSefIndex = count($searchSefIndexArr);
	for ( $i = 0; $i < $countSefIndex; $i++ )
	{
		if ( !empty( $searchSefValueArr[$i] ) )
		{
			if ( $searchSefNameArr[$searchSefIndexArr[$i]] == "quan_huyen_id" )
			{
				$quanHuyenCondition = ' AND quan_huyen_id IN (' . $searchSefValueArr[$i] . ') ';
				// $conditionParam .= ' AND quan_huyen_id IN (' . $searchSefValueArr[$i] . ') ';
			}
			else 
			{
				$searchParam[$searchSefNameArr[$searchSefIndexArr[$i]]] = $searchSefValueArr[$i];
			}
		}
		JRequest::setVar($searchSefNameArr[$searchSefIndexArr[$i]], $searchSefValueArr[$i]);
	}
	
	if( !empty( $_GET['du_an_id'] ) )
	{
		$searchParam['du_an_id'] = $_GET['du_an_id'];
		JRequest::setVar('du_an_title',$_GET['searchArray'][count($_GET['searchArray'])-1]);
	}
	
	$conditionParam = ilandCommonUtils::genConditionParam( $searchParam );
	$conditionParam .= $quanHuyenCondition;
	
	// dien_tich_su_dung_toi_thieu,phong_ngu_toi_thieu,phong_tam_toi_thieu,muc_gia_toi_da,loai_gia,speak_english,chinh_chu

	// tim kiem basic dien tich su dung 
	if ( !empty( $_GET['dien_tich_su_dung_toi_thieu'] ) )
	{
		$conditionParam .= ' AND dien_tich_su_dung >= ' . $_GET['dien_tich_su_dung_toi_thieu'] . ' ';
	}
	
	// tim kiem nang cao dien tich su dung
	if ( !empty( $_GET['dien_tich_su_dung_tu'] ) )
	{
		$conditionParam .= " AND dien_tich_su_dung >= " . $_GET['dien_tich_su_dung_tu'];
	}
	
	if ( !empty( $_GET['dien_tich_su_dung_den'] ) )
	{
		$conditionParam .= " AND dien_tich_su_dung <= " . $_GET['dien_tich_su_dung_den'];
	}
	
	// tim kiem basic phong ngu
	if ( !empty( $_GET['phong_ngu_toi_thieu'] ) )
	{
		$conditionParam .= ' AND phong_ngu >= ' . $_GET['phong_ngu_toi_thieu'] . ' ';
	}
	
	// tim kiem nang cao phong ngu
	if ( !empty( $_GET['phong_ngu_tu'] ) )
	{
		$conditionParam .= " AND phong_ngu >= " . $_GET['phong_ngu_tu'];
	}
	
	if ( !empty( $_GET['phong_ngu_den'] ) )
	{
		$conditionParam .= " AND phong_ngu <= " . $_GET['phong_ngu_den'];
	}
	
	// tim kiem basic phong tam
	if ( !empty( $_GET['phong_tam_toi_thieu'] ) )
	{
		$conditionParam .= ' AND phong_tam >= ' . $_GET['phong_tam_toi_thieu'] . ' ';
	}
	
	// tim kiem nang cao phong tam
	if ( !empty( $_GET['phong_tam_tu'] ) )
	{
		$conditionParam .= " AND phong_tam >= " . $_GET['phong_tam_tu'];
	}
	
	if ( !empty( $_GET['phong_tam_den'] ) )
	{
		$conditionParam .= " AND phong_tam <= " . $_GET['phong_tam_den'];
	}
	
	// tim kiem basic muc gia
	if ( !empty( $_GET['muc_gia_toi_da'] ) )
	{
		//$conditionParam .= ' AND gia <= ' . $_GET['muc_gia_toi_da'] . ' ';
		$giaToiDa = str_replace( ',', '', $_GET['muc_gia_toi_da'] );	
		if ( $_GET['loai_gia'] == 'nguyen_can' )
		{
			// tim theo tong gia tri
			$conditionParam .= ' AND gia_nguyen_can <= ' . $giaToiDa . ' ';
		} 
		else 
		{
			/*$conditionParam .= ' AND ( gia <= ' . $giaToiDa . ' AND don_vi_dien_tich_id = 1 ) 
								OR ( (tong_gia_tri/dien_tich_su_dung <= ' . $giaToiDa .  ') AND 
									don_vi_dien_tich_id = 2 ) ';*/
			$conditionParam .= ' AND gia_m2 <= ' . $giaToiDa . ' ';
		}
	}
	
	// tim kiem basic
	/*if ( !empty( $_GET['muc_gia_toi_da'] ) )
	{
		$conditionParam .= ' AND gia <= ' . $_GET['muc_gia_toi_da'] . ' ';
	}*/
	
	// tim kiem nang cao muc gia
	
	if ( !empty( $_GET['muc_gia_tu'] ) )
	{
		// $conditionParam .= ' AND ( gia >= ' . $_GET['gia_tu'] . ' )' ;
		$giaTu = str_replace( ',', '', $_GET['muc_gia_tu'] );
		if ( $_GET['loai_gia'] == 'nguyen_can' )
		{
			// tim theo tong gia tri
			$conditionParam .= ' AND gia_nguyen_can >= ' . $giaTu . ' ';
		} 
		else 
		{
//			$conditionParam .= ' AND ( ( gia >= ' . $giaTu . ' AND don_vi_dien_tich_id = 1 ) 
//								OR ( (gia/dien_tich_su_dung >= ' . $giaTu .  ') AND 
//									don_vi_dien_tich_id = 2 ) ) ';
			$conditionParam .= ' AND gia_m2 >= ' . $giaTu . ' ';
		}
	}
	if ( !empty( $_GET['muc_gia_den'] ) )
	{
		// $conditionParam .= ' AND ( gia <= ' . $_GET['gia_den'].')';
		$giaDen = str_replace( ',', '', $_GET['muc_gia_den'] );
		if ( $_GET['loai_gia'] == 'nguyen_can' )
		{
			// tim theo tong gia tri
			$conditionParam .= ' AND gia_nguyen_can <= ' . $giaDen . ' ';
		} 
		else 
		{
//			$conditionParam .= ' AND ( ( gia <= ' . $giaDen . ' AND don_vi_dien_tich_id = 1 ) 
//								OR ( (gia/dien_tich_su_dung <= ' . $giaDen .  ') AND 
//									don_vi_dien_tich_id = 2 ) ) ';
			$conditionParam .= ' AND gia_m2 <= ' . $giaDen . ' ';
		}
	}
	
	// tim kiem basic duong pho
	if ( !empty( $_GET['duong_pho'] ) )
	{
		$conditionParam .= " AND duong_pho LIKE '%" . $_GET['duong_pho'] . "%'";
	}
	
	// tim kiem basic english
	if( !empty( $_GET['speak_english'] ) )
	{
		$conditionParam .= " AND speak_english = 1 ";  
	}
//	else 
//	{
//		$conditionParam .= " AND speak_english = 0 ";
//	}
	
	// tim kiem basic chinh chu
	if( !empty( $_GET['chinh_chu'] ) )
	{
		$conditionParam .= " AND chinh_chu = 1 ";  
	}
//	else 
//	{
//		$conditionParam .= " AND chinh_chu = 0 ";	
//	}
	
	// tim kiem nang cao dien tich san
	if ( !empty( $_GET['dien_tich_san_tu'] ) )
	{
		$conditionParam .= ' AND dien_tich_khuon_vien >= ' . $_GET['dien_tich_san_tu'];
	}
	if ( !empty( $_GET['dien_tich_san_den'] ) )
	{
		$conditionParam .= ' AND dien_tich_khuon_vien <= ' . $_GET['dien_tich_san_den'];
	}

	// tim kiem nang cao so tang lau
	if ( !empty( $_GET['so_tang_tu'] ) )
	{
		$conditionParam .= ' AND so_tang >= ' . $_GET['so_tang_tu'];
	}
	if ( !empty( $_GET['so_tang_den'] ) )
	{
		$conditionParam .= ' AND so_tang <= ' . $_GET['so_tang_den'];
	}
	
	// tim kiem nang cao tinh trang noi that
	if ( isset( $_GET['tinh_trang_noi_that'] )  )
	{
		if ( $_GET['tinh_trang_noi_that'] == 1 )
		{
			$conditionParam .= ' AND noi_that != "" AND noi_that is not null ';
		}
		else if ( $_GET['tinh_trang_noi_that'] == 0 )
		{
			$conditionParam .= ' AND ( noi_that = "" OR noi_that is null )';
		}
	}
	
	// tim kiem nang cao huong
	if ( !empty( $_GET['huong_id'] ) )
	{
		$conditionParam .= ' AND huong_id = ' . $_GET['huong_id'];
	}
	
	// tim kiem nang cao thong tin them
	if ( !empty( $_GET['thong_tin_them'] ) )
	{
		$thongTinThemStr = $_GET['thong_tin_them'];
		$thongTinThemArr = explode( ',', $thongTinThemStr );
		array_pop( $thongTinThemArr );
		//$thongTinThemSearchStr = ' AND (';
		foreach ( $thongTinThemArr as $tt )
		{
			$thongTinThemSearchStr .= ' AND tien_ich_id LIKE "%' . $tt . '%" ';
		}
		// $thongTinThemSearchStr .= ') ';
		
		$conditionParam .= $thongTinThemSearchStr;
	}
	
	$template = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'template_list' );
	$returnField = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'du_lieu_tra_ve_list' );
	$limit = U_ReConfig::getValueByKey( 'PROPERTY', 'list_limit' );
	} // end else searchType null: o trang chu
}
else 
{
	if ( empty ( $_GET['searchType'] ) )
	{
		$conditionParam = ' 1 AND 1 ';
		// $limit = U_ReConfig::getValueByKey( 'PROPERTY', 'list_limit' );
		$limit = 10;
		$template = 'listhome';
		
	}
	else 
	{
		$conditionParam = ' 1 AND 1 ';
	}
}

$ordering = ' ngay_chinh_sua DESC '; 
if(!empty($_GET['clause']))
{
	// $ordering = "loai_tin_id DESC";
	if($_GET['clause'] == 'dien_tich_su_dung_ASC'){
		$ordering ='dien_tich_su_dung ASC';
	}
	else if($_GET['clause'] == 'dien_tich_su_dung_DESC'){
		$ordering ='dien_tich_su_dung DESC';
	}
	else if($_GET['clause'] == 'gia_nguyen_can_ASC'){
		$ordering ='gia_nguyen_can ASC';
	}
	else if($_GET['clause'] == 'gia_nguyen_can_DESC'){
		$ordering ='gia_nguyen_can DESC';
	}
	else if($_GET['clause'] == 'gia_m2_ASC'){
		$ordering ='gia_m2 ASC';
	}
	else if($_GET['clause'] == 'gia_m2_DESC'){
		$ordering ='gia_m2 DESC';
	}
}else{
	$ordering = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'orderby' );
}

// default value
$currentPage = 1;
if ( !empty( $_GET['page'] ) )
{
	$currentPage = $_GET['page'];
}

// add publish 
$conditionParam .= ' AND hien_thi_ra_ngoai = 1 ';

// kiem tra xem phai la noi bat hay o trang chu khong
if ( empty( $_GET['searchType'] ) )
{
	$dataEs = null;
}
else 
{

// get danh dau, noi bat, up tin
$currentTimeStamp = time();
$getEsQuery = " AND id IN ( SELECT bds FROM jos_push WHERE `start` < $currentTimeStamp AND `end` > $currentTimeStamp )";
$getEsQuery = $conditionParam . $getEsQuery;
//$conditionParam .= $getEsQuery;

//$dataEs = U_ReModelProperties::getListProperties( $returnField, $getEsQuery, $currentPage, 
//													$ordering, $limit );
if($_GET['searchType']== 'map' || $_GET['searchType']== 'map_nang_cao'){
	$limit = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'map_search' );
}else if($_GET['searchType']== 'dk'){
	$limit = 20;
}
$currentOffset = ( $currentPage - 1 ) * $limit;

$currentTimeStamp = time();
$getListEsQuery = " SELECT DISTINCT iland4_bat_dong_san_vi.$returnField, jos_push.type as `loai_tin_id` FROM iland4_bat_dong_san_vi, jos_push ";
$getEsQuery = " WHERE ";
$getEsQuery .= $conditionParam;
//$getEsQuery .= " AND iland4_bat_dong_san_vi.id IN ( SELECT bds FROM jos_push WHERE `start` < $currentTimeStamp AND `end` > $currentTimeStamp )";
$getEsQuery .= " AND jos_push.`start` < $currentTimeStamp AND jos_push.`end` > $currentTimeStamp ";
$getEsQuery .= " AND jos_push.`type` > 1 ";
$getEsQuery .= " AND jos_push.id IN ( SELECT p.id FROM jos_push p, ( SELECT `bds`, MAX( `type` ) maxType FROM jos_push p GROUP BY bds ) p1 WHERE p.type = p1.maxType AND p1.bds = p.bds) ";
$getEsQuery .= " AND jos_push.bds = iland4_bat_dong_san_vi.id ";
$getEsQuery .= " GROUP BY iland4_bat_dong_san_vi.id ";
$getLimitEsQuery = " ORDER BY jos_push.`type` DESC, iland4_bat_dong_san_vi." . $ordering;
$getLimitEsQuery .= " LIMIT $currentOffset, $limit ";

$getListEsQuery .= $getEsQuery . $getLimitEsQuery;

//$getEsQuery = $conditionParam . $getEsQuery;
$db = JFactory::getDBO();
$db->setQuery( $getListEsQuery );
$db->query();
$dataTemp = $db->loadAssocList();
$dataEs = ($dataTemp);

$getCountEsQuery = " SELECT iland4_bat_dong_san_vi.id FROM iland4_bat_dong_san_vi, jos_push ";
$getCountEsQuery .= $getEsQuery;

$db1 = JFactory::getDBO();
$db1->setQuery( $getCountEsQuery );
$db1->query();

$countEs = count( $db1->loadAssocList() );

for($i=0;$i<count($dataTemp);$i++){
	
	if($i!=0){
		$phay = ',';
	}
	$idlist .= $phay.$dataTemp[$i]['id'];
	$lisid = array_unique(explode(',',$idlist));
	$lisid = implode(',',$lisid);
}

if ( !empty( $_GET['searchType'] ) )
{
	include_once (dirname(__FILE__).DS.'insertSearch.php');
}													

} // end else empty search page: khong o trang chu

if ( empty( $dataEs ) || count( $dataEs ) < $limit )
{
	if(!empty($idlist)){
		$pr1 = " AND id not in(".$idlist.")";
	}else{
		$pr1='';
	}
	
	// tinh lai offet & limit cua tin thuong
	
	if ( $currentPage == 1 )
	{
		$newCurrentPage = 1;;
		$newLimit = $limit - count( $dataEs );
	}
	else if ( $currentPage > 1 )
	{
		$soTinThuong = ( ( $currentPage ) * $limit ) - $countEs;
		$newCurrentPage = floor( $soTinThuong / $limit ) + 1;
		$newLimit = $soTinThuong - ( ( $newCurrentPage - 1 ) * $limit );
		if ( $newLimit == 0 )
		{
			$newLimit = $limit;
		}
	}  
	
	$dataFull = U_ReModelProperties::getListProperties( $returnField, $conditionParam.$pr1, $newCurrentPage, 
													$ordering, $newLimit );
}
else 
{
	$dataFull = $dataEs;
}
if(!empty($dataEs)){
	if(count($dataEs)>=$limit){
		$data = $dataEs;
	}else{
		$data = array_merge( $dataEs, $dataFull[3] );
	}
}else{
	$data = $dataFull[3];
}

// khong su dung cach count total page nay nua
// $count = count( $data );

$currentTemplate = JFactory::getApplication()->getTemplate();

$templatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
$tempalateName = 'tien_te';
// get tien te, link, hinh anh
$data = ilandCommonUtils::boSungThongTinBDS( $data, $templatePath, $module->id, $tempalateName );
//$data1 = ilandCommonUtils::boSungThongTinBDS( $dataFull[3], $templatePath, $module->id, $tempalateName );
//$data = array_merge( $data, $data1 );
if(U_ReConfig::getValueByKey( 'COMMON', 'luot_xem_ds_bds' ) == 1)
{
	$hien_thi_luot_xem = 1;	
}
else
{
	$hien_thi_luot_xem = 0;
}
// get ajax paging
$contentElementId = 'noi_dung' . $module->id;
$module->noiDungId = $contentElementId;

$language = ilandCommonUtils::getLanguage();

$moduleTemplatePath = JPATH_THEMES . DS . $currentTemplate . DS . "html" . DS . "mod_danh_sach_BDS";
$ajaxPagingTemplate = U_ReConfig::getValueByKey( 'PROPERTY', 'ajax_paging_template' );
$url = U_ReConfig::getValueByKey( 'COMMON', 'root' ) . 
		'ajax_function.php?task=dsbds&condition=' . $conditionParam . '&returnField=' . $returnField
			. '&limit=' . $limit . '&templatePath=' . $moduleTemplatePath
			. '&templateName=' . $template . '&tienTemplatePath=' . $templatePath
			. '&idContentElement=' . $contentElementId . '&ajaxPagingTemplate=' . $ajaxPagingTemplate
			. '&language=' .$language . '&moduleId=' . $module->id;

// count all page
$getCountAll = " SELECT count(*) FROM iland4_bat_dong_san_vi WHERE " . $conditionParam;
$db1 = JFactory::getDBO();
$db1->setQuery( $getCountAll );
$db1->query();
$totalPage = round( ( $db1->loadResult() / $limit ) );

$ajaxPaging = ilandCommonUtils::getAjaxPagination( $contentElementId, $url, $currentPage, 
											$totalPage, $templatePath, $ajaxPagingTemplate );

if( $layoutname=='map' ){
	require(JModuleHelper::getLayoutPath( 'mod_danh_sach_BDS', 'map' ));
}
else if ( JRequest::getVar('Itemid') == 229 )
{
	require(JModuleHelper::getLayoutPath( 'mod_danh_sach_BDS', 'moinhat' ));;
}
else
{
	require(JModuleHelper::getLayoutPath( 'mod_danh_sach_BDS', 'listhome' ));
}
