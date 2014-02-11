<?php 
	defined('_JEXEC') or die('Restricted access');

	$arrimg = explode  ('##',$getprovalueTitle['image']);
	$arrtitletext = explode  ('##',$getprovalueTitle['title']);
	// $arrtitletext = explode  ('##',$getprovalueTitle['value']);
	$imglink = explode  ('##',$getprovalueTitle['link']);
	$newvalue = explode  ('##',$getnew['title']);
	$titleandid = explode  ('##',$getprovalueTitle['tieude']);
	$slideid = explode  ('##',$getprovalueTitle['id']);
	
	//	print_r($getprovalueTitle['tieude']);
	// print_r($arrtitletext);

//print_r($titlelink);
// exit;

?>
<input type="hidden" value="sacmau" name="mausac" id="sacmau" />

<script language="javascript" type="text/javascript">
		
	<?php 
	if ( $loai_slide_show == "project") // slideshow cho du an
	{
	?>
		var SLIDE_text = ["<?php echo join("\",\"", $arrtitletext); ?>"];	
	<?php 
	}
	else // slideshow cho du an
	{
	?>
		var SLIDE_text = ['<?php echo join('\',\'', $arrtitletext); ?>'];
	<?php 
	}
	?>	

	var SLIDE_id = ["<?php echo join("\",\"", $slideid); ?>"];	
	
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
	//	alert('1');
		document.getElementById('next').style.display = 'block';
	//	alert('2');
		document.getElementById('next0').style.display = 'none';
	//	alert('3');
		document.getElementById('back').style.display = 'block';
	//	alert('4');
		document.getElementById('back0').style.display = 'none';
	//	alert('5');
		document.getElementById('imgplay').style.display = 'none';
		
		document.getElementById('imgpause').style.display = 'block';
	  	SLIDE_actual++;
	 // 	alert('slide---'+SLIDE_actual);
	 	SLIDE_slide();
	 //	alert('6');
	 	SLIDE_status = 'SLIDE_play';
	 //	alert('7');
	 	SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	 	// alert('8');
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
	//	alert('1');
	  if (SLIDE_actual > (SLIDE_count)) SLIDE_actual=1;
	//  alert('2');
	  if (SLIDE_actual < 1) SLIDE_actual = SLIDE_count;
	//  alert('3');
	  if (document.all)
	  {
		//  alert('4');
	    document.getElementById("SLIDE_textBox").style.background = "transparent";
	  //  alert('5');
	    document.images.SLIDE_picBox.style.filter="blendTrans(duration=2)";
	  //  alert('6');
	    document.images.SLIDE_picBox.style.filter="blendTrans(duration=SLIDE_fade)";
	  //  alert('7');
	    document.images.SLIDE_picBox.filters.blendTrans.Apply();
	  //  alert('8');
	  }
	 // alert('9');
	  document.images.SLIDE_picBox.src = SLIDE_load[SLIDE_actual].src;
	 // alert('10');


		<?php 
		if ( $loai_slide_show == "project") // slideshow cho du an
		{
		?>
		 document.getElementById('imglink').href = 'index.php?option=com_u_re&controller=projects&task=view'+SLIDE_imglink[SLIDE_actual];
		<?php 
		}
		else // slideshow cho du an
		{
		?>
		 document.getElementById('imglink').href = 'index.php?option=com_content&view=article&Itemid=20&id='+SLIDE_imglink[SLIDE_actual];
		<?php 
		}
		?>	
	//	alert('11');
		var den = document.getElementById("sacmau").value;
		
		 document.getElementById(den).style.color  = "#004f8b";
	//	document.getElementById(den).setAttribute("style", "background: #004f8b;");
		
		document.getElementById(den).setAttribute("style", "hover: #990000;");
		
		document.getElementById("slideshow_"+SLIDE_id[SLIDE_actual]).style.color  = "#990000";
		document.getElementById("sacmau").value = "slideshow_"+SLIDE_id[SLIDE_actual];
	//	alert('12');
		//alert( document.getElementById("SLIDE_textBox").innerHTML);
		var slideTextBoxEle = document.getElementById("SLIDE_textBox");
	  if (slideTextBoxEle)
	  {
		  //alert('inner = ' + slideTextBoxEle.innerHTML );
		  // slideTextBoxEle.innerHTML = "<div><a href=http://24h.com.vn> sdfsda</a></div>"; 
		  // slideTextBoxEle.a.href = "http://24h.com.vn";
		  //slideTextBoxEle.innerHTML = "<a href='http://24h.com.vn'> sdfsda</a>";
		 // alert('inner = after = ' + slideTextBoxEle.innerHTML );
		  // document.getElementById("SLIDE_textBox").innerHTML= 'aaaaa';
		   document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
	  }
	//  alert('13');
	  if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
	 // alert('14');
	}


	/* js tin tuc moi */		
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
		uzun="<div id=\"enuzun\" style=\"position:absolute; padding-left:80px; \">";
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
//			heightarr[i]=objd.offsetHeight;
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
			spage=document.getElementById('spagens');
			if ( spage != null )
			{
			spage.innerHTML=""+innertxt;
			}
			setTimeout('initte2()',500);
	}
	
</script>
