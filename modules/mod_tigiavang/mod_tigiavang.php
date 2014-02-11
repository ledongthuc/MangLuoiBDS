<?php 

require_once ( dirname(__FILE__).DS.'helper.php' );
$all_visitors	=	modTigiavangHelper::getMaxID();

//$db =& JFactory::getDBO();
//$db->setQuery("SELECT COUNT(id) FROM #__vvisitcounter");
//$NumberVisit=$db->loadResult();
//echo $NumberVisit;

/* hien so luot truy cap */
	$number_digits =8;
	
	$arr = & modTigiavangHelper::getDigits( $all_visitors,$number_digits );
	$ShowDigit =''; 
	$ShowVisiteUser ='';
	foreach ($arr as $digit)
	{
		$ShowVisiteUser .= $digit;
		$ShowDigit .= modTigiavangHelper::showDigitImage($digit );
	}
	$hiensoonline= modTigiavangHelper::getMaxID();


	require(JModuleHelper::getLayoutPath('mod_tigiavang','giahung'));
?>
