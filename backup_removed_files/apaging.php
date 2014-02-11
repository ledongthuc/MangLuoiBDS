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
include_once "libraries/unison/unison_jea_lib.php";

	function getComponentUrl ( $id=0,$itemid )
	{
	  	$url = 'index.php?option=com_jea&view=properties' ;
		if ( $id ) {
			$url .= '&Itemid='. intval( $itemid ). '&id=' . intval( $id ) ;
		}
	  
		return JRoute::_( $url );
	}
$idKind = $_REQUEST['idKind'];
//print_r("idkink".$idKind);
$itempa =  $_REQUEST['itemid'];
$pa=explode(',',trim($itempa));
$measure=$_REQUEST['measure'];
$tPage= $_REQUEST['tPage'];
$f= $_REQUEST['f'];
$t= $_REQUEST['t'];
$style=$_REQUEST['style'];
$order_by=$_REQUEST['order_by'];
$idPaging=$_REQUEST['idPaging'];

$fields = 'tp.id, tp.ref, tp.is_renting ,tp.price AS price, tp.living_space, tp.land_space, tp.advantages, tp.price_unit,tp.price_area_unit,'
		        . 'tp.address, tp.phuongxa AS phuongxa, tp.duongpho AS duongpho, tp.ordering AS ordering,tp.description AS `description`, td.value AS `department`, ts.value AS `slogan`, tt.value AS `type`, '
		        .  'tto.value AS `town`,area.value AS `area`, tp.date_insert AS date_insert,tp.kind_id' ;
		$fields .= ', td.id AS `id2`, ts.id AS `id3`, tt.id AS `id4`, tto.id AS `id5` ' ; 

		$select = 'SELECT ' . $fields .' FROM #__jea_properties AS tp'. PHP_EOL 
		        . 'LEFT JOIN #__jea_departments AS td ON td.id = tp.department_id'. PHP_EOL
		        . 'LEFT JOIN #__jea_slogans AS ts ON ts.id = tp.slogan_id'. PHP_EOL
		        . 'LEFT JOIN #__jea_types AS tt ON tt.id = tp.type_id'. PHP_EOL
		        . 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id'. PHP_EOL
				. 'LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id'. PHP_EOL				;
		$where=" WHERE tp.published=1 AND tp.success = 0 ";
		 if($style=="emphasis")
		 {
		 	$where.=" AND tp.emphasis=1";
		 }    
		 else if($style=="newsest")
			{
				$where.=" AND tp.newsest=1";
			}
		else if($style=="byKind")
		{
			//print_r($idKind);
				$where .= ' AND tp.kind_id= '.$idKind ;
	
		}
		 $tranga = ($f-1)*$t;
		 $where.=" ORDER BY $order_by DESC " ;
		 $where.=" LIMIT $tranga,$t" ;
		$sql = $select. $where;		
		//print_r($sql);			
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();

		if ( $db->getErrorNum() ) 
		{
		JError::raiseWarning( 200, $db->getErrorMsg() );
		}
					
			foreach ($rows as $k => $row) 
			{	
				switch ($row->kind_id)
					{
						case 1:
							$itemid= $pa[0] ;
							break;
						case 2:
							$itemid=  $pa[1];
							break;
						case 3:
							$itemid= $pa[2] ;
							break;
						case 4:
							$itemid=  $pa[3];
							break;
					}
			}
require_once (JPATH_BASE.DS.'modules'.DS.'mod_jea_emphasis'.DS.'helper.php');
require_once (JPATH_BASE.DS.'templates'.DS.'webkp'.DS.'html'.DS.'mod_jea_emphasis'.DS.'default.php');
	
?>