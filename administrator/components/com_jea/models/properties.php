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
//require_once ( JPATH_COMPONENT . DS .'utils.php' );
// print_r(JPATH_ROOT . '/libraries/com_u_re/js/utils.php');
require_once(JPATH_ROOT . '/libraries/com_u_re/js/utils.php');
class JeaModelProperties extends JModel
{

	
    var $_error = '';

    /**
     * property category ( renting or selling )
     *
     * @var string $_cat
     */

    var $_cat = '';
    
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
	/*
	function getCategory()
	{
		return $this->_cat ;
	}
   
    function setCategory($cat)
    {
    	//Nam Hai chinh lai gia tri cac cat
       if ( !($cat == 'renting' or $cat == 'selling' or $cat=='needrenting' or $cat == 'needbuying' ) ) {

           return false;
       }
       $this->_cat = $cat;
       
       return true;
    }
    
    function isRenting()
    {
		if($this->_cat =='selling') return 1;
        if($this->_cat =='renting') return 2;
        if($this->_cat =='needbuying') return 3;
        if($this->_cat =='needrenting') return 4;
        
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
    
    /*
    
    function getItems()
    {
        $result = array() ;
    	//$context = 'com_jea.properties.'.$this->_cat ;
    	$context = 'com_jea.properties.selling' ;
        $mainframe =& JFactory::getApplication();
        $user		= & JFactory::getUser();
		$userid	= $user->get('id');
		$usergid	= $user->get('gid');
		
        
        $default_limit = $mainframe->getCfg('list_limit');
        
	    $limit         = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $default_limit, 'int' );
	    $limitstart    = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
	    $type_id       = $mainframe->getUserStateFromRequest( $context.'type_id', 'type_id', 0, 'int' );
	    $town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
	    $department_id = $mainframe->getUserStateFromRequest( $context.'department_id', 'department_id', 0, 'int' );
    	$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
    	$order         = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
		$order_dir     = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
		$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
		$created_by       = $mainframe->getUserStateFromRequest( $context.'created_by', 'created_by', -1, 'int' );
		$newsest       = $mainframe->getUserStateFromRequest( $context.'newsest', 'newsest', -1, 'int' );
        $select = 'SELECT tp.id AS `id`, tp.ref AS `ref`,tp.description AS `description`, tp.address AS `adress`, tp.price AS `price`,pri.value as price_unit,' . PHP_EOL
         		.'priare.value AS area_unit, tp.date_insert AS `date_insert`,tp.emphasis AS `emphasis`, td.value AS `department`,tp.newsest AS newsest,'. PHP_EOL
         		. 'tt.value AS `type`, tto.value AS `town`,ae.value AS `area`, tp.published AS published, tp.ordering AS `ordering`,' . PHP_EOL
         		. 'tp.checked_out AS `checked_out`, tp.checked_out_time AS `checked_out_time`,' . PHP_EOL
         		. 'tp.created_by AS  `created_by`, tu.username AS `author`' . PHP_EOL
                . 'FROM #__jea_properties AS tp' . PHP_EOL
                . 'LEFT JOIN #__jea_departments AS td ON td.id = tp.department_id' . PHP_EOL
			    . 'LEFT JOIN #__jea_types AS tt ON tt.id = tp.type_id' . PHP_EOL
			    . 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id' . PHP_EOL
				. 'LEFT JOIN #__jea_areas AS ae ON ae.id = tp.area_id' . PHP_EOL
			    . 'LEFT JOIN #__users AS tu ON tu.id = tp.created_by' . PHP_EOL
			     . 'LEFT JOIN #__jea_price_units AS pri ON pri.id = tp.price_unit' . PHP_EOL
			      . 'LEFT JOIN #__jea_price_area_units AS priare ON priare.id = tp.price_area_unit' . PHP_EOL;
    	$where  = 'WHERE tp.kind_id=' ;
		
    	//Nam Hai chinh sua cho nay
    	$token = $this->isRenting();
    	
    	$where .=$token;
        //$where .= $this->isRenting() ? '1' : '0' ;
        if ( $town_id )
		{
			$where .= ' AND tp.town_id=' . $town_id ;
			
			// set where cho area_id khi doi Tinh/Thanh
		if ( $area_id )
		{
			
			$selectArea='SELECT id FROM #__jea_areas WHERE town_id='.$town_id;
			$rowsArea=$this->_getList($selectArea);
			foreach($rowsArea as $row)
			{
			if($row->id==$area_id)
			$where .= ' AND tp.area_id=' . $area_id ;
			}
			
			
		}
		// ket thuc set where
		}
		
//        if ( $area_id ) $where .= ' AND tp.area_id=' . $area_id ;
		if ( $published!=-1 )       $where .= ' AND tp.published=' . $published ;
		if ( $emphasis!=-1 )       $where .= ' AND tp.emphasis=' . $emphasis ;
		if ( $created_by!=-1 )       $where .= ' AND tp.created_by=' . $created_by ;
        if ( $type_id )       $where .= ' AND tp.type_id=' . $type_id ;
		if ( $search ) {
			$search = $this->_db->getEscaped( trim( strtolower( $search ) ) );
			$where .= ' AND tp.ref LIKE \'%' .$search . '%\'';
		}
		
    	/* hoan: nếu là admin thì sẽ hiện all else chỉ hiện của nó */
	/*
			if($usergid <= 24)
			{
				if(!empty($where)){
	                    $where .= ' AND tp.created_by = '. $userid;
	                } else {
	                	
	                    $where .= ' WHERE tp.created_by ='.   $userid;
	                }
			}
		
		//echo $where.'<br>';
		$sql = $select . $where .  ' ORDER BY ' . $order . ' ' . strtoupper( $order_dir ) ;
        $rows = $this->_getList( $sql , $limitstart, $limit );
//echo $sql;
        if ( !$this->_db->getErrorNum() ) {
        	  
         	$result['limitstart'] = $limitstart ;
			$result['limit'] = $limit ;
			$result['total'] = $this->_getListCount( $sql );
	        $result['rows'] = $rows ;
	        $result['type_id'] = $type_id ;
	        $result['town_id'] = $town_id ;
			$result['area_id'] = $area_id ;
	        $result['department_id'] = $department_id ;
	        $result['search'] = $search ;
	        $result['order'] = $order ;
	        $result['order_dir'] = $order_dir;
			$result['published'] = $published ;
			$result['emphasis'] = $emphasis ;
			$result['created_by'] = $created_by ;
        } else {
            JError::raiseWarning( 200, $this->_db->getErrorMsg() );
            return false;
        }
        print_r($result);
		exit;
        return $result ;
        
    }


    function order($inc)
    {
        $row =& $this->getRow();
        //Nam Hai chinh sua
        $token_order =  $this->isRenting();
        if($token_order==1) $where ='kind_id=1';
        if($token_order==2) $where ='kind_id=2';
        if($token_order==3) $where ='kind_id=3';
        if($token_order==4) $where ='kind_id=4';
        //$where = $this->isRenting() ? 'is_renting=1' : 'is_renting=0' ;
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
//    hoan dang lam
 	function newsest()
    {
        $row =& $this->getRow();
        $row->newsest = ($row->newsest )? 0 : 1 ;
        $row->store();
    }
    */
	/*
        function getItem()
    {
        $result = array();
        $row =& $this->getRow();
        
        if( $row->id == 0 ) {
        	
	        $row->published = 0;
	        $row->dispo ='';
        }
        
        $imgs = ComJea::getImagesById($row->id) ;
        $rootURL = JURI::root();
        
		if (!empty($imgs['main_image']) && is_array($imgs['main_image'])) {
	        $imgs['main_image']['delete_url'] = $rootURL . 'administrator/index2.php?option=com_jea'
	            .'&amp;controller=properties&amp;task=deleteimg&amp;id='.$row->id.'&amp;cat=' . $this->_cat;
		}
            
        foreach ( $imgs['secondaries_images']  as $k => $v) {
        	$imgs['secondaries_images'][$k]['delete_url'] = $rootURL . 'administrator/index.php?option=com_jea'
                    .'&amp;controller=properties&amp;task=deleteimg&amp;id=' . $row->id
                    .'&amp;image='.$v['name'].'&amp;cat=' .$this->_cat ;
        }
		  foreach ( $imgs['secondaries_images1']  as $k => $v) {
        	$imgs['secondaries_images1'][$k]['delete_url'] = $rootURL . 'administrator/index.php?option=com_jea'
                    .'&amp;controller=properties&amp;task=deleteimg&amp;id=' . $row->id
                    .'&amp;image='.$v['name'].'&amp;cat=' .$this->_cat ;
        }
          foreach ( $imgs['secondaries_images2']  as $k => $v) {
        	$imgs['secondaries_images2'][$k]['delete_url'] = $rootURL . 'administrator/index.php?option=com_jea'
                    .'&amp;controller=properties&amp;task=deleteimg&amp;id=' . $row->id
                    .'&amp;image='.$v['name'].'&amp;cat=' .$this->_cat ;
        }
		  foreach ( $imgs['secondaries_images3']  as $k => $v) {
        	$imgs['secondaries_images3'][$k]['delete_url'] = $rootURL . 'administrator/index.php?option=com_jea'
                    .'&amp;controller=properties&amp;task=deleteimg&amp;id=' . $row->id
                    .'&amp;image='.$v['name'].'&amp;cat=' .$this->_cat ;
        }
		$result['row'] = $row;
        
        return $result + $imgs ;

    }
*/
    function save()
    {
   	//print_r('co vao save');
   //	exit;
    	global $mainframe;
        $row = & $this->getRow();
        $curprice=JRequest::getFloat( 'price', 0.0, 'POST' );
     	 if(JRequest::getInt( 'price_unit', 0 , 'POST' )=='8')
        {
        $price_unit="1";
        $price=$curprice*1000000;
        }
        else if(JRequest::getInt( 'price_unit', 0 , 'POST' )=='7')
     	{
        $price_unit="1";
        $price=$curprice*1000000000;
        }
        else
        {
         $price_unit= JRequest::getInt( 'price_unit', 0 , 'POST' );
          $price=JRequest::getFloat( 'price', 0.0, 'POST' );
        }
      
        $datas = array(
        
			'type_id'        => JRequest::getInt( 'type_id', 0 , 'POST' ),
			
			'town_id'        => JRequest::getInt( 'town_id', 0 , 'POST' ),
			'area_id'        => JRequest::getInt( 'area_id', 0 , 'POST' ),
			'direction_id'   => JRequest::getInt( 'direction_id', 0 , 'POST' ),
			'project_id'   => JRequest::getInt( 'project_id', 0 , 'POST' ),
			'project_group_id'   => JRequest::getInt( 'project_group_id', 0 , 'POST' ),
			'living_space'   => JRequest::getVar( 'living_space', 0 , 'POST' ),
			'rooms'          => JRequest::getInt( 'rooms', 0 , 'POST' ),
			'mainrooms'          => JRequest::getInt( 'mainrooms', 0 , 'POST' ),
			'bed_room'          => JRequest::getInt( 'bed_room', 0 , 'POST' ),
			'bathrooms'      => JRequest::getInt( 'bathrooms', 0 , 'POST' ),
			'toilets'        => JRequest::getInt( 'toilets', 0 , 'POST' ),
			'floor'          => JRequest::getInt( 'floor', 0 , 'POST' ),
			//'advantages'     => JRequest::getVar( 'advantages', array(), 'POST', 'array' ),
			
			'published'      => JRequest::getVar( 'published', 0 , 'POST' ),
			'emphasis'       => JRequest::getInt( 'emphasis', 0 , 'POST' ),
			
			'contact_phone'       => JRequest::getVar( 'phone_vl', '', 'POST' ),
			'living_width'       => JRequest::getVar( 'living_width', '', 'POST' ),
			'living_length'       => JRequest::getVar( 'living_length', '', 'POST' ),
        	'legal_id'        => JRequest::getInt( 'legal_status', 0 , 'POST' ),
       		'price_area_unit'   => JRequest::getInt( 'price_area_unit', 0 , 'POST' )   ,
	        'position_id'   => JRequest::getInt( 'position', 0 , 'POST' )   ,
	    
          	'area_length'   => JRequest::getVar( 'kv_length', 0 , 'POST' ) ,
         	'area_width'   => JRequest::getVar( 'kv_width', 0 , 'POST' ) ,
          	'construction_length'   => JRequest::getVar( 'xd_length', 0 , 'POST' ) ,
          	'construction_width'   => JRequest::getVar( 'xd_width', 0 , 'POST' ) ,
         
        	'traffic_id'     => JRequest::getVar( 'trafficmovement', array(), 'POST', 'array' ),
        	'newsest'       => JRequest::getInt( 'newsest', 0 , 'POST' ),
        	'curency_id'        =>   $price_unit,
         	'price'          => $price,
        	'realtor_id'       => JRequest::getInt( 'realtor', 0 , 'POST' ),
      		
       		'transaction_type_id'       => JRequest::getInt( 'kind_id', 0 , 'POST' ),
			'map_lat'       => JRequest::getFloat( 'map_lat', 0 , 'POST' ),
        	'map_lng'       => JRequest::getFloat( 'map_lng', 0 , 'POST' ),
      		'pro_total_info'       => JRequest::getVar( 'pro_total_info', 0 , 'POST' ),
        	
			'advantages'       => JRequest::getVar( 'advantagesGetValue', 0 , 'POST' ),
			
			'street'       => JRequest::getVar( 'street', 0 , 'POST' ),		// chua co textbox
			'ward'       => JRequest::getVar( 'ward', 0 , 'POST' ),		// chua co textbox
			'contact_email'       => JRequest::getVar( 'contact_email', 0 , 'POST' ),		// chua co textbox
			'street'       => JRequest::getVar( 'street', 0 , 'POST' ),		// chua co textbox
			
			/* Nhung feild se thay doi khi co ngon ngu moi */
			//default
			'title'            => JRequest::getVar( 'vi_hidden_ref', '', 'POST' ),
			'address'         => JRequest::getVar( 'vi_hidden_address' , '', 'POST' ),
			'description'    => JRequest::getVar( 'vi_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'contact_name'       => JRequest::getVar( 'vi_hidden_name_vl', '', 'POST' ),
			'contact_address'      => JRequest::getVar( 'vi_hidden_address_vl', '', 'POST' ),
			'contact_note'   => JRequest::getVar( 'vi_hidden_ghichu', 0 , 'POST' ) ,
			'page_title'       => JRequest::getVar( 'vi_hidden_page_title', 0 , 'POST' ),
       		'page_keywords'       => JRequest::getVar( 'vi_hidden_page_keywords', 0 , 'POST' ),
        	'page_description'       => JRequest::getVar( 'vi_hidden_page_description', 0 , 'POST' ),
			'properties_code'       => JRequest::getVar( 'vi_hidden_properties_key', 0 , 'POST' ),
			
			//viet nam
			'vi_title'            => JRequest::getVar( 'vi_hidden_ref', '', 'POST' ),
			'vi_address'         => JRequest::getVar( 'vi_hidden_address' , '', 'POST' ),
			'vi_description'    => JRequest::getVar( 'vi_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'vi_contact_name'       => JRequest::getVar( 'vi_hidden_name_vl', '', 'POST' ),
			'vi_contact_address'      => JRequest::getVar( 'vi_hidden_address_vl', '', 'POST' ),
			'vi_contact_note'   => JRequest::getVar( 'vi_hidden_ghichu', 0 , 'POST' ) ,
			'vi_page_title'       => JRequest::getVar( 'vi_hidden_page_title', 0 , 'POST' ),
       		'vi_page_keywords'       => JRequest::getVar( 'vi_hidden_page_keywords', 0 , 'POST' ),
        	'vi_page_description'       => JRequest::getVar( 'vi_hidden_page_description', 0 , 'POST' ),
			'vi_properties_code'       => JRequest::getVar( 'vi_hidden_properties_key', 0 , 'POST' ),
			
			//english
			'en_title'            => JRequest::getVar( 'en_hidden_ref', '', 'POST' ),
			'en_address'         => JRequest::getVar( 'en_hidden_address' , '', 'POST' ),
			'en_description'    => JRequest::getVar( 'en_hidden_description', '', 'POST', 'string', JREQUEST_ALLOWRAW ),
			'en_contact_name'       => JRequest::getVar( 'en_hidden_name_vl', '', 'POST' ),
			'en_contact_address'      => JRequest::getVar( 'en_hidden_address_vl', '', 'POST' ),
			'en_contact_note'   => JRequest::getVar( 'en_hidden_ghichu', 0 , 'POST' ) ,
			'en_page_title'       => JRequest::getVar( 'en_hidden_page_title', 0 , 'POST' ),
       		'en_page_keywords'       => JRequest::getVar( 'en_hidden_page_keywords', 0 , 'POST' ),
        	'en_page_description'       => JRequest::getVar( 'en_hidden_page_description', 0 , 'POST' ),
			'en_properties_code'       => JRequest::getVar( 'en_hidden_properties_key', 0 , 'POST' ),
			
        );
		
		/*
ordering
date_created
checked_out
date_modified
checked_out_time
 $datas['success'] = 0;
*/

       // print_r($datas);
		//exit;
        if ($created_by = JRequest::getInt( 'created_by', 0 , 'POST' )){
            $datas['created_by'] = $created_by;
        }
 
        
        if ( !$row->bind($datas) ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }

        //Nam Hai chinh sua
        $token_save =$this->isRenting();
      //  print_r($row);
		///exit;
//         print_r($row);
//             exit;
        //$row->is_renting = $this->isRenting() ? 1 : 0;
//        $row->kind_id = $token_save;
        
        if ( ! $row->check() ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
       
        if ( !$row->store() ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
//print_r($row);
         //  exit;
        //check newsletter
        $row->checkin();

		if ( !$this->_uploadImages($row->id) ) {
			JError::raiseWarning( 200, 'Image upload error' );
            return false;
		}
		
		$this->_lastId = $row->id;
		
		if(JRequest::getVar( 're_link', 0 , 'POST' ))
		{
			$dd = JRequest::getVar( 're_link', 0 , 'POST' );
			if($dd == 1)
				{
					$mainframe->redirect('index.php?option=com_jea&task=search&view=properties&catDirect=selling&Itemid=10&lang=vi&layout=default&id='.$row->id);
				}
			else
	//			if($dd == 2)
	//			{
	//				echo "<script>alert('Tin đã được đăng')</script>";
	//				$mainframe->redirect('index.php?option=com_jea&view=manage&Itemid=8&lang=vi');
	//
	//			}
	//			else
				{
	//				echo "<script>alert('Tin đã được lưu')</script>";
					$mainframe->redirect('index.php?option=com_jea&view=manage&Itemid=8&lang=vi');
				}
		}
			
		

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
		
		$query = 'SELECT '.implode(', ', $fields).' FROM #__jea_properties WHERE id IN (' . $cids . ')';

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
		
		$query = 'INSERT INTO #__jea_properties ('.implode(', ', $fields).') VALUES' . "\n"
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
		$this->_db->setQuery( 'DELETE FROM `#__jea_properties` WHERE id IN (' . $cids . ')' );
		
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
		$dir = JPATH_ROOT . DS . 'images' .DS. 'com_jea' .DS. 'images' .DS. $row->id.DS ;
		
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
			
			//secondary image to delete
			$deleteFiles[] = $dir.'secondary1'.DS.$image;
			$deleteFiles[] = $dir.'secondary1'.DS.'preview1'.DS.$image;
			$deleteFiles[] = $dir.'secondary1'.DS.'min1'.DS.$image;
			
			//secondary image to delete
			$deleteFiles[] = $dir.'secondary2'.DS.$image;
			$deleteFiles[] = $dir.'secondary2'.DS.'preview2'.DS.$image;
			$deleteFiles[] = $dir.'secondary2'.DS.'min2'.DS.$image;
			
			//secondary image to delete
			$deleteFiles[] = $dir.'secondary3'.DS.$image;
			$deleteFiles[] = $dir.'secondary3'.DS.'preview3'.DS.$image;
			$deleteFiles[] = $dir.'secondary3'.DS.'min3'.DS.$image;
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
    	$validExtensions = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP') ;
    	
		$mainImage   = new Http_File( JRequest::getVar( 'main_image', array(), 'files', 'array' ) ) ;
		
    	$secondImage = new Http_File( JRequest::getVar( 'secondaries_images0', array(), 'files', 'array' ) );
    	$secondImage1 = new Http_File( JRequest::getVar( 'secondaries_images1', array(), 'files', 'array' ) );
    	$secondImage2 = new Http_File( JRequest::getVar( 'secondaries_images2', array(), 'files', 'array' ) );
    	$secondImage3 = new Http_File( JRequest::getVar( 'secondaries_images3', array(), 'files', 'array' ) );
    	


        if ( !JFolder::exists($base_upload_dir) ) { JFolder::create($base_upload_dir); }

        $upload_dir = $base_upload_dir . DS . $id;
        
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
			    $upload_dir = $base_upload_dir . DS . $id;
            $upload_dir = $upload_dir.DS.'secondary';
            $preview_dir = $upload_dir.DS.'preview' ;
            $thumbnail_dir = $upload_dir.DS.'min' ;
        	if ( !JFolder::exists($upload_dir) ) { JFolder::create($upload_dir); }
        	if ( !JFolder::exists($preview_dir) ) { JFolder::create($preview_dir); }
        	if ( !JFolder::exists($thumbnail_dir) ) { JFolder::create($thumbnail_dir); }
	            // start debug
//           echo "<  pre>";
//           print_r( $upload_dir );
//           echo "</pre>";
//            end debug
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
			    $upload_dir = $base_upload_dir . DS . $id;
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
			$upload_dir = $base_upload_dir . DS . $id;
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
		    $upload_dir = $base_upload_dir . DS . $id;
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
      
    /* lay danh sach cac du an */
    function getListProperties( $returnField, $page, $limit, $language, $site)
    {
    	$result = array() ;
		$context = 'com_jea.projects' ;
    	$mainframe =& JFactory::getApplication();
    	$type_id = $mainframe->getUserStateFromRequest( $context.'type_id', 'type_id', 0, 'int' );
    	
    	$town_id       = $mainframe->getUserStateFromRequest( $context.'town_id', 'town_id', 0, 'int' );
		$area_id       = $mainframe->getUserStateFromRequest( $context.'area_id', 'area_id', 0, 'int' );
    	$search        = $mainframe->getUserStateFromRequest( $context.'search', 'search', '', 'string' );
//    	$order         = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
//		$order_dir     = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
		$published       = $mainframe->getUserStateFromRequest( $context.'published', 'published', -1, 'int' );
		$emphasis       = $mainframe->getUserStateFromRequest( $context.'emphasis', 'emphasis', -1, 'int' );
		
//    	print_r($project_group_id);
//    	exit;
//    	$order         = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
//		$order_dir     = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
    	$offsetLimitArr = U_ReUtils::getOffsetLimit( $page, $limit );
//		if ( $emphasis )
//		{
//			echo "typeid khac ko";
//			echo $published;
			//exit;
//		}
		
//		 $rows = $this->_getList( $sql , $limitstart, $limit );
//        if ( !$this->_db->getErrorNum() )
//        {
         
			
			
//        }

//		print_r($type_id);
		$cat=JFactory::getURI()->getVar("cat");
		switch ( $cat )
		{
			case 'selling' :  $Kindwhere = " kind_id=1";
			break;
			case 'renting' :  $Kindwhere = " kind_id=2";
			break;
			case 'needbuying' :  $Kindwhere = " kind_id=3";
			break;
			case 'needrenting' :  $Kindwhere = " kind_id=4";
			break;
			default: $Kindwhere = " kind_id=1";
			break;
			
		}
		
    	$conditionParams =  $Kindwhere ; //gan tam
    	$conditionParams =  ' id<>0' ; //gan tam
		if( $emphasis != -1 ) $conditionParams .= ' AND emphasis = '.$emphasis;
		if ( $published!=-1 )  $conditionParams .= ' AND published = '.$published;
		if ( $town_id!= 0 )  $conditionParams .= ' AND town_id = '.$town_id;
		if ( $area_id!= 0 &&  $town_id!= 0 )  $conditionParams .= ' AND area_id = '.$area_id;
		if ( $type_id!= 0 )  $conditionParams .= ' AND type_id = '.$type_id;
		if ( $search!=NULL )  $conditionParams .= ' AND title LIKE "'. $search .'"';
//		print_r($conditionParams);
		$result['search'] = $search ;
		$result['town_id'] = $town_id ;
		$result['area_id'] = $area_id ;
		$result['published'] = $published ;
		$result['emphasis'] = $emphasis ;
		$result['type_id'] = $type_id;
		$result['rows'] = getPropertyList($site, $returnField, $conditionParams ,$offsetLimitArr, $limit, $language);
//		print_r($result['rows']);
//		exit;
    	return $result;
    	
		/*
    		$db =& JFactory::getDBO();
//    		id, name, published, short_description, type_id, address, town_value, area_id, emphasis, checked_out
//	        $query  = "SELECT '".$returnField."'  FROM jos_jea_project_vi";
	        $query  = "SELECT id, name, published, short_description, type_id, address, town_id, area_id, emphasis FROM jos_jea_project_vi";
	        $db->setQuery($query);
			$result = $db->loadRowList();
			print_r($result);
			exit;
		*/
//		$t = getProjectList($returnField, $conditionParams ,0, 10, 'vi',$site);
//    	$t = U_reSimulTest::getProjectList($returnField,'', $offsetLimitArr, $limit);
//    	print_r($t);
//    	exit;

    }
    
        // xoa project
 	function getPropertiestDelete($site, $id, $language)
    {
    	print_r($id);
    	print_r($site);
	$n =array ();
	$n[]='vi';
	$n[]='en';
	 
  	  return deleteProperty($site, $id, $n);
    }
    
	function getUpdateProperties($site, $id,$param, $language)
    {
  	  return updateProperty($site, $id,$param, $language);
    }
    

    
    
    
}


