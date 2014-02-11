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

/**
 * Chau: 2010-28-06
 * Get price list. Return list object
 */
function getPriceList()
{
	// Get price title and price value from admin config
	$priceTitleStr = $params->get("priceTitle");
	$priceValueStr = $params->get("priceValue");
	
	// -- start debug -- 
	echo "<pre>";
	print_r($priceTitleStr);
	print_r($priceValueStr);
	echo "</pre>";
	// -- end debug --
	
	// parse value to get 
}




?>