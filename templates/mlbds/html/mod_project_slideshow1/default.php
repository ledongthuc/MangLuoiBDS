
<div id="mod_project_slideshow">
<div id="mod_project_slideshow-l">
 <div class="img-slide">
	<div class='div_project'>
			  	 	<a id ='imglink' href='#'>
			  	  		<img  width="210px" height="200px" name="SLIDE_picBox" style="border: thin inset white"> 
			  	  	</a>	  
			    </div>  
	</div>
<h4>
<!-- <a href="#" class="bold">  -->

	<span id="SLIDE_textBox" align="center" ></span>
<!-- </a> -->
</h4>
</div>  
<div id="mod_project_slideshow-r"> 
<ul>
	<?php 
	foreach ( $titleandid as $tieude )
	{
		$value = explode  ('@#$%^&',$tieude );
	?>
		<li> 
	    	<a href="<?php echo @$value[2] ?>" id="slideshow_<?php echo @$value[1] ?>">
				<?php echo $value[0]; ?>
			</a>
		</li>
	<?php
	}
	?>	
</ul>
<div class='div-xemthem'>
<a href="index.php?option=com_u_re&controller=projects&Itemid=24&lang=vi" class="xemthem"><?php echo JText::_( 'XEM_THEM'); ?></a>
</div>
</div> 

<div class="clear">
</div> 
</div>






<div style="display:none">
	<div id='next0' class="slidebutton" style="display:none";>	<img alt="next" src="./images/next0.gif" onClick="SLIDE_forward()"></div>
	<div id='next' class="slidebutton">	<img alt="next" src="./images/next.gif" onClick="SLIDE_forward()"></div>
	<div  id='imgplay' class="slidebutton"><img src="./images/play.gif" onClick="SLIDE_play()"></div>
	<div id='imgpause' class="slidebutton">	<img  src="./images/pause.gif" onClick="SLIDE_pause()"></div>
	<div id='back' class="slidebutton"><img  alt="back" src="./images/back.gif" onClick="SLIDE_back()"></div>
	<div id='back0' class="slidebutton" style="display:none";><img  alt="back" src="./images/prev0.gif" onClick="SLIDE_back()"></div>
</div>
	
<script language="javascript" type="text/javascript" >
	SLIDE_play();
	window.onload=initte;
</script>
