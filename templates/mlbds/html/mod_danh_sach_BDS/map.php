<?php 
defined('_JEXEC') or die('Restricted access'); 
if ( empty( $ajaxPaging ) ) { $ajaxPaging = ''; }?>
<script style="text/javascript">
	var dulieubando=<?php echo json_encode($data)?>;
	function sidebar(data) {
	var codehtml='';  
	for (var i=0;i<data.length;i++) { 
		var tieude_check =  data[i].loai_giao_dich+' '+data[i].loai_bds+' '+data[i].du_an+', '+data[i].quan_huyen+', '+data[i].tinh_thanh;
		
		if(tieude_check.length>40){
			var tieude =  tieude_check.substring(0,37)+'...';
		}else{
			var tieude = tieude_check;
		}
	codehtml+='<div class="fitem loai_tin'+data[i].loai_tin_id+'" stt="'+i+'" id="list-normal-home-'+data[i].id+'" onclick="setActive(this.id)" style="border-bottom: 1px dotted #eee;">\
	<div class="items-icon">\
	<div class="f-r-tm listhome" style="font-size:11px;">\
	<div style="float:left;width:245px;">\
					<h4>\
					<a target="_blank" href="'+data[i].link+'" title="'+data[i].loai_giao_dich+' '+data[i].loai_bds+' '+data[i].du_an+', '+data[i].quan_huyen+', '+data[i].tinh_thanh+'" class="title-link">'+tieude+'</a>\
					</h4>\
			</div>';
			
	codehtml+='<div class="clear">\
					<ul class="clear" style="line-height: 18px;height: 18px;display:none">\
						<li class="li-content1">'+data[i].dia_chi+'</li>\
					</ul>\
					<ul class="clear">\
					<li class="li1">\
						<span class="li-title-h">\
							DTSD :\
						</span>\
						<span class="li-content-h">\
						<span>'
		if (data[i].dien_tich_su_dung!=0)
			codehtml+=data[i].dien_tich_su_dung+'m<sup>2</sup>';
		else codehtml+=' _';
		 
	codehtml+='</span>\
						</span>\
						</li>\
						<li class="li2">\
						<span class="li-title-h">\
							Nguyên căn:\
						</span>\
						<span class="li-content-h1">\
							<span class="gia">';
				if (data[i].gia_nguyen_can!=0) {
							codehtml+=data[i].gia_nguyen_can;
							if (data[i].don_vi_dien_tich_id == 3 || data[i].don_vi_dien_tich_id == 4){
									codehtml+= "/th";
							}
							} else { 
								codehtml+= "Thương lượng";
							}
			codehtml+='</span>\
						</span>\
						</li>\
						<li class="li3">\
							<span class="li-title-1-h">\
							M<sup>2</sup>:\
							</span>\
							<span class="li-content2-h">\
								<span class="gia">';
			if (data[i].gia_m2!=0) {
								codehtml+=data[i].gia_m2+'/m<sup>2</sup>';
								if (data[i].don_vi_dien_tich_id == 3 || data[i].don_vi_dien_tich_id == 4) {
									codehtml+="/th";
								}
							}else{
								codehtml+="Thương lượng";
							}
			codehtml+='</span>\
							</span>\
						</li>\
					</ul>\
			</div>\
		</div>\
		<div class="clear">\
		</div>\
	</div>\
	</div>';			
					
	}
	document.getElementById('list-map').innerHTML=codehtml;
	}
</script>
<div id="ajax_paging_bt_<?php echo $contentElementId?>" class="ajax_paging" style="">
	<?php echo $ajaxPaging;?>
</div> 
<?php 
if(!empty($data)){    
require_once ('components/com_mapbds/views/mapbds/tmpl/map.class.php');
for($i=0;$i<count($data);$i++){
	$listdata[$i]['id']			=	$data[$i]['id'];
	$listdata[$i]['latitude']	=	$data[$i]['kinh_do'];
	$listdata[$i]['longitude']	=	$data[$i]['vi_do'];
	$listdata[$i]['icon']		=	'';
}
//---------------------------
$map=new GoogleMap('road',15,$data[0]['kinh_do'],$data[0]['vi_do']);          // width,height,zoom,maptype
$map->Control('zoom-scale-pan-street');           			   // zoom,pan,scale,preview,street  
//$map->Condition('id>10000~landmark,id>20000~large_yellow,id>40000~buildings,id>80000~golf,id>90000~church');//condition~icon,condtion~icon 
//$map->Layer('5260907'); 
$map->Marker();   
$map->Info('json.php','components/com_mapbds/views/mapbds/tmpl/info.html');     
$map->Display("map-mlbds");     
//---------------------------
?>


<style>
#map-mlbds{margin:0;padding:0} 
.footer-f,.onfooter{
	display:none;
}  
.active_page {
	corlor:#FFF;
	background:#206cca; 
}
.fitem :hover {
}
#list-map{
	width:270px;
	float:right;
	overflow:scroll;
	position: absolute;
	z-index: 9990;
	margin-top: 22px;
	right: 0;
}
#arrow-map{
	width:25px;
	height:25px;
	float:right;
	overflow:hidden;
	margin-right:270px;
	position: absolute;
	background: #000;
	color:#fff;
	z-index:9999;
	right:0;
}
#sorting{
	height: 20px;
	background: #eee;
	width:270px;
	position: absolute;
	z-index: 9999;
	right: 0;
}
#fillter-list{
	text-align: right;
	margin-right: 10px;
}
.sorttime{
	background: #fff;
	float: right;
	right: 0;
	width: 0px;
	height: 0px;
	text-align: left;
	border-left: 1px solid #999;
	border-bottom: 1px solid #999;
}
.sorttime ul li{
	list-style: none;
	padding-left: 4px;
	border-bottom: 1px dotted #eee;
	cursor: pointer;
} 
#ajax_paging_bt_noi_dung190{
	right:0;
}
.title-link{
	margin-bottom:0;
}
</style>
<script type="text/javascript">  
var handclick=false; 
jQuery(function(){
	jQuery(document).scrollTop(1000);
	var wid = jQuery(document).width()-270; 
	//xác định chiều rộng cho full màn hình
	//var hei = jQuery(window).height()-395;
	var hei = 600;
	var heilist = hei-1;
	jQuery("#bigcontent").css("width","100%");
	jQuery(".bg-ft").css("width","100%");
	jQuery(".main").css("width","100%");
	jQuery(".sorttime").mouseleave(function(){
		hideSort();
	});
	jQuery("#map-mlbds").css("width",wid+"px");
	jQuery("#list-map").css("height",heilist-33+"px");
	jQuery("#list-map").css("margin-bottom","1px");
	jQuery("#list-map").css("margin-top","30px");
	jQuery("#arrow-map").css("background","url(<?php echo JURI::base()."templates/mlbds/images/arrow-right.png"?>) no-repeat left center");
	jQuery("#map-mlbds").css("height",hei+"px");
	jQuery("#map-mlbds").css("float","left");
	//var objDiv = document.getElementById("map-mlbds");
    //objDiv.scrollTop = objDiv.scrollHeight;

	//start add style when hover items
	jQuery("#list-map").children().mousemove(function(){
		/*
		var loaitin = jQuery(this).attr("class");
		if(loaitin=='fitem loai_tin3'){
			jQuery(this).children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr1.png) no-repeat left center");
		}else
		if(loaitin=='fitem loai_tin2'){
			jQuery(this).children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr2.png) no-repeat left center");
		}else{
			jQuery(this).children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr3.png) no-repeat left center");
		}
		*/
	});
	jQuery("#list-map").children().mouseout(function(){
		//jQuery(this).children().css("background","none");
	});
	 //en add style when hover items
    
});

function setActive(element){
	jQuery.each(jQuery(".items-icon"), function(){
		jQuery(this).attr("style","background:none");
	});
	var loaitin = jQuery("#"+element+"").attr("class");
	if(loaitin=='fitem loai_tin3'){
		jQuery("#"+element+"").children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr1.png) no-repeat left center");
	}else
	if(loaitin=='fitem loai_tin2'){
		jQuery("#"+element+"").children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr2.png) no-repeat left center");
	}else{
		jQuery("#"+element+"").children().css("background","url(<?php echo JURI::base()?>templates/mlbds/images/arr3.png) no-repeat left center");
	}
}

function newss(){
	//initialize();
	jQuery(document).scrollTop(1000);
	var wid = jQuery(document).width()-270;
	//xác định chiều rộng cho full màn hình
	//var hei = jQuery(window).height()-395;
	var hei = 600;
	var heilist = hei-1;
	jQuery("#bigcontent").css("width","100%");
	jQuery(".bg-ft").css("width","100%");
	jQuery(".main").css("width","100%");
	
	jQuery("#map-mlbds").css("width",wid+"px");
	jQuery("#list-map").css("height",heilist-33+"px");
	jQuery("#list-map").css("margin-bottom","1px");
	jQuery("#list-map").css("margin-top","30px");
	jQuery("#arrow-map").css("background","url(<?php echo JURI::base()."templates/mlbds/images/arrow-right.png"?>) no-repeat left center");
	jQuery("#map-mlbds").css("height",hei+"px");
	jQuery("#map-mlbds").css("float","right");
	//var objDiv = document.getElementById("map-mlbds");
    //objDiv.scrollTop = objDiv.scrollHeight;
	jQuery("#list-map").children().mousemove(function(){
		jQuery(this).css("background","#eee");
	});
	jQuery("#list-map").children().mouseout(function(){
		jQuery(this).css("background","none");
	});
	//alert('cuoi hàm newss');
}
function hideSort(){
	jQuery(".sorttime").animate({width: "-=170px",height: "-=145px"}, 500,function(){
		jQuery(".sorttime").css("display","none");	
	});
	jQuery(".sortindex").removeAttr("onclick");
	jQuery(".sortindex").attr("onclick", "showSort()");
}
var hidebar=false;
function showSort(){
	jQuery(".sorttime").css("display","block");
	jQuery(".sorttime").animate({width: "170px",height: "145px"}, 500);
	jQuery(".sortindex").removeAttr("onclick");
	jQuery(".sortindex").attr("onclick", "hideSort()");	
}
function resizeMap(){ 
    if (hidebar) {
		mapdiv.style.width=jQuery(document).width()-270+"px"; 
		hidevar=false;
	} else {
		mapdiv.style.width=jQuery(document).width()+"px";  
		hidebar=true;  
	} 
	google.maps.event.trigger(map,"resize"); 
}
function hideLists(){
	/*
	jQuery("#arrow-map").animate({right: "-=270"}, 500);
	jQuery("#sorting").animate({right: "-=270"}, 500);
	jQuery("#list-map").animate({right: "-=270"}, 500,function(){
		jQuery("#map-mlbds").css("width",widhbs+"px");
	});
	*/
	jQuery("#arrow-map").css("margin-right","0");
	jQuery("#ajax_paging_bt_noi_dung190").css("display","none");
	jQuery("#sorting").css("display","none");
	jQuery("#list-map").css("display","none");
	jQuery("#arrow-map").removeAttr("onclick");
	jQuery("#arrow-map").css("background","url(<?php echo JURI::base()."templates/mlbds/images/arrow-left.png"?>) no-repeat left center");
	jQuery("#arrow-map").attr("onclick", "showLists()");
	jQuery("#map-mlbds").css("width",jQuery('.main').width()+"px");
	google.maps.event.trigger(map,"resize");
	//resizeMap(); 
}
function showLists(){
	/*
	jQuery("#sorting").animate({right: "+=270"}, 500);
	jQuery("#arrow-map").animate({right: "+=270"}, 500);
	jQuery("#list-map").animate({right: "+=270"}, 500);
	*/
	jQuery("#arrow-map").css("margin-right","270px");
	jQuery("#ajax_paging_bt_noi_dung190").css("display","block");
	jQuery("#sorting").css("display","block");
	jQuery("#list-map").css("display","block");
	jQuery("#arrow-map").removeAttr("onclick");
	jQuery("#arrow-map").css("background","url(<?php echo JURI::base()."templates/mlbds/images/arrow-right.png"?>) no-repeat left center");
	jQuery("#arrow-map").attr("onclick", "hideLists()");
	jQuery("#map-mlbds").css("width",(jQuery('.main').width()-270)+"px"); 
	google.maps.event.trigger(map,"resize");
	//resizeMap();
} 
</script>
<div id="sorting">
	<div id="fillter-list"> 
		<div style="float:left; padding-left:5px;" id="currentlist"></div>
		<div class="sortindex" id="sortstatus"  onclick="showSort()">
		<?php 
		if(isset($_GET['clause'])){
			if($_GET['clause']=='dien_tich_su_dung_ASC'){
				echo "Diện tích sử dụng thấp nhất";
			}else
			if($_GET['clause']=='dien_tich_su_dung_DESC'){
				echo "Diện tích sử dụng cao nhất";
			}else
			if($_GET['clause']=='gia_nguyen_can_ASC'){
				echo "Giá nguyên căn thấp nhất";
			}else
			if($_GET['clause']=='gia_nguyen_can_DESC'){
				echo "Giá nguyên căn cao nhất";
			}else
			if($_GET['clause']=='gia_m2_ASC'){
				echo "Giá m<sup>2</sup> thấp nhất";
			}else
			if($_GET['clause']=='gia_m2_DESC'){
				echo "Giá m<sup>2</sup> cao nhất";
			}else{
				echo "Ngày cập nhật";
			}
		}else{
			echo "Ngày cập nhật";
		}	
		?>
		</div>
		<div class="sorttime" style="display: none;position: absolute;">
			<ul> 
				<li onclick="changeOrder('ngay_chinh_sua')">Ngày cập nhật</li> 
				<li onclick="changeOrder('dien_tich_su_dung_ASC')">Diện tích sử dụng thấp nhất</li>
				<li onclick="changeOrder('dien_tich_su_dung_DESC')">Diện tích sử dụng cao nhất</li>
				<li onclick="changeOrder('gia_nguyen_can_ASC')">Giá nguyên căn thấp nhất</li>
				<li onclick="changeOrder('gia_nguyen_can_DESC')">Giá nguyên căn cao nhất</li>
				<li onclick="changeOrder('gia_m2_ASC')">Giá m<sup>2</sup> thấp nhất</li>
				<li onclick="changeOrder('gia_m2_DESC')">Giá m<sup>2</sup> cao nhất</li> 
			</ul>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function(){
		//waitstop();
	});
	  
	var page = <?php
	if(isset($_GET['page'])){
	 	echo $_GET['page'];
	}else{
		echo "1";
	}
	 ?>;
	var totalpagex=<?php echo $totalItem; ?>;  
	function ref2(page,totalpage) {
		var item=50;  
		var total=totalpage;
		var items=(page-1)*item+1; 
		var itemsnext=items+item-1;
		if(itemsnext>totalpagex){
			itemsnext=totalpagex;
		}
		document.getElementById('currentlist').innerHTML=items+' - '+itemsnext+'/'+totalpagex; 
	}
	ref2(page,<?php echo $totalPage?>); 
</script>
<?php 
function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 	$pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
 return $pageURL;
}
?>
<script type="text/javascript">
var curURL = "<?php echo curPageURL();?>";
var clauseStr = "";

<?php if ( !empty( $_GET['clause'] ) ) {?>
clauseStr = "clause=" + "<?php echo $_GET['clause']?>";
<?php }?>

function changeOrder( value )
{
	/*if ( curURL.indexOf('&clause') > 0 )
	{
		curURL = curURL.substring( 0, curURL.indexOf('&clause') );
	}
	else if ( curURL.indexOf('?clause') > 0 )
	{
		curURL = curURL.substring( 0, curURL.indexOf('?clause') );
	}*/

	// get url without clause
	if ( clauseStr != "" )
	{
		curURL = curURL.replace( "?" + clauseStr, "" );
		curURL = curURL.replace( "&" + clauseStr, "" );
		curURL = curURL.replace( "/&", "/?" );
	}

	//alert('cur = ' + curURL );
	
	if ( curURL.indexOf("?") > 0 )
	{
		var changeOrderURL = curURL + "&clause=" + value;
	}
	else 
	{
		var changeOrderURL = curURL + "?clause=" + value;
	}

	//alert('change order cur = ' + changeOrderURL );
	
	if( curURL == "<?php echo JURI::base(); ?>"){
		var changeOrderURL = curURL + "?clause=" + value;
	}

	//alert('final change order cur = ' + changeOrderURL );
	
	window.location = changeOrderURL;
}
</script>
<div id="list-map"> 
</div>
<div id="arrow-map" onclick="hideLists()">&nbsp;</div>
<div id="map-mlbds"></div>
<?php }else{
	$user = JFactory::getUser();
	if($user->get('id')!=0){
		$link = JURI::base()."vi?option=com_u_re&view=manage&layout=yeucau&Itemid=242";
	}else{
		$link= JURI::base()."vi/dang-ky-thanh-vien-tao-yeu-cau-bds";
	}
	echo "<div class='clear'></div><span id='thongbao'>Không tìm thấy bất động sản theo yêu cầu<br /><a data-reveal-id='taoyeucau' href='".$link."'>Tạo yêu cầu BĐS, chúng tôi sẽ tự động gửi mail thông báo cho bạn</a></span>";
}?>