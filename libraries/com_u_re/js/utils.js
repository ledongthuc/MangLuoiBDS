function changeOrdering( param )
{
	var form = document.getElementById('jForm');
	form.filter_order.value = param;
	form.submit();
}

/*
 * Chức năng swap image dùng trong trang chi tiết bất động sản, dự án
 */
function swapImage( imageElementId, img_preview_url){

	document.getElementById(imageElementId).src = img_preview_url;
}

/** 
 * Google map area - Start
 * Các hàm phục vụ cho chức năng google map
 * Google map version 3
 */

/*
 * Hiển thị bản đồ 
 */
function showMap( mapHolderId, mapLat, mapLng, info, mapZoom )
{
	var options = {
		zoom: mapZoom,
		disableDefaultUI:true,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		//panControl:true,
		zoomControl: true
	};
	
	var map = new google.maps.Map(document.getElementById(mapHolderId), options);
	var realPosition = new google.maps.LatLng(mapLat, mapLng);
	
	map.setCenter(realPosition);
	var marker = new google.maps.Marker({
		map: map,
		position: realPosition,
		clickable: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow({
		content: info
	});
	
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker)
	});
}
function showMapPopUp( mapHolderId, mapLat, mapLng, info, mapZoom )
{
	var options = {
		zoom: mapZoom,
		disableDefaultUI:true,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		overviewMapControl: true,
		panControl:true,
		zoomControl: true
	};
	
	var map = new google.maps.Map(document.getElementById(mapHolderId), options);
	var realPosition = new google.maps.LatLng(mapLat, mapLng);
	
	map.setCenter(realPosition);
	var marker = new google.maps.Marker({
		map: map,
		position: realPosition,
		clickable: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow({
		content: info
	});
	
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker)
	});
}

/**
 * Google map area - End
 */

function submitbutton( pressbutton, section )
{
	// alert('vao333');
	var form = document.adminForm;
	//alert(pressbutton);
	if (pressbutton == 'apply' || pressbutton == 'save')
	{
		//alert('save');
		if ( form.name.value == "" )
		{
			alert( "<?php echo JText::_('PLAN_MUST_HAVE_A_NAME') ?>" );
			return;
		}
		//else if ( form.project_group_ids.length == "0" ) {
			//alert( "<?php echo JText::_('Select a group of plan') ?>" );
			//return;
		//}
	}
	//alert('tren submit');
	// getDataLang('vi'); /*truyen tham so Vi vao ko co cong dung gi het, chi de cho function hop le*/
	
	getProjectDataLang('vi');
//	alert('duoi submit');
	submitform(pressbutton);
	return;
}
/*
function getDataLang(tmp)
{
	//alert(tmp);
	// tmp: luu tru gia tri ngon ngu hien tai
	var lang = document.getElementById('tmp').value;
	document.getElementById('tmp').value = tmp;
	
	var jsloai_du_an = document.getElementById("type_id");
	if ( jsloai_du_an != 0 )
	{
		loai_du_an_value = jsloai_du_an.options[jsloai_du_an.selectedIndex].text;
	}
	document.getElementById(lang+'_loai_du_an').value = loai_du_an_value;

	alert('1');

	var name = document.getElementById('name').value;
	document.getElementById(lang+'_hidden_name').value = name;
	alert('1c');
	var address = document.getElementById('address').value;
	document.getElementById(lang+'_hidden_address').value = address;
	alert('1b');
	var description = document.getElementById('description_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_description').value = description;
	alert('1a');
	//* la tat tam
	//* var short_description = document.getElementById('short_description_ifr').contentWindow.document.body.innerHTML;
	//* document.getElementById(lang+'_hidden_short_description').value = short_description;

	alert('2');
	var investor = document.getElementById('investor').value;
	document.getElementById(lang+'_hidden_investor').value = investor;
	alert('3');
	//var implement_unit = document.getElementById('implement_unit').value;
//	document.getElementById(lang+'_hidden_implement_unit').value = implement_unit;
	
	//var management_unit = document.getElementById('management_unit').value;
//	document.getElementById(lang+'_hidden_management_unit').value = management_unit;
	
	//var design_unit = document.getElementById('design_unit').value;
	//	document.getElementById(lang+'_hidden_design_unit').value = design_unit;
		
//	var scheme = document.getElementById('scheme').value;
	//	document.getElementById(lang+'_hidden_scheme').value = scheme;
		
	var plain_diagram = document.getElementById('plain_diagram_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_plain_diagram').value = plain_diagram;
	alert('4');
	var progress = document.getElementById('progress_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_progress').value = progress;
	alert('5');			
	var contacts = document.getElementById('contacts_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_contacts').value = contacts;
	alert('6');
	var partners = document.getElementById('partners_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_partners').value = partners;
	alert('7');
	//* var contact_address = document.getElementById('contact_address').value;
	//* document.getElementById(lang+'_hidden_contact_address').value = contact_address;
	alert('8');
	var contact_name = document.getElementById('contact_name').value;
	document.getElementById(lang+'_hidden_contact_name').value = contact_name;
	alert('9');
	var payment = document.getElementById('payment_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_payment').value = payment;
	alert('10');
	var page_title = document.getElementById('page_title').value;
	document.getElementById(lang+'_hidden_page_title').value = page_title;
	alert('11');
	var page_keywords = document.getElementById('page_keywords').value;
	document.getElementById(lang+'_hidden_page_keywords').value = page_keywords;

	var page_description = document.getElementById('page_description').value;
	document.getElementById(lang+'_hidden_page_description').value = page_description;
	
	// reset lai o textbox khi chuyen qua ngon ngu moi hoac lay lai gia tri khi quay tro ve
	var hidden_name = document.getElementById(tmp+'_hidden_name').value;
	document.getElementById('name').value = hidden_name;
	
	var hidden_address = document.getElementById(tmp+'_hidden_address').value;
	document.getElementById('address').value = hidden_address;
	
	var hidden_description = document.getElementById(tmp+'_hidden_description').value;
	document.getElementById('description_ifr').contentWindow.document.body.innerHTML = hidden_description
	
	var short_description = document.getElementById(tmp+'_hidden_short_description').value;
	document.getElementById('short_description_ifr').contentWindow.document.body.innerHTML = short_description

	var hidden_investor = document.getElementById(tmp+'_hidden_investor').value;
	document.getElementById('investor').value = hidden_investor;
	
	var plain_diagram = document.getElementById(tmp+'_hidden_plain_diagram').value;
	document.getElementById('plain_diagram_ifr').contentWindow.document.body.innerHTML = plain_diagram

	var progress = document.getElementById(tmp+'_hidden_progress').value;
	document.getElementById('progress_ifr').contentWindow.document.body.innerHTML = progress

	var contacts = document.getElementById(tmp+'_hidden_contacts').value;
	document.getElementById('contacts_ifr').contentWindow.document.body.innerHTML = contacts;
	
	var partners = document.getElementById(tmp+'_hidden_partners').value;
	document.getElementById('partners_ifr').contentWindow.document.body.innerHTML = partners;
	
	var contact_address = document.getElementById(tmp+'_hidden_contact_address').value;
	document.getElementById('contact_address').value = contact_address;
	
	var contact_name = document.getElementById(tmp+'_hidden_contact_name').value;
	document.getElementById('contact_name').value = contact_name;
	
	var payment = document.getElementById(tmp+'_hidden_payment').value;
	document.getElementById('payment_ifr').contentWindow.document.body.innerHTML = payment;

	var hidden_page_title = document.getElementById(tmp+'_hidden_page_title').value;
	document.getElementById('page_title').value = hidden_page_title;
	
	var hidden_page_keywords = document.getElementById(tmp+'_hidden_page_keywords').value;
	document.getElementById('page_keywords').value = hidden_page_keywords;
	
	var hidden_page_description = document.getElementById(tmp+'_hidden_page_description').value;
	document.getElementById('page_description').value = hidden_page_description;
	alert('4545');
}
*/

function getProjectDataLang(tmp)
{
	 //alert('tmp');
	// tmp: luu tru gia tri ngon ngu hien tai
	//var lang = document.getElementById('tmp').value;
	//document.getElementById('tmp').value = tmp;

	//var jsloai_du_an = document.getElementById("type_id");
	//if ( jsloai_du_an != 0 )
	//{
	//	loai_du_an_value = jsloai_du_an.options[jsloai_du_an.selectedIndex].text;
	//}
	/*
	document.getElementById(lang+'_loai_du_an').value = loai_du_an_value;

	var name = document.getElementById('name').value;
	document.getElementById(lang+'_hidden_name').value = name;
	
	var hidden_name = document.getElementById(tmp+'_hidden_name').value;
	document.getElementById('name').value = hidden_name;
	
	var address = document.getElementById('address').value;
	document.getElementById(lang+'_hidden_address').value = address;
	
	var hidden_address = document.getElementById(tmp+'_hidden_address').value;
	document.getElementById('address').value = hidden_address;
	
	/*var short_description = document.getElementById('short_description_ifr').contentWindow.document.body.innerHTML;
	var short_description = document.getElementById('short_description').value;
	document.getElementById(lang+'_hidden_short_description').value = short_description;

	var short_description = document.getElementById(tmp+'_hidden_short_description').value;
	// document.getElementById('short_description_ifr').contentWindow.document.body.innerHTML = short_description
	document.getElementById('short_description').value = short_description
	
	var description = document.getElementById('description_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_description').value = description;
		
	var hidden_description = document.getElementById(tmp+'_hidden_description').value;
	document.getElementById('description_ifr').contentWindow.document.body.innerHTML = hidden_description
	
	var investor = document.getElementById('investor').value;
	document.getElementById(lang+'_hidden_investor').value = investor;
	var hidden_investor = document.getElementById(tmp+'_hidden_investor').value;
	document.getElementById('investor').value = hidden_investor;
	
	//var implement_unit = document.getElementById('implement_unit').value;
//	document.getElementById(lang+'_hidden_implement_unit').value = implement_unit;
	
	//var management_unit = document.getElementById('management_unit').value;
//	document.getElementById(lang+'_hidden_management_unit').value = management_unit;
	
	//var design_unit = document.getElementById('design_unit').value;
	//	document.getElementById(lang+'_hidden_design_unit').value = design_unit;
		
//	var scheme = document.getElementById('scheme').value;
	//	document.getElementById(lang+'_hidden_scheme').value = scheme;
		
	var plain_diagram = document.getElementById('plain_diagram_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_plain_diagram').value = plain_diagram;	
	var plain_diagram = document.getElementById(tmp+'_hidden_plain_diagram').value;
	document.getElementById('plain_diagram_ifr').contentWindow.document.body.innerHTML = plain_diagram
	
	

	var progress = document.getElementById('progress_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_progress').value = progress;
	var progress = document.getElementById(tmp+'_hidden_progress').value;
	document.getElementById('progress_ifr').contentWindow.document.body.innerHTML = progress
	
	
	var contacts = document.getElementById('contacts_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_contacts').value = contacts;
	var contacts = document.getElementById(tmp+'_hidden_contacts').value;
	document.getElementById('contacts_ifr').contentWindow.document.body.innerHTML = contacts;
	
	var partners = document.getElementById('partners_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_partners').value = partners;
	var partners = document.getElementById(tmp+'_hidden_partners').value;
	document.getElementById('partners_ifr').contentWindow.document.body.innerHTML = partners;
	
	
	//var contact_address = document.getElementById('contact_address').value;
	//document.getElementById(lang+'_hidden_contact_address').value = contact_address;
	
	//var contact_name = document.getElementById('contact_name').value;
	//document.getElementById(lang+'_hidden_contact_name').value = contact_name;
	
	/*var payment = document.getElementById('payment_ifr').contentWindow.document.body.innerHTML;
	document.getElementById(lang+'_hidden_payment').value = payment;
	var payment = document.getElementById(tmp+'_hidden_payment').value;
	document.getElementById('payment_ifr').contentWindow.document.body.innerHTML = payment;
	
	
	var plane_area = document.getElementById('plane_area_ifr').contentWindow.document.body.innerHTML;
	document.getElementById('vi_plane_area').value = plane_area;
	
	//var page_title = document.getElementById('page_title').value;
	//document.getElementById(lang+'_hidden_page_title').value = page_title;

	//var page_keywords = document.getElementById('page_keywords').value;
	//document.getElementById(lang+'_hidden_page_keywords').value = page_keywords;

	//var page_description = document.getElementById('page_description').value;
	//document.getElementById(lang+'_hidden_page_description').value = page_description;
	
	// reset lai o textbox khi chuyen qua ngon ngu moi hoac lay lai gia tri khi quay tro ve
//	var hidden_name = document.getElementById(tmp+'_hidden_name').value;
	//document.getElementById('name').value = hidden_name;
	
//	var hidden_address = document.getElementById(tmp+'_hidden_address').value;
///	document.getElementById('address').value = hidden_address;
	
//	var hidden_description = document.getElementById(tmp+'_hidden_description').value;
//	document.getElementById('description_ifr').contentWindow.document.body.innerHTML = hidden_description
	
	//var short_description = document.getElementById(tmp+'_hidden_short_description').value;
//	document.getElementById('short_description_ifr').contentWindow.document.body.innerHTML = short_description



	
//	var contact_address = document.getElementById(tmp+'_hidden_contact_address').value;
//	document.getElementById('contact_address').value = contact_address;
	
//	var contact_name = document.getElementById(tmp+'_hidden_contact_name').value;
//	document.getElementById('contact_name').value = contact_name;
	


	/*
	var hidden_page_title = document.getElementById(tmp+'_hidden_page_title').value;
	document.getElementById('page_title').value = hidden_page_title;
	
	var hidden_page_keywords = document.getElementById(tmp+'_hidden_page_keywords').value;
	document.getElementById('page_keywords').value = hidden_page_keywords;
	
	var hidden_page_description = document.getElementById(tmp+'_hidden_page_description').value;
	document.getElementById('page_description').value = hidden_page_description;
	*/
}

/*
 * Đổi trạng thái hiển thị của tab hình ảnh và bản đồ
 */
function changeStatusTabMap(id_active, id_inactive, classActive, classInactive)
{
	document.getElementById(id_active).className = classActive;
	document.getElementById(id_inactive).className = classInactive;
}

/*
 *doi tab ui re 
 */

 
function changeStatusTab(id_inactive)
{
	var curr = document.getElementById('tab_current').value ;
	document.getElementById('tab_current').value = id_inactive;
	document.getElementById(curr).className = "tab_inactive";
	document.getElementById(id_inactive).className = "tab_active";
	// alert(id_inactive);
}


 /*
 * Tạo 2 tab hình ảnh và  bản đồ
 */
function initTab( parentClass, idImage, idMap )
{
	var stretchers = document.getElementsByClassName(parentClass);
	var toggles = new Array();
	toggles[0] = document.getElementById(idImage);
	toggles[1] = document.getElementById(idMap);
	var myAccordion = new fx.Accordion(
		toggles, stretchers, {opacity: false, height: true, duration: 600}
	);
	//hash functions
//	var found = false;
//	toggles.each(function(h3, i){
//		var div = Element.find(h3, 'nextSibling');
//			if (window.location.href.indexOf(h3.title) > 0) {
//				myAccordion.showThisHideOpen(div);
//				found = true;
//			}
//		});
	myAccordion.showThisHideOpen(stretchers[0]);
}
function testb()
{
alert('vllss');	
}

/*
 * Đổi tiền
 */
function changePrice( price, priceId, priceUnit, activeStyle, donvidientichid, inactiveStyle)
{
	 //alert( price );
	var dvdt;
	if ( donvidientichid == 1 )
	{
		dvdt = '/m'+'2'.sup();
	}
	else if ( donvidientichid == 2 )
	{
		dvdt = '';
	}
	else
	{
		dvdt = '/tháng';
	}
	if ( price <= 0 )
	{
		document.getElementById("price" + priceId).innerHTML = "Thương lượng";
	}
	else
	{
		var dau = '';
		if ( dvdt != "")
		{dau = '/';	}
			
		if( priceUnit=="VND" )
		{	
			document.getElementById("price" + priceId).innerHTML = price+dvdt;
			document.getElementById("VND" + priceId).className = activeStyle;
			document.getElementById("USD" + priceId).className = inactiveStyle;
			document.getElementById("SJC" + priceId).className = inactiveStyle;
		}
		else if( priceUnit=="USD" )
		{
			document.getElementById("price" + priceId).innerHTML = price+" USD"+dvdt;
			document.getElementById("VND" + priceId).className = inactiveStyle;
			document.getElementById("USD" + priceId).className = activeStyle;
			document.getElementById("SJC" + priceId).className = inactiveStyle;
		}
		else if( priceUnit=="SJC" )
		{
			document.getElementById("price" + priceId).innerHTML = price+" lượng"+dvdt;
			document.getElementById("VND" + priceId).className = inactiveStyle;
			document.getElementById("USD" + priceId).className = inactiveStyle;
			document.getElementById("SJC" + priceId).className = activeStyle;
		}	
	}
}

/*
 * Ajax paging
 */
function getAjaxPagingContent( url, idElement, step )
{
	if ( currentAjaxPagingElement == '' )
	{
		currentAjaxPagingElement = idElement;
	}
	else 
	{
		// ajax paging dang hoat dong
		return false;
	}
	
	var currentPage = parseInt( document.getElementById( 'current_page_' + idElement).innerHTML );
	var totalPage = parseInt( document.getElementById( 'total_page_' + idElement).innerHTML );
	
	currentPage += step;
	if ( currentPage > totalPage )
	{
		currentPage = totalPage;
	}
	if ( currentPage < 1 )
	{
		currentPage = 1;
	}
		
	document.getElementById( 'current_page_' + idElement).innerHTML = currentPage.toString();

	var xmlHttp = createXmlHttpRequestObject();
	
	var contentElement = document.getElementById( idElement );
	var idAjaxPaging = 'ajax_paging_' + idElement;
	hiddenAjaxPaging = 'hidden_ajax_paging_' + idElement;
	var ajaxPagingElement = document.getElementById( idAjaxPaging );
	var hiddenAjaxPagingElement = document.getElementById( hiddenAjaxPaging );

	hiddenAjaxPagingElement.innerHTML = ajaxPagingElement.innerHTML;

	// hien thi hinh loading trong thoi gian cho
	var loadingImage = document.getElementById('loading_'+idElement);
	if ( loadingImage != null )
	{
		loadingImage.style.display ="block";
	}
	
	if (xmlHttp) 
	{ 
		// try to connect to the server 
		try 
		{	     
			url += '&page=' + currentPage;
			xmlHttp.open("GET", url, true); 
			xmlHttp.onreadystatechange = function()  
			{ 
				// when readyState is 4, we are ready to read the server response 
				if (xmlHttp.readyState == 4)  
					{ 
						// continue only if HTTP status is "OK" 
						if (xmlHttp.status == 200)  
						{ 
							try 
							{ 
								// lay gia tri tren server 
								var response = xmlHttp.responseText;
								document.getElementById( idElement ).innerHTML=response;
								ajaxPagingElement = document.getElementById( idAjaxPaging );
								ajaxPagingElement.innerHTML = document.getElementById( 
										hiddenAjaxPaging ).innerHTML;
								
								hiddenAjaxPagingElement.innerHTML = '';
								
								// tat bieu tuong loading
								if ( loadingImage != null )
								loadingImage.style.display ="none";
								
								// tra lai trang thai o khong cho current ajax paging
								currentAjaxPagingElement = '';
							} 
							catch(e) 
							{ 
								// TODO:  
								alert("Error reading the response: " + e.toString()); 
							} 
						}  
						else 
						{ 
							// TODO: Thay dong bao loi bang dinh nghia trong file language 
							alert("There was a problem retrieving the data:\n" +  
							xmlHttp.statusText); 
						} 
				} 
			} ; 
			xmlHttp.send(null); 			
		} 
		// display the error in case of failure 
		catch (e) 
		{
			// TODO: Thay dong bao loi bang dinh nghia trong file language
			alert("Can't connect to server:\n" + e.toString()); 
		} 
    }
}

function getAjaxPaging(currentPage,totalPage,numdisplay ,url, idElement)
{
	if ( currentPage > totalPage )
	{
		currentPage = totalPage;
	}
	if ( currentPage < 1 )
	{
		currentPage = 1;
	}
	
	var xmlHttp = createXmlHttpRequestObject();
	
	var contentElement = document.getElementById( idElement );
	var idAjaxPaging = 'ajax_paging_' + idElement;	
	var idAjaxPagingbt = 'ajax_paging_bt_' + idElement;
	// hien thi hinh loading trong thoi gian cho
	var loadingImage = document.getElementById('loading_'+idElement);
	if ( loadingImage != null )
	{
		loadingImage.style.display ="block";
	}
	
	if (xmlHttp) 
	{ 
		// try to connect to the server 
		try 
		{	     
			url += '&page=' + currentPage;
			xmlHttp.open("POST", url, true); 
			
			xmlHttp.onreadystatechange = function()  
			{ 
				// when readyState is 4, we are ready to read the server response 
				if (xmlHttp.readyState == 4)  
					{ 
						// continue only if HTTP status is "OK" 
						if (xmlHttp.status == 200)  
						{ 
							try 
							{ 
								// lay gia tri tren server 
								var response = xmlHttp.responseText;
								//alert(response);
								document.getElementById( idElement ).innerHTML=response;
								ajaxPagingElement = document.getElementById( idAjaxPaging );
								ajaxPagingElementbt = document.getElementById( idAjaxPagingbt );
								ajaxPagingElement.innerHTML=renderPaging(currentPage,totalPage,numdisplay,url,idElement);
								ajaxPagingElementbt.innerHTML=renderPaging(currentPage,totalPage,numdisplay,url,idElement);
								
								// tat bieu tuong loading
								if ( loadingImage != null )
								loadingImage.style.display ="none";
							} 
							catch(e) 
							{ 
								// TODO:  
								alert("Error reading the response: " + e.toString()); 
							} 
						}  
						else 
						{ 
							// TODO: Thay dong bao loi bang dinh nghia trong file language 
							alert("There was a problem retrieving the data:\n" +  
							xmlHttp.statusText); 
						} 
				} 
			} ; 
			xmlHttp.send(null); 			
		} 
		// display the error in case of failure 
		catch (e) 
		{
			// TODO: Thay dong bao loi bang dinh nghia trong file language
			alert("Can't connect to server:\n" + e.toString()); 
		} 
    }
}

function renderPaging(currpage,totalpage,numdisplay,url,mod_element)
{
    var paging="",next="",pre="";

    var pos_start,pos_end;

    var anchorPage = 'paging' +mod_element;
    
    if(numdisplay>=totalpage)
    {
        pos_start=1;
        pos_end=totalpage;
    }
    else
    {
    	
    	var half=parseInt(numdisplay/2);
        if(currpage<=half)
        {
            pos_start=1;
        }
        else
        {
        	if(currpage+half>totalpage){
        		pos_start=totalpage-numdisplay+1;
        	}else{
        		pos_start=currpage-half+1;
        	}
                        
        }
        pos_end=numdisplay;
    }
    if(currpage-1>0)
    {
        pre="<a style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging("+(currpage-1)+","+totalpage+","+numdisplay+",'"+url+"', '"+mod_element+"')\"  class='pre'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";
    }
    if(currpage+1<=totalpage)
    {
        next="<a style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging( "+(currpage+1)+","+totalpage+","+numdisplay+",'"+url+"', '"+mod_element+"')\" class='next'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";
    }
    for(var i=0;i<pos_end;i++)
    {
        if(i!=0)
        {
            paging+="&nbsp;";
        }
        if(pos_start==currpage)
        {
            paging+="<strong class='current'>&nbsp;"+pos_start+"&nbsp;</strong>";
        }
        else
        {
			paging+="<a class='page_next' style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging( "+pos_start+","+totalpage+","+numdisplay+",'"+url+"', '"+mod_element+"')\">&nbsp;"+pos_start+"&nbsp;</a>";
		}
        pos_start++;
    }

    paging=pre+paging+next;
    return paging;
}

function createXmlHttpRequestObject()  
{ 
  // will store the reference to the XMLHttpRequest object 
  var xmlHttp; 
  // this should work for all browsers except IE6 and older 
  try 
  { 
    // try to create XMLHttpRequest object 
    xmlHttp = new XMLHttpRequest(); 
  } 
  catch(e) 
  { 
    // assume IE6 or older 
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0", 
                                    "MSXML2.XMLHTTP.5.0", 
                                    "MSXML2.XMLHTTP.4.0", 
                                    "MSXML2.XMLHTTP.3.0", 
                                    "MSXML2.XMLHTTP", 
                                    "Microsoft.XMLHTTP"); 
    // try every prog id until one works 
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)  
    { 
      try  
      {  
        // try to create XMLHttpRequest object 
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]); 
      }  
      catch (e) {} 
    } 
  } 
  // return the created object or display an error message 
  if (!xmlHttp) 
    alert("Error creating the XMLHttpRequest object."); 
  else  
    return xmlHttp; 
} 

/* thay the paramer url */
/* link: duong dan url, paramvalue: gia tri truyen vao vd: 'itemid=10'; */
function getURLParameter(link, paramvalue)
{	
	var searchString = window.location.search.substring(1);
	var params = searchString.split("&");				  
	var paramName = paramvalue.split("=");
	var i, val ;
	
		for (i=0;i<params.length;i++)
		{
			val = params[i].split("=");
			if (val[0] == paramName[0])
			{				
			   return link.replace(params[i], paramvalue);					
			}
			
		}
	return link+"&"+paramvalue;
}

function redirect(cat)
{	
	var CatValue=document.getElementById(cat).value;
	var getCatvalue = 'catDirect='+CatValue ;			
	var baselink = document.URL ;
	var link = getURLParameter(baselink, getCatvalue);	
	window.open(link,'_self');		
}

function RadioTypeId(type_id)
{
	var TypeIdValue=document.getElementById('type_id_'+type_id).value;
	var getTypeIdValue = 'type_id='+TypeIdValue ;	
	var baselink = document.URL ;
	var link = getURLParameter(baselink, getTypeIdValue);	
	window.open(link,'_self');
}

function RadioKindId(type_id)
{
	var TypeIdValue;
	TypeIdValue=document.getElementById('kind_id_'+type_id).value;
	var getTypeIdValue = 'kind_id='+TypeIdValue ;	
	var baselink = document.URL ;
	var link = getURLParameter(baselink, getTypeIdValue);	
	window.open(link,'_self');
}


function HtlmLink(area,townid)
{
	var getarea_id = 'area_id='+area ;
	var gettown_id = 'town_id='+townid ;			
	var baselink = document.URL ;
	var link = getURLParameter(baselink, getarea_id);	
	var link1 = getURLParameter(link, gettown_id);		
	window.open(link1,'_self');
}

function PriceLink(gia, id)
{		
	document.getElementById(id).style.color = 'red';				
	var gia_arr = gia.split(";");
	var gia_tu = gia_arr[0];
	var gia_den = gia_arr[1];	
	var getgia_tu = 'gia_tu='+gia_tu ;
	var getgia_den = 'gia_den='+gia_den ;			
	var baselink = document.URL ;
	var link = getURLParameter(baselink, getgia_tu);	
	var link1 = getURLParameter(link, getgia_den);		
	var getstyle = 'style='+id ;	
	var link2 = getURLParameter(link1, getstyle );					
	window.open(link2,'_self');
	
}

/* tinh thanh */
function town_change( town_id )
{	 
	var gettown_id = 'town_id='+town_id ;			
	var baselink = document.URL ;			
	var link = getURLParameter(baselink, gettown_id);			
	var link1 = getURLParameter(link, 'area_id=0');	
	window.open(link1,'_self');
	
}

function init()
{
	var stretchers = document.getElementsByClassName('box');
	var toggles = new Array();
	toggles[0] = document.getElementById('tab_OVERVIEW');
	toggles[1] = document.getElementById('tab_PLANE_AREA');
	toggles[2] = document.getElementById('tab_PLANE_DIAGRAM');
	toggles[3] = document.getElementById('tab_PROGRESS');
	toggles[4] = document.getElementById('tab_PARTNERS');
	toggles[5] = document.getElementById('tab_PAYMENT');
	toggles[6] = document.getElementById('tab_CONTACTS');

	var myAccordion = new fx.Accordion(
		toggles, stretchers, {opacity: false, height: true, duration: 600}
	);
	//hash functions
	var found = false;
	
	/*
	toggles.each(function(h3, i)
	{
		alert('2');
		var div = Element.find(h3, 'nextSibling');
			if (window.location.href.indexOf(h3.title) > 0) 
			{
				myAccordion.showThisHideOpen(div);
				found = true;
			}
	}
	);
	*/
		if (!found) myAccordion.showThisHideOpen(stretchers[0]);
}



function reNameUrlLanguage( lang )
{	
	var parame = 'lang='+lang;
	var baselink = document.URL;
	var link = getURLParameterDelete(baselink, parame);	
	window.open(link,'_self');
}

function getURLParameterDelete(link, paramvalue)
{	
	var searchString = window.location.search.substring(1);
	var params = searchString.split("&");		
	var paramName = paramvalue.split("=");
	var i, val, moc, mocduoi;
	(link.indexOf('&')==-1)? moc ='?' : moc ='&';
	(link.indexOf('?')==-1)? mocduoi ='?' : mocduoi ='&';
	
		for (i=0;i<params.length;i++)
		{
			val = params[i].split("=");
			if (val[0] == paramName[0])
			{	
				var paramdelete = moc+params[i];
				var deletelink = link.replace( paramdelete,'');
				return 	deletelink+moc+paramvalue;		
			}
		}
	if ( link.indexOf('index.php')==-1)
    {
		return link+"index.php?"+paramvalue;
    }
	else
	{
		return link+mocduoi+paramvalue;
	}
}


