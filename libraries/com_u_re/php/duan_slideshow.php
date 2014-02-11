<?php 
	defined('_JEXEC') or die('Restricted access');
	// slideshow cho du an
	$arrtitletext = explode  ('##',$getprovalueTitle['title']);	
	$slideid = explode  ('##',$getprovalueTitle['id']);
	$imglink = explode  ('##',$getprovalueTitle['link']);
	$arrimg = explode  ('##',$getprovalueTitle['image']);
	$titleandid = explode  ('##',$getprovalueTitle['tieude']);
	$motangan = explode  ('##',$getprovalueTitle['value']);
	/*
	echo "<pte>";
	print_r($arrtitletext);
	echo "</pte>";
	// exit;
	*/
?>

<script language="javascript" type="text/javascript">
		
	var SLIDE_text_da = ["<?php echo join("\",\"", $arrtitletext); ?>"];	
	var SLIDE_id = ["<?php echo join("\",\"", $slideid); ?>"];		
	var SLIDE_pic_da =  ["<?php echo join("\",\"", $arrimg); ?>"];
	var SLIDE_imglink_da =  ["<?php echo join("\",\"", $imglink); ?>"];
	// alert(SLIDE_pic_da);
	var SLIDE_motangan =  ["<?php echo join("\",\"", $motangan); ?>"];
	
	var SLIDE_load_da = new Array();
	var SLIDE_status_da, SLIDE_timeout_da;
	var SLIDE_actual_da = 1;
	var SLIDE_speed_da = <?php echo $speed ?>;

	for (i = 0; i <= SLIDE_text_da.length-1; i++)
	{
	  SLIDE_load_da[i] = new Image();
	  SLIDE_load_da[i].src = SLIDE_pic_da[i];
	}
	
	var SLIDE_count = SLIDE_pic_da.length-1;

	function SLIDE_play_da()
	{
		//alert( 'SLIDE_play da');
		document.getElementById('next').style.display = 'block';
		document.getElementById('next0').style.display = 'none';
		document.getElementById('back').style.display = 'block';
		document.getElementById('back0').style.display = 'none';
		document.getElementById('imgplay').style.display = 'none';
		document.getElementById('imgpause').style.display = 'block';
	  	SLIDE_actual_da++;
	 	SLIDE_slide_da();
	 	SLIDE_status_da = 'SLIDE_play_da';
	 	SLIDE_timeout_da = setTimeout("SLIDE_play_da()",SLIDE_speed_da);
	}

	function SLIDE_pause_da()
	{
		// alert( 'SLIDE_pause_da');
		document.getElementById('imgplay').style.display = 'block';	
		document.getElementById('imgpause').style.display = 'none';
	 	clearTimeout(SLIDE_timeout_da);
	 	SLIDE_status_da = 'SLIDE_pause_da';
	}

	function SLIDE_back_da()
	{
		// alert( 'SLIDE_back');
	  document.getElementById('back').style.display = 'none';
		document.getElementById('back0').style.display = 'block';
		document.getElementById('next0').style.display = 'none';
		document.getElementById('next').style.display = 'block';
		clearTimeout(SLIDE_timeout_da);
		SLIDE_actual_da--;
		SLIDE_slide_da();  
		SLIDE_pause_da();
	  if (SLIDE_status_da != 'SLIDE_pause_da') SLIDE_timeout_da = setTimeout("SLIDE_play_da()",SLIDE_speed_da);
	}

	function SLIDE_forward_da()
	{

		// alert( 'SLIDE_forward');
		document.getElementById('back').style.display = 'block';
		document.getElementById('back0').style.display = 'none';
		document.getElementById('next').style.display = 'none';
		document.getElementById('next0').style.display = 'block';
		clearTimeout(SLIDE_timeout_da);
		SLIDE_actual_da++;
		SLIDE_slide_da();
		SLIDE_pause_da();
	  if (SLIDE_status_da != 'SLIDE_pause_da') SLIDE_timeout_da = setTimeout("SLIDE_play_da()",SLIDE_speed_da);
	}

	function SLIDE_slide_da()
	{
	//	alert('du an');
	  if (SLIDE_actual_da > (SLIDE_count)) SLIDE_actual_da=1;
	  if (SLIDE_actual_da < 1) SLIDE_actual_da = SLIDE_count;
	  if (document.all)
	  {
	  }
	 	document.images['hinhanh_2'].src = SLIDE_load_da[SLIDE_actual_da].src;
		 	document.getElementById('imglink_da').href = 'index.php?option=com_u_re&controller=projects&task=view'+SLIDE_imglink_da[SLIDE_actual_da];
			 var slideTextBoxEle_da = document.getElementById('SLIDE_textBox_2');
			 if (slideTextBoxEle_da)
			  {
				   document.getElementById('SLIDE_textBox_2').innerHTML= SLIDE_text_da[SLIDE_actual_da];
		//		   document.getElementById('motangan').innerHTML= SLIDE_motangan[SLIDE_actual_da];
				   
			  }
	 // if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
	}
</script>
