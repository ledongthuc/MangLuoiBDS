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
//require_once('/libraries/com_u_re/php/common_utils.php');
jimport('joomla.application.component.model');

class U_ReModelProjects extends JModel
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
	/*
	function &getRow()
	{
		$table =& $this->getTable();
		$table->load( $this->getId() );
		return $table;
	}
	*/
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


    function save()
    {
//        $row = & $this->getRow();
  
    		$so_thu_tu = ''. ilandCommonUtils::layOrdering('bat_dong_san');

        	$datas = array(
        	'value'            => JRequest::getVar( 'value', '', 'POST' ),
			'project_group_ids'        => JRequest::getVar( 'project_group_ids', array(), 'POST', 'array'  ),
			'address'         => JRequest::getVar( 'address' , '', 'POST' ),
			'town_id'        => JRequest::getInt( 'town_id', 0 , 'POST' ),
			'area_id'        => JRequest::getInt( 'area_id', 0 , 'POST' ),
			'desc'    => JRequest::getVar( 'desc', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'short_desc'        => JRequest::getVar( 'short_desc', '', 'POST', 'string', JREQUEST_ALLOWRAW),
			'start_date'           => JRequest::getVar( 'start_date','', 'POST' ),
			'end_date' => JRequest::getVar( 'end_date', '', 'POST' ),
			'people_area'   => JRequest::getVar( 'people_area', '' , 'POST' ),
			'status'      => JRequest::getVar( 'status', '' , 'POST' ),
			'investor'        => JRequest::getVar( 'investor', '' , 'POST' ),
			'implement_unit'   => JRequest::getVar( 'implement_unit' , '', 'POST' ),
			'management_unit'          => JRequest::getVar( 'management_unit','' , 'POST' ),
			'design_unit'     => JRequest::getVar( 'design_unit', '', 'POST' ),
			'total_square'    => JRequest::getVar( 'total_square', '', 'POST'),
			'number_of_floor'      => JRequest::getVar( 'number_of_floor', '' , 'POST' ),
			'published'      => JRequest::getInt( 'published', 0 , 'POST' ),
			'emphasis'       => JRequest::getInt( 'emphasis', 0 , 'POST' ),
			'progress'       => JRequest::getVar( 'progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'plane_diagram'      => JRequest::getVar( 'plane_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'scheme'       => JRequest::getVar( 'scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			'contacts'       => JRequest::getVar( 'contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			'project_advantage_ids'       => JRequest::getVar( 'project_advantage_ids',  array(), 'POST', 'array'   ),
        	   'ordering' =>  $so_thu_tu,
        'newsest'       => JRequest::getVar( 'newsest', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'contactname'       => JRequest::getVar( 'contactname', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'contactaddress'       => JRequest::getVar( 'contactaddress', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'contactphone'       => JRequest::getVar( 'contactphone', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'plane_area'       => JRequest::getVar( 'plane_area', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'thanhtoan'       => JRequest::getVar( 'thanhtoan', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'doitac'       => JRequest::getVar( 'doitac', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
        'page_title'       => JRequest::getVar( 'page_title', 0 , 'POST' ),
       	'page_keywords'       => JRequest::getVar( 'page_keywords', 0 , 'POST' ),
        'page_description'       => JRequest::getVar( 'page_description', 0 , 'POST' ),
        );
        
        if ( !$row->bind($datas) ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
       
    
        //Nam Hai chinh sua
        //$token_save =$this->isRenting();
        //$row->is_renting = $this->isRenting() ? 1 : 0;
       // $row->kind_id = $token_save;
        if ( ! $row->check() ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
       
        if ( !$row->store() ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
        
        //check newsletter
        $row->checkin();

		if ( !$this->_uploadImages($row->id) ) {
			JError::raiseWarning( 200, 'Image upload error' );
            return false;
		}
		
		$this->_lastId = $row->id;

        return true;
    }
    /*
    function copy()
	{
		$cids = implode( ',', $this->getCid() );
		$table =& $this->getTable();
		$nextOrdering = $table->getNextOrder();
		
		//only one request
		$inserts = array();
		$fields = $table->getPublicProperties();
		unset($fields['id']);
		unset($fields['checked_out']);
		unset($fields['checked_out_time']);
		
		$fields = array_keys($fields);
		
		$query = 'SELECT '.implode(', ', $fields).' FROM #__jea_propject WHERE id IN (' . $cids . ')';

		$rows = $this->_getList($query);
		
		foreach ($rows as $row){
		    $row = (array) $row;
		    $row['ref'] .= '_COPY';
		    $row['ordering'] = $nextOrdering;
		    $row['date_insert']  = date('Y-m-d H:i:s');
		    foreach($row as $k => $values) {
		        $row[$k] = $this->_db->Quote($values);
		    }
		    $inserts[]= '(' . implode(', ', $row) . ')';
		    $nextOrdering++;
		}
		
		$query = 'INSERT INTO #__jea_project ('.implode(', ', $fields).') VALUES' . "\n"
		       . implode(", \n", $inserts);
		         
		$this->_db->setQuery($query);
		
	    if ( !$this->_db->query() ) {
			JError::raiseError( 500, $this->_db->getErrorMsg() );
			return false;
		}
		
		return true;
	}
    
    
    function remove()
	{
		$cid = $this->getCid() ;
		$cids = implode( ',', $cid );
		
		//only one request
		$this->_db->setQuery( 'DELETE FROM `#__jea_projects` WHERE id IN (' . $cids . ')' );
		
		if ( !$this->_db->query() ) {
			JError::raiseError( 500, $this->_db->getErrorMsg() );
			return false;
		}
		
		//remove image upload directory if exists
		jimport('joomla.filesystem.folder');
		
		foreach ( $cid as $id) {
            $dirimg = JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$id ;
            if( JFolder::exists( $dirimg ) ) JFolder::delete( $dirimg );
        }
		
		return true;
	}
	
    */
    function delete_img( $id, $image='' )
    {
		
	    $row = & $this->getRow();
	    $image	= JRequest::getVar( 'image' , '');
	    
		$deleteFiles = array();
		$dir = JPATH_ROOT . DS . 'images' .DS. 'com_jea' .DS. 'images' .DS."Plan_".$row->id.DS ;
		
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
    	
    	$base_upload_dir = JPATH_ROOT.DS . 'images' . DS . 'com_jea' . DS . 'images' ;
    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG') ;
    	
		$mainImage   = new Http_File( JRequest::getVar( 'main_image', array(), 'files', 'array' ) ) ;

   		 $i = 0;
		$secondImage = array();
		while ( 1 )
		{
			$tempImage = JRequest::getVar( 'secondaries_images' . $i, array(), 'files', 'array' );
			if ( !empty( $tempImage ) )
			{
				$secondImage[] = new Http_File( $tempImage );
				$i++;
				echo " i = " . $i; 
			}
			else
			{
				break;
			} 	
		}
    	
    	
        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS . "Plan_".$id;
        
        $previewWidth = $u_reGlobalConfig['IMAGE']['image_width'];
        $thumbnailWidth = $u_reGlobalConfig['IMAGE']['thumbnail_width'];
        $thumbnailHeight = $u_reGlobalConfig['IMAGE']['thumbnail_height']; //default max height : 90px
		$largeWidth = $u_reGlobalConfig['IMAGE']['image_large_width'];
		$largeHeight = $u_reGlobalConfig['IMAGE']['image_large_height'];

		$jpgQuality = 90 ;
		
        //main image
        if ( $mainImage->isPosted() )
        {
            	
            if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
            	
            $mainImage->setValidExtensions( $validExtensions );
            $mainImage->setName('main.jpg');
            	
            if( !$fileName = $mainImage->moveTo($upload_dir) ){

                JError::raiseWarning( 200, JText::_( $mainImage->getError() ) );
                return false;
            }
            
            //make preview
            $this->_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'preview.jpg',
                                 null,
                                 $maxPreviewWidth,
                                 $jpgQuality );
            	
            //make min
            $this->_resizeImage( $upload_dir.DS.'preview.jpg',
                                 $upload_dir.DS.'min.jpg',
                                 $maxThumbnailHeight,
                                 $maxThumbnailWidth,
                                 $jpgQuality );
        	
            $this->_resizeImage( $upload_dir.DS.$fileName,
                                 $upload_dir.DS.'large.jpg',
                                 $largeHeight,
                                 $largeWidth,
                                 $jpgQuality );
        
        }
	    foreach ( $secondImages as $secondImage )
		{
	
	        if($secondImage->isPosted())
	        {
	
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
	            	
	            if(! $fileName = $secondImage->moveTo( $upload_dir )){
	                JError::raiseWarning( 200, JText::_( $secondImage->getError() ) );
	                return false;
	            }
	            
	            //make preview
	            $this->_resizeImage( $upload_dir.DS.$fileName,
	                                 $preview_dir.DS.$fileName,
	                                 null,
	                                 $maxPreviewWidth,
	                                 $jpgQuality );
	            
	            //make min
	            $this->_resizeImage( $preview_dir.DS.$fileName,
	                                 $thumbnail_dir.DS.$fileName,
	                                 $maxThumbnailHeight,
	                                 $maxThumbnailWidth,
	                                 $jpgQuality );
	        
	        	// make large
			    $this->_resizeImage( $preview_dir.DS.$fileName,
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
    
    static function getMainImage($projectId)
    {
    	$mainImage = "images/com_jea/images/Plan_" . $projectId . "/preview.jpg";
    	return $mainImage;
    }

	function getListProjects( $returnField, $conditionParams, $page, $limit, $orderby )
    {
    	$result = array() ;
		
		$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		
		$result['rows'] = iland4_layDanhSachDuAn($DBConfig, $returnField, $conditionParams , 
																$page, $limit, $orderby, $language);
		
    	return $result;
	}
    

    /*function getListProjects( $returnField, $page, $limit, $orderby )
    {
    	$result = array() ;
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
		$patch_split_f =   split("/", JFactory::getURI()->_path);	
    	$type_id = $mainframe->getUserStateFromRequest( $context.'type_id', 'type_id', 0, 'int' );
    	$town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
    	$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
		$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
			
		
		$language = ilandCommonUtils::getLanguage();
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$conditionParams =  ' 1 '; 
		
		$loai_du_an_id = JFactory::getURI()->getVar("loai_du_an_id");
		
		$isfontend = 1;
		foreach (  $patch_split_f as $patch_value )
		{
			if ( $patch_value =='administrator' )
			{
				$isfontend = 0;
				break;
			}	
		}
		if ( $isfontend )
		{
			$conditionParams .= ' AND hien_thi_ra_ngoai = 1';
		}
		else
		{
			if ( $published!=-1 ) $conditionParams .= ' AND hien_thi_ra_ngoai = '.$published;		
		}
		
		if( $emphasis != -1 ) $conditionParams .= ' AND noi_bat = '.$emphasis;		
		if ( $town_id!= 0 )  $conditionParams .= ' AND tinh_thanh_id = '.$town_id;
		if ( $area_id!= 0 &&  $town_id!= 0 )  $conditionParams .= ' AND quan_huyen_id = '.$area_id;
		if ( $type_id!= 0 )  $conditionParams .= ' AND loai_du_an_id = '.$type_id;
		if ( $search!=NULL )  $conditionParams .= ' AND ten LIKE \'%'. $search .'%\'';
		if( $loai_du_an_id ) $conditionParams .= ' AND loai_du_an_id = '.$loai_du_an_id;

		$result['search'] = $search ;
		$result['town_id'] = $town_id ;
		$result['area_id'] = $area_id ;
		$result['published'] = $published ;
		$result['emphasis'] = $emphasis ;
		$result['type_id'] = $type_id;
		$result['rows'] = iland4_layDanhSachDuAn($DBConfig, $returnField, $conditionParams , $page, $limit, $orderby, $language);
		
    	return $result;
	}

    */	
    // lay chi tiet du an
    function getProjectById( $id, $language )
    {
    	if($id == 0 ) /* gan duoc id cua no vao la ko can */
    	{
    		return U_ReModelProjects::laygiatrirong();    		
    	}
    	$db = JFactory::getDBO();
    	$sql = "select * from iland4_du_an_vi where id = $id";
    	$db->setQuery($sql);
    	$db->query();
    	return $db->loadAssoc();
    	//$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  	//return iland4_layChiTietDuAn($DBConfig, $id, $language );
    }
    
    
    // cap nhat tin noi bac
 	function updateProject( $id, $param, $language )
    {
    	$language = ilandCommonUtils::getLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  	return iland4_suaDuAn($DBConfig, $id,$param, $language);
    }
    
    // xoa project
 	function getProjectDelete( $id )
    {
    	$ArrayLanguage = ilandCommonUtils::getArrayLanguage();
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
  	  return iland4_xoaDuAn($DBConfig, $id, $ArrayLanguage);
    }
	
    
    function laynhomduan($language)
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_layDanhSachLoaiDuAn($DBConfig, $language);
    }
    
    function laynhamoigioi($language)
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
		return iland4_layDanhSachNhaMoiGioi($DBConfig, 'id, ten','1',1,10,$language);
    }
    
    //layDuAnLienQuan
 	function layDuAnLienQuan($paramfield, $projectId, $page, $limit,  $orderby, $language)
    {
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	
    	return  iland4_layDanhSachDuAn($DBConfig, $paramfield, ' 1 AND hien_thi_ra_ngoai = 1 ' , 
    														$page, $limit, $orderby, $language);
		//return iland4_layDanhSachNhaMoiGioi($DBConfig, $paramfield, $projectId, $currpage, $pagesize,  $order, $language);
    }
    
    
	function laygiatrirong()
    {
    	return $projectDataEn = array (
			 'id'            => '0',	 
    		 'ten'            => '',
			 'dia_chi'         => '',
			 'mo_ta_day_du'    => '',
			 'mo_ta_ngan'        => '',
			 'nha_dau_tu'        => '',
			 'don_vi_thi_cong'   => '',
			 'don_vi_quan_li'     => '',
			 'don_vi_thiet_ke'    => '',
			 'quy_hoach_tong_the' => '',
			 'so_do_mat_bang'      => '',
			 'tien_do'       => '',
			 'lien_he'       => '',
			 'dia_chi_lien_he'         => '',
			 'ten_lien_he'         => '',
	         'doi_tac'       => '',
			 'thanh_toan'       => '',
			 'tieu_de_trang'       => '',
			 'tu_khoa_trang'       => '',
			 'mo_ta_trang'       => '',
        	 'loai_du_an'       => '',
    		 'hien_thi_ra_ngoai' => '0'
		);
    	
    }
    
    function laydanhsachduan( $quanHuyenId = null, $tinhThanhId = null, $lang='vi' )
    {
    	// return id & name
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$paramfield = 'id, ten, alias';
    	$page = 1;
    	$limit = 10000;
    	$condition = ' 1 ';
    	if ( !empty( $quanHuyenId ) )
    	{
    		if ( strpos( $quanHuyenId, ',' ) > 0 )
    		{
    			$condition .= ' AND quan_huyen_id IN (' . $quanHuyenId . ') ';
    		} 
    		else 
    		{
    			$condition .= ' AND quan_huyen_id = ' . $quanHuyenId . ' ';
    		}
    	}
    	
    	if ( !empty( $tinhThanhId ) )
    	{
    		$condition .= ' AND tinh_thanh_id = ' . $tinhThanhId . ' ';
    	}
    	
    	$orderby = 'ten';
    	$language = 'vi';
    	
    	$result = iland4_layDanhSachDuAn($DBConfig, $paramfield, $condition , $page, $limit, $orderby, $language);
    	
    	return $result[3];  
    }
	function laydanhsachduanmulti( $quanHuyenId = null, $tinhThanhId = null, $lang='vi' )
    {
    	// return id & name
    	$DBConfig = ilandCommonUtils::getSiteDBConfig();
    	$paramfield = 'id, ten, alias';
    	$page = 1;
    	$limit = 10000;
    	$condition = ' 1 ';
    	if ( !empty( $quanHuyenId ) )
    	{
    		$condition .= ' AND quan_huyen_id in (' . $quanHuyenId . ' )';
    	}
    	
    	if ( !empty( $tinhThanhId ) )
    	{
    		$condition .= ' AND tinh_thanh_id = ' . $tinhThanhId . ' ';
    	}
    	
    	$orderby = 'ten';
    	$language = 'vi';
    	
    	$result = iland4_layDanhSachDuAn($DBConfig, $paramfield, $condition , $page, $limit, $orderby, $language);
    	
    	return $result[3];  
    }
 	
}

?>
