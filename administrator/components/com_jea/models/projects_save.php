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
    
    function getItems()
    {
        $result = array() ;
    	//$context = 'com_jea.properties.'.$this->_cat ;
    	$context = 'com_jea.projects' ;
        $mainframe =& JFactory::getApplication();
        
        $default_limit = $mainframe->getCfg('list_limit');
	    $limit         = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $default_limit, 'int' );
	    $limitstart    = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
	    $town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
    	$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
    	$order         = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
		$order_dir     = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
		$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
		$project_group_id = $mainframe->getUserStateFromRequest( $context.'project_group_id', 'project_group_id', 0, 'int' );

    
		   $select = 'SELECT tp.id AS `id`, tp.value AS `value`,tp.project_group_ids,tp.short_desc AS `short_desc`, tp.address AS `address`,'. PHP_EOL
         		. 'tp.emphasis AS `emphasis`,'. PHP_EOL
         		. 'tto.value AS `town`,ae.value AS `area`, tp.published AS published, tp.ordering AS `ordering`,' . PHP_EOL
         		. 'tp.checked_out AS `checked_out`, tp.checked_out_time AS `checked_out_time` ' . PHP_EOL
                . 'FROM #__jea_projects AS tp' . PHP_EOL
			    . 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id' . PHP_EOL
				. 'LEFT JOIN #__jea_areas AS ae ON ae.id = tp.area_id' . PHP_EOL;
		$where = "";
		
		if ( $published!=-1 )       $where .=($where)? ' AND tp.published=' . $published : ' WHERE tp.published=' . $published;
		if ( $emphasis!=-1 )       $where .= ($where)? ' AND tp.emphasis=' . $emphasis :' WHERE tp.emphasis=' . $emphasis;
		if ( $project_group_id!=0 )       $where .=($where)? " AND tp.project_group_ids LIKE '%$project_group_id%' ":" WHERE tp.project_group_ids LIKE '%$project_group_id%' ";
		if ( $town_id!=0 )       $where .=($where)? ' AND tp.town_id=' . $town_id:' WHERE tp.town_id=' . $town_id ;
		if ( $area_id!=0 )       $where .= ($where)?' AND tp.area_id=' . $area_id:' WHERE tp.area_id=' . $area_id ;
//		if ( $search ) {
//			$search = $this->_db->getEscaped( trim( strtolower( $search ) ) );
//			$where .= ' AND p.name LIKE \'%' .$search . '%\'';
//		}
		$sql = $select . $where .  ' ORDER BY ordering DESC';
		//echo $select;
		echo "<br>$where";
        $rows = $this->_getList( $sql , $limitstart, $limit );
        if ( !$this->_db->getErrorNum() ) {
        	  
         	$result['limitstart'] = $limitstart ;
			$result['limit'] = $limit ;
			$result['total'] = $this->_getListCount( $sql );
	        $result['rows'] = $rows ;
	        $result['town_id'] = $town_id ;
			$result['area_id'] = $area_id ;
	        $result['search'] = $search ;
	        $result['order'] = $order ;
	        $result['order_dir'] = $order_dir;
			$result['published'] = $published ;
			$result['emphasis'] = $emphasis ;
			//$result['created_by'] = $created_by ;
			$result['project_group_id'] = $project_group_id;
        } else {
            JError::raiseWarning( 200, $this->_db->getErrorMsg() );
            return false;
        }
         
        return $result ;
        
    }


    function order($inc)
    {
        $row =& $this->getRow();
        //Nam Hai chinh sua
//        $token_order =  $this->isRenting();
//        if($token_order==1) $where ='kind_id=1';
//        if($token_order==2) $where ='kind_id=2';
//        if($token_order==3) $where ='kind_id=3';
//        if($token_order==4) $where ='kind_id=4';
//        //$where = $this->isRenting() ? 'is_renting=1' : 'is_renting=0' ;
        $row->move( $inc ,$where);
    }

    function publish( $bool )
    {
    	$cid = $this->getCid();
		$user	= & JFactory::getUser();
		$uid	= $user->get('id');
    	
    	$table =& $this->getTable();
    	
    	if ( !$table->publish( $cid, (int)$bool, $uid) ){
    		JError::raiseWarning( 200, $table->getError() );
    		return false;
    	}
    	
		return true;
    }

    function emphasize()
    {
        $row =& $this->getRow();
        $row->emphasis = ($row->emphasis )? 0 : 1 ;
        $row->store();
    }

    function getItem()
    {
        $result = array();
        $row =& $this->getRow();
        
        if( $row->id == 0 ) {
        	
	        $row->published = 0;
	        $row->dispo ='';
        }
        
        $imgs = ComJea::getImagesById($row->id,true) ;
        $rootURL = JURI::root();
        $this->_cat='';
		if (!empty($imgs['main_image']) && is_array($imgs['main_image'])) {
	        $imgs['main_image']['delete_url'] = $rootURL . 'administrator/index2.php?option=com_jea'
	            .'&amp;controller='.JRequest::getVar('controller','').'&amp;task=deleteimg&amp;id='.$row->id.'&amp;cat=' . $this->_cat;
		}
            
        foreach ( $imgs['secondaries_images']  as $k => $v) {
        	$imgs['secondaries_images'][$k]['delete_url'] = $rootURL . 'administrator/index.php?option=com_jea'
                    .'&amp;controller='.JRequest::getVar('controller','').'&amp;task=deleteimg&amp;id=' . $row->id
                    .'&amp;image='.$v['name'].'&amp;cat=' .$this->_cat ;
        }
        
		$result['row'] = $row;
        
        return $result + $imgs ;

    }

    function save()
    {
    	
        $row = & $this->getRow();
        
        $datas = array(
        	//'name'            => JRequest::getVar( 'name', '', 'POST' ),
			//'address'         => JRequest::getVar( 'address' , '', 'POST' ),
			'town_id'        => JRequest::getInt( 'town_id', 0 , 'POST' ),
			'area_id'        => JRequest::getInt( 'area_id', 0 , 'POST' ),
			'type_id'        => JRequest::getInt( 'type_id', 0 , 'POST' ),
			'project_advantage_id'        => JRequest::getVar( 'project_group_ids', array(), 'POST', 'array'  ),
			//'description'    => JRequest::getVar( 'description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			//'short_description'        => JRequest::getVar( 'short_description', '', 'POST', 'string', JREQUEST_ALLOWRAW),
			'start_date'           => JRequest::getVar( 'start_date','', 'POST' ),
			'end_date' => JRequest::getVar( 'end_date', '', 'POST' ),
			'people_area'   => JRequest::getVar( 'people_area', '' , 'POST' ),
			'status'      => JRequest::getVar( 'status', '' , 'POST' ),
			//'investor'        => JRequest::getVar( 'investor', '' , 'POST' ),
			//'implement_unit'   => JRequest::getVar( 'implement_unit' , '', 'POST' ),
			//'management_unit'          => JRequest::getVar( 'management_unit','' , 'POST' ),
			//'design_unit'     => JRequest::getVar( 'design_unit', '', 'POST' ),
			'total_area'    => JRequest::getVar( 'total_area', '', 'POST'),
			'number_of_floor'      => JRequest::getVar( 'number_of_floor', '' , 'POST' ),
			//'scheme'       => JRequest::getVar( 'scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			//'plain_diagram'      => JRequest::getVar( 'plain_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			//'progress'       => JRequest::getVar( 'progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			//'contacts'       => JRequest::getVar( 'contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			'newest'       => JRequest::getVar( 'newest', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
			//'contact_address'         => JRequest::getVar( 'contact_address' , '', 'POST' ),
			//'contact_name'         => JRequest::getVar( 'contact_name' , '', 'POST' ),
			'contact_phone'         => JRequest::getVar( 'contact_phone' , '', 'POST' ),
			//'payment'       => JRequest::getVar( 'payment', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		//	'page_title'       => JRequest::getVar( 'page_title', 0 , 'POST' ),
			//'page_keywords'       => JRequest::getVar( 'page_keywords', 0 , 'POST' ),
		//	'page_description'       => JRequest::getVar( 'page_description', 0 , 'POST' ),
			'published'      => JRequest::getInt( 'published', 0 , 'POST' ),
			'emphasis'       => JRequest::getInt( 'emphasis', 0 , 'POST' ),
			
		// ngon ngu tieng viet
		 'vi_name'            => JRequest::getVar( 'vi_hidden_name', '', 'POST' ),
		 'vi_address'         => JRequest::getVar( 'vi_hidden_address' , '', 'POST' ),
		 'vi_description'    => JRequest::getVar( 'vi_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'vi_short_description'        => JRequest::getVar( 'vi_hidden_short_description', '', 'POST', 'string', JREQUEST_ALLOWRAW),
		 'vi_investor'        => JRequest::getVar( 'vi_hidden_investor', '' , 'POST' ),
		 'vi_implement_unit'   => JRequest::getVar( 'vi_hidden_implement_unit' , '', 'POST' ),
		 'vi_management_unit'          => JRequest::getVar( 'vi_hidden_management_unit','' , 'POST' ),
		 'vi_design_unit'     => JRequest::getVar( 'vi_hidden_design_unit', '', 'POST' ),
		 'vi_scheme'       => JRequest::getVar( 'vi_hidden_scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'vi_plain_diagram'      => JRequest::getVar( 'vi_hidden_plain_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'vi_progress'       => JRequest::getVar( 'vi_hidden_progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'vi_contacts'       => JRequest::getVar( 'vi_hidden_contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'vi_contact_address'         => JRequest::getVar( 'vi_hidden_contact_address' , '', 'POST' ),
		 'vi_contact_name'         => JRequest::getVar( 'vi_hidden_contact_name' , '', 'POST' ),
		 'vi_payment'       => JRequest::getVar( 'vi_hidden_payment', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'vi_page_title'       => JRequest::getVar( 'vi_hidden_page_title', 0 , 'POST' ),
		 'vi_page_keywords'       => JRequest::getVar( 'vi_hidden_page_keywords', 0 , 'POST' ),
		 'vi_page_description'       => JRequest::getVar( 'vi_hidden_page_description', 0 , 'POST' ),
        
        		// ngon ngu tieng anh
		 'en_name'            => JRequest::getVar( 'en_hidden_name', '', 'POST' ),
		 'en_address'         => JRequest::getVar( 'en_hidden_address' , '', 'POST' ),
		 'en_description'    => JRequest::getVar( 'en_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'en_short_description'        => JRequest::getVar( 'en_hidden_short_description', '', 'POST', 'string', JREQUEST_ALLOWRAW),
		 'en_investor'        => JRequest::getVar( 'en_hidden_investor', '' , 'POST' ),
		 'en_implement_unit'   => JRequest::getVar( 'en_hidden_implement_unit' , '', 'POST' ),
		 'en_management_unit'          => JRequest::getVar( 'en_hidden_management_unit','' , 'POST' ),
		 'en_design_unit'     => JRequest::getVar( 'en_hidden_design_unit', '', 'POST' ),
		 'en_scheme'       => JRequest::getVar( 'en_hidden_scheme', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'en_plain_diagram'      => JRequest::getVar( 'en_hidden_plain_diagram', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'en_progress'       => JRequest::getVar( 'en_hidden_progress', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
		 'en_contacts'       => JRequest::getVar( 'en_hidden_contacts', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'en_contact_address'         => JRequest::getVar( 'en_hidden_contact_address' , '', 'POST' ),
		 'en_contact_name'         => JRequest::getVar( 'en_hidden_contact_name' , '', 'POST' ),
		 'en_payment'       => JRequest::getVar( 'en_hidden_payment', '', 'POST' , 'string', JREQUEST_ALLOWRAW),
		 'en_page_title'       => JRequest::getVar( 'en_hidden_page_title', 0 , 'POST' ),
		 'en_page_keywords'       => JRequest::getVar( 'en_hidden_page_keywords', 0 , 'POST' ),
		 'en_page_description'       => JRequest::getVar( 'en_hidden_page_description', 0 , 'POST' ),
			
        );
		/*
		ordering
checkout
checkout_time
*/
        print_r($datas);
		exit;
      //  if ($created_by = JRequest::getInt( 'created_by', 0 , 'POST' )){
      //      $datas['created_by'] = $created_by;
       // }
        	//$currentSession = & JFactory::getSession() ;
        	
        
      
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

    	$secondImage = new Http_File( JRequest::getVar( 'secondaries_images0', array(), 'files', 'array' ) );
		$secondImage1 = new Http_File( JRequest::getVar( 'secondaries_images1', array(), 'files', 'array' ) );
		$secondImage2 = new Http_File( JRequest::getVar( 'secondaries_images2', array(), 'files', 'array' ) );
		$secondImage3 = new Http_File( JRequest::getVar( 'secondaries_images3', array(), 'files', 'array' ) );
        
		
		$secondImage = new Http_File( JRequest::getVar( 'secondaries_images0', array(), 'files', 'array' ) );
    	$secondImage1 = new Http_File( JRequest::getVar( 'secondaries_images1', array(), 'files', 'array' ) );
    	$secondImage2 = new Http_File( JRequest::getVar( 'secondaries_images2', array(), 'files', 'array' ) );
    	$secondImage3 = new Http_File( JRequest::getVar( 'secondaries_images3', array(), 'files', 'array' ) );

        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS . "Plan_".$id;
        
        $config =& ComJea::getParams();
        
        $maxPreviewWidth = $config->get('max_previews', 400) ;
        $maxThumbnailWidth = $config->get('max_thumbnails', 120);
        $maxThumbnailHeight = 90 ; //default max height : 90px
        $jpgQuality = $config->get( 'jpg_quality' , 90) ;

        //main image
        if ( $mainImage->isPosted() ){
            	
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
        }

        if($secondImage->isPosted()){

            $upload_dir = $upload_dir.DS.'secondary';
            $preview_dir = $upload_dir.DS.'preview' ;
            $thumbnail_dir = $upload_dir.DS.'min' ;
        	if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        	if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        	if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
	
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
        }

		  if($secondImage1->isPosted()){
		  	$upload_dir = $base_upload_dir . DS . "Plan_".$id;
            $upload_dir = $upload_dir.DS.'secondary';
            $preview_dir = $upload_dir.DS.'preview' ;
            $thumbnail_dir = $upload_dir.DS.'min' ;
        	if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        	if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        	if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
	
            $secondImage1->setValidExtensions( $validExtensions );
            $secondImage1->nameToSafe();
            	
            if(! $fileName = $secondImage1->moveTo( $upload_dir )){
                JError::raiseWarning( 200, JText::_( $secondImage1->getError() ) );
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
        }
        
    if($secondImage2->isPosted()){
    	  $upload_dir = $base_upload_dir . DS . "Plan_".$id;
            $upload_dir = $upload_dir.DS.'secondary';
            $preview_dir = $upload_dir.DS.'preview' ;
            $thumbnail_dir = $upload_dir.DS.'min' ;
        	if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        	if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        	if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
	
            $secondImage2->setValidExtensions( $validExtensions );
            $secondImage2->nameToSafe();
            	
            if(! $fileName = $secondImage2->moveTo( $upload_dir )){
                JError::raiseWarning( 200, JText::_( $secondImage2->getError() ) );
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
        }
   
           if($secondImage3->isPosted()){
    	  $upload_dir = $base_upload_dir . DS . "Plan_".$id;
            $upload_dir = $upload_dir.DS.'secondary';
            $preview_dir = $upload_dir.DS.'preview' ;
            $thumbnail_dir = $upload_dir.DS.'min' ;
        	if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        	if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        	if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
	
            $secondImage3->setValidExtensions( $validExtensions );
            $secondImage3->nameToSafe();
            	
            if(! $fileName = $secondImage3->moveTo( $upload_dir )){
                JError::raiseWarning( 200, JText::_( $secondImage3->getError() ) );
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
    
}

?>
