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

class U_ReModelProperties
{
    var $_error = '';
    
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		// init lib
	}
    
	/*
    * Description: Get property by id 
    * Author: Minh Chau
    * Version: 1.0
    * Date create: 05-03-2011
    */
    function &getPropertyById( $id )
    {
    	// get data from Core lib
    	
//    	 $sql = $this->_getSqlBaseSelect();
//         $sql .= 'WHERE tp.id ='. $this->getId() ;
//         $this->_db->setQuery($sql) ;
//         $res = $this->_db->loadObjectList() ;
//         return $res[0];
    }
	
	// TODO: need to consider again
    function getUserProperties()
    {
        $result = array() ;
        $mainframe =& JFactory::getApplication();
        $params    =& ComJea::getParams();
        $access    =& ComJea::getAccess();
        $default_limit = $params->get('list_limit', 10);
        $user		= & JFactory::getUser();
		$userid	= $user->get('id');
		$usergid	= $user->get('gid');
        
        $cat        = $mainframe->getUserStateFromRequest( 'com_jea.user.properties.cat', 'cat', -1, 'int' );
        $limit      = $mainframe->getUserStateFromRequest( 'com_jea.user.limit', 'limit', $default_limit, 'int' );
       	$keyserch = @JRequest::getVar(keyserch);
        //kiem tra xem co dieu kien serch moi khong?
        
		 $limitstart = JRequest::getInt('limitstart', 0);
        if(@JRequest::getVar(cat) || @JRequest::getVar(published)  || @JRequest::getVar(type_id) || @JRequest::getVar(keyserch))
        {
        $limitstart = 0;
        }
       
        $order      = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
		$order='id';
        $order_dir  = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
		$types        = $mainframe->getUserStateFromRequest( 'com_jea.user.properties.types', 'type_id', 0, 'int' );
		$published        = $mainframe->getUserStateFromRequest( 'com_jea.user.properties.published', 'published', -1, 'int' );
        $rows = array();
        //echo "type ne $types";
		
        if($access->canEdit || $access->canEditOwn){
            
            $select  = $this->_getSqlBaseSelect();
            
            $where = '';
            if($access->canEditOwn){
                 $user    =& JFactory::getUser();
                 $where = ' WHERE tp.created_by=' . intval($user->get('id'));
            }
            
            if($cat >= 0){
                if(!empty($where)){
                    $where .= ' AND kind_id='. $cat;
                } else {
                    $where .= ' WHERE kind_id=' . $cat;
                }
            }
            if($types)
			{
				if(!empty($where)){
                    $where .= ' AND type_id='. $types;
                } else {
                    $where .= ' WHERE type_id=' . $types;
                }
			}
			if($published!=-1)
			{
			
				if(!empty($where)){
                    $where .= ' AND tp.published='. $published;
                } else {
                	
                    $where .= ' WHERE tp.published='.   $published;
                }
			}
			/* hoan: nếu là admin thì sẽ hiện all else chỉ hiện của nó */
			if($usergid <= 24)
			{
				if(!empty($where)){
	                    $where .= ' AND tp.created_by = '. $userid;
	                } else {
	                	
	                    $where .= ' WHERE tp.created_by ='.   $userid;
	                }
			}

        if($keyserch !="")
			{
				if(!empty($where))
				{
					
                    $where .= " AND tp.ref LIKE '%$keyserch%'";
                }
                else
                 {
                	
                    $where .= " WHERE tp.ref LIKE '%$keyserch%'";
                }
			}
			
						
			
            $sql = $select . $where .  ' ORDER BY ' . $order . ' ' . strtoupper( $order_dir ) ;
			//echo $where;
            $rows = $this->_getList( $sql , $limitstart, $limit );
            
            if ( $this->_db->getErrorNum() ) {
                JError::raiseWarning( 200, $this->_db->getErrorMsg() );
                return false;
            }
        }
        
        $result['limitstart'] = $limitstart ;
        $result['limit'] = $limit ;
        $result['total'] = $this->_getListCount( $sql );
        $result['rows'] = $rows ;
        $result['order'] = $order ;
        $result['order_dir'] = $order_dir;
        $result['cat'] = $cat;
		$result['type_id'] = $types;
		$result['published'] = $published;
       
        return $result ;
    }
    
    function getProperties($all=false)
    {
        $result = array() ;
        $mainframe =& JFactory::getApplication();
        $params =& ComJea::getParams();
        $default_limit = $params->get('list_limit', 10);
        
		if($all===false){
	    	$limit = $mainframe->getUserStateFromRequest( 'com_jea.limit', 'limit', $default_limit, 'int' );
		} else {
			$limit = 0;
		}
	    
	    $limitstart	= JRequest::getInt('limitstart', 0);
	    $order      = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'id'));
		$order_dir  = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'desc'));
	    
	    $select  = $this->_getSqlBaseSelect();
	   // $where = 'WHERE published=1 AND tp.is_renting=';
    	$cat	= JRequest::getCmd('cat', $params->get('cat',  'all'));
    	
       	
		if(JRequest::getVar('catDirect'))
		$cat=JRequest::getVar('catDirect');
		if(JRequest::getVar('searchDirect'))
		$cat='selling';
		//echo "cat ne:$cat";
		//Minh them code cho phan search
		
		if($cat == 'all')
		{
			$where = 'WHERE tp.published=1 AND tp.success = 0 ';
			if (JRequest::getInt('area_id' ))
			{
				$where.= " AND tp.area_id=".JRequest::getInt('area_id' );
			}
		}
		else
		{
			if($cat != 'selling' && $cat != 'renting' && $cat != 'needbuying' && $cat != 'needrenting')
			{
				$where = 'WHERE tp.published=1 AND tp.success = 0 ';
				
			}
			else
			{
				$where = 'WHERE tp.published=1 AND tp.success = 0  AND tp.kind_id=';
				if($cat == 'selling')
				$where .='1';
				if($cat == 'renting')
				$where .='2';
				if($cat == 'needbuying')
				$where .='3';
				if($cat == 'needrenting')
				$where .='4';
			}
						
			if (JRequest::getInt('area_id' ))
			{
				$where.= " AND tp.area_id=".JRequest::getInt('area_id' );
			}
		}
		//Ket thuc
		//$where .= ($cat == 'renting') ? '1' : '0' ;  code cu
		
	//if(JRequest::getVar('catDirect') || JRequest::getInt('area_id'))
	if (0)
	{
	}
	else
	{
		/* Tim theo ma tai san */
		$maTs = JRequest::getVar('mataisan');
		if( $maTs != NULL)
		{
			if (is_numeric($maTs))
			 {
				global $mainframe;
				$mainframe->redirect('index.php?option=com_jea&view=properties&Itemid=10&id= '.$maTs);
			 }
			 else
			 {
				$msgbox = JText::_('NOSEARCHMTS');
				echo "<script>alert('$msgbox');document.location.href='index.php'</script>";
			 }
		}
		
		if ($key_search = JRequest::getVar('key_search', $params->get('key_search', '')) ) {
			$where .= " AND ( tp.ref LIKE '%$key_search%' OR tp.address LIKE '%$key_search%' OR tp.description LIKE '%$key_search%' OR tp.name_vl LIKE '%$key_search%' OR tp.address_vl LIKE '%$key_search%')" ;
		}
		if ( $type_id = JRequest::getInt('type_id', $params->get('type_id', 0)) ) {
			$where .= ' AND tp.type_id = ' . intval( $type_id ) ;
		}
			
    	if ( $department_id = JRequest::getInt('department_id', $params->get('department_id', 0)) ) {
			$where .= ' AND tp.department_id = ' . intval( $department_id ) ;
		}

    	if ( $town_id = JRequest::getInt('town_id', $params->get('town_id', 0)) ) {
			$where .= ' AND tp.town_id = ' . intval( $town_id ) ;
		}
			
		if ( $area_id = JRequest::getInt('area_id', $params->get('area_id', 0)) ) {
			$where .= ' AND tp.area_id = ' . intval( $area_id ) ;
		}
			
		$budget_min = JRequest::getFloat('budget_min', 0.0);
		$budget_max =JRequest::getFloat('budget_max', 0.0);
		
		$session =& JFactory::getSession();
		if($budget_min != 0)
			{
				@$_SESSION["gia_tu1"]= $budget_min;
				@$_SESSION["gia_den1"]= $budget_max;
			}
		else if($budget_min == 0 && $budget_max == 0)
			{
				@$budget_min = $_SESSION["gia_tu1"];
				@$budget_max = $_SESSION["gia_den1"];
			}
			
		/* neu ton tai loai tin dang, loai dia oc, dia diem thi se gan gia tu gia den vao*/
		if(isset($_GET['catDirect']) || isset($_GET['type_id']) || isset($_GET['town_id']) || isset($_GET['limitstart']))
		{
			/* neu ton tai gia tu gia den se lay gia tu gia den */
			 if( isset($_GET['gia_tu']) && isset($_GET['gia_den']))
			 {
			 	$budget_min = $_GET['gia_tu'];
				$budget_max = $_GET['gia_den'];
			 }
			 else
			 {
				@$budget_min = $_SESSION["gia_tu1"];
				@$budget_max = $_SESSION["gia_den1"];
			 }
		}
		
		//print_r("gia tu".$budget_min);
		//print_r("gia tu".$budget_max);
		// -1 -> -1: tat ca
		// 0 -> 0 : thuong luong

		// tat ca
		if ( $budget_min != -1 && $budget_min != -1 )
		{
			// thuong luong - gia = -5
			if ( $budget_min == -5 && $budget_max == -5 )
			{
				$where .= ' AND (tp.price = 0) ';
			}
			// tu min den max
			else if ( $budget_min && $budget_max )
			{
				$where .= ' AND ((tp.price * pu.rate >= ' . $budget_min .
									' AND tp.price * pu.rate <= ' . $budget_max . ') ';
				$where .= ' OR (tp.price * pu.rate * tp.living_space >= ' . $budget_min .
								' AND tp.price * pu.rate * tp.living_space <= '	.$budget_max .
								' AND pau.id = 1 AND tp.living_space > 0)) AND tp.price > 0 ';
			}
			// lon hon min
			else if ( $budget_min )
			{
				$where .= ' AND ((tp.price * pu.rate >= ' . $budget_min . ') ';
				$where .= ' OR (tp.price * pu.rate * tp.living_space >= ' . $budget_min .
								' AND pau.id = 1 AND tp.living_space > 0)) AND tp.price > 0 ';
			}
			// nho hon max
			else if ( $budget_max )
			{
				$where .= ' AND ((tp.price * pu.rate <= ' . $budget_max . ') ';
				$where .= ' OR (tp.price * pu.rate * tp.living_space <= ' . $budget_max .
								' AND pau.id = 1 AND tp.living_space > 0)) AND tp.price > 0 ';
			}
		}
			//print_r($where);
		if( $living_space_min = JRequest::getInt('living_space_min', 0) ) {
			$where .= ' AND tp.living_space > ' . $this->_db->getEscaped( $living_space_min ) ;
		}

		if( $living_space_max = JRequest::getInt('living_space_max', 0) ) {
			$where .= ' AND tp.living_space < ' . $this->_db->getEscaped( $living_space_max ) ;
		}
		
		if( $rooms_min = JRequest::getInt('rooms_min', 0) ) {
			$where .= ' AND tp.rooms >= ' . $this->_db->getEscaped( $rooms_min ) ;
		}
		
		// add search for project group id
		if ($project_group_id = JRequest::getInt('project_group_id', 0))
		{
			$where .= ' AND tp.project_group_id = ' . $this->_db->getEscaped($project_group_id);
		}
		
        if(JRequest::getVar('searchDirect'))
			{
				$datban=JRequest::getVar('searchDirect');
				if($datban=='datban')
				$likes =' tp.type_id IN (7,8,9,10,11,0)';
				else
				$likes =' tp.type_id IN (1,2,0)';
				$where .= ' AND '.$likes ;
			}
			else
			{
				  if ( $advantages = JRequest::getVar( 'advantages', array(), '', 'array' ) )
					{
					
					/*$likes = array();
					
					foreach( $advantages as $id ){
						$likes[] = ' tp.advantages LIKE \'%-' .  $id .'-%\' ' ;
					}
					
					$where .= ' AND ' . implode('AND', $likes) ; */
		
					$likes =' tp.type_id IN (';
					foreach( $advantages as $id ){
						$likes .= " $id, " ;
					}
					$likes .='0)';
					
					$where .= ' AND '.$likes ;
				}
			}
			
			/* Search theo huong */
			$directions   = JRequest::getInt('directions', 0);
			if($directions != 0)
			{
			$where .= ' AND direction_id= '.$directions ;
			}
			
			
		}
		$sql = $select . $where .  ' ORDER BY tp.emphasis DESC, ' . $order . ' ' . strtoupper( $order_dir ) ;
        $rows = $this->_getList( $sql , $limitstart, $limit );

        if ( !$this->_db->getErrorNum() ) {
        	  
         	$result['limitstart'] = $limitstart ;
			$result['limit'] = $limit ;
			$result['total'] = $this->_getListCount( $sql );
	        $result['rows'] = $rows ;
	        $result['order'] = $order ;
	        $result['order_dir'] = $order_dir;

        } else {
            JError::raiseWarning( 200, $this->_db->getErrorMsg() );
            return false;
        }
        
        return $result ;
    }
    
    function &getFeature( $tableName )
    {
		$table =& $this->getTable( $tableName );
		return $table;
    }
    
    function getFeatureList($tableName, $title='')
    {
    	static $featuresModel = null ;

    	if( $featuresModel === null ) {
	    	JModel::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');
	    	$featuresModel =& JModel::getInstance('Features', 'jeaModel');
    	}
    	
    	$featuresModel->setTableName( $tableName );
    	return $featuresModel->getListForHtml( $title );
    	
    }
    
    function getFeatureOptionsList($tableName, $title='')
    {
    	static $featuresModel = null ;

    	if( $featuresModel === null ) {
	    	JModel::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');
	    	$featuresModel =& JModel::getInstance('Features', 'jeaModel');
    	}
    	
    	$featuresModel->setTableName( $tableName );
    	return $featuresModel->getListForHtml( $title );
    }
    
    function getPreviousAndNext()
    {
    	$result = array();
    	$currentRow =& $this->getRow();
        $result['prev_item'] = null;
        $result['next_item'] = null;
        
        $params = ComJea::getParams();
        
        $sql = 'SELECT id FROM #__jea_properties WHERE ';
        
        $where = ( $currentRow->is_renting )? 'is_renting=1' : 'is_renting=0' ;
        $where .= ' AND published=1';
        
        // Bug fix [#16275] Problem with 'Previous' and 'Next' navigation
    	if ( $type_id = JRequest::getInt('type_id', $params->get('type_id', 0)) ) {
			$where .= ' AND type_id = ' . intval( $type_id ) ;
		}
			
    	if ( $department_id = JRequest::getInt('department_id', $params->get('department_id', 0)) ) {
			$where .= ' AND department_id = ' . intval( $department_id ) ;
		}

    	if ( $town_id = JRequest::getInt('town_id', $params->get('town_id', 0)) ) {
			$where .= ' AND town_id = ' . intval( $town_id ) ;
		}
			
		if ( $area_id = JRequest::getInt('area_id', $params->get('area_id', 0)) ) {
			$where .= ' AND area_id = ' . intval( $area_id ) ;
		}
        // End Bug fix [#16275]
        
        
        $this->_db->setQuery( $sql . $where );
        $rows = $this->_db->loadObjectList();
        
        if($rows){
            $place = 0;
            foreach($rows as $k => $row){
                if($row->id == $currentRow->id) $place = $k;
            }
            if ( isset($rows[$place-1]) ) $result['prev_item'] = $rows[$place-1] ;
            if ( isset($rows[$place+1]) ) $result['next_item'] = $rows[$place+1] ;
        }
        return $result;
    }

	function _getSqlBaseSelect()
    {
        
    	$table =& $this->getTable();
    	$fields = $table->getProperties();
    	
        $temp = array();
        foreach ($fields as $field => $value){
                $temp[]= 'tp.'.$field.' AS '. '`' . $field . '`';
               
        }
        
        // hoan tat menh de select * from bds va them sql lay theo lang
        $select = implode(', ', $temp );
  /*
     	$lang ="en";
     	
    $select = 	" tp.id AS `id`, tp.type_id AS `type_id`, tp.is_renting AS `is_renting`, tp.kind_id AS `kind_id`,
     	 tp.price AS `price`,  tp.town_id AS `town_id`, tp.area_id AS `area_id`,
     	 tp.direction_id AS `direction_id`, tp.zip_code AS `zip_code`, tp.department_id AS `department_id`,
     	 tp.condition_id AS `condition_id`, tp.living_space AS `living_space`, tp.land_space AS `land_space`,
     	 tp.rooms AS `rooms`, tp.mainrooms AS `mainrooms`, tp.highrooms AS `highrooms`, tp.charges AS `charges`,
     	  tp.fees AS `fees`, tp.hot_water_type AS `hot_water_type`, tp.heating_type AS `heating_type`,
     	   tp.bathrooms AS `bathrooms`, tp.toilets AS `toilets`, tp.availability AS `availability`,
     	   tp.floor AS `floor`, tp.advantages AS `advantages`,
     	   tp.slogan_id AS `slogan_id`, tp.published AS `published`, tp.ordering AS `ordering`,
     	   tp.emphasis AS `emphasis`, tp.date_insert AS `date_insert`, tp.checked_out AS `checked_out`,
     	   tp.checked_out_time AS `checked_out_time`, tp.created_by AS `created_by`,
     	 tp.phone_vl AS `phone_vl`, tp.living_width AS `living_width`,
     	   tp.living_length AS `living_length`, tp.contact AS `contact`, tp.project_id AS `project_id`,
     	   tp.project_group_id AS `project_group_id`, tp.price_unit AS `price_unit`, tp.price_area_unit AS `price_area_unit`,
     	    tp.position AS `position`, tp.phuongxa AS `phuongxa`, tp.duongpho AS `duongpho`,
     	     tp.trafficmovement AS `trafficmovement`, tp.legal_status AS `legal_status`, tp.kv_length AS `kv_length`,
     	      tp.kv_width AS `kv_width`, tp.xd_length AS `xd_length`, tp.xd_width AS `xd_width`, tp.newsest AS `newsest`,
     	       tp.realtor_id AS `realtor_id`, tp.map_lat AS `map_lat`, tp.map_lng AS `map_lng`,
     	        tp.pro_total_info AS `pro_total_info`";
    
		$select .= '  , tp.'.$lang.'_ref AS ref , '
				. 'tp.' .$lang.'_address AS address ,'
				. 'tp.' .$lang.'_description AS description ,'
				. 'tp.' .$lang.'_name_vl AS name_vl ,'
				. 'tp.' .$lang.'_ddress_vl AS address_vl ,'
				. 'tp.' .$lang.'_ghichu AS ghichu ,'
				. 'tp.' .$lang.'_page_title AS page_title ,'
				. 'tp.' .$lang.'_page_keywords AS page_keywords ,'
				. 'tp.' .$lang.'_page_description AS page_description ,'
				. 'tp.' .$lang.'_properties_key AS properties_key '	;
				
				
				
					  $select .=  ' , ta.' .$lang.'_value AS area , '
					  
								. 'tt.' .$lang.'_value AS type ,'
								 . 'kd.' .$lang.'_value AS kind ,'
								. 'tto.' .$lang.'_value AS town ,'
								.  'dr.' .$lang.'_value AS direction ,'
								. 'ls.' .$lang.'_value AS legal_status ,'
								 
								.  'pu.' .$lang.'_value AS price_unit ,'
								.  'pau.' .$lang.'_value AS price_area_unit ,'
								. 'ls.' .$lang.'_value AS legal_status ';





				
		  $select .= ' , td.value AS `department`, tc.value AS `condition`, '
			    .  'ts.value AS `slogan`, '
				.  'thwt.value AS `hot_water`, tht.value AS `heating`,'//,pc.value AS `planchilds`,pl.value AS `plans`, '//,us.username AS `author`';
				. 'tp.created_by AS  `created_by`, tu.username AS `author`,tu.id AS `author_id`, '
				. 'pg.value AS `project_group_name`, prj.value AS `project_name`';
				

				/*
				 * advantages
position
*/

        $select .= ' , td.value AS `department`, tc.value AS `condition`, ta.value AS `area`, '
			    .  'ts.value AS `slogan`, tt.value AS `type`, tto.value AS `town`, '
				.  'thwt.value AS `hot_water`, tht.value AS `heating`,kd.value AS `kind`,dr.value AS `direction`,'//,pc.value AS `planchilds`,pl.value AS `plans`, '//,us.username AS `author`';
				. 'tp.created_by AS  `created_by`, tu.username AS `author`,tu.id AS `author_id`, '
				. 'pg.value AS `project_group_name`, prj.value AS `project_name`, '
				. 'ls.value AS `legal_status`, pu.value AS `price_unit`, pau.value AS `price_area_unit`';
						
		//Joomfish compatibility:
		$select .= ', td.id AS `id2`, tc.id AS `id3`, ta.id AS `id4`, '
			    .  'ts.id AS `id5`, tt.id AS `id6`, tto.id AS `id7`, '
				.  'thwt.id AS `id8`, tht.id AS `id9`';
				
		
		
        $value = 'SELECT ' . $select . ' FROM #__jea_properties AS tp' . PHP_EOL
             . 'LEFT JOIN #__jea_departments AS td ON td.id = tp.department_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_conditions AS tc ON tc.id = tp.condition_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_areas AS ta ON ta.id = tp.area_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_slogans AS ts ON ts.id = tp.slogan_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_types AS tt ON tt.id = tp.type_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_hotwatertypes AS thwt ON thwt.id = tp.hot_water_type' . PHP_EOL
			 . 'LEFT JOIN #__jea_kinds AS kd ON kd.id = tp.kind_id' . PHP_EOL
			 . 'LEFT JOIN #__users AS tu ON tu.id = tp.created_by' . PHP_EOL
			 . 'LEFT JOIN #__jea_directions AS dr ON dr.id = tp.direction_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_project_group AS pg ON pg.id = tp.project_group_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_projects AS prj ON prj.id = tp.project_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_heatingtypes AS tht ON tht.id = tp.heating_type'. PHP_EOL
			 . 'LEFT JOIN #__jea_price_units AS pu ON pu.id = tp.price_unit'. PHP_EOL
			 . 'LEFT JOIN #__jea_price_area_units AS pau ON pau.id = tp.price_area_unit'. PHP_EOL
			 . 'LEFT JOIN #__jea_legal_status AS ls ON ls.id = tp.legal_status'. PHP_EOL ;
			 //print_r($value);
			// exit;
			 
			 return $value;
			 
        
    }
    
	// ham minh viet cho chuc nang Compare
	function getPropertyCompare($id)
    {
    	 $sql = $this->_getSqlBaseSelect();
		 $sql .= 'WHERE tp.id ='. $id;
		 $sql .= ' AND tp.success = 0  ';
		 //echo $sql;
         $this->_db->setQuery($sql) ;
         $res = $this->_db->loadObjectList() ;
		// echo 'id:'.$res[0]->id.'<br>';
         return $res[0];
    }
    
   /* hoan bat dong san lien quan 2010-10-26 */
    function getsamland($keytown_id, $keykind_id, $keytype_id, $keyprice, $slht,
    				$id, $khoanggia, $keyarea_id, $realtor =NULL)
    {
	
			if( $keyprice == NULL)
			{
				$keypricea = 1;
			}
			else
			{
				$keypricea = $keyprice;
			}
							
    		if( $keytown_id || $keytype_id || $keykind_id || $khoanggia > 0)
    		{
    			$sql ="SELECT tp.ref,tp.kind_id,tp.price,tp.type_id, tp.id,tp.price_area_unit,tp.price_unit,
		    				tp.address, tp.living_space,tp.phuongxa AS phuongxa, tp.duongpho AS duongpho,
		    				tto.value AS `town`,area.value AS `area`
						FROM #__jea_properties AS tp
						LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id
						LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id
						LEFT JOIN #__jea_price_units AS pri ON pri.id=tp.price_unit
						WHERE tp.id <> $id AND tp.success = 0 AND tp.published=1 AND ( ";

	    		if($keytown_id)
	    		{
	    			$sql .= "  tp.town_id LIKE '%$keytown_id%'";//OR area_id LIKE '%$keyarea_id%'";
	    		}
	    		if($keykind_id)
	    		{
	    			if($keytown_id)
	    			{
	    				$sql.=" OR ";
	    			}
	    			$sql .= " kind_id LIKE '%$keykind_id%'";
	    		}
	    		
	   			if($keytype_id)
	    		{
	    			if($keykind_id || $keytown_id ){$sql.=" OR ";}
	    			$sql .= " type_id LIKE '%$keytype_id%'";
	    		}
	    		
	     		if($khoanggia > 0)
	    		{
	    			if($keytype_id || $keykind_id || $keytown_id ){$sql.=" OR ";}
	       			$sql.=	" ABS( $keyprice - IF( tp.price_unit=1,tp.price,tp.price*pri.rate )) < ( $keypricea * $khoanggia / 100 ) ";
	    		}
	    		$sql.=" ) ";
	    		if($realtor)
	    		{
	    			 $sql .= ' AND realtor_id = '.$realtor;
	    		}
		    		$sql.=" GROUP BY tp.id";
		    		$sql.=" ORDER BY IF( tp.price_unit=1,tp.price,tp.price*pri.rate )";
			    		
	  	 }
	  	 	 	 return $sql;
    }
    
    /* giao dich thanh cong */
    function getProSuccess($realtor)
    {
   		$sql ='SELECT tp.ref,tp.kind_id,tp.price,tp.type_id, tp.id,tp.price_area_unit,tp.price_unit,
		    				tp.address, tp.living_space, tto.value AS `town`,area.value AS `area`
						FROM #__jea_properties AS tp
						LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id
						LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id
						LEFT JOIN #__jea_price_units AS pri ON pri.id=tp.price_unit';
       $sql .= ' WHERE published=1 AND success = 1 ';
       $sql .= ' AND realtor_id = '.$realtor;
   		return $sql;
    }

     
}

