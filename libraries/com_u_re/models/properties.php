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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
define('WATERMARK_OVERLAY_IMAGE', 'watermark.png');
define('WATERMARK_OVERLAY_OPACITY', 100);
define('WATERMARK_OUTPUT_QUALITY', 100);
define('UPLOADED_IMAGE_DESTINATION', 'images/originals/');
define('PROCESSED_IMAGE_DESTINATION', 'images/hinh/');
jimport('joomla.application.component.model');

require_once(JPATH_ROOT . '/libraries/com_u_re/php/common_utils.php');
require_once(JPATH_ROOT . '/includes/ham_tien_ich.php');
//require_once(JPATH_ROOT . '/libraries/joomla/user/helper.php');
//require_once COM_U_RE_COMMON_UTILS;

class U_ReModelProperties extends JModel
{
	
    var $_error = '';
    var $DBConfig = null;
    
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		// TODO: init lib
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
	}
	
	/*
    * Description: Get property by id
    * Author: danh thong
    * Version: 1.0
    * Date create: 30-10-2012
    */
	
	function untickYeuCauBDS(){
		global $mainframe;
		$id = $_GET['id']; 
		$email = $_GET['email']; 
		$db = JFactory::getDBO();
		$sql = "UPDATE jos_yeu_cau_bds SET nhan_mail = 0 WHERE email='$email'";
		$db->setQuery($sql);
		$xoa = $db->query();
		if($db->query()){
			$this->setRedirect(JURI::base().'vi?option=com_u_re&view=manage&layout=untick&Itemid=256&msg=success');
		}else{
			$this->setRedirect('index.php');
		} 
	}
	
	function saveYeuCauBDS(){		
		global $mainframe;
		$userid = JRequest::getVar( 'customer', '0' , 'POST' );
		$itemid = JRequest::getVar( 'item', '0' , 'POST' );
		$email = JRequest::getVar( 'email', '', 'POST', 'string', JREQUEST_ALLOWRAW );
		$name = JRequest::getVar( 'name', '', 'POST', 'string', JREQUEST_ALLOWRAW );
		$phone = JRequest::getVar( 'phone', '', 'POST' );   
		$id =  JRequest::getInt( 'id', '' );
		$dsat = U_ReModelProperties::getResultByEmai($email);
		
		if($userid==0 && $itemid != 247 ){
			U_ReModelProperties::saveUser();
			$userid = U_ReModelProperties::getIdUserByUserName(JRequest::getVar( 'username', '', 'POST', 'string' ));
		}
		$query  = str_replace(",","",JRequest::getVar( 'sql', '', 'POST', 'string', JREQUEST_ALLOWRAW )); 
		$tienich  = JRequest::getVar( 'tienich', '', 'POST', 'string', JREQUEST_ALLOWRAW );
		$quanhuyen  = JRequest::getVar( 'quanhuyen', '', 'POST', 'string', JREQUEST_ALLOWRAW ); 
		$query =	htmlentities($query,ENT_QUOTES,"UTF-8");
		$loai_giao_dich_id = JRequest::getVar( 'loai_giao_dich_id', '0' , 'POST' ); 
		$loai_bds_id = JRequest::getVar( 'loai_bds_id', '0' , 'POST' ); 
		$tinh_thanh_id =JRequest::getVar( 'tinh_thanh_id', '0' , 'POST' ); 
		$duong_pho = JRequest::getVar( 'duong_pho', '0' , 'POST' ); 
		$du_an_id = JRequest::getVar( 'du_an_id', '0' , 'POST' ); 
		$dien_tich_san_tu = JRequest::getInt( 'dien_tich_san_tu', '0' , 'POST' ); 
		$dien_tich_san_den = JRequest::getInt( 'dien_tich_san_den', '0' , 'POST' );
		$dien_tich_su_dung_tu = JRequest::getInt( 'dien_tich_su_dung_tu', '0' , 'POST' ); 
		$dien_tich_su_dung_den = JRequest::getInt( 'dien_tich_su_dung_den', '0' , 'POST' ); 
		$phong_ngu_tu = JRequest::getInt( 'phong_ngu_tu', '0' , 'POST' ); 
		$phong_ngu_den = JRequest::getInt( 'phong_ngu_den', '0' , 'POST' ); 
		$phong_tam_tu = JRequest::getInt( 'phong_tam_tu', '0' , 'POST' ); 
		$phong_tam_den = JRequest::getInt( 'phong_tam_den', '0' , 'POST' ); 
		$muc_gia_tu = str_replace(",","",JRequest::getVar( 'muc_gia_tu', '0' , 'POST' )); 
		$muc_gia_den = str_replace(",","",JRequest::getVar( 'muc_gia_den', '0' , 'POST' )); 
		$so_tang_tu = JRequest::getInt( 'so_tang_tu', '0' , 'POST' ); 
		$so_tang_den = JRequest::getInt( 'so_tang_den', '0' , 'POST' ); 
		$chinh_chu = str_replace('on', '1',JRequest::getVar( 'chinh_chu', '0' , 'POST' )); 
		$speak_english = str_replace('on', '1',JRequest::getVar( 'speak_english', '0' , 'POST' )); 
		$nhan_mail = str_replace('on', '1',JRequest::getVar( 'nhan_mail', '0' , 'POST' )); 
		$loai_gia_nc = JRequest::getVar( 'loai_gia_nc', '0' , 'POST' ); 
		$huong_id = JRequest::getVar( 'huong_id', '0' , 'POST' ); 
		$tinh_trang_noi_that =JRequest::getVar( 'tinh_trang_noi_that', '0' , 'POST' ); 
		
		$date 	= time();
		$db 		= 	&JFactory::getDBO();
		
		if(JRequest::getVar('username', '', 'method', 'username')!='' && $itemid == 246){
			$credentials = array();
			$options = null;
			$credentials['username'] = JRequest::getVar('username', '', 'method', 'username');
			$credentials['password'] = JRequest::getVar('password', '', 'post', JREQUEST_ALLOWRAW);
			$mainframe->login($credentials, $options);
			unset($_SESSION['tmp']);
			$this->setRedirect('vi?option=com_u_re&view=manage&layout=yeucau&Itemid=242&msg=fail');
		}
		
		if($id){			
			$sql = "UPDATE jos_yeu_cau_bds SET
			query='$query',ngay_dang='$date',tien_ich_id='$tienich',quan_huyen_id='$quanhuyen',loai_giao_dich_id='$loai_giao_dich_id',loai_bds_id='$loai_bds_id',
			tinh_thanh_id='$tinh_thanh_id',duong_pho='$duong_pho',du_an_id='$du_an_id',dien_tich_su_dung_tu='$dien_tich_su_dung_tu',dien_tich_su_dung_den='$dien_tich_su_dung_den',
			dien_tich_san_tu='$dien_tich_san_tu',dien_tich_san_den='$dien_tich_san_den',phong_ngu_tu='$phong_ngu_tu',phong_ngu_den='$phong_ngu_den',phong_tam_tu='$phong_tam_tu',
			phong_tam_den='$phong_tam_den',muc_gia_tu='$muc_gia_tu',muc_gia_den='$muc_gia_den',so_tang_tu='$so_tang_tu',so_tang_den='$so_tang_den',loai_gia_nc='$loai_gia_nc',
			huong_id='$huong_id',tinh_trang_noi_that='$tinh_trang_noi_that',speak_english='$speak_english',chinh_chu='$chinh_chu',email='$email',name='$name',phone='$phone',nhan_mail='$nhan_mail' WHERE email = '$email'";
			
		}else{	

			if($itemid==247 && $dsat){
				$sql = "UPDATE jos_yeu_cau_bds SET
				query='$query',ngay_dang='$date',tien_ich_id='$tienich',quan_huyen_id='$quanhuyen',loai_giao_dich_id='$loai_giao_dich_id',loai_bds_id='$loai_bds_id',
				tinh_thanh_id='$tinh_thanh_id',duong_pho='$duong_pho',du_an_id='$du_an_id',dien_tich_su_dung_tu='$dien_tich_su_dung_tu',dien_tich_su_dung_den='$dien_tich_su_dung_den',
				dien_tich_san_tu='$dien_tich_san_tu',dien_tich_san_den='$dien_tich_san_den',phong_ngu_tu='$phong_ngu_tu',phong_ngu_den='$phong_ngu_den',phong_tam_tu='$phong_tam_tu',
				phong_tam_den='$phong_tam_den',muc_gia_tu='$muc_gia_tu',muc_gia_den='$muc_gia_den',so_tang_tu='$so_tang_tu',so_tang_den='$so_tang_den',loai_gia_nc='$loai_gia_nc',
				huong_id='$huong_id',tinh_trang_noi_that='$tinh_trang_noi_that',speak_english='$speak_english',chinh_chu='$chinh_chu',name='$name',phone='$phone',nhan_mail='$nhan_mail' WHERE email = '$email'";
			}elseif($itemid==242 && $dsat){
				$sql = "UPDATE jos_yeu_cau_bds SET
				query='$query',ngay_dang='$date',tien_ich_id='$tienich',quan_huyen_id='$quanhuyen',loai_giao_dich_id='$loai_giao_dich_id',loai_bds_id='$loai_bds_id',
				tinh_thanh_id='$tinh_thanh_id',duong_pho='$duong_pho',du_an_id='$du_an_id',dien_tich_su_dung_tu='$dien_tich_su_dung_tu',dien_tich_su_dung_den='$dien_tich_su_dung_den',
				dien_tich_san_tu='$dien_tich_san_tu',dien_tich_san_den='$dien_tich_san_den',phong_ngu_tu='$phong_ngu_tu',phong_ngu_den='$phong_ngu_den',phong_tam_tu='$phong_tam_tu',
				phong_tam_den='$phong_tam_den',muc_gia_tu='$muc_gia_tu',muc_gia_den='$muc_gia_den',so_tang_tu='$so_tang_tu',so_tang_den='$so_tang_den',loai_gia_nc='$loai_gia_nc',
				huong_id='$huong_id',tinh_trang_noi_that='$tinh_trang_noi_that',speak_english='$speak_english',chinh_chu='$chinh_chu',name='$name',phone='$phone',nhan_mail='$nhan_mail' WHERE email = '$email'";
			}		
			else{
				if($userid==0){
					$user_id = U_ReModelProperties::layMaSoNonUser()+1;
					$userid = 'NONUSER_'.$user_id;
				}
				$sql = "insert into jos_yeu_cau_bds (id,query,user_id,ngay_dang,tien_ich_id,quan_huyen_id,loai_giao_dich_id,loai_bds_id,tinh_thanh_id,duong_pho,du_an_id,dien_tich_su_dung_tu,dien_tich_su_dung_den,
				dien_tich_san_tu,dien_tich_san_den,phong_ngu_tu,phong_ngu_den,phong_tam_tu,phong_tam_den,muc_gia_tu,muc_gia_den,so_tang_tu,so_tang_den,loai_gia_nc,huong_id,tinh_trang_noi_that,speak_english,chinh_chu,email,name,phone,nhan_mail) 
				value ('$userid','$query','$userid','$date','$tienich','$quanhuyen','$loai_giao_dich_id','$loai_bds_id','$tinh_thanh_id','$duong_pho','$du_an_id','$dien_tich_su_dung_tu','$dien_tich_su_dung_den',
				'$dien_tich_san_tu','$dien_tich_san_den','$phong_ngu_tu','$phong_ngu_den','$phong_tam_tu','$phong_tam_den','$muc_gia_tu','$muc_gia_den','$so_tang_tu','$so_tang_den','$loai_gia_nc',
				'$huong_id','$tinh_trang_noi_that','$speak_english','$chinh_chu','$email','$name','$phone','$nhan_mail')";
			}
		}
		$db->setQuery($sql);
		if($db->query()){
			$userdn = JRequest::getVar('username', '', 'method', 'username');
			$emaildn = JRequest::getVar('email', '', 'method', '');		
			if($userdn!==''){
				$username = $userdn;
			}else{
				$username = $emaildn;
			}	
			$user = JFactory::getUser();
			if($itemid!=247){
				if($user->get('id')==0 ){
					$credentials = array();
					$options = null;				
					$credentials['username'] = $username;
					$credentials['password'] = JRequest::getVar('password', '', 'post', JREQUEST_ALLOWRAW);
					$mainframe->login($credentials, $options);
					unset($_SESSION['tmp']);
				}
				$this->setRedirect('vi?option=com_u_re&view=manage&layout=yeucau&Itemid=242&msg=success');	
			}
			else{
					unset($_SESSION['tmp']);
					$this->setRedirect('index.php?option=com_content&view=frontpage&Itemid=247&lang=vi&msg=success');
			}	
			$id = U_ReModelProperties::getIdResultByEmai($email);
			//gửi mail thông báo
			$unticklink 	=	JURI::base().'vi?option=com_u_re&task=untickEmail&id='.$id.'&email='.$email.'&tokenuntick='.time();
			$mailfrom 		= $mainframe->getCfg( 'mailfrom' );
			$fromname 		= $mainframe->getCfg( 'fromname' );
			$name		=	JRequest::getVar( 'name', '', 'POST', 'string' );
			
			include_once 'libraries/com_u_re/php/config.php';
			$art_id = U_ReConfig::getValueByKey('TEMPLATEEMAIL','tao_yeu_cau');
			$sqlcontent = "SELECT introtext from jos_content where id = '$art_id'"; 
			$db=& JFactory::getDBO();
			$db->setQuery($sqlcontent);
			$rowcontent=$db->loadRow();
			$noidung = $rowcontent[0];	
			$noidung 	= str_replace("%ten%", $name, $noidung);
			$noidung 	= str_replace("%link%", $unticklink, $noidung);
			$noidung 	= str_replace("images/", JURI::base()."images/", $noidung);			
			$subject	= 'Tạo yêu cầu BĐS tại Mạng lưới Bất động sản';
			//$body		= JText::sprintf('PASSWORD_RESET_CONFIRMATION_EMAIL_TEXT', $sitename, $token, $url);
			$body		=	$noidung;
			JUtility::sendMail($mailfrom, $fromname, $email, $subject, $body,$mod=1);
		}
		else
		{
			if(JRequest::getVar('username', '', 'method', 'username')!=''){
				$credentials = array();
				$options = null;
				$credentials['username'] = JRequest::getVar('username', '', 'method', 'username');
				$credentials['password'] = JRequest::getVar('password', '', 'post', JREQUEST_ALLOWRAW);
				$mainframe->login($credentials, $options);
				unset($_SESSION['tmp']);
				$this->setRedirect('vi?option=com_u_re&view=manage&layout=yeucau&Itemid=242&msg=fail');
			}
		}  
		//dang nhap			
	}
    
	/*
    * Description: Get property by id
    * Author: Minh Chau
    * Version: 1.0
    * Date create: 05-03-2011
    */
	function layMaSoNonUser(){
		$db = JFactory::getDBO();
		//$sql = "select MAX(REPLACE (ID,left(ID,8),'')) from jos_yeu_cau_bds where   left(ID,8) ='NONUSER_'";
		$sql = "SELECT MAX(CONVERT(SUBSTRING_INDEX(id,'_',-1),UNSIGNED INTEGER)) AS num FROM jos_yeu_cau_bds Where  left(ID,8) ='NONUSER_'";
		$db->setQuery($sql);
		$db->query();
		$result = $db->loadResult();
		return $result;
	}
	function getResultByEmai($email){
		$db = &JFactory::getDBO();
		$query = "select count(email) from jos_yeu_cau_bds where email= '$email'";
		$db->setQuery($query);
		$db->query();
		$result = $db->loadResult();
		return $result;
		
	}
	function getIdResultByEmai($email){
		$db = &JFactory::getDBO();
		$query = "select id from jos_yeu_cau_bds where email= '$email'";
		$db->setQuery($query);
		$db->query();
		$result = $db->loadRow();
		return $result[0];
		
	}
    function layChiTietBDS( $id, $language )
    {
    	// $language = ilandCommonUtils::getLanguage();    	
    	$dbConfig = ilandCommonUtils::getSiteDBConfig(); 
    	//U_ReModelProperties::themLuotXemBDS($id);
    	$bds = iland4_layChiTietBDS($dbConfig, $id, $language);
    	//$bds['luot_xem'] = ilandCommonUtils::demLuotXemBDS($id);
    	return $bds;     	
    }
    
    function layChiTietYeuCauBDS($userid){
    	$db = JFactory::getDBO();
		$query = "
		  SELECT *
		    FROM jos_yeu_cau_bds
		    WHERE user_id = '$userid'";
		$db->setQuery($query);
		$data = $db->loadObject();
    	
		return $data;
    }
    
	function layBDSId( $ma_so,$language='vi' )
    {
    	// $language = ilandCommonUtils::getLanguage();    	
    	$dbConfig = ilandCommonUtils::getSiteDBConfig();
    	$condition="ma_so like '$ma_so'";
    	$value = iland4_layDanhSachBDS($dbConfig, 'id', $condition ,1, 1, '', $language);	   	
    	if ( count($value[3]) >= 1 )
			return $value[3][0]['id'];
		else
			return 0;
    	
    }
    
    function setState()
    {
    	
    }
    
    function getName()
    {
    	
    }
    
    /*
    * Description: Lấy danh sách bất động sản
    * Author: Minh Chau
    * Version:
    * Date create: 25-03-2011
    */
    function getListProperties( $returnField, $conditionParam, $currentPage, 
    							$orderBy='', $limit=10 )
    {
    	$language = ilandCommonUtils::getLanguage();
    	$dbConfig = ilandCommonUtils::getSiteDBConfig();
    //	$test = iland4_layDanhSachBDS( $dbConfig, 'ten', $conditionParam,	$currentPage, 
    								//  $limit, $orderBy, $language );
    	return iland4_layDanhSachBDS( $dbConfig, $returnField, $conditionParam,	$currentPage, 
    								  $limit, $orderBy, $language );
    }
    
    /*
    * Description: Lấy danh sách các bất động sản liên quan
    * Author: Minh Chau
    * Version:
    * Date create: 21-03-2011
    * @param:
    * 	conditionParam: chuỗi, bao gồm các điều kiện cần lấy liên quan
    * 	id: id của bất động sản hiện tại
    * 	offset: thứ tự bắt đầu của item cần lấy
    * 	limit: số lượng của danh sách cần lấy.
    * @return: mảng các bất động sản hoặc null. Mỗi bất động sản có các thuộc tính được quy định bởi
    */
    function getSameProperties( $lang, $returnFieldList, $conditionStr, $propertyData, $currentPage )
    {
        $conditionParamStr = ilandCommonUtils::genBDSLQConditionParam( $conditionStr, $propertyData );
        
        //$orderBy = U_ReConfig::getValueByKey( 'PROPERTY', 'bdslq_order' );
        
        /*if ( empty( $orderBy ) )
        {
        	$data = U_ReModelProperties::getListProperties( $returnFieldList, $conditionParamStr,
        												$currentPage );
        }
        else
        {*/
        	$orderBy = 'ABS(phuong_xa_id-' . $propertyData['phuong_xa_id'] 
        			. '), ABS(huong_id-' . $propertyData['huong_id'] 
        			. '), ABS(loai_bds_id-' . $propertyData['loai_bds_id'] . ') ';  
        	$data = U_ReModelProperties::getListProperties( $returnFieldList, $conditionParamStr,
        												$currentPage, $orderBy );
        //}
        
        return $data;
    }
    
    /*
     * Description: lay danh sach loai bat dong san
     * Author: Minh Chau
     * Version:
     * Date create: Apr 9, 2011
     */
    function layDanhSachLoaiBatDongSan( $lang, $tinhThanhId = 1, $quanHuyenId = 219 )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	
    	$db = JFactory::getDBO();
		$query = "
		  SELECT *
		    FROM iland4_loai_bds_$lang";
		$db->setQuery($query);
		$data = $db->loadAssocList();
		
    	// $data = iland4_layDanhSachLoaiBDS( $DBConfig, $lang );
    	
    	$count = count($data);
    	
    	$temp = array();
    	
    	for ($i = 0; $i < $count - 1; $i++)
    	{
    		for ($j = $i + 1; $j < $count; $j++)
    		{
    			if ( intval($data[$i]['ordering']) > intval($data[$j]['ordering']) )
    			{
    				$temp['id'] = $data[$i]['id'];
    				$temp['ten'] = $data[$i]['ten'];
    				$temp['alias'] = $data[$i]['alias'];
    				$temp['ordering'] = $data[$i]['ordering'];
    				
    				$data[$i]['id'] = $data[$j]['id'];
    				$data[$i]['ten'] = $data[$j]['ten'];
    				$data[$i]['alias'] = $data[$j]['alias'];
    				$data[$i]['ordering'] = $data[$j]['ordering'];
    				
    				$data[$j]['id'] = $temp['id'];
    				$data[$j]['ten'] = $temp['ten'];
    				$data[$j]['alias'] = $temp['alias'];
    				$data[$j]['ordering'] = $temp['ordering'];
    			}
    		}	
    	}
    	
      	return $data;
    }
    
    function layDanhSachLoaiBDSTheoQuanHuyen( $lang = 'vi', $quanHuyenId = 219, $tinhThanhId = 0 )
    {
//    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	
    	$db = JFactory::getDBO();
    	
    	$whereQuanHuyen = '';
		if ( !empty ( $quanHuyenId ) )
		{
			$whereQuanHuyen = " AND quan_huyen_id = $quanHuyenId ";
		}
    	
    	$whereTinhThanh = '';
		if ( !empty ( $tinhThanhId ) )
		{
			$whereTinhThanh = " AND tinh_thanh_id = $tinhThanhId ";
		}
		
		$query = " SELECT DISTINCT bds.id as id, loai_bds as ten, bds.ordering as ordering,
					 bds.alias as alias
					FROM iland4_bat_dong_san_$lang, iland4_loai_bds_$lang bds
					WHERE bds.id = loai_bds_id $whereQuanHuyen $whereTinhThanh ORDER BY bds.ordering ";
		
		$db->setQuery($query);
		$data = $db->loadAssocList();
		
    	// $data = iland4_layDanhSachLoaiBDS( $DBConfig, $lang );
    	
//    	$count = count($data);
//    	
//    	$temp = array();
//    	
//    	for ($i = 0; $i < $count - 1; $i++)
//    	{
//    		for ($j = $i + 1; $j < $count; $j++)
//    		{
//    			if ( intval($data[$i]['ordering']) > intval($data[$j]['ordering']) )
//    			{
//    				$temp['id'] = $data[$i]['id'];
//    				$temp['ten'] = $data[$i]['ten'];
//    				$temp['ordering'] = $data[$i]['ordering'];
//    				
//    				$data[$i]['id'] = $data[$j]['id'];
//    				$data[$i]['ten'] = $data[$j]['ten'];
//    				$data[$i]['ordering'] = $data[$j]['ordering'];
//    				
//    				$data[$j]['id'] = $temp['id'];
//    				$data[$j]['ten'] = $temp['ten'];
//    				$data[$j]['ordering'] = $temp['ordering'];
//    			}
//    		}	
//    	}
    	
      	return $data;	
    }
    
    /*
     * Description: Lay danh sach phap ly
     * Author: Minh Chau
     * Version:
     * Date create: Apr 9, 2011
     */
    function layDanhSachPhapLy( $lang )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachPhapLy( $DBConfig, $lang );
    }
    
    /*
     * Description: Lay danh sach huong
     * Author: Minh Chau
     * Version:
     * Date create: Apr 9, 2011
     */
    function layDanhSachHuong( $lang )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachHuong( $DBConfig, $lang );
    }
    
    /*
     * Description: Lay danh sach don vi dien tich
     * Author: Minh Chau
     * Version:
     * Date create: Apr 9, 2011
     
    function layDanhSachDonViDienTich( $language = 'vi' )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$data = iland4_layDanhSachDonViDienTich( $DBConfig, $language);
    	
    	$count = count($data);
    	
    	for ($i = 0; $i < $count - 1; $i++)
    	{
    		for ($j = $i+1; $j < $count; $j++)
    		{
    			if ( $data[$i]['ordering'] > $data[$j]['ordering'] )
    			{
    				$temp = $data[$i];
    				$data[$i] = $data[$j];
    				$data[$j] = $temp;
    			}
    		}	
    	}
    	
    	return $data;
    }
    */
	function layDanhSachDonViDienTich( $language='vi' ,$temp=1)
    {	
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_layDanhSachTinhThanhPho( $DBConfig );
    	
    	$db = JFactory::getDBO();
    	if($temp==1){
			$query = "
		  		SELECT *
		    	FROM iland4_don_vi_dien_tich_vi WHERE id in (1,2) ORDER BY ordering";
    	}else{
    		$query = "
		  		SELECT *
		    	FROM iland4_don_vi_dien_tich_vi WHERE id in (3,4) ORDER BY ordering";
    	}
		$db->setQuery($query);
		$data = $db->loadAssocList();
    	
		return $data;
    }
    
    function layDanhSachDonViTien()
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachDonViTien( $DBConfig );
    }
    
    function layDanhSachQuanHuyen( $townId, $language='vi' )
    {    	
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_layDanhSachQuanHuyen( $DBConfig, $townId );
    	
    	$db = JFactory::getDBO();
		$query = "
		  SELECT *
		    FROM iland4_quan_huyen
		    WHERE tinh_thanh_id = '$townId'";
		$db->setQuery($query);
		$data = $db->loadAssocList();
    	
		return $data;
    }
    
    function layDanhSachTinhThanh( $language='vi' )
    {	
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_layDanhSachTinhThanhPho( $DBConfig );
    	
    	$db = JFactory::getDBO();
		$query = "
		  SELECT *
		    FROM iland4_tinh_thanh";
		$db->setQuery($query);
		$data = $db->loadAssocList();
    	
		return $data;
    }
    
    function layDanhSachLoaiGiaoDich( $language='vi' )
    {
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_layDanhSachLoaiGiaoDich( $DBConfig, $language );
    	
    	$db = JFactory::getDBO();
		$query = "
		  SELECT *
		    FROM iland4_loai_giao_dich_$language";
		$db->setQuery($query);
		$data = $db->loadAssocList();
    	
		return $data;
    }
    
    function layDanhSachViTri( $language='vi' )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_layDanhSachTienIch( $DBConfig, $language );
    }

    function layDanhSachPhuongXa( $quanHuyenId )
    {
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachPhuongXa( $DBConfig, $quanHuyenId );   	
    }

    function layDanhSachDuongPho( $quanHuyenId )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachDuongPho( $DBConfig, $quanHuyenId );
    }
    
    function layDanhSachLoaiTienIch( $language='vi' )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_layDanhSachLoaiTienIch( $DBConfig, $language );
    }
    
    function layDanhSachTienIch( $language='vi' )
    {

    	$DBConfig = ilandCommonUtils::getSiteDBConfig();

    	// lay danh sach loai tien ich
    	$loaiTienIchArr = U_ReModelProperties::layDanhSachLoaiTienIch( $language );

    	// lay danh sach tien ich theo tung loai tien ich
    	$result = array();
    	foreach ( $loaiTienIchArr as $loai )
    	{
    		$temp = array();
    		$temp['data'] = iland4_layDanhSachTienIchTheoLoai( $DBConfig, $loai['id'], 
    																$language );
    		$temp['ten'] = $loai['ten'];
    		$temp['id'] = $loai['id'];
    		$result[] = $temp;		
    	}
    	
    	return $result;
    }
    
	/* lay danh sach cac du an */
    function layDanhSachBatDongSan( $returnField, $page, $limit, $language, $orderby, $noContext = 0 )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$user		= & JFactory::getUser();
    	$result = array() ;
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
    	if ( !$noContext )
		{
    		$bds_id = $mainframe->getUserStateFromRequest( $context.'loai_bds_id', 'loai_bds_id', 0, 'int' );
		}
		else
		{
			$bds_id = JRequest::getVar('loai_bds_id', 0);
		}
    	// $loai_giao_dich_id = $mainframe->getUserStateFromRequest( $context.'loai_giao_dich_id', 'loai_giao_dich_id', 0, 'int' );
    	$town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
		if ( !$noContext )
		{
    		$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
		}
		else 
		{
			$search = $_POST['search'];
		}
		
		if ( $search == 'Từ khóa tìm kiếm' )
		{
			$search = '';
		}
		
		if ( !$noContext )
		{
			$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		}
		else 
		{
			//$published = $_POST['published'];
			$published = JRequest::getVar('published', -1);
		}
		
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
		$spam       = $mainframe->getUserStateFromRequest( $context.'spam', 'spam', -1, 'int' );
		// $conditionParams =  '' ; 
  // print_r('loai_giao_dich_id'.$loai_giao_dich_id);
		$_SESSION['cat']='';
		$cat=JFactory::getURI()->getVar("cat");
		if ($cat != NULL)
		{
			$_SESSION['cat']= $cat;	
		}
		$loaiBDS = $_SESSION['cat'];
		$Kindwhere='';
		switch ( $loaiBDS )
		{
			case 'selling' :  $Kindwhere = " loai_giao_dich_id=1";
			break;
			case 'renting' :  $Kindwhere = " loai_giao_dich_id=2";
			break;
			case 'needbuying' :  $Kindwhere = " loai_giao_dich_id=3";
			break;
			case 'needrenting' :  $Kindwhere = " loai_giao_dich_id=4";
			break;
			// default: $Kindwhere = " loai_bds_id =2";
			// break;
		}	
	
		// print_r($loaiBDS);
		if ( $Kindwhere )
		{
    		$conditionParams =  $Kindwhere ; 
		}
		else
		{
			$conditionParams = '1 ';
		}
    	//$loai_du_an_id = JFactory::getURI()->getVar("loai_du_an_id");
    	
		if ( $user->usertype != 'Super Administrator' )
		{
			$conditionParams .= ' AND ma_nguoi_dang = '.$user->id;
		}
		if( $emphasis != -1 ) $conditionParams .= ' AND noi_bat = '.$emphasis;
		if( $spam != -1 ) $conditionParams .= ' AND bao_cao_sai_pham = '.$spam;
		if ( $published!=-1 )  $conditionParams .= ' AND hien_thi_ra_ngoai = '.$published;
		if ( $town_id!= 0 )  $conditionParams .= ' AND tinh_thanh_id = '.$town_id;
		if ( $area_id!= 0 &&  $town_id!= 0 )  $conditionParams .= ' AND quan_huyen_id = '.$area_id;
		//if ( $type_id!= 0 )  $conditionParams .= ' AND loai_du_an_id = '.$type_id;
		
		if ( $search!=NULL )  
		{
			$conditionParams .= " AND (tieu_de LIKE '%". $search ."%' OR id = '". $search ."')";	
		}
		
		//if( $loai_du_an_id ) $conditionParams .= ' AND loai_du_an_id = '.$loai_du_an_id;
		if ( $bds_id!= 0 )  $conditionParams .= ' AND loai_bds_id = '.$bds_id;
		$result['search'] = $search ;
		$result['town_id'] = $town_id ;
		$result['area_id'] = $area_id ;
		$result['published'] = $published ;
		$result['emphasis'] = $emphasis ;
		$result['spam'] = $spam ;
		$result['loai_bds_id'] = $bds_id;

		$result['rows'] = iland4_layDanhSachBDS($DBConfig, $returnField, $conditionParams ,$page, $limit, $orderby, $language);
		return $result;
		
    }
    
    /*
    * Description: parse danh sach tien ich 
    * Author: Minh Chau
    * Version: 
    * Date create: 24-04-2011
    */
    function fetchTienIchTemplate( $tienIchIds, $templatePath, $templateName, $listAllFlag = true, $lang)
    {
    	// TODO: remove hard code
//    	$tienIchIds = '1-1,1-2,2-6';
    	$data = null;
    	// $lang = ilandCommonUtils::getLanguage();		
    	
		// lay tat ca du lieu tien ich
		$allList = U_ReModelProperties::layDanhSachTienIch( $lang );
		$data = U_ReModelProperties::parseTienIch( $tienIchIds, $allList, $listAllFlag );

		// fetch template tien ich
		$template = new JView();
		$template->addTemplatePath( $templatePath );
		$template->assignRef( 'allFlag', $listAllFlag );
		$template->assignRef( 'tienIchAllList', $data );
		$template->setLayout( $templateName );

		return $template->loadTemplate();		
		
		return $data;
		
    }
    
    /*
    * Description: Parse chuoi tien ich => mang
    * 	tienIchIds: id1-id11,id1-id12,id2-id21 .... 
    * Author: Minh Chau
    * Version: 
    * Date create: 24-04-2011
    */
    function parseTienIch( $tienIchIds, $tienIchAllList, $allFlag )
    {
    	
    	$items = explode( ',', $tienIchIds );
    	$result = array();
    	
    	$data = array();
    	
    	foreach ( $items as $item )
    	{
    		// $temp[0] = id loai
    		// $temp[1] = id tien ich
    		$temp = explode( '-', $item );
    		$countAll = count($tienIchAllList);
    		for ( $i = 0; $i < $countAll; $i++ )
    		{
    			if ( $tienIchAllList[$i]['id'] == $temp[0] )
	    		{
	    			$count = count( $tienIchAllList[$i]['data'] );
	    			for ( $j = 0; $j < $count; $j++ )
	    			{
		    			if ( $tienIchAllList[$i]['data'][$j]['id'] == $temp[1] )
		    			{
		    				if ( $allFlag )
		    				{
		    					$tienIchAllList[$i]['data'][$j]['checked'] = true;
		    				}
		    				else 
		    				{
		    					$result[$i]['data'][$j] = $tienIchAllList[$i]['data'][$j];
		    					$result[$i]['ten'] = $tienIchAllList[$i]['ten'];
		    				}
		    			}		
		    			else if ( empty( $tienIchAllList[$i]['data'][$j]['checked'] ) )
		    			{
		    				$tienIchAllList[$i]['data'][$j]['checked'] = false;
		    			}
	    			}
	    		}
    		}	
    	}
    	
    	if ( $allFlag )
    	{
    		return $tienIchAllList;
    	}
    	else 
    	{
	    	return $result;
    	}
    }
    
	function getUpdateProperties($id,$param, $language)
    {
    	$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
	    return iland4_suaBDS($DBConfig, $id, $param, $language);
    }
	function updateSaiPham($id)
    { 
		$param = " bao_cao_sai_pham = 1";   	
		getUpdateProperties($id, $param, $this->getLanguage());
	}
    function getPropertiestDelete( $arrayid )
    {    	
		jimport('joomla.filesystem.folder');
		global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['property_image_path'];
		$ArrayLanguage = ilandCommonUtils::getArrayLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();    	
		$idvalue= '';
		foreach ( $arrayid as $id )
		{
			//xoa thu muc hinh anh cua bds			
			$dirimg = JPATH_ROOT.DS.$propertyImagePath.DS.$id ;
			if( JFolder::exists( $dirimg ) ) JFolder::delete( $dirimg );		
			
				$idvalue .= ",";
				$idvalue .=  $id;					
		}

		$giatriid = substr ( $idvalue,1);
		
		// xoa du lieu o database
  	  return  iland4_xoaBDS($DBConfig, $giatriid, $ArrayLanguage);
    }
    
	function ordering( $id, $language)
	{
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$ordering = 'ordering_'.$id;
		$orderingvalue = JRequest::getVar( "$ordering", '' );
		$paramvalue = "ordering = $orderingvalue";
		
		iland4_suaBDS($DBConfig, $id,$paramvalue, $language);
	}
	
	function setLuotXem( $id, $language)
	{
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$luotXemName = 'luot_xem_'.$id;
		$luotXemValue = JRequest::getVar( "$luotXemName", '' );
		$paramvalue = "luot_xem = $luotXemValue";
		
		iland4_suaBDS($DBConfig, $id,$paramvalue, $language);
	}
	
	
	function getCustomFieldTabla($id,$field,$table){
		$db = JFactory::getDBO();
		$sql = "Select $field from $table where id=$id";
		$db->setQuery($sql);
		$result= $db->loadRow();
		return $result[0];		
	}
	
	function saveUser(){
		global $mainframe;
		$username   =	JRequest::getVar( 'email', '', 'POST', 'string' );
		$password	=	JRequest::getVar( 'password', '', 'POST', 'string' );
		$password2	=	JRequest::getVar( 'password2', '', 'POST', 'string' );
		$name		=	JRequest::getVar( 'name', '', 'POST', 'string' );
		$email		=	JRequest::getVar( 'email', '', 'POST', 'string' );
		$address	=	JRequest::getVar( 'address', '', 'POST', 'string' );
		$phone		=	JRequest::getVar( 'phone', '', 'POST', 'string' );
		$tim		=	date('Y-d-m H:i:s');
		
		//$salt  = JUserHelper::genRandomPassword(32);
		//$crypt = JUserHelper::getCryptedPassword($password, $salt);
		$pass  	=	md5($password);
		
		if(JRequest::getVar( 'chinh_chu', '', 'POST', 'string' ) == 'on'){
			$chinh_chu = 0;
			$groupid= 34;
			$usertype = "Mô giới";
		}
		else {
			$chinh_chu = 1;
			$groupid= 35;
			$usertype = "Chính chủ";
			
		}
		if(JRequest::getVar( 'speak_english', '', 'POST', 'string' ) == 'on'){
			$speak_english = 1;
		}
		else {
			$speak_english = 0;
		}
		if(JRequest::getVar( 'nhan_mail', '', 'POST', 'string' ) == 'on'){
			$nhan_mail = 1;
		}
		else {
			$nhan_mail = 0;
		}
		
		$db 		= 	&JFactory::getDBO();
		$query		=	"insert into jos_users (username,password,name,email,phone,address,usertype,gid,registerDate,chinh_chu,speak_english,nhan_mail) 
						value ('$username','$pass','$name','$email','$phone','$address','$usertype',$groupid,'$tim',$chinh_chu,$speak_english,$nhan_mail)";
		$db->setQuery($query);
		$db->query();
		$id			=	$db->insertid();
		
		$sql		=	"insert into jos_core_acl_aro (section_value,value,name) value ('users','$id','$name')";
		$db->setQuery($sql);
		$db->query();
		$ids		=	$db->insertid();
		$sql1		=	"insert into jos_core_acl_groups_aro_map (group_id,aro_id) value ($groupid,$ids)";
		
		$db->setQuery($sql1);
		$db->query();
		
		$mailfrom 		= $mainframe->getCfg( 'mailfrom' );
		$fromname 		= $mainframe->getCfg( 'fromname' );
		include_once 'libraries/com_u_re/php/config.php';
		$art_id = U_ReConfig::getValueByKey('TEMPLATEEMAIL','dang_ky');
		$sqlcontent = "SELECT introtext from jos_content where id = '$art_id'"; 
		$db=& JFactory::getDBO();
		$db->setQuery($sqlcontent);
		$rowcontent=$db->loadRow();
		$noidung = $rowcontent[0];	
		
		$noidung 	= str_replace("%tên%", $name, $noidung);images/
		$noidung 	= str_replace("images/", JURI::base()."images/", $noidung);
		$subject	= 'Chào mừng đến với website Mạng lưới Bất động sản';
		//$body		= JText::sprintf('PASSWORD_RESET_CONFIRMATION_EMAIL_TEXT', $sitename, $token, $url);
		$body		=	$noidung;
		JUtility::sendMail($mailfrom, $fromname, $email, $subject, $body,$mod=1);
		
		//$mainframe->redirect('index.php');
		//return $id;
	}
	
	function getIdUserByUserName($username){
		$db 		= 	&JFactory::getDBO();
		$query		=	"select id from jos_users where email = '$username'";
		$db->setQuery($query);
		$result= $db->loadRow();
		return $result[0];		
	}
	
	/*
	* Description: Luu bat dong san khi dang tin 
	* Author: Minh Chau
	* Version: 
	* Date create: 11-05-2011
	*/
	function save()
    {     
    	global $mainframe;
    	
    	if(isset($_POST['tks'])){    	
    		U_ReModelProperties::saveUser();    	
    		$nguoidang = U_ReModelProperties::getIdUserByUserName(JRequest::getVar( 'email', '', 'POST', 'string' ));;
    	}else{
    		$nguoidang=  JRequest::getVar( 'customer', '0' , 'POST' );  		
    	}
    	$id =  JRequest::getInt( 'id', '' );
    	// lay gia
    	// TODO: remove hardcode 8 7, 1000000, 1000000000
		
        $priceInt=JRequest::getVar( 'gia', '0', 'POST' );

		$curprice = str_replace(",", "", $priceInt);
     	if(JRequest::getInt( 'price_unit', 0 ,'POST' )=='8')
        {
	        $price_unit = '1';
	        $price= $curprice * 1000000;
	        $donvitien ='VND';
        }
        else if(JRequest::getInt( 'price_unit', 0 , 'POST' )=='7')
     	{
	        $price_unit = '1';
	        $price= $curprice * 1000000000;
	        $donvitien ='VND';
        }
        else
        {
        	
	       $price_unit= JRequest::getInt( 'price_unit', 0 , 'POST' );
	       $price=str_replace(",", "", $priceInt);
		 //   $price=JRequest::getFloat( 'gia', 0.0, 'POST' );
	       $donvitien = JRequest::getVar( 'vi_don_vi_tien', 0 , 'POST' );
        }
        
		$ngaydang = ''.time();
        
		$so_thu_tu = ''. ilandCommonUtils::layOrdering('bat_dong_san');
		$kind_name = U_ReModelProperties::getCustomFieldTabla(JRequest::getVar( 'kind_id', 0 , 'POST' ), 'ten', 'iland4_loai_giao_dich_vi');
		$type_name = U_ReModelProperties::getCustomFieldTabla(JRequest::getVar( 'type_id', 0 , 'POST' ), 'ten', 'iland4_loai_bds_vi');
		$tinh_name = U_ReModelProperties::getCustomFieldTabla(JRequest::getVar( 'town_id', 0 , 'POST' ), 'ten', 'iland4_tinh_thanh');
		$quan_name = U_ReModelProperties::getCustomFieldTabla(JRequest::getVar( 'area_id', 0 , 'POST' ), 'ten', 'iland4_quan_huyen');
		$duan	   = str_replace('Vui lòng chọn', '',JRequest::getVar( 'du_an_text_value', '' , 'POST', 'string', JREQUEST_ALLOWRAW  ));
		if($duan!==''){
			$duan= " ".$duan;
		}
		else{
			$duan = '';
		}
		$tieude    = $kind_name." ".$type_name.$duan.", ".$quan_name.", ".$tinh_name;  
		$alias     = unicode($tieude);
        $datas_vi = array(

        	'ma_so'        => JRequest::getVar( 'properties_key', 0 , 'POST' ),             
	        'loai_bds_id'        => JRequest::getVar( 'type_id', 0 , 'POST' ),
	        'loai_giao_dich_id'        => JRequest::getVar( 'kind_id', 0 , 'POST' ),
	        'phap_ly'   => JRequest::getVar( 'phap_ly', '' , 'POST' , 'string', JREQUEST_ALLOWRAW ),
	        'don_vi_dien_tich_id'   => JRequest::getVar( 'price_area_unit', 0 , 'POST' ),
	        'moi_nhat'       => JRequest::getVar( 'moi_nhat', '1', 'POST' , 'string'),
	        'noi_bat'       => JRequest::getVar( 'noi_bat', '0', 'POST' , 'string'),
        
        	'da_ban'       => JRequest::getVar( 'da_ban', '0', 'POST' , 'string'),
        
	        'kinh_do'        => JRequest::getVar( 'map_lat', '0' , 'POST' ),
	        'vi_do'        => JRequest::getVar( 'map_lng', '0' , 'POST' ),
	        'hien_thi_ra_ngoai'        => JRequest::getVar( 'hien_thi_ra_ngoai','0', 'POST' ),
        	'don_vi_tien_id'   => ''.$price_unit,
	        'tinh_thanh_id'   => JRequest::getVar( 'town_id', '0' , 'POST' ),
	        'quan_huyen_id'        => JRequest::getVar( 'area_id', '0' , 'POST' ),       
	        'huong_id'        => ''.JRequest::getVar( 'direction_id', '0' , 'POST' ),
        	'huong'        => ''.JRequest::getVar( 'vi_huong', '' , 'POST' ),
        	'gia'        => ''.$price,
        	'loai_tin_id'        =>  ''.JRequest::getVar( 'loai_tin_id', '1' , 'POST' ),
        
        	'truong'        => JRequest::getVar( 'truong', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'benh_vien'        => JRequest::getVar( 'benhvien', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'sieu_thi'        => JRequest::getVar( 'sieuthi', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	
        	'chinh_chu'  => str_replace('on', '0',JRequest::getVar( 'chinh_chu', '1' , 'POST' )),
        	'noi_that'  => JRequest::getVar( 'noi_that', '0' , 'POST' , 'string', JREQUEST_ALLOWRAW ),
        	'speak_english'  => str_replace('on', '1',JRequest::getVar( 'speak_english', '0' , 'POST' )),
	        'dien_thoai_nguoi_lien_he'        => JRequest::getVar( 'phone_vl', '' , 'POST' ),
        	'so_tang'        => JRequest::getVar( 'so_tang', '0' , 'POST' ),
        	'dien_tich_khuon_vien'        => JRequest::getVar( 'dien_tich_khuon_vien', '0' , 'POST' ), 
	        'dien_tich_su_dung'        => JRequest::getVar( 'dien_tich_su_dung', '0' , 'POST' ),
        	//'dien_tich_khuon_vien_rong_truoc' => JRequest::getVar( 'dien_tich_khuon_vien_rong_truoc', '0' , 'POST' ),
	        'dien_tich_khuon_vien_rong'        => JRequest::getVar( 'dien_tich_khuon_vien_rong', '0' , 'POST' ),
	        'dien_tich_khuon_vien_dai'        => JRequest::getVar( 'dien_tich_khuon_vien_dai', '0' , 'POST' ),        	
	        'dien_tich_xay_dung_dai'        => JRequest::getVar( 'dien_tich_xay_dung_dai', '0' , 'POST' ),       
      	    'dien_tich_xay_dung_rong'        => JRequest::getVar( 'dien_tich_xay_dung_rong', '0' , 'POST' ), 
	      	'tien_ich_id'     => JRequest::getVar( 'advantagesGetValue','0', 'POST'),
	     	'ordering' =>  $so_thu_tu,
	        'phong_khach'        => JRequest::getVar( 'phong_khach', '0' , 'POST' ),
	        'phong_ngu'        => JRequest::getVar( 'phong_ngu', '0' , 'POST' ),
	        'phong_tam'        => JRequest::getVar( 'phong_tam', '0' , 'POST' ),
	        'phong_khac'        => JRequest::getVar( 'phong_khac', '0' , 'POST' ),
	        // 'ngay_dang' => $ngaydang,
         	// 'ngay_chinh_sua' => $ngaydang,
	       	'tieu_de_trang'        => JRequest::getVar( 'tieu_de_trang', '' , 'POST' ),        
	        'tu_khoa_trang'        => JRequest::getVar( 'tu_khoa_trang', '' , 'POST' ),
	        'mo_ta_trang'        => JRequest::getVar( 'mo_ta_trang', '' , 'POST' ),   
       
        	// alias SEF
        	'alias' => $alias,
	        //* ngon ngu */	    
	        
			'tieu_de'        => $tieude, // vanganh sua
	        'dia_chi'        => JRequest::getVar( 'vi_hidden_address', '' , 'POST' ),        
        	'ma_nguoi_dang'        => $nguoidang,
	        'ten_nguoi_lien_he'        => JRequest::getVar( 'name_vl', '' , 'POST' ),
         	'email_nguoi_lien_he'        => JRequest::getVar( 'email_vl', '' , 'POST' ),        
	        'dia_chi_nguoi_lien_he'        => JRequest::getVar( 'address_vl', '' , 'POST' ),
	        'ghi_chu_nguoi_lien_he'        => JRequest::getVar( 'ghichu', '' , 'POST' ),			
	      	'mo_ta_chi_tiet'    => JRequest::getVar( 'vi_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
	        'loai_bds'        => JRequest::getVar( 'vi_loai_giao_dich', '' , 'POST' ),
	        'loai_giao_dich'        => JRequest::getVar( 'vi_loai_bds', '' , 'POST' ),
	        'don_vi_dien_tich'   => JRequest::getVar( 'vi_don_vi_dien_tich', '0' , 'POST' ),
        	'don_vi_tien'   => $donvitien,
	        'tinh_thanh'        => JRequest::getVar( 'vi_tinh_thanh', '' , 'POST' ),
	        'quan_huyen'        => JRequest::getVar( 'vi_quan_huyen', '' , 'POST' ),
        	//'phuong_xa_id'        => JRequest::getVar( 'phuong_xa_id', '0' , 'POST' ),
        	'phuong_xa'        => JRequest::getVar( 'phuong_xa', '' , 'POST' ),
        	//'duong_pho_id'        => JRequest::getVar( 'duong_pho_id', '0' , 'POST' ),
        	'duong_pho'        => JRequest::getVar('dia_chi', '' , 'POST' , 'string', JREQUEST_ALLOWRAW  ),
        	'so_nha'        => JRequest::getVar( 'so_nha', '' , 'POST' ),
	        'thong_tin_tong_quan'        => JRequest::getVar( 'vi_pro_total_info', '' , 'POST' ),
        
        	'du_an' => str_replace('Vui lòng chọn', '',JRequest::getVar( 'du_an_text_value', '' , 'POST', 'string', JREQUEST_ALLOWRAW  )),
        	'du_an_id' => JRequest::getVar( 'du_an_id', '' , 'POST' ),
        );
        // set default sef
        if ( empty($datas_vi['alias']) )
        {
        	$datas_vi['alias'] = str_replace(' ', '-', $datas_vi['tieu_de']);
        }
        
        if ( !empty( $datas_vi['mo_ta_chi_tiet'] ) )
        {
        	$datas_vi['mo_ta_chi_tiet'] = ilandCommonUtils::stripWordContent( $datas_vi['mo_ta_chi_tiet'] );
        }
       
        
    	//vanganh them
    	$datas_vi['tong_gia_tri']='0';
    	 
        if($datas_vi['don_vi_dien_tich']=='m2'){
        	if(is_numeric($datas_vi['gia'])&&is_numeric($datas_vi['dien_tich_khuon_vien_rong'])&&is_numeric($datas_vi['dien_tich_khuon_vien_dai']))
        		$datas_vi['tong_gia_tri']=''.($datas_vi['gia']*$datas_vi['dien_tich_khuon_vien_rong']*$datas_vi['dien_tich_khuon_vien_dai']);	
        		
        }else{
        	$datas_vi['tong_gia_tri']=$datas_vi['gia'];
        }
       
    	//xử lý giá thêm 2 field giá m2 và giá nguyên căn Thông Thêm.
    	
        if($datas_vi['don_vi_dien_tich_id']==1||$datas_vi['don_vi_dien_tich_id']==3){
        	$datas_vi['gia_m2'] = $datas_vi['gia'];
        	$datas_vi['gia_nguyen_can'] = ''.round($datas_vi['gia']*$datas_vi['dien_tich_su_dung'],-3);
        }
        else{
        	$datas_vi['gia_nguyen_can'] = $datas_vi['gia'];
        	if($datas_vi['dien_tich_su_dung']!=0){
        		$datas_vi['gia_m2'] =  ''.round($datas_vi['gia']/$datas_vi['dien_tich_su_dung'],-3);
        	}else{
        		$datas_vi['gia_m2'] = '0';
        	}
        	
        }
        // web vhl tat phuong xa di      
  	 $ti ='-';
     if ( $id )
      {
      	
      	//tieng viet
      	if($datas_vi['ma_so']=='0' || $datas_vi['ma_so']=='' ){
        	$datas_vi['ma_so'] = ''. $id;
        }
		$DataValue = array_values($datas_vi);
		$DataKey = array_keys($datas_vi);
		$i=0;
		$Keyvalue = '';
		foreach ( $DataKey as $data )
		{
			
			$Keyvalue .= ",";
			$Keyvalue .= $data;
			$Keyvalue .= " = ";
			$Keyvalue .= "'$DataValue[$i]'";
			$i++;
		}
		$paramvi = substr($Keyvalue,1);	
		U_ReModelProperties::getUpdateProperties($id, $paramvi, 'vi');
		
      }
      else
      {
		   	//	them bds
      	    
      	    // 'ngay_dang' => $ngaydang,
         	// 'ngay_chinh_sua' => $ngaydang,
         	// them ngay dang va ngay chinh sua
         	$datas_vi['ngay_dang'] = $ngaydang;
         	$datas_vi['ngay_chinh_sua'] = $ngaydang;
         	
      		if($datas_vi['ma_so']=='0' || $datas_vi['ma_so']=='' )
      		{
        		$datas_vi['ma_so'] = ''. ilandCommonUtils::layMaSo();
        	}
	        $DataKey = array_keys($datas_vi);
	        $Keyvalue = '';
	    	foreach ($DataKey as $Datavalue )
	    	{
	    		$Keyvalue .= ',';
	    		$Keyvalue .= $Datavalue;
	       	}       		       	
	       	$paramvi = substr($Keyvalue,1);
	       	$insertId = U_ReModelProperties::themBDS($paramvi, $datas_vi, 'vi');
	       	if($insertId!=0){
	       		$msg = "Tin của bạn đã được lưu thành công với mã số: <b>".$insertId."</b>";
	       	}
      }      
     
       if ( $id )
	   {
   	   		$insertId = $id;
	   }
	   if ( !U_ReModelProperties::uploadImages($insertId) )
	   {
			JError::raiseWarning( 200, 'Image upload error' );
            return false;
	   }
	   // echo"<script>alert('Đăng nhập thành công ');document.location.href='index.php'</script>";
	   // tro link sau khi da dang tin bds	  
	 
			 
   		 switch (  $datas_vi['loai_giao_dich_id'] )
		{
			case 1 :  $l_loai_giao_dich = "selling";
			break;
			case 2 :  $l_loai_giao_dich = "renting";
			break;
			case 3 :  $l_loai_giao_dich = "needbuying";
			break;
			case 4 :  $l_loai_giao_dich = "needrenting";
			break;
			default: $l_loai_giao_dich = "selling";
			break;
		}
		$dd = JRequest::getVar( 're_link', 0 , 'POST' );
	   if( $dd  )
		{
			if($dd == 1)
				{
					
					if(isset($_POST['tkslogin'])||isset($_POST['tks'])){
						$credentials = array();
						$options = null;
						$credentials['username'] = JRequest::getVar('username', '', 'method', '');
						$credentials['password'] = JRequest::getVar('password', '', 'post', JREQUEST_ALLOWRAW);
						$mainframe->login($credentials, $options);		
					}
					$ms = "<script>alert('Tin của bạn đã lưu thành công, nhưng phải đợi quản trị duyệt mới có thể hiển thị ra ngoài')</script>";
					$mainframe->redirect('index.php?option=com_u_re&task=viewDetail&view=properties&preview=1&Itemid=186&id='.$insertId,$msg.$ms);
				}
			else
			if($dd == 2)
	//			{
	//				echo "<script>alert('Tin đã được đăng')</script>";
	//				$mainframe->redirect('index.php?option=com_jea&view=manage&Itemid=8&lang=vi');
	//
	//			}
	//			else
				{
					// echo "<script>alert('Tin đã được lưu')</script>";
					//$mainframe->redirect('index.php?option=com_u_re&view=manage&Itemid=8');
					//$currentSession = JFactory::getSession();
					$userdn = JRequest::getVar('username', '', 'method', 'username');
					$emaildn = JRequest::getVar('email', '', 'method', '');		
					if($userdn!==''){
						$username = $userdn;
					}else{
						$username = $emaildn;
					}
					
					if(isset($_POST['tkslogin'])||isset($_POST['tks'])){
						$credentials = array();
						$options = null;
						$credentials['username'] = $username;
						$credentials['password'] = JRequest::getVar('password', '', 'post', JREQUEST_ALLOWRAW);
						$mainframe->login($credentials, $options);
						
					}	
					$user=JFactory::getUser();
					if($user->id != 0){
						$mainframe->redirect('index.php?option=com_u_re&view=manage&Itemid=8',$msg);
					}else{			
					//if(isset($_POST['tkslogin'])){
						//if($insertId != 0){
							$ms = "<script>alert('Tin của bạn đã lưu thành công, nhưng phải đợi quản trị duyệt mới có thể hiển thị ra ngoài')</script>";
						//}
						$mainframe->redirect('index.php?option=com_u_re&view=manage&layout=form&task2=noregister&Itemid=226',$msg.$ms);
					//}
					//else{
					//	$mainframe->redirect('index.php');
					}
				}
				else 
				{
					$mainframe->redirect('index.php?option=com_jea&controller=properties');
				}
		}
			
    }
    
    function themBDS($paramfeild, $paramvalue, $language )
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_themBDS($DBConfig, $paramfeild, $paramvalue, $language);
    }
    
    /* ------------------ Protected methods ----------------------- */
    
    
	
	
	function create_watermark($source_file_path, $output_file_path,$image,$path)
	{
	    list($source_width, $source_height, $source_type) = getimagesize($source_file_path);
	    if ($source_type === NULL) {
	        return false;
	    }
	    switch ($source_type) {
	        case IMAGETYPE_GIF:
	            $source_gd_image = imagecreatefromgif($source_file_path);
	            break;
	        case IMAGETYPE_JPEG:
	            $source_gd_image = imagecreatefromjpeg($source_file_path);
	            break;
	        case IMAGETYPE_PNG:
	            $source_gd_image = imagecreatefrompng($source_file_path);
	            break;
	        default:
	            return false;
	    }
	    $imagewatermark = $image;
	    $folderwatermark = $path;
	    $overlay_gd_image = imagecreatefrompng(JPATH_ROOT.DS.$folderwatermark.$imagewatermark);
	    $overlay_width = imagesx($overlay_gd_image);
	    $overlay_height = imagesy($overlay_gd_image);
	    imagecopy($source_gd_image,$overlay_gd_image,($source_width-$overlay_width)/2,($source_height-$overlay_height)/2,0,0,$overlay_width,$overlay_height);
	    imagejpeg($source_gd_image, $output_file_path, 100);
	    imagedestroy($source_gd_image);
	    imagedestroy($overlay_gd_image);
	}
	
	/*
	 * Uploaded file processing function
	 */
	
	
    function uploadImages( $id=null )
    {
    	if (!$id) return false;
    	
   		require_once JPATH_ROOT.DS.'/libraries/com_u_re/Http_File.php';
    	jimport('joomla.filesystem.folder');
    	
    	global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['property_image_path'];
		
    	$base_upload_dir = JPATH_ROOT.DS .$propertyImagePath;

    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP') ;
    	
		$mainImage   = new Http_File( JRequest::getVar( 'main_image', array(), 'files', 'array')) ;
		$i = 0;
		$secondImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'secondaries_images' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$secondImages[] = new Http_File( $tempImage );
				$i++;
			}
			else
			{
				break;
			} 	
		}
    
        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS . $id;
       
        $previewWidth = $u_reGlobalConfig['IMAGE']['image_width'];
        $thumbnailWidth = $u_reGlobalConfig['IMAGE']['thumbnail_width'];
        $thumbnailHeight = $u_reGlobalConfig['IMAGE']['thumbnail_height']; //default max height : 90px
		$largeWidth = $u_reGlobalConfig['IMAGE']['image_large_width'];
		$largeHeight = $u_reGlobalConfig['IMAGE']['image_large_height'];
        
        $jpgQuality = 90 ;

        //main image
        if ( $mainImage->isPosted() )
        {
            if ( !JFolder::exists($upload_dir) ) 
            { 
            	JFolder::create($upload_dir);
            }
            	
            $mainImage->setValidExtensions( $validExtensions );
            $mainImage->setName('main.jpg');
            
            if( !$fileName = $mainImage->moveTo($upload_dir) )
            {
                JError::raiseWarning( 200, JText::_( $mainImage->getError() ) );
            }
            global $u_reGlobalConfig;
            //make preview
            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'preview.jpg',
                                 null,
                                 $previewWidth,
                                 $jpgQuality );

			
            U_ReModelProperties::create_watermark($upload_dir.DS.'preview.jpg', $upload_dir.DS.'preview.jpg',$u_reGlobalConfig['WATERMARK']['image_preview_name'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;                  
                                 
            //make min
            U_ReModelProperties::_resizeImage( $upload_dir.DS.'preview.jpg',
                                 $upload_dir.DS.'min.jpg',
                                 $thumbnailHeight,
                                 $thumbnailWidth,
                                 $jpgQuality );
                                 
            U_ReModelProperties::create_watermark($upload_dir.DS.'min.jpg', $upload_dir.DS.'min.jpg',$u_reGlobalConfig['WATERMARK']['image_name_min'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;
             
            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'large.jpg',
                                 $largeHeight,
                                 $largeWidth,
                                 $jpgQuality );
            U_ReModelProperties::create_watermark($upload_dir.DS.'large.jpg', $upload_dir.DS.'large.jpg',$u_reGlobalConfig['WATERMARK']['image_preview_name'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;
        }
		
		foreach ( $secondImages as $secondImage )
		{
			if( $secondImage->isPosted() )
			{
			    $upload_dir = $base_upload_dir . DS . $id;
	            $upload_dir = $upload_dir.DS.'secondary';
	            $preview_dir = $upload_dir.DS.'preview' ;
	            $thumbnail_dir = $upload_dir.DS.'min' ;
	            $largeDir = $upload_dir.DS.'large' ;
		        if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
		        if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
		        if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
				if ( !JFolder::exists($largeDir) ) { JFolder::create($largeDir); }
	            $secondImage->setValidExtensions( $validExtensions );
	            $secondImage->nameToSafe();
			            
	            if(! $fileName = $secondImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $secondImage->getError() ) );
	                return false;
	            }
	          
	            //make preview
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
					                                 $preview_dir.DS.$fileName,
			                                 null,
			                                 $previewWidth,
			                                 $jpgQuality );
			    U_ReModelProperties::create_watermark($preview_dir.DS.$fileName, $preview_dir.DS.$fileName,$u_reGlobalConfig['WATERMARK']['image_preview_name'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;        
			    //make min
	            U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
			                                 $thumbnail_dir.DS.$fileName,
			                                 $thumbnailHeight,
			                                 $thumbnailWidth,
			                                 $jpgQuality );
			    U_ReModelProperties::create_watermark($thumbnail_dir.DS.$fileName, $thumbnail_dir.DS.$fileName,$u_reGlobalConfig['WATERMARK']['image_name_min'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;                            
			    // make large
			    U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
                                 $largeDir.DS.$fileName,
                                 $largeHeight,
                                 $largeWidth,
                                 $jpgQuality );
	        }
		}
		
		// upload cac hinh anh dac biet: so do mat bang, noi that, ngoai that
    	$i = 0;
		$sdmbImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'so_do_mat_bang_img' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$sdmbImages[] = new Http_File( $tempImage );
				$i++;
			}
			else
			{
				break;
			} 	
		}
		
        $upload_dir = $base_upload_dir . DS . $id;
	    $upload_dir = $upload_dir.DS.'sodomatbang';
        $preview_dir = $upload_dir.DS.'preview' ;
        $thumbnail_dir = $upload_dir.DS.'min' ;
        $largeDir = $upload_dir.DS.'large' ;
        if ( !JFolder::exists($upload_dir) ) 
        { 
        	JFolder::create($upload_dir); 
        }
        if ( !JFolder::exists($preview_dir) ) 
        { 
        	JFolder::create($preview_dir); 
        }
        if ( !JFolder::exists($thumbnail_dir) ) 
        { 
        	JFolder::create($thumbnail_dir); 
        }
		if ( !JFolder::exists($largeDir) ) 
		{ 
			JFolder::create($largeDir); 
		}
	    
	    foreach ( $sdmbImages as $sdmbImage )
		{
			if( $sdmbImage->isPosted() )
			{
				$sdmbImage->setValidExtensions( $validExtensions );
		    	$sdmbImage->nameToSafe();
				if(! $fileName = $sdmbImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $sdmbImage->getError() ) );
	                return false;
	            }
	          
	            //make preview
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
					                                 $preview_dir.DS.$fileName,
			                                 null,
			                                 $previewWidth,
			                                 $jpgQuality );
			            
			    //make min
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
			                                 $thumbnail_dir.DS.$fileName,
			                                 $thumbnailHeight,
			                                 $thumbnailWidth,
			                                 $jpgQuality );
			                                 
			    // make large
			    U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
	                                 $largeDir.DS.$fileName,
	                                 $largeHeight,
	                                 $largeWidth,
	                                 $jpgQuality );
			}
		}
	    
		// upload hinh anh noi that
    	$i = 0;
		$noiThatImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'noi_that_img' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$noiThatImages[] = new Http_File( $tempImage );
				$i++;
			}
			else
			{
				break;
			} 	
		}
		
        $upload_dir = $base_upload_dir . DS . $id;
	    $upload_dir = $upload_dir.DS.'noithat';
        $preview_dir = $upload_dir.DS.'preview';
        $thumbnail_dir = $upload_dir.DS.'min';
        $largeDir = $upload_dir.DS.'large';
        if ( !JFolder::exists($upload_dir) ) 
        { 
        	JFolder::create($upload_dir); 
        }
        if ( !JFolder::exists($preview_dir) ) 
        { 
        	JFolder::create($preview_dir); 
        }
        if ( !JFolder::exists($thumbnail_dir) ) 
        { 
        	JFolder::create($thumbnail_dir); 
        }
		if ( !JFolder::exists($largeDir) ) 
		{ 
			JFolder::create($largeDir); 
		}
	    
	    foreach ( $noiThatImages as $noiThatImage )
		{
			if( $noiThatImage->isPosted() )
			{
				$noiThatImage->setValidExtensions( $validExtensions );
		    	$noiThatImage->nameToSafe();
				if(! $fileName = $noiThatImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $noiThatImage->getError() ) );
	                return false;
	            }
	          
	            //make preview
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
					                                 $preview_dir.DS.$fileName,
			                                 null,
			                                 $previewWidth,
			                                 $jpgQuality );
			            
			    //make min
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
			                                 $thumbnail_dir.DS.$fileName,
			                                 $thumbnailHeight,
			                                 $thumbnailWidth,
			                                 $jpgQuality );
			                                 
			    // make large
			    U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
	                                 $largeDir.DS.$fileName,
	                                 $largeHeight,
	                                 $largeWidth,
	                                 $jpgQuality );
			}
		}
		
    	// upload hinh anh ngoai that
    	$i = 0;
		$ngoaiThatImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'ngoai_that_img' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$ngoaiThatImages[] = new Http_File( $tempImage );
				$i++;
			}
			else
			{
				break;
			} 	
		}
		
        $upload_dir = $base_upload_dir . DS . $id;
	    $upload_dir = $upload_dir.DS.'ngoaithat';
        $preview_dir = $upload_dir.DS.'preview';
        $thumbnail_dir = $upload_dir.DS.'min';
        $largeDir = $upload_dir.DS.'large';
        if ( !JFolder::exists($upload_dir) ) 
        { 
        	JFolder::create($upload_dir); 
        }
        if ( !JFolder::exists($preview_dir) ) 
        { 
        	JFolder::create($preview_dir); 
        }
        if ( !JFolder::exists($thumbnail_dir) ) 
        { 
        	JFolder::create($thumbnail_dir); 
        }
		if ( !JFolder::exists($largeDir) ) 
		{ 
			JFolder::create($largeDir); 
		}
	    
	    foreach ( $ngoaiThatImages as $ngoaiThatImage )
		{
			if( $ngoaiThatImage->isPosted() )
			{
				$ngoaiThatImage->setValidExtensions( $validExtensions );
		    	$ngoaiThatImage->nameToSafe();
				if(! $fileName = $ngoaiThatImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $ngoaiThatImage->getError() ) );
	                return false;
	            }
	          
	            //make preview
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
					                                 $preview_dir.DS.$fileName,
			                                 null,
			                                 $previewWidth,
			                                 $jpgQuality );
			            
			    //make min
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
			                                 $thumbnail_dir.DS.$fileName,
			                                 $thumbnailHeight,
			                                 $thumbnailWidth,
			                                 $jpgQuality );
			                                 
			    // make large
			    U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
	                                 $largeDir.DS.$fileName,
	                                 $largeHeight,
	                                 $largeWidth,
	                                 $jpgQuality );
			}
		}
		
        return true;
    }
    
    
    function _resizeImage( $from, $to, $maxHeight=null, $maxWidth=null, $jpgQuality=90 )
    {
    		static $gd = null;
    		
    		if ( $gd === null){
    			// require JPATH_COMPONENT_ADMINISTRATOR.DS.'library/Gd/Transform.php';
    			 require_once JPATH_ROOT.DS."libraries/com_u_re/Gd/Transform.php";
    			$gd = new Gd_Transform();
    		}
    	
    		$gd->load( $from );
    		
    		if ($maxHeight) {
    			$gd->resize( null, $maxHeight );
    		
	            if ( $gd->getSize( 'width' ) > $maxWidth ) {
	                $gd->resize( $maxWidth , null );
	            }
    		} else {
    			$gd->resize( $maxWidth , null );
    		}
            	
            $gd->saveToJpeg( $to , $jpgQuality );
    }
    
    function uploadHinhAnhDacBiet( $fieldName, $folderName, $id )
    {
    	if (!$id) return false;
    	
   		 require_once JPATH_ROOT.DS.'/libraries/com_u_re/Http_File.php';
    	jimport('joomla.filesystem.folder');
    	
    	global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['property_image_path'];
		
    	$base_upload_dir = JPATH_ROOT.DS .$propertyImagePath;

    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP') ;
    	
		
		$i = 0;
		$secondImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( $fieldName . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$secondImages[] = new Http_File( $tempImage );
				$i++;
				echo " i = " . $i; 
			}
			else
			{
				break;
			} 	
		}
    
        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS . $id . DS . $folderName;
       
        $previewWidth = $u_reGlobalConfig['IMAGE']['image_width'];
        $thumbnailWidth = $u_reGlobalConfig['IMAGE']['thumbnail_width'];
        $thumbnailHeight = $u_reGlobalConfig['IMAGE']['thumbnail_height']; //default max height : 90px
		$largeWidth = $u_reGlobalConfig['IMAGE']['image_large_width'];
		$largeHeight = $u_reGlobalConfig['IMAGE']['image_large_height'];
        
        $jpgQuality = 90 ;

    	$preview_dir = $upload_dir.DS.'preview' ;
        $thumbnail_dir = $upload_dir.DS.'min' ;
        $largeDir = $upload_dir.DS.'large' ;
        if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
		if ( !JFolder::exists($largeDir) ) { JFolder::create($largeDir); }
        
		foreach ( $secondImages as $secondImage )
		{
			if( $secondImage->isPosted() )
			{
	            
	            $secondImage->setValidExtensions( $validExtensions );
	            $secondImage->nameToSafe();
			            
	            if(! $fileName = $secondImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $secondImage->getError() ) );
	                return false;
	            }
	          
	            //make preview
	            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName,
					                                 $preview_dir.DS.$fileName,
			                                 null,
			                                 $previewWidth,
			                                 $jpgQuality );
			     U_ReModelProperties::create_watermark($upload_dir.DS.$fileName, $upload_dir.DS.$fileName,$u_reGlobalConfig['WATERMARK']['image_preview_name'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;       
			    //make min
	            U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
			                                 $thumbnail_dir.DS.$fileName,
			                                 $thumbnailHeight,
			                                 $thumbnailWidth,
			                                 $jpgQuality );
			     U_ReModelProperties::create_watermark($upload_dir.DS.$fileName, $upload_dir.DS.$fileName,$u_reGlobalConfig['WATERMARK']['image_name_min'],$u_reGlobalConfig['WATERMARK']['image_path'])  ;                             
			    // make large
			    U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
                                 $largeDir.DS.$fileName,
                                 $largeHeight,
                                 $largeWidth,
                                 $jpgQuality );
	        }
		}
		
		// upload cac hinh anh dac biet: so do mat bang, noi that, ngoai that
    	$i = 0;
		$sdmbImages = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'so_do_mat_bang_img' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$sdmbImages[] = new Http_File( $tempImage );
				$i++;
				echo " i = " . $i; 
			}
			else
			{
				break;
			} 	
		}
		
        $upload_dir = $base_upload_dir . DS . $id;
	    $upload_dir = $upload_dir.DS.'sodomatbang';
    	if ( !JFolder::exists($upload_dir) ) 
    	{ 
    		JFolder::create($upload_dir); 
    	}
	    $sdmbImages->setValidExtensions( $validExtensions );
	    $sdmbImages->nameToSafe();
	    
	    foreach ( $sdmbImages as $sdmbImage )
		{
			if(! $fileName = $sdmbImage->moveTo( $upload_dir ))
            {
                JError::raiseWarning( 200, JText::_( $sdmbImage->getError() ) );
                return false;
            }
          
            //make preview
            U_ReModelProperties::_resizeImage( $upload_dir.DS.$fileName . '_preview',
				                                 $preview_dir.DS.$fileName,
		                                 null,
		                                 $previewWidth,
		                                 $jpgQuality );
		            
		    //make min
            U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
		                                 $thumbnail_dir.DS.$fileName,
		                                 $thumbnailHeight,
		                                 $thumbnailWidth,
		                                 $jpgQuality );
		                                 
		    // make large
		    U_ReModelProperties::_resizeImage( $preview_dir.DS.$fileName,
                                 $largeDir.DS.$fileName,
                                 $largeHeight,
                                 $largeWidth,
                                 $jpgQuality );
		}
	    
        return true;
    }
    
    function saveDangKyMuaThue()
    {
    	$ngaydang = ''.time();
        
    	$id = JRequest::getVar( 'id', '' );
    	
        $datas_vi = array(
	        'ten_nguoi_lien_he' => JRequest::getVar( 'ho_ten', '', 'POST' ),        
	      	'mo_ta_chi_tiet'    => JRequest::getVar( 'nhu_cau', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	
	        'dien_thoai_nguoi_lien_he'        => JRequest::getVar( 'dien_thoai', '' , 'POST' ),
        
        	'dia_chi_nguoi_lien_he'        => JRequest::getVar( 'dia_chi', '' , 'POST' ),
        
        	// mac dinh dang xong hien thi luon
	        'hien_thi_ra_ngoai' => '1',
        
	     	//'ordering' =>  $so_thu_tu,
        	'ngay_dang' => $ngaydang,
        	
        	// hardcode id can mua, can thue
        	'loai_giao_dich_id' => JRequest::getVar( 'loai', '3' , 'POST' ),
        
        	// alias SEF
        	'alias' => JRequest::getVar( 'alias', '' , 'POST' ),
        
        );
        
        $datas_vi['tieu_de'] = ilandCommonUtils::getShortDescription( $datas_vi['mo_ta_chi_tiet'], 100 );
        
        // set default sef
        if ( empty($datas_vi['alias']) )
        {
        	$datas_vi['alias'] = str_replace(' ', '-', $datas_vi['tieu_de']);
        }
        
        if ( !empty( $datas_vi['mo_ta_chi_tiet'] ) )
        {
        	$datas_vi['mo_ta_chi_tiet'] = ilandCommonUtils::stripWordContent( $datas_vi['mo_ta_chi_tiet'] );
        }
        
        if ( $id )
        {
	      	//tieng viet
	      	if( isset($datas_vi['ma_so']) && ($datas_vi['ma_so']=='0' || $datas_vi['ma_so']=='') )
	      	{
	        	$datas_vi['ma_so'] = ''. $id;
        	}
      	
			$DataValue = array_values($datas_vi);
			$DataKey = array_keys($datas_vi);
			$i=0;
			$Keyvalue = '';
			foreach ( $DataKey as $data )
			{
				$Keyvalue .= ",";
				$Keyvalue .= $data;
				$Keyvalue .= " = ";
				$Keyvalue .= "'$DataValue[$i]'";
				$i++;
			}
			$paramvi = substr($Keyvalue,1);		
			U_ReModelProperties::getUpdateProperties( $id, $paramvi, 'vi' );
      	}
      	else
      	{
		   	//	them bds
      	    // them tieng viet
      		if( isset($datas_vi['ma_so']) && ($datas_vi['ma_so']=='0' || $datas_vi['ma_so']=='') )
      		{
        		$datas_vi['ma_so'] = ''. ilandCommonUtils::layMaSo();
        	}
	        $DataKey = array_keys($datas_vi);
	        $Keyvalue = '';
	    	foreach ($DataKey as $Datavalue )
	    	{
	    		$Keyvalue .= ',';
	    		$Keyvalue .= $Datavalue;
	       	}
	       	$paramvi = substr($Keyvalue,1);
	       	$insertId = U_ReModelProperties::themBDS($paramvi, $datas_vi, 'vi');
      	}    
    }
}
