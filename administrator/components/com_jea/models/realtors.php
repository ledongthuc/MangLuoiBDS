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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once('../libraries/com_u_re/php/common_utils.php');
jimport('joomla.application.component.model');

class JeaModelRealtors extends JModel
{
    var $_error = '';

    /**
     * property category ( renting or selling )
     *
     * @var string $_cat
     */
   
    var $_lastId = 0;
	function checkout()
	{
		$user = & JFactory::getUser();
		$row = & $this->getRow();
		
		/*
		 * If the item is checked out we cannot edit it... unless it was checked
		 * out by the current user.
		 */
		if ( $row->isCheckedOut( $user->get('id'), $row->checked_out )) {
			$msg = JText::sprintf('DESCBEINGEDITTED', JText::_('The realtor'), $row->name);
			JError::raiseWarning( 200, $msg );
			return false;
		}
		
		$row->checkout($user->get('id'));
		
		return true ;
		
	}
	
	function laygiatrirong()
    {
    	return $projectDataEn = array (
			'id'    =>'' ,
			'ten'    =>'' ,
			'dia_chi'    =>'' ,
			'dien_thoai'    =>'' ,
			'email'    =>'' ,
			'mo_ta'    =>'' ,
			'hinh_anh'    =>'' ,
			'mail_template'    =>'' ,
			'tinh_thanh_id'    =>'' ,
			'quan_huyen_id'    =>'' ,
			'hien_thi_ra_ngoai'    =>'' ,
			'dang_chinh_sua'    =>'' ,
			'thoi_gian_chinh_sua'    =>'' ,
			'ordering'    =>'' ,
			'pham_vi_hoat_dong'    =>'' ,
			'khau_hieu'    =>'' ,
			'userid'    =>'' ,
			'website'    =>'' ,
			'loai_nhan_vien'    =>'' ,
		);
    	
    }
    
	function layChiTietNhaMoiGioi( $id )
    {
   		if($id == 0 ) /* gan duoc id cua no vao la ko can */
    	{
    		return $this->laygiatrirong();
    	}
    	
    	$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$result = iland4_layChiTietNhaMoiGioi($DBConfig, $id, $language);
		return $result;
    }
    
    
    
    function layDanhSachNhaMoiGioi( $returnField, $page, $limit )
    {
    	$result = array() ;
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
    	$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
    	$language = ilandCommonUtils::getLanguage();
    	$offsetLimitArr = ilandCommonUtils::getOffsetLimit( $page, $limit );
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$conditionParams =  ' 1 '; //gan tam
		if ( $published!=-1 )  $conditionParams .= ' AND hien_thi_ra_ngoai = '.$published;

		//	print_r( $returnField );
	//	$result['rows'] = iland4_layDanhSachNhaMoiGioi($DBConfig, 'id, ten' , $conditionParams , $page, $limit, $language);
		 $result['rows'] = iland4_layDanhSachNhaMoiGioi($DBConfig, $returnField, $conditionParams , $page, $limit, $language);
    //	print_r( $published );
    	//exit;
    	$result['published'] = $published ;
        return $result ;
        
    }
    function save()
    {
    	$insertId = '';
    	$id =  JRequest::getInt( 'id', '', 'POST' );
        $datas_vi = array(
        	'ten'           => JRequest::getVar( 'ten', '', 'POST' ),
			'dia_chi'        => JRequest::getVar( 'dia_chi' , '', 'POST' ),
        	'dien_thoai'          => JRequest::getVar( 'dien_thoai' , '', 'POST' ),
        	'email'          => JRequest::getVar( 'email' , '', 'POST' ),
			'mo_ta'    => JRequest::getVar( 'mo_ta', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
     	// 	'image'			 => JRequest::getInt( 'image', 0 , 'POST' ),
        //	'mail_template'  => JRequest::getInt( 'mail_template', 0 , 'POST' ),
	 	'hien_thi_ra_ngoai'       => JRequest::getVar( 'published', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
         'pham_vi_hoat_dong'=> JRequest::getVar( 'pham_vi_hoat_dong' , '', 'POST' ),			
		'khau_hieu'=> JRequest::getVar( 'khau_hieu' , '', 'POST' ),
		'website'=> JRequest::getVar( 'website' , '', 'POST' ),
		'loai_nhan_vien'=> JRequest::getVar( 'loai_nhan_vien' , '', 'POST' ),
        
        );
        
        // themNhaMoiGioi
        /*
        echo "<pre>";
        print_r($id);
        print_r($datas);
        echo "</pre>";
        */
     //   exit;
                
        if ( $id )
      {
      	// echo "vao sua";
      	// exit;
      	
      	//sua
      	//tieng viet
		$DataValue = array_values($datas_vi);
		$DataKey = array_keys($datas_vi);
		$i=0;
		$Keyvalue = '';
		foreach ( $DataKey as $data )
		{
			
			$Keyvalue .= ",";
			$Keyvalue .= $data;
			$Keyvalue .= " = ";
			$Keyvalue .= "' $DataValue[$i] '";
			$i++;
		}
		$paramvi = substr($Keyvalue,1);		
		
		JeaModelRealtors::getUpdateRealtor($id, $paramvi, 'vi');
	//	print_r( $id);
	//    print_r( $paramvi);
	//	exit;
		/*
		// update tieng anh
		$DataValueen = array_values($datas_en);
		$DataKeyen = array_keys($datas_en);
		$i=0;
		$Keyvalueen = '';
		foreach ( $DataKeyen as $dataen )
		{
			
			$Keyvalueen .= ",";
			$Keyvalueen .= $dataen;
			$Keyvalueen .= " = ";
			$Keyvalueen .= "' $DataValueen[$i] '";
			$i++;
		}
		$paramen = substr($Keyvalueen,11);
		U_ReModelProperties::getUpdateProperties($id, $paramen, 'en');
		*/
      }
      else
      {
	      	//	them
      	    // them tieng viet
	        $DataKey = array_keys($datas_vi);
	        $Keyvalue = '';
	    	foreach ($DataKey as $Datavalue )
	    	{
	    		$Keyvalue .= ',';
	    		$Keyvalue .= $Datavalue;
	       	}
	       	$paramvi = substr($Keyvalue,1);
	       $insertId = JeaModelRealtors::themNhamoigioi($paramvi, $datas_vi, 'vi' );
			// print_r( $insertId);
	       // print_r( $paramvi);
		//	 print_r( $datas_vi);
			// exit;
			/*
	         // them tieng anh
	        $DataKeyen = array_keys($datas_en);
	        $Keyvalueen = '';
	    	foreach ($DataKeyen as $Datavalueen )
	    	{
	    		$Keyvalueen .= ',';
	    		$Keyvalueen .= $Datavalueen;
	       	}
	       	$paramen = substr($Keyvalueen,1);
	        $datas_en['id'] = "$insertId";
	      U_ReModelProperties::themBDS($paramen, $datas_en, 'en' );
	      */

      }
      
     if ( $insertId )
	   {
   	   		$id = $insertId ;
	   }
	   
      if ( !JeaModelRealtors::uploadImages( $id ) )
	   {
			JError::raiseWarning( 200, 'Image upload error' );
            return false;
	   }
    }
    
	function themNhamoigioi($paramfeild, $paramvalue, $language )
    {
    	/* etension chua chay duoc
    	 */
    	/*
    	$paramfield='ten , dia_chi';
    	$paramvalue = array();
    	$paramvalue[]='ten';
    	$paramvalue[]='dia chi';
    	$language ='vi';
    	
    	/*
    	print_r( $paramfeild );
    	echo "<pre>";
    	print_r( $paramvalue );
    	echo "</pre>";
    	exit;
    	*/
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	return iland4_themBDS($DBConfig, $paramfeild, $paramvalue, $language);
    }
    
	function getUpdateRealtor($id,$param, $language)
    {
    	$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
	    return iland4_suaNhaMoiGioi($DBConfig, $id, $param, $language);
    }
    
 	function getRealtorDelete( $id )
    {
    	
    	//xoa thu muc hinh anh cua bds
		jimport('joomla.filesystem.folder');
		global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['realtor_image_path'];
			$dirimg = JPATH_ROOT.DS.$propertyImagePath.DS.$id ;
            if( JFolder::exists( $dirimg ) ) JFolder::delete( $dirimg );
         
        // xoa du lieu o database
    	$ArrayLanguage = ilandCommonUtils::getArrayLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();    	
  	  	return iland4_xoaNhaMoiGioi($DBConfig, $id, $ArrayLanguage);
    }
    
 function delete_img( $id, $image='' )
    {
	    
		$deleteFiles = array();
		
		global $u_reGlobalConfig;
		$realtorImagePath = $u_reGlobalConfig['IMAGE']['realtor_image_path'];;
		$dir = JPATH_ROOT . DS . $realtorImagePath .DS. $id .DS ;
		
		$deleteFiles[] = $dir.'avatar.jpg';
		$deleteFiles[] = $dir.'thumbnail.jpg';
		
		foreach($deleteFiles as $file){
			if( is_file($file) ) @unlink($file);
		}
		
		return true;
    }
/* ------------------ Protected methods ----------------------- */
    
    function uploadImages( $id=null )
    {
    	//echo $id;
    	//echo "vao toi uploadImages ";
    	//exit;
    	if (!$id) return false;
    	
    	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'library/Http_File.php';
    	jimport('joomla.filesystem.folder');

    	global $u_reGlobalConfig;
		$realtorImagePath = $u_reGlobalConfig['IMAGE']['realtor_image_path'];
		
    	$base_upload_dir = JPATH_ROOT.DS .$realtorImagePath;
    	
    	
    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG') ;
    	
		$image   = new Http_File( JRequest::getVar( 'image', array(), 'files', 'array' ) ) ;
    	
        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS .$id;
        
        $config =& ComJea::getParams();
        
        $maxPreviewWidth = $config->get('max_previews', 400) ;
        $maxThumbnailWidth = $config->get('max_thumbnails', 120);
        $maxThumbnailHeight = 90 ; //default max height : 90px
        $jpgQuality = $config->get( 'jpg_quality' , 90) ;

        if ( $image->isPosted() ){
            	
            if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
            	
            $image->setValidExtensions( $validExtensions );
            $image->setName('avatar.jpg');
            	
            if( !$fileName = $image->moveTo($upload_dir) ){
                JError::raiseWarning( 200, JText::_( $image->getError() ) );
                return false;
            }

            //make preview
            JeaModelRealtors::_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'avatar.jpg',
                                 null,
                                 $maxPreviewWidth,
                                 $jpgQuality );
            	
            //make min
            JeaModelRealtors::_resizeImage( $upload_dir.DS.'avatar.jpg',
                                 $upload_dir.DS.'thumbnail.jpg',
                                 $maxThumbnailHeight,
                                 $maxThumbnailWidth,
                                 $jpgQuality );
        }
        
        return true;
    }
    
    function _resizeImage( $from, $to, $maxHeight=null, $maxWidth=null, $jpgQuality=90 )
    {
    	static $gd = null;
    	
    	if ( $gd === null){
    		require JPATH_COMPONENT_ADMINISTRATOR.DS.'library/Gd/Transform.php';
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
    
    
}

?>