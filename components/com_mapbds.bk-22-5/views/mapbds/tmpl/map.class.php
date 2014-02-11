<?php
class GoogleMap{
	public function __construct($style,$zoom,$longitude,$laltitude){
		$this->control='disableDefaultUI:true,zoom:'.$zoom.',center: new google.maps.LatLng('.$longitude.','.$laltitude.'),';
		$this->Type($style);$this->condition='';
	} 
	public function Control($tmp=array()){
		$tmp2=explode('-',$tmp);
		foreach ($tmp2 as $value){
			switch ($value){
				case 'zoom':$this->control.='zoomControl:true,'; break;
				case 'preview':$this->control.='overviewMapControl:true,overviewMapControlOptions:{opened:true},';break;
				case 'scale':$this->control.='scaleControl:true,';break;
				case 'street':$this->control.='streetViewControl:true,';break;
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
		layer.setMap(map);google.maps.event.addListener(layer, \'click\', function(e) {ajax(e.row[\'id\'].value);});';				
	}
	public function Info($json){
		$this->ajax=' 
			function ajax(id){ 
				$.ajax({url:\''.JURI::base().$json.'\',
					data:{\'id\':id},
					type:\'POST\',
					success:function(datatmp){		
					var data = 	datatmp.split("#@#",3);
					var kinhdo = data[0];
					var vido   = data[1];
					var info   = data[2];					
						marker=new google.maps.Marker({
							position:new google.maps.LatLng(kinhdo,vido),
							title:\'\',icon:\' \',map:map});	
						infowindow.setContent(info);
						infowindow.open(map,marker);
					}	 
				});	
			}
		';
	}
	public function Marker($listmk){
		$this->marker='var listmk=eval("("+\'{"results":'.json_encode($listmk).'}\'+")");
		for (i=0;i<listmk.results.length;i++){
			marker=new google.maps.Marker({
				position:new google.maps.LatLng(listmk.results[i].latitude,listmk.results[i].longitude), 
				title:"demo",icon:listmk.results[i].icon,animation:google.maps.Animation.DROP,map:map
			});		
			google.maps.event.addListener(marker, \'click\', (function(marker, i) {
			return function() {ajax(listmk.results[i].id);}})(marker, i));
		}';
	}
	public function Start(){
	        echo '<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
			<script>var map, infowindow=new google.maps.InfoWindow();';
		$this->Map();	 
	}
	public function Map(){
		$this->map='function initialize(){map=new google.maps.Map(document.getElementById(\''.$this->div.'\'),{'.$this->control.'});';
	}
	public function Close(){	
		echo '}google.maps.event.addDomListener(window,\'load\',initialize);</script>';
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