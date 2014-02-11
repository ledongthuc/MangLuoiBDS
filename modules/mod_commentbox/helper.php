<?php
/*
user:TheOcean
date:Dec 27, 2011
time:10:09:55 AM
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php');
class modCommentbox {
	function getList(&$params)
	{	$db = &JFactory::getDBO();
		$limitstart = JRequest::getVar('limitstart','0','','int');		      	
		$artid   = $params->get('id');	
		$limit   = $params->get('sotin');
		$sql = 'SELECT title,comment,name,email,date,object_id from jos_jcomments where published = 1 AND object_id=' . $artid. ' order by date desc';
		$db->setQuery($sql, $limitstart, $limit);
		$rows=$db->loadRowList();
		return $rows;
	}
	function getTotalRows(&$params){
		$db = &JFactory::getDBO();	
		$artid   = $params->get('id');	
		$query = "SELECT COUNT(id) FROM jos_jcomments where published = 1 AND  object_id=".$artid; 
		$db->setQuery($query ); 
		$total = $db->loadResult();
		return $total;
	}
	
}