<?php
class GoogleMap{
	public function __construct($style,$zoom,$longitude,$laltitude){
		$this->control='disableDefaultUI:true,zoom:'.$zoom.',center: new google.maps.LatLng('.$longitude.','.$laltitude.'),';
		$this->Type($style);$this->condition='';
	} 
	public function Control($tmp=array()){
		$tmp2=explode('-',$tmp);
		foreach ($tmp2 as $value) {
			switch ($value){
				case 'zoom':$this->control.='zoomControl:true,'; break;
				case 'preview':$this->control.='overviewMapControl:true,overviewMapControlOptions:{opened:true},';break;
				case 'scale':$this->control.='scaleControl:true,';break;
				case 'street':$this->control.='streetViewControl:true';break;
				case 'pan':$this->control.='panControl:true,';break;
			}
		}
	} 
	public function Type($style){
		switch ($style){
			case 'road': $this->control.='mapTypeId: google.maps.MapTypeId.ROADMAP,';break;
			case 'earth':$this->control.='mapTypeId: google.maps.MapTypeId.SATELLITE,';break;
			case 'mix':$this->control.='mapTypeId: google.maps.MapTypeId.HYBRID,';break;
			case 'geo':$this->control.='mapTypeId: google.maps.MapTypeId.TERRAIN,';break;
		}
	} 
	public function Condition($condition=array()){
		$tmp1=explode(',',$condition);
			foreach ($tmp1 as $condition){
				$tmp2=explode('~',$condition); 
				$this->condition.='{where:"'.$tmp2[0].'",markerOptions:{iconName:"'.$tmp2[1].'"} },';		
			}
	}
	public function Layer($table){
		$this->layer='layer=new google.maps.FusionTablesLayer({query:{select: \'*\',from: \''.$table.'\'},styles:['.$this->condition.'],suppressInfoWindows:true});
		layer.setMap(map);google.maps.event.addListener(layer, \'click\', function(e) {ajax_mapbds(e.row[\'id\'].value);});';				
	} 
	public function Info($json){
		$this->ajax='
			function ajax_mapbds(idx){
				nmaker=idx;  
				// Index Sidebar 
				$(".fitem").css("background","#FFF");
				
				$.each($(".items-icon"), function(){
					$(this).attr("style","background:none");
				});						
				var loaitin = $("#list-normal-home-"+idx).attr("class");
				if(loaitin == \'fitem loai_tin3\'){
					$("#list-normal-home-"+idx).children().css("background","url('.JURI::base().'templates/mlbds/images/arr1.png) no-repeat left center");
				}else if(loaitin == \'fitem loai_tin2\'){
					$("#list-normal-home-"+idx).children().css("background","url('.JURI::base().'templates/mlbds/images/arr2.png) no-repeat left center");
				}else{
					$("#list-normal-home-"+idx).children().css("background","url('.JURI::base().'templates/mlbds/images/arr3.png) no-repeat left center");
				}  		
				
				var stt=$("#list-normal-home-"+idx).attr("stt"); 
				$("#list-map").scrollTop(78*(stt-3));
				
				$.ajax({url:\''.JURI::base().$json.'\',
					data:{id:idx},
					type:\'POST\',
					success:function(datatmp){
					var data = 	datatmp.split("#@#",3);
					var kinhdo = data[0];
					var vido   = data[1];
					var info   = data[2];		
					marker=lmaker[idx];   
					map.setCenter(new google.maps.LatLng(kinhdo,vido));
					infowindow.setContent(info);  
					infowindow.open(map,marker);	
					}					
				});	
			}
		';
	}
	public function Marker() {
		$this->marker='var listmk=datax, nmaker;
		
		for (i=0;i<listmk.length;i++){
			
			marker=new google.maps.Marker({
				position:new google.maps.LatLng(listmk[i].kinh_do,listmk[i].vi_do),
				title:"",
				icon:"'.JURI::root().'/images/maps/nha_huong.png",   
				map:map,
			}); 
			lmaker[listmk[i].id]=marker;
			var k=listmk[i].id;
			jQuery("#list-normal-home-"+k).click(function(){ 
				var id=jQuery(this).attr("id").split("-")[3]; 
				var marker=lmaker[id];
				google.maps.event.trigger(marker, "click"); 
			});
			
			jQuery("#list-normal-home-"+k).mouseover(function(){  
				var id=jQuery(this).attr("id").split("-")[3]; 
				google.maps.event.trigger(lmaker[id], "mouseover");   
			});
			jQuery("#list-normal-home-"+k).mouseout(function(){  
				var id=jQuery(this).attr("id").split("-")[3]; 
				google.maps.event.trigger(lmaker[id], "mouseout");    
			});
			google.maps.event.addListener(marker, "mouseover", function(event) {					
			    this.setIcon("'.JURI::root().'/images/maps/nha_tich.png");
			});
			google.maps.event.addListener(marker, "mouseout", function(event) {					
			    this.setIcon("'.JURI::root().'/images/maps/nha_huong.png"); 
			});
			
			google.maps.event.addListener(marker, \'click\', (function(marker, i) { 	
			
			return function() {
				nmaker
				ajax_mapbds(listmk[i].id);
			}})(marker, i));
		}
		if (lmaker[listmk[0].id]) google.maps.event.trigger(lmaker[listmk[0].id], "click");  
		';
	} 
	public function Start(){
	        echo '<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">var map=null, mapdiv, lmaker=[],infowindow=new google.maps.InfoWindow();'; 
		$this->Map(); 
	}
	public function Map(){ 
		$this->map='function initialize(datax){ 
        sidebar(datax);		  
		mapdiv=document.getElementById(\''.$this->div.'\'); 
		if (map==null) map=new google.maps.Map(mapdiv,{'.$this->control.'});';  
	}
	public function Close(){	
		echo '}</script>';
	} 
	//--------------------------------------------------
	public function Display($div){
		$this->div=$div;
		$this->Start();
			echo $this->ajax;
			echo $this->map;
			echo $this->layer;
			echo $this->marker; 
		$this->Close();
		
	  
	}	
}