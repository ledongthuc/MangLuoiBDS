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

jimport('joomla.application.component.controller');
//require_once( COM_U_RE_VIEW_PROPERTY );
class TaoyeucauController extends JController
{
	function display()
	{
		parent::display();
	}
	function saveYeuCauBDS(){
		U_reModelProperties::saveYeuCauBDS();
		//$this->setRedirect( 'index.php' );
	}
	function untickEmail(){
		U_reModelProperties::untickYeuCauBDS();
	}
}

?>