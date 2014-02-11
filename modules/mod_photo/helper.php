<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version		1.2 2008-07
 * @package		Jea.module.emphasis
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */
defined('_JEXEC') or die('Restricted access');

class modPhotoHelper {
	function getListImage($linkfolder){
		$list_image = array();
		if (is_dir($linkfolder)){
			if ($dh = opendir($linkfolder)){
				while ($file = readdir($dh)){
					$uprFile = strtoupper($file);
					if ($uprFile != '.' && $uprFile != '..'){
						if (strpos($uprFile, '.GIF',1)||strpos($uprFile, '.JPG',1)||strpos($uprFile, '.PNG',1) ||strpos($uprFile, '.BMP',1)){
							//array_push($list_image, $linkfolder.$file);
							$image=array();
							$image['link']=$linkfolder.$file;
							$image['title']=substr($file,0,-4);
							$list_image[]=$image;
						}
					}
				}	
				closedir($dh);
			}else{
				//echo "<b>Can't open directory</b>";
			}
		}else{
			//echo "<b>".$rsws_basic_folder." Not a directory</b>";
		}
		return $list_image;
	}
	
	function getHtmlTemplate($module_id, $theme){
		if($theme=='custom'){
			$theme=$this->params->get('custom_theme','default');
		}       
        $file = file_get_contents(JURI::base()."/plugins/system/pretty/html/".$theme.".html",true);
        if($file!=null && $file!=''){
        	$popup='pretty_popup_'.$module_id;
        	$file=preg_replace("/pretty_popup/",$popup,$file);
        }        
        return $file;
	}
}