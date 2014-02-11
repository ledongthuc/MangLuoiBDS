<?php
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );
// Required Files 
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
// To use Joomla's Database Class 
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
// Create the Application 
$mainframe =& JFactory::getApplication('site');
// ham bo sung
include_once ('libraries'.DS.'js'.DS.'ham-tien-ich-php.php');
include_once ('libraries'.DS.'unisonlib'.DS.'com_jea_lib.php');
$keytown_id=$_REQUEST['keytown_id'];
$keykind_id=$_REQUEST['keykind_id'];	
$keytype_id=$_REQUEST['keytype_id'];
$keyprice=$_REQUEST['keyprice'];	
$slht=$_REQUEST['slht'];	
$id=$_REQUEST['id'];	
$khoanggia=$_REQUEST['khoanggia'];	
$keyarea_id=$_REQUEST['keyarea_id'];
$page=$_REQUEST['i'];
$app =& JFactory::getApplication();
$CunTemp = $app->getTemplate();


		$RowSam = getSamLand($keytown_id, $keykind_id, $keytype_id, $tigia, $slht,
    				$id, $khoanggia, $keyarea_id, $realtor, $price,$page);					
		$rows = $RowSam['rows'];
		//$RowSam['TotalPage'];	
//print_r($page);
		foreach($rows as $row)
		{		
			if($row->kind_id == '1')
			{
				$row->itemid = '&Itemid=10'; 
			}
			elseif($row->kind_id == '2')
			{
				$row->itemid = '&Itemid=11'; 
			}
			elseif($row->kind_id == '3')
			{
				$row->itemid = '&Itemid=12'; 
			}
			elseif($row->kind_id == '4')
			{
				$row->itemid = '&Itemid=13'; 
			}
		}
		require_once (JPATH_BASE.DS.'modules'.DS.'mod_jea_emphasis'.DS.'helper.php');
		require_once (JPATH_BASE.DS.'templates'.DS.$CunTemp.DS.'html'.DS.'mod_jea_emphasis'.DS.'default.php');
		
				
	/*	

if( $keytown_id || $keytype_id || $keykind_id || $keyprice )
    		{
    				$sql ="SELECT tp.ref,tp.kind_id,tp.price,tp.type_id, tp.id,tp.price_area_unit,tp.price_unit,
		    				tp.address, tp.living_space,tp.phuongxa AS phuongxa, tp.duongpho AS duongpho,
		    				tto.value AS `town`,area.value AS `area`			
						FROM #__jea_properties AS tp					
						LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id
						LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id
						LEFT JOIN #__jea_price_units AS pri ON pri.id=tp.price_unit
						WHERE tp.id <> $id  AND tp.success = 0 AND tp.published=1 AND ( ";
    					
		    		if($keytown_id)
		    		{
		    			$sql .= "  tp.town_id LIKE '%$keytown_id%'";
		    		}
		    		if($keykind_id)
		    		{
		    			if($keytown_id)
		    			{
		    				$sql.=" OR ";
		    			}
		    			$sql .= " kind_id LIKE '%$keykind_id%'";
		    		}
		    		
		   			if($keytype_id)
		    		{
		    			if($keykind_id || $keytown_id ){$sql.=" OR ";}
		    			$sql .= " type_id LIKE '%$keytype_id%'";
		    		}
		    		
		     		if($keyprice)
		    		{
		    			if($keytype_id || $keykind_id || $keytown_id ){$sql.=" OR ";}       			
		       			$sql.=	" ABS( $keyprice - IF( tp.price_unit=1,tp.price,tp.price*pri.rate )) < ( $keyprice * $khoanggia / 100 ) ";
		    		}
			    		$sql.=" ) GROUP BY tp.id";
			    		$sql.=" ORDER BY IF( tp.price_unit=1,tp.price,tp.price*pri.rate )";
	  	 }

         	$db = & JFactory::getDBO();        
			$db->setQuery($sql);
			$db->query();
		    $num_rows = @$db->getNumRows();
		    $tongtrang=ceil($num_rows/$slht);
		   	$bd=$page*$slht-$slht;
			$db->setQuery($sql,$bd,$slht);
			$rows = $db->loadObjectList();		

			foreach($rows as $row)
		{		
		if($row->kind_id == '1')
			{
			$row->itemid = '&Itemid=10'; 
			}
			elseif($row->kind_id == '2')
			{
			$row->itemid = '&Itemid=11'; 
			}
			elseif($row->kind_id == '3')
			{
			$row->itemid = '&Itemid=12'; 
			}
			elseif($row->kind_id == '4')
			{
			$row->itemid = '&Itemid=13'; 
			}
		}
		require_once (JPATH_BASE.DS.'modules'.DS.'mod_jea_emphasis'.DS.'helper.php');
		require_once (JPATH_BASE.DS.'templates'.DS.$CunTemp.DS.'html'.DS.'mod_jea_emphasis'.DS.'default.php');
		*/
	
?>
