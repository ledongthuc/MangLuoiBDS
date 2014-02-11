// holds an instance of XMLHttpRequest 
var xmlHttp = createXmlHttpRequestObject(); 
 
// creates an XMLHttpRequest instance 
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
 // HAM XU LY CHINH
 
 // Kiem tra username trong csdl

function setValue(name,name2){
	document.getElementById(name2).value = name;
}
function setCheckbox(name,name2){
	var checkbox = name;
    checkboxValue = checkbox.checked ? checkbox.value : '';
    if(checkboxValue=='on'){
    	document.getElementById(name2).checked = true;
    }else{
    	document.getElementById(name2).checked = false;
    }
}

 function KiemTraUsername(username,idElement)
 {
	 var address="kqusername.php?username=" + username;
 	if(xmlHttp)
	{
		try
		{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
							var response = xmlHttp.responseText;	
							document.getElementById(idElement).innerHTML = response;  	
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
 
 // test if 2 password entered are similar or not?
function KiemTra2MatKhau(pass,pass1,idElement)
{
	var address="kq2pass.php?pass="+pass+"&pass1="+pass1;
	if (xmlHttp) 
  	{
		 try
		 {
		 	xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
								var response = xmlHttp.responseText;	
								document.getElementById(idElement).innerHTML = response;  	
							}
						catch(e){
								alert("Error reading the response: " + e.toString());
						}	
					}
				}
			}			
		 	xmlHttp.open("GET", address, true); 
			xmlHttp.send(null); 
		 }
		 catch (e)
		 {
		 	alert("Can't connect to server:\n" + e.toString());  
		 }
	}
} 
function KiemTraEmail(email,idElement,baseurl)
{
	 var address = baseurl+"kqemail.php?email=" + email;
	if(xmlHttp)
	{
		try
		{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
							var response = xmlHttp.responseText;	
							document.getElementById(idElement).innerHTML = response;  	
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

 //
 function process(address,Form, CheckBox, Value,iCheck) 
{ 
  if (xmlHttp) 
  { 
    try 
    { 
    	var objCheckBoxes = document.forms[Form].elements[CheckBox];
	    if(objCheckBoxes[iCheck].checked == Value)
		{
      		 
      	//	xmlHttp.onreadystatechange = handleRequestStateChange; 
			xmlHttp.open("GET", address, true);
      		xmlHttp.send(null); 
		}
    } 
    catch (e) 
    { 
      alert("Can't connect to server:\n" + e.toString()); 
    } 
  } 
} 
// Ham nay dung de phan trang cho module jea_emphasis
/* function apaging_modJeaEmphasis(idElement,f,t,style,order_by,pc,tPage,measure)
{
	/*var idsKind="&idKind=";
	//alert(idKind.length);
	for(var i=0;i<idKind.length;i++)
	{
		if(i== (idKind.length-1))
			idsKind+=idKind[i];
		else
			idsKind+= idKind[i]+',';
	}
	//alert(idsKind);
	var address="apaging.php?f="+f+"&t="+t+"&style="+style+"&order_by="+order_by+"&pc="+pc+"&tPage="+tPage+"&measure="+measure;
//	alert(address);
	if (xmlHttp) 
  	{
		 try
		 {
		 	xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
								var response = xmlHttp.responseText;	
								document.getElementById(idElement).innerHTML = response;  	
							}
						catch(e){
								alert("Error reading the response: " + e.toString());
						}	
					}
				}
			}		
		 	xmlHttp.open("GET", address, true); 
			xmlHttp.send(null); 
		 }
		 catch (e)
		 {
		 	alert("Can't connect to server:\n" + e.toString());  
		 }
	}
	
}  */

 function getAjaxPagingContent( url, idElement, step )
 {
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
 	//alert(currentPage);
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
 	var ajaxPagingElement = document.getElementById( idAjaxPaging );
 	
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
 								/*ajaxPagingElement.innerHTML = document.getElementById( 
 										hiddenAjaxPaging ).innerHTML;*/
 								ajaxPagingElement.innerHTML=renderPaging(currentPage,totalPage,numdisplay,url,idElement);
 								
 								
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
 
 
function apaging_modJeaEmphasis(ItemidParam,l,idElement,t,style,order_by,tPage,measure,idKind)
{
	// Cac param can thiet
	// url, id parent element, 
	
	
//	hoan dang lam
//	alert(ItemidParam);
	var TotalPage = tPage;
	
	if(l==1)
	{
		
		var currenttab = document.getElementById('currentnext_'+idElement).value;	
		if(currenttab < TotalPage)
		{
		document.getElementById('loading_'+idElement).style.display ="block";
		var kq = parseInt(currenttab) + 1;
		document.getElementById('currentnext_'+idElement).value = kq;	
		document.getElementById('hienthitrang_'+idElement).innerHTML ="&nbsp;"+kq+"/"+TotalPage+" ";
		}
		else
		{
			var kq=currenttab;
		}
	}
	else
		if(l==0)
		{
			var currenttab = document.getElementById('currentnext_'+idElement).value;	
				
				if(currenttab > 1)
				{
				document.getElementById('loading_'+idElement).style.display ="block";
				var kq = parseInt(currenttab) - 1;
				document.getElementById('currentnext_'+idElement).value = kq;	
				document.getElementById('hienthitrang_'+idElement).innerHTML = "&nbsp;"+kq+"/"+TotalPage+" ";
				}
				else
				{
					var kq=currenttab;
				}
		}
	
	
	var idsKind="&idKind=";
//	alert(idKind.length);
	for(var i=0;i<idKind.length;i++)
	{
		if(i== (idKind.length-1))
			idsKind+=idKind[i];
		else
			idsKind+= idKind[i]+',';
	}
	var address="apaging.php?idPaging="+idElement+"&f="+kq+"&t="+t+"&style="+style+"&order_by="+order_by+"&tPage="+tPage+"&measure="+measure+"&idKind= "+idKind+"&itemid="+ItemidParam;
	//alert(address);	

	if (xmlHttp) 
	{ 
		// try to connect to the server 
		try 
		{	     
			xmlHttp.open("GET", address, true); 
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
							// do something with the response from the server 
							var response = xmlHttp.responseText; 	
							document.getElementById(idElement).innerHTML=response;; 
							document.getElementById('loading_'+idElement).style.display ="none";
							
						  } 
						  catch(e) 
						  { 
							// display error message 
							alert("Error reading the response: " + e.toString()); 
						  } 
						}  
						else 
						{ 
							// display status message 
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
		  alert("Can't connect to server:\n" + e.toString()); 
		} 
    }
}
/* phan trang BDS liên quan */
function bdsphantrang(keytown_id, keykind_id, keytype_id, keyprice, slht,
    				id, khoanggia, keyarea_id,TotalPage,l,idElement)
{
//	$divheight=document.getElementById("tranga").style.height;
//	document.getElementById("loading").style.right = "900px";
//	alert('vao');
	if(l==1)
	{

		
			var currenttab = document.getElementById('currentnext_'+id).value;	
			//alert(currenttab);
			if(currenttab < TotalPage)
			{
			document.getElementById("loading").style.display ="block";
			var kq = parseInt(currenttab) + 1;
			document.getElementById('currentnext_'+id).value = kq;	
			document.getElementById('hienthitrang_'+id).innerHTML ="&nbsp;"+kq+"/"+TotalPage+" ";
			
			}
			else
			{
				var kq=currenttab;
			}
	}
	else
		if(l==0)
		{

				var currenttab = document.getElementById('currentnext_'+id).value;	
				if(currenttab > 1)
				{
				document.getElementById("loading").style.display ="block";
				var kq = parseInt(currenttab) - 1;
				document.getElementById('currentnext_'+id).value = kq;	
				document.getElementById('hienthitrang_'+id).innerHTML ="&nbsp;"+kq+"/"+TotalPage+" ";
				}
				else
				{
					var kq=currenttab;
				}
		}
	
	var pt="bdslq.php?keytown_id="+keytown_id+"&keykind_id="+keykind_id+"&keytype_id="+keytype_id+"&keyprice="+keyprice+"&slht="+slht+"&id="+id+"&khoanggia="+khoanggia+"&keyarea_id="+keyarea_id+"&i="+kq+"";
	
//alert(pt);		
	if (xmlHttp) 
	{ 
		// try to connect to the server 
		try 
		{	     
			xmlHttp.open("GET",pt, true); 
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
							// do something with the response from the server 
							var response = xmlHttp.responseText; 	
							document.getElementById(idElement).innerHTML=response;
							document.getElementById("loading").style.display ="none";
							//alert(id);	
						  } 
						  catch(e) 
						  { 
							// display error message 
							alert("Error reading the response: " + e.toString()); 
						  } 
						}  
						else 
						{ 
							// display status message 
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
		  alert("Can't connect to server:\n" + e.toString()); 
		} 
    }	
   
}

function getCompoChangeLang_giahung(lang, fontend, area)
{	
	alert('vao getCompoChangeLang');
	var ch_kind_id = document.getElementById("kind_id").value;  		
	var ch_type_id = document.getElementById("type_id").value;
	// var ch_position = document.getElementById("position").value;  
	var ch_town_id = document.getElementById("town_id").value; 
	var ch_area_id = document.getElementById("area_id").value; 
	var ch_legal_status = document.getElementById("legal_status").value; 	
	var ch_direction_id = document.getElementById("direction_id").value; 
	var ch_price_area_unit = document.getElementById("price_area_unit").value;  
	var ch_advanges = document.getElementById('advantagesGetValue').value;
//	alert('quan');
	var ch_price_unit = document.getElementById("price_unit").value;  	
	var ch_tienicht = document.getElementById("advantagesGetValue").value;  	
//	alert(fontend);
	//alert('area');
	if( fontend == '2' ) // fontend=2 la tro duong dan den backend.
	{
	var address="../propertieschangelang.php?lang="+lang+"&ch_kind_id="+ch_kind_id+"&ch_type_id="+
				ch_type_id+"&ch_town_id="+ch_town_id+"&ch_area_id="+ch_area_id+
				"&ch_legal_status="+ch_legal_status+"&ch_direction_id="+ch_direction_id+"&Area="+area+"&fontend="+
				fontend+"&price_area_unit="+ch_price_area_unit+"&advantage="+ch_advanges+"&price_unit="+ch_price_unit+"&tienich="+ch_tienicht+"";
	}
	else
	{
	var address="propertieschangelang.php?lang="+lang+"&ch_kind_id="+ch_kind_id+"&ch_type_id="+
				ch_type_id+"&ch_town_id="+ch_town_id+"&ch_area_id="+ch_area_id+
				"&ch_legal_status="+ch_legal_status+"&ch_direction_id="+ch_direction_id+"&Area="+area+"&fontend="+
				fontend+"&price_area_unit="+ch_price_area_unit+"&advantage="+ch_advanges+"&price_unit="+ch_price_unit+"&tienich="+ch_tienicht+"";
	
	}				
	alert(address);
	if (xmlHttp) 
  	{
		 try
		 {
		 	xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
							try {			
									var response = xmlHttp.responseText;	
									var data = response.split("--||ABC||--");			
									//alert(data [6]);
									//document.getElementById("test").innerHTML = data [6];  	
									// document.getElementById("test").innerHTML = response;  					
								
								if ( area =='area')
								{							
									document.getElementById("quanhuyen").innerHTML = response;		
								}
								else
								{
									document.getElementById("aj_kinds").innerHTML = data [0];  									
									document.getElementById("aj_legal").innerHTML = data [1];
								//	document.getElementById("aj_position").innerHTML = data [2];  	
									document.getElementById("aj_directions").innerHTML = data [3];  
									document.getElementById("aj_unit").innerHTML = data [4];  	
									document.getElementById("aj_types").innerHTML = data [5];  
									document.getElementById("ja_town").innerHTML = data [6];  	
									document.getElementById("quanhuyen").innerHTML = data [7];  								
									document.getElementById("aj_priceunit").innerHTML = data [8];  	
									document.getElementById('SEO_CONFIG').innerHTML = data [9];  
									document.getElementById('SEO_PAGE_TITLE').innerHTML = data [10];  
									document.getElementById('SEO_PAGE_KEYWORDS').innerHTML = data [11];  
									document.getElementById('SEO_PAGE_DESCRIPTION').innerHTML = data [12]; 	
									document.getElementById('REF_SAVE').innerHTML = data [16];  
									document.getElementById('PICTURE').innerHTML = data [17];  
									document.getElementById('MAP').innerHTML = data [18];  
									document.getElementById('aj_MAIN_PROPERTY_PICTURE').innerHTML = data [19];  
									document.getElementById('aj_SECONDARIES').innerHTML = data [20];  
									document.getElementById('PROPERTIES_UNIT').innerHTML = data [21];  
									document.getElementById('ADDRESS').innerHTML = data [22];  
									document.getElementById('PRICE').innerHTML = data [23];  
									document.getElementById('aj_SITE_AREA').innerHTML = data [24];  
									document.getElementById('USE_AREA').innerHTML = data [25];  
									document.getElementById('ajt_legal').innerHTML = data [26];  
									document.getElementById('ajt2_legal').innerHTML = data [26];  
								//	document.getElementById('ajCONTACT').innerHTML = data [27];  
									document.getElementById('CONTACT_FULLNAME').innerHTML = data [28];  
									document.getElementById('CONTACT_ADDRESS').innerHTML = data [29];  								
									document.getElementById('CONTACT_PHONE').innerHTML = data [30];  
									document.getElementById('CONTACT_NOTE').innerHTML = data [31];  
								//	document.getElementById('DETAIL_INFO').innerHTML = data [32];  
								//	document.getElementById('STRUCTURE').innerHTML = data [33];  								
									document.getElementById('aj_ADVANTAGES').innerHTML = data [34];  
									document.getElementById('ajsBEDROOM').innerHTML = data [36];  
									document.getElementById('ajsBATHROOM').innerHTML = data [37];  
									document.getElementById('ajsORTHER_ROOM').innerHTML = data [38]; 
									
									document.getElementById('ajCLIEN_ROOM').innerHTML = data [35];  
									document.getElementById('ajBEDROOM').innerHTML = data [36];  
									document.getElementById('ajBATHROOM').innerHTML = data [37];  
									document.getElementById('ajORTHER_ROOM').innerHTML = data [38]; 
									
									document.getElementById('ajtDIRECTION').innerHTML = data [39];  
									document.getElementById('ajsTOTAL_AREA_USED').innerHTML = data [25];  
									document.getElementById('STREET').innerHTML = data [40];  
									document.getElementById('ajPROPERTIES_TYPE').innerHTML = data [41];  
									document.getElementById('ajDTKV').innerHTML = data [42];  
									document.getElementById('ajLENGTH').innerHTML = data [43];  
									document.getElementById('ajWIDTH').innerHTML = data [44];  
									document.getElementById('ajDTXD').innerHTML = data [45];  								
									document.getElementById('ajxLENGTH').innerHTML = data [43];  
									document.getElementById('ajxWIDTH').innerHTML = data [44];  								
									document.getElementById('ajUPDATE_MAP').innerHTML = data [49];  
									document.getElementById('ajbackend_ADVANTAGES').innerHTML = data [50];  
									document.getElementById('ja_TINH_THANH').innerHTML = data [51];  
									document.getElementById('ja_QUAN_HUYEN').innerHTML = data [52];  									
									document.getElementById('aj_LOAI_HINH_GIAO_DICH').innerHTML = data [53];  
									document.getElementById('aj_LOAI_BDS').innerHTML = data [54];  									
									document.getElementById('aj_C_D').innerHTML = data [55];  
									document.getElementById('aj_C_R').innerHTML = data [56];  									
									document.getElementById('aj_MO_TA').innerHTML = data [57];  
									document.getElementById('aj_CAU_TRUC').innerHTML = data [58];  
									
									
									
									// alert( document.getElementById('aj_C_D').innerHTML = data [55]);
									//document.getElementById('EMPHASIS').innerHTML = data [13];  										
									//document.getElementById('NEWSEST').innerHTML = data [14];  
									if( fontend == '2' )
									{
										document.getElementById('EMPHASIS').innerHTML = data [13];  										
										document.getElementById('NEWSEST').innerHTML = data [14];  								
										document.getElementById('PUBLISHED').innerHTML = data [15];  
									}
									else
									{
										document.getElementById('ajSAVE_REVIEW').innerHTML = data [46];  
										document.getElementById('ajSAVE_PUBLISHED').innerHTML = data [47];  
										document.getElementById('ajSAVE_DRAFT').innerHTML = data [48];  
									}
								}
							
							}
						catch(e){
								alert("Error reading the response: " + e.toString());
						}	
					}
				}
			}			
		 	xmlHttp.open("GET", address, true); 
			xmlHttp.send(null); 
		 }
		 catch (e)
		 {
		 	alert("Can't connect to server:\n" + e.toString());  
		 }
	}
} 

function getCompoChangeLang(lang, fontend, area)
{	
	// alert('fontend'+fontend);
	
	var ch_kind_id = document.getElementById("kind_id").value;  	
//	alert('1');
	var ch_type_id = document.getElementById("type_id").value;
///	alert('2');
	// var ch_position = document.getElementById("position").value;  
	var ch_town_id = document.getElementById("town_id").value; 
	// alert('3');
	var ch_area_id = document.getElementById("area_id").value; 
//	alert('4');
	var ch_legal_status = document.getElementById("legal_status").value; 
//	alert('5');
	var ch_direction_id = document.getElementById("direction_id").value; 
//	alert('6');
	var ch_price_area_unit = document.getElementById("price_area_unit").value;  
//	alert('7');
	var ch_advanges = document.getElementById('advantagesGetValue').value;
//	alert('8');
//	alert('quan');
	var ch_price_unit = document.getElementById("price_unit").value;  
//	alert('9');
	var ch_tienicht = document.getElementById("advantagesGetValue").value;  	
//	alert(fontend);
	//alert('area');
	if( fontend == '2' ) // fontend=2 la tro duong dan den backend.
	{
	var address="../propertieschangelang_vhl.php?lang="+lang+"&ch_kind_id="+ch_kind_id+"&ch_type_id="+
				ch_type_id+"&ch_town_id="+ch_town_id+"&ch_area_id="+ch_area_id+
				"&ch_legal_status="+ch_legal_status+"&ch_direction_id="+ch_direction_id+"&Area="+area+"&fontend="+
				fontend+"&price_area_unit="+ch_price_area_unit+"&advantage="+ch_advanges+"&price_unit="+ch_price_unit+"&tienich="+ch_tienicht+"";
	}
	else
	{
	var address="propertieschangelang_vhl.php?lang="+lang+"&ch_kind_id="+ch_kind_id+"&ch_type_id="+
				ch_type_id+"&ch_town_id="+ch_town_id+"&ch_area_id="+ch_area_id+
				"&ch_legal_status="+ch_legal_status+"&ch_direction_id="+ch_direction_id+"&Area="+area+"&fontend="+
				fontend+"&price_area_unit="+ch_price_area_unit+"&advantage="+ch_advanges+"&price_unit="+ch_price_unit+"&tienich="+ch_tienicht+"";
	
	}				
//	alert(address);
	if (xmlHttp) 
  	{
		 try
		 {
		 	xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
							try {			
									var response = xmlHttp.responseText;	
									var data = response.split("--||ABC||--");			
									//alert(data [6]);
									//document.getElementById("test").innerHTML = data [6];  	
									// document.getElementById("test").innerHTML = response;  					
								if ( area =='area')
								{							
									document.getElementById("quanhuyen").innerHTML = response;		
								}
								else
								{
									document.getElementById("aj_kinds").innerHTML = data [0];  									
									document.getElementById("aj_legal").innerHTML = data [1];
									// document.getElementById("aj_position").innerHTML = data [2];  	
									document.getElementById("aj_directions").innerHTML = data [3];  
									document.getElementById("aj_unit").innerHTML = data [4];  	
									document.getElementById("aj_types").innerHTML = data [5];  
									document.getElementById("ja_town").innerHTML = data [6];  	
									document.getElementById("quanhuyen").innerHTML = data [7];  								
									document.getElementById("aj_priceunit").innerHTML = data [8];  	
									document.getElementById('SEO_CONFIG').innerHTML = data [9];  
									document.getElementById('SEO_PAGE_TITLE').innerHTML = data [10];  
									document.getElementById('SEO_PAGE_KEYWORDS').innerHTML = data [11];  
									document.getElementById('SEO_PAGE_DESCRIPTION').innerHTML = data [12]; 	
									document.getElementById('REF_SAVE').innerHTML = data [16];  
									//document.getElementById('PICTURE').innerHTML = data [17];  
									//document.getElementById('MAP').innerHTML = data [18];  
									//document.getElementById('aj_MAIN_PROPERTY_PICTURE').innerHTML = data [19];  
									//document.getElementById('aj_SECONDARIES').innerHTML = data [20];  
									document.getElementById('PROPERTIES_UNIT').innerHTML = data [21];  
									document.getElementById('ADDRESS').innerHTML = data [22];  
									document.getElementById('PRICE').innerHTML = data [23];  
									document.getElementById('aj_SITE_AREA').innerHTML = data [24];  
									document.getElementById('USE_AREA').innerHTML = data [25];  
									document.getElementById('ajt_legal').innerHTML = data [26];  
									document.getElementById('ajt2_legal').innerHTML = data [26];  
									document.getElementById('ajCONTACT').innerHTML = data [27];  
									document.getElementById('CONTACT_FULLNAME').innerHTML = data [28];  
									document.getElementById('CONTACT_ADDRESS').innerHTML = data [29];  								
									document.getElementById('CONTACT_PHONE').innerHTML = data [30];  
									document.getElementById('CONTACT_NOTE').innerHTML = data [31];  
								//	document.getElementById('DETAIL_INFO').innerHTML = data [32];  
								//	document.getElementById('STRUCTURE').innerHTML = data [33];  								
									document.getElementById('aj_ADVANTAGES').innerHTML = data [34];  
									document.getElementById('ajsBEDROOM').innerHTML = data [36];  
									document.getElementById('ajsBATHROOM').innerHTML = data [37];  
									document.getElementById('ajsORTHER_ROOM').innerHTML = data [38]; 
									
									document.getElementById('ajCLIEN_ROOM').innerHTML = data [35];  
									document.getElementById('ajBEDROOM').innerHTML = data [36];  
									document.getElementById('ajBATHROOM').innerHTML = data [37];  
									document.getElementById('ajORTHER_ROOM').innerHTML = data [38]; 
									
									document.getElementById('ajtDIRECTION').innerHTML = data [39];  
									document.getElementById('ajsTOTAL_AREA_USED').innerHTML = data [25];  
									document.getElementById('STREET').innerHTML = data [40];  
									document.getElementById('ajPROPERTIES_TYPE').innerHTML = data [41];  
									document.getElementById('ajDTKV').innerHTML = data [42];  
								//	document.getElementById('ajLENGTH').innerHTML = data [43];  
								//	document.getElementById('ajWIDTH').innerHTML = data [44];  
									document.getElementById('ajDTXD').innerHTML = data [45];  								
								//	document.getElementById('ajxLENGTH').innerHTML = data [43];  
								//	document.getElementById('ajxWIDTH').innerHTML = data [44];  								
									document.getElementById('ajUPDATE_MAP').innerHTML = data [49];  
									document.getElementById('ajbackend_ADVANTAGES').innerHTML = data [50];  
									
									document.getElementById('ja_TINH_THANH').innerHTML = data [51];  
									document.getElementById('ja_QUAN_HUYEN').innerHTML = data [52];  									
									document.getElementById('aj_LOAI_HINH_GIAO_DICH').innerHTML = data [53];  
									document.getElementById('aj_LOAI_BDS').innerHTML = data [54];  									
									document.getElementById('aj_C_D').innerHTML = data [55];  
									document.getElementById('aj_C_R').innerHTML = data [56];  									
									document.getElementById('aj_MO_TA').innerHTML = data [57];  
									document.getElementById('aj_CAU_TRUC').innerHTML = data [58];
									//document.getElementById('aj_images_reset').innerHTML = data [60]; 
									
									if( fontend == '2' )
									{
										document.getElementById('EMPHASIS').innerHTML = data [13];  
										document.getElementById('NEWSEST').innerHTML = data [14];  								
										document.getElementById('PUBLISHED').innerHTML = data [15];  
									}
									else
									{
										document.getElementById('ajSAVE_REVIEW').innerHTML = data [46];  
										document.getElementById('ajSAVE_PUBLISHED').innerHTML = data [47];  
										document.getElementById('ajSAVE_DRAFT').innerHTML = data [48];  
									}
								}
							
							}
						catch(e){
								alert("Error reading the response: " + e.toString());
						}	
					}
				}
			}			
		 	xmlHttp.open("GET", address, true); 
			xmlHttp.send(null); 
		 }
		 catch (e)
		 {
		 	alert("Can't connect to server:\n" + e.toString());  
		 }
	}
} 

function getProjectLanguage(lang)
 {
//	alert(lang);
	var ch_type_id = document.getElementById("type_id").value;  
	var address="../projectchangelang.php?lang="+lang+"&type_id="+ch_type_id+"";
 	if(xmlHttp)
 	{
		try
		{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4)  { 
				    if (xmlHttp.status == 200) {
						try {
							var response = xmlHttp.responseText;	
							var data = response.split("--||ABC||--");
//							alert(lang);
							document.getElementById("aj_PROJECT_NAME").innerHTML = data [0];  
							document.getElementById("aj_ADRESS").innerHTML = data [13];  
							document.getElementById("aj_PROJECTGROUP").innerHTML = data [2];  
							document.getElementById("aj_START_DATE").innerHTML = data [3];  
							document.getElementById("aj_END_DATE").innerHTML = data [4];  
							document.getElementById("aj_INVESTOR").innerHTML = data [5];  
							// document.getElementById("aj_CONTACTNAME").innerHTML = data [16];  
							//document.getElementById("aj_CONTACTADDRESS").innerHTML = data [17];  
							//document.getElementById("aj_CONTACTPHONE").innerHTML = data [18];							
							document.getElementById("aj_INTRODUCE").innerHTML = data [6];  							
							document.getElementById("aj_SHORT_DESCRIPTION").innerHTML = data [19];  							
							document.getElementById("aj_DESCRIPTION").innerHTML = data [20];  						
							//document.getElementById("aj_CONTACTPHONE").innerHTML = data [18]; 							
							//document.getElementById("aj_PLANE_AREA").innerHTML = data [7];  
							// document.getElementById("aj_PICTURES").innerHTML = data [21];  
							//document.getElementById("aj_MAIN_PROPERTY_PICTURE").innerHTML = data [22];  							
						//	document.getElementById("aj_SECONDARIES_PROPERTY_PICTURES").innerHTML = data [32];  
							//document.getElementById("aj_SECONDARIES").innerHTML = data [11];  
							document.getElementById("aj_EMPHASISPROJ").innerHTML = data [25];  
							document.getElementById("aj_NEW_PROJECT").innerHTML = data [14];  
							document.getElementById("aj_PUBLISHED").innerHTML = data [31];  
							//document.getElementById("aj_SEO_CONFIG").innerHTML = data [27];  
						//	document.getElementById("aj_PAGE_TITLE").innerHTML = data [28];  							
						//	document.getElementById("aj_PAGE_KEYWORDS").innerHTML = data [29];  
						//	document.getElementById("aj_PAGE_DESCRIPTION").innerHTML = data [30];  							
						//	document.getElementById("aj_SEND").innerHTML = data [33];  
						//	document.getElementById("aj_SEND2").innerHTML = data [33];  
							document.getElementById("aj_type_id").innerHTML = data [34];  							
							document.getElementById("aj_OVERVIEW").innerHTML = data [1];  
							document.getElementById("aj_PLANE_AREA").innerHTML = data [7]; 
							document.getElementById("aj_PLANE_DIAGRAM").innerHTML = data [8]; 
							document.getElementById("aj_PROGRESS").innerHTML = data [9]; 
							document.getElementById("aj_PARTNERS").innerHTML = data [10]; 
							document.getElementById("aj_PAYMENT").innerHTML = data [12]; 
							document.getElementById("aj_CONTACTS").innerHTML = data [26]; 
							
							
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

function layseachquanhuyen(area_name,town_id,lang,path,targetId )
{
	if(lang==null){
		lang='vi-VN';
	}
	
	var address="quanhuyen.php?area_name="+area_name+"&town_id="+town_id+"&lang="+lang+"&dangtin=1";
	
	if(path!=null)
	{
		address=path+address+"&isadmin=1";
	}
	
	if ( targetId == null )
	{
		targetId = "quanhuyen";
	}
	
	//alert(xmlHttp.onreadystatechange);
	if(xmlHttp){
		try	{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)  { 
					try {
						document.getElementById(targetId).innerHTML = xmlHttp.responseText;
						if ( targetId == "quan_huyen_tkkv_id" )
						{
							// lay danh sach loai BDS
							//var currentQuanHuyenKVEle = document.getElementById("quan_huyen_tkkv_id");
							//var currentQuanHuyenId = currentQuanHuyenKVEle.options[currentQuanHuyenKVEle.selectedIndex].value;
							//layDanhSachLoaiBDS( currentQuanHuyenId, 'loai_bds_id', 'loai_bds_tkkv_id',lang,path)
						}
						else 
						{
							layDanhSachDuAn(0,lang,path);
						}
					}catch(e){
						alert("Error reading the response: " + e.toString());
					}
				}
			}			
			xmlHttp.open("GET",address , true);
			xmlHttp.send(null);
		}catch(e){
			alert("Không thể truy câp server: " + e.toString()); 
		}
	}
	
}

function layseachquanhuyenadmin(area_name,town_id,lang,path,targetId )
{
	if(lang==null){
		lang='vi-VN';
	}
	
	var address="quanhuyen.php?area_name="+area_name+"&town_id="+town_id+"&lang="+lang;
	
	if(path!=null)
	{
		address=path+address+"&isadmin=1";
	}
	
	if ( targetId == null )
	{
		targetId = "quanhuyen";
	}
	
	//alert(xmlHttp.onreadystatechange);
	if(xmlHttp){
		try	{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)  { 
					try {
						document.getElementById(targetId).innerHTML = xmlHttp.responseText;
					}catch(e){
						alert("Error reading the response: " + e.toString());
					}
				}
			}			
			xmlHttp.open("GET",address , true);
			xmlHttp.send(null);
		}catch(e){
			alert("Không thể truy câp server: " + e.toString()); 
		}
	}
	
}
function layseachquanhuyen1(area_name,town_id,lang,path,targetId )
{
	if(lang==null){
		lang='vi-VN';
	}
	
	var address="quanhuyen1.php?area_name="+area_name+"&town_id="+town_id+"&lang="+lang;
	
	if(path!=null)
	{
		address=path+address+"&isadmin=1";
	}
	
	if ( targetId == null )
	{
		targetId = "quanhuyen";
	}
	
	//alert(xmlHttp.onreadystatechange);
	if(xmlHttp){
		try	{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)  { 
					try {
						document.getElementById(targetId).innerHTML = xmlHttp.responseText;
						//setTimeout("multi",2000);
						multi();
						if ( targetId == "quan_huyen_tkkv_id" )
						{
							// lay danh sach loai BDS
							//var currentQuanHuyenKVEle = document.getElementById("quan_huyen_tkkv_id");
							//var currentQuanHuyenId = currentQuanHuyenKVEle.options[currentQuanHuyenKVEle.selectedIndex].value;
							//layDanhSachLoaiBDS( currentQuanHuyenId, 'loai_bds_id', 'loai_bds_tkkv_id',lang,path)
						}
						else 
						{
							layDanhSachDuAn1(0,lang,path);
						}
					}catch(e){
						alert("Error reading the response: " + e.toString());
					}
				}
			}			
			xmlHttp.open("GET",address , true);
			xmlHttp.send(null);
		}catch(e){
			alert("Không thể truy câp server: " + e.toString()); 
		}
	}
}

function layDanhSachPhuongXa( quanHuyenId,lang, path ){
	if(lang==null){
		lang='vi-VN';
	}
	var address="phuongxa.php?quan_huyen_id=" + quanHuyenId + "&lang="+lang;
	if(path!=null)
		address=path+address;	
	var ajax_phuongxa;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_phuongxa=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_phuongxa=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_phuongxa.onreadystatechange = function() {
			if (ajax_phuongxa.readyState == 4 && ajax_phuongxa.status == 200)  { 
				try {									
					document.getElementById('phuong_xa_select').innerHTML = ajax_phuongxa.responseText;					
					layDanhSachDuongPho( quanHuyenId,lang,path );
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_phuongxa.open("GET",address , true);
		ajax_phuongxa.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}
}

function layDanhSachDuAn( quanHuyenId, lang, path ){
	if(lang==null){
		lang='vi-VN';
	}
	
	var tinhThanhEle = document.getElementById("tinh_thanh_id");
	
	if ( tinhThanhEle == null )
	{
		tinhThanhEle = document.getElementById("town_id");
	}
	
	var tinhThanhId = tinhThanhEle.options[tinhThanhEle.selectedIndex].value;
	
	var address="duan.php?quan_huyen_id=" + quanHuyenId + "&tinh_thanh_id=" + tinhThanhId + "&lang="+lang+"&multi=2";
	if(path!=null)
		address=path+address;	
	var ajax_duan;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_duan=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_duan=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_duan.onreadystatechange = function() {
			if (ajax_duan.readyState == 4 && ajax_duan.status == 200)  { 
				try {		
					if(navigator.appVersion.indexOf("MSIE")!=-1){
						document.getElementById('duans').innerHTML = ajax_duan.responseText;
					}else{
						document.getElementById('du_an_id').innerHTML = ajax_duan.responseText;
						document.getElementById('select_search').innerHTML = ajax_duan.responseText;
					}
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_duan.open("GET",address , true);
		ajax_duan.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}
}

function layDanhSachDuAntk( quanHuyenId, lang, path ){
	if(lang==null){
		lang='vi-VN';
	}
	var tinhThanhEle = document.getElementById("tinh_thanh_id");
	
	if ( tinhThanhEle == null )
	{
		tinhThanhEle = document.getElementById("town_id");
	}
	var tinhThanhId = tinhThanhEle.options[tinhThanhEle.selectedIndex].value;
	var address="duan.php?quan_huyen_id=" + quanHuyenId + "&tinh_thanh_id=" + tinhThanhId + "&lang="+lang+"&multi=3";
	if(path!=null)
		address=path+address;	
	var ajax_duan;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_duan=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_duan=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_duan.onreadystatechange = function() {
			if (ajax_duan.readyState == 4 && ajax_duan.status == 200)  { 
				try {
					if(navigator.appVersion.indexOf("MSIE")!=-1){
						var rponse = "<select id='du_an_id' name='du_an_id' class='inputbox' style='width: 219px;padding: 2px;border: 1px solid #96A6C5;' >" + ajax_duan.responseText + "</select>"; 
						document.getElementById('duanie-taoyeucau').innerHTML = rponse;
					}else{
						document.getElementById('du_an_id').innerHTML = ajax_duan.responseText;
						document.getElementById('select_search').innerHTML = ajax_duan.responseText;
					}
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_duan.open("GET",address , true);
		ajax_duan.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}
}

function layDanhSachDuAn1( quanHuyenId, lang, path ){
	if(lang==null){
		lang='vi-VN';
	}
	if(quanHuyenId == ''){
		quanHuyenId = $("#quan_huyen_id").multiselect("getChecked").map(function(){
			   return this.value;	
		}).get();
	}
	
	var tinhThanhEle = document.getElementById("tinh_thanh_id");
	
	if ( tinhThanhEle == null )
	{
		tinhThanhEle = document.getElementById("town_id");
	}
	var tinhThanhId = tinhThanhEle.options[tinhThanhEle.selectedIndex].value;
	var address="duan.php?quan_huyen_id=" + quanHuyenId + "&tinh_thanh_id=" + tinhThanhId + "&lang="+lang+"&multi=1";
	if(path!=null)
		address=path+address;	
	var ajax_duan;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_duan=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_duan=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_duan.onreadystatechange = function() {
			if (ajax_duan.readyState == 4 && ajax_duan.status == 200)  { 
				try {
					if(navigator.appVersion.indexOf("MSIE")!=-1){
						var co = document.getElementById("coduantrongtaoyeucau").value;
						if(co == '1'){
							var rponse = "<select id='du_an_id' name='du_an_id' class='inputbox' style='width: 166px;padding: 2px;border: 1px solid #96A6C5;' >" + ajax_duan.responseText + "</select>";
						}else{
							var rponse = "<select id='du_an_id' name='du_an_id' class='inputbox' style='width: 219px;padding: 2px;border: 1px solid #96A6C5;' >" + ajax_duan.responseText + "</select>";
						}
						document.getElementById('duanie-taoyeucau').innerHTML = rponse;
					}else{
						document.getElementById('du_an_id').innerHTML = ajax_duan.responseText;
						document.getElementById('select_search').innerHTML = ajax_duan.responseText;
					}
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_duan.open("GET",address , true);
		ajax_duan.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}
}

function layDanhSachLoaiBDS( quanHuyenId, loaiBDSName, loaiBDSId, lang, path ){
	
	if(lang==null){
		lang='vi-VN';
	}
	
	//var currentQuanHuyenKVEle = document.getElementById("quan_huyen_tkkv_id");
	//var currentQuanHuyenId = currentQuanHuyenKVEle.options[currentQuanHuyenKVEle.selectedIndex].value;
	
	var address="loaibds.php?quan_huyen_id=" + quanHuyenId + "&tinh_thanh_id=" + currentTinhThanhTKKVId + "&lang="+lang 
			+ "loai_bds_name=" + loaiBDSName + "loai_bds_id" + loaiBDSId;
	if(path!=null)
		address=path+address;	
	var ajax_loaibds;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_loaibds=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_loaibds=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_loaibds.onreadystatechange = function() {
			if (ajax_loaibds.readyState == 4 && ajax_loaibds.status == 200)  { 
				try {			
					document.getElementById('loai_bds_tkkv_id').innerHTML = ajax_loaibds.responseText;	
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_loaibds.open("GET",address , true);
		ajax_loaibds.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}
}

function layDanhSachDienTich(price_area_unit,kind_id,lang,path,targetId  ){
	if(lang==null){
		lang='vi-VN';
	}
	
	var address="don_vi_dien_tich.php?kind_id="+kind_id;
	
	if(path!=null)
	{
		address=path+address;
	}
	
	if ( targetId == null )
	{
		targetId = "price_area_unit";
	}
	
	//alert(xmlHttp.onreadystatechange);
	if(xmlHttp){
		try	{
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)  { 
					try {	
						document.getElementById(targetId).innerHTML = xmlHttp.responseText;
						//layDanhSachPhuongXa(0,lang,path);		
					}catch(e){
						alert("Error reading the response: " + e.toString());
					}
				}
			}			
			xmlHttp.open("GET",address , true);
			xmlHttp.send(null);
		}catch(e){
			alert("Không thể truy câp server: " + e.toString()); 
		}
	}
}

function layDanhSachDuongPho( quanHuyenId,lang, path){
	if(lang==null){
		lang='vi-VN';
	}
	var address="duongpho.php?quan_huyen_id=" + quanHuyenId + "&lang="+lang;
	if(path!=null)
		address=path+address;
	var ajax_duongpho;
	try{		
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax_duongpho=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
			ajax_duongpho=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}catch(e){
		alert("Không thể truy câp server: " + e.toString());
		return;
	}	
	try{
		ajax_duongpho.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200)  { 
				try {												
					document.getElementById('duong_pho_select').innerHTML = ajax_duongpho.responseText; 							
				}
				catch(e){
					alert("Error reading the response: " + e.toString());
				}
			}
		}			
		ajax_duongpho.open("GET",address , true);
		ajax_duongpho.send(null);		
	}
	catch(e){
		alert("Không thể truy câp server: " + e.toString()); 
		return;
	}
}
function ChangeTitle(str) {  
	  str= str.toLowerCase();  
	  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
	  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
	  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
	  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
	  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
	  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
	  str= str.replace(/đ/g,"d");  
	  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); 
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
	  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
	  str= str.replace(/^\-+|\-+$/g,"");  
	//cắt bỏ ký tự - ở đầu và cuối chuỗi  
	return str;
}   

