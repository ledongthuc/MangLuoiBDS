function crollTop(){
	$('body,html').animate({scrollTop:$("#mainright").offset().top},800);
}

function loadMap(lat,lng,text,url){
	jQuery('.facebook1').bPopup({
    	 content:'iframe',
         contentContainer:'#map',
         loadUrl: url+'bando.php?lat='+ lat +'&lng='+ lng +'&text='+ text 
 	});
}