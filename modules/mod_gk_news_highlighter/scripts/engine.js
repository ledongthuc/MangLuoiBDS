window.addEvent("domready",function(){

	Fx.Height = Fx.Style.extend({initialize: function(el,options){$(el).setStyle('overflow','hidden');this.parent(el,'height',options);},toggle:function(){var style=this.element.getStyle('height').toInt();return this.start((style > 0)?(style,0):(0,this.element.scrollHeight));},show:function(){return this.set(this.element.scrollHeight);}});Fx.Opacity=Fx.Style.extend({initialize: function(el, options){this.now = 1;this.parent(el,'opacity',options);},toggle:function(){return this.start((this.now > 0)?(1,0):(0,1));},show:function(){return this.set(1);}});
	
	$ES('.gk_news_highlighter').each(function(el,i){	
		var module_id = el.getProperty("id");
		var $G = $Gavick["gk_news_highlighter"+module_id];
		var wrapper = el; 
		var next, prev = false;
		var item_anim = false;
		//
		if($E('.gk_news_highlighter_interface', el)){
		    next = $E('.next', wrapper);	
		    prev = $E('.prev', wrapper);
		}
		// one sliding
		if($G['animationType'] == 0){
			var wrapper2 = $E('.nowrap', wrapper);
			var w = 0;
			$ES('.nowrap span').each(function(elmt, i){w += elmt.getSize().size.x;});
			var time = (w/$G['animationSpeed']) * 1000;
			var effect = new Fx.Style(wrapper2,'margin-left',{duration: time, transition: Fx.Transitions.linear, onComplete: function(){
				effect.set(el.getSize().size.x);
				effect.start(el.getSize().size.x, -w);	
			}});
			if($G['mouseover']){
				wrapper2.addEvent("mouseenter", function(){effect.stop();});
				wrapper2.addEvent("mouseleave", function(){effect.start(wrapper2.getStyle('margin-left').toInt(), -w);});
			}
			effect.set(el.getSize().size.x);
			effect.start(el.getSize().size.x, -w);
		}
		// Other animation types
		if($G['animationType'] != 0){		
			var items = $ES('.gk_news_highlighter_item', el);
			items.each(function(it){it.setStyle('display', 'block');});
			var effects1 = [];
			var effects2 = [];
			var actual = 0;
			var mouseIsOver = false;
			//
			var timer = (function(){
				if(mouseIsOver == false){
					effects1[actual].toggle();
					if($G['animationType'] == 2) effects2[actual].start(0,-24);
					else if($G['animationType'] == 3) effects2[actual].start(0,24);
					else if($G['animationType'] == 4) effects2[actual].start(0,780);	
					actual++;
					if(actual > items.length-1) actual = 0;
					effects1[actual].toggle();
					if($G['animationType'] == 2 || $G['animationType'] == 6) effects2[actual].start(24,0);
					else if($G['animationType'] == 3 || $G['animationType'] == 7) effects2[actual].start(-24,0);
					else if($G['animationType'] == 4 || $G['animationType'] == 5) effects2[actual].start(-780,0);
				}
			}).periodical($G['animationInterval']);
			//
			if(next){
				next.addEvent('click', function(e){
					new Event(e).stop();
					if(!item_anim){
						item_anim = true;
						(function(){item_anim = false;}).delay($G['animationSpeed']);
						effects1[actual].toggle();
						if($G['animationType'] == 2) effects2[actual].start(0,-24);
						else if($G['animationType'] == 3) effects2[actual].start(0,24);
						else if($G['animationType'] == 4) effects2[actual].start(0,780);	
						actual++;
						if(actual > items.length-1) actual = 0;
						effects1[actual].toggle();
						if($G['animationType'] == 2 || $G['animationType'] == 6) effects2[actual].start(24,0);
						else if($G['animationType'] == 3 || $G['animationType'] == 7) effects2[actual].start(-24,0);
						else if($G['animationType'] == 4 || $G['animationType'] == 5) effects2[actual].start(-780,0);
						$clear(timer);
						timer = (function(){
				    	    if(mouseIsOver == false){
						        effects1[actual].toggle();
						        if($G['animationType'] == 2) effects2[actual].start(0,-24);
						        else if($G['animationType'] == 3) effects2[actual].start(0,24);
						        else if($G['animationType'] == 4) effects2[actual].start(0,780);	
						        actual++;
						        if(actual > items.length-1) actual = 0;
						        effects1[actual].toggle();
						        if($G['animationType'] == 2 || $G['animationType'] == 6) effects2[actual].start(24,0);
						        else if($G['animationType'] == 3 || $G['animationType'] == 7) effects2[actual].start(-24,0);
						        else if($G['animationType'] == 4 || $G['animationType'] == 5) effects2[actual].start(-780,0);
				    	    }
			        	}).periodical($G['animationInterval']);
			        }
				});
				
				prev.addEvent('click', function(e){
					new Event(e).stop();
					if(!item_anim){
						item_anim = true;
						(function(){item_anim = false;}).delay($G['animationSpeed']);
							effects1[actual].toggle();
							if($G['animationType'] == 2) effects2[actual].start(0,-24);
							else if($G['animationType'] == 3) effects2[actual].start(0,24);
							else if($G['animationType'] == 4) effects2[actual].start(0,780);	
							(actual == 0) ? actual = items.length-1 : actual--;
							effects1[actual].toggle();
							if($G['animationType'] == 2 || $G['animationType'] == 6) effects2[actual].start(24,0);
							else if($G['animationType'] == 3 || $G['animationType'] == 7) effects2[actual].start(-24,0);
							else if($G['animationType'] == 4 || $G['animationType'] == 5) effects2[actual].start(-780,0);
							$clear(timer);
							timer = (function(){
				        		if(mouseIsOver == false){
					        		effects1[actual].toggle();
					        		if($G['animationType'] == 2) effects2[actual].start(0,-24);
					        		else if($G['animationType'] == 3) effects2[actual].start(0,24);
					        		else if($G['animationType'] == 4) effects2[actual].start(0,780);	
					        		actual++;
					        		if(actual > items.length-1) actual = 0;
					        		effects1[actual].toggle();
					        		if($G['animationType'] == 2 || $G['animationType'] == 6) effects2[actual].start(24,0);
					        		else if($G['animationType'] == 3 || $G['animationType'] == 7) effects2[actual].start(-24,0);
					       	 		else if($G['animationType'] == 4 || $G['animationType'] == 5) effects2[actual].start(-780,0);
				        		}
			        	}).periodical($G['animationInterval']);
					}
				});
			}
			//
			items.each(function(elm,j){
				elm.setStyle('z-index',items.length - j);
				effects1[j] = new Fx.Opacity(elm, {duration: $G['animationSpeed'], transition: $G['animationFun']});
				//
				if($G['animationType'] == 2 || $G['animationType'] == 3 || $G['animationType'] == 6 || $G['animationType'] == 7){		
				    effects2[j] = new Fx.Style(elm, 'top', {duration: $G['animationSpeed'], transition: $G['animationFun']});
				}else if($G['animationType'] == 4 || $G['animationType'] == 5){		
				    effects2[j] = new Fx.Style(elm, 'left', {duration: $G['animationSpeed'], transition: $G['animationFun']});	
				}
				//
				if(j != 0) effects1[j].hide();
				if($G['animationType'] > 1) effects2[j].set(0);	
			});
			//
			if($G['mouseover']){
				items.addEvent("mouseenter", function(){mouseIsOver = true;});
				items.addEvent("mouseleave", function(){mouseIsOver = false;});
			}
		}
	});
});