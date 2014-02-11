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

class JeaModelProjects extends JModel
{
    var $_error = '';
    /**
     * property category ( renting or selling )
     *
     * @var string $_cat
     */
   
    var $_lastId = 0;
    
    
	function getId()
	{
		//First loooking for new insertion
		if ($this->_lastId > 0) {
			return $this->_lastId ;
		}
		
		$cid = $this->getCid();
		if (empty($cid[0])) {
			//try to see id
			return JRequest::getInt('id', 0);
		}
		
			
		return $cid[0] ;
	}
	
	function getCid()
	{
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger( $cid, array(0) );
		return $cid ;
	}
	
	function &getRow()
	{
		$table =& $this->getTable();
		$table->load( $this->getId() );
		return $table;
	}
	
	function checkout()
	{
		$user = & JFactory::getUser();
		$row = & $this->getRow();
		
		/*
		 * If the item is checked out we cannot edit it... unless it was checked
		 * out by the current user.
		 */
		if ( $row->isCheckedOut( $user->get('id'), $row->checked_out )) {
			$msg = JText::sprintf('DESCBEINGEDITTED', JText::_('The property'), $row->ref);
			JError::raiseWarning( 200, $msg );
			return false;
		}
		
		$row->checkout($user->get('id'));
		
		return true ;
		
	}
	function layTinhThanhById($id){
		$query = "select ten from iland4_tinh_thanh where id=$id";
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$result= $db->loadRow();
		return $result[0];
	}
	function layQuanHuyenById($id){
		$query = "select ten from iland4_quan_huyen where id=$id";
		$db = JFactory::getDBO();
		$db->setQuery($query);
		$result= $db->loadRow();
		return $result[0];
	}
	function save()
    {
        $id =  JRequest::getInt( 'id', '', 'POST' );
        	$so_thu_tu = ''. ilandCommonUtils::layOrdering('du_an');
        	$tinh = JeaModelProjects::layTinhThanhById(JRequest::getVar( 'town_id', '', 'POST'));
        	$quan = JeaModelProjects::layQuanHuyenById(JRequest::getVar( 'area_id', '', 'POST'));
        	$datas_vi = array(
        	
        	'ten'    => JRequest::getVar( 'name', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'alias'    => JRequest::getVar( 'alias', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'tinh_thanh_id'    => JRequest::getVar( 'town_id', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'quan_huyen_id'    => JRequest::getVar( 'area_id', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        	'tinh_thanh'	   => ''.$tinh,
        	'quan_huyen'	   => ''.$quan,
        	/*'ordering' =>  $so_thu_tu,
        	
        	'loai_du_an_id'        => JRequest::getVar( 'type_id',0, 'POST'),
			'ngay_khoi_cong'           => JRequest::getVar( 'start_date','', 'POST' ),
			'ngay_hoan_thanh' => JRequest::getVar( 'end_date', '', 'POST' ),
			'khu_dan_cu'   => JRequest::getVar( 'people_area', '' , 'POST' ),
			'tinh_trang'      => JRequest::getVar( 'status', '' , 'POST' ),
			'tong_dien_tich'    => JRequest::getVar( 'total_square', '', 'POST'),
			'so_tang'      => JRequest::getVar( 'number_of_floor', '' , 'POST' ),
			'hien_thi_ra_ngoai'      => JRequest::getVar( 'published', 0 , 'POST' ),
			'tien_ich_id'       => JRequest::getVar( 'project_advantage_ids',  array(), 'POST', 'array'   ),
	        'moi_nhat'       => JRequest::getVar( 'newsest', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        	'noi_bat'       => JRequest::getVar( 'noi_bat', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
	        'dien_thoai_lien_he'       => JRequest::getVar( 'contact_phone', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
	        'ban_do_vi_tri'       => JRequest::getVar( 'vi_plane_area', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        	'kinh_do'       => JRequest::getVar( 'map_lat', '', 'POST'),
        	'vi_do'       => JRequest::getVar( 'map_lng', '', 'POST'),
			'ordering' =>  $so_thu_tu,
        	// ngon ngu tieng viet
        		
			 'ten'            => JRequest::getVar( 'vi_hidden_name', '', 'POST' ),
			 'dia_chi'         => JRequest::getVar( 'vi_hidden_address' , '', 'POST' ),
			 'mo_ta_day_du'    => JRequest::getVar( 'vi_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			 'mo_ta_ngan'        => JRequest::getVar( 'vi_hidden_short_description', '', 'POST', 'string', JREQUEST_ALLOWRAW),
			 'nha_dau_tu'        => JRequest::getVar( 'vi_hidden_investor', '' , 'POST' ),
			 'don_vi_thi_cong'   => JRequest::getVar( 'vi_hidden_implement_unit' , '', 'POST' ),
			 'don_vi_quan_li'          => JRequest::getVar( 'vi_hidden_management_unit','' , 'POST' ),
			 'don_vi_thiet_ke'     => JRequest::getVar( 'vi_hidden_design_unit', '', 'POST' ),
			// 'quy_hoach_tong_the'       => JRequest::getVar( 'vi_hidden_scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'so_do_mat_bang'      => JRequest::getVar( 'vi_hidden_plain_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			 'tien_do'       => JRequest::getVar( 'vi_hidden_progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
        
			 'lien_he'       => JRequest::getVar( 'vi_hidden_contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'dia_chi_lien_he'         => JRequest::getVar( 'vi_hidden_contact_address' , '', 'POST' ),
			 'ten_lien_he'         => JRequest::getVar( 'vi_hidden_contact_name' , '', 'POST' ),

	       	'doi_tac'       => JRequest::getVar( 'vi_hidden_partners', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'thanh_toan'       => JRequest::getVar( 'vi_hidden_payment', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'tieu_de_trang'       => JRequest::getVar( 'vi_hidden_page_title', '' , 'POST' ),
			 'tu_khoa_trang'       => JRequest::getVar( 'vi_hidden_page_keywords', '' , 'POST' ),
			 'mo_ta_trang'       => JRequest::getVar( 'vi_hidden_page_description', '' , 'POST' ),
        	'loai_du_an'       => JRequest::getVar( 'vi_loai_du_an', '' , 'POST' ),
        	*/
        	
        );
       
        /*
        $datas_vi['mo_ta_ngan'] = ilandCommonUtils::stripWordContent( $datas_vi['mo_ta_ngan'] );
		$datas_vi['so_do_mat_bang'] = ilandCommonUtils::stripWordContent( $datas_vi['so_do_mat_bang'] );
		$datas_vi['ban_do_vi_tri'] = ilandCommonUtils::stripWordContent( $datas_vi['ban_do_vi_tri'] );
		$datas_vi['mo_ta_day_du'] = ilandCommonUtils::stripWordContent( $datas_vi['mo_ta_day_du'] );
		$datas_vi['tien_do'] = ilandCommonUtils::stripWordContent( $datas_vi['tien_do'] );
		$datas_vi['doi_tac'] = ilandCommonUtils::stripWordContent( $datas_vi['doi_tac'] );
		$datas_vi['thanh_toan'] = ilandCommonUtils::stripWordContent( $datas_vi['thanh_toan'] );
		$datas_vi['lien_he'] = ilandCommonUtils::stripWordContent( $datas_vi['lien_he'] );
		
        $datas_vi['so_do_mat_bang']=$this->addPopup('so_do_mat_bang',$datas_vi['so_do_mat_bang']);
        $datas_vi['ban_do_vi_tri']=$this->addPopup('ban_do_vi_tri',$datas_vi['ban_do_vi_tri']);
        */
        //print_r($datas_vi);
        //exit;
        /*
        $datas_en = array(
        	'id' => '',
			'loai_du_an_id'        => JRequest::getVar( 'type_id',0, 'POST'),
			'ngay_khoi_cong'           => JRequest::getVar( 'start_date','', 'POST' ),
			'ngay_hoan_thanh' => JRequest::getVar( 'end_date', '', 'POST' ),
			'khu_dan_cu'   => JRequest::getVar( 'people_area', '' , 'POST' ),
			'tinh_trang'      => JRequest::getVar( 'status', '' , 'POST' ),
			'tong_dien_tich'    => JRequest::getVar( 'total_square', '', 'POST'),
			'so_tang'      => JRequest::getVar( 'number_of_floor', '' , 'POST' ),
			'hien_thi_ra_ngoai'      => JRequest::getVar( 'published', 0 , 'POST' ),
			//'noi_bat'       => JRequest::getInt( 'noi_bat', 0 , 'POST' ),
           'noi_bat'       => JRequest::getVar( 'noi_bat', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			'tien_ich_id'       => JRequest::getVar( 'project_advantage_ids',  array(), 'POST', 'array'   ),
	        'moi_nhat'       => JRequest::getVar( 'newsest', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
	        'dien_thoai_lien_he'       => JRequest::getVar( 'contact_phone', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
	        'ban_do_vi_tri'       => JRequest::getVar( 'vi_plane_area', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        	'kinh_do'       => JRequest::getVar( 'map_lat', '', 'POST'),
        	'vi_do'       => JRequest::getVar( 'map_lng', '', 'POST'),
        	'ordering' =>  $so_thu_tu,
			// ngon ngu tieng viet
			 'ten'            => JRequest::getVar( 'en_hidden_name', '', 'POST' ),
			 'dia_chi'         => JRequest::getVar( 'en_hidden_address' , '', 'POST' ),
			  'mo_ta_day_du'    => JRequest::getVar( 'en_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			 'mo_ta_ngan'        => JRequest::getVar( 'en_hidden_short_description', '', 'POST', 'string', JREQUEST_ALLOWRAW),
			 'nha_dau_tu'        => JRequest::getVar( 'en_hidden_investor', '' , 'POST' ),
			 'don_vi_thi_cong'   => JRequest::getVar( 'en_hidden_implement_unit' , '', 'POST' ),
			 'don_vi_quan_li'          => JRequest::getVar( 'en_hidden_management_unit','' , 'POST' ),
			 'don_vi_thiet_ke'     => JRequest::getVar( 'en_hidden_design_unit', '', 'POST' ),
			 //'quy_hoach_tong_the'       => JRequest::getVar( 'en_hidden_scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'so_do_mat_bang'      => JRequest::getVar( 'en_hidden_plain_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			 'tien_do'       => JRequest::getVar( 'en_hidden_progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			 'lien_he'       => JRequest::getVar( 'en_hidden_contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'dia_chi_lien_he'         => JRequest::getVar( 'en_hidden_contact_address' , '', 'POST' ),
			 'ten_lien_he'         => JRequest::getVar( 'en_hidden_contact_name' , '', 'POST' ),
	         'doi_tac'       => JRequest::getVar( 'en_hidden_partners', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'thanh_toan'       => JRequest::getVar( 'en_hidden_payment', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			 'tieu_de_trang'       => JRequest::getVar( 'en_hidden_page_title', '' , 'POST' ),
			 'tu_khoa_trang'       => JRequest::getVar( 'en_hidden_page_keywords', '' , 'POST' ),
			 'mo_ta_trang'       => JRequest::getVar( 'en_hidden_page_description', '' , 'POST' ),
        	'loai_du_an'       => JRequest::getVar( 'en_loai_du_an', '' , 'POST' ),
        	
        );
        $datas_en['mo_ta_ngan'] = ilandCommonUtils::stripWordContent( $datas_en['mo_ta_ngan'] );
		$datas_en['so_do_mat_bang'] = ilandCommonUtils::stripWordContent( $datas_en['so_do_mat_bang'] );
		$datas_en['ban_do_vi_tri'] = ilandCommonUtils::stripWordContent( $datas_en['ban_do_vi_tri'] );
		$datas_en['mo_ta_day_du'] = ilandCommonUtils::stripWordContent( $datas_en['mo_ta_day_du'] );
		$datas_en['tien_do'] = ilandCommonUtils::stripWordContent( $datas_en['tien_do'] );
		$datas_en['doi_tac'] = ilandCommonUtils::stripWordContent( $datas_en['doi_tac'] );
		$datas_en['thanh_toan'] = ilandCommonUtils::stripWordContent( $datas_en['thanh_toan'] );
		$datas_en['lien_he'] = ilandCommonUtils::stripWordContent( $datas_en['lien_he'] );
        
        $datas_en['so_do_mat_bang']=$this->addPopup('so_do_mat_bang',$datas_en['so_do_mat_bang']);
        $datas_en['ban_do_vi_tri']=$this->addPopup('ban_do_vi_tri',$datas_en['ban_do_vi_tri']);
		*/
		if ( $id )
      	{
	      	//sua du an
	      	//tieng viet
			$DataValue = array_values($datas_vi);
			$DataKey = array_keys($datas_vi);
			$i=0;
			$Keyvalue = '';
			foreach ( $DataKey as $data )
			{
				
				$Keyvalue .= ",";
				$Keyvalue .= $data;
				$Keyvalue .= "=";
				$Keyvalue .= "'$DataValue[$i]'";
				$i++;
			}
			$paramvi = substr($Keyvalue,1);
			$this->updateProjectadmin($id, $paramvi, 'vi');
		
			// update tieng anh
			/*
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
			$this->updateProject($id, $paramen, 'en');
			*/
      }
      else
      {
	      	//	them du an
      	    // them tieng viet
	        $DataKey = array_keys($datas_vi);
	        $Keyvalue = '';
	    	foreach ($DataKey as $Datavalue )
	    	{
	    		$Keyvalue .= ',';
	    		$Keyvalue .= $Datavalue;
	       	}
	       	$paramvi = substr($Keyvalue,1);
	        
	       	// hoan dang lam
       
	      	$insertId = $this->themduan($paramvi, $datas_vi, 'vi' );
	        // them tieng anh
	        /*
	        $DataKeyen = array_keys($datas_en);
	        $Keyvalueen = '';
	    	foreach ($DataKeyen as $Datavalueen )
	    	{
	    		$Keyvalueen .= ',';
	    		$Keyvalueen .= $Datavalueen;
	       	}
	       	$paramen = substr($Keyvalueen,1);
	        $datas_en['id'] = "$insertId";
	        $this->themduan($paramen, $datas_en, 'en' );
	          */      
		} 
		/*       
	   	if ( $id )
	   	{
	   		$insertId = $id;
	   	}
		if ( !$this->_uploadImages($insertId) )  
		{
			JError::raiseWarning( 200, 'Image upload error' );
            return false;
		}
        return true;
        */	
		return true;
    }
	
    function delete_img( $id, $image='' )
    {
	    $image	= JRequest::getVar( 'image' , '');
	    
		$deleteFiles = array();
		// $dir2 = JPATH_ROOT . DS . 'images' .DS. 'com_jea' .DS. 'images' .DS."Plan_".$row->id.DS ;
		 
		
		global $u_reGlobalConfig;
		$projectImagePath = $u_reGlobalConfig['IMAGE']['project_image_path'];;
		$dir = JPATH_ROOT . DS . $projectImagePath .DS. $id .DS ;
		// print_r($dir);
    	// exit;
		if( !$image ){
			//main image to delete
			$deleteFiles[] = $dir.'main.jpg';
			$deleteFiles[] = $dir.'preview.jpg';
			$deleteFiles[] = $dir.'min.jpg';
		} else {
			//secondary image to delete
			$deleteFiles[] = $dir.'secondary'.DS.$image;
			$deleteFiles[] = $dir.'secondary'.DS.'preview'.DS.$image;
			$deleteFiles[] = $dir.'secondary'.DS.'min'.DS.$image;
		}
		
		foreach($deleteFiles as $file){
			if( is_file($file) ) @unlink($file);
		}
		
		return true;
			
    }
    
/* ------------------ Protected methods ----------------------- */
    
    
    function _uploadImages( $id=null )
    {    	
    	if (!$id) return false;
    	
    	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'library/Http_File.php';
    	jimport('joomla.filesystem.folder');
    	
    	global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['project_image_path'];
		
    	$base_upload_dir = JPATH_ROOT.DS .$propertyImagePath ;

    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP') ;
    	
		$mainImage   = new Http_File( JRequest::getVar( 'main_image', array(), 'files', 'array' ) ) ;
		
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
        $thumbnailHeight = $u_reGlobalConfig['IMAGE']['thumbnail_height'];
		$largeWidth = $u_reGlobalConfig['IMAGE']['image_large_width'];
		$largeHeight = $u_reGlobalConfig['IMAGE']['image_large_height'];
		$jpgQuality = 90;

        //main image
        if ( $mainImage->isPosted() )
        {
            if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
            	
            $mainImage->setValidExtensions( $validExtensions );
            $mainImage->setName('main.jpg');
            
            if( !$fileName = $mainImage->moveTo($upload_dir) )
            {

                JError::raiseWarning( 200, JText::_( $mainImage->getError() ) );
                return false;
            }
             	
             //make preview
            $this->_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'preview.jpg',
                                 null,
                                 $previewWidth,
                                 $jpgQuality );
            	
                
            //make min
            $this->_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'min.jpg',
                                 null,
                                 $thumbnailWidth,                                 
                                 $jpgQuality );
                                 
            $this->_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'large.jpg',
                                 null,
                                 $largeWidth,
                                 $jpgQuality );                     

        }
        
 
        foreach ( $secondImages as $secondImage )
		{ 
			if($secondImage->isPosted())
		  	{
			    $upload_dir = $base_upload_dir . DS . $id;
	            $upload_dir = $upload_dir.DS.'secondary';
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
        	
	            $secondImage->setValidExtensions( $validExtensions );
	            $secondImage->nameToSafe();
            	
	            if(! $fileName = $secondImage->moveTo( $upload_dir ))
	            {
	                JError::raiseWarning( 200, JText::_( $secondImage->getError() ) );
	                return false;
	            }
          
	            // save to jpeg
	            $lastPoint = strripos( $fileName, '.' );
	            if ( $lastPoint > 0 )
	            {
	            	$extensionName = substr( $fileName, $lastPoint + 1, 
	            								strlen( $fileName ) - $lastPoint - 1 );
	            	
	            	if ( $extensionName != 'jpg' )
	            	{	
		            	$fileNameJpeg = substr( $fileName, 0, $lastPoint ) . '.jpg';
		            
		            	$this->_resizeImage( $upload_dir.DS.$fileName,
		                                 $upload_dir.DS.$fileNameJpeg,
		                                 null,
		                                 null,
		                                 $jpgQuality );
	            	}
	            }
	            
            	//make preview
	            $this->_resizeImage( $upload_dir.DS.$fileName,
	                                 $preview_dir.DS.$fileName,
	                                 null,
	                                 $previewWidth,
	                                 $jpgQuality );
	            
	            //make min
	            $this->_resizeImage( $upload_dir.DS.$fileName,
	                                 $thumbnail_dir.DS.$fileName,
	                                 null,
	                                 $thumbnailWidth,
	                                 $jpgQuality );
	        
	        	// make large
			    $this->_resizeImage( $upload_dir.DS.$fileName,
	                                 $largeDir.DS.$fileName,
	                                 null,
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
    		require JPATH_COMPONENT_ADMINISTRATOR.DS.'library/Gd/Transform.php';
    		$gd = new Gd_Transform();
    	}
    
    	$gd->load( $from );
    	
    	if ($maxHeight) {
    		$gd->resize( null, $maxHeight );
    	
            if ( $gd->getSize( 'width' ) > $maxWidth ) 
            {
                $gd->resize( $maxWidth , null );
            }
    	} else {
    		if ( $gd->getSize( 'width' ) > $maxWidth )
    		{
    			$gd->resize( $maxWidth , null );
    		}
    	}
            
        $gd->saveToJpeg( $to , $jpgQuality );
    }
    
    static function getMainImage($projectId)
    {
    	$mainImage = "images/com_jea/images/Plan_" . $projectId . "/preview.jpg";
    	return $mainImage;
    }
	
    function getListProjects( $returnField, $page, $limit )
    {
    	$result = array() ;
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
    	$type_id = $mainframe->getUserStateFromRequest( $context.'type_id', 'type_id', 0, 'int' );
    	$town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
    	$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
		$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
			
		
		$language = ilandCommonUtils::getLanguage();
    	$offsetLimitArr = ilandCommonUtils::getOffsetLimit( $page, $limit );
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$conditionParams =  '1'; //gan tam
		
		if( $emphasis != -1 ) $conditionParams .= ' AND noi_bat = '.$emphasis;
		if ( $published!=-1 )  $conditionParams .= ' AND hien_thi_ra_ngoai = '.$published;
		if ( $town_id!= 0 )  $conditionParams .= ' AND tinh_thanh_id = '.$town_id;
		if ( $area_id!= 0 &&  $town_id!= 0 )  $conditionParams .= ' AND quan_huyen_id = '.$area_id;
		if ( $type_id!= 0 )  $conditionParams .= ' AND loai_du_an_id = '.$type_id;
		if ( $search!=NULL )  $conditionParams .= ' AND ten LIKE "'. $search .'"';

		$result['search'] = $search ;
		$result['town_id'] = $town_id ;
		$result['area_id'] = $area_id ;
		$result['published'] = $published ;
		$result['emphasis'] = $emphasis ;
		$result['type_id'] = $type_id;
		//$result['rows'] = iland4_layDanhSachDuAn($DBConfig, $returnField, $conditionParams , $offsetLimitArr, $limit, $language);	//	
			$result['rows'] = iland4_layDanhSachDuAn($DBConfig, $returnField, $conditionParams , 
																$page, $limit, $orderby, $language);
		return $result;

    }
    
    // lay chi tiet du an
    function getProjectById( $id )
    {
    	$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  	return iland4_layChiTietDuAn($DBConfig, $id, $language );
    }
    
    
    // cap nhat tin noi bac
 	function updateProject( $id, $param, $language)
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  	return iland4_suaDuAn($DBConfig, $id,$param, $language);
    }
	function updateProjectadmin( $id, $param, $language)
    {
    	$db = JFactory::getDBO();
    	//$sql = "UPDATE iland4_du_an_vi set ten = '".$param['ten']."',tinh_thanh = '".$param['tinh_thanh']."',quan_huyen = '".$param['quan_huyen']."',tinh_thanh_id = ".$param['tinh_thanh_id'].",quan_huyen_id = ".$param['quan_huyen_id'].",alias = '".$param['alias']."' where id=".$id;
    	$sql = "UPDATE iland4_du_an_vi set ".$param." where id=$id";
    	$db->setQuery($sql);
    	$db->query();
    }
    
    // xoa project
 	function getProjectDelete( $id )
    {
    	 //xoa thu muc hinh anh cua du an
		jimport('joomla.filesystem.folder');
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		$cids = implode( ',', $cid );
		
		global $u_reGlobalConfig;
		$propertyImagePath = $u_reGlobalConfig['IMAGE']['project_image_path'];
		
		foreach ( $cid as $id)
		{
			
			$dirimg = JPATH_ROOT.DS.$propertyImagePath.DS.$id ;
            if( JFolder::exists( $dirimg ) ) JFolder::delete( $dirimg );
        }
        
        // xoa du lieu o database
    	$ArrayLanguage = ilandCommonUtils::getArrayLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  return iland4_xoaDuAn($DBConfig, $id, $ArrayLanguage);
    }
	
    
    function laynhomduan($language)
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_layDanhSachLoaiDuAn($DBConfig, $language);
    }
    
    function themduan($paramfeild, $paramvalue, $language )
    {
//    	$language = 'vi';
//    	$language = ilandCommonUtils::getLanguage();
		$db = JFactory::getDBO();
		$sql= "Insert into iland4_du_an_vi value ( '','".$paramvalue['tinh_thanh']."',".$paramvalue['tinh_thanh_id'].",'".$paramvalue['quan_huyen']."',".$paramvalue['quan_huyen_id'].",'".$paramvalue['ten']."','".$paramvalue['alias']."')";
		$db->setQuery($sql);
		$db->query();
		return $db->insertid();
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	//return iland4_themDuAn($DBConfig, $paramfeild, $paramvalue, $language);    	
    }
    
	function ordering( $id, $language)
	{
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$ordering = 'ordering_'.$id;
		$orderingvalue = JRequest::getVar( "$ordering", '' );
		$paramvalue = "ordering = '$orderingvalue'";
//		print_r($ordering);
//		print_r($orderingvalue);
//		print_r($paramvalue);
//		exit;
		return iland4_suaDuAn($DBConfig, $id,$paramvalue, $language);
//		$this->updateProject_group( $id, $paramvalue, $language );
	}
    
	function addPopup($key, $str){
		if($key=='')
			$key='group';
		
		$newstr='';
		$str1='';
		$str2='';
		$pos_start=strpos($str,'img');		
		while($pos_start!=false){
			if($pos_start>0){
				$pos_start-=1;
			}
			$str1=substr($str,0,$pos_start);	
			$str=substr($str,$pos_start,strlen($str)-$pos_start);	
			$str2='';
			$pos_end =strpos($str,'>');	
			if($pos_end!=false){
				$str2=substr($str,0,$pos_end + 1);
				// kiem tra co link hay chua
				$pos1=strpos($str,'</a>');
				$pos2=strpos($str,'<a>');
				if($pos1==false || ($pos2!=false && $pos1>$pos2)){
					$str2=$this->changImageLink($key,$str2);
				}
				//$str2=$this->changImageLink($key,$str2);
				$str=substr($str,$pos_end + 1,strlen($str)-$pos_end);	
			}
			$newstr.=$str1.$str2;
			$pos_start=strpos($str,'img');	
		}
		$newstr.=$str;
		return $newstr;
	}
	
	function changImageLink($key,$image){
		$newimage='';
		$imagelink='';
		$pos_start=strpos($image,'src="');
		if($pos_start!=false){
			$imagelink=substr($image,$pos_start+5);
			$pos_end=strpos($imagelink,'"');
			if($pos_end!=false){
				$imagelink=substr($imagelink,0,$pos_end+1);
				$newimage='<a href="'.$imagelink.'" rel=prettybox['.$key.'] >';
				$newimage.=$image.'</a>';
			}else{				
				$newimage=$image;				
			}
		}else{
			$newimage=$image;
		}
		return $newimage;
	}
}

?>
