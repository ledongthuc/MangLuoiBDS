<?php
	defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<style type="text/css" media="screen">
	.photo_holder{
		
		margin: 0;
		padding: 0;
		position: absolute;
	}
</style>

<div style="display:none">
	<?php 
	foreach($listimage as $image)
	{
		echo "<a href='".$image['link']."' rel='mod_photo[article]'><img alt='".$image['title']."'/></a>";
		
	}
	?>
</div>

<div style="width:<?php echo $width+40;?>px; height:<?php echo $height+100;?>px; margin-left:<?php echo $margin_left;?>px">
	<div class="photo_holder">
		<div class="ppt"></div>
		<div class="pp_top">
			<div class="pp_left"></div>
			<div class="pp_middle"></div>
			<div class="pp_right"></div>
		</div>
		<div class="pp_content_container">
			<div class="pp_left">
				<div class="pp_right">
					<div class="pp_content">
						<div class="pp_loaderIcon"></div>
						<div class="pp_fade">
							<!--<a title="Expand the image" class="pp_expand" href="#" style="display: inline;">Expand</a>-->
							<a title="Expand the image" class="pp_expand" href="#" style="display: inline;">Expand</a>
							<div class="pp_hoverContainer" style="height: 175px; width: 181px;">
								<a href="#" class="pp_next">next</a>
								<a href="#" class="pp_previous">previous</a>
							</div>
							<div id="pp_full_res"></div>					
							<div class="pp_details" style="width: 181.533px;">
								<div class="pp_nav">
									<a class="pp_arrow_previous" href="#">Previous</a>
									<p class="currentTextHolder">0/0</p>
									<a class="pp_arrow_next" href="#">Next</a>
								</div>
								<p class="pp_description" style="display: none;"></p>
								<!--<a href="#" class="pp_close">Close</a>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pp_bottom">
			<div class="pp_left"></div>
			<div class="pp_middle"></div>
			<div class="pp_right"></div>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("a[rel^='mod_photo']").mod_photo({animation_speed:'normal',
			theme:'facebook',
			default_width:<?php echo $width;?>,
			default_height:<?php echo $height;?>,
			slideshow:<?php echo $speed;?>,
			show_title:<?php echo $showtitle;?>,
			autoplay_slideshow:<?php echo $autoplay;?>});
		$("a[rel^='mod_photo']:eq(0)").trigger('click');
	});	
</script>