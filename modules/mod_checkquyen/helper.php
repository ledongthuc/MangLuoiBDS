<?php
/**
* @package Author
* @author danhthong
* @website 
* @email danhthong@gmail.com
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

class mod_checkquyenHelper
{
	function getQuyen(){
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		$cmd='SELECT mua_daytin,km_daytin,mua_danhdau,km_danhdau,mua_noibat,km_noibat FROM `jos_users` WHERE id='.$user->get('id');
		$db->setQuery($cmd);
		$db->query();
		return $db->loadObject();		
	}
}
?>