/*
 * Define utils for admin part
 */

/*
 * Lấy dữ liệu ở các ô check box tiện ích, dùng cho phần đa ngôn ngữ
 */
function loadXMLDoc(url,cfunc){
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

function getSaiPham(id,url){
	alert('Báo cáo thành công, chúng tôi sẽ kiểm tra bài đăng!');
	var add= url+'bao_cao_sai_pham.php?id='+ id ;
	loadXMLDoc(add);
}

/*
 * Chuyển đổi ngôn ngữ
 */
function getDataLang( currentLang, fields )
{	
	
	// currentLang: luu tru gia tri ngon ngu hien tai
	var lang = document.getElementById('currentLang').value;	
	document.getElementById('currentLang').value = currentLang;		
	// gan gia tri cho tag hidden cho tung ngon ngu
	document.getElementById(lang+'_hidden_ref').value=document.getElementById('ref').value;
	document.getElementById('ref').value=document.getElementById(currentLang+'_hidden_ref').value;
	
	
	//TODO: tat tam thoi 
	//alert(lang);
	var fieldsCompoValue = "kind_id,type_id,town_id,area_id,price_unit,price_area_unit,direction_id,du_an_id"; //vanganh
	var fieldsCompoKey = "loai_bds,loai_giao_dich,tinh_thanh,quan_huyen,don_vi_tien,don_vi_dien_tich,huong,du_an"; // vanganh
	
	//var fieldsCompoValue = "loai_bds,loai_giao_dich,phap_ly,don_vi_dien_tich,don_vi_tien,nha_moi_gioi_ten,tinh_thanh,quan_huyen,tien_ich,huong";
	// chuyển fields từ kiểu string sang kiểu mảng
	var fieldsCompoValueArr = fieldsCompoValue.split(",");
	var fieldsCompoKeyArr = fieldsCompoKey.split(",");
	var fieldsCompoValueArrCount = fieldsCompoValueArr.length;
	var comValueText ='';
	for ( var i = 0; i < fieldsCompoValueArrCount; i++ )
	{
	//	comvalue = lang+'_'+fieldsCompoValueArr[i];		
		comkey = lang+'_'+fieldsCompoKeyArr[i];			
		var compValue = document.getElementById(fieldsCompoValueArr[i]) ;
		
		if ( compValue!=null && compValue.value != 0 )
		{	
			//alert(comkey+'--'+i+compValue.value);
			comValueText = compValue.options[compValue.selectedIndex].text;			
			document.getElementById(comkey).value = comValueText
			//alert(document.getElementById(comkey).value);			
		}

	}
	var motatrang = '';
	if ( document.getElementById('gioi_thieu_bds_id') != null )
	{
		motatrang = document.getElementById('gioi_thieu_bds_id').value;
	}
	else 
	{
		motatrang = document.getElementById('mo_ta_chi_tiet_ifr').contentWindow.document.body.innerHTML;
	}
	
	document.getElementById(lang+'_hidden_description').value = motatrang;
//	alert(motatrang);
	var mo_ta_trang = document.getElementById(currentLang+'_hidden_description').value;
//	alert(mo_ta_trang);
	if ( document.getElementById('gioi_thieu_bds_id') != null )
	{
		document.getElementById('gioi_thieu_bds_id').value = motatrang;
	}
	else 
	{
		document.getElementById('mo_ta_chi_tiet_ifr').contentWindow.document.body.innerHTML = mo_ta_trang;
	}
//	alert(motatrang);
		
	
}



function ktMaSo(form){
	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var data=xmlhttp.responseText;
		if(data==0){
			var form = document.adminForm;
			form.submit();
		}
		else{
			alert("Vui lòng lấy mã tài sản khác");
		}
	}
}
/*
 * Chuyển đổi ngôn ngữ
 */
function getDataLang_vhl( currentLang, fields )
{	
	
	 // alert('getDatalang_vhl ');
	// TODO: remove hardcode
	fields = "ref,address,name_vl,address_vl,ghichu,page_title,page_keywords,page_description,properties_key";
	
	// chuyển fields từ kiểu string sang kiểu mảng
	$fieldArr = fields.split(",");
	$fieldCount = $fieldArr.length; 
	
	// currentLang: luu tru gia tri ngon ngu hien tai
	var lang = document.getElementById('currentLang').value;	
	document.getElementById('currentLang').value = currentLang;		
	var hiddenField = "";
	// var tempValue = "";
	
	// gan gia tri cho tag hidden cho tung ngon ngu
	for ( var i = 0; i < $fieldCount; i++ )
	{
		
		hiddenField = lang+'_hidden_' + $fieldArr[i];		
		hiddenFieldCurren = currentLang+'_hidden_' + $fieldArr[i];
		var fieldArrValue = document.getElementById($fieldArr[i]).value;
		document.getElementById(hiddenField).value = fieldArrValue;
		
		document.getElementById($fieldArr[i]).value = document.getElementById(hiddenFieldCurren).value ;
		/*
		alert(fieldArrValue);		
		
		tempValue = document.getElementById(hiddenField).value;
		//alert(tempValue);
		document.getElementById($fieldArr[i]).value = tempValue;
		
		document.getElementById(hiddenField).value = 
			document.getElementById($fieldArr[i]).value;
		 */
			
	}
	
	
	//TODO: tat tam thoi 
	
	
	var fieldsCompoValue = "kind_id,type_id,town_id,area_id,price_unit,price_area_unit,legal_status,direction_id"; //vanganh
	var fieldsCompoKey = "loai_bds,loai_giao_dich,tinh_thanh,quan_huyen,don_vi_tien,don_vi_dien_tich,phap_ly,huong"; //vanganh
	
	/*
	var fieldsCompoValue = "kind_id,type_id,position,town_id,area_id,price_unit,price_area_unit,legal_status,direction_id,realtor_id";
	var fieldsCompoKey = "loai_bds,loai_giao_dich,vi_tri,tinh_thanh,quan_huyen,don_vi_tien,don_vi_dien_tich,phap_ly,huong,nha_moi_gioi";
	*/
	//var fieldsCompoValue = "kind_id,type_id,position";
	//var fieldsCompoKey = "loai_bds,loai_giao_dich,vi_tri";
	//var fieldsCompoKey = "loai_bds,loai_giao_dich,phap_ly,don_vi_dien_tich,don_vi_tien,nha_moi_gioi_ten,nha_moi_gioi_ten,tinh_thanh,quan_huyen,tien_ich,huong";
	
	//var fieldsCompoValue = "loai_bds,loai_giao_dich,phap_ly,don_vi_dien_tich,don_vi_tien,nha_moi_gioi_ten,tinh_thanh,quan_huyen,tien_ich,huong";
	// chuyển fields từ kiểu string sang kiểu mảng
	var fieldsCompoValueArr = fieldsCompoValue.split(",");
	var fieldsCompoKeyArr = fieldsCompoKey.split(",");
	var fieldsCompoValueArrCount = fieldsCompoValueArr.length;
	//alert(fieldsCompoValueArrCount);
	//alert(fieldsCompoValueArr);
	var comValueText ='';
	for ( var i = 0; i < fieldsCompoValueArrCount; i++ )
	{
	//	comvalue = lang+'_'+fieldsCompoValueArr[i];		
		comkey = lang+'_'+fieldsCompoKeyArr[i];	
		
		var compValue = document.getElementById(fieldsCompoValueArr[i]) ;
	//	alert(compValue);
		
		//if ( compValue != 0 )
		//{	
			comValueText = compValue.options[compValue.selectedIndex].text;
			//alert(comkey);
			// alert(comValueText);
			//document.getElementById($fieldArr[i]).value = document.getElementById(hiddenFieldCurren).value ;
			document.getElementById(comkey).value = comValueText
			
	//	}

	}
	// alert('555');
	var motatrang = document.getElementById('mo_ta_chi_tiet_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_description').value = motatrang;
//	alert(motatrang);
	var mo_ta_trang = document.getElementById(currentLang+'_hidden_description').value;
//	alert(mo_ta_trang);
	document.getElementById('mo_ta_chi_tiet_ifr').contentWindow.document.body.innerHTML = mo_ta_trang
	
	 
//	alert(motatrang);
		
	
//	var ref = document.getElementById('ref').value;	
//	var address = document.getElementById('address').value;
//	var name_vl = document.getElementById('name_vl').value;
//	var address_vl = document.getElementById('address_vl').value;
//	var ghichu = document.getElementById('ghichu').value;
//	var page_title = document.getElementById('page_title').value;
//	var page_keywords = document.getElementById('page_keywords').value;
//	var page_description = document.getElementById('page_description').value;
//	var properties_key = document.getElementById('properties_key').value;
//	var description = document.getElementById('description_ifr').contentWindow.document.body.innerHTML;
//	
//	//gan gia tri cho tag hidden cho tung ngon ngu
//	document.getElementById(lang+'_hidden_ref').value = ref;	
//	document.getElementById(lang+'_hidden_address').value = address;
//	document.getElementById(lang+'_hidden_description').value = description;
//	document.getElementById(lang+'_hidden_name_vl').value = name_vl;
//	document.getElementById(lang+'_hidden_address_vl').value = address_vl;
//	document.getElementById(lang+'_hidden_ghichu').value = ghichu;
//	document.getElementById(lang+'_hidden_page_title').value = page_title;
//	document.getElementById(lang+'_hidden_page_keywords').value = page_keywords;
//	document.getElementById(lang+'_hidden_page_description').value = page_description;
//	document.getElementById(lang+'_hidden_properties_key').value =  properties_key;
	
	// reset lai o textbox khi chuyen qua ngon ngu moi hoac lay lai gia tri khi quay tro ve		
//	var hidden_ref = document.getElementById(currentLang+'_hidden_ref').value;	
//	document.getElementById('ref').value = hidden_ref;	
//
//	var hidden_address = document.getElementById(currentLang+'_hidden_address').value;
//	document.getElementById('address').value = hidden_address;	
//	
//	var hidden_description = document.getElementById(currentLang+'_hidden_description').value;
//	document.getElementById('description_ifr').contentWindow.document.body.innerHTML = hidden_description
//	
//	var hidden_name_vl = document.getElementById(currentLang+'_hidden_name_vl').value;
//	document.getElementById('name_vl').value = hidden_name_vl;	
//
//	var hidden_address_vl = document.getElementById(currentLang+'_hidden_address_vl').value;
//	document.getElementById('address_vl').value = hidden_address_vl;	
//	
//	var hidden_ghichu = document.getElementById(currentLang+'_hidden_ghichu').value;
//	document.getElementById('ghichu').value = hidden_ghichu;	
//	
//	var hidden_page_title = document.getElementById(currentLang+'_hidden_page_title').value;
//	document.getElementById('page_title').value = hidden_page_title;	
//	
//	var hidden_page_keywords = document.getElementById(currentLang+'_hidden_page_keywords').value;
//	document.getElementById('page_keywords').value = hidden_page_keywords;	
//	
//	var hidden_page_description = document.getElementById(currentLang+'_hidden_page_description').value;
//	document.getElementById('page_description').value = hidden_page_description;	
//	
//	var hidden_properties_key = document.getElementById(currentLang+'_hidden_properties_key').value;
//	document.getElementById('properties_key').value = hidden_properties_key;		
}


/*
 * Ghép các giá trị được chọn rồi gán vào 1 trường thông tin tổng quan
 */
function addinfo(lang)
{
	//alert ('add info');
	var jskinds = document.getElementById("kind_id");
	var jskindsid = document.getElementById("kind_id").value;
	if ( jskindsid != 0 )
	{
		kindsvalue = jskinds.options[jskinds.selectedIndex].text;
	}
	else
	{
		kindsvalue = '';
	}

	var jstype = document.getElementById("type_id");
	var jstypeid = document.getElementById("type_id").value;
	if ( jstypeid != 0 )
	{
		typevalue = jstype.options[jstype.selectedIndex].text;
	}
	else
	{
		typevalue = '';
	}	
	// vanganh sua
	//var jsaddressid = document.getElementById("address").value;
	// var jsaddressid = document.getElementById("duong_pho_id").value;
	//var sonhavalue = document.getElementById("housenum").value;
	//var duongphovalue = document.getElementById("duong_pho_id").value;
	var phuongxavalue ='';
	
	/*
	var jsaddressid = document.getElementById("housenum").value;
	var jsduongpho=document.getElementById("duong_pho_id");
	if(jsduongpho.value!=0){
		duongphovalue = jsduongpho.options[jsduongpho.selectedIndex].text + ", ";
	}else{
		var ten_duong_pho=document.getElementById("vi_duong_pho_text");
		if(ten_duong_pho!=null && ten_duong_pho.value!='')
			duongphovalue=ten_duong_pho.value + ", ";
	}
	var jsphuongxa=document.getElementById("phuong_xa_id");
	if(jsphuongxa.value!=0){
		phuongxavalue = jsphuongxa.options[jsphuongxa.selectedIndex].text + ", ";
	}
	*/
	var jstown = document.getElementById("area_id");
	var jstownid = document.getElementById("area_id").value;
	if ( jstownid != 0 )
	{
		area = jstown.options[jstown.selectedIndex].text;
	}
	else
	{
		area = '';
	}
	
	var jstown_id = document.getElementById("town_id");
	var jstown_idid = document.getElementById("town_id").value;
	if ( jstown_idid != 0 )
	{
		townidvalue = jstown_id.options[jstown_id.selectedIndex].text;
	}
	else
	{
		townidvalue = '';
	}
	var dau ='';
	var dau2 ='';
	/*if (jsaddressid != "")
	{
		dau=' ';
	}*/
	if (area != "")
	{
		dau2=', ';
	}
	//var groupinfo = kindsvalue + ' '+ typevalue + ' ' + jsaddressid + dau + area + dau2 + townidvalue;
	var groupinfo = kindsvalue + ' '+ typevalue + ' ' + phuongxavalue + area + dau2 + townidvalue;
	document.getElementById("pro_total_info").value = groupinfo ;
}
/*
 * Thêm 1 ô upload hình ảnh
 */
function AddNewUploadControl(index)
{
	if(index==(TotalItem-1))
	{
		
		var tr = document.getElementById("tblUpload").insertRow(index);
		tr.id =  index;
		var td1 = tr.insertCell(0);
		td1.vAlign = "top";
		td1.innerHTML = '<span id="aj_SECONDARIES" style="min-width:53px"></span>';
		var td2 = tr.insertCell(1);
		td2.vAlign = "middle";
		td2.innerHTML = '<input class=dangtin_anhphup style="min-width:250px" type="file" name="'+ImgName+index+'" id="'+ImgName+index
						+ '"  size=26 onchange="javascript:Upload_Img(this)">';
		// td1.innerHTML = 'Ảnh phụ '+TotalItem;<img class=hinh_xoa src="./images/cancel_f2.png" name="fButton'+index+'" id=fButton'+index+'  onclick="RemoveRow(this)">
		TotalItem++;

		/*
		if (  document.getElementById('box_id').style.height =='auto' )
		{				
				var chieucaobox_ht =document.getElementById('box_id').offsetHeight;
					alert('1'+chieucaobox_ht);
		}
		else
		{
			var chieucaobox_ht = parseInt(document.getElementById('box_id').style.height.replace('px',''));
				alert('2'+chieucaobox_ht);
		}
		alert(chieucaobox_ht);
		*/
			document.getElementById('box_id').style.height = 'auto';
		// document.getElementById('box_id').style.height = chieucaobox_ht+30+'px';
		
		

	}
}

/*
 * Xóa 1 ô upload hình ảnh
 */
function RemoveRow(objButton)
{
/*
	if (  document.getElementById('box_id').style.height =='auto' )
		{				
				var chieucaobox_ht =document.getElementById('box_id').offsetHeight;
					alert('1'+chieucaobox_ht);
		}
		else
		{
			var chieucaobox_ht = parseInt(document.getElementById('box_id').style.height.replace('px',''));
				alert('2'+chieucaobox_ht);
		}
		alert(chieucaobox_ht);
		*/
//	var chieucaobox_ht = parseInt(document.getElementById('box_id').style.height.replace('px',''));
	// alert('chieucaobox_ht'+chieucaobox_ht);
//	document.getElementById('box_id').style.height = chieucaobox_ht-30+'px';
		
	document.getElementById('box_id').style.height = 'auto';

	var RowIndex=parseInt(objButton.name.substring(7));
	// alert(RowIndex);
	document.getElementById("tblUpload").deleteRow(RowIndex);
	for (var i=RowIndex+1;i<TotalItem;i++)
	{
		Fix(ImgName,parseInt(i));
		Fix('fButton',parseInt(i));
	}
	TotalItem--;
	var index;
	var NumRow = document.getElementById("tblUpload").rows.length;
	   index = ImgName + ( NumRow-1);
	if(document.getElementById("tblUpload").rows.length > 8)
	{
		if(document.getElementById(index).value != "")
		{
			AddNewUploadControl(9);
		}
	}
}

/*
 * TODO: Thêm mô tả cho hàm này
 */
function Fix(Id,Index)
{
	var	obj=document.getElementById(Id+Index);
	if (obj)
	{
		obj.name = Id+parseInt(parseInt(Index)-1);
		obj.id	 = Id+parseInt(parseInt(Index)-1);
	}
}

var TotalItem = 2;
var Limit = 0;
var TotalImg =10;
var ImgName = 'secondaries_images';

/*
 * Cho phép người dùng upload thêm 1 hình ảnh nữa
 */
function UploadImg(obj)
{
	
	var TotalExist = document.getElementById("CountImage").value;

	if(TotalExist == 0)
	{
		Limit = TotalImg;
	}
	else
	{
		Limit = TotalImg - TotalExis;
	}
	 if(parseInt(obj.name.substr(18,2)) < Limit)
	{
		AddNewUploadControl(parseInt(obj.name.substr(18,2))+1);
		
	}
	else
	{
		 alert("Bạn chỉ có thể đăng được "+Limit+" hình ảnh");
	}
}

function Upload_Img(obj)
{
	var TotalExist = document.getElementById("CountImage").value;
	if(TotalExist == 0)
	{
		Limit = TotalImg;
	}
	else
	{
		Limit = TotalImg - TotalExist;
	}
	if(parseInt(obj.name.substr(18,2)) +1 < Limit)
	{
		 AddNewUploadControl(parseInt(obj.name.substr(18,2))+1);
	}
	else
	   alert("Bạn chỉ có thể đăng được "+Limit+" hình ảnh");
}

var arrTopic= new Array();

//Hiển thị dropdownlist Topic ứng với catid
function HienThiTopic(parent_Id,checked,textCbo,nameCbo)
{
	// get ajax
}
//end hien thi tuong ung

function Topic(id, text, parent_Id)
{ this.id = id;  this.text = text;  this.parent_id = parent_Id; }

function jea_change_form_project_group(id,idInner,checked)
{
	// get ajax data
}
function jea_change_form_towns(id,idInner,checked)
{
	// get ajax data
}


/*
 * Google map v3
 */
function getAddress()
{
	//alert('vao toi address');
	var address = "";
	var so_nha = '';
	if(document.getElementById("housenum")!=null)
		so_nha = document.getElementById("housenum").value;
	address+=so_nha;
	var duong_pho=document.getElementById("duong_pho_id");
	if ( duong_pho != null && duong_pho.value!=0 )
	{
		if(address!="")
		{
			address +=" ";
		}
		if ( duong_pho.selectedIndex != null && duong_pho.selectedIndex >= 0 )
		{
			address += duong_pho.options[duong_pho.selectedIndex].text;
		}
		else 
		{
			address += duong_pho.value;
		}
	}
	
	var phuong_xa=document.getElementById("phuong_xa_id");
	if ( phuong_xa != null && phuong_xa.value!=0 )
	{
		if(address!="")
			address +=", ";
		address += phuong_xa.options[phuong_xa.selectedIndex].text;
	}
	
	var quan_huyen=document.getElementById("area_id");
	if ( quan_huyen != null && quan_huyen.value!=0 )
	{
		if(address!="")
			address +=", ";
		address += quan_huyen.options[quan_huyen.selectedIndex].text;
	}
	
	var tinh_thanh=document.getElementById("town_id");
	if ( tinh_thanh != null && tinh_thanh.value!=0 )
	{
		if(address!="")
			address +=", ";
		address += tinh_thanh.options[tinh_thanh.selectedIndex].text;
	}
	return address;
	
}
/* add script for admin google map */
	var geocoder;
    var map;
    // default position if google can not find the address -- trung tam tphcm
    var defaultPosition = new google.maps.LatLng(106.709291, 10.801639);
    var marker;
    window.onload = function()
	{
    	//initalizetab("tabheader");
		geocoder = new google.maps.Geocoder();
        
        var options = {
            zoom: 16,
            disableDefaultUI:true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl:true,
    		zoomControl: true
        };
        
        map = new google.maps.Map(document.getElementById('map'), options);
        
		// get map lat & lng
		var map_lat = document.getElementById("map_lat").value;
		var map_lng = document.getElementById("map_lng").value;
		var realPosition = new google.maps.LatLng(map_lat, map_lng);
		//var info = document.getElementById("address").value;
		var info = getAddress();
		 //alert(map_lng);
		 //alert(map_lat);
		if ( map_lat == 0 && map_lng == 0 )
		{
			// dung dia chi
	        //var address = document.getElementById("address").value;
	        var address = getAddress();
	        geocoder.geocode( { 'address': address}, function(results, status) {
	            if (status == google.maps.GeocoderStatus.OK) {
	                map.setCenter(results[0].geometry.location);
	                marker = new google.maps.Marker({
	                    map: map,
	                    position: results[0].geometry.location,
	                    clickable: true,
	                    mapTypeId: google.maps.MapTypeId.ROADMAP,
						draggable: true
	                });
	                updateMarkerPosition( marker );
	                var infowindow = new google.maps.InfoWindow({
	                    content: info
	                });//end InfoWindow
	                google.maps.event.addListener(marker, 'click', function() {
	                    infowindow.open(map, marker);
	                });//end infoWindow
	                google.maps.event.addListener(marker, 'dragend', function() {
	                	updateMarkerPosition( marker );
	                });
	            } else {
	            	map.setCenter(defaultPosition);
	                marker = new google.maps.Marker({
	                    map: map,
	                    position: defaultPosition,
	                    title: 'Default',
	                    clickable: true,
	                    mapTypeId: google.maps.MapTypeId.ROADMAP,
						draggable: true
	                });
	                updateMarkerPosition( marker );
	                var infowindow = new google.maps.InfoWindow({
	                    content: 'Default position'
	                });//end InfoWindow
	                google.maps.event.addListener(marker, 'click', function() {
	                    infowindow.open(map, marker);
	                });//end infoWindow
	                google.maps.event.addListener(marker, 'dragend', function() {
	                	updateMarkerPosition( marker );
	                });
	            }
	        });
		}
		else
		{
			// dung 2 thong so map_lat va map_lng
			map.setCenter(realPosition);
	        marker = new google.maps.Marker({
	            map: map,
	            position: realPosition,
	            clickable: true,
	            mapTypeId: google.maps.MapTypeId.ROADMAP,
				draggable: true
            });
            
	        updateMarkerPosition( marker );
	        
            var infowindow = new google.maps.InfoWindow({
            	content: info
            });//end InfoWindow
            
            google.maps.event.addListener(marker, 'click', function() {            	
            	infowindow.open(map, marker);
			});//end infoWindow
			
            google.maps.event.addListener(marker, 'dragend', function() {
            	updateMarkerPosition( marker );
            });
		}
		//divfooter();
        /* add script for admin google map */
     }

function updateMap( address )
{
	//alert('update map');
	// get position by address
	// var currentPos = getPositionByAddress( address );
	
	if ( geocoder == null )
	{
		geocoder = new google.maps.Geocoder();
	}
	
	geocoder.geocode(
			{ 'address': address },
			function(results, status)
			{
		    	if (status == google.maps.GeocoderStatus.OK)
		        {
		        	var pos = results[0].geometry.location;
		        	map.setCenter(pos);

		        	if ( marker == null )
		        	{
		        		 marker = new google.maps.Marker({
			                    map: map,
			                    position: pos,			                    			                    
								draggable: true
			                });
		        	}
		        	
		        	marker.setPosition( pos );
		        	updateMarkerPosition( marker );
		        }
		    	else
		    	{
			    	//alert('<?php echo JText::_('ADDRESS_NOT_FOUND');?>');
		    	}
			});
}

function updateMarkerPosition( curMarker )
{
	//alert('update marker');
	document.getElementById("map_lat").value = curMarker.getPosition().lat();
	document.getElementById("map_lng").value = curMarker.getPosition().lng();
}
function updateCenterMap(mapobj, cur_marker)
{
	map.setCenter(marker.getPosition());
}

function createMap(divid,maplat,maplng,_zoom){
    var latlng = new google.maps.LatLng(maplat,maplng);
    var myOptions = {
      zoom: _zoom,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // var mapobj = new google.maps.Map(document.getElementById(divid),myOptions);   
    map = new google.maps.Map(document.getElementById(divid),myOptions);
    
    // add marker
    var markerobj = new google.maps.Marker({
        position: latlng, 
        //map: mapobj,
        map: map,
		draggable: true
    });
    google.maps.event.addListener(markerobj, 'dragend', function() {
    	//mapobj.setCenter(markerobj.getPosition());
    	map.setCenter(markerobj.getPosition());
    	updateMarkerPosition( markerobj );
    });
}
function renderMap(divid,maplat,maplng,_zoom){
    var latlng = new google.maps.LatLng(maplat,maplng);
    var myOptions = {
      zoom: _zoom,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapobj = new google.maps.Map(document.getElementById(divid),myOptions);   
    
    // add marker
    var markerobj = new google.maps.Marker({
        position: latlng, 
        map: mapobj		
    });
}
/*
 * end Google map v3
 */
function onChangeAddress()
{
	// confirm changed
	//if (confirm("Bạn có muốn cập nhật vị trí mới trên bản đồ"))
	//if (confirm("<?php echo JText::_('CONFIRM_UPDATE_MAP');?>"))
	//{
		// get new address
		var address = getAddress();
			
		// update marker & map
		updateMap( address);
//	}
}

/*
 * homepage la bien dua vao can set homepage. vidu : www.google.com
 */
function setHomepage(homepage)  
{    if (document.all)
	{
		document.body.style.behavior='url(#default#homepage)';     document.body.setHomePage(homepage);           
	}
	else if (window.sidebar)
	{       
		if(window.netscape)       
		{            
			try            
			{                 
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");              
			}
			catch(e)              
			{
				alert("this action was aviod by your browser,if you want to enable,please enter about:config in your address line,and change the value of signed.applets.codebase_principal_support to true");            
			}       
		} 
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch); 
		prefs.setCharPref('browser.startup.homepage',homepage);    
	}
}

/*
 * Lấy giá trị mới được thay đổi
 */
function getonchangevalue(value,idElement,unit,type)
{	
	// alert('getonchangvalue');
	if( type == 1) //type = 1: lay gia tri truc tiep
	{		
			document.getElementById(idElement).innerHTML= value+unit;
	}
	else
	{
		
		// alert(value);
		if ( document.getElementById(value).value == 0 )
		{
			change_value = "_";			
		}
		else
		{
			var changevalue = document.getElementById(value);
			if ( changevalue != null )
			{
				change_value = changevalue.options[changevalue.selectedIndex].text;
			}
		}
		
		document.getElementById(idElement).innerHTML= change_value+unit;
	}
}

/*
 * Đổi tiền
 */ 
function GetChangePrice(pricekind,vnprice,usdprice,sjcprice,dvdat,position)
{
//	var $donvidat = document.getElementById('dvdat').value;
	//alert(vnprice);
	switch(dvdat)
	{
	
		case "m<sup>2</sup>" : $donvidat="/m" + "<SUP class='money_sup'>" + "2"+ "</SUP> ";
		break;
		case "Nguyên căn" : $donvidat="";
		break;
		case "tháng" : $donvidat="/tháng";
		break;
		default: $donvidat="";
		break;					
	}			

	if( vnprice ==0 || usdprice==0 || sjcprice==0 )
	{		
		document.getElementById(position).innerHTML = "Thương lượng";
	}
	
	else if(pricekind=="1")
	{	
		document.getElementById(position).innerHTML = vnprice+$donvidat;
		document.getElementById("vnd_"+position).style.color  = "red";
		document.getElementById("usd_"+position).style.color  = "#004f8b";
		document.getElementById("sjc_"+position).style.color  = "#004f8b";
	}
	else if(pricekind=="2")
	{
		document.getElementById(position).innerHTML =usdprice+" "+"USD"+$donvidat;
		document.getElementById("vnd_"+position).style.color  = "#004f8b";
		document.getElementById("usd_"+position).style.color  = "red";
		document.getElementById("sjc_"+position).style.color  = "#004f8b";
	}
	else if(pricekind=="3")
	{
		document.getElementById(position).innerHTML = sjcprice+" "+"lượng"+$donvidat;
		document.getElementById("vnd_"+position).style.color  = "#004f8b";
		document.getElementById("usd_"+position).style.color  = "#004f8b";
		document.getElementById("sjc_"+position).style.color  = "red";
	}	
}

/*
 * Kiểm tra dữ liệu trong form đúng định dạng chưa
 */
function valid_dathangF(form)
{
	// var test=document.getElementById("userFail").value;
	 //alert('hehe: '+document.getElementById("userFail").value);
	var e = form.elements;
	/* Your validation code. */
	var check=true;
	var error="";

	if(e['name'].value == "" )
	{
		error +="*Tên không được rỗng\n\n"; 
		check = false;
	}
	
	if(e['address'].value == "" )
	{
		error +="*địa chỉ không được rỗng\n\n";
		check = false;
	}
	if(e['phone'].value == "" )
	{
		error +="*điện thoại nhập không được rỗng\n\n";
		check = false;
	}
	if(e['content'].value == "" )
	{
		error +="*Nội dung không được rỗng\n\n";
		check = false;
	}
	if(check == false)
	{
	alert(error);
	return false;
	}
	else
	{
		return true;
	}
}

/*
 * Tính tổng diện tích dựa trên chiều dài và chiều rộng
 */
function TinhTongDT(d,r,idElement)
{
	//alert('d:'+d+'- r:'+r);
	var dt=d*r;
	document.getElementById(idElement).innerHTML="<input id="+idElement+" type=\"text\" name="+idElement+" value="+dt+" class=\"numberbox\" size=\"7\" />";
}

/*
 * Ham nay dung de chec Hop Le cho form Dang ky thanh vien
 */

//hàm kiểm tra số điện thoại

//Declaring required variables

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}
function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
	var digits = "0123456789";
	var phoneNumberDelimiters = "()- ";
	// characters which are allowed in international phone numbers
	// (a leading + is OK)
	var validWorldPhoneChars = phoneNumberDelimiters + "+";
	// Minimum no of digits in an international phone no.
	var minDigitsInIPhoneNumber = 10;
	var bracket=3;
	strPhone=trim(strPhone);
	if(strPhone.indexOf("+")>1) 
		return false;
	if(strPhone.indexOf("-")!=-1)
		bracket=bracket+1;
	if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)
		return false;
	var brchr=strPhone.indexOf("(");
	if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")
		return false;
	if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)
		return false;
	s=stripCharsInBag(strPhone,validWorldPhoneChars);
	return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}


function Validate_String(string,opt, return_invalid_chars) {
	if(opt=='mail'){
	    valid_chars = '1234567890-_.abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}else if(opt='username'){
		valid_chars = '1234567890_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
	  invalid_chars = '';
	  if(string == null || string == '')
	     return(false);

	  //For every character on the string.   
	  for(index = 0; index < string.length; index++) {
	    char = string.substr(index, 1);                        
	     
	    //Is it a valid character?
	    if(valid_chars.indexOf(char) == -1) {
	      //If not, is it already on the list of invalid characters?
	      if(invalid_chars.indexOf(char) == -1) {
	        //If it's not, add it.
	        if(invalid_chars == '')
	          invalid_chars += char;
	        else
	          invalid_chars += ', ' + char;
	      }
	    }
	  }
	            
	  //If the string does not contain invalid characters, the function will return true.
	  //If it does, it will either return false or a list of the invalid characters used
	  //in the string, depending on the value of the second parameter.
	  if(return_invalid_chars == true && invalid_chars != '') {
	    last_comma = invalid_chars.lastIndexOf(',');
	    if(last_comma != -1)
	      invalid_chars = invalid_chars.substr(0, $last_comma) + 
	      ' and ' + invalid_chars.substr(last_comma + 1, invalid_chars.length);
	    return(invalid_chars);
	    }
	  else
	    return(invalid_chars == ''); 
}


	function validate_Email_Address(email_address){
	  // Modified and tested by Thai Cao Phong, JavaScriptBank.com
	  //Assumes that valid email addresses consist of user_name@domain.tld
	  
	  at = email_address.indexOf('@');
	  dot = email_address.indexOf('.');

	  if(at == -1 || 
	    dot == -1 || 
	    dot <= at + 1 ||
	    dot == 0 || 
	    dot == email_address.length - 1)
	  {
	  	//alert("Invalid email");
	    return(false);
	  }
	     
	  user_name = email_address.substr(0, at);
	  domain_name = email_address.substr(at + 1, email_address.length);                  
	  if(Validate_String(user_name,'mail') === false || Validate_String(domain_name,'mail') === false)
	  {
	  	//alert("Invalid email");
	    return(false);
	  }

	  //alert("Valid email");
	  return(true);
	}


function valid_regisF(form,task)
 {
	
	// var test=document.getElementById("userFail").value;
	 //alert('hehe: '+document.getElementById("userFail").value);
	var e = form.elements;
	/* Your validation code. */
	var check='true';
	var checkEmail = form.email.value;
	var err	= new Array();
	//kiem tra email hop lệ
	if(e['username'].value == "" )
	{
		err['username']='Tên đăng nhập không được rỗng';
		check = 'false';
	}
	else{
		if(e['userFail'].value == '1')
		{
			err['username']='Tên đăng nhập này đã được sử dụng';
			check = 'false';
		}
		else if(Validate_String(e['username'].value,'username')===false){
			alert('Tên đăng nhập không đúng định dạng');
			err['username']='Tên đăng nhập không đúng định dạng';
			form.username.style.borderColor="#FF0000";
			check = 'false';
		}
	}
	if(e['name'].value == "" )
	{
		err['name']='Tên người dùng không được rỗng';
		check = 'false';
	}
	if(e['password'].value == "" )
	{
		err['mk']='Mật khẩu không được rỗng';
		check = 'false';
	}
	else{
		if(e['password'].value != e['password2'].value) 
		{
			err['mk']='Mật khẩu không giống nhau';
			check = 'false';
		}		
	}
	//if(e['osolCatchaTxt'].value==""){
	//	alert("captcha rỗng!");
	//	return false;
	//}
	if (checkEmail == "")
	{
		err['email']='Email không được rỗng';
		check = 'false';
	}else{
		if(!validate_Email_Address(checkEmail)){
			err['email1']='Email không hợp lệ';
			check = 'false';
		}
		//err['email']='Email không hợp lệ';
		//alert('Email không hợp lệ');return false;
		//check = 'false';
	} 
	
	if(e['phone'].value == "" )
	{
		err['phone']='Số điện thoại không được rỗng';
		check = 'false';
	}
	else{ 
		
		if(!checkInternationalPhone(e['phone'].value)){
			err['phone1']='Số điện thoại không hợp lệ';
			check = 'false';
		}
	}
	
	if(check == 'false')
	{
		if(err['phone']!=null){
			//document.getElementById("msgErrPhone").innerHTML		=	err['phone'];
			form.phone.style.borderColor="#FF0000";
			form.phone.focus();
		}
		if(err['phone1']!=null){
			document.getElementById("msgErrPhone").innerHTML		=	err['phone1'];
			form.phone.style.borderColor="#FF0000";
			form.phone.focus();
		}
		if(err['email']!=null){
			//document.getElementById("msgErrEmail").innerHTML		=	err['email'];
			form.email.style.borderColor="#FF0000";
			form.email.focus();
		}
		if(err['email1']!=null){
			document.getElementById("msgErrEmail").innerHTML		=	err['email1'];
			form.email.style.borderColor="#FF0000";
			form.email.focus();
		}
		if(err['name']!=null){
			//document.getElementById("msgErrName").innerHTML			=	err['name'];
			form.name.style.borderColor="#FF0000";
			form.username.focus();
		}
		if(err['mk']!=null){
			//document.getElementById("msgPassword").innerHTML		=	err['mk'];
			form.password.style.borderColor="#FF0000";
			form.password.focus();
		}
		if(err['username']!=null){
			//document.getElementById("msgErrUsername").innerHTML		=	err['username'];
			form.username.style.borderColor="#FF0000";
			form.username.focus();
		}
		
		return false;
	}
	else 
	{
		if(e['tks'].value == '1' ){
			submitForm('Registered','0',0,task,'vi');
		}
		return true;
		//submitForm('<?php echo $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'2', '<?php echo $this->lang ?>')
	}
}

function submitForm( userlogin, userpro , published, re_link, lang)
{
	

	var form = document.adminForm;
	if ( validateForm( form ,lang ) )
	{	
		addinfo(lang);
		getDataLang( lang ); 
		form.hien_thi_ra_ngoai.value = published;
		//alert('22');
		if(form.dia_chi.value==''){
			alert('Vui lòng nhập địa chỉ');
			form.dia_chi.style.borderColor="#FF0000";
			form.dia_chi.focus();
			return false;
		}
		if(form.dien_tich_su_dung.value==''){
			alert('Vui lòng nhập diện tích sử dụng');
			form.dien_tich_su_dung.style.borderColor="#FF0000";
			form.dien_tich_su_dung.focus();
			return false;
		}
		if(Validate_Number(form.dien_tich_su_dung.value)===false){
			alert('Vui lòng nhập số diện tích sử dụng');
			form.dien_tich_su_dung.style.borderColor="#FF0000";
			form.dien_tich_su_dung.focus();
			return false;
		}
		if(userlogin==''||userlogin=='noregister'){
			if(form.name_vl.value==''){
				alert('Vui lòng nhập tên người liên hệ');
				form.name_vl.style.borderColor="#FF0000";
				form.name_vl.focus();
				return false;
			}
			if(form.phone_vl.value==''){
				alert('Vui lòng nhập số điện thoại liên hệ');
				form.phone_vl.style.borderColor="#FF0000";
				form.phone_vl.focus();
				return false;
			}
			if(form.email_vl.value==''){
				alert('Vui lòng nhập email người liên hệ');
				form.email_vl.style.borderColor="#FF0000";
				form.email_vl.focus();
				return false;
			}
			if(!validate_Email_Address(form.email_vl.value)){
				alert('Email người liên hệ không hợp lệ');
				form.email_vl.style.borderColor="#FF0000";
				form.email_vl.focus();
				return false;
			}
		}
		form.frmre_link.value = re_link;	
		if( published == 0 && userpro == 0  )
		{
			alert('Tin của bạn đã lưu thành công, nhưng phải đợi quản trị duyệt mới có thể hiển thị ra ngoài');
		}
		else
		{
			alert('Tin của bạn đã được lưu');
		}
		// return;
		form.submit();
		
	}
}

function getDataLogin(form,task){
	var e = form.elements;
	var username = e['username'].value;	
	var password = e['password'].value;	
	if(username == ''){
		alert("Vui lòng nhập tên đăng nhập");
		form.username.style.borderColor="#FF0000";
		form.username.focus();
		return;
	}
	if(password == ''){
		alert("Vui lòng nhập mật khẩu");
		form.password.style.borderColor="#FF0000";
		form.password.focus();
		return;
	}
	var address="checklogin.php?username=" + username + "&password=" + password;
	if(xmlHttp)
	{
		try
		{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
							var response = xmlHttp.responseText;
							if(response == ''){
								alert("Thông tin đăng nhập không chính sác hoặc tài khoản chưa tồn tại, bạn vui lòng kiểm tra lại!");
								form.username.style.borderColor="#FF0000";
								form.username.focus();
								return;
							}
							var data	 = response.split(',',6);
							var iduser	 =	data[0];
							var phone	 =	data[1];
							var address	 =	data[2];
							var email	 =	data[3];
							var usertype =	data[4];
							var name 	 =	data[5];
							document.getElementById('phone_vl').value = phone;
							document.getElementById('name_vl').value = name;
							document.getElementById('email_vl').value = email;
							document.getElementById('customer').value = iduser;
							var op = 0;
							if(usertype=='Administrator'||usertype=='Super Administrator') {
								op	=	1;
							}
							submitForm(usertype,op,op,task,'vi');
							
						}
						catch(e){
							alert("Error reading the response: " + e.toString());
						}
					}
				}
			}			
			xmlHttp.open("GET",address , true);
			xmlHttp.send(null);		
		}
		catch(e)
		{
			alert("Không thể try câp server: " + e.toString()); 
		}
	}
	
}

//Ham SetValues dung de check vao mang checkbox voi vi tri la iCheck
function SetValues(Form, CheckBox, Value,iCheck)
	{
	//alert("co check");
	    var objCheckBoxes = document.forms[Form].elements[CheckBox];
	    var countCheckBoxes = objCheckBoxes.length;
	   // for(var i = 0; i < countCheckBoxes; i++)
	        objCheckBoxes[iCheck].checked = Value; 
			document.forms[Form].submit();
	}

/**
 * Xu li tab hinh anh, ban do
 */

/*
 * Tạo tab
 */
function initTab( parentClass, idImage, idMap )
{
	//alert('init tab');
	var stretchers = document.getElementsByClassName(parentClass);
	var toggles = new Array();
	toggles[0] = document.getElementById(idImage);
	toggles[1] = document.getElementById(idMap);
	var myAccordion = new fx.Accordion(
		toggles, stretchers, {opacity: false, height: true, duration: 600}
	);
	var myAccordion = new fx.Accordion(
		toggles, stretchers,{ height: false,overflow:auto}
		);
	//hash functions
	var found = false;
	toggles.each(function(h3, i){
		var div = Element.find(h3, 'nextSibling');
			if (window.location.href.indexOf(h3.title) > 0) {
				myAccordion.showThisHideOpen(div);
				found = true;
			}
		});
		if (!found) myAccordion.showThisHideOpen(stretchers[0]);
		//alert('init tab7');
}

/*
 * Chuyen doi trang thai an hien giua 2 tab
 */
function changeStatusTabMap(id_active, id_inactive, classActive, classInactive)
{
	document.getElementById(id_active).className = classActive;
	document.getElementById(id_inactive).className = classInactive;
}

/*
 * End xu li tab hinh anh, ban do
 */

/*
 * Kiểm tra dữ liệu nhập trên form
 */
//function validateForm(form)
//{
//	var ms="";
//	var check=true;
//	//addinfo();
//	if ( form.ref.value == "" )
//	{
//		ms+= "<?php echo  JText::_('PROPERTY_MUST_HAVE_A_REFERENCE') ?>\n";
//		form.ref.style.borderColor="#FF0000";
//	 
//		form.ref.focus();
//		check= false;
//	}
//
//	if ( form.type_id.value == "0" ) {
//		 ms+= "<?php echo  JText::_('SELECT_A_TYPE_OF_PROPERTY')?> \n";
//		 form.type_id.style.borderColor="#FF0000";
//		form.type_id.focus();
//		check= false;
//	}
//	if ( form.town_id.value == "0" ) {
//		 ms+= "<?php echo  JText::_('SELECT_A_TOWN_OF_PROPERTY') ?> \n";
//		 form.town_id.style.borderColor="#FF0000";
//		form.town_id.focus();
//		check= false;
//	}
//
//	if(check==false)
//	{
//		alert(ms);
//		return false;
//	}
//	else
//	{
//	addinfo();
//	var form = document.forms['jeaForm'];
//	form.published.value = published;
//	form.re_link.value = re_link;
//	form.submit();
//	}
//}

function submitbutton_duan()
{	
	var form = document.adminForm;
	if ( form.name.value == "" )
		{	
			alert('Tên dự án không được để trống');
			form.name.style.borderColor="#FF0000";		 
			form.name.focus();		
			return;
		}
	
	getProjectDataLang('vi');
	document.adminForm.task.value='save';
	document.adminForm.submit();
}

function getDataLang_short(tmp)
{
	// tmp: luu tru gia tri ngon ngu hien tai
	var lang = document.getElementById('tmp').value;
	document.getElementById('tmp').value = tmp;
	var name = document.getElementById('ten').value;
	document.getElementById(lang+'_hidden_ten').value = name;
	
	// reset lai o textbox khi chuyen qua ngon ngu moi hoac lay lai gia tri khi quay tro ve
	var hidden_name = document.getElementById(tmp+'_hidden_ten').value;
	document.getElementById('ten').value = hidden_name;
	if ( tmp == 'vi' )
	{
		document.getElementById('changlabel').innerHTML = 'Giá trị';
	}
	else
	{
		document.getElementById('changlabel').innerHTML = 'value';
	}

}
function submitbutton(button)
{	
	document.adminForm.task.value= button;
	document.adminForm.submit();
}

function submitCancel(button)
{	
	document.adminForm.task.value= button;
	document.adminForm.submit();
}

function submitForm_backend(published,re_link, lang)
{
	//alert("language is: "+lang);
	//return;
	var form = document.adminForm;
	if ( validateForm( form ,lang) )
	{
		getDataLang( lang ); 
		form.published.value = published;
		form.frmre_link.value = re_link;
		document.adminForm.task.value='save';
		var ma_so=document.getElementById("properties_key").value;
		var id = document.getElementById("idobj").value;
		if(ma_so=='' || id > 0)
			form.submit();
		else{
			var path=document.getElementById("path").value;
			// var id=document.getElementById("idobj").value;
			path+="ajax_function.php?task=ktmaso&ma_so="+ma_so;
			if(id!=null && id!='')
				path+="&id="+id;
			loadXMLDoc(path,ktMaSo);
		}			
	}
}



function displayErrorMessage( messageId, messageArr )
{
	var tempMessage = "";
	for ( var i = 0; i<messageArr.length-1; i++ )
	{
		tempMessage += messageArr[i] + "<br/>";
	}
	tempMessage += messageArr[messageArr.length-1];
	
	document.getElementById(messageId).innerHTML = tempMessage;
	document.getElementById(messageId).style.display = "block";
	window.location.href="#error_message_id";
	
}
function numbersonly(myfield, e, dec) {
	  var key;
	  var keychar;
	  if (window.event)
	    key = window.event.keyCode;
	  else if (e)
	    key = e.which;
	  else
	    return true;
	  keychar = String.fromCharCode(key);
	  // control keys
	  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
	    return true;
	  // numbers
	  else if (((".0123456789").indexOf(keychar) > -1))
	    return true;

	  // decimal point jump
	  else if (dec && (keychar == ".")) {
	    myfield.form.elements[dec].focus();
	    return false;
	  } else
	    return false;
}
function Validate_Number(string,return_invalid_chars) {
	valid_chars = '1234567890';
	  invalid_chars = '';
	  if(string == null || string == '')
	     return(true);

	  //For every character on the string.   
	  for(index = 0; index < string.length; index++) {
	    char = string.substr(index, 1);                        
	     
	    //Is it a valid character?
	    if(valid_chars.indexOf(char) == -1) {
	      //If not, is it already on the list of invalid characters?
	      if(invalid_chars.indexOf(char) == -1) {
	        //If it's not, add it.
	        if(invalid_chars == '')
	          invalid_chars += char;
	        else
	          invalid_chars += ', ' + char;
	      }
	    }
	  }
	            
	  //If the string does not contain invalid characters, the function will return true.
	  //If it does, it will either return false or a list of the invalid characters used
	  //in the string, depending on the value of the second parameter.
	  if(return_invalid_chars == true && invalid_chars != '') {
	    last_comma = invalid_chars.lastIndexOf(',');
	    if(last_comma != -1)
	      invalid_chars = invalid_chars.substr(0, $last_comma) + 
	      ' and ' + invalid_chars.substr(last_comma + 1, invalid_chars.length);
	    return(invalid_chars);
	    }
	  else
	    return(invalid_chars == ''); 
}

function Validate_Price(string,return_invalid_chars) {
	valid_chars = ',1234567890';
	  invalid_chars = '';
	  if(string == null || string == '')
	     return(true);

	  //For every character on the string.   
	  for(index = 0; index < string.length; index++) {
	    char = string.substr(index, 1);                        
	     
	    //Is it a valid character?
	    if(valid_chars.indexOf(char) == -1) {
	      //If not, is it already on the list of invalid characters?
	      if(invalid_chars.indexOf(char) == -1) {
	        //If it's not, add it.
	        if(invalid_chars == '')
	          invalid_chars += char;
	        else
	          invalid_chars += ', ' + char;
	      }
	    }
	  }
	            
	  //If the string does not contain invalid characters, the function will return true.
	  //If it does, it will either return false or a list of the invalid characters used
	  //in the string, depending on the value of the second parameter.
	  if(return_invalid_chars == true && invalid_chars != '') {
	    last_comma = invalid_chars.lastIndexOf(',');
	    if(last_comma != -1)
	      invalid_chars = invalid_chars.substr(0, $last_comma) + 
	      ' and ' + invalid_chars.substr(last_comma + 1, invalid_chars.length);
	    return(invalid_chars);
	    }
	  else
	    return(invalid_chars == ''); 
}

function validateForm( form ,lang )
{
	var ms = new Array();
	var check='';
	
	var countMessage = 0;
	// check loi rao
	/*if ( form.ref.value == "" )
	{
		ms[countMessage] = 'Bạn phải nhập tiêu đề bất động sản';
		countMessage++;
		form.ref.style.borderColor="#FF0000";
		document.getElementById("tieude-error").innerHTML = ms;
		form.ref.focus();
		check= false;
	}*/

	// check loai tin dang
	if ( form.kind_id.value == "0" )
	{
		ms[countMessage] = 'Bạn phải chọn loại tin đăng';
		countMessage++;
		form.kind_id.style.borderColor="#FF0000";	 
		form.kind_id.focus();
		check= 'false';
	}
	
	// check loai bat dong san
	if ( form.type_id.value == "0" ) {
		ms[countMessage] = "<?php echo  JText::_('SELECT_A_TYPE_OF_PROPERTY')?>\n" ;
		countMessage++;
		form.type_id.style.borderColor="#FF0000";
		form.type_id.focus();
		check= 'false';
	}
	
	// check tinh thanh
	if ( form.town_id.value == "0" ) {
		ms[countMessage] = "<?php echo  JText::_('SELECT_A_TOWN_OF_PROPERTY') ?> \n";
		countMessage++;
		form.town_id.style.borderColor="#FF0000";
		form.town_id.focus();
		check= 'false';
	}

	// check quan huyen
	if ( form.area_id.value == "0" ) {
		ms[countMessage] = "Bạn phải chọn quận huyện";
		countMessage++;
		form.area_id.style.borderColor="#FF0000";
		form.area_id.focus();
		return false;
	}
	//check dien tich san
	if (Validate_Number(form.dien_tich_khuon_vien.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.dien_tich_khuon_vien.style.borderColor="#FF0000";
		form.dien_tich_khuon_vien.focus();
		return false;
	}
	//chieu rong
	if (Validate_Number(form.dien_tich_khuon_vien_rong.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.dien_tich_khuon_vien_rong.style.borderColor="#FF0000";
		form.dien_tich_khuon_vien_rong.focus();
		return false;
	}
	//chieu dai
	if (Validate_Number(form.dien_tich_khuon_vien_dai.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.dien_tich_khuon_vien_dai.style.borderColor="#FF0000";
		form.dien_tich_khuon_vien_dai.focus();
		return false;
	}
	//gia 
	if (Validate_Price(form.gia.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.gia.style.borderColor="#FF0000";
		form.gia.focus();
		return false;
	}
	//phong_ngu 
	if (Validate_Number(form.phong_ngu.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.phong_ngu.style.borderColor="#FF0000";
		form.phong_ngu.focus();
		return false;
	}
	//phong_khac 
	if (Validate_Number(form.phong_khac.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.phong_khac.style.borderColor="#FF0000";
		form.phong_khac.focus();
		return false;
	}
	//phong_khac 
	if (Validate_Number(form.phong_tam.value)===false){
		alert("Vui lòng nhập số");
		countMessage++;
		form.phong_tam.style.borderColor="#FF0000";
		form.phong_tam.focus();
		return false;
	}
	
	/* check gia
	if ( form.gia.value == "" && form.gia_thuong_luong.checked == false ) {
		ms[countMessage] = "Bạn phải nhập giá hoặc chọn thương lượng";
		countMessage++;
		form.gia.style.borderColor="#FF0000";
		form.gia.focus();
		check= false;
	}*/
	
	/* check dien thoai
	if ( form.phone_vl.value == "" )
	{
		ms[countMessage] = "Bạn phải nhập số điện thoại người liên hệ";
		countMessage++;
		form.phone_vl.style.borderColor="#FF0000";
		form.phone_vl.focus();
		document.getElementById("dienthoai-error").innerHTML = "Bạn phải nhập số điện thoại người liên hệ";
		check= false;
	}*/
	if(check=='false')
	{
		//alert(ms);return false;
	//	if ( document.getElementById("error_message_id") != null )
		//{
			//displayErrorMessage( "error_message_id", ms );
			return false;
	//	}
		return false;
	}
	//else
	//{
		getAdvantageValues('tien_ich[]', 'advantagesGetValue');
		var form = document.forms['jeaForm'];	
		return true;
	//}
}
function getAdvantageValues( currentCheckBox, hiddenId )
{	
	// alert(  hiddenId );
	var checkBoxList = document.getElementsByName(currentCheckBox);
	var Advantage = '';
	
	for( var i=0; i< checkBoxList.length; i++)
	{		
		if (checkBoxList[i].checked == true)
		{			
			Advantage += checkBoxList[i].value;
			Advantage += ',';
		}
	}	
	document.getElementById(hiddenId).value = Advantage;

	
}

function resetImage(subImageNumber)
{
// o fontend
	document.getElementById('main_image').value =''
	for ( var j=0;j < subImageNumber;j++ )
	{		
		document.getElementById('secondaries_images'+j).value =''
	}
}

/*
	Handle event when select main image, show main image, open new sub images for continuous upload
 */
function selectMainImage( ele )
{
	// hien thi hinh anh
	
//	alert( 'old src = ' + document.getElementById('main_image').src );
//	alert( 'new src = ' + ele.value );
//	document.getElementById('main_image').src = 'D:\\\\' + ele.value;
	
	// them cac sub image de upload
	
	
}

/*  kiem tra so  
EX: gia, dien tich, so dien thoai
*/
 function FormatNumber(str)
 {           
	            var strTemp = GetNumber(str);
	            if(strTemp.length <= 3)
		            return strTemp;
	            strResult = "";
	            for(var i =0; i< strTemp.length; i++)
		            strTemp = strTemp.replace(",", "");		        
		        var m=strTemp.lastIndexOf(".");
		       if(m==-1)
		       {    			  
	                for(var i = strTemp.length; i>=0; i--)
	                {
		                if(strResult.length >0 && (strTemp.length - i -1) % 3 == 0)
			                strResult = "," + strResult;			         
		                strResult = strTemp.substring(i, i + 1) + strResult;		                
	                }  
	           }
	           else
	           {	         
	                var strphannguyen=strTemp.substring(0,strTemp.lastIndexOf("."));
	                var strphanthapphan=strTemp.substring(strTemp.lastIndexOf("."),strTemp.length);	               
	                var tam=0;	               
	                for(var i = strphannguyen.length; i>=0; i--)
	                {
	                       if(strResult.length>0 && tam==4)
		                    {		                        
		                        strResult = "," + strResult;
		                        tam = 1;
		                    } 			                			         
		                strResult = strphannguyen.substring(i, i + 1) + strResult;
		                tam=tam+1;		                		                
	                }
	                strResult =strResult + strphanthapphan;
	           }	            
	            return strResult;
}

function GetNumber(str)
{
                var count = 0;
	            for(var i = 0; i < str.length; i++)
	            {	
		            var temp = str.substring(i, i + 1);		
		            if(!(temp == "," || temp == "." || (temp >= 0 && temp <=9)))
		            {
			            alert("Vui lòng nhập số từ 0 đến 9");
			            return str.substring(0, i);
		            }
		            if(temp == " ")
		                return str.substring(0, i);
		            if(temp == "." )
		            {
		                if(count > 0)
		                    return str.substring(0,i);
		                count ++;
		            }
	            }
	            return str;
}
            
function IsNumberInt_Phone(str)
{
	            for(var i = 0; i < str.length; i++)
	            {	
		            var temp = str.substring(i, i + 1);		
					 if(  !( temp == "," || temp == "." ||  temp == "-" || (temp >= 0 && temp <=9) ) )		       
		            {
			            alert("Vui lòng nhập số từ 0 đến 9");
			            return false;
			            //return str.substring(0, i);
		            }	
					return true;
	            }
	            
}
        

function doiNhapLieuDuongPho(checkbox){	
	var divtextbox=document.getElementById("duong_pho_text");
	var divselectbox=document.getElementById("duong_pho_select");
	var textbox=document.getElementById("vi_duong_pho_text");
	var selectbox=document.getElementById("duong_pho_id");
		
	if(checkbox.checked==true){
		divtextbox.style.display="";
		
		selectbox.options[0].selected=true;
		divselectbox.style.display="none";
		
	}else{
		divselectbox.style.display="";
		textbox.value="";
		
		divtextbox.style.display="none";		
	}
}

function doiNhapLieu(checkbox, value_display_none, id_display_none, value_display, id_display)
{	
	var divtextbox=document.getElementById(value_display);
	var divselectbox=document.getElementById(value_display_none);	
	var textbox=document.getElementById(id_display);
	var selectbox=document.getElementById(id_display_none);

	if(checkbox.checked==true)
	{
		divtextbox.style.display="";
		
		selectbox.options[0].selected=true;
		divselectbox.style.display="none";
	}else{
		divselectbox.style.display="";
		textbox.value="";
		
		divtextbox.style.display="none";		
	}
}

// update project map
function updateProjectMap()
{
	var projectAddress = document.getElementById('address').value;
	updateMap(projectAddress);
}
