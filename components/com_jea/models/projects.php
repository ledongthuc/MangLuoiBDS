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

class JeaModelProjects extends JModel
{
    var $_error = '';
    
    
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
		$this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
	}
    
    
	function getId()
	{
		return JRequest::getInt('id', 0);
	}
	
	function &getRow()
	{
		static $table = null;
		
		if ( $table === null ) {
			$table =& $this->getTable();
			$table->load( $this->getId() );
		}
		
		return $table;
	}
    
    function getUserProperties()
    {
        
        $result = array() ;
        $mainframe =& JFactory::getApplication();
        $params    =& ComJea::getParams();
        $access    =& ComJea::getAccess();
        $default_limit = $params->get('list_limit', 10);
        
        $cat        = $mainframe->getUserStateFromRequest( 'com_jea.user.properties.cat', 'cat', -1, 'int' );
        $limit      = $mainframe->getUserStateFromRequest( 'com_jea.user.limit', 'limit', $default_limit, 'int' );
        $limitstart = JRequest::getInt('limitstart', 0);
        $order      = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'ordering'));
        $order_dir  = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'asc'));
        $rows = array();
        
        if($access->canEdit || $access->canEditOwn){
            
            $select  = $this->_getSqlBaseSelect();
            
            $where = '';
            if($access->canEditOwn){
                 $user    =& JFactory::getUser();
                 $where = ' WHERE tp.created_by=' . intval($user->get('id'));
            }
            
            if($cat >= 0){
                if(!empty($where)){
                    $where .= ' AND is_renting=' . $cat;
                } else {
                    $where .= ' WHERE is_renting=' . $cat;
                }
            }
            
            $sql = $select . $where .  ' ORDER BY ' . $order . ' ' . strtoupper( $order_dir ) ;
			//echo $sql;
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
         
        return $result ;        
    }
    
    function getProjects($all=false)
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
	    $order      = $this->_db->getEscaped( JRequest::getCmd('filter_order', 'ordering'));
		$order_dir  = $this->_db->getEscaped( JRequest::getCmd('filter_order_Dir', 'DESC'));
	    
	    $select  = $this->_getSqlBaseSelect();
	    
	    $where = "WHERE published=1";
		(JRequest::getVar('projectGroup'))?$where.=" AND project_group_ids LIKE '%,".JRequest::getVar('projectGroup')."%'":'';
		(JRequest::getVar('town_id'))?$where.=" AND tp.town_id=".JRequest::getVar('town_id'):'';
		(JRequest::getVar('area_id'))?$where.=" AND tp.area_id=".JRequest::getVar('area_id'):'';
		if(JRequest::getVar('key_search'))
		{
			$key=JRequest::getVar('key_search');
			$where.=" AND ( tp.value LIKE '%$key%' OR tp.desc LIKE '%$key%' OR tp.short_desc LIKE '%$key%')  ";
		}	
		//echo $where;
		$sql  =  $select . $where ;
		$sql .= ' ORDER BY `emphasis` DESC, `newsest` DESC, ' . $order . ' ' . strtoupper( $order_dir ) ;
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
    
    function &getProject()
    {
    	 $sql = $this->_getSqlBaseSelect();
         $sql .= 'WHERE tp.id ='. $this->getId()." AND tp.published=1" ;
         $this->_db->setQuery($sql) ;
         $res = $this->_db->loadObjectList() ;
         return $res[0];
	   //return count($res[0]);
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
        
        $sql = 'SELECT id FROM #__jea_projects WHERE  published=1';
        
     //   $where = ( $currentRow->is_renting )? 'is_renting=1' : 'is_renting=0' ;
       // $where .= ' AND published=1';
        
        // Bug fix [#16275] Problem with 'Previous' and 'Next' navigation
   /* 	if ( $type_id = JRequest::getInt('type_id', $params->get('type_id', 0)) ) {
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
        */
        
        $this->_db->setQuery( $sql );//. $where 
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
        //$select = 'tp'
        $select = implode(', ', $temp );

        $select .= ',ta.value AS `area` , tto.value AS `town`'	;		
		//Joomfish compatibility:
		$select .= ', ta.id AS `id2`, tto.id AS `id3`';
				

        return 'SELECT ' . $select . ' FROM #__jea_projects AS tp' . PHP_EOL
			 . 'LEFT JOIN #__jea_areas AS ta ON ta.id = tp.area_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id' . PHP_EOL;
        
    }    
    
    


     
}

