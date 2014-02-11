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
 
// read a file from the server 
function process(address,Form, CheckBox, Value,iCheck) 
{ 
//alert(address);
  // only continue if xmlHttp isn't void 
  if (xmlHttp) 
  { 
    // try to connect to the server 
    try 
    { 
      // initiate reading a file from the server 
    //	document.write(imgid);
    	//location.href = "components/com_planes/ajax.planes.php";
    	 
    	// document.write(checkboxElement.value);
    	 var objCheckBoxes = document.forms[Form].elements[CheckBox];
	    //var countCheckBoxes = objCheckBoxes.length;
	   // for(var i = 0; i < countCheckBoxes; i++)
	        if(objCheckBoxes[iCheck].checked == Value)
			{
      		xmlHttp.open("GET", address, true); 
      		xmlHttp.onreadystatechange = handleRequestStateChange; 
      		xmlHttp.send(null); 
			}
    } 
    // display the error in case of failure 
    catch (e) 
    { 
      alert("Can't connect to server:\n" + e.toString()); 
    } 
  } 
} 
 
 
// function called when the state of the HTTP request changes 
function handleRequestStateChange()  
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
        handleServerResponse(); 
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
} 
 
// handles the response received from the server 
function handleServerResponse() 
{ 
  // read the message from the server 
//	var response = xmlHttp.responseText; 
	 //alert(xmlHttp.responseText);

  // iterate through the arrays and create an HTML structure 
  //var textField = document.getElementById("text01"); 
 // var test=document.getElementById("test");
//  test.innerHTML=response;
  // display the HTML output 
 // textField.value = response;
} 
 