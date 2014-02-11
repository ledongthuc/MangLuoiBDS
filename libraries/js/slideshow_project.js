
function test()
		{
			alert('test');

		}
function slideshow(arrtext, arrimg, speed , sta)
	{
	alert(arrimg);
	var SLIDE_text = arrtext;
	var SLIDE_pic =  arrimg;	
	var SLIDE_speed = speed
	
	var SLIDE_load = new Array();
	var SLIDE_status, SLIDE_timeout;
	var SLIDE_actual = 1;
	var SLIDE_fade = 2;
	
	
	
	for (i = 0; i <= SLIDE_text.length-1; i++)
	{
	
	  SLIDE_load[i] = new Image();
	  SLIDE_load[i].src = SLIDE_pic[i];
	}
	
	
	
	
	
	var SLIDE_count = SLIDE_pic.length-1;
	
	function SLIDE_start()
	{
	//  document.getElementById('SLIDE_pause').disabled = true;
	  document.images.SLIDE_picBox.src = SLIDE_load[SLIDE_actual].src;
	  document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
	}
	
	function SLIDE_play()
	{
		alert('sdfdsf');
	//  document.getElementById('SLIDE_play').disabled = true;
	//  document.getElementById('SLIDE_pause').disabled = false;
	  SLIDE_actual++;
	  SLIDE_slide();
	  SLIDE_status = 'SLIDE_play';
	  SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	}
	
	if(sta== 's')
	{
		alert('333');
		SLIDE_play();

	}
	else
		if(sta == 'P')
		{
			SLIDE_pause();
		}
		else
			if (sta == 'B')
			{
				SLIDE_back();
			}
			else
				if(sta == 'F')
				{
					SLIDE_forward();
				}
	function SLIDE_forward()
	{
	  clearTimeout(SLIDE_timeout);
	  SLIDE_actual++;
	  SLIDE_slide();
	  SLIDE_pause();
	  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	}
	
	function SLIDE_back()
	{
	  clearTimeout(SLIDE_timeout);
	  SLIDE_actual--;
	  SLIDE_slide();  
	  SLIDE_pause();
	  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	  
	}
	
	function SLIDE_pause()
	{
	//	alert('sdfdsf');
	  clearTimeout(SLIDE_timeout);
	  SLIDE_status = 'SLIDE_pause';
	 // document.getElementById('SLIDE_pause').disabled = true;
	// document.getElementById('SLIDE_play').disabled = false;	
	}
	
	function SLIDE_slide()
	{
	  if (SLIDE_status != 'SLIDE_pause')
	  {
	 //   document.getElementById('SLIDE_play').disabled = true;
	//    document.getElementById('SLIDE_pause').disabled = false;
	  }
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
	  if (document.getElementById) document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
	  if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
	}
	
	function SLIDE_speeds(SLIDE_valgt)
	{
	  SLIDE_speed = SLIDE_valgt.options[SLIDE_valgt.selectedIndex].value;
	}
	

}


