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
function apaging_modJeaEmphasis(idElement,f,t,style,order_by,pc,tPage,measure,idKind)
{
	var idsKind="&idKind=";
	//alert(idKind.length);
	for(var i=0;i<idKind.length;i++)
	{
		if(i== (idKind.length-1))
			idsKind+=idKind[i];
		else
			idsKind+= idKind[i]+',';
	}
	var address="apaging.php?idPaging="+idElement+"&f="+f+"&t="+t+"&style="+style+"&order_by="+order_by+"&pc="+pc+"&tPage="+tPage+"&measure="+measure+idsKind;
//	alert(address);	
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
 


