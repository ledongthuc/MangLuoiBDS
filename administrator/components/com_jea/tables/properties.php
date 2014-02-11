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
defined('_JEXEC') or die('Restricted access');

class TableProperties extends JTable
{

	var $id=null;
	var $ref=null;
    var $type_id=null;
	var $is_renting = null;
	var $kind_id= null;
	var $price=null;
	var $address =null;
	var $town_id=null;
	var $area_id =null;
	var $direction_id =null;
	var $zip_code =null;
	var $department_id =null;
	var $condition_id =null;
	var $living_space = null;
	var $land_space = null;
	var $rooms = null;
	var $mainrooms = null;
	var $highrooms = null;
	var $charges = null;
	var $fees = null;
	var $hot_water_type = null;
	var $heating_type = null;
	var $bathrooms = null;
	var $toilets = null;
	var $availability = null;
	var $floor = null;
	var $advantages = null;
	var $description = null;
	var $slogan_id = null;
	var $published = null;
	var $ordering = null;
	var $emphasis = null;
	var $date_insert = null;
	var $checked_out = null;
	var $checked_out_time = null ;
	var $created_by = null;
	var $name_vl=null;
	var $address_vl=null;
	var $phone_vl=null;
	var $living_width=null;
	var $living_length=null;
	var $contact =null;
	var $project_id =null;
	var $project_group_id =null;
	var $price_unit =null;
	var $price_area_unit =null;
	var $position =null;
	var $phuongxa =null;
	var $duongpho =null;
	var $ghichu =null;
	var $trafficmovement = null;
	var $legal_status = null;
	var $kv_length = null;
	var $kv_width = null;
	var $xd_length = null;
	var $xd_width = null;
	var $newsest = null;
	var $realtor_id = null;
	var $page_title = null;
	var $page_keywords = null;
	var $page_description = null;
	var $map_lat = null;
	var $map_lng = null;
	var $pro_total_info = null;
	var $properties_key = null;
	
	/*

Var $id = null;
Var $title = null;
Var $type_id = null;
Var $transaction_type_id = null;
Var $price = null;
Var $address = null;
Var $town_id = null;
Var $area_id = null;
Var $living_space = null;
Var $rooms = null;
Var $bathrooms = null;
Var $toilets = null;
Var $floor = null;
Var $advantages = null;
Var $description = null;
Var $published = null;
Var $ordering = null;
Var $emphasis = null;
Var $date_created = null;
Var $checked_out = null;
Var $direction_id = null;
Var $contact_name = null;
Var $contact_address = null;
Var $contact_phone = null;
Var $project_id = null;
Var $living_width = null;
Var $living_length = null;
Var $project_group_id = null;
Var $legal_id = null;
Var $curency_id = null;
Var $price_area_unit = null;
Var $position_id = null;
Var $contact_note = null;
Var $traffic_id = null;
Var $construction_width = null;
Var $construction_length = null;
Var $area_width = null;
Var $area_length = null;
Var $newsest = null;
Var $realtor_id = null;
Var $page_title = null;
Var $page_keywords = null;
Var $page_description = null;
Var $map_lat = null;
Var $map_lng = null;
Var $success = null;
Var $pro_total_info = null;
Var $properties_code = null;
Var $created_by = null;
Var $bed_room = null;
Var $date_modified = null;
Var $checked_out_time = null;
Var $contact_email = null;
Var $ward = null;
Var $street = null;
*/
	function TableProperties(& $db) {
		
        parent::__construct('#__jea_properties', 'id', $db);
	}
	
	/*
	function TableProperties(& $db) {
		
        parent::__construct('#__jea_properties', 'id', $db);
	}
	*/
	
	function check()
	{
	   if( empty( $this->ref ) ) {
			
		    $this->setError( JText::_('Property must have a reference') );
			return false;
			
		} elseif ( empty( $this->type_id ) ) {
		    
		     $this->setError( JText::_('Select a type of property') );
			return false;
		    
		}
		
        //avoid duplicate entry for ref
        $query = 'SELECT id FROM #__jea_properties WHERE ref=' . $this->_db->Quote( $this->ref )
               . ' AND id <>' . intval( $this->id );
        $this->_db->setQuery( $query );
		$this->_db->query();

        if ( $this->_db->getNumRows() > 0 ){
            
            $this->setError( JText::sprintf( 'Reference already exists', $this->ref ) );
            return false;
        }
	//serialize advantages
		if ( !empty($this->legal_status) && is_array($this->legal_status) ) {
		    
		    //Sort in order to find easily property advantages in sql where clause
		    sort( $this->legal_status );
		    $this->legal_status = '-'. implode('-' , $this->legal_status ) . '-';
		    
		} else {
		    
		    $this->legal_status = '';
		}
	//serialize advantages
		if ( !empty($this->trafficmovement) && is_array($this->trafficmovement) ) {
		    
		    //Sort in order to find easily property advantages in sql where clause
		    sort( $this->trafficmovement );
		    $this->trafficmovement = '-'. implode('-' , $this->trafficmovement ) . '-';
		    
		} else {
		    
		    $this->trafficmovement = '';
		}
		
		//serialize advantages
		if ( !empty($this->advantages) && is_array($this->advantages) ) {
		    
		    //Sort in order to find easily property advantages in sql where clause
		    sort( $this->advantages );
		    $this->advantages = '-'. implode('-' , $this->advantages ) . '-';
		    
		} else {
		    
		    $this->advantages = '';
		}
		
		//check availability
		
		if ( ! preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/', trim( $this->availability ) ) ){
		    
		    $this->availability = '0000-00-00';
		}
		
		// Clean description for xhtml transitional compliance
		$this->description = str_replace( '<br>', '<br />', $this->description );

		//For new insertion
        if ( !$this->id ) {
            $user =& JFactory::getUser();
           // $this->published = 0;
            //Save ordering at the end
            $where =  'kind_id=' . (int) $this->kind_id ;
            $this->ordering = $this->getNextOrder( $where );
            $this->date_insert = date('Y-m-d');
            $this->created_by = $user->get('id');
        }
        
        return true;
	}
	
	
	
}