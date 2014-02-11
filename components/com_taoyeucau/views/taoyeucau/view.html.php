<?php
/**
* @package Author
* @author danhthong
* @website i-land.vn
* @email danhthong@gmail.com
* @copyright 2012
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport( 'joomla.application.component.view');
class TaoyeucauViewTaoyeucau extends JView
{
	function display ($tpl = null)
	{
		$moduleChiase = 'Tạo yêu cầu bất động sản';
		$quangCaoHTML = TaoyeucauViewTaoyeucau::getChiaSe( $moduleChiase );
		$this->assignRef( 'yeucau', $quangCaoHTML );
		parent::display($tpl);
	}
	function getChiaSe( $moduleTitle )
	{
		$modSearch = JModuleHelper::getModule('taoyeucau', $moduleTitle); 
		
		$modSearch->title = 'Tạo yêu cầu bất động sản';
		$modSearch->showtitle = 0;
		
        $attribs['style'] = 'raw';
        
		$dataHTML = JModuleHelper::renderModule( $modSearch, $attribs );
		
		return $dataHTML;
	}
}


?>