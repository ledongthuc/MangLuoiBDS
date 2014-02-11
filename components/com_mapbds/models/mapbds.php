<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.model');
class MapbdsModelMapbds extends JModel
{
	function layDanhSachBDS(){
		$db 		= 	&JFactory::getDBO();
		$query		=	"select id,kinh_do,vi_do,thong_tin_tong_quan from iland4_bat_dong_san_vi WHERE tinh_thanh_id=1 ORDER BY id DESC LIMIT 0,40";
		$db->setQuery($query);
		$result= $db->loadAssocList();
		return $result;		
	}
}


?>