<style>			
		.contact_title{ background:#fff;}
		.contact_title a{text-align:center;color:#FFF; font-size:16pt; }
		.contact_title img{width:45px; padding-left:60px;padding-right:20px;} 
		.form_detail{margin:0 auto; width:300px; margin-top:30px; }
		.form_detail img{width: 10px;
padding-left: 1px;
padding-bottom: 15px;}
		.sendbutton{  padding-left: 11px;
    padding-top: 5px;}
		.sendbt{background:#096; border:0px; cursor:pointer; height:30px; width:80px; color:#FFF; margin-left:3px; border:1px solid #BBB;}
		.sendbt:hover{background:#609;}
		.textbox{ font-family: Arial, Helvetica, sans-serif;
border: 1px solid #96A6C5;
padding: 3px;
width: 245px;font-size:12px;
   margin-bottom: 12px;}
		.detail_text{font-family: Arial, Helvetica, sans-serif;
border: 1px solid #96A6C5;
padding: 3px;
width: 245px;
height:100px;
font-size:12px;} 
		textarea{font-family:Sans-Serif;}
		#successbox{display:none; font-size:16pt; color:#4c4c4c; padding-top:30px; text-align:center; width:300px; height:200px;}
		#successbox a{text-decoration:none;}
		#successbox a:hover{text-decoration:underline;}			
		.fancybox-wrap,.fancybox-skin,.fancybox-outer,.fancybox-inner,.fancybox-image,.fancybox-wrap iframe,.fancybox-wrap object,.fancybox-nav,.fancybox-nav span,.fancybox-tmp{border:0;outline:none;vertical-align:top;margin:0;padding:0}.fancybox-wrap{position:absolute;top:0;left:0;z-index:8020}.fancybox-skin{position:relative;color:#444;text-shadow:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.fancybox-opened{z-index:8030}.fancybox-opened .fancybox-skin{}
.fancybox-outer,.fancybox-inner{position:relative}.fancybox-type-iframe .fancybox-inner{-webkit-overflow-scrolling:touch}.fancybox-error{color:#444;font:14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;white-space:nowrap;margin:0;padding:15px}.fancybox-image,.fancybox-iframe{display:block;width:100%;height:100%}.fancybox-image{max-width:100%;max-height:100%}#fancybox-loading,.fancybox-close,.fancybox-prev span,.fancybox-next span{background-image:url(fancybox_sprite.png)}#fancybox-loading{position:fixed;top:50%;left:50%;margin-top:-22px;margin-left:-22px;background-position:0 -108px;opacity:0.8;cursor:pointer;z-index:8060}#fancybox-loading div{width:44px;height:44px}.fancybox-close{position:absolute;top:-8px;right:-11px;width:36px;height:36px;cursor:pointer;z-index:8040}.fancybox-nav{position:absolute;top:0;width:40%;height:100%;cursor:pointer;text-decoration:none;background:transparent url(blank.gif);-webkit-tap-highlight-color:rgba(0,0,0,0);z-index:8040}.fancybox-prev{left:0}.fancybox-next{right:0}.fancybox-nav span{position:absolute;top:50%;width:36px;height:34px;margin-top:-18px;cursor:pointer;z-index:8040;visibility:hidden}.fancybox-prev span{left:10px;background-position:0 -36px}.fancybox-next span{right:10px;background-position:0 -72px}.fancybox-tmp{position:absolute;top:-9999px;left:-9999px;visibility:hidden}
		/* EDIT OVERLAY */
		.fancybox-overlay{position:absolute;top:0;left:0;overflow:hidden;display:none;z-index:8010;background:#000;}
		.fancybox-overlay-fixed{position:fixed;bottom:0;right:0}.fancybox-lock .fancybox-overlay{overflow:auto;overflow-y:scroll}.fancybox-title{visibility:hidden;font:normal 13px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;position:relative;text-shadow:none;z-index:8050}.fancybox-title-float-wrap{position:absolute;bottom:0;right:50%;margin-bottom:-35px;z-index:8050;text-align:center}.fancybox-title-float-wrap .child{display:inline-block;margin-right:-100%;background:rgba(0,0,0,0.8);-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px;text-shadow:0 1px 2px #222;color:#FFF;font-weight:700;line-height:24px;white-space:nowrap;padding:2px 20px}.fancybox-title-outside-wrap{position:relative;margin-top:10px;color:#fff}.fancybox-title-inside-wrap{padding-top:10px}.fancybox-title-over-wrap{position:absolute;bottom:0;left:0;color:#fff;background:rgba(0,0,0,.8);padding:10px}.fancybox-inner,.fancybox-lock{overflow:hidden}.fancybox-nav:hover span,.fancybox-opened .fancybox-title{visibility:visible}
	</style>	
<!-- <script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>  -->
	<script type="text/javascript" src="<?php echo JURI::base();?>includes/js/jquery.bpopup-0.7.0.min.js"></script>
	<script>
	//jQuery.noConflict();
	function showMailBoxbds(){				
		jQuery('#showboxbds').bPopup();
		var tieude = jQuery(".title_details span").text();
		jQuery('input[name="subjectbds"]').val("Chia sẻ: "+tieude);		
		jQuery("#sendmailbds").click(function(){
			var mailfrom 	= 	jQuery("#mailfrombds").val();
			var mailto 		= 	jQuery("#mailtobds").val();
			var subject 	=	jQuery("#subjectbds").val();
			var content 	=	jQuery("#contentbds").val();
			var link 		=   '<?php echo $_SERVER['HTTP_REFERER']?>';
			var url 		=   '<?php echo JURI::base()?>';
			var input_data = '&mailfrombds='+mailfrom+'&mailtobds='+mailto+'&subjectbds='+subject+'&contentbds='+content+'&link='+link+'&url='+url;
			jQuery.ajax({
					   type: "POST",
					   url:  "<?php echo JURI::base().'modules/mod_socialbds/tmpl/email/sendmail.php'?>",
					   data: input_data,
					   success: function(msg){
						   jQuery('.loading-img').remove();
						   jQuery('<div class="message">').html(msg).appendTo('div#result').hide().fadeIn('slow');
					   }
					});
				return false;
		    });
	}
	
	
	</script>
<a class="fancybox" onclick="showMailBoxbds()" style="cursor: pointer;"><span>Email</span></a>
<div id="showboxbds" class='facebook' style="width:300px; height:430px; display: none;"><span class="bClose"></span>
<!--<div id="showbox" style="width:300px; height:400px; display: none;" class="pp_pic_holder facebook">-->
<div class="pp_top fb_top">
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
<div class='pp_content_container fb_content_container'>
		<div class="pp_left fb_left ">
			<div class="pp_right fb_right">
					<div class="contact_title">
			
							<div class='componentheading'>GỬI MAIL</div>
								<div id="successbox"></div>
			<div class="form_detail"><form>
							<table class="formajax" id="bds">
								<tr>
									<td width="240px"><input type="text" class="textbox" id="mailtobds" autocomplete="off" onclick="if(this.value=='Email người nhận') this.value=''" onBlur="if(this.value=='') this.value='Email người nhận'" value="Email người nhận"/></td>  
									<td><div id="toalert" class="alerttext"></div></td>
								</tr>
								<tr>
									<td width="240px"><input type="text" class="textbox" id="mailfrombds" autocomplete="off" onclick="if(this.value=='Email của bạn') this.value=''" onBlur="if(this.value=='') this.value='Email của bạn'" value="Email của bạn"/></td>  
									<td><div id="fromalert" class="alerttext"></div></td>
								</tr>
								<tr>
									<td><input type="text" class="textbox" name="subjectbds" id="subjectbds" autocomplete="off" onclick="if(this.value=='Tiêu đề thư') this.value=''" onBlur="if(this.value=='') this.value='Tiêu đề thư'" value="Tiêu đề thư"/></td>  
									<td><div id="subjectalert" class="alerttext"></div></td>
			</tr>
			<tr>
				<td colspan="2"><textarea class="detail_text" id="contentbds" onclick="if(this.value=='Nội dung thư') this.value=''" onBlur="if(this.value=='') this.value='Nội dung thư'" />Nội dung thư</textarea></td>
			</tr>
</table>
  
<div class="sendbutton" style="width: 245px"><center>
<input type="submit" class=" btn-search" id="sendmailbds" value="Gửi thư" />
</center>
</div>
</div></form>
			</div>
	
		</div>
		</div>
		
		
</div>

<div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>


</div>