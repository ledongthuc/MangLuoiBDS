<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package     Jea.admin
 * @copyright   Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class U_reModelProject_group extends JModel
{
	
	    /**
     * Hellos data array
     *
     * @var array
     */
	
    var $_data;
	var $_currentTableName = '' ;
	var $_lastId = 0;
    /**
     * Returns the query
     *  @return  string  The  query  to  be  used  to  retrieve  the  rows  from
the database
     */
	/*
    function _buildQuery()
    {
        $query = ' SELECT * '
            . ' FROM #__jea_project_group ORDER BY ordering'
        ;
        return $query;
    }
	    /**
     * Retrieves the hello data
     *  @return  array  Array  of  objects  containing  the  data  from  the
database
     */
	/*
    function getData($all=false)
    {
		$result = array();
		$mainframe = &JFactory::getApplication();
		$context = 'com_jea.characteristics.project_group' ;
		$default_limit = $mainframe->getCfg('list_limit');

		$limit      = $mainframe->getUserStateFromRequest( $context.'limit', 'limit',  $default_limit, 'int' );
	    $limitstart = $mainframe->getUserStateFromRequest( $context.'offset', 'limitstart', 0, 'int' );
		
		$sql = $this->_buildQuery();
		$result['total'] = $this->_getListCount( $sql );
		 if( $all === true ){
	    	
			$result['limitstart'] = 0 ;
			$result['limit'] = 0 ;
			$result['rows'] = $this->_getList( $sql);
			
		} else {
			
			$result['limitstart'] = $limitstart ;
			$result['limit'] = $limit ;
	        $result['rows'] = $this->_getList( $sql , $limitstart, $limit );
		}
		
		if ( $this->_db->getErrorNum() ) {
	            JError::raiseWarning( 200, $this->_db->getErrorMsg() );
	            return false;
	    }
	         
	    return $result ;
        // Lets load the data if it doesn't already exist
      //  if (empty( $this->_data ))
      //  {
      //      $query = $this->_buildQuery();
      //      $this->_data = $this->_getList( $query );
      //  }
      //  return $this->_data;
    }
	function &getRow()
	{
		$table =& $this->getTable();
		$table->load( $this->getId() );

		return $table;
	}
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
	*/
	/*
	function save()
	{
//		$row = & $this->getRow();
		$datas = array (
		'id' => JRequest::getInt( 'id', 0 , 'POST' ),
		'value' =>  JRequest::getVar( 'value', '' ) ,
		'published' => JRequest::getInt( 'published', 0 , 'POST' ),
		
		);
		print_r($datas);
		exit;
		if( !$datas['id'] )
		{
			// save new item at the end of ordering
			$row->ordering = $row->getNextOrder();
		}

        if ( !$row->store() ) {
            JError::raiseWarning( 200, $row->getError() );
            return false;
        }
        $this->_lastId = $row->id;

        
        return true;
	}
	*/
	/*
	function remove()
	{
		$cids = implode( ',', $this->getCid() );
		
		//only one request
		$this->_db->setQuery( 'DELETE FROM `#__jea_project_group` WHERE id IN (' . $cids . ')' );
		
		if ( !$this->_db->query() ) {
			JError::raiseError( 500, $this->_db->getErrorMsg() );
			return false;
		}
		
		return true;
	}
	*/
	/*
	 function order($inc)
    {
        $row =& $this->getRow();
        $row->move( $inc);
    }
    */
/*
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
    */
    function getListProjectGroup()
    {
    	//lay du lieu tam
    	$sql = "SELECT id, value, published FROM jos_jea_project_type_en" ;
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$result = $db->loadRowList();
		
    	return $result;
    }
    
   
	 function getProjectGroupById( $id )
    {
    	//lay du lieu tam
    	$sql = "SELECT id, value, published FROM jos_jea_project_type_en WHERE id =".$id ;
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$result = $db->loadRowList();
		echo "toi day rui";
		exit;
    	return $result;
    }
    
    function updateProject_group( $id )
    {
    	
    }
    
	function getDeleteProjectGroup( $id )
    {
    	
    }
    
	function save()
	{
		$datas = array (
		'id' => JRequest::getInt( 'id', 0 , 'POST' ),
		'value' =>  JRequest::getVar( 'value', '' ) ,
		'published' => JRequest::getInt( 'published', 0 , 'POST' ),
		
		);
		/*
		if( !$datas['id'] )
		{
			// save new item at the end of ordering
			$row->ordering = $row->getNextOrder();
		}

        
        $this->_lastId = $row['id'];

        */
        return true;
	}
    
    
}