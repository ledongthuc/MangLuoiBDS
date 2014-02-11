<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_COMPONENT.DS.'views'.DS.'properties'.DS.'view.html.php');

jimport('joomla.application.component.controller');
require_once('libraries/com_u_re/php/common_utils.php');
require_once('components/com_u_re/views/manage/view.html.php');

class U_reControllerManage extends JController
{
	var $_controllerUrl = 'index.php?option=com_u_re&view=manage&layout=form';
	
	function deleteimg()
	{
		$id = JRequest::getVar('id',0);
		ilandCommonUtils::delete_img( $id );
	    
		$this->setRedirect( $this->_controllerUrl . '&Itemid=' . $_GET['Itemid'] .'&id=' . $id . '&lang=' . $_GET['lang']);
	}
	
	function saveDangKyMuaThue()
	{
		$manageView = new U_reViewmanage();
		$manageView->saveDangKyMuaThue(); 
	}
}

?>
