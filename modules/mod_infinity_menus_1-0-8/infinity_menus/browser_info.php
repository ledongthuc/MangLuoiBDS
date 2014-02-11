<?php
/*****************************************************************************
/  Module - Infinity (MyGosu) Menus 2005/04/25
/  Version  1-0-7
/  Copyright Guy Thomas [brudinie]   
/  brudinie@yahoo.co.uk
/  @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
/
/  Javascript Drop Down & Tree Menu Systems by Cezary Tomczak (Mygosu) (modded by Guy Thomas)
/  Mygosu: - http://gosu.pl/dhtml/mygosumenu.html
*****************************************************************************/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class browser_info {
/*==========================================================================*/
/*                       START OF CLASS browser_info                        */
/*==========================================================================*/

// Original code from http://www.4cm.com/tools/browser_type_via_php.php

	var $type;
	var $version;	
	
	function browser_info(){
		/*
		/* Determine browser type
		*/
		if (!empty($_SERVER['HTTP_USER_AGENT'])) 
		{ 
		   $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT']; 
		} 
		else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) 
		{ 
		   $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT']; 
		} 
		else if (!isset($HTTP_USER_AGENT)) 
		{ 
		   $HTTP_USER_AGENT = ''; 
		} 
		if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[2]; 
		   $this->type = 'opera'; 
		} 
		else if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[1]; 
		   $this->type = 'ie'; 
		} 
		else if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[1]; 
		   $this->type = 'omniweb'; 
		} 
		else if (ereg('Netscape([0-9]{1})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[1]; 
		   $this->type = 'netscape'; 
		} 
		else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[1]; 
		   $this->type = 'mozilla'; 
		} 
		else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) 
		{ 
		   $this->version = $log_version[1]; 
		   $this->type = 'konqueror'; 
		} 
		else 
		{ 
		   $this->version = 0; 
		   $this->type = 'other'; 
		}
	}
/*==========================================================================*/
/*                         END OF CLASS browser_info                        */
/*==========================================================================*/	
}
?>