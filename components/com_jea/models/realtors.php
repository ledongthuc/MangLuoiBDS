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
include_once('libraries/unisonlib/com_jea_lib.php');

class JeaModelRealtors extends JModel
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
//		static $table = null;
//		
//		if ( $table === null ) {
//			$table =& $this->getTable();
//			$table->load( $this->getId() );
//		}
//		
//		return $table;

		$this->getRowById( $this->getId() );
	}
    
	function &getRowById( $id )
	{
		static $table = null;
		
		if ( $table === null ) {
			$table =& $this->getTable();
			$table->load( $id );
		}
		
		$table->image = ComJea::getRealtorImagesById($table->id);
		
		return $table;
	}	
	
    function getPreviousAndNext()
    {
    	$result = array();
    	$currentRow =& $this->getRow();
        $result['prev_item'] = null;
        $result['next_item'] = null;
        
        $params = ComJea::getParams();
        
        $sql = 'SELECT id FROM #__jea_realtors WHERE  published=1';
        
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
                $temp[]= 'r.'.$field.' AS '. '`' . $field . '`';
        }
        $select = implode(', ', $temp );

        $select .= ',ta.value AS `area` , tto.value AS `town`'	;		
		//Joomfish compatibility:
		$select .= ', ta.id AS `id2`, tto.id AS `id3`';
				

        return 'SELECT ' . $select . ' FROM #__jea_realtors AS r' . PHP_EOL
			 . 'LEFT JOIN #__jea_areas AS ta ON ta.id = r.area_id' . PHP_EOL
			 . 'LEFT JOIN #__jea_towns AS tto ON tto.id = r.town_id' . PHP_EOL;
    }    
    
    /*
     * Chau add:
     * Get listing by id
     * return listing belong to realtor
     */
    function getListingByRealtorId( $id )
    {
    	// get basic info
 		$sql = "SELECT p.id, p.ref, p.price, p.price_unit AS `price_unit`, p.address, 
 						p.price_area_unit AS `price_area_unit`, p.living_space, 
 						a.value AS `area`, t.value AS `town`, p.kind_id AS `kind_id` "
 			. " FROM #__jea_properties p" . PHP_EOL
 		    . "LEFT JOIN #__jea_areas AS a ON a.id = p.area_id" . PHP_EOL
			. "LEFT JOIN #__jea_towns AS t ON t.id = p.town_id" . PHP_EOL
			. "LEFT JOIN #__jea_price_units AS pu ON pu.id = p.price_unit" . PHP_EOL
			. "LEFT JOIN #__jea_price_area_units AS pau ON pau.id = p.price_area_unit" . PHP_EOL
			. "WHERE p.realtor_id = " . $id . PHP_EOL
			. "AND p.published = 1 " . PHP_EOL
			. "ORDER BY p.ordering";   	
		$this->_db->setQuery( $sql );
		$rows = $this->_db->loadObjectList();
		
		foreach ( $rows as $row )
		{
			// TODO: refractor --- get Itemid
			$Itemid = 1;			
			if ( $row->kind_id == 1 )
			{
				$row->itemid = '10';
			}
			else if ( $row->kind_id == 2 )
			{
				$row->itemid = '11';
			}
			else if ( $row->kind_id == 3 )
			{
				$row->itemid = '12';
			}
			else if ( $row->kind_id == 4 )
			{
				$row->itemid = '13';
			}
			
			// make link
			$row->link = "index.php?option=com_jea&view=properties&id=" . 
								$row->id . "&Itemid=" . $row->itemid;
			
			// get images
			$images_info = ComJea::getImagesById( $row->id );
			
			if ( !empty($images_info['main_image']['min_url']) )
			{
				$row->image = $images_info['main_image']['min_url'];
			}
			else 
			{
				$row->image = "images/noimage.jpg";
			}
			
			$priceStr = reFormatPrice($row->price) . 
							$row->price_unit . '/' . $row->price_area_unit;
			
			$row->full_price = $priceStr;
			// format price
		}
		
		return $rows;
    }
}

