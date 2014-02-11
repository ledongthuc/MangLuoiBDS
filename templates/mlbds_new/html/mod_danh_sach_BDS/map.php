<?php 
defined('_JEXEC') or die('Restricted access');
require_once ('components/com_mapbds/views/mapbds/tmpl/map.class.php');
for($i=0;$i<count($data);$i++){
	$listdata[$i]['id']			=	$data[$i]['id'];
	$listdata[$i]['latitude']	=	$data[$i]['kinh_do'];
	$listdata[$i]['longitude']	=	$data[$i]['vi_do'];
	$listdata[$i]['icon']		=	'';
}
//---------------------------
$map=new GoogleMap('road',15,$data[0]['kinh_do'],$data[0]['vi_do']);          // width,height,zoom,maptype
$map->Control('zoom-preview-scale-pan-street');          			   // zoom,pan,scale,preview,street  
$map->Condition('id>10000~landmark,id>20000~large_yellow,id>40000~buildings,id>80000~golf,id>90000~church');//condition~icon,condtion~icon
//$map->Layer('5260907'); 
$map->Marker($listdata); 
$map->Info('json.php','components/com_mapbds/views/mapbds/tmpl/info.html');     
$map->Display("map2");   
//---------------------------
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<div id="ajax_paging_bt_<?php echo $contentElementId?>" class="ajax_paging" style="">
	<?php echo $ajaxPaging;?>
</div>
<style>#map2{margin:0;padding:0;height:600px;width:100%;</style>		
<div id="map2"></div>