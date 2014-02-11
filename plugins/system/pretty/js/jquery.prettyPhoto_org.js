(function($){
	$.fn.prettyPhoto=function(pp_settings){	
		pp_settings=jQuery.extend({photo_id:'0',
								   photo_type:'plg',
								   animation_speed:'fast',
								   slideshow:5000,
								   autoplay_slideshow:false,
								   opacity:0.20,
								   show_title:true,
								   allow_resize:true,
								   allow_scroll:false,
								   default_width:640,
								   default_height:480,
								   width_content: 650,
								   height_content:490,
								   width_popup:650,
								   height_popup:490,										   
								   thumbnail_size:50,
								   show_hoverbutton:false, // hien thi  buntton on image
								   show_thumbnailbutton:false,
								   counter_separator_label:'/',
								   theme:'pp_default',
								   horizontal_padding:20,
								   hideflash:false,
								   wmode:'opaque',
								   autoplay:false,
								   modal:false,
								   deeplinking:false,
								   overlay_gallery:true,
								   keyboard_shortcuts:true,
								   changepicturecallback:function(){},
								   callback:function(){},
								   ie6_fallback:true,
								   markup:'',//'<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image">Expand</a><div class="pp_hoverContainer"><a class="pp_next" href="#">next</a><a class="pp_previous" href="#">previous</a></div><div id="pp_full_res"></div><div class="pp_details"><div class="pp_nav"><a href="#" class="pp_arrow_previous">Previous</a><p class="currentTextHolder">0/0</p><a href="#" class="pp_arrow_next">Next</a></div><p class="pp_description"></p>{pp_social}<a class="pp_close" href="#">Close</a></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>',
								   //markup:'<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div id="left_box" class="left_box" style="width:100px"></div><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image">Expand</a><div class="pp_hoverContainer"><a class="pp_next" href="#">next</a><a class="pp_previous" href="#">previous</a></div><div id="pp_full_res"></div><div class="pp_details"><div class="pp_nav"><a href="#" class="pp_arrow_previous">Previous</a><p class="currentTextHolder">0/0</p><a href="#" class="pp_arrow_next">Next</a></div><p class="pp_description"></p>{pp_social}<a class="pp_close" href="#">Close</a></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>',
								   gallery_markup:'<div class="pp_gallery"><a href="#" class="pp_arrow_previous">Previous</a><div><ul>{gallery}</ul></div><a href="#" class="pp_arrow_next">Next</a></div>',
								   image_markup:'<img class="pp_full_image" src="{path}" />',
								   flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
								   quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
								   iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
								   inline_markup:'<div class="pp_inline">{content}</div>',
								   custom_markup:'',
								   social_tools:''},//'<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>'},
								   pp_settings);
		
var matchedObjects=this,percentBased=false,pp_dimensions,pp_open,pp_contentHeight,pp_contentWidth,pp_containerHeight,pp_containerWidth,windowHeight=$(window).height(),windowWidth=$(window).width(),pp_slideshow;doresize=true,scroll_pos=_get_scroll();
if(pp_settings.keyboard_shortcuts){
	$(document).unbind('keydown.prettyphoto').bind('keydown.prettyphoto',function(e){
		if(typeof $('#pp_pic_holder_'+pp_settings.photo_id)!='undefined'){
				if($('#pp_pic_holder_'+pp_settings.photo_id).is(':visible')){	
					switch(e.keyCode){
						case 37:$.prettyPhoto.changePage('previous');e.preventDefault();break;
						case 39:$.prettyPhoto.changePage('next');  
								e.preventDefault();break;
						case 27:if(!settings.modal)
									$.prettyPhoto.close();
								e.preventDefault();break;
					};
				};
			};
			});
};
			
	$.prettyPhoto.initialize=function(){		
		//settings=pp_settings;		
		if(pp_settings.theme=='pp_default')pp_settings.horizontal_padding=16;
		if(pp_settings.ie6_fallback&&$.browser.msie&&parseInt($.browser.version)==6)pp_settings.theme="light_square";
		theRel=$(this).attr('rel');
		galleryRegExp=/\[(?:.*)\]/;
		isSet=(galleryRegExp.exec(theRel))?true:false;
		pp_images=(isSet)?jQuery.map(matchedObjects,function(n,i){
			if($(n).attr('rel').indexOf(theRel)!=-1)return $(n).attr('href');}):$.makeArray($(this).attr('href'));
			pp_titles=(isSet)?jQuery.map(matchedObjects,function(n,i){
				if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).find('img').attr('alt'))?$(n).find('img').attr('alt'):"";}):$.makeArray($(this).find('img').attr('alt'));pp_descriptions=(isSet)?jQuery.map(matchedObjects,function(n,i)
					{
						if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).attr('title'))?$(n).attr('title'):"";}):$.makeArray($(this).attr('title'));
			set_position=jQuery.inArray($(this).attr('href'),pp_images);
			rel_index=(isSet)?set_position:$("a[rel^='"+theRel+"']").index($(this));
			_build_overlay(this);
			if(pp_settings.allow_scroll)
				$(window).bind('scroll.prettyphoto',function(){_center_overlay();});
			//$.prettyPhoto.open();return false;
		var _body = document.getElementsByTagName('body') [0];
		var webbrowser=_body.filters? "ie" : typeof _body.style.MozOpacity=="string"? "mozilla" : ""
		if(webbrowser=="ie"){
			if(pp_settings.autoplay==false){
				pp_settings.autoplay=true;
				$.prettyPhoto.close();
				return false;
			}
			else{
				$.prettyPhoto.open();
				return false;
			}
		}else{
			$.prettyPhoto.open();
			return false;
		}
	}

	$.prettyPhoto.open=function(event){		
		
		if(typeof pp_settings=="undefined"){
			//settings=pp_settings;
			if($.browser.msie&&$.browser.version==6)pp_settings.theme="light_square";
			pp_images=$.makeArray(arguments[0]);
			pp_titles=(arguments[1])?$.makeArray(arguments[1]):$.makeArray("");
			pp_descriptions=(arguments[2])?$.makeArray(arguments[2]):$.makeArray("");
			isSet=(pp_images.length>1)?true:false;
			set_position=0;
			_build_overlay(event.target);
		}
		
		if($.browser.msie&&$.browser.version==6)$('select').css('visibility','hidden');
		_checkPosition($(pp_images).size());		
		$('#pp_loaderIcon_'+pp_settings.photo_id).show();		
		if($('#ppt_'+pp_settings.photo_id).is(':hidden'))$('#ppt_'+pp_settings.photo_id).css('opacity',0).show();
		$pp_overlay.show().fadeTo(pp_settings.animation_speed,pp_settings.opacity);
		$('#pp_pic_holder_'+pp_settings.photo_id).find('.currentTextHolder').text((set_position+1)+pp_settings.counter_separator_label+$(pp_images).size());
		if(pp_descriptions[set_position]!=""){
			$('#pp_description_'+pp_settings.photo_id).show().html(unescape(pp_descriptions[set_position]));
		}else{
			$('#pp_description_'+pp_settings.photo_id).hide();
		}
		movie_width=(parseFloat(getParam('width',pp_images[set_position])))?getParam('width',pp_images[set_position]):pp_settings.default_width.toString();
		movie_height=(parseFloat(getParam('height',pp_images[set_position])))?getParam('height',pp_images[set_position]):pp_settings.default_height.toString();
		percentBased=false;
		if(movie_height.indexOf('%')!=-1){
			movie_height=parseFloat(($(window).height()*parseFloat(movie_height)/100)-150);
			percentBased=true;
		}
		if(movie_width.indexOf('%')!=-1){
			movie_width=parseFloat(($(window).width()*parseFloat(movie_width)/100)-150);
			percentBased=true;
		}		
		
		$('#pp_pic_holder_'+pp_settings.photo_id).fadeIn(function(){
			(pp_settings.show_title&&pp_titles[set_position]!=""&&typeof pp_titles[set_position]!="undefined")?$('#ppt_'+pp_settings.photo_id).html(unescape(pp_titles[set_position])):$('#ppt_'+pp_settings.photo_id).html('&nbsp;');
			imgPreloader="";
			skipInjection=false;
			if(_getFileType(pp_images[set_position])=='image'){
				imgPreloader=new Image();
				nextImage=new Image();
				if(isSet&&set_position<$(pp_images).size()-1)nextImage.src=pp_images[set_position+1];
				prevImage=new Image();
				if(isSet && pp_images[set_position-1])prevImage.src=pp_images[set_position-1];				
				$('#pp_full_res_'+pp_settings.photo_id)[0].innerHTML = pp_settings.image_markup.replace(/{path}/g,pp_images[set_position]);
				imgPreloader.onload=function(){					
										pp_dimensions=_fitToViewport3(imgPreloader.width,imgPreloader.height);
										_showContent();
									};
				imgPreloader.onerror=function(){
									alert('Image cannot be loaded. Make sure the path is correct and image exist.');
									$.prettyPhoto.close();
									};
				imgPreloader.src=pp_images[set_position];			
			};										
			if(!imgPreloader&&!skipInjection){
				$('#pp_full_res_'+pp_settings.photo_id)[0].innerHTML=toInject;
				_showContent();
			}
		;});
		return false;
	};
	$.prettyPhoto.changePage=function(direction){
		currentGalleryPage=0;
		if(direction=='previous'){
			set_position--;
			if(set_position<0)set_position=$(pp_images).size()-1;
		}else if(direction=='next'){
			set_position++;
			if(set_position>$(pp_images).size()-1)set_position=0;
		}else{set_position=direction;};
		rel_index=set_position;
		if(!doresize)doresize=true;
		$('.pp_contract').removeClass('pp_contract').addClass('pp_expand');
		_hideContent(function(){$.prettyPhoto.open();});
	};
	$.prettyPhoto.changeGalleryPage=function(direction){		
		if(direction=='next'){
			currentGalleryPage++;
			if(currentGalleryPage>totalPage)currentGalleryPage=0;
			}else if(direction=='previous'){
				currentGalleryPage--;
				if(currentGalleryPage<0)currentGalleryPage=totalPage;
			}else{
				currentGalleryPage=direction;
			};
			slide_speed=(direction=='next'||direction=='previous')?pp_settings.animation_speed:0;
			slide_to=currentGalleryPage*(itemsPerPage*itemWidth);
			$('#pp_gallery_'+pp_settings.photo_id).find('ul').animate({left:-slide_to},slide_speed);
	};
	
	$.prettyPhoto.startSlideshow=function(){		
		if(typeof pp_slideshow=='undefined'){
			$('#pp_pic_holder_'+pp_settings.photo_id).find('.pp_play').unbind('click').removeClass('pp_play').addClass('pp_pause').click(function(){$.prettyPhoto.stopSlideshow();return false;});
			pp_slideshow=setInterval($.prettyPhoto.startSlideshow,pp_settings.slideshow);
		}else{
			$.prettyPhoto.changePage('next');
		};
	}
	$.prettyPhoto.stopSlideshow=function(){
		$('#pp_pic_holder_'+pp_settings.photo_id).find('.pp_pause').unbind('click').removeClass('pp_pause').addClass('pp_play').click(function(){
			$.prettyPhoto.startSlideshow();
			return false;
		});
		clearInterval(pp_slideshow);
		pp_slideshow=undefined;
	}
			
	$.prettyPhoto.close=function(){
		if($pp_overlay.is(":animated"))return;
		$.prettyPhoto.stopSlideshow();
		$('#pp_pic_holder_'+pp_settings.photo_id).stop().find('object,embed').css('visibility','hidden');
		$('#pp_pic_holder_'+pp_settings.photo_id+',#ppt_'+pp_settings.photo_id+',#pp_fade_'+pp_settings.photo_id).fadeOut(pp_settings.animation_speed);
		$pp_overlay.fadeOut(pp_settings.animation_speed,function(){
				if($.browser.msie&&$.browser.version==6)$('select').css('visibility','visible');
				if(pp_settings.hideflash)$('object,embed').css('visibility','visible');
				$(this).remove();
				$(window).unbind('scroll.prettyphoto');
				pp_settings.callback();
				doresize=true;
				pp_open=false;
				//delete settings;
			});
		$('#pp_gallery_'+pp_settings.photo_id).find('ul').html('{pp_gallery}');
	};
			
	function _showContent(){		
		$('#pp_loaderIcon_'+pp_settings.photo_id).hide();
		projectedTop=scroll_pos['scrollTop'];
		if(projectedTop<0)projectedTop=0;
		$('#ppt_'+pp_settings.photo_id).fadeTo(pp_settings.animation_speed,1);		
		$('#pp_content_'+pp_settings.photo_id).animate({height:pp_dimensions['contentHeight'],width:pp_settings.width_content},pp_settings.animation_speed);
		$('#pp_pic_holder_'+pp_settings.photo_id).animate({'top':projectedTop,'left':(windowWidth-pp_settings.width_popup)/2,width:pp_settings.width_popup},pp_settings.animation_speed,function(){		
				$('#pp_pic_holder_'+pp_settings.photo_id).find('.pp_hoverContainer,.pp_full_image').height(pp_dimensions['height']).width(pp_dimensions['width']);
				$('#pp_fade_'+pp_settings.photo_id).fadeIn(pp_settings.animation_speed);
				if(isSet&&_getFileType(pp_images[set_position])=="image" && pp_settings.show_hoverbutton){
					$('#pp_hoverContainer_'+pp_settings.photo_id).show();
				}else{
					$('#pp_hoverContainer_'+pp_settings.photo_id).hide();
				}
				if(pp_dimensions['resized']){
					$('#pp_expand_'+pp_settings.photo_id).show();
				}else{					
					$('#pp_expand_'+pp_settings.photo_id).hide();
				}
				$('#pp_expand_'+pp_settings.photo_id).attr('href',_get_imagelink(pp_images[set_position]));
				$('#pp_expand_'+pp_settings.photo_id).attr('target','_blank');
				$('#pp_expand_'+pp_settings.photo_id).show();
				if(pp_settings.autoplay_slideshow&&!pp_slideshow&&!pp_open)$.prettyPhoto.startSlideshow();
				if(pp_settings.deeplinking)setHashtag();
				pp_settings.changepicturecallback();
				pp_open=true;});
		_insert_gallery();
	};

	function _hideContent(callback){
		$('#pp_full_res_'+pp_settings.photo_id+' object,#pp_full_res_'+pp_settings.photo_id+' embed').css('visibility','hidden');		
		$('#pp_fade_'+pp_settings.photo_id).fadeOut(pp_settings.animation_speed,function(){$('#pp_loaderIcon_'+pp_settings.photo_id).show();callback();});
	};

	function _checkPosition(setCount){
		(setCount>1)?$('#pp_nav_'+pp_settings.photo_id).show():$('#pp_nav_'+pp_settings.photo_id).hide();
	};

	function _fitToViewport(width,height){
		resized=false;
		_getDimensions(width,height);
		imageWidth=width,imageHeight=height;
		if(((pp_containerWidth>windowWidth)||(pp_containerHeight>windowHeight))&&doresize&&settings.allow_resize&&!percentBased)
		{
			resized=true,fitting=false;
			while(!fitting){
				if((pp_containerWidth>windowWidth)){
					imageWidth=(windowWidth-200);
					imageHeight=(height/width)*imageWidth;
				}else if((pp_containerHeight>windowHeight)){
					imageHeight=(windowHeight-200);imageWidth=(width/height)*imageHeight;
				}else{fitting=true;};
				pp_containerHeight=imageHeight,pp_containerWidth=imageWidth;
			};
			_getDimensions(imageWidth,imageHeight);
			if((pp_containerWidth>windowWidth)||(pp_containerHeight>windowHeight)){
				_fitToViewport(pp_containerWidth,pp_containerHeight)
			};
		};
		return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+(settings.horizontal_padding*2),contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:resized};
	};

	function _fitToViewport2(width,height){
		resized=false;		
		imageWidth=width,imageHeight=height;
		pp_containerWidth=settings.default_width;
		pp_containerHeight=settings.default_height;
		
		if(((imageWidth>pp_containerWidth)||(imageHeight>pp_containerHeight))&&doresize&&settings.allow_resize&&!percentBased)
		{
			resized=true,fitting=false;
			while(!fitting){
				if((imageWidth>pp_containerWidth)){
					imageWidth=(pp_containerWidth-50);
					imageHeight=(height/width)*imageWidth;
				}else if((imageHeight>pp_containerHeight)){
					imageHeight=(pp_containerHeight-50);
					imageWidth=(width/height)*imageHeight;
				}else{fitting=true;};			
			};		
		};	
		_getSizePopup();		
		return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+(settings.horizontal_padding*2),contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:resized};
	};
	
	function _fitToViewport3(width,height){
		resized=false;		
		imageWidth=width,imageHeight=height;
		pp_containerWidth = pp_settings.default_width;
		pp_containerHeight = pp_settings.default_height;
		
		if(imageWidth > pp_containerWidth && doresize&&settings.allow_resize && !percentBased){
			resized=true,fitting=false;
			while(!fitting){
				if((imageWidth>pp_containerWidth)){
					imageWidth=(pp_containerWidth-50);					
				}else{fitting=true;};			
			};		
		};	
		
		_getSizePopup3(imageHeight);		
		return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+(pp_settings.horizontal_padding*2),contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:resized};
	};

function _fitSize(){
	resized=true;
	imageWidth=pp_settings.default_width;
	imageHeight=pp_settings.default_height;	
	_getSizePopup();
	return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+(settings.horizontal_padding*2),contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:resized};
};

function _getDimensions(width,height){
	width=parseFloat(width);
	height=parseFloat(height);
	$pp_details=$('#pp_pic_holder_'+settings.photo_id).find('.pp_details');
	$pp_details.width(width);
	detailsHeight=parseFloat($pp_details.css('marginTop'))+parseFloat($pp_details.css('marginBottom'));
	$pp_details=$pp_details.clone().addClass(settings.theme).width(width).appendTo($('body')).css({'position':'absolute','top':-10000});
	detailsHeight+=$pp_details.height();
	detailsHeight=(detailsHeight<=34)?36:detailsHeight;
	if($.browser.msie&&$.browser.version==7)detailsHeight+=8;$pp_details.remove();
	$pp_title=$('#pp_pic_holder_'+settings.photo_id).find('.ppt');
	$pp_title.width(width);
	titleHeight=parseFloat($pp_title.css('marginTop'))+parseFloat($pp_title.css('marginBottom'));
	$pp_title=$pp_title.clone().appendTo($('body')).css({'position':'absolute','top':-10000});
	titleHeight+=$pp_title.height();
	$pp_title.remove();
	pp_contentHeight=height+detailsHeight;
	//pp_contentHeight=height;
	pp_contentWidth=width;
	pp_containerHeight=pp_contentHeight+titleHeight+$('#pp_pic_holder_'+settings.photo_id).find('.pp_top').height()+$('#pp_pic_holder_'+settings.photo_id).find('.pp_bottom').height();
	pp_containerWidth=width;
};

function _getSizePopup(){	
	pp_contentWidth = pp_settings.width_content;
	pp_contentHeight = pp_settings.height_content;
	pp_containerWidth= pp_settings.width_popup;
	pp_containerHeight= pp_settings.height_popup;
};

function _getSizePopup3(imageHeight){	
	
	pp_contentWidth = pp_settings.width_content;
	if(imageHeight > pp_settings.default_height)
		pp_contentHeight = imageHeight+(pp_settings.height_content-pp_settings.default_height);
	else
		pp_contentHeight=pp_settings.height_content;
	
	pp_containerWidth=pp_settings.width_popup;	
	if(imageHeight > pp_settings.default_height)
		pp_containerHeight=imageHeight+(pp_settings.height_popup-pp_settings.default_height);
	else
		pp_containerHeight = pp_settings.height_popup;	
};
	
function _getFileType(itemSrc){
	if(itemSrc.match(/youtube\.com\/watch/i)){
		return'youtube';
	}else if(itemSrc.match(/vimeo\.com/i)){
		return'vimeo';
	}else if(itemSrc.match(/\b.mov\b/i)){
		return'quicktime';
	}else if(itemSrc.match(/\b.swf\b/i)){
		return'flash';
	}else if(itemSrc.match(/\biframe=true\b/i)){
		return'iframe';
	}else if(itemSrc.match(/\bajax=true\b/i)){
		return'ajax';
	}else if(itemSrc.match(/\bcustom=true\b/i)){
		return'custom';
	}else if(itemSrc.substr(0,1)=='#'){
		return'inline';
	}else{
		return'image';
	};
};

function _center_overlay(){	
	if(doresize && typeof $('#pp_pic_holder_'+pp_settings.photo_id)!='undefined'){
		scroll_pos=_get_scroll();
		contentHeight=$('#pp_pic_holder_'+pp_settings.photo_id).height(),contentwidth=$('#pp_pic_holder_'+pp_settings.photo_id).width();
		projectedTop=(windowHeight/2)+scroll_pos['scrollTop']-(contentHeight/2);
		if(projectedTop<0)projectedTop=0;
		if(contentHeight>windowHeight){
		//	return;
		}
		$('#pp_pic_holder_'+pp_settings.photo_id).css({'top':projectedTop,'left':(windowWidth/2)+scroll_pos['scrollLeft']-(contentwidth/2)});
	};
};

function _get_scroll(){
	if(self.pageYOffset){
		return{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset};
	}else if(document.documentElement&&document.documentElement.scrollTop){
		return{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};
	}else if(document.body){
		return{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft};
	};
};

function _get_imagelink(image){
	var link=image;
	if(!image.match(/secondary/gi)){
		if(image.match(/preview/gi))
			link = image.replace('preview','main');
		else
			link = image.replace('large','main');
	}else{		
		link = image.replace('/large','');
	}
	return link;
};

function _resize_overlay(){
	windowHeight=$(window).height(),windowWidth=$(window).width();
	if(typeof $pp_overlay!="undefined")$pp_overlay.height($(document).height()).width(windowWidth);
};
function _insert_gallery(){
	if(isSet && pp_settings.overlay_gallery&&_getFileType(pp_images[set_position])=="image" && (pp_settings.ie6_fallback&&!($.browser.msie&&parseInt($.browser.version)==6))){
		itemWidth=52+5;
		navWidth=(pp_settings.theme=="facebook" || pp_settings.theme=="pp_default")?50:30;
		itemsPerPage=Math.floor((pp_dimensions['containerWidth']-100-navWidth)/itemWidth);
		itemsPerPage=(itemsPerPage<pp_images.length)?itemsPerPage:pp_images.length;
		totalPage=Math.ceil(pp_images.length/itemsPerPage)-1;
		if(totalPage==0 || pp_settings.show_thumbnailbutton==false){
			navWidth=0;		
			$('#pp_gallery_previous_'+pp_settings.photo_id).hide();
			$('#pp_gallery_next_'+pp_settings.photo_id).hide();			
		}else{
			//$pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').show();
			$('#pp_gallery_previous_'+pp_settings.photo_id).show();
			$('#pp_gallery_next_'+pp_settings.photo_id).show();
		};
		galleryWidth=itemsPerPage*itemWidth;
		fullGalleryWidth=pp_images.length*itemWidth;		
		$('#pp_gallery_'+pp_settings.photo_id).find('li.selected').removeClass('selected');
		goToPage=(Math.floor(set_position/itemsPerPage)<totalPage)?Math.floor(set_position/itemsPerPage):totalPage;
		$('.list_galley_'+pp_settings.photo_id).filter(':eq('+set_position+')').addClass('selected');
	}else{
		$('#pp_content_'+pp_settings.photo_id).unbind('mouseenter mouseleave');
	}
}

function _build_overlay(caller){	

	pp_settings.markup=$('#pretty_popup_'+pp_settings.photo_id).html();
	$('#pretty_popup_'+pp_settings.photo_id).html(pp_settings.markup.replace('{pp_social}',(pp_settings.social_tools)?settings.social_tools:''));	
	
	/*
	 * add div over
	 */
	$('#pretty_popup_'+pp_settings.photo_id).after('<div class="pp_overlay"></div>');
	$pp_overlay=$('div.pp_overlay');
	$pp_overlay.css({'opacity':0,'height':$(document).height(),'width':$(window).width()}).bind('click',function(){if(!pp_settings.modal)$.prettyPhoto.close();});
	/*
	 * create list thumbnail
	 */
	
	if(isSet && pp_settings.overlay_gallery){
		currentGalleryPage=0;toInject="";		
		for(var i=0;i<pp_images.length;i++){
			if(!pp_images[i].match(/\b(jpg|jpeg|png|gif)\b/gi)){
				classname='default';img_src='';
			}else{
				classname='list_galley_'+pp_settings.photo_id;
				img_src=pp_images[i];
			}
			toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='"+pp_settings.thumbnail_size+"' height='"+pp_settings.thumbnail_size+"' alt='' /></a></li>";
		};		
		/*
		 * add list image
		 */
		
		pp_settings.gallery_markup=$('#pp_listimage_'+pp_settings.photo_id).html();		
		$('#pp_listimage_'+pp_settings.photo_id).html(pp_settings.gallery_markup.replace('{pp_gallery}',toInject));
		
		/*
		 * add event to image element
		 */
		$('#pp_gallery_next_'+pp_settings.photo_id).click(function(){$.prettyPhoto.changeGalleryPage('next');$.prettyPhoto.stopSlideshow();return false;});
		$('#pp_gallery_previous_'+pp_settings.photo_id).click(function(){$.prettyPhoto.changeGalleryPage('previous');$.prettyPhoto.stopSlideshow();return false;});		
		if(pp_settings.show_hoverbutton==true){			
			$('#pp_content_'+pp_settings.photo_id).hover(function(){$('#pp_pic_holder_'+pp_settings.photo_id).find('#pp_gallery_'+pp_settings.photo_id+':not(.disabled)').fadeIn();},function(){$('#pp_pic_holder_'+pp_settings.photo_id).find('#pp_gallery_'+pp_settings.photo_id+':not(.disabled)').fadeOut();});
		}
		itemWidth=52+5;
		$('.list_galley_'+pp_settings.photo_id).each(function(i){$(this).find('a').click(function(){$.prettyPhoto.changePage(i);$.prettyPhoto.stopSlideshow();return false;});});
	};
	
	if(pp_settings.slideshow){		
		$('#pp_pic_holder_'+pp_settings.photo_id).find('.pp_play').click(function(){$.prettyPhoto.startSlideshow();return false;});
	}
	
	$('#pp_close_'+pp_settings.photo_id).bind('click',function(){$.prettyPhoto.close();return false;});	
	$('#pp_previous_'+pp_settings.photo_id+',#pp_arrow_previous_'+pp_settings.photo_id).bind('click',function(){$.prettyPhoto.changePage('previous');$.prettyPhoto.stopSlideshow();return false;});
	$('#pp_next_'+pp_settings.photo_id+',#pp_arrow_next_'+pp_settings.photo_id).bind('click',function(){$.prettyPhoto.changePage('next');$.prettyPhoto.stopSlideshow();return false;});
	_center_overlay();
};
if(!pp_alreadyInitialized&&getHashtag()){
	pp_alreadyInitialized=true;
	hashIndex=getHashtag();
	hashRel=hashIndex;
	hashIndex=hashIndex.substring(hashIndex.indexOf('/')+1,hashIndex.length-1);
	hashRel=hashRel.substring(0,hashRel.indexOf('/'));
	setTimeout(function(){$("a[rel^='"+hashRel+"']:eq("+hashIndex+")").trigger('click');},50);
}
return this.unbind('click.prettyphoto').bind('click.prettyphoto',$.prettyPhoto.initialize);};
function getHashtag(){
	url=location.href;
	hashtag=(url.indexOf('#!')>0)?url.substring(url.indexOf('#!')+2,url.length):false;
	return decodeURI(hashtag);
};
function setHashtag(){
	if(typeof theRel=='undefined')return;
	location.hash='!'+theRel+'/'+rel_index+'/';
};
function getParam(name,url){
	name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS="[\\?&]"+name+"=([^&#]*)";
	var regex=new RegExp(regexS);
	var results=regex.exec(url);
	return(results==null)?"":results[1];
	}
})(jQuery);
var pp_alreadyInitialized=false;