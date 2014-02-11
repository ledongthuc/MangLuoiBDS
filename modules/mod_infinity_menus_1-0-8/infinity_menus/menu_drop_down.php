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

class menu_dropdown{
/*==========================================================================*/
/*                        START OF CLASS menu_dropdown                      */
/*==========================================================================*/

var $menuUNID;
var $cssRoot;
var $imgPath;
var $DDownPositioning;
var $DDownHorizMinWidth;
var $DDownOverlapLeft;
var $styleAppend; // styles to append to document head via javascript (mod 2005/07/06 - makes xhtml compliant)
var $cssShadowMenu;
var $cssShadowDepth;
var $browserInfo;

	function menu_dropdown (&$params, $menuUNID, $cssRoot, $browserInfo){
		/**
		/* On instantiation, set up class properties
		*/
		$this->menuUNID = $menuUNID;
		$this->browserInfo = $browserInfo;
		$this->cssRoot = $cssRoot;	
		$this->imgPath = $GLOBALS['mosConfig_live_site'] .'/images/M_images/';	
		$this->DDownPositioning= $params->get('positioning');
		if ($this->DDownPositioning=="horizontal"){
			$this->DDownHorizMinWidth= $params->get('horiz_min_width');
		}
		if ($this->DDownHorizMinWidth=="") {$this->DDownHorizMinWidth=0;}				
		$this->DDownHorizMinWidth=intval($this->DDownHorizMinWidth);
		$this->DDownOverlapLeft= $params->get('overlap_left');
		if ($this->DDownOverlapLeft=="") {$this->DDownOverlapLeft=0;}
		$this->DDownOverlapLeft=intval($this->DDownOverlapLeft);
		$this->DDownOverlapLeft=0-$this->DDownOverlapLeft; // turn in to negative number		
		$this->cssShadowMenu= $params->get('css_shadow_menu');
		$this->cssShadowDepth= $params->get('css_shadow_depth');
		if ($this->cssShadowMenu=="") {$this->cssShadowMenu=0;}
		if ($this->cssShadowDepth=="") {$this->cssShadowDepth=10;}
		$this->cssShadowDepth=str_replace("px","",$this->cssShadowDepth); // remove px
	}

	function StartMenu (&$level) {
	/**
	/* Function Desc - either starts menu or writes new section
	*/	
		if ($level==0){
			$this->StartMenu_DropDown();
		}
		else {
			$this->NewSection($level);
		}
	}
	
	function StartMenu_DropDown () {
		/**
		/* Function Desc - Writes html to start the dropdown menu
		*/
		
		//set menuCont width to 1px if browser is ie and drop down and horizontal
		if ($this->DDownHorizMinWidth>0){			
			if ($this->browserInfo->type=="ie"){
				for ($mc=1; $mc<=$cssNumMenus; $mc++){
					if ($mc>1){
						$styleAppend.=",\n"; // add comma to end of style
					}
					$styleAppend.=" .".$this->cssRoot." .menuCont_$mc";
				}
				$styleAppend.="{\n";
				$styleAppend.="\t width:1px !important;\n";
				$this->styleAppend=$styleAppend;
			}
		}
		
		echo("<div style='z-index:500; height:auto;'>\n");		
		echo("<table cellspacing='0' cellpadding='0' id='".$this->menuUNID."' class='$this->cssRoot'>\n");
		echo("\t<tr>\n");						
		if ($this->DDownPositioning=="vertical"){
			echo("\t<td>\n");
		}
		// Remmed out code below is for next version which will also enable some groovy CSS menus to function
		// $csshoverpath="".$params->get( 'LSPath' )."/css/csshover.htc"."";
		// echo("<style>body {behavior:url(".$csshoverpath.");}</style>");
	}

	function NewSection (&$level) {
		/**
		/* Function Desc - Writes html for a new section of dropdown menu
		*/
		
		/**
		/* Add shadow to sub menu if specified in params - mod 19/08/2005
		/* Only works for ie (mozilla haven't applied shadowing to CSS yet (I think))
		*/
		if ($this->browserInfo->type=="ie") {
			switch($this->cssShadowMenu){
				case 0:
					$shadowStyleStr="";
					$boxShadStr="";
					$secStyleStr="";
					break;
				case 1:
					$shadowStyleStr=" style='width:100%; padding-left:".$this->cssShadowDepth."px; padding-bottom:".$this->cssShadowDepth."px; filter:shadow(color:gray, strength:".$this->cssShadowDepth.");' ";
					$boxShadStr=" style='border-left:1px solid gray; border-bottom:1px solid gray'";
					$secStyleStr="style='margin-left:-".$this->cssShadowDepth."px'"; // fix left position
					break;
				case 2:
					$shadowStyleStr=" style='width:100%; padding-right:".$this->cssShadowDepth."px; padding-bottom:".$this->cssShadowDepth."px; filter:shadow(color:gray, direction:135, strength:".$this->cssShadowDepth.");' ";
					$boxShadStr=" style='border-right:1px solid gray; border-bottom:1px solid gray'";
					break;
			}
		}
		$levTabs=str_repeat("\t", $level);
		echo("\t".$levTabs."<div class='section' $secStyleStr><div class='shadow' ".$shadowStyleStr."><div class='menuBox' ".$boxShadStr.">\n");		
	}
		
	function NewItem(&$level, &$params, &$row, &$subMenus, &$name, &$cssRepeatNum, &$target, &$link){
		/**
		/* Function Desc - Writes html for a new drop down item
		*/	
		$parentImgStr="";
		$menuImage="";
		$menuImgStr="";
		$spanStyle="";
		
		$levTabs=str_repeat("\t", $level);
		
		if ($level==0) {$itemClass="parentItem";} else {$itemClass="subItem_$cssRepeatNum";} // class for menu item
		
		if ($level==0 && $this->DDownPositioning=="horizontal") {echo("\t\t<td>\n");}
		if ( $params->get( 'show_img' )){
			mygosu_menus::showImage($row, $params, $menuImgStr, $spanStyle);
		}
		if ($subMenus && ($params->get( 'img_parent' ) != -1) && $params->get('show_img_rgt') == "1"){ // bug fix by Srdan Mahmutovic 2005-06-21 (before it wasn't checking the show img_parent parameter)
			$parentImgStr="<img class='rgtImg' border='0' src='".$this->imgPath.$params->get( 'img_parent' )."' alt='".$name."'/>";					
		}
		if ($row->type!="separator"){
			// Search engine friendly url code mod by Srdan Mahmutovic 2005-06-30
			print "\t\t\t".$levTabs."<div class='menuCont_$cssRepeatNum' ><a class='".$itemClass."' target=".$target." href='".htmlspecialchars(sefRelToAbs($link))."'>".$menuImgStr."<span".$spanStyle.">".htmlentities($row->name)." </span>".$parentImgStr."</a></div>\n";					
		} else {
			print "\t\t\t".$levTabs."<div class='separator' ><a href='javascript:void();'>".$row->name."</a></div>\n";
		}
	}		
	
	function CloseItem(&$level){
		if ($level==0 && $this->DDownPositioning=="horizontal") {
			echo ("\t\t</td>\n");
		}
	}
	
	function CloseMenuSection(&$level){		
		/**
		/* Function Desc - Writes html to close section of menu being processed (or close the menu completely)
		*/	
		if ($level==0){			
			// close entire menu
			if ($this->DDownPositioning=="vertical"){
				echo ("\t\t</td>\n");
			}				
			echo ("\t</tr>\n");
			echo ("</table>\n");			
			echo ("</div>\n");
		} else {
				// close menu item
				$levTabs=str_repeat("\t", $level);
				print"\t".$levTabs."</div></div></div>\n";
		}
	}

	
	function LoadScript (&$params){
		/**
		/* Function Desc - Loads javascript applicable to drop down menu
		*/
		$delShow = $params->get('delay_show');
		$delHide = $params->get('delay_hide');
		
		// Append menu style if necessary
		if ($this->styleAppend!=""){
			$menuScriptStr.="var head = document.getElementsByTagName('head').item(0);";
			$styleNoCarRets=str_replace("\n","",$this->styleAppend);
			$menuScriptStr.="head.setAttribute('style', '".$styleNoCarRets."');";
		} else {
			$menuScriptStr="";
		}
		
		$menuScriptStr=$menuScriptStr."var ".$this->menuUNID." = new DropDownMenuX('".$this->menuUNID."');".
		$this->menuUNID.".type = '".$this->DDownPositioning."';".
		$this->menuUNID.".delay.show = $delShow;".
		$this->menuUNID.".delay.hide = $delHide;";
		if ($this->DDownPositioning=="vertical"){$menuScriptStr=$menuScriptStr.$this->menuUNID.".position.level1.left = $this->DDownOverlapLeft;";}
		$menuScriptStr.=$this->menuUNID.".position.levelX.left = $this->DDownOverlapLeft;".	
		$this->menuUNID.".fitWidth = $this->DDownHorizMinWidth;".
		$this->menuUNID.".init();";								
		//$menuScriptStr=$menuScriptStr."alert('menu has been initialised - ".$this->menuUNID."');";
		?>		
		<script type = "text/javaScript" src="<?php echo $params->get( 'LSPath' ); ?>/js/dropdownmenux_crunched.js"></script> <!--Mod by Guy Thomas 2004/12/06-->
		<script type = "text/javaScript" src="<?php echo $params->get( 'LSPath' ); ?>/js/dropdownmenux_ie5_crunched.js"></script> <!--Mod by Guy Thomas 2004/12/06-->
		
		<!-- add menu initialise to onload event-->
		<script type="text/javascript">	
		<!--					
		// create init function
		function <?php echo($this->menuUNID)?>_init(){eval("<?php echo ($menuScriptStr);?>");}
		// add init function to onload event
		if (document.body.currentStyle){
			//ie code
			window.attachEvent('onload', <?php echo($this->menuUNID)?>_init);
		} else {
			//mozilla code
			document.addEventListener("load", <?php echo($this->menuUNID)?>_init(), false);
		}
		-->
		</script>			
		
		<?php
	}

/*==========================================================================*/
/*                         END OF CLASS menu_dropdown                       */
/*==========================================================================*/

}
