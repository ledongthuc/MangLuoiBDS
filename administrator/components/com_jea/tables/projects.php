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

class TableProjects extends JTable
{
    
	var $id = null;
	var $value = null;
	var $address = null;
	var $town_id = null;
	var $area_id = null;
	var $desc = null;
	var $short_desc = null;
	var $start_date = null;
	var $end_date = null;
	var $people_area = null;
	var $status = null;
	var $investor = null;
	var $implement_unit = null;
	var $management_unit = null;
	var $design_unit = null;
	var $total_square = null;
	var $number_of_floor = null;	
	var $ordering = null;	
	var $published = null;
	var $emphasis = null;
	var $checked_out = null;
	var $checked_out_time = null;
	var $progress = null;
	var $plane_diagram = null;
	var $scheme = null;
	var $contacts = null;
	var $project_group_ids = null;
	var $project_advantage_ids = null;
	var $newsest = null;
	var $contactname = null;
	var $contactaddress = null;
	var $contactphone = null;	
	var $plane_area = null;
	var $thanhtoan = null;
	var $doitac = null;
	var $page_title = null;
	var $page_keywords = null;
	var $page_description = null;
	
/* moi
	var $id = null;
	var $name = null;
	var $address = null;
	var $town_id = null;
	var $area_id = null;
	var $type_id = null;
	var $created_by = null;
	var $project_advantage_id = null;
	var $description = null;
	var $short_description = null;
	var $start_date = null;
	var $end_date = null;
	var $people_area = null;
	var $status = null;
	var $investor = null;
	var $implement_unit = null;
	var $management_unit = null;
	var $design_unit = null;
	var $total_area = null;
	var $number_of_floor = null;
	var $scheme = null;
	var $plain_diagram = null;
	var $progress = null;
	var $contacts = null;
	var $newest = null;
	var $contact_address = null;
	var $contact_name = null;
	var $contact_phone = null;
	var $payment = null;
	var $page_title = null;
	var $page_keywords = null;
	var $page_description = null;
	var $ordering = null;
	var $published = null;
	var $emphasis = null;
	var $checkout = null;
	var $checkout_time = null;
*/
	function TableProjects(& $db) {
		
        parent::__construct('#__jea_projects', 'id', $db);
	}    
	function check()
	{
	   if( empty( $this->value ) ) {
			
		    $this->setError( JText::_('Property must have a name') );
			return false;
			
		}/* elseif ( empty( $this->type_id ) ) {
		    
		     $this->setError( JText::_('Select a type of property') );
			return false;
		    
		}*/
		
        //avoid duplicate entry for ref
        $query = 'SELECT id FROM #__jea_projects WHERE value=' . $this->_db->Quote( $this->value ) 
               . ' AND id <>' . intval( $this->id );
        $this->_db->setQuery( $query );
		$this->_db->query();

        if ( $this->_db->getNumRows() > 0 ){
            
            $this->setError( JText::sprintf( 'Plan already exists', $this->value ) );
            return false;
        }
		
		//serialize project_group_ids  & project_advantage_ids
		if ( !empty($this->project_group_ids) && is_array($this->project_group_ids) ) {
		    
		    //Sort in order to find easily property advantages in sql where clause
		    sort( $this->project_group_ids );
		    $this->project_group_ids = ','. implode(',' , $this->project_group_ids ) . ',';
		    
		} else {
		    
		    $this->project_group_ids = '';
		}
		if ( !empty($this->project_advantage_ids) && is_array($this->project_advantage_ids) ) {
		    
		    //Sort in order to find easily property advantages in sql where clause
		    sort( $this->project_advantage_ids );
		    $this->project_advantage_ids = ','. implode(',' , $this->project_advantage_ids ) . ',';
		    
		} else {
		    
		    $this->project_advantage_ids = '';
		}
		// end serialize project_group_ids  & project_advantage_ids
		
		//check start_date & end_date
		
//		if ( ! preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/', trim( $this->start_date ) ) ){
//		    
//		    $this->start_date = '0000-00-00';
//		}
//		if ( ! preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/', trim( $this->end_date ) ) ){
//		    
//		    $this->end_date = '0000-00-00';
//		}
		// Clean description for xhtml transitional compliance
		$this->desc = str_replace( '<br>', '<br />', $this->desc );
		$this->short_desc = str_replace( '<br>', '<br />', $this->short_desc );
		$this->scheme = str_replace( '<br>', '<br />', $this->scheme );
		$this->plane_diagram = str_replace( '<br>', '<br />', $this->plane_diagram );
		$this->progress = str_replace( '<br>', '<br />', $this->progress );
		$this->contacts = str_replace( '<br>', '<br />', $this->contacts );
		//For new insertion
        if ( !$this->id ) {	
         //   $user =& JFactory::getUser();
           // $this->published = 0;
            //Save ordering at the end
           // $where =  'kind_id=' . (int) $this->kind_id ;
            //$this->ordering = $this->getNextOrder( $where );
			$this->ordering = $this->getNextOrder();
            //$this->date_insert = date('Y-m-d');
           // $this->created_by = $user->get('id');
        }
        
        return true;
	}
}

?>