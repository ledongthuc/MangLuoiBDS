<?php
/*****************************************************************************
/  Module - Infinity (MyGosu) Menus 2005/04/25
/  Version  1-0-8
/  Copyright Guy Thomas [brudinie]   
/  brudinie@yahoo.co.uk
/  @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
/
/  Javascript Drop Down & Tree Menu Systems by Cezary Tomczak (Mygosu) (modded by Guy Thomas)
/  Mygosu: - http://gosu.pl/dhtml/mygosumenu.html
*****************************************************************************/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class mygosu_menus {
/*==========================================================================*/
/*                        START OF CLASS mygosu_menus                       */
/*==========================================================================*/
	var $menuUNID;
	var $menuType;
	var $menuObject; // php object determined by menu type
	var $cssRoot;
	var $browserInfo;
		
	function mygosu_menus( &$params){
		/**
		/* Function Desc- Code to be called on instantiation of class
		/* - Gives menu unique id so that multiple menus can be used
		/* - Sets up some basic class properties
		/* - Calls startup functions
		*/
		
		/**
		/* Give menu unique id
		*/		
		$cntr=isset( $GLOBALS['IMenu'] ) ? $GLOBALS['IMenu'] : 0; //IIS FIX by Eric Benzacar 2005/07/05 ~ bug reported by Kevin McNally 2005/06/30 (check variable exists before assigning)
		$cntr=intval($cntr)+1;
		$GLOBALS['IMenu']=$cntr;
		
		$this->menuUNID="infinity_menu_$cntr"; // menu counter (mod June 07 2005)
	
		/**
		/* Write html to indicate that module has started
		*/
		$this->module_begin($params);
	
		/**
		/* Set up basic class properties
		*/
		$this->menuType = $params->get('menu_type');	
				
		/**
		/* Load style sheets
		*/
		$cssFileFound=$this->LoadStyleSheet ($params);
		
		/**
		/* Set css root from parameter if successfull css load ELSE set default
		*/
		if ($cssFileFound){
			$this->cssRoot = $params->get('css_root_class');		
		} else {
			$this->cssRoot = "default";
		}
		
		require_once("browser_info.php");		

		/**
		/* Mozilla - Apply internal CSS from paramters (override CSS from linked file)
		*/		
		$this->browserInfo=new browser_info();
		if ($this->browserInfo->type!="ie"){
			$this->ApplyAllInternalCSS($params);
		}
				
		/**
		/* Set up php menu object		
		*/
		$this->CreateMenuObject($params, $this->menuUNID, $this->cssRoot);

	}
	
	function module_begin( &$params ) { 
		/**
		/* Function Desc- Module start comments
		*/
		echo "\n <!--(c) Infinity Menus For Mambo - Guy Thomas 2005 ". $params->get( 'website' ) ." -->";
		echo "\n\n <!-- START OF MODULE '". $params->get( 'module_name' ) ."'   -->";
		echo "\n";			
		
	}
	
	function CreateMenuObject (&$params){
			/**
			* Function Desc - Instantiates menuObject according to required menu type
			*/
			/*echo ("<script type='text/javascript'>alert ('attempting to create menu object of type $this->menuType');</script>");*/
			switch ($this->menuType){						
				case "tree":
				require_once("menu_tree.php");
				$this->menuObject=new menu_tree($params, $this->menuUNID, $this->cssRoot);
				/*echo ("<script type='text/javascript'>alert ('tree menuObject instantiated');</script>");*/
				break;
				
				case "drop_down":
				require_once("menu_drop_down.php");
				$this->menuObject=new menu_dropdown($params, $this->menuUNID, $this->cssRoot, $this->browserInfo);
				/*echo ("<script type='text/javascript'>alert ('drop down menuObject instantiated');</script>");*/
				break;
			}
	}
		
	function ApplyAllInternalCSS(&$params){
		/**
		/* Function desc - Apply internal CSS to parent and sub menu items from paramters (override CSS from linked file)
		*/
		
		require_once("menu_css_overrides.php");
		
		$cssOverrides= new css_overrides ( $params, $this->cssRoot );
		$cssOverrides->menuUNID=$this->menuUNID;
		// Apply override values to all anchors
		$cssOverrides->GenerateInternalCSS("a");
		
		// Apply css specific to tree menu
		if ($params->get('menu_type')=="tree"){
			$cssOverrides->GenerateInternalCSS(".folder");
		}		
		
		// Apply css specific to drop down menu
		if ($params->get('menu_type')=="drop_down"){
			// Create override values style string for parent item
			$cssOverrides->GenerateInternalCSS(".parentItem");
			// Append override values to style string for sub menu classes
			$cssNumMenus = $params->get('css_num_menus'); // max number of css repeat val
			if (intval($cssNumMenus) == 0){
				$cssNumMenus=1;
			}							
			for ($si=1; $si<=$cssNumMenus; $si++){
				$cssOverrides->GenerateInternalCSS(".subItem_$si");
			}
		}
		$styleStr=$cssOverrides->htmlStr;
		$javaScriptStr=str_replace('"', '\"',$cssOverrides->jsStr);		
		?>
		<!--Apply $css Overrides to style attribute of doc head-->
		<script type='text/javascript'>
		<!--
		// original code from http://developer.apple.com/internet/webcontent/examples/styley_source.html		
		// setStyleByClass: given an element type and a class selector,
		// style property and value, apply the style.
		// args:
		//  t - type of tag to check for (e.g., SPAN)
		//  mi - menu id
		//  c - class name
		//  p - CSS properties - mod by Guy Thomas (use array)
		//  v - values - mod by Guy thomas (use array)
		// NOTE - both p and v must have equal number of items

		function setStyleByClass(t, mi, c,p,v){
			c=c.replace(".","");			
			var rootObj=eval(document.getElementById(mi));
			var elements;
			elements = rootObj.getElementsByTagName(t);			
			for(var i = 0; i < elements.length; i++){
				var node = elements.item(i);
				for(var j = 0; j < node.attributes.length; j++) {
					if(node.attributes.item(j).nodeName == 'class') {
						if(node.attributes.item(j).nodeValue == c) {
							// Mod by Guy Thomas 2005/07/12 - use array
							for (pn=0; pn<p.length; pn++){
								eval('node.style.' + p[pn] + " = '" +v[pn] + "'");
							}
						}
					}
				}
			}
		}

		
		var head = document.getElementsByTagName('head').item(0);
		var headStl = head.getElementsByTagName('style').item(0);
		if (!headStl){
			// make a style element and append to head!
			var headStl=document.createElement('style');
			head.appendChild(headStl); 					

		}					
		var stlstr = '<?php echo (str_replace("\t"," ",str_replace("\n","","$styleStr")))?>';
		
		if (document.body.currentStyle){
			// IE Code
			var onloadStr="<?php echo (str_replace("\n"," ","$javaScriptStr")); ?>";
			function <?php echo($this->menuUNID)?>_styleFix(){eval(onloadStr);};
			if (onloadStr!=""){
				//window.attachEvent('onload', <?php echo($this->menuUNID)?>_styleFix);
				<?php echo($this->menuUNID)?>_styleFix();
			}
		} else {
			// Mozilla Code
			var stNode=document.createTextNode(stlstr);
			headStl.appendChild(stNode);
		}
		-->
		</script>
		<?php
	}
	
	function mygosu_menu_items ( $database, $mygid, &$params, $parentID, $level, $cssRepeatNum) {
		/**
		/* Function Desc- loads mygosu menu items (calls recursively)
		*/

		if (!$parentID){$parentID=0;} // necessary for root sections
		if (!$level){$level=0;} // necessary for root sections	
		$query = "SELECT * FROM #__menu "
		. "\n WHERE menutype = '". $params->get( 'menu' ) ."' "
		. "\n AND access <= $mygid "
		. "\n AND published = '1' "
		. "\n AND parent = '$parentID'"
		. "\n ORDER BY '". $params->get( 'order' ) ."' ASC ";
		$cssNumMenus = $params->get('css_num_menus'); // max number of css repeat val
		if ($cssRepeatNum == 0 || $cssRepeatNum>$cssNumMenus){
			$cssRepeatNum=1;
		}
		
		$database->setQuery( $query );
		$menus = $database->loadObjectList( ); 		

		$numRows=0;
		
		
		foreach ( $menus as $row ) {
			// MambelFish Support - Converts menu items if necessary
			$numRows++;
			if( isset($GLOBALS['mosConfig_mbf_content']) && ($GLOBALS['$mosConfig_mbf_content']) ){  // FIX by Eric Benzacar 2005/07/05 ~ bug reported by Kevin McNally 2005/06/30
				$row 	= MambelFish::translate( $row, 'menu', $GLOBALS['$mosConfig_lang']);
			}
			$name 	= htmlentities ($row->name, ENT_QUOTES); // remove ilegal characters
			$link 	= $row->link ? $row->link : NULL;
			$currentID = $row->id;
			
			/**
			/* Does this menu item have sub menu items?
			*/			
			$subMenus=mygosu_menus::checkSubMenus ($currentID, $mygid, $params, $database);
			
			/**
			* Adds Itemid if link is not a url
			*/
			if ( $row->type != 'url' ) {
				$link .= '&Itemid='. $row->id;
			}
			
			/**
			* Controls the page the link will be opened in
			*/
			if ( $row->browserNav ) {
					$target = "'_blank'";
			} else {
					$target = "'_self'";
			}			
				
			if ($numRows==1){
				//open menu									
				$this->menuObject->StartMenu($level);
			}
			
			// create new menu item
			$this->menuObject->NewItem($level, $params, $row, $subMenus, $name, $cssRepeatNum, $target, $link);		
			
			// recurrsive call		
			$this->mygosu_menu_items ( $database, $mygid, &$params, $currentID, $level+2, $cssRepeatNum+1);
			
			// close menu item
			$this->menuObject->CloseItem($level); // close list after recurrsive call to get subsections				
			

		}
		if ($numRows>0){		
			// close section of menu
			$this->menuObject->CloseMenuSection($level);
		} 
	}

	//---------------------------------------------------------------------	
	
	function getMenuImage(&$menu_param){
		//This function gets the menu image value from the parameters list
		$mStart=strpos($menu_param,"menu_image=");
		if ($mStart===false){return("");}
		$mLeft=substr($menu_param, $mStart);
		$mEnd=strpos($mLeft, chr(10)); 
		if (!$mEnd){$mEnd=strlen($menu_param);}
		$menuImage=substr($mLeft, 0, $mEnd);
		return (str_replace("menu_image=", "", $menuImage));
	}
	
	function resizeMenuImage (&$imgLoc, &$w, &$h){	
	
		$w=trim(str_replace("px", "", $w));
		$h=trim(str_replace("px", "", $h));	
		
		/**
		/* Test GD support (if no support then return image unsized) (New in v 1.0.6)
		*/
		if (!function_exists("imagecreatetruecolor")){
			return($imgLoc);
		}

		$size = getimagesize($imgLoc); // Get the image dimensions and mime type 
		$rposFile=strrpos($imgLoc, ".");
		$extension=substr($imgLoc,$rposFile); // use extension instead of mime type (cope with gif)
		$fileName=basename($imgLoc);
		$filePath=dirname($imgLoc);
		/*
		echo ("<script type='text/javascript'>alert('".$extension."');</script>");
		*/
				
		switch (strtolower($extension)){
			case ".gif" : 
				$resize = imagecreate($w, $h); // Create a blank image
				$tmpImg=imagecreatefromgif ($imgLoc);
				$colorTransparent = imagecolortransparent($tmpImg);
				imagepalettecopy($resize,$tmpImg);
				imagefill($resize,0,0,$colorTransparent);
				imagecolortransparent($resize, $colorTransparent);				
				imagecopyresampled($resize, $tmpImg, 0, 0, 0, 0, $w, $h, $size[0], $size[1]); // Resample the original GIF
				imagegif($resize, $filePath.'/thumb_'.$fileName); // Output the new GIF 
				break;

			case ".jpg" :		
				$resize = imagecreatetruecolor($w, $h); // Create a blank image
				$tmpImg=imagecreatefromjpeg ($imgLoc);
				imagecopyresampled($resize, $tmpImg, 0, 0, 0, 0, $w, $h, $size[0], $size[1]); // Resample the original JPEG 
				imagejpeg($resize, $filePath.'/thumb_'.$fileName, $quality); // Output the new JPEG 
				break;

			case ".jpeg" :
				$resize = imagecreatetruecolor($w, $h); // Create a blank image
				$tmpImg=imagecreatefromjpeg ($imgLoc);
				imagecopyresampled($resize, $tmpImg, 0, 0, 0, 0, $w, $h, $size[0], $size[1]); // Resample the original JPEG 
				imagejpeg($resize, $filePath.'/thumb_'.$fileName, $quality); // Output the new JPEG 
				break;

			case ".png" :
				$resize = imagecreatetruecolor($w, $h); // Create a blank image
				$tmpImg=imagecreatefrompng ($imgLoc);
				imagecopyresampled($resize, $tmpImg, 0, 0, 0, 0, $w, $h, $size[0], $size[1]); // Resample the original PNG
				imagepng($resize, $filePath.'/thumb_'.$fileName); // Output the new PNG
				break;
	
		}
		if ($tmpImg){
			imagedestroy($tmpImg);
			return ($GLOBALS["mosConfig_live_site"]."/images/stories/thumb_".$fileName);
		}
	}
	
	function checkSubMenus (&$currentID, &$mygid, &$params, &$database){
		// does current menu item have any sub menu items?
		$smQuery = "SELECT * FROM #__menu "
		. "\n WHERE menutype = '". $params->get( 'menu' ) ."' "
		. "\n AND access <= $mygid "
		. "\n AND published = '1' "
		. "\n AND parent = '$currentID'"
		. "\n ORDER BY '". $params->get( 'order' ) ."' ASC ";
		$database->setQuery( $smQuery );
		$subMenus = $database->loadObjectList();
		if ($subMenus) {return(true);}
	}
	
	function showImage(&$row, &$params, &$menuImgStr, &$spanStyle){
		/**
		/* Function Desc- If an image can be displayed it will set $menuImgStr to
		/* a string of html to be used
		*/
		$menuImage = mygosu_menus::getMenuImage($row->params);
		/*echo ("<script type='text/javascript'>alert ('name = ".$row->name." image = ".$menuImage."');</script>");*/
		$imgLoc=$GLOBALS["mosConfig_absolute_path"]."/images/stories/".$menuImage;
		if (!file_exists($imgLoc)){return("");} // if image doesn't exist then return ""
		if ($menuImage!="" && $menuImage!="-1"){
			$spanStyle=" style='margin:0px 0px 0px ".($params->get('img_resizew')+2)."px;'";					
			if ( $params->get( 'img_resize')){						
				$thumb=mygosu_menus:: resizeMenuImage ($imgLoc, $params->get('img_resizew'), $params->get('img_resizeh'));
				if ($thumb){
					$menuImgStr="<img class='lftImg' border='0' src='".htmlspecialchars($thumb)."' alt='menu_thumb'/>";								
				}
			}
			If ($menuImgStr==""){
				$menuImgStr="<span><img class='lftImg' border='0' src='".$GLOBALS["mosConfig_live_site"]."/images/stories/".htmlspecialchars($menuImage)."' alt='menu_thumb'/></span>";					
			}										
		}
	}
	
	function module_end( &$params ) {
		/**
		/* Function Desc - Module - load script & end comments
		*/
		
		$this->menuObject->LoadScript (&$params); // load mygosu menu system
	
		/**
		/* IE Apply internal CSS from paramters (override CSS from linked file)
		*/
		if ($this->browserInfo->type=="ie"){
			$this->ApplyAllInternalCSS($params);
		}
	
		echo "\n";
		echo "<!-- END OF MODULE '". $params->get( 'module_name' ) ."'   --> \n\n\n";
	}
		
	
	function LoadStyleSheet (&$params){
		/**
		/* load stylesheet
		*/
		
		// Make sure css exists first - if not use default.	
		if ($this->menuType=="tree"){$cssFolder="tree/";} else {$cssFolder="dropdown/";}				
		
		$cssFile=$cssFolder.$params->get('css_file'); // tree menu css file
		
		$templatePath=$GLOBALS['mosConfig_absolute_path']."/modules/infinity_menus/css/".$cssFile; // BUG Fix by Eric Benzacar 2005/07/05~ reported by Kevin McNally 2005/06/30 - $GLOBALS was missing quotes
		echo ("<!--File to check for is ".$templatePath."-->");
		?>
		<script type='text/javascript'>
		<!--
		function importStyleSheet(shtName){
			// add style sheet via javascript
			var link = document.createElement( 'link' );
			link.setAttribute( 'href', shtName );
			link.setAttribute( 'type', 'text/css' );
			link.setAttribute( 'rel', 'stylesheet' );			
			var head = document.getElementsByTagName('head').item(0);
			head.appendChild(link);
		}
		-->
		</script>
		<?php
		if (file_exists($templatePath)){		
			?>		
			<!--<link rel="stylesheet" type="text/css" href="<?php echo $params->get( 'LSPath' )."/css/".$cssFile;?>" /> -->
			<script type='text/javascript'>
			<!--
				importStyleSheet('<?php echo $params->get( 'LSPath' )."/css/".$cssFile;?>');
			-->
			</script>
			<?php
			echo ("<!--CSS file exists (".$templatePath.")-->");
			return (true); // loaded OK			
		} else {
			?>
			<!--<link rel="stylesheet" type="text/css" href="<?php echo $params->get( 'LSPath' )."/css/".$cssFolder."default.css";?>" />-->
			<script type='text/javascript'>
			<!--
				importStyleSheet('<?php echo $params->get( 'LSPath' )."/css/".$cssFolder."default.css";?>');
			-->	
			</script>			
			<?php
			echo ("<!--CSS file does not exist (".$templatePath.")-->");
			echo ("<!--Using css ".$params->get( 'LSPath' )."/css/".$cssFolder."default.css"."-->");
			return (false); // couldnt load so replaced with default			
		}
	}
	
/*==========================================================================*/
/*                         END OF CLASS mygosu_menus                        */
/*==========================================================================*/
}	


?>