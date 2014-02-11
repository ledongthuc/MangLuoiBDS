<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.view');
class MapbdsViewMapbds extends JView
{
	function display ($tpl = null)
	{
		$mapModel =  new MapbdsModelMapbds;
		$data = $mapModel->layDanhSachBDS();
		$d = MapbdsViewMapbds::getPropertyList();
		$this->assignRef('data' , $d);
		parent::display($tpl);
	}
	
	
	function getPropertyList()
	{		
		$modProperties = JModuleHelper::getModule('danh_sach_BDS', 'BAN DO'); 
		 
        $attribs['style'] = 'raw';        
		$dataHTML = JModuleHelper::renderModule( $modProperties, $attribs );
		echo $dataHTML;
	}
}


?>