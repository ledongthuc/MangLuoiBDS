<?php 
	defined('_JEXEC') or die('Restricted access');
	$speed =$getconfig['speed'];
	$arrimg = explode  ('##',$getproimg);
	$arrtitletext = explode  ('##',$getprovalueTitle['value']);
	$imglink = explode  ('##',$getprovalueTitle['link']);
	$newvalue = explode  ('##',$getnew['title']);

?>

<script language="javascript" type="text/javascript" >
var SLIDE_text = ["<?php echo join("\",\"", $arrtitletext); ?>"];
var SLIDE_pic =  ["<?php echo join("\",\"", $arrimg); ?>"];
var SLIDE_imglink =  ["<?php echo join("\",\"", $imglink); ?>"];
var SLIDE_load = new Array();
var SLIDE_status, SLIDE_timeout;
var SLIDE_actual = 1;
var SLIDE_speed = <?php echo $speed ?>;
var SLIDE_fade = 2;

for (i = 0; i <= SLIDE_text.length-1; i++)
{
  SLIDE_load[i] = new Image();
  SLIDE_load[i].src = SLIDE_pic[i];
}

var SLIDE_count = SLIDE_pic.length-1;

function SLIDE_play()
{
	document.getElementById('next').style.display = 'block';
	document.getElementById('next0').style.display = 'none';
	document.getElementById('back').style.display = 'block';
	document.getElementById('back0').style.display = 'none';
	document.getElementById('imgplay').style.display = 'none';
	document.getElementById('imgpause').style.display = 'block';
  	SLIDE_actual++;
 	SLIDE_slide();
 	SLIDE_status = 'SLIDE_play';
 	SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}

function SLIDE_pause()
{
	
	document.getElementById('imgplay').style.display = 'block';	
	document.getElementById('imgpause').style.display = 'none';
 	clearTimeout(SLIDE_timeout);
 	SLIDE_status = 'SLIDE_pause';
}

function SLIDE_back()
{

	document.getElementById('back').style.display = 'none';
	document.getElementById('back0').style.display = 'block';
	document.getElementById('next0').style.display = 'none';
	document.getElementById('next').style.display = 'block';
	clearTimeout(SLIDE_timeout);
	SLIDE_actual--;
	SLIDE_slide();  
	SLIDE_pause();
  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}

function SLIDE_forward()
{
	document.getElementById('back').style.display = 'block';
	document.getElementById('back0').style.display = 'none';
	document.getElementById('next').style.display = 'none';
	document.getElementById('next0').style.display = 'block';
	clearTimeout(SLIDE_timeout);
	SLIDE_actual++;
	SLIDE_slide();
	SLIDE_pause();
  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}

function SLIDE_slide()
{
  if (SLIDE_actual > (SLIDE_count)) SLIDE_actual=1;
  if (SLIDE_actual < 1) SLIDE_actual = SLIDE_count;
  if (document.all)
  {
    document.getElementById("SLIDE_textBox").style.background = "transparent";
    document.images.SLIDE_picBox.style.filter="blendTrans(duration=2)";
    document.images.SLIDE_picBox.style.filter="blendTrans(duration=SLIDE_fade)";
    document.images.SLIDE_picBox.filters.blendTrans.Apply();
  }
  document.images.SLIDE_picBox.src = SLIDE_load[SLIDE_actual].src;
  
  document.getElementById('imglink').href = 'index.php?option=com_jea&controller=projects&task=view'+SLIDE_imglink[SLIDE_actual];
//alert(n);
  if (document.getElementById) document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
  if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
}
</script>
<table width='100%'>
	<tr>	
	    <td rowspan="3" class='emphasis' width='1%' valign="top" rowspan="2">
		    <div class='div_project'>
		  	 	<a id ='imglink' href='#'>
		  	  		<img  width="200px" height="170px" name="SLIDE_picBox" style="border: thin inset white">
		  	  	</a>	  
		    </div>  
	    </td>	    
		<td valign='top' height='150px' width='32%'>
			<span id="SLIDE_textBox" align="center" ></span>
		</td>
	</tr>
	
	<tr>	
		<td valign='bottom' >
		<div>
			<div id='next0' class="slidebutton" style="display:none";>	<img alt="next" src="./images/next0.gif" onClick="SLIDE_forward()"></div>
		  	<div id='next' class="slidebutton">	<img alt="next" src="./images/next.gif" onClick="SLIDE_forward()"></div>
	  		<div  id='imgplay' class="slidebutton"><img src="./images/play.gif" onClick="SLIDE_play()"></div>
		  	<div id='imgpause' class="slidebutton">	<img  src="./images/pause.gif" onClick="SLIDE_pause()"></div>
			<div id='back' class="slidebutton"><img  alt="back" src="./images/back.gif" onClick="SLIDE_back()"></div>
			<div id='back0' class="slidebutton" style="display:none";><img  alt="back" src="./images/prev0.gif" onClick="SLIDE_back()"></div>
	  	</div>
	  	
		</td>
<!--		
<table width='70%' border='0' cellspacing="0">
	<tr>
	<td>
<img src="images/duongke.png" width="450px" height='1px'>
	</td>
	</tr>
	<tr>
	 	<td rowspan="2" class='emphasis' width='12%' valign="top" rowspan="2">
			<img alt="" src="images/tinmoi.gif">
		</td>
		<div id="spagens" style="position:absolute; height:20px;clip:rect(10px 441px 47px 0px);"></div>	
	</tr>
</table>
-->
	</tr>
</table>
<script language="javascript" type="text/javascript" >
	SLIDE_play();
	var texta = new Array();
	var linka = new Array();
	var trgfrma = new Array();
	var heightarr = new Array();
	var texta =  ["<?php echo join("\",\"", $newvalue); ?>"];
	var mc = <?php echo $getnew['num'] ?>;
	var inoout=false;
	var spage;
	var cvar=0,say=0,tpos=0,enson=0,hidsay=0,hidson=0;
	var tmpv;
	tmpv = 500;
	var psy = new Array();
	divtextb ="<div id=d";
	divtextb2 ="<div id=dz";
	divtev1=" onmouseover=\"mdivmo(";divtev2=")\" onmouseout =\"restime(";divtev3=")\"";
	divtexts = " style=\"position:absolute;visibility:hidden;width:500px;padding:0px; padding-top:10px;\">"; 
	uzun="<div id=\"enuzun\" style=\"position:absolute;padding-left:80px;\">";
	uzun2="<div id=\"enuzun2\" style=\"position:absolute;\">";
	var uzunobj=null,uzunobj2=null;
	var uzuntop=0;
	var toplay=0;

function mdivmo(gnum,gnum5)
{
	inoout=true;
			if(gnum5==1)
				{ 
					objd=document.getElementById('dz'+gnum); 
				}
				else
				{   
					objd=document.getElementById('d'+gnum);
				}
	objd.style.cursor='pointer';
	objd.style.textDecoration='underline';
}

function restime(gnum2,gnum5)
{
	inoout=false;
	if(gnum5==1)
	{   
		objd=document.getElementById('dz'+gnum2);  
	}
	else
	{    
	objd=document.getElementById('d'+gnum2);
	}
	objd.style.color="#000000";
	objd.style.textDecoration='none';
	}

function dotrans()
{
	if(inoout==false)
	{  
		uzuntop--;
		if(uzuntop<(-1*toplay)) 
			{   
				uzuntop=0; 
				uzunobj2.style.top=40+"px";    
			} 
		uzunobj.style.top=uzuntop+"px";
		if((uzuntop+toplay)<40)
		{
			uzunobj2.style.top=""+(uzuntop+toplay)+"px";
		} 
	}   
	if(psy[(uzuntop*(-1))+0]==3)
	{
		setTimeout('dotrans()',1000+35);
	}
	else
	{
		setTimeout('dotrans()',35);
	}
}
function initte2()
{
	i=0;
	for(i=0;i<mc;i++)
	{
		objd=document.getElementById('d'+i);
//		heightarr[i]=objd.offsetHeight;
		heightarr[i]=10;
	}
	toplay=0;
	for(i=0;i<mc;i++)
	{
		objd=document.getElementById('d'+i);
		objd.style.visibility="visible";
		objd.style.top=""+toplay+"px";
		psy[toplay]=3;
		toplay=toplay+heightarr[i]+10;
	}
	uzunobj=document.getElementById('enuzun');
	uzunobj.style.left=8+"px";
	uzunobj.style.height=toplay+"px";
	uzunobj.style.width=tmpv+"px";
	uzunobj.style.top=40+"px";
	uzunobj2=document.getElementById('enuzun2');
	uzunobj2.style.left=8+"px";
	uzunobj2.style.height=toplay+"px";
	uzunobj2.style.width=tmpv+"px";
	uzunobj2.style.top=40+"px";
	uzuntop=40;
	dotrans();
}
function initte()
{
	i=0;
	innertxt=""+uzun;
	for(i=0;i<mc;i++)
	{
		innertxt=innertxt+""+divtextb+""+i+""+divtev1+i+",0"+divtev2+i+",0"+divtev3+i+divtexts+texta[i]+"</div>";
	}
		innertxt=innertxt+"</div>";
		innertxt=""+innertxt+uzun2;
		for(i=0;i<mc;i++)
		{
			innertxt=innertxt+""+divtextb2+""+i+""+divtev1+i+",1"+divtev2+i+",1"+divtev3+i+divtexts+texta[i]+"</div>";
		}
		innertxt=innertxt+"</div>";
		//spage=document.getElementById('spagens');
		//spage.innerHTML=""+innertxt;
		setTimeout('initte2()',500);
	}
		window.onload=initte;

</script>
