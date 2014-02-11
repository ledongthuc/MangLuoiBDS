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

class TableRealtors extends JTable
{
	var $id = null;
	var $name = null;
	var $address = null;
	var $description = null;
	var $ordering = null;	
	var $published = null;
	var $checked_out = null;
	var $checked_out_time = null;
	var $mail_template = null;
	var $image = null;
	var $phone = null;
	var $email = null;
	var $operational_range = null;
	var $slogan = null;
	var $website = null;
	var $employee_type = null;
    
	function TableRealtors(& $db) {
		
        parent::__construct('#__jea_realtors', 'id', $db);
	}    
	
	function check()
	{
	   if( empty( $this->name ) ) {
			
		    $this->setError( JText::_('Realtors must have a name') );
			return false;
			
		}
		
		//For new insertion
        if ( !$this->id ) {	
			$this->ordering = $this->getNextOrder();
        }
        
        return true;
	}
}

?>