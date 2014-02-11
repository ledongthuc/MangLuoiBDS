<?php 
	defined('_JEXEC') or die('Restricted access');

	$arrvalue = explode  ('!@#$%^',$getprovalueTitle['value']);
	$arrtitletext = explode  ('##',$getprovalueTitle['tieude']);
	$imglink = explode  ('##',$getprovalueTitle['link']);
	$arrimg = explode  ('##',$getprovalueTitle['image']);
 // print_r($arrvalue );
	// print_r($arrtitletext );
//	exit;
//	 var SLIDE_speed = <?php echo $speed 
?>

<script language="javascript" type="text/javascript">		

	var SLIDE_text = ['<?php echo join('\',\'', $arrtitletext); ?>'];
	var SLIDE_pic =  ["<?php echo join("\",\"", $arrimg); ?>"];
	var SLIDE_imglink =  ["<?php echo join("\",\"", $imglink); ?>"];

	var tenhinhanh = '<?php echo 'hinhanh_'.$moduleid ?>';
	var SLIDE_load = new Array();
	var SLIDE_status, SLIDE_timeout;
	var SLIDE_actual = 1;
	var SLIDE_speed = 1900;
	var SLIDE_fade = 2;
	for (i = 0; i <= SLIDE_text.length-1; i++)
	{
	  SLIDE_load[i] = new Image();
	  SLIDE_load[i].src = SLIDE_pic[i];
	}
	
	var SLIDE_count = SLIDE_pic.length-1;

	function SLIDE_play()
	{
		document.getElementById('next_bv').style.display = 'block';
		document.getElementById('next0_bv').style.display = 'none';
		
		document.getElementById('back_bv').style.display = 'block';
		document.getElementById('back0_bv').style.display = 'none';
		document.getElementById('imgplay_bv').style.display = 'none';
		document.getElementById('imgpause_bv').style.display = 'block';
	  	SLIDE_actual++;
	 	SLIDE_slide_bv();
	 	SLIDE_status = 'SLIDE_play';
	 	SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	}

	function SLIDE_pause()
	{
		document.getElementById('imgplay_bv').style.display = 'block';	
		document.getElementById('imgpause_bv').style.display = 'none';
	 	clearTimeout(SLIDE_timeout);
	 	SLIDE_status = 'SLIDE_pause';
	}

	function SLIDE_back()
	{
	  document.getElementById('back_bv').style.display = 'none';
		document.getElementById('back0_bv').style.display = 'block';
		document.getElementById('next0_bv').style.display = 'none';
		document.getElementById('next_bv').style.display = 'block';
		clearTimeout(SLIDE_timeout);
		SLIDE_actual--;
		SLIDE_slide_bv();  
		SLIDE_pause();
	  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	}

	function SLIDE_forward()
	{
	  
		document.getElementById('back_bv').style.display = 'block';
		document.getElementById('back0_bv').style.display = 'none';
		document.getElementById('next_bv').style.display = 'none';
		document.getElementById('next0_bv').style.display = 'block';
		clearTimeout(SLIDE_timeout);
		SLIDE_actual++;
		SLIDE_slide_bv();
		SLIDE_pause();
	  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
	}

	function SLIDE_slide_bv()
	{
	  if (SLIDE_actual > (SLIDE_count)) SLIDE_actual=1;
	  if (SLIDE_actual < 1) SLIDE_actual = SLIDE_count;
	  if (document.all)
	  {
	  }
	 	document.images[tenhinhanh].src = SLIDE_load[SLIDE_actual].src;
	 	
		document.getElementById('imglink').href = 'index.php?option=com_content&view=article&Itemid=20&id='+SLIDE_imglink[SLIDE_actual];
		var slideTextBoxEle = document.getElementById('SLIDE_textBox_1');
		if (slideTextBoxEle)
		  {
			   document.getElementById('SLIDE_textBox_1').innerHTML= SLIDE_text[SLIDE_actual];
		  }
	 // if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
	}


</script>
