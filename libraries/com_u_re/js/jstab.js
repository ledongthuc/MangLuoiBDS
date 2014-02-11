var mastertabvar=new Object()
mastertabvar.baseopacity=0
mastertabvar.browserdetect=""
var mastertabheader=new Object()

function detectBrowser()
{
	var dataBrowser = [
	          		{
	        			string: navigator.userAgent,
	        			subString: "Chrome",
	        			identity: "Chrome"
	        		},
	        		{ 	string: navigator.userAgent,
	        			subString: "OmniWeb",
	        			versionSearch: "OmniWeb/",
	        			identity: "OmniWeb"
	        		},
	        		{
	        			string: navigator.vendor,
	        			subString: "Apple",
	        			identity: "Safari",
	        			versionSearch: "Version"
	        		},
	        		{
	        			prop: window.opera,
	        			identity: "Opera",
	        			versionSearch: "Version"
	        		},
	        		{
	        			string: navigator.vendor,
	        			subString: "iCab",
	        			identity: "iCab"
	        		},
	        		{
	        			string: navigator.vendor,
	        			subString: "KDE",
	        			identity: "Konqueror"
	        		},
	        		{
	        			string: navigator.userAgent,
	        			subString: "Firefox",
	        			identity: "mozilla"
	        		},
	        		{
	        			string: navigator.vendor,
	        			subString: "Camino",
	        			identity: "Camino"
	        		},
	        		{		// for newer Netscapes (6+)
	        			string: navigator.userAgent,
	        			subString: "Netscape",
	        			identity: "Netscape"
	        		},
	        		{
	        			string: navigator.userAgent,
	        			subString: "MSIE",
	        			identity: "ie",
	        			versionSearch: "MSIE"
	        		},
	        		{
	        			string: navigator.userAgent,
	        			subString: "Gecko",
	        			identity: "Mozilla",
	        			versionSearch: "rv"
	        		},
	        		{ 		// for older Netscapes (4-)
	        			string: navigator.userAgent,
	        			subString: "Mozilla",
	        			identity: "Netscape",
	        			versionSearch: "Mozilla"
	        		}
	        	];
	
	for (var i=0;i<dataBrowser.length;i++)	{
		var dataString = dataBrowser[i].string;
		var dataProp = dataBrowser[i].prop;
		this.versionSearchString = dataBrowser[i].versionSearch || dataBrowser[i].identity;
		if (dataString) {
			if (dataString.indexOf(dataBrowser[i].subString) != -1)
				return dataBrowser[i].identity;
		}
		else if (dataProp)
			return dataBrowser[i].identity;
	}
}

mastertabvar.browserdetect = detectBrowser();

function showsubmenu(obj,masterid, id){
	if (typeof highlighting!="undefined")
		clearInterval(highlighting)
	submenuobject=document.getElementById(id)
	//mastertabvar.browserdetect=submenuobject.filters? "ie" : typeof submenuobject.style.MozOpacity=="string"? "mozilla" : ""
	hidesubmenus(mastertabvar[masterid])
	chooseactivetab(obj,masterid)
	submenuobject.style.display="block"
	submenuobject.style.visibility="visible"
	submenuobject.style.height="auto"
	instantset(mastertabvar.baseopacity)
	highlighting=setInterval("gradualfade(submenuobject)",50)
}

function distancetag()
{
	
}

function hidesubmenus(submenuarray){
	for (var i=0; i<submenuarray.length; i++){
		document.getElementById(submenuarray[i]).style.display="none"
	}
}

function chooseactivetab(obj,masterid){
	listtabheader=mastertabheader[masterid]
	if (mastertabvar.browserdetect=="mozilla" || mastertabvar.browserdetect=="Chrome" ){
		for (var i=0; i<listtabheader.length; i++){
			listtabheader[i].className="tab_inactive"
		}
		obj.className="tab_active"
	}else if (mastertabvar.browserdetect=="ie"){
		for (var i=0; i<listtabheader.length; i++){
			listtabheader[i].setAttribute("class","tab_inactive")
		}
		obj.setAttribute("class","tab_active")
	}
}

function instantset(degree){
	if (mastertabvar.browserdetect=="mozilla")
		submenuobject.style.MozOpacity=degree/100;
		
	else if (mastertabvar.browserdetect=="ie")
	{
		//submenuobject.filters.alpha.opacity=degree
		submenuobject.style.opacity = degree;
		submenuobject.style.filter = "alpha(opacity=" + degree + ")";
	}
		
}


function gradualfade(cur2){
	if (mastertabvar.browserdetect=="mozilla" && cur2.style.MozOpacity<1)
		cur2.style.MozOpacity=Math.min(parseFloat(cur2.style.MozOpacity)+0.1, 0.99)
	else if (mastertabvar.browserdetect=="ie" && cur2.filters.alpha.opacity<100)
	{
			cur2.style.opacity += 10;
			//cur2.filters.alpha.opacity+=10
			cur2.style.filter = "alpha(opacity=" + cur2.style.opacity + ")";
	}	
	else if (typeof highlighting!="undefined") //fading animation over
		clearInterval(highlighting)
}

function initalizetab(tabid){
	mastertabvar[tabid]=new Array();
	mastertabheader[tabid]=new Array();
	if ( document.getElementById(tabid) != null)
	{
		var menuitems=document.getElementById(tabid).getElementsByTagName("li");
	
		for (var i=0; i<menuitems.length; i++){
			if (menuitems[i].getAttribute("rel")){
				menuitems[i].setAttribute("rev", tabid) //associate this submenu with main tab
				mastertabvar[tabid][mastertabvar[tabid].length]=menuitems[i].getAttribute("rel") //store ids of submenus of tab menu
				mastertabheader[tabid][mastertabheader[tabid].length]=menuitems[i].getElementsByTagName("span")[0]
				/*menuitems[i].getElementsByTagName("span")[0].onmouseover=function(){
					showsubmenu(this.parentNode.getAttribute("rev"), this.parentNode.getAttribute("rel"))*/
				menuitems[i].getElementsByTagName("span")[0].onclick=function(){
					showsubmenu(this,this.parentNode.getAttribute("rev"), this.parentNode.getAttribute("rel"))
				}
			}
		}
	}
}