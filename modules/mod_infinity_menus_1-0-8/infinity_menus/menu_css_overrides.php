<?php
/*****************************************************************************
/  Module - Infinity (MyGosu) Menus 2005/04/25
/  Version  1-0-7
/  Copyright Guy Thomas [brudinie]   
/  brudinie@yahoo.co.uk
/  @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
/
/  Javascript Drop Down & Tree Menu Systems by Cezary Tomczak (Mygosu) (modded by Guy Thomas)
/  Mygosu: - http://gosu.pl/dhtml/mygosumenu.html
*****************************************************************************/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class css_overrides{
/*==========================================================================*/
/*                     START OF CLASS css_overrides                         */
/*==========================================================================*/
	var $cssRoot;
	var $padL;
	var $padR;
	var $padT;
	var $padB;
	var $wrap;
	var $font;
	var $fontSize;
	var $fontStyle;
	var $fontWeight;
	var $htmlStr;
	var $jsStr;
	var $menuUNID;
	
	function css_overrides(&$params, $cssRoot){		
		$this->cssRoot=$cssRoot;
		$this->padL=trim(str_replace("px","",$params->get('css_pad_left')));
		$this->padR=trim(str_replace("px","",$params->get('css_pad_right')));
		$this->padT=trim(str_replace("px","",$params->get('css_pad_top')));
		$this->padB=trim(str_replace("px","",$params->get('css_pad_bottom')));		
		$this->wrap=$params->get('css_wrap_type');
		switch ($this->wrap) {
			case 0:$this->wrap=""; break;
			case 1:$this->wrap="normal"; break;
			case 2:$this->wrap="no-wrap"; break;
		}
		$this->font=$params->get('css_font_family');
		switch ($this->font) {
			case 0:$this->font=""; break;
			case 1:$this->font='Arial, Helvetica, sans-serif'; break;
			case 2:$this->font='"Times New Roman", Times, serif'; break;
			case 3:$this->font='"Courier New", Courier, mono'; break;
			case 4:$this->font='Georgia, "Times New Roman", Times, serif'; break;
			case 5:$this->font='Verdana, Arial, Helvetica, sans-serif'; break;
			case 6:$this->font='Geneva, Arial, Helvetica, sans-serif'; break;
		}
		$this->fontSize=intval($params->get('css_font_size'));
		switch ($this->fontSize) {
			case 0:$this->fontSize=""; break;
			default: $this->fontSize=($this->fontSize+7)."px"; //(option 1 is 8px so 1+7 = 8, etc)
		}
		$this->fontStyle=$params->get('css_font_style');
		switch ($this->fontStyle) {
			case 0:$this->fontStyle=""; break;
			case 1:$this->fontStyle="normal"; break;
			case 2:$this->fontStyle="italic"; break;
			case 3:$this->fontStyle="oblique"; break;
		}
		$this->fontWeight=$params->get('css_font_weight');
		switch ($this->fontWeight) {
			case 0:$this->fontWeight=""; break;
			default: $this->fontWeight=$this->fontWeight*100;
		}
	}
	
	function GenerateInternalCSS ($className) {
		//to do - ad browser detection
		$this->GenerateInternalHTML($className);
		$this->GenerateInternalJSCSS($className);
	}
	
	function GenerateInternalHTML ($className){
		/**
		/* Generate internal CSS for $className
		*/	
		$this->htmlStr.="\n.$this->cssRoot $className,\n";
		$this->htmlStr.=".$this->cssRoot $className:hover,\n";
		$this->htmlStr.=".$this->cssRoot $className-active,\n";
		$this->htmlStr.=".$this->cssRoot $className-active:hover{\n";
		if (is_numeric($this->padL)){$this->htmlStr.="\t padding-left:".$this->padL."px !important;\n";}
		if (is_numeric($this->padR)){$this->htmlStr.="\t padding-right:".$this->padR."px !important;\n";}
		if (is_numeric($this->padT)){$this->htmlStr.="\t padding-top:".$this->padT."px !important;\n";}
		if (is_numeric($this->padB)){$this->htmlStr.="\t padding-bottom:".$this->padB."px !important;\n";}
		if ($this->wrap!=""){$this->htmlStr.="\t white-space:".$this->wrap." !important;\n";}
		if ($this->font!=""){$this->htmlStr.="\t font-family:".$this->font." !important;\n";}
		if ($this->fontSize!=""){$this->htmlStr.="\t font-size:".$this->fontSize." !important;\n";}		
		if ($this->fontStyle!=""){$this->htmlStr.="\t font-style:".$this->fontStyle." !important;\n";}
		if ($this->fontWeight!=""){$this->htmlStr.="\t font-weight:".$this->fontWeight." !important;\n";}
		$this->htmlStr.="}\n";				
	}
	
	function GenerateInternalJSCSS ($className){
	
		$CNnoDot=str_replace(".","",$className);
	
		/***
		/* Create js for parameter array
		***/
		$tempJs="";
		if (is_numeric($this->padL)){$tempJs="'paddingLeft'";}
		if (is_numeric($this->padR)){
			if ($tempJs!=""){$tempJs.=", ";} // add comma for new array item only if previous array value exists
			$tempJs.="'paddingRight'";
		}
		if (is_numeric($this->padT)){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'paddingTop'";
		}
		if (is_numeric($this->padB)){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'paddingBottom'";
		}					
		if ($this->wrap!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'whiteSpace'";
		}
		if ($this->font!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'fontFamily'";
		}
		if ($this->fontSize!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'fontSize'";
		}
		if ($this->fontStyle!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'fontStyle'";
		}
		if ($tempJs!=""){
			$this->jsStr.="\nvar ".$CNnoDot."_params = new Array (".$tempJs.");";
		}
		
		/***
		/* Create js for value array
		***/		
		$tempJs="";
		if (is_numeric($this->padL)){$tempJs="'".$this->padL."px'";}
		if (is_numeric($this->padR)){
			if ($tempJs!="") {$tempJs.=", ";} // add comma for new array item only if previous pad exists
			$tempJs.="'".$this->padR."px'";
		}
		if (is_numeric($this->padT)){
			if ($tempJs!="") {$tempJs.=", ";} // add comma for new array item only if previous pad exists
			$tempJs.="'".$this->padT."px'";
		}
		if (is_numeric($this->padB)){
			if ($tempJs!="") {$tempJs.=", ";} // add comma for new array item only if previous pad exists
			$tempJs.="'".$this->padB."px'";
		}					
		if ($this->wrap!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'".$this->wrap."'";
		}
		if ($this->font!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'".$this->font."'";
		}
		if ($this->fontSize!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'".$this->fontSize."'";
		}
		if ($this->fontStyle!=""){
			if ($tempJs!="") {$tempJs.=", ";} // add comma...
			$tempJs.="'".$this->fontStyle."'";
		}				
		if ($tempJs!=""){
			$this->jsStr.="\n var ".$CNnoDot."_vals = new Array (".$tempJs.");";
			$this->jsStr.="\n setStyleByClass('a','$this->menuUNID','$className',".$CNnoDot."_params, ".$CNnoDot."_vals);";
		}				
	}
/*==========================================================================*/
/*                      END OF CLASS css_overrides                          */
/*==========================================================================*/	
}
?>