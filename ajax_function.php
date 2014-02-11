<?php 
define( '_JEXEC', 1 );

define('JPATH_BASE', dirname(__FILE__) );

define( 'DS', DIRECTORY_SEPARATOR ); 
require_once 'includes/defines.php';
require_once 'includes/framework.php';
require_once 'libraries/loader.php';
require_once 'libraries/joomla/base/object.php';
require_once 'libraries/joomla/error/error.php';
require_once 'libraries/joomla/factory.php';
require_once 'libraries/joomla/filter/filterinput.php';
require_once 'libraries/com_u_re/php/common_utils.php';
require_once 'libraries/joomla/methods.php';
require_once 'libraries/joomla/language/language.php';
require_once 'libraries/joomla/language/helper.php';
require_once 'components/com_u_re/defines.php';
require_once 'libraries/com_u_re/php/config.php';
require_once 'libraries/joomla/environment/uri.php';
require_once 'libraries/joomla/registry/registry.php';

foreach ($_GET as $key=>$value) {
	$_GET[$key]=str_replace('-',',',$_GET[$key]); 
} 

if ( !defined('JPATH_COMPONENT') )
{
	define( 'JPATH_COMPONENT', JPATH_ROOT . DS . 'components' .  DS . 'com_u_re');
}

$task = $_GET['task'];

$language = $_GET['language'];
$dbConfig = array();


$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'host' );
$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'user' );
$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'pass' );
$dbConfig[] = U_ReConfig::getValueByKey( 'DB', 'name' );

//$dbConfig[] = "localhost";
//$dbConfig[] = "mlbds_db";
//$dbConfig[] = "1234mldbqwer";
//$dbConfig[] = "mlbds_db";

$ordering = U_ReConfig::getValueByKey( 'MOD_DANH_SACH_BDS', 'orderby' );
if ( $task == 'bdslq' )
{
	// Lay data bdslq
	require_once 'libraries/com_u_re/models/properties.php';
	
	$lang = ilandCommonUtils::getLanguage(); 
	$currentPage = $_GET['page'];	
	$condition = $_GET['condition'];
	$limit=10;	
	$returnField = $_GET['return_field'];
	$conditionArr = explode( ',', $condition ); 
	  
	// tao data property
	$propertyData = array();
	foreach ( $conditionArr as $con )
	{
		$propertyData[$con] = $_GET[$con];
	}
	
	$conditionParam = ilandCommonUtils::genBDSLQConditionParam( $condition, $propertyData );
	
	//$data = U_ReModelProperties::getListProperties( $returnField, $conditionParam, $currentPage, 10 );
	
//	$data = U_ReModelProperties::getSameProperties( $lang, $returnField, 
//													$condition, $propertyData, $currentPage );
	
	// fetch bdslq template
//	$dataHTML = ilandCommonUtils::fetchPropertiesTemplate( $_SESSION['templatePath'], 
//														   $_SESSION['templateName'], $data[3] );
	
		$dataAll = iland4_layDanhSachBDS( $dbConfig, $returnField, $conditionParam, $currentPage, 
    								  $limit, $ordering, $language );
		
    $data = $dataAll[3];
    $templatePath = $_GET['template_path'];
    $templateName = $_GET['template_name'];								  
	
	include $templatePath . DS . $templateName . '.php';
}
else if ( $task == 'dsbds' )
{
	// load tieu de theo language
	$lang='vi-VN';
	$path = JLanguage::getLanguagePath( JPATH_BASE, $lang);
	$filename = 'vi-VN.mod_danh_sach_BDS.ini';
	$filename = $path.DS.$filename;
	
	$content = @file_get_contents( $filename );
	$registry	= new JRegistry();
	$registry->loadINI($content);
	$titleStrings	= $registry->toArray();
	
	//$currentPage = 1;
	$condition =  $_GET['condition'];
	if ( !empty( $_GET['page'] ) )
	{
		$currentPage = $_GET['page'];
	}
	
	//if (  )
	//$limit = $_GET['limit'];
	$limit=1000000000;  
	$price[]=array();
	$price['price_min']=0;
	$price['price_max']=0;
	//$price['price_min']=$_GET['price_min'];
	//$price['price_max']=$_GET['price_max'];
	$returnField = $_GET['returnField'];
	
	if($price['price_min']!='' || $price['price_max']!=''){		
			$newcondition=$condition.' AND';
			$newField='bds.'.$returnField ;
			$newField = str_replace('ordering','bds.ordering',$newField);
			$ordering = str_replace('ordering','bds.ordering',$ordering);
			$dataAll = iland4_layDanhSachBDSTheoGia( $dbConfig, $newField, $newcondition,$price['price_min'],$price['price_max'],
					 $currentPage, $limit, $ordering, $language );
	}else{
		$dataAll = iland4_layDanhSachBDS( $dbConfig, $returnField, $condition, $currentPage, 
    								  $limit, $ordering, $language );

	}
	$templatePath = $_GET['templatePath'];
    $templateName = $_GET['templateName'];
    $tienTemplatePath = $_GET['tienTemplatePath'];
    $moduleId = $_GET['moduleId'];
    $data = ilandCommonUtils::boSungThongTinBDS( $dataAll[3] , $tienTemplatePath, $moduleId );
   
    // TODO: dua ra giai phap tot hon. 
    $contentElementId = $_GET['idContentElement'];
    $url = ilandCommonUtils::getCurrentPageURL();
    $ajaxPagingTemplate = $_GET['ajaxPagingTemplate'];
    $totalPage = $dataAll[1];
	
	// include $templatePath . DS . $templateName . '.php';
	
    $conditionStr = $_GET['condition'];
    $conditionParam = explode( 'OR', $conditionStr );
	/*if ( strpos( $conditionParam[0], 'loai_giao_dich_id' ) )
	{
		$loaiGiaoDichArr = explode( '=', $conditionParam[0] );
		if ( $loaiGiaoDichArr[1] == 3 || $loaiGiaoDichArr[1] == 4 )
		{
			include $templatePath . DS . 'can_mua_can_thue.php';
		}
		else 
		{
			include $templatePath . DS . 'moinhat.php';
		}
	}
	else 
	{*/
	
		//include $templatePath . DS . 'map.php';  
		
	// Fill full information
	
	require_once('configuration.php');
	$config=new JConfig;
	mysql_connect($config->host,$config->user,$config->password) or die('Cant connect !');
	mysql_select_db($config->db);	
	mysql_query('SET NAMES utf8'); 
	for ($i=0;$i<count($data);$i++) {
		$cmd='SELECT * FROM  `iland4_bat_dong_san_vi` WHERE id='.$data[$i]['id'];
		$info=mysql_fetch_assoc(mysql_query($cmd));
		$data[$i]['time']=$info['ngay_chinh_sua'];
		$data[$i]['m2']=$info['gia_m2'];		  
	}
	
	// QuickSort Algorithms ^^ 
	$con=$_GET['fkey'];
	function Partion_inc($L, $H) {
		global $data,$con;
        if ($L >= $H) return;
        $i = $L;
        $j = $H;
        $key = $data[floor(($L+$H)/2)][$con];
        do { 
            while ($key > $data[$i][$con]) $i++;
            while ($key < $data[$j][$con]) $j--;
            if ($i <= $j) {
                $tam = $data[$i];
                $data[$i] = $data[$j];
                $data[$j] = $tam;
                $i++;
                $j--;
            } 
        } while ($i <= $j);  
        Partion_inc($L,$j);
        Partion_inc($i,$H); 
	}  
	function Partion_dec($L, $H) { 
		global $data,$con;
        if ($L >= $H) return;
        $i = $L;
        $j = $H;
        $key = $data[floor(($L+$H)/2)][$con];
        do { 
            while ($key < $data[$i][$con]) $i++;
            while ($key > $data[$j][$con]) $j--; 
            if ($i <= $j) {
                $tam = $data[$i];
                $data[$i] = $data[$j];
                $data[$j] = $tam;
                $i++;
                $j--;
            }  
        } while ($i <= $j);  
        Partion_dec($L,$j);
        Partion_dec($i,$H);
	}   
	if (isset($_GET['forder']))  
		if ($_GET['forder']=='ASC') Partion_inc(0,count($data)-1); else Partion_dec(0,count($data)-1);
	 
	$limit=50;  
	$pos=($currentPage-1)*$limit;
	$data=array_slice($data,$pos,$limit);    
	echo json_encode($data);   
}
?>