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

class menu_tree{
/*==========================================================================*/
/*                          START OF CLASS menu_tree                        */
/*==========================================================================*/

	var $menuUNID;
	var $cssRoot;
	var $treeWidth;
	var $treeHeight;

	function menu_tree(&$params, $menuUNID, $cssRoot){		
		$this->menuUNID = $menuUNID;
		$this->cssRoot = $cssRoot;
		$this->treeWidth = trim(str_replace("px","",$params->get('tree_width')));
		$this->treeHeight = trim(str_replace("px","",$params->get('tree_height')));
		if ($this->treeWidth!=""){$this->treeWidth="width:".$this->treeWidth."px;";}
		if ($this->treeHeight!=""){$this->treeHeight="height:".$this->treeHeight."px;";}		
	}
	

	function StartMenu ($level) {
		/**
		/* Function Desc - Writes html to start the tree menu
		*/
		if ($level!=0){return;}
		echo ("\n<div class='$this->cssRoot'>");
		echo ("\n\t<div class='wrap1' style='".$this->treeWidth. $this->treeHeight."' >");
		echo ("\n\t\t<div class='top' id ='tree-root'>Site Menu</div>");			
		echo ("\n\t\t\t<div class='wrap2' id='".$this->menuUNID."'>");	
	}
	
	function NewItem (&$level, &$params, &$row, &$subMenus, &$name, &$cssRepeatNum, &$target, &$link){
		/**
		/* Function Desc - Writes html for a new tree item
		*/	

		$levTabs=str_repeat("\t", $level);
		$treeItemClass = $subMenus ? "folder" : "doc";
		if ($row->type=="separator"){ $treeItemClass="separator"; } //makes seperator dissappear for tree menu
		
		echo ("\n\t\t\t".$levTabs."<div class='$treeItemClass'>");
		
		// Search engine friendly url code mod by Srdan Mahmutovic 2005-06-30
		echo ("<a target=".$target." href='".htmlspecialchars(sefRelToAbs($link))."'>".htmlentities($row->name)."</a>");
	}
	
	function CloseItem(&$level){
		/**
		/* Function Desc - Writes html to close tree item
		*/	
		$levTabs=str_repeat("\t", $level);
		echo ("\n\t\t\t".$levTabs."</div>\n");
	}
			
	function CloseMenuSection($level){
		/**
		/* Function Desc - Writes html to close section of tree being processed
		*/		
		if ($level==0){
			echo ("\n\t\t\t</div>");	
			echo ("\n\t\t</div>");			
			echo ("\n\t</div>");				
			echo ("\n</div>");
		}
	}	
	
	function LoadScript (&$params){
		/**
		/* Function Desc - Loads javascript applicable to tree menu
		*/
		$menuScriptStr="var ".$this->menuUNID." = new DynamicTree('".$this->menuUNID."', '".$params->get( 'LSPath' )."');";
		/**
		/* Do folder items need to link ?
		*/
		$foldersAsLinks=intval($params->get('tree_folders_link'));
		if ($foldersAsLinks==1){
			$menuScriptStr=$menuScriptStr.$this->menuUNID.".foldersAsLinks=true;";
		}
		/**
		/* Initialise script
		*/
		$menuScriptStr=$menuScriptStr.$this->menuUNID.".init();";
		?>
		<script type="text/javascript" src="<?php echo $params->get( 'LSPath' ); ?>/js/dynamictree_crunched.js"></script>
		<script><?php echo($menuScriptStr);?></script>
		<?php	
	}

/*==========================================================================*/
/*                           END OF CLASS menu_tree                         */
/*==========================================================================*/
}