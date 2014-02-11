<div id="mod_project_slideshow">
<div id="mod_project_slideshow-l">
 <div class="img-slide">
	<div class='div_project'>
			  	 	<a id ='imglink' href='#'>
			  	  		<img  width="180px" height="140px" name="hinhanh_1"> 
			  	  	</a>	  
			    </div>  
			    
	</div>
	
<h4>
	<span id="SLIDE_textBox_1" align="center" ></span>
</h4>
<div id='motangan_5'></div>
</div>  
<div id="mod_project_slideshow-r"> 
<ul>
	<?php 
	foreach ( $arrvalue as $tieude )
	{
	?>
	
		 <li class='tieude_slide'>
		<?php echo $tieude;?>
		 </li>
		<?php
	 }
	?>	
</ul>
<div class='div-xemthem'>
<a href="index.php?option=com_u_re&controller=projects&Itemid=24&lang=vi" class="xemthem"><?php echo JText::_( 'XEM_TIN_KHAC'); ?></a>
</div>
</div> 

<div class="clear">
</div> 
</div>


<div style="display:none">
	<div id='next0_bv' class="slidebutton" style="display:none";>	<img alt="next" src="./images/next0.gif" onClick="SLIDE_forward()"></div>
	<div id='next_bv' class="slidebutton">	<img alt="next" src="./images/next.gif" onClick="SLIDE_forward()"></div>
	<div  id='imgplay_bv' class="slidebutton"><img src="./images/play.gif" onClick="SLIDE_play()"></div>
	<div id='imgpause_bv' class="slidebutton">	<img  src="./images/pause.gif" onClick="SLIDE_pause()"></div>
	<div id='back_bv' class="slidebutton"><img  alt="back" src="./images/back.gif" onClick="SLIDE_back()"></div>
	<div id='back0_bv' class="slidebutton" style="display:none";><img  alt="back" src="./images/prev0.gif" onClick="SLIDE_back()"></div>
</div>
	
<script language="javascript" type="text/javascript" >
	SLIDE_play();
	window.onload=initte;
</script>
