<?php
define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) );
require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
include('libraries/com_u_re/php/common_utils.php');
$config = new JConfig();
mysql_pconnect($config->host,$config->user,$config->password); 
mysql_select_db($config->db);
mysql_query('SET NAMES "utf8"');
$cmd="SELECT * FROM `iland4_bat_dong_san_vi` WHERE id=".$_POST['id'];
$excute=mysql_query($cmd); 
$info=mysql_fetch_assoc($excute); 
$tempImage = ilandCommonUtils::getPropertyThumbnail( $_POST['id'] ); 
$gianguyencan = ilandCommonUtils::reFormatPrice($info['gia_nguyen_can']);
if($gianguyencan==0){
	$gianguyencan="thương lượng";
}

$giam2 = ilandCommonUtils::reFormatPrice($info['gia_m2']);
if($giam2==0){
	$giam2="thương lượng";
}
$info['img'] = JURI::base().$tempImage['min_url'];

//load template

if($info['duong_pho']!=''){
	$phay = ', ';
}
if($info['quan_huyen']!=''){
	$phay1 = ', ';
}


$diachi = $info['duong_pho'].$phay.$info['quan_huyen'].$phay1.$info['tinh_thanh'];

if($info['du_an']!=''){
	$phay2 = ', ';
}
if($info['luot_xem']==''){
	$info['luot_xem']=1;
}

$link = ilandCommonUtils::getPropertyLink( $info['alias'],$info['id'] );

$tieude = $info['loai_giao_dich'].' '.$info['loai_bds'].', '.$info['du_an'].$phay2.$info['quan_huyen'].', '.$info['tinh_thanh'];

$kinhdo =$info['kinh_do'];
$vido =$info['vi_do'];
if( $info['loai_giao_dich_id']==1){
	$mess = file_get_contents('components/com_mapbds/views/mapbds/tmpl/info.html');
}else{
	$mess = file_get_contents('components/com_mapbds/views/mapbds/tmpl/infothue.html');
}
$mess = str_replace('%img%', $info['img'], $mess);
$mess = str_replace('%ngu%', $info['phong_ngu'], $mess);
$mess = str_replace('%tam%', $info['phong_tam'], $mess);
$mess = str_replace('%title%', $tieude, $mess);
$mess = str_replace('%diachi%', $diachi, $mess);
$mess = str_replace('%gianguyencan%', $gianguyencan, $mess);
$mess = str_replace('%giam2%', $giam2, $mess);
$mess = str_replace('%dientichsd%', $info['dien_tich_su_dung'], $mess);
$mess = str_replace('%dientichsan%', $info['dien_tich_khuon_vien'], $mess);
$mess = str_replace('%ngaychinhsua%', date('d/m/Y',$info['ngay_chinh_sua']), $mess);
$mess = str_replace('%luotxem%', $info['luot_xem'], $mess);
$mess = str_replace('%chitiet%', $link, $mess);

echo $kinhdo.'#@#'.$vido.'#@#'.$mess;