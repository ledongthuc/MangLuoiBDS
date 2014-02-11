<?php
defined('_JEXEC') or die('Restricted access');

include_once('libraries'.DS.'unison'.DS.'unison_jea_lib.php');

/*
if (!function_exists("getHtmlList")) {
	function getHtmlList($table, $title, $id ,$isTown=false){
	
		$sql = "SELECT `id` AS value ,`value` AS text FROM {$table} ORDER BY ordering" ;
	
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
	
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
	
		//unshift default option
		array_unshift($rows, JHTML::_('select.option', '0', $title ));
	if($isTown==true)
		{
		return JHTML::_('select.genericlist', $rows , $id, 'class="inputbox" size="1" onchange="town_change(this.value);" ' , 'value', 'text', 0);
		}
		else
		{
			return JHTML::_('select.genericlist', $rows , $id, 'class="inputbox" size="1" ' , 'value', 'text', 0);
		}
	}
}
	function getHtmlCheckBox($table,$colorLink){
	
		$sql = "SELECT `id` AS value ,`value` AS text FROM {$table} ORDER BY ordering" ;
	
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
	
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
		$iCheck=0;
		foreach($rows as $item)
		{
		echo '<INPUT type="checkbox" name="loaidiaoc[]" value='.$item->value.'>'.'<a style="color:'.$colorLink.' !important;" href=# onclick="SetValues(\'fSearch\',\'loaidiaoc[]\',true,'.$iCheck.')" >'.$item->text.'</a><BR>';
		//<a href=# onclick="document.forms[0].submit(); return false" ></a>
		$iCheck++;
		}
	}
*/

$selected_town_id = 0;
$haveResultFlag = false;

/**
 * Chau: 2010-28-06
 * Get town list. Return list object
 */
function getAreaList()
{
	// get town id from session or request
	if (JRequest::getVar('town_id') != '')
	{
		$town_id = JRequest::getVar('town_id');
	}
	else if (!empty($_SESSION['town_id']) && $_SESSION['town_id'] != '') 
	{
		$town_id = $_SESSION['town_id'];
	}
	else 
	{
		$town_id = 1;
	}
	
	
	
	if (JRequest::getVar('catDirect') != '')
	{
		$catDirect = JRequest::getVar('catDirect');
		switch ($catDirect)
		{
			case "selling":
				$kind_id = 1;
				break;
			case "renting": 
				$kind_id = 2;
				break;
			case "needbuying":
				$kind_id = 3;
				break;
			case "needrenting":
				$kind_id = 4;
				break;
		}
	}

	$where_kind = " ";
	if (!empty($kind_id))
	{
		$where_kind = " AND p.kind_id = '" . $kind_id . "' " ;
	}
	
	global $selected_town_id;
	$selected_town_id = $town_id;
	
	$db = & JFactory::getDBO();
	
	$sql = "SELECT a.id AS `id`, a.`value` AS `value`, count(a.id) AS `num`  
			FROM #__jea_areas a, #__jea_properties p 
			WHERE p.town_id = '" . $town_id . "'
			AND p.area_id = a.id" . $where_kind . "
			GROUP BY a.id ";
	
	$db->setQuery($sql);
	$areas = $db->loadObjectList();
	
	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
	
	if (count($areas) == 0)
	{
		global $haveResultFlag;
		$haveResultFlag = false;
	}
	
	return $areas;
}




?>