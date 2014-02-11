<?php
$tienich  = $_GET['thong_tin_them'];
$quanhuyen  = $_GET['quan_huyen_id'];
$loai_giao_dich_id = $_GET['loai_giao_dich_id']; 
$loai_bds_id = $_GET['loai_bds_id']; 
$tinh_thanh_id =$_GET['tinh_thanh_id']; 
$duong_pho = $_GET['duong_pho']; 
$du_an_id = $_GET['du_an_id']; 
$dien_tich_san_tu = $_GET['dien_tich_san_tu']; 
$dien_tich_san_den = $_GET['dien_tich_san_den'];
$dien_tich_su_dung_tu = $_GET['dien_tich_su_dung_tu']; 
if($dien_tich_su_dung_tu==0){
	$dien_tich_su_dung_tu = $_GET['dien_tich_su_dung_toi_thieu']; ;
}

$dien_tich_su_dung_den = $_GET['dien_tich_su_dung_den']; 
$phong_ngu_tu = $_GET['phong_ngu_tu'];
if($phong_ngu_tu==0) {
	$phong_ngu_tu = $_GET['so_phong_ngu_toi_thieu'];
}  
$phong_ngu_den = $_GET['phong_ngu_den']; 
$phong_tam_tu = $_GET['phong_tam_tu']; 

if($phong_tam_tu==0){
	$phong_tam_tu = $_GET['phong_tam_toi_thieu']; ;
}

$phong_tam_den = $_GET['phong_tam_den']; 
$muc_gia_tu = $_GET['muc_gia_tu']; 
$muc_gia_den = $_GET['muc_gia_den']; 

if($muc_gia_den==0){
	$muc_gia_den = $_GET['muc_gia_toi_da']; ;
} 

$so_tang_tu = $_GET['so_tang_tu']; 
$so_tang_den = $_GET['so_tang_den']; 
$chinh_chu = str_replace('true', '1',$_GET['chinh_chu']); 
$speak_english = str_replace('true', '1',$_GET['speak_english']); 
$nhan_mail = str_replace('on', '1',$_GET['nhan_mail']);  
$loai_gia_nc = $_GET['loai_gia'];  
$huong_id = $_GET['huong_id']; 
$tinh_trang_noi_that =$_GET['tinh_trang_noi_that']; 	 

$date 	= time(); 
$db 		= 	&JFactory::getDBO();		 

$sql = "insert into jos_tim_kiem_bds(ngay_dang,tien_ich_id,quan_huyen_id,loai_giao_dich_id,loai_bds_id,tinh_thanh_id,duong_pho,du_an_id,dien_tich_su_dung_tu,dien_tich_su_dung_den,
dien_tich_san_tu,dien_tich_san_den,phong_ngu_tu,phong_ngu_den,phong_tam_tu,phong_tam_den,muc_gia_tu,muc_gia_den,loai_gia_nc,so_tang_tu,so_tang_den,huong_id,tinh_trang_noi_that,speak_english,chinh_chu) 
value ('$date','$tienich','$quanhuyen','$loai_giao_dich_id','$loai_bds_id','$tinh_thanh_id','$duong_pho','$du_an_id','$dien_tich_su_dung_tu','$dien_tich_su_dung_den', 
'$dien_tich_san_tu','$dien_tich_san_den','$phong_ngu_tu','$phong_ngu_den','$phong_tam_tu','$phong_tam_den','$muc_gia_tu','$muc_gia_den','$loai_gia_nc','$so_tang_tu','$so_tang_den','$huong_id','$tinh_trang_noi_that','$speak_english','$chinh_chu')";
$db->setQuery($sql);
$db->query();